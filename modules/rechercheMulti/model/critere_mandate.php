<?php

/**
 * @class Critere_mandate
 * @date 09/08/2011 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class Critere_mandate
{
	/// @var PDO
	private $pdo;

	/// @var array tableau pour le chargement rapide
	private static $easyload;

	/// @var int
	private $idCritere_mandate;

	/// @var string
	private $nom;

	/// @var string
	private $champsCorrespondant;

	/// @var string
	private $type;

	/// @var string
	private $nameTable;

	/**
	 * Construire un(e) critere_mandate
	 * @param $pdo PDO
	 * @param $idCritere_mandate int
	 * @param $nom string
	 * @param $champsCorrespondant string
	 * @param $type string
	 * @param $nameTable string
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Critere_mandate
	 */
	protected function __construct(PDO $pdo,$idCritere_mandate,$nom,$champsCorrespondant,$type,$nameTable,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;

		// Sauvegarder les attributs
		$this->idCritere_mandate = $idCritere_mandate;
		$this->nom = $nom;
		$this->champsCorrespondant = $champsCorrespondant;
		$this->type = $type;
		$this->nameTable = $nameTable;

		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			Critere_mandate::$easyload[$idCritere_mandate] = $this;
		}
	}

	/**
	 * Créer un(e) critere_mandate
	 * @param $pdo PDO
	 * @param $nom string
	 * @param $champsCorrespondant string
	 * @param $type string
	 * @param $nameTable string
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Critere_mandate
	 */
	public static function create(PDO $pdo,$nom,$champsCorrespondant,$type,$nameTable,$easyload=true)
	{
		// Ajouter le/la critere_mandate dans la base de données
		$pdoStatement = $pdo->prepare('INSERT INTO Critere_mandate (nom,champsCorrespondant,type,nameTable) VALUES (?,?,?,?)');
		if (!$pdoStatement->execute(array($nom,$champsCorrespondant,$type,$nameTable))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) critere_mandate dans la base de données');
		}

		// Construire le/la critere_mandate
		return new Critere_mandate($pdo,$pdo->lastInsertId(),$nom,$champsCorrespondant,$type,$nameTable,$easyload);
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
		return $pdo->prepare('SELECT c.idCritere_mandate, c.nom, c.champsCorrespondant, c.type, c.nameTable FROM Critere_mandate c '.
		($where != null ? ' WHERE '.$where : '').
		($orderby != null ? ' ORDER BY '.$orderby : '').
		($limit != null ? ' LIMIT '.$limit : ''));
	}

	/**
	 * Charger un(e) critere_mandate
	 * @param $pdo PDO
	 * @param $idCritere_mandate int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Critere_mandate
	 */
	public static function load(PDO $pdo,$idCritere_mandate,$easyload=true)
	{
		// Déjà chargé(e) ?
		if (isset(Critere_mandate::$easyload[$idCritere_mandate])) {
			return Critere_mandate::$easyload[$idCritere_mandate];
		}

		// Charger le/la critere_mandate
		$pdoStatement = Critere_mandate::_select($pdo,'c.idCritere_mandate = ?');
		if (!$pdoStatement->execute(array($idCritere_mandate))) {
			throw new Exception('Erreur lors du chargement d\'un(e) critere_mandate depuis la base de données');
		}

		// Récupérer le/la critere_mandate depuis le jeu de résultats
		return Critere_mandate::fetch($pdo,$pdoStatement,$easyload);
	}

	/**
	 * Charger tous/toutes les critere_mandates
	 * @param $pdo PDO
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Critere_mandate[] tableau de critere_mandates
	 */
	public static function loadAll(PDO $pdo,$easyload=false)
	{
		// Sélectionner tous/toutes les critere_mandates
		$pdoStatement = Critere_mandate::selectAll($pdo);

		// Mettre chaque critere_mandate dans un tableau
		$critere_mandates = array();
		while ($critere_mandate = Critere_mandate::fetch($pdo,$pdoStatement,$easyload)) {
			$critere_mandates[] = $critere_mandate;
		}

		// Retourner le tableau
		return $critere_mandates;
	}

	/**
	 * Sélectionner tous/toutes les critere_mandates
	 * @param $pdo PDO
	 * @return PDOStatement
	 */
	public static function selectAll(PDO $pdo)
	{
		$pdoStatement = Critere_mandate::_select($pdo,'','c.nom');
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les critere_mandates depuis la base de données');
		}
		return $pdoStatement;
	}

	/**
	 * Récupère le/la critere_mandate suivant(e) d'un jeu de résultats
	 * @param $pdo PDO
	 * @param $pdoStatement PDOStatement
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Critere_mandate
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idCritere_mandate,$nom,$champsCorrespondant,$type,$nameTable) = $values;

		// Construire le/la critere_mandate
		return isset(Critere_mandate::$easyload[$idCritere_mandate.'-'.$nom.'-'.$champsCorrespondant.'-'.$type.'-'.$nameTable]) ? Critere_mandate::$easyload[$idCritere_mandate.'-'.$nom.'-'.$champsCorrespondant.'-'.$type.'-'.$nameTable] :
		new Critere_mandate($pdo,$idCritere_mandate,$nom,$champsCorrespondant,$type,$nameTable,$easyload);
	}

	/**
	 * Serialiser
	 * @param $serialize bool activer la sérialisation ?
	 * @return string serialisation du/de la critere_mandate
	 */
	public function serialize($serialize=true)
	{
		// Sérialiser le/la critere_mandate
		$array = array('idCritere_mandate' => $this->idCritere_mandate,'nom' => $this->nom,'champsCorrespondant' => $this->champsCorrespondant,'type' => $this->type,'nameTable' => $this->nameTable);

		// Retourner la serialisation (ou pas) du/de la critere_mandate
		return $serialize ? serialize($array) : $array;
	}

	/**
	 * Désérialiser
	 * @param $pdo PDO
	 * @param $string string serialisation du/de la critere_mandate
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Critere_mandate
	 */
	public static function unserialize(PDO $pdo,$string,$easyload=true)
	{
		// Désérialiser la chaine de caractères
		$array = unserialize($string);

		// Construire le/la critere_mandate
		return isset(Critere_mandate::$easyload[$array['idCritere_mandate']]) ? Critere_mandate::$easyload[$array['idCritere_mandate']] :
		new Critere_mandate($pdo,$array['idCritere_mandate'],$array['nom'],$array['champsCorrespondant'],$array['type'],$array['nameTable'],$easyload);
	}

	/**
	 * Test d'égalité
	 * @param $critere_mandate Critere_mandate
	 * @return bool les objets sont ils égaux ?
	 */
	public function equals($critere_mandate)
	{
		// Test si null
		if ($critere_mandate == null) { return false; }

		// Tester la classe
		if (!($critere_mandate instanceof Critere_mandate)) { return false; }

		// Tester les ids
		return $this->idCritere_mandate == $critere_mandate->idCritere_mandate;
	}

	/**
	 * Compter les critere_mandates
	 * @param $pdo PDO
	 * @return int nombre de critere_mandates
	 */
	public static function count(PDO $pdo)
	{
		if (!($pdoStatement = $pdo->query('SELECT COUNT(idCritere_mandate) FROM Critere_mandate'))) {
			throw new Exception('Erreur lors du comptage des critere_mandates dans la base de données');
		}
		return $pdoStatement->fetchColumn();
	}

	/**
	 * Supprimer le/la critere_mandate
	 * @return bool opération réussie ?
	 */
	public function delete()
	{
		// Supprimer le/la critere_mandate
		$pdoStatement = $this->pdo->prepare('DELETE FROM Critere_mandate WHERE idCritere_mandate = ?');
		if (!$pdoStatement->execute(array($this->getIdCritere_mandate()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) critere_mandate dans la base de données');
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
		$pdoStatement = $this->pdo->prepare('UPDATE Critere_mandate SET '.implode(', ', $updates).' WHERE idCritere_mandate = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdCritere_mandate())))) {
			throw new Exception('Erreur lors de la mise à jour d\'un champ d\'un(e) critere_mandate dans la base de données');
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
		return $this->_set(array('nom','champsCorrespondant','type','nameTable'),array($this->nom,$this->champsCorrespondant,$this->type,$this->nameTable));
	}

	/**
	 * Récupérer le/la idCritere_mandate
	 * @return int
	 */
	public function getIdCritere_mandate()
	{
		return $this->idCritere_mandate;
	}
public function getId()
	{
		return $this->idCritere_mandate;
	}
	
	/**
	 * Récupérer le/la nom
	 * @return string
	 */
	public function getNom()
	{
		return $this->nom;
	}

	/**
	 * Définir le/la nom
	 * @param $nom string
	 * @param $execute bool exécuter la requête update ?
	 * @return bool opération réussie ?
	 */
	public function setNom($nom,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->nom = $nom;

		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array('nom'),array($nom)) : true;
	}

	/**
	 * Récupérer le/la champsCorrespondant
	 * @return string
	 */
	public function getChampsCorrespondant()
	{
		return $this->champsCorrespondant;
	}

	/**
	 * Définir le/la champsCorrespondant
	 * @param $champsCorrespondant string
	 * @param $execute bool exécuter la requête update ?
	 * @return bool opération réussie ?
	 */
	public function setChampsCorrespondant($champsCorrespondant,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->champsCorrespondant = $champsCorrespondant;

		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array('champsCorrespondant'),array($champsCorrespondant)) : true;
	}

	/**
	 * Récupérer le/la type
	 * @return string
	 */
	public function getType()
	{
		return $this->type;
	}

	/**
	 * Définir le/la type
	 * @param $type string
	 * @param $execute bool exécuter la requête update ?
	 * @return bool opération réussie ?
	 */
	public function setType($type,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->type = $type;

		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array('type'),array($type)) : true;
	}

	/**
	 * Récupérer le/la nameTable
	 * @return string
	 */
	public function getNameTable()
	{
		return $this->nameTable;
	}

	/**
	 * Définir le/la nameTable
	 * @param $nameTable string
	 * @param $execute bool exécuter la requête update ?
	 * @return bool opération réussie ?
	 */
	public function setNameTable($nameTable,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->nameTable = $nameTable;

		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array('nameTable'),array($nameTable)) : true;
	}
	/**
	 * ToString
	 * @return string représentation de critere_mandate sous la forme d'un string
	 */
	public function __toString()
	{
		return '[Critere_mandate idCritere_mandate="'.$this->idCritere_mandate.'" nom="'.$this->nom.'" champsCorrespondant="'.$this->champsCorrespondant.'" type="'.$this->type.'" nameTable="'.$this->nameTable.'"]';
	}

}

