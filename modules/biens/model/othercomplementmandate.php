<?php

/**
 * @class OtherComplementMandate
 * @date 04/07/2011 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class OtherComplementMandate
{
	/// @var PDO
	private $pdo;

	/// @var array tableau pour le chargement rapide
	private static $easyload;

	/// @var int
	private $idOtherComplementMandate;

	/// @var bool
	private $afficheEnVitrine;

	/// @var int id de mandate
	private $mandate;

	/**
	 * Construire un(e) otherComplementMandate
	 * @param $pdo PDO
	 * @param $idOtherComplementMandate int
	 * @param $mandate int id de mandate
	 * @param $afficheEnVitrine bool
	 * @param $easyload bool activer le chargement rapide ?
	 * @return OtherComplementMandate
	 */
	protected function __construct(PDO $pdo,$idOtherComplementMandate,$mandate,$afficheEnVitrine=false,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;

		// Sauvegarder les attributs
		$this->idOtherComplementMandate = $idOtherComplementMandate;
		$this->mandate = $mandate;
		$this->afficheEnVitrine = $afficheEnVitrine;

		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			OtherComplementMandate::$easyload[$idOtherComplementMandate] = $this;
		}
	}

	/**
	 * Créer un(e) otherComplementMandate
	 * @param $pdo PDO
	 * @param $mandate Mandate
	 * @param $afficheEnVitrine bool
	 * @param $easyload bool activer le chargement rapide ?
	 * @return OtherComplementMandate
	 */
	public static function create(PDO $pdo,Mandate $mandate,$afficheEnVitrine=false,$easyload=true)
	{
		// Ajouter le/la otherComplementMandate dans la base de données
		$pdoStatement = $pdo->prepare('INSERT INTO OtherComplementMandate (mandate_idMandate,afficheEnVitrine) VALUES (?,?)');
		if (!$pdoStatement->execute(array($mandate->getIdMandate(),$afficheEnVitrine))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) otherComplementMandate dans la base de données');
		}

		// Construire le/la otherComplementMandate
		return new OtherComplementMandate($pdo,$pdo->lastInsertId(),$mandate->getIdMandate(),$afficheEnVitrine,$easyload);
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
		return $pdo->prepare('SELECT o.idOtherComplementMandate, o.mandate_idMandate, o.afficheEnVitrine FROM OtherComplementMandate o '.
		($where != null ? ' WHERE '.$where : '').
		($orderby != null ? ' ORDERBY '.$orderby : '').
		($limit != null ? ' LIMIT '.$limit : ''));
	}

	/**
	 * Charger un(e) otherComplementMandate
	 * @param $pdo PDO
	 * @param $idOtherComplementMandate int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return OtherComplementMandate
	 */
	public static function loadByMandate(PDO $pdo,Mandate $mandate,$easyload=true)
	{
		// Déjà chargé(e) ?


		// Charger le/la otherComplementMandate
		$pdoStatement = OtherComplementMandate::_select($pdo,'o.mandate_idMandate = ?');
		if (!$pdoStatement->execute(array($mandate->getIdMandate()))) {
			throw new Exception('Erreur lors du chargement d\'un(e) otherComplementMandate depuis la base de données');
		}

		// Récupérer le/la otherComplementMandate depuis le jeu de résultats
		return OtherComplementMandate::fetch($pdo,$pdoStatement,$easyload);
	}


	public static function load(PDO $pdo,$idOtherComplementMandate,$easyload=true)
	{
		// Déjà chargé(e) ?
		if (isset(OtherComplementMandate::$easyload[$idOtherComplementMandate])) {
			return OtherComplementMandate::$easyload[$idOtherComplementMandate];
		}

		// Charger le/la otherComplementMandate
		$pdoStatement = OtherComplementMandate::_select($pdo,'o.idOtherComplementMandate = ?');
		if (!$pdoStatement->execute(array($idOtherComplementMandate))) {
			throw new Exception('Erreur lors du chargement d\'un(e) otherComplementMandate depuis la base de données');
		}

		// Récupérer le/la otherComplementMandate depuis le jeu de résultats
		return OtherComplementMandate::fetch($pdo,$pdoStatement,$easyload);
	}


	/**
	 * Charger tous/toutes les otherComplementMandates
	 * @param $pdo PDO
	 * @param $easyload bool activer le chargement rapide ?
	 * @return OtherComplementMandate[] tableau de othercomplementmandates
	 */
	public static function loadAll(PDO $pdo,$easyload=false)
	{
		// Sélectionner tous/toutes les otherComplementMandates
		$pdoStatement = OtherComplementMandate::selectAll($pdo);

		// Mettre chaque otherComplementMandate dans un tableau
		$otherComplementMandates = array();
		while ($otherComplementMandate = OtherComplementMandate::fetch($pdo,$pdoStatement,$easyload)) {
			$otherComplementMandates[] = $otherComplementMandate;
		}

		// Retourner le tableau
		return $otherComplementMandates;
	}

	/**
	 * Sélectionner tous/toutes les otherComplementMandates
	 * @param $pdo PDO
	 * @return PDOStatement
	 */
	public static function selectAll(PDO $pdo)
	{
		$pdoStatement = OtherComplementMandate::_select($pdo);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les otherComplementMandates depuis la base de données');
		}
		return $pdoStatement;
	}

	/**
	 * Récupère le/la otherComplementMandate suivant(e) d'un jeu de résultats
	 * @param $pdo PDO
	 * @param $pdoStatement PDOStatement
	 * @param $easyload bool activer le chargement rapide ?
	 * @return OtherComplementMandate
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idOtherComplementMandate,$mandate,$afficheEnVitrine) = $values;

		// Construire le/la otherComplementMandate
		return isset(OtherComplementMandate::$easyload[$idOtherComplementMandate.'-'.$mandate.'-'.$afficheEnVitrine]) ? OtherComplementMandate::$easyload[$idOtherComplementMandate.'-'.$mandate.'-'.$afficheEnVitrine] :
		new OtherComplementMandate($pdo,$idOtherComplementMandate,$mandate,$afficheEnVitrine,$easyload);
	}

	/**
	 * Serialiser
	 * @param $serialize bool activer la sérialisation ?
	 * @return string serialisation du/de la othercomplementmandate
	 */
	public function serialize($serialize=true)
	{
		// Sérialiser le/la otherComplementMandate
		$array = array('idOtherComplementMandate' => $this->idOtherComplementMandate,'mandate' => $this->mandate,'afficheEnVitrine' => $this->afficheEnVitrine);

		// Retourner la serialisation (ou pas) du/de la otherComplementMandate
		return $serialize ? serialize($array) : $array;
	}

	/**
	 * Désérialiser
	 * @param $pdo PDO
	 * @param $string string serialisation du/de la othercomplementmandate
	 * @param $easyload bool activer le chargement rapide ?
	 * @return OtherComplementMandate
	 */
	public static function unserialize(PDO $pdo,$string,$easyload=true)
	{
		// Désérialiser la chaine de caractères
		$array = unserialize($string);

		// Construire le/la otherComplementMandate
		return isset(OtherComplementMandate::$easyload[$array['idOtherComplementMandate']]) ? OtherComplementMandate::$easyload[$array['idOtherComplementMandate']] :
		new OtherComplementMandate($pdo,$array['idOtherComplementMandate'],$array['mandate'],$array['afficheEnVitrine'],$easyload);
	}

	/**
	 * Test d'égalité
	 * @param $otherComplementMandate OtherComplementMandate
	 * @return bool les objets sont ils égaux ?
	 */
	public function equals($otherComplementMandate)
	{
		// Test si null
		if ($otherComplementMandate == null) { return false; }

		// Tester la classe
		if (!($otherComplementMandate instanceof OtherComplementMandate)) { return false; }

		// Tester les ids
		return $this->idOtherComplementMandate == $otherComplementMandate->idOtherComplementMandate;
	}

	/**
	 * Compter les otherComplementMandates
	 * @param $pdo PDO
	 * @return int nombre de othercomplementmandates
	 */
	public static function count(PDO $pdo)
	{
		if (!($pdoStatement = $pdo->query('SELECT COUNT(idOtherComplementMandate) FROM OtherComplementMandate'))) {
			throw new Exception('Erreur lors du comptage des otherComplementMandates dans la base de données');
		}
		return $pdoStatement->fetchColumn();
	}

	/**
	 * Supprimer le/la otherComplementMandate
	 * @return bool opération réussie ?
	 */
	public function delete()
	{
		// Supprimer le/la otherComplementMandate
		$pdoStatement = $this->pdo->prepare('DELETE FROM OtherComplementMandate WHERE idOtherComplementMandate = ?');
		if (!$pdoStatement->execute(array($this->getIdOtherComplementMandate()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) otherComplementMandate dans la base de données');
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
		$pdoStatement = $this->pdo->prepare('UPDATE OtherComplementMandate SET '.implode(', ', $updates).' WHERE idOtherComplementMandate = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdOtherComplementMandate())))) {
			throw new Exception('Erreur lors de la mise à jour d\'un champ d\'un(e) otherComplementMandate dans la base de données');
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
		return $this->_set(array('afficheEnVitrine','mandate_idMandate'),array($this->afficheEnVitrine,$this->mandate));
	}

	/**
	 * Récupérer le/la idOtherComplementMandate
	 * @return int
	 */
	public function getIdOtherComplementMandate()
	{
		return $this->idOtherComplementMandate;
	}
	public function getId()
	{
		return $this->idOtherComplementMandate;
	}
	/**
	 * Récupérer le/la afficheEnVitrine
	 * @return bool
	 */
	public function getAfficheEnVitrine()
	{
		return $this->afficheEnVitrine;
	}

	/**
	 * Définir le/la afficheEnVitrine
	 * @param $afficheEnVitrine bool
	 * @param $execute bool exécuter la requête update ?
	 * @return bool opération réussie ?
	 */
	public function setAfficheEnVitrine($afficheEnVitrine,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->afficheEnVitrine = $afficheEnVitrine;

		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array('afficheEnVitrine'),array($afficheEnVitrine)) : true;
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
	 * Sélectionner les otherComplementMandates par mandate
	 * @param $pdo PDO
	 * @param $mandate Mandate
	 * @return PDOStatement
	 */
	public static function selectByMandate(PDO $pdo,Mandate $mandate)
	{
		$pdoStatement = $pdo->prepare('SELECT o.idOtherComplementMandate, o.mandate_idMandate, o.afficheEnVitrine FROM OtherComplementMandate o WHERE o.mandate_idMandate = ?');
		if (!$pdoStatement->execute(array($mandate->getIdMandate()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les otherComplementMandates par mandate depuis la base de données');
		}
		return $pdoStatement;
	}
	/**
	 * ToString
	 * @return string représentation de othercomplementmandate sous la forme d'un string
	 */
	public function __toString()
	{
		return '[OtherComplementMandate idOtherComplementMandate="'.$this->idOtherComplementMandate.'" afficheEnVitrine="'.($this->afficheEnVitrine?'true':'false').'" mandate="'.$this->mandate.'"]';
	}

}

