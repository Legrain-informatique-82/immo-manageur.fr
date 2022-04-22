<?php

/**
 * @class TypeChampsContact
 * @date 19/07/2011 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class TypeChampsContact
{
	/// @var PDO
	private $pdo;

	/// @var array tableau pour le chargement rapide
	private static $easyload;

	/// @var int
	private $idTypeChampsContact;

	/// @var string
	private $libel;

	/// @var int
	private $numberUsed;

	/// @var int
	private $position;

	/**
	 * Construire un(e) typeChampsContact
	 * @param $pdo PDO
	 * @param $idTypeChampsContact int
	 * @param $libel string
	 * @param $numberUsed int
	 * @param $position int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return TypeChampsContact
	 */
	protected function __construct(PDO $pdo,$idTypeChampsContact,$libel,$numberUsed,$position,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;

		// Sauvegarder les attributs
		$this->idTypeChampsContact = $idTypeChampsContact;
		$this->libel = $libel;
		$this->numberUsed = $numberUsed;
		$this->position = $position;

		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			TypeChampsContact::$easyload[$idTypeChampsContact] = $this;
		}
	}

	/**
	 * Cr�er un(e) typeChampsContact
	 * @param $pdo PDO
	 * @param $libel string
	 * @param $numberUsed int
	 * @param $position int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return TypeChampsContact
	 */
	public static function create(PDO $pdo,$libel,$numberUsed,$position,$easyload=true)
	{
		// Ajouter le/la typeChampsContact dans la base de donn�es
		$pdoStatement = $pdo->prepare('INSERT INTO TypeChampsContact (libel,numberUsed,position) VALUES (?,?,?)');
		if (!$pdoStatement->execute(array($libel,$numberUsed,$position))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) typeChampsContact dans la base de donn�es');
		}

		// Construire le/la typeChampsContact
		return new TypeChampsContact($pdo,$pdo->lastInsertId(),$libel,$numberUsed,$position,$easyload);
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
		return $pdo->prepare('SELECT t.idTypeChampsContact, t.libel, t.numberUsed, t.position FROM TypeChampsContact t '.
		($where != null ? ' WHERE '.$where : '').
		($orderby != null ? ' ORDER BY '.$orderby : '').
		($limit != null ? ' LIMIT '.$limit : ''));
	}

	/**
	 * Charger un(e) typeChampsContact
	 * @param $pdo PDO
	 * @param $idTypeChampsContact int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return TypeChampsContact
	 */
	public static function load(PDO $pdo,$idTypeChampsContact,$easyload=true)
	{
		// D�j� charg�(e) ?
		if (isset(TypeChampsContact::$easyload[$idTypeChampsContact])) {
			return TypeChampsContact::$easyload[$idTypeChampsContact];
		}

		// Charger le/la typeChampsContact
		$pdoStatement = TypeChampsContact::_select($pdo,'t.idTypeChampsContact = ?');
		if (!$pdoStatement->execute(array($idTypeChampsContact))) {
			throw new Exception('Erreur lors du chargement d\'un(e) typeChampsContact depuis la base de donn�es');
		}

		// R�cup�rer le/la typeChampsContact depuis le jeu de r�sultats
		return TypeChampsContact::fetch($pdo,$pdoStatement,$easyload);
	}

	/**
	 * Charger tous/toutes les typeChampsContacts
	 * @param $pdo PDO
	 * @param $easyload bool activer le chargement rapide ?
	 * @return TypeChampsContact[] tableau de typechampscontacts
	 */
	public static function loadAll(PDO $pdo,$easyload=false)
	{
		// S�lectionner tous/toutes les typeChampsContacts
		$pdoStatement = TypeChampsContact::selectAll($pdo);

		// Mettre chaque typeChampsContact dans un tableau
		$typeChampsContacts = array();
		while ($typeChampsContact = TypeChampsContact::fetch($pdo,$pdoStatement,$easyload)) {
			$typeChampsContacts[] = $typeChampsContact;
		}

		// Retourner le tableau
		return $typeChampsContacts;
	}

	/**
	 * S�lectionner tous/toutes les typeChampsContacts
	 * @param $pdo PDO
	 * @return PDOStatement
	 */
	public static function selectAll(PDO $pdo)
	{
		$pdoStatement = TypeChampsContact::_select($pdo,'','t.position');
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les typeChampsContacts depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�re le/la typeChampsContact suivant(e) d'un jeu de r�sultats
	 * @param $pdo PDO
	 * @param $pdoStatement PDOStatement
	 * @param $easyload bool activer le chargement rapide ?
	 * @return TypeChampsContact
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idTypeChampsContact,$libel,$numberUsed,$position) = $values;

		// Construire le/la typeChampsContact
		return isset(TypeChampsContact::$easyload[$idTypeChampsContact.'-'.$libel.'-'.$numberUsed.'-'.$position]) ? TypeChampsContact::$easyload[$idTypeChampsContact.'-'.$libel.'-'.$numberUsed.'-'.$position] :
		new TypeChampsContact($pdo,$idTypeChampsContact,$libel,$numberUsed,$position,$easyload);
	}

	/**
	 * Serialiser
	 * @param $serialize bool activer la s�rialisation ?
	 * @return string serialisation du/de la typechampscontact
	 */
	public function serialize($serialize=true)
	{
		// S�rialiser le/la typeChampsContact
		$array = array('idTypeChampsContact' => $this->idTypeChampsContact,'libel' => $this->libel,'numberUsed' => $this->numberUsed,'position' => $this->position);

		// Retourner la serialisation (ou pas) du/de la typeChampsContact
		return $serialize ? serialize($array) : $array;
	}

	/**
	 * D�s�rialiser
	 * @param $pdo PDO
	 * @param $string string serialisation du/de la typechampscontact
	 * @param $easyload bool activer le chargement rapide ?
	 * @return TypeChampsContact
	 */
	public static function unserialize(PDO $pdo,$string,$easyload=true)
	{
		// D�s�rialiser la chaine de caract�res
		$array = unserialize($string);

		// Construire le/la typeChampsContact
		return isset(TypeChampsContact::$easyload[$array['idTypeChampsContact']]) ? TypeChampsContact::$easyload[$array['idTypeChampsContact']] :
		new TypeChampsContact($pdo,$array['idTypeChampsContact'],$array['libel'],$array['numberUsed'],$array['position'],$easyload);
	}

	/**
	 * Test d'�galit�
	 * @param $typeChampsContact TypeChampsContact
	 * @return bool les objets sont ils �gaux ?
	 */
	public function equals($typeChampsContact)
	{
		// Test si null
		if ($typeChampsContact == null) { return false; }

		// Tester la classe
		if (!($typeChampsContact instanceof TypeChampsContact)) { return false; }

		// Tester les ids
		return $this->idTypeChampsContact == $typeChampsContact->idTypeChampsContact;
	}

	/**
	 * Compter les typeChampsContacts
	 * @param $pdo PDO
	 * @return int nombre de typechampscontacts
	 */
	public static function count(PDO $pdo)
	{
		if (!($pdoStatement = $pdo->query('SELECT COUNT(idTypeChampsContact) FROM TypeChampsContact'))) {
			throw new Exception('Erreur lors du comptage des typeChampsContacts dans la base de donn�es');
		}
		return $pdoStatement->fetchColumn();
	}

	/**
	 * Supprimer le/la typeChampsContact
	 * @return bool op�ration r�ussie ?
	 */
	public function delete()
	{
		// Supprimer les champsContacts associ�(e)s
		$select = $this->selectChampsContacts();
		while ($champsContact = ChampsContact::fetch($this->pdo,$select)) {
			if (!$champsContact->delete()) { return false; }
		}

		// Supprimer le/la typeChampsContact
		$pdoStatement = $this->pdo->prepare('DELETE FROM TypeChampsContact WHERE idTypeChampsContact = ?');
		if (!$pdoStatement->execute(array($this->getIdTypeChampsContact()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) typeChampsContact dans la base de donn�es');
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
		$pdoStatement = $this->pdo->prepare('UPDATE TypeChampsContact SET '.implode(', ', $updates).' WHERE idTypeChampsContact = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdTypeChampsContact())))) {
			throw new Exception('Erreur lors de la mise � jour d\'un champ d\'un(e) typeChampsContact dans la base de donn�es');
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
		return $this->_set(array('libel','numberUsed','position'),array($this->libel,$this->numberUsed,$this->position));
	}

	/**
	 * R�cup�rer le/la idTypeChampsContact
	 * @return int
	 */
	public function getIdTypeChampsContact()
	{
		return $this->idTypeChampsContact;
	}
public function getId()
	{
		return $this->idTypeChampsContact;
	}
	/**
	 * R�cup�rer le/la libel
	 * @return string
	 */
	public function getLibel()
	{
		return $this->libel;
	}

	/**
	 * D�finir le/la libel
	 * @param $libel string
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setLibel($libel,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->libel = $libel;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('libel'),array($libel)) : true;
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
	 * R�cup�rer le/la position
	 * @return int
	 */
	public function getPosition()
	{
		return $this->position;
	}

	/**
	 * D�finir le/la position
	 * @param $position int
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setPosition($position,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->position = $position;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('position'),array($position)) : true;
	}

	/**
	 * S�lectionner les champsContacts
	 * @return PDOStatement
	 */
	public function selectChampsContacts()
	{
		return ChampsContact::selectByTypeChampsContact($this->pdo,$this);
	}
	/**
	 * ToString
	 * @return string repr�sentation de typechampscontact sous la forme d'un string
	 */
	public function __toString()
	{
		return '[TypeChampsContact idTypeChampsContact="'.$this->idTypeChampsContact.'" libel="'.$this->libel.'" numberUsed="'.$this->numberUsed.'" position="'.$this->position.'"]';
	}

	public static function getMaxPosition(Pdo $pdo){
		// récupération de la position la + haute
		$pdoStatement = $pdo->prepare('SELECT MAX(position) FROM TypeChampsContact');
		if (!$pdoStatement->execute( )) {
			throw new Exception('Erreur lors de la mise � jour d\'un champ d\'un(e) typeChampsContact dans la base de donn�es');
		}

		// Op�ration r�ussie ?
		$return = $pdoStatement->fetch();
		return $return['MAX(position)'];

	}


	/**
	 * Charger un(e) typeChampsContact
	 * @param $pdo PDO
	 * @param $position int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return TypeChampsContact
	 */
	public static function loadByPosition(PDO $pdo,$position,$easyload=true)
	{
		// D�j� charg�(e) ?


		// Charger le/la typeChampsContact
		$pdoStatement = TypeChampsContact::_select($pdo,'t.position = ?');
		if (!$pdoStatement->execute(array($position))) {
			throw new Exception('Erreur lors du chargement d\'un(e) typeChampsContact depuis la base de donn�es');
		}

		// R�cup�rer le/la typeChampsContact depuis le jeu de r�sultats
		return TypeChampsContact::fetch($pdo,$pdoStatement,$easyload);
	}



	public static function loadSupPosition(PDO $pdo,$position,$easyload=true)
	{
		// D�j� charg�(e) ?


		// Charger le/la typeChampsContact
		$pdoStatement = TypeChampsContact::_select($pdo,'t.position > ?');
		if (!$pdoStatement->execute(array($position))) {
			throw new Exception('Erreur lors du chargement d\'un(e) typeChampsContact depuis la base de donn�es');
		}

		// R�cup�rer le/la typeChampsContact depuis le jeu de r�sultats
		$typeChampsContacts = array();
		while ($typeChampsContact = TypeChampsContact::fetch($pdo,$pdoStatement,$easyload)) {
			$typeChampsContacts[] = $typeChampsContact;
		}

		// Retourner le tableau
		return $typeChampsContacts;
	}

}


