<?php
/**
 * Recent changes tagging.
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 * http://www.gnu.org/copyleft/gpl.html
 *
 * @file
 */

class ChangeTags {
	/**
	 * Creates HTML for the given tags
	 *
	 * @param string $tags Comma-separated list of tags
	 * @param string $page A label for the type of action which is being displayed,
	 *   for example: 'history', 'contributions' or 'newpages'
	 * @return array Array with two items: (html, classes)
	 *   - html: String: HTML for displaying the tags (empty string when param $tags is empty)
	 *   - classes: Array of strings: CSS classes used in the generated html, one class for each tag
	 */
	public static function formatSummaryRow( $tags, $page ) {
		global $wgLang;

		if ( !$tags ) {
			return array( '', array() );
		}

		$classes = array();

		$tags = explode( ',', $tags );
		$displayTags = array();
		foreach ( $tags as $tag ) {
			$displayTags[] = Xml::tags(
				'span',
				array( 'class' => 'mw-tag-marker ' .
								Sanitizer::escapeClass( "mw-tag-marker-$tag" ) ),
				self::tagDescription( $tag )
			);
			$classes[] = Sanitizer::escapeClass( "mw-tag-$tag" );
		}
		$markers = wfMessage( 'tag-list-wrapper' )
			->numParams( count( $displayTags ) )
			->rawParams( $wgLang->commaList( $displayTags ) )
			->parse();
		$markers = Xml::tags( 'span', array( 'class' => 'mw-tag-markers' ), $markers );

		return array( $markers, $classes );
	}

	/**
	 * Get a short description for a tag
	 *
	 * @param string $tag Tag
	 *
	 * @return string Short description of the tag from "mediawiki:tag-$tag" if this message exists,
	 *   html-escaped version of $tag otherwise
	 */
	public static function tagDescription( $tag ) {
		$msg = wfMessage( "tag-$tag" );
		return $msg->exists() ? $msg->parse() : htmlspecialchars( $tag );
	}

	/**
	 * Add tags to a change given its rc_id, rev_id and/or log_id
	 *
	 * @param string|array $tags Tags to add to the change
	 * @param int|null $rc_id The rc_id of the change to add the tags to
	 * @param int|null $rev_id The rev_id of the change to add the tags to
	 * @param int|null $log_id The log_id of the change to add the tags to
	 * @param string $params Params to put in the ct_params field of table 'change_tag'
	 *
	 * @throws MWException
	 * @return bool False if no changes are made, otherwise true
	 *
	 * @exception MWException When $rc_id, $rev_id and $log_id are all null
	 */
	public static function addTags( $tags, $rc_id = null, $rev_id = null,
		$log_id = null, $params = null
	) {
		if ( !is_array( $tags ) ) {
			$tags = array( $tags );
		}

		$tags = array_filter( $tags ); // Make sure we're submitting all tags...

		if ( !$rc_id && !$rev_id && !$log_id ) {
			throw new MWException( 'At least one of: RCID, revision ID, and log ID MUST be ' .
				'specified when adding a tag to a change!' );
		}

		$dbw = wfGetDB( DB_MASTER );

		// Might as well look for rcids and so on.
		if ( !$rc_id ) {
			// Info might be out of date, somewhat fractionally, on slave.
			if ( $log_id ) {
				$rc_id = $dbw->selectField(
					'recentchanges',
					'rc_id',
					array( 'rc_logid' => $log_id ),
					__METHOD__
				);
			} elseif ( $rev_id ) {
				$rc_id = $dbw->selectField(
					'recentchanges',
					'rc_id',
					array( 'rc_this_oldid' => $rev_id ),
					__METHOD__
				);
			}
		} elseif ( !$log_id && !$rev_id ) {
			// Info might be out of date, somewhat fractionally, on slave.
			$log_id = $dbw->selectField(
				'recentchanges',
				'rc_logid',
				array( 'rc_id' => $rc_id ),
				__METHOD__
			);
			$rev_id = $dbw->selectField(
				'recentchanges',
				'rc_this_oldid',
				array( 'rc_id' => $rc_id ),
				__METHOD__
			);
		}

		$tsConds = array_filter( array(
			'ts_rc_id' => $rc_id,
			'ts_rev_id' => $rev_id,
			'ts_log_id' => $log_id )
		);

		// Update the summary row.
		// $prevTags can be out of date on slaves, especially when addTags is called consecutively,
		// causing loss of tags added recently in tag_summary table.
		$prevTags = $dbw->selectField( 'tag_summary', 'ts_tags', $tsConds, __METHOD__ );
		$prevTags = $prevTags ? $prevTags : '';
		$prevTags = array_filter( explode( ',', $prevTags ) );
		$newTags = array_unique( array_merge( $prevTags, $tags ) );
		sort( $prevTags );
		sort( $newTags );

		if ( $prevTags == $newTags ) {
			// No change.
			return false;
		}

		$dbw->replace(
			'tag_summary',
			array( 'ts_rev_id', 'ts_rc_id', 'ts_log_id' ),
			array_filter( array_merge( $tsConds, array( 'ts_tags' => implode( ',', $newTags ) ) ) ),
			__METHOD__
		);

		// Insert the tags rows.
		$tagsRows = array();
		foreach ( $tags as $tag ) { // Filter so we don't insert NULLs as zero accidentally.
			$tagsRows[] = array_filter(
				array(
					'ct_tag' => $tag,
					'ct_rc_id' => $rc_id,
					'ct_log_id' => $log_id,
					'ct_rev_id' => $rev_id,
					'ct_params' => $params
				)
			);
		}

		$dbw->insert( 'change_tag', $tagsRows, __METHOD__, array( 'IGNORE' ) );

		return true;
	}

