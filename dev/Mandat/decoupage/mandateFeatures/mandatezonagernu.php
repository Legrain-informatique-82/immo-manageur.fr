<?php

/**
 * @class MandateZonageRNU
 * @date 10/02/2011 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class MandateZonageRNU
{
	/// @var PDO
	private $pdo;

	/// @var array tableau pour le chargement rapide
	private static $easyload;

	/// @var int
	private $idMandateZonageRNU;

	/// @var string
	private $name;

	/// @var string
	private $code;

	/**
	 * Construire un(e) mandateZonageRNU
	 * @param $pdo PDO
	 * @param $idMandateZonageRNU int
	 * @param $name string
	 * @param $code string
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateZonageRNU
	 */
	protected function __construct(PDO $pdo,$idMandateZonageRNU,$name,$code,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;

		// Sauvegarder les attributs
		$this->idMandateZonageRNU = $idMandateZonageRNU;
		$this->name = $name;
		$this->code = $code;

		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			MandateZonageRNU::$easyload[$idMandateZonageRNU] = $this;
		}
	}

	/**
	 * Cr�er un(e) mandateZonageRNU
	 * @param $pdo PDO
	 * @param $name string
	 * @param $code string
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateZonageRNU
	 */
	public static function create(PDO $pdo,$name,$code,$easyload=true)
	{
		// Ajouter le/la mandateZonageRNU dans la base de donn�es
		$pdoStatement = $pdo->prepare('INSERT INTO MandateZonageRNU (name,code) VALUES (?,?)');
		if (!$pdoStatement->execute(array($name,$code))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) mandateZonageRNU dans la base de donn�es');
		}

		// Construire le/la mandateZonageRNU
		return new MandateZonageRNU($pdo,$pdo->lastInsertId(),$name,$code,$easyload);
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
		return $pdo->prepare('SELECT m.idMandateZonageRNU, m.name, m.code FROM MandateZonageRNU m '.
		($where != null ? ' WHERE '.$where : '').
		($orderby != null ? ' ORDERBY '.$orderby : '').
		($limit != null ? ' LIMIT '.$limit : ''));
	}

	/**
	 * Charger un(e) mandateZonageRNU
	 * @param $pdo PDO
	 * @param $idMandateZonageRNU int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateZonageRNU
	 */
	public static function load(PDO $pdo,$idMandateZonageRNU,$easyload=true)
	{
		// D�j� charg�(e) ?
		if (isset(MandateZonageRNU::$easyload[$idMandateZonageRNU])) {
			return MandateZonageRNU::$easyload[$idMandateZonageRNU];
		}

		// Charger le/la mandateZonageRNU
		$pdoStatement = MandateZonageRNU::_select($pdo,'m.idMandateZonageRNU = ?');
		if (!$pdoStatement->execute(array($idMandateZonageRNU))) {
			throw new Exception('Erreur lors du chargement d\'un(e) mandateZonageRNU depuis la base de donn�es');
		}

		// R�cup�rer le/la mandateZonageRNU depuis le jeu de r�sultats
		return MandateZonageRNU::fetch($pdo,$pdoStatement,$easyload);
	}

	/**
	 * Charger tous/toutes les mandateZonageRNUs
	 * @param $pdo PDO
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateZonageRNU[] tableau de mandatezonagernus
	 */
	public static function loadAll(PDO $pdo,$easyload=false)
	{
		// S�lectionner tous/toutes les mandateZonageRNUs
		$pdoStatement = MandateZonageRNU::selectAll($pdo);

		// Mettre chaque mandateZonageRNU dans un tableau
		$mandateZonageRNUs = array();
		while ($mandateZonageRNU = MandateZonageRNU::fetch($pdo,$pdoStatement,$easyload)) {
			$mandateZonageRNUs[] = $mandateZonageRNU;
		}

		// Retourner le tableau
		return $mandateZonageRNUs;
	}

	/**
	 * S�lectionner tous/toutes les mandateZonageRNUs
	 * @param $pdo PDO
	 * @return PDOStatement
	 */
	public static function selectAll(PDO $pdo)
	{
		$pdoStatement = MandateZonageRNU::_select($pdo);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les mandateZonageRNUs depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�re le/la mandateZonageRNU suivant(e) d'un jeu de r�sultats
	 * @param $pdo PDO
	 * @param $pdoStatement PDOStatement
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateZonageRNU
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idMandateZonageRNU,$name,$code) = $values;

		// Construire le/la mandateZonageRNU
		return isset(MandateZonageRNU::$easyload[$idMandateZonageRNU.'-'.$name.'-'.$code]) ? MandateZonageRNU::$easyload[$idMandateZonageRNU.'-'.$name.'-'.$code] :
		new MandateZonageRNU($pdo,$idMandateZonageRNU,$name,$code,$easyload);
	}

	/**
	 * Serialiser
	 * @param $serialize bool activer la s�rialisation ?
	 * @return string serialisation du/de la mandatezonagernu
	 */
	public function serialize($serialize=true)
	{
		// S�rialiser le/la mandateZonageRNU
		$array = array('idMandateZonageRNU' => $this->idMandateZonageRNU,'name' => $this->name,'code' => $this->code);

		// Retourner la serialisation (ou pas) du/de la mandateZonageRNU
		return $serialize ? serialize($array) : $array;
	}

	/**
	 * D�s�rialiser
	 * @param $pdo PDO
	 * @param $string string serialisation du/de la mandatezonagernu
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateZonageRNU
	 */
	public static function unserialize(PDO $pdo,$string,$easyload=true)
	{
		// D�s�rialiser la chaine de caract�res
		$array = unserialize($string);

		// Construire le/la mandateZonageRNU
		return isset(MandateZonageRNU::$easyload[$array['idMandateZonageRNU']]) ? MandateZonageRNU::$easyload[$array['idMandateZonageRNU']] :
		new MandateZonageRNU($pdo,$array['idMandateZonageRNU'],$array['name'],$array['code'],$easyload);
	}

	/**
	 * Test d'�galit�
	 * @param $mandateZonageRNU MandateZonageRNU
	 * @return bool les objets sont ils �gaux ?
	 */
	public function equals($mandateZonageRNU)
	{
		// Test si null
		if ($mandateZonageRNU == null) { return false; }

		// Tester la classe
		if (!($mandateZonageRNU instanceof MandateZonageRNU)) { return false; }

		// Tester les ids
		return $this->idMandateZonageRNU == $mandateZonageRNU->idMandateZonageRNU;
	}

	/**
	 * Compter les mandateZonageRNUs
	 * @param $pdo PDO
	 * @return int nombre de mandatezonagernus
	 */
	public static function count(PDO $pdo)
	{
		if (!($pdoStatement = $pdo->query('SELECT COUNT(idMandateZonageRNU) FROM MandateZonageRNU'))) {
			throw new Exception('Erreur lors du comptage des mandateZonageRNUs dans la base de donn�es');
		}
		return $pdoStatement->fetchColumn();
	}

	/**
	 * Supprimer le/la mandateZonageRNU
	 * @return bool op�ration r�ussie ?
	 */
	public function delete()
	{
		// Supprimer les mandates associ�(e)s
		$select = $this->selectMandates();
		while ($mandate = Mandate::fetch($this->pdo,$select)) {
			if (!$mandate->delete()) { return false; }
		}

		// Supprimer le/la mandateZonageRNU
		$pdoStatement = $this->pdo->prepare('DELETE FROM MandateZonageRNU WHERE idMandateZonageRNU = ?');
		if (!$pdoStatement->execute(array($this->getIdMandateZonageRNU()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) mandateZonageRNU dans la base de donn�es');
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
		$pdoStatement = $this->pdo->prepare('UPDATE MandateZonageRNU SET '.implode(', ', $updates).' WHERE idMandateZonageRNU = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdMandateZonageRNU())))) {
			throw new Exception('Erreur lors de la mise � jour d\'un champ d\'un(e) mandateZonageRNU dans la base de donn�es');
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
	 * R�cup�rer le/la idMandateZonageRNU
	 * @return int
	 */
	public function getIdMandateZonageRNU()
	{
		return $this->idMandateZonageRNU;
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
		return Mandate::selectByZonageRNU($this->pdo,$this);
	}
	/**
	 * ToString
	 * @return string repr�sentation de mandatezonagernu sous la forme d'un string
	 */
	public function __toString()
	{
		return '[MandateZonageRNU idMandateZonageRNU="'.$this->idMandateZonageRNU.'" name="'.$this->name.'" code="'.$this->code.'"]';
	}

}

?>
