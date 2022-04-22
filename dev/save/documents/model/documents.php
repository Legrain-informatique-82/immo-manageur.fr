<?php

/**
 * @class Documents
 * @date 17/03/2011 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class Documents
{
	/// @var PDO
	private $pdo;

	/// @var array tableau pour le chargement rapide
	private static $easyload;

	/// @var int
	private $idDocument;

	/// @var string
	private $sizetext;

	/// @var string
	private $corps;

	/// @var string
	private $other;

	/**
	 * Construire un(e) documents
	 * @param $pdo PDO
	 * @param $idDocument int
	 * @param $sizetext string
	 * @param $corps string
	 * @param $other string
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Documents
	 */
	protected function __construct(PDO $pdo,$idDocument,$sizetext,$corps,$other,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;

		// Sauvegarder les attributs
		$this->idDocument = $idDocument;
		$this->sizetext = $sizetext;
		$this->corps = $corps;
		$this->other = $other;

		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			Documents::$easyload[$idDocument] = $this;
		}
	}

	/**
	 * Créer un(e) documents
	 * @param $pdo PDO
	 * @param $sizetext string
	 * @param $corps string
	 * @param $other string
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Documents
	 */
	public static function create(PDO $pdo,$sizetext,$corps,$other,$easyload=true)
	{
		// Ajouter le/la documents dans la base de données
		$pdoStatement = $pdo->prepare('INSERT INTO Documents (sizetext,corps,other) VALUES (?,?,?)');
		if (!$pdoStatement->execute(array($sizetext,$corps,$other))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) documents dans la base de données');
		}

		// Construire le/la documents
		return new Documents($pdo,$pdo->lastInsertId(),$sizetext,$corps,$other,$easyload);
	}
	public static function createId(PDO $pdo,$id){
	$pdoStatement = $pdo->prepare('INSERT INTO Documents (idDocument,sizetext,corps,other) VALUES (?,12,"","")');
		if (!$pdoStatement->execute(array($id))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) documents dans la base de données');
		}

		// Construire le/la documents
		return new Documents($pdo,$pdo->lastInsertId(),'12','','',$easyload);
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
		return $pdo->prepare('SELECT d.idDocument, d.sizetext, d.corps, d.other FROM Documents d '.
		($where != null ? ' WHERE '.$where : '').
		($orderby != null ? ' ORDERBY '.$orderby : '').
		($limit != null ? ' LIMIT '.$limit : ''));
	}

	/**
	 * Charger un(e) documents
	 * @param $pdo PDO
	 * @param $idDocument int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Documents
	 */
	public static function load(PDO $pdo,$idDocument,$easyload=true)
	{
		// Déjà chargé(e) ?
		if (isset(Documents::$easyload[$idDocument])) {
			return Documents::$easyload[$idDocument];
		}

		// Charger le/la documents
		$pdoStatement = Documents::_select($pdo,'d.idDocument = ?');
		if (!$pdoStatement->execute(array($idDocument))) {
			throw new Exception('Erreur lors du chargement d\'un(e) documents depuis la base de données');
		}

		// Récupérer le/la documents depuis le jeu de résultats
		return Documents::fetch($pdo,$pdoStatement,$easyload);
	}

	/**
	 * Charger tous/toutes les documents
	 * @param $pdo PDO
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Documents[] tableau de documents
	 */
	public static function loadAll(PDO $pdo,$easyload=false)
	{
		// Sélectionner tous/toutes les documents
		$pdoStatement = Documents::selectAll($pdo);

		// Mettre chaque documents dans un tableau
		$array = array();
		while ($documents = Documents::fetch($pdo,$pdoStatement,$easyload)) {
			$array[] = $documents;
		}

		// Retourner le tableau
		return $array;
	}

	/**
	 * Sélectionner tous/toutes les documents
	 * @param $pdo PDO
	 * @return PDOStatement
	 */
	public static function selectAll(PDO $pdo)
	{
		$pdoStatement = Documents::_select($pdo);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les documents depuis la base de données');
		}
		return $pdoStatement;
	}

	/**
	 * Récupère le/la documents suivant(e) d'un jeu de résultats
	 * @param $pdo PDO
	 * @param $pdoStatement PDOStatement
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Documents
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idDocument,$sizetext,$corps,$other) = $values;

		// Construire le/la documents
		return isset(Documents::$easyload[$idDocument.'-'.$sizetext.'-'.$corps.'-'.$other]) ? Documents::$easyload[$idDocument.'-'.$sizetext.'-'.$corps.'-'.$other] :
		new Documents($pdo,$idDocument,$sizetext,$corps,$other,$easyload);
	}

	/**
	 * Serialiser
	 * @param $serialize bool activer la sérialisation ?
	 * @return string serialisation du/de la documents
	 */
	public function serialize($serialize=true)
	{
		// Sérialiser le/la documents
		$array = array('idDocument' => $this->idDocument,'sizetext' => $this->sizetext,'corps' => $this->corps,'other' => $this->other);

		// Retourner la serialisation (ou pas) du/de la documents
		return $serialize ? serialize($array) : $array;
	}

	/**
	 * Désérialiser
	 * @param $pdo PDO
	 * @param $string string serialisation du/de la documents
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Documents
	 */
	public static function unserialize(PDO $pdo,$string,$easyload=true)
	{
		// Désérialiser la chaine de caractères
		$array = unserialize($string);

		// Construire le/la documents
		return isset(Documents::$easyload[$array['idDocument']]) ? Documents::$easyload[$array['idDocument']] :
		new Documents($pdo,$array['idDocument'],$array['sizetext'],$array['corps'],$array['other'],$easyload);
	}

	/**
	 * Test d'égalité
	 * @param $documents Documents
	 * @return bool les objets sont ils égaux ?
	 */
	public function equals($documents)
	{
		// Test si null
		if ($documents == null) { return false; }

		// Tester la classe
		if (!($documents instanceof Documents)) { return false; }

		// Tester les ids
		return $this->idDocument == $documents->idDocument;
	}

	/**
	 * Compter les documents
	 * @param $pdo PDO
	 * @return int nombre de documents
	 */
	public static function count(PDO $pdo)
	{
		if (!($pdoStatement = $pdo->query('SELECT COUNT(idDocument) FROM Documents'))) {
			throw new Exception('Erreur lors du comptage des documents dans la base de données');
		}
		return $pdoStatement->fetchColumn();
	}

	/**
	 * Supprimer le/la documents
	 * @return bool opération réussie ?
	 */
	public function delete()
	{
		// Supprimer le/la documents
		$pdoStatement = $this->pdo->prepare('DELETE FROM Documents WHERE idDocument = ?');
		if (!$pdoStatement->execute(array($this->getidDocument()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) documents dans la base de données');
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
		$pdoStatement = $this->pdo->prepare('UPDATE Documents SET '.implode(', ', $updates).' WHERE idDocument = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getidDocument())))) {
			throw new Exception('Erreur lors de la mise à jour d\'un champ d\'un(e) documents dans la base de données');
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
		return $this->_set(array('sizetext','corps','other'),array($this->sizetext,$this->corps,$this->other));
	}

	/**
	 * Récupérer le/la idDocument
	 * @return int
	 */
	public function getidDocument()
	{
		return $this->idDocument;
	}
	public function getid()
	{
		return $this->idDocument;
	}
	/**
	 * Récupérer le/la sizetext
	 * @return string
	 */
	public function getSizetext()
	{
		return $this->sizetext;
	}

	/**
	 * Définir le/la sizetext
	 * @param $sizetext string
	 * @param $execute bool exécuter la requête update ?
	 * @return bool opération réussie ?
	 */
	public function setSizetext($sizetext,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->sizetext = $sizetext;

		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array('sizetext'),array($sizetext)) : true;
	}

	/**
	 * Récupérer le/la corps
	 * @return string
	 */
	public function getCorps()
	{
		return $this->corps;
	}

	/**
	 * Définir le/la corps
	 * @param $corps string
	 * @param $execute bool exécuter la requête update ?
	 * @return bool opération réussie ?
	 */
	public function setCorps($corps,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->corps = $corps;

		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array('corps'),array($corps)) : true;
	}

	/**
	 * Récupérer le/la other
	 * @return string
	 */
	public function getOther()
	{
		return $this->other;
	}

	/**
	 * Définir le/la other
	 * @param $other string
	 * @param $execute bool exécuter la requête update ?
	 * @return bool opération réussie ?
	 */
	public function setOther($other,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->other = $other;

		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array('other'),array($other)) : true;
	}
	/**
	 * ToString
	 * @return string représentation de documents sous la forme d'un string
	 */
	public function __toString()
	{
		return '[Documents idDocument="'.$this->idDocument.'" sizetext="'.$this->sizetext.'" corps="'.$this->corps.'" other="'.$this->other.'"]';
	}

}
