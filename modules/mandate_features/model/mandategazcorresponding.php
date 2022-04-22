<?php

/**
 * @class MandateGazCorresponding
 * @date 10/02/2011 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class MandateGazCorresponding
{
	/// @var PDO
	private $pdo;

	/// @var array tableau pour le chargement rapide
	private static $easyload;

	/// @var int
	private $idMandateGazCorresponding;

	/// @var string
	private $name;

	/// @var string
	private $code;

	private $isDisabled;
	/**
	 * Construire un(e) mandateGazCorresponding
	 * @param $pdo PDO
	 * @param $idMandateGazCorresponding int
	 * @param $name string
	 * @param $code string
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateGazCorresponding
	 */
	protected function __construct(PDO $pdo,$idMandateGazCorresponding,$name,$code,$isDisabled,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;

		// Sauvegarder les attributs
		$this->idMandateGazCorresponding = $idMandateGazCorresponding;
		$this->name = $name;
		$this->code = $code;
		$this->isDisabled = $isDisabled;
		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			MandateGazCorresponding::$easyload[$idMandateGazCorresponding] = $this;
		}
	}

	/**
	 * Cr�er un(e) mandateGazCorresponding
	 * @param $pdo PDO
	 * @param $name string
	 * @param $code string
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateGazCorresponding
	 */
	public static function create(PDO $pdo,$name,$code,$isDisabled=0,$easyload=true)
	{
		// Ajouter le/la mandateGazCorresponding dans la base de donn�es
		$pdoStatement = $pdo->prepare('INSERT INTO MandateGazCorresponding (name,code,isDisabled) VALUES (?,?,?)');
		if (!$pdoStatement->execute(array($name,$code,$isDisabled))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) mandateGazCorresponding dans la base de donn�es');
		}

		// Construire le/la mandateGazCorresponding
		return new MandateGazCorresponding($pdo,$pdo->lastInsertId(),$name,$code,$isDisabled,$easyload);
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
		return $pdo->prepare('SELECT m.idMandateGazCorresponding, m.name, m.code,m.isDisabled FROM MandateGazCorresponding m '.
		($where != null ? ' WHERE '.$where : '').
		($orderby != null ? ' ORDER BY '.$orderby : '').
		($limit != null ? ' LIMIT '.$limit : ''));
	}

	/**
	 * Charger un(e) mandateGazCorresponding
	 * @param $pdo PDO
	 * @param $idMandateGazCorresponding int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateGazCorresponding
	 */
	public static function load(PDO $pdo,$idMandateGazCorresponding,$easyload=true)
	{
		// D�j� charg�(e) ?
		if (isset(MandateGazCorresponding::$easyload[$idMandateGazCorresponding])) {
			return MandateGazCorresponding::$easyload[$idMandateGazCorresponding];
		}

		// Charger le/la mandateGazCorresponding
		$pdoStatement = MandateGazCorresponding::_select($pdo,'m.idMandateGazCorresponding = ?');
		if (!$pdoStatement->execute(array($idMandateGazCorresponding))) {
			throw new Exception('Erreur lors du chargement d\'un(e) mandateGazCorresponding depuis la base de donn�es');
		}

		// R�cup�rer le/la mandateGazCorresponding depuis le jeu de r�sultats
		return MandateGazCorresponding::fetch($pdo,$pdoStatement,$easyload);
	}

	/**
	 * Charger tous/toutes les mandateGazCorrespondings
	 * @param $pdo PDO
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateGazCorresponding[] tableau de mandategazcorrespondings
	 */
	public static function loadAll(PDO $pdo,$seeIsDisabled=0,$easyload=false)
	{
		// S�lectionner tous/toutes les mandateGazCorrespondings

		if($seeIsDisabled){
			$pdoStatement = MandateGazCorresponding::selectAll($pdo);
		}else{
			$pdoStatement = MandateGazCorresponding::selectAll($pdo,'m.isDisabled = 0');
		}
		// Mettre chaque mandateGazCorresponding dans un tableau
		$mandateGazCorrespondings = array();
		while ($mandateGazCorresponding = MandateGazCorresponding::fetch($pdo,$pdoStatement,$easyload)) {
			$mandateGazCorrespondings[] = $mandateGazCorresponding;
		}

		// Retourner le tableau
		return $mandateGazCorrespondings;
	}

	/**
	 * S�lectionner tous/toutes les mandateGazCorrespondings
	 * @param $pdo PDO
	 * @return PDOStatement
	 */
	public static function selectAll(PDO $pdo,$where=null,$orderby=null)
	{
		$pdoStatement = MandateGazCorresponding::_select($pdo,$where,$orderby);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les mandateGazCorrespondings depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�re le/la mandateGazCorresponding suivant(e) d'un jeu de r�sultats
	 * @param $pdo PDO
	 * @param $pdoStatement PDOStatement
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateGazCorresponding
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idMandateGazCorresponding,$name,$code,$isDisabled) = $values;

		// Construire le/la mandateGazCorresponding
		return isset(MandateGazCorresponding::$easyload[$idMandateGazCorresponding.'-'.$name.'-'.$code.'-'.$isDisabled]) ? MandateGazCorresponding::$easyload[$idMandateGazCorresponding.'-'.$name.'-'.$code.'-'.$isDisabled] :
		new MandateGazCorresponding($pdo,$idMandateGazCorresponding,$name,$code,$isDisabled,$easyload);
	}

	/**
	 * Serialiser
	 * @param $serialize bool activer la s�rialisation ?
	 * @return string serialisation du/de la mandategazcorresponding
	 */
	public function serialize($serialize=true)
	{
		// S�rialiser le/la mandateGazCorresponding
		$array = array('idMandateGazCorresponding' => $this->idMandateGazCorresponding,'name' => $this->name,'code' => $this->code,'isDisabled'=>$this->isDisabled);

		// Retourner la serialisation (ou pas) du/de la mandateGazCorresponding
		return $serialize ? serialize($array) : $array;
	}

	/**
	 * D�s�rialiser
	 * @param $pdo PDO
	 * @param $string string serialisation du/de la mandategazcorresponding
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateGazCorresponding
	 */
	public static function unserialize(PDO $pdo,$string,$easyload=true)
	{
		// D�s�rialiser la chaine de caract�res
		$array = unserialize($string);

		// Construire le/la mandateGazCorresponding
		return isset(MandateGazCorresponding::$easyload[$array['idMandateGazCorresponding']]) ? MandateGazCorresponding::$easyload[$array['idMandateGazCorresponding']] :
		new MandateGazCorresponding($pdo,$array['idMandateGazCorresponding'],$array['name'],$array['code'],$array['isDisabled'],$easyload);
	}

	/**
	 * Test d'�galit�
	 * @param $mandateGazCorresponding MandateGazCorresponding
	 * @return bool les objets sont ils �gaux ?
	 */
	public function equals($mandateGazCorresponding)
	{
		// Test si null
		if ($mandateGazCorresponding == null) { return false; }

		// Tester la classe
		if (!($mandateGazCorresponding instanceof MandateGazCorresponding)) { return false; }

		// Tester les ids
		return $this->idMandateGazCorresponding == $mandateGazCorresponding->idMandateGazCorresponding;
	}

	/**
	 * Compter les mandateGazCorrespondings
	 * @param $pdo PDO
	 * @return int nombre de mandategazcorrespondings
	 */
	public static function count(PDO $pdo)
	{
		if (!($pdoStatement = $pdo->query('SELECT COUNT(idMandateGazCorresponding) FROM MandateGazCorresponding'))) {
			throw new Exception('Erreur lors du comptage des mandateGazCorrespondings dans la base de donn�es');
		}
		return $pdoStatement->fetchColumn();
	}

	/**
	 * Supprimer le/la mandateGazCorresponding
	 * @return bool op�ration r�ussie ?
	 */
	public function delete()
	{
		// Supprimer les mandates associ�(e)s
		$select = $this->selectMandates();
		while ($mandate = Mandate::fetch($this->pdo,$select)) {
			if (!$mandate->delete()) { return false; }
		}

		// Supprimer le/la mandateGazCorresponding
		$pdoStatement = $this->pdo->prepare('DELETE FROM MandateGazCorresponding WHERE idMandateGazCorresponding = ?');
		if (!$pdoStatement->execute(array($this->getIdMandateGazCorresponding()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) mandateGazCorresponding dans la base de donn�es');
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
		$pdoStatement = $this->pdo->prepare('UPDATE MandateGazCorresponding SET '.implode(', ', $updates).' WHERE idMandateGazCorresponding = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdMandateGazCorresponding())))) {
			throw new Exception('Erreur lors de la mise � jour d\'un champ d\'un(e) mandateGazCorresponding dans la base de donn�es');
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
	 * R�cup�rer le/la idMandateGazCorresponding
	 * @return int
	 */
	public function getIdMandateGazCorresponding()
	{
		return $this->idMandateGazCorresponding;
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
		return Mandate::selectByGazCorresponding($this->pdo,$this);
	}
	/**
	 * ToString
	 * @return string repr�sentation de mandategazcorresponding sous la forme d'un string
	 */
	public function __toString()
	{
		return '[MandateGazCorresponding idMandateGazCorresponding="'.$this->idMandateGazCorresponding.'" name="'.$this->name.'" code="'.$this->code.'"]';
	}
	// Additionnal functions

	public function getId()
	{
		return $this->idMandateGazCorresponding;
	}

	/**
	 * Compter les mandateBornageTerrains
	 * @param $pdo PDO
	 * @param $name Nom à chercher
	 * @return int nombre de mandatebornageterrains
	 */
	public static function countByName(PDO $pdo,$name)
	{
		$pdoStatement = $pdo->prepare('SELECT COUNT(idMandateGazCorresponding) FROM MandateGazCorresponding WHERE name = ?');
		if (!($pdoStatement->execute( array($name)) )) {
			throw new Exception('Erreur lors du comptage des MandateGazCorresponding dans la base de donn�es');
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
		$pdoStatement = $pdo->prepare('SELECT COUNT(idMandateGazCorresponding) FROM MandateGazCorresponding WHERE code = ?');
		if (!($pdoStatement->execute( array($code)) )) {
			throw new Exception('Erreur lors du comptage des MandateGazCorresponding dans la base de donn�es');
		}
		return($pdoStatement->fetchColumn());

	}
}

