<?php
/**
 * Options for the PHP parser
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
 * @ingroup Parser
 */

/**
 * @brief Set options of the Parser
 *
 * All member variables are supposed to be private in theory, although in
 * practise this is not the case.
 *
 * @ingroup Parser
 */
class ParserOptions {

	/**
	 * Interlanguage links are removed and returned in an array
	 */
	public $mInterwikiMagic;

	/**
	 * Allow external images inline?
	 */
	public $mAllowExternalImages;

	/**
	 * If not, any exception?
	 */
	public $mAllowExternalImagesFrom;

	/**
	 * If not or it doesn't match, should we check an on-wiki whitelist?
	 */
	public $mEnableImageWhitelist;

	/**
	 * Date format index
	 */
	public $mDateFormat = null;

	/**
	 * Create "edit section" links?
	 */
	public $mEditSection = true;

	/**
	 * Allow inclusion of special pages?
	 */
	public $mAllowSpecialInclusion;

	/**
	 * Use tidy to cleanup output HTML?
	 */
	public $mTidy = false;

	/**
	 * Which lang to call for PLURAL and GRAMMAR
	 */
	public $mInterfaceMessage = false;

	/**
	 * Overrides $mInterfaceMessage with arbitrary language
	 */
	public $mTargetLanguage = null;

	/**
	 * Maximum size of template expansions, in bytes
	 */
	public $mMaxIncludeSize;

	/**
	 * Maximum number of nodes touched by PPFrame::expand()
	 */
	public $mMaxPPNodeCount;

	/**
	 * Maximum number of nodes generated by Preprocessor::preprocessToObj()
	 */
	public $mMaxGeneratedPPNodeCount;

	/**
	 * Maximum recursion depth in PPFrame::expand()
	 */
	public $mMaxPPExpandDepth;

	/**
	 * Maximum recursion depth for templates within templates
	 */
	public $mMaxTemplateDepth;

	/**
	 * Maximum number of calls per parse to expensive parser functions
	 */
	public $mExpensiveParserFunctionLimit;

	/**
	 * Remove HTML comments. ONLY APPLIES TO PREPROCESS OPERATIONS
	 */
	public $mRemoveComments = true;

	/**
	 * Callback for template fetching. Used as first argument to call_user_func().
	 */
	public $mTemplateCallback =
		array( 'Parser', 'statelessFetchTemplate' );

	/**
	 * Enable limit report in an HTML comment on output
	 */
	public $mEnableLimitReport = false;

	/**
	 * Timestamp used for {{CURRENTDAY}} etc.
	 */
	public $mTimestamp;

	/**
	 * Target attribute for external links
	 */
	public $mExternalLinkTarget;

	/**
	 * Clean up signature texts?
	 *
	 * 1) Strip ~~~, ~~~~ and ~~~~~ out of signatures
	 * 2) Substitute all transclusions
	 */
	public $mCleanSignatures;

	/**
	 * Transform wiki markup when saving the page?
	 */
	public $mPreSaveTransform = true;

	/**
	 * Whether content conversion should be disabled
	 */
	public $mDisableContentConversion;

	/**
	 * Whether title conversion should be disabled
	 */
	public $mDisableTitleConversion;

	/**
	 * Automatically number headings?
	 */
	public $mNumberHeadings;

	/**
	 * Thumb size preferred by the user.
	 */
	public $mThumbSize;

	/**
	 * Maximum article size of an article to be marked as "stub"
	 */
	private $mStubThreshold;

	/**
	 * Language object of the User language.
	 */
	public $mUserLang;

	/**
	 * @var User
	 * Stored user object
	 */
	public $mUser;

	/**
	 * Parsing the page for a "preview" operation?
	 */
	public $mIsPreview = false;

	/**
	 * Parsing the page for a "preview" operation on a single section?
	 */
	public $mIsSectionPreview = false;

	/**
	 * Parsing the printable version of the page?
	 */
	public $mIsPrintable = false;

	/**
	 * Extra key that should be present in the caching key.
	 */
	public $mExtraKey = '';

	/**
	 * Function to be called when an option is accessed.
	 */
	protected $onAccessCallback = null;

