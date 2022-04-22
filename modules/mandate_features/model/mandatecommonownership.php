<?php

/**
 * @class MandateCommonOwnership
 * @date 10/02/2011 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class MandateCommonOwnership
{
	/// @var PDO
	private $pdo;

	/// @var array tableau pour le chargement rapide
	private static $easyload;

	/// @var int
	private $idMandateCommonOwnership;

	/// @var string
	private $name;

	/// @var string
	private $code;
	private $isDisabled;
	/**
	 * Construire un(e) mandateCommonOwnership
	 * @param $pdo PDO
	 * @param $idMandateCommonOwnership int
	 * @param $name string
	 * @param $code string
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateCommonOwnership
	 */
	protected function __construct(PDO $pdo,$idMandateCommonOwnership,$name,$code,$isDisabled,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;

		// Sauvegarder les attributs
		$this->idMandateCommonOwnership = $idMandateCommonOwnership;
		$this->name = $name;
		$this->code = $code;
		$this->isDisabled = $isDisabled;
		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			MandateCommonOwnership::$easyload[$idMandateCommonOwnership] = $this;
		}
	}

	/**
	 * Cr�er un(e) mandateCommonOwnership
	 * @param $pdo PDO
	 * @param $name string
	 * @param $code string
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateCommonOwnership
	 */
	public static function create(PDO $pdo,$name,$code,$isDisabled=0,$easyload=true)
	{
		// Ajouter le/la mandateCommonOwnership dans la base de donn�es
		$pdoStatement = $pdo->prepare('INSERT INTO MandateCommonOwnership (name,code,isDisabled) VALUES (?,?,?)');
		if (!$pdoStatement->execute(array($name,$code,$isDisabled))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) mandateCommonOwnership dans la base de donn�es');
		}

		// Construire le/la mandateCommonOwnership
		return new MandateCommonOwnership($pdo,$pdo->lastInsertId(),$name,$code,$isDisabled,$easyload);
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
		return $pdo->prepare('SELECT m.idMandateCommonOwnership, m.name, m.code,m.isDisabled FROM MandateCommonOwnership m '.
		($where != null ? ' WHERE '.$where : '').
		($orderby != null ? ' ORDER BY '.$orderby : '').
		($limit != null ? ' LIMIT '.$limit : ''));
	}

	/**
	 * Charger un(e) mandateCommonOwnership
	 * @param $pdo PDO
	 * @param $idMandateCommonOwnership int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateCommonOwnership
	 */
	public static function load(PDO $pdo,$idMandateCommonOwnership,$easyload=true)
	{
		// D�j� charg�(e) ?
		if (isset(MandateCommonOwnership::$easyload[$idMandateCommonOwnership])) {
			return MandateCommonOwnership::$easyload[$idMandateCommonOwnership];
		}

		// Charger le/la mandateCommonOwnership
		$pdoStatement = MandateCommonOwnership::_select($pdo,'m.idMandateCommonOwnership = ?');
		if (!$pdoStatement->execute(array($idMandateCommonOwnership))) {
			throw new Exception('Erreur lors du chargement d\'un(e) mandateCommonOwnership depuis la base de donn�es');
		}

		// R�cup�rer le/la mandateCommonOwnership depuis le jeu de r�sultats
		return MandateCommonOwnership::fetch($pdo,$pdoStatement,$easyload);
	}

	/**
	 * Charger tous/toutes les mandateCommonOwnerships
	 * @param $pdo PDO
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateCommonOwnership[] tableau de mandatecommonownerships
	 */
	public static function loadAll(PDO $pdo,$seeIsDisabled=0,$easyload=false)
	{
		// S�lectionner tous/toutes les mandateCommonOwnerships

		if($seeIsDisabled){
			$pdoStatement = MandateCommonOwnership::selectAll($pdo,null,'m.name');
		}else{
			$pdoStatement = MandateCommonOwnership::selectAll($pdo,'m.isDisabled = 0','m.name');
		}
		// Mettre chaque mandateCommonOwnership dans un tableau
		$mandateCommonOwnerships = array();
		while ($mandateCommonOwnership = MandateCommonOwnership::fetch($pdo,$pdoStatement,$easyload)) {
			$mandateCommonOwnerships[] = $mandateCommonOwnership;
		}

		// Retourner le tableau
		return $mandateCommonOwnerships;
	}

	/**
	 * S�lectionner tous/toutes les mandateCommonOwnerships
	 * @param $pdo PDO
	 * @return PDOStatement
	 */
	public static function selectAll(PDO $pdo,$where=null,$orderby=null)
	{
		$pdoStatement = MandateCommonOwnership::_select($pdo,$where,$orderby);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les mandateCommonOwnerships depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�re le/la mandateCommonOwnership suivant(e) d'un jeu de r�sultats
	 * @param $pdo PDO
	 * @param $pdoStatement PDOStatement
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateCommonOwnership
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idMandateCommonOwnership,$name,$code,$isDisabled) = $values;

		// Construire le/la mandateCommonOwnership
		return isset(MandateCommonOwnership::$easyload[$idMandateCommonOwnership.'-'.$name.'-'.$code.'-'.$isDisabled]) ? MandateCommonOwnership::$easyload[$idMandateCommonOwnership.'-'.$name.'-'.$code.'-'.$isDisabled] :
		new MandateCommonOwnership($pdo,$idMandateCommonOwnership,$name,$code,$isDisabled,$easyload);
	}

	/**
	 * Serialiser
	 * @param $serialize bool activer la s�rialisation ?
	 * @return string serialisation du/de la mandatecommonownership
	 */
	public function serialize($serialize=true)
	{
		// S�rialiser le/la mandateCommonOwnership
		$array = array('idMandateCommonOwnership' => $this->idMandateCommonOwnership,'name' => $this->name,'code' => $this->code,'isDisabled'=>$this->isDisabled);

		// Retourner la serialisation (ou pas) du/de la mandateCommonOwnership
		return $serialize ? serialize($array) : $array;
	}

	/**
	 * D�s�rialiser
	 * @param $pdo PDO
	 * @param $string string serialisation du/de la mandatecommonownership
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateCommonOwnership
	 */
	public static function unserialize(PDO $pdo,$string,$easyload=true)
	{
		// D�s�rialiser la chaine de caract�res
		$array = unserialize($string);

		// Construire le/la mandateCommonOwnership
		return isset(MandateCommonOwnership::$easyload[$array['idMandateCommonOwnership']]) ? MandateCommonOwnership::$easyload[$array['idMandateCommonOwnership']] :
		new MandateCommonOwnership($pdo,$array['idMandateCommonOwnership'],$array['name'],$array['code'],$array['isDisabled'],$easyload);
	}

	/**
	 * Test d'�galit�
	 * @param $mandateCommonOwnership MandateCommonOwnership
	 * @return bool les objets sont ils �gaux ?
	 */
	public function equals($mandateCommonOwnership)
	{
		// Test si null
		if ($mandateCommonOwnership == null) { return false; }

		// Tester la classe
		if (!($mandateCommonOwnership instanceof MandateCommonOwnership)) { return false; }

		// Tester les ids
		return $this->idMandateCommonOwnership == $mandateCommonOwnership->idMandateCommonOwnership;
	}

	/**
	 * Compter les mandateCommonOwnerships
	 * @param $pdo PDO
	 * @return int nombre de mandatecommonownerships
	 */
	public static function count(PDO $pdo)
	{
		if (!($pdoStatement = $pdo->query('SELECT COUNT(idMandateCommonOwnership) FROM MandateCommonOwnership'))) {
			throw new Exception('Erreur lors du comptage des mandateCommonOwnerships dans la base de donn�es');
		}
		return $pdoStatement->fetchColumn();
	}

	/**
	 * Supprimer le/la mandateCommonOwnership
	 * @return bool op�ration r�ussie ?
	 */
	public function delete()
	{
		// Supprimer les mandates associ�(e)s
		$select = $this->selectMandates();
		while ($mandate = Mandate::fetch($this->pdo,$select)) {
			if (!$mandate->delete()) { return false; }
		}

		// Supprimer le/la mandateCommonOwnership
		$pdoStatement = $this->pdo->prepare('DELETE FROM MandateCommonOwnership WHERE idMandateCommonOwnership = ?');
		if (!$pdoStatement->execute(array($this->getIdMandateCommonOwnership()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) mandateCommonOwnership dans la base de donn�es');
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
		$pdoStatement = $this->pdo->prepare('UPDATE MandateCommonOwnership SET '.implode(', ', $updates).' WHERE idMandateCommonOwnership = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdMandateCommonOwnership())))) {
			throw new Exception('Erreur lors de la mise � jour d\'un champ d\'un(e) mandateCommonOwnership dans la base de donn�es');
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
	 * R�cup�rer le/la idMandateCommonOwnership
	 * @return int
	 */
	public function getIdMandateCommonOwnership()
	{
		return $this->idMandateCommonOwnership;
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
		return Mandate::selectByCommonOwnership($this->pdo,$this);
	}
	/**
	 * ToString
	 * @return string repr�sentation de mandatecommonownership sous la forme d'un string
	 */
	public function __toString()
	{
		return '[MandateCommonOwnership idMandateCommonOwnership="'.$this->idMandateCommonOwnership.'" name="'.$this->name.'" code="'.$this->code.'"]';
	}

	public function getId()
	{
		return $this->idMandateCommonOwnership;
	}


	/**
	 * Compter les mandateBornageTerrains
	 * @param $pdo PDO
	 * @param $name Nom à chercher
	 * @return int nombre de mandatebornageterrains
	 */
	public static function countByName(PDO $pdo,$name)
	{
		$pdoStatement = $pdo->prepare('SELECT COUNT(idMandateCommonOwnership) FROM MandateCommonOwnership WHERE name = ?');
		if (!($pdoStatement->execute( array($name)) )) {
			throw new Exception('Erreur lors du comptage des MandateCommonOwnership dans la base de donn�es');
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
		$pdoStatement = $pdo->prepare('SELECT COUNT(idMandateCommonOwnership) FROM MandateCommonOwnership WHERE code = ?');
		if (!($pdoStatement->execute( array($code)) )) {
			throw new Exception('Erreur lors du comptage des MandateCommonOwnership dans la base de donn�es');
		}
		return($pdoStatement->fetchColumn());

	}
}

?>
