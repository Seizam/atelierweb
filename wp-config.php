<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clefs secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur 
 * {@link http://codex.wordpress.org/Editing_wp-config.php Modifier
 * wp-config.php} (en anglais). C'est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d'installation. Vous n'avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'atelierweb');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'atelierweb');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', 'atelierweb');

/** Adresse de l'hébergement MySQL. */
define('DB_HOST', 'localhost');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8');

/** Type de collation de la base de données. 
  * N'y touchez que si vous savez ce que vous faites. 
  */
define('DB_COLLATE', '');

/**#@+
 * Clefs uniques d'authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant 
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n'importe quel moment, afin d'invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         ',BhXTSry5+O97Fy6a5~ECP-ulF@-Lo`$C$C{[5?h`JWE`4&9KZPW;?Qz2B(O/ 3@');
define('SECURE_AUTH_KEY',  'p GBJT+|mf1Yvv|1+wIuc|Dmg[L{;c~t{-.=(Qc8T[]L^l/0%f,q~2;|u*|ewZG,');
define('LOGGED_IN_KEY',    'U}Pcx-W2LPM~#{zUp@)%-l=9vGn>RX0RF0- R,g5] `|`[Uaj0)JXjKQ5IW|3qU7');
define('NONCE_KEY',        'bM^T)U<B90.,77.@(U!trd/Wu/Bz,Rk:A(w8Mg*.{ZfB}eGq+jG C%y7./m}3?g}');
define('AUTH_SALT',        '0miG7w3`ZW_EVpqVP_5l--1.r>[!*Go!Yc+=GtZJuCsa4G9e2+^c 4<tn=k+OUiv');
define('SECURE_AUTH_SALT', 'Pqq3-n}+|.=bcvWr8*l3L+-n%Y%{O&k0jU@3t>Cc*Uuz,e53k:oX7F5z,Z0Y/T}7');
define('LOGGED_IN_SALT',   'k*ayD7#=Ah m`PnZuf#R-As$4$Pqox{Cn}8wT,|Q*2kK)ZYkW]1K7{Rejx-5?A6n');
define('NONCE_SALT',       'jvz-8v;4iRWL8nw|-mz4+I1}19_y%BI]Y3e$=J=_Iq/{7_nRZ*Hr$cG/vti[ppV|');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique. 
 * N'utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés!
 */
$table_prefix  = 'wp_';

/**
 * Langue de localisation de WordPress, par défaut en Anglais.
 *
 * Modifiez cette valeur pour localiser WordPress. Un fichier MO correspondant
 * au langage choisi doit être installé dans le dossier wp-content/languages.
 * Par exemple, pour mettre en place une traduction française, mettez le fichier
 * fr_FR.mo dans wp-content/languages, et réglez l'option ci-dessous à "fr_FR".
 */
define('WPLANG', 'fr_FR');

/** 
 * Pour les développeurs : le mode deboguage de WordPress.
 * 
 * En passant la valeur suivante à "true", vous activez l'affichage des
 * notifications d'erreurs pendant votre essais.
 * Il est fortemment recommandé que les développeurs d'extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de 
 * développement.
 */ 
define('WP_DEBUG', false); 

/* C'est tout, ne touchez pas à ce qui suit ! Bon blogging ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');