	/**
	 * If the page being parsed is a redirect, this should hold the redirect
	 * target.
	 * @var Title|null
	 */
	private $redirectTarget = null;

	public function getInterwikiMagic() {
		return $this->mInterwikiMagic;
	}

	public function getAllowExternalImages() {
		return $this->mAllowExternalImages;
	}

	public function getAllowExternalImagesFrom() {
		return $this->mAllowExternalImagesFrom;
	}

	public function getEnableImageWhitelist() {
		return $this->mEnableImageWhitelist;
	}

	public function getEditSection() {
		return $this->mEditSection;
	}

	public function getNumberHeadings() {
		$this->optionUsed( 'numberheadings' );

		return $this->mNumberHeadings;
	}

	public function getAllowSpecialInclusion() {
		return $this->mAllowSpecialInclusion;
	}

	public function getTidy() {
		return $this->mTidy;
	}

	public function getInterfaceMessage() {
		return $this->mInterfaceMessage;
	}

	public function getTargetLanguage() {
		return $this->mTargetLanguage;
	}

	public function getMaxIncludeSize() {
		return $this->mMaxIncludeSize;
	}

	public function getMaxPPNodeCount() {
		return $this->mMaxPPNodeCount;
	}

	public function getMaxGeneratedPPNodeCount() {
		return $this->mMaxGeneratedPPNodeCount;
	}

	public function getMaxPPExpandDepth() {
		return $this->mMaxPPExpandDepth;
	}

	public function getMaxTemplateDepth() {
		return $this->mMaxTemplateDepth;
	}

	/* @since 1.20 */
	public function getExpensiveParserFunctionLimit() {
		return $this->mExpensiveParserFunctionLimit;
	}

	public function getRemoveComments() {
		return $this->mRemoveComments;
	}

	public function getTemplateCallback() {
		return $this->mTemplateCallback;
	}

	public function getEnableLimitReport() {
		return $this->mEnableLimitReport;
	}

	public function getCleanSignatures() {
		return $this->mCleanSignatures;
	}

	public function getExternalLinkTarget() {
		return $this->mExternalLinkTarget;
	}

	public function getDisableContentConversion() {
		return $this->mDisableContentConversion;
	}

	public function getDisableTitleConversion() {
		return $this->mDisableTitleConversion;
	}

	public function getThumbSize() {
		$this->optionUsed( 'thumbsize' );

		return $this->mThumbSize;
	}

	public function getStubThreshold() {
		$this->optionUsed( 'stubthreshold' );

		return $this->mStubThreshold;
	}

	public function getIsPreview() {
		return $this->mIsPreview;
	}

	public function getIsSectionPreview() {
		return $this->mIsSectionPreview;
	}

	public function getIsPrintable() {
		$this->optionUsed( 'printable' );

		return $this->mIsPrintable;
	}

	public function getUser() {
		return $this->mUser;
	}

	public function getPreSaveTransform() {
		return $this->mPreSaveTransform;
	}

	public function getDateFormat() {
		$this->optionUsed( 'dateformat' );
		if ( !isset( $this->mDateFormat ) ) {
			$this->mDateFormat = $this->mUser->getDatePreference();
		}
		return $this->mDateFormat;
	}

	public function getTimestamp() {
		if ( !isset( $this->mTimestamp ) ) {
			$this->mTimestamp = wfTimestampNow();
		}
		return $this->mTimestamp;
	}

	/**
	 * Get the user language used by the parser for this page.
	 *
	 * You shouldn't use this. Really. $parser->getFunctionLang() is all you need.
	 *
	 * To avoid side-effects where the page will be rendered based on the language
	 * of the user who last saved, this function will triger a cache fragmentation.
	 * Usage of this method is discouraged for that reason.
	 *
	 * When saving, this will return the default language instead of the user's.
	 *
	 * {{int: }} uses this which used to produce inconsistent link tables (bug 14404).
	 *
	 * @return Language
	 * @since 1.19
	 */
	public function getUserLangObj() {
		$this->optionUsed( 'userlang' );
		return $this->mUserLang;
	}

