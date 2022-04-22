<?php

/**
 * @class Upload
 * @date 08/04/2011 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class BddUpload
{
	/// @var PDO
	private $pdo;

	/// @var array tableau pour le chargement rapide
	private static $easyload;

	/// @var int
	private $idUpload;

	/// @var string
	private $name;

	/// @var string
	private $size;

	/// @var int id de mandate
	private $mandate;

	/**
	 * Construire un(e) upload
	 * @param $pdo PDO
	 * @param $idUpload int
	 * @param $name string
	 * @param $size string
	 * @param $mandate int id de mandate
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Upload
	 */
	protected function __construct(PDO $pdo,$idUpload,$name,$size,$mandate,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;

		// Sauvegarder les attributs
		$this->idUpload = $idUpload;
		$this->name = $name;
		$this->size = $size;
		$this->mandate = $mandate;

		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			BddUpload::$easyload[$idUpload] = $this;
		}
	}

	/**
	 * Cr�er un(e) upload
	 * @param $pdo PDO
	 * @param $name string
	 * @param $size string
	 * @param $mandate Mandate
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Upload
	 */
	public static function create(PDO $pdo,$name,$size,Mandate $mandate,$easyload=true)
	{
		// Ajouter le/la upload dans la base de donn�es
		$pdoStatement = $pdo->prepare('INSERT INTO Upload (name,size,mandate_idMandate) VALUES (?,?,?)');
		if (!$pdoStatement->execute(array($name,$size,$mandate->getIdMandate()))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) upload dans la base de donn�es');
		}

		// Construire le/la upload
		return new BddUpload($pdo,$pdo->lastInsertId(),$name,$size,$mandate->getIdMandate(),$easyload);
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
		return $pdo->prepare('SELECT u.idUpload, u.name, u.size, u.mandate_idMandate FROM Upload u '.
		($where != null ? ' WHERE '.$where : '').
		($orderby != null ? ' ORDERBY '.$orderby : '').
		($limit != null ? ' LIMIT '.$limit : ''));
	}

	/**
	 * Charger un(e) upload
	 * @param $pdo PDO
	 * @param $idUpload int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Upload
	 */
	public static function load(PDO $pdo,$idUpload,$easyload=true)
	{
		// D�j� charg�(e) ?
		if (isset(BddUpload::$easyload[$idUpload])) {
			return BddUpload::$easyload[$idUpload];
		}

		// Charger le/la upload
		$pdoStatement = BddUpload::_select($pdo,'u.idUpload = ?');
		if (!$pdoStatement->execute(array($idUpload))) {
			throw new Exception('Erreur lors du chargement d\'un(e) upload depuis la base de donn�es');
		}

		// R�cup�rer le/la upload depuis le jeu de r�sultats
		return BddUpload::fetch($pdo,$pdoStatement,$easyload);
	}

	/**
	 * Charger tous/toutes les uploads
	 * @param $pdo PDO
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Upload[] tableau de uploads
	 */
	public static function loadAll(PDO $pdo,$easyload=false)
	{
		// S�lectionner tous/toutes les uploads
		$pdoStatement = BddUpload::selectAll($pdo);

		// Mettre chaque upload dans un tableau
		$uploads = array();
		while ($upload = BddUpload::fetch($pdo,$pdoStatement,$easyload)) {
			$uploads[] = $upload;
		}

		// Retourner le tableau
		return $uploads;
	}

	/**
	 * S�lectionner tous/toutes les uploads
	 * @param $pdo PDO
	 * @return PDOStatement
	 */
	public static function selectAll(PDO $pdo)
	{
		$pdoStatement = BddUpload::_select($pdo);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les uploads depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�re le/la upload suivant(e) d'un jeu de r�sultats
	 * @param $pdo PDO
	 * @param $pdoStatement PDOStatement
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Upload
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idUpload,$name,$size,$mandate) = $values;

		// Construire le/la upload
		return isset(BddUpload::$easyload[$idUpload.'-'.$name.'-'.$size.'-'.$mandate]) ? BddUpload::$easyload[$idUpload.'-'.$name.'-'.$size.'-'.$mandate] :
		new BddUpload($pdo,$idUpload,$name,$size,$mandate,$easyload);
	}

	/**
	 * Supprimer le/la upload
	 * @return bool op�ration r�ussie ?
	 */
	public function delete()
	{
		// Supprimer le/la upload
		$pdoStatement = $this->pdo->prepare('DELETE FROM Upload WHERE idUpload = ?');
		if (!$pdoStatement->execute(array($this->getIdUpload()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) upload dans la base de donn�es');
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
		$pdoStatement = $this->pdo->prepare('UPDATE Upload SET '.implode(', ', $updates).' WHERE idUpload = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdUpload())))) {
			throw new Exception('Erreur lors de la mise � jour d\'un champ d\'un(e) upload dans la base de donn�es');
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
		return $this->_set(array('name','size','mandate_idMandate'),array($this->name,$this->size,$this->mandate));
	}

	/**
	 * R�cup�rer le/la idUpload
	 * @return int
	 */
	public function getIdUpload()
	{
		return $this->idUpload;
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
	 * R�cup�rer le/la size
	 * @return string
	 */
	public function getSize()
	{
		return $this->size;
	}

	/**
	 * D�finir le/la size
	 * @param $size string
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setSize($size,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->size = $size;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('size'),array($size)) : true;
	}

	/**
	 * R�cup�rer le/la mandate
	 * @return Mandate
	 */
	public function getMandate()
	{
		return Mandate::load($this->pdo,$this->mandate);
	}

	/**
	 * D�finir le/la mandate
	 * @param $mandate Mandate
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setMandate(Mandate $mandate,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->mandate = $mandate->getIdMandate();

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('mandate_idMandate'),array($mandate->getIdMandate())) : true;
	}

	/**
	 * S�lectionner les uploads par mandate
	 * @param $pdo PDO
	 * @param $mandate Mandate
	 * @return PDOStatement
	 */
	public static function selectByMandate(PDO $pdo,Mandate $mandate)
	{
		$pdoStatement = $pdo->prepare('SELECT u.idUpload, u.name, u.size, u.mandate_idMandate FROM Upload u WHERE u.mandate_idMandate = ?');
		if (!$pdoStatement->execute(array($mandate->getIdMandate()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les uploads par mandate depuis la base de donn�es');
		}
		return $pdoStatement;
	}
	/**
	 *	Aditional method
	 */



	/**
	 *
	 * @param PDO $pdo
	 * @param Mandate $mandate
	 * @param Array list of Mandate
	 */
	public static function loadByMandate(PDO $pdo,Mandate $mandate,$easyload = false ){

		// Charger le/la upload
		$pdoStatement = BddUpload::_select($pdo,'u.Mandate_idMandate = ?');
		if (!$pdoStatement->execute(array($mandate->getIdMandate() ))) {
			throw new Exception('Erreur lors du chargement d\'un(e) upload depuis la base de donn�es');
		}

		// Mettre chaque upload dans un tableau
		$uploads = array();
		while ($upload = BddUpload::fetch($pdo,$pdoStatement,$easyload)) {
			$uploads[] = $upload;
		}

		// Retourner le tableau
		return $uploads;

		// R�cup�rer le/la upload depuis le jeu de r�sultats
		//		return BddUpload::fetch($pdo,$pdoStatement,$easyload);
	}

}


