<?php

/**
 * @class DpeConsoEner
 * @date 07/04/2011 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class DpeConsoEner
{
	/// @var PDO
	private $pdo;

	/// @var array tableau pour le chargement rapide
	private static $easyload;

	/// @var int
	private $idDpeConsoEner;

	/// @var string
	private $name;

	/// @var int
	private $from;

	/// @var int
	private $to;

	/// @var int
	private $position;

	/**
	 * Construire un(e) dpeConsoEner
	 * @param $pdo PDO
	 * @param $idDpeConsoEner int
	 * @param $name string
	 * @param $from int
	 * @param $to int
	 * @param $position int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return DpeConsoEner
	 */
	protected function __construct(PDO $pdo,$idDpeConsoEner,$name,$from,$to,$position,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;

		// Sauvegarder les attributs
		$this->idDpeConsoEner = $idDpeConsoEner;
		$this->name = $name;
		$this->from = $from;
		$this->to = $to;
		$this->position = $position;

		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			DpeConsoEner::$easyload[$idDpeConsoEner] = $this;
		}
	}

	/**
	 * Cr�er un(e) dpeConsoEner
	 * @param $pdo PDO
	 * @param $name string
	 * @param $from int
	 * @param $to int
	 * @param $position int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return DpeConsoEner
	 */
	public static function create(PDO $pdo,$name,$from,$to,$position,$easyload=true)
	{
		// Ajouter le/la dpeConsoEner dans la base de donn�es
		$pdoStatement = $pdo->prepare('INSERT INTO DpeConsoEner (name,from,to,position) VALUES (?,?,?,?)');
		if (!$pdoStatement->execute(array($name,$from,$to,$position))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) dpeConsoEner dans la base de donn�es');
		}

		// Construire le/la dpeConsoEner
		return new DpeConsoEner($pdo,$pdo->lastInsertId(),$name,$from,$to,$position,$easyload);
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
		return $pdo->prepare('SELECT d.idDpeConsoEner, d.name, d.from, d.to, d.position FROM DpeConsoEner d '.
		($where != null ? ' WHERE '.$where : '').
		($orderby != null ? ' ORDERBY '.$orderby : '').
		($limit != null ? ' LIMIT '.$limit : ''));
	}

	/**
	 * Charger un(e) dpeConsoEner
	 * @param $pdo PDO
	 * @param $idDpeConsoEner int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return DpeConsoEner
	 */
	public static function load(PDO $pdo,$idDpeConsoEner,$easyload=true)
	{
		// D�j� charg�(e) ?
		if (isset(DpeConsoEner::$easyload[$idDpeConsoEner])) {
			return DpeConsoEner::$easyload[$idDpeConsoEner];
		}

		// Charger le/la dpeConsoEner
		$pdoStatement = DpeConsoEner::_select($pdo,'d.idDpeConsoEner = ?');
		if (!$pdoStatement->execute(array($idDpeConsoEner))) {
			throw new Exception('Erreur lors du chargement d\'un(e) dpeConsoEner depuis la base de donn�es');
		}

		// R�cup�rer le/la dpeConsoEner depuis le jeu de r�sultats
		return DpeConsoEner::fetch($pdo,$pdoStatement,$easyload);
	}

	/**
	 * Charger tous/toutes les dpeConsoEners
	 * @param $pdo PDO
	 * @param $easyload bool activer le chargement rapide ?
	 * @return DpeConsoEner[] tableau de dpeconsoeners
	 */
	public static function loadAll(PDO $pdo,$easyload=false)
	{
		// S�lectionner tous/toutes les dpeConsoEners
		$pdoStatement = DpeConsoEner::selectAll($pdo);

		// Mettre chaque dpeConsoEner dans un tableau
		$dpeConsoEners = array();
		while ($dpeConsoEner = DpeConsoEner::fetch($pdo,$pdoStatement,$easyload)) {
			$dpeConsoEners[] = $dpeConsoEner;
		}

		// Retourner le tableau
		return $dpeConsoEners;
	}

	/**
	 * S�lectionner tous/toutes les dpeConsoEners
	 * @param $pdo PDO
	 * @return PDOStatement
	 */
	public static function selectAll(PDO $pdo)
	{
		$pdoStatement = DpeConsoEner::_select($pdo);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les dpeConsoEners depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�re le/la dpeConsoEner suivant(e) d'un jeu de r�sultats
	 * @param $pdo PDO
	 * @param $pdoStatement PDOStatement
	 * @param $easyload bool activer le chargement rapide ?
	 * @return DpeConsoEner
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idDpeConsoEner,$name,$from,$to,$position) = $values;

		// Construire le/la dpeConsoEner
		return isset(DpeConsoEner::$easyload[$idDpeConsoEner.'-'.$name.'-'.$from.'-'.$to.'-'.$position]) ? DpeConsoEner::$easyload[$idDpeConsoEner.'-'.$name.'-'.$from.'-'.$to.'-'.$position] :
		new DpeConsoEner($pdo,$idDpeConsoEner,$name,$from,$to,$position,$easyload);
	}

	/**
	 * Serialiser
	 * @param $serialize bool activer la s�rialisation ?
	 * @return string serialisation du/de la dpeconsoener
	 */
	public function serialize($serialize=true)
	{
		// S�rialiser le/la dpeConsoEner
		$array = array('idDpeConsoEner' => $this->idDpeConsoEner,'name' => $this->name,'from' => $this->from,'to' => $this->to,'position' => $this->position);

		// Retourner la serialisation (ou pas) du/de la dpeConsoEner
		return $serialize ? serialize($array) : $array;
	}

	/**
	 * D�s�rialiser
	 * @param $pdo PDO
	 * @param $string string serialisation du/de la dpeconsoener
	 * @param $easyload bool activer le chargement rapide ?
	 * @return DpeConsoEner
	 */
	public static function unserialize(PDO $pdo,$string,$easyload=true)
	{
		// D�s�rialiser la chaine de caract�res
		$array = unserialize($string);

		// Construire le/la dpeConsoEner
		return isset(DpeConsoEner::$easyload[$array['idDpeConsoEner']]) ? DpeConsoEner::$easyload[$array['idDpeConsoEner']] :
		new DpeConsoEner($pdo,$array['idDpeConsoEner'],$array['name'],$array['from'],$array['to'],$array['position'],$easyload);
	}

	/**
	 * Test d'�galit�
	 * @param $dpeConsoEner DpeConsoEner
	 * @return bool les objets sont ils �gaux ?
	 */
	public function equals($dpeConsoEner)
	{
		// Test si null
		if ($dpeConsoEner == null) { return false; }

		// Tester la classe
		if (!($dpeConsoEner instanceof DpeConsoEner)) { return false; }

		// Tester les ids
		return $this->idDpeConsoEner == $dpeConsoEner->idDpeConsoEner;
	}

	/**
	 * Compter les dpeConsoEners
	 * @param $pdo PDO
	 * @return int nombre de dpeconsoeners
	 */
	public static function count(PDO $pdo)
	{
		if (!($pdoStatement = $pdo->query('SELECT COUNT(idDpeConsoEner) FROM DpeConsoEner'))) {
			throw new Exception('Erreur lors du comptage des dpeConsoEners dans la base de donn�es');
		}
		return $pdoStatement->fetchColumn();
	}

	/**
	 * Supprimer le/la dpeConsoEner
	 * @return bool op�ration r�ussie ?
	 */
	public function delete()
	{
		// Supprimer le/la dpeConsoEner
		$pdoStatement = $this->pdo->prepare('DELETE FROM DpeConsoEner WHERE idDpeConsoEner = ?');
		if (!$pdoStatement->execute(array($this->getIdDpeConsoEner()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) dpeConsoEner dans la base de donn�es');
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
		$pdoStatement = $this->pdo->prepare('UPDATE DpeConsoEner SET '.implode(', ', $updates).' WHERE idDpeConsoEner = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdDpeConsoEner())))) {
			throw new Exception('Erreur lors de la mise � jour d\'un champ d\'un(e) dpeConsoEner dans la base de donn�es');
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
	 * R�cup�rer le/la idDpeConsoEner
	 * @return int
	 */
	public function getIdDpeConsoEner()
	{
		return $this->idDpeConsoEner;
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
	 * @return string repr�sentation de dpeconsoener sous la forme d'un string
	 */
	public function __toString()
	{
		return '[DpeConsoEner idDpeConsoEner="'.$this->idDpeConsoEner.'" name="'.$this->name.'" from="'.$this->from.'" to="'.$this->to.'" position="'.$this->position.'"]';
	}

}

?>
