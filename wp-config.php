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
define( 'DB_NAME', 'wp_projekt_grupp1' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

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
define( 'AUTH_KEY',         'y81<gd~*aT0W=;tF9}U1x@~kjJ6zQ)v3qv]|9Gm_+LuBw[=DJ?G;FBKY1>w~%nnK' );
define( 'SECURE_AUTH_KEY',  'l^=!?ej.XJl:py^xuhXj6QOu}`&Ht2HDD/#uiGh#YJke<cJ.Ut#F]T,tCzKSyc+Z' );
define( 'LOGGED_IN_KEY',    'Q9I`sQtAPK!ha$@Cfj:%&4%+2L]ptS{WH^+QR=u_(:oMEV4L/SnYCs0,,*y^(tpp' );
define( 'NONCE_KEY',        '_jvkeN$^|V1g 3|[RnA%<;Fu?X@c=*mf=fp>%.hmDShprA3u_%EpfYSLf@a f2AU' );
define( 'AUTH_SALT',        ')W]r];5V:K@7%0UM]yLVriL8%IRb/m+cDSXU0)o5O>DH<7qD -[#,l=Ny%r5tiuu' );
define( 'SECURE_AUTH_SALT', '^*;],p*sb8_u-y^!b#*8,f%fxCx*[}u?S*[s*.@6gKHQ 4.&hftX4KG9^]Buk2ij' );
define( 'LOGGED_IN_SALT',   'Z.9ASq=lwgWV_!qlxh6/t>6@Ct{y:@D:t[0KmkhBIFME{9LiO}=lZ[5^:{k.TsPJ' );
define( 'NONCE_SALT',       'bICn8cV7K5mKw+FFML]b}hDSJr2?*DM3b[AczHViRqLK>(Dg8&MZ~+?$`!oa5rej' );

/**#@-*/
//
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
define( 'WP_DEBUG', true );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
