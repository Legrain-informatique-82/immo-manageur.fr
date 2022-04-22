<?php

/**
 * @class Acquereur
 * @date 30/03/2011 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class Acquereur
{
	/// @var PDO
	private $pdo;

	/// @var array tableau pour le chargement rapide
	private static $easyload;

	/// @var int
	private $idAcquereur;

	/// @var int
	private $n;

	/**
	 * Construire un(e) acquereur
	 * @param $pdo PDO
	 * @param $idAcquereur int
	 * @param $n int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Acquereur
	 */
	protected function __construct(PDO $pdo,$idAcquereur,$n,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;

		// Sauvegarder les attributs
		$this->idAcquereur = $idAcquereur;
		$this->n = $n;

		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			Acquereur::$easyload[$idAcquereur] = $this;
		}
	}

	/**
	 * Cr�er un(e) acquereur
	 * @param $pdo PDO
	 * @param $n int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Acquereur
	 */
	public static function create(PDO $pdo,$n,$easyload=true)
	{
		// Ajouter le/la acquereur dans la base de donn�es
		$pdoStatement = $pdo->prepare('INSERT INTO Acquereur (n) VALUES (?)');
		if (!$pdoStatement->execute(array($n))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) acquereur dans la base de donn�es');
		}

		// Construire le/la acquereur
		return new Acquereur($pdo,$pdo->lastInsertId(),$n,$easyload);
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
		return $pdo->prepare('SELECT a.idAcquereur, a.n FROM Acquereur a '.
		($where != null ? ' WHERE '.$where : '').
		($orderby != null ? ' ORDERBY '.$orderby : '').
		($limit != null ? ' LIMIT '.$limit : ''));
	}

	/**
	 * Charger un(e) acquereur
	 * @param $pdo PDO
	 * @param $idAcquereur int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Acquereur
	 */
	public static function load(PDO $pdo,$idAcquereur,$easyload=true)
	{
		// D�j� charg�(e) ?
		if (isset(Acquereur::$easyload[$idAcquereur])) {
			return Acquereur::$easyload[$idAcquereur];
		}

		// Charger le/la acquereur
		$pdoStatement = Acquereur::_select($pdo,'a.idAcquereur = ?');
		if (!$pdoStatement->execute(array($idAcquereur))) {
			throw new Exception('Erreur lors du chargement d\'un(e) acquereur depuis la base de donn�es');
		}

		// R�cup�rer le/la acquereur depuis le jeu de r�sultats
		return Acquereur::fetch($pdo,$pdoStatement,$easyload);
	}

	/**
	 * Charger tous/toutes les acquereurs
	 * @param $pdo PDO
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Acquereur[] tableau de acquereurs
	 */
	public static function loadAll(PDO $pdo,$easyload=false)
	{
		// S�lectionner tous/toutes les acquereurs
		$pdoStatement = Acquereur::selectAll($pdo);

		// Mettre chaque acquereur dans un tableau
		$acquereurs = array();
		while ($acquereur = Acquereur::fetch($pdo,$pdoStatement,$easyload)) {
			$acquereurs[] = $acquereur;
		}

		// Retourner le tableau
		return $acquereurs;
	}

	/**
	 * S�lectionner tous/toutes les acquereurs
	 * @param $pdo PDO
	 * @return PDOStatement
	 */
	public static function selectAll(PDO $pdo)
	{
		$pdoStatement = Acquereur::_select($pdo);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les acquereurs depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�re le/la acquereur suivant(e) d'un jeu de r�sultats
	 * @param $pdo PDO
	 * @param $pdoStatement PDOStatement
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Acquereur
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idAcquereur,$n) = $values;

		// Construire le/la acquereur
		return isset(Acquereur::$easyload[$idAcquereur.'-'.$n]) ? Acquereur::$easyload[$idAcquereur.'-'.$n] :
		new Acquereur($pdo,$idAcquereur,$n,$easyload);
	}

	/**
	 * Supprimer le/la acquereur
	 * @return bool op�ration r�ussie ?
	 */
	public function delete()
	{
		// Supprimer les Rapprochements associ�(e)s
		$select = $this->selectRapprochements();
		while ($rapprochement = Rapprochement::fetch($this->pdo,$select)) {
			if (!$rapprochement->delete()) { return false; }
		}

		// Supprimer le/la acquereur
		$pdoStatement = $this->pdo->prepare('DELETE FROM Acquereur WHERE idAcquereur = ?');
		if (!$pdoStatement->execute(array($this->getIdAcquereur()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) acquereur dans la base de donn�es');
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
		$pdoStatement = $this->pdo->prepare('UPDATE Acquereur SET '.implode(', ', $updates).' WHERE idAcquereur = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdAcquereur())))) {
			throw new Exception('Erreur lors de la mise � jour d\'un champ d\'un(e) acquereur dans la base de donn�es');
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
	 * R�cup�rer le/la idAcquereur
	 * @return int
	 */
	public function getIdAcquereur()
	{
		return $this->idAcquereur;
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
		return Rapprochement::selectByAcquereur($this->pdo,$this);
	}
}

?>
