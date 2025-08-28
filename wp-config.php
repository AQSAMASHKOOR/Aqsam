<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'Aqsam' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',         's:)hGmkp cZ2BL$[K}Z#jXjVZJ?*!dEP)Apfj .Votf-$RfqmxSfGZdp#^*KhY=[' );
define( 'SECURE_AUTH_KEY',  '6s(>%6-lk3:8azzQQ;< ?&G@zs,}(7fNlj#<U9_%Td*3A$t5elQcWH7%17O4Qwze' );
define( 'LOGGED_IN_KEY',    'bS}WInqOpPSyv0:=qRZ[P(DKKx2@]RFFzOQ@YWF5GC_H+MF/BO~lNxV;Ocg$;DK|' );
define( 'NONCE_KEY',        'zG2+)ERA?=zhCqt{Y9%(+yxHopfQm{s,pr=.n_s(%=l{ j!{q)o aK&!%<GM%7oB' );
define( 'AUTH_SALT',        'V8`}Oz]F`sPk2c(VSh1R1:yxIWr@#gy3R!`R@7(_w`uK0P 0jztcFRe]4hl^hl*%' );
define( 'SECURE_AUTH_SALT', 'rvlJ~OFb?3SQ;lyIM_N0,w5HystDR5Q-ycFPD[Plx5vSz.1(_$#X%`V|}7qBWGXA' );
define( 'LOGGED_IN_SALT',   '3dmJ,w6{ZA5atjN:A^D!$U3z/;={Y.q!5?=+ut%S0I%a>f ;}Ei%@H.Ubp,8FMi4' );
define( 'NONCE_SALT',       '=>K,A-p%!~G*Sx??bu_q?E,|v729h9M).e;_HzUT4_E]}A*FBDU}#q4!4O}?~M{h' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'wp_';

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
