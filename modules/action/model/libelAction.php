<?php

/**
 * @class LibelAction
 * @date 18/05/2011 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class LibelAction
{
	/// @var PDO
	private $pdo;

	/// @var array tableau pour le chargement rapide
	private static $easyload;

	/// @var int
	private $idLibelAction;

	/// @var string
	private $libel;

	/**
	 * Construire un(e) libelAction
	 * @param $pdo PDO
	 * @param $idLibelAction int
	 * @param $libel string
	 * @param $easyload bool activer le chargement rapide ?
	 * @return LibelAction
	 */
	protected function __construct(PDO $pdo,$idLibelAction,$libel,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;

		// Sauvegarder les attributs
		$this->idLibelAction = $idLibelAction;
		$this->libel = $libel;

		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			LibelAction::$easyload[$idLibelAction] = $this;
		}
	}

	/**
	 * Cr�er un(e) libelAction
	 * @param $pdo PDO
	 * @param $libel string
	 * @param $easyload bool activer le chargement rapide ?
	 * @return LibelAction
	 */
	public static function create(PDO $pdo,$libel,$easyload=true)
	{
		// Ajouter le/la libelAction dans la base de donn�es
		$pdoStatement = $pdo->prepare('INSERT INTO LibelAction (libel) VALUES (?)');

		if (!$pdoStatement->execute(array($libel))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) libelAction dans la base de donn�es');
		}

		// Construire le/la libelAction
		return new LibelAction($pdo,$pdo->lastInsertId(),$libel,$easyload);
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
		return $pdo->prepare('SELECT l.idLibelAction, l.libel FROM LibelAction l '.
		($where != null ? ' WHERE '.$where : '').
		($orderby != null ? ' ORDER BY '.$orderby : '').
		($limit != null ? ' LIMIT '.$limit : ''));
	}

	/**
	 * Charger un(e) libelAction
	 * @param $pdo PDO
	 * @param $idLibelAction int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return LibelAction
	 */
	public static function load(PDO $pdo,$idLibelAction,$easyload=true)
	{
		// D�j� charg�(e) ?
		if (isset(LibelAction::$easyload[$idLibelAction])) {
			return LibelAction::$easyload[$idLibelAction];
		}

		// Charger le/la libelAction
		$pdoStatement = LibelAction::_select($pdo,'l.idLibelAction = ?');
		if (!$pdoStatement->execute(array($idLibelAction))) {
			throw new Exception('Erreur lors du chargement d\'un(e) libelAction depuis la base de donn�es');
		}

		// R�cup�rer le/la libelAction depuis le jeu de r�sultats
		return LibelAction::fetch($pdo,$pdoStatement,$easyload);
	}

	/**
	 * Charger tous/toutes les libelActions
	 * @param $pdo PDO
	 * @param $easyload bool activer le chargement rapide ?
	 * @return LibelAction[] tableau de libelactions
	 */
	public static function loadAll(PDO $pdo,$easyload=false)
	{
		// S�lectionner tous/toutes les libelActions
		$pdoStatement = LibelAction::selectAll($pdo);

		// Mettre chaque libelAction dans un tableau
		$libelActions = array();
		while ($libelAction = LibelAction::fetch($pdo,$pdoStatement,$easyload)) {
			$libelActions[] = $libelAction;
		}

		// Retourner le tableau
		return $libelActions;
	}

	/**
	 * S�lectionner tous/toutes les libelActions
	 * @param $pdo PDO
	 * @return PDOStatement
	 */
	public static function selectAll(PDO $pdo)
	{
		$pdoStatement = LibelAction::_select($pdo,'','libel');
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les libelActions depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�re le/la libelAction suivant(e) d'un jeu de r�sultats
	 * @param $pdo PDO
	 * @param $pdoStatement PDOStatement
	 * @param $easyload bool activer le chargement rapide ?
	 * @return LibelAction
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idLibelAction,$libel) = $values;

		// Construire le/la libelAction
		return isset(LibelAction::$easyload[$idLibelAction.'-'.$libel]) ? LibelAction::$easyload[$idLibelAction.'-'.$libel] :
		new LibelAction($pdo,$idLibelAction,$libel,$easyload);
	}

	/**
	 * Serialiser
	 * @param $serialize bool activer la s�rialisation ?
	 * @return string serialisation du/de la libelaction
	 */
	public function serialize($serialize=true)
	{
		// S�rialiser le/la libelAction
		$array = array('idLibelAction' => $this->idLibelAction,'libel' => $this->libel);

		// Retourner la serialisation (ou pas) du/de la libelAction
		return $serialize ? serialize($array) : $array;
	}

	/**
	 * D�s�rialiser
	 * @param $pdo PDO
	 * @param $string string serialisation du/de la libelaction
	 * @param $easyload bool activer le chargement rapide ?
	 * @return LibelAction
	 */
	public static function unserialize(PDO $pdo,$string,$easyload=true)
	{
		// D�s�rialiser la chaine de caract�res
		$array = unserialize($string);

		// Construire le/la libelAction
		return isset(LibelAction::$easyload[$array['idLibelAction']]) ? LibelAction::$easyload[$array['idLibelAction']] :
		new LibelAction($pdo,$array['idLibelAction'],$array['libel'],$easyload);
	}

	/**
	 * Test d'�galit�
	 * @param $libelAction LibelAction
	 * @return bool les objets sont ils �gaux ?
	 */
	public function equals($libelAction)
	{
		// Test si null
		if ($libelAction == null) { return false; }

		// Tester la classe
		if (!($libelAction instanceof LibelAction)) { return false; }

		// Tester les ids
		return $this->idLibelAction == $libelAction->idLibelAction;
	}

	/**
	 * Compter les libelActions
	 * @param $pdo PDO
	 * @return int nombre de libelactions
	 */
	public static function count(PDO $pdo)
	{
		if (!($pdoStatement = $pdo->query('SELECT COUNT(idLibelAction) FROM LibelAction'))) {
			throw new Exception('Erreur lors du comptage des libelActions dans la base de donn�es');
		}
		return $pdoStatement->fetchColumn();
	}

	/**
	 * Supprimer le/la libelAction
	 * @return bool op�ration r�ussie ?
	 */
	public function delete()
	{
		// Supprimer le/la libelAction
		$pdoStatement = $this->pdo->prepare('DELETE FROM LibelAction WHERE idLibelAction = ?');
		if (!$pdoStatement->execute(array($this->getIdLibelAction()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) libelAction dans la base de donn�es');
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
		$pdoStatement = $this->pdo->prepare('UPDATE LibelAction SET '.implode(', ', $updates).' WHERE idLibelAction = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdLibelAction())))) {
			throw new Exception('Erreur lors de la mise � jour d\'un champ d\'un(e) libelAction dans la base de donn�es');
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
		return $this->_set(array('libel'),array($this->libel));
	}

	/**
	 * R�cup�rer le/la idLibelAction
	 * @return int
	 */
	public function getIdLibelAction()
	{
		return $this->idLibelAction;
	}
	public function getId()
	{
		return $this->idLibelAction;
	}
	/**
	 * R�cup�rer le/la libel
	 * @return string
	 */
	public function getLibel()
	{
		return $this->libel;
	}

	/**
	 * D�finir le/la libel
	 * @param $libel string
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setLibel($libel,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->libel = $libel;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('libel'),array($libel)) : true;
	}
	/**
	 * ToString
	 * @return string repr�sentation de libelaction sous la forme d'un string
	 */
	public function __toString()
	{
		return '[LibelAction idLibelAction="'.$this->idLibelAction.'" libel="'.$this->libel.'"]';
	}

}

?>
