<?php

/**
 * @class MandateNature
 * @date 18/04/2011 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class MandateNature
{
	/// @var PDO
	private $pdo;

	/// @var array tableau pour le chargement rapide
	private static $easyload;

	/// @var int
	private $idMandateNature;

	/// @var string
	private $code;

	/// @var string
	private $name;

	private $isDisabled;
	/**
	 * Construire un(e) mandateNature
	 * @param $pdo PDO
	 * @param $idMandateNature int
	 * @param $code string
	 * @param $name string
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateNature
	 */
	protected function __construct(PDO $pdo,$idMandateNature,$code,$name,$isDisabled,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;

		// Sauvegarder les attributs
		$this->idMandateNature = $idMandateNature;
		$this->code = $code;
		$this->name = $name;
		$this->isDisabled = $isDisabled;

		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			MandateNature::$easyload[$idMandateNature] = $this;
		}
	}

	/**
	 * Créer un(e) mandateNature
	 * @param $pdo PDO
	 * @param $code string
	 * @param $name string
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateNature
	 */
	public static function create(PDO $pdo,$code,$name,$isDisabled,$easyload=true)
	{
		// Ajouter le/la mandateNature dans la base de données
		$pdoStatement = $pdo->prepare('INSERT INTO MandateNature (code,name,isDisabled) VALUES (?,?,?)');
		if (!$pdoStatement->execute(array($code,$name,$isDisabled))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) mandateNature dans la base de données');
		}

		// Construire le/la mandateNature
		return new MandateNature($pdo,$pdo->lastInsertId(),$code,$name,$isDisabled,$easyload);
	}

	/**
	 * Requête de séléction
	 * @param $pdo PDO
	 * @param $where string
	 * @param $orderby string
	 * @param $limit string
	 * @return PDOStatement
	 */
	private static function _select(PDO $pdo,$where=null,$orderby=null,$limit=null)
	{
		return $pdo->prepare('SELECT m.idMandateNature, m.code, m.name,m.isDisabled FROM MandateNature m '.
		($where != null ? ' WHERE '.$where : '').
		($orderby != null ? ' ORDER BY '.$orderby : '').
		($limit != null ? ' LIMIT '.$limit : ''));
	}

	/**
	 * Charger un(e) mandateNature
	 * @param $pdo PDO
	 * @param $idMandateNature int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateNature
	 */
	public static function load(PDO $pdo,$idMandateNature,$easyload=true)
	{
		// Déjà chargé(e) ?
		if (isset(MandateNature::$easyload[$idMandateNature])) {
			return MandateNature::$easyload[$idMandateNature];
		}

		// Charger le/la mandateNature
		$pdoStatement = MandateNature::_select($pdo,'m.idMandateNature = ?');
		if (!$pdoStatement->execute(array($idMandateNature))) {
			throw new Exception('Erreur lors du chargement d\'un(e) mandateNature depuis la base de données');
		}

		// Récupérer le/la mandateNature depuis le jeu de résultats
		return MandateNature::fetch($pdo,$pdoStatement,$easyload);
	}

	/**
	 * Charger tous/toutes les mandateNatures
	 * @param $pdo PDO
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateNature[] tableau de mandatenatures
	 */
	public static function loadAll(PDO $pdo,$seeIsDisabled=0,$easyload=false)
	{
		// Sélectionner tous/toutes les mandateNatures

		if($seeIsDisabled){
			$pdoStatement = MandateNature::selectAll($pdo);
		}else{
			$pdoStatement = MandateNature::selectAll($pdo,'m.isDisabled = 0','m.name');
		}

		// Mettre chaque mandateNature dans un tableau
		$mandateNatures = array();
		while ($mandateNature = MandateNature::fetch($pdo,$pdoStatement,$easyload)) {
			$mandateNatures[] = $mandateNature;
		}

		// Retourner le tableau
		//			var_dump($mandateNatures);
		return $mandateNatures;
	}

	/**
	 * Sélectionner tous/toutes les mandateNatures
	 * @param $pdo PDO
	 * @return PDOStatement
	 */
	public static function selectAll(PDO $pdo,$where=null,$orderBy=null)
	{
		$pdoStatement = MandateNature::_select($pdo,$where,$orderBy);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les mandateNatures depuis la base de données');
		}
		return $pdoStatement;
	}

	/**
	 * Récupère le/la mandateNature suivant(e) d'un jeu de résultats
	 * @param $pdo PDO
	 * @param $pdoStatement PDOStatement
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateNature
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idMandateNature,$code,$name,$isDisabled) = $values;
		//		echo $name;
		// Construire le/la mandateNature
		return isset(MandateNature::$easyload[$idMandateNature.'-'.$code.'-'.$name.'-'.$isDisabled]) ? MandateNature::$easyload[$idMandateNature.'-'.$code.'-'.$name.'-'.$isDisabled] :
		new MandateNature($pdo,$idMandateNature,$code,$name,$isDisabled,$easyload);
	}

	/**
	 * Serialiser
	 * @param $serialize bool activer la sérialisation ?
	 * @return string serialisation du/de la mandatenature
	 */
	public function serialize($serialize=true)
	{
		// Sérialiser le/la mandateNature
		$array = array('idMandateNature' => $this->idMandateNature,'code' => $this->code,'name' => $this->name,'isDisabled'=>$isDisabled);

		// Retourner la serialisation (ou pas) du/de la mandateNature
		return $serialize ? serialize($array) : $array;
	}

	/**
	 * Désérialiser
	 * @param $pdo PDO
	 * @param $string string serialisation du/de la mandatenature
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateNature
	 */
	public static function unserialize(PDO $pdo,$string,$easyload=true)
	{
		// Désérialiser la chaine de caractères
		$array = unserialize($string);

		// Construire le/la mandateNature
		return isset(MandateNature::$easyload[$array['idMandateNature']]) ? MandateNature::$easyload[$array['idMandateNature']] :
		new MandateNature($pdo,$array['idMandateNature'],$array['code'],$array['name'],$array['isDisabled'],$easyload);
	}

	/**
	 * Test d'égalité
	 * @param $mandateNature MandateNature
	 * @return bool les objets sont ils égaux ?
	 */
	public function equals($mandateNature)
	{
		// Test si null
		if ($mandateNature == null) { return false; }

		// Tester la classe
		if (!($mandateNature instanceof MandateNature)) { return false; }

		// Tester les ids
		return $this->idMandateNature == $mandateNature->idMandateNature;
	}

	/**
	 * Compter les mandateNatures
	 * @param $pdo PDO
	 * @return int nombre de mandatenatures
	 */
	public static function count(PDO $pdo)
	{
		if (!($pdoStatement = $pdo->query('SELECT COUNT(idMandateNature) FROM MandateNature'))) {
			throw new Exception('Erreur lors du comptage des mandateNatures dans la base de données');
		}
		return $pdoStatement->fetchColumn();
	}

	/**
	 * Supprimer le/la mandateNature
	 * @return bool opération réussie ?
	 */
	public function delete()
	{
		// Supprimer le/la mandateNature
		$pdoStatement = $this->pdo->prepare('DELETE FROM MandateNature WHERE idMandateNature = ?');
		if (!$pdoStatement->execute(array($this->getIdMandateNature()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) mandateNature dans la base de données');
		}

		// Opération réussie ?
		return $pdoStatement->rowCount() == 1;
	}

	/**
	 * Mettre à jour un champ dans la base de données
	 * @param $fields array
	 * @param $values array
	 * @return bool opération réussie ?
	 */
	private function _set($fields,$values)
	{
		// Préparer la mise à jour
		$updates = array();
		foreach ($fields as $field) {
			$updates[] = $field.' = ?';
		}

		// Mettre à jour le champ
		$pdoStatement = $this->pdo->prepare('UPDATE MandateNature SET '.implode(', ', $updates).' WHERE idMandateNature = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdMandateNature())))) {
			throw new Exception('Erreur lors de la mise à jour d\'un champ d\'un(e) mandateNature dans la base de données');
		}

		// Opération réussie ?
		return $pdoStatement->rowCount() == 1;
	}

	/**
	 * Mettre à jour tous les champs dans la base de données
	 * @return bool opération réussie ?
	 */
	public function update()
	{
		return $this->_set(array('code','name','isDisabled'),array($this->code,$this->name,$this->isDisabled));
	}

	/**
	 * Récupérer le/la idMandateNature
	 * @return int
	 */
	public function getIdMandateNature()
	{
		return $this->idMandateNature;
	}

	/**
	 * Récupérer le/la code
	 * @return string
	 */
	public function getCode()
	{
		return $this->code;
	}

	/**
	 * Définir le/la code
	 * @param $code string
	 * @param $execute bool exécuter la requête update ?
	 * @return bool opération réussie ?
	 */
	public function setCode($code,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->code = $code;

		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array('code'),array($code)) : true;
	}


	/**
	 * Récupérer le/la isDisabled
	 * @return string
	 */
	public function getIsDisabled()
	{
		return $this->isDisabled;
	}

	/**
	 * Définir le/la isDisabled
	 * @param $code string
	 * @param $execute bool exécuter la requête update ?
	 * @return bool opération réussie ?
	 */
	public function setIsDisabled($isDisabled,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->isDisabled = $isDisabled;

		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array('isDisabled'),array($isDisabled)) : true;
	}

	/**
	 * Récupérer le/la name
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Définir le/la name
	 * @param $name string
	 * @param $execute bool exécuter la requête update ?
	 * @return bool opération réussie ?
	 */
	public function setName($name,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->name = $name;

		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array('name'),array($name)) : true;
	}
	/**
	 * ToString
	 * @return string représentation de mandatenature sous la forme d'un string
	 */
	public function __toString()
	{
		return '[MandateNature idMandateNature="'.$this->idMandateNature.'" code="'.$this->code.'" name="'.$this->name.'"]';
	}

	/**
	 * R�cup�rer le/la idMandateInsulation
	 * @return int
	 */
	public function getId()
	{
		return $this->idMandateNature;
	}


	/**
	 * Compter les MandateNature
	 * @param $pdo PDO
	 * @param $name Nom à chercher
	 * @return int nombre de MandateNature
	 */
	public static function countByName(PDO $pdo,$name)
	{
		$pdoStatement = $pdo->prepare('SELECT COUNT(idMandateNature) FROM MandateNature WHERE name = ?');
		if (!($pdoStatement->execute( array($name)) )) {
			throw new Exception('Erreur lors du comptage des MandateNature dans la base de donn�es');
		}
		return($pdoStatement->fetchColumn());

	}
	/**
	 * Compter les MandateNature
	 * @param $pdo PDO
	 * @param $code Code à chercher
	 * @return int nombre de MandateNature
	 */
	public static function countByCode(PDO $pdo,$code)
	{
		$pdoStatement = $pdo->prepare('SELECT COUNT(idMandateNature) FROM MandateNature WHERE code = ?');
		if (!($pdoStatement->execute( array($code)) )) {
			throw new Exception('Erreur lors du comptage des MandateNature dans la base de donn�es');
		}
		return($pdoStatement->fetchColumn());

	}

}

