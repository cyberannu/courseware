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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'courseware' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'jf|H/(9S|AASEAmVR}lvJ2V(#Of[IW|W0tu.?bNa_h+]?R:=&Id#|0Gr,qTzQrUU' );
define( 'SECURE_AUTH_KEY',  'Pi$G%h4]i%Xyzckt}^3Y6v?p<6+yX ZPf)[Zs7sb?T$(&rNQD;bdpN/+p3Sp2*3/' );
define( 'LOGGED_IN_KEY',    '7M)w(Y@r?%)tX~z?ETT1u`L1hHIP|#.ds3 4PoNGRwcK=`h^KU?Ri! bNo]GO%!0' );
define( 'NONCE_KEY',        'pnz b(<% f|J)iSHz;}a`f5]I~h8wAw/nM=0$ml$fd_Ia+M:?FoG^y~|wLWDwKc2' );
define( 'AUTH_SALT',        'b[._cv0%&n59OihPcy*z:IvkUa0<rk_U]MbZGt]z@oL,!yVF&yv#*zc^!eWo[M>!' );
define( 'SECURE_AUTH_SALT', '1<TGOc!}8blB0{h$8{piYs)@k!uqHRRW*]YA?SPAw)r>0qA,u@AA=5=)W;+JBPdv' );
define( 'LOGGED_IN_SALT',   '`?)Tx6Z3[>C*/ovk6lqLK5#/CCoo2y(@Nq6@!}d./57;-WIq8q3&|>}~@LytE!`=' );
define( 'NONCE_SALT',       ':2GCEy02`H},9Soy?KpUJNa~[F*WVBPl_S+knY9K)U]o5laFL2Chb>V) S{>>:@A' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
