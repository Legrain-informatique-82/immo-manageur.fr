<?php

/**
 * @class MandateSlope
 * @date 10/02/2011 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class MandateSlope
{
	/// @var PDO
	private $pdo;

	/// @var array tableau pour le chargement rapide
	private static $easyload;

	/// @var int
	private $idMandateSlope;

	/// @var string
	private $name;

	/// @var string
	private $code;

	private $isDisabled;

	/**
	 * Construire un(e) mandateSlope
	 * @param $pdo PDO
	 * @param $idMandateSlope int
	 * @param $name string
	 * @param $code string
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateSlope
	 */
	protected function __construct(PDO $pdo,$idMandateSlope,$name,$code,$isDisabled,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;

		// Sauvegarder les attributs
		$this->idMandateSlope = $idMandateSlope;
		$this->name = $name;
		$this->code = $code;
		$this->isDisabled = $isDisabled;

		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			MandateSlope::$easyload[$idMandateSlope] = $this;
		}
	}

	/**
	 * Cr�er un(e) mandateSlope
	 * @param $pdo PDO
	 * @param $name string
	 * @param $code string
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateSlope
	 */
	public static function create(PDO $pdo,$name,$code,$isDisabled,$easyload=true)
	{
		// Ajouter le/la mandateSlope dans la base de donn�es
		$pdoStatement = $pdo->prepare('INSERT INTO MandateSlope (name,code,isDisabled) VALUES (?,?,?)');
		if (!$pdoStatement->execute(array($name,$code,$isDisabled))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) mandateSlope dans la base de donn�es');
		}

		// Construire le/la mandateSlope
		return new MandateSlope($pdo,$pdo->lastInsertId(),$name,$code,$isDisabled,$easyload);
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
		return $pdo->prepare('SELECT m.idMandateSlope, m.name, m.code ,m.isDisabled FROM MandateSlope m '.
		($where != null ? ' WHERE '.$where : '').
		($orderby != null ? ' ORDER BY '.$orderby : '').
		($limit != null ? ' LIMIT '.$limit : ''));
	}

	/**
	 * Charger un(e) mandateSlope
	 * @param $pdo PDO
	 * @param $idMandateSlope int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateSlope
	 */
	public static function load(PDO $pdo,$idMandateSlope,$easyload=true)
	{
		// D�j� charg�(e) ?
		if (isset(MandateSlope::$easyload[$idMandateSlope])) {
			return MandateSlope::$easyload[$idMandateSlope];
		}

		// Charger le/la mandateSlope
		$pdoStatement = MandateSlope::_select($pdo,'m.idMandateSlope = ?');
		if (!$pdoStatement->execute(array($idMandateSlope))) {
			throw new Exception('Erreur lors du chargement d\'un(e) mandateSlope depuis la base de donn�es');
		}

		// R�cup�rer le/la mandateSlope depuis le jeu de r�sultats
		return MandateSlope::fetch($pdo,$pdoStatement,$easyload);
	}

	/**
	 * Charger tous/toutes les mandateSlopes
	 * @param $pdo PDO
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateSlope[] tableau de mandateslopes
	 */
	public static function loadAll(PDO $pdo,$seeIsDisabled=0,$easyload=false)
	{
		// S�lectionner tous/toutes les mandateSlopes

		if($seeIsDisabled){
			$pdoStatement = MandateSlope::selectAll($pdo,null,'m.name');
		}else{
			$pdoStatement = MandateSlope::selectAll($pdo,'m.isDisabled = 0','m.name');
		}
		// Mettre chaque mandateSlope dans un tableau
		$mandateSlopes = array();
		while ($mandateSlope = MandateSlope::fetch($pdo,$pdoStatement,$easyload)) {
			$mandateSlopes[] = $mandateSlope;
		}

		// Retourner le tableau
		return $mandateSlopes;
	}

	/**
	 * S�lectionner tous/toutes les mandateSlopes
	 * @param $pdo PDO
	 * @return PDOStatement
	 */
	public static function selectAll(PDO $pdo,$where=null,$orderBy=null)
	{
		$pdoStatement = MandateSlope::_select($pdo,$where,$orderBy);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les mandateSlopes depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�re le/la mandateSlope suivant(e) d'un jeu de r�sultats
	 * @param $pdo PDO
	 * @param $pdoStatement PDOStatement
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateSlope
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idMandateSlope,$name,$code,$isDisabled) = $values;

		// Construire le/la mandateSlope
		return isset(MandateSlope::$easyload[$idMandateSlope.'-'.$name.'-'.$code.'-'.$isDisabled]) ? MandateSlope::$easyload[$idMandateSlope.'-'.$name.'-'.$code.'-'.$isDisabled] :
		new MandateSlope($pdo,$idMandateSlope,$name,$code,$isDisabled,$easyload);
	}

	/**
	 * Serialiser
	 * @param $serialize bool activer la s�rialisation ?
	 * @return string serialisation du/de la mandateslope
	 */
	public function serialize($serialize=true)
	{
		// S�rialiser le/la mandateSlope
		$array = array('idMandateSlope' => $this->idMandateSlope,'name' => $this->name,'code' => $this->code,'isDisabled'=>$this->isDisabled );

		// Retourner la serialisation (ou pas) du/de la mandateSlope
		return $serialize ? serialize($array) : $array;
	}

	/**
	 * D�s�rialiser
	 * @param $pdo PDO
	 * @param $string string serialisation du/de la mandateslope
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateSlope
	 */
	public static function unserialize(PDO $pdo,$string,$easyload=true)
	{
		// D�s�rialiser la chaine de caract�res
		$array = unserialize($string);

		// Construire le/la mandateSlope
		return isset(MandateSlope::$easyload[$array['idMandateSlope']]) ? MandateSlope::$easyload[$array['idMandateSlope']] :
		new MandateSlope($pdo,$array['idMandateSlope'],$array['name'],$array['code'],$array['isDisabled'],$easyload);
	}

	/**
	 * Test d'�galit�
	 * @param $mandateSlope MandateSlope
	 * @return bool les objets sont ils �gaux ?
	 */
	public function equals($mandateSlope)
	{
		// Test si null
		if ($mandateSlope == null) { return false; }

		// Tester la classe
		if (!($mandateSlope instanceof MandateSlope)) { return false; }

		// Tester les ids
		return $this->idMandateSlope == $mandateSlope->idMandateSlope;
	}

	/**
	 * Compter les mandateSlopes
	 * @param $pdo PDO
	 * @return int nombre de mandateslopes
	 */
	public static function count(PDO $pdo)
	{
		if (!($pdoStatement = $pdo->query('SELECT COUNT(idMandateSlope) FROM MandateSlope'))) {
			throw new Exception('Erreur lors du comptage des mandateSlopes dans la base de donn�es');
		}
		return $pdoStatement->fetchColumn();
	}

	/**
	 * Supprimer le/la mandateSlope
	 * @return bool op�ration r�ussie ?
	 */
	public function delete()
	{
		// Supprimer les mandates associ�(e)s
		$select = $this->selectMandates();
		while ($mandate = Mandate::fetch($this->pdo,$select)) {
			if (!$mandate->delete()) { return false; }
		}

		// Supprimer le/la mandateSlope
		$pdoStatement = $this->pdo->prepare('DELETE FROM MandateSlope WHERE idMandateSlope = ?');
		if (!$pdoStatement->execute(array($this->getIdMandateSlope()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) mandateSlope dans la base de donn�es');
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
		$pdoStatement = $this->pdo->prepare('UPDATE MandateSlope SET '.implode(', ', $updates).' WHERE idMandateSlope = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdMandateSlope())))) {
			throw new Exception('Erreur lors de la mise � jour d\'un champ d\'un(e) mandateSlope dans la base de donn�es');
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
		return $this->_set(array('name','code','isDisabled'),array($this->name,$this->code,$this->isDisabled));
	}

	/**
	 * R�cup�rer le/la idMandateSlope
	 * @return int
	 */
	public function getIdMandateSlope()
	{
		return $this->idMandateSlope;
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
	 * R�cup�rer le/la isDisabled
	 * @return string
	 */
	public function getIsDisabled()
	{
		return $this->isDisabled;
	}

	/**
	 * D�finir le/la isDisabled
	 * @param $code string
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setIsDisabled($isDisabled,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->isDisabled = $isDisabled;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('isDisabled'),array($isDisabled)) : true;
	}

	/**
	 * S�lectionner les mandates
	 * @return PDOStatement
	 */
	public function selectMandates()
	{
		return Mandate::selectBySlope($this->pdo,$this);
	}
	/**
	 * ToString
	 * @return string repr�sentation de mandateslope sous la forme d'un string
	 */
	public function __toString()
	{
		return '[MandateSlope idMandateSlope="'.$this->idMandateSlope.'" name="'.$this->name.'" code="'.$this->code.'"]';
	}


	// Additionnal functions

	public function getId()
	{
		return $this->idMandateSlope;
	}

	/**
	 * Compter les mandateBornageTerrains
	 * @param $pdo PDO
	 * @param $name Nom à chercher
	 * @return int nombre de mandatebornageterrains
	 */
	public static function countByName(PDO $pdo,$name)
	{
		$pdoStatement = $pdo->prepare('SELECT COUNT(idMandateSlope) FROM MandateSlope WHERE name = ?');
		if (!($pdoStatement->execute( array($name)) )) {
			throw new Exception('Erreur lors du comptage des MandateSlope dans la base de donn�es');
		}
		return($pdoStatement->fetchColumn());

	}
	/**
	 * Compter les mandateBornageTerrains
	 * @param $pdo PDO
	 * @param $code Code à chercher
	 * @return int nombre de mandatebornageterrains
	 */
	public static function countByCode(PDO $pdo,$code)
	{
		$pdoStatement = $pdo->prepare('SELECT COUNT(idMandateSlope) FROM MandateSlope WHERE code = ?');
		if (!($pdoStatement->execute( array($code)) )) {
			throw new Exception('Erreur lors du comptage des MandateSlope dans la base de donn�es');
		}
		return($pdoStatement->fetchColumn());

	}
}

?>
