<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'db_klubjantung');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'Jw9+|o2Q [Lxyp|:`,<uQ2a+70UL_o+:.SpHBDv@$_z!6|&>#[t^Ge`Iw7quKF4{');
define('SECURE_AUTH_KEY',  'l82sYI u-ao3R3ITL| a$tj0XbSX)7.dV^i}}^Rr2L4~3AL<>hd@n@8oMlv=PW+L');
define('LOGGED_IN_KEY',    '^yn^# 4HmE^w:.Bp]L Vq(g-V!ik2UaY%uto+m!Nd%f&k<sqdtq4QOg28W#tN-d;');
define('NONCE_KEY',        'jd2d*x-c*YV0IM#)7*U`6@W|464$!%ej@!GgLZj?(?=g5(C+ Y3x461X* v!$Rrg');
define('AUTH_SALT',        '%pw o+-Cg)]9)p+f`@g_|9[aGFpoh@tLrm9~88++@Up?`m3)-T]BD+PKR43H~QT)');
define('SECURE_AUTH_SALT', 'R+_ICbB}Z+)Uc|sa64c+{_+O#DccAz4qD;dGf;0@Cj8NrV.,eWj38wyk9-=xk3lw');
define('LOGGED_IN_SALT',   '_5LGX7{qz@[|0Iqm;+/uB(XO2950o3&,}HPoHI:kY^$(2h}5Q1|F.3<N,C!{FClg');
define('NONCE_SALT',       'Ii09hJrD#PX<~LFAlNsxl5|kHuR+5dA&K#8T98u|B#a/Q(P_fD(>T%ih6FK9U:pW');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
