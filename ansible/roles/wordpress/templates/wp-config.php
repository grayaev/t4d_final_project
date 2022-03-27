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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'MySQL-t4d' );

/** Database username */
define( 'DB_USER', 'user' );

/** Database password */
define( 'DB_PASSWORD', '5t1ah1P8RZN(q039' );

/** Database hostname */
define( 'DB_HOST', '10.0.1.4' );

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
define( 'AUTH_KEY',         '|d|}~h=^+:g1^Sg!YyUa!{3;]CEwTZY27u#s-`wU%erSs-5AC=o5bidHj<P%j4`y' );
define( 'SECURE_AUTH_KEY',  '/CW3<P_jeX%!*2=[[R_vre9J*CCNz6&S484wp3VFyUq$:uhJ1yhdC_WcT44.+YiN' );
define( 'LOGGED_IN_KEY',    'k[$JsWMF 6H4kk)I8JT2=joBH8^L+pi>_aNCV`cA^B7F]Jc>{SeFnds7s_NaTJqm' );
define( 'NONCE_KEY',        ']c90D) ,.,jCa >2b-%Okl/p(n]p[,E*_f~ao1|#6,tctFCm|b=*E,A?;2[$P[B#' );
define( 'AUTH_SALT',        'OG~-ORN8gK`;LV! e7y1>HvDA4L|yy}Ce4<`@C/ uS2A=;:#$<7C&: Oq._~KM2E' );
define( 'SECURE_AUTH_SALT', '5*aCy&GQZp$i=0>%z(Mnjkm1e(vJ}oZtO&[ZH>)}0pR)9}H@ST$8,YM#`?rnR.h ' );
define( 'LOGGED_IN_SALT',   'A+v`y[b)7%80<}rq-7$[4YFZWPlZx_UR+5Q5[[`w2=v{i=^,iz5 Rccz}n*ALhX3' );
define( 'NONCE_SALT',       ';*jo4ggkX_cWyiK= W+[hldOryXn>&^7C_HT*c]B[J>Ln6Qq!{$q*tSB7^reCtHB' );

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
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