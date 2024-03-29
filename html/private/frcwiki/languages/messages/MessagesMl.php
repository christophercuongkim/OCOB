<?php
/** Malayalam (മലയാളം)
 *
 * To improve a translation please visit https://translatewiki.net
 *
 * @ingroup Language
 * @file
 *
 * @author Abhishek Jacob
 * @author Akhilan
 * @author Anoopan
 * @author Chrisportelli
 * @author Deepugn
 * @author Jacob.jose
 * @author Jigesh
 * @author Junaidpv
 * @author Jyothis
 * @author Kaganer
 * @author Krenair
 * @author Manjith Joseph <manjithkaini@gmail.com>
 * @author Naveen Sankar
 * @author Nemo bis
 * @author Praveen Prakash <me.praveen@gmail.com>
 * @author Praveenp
 * @author Raghith
 * @author Sadik Khalid
 * @author Sadik Khalid <sadik.khalid@gmail.com>
 * @author Santhosh.thottingal
 * @author ShajiA
 * @author Shiju Alex <shijualexonline@gmail.com>
 * @author Shijualex
 * @author Vssun
 * @author Ævar Arnfjörð Bjarmason <avarab@gmail.com>
 * @author לערי ריינהארט
 */

$namespaceNames = array(
	NS_MEDIA            => 'മീഡിയ',
	NS_SPECIAL          => 'പ്രത്യേകം',
	NS_TALK             => 'സംവാദം',
	NS_USER             => 'ഉപയോക്താവ്',
	NS_USER_TALK        => 'ഉപയോക്താവിന്റെ_സംവാദം',
	NS_PROJECT_TALK     => '$1_സംവാദം',
	NS_FILE             => 'പ്രമാണം',
	NS_FILE_TALK        => 'പ്രമാണത്തിന്റെ_സംവാദം',
	NS_MEDIAWIKI        => 'മീഡിയവിക്കി',
	NS_MEDIAWIKI_TALK   => 'മീഡിയവിക്കി_സംവാദം',
	NS_TEMPLATE         => 'ഫലകം',
	NS_TEMPLATE_TALK    => 'ഫലകത്തിന്റെ_സംവാദം',
	NS_HELP             => 'സഹായം',
	NS_HELP_TALK        => 'സഹായത്തിന്റെ_സംവാദം',
	NS_CATEGORY         => 'വർഗ്ഗം',
	NS_CATEGORY_TALK    => 'വർഗ്ഗത്തിന്റെ_സംവാദം',
);

$namespaceAliases = array(
	'സം' => NS_TALK,
	'അംഗം' => NS_USER,
	'ഉ' => NS_USER,
	'അംഗങ്ങളുടെ സംവാദം' => NS_USER_TALK,
	'ഉസം' => NS_USER_TALK,
	'ചി' => NS_FILE,
	'ചിസം' => NS_FILE_TALK,
	'ചിത്രം' => NS_FILE,
	'ചിത്രത്തിന്റെ_സംവാദം' => NS_FILE_TALK,
	'പ്ര' => NS_FILE,
	'പ്രസം' => NS_FILE_TALK,
	'ഫ' => NS_TEMPLATE,
	'ഫസം' => NS_TEMPLATE_TALK,
	'വി' => NS_CATEGORY,
	'വ' => NS_CATEGORY,
	'വിസം' => NS_CATEGORY_TALK,
	'വസം' => NS_CATEGORY_TALK,
	'മീ' => NS_MEDIAWIKI,
	'മീസം' => NS_MEDIAWIKI_TALK,
	'പ്രത്യേ' => NS_SPECIAL,
	'വിഭാഗം' => NS_CATEGORY,
	'വിഭാഗത്തിന്റെ_സംവാദം' => NS_CATEGORY_TALK,
	'വർഗ്ഗം' => NS_CATEGORY,
	'വർഗ്ഗത്തിന്റെ_സംവാദം' => NS_CATEGORY_TALK,
	'സ' => NS_HELP,
	'സസം' => NS_HELP_TALK,
);

