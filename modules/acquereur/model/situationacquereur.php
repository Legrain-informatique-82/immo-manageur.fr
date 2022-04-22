<?php

/**
 * @class SituationAcquereur
 * @date 02/01/2012 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class SituationAcquereur
{
	/// @var PDO 
	private $pdo;
	
	/// @var array tableau pour le chargement rapide
	private static $easyload;
	
	/// @var int 
	private $idSituationAcquereur;
	
	/// @var string 
	private $name;
	
	/// @var bool 
	private $ifEventDate;
	
	/// @var bool 
	private $ifEventLocation;
	
	/**
	 * Construire un(e) situationAcquereur
	 * @param $pdo PDO 
	 * @param $idSituationAcquereur int 
	 * @param $name string 
	 * @param $ifEventDate bool 
	 * @param $ifEventLocation bool 
	 * @param $easyload bool activer le chargement rapide ?
	 * @return SituationAcquereur 
	 */
	protected function __construct(PDO $pdo,$idSituationAcquereur,$name,$ifEventDate=false,$ifEventLocation=false,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;
		
		// Sauvegarder les attributs
		$this->idSituationAcquereur = $idSituationAcquereur;
		$this->name = $name;
		$this->ifEventDate = $ifEventDate;
		$this->ifEventLocation = $ifEventLocation;
		
		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			SituationAcquereur::$easyload[$idSituationAcquereur] = $this;
		}
	}
	
	/**
	 * Cr�er un(e) situationAcquereur
	 * @param $pdo PDO 
	 * @param $name string 
	 * @param $ifEventDate bool 
	 * @param $ifEventLocation bool 
	 * @param $easyload bool activer le chargement rapide ?
	 * @return SituationAcquereur 
	 */
	public static function create(PDO $pdo,$name,$ifEventDate=false,$ifEventLocation=false,$easyload=true)
	{
		// Ajouter le/la situationAcquereur dans la base de donn�es
		$pdoStatement = $pdo->prepare('INSERT INTO SituationAcquereur (name,ifEventDate,ifEventLocation) VALUES (?,?,?)');
		if (!$pdoStatement->execute(array($name,$ifEventDate,$ifEventLocation))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) situationAcquereur dans la base de donn�es');
		}
		
		// Construire le/la situationAcquereur
		return new SituationAcquereur($pdo,$pdo->lastInsertId(),$name,$ifEventDate,$ifEventLocation,$easyload);
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
		return $pdo->prepare('SELECT s.idSituationAcquereur, s.name, s.ifEventDate, s.ifEventLocation FROM SituationAcquereur s '.
		                     ($where != null ? ' WHERE '.$where : '').
		                     ($orderby != null ? ' ORDER BY '.$orderby : '').
		                     ($limit != null ? ' LIMIT '.$limit : ''));
	}
	
	/**
	 * Charger un(e) situationAcquereur
	 * @param $pdo PDO 
	 * @param $idSituationAcquereur int 
	 * @param $easyload bool activer le chargement rapide ?
	 * @return SituationAcquereur 
	 */
	public static function load(PDO $pdo,$idSituationAcquereur,$easyload=true)
	{
		// D�j� charg�(e) ?
		if (isset(SituationAcquereur::$easyload[$idSituationAcquereur])) {
			return SituationAcquereur::$easyload[$idSituationAcquereur];
		}
		
		// Charger le/la situationAcquereur
		$pdoStatement = SituationAcquereur::_select($pdo,'s.idSituationAcquereur = ?');
		if (!$pdoStatement->execute(array($idSituationAcquereur))) {
			throw new Exception('Erreur lors du chargement d\'un(e) situationAcquereur depuis la base de donn�es');
		}
		
		// R�cup�rer le/la situationAcquereur depuis le jeu de r�sultats
		return SituationAcquereur::fetch($pdo,$pdoStatement,$easyload);
	}
	
	/**
	 * Charger tous/toutes les situationAcquereurs
	 * @param $pdo PDO 
	 * @param $easyload bool activer le chargement rapide ?
	 * @return SituationAcquereur[] tableau de situationacquereurs
	 */
	public static function loadAll(PDO $pdo,$easyload=false)
	{
		// S�lectionner tous/toutes les situationAcquereurs
		$pdoStatement = SituationAcquereur::selectAll($pdo,null,' s.name');
		
		// Mettre chaque situationAcquereur dans un tableau
		$situationAcquereurs = array();
		while ($situationAcquereur = SituationAcquereur::fetch($pdo,$pdoStatement,$easyload)) {
			$situationAcquereurs[] = $situationAcquereur;
		}
		
		// Retourner le tableau
		return $situationAcquereurs;
	}
	
	/**
	 * S�lectionner tous/toutes les situationAcquereurs
	 * @param $pdo PDO 
	 * @return PDOStatement 
	 */
	public static function selectAll(PDO $pdo,$where=null,$orderby=null)
	{
		$pdoStatement = SituationAcquereur::_select($pdo,$where,$orderby);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les situationAcquereurs depuis la base de donn�es');
		}
		return $pdoStatement;
	}
	
	/**
	 * R�cup�re le/la situationAcquereur suivant(e) d'un jeu de r�sultats
	 * @param $pdo PDO 
	 * @param $pdoStatement PDOStatement 
	 * @param $easyload bool activer le chargement rapide ?
	 * @return SituationAcquereur 
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idSituationAcquereur,$name,$ifEventDate,$ifEventLocation) = $values;
		
		// Construire le/la situationAcquereur
		return isset(SituationAcquereur::$easyload[$idSituationAcquereur.'-'.$name.'-'.$ifEventDate.'-'.$ifEventLocation]) ? SituationAcquereur::$easyload[$idSituationAcquereur.'-'.$name.'-'.$ifEventDate.'-'.$ifEventLocation] :
		                                                                                                                     new SituationAcquereur($pdo,$idSituationAcquereur,$name,$ifEventDate,$ifEventLocation,$easyload);
	}
	
	/**
	 * Supprimer le/la situationAcquereur
	 * @return bool op�ration r�ussie ?
	 */
	public function delete()
	{
		// Supprimer les RelSituaTionAcqs associ�(e)s
		$select = $this->selectRelSituaTionAcqs();
		while ($relSituaTionAcq = RelSituaTionAcq::fetch($this->pdo,$select)) {
			if (!$relSituaTionAcq->delete()) { return false; }
		}
		
		// Supprimer le/la situationAcquereur
		$pdoStatement = $this->pdo->prepare('DELETE FROM SituationAcquereur WHERE idSituationAcquereur = ?');
		if (!$pdoStatement->execute(array($this->getIdSituationAcquereur()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) situationAcquereur dans la base de donn�es');
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
		$pdoStatement = $this->pdo->prepare('UPDATE SituationAcquereur SET '.implode(', ', $updates).' WHERE idSituationAcquereur = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdSituationAcquereur())))) {
			throw new Exception('Erreur lors de la mise � jour d\'un champ d\'un(e) situationAcquereur dans la base de donn�es');
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
		return $this->_set(array('name','ifEventDate','ifEventLocation'),array($this->name,$this->ifEventDate,$this->ifEventLocation));
	}
	
	/**
	 * R�cup�rer le/la idSituationAcquereur
	 * @return int 
	 */
	public function getIdSituationAcquereur()
	{
		return $this->idSituationAcquereur;
	}
	public function getId()
	{
		return $this->idSituationAcquereur;
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
	 * R�cup�rer le/la ifEventDate
	 * @return bool 
	 */
	public function getIfEventDate()
	{
		return $this->ifEventDate;
	}
	
	/**
	 * D�finir le/la ifEventDate
	 * @param $ifEventDate bool 
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setIfEventDate($ifEventDate,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->ifEventDate = $ifEventDate;
		
		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('ifEventDate'),array($ifEventDate)) : true;
	}
	
	/**
	 * R�cup�rer le/la ifEventLocation
	 * @return bool 
	 */
	public function getIfEventLocation()
	{
		return $this->ifEventLocation;
	}
	
	/**
	 * D�finir le/la ifEventLocation
	 * @param $ifEventLocation bool 
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setIfEventLocation($ifEventLocation,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->ifEventLocation = $ifEventLocation;
		
		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('ifEventLocation'),array($ifEventLocation)) : true;
	}
	
	/**
	 * S�lectionner les relSituaTionAcqs
	 * @return PDOStatement 
	 */
	public function selectRelSituaTionAcqs()
	{
		return RelSituaTionAcq::selectBySituationAcquereur($this->pdo,$this);
	}
}

?>
