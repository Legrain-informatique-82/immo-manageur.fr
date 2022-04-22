<?php

/**
 * @class ChampsContact
 * @date 21/07/2011 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class ChampsContact
{
	/// @var PDO
	private $pdo;

	/// @var array tableau pour le chargement rapide
	private static $easyload;

	/// @var int
	private $idChampsContact;

	/// @var string
	private $libel;

	/// @var string
	private $val;

	/// @var int
	private $position;

	/// @var bool
	private $indestructible;

	/// @var int id de typechampscontact
	private $typeChampsContact;

	/// @var int id de contact
	private $contact;

	/**
	 * Construire un(e) champsContact
	 * @param $pdo PDO
	 * @param $idChampsContact int
	 * @param $libel string
	 * @param $val string
	 * @param $position int
	 * @param $typeChampsContact int id de typechampscontact
	 * @param $contact int id de contact
	 * @param $indestructible bool
	 * @param $easyload bool activer le chargement rapide ?
	 * @return ChampsContact
	 */
	protected function __construct(PDO $pdo,$idChampsContact,$libel,$val,$position,$typeChampsContact,$contact,$indestructible=false,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;

		// Sauvegarder les attributs
		$this->idChampsContact = $idChampsContact;
		$this->libel = $libel;
		$this->val = $val;
		$this->position = $position;
		$this->typeChampsContact = $typeChampsContact;
		$this->contact = $contact;
		$this->indestructible = $indestructible;

		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			ChampsContact::$easyload[$idChampsContact] = $this;
		}
	}

	/**
	 * Cr�er un(e) champsContact
	 * @param $pdo PDO
	 * @param $libel string
	 * @param $val string
	 * @param $position int
	 * @param $typeChampsContact TypeChampsContact
	 * @param $contact Contact
	 * @param $indestructible bool
	 * @param $easyload bool activer le chargement rapide ?
	 * @return ChampsContact
	 */
	public static function create(PDO $pdo,$libel,$val,$position,TypeChampsContact $typeChampsContact,Contact $contact,$indestructible=false,$easyload=true)
	{
		// Ajouter le/la champsContact dans la base de donn�es
		$pdoStatement = $pdo->prepare('INSERT INTO ChampsContact (libel,val,position,typeChampsContact_idTypeChampsContact,contact_idContact,indestructible) VALUES (?,?,?,?,?,?)');
		if (!$pdoStatement->execute(array($libel,$val,$position,$typeChampsContact->getIdTypeChampsContact(),$contact->getIdContact(),$indestructible))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) champsContact dans la base de donn�es');
		}

		// Construire le/la champsContact
		return new ChampsContact($pdo,$pdo->lastInsertId(),$libel,$val,$position,$typeChampsContact->getIdTypeChampsContact(),$contact->getIdContact(),$indestructible,$easyload);
	}

	/**
	 * Requ�te de s�l�ction
	 * @param $pdo PDO
	 * @param $where string
	 * @param $orderby string
	 * @param $limit string
	 * @return PDOStatement
	 */
	private static function _select(PDO $pdo,$where=null,$orderby=null,$limit=null)
	{
		return $pdo->prepare('SELECT c.idChampsContact, c.libel, c.val, c.position, c.typeChampsContact_idTypeChampsContact, c.contact_idContact, c.indestructible FROM ChampsContact c '.
		($where != null ? ' WHERE '.$where : '').
		($orderby != null ? ' ORDERBY '.$orderby : '').
		($limit != null ? ' LIMIT '.$limit : ''));
	}

	/**
	 * Charger un(e) champsContact
	 * @param $pdo PDO
	 * @param $idChampsContact int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return ChampsContact
	 */
	public static function load(PDO $pdo,$idChampsContact,$easyload=true)
	{
		// D�j� charg�(e) ?
		if (isset(ChampsContact::$easyload[$idChampsContact])) {
			return ChampsContact::$easyload[$idChampsContact];
		}

		// Charger le/la champsContact
		$pdoStatement = ChampsContact::_select($pdo,'c.idChampsContact = ?');
		if (!$pdoStatement->execute(array($idChampsContact))) {
			throw new Exception('Erreur lors du chargement d\'un(e) champsContact depuis la base de donn�es');
		}

		// R�cup�rer le/la champsContact depuis le jeu de r�sultats
		return ChampsContact::fetch($pdo,$pdoStatement,$easyload);
	}

	/**
	 * Charger tous/toutes les champsContacts
	 * @param $pdo PDO
	 * @param $easyload bool activer le chargement rapide ?
	 * @return ChampsContact[] tableau de champscontacts
	 */
	public static function loadAll(PDO $pdo,$easyload=false)
	{
		// S�lectionner tous/toutes les champsContacts
		$pdoStatement = ChampsContact::selectAll($pdo);

		// Mettre chaque champsContact dans un tableau
		$champsContacts = array();
		while ($champsContact = ChampsContact::fetch($pdo,$pdoStatement,$easyload)) {
			$champsContacts[] = $champsContact;
		}

		// Retourner le tableau
		return $champsContacts;
	}

	/**
	 * S�lectionner tous/toutes les champsContacts
	 * @param $pdo PDO
	 * @return PDOStatement
	 */
	public static function selectAll(PDO $pdo)
	{
		$pdoStatement = ChampsContact::_select($pdo);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les champsContacts depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�re le/la champsContact suivant(e) d'un jeu de r�sultats
	 * @param $pdo PDO
	 * @param $pdoStatement PDOStatement
	 * @param $easyload bool activer le chargement rapide ?
	 * @return ChampsContact
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idChampsContact,$libel,$val,$position,$typeChampsContact,$contact,$indestructible) = $values;

		// Construire le/la champsContact
		return isset(ChampsContact::$easyload[$idChampsContact.'-'.$libel.'-'.$val.'-'.$position.'-'.$typeChampsContact.'-'.$contact.'-'.$indestructible]) ? ChampsContact::$easyload[$idChampsContact.'-'.$libel.'-'.$val.'-'.$position.'-'.$typeChampsContact.'-'.$contact.'-'.$indestructible] :
		new ChampsContact($pdo,$idChampsContact,$libel,$val,$position,$typeChampsContact,$contact,$indestructible,$easyload);
	}

	/**
	 * Serialiser
	 * @param $serialize bool activer la s�rialisation ?
	 * @return string serialisation du/de la champscontact
	 */
	public function serialize($serialize=true)
	{
		// S�rialiser le/la champsContact
		$array = array('idChampsContact' => $this->idChampsContact,'libel' => $this->libel,'val' => $this->val,'position' => $this->position,'typeChampsContact' => $this->typeChampsContact,'contact' => $this->contact,'indestructible' => $this->indestructible);

		// Retourner la serialisation (ou pas) du/de la champsContact
		return $serialize ? serialize($array) : $array;
	}

	/**
	 * D�s�rialiser
	 * @param $pdo PDO
	 * @param $string string serialisation du/de la champscontact
	 * @param $easyload bool activer le chargement rapide ?
	 * @return ChampsContact
	 */
	public static function unserialize(PDO $pdo,$string,$easyload=true)
	{
		// D�s�rialiser la chaine de caract�res
		$array = unserialize($string);

		// Construire le/la champsContact
		return isset(ChampsContact::$easyload[$array['idChampsContact']]) ? ChampsContact::$easyload[$array['idChampsContact']] :
		new ChampsContact($pdo,$array['idChampsContact'],$array['libel'],$array['val'],$array['position'],$array['typeChampsContact'],$array['contact'],$array['indestructible'],$easyload);
	}

	/**
	 * Test d'�galit�
	 * @param $champsContact ChampsContact
	 * @return bool les objets sont ils �gaux ?
	 */
	public function equals($champsContact)
	{
		// Test si null
		if ($champsContact == null) { return false; }

		// Tester la classe
		if (!($champsContact instanceof ChampsContact)) { return false; }

		// Tester les ids
		return $this->idChampsContact == $champsContact->idChampsContact;
	}

	/**
	 * Compter les champsContacts
	 * @param $pdo PDO
	 * @return int nombre de champscontacts
	 */
	public static function count(PDO $pdo)
	{
		if (!($pdoStatement = $pdo->query('SELECT COUNT(idChampsContact) FROM ChampsContact'))) {
			throw new Exception('Erreur lors du comptage des champsContacts dans la base de donn�es');
		}
		return $pdoStatement->fetchColumn();
	}

	/**
	 * Supprimer le/la champsContact
	 * @return bool op�ration r�ussie ?
	 */
	public function delete()
	{
		// Supprimer le/la champsContact
		$pdoStatement = $this->pdo->prepare('DELETE FROM ChampsContact WHERE idChampsContact = ?');
		if (!$pdoStatement->execute(array($this->getIdChampsContact()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) champsContact dans la base de donn�es');
		}

		// Op�ration r�ussie ?
		return $pdoStatement->rowCount() == 1;
	}

	/**
	 * Mettre � jour un champ dans la base de donn�es
	 * @param $fields array
	 * @param $values array
	 * @return bool op�ration r�ussie ?
	 */
	private function _set($fields,$values)
	{
		// Pr�parer la mise � jour
		$updates = array();
		foreach ($fields as $field) {
			$updates[] = $field.' = ?';
		}

		// Mettre � jour le champ
		$pdoStatement = $this->pdo->prepare('UPDATE ChampsContact SET '.implode(', ', $updates).' WHERE idChampsContact = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdChampsContact())))) {
			throw new Exception('Erreur lors de la mise � jour d\'un champ d\'un(e) champsContact dans la base de donn�es');
		}

		// Op�ration r�ussie ?
		return $pdoStatement->rowCount() == 1;
	}

	/**
	 * Mettre � jour tous les champs dans la base de donn�es
	 * @return bool op�ration r�ussie ?
	 */
	public function update()
	{
		return $this->_set(array('libel','val','position','indestructible','typeChampsContact_idTypeChampsContact','contact_idContact'),array($this->libel,$this->val,$this->position,$this->indestructible,$this->typeChampsContact,$this->contact));
	}

	/**
	 * R�cup�rer le/la idChampsContact
	 * @return int
	 */
	public function getIdChampsContact()
	{
		return $this->idChampsContact;
	}
public function getId()
	{
		return $this->idChampsContact;
	}
	/**
	 * R�cup�rer le/la libel
	 * @return string
	 */
	public function getLibel()
	{
		return $this->libel;
	}

	/**
	 * D�finir le/la libel
	 * @param $libel string
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setLibel($libel,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->libel = $libel;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('libel'),array($libel)) : true;
	}

	/**
	 * R�cup�rer le/la val
	 * @return string
	 */
	public function getVal()
	{
		return $this->val;
	}

	/**
	 * D�finir le/la val
	 * @param $val string
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setVal($val,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->val = $val;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('val'),array($val)) : true;
	}

	/**
	 * R�cup�rer le/la position
	 * @return int
	 */
	public function getPosition()
	{
		return $this->position;
	}

	/**
	 * D�finir le/la position
	 * @param $position int
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setPosition($position,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->position = $position;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('position'),array($position)) : true;
	}

	/**
	 * R�cup�rer le/la indestructible
	 * @return bool
	 */
	public function getIndestructible()
	{
		return $this->indestructible;
	}

	/**
	 * D�finir le/la indestructible
	 * @param $indestructible bool
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setIndestructible($indestructible,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->indestructible = $indestructible;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('indestructible'),array($indestructible)) : true;
	}

	/**
	 * R�cup�rer le/la typeChampsContact
	 * @return TypeChampsContact
	 */
	public function getTypeChampsContact()
	{
		return TypeChampsContact::load($this->pdo,$this->typeChampsContact);
	}

	/**
	 * D�finir le/la typeChampsContact
	 * @param $typeChampsContact TypeChampsContact
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setTypeChampsContact(TypeChampsContact $typeChampsContact,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->typeChampsContact = $typeChampsContact->getIdTypeChampsContact();

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('typeChampsContact_idTypeChampsContact'),array($typeChampsContact->getIdTypeChampsContact())) : true;
	}

	/**
	 * S�lectionner les champsContacts par typeChampsContact
	 * @param $pdo PDO
	 * @param $typeChampsContact TypeChampsContact
	 * @return PDOStatement
	 */
	public static function selectByTypeChampsContact(PDO $pdo,TypeChampsContact $typeChampsContact)
	{
		$pdoStatement = $pdo->prepare('SELECT c.idChampsContact, c.libel, c.val, c.position, c.typeChampsContact_idTypeChampsContact, c.contact_idContact, c.indestructible FROM ChampsContact c WHERE c.typeChampsContact_idTypeChampsContact = ?');
		if (!$pdoStatement->execute(array($typeChampsContact->getIdTypeChampsContact()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les champsContacts par typeChampsContact depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�rer le/la contact
	 * @return Contact
	 */
	public function getContact()
	{
		return Contact::load($this->pdo,$this->contact);
	}

	/**
	 * D�finir le/la contact
	 * @param $contact Contact
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setContact(Contact $contact,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->contact = $contact->getIdContact();

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('contact_idContact'),array($contact->getIdContact())) : true;
	}

	/**
	 * S�lectionner les champsContacts par contact
	 * @param $pdo PDO
	 * @param $contact Contact
	 * @return PDOStatement
	 */
	public static function selectByContact(PDO $pdo,Contact $contact)
	{
		$pdoStatement = $pdo->prepare('SELECT c.idChampsContact, c.libel, c.val, c.position, c.typeChampsContact_idTypeChampsContact, c.contact_idContact, c.indestructible FROM ChampsContact c WHERE c.contact_idContact = ? ORDER BY c.typeChampsContact_idTypeChampsContact, c.position');
		if (!$pdoStatement->execute(array($contact->getIdContact()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les champsContacts par contact depuis la base de donn�es');
		}
		return $pdoStatement;
	}
	/**
	 * ToString
	 * @return string repr�sentation de champscontact sous la forme d'un string
	 */
	public function __toString()
	{
		return '[ChampsContact idChampsContact="'.$this->idChampsContact.'" libel="'.$this->libel.'" val="'.$this->val.'" position="'.$this->position.'" indestructible="'.($this->indestructible?'true':'false').'" typeChampsContact="'.$this->typeChampsContact.'" contact="'.$this->contact.'"]';
	}

	public static function loadByContactAndIndestructible( PDO $pdo, Contact $contact){
		$pdoStatement = $pdo->prepare('SELECT c.idChampsContact, c.libel, c.val, c.position, c.typeChampsContact_idTypeChampsContact, c.contact_idContact, c.indestructible FROM ChampsContact c WHERE c.contact_idContact = ? AND c.indestructible=1');
		if (!$pdoStatement->execute(array($contact->getIdContact()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les champsContacts par contact depuis la base de donn�es');
		}
		return ChampsContact::fetch($pdo,$pdoStatement,$easyload);
	}
}


