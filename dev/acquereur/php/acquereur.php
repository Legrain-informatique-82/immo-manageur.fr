<?php

/**
 * @class Acquereur
 * @date 21/03/2011 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class Acquereur
{
	/// @var PDO
	private $pdo;

	/// @var array tableau pour le chargement rapide
	private static $easyload;

	/// @var int
	private $idAcquereur;

	/// @var string
	private $name;

	/// @var string
	private $firstname;

	/// @var string
	private $address;

	/// @var string
	private $phone;

	/// @var string
	private $mobilPhone;

	/// @var string
	private $workPhone;

	/// @var string
	private $fax;

	/// @var string
	private $email;

	/// @var int
	private $numberUsed;

	/// @var bool
	private $actif;

	/// @var int
	private $priceMin;

	/// @var int
	private $priceMax;

	/// @var int
	private $surfaceTerrainMin;

	/// @var int
	private $surfaceTerrainMax;

	/// @var int
	private $surfaceHabitableMin;

	/// @var int
	private $surfaceHabitableMax;

	/// @var int id de city
	private $villeAcquereur;

	/// @var int id de titreacquereur
	private $titreAcquereur;

	/// @var int id de transactiontype
	private $transactionType;

	/// @var int id de user
	private $user;

	/// @var int id de mandatestyle
	private $mandateStyle;

	/// @var int id de recherchecity
	private $rechercheCity;

	/// @var int id de recherchesector
	private $rechercheSector;



	/**
	 * Construire un(e) acquereur
	 * @param $pdo PDO
	 * @param $idAcquereur int
	 * @param $name string
	 * @param $firstname string
	 * @param $address string
	 * @param $phone string
	 * @param $mobilPhone string
	 * @param $workPhone string
	 * @param $fax string
	 * @param $email string
	 * @param $numberUsed int
	 * @param $priceMin int
	 * @param $priceMax int
	 * @param $surfaceTerrainMin int
	 * @param $surfaceTerrainMax int
	 * @param $surfaceHabitableMin int
	 * @param $surfaceHabitableMax int
	 * @param $villeAcquereur int
	 * @param $titreAcquereur int id de titreacquereur
	 * @param $transactionType int id de transactiontype
	 * @param $mandateStyle int id de mandatestyle
	 * @param $actif bool
	 * @param $rechercheCity int id de recherchecity
	 * @param $rechercheSector int id de recherchesector
	 * @param $user int id de user
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Acquereur
	 */
	protected function __construct(PDO $pdo,$idAcquereur,$name,$firstname,$address,$phone,$mobilPhone,$workPhone,$fax,$email,$numberUsed,$priceMin,$priceMax,$surfaceTerrainMin,$surfaceTerrainMax,$surfaceHabitableMin,$surfaceHabitableMax,$villeAcquereur,$titreAcquereur,$transactionType,$user,$mandateStyle = null,$actif=false,$rechercheCity=null,$rechercheSector=null,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;

		// Sauvegarder les attributs
		$this->idAcquereur = $idAcquereur;
		$this->name = $name;
		$this->firstname = $firstname;
		$this->address = $address;
		$this->phone = $phone;
		$this->mobilPhone = $mobilPhone;
		$this->workPhone = $workPhone;
		$this->fax = $fax;
		$this->email = $email;
		$this->numberUsed = $numberUsed;
		$this->priceMin = $priceMin;
		$this->priceMax = $priceMax;
		$this->surfaceTerrainMin = $surfaceTerrainMin;
		$this->surfaceTerrainMax = $surfaceTerrainMax;
		$this->surfaceHabitableMin = $surfaceHabitableMin;
		$this->surfaceHabitableMax = $surfaceHabitableMax;
		$this->villeAcquereur = $villeAcquereur;
		$this->titreAcquereur = $titreAcquereur;
		$this->transactionType = $transactionType;
		$this->user = $user;
		$this->mandateStyle = $mandateStyle;
		$this->actif = $actif;
		$this->rechercheCity = $rechercheCity;
		$this->rechercheSector = $rechercheSector;

		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			Acquereur::$easyload[$idAcquereur] = $this;
		}
	}

	/**
	 * Cr�er un(e) acquereur
	 * @param $pdo PDO
	 * @param $name string
	 * @param $firstname string
	 * @param $address string
	 * @param $phone string
	 * @param $mobilPhone string
	 * @param $workPhone string
	 * @param $fax string
	 * @param $email string
	 * @param $numberUsed int
	 * @param $priceMin int
	 * @param $priceMax int
	 * @param $surfaceTerrainMin int
	 * @param $surfaceTerrainMax int
	 * @param $surfaceHabitableMin int
	 * @param $surfaceHabitableMax int
	 * @param $villeAcquereur int
	 * @param $titreAcquereur TitreAcquereur
	 * @param $transactionType TransactionType
	 * @param $mandateStyle MandateStyle
	 * @param $actif bool
	 * @param $rechercheCity City
	 * @param $rechercheSector Sector
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Acquereur
	 */
	public static function create(PDO $pdo,$name,$firstname,$address,$phone,$mobilPhone,$workPhone,$fax,$email,$numberUsed,$priceMin,$priceMax,$surfaceTerrainMin,$surfaceTerrainMax,$surfaceHabitableMin,$surfaceHabitableMax,City $villeAcquereur,TitreAcquereur $titreAcquereur,TransactionType $transactionType,User $user,MandateStyle $mandateStyle=null,$actif=false,$rechercheCity=null,$rechercheSector=null,$easyload=true)
	{
		// Ajouter le/la acquereur dans la base de donn�es
		$pdoStatement = $pdo->prepare('INSERT INTO Acquereur (name,firstname,address,phone,mobilPhone,workPhone,fax,email,numberUsed,priceMin,
		priceMax,surfaceTerrainMin,surfaceTerrainMax,surfaceHabitableMin,surfaceHabitableMax,villeAcquereur,titreAcquereur_idTitreAcquereur,transactionType_idTransactionType,
		user_idUser,mandateStyle_idMandateStyle,actif,rechercheCity_idCity,rechercheSector_idSector)
		 VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
		// 23 aussi
		if (!$pdoStatement->execute(
		array($name,$firstname,$address,$phone,$mobilPhone,$workPhone,$fax,$email,$numberUsed,$priceMin,$priceMax,$surfaceTerrainMin //12
		,$surfaceTerrainMax,$surfaceHabitableMin,$surfaceHabitableMax,$villeAcquereur->getIdCity(),$titreAcquereur->getIdTitreAcquereur(),//5
		$transactionType->getIdTransactionType(),$user->getIdUser(),$mandateStyle==null?null:$mandateStyle->getIdMandateStyle(), //3
		$actif,$rechercheCity == null ? null : $rechercheCity->getIdCity(),$rechercheSector == null ? null : $rechercheSector->getIdSector()))) { //3
			throw new Exception('Erreur durant l\'insertion d\'un(e) acquereur dans la base de donn�es');
			//				var_dump( $pdo->errorInfo() );
			//				var_dump( $pdo->errorCode() );
		}

		// Construire le/la acquereur
		return new Acquereur($pdo,$pdo->lastInsertId(),$name,$firstname,$address,$phone,$mobilPhone,$workPhone,$fax,$email,$numberUsed,$priceMin,$priceMax,$surfaceTerrainMin,$surfaceTerrainMax,$surfaceHabitableMin,$surfaceHabitableMax,$villeAcquereur->getIdCity(),$titreAcquereur->getIdTitreAcquereur(),$transactionType->getIdTransactionType(),$user->getIdUser(),$mandateStyle==null?null:$mandateStyle->getIdMandateStyle(),$actif,$rechercheCity==null?null:$rechercheCity->getIdCity(),$rechercheSector==null?null:$rechercheSector->getIdSector(),$easyload);
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
		return $pdo->prepare('SELECT a.idAcquereur, a.name, a.firstname, a.address, a.phone, a.mobilPhone, a.workPhone, a.fax, a.email, a.numberUsed, a.priceMin, a.priceMax, a.surfaceTerrainMin, a.surfaceTerrainMax, a.surfaceHabitableMin, a.surfaceHabitableMax, a.villeAcquereur, a.titreAcquereur_idTitreAcquereur, a.transactionType_idTransactionType, a.user_idUser, a.mandateStyle_idMandateStyle, a.actif, a.rechercheCity_idCity, a.rechercheSector_idSector FROM Acquereur a '.
		($where != null ? ' WHERE '.$where : '').
		($orderby != null ? ' ORDER BY '.$orderby : '').
		($limit != null ? ' LIMIT '.$limit : ''));
	}

	/**
	 * Charger un(e) acquereur
	 * @param $pdo PDO
	 * @param $idAcquereur int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Acquereur
	 */
	public static function load(PDO $pdo,$idAcquereur,$easyload=true)
	{
		// D�j� charg�(e) ?
		if (isset(Acquereur::$easyload[$idAcquereur])) {
			return Acquereur::$easyload[$idAcquereur];
		}

		// Charger le/la acquereur
		$pdoStatement = Acquereur::_select($pdo,'a.idAcquereur = ?');
		if (!$pdoStatement->execute(array($idAcquereur))) {
			throw new Exception('Erreur lors du chargement d\'un(e) acquereur depuis la base de donn�es');
		}

		// R�cup�rer le/la acquereur depuis le jeu de r�sultats
		return Acquereur::fetch($pdo,$pdoStatement,$easyload);
	}

	/**
	 * Charger tous/toutes les acquereurs
	 * @param $pdo PDO
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Acquereur[] tableau de acquereurs
	 */
	public static function loadAll(PDO $pdo,$easyload=false)
	{
		// S�lectionner tous/toutes les acquereurs
		$pdoStatement = Acquereur::selectAll($pdo);

		// Mettre chaque acquereur dans un tableau
		$acquereurs = array();
		while ($acquereur = Acquereur::fetch($pdo,$pdoStatement,$easyload)) {
			$acquereurs[] = $acquereur;
		}

		// Retourner le tableau
		return $acquereurs;
	}

	/**
	 * S�lectionner tous/toutes les acquereurs
	 * @param $pdo PDO
	 * @return PDOStatement
	 */
	public static function selectAll(PDO $pdo)
	{
		$pdoStatement = Acquereur::_select($pdo);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les acquereurs depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�re le/la acquereur suivant(e) d'un jeu de r�sultats
	 * @param $pdo PDO
	 * @param $pdoStatement PDOStatement
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Acquereur
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idAcquereur,$name,$firstname,$address,$phone,$mobilPhone,$workPhone,$fax,$email,$numberUsed,$priceMin,$priceMax,$surfaceTerrainMin,$surfaceTerrainMax,$surfaceHabitableMin,$surfaceHabitableMax,$villeAcquereur,$titreAcquereur,$transactionType,$user,$mandateStyle,$actif,$rechercheCity,$rechercheSector) = $values;

		// Construire le/la acquereur
		return isset(Acquereur::$easyload[$idAcquereur.'-'.$name.'-'.$firstname.'-'.$address.'-'.$phone.'-'.$mobilPhone.'-'.$workPhone.'-'.$fax.'-'.$email.'-'.$numberUsed.'-'.$priceMin.'-'.$priceMax.'-'.$surfaceTerrainMin.'-'.$surfaceTerrainMax.'-'.$surfaceHabitableMin.'-'.$surfaceHabitableMax.'-'.$villeAcquereur.'-'.$titreAcquereur.'-'.$transactionType.'-'.$user.'-'.$mandateStyle.'-'.$actif.'-'.$rechercheCity.'-'.$rechercheSector]) ? Acquereur::$easyload[$idAcquereur.'-'.$name.'-'.$firstname.'-'.$address.'-'.$phone.'-'.$mobilPhone.'-'.$workPhone.'-'.$fax.'-'.$email.'-'.$numberUsed.'-'.$priceMin.'-'.$priceMax.'-'.$surfaceTerrainMin.'-'.$surfaceTerrainMax.'-'.$surfaceHabitableMin.'-'.$surfaceHabitableMax.'-'.$villeAcquereur.'-'.$titreAcquereur.'-'.$transactionType.'-'.$user.'-'.$mandateStyle.'-'.$actif.'-'.$rechercheCity.'-'.$rechercheSector] :
		new Acquereur($pdo,$idAcquereur,$name,$firstname,$address,$phone,$mobilPhone,$workPhone,$fax,$email,$numberUsed,$priceMin,$priceMax,$surfaceTerrainMin,$surfaceTerrainMax,$surfaceHabitableMin,$surfaceHabitableMax,$villeAcquereur,$titreAcquereur,$transactionType,$user,$mandateStyle,$actif,$rechercheCity,$rechercheSector,$easyload);
	}

	/**
	 * Serialiser
	 * @param $serialize bool activer la s�rialisation ?
	 * @return string serialisation du/de la acquereur
	 */
	public function serialize($serialize=true)
	{
		// S�rialiser le/la acquereur
		$array = array('idAcquereur' => $this->idAcquereur,'name' => $this->name,'firstname' => $this->firstname,'address' => $this->address,'phone' => $this->phone,'mobilPhone' => $this->mobilPhone,'workPhone' => $this->workPhone,'fax' => $this->fax,'email' => $this->email,'numberUsed' => $this->numberUsed,'priceMin' => $this->priceMin,'priceMax' => $this->priceMax,'surfaceTerrainMin' => $this->surfaceTerrainMin,'surfaceTerrainMax' => $this->surfaceTerrainMax,'surfaceHabitableMin' => $this->surfaceHabitableMin,'surfaceHabitableMax' => $this->surfaceHabitableMax,'villeAcquereur' => $this->villeAcquereur,'titreAcquereur' => $this->titreAcquereur,'transactionType' => $this->transactionType,'user' => $this->user,'mandateStyle' => $this->mandateStyle,'actif' => $this->actif,'rechercheCity' => $this->rechercheCity,'rechercheSector' => $this->rechercheSector);

		// Retourner la serialisation (ou pas) du/de la acquereur
		return $serialize ? serialize($array) : $array;
	}

	/**
	 * D�s�rialiser
	 * @param $pdo PDO
	 * @param $string string serialisation du/de la acquereur
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Acquereur
	 */
	public static function unserialize(PDO $pdo,$string,$easyload=true)
	{
		// D�s�rialiser la chaine de caract�res
		$array = unserialize($string);

		// Construire le/la acquereur
		return isset(Acquereur::$easyload[$array['idAcquereur']]) ? Acquereur::$easyload[$array['idAcquereur']] :
		new Acquereur($pdo,$array['idAcquereur'],$array['name'],$array['firstname'],$array['address'],$array['phone'],$array['mobilPhone'],$array['workPhone'],$array['fax'],$array['email'],$array['numberUsed'],$array['priceMin'],$array['priceMax'],$array['surfaceTerrainMin'],$array['surfaceTerrainMax'],$array['surfaceHabitableMin'],$array['surfaceHabitableMax'],$array['villeAcquereur'],$array['titreAcquereur'],$array['transactionType'],$array['user'],$array['mandateStyle'],$array['actif'],$array['rechercheCity'],$array['rechercheSector'],$easyload);
	}

	/**
	 * Test d'�galit�
	 * @param $acquereur Acquereur
	 * @return bool les objets sont ils �gaux ?
	 */
	public function equals($acquereur)
	{
		// Test si null
		if ($acquereur == null) { return false; }

		// Tester la classe
		if (!($acquereur instanceof Acquereur)) { return false; }

		// Tester les ids
		return $this->idAcquereur == $acquereur->idAcquereur;
	}

	/**
	 * Compter les acquereurs
	 * @param $pdo PDO
	 * @return int nombre de acquereurs
	 */
	public static function count(PDO $pdo)
	{
		if (!($pdoStatement = $pdo->query('SELECT COUNT(idAcquereur) FROM Acquereur'))) {
			throw new Exception('Erreur lors du comptage des acquereurs dans la base de donn�es');
		}
		return $pdoStatement->fetchColumn();
	}

	/**
	 * Supprimer le/la acquereur
	 * @return bool op�ration r�ussie ?
	 */
	public function delete()
	{
		// Supprimer le/la acquereur
		$pdoStatement = $this->pdo->prepare('DELETE FROM Acquereur WHERE idAcquereur = ?');
		if (!$pdoStatement->execute(array($this->getIdAcquereur()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) acquereur dans la base de donn�es');
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
		$pdoStatement = $this->pdo->prepare('UPDATE Acquereur SET '.implode(', ', $updates).' WHERE idAcquereur = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdAcquereur())))) {
			throw new Exception('Erreur lors de la mise � jour d\'un champ d\'un(e) acquereur dans la base de donn�es');
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
		array('name','firstname','address','phone','mobilPhone','workPhone','fax','email','numberUsed','actif','priceMin','priceMax','surfaceTerrainMin','surfaceTerrainMax','surfaceHabitableMin','surfaceHabitableMax','villeAcquereur','titreAcquereur_idTitreAcquereur','transactionType_idTransactionType','user_idUser','mandateStyle_idMandateStyle','rechercheCity_idCity','rechercheSector_idSector'),
		array($this->name,$this->firstname,$this->address,$this->phone,$this->mobilPhone,$this->workPhone,$this->fax,$this->email,$this->numberUsed,$this->actif,$this->priceMin,$this->priceMax,$this->surfaceTerrainMin,$this->surfaceTerrainMax,$this->surfaceHabitableMin,$this->surfaceHabitableMax,$this->villeAcquereur,$this->titreAcquereur,$this->transactionType,$this->user,$this->mandateStyle,$this->rechercheCity,$this->rechercheSector));
	}

	/**
	 * R�cup�rer le/la idAcquereur
	 * @return int
	 */
	public function getIdAcquereur()
	{
		return $this->idAcquereur;
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
	 * R�cup�rer le/la mobilPhone
	 * @return string
	 */
	public function getMobilPhone()
	{
		return $this->mobilPhone;
	}

	/**
	 * D�finir le/la mobilPhone
	 * @param $mobilPhone string
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setMobilPhone($mobilPhone,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->mobilPhone = $mobilPhone;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('mobilPhone'),array($mobilPhone)) : true;
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
	 * R�cup�rer le/la numberUsed
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
		$this->numberUsed = $numberUsed;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('numberUsed'),array($numberUsed)) : true;
	}

	/**
	 * R�cup�rer le/la actif
	 * @return bool
	 */
	public function getActif()
	{
		return $this->actif;
	}

	/**
	 * D�finir le/la actif
	 * @param $actif bool
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setActif($actif,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->actif = $actif;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('actif'),array($actif)) : true;
	}

	/**
	 * R�cup�rer le/la priceMin
	 * @return int
	 */
	public function getPriceMin()
	{
		return $this->priceMin;
	}

	/**
	 * D�finir le/la priceMin
	 * @param $priceMin int
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setPriceMin($priceMin,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->priceMin = $priceMin;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('priceMin'),array($priceMin)) : true;
	}

	/**
	 * R�cup�rer le/la priceMax
	 * @return int
	 */
	public function getPriceMax()
	{
		return $this->priceMax;
	}

	/**
	 * D�finir le/la priceMax
	 * @param $priceMax int
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setPriceMax($priceMax,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->priceMax = $priceMax;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('priceMax'),array($priceMax)) : true;
	}

	/**
	 * R�cup�rer le/la surfaceTerrainMin
	 * @return int
	 */
	public function getSurfaceTerrainMin()
	{
		return $this->surfaceTerrainMin;
	}

	/**
	 * D�finir le/la surfaceTerrainMin
	 * @param $surfaceTerrainMin int
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setSurfaceTerrainMin($surfaceTerrainMin,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->surfaceTerrainMin = $surfaceTerrainMin;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('surfaceTerrainMin'),array($surfaceTerrainMin)) : true;
	}

	/**
	 * R�cup�rer le/la surfaceTerrainMax
	 * @return int
	 */
	public function getSurfaceTerrainMax()
	{
		return $this->surfaceTerrainMax;
	}

	/**
	 * D�finir le/la surfaceTerrainMax
	 * @param $surfaceTerrainMax int
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setSurfaceTerrainMax($surfaceTerrainMax,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->surfaceTerrainMax = $surfaceTerrainMax;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('surfaceTerrainMax'),array($surfaceTerrainMax)) : true;
	}

	/**
	 * R�cup�rer le/la surfaceHabitableMin
	 * @return int
	 */
	public function getSurfaceHabitableMin()
	{
		return $this->surfaceHabitableMin;
	}

	/**
	 * D�finir le/la surfaceHabitableMin
	 * @param $surfaceHabitableMin int
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setSurfaceHabitableMin($surfaceHabitableMin,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->surfaceHabitableMin = $surfaceHabitableMin;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('surfaceHabitableMin'),array($surfaceHabitableMin)) : true;
	}

	/**
	 * R�cup�rer le/la surfaceHabitableMax
	 * @return int
	 */
	public function getSurfaceHabitableMax()
	{
		return $this->surfaceHabitableMax;
	}

	/**
	 * D�finir le/la surfaceHabitableMax
	 * @param $surfaceHabitableMax int
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setSurfaceHabitableMax($surfaceHabitableMax,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->surfaceHabitableMax = $surfaceHabitableMax;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('surfaceHabitableMax'),array($surfaceHabitableMax)) : true;
	}

	/**
	 * R�cup�rer le/la villeAcquereur
	 * @return City
	 */
	public function getVilleAcquereur()
	{
		// Retourner null si n�c�ssaire
		if ($this->villeAcquereur == null) { return null; }

		// Charger et retourner city
		return City::load($this->pdo,$this->villeAcquereur);

	}

	/**
	 * D�finir le/la villeAcquereur
	 * @param $villeAcquereur int
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setVilleAcquereur($villeAcquereur,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->villeAcquereur = $villeAcquereur == null ? null : $villeAcquereur->getIdCity();
		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('villeAcquereur'),array($villeAcquereur == null ? null : $villeAcquereur->getIdCity())) : true;
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
	 * S�lectionner les acquereurs par titreAcquereur
	 * @param $pdo PDO
	 * @param $titreAcquereur TitreAcquereur
	 * @return PDOStatement
	 */
	public static function selectByTitreAcquereur(PDO $pdo,TitreAcquereur $titreAcquereur)
	{
		$pdoStatement = $pdo->prepare('SELECT a.idAcquereur, a.name, a.firstname, a.address, a.phone, a.mobilPhone, a.workPhone, a.fax, a.email, a.numberUsed, a.priceMin, a.priceMax, a.surfaceTerrainMin, a.surfaceTerrainMax, a.surfaceHabitableMin, a.surfaceHabitableMax, a.villeAcquereur, a.titreAcquereur_idTitreAcquereur, a.transactionType_idTransactionType,a.user_idUser, a.mandateStyle_idMandateStyle, a.actif, a.rechercheCity_idCity, a.rechercheSector_idSector FROM Acquereur a WHERE a.titreAcquereur_idTitreAcquereur = ?');
		if (!$pdoStatement->execute(array($titreAcquereur->getIdTitreAcquereur()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les acquereurs par titreAcquereur depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�rer le/la transactionType
	 * @return TransactionType
	 */
	public function getTransactionType()
	{
		return TransactionType::load($this->pdo,$this->transactionType);
	}

	/**
	 * D�finir le/la transactionType
	 * @param $transactionType TransactionType
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setTransactionType(TransactionType $transactionType,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->transactionType = $transactionType->getIdTransactionType();

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('transactionType_idTransactionType'),array($transactionType->getIdTransactionType())) : true;
	}

	/**
	 * S�lectionner les acquereurs par transactionType
	 * @param $pdo PDO
	 * @param $transactionType TransactionType
	 * @return PDOStatement
	 */
	public static function selectByTransactionType(PDO $pdo,TransactionType $transactionType)
	{
		$pdoStatement = $pdo->prepare('SELECT a.idAcquereur, a.name, a.firstname, a.address, a.phone, a.mobilPhone, a.workPhone, a.fax, a.email, a.numberUsed, a.priceMin, a.priceMax, a.surfaceTerrainMin, a.surfaceTerrainMax, a.surfaceHabitableMin, a.surfaceHabitableMax, a.villeAcquereur, a.titreAcquereur_idTitreAcquereur, a.transactionType_idTransactionType,a.user_idUser, a.mandateStyle_idMandateStyle, a.actif, a.rechercheCity_idCity, a.rechercheSector_idSector FROM Acquereur a WHERE a.transactionType_idTransactionType = ?');
		if (!$pdoStatement->execute(array($transactionType->getIdTransactionType()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les acquereurs par transactionType depuis la base de donn�es');
		}
		return $pdoStatement;
	}


	/**
	 * R�cup�rer le/la User
	 * @return User
	 */
	public function getUser()
	{
		return User::load($this->pdo,$this->user);
	}

	/**
	 * D�finir le/la transactionType
	 * @param $transactionType TransactionType
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setUser(User $user,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->user = $user->getIdUser();

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('user_idUser'),array($user->getIdUser() )) : true;
	}

	/**
	 * S�lectionner les acquereurs par transactionType
	 * @param $pdo PDO
	 * @param $transactionType TransactionType
	 * @return PDOStatement
	 */
	public static function selectByUser(PDO $pdo,User $user)
	{
		$pdoStatement = $pdo->prepare('SELECT a.idAcquereur, a.name, a.firstname, a.address, a.phone, a.mobilPhone, a.workPhone, a.fax, a.email, a.numberUsed, a.priceMin, a.priceMax, a.surfaceTerrainMin, a.surfaceTerrainMax, a.surfaceHabitableMin, a.surfaceHabitableMax, a.villeAcquereur, a.titreAcquereur_idTitreAcquereur, a.transactionType_idTransactionType,a.user_idUser, a.mandateStyle_idMandateStyle, a.actif, a.rechercheCity_idCity, a.rechercheSector_idSector FROM Acquereur a WHERE a.user_idUser = ?');
		if (!$pdoStatement->execute(array($user->getIdUser() ))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les acquereurs par transactionType depuis la base de donn�es');
		}
		return $pdoStatement;
	}


	/**
	 * R�cup�rer le/la mandateStyle
	 * @return MandateStyle
	 */
	public function getMandateStyle()
	{
		return $this->mandateStyle == null?null: MandateStyle::load($this->pdo,$this->mandateStyle);
	}

	/**
	 * D�finir le/la mandateStyle
	 * @param $mandateStyle MandateStyle
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setMandateStyle(MandateStyle $mandateStyle,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->mandateStyle = $mandateStyle==null?null:$mandateStyle->getIdMandateStyle();

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('mandateStyle_idMandateStyle'),array($mandateStyle==null?null:$mandateStyle->getIdMandateStyle())) : true;

	}

	/**
	 * S�lectionner les acquereurs par mandateStyle
	 * @param $pdo PDO
	 * @param $mandateStyle MandateStyle
	 * @return PDOStatement
	 */
	public static function selectByMandateStyle(PDO $pdo,MandateStyle $mandateStyle)
	{
		$pdoStatement = $pdo->prepare('SELECT a.idAcquereur, a.name, a.firstname, a.address, a.phone, a.mobilPhone, a.workPhone, a.fax, a.email, a.numberUsed, a.priceMin, a.priceMax, a.surfaceTerrainMin, a.surfaceTerrainMax, a.surfaceHabitableMin, a.surfaceHabitableMax, a.villeAcquereur, a.titreAcquereur_idTitreAcquereur, a.transactionType_idTransactionType,a.user_idUser, a.mandateStyle_idMandateStyle, a.actif, a.rechercheCity_idCity, a.rechercheSector_idSector FROM Acquereur a WHERE a.mandateStyle_idMandateStyle = ?');
		if (!$pdoStatement->execute(array($mandateStyle->getIdMandateStyle()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les acquereurs par mandateStyle depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�rer le/la rechercheCity
	 * @return City
	 */
	public function getRechercheCity()
	{
		// Retourner null si n�c�ssaire
		if ($this->rechercheCity == null) { return null; }

		// Charger et retourner city
		return City::load($this->pdo,$this->rechercheCity);
	}

	/**
	 * D�finir le/la rechercheCity
	 * @param $rechercheCity City
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setRechercheCity($rechercheCity=null,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->rechercheCity = $rechercheCity == null ? null : $rechercheCity->getIdCity();

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('rechercheCity_idCity'),array($rechercheCity == null ? null : $rechercheCity->getIdCity())) : true;
	}

	/**
	 * S�lectionner les acquereurs par rechercheCity
	 * @param $pdo PDO
	 * @param $rechercheCity City
	 * @return PDOStatement
	 */
	public static function selectByRechercheCity(PDO $pdo,City $rechercheCity)
	{
		$pdoStatement = $pdo->prepare('SELECT a.idAcquereur, a.name, a.firstname, a.address, a.phone, a.mobilPhone, a.workPhone, a.fax, a.email, a.numberUsed, a.priceMin, a.priceMax, a.surfaceTerrainMin, a.surfaceTerrainMax, a.surfaceHabitableMin, a.surfaceHabitableMax, a.villeAcquereur, a.titreAcquereur_idTitreAcquereur, a.transactionType_idTransactionType,a.user_idUser, a.mandateStyle_idMandateStyle, a.actif, a.rechercheCity_idCity, a.rechercheSector_idSector FROM Acquereur a WHERE a.rechercheCity_idCity = ?');
		if (!$pdoStatement->execute(array($rechercheCity->getIdCity()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les acquereurs par rechercheCity depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�rer le/la rechercheSector
	 * @return Sector
	 */
	public function getRechercheSector()
	{
		// Retourner null si n�c�ssaire
		if ($this->rechercheSector == null) { return null; }

		// Charger et retourner sector
		return Sector::load($this->pdo,$this->rechercheSector);
	}

	/**
	 * D�finir le/la rechercheSector
	 * @param $rechercheSector Sector
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setRechercheSector($rechercheSector=null,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->rechercheSector = $rechercheSector == null ? null : $rechercheSector->getIdSector();

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('rechercheSector_idSector'),array($rechercheSector == null ? null : $rechercheSector->getIdSector())) : true;
	}

	/**
	 * S�lectionner les acquereurs par rechercheSector
	 * @param $pdo PDO
	 * @param $rechercheSector Sector
	 * @return PDOStatement
	 */
	public static function selectByRechercheSector(PDO $pdo,Sector $rechercheSector)
	{
		$pdoStatement = $pdo->prepare('SELECT a.idAcquereur, a.name, a.firstname, a.address, a.phone, a.mobilPhone, a.workPhone, a.fax, a.email, a.numberUsed, a.priceMin, a.priceMax, a.surfaceTerrainMin, a.surfaceTerrainMax, a.surfaceHabitableMin, a.surfaceHabitableMax, a.villeAcquereur, a.titreAcquereur_idTitreAcquereur, a.transactionType_idTransactionType,a.user_idUser, a.mandateStyle_idMandateStyle, a.actif, a.rechercheCity_idCity, a.rechercheSector_idSector FROM Acquereur a WHERE a.rechercheSector_idSector = ?');
		if (!$pdoStatement->execute(array($rechercheSector->getIdSector()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les acquereurs par rechercheSector depuis la base de donn�es');
		}
		return $pdoStatement;
	}
	/**
	 * ToString
	 * @return string repr�sentation de acquereur sous la forme d'un string
	 */
	public function __toString()
	{
		return '[Acquereur idAcquereur="'.$this->idAcquereur.'" name="'.$this->name.'" firstname="'.$this->firstname.'" address="'.$this->address.'" phone="'.$this->phone.'" mobilPhone="'.$this->mobilPhone.'" workPhone="'.$this->workPhone.'" fax="'.$this->fax.'" email="'.$this->email.'" numberUsed="'.$this->numberUsed.'" actif="'.($this->actif?'true':'false').'" priceMin="'.$this->priceMin.'" priceMax="'.$this->priceMax.'" surfaceTerrainMin="'.$this->surfaceTerrainMin.'" surfaceTerrainMax="'.$this->surfaceTerrainMax.'" surfaceHabitableMin="'.$this->surfaceHabitableMin.'" surfaceHabitableMax="'.$this->surfaceHabitableMax.'" villeAcquereur="'.$this->villeAcquereur.'" titreAcquereur="'.$this->titreAcquereur.'" transactionType="'.$this->transactionType.'" user="'.$this->user.'" mandateStyle="'.$this->mandateStyle.'" rechercheCity="'.$this->rechercheCity.'" rechercheSector="'.$this->rechercheSector.'"]';
	}

}

?>
