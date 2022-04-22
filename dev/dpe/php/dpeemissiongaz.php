<?php

/**
 * @class DpeEmissionGaz
 * @date 07/04/2011 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class DpeEmissionGaz
{
	/// @var PDO
	private $pdo;

	/// @var array tableau pour le chargement rapide
	private static $easyload;

	/// @var int
	private $idDpeEmissionGaz;

	/// @var string
	private $name;

	/// @var int
	private $from;

	/// @var int
	private $to;

	/// @var int
	private $position;

	/**
	 * Construire un(e) dpeEmissionGaz
	 * @param $pdo PDO
	 * @param $idDpeEmissionGaz int
	 * @param $name string
	 * @param $from int
	 * @param $to int
	 * @param $position int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return DpeEmissionGaz
	 */
	protected function __construct(PDO $pdo,$idDpeEmissionGaz,$name,$from,$to,$position,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;

		// Sauvegarder les attributs
		$this->idDpeEmissionGaz = $idDpeEmissionGaz;
		$this->name = $name;
		$this->from = $from;
		$this->to = $to;
		$this->position = $position;

		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			DpeEmissionGaz::$easyload[$idDpeEmissionGaz] = $this;
		}
	}

	/**
	 * Cr�er un(e) dpeEmissionGaz
	 * @param $pdo PDO
	 * @param $name string
	 * @param $from int
	 * @param $to int
	 * @param $position int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return DpeEmissionGaz
	 */
	public static function create(PDO $pdo,$name,$from,$to,$position,$easyload=true)
	{
		// Ajouter le/la dpeEmissionGaz dans la base de donn�es
		$pdoStatement = $pdo->prepare('INSERT INTO DpeEmissionGaz (name,from,to,position) VALUES (?,?,?,?)');
		if (!$pdoStatement->execute(array($name,$from,$to,$position))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) dpeEmissionGaz dans la base de donn�es');
		}

		// Construire le/la dpeEmissionGaz
		return new DpeEmissionGaz($pdo,$pdo->lastInsertId(),$name,$from,$to,$position,$easyload);
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
		return $pdo->prepare('SELECT d.idDpeEmissionGaz, d.name, d.from, d.to, d.position FROM DpeEmissionGaz d '.
		($where != null ? ' WHERE '.$where : '').
		($orderby != null ? ' ORDERBY '.$orderby : '').
		($limit != null ? ' LIMIT '.$limit : ''));
	}

	/**
	 * Charger un(e) dpeEmissionGaz
	 * @param $pdo PDO
	 * @param $idDpeEmissionGaz int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return DpeEmissionGaz
	 */
	public static function load(PDO $pdo,$idDpeEmissionGaz,$easyload=true)
	{
		// D�j� charg�(e) ?
		if (isset(DpeEmissionGaz::$easyload[$idDpeEmissionGaz])) {
			return DpeEmissionGaz::$easyload[$idDpeEmissionGaz];
		}

		// Charger le/la dpeEmissionGaz
		$pdoStatement = DpeEmissionGaz::_select($pdo,'d.idDpeEmissionGaz = ?');
		if (!$pdoStatement->execute(array($idDpeEmissionGaz))) {
			throw new Exception('Erreur lors du chargement d\'un(e) dpeEmissionGaz depuis la base de donn�es');
		}

		// R�cup�rer le/la dpeEmissionGaz depuis le jeu de r�sultats
		return DpeEmissionGaz::fetch($pdo,$pdoStatement,$easyload);
	}

	/**
	 * Charger tous/toutes les dpeEmissionGazs
	 * @param $pdo PDO
	 * @param $easyload bool activer le chargement rapide ?
	 * @return DpeEmissionGaz[] tableau de dpeemissiongazs
	 */
	public static function loadAll(PDO $pdo,$easyload=false)
	{
		// S�lectionner tous/toutes les dpeEmissionGazs
		$pdoStatement = DpeEmissionGaz::selectAll($pdo);

		// Mettre chaque dpeEmissionGaz dans un tableau
		$dpeEmissionGazs = array();
		while ($dpeEmissionGaz = DpeEmissionGaz::fetch($pdo,$pdoStatement,$easyload)) {
			$dpeEmissionGazs[] = $dpeEmissionGaz;
		}

		// Retourner le tableau
		return $dpeEmissionGazs;
	}

	/**
	 * S�lectionner tous/toutes les dpeEmissionGazs
	 * @param $pdo PDO
	 * @return PDOStatement
	 */
	public static function selectAll(PDO $pdo)
	{
		$pdoStatement = DpeEmissionGaz::_select($pdo);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les dpeEmissionGazs depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�re le/la dpeEmissionGaz suivant(e) d'un jeu de r�sultats
	 * @param $pdo PDO
	 * @param $pdoStatement PDOStatement
	 * @param $easyload bool activer le chargement rapide ?
	 * @return DpeEmissionGaz
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idDpeEmissionGaz,$name,$from,$to,$position) = $values;

		// Construire le/la dpeEmissionGaz
		return isset(DpeEmissionGaz::$easyload[$idDpeEmissionGaz.'-'.$name.'-'.$from.'-'.$to.'-'.$position]) ? DpeEmissionGaz::$easyload[$idDpeEmissionGaz.'-'.$name.'-'.$from.'-'.$to.'-'.$position] :
		new DpeEmissionGaz($pdo,$idDpeEmissionGaz,$name,$from,$to,$position,$easyload);
	}

	/**
	 * Serialiser
	 * @param $serialize bool activer la s�rialisation ?
	 * @return string serialisation du/de la dpeemissiongaz
	 */
	public function serialize($serialize=true)
	{
		// S�rialiser le/la dpeEmissionGaz
		$array = array('idDpeEmissionGaz' => $this->idDpeEmissionGaz,'name' => $this->name,'from' => $this->from,'to' => $this->to,'position' => $this->position);

		// Retourner la serialisation (ou pas) du/de la dpeEmissionGaz
		return $serialize ? serialize($array) : $array;
	}

	/**
	 * D�s�rialiser
	 * @param $pdo PDO
	 * @param $string string serialisation du/de la dpeemissiongaz
	 * @param $easyload bool activer le chargement rapide ?
	 * @return DpeEmissionGaz
	 */
	public static function unserialize(PDO $pdo,$string,$easyload=true)
	{
		// D�s�rialiser la chaine de caract�res
		$array = unserialize($string);

		// Construire le/la dpeEmissionGaz
		return isset(DpeEmissionGaz::$easyload[$array['idDpeEmissionGaz']]) ? DpeEmissionGaz::$easyload[$array['idDpeEmissionGaz']] :
		new DpeEmissionGaz($pdo,$array['idDpeEmissionGaz'],$array['name'],$array['from'],$array['to'],$array['position'],$easyload);
	}

	/**
	 * Test d'�galit�
	 * @param $dpeEmissionGaz DpeEmissionGaz
	 * @return bool les objets sont ils �gaux ?
	 */
	public function equals($dpeEmissionGaz)
	{
		// Test si null
		if ($dpeEmissionGaz == null) { return false; }

		// Tester la classe
		if (!($dpeEmissionGaz instanceof DpeEmissionGaz)) { return false; }

		// Tester les ids
		return $this->idDpeEmissionGaz == $dpeEmissionGaz->idDpeEmissionGaz;
	}

	/**
	 * Compter les dpeEmissionGazs
	 * @param $pdo PDO
	 * @return int nombre de dpeemissiongazs
	 */
	public static function count(PDO $pdo)
	{
		if (!($pdoStatement = $pdo->query('SELECT COUNT(idDpeEmissionGaz) FROM DpeEmissionGaz'))) {
			throw new Exception('Erreur lors du comptage des dpeEmissionGazs dans la base de donn�es');
		}
		return $pdoStatement->fetchColumn();
	}

	/**
	 * Supprimer le/la dpeEmissionGaz
	 * @return bool op�ration r�ussie ?
	 */
	public function delete()
	{
		// Supprimer le/la dpeEmissionGaz
		$pdoStatement = $this->pdo->prepare('DELETE FROM DpeEmissionGaz WHERE idDpeEmissionGaz = ?');
		if (!$pdoStatement->execute(array($this->getIdDpeEmissionGaz()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) dpeEmissionGaz dans la base de donn�es');
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
		$pdoStatement = $this->pdo->prepare('UPDATE DpeEmissionGaz SET '.implode(', ', $updates).' WHERE idDpeEmissionGaz = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdDpeEmissionGaz())))) {
			throw new Exception('Erreur lors de la mise � jour d\'un champ d\'un(e) dpeEmissionGaz dans la base de donn�es');
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
		return $this->_set(array('name','from','to','position'),array($this->name,$this->from,$this->to,$this->position));
	}

	/**
	 * R�cup�rer le/la idDpeEmissionGaz
	 * @return int
	 */
	public function getIdDpeEmissionGaz()
	{
		return $this->idDpeEmissionGaz;
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
	 * R�cup�rer le/la from
	 * @return int
	 */
	public function getFrom()
	{
		return $this->from;
	}

	/**
	 * D�finir le/la from
	 * @param $from int
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setFrom($from,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->from = $from;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('from'),array($from)) : true;
	}

	/**
	 * R�cup�rer le/la to
	 * @return int
	 */
	public function getTo()
	{
		return $this->to;
	}

	/**
	 * D�finir le/la to
	 * @param $to int
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setTo($to,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->to = $to;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('to'),array($to)) : true;
	}

	/**
	 * R�cup�rer le/la position
	 * @return int
	 */
	public function getPosition()
	{
		return $this->position;
	}

	/**
	 * D�finir le/la position
	 * @param $position int
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setPosition($position,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->position = $position;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('position'),array($position)) : true;
	}
	/**
	 * ToString
	 * @return string repr�sentation de dpeemissiongaz sous la forme d'un string
	 */
	public function __toString()
	{
		return '[DpeEmissionGaz idDpeEmissionGaz="'.$this->idDpeEmissionGaz.'" name="'.$this->name.'" from="'.$this->from.'" to="'.$this->to.'" position="'.$this->position.'"]';
	}

}

?>
