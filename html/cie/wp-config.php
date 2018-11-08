<?php

// BEGIN iThemes Security - Do not modify or remove this line
// iThemes Security Config Details: 2
define( 'DISALLOW_FILE_EDIT', true ); // Disable File Editor - Security > Settings > WordPress Tweaks > File Editor
// END iThemes Security - Do not modify or remove this line

/**
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
define('DB_NAME', 'ocobwordpress-cie2');

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
define('AUTH_KEY',         '~%9yyaWcN]V?W8d55)NU_9i+Q4|iYl/00M~AUVZ4obf{+8MtIRI40 %2<2=!e@Q#');
define('SECURE_AUTH_KEY',  '9/uH5gu*Ka]rIP$5kv(E06.`p,U0k/2%(w_(*<)@#!D1R/ZtTAu6MWe5DEmA[3#Q');
define('LOGGED_IN_KEY',    '{<n`WHij0^0M,MOWwO)WwH`$2MYI~:%psD-M)v~r[Qs8t(hTMdKj@Zye=Hg)h`R5');
define('NONCE_KEY',        '?`_rx,5wkRWVMEHts(%t(]-YvLvC@(+V%^q08^&})(QA9fmZ)N_c}<@Y7TpW7lt{');
define('AUTH_SALT',        '[S>F]U LEB1QYY4mBtDdZyRAUe6;guGE,Zb_DZUXD|eT%7Y)`G*:AqnXa%#MJa2+');
define('SECURE_AUTH_SALT', '{zJ3^c@8Jq%]_K]hhWM-OXv_3p?`:i|7IlXaR/Gx}Ac+Ks]x,I<91U?y6fMxfh|*');
define('LOGGED_IN_SALT',   '-h*1w$&^Dx/mxO,3d-ppPdX55M`*O_XkEg(*M0%g@g}t}tVdiI*$iBfM!Ac#P l2');
define('NONCE_SALT',       'Ps%7mW]:!:G:xvp?QJ;5!WTwj-FsL$kVv#[Cb0Ae2}kW%1G7xWE|vAx!vmbYZF {');

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

define('FS_METHOD', 'direct');

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
