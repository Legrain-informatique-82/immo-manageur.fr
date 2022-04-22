<?php

/**
 * @class MandateNews
 * @date 10/02/2011 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class MandateNews
{
	/// @var PDO
	private $pdo;

	/// @var array tableau pour le chargement rapide
	private static $easyload;

	/// @var int
	private $idMandateNews;

	/// @var string
	private $name;

	/// @var string
	private $code;

	/**
	 * Construire un(e) mandateNews
	 * @param $pdo PDO
	 * @param $idMandateNews int
	 * @param $name string
	 * @param $code string
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateNews
	 */
	protected function __construct(PDO $pdo,$idMandateNews,$name,$code,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;

		// Sauvegarder les attributs
		$this->idMandateNews = $idMandateNews;
		$this->name = $name;
		$this->code = $code;

		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			MandateNews::$easyload[$idMandateNews] = $this;
		}
	}

	/**
	 * Cr�er un(e) mandateNews
	 * @param $pdo PDO
	 * @param $name string
	 * @param $code string
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateNews
	 */
	public static function create(PDO $pdo,$name,$code,$easyload=true)
	{
		// Ajouter le/la mandateNews dans la base de donn�es
		$pdoStatement = $pdo->prepare('INSERT INTO MandateNews (name,code) VALUES (?,?)');
		if (!$pdoStatement->execute(array($name,$code))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) mandateNews dans la base de donn�es');
		}

		// Construire le/la mandateNews
		return new MandateNews($pdo,$pdo->lastInsertId(),$name,$code,$easyload);
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
		return $pdo->prepare('SELECT m.idMandateNews, m.name, m.code FROM MandateNews m '.
		($where != null ? ' WHERE '.$where : '').
		($orderby != null ? ' ORDERBY '.$orderby : '').
		($limit != null ? ' LIMIT '.$limit : ''));
	}

	/**
	 * Charger un(e) mandateNews
	 * @param $pdo PDO
	 * @param $idMandateNews int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateNews
	 */
	public static function load(PDO $pdo,$idMandateNews,$easyload=true)
	{
		// D�j� charg�(e) ?
		if (isset(MandateNews::$easyload[$idMandateNews])) {
			return MandateNews::$easyload[$idMandateNews];
		}

		// Charger le/la mandateNews
		$pdoStatement = MandateNews::_select($pdo,'m.idMandateNews = ?');
		if (!$pdoStatement->execute(array($idMandateNews))) {
			throw new Exception('Erreur lors du chargement d\'un(e) mandateNews depuis la base de donn�es');
		}

		// R�cup�rer le/la mandateNews depuis le jeu de r�sultats
		return MandateNews::fetch($pdo,$pdoStatement,$easyload);
	}

	/**
	 * Charger tous/toutes les mandateNews
	 * @param $pdo PDO
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateNews[] tableau de mandatenews
	 */
	public static function loadAll(PDO $pdo,$easyload=false)
	{
		// S�lectionner tous/toutes les mandateNews
		$pdoStatement = MandateNews::selectAll($pdo);

		// Mettre chaque mandateNews dans un tableau
		$array = array();
		while ($mandateNews = MandateNews::fetch($pdo,$pdoStatement,$easyload)) {
			$array[] = $mandateNews;
		}

		// Retourner le tableau
		return $array;
	}

	/**
	 * S�lectionner tous/toutes les mandateNews
	 * @param $pdo PDO
	 * @return PDOStatement
	 */
	public static function selectAll(PDO $pdo)
	{
		$pdoStatement = MandateNews::_select($pdo);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les mandateNews depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�re le/la mandateNews suivant(e) d'un jeu de r�sultats
	 * @param $pdo PDO
	 * @param $pdoStatement PDOStatement
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateNews
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idMandateNews,$name,$code) = $values;

		// Construire le/la mandateNews
		return isset(MandateNews::$easyload[$idMandateNews.'-'.$name.'-'.$code]) ? MandateNews::$easyload[$idMandateNews.'-'.$name.'-'.$code] :
		new MandateNews($pdo,$idMandateNews,$name,$code,$easyload);
	}

	/**
	 * Serialiser
	 * @param $serialize bool activer la s�rialisation ?
	 * @return string serialisation du/de la mandatenews
	 */
	public function serialize($serialize=true)
	{
		// S�rialiser le/la mandateNews
		$array = array('idMandateNews' => $this->idMandateNews,'name' => $this->name,'code' => $this->code);

		// Retourner la serialisation (ou pas) du/de la mandateNews
		return $serialize ? serialize($array) : $array;
	}

	/**
	 * D�s�rialiser
	 * @param $pdo PDO
	 * @param $string string serialisation du/de la mandatenews
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateNews
	 */
	public static function unserialize(PDO $pdo,$string,$easyload=true)
	{
		// D�s�rialiser la chaine de caract�res
		$array = unserialize($string);

		// Construire le/la mandateNews
		return isset(MandateNews::$easyload[$array['idMandateNews']]) ? MandateNews::$easyload[$array['idMandateNews']] :
		new MandateNews($pdo,$array['idMandateNews'],$array['name'],$array['code'],$easyload);
	}

	/**
	 * Test d'�galit�
	 * @param $mandateNews MandateNews
	 * @return bool les objets sont ils �gaux ?
	 */
	public function equals($mandateNews)
	{
		// Test si null
		if ($mandateNews == null) { return false; }

		// Tester la classe
		if (!($mandateNews instanceof MandateNews)) { return false; }

		// Tester les ids
		return $this->idMandateNews == $mandateNews->idMandateNews;
	}

	/**
	 * Compter les mandateNews
	 * @param $pdo PDO
	 * @return int nombre de mandatenews
	 */
	public static function count(PDO $pdo)
	{
		if (!($pdoStatement = $pdo->query('SELECT COUNT(idMandateNews) FROM MandateNews'))) {
			throw new Exception('Erreur lors du comptage des mandateNews dans la base de donn�es');
		}
		return $pdoStatement->fetchColumn();
	}

	/**
	 * Supprimer le/la mandateNews
	 * @return bool op�ration r�ussie ?
	 */
	public function delete()
	{
		// Supprimer les mandates associ�(e)s
		$select = $this->selectMandates();
		while ($mandate = Mandate::fetch($this->pdo,$select)) {
			if (!$mandate->delete()) { return false; }
		}

		// Supprimer le/la mandateNews
		$pdoStatement = $this->pdo->prepare('DELETE FROM MandateNews WHERE idMandateNews = ?');
		if (!$pdoStatement->execute(array($this->getIdMandateNews()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) mandateNews dans la base de donn�es');
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
		$pdoStatement = $this->pdo->prepare('UPDATE MandateNews SET '.implode(', ', $updates).' WHERE idMandateNews = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdMandateNews())))) {
			throw new Exception('Erreur lors de la mise � jour d\'un champ d\'un(e) mandateNews dans la base de donn�es');
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
		return $this->_set(array('name','code'),array($this->name,$this->code));
	}

	/**
	 * R�cup�rer le/la idMandateNews
	 * @return int
	 */
	public function getIdMandateNews()
	{
		return $this->idMandateNews;
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
	 * R�cup�rer le/la code
	 * @return string
	 */
	public function getCode()
	{
		return $this->code;
	}

	/**
	 * D�finir le/la code
	 * @param $code string
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setCode($code,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->code = $code;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('code'),array($code)) : true;
	}

	/**
	 * S�lectionner les mandates
	 * @return PDOStatement
	 */
	public function selectMandates()
	{
		return Mandate::selectByNews($this->pdo,$this);
	}
	/**
	 * ToString
	 * @return string repr�sentation de mandatenews sous la forme d'un string
	 */
	public function __toString()
	{
		return '[MandateNews idMandateNews="'.$this->idMandateNews.'" name="'.$this->name.'" code="'.$this->code.'"]';
	}

}

?>
