<?php

/**
 * @class PhotosExports
 * @date 09/06/2011 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class PhotosExports
{
	/// @var PDO
	private $pdo;

	/// @var array tableau pour le chargement rapide
	private static $easyload;

	/// @var int
	private $idPhotosExports;

	/// @var string
	private $name;

	/// @var int
	private $position;

	/// @var int id de mandate
	private $mandate;

	/**
	 * Construire un(e) photosExports
	 * @param $pdo PDO
	 * @param $idPhotosExports int
	 * @param $name string
	 * @param $position int
	 * @param $mandate int id de mandate
	 * @param $easyload bool activer le chargement rapide ?
	 * @return PhotosExports
	 */
	protected function __construct(PDO $pdo,$idPhotosExports,$name,$position,$mandate,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;

		// Sauvegarder les attributs
		$this->idPhotosExports = $idPhotosExports;
		$this->name = $name;
		$this->position = $position;
		$this->mandate = $mandate;

		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			PhotosExports::$easyload[$idPhotosExports] = $this;
		}
	}

	/**
	 * Créer un(e) photosExports
	 * @param $pdo PDO
	 * @param $name string
	 * @param $position int
	 * @param $mandate Mandate
	 * @param $easyload bool activer le chargement rapide ?
	 * @return PhotosExports
	 */
	public static function create(PDO $pdo,$name,$position,Mandate $mandate,$easyload=true)
	{
		// Ajouter le/la photosExports dans la base de données
		$pdoStatement = $pdo->prepare('INSERT INTO PhotosExports (name,position,mandate_idMandate) VALUES (?,?,?)');
		if (!$pdoStatement->execute(array($name,$position,$mandate->getIdMandate()))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) photosExports dans la base de données');
		}

		// Construire le/la photosExports
		return new PhotosExports($pdo,$pdo->lastInsertId(),$name,$position,$mandate->getIdMandate(),$easyload);
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
		return $pdo->prepare('SELECT p.idPhotosExports, p.name, p.position, p.mandate_idMandate FROM PhotosExports p '.
		($where != null ? ' WHERE '.$where : '').
		($orderby != null ? ' ORDERBY '.$orderby : '').
		($limit != null ? ' LIMIT '.$limit : ''));
	}

	/**
	 * Charger un(e) photosExports
	 * @param $pdo PDO
	 * @param $idPhotosExports int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return PhotosExports
	 */
	public static function load(PDO $pdo,$idPhotosExports,$easyload=true)
	{
		// Déjà chargé(e) ?
		if (isset(PhotosExports::$easyload[$idPhotosExports])) {
			return PhotosExports::$easyload[$idPhotosExports];
		}

		// Charger le/la photosExports
		$pdoStatement = PhotosExports::_select($pdo,'p.idPhotosExports = ?');
		if (!$pdoStatement->execute(array($idPhotosExports))) {
			throw new Exception('Erreur lors du chargement d\'un(e) photosExports depuis la base de données');
		}

		// Récupérer le/la photosExports depuis le jeu de résultats
		return PhotosExports::fetch($pdo,$pdoStatement,$easyload);
	}

	/**
	 * Charger tous/toutes les photosExports
	 * @param $pdo PDO
	 * @param $easyload bool activer le chargement rapide ?
	 * @return PhotosExports[] tableau de photosexports
	 */
	public static function loadAll(PDO $pdo,$easyload=false)
	{
		// Sélectionner tous/toutes les photosExports
		$pdoStatement = PhotosExports::selectAll($pdo);

		// Mettre chaque photosExports dans un tableau
		$array = array();
		while ($photosExports = PhotosExports::fetch($pdo,$pdoStatement,$easyload)) {
			$array[] = $photosExports;
		}

		// Retourner le tableau
		return $array;
	}

	/**
	 * Sélectionner tous/toutes les photosExports
	 * @param $pdo PDO
	 * @return PDOStatement
	 */
	public static function selectAll(PDO $pdo)
	{
		$pdoStatement = PhotosExports::_select($pdo);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les photosExports depuis la base de données');
		}
		return $pdoStatement;
	}

	/**
	 * Récupère le/la photosExports suivant(e) d'un jeu de résultats
	 * @param $pdo PDO
	 * @param $pdoStatement PDOStatement
	 * @param $easyload bool activer le chargement rapide ?
	 * @return PhotosExports
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idPhotosExports,$name,$position,$mandate) = $values;

		// Construire le/la photosExports
		return isset(PhotosExports::$easyload[$idPhotosExports.'-'.$name.'-'.$position.'-'.$mandate]) ? PhotosExports::$easyload[$idPhotosExports.'-'.$name.'-'.$position.'-'.$mandate] :
		new PhotosExports($pdo,$idPhotosExports,$name,$position,$mandate,$easyload);
	}

	/**
	 * Serialiser
	 * @param $serialize bool activer la sérialisation ?
	 * @return string serialisation du/de la photosexports
	 */
	public function serialize($serialize=true)
	{
		// Sérialiser le/la photosExports
		$array = array('idPhotosExports' => $this->idPhotosExports,'name' => $this->name,'position' => $this->position,'mandate' => $this->mandate);

		// Retourner la serialisation (ou pas) du/de la photosExports
		return $serialize ? serialize($array) : $array;
	}

	/**
	 * Désérialiser
	 * @param $pdo PDO
	 * @param $string string serialisation du/de la photosexports
	 * @param $easyload bool activer le chargement rapide ?
	 * @return PhotosExports
	 */
	public static function unserialize(PDO $pdo,$string,$easyload=true)
	{
		// Désérialiser la chaine de caractères
		$array = unserialize($string);

		// Construire le/la photosExports
		return isset(PhotosExports::$easyload[$array['idPhotosExports']]) ? PhotosExports::$easyload[$array['idPhotosExports']] :
		new PhotosExports($pdo,$array['idPhotosExports'],$array['name'],$array['position'],$array['mandate'],$easyload);
	}

	/**
	 * Test d'égalité
	 * @param $photosExports PhotosExports
	 * @return bool les objets sont ils égaux ?
	 */
	public function equals($photosExports)
	{
		// Test si null
		if ($photosExports == null) { return false; }

		// Tester la classe
		if (!($photosExports instanceof PhotosExports)) { return false; }

		// Tester les ids
		return $this->idPhotosExports == $photosExports->idPhotosExports;
	}

	/**
	 * Compter les photosExports
	 * @param $pdo PDO
	 * @return int nombre de photosexports
	 */
	public static function count(PDO $pdo)
	{
		if (!($pdoStatement = $pdo->query('SELECT COUNT(idPhotosExports) FROM PhotosExports'))) {
			throw new Exception('Erreur lors du comptage des photosExports dans la base de données');
		}
		return $pdoStatement->fetchColumn();
	}

	/**
	 * Supprimer le/la photosExports
	 * @return bool opération réussie ?
	 */
	public function delete()
	{
		// Supprimer le/la photosExports
		$pdoStatement = $this->pdo->prepare('DELETE FROM PhotosExports WHERE idPhotosExports = ?');
		if (!$pdoStatement->execute(array($this->getIdPhotosExports()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) photosExports dans la base de données');
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
		$pdoStatement = $this->pdo->prepare('UPDATE PhotosExports SET '.implode(', ', $updates).' WHERE idPhotosExports = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdPhotosExports())))) {
			throw new Exception('Erreur lors de la mise à jour d\'un champ d\'un(e) photosExports dans la base de données');
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
		return $this->_set(array('name','position','mandate_idMandate'),array($this->name,$this->position,$this->mandate));
	}

	/**
	 * Récupérer le/la idPhotosExports
	 * @return int
	 */
	public function getIdPhotosExports()
	{
		return $this->idPhotosExports;
	}
	public function getId()
	{
		return $this->idPhotosExports;
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
	 * Récupérer le/la position
	 * @return int
	 */
	public function getPosition()
	{
		return $this->position;
	}

	/**
	 * Définir le/la position
	 * @param $position int
	 * @param $execute bool exécuter la requête update ?
	 * @return bool opération réussie ?
	 */
	public function setPosition($position,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->position = $position;

		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array('position'),array($position)) : true;
	}

	/**
	 * Récupérer le/la mandate
	 * @return Mandate
	 */
	public function getMandate()
	{
		return Mandate::load($this->pdo,$this->mandate);
	}

	/**
	 * Définir le/la mandate
	 * @param $mandate Mandate
	 * @param $execute bool exécuter la requête update ?
	 * @return bool opération réussie ?
	 */
	public function setMandate(Mandate $mandate,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->mandate = $mandate->getIdMandate();

		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array('mandate_idMandate'),array($mandate->getIdMandate())) : true;
	}

	/**
	 * Sélectionner les photosExports par mandate
	 * @param $pdo PDO
	 * @param $mandate Mandate
	 * @return PDOStatement
	 */
	public static function selectByMandate(PDO $pdo,Mandate $mandate)
	{
		$pdoStatement = $pdo->prepare('SELECT p.idPhotosExports, p.name, p.position, p.mandate_idMandate FROM PhotosExports p WHERE p.mandate_idMandate = ?');
		if (!$pdoStatement->execute(array($mandate->getIdMandate()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les photosExports par mandate depuis la base de données');
		}
		return $pdoStatement;
	}
	/**
	 * ToString
	 * @return string représentation de photosexports sous la forme d'un string
	 */
	public function __toString()
	{
		return '[PhotosExports idPhotosExports="'.$this->idPhotosExports.'" name="'.$this->name.'" position="'.$this->position.'" mandate="'.$this->mandate.'"]';
	}

	public function loadByMandate(PDO $pdo,Mandate $mandate){
		$pdoStatement = $pdo->prepare('SELECT p.idPhotosExports, p.name, p.position, p.mandate_idMandate FROM PhotosExports p WHERE p.mandate_idMandate = ? ORDER BY p.position');
		if (!$pdoStatement->execute(array($mandate->getIdMandate()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les photosExports par mandate depuis la base de données');
		}
		// Mettre chaque photosExports dans un tableau
		$array = array();
		while ($photosExports = PhotosExports::fetch($pdo,$pdoStatement,$easyload)) {
			$array[] = $photosExports;
		}

		// Retourner le tableau
		return $array;

	}

	public static function loadByNameAndMandate(PDO $pdo,$name,Mandate $mandate){
		$pdoStatement = $pdo->prepare('SELECT p.idPhotosExports, p.name, p.position, p.mandate_idMandate FROM PhotosExports p WHERE p.mandate_idMandate = ? AND name= ?');
		if (!$pdoStatement->execute(array($mandate->getIdMandate(),$name))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les photosExports par mandate depuis la base de données');
		}
		return PhotosExports::fetch($pdo,$pdoStatement);
	}
}

?>