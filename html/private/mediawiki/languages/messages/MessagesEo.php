<?php
/** Esperanto (Esperanto)
 *
 * See MessagesQqq.php for message documentation incl. usage of parameters
 * To improve a translation please visit http://translatewiki.net
 *
 * @ingroup Language
 * @file
 *
 */

$namespaceNames = array(
	NS_MEDIA            => 'Aŭdvidaĵo',
	NS_SPECIAL          => 'Specialaĵo',
	NS_TALK             => 'Diskuto',
	NS_USER             => 'Uzanto',
	NS_USER_TALK        => 'Uzanto-Diskuto',
	NS_PROJECT_TALK     => '$1-Diskuto',
	NS_FILE             => 'Dosiero',
	NS_FILE_TALK        => 'Dosiero-Diskuto',
	NS_MEDIAWIKI        => 'MediaWiki',
	NS_MEDIAWIKI_TALK   => 'MediaWiki-Diskuto',
	NS_TEMPLATE         => 'Ŝablono',
	NS_TEMPLATE_TALK    => 'Ŝablono-Diskuto',
	NS_HELP             => 'Helpo',
	NS_HELP_TALK        => 'Helpo-Diskuto',
	NS_CATEGORY         => 'Kategorio',
	NS_CATEGORY_TALK    => 'Kategorio-Diskuto',
);

$namespaceAliases = array(
	'Speciala'             => NS_SPECIAL,
	'Vikipediisto'         => NS_USER,
	'Vikipediista_diskuto' => NS_USER_TALK,
	'Uzulo'                => NS_USER,
	'Uzanto'               => NS_USER,
	'Uzula_diskuto'        => NS_USER_TALK,
	'Uzanta_diskuto'       => NS_USER_TALK,
	'$1_diskuto'           => NS_PROJECT_TALK,
	'Dosiera_diskuto'      => NS_FILE_TALK,
	'MediaVikio'            => NS_MEDIAWIKI,
	'MediaWiki_diskuto'    => NS_MEDIAWIKI_TALK,
	'MediaVikia_diskuto'   => NS_MEDIAWIKI_TALK,
	'Ŝablona_diskuto'      => NS_TEMPLATE_TALK,
	'Helpa_diskuto'        => NS_HELP_TALK,
	'Kategoria_diskuto'    => NS_CATEGORY_TALK,
);

$namespaceGenderAliases = array(
	NS_USER => array( 'male' => 'Uzanto', 'female' => 'Uzantino' ),
	NS_USER_TALK => array( 'male' => 'Uzanto-Diskuto', 'female' => 'Uzantino-Diskuto' ),
);

