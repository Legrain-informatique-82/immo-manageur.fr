<?php

/**
 * @class RelSituaTionAcq
 * @date 02/01/2012 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class RelSituaTionAcq
{
	/// @var PDO 
	private $pdo;
	
	/// @var array tableau pour le chargement rapide
	private static $easyload;
	
	/// @var int 
	private $idRelSituaTionAcq;
	
	/// @var int id de acquereur
	private $acquereur;
	
	/// @var int id de acquereurassocie
	private $acquereurAssocie;
	
	/// @var int id de situationacquereur
	private $situationAcquereur;
	
	/// @var int 
	private $eventDate;
	
	/// @var string 
	private $eventLocation;
	
	/**
	 * Construire un(e) relSituaTionAcq
	 * @param $pdo PDO 
	 * @param $idRelSituaTionAcq int 
	 * @param $situationAcquereur int id de situationacquereur
	 * @param $acquereur int id de acquereur
	 * @param $acquereurAssocie int id de acquereurassocie
	 * @param $eventDate int 
	 * @param $eventLocation string 
	 * @param $easyload bool activer le chargement rapide ?
	 * @return RelSituaTionAcq 
	 */
	protected function __construct(PDO $pdo,$idRelSituaTionAcq,$situationAcquereur,$acquereur=null,$acquereurAssocie=null,$eventDate=null,$eventLocation=null,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;
		
		// Sauvegarder les attributs
		$this->idRelSituaTionAcq = $idRelSituaTionAcq;
		$this->situationAcquereur = $situationAcquereur;
		$this->acquereur = $acquereur;
		$this->acquereurAssocie = $acquereurAssocie;
		$this->eventDate = $eventDate;
		$this->eventLocation = $eventLocation;
		
		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			RelSituaTionAcq::$easyload[$idRelSituaTionAcq] = $this;
		}
	}
	
	/**
	 * Cr�er un(e) relSituaTionAcq
	 * @param $pdo PDO 
	 * @param $situationAcquereur SituationAcquereur 
	 * @param $acquereur Acquereur 
	 * @param $acquereurAssocie AcquereurAssocie 
	 * @param $eventDate int 
	 * @param $eventLocation string 
	 * @param $easyload bool activer le chargement rapide ?
	 * @return RelSituaTionAcq 
	 */
	public static function create(PDO $pdo,SituationAcquereur $situationAcquereur,$acquereur=null,$acquereurAssocie=null,$eventDate=null,$eventLocation=null,$easyload=true)
	{
		// Ajouter le/la relSituaTionAcq dans la base de donn�es
		$pdoStatement = $pdo->prepare('INSERT INTO RelSituaTionAcq (situationAcquereur_idSituationAcquereur,acquereur_idAcquereur,acquereurAssocie_idAcquereurAssocie,eventDate,eventLocation) VALUES (?,?,?,?,?)');
		if (!$pdoStatement->execute(array($situationAcquereur->getIdSituationAcquereur(),$acquereur == null ? null : $acquereur->getIdAcquereur(),$acquereurAssocie == null ? null : $acquereurAssocie->getIdAcquereurAssocie(),$eventDate === null ? null : date('Y-m-d H:i:s',$eventDate),$eventLocation))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) relSituaTionAcq dans la base de donn�es');
		}
		
		// Construire le/la relSituaTionAcq
		return new RelSituaTionAcq($pdo,$pdo->lastInsertId(),$situationAcquereur->getIdSituationAcquereur(),($acquereur?$acquereur->getIdAcquereur():null),($acquereurAssocie?$acquereurAssocie->getIdAcquereurAssocie():null),$eventDate,$eventLocation,$easyload);
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
		return $pdo->prepare('SELECT r.idRelSituaTionAcq, r.situationAcquereur_idSituationAcquereur, r.acquereur_idAcquereur, r.acquereurAssocie_idAcquereurAssocie, r.eventDate, r.eventLocation FROM RelSituaTionAcq r '.
		                     ($where != null ? ' WHERE '.$where : '').
		                     ($orderby != null ? ' ORDERBY '.$orderby : '').
		                     ($limit != null ? ' LIMIT '.$limit : ''));
	}
	
	/**
	 * Charger un(e) relSituaTionAcq
	 * @param $pdo PDO 
	 * @param $idRelSituaTionAcq int 
	 * @param $easyload bool activer le chargement rapide ?
	 * @return RelSituaTionAcq 
	 */
	public static function load(PDO $pdo,$idRelSituaTionAcq,$easyload=true)
	{
		// D�j� charg�(e) ?
		if (isset(RelSituaTionAcq::$easyload[$idRelSituaTionAcq])) {
			return RelSituaTionAcq::$easyload[$idRelSituaTionAcq];
		}
		
		// Charger le/la relSituaTionAcq
		$pdoStatement = RelSituaTionAcq::_select($pdo,'r.idRelSituaTionAcq = ?');
		if (!$pdoStatement->execute(array($idRelSituaTionAcq))) {
			throw new Exception('Erreur lors du chargement d\'un(e) relSituaTionAcq depuis la base de donn�es');
		}
		
		// R�cup�rer le/la relSituaTionAcq depuis le jeu de r�sultats
		return RelSituaTionAcq::fetch($pdo,$pdoStatement,$easyload);
	}
	
	public static function loadByAcquereur(PDO $pdo,Acquereur $acquereur,$easyload=true)
	{
		// D�j� charg�(e) ?
// 		if (isset(RelSituaTionAcq::$easyload[$idRelSituaTionAcq])) {
// 			return RelSituaTionAcq::$easyload[$idRelSituaTionAcq];
// 		}
	
		// Charger le/la relSituaTionAcq
		$pdoStatement = RelSituaTionAcq::_select($pdo,'r.acquereur_idAcquereur = ?');
		if (!$pdoStatement->execute(array($acquereur->getIdAcquereur() ))) {
			throw new Exception('Erreur lors du chargement d\'un(e) relSituaTionAcq depuis la base de donn�es');
		}
	
		// R�cup�rer le/la relSituaTionAcq depuis le jeu de r�sultats
		return RelSituaTionAcq::fetch($pdo,$pdoStatement,$easyload);
	}
	
	public static function loadByAcquereurAssos(PDO $pdo,AcquereurAssocie $acquereurAssocie,$easyload=true)
	{
		// D�j� charg�(e) ?
		// 		if (isset(RelSituaTionAcq::$easyload[$idRelSituaTionAcq])) {
		// 			return RelSituaTionAcq::$easyload[$idRelSituaTionAcq];
		// 		}
	
		// Charger le/la relSituaTionAcq
		$pdoStatement = RelSituaTionAcq::_select($pdo,'r.acquereurAssocie_idAcquereurAssocie = ?');
		if (!$pdoStatement->execute(array($acquereurAssocie->getId() ))) {
			throw new Exception('Erreur lors du chargement d\'un(e) relSituaTionAcq depuis la base de donn�es');
		}
	
		// R�cup�rer le/la relSituaTionAcq depuis le jeu de r�sultats
		return RelSituaTionAcq::fetch($pdo,$pdoStatement,$easyload);
	}
	
	
	/**
	 * Charger tous/toutes les relSituaTionAcqs
	 * @param $pdo PDO 
	 * @param $easyload bool activer le chargement rapide ?
	 * @return RelSituaTionAcq[] tableau de relsituationacqs
	 */
	public static function loadAll(PDO $pdo,$easyload=false)
	{
		// S�lectionner tous/toutes les relSituaTionAcqs
		$pdoStatement = RelSituaTionAcq::selectAll($pdo);
		
		// Mettre chaque relSituaTionAcq dans un tableau
		$relSituaTionAcqs = array();
		while ($relSituaTionAcq = RelSituaTionAcq::fetch($pdo,$pdoStatement,$easyload)) {
			$relSituaTionAcqs[] = $relSituaTionAcq;
		}
		
		// Retourner le tableau
		return $relSituaTionAcqs;
	}
	
	/**
	 * S�lectionner tous/toutes les relSituaTionAcqs
	 * @param $pdo PDO 
	 * @return PDOStatement 
	 */
	public static function selectAll(PDO $pdo)
	{
		$pdoStatement = RelSituaTionAcq::_select($pdo);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les relSituaTionAcqs depuis la base de donn�es');
		}
		return $pdoStatement;
	}
	
	/**
	 * R�cup�re le/la relSituaTionAcq suivant(e) d'un jeu de r�sultats
	 * @param $pdo PDO 
	 * @param $pdoStatement PDOStatement 
	 * @param $easyload bool activer le chargement rapide ?
	 * @return RelSituaTionAcq 
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idRelSituaTionAcq,$situationAcquereur,$acquereur,$acquereurAssocie,$eventDate,$eventLocation) = $values;
		
		// Construire le/la relSituaTionAcq
		return isset(RelSituaTionAcq::$easyload[$idRelSituaTionAcq.'-'.$situationAcquereur.'-'.$acquereur.'-'.$acquereurAssocie.'-'.strtotime($eventDate).'-'.$eventLocation]) ? RelSituaTionAcq::$easyload[$idRelSituaTionAcq.'-'.$situationAcquereur.'-'.$acquereur.'-'.$acquereurAssocie.'-'.strtotime($eventDate).'-'.$eventLocation] :
		                                                                                                                                                                         new RelSituaTionAcq($pdo,$idRelSituaTionAcq,$situationAcquereur,$acquereur,$acquereurAssocie,strtotime($eventDate),$eventLocation,$easyload);
	}
	
	/**
	 * Supprimer le/la relSituaTionAcq
	 * @return bool op�ration r�ussie ?
	 */
	public function delete()
	{
		// Supprimer le/la relSituaTionAcq
		$pdoStatement = $this->pdo->prepare('DELETE FROM RelSituaTionAcq WHERE idRelSituaTionAcq = ?');
		if (!$pdoStatement->execute(array($this->getIdRelSituaTionAcq()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) relSituaTionAcq dans la base de donn�es');
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
		$pdoStatement = $this->pdo->prepare('UPDATE RelSituaTionAcq SET '.implode(', ', $updates).' WHERE idRelSituaTionAcq = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdRelSituaTionAcq())))) {
			throw new Exception('Erreur lors de la mise � jour d\'un champ d\'un(e) relSituaTionAcq dans la base de donn�es');
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
		return $this->_set(array('acquereur_idAcquereur','acquereurAssocie_idAcquereurAssocie','situationAcquereur_idSituationAcquereur','eventDate','eventLocation'),array($this->acquereur,$this->acquereurAssocie,$this->situationAcquereur,$this->eventDate === null ? null : date('Y-m-d H:i:s',$this->eventDate),$this->eventLocation));
	}
	
	/**
	 * R�cup�rer le/la idRelSituaTionAcq
	 * @return int 
	 */
	public function getIdRelSituaTionAcq()
	{
		return $this->idRelSituaTionAcq;
	}
	
	/**
	 * R�cup�rer le/la acquereur
	 * @return Acquereur 
	 */
	public function getAcquereur()
	{
		// Retourner null si n�c�ssaire
		if ($this->acquereur == null) { return null; }
		
		// Charger et retourner acquereur
		return Acquereur::load($this->pdo,$this->acquereur);
	}
	
	/**
	 * D�finir le/la acquereur
	 * @param $acquereur Acquereur 
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setAcquereur($acquereur=null,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->acquereur = $acquereur == null ? null : $acquereur->getIdAcquereur();
		
		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('acquereur_idAcquereur'),array($acquereur == null ? null : $acquereur->getIdAcquereur())) : true;
	}
	
	/**
	 * S�lectionner les relSituaTionAcqs par acquereur
	 * @param $pdo PDO 
	 * @param $acquereur Acquereur 
	 * @return PDOStatement 
	 */
	public static function selectByAcquereur(PDO $pdo,Acquereur $acquereur)
	{
		$pdoStatement = $pdo->prepare('SELECT r.idRelSituaTionAcq, r.situationAcquereur_idSituationAcquereur, r.acquereur_idAcquereur, r.acquereurAssocie_idAcquereurAssocie, r.eventDate, r.eventLocation FROM RelSituaTionAcq r WHERE r.acquereur_idAcquereur = ?');
		if (!$pdoStatement->execute(array($acquereur->getIdAcquereur()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les relSituaTionAcqs par acquereur depuis la base de donn�es');
		}
		return $pdoStatement;
	}
	
	/**
	 * R�cup�rer le/la acquereurAssocie
	 * @return AcquereurAssocie 
	 */
	public function getAcquereurAssocie()
	{
		// Retourner null si n�c�ssaire
		if ($this->acquereurAssocie == null) { return null; }
		
		// Charger et retourner acquereurAssocie
		return AcquereurAssocie::load($this->pdo,$this->acquereurAssocie);
	}
	
	/**
	 * D�finir le/la acquereurAssocie
	 * @param $acquereurAssocie AcquereurAssocie 
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setAcquereurAssocie($acquereurAssocie=null,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->acquereurAssocie = $acquereurAssocie == null ? null : $acquereurAssocie->getIdAcquereurAssocie();
		
		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('acquereurAssocie_idAcquereurAssocie'),array($acquereurAssocie == null ? null : $acquereurAssocie->getIdAcquereurAssocie())) : true;
	}
	
	/**
	 * S�lectionner les relSituaTionAcqs par acquereurAssocie
	 * @param $pdo PDO 
	 * @param $acquereurAssocie AcquereurAssocie 
	 * @return PDOStatement 
	 */
	public static function selectByAcquereurAssocie(PDO $pdo,AcquereurAssocie $acquereurAssocie)
	{
		$pdoStatement = $pdo->prepare('SELECT r.idRelSituaTionAcq, r.situationAcquereur_idSituationAcquereur, r.acquereur_idAcquereur, r.acquereurAssocie_idAcquereurAssocie, r.eventDate, r.eventLocation FROM RelSituaTionAcq r WHERE r.acquereurAssocie_idAcquereurAssocie = ?');
		if (!$pdoStatement->execute(array($acquereurAssocie->getIdAcquereurAssocie()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les relSituaTionAcqs par acquereurAssocie depuis la base de donn�es');
		}
		return $pdoStatement;
	}
	
	/**
	 * R�cup�rer le/la situationAcquereur
	 * @return SituationAcquereur 
	 */
	public function getSituationAcquereur()
	{
		return SituationAcquereur::load($this->pdo,$this->situationAcquereur);
	}
	
	/**
	 * D�finir le/la situationAcquereur
	 * @param $situationAcquereur SituationAcquereur 
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setSituationAcquereur(SituationAcquereur $situationAcquereur,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->situationAcquereur = $situationAcquereur->getIdSituationAcquereur();
		
		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('situationAcquereur_idSituationAcquereur'),array($situationAcquereur->getIdSituationAcquereur())) : true;
	}
	
	/**
	 * S�lectionner les relSituaTionAcqs par situationAcquereur
	 * @param $pdo PDO 
	 * @param $situationAcquereur SituationAcquereur 
	 * @return PDOStatement 
	 */
	public static function selectBySituationAcquereur(PDO $pdo,SituationAcquereur $situationAcquereur)
	{
		$pdoStatement = $pdo->prepare('SELECT r.idRelSituaTionAcq, r.situationAcquereur_idSituationAcquereur, r.acquereur_idAcquereur, r.acquereurAssocie_idAcquereurAssocie, r.eventDate, r.eventLocation FROM RelSituaTionAcq r WHERE r.situationAcquereur_idSituationAcquereur = ?');
		if (!$pdoStatement->execute(array($situationAcquereur->getIdSituationAcquereur()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les relSituaTionAcqs par situationAcquereur depuis la base de donn�es');
		}
		return $pdoStatement;
	}
	
	/**
	 * R�cup�rer le/la eventDate
	 * @return int 
	 */
	public function getEventDate()
	{
		return $this->eventDate;
	}
	
	/**
	 * D�finir le/la eventDate
	 * @param $eventDate int 
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setEventDate($eventDate=null,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->eventDate = $eventDate;
		
		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('eventDate'),array($eventDate === null ? null : date('Y-m-d H:i:s',$eventDate))) : true;
	}
	
	/**
	 * R�cup�rer le/la eventLocation
	 * @return string 
	 */
	public function getEventLocation()
	{
		return $this->eventLocation;
	}
	
	/**
	 * D�finir le/la eventLocation
	 * @param $eventLocation string 
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setEventLocation($eventLocation=null,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->eventLocation = $eventLocation;
		
		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('eventLocation'),array($eventLocation)) : true;
	}
	
	public static function countByAcquereur(PDO $pdo, Acquereur $acquereur){
		
		if (!($pdoStatement = $pdo->query('SELECT COUNT(acquereur_idAcquereur) FROM RelSituaTionAcq WHERE acquereur_idAcquereur = '.$acquereur->getIdAcquereur() ))) {
			throw new Exception('Erreur lors du comptage des acquereurs dans la base de donn�es');
		}
		return $pdoStatement->fetchColumn();
	}
	
	public static function countByAcquereurAssos(PDO $pdo, AcquereurAssocie $acquereurAssos){
	
		if (!($pdoStatement = $pdo->query('SELECT COUNT(acquereurAssocie_idAcquereurAssocie) FROM RelSituaTionAcq WHERE acquereurAssocie_idAcquereurAssocie = '.$acquereurAssos->getId() ))) {
			throw new Exception('Erreur lors du comptage des acquereurs dans la base de donn�es');
		}
		return $pdoStatement->fetchColumn();
	}
	
	
	public static function countBySituation(PDO $pdo, SituationAcquereur $situation){
	
		if (!($pdoStatement = $pdo->query('SELECT COUNT(situationAcquereur_idSituationAcquereur) FROM RelSituaTionAcq WHERE situationAcquereur_idSituationAcquereur = '.$situation->getIdSituationAcquereur() ))) {
			throw new Exception('Erreur lors du comptage des acquereurs dans la base de donn�es');
		}
		return $pdoStatement->fetchColumn();
	}
}


