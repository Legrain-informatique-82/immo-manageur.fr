<?php

/**
 * @class MandateElectricCorresponding
 * @date 10/02/2011 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class MandateElectricCorresponding
{
	/// @var PDO
	private $pdo;

	/// @var array tableau pour le chargement rapide
	private static $easyload;

	/// @var int
	private $idMandateElectricCorresponding;

	/// @var string
	private $name;

	/// @var string
	private $code;

	/**
	 * Construire un(e) mandateElectricCorresponding
	 * @param $pdo PDO
	 * @param $idMandateElectricCorresponding int
	 * @param $name string
	 * @param $code string
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateElectricCorresponding
	 */
	protected function __construct(PDO $pdo,$idMandateElectricCorresponding,$name,$code,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;

		// Sauvegarder les attributs
		$this->idMandateElectricCorresponding = $idMandateElectricCorresponding;
		$this->name = $name;
		$this->code = $code;

		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			MandateElectricCorresponding::$easyload[$idMandateElectricCorresponding] = $this;
		}
	}

	/**
	 * Cr�er un(e) mandateElectricCorresponding
	 * @param $pdo PDO
	 * @param $name string
	 * @param $code string
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateElectricCorresponding
	 */
	public static function create(PDO $pdo,$name,$code,$easyload=true)
	{
		// Ajouter le/la mandateElectricCorresponding dans la base de donn�es
		$pdoStatement = $pdo->prepare('INSERT INTO MandateElectricCorresponding (name,code) VALUES (?,?)');
		if (!$pdoStatement->execute(array($name,$code))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) mandateElectricCorresponding dans la base de donn�es');
		}

		// Construire le/la mandateElectricCorresponding
		return new MandateElectricCorresponding($pdo,$pdo->lastInsertId(),$name,$code,$easyload);
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
		return $pdo->prepare('SELECT m.idMandateElectricCorresponding, m.name, m.code FROM MandateElectricCorresponding m '.
		($where != null ? ' WHERE '.$where : '').
		($orderby != null ? ' ORDERBY '.$orderby : '').
		($limit != null ? ' LIMIT '.$limit : ''));
	}

	/**
	 * Charger un(e) mandateElectricCorresponding
	 * @param $pdo PDO
	 * @param $idMandateElectricCorresponding int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateElectricCorresponding
	 */
	public static function load(PDO $pdo,$idMandateElectricCorresponding,$easyload=true)
	{
		// D�j� charg�(e) ?
		if (isset(MandateElectricCorresponding::$easyload[$idMandateElectricCorresponding])) {
			return MandateElectricCorresponding::$easyload[$idMandateElectricCorresponding];
		}

		// Charger le/la mandateElectricCorresponding
		$pdoStatement = MandateElectricCorresponding::_select($pdo,'m.idMandateElectricCorresponding = ?');
		if (!$pdoStatement->execute(array($idMandateElectricCorresponding))) {
			throw new Exception('Erreur lors du chargement d\'un(e) mandateElectricCorresponding depuis la base de donn�es');
		}

		// R�cup�rer le/la mandateElectricCorresponding depuis le jeu de r�sultats
		return MandateElectricCorresponding::fetch($pdo,$pdoStatement,$easyload);
	}

	/**
	 * Charger tous/toutes les mandateElectricCorrespondings
	 * @param $pdo PDO
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateElectricCorresponding[] tableau de mandateelectriccorrespondings
	 */
	public static function loadAll(PDO $pdo,$easyload=false)
	{
		// S�lectionner tous/toutes les mandateElectricCorrespondings
		$pdoStatement = MandateElectricCorresponding::selectAll($pdo);

		// Mettre chaque mandateElectricCorresponding dans un tableau
		$mandateElectricCorrespondings = array();
		while ($mandateElectricCorresponding = MandateElectricCorresponding::fetch($pdo,$pdoStatement,$easyload)) {
			$mandateElectricCorrespondings[] = $mandateElectricCorresponding;
		}

		// Retourner le tableau
		return $mandateElectricCorrespondings;
	}

	/**
	 * S�lectionner tous/toutes les mandateElectricCorrespondings
	 * @param $pdo PDO
	 * @return PDOStatement
	 */
	public static function selectAll(PDO $pdo)
	{
		$pdoStatement = MandateElectricCorresponding::_select($pdo);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les mandateElectricCorrespondings depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�re le/la mandateElectricCorresponding suivant(e) d'un jeu de r�sultats
	 * @param $pdo PDO
	 * @param $pdoStatement PDOStatement
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateElectricCorresponding
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idMandateElectricCorresponding,$name,$code) = $values;

		// Construire le/la mandateElectricCorresponding
		return isset(MandateElectricCorresponding::$easyload[$idMandateElectricCorresponding.'-'.$name.'-'.$code]) ? MandateElectricCorresponding::$easyload[$idMandateElectricCorresponding.'-'.$name.'-'.$code] :
		new MandateElectricCorresponding($pdo,$idMandateElectricCorresponding,$name,$code,$easyload);
	}

	/**
	 * Serialiser
	 * @param $serialize bool activer la s�rialisation ?
	 * @return string serialisation du/de la mandateelectriccorresponding
	 */
	public function serialize($serialize=true)
	{
		// S�rialiser le/la mandateElectricCorresponding
		$array = array('idMandateElectricCorresponding' => $this->idMandateElectricCorresponding,'name' => $this->name,'code' => $this->code);

		// Retourner la serialisation (ou pas) du/de la mandateElectricCorresponding
		return $serialize ? serialize($array) : $array;
	}

	/**
	 * D�s�rialiser
	 * @param $pdo PDO
	 * @param $string string serialisation du/de la mandateelectriccorresponding
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandateElectricCorresponding
	 */
	public static function unserialize(PDO $pdo,$string,$easyload=true)
	{
		// D�s�rialiser la chaine de caract�res
		$array = unserialize($string);

		// Construire le/la mandateElectricCorresponding
		return isset(MandateElectricCorresponding::$easyload[$array['idMandateElectricCorresponding']]) ? MandateElectricCorresponding::$easyload[$array['idMandateElectricCorresponding']] :
		new MandateElectricCorresponding($pdo,$array['idMandateElectricCorresponding'],$array['name'],$array['code'],$easyload);
	}

	/**
	 * Test d'�galit�
	 * @param $mandateElectricCorresponding MandateElectricCorresponding
	 * @return bool les objets sont ils �gaux ?
	 */
	public function equals($mandateElectricCorresponding)
	{
		// Test si null
		if ($mandateElectricCorresponding == null) { return false; }

		// Tester la classe
		if (!($mandateElectricCorresponding instanceof MandateElectricCorresponding)) { return false; }

		// Tester les ids
		return $this->idMandateElectricCorresponding == $mandateElectricCorresponding->idMandateElectricCorresponding;
	}

	/**
	 * Compter les mandateElectricCorrespondings
	 * @param $pdo PDO
	 * @return int nombre de mandateelectriccorrespondings
	 */
	public static function count(PDO $pdo)
	{
		if (!($pdoStatement = $pdo->query('SELECT COUNT(idMandateElectricCorresponding) FROM MandateElectricCorresponding'))) {
			throw new Exception('Erreur lors du comptage des mandateElectricCorrespondings dans la base de donn�es');
		}
		return $pdoStatement->fetchColumn();
	}

	/**
	 * Supprimer le/la mandateElectricCorresponding
	 * @return bool op�ration r�ussie ?
	 */
	public function delete()
	{
		// Supprimer les mandates associ�(e)s
		$select = $this->selectMandates();
		while ($mandate = Mandate::fetch($this->pdo,$select)) {
			if (!$mandate->delete()) { return false; }
		}

		// Supprimer le/la mandateElectricCorresponding
		$pdoStatement = $this->pdo->prepare('DELETE FROM MandateElectricCorresponding WHERE idMandateElectricCorresponding = ?');
		if (!$pdoStatement->execute(array($this->getIdMandateElectricCorresponding()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) mandateElectricCorresponding dans la base de donn�es');
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
		$pdoStatement = $this->pdo->prepare('UPDATE MandateElectricCorresponding SET '.implode(', ', $updates).' WHERE idMandateElectricCorresponding = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdMandateElectricCorresponding())))) {
			throw new Exception('Erreur lors de la mise � jour d\'un champ d\'un(e) mandateElectricCorresponding dans la base de donn�es');
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
	 * R�cup�rer le/la idMandateElectricCorresponding
	 * @return int
	 */
	public function getIdMandateElectricCorresponding()
	{
		return $this->idMandateElectricCorresponding;
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
		return Mandate::selectByElectricCorresponding($this->pdo,$this);
	}
	/**
	 * ToString
	 * @return string repr�sentation de mandateelectriccorresponding sous la forme d'un string
	 */
	public function __toString()
	{
		return '[MandateElectricCorresponding idMandateElectricCorresponding="'.$this->idMandateElectricCorresponding.'" name="'.$this->name.'" code="'.$this->code.'"]';
	}

}

?>
