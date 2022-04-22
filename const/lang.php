<?php
/**
 *
 * @author julien
 * @version FR
 * Constante de langues.
 *
 */
class Lang {

	const ERROR_UPDATE_DATABASE = 'Erreur lors de la sauvegarde dans la base de données';

	// général :
	const LABEL_UPDATE = 'Modifier';
	const LABEL_DELETE = 'Supprimer';
	const LABEL_CANCEL = 'Annuler';
	const LABEL_SAVE = 'Enregistrer';
	const LABEL_SEE = 'Détail';

	const ERROR_UNKNOW_LOGIN = 'Identifiant inconnu.';
	const ERROR_BAD_PASSWORD = 'Mot de passe erroné.';
	const LABEL_USER_ADD_IDENTIFIANT = 'Identifiant* : ';
	const LABEL_USER_ADD_PASSWORD = 'Mot de passe : ';
	const LABEL_USER_ADD_CONFIRM_PASSWORD = 'Confirmation du mot de passe : ';
	const LABEL_USER_ADD_NAME = 'Nom* : ';
	const LABEL_USER_ADD_FIRSTNAME = ' Prénom : ';
	const LABEL_USER_ADD_EMAIL = 'email* : ';
	const LABEL_USER_ADD_AGENCY_NAME = 'Agence : ';
	const LABEL_USER_ADD_LEVEL = 'Niveau : ';
	const LABEL_USER_ADD_SUBMIT = 'Enregistrer';
	const ERROR_USER_ADD_IDENTIFIANT_IS_IN_DB = 'L\'identifiant est déjà présent dans la base de donnée';
	const ERROR_USER_ADD_IDENTIFIANT_CHARACTERS_ALLOWED = 'Le champ identifiant ne doit contenir que des caractères alphanumériques.';
	const ERROR_USER_ADD_PASSWORD_CHARACTERS_ALLOWED = 'Le champ mot de passe ne doit contenir que des caractères alphanumériques.';
	const ERROR_USER_ADD_SIZE_PASSWORD = "Le nombre de caractère du mot de passe doit être compris entre {sizeMin} et {sizeMax} caractères.";
	const ERROR_USER_ADD_DIFFERENT_PASSWORD = "Le mot de passe et sa confirmation sont différents";
	const ERROR_USER_ADD_EMPTY_NAME = "Le nom doit être renseigné";
	const ERROR_USER_ADD_EMPTY_EMAIL = "L'adresse email doit être renseignée";
	const ERROR_USER_ADD_CORRECT_EMAIL = "Format d'adresse email incorrect";
	const LABEL_EDITO_PASSWORD = 'Laissez les champs "mot de passe" et "confirmation du mot de passe" vide pour que le programme le génère';
	const LABEL_USER_UPDATE_SUBMIT = 'Modifier';
	const ERROR_USER_DELETE = 'Impossible de supprimer son propre compte';

