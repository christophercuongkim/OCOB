<?php
/** Quechua (Runa Simi)
 *
 * To improve a translation please visit https://translatewiki.net
 *
 * @ingroup Language
 * @file
 *
 * @author AlimanRuna
 * @author Diego Grez
 * @author Kaganer
 * @author Omnipaedista
 * @author Reedy
 * @author The Evil IP address
 * @author לערי ריינהארט
 */

$fallback = 'es';

$namespaceNames = array(
	NS_MEDIA            => 'Midya',
	NS_SPECIAL          => 'Sapaq',
	NS_TALK             => 'Rimanakuy',
	NS_USER             => 'Ruraq',
	NS_USER_TALK        => 'Ruraq_rimanakuy',
	NS_PROJECT_TALK     => '$1_rimanakuy',
	NS_FILE             => 'Rikcha',
	NS_FILE_TALK        => 'Rikcha_rimanakuy',
	NS_MEDIAWIKI        => 'MediaWiki',
	NS_MEDIAWIKI_TALK   => 'MediaWiki_rimanakuy',
	NS_TEMPLATE         => 'Plantilla',
	NS_TEMPLATE_TALK    => 'Plantilla_rimanakuy',
	NS_HELP             => 'Yanapa',
	NS_HELP_TALK        => 'Yanapa_rimanakuy',
	NS_CATEGORY         => 'Katiguriya',
	NS_CATEGORY_TALK    => 'Katiguriya_rimanakuy',
);

// Remove Spanish gender aliases (bug 37090)
$namespaceGenderAliases = array();

