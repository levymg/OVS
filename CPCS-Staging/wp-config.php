<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', '371272_cpcswp');

/** MySQL database username */
define('DB_USER', '371272_cpcsusr');

/** MySQL database password */
define('DB_PASSWORD', 'Un3nd1ng!D351gns?');

/** MySQL hostname */
define('DB_HOST', 'mysql51-038.wc1.dfw1.stabletransit.com');

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
define('AUTH_KEY',         'wIP+q`i1;@K/wc9_]>zvn.+}C#%d3QU3b979i |mzKLfKwTX82QRJrm39.Eg;q0[');
define('SECURE_AUTH_KEY',  '*$]l{V{ku>H|$u%jnc mu6pIh1QnT0fT#82msz!hzRINx:(!|`A-zH;@Q>lrd4ST');
define('LOGGED_IN_KEY',    'R7z}}uZCIoMNPnXBbI)nJLlISy*9mK[F2iT0G)i*{f6u+{J7<lUR`]3p7+p5FA]9');
define('NONCE_KEY',        'kC9T=q16db>X;_Nz`tB<hVmnp}`|vBE;V.LRD*dhB*&-!VrwsBYz~cB;(H!pF,$%');
define('AUTH_SALT',        'h@T-v??,0|BrZ94+)`Mb;*,I)v2Sm$osFQH*37]!b*%_$E-1ROp06H[bix8-)V9=');
define('SECURE_AUTH_SALT', 'MFU(WZM4xk0,Ca6+f5>R? Z L >FQ@f7<eQa4,_Vd1k4*>r+;2*`fJJ7Gh}}4PWs');
define('LOGGED_IN_SALT',   'OAU>e<$q*tM3M<9OjLUE3RI3c|y3x+p[8-%takHo`wwuw^bT)IyT3~{kBpI*>IeZ');
define('NONCE_SALT',       'M%1ll:tu?/,0u]]J+iP5!m)},-q|Z(CD &5^-O2< !*u@+puwgRjr4J94%+]o0ws');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'cpcs_';

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
