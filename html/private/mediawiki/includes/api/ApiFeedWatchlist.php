<?php
/**
 *
 *
 * Created on Oct 13, 2006
 *
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
 * This action allows users to get their watchlist items in RSS/Atom formats.
 * When executed, it performs a nested call to the API to get the needed data,
 * and formats it in a proper format.
 *
 * @ingroup API
 */
class ApiFeedWatchlist extends ApiBase {

	private $watchlistModule = null;
	private $linkToDiffs = false;
	private $linkToSections = false;

	/**
	 * This module uses a custom feed wrapper printer.
	 *
	 * @return ApiFormatFeedWrapper
	 */
	public function getCustomPrinter() {
		return new ApiFormatFeedWrapper( $this->getMain() );
	}

	/**
	 * Make a nested call to the API to request watchlist items in the last $hours.
	 * Wrap the result as an RSS/Atom feed.
	 */
	public function execute() {
		global $wgFeed, $wgFeedClasses, $wgFeedLimit, $wgSitename, $wgLanguageCode;

		try {
			$params = $this->extractRequestParams();

			if ( !$wgFeed ) {
				$this->dieUsage( 'Syndication feeds are not available', 'feed-unavailable' );
			}

			if ( !isset( $wgFeedClasses[$params['feedformat']] ) ) {
				$this->dieUsage( 'Invalid subscription feed type', 'feed-invalid' );
			}

			// limit to the number of hours going from now back
			$endTime = wfTimestamp( TS_MW, time() - intval( $params['hours'] * 60 * 60 ) );

			// Prepare parameters for nested request
			$fauxReqArr = array(
				'action' => 'query',
				'meta' => 'siteinfo',
				'siprop' => 'general',
				'list' => 'watchlist',
				'wlprop' => 'title|user|comment|timestamp',
				'wldir' => 'older', // reverse order - from newest to oldest
				'wlend' => $endTime, // stop at this time
				'wllimit' => min( 50, $wgFeedLimit )
			);

			if ( $params['wlowner'] !== null ) {
				$fauxReqArr['wlowner'] = $params['wlowner'];
			}
			if ( $params['wltoken'] !== null ) {
				$fauxReqArr['wltoken'] = $params['wltoken'];
			}
			if ( $params['wlexcludeuser'] !== null ) {
				$fauxReqArr['wlexcludeuser'] = $params['wlexcludeuser'];
			}
			if ( $params['wlshow'] !== null ) {
				$fauxReqArr['wlshow'] = $params['wlshow'];
			}
			if ( $params['wltype'] !== null ) {
				$fauxReqArr['wltype'] = $params['wltype'];
			}

			// Support linking to diffs instead of article
			if ( $params['linktodiffs'] ) {
				$this->linkToDiffs = true;
				$fauxReqArr['wlprop'] .= '|ids';
			}

			// Support linking directly to sections when possible
			// (possible only if section name is present in comment)
			if ( $params['linktosections'] ) {
				$this->linkToSections = true;
			}

			// Check for 'allrev' parameter, and if found, show all revisions to each page on wl.
			if ( $params['allrev'] ) {
				$fauxReqArr['wlallrev'] = '';
			}

			// Create the request
			$fauxReq = new FauxRequest( $fauxReqArr );

			// Execute
			$module = new ApiMain( $fauxReq );
			$module->execute();

			// Get data array
			$data = $module->getResultData();

			$feedItems = array();
			foreach ( (array)$data['query']['watchlist'] as $info ) {
				$feedItems[] = $this->createFeedItem( $info );
			}

			$msg = wfMessage( 'watchlist' )->inContentLanguage()->text();

			$feedTitle = $wgSitename . ' - ' . $msg . ' [' . $wgLanguageCode . ']';
			$feedUrl = SpecialPage::getTitleFor( 'Watchlist' )->getFullURL();

			$feed = new $wgFeedClasses[$params['feedformat']] (
				$feedTitle,
				htmlspecialchars( $msg ),
				$feedUrl
			);

			ApiFormatFeedWrapper::setResult( $this->getResult(), $feed, $feedItems );
		} catch ( Exception $e ) {
			// Error results should not be cached
			$this->getMain()->setCacheMaxAge( 0 );

			// @todo FIXME: Localise  brackets
			$feedTitle = $wgSitename . ' - Error - ' .
				wfMessage( 'watchlist' )->inContentLanguage()->text() .
				' [' . $wgLanguageCode . ']';
			$feedUrl = SpecialPage::getTitleFor( 'Watchlist' )->getFullURL();

			$feedFormat = isset( $params['feedformat'] ) ? $params['feedformat'] : 'rss';
			$msg = wfMessage( 'watchlist' )->inContentLanguage()->escaped();
			$feed = new $wgFeedClasses[$feedFormat] ( $feedTitle, $msg, $feedUrl );

			if ( $e instanceof UsageException ) {
				$errorCode = $e->getCodeString();
			} else {
				// Something is seriously wrong
				$errorCode = 'internal_api_error';
			}

			$errorText = $e->getMessage();
			$feedItems[] = new FeedItem( "Error ($errorCode)", $errorText, '', '', '' );
			ApiFormatFeedWrapper::setResult( $this->getResult(), $feed, $feedItems );
		}
	}

