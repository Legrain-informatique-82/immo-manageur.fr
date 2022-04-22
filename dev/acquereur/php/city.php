<?php

/**
 * @class City
 * @date 21/03/2011 (dd/mm/yyyy)
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

	/// @var int
	private $n;

	/**
	 * Construire un(e) city
	 * @param $pdo PDO
	 * @param $idCity int
	 * @param $n int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return City
	 */
	protected function __construct(PDO $pdo,$idCity,$n,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;

		// Sauvegarder les attributs
		$this->idCity = $idCity;
		$this->n = $n;

		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			City::$easyload[$idCity] = $this;
		}
	}

	/**
	 * Cr�er un(e) city
	 * @param $pdo PDO
	 * @param $n int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return City
	 */
	public static function create(PDO $pdo,$n,$easyload=true)
	{
		// Ajouter le/la city dans la base de donn�es
		$pdoStatement = $pdo->prepare('INSERT INTO City (n) VALUES (?)');
		if (!$pdoStatement->execute(array($n))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) city dans la base de donn�es');
		}

		// Construire le/la city
		return new City($pdo,$pdo->lastInsertId(),$n,$easyload);
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
		return $pdo->prepare('SELECT c.idCity, c.n FROM City c '.
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
		list($idCity,$n) = $values;

		// Construire le/la city
		return isset(City::$easyload[$idCity.'-'.$n]) ? City::$easyload[$idCity.'-'.$n] :
		new City($pdo,$idCity,$n,$easyload);
	}

	/**
	 * Supprimer le/la city
	 * @return bool op�ration r�ussie ?
	 */
	public function delete()
	{
		// Supprimer les Acquereurs associ�(e)s
		$select = $this->selectAcquereurs();
		while ($acquereur = Acquereur::fetch($this->pdo,$select)) {
			if (!$acquereur->setRechercheCity(null)) { return false; }
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
		return $this->_set(array('n'),array($this->n));
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
	 * R�cup�rer le/la n
	 * @return int
	 */
	public function getN()
	{
		return $this->n;
	}

	/**
	 * D�finir le/la n
	 * @param $n int
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setN($n,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->n = $n;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('n'),array($n)) : true;
	}

	/**
	 * S�lectionner les acquereurs
	 * @return PDOStatement
	 */
	public function selectAcquereurs()
	{
		return Acquereur::selectByRechercheCity($this->pdo,$this);
	}
}

?>
