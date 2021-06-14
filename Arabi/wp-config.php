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
define( 'DB_NAME', 'arabic' );

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
define( 'AUTH_KEY',         '?(*z%FKI+Y@{|e<7_^S2#5lqe2C{{>5Iun53KfK:T{7xEo4ub0>SFe*PJteTP-[}' );
define( 'SECURE_AUTH_KEY',  '{R;5k{A0<9<m)sS^Vd!}rr_yD=krpQ(*VbzvfsE)_Qx2nLkJH4sp>cBvz;/|}4Q_' );
define( 'LOGGED_IN_KEY',    'RT_F&!DmRck@=y,I&;La5O5)u2/D|]`u`i}%@!ro-%{5{boMZ4I9EH`F(6jiLBqG' );
define( 'NONCE_KEY',        'P(8YU!NZz_IR |3WA61Fg|T#60XO,$oy2fE>G)6tPK+7$L?g-Hen*.iA;4bO$FeG' );
define( 'AUTH_SALT',        '47q0=DOK/9Y1FuQ$~cx jwO>p{d?y]mlXzUbX]G<f]e}A7Cx^rk+!.3]W>,>u~ZZ' );
define( 'SECURE_AUTH_SALT', '1)JX%&h]=o/OvO1hm8&Bpy8qag/~FfyB!<pl<~R%KPL{sNM!9)5)dS%ZyKtCT&^|' );
define( 'LOGGED_IN_SALT',   'Bs_.nL#j#:&;ziMn?:NVcz,&LH$d;Cy|)R%2 dA ^/VdNhs|5viG/enZ_HM:OJ9Z' );
define( 'NONCE_SALT',       'T#,fox(^ze!Ym~UM_:18i);+MT2,g~)Ws-6^Jnei5i5l*YO3<BV|L@^;!YYbaK(m' );

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
