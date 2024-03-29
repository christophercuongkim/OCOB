<?php
/** Galician (galego)
 *
 * To improve a translation please visit https://translatewiki.net
 *
 * @ingroup Language
 * @file
 *
 */

$fallback = 'pt';

$namespaceNames = array(
	NS_MEDIA            => 'Media',
	NS_SPECIAL          => 'Especial',
	NS_TALK             => 'Conversa',
	NS_USER             => 'Usuario',
	NS_USER_TALK        => 'Conversa_usuario',
	NS_PROJECT_TALK     => 'Conversa_$1',
	NS_FILE             => 'Ficheiro',
	NS_FILE_TALK        => 'Conversa_ficheiro',
	NS_MEDIAWIKI        => 'MediaWiki',
	NS_MEDIAWIKI_TALK   => 'Conversa_MediaWiki',
	NS_TEMPLATE         => 'Modelo',
	NS_TEMPLATE_TALK    => 'Conversa_modelo',
	NS_HELP             => 'Axuda',
	NS_HELP_TALK        => 'Conversa_axuda',
	NS_CATEGORY         => 'Categoría',
	NS_CATEGORY_TALK    => 'Conversa_categoría',
);

$namespaceAliases = array(
	'Conversa_Usuario' => NS_USER_TALK,
	'Imaxe' => NS_FILE,
	'Conversa_Imaxe' => NS_FILE_TALK,
	'Conversa_Modelo' => NS_TEMPLATE_TALK,
	'Conversa_Axuda' => NS_HELP_TALK,
	'Conversa_Categoría' => NS_CATEGORY_TALK,
);

$namespaceGenderAliases = array(
	NS_USER => array( 'male' => 'Usuario', 'female' => 'Usuaria' ),
	NS_USER_TALK => array( 'male' => 'Conversa_usuario', 'female' => 'Conversa_usuaria' ),
);

$defaultDateFormat = 'dmy';

$dateFormats = array(
	'dmy time' => 'H:i',
	'dmy date' => 'j \d\e F \d\e Y',
	'dmy both' => 'j \d\e F \d\e Y "ás" H:i',
);

