<?php
/**
 * Performs transformations of HTML by wrapping around libxml2 and working
 * around its countless bugs.
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
class HtmlFormatter {
	/**
	 * @var DOMDocument
	 */
	private $doc;

	private $html;
	private $itemsToRemove = array();
	private $elementsToFlatten = array();
	protected $removeMedia = false;

	/**
	 * Constructor
	 *
	 * @param string $html Text to process
	 */
	public function __construct( $html ) {
		$this->html = $html;
	}

	/**
	 * Turns a chunk of HTML into a proper document
	 * @param string $html
	 * @return string
	 */
	public static function wrapHTML( $html ) {
		return '<!doctype html><html><head></head><body>' . $html . '</body></html>';
	}

	/**
	 * Override this in descendant class to modify HTML after it has been converted from DOM tree
	 * @param string $html HTML to process
	 * @return string Processed HTML
	 */
	protected function onHtmlReady( $html ) {
		return $html;
	}

	/**
	 * @return DOMDocument DOM to manipulate
	 */
	public function getDoc() {
		if ( !$this->doc ) {
			$html = mb_convert_encoding( $this->html, 'HTML-ENTITIES', 'UTF-8' );

			// Workaround for bug that caused spaces before references
			// to disappear during processing:
			// https://bugzilla.wikimedia.org/show_bug.cgi?id=53086
			//
			// Please replace with a better fix if one can be found.
			$html = str_replace( ' <', '&#32;<', $html );

			libxml_use_internal_errors( true );
			$loader = libxml_disable_entity_loader();
			$this->doc = new DOMDocument();
			$this->doc->strictErrorChecking = false;
			$this->doc->loadHTML( $html );
			libxml_disable_entity_loader( $loader );
			libxml_use_internal_errors( false );
			$this->doc->encoding = 'UTF-8';
		}
		return $this->doc;
	}

	/**
	 * Sets whether images/videos/sounds should be removed from output
	 * @param bool $flag
	 */
	public function setRemoveMedia( $flag = true ) {
		$this->removeMedia = $flag;
	}

	/**
	 * Adds one or more selector of content to remove. A subset of CSS selector
	 * syntax is supported:
	 *
	 *   <tag>
	 *   <tag>.class
	 *   .<class>
	 *   #<id>
	 *
	 * @param array|string $selectors Selector(s) of stuff to remove
	 */
	public function remove( $selectors ) {
		$this->itemsToRemove = array_merge( $this->itemsToRemove, (array)$selectors );
	}

	/**
	 * Adds one or more element name to the list to flatten (remove tag, but not its content)
	 * Can accept undelimited regexes
	 *
	 * Note this interface may fail in surprising unexpected ways due to usage of regexes,
	 * so should not be relied on for HTML markup security measures.
	 *
	 * @param array|string $elements Name(s) of tag(s) to flatten
	 */
	public function flatten( $elements ) {
		$this->elementsToFlatten = array_merge( $this->elementsToFlatten, (array)$elements );
	}

	/**
	 * Instructs the formatter to flatten all tags
	 */
	public function flattenAllTags() {
		$this->flatten( '[?!]?[a-z0-9]+' );
	}

	/**
	 * Removes content we've chosen to remove.  The text of the removed elements can be
	 * extracted with the getText method.
	 * @return array Array of removed DOMElements
	 */
	public function filterContent() {
		wfProfileIn( __METHOD__ );
		$removals = $this->parseItemsToRemove();

		// Bail out early if nothing to do
		if ( array_reduce( $removals,
			function ( $carry, $item ) {
				return $carry && !$item;
			},
			true
		) ) {
			wfProfileOut( __METHOD__ );
			return array();
		}

		$doc = $this->getDoc();

		// Remove tags

		// You can't remove DOMNodes from a DOMNodeList as you're iterating
		// over them in a foreach loop. It will seemingly leave the internal
		// iterator on the foreach out of wack and results will be quite
		// strange. Though, making a queue of items to remove seems to work.
		$domElemsToRemove = array();
		foreach ( $removals['TAG'] as $tagToRemove ) {
			$tagToRemoveNodes = $doc->getElementsByTagName( $tagToRemove );
			foreach ( $tagToRemoveNodes as $tagToRemoveNode ) {
				if ( $tagToRemoveNode ) {
					$domElemsToRemove[] = $tagToRemoveNode;
				}
			}
		}
		$removed = $this->removeElements( $domElemsToRemove );

		// Elements with named IDs
		$domElemsToRemove = array();
		foreach ( $removals['ID'] as $itemToRemove ) {
			$itemToRemoveNode = $doc->getElementById( $itemToRemove );
			if ( $itemToRemoveNode ) {
				$domElemsToRemove[] = $itemToRemoveNode;
			}
		}
		$removed = array_merge( $removed, $this->removeElements( $domElemsToRemove ) );

		// CSS Classes
		$domElemsToRemove = array();
		$xpath = new DOMXpath( $doc );
		foreach ( $removals['CLASS'] as $classToRemove ) {
			$elements = $xpath->query( '//*[contains(@class, "' . $classToRemove . '")]' );

			/** @var $element DOMElement */
			foreach ( $elements as $element ) {
				$classes = $element->getAttribute( 'class' );
				if ( preg_match( "/\b$classToRemove\b/", $classes ) && $element->parentNode ) {
					$domElemsToRemove[] = $element;
				}
			}
		}
		$removed = array_merge( $removed, $this->removeElements( $domElemsToRemove ) );

		// Tags with CSS Classes
		foreach ( $removals['TAG_CLASS'] as $classToRemove ) {
			$parts = explode( '.', $classToRemove );

			$elements = $xpath->query(
				'//' . $parts[0] . '[@class="' . $parts[1] . '"]'
			);
			$removed = array_merge( $removed, $this->removeElements( $elements ) );
		}

		wfProfileOut( __METHOD__ );
		return $removed;
	}

	/**
	 * Removes a list of elelments from DOMDocument
	 * @param array|DOMNodeList $elements
	 * @return array Array of removed elements
	 */
	private function removeElements( $elements ) {
		$list = $elements;
		if ( $elements instanceof DOMNodeList ) {
			$list = array();
			foreach ( $elements as $element ) {
				$list[] = $element;
			}
		}
		/** @var $element DOMElement */
		foreach ( $list as $element ) {
			if ( $element->parentNode ) {
				$element->parentNode->removeChild( $element );
			}
		}
		return $list;
	}

	/**
	 * libxml in its usual pointlessness converts many chars to entities - this function
	 * perfoms a reverse conversion
	 * @param string $html
	 * @return string
	 */
	private function fixLibXML( $html ) {
		wfProfileIn( __METHOD__ );
		static $replacements;
		if ( !$replacements ) {
			// We don't include rules like '&#34;' => '&amp;quot;' because entities had already been
			// normalized by libxml. Using this function with input not sanitized by libxml is UNSAFE!
			$replacements = new ReplacementArray( array(
				'&quot;' => '&amp;quot;',
				'&amp;' => '&amp;amp;',
				'&lt;' => '&amp;lt;',
				'&gt;' => '&amp;gt;',
			) );
		}
		$html = $replacements->replace( $html );
		$html = mb_convert_encoding( $html, 'UTF-8', 'HTML-ENTITIES' );
		wfProfileOut( __METHOD__ );
		return $html;
	}

	/**
	 * Performs final transformations and returns resulting HTML.  Note that if you want to call this
	 * both without an element and with an element you should call it without an element first.  If you
	 * specify the $element in the method it'll change the underlying dom and you won't be able to get
	 * it back.
	 *
	 * @param DOMElement|string|null $element ID of element to get HTML from or
	 *   false to get it from the whole tree
	 * @return string Processed HTML
	 */
	public function getText( $element = null ) {
		wfProfileIn( __METHOD__ );

		if ( $this->doc ) {
			wfProfileIn( __METHOD__ . '-dom' );
			if ( $element !== null && !( $element instanceof DOMElement ) ) {
				$element = $this->doc->getElementById( $element );
			}
			if ( $element ) {
				$body = $this->doc->getElementsByTagName( 'body' )->item( 0 );
				$nodesArray = array();
				foreach ( $body->childNodes as $node ) {
					$nodesArray[] = $node;
				}
				foreach ( $nodesArray as $nodeArray ) {
					$body->removeChild( $nodeArray );
				}
				$body->appendChild( $element );
			}
			$html = $this->doc->saveHTML();
			wfProfileOut( __METHOD__ . '-dom' );

			wfProfileIn( __METHOD__ . '-fixes' );
			$html = $this->fixLibXml( $html );
			if ( wfIsWindows() ) {
				// Cleanup for CRLF misprocessing of unknown origin on Windows.
				//
				// If this error continues in the future, please track it down in the
				// XML code paths if possible and fix there.
				$html = str_replace( '&#13;', '', $html );
			}
			wfProfileOut( __METHOD__ . '-fixes' );
		} else {
			$html = $this->html;
		}
		// Remove stuff added by wrapHTML()
		$html = preg_replace( '/<!--.*?-->|^.*?<body>|<\/body>.*$/s', '', $html );
		$html = $this->onHtmlReady( $html );

		wfProfileIn( __METHOD__ . '-flatten' );
		if ( $this->elementsToFlatten ) {
			$elements = implode( '|', $this->elementsToFlatten );
			$html = preg_replace( "#</?($elements)\\b[^>]*>#is", '', $html );
		}
		wfProfileOut( __METHOD__ . '-flatten' );

		wfProfileOut( __METHOD__ );
		return $html;
	}

	/**
	 * Helper function for parseItemsToRemove(). This function extracts the selector type
	 * and the raw name of a selector from a CSS-style selector string and assigns those
	 * values to parameters passed by reference. For example, if given '#toc' as the
	 * $selector parameter, it will assign 'ID' as the $type and 'toc' as the $rawName.
	 * @param string $selector CSS selector to parse
	 * @param string $type The type of selector (ID, CLASS, TAG_CLASS, or TAG)
	 * @param string $rawName The raw name of the selector
	 * @return bool Whether the selector was successfully recognised
	 */
	protected function parseSelector( $selector, &$type, &$rawName ) {
		if ( strpos( $selector, '.' ) === 0 ) {
			$type = 'CLASS';
			$rawName = substr( $selector, 1 );
		} elseif ( strpos( $selector, '#' ) === 0 ) {
			$type = 'ID';
			$rawName = substr( $selector, 1 );
		} elseif ( strpos( $selector, '.' ) !== 0 && strpos( $selector, '.' ) !== false ) {
			$type = 'TAG_CLASS';
			$rawName = $selector;
		} elseif ( strpos( $selector, '[' ) === false && strpos( $selector, ']' ) === false ) {
			$type = 'TAG';
			$rawName = $selector;
		} else {
			throw new MWException( __METHOD__ . "(): unrecognized selector '$selector'" );
		}

		return true;
	}

	/**
	 * Transforms CSS-style selectors into an internal representation suitable for
	 * processing by filterContent()
	 * @return array
	 */
	protected function parseItemsToRemove() {
		wfProfileIn( __METHOD__ );
		$removals = array(
			'ID' => array(),
			'TAG' => array(),
			'CLASS' => array(),
			'TAG_CLASS' => array(),
		);

		foreach ( $this->itemsToRemove as $itemToRemove ) {
			$type = '';
			$rawName = '';
			if ( $this->parseSelector( $itemToRemove, $type, $rawName ) ) {
				$removals[$type][] = $rawName;
			}
		}

		if ( $this->removeMedia ) {
			$removals['TAG'][] = 'img';
			$removals['TAG'][] = 'audio';
			$removals['TAG'][] = 'video';
		}

		wfProfileOut( __METHOD__ );
		return $removals;
	}
}
