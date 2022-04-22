<?php

/**
 * @class HistoricConnection
 * @date 20/01/2011 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class HistoricConnection
{
	/// @var PDO
	private $pdo;

	/// @var array tableau pour le chargement rapide
	private static $easyload;

	/// @var int
	private $idHistoricConnection;

	/// @var int
	private $dateConnection;

	private $ip;

	/// @var int id de user
	private $user;

	/**
	 * Construire un(e) historicConnection
	 * @param $pdo PDO
	 * @param $idHistoricConnection int
	 * @param $dateConnection int
	 * @param $user int id de user
	 * @param $easyload bool activer le chargement rapide ?
	 * @return HistoricConnection
	 */
	protected function __construct(PDO $pdo,$idHistoricConnection,$dateConnection,$ip,$user,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;

		// Sauvegarder les attributs
		$this->idHistoricConnection = $idHistoricConnection;
		$this->dateConnection = $dateConnection;
		$this->user = $user;
		$this->ip = $ip;

		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			HistoricConnection::$easyload[$idHistoricConnection] = $this;
		}
	}

	/**
	 * Cr�er un(e) historicConnection
	 * @param $pdo PDO
	 * @param $dateConnection int
	 * @param $user User
	 * @param $easyload bool activer le chargement rapide ?
	 * @return HistoricConnection
	 */
	public static function create(PDO $pdo,$dateConnection,$ip,User $user,$easyload=true)
	{
		// Ajouter le/la historicConnection dans la base de donn�es
		$pdoStatement = $pdo->prepare('INSERT INTO HistoricConnection (dateConnection,ip,user_idUser) VALUES (?,?,?)');
		if (!$pdoStatement->execute(array(date('Y-m-d H:i:s',$dateConnection),$ip,$user->getIdUser()))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) historicConnection dans la base de donn�es');
		}

		// Construire le/la historicConnection
		return new HistoricConnection($pdo,$pdo->lastInsertId(),$dateConnection,$user->getIdUser(),$easyload);
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
		return $pdo->prepare('SELECT h.idHistoricConnection, h.dateConnection,h.ip, h.user_idUser FROM HistoricConnection h '.
		($where != null ? ' WHERE '.$where : '').
		($orderby != null ? ' ORDER BY '.$orderby : '').
		($limit != null ? ' LIMIT '.$limit : ''));
	}

	/**
	 * Charger un(e) historicConnection
	 * @param $pdo PDO
	 * @param $idHistoricConnection int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return HistoricConnection
	 */
	public static function load(PDO $pdo,$idHistoricConnection,$easyload=true)
	{
		// D�j� charg�(e) ?
		if (isset(HistoricConnection::$easyload[$idHistoricConnection])) {
			return HistoricConnection::$easyload[$idHistoricConnection];
		}

		// Charger le/la historicConnection
		$pdoStatement = HistoricConnection::_select($pdo,'h.idHistoricConnection = ?');
		if (!$pdoStatement->execute(array($idHistoricConnection))) {
			throw new Exception('Erreur lors du chargement d\'un(e) historicConnection depuis la base de donn�es');
		}

		// R�cup�rer le/la historicConnection depuis le jeu de r�sultats
		return HistoricConnection::fetch($pdo,$pdoStatement,$easyload);
	}

	/**
	 * Charger tous/toutes les historicConnections
	 * @param $pdo PDO
	 * @param $easyload bool activer le chargement rapide ?
	 * @return HistoricConnection[] tableau de historicconnections
	 */
	public static function loadAll(PDO $pdo,$easyload=false)
	{
		// S�lectionner tous/toutes les historicConnections
		$pdoStatement = HistoricConnection::selectAll($pdo);

		// Mettre chaque historicConnection dans un tableau
		$historicConnections = array();
		while ($historicConnection = HistoricConnection::fetch($pdo,$pdoStatement,$easyload)) {
			$historicConnections[] = $historicConnection;
		}

		// Retourner le tableau
		return $historicConnections;
	}

	/**
	 * S�lectionner tous/toutes les historicConnections
	 * @param $pdo PDO
	 * @return PDOStatement
	 */
	public static function selectAll(PDO $pdo)
	{
		$pdoStatement = HistoricConnection::_select($pdo);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les historicConnections depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�re le/la historicConnection suivant(e) d'un jeu de r�sultats
	 * @param $pdo PDO
	 * @param $pdoStatement PDOStatement
	 * @param $easyload bool activer le chargement rapide ?
	 * @return HistoricConnection
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idHistoricConnection,$dateConnection,$user) = $values;

		// Construire le/la historicConnection
		return isset(HistoricConnection::$easyload[$idHistoricConnection.'-'.strtotime($dateConnection).'-'.$user]) ? HistoricConnection::$easyload[$idHistoricConnection.'-'.strtotime($dateConnection).'-'.$user] :
		new HistoricConnection($pdo,$idHistoricConnection,strtotime($dateConnection),$user,$easyload);
	}

	/**
	 * Serialiser
	 * @param $serialize bool activer la s�rialisation ?
	 * @return string serialisation du/de la historicconnection
	 */
	public function serialize($serialize=true)
	{
		// S�rialiser le/la historicConnection
		$array = array('idHistoricConnection' => $this->idHistoricConnection,'dateConnection' => $this->dateConnection,'ip'=> $this->ip,'user' => $this->user);

		// Retourner la serialisation (ou pas) du/de la historicConnection
		return $serialize ? serialize($array) : $array;
	}

	/**
	 * D�s�rialiser
	 * @param $pdo PDO
	 * @param $string string serialisation du/de la historicconnection
	 * @param $easyload bool activer le chargement rapide ?
	 * @return HistoricConnection
	 */
	public static function unserialize(PDO $pdo,$string,$easyload=true)
	{
		// D�s�rialiser la chaine de caract�res
		$array = unserialize($string);

		// Construire le/la historicConnection
		return isset(HistoricConnection::$easyload[$array['idHistoricConnection']]) ? HistoricConnection::$easyload[$array['idHistoricConnection']] :
		new HistoricConnection($pdo,$array['idHistoricConnection'],$array['dateConnection'],$array['ip'],$array['user'],$easyload);
	}

	/**
	 * Test d'�galit�
	 * @param $historicConnection HistoricConnection
	 * @return bool les objets sont ils �gaux ?
	 */
	public function equals($historicConnection)
	{
		// Test si null
		if ($historicConnection == null) { return false; }

		// Tester la classe
		if (!($historicConnection instanceof HistoricConnection)) { return false; }

		// Tester les ids
		return $this->idHistoricConnection == $historicConnection->idHistoricConnection;
	}

	/**
	 * Compter les historicConnections
	 * @param $pdo PDO
	 * @return int nombre de historicconnections
	 */
	public static function count(PDO $pdo)
	{
		if (!($pdoStatement = $pdo->query('SELECT COUNT(idHistoricConnection) FROM HistoricConnection'))) {
			throw new Exception('Erreur lors du comptage des historicConnections dans la base de donn�es');
		}
		return $pdoStatement->fetchColumn();
	}

	/**
	 * Supprimer le/la historicConnection
	 * @return bool op�ration r�ussie ?
	 */
	public function delete()
	{
		// Supprimer le/la historicConnection
		$pdoStatement = $this->pdo->prepare('DELETE FROM HistoricConnection WHERE idHistoricConnection = ?');
		if (!$pdoStatement->execute(array($this->getIdHistoricConnection()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) historicConnection dans la base de donn�es');
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
		$pdoStatement = $this->pdo->prepare('UPDATE HistoricConnection SET '.implode(', ', $updates).' WHERE idHistoricConnection = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdHistoricConnection())))) {
			throw new Exception('Erreur lors de la mise � jour d\'un champ d\'un(e) historicConnection dans la base de donn�es');
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
		return $this->_set(array('dateConnection','user_idUser'),array(date('Y-m-d H:i:s',$this->dateConnection),$this->ip,$this->user));
	}

	/**
	 * R�cup�rer le/la idHistoricConnection
	 * @return int
	 */
	public function getIdHistoricConnection()
	{
		return $this->idHistoricConnection;
	}
	public function getId()
	{
		return $this->idHistoricConnection;
	}
	/**
	 * R�cup�rer le/la dateConnection
	 * @return int
	 */
	public function getDateConnection()
	{
		return $this->dateConnection;
	}

	/**
	 * D�finir le/la dateConnection
	 * @param $dateConnection int
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setDateConnection($dateConnection,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->dateConnection = $dateConnection;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('dateConnection'),array(date('Y-m-d H:i:s',$dateConnection))) : true;
	}

	public function getIp(){
		return $this->ip;
	}
	public function setIp($ip,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->ip = $ip;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('ip'),$ip) : true;
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
	 * S�lectionner les historicConnections par user
	 * @param $pdo PDO
	 * @param $user User
	 * @return PDOStatement
	 */
	public static function selectByUser(PDO $pdo,User $user,$cond= '')
	{
		$pdoStatement = $pdo->prepare('SELECT h.idHistoricConnection, h.dateConnection, h.ip,h.user_idUser FROM HistoricConnection h WHERE h.user_idUser = ? '.$cond);
		if (!$pdoStatement->execute(array($user->getIdUser()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les historicConnections par user depuis la base de donn�es');
		}
		return $pdoStatement;
	}



	/**
	 * ToString
	 * @return string repr�sentation de historicconnection sous la forme d'un string
	 */
	public function __toString()
	{
		return '[HistoricConnection idHistoricConnection="'.$this->idHistoricConnection.'" dateConnection="'.date('d/m/Y H:i:s',$this->dateConnection).'" user="'.$this->user.'"]';
	}

}

?>
