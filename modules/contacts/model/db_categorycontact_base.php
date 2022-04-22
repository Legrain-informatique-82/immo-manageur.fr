<?php

/**
 * @name CategoryContact
 * @version 16/10/2012 (dd/mm/yyyy)
 * @author WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
abstract class CategoryContactBase
{
	/** @var PDO  */
	protected $pdo;
	
	/** @var array tableau pour le chargement fainéant */
	protected static $lazyload;
	
	/** @var int  */
	protected $idCategoryContact;
	
	/** @var string  */
	protected $name;
	
	/**
	 * Construire un(e) categoryContact
	 * @param $pdo PDO 
	 * @param $idCategoryContact int 
	 * @param $name string 
	 * @param $lazyload bool Activer le chargement fainéant ?
	 */
	protected function __construct(PDO $pdo,$idCategoryContact,$name,$lazyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;
		
		// Sauvegarder les attributs
		$this->idCategoryContact = $idCategoryContact;
		$this->name = $name;
		
		// Sauvegarder pour le chargement fainéant
		if ($lazyload) {
			self::$lazyload[$idCategoryContact] = $this;
		}
	}
	
	/**
	 * Créer un(e) categoryContact
	 * @param $pdo PDO 
	 * @param $name string 
	 * @param $lazyload bool Activer le chargement fainéant ?
	 * @return CategoryContact 
	 */
	public static function create(PDO $pdo,$name,$lazyload=true)
	{
		// Ajouter le/la categoryContact dans la base de données
		$pdoStatement = $pdo->prepare('INSERT INTO '.CategoryContact::TABLENAME.' ('.CategoryContact::FIELDNAME_NAME.') VALUES (?)');
		if (!$pdoStatement->execute(array($name))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) categoryContact dans la base de données');
		}
		
		// Construire le/la categoryContact
		return new CategoryContact($pdo,$pdo->lastInsertId(),$name,$lazyload);
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
		return $pdo->prepare('SELECT DISTINCT '.CategoryContact::TABLENAME.'.'.CategoryContact::FIELDNAME_IDCATEGORYCONTACT.', '.CategoryContact::TABLENAME.'.'.CategoryContact::FIELDNAME_NAME.' '.
		                     'FROM '.CategoryContact::TABLENAME.($from != null ? ', '.(is_array($from) ? implode(', ',$from) : $from) : '').
		                     ($where != null ? ' WHERE '.(is_array($where) ? implode(' AND ',$where) : $where) : '').
		                     ($orderby != null ? ' ORDER BY '.(is_array($orderby) ? implode(', ',$orderby) : $orderby) : '').
		                     ($limit != null ? ' LIMIT '.(is_array($limit) ? implode(', ', $limit) : $limit) : ''));
	}
	
	/**
	 * Charger un(e) categoryContact
	 * @param $pdo PDO 
	 * @param $idCategoryContact int 
	 * @param $lazyload bool Activer le chargement fainéant ?
	 * @return CategoryContact 
	 */
	public static function load(PDO $pdo,$idCategoryContact,$lazyload=true)
	{
		// Déjà chargé(e) ?
		if (isset(self::$lazyload[$idCategoryContact])) {
			return self::$lazyload[$idCategoryContact];
		}
		
		// Charger le/la categoryContact
		$pdoStatement = self::_select($pdo,CategoryContact::FIELDNAME_IDCATEGORYCONTACT.' = ?');
		if (!$pdoStatement->execute(array($idCategoryContact))) {
			throw new Exception('Erreur lors du chargement d\'un(e) categoryContact depuis la base de données');
		}
		
		// Récupérer le/la categoryContact depuis le jeu de résultats
		return self::fetch($pdo,$pdoStatement,$lazyload);
	}
	
	/**
	 * Charger tous/toutes les categoryContacts
	 * @param $pdo PDO 
	 * @param $lazyload bool Activer le chargement fainéant ?
	 * @return CategoryContact[] Tableau de categoryContacts
	 */
	public static function loadAll(PDO $pdo,$lazyload=false)
	{
		// Sélectionner tous/toutes les categoryContacts
		$pdoStatement = self::selectAll($pdo);
		
		// Mettre chaque categoryContact dans un tableau
		$categoryContacts = array();
		while ($categoryContact = self::fetch($pdo,$pdoStatement,$lazyload)) {
			$categoryContacts[] = $categoryContact;
		}
		
		// Retourner le tableau
		return $categoryContacts;
	}
	
	/**
	 * Sélectionner tous/toutes les categoryContacts
	 * @param $pdo PDO 
	 * @return PDOStatement 
	 */
	public static function selectAll(PDO $pdo)
	{
		$pdoStatement = self::_select($pdo);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les categoryContacts depuis la base de données');
		}
		return $pdoStatement;
	}
	
	/**
	 * Récupère le/la categoryContact suivant(e) d'un jeu de résultats
	 * @param $pdo PDO 
	 * @param $pdoStatement PDOStatement 
	 * @param $lazyload bool Activer le chargement fainéant ?
	 * @return CategoryContact 
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$lazyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idCategoryContact,$name) = $values;
		
		// Construire le/la categoryContact
		return isset(self::$lazyload[$idCategoryContact]) ? self::$lazyload[$idCategoryContact] :
		       new CategoryContact($pdo,$idCategoryContact,$name,$lazyload);
	}
	
	/**
	 * Sérialiser
	 * @param $serialize bool Activer la sérialisation ?
	 * @return string Sérialisation du/de la categoryContact
	 */
	public function serialize($serialize=true)
	{
		// Sérialiser le/la categoryContact
		$array = array('idCategoryContact' => $this->idCategoryContact,'name' => $this->name);
		
		// Retourner la sérialisation (ou pas) du/de la categoryContact
		return $serialize ? serialize($array) : $array;
	}
	
	/**
	 * Désérialiser
	 * @param $pdo PDO 
	 * @param $string string Sérialisation du/de la categoryContact
	 * @param $lazyload bool Activer le chargement fainéant ?
	 * @return CategoryContact 
	 */
	public static function unserialize(PDO $pdo,$string,$lazyload=true)
	{
		// Désérialiser la chaine de caractères
		$array = unserialize($string);
		
		// Construire le/la categoryContact
		return isset(self::$lazyload[$array['idCategoryContact']]) ? self::$lazyload[$array['idCategoryContact']] :
		       new CategoryContact($pdo,$array['idCategoryContact'],$array['name'],$lazyload);
	}
	
	/**
	 * Test d'égalité
	 * @param $categoryContact CategoryContact 
	 * @return bool Les objets sont-ils égaux ?
	 */
	public function equals($categoryContact)
	{
		// Test si null
		if ($categoryContact == null) { return false; }
		
		// Tester la classe
		if (!($categoryContact instanceof CategoryContact)) { return false; }
		
		// Tester les ids
		return $this->idCategoryContact == $categoryContact->idCategoryContact;
	}
	
	/**
	 * Compter les categoryContacts
	 * @param $pdo PDO 
	 * @return int Nombre de categoryContacts
	 */
	public static function count(PDO $pdo)
	{
		if (!($pdoStatement = $pdo->query('SELECT COUNT('.CategoryContact::FIELDNAME_IDCATEGORYCONTACT.') FROM '.CategoryContact::TABLENAME))) {
			throw new Exception('Erreur lors du comptage des categoryContacts dans la base de données');
		}
		return $pdoStatement->fetchColumn();
	}
	
	/**
	 * Supprimer le/la categoryContact
	 * @return bool Opération réussie ?
	 */
	public function delete()
	{
		// Supprimer les Contacts associé(e)s
		$pdoStatement = $this->pdo->prepare('DELETE FROM '.CategoryContact_Contact::TABLENAME.' WHERE '.CategoryContact_Contact::FIELDNAME_CATEGORYCONTACT_IDCATEGORYCONTACT.' = ?');
		if (!$pdoStatement->execute(array($this->getIdCategoryContact()))) { return false; }
		
		// Supprimer le/la categoryContact
		$pdoStatement = $this->pdo->prepare('DELETE FROM '.CategoryContact::TABLENAME.' WHERE '.CategoryContact::FIELDNAME_IDCATEGORYCONTACT.' = ?');
		if (!$pdoStatement->execute(array($this->getIdCategoryContact()))) {
			throw new Exception('Erreur lors de la suppression d\'un(e) categoryContact dans la base de données');
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
		$pdoStatement = $this->pdo->prepare('UPDATE '.CategoryContact::TABLENAME.' SET '.implode(', ', $updates).' WHERE '.CategoryContact::FIELDNAME_IDCATEGORYCONTACT.' = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdCategoryContact())))) {
			throw new Exception('Erreur lors de la mise à jour d\'un champ d\'un(e) categoryContact dans la base de données');
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
		return $this->_set(array(CategoryContact::FIELDNAME_NAME),array($this->name));
	}
	
	/**
	 * Récupérer le/la idCategoryContact
	 * @return int 
	 */
	public function getIdCategoryContact()
	{
		return $this->idCategoryContact;
	}
	
	/**
	 * Récupérer le/la name
	 * @return string 
	 */
	public function getName()
	{
		return $this->name;
	}
	
	/**
	 * Définir le/la name
	 * @param $name string 
	 * @param $execute bool Exécuter la requête update ?
	 * @return bool Opération réussie ?
	 */
	public function setName($name,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->name = $name;
		
		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array(CategoryContact::FIELDNAME_NAME),array($name)) : true;
	}
	
	/**
	 * Ajouter un(e) a contact
	 * @param $contact Contact 
	 * @return bool Opération réussie ?
	 */
	public function addContact(Contact $contact)
	{
		$pdoStatement = $this->pdo->prepare('INSERT INTO '.CategoryContact_Contact::TABLENAME.' ('.CategoryContact_Contact::FIELDNAME_CATEGORYCONTACT_IDCATEGORYCONTACT.','.CategoryContact_Contact::FIELDNAME_CONTACT_IDCONTACT.') VALUES (?,?)');
		if (!$pdoStatement->execute(array($this->getIdCategoryContact(),$contact->getIdContact()))) {
			throw new Exception('Erreur lors de l\'ajout d\'un(e) contact à un(e) categoryContact dans la base de données');
		}
		
		return $pdoStatement->rowCount() == 1;
	}
	
	/**
	 * Supprimer un(e) contact
	 * @param $contact Contact 
	 * @return bool Opération réussie ?
	 */
	public function delContact(Contact $contact)
	{
		$pdoStatement = $this->pdo->prepare('DELETE FROM '.CategoryContact_Contact::TABLENAME.' WHERE '.CategoryContact_Contact::FIELDNAME_CATEGORYCONTACT_IDCATEGORYCONTACT.' = ? AND '.CategoryContact_Contact::FIELDNAME_CONTACT_IDCONTACT.' = ?');
		if (!$pdoStatement->execute(array($this->getIdCategoryContact(),$contact->getIdContact()))) {
			throw new Exception('Erreur lors de la suppression d\'un(e) contact à un(e) categoryContact dans la base de données');
		}
		return $pdoStatement->rowCount() == 1;
	}
	
	/**
	 * Sélectionner les contacts
	 * @return PDOStatement 
	 */
	public function selectContacts()
	{
		return Contact::selectByCategoryContact($this->pdo,$this);
	}
	
	/**
	 * Sélectionner les categoryContacts par contact
	 * @param $pdo PDO 
	 * @param $contact Contact 
	 * @return PDOStatement 
	 */
	public static function selectByContact(PDO $pdo,Contact $contact)
	{
		$pdoStatement = $pdo->prepare('SELECT '.CategoryContact::TABLENAME.'.'.CategoryContact::FIELDNAME_IDCATEGORYCONTACT.', '.CategoryContact::TABLENAME.'.'.CategoryContact::FIELDNAME_NAME.' FROM '.CategoryContact::TABLENAME.', '.CategoryContact_Contact::TABLENAME.' WHERE '.CategoryContact_Contact::TABLENAME.'.'.CategoryContact_Contact::FIELDNAME_CONTACT_IDCONTACT.' = ? AND '.CategoryContact_Contact::TABLENAME.'.'.CategoryContact_Contact::FIELDNAME_CATEGORYCONTACT_IDCATEGORYCONTACT.' = '.CategoryContact::TABLENAME.'.'.CategoryContact::FIELDNAME_IDCATEGORYCONTACT);
		if (!$pdoStatement->execute(array($contact->getIdContact()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les categoryContacts d\'un(e) contact depuis la base de données');
		}
		return $pdoStatement;
	}
	
	/**
	 * ToString
	 * @return string Représentation de categoryContact sous la forme d'un string
	 */
	public function __toString()
	{
		return '[CategoryContact idCategoryContact="'.$this->idCategoryContact.'" name="'.$this->name.'"]';
	}
}

