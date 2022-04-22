<?php

/**
 * @class SellerTitle
 * @date 07/02/2011 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class SellerTitle
{
	/// @var PDO
	private $pdo;

	/// @var array tableau pour le chargement rapide
	private static $easyload;

	/// @var int
	private $idSellerTitle;

	/// @var string
	private $libel;

	/**
	 * Construire un(e) sellerTitle
	 * @param $pdo PDO
	 * @param $idSellerTitle int
	 * @param $libel string
	 * @param $easyload bool activer le chargement rapide ?
	 * @return SellerTitle
	 */
	protected function __construct(PDO $pdo,$idSellerTitle,$libel,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;

		// Sauvegarder les attributs
		$this->idSellerTitle = $idSellerTitle;
		$this->libel = $libel;

		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			SellerTitle::$easyload[$idSellerTitle] = $this;
		}
	}

	/**
	 * Créer un(e) sellerTitle
	 * @param $pdo PDO
	 * @param $libel string
	 * @param $easyload bool activer le chargement rapide ?
	 * @return SellerTitle
	 */
	public static function create(PDO $pdo,$libel,$easyload=true)
	{
		// Ajouter le/la sellerTitle dans la base de données
		$pdoStatement = $pdo->prepare('INSERT INTO SellerTitle (libel) VALUES (?)');
		if (!$pdoStatement->execute(array($libel))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) sellerTitle dans la base de données');
		}

		// Construire le/la sellerTitle
		return new SellerTitle($pdo,$pdo->lastInsertId(),$libel,$easyload);
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
		return $pdo->prepare('SELECT s.idSellerTitle, s.libel FROM SellerTitle s '.
		($where != null ? ' WHERE '.$where : '').
		($orderby != null ? ' ORDERBY '.$orderby : '').
		($limit != null ? ' LIMIT '.$limit : ''));
	}

	/**
	 * Charger un(e) sellerTitle
	 * @param $pdo PDO
	 * @param $idSellerTitle int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return SellerTitle
	 */
	public static function load(PDO $pdo,$idSellerTitle,$easyload=true)
	{
		// Déjà chargé(e) ?
		if (isset(SellerTitle::$easyload[$idSellerTitle])) {
			return SellerTitle::$easyload[$idSellerTitle];
		}

		// Charger le/la sellerTitle
		$pdoStatement = SellerTitle::_select($pdo,'s.idSellerTitle = ?');
		if (!$pdoStatement->execute(array($idSellerTitle))) {
			throw new Exception('Erreur lors du chargement d\'un(e) sellerTitle depuis la base de données');
		}

		// Récupérer le/la sellerTitle depuis le jeu de résultats
		return SellerTitle::fetch($pdo,$pdoStatement,$easyload);
	}

	/**
	 * Charger tous/toutes les sellerTitles
	 * @param $pdo PDO
	 * @param $easyload bool activer le chargement rapide ?
	 * @return SellerTitle[] tableau de sellertitles
	 */
	public static function loadAll(PDO $pdo,$easyload=false)
	{
		// Sélectionner tous/toutes les sellerTitles
		$pdoStatement = SellerTitle::selectAll($pdo);

		// Mettre chaque sellerTitle dans un tableau
		$sellerTitles = array();
		while ($sellerTitle = SellerTitle::fetch($pdo,$pdoStatement,$easyload)) {
			$sellerTitles[] = $sellerTitle;
		}

		// Retourner le tableau
		return $sellerTitles;
	}

	/**
	 * Sélectionner tous/toutes les sellerTitles
	 * @param $pdo PDO
	 * @return PDOStatement
	 */
	public static function selectAll(PDO $pdo)
	{
		$pdoStatement = SellerTitle::_select($pdo);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les sellerTitles depuis la base de données');
		}
		return $pdoStatement;
	}

	/**
	 * Récupère le/la sellerTitle suivant(e) d'un jeu de résultats
	 * @param $pdo PDO
	 * @param $pdoStatement PDOStatement
	 * @param $easyload bool activer le chargement rapide ?
	 * @return SellerTitle
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idSellerTitle,$libel) = $values;

		// Construire le/la sellerTitle
		return isset(SellerTitle::$easyload[$idSellerTitle.'-'.$libel]) ? SellerTitle::$easyload[$idSellerTitle.'-'.$libel] :
		new SellerTitle($pdo,$idSellerTitle,$libel,$easyload);
	}

	/**
	 * Supprimer le/la sellerTitle
	 * @return bool opération réussie ?
	 */
	public function delete()
	{
		// Supprimer les Sellers associé(e)s
		$select = $this->selectSellers();
		while ($seller = Seller::fetch($this->pdo,$select)) {
			if (!$seller->delete()) { return false; }
		}

		// Supprimer le/la sellerTitle
		$pdoStatement = $this->pdo->prepare('DELETE FROM SellerTitle WHERE idSellerTitle = ?');
		if (!$pdoStatement->execute(array($this->getIdSellerTitle()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) sellerTitle dans la base de données');
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
		$pdoStatement = $this->pdo->prepare('UPDATE SellerTitle SET '.implode(', ', $updates).' WHERE idSellerTitle = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdSellerTitle())))) {
			throw new Exception('Erreur lors de la mise à jour d\'un champ d\'un(e) sellerTitle dans la base de données');
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
		return $this->_set(array('libel'),array($this->libel));
	}

	/**
	 * Récupérer le/la idSellerTitle
	 * @return int
	 */
	public function getIdSellerTitle()
	{
		return $this->idSellerTitle;
	}
	public function getId()
	{
		return $this->idSellerTitle;
	}
	/**
	 * Récupérer le/la libel
	 * @return string
	 */
	public function getLibel()
	{
		return $this->libel;
	}

	/**
	 * Définir le/la libel
	 * @param $libel string
	 * @param $execute bool exécuter la requête update ?
	 * @return bool opération réussie ?
	 */
	public function setLibel($libel,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->libel = $libel;

		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array('libel'),array($libel)) : true;
	}

	/**
	 * Sélectionner les sellers
	 * @return PDOStatement
	 */
	public function selectSellers()
	{
		return Seller::selectBySellerTitle($this->pdo,$this);
	}
}

?>