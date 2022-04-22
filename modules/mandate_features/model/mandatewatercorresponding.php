<?php

/**
 * @class MandateWaterCorresponding
 * @date 10/02/2011 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class MandateWaterCorresponding
{
	/// @var PDO
	private $pdo;

	/// @var array tableau pour le chargement rapide
	private static $easyload;

	/// @var int
	private $idMandateWaterCorresponding;

	/// @var string
	private $name;

	/// @var string
	private $code;
	private $isDisabled;
	/**
	 * Construire un(e) mandateWaterCorresponding
	 * @param $pdo PDO
	 * @param $idMandateWaterCorresponding int
	 * @param $name string
	 * @param $code string
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateWaterCorresponding
	 */
	protected function __construct(PDO $pdo,$idMandateWaterCorresponding,$name,$code,$isDisabled=0,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;

		// Sauvegarder les attributs
		$this->idMandateWaterCorresponding = $idMandateWaterCorresponding;
		$this->name = $name;
		$this->code = $code;
		$this->isDisabled = $isDisabled;
		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			MandateWaterCorresponding::$easyload[$idMandateWaterCorresponding] = $this;
		}
	}

	/**
	 * Cr�er un(e) mandateWaterCorresponding
	 * @param $pdo PDO
	 * @param $name string
	 * @param $code string
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateWaterCorresponding
	 */
	public static function create(PDO $pdo,$name,$code,$isDisabled=0,$easyload=true)
	{
		// Ajouter le/la mandateWaterCorresponding dans la base de donn�es
		$pdoStatement = $pdo->prepare('INSERT INTO MandateWaterCorresponding (name,code,isDisabled) VALUES (?,?,?)');
		if (!$pdoStatement->execute(array($name,$code,$isDisabled))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) mandateWaterCorresponding dans la base de donn�es');
		}

		// Construire le/la mandateWaterCorresponding
		return new MandateWaterCorresponding($pdo,$pdo->lastInsertId(),$name,$code,$isDisabled,$easyload);
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
		return $pdo->prepare('SELECT m.idMandateWaterCorresponding, m.name, m.code,m.isDisabled FROM MandateWaterCorresponding m '.
		($where != null ? ' WHERE '.$where : '').
		($orderby != null ? ' ORDER BY '.$orderby : '').
		($limit != null ? ' LIMIT '.$limit : ''));
	}

	/**
	 * Charger un(e) mandateWaterCorresponding
	 * @param $pdo PDO
	 * @param $idMandateWaterCorresponding int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateWaterCorresponding
	 */
	public static function load(PDO $pdo,$idMandateWaterCorresponding,$easyload=true)
	{
		// D�j� charg�(e) ?
		if (isset(MandateWaterCorresponding::$easyload[$idMandateWaterCorresponding])) {
			return MandateWaterCorresponding::$easyload[$idMandateWaterCorresponding];
		}

		// Charger le/la mandateWaterCorresponding
		$pdoStatement = MandateWaterCorresponding::_select($pdo,'m.idMandateWaterCorresponding = ?');
		if (!$pdoStatement->execute(array($idMandateWaterCorresponding))) {
			throw new Exception('Erreur lors du chargement d\'un(e) mandateWaterCorresponding depuis la base de donn�es');
		}

		// R�cup�rer le/la mandateWaterCorresponding depuis le jeu de r�sultats
		return MandateWaterCorresponding::fetch($pdo,$pdoStatement,$easyload);
	}

	/**
	 * Charger tous/toutes les mandateWaterCorrespondings
	 * @param $pdo PDO
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateWaterCorresponding[] tableau de mandatewatercorrespondings
	 */
	public static function loadAll(PDO $pdo,$seeIsDisabled=0,$easyload=false)
	{
		// S�lectionner tous/toutes les mandateWaterCorrespondings

		if($seeIsDisabled){
			$pdoStatement = MandateWaterCorresponding::selectAll($pdo);
		}else{
			$pdoStatement = MandateWaterCorresponding::selectAll($pdo,'m.isDisabled = 0');
		}
		// Mettre chaque mandateWaterCorresponding dans un tableau
		$mandateWaterCorrespondings = array();
		while ($mandateWaterCorresponding = MandateWaterCorresponding::fetch($pdo,$pdoStatement,$easyload)) {
			$mandateWaterCorrespondings[] = $mandateWaterCorresponding;
		}

		// Retourner le tableau
		return $mandateWaterCorrespondings;
	}

	/**
	 * S�lectionner tous/toutes les mandateWaterCorrespondings
	 * @param $pdo PDO
	 * @return PDOStatement
	 */
	public static function selectAll(PDO $pdo,$where=null,$orderby=null)
	{
		$pdoStatement = MandateWaterCorresponding::_select($pdo,$where,$orderby);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les mandateWaterCorrespondings depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�re le/la mandateWaterCorresponding suivant(e) d'un jeu de r�sultats
	 * @param $pdo PDO
	 * @param $pdoStatement PDOStatement
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateWaterCorresponding
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idMandateWaterCorresponding,$name,$code,$isDisabled) = $values;

		// Construire le/la mandateWaterCorresponding
		return isset(MandateWaterCorresponding::$easyload[$idMandateWaterCorresponding.'-'.$name.'-'.$code.'-'.$isDisabled]) ? MandateWaterCorresponding::$easyload[$idMandateWaterCorresponding.'-'.$name.'-'.$code.'-'.$isDisabled] :
		new MandateWaterCorresponding($pdo,$idMandateWaterCorresponding,$name,$code,$isDisabled,$easyload);
	}

	/**
	 * Serialiser
	 * @param $serialize bool activer la s�rialisation ?
	 * @return string serialisation du/de la mandatewatercorresponding
	 */
	public function serialize($serialize=true)
	{
		// S�rialiser le/la mandateWaterCorresponding
		$array = array('idMandateWaterCorresponding' => $this->idMandateWaterCorresponding,'name' => $this->name,'code' => $this->code,'isDisabled'=>$this->isDisabled);

		// Retourner la serialisation (ou pas) du/de la mandateWaterCorresponding
		return $serialize ? serialize($array) : $array;
	}

	/**
	 * D�s�rialiser
	 * @param $pdo PDO
	 * @param $string string serialisation du/de la mandatewatercorresponding
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateWaterCorresponding
	 */
	public static function unserialize(PDO $pdo,$string,$easyload=true)
	{
		// D�s�rialiser la chaine de caract�res
		$array = unserialize($string);

		// Construire le/la mandateWaterCorresponding
		return isset(MandateWaterCorresponding::$easyload[$array['idMandateWaterCorresponding']]) ? MandateWaterCorresponding::$easyload[$array['idMandateWaterCorresponding']] :
		new MandateWaterCorresponding($pdo,$array['idMandateWaterCorresponding'],$array['name'],$array['code'],$array['isDisabled'],$easyload);
	}

	/**
	 * Test d'�galit�
	 * @param $mandateWaterCorresponding MandateWaterCorresponding
	 * @return bool les objets sont ils �gaux ?
	 */
	public function equals($mandateWaterCorresponding)
	{
		// Test si null
		if ($mandateWaterCorresponding == null) { return false; }

		// Tester la classe
		if (!($mandateWaterCorresponding instanceof MandateWaterCorresponding)) { return false; }

		// Tester les ids
		return $this->idMandateWaterCorresponding == $mandateWaterCorresponding->idMandateWaterCorresponding;
	}

	/**
	 * Compter les mandateWaterCorrespondings
	 * @param $pdo PDO
	 * @return int nombre de mandatewatercorrespondings
	 */
	public static function count(PDO $pdo)
	{
		if (!($pdoStatement = $pdo->query('SELECT COUNT(idMandateWaterCorresponding) FROM MandateWaterCorresponding'))) {
			throw new Exception('Erreur lors du comptage des mandateWaterCorrespondings dans la base de donn�es');
		}
		return $pdoStatement->fetchColumn();
	}

	/**
	 * Supprimer le/la mandateWaterCorresponding
	 * @return bool op�ration r�ussie ?
	 */
	public function delete()
	{
		// Supprimer les mandates associ�(e)s
		$select = $this->selectMandates();
		while ($mandate = Mandate::fetch($this->pdo,$select)) {
			if (!$mandate->delete()) { return false; }
		}

		// Supprimer le/la mandateWaterCorresponding
		$pdoStatement = $this->pdo->prepare('DELETE FROM MandateWaterCorresponding WHERE idMandateWaterCorresponding = ?');
		if (!$pdoStatement->execute(array($this->getIdMandateWaterCorresponding()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) mandateWaterCorresponding dans la base de donn�es');
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
		$pdoStatement = $this->pdo->prepare('UPDATE MandateWaterCorresponding SET '.implode(', ', $updates).' WHERE idMandateWaterCorresponding = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdMandateWaterCorresponding())))) {
			throw new Exception('Erreur lors de la mise � jour d\'un champ d\'un(e) mandateWaterCorresponding dans la base de donn�es');
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
	 * R�cup�rer le/la idMandateWaterCorresponding
	 * @return int
	 */
	public function getIdMandateWaterCorresponding()
	{
		return $this->idMandateWaterCorresponding;
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
		return Mandate::selectByWaterCorresponding($this->pdo,$this);
	}
	/**
	 * ToString
	 * @return string repr�sentation de mandatewatercorresponding sous la forme d'un string
	 */
	public function __toString()
	{
		return '[MandateWaterCorresponding idMandateWaterCorresponding="'.$this->idMandateWaterCorresponding.'" name="'.$this->name.'" code="'.$this->code.'"]';
	}

	// Additionnal functions

	public function getId()
	{
		return $this->idMandateWaterCorresponding;
	}

	/**
	 * Compter les mandateBornageTerrains
	 * @param $pdo PDO
	 * @param $name Nom à chercher
	 * @return int nombre de mandatebornageterrains
	 */
	public static function countByName(PDO $pdo,$name)
	{
		$pdoStatement = $pdo->prepare('SELECT COUNT(idMandateWaterCorresponding) FROM MandateWaterCorresponding WHERE name = ?');
		if (!($pdoStatement->execute( array($name)) )) {
			throw new Exception('Erreur lors du comptage des MandateWaterCorresponding dans la base de donn�es');
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
		$pdoStatement = $pdo->prepare('SELECT COUNT(idMandateWaterCorresponding) FROM MandateWaterCorresponding WHERE code = ?');
		if (!($pdoStatement->execute( array($code)) )) {
			throw new Exception('Erreur lors du comptage des MandateWaterCorresponding dans la base de donn�es');
		}
		return($pdoStatement->fetchColumn());

	}
}