	const LABEL_SECTOR_ADD = 'Ajouter un secteur';
	const LABEL_SECTOR_NAME = 'Nom du secteur : ';
	const LABEL_SECTOR_ADD_SENT = 'Enregistrer';
	const LABEL_SECTOR_UPDATE = 'Modifier le secteur';
	const LABEL_SECTOR_DELETE = 'Suppression d\'un secteur : ';
	const LABEL_SECTOR_DELETE_INFO = 'Êtes vous sûr de vouloir supprimer le secteur : ';
	const LABEL_CITY_ADD = 'Ajouter une ville : ';
	const LABEL_CITY_ADD_CITY_FIRST = 'Avant d\'ajouter une ville, vous devez creer au moins un secteur';
	const LABEL_CITY_ADD_NAME = 'Nom de la ville : ';
	const LABEL_CITY_ADD_ZIP_CODE = 'Code postal : ';
	const LABEL_CITY_ADD_SECTOR = 'Secteur : ';
	const ERROR_CITY_ADD_EMPTY_CITY = 'Le nom de la ville doit être renseigné';
	const ERROR_CITY_ADD_EMPTY_ZIPCODE = 'Le code postal doit être renseigné';
	const ERROR_CITY_ADD_CITY_IS_IN_DB = 'La ville est déjà présente dans la base de donnée.';
	const LABEL_CITY_LIST = 'Liste des villes : ';
	const LABEL_SECTOR_UPDATE_SENT = 'Modifier';
	const ERROR_EMPTY_SECTOR_NAME = 'Vous devez renseigner le champ secteur';
	const LABEL_SECTOR_LIST = 'Liste des secteurs';
	const ERROR_DELETE_SECTOR_BECAUSE_IS_USED = 'Impossible de supprimer le secteur car il est utilisé';
	const LABEL_CITY_DELETE = 'Suppression d\'une ville : ';
	const LABEL_CITY_DELETE_INFO = 'Êtes vous sûr de vouloir supprimer la ville : ';
	const ERROR_DELETE_CITY_BECAUSE_IS_USED = 'Impossible de supprimer la ville car elle est utilisée';
	const LABEL_CITY_UPDATE = 'Modification de la ville';

	const LABEL_NOTARY_ADD_H1 = 'Ajouter un notaire : ';
	const LABEL_NOTARY_ADD_NAME = 'Nom du notaire : ';
	const LABEL_NOTARY_ADD_FISTNAME = 'Prénom du notaire : ';
	const LABEL_NOTARY_ADD_ADDRESS = 'Adresse : ';
	const LABEL_NOTARY_ADD_CITY = 'Ville : ';
	const LABEL_NOTARY_ADD_ZIP_CODE = 'Code postal :';
	const LABEL_NOTARY_ADD_PHONE = 'Tél. : ';
	const LABEL_NOTARY_ADD_MOBIL_PHONE = 'Port. : ';
	const LABEL_NOTARY_ADD_JOB_PHONE = 'Pro. : ';
	const LABEL_NOTARY_ADD_FAX = 'Fax : ';
	const LABEL_NOTARY_ADD_MAIL = 'Mail :';
	const LABEL_NOTARY_ADD_COMMENTS = 'Commentaire : ';
	const ERROR_NOTARY_ADD_NAME_EMPTY = 'Le nom doit être renseigné.';
	const ERROR_NOTARY_ADD_EMAIL_BAD_FORMAT = 'Le format du mail est incorrect.';

	const LABEL_NOTARY_LIST_H1 = 'Liste des notaires : ';
	const LABEL_NOTARY_DELETE_H1 = "Suppression du notaire";
	const LABEL_NOTARY_DELETE_INFO = 'Êtes-vous sûr de vouloir supprimer le notaire : ';
	const ERROR_DELETE_NOTAIRE_BECAUSE_IS_USED = 'Impossible de supprimer le notaire car il est utilisé';
	const LABEL_NOTARY_SEE_H1 = 'Fiche du notaire';

	const LABEL_SELLER_ADD_TITLE_h1 = 'Ajouter un titre de vendeur';
	const LABEL_SELLER_ADD_TITLE_NAME = 'Titre : ';
	const LABEL_SELLER_LIST_TITLE_H1 = 'Liste des titres de vendeurs';
	const LABEL_SELLER_UPDATE_TITLE_h1 = 'Mise à jour du titre du vendeur : ';
	const ERROR_ADD_SELLER_EMPTY_TITLE = 'Un titre de vendeur doit être saisi afin de saisir un vendeur. Merci d\'alerter un admnistrateur';
	const ERROR_ADD_SELLER_EMPTY_CITY = 'Une ville  doit être saisie afin de saisir un vendeur. Merci d\'alerter un admnistrateur';
	const ERROR_SELLER_ADD_EMPTY_NAME = 'Le nom du vendeur doit être renseigné';
	const ERROR_SELLER_ADD_BAD_FORMAT_EMAIL = 'Le format de l\'adresse email est incorrect';

