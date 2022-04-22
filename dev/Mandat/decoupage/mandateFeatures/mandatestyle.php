<?php

/**
 * @class MandateStyle
 * @date 10/02/2011 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class MandateStyle
{
	/// @var PDO
	private $pdo;

	/// @var array tableau pour le chargement rapide
	private static $easyload;

	/// @var int
	private $idMandateStyle;

	/// @var string
	private $name;

	/// @var string
	private $code;

	/**
	 * Construire un(e) mandateStyle
	 * @param $pdo PDO
	 * @param $idMandateStyle int
	 * @param $name string
	 * @param $code string
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateStyle
	 */
	protected function __construct(PDO $pdo,$idMandateStyle,$name,$code,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;

		// Sauvegarder les attributs
		$this->idMandateStyle = $idMandateStyle;
		$this->name = $name;
		$this->code = $code;

		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			MandateStyle::$easyload[$idMandateStyle] = $this;
		}
	}

	/**
	 * Cr�er un(e) mandateStyle
	 * @param $pdo PDO
	 * @param $name string
	 * @param $code string
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateStyle
	 */
	public static function create(PDO $pdo,$name,$code,$easyload=true)
	{
		// Ajouter le/la mandateStyle dans la base de donn�es
		$pdoStatement = $pdo->prepare('INSERT INTO MandateStyle (name,code) VALUES (?,?)');
		if (!$pdoStatement->execute(array($name,$code))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) mandateStyle dans la base de donn�es');
		}

		// Construire le/la mandateStyle
		return new MandateStyle($pdo,$pdo->lastInsertId(),$name,$code,$easyload);
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
		return $pdo->prepare('SELECT m.idMandateStyle, m.name, m.code FROM MandateStyle m '.
		($where != null ? ' WHERE '.$where : '').
		($orderby != null ? ' ORDERBY '.$orderby : '').
		($limit != null ? ' LIMIT '.$limit : ''));
	}

	/**
	 * Charger un(e) mandateStyle
	 * @param $pdo PDO
	 * @param $idMandateStyle int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateStyle
	 */
	public static function load(PDO $pdo,$idMandateStyle,$easyload=true)
	{
		// D�j� charg�(e) ?
		if (isset(MandateStyle::$easyload[$idMandateStyle])) {
			return MandateStyle::$easyload[$idMandateStyle];
		}

		// Charger le/la mandateStyle
		$pdoStatement = MandateStyle::_select($pdo,'m.idMandateStyle = ?');
		if (!$pdoStatement->execute(array($idMandateStyle))) {
			throw new Exception('Erreur lors du chargement d\'un(e) mandateStyle depuis la base de donn�es');
		}

		// R�cup�rer le/la mandateStyle depuis le jeu de r�sultats
		return MandateStyle::fetch($pdo,$pdoStatement,$easyload);
	}

	/**
	 * Charger tous/toutes les mandateStyles
	 * @param $pdo PDO
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateStyle[] tableau de mandatestyles
	 */
	public static function loadAll(PDO $pdo,$easyload=false)
	{
		// S�lectionner tous/toutes les mandateStyles
		$pdoStatement = MandateStyle::selectAll($pdo);

		// Mettre chaque mandateStyle dans un tableau
		$mandateStyles = array();
		while ($mandateStyle = MandateStyle::fetch($pdo,$pdoStatement,$easyload)) {
			$mandateStyles[] = $mandateStyle;
		}

		// Retourner le tableau
		return $mandateStyles;
	}

	/**
	 * S�lectionner tous/toutes les mandateStyles
	 * @param $pdo PDO
	 * @return PDOStatement
	 */
	public static function selectAll(PDO $pdo)
	{
		$pdoStatement = MandateStyle::_select($pdo);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les mandateStyles depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�re le/la mandateStyle suivant(e) d'un jeu de r�sultats
	 * @param $pdo PDO
	 * @param $pdoStatement PDOStatement
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateStyle
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idMandateStyle,$name,$code) = $values;

		// Construire le/la mandateStyle
		return isset(MandateStyle::$easyload[$idMandateStyle.'-'.$name.'-'.$code]) ? MandateStyle::$easyload[$idMandateStyle.'-'.$name.'-'.$code] :
		new MandateStyle($pdo,$idMandateStyle,$name,$code,$easyload);
	}

	/**
	 * Serialiser
	 * @param $serialize bool activer la s�rialisation ?
	 * @return string serialisation du/de la mandatestyle
	 */
	public function serialize($serialize=true)
	{
		// S�rialiser le/la mandateStyle
		$array = array('idMandateStyle' => $this->idMandateStyle,'name' => $this->name,'code' => $this->code);

		// Retourner la serialisation (ou pas) du/de la mandateStyle
		return $serialize ? serialize($array) : $array;
	}

	/**
	 * D�s�rialiser
	 * @param $pdo PDO
	 * @param $string string serialisation du/de la mandatestyle
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateStyle
	 */
	public static function unserialize(PDO $pdo,$string,$easyload=true)
	{
		// D�s�rialiser la chaine de caract�res
		$array = unserialize($string);

		// Construire le/la mandateStyle
		return isset(MandateStyle::$easyload[$array['idMandateStyle']]) ? MandateStyle::$easyload[$array['idMandateStyle']] :
		new MandateStyle($pdo,$array['idMandateStyle'],$array['name'],$array['code'],$easyload);
	}

	/**
	 * Test d'�galit�
	 * @param $mandateStyle MandateStyle
	 * @return bool les objets sont ils �gaux ?
	 */
	public function equals($mandateStyle)
	{
		// Test si null
		if ($mandateStyle == null) { return false; }

		// Tester la classe
		if (!($mandateStyle instanceof MandateStyle)) { return false; }

		// Tester les ids
		return $this->idMandateStyle == $mandateStyle->idMandateStyle;
	}

	/**
	 * Compter les mandateStyles
	 * @param $pdo PDO
	 * @return int nombre de mandatestyles
	 */
	public static function count(PDO $pdo)
	{
		if (!($pdoStatement = $pdo->query('SELECT COUNT(idMandateStyle) FROM MandateStyle'))) {
			throw new Exception('Erreur lors du comptage des mandateStyles dans la base de donn�es');
		}
		return $pdoStatement->fetchColumn();
	}

	/**
	 * Supprimer le/la mandateStyle
	 * @return bool op�ration r�ussie ?
	 */
	public function delete()
	{
		// Supprimer les mandates associ�(e)s
		$select = $this->selectMandates();
		while ($mandate = Mandate::fetch($this->pdo,$select)) {
			if (!$mandate->delete()) { return false; }
		}

		// Supprimer le/la mandateStyle
		$pdoStatement = $this->pdo->prepare('DELETE FROM MandateStyle WHERE idMandateStyle = ?');
		if (!$pdoStatement->execute(array($this->getIdMandateStyle()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) mandateStyle dans la base de donn�es');
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
		$pdoStatement = $this->pdo->prepare('UPDATE MandateStyle SET '.implode(', ', $updates).' WHERE idMandateStyle = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdMandateStyle())))) {
			throw new Exception('Erreur lors de la mise � jour d\'un champ d\'un(e) mandateStyle dans la base de donn�es');
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
	 * R�cup�rer le/la idMandateStyle
	 * @return int
	 */
	public function getIdMandateStyle()
	{
		return $this->idMandateStyle;
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
		return Mandate::selectByStyle($this->pdo,$this);
	}
	/**
	 * ToString
	 * @return string repr�sentation de mandatestyle sous la forme d'un string
	 */
	public function __toString()
	{
		return '[MandateStyle idMandateStyle="'.$this->idMandateStyle.'" name="'.$this->name.'" code="'.$this->code.'"]';
	}

}

?>
