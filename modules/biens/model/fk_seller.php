<?php

/**
 * @class Fk_seller
 * @date 17/02/2011 (dd/mm/yyyy)
 * Clone de Seller modifié (R only), permetant l'ajout de la methose isDefault().
 * Ne doit être utilisée QUE dans le cas d'une selection le vendeur affectés à un mandat depuis la méthode listSellers() de la classe Mandate
 */
class Fk_seller
{
	/// @var PDO
	private $pdo;

	/// @var array tableau pour le chargement rapide
	private static $easyload;

	/// @var int
	private $idSeller;

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

	/// @var string
	private $comments;
	private $numberUsed;
	/// @var bool
	private $asset;

	/// @var int id de city
	private $city;

	/// @var int id de sellertitle
	private $sellerTitle;

	/// @var int id de user
	private $user;
	private $isDefault;

	/**
	 * Construire un(e) seller
	 * @param $pdo PDO
	 * @param $idSeller int
	 * @param $name string
	 * @param $firstname string
	 * @param $address string
	 * @param $phone string
	 * @param $mobilPhone string
	 * @param $workPhone string
	 * @param $fax string
	 * @param $email string
	 * @param $comments string
	 * @param $city int id de city
	 * @param $sellerTitle int id de sellertitle
	 * @param $user int id de user
	 * @param $asset bool
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Seller
	 */
	protected function __construct(PDO $pdo,$idSeller,$name,$firstname,$address,$phone,$mobilPhone,$workPhone,$fax,$email,$comments,$numberUsed,$city,$sellerTitle,$user,$asset=true,$isDefault=false,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;

		// Sauvegarder les attributs
		$this->idSeller = $idSeller;
		$this->name = $name;
		$this->firstname = $firstname;
		$this->address = $address;
		$this->phone = $phone;
		$this->mobilPhone = $mobilPhone;
		$this->workPhone = $workPhone;
		$this->fax = $fax;
		$this->email = $email;
		$this->comments = $comments;
		$this->numberUsed = $numberUsed;
		$this->city = $city;
		$this->sellerTitle = $sellerTitle;
		$this->user = $user;
		$this->asset = $asset;
		$this->isDefault = $isDefault;

		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			Fk_seller::$easyload[$idSeller] = $this;
		}
	}


	/**
	 * Récupère le/la seller suivant(e) d'un jeu de résultats
	 * @param $pdo PDO
	 * @param $pdoStatement PDOStatement
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Seller
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();

		if (!$values) { return null; }
		list($idSeller,$name,$firstname,$address,$phone,$mobilPhone,$workPhone,$fax,$email,$comments,$numberUsed,$city,$sellerTitle,$user,$asset,$isDefault) = $values;

		// Construire le/la seller
		return isset(Fk_seller::$easyload[$idSeller.'-'.$name.'-'.$firstname.'-'.$address.'-'.$phone.'-'.$mobilPhone.'-'.$workPhone.'-'.$fax.'-'.$email.'-'.$comments.'-'.$numberUsed.'-'.$city.'-'.$sellerTitle.'-'.$user.'-'.$asset.'-'.$isDefault]) ? Fk_seller::$easyload[$idSeller.'-'.$name.'-'.$firstname.'-'.$address.'-'.$phone.'-'.$mobilPhone.'-'.$workPhone.'-'.$fax.'-'.$email.'-'.$comments.'-'.$numberUsed.'-'.$city.'-'.$sellerTitle.'-'.$user.'-'.$asset.'-'.$isDefault] :
		new Fk_seller($pdo,$idSeller,$name,$firstname,$address,$phone,$mobilPhone,$workPhone,$fax,$email,$comments,$numberUsed,$city,$sellerTitle,$user,$asset,$isDefault,$easyload);
	}






	/**
	 * Récupérer le/la idSeller
	 * @return int
	 */
	public function getIdSeller()
	{
		return $this->idSeller;
	}
	public function getId()
	{
		return $this->idSeller;
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
	 * Récupérer le/la firstname
	 * @return string
	 */
	public function getFirstname()
	{
		return $this->firstname;
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
	 * Récupérer le/la phone
	 * @return string
	 */
	public function getPhone()
	{
		return $this->phone;
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
	 * Récupérer le/la workPhone
	 * @return string
	 */
	public function getWorkPhone()
	{
		return $this->workPhone;
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
	 * Récupérer le/la email
	 * @return string
	 */
	public function getEmail()
	{
		return $this->email;
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
	 * Récupérer le/la asset
	 * @return bool
	 */
	public function getAsset()
	{
		return $this->asset;
	}

	/**
	 * Récupérer le/la city
	 * @return City
	 */
	public function getCity()
	{
		return City::load($this->pdo,$this->city);
	}


	/**
	 * Sélectionner les sellers par city
	 * @param $pdo PDO
	 * @param $city City
	 * @return PDOStatement
	 */
	public static function selectByCity(PDO $pdo,City $city)
	{
		$pdoStatement = $pdo->prepare('SELECT s.idSeller, s.name, s.firstname, s.address, s.phone, s.mobilPhone, s.workPhone, s.fax, s.email, s.comments, s.city_idCity, s.sellerTitle_idSellerTitle, s.user_idUser, s.asset FROM Seller s WHERE s.city_idCity = ?');
		if (!$pdoStatement->execute(array($city->getIdCity()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les sellers par city depuis la base de données');
		}
		return $pdoStatement;
	}

	/**
	 * Récupérer le/la sellerTitle
	 * @return SellerTitle
	 */
	public function getSellerTitle()
	{
		return SellerTitle::load($this->pdo,$this->sellerTitle);
	}



	/**
	 * Sélectionner les sellers par sellerTitle
	 * @param $pdo PDO
	 * @param $sellerTitle SellerTitle
	 * @return PDOStatement
	 */
	public static function selectBySellerTitle(PDO $pdo,SellerTitle $sellerTitle)
	{
		$pdoStatement = $pdo->prepare('SELECT s.idSeller, s.name, s.firstname, s.address, s.phone, s.mobilPhone, s.workPhone, s.fax, s.email, s.comments, s.city_idCity, s.sellerTitle_idSellerTitle, s.user_idUser, s.asset FROM Seller s WHERE s.sellerTitle_idSellerTitle = ?');
		if (!$pdoStatement->execute(array($sellerTitle->getIdSellerTitle()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les sellers par sellerTitle depuis la base de données');
		}
		return $pdoStatement;
	}

	/**
	 * Récupérer le/la user
	 * @return User
	 */
	public function getUser()
	{
		return User::load($this->pdo,$this->user);
	}


	public function getIsDefault(){
		return $this->isDefault;
	}
	/**
	 * Sélectionner les sellers par user
	 * @param $pdo PDO
	 * @param $user User
	 * @return PDOStatement
	 */
	public static function selectByUser(PDO $pdo,User $user)
	{
		$pdoStatement = $pdo->prepare('SELECT s.idSeller, s.name, s.firstname, s.address, s.phone, s.mobilPhone, s.workPhone, s.fax, s.email, s.comments, s.city_idCity, s.sellerTitle_idSellerTitle, s.user_idUser, s.asset FROM Seller s WHERE s.user_idUser = ?');
		if (!$pdoStatement->execute(array($user->getIdUser()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les sellers par user depuis la base de données');
		}
		return $pdoStatement;
	}


}

?>