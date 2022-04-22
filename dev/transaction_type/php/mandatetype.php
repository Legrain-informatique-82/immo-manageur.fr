<?php

/**
 * @class MandateType
 * @date 02/02/2011 (dd/mm/yyyy)
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

	/// @var string
	private $name;

	/// @var string
	private $exportCode;

	/**
	 * Construire un(e) mandateType
	 * @param $pdo PDO
	 * @param $idMandateType int
	 * @param $name string
	 * @param $exportCode string
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateType
	 */
	protected function __construct(PDO $pdo,$idMandateType,$name,$exportCode,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;

		// Sauvegarder les attributs
		$this->idMandateType = $idMandateType;
		$this->name = $name;
		$this->exportCode = $exportCode;

		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			MandateType::$easyload[$idMandateType] = $this;
		}
	}

	/**
	 * Cr�er un(e) mandateType
	 * @param $pdo PDO
	 * @param $name string
	 * @param $exportCode string
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateType
	 */
	public static function create(PDO $pdo,$name,$exportCode,$easyload=true)
	{
		// Ajouter le/la mandateType dans la base de donn�es
		$pdoStatement = $pdo->prepare('INSERT INTO MandateType (name,exportCode) VALUES (?,?)');
		if (!$pdoStatement->execute(array($name,$exportCode))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) mandateType dans la base de donn�es');
		}

		// Construire le/la mandateType
		return new MandateType($pdo,$pdo->lastInsertId(),$name,$exportCode,$easyload);
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
		return $pdo->prepare('SELECT m.idMandateType, m.name, m.exportCode FROM MandateType m '.
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
		list($idMandateType,$name,$exportCode) = $values;

		// Construire le/la mandateType
		return isset(MandateType::$easyload[$idMandateType.'-'.$name.'-'.$exportCode]) ? MandateType::$easyload[$idMandateType.'-'.$name.'-'.$exportCode] :
		new MandateType($pdo,$idMandateType,$name,$exportCode,$easyload);
	}

	/**
	 * Supprimer le/la mandateType
	 * @return bool op�ration r�ussie ?
	 */
	public function delete()
	{
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
		return $this->_set(array('name','exportCode'),array($this->name,$this->exportCode));
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
	 * R�cup�rer le/la exportCode
	 * @return string
	 */
	public function getExportCode()
	{
		return $this->exportCode;
	}

	/**
	 * D�finir le/la exportCode
	 * @param $exportCode string
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setExportCode($exportCode,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->exportCode = $exportCode;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('exportCode'),array($exportCode)) : true;
	}
}

?>
