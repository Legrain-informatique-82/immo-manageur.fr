<?php

/**
 * @class City
 * @date 31/01/2011 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class City
{
	/// @var PDO
	private $pdo;

	/// @var array tableau pour le chargement rapide
	private static $easyload;

	/// @var int
	private $idCity;

	/// @var string
	private $name;

	/// @var string
	private $zipCode;

	/// @var int
	private $numberUsed;

	/// @var int id de sector
	private $sector;

	/**
	 * Construire un(e) city
	 * @param $pdo PDO
	 * @param $idCity int
	 * @param $name string
	 * @param $zipCode string
	 * @param $numberUsed int
	 * @param $sector int id de sector
	 * @param $easyload bool activer le chargement rapide ?
	 * @return City
	 */
	protected function __construct(PDO $pdo,$idCity,$name,$zipCode,$numberUsed,$sector,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;

		// Sauvegarder les attributs
		$this->idCity = $idCity;
		$this->name = $name;
		$this->zipCode = $zipCode;
		$this->numberUsed = $numberUsed;
		$this->sector = $sector;

		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			City::$easyload[$idCity] = $this;
		}
	}

	/**
	 * Cr�er un(e) city
	 * @param $pdo PDO
	 * @param $name string
	 * @param $zipCode string
	 * @param $numberUsed int
	 * @param $sector Sector
	 * @param $easyload bool activer le chargement rapide ?
	 * @return City
	 */
	public static function create(PDO $pdo,$name,$zipCode,$numberUsed,Sector $sector,$easyload=true)
	{
		// Ajouter le/la city dans la base de donn�es
		$pdoStatement = $pdo->prepare('INSERT INTO City (name,zipCode,numberUsed,sector_idSector) VALUES (?,?,?,?)');
		if (!$pdoStatement->execute(array($name,$zipCode,$numberUsed,$sector->getIdSector()))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) city dans la base de donn�es');
		}

		// Construire le/la city
		return new City($pdo,$pdo->lastInsertId(),$name,$zipCode,$numberUsed,$sector->getIdSector(),$easyload);
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
		return $pdo->prepare('SELECT c.idCity, c.name, c.zipCode, c.numberUsed, c.sector_idSector FROM City c '.
		($where != null ? ' WHERE '.$where : '').
		($orderby != null ? ' ORDERBY '.$orderby : '').
		($limit != null ? ' LIMIT '.$limit : ''));
	}

	/**
	 * Charger un(e) city
	 * @param $pdo PDO
	 * @param $idCity int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return City
	 */
	public static function load(PDO $pdo,$idCity,$easyload=true)
	{
		// D�j� charg�(e) ?
		if (isset(City::$easyload[$idCity])) {
			return City::$easyload[$idCity];
		}

		// Charger le/la city
		$pdoStatement = City::_select($pdo,'c.idCity = ?');
		if (!$pdoStatement->execute(array($idCity))) {
			throw new Exception('Erreur lors du chargement d\'un(e) city depuis la base de donn�es');
		}

		// R�cup�rer le/la city depuis le jeu de r�sultats
		return City::fetch($pdo,$pdoStatement,$easyload);
	}

	/**
	 * Charger tous/toutes les citys
	 * @param $pdo PDO
	 * @param $easyload bool activer le chargement rapide ?
	 * @return City[] tableau de citys
	 */
	public static function loadAll(PDO $pdo,$easyload=false)
	{
		// S�lectionner tous/toutes les citys
		$pdoStatement = City::selectAll($pdo);

		// Mettre chaque city dans un tableau
		$citys = array();
		while ($city = City::fetch($pdo,$pdoStatement,$easyload)) {
			$citys[] = $city;
		}

		// Retourner le tableau
		return $citys;
	}

	/**
	 * S�lectionner tous/toutes les citys
	 * @param $pdo PDO
	 * @return PDOStatement
	 */
	public static function selectAll(PDO $pdo)
	{
		$pdoStatement = City::_select($pdo);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les citys depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�re le/la city suivant(e) d'un jeu de r�sultats
	 * @param $pdo PDO
	 * @param $pdoStatement PDOStatement
	 * @param $easyload bool activer le chargement rapide ?
	 * @return City
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idCity,$name,$zipCode,$numberUsed,$sector) = $values;

		// Construire le/la city
		return isset(City::$easyload[$idCity.'-'.$name.'-'.$zipCode.'-'.$numberUsed.'-'.$sector]) ? City::$easyload[$idCity.'-'.$name.'-'.$zipCode.'-'.$numberUsed.'-'.$sector] :
		new City($pdo,$idCity,$name,$zipCode,$numberUsed,$sector,$easyload);
	}

	/**
	 * Serialiser
	 * @param $serialize bool activer la s�rialisation ?
	 * @return string serialisation du/de la city
	 */
	public function serialize($serialize=true)
	{
		// S�rialiser le/la city
		$array = array('idCity' => $this->idCity,'name' => $this->name,'zipCode' => $this->zipCode,'numberUsed' => $this->numberUsed,'sector' => $this->sector);

		// Retourner la serialisation (ou pas) du/de la city
		return $serialize ? serialize($array) : $array;
	}

	/**
	 * D�s�rialiser
	 * @param $pdo PDO
	 * @param $string string serialisation du/de la city
	 * @param $easyload bool activer le chargement rapide ?
	 * @return City
	 */
	public static function unserialize(PDO $pdo,$string,$easyload=true)
	{
		// D�s�rialiser la chaine de caract�res
		$array = unserialize($string);

		// Construire le/la city
		return isset(City::$easyload[$array['idCity']]) ? City::$easyload[$array['idCity']] :
		new City($pdo,$array['idCity'],$array['name'],$array['zipCode'],$array['numberUsed'],$array['sector'],$easyload);
	}

	/**
	 * Test d'�galit�
	 * @param $city City
	 * @return bool les objets sont ils �gaux ?
	 */
	public function equals($city)
	{
		// Test si null
		if ($city == null) { return false; }

		// Tester la classe
		if (!($city instanceof City)) { return false; }

		// Tester les ids
		return $this->idCity == $city->idCity;
	}

	/**
	 * Compter les citys
	 * @param $pdo PDO
	 * @return int nombre de citys
	 */
	public static function count(PDO $pdo)
	{
		if (!($pdoStatement = $pdo->query('SELECT COUNT(idCity) FROM City'))) {
			throw new Exception('Erreur lors du comptage des citys dans la base de donn�es');
		}
		return $pdoStatement->fetchColumn();
	}

	/**
	 * Supprimer le/la city
	 * @return bool op�ration r�ussie ?
	 */
	public function delete()
	{
		// Supprimer le/la city
		$pdoStatement = $this->pdo->prepare('DELETE FROM City WHERE idCity = ?');
		if (!$pdoStatement->execute(array($this->getIdCity()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) city dans la base de donn�es');
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
		$pdoStatement = $this->pdo->prepare('UPDATE City SET '.implode(', ', $updates).' WHERE idCity = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdCity())))) {
			throw new Exception('Erreur lors de la mise � jour d\'un champ d\'un(e) city dans la base de donn�es');
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
		return $this->_set(array('name','zipCode','numberUsed','sector_idSector'),array($this->name,$this->zipCode,$this->numberUsed,$this->sector));
	}

	/**
	 * R�cup�rer le/la idCity
	 * @return int
	 */
	public function getIdCity()
	{
		return $this->idCity;
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
	 * R�cup�rer le/la sector
	 * @return Sector
	 */
	public function getSector()
	{
		return Sector::load($this->pdo,$this->sector);
	}

	/**
	 * D�finir le/la sector
	 * @param $sector Sector
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setSector(Sector $sector,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->sector = $sector->getIdSector();

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('sector_idSector'),array($sector->getIdSector())) : true;
	}

	/**
	 * S�lectionner les citys par sector
	 * @param $pdo PDO
	 * @param $sector Sector
	 * @return PDOStatement
	 */
	public static function selectBySector(PDO $pdo,Sector $sector)
	{
		$pdoStatement = $pdo->prepare('SELECT c.idCity, c.name, c.zipCode, c.numberUsed, c.sector_idSector FROM City c WHERE c.sector_idSector = ?');
		if (!$pdoStatement->execute(array($sector->getIdSector()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les citys par sector depuis la base de donn�es');
		}
		return $pdoStatement;
	}
	/**
	 * ToString
	 * @return string repr�sentation de city sous la forme d'un string
	 */
	public function __toString()
	{
		return '[City idCity="'.$this->idCity.'" name="'.$this->name.'" zipCode="'.$this->zipCode.'" numberUsed="'.$this->numberUsed.'" sector="'.$this->sector.'"]';
	}

}

?>
