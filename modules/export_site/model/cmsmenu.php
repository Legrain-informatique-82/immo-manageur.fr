<?php

/**
 * @class CmsMenu
 * @date 30/01/2012 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class CmsMenu
{
	/// @var PDO 
	private $pdo;
	
	/// @var array tableau pour le chargement rapide
	private static $easyload;
	
	/// @var int 
	private $idCmsMenu;
	
	/// @var int 
	private $name;
	
	/// @var int id de cmsmenu
	private $cmsMenu;
	
	/**
	 * Construire un(e) cmsMenu
	 * @param $pdo PDO 
	 * @param $idCmsMenu int 
	 * @param $name int 
	 * @param $cmsMenu int id de cmsmenu
	 * @param $easyload bool activer le chargement rapide ?
	 * @return CmsMenu 
	 */
	protected function __construct(PDO $pdo,$idCmsMenu,$name,$cmsMenu=null,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;
		
		// Sauvegarder les attributs
		$this->idCmsMenu = $idCmsMenu;
		$this->name = $name;
		$this->cmsMenu = $cmsMenu;
		
		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			CmsMenu::$easyload[$idCmsMenu] = $this;
		}
	}
	
	/**
	 * Créer un(e) cmsMenu
	 * @param $pdo PDO 
	 * @param $name int 
	 * @param $cmsMenu CmsMenu 
	 * @param $easyload bool activer le chargement rapide ?
	 * @return CmsMenu 
	 */
	public static function create(PDO $pdo,$name,$cmsMenu=null,$easyload=true)
	{
		// Ajouter le/la cmsMenu dans la base de données
		$pdoStatement = $pdo->prepare('INSERT INTO CmsMenu (name,cmsMenu_idCmsMenu) VALUES (?,?)');
		if (!$pdoStatement->execute(array($name,$cmsMenu == null ? null : $cmsMenu->getIdCmsMenu()))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) cmsMenu dans la base de données');
		}
		
		// Construire le/la cmsMenu
		return new CmsMenu($pdo,$pdo->lastInsertId(),$name,$cmsMenu->getIdCmsMenu(),$easyload);
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
		return $pdo->prepare('SELECT c.idCmsMenu, c.name, c.cmsMenu_idCmsMenu FROM CmsMenu c '.
		                     ($where != null ? ' WHERE '.$where : '').
		                     ($orderby != null ? ' ORDERBY '.$orderby : '').
		                     ($limit != null ? ' LIMIT '.$limit : ''));
	}
	
	/**
	 * Charger un(e) cmsMenu
	 * @param $pdo PDO 
	 * @param $idCmsMenu int 
	 * @param $easyload bool activer le chargement rapide ?
	 * @return CmsMenu 
	 */
	public static function load(PDO $pdo,$idCmsMenu,$easyload=true)
	{
		// Déjà chargé(e) ?
		if (isset(CmsMenu::$easyload[$idCmsMenu])) {
			return CmsMenu::$easyload[$idCmsMenu];
		}
		
		// Charger le/la cmsMenu
		$pdoStatement = CmsMenu::_select($pdo,'c.idCmsMenu = ?');
		if (!$pdoStatement->execute(array($idCmsMenu))) {
			throw new Exception('Erreur lors du chargement d\'un(e) cmsMenu depuis la base de données');
		}
		
		// Récupérer le/la cmsMenu depuis le jeu de résultats
		return CmsMenu::fetch($pdo,$pdoStatement,$easyload);
	}
	
	/**
	 * Charger tous/toutes les cmsMenus
	 * @param $pdo PDO 
	 * @param $easyload bool activer le chargement rapide ?
	 * @return CmsMenu[] tableau de cmsmenus
	 */
	public static function loadAll(PDO $pdo,$easyload=false)
	{
		// Sélectionner tous/toutes les cmsMenus
		$pdoStatement = CmsMenu::selectAll($pdo);
		
		// Mettre chaque cmsMenu dans un tableau
		$cmsMenus = array();
		while ($cmsMenu = CmsMenu::fetch($pdo,$pdoStatement,$easyload)) {
			$cmsMenus[] = $cmsMenu;
		}
		
		// Retourner le tableau
		return $cmsMenus;
	}
	
	/**
	 * Sélectionner tous/toutes les cmsMenus
	 * @param $pdo PDO 
	 * @return PDOStatement 
	 */
	public static function selectAll(PDO $pdo)
	{
		$pdoStatement = CmsMenu::_select($pdo);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les cmsMenus depuis la base de données');
		}
		return $pdoStatement;
	}
	
	/**
	 * Récupère le/la cmsMenu suivant(e) d'un jeu de résultats
	 * @param $pdo PDO 
	 * @param $pdoStatement PDOStatement 
	 * @param $easyload bool activer le chargement rapide ?
	 * @return CmsMenu 
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idCmsMenu,$name,$cmsMenu) = $values;
		
		// Construire le/la cmsMenu
		return isset(CmsMenu::$easyload[$idCmsMenu.'-'.$name.'-'.$cmsMenu]) ? CmsMenu::$easyload[$idCmsMenu.'-'.$name.'-'.$cmsMenu] :
		                                                                      new CmsMenu($pdo,$idCmsMenu,$name,$cmsMenu,$easyload);
	}
	
	/**
	 * Serialiser
	 * @param $serialize bool activer la sérialisation ?
	 * @return string serialisation du/de la cmsmenu
	 */
	public function serialize($serialize=true)
	{
		// Sérialiser le/la cmsMenu
		$array = array('idCmsMenu' => $this->idCmsMenu,'name' => $this->name,'cmsMenu' => $this->cmsMenu);
		
		// Retourner la serialisation (ou pas) du/de la cmsMenu
		return $serialize ? serialize($array) : $array;
	}
	
	/**
	 * Désérialiser
	 * @param $pdo PDO 
	 * @param $string string serialisation du/de la cmsmenu
	 * @param $easyload bool activer le chargement rapide ?
	 * @return CmsMenu 
	 */
	public static function unserialize(PDO $pdo,$string,$easyload=true)
	{
		// Désérialiser la chaine de caractères
		$array = unserialize($string);
		
		// Construire le/la cmsMenu
		return isset(CmsMenu::$easyload[$array['idCmsMenu']]) ? CmsMenu::$easyload[$array['idCmsMenu']] :
		                                                        new CmsMenu($pdo,$array['idCmsMenu'],$array['name'],$array['cmsMenu'],$easyload);
	}
	
	/**
	 * Test d'égalité
	 * @param $cmsMenu CmsMenu 
	 * @return bool les objets sont ils égaux ?
	 */
	public function equals($cmsMenu)
	{
		// Test si null
		if ($cmsMenu == null) { return false; }
		
		// Tester la classe
		if (!($cmsMenu instanceof CmsMenu)) { return false; }
		
		// Tester les ids
		return $this->idCmsMenu == $cmsMenu->idCmsMenu;
	}
	
	/**
	 * Compter les cmsMenus
	 * @param $pdo PDO 
	 * @return int nombre de cmsmenus
	 */
	public static function count(PDO $pdo)
	{
		if (!($pdoStatement = $pdo->query('SELECT COUNT(idCmsMenu) FROM CmsMenu'))) {
			throw new Exception('Erreur lors du comptage des cmsMenus dans la base de données');
		}
		return $pdoStatement->fetchColumn();
	}
	
	/**
	 * Supprimer le/la cmsMenu
	 * @return bool opération réussie ?
	 */
	public function delete()
	{
		// Supprimer les Cms associé(e)s
		$select = $this->selectCms();
		while ($cms = Cms::fetch($this->pdo,$select)) {
			if (!$cms->delete()) { return false; }
		}
		
		// Supprimer le/la cmsMenu
		$pdoStatement = $this->pdo->prepare('DELETE FROM CmsMenu WHERE idCmsMenu = ?');
		if (!$pdoStatement->execute(array($this->getIdCmsMenu()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) cmsMenu dans la base de données');
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
		$pdoStatement = $this->pdo->prepare('UPDATE CmsMenu SET '.implode(', ', $updates).' WHERE idCmsMenu = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdCmsMenu())))) {
			throw new Exception('Erreur lors de la mise à jour d\'un champ d\'un(e) cmsMenu dans la base de données');
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
		return $this->_set(array('name','cmsMenu_idCmsMenu'),array($this->name,$this->cmsMenu));
	}
	
	/**
	 * Récupérer le/la idCmsMenu
	 * @return int 
	 */
	public function getIdCmsMenu()
	{
		return $this->idCmsMenu;
	}
	
	/**
	 * Récupérer le/la name
	 * @return int 
	 */
	public function getName()
	{
		return $this->name;
	}
	
	/**
	 * Définir le/la name
	 * @param $name int 
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
	 * Récupérer le/la cmsMenu
	 * @return CmsMenu 
	 */
	public function getCmsMenu()
	{
		// Retourner null si nécéssaire
		if ($this->cmsMenu == null) { return null; }
		
		// Charger et retourner cmsMenu
		return CmsMenu::load($this->pdo,$this->cmsMenu);
	}
	
	/**
	 * Définir le/la cmsMenu
	 * @param $cmsMenu CmsMenu 
	 * @param $execute bool exécuter la requête update ?
	 * @return bool opération réussie ?
	 */
	public function setCmsMenu($cmsMenu=null,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->cmsMenu = $cmsMenu == null ? null : $cmsMenu->getIdCmsMenu();
		
		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array('cmsMenu_idCmsMenu'),array($cmsMenu == null ? null : $cmsMenu->getIdCmsMenu())) : true;
	}
	
	/**
	 * Sélectionner les cms
	 * @return PDOStatement 
	 */
	public function selectCms()
	{
		return Cms::selectByCmsMenu($this->pdo,$this);
	}
	/**
	 * ToString
	 * @return string représentation de cmsmenu sous la forme d'un string
	 */
	public function __toString()
	{
		return '[CmsMenu idCmsMenu="'.$this->idCmsMenu.'" name="'.$this->name.'" cmsMenu="'.$this->cmsMenu.'"]';
	}
	
}

?>