$specialPageAliases = array(
	'Activeusers'               => array( 'Aktivaj_uzantoj' ),
	'Allmessages'               => array( 'Ĉiuj_mesaĝoj' ),
	'Allpages'                  => array( 'Ĉiuj_paĝoj' ),
	'Ancientpages'              => array( 'Malnovaj_paĝoj' ),
	'Badtitle'                  => array( 'Malbona_titolo' ),
	'Blankpage'                 => array( 'Malplena_paĝo' ),
	'Block'                     => array( 'Forbari_IP-adreson' ),
	'Booksources'               => array( 'Citoj_el_libroj' ),
	'BrokenRedirects'           => array( 'Rompitaj_alidirektiloj' ),
	'Categories'                => array( 'Kategorioj' ),
	'ChangeEmail'               => array( 'Ŝanĝi_retpoŝton' ),
	'ChangePassword'            => array( 'Ŝanĝi_pasvorton' ),
	'ComparePages'              => array( 'Kompari_paĝojn', 'Komparu_paĝojn' ),
	'Confirmemail'              => array( 'Konfirmi_per_retpoŝto' ),
	'Contributions'             => array( 'Kontribuoj' ),
	'CreateAccount'             => array( 'Krei_konton' ),
	'Deadendpages'              => array( 'Paĝoj_sen_interna_ligilo' ),
	'DeletedContributions'      => array( 'Forigitaj_kontribuoj' ),
	'DoubleRedirects'           => array( 'Duoblaj_alidirektiloj' ),
	'EditWatchlist'             => array( 'Redakti_atentaron' ),
	'Emailuser'                 => array( 'Retpoŝti_uzanton' ),
	'ExpandTemplates'           => array( 'Malfaldi_ŝablonon' ),
	'Export'                    => array( 'Elporti', 'Eksporti' ),
	'Fewestrevisions'           => array( 'Plej_malmultaj_revizioj' ),
	'FileDuplicateSearch'       => array( 'Serĉi_pri_duoblaj_dosieroj' ),
	'Filepath'                  => array( 'Pado_de_dosiero', 'Dosiero-pado' ),
	'Import'                    => array( 'Enporti', 'Importi' ),
	'Invalidateemail'           => array( 'Malvalidigi_retpoŝton' ),
	'BlockList'                 => array( 'Forbarlisto_de_IP-adresoj', 'IP-adresa_forbarlisto' ),
	'LinkSearch'                => array( 'Serĉi_ligilon' ),
	'Listadmins'                => array( 'Listigi_administrantojn' ),
	'Listbots'                  => array( 'Listigi_robotojn' ),
	'Listfiles'                 => array( 'Listigi_dosierojn', 'Listigi_bildojn', 'Bildolisto' ),
	'Listgrouprights'           => array( 'Gruprajtoj_de_uzantoj' ),
	'Listredirects'             => array( 'Listigi_alidirektilojn', 'Listigi_alidirektojn' ),
	'Listusers'                 => array( 'Listo_de_uzantoj' ),
	'Lockdb'                    => array( 'Ŝlosi_datumbazon' ),
	'Log'                       => array( 'Protokolo', 'Protokoloj' ),
	'Lonelypages'               => array( 'Neligitaj_paĝoj' ),
	'Longpages'                 => array( 'Longaj_paĝoj' ),
	'MergeHistory'              => array( 'Unuigi_kronologion', 'Kunigi_kronologion', 'Kunigi_historion' ),
	'MIMEsearch'                => array( 'MIME-Serĉo' ),
	'Mostcategories'            => array( 'Plej_multaj_kategorioj' ),
	'Mostimages'                => array( 'Plej_ligitaj_bildoj' ),
	'Mostlinked'                => array( 'Plej_ligitaj_paĝoj' ),
	'Mostlinkedcategories'      => array( 'Plej_ligitaj_kategorioj', 'Plej_uzataj_kategorioj' ),
	'Mostlinkedtemplates'       => array( 'Plej_ligitaj_ŝablonoj', 'Plej_uzataj_ŝablonoj' ),
	'Mostrevisions'             => array( 'Plej_multaj_revizioj' ),
	'Movepage'                  => array( 'Alinomigi_paĝon' ),
	'Mycontributions'           => array( 'Miaj_kontribuoj', 'MiajKontribuoj' ),
	'Mypage'                    => array( 'Mia_paĝo', 'MiaPaĝo' ),
	'Mytalk'                    => array( 'Mia_diskutpaĝo', 'MiaDiskutpaĝo' ),
	'Myuploads'                 => array( 'Miaj_alŝutaĵoj' ),
	'Newimages'                 => array( 'Novaj_bildoj' ),
	'Newpages'                  => array( 'Novaj_paĝoj' ),
	'PasswordReset'             => array( 'Ŝanĝo_de_pasvorto' ),
	'PermanentLink'             => array( 'Daŭra_ligilo' ),
	'Popularpages'              => array( 'Popularaj_paĝoj' ),
	'Preferences'               => array( 'Preferoj' ),
	'Prefixindex'               => array( 'Indekso_de_prefiksoj' ),
	'Protectedpages'            => array( 'Protektitaj_paĝoj' ),
	'Protectedtitles'           => array( 'Protektitaj_titoloj' ),
	'Randompage'                => array( 'Hazarda_paĝo' ),
	'Randomredirect'            => array( 'Hazarda_alidirektilo', 'Hazarda_alidirekto' ),
	'Recentchanges'             => array( 'Lastaj_ŝanĝoj' ),
	'Recentchangeslinked'       => array( 'Rilataj_ŝanĝoj' ),
	'Revisiondelete'            => array( 'Forigi_revizion' ),
	'Search'                    => array( 'Serĉi' ),
	'Shortpages'                => array( 'Mallongaj_paĝoj' ),
	'Specialpages'              => array( 'Specialaj_paĝoj' ),
	'Statistics'                => array( 'Statistikoj' ),
	'Tags'                      => array( 'Etikedoj' ),
	'Unblock'                   => array( 'Malforbari' ),
	'Uncategorizedcategories'   => array( 'Kategorioj_sen_kategorio' ),
	'Uncategorizedimages'       => array( 'Bildoj_sen_kategorio' ),
	'Uncategorizedpages'        => array( 'Paĝoj_sen_kategorio' ),
	'Uncategorizedtemplates'    => array( 'Ŝablonoj_sen_kategorio' ),
	'Undelete'                  => array( 'Restarigi' ),
	'Unlockdb'                  => array( 'Malŝlosi_datumbazon' ),
	'Unusedcategories'          => array( 'Malplenaj_kategorioj' ),
	'Unusedimages'              => array( 'Neuzataj_bildoj' ),
	'Unusedtemplates'           => array( 'Neuzataj_ŝablonoj' ),
	'Unwatchedpages'            => array( 'Neatentitaj_paĝoj' ),
	'Upload'                    => array( 'Alŝuti' ),
	'Userlogin'                 => array( 'Ensaluti' ),
	'Userlogout'                => array( 'Elsaluti' ),
	'Userrights'                => array( 'Rajtoj_de_uzantoj' ),
	'Version'                   => array( 'Versio' ),
	'Wantedcategories'          => array( 'Dezirataj_kategorioj' ),
	'Wantedfiles'               => array( 'Dezirataj_dosieroj' ),
	'Wantedpages'               => array( 'Dezirataj_paĝoj', 'Rompitaj_ligiloj' ),
	'Wantedtemplates'           => array( 'Dezirataj_ŝablonoj' ),
	'Watchlist'                 => array( 'Atentaro' ),
	'Whatlinkshere'             => array( 'Kio_ligas_ĉi_tien?' ),
	'Withoutinterwiki'          => array( 'Sen_intervikia_ligilo' ),
);