$specialPageAliases = array(
	'Activeusers'               => array( 'സജീവ_ഉപയോക്താക്കൾ' ),
	'Allmessages'               => array( 'സർവ്വസന്ദേശങ്ങൾ' ),
	'AllMyUploads'              => array( 'എന്റെയെല്ലാഅപ്‌ലോഡുകളും', 'എന്റെയെല്ലാപ്രമാണങ്ങളും' ),
	'Allpages'                  => array( 'എല്ലാതാളുകളും' ),
	'Ancientpages'              => array( 'പുരാതന_താളുകൾ' ),
	'Badtitle'                  => array( 'മോശംതലക്കെട്ട്' ),
	'Blankpage'                 => array( 'ശൂന്യതാൾ' ),
	'Block'                     => array( 'തടയുക', 'ഐ.പി.തടയുക', 'ഉപയോക്തൃതടയൽ' ),
	'Booksources'               => array( 'പുസ്തകസ്രോതസ്സുകൾ' ),
	'BrokenRedirects'           => array( 'പൊട്ടിയതിരിച്ചുവിടലുകൾ' ),
	'Categories'                => array( 'വർഗ്ഗങ്ങൾ' ),
	'ChangeEmail'               => array( 'ഇമെയിലിൽമാറ്റംവരുത്തുക' ),
	'ChangePassword'            => array( 'രഹസ്യവാക്ക്_മാറ്റുക' ),
	'ComparePages'              => array( 'താളുകളുടെതാരതമ്യം' ),
	'Confirmemail'              => array( 'ഇമെയിൽ_സ്ഥിരീകരിക്കുക' ),
	'Contributions'             => array( 'സംഭാവനകൾ' ),
	'CreateAccount'             => array( 'അംഗത്വമെടുക്കൽ' ),
	'Deadendpages'              => array( 'അന്ത്യസ്ഥാനത്തുള്ള_താളുകൾ' ),
	'DeletedContributions'      => array( 'മായ്ച്ച_സേവനങ്ങൾ' ),
	'DoubleRedirects'           => array( 'ഇരട്ടത്തിരിച്ചുവിടലുകൾ' ),
	'EditWatchlist'             => array( 'ശ്രദ്ധിക്കുന്നവയുടെപട്ടികതിരുത്തുക' ),
	'Emailuser'                 => array( 'ഉപയോക്തൃഇമെയിൽ' ),
	'ExpandTemplates'           => array( 'ഫലകങ്ങൾ_വികസിപ്പിക്കുക' ),
	'Export'                    => array( 'കയറ്റുമതി' ),
	'Fewestrevisions'           => array( 'കുറഞ്ഞ_പുനരവലോകനങ്ങൾ' ),
	'FileDuplicateSearch'       => array( 'പ്രമാണത്തിന്റെ_അപരനുള്ള_തിരച്ചിൽ' ),
	'Filepath'                  => array( 'പ്രമാണവിലാസം' ),
	'Import'                    => array( 'ഇറക്കുമതി' ),
	'Invalidateemail'           => array( 'ഇമെയിൽഅസാധുവാക്കുക' ),
	'JavaScriptTest'            => array( 'ജാവാസ്ക്രിപ്റ്റ്പരീക്ഷണം' ),
	'BlockList'                 => array( 'തടയൽ‌പട്ടിക', 'ഐപികളുടെ_തടയൽ‌പട്ടിക' ),
	'LinkSearch'                => array( 'കണ്ണികൾ_തിരയുക' ),
	'Listadmins'                => array( 'കാര്യനിർവാഹകപട്ടിക' ),
	'Listbots'                  => array( 'യന്ത്രങ്ങളുടെ_പട്ടിക' ),
	'Listfiles'                 => array( 'പ്രമാണങ്ങളുടെ_പട്ടിക', 'ചിത്രങ്ങളുടെ_പട്ടിക' ),
	'Listgrouprights'           => array( 'സമൂഹത്തിന്റെ_അവകാശങ്ങളുടെ_പട്ടിക' ),
	'Listredirects'             => array( 'തിരിച്ചുവിടൽ‌പട്ടിക' ),
	'Listusers'                 => array( 'ഉപയോക്താക്കളുടെ_പട്ടിക' ),
	'Lockdb'                    => array( 'ഡി.ബി.ബന്ധിക്കുക' ),
	'Log'                       => array( 'രേഖ', 'രേഖകൾ' ),
	'Lonelypages'               => array( 'അനാഥതാളുകൾ' ),
	'Longpages'                 => array( 'വലിയതാളുകൾ' ),
	'MergeHistory'              => array( 'നാൾവഴിലയിപ്പിക്കുക' ),
	'MIMEsearch'                => array( 'മൈംതിരയൽ' ),
	'Mostcategories'            => array( 'കൂടുതൽ_വർഗ്ഗങ്ങൾ' ),
	'Mostimages'                => array( 'കൂടുതൽ_കണ്ണികളുള്ള_പ്രമാണങ്ങൾ', 'കൂടുതൽ_പ്രമാണങ്ങൾ', 'കൂടുതൽ_ചിത്രങ്ങൾ' ),
	'Mostinterwikis'            => array( 'ഏറ്റവുമധികമന്തർവിക്കികൾ' ),
	'Mostlinked'                => array( 'കൂടുതൽ_കണ്ണികളുള്ള_താളുകൾ', 'കൂടുതൽ_കണ്ണികളുള്ളവ' ),
	'Mostlinkedcategories'      => array( 'കൂടുതൽ_കണ്ണികളുള്ള_വർഗ്ഗങ്ങൾ', 'കൂടുതൽ_ഉപയോഗിച്ചിട്ടുള്ള_വർഗ്ഗങ്ങൾ' ),
	'Mostlinkedtemplates'       => array( 'കൂടുതൽ_കണ്ണികളുള്ള_ഫലകങ്ങൾ', 'കൂടുതൽ_ഉപയോഗിച്ചിട്ടുള്ള_ഫലകങ്ങൾ' ),
	'Mostrevisions'             => array( 'കൂടുതൽ_പുനരവലോകനങ്ങൾ' ),
	'Movepage'                  => array( 'താൾ_മാറ്റുക' ),
	'Mycontributions'           => array( 'എന്റെസംഭാവനകൾ' ),
	'MyLanguage'                => array( 'എന്റെഭാഷ' ),
	'Mypage'                    => array( 'എന്റെതാൾ' ),
	'Mytalk'                    => array( 'എന്റെസംവാദം' ),
	'Myuploads'                 => array( 'ഞാൻഅപ്‌ലോഡ്‌ചെയ്തവ' ),
	'Newimages'                 => array( 'പുതിയ_പ്രമാണങ്ങൾ', 'പുതിയ_ചിത്രങ്ങൾ' ),
	'Newpages'                  => array( 'പുതിയ_താളുകൾ' ),
	'PagesWithProp'             => array( 'താളുകളുടെഉള്ളടക്കപ്രത്യേകതകൾ' ),
	'PasswordReset'             => array( 'രഹസ്യവാക്ക്‌‌പുനക്രമീകരണം' ),
	'PermanentLink'             => array( 'സ്ഥിരംകണ്ണി' ),
	'Popularpages'              => array( 'ജനപ്രിയതാളുകൾ' ),
	'Preferences'               => array( 'ക്രമീകരണങ്ങൾ' ),
	'Prefixindex'               => array( 'പൂർവ്വപദസൂചിക' ),
	'Protectedpages'            => array( 'സംരക്ഷിത_താളുകൾ' ),
	'Protectedtitles'           => array( 'സംരക്ഷിത_ശീർഷകങ്ങൾ' ),
	'Randompage'                => array( 'ക്രമരഹിതം', 'ക്രമരഹിതതാൾ' ),
	'RandomInCategory'          => array( 'വർഗ്ഗത്തിൽനിന്ന്ക്രമരഹിതം' ),
	'Randomredirect'            => array( 'ക്രമരഹിതതിരിച്ചുവിടലുകൾ' ),
	'Recentchanges'             => array( 'സമീപകാലമാറ്റങ്ങൾ' ),
	'Recentchangeslinked'       => array( 'ബന്ധപ്പെട്ട_മാറ്റങ്ങൾ' ),
	'Redirect'                  => array( 'തിരിച്ചുവിടൽ' ),
	'ResetTokens'               => array( 'ചീട്ട്പുനഃസജ്ജീകരിക്കുക' ),
	'Revisiondelete'            => array( 'നാൾപ്പതിപ്പ്_മായ്ക്കൽ' ),
	'Search'                    => array( 'അന്വേഷണം' ),
	'Shortpages'                => array( 'ചെറിയ_താളുകൾ' ),
	'Specialpages'              => array( 'പ്രത്യേകതാളുകൾ' ),
	'Statistics'                => array( 'സ്ഥിതിവിവരം' ),
	'Tags'                      => array( 'റ്റാഗുകൾ' ),
	'Unblock'                   => array( 'തടയൽനീക്കുക' ),
	'Uncategorizedcategories'   => array( 'വർഗ്ഗീകരിക്കാത്ത_വർഗ്ഗങ്ങൾ' ),
	'Uncategorizedimages'       => array( 'വർഗ്ഗീകരിക്കാത്ത_പ്രമാണങ്ങൾ' ),
	'Uncategorizedpages'        => array( 'വർഗ്ഗീകരിക്കാത്ത_താളുകൾ' ),
	'Uncategorizedtemplates'    => array( 'വർഗ്ഗീകരിക്കാത്ത_ഫലകങ്ങൾ' ),
	'Undelete'                  => array( 'മായ്ച്ചവ_പുനഃസ്ഥാപനം' ),
	'Unlockdb'                  => array( 'ഡി.ബി.ബന്ധനംനീക്കുക' ),
	'Unusedcategories'          => array( 'ഉപയോഗിക്കാത്ത_വർഗ്ഗങ്ങൾ' ),
	'Unusedimages'              => array( 'ഉപയോഗിക്കാത്ത_പ്രമാണങ്ങൾ' ),
	'Unusedtemplates'           => array( 'ഉപയോഗിക്കാത്തഫലകങ്ങൾ' ),
	'Unwatchedpages'            => array( 'ആരുംശ്രദ്ധിക്കാത്തതാളുകൾ' ),
	'Upload'                    => array( 'അപ്‌ലോഡ്' ),
	'UploadStash'               => array( 'അപ്‌ലോഡ്_മറയ്ക്കൽ' ),
	'Userlogin'                 => array( 'പ്രവേശനം' ),
	'Userlogout'                => array( 'പുറത്തുകടക്കൽ' ),
	'Userrights'                => array( 'ഉപയോക്തൃഅവകാശങ്ങൾ', 'കാര്യനിർവാഹകസൃഷ്ടി', 'യന്ത്രസൃഷ്ടി' ),
	'Version'                   => array( 'പതിപ്പ്' ),
	'Wantedcategories'          => array( 'ആവശ്യമുള്ള_വർഗ്ഗങ്ങൾ' ),
	'Wantedfiles'               => array( 'ആവശ്യമുള്ള_പ്രമാണങ്ങൾ' ),
	'Wantedpages'               => array( 'ആവശ്യമുള്ള_താളുകൾ', 'പൊട്ടിയ_കണ്ണികൾ' ),
	'Wantedtemplates'           => array( 'ആവശ്യമുള്ള_ഫലകങ്ങൾ' ),
	'Watchlist'                 => array( 'ശ്രദ്ധിക്കുന്നവ' ),
	'Whatlinkshere'             => array( 'കണ്ണികളെന്തെല്ലാം' ),
	'Withoutinterwiki'          => array( 'അന്തർവിക്കിയില്ലാത്തവ' ),
);