$specialPageAliases = array(
	'Allmessages'               => array( 'TukuyWillaykuna' ),
	'Allpages'                  => array( 'TukuyPanqakuna' ),
	'Ancientpages'              => array( 'MawkaPanqa' ),
	'Blankpage'                 => array( 'PanqataChusaqchay' ),
	'Block'                     => array( 'Harkay', 'RuraqtaHarkay', 'IPHarkay' ),
	'Booksources'               => array( 'PukyuLiwru' ),
	'BrokenRedirects'           => array( 'PantaPusapuna', 'PitisqaPusapuna' ),
	'Categories'                => array( 'Katiguriyakuna' ),
	'ChangePassword'            => array( 'YaykunaRimataKutichiy' ),
	'Confirmemail'              => array( 'EChaskitaTakyachiy' ),
	'Contributions'             => array( 'Rurasqakuna', 'Llamkapusqakuna' ),
	'CreateAccount'             => array( 'RakiqunaKamariy' ),
	'Deadendpages'              => array( 'Lluqsinannaq' ),
	'DeletedContributions'      => array( 'QullusqaRurasqa', 'QullusqaLlamkapusqa' ),
	'DoubleRedirects'           => array( 'IskayllaPusapuna' ),
	'Emailuser'                 => array( 'EChaskitaManakuy' ),
	'Export'                    => array( 'HawamanQuy' ),
	'Fewestrevisions'           => array( 'AsllaLlamkapusqa', 'AsllaKutiLlamkapusqa' ),
	'FileDuplicateSearch'       => array( 'IskayllaWillaniqitaMaskay' ),
	'Filepath'                  => array( 'WillaniqiNan' ),
	'Import'                    => array( 'HawamantaChaskiy' ),
	'Invalidateemail'           => array( 'EChaskitaManaallinchay' ),
	'BlockList'                 => array( 'HarkasqaRuraq', 'HarkasqaIP', 'HarkasqaRuraqkuna' ),
	'LinkSearch'                => array( 'TinkitaMaskay', 'TinkikunataMaskay' ),
	'Listadmins'                => array( 'Kamachiqkuna' ),
	'Listbots'                  => array( 'RuranaAntachakuna' ),
	'Listfiles'                 => array( 'RikchaSutisuyu' ),
	'Listgrouprights'           => array( 'HunuHayni', 'HunupHaynin', 'RuraqkunapHayninkuna' ),
	'Listredirects'             => array( 'Pusapunakuna', 'TukuyPusapuna' ),
	'Listusers'                 => array( 'Ruraqkuna', 'RuraqSutisuyu' ),
	'Lockdb'                    => array( 'WillaniqintintaHarkay' ),
	'Log'                       => array( 'Hallcha', 'Hallchasqa' ),
	'Lonelypages'               => array( 'WakchaPanqa' ),
	'Longpages'                 => array( 'HatunPanqa' ),
	'MergeHistory'              => array( 'WinayKawsaytaHunuy' ),
	'MIMEsearch'                => array( 'MIMEkamaMaskay' ),
	'Mostcategories'            => array( 'Katiguriyasapa' ),
	'Mostimages'                => array( 'TinkimuqsapaRikcha' ),
	'Mostlinked'                => array( 'Tinkimuqsapa', 'LliwmantaAswanTinkimuqniyuq' ),
	'Mostlinkedcategories'      => array( 'TinkimuqsapaKatiguriya', 'AnchaLlamkachisqa', 'AchkaKutiLlamkachisqa' ),
	'Mostlinkedtemplates'       => array( 'TinkimuqsapaPlantilla' ),
	'Mostrevisions'             => array( 'AnchaLlamkapusqa', 'AchkaKutiLlamkapusqa' ),
	'Movepage'                  => array( 'PanqataAstay' ),
	'Mycontributions'           => array( 'Rurasqaykuna', 'Llamkapusqaykuna' ),
	'MyLanguage'                => array( 'Rimayniy' ),
	'Mypage'                    => array( 'Panqay', 'NuqapPanqay' ),
	'Mytalk'                    => array( 'Rimachinay', 'RimanakuyPanqay', 'NuqapRimachinay', 'NuqapRimanakuyPanqay' ),
	'Newimages'                 => array( 'MusuqRikcha', 'MusuqRikchakuna' ),
	'Newpages'                  => array( 'MusuqPanqa' ),
	'Popularpages'              => array( 'WatukuqsapaPanqa', 'RikuqsapaPanqa', 'QhawaqsapaPanqa' ),
	'Preferences'               => array( 'Allinkachina', 'Allinkachinakuna' ),
	'Prefixindex'               => array( 'QallarinaKaskaSutisuyu' ),
	'Protectedpages'            => array( 'AmachasqaPanqa' ),
	'Protectedtitles'           => array( 'AmachasqaSuti' ),
	'Randompage'                => array( 'MayninpiPanqa' ),
	'Randomredirect'            => array( 'KikinmantaPusapuna' ),
	'Recentchanges'             => array( 'NaqhaHukchasqa' ),
	'Recentchangeslinked'       => array( 'HukchasqaTinkimuq' ),
	'Revisiondelete'            => array( 'MusuqchasqaQulluy' ),
	'Search'                    => array( 'Maskay' ),
	'Shortpages'                => array( 'UchuyPanqa' ),
	'Specialpages'              => array( 'SapaqPanqa', 'SapaqPanqakuna' ),
	'Statistics'                => array( 'Ranuy', 'Kanchachani' ),
	'Uncategorizedcategories'   => array( 'KatiguriyannaqKatiguriya' ),
	'Uncategorizedimages'       => array( 'KatiguriyannaqRikcha' ),
	'Uncategorizedpages'        => array( 'KatiguriyannaqPanqa' ),
	'Uncategorizedtemplates'    => array( 'KatiguriyannaqPlantilla' ),
	'Undelete'                  => array( 'QullusqataPaqarichiy' ),
	'Unlockdb'                  => array( 'WillaniqintintaPaskay' ),
	'Unusedcategories'          => array( 'ChusaqKatiguriya', 'ManaLlamkachisqaKatiguriya' ),
	'Unusedimages'              => array( 'ManaLlamkachisqaRikcha' ),
	'Unusedtemplates'           => array( 'ManaLlamkachisqaPlantilla' ),
	'Unwatchedpages'            => array( 'ManaWatiqasqa' ),
	'Upload'                    => array( 'Churkuy' ),
	'Userlogin'                 => array( 'RuraqYaykuy' ),
	'Userlogout'                => array( 'RuraqLluqsiy' ),
	'Userrights'                => array( 'RuraqpaHaynin' ),
	'Version'                   => array( 'Musuqchasqa' ),
	'Wantedcategories'          => array( 'MunasqaKatiguriya', 'MunakusqaKatiguriya', 'MuchusqaKatiguriya' ),
	'Wantedfiles'               => array( 'MunasqaWillaniqi', 'MunakusqaWillaniqi', 'MuchusqaWillaniqi' ),
	'Wantedpages'               => array( 'MunasqaPanqa', 'MunakusqaPanqa', 'MuchusqaPanqa' ),
	'Wantedtemplates'           => array( 'MunasqaPlantilla', 'MunakusqaPlantilla', 'MuchusqaPlantilla' ),
	'Watchlist'                 => array( 'Watiqasqa', 'Watiqasqakuna' ),
	'Whatlinkshere'             => array( 'KaymanTinkimuq' ),
	'Withoutinterwiki'          => array( 'Interwikinnaq', 'Wikipurannaq' ),
);

