<?php

/**
 * @class MandateAdjoining
 * @date 06/10/2011 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class MandateAdjoining
{
	/// @var PDO 
	private $pdo;
	
	/// @var array tableau pour le chargement rapide
	private static $easyload;
	
	/// @var int 
	private $idMandateAdjoining;
	
	/// @var string 
	private $name;
	
	/**
	 * Construire un(e) mandateAdjoining
	 * @param $pdo PDO 
	 * @param $idMandateAdjoining int 
	 * @param $name string 
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateAdjoining 
	 */
	protected function __construct(PDO $pdo,$idMandateAdjoining,$name,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;
		
		// Sauvegarder les attributs
		$this->idMandateAdjoining = $idMandateAdjoining;
		$this->name = $name;
		
		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			MandateAdjoining::$easyload[$idMandateAdjoining] = $this;
		}
	}
	
	/**
	 * Créer un(e) mandateAdjoining
	 * @param $pdo PDO 
	 * @param $name string 
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateAdjoining 
	 */
	public static function create(PDO $pdo,$name,$easyload=true)
	{
		// Ajouter le/la mandateAdjoining dans la base de données
		$pdoStatement = $pdo->prepare('INSERT INTO MandateAdjoining (name) VALUES (?)');
		if (!$pdoStatement->execute(array($name))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) mandateAdjoining dans la base de données');
		}
		
		// Construire le/la mandateAdjoining
		return new MandateAdjoining($pdo,$pdo->lastInsertId(),$name,$easyload);
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
		return $pdo->prepare('SELECT m.idMandateAdjoining, m.name FROM MandateAdjoining m '.
		                     ($where != null ? ' WHERE '.$where : '').
		                     ($orderby != null ? ' ORDER BY '.$orderby : '').
		                     ($limit != null ? ' LIMIT '.$limit : ''));
	}
	
	/**
	 * Charger un(e) mandateAdjoining
	 * @param $pdo PDO 
	 * @param $idMandateAdjoining int 
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateAdjoining 
	 */
	public static function load(PDO $pdo,$idMandateAdjoining,$easyload=true)
	{
		// Déjà chargé(e) ?
		if (isset(MandateAdjoining::$easyload[$idMandateAdjoining])) {
			return MandateAdjoining::$easyload[$idMandateAdjoining];
		}
		
		// Charger le/la mandateAdjoining
		$pdoStatement = MandateAdjoining::_select($pdo,'m.idMandateAdjoining = ?');
		if (!$pdoStatement->execute(array($idMandateAdjoining))) {
			throw new Exception('Erreur lors du chargement d\'un(e) mandateAdjoining depuis la base de données');
		}
		
		// Récupérer le/la mandateAdjoining depuis le jeu de résultats
		return MandateAdjoining::fetch($pdo,$pdoStatement,$easyload);
	}
	
	/**
	 * Charger tous/toutes les mandateAdjoinings
	 * @param $pdo PDO 
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateAdjoining[] tableau de mandateadjoinings
	 */
	public static function loadAll(PDO $pdo,$easyload=false)
	{
		// Sélectionner tous/toutes les mandateAdjoinings
		$pdoStatement = MandateAdjoining::selectAll($pdo,null,'m.name');
		
		// Mettre chaque mandateAdjoining dans un tableau
		$mandateAdjoinings = array();
		while ($mandateAdjoining = MandateAdjoining::fetch($pdo,$pdoStatement,$easyload)) {
			$mandateAdjoinings[] = $mandateAdjoining;
		}
		
		// Retourner le tableau
		return $mandateAdjoinings;
	}
	
	/**
	 * Sélectionner tous/toutes les mandateAdjoinings
	 * @param $pdo PDO 
	 * @return PDOStatement 
	 */
	public static function selectAll(PDO $pdo,$where=null,$orderby=null)
	{
		$pdoStatement = MandateAdjoining::_select($pdo,$where,$orderby);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les mandateAdjoinings depuis la base de données');
		}
		return $pdoStatement;
	}
	
	/**
	 * Récupère le/la mandateAdjoining suivant(e) d'un jeu de résultats
	 * @param $pdo PDO 
	 * @param $pdoStatement PDOStatement 
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateAdjoining 
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idMandateAdjoining,$name) = $values;
		
		// Construire le/la mandateAdjoining
		return isset(MandateAdjoining::$easyload[$idMandateAdjoining.'-'.$name]) ? MandateAdjoining::$easyload[$idMandateAdjoining.'-'.$name] :
		                                                                           new MandateAdjoining($pdo,$idMandateAdjoining,$name,$easyload);
	}
	
	/**
	 * Supprimer le/la mandateAdjoining
	 * @return bool opération réussie ?
	 */
	public function delete()
	{
		// Supprimer le/la mandateAdjoining
		$pdoStatement = $this->pdo->prepare('DELETE FROM MandateAdjoining WHERE idMandateAdjoining = ?');
		if (!$pdoStatement->execute(array($this->getIdMandateAdjoining()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) mandateAdjoining dans la base de données');
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
		$pdoStatement = $this->pdo->prepare('UPDATE MandateAdjoining SET '.implode(', ', $updates).' WHERE idMandateAdjoining = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdMandateAdjoining())))) {
			throw new Exception('Erreur lors de la mise à jour d\'un champ d\'un(e) mandateAdjoining dans la base de données');
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
		return $this->_set(array('name'),array($this->name));
	}
	
	/**
	 * Récupérer le/la idMandateAdjoining
	 * @return int 
	 */
	public function getIdMandateAdjoining()
	{
		return $this->idMandateAdjoining;
	}
	public function getId()
	{
		return $this->idMandateAdjoining;
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
}

?>