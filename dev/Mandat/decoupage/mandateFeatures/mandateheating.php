<?php

/**
 * @class MandateHeating
 * @date 10/02/2011 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class MandateHeating
{
	/// @var PDO
	private $pdo;

	/// @var array tableau pour le chargement rapide
	private static $easyload;

	/// @var int
	private $idMandateHeating;

	/// @var string
	private $name;

	/// @var string
	private $code;

	/**
	 * Construire un(e) mandateHeating
	 * @param $pdo PDO
	 * @param $idMandateHeating int
	 * @param $name string
	 * @param $code string
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateHeating
	 */
	protected function __construct(PDO $pdo,$idMandateHeating,$name,$code,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;

		// Sauvegarder les attributs
		$this->idMandateHeating = $idMandateHeating;
		$this->name = $name;
		$this->code = $code;

		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			MandateHeating::$easyload[$idMandateHeating] = $this;
		}
	}

	/**
	 * Cr�er un(e) mandateHeating
	 * @param $pdo PDO
	 * @param $name string
	 * @param $code string
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateHeating
	 */
	public static function create(PDO $pdo,$name,$code,$easyload=true)
	{
		// Ajouter le/la mandateHeating dans la base de donn�es
		$pdoStatement = $pdo->prepare('INSERT INTO MandateHeating (name,code) VALUES (?,?)');
		if (!$pdoStatement->execute(array($name,$code))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) mandateHeating dans la base de donn�es');
		}

		// Construire le/la mandateHeating
		return new MandateHeating($pdo,$pdo->lastInsertId(),$name,$code,$easyload);
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
		return $pdo->prepare('SELECT m.idMandateHeating, m.name, m.code FROM MandateHeating m '.
		($where != null ? ' WHERE '.$where : '').
		($orderby != null ? ' ORDERBY '.$orderby : '').
		($limit != null ? ' LIMIT '.$limit : ''));
	}

	/**
	 * Charger un(e) mandateHeating
	 * @param $pdo PDO
	 * @param $idMandateHeating int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateHeating
	 */
	public static function load(PDO $pdo,$idMandateHeating,$easyload=true)
	{
		// D�j� charg�(e) ?
		if (isset(MandateHeating::$easyload[$idMandateHeating])) {
			return MandateHeating::$easyload[$idMandateHeating];
		}

		// Charger le/la mandateHeating
		$pdoStatement = MandateHeating::_select($pdo,'m.idMandateHeating = ?');
		if (!$pdoStatement->execute(array($idMandateHeating))) {
			throw new Exception('Erreur lors du chargement d\'un(e) mandateHeating depuis la base de donn�es');
		}

		// R�cup�rer le/la mandateHeating depuis le jeu de r�sultats
		return MandateHeating::fetch($pdo,$pdoStatement,$easyload);
	}

	/**
	 * Charger tous/toutes les mandateHeatings
	 * @param $pdo PDO
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateHeating[] tableau de mandateheatings
	 */
	public static function loadAll(PDO $pdo,$easyload=false)
	{
		// S�lectionner tous/toutes les mandateHeatings
		$pdoStatement = MandateHeating::selectAll($pdo);

		// Mettre chaque mandateHeating dans un tableau
		$mandateHeatings = array();
		while ($mandateHeating = MandateHeating::fetch($pdo,$pdoStatement,$easyload)) {
			$mandateHeatings[] = $mandateHeating;
		}

		// Retourner le tableau
		return $mandateHeatings;
	}

	/**
	 * S�lectionner tous/toutes les mandateHeatings
	 * @param $pdo PDO
	 * @return PDOStatement
	 */
	public static function selectAll(PDO $pdo)
	{
		$pdoStatement = MandateHeating::_select($pdo);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les mandateHeatings depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�re le/la mandateHeating suivant(e) d'un jeu de r�sultats
	 * @param $pdo PDO
	 * @param $pdoStatement PDOStatement
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateHeating
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idMandateHeating,$name,$code) = $values;

		// Construire le/la mandateHeating
		return isset(MandateHeating::$easyload[$idMandateHeating.'-'.$name.'-'.$code]) ? MandateHeating::$easyload[$idMandateHeating.'-'.$name.'-'.$code] :
		new MandateHeating($pdo,$idMandateHeating,$name,$code,$easyload);
	}

	/**
	 * Serialiser
	 * @param $serialize bool activer la s�rialisation ?
	 * @return string serialisation du/de la mandateheating
	 */
	public function serialize($serialize=true)
	{
		// S�rialiser le/la mandateHeating
		$array = array('idMandateHeating' => $this->idMandateHeating,'name' => $this->name,'code' => $this->code);

		// Retourner la serialisation (ou pas) du/de la mandateHeating
		return $serialize ? serialize($array) : $array;
	}

	/**
	 * D�s�rialiser
	 * @param $pdo PDO
	 * @param $string string serialisation du/de la mandateheating
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateHeating
	 */
	public static function unserialize(PDO $pdo,$string,$easyload=true)
	{
		// D�s�rialiser la chaine de caract�res
		$array = unserialize($string);

		// Construire le/la mandateHeating
		return isset(MandateHeating::$easyload[$array['idMandateHeating']]) ? MandateHeating::$easyload[$array['idMandateHeating']] :
		new MandateHeating($pdo,$array['idMandateHeating'],$array['name'],$array['code'],$easyload);
	}

	/**
	 * Test d'�galit�
	 * @param $mandateHeating MandateHeating
	 * @return bool les objets sont ils �gaux ?
	 */
	public function equals($mandateHeating)
	{
		// Test si null
		if ($mandateHeating == null) { return false; }

		// Tester la classe
		if (!($mandateHeating instanceof MandateHeating)) { return false; }

		// Tester les ids
		return $this->idMandateHeating == $mandateHeating->idMandateHeating;
	}

	/**
	 * Compter les mandateHeatings
	 * @param $pdo PDO
	 * @return int nombre de mandateheatings
	 */
	public static function count(PDO $pdo)
	{
		if (!($pdoStatement = $pdo->query('SELECT COUNT(idMandateHeating) FROM MandateHeating'))) {
			throw new Exception('Erreur lors du comptage des mandateHeatings dans la base de donn�es');
		}
		return $pdoStatement->fetchColumn();
	}

	/**
	 * Supprimer le/la mandateHeating
	 * @return bool op�ration r�ussie ?
	 */
	public function delete()
	{
		// Supprimer les mandates associ�(e)s
		$select = $this->selectMandates();
		while ($mandate = Mandate::fetch($this->pdo,$select)) {
			if (!$mandate->delete()) { return false; }
		}

		// Supprimer le/la mandateHeating
		$pdoStatement = $this->pdo->prepare('DELETE FROM MandateHeating WHERE idMandateHeating = ?');
		if (!$pdoStatement->execute(array($this->getIdMandateHeating()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) mandateHeating dans la base de donn�es');
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
		$pdoStatement = $this->pdo->prepare('UPDATE MandateHeating SET '.implode(', ', $updates).' WHERE idMandateHeating = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdMandateHeating())))) {
			throw new Exception('Erreur lors de la mise � jour d\'un champ d\'un(e) mandateHeating dans la base de donn�es');
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
	 * R�cup�rer le/la idMandateHeating
	 * @return int
	 */
	public function getIdMandateHeating()
	{
		return $this->idMandateHeating;
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
		return Mandate::selectByHeating($this->pdo,$this);
	}
	/**
	 * ToString
	 * @return string repr�sentation de mandateheating sous la forme d'un string
	 */
	public function __toString()
	{
		return '[MandateHeating idMandateHeating="'.$this->idMandateHeating.'" name="'.$this->name.'" code="'.$this->code.'"]';
	}

}

?>
