<?php

/**
 * @class TransactionType
 * @date 02/02/2011 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class TransactionType
{
	/// @var PDO
	private $pdo;

	/// @var array tableau pour le chargement rapide
	private static $easyload;

	/// @var int
	private $idTransactionType;

	/// @var string
	private $name;

	/// @var string
	private $exportCode;

	/**
	 * Construire un(e) transactionType
	 * @param $pdo PDO
	 * @param $idTransactionType int
	 * @param $name string
	 * @param $exportCode string
	 * @param $easyload bool activer le chargement rapide ?
	 * @return TransactionType
	 */
	protected function __construct(PDO $pdo,$idTransactionType,$name,$exportCode,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;

		// Sauvegarder les attributs
		$this->idTransactionType = $idTransactionType;
		$this->name = $name;
		$this->exportCode = $exportCode;

		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			TransactionType::$easyload[$idTransactionType] = $this;
		}
	}

	/**
	 * Cr�er un(e) transactionType
	 * @param $pdo PDO
	 * @param $name string
	 * @param $exportCode string
	 * @param $easyload bool activer le chargement rapide ?
	 * @return TransactionType
	 */
	public static function create(PDO $pdo,$name,$exportCode,$easyload=true)
	{
		// Ajouter le/la transactionType dans la base de donn�es
		$pdoStatement = $pdo->prepare('INSERT INTO TransactionType (name,exportCode) VALUES (?,?)');
		if (!$pdoStatement->execute(array($name,$exportCode))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) transactionType dans la base de donn�es');
		}

		// Construire le/la transactionType
		return new TransactionType($pdo,$pdo->lastInsertId(),$name,$exportCode,$easyload);
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
		return $pdo->prepare('SELECT t.idTransactionType, t.name, t.exportCode FROM TransactionType t '.
		($where != null ? ' WHERE '.$where : '').
		($orderby != null ? ' ORDERBY '.$orderby : '').
		($limit != null ? ' LIMIT '.$limit : ''));
	}

	/**
	 * Charger un(e) transactionType
	 * @param $pdo PDO
	 * @param $idTransactionType int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return TransactionType
	 */
	public static function load(PDO $pdo,$idTransactionType,$easyload=true)
	{
		// D�j� charg�(e) ?
		if (isset(TransactionType::$easyload[$idTransactionType])) {
			return TransactionType::$easyload[$idTransactionType];
		}

		// Charger le/la transactionType
		$pdoStatement = TransactionType::_select($pdo,'t.idTransactionType = ?');
		if (!$pdoStatement->execute(array($idTransactionType))) {
			throw new Exception('Erreur lors du chargement d\'un(e) transactionType depuis la base de donn�es');
		}

		// R�cup�rer le/la transactionType depuis le jeu de r�sultats
		return TransactionType::fetch($pdo,$pdoStatement,$easyload);
	}

	/**
	 * Charger tous/toutes les transactionTypes
	 * @param $pdo PDO
	 * @param $easyload bool activer le chargement rapide ?
	 * @return TransactionType[] tableau de transactiontypes
	 */
	public static function loadAll(PDO $pdo,$easyload=false)
	{
		// S�lectionner tous/toutes les transactionTypes
		$pdoStatement = TransactionType::selectAll($pdo);

		// Mettre chaque transactionType dans un tableau
		$transactionTypes = array();
		while ($transactionType = TransactionType::fetch($pdo,$pdoStatement,$easyload)) {
			$transactionTypes[] = $transactionType;
		}

		// Retourner le tableau
		return $transactionTypes;
	}

	/**
	 * S�lectionner tous/toutes les transactionTypes
	 * @param $pdo PDO
	 * @return PDOStatement
	 */
	public static function selectAll(PDO $pdo)
	{
		$pdoStatement = TransactionType::_select($pdo);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les transactionTypes depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�re le/la transactionType suivant(e) d'un jeu de r�sultats
	 * @param $pdo PDO
	 * @param $pdoStatement PDOStatement
	 * @param $easyload bool activer le chargement rapide ?
	 * @return TransactionType
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idTransactionType,$name,$exportCode) = $values;

		// Construire le/la transactionType
		return isset(TransactionType::$easyload[$idTransactionType.'-'.$name.'-'.$exportCode]) ? TransactionType::$easyload[$idTransactionType.'-'.$name.'-'.$exportCode] :
		new TransactionType($pdo,$idTransactionType,$name,$exportCode,$easyload);
	}

	/**
	 * Supprimer le/la transactionType
	 * @return bool op�ration r�ussie ?
	 */
	public function delete()
	{
		// Supprimer le/la transactionType
		$pdoStatement = $this->pdo->prepare('DELETE FROM TransactionType WHERE idTransactionType = ?');
		if (!$pdoStatement->execute(array($this->getIdTransactionType()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) transactionType dans la base de donn�es');
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
		$pdoStatement = $this->pdo->prepare('UPDATE TransactionType SET '.implode(', ', $updates).' WHERE idTransactionType = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdTransactionType())))) {
			throw new Exception('Erreur lors de la mise � jour d\'un champ d\'un(e) transactionType dans la base de donn�es');
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
	 * R�cup�rer le/la idTransactionType
	 * @return int
	 */
	public function getIdTransactionType()
	{
		return $this->idTransactionType;
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
