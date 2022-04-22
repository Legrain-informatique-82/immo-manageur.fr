<?php

/**
 * @class MandateStyle
 * @date 21/03/2011 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class MandateStyle
{
	/// @var PDO
	private $pdo;

	/// @var array tableau pour le chargement rapide
	private static $easyload;

	/// @var int
	private $idMandateStyle;

	/// @var int
	private $n;

	/**
	 * Construire un(e) mandateStyle
	 * @param $pdo PDO
	 * @param $idMandateStyle int
	 * @param $n int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateStyle
	 */
	protected function __construct(PDO $pdo,$idMandateStyle,$n,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;

		// Sauvegarder les attributs
		$this->idMandateStyle = $idMandateStyle;
		$this->n = $n;

		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			MandateStyle::$easyload[$idMandateStyle] = $this;
		}
	}

	/**
	 * Cr�er un(e) mandateStyle
	 * @param $pdo PDO
	 * @param $n int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateStyle
	 */
	public static function create(PDO $pdo,$n,$easyload=true)
	{
		// Ajouter le/la mandateStyle dans la base de donn�es
		$pdoStatement = $pdo->prepare('INSERT INTO MandateStyle (n) VALUES (?)');
		if (!$pdoStatement->execute(array($n))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) mandateStyle dans la base de donn�es');
		}

		// Construire le/la mandateStyle
		return new MandateStyle($pdo,$pdo->lastInsertId(),$n,$easyload);
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
		return $pdo->prepare('SELECT m.idMandateStyle, m.n FROM MandateStyle m '.
		($where != null ? ' WHERE '.$where : '').
		($orderby != null ? ' ORDERBY '.$orderby : '').
		($limit != null ? ' LIMIT '.$limit : ''));
	}

	/**
	 * Charger un(e) mandateStyle
	 * @param $pdo PDO
	 * @param $idMandateStyle int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateStyle
	 */
	public static function load(PDO $pdo,$idMandateStyle,$easyload=true)
	{
		// D�j� charg�(e) ?
		if (isset(MandateStyle::$easyload[$idMandateStyle])) {
			return MandateStyle::$easyload[$idMandateStyle];
		}

		// Charger le/la mandateStyle
		$pdoStatement = MandateStyle::_select($pdo,'m.idMandateStyle = ?');
		if (!$pdoStatement->execute(array($idMandateStyle))) {
			throw new Exception('Erreur lors du chargement d\'un(e) mandateStyle depuis la base de donn�es');
		}

		// R�cup�rer le/la mandateStyle depuis le jeu de r�sultats
		return MandateStyle::fetch($pdo,$pdoStatement,$easyload);
	}

	/**
	 * Charger tous/toutes les mandateStyles
	 * @param $pdo PDO
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateStyle[] tableau de mandatestyles
	 */
	public static function loadAll(PDO $pdo,$easyload=false)
	{
		// S�lectionner tous/toutes les mandateStyles
		$pdoStatement = MandateStyle::selectAll($pdo);

		// Mettre chaque mandateStyle dans un tableau
		$mandateStyles = array();
		while ($mandateStyle = MandateStyle::fetch($pdo,$pdoStatement,$easyload)) {
			$mandateStyles[] = $mandateStyle;
		}

		// Retourner le tableau
		return $mandateStyles;
	}

	/**
	 * S�lectionner tous/toutes les mandateStyles
	 * @param $pdo PDO
	 * @return PDOStatement
	 */
	public static function selectAll(PDO $pdo)
	{
		$pdoStatement = MandateStyle::_select($pdo);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les mandateStyles depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�re le/la mandateStyle suivant(e) d'un jeu de r�sultats
	 * @param $pdo PDO
	 * @param $pdoStatement PDOStatement
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateStyle
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idMandateStyle,$n) = $values;

		// Construire le/la mandateStyle
		return isset(MandateStyle::$easyload[$idMandateStyle.'-'.$n]) ? MandateStyle::$easyload[$idMandateStyle.'-'.$n] :
		new MandateStyle($pdo,$idMandateStyle,$n,$easyload);
	}

	/**
	 * Supprimer le/la mandateStyle
	 * @return bool op�ration r�ussie ?
	 */
	public function delete()
	{
		// Supprimer les Acquereurs associ�(e)s
		$select = $this->selectAcquereurs();
		while ($acquereur = Acquereur::fetch($this->pdo,$select)) {
			if (!$acquereur->delete()) { return false; }
		}

		// Supprimer le/la mandateStyle
		$pdoStatement = $this->pdo->prepare('DELETE FROM MandateStyle WHERE idMandateStyle = ?');
		if (!$pdoStatement->execute(array($this->getIdMandateStyle()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) mandateStyle dans la base de donn�es');
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
		$pdoStatement = $this->pdo->prepare('UPDATE MandateStyle SET '.implode(', ', $updates).' WHERE idMandateStyle = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdMandateStyle())))) {
			throw new Exception('Erreur lors de la mise � jour d\'un champ d\'un(e) mandateStyle dans la base de donn�es');
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
	 * R�cup�rer le/la idMandateStyle
	 * @return int
	 */
	public function getIdMandateStyle()
	{
		return $this->idMandateStyle;
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
		return Acquereur::selectByMandateStyle($this->pdo,$this);
	}
}

?>
