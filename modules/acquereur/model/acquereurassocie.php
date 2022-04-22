<?php

/**
 * @class AcquereurAssocie
 * @date 23/11/2011 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class AcquereurAssocie
{
	/// @var PDO
	private $pdo;

	/// @var array tableau pour le chargement rapide
	private static $easyload;

	/// @var int
	private $idAcquereurAssocie;

	/// @var string
	private $name;

	/// @var string
	private $firstname;

	/// @var string
	private $adress;

	/// @var string
	private $phone;

	/// @var string
	private $cellPhone;

	/// @var string
	private $workPhone;

	/// @var string
	private $fax;

	/// @var string
	private $email;

	/// @var string
	private $comment;

	/// @var int id de city
	private $city;

	/// @var int id de acquereur
	private $acquereur;

	/// @var int id de titreacquereur
	private $titreAcquereur;
	
	private $maidenName;
	private $birthdate;
	private $birthLocation;
	private $nationality;
	private $job;
	

	/**
	 * Construire un(e) acquereurAssocie
	 * @param $pdo PDO
	 * @param $idAcquereurAssocie int
	 * @param $name string
	 * @param $firstname string
	 * @param $adress string
	 * @param $phone string
	 * @param $cellPhone string
	 * @param $workPhone string
	 * @param $fax string
	 * @param $email string
	 * @param $comment string
	 * @param $city int id de city
	 * @param $acquereur int id de acquereur
	 * @param $titreAcquereur int id de titreacquereur
	 * @param $easyload bool activer le chargement rapide ?
	 * @return AcquereurAssocie
	 */
	protected function __construct(PDO $pdo,$idAcquereurAssocie,$name,$firstname,$adress,$phone,$cellPhone,$workPhone,$fax,$email,$comment,$city,$acquereur,$titreAcquereur,$maidenName = null, $birthdate=null,$birthLocation=null,$nationality=null,$job = null,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;

		// Sauvegarder les attributs
		$this->idAcquereurAssocie = $idAcquereurAssocie;
		$this->name = $name;
		$this->firstname = $firstname;
		$this->adress = $adress;
		$this->phone = $phone;
		$this->cellPhone = $cellPhone;
		$this->workPhone = $workPhone;
		$this->fax = $fax;
		$this->email = $email;
		$this->comment = $comment;
		$this->city = $city;
		$this->acquereur = $acquereur;
		$this->titreAcquereur = $titreAcquereur;
		$this->maidenName = $maidenName;
		$this->birthdate=$birthdate;
		$this->birthLocation=$birthLocation;
		$this->nationality=$nationality;
		$this->job = $job;

		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			AcquereurAssocie::$easyload[$idAcquereurAssocie] = $this;
		}
	}

	/**
	 * Cr�er un(e) acquereurAssocie
	 * @param $pdo PDO
	 * @param $name string
	 * @param $firstname string
	 * @param $adress string
	 * @param $phone string
	 * @param $cellPhone string
	 * @param $workPhone string
	 * @param $fax string
	 * @param $email string
	 * @param $comment string
	 * @param $city City
	 * @param $acquereur Acquereur
	 * @param $titreAcquereur TitreAcquereur
	 * @param $easyload bool activer le chargement rapide ?
	 * @return AcquereurAssocie
	 */
	public static function create(PDO $pdo,$name,$firstname,$adress,$phone,$cellPhone,$workPhone,$fax,$email,$comment,City $city,Acquereur $acquereur,TitreAcquereur $titreAcquereur,$maidenName = null, $birthdate=null,$birthLocation=null,$nationality=null,$job = null,$easyload=true)
	{
		// Ajouter le/la acquereurAssocie dans la base de donn�es
		$pdoStatement = $pdo->prepare('INSERT INTO AcquereurAssocie (name,firstname,adress,phone,cellPhone,workPhone,fax,email,comment,city_idCity,acquereur_idAcquereur,titreAcquereur_idTitreAcquereur,maidenName,birthdate,birthLocation,nationality,job) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
		if (!$pdoStatement->execute(array($name,$firstname,$adress,$phone,$cellPhone,$workPhone,$fax,$email,$comment,$city->getIdCity(),$acquereur->getIdAcquereur(),$titreAcquereur->getIdTitreAcquereur(),$maidenName,$birthdate==null?date('Y-m-d H:i:s'):date('Y-m-d H:i:s',$birthdate),$birthLocation,$nationality,$job ))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) acquereurAssocie dans la base de donn�es');
		}

		// Construire le/la acquereurAssocie
		return new AcquereurAssocie($pdo,$pdo->lastInsertId(),$name,$firstname,$adress,$phone,$cellPhone,$workPhone,$fax,$email,$comment,$city->getIdCity(),$acquereur->getIdAcquereur(),$titreAcquereur->getIdTitreAcquereur(),$maidenName,$birthdate,$birthLocation,$nationality,$job,$easyload);
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
		return $pdo->prepare('SELECT a.idAcquereurAssocie, a.name, a.firstname, a.adress, a.phone, a.cellPhone, a.workPhone, a.fax, a.email, a.comment, a.city_idCity, a.acquereur_idAcquereur, a.titreAcquereur_idTitreAcquereur,a.maidenName,a.birthdate,a.birthLocation,a.nationality,a.job FROM AcquereurAssocie a '.
		($where != null ? ' WHERE '.$where : '').
		($orderby != null ? ' ORDER BY '.$orderby : '').
		($limit != null ? ' LIMIT '.$limit : ''));
	}

	/**
	 * Charger un(e) acquereurAssocie
	 * @param $pdo PDO
	 * @param $idAcquereurAssocie int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return AcquereurAssocie
	 */
	public static function load(PDO $pdo,$idAcquereurAssocie,$easyload=true)
	{
		// D�j� charg�(e) ?
		if (isset(AcquereurAssocie::$easyload[$idAcquereurAssocie])) {
			return AcquereurAssocie::$easyload[$idAcquereurAssocie];
		}

		// Charger le/la acquereurAssocie
		$pdoStatement = AcquereurAssocie::_select($pdo,'a.idAcquereurAssocie = ?');
		if (!$pdoStatement->execute(array($idAcquereurAssocie))) {
			throw new Exception('Erreur lors du chargement d\'un(e) acquereurAssocie depuis la base de donn�es');
		}

		// R�cup�rer le/la acquereurAssocie depuis le jeu de r�sultats
		return AcquereurAssocie::fetch($pdo,$pdoStatement,$easyload);
	}

	/**
	 * Charger tous/toutes les acquereurAssocies
	 * @param $pdo PDO
	 * @param $easyload bool activer le chargement rapide ?
	 * @return AcquereurAssocie[] tableau de acquereurassocies
	 */
	public static function loadAll(PDO $pdo,$easyload=false)
	{
		// S�lectionner tous/toutes les acquereurAssocies
		$pdoStatement = AcquereurAssocie::selectAll($pdo);

		// Mettre chaque acquereurAssocie dans un tableau
		$acquereurAssocies = array();
		while ($acquereurAssocie = AcquereurAssocie::fetch($pdo,$pdoStatement,$easyload)) {
			$acquereurAssocies[] = $acquereurAssocie;
		}

		// Retourner le tableau
		return $acquereurAssocies;
	}

	/**
	 * S�lectionner tous/toutes les acquereurAssocies
	 * @param $pdo PDO
	 * @return PDOStatement
	 */
	public static function selectAll(PDO $pdo)
	{
		$pdoStatement = AcquereurAssocie::_select($pdo);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les acquereurAssocies depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�re le/la acquereurAssocie suivant(e) d'un jeu de r�sultats
	 * @param $pdo PDO
	 * @param $pdoStatement PDOStatement
	 * @param $easyload bool activer le chargement rapide ?
	 * @return AcquereurAssocie
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) {
			return null;
		}
		list($idAcquereurAssocie,$name,$firstname,$adress,$phone,$cellPhone,$workPhone,$fax,$email,$comment,$city,$acquereur,$titreAcquereur,$maidenName,$birthdate,$birthLocation,$nationality,$job) = $values;

		// Construire le/la acquereurAssocie
		return isset(AcquereurAssocie::$easyload[$idAcquereurAssocie.'-'.$name.'-'.$firstname.'-'.$adress.'-'.$phone.'-'.$cellPhone.'-'.$workPhone.'-'.$fax.'-'.$email.'-'.$comment.'-'.$city.'-'.$acquereur.'-'.$titreAcquereur.'-'.$maidenName.'-'.$birthdate.'-'.$birthLocation.'-'.$nationality.'-'.$job]) ? AcquereurAssocie::$easyload[$idAcquereurAssocie.'-'.$name.'-'.$firstname.'-'.$adress.'-'.$phone.'-'.$cellPhone.'-'.$workPhone.'-'.$fax.'-'.$email.'-'.$comment.'-'.$city.'-'.$acquereur.'-'.$titreAcquereur.'-'.$maidenName.'-'.strtotime($birthdate).'-'.$birthLocation.'-'.$nationality.'-'.$job] :
		new AcquereurAssocie($pdo,$idAcquereurAssocie,$name,$firstname,$adress,$phone,$cellPhone,$workPhone,$fax,$email,$comment,$city,$acquereur,$titreAcquereur, $maidenName,strtotime($birthdate),$birthLocation,$nationality,$job, $easyload);
	}

	/**
	 * Serialiser
	 * @param $serialize bool activer la s�rialisation ?
	 * @return string serialisation du/de la acquereurassocie
	 */
	public function serialize($serialize=true)
	{
		// S�rialiser le/la acquereurAssocie
		$array = array('idAcquereurAssocie' => $this->idAcquereurAssocie,'name' => $this->name,'firstname' => $this->firstname,'adress' => $this->adress,'phone' => $this->phone,'cellPhone' => $this->cellPhone,'workPhone' => $this->workPhone,'fax' => $this->fax,'email' => $this->email,'comment' => $this->comment,'city' => $this->city,'acquereur' => $this->acquereur,'titreAcquereur' => $this->titreAcquereur,'maidenName'=> $this->maidenName,'birthdate'=> $this->birthdate,'birthLocation'=> $this->birthLocation,'nationality'=> $this->nationality,'job'=> $this->job);

		// Retourner la serialisation (ou pas) du/de la acquereurAssocie
		return $serialize ? serialize($array) : $array;
	}

	/**
	 * D�s�rialiser
	 * @param $pdo PDO
	 * @param $string string serialisation du/de la acquereurassocie
	 * @param $easyload bool activer le chargement rapide ?
	 * @return AcquereurAssocie
	 */
	public static function unserialize(PDO $pdo,$string,$easyload=true)
	{
		// D�s�rialiser la chaine de caract�res
		$array = unserialize($string);

		// Construire le/la acquereurAssocie
		return isset(AcquereurAssocie::$easyload[$array['idAcquereurAssocie']]) ? AcquereurAssocie::$easyload[$array['idAcquereurAssocie']] :
		new AcquereurAssocie($pdo,$array['idAcquereurAssocie'],$array['name'],$array['firstname'],$array['adress'],$array['phone'],$array['cellPhone'],$array['workPhone'],$array['fax'],$array['email'],$array['comment'],$array['city'],$array['acquereur'],$array['titreAcquereur'],$array['maidenName'],$array['birthdate'],$array['birthLocation'],$array['nationality'],$array['job'],$easyload);
	}

	/**
	 * Test d'�galit�
	 * @param $acquereurAssocie AcquereurAssocie
	 * @return bool les objets sont ils �gaux ?
	 */
	public function equals($acquereurAssocie)
	{
		// Test si null
		if ($acquereurAssocie == null) {
			return false;
		}

		// Tester la classe
		if (!($acquereurAssocie instanceof AcquereurAssocie)) {
			return false;
		}

		// Tester les ids
		return $this->idAcquereurAssocie == $acquereurAssocie->idAcquereurAssocie;
	}

	/**
	 * Compter les acquereurAssocies
	 * @param $pdo PDO
	 * @return int nombre de acquereurassocies
	 */
	public static function count(PDO $pdo)
	{
		if (!($pdoStatement = $pdo->query('SELECT COUNT(idAcquereurAssocie) FROM AcquereurAssocie'))) {
			throw new Exception('Erreur lors du comptage des acquereurAssocies dans la base de donn�es');
		}
		return $pdoStatement->fetchColumn();
	}

	/**
	 * Supprimer le/la acquereurAssocie
	 * @return bool op�ration r�ussie ?
	 */
	public function delete()
	{
		// Supprimer le/la acquereurAssocie
		$pdoStatement = $this->pdo->prepare('DELETE FROM AcquereurAssocie WHERE idAcquereurAssocie = ?');
		if (!$pdoStatement->execute(array($this->getIdAcquereurAssocie()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) acquereurAssocie dans la base de donn�es');
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
		$pdoStatement = $this->pdo->prepare('UPDATE AcquereurAssocie SET '.implode(', ', $updates).' WHERE idAcquereurAssocie = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdAcquereurAssocie())))) {
			throw new Exception('Erreur lors de la mise � jour d\'un champ d\'un(e) acquereurAssocie dans la base de donn�es');
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
		return $this->_set(
		array('name','firstname','adress','phone','cellPhone','workPhone','fax','email','comment','city_idCity','acquereur_idAcquereur','titreAcquereur_idTitreAcquereur','maidenName','birthdate','birthLocation','nationality','job'),
		array($this->name,$this->firstname,$this->adress,$this->phone,$this->cellPhone,$this->workPhone,$this->fax,$this->email,$this->comment,$this->city,$this->acquereur,$this->titreAcquereur,$this->maidenName,$this->birthdate!=null?date('Y-m-d',$this->birthdate):null,$this->birthLocation,$this->nationality,$this->job));
	}

	/**
	 * R�cup�rer le/la idAcquereurAssocie
	 * @return int
	 */
	public function getIdAcquereurAssocie()
	{
		return $this->idAcquereurAssocie;
	}
	public function getId()
	{
		return $this->idAcquereurAssocie;
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
	 * R�cup�rer le/la firstname
	 * @return string
	 */
	public function getFirstname()
	{
		return $this->firstname;
	}

	/**
	 * D�finir le/la firstname
	 * @param $firstname string
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setFirstname($firstname,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->firstname = $firstname;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('firstname'),array($firstname)) : true;
	}

	/**
	 * R�cup�rer le/la adress
	 * @return string
	 */
	public function getAdress()
	{
		return $this->adress;
	}
	public function getAddress()
	{
		return $this->adress;
	}
	/**
	 * D�finir le/la adress
	 * @param $adress string
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setAdress($adress,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->adress = $adress;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('adress'),array($adress)) : true;
	}

	/**
	 * R�cup�rer le/la phone
	 * @return string
	 */
	public function getPhone()
	{
		return $this->phone;
	}

	/**
	 * D�finir le/la phone
	 * @param $phone string
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setPhone($phone,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->phone = $phone;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('phone'),array($phone)) : true;
	}

	/**
	 * R�cup�rer le/la cellPhone
	 * @return string
	 */
	public function getCellPhone()
	{
		return $this->cellPhone;
	}

	/**
	 * D�finir le/la cellPhone
	 * @param $cellPhone string
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setCellPhone($cellPhone,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->cellPhone = $cellPhone;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('cellPhone'),array($cellPhone)) : true;
	}

	/**
	 * R�cup�rer le/la workPhone
	 * @return string
	 */
	public function getWorkPhone()
	{
		return $this->workPhone;
	}

	/**
	 * D�finir le/la workPhone
	 * @param $workPhone string
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setWorkPhone($workPhone,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->workPhone = $workPhone;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('workPhone'),array($workPhone)) : true;
	}

	/**
	 * R�cup�rer le/la fax
	 * @return string
	 */
	public function getFax()
	{
		return $this->fax;
	}

	/**
	 * D�finir le/la fax
	 * @param $fax string
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setFax($fax,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->fax = $fax;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('fax'),array($fax)) : true;
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
	 * R�cup�rer le/la comment
	 * @return string
	 */
	public function getComment()
	{
		return $this->comment;
	}

	/**
	 * D�finir le/la comment
	 * @param $comment string
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setComment($comment,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->comment = $comment;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('comment'),array($comment)) : true;
	}

	/**
	 * R�cup�rer le/la city
	 * @return City
	 */
	public function getCity()
	{
		return City::load($this->pdo,$this->city);
	}

	/**
	 * D�finir le/la city
	 * @param $city City
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setCity(City $city,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->city = $city->getIdCity();

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('city_idCity'),array($city->getIdCity())) : true;
	}

	/**
	 * S�lectionner les acquereurAssocies par city
	 * @param $pdo PDO
	 * @param $city City
	 * @return PDOStatement
	 */
	public static function selectByCity(PDO $pdo,City $city)
	{
		$pdoStatement = $pdo->prepare('SELECT a.idAcquereurAssocie, a.name, a.firstname, a.adress, a.phone, a.cellPhone, a.workPhone, a.fax, a.email, a.comment, a.city_idCity, a.acquereur_idAcquereur, a.titreAcquereur_idTitreAcquereur, a.maidenName,a.birthdate,a.birthLocation,a.nationality,a.job FROM AcquereurAssocie a WHERE a.city_idCity = ?');
		if (!$pdoStatement->execute(array($city->getIdCity()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les acquereurAssocies par city depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�rer le/la acquereur
	 * @return Acquereur
	 */
	public function getAcquereur()
	{
		return Acquereur::load($this->pdo,$this->acquereur);
	}

	/**
	 * D�finir le/la acquereur
	 * @param $acquereur Acquereur
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setAcquereur(Acquereur $acquereur,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->acquereur = $acquereur->getIdAcquereur();

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('acquereur_idAcquereur'),array($acquereur->getIdAcquereur())) : true;
	}

	/**
	 * S�lectionner les acquereurAssocies par acquereur
	 * @param $pdo PDO
	 * @param $acquereur Acquereur
	 * @return PDOStatement
	 */
	public static function selectByAcquereur(PDO $pdo,Acquereur $acquereur)
	{
		$pdoStatement = $pdo->prepare('SELECT a.idAcquereurAssocie, a.name, a.firstname, a.adress, a.phone, a.cellPhone, a.workPhone, a.fax, a.email, a.comment, a.city_idCity, a.acquereur_idAcquereur, a.titreAcquereur_idTitreAcquereur, a.maidenName,a.birthdate,a.birthLocation,a.nationality,a.job FROM AcquereurAssocie a WHERE a.acquereur_idAcquereur = ?');
		if (!$pdoStatement->execute(array($acquereur->getIdAcquereur()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les acquereurAssocies par acquereur depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	public static function loadByAcq(PDO $pdo,Acquereur $acquereur){
		
		$pdoStatement = AcquereurAssocie::selectByAcquereur($pdo,$acquereur);
		
		// Mettre chaque acquereurAssocie dans un tableau
		$acquereurAssocies = array();
		while ($acquereurAssocie = AcquereurAssocie::fetch($pdo,$pdoStatement,$easyload)) {
			$acquereurAssocies[] = $acquereurAssocie;
		}
		
		// Retourner le tableau
		return $acquereurAssocies;
	}
	/**
	 * R�cup�rer le/la titreAcquereur
	 * @return TitreAcquereur
	 */
	public function getTitreAcquereur()
	{
		return TitreAcquereur::load($this->pdo,$this->titreAcquereur);
	}

	/**
	 * D�finir le/la titreAcquereur
	 * @param $titreAcquereur TitreAcquereur
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setTitreAcquereur(TitreAcquereur $titreAcquereur,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->titreAcquereur = $titreAcquereur->getIdTitreAcquereur();

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('titreAcquereur_idTitreAcquereur'),array($titreAcquereur->getIdTitreAcquereur())) : true;
	}

	/**
	 * S�lectionner les acquereurAssocies par titreAcquereur
	 * @param $pdo PDO
	 * @param $titreAcquereur TitreAcquereur
	 * @return PDOStatement
	 */
	public static function selectByTitreAcquereur(PDO $pdo,TitreAcquereur $titreAcquereur)
	{
		$pdoStatement = $pdo->prepare('SELECT a.idAcquereurAssocie, a.name, a.firstname, a.adress, a.phone, a.cellPhone, a.workPhone, a.fax, a.email, a.comment, a.city_idCity, a.acquereur_idAcquereur, a.titreAcquereur_idTitreAcquereur, a.maidenName,a.birthdate,a.birthLocation,a.nationality,a.job FROM AcquereurAssocie a WHERE a.titreAcquereur_idTitreAcquereur = ?');
		if (!$pdoStatement->execute(array($titreAcquereur->getIdTitreAcquereur()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les acquereurAssocies par titreAcquereur depuis la base de donn�es');
		}
		return $pdoStatement;
	}
	/**
	 * ToString
	 * @return string repr�sentation de acquereurassocie sous la forme d'un string
	 */
	public function __toString()
	{
		return '[AcquereurAssocie idAcquereurAssocie="'.$this->idAcquereurAssocie.'" name="'.$this->name.'" firstname="'.$this->firstname.'" adress="'.$this->adress.'" phone="'.$this->phone.'" cellPhone="'.$this->cellPhone.'" workPhone="'.$this->workPhone.'" fax="'.$this->fax.'" email="'.$this->email.'" comment="'.$this->comment.'" city="'.$this->city.'" acquereur="'.$this->acquereur.'" titreAcquereur="'.$this->titreAcquereur.'"]';
	}


	
	
	/**
	* R�cup�rer le/la maidenName
	* @return string
	*/
	public function getMaidenName()
	{
		return $this->maidenName;
	}
	
	/**
	 * D�finir le/la maidenName
	 * @param $maidenName string
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setMaidenName($maidenName,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->maidenName = $maidenName;
	
		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('maidenName'),array($maidenName)) : true;
	}
	
	
	/**
	 * R�cup�rer le/la birthdate
	 * @return int
	 */
	public function getBirthdate()
	{
		return $this->birthdate;
	}
	
	/**
	 * D�finir le/la birthdate
	 * @param birthdate int
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setBirthdate($birthdate=null ,$execute=true)
	{
		$birthdate==''?null:$birthdate;
		// Sauvegarder dans l'objet
		$this->birthdate = $birthdate;
		
		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('birthdate'),array(  $birthdate=== null?null: date('Y-m-d',$birthdate)    )) : true;
	}
	
	/**
	 * R�cup�rer le/la birthLocation
	 * @return string
	 */
	public function getBirthLocation()
	{
		return $this->birthLocation;
	}
	
	/**
	 * D�finir le/la birthLocation
	 * @param $birthLocation string
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setBirthLocation($birthLocation,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->birthLocation = $birthLocation;
	
		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('birthLocation'),array($birthLocation)) : true;
	}
	
	/**
	 * R�cup�rer le/la nationality
	 * @return string
	 */
	public function getNationality()
	{
		return $this->nationality;
	}
	
	/**
	 * D�finir le/la nationality
	 * @param $nationality string
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setNationality($nationality,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->nationality = $nationality;
	
		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('nationality'),array($nationality)) : true;
	}
	/**
	 * R�cup�rer le/la job
	 * @return string
	 */
	public function getJob()
	{
		return $this->job;
	}
	
	/**
	 * D�finir le/la job
	 * @param $job string
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setJob($job,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->job = $job;
	
		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('job'),array($job)) : true;
	}
	
	
	
	
	public static function createTableIfNotExist(PDO $pdo){
		try {
			// Si la table n'existe pas, la creer.
// 			 $this->_pdo->exec("SELECT idAcquereurAssocie FROM AcquereurAssocie LIMIT 1");
			$pdoStatement = $pdo->query('SELECT idAcquereurAssocie FROM AcquereurAssocie LIMIT 1') ;
				
			
			
			
		} catch (PDOException $e) {
				
		 $pdo->prepare("CREATE TABLE AcquereurAssocie (
			idAcquereurAssocie               INT AUTO_INCREMENT NOT NULL,
			name                             VARCHAR(250) NOT NULL,
			firstname                        VARCHAR(250) NOT NULL,
			adress                           VARCHAR(250) NOT NULL,
			phone                            VARCHAR(250) NOT NULL,
			cellPhone                        VARCHAR(250) NOT NULL,
			workPhone                        VARCHAR(250) NOT NULL,
			fax                              VARCHAR(250) NOT NULL,
			email                            VARCHAR(250) NOT NULL,
			comment                          TEXT(500) NOT NULL,
			city_idCity                      INT NOT NULL,
			acquereur_idAcquereur            INT NOT NULL,
			titreAcquereur_idTitreAcquereur  INT NOT NULL,
			PRIMARY KEY (idAcquereurAssocie),
			FOREIGN KEY (city_idCity) REFERENCES City (idCity),
			FOREIGN KEY (acquereur_idAcquereur) REFERENCES Acquereur (idAcquereur),
			FOREIGN KEY (titreAcquereur_idTitreAcquereur) REFERENCES TitreAcquereur (idTitreAcquereur))
		ENGINE = MYISAM CHARACTER SET UTF8;")->exec();
		}
	}
}


