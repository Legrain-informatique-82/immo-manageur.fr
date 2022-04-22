<?php

/**
 * @class City
 * @date 07/02/2011 (dd/mm/yyyy)
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

	/**
	 * Construire un(e) city
	 * @param $pdo PDO
	 * @param $idCity int
	 * @param $name string
	 * @param $easyload bool activer le chargement rapide ?
	 * @return City
	 */
	protected function __construct(PDO $pdo,$idCity,$name,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;

		// Sauvegarder les attributs
		$this->idCity = $idCity;
		$this->name = $name;

		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			City::$easyload[$idCity] = $this;
		}
	}

	/**
	 * Cr�er un(e) city
	 * @param $pdo PDO
	 * @param $name string
	 * @param $easyload bool activer le chargement rapide ?
	 * @return City
	 */
	public static function create(PDO $pdo,$name,$easyload=true)
	{
		// Ajouter le/la city dans la base de donn�es
		$pdoStatement = $pdo->prepare('INSERT INTO City (name) VALUES (?)');
		if (!$pdoStatement->execute(array($name))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) city dans la base de donn�es');
		}

		// Construire le/la city
		return new City($pdo,$pdo->lastInsertId(),$name,$easyload);
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
		return $pdo->prepare('SELECT c.idCity, c.name FROM City c '.
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
		list($idCity,$name) = $values;

		// Construire le/la city
		return isset(City::$easyload[$idCity.'-'.$name]) ? City::$easyload[$idCity.'-'.$name] :
		new City($pdo,$idCity,$name,$easyload);
	}

	/**
	 * Supprimer le/la city
	 * @return bool op�ration r�ussie ?
	 */
	public function delete()
	{
		// Supprimer les Sellers associ�(e)s
		$select = $this->selectSellers();
		while ($seller = Seller::fetch($this->pdo,$select)) {
			if (!$seller->delete()) { return false; }
		}

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
		return $this->_set(array('name'),array($this->name));
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
	 * S�lectionner les sellers
	 * @return PDOStatement
	 */
	public function selectSellers()
	{
		return Seller::selectByCity($this->pdo,$this);
	}
}

?>