$specialPageAliases = array(
	'Activeusers'               => array( 'Usuarios_activos' ),
	'Allmessages'               => array( 'Todas_as_mensaxes' ),
	'AllMyUploads'              => array( 'Todas_as_miñas_cargas', 'Todos_os_meus_ficheiros' ),
	'Allpages'                  => array( 'Todas_as_páxinas' ),
	'Ancientpages'              => array( 'Páxinas_máis_antigas' ),
	'Badtitle'                  => array( 'Título_incorrecto' ),
	'Blankpage'                 => array( 'Baleirar_a_páxina' ),
	'Block'                     => array( 'Bloquear', 'Bloquear_o_enderezo_IP', 'Bloquear_o_usuario' ),
	'Booksources'               => array( 'Fontes_bibliográficas' ),
	'BrokenRedirects'           => array( 'Redireccións_rotas' ),
	'Categories'                => array( 'Categorías' ),
	'ChangeEmail'               => array( 'Cambiar_o_correo_electrónico' ),
	'ChangePassword'            => array( 'Cambiar_o_contrasinal' ),
	'ComparePages'              => array( 'Comparar_as_páxinas' ),
	'Confirmemail'              => array( 'Confirmar_o_correo_electrónico' ),
	'Contributions'             => array( 'Contribucións' ),
	'CreateAccount'             => array( 'Crear_unha_conta' ),
	'Deadendpages'              => array( 'Páxinas_mortas' ),
	'DeletedContributions'      => array( 'Contribucións_borradas' ),
	'DoubleRedirects'           => array( 'Redireccións_dobres' ),
	'EditWatchlist'             => array( 'Editar_a_lista_de_vixilancia' ),
	'Emailuser'                 => array( 'Correo_electrónico' ),
	'ExpandTemplates'           => array( 'Expandir_os_modelos' ),
	'Export'                    => array( 'Exportar' ),
	'Fewestrevisions'           => array( 'Páxinas_con_menos_revisións' ),
	'FileDuplicateSearch'       => array( 'Procura_de_ficheiros_duplicados' ),
	'Filepath'                  => array( 'Ruta_do_ficheiro' ),
	'Import'                    => array( 'Importar' ),
	'Invalidateemail'           => array( 'Invalidar_o_enderezo_de_correo_electrónico' ),
	'JavaScriptTest'            => array( 'Proba_do_JavaScript' ),
	'BlockList'                 => array( 'Lista_de_bloqueos', 'Lista_dos_bloqueos_a_enderezos_IP' ),
	'LinkSearch'                => array( 'Buscar_ligazóns_web' ),
	'Listadmins'                => array( 'Lista_de_administradores' ),
	'Listbots'                  => array( 'Lista_de_bots' ),
	'Listfiles'                 => array( 'Lista_de_imaxes' ),
	'Listgrouprights'           => array( 'Lista_de_dereitos_segundo_o_grupo' ),
	'Listredirects'             => array( 'Lista_de_redireccións' ),
	'Listusers'                 => array( 'Lista_de_usuarios' ),
	'Lockdb'                    => array( 'Pechar_a_base_de_datos' ),
	'Log'                       => array( 'Rexistros' ),
	'Lonelypages'               => array( 'Páxinas_orfas' ),
	'Longpages'                 => array( 'Páxinas_longas' ),
	'MergeHistory'              => array( 'Fusionar_os_historiais' ),
	'MIMEsearch'                => array( 'Procura_MIME' ),
	'Mostcategories'            => array( 'Páxinas_con_máis_categorías' ),
	'Mostimages'                => array( 'Ficheiros_máis_ligados' ),
	'Mostinterwikis'            => array( 'Páxinas_con_máis_interwikis' ),
	'Mostlinked'                => array( 'Páxinas_máis_ligadas' ),
	'Mostlinkedcategories'      => array( 'Categorías_máis_ligadas' ),
	'Mostlinkedtemplates'       => array( 'Modelos_máis_ligados' ),
	'Mostrevisions'             => array( 'Páxinas_con_máis_revisións' ),
	'Movepage'                  => array( 'Mover_a_páxina' ),
	'Mycontributions'           => array( 'As_miñas_contribucións' ),
	'Mypage'                    => array( 'A_miña_páxina_de_usuario' ),
	'Mytalk'                    => array( 'A_miña_conversa' ),
	'Myuploads'                 => array( 'As_miñas_subidas' ),
	'Newimages'                 => array( 'Imaxes_novas' ),
	'Newpages'                  => array( 'Páxinas_novas' ),
	'PagesWithProp'             => array( 'Páxinas_con_propiedades' ),
	'PasswordReset'             => array( 'Restablecer_o_contrasinal' ),
	'PermanentLink'             => array( 'Ligazón_permanente' ),
	'Popularpages'              => array( 'Páxinas_populares' ),
	'Preferences'               => array( 'Preferencias' ),
	'Prefixindex'               => array( 'Índice_de_prefixos' ),
	'Protectedpages'            => array( 'Páxinas_protexidas' ),
	'Protectedtitles'           => array( 'Títulos_protexidos' ),
	'Randompage'                => array( 'Ao_chou', 'Páxina_aleatoria' ),
	'Randomredirect'            => array( 'Redirección_aleatoria' ),
	'Recentchanges'             => array( 'Cambios_recentes' ),
	'Recentchangeslinked'       => array( 'Cambios_relacionados' ),
	'Redirect'                  => array( 'Redirección' ),
	'ResetTokens'               => array( 'Restablecer_os_pases' ),
	'Revisiondelete'            => array( 'Revisións_borradas' ),
	'Search'                    => array( 'Procurar' ),
	'Shortpages'                => array( 'Páxinas_curtas' ),
	'Specialpages'              => array( 'Páxinas_especiais' ),
	'Statistics'                => array( 'Estatísticas' ),
	'Tags'                      => array( 'Etiquetas' ),
	'Unblock'                   => array( 'Desbloquear' ),
	'Uncategorizedcategories'   => array( 'Categorías_sen_categoría' ),
	'Uncategorizedimages'       => array( 'Imaxes_sen_categoría' ),
	'Uncategorizedpages'        => array( 'Páxinas_sen_categoría' ),
	'Uncategorizedtemplates'    => array( 'Modelos_sen_categoría' ),
	'Undelete'                  => array( 'Restaurar' ),
	'Unlockdb'                  => array( 'Abrir_a_base_de_datos' ),
	'Unusedcategories'          => array( 'Categorías_sen_uso' ),
	'Unusedimages'              => array( 'Imaxes_sen_uso' ),
	'Unusedtemplates'           => array( 'Modelos_non_usados' ),
	'Unwatchedpages'            => array( 'Páxinas_sen_vixiar' ),
	'Upload'                    => array( 'Cargar' ),
	'Userlogin'                 => array( 'Rexistro' ),
	'Userlogout'                => array( 'Saír_ao_anonimato' ),
	'Userrights'                => array( 'Dereitos_de_usuario' ),
	'Version'                   => array( 'Versión' ),
	'Wantedcategories'          => array( 'Categorías_requiridas' ),
	'Wantedfiles'               => array( 'Ficheiros_requiridos' ),
	'Wantedpages'               => array( 'Páxinas_requiridas', 'Ligazóns_rotas' ),
	'Wantedtemplates'           => array( 'Modelos_requiridos' ),
	'Watchlist'                 => array( 'Lista_de_vixilancia' ),
	'Whatlinkshere'             => array( 'Páxinas_que_ligan_con_esta' ),
	'Withoutinterwiki'          => array( 'Sen_interwiki' ),
);