	/**
	 * Same as getUserLangObj() but returns a string instead.
	 *
	 * @return string Language code
	 * @since 1.17
	 */
	public function getUserLang() {
		return $this->getUserLangObj()->getCode();
	}

	public function setInterwikiMagic( $x ) {
		return wfSetVar( $this->mInterwikiMagic, $x );
	}

	public function setAllowExternalImages( $x ) {
		return wfSetVar( $this->mAllowExternalImages, $x );
	}

	public function setAllowExternalImagesFrom( $x ) {
		return wfSetVar( $this->mAllowExternalImagesFrom, $x );
	}

	public function setEnableImageWhitelist( $x ) {
		return wfSetVar( $this->mEnableImageWhitelist, $x );
	}

	public function setDateFormat( $x ) {
		return wfSetVar( $this->mDateFormat, $x );
	}

	public function setEditSection( $x ) {
		return wfSetVar( $this->mEditSection, $x );
	}

	public function setNumberHeadings( $x ) {
		return wfSetVar( $this->mNumberHeadings, $x );
	}

	public function setAllowSpecialInclusion( $x ) {
		return wfSetVar( $this->mAllowSpecialInclusion, $x );
	}

	public function setTidy( $x ) {
		return wfSetVar( $this->mTidy, $x );
	}

	public function setInterfaceMessage( $x ) {
		return wfSetVar( $this->mInterfaceMessage, $x );
	}

	public function setTargetLanguage( $x ) {
		return wfSetVar( $this->mTargetLanguage, $x, true );
	}

	public function setMaxIncludeSize( $x ) {
		return wfSetVar( $this->mMaxIncludeSize, $x );
	}

	public function setMaxPPNodeCount( $x ) {
		return wfSetVar( $this->mMaxPPNodeCount, $x );
	}

	public function setMaxGeneratedPPNodeCount( $x ) {
		return wfSetVar( $this->mMaxGeneratedPPNodeCount, $x );
	}

	public function setMaxTemplateDepth( $x ) {
		return wfSetVar( $this->mMaxTemplateDepth, $x );
	}

	/* @since 1.20 */
	public function setExpensiveParserFunctionLimit( $x ) {
		return wfSetVar( $this->mExpensiveParserFunctionLimit, $x );
	}

	public function setRemoveComments( $x ) {
		return wfSetVar( $this->mRemoveComments, $x );
	}

	public function setTemplateCallback( $x ) {
		return wfSetVar( $this->mTemplateCallback, $x );
	}

	public function enableLimitReport( $x = true ) {
		return wfSetVar( $this->mEnableLimitReport, $x );
	}

	public function setTimestamp( $x ) {
		return wfSetVar( $this->mTimestamp, $x );
	}

	public function setCleanSignatures( $x ) {
		return wfSetVar( $this->mCleanSignatures, $x );
	}

	public function setExternalLinkTarget( $x ) {
		return wfSetVar( $this->mExternalLinkTarget, $x );
	}

	public function disableContentConversion( $x = true ) {
		return wfSetVar( $this->mDisableContentConversion, $x );
	}

	public function disableTitleConversion( $x = true ) {
		return wfSetVar( $this->mDisableTitleConversion, $x );
	}

	public function setUserLang( $x ) {
		if ( is_string( $x ) ) {
			$x = Language::factory( $x );
		}

		return wfSetVar( $this->mUserLang, $x );
	}

	public function setThumbSize( $x ) {
		return wfSetVar( $this->mThumbSize, $x );
	}

	public function setStubThreshold( $x ) {
		return wfSetVar( $this->mStubThreshold, $x );
	}

	public function setPreSaveTransform( $x ) {
		return wfSetVar( $this->mPreSaveTransform, $x );
	}

	public function setIsPreview( $x ) {
		return wfSetVar( $this->mIsPreview, $x );
	}

	public function setIsSectionPreview( $x ) {
		return wfSetVar( $this->mIsSectionPreview, $x );
	}

	public function setIsPrintable( $x ) {
		return wfSetVar( $this->mIsPrintable, $x );
	}

