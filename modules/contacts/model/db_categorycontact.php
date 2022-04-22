<?php

/**
 * @name CategoryContact
 * @version 16/10/2012 (dd/mm/yyyy)
 */
class CategoryContact extends CategoryContactBase
{
	
	// Nom de la table
	const TABLENAME = 'categorycontact';
	
	// Nom des champs
	const FIELDNAME_IDCATEGORYCONTACT = 'idcategorycontact';
	const FIELDNAME_NAME = 'name';
	
	// Placez votre code ici...
/**
 * 
 * 
 * @param PDO $pdo
 * @param String $name
 * @return Bool
 */
	public function nameExist(PDO $pdo,$name){
		
		{
			$pdoStatement = $pdo->prepare('SELECT COUNT('.CategoryContact::FIELDNAME_IDCATEGORYCONTACT.') FROM '.CategoryContact::TABLENAME.' WHERE '.CategoryContact::FIELDNAME_NAME.' = ?');
			if (!$pdoStatement->execute(array($name))) {
				throw new Exception('Erreur lors de la vérification de la présence du nom');
			}
			return (Int)$pdoStatement->fetchColumn()==0?false:true;
		}
	}
	
	/**
	* Récupèrer tous/toutes les CategoryContact d'un jeu de résultats
	* @param $pdo PDO
	* @param $pdoStatement PDOStatement
	* @param $lazyload bool Activer le chargement fainéant ?
	* @return CategoryContact[] Tableau de CategoryContact
	*/
	public static function fetchAll(PDO $pdo,PDOStatement $pdoStatement,$lazyload=false)
	{
		$categoriesContacts = array();
		while ($catCont = self::fetch($pdo,$pdoStatement,$lazyload)) {
			$categoriesContacts[] = $catCont;
		}
		return $categoriesContacts;
	}
	
	
}