$magicWords = array(
	'redirect'                  => array( '0', '#ALIDIREKTI', '#ALIDIREKTU', '#AL', '#REDIRECT' ),
	'notoc'                     => array( '0', '__NI__', '__NEINDEKSO__', '__NT__', '__NOTOC__' ),
	'nogallery'                 => array( '0', '__NG__', '__SENBILDARO__', '__SB__', '__SG__', '__SENGALERIO__', '__NOGALLERY__' ),
	'forcetoc'                  => array( '0', '__FI__', '__FORTUINDEKSON__', '__FT__', '__FORCETOC__' ),
	'toc'                       => array( '0', '__I__', '__T__', '__INDEKSO__', '__TOC__' ),
	'noeditsection'             => array( '0', '__SRS__', '__NES__', '__SENREDAKTISEKCIOJN__', '__SENREDAKTISEKCION__', '__NOEDITSECTION__' ),
	'currentmonth'              => array( '1', 'NUNAMONATO', 'NUNAMONATO2', 'CURRENTMONTH', 'CURRENTMONTH2' ),
	'currentmonth1'             => array( '1', 'NUNAMONATO1', 'CURRENTMONTH1' ),
	'currentmonthname'          => array( '1', 'NUNAMONATNOMO', 'NUNAMONATONOMO', 'NUNAMONATANOMO', 'CURRENTMONTHNAME' ),
	'currentmonthnamegen'       => array( '1', 'NUNAMONATNOMOGEN', 'NUNAMONATONOMOGEN', 'NUNAMONATANOMOGEN', 'CURRENTMONTHNAMEGEN' ),
	'currentmonthabbrev'        => array( '1', 'NUNAMONATNOMOMAL', 'NUNAMONATONOMOMAL', 'NUNAMONATANOMOMAL', 'CURRENTMONTHABBREV' ),
	'currentday'                => array( '1', 'NUNATAGO', 'CURRENTDAY' ),
	'currentday2'               => array( '1', 'NUNATAGO2', 'CURRENTDAY2' ),
	'currentdayname'            => array( '1', 'NUNATAGNOMO', 'CURRENTDAYNAME' ),
	'currentyear'               => array( '1', 'NUNAJARO', 'CURRENTYEAR' ),
	'currenttime'               => array( '1', 'NUNATEMPO', 'CURRENTTIME' ),
	'currenthour'               => array( '1', 'NUNAHORO', 'CURRENTHOUR' ),
	'localmonth'                => array( '1', 'LOKAMONATO', 'LOKAMONATO2', 'LOCALMONTH', 'LOCALMONTH2' ),
	'localmonth1'               => array( '1', 'LOKAMONATO1', 'LOCALMONTH1' ),
	'localmonthname'            => array( '1', 'LOKAMONATNOMO', 'LOKAMONATONOMO', 'LOKAMONATANOMO', 'LOCALMONTHNAME' ),
	'localmonthnamegen'         => array( '1', 'LOKAMONATNOMOGEN', 'LOKAMONATONOMOGEN', 'LOKAMONATANOMOGEN', 'LOCALMONTHNAMEGEN' ),
	'localmonthabbrev'          => array( '1', 'LOKAMONATNOMOMAL', 'LOKAMONATONOMOMAL', 'LOKAMONATANOMOMAL', 'LOCALMONTHABBREV' ),
	'localday'                  => array( '1', 'LOKATAGO', 'LOCALDAY' ),
	'localday2'                 => array( '1', 'LOKATAGO2', 'LOCALDAY2' ),
	'localdayname'              => array( '1', 'LOKATAGNOMO', 'LOKATAGONOMO', 'LOKATAGANOMO', 'LOCALDAYNAME' ),
	'localyear'                 => array( '1', 'LOKAJARO', 'LOCALYEAR' ),
	'localtime'                 => array( '1', 'LOKATEMPO', 'LOCALTIME' ),
	'localhour'                 => array( '1', 'LOKAHORO', 'LOCALHOUR' ),
	'numberofpages'             => array( '1', 'NOMBRODEPAĜOJ', 'NOMBRODEPAGXOJ', 'NUMBEROFPAGES' ),
	'numberofarticles'          => array( '1', 'NOMBRODEARTIKOLOJ', 'NUMBEROFARTICLES' ),
	'numberoffiles'             => array( '1', 'NOMBRODEDOSIEROJ', 'NUMBEROFFILES' ),
	'numberofusers'             => array( '1', 'NOMBRODEUZANTOJ', 'NUMBEROFUSERS' ),
	'numberofactiveusers'       => array( '1', 'NOMBRODEAKTIVAJUZANTOJ', 'NUMBEROFACTIVEUSERS' ),
	'numberofedits'             => array( '1', 'NOMBRODEREDAKTOJ', 'NUMBEROFEDITS' ),
	'numberofviews'             => array( '1', 'NOMBRODEVIZITOJ', 'NUMBEROFVIEWS' ),
	'pagename'                  => array( '1', 'PAĜONOMO', 'PAGXONOMO', 'PAĜNOMO', 'PAGXNOMO', 'PAGENAME' ),
	'pagenamee'                 => array( '1', 'PAĜONOMOO', 'PAGXONOMOO', 'PAĜNOMOO', 'PAGXNOMOO', 'PAGENAMEE' ),
	'namespace'                 => array( '1', 'NOMSPACO', 'NAMESPACE' ),
	'namespacee'                => array( '1', 'NOMSPACOO', 'NAMESPACEE' ),
	'namespacenumber'           => array( '1', 'NUMERODENOMSPACO', 'NOMSPACNUMERO', 'NAMESPACENUMBER' ),
	'talkspace'                 => array( '1', 'DISKUTNOMSPACO', 'TALKSPACE' ),
	'talkspacee'                => array( '1', 'DISKUTNOMSPACOO', 'TALKSPACEE' ),
	'fullpagename'              => array( '1', 'TUTAPAĜONOMO', 'TUTAPAGXONOMO', 'TUTAPAĜNOMO', 'TUTAPAGXNOMO', 'FULLPAGENAME' ),
	'fullpagenamee'             => array( '1', 'TUTAPAĜONOMOO', 'TUTAPAGXONOMOO', 'TUTAPAĜNOMOO', 'TUTAPAGXNOMOO', 'FULLPAGENAMEE' ),
	'subpagename'               => array( '1', 'SUBPAĜONOMO', 'SUBPAGXONOMO', 'SUBPAĜNOMO', 'SUBPAGXNOMO', 'SUBPAGENAME' ),
	'subpagenamee'              => array( '1', 'SUBPAĜONOMOO', 'SUBPAGXONOMOO', 'SUBPAĜNOMOO', 'SUBPAGXNOMOO', 'SUBPAGENAMEE' ),
	'basepagename'              => array( '1', 'PATRAPAĜONOMO', 'PATRAPAGXONOMO', 'PATRAPAĜNOMO', 'PATRAPAGXNOMO', 'BASEPAGENAME' ),
	'basepagenamee'             => array( '1', 'PATRAPAĜONOMOO', 'PATRAPAGXONOMOO', 'PATRAPAĜNOMOO', 'PATRAPAGXNOMOO', 'BASEPAGENAMEE' ),
	'talkpagename'              => array( '1', 'DISKUTPAĜONOMO', 'DISKUTPAGXONOMO', 'DISKUTPAĜNOMO', 'DISKUTPAGXNOMO', 'TALKPAGENAME' ),
	'talkpagenamee'             => array( '1', 'DISKUTPAĜONOMOO', 'DISKUTPAGXONOMOO', 'DISKUTPAĜNOMOO', 'DISKUTPAGXNOMOO', 'TALKPAGENAMEE' ),
	'msg'                       => array( '0', 'MSĜ:', 'MSGX:', 'MSG:' ),
	'subst'                     => array( '0', 'ANSTAT:', 'SUBST:' ),
	'safesubst'                 => array( '0', 'SEKURANSTAT:', 'SAFESUBST:' ),
	'msgnw'                     => array( '0', 'NVMSĜ:', 'NVMSGX:', 'MSGNW:' ),
	'img_thumbnail'             => array( '1', 'eta', 'thumbnail', 'thumb' ),
	'img_manualthumb'           => array( '1', 'eta=$1', 'thumbnail=$1', 'thumb=$1' ),
	'img_right'                 => array( '1', 'dekstra', 'dekstre', 'right' ),
	'img_left'                  => array( '1', 'maldekstra', 'maldekstre', 'left' ),
	'img_none'                  => array( '1', 'nenio', 'neniu', 'none' ),
	'img_width'                 => array( '1', '$1ra', '$1px' ),
	'img_center'                => array( '1', 'centra', 'meza', 'center', 'centre' ),
	'img_framed'                => array( '1', 'kadro', 'enkadrita', 'enkadrite', 'framed', 'enframed', 'frame' ),
	'img_frameless'             => array( '1', 'senkadra', 'frameless' ),
	'img_page'                  => array( '1', 'paĝo=$1', 'paĝo $1', 'pagxo=$1', 'pagxo_$1', 'page=$1', 'page $1' ),
	'img_upright'               => array( '1', 'altdekstre', 'altdekstre=$1', 'altdekstre_$1', 'upright', 'upright=$1', 'upright $1' ),
	'img_border'                => array( '1', 'kadra', 'kadrita', 'kadrigita', 'kadrite', 'kadrigite', 'border' ),
	'img_sub'                   => array( '1', 'sube', 'malsupre', 'sub' ),
	'img_super'                 => array( '1', 'supre', 'malsube', 'super', 'sup' ),
	'img_top'                   => array( '1', 'alte', 'top' ),
	'img_text_top'              => array( '1', 'tekst-alte', 'text-top' ),
	'img_middle'                => array( '1', 'meze', 'middle' ),
	'img_bottom'                => array( '1', 'malalte', 'bottom' ),
	'img_text_bottom'           => array( '1', 'suba-teksto', 'text-bottom' ),
	'img_link'                  => array( '1', 'ligilo=$1', 'link=$1' ),
	'img_alt'                   => array( '1', 'alternative=$1', 'alt=$1' ),
	'img_class'                 => array( '1', 'klaso=$1', 'class=$1' ),
	'int'                       => array( '0', 'ENE:', 'INT:' ),
	'sitename'                  => array( '1', 'TTT-NOMO', 'RETPAĜNOMO', 'RETPAGXNOMO', 'RETEJNOMO', 'SITENAME' ),
	'nse'                       => array( '0', 'NSS:', 'NSO:', 'NSE:' ),
	'localurl'                  => array( '0', 'LOKATTT:', 'LOCALURL:' ),
	'localurle'                 => array( '0', 'LOKATTTT:', 'LOCALURLE:' ),
	'articlepath'               => array( '0', 'ARTIKOLAPADO', 'ARTIKOLAVOJO', 'ARTICLEPATH' ),
	'pageid'                    => array( '0', 'IDENTIGILODEPAĜO', 'PAĜID', 'PAGEID' ),
	'server'                    => array( '0', 'SERVILO', 'SERVER' ),
	'servername'                => array( '0', 'NOMODESERVILO', 'SERVILANOMO', 'SERVILONOMO', 'SERVERNAME' ),
	'scriptpath'                => array( '0', 'SKRIPTO-VOJO', 'SKRIPTOVOJO', 'SKRIPTVOJO', 'SCRIPTPATH' ),
	'stylepath'                 => array( '0', 'STILO-VOJO', 'STILOVOJO', 'STILVOJO', 'STYLEPATH' ),
	'grammar'                   => array( '0', 'GRAMATIKO:', 'GRAMMAR:' ),
	'gender'                    => array( '0', 'SEKSO:', 'GENDER:' ),
	'notitleconvert'            => array( '0', '__NEKONVERTUTITOLON__', '__NKT__', '__NTC__', '__NOTITLECONVERT__', '__NOTC__' ),
	'nocontentconvert'          => array( '0', '__NEKONVERTUENHAVON__', '__NKH__', '__NCC__', '__NOCONTENTCONVERT__', '__NOCC__' ),
	'currentweek'               => array( '1', 'NUNASEMAJNO', 'CURRENTWEEK' ),
	'localweek'                 => array( '1', 'LOKASEMAJNO', 'LOCALWEEK' ),
	'revisionyear'              => array( '1', 'JARODEREVIZIO', 'REVISIONYEAR' ),
	'plural'                    => array( '0', 'PLURALA:', 'PLURAL:' ),
	'fullurl'                   => array( '0', 'PLENALIGILO:', 'PLENLIG:', 'TUTATTT:', 'FULLURL:' ),
	'fullurle'                  => array( '0', 'PLENALIGILOO:', 'PLENLIGG:', 'TUTATTTT:', 'FULLURLE:' ),
	'lcfirst'                   => array( '0', 'MALMAJUSKLEUNUA:', 'MINUSKLEUNUA:', 'MMU:', 'LCFIRST:' ),
	'ucfirst'                   => array( '0', 'MAJUSKLEUNUA:', 'MALMINUSKLEUNUA:', 'MU:', 'UCFIRST:' ),
	'lc'                        => array( '0', 'MALMAJUSKLE:', 'MINUSKLE:', 'LC:' ),
	'uc'                        => array( '0', 'MAJUSKLE:', 'MALMINUSKLE:', 'UC:' ),
	'displaytitle'              => array( '1', 'MONTRUTITOLON:', 'DISPLAYTITLE' ),
	'newsectionlink'            => array( '1', '__LIGILOALNOVASEKCIO__', '__NSL__', '__LNS__', '__LANS__', '__NEWSECTIONLINK__' ),
	'nonewsectionlink'          => array( '1', '__SENLIGILOALNOVASEKCIO__', '__NNSL__', '__SLNS__', '__SLANS__', '__NONEWSECTIONLINK__' ),
	'currentversion'            => array( '1', 'NUNAVERSIO', 'CURRENTVERSION' ),
	'currenttimestamp'          => array( '1', 'NUNATEMPINDIKO', 'CURRENTTIMESTAMP' ),
	'localtimestamp'            => array( '1', 'LOKATEMPINDIKO', 'LOCALTIMESTAMP' ),
	'language'                  => array( '0', '#LINGVO:', '#LANGUAGE:' ),
	'contentlanguage'           => array( '1', 'ENHAVA-LINGVO', 'CONTENTLANGUAGE', 'CONTENTLANG' ),
	'pagesinnamespace'          => array( '1', 'PAĜOJENNOMSPACO', 'PAGXOJENNOMSPACO', 'PAĜOJENS', 'PAGXOJENNS', 'PAGESINNAMESPACE:', 'PAGESINNS:' ),
	'numberofadmins'            => array( '1', 'NOMBRODEADMINOJ', 'NUMBEROFADMINS' ),
	'special'                   => array( '0', 'speciala', 'special' ),
	'defaultsort'               => array( '1', 'DEFAŬLTORDIGO:', 'DEFAUXLTORDIGO:', 'DEFAULTSORT:', 'DEFAULTSORTKEY:', 'DEFAULTCATEGORYSORT:' ),
	'filepath'                  => array( '0', 'DOSIERO-VORO', 'DOSIERVOJO', 'FILEPATH:' ),
	'tag'                       => array( '0', 'marko', 'etikedo', 'tag' ),
	'hiddencat'                 => array( '1', '__KK__', '__KAŜITAKATEGORIO__', '__KASXITAKATEGORIO__', '__HIDDENCAT__' ),
	'pagesincategory'           => array( '1', 'PAĜOJENKATEGORIO', 'PAGXOJENKATEGORIO', 'PAĜOJENKAT', 'PAGXOJENKAT', 'PAGESINCATEGORY', 'PAGESINCAT' ),
	'pagesize'                  => array( '1', 'PAĜOPEZO', 'PAGXOPEZO', 'PEZODEPAĜO', 'PEZODEPAGXO', 'PAGESIZE' ),
	'index'                     => array( '1', '__INDEKSU__', '__INDEKSI__', '__INDEX__' ),
	'noindex'                   => array( '1', '__NEINDEKSU__', '__NIU__', '__NOINDEX__' ),
	'staticredirect'            => array( '1', '__STATIKAALIDIREKTO__', '__STATICREDIRECT__' ),
	'protectionlevel'           => array( '1', 'PROTEKTONIVELO', 'PROTECTIONLEVEL' ),
	'url_path'                  => array( '0', 'VOJO', 'PATH' ),
	'url_wiki'                  => array( '0', 'VIKIO', 'WIKI' ),
	'url_query'                 => array( '0', 'INFORMPETO', 'QUERY' ),
);

$separatorTransformTable = array( ',' => "\xc2\xa0", '.' => ',' );

$datePreferences = false;
$defaultDateFormat = 'dmy';
$dateFormats = array(
	'dmy time' => 'H:i',
	'dmy date' => 'j M. Y',
	'dmy both' => 'H:i, j M. Y',
);