	/**
	 * Set the redirect target.
	 *
	 * Note that setting or changing this does not *make* the page a redirect
	 * or change its target, it merely records the information for reference
	 * during the parse.
	 *
	 * @since 1.24
	 * @param Title|null $title
	 */
	function setRedirectTarget( $title ) {
		$this->redirectTarget = $title;
	}

	/**
	 * Get the previously-set redirect target.
	 *
	 * @since 1.24
	 * @return Title|null
	 */
	function getRedirectTarget() {
		return $this->redirectTarget;
	}

	/**
	 * Extra key that should be present in the parser cache key.
	 * @param string $key
	 */
	public function addExtraKey( $key ) {
		$this->mExtraKey .= '!' . $key;
	}

	/**
	 * Constructor
	 * @param User $user
	 * @param Language $lang
	 */
	public function __construct( $user = null, $lang = null ) {
		if ( $user === null ) {
			global $wgUser;
			if ( $wgUser === null ) {
				$user = new User;
			} else {
				$user = $wgUser;
			}
		}
		if ( $lang === null ) {
			global $wgLang;
			if ( !StubObject::isRealObject( $wgLang ) ) {
				$wgLang->_unstub();
			}
			$lang = $wgLang;
		}
		$this->initialiseFromUser( $user, $lang );
	}

	/**
	 * Get a ParserOptions object from a given user.
	 * Language will be taken from $wgLang.
	 *
	 * @param User $user
	 * @return ParserOptions
	 */
	public static function newFromUser( $user ) {
		return new ParserOptions( $user );
	}

	/**
	 * Get a ParserOptions object from a given user and language
	 *
	 * @param User $user
	 * @param Language $lang
	 * @return ParserOptions
	 */
	public static function newFromUserAndLang( User $user, Language $lang ) {
		return new ParserOptions( $user, $lang );
	}

	/**
	 * Get a ParserOptions object from a IContextSource object
	 *
	 * @param IContextSource $context
	 * @return ParserOptions
	 */
	public static function newFromContext( IContextSource $context ) {
		return new ParserOptions( $context->getUser(), $context->getLanguage() );
	}

	/**
	 * Get user options
	 *
	 * @param User $user
	 * @param Language $lang
	 */
	private function initialiseFromUser( $user, $lang ) {
		global $wgInterwikiMagic, $wgAllowExternalImages,
			$wgAllowExternalImagesFrom, $wgEnableImageWhitelist, $wgAllowSpecialInclusion,
			$wgMaxArticleSize, $wgMaxPPNodeCount, $wgMaxTemplateDepth, $wgMaxPPExpandDepth,
			$wgCleanSignatures, $wgExternalLinkTarget, $wgExpensiveParserFunctionLimit,
			$wgMaxGeneratedPPNodeCount, $wgDisableLangConversion, $wgDisableTitleConversion;

		wfProfileIn( __METHOD__ );

		$this->mInterwikiMagic = $wgInterwikiMagic;
		$this->mAllowExternalImages = $wgAllowExternalImages;
		$this->mAllowExternalImagesFrom = $wgAllowExternalImagesFrom;
		$this->mEnableImageWhitelist = $wgEnableImageWhitelist;
		$this->mAllowSpecialInclusion = $wgAllowSpecialInclusion;
		$this->mMaxIncludeSize = $wgMaxArticleSize * 1024;
		$this->mMaxPPNodeCount = $wgMaxPPNodeCount;
		$this->mMaxGeneratedPPNodeCount = $wgMaxGeneratedPPNodeCount;
		$this->mMaxPPExpandDepth = $wgMaxPPExpandDepth;
		$this->mMaxTemplateDepth = $wgMaxTemplateDepth;
		$this->mExpensiveParserFunctionLimit = $wgExpensiveParserFunctionLimit;
		$this->mCleanSignatures = $wgCleanSignatures;
		$this->mExternalLinkTarget = $wgExternalLinkTarget;
		$this->mDisableContentConversion = $wgDisableLangConversion;
		$this->mDisableTitleConversion = $wgDisableLangConversion || $wgDisableTitleConversion;

		$this->mUser = $user;
		$this->mNumberHeadings = $user->getOption( 'numberheadings' );
		$this->mThumbSize = $user->getOption( 'thumbsize' );
		$this->mStubThreshold = $user->getStubThreshold();
		$this->mUserLang = $lang;

		wfProfileOut( __METHOD__ );
	}

