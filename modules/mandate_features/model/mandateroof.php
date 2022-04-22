<?php

/**
 * @class MandateRoof
 * @date 10/02/2011 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class MandateRoof
{
	/// @var PDO
	private $pdo;

	/// @var array tableau pour le chargement rapide
	private static $easyload;

	/// @var int
	private $idMandateRoof;

	/// @var string
	private $name;

	/// @var string
	private $code;

	private $isDisabled;
	/**
	 * Construire un(e) mandateRoof
	 * @param $pdo PDO
	 * @param $idMandateRoof int
	 * @param $name string
	 * @param $code string
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateRoof
	 */
	protected function __construct(PDO $pdo,$idMandateRoof,$name,$code,$isDisabled=0,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;

		// Sauvegarder les attributs
		$this->idMandateRoof = $idMandateRoof;
		$this->name = $name;
		$this->code = $code;
		$this->isDisabled = $isDisabled;
		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			MandateRoof::$easyload[$idMandateRoof] = $this;
		}
	}

	/**
	 * Cr�er un(e) mandateRoof
	 * @param $pdo PDO
	 * @param $name string
	 * @param $code string
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateRoof
	 */
	public static function create(PDO $pdo,$name,$code,$isDisabled=0,$easyload=true)
	{
		// Ajouter le/la mandateRoof dans la base de donn�es
		$pdoStatement = $pdo->prepare('INSERT INTO MandateRoof (name,code,isDisabled) VALUES (?,?,?)');
		if (!$pdoStatement->execute(array($name,$code,$isDisabled))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) mandateRoof dans la base de donn�es');
		}

		// Construire le/la mandateRoof
		return new MandateRoof($pdo,$pdo->lastInsertId(),$name,$code,$isDisabled,$easyload);
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
		return $pdo->prepare('SELECT m.idMandateRoof, m.name, m.code,m.isDisabled FROM MandateRoof m '.
		($where != null ? ' WHERE '.$where : '').
		($orderby != null ? ' ORDER BY '.$orderby : '').
		($limit != null ? ' LIMIT '.$limit : ''));
	}

	/**
	 * Charger un(e) mandateRoof
	 * @param $pdo PDO
	 * @param $idMandateRoof int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateRoof
	 */
	public static function load(PDO $pdo,$idMandateRoof,$easyload=true)
	{
		// D�j� charg�(e) ?
		if (isset(MandateRoof::$easyload[$idMandateRoof])) {
			return MandateRoof::$easyload[$idMandateRoof];
		}

		// Charger le/la mandateRoof
		$pdoStatement = MandateRoof::_select($pdo,'m.idMandateRoof = ?');
		if (!$pdoStatement->execute(array($idMandateRoof))) {
			throw new Exception('Erreur lors du chargement d\'un(e) mandateRoof depuis la base de donn�es');
		}

		// R�cup�rer le/la mandateRoof depuis le jeu de r�sultats
		return MandateRoof::fetch($pdo,$pdoStatement,$easyload);
	}

	/**
	 * Charger tous/toutes les mandateRoofs
	 * @param $pdo PDO
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateRoof[] tableau de mandateroofs
	 */
	public static function loadAll(PDO $pdo,$seeIsDisabled=0,$easyload=false)
	{
		// S�lectionner tous/toutes les mandateRoofs
		if($seeIsDisabled){
			$pdoStatement = MandateRoof::selectAll($pdo,null,'m.name');
		}else{
			$pdoStatement = MandateRoof::selectAll($pdo,'m.isDisabled = 0','m.name');
		}
		// Mettre chaque mandateRoof dans un tableau
		$mandateRoofs = array();
		while ($mandateRoof = MandateRoof::fetch($pdo,$pdoStatement,$easyload)) {
			$mandateRoofs[] = $mandateRoof;
		}

		// Retourner le tableau
		return $mandateRoofs;
	}

	/**
	 * S�lectionner tous/toutes les mandateRoofs
	 * @param $pdo PDO
	 * @return PDOStatement
	 */
	public static function selectAll(PDO $pdo,$where=null,$orderby=null)
	{
		$pdoStatement = MandateRoof::_select($pdo,$where,$orderby);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les mandateRoofs depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�re le/la mandateRoof suivant(e) d'un jeu de r�sultats
	 * @param $pdo PDO
	 * @param $pdoStatement PDOStatement
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateRoof
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idMandateRoof,$name,$code,$isDisabled) = $values;

		// Construire le/la mandateRoof
		return isset(MandateRoof::$easyload[$idMandateRoof.'-'.$name.'-'.$code.'-'.$isDisabled]) ? MandateRoof::$easyload[$idMandateRoof.'-'.$name.'-'.$code.'-'.$isDisabled] :
		new MandateRoof($pdo,$idMandateRoof,$name,$code,$isDisabled,$easyload);
	}

	/**
	 * Serialiser
	 * @param $serialize bool activer la s�rialisation ?
	 * @return string serialisation du/de la mandateroof
	 */
	public function serialize($serialize=true)
	{
		// S�rialiser le/la mandateRoof
		$array = array('idMandateRoof' => $this->idMandateRoof,'name' => $this->name,'code' => $this->code,'isDisabled'=> $this->isDisabled);

		// Retourner la serialisation (ou pas) du/de la mandateRoof
		return $serialize ? serialize($array) : $array;
	}

	/**
	 * D�s�rialiser
	 * @param $pdo PDO
	 * @param $string string serialisation du/de la mandateroof
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateRoof
	 */
	public static function unserialize(PDO $pdo,$string,$easyload=true)
	{
		// D�s�rialiser la chaine de caract�res
		$array = unserialize($string);

		// Construire le/la mandateRoof
		return isset(MandateRoof::$easyload[$array['idMandateRoof']]) ? MandateRoof::$easyload[$array['idMandateRoof']] :
		new MandateRoof($pdo,$array['idMandateRoof'],$array['name'],$array['code'],$array['isDisabled'],$easyload);
	}

	/**
	 * Test d'�galit�
	 * @param $mandateRoof MandateRoof
	 * @return bool les objets sont ils �gaux ?
	 */
	public function equals($mandateRoof)
	{
		// Test si null
		if ($mandateRoof == null) { return false; }

		// Tester la classe
		if (!($mandateRoof instanceof MandateRoof)) { return false; }

		// Tester les ids
		return $this->idMandateRoof == $mandateRoof->idMandateRoof;
	}

	/**
	 * Compter les mandateRoofs
	 * @param $pdo PDO
	 * @return int nombre de mandateroofs
	 */
	public static function count(PDO $pdo)
	{
		if (!($pdoStatement = $pdo->query('SELECT COUNT(idMandateRoof) FROM MandateRoof'))) {
			throw new Exception('Erreur lors du comptage des mandateRoofs dans la base de donn�es');
		}
		return $pdoStatement->fetchColumn();
	}

	/**
	 * Supprimer le/la mandateRoof
	 * @return bool op�ration r�ussie ?
	 */
	public function delete()
	{
		// Supprimer les mandates associ�(e)s
		$select = $this->selectMandates();
		while ($mandate = Mandate::fetch($this->pdo,$select)) {
			if (!$mandate->delete()) { return false; }
		}

		// Supprimer le/la mandateRoof
		$pdoStatement = $this->pdo->prepare('DELETE FROM MandateRoof WHERE idMandateRoof = ?');
		if (!$pdoStatement->execute(array($this->getIdMandateRoof()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) mandateRoof dans la base de donn�es');
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
		$pdoStatement = $this->pdo->prepare('UPDATE MandateRoof SET '.implode(', ', $updates).' WHERE idMandateRoof = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdMandateRoof())))) {
			throw new Exception('Erreur lors de la mise � jour d\'un champ d\'un(e) mandateRoof dans la base de donn�es');
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
	 * R�cup�rer le/la idMandateRoof
	 * @return int
	 */
	public function getIdMandateRoof()
	{
		return $this->idMandateRoof;
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
		return Mandate::selectByRoof($this->pdo,$this);
	}
	/**
	 * ToString
	 * @return string repr�sentation de mandateroof sous la forme d'un string
	 */
	public function __toString()
	{
		return '[MandateRoof idMandateRoof="'.$this->idMandateRoof.'" name="'.$this->name.'" code="'.$this->code.'"]';
	}

	/**
	 * R�cup�rer le/la idMandateInsulation
	 * @return int
	 */
	public function getId()
	{
		return $this->idMandateRoof;
	}


	/**
	 * Compter les mandateBornageTerrains
	 * @param $pdo PDO
	 * @param $name Nom à chercher
	 * @return int nombre de mandatebornageterrains
	 */
	public static function countByName(PDO $pdo,$name)
	{
		$pdoStatement = $pdo->prepare('SELECT COUNT(idMandateRoof) FROM MandateRoof WHERE name = ?');
		if (!($pdoStatement->execute( array($name)) )) {
			throw new Exception('Erreur lors du comptage des MandateRoof dans la base de donn�es');
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
		$pdoStatement = $pdo->prepare('SELECT COUNT(idMandateRoof) FROM MandateRoof WHERE code = ?');
		if (!($pdoStatement->execute( array($code)) )) {
			throw new Exception('Erreur lors du comptage des MandateRoof dans la base de donn�es');
		}
		return($pdoStatement->fetchColumn());

	}

}

?>
