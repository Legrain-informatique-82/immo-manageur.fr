<?php

/**
 * @name NotaryClerk
 * @version 17/10/2012 (dd/mm/yyyy)
 * @author WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
abstract class NotaryClerkBase
{
	// Nom de la table
	const TABLENAME = 'notaryclerk';
	
	// Nom des champs
	const FIELDNAME_IDNOTARYCLERK = 'idnotaryclerk';
	const FIELDNAME_NAME = 'name';
	const FIELDNAME_FIRSTNAME = 'firstname';
	const FIELDNAME_ADDRESS = 'address';
	const FIELDNAME_CITY = 'city';
	const FIELDNAME_ZIPCODE = 'zipcode';
	const FIELDNAME_PHONE = 'phone';
	const FIELDNAME_MOBILPHONE = 'mobilphone';
	const FIELDNAME_JOBPHONE = 'jobphone';
	const FIELDNAME_FAX = 'fax';
	const FIELDNAME_EMAIL = 'email';
	const FIELDNAME_COMMENTS = 'comments';
	const FIELDNAME_NUMBERUSED = 'numberused';
	const FIELDNAME_NOTARY_IDNOTARY = 'notary_idnotary';
	
	/** @var PDO  */
	protected $pdo;
	
	/** @var array tableau pour le chargement fainéant */
	protected static $lazyload;
	
	/** @var int  */
	protected $idNotaryClerk;
	
	/** @var string  */
	protected $name;
	
	/** @var string  */
	protected $firstname;
	
	/** @var string  */
	protected $address;
	
	/** @var string  */
	protected $city;
	
	/** @var string  */
	protected $zipCode;
	
	/** @var string  */
	protected $phone;
	
	/** @var string  */
	protected $mobilPhone;
	
	/** @var string  */
	protected $jobPhone;
	
	/** @var string  */
	protected $fax;
	
	/** @var string  */
	protected $email;
	
	/** @var string  */
	protected $comments;
	
	/** @var int  */
	protected $numberUsed;
	
	/** @var int id de notary */
	protected $notary;
	
	/**
	 * Construire un(e) notaryClerk
	 * @param $pdo PDO 
	 * @param $idNotaryClerk int 
	 * @param $name string 
	 * @param $firstname string 
	 * @param $address string 
	 * @param $city string 
	 * @param $zipCode string 
	 * @param $phone string 
	 * @param $mobilPhone string 
	 * @param $jobPhone string 
	 * @param $fax string 
	 * @param $email string 
	 * @param $comments string 
	 * @param $numberUsed int 
	 * @param $notary int Id de notary
	 * @param $lazyload bool Activer le chargement fainéant ?
	 */
	protected function __construct(PDO $pdo,$idNotaryClerk,$name,$firstname,$address,$city,$zipCode,$phone,$mobilPhone,$jobPhone,$fax,$email,$comments,$numberUsed,$notary,$lazyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;
		
		// Sauvegarder les attributs
		$this->idNotaryClerk = $idNotaryClerk;
		$this->name = $name;
		$this->firstname = $firstname;
		$this->address = $address;
		$this->city = $city;
		$this->zipCode = $zipCode;
		$this->phone = $phone;
		$this->mobilPhone = $mobilPhone;
		$this->jobPhone = $jobPhone;
		$this->fax = $fax;
		$this->email = $email;
		$this->comments = $comments;
		$this->numberUsed = $numberUsed;
		$this->notary = $notary;
		
		// Sauvegarder pour le chargement fainéant
		if ($lazyload) {
			self::$lazyload[$idNotaryClerk] = $this;
		}
	}
	
	/**
	 * Créer un(e) notaryClerk
	 * @param $pdo PDO 
	 * @param $name string 
	 * @param $firstname string 
	 * @param $address string 
	 * @param $city string 
	 * @param $zipCode string 
	 * @param $phone string 
	 * @param $mobilPhone string 
	 * @param $jobPhone string 
	 * @param $fax string 
	 * @param $email string 
	 * @param $comments string 
	 * @param $numberUsed int 
	 * @param $notary Notary 
	 * @param $lazyload bool Activer le chargement fainéant ?
	 * @return NotaryClerk 
	 */
	public static function create(PDO $pdo,$name,$firstname,$address,$city,$zipCode,$phone,$mobilPhone,$jobPhone,$fax,$email,$comments,$numberUsed,Notary $notary,$lazyload=true)
	{
		// Ajouter le/la notaryClerk dans la base de données
		$pdoStatement = $pdo->prepare('INSERT INTO '.NotaryClerk::TABLENAME.' ('.NotaryClerk::FIELDNAME_NAME.','.NotaryClerk::FIELDNAME_FIRSTNAME.','.NotaryClerk::FIELDNAME_ADDRESS.','.NotaryClerk::FIELDNAME_CITY.','.NotaryClerk::FIELDNAME_ZIPCODE.','.NotaryClerk::FIELDNAME_PHONE.','.NotaryClerk::FIELDNAME_MOBILPHONE.','.NotaryClerk::FIELDNAME_JOBPHONE.','.NotaryClerk::FIELDNAME_FAX.','.NotaryClerk::FIELDNAME_EMAIL.','.NotaryClerk::FIELDNAME_COMMENTS.','.NotaryClerk::FIELDNAME_NUMBERUSED.','.NotaryClerk::FIELDNAME_NOTARY_IDNOTARY.') VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)');
		if (!$pdoStatement->execute(array($name,$firstname,$address,$city,$zipCode,$phone,$mobilPhone,$jobPhone,$fax,$email,$comments,$numberUsed,$notary->getIdNotary()))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) notaryClerk dans la base de données');
		}
		
		// Construire le/la notaryClerk
		return new NotaryClerk($pdo,$pdo->lastInsertId(),$name,$firstname,$address,$city,$zipCode,$phone,$mobilPhone,$jobPhone,$fax,$email,$comments,$numberUsed,$notary->getIdNotary(),$lazyload);
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
		return $pdo->prepare('SELECT DISTINCT '.NotaryClerk::TABLENAME.'.'.NotaryClerk::FIELDNAME_IDNOTARYCLERK.', '.NotaryClerk::TABLENAME.'.'.NotaryClerk::FIELDNAME_NAME.', '.NotaryClerk::TABLENAME.'.'.NotaryClerk::FIELDNAME_FIRSTNAME.', '.NotaryClerk::TABLENAME.'.'.NotaryClerk::FIELDNAME_ADDRESS.', '.NotaryClerk::TABLENAME.'.'.NotaryClerk::FIELDNAME_CITY.', '.NotaryClerk::TABLENAME.'.'.NotaryClerk::FIELDNAME_ZIPCODE.', '.NotaryClerk::TABLENAME.'.'.NotaryClerk::FIELDNAME_PHONE.', '.NotaryClerk::TABLENAME.'.'.NotaryClerk::FIELDNAME_MOBILPHONE.', '.NotaryClerk::TABLENAME.'.'.NotaryClerk::FIELDNAME_JOBPHONE.', '.NotaryClerk::TABLENAME.'.'.NotaryClerk::FIELDNAME_FAX.', '.NotaryClerk::TABLENAME.'.'.NotaryClerk::FIELDNAME_EMAIL.', '.NotaryClerk::TABLENAME.'.'.NotaryClerk::FIELDNAME_COMMENTS.', '.NotaryClerk::TABLENAME.'.'.NotaryClerk::FIELDNAME_NUMBERUSED.', '.NotaryClerk::TABLENAME.'.'.NotaryClerk::FIELDNAME_NOTARY_IDNOTARY.' '.
		                     'FROM '.NotaryClerk::TABLENAME.($from != null ? ', '.(is_array($from) ? implode(', ',$from) : $from) : '').
		                     ($where != null ? ' WHERE '.(is_array($where) ? implode(' AND ',$where) : $where) : '').
		                     ($orderby != null ? ' ORDER BY '.(is_array($orderby) ? implode(', ',$orderby) : $orderby) : '').
		                     ($limit != null ? ' LIMIT '.(is_array($limit) ? implode(', ', $limit) : $limit) : ''));
	}
	
	/**
	 * Charger un(e) notaryClerk
	 * @param $pdo PDO 
	 * @param $idNotaryClerk int 
	 * @param $lazyload bool Activer le chargement fainéant ?
	 * @return NotaryClerk 
	 */
	public static function load(PDO $pdo,$idNotaryClerk,$lazyload=true)
	{
		// Déjà chargé(e) ?
		if (isset(self::$lazyload[$idNotaryClerk])) {
			return self::$lazyload[$idNotaryClerk];
		}
		
		// Charger le/la notaryClerk
		$pdoStatement = self::_select($pdo,NotaryClerk::FIELDNAME_IDNOTARYCLERK.' = ?');
		if (!$pdoStatement->execute(array($idNotaryClerk))) {
			throw new Exception('Erreur lors du chargement d\'un(e) notaryClerk depuis la base de données');
		}
		
		// Récupérer le/la notaryClerk depuis le jeu de résultats
		return self::fetch($pdo,$pdoStatement,$lazyload);
	}
	
	/**
	 * Charger tous/toutes les notaryClerks
	 * @param $pdo PDO 
	 * @param $lazyload bool Activer le chargement fainéant ?
	 * @return NotaryClerk[] Tableau de notaryClerks
	 */
	public static function loadAll(PDO $pdo,$lazyload=false)
	{
		// Sélectionner tous/toutes les notaryClerks
		$pdoStatement = self::selectAll($pdo);
		
		// Récupèrer tous/toutes les notaryClerks
		$notaryClerks = self::fetchAll($pdo,$pdoStatement,$lazyload);
		
		// Retourner le tableau
		return $notaryClerks;
	}
	
	/**
	 * Sélectionner tous/toutes les notaryClerks
	 * @param $pdo PDO 
	 * @return PDOStatement 
	 */
	public static function selectAll(PDO $pdo)
	{
		$pdoStatement = self::_select($pdo);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les notaryClerks depuis la base de données');
		}
		return $pdoStatement;
	}
	
	/**
	 * Récupèrer le/la notaryClerk suivant(e) d'un jeu de résultats
	 * @param $pdo PDO 
	 * @param $pdoStatement PDOStatement 
	 * @param $lazyload bool Activer le chargement fainéant ?
	 * @return NotaryClerk 
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$lazyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idNotaryClerk,$name,$firstname,$address,$city,$zipCode,$phone,$mobilPhone,$jobPhone,$fax,$email,$comments,$numberUsed,$notary) = $values;
		
		// Construire le/la notaryClerk
		return isset(self::$lazyload[$idNotaryClerk]) ? self::$lazyload[$idNotaryClerk] :
		       new NotaryClerk($pdo,$idNotaryClerk,$name,$firstname,$address,$city,$zipCode,$phone,$mobilPhone,$jobPhone,$fax,$email,$comments,$numberUsed,$notary,$lazyload);
	}
	
	/**
	 * Récupèrer tous/toutes les notaryClerks d'un jeu de résultats
	 * @param $pdo PDO 
	 * @param $pdoStatement PDOStatement 
	 * @param $lazyload bool Activer le chargement fainéant ?
	 * @return NotaryClerk[] Tableau de notaryClerks
	 */
	public static function fetchAll(PDO $pdo,PDOStatement $pdoStatement,$lazyload=false)
	{
		$notaryClerks = array();
		while ($notaryClerk = self::fetch($pdo,$pdoStatement,$lazyload)) {
			$notaryClerks[] = $notaryClerk;
		}
		return $notaryClerks;
	}
	
	/**
	 * Sérialiser
	 * @param $serialize bool Activer la sérialisation ?
	 * @return string Sérialisation du/de la notaryClerk
	 */
	public function serialize($serialize=true)
	{
		// Sérialiser le/la notaryClerk
		$array = array('idNotaryClerk' => $this->idNotaryClerk,'name' => $this->name,'firstname' => $this->firstname,'address' => $this->address,'city' => $this->city,'zipCode' => $this->zipCode,'phone' => $this->phone,'mobilPhone' => $this->mobilPhone,'jobPhone' => $this->jobPhone,'fax' => $this->fax,'email' => $this->email,'comments' => $this->comments,'numberUsed' => $this->numberUsed,'notary' => $this->notary);
		
		// Retourner la sérialisation (ou pas) du/de la notaryClerk
		return $serialize ? serialize($array) : $array;
	}
	
	/**
	 * Désérialiser
	 * @param $pdo PDO 
	 * @param $string string Sérialisation du/de la notaryClerk
	 * @param $lazyload bool Activer le chargement fainéant ?
	 * @return NotaryClerk 
	 */
	public static function unserialize(PDO $pdo,$string,$lazyload=true)
	{
		// Désérialiser la chaine de caractères
		$array = unserialize($string);
		
		// Construire le/la notaryClerk
		return isset(self::$lazyload[$array['idNotaryClerk']]) ? self::$lazyload[$array['idNotaryClerk']] :
		       new NotaryClerk($pdo,$array['idNotaryClerk'],$array['name'],$array['firstname'],$array['address'],$array['city'],$array['zipCode'],$array['phone'],$array['mobilPhone'],$array['jobPhone'],$array['fax'],$array['email'],$array['comments'],$array['numberUsed'],$array['notary'],$lazyload);
	}
	
	/**
	 * Test d'égalité
	 * @param $notaryClerk NotaryClerk 
	 * @return bool Les objets sont-ils égaux ?
	 */
	public function equals($notaryClerk)
	{
		// Test si null
		if ($notaryClerk == null) { return false; }
		
		// Tester la classe
		if (!($notaryClerk instanceof NotaryClerk)) { return false; }
		
		// Tester les ids
		return $this->idNotaryClerk == $notaryClerk->idNotaryClerk;
	}
	
	/**
	 * Compter les notaryClerks
	 * @param $pdo PDO 
	 * @return int Nombre de notaryClerks
	 */
	public static function count(PDO $pdo)
	{
		if (!($pdoStatement = $pdo->query('SELECT COUNT('.NotaryClerk::FIELDNAME_IDNOTARYCLERK.') FROM '.NotaryClerk::TABLENAME))) {
			throw new Exception('Erreur lors du comptage des notaryClerks dans la base de données');
		}
		return $pdoStatement->fetchColumn();
	}
	
	/**
	 * Supprimer le/la notaryClerk
	 * @return bool Opération réussie ?
	 */
	public function delete()
	{
		// Supprimer le/la notaryClerk
		$pdoStatement = $this->pdo->prepare('DELETE FROM '.NotaryClerk::TABLENAME.' WHERE '.NotaryClerk::FIELDNAME_IDNOTARYCLERK.' = ?');
		if (!$pdoStatement->execute(array($this->getIdNotaryClerk()))) {
			throw new Exception('Erreur lors de la suppression d\'un(e) notaryClerk dans la base de données');
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
		$pdoStatement = $this->pdo->prepare('UPDATE '.NotaryClerk::TABLENAME.' SET '.implode(', ', $updates).' WHERE '.NotaryClerk::FIELDNAME_IDNOTARYCLERK.' = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdNotaryClerk())))) {
			throw new Exception('Erreur lors de la mise à jour d\'un champ d\'un(e) notaryClerk dans la base de données');
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
		return $this->_set(array(NotaryClerk::FIELDNAME_NAME,NotaryClerk::FIELDNAME_FIRSTNAME,NotaryClerk::FIELDNAME_ADDRESS,NotaryClerk::FIELDNAME_CITY,NotaryClerk::FIELDNAME_ZIPCODE,NotaryClerk::FIELDNAME_PHONE,NotaryClerk::FIELDNAME_MOBILPHONE,NotaryClerk::FIELDNAME_JOBPHONE,NotaryClerk::FIELDNAME_FAX,NotaryClerk::FIELDNAME_EMAIL,NotaryClerk::FIELDNAME_COMMENTS,NotaryClerk::FIELDNAME_NUMBERUSED,NotaryClerk::FIELDNAME_NOTARY_IDNOTARY),array($this->name,$this->firstname,$this->address,$this->city,$this->zipCode,$this->phone,$this->mobilPhone,$this->jobPhone,$this->fax,$this->email,$this->comments,$this->numberUsed,$this->notary));
	}
	
	/**
	 * Récupérer le/la idNotaryClerk
	 * @return int 
	 */
	public function getIdNotaryClerk()
	{
		return $this->idNotaryClerk;
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
		return $execute ? $this->_set(array(NotaryClerk::FIELDNAME_NAME),array($name)) : true;
	}
	
	/**
	 * Récupérer le/la firstname
	 * @return string 
	 */
	public function getFirstname()
	{
		return $this->firstname;
	}
	
	/**
	 * Définir le/la firstname
	 * @param $firstname string 
	 * @param $execute bool Exécuter la requête update ?
	 * @return bool Opération réussie ?
	 */
	public function setFirstname($firstname,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->firstname = $firstname;
		
		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array(NotaryClerk::FIELDNAME_FIRSTNAME),array($firstname)) : true;
	}
	
	/**
	 * Récupérer le/la address
	 * @return string 
	 */
	public function getAddress()
	{
		return $this->address;
	}
	
	/**
	 * Définir le/la address
	 * @param $address string 
	 * @param $execute bool Exécuter la requête update ?
	 * @return bool Opération réussie ?
	 */
	public function setAddress($address,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->address = $address;
		
		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array(NotaryClerk::FIELDNAME_ADDRESS),array($address)) : true;
	}
	
	/**
	 * Récupérer le/la city
	 * @return string 
	 */
	public function getCity()
	{
		return $this->city;
	}
	
	/**
	 * Définir le/la city
	 * @param $city string 
	 * @param $execute bool Exécuter la requête update ?
	 * @return bool Opération réussie ?
	 */
	public function setCity($city,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->city = $city;
		
		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array(NotaryClerk::FIELDNAME_CITY),array($city)) : true;
	}
	
	/**
	 * Récupérer le/la zipCode
	 * @return string 
	 */
	public function getZipCode()
	{
		return $this->zipCode;
	}
	
	/**
	 * Définir le/la zipCode
	 * @param $zipCode string 
	 * @param $execute bool Exécuter la requête update ?
	 * @return bool Opération réussie ?
	 */
	public function setZipCode($zipCode,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->zipCode = $zipCode;
		
		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array(NotaryClerk::FIELDNAME_ZIPCODE),array($zipCode)) : true;
	}
	
	/**
	 * Récupérer le/la phone
	 * @return string 
	 */
	public function getPhone()
	{
		return $this->phone;
	}
	
	/**
	 * Définir le/la phone
	 * @param $phone string 
	 * @param $execute bool Exécuter la requête update ?
	 * @return bool Opération réussie ?
	 */
	public function setPhone($phone,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->phone = $phone;
		
		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array(NotaryClerk::FIELDNAME_PHONE),array($phone)) : true;
	}
	
	/**
	 * Récupérer le/la mobilPhone
	 * @return string 
	 */
	public function getMobilPhone()
	{
		return $this->mobilPhone;
	}
	
	/**
	 * Définir le/la mobilPhone
	 * @param $mobilPhone string 
	 * @param $execute bool Exécuter la requête update ?
	 * @return bool Opération réussie ?
	 */
	public function setMobilPhone($mobilPhone,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->mobilPhone = $mobilPhone;
		
		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array(NotaryClerk::FIELDNAME_MOBILPHONE),array($mobilPhone)) : true;
	}
	
	/**
	 * Récupérer le/la jobPhone
	 * @return string 
	 */
	public function getJobPhone()
	{
		return $this->jobPhone;
	}
	
	/**
	 * Définir le/la jobPhone
	 * @param $jobPhone string 
	 * @param $execute bool Exécuter la requête update ?
	 * @return bool Opération réussie ?
	 */
	public function setJobPhone($jobPhone,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->jobPhone = $jobPhone;
		
		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array(NotaryClerk::FIELDNAME_JOBPHONE),array($jobPhone)) : true;
	}
	
	/**
	 * Récupérer le/la fax
	 * @return string 
	 */
	public function getFax()
	{
		return $this->fax;
	}
	
	/**
	 * Définir le/la fax
	 * @param $fax string 
	 * @param $execute bool Exécuter la requête update ?
	 * @return bool Opération réussie ?
	 */
	public function setFax($fax,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->fax = $fax;
		
		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array(NotaryClerk::FIELDNAME_FAX),array($fax)) : true;
	}
	
	/**
	 * Récupérer le/la email
	 * @return string 
	 */
	public function getEmail()
	{
		return $this->email;
	}
	
	/**
	 * Définir le/la email
	 * @param $email string 
	 * @param $execute bool Exécuter la requête update ?
	 * @return bool Opération réussie ?
	 */
	public function setEmail($email,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->email = $email;
		
		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array(NotaryClerk::FIELDNAME_EMAIL),array($email)) : true;
	}
	
	/**
	 * Récupérer le/la comments
	 * @return string 
	 */
	public function getComments()
	{
		return $this->comments;
	}
	
	/**
	 * Définir le/la comments
	 * @param $comments string 
	 * @param $execute bool Exécuter la requête update ?
	 * @return bool Opération réussie ?
	 */
	public function setComments($comments,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->comments = $comments;
		
		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array(NotaryClerk::FIELDNAME_COMMENTS),array($comments)) : true;
	}
	
	/**
	 * Récupérer le/la numberUsed
	 * @return int 
	 */
	public function getNumberUsed()
	{
		return $this->numberUsed;
	}
	
	/**
	 * Définir le/la numberUsed
	 * @param $numberUsed int 
	 * @param $execute bool Exécuter la requête update ?
	 * @return bool Opération réussie ?
	 */
	public function setNumberUsed($numberUsed,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->numberUsed = $numberUsed;
		
		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array(NotaryClerk::FIELDNAME_NUMBERUSED),array($numberUsed)) : true;
	}
	
	/**
	 * Récupérer le/la notary
	 * @return Notary 
	 */
	public function getNotary()
	{
		return Notary::load($this->pdo,$this->notary);
	}
	
	/**
	 * Définir le/la notary
	 * @param $notary Notary 
	 * @param $execute bool Exécuter la requête update ?
	 * @return bool Opération réussie ?
	 */
	public function setNotary(Notary $notary,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->notary = $notary->getIdNotary();
		
		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array(NotaryClerk::FIELDNAME_NOTARY_IDNOTARY),array($notary->getIdNotary())) : true;
	}
	
	/**
	 * Sélectionner les notaryClerks par notary
	 * @param $pdo PDO 
	 * @param $notary Notary 
	 * @return PDOStatement 
	 */
	public static function selectByNotary(PDO $pdo,Notary $notary)
	{
		$pdoStatement = self::_select($pdo,NotaryClerk::FIELDNAME_NOTARY_IDNOTARY.' = ?');
		if (!$pdoStatement->execute(array($notary->getIdNotary()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les notaryClerks d\'un(e) notary depuis la base de données');
		}
		return $pdoStatement;
	}
	
	/**
	 * ToString
	 * @return string Représentation de notaryClerk sous la forme d'un string
	 */
	public function __toString()
	{
		return '[NotaryClerk idNotaryClerk="'.$this->idNotaryClerk.'" name="'.$this->name.'" firstname="'.$this->firstname.'" address="'.$this->address.'" city="'.$this->city.'" zipCode="'.$this->zipCode.'" phone="'.$this->phone.'" mobilPhone="'.$this->mobilPhone.'" jobPhone="'.$this->jobPhone.'" fax="'.$this->fax.'" email="'.$this->email.'" comments="'.$this->comments.'" numberUsed="'.$this->numberUsed.'" notary="'.$this->notary.'"]';
	}
}

