<?php

/**
 * @name TypeChampsContact
 * @version 16/10/2012 (dd/mm/yyyy)
 */
class TypeChampsContact extends TypeChampsContactBase
{
	
	// Nom de la table
	const TABLENAME = 'typechampscontact';
	
	// Nom des champs
	const FIELDNAME_IDTYPECHAMPSCONTACT = 'idtypechampscontact';
	const FIELDNAME_LIBEL = 'libel';
	const FIELDNAME_NUMBERUSED = 'numberused';
	const FIELDNAME_POSITION = 'position';
	
	// Placez votre code ici...
public static function getMaxPosition(Pdo $pdo){
		// récupération de la position la + haute
		$pdoStatement = $pdo->prepare('SELECT MAX(position) FROM '.TypeChampsContact::TABLENAME);
		if (!$pdoStatement->execute( )) {
			throw new Exception('Erreur lors de la mise � jour d\'un champ d\'un(e) typeChampsContact dans la base de donn�es');
		}

		// Op�ration r�ussie ?
		$return = $pdoStatement->fetch();
		return $return['MAX(position)'];

	}


	/**
	 * Charger un(e) typeChampsContact
	 * @param $pdo PDO
	 * @param $position int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return TypeChampsContact
	 */
	public static function loadByPosition(PDO $pdo,$position,$easyload=true)
	{
		// D�j� charg�(e) ?


		// Charger le/la typeChampsContact
		$pdoStatement = TypeChampsContact::_select($pdo,'t.position = ?');
		if (!$pdoStatement->execute(array($position))) {
			throw new Exception('Erreur lors du chargement d\'un(e) typeChampsContact depuis la base de donn�es');
		}

		// R�cup�rer le/la typeChampsContact depuis le jeu de r�sultats
		return TypeChampsContact::fetch($pdo,$pdoStatement,$easyload);
	}



	public static function loadSupPosition(PDO $pdo,$position,$easyload=true)
	{
		// D�j� charg�(e) ?


		// Charger le/la typeChampsContact
		$pdoStatement = TypeChampsContact::_select($pdo,'t.position > ?');
		if (!$pdoStatement->execute(array($position))) {
			throw new Exception('Erreur lors du chargement d\'un(e) typehampsContact depuis la base de donn�es');
		}

		// R�cup�rer le/la typeChampsContact depuis le jeu de r�sultats
		$typeChampsContacts = array();
		while ($typeChampsContact = TypeChampsContact::fetch($pdo,$pdoStatement,$easyload)) {
			$typeChampsContacts[] = $typeChampsContact;
		}

		// Retourner le tableau
		return $typeChampsContacts;
	}

	
}

