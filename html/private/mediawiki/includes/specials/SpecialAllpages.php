<?php
/**
 * Implements Special:Allpages
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
 * @ingroup SpecialPage
 */

/**
 * Implements Special:Allpages
 *
 * @ingroup SpecialPage
 */
class SpecialAllpages extends IncludableSpecialPage {

	/**
	 * Maximum number of pages to show on single subpage.
	 *
	 * @var int $maxPerPage
	 */
	protected $maxPerPage = 345;

	/**
	 * Maximum number of pages to show on single index subpage.
	 *
	 * @var int $maxLineCount
	 */
	protected $maxLineCount = 100;

	/**
	 * Maximum number of chars to show for an entry.
	 *
	 * @var int $maxPageLength
	 */
	protected $maxPageLength = 70;

	/**
	 * Maximum number of pages in a hierarchical ("top level") list.
	 *
	 * Traversal of the entire page list by spidering the top levels is thought
	 * to require O(N^3) DB CPU time where N is the number of pages on the wiki.
	 * See bug 56840. If this limit is exceeded, the behaviour becomes like a
	 * simple alphabetic pager.
	 */
	protected $maxTopLevelPages = 50000;

	/**
	 * Determines, which message describes the input field 'nsfrom'.
	 *
	 * @var string $nsfromMsg
	 */
	protected $nsfromMsg = 'allpagesfrom';

	/**
	 * Constructor
	 *
	 * @param string $name name of the special page, as seen in links and URLs (default: 'Allpages')
	 */
	function __construct( $name = 'Allpages' ) {
		parent::__construct( $name );
	}

	/**
	 * Entry point : initialise variables and call subfunctions.
	 *
	 * @param string $par becomes "FOO" when called like Special:Allpages/FOO (default NULL)
	 */
	function execute( $par ) {
		$request = $this->getRequest();
		$out = $this->getOutput();

		$this->setHeaders();
		$this->outputHeader();
		$out->allowClickjacking();

		# GET values
		$from = $request->getVal( 'from', null );
		$to = $request->getVal( 'to', null );
		$namespace = $request->getInt( 'namespace' );
		$hideredirects = $request->getBool( 'hideredirects', false );

		$namespaces = $this->getContext()->getLanguage()->getNamespaces();

		$out->setPageTitle(
			( $namespace > 0 && array_key_exists( $namespace, $namespaces ) ) ?
				$this->msg( 'allinnamespace', str_replace( '_', ' ', $namespaces[$namespace] ) ) :
				$this->msg( 'allarticles' )
		);
		$out->addModuleStyles( 'mediawiki.special' );

		if ( $par !== null ) {
			$this->showChunk( $namespace, $par, $to, $hideredirects );
		} elseif ( $from !== null && $to === null ) {
			$this->showChunk( $namespace, $from, $to, $hideredirects );
		} else {
			$this->showToplevel( $namespace, $from, $to, $hideredirects );
		}
	}

