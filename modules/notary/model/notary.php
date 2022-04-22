<?php

/**
 * @class Notary
 * @date 04/02/2011 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class Notary
{
	/// @var PDO
	private $pdo;

	/// @var array tableau pour le chargement rapide
	private static $easyload;

	/// @var int
	private $idNotary;

	/// @var string
	private $name;

	/// @var string
	private $fistname;

	/// @var string
	private $address;

	/// @var string
	private $city;

	/// @var string
	private $zipCode;

	/// @var string
	private $phone;

	/// @var string
	private $mobilPhone;

	/// @var string
	private $jobPhone;

	/// @var string
	private $fax;

	/// @var string
	private $email;

	/// @var string
	private $comments;

	/// @var int
	private $numberUsed;

	/**
	 * Construire un(e) notary
	 * @param $pdo PDO
	 * @param $idNotary int
	 * @param $name string
	 * @param $fistname string
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
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Notary
	 */
	protected function __construct(PDO $pdo,$idNotary,$name,$fistname,$address,$city,$zipCode,$phone,$mobilPhone,$jobPhone,$fax,$email,$comments,$numberUsed,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;

		// Sauvegarder les attributs
		$this->idNotary = $idNotary;
		$this->name = $name;
		$this->fistname = $fistname;
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

		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			Notary::$easyload[$idNotary] = $this;
		}
	}

	/**
	 * Créer un(e) notary
	 * @param $pdo PDO
	 * @param $name string
	 * @param $fistname string
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
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Notary
	 */
	public static function create(PDO $pdo,$name,$fistname,$address,$city,$zipCode,$phone,$mobilPhone,$jobPhone,$fax,$email,$comments,$numberUsed,$easyload=true)
	{
		// Ajouter le/la notary dans la base de données
		$pdoStatement = $pdo->prepare('INSERT INTO Notary (name,fistname,address,city,zipCode,phone,mobilPhone,jobPhone,fax,email,comments,numberUsed) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)');
		if (!$pdoStatement->execute(array($name,$fistname,$address,$city,$zipCode,$phone,$mobilPhone,$jobPhone,$fax,$email,$comments,$numberUsed))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) notary dans la base de données');
		}

		// Construire le/la notary
		return new Notary($pdo,$pdo->lastInsertId(),$name,$fistname,$address,$city,$zipCode,$phone,$mobilPhone,$jobPhone,$fax,$email,$comments,$numberUsed,$easyload);
	}

	/**
	 * Requête de séléction
	 * @param $pdo PDO
	 * @param $where string
	 * @param $orderby string
	 * @param $limit string
	 * @return PDOStatement
	 */
	private static function _select(PDO $pdo,$where=null,$orderby=null,$limit=null)
	{
		return $pdo->prepare('SELECT n.idNotary, n.name, n.fistname, n.address, n.city, n.zipCode, n.phone, n.mobilPhone, n.jobPhone, n.fax, n.email, n.comments, n.numberUsed FROM Notary n '.
		($where != null ? ' WHERE '.$where : '').
		($orderby != null ? ' ORDER BY '.$orderby : '').
		($limit != null ? ' LIMIT '.$limit : ''));
	}

	/**
	 * Charger un(e) notary
	 * @param $pdo PDO
	 * @param $idNotary int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Notary
	 */
	public static function load(PDO $pdo,$idNotary,$easyload=true)
	{
		// Déjà chargé(e) ?
		if (isset(Notary::$easyload[$idNotary])) {
			return Notary::$easyload[$idNotary];
		}

		// Charger le/la notary
		$pdoStatement = Notary::_select($pdo,'n.idNotary = ?');
		if (!$pdoStatement->execute(array($idNotary))) {
			throw new Exception('Erreur lors du chargement d\'un(e) notary depuis la base de données');
		}

		// Récupérer le/la notary depuis le jeu de résultats
		return Notary::fetch($pdo,$pdoStatement,$easyload);
	}

	/**
	 * Charger tous/toutes les notarys
	 * @param $pdo PDO
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Notary[] tableau de notarys
	 */
	public static function loadAll(PDO $pdo,$easyload=false)
	{
		// Sélectionner tous/toutes les notarys
		$pdoStatement = Notary::selectAll($pdo,null,'n.fistname, n.name');

		// Mettre chaque notary dans un tableau
		$notarys = array();
		while ($notary = Notary::fetch($pdo,$pdoStatement,$easyload)) {
			$notarys[] = $notary;
		}

		// Retourner le tableau
		return $notarys;
	}

	/**
	 * Sélectionner tous/toutes les notarys
	 * @param $pdo PDO
	 * @return PDOStatement
	 */
	public static function selectAll(PDO $pdo,$where=null,$orderby=null)
	{
		$pdoStatement = Notary::_select($pdo,$where,$orderby);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les notarys depuis la base de données');
		}
		return $pdoStatement;
	}

	/**
	 * Récupère le/la notary suivant(e) d'un jeu de résultats
	 * @param $pdo PDO
	 * @param $pdoStatement PDOStatement
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Notary
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idNotary,$name,$fistname,$address,$city,$zipCode,$phone,$mobilPhone,$jobPhone,$fax,$email,$comments,$numberUsed) = $values;

		// Construire le/la notary
		return isset(Notary::$easyload[$idNotary.'-'.$name.'-'.$fistname.'-'.$address.'-'.$city.'-'.$zipCode.'-'.$phone.'-'.$mobilPhone.'-'.$jobPhone.'-'.$fax.'-'.$email.'-'.$comments.'-'.$numberUsed]) ? Notary::$easyload[$idNotary.'-'.$name.'-'.$fistname.'-'.$address.'-'.$city.'-'.$zipCode.'-'.$phone.'-'.$mobilPhone.'-'.$jobPhone.'-'.$fax.'-'.$email.'-'.$comments.'-'.$numberUsed] :
		new Notary($pdo,$idNotary,$name,$fistname,$address,$city,$zipCode,$phone,$mobilPhone,$jobPhone,$fax,$email,$comments,$numberUsed,$easyload);
	}

	/**
	 * Serialiser
	 * @param $serialize bool activer la sérialisation ?
	 * @return string serialisation du/de la notary
	 */
	public function serialize($serialize=true)
	{
		// Sérialiser le/la notary
		$array = array('idNotary' => $this->idNotary,'name' => $this->name,'fistname' => $this->fistname,'address' => $this->address,'city' => $this->city,'zipCode' => $this->zipCode,'phone' => $this->phone,'mobilPhone' => $this->mobilPhone,'jobPhone' => $this->jobPhone,'fax' => $this->fax,'email' => $this->email,'comments' => $this->comments,'numberUsed' => $this->numberUsed);

		// Retourner la serialisation (ou pas) du/de la notary
		return $serialize ? serialize($array) : $array;
	}

	/**
	 * Désérialiser
	 * @param $pdo PDO
	 * @param $string string serialisation du/de la notary
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Notary
	 */
	public static function unserialize(PDO $pdo,$string,$easyload=true)
	{
		// Désérialiser la chaine de caractères
		$array = unserialize($string);

		// Construire le/la notary
		return isset(Notary::$easyload[$array['idNotary']]) ? Notary::$easyload[$array['idNotary']] :
		new Notary($pdo,$array['idNotary'],$array['name'],$array['fistname'],$array['address'],$array['city'],$array['zipCode'],$array['phone'],$array['mobilPhone'],$array['jobPhone'],$array['fax'],$array['email'],$array['comments'],$array['numberUsed'],$easyload);
	}

	/**
	 * Test d'égalité
	 * @param $notary Notary
	 * @return bool les objets sont ils égaux ?
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
	 * @return int nombre de notarys
	 */
	public static function count(PDO $pdo)
	{
		if (!($pdoStatement = $pdo->query('SELECT COUNT(idNotary) FROM Notary'))) {
			throw new Exception('Erreur lors du comptage des notarys dans la base de données');
		}
		return $pdoStatement->fetchColumn();
	}

	/**
	 * Supprimer le/la notary
	 * @return bool opération réussie ?
	 */
	public function delete()
	{
		// Supprimer le/la notary
		$pdoStatement = $this->pdo->prepare('DELETE FROM Notary WHERE idNotary = ?');
		if (!$pdoStatement->execute(array($this->getIdNotary()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) notary dans la base de données');
		}

		// Opération réussie ?
		return $pdoStatement->rowCount() == 1;
	}

	/**
	 * Mettre à jour un champ dans la base de données
	 * @param $fields array
	 * @param $values array
	 * @return bool opération réussie ?
	 */
	private function _set($fields,$values)
	{
		// Préparer la mise à jour
		$updates = array();
		foreach ($fields as $field) {
			$updates[] = $field.' = ?';
		}

		// Mettre à jour le champ
		$pdoStatement = $this->pdo->prepare('UPDATE Notary SET '.implode(', ', $updates).' WHERE idNotary = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdNotary())))) {
			throw new Exception('Erreur lors de la mise à jour d\'un champ d\'un(e) notary dans la base de données');
		}

		// Opération réussie ?
		return $pdoStatement->rowCount() == 1;
	}

	/**
	 * Mettre à jour tous les champs dans la base de données
	 * @return bool opération réussie ?
	 */
	public function update()
	{
		return $this->_set(array('name','fistname','address','city','zipCode','phone','mobilPhone','jobPhone','fax','email','comments','numberUsed'),array($this->name,$this->fistname,$this->address,$this->city,$this->zipCode,$this->phone,$this->mobilPhone,$this->jobPhone,$this->fax,$this->email,$this->comments,$this->numberUsed));
	}

	/**
	 * Récupérer le/la idNotary
	 * @return int
	 */
	public function getIdNotary()
	{
		return $this->idNotary;
	}
	public function getId()
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
	 * @param $execute bool exécuter la requête update ?
	 * @return bool opération réussie ?
	 */
	public function setName($name,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->name = $name;

		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array('name'),array($name)) : true;
	}

	/**
	 * Récupérer le/la fistname
	 * @return string
	 */
	public function getFirstname()
	{
		return $this->fistname;
	}

	/**
	 * Définir le/la fistname
	 * @param $fistname string
	 * @param $execute bool exécuter la requête update ?
	 * @return bool opération réussie ?
	 */
	public function setFirstname($fistname,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->fistname = $fistname;

		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array('fistname'),array($fistname)) : true;
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
	 * @param $execute bool exécuter la requête update ?
	 * @return bool opération réussie ?
	 */
	public function setAddress($address,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->address = $address;

		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array('address'),array($address)) : true;
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
	 * @param $execute bool exécuter la requête update ?
	 * @return bool opération réussie ?
	 */
	public function setCity($city,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->city = $city;

		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array('city'),array($city)) : true;
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
	 * @param $execute bool exécuter la requête update ?
	 * @return bool opération réussie ?
	 */
	public function setZipCode($zipCode,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->zipCode = $zipCode;

		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array('zipCode'),array($zipCode)) : true;
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
	 * @param $execute bool exécuter la requête update ?
	 * @return bool opération réussie ?
	 */
	public function setPhone($phone,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->phone = $phone;

		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array('phone'),array($phone)) : true;
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
	 * @param $execute bool exécuter la requête update ?
	 * @return bool opération réussie ?
	 */
	public function setMobilPhone($mobilPhone,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->mobilPhone = $mobilPhone;

		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array('mobilPhone'),array($mobilPhone)) : true;
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
	 * @param $execute bool exécuter la requête update ?
	 * @return bool opération réussie ?
	 */
	public function setJobPhone($jobPhone,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->jobPhone = $jobPhone;

		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array('jobPhone'),array($jobPhone)) : true;
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
	 * @param $execute bool exécuter la requête update ?
	 * @return bool opération réussie ?
	 */
	public function setFax($fax,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->fax = $fax;

		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array('fax'),array($fax)) : true;
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
	 * @param $execute bool exécuter la requête update ?
	 * @return bool opération réussie ?
	 */
	public function setEmail($email,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->email = $email;

		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array('email'),array($email)) : true;
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
	 * @param $execute bool exécuter la requête update ?
	 * @return bool opération réussie ?
	 */
	public function setComments($comments,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->comments = $comments;

		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array('comments'),array($comments)) : true;
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
	 * @param $execute bool exécuter la requête update ?
	 * @return bool opération réussie ?
	 */
	public function setNumberUsed($numberUsed,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->numberUsed = $numberUsed;

		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array('numberUsed'),array($numberUsed)) : true;
	}
	/**
	 * ToString
	 * @return string représentation de notary sous la forme d'un string
	 */
	public function __toString()
	{
		return '[Notary idNotary="'.$this->idNotary.'" name="'.$this->name.'" fistname="'.$this->fistname.'" address="'.$this->address.'" city="'.$this->city.'" zipCode="'.$this->zipCode.'" phone="'.$this->phone.'" mobilPhone="'.$this->mobilPhone.'" jobPhone="'.$this->jobPhone.'" fax="'.$this->fax.'" email="'.$this->email.'" comments="'.$this->comments.'" numberUsed="'.$this->numberUsed.'"]';
	}

}