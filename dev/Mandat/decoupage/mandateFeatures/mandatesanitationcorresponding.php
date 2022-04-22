<?php

/**
 * @class MandateSanitationCorresponding
 * @date 10/02/2011 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class MandateSanitationCorresponding
{
	/// @var PDO
	private $pdo;

	/// @var array tableau pour le chargement rapide
	private static $easyload;

	/// @var int
	private $idMandateSanitationCorresponding;

	/// @var string
	private $name;

	/// @var string
	private $code;

	/**
	 * Construire un(e) mandateSanitationCorresponding
	 * @param $pdo PDO
	 * @param $idMandateSanitationCorresponding int
	 * @param $name string
	 * @param $code string
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateSanitationCorresponding
	 */
	protected function __construct(PDO $pdo,$idMandateSanitationCorresponding,$name,$code,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;

		// Sauvegarder les attributs
		$this->idMandateSanitationCorresponding = $idMandateSanitationCorresponding;
		$this->name = $name;
		$this->code = $code;

		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			MandateSanitationCorresponding::$easyload[$idMandateSanitationCorresponding] = $this;
		}
	}

	/**
	 * Cr�er un(e) mandateSanitationCorresponding
	 * @param $pdo PDO
	 * @param $name string
	 * @param $code string
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateSanitationCorresponding
	 */
	public static function create(PDO $pdo,$name,$code,$easyload=true)
	{
		// Ajouter le/la mandateSanitationCorresponding dans la base de donn�es
		$pdoStatement = $pdo->prepare('INSERT INTO MandateSanitationCorresponding (name,code) VALUES (?,?)');
		if (!$pdoStatement->execute(array($name,$code))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) mandateSanitationCorresponding dans la base de donn�es');
		}

		// Construire le/la mandateSanitationCorresponding
		return new MandateSanitationCorresponding($pdo,$pdo->lastInsertId(),$name,$code,$easyload);
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
		return $pdo->prepare('SELECT m.idMandateSanitationCorresponding, m.name, m.code FROM MandateSanitationCorresponding m '.
		($where != null ? ' WHERE '.$where : '').
		($orderby != null ? ' ORDERBY '.$orderby : '').
		($limit != null ? ' LIMIT '.$limit : ''));
	}

	/**
	 * Charger un(e) mandateSanitationCorresponding
	 * @param $pdo PDO
	 * @param $idMandateSanitationCorresponding int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateSanitationCorresponding
	 */
	public static function load(PDO $pdo,$idMandateSanitationCorresponding,$easyload=true)
	{
		// D�j� charg�(e) ?
		if (isset(MandateSanitationCorresponding::$easyload[$idMandateSanitationCorresponding])) {
			return MandateSanitationCorresponding::$easyload[$idMandateSanitationCorresponding];
		}

		// Charger le/la mandateSanitationCorresponding
		$pdoStatement = MandateSanitationCorresponding::_select($pdo,'m.idMandateSanitationCorresponding = ?');
		if (!$pdoStatement->execute(array($idMandateSanitationCorresponding))) {
			throw new Exception('Erreur lors du chargement d\'un(e) mandateSanitationCorresponding depuis la base de donn�es');
		}

		// R�cup�rer le/la mandateSanitationCorresponding depuis le jeu de r�sultats
		return MandateSanitationCorresponding::fetch($pdo,$pdoStatement,$easyload);
	}

	/**
	 * Charger tous/toutes les mandateSanitationCorrespondings
	 * @param $pdo PDO
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateSanitationCorresponding[] tableau de mandatesanitationcorrespondings
	 */
	public static function loadAll(PDO $pdo,$easyload=false)
	{
		// S�lectionner tous/toutes les mandateSanitationCorrespondings
		$pdoStatement = MandateSanitationCorresponding::selectAll($pdo);

		// Mettre chaque mandateSanitationCorresponding dans un tableau
		$mandateSanitationCorrespondings = array();
		while ($mandateSanitationCorresponding = MandateSanitationCorresponding::fetch($pdo,$pdoStatement,$easyload)) {
			$mandateSanitationCorrespondings[] = $mandateSanitationCorresponding;
		}

		// Retourner le tableau
		return $mandateSanitationCorrespondings;
	}

	/**
	 * S�lectionner tous/toutes les mandateSanitationCorrespondings
	 * @param $pdo PDO
	 * @return PDOStatement
	 */
	public static function selectAll(PDO $pdo)
	{
		$pdoStatement = MandateSanitationCorresponding::_select($pdo);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les mandateSanitationCorrespondings depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�re le/la mandateSanitationCorresponding suivant(e) d'un jeu de r�sultats
	 * @param $pdo PDO
	 * @param $pdoStatement PDOStatement
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateSanitationCorresponding
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idMandateSanitationCorresponding,$name,$code) = $values;

		// Construire le/la mandateSanitationCorresponding
		return isset(MandateSanitationCorresponding::$easyload[$idMandateSanitationCorresponding.'-'.$name.'-'.$code]) ? MandateSanitationCorresponding::$easyload[$idMandateSanitationCorresponding.'-'.$name.'-'.$code] :
		new MandateSanitationCorresponding($pdo,$idMandateSanitationCorresponding,$name,$code,$easyload);
	}

	/**
	 * Serialiser
	 * @param $serialize bool activer la s�rialisation ?
	 * @return string serialisation du/de la mandatesanitationcorresponding
	 */
	public function serialize($serialize=true)
	{
		// S�rialiser le/la mandateSanitationCorresponding
		$array = array('idMandateSanitationCorresponding' => $this->idMandateSanitationCorresponding,'name' => $this->name,'code' => $this->code);

		// Retourner la serialisation (ou pas) du/de la mandateSanitationCorresponding
		return $serialize ? serialize($array) : $array;
	}

	/**
	 * D�s�rialiser
	 * @param $pdo PDO
	 * @param $string string serialisation du/de la mandatesanitationcorresponding
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateSanitationCorresponding
	 */
	public static function unserialize(PDO $pdo,$string,$easyload=true)
	{
		// D�s�rialiser la chaine de caract�res
		$array = unserialize($string);

		// Construire le/la mandateSanitationCorresponding
		return isset(MandateSanitationCorresponding::$easyload[$array['idMandateSanitationCorresponding']]) ? MandateSanitationCorresponding::$easyload[$array['idMandateSanitationCorresponding']] :
		new MandateSanitationCorresponding($pdo,$array['idMandateSanitationCorresponding'],$array['name'],$array['code'],$easyload);
	}

	/**
	 * Test d'�galit�
	 * @param $mandateSanitationCorresponding MandateSanitationCorresponding
	 * @return bool les objets sont ils �gaux ?
	 */
	public function equals($mandateSanitationCorresponding)
	{
		// Test si null
		if ($mandateSanitationCorresponding == null) { return false; }

		// Tester la classe
		if (!($mandateSanitationCorresponding instanceof MandateSanitationCorresponding)) { return false; }

		// Tester les ids
		return $this->idMandateSanitationCorresponding == $mandateSanitationCorresponding->idMandateSanitationCorresponding;
	}

	/**
	 * Compter les mandateSanitationCorrespondings
	 * @param $pdo PDO
	 * @return int nombre de mandatesanitationcorrespondings
	 */
	public static function count(PDO $pdo)
	{
		if (!($pdoStatement = $pdo->query('SELECT COUNT(idMandateSanitationCorresponding) FROM MandateSanitationCorresponding'))) {
			throw new Exception('Erreur lors du comptage des mandateSanitationCorrespondings dans la base de donn�es');
		}
		return $pdoStatement->fetchColumn();
	}

	/**
	 * Supprimer le/la mandateSanitationCorresponding
	 * @return bool op�ration r�ussie ?
	 */
	public function delete()
	{
		// Supprimer les mandates associ�(e)s
		$select = $this->selectMandates();
		while ($mandate = Mandate::fetch($this->pdo,$select)) {
			if (!$mandate->delete()) { return false; }
		}

		// Supprimer le/la mandateSanitationCorresponding
		$pdoStatement = $this->pdo->prepare('DELETE FROM MandateSanitationCorresponding WHERE idMandateSanitationCorresponding = ?');
		if (!$pdoStatement->execute(array($this->getIdMandateSanitationCorresponding()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) mandateSanitationCorresponding dans la base de donn�es');
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
		$pdoStatement = $this->pdo->prepare('UPDATE MandateSanitationCorresponding SET '.implode(', ', $updates).' WHERE idMandateSanitationCorresponding = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdMandateSanitationCorresponding())))) {
			throw new Exception('Erreur lors de la mise � jour d\'un champ d\'un(e) mandateSanitationCorresponding dans la base de donn�es');
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
	 * R�cup�rer le/la idMandateSanitationCorresponding
	 * @return int
	 */
	public function getIdMandateSanitationCorresponding()
	{
		return $this->idMandateSanitationCorresponding;
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
		return Mandate::selectBySanitationCorresponding($this->pdo,$this);
	}
	/**
	 * ToString
	 * @return string repr�sentation de mandatesanitationcorresponding sous la forme d'un string
	 */
	public function __toString()
	{
		return '[MandateSanitationCorresponding idMandateSanitationCorresponding="'.$this->idMandateSanitationCorresponding.'" name="'.$this->name.'" code="'.$this->code.'"]';
	}

}

?>
