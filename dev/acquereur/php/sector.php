<?php

/**
 * @class Sector
 * @date 21/03/2011 (dd/mm/yyyy)
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

	/// @var int
	private $n;

	/**
	 * Construire un(e) sector
	 * @param $pdo PDO
	 * @param $idSector int
	 * @param $n int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Sector
	 */
	protected function __construct(PDO $pdo,$idSector,$n,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;

		// Sauvegarder les attributs
		$this->idSector = $idSector;
		$this->n = $n;

		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			Sector::$easyload[$idSector] = $this;
		}
	}

	/**
	 * Cr�er un(e) sector
	 * @param $pdo PDO
	 * @param $n int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Sector
	 */
	public static function create(PDO $pdo,$n,$easyload=true)
	{
		// Ajouter le/la sector dans la base de donn�es
		$pdoStatement = $pdo->prepare('INSERT INTO Sector (n) VALUES (?)');
		if (!$pdoStatement->execute(array($n))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) sector dans la base de donn�es');
		}

		// Construire le/la sector
		return new Sector($pdo,$pdo->lastInsertId(),$n,$easyload);
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
		return $pdo->prepare('SELECT s.idSector, s.n FROM Sector s '.
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
		list($idSector,$n) = $values;

		// Construire le/la sector
		return isset(Sector::$easyload[$idSector.'-'.$n]) ? Sector::$easyload[$idSector.'-'.$n] :
		new Sector($pdo,$idSector,$n,$easyload);
	}

	/**
	 * Supprimer le/la sector
	 * @return bool op�ration r�ussie ?
	 */
	public function delete()
	{
		// Supprimer les Acquereurs associ�(e)s
		$select = $this->selectAcquereurs();
		while ($acquereur = Acquereur::fetch($this->pdo,$select)) {
			if (!$acquereur->setRechercheSector(null)) { return false; }
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
		return $this->_set(array('n'),array($this->n));
	}

	/**
	 * R�cup�rer le/la idSector
	 * @return int
	 */
	public function getIdSector()
	{
		return $this->idSector;
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
		return Acquereur::selectByRechercheSector($this->pdo,$this);
	}
}

?>