	/**
	 * HTML for the top form
	 *
	 * @param $namespace Integer: a namespace constant (default NS_MAIN).
	 * @param string $from dbKey we are starting listing at.
	 * @param string $to dbKey we are ending listing at.
	 * @param bool $hideredirects dont show redirects  (default FALSE)
	 * @return string
	 */
	function namespaceForm( $namespace = NS_MAIN, $from = '', $to = '', $hideredirects = false ) {
		global $wgScript;
		$t = $this->getPageTitle();

		$out = Xml::openElement( 'div', array( 'class' => 'namespaceoptions' ) );
		$out .= Xml::openElement( 'form', array( 'method' => 'get', 'action' => $wgScript ) );
		$out .= Html::hidden( 'title', $t->getPrefixedText() );
		$out .= Xml::openElement( 'fieldset' );
		$out .= Xml::element( 'legend', null, $this->msg( 'allpages' )->text() );
		$out .= Xml::openElement( 'table', array( 'id' => 'nsselect', 'class' => 'allpages' ) );
		$out .= "<tr>
	<td class='mw-label'>" .
			Xml::label( $this->msg( 'allpagesfrom' )->text(), 'nsfrom' ) .
			"	</td>
	<td class='mw-input'>" .
			Xml::input( 'from', 30, str_replace( '_', ' ', $from ), array( 'id' => 'nsfrom' ) ) .
			"	</td>
</tr>
<tr>
	<td class='mw-label'>" .
			Xml::label( $this->msg( 'allpagesto' )->text(), 'nsto' ) .
			"	</td>
			<td class='mw-input'>" .
			Xml::input( 'to', 30, str_replace( '_', ' ', $to ), array( 'id' => 'nsto' ) ) .
			"		</td>
</tr>
<tr>
	<td class='mw-label'>" .
			Xml::label( $this->msg( 'namespace' )->text(), 'namespace' ) .
			"	</td>
			<td class='mw-input'>" .
			Html::namespaceSelector(
				array( 'selected' => $namespace ),
				array( 'name' => 'namespace', 'id' => 'namespace' )
			) . ' ' .
			Xml::checkLabel(
				$this->msg( 'allpages-hide-redirects' )->text(),
				'hideredirects',
				'hideredirects',
				$hideredirects
			) . ' ' .
			Xml::submitButton( $this->msg( 'allpagessubmit' )->text() ) .
			"	</td>
</tr>";
		$out .= Xml::closeElement( 'table' );
		$out .= Xml::closeElement( 'fieldset' );
		$out .= Xml::closeElement( 'form' );
		$out .= Xml::closeElement( 'div' );

		return $out;
	}

