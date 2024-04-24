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
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'db_Hotel' );

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
define( 'AUTH_KEY',         '4=@xXy.h %Xs6T%GH)C3-{jsY,XXDm!*-L.wk{~G<!nya$ZR^TB}Hd5JK;Z0Y~6R' );
define( 'SECURE_AUTH_KEY',  'P>~~0ZBT__M<zVIy[nLw2Ix#TfVh)YH0$-]uA9Ofe)1:yP!+lVmQkGX>&fC]*;T+' );
define( 'LOGGED_IN_KEY',    '`+q>ft_J*yq{4ShEjA63D?CiPK(tgy!3s,ORfgHB)cdrdyQDj=p8VHw_.? #imkv' );
define( 'NONCE_KEY',        '[0og:D{oW,B8Qs*TIu~X3:]w{>[P4B<TW#DJg`Idf,(DwVrROs6B~-n:^MOH,).*' );
define( 'AUTH_SALT',        '?:1B75/o^F GxYX[olH[Ocp5}cyR[F8K$KY^]N!YxD?nK7P%G8=|4lHdiKcf:d~P' );
define( 'SECURE_AUTH_SALT', 'ZgqoH:oY|nYSH`R:Zk0<jS@_SU29&39l4)jXMwVia*iIeYT^ 8!RReH!,2^7oKc3' );
define( 'LOGGED_IN_SALT',   'MzztmX;Apr$ G* c0OF3lx4<)8JE1NA7uH0=n?_t{5fZT8tM:)CP%P$6H)[-iNLP' );
define( 'NONCE_SALT',       '=`H</6s4K${([1lR4z.1JE}}rYMu#zMns9u57Mf7CKyt)D+~PK4HJu6tF?QmH<UA' );

/**#@-*/

/**
 * WordPress database table prefix.
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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
