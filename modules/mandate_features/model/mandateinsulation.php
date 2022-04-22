<?php

/**
 * @class MandateInsulation
 * @date 10/02/2011 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class MandateInsulation
{
	/// @var PDO
	private $pdo;

	/// @var array tableau pour le chargement rapide
	private static $easyload;

	/// @var int
	private $idMandateInsulation;

	/// @var string
	private $name;

	/// @var string
	private $code;
	private $isDisabled;
	/**
	 * Construire un(e) mandateInsulation
	 * @param $pdo PDO
	 * @param $idMandateInsulation int
	 * @param $name string
	 * @param $code string
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateInsulation
	 */
	protected function __construct(PDO $pdo,$idMandateInsulation,$name,$code,$isDisabled,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;

		// Sauvegarder les attributs
		$this->idMandateInsulation = $idMandateInsulation;
		$this->name = $name;
		$this->code = $code;
		$this->isDisabled = $isDisabled;
		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			MandateInsulation::$easyload[$idMandateInsulation] = $this;
		}
	}

	/**
	 * Cr�er un(e) mandateInsulation
	 * @param $pdo PDO
	 * @param $name string
	 * @param $code string
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateInsulation
	 */
	public static function create(PDO $pdo,$name,$code,$isDisabled=0,$easyload=true)
	{
		// Ajouter le/la mandateInsulation dans la base de donn�es
		$pdoStatement = $pdo->prepare('INSERT INTO MandateInsulation (name,code,isDisabled) VALUES (?,?,?)');
		if (!$pdoStatement->execute(array($name,$code,$isDisabled))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) mandateInsulation dans la base de donn�es');
		}

		// Construire le/la mandateInsulation
		return new MandateInsulation($pdo,$pdo->lastInsertId(),$name,$code,$isDisabled,$easyload);
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
		return $pdo->prepare('SELECT m.idMandateInsulation, m.name, m.code, m.isDisabled FROM MandateInsulation m '.
		($where != null ? ' WHERE '.$where : '').
		($orderby != null ? ' ORDER BY '.$orderby : '').
		($limit != null ? ' LIMIT '.$limit : ''));
	}

	/**
	 * Charger un(e) mandateInsulation
	 * @param $pdo PDO
	 * @param $idMandateInsulation int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateInsulation
	 */
	public static function load(PDO $pdo,$idMandateInsulation,$easyload=true)
	{
		// D�j� charg�(e) ?
		if (isset(MandateInsulation::$easyload[$idMandateInsulation])) {
			return MandateInsulation::$easyload[$idMandateInsulation];
		}

		// Charger le/la mandateInsulation
		$pdoStatement = MandateInsulation::_select($pdo,'m.idMandateInsulation = ?');
		if (!$pdoStatement->execute(array($idMandateInsulation))) {
			throw new Exception('Erreur lors du chargement d\'un(e) mandateInsulation depuis la base de donn�es');
		}

		// R�cup�rer le/la mandateInsulation depuis le jeu de r�sultats
		return MandateInsulation::fetch($pdo,$pdoStatement,$easyload);
	}

	/**
	 * Charger tous/toutes les mandateInsulations
	 * @param $pdo PDO
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateInsulation[] tableau de mandateinsulations
	 */
	public static function loadAll(PDO $pdo,$seeIsDisabled=0,$easyload=false)
	{
		// S�lectionner tous/toutes les mandateInsulations



		if($seeIsDisabled){
			$pdoStatement = MandateInsulation::selectAll($pdo,null,'m.name','m.name');
		}else{
			$pdoStatement = MandateInsulation::selectAll($pdo,'m.isDisabled = 0','m.name');
		}
		// Mettre chaque mandateInsulation dans un tableau
		$mandateInsulations = array();
		while ($mandateInsulation = MandateInsulation::fetch($pdo,$pdoStatement,$easyload)) {
			$mandateInsulations[] = $mandateInsulation;
		}

		// Retourner le tableau
		return $mandateInsulations;
	}

	/**
	 * S�lectionner tous/toutes les mandateInsulations
	 * @param $pdo PDO
	 * @return PDOStatement
	 */
	public static function selectAll(PDO $pdo,$where=null,$orderby=null)
	{
		$pdoStatement = MandateInsulation::_select($pdo,$where,$orderby);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les mandateInsulations depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�re le/la mandateInsulation suivant(e) d'un jeu de r�sultats
	 * @param $pdo PDO
	 * @param $pdoStatement PDOStatement
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateInsulation
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idMandateInsulation,$name,$code,$isDisabled) = $values;

		// Construire le/la mandateInsulation
		return isset(MandateInsulation::$easyload[$idMandateInsulation.'-'.$name.'-'.$code.'-'.$isDisabled]) ? MandateInsulation::$easyload[$idMandateInsulation.'-'.$name.'-'.$code.'-'.$isDisabled] :
		new MandateInsulation($pdo,$idMandateInsulation,$name,$code,$isDisabled,$easyload);
	}

	/**
	 * Serialiser
	 * @param $serialize bool activer la s�rialisation ?
	 * @return string serialisation du/de la mandateinsulation
	 */
	public function serialize($serialize=true)
	{
		// S�rialiser le/la mandateInsulation
		$array = array('idMandateInsulation' => $this->idMandateInsulation,'name' => $this->name,'code' => $this->code,'isDisabled'=> $this->isDisabled);

		// Retourner la serialisation (ou pas) du/de la mandateInsulation
		return $serialize ? serialize($array) : $array;
	}

	/**
	 * D�s�rialiser
	 * @param $pdo PDO
	 * @param $string string serialisation du/de la mandateinsulation
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateInsulation
	 */
	public static function unserialize(PDO $pdo,$string,$easyload=true)
	{
		// D�s�rialiser la chaine de caract�res
		$array = unserialize($string);

		// Construire le/la mandateInsulation
		return isset(MandateInsulation::$easyload[$array['idMandateInsulation']]) ? MandateInsulation::$easyload[$array['idMandateInsulation']] :
		new MandateInsulation($pdo,$array['idMandateInsulation'],$array['name'],$array['code'],$array['isDisabled'],$easyload);
	}

	/**
	 * Test d'�galit�
	 * @param $mandateInsulation MandateInsulation
	 * @return bool les objets sont ils �gaux ?
	 */
	public function equals($mandateInsulation)
	{
		// Test si null
		if ($mandateInsulation == null) { return false; }

		// Tester la classe
		if (!($mandateInsulation instanceof MandateInsulation)) { return false; }

		// Tester les ids
		return $this->idMandateInsulation == $mandateInsulation->idMandateInsulation;
	}

	/**
	 * Compter les mandateInsulations
	 * @param $pdo PDO
	 * @return int nombre de mandateinsulations
	 */
	public static function count(PDO $pdo)
	{
		if (!($pdoStatement = $pdo->query('SELECT COUNT(idMandateInsulation) FROM MandateInsulation'))) {
			throw new Exception('Erreur lors du comptage des mandateInsulations dans la base de donn�es');
		}
		return $pdoStatement->fetchColumn();
	}

	/**
	 * Supprimer le/la mandateInsulation
	 * @return bool op�ration r�ussie ?
	 */
	public function delete()
	{
		// Supprimer les mandates associ�(e)s
		$select = $this->selectMandates();
		while ($mandate = Mandate::fetch($this->pdo,$select)) {
			if (!$mandate->delete()) { return false; }
		}

		// Supprimer le/la mandateInsulation
		$pdoStatement = $this->pdo->prepare('DELETE FROM MandateInsulation WHERE idMandateInsulation = ?');
		if (!$pdoStatement->execute(array($this->getIdMandateInsulation()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) mandateInsulation dans la base de donn�es');
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
		$pdoStatement = $this->pdo->prepare('UPDATE MandateInsulation SET '.implode(', ', $updates).' WHERE idMandateInsulation = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdMandateInsulation())))) {
			throw new Exception('Erreur lors de la mise � jour d\'un champ d\'un(e) mandateInsulation dans la base de donn�es');
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
	 * R�cup�rer le/la idMandateInsulation
	 * @return int
	 */
	public function getIdMandateInsulation()
	{
		return $this->idMandateInsulation;
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
	 * @param isDisabled string
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
		return Mandate::selectByInsulation($this->pdo,$this);
	}
	/**
	 * ToString
	 * @return string repr�sentation de mandateinsulation sous la forme d'un string
	 */
	public function __toString()
	{
		return '[MandateInsulation idMandateInsulation="'.$this->idMandateInsulation.'" name="'.$this->name.'" code="'.$this->code.'"]';
	}

	/**
	 * R�cup�rer le/la idMandateInsulation
	 * @return int
	 */
	public function getId()
	{
		return $this->idMandateInsulation;
	}


	/**
	 * Compter les mandateBornageTerrains
	 * @param $pdo PDO
	 * @param $name Nom à chercher
	 * @return int nombre de mandatebornageterrains
	 */
	public static function countByName(PDO $pdo,$name)
	{
		$pdoStatement = $pdo->prepare('SELECT COUNT(idMandateInsulation) FROM MandateInsulation WHERE name = ?');
		if (!($pdoStatement->execute( array($name)) )) {
			throw new Exception('Erreur lors du comptage des MandateInsulation dans la base de donn�es');
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
		$pdoStatement = $pdo->prepare('SELECT COUNT(idMandateInsulation) FROM MandateInsulation WHERE code = ?');
		if (!($pdoStatement->execute( array($code)) )) {
			throw new Exception('Erreur lors du comptage des MandateInsulation dans la base de donn�es');
		}
		return($pdoStatement->fetchColumn());

	}

}

?>
