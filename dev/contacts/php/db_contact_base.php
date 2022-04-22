<?php

/**
 * @name Contact
 * @version 16/10/2012 (dd/mm/yyyy)
 * @author WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
abstract class ContactBase
{
	/** @var PDO  */
	protected $pdo;
	
	/** @var array tableau pour le chargement fainéant */
	protected static $lazyload;
	
	/** @var int  */
	protected $idContact;
	
	/** @var int  */
	protected $dateCreation;
	
	/** @var int id de user */
	protected $user;
	
	/**
	 * Construire un(e) contact
	 * @param $pdo PDO 
	 * @param $idContact int 
	 * @param $dateCreation int 
	 * @param $user int Id de user
	 * @param $lazyload bool Activer le chargement fainéant ?
	 */
	protected function __construct(PDO $pdo,$idContact,$dateCreation,$user,$lazyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;
		
		// Sauvegarder les attributs
		$this->idContact = $idContact;
		$this->dateCreation = $dateCreation;
		$this->user = $user;
		
		// Sauvegarder pour le chargement fainéant
		if ($lazyload) {
			self::$lazyload[$idContact] = $this;
		}
	}
	
	/**
	 * Créer un(e) contact
	 * @param $pdo PDO 
	 * @param $dateCreation int 
	 * @param $user User 
	 * @param $lazyload bool Activer le chargement fainéant ?
	 * @return Contact 
	 */
	public static function create(PDO $pdo,$dateCreation,User $user,$lazyload=true)
	{
		// Ajouter le/la contact dans la base de données
		$pdoStatement = $pdo->prepare('INSERT INTO '.Contact::TABLENAME.' ('.Contact::FIELDNAME_DATECREATION.','.Contact::FIELDNAME_USER_IDUSER.') VALUES (?,?)');
		if (!$pdoStatement->execute(array(date('Y-m-d H:i:s',$dateCreation),$user->getIdUser()))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) contact dans la base de données');
		}
		
		// Construire le/la contact
		return new Contact($pdo,$pdo->lastInsertId(),$dateCreation,$user->getIdUser(),$lazyload);
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
		return $pdo->prepare('SELECT DISTINCT '.Contact::TABLENAME.'.'.Contact::FIELDNAME_IDCONTACT.', '.Contact::TABLENAME.'.'.Contact::FIELDNAME_DATECREATION.', '.Contact::TABLENAME.'.'.Contact::FIELDNAME_USER_IDUSER.' '.
		                     'FROM '.Contact::TABLENAME.($from != null ? ', '.(is_array($from) ? implode(', ',$from) : $from) : '').
		                     ($where != null ? ' WHERE '.(is_array($where) ? implode(' AND ',$where) : $where) : '').
		                     ($orderby != null ? ' ORDER BY '.(is_array($orderby) ? implode(', ',$orderby) : $orderby) : '').
		                     ($limit != null ? ' LIMIT '.(is_array($limit) ? implode(', ', $limit) : $limit) : ''));
	}
	
	/**
	 * Charger un(e) contact
	 * @param $pdo PDO 
	 * @param $idContact int 
	 * @param $lazyload bool Activer le chargement fainéant ?
	 * @return Contact 
	 */
	public static function load(PDO $pdo,$idContact,$lazyload=true)
	{
		// Déjà chargé(e) ?
		if (isset(self::$lazyload[$idContact])) {
			return self::$lazyload[$idContact];
		}
		
		// Charger le/la contact
		$pdoStatement = self::_select($pdo,Contact::FIELDNAME_IDCONTACT.' = ?');
		if (!$pdoStatement->execute(array($idContact))) {
			throw new Exception('Erreur lors du chargement d\'un(e) contact depuis la base de données');
		}
		
		// Récupérer le/la contact depuis le jeu de résultats
		return self::fetch($pdo,$pdoStatement,$lazyload);
	}
	
	/**
	 * Charger tous/toutes les contacts
	 * @param $pdo PDO 
	 * @param $lazyload bool Activer le chargement fainéant ?
	 * @return Contact[] Tableau de contacts
	 */
	public static function loadAll(PDO $pdo,$lazyload=false)
	{
		// Sélectionner tous/toutes les contacts
		$pdoStatement = self::selectAll($pdo);
		
		// Mettre chaque contact dans un tableau
		$contacts = array();
		while ($contact = self::fetch($pdo,$pdoStatement,$lazyload)) {
			$contacts[] = $contact;
		}
		
		// Retourner le tableau
		return $contacts;
	}
	
	/**
	 * Sélectionner tous/toutes les contacts
	 * @param $pdo PDO 
	 * @return PDOStatement 
	 */
	public static function selectAll(PDO $pdo)
	{
		$pdoStatement = self::_select($pdo);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les contacts depuis la base de données');
		}
		return $pdoStatement;
	}
	
	/**
	 * Récupère le/la contact suivant(e) d'un jeu de résultats
	 * @param $pdo PDO 
	 * @param $pdoStatement PDOStatement 
	 * @param $lazyload bool Activer le chargement fainéant ?
	 * @return Contact 
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$lazyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idContact,$dateCreation,$user) = $values;
		
		// Construire le/la contact
		return isset(self::$lazyload[$idContact]) ? self::$lazyload[$idContact] :
		       new Contact($pdo,$idContact,strtotime($dateCreation),$user,$lazyload);
	}
	
	/**
	 * Sérialiser
	 * @param $serialize bool Activer la sérialisation ?
	 * @return string Sérialisation du/de la contact
	 */
	public function serialize($serialize=true)
	{
		// Sérialiser le/la contact
		$array = array('idContact' => $this->idContact,'dateCreation' => $this->dateCreation,'user' => $this->user);
		
		// Retourner la sérialisation (ou pas) du/de la contact
		return $serialize ? serialize($array) : $array;
	}
	
	/**
	 * Désérialiser
	 * @param $pdo PDO 
	 * @param $string string Sérialisation du/de la contact
	 * @param $lazyload bool Activer le chargement fainéant ?
	 * @return Contact 
	 */
	public static function unserialize(PDO $pdo,$string,$lazyload=true)
	{
		// Désérialiser la chaine de caractères
		$array = unserialize($string);
		
		// Construire le/la contact
		return isset(self::$lazyload[$array['idContact']]) ? self::$lazyload[$array['idContact']] :
		       new Contact($pdo,$array['idContact'],$array['dateCreation'],$array['user'],$lazyload);
	}
	
	/**
	 * Test d'égalité
	 * @param $contact Contact 
	 * @return bool Les objets sont-ils égaux ?
	 */
	public function equals($contact)
	{
		// Test si null
		if ($contact == null) { return false; }
		
		// Tester la classe
		if (!($contact instanceof Contact)) { return false; }
		
		// Tester les ids
		return $this->idContact == $contact->idContact;
	}
	
	/**
	 * Compter les contacts
	 * @param $pdo PDO 
	 * @return int Nombre de contacts
	 */
	public static function count(PDO $pdo)
	{
		if (!($pdoStatement = $pdo->query('SELECT COUNT('.Contact::FIELDNAME_IDCONTACT.') FROM '.Contact::TABLENAME))) {
			throw new Exception('Erreur lors du comptage des contacts dans la base de données');
		}
		return $pdoStatement->fetchColumn();
	}
	
	/**
	 * Supprimer le/la contact
	 * @return bool Opération réussie ?
	 */
	public function delete()
	{
		// Supprimer les champsContacts associé(e)s
		$select = $this->selectChampsContacts();
		while ($champsContact = ChampsContact::fetch($this->pdo,$select)) {
			if (!$champsContact->delete()) { return false; }
		}
		
		// Supprimer les CategoryContacts associé(e)s
		$pdoStatement = $this->pdo->prepare('DELETE FROM '.CategoryContact_Contact::TABLENAME.' WHERE '.CategoryContact_Contact::FIELDNAME_CONTACT_IDCONTACT.' = ?');
		if (!$pdoStatement->execute(array($this->getIdContact()))) { return false; }
		
		// Supprimer le/la contact
		$pdoStatement = $this->pdo->prepare('DELETE FROM '.Contact::TABLENAME.' WHERE '.Contact::FIELDNAME_IDCONTACT.' = ?');
		if (!$pdoStatement->execute(array($this->getIdContact()))) {
			throw new Exception('Erreur lors de la suppression d\'un(e) contact dans la base de données');
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
		$pdoStatement = $this->pdo->prepare('UPDATE '.Contact::TABLENAME.' SET '.implode(', ', $updates).' WHERE '.Contact::FIELDNAME_IDCONTACT.' = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdContact())))) {
			throw new Exception('Erreur lors de la mise à jour d\'un champ d\'un(e) contact dans la base de données');
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
		return $this->_set(array(Contact::FIELDNAME_DATECREATION,Contact::FIELDNAME_USER_IDUSER),array(date('Y-m-d H:i:s',$this->dateCreation),$this->user));
	}
	
	/**
	 * Récupérer le/la idContact
	 * @return int 
	 */
	public function getIdContact()
	{
		return $this->idContact;
	}
	
	/**
	 * Récupérer le/la dateCreation
	 * @return int 
	 */
	public function getDateCreation()
	{
		return $this->dateCreation;
	}
	
	/**
	 * Définir le/la dateCreation
	 * @param $dateCreation int 
	 * @param $execute bool Exécuter la requête update ?
	 * @return bool Opération réussie ?
	 */
	public function setDateCreation($dateCreation,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->dateCreation = $dateCreation;
		
		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array(Contact::FIELDNAME_DATECREATION),array(date('Y-m-d H:i:s',$dateCreation))) : true;
	}
	
	/**
	 * Récupérer le/la user
	 * @return User 
	 */
	public function getUser()
	{
		return User::load($this->pdo,$this->user);
	}
	
	/**
	 * Définir le/la user
	 * @param $user User 
	 * @param $execute bool Exécuter la requête update ?
	 * @return bool Opération réussie ?
	 */
	public function setUser(User $user,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->user = $user->getIdUser();
		
		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array(Contact::FIELDNAME_USER_IDUSER),array($user->getIdUser())) : true;
	}
	
	/**
	 * Sélectionner les contacts par user
	 * @param $pdo PDO 
	 * @param $user User 
	 * @return PDOStatement 
	 */
	public static function selectByUser(PDO $pdo,User $user)
	{
		$pdoStatement = $pdo->prepare('SELECT '.Contact::FIELDNAME_IDCONTACT.', '.Contact::FIELDNAME_DATECREATION.', '.Contact::FIELDNAME_USER_IDUSER.' FROM '.Contact::TABLENAME.' WHERE '.Contact::FIELDNAME_USER_IDUSER.' = ?');
		if (!$pdoStatement->execute(array($user->getIdUser()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les contacts d\'un(e) user depuis la base de données');
		}
		return $pdoStatement;
	}
	
	/**
	 * Sélectionner les champsContacts
	 * @return PDOStatement 
	 */
	public function selectChampsContacts()
	{
		return ChampsContact::selectByContact($this->pdo,$this);
	}
	
	/**
	 * Ajouter un(e) a categoryContact
	 * @param $categoryContact CategoryContact 
	 * @return bool Opération réussie ?
	 */
	public function addCategoryContact(CategoryContact $categoryContact)
	{
		$pdoStatement = $this->pdo->prepare('INSERT INTO '.CategoryContact_Contact::TABLENAME.' ('.CategoryContact_Contact::FIELDNAME_CONTACT_IDCONTACT.','.CategoryContact_Contact::FIELDNAME_CATEGORYCONTACT_IDCATEGORYCONTACT.') VALUES (?,?)');
		if (!$pdoStatement->execute(array($this->getIdContact(),$categoryContact->getIdCategoryContact()))) {
			throw new Exception('Erreur lors de l\'ajout d\'un(e) categoryContact à un(e) contact dans la base de données');
		}
		
		return $pdoStatement->rowCount() == 1;
	}
	
	/**
	 * Supprimer un(e) categoryContact
	 * @param $categoryContact CategoryContact 
	 * @return bool Opération réussie ?
	 */
	public function delCategoryContact(CategoryContact $categoryContact)
	{
		$pdoStatement = $this->pdo->prepare('DELETE FROM '.CategoryContact_Contact::TABLENAME.' WHERE '.CategoryContact_Contact::FIELDNAME_CONTACT_IDCONTACT.' = ? AND '.CategoryContact_Contact::FIELDNAME_CATEGORYCONTACT_IDCATEGORYCONTACT.' = ?');
		if (!$pdoStatement->execute(array($this->getIdContact(),$categoryContact->getIdCategoryContact()))) {
			throw new Exception('Erreur lors de la suppression d\'un(e) categoryContact à un(e) contact dans la base de données');
		}
		return $pdoStatement->rowCount() == 1;
	}
	
	/**
	 * Sélectionner les categoryContacts
	 * @return PDOStatement 
	 */
	public function selectCategoryContacts()
	{
		return CategoryContact::selectByContact($this->pdo,$this);
	}
	
	/**
	 * Sélectionner les contacts par categoryContact
	 * @param $pdo PDO 
	 * @param $categoryContact CategoryContact 
	 * @return PDOStatement 
	 */
	public static function selectByCategoryContact(PDO $pdo,CategoryContact $categoryContact)
	{
		$pdoStatement = $pdo->prepare('SELECT '.Contact::TABLENAME.'.'.Contact::FIELDNAME_IDCONTACT.', '.Contact::TABLENAME.'.'.Contact::FIELDNAME_DATECREATION.', '.Contact::TABLENAME.'.'.Contact::FIELDNAME_USER_IDUSER.' FROM '.Contact::TABLENAME.', '.CategoryContact_Contact::TABLENAME.' WHERE '.CategoryContact_Contact::TABLENAME.'.'.CategoryContact_Contact::FIELDNAME_CATEGORYCONTACT_IDCATEGORYCONTACT.' = ? AND '.CategoryContact_Contact::TABLENAME.'.'.CategoryContact_Contact::FIELDNAME_CONTACT_IDCONTACT.' = '.Contact::TABLENAME.'.'.Contact::FIELDNAME_IDCONTACT);
		if (!$pdoStatement->execute(array($categoryContact->getIdCategoryContact()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les contacts d\'un(e) categoryContact depuis la base de données');
		}
		return $pdoStatement;
	}
	
	/**
	 * ToString
	 * @return string Représentation de contact sous la forme d'un string
	 */
	public function __toString()
	{
		return '[Contact idContact="'.$this->idContact.'" dateCreation="'.date('d/m/Y H:i:s',$this->dateCreation).'" user="'.$this->user.'"]';
	}
}

