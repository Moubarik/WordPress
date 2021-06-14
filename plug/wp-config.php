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
define( 'DB_NAME', 'plug' );

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
define( 'AUTH_KEY',         'jTn~L4210$:G_51 +K+ePh]DWaX%/{MT9 iRg)!QEz_^Kq8Bshy0Ame.d$50GF$v' );
define( 'SECURE_AUTH_KEY',  'Vex: n8r!rSXIH-_2Ev`Tw#?kqwSsuHlLDIW4#p?S~c5h3j:l-7~6a1pVW(R@`z/' );
define( 'LOGGED_IN_KEY',    '%S,Q2}BgCtFhHN K_K}3r8`8L,Th;2V%9d48{.F>)tVld2h8Nkm:1`]?eRO%N#bp' );
define( 'NONCE_KEY',        'l:Ptos7T,hR;8z^7:_]m3}omU5fwKI$Wqg#XB*E+p/zgT}gF$VZQn:WSHFg%R@^)' );
define( 'AUTH_SALT',        'o<Wp[p|EmoT[KfaNezmHn!:#YJU3,8u*r94=oVVXK W0=x]o)::D;JIo^Qa;]?}g' );
define( 'SECURE_AUTH_SALT', 'hDoZy~eW$M*~hZINPgZ: Ag;U>e0-(6nB!$e6[Kf!=nAWFDQFh$${xL?f 2*F<3t' );
define( 'LOGGED_IN_SALT',   'Ezl@WpB9-,10*,IACaDS1APB&yP7 o6G/]BG`%j#7Xl/;bnj{4:[uX&[3:.k}H~G' );
define( 'NONCE_SALT',       '0#.DjTFEFlJ77R}7[dIwJ//6L4T~k2kNS@tLYZ_oTfl2x{r~/nBC83_gb.on&?/0' );

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
