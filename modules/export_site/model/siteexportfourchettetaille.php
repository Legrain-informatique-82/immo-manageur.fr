<?php

/**
 * @class SiteExportFourchetteTaille
 * @date 12/12/2011 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class SiteExportFourchetteTaille
{
	/// @var PDO 
	private $pdo;
	
	/// @var array tableau pour le chargement rapide
	private static $easyload;
	
	/// @var int 
	private $idSiteExportFourchetteTaille;
	
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
	 * Construire un(e) siteExportFourchetteTaille
	 * @param $pdo PDO 
	 * @param $idSiteExportFourchetteTaille int 
	 * @param $name string 
	 * @param $valMin int 
	 * @param $valMax int 
	 * @param $transactionType int id de transactiontype
	 * @param $mandateType int id de mandatetype
	 * @param $easyload bool activer le chargement rapide ?
	 * @return SiteExportFourchetteTaille 
	 */
	protected function __construct(PDO $pdo,$idSiteExportFourchetteTaille,$name,$valMin,$valMax,$transactionType,$mandateType,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;
		
		// Sauvegarder les attributs
		$this->idSiteExportFourchetteTaille = $idSiteExportFourchetteTaille;
		$this->name = $name;
		$this->valMin = $valMin;
		$this->valMax = $valMax;
		$this->transactionType = $transactionType;
		$this->mandateType = $mandateType;
		
		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			SiteExportFourchetteTaille::$easyload[$idSiteExportFourchetteTaille] = $this;
		}
	}
	
	/**
	 * Cr�er un(e) siteExportFourchetteTaille
	 * @param $pdo PDO 
	 * @param $name string 
	 * @param $valMin int 
	 * @param $valMax int 
	 * @param $transactionType TransactionType 
	 * @param $mandateType MandateType 
	 * @param $easyload bool activer le chargement rapide ?
	 * @return SiteExportFourchetteTaille 
	 */
	public static function create(PDO $pdo,$name,$valMin,$valMax,TransactionType $transactionType,MandateType $mandateType,$easyload=true)
	{
		// Ajouter le/la siteExportFourchetteTaille dans la base de donn�es
		$pdoStatement = $pdo->prepare('INSERT INTO SiteExportFourchetteTaille (name,valMin,valMax,transactionType_idTransactionType,mandateType_idMandateType) VALUES (?,?,?,?,?)');
		if (!$pdoStatement->execute(array($name,$valMin,$valMax,$transactionType->getIdTransactionType(),$mandateType->getIdMandateType()))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) siteExportFourchetteTaille dans la base de donn�es');
		}
		
		// Construire le/la siteExportFourchetteTaille
		return new SiteExportFourchetteTaille($pdo,$pdo->lastInsertId(),$name,$valMin,$valMax,$transactionType->getIdTransactionType(),$mandateType->getIdMandateType(),$easyload);
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
		return $pdo->prepare('SELECT s.idSiteExportFourchetteTaille, s.name, s.valMin, s.valMax, s.transactionType_idTransactionType, s.mandateType_idMandateType FROM SiteExportFourchetteTaille s '.
		                     ($where != null ? ' WHERE '.$where : '').
		                     ($orderby != null ? ' ORDER BY '.$orderby : '').
		                     ($limit != null ? ' LIMIT '.$limit : ''));
	}
	
	/**
	 * Charger un(e) siteExportFourchetteTaille
	 * @param $pdo PDO 
	 * @param $idSiteExportFourchetteTaille int 
	 * @param $easyload bool activer le chargement rapide ?
	 * @return SiteExportFourchetteTaille 
	 */
	public static function load(PDO $pdo,$idSiteExportFourchetteTaille,$easyload=true)
	{
		// D�j� charg�(e) ?
		if (isset(SiteExportFourchetteTaille::$easyload[$idSiteExportFourchetteTaille])) {
			return SiteExportFourchetteTaille::$easyload[$idSiteExportFourchetteTaille];
		}
		
		// Charger le/la siteExportFourchetteTaille
		$pdoStatement = SiteExportFourchetteTaille::_select($pdo,'s.idSiteExportFourchetteTaille = ?');
		if (!$pdoStatement->execute(array($idSiteExportFourchetteTaille))) {
			throw new Exception('Erreur lors du chargement d\'un(e) siteExportFourchetteTaille depuis la base de donn�es');
		}
		
		// R�cup�rer le/la siteExportFourchetteTaille depuis le jeu de r�sultats
		return SiteExportFourchetteTaille::fetch($pdo,$pdoStatement,$easyload);
	}
	
	/**
	 * Charger tous/toutes les siteExportFourchetteTailles
	 * @param $pdo PDO 
	 * @param $easyload bool activer le chargement rapide ?
	 * @return SiteExportFourchetteTaille[] tableau de siteexportfourchettetailles
	 */
	public static function loadAll(PDO $pdo,$easyload=false)
	{
		// S�lectionner tous/toutes les siteExportFourchetteTailles
		$pdoStatement = SiteExportFourchetteTaille::selectAll($pdo,null,'transactionType_idTransactionType ASC, mandateType_idMandateType ASC, valMax ASC');
		
		// Mettre chaque siteExportFourchetteTaille dans un tableau
		$siteExportFourchetteTailles = array();
		while ($siteExportFourchetteTaille = SiteExportFourchetteTaille::fetch($pdo,$pdoStatement,$easyload)) {
			$siteExportFourchetteTailles[] = $siteExportFourchetteTaille;
		}
		
		// Retourner le tableau
		return $siteExportFourchetteTailles;
	}
	
	/**
	 * S�lectionner tous/toutes les siteExportFourchetteTailles
	 * @param $pdo PDO 
	 * @return PDOStatement 
	 */
	public static function selectAll(PDO $pdo,$where=null,$orderby=null,$limit=null)
	{
		$pdoStatement = SiteExportFourchetteTaille::_select($pdo,$where,$orderby,$limit);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les siteExportFourchetteTailles depuis la base de donn�es');
		}
		return $pdoStatement;
	}
	
	/**
	 * R�cup�re le/la siteExportFourchetteTaille suivant(e) d'un jeu de r�sultats
	 * @param $pdo PDO 
	 * @param $pdoStatement PDOStatement 
	 * @param $easyload bool activer le chargement rapide ?
	 * @return SiteExportFourchetteTaille 
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idSiteExportFourchetteTaille,$name,$valMin,$valMax,$transactionType,$mandateType) = $values;
		
		// Construire le/la siteExportFourchetteTaille
		return isset(SiteExportFourchetteTaille::$easyload[$idSiteExportFourchetteTaille.'-'.$name.'-'.$valMin.'-'.$valMax.'-'.$transactionType.'-'.$mandateType]) ? SiteExportFourchetteTaille::$easyload[$idSiteExportFourchetteTaille.'-'.$name.'-'.$valMin.'-'.$valMax.'-'.$transactionType.'-'.$mandateType] :
		                                                                                                                                                             new SiteExportFourchetteTaille($pdo,$idSiteExportFourchetteTaille,$name,$valMin,$valMax,$transactionType,$mandateType,$easyload);
	}
	
	/**
	 * Serialiser
	 * @param $serialize bool activer la s�rialisation ?
	 * @return string serialisation du/de la siteexportfourchettetaille
	 */
	public function serialize($serialize=true)
	{
		// S�rialiser le/la siteExportFourchetteTaille
		$array = array('idSiteExportFourchetteTaille' => $this->idSiteExportFourchetteTaille,'name' => $this->name,'valMin' => $this->valMin,'valMax' => $this->valMax,'transactionType' => $this->transactionType,'mandateType' => $this->mandateType);
		
		// Retourner la serialisation (ou pas) du/de la siteExportFourchetteTaille
		return $serialize ? serialize($array) : $array;
	}
	
	/**
	 * D�s�rialiser
	 * @param $pdo PDO 
	 * @param $string string serialisation du/de la siteexportfourchettetaille
	 * @param $easyload bool activer le chargement rapide ?
	 * @return SiteExportFourchetteTaille 
	 */
	public static function unserialize(PDO $pdo,$string,$easyload=true)
	{
		// D�s�rialiser la chaine de caract�res
		$array = unserialize($string);
		
		// Construire le/la siteExportFourchetteTaille
		return isset(SiteExportFourchetteTaille::$easyload[$array['idSiteExportFourchetteTaille']]) ? SiteExportFourchetteTaille::$easyload[$array['idSiteExportFourchetteTaille']] :
		                                                                                              new SiteExportFourchetteTaille($pdo,$array['idSiteExportFourchetteTaille'],$array['name'],$array['valMin'],$array['valMax'],$array['transactionType'],$array['mandateType'],$easyload);
	}
	
	/**
	 * Test d'�galit�
	 * @param $siteExportFourchetteTaille SiteExportFourchetteTaille 
	 * @return bool les objets sont ils �gaux ?
	 */
	public function equals($siteExportFourchetteTaille)
	{
		// Test si null
		if ($siteExportFourchetteTaille == null) { return false; }
		
		// Tester la classe
		if (!($siteExportFourchetteTaille instanceof SiteExportFourchetteTaille)) { return false; }
		
		// Tester les ids
		return $this->idSiteExportFourchetteTaille == $siteExportFourchetteTaille->idSiteExportFourchetteTaille;
	}
	
	/**
	 * Compter les siteExportFourchetteTailles
	 * @param $pdo PDO 
	 * @return int nombre de siteexportfourchettetailles
	 */
	public static function count(PDO $pdo)
	{
		if (!($pdoStatement = $pdo->query('SELECT COUNT(idSiteExportFourchetteTaille) FROM SiteExportFourchetteTaille'))) {
			throw new Exception('Erreur lors du comptage des siteExportFourchetteTailles dans la base de donn�es');
		}
		return $pdoStatement->fetchColumn();
	}
	
	/**
	 * Supprimer le/la siteExportFourchetteTaille
	 * @return bool op�ration r�ussie ?
	 */
	public function delete()
	{
		// Supprimer le/la siteExportFourchetteTaille
		$pdoStatement = $this->pdo->prepare('DELETE FROM SiteExportFourchetteTaille WHERE idSiteExportFourchetteTaille = ?');
		if (!$pdoStatement->execute(array($this->getIdSiteExportFourchetteTaille()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) siteExportFourchetteTaille dans la base de donn�es');
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
		$pdoStatement = $this->pdo->prepare('UPDATE SiteExportFourchetteTaille SET '.implode(', ', $updates).' WHERE idSiteExportFourchetteTaille = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdSiteExportFourchetteTaille())))) {
			throw new Exception('Erreur lors de la mise � jour d\'un champ d\'un(e) siteExportFourchetteTaille dans la base de donn�es');
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
	 * R�cup�rer le/la idSiteExportFourchetteTaille
	 * @return int 
	 */
	public function getIdSiteExportFourchetteTaille()
	{
		return $this->idSiteExportFourchetteTaille;
	}
	public function getId()
	{
		return $this->idSiteExportFourchetteTaille;
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
	 * S�lectionner les siteExportFourchetteTailles par transactionType
	 * @param $pdo PDO 
	 * @param $transactionType TransactionType 
	 * @return PDOStatement 
	 */
	public static function selectByTransactionType(PDO $pdo,TransactionType $transactionType)
	{
		$pdoStatement = $pdo->prepare('SELECT s.idSiteExportFourchetteTaille, s.name, s.valMin, s.valMax, s.transactionType_idTransactionType, s.mandateType_idMandateType FROM SiteExportFourchetteTaille s WHERE s.transactionType_idTransactionType = ?');
		if (!$pdoStatement->execute(array($transactionType->getIdTransactionType()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les siteExportFourchetteTailles par transactionType depuis la base de donn�es');
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
	 * S�lectionner les siteExportFourchetteTailles par mandateType
	 * @param $pdo PDO 
	 * @param $mandateType MandateType 
	 * @return PDOStatement 
	 */
	public static function selectByMandateType(PDO $pdo,MandateType $mandateType)
	{
		$pdoStatement = $pdo->prepare('SELECT s.idSiteExportFourchetteTaille, s.name, s.valMin, s.valMax, s.transactionType_idTransactionType, s.mandateType_idMandateType FROM SiteExportFourchetteTaille s WHERE s.mandateType_idMandateType = ?');
		if (!$pdoStatement->execute(array($mandateType->getIdMandateType()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les siteExportFourchetteTailles par mandateType depuis la base de donn�es');
		}
		return $pdoStatement;
	}
	/**
	 * ToString
	 * @return string repr�sentation de siteexportfourchettetaille sous la forme d'un string
	 */
	public function __toString()
	{
		return '[SiteExportFourchetteTaille idSiteExportFourchetteTaille="'.$this->idSiteExportFourchetteTaille.'" name="'.$this->name.'" valMin="'.$this->valMin.'" valMax="'.$this->valMax.'" transactionType="'.$this->transactionType.'" mandateType="'.$this->mandateType.'"]';
	}
	
}

?>
