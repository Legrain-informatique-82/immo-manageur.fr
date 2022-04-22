<?php

/**
 * @name ChampsContact
 * @version 16/10/2012 (dd/mm/yyyy)
 */
class ChampsContact extends ChampsContactBase
{
	
	// Nom de la table
	const TABLENAME = 'champscontact';
	
	// Nom des champs
	const FIELDNAME_IDCHAMPSCONTACT = 'idchampscontact';
	const FIELDNAME_LIBEL = 'libel';
	const FIELDNAME_VAL = 'val';
	const FIELDNAME_POSITION = 'position';
	const FIELDNAME_INDESTRUCTIBLE = 'indestructible';
	const FIELDNAME_TYPECHAMPSCONTACT_IDTYPECHAMPSCONTACT = 'typechampscontact_idtypechampscontact';
	const FIELDNAME_CONTACT_IDCONTACT = 'contact_idcontact';
	
	// Placez votre code ici...
public static function loadByContactAndIndestructible( PDO $pdo, Contact $contact){
 $sql= 'SELECT c.'.ChampsContact::FIELDNAME_IDCHAMPSCONTACT.', c.'.ChampsContact::FIELDNAME_LIBEL.', c.'.ChampsContact::FIELDNAME_VAL.',  c.'.ChampsContact::FIELDNAME_POSITION.', c.'.ChampsContact::FIELDNAME_TYPECHAMPSCONTACT_IDTYPECHAMPSCONTACT.', c.'.ChampsContact::FIELDNAME_CONTACT_IDCONTACT.',  c.'.ChampsContact::FIELDNAME_INDESTRUCTIBLE.' FROM '.ChampsContact::TABLENAME .' c WHERE c.'.ChampsContact::FIELDNAME_CONTACT_IDCONTACT.' = ? AND c.'.ChampsContact::FIELDNAME_INDESTRUCTIBLE.' =1 ';
		$pdoStatement = $pdo->prepare($sql);
		if (!$pdoStatement->execute(array($contact->getIdContact()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les champsContacts par contact depuis la base de donn�es');
		}
		return ChampsContact::fetch($pdo,$pdoStatement,$easyload);
	}
	
}

