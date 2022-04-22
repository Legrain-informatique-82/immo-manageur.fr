<?php

/**
 * @class User
 * @date 20/01/2011 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class User
{
	/// @var PDO
	private $pdo;

	/// @var array tableau pour le chargement rapide
	private static $easyload;

	/// @var int
	private $idUser;

	/// @var string
	private $identifiant;

	/// @var string
	private $password;

	/// @var string
	private $name;

	/// @var string
	private $firstname;

	/// @var string
	private $email;

	/// @var int
	private $registration_date;

	/// @var int
	private $numberUsed;

	/// @var int id de levelmember
	private $levelMember;

	/// @var int id de agency
	private $agency;

	/**
	 * Construire un(e) user
	 * @param $pdo PDO
	 * @param $idUser int
	 * @param $identifiant string
	 * @param $password string
	 * @param $name string
	 * @param $firstname string
	 * @param $email string
	 * @param $registration_date int
	 * @param $numberUsed int
	 * @param $levelMember int id de levelmember
	 * @param $agency int id de agency
	 * @param $easyload bool activer le chargement rapide ?
	 * @return User
	 */
	protected function __construct(PDO $pdo,$idUser,$identifiant,$password,$name,$firstname,$email,$registration_date,$numberUsed,$levelMember,$agency,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;

		// Sauvegarder les attributs
		$this->idUser = $idUser;
		$this->identifiant = $identifiant;
		$this->password = $password;
		$this->name = $name;
		$this->firstname = $firstname;
		$this->email = $email;
		$this->registration_date = $registration_date;
		$this->numberUsed = $numberUsed;
		$this->levelMember = $levelMember;
		$this->agency = $agency;

		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			User::$easyload[$idUser] = $this;
		}
	}

	/**
	 * Cr�er un(e) user
	 * @param $pdo PDO
	 * @param $identifiant string
	 * @param $password string
	 * @param $name string
	 * @param $firstname string
	 * @param $email string
	 * @param $registration_date int
	 * @param $levelMember LevelMember
	 * @param $agency Agency
	 * @param $easyload bool activer le chargement rapide ?
	 * @return User
	 */
	public static function create(PDO $pdo,$identifiant,$password,$name,$firstname,$email,$registration_date,$numberUsed,LevelMember $levelMember,Agency $agency,$easyload=true)
	{
		// Ajouter le/la user dans la base de donn�es
		$pdoStatement = $pdo->prepare('INSERT INTO User (identifiant,password,name,firstname,email,registration_date,numberUsed,levelMember_idLevelMember,agency_idAgency) VALUES (?,?,?,?,?,?,?,?,?)');
		if (!$pdoStatement->execute(array($identifiant,$password,$name,$firstname,$email,date('Y-m-d H:i:s',$registration_date),$numberUsed,$levelMember->getIdLevelMember(),$agency->getIdAgency()))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) user dans la base de donn�es');
		}

		// Construire le/la user
		return new User($pdo,$pdo->lastInsertId(),$identifiant,$password,$name,$firstname,$email,$registration_date,$numberUsed,$levelMember->getIdLevelMember(),$agency->getIdAgency(),$easyload);
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
		return $pdo->prepare('SELECT u.idUser, u.identifiant, u.password, u.name, u.firstname, u.email, u.registration_date, u.numberUsed ,u.levelMember_idLevelMember, u.agency_idAgency FROM User u '.
		($where != null ? ' WHERE '.$where : '').
		($orderby != null ? ' ORDER BY '.$orderby : '').
		($limit != null ? ' LIMIT '.$limit : ''));
	}

	/**
	 * Charger un(e) user
	 * @param $pdo PDO
	 * @param $idUser int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return User
	 */
	public static function load(PDO $pdo,$idUser,$easyload=true)
	{
		// D�j� charg�(e) ?
		if (isset(User::$easyload[$idUser])) {
			return User::$easyload[$idUser];
		}

		// Charger le/la user
		$pdoStatement = User::_select($pdo,'u.idUser = ?');
		if (!$pdoStatement->execute(array($idUser))) {
			throw new Exception('Erreur lors du chargement d\'un(e) user depuis la base de donn�es');
		}

		// R�cup�rer le/la user depuis le jeu de r�sultats
		return User::fetch($pdo,$pdoStatement,$easyload);
	}


	/**
	 * Charger un(e) user
	 * @param $pdo PDO
	 * @param $idUser int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return User
	 */
	public static function loadByIdentifiant(PDO $pdo,$identifiant,$easyload=true)
	{


		// Charger le/la user
		$pdoStatement = User::_select($pdo,'u.identifiant = ?');
		if (!$pdoStatement->execute(array($identifiant))) {
			throw new Exception('Erreur lors du chargement d\'un(e) user depuis la base de donn�es');
		}

		// R�cup�rer le/la user depuis le jeu de r�sultats
		return User::fetch($pdo,$pdoStatement,$easyload);
	}

	/**
	 * Charger tous/toutes les users
	 * @param $pdo PDO
	 * @param $easyload bool activer le chargement rapide ?
	 * @return User[] tableau de users
	 */
	public static function loadAll(PDO $pdo,$easyload=false)
	{
		// S�lectionner tous/toutes les users
		$pdoStatement = User::selectAll($pdo);

		// Mettre chaque user dans un tableau
		$users = array();
		while ($user = User::fetch($pdo,$pdoStatement,$easyload)) {
			$users[] = $user;
		}

		// Retourner le tableau
		return $users;
	}

	/**
	 * S�lectionner tous/toutes les users
	 * @param $pdo PDO
	 * @return PDOStatement
	 */
	public static function selectAll(PDO $pdo)
	{
		$pdoStatement = User::_select($pdo);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les users depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�re le/la user suivant(e) d'un jeu de r�sultats
	 * @param $pdo PDO
	 * @param $pdoStatement PDOStatement
	 * @param $easyload bool activer le chargement rapide ?
	 * @return User
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idUser,$identifiant,$password,$name,$firstname,$email,$registration_date,$numberUsed,$levelMember,$agency) = $values;

		// Construire le/la user
		return isset(User::$easyload[$idUser.'-'.$identifiant.'-'.$password.'-'.$name.'-'.$firstname.'-'.$email.'-'.strtotime($registration_date).'-'.$numberUsed.'-'.$levelMember.'-'.$agency]) ? User::$easyload[$idUser.'-'.$identifiant.'-'.$password.'-'.$name.'-'.$firstname.'-'.$email.'-'.strtotime($registration_date).'-'.$numberUsed.'-'.$levelMember.'-'.$agency] :
		new User($pdo,$idUser,$identifiant,$password,$name,$firstname,$email,strtotime($registration_date),$numberUsed,$levelMember,$agency,$easyload);
	}

	/**
	 * Serialiser
	 * @param $serialize bool activer la s�rialisation ?
	 * @return string serialisation du/de la user
	 */
	public function serialize($serialize=true)
	{
		// S�rialiser le/la user
		$array = array('idUser' => $this->idUser,'identifiant' => $this->identifiant,'password' => $this->password,'name' => $this->name,'firstname' => $this->firstname,'email' => $this->email,'registration_date' => $this->registration_date,'numberUsed' => $this->numberUsed,'levelMember' => $this->levelMember,'agency' => $this->agency);

		// Retourner la serialisation (ou pas) du/de la user
		return $serialize ? serialize($array) : $array;
	}

	/**
	 * D�s�rialiser
	 * @param $pdo PDO
	 * @param $string string serialisation du/de la user
	 * @param $easyload bool activer le chargement rapide ?
	 * @return User
	 */
	public static function unserialize(PDO $pdo,$string,$easyload=true)
	{
		// D�s�rialiser la chaine de caract�res
		$array = unserialize($string);

		// Construire le/la user
		return isset(User::$easyload[$array['idUser']]) ? User::$easyload[$array['idUser']] :
		new User($pdo,$array['idUser'],$array['identifiant'],$array['password'],$array['name'],$array['firstname'],$array['email'],$array['registration_date'],$array['numberUsed'],$array['levelMember'],$array['agency'],$easyload);
	}

	/**
	 * Test d'�galit�
	 * @param $user User
	 * @return bool les objets sont ils �gaux ?
	 */
	public function equals($user)
	{
		// Test si null
		if ($user == null) { return false; }

		// Tester la classe
		if (!($user instanceof User)) { return false; }

		// Tester les ids
		return $this->idUser == $user->idUser;
	}

	/**
	 * Compter les users
	 * @param $pdo PDO
	 * @return int nombre de users
	 */
	public static function count(PDO $pdo,$where =null)
	{
		$sql = 'SELECT COUNT(idUser) FROM User';
		$sql.= $where!=null?" WHERE $where ":'';
		if (!($pdoStatement = $pdo->query($sql))) {
			throw new Exception('Erreur lors du comptage des users dans la base de donn�es');
		}
		return $pdoStatement->fetchColumn();
	}

	/**
	 * Supprimer le/la user
	 * @return bool op�ration r�ussie ?
	 */
	public function delete()
	{
		// Supprimer les Logs associ�(e)s
		$select = $this->selectLogs();
		while ($log = Log::fetch($this->pdo,$select)) {
			if (!$log->delete()) { return false; }
		}

		// Supprimer les HistoricConnections associ�(e)s
		$select = $this->selectHistoricConnections();
		while ($historicConnection = HistoricConnection::fetch($this->pdo,$select)) {
			if (!$historicConnection->delete()) { return false; }
		}

		// Supprimer le/la user
		$pdoStatement = $this->pdo->prepare('DELETE FROM User WHERE idUser = ?');
		if (!$pdoStatement->execute(array($this->getIdUser()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) user dans la base de donn�es');
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
		$pdoStatement = $this->pdo->prepare('UPDATE User SET '.implode(', ', $updates).' WHERE idUser = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdUser())))) {
			throw new Exception('Erreur lors de la mise � jour d\'un champ d\'un(e) user dans la base de donn�es');
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
		return $this->_set(array('identifiant','password','name','firstname','email','registration_date','numberUsed','levelMember_idLevelMember','agency_idAgency'),array($this->identifiant,$this->password,$this->name,$this->firstname,$this->email,date('Y-m-d H:i:s',$this->registration_date),$this->numberUsed,$this->levelMember,$this->agency));
	}

	/**
	 * R�cup�rer le/la idUser
	 * @return int
	 */
	public function getIdUser()
	{
		return $this->idUser;
	}
	public function getId()
	{
		return $this->idUser;
	}
	/**
	 * R�cup�rer le/la identifiant
	 * @return string
	 */
	public function getIdentifiant()
	{
		return $this->identifiant;
	}

	/**
	 * D�finir le/la identifiant
	 * @param $identifiant string
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setIdentifiant($identifiant,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->identifiant = $identifiant;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('identifiant'),array($identifiant)) : true;
	}

	/**
	 * R�cup�rer le/la password
	 * @return string
	 */
	public function getPassword()
	{
		return $this->password;
	}

	/**
	 * D�finir le/la password
	 * @param $password string
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setPassword($password,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->password = $password;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('password'),array($password)) : true;
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
	 * R�cup�rer le/la registration_date
	 * @return int
	 */
	public function getRegistration_date()
	{
		return $this->registration_date;
	}

	/**
	 * D�finir le/la registration_date
	 * @param $registration_date int
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setRegistration_date($registration_date,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->registration_date = $registration_date;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('registration_date'),array(date('Y-m-d H:i:s',$registration_date))) : true;
	}

	/**
	 * R�cup�rer le/la numberUsede
	 * @return int
	 */
	public function getNumberUsed()
	{
		return $this->numberUsed;
	}

	/**
	 * D�finir le/la numberUsed
	 * @param $numberUsed int
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setNumberUsed($numberUsed,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->numberUsed = $rnumberUsed;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('numberUsed'),array($numberUsed)) : true;
	}






	/**
	 * R�cup�rer le/la levelMember
	 * @return LevelMember
	 */
	public function getLevelMember()
	{
		return LevelMember::load($this->pdo,$this->levelMember);
	}

	/**
	 * D�finir le/la levelMember
	 * @param $levelMember LevelMember
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setLevelMember(LevelMember $levelMember,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->levelMember = $levelMember->getIdLevelMember();

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('levelMember_idLevelMember'),array($levelMember->getIdLevelMember())) : true;
	}

	/**
	 * S�lectionner les users par levelMember
	 * @param $pdo PDO
	 * @param $levelMember LevelMember
	 * @return PDOStatement
	 */
	public static function selectByLevelMember(PDO $pdo,LevelMember $levelMember)
	{
		$pdoStatement = $pdo->prepare('SELECT u.idUser, u.identifiant, u.password, u.name, u.firstname, u.email, u.registration_date, u.levelMember_idLevelMember, u.agency_idAgency FROM User u WHERE u.levelMember_idLevelMember = ?');
		if (!$pdoStatement->execute(array($levelMember->getIdLevelMember()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les users par levelMember depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�rer le/la agency
	 * @return Agency
	 */
	public function getAgency()
	{
		return Agency::load($this->pdo,$this->agency);
	}

	/**
	 * D�finir le/la agency
	 * @param $agency Agency
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setAgency(Agency $agency,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->agency = $agency->getIdAgency();

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('agency_idAgency'),array($agency->getIdAgency())) : true;
	}

	/**
	 * S�lectionner les users par agency
	 * @param $pdo PDO
	 * @param $agency Agency
	 * @return PDOStatement
	 */
	public static function selectByAgency(PDO $pdo,Agency $agency)
	{
		$pdoStatement = $pdo->prepare('SELECT u.idUser, u.identifiant, u.password, u.name, u.firstname, u.email, u.registration_date, u.levelMember_idLevelMember, u.agency_idAgency FROM User u WHERE u.agency_idAgency = ?');
		if (!$pdoStatement->execute(array($agency->getIdAgency()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les users par agency depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * S�lectionner les logs
	 * @return PDOStatement
	 */
	public function selectLogs()
	{
		return Log::selectByUser($this->pdo,$this);
	}

	/**
	 * S�lectionner les historicConnections
	 * @return PDOStatement
	 */
	public function selectHistoricConnections()
	{
		return HistoricConnection::selectByUser($this->pdo,$this);
	}
	/**
	 * ToString
	 * @return string repr�sentation de user sous la forme d'un string
	 */
	public function __toString()
	{
		return '[User idUser="'.$this->idUser.'" identifiant="'.$this->identifiant.'" password="'.$this->password.'" name="'.$this->name.'" firstname="'.$this->firstname.'" email="'.$this->email.'" registration_date="'.date('d/m/Y H:i:s',$this->registration_date).'" levelMember="'.$this->levelMember.'" agency="'.$this->agency.'"]';
	}

}

?>
