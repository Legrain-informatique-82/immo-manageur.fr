<?php

/**
 * @class MandateEtap
 * @date 10/02/2011 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class MandateEtap
{
	/// @var PDO
	private $pdo;

	/// @var array tableau pour le chargement rapide
	private static $easyload;

	/// @var int
	private $idMandateEtap;

	/// @var string
	private $name;

	/// @var string
	private $code;

	/**
	 * Construire un(e) mandateEtap
	 * @param $pdo PDO
	 * @param $idMandateEtap int
	 * @param $name string
	 * @param $code string
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateEtap
	 */
	protected function __construct(PDO $pdo,$idMandateEtap,$name,$code,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;

		// Sauvegarder les attributs
		$this->idMandateEtap = $idMandateEtap;
		$this->name = $name;
		$this->code = $code;

		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			MandateEtap::$easyload[$idMandateEtap] = $this;
		}
	}

	/**
	 * Cr�er un(e) mandateEtap
	 * @param $pdo PDO
	 * @param $name string
	 * @param $code string
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateEtap
	 */
	public static function create(PDO $pdo,$name,$code,$easyload=true)
	{
		// Ajouter le/la mandateEtap dans la base de donn�es
		$pdoStatement = $pdo->prepare('INSERT INTO MandateEtap (name,code) VALUES (?,?)');
		if (!$pdoStatement->execute(array($name,$code))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) mandateEtap dans la base de donn�es');
		}

		// Construire le/la mandateEtap
		return new MandateEtap($pdo,$pdo->lastInsertId(),$name,$code,$easyload);
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
		return $pdo->prepare('SELECT m.idMandateEtap, m.name, m.code FROM MandateEtap m '.
		($where != null ? ' WHERE '.$where : '').
		($orderby != null ? ' ORDERBY '.$orderby : '').
		($limit != null ? ' LIMIT '.$limit : ''));
	}

	/**
	 * Charger un(e) mandateEtap
	 * @param $pdo PDO
	 * @param $idMandateEtap int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateEtap
	 */
	public static function load(PDO $pdo,$idMandateEtap,$easyload=true)
	{
		// D�j� charg�(e) ?
		if (isset(MandateEtap::$easyload[$idMandateEtap])) {
			return MandateEtap::$easyload[$idMandateEtap];
		}

		// Charger le/la mandateEtap
		$pdoStatement = MandateEtap::_select($pdo,'m.idMandateEtap = ?');
		if (!$pdoStatement->execute(array($idMandateEtap))) {
			throw new Exception('Erreur lors du chargement d\'un(e) mandateEtap depuis la base de donn�es');
		}

		// R�cup�rer le/la mandateEtap depuis le jeu de r�sultats
		return MandateEtap::fetch($pdo,$pdoStatement,$easyload);
	}

	/**
	 * Charger tous/toutes les mandateEtaps
	 * @param $pdo PDO
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateEtap[] tableau de mandateetaps
	 */
	public static function loadAll(PDO $pdo,$easyload=false)
	{
		// S�lectionner tous/toutes les mandateEtaps
		$pdoStatement = MandateEtap::selectAll($pdo);

		// Mettre chaque mandateEtap dans un tableau
		$mandateEtaps = array();
		while ($mandateEtap = MandateEtap::fetch($pdo,$pdoStatement,$easyload)) {
			$mandateEtaps[] = $mandateEtap;
		}

		// Retourner le tableau
		return $mandateEtaps;
	}

	/**
	 * S�lectionner tous/toutes les mandateEtaps
	 * @param $pdo PDO
	 * @return PDOStatement
	 */
	public static function selectAll(PDO $pdo)
	{
		$pdoStatement = MandateEtap::_select($pdo);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les mandateEtaps depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�re le/la mandateEtap suivant(e) d'un jeu de r�sultats
	 * @param $pdo PDO
	 * @param $pdoStatement PDOStatement
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateEtap
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idMandateEtap,$name,$code) = $values;

		// Construire le/la mandateEtap
		return isset(MandateEtap::$easyload[$idMandateEtap.'-'.$name.'-'.$code]) ? MandateEtap::$easyload[$idMandateEtap.'-'.$name.'-'.$code] :
		new MandateEtap($pdo,$idMandateEtap,$name,$code,$easyload);
	}

	/**
	 * Serialiser
	 * @param $serialize bool activer la s�rialisation ?
	 * @return string serialisation du/de la mandateetap
	 */
	public function serialize($serialize=true)
	{
		// S�rialiser le/la mandateEtap
		$array = array('idMandateEtap' => $this->idMandateEtap,'name' => $this->name,'code' => $this->code);

		// Retourner la serialisation (ou pas) du/de la mandateEtap
		return $serialize ? serialize($array) : $array;
	}

	/**
	 * D�s�rialiser
	 * @param $pdo PDO
	 * @param $string string serialisation du/de la mandateetap
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateEtap
	 */
	public static function unserialize(PDO $pdo,$string,$easyload=true)
	{
		// D�s�rialiser la chaine de caract�res
		$array = unserialize($string);

		// Construire le/la mandateEtap
		return isset(MandateEtap::$easyload[$array['idMandateEtap']]) ? MandateEtap::$easyload[$array['idMandateEtap']] :
		new MandateEtap($pdo,$array['idMandateEtap'],$array['name'],$array['code'],$easyload);
	}

	/**
	 * Test d'�galit�
	 * @param $mandateEtap MandateEtap
	 * @return bool les objets sont ils �gaux ?
	 */
	public function equals($mandateEtap)
	{
		// Test si null
		if ($mandateEtap == null) { return false; }

		// Tester la classe
		if (!($mandateEtap instanceof MandateEtap)) { return false; }

		// Tester les ids
		return $this->idMandateEtap == $mandateEtap->idMandateEtap;
	}

	/**
	 * Compter les mandateEtaps
	 * @param $pdo PDO
	 * @return int nombre de mandateetaps
	 */
	public static function count(PDO $pdo)
	{
		if (!($pdoStatement = $pdo->query('SELECT COUNT(idMandateEtap) FROM MandateEtap'))) {
			throw new Exception('Erreur lors du comptage des mandateEtaps dans la base de donn�es');
		}
		return $pdoStatement->fetchColumn();
	}

	/**
	 * Supprimer le/la mandateEtap
	 * @return bool op�ration r�ussie ?
	 */
	public function delete()
	{
		// Supprimer les mandates associ�(e)s
		$select = $this->selectMandates();
		while ($mandate = Mandate::fetch($this->pdo,$select)) {
			if (!$mandate->delete()) { return false; }
		}

		// Supprimer le/la mandateEtap
		$pdoStatement = $this->pdo->prepare('DELETE FROM MandateEtap WHERE idMandateEtap = ?');
		if (!$pdoStatement->execute(array($this->getIdMandateEtap()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) mandateEtap dans la base de donn�es');
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
		$pdoStatement = $this->pdo->prepare('UPDATE MandateEtap SET '.implode(', ', $updates).' WHERE idMandateEtap = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdMandateEtap())))) {
			throw new Exception('Erreur lors de la mise � jour d\'un champ d\'un(e) mandateEtap dans la base de donn�es');
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
	 * R�cup�rer le/la idMandateEtap
	 * @return int
	 */
	public function getIdMandateEtap()
	{
		return $this->idMandateEtap;
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
		return Mandate::selectByEtap($this->pdo,$this);
	}
	/**
	 * ToString
	 * @return string repr�sentation de mandateetap sous la forme d'un string
	 */
	public function __toString()
	{
		return '[MandateEtap idMandateEtap="'.$this->idMandateEtap.'" name="'.$this->name.'" code="'.$this->code.'"]';
	}

}

?>
