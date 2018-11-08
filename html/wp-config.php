<?php

// BEGIN iThemes Security - Do not modify or remove this line
// iThemes Security Config Details: 2
define( 'DISALLOW_FILE_EDIT', true ); // Disable File Editor - Security > Settings > WordPress Tweaks > File Editor
// END iThemes Security - Do not modify or remove this line

/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'ocobwordpress-main');

/** MySQL database username */
define('DB_USER', 'fgonza02');

/** MySQL database password */
define('DB_PASSWORD', '8gAvc2hzgwMW1kN7');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '  %>;Xl<09 u_XdU=T}MUT8{B!;Xx@rTV^Y+7iH/B~S?9XhuNV1#:[U&l iI8@o}');
define('SECURE_AUTH_KEY',  'U%K/nnv)J~f@7IJWdOONew.j[y23(WF1=3F{dD3X8CQv$*;tgeq>BmKH^`*jiT(X');
define('LOGGED_IN_KEY',    'x]gzMvHBa=I m[7*jGAr,vp/Nn.eyx1M>E5~I}EACoEd;/:(Rg}Wl1.rv(r)%U-c');
define('NONCE_KEY',        'T5K;Ho|xx%~wmxTT6zo0NFf]z /{?/[i>jHL)siE}?^A1&W~dOabM,mIS}Phd(.6');
define('AUTH_SALT',        '%aCajy@fKm;s_a4CmcwE1Lbl[w4COQoF@6tc6N=VD3(i.`nB,[`]kSs[r%LC9t:V');
define('SECURE_AUTH_SALT', '>e`UDF2octK)?06]==VsxU.3xj& (Bv`,7MO`;KvDZr/Qf_ic1Fmom80k-LrirSC');
define('LOGGED_IN_SALT',   'yy5/^Hb*ijzR@6LS+>`yEO+$d[<I~G<lv%T;USW{c vlX:rbuk0tv3w>|`U~bBov');
define('NONCE_SALT',       'c*gw{@asW4)QkR%%JE17IvCXZ`XIpbWbm-Z> {iJjFh(t$]|Wyj IyBGOpTu.|o ');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

define('MULTISITE', true);
define('SUBDOMAIN_INSTALL', false);
define('DOMAIN_CURRENT_SITE', 'www.cob.calpoly.edu');
define('PATH_CURRENT_SITE', '/');
define('SITE_ID_CURRENT_SITE', 1);
define('BLOG_ID_CURRENT_SITE', 1);

define('FS_METHOD', 'direct');
define( 'FTP_BASE', '/var/www/www.cob.calpoly.edu/html' );
define( 'FTP_CONTENT_DIR', '/var/www/www.cob.calpoly.edu/html/wp-content/' );
define( 'FTP_PLUGIN_DIR ', '/var/www/www.cob.calpoly.edu/html/wp-content/plugins/' );
define( 'FTP_HOST', 'https://newscully.cob.calpoly.edu:22' );
define( 'FTP_USER', 'ocob-online@calpoly.edu' );

/* That's all, stop editing! Happy blogging. */
/* Multisite */
define( 'WP_ALLOW_MULTISITE', true );

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');