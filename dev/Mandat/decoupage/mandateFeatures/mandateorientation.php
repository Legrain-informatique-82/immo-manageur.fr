<?php

/**
 * @class MandateOrientation
 * @date 10/02/2011 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class MandateOrientation
{
	/// @var PDO
	private $pdo;

	/// @var array tableau pour le chargement rapide
	private static $easyload;

	/// @var int
	private $idMandateOrientation;

	/// @var string
	private $name;

	/// @var string
	private $code;

	/**
	 * Construire un(e) mandateOrientation
	 * @param $pdo PDO
	 * @param $idMandateOrientation int
	 * @param $name string
	 * @param $code string
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateOrientation
	 */
	protected function __construct(PDO $pdo,$idMandateOrientation,$name,$code,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;

		// Sauvegarder les attributs
		$this->idMandateOrientation = $idMandateOrientation;
		$this->name = $name;
		$this->code = $code;

		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			MandateOrientation::$easyload[$idMandateOrientation] = $this;
		}
	}

	/**
	 * Cr�er un(e) mandateOrientation
	 * @param $pdo PDO
	 * @param $name string
	 * @param $code string
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateOrientation
	 */
	public static function create(PDO $pdo,$name,$code,$easyload=true)
	{
		// Ajouter le/la mandateOrientation dans la base de donn�es
		$pdoStatement = $pdo->prepare('INSERT INTO MandateOrientation (name,code) VALUES (?,?)');
		if (!$pdoStatement->execute(array($name,$code))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) mandateOrientation dans la base de donn�es');
		}

		// Construire le/la mandateOrientation
		return new MandateOrientation($pdo,$pdo->lastInsertId(),$name,$code,$easyload);
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
		return $pdo->prepare('SELECT m.idMandateOrientation, m.name, m.code FROM MandateOrientation m '.
		($where != null ? ' WHERE '.$where : '').
		($orderby != null ? ' ORDERBY '.$orderby : '').
		($limit != null ? ' LIMIT '.$limit : ''));
	}

	/**
	 * Charger un(e) mandateOrientation
	 * @param $pdo PDO
	 * @param $idMandateOrientation int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateOrientation
	 */
	public static function load(PDO $pdo,$idMandateOrientation,$easyload=true)
	{
		// D�j� charg�(e) ?
		if (isset(MandateOrientation::$easyload[$idMandateOrientation])) {
			return MandateOrientation::$easyload[$idMandateOrientation];
		}

		// Charger le/la mandateOrientation
		$pdoStatement = MandateOrientation::_select($pdo,'m.idMandateOrientation = ?');
		if (!$pdoStatement->execute(array($idMandateOrientation))) {
			throw new Exception('Erreur lors du chargement d\'un(e) mandateOrientation depuis la base de donn�es');
		}

		// R�cup�rer le/la mandateOrientation depuis le jeu de r�sultats
		return MandateOrientation::fetch($pdo,$pdoStatement,$easyload);
	}

	/**
	 * Charger tous/toutes les mandateOrientations
	 * @param $pdo PDO
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateOrientation[] tableau de mandateorientations
	 */
	public static function loadAll(PDO $pdo,$easyload=false)
	{
		// S�lectionner tous/toutes les mandateOrientations
		$pdoStatement = MandateOrientation::selectAll($pdo);

		// Mettre chaque mandateOrientation dans un tableau
		$mandateOrientations = array();
		while ($mandateOrientation = MandateOrientation::fetch($pdo,$pdoStatement,$easyload)) {
			$mandateOrientations[] = $mandateOrientation;
		}

		// Retourner le tableau
		return $mandateOrientations;
	}

	/**
	 * S�lectionner tous/toutes les mandateOrientations
	 * @param $pdo PDO
	 * @return PDOStatement
	 */
	public static function selectAll(PDO $pdo)
	{
		$pdoStatement = MandateOrientation::_select($pdo);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les mandateOrientations depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�re le/la mandateOrientation suivant(e) d'un jeu de r�sultats
	 * @param $pdo PDO
	 * @param $pdoStatement PDOStatement
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateOrientation
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idMandateOrientation,$name,$code) = $values;

		// Construire le/la mandateOrientation
		return isset(MandateOrientation::$easyload[$idMandateOrientation.'-'.$name.'-'.$code]) ? MandateOrientation::$easyload[$idMandateOrientation.'-'.$name.'-'.$code] :
		new MandateOrientation($pdo,$idMandateOrientation,$name,$code,$easyload);
	}

	/**
	 * Serialiser
	 * @param $serialize bool activer la s�rialisation ?
	 * @return string serialisation du/de la mandateorientation
	 */
	public function serialize($serialize=true)
	{
		// S�rialiser le/la mandateOrientation
		$array = array('idMandateOrientation' => $this->idMandateOrientation,'name' => $this->name,'code' => $this->code);

		// Retourner la serialisation (ou pas) du/de la mandateOrientation
		return $serialize ? serialize($array) : $array;
	}

	/**
	 * D�s�rialiser
	 * @param $pdo PDO
	 * @param $string string serialisation du/de la mandateorientation
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateOrientation
	 */
	public static function unserialize(PDO $pdo,$string,$easyload=true)
	{
		// D�s�rialiser la chaine de caract�res
		$array = unserialize($string);

		// Construire le/la mandateOrientation
		return isset(MandateOrientation::$easyload[$array['idMandateOrientation']]) ? MandateOrientation::$easyload[$array['idMandateOrientation']] :
		new MandateOrientation($pdo,$array['idMandateOrientation'],$array['name'],$array['code'],$easyload);
	}

	/**
	 * Test d'�galit�
	 * @param $mandateOrientation MandateOrientation
	 * @return bool les objets sont ils �gaux ?
	 */
	public function equals($mandateOrientation)
	{
		// Test si null
		if ($mandateOrientation == null) { return false; }

		// Tester la classe
		if (!($mandateOrientation instanceof MandateOrientation)) { return false; }

		// Tester les ids
		return $this->idMandateOrientation == $mandateOrientation->idMandateOrientation;
	}

	/**
	 * Compter les mandateOrientations
	 * @param $pdo PDO
	 * @return int nombre de mandateorientations
	 */
	public static function count(PDO $pdo)
	{
		if (!($pdoStatement = $pdo->query('SELECT COUNT(idMandateOrientation) FROM MandateOrientation'))) {
			throw new Exception('Erreur lors du comptage des mandateOrientations dans la base de donn�es');
		}
		return $pdoStatement->fetchColumn();
	}

	/**
	 * Supprimer le/la mandateOrientation
	 * @return bool op�ration r�ussie ?
	 */
	public function delete()
	{
		// Supprimer les mandates associ�(e)s
		$select = $this->selectMandates();
		while ($mandate = Mandate::fetch($this->pdo,$select)) {
			if (!$mandate->delete()) { return false; }
		}

		// Supprimer le/la mandateOrientation
		$pdoStatement = $this->pdo->prepare('DELETE FROM MandateOrientation WHERE idMandateOrientation = ?');
		if (!$pdoStatement->execute(array($this->getIdMandateOrientation()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) mandateOrientation dans la base de donn�es');
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
		$pdoStatement = $this->pdo->prepare('UPDATE MandateOrientation SET '.implode(', ', $updates).' WHERE idMandateOrientation = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdMandateOrientation())))) {
			throw new Exception('Erreur lors de la mise � jour d\'un champ d\'un(e) mandateOrientation dans la base de donn�es');
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
	 * R�cup�rer le/la idMandateOrientation
	 * @return int
	 */
	public function getIdMandateOrientation()
	{
		return $this->idMandateOrientation;
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
		return Mandate::selectByOrientation($this->pdo,$this);
	}
	/**
	 * ToString
	 * @return string repr�sentation de mandateorientation sous la forme d'un string
	 */
	public function __toString()
	{
		return '[MandateOrientation idMandateOrientation="'.$this->idMandateOrientation.'" name="'.$this->name.'" code="'.$this->code.'"]';
	}

}

?>