	/**
	 * Registers a callback for tracking which ParserOptions which are used.
	 * This is a private API with the parser.
	 * @param callable $callback
	 */
	public function registerWatcher( $callback ) {
		$this->onAccessCallback = $callback;
	}

	/**
	 * Called when an option is accessed.
	 * @param string $optionName Name of the option
	 */
	public function optionUsed( $optionName ) {
		if ( $this->onAccessCallback ) {
			call_user_func( $this->onAccessCallback, $optionName );
		}
	}

	/**
	 * Returns the full array of options that would have been used by
	 * in 1.16.
	 * Used to get the old parser cache entries when available.
	 * @return array
	 */
	public static function legacyOptions() {
		return array(
			'stubthreshold',
			'numberheadings',
			'userlang',
			'thumbsize',
			'editsection',
			'printable'
		);
	}

	/**
	 * Generate a hash string with the values set on these ParserOptions
	 * for the keys given in the array.
	 * This will be used as part of the hash key for the parser cache,
	 * so users sharing the options with vary for the same page share
	 * the same cached data safely.
	 *
	 * Extensions which require it should install 'PageRenderingHash' hook,
	 * which will give them a chance to modify this key based on their own
	 * settings.
	 *
	 * @since 1.17
	 * @param array $forOptions
	 * @param Title $title Used to get the content language of the page (since r97636)
	 * @return string Page rendering hash
	 */
	public function optionsHash( $forOptions, $title = null ) {
		global $wgRenderHashAppend;

		// FIXME: Once the cache key is reorganized this argument
		// can be dropped. It was used when the math extension was
		// part of core.
		$confstr = '*';

		// Space assigned for the stubthreshold but unused
		// since it disables the parser cache, its value will always
		// be 0 when this function is called by parsercache.
		if ( in_array( 'stubthreshold', $forOptions ) ) {
			$confstr .= '!' . $this->mStubThreshold;
		} else {
			$confstr .= '!*';
		}

		if ( in_array( 'dateformat', $forOptions ) ) {
			$confstr .= '!' . $this->getDateFormat();
		}

		if ( in_array( 'numberheadings', $forOptions ) ) {
			$confstr .= '!' . ( $this->mNumberHeadings ? '1' : '' );
		} else {
			$confstr .= '!*';
		}

		if ( in_array( 'userlang', $forOptions ) ) {
			$confstr .= '!' . $this->mUserLang->getCode();
		} else {
			$confstr .= '!*';
		}

		if ( in_array( 'thumbsize', $forOptions ) ) {
			$confstr .= '!' . $this->mThumbSize;
		} else {
			$confstr .= '!*';
		}

		// add in language specific options, if any
		// @todo FIXME: This is just a way of retrieving the url/user preferred variant
		if ( !is_null( $title ) ) {
			$confstr .= $title->getPageLanguage()->getExtraHashOptions();
		} else {
			global $wgContLang;
			$confstr .= $wgContLang->getExtraHashOptions();
		}

		$confstr .= $wgRenderHashAppend;

		if ( !in_array( 'editsection', $forOptions ) ) {
			$confstr .= '!*';
		} elseif ( !$this->mEditSection ) {
			$confstr .= '!edit=0';
		}

		if ( $this->mIsPrintable && in_array( 'printable', $forOptions ) ) {
			$confstr .= '!printable=1';
		}

		if ( $this->mExtraKey != '' ) {
			$confstr .= $this->mExtraKey;
		}

		// Give a chance for extensions to modify the hash, if they have
		// extra options or other effects on the parser cache.
		wfRunHooks( 'PageRenderingHash', array( &$confstr, $this->getUser(), &$forOptions ) );

		// Make it a valid memcached key fragment
		$confstr = str_replace( ' ', '_', $confstr );

		return $confstr;
	}
}
