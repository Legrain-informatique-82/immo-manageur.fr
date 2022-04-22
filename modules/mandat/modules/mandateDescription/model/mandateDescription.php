<?php

/**
 * @class MandateDescription
 * @date 17/06/2011 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class MandateDescription
{
	/// @var PDO
	private $pdo;

	/// @var array tableau pour le chargement rapide
	private static $easyload;

	/// @var int
	private $idMandateDescription;

	/// @var int id de mandate
	private $mandate;

	/// @var int
	private $niveau;

	/// @var string
	private $piece;

	/// @var int
	private $surface;

	/// @var string
	private $carac;

	/**
	 * Construire un(e) mandateDescription
	 * @param $pdo PDO
	 * @param $idMandateDescription int
	 * @param $mandate int id de mandate
	 * @param $niveau int
	 * @param $piece string
	 * @param $surface int
	 * @param $carac string
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateDescription
	 */
	protected function __construct(PDO $pdo,$idMandateDescription,$mandate,$niveau,$piece,$surface,$carac,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;

		// Sauvegarder les attributs
		$this->idMandateDescription = $idMandateDescription;
		$this->mandate = $mandate;
		$this->niveau = $niveau;
		$this->piece = $piece;
		$this->surface = $surface;
		$this->carac = $carac;

		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			MandateDescription::$easyload[$idMandateDescription] = $this;
		}
	}

	/**
	 * Créer un(e) mandateDescription
	 * @param $pdo PDO
	 * @param $mandate Mandate
	 * @param $niveau int
	 * @param $piece string
	 * @param $surface int
	 * @param $carac string
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateDescription
	 */
	public static function create(PDO $pdo,Mandate $mandate,$niveau,$piece,$surface,$carac,$easyload=true)
	{
		// Ajouter le/la mandateDescription dans la base de données
		$pdoStatement = $pdo->prepare('INSERT INTO MandateDescription (mandate_idMandate,niveau,piece,surface,carac) VALUES (?,?,?,?,?)');
		if (!$pdoStatement->execute(array($mandate->getIdMandate(),$niveau,$piece,$surface,$carac))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) mandateDescription dans la base de données');
		}

		// Construire le/la mandateDescription
		return new MandateDescription($pdo,$pdo->lastInsertId(),$mandate->getIdMandate(),$niveau,$piece,$surface,$carac,$easyload);
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
		return $pdo->prepare('SELECT m.idMandateDescription, m.mandate_idMandate, m.niveau, m.piece, m.surface, m.carac FROM MandateDescription m '.
		($where != null ? ' WHERE '.$where : '').
		($orderby != null ? ' ORDERBY '.$orderby : '').
		($limit != null ? ' LIMIT '.$limit : ''));
	}

	/**
	 * Charger un(e) mandateDescription
	 * @param $pdo PDO
	 * @param $idMandateDescription int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateDescription
	 */
	public static function load(PDO $pdo,$idMandateDescription,$easyload=true)
	{
		// Déjà chargé(e) ?
		if (isset(MandateDescription::$easyload[$idMandateDescription])) {
			return MandateDescription::$easyload[$idMandateDescription];
		}

		// Charger le/la mandateDescription
		$pdoStatement = MandateDescription::_select($pdo,'m.idMandateDescription = ?');
		if (!$pdoStatement->execute(array($idMandateDescription))) {
			throw new Exception('Erreur lors du chargement d\'un(e) mandateDescription depuis la base de données');
		}

		// Récupérer le/la mandateDescription depuis le jeu de résultats
		return MandateDescription::fetch($pdo,$pdoStatement,$easyload);
	}



	/**
	 * Charger tous/toutes les mandateDescriptions
	 * @param $pdo PDO
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateDescription[] tableau de mandatedescriptions
	 */
	public static function loadAll(PDO $pdo,$easyload=false)
	{
		// Sélectionner tous/toutes les mandateDescriptions
		$pdoStatement = MandateDescription::selectAll($pdo);

		// Mettre chaque mandateDescription dans un tableau
		$mandateDescriptions = array();
		while ($mandateDescription = MandateDescription::fetch($pdo,$pdoStatement,$easyload)) {
			$mandateDescriptions[] = $mandateDescription;
		}

		// Retourner le tableau
		return $mandateDescriptions;
	}

	/**
	 * Sélectionner tous/toutes les mandateDescriptions
	 * @param $pdo PDO
	 * @return PDOStatement
	 */
	public static function selectAll(PDO $pdo)
	{
		$pdoStatement = MandateDescription::_select($pdo);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les mandateDescriptions depuis la base de données');
		}
		return $pdoStatement;
	}

	/**
	 * Récupère le/la mandateDescription suivant(e) d'un jeu de résultats
	 * @param $pdo PDO
	 * @param $pdoStatement PDOStatement
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateDescription
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idMandateDescription,$mandate,$niveau,$piece,$surface,$carac) = $values;

		// Construire le/la mandateDescription
		return isset(MandateDescription::$easyload[$idMandateDescription.'-'.$mandate.'-'.$niveau.'-'.$piece.'-'.$surface.'-'.$carac]) ? MandateDescription::$easyload[$idMandateDescription.'-'.$mandate.'-'.$niveau.'-'.$piece.'-'.$surface.'-'.$carac] :
		new MandateDescription($pdo,$idMandateDescription,$mandate,$niveau,$piece,$surface,$carac,$easyload);
	}

	/**
	 * Serialiser
	 * @param $serialize bool activer la sérialisation ?
	 * @return string serialisation du/de la mandatedescription
	 */
	public function serialize($serialize=true)
	{
		// Sérialiser le/la mandateDescription
		$array = array('idMandateDescription' => $this->idMandateDescription,'mandate' => $this->mandate,'niveau' => $this->niveau,'piece' => $this->piece,'surface' => $this->surface,'carac' => $this->carac);

		// Retourner la serialisation (ou pas) du/de la mandateDescription
		return $serialize ? serialize($array) : $array;
	}

	/**
	 * Désérialiser
	 * @param $pdo PDO
	 * @param $string string serialisation du/de la mandatedescription
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateDescription
	 */
	public static function unserialize(PDO $pdo,$string,$easyload=true)
	{
		// Désérialiser la chaine de caractères
		$array = unserialize($string);

		// Construire le/la mandateDescription
		return isset(MandateDescription::$easyload[$array['idMandateDescription']]) ? MandateDescription::$easyload[$array['idMandateDescription']] :
		new MandateDescription($pdo,$array['idMandateDescription'],$array['mandate'],$array['niveau'],$array['piece'],$array['surface'],$array['carac'],$easyload);
	}

	/**
	 * Test d'égalité
	 * @param $mandateDescription MandateDescription
	 * @return bool les objets sont ils égaux ?
	 */
	public function equals($mandateDescription)
	{
		// Test si null
		if ($mandateDescription == null) { return false; }

		// Tester la classe
		if (!($mandateDescription instanceof MandateDescription)) { return false; }

		// Tester les ids
		return $this->idMandateDescription == $mandateDescription->idMandateDescription;
	}

	/**
	 * Compter les mandateDescriptions
	 * @param $pdo PDO
	 * @return int nombre de mandatedescriptions
	 */
	public static function count(PDO $pdo)
	{
		if (!($pdoStatement = $pdo->query('SELECT COUNT(idMandateDescription) FROM MandateDescription'))) {
			throw new Exception('Erreur lors du comptage des mandateDescriptions dans la base de données');
		}
		return $pdoStatement->fetchColumn();
	}

	/**
	 * Supprimer le/la mandateDescription
	 * @return bool opération réussie ?
	 */
	public function delete()
	{
		// Supprimer le/la mandateDescription
		$pdoStatement = $this->pdo->prepare('DELETE FROM MandateDescription WHERE idMandateDescription = ?');
		if (!$pdoStatement->execute(array($this->getIdMandateDescription()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) mandateDescription dans la base de données');
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
		$pdoStatement = $this->pdo->prepare('UPDATE MandateDescription SET '.implode(', ', $updates).' WHERE idMandateDescription = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdMandateDescription())))) {
			throw new Exception('Erreur lors de la mise à jour d\'un champ d\'un(e) mandateDescription dans la base de données');
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
		return $this->_set(array('mandate_idMandate','niveau','piece','surface','carac'),array($this->mandate,$this->niveau,$this->piece,$this->surface,$this->carac));
	}

	/**
	 * Récupérer le/la idMandateDescription
	 * @return int
	 */
	public function getIdMandateDescription()
	{
		return $this->idMandateDescription;
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
	 * Sélectionner les mandateDescriptions par mandate
	 * @param $pdo PDO
	 * @param $mandate Mandate
	 * @return PDOStatement
	 */
	public static function selectByMandate(PDO $pdo,Mandate $mandate)
	{
		$pdoStatement = $pdo->prepare('SELECT m.idMandateDescription, m.mandate_idMandate, m.niveau, m.piece, m.surface, m.carac FROM MandateDescription m WHERE m.mandate_idMandate = ? ORDER BY m.niveau, m.piece');
		if (!$pdoStatement->execute(array($mandate->getIdMandate()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les mandateDescriptions par mandate depuis la base de données');
		}
		return $pdoStatement;
	}

	/**
	 * Charger un(e) mandateDescription
	 * @param $pdo PDO
	 * @param $idMandateDescription int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateDescription
	 */
	public static function loadByMandate(PDO $pdo,Mandate $mandate,$easyload=true)
	{

		// Charger le/la mandateDescription
		$pdoStatement = MandateDescription::selectByMandate($pdo, $mandate  );

		$list = array();
		while($row = MandateDescription::fetch($pdo,$pdoStatement)){
			$list[]=$row;
		}

		// Récupérer le/la mandateDescription depuis le jeu de résultats
		return $list;
	}

	/**
	 * Récupérer le/la niveau
	 * @return int
	 */
	public function getNiveau()
	{
		return $this->niveau;
	}

	/**
	 * Définir le/la niveau
	 * @param $niveau int
	 * @param $execute bool exécuter la requête update ?
	 * @return bool opération réussie ?
	 */
	public function setNiveau($niveau,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->niveau = $niveau;

		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array('niveau'),array($niveau)) : true;
	}

	/**
	 * Récupérer le/la piece
	 * @return string
	 */
	public function getPiece()
	{
		return $this->piece;
	}

	/**
	 * Définir le/la piece
	 * @param $piece string
	 * @param $execute bool exécuter la requête update ?
	 * @return bool opération réussie ?
	 */
	public function setPiece($piece,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->piece = $piece;

		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array('piece'),array($piece)) : true;
	}

	/**
	 * Récupérer le/la surface
	 * @return int
	 */
	public function getSurface()
	{
		return $this->surface;
	}

	/**
	 * Définir le/la surface
	 * @param $surface int
	 * @param $execute bool exécuter la requête update ?
	 * @return bool opération réussie ?
	 */
	public function setSurface($surface,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->surface = $surface;

		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array('surface'),array($surface)) : true;
	}

	/**
	 * Récupérer le/la carac
	 * @return string
	 */
	public function getCarac()
	{
		return $this->carac;
	}

	/**
	 * Définir le/la carac
	 * @param $carac string
	 * @param $execute bool exécuter la requête update ?
	 * @return bool opération réussie ?
	 */
	public function setCarac($carac,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->carac = $carac;

		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array('carac'),array($carac)) : true;
	}
	/**
	 * ToString
	 * @return string représentation de mandatedescription sous la forme d'un string
	 */
	public function __toString()
	{
		return '[MandateDescription idMandateDescription="'.$this->idMandateDescription.'" mandate="'.$this->mandate.'" niveau="'.$this->niveau.'" piece="'.$this->piece.'" surface="'.$this->surface.'" carac="'.$this->carac.'"]';
	}

}
