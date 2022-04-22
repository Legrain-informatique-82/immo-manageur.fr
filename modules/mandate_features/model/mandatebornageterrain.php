<?php

/**
 * @class MandateBornageTerrain
 * @date 10/02/2011 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class MandateBornageTerrain
{
	/// @var PDO
	private $pdo;

	/// @var array tableau pour le chargement rapide
	private static $easyload;

	/// @var int
	private $idMandateBornageTerrain;

	/// @var string
	private $name;

	/// @var string
	private $code;

	private $isDisabled;
	/**
	 * Construire un(e) mandateBornageTerrain
	 * @param $pdo PDO
	 * @param $idMandateBornageTerrain int
	 * @param $name string
	 * @param $code string
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateBornageTerrain
	 */
	protected function __construct(PDO $pdo,$idMandateBornageTerrain,$name,$code,$isDisabled=false,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;

		// Sauvegarder les attributs
		$this->idMandateBornageTerrain = $idMandateBornageTerrain;
		$this->name = $name;
		$this->code = $code;
		$this->isDisabled =$isDisabled;

		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			MandateBornageTerrain::$easyload[$idMandateBornageTerrain] = $this;
		}
	}

	/**
	 * Cr�er un(e) mandateBornageTerrain
	 * @param $pdo PDO
	 * @param $name string
	 * @param $code string
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateBornageTerrain
	 */
	public static function create(PDO $pdo,$name,$code,$isDisabled=false,$easyload=true)
	{
		// Ajouter le/la mandateBornageTerrain dans la base de donn�es
		$pdoStatement = $pdo->prepare('INSERT INTO MandateBornageTerrain (name,code,isDisabled) VALUES (?,?,?)');
		if (!$pdoStatement->execute(array($name,$code,$isDisabled))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) mandateBornageTerrain dans la base de donn�es');
		}

		// Construire le/la mandateBornageTerrain
		return new MandateBornageTerrain($pdo,$pdo->lastInsertId(),$name,$code,$isDisabled,$easyload);
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
		return $pdo->prepare('SELECT m.idMandateBornageTerrain, m.name, m.code, m.isDisabled FROM MandateBornageTerrain m '.
		($where != null ? ' WHERE '.$where : '').
		($orderby != null ? ' ORDER BY '.$orderby : '').
		($limit != null ? ' LIMIT '.$limit : ''));
	}

	/**
	 * Charger un(e) mandateBornageTerrain
	 * @param $pdo PDO
	 * @param $idMandateBornageTerrain int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateBornageTerrain
	 */
	public static function load(PDO $pdo,$idMandateBornageTerrain,$easyload=true)
	{
		// D�j� charg�(e) ?
		if (isset(MandateBornageTerrain::$easyload[$idMandateBornageTerrain])) {
			return MandateBornageTerrain::$easyload[$idMandateBornageTerrain];
		}

		// Charger le/la mandateBornageTerrain
		$pdoStatement = MandateBornageTerrain::_select($pdo,'m.idMandateBornageTerrain = ?');
		if (!$pdoStatement->execute(array($idMandateBornageTerrain))) {
			throw new Exception('Erreur lors du chargement d\'un(e) mandateBornageTerrain depuis la base de donn�es');
		}

		// R�cup�rer le/la mandateBornageTerrain depuis le jeu de r�sultats
		return MandateBornageTerrain::fetch($pdo,$pdoStatement,$easyload);
	}

	/**
	 * Charger tous/toutes les mandateBornageTerrains
	 * @param $pdo PDO
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateBornageTerrain[] tableau de mandatebornageterrains
	 */
	public static function loadAll(PDO $pdo,$seeIsDisabled=0,$easyload=false)
	{
		// S�lectionner tous/toutes les mandateBornageTerrains
		if($seeIsDisabled){
			$pdoStatement = MandateBornageTerrain::selectAll($pdo);
		}else{
			$pdoStatement = MandateBornageTerrain::selectAll($pdo,'m.isDisabled = 0');
		}
		// Mettre chaque mandateBornageTerrain dans un tableau
		$mandateBornageTerrains = array();
		while ($mandateBornageTerrain = MandateBornageTerrain::fetch($pdo,$pdoStatement,$easyload)) {
			$mandateBornageTerrains[] = $mandateBornageTerrain;
		}

		// Retourner le tableau
		return $mandateBornageTerrains;
	}

	/**
	 * S�lectionner tous/toutes les mandateBornageTerrains
	 * @param $pdo PDO
	 * @return PDOStatement
	 */
	public static function selectAll(PDO $pdo,$where=null,$orderby=null)
	{
		$pdoStatement = MandateBornageTerrain::_select($pdo,$where,$orderby);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les mandateBornageTerrains depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�re le/la mandateBornageTerrain suivant(e) d'un jeu de r�sultats
	 * @param $pdo PDO
	 * @param $pdoStatement PDOStatement
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateBornageTerrain
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();

		if (!$values) { return null; }
		list($idMandateBornageTerrain,$name,$code,$isDisabled) = $values;

		// Construire le/la mandateBornageTerrain
		return isset(MandateBornageTerrain::$easyload[$idMandateBornageTerrain.'-'.$name.'-'.$code.'-'.$isDisabled]) ? MandateBornageTerrain::$easyload[$idMandateBornageTerrain.'-'.$name.'-'.$code.'-'.$isDisabled] :
		new MandateBornageTerrain($pdo,$idMandateBornageTerrain,$name,$code,$isDisabled,$easyload);
	}

	/**
	 * Serialiser
	 * @param $serialize bool activer la s�rialisation ?
	 * @return string serialisation du/de la mandatebornageterrain
	 */
	public function serialize($serialize=true)
	{
		// S�rialiser le/la mandateBornageTerrain
		$array = array('idMandateBornageTerrain' => $this->idMandateBornageTerrain,'name' => $this->name,'code' => $this->code,'isDisabled'=> $this->isDisabled);

		// Retourner la serialisation (ou pas) du/de la mandateBornageTerrain
		return $serialize ? serialize($array) : $array;
	}

	/**
	 * D�s�rialiser
	 * @param $pdo PDO
	 * @param $string string serialisation du/de la mandatebornageterrain
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateBornageTerrain
	 */
	public static function unserialize(PDO $pdo,$string,$easyload=true)
	{
		// D�s�rialiser la chaine de caract�res
		$array = unserialize($string);

		// Construire le/la mandateBornageTerrain
		return isset(MandateBornageTerrain::$easyload[$array['idMandateBornageTerrain']]) ? MandateBornageTerrain::$easyload[$array['idMandateBornageTerrain']] :
		new MandateBornageTerrain($pdo,$array['idMandateBornageTerrain'],$array['name'],$array['code'],$array['isDisabled'],$easyload);
	}

	/**
	 * Test d'�galit�
	 * @param $mandateBornageTerrain MandateBornageTerrain
	 * @return bool les objets sont ils �gaux ?
	 */
	public function equals($mandateBornageTerrain)
	{
		// Test si null
		if ($mandateBornageTerrain == null) { return false; }

		// Tester la classe
		if (!($mandateBornageTerrain instanceof MandateBornageTerrain)) { return false; }

		// Tester les ids
		return $this->idMandateBornageTerrain == $mandateBornageTerrain->idMandateBornageTerrain;
	}

	/**
	 * Compter les mandateBornageTerrains
	 * @param $pdo PDO
	 * @return int nombre de mandatebornageterrains
	 */
	public static function count(PDO $pdo)
	{
		if (!($pdoStatement = $pdo->query('SELECT COUNT(idMandateBornageTerrain) FROM MandateBornageTerrain'))) {
			throw new Exception('Erreur lors du comptage des mandateBornageTerrains dans la base de donn�es');
		}
		return $pdoStatement->fetchColumn();
	}

	/**
	 * Supprimer le/la mandateBornageTerrain
	 * @return bool op�ration r�ussie ?
	 */
	public function delete()
	{
		// Supprimer les mandates associ�(e)s
		$select = $this->selectMandates();
		while ($mandate = Mandate::fetch($this->pdo,$select)) {
			if (!$mandate->delete()) { return false; }
		}

		// Supprimer le/la mandateBornageTerrain
		$pdoStatement = $this->pdo->prepare('DELETE FROM MandateBornageTerrain WHERE idMandateBornageTerrain = ?');
		if (!$pdoStatement->execute(array($this->getIdMandateBornageTerrain()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) mandateBornageTerrain dans la base de donn�es');
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
		$pdoStatement = $this->pdo->prepare('UPDATE MandateBornageTerrain SET '.implode(', ', $updates).' WHERE idMandateBornageTerrain = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdMandateBornageTerrain())))) {
			throw new Exception('Erreur lors de la mise � jour d\'un champ d\'un(e) mandateBornageTerrain dans la base de donn�es');
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
	 * R�cup�rer le/la idMandateBornageTerrain
	 * @return int
	 */
	public function getIdMandateBornageTerrain()
	{
		return $this->idMandateBornageTerrain;
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
	 * D�finir le/la code
	 * @param $isDisabled string
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
		return Mandate::selectByBornageTerrain($this->pdo,$this);
	}
	/**
	 * ToString
	 * @return string repr�sentation de mandatebornageterrain sous la forme d'un string
	 */
	public function __toString()
	{
		return '[MandateBornageTerrain idMandateBornageTerrain="'.$this->idMandateBornageTerrain.'" name="'.$this->name.'" code="'.$this->code.'"]';
	}
	// Additionnal functions

	public function getId()
	{
		return $this->idMandateBornageTerrain;
	}

	/**
	 * Compter les mandateBornageTerrains
	 * @param $pdo PDO
	 * @param $name Nom à chercher
	 * @return int nombre de mandatebornageterrains
	 */
	public static function countByName(PDO $pdo,$name)
	{
		$pdoStatement = $pdo->prepare('SELECT COUNT(idMandateBornageTerrain) FROM MandateBornageTerrain WHERE name = ?');
		if (!($pdoStatement->execute( array($name)) )) {
			throw new Exception('Erreur lors du comptage des mandateBornageTerrains dans la base de donn�es');
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
		$pdoStatement = $pdo->prepare('SELECT COUNT(idMandateBornageTerrain) FROM MandateBornageTerrain WHERE code = ?');
		if (!($pdoStatement->execute( array($code)) )) {
			throw new Exception('Erreur lors du comptage des mandateBornageTerrains dans la base de donn�es');
		}
		return($pdoStatement->fetchColumn());

	}

}

?>
