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
define( 'DB_NAME', 'burekmotorshop' );

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
define( 'AUTH_KEY',         'zin #%2/ ^T@|T.cfFUwD) kYkG%$$M>_RBdy#r9n TV~|[sUEZHyHE9o!xTm,ts' );
define( 'SECURE_AUTH_KEY',  '9*w}6mSN2hV@qI^/v6{u%v8~Z>A0vYa<{Ci,TVruTsX*w=W[9Q3H|P`9B )}2bKd' );
define( 'LOGGED_IN_KEY',    '-F}d<cm<>;dH J!^`e_B.?8C%2%g7Zf2Ew.<J1{EP)rB^Rsr_GXMrh}^yH~C=H#h' );
define( 'NONCE_KEY',        '/L}@x>+2r(,$)B>jn}GEFI<.|x}t:)p&SLj}-Px^7$zn~V%%k }([&;&cZ=]T=eT' );
define( 'AUTH_SALT',        'p^yhRRgwH&OeX:A3~p9lu@<Q,g1R/W!hz5Iv`Us;c j8Q#z]vQufa|:G?ZDg3djN' );
define( 'SECURE_AUTH_SALT', '*2CW;p~Z~e)@T:|$,,d)bm|BG!6/n5qdFz+/Ak~pL4V8{P=x9$@D-HrhnZ6$H:s9' );
define( 'LOGGED_IN_SALT',   '_k l4k^YAQ#9I?LQIQZxY:Xwrx#]K*Bw2&@b&Ey2.Apn[X cOJ0h%9|7pI@^9gMf' );
define( 'NONCE_SALT',       'g7;;q;K.6@!LtXJUiA>7H1ozRs4r{?K^4ys;Sl#e:!GLV&{lplIg<!>brd3d,V4y' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'lab_';

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
