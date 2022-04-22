<?php

/**
 * @class Contact
 * @date 21/07/2011 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class Contact
{
	/// @var PDO
	private $pdo;

	/// @var array tableau pour le chargement rapide
	private static $easyload;

	/// @var int
	private $idContact;

	/// @var int
	private $dateCreation;

	/// @var int id de user
	private $user;

	/**
	 * Construire un(e) contact
	 * @param $pdo PDO
	 * @param $idContact int
	 * @param $dateCreation int
	 * @param $user int id de user
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Contact
	 */
	protected function __construct(PDO $pdo,$idContact,$dateCreation,$user,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;

		// Sauvegarder les attributs
		$this->idContact = $idContact;
		$this->dateCreation = $dateCreation;
		$this->user = $user;

		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			Contact::$easyload[$idContact] = $this;
		}
	}

	/**
	 * Cr�er un(e) contact
	 * @param $pdo PDO
	 * @param $dateCreation int
	 * @param $user User
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Contact
	 */
	public static function create(PDO $pdo,$dateCreation,User $user,$easyload=true)
	{
		// Ajouter le/la contact dans la base de donn�es
		$pdoStatement = $pdo->prepare('INSERT INTO Contact (dateCreation,user_idUser) VALUES (?,?)');
		if (!$pdoStatement->execute(array(date('Y-m-d H:i:s',$dateCreation),$user->getIdUser()))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) contact dans la base de donn�es');
		}

		// Construire le/la contact
		return new Contact($pdo,$pdo->lastInsertId(),$dateCreation,$user->getIdUser(),$easyload);
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
		return $pdo->prepare('SELECT c.idContact, c.dateCreation, c.user_idUser FROM Contact c '.
		($where != null ? ' WHERE '.$where : '').
		($orderby != null ? ' ORDERBY '.$orderby : '').
		($limit != null ? ' LIMIT '.$limit : ''));
	}

	/**
	 * Charger un(e) contact
	 * @param $pdo PDO
	 * @param $idContact int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Contact
	 */
	public static function load(PDO $pdo,$idContact,$easyload=true)
	{
		// D�j� charg�(e) ?
		if (isset(Contact::$easyload[$idContact])) {
			return Contact::$easyload[$idContact];
		}

		// Charger le/la contact
		$pdoStatement = Contact::_select($pdo,'c.idContact = ?');
		if (!$pdoStatement->execute(array($idContact))) {
			throw new Exception('Erreur lors du chargement d\'un(e) contact depuis la base de donn�es');
		}

		// R�cup�rer le/la contact depuis le jeu de r�sultats
		return Contact::fetch($pdo,$pdoStatement,$easyload);
	}

	/**
	 * Charger tous/toutes les contacts
	 * @param $pdo PDO
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Contact[] tableau de contacts
	 */
	public static function loadAll(PDO $pdo,$easyload=false)
	{
		// S�lectionner tous/toutes les contacts
		$pdoStatement = Contact::selectAll($pdo);

		// Mettre chaque contact dans un tableau
		$contacts = array();
		while ($contact = Contact::fetch($pdo,$pdoStatement,$easyload)) {
			$contacts[] = $contact;
		}

		// Retourner le tableau
		return $contacts;
	}

	/**
	 * S�lectionner tous/toutes les contacts
	 * @param $pdo PDO
	 * @return PDOStatement
	 */
	public static function selectAll(PDO $pdo)
	{
		$pdoStatement = Contact::_select($pdo);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les contacts depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�re le/la contact suivant(e) d'un jeu de r�sultats
	 * @param $pdo PDO
	 * @param $pdoStatement PDOStatement
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Contact
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idContact,$dateCreation,$user) = $values;

		// Construire le/la contact
		return isset(Contact::$easyload[$idContact.'-'.strtotime($dateCreation).'-'.$user]) ? Contact::$easyload[$idContact.'-'.strtotime($dateCreation).'-'.$user] :
		new Contact($pdo,$idContact,strtotime($dateCreation),$user,$easyload);
	}

	/**
	 * Serialiser
	 * @param $serialize bool activer la s�rialisation ?
	 * @return string serialisation du/de la contact
	 */
	public function serialize($serialize=true)
	{
		// S�rialiser le/la contact
		$array = array('idContact' => $this->idContact,'dateCreation' => $this->dateCreation,'user' => $this->user);

		// Retourner la serialisation (ou pas) du/de la contact
		return $serialize ? serialize($array) : $array;
	}

	/**
	 * D�s�rialiser
	 * @param $pdo PDO
	 * @param $string string serialisation du/de la contact
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Contact
	 */
	public static function unserialize(PDO $pdo,$string,$easyload=true)
	{
		// D�s�rialiser la chaine de caract�res
		$array = unserialize($string);

		// Construire le/la contact
		return isset(Contact::$easyload[$array['idContact']]) ? Contact::$easyload[$array['idContact']] :
		new Contact($pdo,$array['idContact'],$array['dateCreation'],$array['user'],$easyload);
	}

	/**
	 * Test d'�galit�
	 * @param $contact Contact
	 * @return bool les objets sont ils �gaux ?
	 */
	public function equals($contact)
	{
		// Test si null
		if ($contact == null) { return false; }

		// Tester la classe
		if (!($contact instanceof Contact)) { return false; }

		// Tester les ids
		return $this->idContact == $contact->idContact;
	}

	/**
	 * Compter les contacts
	 * @param $pdo PDO
	 * @return int nombre de contacts
	 */
	public static function count(PDO $pdo)
	{
		if (!($pdoStatement = $pdo->query('SELECT COUNT(idContact) FROM Contact'))) {
			throw new Exception('Erreur lors du comptage des contacts dans la base de donn�es');
		}
		return $pdoStatement->fetchColumn();
	}

	/**
	 * Supprimer le/la contact
	 * @return bool op�ration r�ussie ?
	 */
	public function delete()
	{
		// Supprimer les champsContacts associ�(e)s
		$select = $this->selectChampsContacts();
		while ($champsContact = ChampsContact::fetch($this->pdo,$select)) {
			if (!$champsContact->delete()) { return false; }
		}

		// Supprimer le/la contact
		$pdoStatement = $this->pdo->prepare('DELETE FROM Contact WHERE idContact = ?');
		if (!$pdoStatement->execute(array($this->getIdContact()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) contact dans la base de donn�es');
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
		$pdoStatement = $this->pdo->prepare('UPDATE Contact SET '.implode(', ', $updates).' WHERE idContact = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdContact())))) {
			throw new Exception('Erreur lors de la mise � jour d\'un champ d\'un(e) contact dans la base de donn�es');
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
		return $this->_set(array('dateCreation','user_idUser'),array(date('Y-m-d H:i:s',$this->dateCreation),$this->user));
	}

	/**
	 * R�cup�rer le/la idContact
	 * @return int
	 */
	public function getIdContact()
	{
		return $this->idContact;
	}
	public function getId()
	{
		return $this->idContact;
	}
	/**
	 * R�cup�rer le/la dateCreation
	 * @return int
	 */
	public function getDateCreation()
	{
		return $this->dateCreation;
	}

	/**
	 * D�finir le/la dateCreation
	 * @param $dateCreation int
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setDateCreation($dateCreation,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->dateCreation = $dateCreation;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('dateCreation'),array(date('Y-m-d H:i:s',$dateCreation))) : true;
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
	 * S�lectionner les contacts par user
	 * @param $pdo PDO
	 * @param $user User
	 * @return PDOStatement
	 */
	public static function selectByUser(PDO $pdo,User $user)
	{
		$pdoStatement = $pdo->prepare('SELECT c.idContact, c.dateCreation, c.user_idUser FROM Contact c WHERE c.user_idUser = ?');
		if (!$pdoStatement->execute(array($user->getIdUser()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les contacts par user depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * S�lectionner les champsContacts
	 * @return PDOStatement
	 */
	public function selectChampsContacts()
	{
		return ChampsContact::selectByContact($this->pdo,$this);
	}
	/**
	 * ToString
	 * @return string repr�sentation de contact sous la forme d'un string
	 */
	public function __toString()
	{
		return '[Contact idContact="'.$this->idContact.'" dateCreation="'.date('d/m/Y H:i:s',$this->dateCreation).'" user="'.$this->user.'"]';
	}

}

?>