	/**
	 * @param $info array
	 * @return FeedItem
	 */
	private function createFeedItem( $info ) {
		$titleStr = $info['title'];
		$title = Title::newFromText( $titleStr );
		if ( $this->linkToDiffs && isset( $info['revid'] ) ) {
			$titleUrl = $title->getFullURL( array( 'diff' => $info['revid'] ) );
		} else {
			$titleUrl = $title->getFullURL();
		}
		$comment = isset( $info['comment'] ) ? $info['comment'] : null;

		// Create an anchor to section.
		// The anchor won't work for sections that have dupes on page
		// as there's no way to strip that info from ApiWatchlist (apparently?).
		// RegExp in the line below is equal to Linker::formatAutocomments().
		if ( $this->linkToSections && $comment !== null &&
			preg_match( '!(.*)/\*\s*(.*?)\s*\*/(.*)!', $comment, $matches )
		) {
			global $wgParser;

			$sectionTitle = $wgParser->stripSectionName( $matches[2] );
			$sectionTitle = Sanitizer::normalizeSectionNameWhitespace( $sectionTitle );
			$titleUrl .= Title::newFromText( '#' . $sectionTitle )->getFragmentForURL();
		}

		$timestamp = $info['timestamp'];
		$user = $info['user'];

		$completeText = "$comment ($user)";

		return new FeedItem( $titleStr, $completeText, $titleUrl, $timestamp, $user );
	}

	private function getWatchlistModule() {
		if ( $this->watchlistModule === null ) {
			$this->watchlistModule = $this->getMain()->getModuleManager()->getModule( 'query' )
				->getModuleManager()->getModule( 'watchlist' );
		}

		return $this->watchlistModule;
	}

	public function getAllowedParams( $flags = 0 ) {
		global $wgFeedClasses;
		$feedFormatNames = array_keys( $wgFeedClasses );
		$ret = array(
			'feedformat' => array(
				ApiBase::PARAM_DFLT => 'rss',
				ApiBase::PARAM_TYPE => $feedFormatNames
			),
			'hours' => array(
				ApiBase::PARAM_DFLT => 24,
				ApiBase::PARAM_TYPE => 'integer',
				ApiBase::PARAM_MIN => 1,
				ApiBase::PARAM_MAX => 72,
			),
			'linktodiffs' => false,
			'linktosections' => false,
		);
		if ( $flags ) {
			$wlparams = $this->getWatchlistModule()->getAllowedParams( $flags );
			$ret['allrev'] = $wlparams['allrev'];
			$ret['wlowner'] = $wlparams['owner'];
			$ret['wltoken'] = $wlparams['token'];
			$ret['wlshow'] = $wlparams['show'];
			$ret['wltype'] = $wlparams['type'];
			$ret['wlexcludeuser'] = $wlparams['excludeuser'];
		} else {
			$ret['allrev'] = null;
			$ret['wlowner'] = null;
			$ret['wltoken'] = null;
			$ret['wlshow'] = null;
			$ret['wltype'] = null;
			$ret['wlexcludeuser'] = null;
		}

		return $ret;
	}

	public function getParamDescription() {
		$wldescr = $this->getWatchlistModule()->getParamDescription();

		return array(
			'feedformat' => 'The format of the feed',
			'hours' => 'List pages modified within this many hours from now',
			'linktodiffs' => 'Link to change differences instead of article pages',
			'linktosections' => 'Link directly to changed sections if possible',
			'allrev' => $wldescr['allrev'],
			'wlowner' => $wldescr['owner'],
			'wltoken' => $wldescr['token'],
			'wlshow' => $wldescr['show'],
			'wltype' => $wldescr['type'],
			'wlexcludeuser' => $wldescr['excludeuser'],
		);
	}

	public function getDescription() {
		return 'Returns a watchlist feed.';
	}

	public function getPossibleErrors() {
		return array_merge( parent::getPossibleErrors(), array(
			array( 'code' => 'feed-unavailable', 'info' => 'Syndication feeds are not available' ),
			array( 'code' => 'feed-invalid', 'info' => 'Invalid subscription feed type' ),
		) );
	}

	public function getExamples() {
		return array(
			'api.php?action=feedwatchlist',
			'api.php?action=feedwatchlist&allrev=&linktodiffs=&hours=6'
		);
	}

	public function getHelpUrls() {
		return 'https://www.mediawiki.org/wiki/API:Watchlist_feed';
	}
}
