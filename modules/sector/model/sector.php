<?php

/**
 * @class Sector
 * @date 31/01/2011 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class Sector
{
	/// @var PDO
	private $pdo;

	/// @var array tableau pour le chargement rapide
	private static $easyload;

	/// @var int
	private $idSector;

	/// @var string
	private $name;

	/// @var int
	private $numberUsed;

	/**
	 * Construire un(e) sector
	 * @param $pdo PDO
	 * @param $idSector int
	 * @param $name string
	 * @param $numberUsed int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Sector
	 */
	protected function __construct(PDO $pdo,$idSector,$name,$numberUsed,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;

		// Sauvegarder les attributs
		$this->idSector = $idSector;
		$this->name = $name;
		$this->numberUsed = $numberUsed;

		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			Sector::$easyload[$idSector] = $this;
		}
	}

	/**
	 * Cr�er un(e) sector
	 * @param $pdo PDO
	 * @param $name string
	 * @param $numberUsed int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Sector
	 */
	public static function create(PDO $pdo,$name,$numberUsed,$easyload=true)
	{
		// Ajouter le/la sector dans la base de donn�es
		$pdoStatement = $pdo->prepare('INSERT INTO Sector (name,numberUsed) VALUES (?,?)');
		if (!$pdoStatement->execute(array($name,$numberUsed))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) sector dans la base de donn�es');
		}

		// Construire le/la sector
		return new Sector($pdo,$pdo->lastInsertId(),$name,$numberUsed,$easyload);
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
		return $pdo->prepare('SELECT s.idSector, s.name, s.numberUsed FROM Sector s '.
		($where != null ? ' WHERE '.$where : '').
		($orderby != null ? ' ORDERBY '.$orderby : '').
		($limit != null ? ' LIMIT '.$limit : ''));
	}

	/**
	 * Charger un(e) sector
	 * @param $pdo PDO
	 * @param $idSector int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Sector
	 */
	public static function load(PDO $pdo,$idSector,$easyload=true)
	{
		// D�j� charg�(e) ?
		if (isset(Sector::$easyload[$idSector])) {
			return Sector::$easyload[$idSector];
		}

		// Charger le/la sector
		$pdoStatement = Sector::_select($pdo,'s.idSector = ?');
		if (!$pdoStatement->execute(array($idSector))) {
			throw new Exception('Erreur lors du chargement d\'un(e) sector depuis la base de donn�es');
		}

		// R�cup�rer le/la sector depuis le jeu de r�sultats
		return Sector::fetch($pdo,$pdoStatement,$easyload);
	}

	/**
	 * Charger tous/toutes les sectors
	 * @param $pdo PDO
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Sector[] tableau de sectors
	 */
	public static function loadAll(PDO $pdo,$easyload=false)
	{
		// S�lectionner tous/toutes les sectors
		$pdoStatement = Sector::selectAll($pdo);

		// Mettre chaque sector dans un tableau
		$sectors = array();
		while ($sector = Sector::fetch($pdo,$pdoStatement,$easyload)) {
			$sectors[] = $sector;
		}

		// Retourner le tableau
		return $sectors;
	}

	/**
	 * S�lectionner tous/toutes les sectors
	 * @param $pdo PDO
	 * @return PDOStatement
	 */
	public static function selectAll(PDO $pdo)
	{
		$pdoStatement = Sector::_select($pdo);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les sectors depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�re le/la sector suivant(e) d'un jeu de r�sultats
	 * @param $pdo PDO
	 * @param $pdoStatement PDOStatement
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Sector
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idSector,$name,$numberUsed) = $values;

		// Construire le/la sector
		return isset(Sector::$easyload[$idSector.'-'.$name.'-'.$numberUsed]) ? Sector::$easyload[$idSector.'-'.$name.'-'.$numberUsed] :
		new Sector($pdo,$idSector,$name,$numberUsed,$easyload);
	}

	/**
	 * Serialiser
	 * @param $serialize bool activer la s�rialisation ?
	 * @return string serialisation du/de la sector
	 */
	public function serialize($serialize=true)
	{
		// S�rialiser le/la sector
		$array = array('idSector' => $this->idSector,'name' => $this->name,'numberUsed' => $this->numberUsed);

		// Retourner la serialisation (ou pas) du/de la sector
		return $serialize ? serialize($array) : $array;
	}

	/**
	 * D�s�rialiser
	 * @param $pdo PDO
	 * @param $string string serialisation du/de la sector
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Sector
	 */
	public static function unserialize(PDO $pdo,$string,$easyload=true)
	{
		// D�s�rialiser la chaine de caract�res
		$array = unserialize($string);

		// Construire le/la sector
		return isset(Sector::$easyload[$array['idSector']]) ? Sector::$easyload[$array['idSector']] :
		new Sector($pdo,$array['idSector'],$array['name'],$array['numberUsed'],$easyload);
	}

	/**
	 * Test d'�galit�
	 * @param $sector Sector
	 * @return bool les objets sont ils �gaux ?
	 */
	public function equals($sector)
	{
		// Test si null
		if ($sector == null) { return false; }

		// Tester la classe
		if (!($sector instanceof Sector)) { return false; }

		// Tester les ids
		return $this->idSector == $sector->idSector;
	}

	/**
	 * Compter les sectors
	 * @param $pdo PDO
	 * @return int nombre de sectors
	 */
	public static function count(PDO $pdo)
	{
		if (!($pdoStatement = $pdo->query('SELECT COUNT(idSector) FROM Sector'))) {
			throw new Exception('Erreur lors du comptage des sectors dans la base de donn�es');
		}
		return $pdoStatement->fetchColumn();
	}

	/**
	 * Supprimer le/la sector
	 * @return bool op�ration r�ussie ?
	 */
	public function delete()
	{
		// Supprimer les Citys associ�(e)s
		$select = $this->selectCitys();
		while ($city = City::fetch($this->pdo,$select)) {
			if (!$city->delete()) { return false; }
		}

		// Supprimer le/la sector
		$pdoStatement = $this->pdo->prepare('DELETE FROM Sector WHERE idSector = ?');
		if (!$pdoStatement->execute(array($this->getIdSector()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) sector dans la base de donn�es');
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
		$pdoStatement = $this->pdo->prepare('UPDATE Sector SET '.implode(', ', $updates).' WHERE idSector = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdSector())))) {
			throw new Exception('Erreur lors de la mise � jour d\'un champ d\'un(e) sector dans la base de donn�es');
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
		return $this->_set(array('name','numberUsed'),array($this->name,$this->numberUsed));
	}

	/**
	 * R�cup�rer le/la idSector
	 * @return int
	 */
	public function getIdSector()
	{
		return $this->idSector;
	}
	public function getId()
	{
		return $this->idSector;
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
	 * S�lectionner les citys
	 * @return PDOStatement
	 */
	public function selectCitys()
	{
		return City::selectBySector($this->pdo,$this);
	}
	/**
	 * ToString
	 * @return string repr�sentation de sector sous la forme d'un string
	 */
	public function __toString()
	{
		return '[Sector idSector="'.$this->idSector.'" name="'.$this->name.'" numberUsed="'.$this->numberUsed.'"]';
	}

}

?>
