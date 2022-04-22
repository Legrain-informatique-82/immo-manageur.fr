<?php

/**
 * @class Agency
 * @date 19/07/2011 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class Agency
{
	/// @var PDO
	private $pdo;

	/// @var array tableau pour le chargement rapide
	private static $easyload;

	/// @var int
	private $idAgency;

	/// @var string
	private $name;

	/// @var string
	private $tel1;

	/// @var string
	private $tel2;

	/// @var string
	private $tel3;

	/// @var string
	private $email;

	/// @var string
	private $address;

	/// @var string
	private $city;

	/// @var string
	private $zipCode;

	/// @var string
	private $contact;

	/**
	 * Construire un(e) agency
	 * @param $pdo PDO
	 * @param $idAgency int
	 * @param $name string
	 * @param $tel1 string
	 * @param $tel2 string
	 * @param $tel3 string
	 * @param $email string
	 * @param $address string
	 * @param $city string
	 * @param $zipCode string
	 * @param $contact string
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Agency
	 */
	protected function __construct(PDO $pdo,$idAgency,$name,$tel1,$tel2,$tel3,$email,$address,$city,$zipCode,$contact,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;

		// Sauvegarder les attributs
		$this->idAgency = $idAgency;
		$this->name = $name;
		$this->tel1 = $tel1;
		$this->tel2 = $tel2;
		$this->tel3 = $tel3;
		$this->email = $email;
		$this->address = $address;
		$this->city = $city;
		$this->zipCode = $zipCode;
		$this->contact = $contact;

		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			Agency::$easyload[$idAgency] = $this;
		}
	}

	/**
	 * Cr�er un(e) agency
	 * @param $pdo PDO
	 * @param $name string
	 * @param $tel1 string
	 * @param $tel2 string
	 * @param $tel3 string
	 * @param $email string
	 * @param $address string
	 * @param $city string
	 * @param $zipCode string
	 * @param $contact string
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Agency
	 */
	public static function create(PDO $pdo,$name,$tel1,$tel2,$tel3,$email,$address,$city,$zipCode,$contact,$easyload=true)
	{
		// Ajouter le/la agency dans la base de donn�es
		$pdoStatement = $pdo->prepare('INSERT INTO Agency (name,tel1,tel2,tel3,email,address,city,zipCode,contact) VALUES (?,?,?,?,?,?,?,?,?)');
		if (!$pdoStatement->execute(array($name,$tel1,$tel2,$tel3,$email,$address,$city,$zipCode,$contact))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) agency dans la base de donn�es');
		}

		// Construire le/la agency
		return new Agency($pdo,$pdo->lastInsertId(),$name,$tel1,$tel2,$tel3,$email,$address,$city,$zipCode,$contact,$easyload);
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
		return $pdo->prepare('SELECT a.idAgency, a.name, a.tel1, a.tel2, a.tel3, a.email, a.address, a.city, a.zipCode, a.contact FROM Agency a '.
		($where != null ? ' WHERE '.$where : '').
		($orderby != null ? ' ORDERBY '.$orderby : '').
		($limit != null ? ' LIMIT '.$limit : ''));
	}

	/**
	 * Charger un(e) agency
	 * @param $pdo PDO
	 * @param $idAgency int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Agency
	 */
	public static function load(PDO $pdo,$idAgency,$easyload=true)
	{
		// D�j� charg�(e) ?
		if (isset(Agency::$easyload[$idAgency])) {
			return Agency::$easyload[$idAgency];
		}

		// Charger le/la agency
		$pdoStatement = Agency::_select($pdo,'a.idAgency = ?');
		if (!$pdoStatement->execute(array($idAgency))) {
			throw new Exception('Erreur lors du chargement d\'un(e) agency depuis la base de donn�es');
		}

		// R�cup�rer le/la agency depuis le jeu de r�sultats
		return Agency::fetch($pdo,$pdoStatement,$easyload);
	}

	/**
	 * Charger tous/toutes les agencys
	 * @param $pdo PDO
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Agency[] tableau de agencys
	 */
	public static function loadAll(PDO $pdo,$easyload=false)
	{
		// S�lectionner tous/toutes les agencys
		$pdoStatement = Agency::selectAll($pdo);

		// Mettre chaque agency dans un tableau
		$agencys = array();
		while ($agency = Agency::fetch($pdo,$pdoStatement,$easyload)) {
			$agencys[] = $agency;
		}

		// Retourner le tableau
		return $agencys;
	}

	/**
	 * S�lectionner tous/toutes les agencys
	 * @param $pdo PDO
	 * @return PDOStatement
	 */
	public static function selectAll(PDO $pdo)
	{
		$pdoStatement = Agency::_select($pdo);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les agencys depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�re le/la agency suivant(e) d'un jeu de r�sultats
	 * @param $pdo PDO
	 * @param $pdoStatement PDOStatement
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Agency
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idAgency,$name,$tel1,$tel2,$tel3,$email,$address,$city,$zipCode,$contact) = $values;

		// Construire le/la agency
		return isset(Agency::$easyload[$idAgency.'-'.$name.'-'.$tel1.'-'.$tel2.'-'.$tel3.'-'.$email.'-'.$address.'-'.$city.'-'.$zipCode.'-'.$contact]) ? Agency::$easyload[$idAgency.'-'.$name.'-'.$tel1.'-'.$tel2.'-'.$tel3.'-'.$email.'-'.$address.'-'.$city.'-'.$zipCode.'-'.$contact] :
		new Agency($pdo,$idAgency,$name,$tel1,$tel2,$tel3,$email,$address,$city,$zipCode,$contact,$easyload);
	}

	/**
	 * Serialiser
	 * @param $serialize bool activer la s�rialisation ?
	 * @return string serialisation du/de la agency
	 */
	public function serialize($serialize=true)
	{
		// S�rialiser le/la agency
		$array = array('idAgency' => $this->idAgency,'name' => $this->name,'tel1' => $this->tel1,'tel2' => $this->tel2,'tel3' => $this->tel3,'email' => $this->email,'address' => $this->address,'city' => $this->city,'zipCode' => $this->zipCode,'contact' => $this->contact);

		// Retourner la serialisation (ou pas) du/de la agency
		return $serialize ? serialize($array) : $array;
	}

	/**
	 * D�s�rialiser
	 * @param $pdo PDO
	 * @param $string string serialisation du/de la agency
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Agency
	 */
	public static function unserialize(PDO $pdo,$string,$easyload=true)
	{
		// D�s�rialiser la chaine de caract�res
		$array = unserialize($string);

		// Construire le/la agency
		return isset(Agency::$easyload[$array['idAgency']]) ? Agency::$easyload[$array['idAgency']] :
		new Agency($pdo,$array['idAgency'],$array['name'],$array['tel1'],$array['tel2'],$array['tel3'],$array['email'],$array['address'],$array['city'],$array['zipCode'],$array['contact'],$easyload);
	}

	/**
	 * Test d'�galit�
	 * @param $agency Agency
	 * @return bool les objets sont ils �gaux ?
	 */
	public function equals($agency)
	{
		// Test si null
		if ($agency == null) { return false; }

		// Tester la classe
		if (!($agency instanceof Agency)) { return false; }

		// Tester les ids
		return $this->idAgency == $agency->idAgency;
	}

	/**
	 * Compter les agencys
	 * @param $pdo PDO
	 * @return int nombre de agencys
	 */
	public static function count(PDO $pdo)
	{
		if (!($pdoStatement = $pdo->query('SELECT COUNT(idAgency) FROM Agency'))) {
			throw new Exception('Erreur lors du comptage des agencys dans la base de donn�es');
		}
		return $pdoStatement->fetchColumn();
	}

	/**
	 * Supprimer le/la agency
	 * @return bool op�ration r�ussie ?
	 */
	public function delete()
	{
		// Supprimer les Users associ�(e)s
		$select = $this->selectUsers();
		while ($user = User::fetch($this->pdo,$select)) {
			if (!$user->setAgency(null)) { return false; }
		}

		// Supprimer le/la agency
		$pdoStatement = $this->pdo->prepare('DELETE FROM Agency WHERE idAgency = ?');
		if (!$pdoStatement->execute(array($this->getIdAgency()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) agency dans la base de donn�es');
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
		$pdoStatement = $this->pdo->prepare('UPDATE Agency SET '.implode(', ', $updates).' WHERE idAgency = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdAgency())))) {
			throw new Exception('Erreur lors de la mise � jour d\'un champ d\'un(e) agency dans la base de donn�es');
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
		return $this->_set(array('name','tel1','tel2','tel3','email','address','city','zipCode','contact'),array($this->name,$this->tel1,$this->tel2,$this->tel3,$this->email,$this->address,$this->city,$this->zipCode,$this->contact));
	}

	/**
	 * R�cup�rer le/la idAgency
	 * @return int
	 */
	public function getIdAgency()
	{
		return $this->idAgency;
	}
	public function getId()
	{
		return $this->idAgency;
	}
	/**
	 * R�cup�rer le/la name
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * D�finir le/la name
	 * @param $name string
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setName($name,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->name = $name;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('name'),array($name)) : true;
	}

	/**
	 * R�cup�rer le/la tel1
	 * @return string
	 */
	public function getTel1()
	{
		return $this->tel1;
	}

	/**
	 * D�finir le/la tel1
	 * @param $tel1 string
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setTel1($tel1,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->tel1 = $tel1;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('tel1'),array($tel1)) : true;
	}

	/**
	 * R�cup�rer le/la tel2
	 * @return string
	 */
	public function getTel2()
	{
		return $this->tel2;
	}

	/**
	 * D�finir le/la tel2
	 * @param $tel2 string
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setTel2($tel2,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->tel2 = $tel2;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('tel2'),array($tel2)) : true;
	}

	/**
	 * R�cup�rer le/la tel3
	 * @return string
	 */
	public function getTel3()
	{
		return $this->tel3;
	}

	/**
	 * D�finir le/la tel3
	 * @param $tel3 string
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setTel3($tel3,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->tel3 = $tel3;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('tel3'),array($tel3)) : true;
	}

	/**
	 * R�cup�rer le/la email
	 * @return string
	 */
	public function getEmail()
	{
		return $this->email;
	}

	/**
	 * D�finir le/la email
	 * @param $email string
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setEmail($email,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->email = $email;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('email'),array($email)) : true;
	}

	/**
	 * R�cup�rer le/la address
	 * @return string
	 */
	public function getAddress()
	{
		return $this->address;
	}

	/**
	 * D�finir le/la address
	 * @param $address string
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setAddress($address,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->address = $address;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('address'),array($address)) : true;
	}

	/**
	 * R�cup�rer le/la city
	 * @return string
	 */
	public function getCity()
	{
		return $this->city;
	}

	/**
	 * D�finir le/la city
	 * @param $city string
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setCity($city,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->city = $city;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('city'),array($city)) : true;
	}

	/**
	 * R�cup�rer le/la zipCode
	 * @return string
	 */
	public function getZipCode()
	{
		return $this->zipCode;
	}

	/**
	 * D�finir le/la zipCode
	 * @param $zipCode string
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setZipCode($zipCode,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->zipCode = $zipCode;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('zipCode'),array($zipCode)) : true;
	}

	/**
	 * R�cup�rer le/la contact
	 * @return string
	 */
	public function getContact()
	{
		return $this->contact;
	}

	/**
	 * D�finir le/la contact
	 * @param $contact string
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setContact($contact,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->contact = $contact;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('contact'),array($contact)) : true;
	}

	/**
	 * S�lectionner les users
	 * @return PDOStatement
	 */
	public function selectUsers()
	{
		return User::selectByAgency($this->pdo,$this);
	}
	/**
	 * ToString
	 * @return string repr�sentation de agency sous la forme d'un string
	 */
	public function __toString()
	{
		return '[Agency idAgency="'.$this->idAgency.'" name="'.$this->name.'" tel1="'.$this->tel1.'" tel2="'.$this->tel2.'" tel3="'.$this->tel3.'" email="'.$this->email.'" address="'.$this->address.'" city="'.$this->city.'" zipCode="'.$this->zipCode.'" contact="'.$this->contact.'"]';
	}

}

?>
