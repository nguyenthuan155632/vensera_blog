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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('WP_CACHE', true); //Added by WP-Cache Manager
define( 'WPCACHEHOME', '/var/www/vensera_blog/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
define('DB_NAME', 'vensera_blog');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         '1`af-5@$;I?wYg{:<X/w&XGL*[,dfpar)VMoHMtp2o(5U{wf}4FdGY%fqz$w*O=m');
define('SECURE_AUTH_KEY',  ' T.2^qOf^LG r.=Jq;6Jt*R-Br^A_+.cn6vxiIW.8Y+V~2o]-CSlf@Tie3;Xq#]?');
define('LOGGED_IN_KEY',    '6h%2ChJCh>+;7*OM*pC~%px0)T@5wmz3pYjV^l$sTar*0~2BAX~WKy:1ev$,5O t');
define('NONCE_KEY',        'Nj7vtFPsiA$KEK0Y+A&2uqF6I;NFrC8Si:s.aE!s*m5K*O tIxxj`FSNqW%@HaEg');
define('AUTH_SALT',        'qBhf/b~epp>Q%}.mo+7%A{Cm&S<Ky)=K#2BFQ!&<3RQ/$CWNJ+o<m+LYY}>Xw..[');
define('SECURE_AUTH_SALT', '@h{/dU}?f8VXhl)p;yismDT:!={sw(h^26=#2 ^q$3?zWy0;|4DFv98eh3yvn(Li');
define('LOGGED_IN_SALT',   'yn:1KA[/;M09;N.Mk?/YG 0r=cTEU9(RNn KEiH&6J+?28rM0Cjmgyly+Am=UZFP');
define('NONCE_SALT',       'cp,wsJ.lp5_:v)P-SlFp%u#N*)z>x:xWGh:VTg-SaS+Ru>3zy.Lu]`F8.8J-EPux');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
