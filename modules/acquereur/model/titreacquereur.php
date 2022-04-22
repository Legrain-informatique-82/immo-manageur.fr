<?php

/**
 * @class TitreAcquereur
 * @date 21/03/2011 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class TitreAcquereur
{
	/// @var PDO
	private $pdo;

	/// @var array tableau pour le chargement rapide
	private static $easyload;

	/// @var int
	private $idTitreAcquereur;

	/// @var string
	private $name;

	/**
	 * Construire un(e) titreAcquereur
	 * @param $pdo PDO
	 * @param $idTitreAcquereur int
	 * @param $name string
	 * @param $easyload bool activer le chargement rapide ?
	 * @return TitreAcquereur
	 */
	protected function __construct(PDO $pdo,$idTitreAcquereur,$name,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;

		// Sauvegarder les attributs
		$this->idTitreAcquereur = $idTitreAcquereur;
		$this->name = $name;

		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			TitreAcquereur::$easyload[$idTitreAcquereur] = $this;
		}
	}

	/**
	 * Cr�er un(e) titreAcquereur
	 * @param $pdo PDO
	 * @param $name string
	 * @param $easyload bool activer le chargement rapide ?
	 * @return TitreAcquereur
	 */
	public static function create(PDO $pdo,$name,$easyload=true)
	{
		// Ajouter le/la titreAcquereur dans la base de donn�es
		$pdoStatement = $pdo->prepare('INSERT INTO TitreAcquereur (name) VALUES (?)');
		if (!$pdoStatement->execute(array($name))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) titreAcquereur dans la base de donn�es');
		}

		// Construire le/la titreAcquereur
		return new TitreAcquereur($pdo,$pdo->lastInsertId(),$name,$easyload);
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
		return $pdo->prepare('SELECT t.idTitreAcquereur, t.name FROM TitreAcquereur t '.
		($where != null ? ' WHERE '.$where : '').
		($orderby != null ? ' ORDERBY '.$orderby : '').
		($limit != null ? ' LIMIT '.$limit : ''));
	}

	/**
	 * Charger un(e) titreAcquereur
	 * @param $pdo PDO
	 * @param $idTitreAcquereur int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return TitreAcquereur
	 */
	public static function load(PDO $pdo,$idTitreAcquereur,$easyload=true)
	{
		// D�j� charg�(e) ?
		if (isset(TitreAcquereur::$easyload[$idTitreAcquereur])) {
			return TitreAcquereur::$easyload[$idTitreAcquereur];
		}

		// Charger le/la titreAcquereur
		$pdoStatement = TitreAcquereur::_select($pdo,'t.idTitreAcquereur = ?');
		if (!$pdoStatement->execute(array($idTitreAcquereur))) {
			throw new Exception('Erreur lors du chargement d\'un(e) titreAcquereur depuis la base de donn�es');
		}

		// R�cup�rer le/la titreAcquereur depuis le jeu de r�sultats
		return TitreAcquereur::fetch($pdo,$pdoStatement,$easyload);
	}

	/**
	 * Charger tous/toutes les titreAcquereurs
	 * @param $pdo PDO
	 * @param $easyload bool activer le chargement rapide ?
	 * @return TitreAcquereur[] tableau de titreacquereurs
	 */
	public static function loadAll(PDO $pdo,$easyload=false)
	{
		// S�lectionner tous/toutes les titreAcquereurs
		$pdoStatement = TitreAcquereur::selectAll($pdo);

		// Mettre chaque titreAcquereur dans un tableau
		$titreAcquereurs = array();
		while ($titreAcquereur = TitreAcquereur::fetch($pdo,$pdoStatement,$easyload)) {
			$titreAcquereurs[] = $titreAcquereur;
		}

		// Retourner le tableau
		return $titreAcquereurs;
	}

	/**
	 * S�lectionner tous/toutes les titreAcquereurs
	 * @param $pdo PDO
	 * @return PDOStatement
	 */
	public static function selectAll(PDO $pdo)
	{
		$pdoStatement = TitreAcquereur::_select($pdo);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les titreAcquereurs depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�re le/la titreAcquereur suivant(e) d'un jeu de r�sultats
	 * @param $pdo PDO
	 * @param $pdoStatement PDOStatement
	 * @param $easyload bool activer le chargement rapide ?
	 * @return TitreAcquereur
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idTitreAcquereur,$name) = $values;

		// Construire le/la titreAcquereur
		return isset(TitreAcquereur::$easyload[$idTitreAcquereur.'-'.$name]) ? TitreAcquereur::$easyload[$idTitreAcquereur.'-'.$name] :
		new TitreAcquereur($pdo,$idTitreAcquereur,$name,$easyload);
	}

	/**
	 * Serialiser
	 * @param $serialize bool activer la s�rialisation ?
	 * @return string serialisation du/de la titreacquereur
	 */
	public function serialize($serialize=true)
	{
		// S�rialiser le/la titreAcquereur
		$array = array('idTitreAcquereur' => $this->idTitreAcquereur,'name' => $this->name);

		// Retourner la serialisation (ou pas) du/de la titreAcquereur
		return $serialize ? serialize($array) : $array;
	}

	/**
	 * D�s�rialiser
	 * @param $pdo PDO
	 * @param $string string serialisation du/de la titreacquereur
	 * @param $easyload bool activer le chargement rapide ?
	 * @return TitreAcquereur
	 */
	public static function unserialize(PDO $pdo,$string,$easyload=true)
	{
		// D�s�rialiser la chaine de caract�res
		$array = unserialize($string);

		// Construire le/la titreAcquereur
		return isset(TitreAcquereur::$easyload[$array['idTitreAcquereur']]) ? TitreAcquereur::$easyload[$array['idTitreAcquereur']] :
		new TitreAcquereur($pdo,$array['idTitreAcquereur'],$array['name'],$easyload);
	}

	/**
	 * Test d'�galit�
	 * @param $titreAcquereur TitreAcquereur
	 * @return bool les objets sont ils �gaux ?
	 */
	public function equals($titreAcquereur)
	{
		// Test si null
		if ($titreAcquereur == null) { return false; }

		// Tester la classe
		if (!($titreAcquereur instanceof TitreAcquereur)) { return false; }

		// Tester les ids
		return $this->idTitreAcquereur == $titreAcquereur->idTitreAcquereur;
	}

	/**
	 * Compter les titreAcquereurs
	 * @param $pdo PDO
	 * @return int nombre de titreacquereurs
	 */
	public static function count(PDO $pdo)
	{
		if (!($pdoStatement = $pdo->query('SELECT COUNT(idTitreAcquereur) FROM TitreAcquereur'))) {
			throw new Exception('Erreur lors du comptage des titreAcquereurs dans la base de donn�es');
		}
		return $pdoStatement->fetchColumn();
	}

	/**
	 * Supprimer le/la titreAcquereur
	 * @return bool op�ration r�ussie ?
	 */
	public function delete()
	{
		// Supprimer les Acquereurs associ�(e)s
		$select = $this->selectAcquereurs();
		while ($acquereur = Acquereur::fetch($this->pdo,$select)) {
			if (!$acquereur->delete()) { return false; }
		}

		// Supprimer le/la titreAcquereur
		$pdoStatement = $this->pdo->prepare('DELETE FROM TitreAcquereur WHERE idTitreAcquereur = ?');
		if (!$pdoStatement->execute(array($this->getIdTitreAcquereur()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) titreAcquereur dans la base de donn�es');
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
		$pdoStatement = $this->pdo->prepare('UPDATE TitreAcquereur SET '.implode(', ', $updates).' WHERE idTitreAcquereur = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdTitreAcquereur())))) {
			throw new Exception('Erreur lors de la mise � jour d\'un champ d\'un(e) titreAcquereur dans la base de donn�es');
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
		return $this->_set(array('name'),array($this->name));
	}

	/**
	 * R�cup�rer le/la idTitreAcquereur
	 * @return int
	 */
	public function getIdTitreAcquereur()
	{
		return $this->idTitreAcquereur;
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
	 * S�lectionner les acquereurs
	 * @return PDOStatement
	 */
	public function selectAcquereurs()
	{
		return Acquereur::selectByTitreAcquereur($this->pdo,$this);
	}
	/**
	 * ToString
	 * @return string repr�sentation de titreacquereur sous la forme d'un string
	 */
	public function __toString()
	{
		return '[TitreAcquereur idTitreAcquereur="'.$this->idTitreAcquereur.'" name="'.$this->name.'"]';
	}
	// Addd



	public static function nameExist(PDO $pdo,$name){
		$pdoStatement = $pdo->prepare('SELECT t.idTitreAcquereur, t.name FROM TitreAcquereur t  WHERE t.name = ?');

		if (!$pdoStatement->execute(array($name))) {
			throw new Exception('Erreur lors de la récuperation du titre');
		}
		return TitreAcquereur::fetch($pdo,$pdoStatement) ===null?false:true ;

	}
}

?>
