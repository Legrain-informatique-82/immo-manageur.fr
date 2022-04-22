<?php

/**
 * @class Log
 * @date 20/01/2011 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class Log
{
	/// @var PDO
	private $pdo;

	/// @var array tableau pour le chargement rapide
	private static $easyload;

	/// @var int
	private $idLog;

	/// @var int
	private $dateLog;

	/// @var string
	private $pluginName;

	/// @var string
	private $log;

	/// @var int id de user
	private $user;

	/**
	 * Construire un(e) log
	 * @param $pdo PDO
	 * @param $idLog int
	 * @param $dateLog int
	 * @param $pluginName string
	 * @param $log string
	 * @param $user int id de user
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Log
	 */
	protected function __construct(PDO $pdo,$idLog,$dateLog,$pluginName,$log,$user,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;

		// Sauvegarder les attributs
		$this->idLog = $idLog;
		$this->dateLog = $dateLog;
		$this->pluginName = $pluginName;
		$this->log = $log;
		$this->user = $user;

		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			Log::$easyload[$idLog] = $this;
		}
	}

	/**
	 * Cr�er un(e) log
	 * @param $pdo PDO
	 * @param $dateLog int
	 * @param $pluginName string
	 * @param $log string
	 * @param $user User
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Log
	 */
	public static function create(PDO $pdo,$dateLog,$pluginName,$log,User $user,$easyload=true)
	{
		// Ajouter le/la log dans la base de donn�es
		$pdoStatement = $pdo->prepare('INSERT INTO Log (dateLog,pluginName,log,user_idUser) VALUES (?,?,?,?)');
		if (!$pdoStatement->execute(array(date('Y-m-d H:i:s',$dateLog),$pluginName,$log,$user->getIdUser()))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) log dans la base de donn�es');
		}

		// Construire le/la log
		return new Log($pdo,$pdo->lastInsertId(),$dateLog,$pluginName,$log,$user->getIdUser(),$easyload);
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
		return $pdo->prepare('SELECT l.idLog, l.dateLog, l.pluginName, l.log, l.user_idUser FROM Log l '.
		($where != null ? ' WHERE '.$where : '').
		($orderby != null ? ' ORDERBY '.$orderby : '').
		($limit != null ? ' LIMIT '.$limit : ''));
	}

	/**
	 * Charger un(e) log
	 * @param $pdo PDO
	 * @param $idLog int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Log
	 */
	public static function load(PDO $pdo,$idLog,$easyload=true)
	{
		// D�j� charg�(e) ?
		if (isset(Log::$easyload[$idLog])) {
			return Log::$easyload[$idLog];
		}

		// Charger le/la log
		$pdoStatement = Log::_select($pdo,'l.idLog = ?');
		if (!$pdoStatement->execute(array($idLog))) {
			throw new Exception('Erreur lors du chargement d\'un(e) log depuis la base de donn�es');
		}

		// R�cup�rer le/la log depuis le jeu de r�sultats
		return Log::fetch($pdo,$pdoStatement,$easyload);
	}

	/**
	 * Charger tous/toutes les logs
	 * @param $pdo PDO
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Log[] tableau de logs
	 */
	public static function loadAll(PDO $pdo,$easyload=false)
	{
		// S�lectionner tous/toutes les logs
		$pdoStatement = Log::selectAll($pdo);

		// Mettre chaque log dans un tableau
		$logs = array();
		while ($log = Log::fetch($pdo,$pdoStatement,$easyload)) {
			$logs[] = $log;
		}

		// Retourner le tableau
		return $logs;
	}

	/**
	 * S�lectionner tous/toutes les logs
	 * @param $pdo PDO
	 * @return PDOStatement
	 */
	public static function selectAll(PDO $pdo)
	{
		$pdoStatement = Log::_select($pdo);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les logs depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�re le/la log suivant(e) d'un jeu de r�sultats
	 * @param $pdo PDO
	 * @param $pdoStatement PDOStatement
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Log
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idLog,$dateLog,$pluginName,$log,$user) = $values;

		// Construire le/la log
		return isset(Log::$easyload[$idLog.'-'.strtotime($dateLog).'-'.$pluginName.'-'.$log.'-'.$user]) ? Log::$easyload[$idLog.'-'.strtotime($dateLog).'-'.$pluginName.'-'.$log.'-'.$user] :
		new Log($pdo,$idLog,strtotime($dateLog),$pluginName,$log,$user,$easyload);
	}

	/**
	 * Serialiser
	 * @param $serialize bool activer la s�rialisation ?
	 * @return string serialisation du/de la log
	 */
	public function serialize($serialize=true)
	{
		// S�rialiser le/la log
		$array = array('idLog' => $this->idLog,'dateLog' => $this->dateLog,'pluginName' => $this->pluginName,'log' => $this->log,'user' => $this->user);

		// Retourner la serialisation (ou pas) du/de la log
		return $serialize ? serialize($array) : $array;
	}

	/**
	 * D�s�rialiser
	 * @param $pdo PDO
	 * @param $string string serialisation du/de la log
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Log
	 */
	public static function unserialize(PDO $pdo,$string,$easyload=true)
	{
		// D�s�rialiser la chaine de caract�res
		$array = unserialize($string);

		// Construire le/la log
		return isset(Log::$easyload[$array['idLog']]) ? Log::$easyload[$array['idLog']] :
		new Log($pdo,$array['idLog'],$array['dateLog'],$array['pluginName'],$array['log'],$array['user'],$easyload);
	}

	/**
	 * Test d'�galit�
	 * @param $log Log
	 * @return bool les objets sont ils �gaux ?
	 */
	public function equals($log)
	{
		// Test si null
		if ($log == null) { return false; }

		// Tester la classe
		if (!($log instanceof Log)) { return false; }

		// Tester les ids
		return $this->idLog == $log->idLog;
	}

	/**
	 * Compter les logs
	 * @param $pdo PDO
	 * @return int nombre de logs
	 */
	public static function count(PDO $pdo)
	{
		if (!($pdoStatement = $pdo->query('SELECT COUNT(idLog) FROM Log'))) {
			throw new Exception('Erreur lors du comptage des logs dans la base de donn�es');
		}
		return $pdoStatement->fetchColumn();
	}

	/**
	 * Supprimer le/la log
	 * @return bool op�ration r�ussie ?
	 */
	public function delete()
	{
		// Supprimer le/la log
		$pdoStatement = $this->pdo->prepare('DELETE FROM Log WHERE idLog = ?');
		if (!$pdoStatement->execute(array($this->getIdLog()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) log dans la base de donn�es');
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
		$pdoStatement = $this->pdo->prepare('UPDATE Log SET '.implode(', ', $updates).' WHERE idLog = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdLog())))) {
			throw new Exception('Erreur lors de la mise � jour d\'un champ d\'un(e) log dans la base de donn�es');
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
		return $this->_set(array('dateLog','pluginName','log','user_idUser'),array(date('Y-m-d H:i:s',$this->dateLog),$this->pluginName,$this->log,$this->user));
	}

	/**
	 * R�cup�rer le/la idLog
	 * @return int
	 */
	public function getIdLog()
	{
		return $this->idLog;
	}

	/**
	 * R�cup�rer le/la dateLog
	 * @return int
	 */
	public function getDateLog()
	{
		return $this->dateLog;
	}

	/**
	 * D�finir le/la dateLog
	 * @param $dateLog int
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setDateLog($dateLog,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->dateLog = $dateLog;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('dateLog'),array(date('Y-m-d H:i:s',$dateLog))) : true;
	}

	/**
	 * R�cup�rer le/la pluginName
	 * @return string
	 */
	public function getPluginName()
	{
		return $this->pluginName;
	}

	/**
	 * D�finir le/la pluginName
	 * @param $pluginName string
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setPluginName($pluginName,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->pluginName = $pluginName;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('pluginName'),array($pluginName)) : true;
	}

	/**
	 * R�cup�rer le/la log
	 * @return string
	 */
	public function getLog()
	{
		return $this->log;
	}

	/**
	 * D�finir le/la log
	 * @param $log string
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setLog($log,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->log = $log;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('log'),array($log)) : true;
	}

	/**
	 * R�cup�rer le/la user
	 * @return User
	 */
	public function getUser()
	{
		return User::load($this->pdo,$this->user);
	}

	/**
	 * D�finir le/la user
	 * @param $user User
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setUser(User $user,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->user = $user->getIdUser();

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('user_idUser'),array($user->getIdUser())) : true;
	}

	/**
	 * S�lectionner les logs par user
	 * @param $pdo PDO
	 * @param $user User
	 * @return PDOStatement
	 */
	public static function selectByUser(PDO $pdo,User $user)
	{
		$pdoStatement = $pdo->prepare('SELECT l.idLog, l.dateLog, l.pluginName, l.log, l.user_idUser FROM Log l WHERE l.user_idUser = ?');
		if (!$pdoStatement->execute(array($user->getIdUser()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les logs par user depuis la base de donn�es');
		}
		return $pdoStatement;
	}
	/**
	 * ToString
	 * @return string repr�sentation de log sous la forme d'un string
	 */
	public function __toString()
	{
		return '[Log idLog="'.$this->idLog.'" dateLog="'.date('d/m/Y H:i:s',$this->dateLog).'" pluginName="'.$this->pluginName.'" log="'.$this->log.'" user="'.$this->user.'"]';
	}

}

?>
