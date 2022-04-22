<?php

/**
 * @class SiteExportFourchettePrix
 * @date 12/12/2011 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class SiteExportFourchettePrix
{
	/// @var PDO 
	private $pdo;
	
	/// @var array tableau pour le chargement rapide
	private static $easyload;
	
	/// @var int 
	private $idSiteExportFourchettePrix;
	
	/// @var string 
	private $name;
	
	/// @var int 
	private $valMin;
	
	/// @var int 
	private $valMax;
	
	/// @var int id de transactiontype
	private $transactionType;
	
	/// @var int id de mandatetype
	private $mandateType;
	
	/**
	 * Construire un(e) siteExportFourchettePrix
	 * @param $pdo PDO 
	 * @param $idSiteExportFourchettePrix int 
	 * @param $name string 
	 * @param $valMin int 
	 * @param $valMax int 
	 * @param $transactionType int id de transactiontype
	 * @param $mandateType int id de mandatetype
	 * @param $easyload bool activer le chargement rapide ?
	 * @return SiteExportFourchettePrix 
	 */
	protected function __construct(PDO $pdo,$idSiteExportFourchettePrix,$name,$valMin,$valMax,$transactionType,$mandateType,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;
		
		// Sauvegarder les attributs
		$this->idSiteExportFourchettePrix = $idSiteExportFourchettePrix;
		$this->name = $name;
		$this->valMin = $valMin;
		$this->valMax = $valMax;
		$this->transactionType = $transactionType;
		$this->mandateType = $mandateType;
		
		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			SiteExportFourchettePrix::$easyload[$idSiteExportFourchettePrix] = $this;
		}
	}
	
	/**
	 * Cr�er un(e) siteExportFourchettePrix
	 * @param $pdo PDO 
	 * @param $name string 
	 * @param $valMin int 
	 * @param $valMax int 
	 * @param $transactionType TransactionType 
	 * @param $mandateType MandateType 
	 * @param $easyload bool activer le chargement rapide ?
	 * @return SiteExportFourchettePrix 
	 */
	public static function create(PDO $pdo,$name,$valMin,$valMax,TransactionType $transactionType,MandateType $mandateType,$easyload=true)
	{
		// Ajouter le/la siteExportFourchettePrix dans la base de donn�es
		$pdoStatement = $pdo->prepare('INSERT INTO SiteExportFourchettePrix (name,valMin,valMax,transactionType_idTransactionType,mandateType_idMandateType) VALUES (?,?,?,?,?)');
		if (!$pdoStatement->execute(array($name,$valMin,$valMax,$transactionType->getIdTransactionType(),$mandateType->getIdMandateType()))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) siteExportFourchettePrix dans la base de donn�es');
		}
		
		// Construire le/la siteExportFourchettePrix
		return new SiteExportFourchettePrix($pdo,$pdo->lastInsertId(),$name,$valMin,$valMax,$transactionType->getIdTransactionType(),$mandateType->getIdMandateType(),$easyload);
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
		return $pdo->prepare('SELECT s.idSiteExportFourchettePrix, s.name, s.valMin, s.valMax, s.transactionType_idTransactionType, s.mandateType_idMandateType FROM SiteExportFourchettePrix s '.
		                     ($where != null ? ' WHERE '.$where : '').
		                     ($orderby != null ? ' ORDER BY '.$orderby : '').
		                     ($limit != null ? ' LIMIT '.$limit : ''));
	}
	
	/**
	 * Charger un(e) siteExportFourchettePrix
	 * @param $pdo PDO 
	 * @param $idSiteExportFourchettePrix int 
	 * @param $easyload bool activer le chargement rapide ?
	 * @return SiteExportFourchettePrix 
	 */
	public static function load(PDO $pdo,$idSiteExportFourchettePrix,$easyload=true)
	{
		// D�j� charg�(e) ?
		if (isset(SiteExportFourchettePrix::$easyload[$idSiteExportFourchettePrix])) {
			return SiteExportFourchettePrix::$easyload[$idSiteExportFourchettePrix];
		}
		
		// Charger le/la siteExportFourchettePrix
		$pdoStatement = SiteExportFourchettePrix::_select($pdo,'s.idSiteExportFourchettePrix = ?');
		if (!$pdoStatement->execute(array($idSiteExportFourchettePrix))) {
			throw new Exception('Erreur lors du chargement d\'un(e) siteExportFourchettePrix depuis la base de donn�es');
		}
		
		// R�cup�rer le/la siteExportFourchettePrix depuis le jeu de r�sultats
		return SiteExportFourchettePrix::fetch($pdo,$pdoStatement,$easyload);
	}
	
	/**
	 * Charger tous/toutes les siteExportFourchettePrix
	 * @param $pdo PDO 
	 * @param $easyload bool activer le chargement rapide ?
	 * @return SiteExportFourchettePrix[] tableau de siteexportfourchetteprix
	 */
	public static function loadAll(PDO $pdo,$easyload=false)
	{
		// S�lectionner tous/toutes les siteExportFourchettePrix
		$pdoStatement = SiteExportFourchettePrix::selectAll($pdo,null,'transactionType_idTransactionType ASC, mandateType_idMandateType ASC, valMax ASC');
		
		// Mettre chaque siteExportFourchettePrix dans un tableau
		$array = array();
		while ($siteExportFourchettePrix = SiteExportFourchettePrix::fetch($pdo,$pdoStatement,$easyload)) {
			$array[] = $siteExportFourchettePrix;
		}
		
		// Retourner le tableau
		return $array;
	}
	
	/**
	 * S�lectionner tous/toutes les siteExportFourchettePrix
	 * @param $pdo PDO 
	 * @return PDOStatement 
	 */
	public static function selectAll(PDO $pdo,$where=null,$orderby=null,$limit=null)
	{
		$pdoStatement = SiteExportFourchettePrix::_select($pdo,$where,$orderby,$limit);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les siteExportFourchettePrix depuis la base de donn�es');
		}
		return $pdoStatement;
	}
	
	/**
	 * R�cup�re le/la siteExportFourchettePrix suivant(e) d'un jeu de r�sultats
	 * @param $pdo PDO 
	 * @param $pdoStatement PDOStatement 
	 * @param $easyload bool activer le chargement rapide ?
	 * @return SiteExportFourchettePrix 
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idSiteExportFourchettePrix,$name,$valMin,$valMax,$transactionType,$mandateType) = $values;
		
		// Construire le/la siteExportFourchettePrix
		return isset(SiteExportFourchettePrix::$easyload[$idSiteExportFourchettePrix.'-'.$name.'-'.$valMin.'-'.$valMax.'-'.$transactionType.'-'.$mandateType]) ? SiteExportFourchettePrix::$easyload[$idSiteExportFourchettePrix.'-'.$name.'-'.$valMin.'-'.$valMax.'-'.$transactionType.'-'.$mandateType] :
		                                                                                                                                                         new SiteExportFourchettePrix($pdo,$idSiteExportFourchettePrix,$name,$valMin,$valMax,$transactionType,$mandateType,$easyload);
	}
	
	/**
	 * Serialiser
	 * @param $serialize bool activer la s�rialisation ?
	 * @return string serialisation du/de la siteexportfourchetteprix
	 */
	public function serialize($serialize=true)
	{
		// S�rialiser le/la siteExportFourchettePrix
		$array = array('idSiteExportFourchettePrix' => $this->idSiteExportFourchettePrix,'name' => $this->name,'valMin' => $this->valMin,'valMax' => $this->valMax,'transactionType' => $this->transactionType,'mandateType' => $this->mandateType);
		
		// Retourner la serialisation (ou pas) du/de la siteExportFourchettePrix
		return $serialize ? serialize($array) : $array;
	}
	
	/**
	 * D�s�rialiser
	 * @param $pdo PDO 
	 * @param $string string serialisation du/de la siteexportfourchetteprix
	 * @param $easyload bool activer le chargement rapide ?
	 * @return SiteExportFourchettePrix 
	 */
	public static function unserialize(PDO $pdo,$string,$easyload=true)
	{
		// D�s�rialiser la chaine de caract�res
		$array = unserialize($string);
		
		// Construire le/la siteExportFourchettePrix
		return isset(SiteExportFourchettePrix::$easyload[$array['idSiteExportFourchettePrix']]) ? SiteExportFourchettePrix::$easyload[$array['idSiteExportFourchettePrix']] :
		                                                                                          new SiteExportFourchettePrix($pdo,$array['idSiteExportFourchettePrix'],$array['name'],$array['valMin'],$array['valMax'],$array['transactionType'],$array['mandateType'],$easyload);
	}
	
	/**
	 * Test d'�galit�
	 * @param $siteExportFourchettePrix SiteExportFourchettePrix 
	 * @return bool les objets sont ils �gaux ?
	 */
	public function equals($siteExportFourchettePrix)
	{
		// Test si null
		if ($siteExportFourchettePrix == null) { return false; }
		
		// Tester la classe
		if (!($siteExportFourchettePrix instanceof SiteExportFourchettePrix)) { return false; }
		
		// Tester les ids
		return $this->idSiteExportFourchettePrix == $siteExportFourchettePrix->idSiteExportFourchettePrix;
	}
	
	/**
	 * Compter les siteExportFourchettePrix
	 * @param $pdo PDO 
	 * @return int nombre de siteexportfourchetteprix
	 */
	public static function count(PDO $pdo)
	{
		if (!($pdoStatement = $pdo->query('SELECT COUNT(idSiteExportFourchettePrix) FROM SiteExportFourchettePrix'))) {
			throw new Exception('Erreur lors du comptage des siteExportFourchettePrix dans la base de donn�es');
		}
		return $pdoStatement->fetchColumn();
	}
	
	/**
	 * Supprimer le/la siteExportFourchettePrix
	 * @return bool op�ration r�ussie ?
	 */
	public function delete()
	{
		// Supprimer le/la siteExportFourchettePrix
		$pdoStatement = $this->pdo->prepare('DELETE FROM SiteExportFourchettePrix WHERE idSiteExportFourchettePrix = ?');
		if (!$pdoStatement->execute(array($this->getIdSiteExportFourchettePrix()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) siteExportFourchettePrix dans la base de donn�es');
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
		$pdoStatement = $this->pdo->prepare('UPDATE SiteExportFourchettePrix SET '.implode(', ', $updates).' WHERE idSiteExportFourchettePrix = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdSiteExportFourchettePrix())))) {
			throw new Exception('Erreur lors de la mise � jour d\'un champ d\'un(e) siteExportFourchettePrix dans la base de donn�es');
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
		return $this->_set(array('name','valMin','valMax','transactionType_idTransactionType','mandateType_idMandateType'),array($this->name,$this->valMin,$this->valMax,$this->transactionType,$this->mandateType));
	}
	
	/**
	 * R�cup�rer le/la idSiteExportFourchettePrix
	 * @return int 
	 */
	public function getIdSiteExportFourchettePrix()
	{
		return $this->idSiteExportFourchettePrix;
	}
	public function getId()
	{
		return $this->idSiteExportFourchettePrix;
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
	 * R�cup�rer le/la valMin
	 * @return int 
	 */
	public function getValMin()
	{
		return $this->valMin;
	}
	
	/**
	 * D�finir le/la valMin
	 * @param $valMin int 
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setValMin($valMin,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->valMin = $valMin;
		
		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('valMin'),array($valMin)) : true;
	}
	
	/**
	 * R�cup�rer le/la valMax
	 * @return int 
	 */
	public function getValMax()
	{
		return $this->valMax;
	}
	
	/**
	 * D�finir le/la valMax
	 * @param $valMax int 
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setValMax($valMax,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->valMax = $valMax;
		
		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('valMax'),array($valMax)) : true;
	}
	
	/**
	 * R�cup�rer le/la transactionType
	 * @return TransactionType 
	 */
	public function getTransactionType()
	{
		return TransactionType::load($this->pdo,$this->transactionType);
	}
	
	/**
	 * D�finir le/la transactionType
	 * @param $transactionType TransactionType 
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setTransactionType(TransactionType $transactionType,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->transactionType = $transactionType->getIdTransactionType();
		
		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('transactionType_idTransactionType'),array($transactionType->getIdTransactionType())) : true;
	}
	
	/**
	 * S�lectionner les siteExportFourchettePrix par transactionType
	 * @param $pdo PDO 
	 * @param $transactionType TransactionType 
	 * @return PDOStatement 
	 */
	public static function selectByTransactionType(PDO $pdo,TransactionType $transactionType)
	{
		$pdoStatement = $pdo->prepare('SELECT s.idSiteExportFourchettePrix, s.name, s.valMin, s.valMax, s.transactionType_idTransactionType, s.mandateType_idMandateType FROM SiteExportFourchettePrix s WHERE s.transactionType_idTransactionType = ?');
		if (!$pdoStatement->execute(array($transactionType->getIdTransactionType()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les siteExportFourchettePrix par transactionType depuis la base de donn�es');
		}
		return $pdoStatement;
	}
	
	/**
	 * R�cup�rer le/la mandateType
	 * @return MandateType 
	 */
	public function getMandateType()
	{
		return MandateType::load($this->pdo,$this->mandateType);
	}
	
	/**
	 * D�finir le/la mandateType
	 * @param $mandateType MandateType 
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setMandateType(MandateType $mandateType,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->mandateType = $mandateType->getIdMandateType();
		
		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('mandateType_idMandateType'),array($mandateType->getIdMandateType())) : true;
	}
	
	/**
	 * S�lectionner les siteExportFourchettePrix par mandateType
	 * @param $pdo PDO 
	 * @param $mandateType MandateType 
	 * @return PDOStatement 
	 */
	public static function selectByMandateType(PDO $pdo,MandateType $mandateType)
	{
		$pdoStatement = $pdo->prepare('SELECT s.idSiteExportFourchettePrix, s.name, s.valMin, s.valMax, s.transactionType_idTransactionType, s.mandateType_idMandateType FROM SiteExportFourchettePrix s WHERE s.mandateType_idMandateType = ?');
		if (!$pdoStatement->execute(array($mandateType->getIdMandateType()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les siteExportFourchettePrix par mandateType depuis la base de donn�es');
		}
		return $pdoStatement;
	}
	/**
	 * ToString
	 * @return string repr�sentation de siteexportfourchetteprix sous la forme d'un string
	 */
	public function __toString()
	{
		return '[SiteExportFourchettePrix idSiteExportFourchettePrix="'.$this->idSiteExportFourchettePrix.'" name="'.$this->name.'" valMin="'.$this->valMin.'" valMax="'.$this->valMax.'" transactionType="'.$this->transactionType.'" mandateType="'.$this->mandateType.'"]';
	}
	
}

?>
