<?php

/**
 * @class MandateCondition
 * @date 10/02/2011 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class MandateCondition
{
	/// @var PDO
	private $pdo;

	/// @var array tableau pour le chargement rapide
	private static $easyload;

	/// @var int
	private $idMandateCondition;

	/// @var string
	private $name;

	/// @var string
	private $code;

	/**
	 * Construire un(e) mandateCondition
	 * @param $pdo PDO
	 * @param $idMandateCondition int
	 * @param $name string
	 * @param $code string
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateCondition
	 */
	protected function __construct(PDO $pdo,$idMandateCondition,$name,$code,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;

		// Sauvegarder les attributs
		$this->idMandateCondition = $idMandateCondition;
		$this->name = $name;
		$this->code = $code;

		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			MandateCondition::$easyload[$idMandateCondition] = $this;
		}
	}

	/**
	 * Cr�er un(e) mandateCondition
	 * @param $pdo PDO
	 * @param $name string
	 * @param $code string
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateCondition
	 */
	public static function create(PDO $pdo,$name,$code,$easyload=true)
	{
		// Ajouter le/la mandateCondition dans la base de donn�es
		$pdoStatement = $pdo->prepare('INSERT INTO MandateCondition (name,code) VALUES (?,?)');
		if (!$pdoStatement->execute(array($name,$code))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) mandateCondition dans la base de donn�es');
		}

		// Construire le/la mandateCondition
		return new MandateCondition($pdo,$pdo->lastInsertId(),$name,$code,$easyload);
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
		return $pdo->prepare('SELECT m.idMandateCondition, m.name, m.code FROM MandateCondition m '.
		($where != null ? ' WHERE '.$where : '').
		($orderby != null ? ' ORDERBY '.$orderby : '').
		($limit != null ? ' LIMIT '.$limit : ''));
	}

	/**
	 * Charger un(e) mandateCondition
	 * @param $pdo PDO
	 * @param $idMandateCondition int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateCondition
	 */
	public static function load(PDO $pdo,$idMandateCondition,$easyload=true)
	{
		// D�j� charg�(e) ?
		if (isset(MandateCondition::$easyload[$idMandateCondition])) {
			return MandateCondition::$easyload[$idMandateCondition];
		}

		// Charger le/la mandateCondition
		$pdoStatement = MandateCondition::_select($pdo,'m.idMandateCondition = ?');
		if (!$pdoStatement->execute(array($idMandateCondition))) {
			throw new Exception('Erreur lors du chargement d\'un(e) mandateCondition depuis la base de donn�es');
		}

		// R�cup�rer le/la mandateCondition depuis le jeu de r�sultats
		return MandateCondition::fetch($pdo,$pdoStatement,$easyload);
	}

	/**
	 * Charger tous/toutes les mandateConditions
	 * @param $pdo PDO
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateCondition[] tableau de mandateconditions
	 */
	public static function loadAll(PDO $pdo,$easyload=false)
	{
		// S�lectionner tous/toutes les mandateConditions
		$pdoStatement = MandateCondition::selectAll($pdo);

		// Mettre chaque mandateCondition dans un tableau
		$mandateConditions = array();
		while ($mandateCondition = MandateCondition::fetch($pdo,$pdoStatement,$easyload)) {
			$mandateConditions[] = $mandateCondition;
		}

		// Retourner le tableau
		return $mandateConditions;
	}

	/**
	 * S�lectionner tous/toutes les mandateConditions
	 * @param $pdo PDO
	 * @return PDOStatement
	 */
	public static function selectAll(PDO $pdo)
	{
		$pdoStatement = MandateCondition::_select($pdo);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les mandateConditions depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�re le/la mandateCondition suivant(e) d'un jeu de r�sultats
	 * @param $pdo PDO
	 * @param $pdoStatement PDOStatement
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateCondition
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idMandateCondition,$name,$code) = $values;

		// Construire le/la mandateCondition
		return isset(MandateCondition::$easyload[$idMandateCondition.'-'.$name.'-'.$code]) ? MandateCondition::$easyload[$idMandateCondition.'-'.$name.'-'.$code] :
		new MandateCondition($pdo,$idMandateCondition,$name,$code,$easyload);
	}

	/**
	 * Serialiser
	 * @param $serialize bool activer la s�rialisation ?
	 * @return string serialisation du/de la mandatecondition
	 */
	public function serialize($serialize=true)
	{
		// S�rialiser le/la mandateCondition
		$array = array('idMandateCondition' => $this->idMandateCondition,'name' => $this->name,'code' => $this->code);

		// Retourner la serialisation (ou pas) du/de la mandateCondition
		return $serialize ? serialize($array) : $array;
	}

	/**
	 * D�s�rialiser
	 * @param $pdo PDO
	 * @param $string string serialisation du/de la mandatecondition
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateCondition
	 */
	public static function unserialize(PDO $pdo,$string,$easyload=true)
	{
		// D�s�rialiser la chaine de caract�res
		$array = unserialize($string);

		// Construire le/la mandateCondition
		return isset(MandateCondition::$easyload[$array['idMandateCondition']]) ? MandateCondition::$easyload[$array['idMandateCondition']] :
		new MandateCondition($pdo,$array['idMandateCondition'],$array['name'],$array['code'],$easyload);
	}

	/**
	 * Test d'�galit�
	 * @param $mandateCondition MandateCondition
	 * @return bool les objets sont ils �gaux ?
	 */
	public function equals($mandateCondition)
	{
		// Test si null
		if ($mandateCondition == null) { return false; }

		// Tester la classe
		if (!($mandateCondition instanceof MandateCondition)) { return false; }

		// Tester les ids
		return $this->idMandateCondition == $mandateCondition->idMandateCondition;
	}

	/**
	 * Compter les mandateConditions
	 * @param $pdo PDO
	 * @return int nombre de mandateconditions
	 */
	public static function count(PDO $pdo)
	{
		if (!($pdoStatement = $pdo->query('SELECT COUNT(idMandateCondition) FROM MandateCondition'))) {
			throw new Exception('Erreur lors du comptage des mandateConditions dans la base de donn�es');
		}
		return $pdoStatement->fetchColumn();
	}

	/**
	 * Supprimer le/la mandateCondition
	 * @return bool op�ration r�ussie ?
	 */
	public function delete()
	{
		// Supprimer les mandates associ�(e)s
		$select = $this->selectMandates();
		while ($mandate = Mandate::fetch($this->pdo,$select)) {
			if (!$mandate->delete()) { return false; }
		}

		// Supprimer le/la mandateCondition
		$pdoStatement = $this->pdo->prepare('DELETE FROM MandateCondition WHERE idMandateCondition = ?');
		if (!$pdoStatement->execute(array($this->getIdMandateCondition()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) mandateCondition dans la base de donn�es');
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
		$pdoStatement = $this->pdo->prepare('UPDATE MandateCondition SET '.implode(', ', $updates).' WHERE idMandateCondition = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdMandateCondition())))) {
			throw new Exception('Erreur lors de la mise � jour d\'un champ d\'un(e) mandateCondition dans la base de donn�es');
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
		return $this->_set(array('name','code'),array($this->name,$this->code));
	}

	/**
	 * R�cup�rer le/la idMandateCondition
	 * @return int
	 */
	public function getIdMandateCondition()
	{
		return $this->idMandateCondition;
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
	 * R�cup�rer le/la code
	 * @return string
	 */
	public function getCode()
	{
		return $this->code;
	}

	/**
	 * D�finir le/la code
	 * @param $code string
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setCode($code,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->code = $code;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('code'),array($code)) : true;
	}

	/**
	 * S�lectionner les mandates
	 * @return PDOStatement
	 */
	public function selectMandates()
	{
		return Mandate::selectByCondition($this->pdo,$this);
	}
	/**
	 * ToString
	 * @return string repr�sentation de mandatecondition sous la forme d'un string
	 */
	public function __toString()
	{
		return '[MandateCondition idMandateCondition="'.$this->idMandateCondition.'" name="'.$this->name.'" code="'.$this->code.'"]';
	}

}

?>
