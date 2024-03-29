<?php
/** Moksha (мокшень)
 *
 * See MessagesQqq.php for message documentation incl. usage of parameters
 * To improve a translation please visit http://translatewiki.net
 *
 * @ingroup Language
 * @file
 *
 * @author Jarmanj Turtash
 * @author Kaganer
 * @author Khazar II
 * @author Kranch
 * @author Numulunj pilgae
 */

$fallbak = 'ru';

$namespaceNames = array(
	NS_MEDIA            => 'Медиа',
	NS_SPECIAL          => 'Башка',
	NS_TALK             => 'Корхнема',
	NS_USER             => 'Тиись',
	NS_USER_TALK        => 'Тиись_корхнема',
	NS_PROJECT_TALK     => '$1_корхнема',
	NS_FILE             => 'Няйф',
	NS_FILE_TALK        => 'Няйф_корхнема',
	NS_MEDIAWIKI        => 'МедиаВики',
	NS_MEDIAWIKI_TALK   => 'МедиаВики_корхнема',
	NS_TEMPLATE         => 'Шаблон',
	NS_TEMPLATE_TALK    => 'Шаблон_корхнема',
	NS_HELP             => 'Лезкс',
	NS_HELP_TALK        => 'Лезкс_корхнема',
	NS_CATEGORY         => 'Категорие',
	NS_CATEGORY_TALK    => 'Категорие_корхнема',
);

$namespaceAliases = array(
	'Служебная' => NS_SPECIAL,
	'Обсуждение' => NS_TALK,
	'Участник' => NS_USER,
	'Обсуждение_участника' => NS_USER_TALK,
	'Обсуждение_{{GRAMMAR:genitive|$1}}' => NS_PROJECT_TALK,
	'Изображение' => NS_FILE,
	'Обсуждение_изображения' => NS_FILE_TALK,
	'MediaWiki' => NS_MEDIAWIKI,
	'Обсуждение_MediaWiki' => NS_MEDIAWIKI_TALK,
	'Шаблон' => NS_TEMPLATE,
	'Обсуждение_шаблона' => NS_TEMPLATE_TALK,
	'Справка' => NS_HELP,
	'Обсуждение_справки' => NS_HELP_TALK,
	'Категория' => NS_CATEGORY,
	'Обсуждение_категории' => NS_CATEGORY_TALK,
);

