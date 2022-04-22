<?php

/**
 * @class MandateZonagePLU
 * @date 10/02/2011 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class MandateZonagePLU
{
	/// @var PDO
	private $pdo;

	/// @var array tableau pour le chargement rapide
	private static $easyload;

	/// @var int
	private $idMandateZonagePLU;

	/// @var string
	private $name;

	/// @var string
	private $code;

	private $isDisabled;

	/**
	 * Construire un(e) mandateZonagePLU
	 * @param $pdo PDO
	 * @param $idMandateZonagePLU int
	 * @param $name string
	 * @param $code string
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateZonagePLU
	 */
	protected function __construct(PDO $pdo,$idMandateZonagePLU,$name,$code,$isDisabled,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;

		// Sauvegarder les attributs
		$this->idMandateZonagePLU = $idMandateZonagePLU;
		$this->name = $name;
		$this->code = $code;
		$this->isDisabled = $isDisabled;

		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			MandateZonagePLU::$easyload[$idMandateZonagePLU] = $this;
		}
	}

	/**
	 * Cr�er un(e) mandateZonagePLU
	 * @param $pdo PDO
	 * @param $name string
	 * @param $code string
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateZonagePLU
	 */
	public static function create(PDO $pdo,$name,$code,$isDisabled,$easyload=true)
	{
		// Ajouter le/la mandateZonagePLU dans la base de donn�es
		$pdoStatement = $pdo->prepare('INSERT INTO MandateZonagePLU (name,code,isDisabled) VALUES (?,?,?)');
		if (!$pdoStatement->execute(array($name,$code,$isDisabled))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) mandateZonagePLU dans la base de donn�es');
		}

		// Construire le/la mandateZonagePLU
		return new MandateZonagePLU($pdo,$pdo->lastInsertId(),$name,$code,$isDisabled,$easyload);
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
		return $pdo->prepare('SELECT m.idMandateZonagePLU, m.name, m.code, m.isDisabled FROM MandateZonagePLU m '.
		($where != null ? ' WHERE '.$where : '').
		($orderby != null ? ' ORDER BY '.$orderby : '').
		($limit != null ? ' LIMIT '.$limit : ''));
	}

	/**
	 * Charger un(e) mandateZonagePLU
	 * @param $pdo PDO
	 * @param $idMandateZonagePLU int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateZonagePLU
	 */
	public static function load(PDO $pdo,$idMandateZonagePLU,$easyload=true)
	{
		// D�j� charg�(e) ?
		if (isset(MandateZonagePLU::$easyload[$idMandateZonagePLU])) {
			return MandateZonagePLU::$easyload[$idMandateZonagePLU];
		}

		// Charger le/la mandateZonagePLU
		$pdoStatement = MandateZonagePLU::_select($pdo,'m.idMandateZonagePLU = ?');
		if (!$pdoStatement->execute(array($idMandateZonagePLU))) {
			throw new Exception('Erreur lors du chargement d\'un(e) mandateZonagePLU depuis la base de donn�es');
		}

		// R�cup�rer le/la mandateZonagePLU depuis le jeu de r�sultats
		return MandateZonagePLU::fetch($pdo,$pdoStatement,$easyload);
	}

	/**
	 * Charger tous/toutes les mandateZonagePLUs
	 * @param $pdo PDO
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateZonagePLU[] tableau de mandatezonageplus
	 */
	public static function loadAll(PDO $pdo,$seeIsDisabled=0,$easyload=false)
	{
		// S�lectionner tous/toutes les mandateZonagePLUs
		if($seeIsDisabled){
			$pdoStatement = MandateZonagePLU::selectAll($pdo);
		}else{
			$pdoStatement = MandateZonagePLU::selectAll($pdo,'m.isDisabled = 0');
		}

		// Mettre chaque mandateZonagePLU dans un tableau
		$mandateZonagePLUs = array();
		while ($mandateZonagePLU = MandateZonagePLU::fetch($pdo,$pdoStatement,$easyload)) {
			$mandateZonagePLUs[] = $mandateZonagePLU;
		}

		// Retourner le tableau
		return $mandateZonagePLUs;
	}

	/**
	 * S�lectionner tous/toutes les mandateZonagePLUs
	 * @param $pdo PDO
	 * @return PDOStatement
	 */
	public static function selectAll(PDO $pdo,$where=null,$orderBy=null)
	{
		$pdoStatement = MandateZonagePLU::_select($pdo,$where,$orderBy);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les mandateZonagePLUs depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�re le/la mandateZonagePLU suivant(e) d'un jeu de r�sultats
	 * @param $pdo PDO
	 * @param $pdoStatement PDOStatement
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateZonagePLU
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idMandateZonagePLU,$name,$code,$isDisabled) = $values;

		// Construire le/la mandateZonagePLU
		return isset(MandateZonagePLU::$easyload[$idMandateZonagePLU.'-'.$name.'-'.$code.'-'.$isDisabled]) ? MandateZonagePLU::$easyload[$idMandateZonagePLU.'-'.$name.'-'.$code.'-'.isDisabled] :
		new MandateZonagePLU($pdo,$idMandateZonagePLU,$name,$code,$isDisabled,$easyload);
	}

	/**
	 * Serialiser
	 * @param $serialize bool activer la s�rialisation ?
	 * @return string serialisation du/de la mandatezonageplu
	 */
	public function serialize($serialize=true)
	{
		// S�rialiser le/la mandateZonagePLU
		$array = array('idMandateZonagePLU' => $this->idMandateZonagePLU,'name' => $this->name,'code' => $this->code,'isDisabled'=>$isDisabled);

		// Retourner la serialisation (ou pas) du/de la mandateZonagePLU
		return $serialize ? serialize($array) : $array;
	}

	/**
	 * D�s�rialiser
	 * @param $pdo PDO
	 * @param $string string serialisation du/de la mandatezonageplu
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateZonagePLU
	 */
	public static function unserialize(PDO $pdo,$string,$easyload=true)
	{
		// D�s�rialiser la chaine de caract�res
		$array = unserialize($string);

		// Construire le/la mandateZonagePLU
		return isset(MandateZonagePLU::$easyload[$array['idMandateZonagePLU']]) ? MandateZonagePLU::$easyload[$array['idMandateZonagePLU']] :
		new MandateZonagePLU($pdo,$array['idMandateZonagePLU'],$array['name'],$array['code'],$array['isDisabled'],$easyload);
	}

	/**
	 * Test d'�galit�
	 * @param $mandateZonagePLU MandateZonagePLU
	 * @return bool les objets sont ils �gaux ?
	 */
	public function equals($mandateZonagePLU)
	{
		// Test si null
		if ($mandateZonagePLU == null) { return false; }

		// Tester la classe
		if (!($mandateZonagePLU instanceof MandateZonagePLU)) { return false; }

		// Tester les ids
		return $this->idMandateZonagePLU == $mandateZonagePLU->idMandateZonagePLU;
	}

	/**
	 * Compter les mandateZonagePLUs
	 * @param $pdo PDO
	 * @return int nombre de mandatezonageplus
	 */
	public static function count(PDO $pdo)
	{
		if (!($pdoStatement = $pdo->query('SELECT COUNT(idMandateZonagePLU) FROM MandateZonagePLU'))) {
			throw new Exception('Erreur lors du comptage des mandateZonagePLUs dans la base de donn�es');
		}
		return $pdoStatement->fetchColumn();
	}

	/**
	 * Supprimer le/la mandateZonagePLU
	 * @return bool op�ration r�ussie ?
	 */
	public function delete()
	{
		// Supprimer les mandates associ�(e)s
		$select = $this->selectMandates();
		while ($mandate = Mandate::fetch($this->pdo,$select)) {
			if (!$mandate->delete()) { return false; }
		}

		// Supprimer le/la mandateZonagePLU
		$pdoStatement = $this->pdo->prepare('DELETE FROM MandateZonagePLU WHERE idMandateZonagePLU = ?');
		if (!$pdoStatement->execute(array($this->getIdMandateZonagePLU()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) mandateZonagePLU dans la base de donn�es');
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
		$pdoStatement = $this->pdo->prepare('UPDATE MandateZonagePLU SET '.implode(', ', $updates).' WHERE idMandateZonagePLU = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdMandateZonagePLU())))) {
			throw new Exception('Erreur lors de la mise � jour d\'un champ d\'un(e) mandateZonagePLU dans la base de donn�es');
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
	 * R�cup�rer le/la idMandateZonagePLU
	 * @return int
	 */
	public function getIdMandateZonagePLU()
	{
		return $this->idMandateZonagePLU;
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
		return Mandate::selectByZonagePLU($this->pdo,$this);
	}
	/**
	 * ToString
	 * @return string repr�sentation de mandatezonageplu sous la forme d'un string
	 */
	public function __toString()
	{
		return '[MandateZonagePLU idMandateZonagePLU="'.$this->idMandateZonagePLU.'" name="'.$this->name.'" code="'.$this->code.'"]';
	}


	// Additionnal functions

	public function getId()
	{
		return $this->idMandateZonagePLU;
	}

	/**
	 * Compter les mandateBornageTerrains
	 * @param $pdo PDO
	 * @param $name Nom à chercher
	 * @return int nombre de mandatebornageterrains
	 */
	public static function countByName(PDO $pdo,$name)
	{
		$pdoStatement = $pdo->prepare('SELECT COUNT(idMandateZonagePLU) FROM MandateZonagePLU WHERE name = ?');
		if (!($pdoStatement->execute( array($name)) )) {
			throw new Exception('Erreur lors du comptage des MandateZonagePLU dans la base de donn�es');
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
		$pdoStatement = $pdo->prepare('SELECT COUNT(idMandateZonagePLU) FROM MandateZonagePLU WHERE code = ?');
		if (!($pdoStatement->execute( array($code)) )) {
			throw new Exception('Erreur lors du comptage des MandateZonagePLU dans la base de donn�es');
		}
		return($pdoStatement->fetchColumn());

	}
}

?>
