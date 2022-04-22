<?php

/**
 * @name Notary
 * @version 17/10/2012 (dd/mm/yyyy)
 * @author WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
abstract class NotaryBase
{
	// Nom de la table
	const TABLENAME = 'notary';
	
	// Nom des champs
	const FIELDNAME_IDNOTARY = 'idnotary';
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
	
	/** @var PDO  */
	protected $pdo;
	
	/** @var array tableau pour le chargement fainéant */
	protected static $lazyload;
	
	/** @var int  */
	protected $idNotary;
	
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
	
	/**
	 * Construire un(e) notary
	 * @param $pdo PDO 
	 * @param $idNotary int 
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
	 * @param $lazyload bool Activer le chargement fainéant ?
	 */
	protected function __construct(PDO $pdo,$idNotary,$name,$firstname,$address,$city,$zipCode,$phone,$mobilPhone,$jobPhone,$fax,$email,$comments,$numberUsed,$lazyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;
		
		// Sauvegarder les attributs
		$this->idNotary = $idNotary;
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
		
		// Sauvegarder pour le chargement fainéant
		if ($lazyload) {
			self::$lazyload[$idNotary] = $this;
		}
	}
	
	/**
	 * Créer un(e) notary
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
	 * @param $lazyload bool Activer le chargement fainéant ?
	 * @return Notary 
	 */
	public static function create(PDO $pdo,$name,$firstname,$address,$city,$zipCode,$phone,$mobilPhone,$jobPhone,$fax,$email,$comments,$numberUsed,$lazyload=true)
	{
		// Ajouter le/la notary dans la base de données
		$pdoStatement = $pdo->prepare('INSERT INTO '.Notary::TABLENAME.' ('.Notary::FIELDNAME_NAME.','.Notary::FIELDNAME_FIRSTNAME.','.Notary::FIELDNAME_ADDRESS.','.Notary::FIELDNAME_CITY.','.Notary::FIELDNAME_ZIPCODE.','.Notary::FIELDNAME_PHONE.','.Notary::FIELDNAME_MOBILPHONE.','.Notary::FIELDNAME_JOBPHONE.','.Notary::FIELDNAME_FAX.','.Notary::FIELDNAME_EMAIL.','.Notary::FIELDNAME_COMMENTS.','.Notary::FIELDNAME_NUMBERUSED.') VALUES (?,?,?,?,?,?,?,?,?,?,?,?)');
		if (!$pdoStatement->execute(array($name,$firstname,$address,$city,$zipCode,$phone,$mobilPhone,$jobPhone,$fax,$email,$comments,$numberUsed))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) notary dans la base de données');
		}
		
		// Construire le/la notary
		return new Notary($pdo,$pdo->lastInsertId(),$name,$firstname,$address,$city,$zipCode,$phone,$mobilPhone,$jobPhone,$fax,$email,$comments,$numberUsed,$lazyload);
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
		return $pdo->prepare('SELECT DISTINCT '.Notary::TABLENAME.'.'.Notary::FIELDNAME_IDNOTARY.', '.Notary::TABLENAME.'.'.Notary::FIELDNAME_NAME.', '.Notary::TABLENAME.'.'.Notary::FIELDNAME_FIRSTNAME.', '.Notary::TABLENAME.'.'.Notary::FIELDNAME_ADDRESS.', '.Notary::TABLENAME.'.'.Notary::FIELDNAME_CITY.', '.Notary::TABLENAME.'.'.Notary::FIELDNAME_ZIPCODE.', '.Notary::TABLENAME.'.'.Notary::FIELDNAME_PHONE.', '.Notary::TABLENAME.'.'.Notary::FIELDNAME_MOBILPHONE.', '.Notary::TABLENAME.'.'.Notary::FIELDNAME_JOBPHONE.', '.Notary::TABLENAME.'.'.Notary::FIELDNAME_FAX.', '.Notary::TABLENAME.'.'.Notary::FIELDNAME_EMAIL.', '.Notary::TABLENAME.'.'.Notary::FIELDNAME_COMMENTS.', '.Notary::TABLENAME.'.'.Notary::FIELDNAME_NUMBERUSED.' '.
		                     'FROM '.Notary::TABLENAME.($from != null ? ', '.(is_array($from) ? implode(', ',$from) : $from) : '').
		                     ($where != null ? ' WHERE '.(is_array($where) ? implode(' AND ',$where) : $where) : '').
		                     ($orderby != null ? ' ORDER BY '.(is_array($orderby) ? implode(', ',$orderby) : $orderby) : '').
		                     ($limit != null ? ' LIMIT '.(is_array($limit) ? implode(', ', $limit) : $limit) : ''));
	}
	
	/**
	 * Charger un(e) notary
	 * @param $pdo PDO 
	 * @param $idNotary int 
	 * @param $lazyload bool Activer le chargement fainéant ?
	 * @return Notary 
	 */
	public static function load(PDO $pdo,$idNotary,$lazyload=true)
	{
		// Déjà chargé(e) ?
		if (isset(self::$lazyload[$idNotary])) {
			return self::$lazyload[$idNotary];
		}
		
		// Charger le/la notary
		$pdoStatement = self::_select($pdo,Notary::FIELDNAME_IDNOTARY.' = ?');
		if (!$pdoStatement->execute(array($idNotary))) {
			throw new Exception('Erreur lors du chargement d\'un(e) notary depuis la base de données');
		}
		
		// Récupérer le/la notary depuis le jeu de résultats
		return self::fetch($pdo,$pdoStatement,$lazyload);
	}
	
	/**
	 * Charger tous/toutes les notarys
	 * @param $pdo PDO 
	 * @param $lazyload bool Activer le chargement fainéant ?
	 * @return Notary[] Tableau de notarys
	 */
	public static function loadAll(PDO $pdo,$lazyload=false)
	{
		// Sélectionner tous/toutes les notarys
		$pdoStatement = self::selectAll($pdo);
		
		// Récupèrer tous/toutes les notarys
		$notarys = self::fetchAll($pdo,$pdoStatement,$lazyload);
		
		// Retourner le tableau
		return $notarys;
	}
	
	/**
	 * Sélectionner tous/toutes les notarys
	 * @param $pdo PDO 
	 * @return PDOStatement 
	 */
	public static function selectAll(PDO $pdo)
	{
		$pdoStatement = self::_select($pdo);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les notarys depuis la base de données');
		}
		return $pdoStatement;
	}
	
	/**
	 * Récupèrer le/la notary suivant(e) d'un jeu de résultats
	 * @param $pdo PDO 
	 * @param $pdoStatement PDOStatement 
	 * @param $lazyload bool Activer le chargement fainéant ?
	 * @return Notary 
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$lazyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idNotary,$name,$firstname,$address,$city,$zipCode,$phone,$mobilPhone,$jobPhone,$fax,$email,$comments,$numberUsed) = $values;
		
		// Construire le/la notary
		return isset(self::$lazyload[$idNotary]) ? self::$lazyload[$idNotary] :
		       new Notary($pdo,$idNotary,$name,$firstname,$address,$city,$zipCode,$phone,$mobilPhone,$jobPhone,$fax,$email,$comments,$numberUsed,$lazyload);
	}
	
	/**
	 * Récupèrer tous/toutes les notarys d'un jeu de résultats
	 * @param $pdo PDO 
	 * @param $pdoStatement PDOStatement 
	 * @param $lazyload bool Activer le chargement fainéant ?
	 * @return Notary[] Tableau de notarys
	 */
	public static function fetchAll(PDO $pdo,PDOStatement $pdoStatement,$lazyload=false)
	{
		$notarys = array();
		while ($notary = self::fetch($pdo,$pdoStatement,$lazyload)) {
			$notarys[] = $notary;
		}
		return $notarys;
	}
	
	/**
	 * Sérialiser
	 * @param $serialize bool Activer la sérialisation ?
	 * @return string Sérialisation du/de la notary
	 */
	public function serialize($serialize=true)
	{
		// Sérialiser le/la notary
		$array = array('idNotary' => $this->idNotary,'name' => $this->name,'firstname' => $this->firstname,'address' => $this->address,'city' => $this->city,'zipCode' => $this->zipCode,'phone' => $this->phone,'mobilPhone' => $this->mobilPhone,'jobPhone' => $this->jobPhone,'fax' => $this->fax,'email' => $this->email,'comments' => $this->comments,'numberUsed' => $this->numberUsed);
		
		// Retourner la sérialisation (ou pas) du/de la notary
		return $serialize ? serialize($array) : $array;
	}
	
	/**
	 * Désérialiser
	 * @param $pdo PDO 
	 * @param $string string Sérialisation du/de la notary
	 * @param $lazyload bool Activer le chargement fainéant ?
	 * @return Notary 
	 */
	public static function unserialize(PDO $pdo,$string,$lazyload=true)
	{
		// Désérialiser la chaine de caractères
		$array = unserialize($string);
		
		// Construire le/la notary
		return isset(self::$lazyload[$array['idNotary']]) ? self::$lazyload[$array['idNotary']] :
		       new Notary($pdo,$array['idNotary'],$array['name'],$array['firstname'],$array['address'],$array['city'],$array['zipCode'],$array['phone'],$array['mobilPhone'],$array['jobPhone'],$array['fax'],$array['email'],$array['comments'],$array['numberUsed'],$lazyload);
	}
	
	/**
	 * Test d'égalité
	 * @param $notary Notary 
	 * @return bool Les objets sont-ils égaux ?
	 */
	public function equals($notary)
	{
		// Test si null
		if ($notary == null) { return false; }
		
		// Tester la classe
		if (!($notary instanceof Notary)) { return false; }
		
		// Tester les ids
		return $this->idNotary == $notary->idNotary;
	}
	
	/**
	 * Compter les notarys
	 * @param $pdo PDO 
	 * @return int Nombre de notarys
	 */
	public static function count(PDO $pdo)
	{
		if (!($pdoStatement = $pdo->query('SELECT COUNT('.Notary::FIELDNAME_IDNOTARY.') FROM '.Notary::TABLENAME))) {
			throw new Exception('Erreur lors du comptage des notarys dans la base de données');
		}
		return $pdoStatement->fetchColumn();
	}
	
	/**
	 * Supprimer le/la notary
	 * @return bool Opération réussie ?
	 */
	public function delete()
	{
		// Supprimer les NotaryClerks associé(e)s
		$select = $this->selectNotaryClerks();
		while ($notaryClerk = NotaryClerk::fetch($this->pdo,$select)) {
			if (!$notaryClerk->delete()) { return false; }
		}
		
		// Supprimer le/la notary
		$pdoStatement = $this->pdo->prepare('DELETE FROM '.Notary::TABLENAME.' WHERE '.Notary::FIELDNAME_IDNOTARY.' = ?');
		if (!$pdoStatement->execute(array($this->getIdNotary()))) {
			throw new Exception('Erreur lors de la suppression d\'un(e) notary dans la base de données');
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
		$pdoStatement = $this->pdo->prepare('UPDATE '.Notary::TABLENAME.' SET '.implode(', ', $updates).' WHERE '.Notary::FIELDNAME_IDNOTARY.' = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdNotary())))) {
			throw new Exception('Erreur lors de la mise à jour d\'un champ d\'un(e) notary dans la base de données');
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
		return $this->_set(array(Notary::FIELDNAME_NAME,Notary::FIELDNAME_FIRSTNAME,Notary::FIELDNAME_ADDRESS,Notary::FIELDNAME_CITY,Notary::FIELDNAME_ZIPCODE,Notary::FIELDNAME_PHONE,Notary::FIELDNAME_MOBILPHONE,Notary::FIELDNAME_JOBPHONE,Notary::FIELDNAME_FAX,Notary::FIELDNAME_EMAIL,Notary::FIELDNAME_COMMENTS,Notary::FIELDNAME_NUMBERUSED),array($this->name,$this->firstname,$this->address,$this->city,$this->zipCode,$this->phone,$this->mobilPhone,$this->jobPhone,$this->fax,$this->email,$this->comments,$this->numberUsed));
	}
	
	/**
	 * Récupérer le/la idNotary
	 * @return int 
	 */
	public function getIdNotary()
	{
		return $this->idNotary;
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
		return $execute ? $this->_set(array(Notary::FIELDNAME_NAME),array($name)) : true;
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
		return $execute ? $this->_set(array(Notary::FIELDNAME_FIRSTNAME),array($firstname)) : true;
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
		return $execute ? $this->_set(array(Notary::FIELDNAME_ADDRESS),array($address)) : true;
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
		return $execute ? $this->_set(array(Notary::FIELDNAME_CITY),array($city)) : true;
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
		return $execute ? $this->_set(array(Notary::FIELDNAME_ZIPCODE),array($zipCode)) : true;
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
		return $execute ? $this->_set(array(Notary::FIELDNAME_PHONE),array($phone)) : true;
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
		return $execute ? $this->_set(array(Notary::FIELDNAME_MOBILPHONE),array($mobilPhone)) : true;
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
		return $execute ? $this->_set(array(Notary::FIELDNAME_JOBPHONE),array($jobPhone)) : true;
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
		return $execute ? $this->_set(array(Notary::FIELDNAME_FAX),array($fax)) : true;
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
		return $execute ? $this->_set(array(Notary::FIELDNAME_EMAIL),array($email)) : true;
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
		return $execute ? $this->_set(array(Notary::FIELDNAME_COMMENTS),array($comments)) : true;
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
		return $execute ? $this->_set(array(Notary::FIELDNAME_NUMBERUSED),array($numberUsed)) : true;
	}
	
	/**
	 * Sélectionner les notaryClerks
	 * @return PDOStatement 
	 */
	public function selectNotaryClerks()
	{
		return NotaryClerk::selectByNotary($this->pdo,$this);
	}
	
	/**
	 * ToString
	 * @return string Représentation de notary sous la forme d'un string
	 */
	public function __toString()
	{
		return '[Notary idNotary="'.$this->idNotary.'" name="'.$this->name.'" firstname="'.$this->firstname.'" address="'.$this->address.'" city="'.$this->city.'" zipCode="'.$this->zipCode.'" phone="'.$this->phone.'" mobilPhone="'.$this->mobilPhone.'" jobPhone="'.$this->jobPhone.'" fax="'.$this->fax.'" email="'.$this->email.'" comments="'.$this->comments.'" numberUsed="'.$this->numberUsed.'"]';
	}
}