	/**
	 * @param $namespace Integer (default NS_MAIN)
	 * @param string $from list all pages from this name
	 * @param string $to list all pages to this name
	 * @param bool $hideredirects dont show redirects (default FALSE)
	 */
	function showToplevel( $namespace = NS_MAIN, $from = '', $to = '', $hideredirects = false ) {
		$output = $this->getOutput();

		# TODO: Either make this *much* faster or cache the title index points
		# in the querycache table.

		$dbr = wfGetDB( DB_SLAVE );
		$out = "";
		$where = array( 'page_namespace' => $namespace );

		if ( $hideredirects ) {
			$where['page_is_redirect'] = 0;
		}

		$from = Title::makeTitleSafe( $namespace, $from );
		$to = Title::makeTitleSafe( $namespace, $to );
		$from = ( $from && $from->isLocal() ) ? $from->getDBkey() : null;
		$to = ( $to && $to->isLocal() ) ? $to->getDBkey() : null;

		if ( isset( $from ) ) {
			$where[] = 'page_title >= ' . $dbr->addQuotes( $from );
		}

		if ( isset( $to ) ) {
			$where[] = 'page_title <= ' . $dbr->addQuotes( $to );
		}

		global $wgMemc;
		$key = wfMemcKey( 'allpages', 'ns', $namespace, sha1( $from ), sha1( $to ) );
		$lines = $wgMemc->get( $key );

		$count = $dbr->estimateRowCount( 'page', '*', $where, __METHOD__ );

		// Don't show a hierarchical list if the number of pages is very large,
		// since generating it will cause a lot of scanning
		if ( $count > $this->maxTopLevelPages ) {
			$this->showChunk( $namespace, $from, $to, $hideredirects );

			return;
		}

		$maxPerSubpage = intval( $count / $this->maxLineCount );
		$maxPerSubpage = max( $maxPerSubpage, $this->maxPerPage );

		if ( !is_array( $lines ) ) {
			$options = array( 'LIMIT' => 1 );
			$options['ORDER BY'] = 'page_title ASC';
			$firstTitle = $dbr->selectField( 'page', 'page_title', $where, __METHOD__, $options );
			$lastTitle = $firstTitle;
			# This array is going to hold the page_titles in order.
			$lines = array( $firstTitle );
			# If we are going to show n rows, we need n+1 queries to find the relevant titles.
			$done = false;
			while ( !$done ) {
				// Fetch the last title of this chunk and the first of the next
				$chunk = ( $lastTitle === false )
					? array()
					: array( 'page_title >= ' . $dbr->addQuotes( $lastTitle ) );
				$res = $dbr->select( 'page', /* FROM */
					'page_title', /* WHAT */
					array_merge( $where, $chunk ),
					__METHOD__,
					array( 'LIMIT' => 2, 'OFFSET' => $maxPerSubpage - 1, 'ORDER BY' => 'page_title ASC' )
				);

				$s = $dbr->fetchObject( $res );
				if ( $s ) {
					array_push( $lines, $s->page_title );
				} else {
					// Final chunk, but ended prematurely. Go back and find the end.
					$endTitle = $dbr->selectField( 'page', 'MAX(page_title)',
						array_merge( $where, $chunk ),
						__METHOD__ );
					array_push( $lines, $endTitle );
					$done = true;
				}

				$s = $res->fetchObject();
				if ( $s ) {
					array_push( $lines, $s->page_title );
					$lastTitle = $s->page_title;
				} else {
					// This was a final chunk and ended exactly at the limit.
					// Rare but convenient!
					$done = true;
				}
				$res->free();
			}
			$wgMemc->add( $key, $lines, 3600 );
		}

		// If there are only two or less sections, don't even display them.
		// Instead, display the first section directly.
		if ( count( $lines ) <= 2 ) {
			if ( !empty( $lines ) ) {
				$this->showChunk( $namespace, $from, $to, $hideredirects );
			} else {
				$output->addHTML( $this->namespaceForm( $namespace, $from, $to, $hideredirects ) );
			}

			return;
		}

		# At this point, $lines should contain an even number of elements.
		$out .= Xml::openElement( 'table', array( 'class' => 'allpageslist' ) );
		while ( count( $lines ) > 0 ) {
			$inpoint = array_shift( $lines );
			$outpoint = array_shift( $lines );
			$out .= $this->showline( $inpoint, $outpoint, $namespace, $hideredirects );
		}
		$out .= Xml::closeElement( 'table' );
		$nsForm = $this->namespaceForm( $namespace, $from, $to, $hideredirects );

		# Is there more?
		if ( $this->including() ) {
			$out2 = '';
		} else {
			if ( isset( $from ) || isset( $to ) ) {
				$out2 = Xml::openElement( 'table', array( 'class' => 'mw-allpages-table-form' ) ) .
					'<tr>
							<td>' .
					$nsForm .
					'</td>
							<td class="mw-allpages-nav">' .
					Linker::link( $this->getPageTitle(), $this->msg( 'allpages' )->escaped(),
						array(), array(), 'known' ) .
					"</td>
						</tr>" .
					Xml::closeElement( 'table' );
			} else {
				$out2 = $nsForm;
			}
		}
		$output->addHTML( $out2 . $out );
	}

	/**
	 * Show a line of "ABC to DEF" ranges of articles
	 *
	 * @param string $inpoint lower limit of pagenames
	 * @param string $outpoint upper limit of pagenames
	 * @param $namespace Integer (Default NS_MAIN)
	 * @param bool $hideRedirects don't show redirects. Default: false
	 * @return string
	 */
	function showline( $inpoint, $outpoint, $namespace = NS_MAIN, $hideRedirects = false ) {
		// Use content language since page titles are considered to use content language
		global $wgContLang;

		$inpointf = str_replace( '_', ' ', $inpoint );
		$outpointf = str_replace( '_', ' ', $outpoint );

		// Don't let the length runaway
		$inpointf = $wgContLang->truncate( $inpointf, $this->maxPageLength );
		$outpointf = $wgContLang->truncate( $outpointf, $this->maxPageLength );

		$queryParams = array(
			'from' => $inpoint,
			'to' => $outpoint,
		);

		if ( $namespace ) {
			$queryParams['namespace'] = $namespace;
		}
		if ( $hideRedirects ) {
			$queryParams['hideredirects'] = 1;
		}

		$url = $this->getPageTitle()->getLocalURL( $queryParams );
		$inlink = Html::element( 'a', array( 'href' => $url ), $inpointf );
		$outlink = Html::element( 'a', array( 'href' => $url ), $outpointf );

		$out = $this->msg( 'alphaindexline' )->rawParams(
			"$inlink</td><td>",
			"</td><td>$outlink"
		)->escaped();

		return '<tr><td class="mw-allpages-alphaindexline">' . $out . '</td></tr>';
	}

