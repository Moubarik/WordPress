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
define( 'DB_NAME', 'efashion' );

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
define( 'AUTH_KEY',         '8:v 97~c:x|.,:9}~imK9[&lYD~k3ueSjKrb{L# cf2Edk&O#VM4D@y/:@qXAEJ ' );
define( 'SECURE_AUTH_KEY',  'nAV-!Ia`}PzM;P^{^emop|AQK6=*=?oK:b03j{SAz08)F4Y]*<e(*7M|=#,O;DO=' );
define( 'LOGGED_IN_KEY',    'IJ G]6P#{.C9GAvC0#)e&yy]pB0?VMtAUK=6)4X9m,K7M|8=F.n H%M1KMHSFl2!' );
define( 'NONCE_KEY',        '~!fCRPCQ)+-fS|;IU+0l@#xShf;w8B26>Rx})kI9x;92AAM]A;oYfsJt76Vj{B+~' );
define( 'AUTH_SALT',        '25~C^Odc%=Zf_D-e!Z_cG^{#?=V ]a8f8o1~EN};zZRjjsMfSAKhf_2Jgz;$E7%2' );
define( 'SECURE_AUTH_SALT', '/V63z-O!?bJKW-ABA3%Bx.N`+(0kf3:)bCUVlMr+kKL,>=~19*(CH~w3%0&dr]1P' );
define( 'LOGGED_IN_SALT',   'esaU<wpl,T$8TZ xY+5l!$mmQk#dtwh~`(n/{_{2>H2WG<st&A PY`tG]g3!+<CL' );
define( 'NONCE_SALT',       'U/gnX,z+Z<[v:NM@msf{M[~O/|i-c-@[Kh1}U ATliTzue8>P^<2P| kFo[G]yIk' );

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