$specialPageAliases = array(
	'Allmessages'               => array( 'СембеПачфтематне' ),
	'Allpages'                  => array( 'СембеЛопат' ),
	'Ancientpages'              => array( 'КунардоньЛопат' ),
	'Blankpage'                 => array( 'ШаваЛопа' ),
	'Block'                     => array( 'СёлгомаIP' ),
	'Booksources'               => array( 'КинигаЛисьмот' ),
	'BrokenRedirects'           => array( 'СиньтьфШашфтфксне' ),
	'Categories'                => array( 'Категориет' ),
	'ChangePassword'            => array( 'ПолафттСувама', 'ПолафттСувама вал' ),
	'Confirmemail'              => array( 'КемокстакАдрес' ),
	'Contributions'             => array( 'Путксне' ),
	'CreateAccount'             => array( 'Сёрматфтомс' ),
	'Deadendpages'              => array( 'ПеньЛопат' ),
	'DeletedContributions'      => array( 'НардафПутксне' ),
	'DoubleRedirects'           => array( 'КафонзафШашфтфксне' ),
	'Emailuser'                 => array( 'АдресТиись' ),
	'Export'                    => array( 'Вимс' ),
	'Fewestrevisions'           => array( 'КържаВерзиет' ),
	'FileDuplicateSearch'       => array( 'ФайлКафонзафВешендема' ),
	'Filepath'                  => array( 'ФайлКиц' ),
	'Import'                    => array( 'Сувафтомс' ),
	'Invalidateemail'           => array( 'Аф кемокстамс адресть' ),
	'BlockList'                 => array( 'IPСёлгоматЛувома' ),
	'LinkSearch'                => array( 'СюлмафксВешендема' ),
	'Listadmins'                => array( 'ЛувомаСистемонь вятиксне' ),
	'Listbots'                  => array( 'ЛувомаРоботт програпне' ),
	'Listfiles'                 => array( 'НяйфКярькс' ),
	'Listgrouprights'           => array( 'ЛувомаПолгаВидексне' ),
	'Listredirects'             => array( 'ЛувомаШашфтфксне' ),
	'Listusers'                 => array( 'ЛувомТиихне' ),
	'Lockdb'                    => array( 'ПякстамсДатабазать' ),
	'Log'                       => array( 'Лувома', 'Лувомат' ),
	'Lonelypages'               => array( 'СькамоньЛопат', 'УрозЛопат' ),
	'Longpages'                 => array( 'КувакаЛопат' ),
	'MergeHistory'              => array( 'ШоворемсИсториять' ),
	'MIMEsearch'                => array( 'MIMEВешендема' ),
	'Mostcategories'            => array( 'СембодаКатегориет' ),
	'Mostimages'                => array( 'СембодаНяйфне' ),
	'Mostlinked'                => array( 'СембодаСюлмафт' ),
	'Mostlinkedcategories'      => array( 'СембодаСюлмафтКатегориет' ),
	'Mostlinkedtemplates'       => array( 'СембодаСюлмафтШаблотт' ),
	'Mostrevisions'             => array( 'СембодаВерзиет' ),
	'Movepage'                  => array( 'ШашфттЛопа' ),
	'Mycontributions'           => array( 'МоньПутксне' ),
	'Mypage'                    => array( 'МоньЛопазе' ),
	'Mytalk'                    => array( 'МоньКорхнемазе' ),
	'Newimages'                 => array( 'ОдНяйфне' ),
	'Newpages'                  => array( 'ОдЛопат' ),
	'Popularpages'              => array( 'СидестаЛопатне' ),
	'Preferences'               => array( 'Латцематне' ),
	'Prefixindex'               => array( 'ВалынгольксИндекс' ),
	'Protectedpages'            => array( 'АралафЛопат' ),
	'Protectedtitles'           => array( 'АралафКонякст' ),
	'Randompage'                => array( 'Кодама повсь', 'Кодама повсь лопа' ),
	'Randomredirect'            => array( 'Кона повсьШашфтфкс' ),
	'Recentchanges'             => array( 'УлхкомбаньПолафнематне' ),
	'Recentchangeslinked'       => array( 'УлхкомбаньПолафнематСюлмафт' ),
	'Revisiondelete'            => array( 'ВерзиеНардамс' ),
	'Search'                    => array( 'Вешендема' ),
	'Shortpages'                => array( 'НюрьхкяняЛопат' ),
	'Specialpages'              => array( 'БашкаЛопат' ),
	'Statistics'                => array( 'Статистик' ),
	'Uncategorizedcategories'   => array( 'Апак категорияфттКатегориет' ),
	'Uncategorizedimages'       => array( 'Апак категорияфттНяйфт' ),
	'Uncategorizedpages'        => array( 'Апак категорияфттЛопат' ),
	'Uncategorizedtemplates'    => array( 'Апак категорияфттШаблотт' ),
	'Undelete'                  => array( 'Мърдафтомс' ),
	'Unlockdb'                  => array( 'ПанжемсДатабазать' ),
	'Unusedcategories'          => array( 'Апак нолдак тевсКатегориет' ),
	'Unusedimages'              => array( 'Апак нолдак тевсНяйфне' ),
	'Unusedtemplates'           => array( 'Апак нолдак тевсШаблотт' ),
	'Unwatchedpages'            => array( 'МельгеваномафтомаЛопат' ),
	'Upload'                    => array( 'Тонгома' ),
	'Userlogin'                 => array( 'ТииньСувама' ),
	'Userlogout'                => array( 'ТииньЛисема' ),
	'Userrights'                => array( 'ТииньВидексонза' ),
	'Version'                   => array( 'Верзие' ),
	'Wantedcategories'          => array( 'ВешевиКатегориет' ),
	'Wantedfiles'               => array( 'ВешевиФайлхт' ),
	'Wantedpages'               => array( 'ВешевиЛопат', 'СиньтьфСюлмафкст' ),
	'Wantedtemplates'           => array( 'ВешевиШаблотт' ),
	'Watchlist'                 => array( 'Мельгеванома' ),
	'Whatlinkshere'             => array( 'МезеньСюлмафкстТяса' ),
	'Withoutinterwiki'          => array( 'Интервикифтома' ),
);

