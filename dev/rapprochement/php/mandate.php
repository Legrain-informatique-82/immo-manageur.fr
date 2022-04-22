<?php

/**
 * @class Mandate
 * @date 30/03/2011 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class Mandate
{
	/// @var PDO
	private $pdo;

	/// @var array tableau pour le chargement rapide
	private static $easyload;

	/// @var int
	private $idMandate;

	/// @var int
	private $n;

	/**
	 * Construire un(e) mandate
	 * @param $pdo PDO
	 * @param $idMandate int
	 * @param $n int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Mandate
	 */
	protected function __construct(PDO $pdo,$idMandate,$n,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;

		// Sauvegarder les attributs
		$this->idMandate = $idMandate;
		$this->n = $n;

		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			Mandate::$easyload[$idMandate] = $this;
		}
	}

	/**
	 * Cr�er un(e) mandate
	 * @param $pdo PDO
	 * @param $n int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Mandate
	 */
	public static function create(PDO $pdo,$n,$easyload=true)
	{
		// Ajouter le/la mandate dans la base de donn�es
		$pdoStatement = $pdo->prepare('INSERT INTO Mandate (n) VALUES (?)');
		if (!$pdoStatement->execute(array($n))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) mandate dans la base de donn�es');
		}

		// Construire le/la mandate
		return new Mandate($pdo,$pdo->lastInsertId(),$n,$easyload);
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
		return $pdo->prepare('SELECT m.idMandate, m.n FROM Mandate m '.
		($where != null ? ' WHERE '.$where : '').
		($orderby != null ? ' ORDERBY '.$orderby : '').
		($limit != null ? ' LIMIT '.$limit : ''));
	}

	/**
	 * Charger un(e) mandate
	 * @param $pdo PDO
	 * @param $idMandate int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Mandate
	 */
	public static function load(PDO $pdo,$idMandate,$easyload=true)
	{
		// D�j� charg�(e) ?
		if (isset(Mandate::$easyload[$idMandate])) {
			return Mandate::$easyload[$idMandate];
		}

		// Charger le/la mandate
		$pdoStatement = Mandate::_select($pdo,'m.idMandate = ?');
		if (!$pdoStatement->execute(array($idMandate))) {
			throw new Exception('Erreur lors du chargement d\'un(e) mandate depuis la base de donn�es');
		}

		// R�cup�rer le/la mandate depuis le jeu de r�sultats
		return Mandate::fetch($pdo,$pdoStatement,$easyload);
	}

	/**
	 * Charger tous/toutes les mandates
	 * @param $pdo PDO
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Mandate[] tableau de mandates
	 */
	public static function loadAll(PDO $pdo,$easyload=false)
	{
		// S�lectionner tous/toutes les mandates
		$pdoStatement = Mandate::selectAll($pdo);

		// Mettre chaque mandate dans un tableau
		$mandates = array();
		while ($mandate = Mandate::fetch($pdo,$pdoStatement,$easyload)) {
			$mandates[] = $mandate;
		}

		// Retourner le tableau
		return $mandates;
	}

	/**
	 * S�lectionner tous/toutes les mandates
	 * @param $pdo PDO
	 * @return PDOStatement
	 */
	public static function selectAll(PDO $pdo)
	{
		$pdoStatement = Mandate::_select($pdo);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les mandates depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�re le/la mandate suivant(e) d'un jeu de r�sultats
	 * @param $pdo PDO
	 * @param $pdoStatement PDOStatement
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Mandate
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idMandate,$n) = $values;

		// Construire le/la mandate
		return isset(Mandate::$easyload[$idMandate.'-'.$n]) ? Mandate::$easyload[$idMandate.'-'.$n] :
		new Mandate($pdo,$idMandate,$n,$easyload);
	}

	/**
	 * Supprimer le/la mandate
	 * @return bool op�ration r�ussie ?
	 */
	public function delete()
	{
		// Supprimer les Rapprochements associ�(e)s
		$select = $this->selectRapprochements();
		while ($rapprochement = Rapprochement::fetch($this->pdo,$select)) {
			if (!$rapprochement->delete()) { return false; }
		}

		// Supprimer le/la mandate
		$pdoStatement = $this->pdo->prepare('DELETE FROM Mandate WHERE idMandate = ?');
		if (!$pdoStatement->execute(array($this->getIdMandate()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) mandate dans la base de donn�es');
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
		$pdoStatement = $this->pdo->prepare('UPDATE Mandate SET '.implode(', ', $updates).' WHERE idMandate = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdMandate())))) {
			throw new Exception('Erreur lors de la mise � jour d\'un champ d\'un(e) mandate dans la base de donn�es');
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
	 * R�cup�rer le/la idMandate
	 * @return int
	 */
	public function getIdMandate()
	{
		return $this->idMandate;
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
	 * S�lectionner les rapprochements
	 * @return PDOStatement
	 */
	public function selectRapprochements()
	{
		return Rapprochement::selectByMandate($this->pdo,$this);
	}
}

?>
