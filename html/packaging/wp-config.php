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
define('DB_NAME', 'ocobwordpress-packaging');

/** MySQL database username */
define('DB_USER', 'ocobweb-pack');

/** MySQL database password */
define('DB_PASSWORD', 'WJIQw2sgypcuQDZL');

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
define('AUTH_KEY',         'xC;DG4z(4<s|ne.0F-SurRV^hQPI|){4xMj*Kb}l}PdUb-cSmd_m+z8]t<}j55h#');
define('SECURE_AUTH_KEY',  '4.^=fd!cA oc=OiBQI-^H.ns[bD4{x/:5|D)l&?v9`e]4a0mBeI7a;2I<jG7~;>x');
define('LOGGED_IN_KEY',    'rh,)~*DlJh20+1y_x~>;z/R63 +#S.^~Qd^1akrK0nu*G2SvNbIkA}nd}rErV>n]');
define('NONCE_KEY',        '<C$ib:6HIe.Y`F*p?:r8aqr/Ku(+W;F?CT0wJ{vSWIu)%/D@D;bvf>/D3%/ELsYB');
define('AUTH_SALT',        'q`G^X2(k7XVH,y/]UXGS(NI[kk Q_h+a9{o#oo8e!c}iqQ$%BX4P/(J^*KKd4DF%');
define('SECURE_AUTH_SALT', 'rP{1y4^tHoxgphB:NxSML%Odg`m`Z8s(Z]zF;H^bq;9dISQ9B9~<!`+]UTR^:OKU');
define('LOGGED_IN_SALT',   'UwJ<kR69c65m<(R}@,7Im/.+$zPen2A>J;tLW^)rKf|)u4%foe#^H<KbiR/#JW4P');
define('NONCE_SALT',       'iTMFP%p&NqV/g@8cWWPPK-OWWBuJB#NzXuR>zT-3G<jo3Ww<x_[dR:]^+5-$]sbQ');

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

/* Multisite */
define( 'WP_ALLOW_MULTISITE', true);

define('MULTISITE', true);
define('SUBDOMAIN_INSTALL', false);
define('DOMAIN_CURRENT_SITE', 'packaging.calpoly.edu');
define('PATH_CURRENT_SITE', '/');
define('SITE_ID_CURRENT_SITE', 1);
define('BLOG_ID_CURRENT_SITE', 1);

define('FS_METHOD', 'direct');

define('SUNRISE', 'on');

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
