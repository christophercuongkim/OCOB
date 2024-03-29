<?php
/** Nāhuatl (Nāhuatl)
 *
 * See MessagesQqq.php for message documentation incl. usage of parameters
 * To improve a translation please visit http://translatewiki.net
 *
 * @ingroup Language
 * @file
 *
 * @author Fluence
 * @author Kaganer
 * @author Reedy
 * @author Ricardo gs
 * @author Rob Church <robchur@gmail.com>
 * @author Shirayuki
 * @author Teòtlalili
 */

$fallback = 'es';

$namespaceNames = array(
	NS_MEDIA            => 'Mēdiatl',
	NS_SPECIAL          => 'Nōncuahquīzqui',
	NS_TALK             => 'Tēixnāmiquiliztli',
	NS_USER             => 'Tlatequitiltilīlli',
	NS_USER_TALK        => 'Tlatequitiltilīlli_tēixnāmiquiliztli',
	NS_PROJECT_TALK     => '$1_tēixnāmiquiliztli',
	NS_FILE             => 'Īxiptli',
	NS_FILE_TALK        => 'Īxiptli_tēixnāmiquiliztli',
	NS_MEDIAWIKI        => 'Huiquimedia',
	NS_MEDIAWIKI_TALK   => 'Huiquimedia_tēixnāmiquiliztli',
	NS_TEMPLATE         => 'Nemachiyōtīlli',
	NS_TEMPLATE_TALK    => 'Nemachiyōtīlli_tēixnāmiquiliztli',
	NS_HELP             => 'Tēpalēhuiliztli',
	NS_HELP_TALK        => 'Tēpalēhuiliztli_tēixnāmiquiliztli',
	NS_CATEGORY         => 'Neneuhcāyōtl',
	NS_CATEGORY_TALK    => 'Neneuhcāyōtl_tēixnāmiquiliztli',
);

// Remove Spanish gender aliases (bug 37090)
$namespaceGenderAliases = array();

$namespaceAliases = array(
	'Media'		=> NS_MEDIA,
	'Especial'	=> NS_SPECIAL,
	'Discusión'	=> NS_TALK,
	'Usuario'	=> NS_USER,
	'Usuario_Discusión'	=> NS_USER_TALK,
	'Wikipedia'	=> NS_PROJECT,
	'Wikipedia_Discusión'	=> NS_PROJECT_TALK,
	'Imagen'	=> NS_FILE,
	'Imagen_Discusión'	=> NS_FILE_TALK,
	'MediaWiki'	=> NS_MEDIAWIKI,
	'MediaWiki_Discusión'	=> NS_MEDIAWIKI_TALK,
	'Plantilla'	=> NS_TEMPLATE,
	'Plantilla_Discusión'	=> NS_TEMPLATE_TALK,
	'Ayuda'		=> NS_HELP,
	'Ayuda_Discusión'	=> NS_HELP_TALK,
	'Categoría'	=> NS_CATEGORY,
	'Categoría_Discusión'	=> NS_CATEGORY_TALK,
);

$specialPageAliases = array(
	'Allpages'                  => array( 'MochīntīnZāzaniltin', 'TodasPáginas' ),
	'Ancientpages'              => array( 'HuēhuehZāzaniltin', 'PáginasViejas' ),
	'Categories'                => array( 'Neneuhcāyōtl', 'Categorías' ),
	'Emailuser'                 => array( 'EmailTlācatl', 'CorreoUsuario' ),
	'Longpages'                 => array( 'HuēiyacZāzaniltin', 'PáginasLargas' ),
	'Mycontributions'           => array( 'Notlahcuilōl', 'MisContribuciones' ),
	'Mypage'                    => array( 'Nozāzanil', 'MiPágina' ),
	'Mytalk'                    => array( 'Notēixnāmiquiliz', 'MiDiscusión' ),
	'Newpages'                  => array( 'YancuīcZāzaniltin', 'PáginasNuevas' ),
	'Search'                    => array( 'Tlatēmōz', 'Buscar' ),
	'Shortpages'                => array( 'Zāzaniltōn', 'PáginasCortas' ),
	'Specialpages'              => array( 'NōncuahquīzquiĀmatl', 'PáginasEspeciales' ),
	'Upload'                    => array( 'Quetza', 'Subir' ),
	'Userlogin'                 => array( 'Tlacalaquiliztli', 'Registrarse' ),
);

