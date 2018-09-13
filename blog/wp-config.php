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
define('DB_NAME', 'crazy-blog');

/** MySQL database username */
define('DB_USER', 'ghoragdush');

/** MySQL database password */
define('DB_PASSWORD', 'cR28etrezawr');

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
define('AUTH_KEY',         'tdSls$nA{zL8E#gGFZx:JtsN5Xr3-nsFqI7{y84ht9M?ZC.j^@TF#=%%hHx.6jB$');
define('SECURE_AUTH_KEY',  ' )Yf [sfSHp_$W=WUov379Jk}Kli)P!LE)Du@g44acv<gj$*GgkT87)~:^-23Qa$');
define('LOGGED_IN_KEY',    '5`9pkD+d](L4DKJQRtN*[VR!}JrpY{yS3uiO28.W&r!85THa=b/(BXg@oA}T<$}3');
define('NONCE_KEY',        '}L;}bq )U}*bHcB:-T`#E6`#|fR*Cpe>hTvO6|89JZe:[Sn$>CD57PAm^Vmhj!wv');
define('AUTH_SALT',        'j]oG|x;%m_Y3W[:Wrs51{=]V>#L6j,2K%zb,;/V9732JPN/7nH2=n!;Lo&hw}Pw(');
define('SECURE_AUTH_SALT', 'T.Z)vt([/aSY[o&-.Ga RBMb*IKA7&Tef2oS>:(C$] 5YUiZzaQBNY=#];|(=;H9');
define('LOGGED_IN_SALT',   '8rJlSZ7=fS3q*@2>&LC$(H4h:E(z1^U2Q =wXv{q0;-8;9SHU9;2a1`!kpybVEiq');
define('NONCE_SALT',       'p<Em9z$YU_*R&`$`}EJst5fOi><Z)/10U)OI#~.r[oAA_jlsF.Qo@,e-^MYs%yte');

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
