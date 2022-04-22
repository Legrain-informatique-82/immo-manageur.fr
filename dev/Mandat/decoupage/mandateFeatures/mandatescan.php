<?php

/**
 * @class MandateScan
 * @date 10/02/2011 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class MandateScan
{
	/// @var PDO
	private $pdo;

	/// @var array tableau pour le chargement rapide
	private static $easyload;

	/// @var int
	private $idMandateScan;

	/// @var string
	private $name;

	/// @var string
	private $code;

	/// @var int id de mandate
	private $mandate;

	/**
	 * Construire un(e) mandateScan
	 * @param $pdo PDO
	 * @param $idMandateScan int
	 * @param $name string
	 * @param $code string
	 * @param $mandate int id de mandate
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateScan
	 */
	protected function __construct(PDO $pdo,$idMandateScan,$name,$code,$mandate=null,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;

		// Sauvegarder les attributs
		$this->idMandateScan = $idMandateScan;
		$this->name = $name;
		$this->code = $code;
		$this->mandate = $mandate;

		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			MandateScan::$easyload[$idMandateScan] = $this;
		}
	}

	/**
	 * Cr�er un(e) mandateScan
	 * @param $pdo PDO
	 * @param $name string
	 * @param $code string
	 * @param $mandate Mandate
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateScan
	 */
	public static function create(PDO $pdo,$name,$code,$mandate=null,$easyload=true)
	{
		// Ajouter le/la mandateScan dans la base de donn�es
		$pdoStatement = $pdo->prepare('INSERT INTO MandateScan (name,code,fk_idMandate) VALUES (?,?,?)');
		if (!$pdoStatement->execute(array($name,$code,$mandate == null ? null : $mandate->getIdMandate()))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) mandateScan dans la base de donn�es');
		}

		// Construire le/la mandateScan
		return new MandateScan($pdo,$pdo->lastInsertId(),$name,$code,$mandate->getIdMandate(),$easyload);
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
		return $pdo->prepare('SELECT m.idMandateScan, m.name, m.code, m.fk_idMandate FROM MandateScan m '.
		($where != null ? ' WHERE '.$where : '').
		($orderby != null ? ' ORDERBY '.$orderby : '').
		($limit != null ? ' LIMIT '.$limit : ''));
	}

	/**
	 * Charger un(e) mandateScan
	 * @param $pdo PDO
	 * @param $idMandateScan int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateScan
	 */
	public static function load(PDO $pdo,$idMandateScan,$easyload=true)
	{
		// D�j� charg�(e) ?
		if (isset(MandateScan::$easyload[$idMandateScan])) {
			return MandateScan::$easyload[$idMandateScan];
		}

		// Charger le/la mandateScan
		$pdoStatement = MandateScan::_select($pdo,'m.idMandateScan = ?');
		if (!$pdoStatement->execute(array($idMandateScan))) {
			throw new Exception('Erreur lors du chargement d\'un(e) mandateScan depuis la base de donn�es');
		}

		// R�cup�rer le/la mandateScan depuis le jeu de r�sultats
		return MandateScan::fetch($pdo,$pdoStatement,$easyload);
	}

	/**
	 * Charger tous/toutes les mandateScans
	 * @param $pdo PDO
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateScan[] tableau de mandatescans
	 */
	public static function loadAll(PDO $pdo,$easyload=false)
	{
		// S�lectionner tous/toutes les mandateScans
		$pdoStatement = MandateScan::selectAll($pdo);

		// Mettre chaque mandateScan dans un tableau
		$mandateScans = array();
		while ($mandateScan = MandateScan::fetch($pdo,$pdoStatement,$easyload)) {
			$mandateScans[] = $mandateScan;
		}

		// Retourner le tableau
		return $mandateScans;
	}

	/**
	 * S�lectionner tous/toutes les mandateScans
	 * @param $pdo PDO
	 * @return PDOStatement
	 */
	public static function selectAll(PDO $pdo)
	{
		$pdoStatement = MandateScan::_select($pdo);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les mandateScans depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�re le/la mandateScan suivant(e) d'un jeu de r�sultats
	 * @param $pdo PDO
	 * @param $pdoStatement PDOStatement
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateScan
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idMandateScan,$name,$code,$mandate) = $values;

		// Construire le/la mandateScan
		return isset(MandateScan::$easyload[$idMandateScan.'-'.$name.'-'.$code.'-'.$mandate]) ? MandateScan::$easyload[$idMandateScan.'-'.$name.'-'.$code.'-'.$mandate] :
		new MandateScan($pdo,$idMandateScan,$name,$code,$mandate,$easyload);
	}

	/**
	 * Serialiser
	 * @param $serialize bool activer la s�rialisation ?
	 * @return string serialisation du/de la mandatescan
	 */
	public function serialize($serialize=true)
	{
		// S�rialiser le/la mandateScan
		$array = array('idMandateScan' => $this->idMandateScan,'name' => $this->name,'code' => $this->code,'mandate' => $this->mandate);

		// Retourner la serialisation (ou pas) du/de la mandateScan
		return $serialize ? serialize($array) : $array;
	}

	/**
	 * D�s�rialiser
	 * @param $pdo PDO
	 * @param $string string serialisation du/de la mandatescan
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateScan
	 */
	public static function unserialize(PDO $pdo,$string,$easyload=true)
	{
		// D�s�rialiser la chaine de caract�res
		$array = unserialize($string);

		// Construire le/la mandateScan
		return isset(MandateScan::$easyload[$array['idMandateScan']]) ? MandateScan::$easyload[$array['idMandateScan']] :
		new MandateScan($pdo,$array['idMandateScan'],$array['name'],$array['code'],$array['mandate'],$easyload);
	}

	/**
	 * Test d'�galit�
	 * @param $mandateScan MandateScan
	 * @return bool les objets sont ils �gaux ?
	 */
	public function equals($mandateScan)
	{
		// Test si null
		if ($mandateScan == null) { return false; }

		// Tester la classe
		if (!($mandateScan instanceof MandateScan)) { return false; }

		// Tester les ids
		return $this->idMandateScan == $mandateScan->idMandateScan;
	}

	/**
	 * Compter les mandateScans
	 * @param $pdo PDO
	 * @return int nombre de mandatescans
	 */
	public static function count(PDO $pdo)
	{
		if (!($pdoStatement = $pdo->query('SELECT COUNT(idMandateScan) FROM MandateScan'))) {
			throw new Exception('Erreur lors du comptage des mandateScans dans la base de donn�es');
		}
		return $pdoStatement->fetchColumn();
	}

	/**
	 * Supprimer le/la mandateScan
	 * @return bool op�ration r�ussie ?
	 */
	public function delete()
	{
		// Supprimer le/la mandateScan
		$pdoStatement = $this->pdo->prepare('DELETE FROM MandateScan WHERE idMandateScan = ?');
		if (!$pdoStatement->execute(array($this->getIdMandateScan()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) mandateScan dans la base de donn�es');
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
		$pdoStatement = $this->pdo->prepare('UPDATE MandateScan SET '.implode(', ', $updates).' WHERE idMandateScan = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdMandateScan())))) {
			throw new Exception('Erreur lors de la mise � jour d\'un champ d\'un(e) mandateScan dans la base de donn�es');
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
		return $this->_set(array('name','code','fk_idMandate'),array($this->name,$this->code,$this->mandate));
	}

	/**
	 * R�cup�rer le/la idMandateScan
	 * @return int
	 */
	public function getIdMandateScan()
	{
		return $this->idMandateScan;
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
	 * R�cup�rer le/la mandate
	 * @return Mandate
	 */
	public function getMandate()
	{
		// Retourner null si n�c�ssaire
		if ($this->mandate == null) { return null; }

		// Charger et retourner mandate
		return Mandate::load($this->pdo,$this->mandate);
	}

	/**
	 * D�finir le/la mandate
	 * @param $mandate Mandate
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setMandate($mandate=null,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->mandate = $mandate == null ? null : $mandate->getIdMandate();

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('fk_idMandate'),array($mandate == null ? null : $mandate->getIdMandate())) : true;
	}

	/**
	 * S�lectionner les mandateScans par mandate
	 * @param $pdo PDO
	 * @param $mandate Mandate
	 * @return PDOStatement
	 */
	public static function selectByMandate(PDO $pdo,Mandate $mandate)
	{
		$pdoStatement = $pdo->prepare('SELECT m.idMandateScan, m.name, m.code, m.fk_idMandate FROM MandateScan m WHERE m.fk_idMandate = ?');
		if (!$pdoStatement->execute(array($mandate->getIdMandate()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les mandateScans par mandate depuis la base de donn�es');
		}
		return $pdoStatement;
	}
	/**
	 * ToString
	 * @return string repr�sentation de mandatescan sous la forme d'un string
	 */
	public function __toString()
	{
		return '[MandateScan idMandateScan="'.$this->idMandateScan.'" name="'.$this->name.'" code="'.$this->code.'" mandate="'.$this->mandate.'"]';
	}

}

?>
