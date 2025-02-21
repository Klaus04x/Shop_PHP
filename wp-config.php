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
define( 'DB_NAME', 'thanh' );

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
define( 'AUTH_KEY',         '%1+EWz0{-%v)lT! JUMGME$cH5OBa=[/=3uwY|JQX`w4y[8DM%[:KKip4]Dsu>~S' );
define( 'SECURE_AUTH_KEY',  '2>rYY~H&|@jGY;hoh^/UX_0OdzFQERypxzm%:oytlPeL14=3(%L>y.,2ew?z8e$W' );
define( 'LOGGED_IN_KEY',    '=!K5?0VMQ(ryy%kq|,3^DezA1ggvJ21#|j%C0g)<g!uRg-d?{32(,XFUFA&YjTtD' );
define( 'NONCE_KEY',        'ur~2GA-!]L2fb`tt=X8VW[tl$V}*~00pLvChf6C,s8/4l9r{1*bs+`kd3F5>p})(' );
define( 'AUTH_SALT',        'kRR-60PMXHt^JIz|jE:!.<F8Iv%#4lIO+m*MTKq!>6WXs6>^i>^qMP*@pVmlzUc&' );
define( 'SECURE_AUTH_SALT', 'Gt]DW(k9Vr#9^7xuojt?o*_0=(@D[S*:>.yN$-o`q KLlZ%,q5j``=[T?tPeH6NS' );
define( 'LOGGED_IN_SALT',   'BQdF{&jQvp-GY}>@V->9;KtL3OotVS,9%hSXnx/2DUo_lCWZX79v1 %zxm>F}GCB' );
define( 'NONCE_SALT',       'j,{D2qmJ$hAU@NVPu_*l7Lq:oB.]sR%31Bz+>#{$es7]mf9M@|+.yAD9l5h~a0:k' );

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