	const LABEL_SELLER_ADD_TITLE = 'Titre du vendeur : ';
	const LABEL_SELLER_ADD_CITY = ' Ville :';
	const LABEL_SELLER_ADD_NAME = 'Nom : ';
	const LABEL_SELLER_ADD_FIRSTNAME = 'Prénom : ';
	const LABEL_SELLER_ADD_ADDRESS = 'Adresse :';
	const LABEL_SELLER_ADD_PHONE = 'Téléphone : ';
	const LABEL_SELLER_ADD_MOBIL_PHONE = 'Téléphone portable : ';
	const LABEL_SELLER_ADD_WORK_PHONE = 'Téléphone travail : ';
	const LABEL_SELLER_ADD_FAX = 'Fax : ';
	const LABEL_SELLER_ADD_EMAIL = 'Email : ';
	const LABEL_SELLER_ADD_COMMENT = 'Commentaire : ';
	const LABEL_SELLER_TITLE_DELETE_h1 = 'Suppression du titre du vendeur';
	const LABEL_SELLER_DELETE_TITLE_INFO = 'Êtes-vous sûr de vouloir supprimer le titre du vendeur :';
	const ERROR_SELLER_TITLE_DELETE = 'Impossible de supprimer le titre car un vendeur l\'utilise';
	const LABEL_SELLER_LIST_H1 = 'Liste des vendeurs';
	const LABEL_SELLER_SEE_H1 = 'Détail du vendeur : ';
	const LABEL_SELLER_DELETE_h1 = 'Suppression du vendeur';
	const LABEL_SELLER_DELETE_INFO = 'Êtes-vous sûr de vouloir supprimer le vendeur :';
	const ERROR_SELLER_DELETE = 'Impossible de supprimer le vendeur';
	const LABEL_NOTARY_UPDATE_H1 = 'Mise à jour du notaire';

	const LABEL_ADD_TERRAIN_AND_REDIRECT_SAVE = 'Sauvegarder et fermer';
	const LABEL_ADD_TERRAIN_CONTINUE_SAVE = 'Sauvegarder et continuer l\'enregistrement';

	const ERROR_TYPE_FORMAT_NUM_MANDAT = 'Le numéro de mandat doit être au format numérique';
	const ERROR_LENGHT_NUM_MANDAT = 'Le champ numéro mandat ne doit pas exceder 3 caractères';
	const ERROR_BAD_FORMAT_DATE_DEBUT_MANDAT = 'Le format de date du début de mandat doit être sous la forme jj/mm/aaaa';
	const ERROR_EMPTY_DATE_DEBUT_MANDAT = 'La date de début de mandat doit être renseignée';
	const ERROR_EMPTY_NUM_MANDAT = 'Le numéro de mandat doit être renseigné';

	const ERROR_EMPTY_DATE_FIN_MANDAT = 'La date de fin de mandat doit être renseignée';
	const ERROR_BAD_FORMAT_DATE_FIN_MANDAT = 'Le format de date de fin de mandat doit être sous la forme jj/mm/aaaa';

	const ERROR_BAD_FORMAT_DATE_LIBRE_MANDAT = 'Le format de date du champ "libre le" du mandat doit être sous la forme jj/mm/aaaa';
	const ERROR_EMPTY_ADDRESS_MANDAT = 'L\'adresse du mandat doit être renseignée';

	const ERROR_FORMAT_TYPE_PRIX_FAI = 'Le format du prix fai est incorrect (numérique)';

