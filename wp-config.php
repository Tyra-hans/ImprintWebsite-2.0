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
define( 'DB_NAME', 'ImprintWebsite' );

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
define( 'AUTH_KEY',         '>&@$|@)Q1kI#R65{jpRy ]]G%A{C>M@{Jh^.~TT@7VlV|F8VDu^HV7OH.(qur),)' );
define( 'SECURE_AUTH_KEY',  'xlIAhyR U-i2J0=OY-f=OqKP;LYrdKnnAmIk0T8L|O&4:j&9|1N]82{{F>5!Sm%h' );
define( 'LOGGED_IN_KEY',    'X28<L}Pr&.63>;qhCXmW3?z>Xdk-uk0X*+dpc-zp.$5b=HS9qJTdO&0rXV`!KZp:' );
define( 'NONCE_KEY',        'zWeA~o)IwD5#4LxUf?e%Ilqk9(/_Jt`L?-6yl16jij,AThZZ:Vx}4{VAwh7>? vi' );
define( 'AUTH_SALT',        ';XXnFjmCZ|: Fm%H,<$1b;G5]cp>TDI4dRJSDJU5%H-@Ic$QiqV[#dB.T@j-*LvQ' );
define( 'SECURE_AUTH_SALT', '5W@+1_3w^1jn-dQ{I^aEuaB43>H>0FyO_uw`?^gb NFUc9]y:QY4b]nj0Z=Rnq@P' );
define( 'LOGGED_IN_SALT',   '1Te3aKyVA/G2aF1Z=mP{0$5,R~wqNC4t:>>&6ui&}INt7lmma@hs<j!yY5.eALgR' );
define( 'NONCE_SALT',       '(XO[4gc%`<ITkg;n4IJC.SMbreNI1hBeajcwV.(bb0AkMkbltT!QL^$ olw%VKUE' );

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
