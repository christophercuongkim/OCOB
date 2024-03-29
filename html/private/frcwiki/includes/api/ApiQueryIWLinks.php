<?php
/**
 * API for MediaWiki 1.17+
 *
 * Created on May 14, 2010
 *
 * Copyright © 2010 Sam Reed
 * Copyright © 2006 Yuri Astrakhan "<Firstname><Lastname>@gmail.com"
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

/**
 * A query module to list all interwiki links on a page
 *
 * @ingroup API
 */
class ApiQueryIWLinks extends ApiQueryBase {

	public function __construct( ApiQuery $query, $moduleName ) {
		parent::__construct( $query, $moduleName, 'iw' );
	}

	public function execute() {
		if ( $this->getPageSet()->getGoodTitleCount() == 0 ) {
			return;
		}

		$params = $this->extractRequestParams();
		$prop = array_flip( (array)$params['prop'] );

		if ( isset( $params['title'] ) && !isset( $params['prefix'] ) ) {
			$this->dieUsageMsg( array( 'missingparam', 'prefix' ) );
		}

		// Handle deprecated param
		$this->requireMaxOneParameter( $params, 'url', 'prop' );
		if ( $params['url'] ) {
			$this->logFeatureUsage( 'prop=iwlinks&iwurl' );
			$prop = array( 'url' => 1 );
		}

		$this->addFields( array(
			'iwl_from',
			'iwl_prefix',
			'iwl_title'
		) );

		$this->addTables( 'iwlinks' );
		$this->addWhereFld( 'iwl_from', array_keys( $this->getPageSet()->getGoodTitles() ) );

		if ( !is_null( $params['continue'] ) ) {
			$cont = explode( '|', $params['continue'] );
			$this->dieContinueUsageIf( count( $cont ) != 3 );
			$op = $params['dir'] == 'descending' ? '<' : '>';
			$db = $this->getDB();
			$iwlfrom = intval( $cont[0] );
			$iwlprefix = $db->addQuotes( $cont[1] );
			$iwltitle = $db->addQuotes( $cont[2] );
			$this->addWhere(
				"iwl_from $op $iwlfrom OR " .
				"(iwl_from = $iwlfrom AND " .
				"(iwl_prefix $op $iwlprefix OR " .
				"(iwl_prefix = $iwlprefix AND " .
				"iwl_title $op= $iwltitle)))"
			);
		}

		$sort = ( $params['dir'] == 'descending' ? ' DESC' : '' );
		if ( isset( $params['prefix'] ) ) {
			$this->addWhereFld( 'iwl_prefix', $params['prefix'] );
			if ( isset( $params['title'] ) ) {
				$this->addWhereFld( 'iwl_title', $params['title'] );
				$this->addOption( 'ORDER BY', 'iwl_from' . $sort );
			} else {
				$this->addOption( 'ORDER BY', array(
					'iwl_from' . $sort,
					'iwl_title' . $sort
				) );
			}
		} else {
			// Don't order by iwl_from if it's constant in the WHERE clause
			if ( count( $this->getPageSet()->getGoodTitles() ) == 1 ) {
				$this->addOption( 'ORDER BY', 'iwl_prefix' . $sort );
			} else {
				$this->addOption( 'ORDER BY', array(
					'iwl_from' . $sort,
					'iwl_prefix' . $sort,
					'iwl_title' . $sort
				) );
			}
		}

		$this->addOption( 'LIMIT', $params['limit'] + 1 );
		$res = $this->select( __METHOD__ );

		$count = 0;
		foreach ( $res as $row ) {
			if ( ++$count > $params['limit'] ) {
				// We've reached the one extra which shows that
				// there are additional pages to be had. Stop here...
				$this->setContinueEnumParameter(
					'continue',
					"{$row->iwl_from}|{$row->iwl_prefix}|{$row->iwl_title}"
				);
				break;
			}
			$entry = array( 'prefix' => $row->iwl_prefix );

			if ( isset( $prop['url'] ) ) {
				$title = Title::newFromText( "{$row->iwl_prefix}:{$row->iwl_title}" );
				if ( $title ) {
					$entry['url'] = wfExpandUrl( $title->getFullURL(), PROTO_CURRENT );
				}
			}

			ApiResult::setContent( $entry, $row->iwl_title );
			$fit = $this->addPageSubItem( $row->iwl_from, $entry );
			if ( !$fit ) {
				$this->setContinueEnumParameter(
					'continue',
					"{$row->iwl_from}|{$row->iwl_prefix}|{$row->iwl_title}"
				);
				break;
			}
		}
	}

	public function getCacheMode( $params ) {
		return 'public';
	}

	public function getAllowedParams() {
		return array(
			'url' => array(
				ApiBase::PARAM_DFLT => false,
				ApiBase::PARAM_DEPRECATED => true,
			),
			'prop' => array(
				ApiBase::PARAM_ISMULTI => true,
				ApiBase::PARAM_TYPE => array(
					'url',
				)
			),
			'limit' => array(
				ApiBase::PARAM_DFLT => 10,
				ApiBase::PARAM_TYPE => 'limit',
				ApiBase::PARAM_MIN => 1,
				ApiBase::PARAM_MAX => ApiBase::LIMIT_BIG1,
				ApiBase::PARAM_MAX2 => ApiBase::LIMIT_BIG2
			),
			'continue' => null,
			'prefix' => null,
			'title' => null,
			'dir' => array(
				ApiBase::PARAM_DFLT => 'ascending',
				ApiBase::PARAM_TYPE => array(
					'ascending',
					'descending'
				)
			),
		);
	}

	public function getParamDescription() {
		return array(
			'prop' => array(
				'Which additional properties to get for each interlanguage link',
				' url      - Adds the full URL',
			),
			'url' => "Whether to get the full URL (Cannot be used with {$this->getModulePrefix()}prop)",
			'limit' => 'How many interwiki links to return',
			'continue' => 'When more results are available, use this to continue',
			'prefix' => 'Prefix for the interwiki',
			'title' => "Interwiki link to search for. Must be used with {$this->getModulePrefix()}prefix",
			'dir' => 'The direction in which to list',
		);
	}

	public function getDescription() {
		return 'Returns all interwiki links from the given page(s).';
	}

	public function getExamples() {
		return array(
			'api.php?action=query&prop=iwlinks&titles=Main%20Page'
				=> 'Get interwiki links from the [[Main Page]]',
		);
	}

	public function getHelpUrls() {
		return 'https://www.mediawiki.org/wiki/API:Iwlinks';
	}
}
