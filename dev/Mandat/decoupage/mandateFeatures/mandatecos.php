<?php

/**
 * @class MandateCOS
 * @date 10/02/2011 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class MandateCOS
{
	/// @var PDO
	private $pdo;

	/// @var array tableau pour le chargement rapide
	private static $easyload;

	/// @var int
	private $idMandateCOS;

	/// @var string
	private $name;

	/// @var string
	private $code;

	/**
	 * Construire un(e) mandateCOS
	 * @param $pdo PDO
	 * @param $idMandateCOS int
	 * @param $name string
	 * @param $code string
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateCOS
	 */
	protected function __construct(PDO $pdo,$idMandateCOS,$name,$code,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;

		// Sauvegarder les attributs
		$this->idMandateCOS = $idMandateCOS;
		$this->name = $name;
		$this->code = $code;

		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			MandateCOS::$easyload[$idMandateCOS] = $this;
		}
	}

	/**
	 * Cr�er un(e) mandateCOS
	 * @param $pdo PDO
	 * @param $name string
	 * @param $code string
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateCOS
	 */
	public static function create(PDO $pdo,$name,$code,$easyload=true)
	{
		// Ajouter le/la mandateCOS dans la base de donn�es
		$pdoStatement = $pdo->prepare('INSERT INTO MandateCOS (name,code) VALUES (?,?)');
		if (!$pdoStatement->execute(array($name,$code))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) mandateCOS dans la base de donn�es');
		}

		// Construire le/la mandateCOS
		return new MandateCOS($pdo,$pdo->lastInsertId(),$name,$code,$easyload);
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
		return $pdo->prepare('SELECT m.idMandateCOS, m.name, m.code FROM MandateCOS m '.
		($where != null ? ' WHERE '.$where : '').
		($orderby != null ? ' ORDERBY '.$orderby : '').
		($limit != null ? ' LIMIT '.$limit : ''));
	}

	/**
	 * Charger un(e) mandateCOS
	 * @param $pdo PDO
	 * @param $idMandateCOS int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateCOS
	 */
	public static function load(PDO $pdo,$idMandateCOS,$easyload=true)
	{
		// D�j� charg�(e) ?
		if (isset(MandateCOS::$easyload[$idMandateCOS])) {
			return MandateCOS::$easyload[$idMandateCOS];
		}

		// Charger le/la mandateCOS
		$pdoStatement = MandateCOS::_select($pdo,'m.idMandateCOS = ?');
		if (!$pdoStatement->execute(array($idMandateCOS))) {
			throw new Exception('Erreur lors du chargement d\'un(e) mandateCOS depuis la base de donn�es');
		}

		// R�cup�rer le/la mandateCOS depuis le jeu de r�sultats
		return MandateCOS::fetch($pdo,$pdoStatement,$easyload);
	}

	/**
	 * Charger tous/toutes les mandateCOSs
	 * @param $pdo PDO
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateCOS[] tableau de mandatecoss
	 */
	public static function loadAll(PDO $pdo,$easyload=false)
	{
		// S�lectionner tous/toutes les mandateCOSs
		$pdoStatement = MandateCOS::selectAll($pdo);

		// Mettre chaque mandateCOS dans un tableau
		$mandateCOSs = array();
		while ($mandateCOS = MandateCOS::fetch($pdo,$pdoStatement,$easyload)) {
			$mandateCOSs[] = $mandateCOS;
		}

		// Retourner le tableau
		return $mandateCOSs;
	}

	/**
	 * S�lectionner tous/toutes les mandateCOSs
	 * @param $pdo PDO
	 * @return PDOStatement
	 */
	public static function selectAll(PDO $pdo)
	{
		$pdoStatement = MandateCOS::_select($pdo);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les mandateCOSs depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�re le/la mandateCOS suivant(e) d'un jeu de r�sultats
	 * @param $pdo PDO
	 * @param $pdoStatement PDOStatement
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateCOS
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idMandateCOS,$name,$code) = $values;

		// Construire le/la mandateCOS
		return isset(MandateCOS::$easyload[$idMandateCOS.'-'.$name.'-'.$code]) ? MandateCOS::$easyload[$idMandateCOS.'-'.$name.'-'.$code] :
		new MandateCOS($pdo,$idMandateCOS,$name,$code,$easyload);
	}

	/**
	 * Serialiser
	 * @param $serialize bool activer la s�rialisation ?
	 * @return string serialisation du/de la mandatecos
	 */
	public function serialize($serialize=true)
	{
		// S�rialiser le/la mandateCOS
		$array = array('idMandateCOS' => $this->idMandateCOS,'name' => $this->name,'code' => $this->code);

		// Retourner la serialisation (ou pas) du/de la mandateCOS
		return $serialize ? serialize($array) : $array;
	}

	/**
	 * D�s�rialiser
	 * @param $pdo PDO
	 * @param $string string serialisation du/de la mandatecos
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateCOS
	 */
	public static function unserialize(PDO $pdo,$string,$easyload=true)
	{
		// D�s�rialiser la chaine de caract�res
		$array = unserialize($string);

		// Construire le/la mandateCOS
		return isset(MandateCOS::$easyload[$array['idMandateCOS']]) ? MandateCOS::$easyload[$array['idMandateCOS']] :
		new MandateCOS($pdo,$array['idMandateCOS'],$array['name'],$array['code'],$easyload);
	}

	/**
	 * Test d'�galit�
	 * @param $mandateCOS MandateCOS
	 * @return bool les objets sont ils �gaux ?
	 */
	public function equals($mandateCOS)
	{
		// Test si null
		if ($mandateCOS == null) { return false; }

		// Tester la classe
		if (!($mandateCOS instanceof MandateCOS)) { return false; }

		// Tester les ids
		return $this->idMandateCOS == $mandateCOS->idMandateCOS;
	}

	/**
	 * Compter les mandateCOSs
	 * @param $pdo PDO
	 * @return int nombre de mandatecoss
	 */
	public static function count(PDO $pdo)
	{
		if (!($pdoStatement = $pdo->query('SELECT COUNT(idMandateCOS) FROM MandateCOS'))) {
			throw new Exception('Erreur lors du comptage des mandateCOSs dans la base de donn�es');
		}
		return $pdoStatement->fetchColumn();
	}

	/**
	 * Supprimer le/la mandateCOS
	 * @return bool op�ration r�ussie ?
	 */
	public function delete()
	{
		// Supprimer les mandates associ�(e)s
		$select = $this->selectMandates();
		while ($mandate = Mandate::fetch($this->pdo,$select)) {
			if (!$mandate->delete()) { return false; }
		}

		// Supprimer le/la mandateCOS
		$pdoStatement = $this->pdo->prepare('DELETE FROM MandateCOS WHERE idMandateCOS = ?');
		if (!$pdoStatement->execute(array($this->getIdMandateCOS()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) mandateCOS dans la base de donn�es');
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
		$pdoStatement = $this->pdo->prepare('UPDATE MandateCOS SET '.implode(', ', $updates).' WHERE idMandateCOS = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdMandateCOS())))) {
			throw new Exception('Erreur lors de la mise � jour d\'un champ d\'un(e) mandateCOS dans la base de donn�es');
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
	 * R�cup�rer le/la idMandateCOS
	 * @return int
	 */
	public function getIdMandateCOS()
	{
		return $this->idMandateCOS;
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
		return Mandate::selectByCos($this->pdo,$this);
	}
	/**
	 * ToString
	 * @return string repr�sentation de mandatecos sous la forme d'un string
	 */
	public function __toString()
	{
		return '[MandateCOS idMandateCOS="'.$this->idMandateCOS.'" name="'.$this->name.'" code="'.$this->code.'"]';
	}

}

?>
