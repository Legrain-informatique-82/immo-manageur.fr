<?php
/**
 * @class MandateCom
 * @date 06/27/2011 (mm/dd/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class MandateCom
{
	/// @var PDO
	private $pdo;

	/// @var array array for easy load
	private static $easyload;

	/// @var int
	private $idMandateCom;

	/// @var int mandate's id
	private $mandate;

	/// @var string
	private $com;

	/// @var string
	private $infoVisite;

	/// @var string
	private $otherCom;

	/**
	 * Construct a mandateCom
	 * @param $pdo PDO
	 * @param $idMandateCom int
	 * @param $mandate int mandate's id
	 * @param $com string
	 * @param $infoVisite string
	 * @param $otherCom string
	 * @param $easyload bool enable easy load ?
	 * @return MandateCom
	 */
	protected function __construct(PDO $pdo,$idMandateCom,$mandate,$com,$infoVisite,$otherCom,$easyload=false)
	{
		// Save pdo
		$this->pdo = $pdo;

		// Save attributes
		$this->idMandateCom = $idMandateCom;
		$this->mandate = $mandate;
		$this->com = $com;
		$this->infoVisite = $infoVisite;
		$this->otherCom = $otherCom;

		// Save for easy load
		if ($easyload) {
			MandateCom::$easyload[$idMandateCom] = $this;
		}
	}

	/**
	 * Create a mandateCom
	 * @param $pdo PDO
	 * @param $mandate Mandate
	 * @param $com string
	 * @param $infoVisite string
	 * @param $otherCom string
	 * @param $easyload bool enable easy load ?
	 * @return MandateCom
	 */
	public static function create(PDO $pdo,Mandate $mandate,$com='',$infoVisite ='',$otherCom='',$easyload=true)
	{
		// Add the mandateCom into database
		$pdoStatement = $pdo->prepare('INSERT INTO MandateCom (mandate_idMandate,com,infoVisite,otherCom) VALUES (?,?,?,?)');
		if (!$pdoStatement->execute(array($mandate->getIdMandate(),$com,$infoVisite,$otherCom))) {
			throw new Exception('Error while inserting a mandateCom into database');
		}

		// Construct the mandateCom
		return new MandateCom($pdo,$pdo->lastInsertId(),$mandate->getIdMandate(),$com,$infoVisite,$otherCom,$easyload);
	}

	/**
	 * Select query
	 * @param $pdo PDO
	 * @param $where string
	 * @param $orderby string
	 * @param $limit string
	 * @return PDOStatement
	 */
	private static function _select(PDO $pdo,$where=null,$orderby=null,$limit=null)
	{
		return $pdo->prepare('SELECT m.idMandateCom, m.mandate_idMandate, m.com, m.infoVisite, m.otherCom FROM MandateCom m '.
		($where != null ? ' WHERE '.$where : '').
		($orderby != null ? ' ORDERBY '.$orderby : '').
		($limit != null ? ' LIMIT '.$limit : ''));
	}

	/**
	 * Load a mandateCom
	 * @param $pdo PDO
	 * @param $idMandateCom int
	 * @param $easyload bool enable easy load ?
	 * @return MandateCom
	 */
	public static function load(PDO $pdo,$idMandateCom,$easyload=true)
	{
		// Already loaded ?
		if (isset(MandateCom::$easyload[$idMandateCom])) {
			return MandateCom::$easyload[$idMandateCom];
		}

		// Load the mandateCom
		$pdoStatement = MandateCom::_select($pdo,'m.idMandateCom = ?');
		if (!$pdoStatement->execute(array($idMandateCom))) {
			throw new Exception('Error while loading a mandateCom from database');
		}

		// Fetch the mandateCom from result set
		return MandateCom::fetch($pdo,$pdoStatement,$easyload);
	}

	/**
	 * Load all mandateComs
	 * @param $pdo PDO
	 * @param $easyload bool enable easy load ?
	 * @return MandateCom[] array of mandatecoms
	 */
	public static function loadAll(PDO $pdo,$easyload=false)
	{
		// Select all mandateComs
		$pdoStatement = MandateCom::selectAll($pdo);

		// Puts each mandateCom into an array
		$mandateComs = array();
		while ($mandateCom = MandateCom::fetch($pdo,$pdoStatement,$easyload)) {
			$mandateComs[] = $mandateCom;
		}

		// Return array
		return $mandateComs;
	}

	/**
	 * Select all mandateComs
	 * @param $pdo PDO
	 * @return PDOStatement
	 */
	public static function selectAll(PDO $pdo)
	{
		$pdoStatement = MandateCom::_select($pdo);
		if (!$pdoStatement->execute()) {
			throw new Exception('Error while loading all mandateComs from database');
		}
		return $pdoStatement;
	}

	/**
	 * Fetch the next mandateCom from a result set
	 * @param $pdo PDO
	 * @param $pdoStatement PDOStatement
	 * @param $easyload bool enable easy load ?
	 * @return MandateCom
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extract values
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idMandateCom,$mandate,$com,$infoVisite,$otherCom) = $values;

		// Construct the mandateCom
		return isset(MandateCom::$easyload[$idMandateCom.'-'.$mandate.'-'.$com.'-'.$infoVisite.'-'.$otherCom]) ? MandateCom::$easyload[$idMandateCom.'-'.$mandate.'-'.$com.'-'.$infoVisite.'-'.$otherCom] :
		new MandateCom($pdo,$idMandateCom,$mandate,$com,$infoVisite,$otherCom,$easyload);
	}

	/**
	 * Serialize
	 * @param $serialize bool enable serialize ?
	 * @return string serialization of mandatecom
	 */
	public function serialize($serialize=true)
	{
		// Serialize the mandateCom
		$array = array('idMandateCom' => $this->idMandateCom,'mandate' => $this->mandate,'com' => $this->com,'infoVisite' => $this->infoVisite,'otherCom' => $this->otherCom);

		// Return the serialized (or not) mandateCom
		return $serialize ? serialize($array) : $array;
	}

	/**
	 * Unserialize
	 * @param $pdo PDO
	 * @param $string string serialization of mandatecom
	 * @param $easyload bool enable easy load ?
	 * @return MandateCom
	 */
	public static function unserialize(PDO $pdo,$string,$easyload=true)
	{
		// Unserialize string
		$array = unserialize($string);

		// Construct the mandateCom
		return isset(MandateCom::$easyload[$array['idMandateCom']]) ? MandateCom::$easyload[$array['idMandateCom']] :
		new MandateCom($pdo,$array['idMandateCom'],$array['mandate'],$array['com'],$array['infoVisite'],$array['otherCom'],$easyload);
	}

	/**
	 * Equality test
	 * @param $mandateCom MandateCom
	 * @return bool objects are equals ?
	 */
	public function equals($mandateCom)
	{
		// Test if null
		if ($mandateCom == null) { return false; }

		// Test class
		if (!($mandateCom instanceof MandateCom)) { return false; }

		// Test ids
		return $this->idMandateCom == $mandateCom->idMandateCom;
	}

	/**
	 * Count mandateComs
	 * @param $pdo PDO
	 * @return int number of mandatecoms
	 */
	public static function count(PDO $pdo)
	{
		if (!($pdoStatement = $pdo->query('SELECT COUNT(idMandateCom) FROM MandateCom'))) {
			throw new Exception('Error while counting mandateComs in database');
		}
		return $pdoStatement->fetchColumn();
	}

	/**
	 * Delete mandateCom
	 * @return bool successful operation ?
	 */
	public function delete()
	{
		// Delete mandateCom
		$pdoStatement = $this->pdo->prepare('DELETE FROM MandateCom WHERE idMandateCom = ?');
		if (!$pdoStatement->execute(array($this->getIdMandateCom()))) {
			throw new Exception('Error while deleting a mandateCom in database');
		}

		// Successful operation ?
		return $pdoStatement->rowCount() == 1;
	}

	/**
	 * Update a field in database
	 * @param $fields array
	 * @param $values array
	 * @return bool successful operation ?
	 */
	private function _set($fields,$values)
	{
		// Prepare update
		$updates = array();
		foreach ($fields as $field) {
			$updates[] = $field.' = ?';
		}

		// Update field
		$pdoStatement = $this->pdo->prepare('UPDATE MandateCom SET '.implode(', ', $updates).' WHERE idMandateCom = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdMandateCom())))) {
			throw new Exception('Error while updating a mandateCom\'s field in database');
		}

		// Successful operation ?
		return $pdoStatement->rowCount() == 1;
	}

	/**
	 * Update all fields in database
	 * @return bool successful operation ?
	 */
	public function update()
	{
		return $this->_set(array('mandate_idMandate','com','infoVisite','otherCom'),array($this->mandate,$this->com,$this->infoVisite,$this->otherCom));
	}

	/**
	 * Get the idMandateCom
	 * @return int
	 */
	public function getIdMandateCom()
	{
		return $this->idMandateCom;
	}

	/**
	 * Get the mandate
	 * @return Mandate
	 */
	public function getMandate()
	{
		return Mandate::load($this->pdo,$this->mandate);
	}

	/**
	 * Set the mandate
	 * @param $mandate Mandate
	 * @param $execute bool execute update query ?
	 * @return bool successful operation ?
	 */
	public function setMandate(Mandate $mandate,$execute=true)
	{
		// Save into object
		$this->mandate = $mandate->getIdMandate();

		// Save into database (or not)
		return $execute ? $this->_set(array('mandate_idMandate'),array($mandate->getIdMandate())) : true;
	}

	/**
	 * Select mandateComs by mandate
	 * @param $pdo PDO
	 * @param $mandate Mandate
	 * @return PDOStatement
	 */
	public static function selectByMandate(PDO $pdo,Mandate $mandate)
	{
		$pdoStatement = $pdo->prepare('SELECT m.idMandateCom, m.mandate_idMandate, m.com, m.infoVisite, m.otherCom FROM MandateCom m WHERE m.mandate_idMandate = ?');
		if (!$pdoStatement->execute(array($mandate->getIdMandate()))) {
			throw new Exception('Error while selecting all mandateComs by mandate in database');
		}
		return $pdoStatement;
	}

	public static function loadByModule(PDO $pdo,Mandate $mandate) {
		$pdoStatement = MandateCom::selectByMandate($pdo, $mandate);
		return MandateCom::fetch($pdo,$pdoStatement );

	}

	/**
	 * Get the com
	 * @return string
	 */
	public function getCom()
	{
		return $this->com;
	}

	/**
	 * Set the com
	 * @param $com string
	 * @param $execute bool execute update query ?
	 * @return bool successful operation ?
	 */
	public function setCom($com,$execute=true)
	{
		// Save into object
		$this->com = $com;

		// Save into database (or not)
		return $execute ? $this->_set(array('com'),array($com)) : true;
	}

	/**
	 * Get the infoVisite
	 * @return string
	 */
	public function getInfoVisite()
	{
		return $this->infoVisite;
	}

	/**
	 * Set the infoVisite
	 * @param $infoVisite string
	 * @param $execute bool execute update query ?
	 * @return bool successful operation ?
	 */
	public function setInfoVisite($infoVisite,$execute=true)
	{
		// Save into object
		$this->infoVisite = $infoVisite;

		// Save into database (or not)
		return $execute ? $this->_set(array('infoVisite'),array($infoVisite)) : true;
	}

	/**
	 * Get the otherCom
	 * @return string
	 */
	public function getOtherCom()
	{
		return $this->otherCom;
	}

	/**
	 * Set the otherCom
	 * @param $otherCom string
	 * @param $execute bool execute update query ?
	 * @return bool successful operation ?
	 */
	public function setOtherCom($otherCom,$execute=true)
	{
		// Save into object
		$this->otherCom = $otherCom;

		// Save into database (or not)
		return $execute ? $this->_set(array('otherCom'),array($otherCom)) : true;
	}
	/**
	 * ToString
	 * @return string string representation of mandatecom
	 */
	public function __toString()
	{
		return '[MandateCom idMandateCom="'.$this->idMandateCom.'" mandate="'.$this->mandate.'" com="'.$this->com.'" infoVisite="'.$this->infoVisite.'" otherCom="'.$this->otherCom.'"]';
	}

}