	const ERROR_FORMAT_TYPE_PRIX_NET_VENDEUR = 'Le format du prix net vendeur est incorrect (numérique)';
	const ERROR_FORMAT_TYPE_COMMISSION = 'Le format de la commission est incorrect (numérique)';
	const ERROR_FORMAT_TYPE_ESTIMATION_FAI = 'Le format estimation fai est incorrect (numérique)';
	const ERROR_FORMAT_TYPE_MARGE_NEGOCE = 'Le format de la marge de négociation est incorrect (numérique)';
	const ERROR_EMPTY_PRIX_FAI = 'Le prix fai doit être renseigné';
	const ERROR_EMPTY_PRIX_NET_VENDEUR = 'Le prix net vendeur doit être renseigné';
	const ERROR_EMPTY_COMMISSION = 'La commission doit être renseignée';
	const ERROR_EMPTY_ESTIMATION_FAI = 'L\'estimation fai doit être renseignée';
	const ERROR_EMPTY_MARGE_NEGOCE = 'La marge de négociation doit être renseignée';
	const ERROR_LENGHT_REF_CADASTRE1 = 'La reference cadastre 1 ne doit pas exceder 10 caractères';
	const ERROR_LENGHT_REF_CADASTRE2 = 'La reference cadastre 2 ne doit pas exceder 10 caractères';
	const ERROR_LENGHT_REF_CADASTRE3 = 'La reference cadastre 3 ne doit pas exceder 10 caractères';
	const ERROR_LENGHT_AUTRE_REF_CADASTRE = 'le champ autre reference cadastre ne doit pas exceder 10 caractères';
	const ERROR_LENGHT_NUM_LOT = 'Le numéro de lot ne doit pas exceder 10 caractères';

	/*Terrains*/
	const ERROR_SUPERCICIE_PARCELLE_1_ISN_T_INT = "Le champ superficie parcelle 1 doit être un nombre";
	const ERROR_SUPERCICIE_PARCELLE_2_ISN_T_INT = "Le champ superficie parcelle 2 doit être un nombre";
	const ERROR_SUPERCICIE_PARCELLE_3_ISN_T_INT = "Le champ superficie parcelle 3 doit être un nombre";
	const ERROR_SUPERCICIE_AUTRE_PARCELLE_ISN_T_INT = "Le champ superficie autre parcelle doit être un nombre";
	const ERROR_SUPERCICIE_CONSTRUCTIBLE_ISN_T_INT = "Le champ superficie constructible doit être un nombre";
	const ERROR_SUPERCICIE_NON_CONSTRUCTIBLE_ISN_T_INT = "Le champ superficie non constructible doit être un nombre";
	const ERROR_SUPERCICIE_TOTALE_ISN_T_INT = "Le champ superficie totale doit être un nombre";
	const ERROR_SHON_ACCORDEE_ISN_T_INT = "Le champ 'shon accordee' doit être un nombre";
	const ERROR_DATE_FORMAT_FR = 'Les dates doivent être au format jj/mm/aaaa';
	const ERROR_FORMAT_LONGITUDE = "La longitude doit être une valeur numérique";
	const ERROR_FORMAT_LATITUDE = "La latitude doit être une valeur numérique";
	const ERROR_EMPTY_LATITUDE_OR_LONGITUDE = "La latitude et la longitude doivent être renseignées";

	const SUBJECT_REGISTRATION_MAIL = 'Inscription Immo Manageur';
	const CONTENT_REGISTRATION_MAIL = '<p>Bonjour {name}</p><p>Vous êtes inscrit sur <a href="{url}"> l\'extranet</a> </p><p>Pour vous connecter, utilisez le couple suivant : </p>
	<p>Identifiant : {identifiant}<br/>Mot de passe : {password}</p>';

	const SUBJECT_UPDATE_MAIL = 'Modification de vos infos';
	const CONTENT_UPDATE_MAIL = '<p>Bonjour {name}</p><p>Votre fiche a été mise à jour sur <a href="{url}"> l\'extranet</a> </p><p>Pour vous connecter, utilisez le couple suivant : </p>
	<p>Identifiant : {identifiant}<br/>Mot de passe : {password}</p>';
	
	
	
	const TYPE_EXPORT_SITE_DEFAULT = 'Indéfini';
	
	
	
}
