<?php

/**
 * @class Seller
 * @date 23/02/2011 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class Seller
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

	/// @var bool
	private $asset;

	/// @var int
	private $numberUsed;

	/// @var int id de city
	private $city;

	/// @var int id de sellertitle
	private $sellerTitle;

	/// @var int id de user
	private $user;
    /// @var Boolean
    private $vitrine_account;

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
	 * @param $numberUsed int
	 * @param $city int id de city
	 * @param $sellerTitle int id de sellertitle
	 * @param $user int id de user
	 * @param $asset bool
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Seller
	 */
	protected function __construct(PDO $pdo,$idSeller,$name,$firstname,$address,$phone,$mobilPhone,$workPhone,$fax,$email,$comments,$numberUsed,$city,$sellerTitle,$user,$asset=true,$vitrine_account=false,$easyload=false)
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
        $this->vitrine_account=$vitrine_account;

		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			Seller::$easyload[$idSeller] = $this;
		}
	}

	/**
	 * Cr�er un(e) seller
	 * @param $pdo PDO
	 * @param $name string
	 * @param $firstname string
	 * @param $address string
	 * @param $phone string
	 * @param $mobilPhone string
	 * @param $workPhone string
	 * @param $fax string
	 * @param $email string
	 * @param $comments string
	 * @param $numberUsed int
	 * @param $city City
	 * @param $sellerTitle SellerTitle
	 * @param $user User
	 * @param $asset bool
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Seller
	 */
	public static function create(PDO $pdo,$name,$firstname,$address,$phone,$mobilPhone,$workPhone,$fax,$email,$comments,$numberUsed,City $city,SellerTitle $sellerTitle,User $user,$asset=true,$vitrine_account=false,$easyload=true)
	{
		// Ajouter le/la seller dans la base de donn�es
		$pdoStatement = $pdo->prepare('INSERT INTO Seller (name,firstname,address,phone,mobilPhone,workPhone,fax,email,comments,numberUsed,city_idCity,sellerTitle_idSellerTitle,user_idUser,asset,vitrine_account) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
		if (!$pdoStatement->execute(array($name,$firstname,$address,$phone,$mobilPhone,$workPhone,$fax,$email,$comments,$numberUsed,$city->getIdCity(),$sellerTitle->getIdSellerTitle(),$user->getIdUser(),$asset,$vitrine_account))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) seller dans la base de donn�es');
		}

		// Construire le/la seller
		return new Seller($pdo,$pdo->lastInsertId(),$name,$firstname,$address,$phone,$mobilPhone,$workPhone,$fax,$email,$comments,$numberUsed,$city->getIdCity(),$sellerTitle->getIdSellerTitle(),$user->getIdUser(),$asset,$vitrine_account,$easyload);
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
		return $pdo->prepare('SELECT s.idSeller, s.name, s.firstname, s.address, s.phone, s.mobilPhone, s.workPhone, s.fax, s.email, s.comments, s.numberUsed, s.city_idCity, s.sellerTitle_idSellerTitle, s.user_idUser, s.asset, s.vitrine_account FROM Seller s '.
		($where != null ? ' WHERE '.$where : '').
		($orderby != null ? ' ORDER BY '.$orderby : '').
		($limit != null ? ' LIMIT '.$limit : ''));
	}

	/**
	 * Charger un(e) seller
	 * @param $pdo PDO
	 * @param $idSeller int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Seller
	 */
	public static function load(PDO $pdo,$idSeller,$easyload=true)
	{
		// D�j� charg�(e) ?
		if (isset(Seller::$easyload[$idSeller])) {
			return Seller::$easyload[$idSeller];
		}

		// Charger le/la seller
		$pdoStatement = Seller::_select($pdo,'s.idSeller = ?');
		if (!$pdoStatement->execute(array($idSeller))) {
			throw new Exception('Erreur lors du chargement d\'un(e) seller depuis la base de donn�es');
		}

		// R�cup�rer le/la seller depuis le jeu de r�sultats
		return Seller::fetch($pdo,$pdoStatement,$easyload);
	}

	/**
	 * Charger tous/toutes les sellers
	 * @param $pdo PDO
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Seller[] tableau de sellers
	 */
	public static function loadAll(PDO $pdo,$easyload=false)
	{
		// S�lectionner tous/toutes les sellers
		$pdoStatement = Seller::selectAll($pdo);

		// Mettre chaque seller dans un tableau
		$sellers = array();
		while ($seller = Seller::fetch($pdo,$pdoStatement,$easyload)) {
			$sellers[] = $seller;
		}

		// Retourner le tableau
		return $sellers;
	}

	/**
	 * S�lectionner tous/toutes les sellers
	 * @param $pdo PDO
	 * @return PDOStatement
	 */
	public static function selectAll(PDO $pdo)
	{

		$pdoStatement = Seller::_select($pdo);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les sellers depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�re le/la seller suivant(e) d'un jeu de r�sultats
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
		list($idSeller,$name,$firstname,$address,$phone,$mobilPhone,$workPhone,$fax,$email,$comments,$numberUsed,$city,$sellerTitle,$user,$asset,$vitrine_account) = $values;

		// Construire le/la seller
		return isset(Seller::$easyload[$idSeller.'-'.$name.'-'.$firstname.'-'.$address.'-'.$phone.'-'.$mobilPhone.'-'.$workPhone.'-'.$fax.'-'.$email.'-'.$comments.'-'.$numberUsed.'-'.$city.'-'.$sellerTitle.'-'.$user.'-'.$asset.'-'.$vitrine_account]) ? Seller::$easyload[$idSeller.'-'.$name.'-'.$firstname.'-'.$address.'-'.$phone.'-'.$mobilPhone.'-'.$workPhone.'-'.$fax.'-'.$email.'-'.$comments.'-'.$numberUsed.'-'.$city.'-'.$sellerTitle.'-'.$user.'-'.$asset.'-'.$vitrine_account] :
		new Seller($pdo,$idSeller,$name,$firstname,$address,$phone,$mobilPhone,$workPhone,$fax,$email,$comments,$numberUsed,$city,$sellerTitle,$user,$asset,$vitrine_account,$easyload);
	}

	/**
	 * Serialiser
	 * @param $serialize bool activer la s�rialisation ?
	 * @return string serialisation du/de la seller
	 */
	public function serialize($serialize=true)
	{
		// S�rialiser le/la seller
		$array = array('idSeller' => $this->idSeller,'name' => $this->name,'firstname' => $this->firstname,'address' => $this->address,'phone' => $this->phone,'mobilPhone' => $this->mobilPhone,'workPhone' => $this->workPhone,'fax' => $this->fax,'email' => $this->email,'comments' => $this->comments,'numberUsed' => $this->numberUsed,'city' => $this->city,'sellerTitle' => $this->sellerTitle,'user' => $this->user,'asset' => $this->asset,'vitrine_account'=>$this->vitrine_account);

		// Retourner la serialisation (ou pas) du/de la seller
		return $serialize ? serialize($array) : $array;
	}

	/**
	 * D�s�rialiser
	 * @param $pdo PDO
	 * @param $string string serialisation du/de la seller
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Seller
	 */
	public static function unserialize(PDO $pdo,$string,$easyload=true)
	{
		// D�s�rialiser la chaine de caract�res
		$array = unserialize($string);

		// Construire le/la seller
		return isset(Seller::$easyload[$array['idSeller']]) ? Seller::$easyload[$array['idSeller']] :
		new Seller($pdo,$array['idSeller'],$array['name'],$array['firstname'],$array['address'],$array['phone'],$array['mobilPhone'],$array['workPhone'],$array['fax'],$array['email'],$array['comments'],$array['numberUsed'],$array['city'],$array['sellerTitle'],$array['user'],$array['asset'],$array['vitrine_account'],$easyload);
	}

	/**
	 * Test d'�galit�
	 * @param $seller Seller
	 * @return bool les objets sont ils �gaux ?
	 */
	public function equals($seller)
	{
		// Test si null
		if ($seller == null) { return false; }

		// Tester la classe
		if (!($seller instanceof Seller)) { return false; }

		// Tester les ids
		return $this->idSeller == $seller->idSeller;
	}

	/**
	 * Compter les sellers
	 * @param $pdo PDO
	 * @return int nombre de sellers
	 */
	public static function count(PDO $pdo,$where = '')
	{
		if (!($pdoStatement = $pdo->query('SELECT COUNT(idSeller) FROM Seller '.$where))) {
			throw new Exception('Erreur lors du comptage des sellers dans la base de donn�es');
		}
		return $pdoStatement->fetchColumn();
	}

	/**
	 * Supprimer le/la seller
	 * @return bool op�ration r�ussie ?
	 */
	public function delete()
	{
		// Supprimer le/la seller
		$pdoStatement = $this->pdo->prepare('DELETE FROM Seller WHERE idSeller = ?');
		if (!$pdoStatement->execute(array($this->getIdSeller()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) seller dans la base de donn�es');
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
		$pdoStatement = $this->pdo->prepare('UPDATE Seller SET '.implode(', ', $updates).' WHERE idSeller = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdSeller())))) {
			throw new Exception('Erreur lors de la mise � jour d\'un champ d\'un(e) seller dans la base de donn�es');
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
		return $this->_set(array('name','firstname','address','phone','mobilPhone','workPhone','fax','email','comments','asset','numberUsed','city_idCity','sellerTitle_idSellerTitle','user_idUser','vitrine_account'),array($this->name,$this->firstname,$this->address,$this->phone,$this->mobilPhone,$this->workPhone,$this->fax,$this->email,$this->comments,$this->asset,$this->numberUsed,$this->city,$this->sellerTitle,$this->user,$this->vitrine_account));
	}

	/**
	 * R�cup�rer le/la idSeller
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
	 * R�cup�rer le/la comments
	 * @return string
	 */
	public function getComments()
	{
		return $this->comments;
	}

	/**
	 * D�finir le/la comments
	 * @param $comments string
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setComments($comments,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->comments = $comments;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('comments'),array($comments)) : true;
	}

	/**
	 * R�cup�rer le/la asset
	 * @return bool
	 */
	public function getAsset()
	{
		return $this->asset;
	}

	/**
	 * D�finir le/la asset
	 * @param $asset bool
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setAsset($asset=true,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->asset = $asset;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('asset'),array($asset)) : true;
	}


    //
    /**
     * R�cup�rer le/la vitrine_account
     * @return bool
     */
    public function getVitrine_account()
    {
        return $this->vitrine_account;
    }

    /**
     * D�finir le/la vitrine_account
     * @param $vitrine_account bool
     * @param $execute bool ex�cuter la requ�te update ?
     * @return bool op�ration r�ussie ?
     */
    public function setVitrine_account($vitrine_account=true,$execute=true)
    {
        // Sauvegarder dans l'objet
        $this->vitrine_account = $vitrine_account;

        // Sauvegarder dans la base de donn�es (ou pas)
        return $execute ? $this->_set(array('vitrine_account'),array($vitrine_account)) : true;
    }

    //
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
	 * S�lectionner les sellers par city
	 * @param $pdo PDO
	 * @param $city City
	 * @return PDOStatement
	 */
	public static function selectByCity(PDO $pdo,City $city)
	{
		$pdoStatement = $pdo->prepare('SELECT s.idSeller, s.name, s.firstname, s.address, s.phone, s.mobilPhone, s.workPhone, s.fax, s.email, s.comments, s.numberUsed, s.city_idCity, s.sellerTitle_idSellerTitle, s.user_idUser, s.asset, s.vitrine_account FROM Seller s WHERE s.city_idCity = ?');
		if (!$pdoStatement->execute(array($city->getIdCity()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les sellers par city depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�rer le/la sellerTitle
	 * @return SellerTitle
	 */
	public function getSellerTitle()
	{
		return SellerTitle::load($this->pdo,$this->sellerTitle);
	}

	/**
	 * D�finir le/la sellerTitle
	 * @param $sellerTitle SellerTitle
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setSellerTitle(SellerTitle $sellerTitle,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->sellerTitle = $sellerTitle->getIdSellerTitle();

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('sellerTitle_idSellerTitle'),array($sellerTitle->getIdSellerTitle())) : true;
	}

	/**
	 * S�lectionner les sellers par sellerTitle
	 * @param $pdo PDO
	 * @param $sellerTitle SellerTitle
	 * @return PDOStatement
	 */
	public static function selectBySellerTitle(PDO $pdo,SellerTitle $sellerTitle)
	{
		$pdoStatement = $pdo->prepare('SELECT s.idSeller, s.name, s.firstname, s.address, s.phone, s.mobilPhone, s.workPhone, s.fax, s.email, s.comments, s.numberUsed, s.city_idCity, s.sellerTitle_idSellerTitle, s.user_idUser, s.asset FROM Seller s WHERE s.sellerTitle_idSellerTitle = ?');
		if (!$pdoStatement->execute(array($sellerTitle->getIdSellerTitle()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les sellers par sellerTitle depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�rer le/la user
	 * @return User
	 */
	public function getUser()
	{
		return User::load($this->pdo,$this->user);
	}

	/**
	 * D�finir le/la user
	 * @param $user User
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setUser(User $user,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->user = $user->getIdUser();

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('user_idUser'),array($user->getIdUser())) : true;
	}

	/**
	 * S�lectionner les sellers par user
	 * @param $pdo PDO
	 * @param $user User
	 * @return PDOStatement
	 */
	public static function selectByUser(PDO $pdo,User $user)
	{
		$pdoStatement = $pdo->prepare('SELECT s.idSeller, s.name, s.firstname, s.address, s.phone, s.mobilPhone, s.workPhone, s.fax, s.email, s.comments, s.numberUsed, s.city_idCity, s.sellerTitle_idSellerTitle, s.user_idUser, s.asset FROM Seller s WHERE s.user_idUser = ?');
		if (!$pdoStatement->execute(array($user->getIdUser()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les sellers par user depuis la base de donn�es');
		}
		return $pdoStatement;
	}
	/**
	 * ToString
	 * @return string repr�sentation de seller sous la forme d'un string
	 */
	public function __toString()
	{
		return '[Seller idSeller="'.$this->idSeller.'" name="'.$this->name.'" firstname="'.$this->firstname.'" address="'.$this->address.'" phone="'.$this->phone.'" mobilPhone="'.$this->mobilPhone.'" workPhone="'.$this->workPhone.'" fax="'.$this->fax.'" email="'.$this->email.'" comments="'.$this->comments.'" asset="'.($this->asset?'true':'false').'" numberUsed="'.$this->numberUsed.'" city="'.$this->city.'" sellerTitle="'.$this->sellerTitle.'" user="'.$this->user.'"]';
	}

	// additionnal methods

	/**
	 * Charger tous/toutes les sellers
	 * @param $pdo PDO
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Seller[] tableau de sellers
	 */
	public static function loadAllAsset(PDO $pdo,$easyload=false)
	{
		// S�lectionner tous/toutes les sellers
		//			_select(PDO $pdo,$where=null,$orderby=null,$limit=null)
		$pdoStatement = Seller::_select($pdo,'s.asset = 1');
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les sellers depuis la base de donn�es');
		}


		// Mettre chaque seller dans un tableau
		$sellers = array();
		while ($seller = Seller::fetch($pdo,$pdoStatement,$easyload)) {
			$sellers[] = $seller;
		}

		// Retourner le tableau
		return $sellers;
	}


	/**
	 * Charger tous/toutes les sellers
	 * @param $pdo PDO
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Seller[] tableau de sellers
	 */
	public static function loadAllNotAsset(PDO $pdo,$easyload=false)
	{
		// S�lectionner tous/toutes les sellers
		//			_select(PDO $pdo,$where=null,$orderby=null,$limit=null)
		$pdoStatement = Seller::_select($pdo,'s.asset = 0');
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les sellers depuis la base de donn�es');
		}


		// Mettre chaque seller dans un tableau
		$sellers = array();
		while ($seller = Seller::fetch($pdo,$pdoStatement,$easyload)) {
			$sellers[] = $seller;
		}

		// Retourner le tableau
		return $sellers;
	}

}



?>
