<?php

/**
 * @class Cms
 * @date 30/01/2012 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class Cms
{
	/// @var PDO 
	private $pdo;
	
	/// @var array tableau pour le chargement rapide
	private static $easyload;
	
	/// @var int 
	private $idCms;
	
	/// @var string 
	private $publicName;
	
	/// @var string 
	private $privateName;
	
	/// @var string 
	private $title;
	
	/// @var string 
	private $url;
	
	/// @var string 
	private $description;
	
	/// @var string 
	private $content;
	
	/// @var int 
	private $position;
	
	/// @var int id de cmsmenu
	private $cmsMenu;
	
	/**
	 * Construire un(e) cms
	 * @param $pdo PDO 
	 * @param $idCms int 
	 * @param $publicName string 
	 * @param $privateName string 
	 * @param $title string 
	 * @param $url string 
	 * @param $description string 
	 * @param $content string 
	 * @param $position int 
	 * @param $cmsMenu int id de cmsmenu
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Cms 
	 */
	protected function __construct(PDO $pdo,$idCms,$publicName,$privateName,$title,$url,$description,$content,$position,$cmsMenu,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;
		
		// Sauvegarder les attributs
		$this->idCms = $idCms;
		$this->publicName = $publicName;
		$this->privateName = $privateName;
		$this->title = $title;
		$this->url = $url;
		$this->description = $description;
		$this->content = $content;
		$this->position = $position;
		$this->cmsMenu = $cmsMenu;
		
		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			Cms::$easyload[$idCms] = $this;
		}
	}
	
	/**
	 * Créer un(e) cms
	 * @param $pdo PDO 
	 * @param $publicName string 
	 * @param $privateName string 
	 * @param $title string 
	 * @param $url string 
	 * @param $description string 
	 * @param $content string 
	 * @param $position int 
	 * @param $cmsMenu CmsMenu 
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Cms 
	 */
	public static function create(PDO $pdo,$publicName,$privateName,$title,$url,$description,$content,$position,CmsMenu $cmsMenu,$easyload=true)
	{
		// Ajouter le/la cms dans la base de données
		$pdoStatement = $pdo->prepare('INSERT INTO Cms (publicName,privateName,title,url,description,content,position,cmsMenu_idCmsMenu) VALUES (?,?,?,?,?,?,?,?)');
		if (!$pdoStatement->execute(array($publicName,$privateName,$title,$url,$description,$content,$position,$cmsMenu->getIdCmsMenu()))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) cms dans la base de données');
		}
		
		// Construire le/la cms
		return new Cms($pdo,$pdo->lastInsertId(),$publicName,$privateName,$title,$url,$description,$content,$position,$cmsMenu->getIdCmsMenu(),$easyload);
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
		return $pdo->prepare('SELECT c.idCms, c.publicName, c.privateName, c.title, c.url, c.description, c.content, c.position, c.cmsMenu_idCmsMenu FROM Cms c '.
		                     ($where != null ? ' WHERE '.$where : '').
		                     ($orderby != null ? ' ORDERBY '.$orderby : '').
		                     ($limit != null ? ' LIMIT '.$limit : ''));
	}
	
	/**
	 * Charger un(e) cms
	 * @param $pdo PDO 
	 * @param $idCms int 
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Cms 
	 */
	public static function load(PDO $pdo,$idCms,$easyload=true)
	{
		// Déjà chargé(e) ?
		if (isset(Cms::$easyload[$idCms])) {
			return Cms::$easyload[$idCms];
		}
		
		// Charger le/la cms
		$pdoStatement = Cms::_select($pdo,'c.idCms = ?');
		if (!$pdoStatement->execute(array($idCms))) {
			throw new Exception('Erreur lors du chargement d\'un(e) cms depuis la base de données');
		}
		
		// Récupérer le/la cms depuis le jeu de résultats
		return Cms::fetch($pdo,$pdoStatement,$easyload);
	}
	
	/**
	 * Charger tous/toutes les cms
	 * @param $pdo PDO 
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Cms[] tableau de cms
	 */
	public static function loadAll(PDO $pdo,$easyload=false)
	{
		// Sélectionner tous/toutes les cms
		$pdoStatement = Cms::selectAll($pdo);
		
		// Mettre chaque cms dans un tableau
		$array = array();
		while ($cms = Cms::fetch($pdo,$pdoStatement,$easyload)) {
			$array[] = $cms;
		}
		
		// Retourner le tableau
		return $array;
	}
	
	/**
	 * Sélectionner tous/toutes les cms
	 * @param $pdo PDO 
	 * @return PDOStatement 
	 */
	public static function selectAll(PDO $pdo)
	{
		$pdoStatement = Cms::_select($pdo);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les cms depuis la base de données');
		}
		return $pdoStatement;
	}
	
	/**
	 * Récupère le/la cms suivant(e) d'un jeu de résultats
	 * @param $pdo PDO 
	 * @param $pdoStatement PDOStatement 
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Cms 
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idCms,$publicName,$privateName,$title,$url,$description,$content,$position,$cmsMenu) = $values;
		
		// Construire le/la cms
		return isset(Cms::$easyload[$idCms.'-'.$publicName.'-'.$privateName.'-'.$title.'-'.$url.'-'.$description.'-'.$content.'-'.$position.'-'.$cmsMenu]) ? Cms::$easyload[$idCms.'-'.$publicName.'-'.$privateName.'-'.$title.'-'.$url.'-'.$description.'-'.$content.'-'.$position.'-'.$cmsMenu] :
		                                                                                                                                                     new Cms($pdo,$idCms,$publicName,$privateName,$title,$url,$description,$content,$position,$cmsMenu,$easyload);
	}
	
	/**
	 * Serialiser
	 * @param $serialize bool activer la sérialisation ?
	 * @return string serialisation du/de la cms
	 */
	public function serialize($serialize=true)
	{
		// Sérialiser le/la cms
		$array = array('idCms' => $this->idCms,'publicName' => $this->publicName,'privateName' => $this->privateName,'title' => $this->title,'url' => $this->url,'description' => $this->description,'content' => $this->content,'position' => $this->position,'cmsMenu' => $this->cmsMenu);
		
		// Retourner la serialisation (ou pas) du/de la cms
		return $serialize ? serialize($array) : $array;
	}
	
	/**
	 * Désérialiser
	 * @param $pdo PDO 
	 * @param $string string serialisation du/de la cms
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Cms 
	 */
	public static function unserialize(PDO $pdo,$string,$easyload=true)
	{
		// Désérialiser la chaine de caractères
		$array = unserialize($string);
		
		// Construire le/la cms
		return isset(Cms::$easyload[$array['idCms']]) ? Cms::$easyload[$array['idCms']] :
		                                                new Cms($pdo,$array['idCms'],$array['publicName'],$array['privateName'],$array['title'],$array['url'],$array['description'],$array['content'],$array['position'],$array['cmsMenu'],$easyload);
	}
	
	/**
	 * Test d'égalité
	 * @param $cms Cms 
	 * @return bool les objets sont ils égaux ?
	 */
	public function equals($cms)
	{
		// Test si null
		if ($cms == null) { return false; }
		
		// Tester la classe
		if (!($cms instanceof Cms)) { return false; }
		
		// Tester les ids
		return $this->idCms == $cms->idCms;
	}
	
	/**
	 * Compter les cms
	 * @param $pdo PDO 
	 * @return int nombre de cms
	 */
	public static function count(PDO $pdo)
	{
		if (!($pdoStatement = $pdo->query('SELECT COUNT(idCms) FROM Cms'))) {
			throw new Exception('Erreur lors du comptage des cms dans la base de données');
		}
		return $pdoStatement->fetchColumn();
	}
	
	/**
	 * Supprimer le/la cms
	 * @return bool opération réussie ?
	 */
	public function delete()
	{
		// Supprimer le/la cms
		$pdoStatement = $this->pdo->prepare('DELETE FROM Cms WHERE idCms = ?');
		if (!$pdoStatement->execute(array($this->getIdCms()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) cms dans la base de données');
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
		$pdoStatement = $this->pdo->prepare('UPDATE Cms SET '.implode(', ', $updates).' WHERE idCms = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdCms())))) {
			throw new Exception('Erreur lors de la mise à jour d\'un champ d\'un(e) cms dans la base de données');
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
		return $this->_set(array('publicName','privateName','title','url','description','content','position','cmsMenu_idCmsMenu'),array($this->publicName,$this->privateName,$this->title,$this->url,$this->description,$this->content,$this->position,$this->cmsMenu));
	}
	
	/**
	 * Récupérer le/la idCms
	 * @return int 
	 */
	public function getIdCms()
	{
		return $this->idCms;
	}
	
	/**
	 * Récupérer le/la publicName
	 * @return string 
	 */
	public function getPublicName()
	{
		return $this->publicName;
	}
	
	/**
	 * Définir le/la publicName
	 * @param $publicName string 
	 * @param $execute bool exécuter la requête update ?
	 * @return bool opération réussie ?
	 */
	public function setPublicName($publicName,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->publicName = $publicName;
		
		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array('publicName'),array($publicName)) : true;
	}
	
	/**
	 * Récupérer le/la privateName
	 * @return string 
	 */
	public function getPrivateName()
	{
		return $this->privateName;
	}
	
	/**
	 * Définir le/la privateName
	 * @param $privateName string 
	 * @param $execute bool exécuter la requête update ?
	 * @return bool opération réussie ?
	 */
	public function setPrivateName($privateName,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->privateName = $privateName;
		
		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array('privateName'),array($privateName)) : true;
	}
	
	/**
	 * Récupérer le/la title
	 * @return string 
	 */
	public function getTitle()
	{
		return $this->title;
	}
	
	/**
	 * Définir le/la title
	 * @param $title string 
	 * @param $execute bool exécuter la requête update ?
	 * @return bool opération réussie ?
	 */
	public function setTitle($title,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->title = $title;
		
		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array('title'),array($title)) : true;
	}
	
	/**
	 * Récupérer le/la url
	 * @return string 
	 */
	public function getUrl()
	{
		return $this->url;
	}
	
	/**
	 * Définir le/la url
	 * @param $url string 
	 * @param $execute bool exécuter la requête update ?
	 * @return bool opération réussie ?
	 */
	public function setUrl($url,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->url = $url;
		
		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array('url'),array($url)) : true;
	}
	
	/**
	 * Récupérer le/la description
	 * @return string 
	 */
	public function getDescription()
	{
		return $this->description;
	}
	
	/**
	 * Définir le/la description
	 * @param $description string 
	 * @param $execute bool exécuter la requête update ?
	 * @return bool opération réussie ?
	 */
	public function setDescription($description,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->description = $description;
		
		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array('description'),array($description)) : true;
	}
	
	/**
	 * Récupérer le/la content
	 * @return string 
	 */
	public function getContent()
	{
		return $this->content;
	}
	
	/**
	 * Définir le/la content
	 * @param $content string 
	 * @param $execute bool exécuter la requête update ?
	 * @return bool opération réussie ?
	 */
	public function setContent($content,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->content = $content;
		
		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array('content'),array($content)) : true;
	}
	
	/**
	 * Récupérer le/la position
	 * @return int 
	 */
	public function getPosition()
	{
		return $this->position;
	}
	
	/**
	 * Définir le/la position
	 * @param $position int 
	 * @param $execute bool exécuter la requête update ?
	 * @return bool opération réussie ?
	 */
	public function setPosition($position,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->position = $position;
		
		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array('position'),array($position)) : true;
	}
	
	/**
	 * Récupérer le/la cmsMenu
	 * @return CmsMenu 
	 */
	public function getCmsMenu()
	{
		return CmsMenu::load($this->pdo,$this->cmsMenu);
	}
	
	/**
	 * Définir le/la cmsMenu
	 * @param $cmsMenu CmsMenu 
	 * @param $execute bool exécuter la requête update ?
	 * @return bool opération réussie ?
	 */
	public function setCmsMenu(CmsMenu $cmsMenu,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->cmsMenu = $cmsMenu->getIdCmsMenu();
		
		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array('cmsMenu_idCmsMenu'),array($cmsMenu->getIdCmsMenu())) : true;
	}
	
	/**
	 * Sélectionner les cms par cmsMenu
	 * @param $pdo PDO 
	 * @param $cmsMenu CmsMenu 
	 * @return PDOStatement 
	 */
	public static function selectByCmsMenu(PDO $pdo,CmsMenu $cmsMenu)
	{
		$pdoStatement = $pdo->prepare('SELECT c.idCms, c.publicName, c.privateName, c.title, c.url, c.description, c.content, c.position, c.cmsMenu_idCmsMenu FROM Cms c WHERE c.cmsMenu_idCmsMenu = ?');
		if (!$pdoStatement->execute(array($cmsMenu->getIdCmsMenu()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les cms par cmsMenu depuis la base de données');
		}
		return $pdoStatement;
	}
	/**
	 * ToString
	 * @return string représentation de cms sous la forme d'un string
	 */
	public function __toString()
	{
		return '[Cms idCms="'.$this->idCms.'" publicName="'.$this->publicName.'" privateName="'.$this->privateName.'" title="'.$this->title.'" url="'.$this->url.'" description="'.$this->description.'" content="'.$this->content.'" position="'.$this->position.'" cmsMenu="'.$this->cmsMenu.'"]';
	}
	
}

?>