$magicWords = array(
	'redirect'                  => array( '0', '#തിരിച്ചുവിടുക', '#തിരിച്ചുവിടൽ', '#REDIRECT' ),
	'notoc'                     => array( '0', '__ഉള്ളടക്കംവേണ്ട__', '__NOTOC__' ),
	'nogallery'                 => array( '0', '__ചിത്രസഞ്ചയംവേണ്ട__', '__NOGALLERY__' ),
	'forcetoc'                  => array( '0', '__ഉള്ളടക്കംഇടുക__', '__FORCETOC__' ),
	'toc'                       => array( '0', '__ഉള്ളടക്കം__', '__TOC__' ),
	'noeditsection'             => array( '0', '__സംശോധിക്കേണ്ട__', '__NOEDITSECTION__' ),
	'currentmonth'              => array( '1', 'ഈമാസം', 'ഈമാസം2', 'CURRENTMONTH', 'CURRENTMONTH2' ),
	'currentmonth1'             => array( '1', 'ഈമാസം1', 'CURRENTMONTH1' ),
	'currentmonthname'          => array( '1', 'ഈമാസത്തിന്റെപേര്‌', 'CURRENTMONTHNAME' ),
	'currentmonthnamegen'       => array( '1', 'ഈമാസത്തിന്റെപേരുസൃഷ്ടിക്കുക', 'CURRENTMONTHNAMEGEN' ),
	'currentmonthabbrev'        => array( '1', 'ഈമാസത്തിന്റെപേര്‌സംഗ്രഹം', 'ഈമാസത്തിന്റെപേര്‌ചുരുക്കം', 'CURRENTMONTHABBREV' ),
	'currentday'                => array( '1', 'ഈദിവസം', 'CURRENTDAY' ),
	'currentday2'               => array( '1', 'ഈദിവസം2', 'CURRENTDAY2' ),
	'currentdayname'            => array( '1', 'ഈദിവസത്തിന്റെപേര്‌', 'CURRENTDAYNAME' ),
	'currentyear'               => array( '1', 'ഈവർഷം', 'CURRENTYEAR' ),
	'currenttime'               => array( '1', 'ഈസമയം', 'CURRENTTIME' ),
	'currenthour'               => array( '1', 'ഈമണിക്കൂർ', 'CURRENTHOUR' ),
	'localmonth'                => array( '1', 'പ്രാദേശികമാസം', 'പ്രാദേശികമാസം2', 'LOCALMONTH', 'LOCALMONTH2' ),
	'localmonth1'               => array( '1', 'പ്രാദേശികമാസം1', 'LOCALMONTH1' ),
	'localmonthname'            => array( '1', 'പ്രാദേശികമാസത്തിന്റെപേര്‌', 'LOCALMONTHNAME' ),
	'localmonthnamegen'         => array( '1', 'പ്രാദേശികമാസത്തിന്റെപേരുസൃഷ്ടിക്കുക', 'LOCALMONTHNAMEGEN' ),
	'localmonthabbrev'          => array( '1', 'പ്രാദേശികമാസത്തിന്റെപേര്‌സംഗ്രഹം', 'പ്രാദേശികമാസത്തിന്റെപേര്‌ചുരുക്കം', 'LOCALMONTHABBREV' ),
	'localday'                  => array( '1', 'പ്രാദേശികദിവസം', 'LOCALDAY' ),
	'localday2'                 => array( '1', 'പ്രാദേശികദിവസം2', 'LOCALDAY2' ),
	'localdayname'              => array( '1', 'പ്രാദേശികദിവസത്തിന്റെപേര്‌', 'LOCALDAYNAME' ),
	'localyear'                 => array( '1', 'പ്രാദേശികവർഷം', 'LOCALYEAR' ),
	'localtime'                 => array( '1', 'പ്രാദേശികസമയം', 'LOCALTIME' ),
	'localhour'                 => array( '1', 'പ്രാദേശികമണിക്കൂർ', 'LOCALHOUR' ),
	'numberofpages'             => array( '1', 'താളുകളുടെയെണ്ണം', 'NUMBEROFPAGES' ),
	'numberofarticles'          => array( '1', 'ലേഖനങ്ങളുടെയെണ്ണം', 'NUMBEROFARTICLES' ),
	'numberoffiles'             => array( '1', 'പ്രമാണങ്ങളുടെയെണ്ണം', 'NUMBEROFFILES' ),
	'numberofusers'             => array( '1', 'ഉപയോക്താക്കളുടെയെണ്ണം', 'അംഗങ്ങളുടെയെണ്ണം', 'NUMBEROFUSERS' ),
	'numberofactiveusers'       => array( '1', 'സജീവോപയാക്താക്കളുടെയെണ്ണം', 'NUMBEROFACTIVEUSERS' ),
	'numberofedits'             => array( '1', 'തിരുത്തലുകളുടെണ്ണം', 'NUMBEROFEDITS' ),
	'numberofviews'             => array( '1', 'എടുത്തുനോക്കലുകളുടെണ്ണം', 'NUMBEROFVIEWS' ),
	'pagename'                  => array( '1', 'താളിന്റെപേര്‌', 'PAGENAME' ),
	'pagenamee'                 => array( '1', 'താളിന്റെപേര്‌സമഗ്രം', 'PAGENAMEE' ),
	'namespace'                 => array( '1', 'നാമമേഖല', 'NAMESPACE' ),
	'namespacee'                => array( '1', 'നാമമേഖലസമഗ്രം', 'NAMESPACEE' ),
	'namespacenumber'           => array( '1', 'നാമമേഖലാസംഖ്യ', 'NAMESPACENUMBER' ),
	'talkspace'                 => array( '1', 'സംവാദമേഖല', 'TALKSPACE' ),
	'talkspacee'                => array( '1', 'സംവാദമേഖലസമഗ്രം', 'TALKSPACEE' ),
	'subjectspace'              => array( '1', 'വിഷയമേഖല', 'ലേഖനമേഖല', 'SUBJECTSPACE', 'ARTICLESPACE' ),
	'subjectspacee'             => array( '1', 'വിഷയമേഖലസമഗ്രം', 'ലേഖനമേഖലസമഗ്രം', 'SUBJECTSPACEE', 'ARTICLESPACEE' ),
	'fullpagename'              => array( '1', 'താളിന്റെമുഴുവൻപേര്‌', 'FULLPAGENAME' ),
	'fullpagenamee'             => array( '1', 'താളിന്റെമുഴുവൻപേര്സമഗ്രം', 'FULLPAGENAMEE' ),
	'subpagename'               => array( '1', 'അനുബന്ധതാളിന്റെപേര്‌', 'SUBPAGENAME' ),
	'subpagenamee'              => array( '1', 'അനുബന്ധതാളിന്റെപേര്സമഗ്രം', 'SUBPAGENAMEE' ),
	'rootpagename'              => array( '1', 'മൂലതാളിന്റെപേര്', 'ROOTPAGENAME' ),
	'rootpagenamee'             => array( '1', 'മൂലതാളിന്റെപേര്‌സമഗ്രം', 'ROOTPAGENAMEE' ),
	'basepagename'              => array( '1', 'അടിസ്ഥാനതാളിന്റെപേര്‌', 'BASEPAGENAME' ),
	'basepagenamee'             => array( '1', 'അടിസ്ഥാനതാളിന്റെപേര്‌സമഗ്രം', 'BASEPAGENAMEE' ),
	'talkpagename'              => array( '1', 'സംവാദതാളിന്റെപേര്‌', 'TALKPAGENAME' ),
	'talkpagenamee'             => array( '1', 'സംവാദതാളിന്റെപേര്‌സമഗ്രം', 'TALKPAGENAMEE' ),
	'subjectpagename'           => array( '1', 'ലേഖനതാളിന്റെപേര്‌', 'SUBJECTPAGENAME', 'ARTICLEPAGENAME' ),
	'subjectpagenamee'          => array( '1', 'ലേഖനതാളിന്റെപേര്‌സമഗ്രം', 'SUBJECTPAGENAMEE', 'ARTICLEPAGENAMEE' ),
	'msg'                       => array( '0', 'സന്ദേശം:', 'MSG:' ),
	'subst'                     => array( '0', 'ബദൽ:', 'ഉൾപ്പെടുത്തൽ:', 'SUBST:' ),
	'safesubst'                 => array( '0', 'സംരക്ഷിതബദൽ:', 'സംരക്ഷിതയുൾപ്പെടുത്തൽ:', 'SAFESUBST:' ),
	'msgnw'                     => array( '0', 'മൂലരൂപം:', 'MSGNW:' ),
	'img_thumbnail'             => array( '1', 'ലഘുചിത്രം', 'ലഘു', 'thumbnail', 'thumb' ),
	'img_manualthumb'           => array( '1', 'ലഘുചിത്രം=$1', 'ലഘു=$1', 'thumbnail=$1', 'thumb=$1' ),
	'img_right'                 => array( '1', 'വലത്ത്‌', 'വലത്‌', 'right' ),
	'img_left'                  => array( '1', 'ഇടത്ത്‌', 'ഇടത്‌', 'left' ),
	'img_none'                  => array( '1', 'ശൂന്യം', 'none' ),
	'img_width'                 => array( '1', '$1ബിന്ദു', '$1px' ),
	'img_center'                => array( '1', 'നടുവിൽ', 'നടുക്ക്‌', 'center', 'centre' ),
	'img_framed'                => array( '1', 'ചട്ടം', 'ചട്ടത്തിൽ', 'framed', 'enframed', 'frame' ),
	'img_frameless'             => array( '1', 'ചട്ടരഹിതം', 'frameless' ),
	'img_lang'                  => array( '1', 'ഭാഷ=$1', 'lang=$1' ),
	'img_page'                  => array( '1', 'താൾ=$1', 'താൾ_$1', 'page=$1', 'page $1' ),
	'img_upright'               => array( '1', 'നേരേകുത്തനെ', 'നേരേകുത്തനെ=$1', 'നേരേകുത്തനെ_$1', 'upright', 'upright=$1', 'upright $1' ),
	'img_border'                => array( '1', 'അതിർവര', 'border' ),
	'img_baseline'              => array( '1', 'താഴെയുള്ളവര', 'baseline' ),
	'img_sub'                   => array( '1', 'കീഴെയെഴുത്ത്', 'sub' ),
	'img_super'                 => array( '1', 'മേലേയെഴുത്ത്', 'super', 'sup' ),
	'img_top'                   => array( '1', 'മേലെ', 'top' ),
	'img_text_top'              => array( '1', 'എഴുത്ത്-മേലെ', 'text-top' ),
	'img_middle'                => array( '1', 'മദ്ധ്യം', 'middle' ),
	'img_bottom'                => array( '1', 'താഴെ', 'bottom' ),
	'img_text_bottom'           => array( '1', 'എഴുത്ത്-താഴെ', 'text-bottom' ),
	'img_link'                  => array( '1', 'കണ്ണി=$1', 'link=$1' ),
	'img_alt'                   => array( '1', 'പകരം=$1', 'alt=$1' ),
	'img_class'                 => array( '1', 'ശ്രേണി=$1', 'class=$1' ),
	'int'                       => array( '0', 'സമ്പർക്കം:', 'INT:' ),
	'sitename'                  => array( '1', 'സൈറ്റിന്റെപേര്', 'SITENAME' ),
	'ns'                        => array( '0', 'നാമേ:', 'NS:' ),
	'nse'                       => array( '0', 'നാമേസ:', 'NSE:' ),
	'localurl'                  => array( '0', 'ലോക്കൽയുആർഎൽ:', 'LOCALURL:' ),
	'localurle'                 => array( '0', 'ലോക്കൽയുആർഎൽഇ:', 'LOCALURLE:' ),
	'articlepath'               => array( '0', 'ലേഖനപഥം', 'ARTICLEPATH' ),
	'pageid'                    => array( '0', 'താൾഐ‌ഡി', 'PAGEID' ),
	'server'                    => array( '0', 'സെർവർ', 'SERVER' ),
	'servername'                => array( '0', 'സെർവറിന്റെപേര്', 'SERVERNAME' ),
	'scriptpath'                => array( '0', 'സ്ക്രിപ്റ്റ്പഥം', 'SCRIPTPATH' ),
	'stylepath'                 => array( '0', 'സ്റ്റൈൽപഥം', 'STYLEPATH' ),
	'grammar'                   => array( '0', 'വ്യാകരണം:', 'GRAMMAR:' ),
	'gender'                    => array( '0', 'ലിംഗം:', 'GENDER:' ),
	'notitleconvert'            => array( '0', '__തലക്കെട്ട്മാറ്റേണ്ട__', '__NOTITLECONVERT__', '__NOTC__' ),
	'nocontentconvert'          => array( '0', '__ഉള്ളടക്കംമാറ്റേണ്ട__', '__NOCONTENTCONVERT__', '__NOCC__' ),
	'currentweek'               => array( '1', 'ആഴ്ച', 'ആഴ്‌ച', 'CURRENTWEEK' ),
	'currentdow'                => array( '1', 'ദിവസത്തിന്റെപേര്‌അക്കത്തിൽ', 'CURRENTDOW' ),
	'localweek'                 => array( '1', 'പ്രാദേശികആഴ്ച', 'പ്രാദേശികആഴ്‌ച', 'LOCALWEEK' ),
	'localdow'                  => array( '1', 'ആഴ്ചയുടെപേര്‌അക്കത്തിൽ', 'ആഴ്‌ചയുടെപേര്‌അക്കത്തിൽ', 'LOCALDOW' ),
	'revisionid'                => array( '1', 'തിരുത്തൽഅടയാളം', 'REVISIONID' ),
	'revisionday'               => array( '1', 'തിരുത്തിയദിവസം', 'തിരുത്തിയദിനം', 'REVISIONDAY' ),
	'revisionday2'              => array( '1', 'തിരുത്തിയദിവസം2', 'തിരുത്തിയദിനം2', 'REVISIONDAY2' ),
	'revisionmonth'             => array( '1', 'തിരുത്തിയമാസം', 'REVISIONMONTH' ),
	'revisionmonth1'            => array( '1', 'തിരുത്തിയമാസം1', 'REVISIONMONTH1' ),
	'revisionyear'              => array( '1', 'തിരുത്തിയവർഷം', 'REVISIONYEAR' ),
	'revisiontimestamp'         => array( '1', 'തിരുത്തിയസമയമുദ്ര', 'REVISIONTIMESTAMP' ),
	'revisionuser'              => array( '1', 'അവസാനംതിരുത്തിയയാൾ', 'REVISIONUSER' ),
	'plural'                    => array( '0', 'ബഹുവചനം:', 'PLURAL:' ),
	'fullurl'                   => array( '0', 'പൂർണ്ണവിലാസം:', 'FULLURL:' ),
	'fullurle'                  => array( '0', 'പൂർണ്ണവിലാസംസമഗ്രം:', 'FULLURLE:' ),
	'canonicalurl'              => array( '0', 'കാനോനിക്കൽവിലാസം:', 'CANONICALURL:' ),
	'canonicalurle'             => array( '0', 'കാനോനിക്കൽവിലാസംസമഗ്രം:', 'CANONICALURLE:' ),
	'raw'                       => array( '0', 'അസംസ്കൃതം:', 'RAW:' ),
	'displaytitle'              => array( '1', 'ശീർഷകംപ്രദർശിപ്പിക്കുക', 'തലക്കെട്ട്പ്രദർശിപ്പിക്കുക', 'DISPLAYTITLE' ),
	'rawsuffix'                 => array( '1', 'വ', 'R' ),
	'newsectionlink'            => array( '1', '__പുതിയവിഭാഗംകണ്ണി__', '__പുതിയഖണ്ഡിക്കണ്ണി__', '__NEWSECTIONLINK__' ),
	'nonewsectionlink'          => array( '1', '__പുതിയവിഭാഗംകണ്ണിവേണ്ട__', '__പുതിയഖണ്ഡിക്കണ്ണിവേണ്ട__', '__NONEWSECTIONLINK__' ),
	'currentversion'            => array( '1', 'ഈപതിപ്പ്', 'CURRENTVERSION' ),
	'urlencode'                 => array( '0', 'വിലാസഗൂഢീകരണം:', 'URLENCODE:' ),
	'currenttimestamp'          => array( '1', 'സമയമുദ്ര', 'CURRENTTIMESTAMP' ),
	'localtimestamp'            => array( '1', 'പ്രാദേശികസമയമുദ്ര', 'LOCALTIMESTAMP' ),
	'directionmark'             => array( '1', 'ദിശാസൂചിക', 'DIRECTIONMARK', 'DIRMARK' ),
	'language'                  => array( '0', '#ഭാഷ:', '#LANGUAGE:' ),
	'contentlanguage'           => array( '1', 'ഉള്ളടക്കഭാഷ', 'CONTENTLANGUAGE', 'CONTENTLANG' ),
	'pagesinnamespace'          => array( '1', 'നാമമേഖലയിലുള്ളതാളുകൾ', 'PAGESINNAMESPACE:', 'PAGESINNS:' ),
	'numberofadmins'            => array( '1', 'കാര്യനിർവ്വാഹകരുടെഎണ്ണം', 'NUMBEROFADMINS' ),
	'formatnum'                 => array( '0', 'ദശാംശഘടന', 'സംഖ്യാഘടന', 'FORMATNUM' ),
	'padleft'                   => array( '0', 'ഇടത്ത്നിറക്കുക', 'PADLEFT' ),
	'padright'                  => array( '0', 'വലത്ത്നിറക്കുക', 'PADRIGHT' ),
	'special'                   => array( '0', 'പ്രത്യേകം', 'special' ),
	'speciale'                  => array( '0', 'സവിശേഷം', 'speciale' ),
	'defaultsort'               => array( '1', 'സ്വതവേയുള്ളക്രമപ്പെടുത്തൽ:', 'സ്വതവേയുള്ളക്രമപ്പെടുത്തൽചാവി:', 'സ്വതവേയുള്ളവർഗ്ഗക്രമപ്പെടുത്തൽ:', 'DEFAULTSORT:', 'DEFAULTSORTKEY:', 'DEFAULTCATEGORYSORT:' ),
	'filepath'                  => array( '0', 'പ്രമാണപഥം:', 'FILEPATH:' ),
	'tag'                       => array( '0', 'റ്റാഗ്', 'ടാഗ്', 'tag' ),
	'hiddencat'                 => array( '1', '‌‌__മറഞ്ഞിരിക്കുംവർഗ്ഗം__', '__HIDDENCAT__' ),
	'pagesincategory'           => array( '1', 'വർഗ്ഗത്തിലുള്ളതാളുകൾ', 'PAGESINCATEGORY', 'PAGESINCAT' ),
	'pagesize'                  => array( '1', 'താൾവലിപ്പം', 'PAGESIZE' ),
	'index'                     => array( '1', '‌‌__സൂചിക__', '__INDEX__' ),
	'noindex'                   => array( '1', '__സൂചികവേണ്ട__', '__NOINDEX__' ),
	'numberingroup'             => array( '1', 'ഗണത്തിലെയെണ്ണം', 'NUMBERINGROUP', 'NUMINGROUP' ),
	'staticredirect'            => array( '1', '_സ്ഥിരസ്ഥിതതിരിച്ചുവിടൽ_', '__STATICREDIRECT__' ),
	'protectionlevel'           => array( '1', 'സംരക്ഷണതലം', 'PROTECTIONLEVEL' ),
	'formatdate'                => array( '0', 'ദിനരേഖീകരണരീതി', 'ദിവസരേഖീകരണരീതി', 'formatdate', 'dateformat' ),
	'url_path'                  => array( '0', 'പഥം', 'PATH' ),
	'url_wiki'                  => array( '0', 'വിക്കി', 'WIKI' ),
	'url_query'                 => array( '0', 'ക്വറി', 'QUERY' ),
	'defaultsort_noerror'       => array( '0', 'പിഴവില്ല', 'noerror' ),
	'defaultsort_noreplace'     => array( '0', 'മാറ്റേണ്ടതില്ല', 'noreplace' ),
	'pagesincategory_all'       => array( '0', 'എല്ലാം', 'all' ),
	'pagesincategory_pages'     => array( '0', 'താളുകൾ', 'pages' ),
	'pagesincategory_subcats'   => array( '0', 'ഉപവർഗ്ഗങ്ങൾ', 'subcats' ),
	'pagesincategory_files'     => array( '0', 'പ്രമാണങ്ങൾ', 'files' ),
);

$linkTrail = "/^([a-z\x{0D02}-\x{0D7F}]+)(.*)$/sDu";

$digitGroupingPattern = "##,##,###";

