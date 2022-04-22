<?php

/**
 * @class LevelMember
 * @date 20/01/2011 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class LevelMember
{
	/// @var PDO
	private $pdo;

	/// @var array tableau pour le chargement rapide
	private static $easyload;

	/// @var int
	private $idLevelMember;

	/// @var string
	private $name;

	/**
	 * Construire un(e) levelMember
	 * @param $pdo PDO
	 * @param $idLevelMember int
	 * @param $name string
	 * @param $easyload bool activer le chargement rapide ?
	 * @return LevelMember
	 */
	protected function __construct(PDO $pdo,$idLevelMember,$name,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;

		// Sauvegarder les attributs
		$this->idLevelMember = $idLevelMember;
		$this->name = $name;

		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			LevelMember::$easyload[$idLevelMember] = $this;
		}
	}

	/**
	 * Cr�er un(e) levelMember
	 * @param $pdo PDO
	 * @param $name string
	 * @param $easyload bool activer le chargement rapide ?
	 * @return LevelMember
	 */
	public static function create(PDO $pdo,$name,$easyload=true)
	{
		// Ajouter le/la levelMember dans la base de donn�es
		$pdoStatement = $pdo->prepare('INSERT INTO LevelMember (name) VALUES (?)');
		if (!$pdoStatement->execute(array($name))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) levelMember dans la base de donn�es');
		}

		// Construire le/la levelMember
		return new LevelMember($pdo,$pdo->lastInsertId(),$name,$easyload);
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
		return $pdo->prepare('SELECT l.idLevelMember, l.name FROM LevelMember l '.
		($where != null ? ' WHERE '.$where : '').
		($orderby != null ? ' ORDERBY '.$orderby : '').
		($limit != null ? ' LIMIT '.$limit : ''));
	}

	/**
	 * Charger un(e) levelMember
	 * @param $pdo PDO
	 * @param $idLevelMember int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return LevelMember
	 */
	public static function load(PDO $pdo,$idLevelMember,$easyload=true)
	{
		// D�j� charg�(e) ?
		if (isset(LevelMember::$easyload[$idLevelMember])) {
			return LevelMember::$easyload[$idLevelMember];
		}

		// Charger le/la levelMember
		$pdoStatement = LevelMember::_select($pdo,'l.idLevelMember = ?');
		if (!$pdoStatement->execute(array($idLevelMember))) {
			throw new Exception('Erreur lors du chargement d\'un(e) levelMember depuis la base de donn�es');
		}

		// R�cup�rer le/la levelMember depuis le jeu de r�sultats
		return LevelMember::fetch($pdo,$pdoStatement,$easyload);
	}

	/**
	 * Charger tous/toutes les levelMembers
	 * @param $pdo PDO
	 * @param $easyload bool activer le chargement rapide ?
	 * @return LevelMember[] tableau de levelmembers
	 */
	public static function loadAll(PDO $pdo,$easyload=false)
	{
		// S�lectionner tous/toutes les levelMembers
		$pdoStatement = LevelMember::selectAll($pdo);

		// Mettre chaque levelMember dans un tableau
		$levelMembers = array();
		while ($levelMember = LevelMember::fetch($pdo,$pdoStatement,$easyload)) {
			$levelMembers[] = $levelMember;
		}

		// Retourner le tableau
		return $levelMembers;
	}

	/**
	 * S�lectionner tous/toutes les levelMembers
	 * @param $pdo PDO
	 * @return PDOStatement
	 */
	public static function selectAll(PDO $pdo)
	{
		$pdoStatement = LevelMember::_select($pdo);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les levelMembers depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�re le/la levelMember suivant(e) d'un jeu de r�sultats
	 * @param $pdo PDO
	 * @param $pdoStatement PDOStatement
	 * @param $easyload bool activer le chargement rapide ?
	 * @return LevelMember
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idLevelMember,$name) = $values;

		// Construire le/la levelMember
		return isset(LevelMember::$easyload[$idLevelMember.'-'.$name]) ? LevelMember::$easyload[$idLevelMember.'-'.$name] :
		new LevelMember($pdo,$idLevelMember,$name,$easyload);
	}

	/**
	 * Serialiser
	 * @param $serialize bool activer la s�rialisation ?
	 * @return string serialisation du/de la levelmember
	 */
	public function serialize($serialize=true)
	{
		// S�rialiser le/la levelMember
		$array = array('idLevelMember' => $this->idLevelMember,'name' => $this->name);

		// Retourner la serialisation (ou pas) du/de la levelMember
		return $serialize ? serialize($array) : $array;
	}

	/**
	 * D�s�rialiser
	 * @param $pdo PDO
	 * @param $string string serialisation du/de la levelmember
	 * @param $easyload bool activer le chargement rapide ?
	 * @return LevelMember
	 */
	public static function unserialize(PDO $pdo,$string,$easyload=true)
	{
		// D�s�rialiser la chaine de caract�res
		$array = unserialize($string);

		// Construire le/la levelMember
		return isset(LevelMember::$easyload[$array['idLevelMember']]) ? LevelMember::$easyload[$array['idLevelMember']] :
		new LevelMember($pdo,$array['idLevelMember'],$array['name'],$easyload);
	}

	/**
	 * Test d'�galit�
	 * @param $levelMember LevelMember
	 * @return bool les objets sont ils �gaux ?
	 */
	public function equals($levelMember)
	{
		// Test si null
		if ($levelMember == null) { return false; }

		// Tester la classe
		if (!($levelMember instanceof LevelMember)) { return false; }

		// Tester les ids
		return $this->idLevelMember == $levelMember->idLevelMember;
	}

	/**
	 * Compter les levelMembers
	 * @param $pdo PDO
	 * @return int nombre de levelmembers
	 */
	public static function count(PDO $pdo)
	{
		if (!($pdoStatement = $pdo->query('SELECT COUNT(idLevelMember) FROM LevelMember'))) {
			throw new Exception('Erreur lors du comptage des levelMembers dans la base de donn�es');
		}
		return $pdoStatement->fetchColumn();
	}

	/**
	 * Supprimer le/la levelMember
	 * @return bool op�ration r�ussie ?
	 */
	public function delete()
	{
		// Supprimer les Users associ�(e)s
		$select = $this->selectUsers();
		while ($user = User::fetch($this->pdo,$select)) {
			if (!$user->delete()) { return false; }
		}

		// Supprimer le/la levelMember
		$pdoStatement = $this->pdo->prepare('DELETE FROM LevelMember WHERE idLevelMember = ?');
		if (!$pdoStatement->execute(array($this->getIdLevelMember()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) levelMember dans la base de donn�es');
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
		$pdoStatement = $this->pdo->prepare('UPDATE LevelMember SET '.implode(', ', $updates).' WHERE idLevelMember = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdLevelMember())))) {
			throw new Exception('Erreur lors de la mise � jour d\'un champ d\'un(e) levelMember dans la base de donn�es');
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
	 * R�cup�rer le/la idLevelMember
	 * @return int
	 */
	public function getIdLevelMember()
	{
		return $this->idLevelMember;
	}
	public function getId()
	{
		return $this->idLevelMember;
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
	 * S�lectionner les users
	 * @return PDOStatement
	 */
	public function selectUsers()
	{
		return User::selectByLevelMember($this->pdo,$this);
	}
	/**
	 * ToString
	 * @return string repr�sentation de levelmember sous la forme d'un string
	 */
	public function __toString()
	{
		return '[LevelMember idLevelMember="'.$this->idLevelMember.'" name="'.$this->name.'"]';
	}

}

?>
