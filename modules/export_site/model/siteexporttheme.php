<?php

/**
 * @class SiteExportTheme
 * @date 13/12/2011 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class SiteExportTheme
{
	/// @var PDO 
	private $pdo;
	
	/// @var array tableau pour le chargement rapide
	private static $easyload;
	
	/// @var int 
	private $idSiteExportTheme;
	
	/// @var string 
	private $name;
	
	/**
	 * Construire un(e) siteExportTheme
	 * @param $pdo PDO 
	 * @param $idSiteExportTheme int 
	 * @param $name string 
	 * @param $easyload bool activer le chargement rapide ?
	 * @return SiteExportTheme 
	 */
	protected function __construct(PDO $pdo,$idSiteExportTheme,$name,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;
		
		// Sauvegarder les attributs
		$this->idSiteExportTheme = $idSiteExportTheme;
		$this->name = $name;
		
		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			SiteExportTheme::$easyload[$idSiteExportTheme] = $this;
		}
	}
	
	/**
	 * Cr�er un(e) siteExportTheme
	 * @param $pdo PDO 
	 * @param $name string 
	 * @param $easyload bool activer le chargement rapide ?
	 * @return SiteExportTheme 
	 */
	public static function create(PDO $pdo,$name,$easyload=true)
	{
		// Ajouter le/la siteExportTheme dans la base de donn�es
		$pdoStatement = $pdo->prepare('INSERT INTO SiteExportTheme (name) VALUES (?)');
		if (!$pdoStatement->execute(array($name))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) siteExportTheme dans la base de donn�es');
		}
		
		// Construire le/la siteExportTheme
		return new SiteExportTheme($pdo,$pdo->lastInsertId(),$name,$easyload);
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
		return $pdo->prepare('SELECT s.idSiteExportTheme, s.name FROM SiteExportTheme s '.
		                     ($where != null ? ' WHERE '.$where : '').
		                     ($orderby != null ? ' ORDERBY '.$orderby : '').
		                     ($limit != null ? ' LIMIT '.$limit : ''));
	}
	
	/**
	 * Charger un(e) siteExportTheme
	 * @param $pdo PDO 
	 * @param $idSiteExportTheme int 
	 * @param $easyload bool activer le chargement rapide ?
	 * @return SiteExportTheme 
	 */
	public static function load(PDO $pdo,$idSiteExportTheme,$easyload=true)
	{
		// D�j� charg�(e) ?
		if (isset(SiteExportTheme::$easyload[$idSiteExportTheme])) {
			return SiteExportTheme::$easyload[$idSiteExportTheme];
		}
		
		// Charger le/la siteExportTheme
		$pdoStatement = SiteExportTheme::_select($pdo,'s.idSiteExportTheme = ?');
		if (!$pdoStatement->execute(array($idSiteExportTheme))) {
			throw new Exception('Erreur lors du chargement d\'un(e) siteExportTheme depuis la base de donn�es');
		}
		
		// R�cup�rer le/la siteExportTheme depuis le jeu de r�sultats
		return SiteExportTheme::fetch($pdo,$pdoStatement,$easyload);
	}
	
	/**
	 * Charger tous/toutes les siteExportThemes
	 * @param $pdo PDO 
	 * @param $easyload bool activer le chargement rapide ?
	 * @return SiteExportTheme[] tableau de siteexportthemes
	 */
	public static function loadAll(PDO $pdo,$easyload=false)
	{
		// S�lectionner tous/toutes les siteExportThemes
		$pdoStatement = SiteExportTheme::selectAll($pdo);
		
		// Mettre chaque siteExportTheme dans un tableau
		$siteExportThemes = array();
		while ($siteExportTheme = SiteExportTheme::fetch($pdo,$pdoStatement,$easyload)) {
			$siteExportThemes[] = $siteExportTheme;
		}
		
		// Retourner le tableau
		return $siteExportThemes;
	}
	
	/**
	 * S�lectionner tous/toutes les siteExportThemes
	 * @param $pdo PDO 
	 * @return PDOStatement 
	 */
	public static function selectAll(PDO $pdo)
	{
		$pdoStatement = SiteExportTheme::_select($pdo);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les siteExportThemes depuis la base de donn�es');
		}
		return $pdoStatement;
	}
	
	/**
	 * R�cup�re le/la siteExportTheme suivant(e) d'un jeu de r�sultats
	 * @param $pdo PDO 
	 * @param $pdoStatement PDOStatement 
	 * @param $easyload bool activer le chargement rapide ?
	 * @return SiteExportTheme 
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idSiteExportTheme,$name) = $values;
		
		// Construire le/la siteExportTheme
		return isset(SiteExportTheme::$easyload[$idSiteExportTheme.'-'.$name]) ? SiteExportTheme::$easyload[$idSiteExportTheme.'-'.$name] :
		                                                                         new SiteExportTheme($pdo,$idSiteExportTheme,$name,$easyload);
	}
	
	/**
	 * Supprimer le/la siteExportTheme
	 * @return bool op�ration r�ussie ?
	 */
	public function delete()
	{
		// Supprimer les SiteExports associ�(e)s
		$select = $this->selectSiteExports();
		while ($siteExport = SiteExport::fetch($this->pdo,$select)) {
			if (!$siteExport->delete()) { return false; }
		}
		
		// Supprimer le/la siteExportTheme
		$pdoStatement = $this->pdo->prepare('DELETE FROM SiteExportTheme WHERE idSiteExportTheme = ?');
		if (!$pdoStatement->execute(array($this->getIdSiteExportTheme()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) siteExportTheme dans la base de donn�es');
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
		$pdoStatement = $this->pdo->prepare('UPDATE SiteExportTheme SET '.implode(', ', $updates).' WHERE idSiteExportTheme = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdSiteExportTheme())))) {
			throw new Exception('Erreur lors de la mise � jour d\'un champ d\'un(e) siteExportTheme dans la base de donn�es');
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
		return $this->_set(array('name'),array($this->name));
	}
	
	/**
	 * R�cup�rer le/la idSiteExportTheme
	 * @return int 
	 */
	public function getIdSiteExportTheme()
	{
		return $this->idSiteExportTheme;
	}
	public function getId()
	{
		return $this->idSiteExportTheme;
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
	 * S�lectionner les siteExports
	 * @return PDOStatement 
	 */
	public function selectSiteExports()
	{
		return SiteExport::selectByTheme($this->pdo,$this);
	}
}

?>