$magicWords = array(
	'redirect'                  => array( '0', '#PUSAPUNA', '#REDIRECCIÓN', '#REDIRECCION', '#REDIRECT' ),
	'notoc'                     => array( '0', '__YUYARINANNAQ__', '__NOTDC__', '__SIN_TDC__', '__NOTOC__' ),
	'nogallery'                 => array( '0', '__RIKCHASUYUNNAQ__', '__NOGALERÍA__', '__NOGALERIA__', '__SIN_GALERÍA__', '__NOGALLERY__' ),
	'forcetoc'                  => array( '0', '__YUYARINATAATIPACHIY__', '__FORZARTDC__', '__FORZARTOC__', '__FORZAR_TDC__', '__FORCETOC__' ),
	'toc'                       => array( '0', '__YUYARINA__', '__TDC__', '__TOC__' ),
	'noeditsection'             => array( '0', '__AMARAKITAHUKCHAYCHU__', '__NOEDITARSECCIÓN__', '__NOEDITARSECCION__', '__NO_EDITAR_SECCIÓN__', '__NOEDITSECTION__' ),
	'currentmonth'              => array( '1', 'KUNANKILLA', 'MESACTUAL', 'MES_ACTUAL', 'MESACTUAL2', 'CURRENTMONTH', 'CURRENTMONTH2' ),
	'currentmonthname'          => array( '1', 'KUNANKILLASUTI', 'NOMBREMESACTUAL', 'NOMBRE_MES_ACTUAL', 'MESACTUALCOMPLETO', 'CURRENTMONTHNAME' ),
	'currentmonthnamegen'       => array( '1', 'KUNANKILLASUTIP', 'GENERADORNOMBREMESACTUAL', 'MESACTUALGENITIVO', 'CURRENTMONTHNAMEGEN' ),
	'currentmonthabbrev'        => array( '1', 'KUNANKILLAPISI', 'ABREVIACIONNOMBREMESACTUAL', 'ABREVIACIÓNNOMBREMESACTUAL', 'MESACTUALABREVIADO', 'CURRENTMONTHABBREV' ),
	'currentday'                => array( '1', 'KUNANPUNCHAW', 'DÍAACTUAL', 'DIAACTUAL', 'DÍA_ACTUAL', 'DIA_ACTUAL', 'CURRENTDAY' ),
	'currentday2'               => array( '1', 'KUNANPUNCHAW2', 'DÍAACTUAL2', 'DIAACTUAL2', 'DÍA_ACTUAL2', 'DIA_ACTUAL2', 'CURRENTDAY2' ),
	'currentdayname'            => array( '1', 'KUNANPUNCHAWSUTI', 'NOMBREDÍAACTUAL', 'NOMBREDIAACTUAL', 'CURRENTDAYNAME' ),
	'currentyear'               => array( '1', 'KUNANWATA', 'AÑOACTUAL', 'AÑO_ACTUAL', 'CURRENTYEAR' ),
	'currenttime'               => array( '1', 'KUNANPACHA', 'HORAACTUAL', 'HORA_ACTUAL', 'HORA_MINUTOS_ACTUAL', 'HORAMINUTOSACTUAL', 'TIEMPOACTUAL', 'CURRENTTIME' ),
	'currenthour'               => array( '1', 'KUNANURA', 'HORAACTUAL', 'HORA_ACTUAL', 'CURRENTHOUR' ),
	'localmonth'                => array( '1', 'KAYPIKILLA', 'MESLOCAL', 'MESLOCAL2', 'LOCALMONTH', 'LOCALMONTH2' ),
	'localmonthname'            => array( '1', 'KAYPIKILLASUTI', 'NOMBREMESLOCAL', 'MESLOCALCOMPLETO', 'LOCALMONTHNAME' ),
	'localmonthnamegen'         => array( '1', 'KAYPIKILLASUTIP', 'GENERADORNOMBREMESLOCAL', 'MESLOCALGENITIVO', 'LOCALMONTHNAMEGEN' ),
	'localmonthabbrev'          => array( '1', 'KAYPIKILLAPISI', 'ABREVIACIONMESLOCAL', 'MESLOCALABREVIADO', 'LOCALMONTHABBREV' ),
	'localday'                  => array( '1', 'KAYPIPUNCHAW', 'DÍALOCAL', 'DIALOCAL', 'LOCALDAY' ),
	'localday2'                 => array( '1', 'KAYPIPUNCHAW2', 'DIALOCAL2', 'DÍALOCAL2', 'LOCALDAY2' ),
	'localdayname'              => array( '1', 'KAYPIPUNCHAWSUTI', 'NOMBREDIALOCAL', 'NOMBREDÍALOCAL', 'LOCALDAYNAME' ),
	'localyear'                 => array( '1', 'KAYPIWATA', 'AÑOLOCAL', 'LOCALYEAR' ),
	'localtime'                 => array( '1', 'KAYPIPACHA', 'HORALOCAL', 'HORAMINUTOSLOCAL', 'TIEMPOLOCAL', 'LOCALTIME' ),
	'localhour'                 => array( '1', 'KAYPIURA', 'HORALOCAL', 'LOCALHOUR' ),
	'numberofpages'             => array( '1', 'HAYKAPANQA', 'NÚMERODEPÁGINAS', 'NUMERODEPAGINAS', 'NUMBEROFPAGES' ),
	'numberofarticles'          => array( '1', 'HAYKAQILLQA', 'NÚMERODEARTÍCULOS', 'NUMERODEARTICULOS', 'NUMBEROFARTICLES' ),
	'numberoffiles'             => array( '1', 'HAYKAWILLANIQI', 'NÚMERODEARCHIVOS', 'NUMERODEARCHIVOS', 'NUMBEROFFILES' ),
	'numberofusers'             => array( '1', 'HAYKARURAQ', 'NÚMERODEUSUARIOS', 'NUMERODEUSUARIOS', 'NUMBEROFUSERS' ),
	'numberofactiveusers'       => array( '1', 'HAYKARURACHKAQ', 'NÚMERODEUSUARIOSACTIVOS', 'NUMERODEUSUARIOSACTIVOS', 'NUMBEROFACTIVEUSERS' ),
	'numberofedits'             => array( '1', 'HAYKALLAMKAPUSQA', 'NÚMERODEEDICIONES', 'NUMERODEEDICIONES', 'NUMBEROFEDITS' ),
	'numberofviews'             => array( '1', 'HAYKAQHAWASQA', 'HAYKAQAWASQA', 'NÚMERODEVISTAS', 'NUMERODEVISTAS', 'NUMBEROFVIEWS' ),
	'pagename'                  => array( '1', 'PANQASUTI', 'NOMBREDEPAGINA', 'NOMBREDEPÁGINA', 'PAGENAME' ),
	'pagenamee'                 => array( '1', 'PANQASUTIE', 'NOMBREDEPAGINAC', 'NOMBREDEPÁGINAC', 'PAGENAMEE' ),
	'namespace'                 => array( '1', 'SUTIKITI', 'ESPACIODENOMBRE', 'NAMESPACE' ),
	'namespacee'                => array( '1', 'SUTIKITIE', 'ESPACIODENOMBREC', 'NAMESPACEE' ),
	'talkspace'                 => array( '1', 'RIMANAKUYKITI', 'RIMAYKITI', 'ESPACIODEDISCUSION', 'ESPACIODEDISCUSIÓN', 'TALKSPACE' ),
	'talkspacee'                => array( '1', 'RIMANAKUYKITIE', 'RIMAYKITIE', 'ESPACIODEDISCUSIONC', 'TALKSPACEE' ),
	'subjectspace'              => array( '1', 'QILLQAKITI', 'ESPACIODEASUNTO', 'ESPACIODETEMA', 'ESPACIODEARTÍCULO', 'ESPACIODEARTICULO', 'SUBJECTSPACE', 'ARTICLESPACE' ),
	'subjectspacee'             => array( '1', 'QILLQAKITIE', 'ESPACIODETEMAC', 'ESPACIODEASUNTOC', 'ESPACIODEARTICULOC', 'ESPACIODEARTÍCULOC', 'SUBJECTSPACEE', 'ARTICLESPACEE' ),
	'fullpagename'              => array( '1', 'HUNTAPANQASUTI', 'NOMBREDEPÁGINACOMPLETA', 'NOMBREDEPAGINACOMPLETA', 'NOMBREDEPÁGINAENTERA', 'NOMBREDEPAGINAENTERA', 'NOMBRECOMPLETODEPÁGINA', 'NOMBRECOMPLETODEPAGINA', 'FULLPAGENAME' ),
	'fullpagenamee'             => array( '1', 'HUNTAPANQASUTIE', 'NOMBRECOMPLETODEPAGINAC', 'NOMBRECOMPLETODEPÁGINAC', 'FULLPAGENAMEE' ),
	'subpagename'               => array( '1', 'URINPANQASUTI', 'NOMBREDESUBPAGINA', 'NOMBREDESUBPÁGINA', 'SUBPAGENAME' ),
	'subpagenamee'              => array( '1', 'URINPANQASUTIE', 'NOMBREDESUBPAGINAC', 'NOMBREDESUBPÁGINAC', 'SUBPAGENAMEE' ),
	'basepagename'              => array( '1', 'TIKSIPANQASUTI', 'NOMBREDEPAGINABASE', 'NOMBREDEPÁGINABASE', 'BASEPAGENAME' ),
	'basepagenamee'             => array( '1', 'TIKSIPANQASUTIE', 'NOMBREDEPAGINABASEC', 'NOMBREDEPÁGINABASEC', 'BASEPAGENAMEE' ),
	'talkpagename'              => array( '1', 'RIMANAKUYPANQASUTI', 'NOMBREDEPÁGINADEDISCUSIÓN', 'NOMBREDEPAGINADEDISCUSION', 'NOMBREDEPAGINADISCUSION', 'NOMBREDEPÁGINADISCUSIÓN', 'TALKPAGENAME' ),
	'talkpagenamee'             => array( '1', 'RIMANAKUYPANQASUTIE', 'NOMBREDEPÁGINADEDISCUSIÓNC', 'NOMBREDEPAGINADEDISCUSIONC', 'NOMBREDEPAGINADISCUSIONC', 'NOMBREDEPÁGINADISCUSIÓNC', 'TALKPAGENAMEE' ),
	'subjectpagename'           => array( '1', 'QILLQAPANQASUTI', 'NOMBREDEPAGINADETEMA', 'NOMBREDEPÁGINADETEMA', 'NOMBREDEPÁGINADEASUNTO', 'NOMBREDEPAGINADEASUNTO', 'NOMBREDEPAGINADEARTICULO', 'NOMBREDEPÁGINADEARTÍCULO', 'SUBJECTPAGENAME', 'ARTICLEPAGENAME' ),
	'subjectpagenamee'          => array( '1', 'QILLQAPANQASUTIE', 'NOMBREDEPAGINADETEMAC', 'NOMBREDEPÁGINADETEMAC', 'NOMBREDEPÁGINADEASUNTOC', 'NOMBREDEPAGINADEASUNTOC', 'NOMBREDEPAGINADEARTICULOC', 'NOMBREDEPÁGINADEARTÍCULOC', 'SUBJECTPAGENAMEE', 'ARTICLEPAGENAMEE' ),
	'msg'                       => array( '0', 'WILLA:', 'MSJ:', 'MSG:' ),
	'subst'                     => array( '0', 'WAKCHAY:', 'SUST:', 'FIJAR:', 'SUBST:' ),
	'msgnw'                     => array( '0', 'WILLAMUSUQ:', 'MSGNW:' ),
	'img_thumbnail'             => array( '1', 'rikchacha', 'miniaturadeimagen', 'miniatura', 'mini', 'thumbnail', 'thumb' ),
	'img_manualthumb'           => array( '1', 'rikchacha=$1', 'miniaturadeimagen=$1', 'miniatura=$1', 'thumbnail=$1', 'thumb=$1' ),
	'img_right'                 => array( '1', 'paña', 'alliq', 'derecha', 'dcha', 'der', 'right' ),
	'img_left'                  => array( '1', 'lluqi', 'ichuq', 'izquierda', 'izda', 'izq', 'left' ),
	'img_none'                  => array( '1', 'manaima', 'mana', 'ninguna', 'nada', 'no', 'ninguno', 'none' ),
	'img_center'                => array( '1', 'chawpi', 'centro', 'centrado', 'centrada', 'centrar', 'center', 'centre' ),
	'img_framed'                => array( '1', 'inchuyuq', 'inchu', 'marco', 'enmarcado', 'enmarcada', 'framed', 'enframed', 'frame' ),
	'img_frameless'             => array( '1', 'inchunnaq', 'sinmarco', 'sin_embarcar', 'sinenmarcar', 'sin_enmarcar', 'frameless' ),
	'img_page'                  => array( '1', 'panqa=$1', 'pagina=$1', 'página=$1', 'pagina_$1', 'página_$1', 'page=$1', 'page $1' ),
	'img_upright'               => array( '1', 'sayaq', 'sayaq=$1', 'upright', 'upright=$1', 'upright $1' ),
	'img_border'                => array( '1', 'saywa', 'borde', 'border' ),
	'img_baseline'              => array( '1', 'tiksisiqi', 'baseline' ),
	'img_sub'                   => array( '1', 'uran', 'sub' ),
	'img_super'                 => array( '1', 'hanan', 'super', 'sup' ),
	'img_top'                   => array( '1', 'hawa', 'top' ),
	'img_text_top'              => array( '1', 'qillqahawa', 'text-top' ),
	'img_middle'                => array( '1', 'ukhupi', 'middle' ),
	'img_bottom'                => array( '1', 'sikipi', 'bottom' ),
	'img_text_bottom'           => array( '1', 'qillqasiki', 'text-bottom' ),
	'img_link'                  => array( '1', 'tinki=$1', 'vínculo=$1', 'vinculo=$1', 'enlace=$1', 'link=$1' ),
	'img_alt'                   => array( '1', 'wak=$1', 'alt=$1' ),
	'int'                       => array( '0', 'WILLAY:', 'INT:' ),
	'sitename'                  => array( '1', 'TIYAYSUTI', 'NOMBREDESITIO', 'NOMBREDELSITIO', 'SITENAME' ),
	'ns'                        => array( '0', 'SKITI:', 'EN:', 'NS:' ),
	'localurl'                  => array( '0', 'KAYLLAURL:', 'URLLOCAL', 'LOCALURL:' ),
	'localurle'                 => array( '0', 'KAYLLAURLE:', 'URLLOCALC:', 'LOCALURLE:' ),
	'server'                    => array( '0', 'SIRWIQ', 'SERVIDOR', 'SERVER' ),
	'servername'                => array( '0', 'SIRWIQSUTI', 'NOMBRESERVIDOR', 'SERVERNAME' ),
	'scriptpath'                => array( '0', 'QILLQAÑAN', 'QILLQANAN', 'RUTASCRIPT', 'RUTADESCRIPT', 'SCRIPTPATH' ),
	'grammar'                   => array( '0', 'SIMIKAMACHIY:', 'GRAMATICA:', 'GRAMÁTICA:', 'GRAMMAR:' ),
	'gender'                    => array( '0', 'QHARIWARMI:', 'QARIWARMI:', 'GÉNERO:', 'GENERO:', 'GENDER:' ),
	'notitleconvert'            => array( '0', '__AMASUTITAHUKCHAYCHU__', '__NOCONVERTIRTITULO__', '__NOCONVERTIRTÍTULO__', '__NOCT___', '__NOTITLECONVERT__', '__NOTC__' ),
	'nocontentconvert'          => array( '0', '__AMASAMIQTAHUKCHAYCHU__', '__NOCONVERTIRCONTENIDO__', '__NOCC___', '__NOCONTENTCONVERT__', '__NOCC__' ),
	'currentweek'               => array( '1', 'KUNANSIMANA', 'SEMANAACTUAL', 'CURRENTWEEK' ),
	'currentdow'                => array( '1', 'KUNANSIMANAPUNCHAW', 'DDSACTUAL', 'DIADESEMANAACTUAL', 'DÍADESEMANAACTUAL', 'CURRENTDOW' ),
	'localweek'                 => array( '1', 'KAYLLASIMANA', 'SEMANALOCAL', 'LOCALWEEK' ),
	'localdow'                  => array( '1', 'KAYLLASIMANAPUNCHAW', 'DDSLOCAL', 'DIADESEMANALOCAL', 'DÍADESEMANALOCAL', 'LOCALDOW' ),
	'revisionid'                => array( '1', 'MUSUQCHASQAID', 'IDDEREVISION', 'IDREVISION', 'IDDEREVISIÓN', 'IDREVISIÓN', 'REVISIONID' ),
	'revisionday'               => array( '1', 'MUSUQCHASQAPUNCHAW', 'DIADEREVISION', 'DIAREVISION', 'DÍADEREVISIÓN', 'DÍAREVISIÓN', 'REVISIONDAY' ),
	'revisionday2'              => array( '1', 'MUSUQCHASQAPUNCHAW2', 'DIADEREVISION2', 'DIAREVISION2', 'DÍADEREVISIÓN2', 'DÍAREVISIÓN2', 'REVISIONDAY2' ),
	'revisionmonth'             => array( '1', 'MUSUQCHASQAKILLA', 'MESDEREVISION', 'MESDEREVISIÓN', 'MESREVISION', 'MESREVISIÓN', 'REVISIONMONTH' ),
	'revisionyear'              => array( '1', 'MUSUQCHASQAWATA', 'AÑODEREVISION', 'AÑODEREVISIÓN', 'AÑOREVISION', 'AÑOREVISIÓN', 'REVISIONYEAR' ),
	'revisiontimestamp'         => array( '1', 'MUSUQCHASQAPACHAQILLPA', 'MARCADEHORADEREVISION', 'MARCADEHORADEREVISIÓN', 'REVISIONTIMESTAMP' ),
	'revisionuser'              => array( '1', 'MUSUQCHASQARURAQ', 'USUARIODEREVISION', 'USUARIODEREVISIÓN', 'REVISIONUSER' ),
	'plural'                    => array( '0', 'ACHKA:', 'PLURAL:' ),
	'fullurl'                   => array( '0', 'HUNTAURL:', 'URLCOMPLETA:', 'FULLURL:' ),
	'fullurle'                  => array( '0', 'HUNTAURLE:', 'URLCOMPLETAC:', 'FULLURLE:' ),
	'lcfirst'                   => array( '0', 'UCHUYÑAWPAQ:', 'UCHUYNAWPAQ:', 'PRIMEROMINUS;', 'PRIMEROMINÚS:', 'LCFIRST:' ),
	'ucfirst'                   => array( '0', 'HATUNÑAWPAQ:', 'HATUNNAWPAQ:', 'PRIMEROMAYUS;', 'PRIMEROMAYÚS:', 'UCFIRST:' ),
	'lc'                        => array( '0', 'UCHUY:', 'MINUS:', 'MINÚS:', 'LC:' ),
	'uc'                        => array( '0', 'HATUN:', 'MAYUS:', 'MAYÚS:', 'UC:' ),
	'raw'                       => array( '0', 'CHAWA:', 'SINFORMATO', 'SINPUNTOS', 'RAW:' ),
	'displaytitle'              => array( '1', 'SUTITARIKUCHIY', 'MOSTRARTÍTULO', 'MOSTRARTITULO', 'DISPLAYTITLE' ),
	'currentversion'            => array( '1', 'KUNANMUSUQCHASQA', 'REVISIÓNACTUAL', 'VERSIONACTUAL', 'VERSIÓNACTUAL', 'CURRENTVERSION' ),
	'urlencode'                 => array( '0', 'URLLLAWICHAY', 'URL-LLAWICHAY', 'CODIFICAR', 'CODIFICARURL:', 'URLENCODE:' ),
	'anchorencode'              => array( '0', 'WATANALLAWICHAY', 'ANCHORENCODE' ),
	'currenttimestamp'          => array( '1', 'KUNANPACHAQILLPA', 'MARCADEHORAACTUAL', 'CURRENTTIMESTAMP' ),
	'localtimestamp'            => array( '1', 'KAYLLAPACHAQILLPA', 'MARCADEHORALOCAL', 'LOCALTIMESTAMP' ),
	'directionmark'             => array( '1', 'PURIRIYSANANCHA', 'DIRECTIONMARK', 'DIRMARK' ),
	'language'                  => array( '0', '#RIMAY:', '#IDIOMA:', '#LANGUAGE:' ),
	'contentlanguage'           => array( '1', 'SAMIQRIMAY', 'IDIOMADELCONTENIDO', 'IDIOMADELCONT', 'CONTENTLANGUAGE', 'CONTENTLANG' ),
	'pagesinnamespace'          => array( '1', 'SUTIKITIPIPANQAKUNA:', 'PÁGINASENESPACIO', 'PAGESINNAMESPACE:', 'PAGESINNS:' ),
	'numberofadmins'            => array( '1', 'HAYKAKAMACHIQ', 'NÚMEROADMINISITRADORES', 'NÚMEROADMINS', 'NUMEROADMINS', 'NUMEROADMINISTRADORES', 'NUMERODEADMINISTRADORES', 'NUMERODEADMINS', 'NÚMERODEADMINISTRADORES', 'NÚMERODEADMINS', 'NÚMEROADMINIISTRADORES', 'NUMBEROFADMINS' ),
	'formatnum'                 => array( '0', 'YUPAYRIKCHAKUY', 'FORMATONÚMERO', 'FORMATONUMERO', 'FORMATNUM' ),
	'padleft'                   => array( '0', 'PADLLUQI', 'PADICHUQ', 'PADLEFT' ),
	'padright'                  => array( '0', 'PADPAÑA', 'PADALLIQ', 'PADRIGHT' ),
	'special'                   => array( '0', 'sapaq', 'especial', 'special' ),
	'defaultsort'               => array( '1', 'ALLINCHAY:', 'SIQINCHAY:', 'ORDENAR:', 'ORDENPREDETERMINADO:', 'CLAVEDEORDENPREDETERMINADO:', 'ORDENDECATEGORIAPREDETERMINADO:', 'ORDENDECATEGORÍAPREDETERMINADO:', 'DEFAULTSORT:', 'DEFAULTSORTKEY:', 'DEFAULTCATEGORYSORT:' ),
	'filepath'                  => array( '0', 'WILLAÑIQIÑAN', 'WILLANIQINAN', 'RUTAARCHIVO', 'RUTARCHIVO', 'RUTAARCHIVO:', 'RUTARCHIVO:', 'RUTADEARCHIVO:', 'FILEPATH:' ),
	'tag'                       => array( '0', 'unanchacha', 'UNANCHACHA', 'etiqueta', 'ETIQUETA', 'tag' ),
	'hiddencat'                 => array( '1', '__PAKASQAKATIGURIYA__', '__CATEGORÍAOCULTA__', '__HIDDENCAT__' ),
	'pagesincategory'           => array( '1', 'KATIGURIYAPIPANQAKUNA', 'PÁGINASENCATEGORÍA', 'PÁGINASENCAT', 'PAGSENCAT', 'PAGINASENCATEGORIA', 'PAGINASENCAT', 'PAGESINCATEGORY', 'PAGESINCAT' ),
	'pagesize'                  => array( '1', 'PANQACHHIKAN', 'PANQACHIKAN', 'PANQACHIKA', 'TAMAÑOPÁGINA', 'TAMAÑODEPÁGINA', 'TAMAÑOPAGINA', 'TAMAÑODEPAGINA', 'PAGESIZE' ),
	'index'                     => array( '1', '__UNANCHAY__', '__INDEXAR__', '__INDEX__' ),
	'noindex'                   => array( '1', '__AMAUNANCHAYCHU__', '__NOINDEXAR__', '__NOINDEX__' ),
	'numberingroup'             => array( '1', 'HUÑUPIYUPAY', 'HUNUPIYUPAY', 'NÚMEROENGRUPO', 'NUMEROENGRUPO', 'NUMENGRUPO', 'NÚMENGRUPO', 'NUMBERINGROUP', 'NUMINGROUP' ),
	'staticredirect'            => array( '1', '__TIYAQLLAPUSAPUNA__', '__REDIRECCIONESTATICA__', '__REDIRECCIÓNESTÁTICA__', '__STATICREDIRECT__' ),
	'protectionlevel'           => array( '1', 'HAYKAAMACHAY', 'IMASINCHIAMACHAY', 'NIVELDEPROTECCIÓN', 'PROTECTIONLEVEL' ),
);

