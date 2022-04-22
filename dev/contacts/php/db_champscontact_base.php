<?php

/**
 * @name ChampsContact
 * @version 16/10/2012 (dd/mm/yyyy)
 * @author WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
abstract class ChampsContactBase
{
	/** @var PDO  */
	protected $pdo;
	
	/** @var array tableau pour le chargement fainéant */
	protected static $lazyload;
	
	/** @var int  */
	protected $idChampsContact;
	
	/** @var string  */
	protected $libel;
	
	/** @var string  */
	protected $val;
	
	/** @var int  */
	protected $position;
	
	/** @var bool  */
	protected $indestructible;
	
	/** @var int id de typechampscontact */
	protected $typeChampsContact;
	
	/** @var int id de contact */
	protected $contact;
	
	/**
	 * Construire un(e) champsContact
	 * @param $pdo PDO 
	 * @param $idChampsContact int 
	 * @param $libel string 
	 * @param $val string 
	 * @param $position int 
	 * @param $typeChampsContact int Id de typeChampsContact
	 * @param $contact int Id de contact
	 * @param $indestructible bool 
	 * @param $lazyload bool Activer le chargement fainéant ?
	 */
	protected function __construct(PDO $pdo,$idChampsContact,$libel,$val,$position,$typeChampsContact,$contact,$indestructible=false,$lazyload=false)
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
		
		// Sauvegarder pour le chargement fainéant
		if ($lazyload) {
			self::$lazyload[$idChampsContact] = $this;
		}
	}
	
	/**
	 * Créer un(e) champsContact
	 * @param $pdo PDO 
	 * @param $libel string 
	 * @param $val string 
	 * @param $position int 
	 * @param $typeChampsContact TypeChampsContact 
	 * @param $contact Contact 
	 * @param $indestructible bool 
	 * @param $lazyload bool Activer le chargement fainéant ?
	 * @return ChampsContact 
	 */
	public static function create(PDO $pdo,$libel,$val,$position,TypeChampsContact $typeChampsContact,Contact $contact,$indestructible=false,$lazyload=true)
	{
		// Ajouter le/la champsContact dans la base de données
		$pdoStatement = $pdo->prepare('INSERT INTO '.ChampsContact::TABLENAME.' ('.ChampsContact::FIELDNAME_LIBEL.','.ChampsContact::FIELDNAME_VAL.','.ChampsContact::FIELDNAME_POSITION.','.ChampsContact::FIELDNAME_TYPECHAMPSCONTACT_IDTYPECHAMPSCONTACT.','.ChampsContact::FIELDNAME_CONTACT_IDCONTACT.','.ChampsContact::FIELDNAME_INDESTRUCTIBLE.') VALUES (?,?,?,?,?,?)');
		if (!$pdoStatement->execute(array($libel,$val,$position,$typeChampsContact->getIdTypeChampsContact(),$contact->getIdContact(),$indestructible))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) champsContact dans la base de données');
		}
		
		// Construire le/la champsContact
		return new ChampsContact($pdo,$pdo->lastInsertId(),$libel,$val,$position,$typeChampsContact->getIdTypeChampsContact(),$contact->getIdContact(),$indestructible,$lazyload);
	}
	
	/**
	 * Requête de sélection
	 * @param $pdo PDO 
	 * @param $where string|array 
	 * @param $orderby string|array 
	 * @param $limit string|array 
	 * @param $from string|array 
	 * @return PDOStatement 
	 */
	protected static function _select(PDO $pdo,$where=null,$orderby=null,$limit=null,$from=null)
	{
		return $pdo->prepare('SELECT DISTINCT '.ChampsContact::TABLENAME.'.'.ChampsContact::FIELDNAME_IDCHAMPSCONTACT.', '.ChampsContact::TABLENAME.'.'.ChampsContact::FIELDNAME_LIBEL.', '.ChampsContact::TABLENAME.'.'.ChampsContact::FIELDNAME_VAL.', '.ChampsContact::TABLENAME.'.'.ChampsContact::FIELDNAME_POSITION.', '.ChampsContact::TABLENAME.'.'.ChampsContact::FIELDNAME_TYPECHAMPSCONTACT_IDTYPECHAMPSCONTACT.', '.ChampsContact::TABLENAME.'.'.ChampsContact::FIELDNAME_CONTACT_IDCONTACT.', '.ChampsContact::TABLENAME.'.'.ChampsContact::FIELDNAME_INDESTRUCTIBLE.' '.
		                     'FROM '.ChampsContact::TABLENAME.($from != null ? ', '.(is_array($from) ? implode(', ',$from) : $from) : '').
		                     ($where != null ? ' WHERE '.(is_array($where) ? implode(' AND ',$where) : $where) : '').
		                     ($orderby != null ? ' ORDER BY '.(is_array($orderby) ? implode(', ',$orderby) : $orderby) : '').
		                     ($limit != null ? ' LIMIT '.(is_array($limit) ? implode(', ', $limit) : $limit) : ''));
	}
	
	/**
	 * Charger un(e) champsContact
	 * @param $pdo PDO 
	 * @param $idChampsContact int 
	 * @param $lazyload bool Activer le chargement fainéant ?
	 * @return ChampsContact 
	 */
	public static function load(PDO $pdo,$idChampsContact,$lazyload=true)
	{
		// Déjà chargé(e) ?
		if (isset(self::$lazyload[$idChampsContact])) {
			return self::$lazyload[$idChampsContact];
		}
		
		// Charger le/la champsContact
		$pdoStatement = self::_select($pdo,ChampsContact::FIELDNAME_IDCHAMPSCONTACT.' = ?');
		if (!$pdoStatement->execute(array($idChampsContact))) {
			throw new Exception('Erreur lors du chargement d\'un(e) champsContact depuis la base de données');
		}
		
		// Récupérer le/la champsContact depuis le jeu de résultats
		return self::fetch($pdo,$pdoStatement,$lazyload);
	}
	
	/**
	 * Charger tous/toutes les champsContacts
	 * @param $pdo PDO 
	 * @param $lazyload bool Activer le chargement fainéant ?
	 * @return ChampsContact[] Tableau de champsContacts
	 */
	public static function loadAll(PDO $pdo,$lazyload=false)
	{
		// Sélectionner tous/toutes les champsContacts
		$pdoStatement = self::selectAll($pdo);
		
		// Mettre chaque champsContact dans un tableau
		$champsContacts = array();
		while ($champsContact = self::fetch($pdo,$pdoStatement,$lazyload)) {
			$champsContacts[] = $champsContact;
		}
		
		// Retourner le tableau
		return $champsContacts;
	}
	
	/**
	 * Sélectionner tous/toutes les champsContacts
	 * @param $pdo PDO 
	 * @return PDOStatement 
	 */
	public static function selectAll(PDO $pdo)
	{
		$pdoStatement = self::_select($pdo);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les champsContacts depuis la base de données');
		}
		return $pdoStatement;
	}
	
	/**
	 * Récupère le/la champsContact suivant(e) d'un jeu de résultats
	 * @param $pdo PDO 
	 * @param $pdoStatement PDOStatement 
	 * @param $lazyload bool Activer le chargement fainéant ?
	 * @return ChampsContact 
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$lazyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idChampsContact,$libel,$val,$position,$typeChampsContact,$contact,$indestructible) = $values;
		
		// Construire le/la champsContact
		return isset(self::$lazyload[$idChampsContact]) ? self::$lazyload[$idChampsContact] :
		       new ChampsContact($pdo,$idChampsContact,$libel,$val,$position,$typeChampsContact,$contact,$indestructible,$lazyload);
	}
	
	/**
	 * Sérialiser
	 * @param $serialize bool Activer la sérialisation ?
	 * @return string Sérialisation du/de la champsContact
	 */
	public function serialize($serialize=true)
	{
		// Sérialiser le/la champsContact
		$array = array('idChampsContact' => $this->idChampsContact,'libel' => $this->libel,'val' => $this->val,'position' => $this->position,'typeChampsContact' => $this->typeChampsContact,'contact' => $this->contact,'indestructible' => $this->indestructible);
		
		// Retourner la sérialisation (ou pas) du/de la champsContact
		return $serialize ? serialize($array) : $array;
	}
	
	/**
	 * Désérialiser
	 * @param $pdo PDO 
	 * @param $string string Sérialisation du/de la champsContact
	 * @param $lazyload bool Activer le chargement fainéant ?
	 * @return ChampsContact 
	 */
	public static function unserialize(PDO $pdo,$string,$lazyload=true)
	{
		// Désérialiser la chaine de caractères
		$array = unserialize($string);
		
		// Construire le/la champsContact
		return isset(self::$lazyload[$array['idChampsContact']]) ? self::$lazyload[$array['idChampsContact']] :
		       new ChampsContact($pdo,$array['idChampsContact'],$array['libel'],$array['val'],$array['position'],$array['typeChampsContact'],$array['contact'],$array['indestructible'],$lazyload);
	}
	
	/**
	 * Test d'égalité
	 * @param $champsContact ChampsContact 
	 * @return bool Les objets sont-ils égaux ?
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
	 * @return int Nombre de champsContacts
	 */
	public static function count(PDO $pdo)
	{
		if (!($pdoStatement = $pdo->query('SELECT COUNT('.ChampsContact::FIELDNAME_IDCHAMPSCONTACT.') FROM '.ChampsContact::TABLENAME))) {
			throw new Exception('Erreur lors du comptage des champsContacts dans la base de données');
		}
		return $pdoStatement->fetchColumn();
	}
	
	/**
	 * Supprimer le/la champsContact
	 * @return bool Opération réussie ?
	 */
	public function delete()
	{
		// Supprimer le/la champsContact
		$pdoStatement = $this->pdo->prepare('DELETE FROM '.ChampsContact::TABLENAME.' WHERE '.ChampsContact::FIELDNAME_IDCHAMPSCONTACT.' = ?');
		if (!$pdoStatement->execute(array($this->getIdChampsContact()))) {
			throw new Exception('Erreur lors de la suppression d\'un(e) champsContact dans la base de données');
		}
		
		// Opération réussie ?
		return $pdoStatement->rowCount() == 1;
	}
	
	/**
	 * Mettre à jour un champ dans la base de données
	 * @param $fields array 
	 * @param $values array 
	 * @return bool Opération réussie ?
	 */
	protected function _set($fields,$values)
	{
		// Préparer la mise à jour
		$updates = array();
		foreach ($fields as $field) {
			$updates[] = $field.' = ?';
		}
		
		// Mettre à jour le champ
		$pdoStatement = $this->pdo->prepare('UPDATE '.ChampsContact::TABLENAME.' SET '.implode(', ', $updates).' WHERE '.ChampsContact::FIELDNAME_IDCHAMPSCONTACT.' = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdChampsContact())))) {
			throw new Exception('Erreur lors de la mise à jour d\'un champ d\'un(e) champsContact dans la base de données');
		}
		
		// Opération réussie ?
		return $pdoStatement->rowCount() == 1;
	}
	
	/**
	 * Mettre à jour tous les champs dans la base de données
	 * @return bool Opération réussie ?
	 */
	public function update()
	{
		return $this->_set(array(ChampsContact::FIELDNAME_LIBEL,ChampsContact::FIELDNAME_VAL,ChampsContact::FIELDNAME_POSITION,ChampsContact::FIELDNAME_INDESTRUCTIBLE,ChampsContact::FIELDNAME_TYPECHAMPSCONTACT_IDTYPECHAMPSCONTACT,ChampsContact::FIELDNAME_CONTACT_IDCONTACT),array($this->libel,$this->val,$this->position,$this->indestructible,$this->typeChampsContact,$this->contact));
	}
	
	/**
	 * Récupérer le/la idChampsContact
	 * @return int 
	 */
	public function getIdChampsContact()
	{
		return $this->idChampsContact;
	}
	
	/**
	 * Récupérer le/la libel
	 * @return string 
	 */
	public function getLibel()
	{
		return $this->libel;
	}
	
	/**
	 * Définir le/la libel
	 * @param $libel string 
	 * @param $execute bool Exécuter la requête update ?
	 * @return bool Opération réussie ?
	 */
	public function setLibel($libel,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->libel = $libel;
		
		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array(ChampsContact::FIELDNAME_LIBEL),array($libel)) : true;
	}
	
	/**
	 * Récupérer le/la val
	 * @return string 
	 */
	public function getVal()
	{
		return $this->val;
	}
	
	/**
	 * Définir le/la val
	 * @param $val string 
	 * @param $execute bool Exécuter la requête update ?
	 * @return bool Opération réussie ?
	 */
	public function setVal($val,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->val = $val;
		
		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array(ChampsContact::FIELDNAME_VAL),array($val)) : true;
	}
	
	/**
	 * Récupérer le/la position
	 * @return int 
	 */
	public function getPosition()
	{
		return $this->position;
	}
	
	/**
	 * Définir le/la position
	 * @param $position int 
	 * @param $execute bool Exécuter la requête update ?
	 * @return bool Opération réussie ?
	 */
	public function setPosition($position,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->position = $position;
		
		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array(ChampsContact::FIELDNAME_POSITION),array($position)) : true;
	}
	
	/**
	 * Récupérer le/la indestructible
	 * @return bool 
	 */
	public function getIndestructible()
	{
		return $this->indestructible;
	}
	
	/**
	 * Définir le/la indestructible
	 * @param $indestructible bool 
	 * @param $execute bool Exécuter la requête update ?
	 * @return bool Opération réussie ?
	 */
	public function setIndestructible($indestructible,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->indestructible = $indestructible;
		
		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array(ChampsContact::FIELDNAME_INDESTRUCTIBLE),array($indestructible)) : true;
	}
	
	/**
	 * Récupérer le/la typeChampsContact
	 * @return TypeChampsContact 
	 */
	public function getTypeChampsContact()
	{
		return TypeChampsContact::load($this->pdo,$this->typeChampsContact);
	}
	
	/**
	 * Définir le/la typeChampsContact
	 * @param $typeChampsContact TypeChampsContact 
	 * @param $execute bool Exécuter la requête update ?
	 * @return bool Opération réussie ?
	 */
	public function setTypeChampsContact(TypeChampsContact $typeChampsContact,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->typeChampsContact = $typeChampsContact->getIdTypeChampsContact();
		
		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array(ChampsContact::FIELDNAME_TYPECHAMPSCONTACT_IDTYPECHAMPSCONTACT),array($typeChampsContact->getIdTypeChampsContact())) : true;
	}
	
	/**
	 * Sélectionner les champsContacts par typeChampsContact
	 * @param $pdo PDO 
	 * @param $typeChampsContact TypeChampsContact 
	 * @return PDOStatement 
	 */
	public static function selectByTypeChampsContact(PDO $pdo,TypeChampsContact $typeChampsContact)
	{
		$pdoStatement = $pdo->prepare('SELECT '.ChampsContact::FIELDNAME_IDCHAMPSCONTACT.', '.ChampsContact::FIELDNAME_LIBEL.', '.ChampsContact::FIELDNAME_VAL.', '.ChampsContact::FIELDNAME_POSITION.', '.ChampsContact::FIELDNAME_TYPECHAMPSCONTACT_IDTYPECHAMPSCONTACT.', '.ChampsContact::FIELDNAME_CONTACT_IDCONTACT.', '.ChampsContact::FIELDNAME_INDESTRUCTIBLE.' FROM '.ChampsContact::TABLENAME.' WHERE '.ChampsContact::FIELDNAME_TYPECHAMPSCONTACT_IDTYPECHAMPSCONTACT.' = ?');
		if (!$pdoStatement->execute(array($typeChampsContact->getIdTypeChampsContact()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les champsContacts d\'un(e) typeChampsContact depuis la base de données');
		}
		return $pdoStatement;
	}
	
	/**
	 * Récupérer le/la contact
	 * @return Contact 
	 */
	public function getContact()
	{
		return Contact::load($this->pdo,$this->contact);
	}
	
	/**
	 * Définir le/la contact
	 * @param $contact Contact 
	 * @param $execute bool Exécuter la requête update ?
	 * @return bool Opération réussie ?
	 */
	public function setContact(Contact $contact,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->contact = $contact->getIdContact();
		
		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array(ChampsContact::FIELDNAME_CONTACT_IDCONTACT),array($contact->getIdContact())) : true;
	}
	
	/**
	 * Sélectionner les champsContacts par contact
	 * @param $pdo PDO 
	 * @param $contact Contact 
	 * @return PDOStatement 
	 */
	public static function selectByContact(PDO $pdo,Contact $contact)
	{
		$pdoStatement = $pdo->prepare('SELECT '.ChampsContact::FIELDNAME_IDCHAMPSCONTACT.', '.ChampsContact::FIELDNAME_LIBEL.', '.ChampsContact::FIELDNAME_VAL.', '.ChampsContact::FIELDNAME_POSITION.', '.ChampsContact::FIELDNAME_TYPECHAMPSCONTACT_IDTYPECHAMPSCONTACT.', '.ChampsContact::FIELDNAME_CONTACT_IDCONTACT.', '.ChampsContact::FIELDNAME_INDESTRUCTIBLE.' FROM '.ChampsContact::TABLENAME.' WHERE '.ChampsContact::FIELDNAME_CONTACT_IDCONTACT.' = ?');
		if (!$pdoStatement->execute(array($contact->getIdContact()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les champsContacts d\'un(e) contact depuis la base de données');
		}
		return $pdoStatement;
	}
	
	/**
	 * ToString
	 * @return string Représentation de champsContact sous la forme d'un string
	 */
	public function __toString()
	{
		return '[ChampsContact idChampsContact="'.$this->idChampsContact.'" libel="'.$this->libel.'" val="'.$this->val.'" position="'.$this->position.'" indestructible="'.($this->indestructible?'true':'false').'" typeChampsContact="'.$this->typeChampsContact.'" contact="'.$this->contact.'"]';
	}
}

