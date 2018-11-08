<?php
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
define('DB_NAME', 'ocobwordpress-gradbusiness');

/** MySQL database username */
define('DB_USER', 'ocobweb-grad');

/** MySQL database password */
define('DB_PASSWORD', 'GeHLMJSudgPeYVIW');

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
define('AUTH_KEY',         'O)EnETzag>uue?z;~8bIl3H7v-l`o7F1i8j{wHe+@(^I;ks0oZe?-3dP_LVS6zJs');
define('SECURE_AUTH_KEY',  'QO=C2}G]Bk-+>ot0@]tF/0_}U>1!o^o.WTWqL,)vFD3_,T=]HAMqbgG{<.5|rQ`e');
define('LOGGED_IN_KEY',    '&@B~0q){)Dz+Ki#SaA>5x3@}].>Qic.C<JrT_%I;A<J%%62@:l-7_[_.)/SJI gU');
define('NONCE_KEY',        '_SwHTXRFlnO)7yq-45dEGJt{)CLo,V}n8jFPJfi)d#:! ]]W4{I/*B7k [I-MIyU');
define('AUTH_SALT',        'AcIl>nM7cbzl:!xsG]4n_<7chcs)B]nUb..H35g)8^m0y7o]3Kd}pX=<iQV|Xm;3');
define('SECURE_AUTH_SALT', 'S8CWb4uVwUuU>^wfzJr4nctOn@+89u=h#z08=MS5&$x,Sg54vK!:/og]n$B6D6_X');
define('LOGGED_IN_SALT',   '].M~SQvYEL==+JHeZ%_zs_&`;dycf,<TMqEp4i@R_ThoQ&<geAL>=Wln_LLgs>a&');
define('NONCE_SALT',       '/(<rJi1$fbHKZZ8GI~+dxoRd}y|E0WB e5>c;w=)9q7Tz nOqtXzk.p,PRXuA>qU');

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

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
