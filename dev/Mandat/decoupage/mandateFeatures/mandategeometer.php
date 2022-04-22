<?php

/**
 * @class MandateGeometer
 * @date 10/02/2011 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class MandateGeometer
{
	/// @var PDO
	private $pdo;

	/// @var array tableau pour le chargement rapide
	private static $easyload;

	/// @var int
	private $idMandateGeometer;

	/// @var string
	private $name;

	/// @var string
	private $code;

	/**
	 * Construire un(e) mandateGeometer
	 * @param $pdo PDO
	 * @param $idMandateGeometer int
	 * @param $name string
	 * @param $code string
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateGeometer
	 */
	protected function __construct(PDO $pdo,$idMandateGeometer,$name,$code,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;

		// Sauvegarder les attributs
		$this->idMandateGeometer = $idMandateGeometer;
		$this->name = $name;
		$this->code = $code;

		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			MandateGeometer::$easyload[$idMandateGeometer] = $this;
		}
	}

	/**
	 * Cr�er un(e) mandateGeometer
	 * @param $pdo PDO
	 * @param $name string
	 * @param $code string
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateGeometer
	 */
	public static function create(PDO $pdo,$name,$code,$easyload=true)
	{
		// Ajouter le/la mandateGeometer dans la base de donn�es
		$pdoStatement = $pdo->prepare('INSERT INTO MandateGeometer (name,code) VALUES (?,?)');
		if (!$pdoStatement->execute(array($name,$code))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) mandateGeometer dans la base de donn�es');
		}

		// Construire le/la mandateGeometer
		return new MandateGeometer($pdo,$pdo->lastInsertId(),$name,$code,$easyload);
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
		return $pdo->prepare('SELECT m.idMandateGeometer, m.name, m.code FROM MandateGeometer m '.
		($where != null ? ' WHERE '.$where : '').
		($orderby != null ? ' ORDERBY '.$orderby : '').
		($limit != null ? ' LIMIT '.$limit : ''));
	}

	/**
	 * Charger un(e) mandateGeometer
	 * @param $pdo PDO
	 * @param $idMandateGeometer int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateGeometer
	 */
	public static function load(PDO $pdo,$idMandateGeometer,$easyload=true)
	{
		// D�j� charg�(e) ?
		if (isset(MandateGeometer::$easyload[$idMandateGeometer])) {
			return MandateGeometer::$easyload[$idMandateGeometer];
		}

		// Charger le/la mandateGeometer
		$pdoStatement = MandateGeometer::_select($pdo,'m.idMandateGeometer = ?');
		if (!$pdoStatement->execute(array($idMandateGeometer))) {
			throw new Exception('Erreur lors du chargement d\'un(e) mandateGeometer depuis la base de donn�es');
		}

		// R�cup�rer le/la mandateGeometer depuis le jeu de r�sultats
		return MandateGeometer::fetch($pdo,$pdoStatement,$easyload);
	}

	/**
	 * Charger tous/toutes les mandateGeometers
	 * @param $pdo PDO
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateGeometer[] tableau de mandategeometers
	 */
	public static function loadAll(PDO $pdo,$easyload=false)
	{
		// S�lectionner tous/toutes les mandateGeometers
		$pdoStatement = MandateGeometer::selectAll($pdo);

		// Mettre chaque mandateGeometer dans un tableau
		$mandateGeometers = array();
		while ($mandateGeometer = MandateGeometer::fetch($pdo,$pdoStatement,$easyload)) {
			$mandateGeometers[] = $mandateGeometer;
		}

		// Retourner le tableau
		return $mandateGeometers;
	}

	/**
	 * S�lectionner tous/toutes les mandateGeometers
	 * @param $pdo PDO
	 * @return PDOStatement
	 */
	public static function selectAll(PDO $pdo)
	{
		$pdoStatement = MandateGeometer::_select($pdo);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les mandateGeometers depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�re le/la mandateGeometer suivant(e) d'un jeu de r�sultats
	 * @param $pdo PDO
	 * @param $pdoStatement PDOStatement
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateGeometer
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idMandateGeometer,$name,$code) = $values;

		// Construire le/la mandateGeometer
		return isset(MandateGeometer::$easyload[$idMandateGeometer.'-'.$name.'-'.$code]) ? MandateGeometer::$easyload[$idMandateGeometer.'-'.$name.'-'.$code] :
		new MandateGeometer($pdo,$idMandateGeometer,$name,$code,$easyload);
	}

	/**
	 * Serialiser
	 * @param $serialize bool activer la s�rialisation ?
	 * @return string serialisation du/de la mandategeometer
	 */
	public function serialize($serialize=true)
	{
		// S�rialiser le/la mandateGeometer
		$array = array('idMandateGeometer' => $this->idMandateGeometer,'name' => $this->name,'code' => $this->code);

		// Retourner la serialisation (ou pas) du/de la mandateGeometer
		return $serialize ? serialize($array) : $array;
	}

	/**
	 * D�s�rialiser
	 * @param $pdo PDO
	 * @param $string string serialisation du/de la mandategeometer
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateGeometer
	 */
	public static function unserialize(PDO $pdo,$string,$easyload=true)
	{
		// D�s�rialiser la chaine de caract�res
		$array = unserialize($string);

		// Construire le/la mandateGeometer
		return isset(MandateGeometer::$easyload[$array['idMandateGeometer']]) ? MandateGeometer::$easyload[$array['idMandateGeometer']] :
		new MandateGeometer($pdo,$array['idMandateGeometer'],$array['name'],$array['code'],$easyload);
	}

	/**
	 * Test d'�galit�
	 * @param $mandateGeometer MandateGeometer
	 * @return bool les objets sont ils �gaux ?
	 */
	public function equals($mandateGeometer)
	{
		// Test si null
		if ($mandateGeometer == null) { return false; }

		// Tester la classe
		if (!($mandateGeometer instanceof MandateGeometer)) { return false; }

		// Tester les ids
		return $this->idMandateGeometer == $mandateGeometer->idMandateGeometer;
	}

	/**
	 * Compter les mandateGeometers
	 * @param $pdo PDO
	 * @return int nombre de mandategeometers
	 */
	public static function count(PDO $pdo)
	{
		if (!($pdoStatement = $pdo->query('SELECT COUNT(idMandateGeometer) FROM MandateGeometer'))) {
			throw new Exception('Erreur lors du comptage des mandateGeometers dans la base de donn�es');
		}
		return $pdoStatement->fetchColumn();
	}

	/**
	 * Supprimer le/la mandateGeometer
	 * @return bool op�ration r�ussie ?
	 */
	public function delete()
	{
		// Supprimer les mandates associ�(e)s
		$select = $this->selectMandates();
		while ($mandate = Mandate::fetch($this->pdo,$select)) {
			if (!$mandate->delete()) { return false; }
		}

		// Supprimer le/la mandateGeometer
		$pdoStatement = $this->pdo->prepare('DELETE FROM MandateGeometer WHERE idMandateGeometer = ?');
		if (!$pdoStatement->execute(array($this->getIdMandateGeometer()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) mandateGeometer dans la base de donn�es');
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
		$pdoStatement = $this->pdo->prepare('UPDATE MandateGeometer SET '.implode(', ', $updates).' WHERE idMandateGeometer = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdMandateGeometer())))) {
			throw new Exception('Erreur lors de la mise � jour d\'un champ d\'un(e) mandateGeometer dans la base de donn�es');
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
	 * R�cup�rer le/la idMandateGeometer
	 * @return int
	 */
	public function getIdMandateGeometer()
	{
		return $this->idMandateGeometer;
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
		return Mandate::selectByGeometer($this->pdo,$this);
	}
	/**
	 * ToString
	 * @return string repr�sentation de mandategeometer sous la forme d'un string
	 */
	public function __toString()
	{
		return '[MandateGeometer idMandateGeometer="'.$this->idMandateGeometer.'" name="'.$this->name.'" code="'.$this->code.'"]';
	}

}

?>
