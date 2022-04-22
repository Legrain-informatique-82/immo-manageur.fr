<?php

/**
 * @class User
 * @date 30/03/2011 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class User
{
	/// @var PDO
	private $pdo;

	/// @var array tableau pour le chargement rapide
	private static $easyload;

	/// @var int
	private $idUser;

	/// @var int
	private $n;

	/**
	 * Construire un(e) user
	 * @param $pdo PDO
	 * @param $idUser int
	 * @param $n int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return User
	 */
	protected function __construct(PDO $pdo,$idUser,$n,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;

		// Sauvegarder les attributs
		$this->idUser = $idUser;
		$this->n = $n;

		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			User::$easyload[$idUser] = $this;
		}
	}

	/**
	 * Cr�er un(e) user
	 * @param $pdo PDO
	 * @param $n int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return User
	 */
	public static function create(PDO $pdo,$n,$easyload=true)
	{
		// Ajouter le/la user dans la base de donn�es
		$pdoStatement = $pdo->prepare('INSERT INTO User (n) VALUES (?)');
		if (!$pdoStatement->execute(array($n))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) user dans la base de donn�es');
		}

		// Construire le/la user
		return new User($pdo,$pdo->lastInsertId(),$n,$easyload);
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
		return $pdo->prepare('SELECT u.idUser, u.n FROM User u '.
		($where != null ? ' WHERE '.$where : '').
		($orderby != null ? ' ORDERBY '.$orderby : '').
		($limit != null ? ' LIMIT '.$limit : ''));
	}

	/**
	 * Charger un(e) user
	 * @param $pdo PDO
	 * @param $idUser int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return User
	 */
	public static function load(PDO $pdo,$idUser,$easyload=true)
	{
		// D�j� charg�(e) ?
		if (isset(User::$easyload[$idUser])) {
			return User::$easyload[$idUser];
		}

		// Charger le/la user
		$pdoStatement = User::_select($pdo,'u.idUser = ?');
		if (!$pdoStatement->execute(array($idUser))) {
			throw new Exception('Erreur lors du chargement d\'un(e) user depuis la base de donn�es');
		}

		// R�cup�rer le/la user depuis le jeu de r�sultats
		return User::fetch($pdo,$pdoStatement,$easyload);
	}

	/**
	 * Charger tous/toutes les users
	 * @param $pdo PDO
	 * @param $easyload bool activer le chargement rapide ?
	 * @return User[] tableau de users
	 */
	public static function loadAll(PDO $pdo,$easyload=false)
	{
		// S�lectionner tous/toutes les users
		$pdoStatement = User::selectAll($pdo);

		// Mettre chaque user dans un tableau
		$users = array();
		while ($user = User::fetch($pdo,$pdoStatement,$easyload)) {
			$users[] = $user;
		}

		// Retourner le tableau
		return $users;
	}

	/**
	 * S�lectionner tous/toutes les users
	 * @param $pdo PDO
	 * @return PDOStatement
	 */
	public static function selectAll(PDO $pdo)
	{
		$pdoStatement = User::_select($pdo);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les users depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�re le/la user suivant(e) d'un jeu de r�sultats
	 * @param $pdo PDO
	 * @param $pdoStatement PDOStatement
	 * @param $easyload bool activer le chargement rapide ?
	 * @return User
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idUser,$n) = $values;

		// Construire le/la user
		return isset(User::$easyload[$idUser.'-'.$n]) ? User::$easyload[$idUser.'-'.$n] :
		new User($pdo,$idUser,$n,$easyload);
	}

	/**
	 * Supprimer le/la user
	 * @return bool op�ration r�ussie ?
	 */
	public function delete()
	{
		// Supprimer les Rapprochements associ�(e)s
		$select = $this->selectRapprochements();
		while ($rapprochement = Rapprochement::fetch($this->pdo,$select)) {
			if (!$rapprochement->delete()) { return false; }
		}

		// Supprimer le/la user
		$pdoStatement = $this->pdo->prepare('DELETE FROM User WHERE idUser = ?');
		if (!$pdoStatement->execute(array($this->getIdUser()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) user dans la base de donn�es');
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
		$pdoStatement = $this->pdo->prepare('UPDATE User SET '.implode(', ', $updates).' WHERE idUser = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdUser())))) {
			throw new Exception('Erreur lors de la mise � jour d\'un champ d\'un(e) user dans la base de donn�es');
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
		return $this->_set(array('n'),array($this->n));
	}

	/**
	 * R�cup�rer le/la idUser
	 * @return int
	 */
	public function getIdUser()
	{
		return $this->idUser;
	}

	/**
	 * R�cup�rer le/la n
	 * @return int
	 */
	public function getN()
	{
		return $this->n;
	}

	/**
	 * D�finir le/la n
	 * @param $n int
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setN($n,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->n = $n;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('n'),array($n)) : true;
	}

	/**
	 * S�lectionner les rapprochements
	 * @return PDOStatement
	 */
	public function selectRapprochements()
	{
		return Rapprochement::selectByUser($this->pdo,$this);
	}
}

?>
