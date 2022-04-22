<?php

/**
 * @class SiteExportVariable
 * @date 26/01/2012 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class SiteExportVariable
{
	/// @var PDO 
	private $pdo;
	
	/// @var array tableau pour le chargement rapide
	private static $easyload;
	
	/// @var int 
	private $idSiteExportVariable;
	
	/// @var string 
	private $name;
	
	/// @var string 
	private $label;
	
	/// @var string 
	private $exportName;
	
	/// @var string 
	private $value;
	
	/// @var string 
	private $type;
	
	/**
	 * Construire un(e) siteExportVariable
	 * @param $pdo PDO 
	 * @param $idSiteExportVariable int 
	 * @param $name string 
	 * @param $label string 
	 * @param $exportName string 
	 * @param $value string 
	 * @param $type string 
	 * @param $easyload bool activer le chargement rapide ?
	 * @return SiteExportVariable 
	 */
	protected function __construct(PDO $pdo,$idSiteExportVariable,$name,$label,$exportName,$value,$type,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;
		
		// Sauvegarder les attributs
		$this->idSiteExportVariable = $idSiteExportVariable;
		$this->name = $name;
		$this->label = $label;
		$this->exportName = $exportName;
		$this->value = $value;
		$this->type = $type;
		
		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			SiteExportVariable::$easyload[$idSiteExportVariable] = $this;
		}
	}
	
	/**
	 * Cr�er un(e) siteExportVariable
	 * @param $pdo PDO 
	 * @param $name string 
	 * @param $label string 
	 * @param $exportName string 
	 * @param $value string 
	 * @param $type string 
	 * @param $easyload bool activer le chargement rapide ?
	 * @return SiteExportVariable 
	 */
	public static function create(PDO $pdo,$name,$label,$exportName,$value,$type,$easyload=true)
	{
		// Ajouter le/la siteExportVariable dans la base de donn�es
		$pdoStatement = $pdo->prepare('INSERT INTO SiteExportVariable (name,label,exportName,value,type) VALUES (?,?,?,?,?)');
		if (!$pdoStatement->execute(array($name,$label,$exportName,$value,$type))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) siteExportVariable dans la base de donn�es');
		}
		
		// Construire le/la siteExportVariable
		return new SiteExportVariable($pdo,$pdo->lastInsertId(),$name,$label,$exportName,$value,$type,$easyload);
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
		return $pdo->prepare('SELECT s.idSiteExportVariable, s.name, s.label, s.exportName, s.value, s.type FROM SiteExportVariable s '.
		                     ($where != null ? ' WHERE '.$where : '').
		                     ($orderby != null ? ' ORDERBY '.$orderby : '').
		                     ($limit != null ? ' LIMIT '.$limit : ''));
	}
	
	/**
	 * Charger un(e) siteExportVariable
	 * @param $pdo PDO 
	 * @param $idSiteExportVariable int 
	 * @param $easyload bool activer le chargement rapide ?
	 * @return SiteExportVariable 
	 */
	public static function load(PDO $pdo,$idSiteExportVariable,$easyload=true)
	{
		// D�j� charg�(e) ?
		if (isset(SiteExportVariable::$easyload[$idSiteExportVariable])) {
			return SiteExportVariable::$easyload[$idSiteExportVariable];
		}
		
		// Charger le/la siteExportVariable
		$pdoStatement = SiteExportVariable::_select($pdo,'s.idSiteExportVariable = ?');
		if (!$pdoStatement->execute(array($idSiteExportVariable))) {
			throw new Exception('Erreur lors du chargement d\'un(e) siteExportVariable depuis la base de donn�es');
		}
		
		// R�cup�rer le/la siteExportVariable depuis le jeu de r�sultats
		return SiteExportVariable::fetch($pdo,$pdoStatement,$easyload);
	}
	
	/**
	 * Charger tous/toutes les siteExportVariables
	 * @param $pdo PDO 
	 * @param $easyload bool activer le chargement rapide ?
	 * @return SiteExportVariable[] tableau de siteexportvariables
	 */
	public static function loadAll(PDO $pdo,$easyload=false)
	{
		// S�lectionner tous/toutes les siteExportVariables
		$pdoStatement = SiteExportVariable::selectAll($pdo);
		
		// Mettre chaque siteExportVariable dans un tableau
		$siteExportVariables = array();
		while ($siteExportVariable = SiteExportVariable::fetch($pdo,$pdoStatement,$easyload)) {
			$siteExportVariables[] = $siteExportVariable;
		}
		
		// Retourner le tableau
		return $siteExportVariables;
	}
	
	/**
	 * S�lectionner tous/toutes les siteExportVariables
	 * @param $pdo PDO 
	 * @return PDOStatement 
	 */
	public static function selectAll(PDO $pdo)
	{
		$pdoStatement = SiteExportVariable::_select($pdo);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les siteExportVariables depuis la base de donn�es');
		}
		return $pdoStatement;
	}
	
	/**
	 * R�cup�re le/la siteExportVariable suivant(e) d'un jeu de r�sultats
	 * @param $pdo PDO 
	 * @param $pdoStatement PDOStatement 
	 * @param $easyload bool activer le chargement rapide ?
	 * @return SiteExportVariable 
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idSiteExportVariable,$name,$label,$exportName,$value,$type) = $values;
		
		// Construire le/la siteExportVariable
		return isset(SiteExportVariable::$easyload[$idSiteExportVariable.'-'.$name.'-'.$label.'-'.$exportName.'-'.$value.'-'.$type]) ? SiteExportVariable::$easyload[$idSiteExportVariable.'-'.$name.'-'.$label.'-'.$exportName.'-'.$value.'-'.$type] :
		                                                                                                                               new SiteExportVariable($pdo,$idSiteExportVariable,$name,$label,$exportName,$value,$type,$easyload);
	}
	
	/**
	 * Serialiser
	 * @param $serialize bool activer la s�rialisation ?
	 * @return string serialisation du/de la siteexportvariable
	 */
	public function serialize($serialize=true)
	{
		// S�rialiser le/la siteExportVariable
		$array = array('idSiteExportVariable' => $this->idSiteExportVariable,'name' => $this->name,'label' => $this->label,'exportName' => $this->exportName,'value' => $this->value,'type' => $this->type);
		
		// Retourner la serialisation (ou pas) du/de la siteExportVariable
		return $serialize ? serialize($array) : $array;
	}
	
	/**
	 * D�s�rialiser
	 * @param $pdo PDO 
	 * @param $string string serialisation du/de la siteexportvariable
	 * @param $easyload bool activer le chargement rapide ?
	 * @return SiteExportVariable 
	 */
	public static function unserialize(PDO $pdo,$string,$easyload=true)
	{
		// D�s�rialiser la chaine de caract�res
		$array = unserialize($string);
		
		// Construire le/la siteExportVariable
		return isset(SiteExportVariable::$easyload[$array['idSiteExportVariable']]) ? SiteExportVariable::$easyload[$array['idSiteExportVariable']] :
		                                                                              new SiteExportVariable($pdo,$array['idSiteExportVariable'],$array['name'],$array['label'],$array['exportName'],$array['value'],$array['type'],$easyload);
	}
	
	/**
	 * Test d'�galit�
	 * @param $siteExportVariable SiteExportVariable 
	 * @return bool les objets sont ils �gaux ?
	 */
	public function equals($siteExportVariable)
	{
		// Test si null
		if ($siteExportVariable == null) { return false; }
		
		// Tester la classe
		if (!($siteExportVariable instanceof SiteExportVariable)) { return false; }
		
		// Tester les ids
		return $this->idSiteExportVariable == $siteExportVariable->idSiteExportVariable;
	}
	
	/**
	 * Compter les siteExportVariables
	 * @param $pdo PDO 
	 * @return int nombre de siteexportvariables
	 */
	public static function count(PDO $pdo)
	{
		if (!($pdoStatement = $pdo->query('SELECT COUNT(idSiteExportVariable) FROM SiteExportVariable'))) {
			throw new Exception('Erreur lors du comptage des siteExportVariables dans la base de donn�es');
		}
		return $pdoStatement->fetchColumn();
	}
	
	/**
	 * Supprimer le/la siteExportVariable
	 * @return bool op�ration r�ussie ?
	 */
	public function delete()
	{
		// Supprimer le/la siteExportVariable
		$pdoStatement = $this->pdo->prepare('DELETE FROM SiteExportVariable WHERE idSiteExportVariable = ?');
		if (!$pdoStatement->execute(array($this->getIdSiteExportVariable()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) siteExportVariable dans la base de donn�es');
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
		$pdoStatement = $this->pdo->prepare('UPDATE SiteExportVariable SET '.implode(', ', $updates).' WHERE idSiteExportVariable = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdSiteExportVariable())))) {
			throw new Exception('Erreur lors de la mise � jour d\'un champ d\'un(e) siteExportVariable dans la base de donn�es');
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
		return $this->_set(array('name','label','exportName','value','type'),array($this->name,$this->label,$this->exportName,$this->value,$this->type));
	}
	
	/**
	 * R�cup�rer le/la idSiteExportVariable
	 * @return int 
	 */
	public function getIdSiteExportVariable()
	{
		return $this->idSiteExportVariable;
	}
	
	public function getId()
	{
		return $this->idSiteExportVariable;
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
	 * R�cup�rer le/la label
	 * @return string 
	 */
	public function getLabel()
	{
		return $this->label;
	}
	
	/**
	 * D�finir le/la label
	 * @param $label string 
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setLabel($label,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->label = $label;
		
		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('label'),array($label)) : true;
	}
	
	/**
	 * R�cup�rer le/la exportName
	 * @return string 
	 */
	public function getExportName()
	{
		return $this->exportName;
	}
	
	/**
	 * D�finir le/la exportName
	 * @param $exportName string 
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setExportName($exportName,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->exportName = $exportName;
		
		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('exportName'),array($exportName)) : true;
	}
	
	/**
	 * R�cup�rer le/la value
	 * @return string 
	 */
	public function getValue()
	{
		return $this->value;
	}
	
	/**
	 * D�finir le/la value
	 * @param $value string 
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setValue($value,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->value = $value;
		
		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('value'),array($value)) : true;
	}
	
	/**
	 * R�cup�rer le/la type
	 * @return string 
	 */
	public function getType()
	{
		return $this->type;
	}
	
	/**
	 * D�finir le/la type
	 * @param $type string 
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setType($type,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->type = $type;
		
		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('type'),array($type)) : true;
	}
	/**
	 * ToString
	 * @return string repr�sentation de siteexportvariable sous la forme d'un string
	 */
	public function __toString()
	{
		return '[SiteExportVariable idSiteExportVariable="'.$this->idSiteExportVariable.'" name="'.$this->name.'" label="'.$this->label.'" exportName="'.$this->exportName.'" value="'.$this->value.'" type="'.$this->type.'"]';
	}
	
}

?>