$magicWords = array(
	'redirect'                  => array( '0', '#REDIRECCIÓN', '#REDIRECIONAMENTO', '#REDIRECT' ),
	'notoc'                     => array( '0', '__SENÍNDICE__', '__SEMTDC__', '__SEMSUMÁRIO__', '__NOTOC__' ),
	'nogallery'                 => array( '0', '__SENGALERÍA__', '__SEMGALERIA__', '__NOGALLERY__' ),
	'forcetoc'                  => array( '0', '__FORZAROÍNDICE__', '__FORCARTDC__', '__FORCARSUMARIO__', '__FORÇARTDC__', '__FORÇARSUMÁRIO__', '__FORCETOC__' ),
	'toc'                       => array( '0', '__ÍNDICE__', '__TDC__', '__SUMÁRIO__', '__SUMARIO__', '__TOC__' ),
	'noeditsection'             => array( '0', '__SECCIÓNSNONEDITABLES__', '__NÃOEDITARSEÇÃO__', '__SEMEDITARSEÇÃO__', '__NAOEDITARSECAO__', '__SEMEDITARSECAO__', '__NOEDITSECTION__' ),
	'currentmonth'              => array( '1', 'MESACTUAL', 'MESACTUAL2', 'MESATUAL', 'MESATUAL2', 'CURRENTMONTH', 'CURRENTMONTH2' ),
	'currentmonth1'             => array( '1', 'MESACTUAL1', 'MESATUAL1', 'CURRENTMONTH1' ),
	'currentmonthname'          => array( '1', 'NOMEDOMESACTUAL', 'NOMEDOMESATUAL', 'CURRENTMONTHNAME' ),
	'currentmonthabbrev'        => array( '1', 'ABREVIATURADOMESACTUAL', 'MESATUALABREV', 'MESATUALABREVIADO', 'ABREVIATURADOMESATUAL', 'CURRENTMONTHABBREV' ),
	'currentday'                => array( '1', 'DÍAACTUAL', 'DIAATUAL', 'CURRENTDAY' ),
	'currentday2'               => array( '1', 'DÍAACTUAL2', 'DIAATUAL2', 'CURRENTDAY2' ),
	'currentdayname'            => array( '1', 'NOMEDODÍAACTUAL', 'NOMEDODIAATUAL', 'CURRENTDAYNAME' ),
	'currentyear'               => array( '1', 'ANOACTUAL', 'ANOATUAL', 'CURRENTYEAR' ),
	'currenttime'               => array( '1', 'DATAEHORAACTUAIS', 'HORARIOATUAL', 'CURRENTTIME' ),
	'currenthour'               => array( '1', 'HORAACTUAL', 'HORAATUAL', 'CURRENTHOUR' ),
	'localmonth'                => array( '1', 'MESLOCAL', 'MESLOCAL2', 'LOCALMONTH', 'LOCALMONTH2' ),
	'localmonth1'               => array( '1', 'MESLOCAL1', 'LOCALMONTH1' ),
	'localmonthname'            => array( '1', 'NOMEDOMESLOCAL', 'LOCALMONTHNAME' ),
	'localmonthabbrev'          => array( '1', 'ABREVIATURADOMESLOCAL', 'MESLOCALABREV', 'MESLOCALABREVIADO', 'LOCALMONTHABBREV' ),
	'localday'                  => array( '1', 'DÍALOCAL', 'DIALOCAL', 'LOCALDAY' ),
	'localday2'                 => array( '1', 'DÍALOCAL2', 'DIALOCAL2', 'LOCALDAY2' ),
	'localdayname'              => array( '1', 'NOMEDODÍALOCAL', 'NOMEDODIALOCAL', 'LOCALDAYNAME' ),
	'localyear'                 => array( '1', 'ANOLOCAL', 'LOCALYEAR' ),
	'localtime'                 => array( '1', 'DATAEHORALOCAIS', 'HORARIOLOCAL', 'LOCALTIME' ),
	'localhour'                 => array( '1', 'HORALOCAL', 'LOCALHOUR' ),
	'numberofpages'             => array( '1', 'NÚMERODEPÁXINAS', 'NUMERODEPAGINAS', 'NÚMERODEPÁGINAS', 'NUMBEROFPAGES' ),
	'numberofarticles'          => array( '1', 'NÚMERODEARTIGOS', 'NUMERODEARTIGOS', 'NUMBEROFARTICLES' ),
	'numberoffiles'             => array( '1', 'NÚMERODEFICHEIROS', 'NUMERODEARQUIVOS', 'NÚMERODEARQUIVOS', 'NUMBEROFFILES' ),
	'numberofusers'             => array( '1', 'NÚMERODEUSUARIOS', 'NUMERODEUSUARIOS', 'NÚMERODEUSUÁRIOS', 'NUMBEROFUSERS' ),
	'numberofactiveusers'       => array( '1', 'NÚMERODEUSUARIOSACTIVOS', 'NUMERODEUSUARIOSATIVOS', 'NÚMERODEUSUÁRIOSATIVOS', 'NUMBEROFACTIVEUSERS' ),
	'numberofedits'             => array( '1', 'NÚMERODEEDICIÓNS', 'NUMERODEEDICOES', 'NÚMERODEEDIÇÕES', 'NUMBEROFEDITS' ),
	'numberofviews'             => array( '1', 'NÚMERODEVISITAS', 'NUMERODEEXIBICOES', 'NÚMERODEEXIBIÇÕES', 'NUMBEROFVIEWS' ),
	'pagename'                  => array( '1', 'NOMEDAPÁXINA', 'NOMEDAPAGINA', 'NOMEDAPÁGINA', 'PAGENAME' ),
	'namespace'                 => array( '1', 'ESPAZODENOMES', 'DOMINIO', 'DOMÍNIO', 'ESPACONOMINAL', 'ESPAÇONOMINAL', 'NAMESPACE' ),
	'namespacenumber'           => array( '1', 'NÚMERODOESPAZODENOMES', 'NAMESPACENUMBER' ),
	'talkspace'                 => array( '1', 'ESPAZODECONVERSA', 'PAGINADEDISCUSSAO', 'PÁGINADEDISCUSSÃO', 'TALKSPACE' ),
	'subjectspace'              => array( '1', 'ESPAZODECONTIDO', 'PAGINADECONTEUDO', 'PAGINADECONTEÚDO', 'SUBJECTSPACE', 'ARTICLESPACE' ),
	'fullpagename'              => array( '1', 'NOMECOMPLETODAPÁXINA', 'NOMECOMPLETODAPAGINA', 'NOMECOMPLETODAPÁGINA', 'FULLPAGENAME' ),
	'subpagename'               => array( '1', 'NOMEDASUBPÁXINA', 'NOMEDASUBPAGINA', 'NOMEDASUBPÁGINA', 'SUBPAGENAME' ),
	'rootpagename'              => array( '1', 'NOMEDAPÁXINARAÍZ', 'ROOTPAGENAME' ),
	'basepagename'              => array( '1', 'NOMEDAPÁXINABASE', 'NOMEDAPAGINABASE', 'NOMEDAPÁGINABASE', 'BASEPAGENAME' ),
	'talkpagename'              => array( '1', 'NOMEDAPÁXINADECONVERSA', 'NOMEDAPAGINADEDISCUSSAO', 'NOMEDAPÁGINADEDISCUSSÃO', 'TALKPAGENAME' ),
	'subjectpagename'           => array( '1', 'NOMEDAPÁXINADECONTIDO', 'NOMEDAPAGINADECONTEUDO', 'NOMEDAPÁGINADECONTEÚDO', 'SUBJECTPAGENAME', 'ARTICLEPAGENAME' ),
	'img_thumbnail'             => array( '1', 'miniatura', 'miniaturadaimaxe', 'miniaturadaimagem', 'thumbnail', 'thumb' ),
	'img_manualthumb'           => array( '1', 'miniatura=$1', 'miniaturadaimaxe=$1', 'miniaturadaimagem=$1', 'thumbnail=$1', 'thumb=$1' ),
	'img_right'                 => array( '1', 'dereita', 'direita', 'right' ),
	'img_left'                  => array( '1', 'esquerda', 'left' ),
	'img_none'                  => array( '1', 'ningún', 'nenhum', 'none' ),
	'img_center'                => array( '1', 'centro', 'center', 'centre' ),
	'img_framed'                => array( '1', 'conmarco', 'conbordo', 'marco', 'commoldura', 'comborda', 'framed', 'enframed', 'frame' ),
	'img_frameless'             => array( '1', 'senmarco', 'senbordo', 'semmoldura', 'semborda', 'frameless' ),
	'img_page'                  => array( '1', 'páxina=$1', 'páxina_$1', 'página=$1', 'página $1', 'page=$1', 'page $1' ),
	'img_upright'               => array( '1', 'arribaádereita', 'arribaádereita=$1', 'arribaádereita_$1', 'superiordireito', 'superiordireito=$1', 'superiordireito $1', 'upright', 'upright=$1', 'upright $1' ),
	'img_border'                => array( '1', 'bordo', 'borda', 'border' ),
	'img_baseline'              => array( '1', 'liñadebase', 'linhadebase', 'baseline' ),
	'img_top'                   => array( '1', 'arriba', 'acima', 'top' ),
	'img_text_top'              => array( '1', 'texto-arriba', 'text-top' ),
	'img_middle'                => array( '1', 'medio', 'meio', 'middle' ),
	'img_bottom'                => array( '1', 'abaixo', 'bottom' ),
	'img_text_bottom'           => array( '1', 'texto-abaixo', 'text-bottom' ),
	'img_link'                  => array( '1', 'ligazón=$1', 'ligação=$1', 'link=$1' ),
	'img_class'                 => array( '1', 'clase=$1', 'class=$1' ),
	'sitename'                  => array( '1', 'NOMEDOSITIO', 'NOMEDOSITE', 'NOMEDOSÍTIO', 'SITENAME' ),
	'localurl'                  => array( '0', 'URLLOCAL:', 'LOCALURL:' ),
	'articlepath'               => array( '0', 'RUTADOARTIGO', 'ARTICLEPATH' ),
	'pageid'                    => array( '0', 'IDDAPÁXINA', 'PAGEID' ),
	'server'                    => array( '0', 'SERVIDOR', 'SERVER' ),
	'servername'                => array( '0', 'NOMEDOSERVIDOR', 'SERVERNAME' ),
	'scriptpath'                => array( '0', 'RUTADAESCRITURA', 'CAMINHODOSCRIPT', 'SCRIPTPATH' ),
	'stylepath'                 => array( '0', 'RUTADOESTILO', 'STYLEPATH' ),
	'grammar'                   => array( '0', 'GRAMÁTICA:', 'GRAMMAR:' ),
	'gender'                    => array( '0', 'SEXO:', 'GENERO', 'GÊNERO', 'GENDER:' ),
	'currentweek'               => array( '1', 'SEMANAACTUAL', 'SEMANAATUAL', 'CURRENTWEEK' ),
	'localweek'                 => array( '1', 'SEMANALOCAL', 'LOCALWEEK' ),
	'revisionid'                => array( '1', 'IDDAREVISIÓN', 'IDDAREVISAO', 'IDDAREVISÃO', 'REVISIONID' ),
	'revisionday'               => array( '1', 'DÍADAREVISIÓN', 'DIADAREVISAO', 'DIADAREVISÃO', 'REVISIONDAY' ),
	'revisionday2'              => array( '1', 'DÍADAREVISIÓN2', 'DIADAREVISAO2', 'DIADAREVISÃO2', 'REVISIONDAY2' ),
	'revisionmonth'             => array( '1', 'MESDAREVISIÓN', 'MESDAREVISAO', 'MÊSDAREVISÃO', 'REVISIONMONTH' ),
	'revisionmonth1'            => array( '1', 'MESDAREVISIÓN1', 'REVISIONMONTH1' ),
	'revisionyear'              => array( '1', 'ANODAREVISIÓN', 'ANODAREVISAO', 'ANODAREVISÃO', 'REVISIONYEAR' ),
	'revisiontimestamp'         => array( '1', 'DATAEHORADAREVISIÓN', 'REVISIONTIMESTAMP' ),
	'revisionuser'              => array( '1', 'USUARIODAREVISIÓN', 'USUARIODAREVISAO', 'USUÁRIODAREVISÃO', 'REVISIONUSER' ),
	'fullurl'                   => array( '0', 'URLCOMPLETO:', 'FULLURL:' ),
	'canonicalurl'              => array( '0', 'URLCANÓNICO:', 'CANONICALURL:' ),
	'lcfirst'                   => array( '0', 'PRIMEIRAMINÚSCULA:', 'PRIMEIRAMINUSCULA:', 'LCFIRST:' ),
	'ucfirst'                   => array( '0', 'PRIMEIRAMAIÚSCULA:', 'PRIMEIRAMAIUSCULA:', 'UCFIRST:' ),
	'lc'                        => array( '0', 'MINÚSCULA:', 'MINUSCULA', 'MINÚSCULA', 'MINUSCULAS', 'MINÚSCULAS', 'LC:' ),
	'uc'                        => array( '0', 'MAIÚSCULA:', 'MAIUSCULA', 'MAIÚSCULA', 'MAIUSCULAS', 'MAIÚSCULAS', 'UC:' ),
	'raw'                       => array( '0', 'ENBRUTO:', 'RAW:' ),
	'displaytitle'              => array( '1', 'AMOSAROTÍTULO', 'MOSTRAROTÍTULO', 'EXIBETITULO', 'EXIBETÍTULO', 'DISPLAYTITLE' ),
	'newsectionlink'            => array( '1', '__LIGAZÓNDANOVASECCIÓN__', '__LINKDENOVASECAO__', '__LINKDENOVASEÇÃO__', '__LIGACAODENOVASECAO__', '__LIGAÇÃODENOVASEÇÃO__', '__NEWSECTIONLINK__' ),
	'currentversion'            => array( '1', 'VERSIÓNACTUAL', 'REVISAOATUAL', 'REVISÃOATUAL', 'CURRENTVERSION' ),
	'language'                  => array( '0', '#LINGUA:', '#IDIOMA:', '#LANGUAGE:' ),
	'contentlanguage'           => array( '1', 'LINGUADOCONTIDO', 'IDIOMADOCONTIDO', 'IDIOMADOCONTEUDO', 'IDIOMADOCONTEÚDO', 'CONTENTLANGUAGE', 'CONTENTLANG' ),
	'pagesinnamespace'          => array( '1', 'PÁXINASNOESPAZODENOMES:', 'PAGINASNOESPACONOMINAL', 'PÁGINASNOESPAÇONOMINAL', 'PAGINASNODOMINIO', 'PÁGINASNODOMÍNIO', 'PAGESINNAMESPACE:', 'PAGESINNS:' ),
	'numberofadmins'            => array( '1', 'NÚMERODEADMINISTRADORES', 'NUMERODEADMINISTRADORES', 'NUMBEROFADMINS' ),
	'special'                   => array( '0', 'especial', 'special' ),
	'defaultsort'               => array( '1', 'ORDENAR:', 'ORDENACAOPADRAO', 'ORDENAÇÃOPADRÃO', 'ORDEMPADRAO', 'ORDEMPADRÃO', 'DEFAULTSORT:', 'DEFAULTSORTKEY:', 'DEFAULTCATEGORYSORT:' ),
	'tag'                       => array( '0', 'etiqueta', 'tag' ),
	'hiddencat'                 => array( '1', '__CATEGORÍAOCULTA__', '__CATEGORIAOCULTA__', '__CATOCULTA__', '__HIDDENCAT__' ),
	'pagesincategory'           => array( '1', 'PÁXINASNACATEGORÍA', 'PAGINASNACATEGORIA', 'PÁGINASNACATEGORIA', 'PAGINASNACAT', 'PÁGINASNACAT', 'PAGESINCATEGORY', 'PAGESINCAT' ),
	'pagesize'                  => array( '1', 'TAMAÑODAPÁXINA', 'TAMANHODAPAGINA', 'TAMANHODAPÁGINA', 'PAGESIZE' ),
	'url_path'                  => array( '0', 'RUTA', 'PATH' ),
	'url_query'                 => array( '0', 'PESCUDA', 'QUERY' ),
	'pagesincategory_all'       => array( '0', 'todos', 'all' ),
	'pagesincategory_pages'     => array( '0', 'páxinas', 'pages' ),
	'pagesincategory_subcats'   => array( '0', 'subcategorías', 'subcats' ),
	'pagesincategory_files'     => array( '0', 'ficheiros', 'files' ),
);

$separatorTransformTable = array( ',' => '.', '.' => ',' );