	/**
	 * Applies all tags-related changes to a query.
	 * Handles selecting tags, and filtering.
	 * Needs $tables to be set up properly, so we can figure out which join conditions to use.
	 *
	 * @param string|array $tables Table names, see DatabaseBase::select
	 * @param string|array $fields Fields used in query, see DatabaseBase::select
	 * @param string|array $conds Conditions used in query, see DatabaseBase::select
	 * @param array $join_conds Join conditions, see DatabaseBase::select
	 * @param array $options Options, see Database::select
	 * @param bool|string $filter_tag Tag to select on
	 *
	 * @throws MWException When unable to determine appropriate JOIN condition for tagging
	 */
	public static function modifyDisplayQuery( &$tables, &$fields, &$conds,
										&$join_conds, &$options, $filter_tag = false ) {
		global $wgRequest, $wgUseTagFilter;

		if ( $filter_tag === false ) {
			$filter_tag = $wgRequest->getVal( 'tagfilter' );
		}

		// Figure out which conditions can be done.
		if ( in_array( 'recentchanges', $tables ) ) {
			$join_cond = 'ct_rc_id=rc_id';
		} elseif ( in_array( 'logging', $tables ) ) {
			$join_cond = 'ct_log_id=log_id';
		} elseif ( in_array( 'revision', $tables ) ) {
			$join_cond = 'ct_rev_id=rev_id';
		} elseif ( in_array( 'archive', $tables ) ) {
			$join_cond = 'ct_rev_id=ar_rev_id';
		} else {
			throw new MWException( 'Unable to determine appropriate JOIN condition for tagging.' );
		}

		$fields['ts_tags'] = wfGetDB( DB_SLAVE )->buildGroupConcatField(
			',', 'change_tag', 'ct_tag', $join_cond
		);

		if ( $wgUseTagFilter && $filter_tag ) {
			// Somebody wants to filter on a tag.
			// Add an INNER JOIN on change_tag

			$tables[] = 'change_tag';
			$join_conds['change_tag'] = array( 'INNER JOIN', $join_cond );
			$conds['ct_tag'] = $filter_tag;
		}
	}

	/**
	 * Build a text box to select a change tag
	 *
	 * @param string $selected Tag to select by default
	 * @param bool $fullForm
	 *        - if false, then it returns an array of (label, form).
	 *        - if true, it returns an entire form around the selector.
	 * @param Title $title Title object to send the form to.
	 *        Used when, and only when $fullForm is true.
	 * @return string|array
	 *        - if $fullForm is false: Array with
	 *        - if $fullForm is true: String, html fragment
	 */
	public static function buildTagFilterSelector( $selected = '',
		$fullForm = false, Title $title = null
	) {
		global $wgUseTagFilter;

		if ( !$wgUseTagFilter || !count( self::listDefinedTags() ) ) {
			return $fullForm ? '' : array();
		}

		$data = array(
			Html::rawElement(
				'label',
				array( 'for' => 'tagfilter' ),
				wfMessage( 'tag-filter' )->parse()
			),
			Xml::input(
				'tagfilter',
				20,
				$selected,
				array( 'class' => 'mw-tagfilter-input', 'id' => 'tagfilter' )
			)
		);

		if ( !$fullForm ) {
			return $data;
		}

		$html = implode( '&#160;', $data );
		$html .= "\n" .
			Xml::element(
				'input',
				array( 'type' => 'submit', 'value' => wfMessage( 'tag-filter-submit' )->text() )
			);
		$html .= "\n" . Html::hidden( 'title', $title->getPrefixedText() );
		$html = Xml::tags(
			'form',
			array( 'action' => $title->getLocalURL(), 'class' => 'mw-tagfilter-form', 'method' => 'get' ),
			$html
		);

		return $html;
	}

	/**
	 * Basically lists defined tags which count even if they aren't applied to anything.
	 * Tags on items in table 'change_tag' which are not (or no longer) in table 'valid_tag'
	 * are not included.
	 *
	 * Tries memcached first.
	 *
	 * @return string[] Array of strings: tags
	 */
	public static function listDefinedTags() {
		// Caching...
		global $wgMemc;
		$key = wfMemcKey( 'valid-tags' );
		$tags = $wgMemc->get( $key );
		if ( $tags ) {
			return $tags;
		}

		$emptyTags = array();

		// Some DB stuff
		$dbr = wfGetDB( DB_SLAVE );
		$res = $dbr->select( 'valid_tag', 'vt_tag', array(), __METHOD__ );
		foreach ( $res as $row ) {
			$emptyTags[] = $row->vt_tag;
		}

		wfRunHooks( 'ListDefinedTags', array( &$emptyTags ) );

		$emptyTags = array_filter( array_unique( $emptyTags ) );

		// Short-term caching.
		$wgMemc->set( $key, $emptyTags, 300 );
		return $emptyTags;
	}

	/**
	 * Returns a map of any tags used on the wiki to number of edits
	 * tagged with them, ordered descending by the hitcount.
	 *
	 * @return array Array of string => int
	 */
	public static function tagUsageStatistics() {
		$out = array();

		$dbr = wfGetDB( DB_SLAVE );
		$res = $dbr->select(
			'change_tag',
			array( 'ct_tag', 'hitcount' => 'count(*)' ),
			array(),
			__METHOD__,
			array( 'GROUP BY' => 'ct_tag', 'ORDER BY' => 'hitcount DESC' )
		);

		foreach ( $res as $row ) {
			$out[$row->ct_tag] = $row->hitcount;
		}
		foreach ( self::listDefinedTags() as $tag ) {
			if ( !isset( $out[$tag] ) ) {
				$out[$tag] = 0;
			}
		}

		return $out;
	}
}
