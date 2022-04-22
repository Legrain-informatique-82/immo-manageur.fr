<?php

/**
 * @class Dpe
 * @date 03/02/2011 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class Dpe
{
	/// @var PDO
	private $pdo;

	/// @var array tableau pour le chargement rapide
	private static $easyload;

	/// @var int
	private $idDpe;

	/// @var string
	private $name;

	/// @var int
	private $fromValue;

	/// @var int
	private $toValue;

	/// @var int
	private $position;

	/**
	 * Construire un(e) dpe
	 * @param $pdo PDO
	 * @param $idDpe int
	 * @param $name string
	 * @param $fromValue int
	 * @param $toValue int
	 * @param $position int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Dpe
	 */
	protected function __construct(PDO $pdo,$idDpe,$name,$fromValue,$toValue,$position,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;

		// Sauvegarder les attributs
		$this->idDpe = $idDpe;
		$this->name = $name;
		$this->fromValue = $fromValue;
		$this->toValue = $toValue;
		$this->position = $position;

		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			Dpe::$easyload[$idDpe] = $this;
		}
	}

	/**
	 * Créer un(e) dpe
	 * @param $pdo PDO
	 * @param $name string
	 * @param $fromValue int
	 * @param $toValue int
	 * @param $position int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Dpe
	 */
	public static function create(PDO $pdo,$name,$fromValue,$toValue,$position,$easyload=true)
	{
		// Ajouter le/la dpe dans la base de données
		$pdoStatement = $pdo->prepare('INSERT INTO Dpe (name,fromValue,toValue,position) VALUES (?,?,?,?)');
		if (!$pdoStatement->execute(array($name,$fromValue,$toValue,$position))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) dpe dans la base de données');
		}

		// Construire le/la dpe
		return new Dpe($pdo,$pdo->lastInsertId(),$name,$fromValue,$toValue,$position,$easyload);
	}

	/**
	 * Requête de séléction
	 * @param $pdo PDO
	 * @param $where string
	 * @param $orderby string
	 * @param $limit string
	 * @return PDOStatement
	 */
	private static function _select(PDO $pdo,$where=null,$orderby=null,$limit=null)
	{
		return $pdo->prepare('SELECT d.idDpe, d.name, d.fromValue, d.toValue, d.position FROM Dpe d '.
		($where != null ? ' WHERE '.$where : '').
		($orderby != null ? ' ORDER BY '.$orderby : '').
		($limit != null ? ' LIMIT '.$limit : ''));
	}

	/**
	 * Charger un(e) dpe
	 * @param $pdo PDO
	 * @param $idDpe int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Dpe
	 */
	public static function load(PDO $pdo,$idDpe,$easyload=true)
	{
		// Déjà chargé(e) ?
		if (isset(Dpe::$easyload[$idDpe])) {
			return Dpe::$easyload[$idDpe];
		}

		// Charger le/la dpe
		$pdoStatement = Dpe::_select($pdo,'d.idDpe = ?');
		if (!$pdoStatement->execute(array($idDpe))) {
			throw new Exception('Erreur lors du chargement d\'un(e) dpe depuis la base de données');
		}

		// Récupérer le/la dpe depuis le jeu de résultats
		return Dpe::fetch($pdo,$pdoStatement,$easyload);
	}

	/**
	 * Charger tous/toutes les dpes
	 * @param $pdo PDO
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Dpe[] tableau de dpes
	 */
	public static function loadAll(PDO $pdo,$easyload=false)
	{
		// Sélectionner tous/toutes les dpes
		$pdoStatement = Dpe::selectAll($pdo);

		// Mettre chaque dpe dans un tableau
		$dpes = array();
		while ($dpe = Dpe::fetch($pdo,$pdoStatement,$easyload)) {
			$dpes[] = $dpe;
		}

		// Retourner le tableau
		return $dpes;
	}

	/**
	 * Sélectionner tous/toutes les dpes
	 * @param $pdo PDO
	 * @return PDOStatement
	 */
	public static function selectAll(PDO $pdo)
	{
		$pdoStatement = Dpe::_select($pdo);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les dpes depuis la base de données');
		}
		return $pdoStatement;
	}

	/**
	 * Récupère le/la dpe suivant(e) d'un jeu de résultats
	 * @param $pdo PDO
	 * @param $pdoStatement PDOStatement
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Dpe
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idDpe,$name,$fromValue,$toValue,$position) = $values;

		// Construire le/la dpe
		return isset(Dpe::$easyload[$idDpe.'-'.$name.'-'.$fromValue.'-'.$toValue.'-'.$position]) ? Dpe::$easyload[$idDpe.'-'.$name.'-'.$fromValue.'-'.$toValue.'-'.$position] :
		new Dpe($pdo,$idDpe,$name,$fromValue,$toValue,$position,$easyload);
	}

	/**
	 * Supprimer le/la dpe
	 * @return bool opération réussie ?
	 */
	public function delete()
	{
		// Supprimer le/la dpe
		$pdoStatement = $this->pdo->prepare('DELETE FROM Dpe WHERE idDpe = ?');
		if (!$pdoStatement->execute(array($this->getIdDpe()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) dpe dans la base de données');
		}

		// Opération réussie ?
		return $pdoStatement->rowCount() == 1;
	}

	/**
	 * Mettre à jour un champ dans la base de données
	 * @param $fields array
	 * @param $values array
	 * @return bool opération réussie ?
	 */
	private function _set($fields,$values)
	{
		// Préparer la mise à jour
		$updates = array();
		foreach ($fields as $field) {
			$updates[] = $field.' = ?';
		}

		// Mettre à jour le champ
		$pdoStatement = $this->pdo->prepare('UPDATE Dpe SET '.implode(', ', $updates).' WHERE idDpe = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdDpe())))) {
			throw new Exception('Erreur lors de la mise à jour d\'un champ d\'un(e) dpe dans la base de données');
		}

		// Opération réussie ?
		return $pdoStatement->rowCount() == 1;
	}

	/**
	 * Mettre à jour tous les champs dans la base de données
	 * @return bool opération réussie ?
	 */
	public function update()
	{
		return $this->_set(array('name','fromValue','toValue','position'),array($this->name,$this->fromValue,$this->toValue,$this->position));
	}

	/**
	 * Récupérer le/la idDpe
	 * @return int
	 */
	public function getIdDpe()
	{
		return $this->idDpe;
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
	 * Définir le/la name
	 * @param $name string
	 * @param $execute bool exécuter la requête update ?
	 * @return bool opération réussie ?
	 */
	public function setName($name,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->name = $name;

		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array('name'),array($name)) : true;
	}

	/**
	 * Récupérer le/la fromValue
	 * @return int
	 */
	public function getFromValue()
	{
		return $this->fromValue;
	}

	/**
	 * Définir le/la fromValue
	 * @param $fromValue int
	 * @param $execute bool exécuter la requête update ?
	 * @return bool opération réussie ?
	 */
	public function setFromValue($fromValue,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->fromValue = $fromValue;

		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array('fromValue'),array($fromValue)) : true;
	}

	/**
	 * Récupérer le/la toValue
	 * @return int
	 */
	public function getToValue()
	{
		return $this->toValue;
	}

	/**
	 * Définir le/la toValue
	 * @param $toValue int
	 * @param $execute bool exécuter la requête update ?
	 * @return bool opération réussie ?
	 */
	public function setTo($toValue,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->toValue = $toValue;

		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array('toValue'),array($toValue)) : true;
	}

	/**
	 * Récupérer le/la position
	 * @return int
	 */
	public function getPosition()
	{
		return $this->position;
	}

	/**
	 * Définir le/la position
	 * @param $position int
	 * @param $execute bool exécuter la requête update ?
	 * @return bool opération réussie ?
	 */
	public function setPosition($position,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->position = $position;

		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array('position'),array($position)) : true;
	}
}

?>

