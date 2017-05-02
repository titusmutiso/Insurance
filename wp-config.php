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
define('DB_NAME', 'demoafri_ss_dbnamefd0');

/** MySQL database username */
define('DB_USER', 'demoafri_ss_dfd0');

/** MySQL database password */
define('DB_PASSWORD', 'eHxdtxg1HNPS');

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
define('AUTH_KEY', 'hfB$GFld}GHllRBuhghxz$jf?IWAD&E<ws+{(Ir}X|Dr@<PloinO&rZHi!Pwu%kCLPigfdjVuc]Ge*{_@Wwu!!$T%Aix$y/fR!{E<V&?yu)]wUL>A^v?atzDfSAl_*pL');
define('SECURE_AUTH_KEY', ';[-ZnIT;q?[m;XG<|{hxeApXbs&s?]YPRy(H<ld+e=VGhb?|!GSQBQ?!sCCfn<hZDMMGiB-JIB*d<)ABb{[==BxYlk(uXSIVe<i$[yvBFGkvJRBrFh+H?VaJkw<l-*dC');
define('LOGGED_IN_KEY', 'rf[eLD)d-S;n/!JkV|mRuhb_u${HqVVVigti(Y^W_j&yV|aGu]FeJPy_NihyYK&wrbo|rvW[jxSZuU^-fdZ%gz{?}lvZJICuUxsnMkzYFQHZ&uhaAsbIy}S;qix}q>L$');
define('NONCE_KEY', 'GnZz*+SC-)_@A;oDAwh=}!uRHn&Y{S@!o|uO$WhY$Sl;nkf*q>TZq*=YOuTazM=GizdmMW*m_hCIMm[oNORMOhjaShEsev!_Ydo)&xQInt_/]A^QEruhv/AcK(T}ffRq');
define('AUTH_SALT', '?jqxiDXmw-ny?-D/>MVJ$MOdE*Mby!oBqmrt_DADjrNk$+(<<|TerS|T;$Pwd<_AdoUIEnPsUUdcO]?VNpH%tP^-m|/<YDF)U[b}rr|ldPuCK+Z_dsR}zoy!SJqDRSza');
define('SECURE_AUTH_SALT', '?@^CvtdHttGRa^Wrb%LIYwFp_^wh*uUW/FrXp>kzUtH[BSjuDgH<DvHRd[WEQTX[(HDhzIuj_aL^*mLMQ?s/g]-yJb(}VpD[RmUPB[^LYr;T>i^S=sRZya@CP+K;Kbf/');
define('LOGGED_IN_SALT', 'q_g?>h](SXM/Q+v=WUD!PR|XH)AMHh]dvjHx{?bJMyzxVmpz>CbCS*erLzwZ@}NgdotRfB&!oJuOq(Tuwi(U)?wj&}OaIod)*Bcfgh<$G//egcchV<H[rxJCM)iimMtG');
define('NONCE_SALT', '[H]LbV=T]a$QDgvAu<$Ke%vrSrtoUgkuv}pFAN_v)Z@m^>pGe+sJ_+Sd/yVI-GhDmT!qW()*Q=^TY$i/SF?tS$v++qkWxACgMktYkej[()Jim_D)jlOweMCq<POJWJmP');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_eqml_';

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
