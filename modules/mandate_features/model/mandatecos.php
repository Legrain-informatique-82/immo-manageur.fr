<?php

/**
 * @class MandateCOS
 * @date 10/02/2011 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class MandateCOS
{
	/// @var PDO
	private $pdo;

	/// @var array tableau pour le chargement rapide
	private static $easyload;

	/// @var int
	private $idMandateCOS;

	/// @var string
	private $name;

	/// @var string
	private $code;
	private $isDisabled;

	/**
	 * Construire un(e) mandateCOS
	 * @param $pdo PDO
	 * @param $idMandateCOS int
	 * @param $name string
	 * @param $code string
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateCOS
	 */
	protected function __construct(PDO $pdo,$idMandateCOS,$name,$code,$isDisabled,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;

		// Sauvegarder les attributs
		$this->idMandateCOS = $idMandateCOS;
		$this->name = $name;
		$this->code = $code;
		$this->isDisabled = $isDisabled;

		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			MandateCOS::$easyload[$idMandateCOS] = $this;
		}
	}

	/**
	 * Cr�er un(e) mandateCOS
	 * @param $pdo PDO
	 * @param $name string
	 * @param $code string
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateCOS
	 */
	public static function create(PDO $pdo,$name,$code,$isDisabled=0,$easyload=true)
	{
		// Ajouter le/la mandateCOS dans la base de donn�es
		$pdoStatement = $pdo->prepare('INSERT INTO MandateCOS (name,code,isDisabled) VALUES (?,?,?)');
		if (!$pdoStatement->execute(array($name,$code,$isDisabled))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) mandateCOS dans la base de donn�es');
		}

		// Construire le/la mandateCOS
		return new MandateCOS($pdo,$pdo->lastInsertId(),$name,$code,$isDisabled,$easyload);
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
		return $pdo->prepare('SELECT m.idMandateCOS, m.name, m.code,m.isDisabled FROM MandateCOS m '.
		($where != null ? ' WHERE '.$where : '').
		($orderby != null ? ' ORDER BY '.$orderby : '').
		($limit != null ? ' LIMIT '.$limit : ''));
	}

	/**
	 * Charger un(e) mandateCOS
	 * @param $pdo PDO
	 * @param $idMandateCOS int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateCOS
	 */
	public static function load(PDO $pdo,$idMandateCOS,$easyload=true)
	{
		// D�j� charg�(e) ?
		if (isset(MandateCOS::$easyload[$idMandateCOS])) {
			return MandateCOS::$easyload[$idMandateCOS];
		}

		// Charger le/la mandateCOS
		$pdoStatement = MandateCOS::_select($pdo,'m.idMandateCOS = ?');
		if (!$pdoStatement->execute(array($idMandateCOS))) {
			throw new Exception('Erreur lors du chargement d\'un(e) mandateCOS depuis la base de donn�es');
		}

		// R�cup�rer le/la mandateCOS depuis le jeu de r�sultats
		return MandateCOS::fetch($pdo,$pdoStatement,$easyload);
	}

	/**
	 * Charger tous/toutes les mandateCOSs
	 * @param $pdo PDO
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateCOS[] tableau de mandatecoss
	 */
	public static function loadAll(PDO $pdo,$seeIsDisabled=0,$easyload=false)
	{
		// S�lectionner tous/toutes les mandateCOSs
		if($seeIsDisabled){
			$pdoStatement = MandateCOS::selectAll($pdo);
		}else{
			$pdoStatement = MandateCOS::selectAll($pdo,'m.isDisabled = 0');
		}
		// Mettre chaque mandateCOS dans un tableau
		$mandateCOSs = array();
		while ($mandateCOS = MandateCOS::fetch($pdo,$pdoStatement,$easyload)) {
			$mandateCOSs[] = $mandateCOS;
		}

		// Retourner le tableau
		return $mandateCOSs;
	}

	/**
	 * S�lectionner tous/toutes les mandateCOSs
	 * @param $pdo PDO
	 * @return PDOStatement
	 */
	public static function selectAll(PDO $pdo,$where=null,$orderby=null)
	{
		$pdoStatement = MandateCOS::_select($pdo,$where,$orderby);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les mandateCOSs depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�re le/la mandateCOS suivant(e) d'un jeu de r�sultats
	 * @param $pdo PDO
	 * @param $pdoStatement PDOStatement
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateCOS
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idMandateCOS,$name,$code,$isDisabled) = $values;

		// Construire le/la mandateCOS
		return isset(MandateCOS::$easyload[$idMandateCOS.'-'.$name.'-'.$code.'-'.$isDisabled]) ? MandateCOS::$easyload[$idMandateCOS.'-'.$name.'-'.$code.'-'.$isDisabled] :
		new MandateCOS($pdo,$idMandateCOS,$name,$code,$isDisabled,$easyload);
	}

	/**
	 * Serialiser
	 * @param $serialize bool activer la s�rialisation ?
	 * @return string serialisation du/de la mandatecos
	 */
	public function serialize($serialize=true)
	{
		// S�rialiser le/la mandateCOS
		$array = array('idMandateCOS' => $this->idMandateCOS,'name' => $this->name,'code' => $this->code,'isDisabled'=> $this->isDisabled);

		// Retourner la serialisation (ou pas) du/de la mandateCOS
		return $serialize ? serialize($array) : $array;
	}

	/**
	 * D�s�rialiser
	 * @param $pdo PDO
	 * @param $string string serialisation du/de la mandatecos
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateCOS
	 */
	public static function unserialize(PDO $pdo,$string,$easyload=true)
	{
		// D�s�rialiser la chaine de caract�res
		$array = unserialize($string);

		// Construire le/la mandateCOS
		return isset(MandateCOS::$easyload[$array['idMandateCOS']]) ? MandateCOS::$easyload[$array['idMandateCOS']] :
		new MandateCOS($pdo,$array['idMandateCOS'],$array['name'],$array['code'],$array['isDisabled'],$easyload);
	}

	/**
	 * Test d'�galit�
	 * @param $mandateCOS MandateCOS
	 * @return bool les objets sont ils �gaux ?
	 */
	public function equals($mandateCOS)
	{
		// Test si null
		if ($mandateCOS == null) { return false; }

		// Tester la classe
		if (!($mandateCOS instanceof MandateCOS)) { return false; }

		// Tester les ids
		return $this->idMandateCOS == $mandateCOS->idMandateCOS;
	}

	/**
	 * Compter les mandateCOSs
	 * @param $pdo PDO
	 * @return int nombre de mandatecoss
	 */
	public static function count(PDO $pdo)
	{
		if (!($pdoStatement = $pdo->query('SELECT COUNT(idMandateCOS) FROM MandateCOS'))) {
			throw new Exception('Erreur lors du comptage des mandateCOSs dans la base de donn�es');
		}
		return $pdoStatement->fetchColumn();
	}

	/**
	 * Supprimer le/la mandateCOS
	 * @return bool op�ration r�ussie ?
	 */
	public function delete()
	{
		// Supprimer les mandates associ�(e)s
		$select = $this->selectMandates();
		while ($mandate = Mandate::fetch($this->pdo,$select)) {
			if (!$mandate->delete()) { return false; }
		}

		// Supprimer le/la mandateCOS
		$pdoStatement = $this->pdo->prepare('DELETE FROM MandateCOS WHERE idMandateCOS = ?');
		if (!$pdoStatement->execute(array($this->getIdMandateCOS()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) mandateCOS dans la base de donn�es');
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
		$pdoStatement = $this->pdo->prepare('UPDATE MandateCOS SET '.implode(', ', $updates).' WHERE idMandateCOS = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdMandateCOS())))) {
			throw new Exception('Erreur lors de la mise � jour d\'un champ d\'un(e) mandateCOS dans la base de donn�es');
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
	 * R�cup�rer le/la idMandateCOS
	 * @return int
	 */
	public function getIdMandateCOS()
	{
		return $this->idMandateCOS;
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
		return Mandate::selectByCos($this->pdo,$this);
	}
	/**
	 * ToString
	 * @return string repr�sentation de mandatecos sous la forme d'un string
	 */
	public function __toString()
	{
		return '[MandateCOS idMandateCOS="'.$this->idMandateCOS.'" name="'.$this->name.'" code="'.$this->code.'"]';
	}
	// Additionnal functions

	public function getId()
	{
		return $this->idMandateCOS;
	}

	/**
	 * Compter les mandateBornageTerrains
	 * @param $pdo PDO
	 * @param $name Nom à chercher
	 * @return int nombre de mandatebornageterrains
	 */
	public static function countByName(PDO $pdo,$name)
	{
		$pdoStatement = $pdo->prepare('SELECT COUNT(idMandateCOS) FROM MandateCOS WHERE name = ?');
		if (!($pdoStatement->execute( array($name)) )) {
			throw new Exception('Erreur lors du comptage des MandateCOS dans la base de donn�es');
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
		$pdoStatement = $pdo->prepare('SELECT COUNT(idMandateCOS) FROM MandateCOS WHERE code = ?');
		if (!($pdoStatement->execute( array($code)) )) {
			throw new Exception('Erreur lors du comptage des MandateCOS dans la base de donn�es');
		}
		return($pdoStatement->fetchColumn());

	}
}

?>
