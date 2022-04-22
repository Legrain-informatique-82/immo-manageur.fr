<?php
require_once 'confgenerated.php';
/**
 *
 * @author julien
 * @version 1
 * Constante
 *
 */
class Constant extends ConstGenerated{
	//const THEME = 'cupertino';
	const THEME = 'bootstrap';
	//const THEME = 'escalimmo2';
	const EN_MAINTENANCE=false;
	const DEBUG_MOD=true;
	/**
	 * @var String Module chargé par défaut (racine du site)
	 */
	const DEFAULT_MODULE = 'accueil';
	/**
	 * @var Bool Utilisation ou non de l'url rewriting
	 */
	const USE_URL_REWRITING = true;
	/**
	 * @var String Contient l'adresse par défaut du site Internet
	 */
	const DEFAULT_URL = 'http://dev.immo-manageur.fr';
	/**
	 *
	 * @var String dossier contenant les modules
	 */
// 	const DEFAULT_DIRECTORY = '/var/www';
	const DEFAULT_DIRECTORY = '/var/www/aptana/immo-manageur.fr';
	const DEFAULT_MODULE_DIRECTORY = '/var/www/aptana/immo-manageur.fr/modules/';
	const DEFAULT_PICTURE_MODULE_DIRECTORY = '/var/www/aptana/immo-manageur.fr/images/modules/';
	const DEFAULT_TMP_DIRECTORY   = '/var/www/aptana/immo-manageur.fr/tmp/';
	const DEFAULT_CSS_DIRECTORY = '/var/www/aptana/immo-manageur.fr/css/';
	const DEFAULT_LOGS_DIRECTORY   = '/var/www/aptana/immo-manageur.fr/logs/';
	
	
	const DEFAULT_URL_PICTURE_MODULE_DIRECTORY = 'http://dev.immo-manageur.fr/images/modules/';

	const DEFAULT_URL_PICTURE_DIRECTORY= 'http://dev.immo-manageur.fr/images/';
	
	const DEFAULT_URL_LOGO_MODULES = 'http://dev.immo-manageur.fr/images/logoMod.png';
	
	
	// Mettre un / à la fin
	const DEFAULT_DIR_EXPORT_POLIRIS_WITH_URL = '/var/www/aptana/immo-manageur.fr/images/export_poliris/';
	// Mettre un / à la fin
	const DEFAULT_URL_EXPORT_POLIRIS_WITH_URL = 'http://dev.immo-manageur.fr/images/export_poliris/';
	/**
	 *
	 * @var String Nom du serveur
	 */
	const DATABASE_SERVER = 'localhost';
	/**
	 *
	 * @var String Nom de la base
	 */
	const DATABASE_NAME = 'extraimmo';
	/**
	 *
	 * @var String Utilisateur de la base
	 */
	const DATABASE_USER = 'root';
	/**
	 *
	 * @var String Mot de passe de la base
	 */
	const DATABASE_PASSWORD = '';
	/**
	 *
	 * @var Int Taille des mots de passes utilisateurs générés par le programme
	 */
	const LENGHT_PASSWORD_GENERATE = 8;
	/**
	 *
	 * @var Int Taille minimale du mot de passe utilisateur
	 */
	const LENGHT_MIN_PASSWORD = 5;
	/**
	 *
	 * @var Int Taille maximale du mot de passe utilisateur
	 */
	const LENGHT_MAX_PASSWORD = 10;
	/**
	 *
	 * @var String Adresse email utilisée par l'application.
	 */
	const EMAIL_APP = 'no-reply@extra-immo.com';
	/**
	 * @var String Format de date utilisé dans l'application
	 */
	const DATE_FORMAT ='d/m/Y H:i:s';

	const DATE_FORMAT2 ='d/m/Y';
	/**
	 *
	 * @var Int Contient l'id du type de mandat correspondant au terrain.
	 */
	const ID_PLOT_OF_LAND = 1;

	const ID_TRANSACTION_TYPE_SELLER = 2;

	const ID_ETAP_TO_SELL = 1;
	const ID_ETAP_TO_CANCEL =3;
	const ID_ETAP_TO_SELL_BY_OTHER = 5;
	const ID_ETAP_COMPROMIS = 2;
	const ID_ETAP_SELL_BY_ESCALIMMO =4;

	const SIZE_X_PICTURE = 400;
	const SIZE_Y_PICTURE = 300;
	const SIZE_THUMB_X_PICTURE = 243;
	const SIZE_THUMB_Y_PICTURE = 182;


	const SIZE_HEADER_EXPORT_SITE_X = 966;
	const SIZE_HEADER_EXPORT_SITE_Y = 126;
	const SIZE_LOGO_EXPORT_SITE_X = 121;
	const SIZE_LOGO_EXPORT_SITE_Y = 77;
	
	const DOCUMENT_ENTETE_DTE = '';
	
	// Limites
	const LIMIT_NB_USER = 50;
	
	const LIMIT_NB_AGENCY = 5;



// OPM
    const OPEN_MAIL_URL_API = "http://app1.openmail.fr/ws/api-openmail-v-2-1?wsdl";
    const OPEN_MAIL_LANG_API = "fr";
    const OPEN_MAIL_PARTNER_CODE = null;
    const SIZE_MAX_BY_EMAIL_ATTACHMENT='7340032';// En byte/octet


}
require_once 'lang.php';
