<?php

/**
 * @name Contact
 * @version 16/10/2012 (dd/mm/yyyy)
 */
class Contact extends ContactBase
{
	
	// Nom de la table
	const TABLENAME = 'contact';
	
	// Nom des champs
	const FIELDNAME_IDCONTACT = 'idcontact';
	const FIELDNAME_DATECREATION = 'datecreation';
	const FIELDNAME_USER_IDUSER = 'user_iduser';
	
	// Placez votre code ici...
	
	public function listCategories(){
		$pdoStatement = $this->selectCategoryContacts();
		return CategoryContact::fetchAll($this->pdo, $pdoStatement);
	}
	
	/**
	* Récupèrer tous/toutes les contact d'un jeu de résultats
	* @param $pdo PDO
	* @param $pdoStatement PDOStatement
	* @param $lazyload bool Activer le chargement fainéant ?
	* @return CategoryContact[] Tableau de CategoryContact
	*/
	public static function fetchAll(PDO $pdo,PDOStatement $pdoStatement,$lazyload=false)
	{
		$contacts = array();
		while ($cont = self::fetch($pdo,$pdoStatement,$lazyload)) {
			$contacts[] = $cont;
		}
		return $contacts;
	}
	
}

