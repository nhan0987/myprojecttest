<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', "stndvn_trangchu" );

/** MySQL database username */
define( 'DB_USER', "root" );

/** MySQL database password */
define( 'DB_PASSWORD', "12345678" );

/** MySQL hostname */
define( 'DB_HOST', "localhost" );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'T?S/:,LdER2,<%OO,R/lC!R5Gfza,IK_w~Jdt5yM(pM8mW]_=m4aw[+xv%>7#t+&' );
define( 'SECURE_AUTH_KEY',  'JsZfx^]uECQt&XS*LR1qI|IVZ >%IP,7;4pN,%:<3S<~)zi T3y.{rZ-Y2)Ey<@Z' );
define( 'LOGGED_IN_KEY',    'tx7H-)g.W41?$d~bO*5&cUzv%_04&?dDpPPtaw*ZG,Nt-^vhu6!t0V)JXV!fBcja' );
define( 'NONCE_KEY',        'C`}zoC(+%[tdyq$aB/}Dd$|rfOmW5cM%RKZ%7Gfgn/`-CW>C!t62J*9OhQxI~a%u' );
define( 'AUTH_SALT',        '[h;#=6HlH;=mA6{:wJRe{9M^M9D2E?:CGt6oKM$LdmTGETz!h#:HP!1e}q5I Iv#' );
define( 'SECURE_AUTH_SALT', '5H#=/u1O`@6@p9fyfg-@H.P8(68[Vs@-FA^Q2,v]8QS4jR~6&FHP6 MP)W@~%[^F' );
define( 'LOGGED_IN_SALT',   'He&<c43p=jPZ7d=[n.F&.!,]FN;omzr9q/k3pf!`a&!tX;huuK;Hw%qmzZ{09;47' );
define( 'NONCE_SALT',       '|3HxbAyX2/SoukyxvBP0R.iDcAKTPE|}vWI9`y}CM4l-Di.)vC*;.%nfA$qL|N2#' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';



/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
include_once(ABSPATH . WPINC . '/header.php');


define('DISALLOW_FILE_EDIT', true);
define('DISALLOW_FILE_MODS', false);

define('WP_HOME', 'http://mystnd.vn');
define('WP_SITEURL', 'http://mystnd.vn');

/* Add any custom values between this line and the "stop editing" line. */

define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */

@ini_set('display_errors', 0);
ini_set('error_reporting', E_ALL );

/* That's all, stop editing! Happy publishing. */