	/**
	 * @param int $namespace Namespace (Default NS_MAIN)
	 * @param string $from list all pages from this name (default FALSE)
	 * @param string $to list all pages to this name (default FALSE)
	 * @param bool $hideredirects dont show redirects (default FALSE)
	 */
	function showChunk( $namespace = NS_MAIN, $from = false, $to = false, $hideredirects = false ) {
		$output = $this->getOutput();

		$fromList = $this->getNamespaceKeyAndText( $namespace, $from );
		$toList = $this->getNamespaceKeyAndText( $namespace, $to );
		$namespaces = $this->getContext()->getLanguage()->getNamespaces();
		$n = 0;

		if ( !$fromList || !$toList ) {
			$out = $this->msg( 'allpagesbadtitle' )->parseAsBlock();
		} elseif ( !array_key_exists( $namespace, $namespaces ) ) {
			// Show errormessage and reset to NS_MAIN
			$out = $this->msg( 'allpages-bad-ns', $namespace )->parse();
			$namespace = NS_MAIN;
		} else {
			list( $namespace, $fromKey, $from ) = $fromList;
			list( , $toKey, $to ) = $toList;

			$dbr = wfGetDB( DB_SLAVE );
			$conds = array(
				'page_namespace' => $namespace,
				'page_title >= ' . $dbr->addQuotes( $fromKey )
			);

			if ( $hideredirects ) {
				$conds['page_is_redirect'] = 0;
			}

			if ( $toKey !== "" ) {
				$conds[] = 'page_title <= ' . $dbr->addQuotes( $toKey );
			}

			$res = $dbr->select( 'page',
				array( 'page_namespace', 'page_title', 'page_is_redirect', 'page_id' ),
				$conds,
				__METHOD__,
				array(
					'ORDER BY' => 'page_title',
					'LIMIT' => $this->maxPerPage + 1,
					'USE INDEX' => 'name_title',
				)
			);

			if ( $res->numRows() > 0 ) {
				$out = Xml::openElement( 'table', array( 'class' => 'mw-allpages-table-chunk' ) );
				while ( ( $n < $this->maxPerPage ) && ( $s = $res->fetchObject() ) ) {
					$t = Title::newFromRow( $s );
					if ( $t ) {
						$link = ( $s->page_is_redirect ? '<div class="allpagesredirect">' : '' ) .
							Linker::link( $t ) .
							( $s->page_is_redirect ? '</div>' : '' );
					} else {
						$link = '[[' . htmlspecialchars( $s->page_title ) . ']]';
					}

					if ( $n % 3 == 0 ) {
						$out .= '<tr>';
					}

					$out .= "<td style=\"width:33%\">$link</td>";
					$n++;
					if ( $n % 3 == 0 ) {
						$out .= "</tr>\n";
					}
				}

				if ( ( $n % 3 ) != 0 ) {
					$out .= "</tr>\n";
				}
				$out .= Xml::closeElement( 'table' );
			} else {
				$out = '';
			}
		}

		if ( $this->including() ) {
			$out2 = '';
		} else {
			if ( $from == '' ) {
				// First chunk; no previous link.
				$prevTitle = null;
			} else {
				# Get the last title from previous chunk
				$dbr = wfGetDB( DB_SLAVE );
				$res_prev = $dbr->select(
					'page',
					'page_title',
					array( 'page_namespace' => $namespace, 'page_title < ' . $dbr->addQuotes( $from ) ),
					__METHOD__,
					array( 'ORDER BY' => 'page_title DESC',
						'LIMIT' => $this->maxPerPage, 'OFFSET' => ( $this->maxPerPage - 1 )
					)
				);

				# Get first title of previous complete chunk
				if ( $dbr->numrows( $res_prev ) >= $this->maxPerPage ) {
					$pt = $dbr->fetchObject( $res_prev );
					$prevTitle = Title::makeTitle( $namespace, $pt->page_title );
				} else {
					# The previous chunk is not complete, need to link to the very first title
					# available in the database
					$options = array( 'LIMIT' => 1 );
					if ( !$dbr->implicitOrderby() ) {
						$options['ORDER BY'] = 'page_title';
					}
					$reallyFirstPage_title = $dbr->selectField( 'page', 'page_title',
						array( 'page_namespace' => $namespace ), __METHOD__, $options );
					# Show the previous link if it s not the current requested chunk
					if ( $from != $reallyFirstPage_title ) {
						$prevTitle = Title::makeTitle( $namespace, $reallyFirstPage_title );
					} else {
						$prevTitle = null;
					}
				}
			}

			$self = $this->getPageTitle();

			$nsForm = $this->namespaceForm( $namespace, $from, $to, $hideredirects );
			$out2 = Xml::openElement( 'table', array( 'class' => 'mw-allpages-table-form' ) ) .
				'<tr>
							<td>' .
				$nsForm .
				'</td>
							<td class="mw-allpages-nav">' .
				Linker::link( $self, $this->msg( 'allpages' )->escaped() );

			# Do we put a previous link ?
			if ( isset( $prevTitle ) && $pt = $prevTitle->getText() ) {
				$query = array( 'from' => $prevTitle->getText() );

				if ( $namespace ) {
					$query['namespace'] = $namespace;
				}

				if ( $hideredirects ) {
					$query['hideredirects'] = $hideredirects;
				}

				$prevLink = Linker::linkKnown(
					$self,
					$this->msg( 'prevpage', $pt )->escaped(),
					array(),
					$query
				);
				$out2 = $this->getLanguage()->pipeList( array( $out2, $prevLink ) );
			}

			if ( $n == $this->maxPerPage && $s = $res->fetchObject() ) {
				# $s is the first link of the next chunk
				$t = Title::makeTitle( $namespace, $s->page_title );
				$query = array( 'from' => $t->getText() );

				if ( $namespace ) {
					$query['namespace'] = $namespace;
				}

				if ( $hideredirects ) {
					$query['hideredirects'] = $hideredirects;
				}

				$nextLink = Linker::linkKnown(
					$self,
					$this->msg( 'nextpage', $t->getText() )->escaped(),
					array(),
					$query
				);
				$out2 = $this->getLanguage()->pipeList( array( $out2, $nextLink ) );
			}
			$out2 .= "</td></tr></table>";
		}

		$output->addHTML( $out2 . $out );

		$links = array();
		if ( isset( $prevLink ) ) {
			$links[] = $prevLink;
		}

		if ( isset( $nextLink ) ) {
			$links[] = $nextLink;
		}

		if ( count( $links ) ) {
			$output->addHTML(
				Html::element( 'hr' ) .
					Html::rawElement( 'div', array( 'class' => 'mw-allpages-nav' ),
						$this->getLanguage()->pipeList( $links )
					)
			);
		}
	}

	/**
	 * @param $ns Integer: the namespace of the article
	 * @param string $text the name of the article
	 * @return array( int namespace, string dbkey, string pagename ) or NULL on error
	 */
	protected function getNamespaceKeyAndText( $ns, $text ) {
		if ( $text == '' ) {
			# shortcut for common case
			return array( $ns, '', '' );
		}

		$t = Title::makeTitleSafe( $ns, $text );
		if ( $t && $t->isLocal() ) {
			return array( $t->getNamespace(), $t->getDBkey(), $t->getText() );
		} elseif ( $t ) {
			return null;
		}

		# try again, in case the problem was an empty pagename
		$text = preg_replace( '/(#|$)/', 'X$1', $text );
		$t = Title::makeTitleSafe( $ns, $text );
		if ( $t && $t->isLocal() ) {
			return array( $t->getNamespace(), '', '' );
		} else {
			return null;
		}
	}

	protected function getGroupName() {
		return 'pages';
	}
}
