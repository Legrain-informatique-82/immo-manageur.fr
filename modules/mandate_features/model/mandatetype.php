<?php

/**
 * @class MandateType
 * @date 10/02/2011 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class MandateType
{
	/// @var PDO
	private $pdo;

	/// @var array tableau pour le chargement rapide
	private static $easyload;

	/// @var int
	private $idMandateType;

	/// @var int
	private $n;

	/**
	 * Construire un(e) mandateType
	 * @param $pdo PDO
	 * @param $idMandateType int
	 * @param $n int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateType
	 */
	protected function __construct(PDO $pdo,$idMandateType,$n,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;

		// Sauvegarder les attributs
		$this->idMandateType = $idMandateType;
		$this->n = $n;

		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			MandateType::$easyload[$idMandateType] = $this;
		}
	}

	/**
	 * Cr�er un(e) mandateType
	 * @param $pdo PDO
	 * @param $n int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateType
	 */
	public static function create(PDO $pdo,$n,$easyload=true)
	{
		// Ajouter le/la mandateType dans la base de donn�es
		$pdoStatement = $pdo->prepare('INSERT INTO MandateType (n) VALUES (?)');
		if (!$pdoStatement->execute(array($n))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) mandateType dans la base de donn�es');
		}

		// Construire le/la mandateType
		return new MandateType($pdo,$pdo->lastInsertId(),$n,$easyload);
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
		return $pdo->prepare('SELECT m.idMandateType, m.n FROM MandateType m '.
		($where != null ? ' WHERE '.$where : '').
		($orderby != null ? ' ORDERBY '.$orderby : '').
		($limit != null ? ' LIMIT '.$limit : ''));
	}

	/**
	 * Charger un(e) mandateType
	 * @param $pdo PDO
	 * @param $idMandateType int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateType
	 */
	public static function load(PDO $pdo,$idMandateType,$easyload=true)
	{
		// D�j� charg�(e) ?
		if (isset(MandateType::$easyload[$idMandateType])) {
			return MandateType::$easyload[$idMandateType];
		}

		// Charger le/la mandateType
		$pdoStatement = MandateType::_select($pdo,'m.idMandateType = ?');
		if (!$pdoStatement->execute(array($idMandateType))) {
			throw new Exception('Erreur lors du chargement d\'un(e) mandateType depuis la base de donn�es');
		}

		// R�cup�rer le/la mandateType depuis le jeu de r�sultats
		return MandateType::fetch($pdo,$pdoStatement,$easyload);
	}

	/**
	 * Charger tous/toutes les mandateTypes
	 * @param $pdo PDO
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateType[] tableau de mandatetypes
	 */
	public static function loadAll(PDO $pdo,$easyload=false)
	{
		// S�lectionner tous/toutes les mandateTypes
		$pdoStatement = MandateType::selectAll($pdo);

		// Mettre chaque mandateType dans un tableau
		$mandateTypes = array();
		while ($mandateType = MandateType::fetch($pdo,$pdoStatement,$easyload)) {
			$mandateTypes[] = $mandateType;
		}

		// Retourner le tableau
		return $mandateTypes;
	}

	/**
	 * S�lectionner tous/toutes les mandateTypes
	 * @param $pdo PDO
	 * @return PDOStatement
	 */
	public static function selectAll(PDO $pdo)
	{
		$pdoStatement = MandateType::_select($pdo);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les mandateTypes depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�re le/la mandateType suivant(e) d'un jeu de r�sultats
	 * @param $pdo PDO
	 * @param $pdoStatement PDOStatement
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateType
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idMandateType,$n) = $values;

		// Construire le/la mandateType
		return isset(MandateType::$easyload[$idMandateType.'-'.$n]) ? MandateType::$easyload[$idMandateType.'-'.$n] :
		new MandateType($pdo,$idMandateType,$n,$easyload);
	}

	/**
	 * Supprimer le/la mandateType
	 * @return bool op�ration r�ussie ?
	 */
	public function delete()
	{
		// Supprimer les mandates associ�(e)s
		$select = $this->selectMandates();
		while ($mandate = Mandate::fetch($this->pdo,$select)) {
			if (!$mandate->delete()) { return false; }
		}

		// Supprimer le/la mandateType
		$pdoStatement = $this->pdo->prepare('DELETE FROM MandateType WHERE idMandateType = ?');
		if (!$pdoStatement->execute(array($this->getIdMandateType()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) mandateType dans la base de donn�es');
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
		$pdoStatement = $this->pdo->prepare('UPDATE MandateType SET '.implode(', ', $updates).' WHERE idMandateType = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdMandateType())))) {
			throw new Exception('Erreur lors de la mise � jour d\'un champ d\'un(e) mandateType dans la base de donn�es');
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
	 * R�cup�rer le/la idMandateType
	 * @return int
	 */
	public function getIdMandateType()
	{
		return $this->idMandateType;
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
	 * S�lectionner les mandates
	 * @return PDOStatement
	 */
	public function selectMandates()
	{
		return Mandate::selectByMandateType($this->pdo,$this);
	}
}

?>
