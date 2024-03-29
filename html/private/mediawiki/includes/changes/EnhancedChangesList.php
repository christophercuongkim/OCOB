<?php
/**
 * Generates a list of changes using an Enhanced system (uses javascript).
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

class EnhancedChangesList extends ChangesList {

	/**
	 * @var RCCacheEntryFactory
	 */
	protected $cacheEntryFactory;

	/**
	 * @var array Array of array of RCCacheEntry
	 */
	protected $rc_cache;

	/**
	 * @param IContextSource|Skin $obj
	 */
	public function __construct( $obj ) {
		if ( $obj instanceof Skin ) {
			// @todo: deprecate constructing with Skin
			$context = $obj->getContext();
		} else {
			if ( ! $obj instanceof IContextSource ) {
				throw new MWException( 'EnhancedChangesList must be constructed with a '
					. 'context source or skin.' );
			}

			$context = $obj;
		}

		parent::__construct( $context );

		// message is set by the parent ChangesList class
		$this->cacheEntryFactory = new RCCacheEntryFactory(
			$context,
			$this->message
		);
	}

	/**
	 * Add the JavaScript file for enhanced changeslist
	 * @return string
	 */
	public function beginRecentChangesList() {
		$this->rc_cache = array();
		$this->rcMoveIndex = 0;
		$this->rcCacheIndex = 0;
		$this->lastdate = '';
		$this->rclistOpen = false;
		$this->getOutput()->addModuleStyles( array(
			'mediawiki.special.changeslist',
			'mediawiki.special.changeslist.enhanced',
		) );
		$this->getOutput()->addModules( array(
			'jquery.makeCollapsible',
			'mediawiki.icon',
		) );

		return '<div class="mw-changeslist">';
	}

	/**
	 * Format a line for enhanced recentchange (aka with javascript and block of lines).
	 *
	 * @param RecentChange $baseRC
	 * @param bool $watched
	 *
	 * @return string
	 */
	public function recentChangesLine( &$baseRC, $watched = false ) {
		wfProfileIn( __METHOD__ );

		# If it's a new day, add the headline and flush the cache
		$date = $this->getLanguage()->userDate(
			$baseRC->mAttribs['rc_timestamp'],
			$this->getUser()
		);

		$ret = '';

		if ( $date != $this->lastdate ) {
			# Process current cache
			$ret = $this->recentChangesBlock();
			$this->rc_cache = array();
			$ret .= Xml::element( 'h4', null, $date ) . "\n";
			$this->lastdate = $date;
		}

		$cacheEntry = $this->cacheEntryFactory->newFromRecentChange( $baseRC, $watched );
		$this->addCacheEntry( $cacheEntry );

		wfProfileOut( __METHOD__ );

		return $ret;
	}

	/**
	 * Put accumulated information into the cache, for later display.
	 * Page moves go on their own line.
	 *
	 * @param RCCacheEntry $cacheEntry
	 */
	protected function addCacheEntry( RCCacheEntry $cacheEntry ) {
		$title = $cacheEntry->getTitle();
		$secureName = $title->getPrefixedDBkey();

		$type = $cacheEntry->mAttribs['rc_type'];

		if ( $type == RC_MOVE || $type == RC_MOVE_OVER_REDIRECT ) {
			# Use an @ character to prevent collision with page names
			$this->rc_cache['@@' . ( $this->rcMoveIndex++ )] = array( $cacheEntry );
		} else {
			# Logs are grouped by type
			if ( $type == RC_LOG ) {
				$secureName = SpecialPage::getTitleFor(
					'Log',
					$cacheEntry->mAttribs['rc_log_type']
				)->getPrefixedDBkey();
			}
			if ( !isset( $this->rc_cache[$secureName] ) ) {
				$this->rc_cache[$secureName] = array();
			}

			array_push( $this->rc_cache[$secureName], $cacheEntry );
		}
	}

	/**
	 * Enhanced RC group
	 * @param RCCacheEntry[] $block
	 * @return string
	 */
	protected function recentChangesBlockGroup( $block ) {
		global $wgRCShowChangedSize;

		wfProfileIn( __METHOD__ );

		# Add the namespace and title of the block as part of the class
		$classes = array( 'mw-collapsible', 'mw-collapsed', 'mw-enhanced-rc' );
		if ( $block[0]->mAttribs['rc_log_type'] ) {
			# Log entry
			$classes[] = Sanitizer::escapeClass( 'mw-changeslist-log-'
				. $block[0]->mAttribs['rc_log_type'] );
		} else {
			$classes[] = Sanitizer::escapeClass( 'mw-changeslist-ns'
				. $block[0]->mAttribs['rc_namespace'] . '-' . $block[0]->mAttribs['rc_title'] );
		}
		$classes[] = $block[0]->watched && $block[0]->mAttribs['rc_timestamp'] >= $block[0]->watched
			? 'mw-changeslist-line-watched' : 'mw-changeslist-line-not-watched';
		$r = Html::openElement( 'table', array( 'class' => $classes ) ) .
			Html::openElement( 'tr' );

		# Collate list of users
		$userlinks = array();
		# Other properties
		$unpatrolled = false;
		$isnew = false;
		$allBots = true;
		$allMinors = true;
		$curId = $currentRevision = 0;
		# Some catalyst variables...
		$namehidden = true;
		$allLogs = true;
		$oldid = '';
		foreach ( $block as $rcObj ) {
			$oldid = $rcObj->mAttribs['rc_last_oldid'];
			if ( $rcObj->mAttribs['rc_type'] == RC_NEW ) {
				$isnew = true;
			}
			// If all log actions to this page were hidden, then don't
			// give the name of the affected page for this block!
			if ( !$this->isDeleted( $rcObj, LogPage::DELETED_ACTION ) ) {
				$namehidden = false;
			}
			$u = $rcObj->userlink;
			if ( !isset( $userlinks[$u] ) ) {
				$userlinks[$u] = 0;
			}
			if ( $rcObj->unpatrolled ) {
				$unpatrolled = true;
			}
			if ( $rcObj->mAttribs['rc_type'] != RC_LOG ) {
				$allLogs = false;
			}
			# Get the latest entry with a page_id and oldid
			# since logs may not have these.
			if ( !$curId && $rcObj->mAttribs['rc_cur_id'] ) {
				$curId = $rcObj->mAttribs['rc_cur_id'];
			}
			if ( !$currentRevision && $rcObj->mAttribs['rc_this_oldid'] ) {
				$currentRevision = $rcObj->mAttribs['rc_this_oldid'];
			}

			if ( !$rcObj->mAttribs['rc_bot'] ) {
				$allBots = false;
			}
			if ( !$rcObj->mAttribs['rc_minor'] ) {
				$allMinors = false;
			}

			$userlinks[$u]++;
		}

		# Sort the list and convert to text
		krsort( $userlinks );
		asort( $userlinks );
		$users = array();
		foreach ( $userlinks as $userlink => $count ) {
			$text = $userlink;
			$text .= $this->getLanguage()->getDirMark();
			if ( $count > 1 ) {
				// @todo FIXME: Hardcoded '×'. Should be a message.
				$formattedCount = $this->getLanguage()->formatNum( $count ) . '×';
				$text .= ' ' . $this->msg( 'parentheses' )->rawParams( $formattedCount )->escaped();
			}
			array_push( $users, $text );
		}

		$users = ' <span class="changedby">'
			. $this->msg( 'brackets' )->rawParams(
				implode( $this->message['semicolon-separator'], $users )
			)->escaped() . '</span>';

		$tl = '<span class="mw-collapsible-toggle mw-collapsible-arrow ' .
			'mw-enhancedchanges-arrow mw-enhancedchanges-arrow-space"></span>';
		$r .= "<td>$tl</td>";

		# Main line
		$r .= '<td class="mw-enhanced-rc">' . $this->recentChangesFlags( array(
			'newpage' => $isnew, # show, when one have this flag
			'minor' => $allMinors, # show only, when all have this flag
			'unpatrolled' => $unpatrolled, # show, when one have this flag
			'bot' => $allBots, # show only, when all have this flag
		) );

		# Timestamp
		$r .= '&#160;' . $block[0]->timestamp . '&#160;</td><td>';

		# Article link
		if ( $namehidden ) {
			$r .= ' <span class="history-deleted">' .
				$this->msg( 'rev-deleted-event' )->escaped() . '</span>';
		} elseif ( $allLogs ) {
			$r .= $this->maybeWatchedLink( $block[0]->link, $block[0]->watched );
		} else {
			$this->insertArticleLink( $r, $block[0], $block[0]->unpatrolled, $block[0]->watched );
		}

		$r .= $this->getLanguage()->getDirMark();

		$queryParams['curid'] = $curId;

		# Changes message
		static $nchanges = array();
		static $sinceLastVisitMsg = array();

		$n = count( $block );
		if ( !isset( $nchanges[$n] ) ) {
			$nchanges[$n] = $this->msg( 'nchanges' )->numParams( $n )->escaped();
		}

		$sinceLast = 0;
		$unvisitedOldid = null;
		/** @var $rcObj RCCacheEntry */
		foreach ( $block as $rcObj ) {
			// Same logic as below inside main foreach
			if ( $rcObj->watched && $rcObj->mAttribs['rc_timestamp'] >= $rcObj->watched ) {
				$sinceLast++;
				$unvisitedOldid = $rcObj->mAttribs['rc_last_oldid'];
			}
		}
		if ( !isset( $sinceLastVisitMsg[$sinceLast] ) ) {
			$sinceLastVisitMsg[$sinceLast] =
				$this->msg( 'enhancedrc-since-last-visit' )->numParams( $sinceLast )->escaped();
		}

		# Total change link
		$r .= ' ';
		$logtext = '';
		/** @var $block0 RecentChange */
		$block0 = $block[0];
		if ( !$allLogs ) {
			if ( !ChangesList::userCan( $rcObj, Revision::DELETED_TEXT, $this->getUser() ) ) {
				$logtext .= $nchanges[$n];
			} elseif ( $isnew ) {
				$logtext .= $nchanges[$n];
			} else {
				$logtext .= Linker::link(
					$block0->getTitle(),
					$nchanges[$n],
					array(),
					$queryParams + array(
						'diff' => $currentRevision,
						'oldid' => $oldid,
					),
					array( 'known', 'noclasses' )
				);
				if ( $sinceLast > 0 && $sinceLast < $n ) {
					$logtext .= $this->message['pipe-separator'] . Linker::link(
						$block0->getTitle(),
						$sinceLastVisitMsg[$sinceLast],
						array(),
						$queryParams + array(
							'diff' => $currentRevision,
							'oldid' => $unvisitedOldid,
						),
						array( 'known', 'noclasses' )
					);
				}
			}
		}

		# History
		if ( $allLogs ) {
			// don't show history link for logs
		} elseif ( $namehidden || !$block0->getTitle()->exists() ) {
			$logtext .= $this->message['pipe-separator'] . $this->message['enhancedrc-history'];
		} else {
			$params = $queryParams;
			$params['action'] = 'history';

			$logtext .= $this->message['pipe-separator'] .
				Linker::linkKnown(
					$block0->getTitle(),
					$this->message['enhancedrc-history'],
					array(),
					$params
				);
		}

		if ( $logtext !== '' ) {
			$r .= $this->msg( 'parentheses' )->rawParams( $logtext )->escaped();
		}

		$r .= ' <span class="mw-changeslist-separator">. .</span> ';

		# Character difference (does not apply if only log items)
		if ( $wgRCShowChangedSize && !$allLogs ) {
			$last = 0;
			$first = count( $block ) - 1;
			# Some events (like logs) have an "empty" size, so we need to skip those...
			while ( $last < $first && $block[$last]->mAttribs['rc_new_len'] === null ) {
				$last++;
			}
			while ( $first > $last && $block[$first]->mAttribs['rc_old_len'] === null ) {
				$first--;
			}
			# Get net change
			$chardiff = $this->formatCharacterDifference( $block[$first], $block[$last] );

			if ( $chardiff == '' ) {
				$r .= ' ';
			} else {
				$r .= ' ' . $chardiff . ' <span class="mw-changeslist-separator">. .</span> ';
			}
		}

		$r .= $users;
		$r .= $this->numberofWatchingusers( $block0->numberofWatchingusers );
		$r .= '</td></tr>';

		# Sub-entries
		foreach ( $block as $rcObj ) {
			# Classes to apply -- TODO implement
			$classes = array();
			$type = $rcObj->mAttribs['rc_type'];

			$trClass = $rcObj->watched && $rcObj->mAttribs['rc_timestamp'] >= $rcObj->watched
				? ' class="mw-enhanced-watched"' : '';

			$r .= '<tr' . $trClass . '><td></td><td class="mw-enhanced-rc">';
			$r .= $this->recentChangesFlags( array(
				'newpage' => $type == RC_NEW,
				'minor' => $rcObj->mAttribs['rc_minor'],
				'unpatrolled' => $rcObj->unpatrolled,
				'bot' => $rcObj->mAttribs['rc_bot'],
			) );
			$r .= '&#160;</td><td class="mw-enhanced-rc-nested"><span class="mw-enhanced-rc-time">';

			$params = $queryParams;

			if ( $rcObj->mAttribs['rc_this_oldid'] != 0 ) {
				$params['oldid'] = $rcObj->mAttribs['rc_this_oldid'];
			}

			# Log timestamp
			if ( $type == RC_LOG ) {
				$link = $rcObj->timestamp;
			# Revision link
			} elseif ( !ChangesList::userCan( $rcObj, Revision::DELETED_TEXT, $this->getUser() ) ) {
				$link = '<span class="history-deleted">' . $rcObj->timestamp . '</span> ';
			} else {

				$link = Linker::linkKnown(
					$rcObj->getTitle(),
					$rcObj->timestamp,
					array(),
					$params
				);
				if ( $this->isDeleted( $rcObj, Revision::DELETED_TEXT ) ) {
					$link = '<span class="history-deleted">' . $link . '</span> ';
				}
			}
			$r .= $link . '</span>';

			if ( !$type == RC_LOG || $type == RC_NEW ) {
				$r .= ' ' . $this->msg( 'parentheses' )->rawParams(
					$rcObj->curlink .
						$this->message['pipe-separator'] .
						$rcObj->lastlink
				)->escaped();
			}
			$r .= ' <span class="mw-changeslist-separator">. .</span> ';

			# Character diff
			if ( $wgRCShowChangedSize ) {
				$cd = $this->formatCharacterDifference( $rcObj );
				if ( $cd !== '' ) {
					$r .= $cd . ' <span class="mw-changeslist-separator">. .</span> ';
				}
			}

			if ( $rcObj->mAttribs['rc_type'] == RC_LOG ) {
				$r .= $this->insertLogEntry( $rcObj );
			} else {
				# User links
				$r .= $rcObj->userlink;
				$r .= $rcObj->usertalklink;
				$r .= $this->insertComment( $rcObj );
			}

			# Rollback
			$this->insertRollback( $r, $rcObj );
			# Tags
			$this->insertTags( $r, $rcObj, $classes );

			$r .= "</td></tr>\n";
		}
		$r .= "</table>\n";

		$this->rcCacheIndex++;

		wfProfileOut( __METHOD__ );

		return $r;
	}

	/**
	 * Generate HTML for an arrow or placeholder graphic
	 * @param string $dir One of '', 'd', 'l', 'r'
	 * @param string $alt
	 * @param string $title
	 * @return string HTML "<img>" tag
	 */
	protected function arrow( $dir, $alt = '', $title = '' ) {
		global $wgStylePath;
		$encUrl = htmlspecialchars( $wgStylePath . '/common/images/Arr_' . $dir . '.png' );
		$encAlt = htmlspecialchars( $alt );
		$encTitle = htmlspecialchars( $title );

		return "<img src=\"$encUrl\" width=\"12\" height=\"12\" alt=\"$encAlt\" title=\"$encTitle\" />";
	}

	/**
	 * Generate HTML for a right- or left-facing arrow,
	 * depending on language direction.
	 * @return string HTML "<img>" tag
	 */
	protected function sideArrow() {
		$dir = $this->getLanguage()->isRTL() ? 'l' : 'r';

		return $this->arrow( $dir, '+', $this->msg( 'rc-enhanced-expand' )->text() );
	}

	/**
	 * Generate HTML for a down-facing arrow
	 * depending on language direction.
	 * @return string HTML "<img>" tag
	 */
	protected function downArrow() {
		return $this->arrow( 'd', '-', $this->msg( 'rc-enhanced-hide' )->text() );
	}

	/**
	 * Generate HTML for a spacer image
	 * @return string HTML "<img>" tag
	 */
	protected function spacerArrow() {
		return $this->arrow( '', codepointToUtf8( 0xa0 ) ); // non-breaking space
	}

	/**
	 * Enhanced RC ungrouped line.
	 *
	 * @param RecentChange|RCCacheEntry $rcObj
	 * @return string A HTML formatted line (generated using $r)
	 */
	protected function recentChangesBlockLine( $rcObj ) {
		global $wgRCShowChangedSize;

		wfProfileIn( __METHOD__ );
		$query['curid'] = $rcObj->mAttribs['rc_cur_id'];

		$type = $rcObj->mAttribs['rc_type'];
		$logType = $rcObj->mAttribs['rc_log_type'];
		$classes = array( 'mw-enhanced-rc' );
		if ( $logType ) {
			# Log entry
			$classes[] = Sanitizer::escapeClass( 'mw-changeslist-log-' . $logType );
		} else {
			$classes[] = Sanitizer::escapeClass( 'mw-changeslist-ns' .
				$rcObj->mAttribs['rc_namespace'] . '-' . $rcObj->mAttribs['rc_title'] );
		}
		$classes[] = $rcObj->watched && $rcObj->mAttribs['rc_timestamp'] >= $rcObj->watched
			? 'mw-changeslist-line-watched' : 'mw-changeslist-line-not-watched';
		$r = Html::openElement( 'table', array( 'class' => $classes ) ) .
			Html::openElement( 'tr' );

		$r .= '<td class="mw-enhanced-rc"><span class="mw-enhancedchanges-arrow-space"></span>';
		# Flag and Timestamp
		if ( $type == RC_MOVE || $type == RC_MOVE_OVER_REDIRECT ) {
			$r .= $this->recentChangesFlags( array() ); // no flags, but need the placeholders
		} else {
			$r .= $this->recentChangesFlags( array(
				'newpage' => $type == RC_NEW,
				'minor' => $rcObj->mAttribs['rc_minor'],
				'unpatrolled' => $rcObj->unpatrolled,
				'bot' => $rcObj->mAttribs['rc_bot'],
			) );
		}
		$r .= '&#160;' . $rcObj->timestamp . '&#160;</td><td>';
		# Article or log link
		if ( $logType ) {
			$logPage = new LogPage( $logType );
			$logTitle = SpecialPage::getTitleFor( 'Log', $logType );
			$logName = $logPage->getName()->escaped();
			$r .= $this->msg( 'parentheses' )
				->rawParams( Linker::linkKnown( $logTitle, $logName ) )->escaped();
		} else {
			$this->insertArticleLink( $r, $rcObj, $rcObj->unpatrolled, $rcObj->watched );
		}
		# Diff and hist links
		if ( $type != RC_LOG ) {
			$query['action'] = 'history';
			$r .= ' ' . $this->msg( 'parentheses' )
				->rawParams( $rcObj->difflink . $this->message['pipe-separator'] . Linker::linkKnown(
					$rcObj->getTitle(),
					$this->message['hist'],
					array(),
					$query
				) )->escaped();
		}
		$r .= ' <span class="mw-changeslist-separator">. .</span> ';
		# Character diff
		if ( $wgRCShowChangedSize ) {
			$cd = $this->formatCharacterDifference( $rcObj );
			if ( $cd !== '' ) {
				$r .= $cd . ' <span class="mw-changeslist-separator">. .</span> ';
			}
		}

		if ( $type == RC_LOG ) {
			$r .= $this->insertLogEntry( $rcObj );
		} else {
			$r .= ' ' . $rcObj->userlink . $rcObj->usertalklink;
			$r .= $this->insertComment( $rcObj );
			$this->insertRollback( $r, $rcObj );
		}

		# Tags
		$this->insertTags( $r, $rcObj, $classes );
		# Show how many people are watching this if enabled
		$r .= $this->numberofWatchingusers( $rcObj->numberofWatchingusers );

		$r .= "</td></tr></table>\n";

		wfProfileOut( __METHOD__ );

		return $r;
	}

	/**
	 * If enhanced RC is in use, this function takes the previously cached
	 * RC lines, arranges them, and outputs the HTML
	 *
	 * @return string
	 */
	protected function recentChangesBlock() {
		if ( count( $this->rc_cache ) == 0 ) {
			return '';
		}

		wfProfileIn( __METHOD__ );

		$blockOut = '';
		foreach ( $this->rc_cache as $block ) {
			if ( count( $block ) < 2 ) {
				$blockOut .= $this->recentChangesBlockLine( array_shift( $block ) );
			} else {
				$blockOut .= $this->recentChangesBlockGroup( $block );
			}
		}

		wfProfileOut( __METHOD__ );

		return '<div>' . $blockOut . '</div>';
	}

	/**
	 * Returns text for the end of RC
	 * If enhanced RC is in use, returns pretty much all the text
	 * @return string
	 */
	public function endRecentChangesList() {
		return $this->recentChangesBlock() . '</div>';
	}
}
