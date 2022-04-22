<?php

/**
 * @class MandateConstructionType
 * @date 10/02/2011 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class MandateConstructionType
{
	/// @var PDO
	private $pdo;

	/// @var array tableau pour le chargement rapide
	private static $easyload;

	/// @var int
	private $idMandateConstructionType;

	/// @var string
	private $name;

	/// @var string
	private $code;

	/**
	 * Construire un(e) mandateConstructionType
	 * @param $pdo PDO
	 * @param $idMandateConstructionType int
	 * @param $name string
	 * @param $code string
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateConstructionType
	 */
	protected function __construct(PDO $pdo,$idMandateConstructionType,$name,$code,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;

		// Sauvegarder les attributs
		$this->idMandateConstructionType = $idMandateConstructionType;
		$this->name = $name;
		$this->code = $code;

		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			MandateConstructionType::$easyload[$idMandateConstructionType] = $this;
		}
	}

	/**
	 * Cr�er un(e) mandateConstructionType
	 * @param $pdo PDO
	 * @param $name string
	 * @param $code string
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateConstructionType
	 */
	public static function create(PDO $pdo,$name,$code,$easyload=true)
	{
		// Ajouter le/la mandateConstructionType dans la base de donn�es
		$pdoStatement = $pdo->prepare('INSERT INTO MandateConstructionType (name,code) VALUES (?,?)');
		if (!$pdoStatement->execute(array($name,$code))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) mandateConstructionType dans la base de donn�es');
		}

		// Construire le/la mandateConstructionType
		return new MandateConstructionType($pdo,$pdo->lastInsertId(),$name,$code,$easyload);
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
		return $pdo->prepare('SELECT m.idMandateConstructionType, m.name, m.code FROM MandateConstructionType m '.
		($where != null ? ' WHERE '.$where : '').
		($orderby != null ? ' ORDERBY '.$orderby : '').
		($limit != null ? ' LIMIT '.$limit : ''));
	}

	/**
	 * Charger un(e) mandateConstructionType
	 * @param $pdo PDO
	 * @param $idMandateConstructionType int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateConstructionType
	 */
	public static function load(PDO $pdo,$idMandateConstructionType,$easyload=true)
	{
		// D�j� charg�(e) ?
		if (isset(MandateConstructionType::$easyload[$idMandateConstructionType])) {
			return MandateConstructionType::$easyload[$idMandateConstructionType];
		}

		// Charger le/la mandateConstructionType
		$pdoStatement = MandateConstructionType::_select($pdo,'m.idMandateConstructionType = ?');
		if (!$pdoStatement->execute(array($idMandateConstructionType))) {
			throw new Exception('Erreur lors du chargement d\'un(e) mandateConstructionType depuis la base de donn�es');
		}

		// R�cup�rer le/la mandateConstructionType depuis le jeu de r�sultats
		return MandateConstructionType::fetch($pdo,$pdoStatement,$easyload);
	}

	/**
	 * Charger tous/toutes les mandateConstructionTypes
	 * @param $pdo PDO
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateConstructionType[] tableau de mandateconstructiontypes
	 */
	public static function loadAll(PDO $pdo,$easyload=false)
	{
		// S�lectionner tous/toutes les mandateConstructionTypes
		$pdoStatement = MandateConstructionType::selectAll($pdo);

		// Mettre chaque mandateConstructionType dans un tableau
		$mandateConstructionTypes = array();
		while ($mandateConstructionType = MandateConstructionType::fetch($pdo,$pdoStatement,$easyload)) {
			$mandateConstructionTypes[] = $mandateConstructionType;
		}

		// Retourner le tableau
		return $mandateConstructionTypes;
	}

	/**
	 * S�lectionner tous/toutes les mandateConstructionTypes
	 * @param $pdo PDO
	 * @return PDOStatement
	 */
	public static function selectAll(PDO $pdo)
	{
		$pdoStatement = MandateConstructionType::_select($pdo);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les mandateConstructionTypes depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�re le/la mandateConstructionType suivant(e) d'un jeu de r�sultats
	 * @param $pdo PDO
	 * @param $pdoStatement PDOStatement
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateConstructionType
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idMandateConstructionType,$name,$code) = $values;

		// Construire le/la mandateConstructionType
		return isset(MandateConstructionType::$easyload[$idMandateConstructionType.'-'.$name.'-'.$code]) ? MandateConstructionType::$easyload[$idMandateConstructionType.'-'.$name.'-'.$code] :
		new MandateConstructionType($pdo,$idMandateConstructionType,$name,$code,$easyload);
	}

	/**
	 * Serialiser
	 * @param $serialize bool activer la s�rialisation ?
	 * @return string serialisation du/de la mandateconstructiontype
	 */
	public function serialize($serialize=true)
	{
		// S�rialiser le/la mandateConstructionType
		$array = array('idMandateConstructionType' => $this->idMandateConstructionType,'name' => $this->name,'code' => $this->code);

		// Retourner la serialisation (ou pas) du/de la mandateConstructionType
		return $serialize ? serialize($array) : $array;
	}

	/**
	 * D�s�rialiser
	 * @param $pdo PDO
	 * @param $string string serialisation du/de la mandateconstructiontype
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateConstructionType
	 */
	public static function unserialize(PDO $pdo,$string,$easyload=true)
	{
		// D�s�rialiser la chaine de caract�res
		$array = unserialize($string);

		// Construire le/la mandateConstructionType
		return isset(MandateConstructionType::$easyload[$array['idMandateConstructionType']]) ? MandateConstructionType::$easyload[$array['idMandateConstructionType']] :
		new MandateConstructionType($pdo,$array['idMandateConstructionType'],$array['name'],$array['code'],$easyload);
	}

	/**
	 * Test d'�galit�
	 * @param $mandateConstructionType MandateConstructionType
	 * @return bool les objets sont ils �gaux ?
	 */
	public function equals($mandateConstructionType)
	{
		// Test si null
		if ($mandateConstructionType == null) { return false; }

		// Tester la classe
		if (!($mandateConstructionType instanceof MandateConstructionType)) { return false; }

		// Tester les ids
		return $this->idMandateConstructionType == $mandateConstructionType->idMandateConstructionType;
	}

	/**
	 * Compter les mandateConstructionTypes
	 * @param $pdo PDO
	 * @return int nombre de mandateconstructiontypes
	 */
	public static function count(PDO $pdo)
	{
		if (!($pdoStatement = $pdo->query('SELECT COUNT(idMandateConstructionType) FROM MandateConstructionType'))) {
			throw new Exception('Erreur lors du comptage des mandateConstructionTypes dans la base de donn�es');
		}
		return $pdoStatement->fetchColumn();
	}

	/**
	 * Supprimer le/la mandateConstructionType
	 * @return bool op�ration r�ussie ?
	 */
	public function delete()
	{
		// Supprimer les mandates associ�(e)s
		$select = $this->selectMandates();
		while ($mandate = Mandate::fetch($this->pdo,$select)) {
			if (!$mandate->delete()) { return false; }
		}

		// Supprimer le/la mandateConstructionType
		$pdoStatement = $this->pdo->prepare('DELETE FROM MandateConstructionType WHERE idMandateConstructionType = ?');
		if (!$pdoStatement->execute(array($this->getIdMandateConstructionType()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) mandateConstructionType dans la base de donn�es');
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
		$pdoStatement = $this->pdo->prepare('UPDATE MandateConstructionType SET '.implode(', ', $updates).' WHERE idMandateConstructionType = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdMandateConstructionType())))) {
			throw new Exception('Erreur lors de la mise � jour d\'un champ d\'un(e) mandateConstructionType dans la base de donn�es');
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
	 * R�cup�rer le/la idMandateConstructionType
	 * @return int
	 */
	public function getIdMandateConstructionType()
	{
		return $this->idMandateConstructionType;
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
		return Mandate::selectByConstruction($this->pdo,$this);
	}
	/**
	 * ToString
	 * @return string repr�sentation de mandateconstructiontype sous la forme d'un string
	 */
	public function __toString()
	{
		return '[MandateConstructionType idMandateConstructionType="'.$this->idMandateConstructionType.'" name="'.$this->name.'" code="'.$this->code.'"]';
	}

}

?>
