<?php

/**
 * @class ValDpe
 * @date 07/04/2011 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class ValDpe
{
	/// @var PDO
	private $pdo;

	/// @var array tableau pour le chargement rapide
	private static $easyload;

	/// @var int
	private $idValDpe;

	/// @var int
	private $consoEner;

	/// @var int
	private $emissionGaz;

	/// @var int id de mandate
	private $mandate;

	/**
	 * Construire un(e) valDpe
	 * @param $pdo PDO
	 * @param $idValDpe int
	 * @param $consoEner int
	 * @param $emissionGaz int
	 * @param $mandate int id de mandate
	 * @param $easyload bool activer le chargement rapide ?
	 * @return ValDpe
	 */
	protected function __construct(PDO $pdo,$idValDpe,$consoEner,$emissionGaz,$mandate,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;

		// Sauvegarder les attributs
		$this->idValDpe = $idValDpe;
		$this->consoEner = $consoEner;
		$this->emissionGaz = $emissionGaz;
		$this->mandate = $mandate;

		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			ValDpe::$easyload[$idValDpe] = $this;
		}
	}

	/**
	 * Cr�er un(e) valDpe
	 * @param $pdo PDO
	 * @param $consoEner int
	 * @param $emissionGaz int
	 * @param $mandate Mandate
	 * @param $easyload bool activer le chargement rapide ?
	 * @return ValDpe
	 */
	public static function create(PDO $pdo,$consoEner,$emissionGaz,Mandate $mandate,$easyload=true)
	{
		// Ajouter le/la valDpe dans la base de donn�es
		$pdoStatement = $pdo->prepare('INSERT INTO ValDpe (consoEner,emissionGaz,mandate_idMandate) VALUES (?,?,?)');
		if (!$pdoStatement->execute(array($consoEner,$emissionGaz,$mandate->getIdMandate()))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) valDpe dans la base de donn�es');
		}

		// Construire le/la valDpe
		return new ValDpe($pdo,$pdo->lastInsertId(),$consoEner,$emissionGaz,$mandate->getIdMandate(),$easyload);
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
		return $pdo->prepare('SELECT v.idValDpe, v.consoEner, v.emissionGaz, v.mandate_idMandate FROM ValDpe v '.
		($where != null ? ' WHERE '.$where : '').
		($orderby != null ? ' ORDERBY '.$orderby : '').
		($limit != null ? ' LIMIT '.$limit : ''));
	}

	/**
	 * Charger un(e) valDpe
	 * @param $pdo PDO
	 * @param $idValDpe int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return ValDpe
	 */
	public static function load(PDO $pdo,$idValDpe,$easyload=true)
	{
		// D�j� charg�(e) ?
		if (isset(ValDpe::$easyload[$idValDpe])) {
			return ValDpe::$easyload[$idValDpe];
		}

		// Charger le/la valDpe
		$pdoStatement = ValDpe::_select($pdo,'v.idValDpe = ?');
		if (!$pdoStatement->execute(array($idValDpe))) {
			throw new Exception('Erreur lors du chargement d\'un(e) valDpe depuis la base de donn�es');
		}

		// R�cup�rer le/la valDpe depuis le jeu de r�sultats
		return ValDpe::fetch($pdo,$pdoStatement,$easyload);
	}

	/**
	 * Charger tous/toutes les valDpes
	 * @param $pdo PDO
	 * @param $easyload bool activer le chargement rapide ?
	 * @return ValDpe[] tableau de valdpes
	 */
	public static function loadAll(PDO $pdo,$easyload=false)
	{
		// S�lectionner tous/toutes les valDpes
		$pdoStatement = ValDpe::selectAll($pdo);

		// Mettre chaque valDpe dans un tableau
		$valDpes = array();
		while ($valDpe = ValDpe::fetch($pdo,$pdoStatement,$easyload)) {
			$valDpes[] = $valDpe;
		}

		// Retourner le tableau
		return $valDpes;
	}

	/**
	 * S�lectionner tous/toutes les valDpes
	 * @param $pdo PDO
	 * @return PDOStatement
	 */
	public static function selectAll(PDO $pdo)
	{
		$pdoStatement = ValDpe::_select($pdo);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les valDpes depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�re le/la valDpe suivant(e) d'un jeu de r�sultats
	 * @param $pdo PDO
	 * @param $pdoStatement PDOStatement
	 * @param $easyload bool activer le chargement rapide ?
	 * @return ValDpe
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idValDpe,$consoEner,$emissionGaz,$mandate) = $values;

		// Construire le/la valDpe
		return isset(ValDpe::$easyload[$idValDpe.'-'.$consoEner.'-'.$emissionGaz.'-'.$mandate]) ? ValDpe::$easyload[$idValDpe.'-'.$consoEner.'-'.$emissionGaz.'-'.$mandate] :
		new ValDpe($pdo,$idValDpe,$consoEner,$emissionGaz,$mandate,$easyload);
	}

	/**
	 * Serialiser
	 * @param $serialize bool activer la s�rialisation ?
	 * @return string serialisation du/de la valdpe
	 */
	public function serialize($serialize=true)
	{
		// S�rialiser le/la valDpe
		$array = array('idValDpe' => $this->idValDpe,'consoEner' => $this->consoEner,'emissionGaz' => $this->emissionGaz,'mandate' => $this->mandate);

		// Retourner la serialisation (ou pas) du/de la valDpe
		return $serialize ? serialize($array) : $array;
	}

	/**
	 * D�s�rialiser
	 * @param $pdo PDO
	 * @param $string string serialisation du/de la valdpe
	 * @param $easyload bool activer le chargement rapide ?
	 * @return ValDpe
	 */
	public static function unserialize(PDO $pdo,$string,$easyload=true)
	{
		// D�s�rialiser la chaine de caract�res
		$array = unserialize($string);

		// Construire le/la valDpe
		return isset(ValDpe::$easyload[$array['idValDpe']]) ? ValDpe::$easyload[$array['idValDpe']] :
		new ValDpe($pdo,$array['idValDpe'],$array['consoEner'],$array['emissionGaz'],$array['mandate'],$easyload);
	}

	/**
	 * Test d'�galit�
	 * @param $valDpe ValDpe
	 * @return bool les objets sont ils �gaux ?
	 */
	public function equals($valDpe)
	{
		// Test si null
		if ($valDpe == null) { return false; }

		// Tester la classe
		if (!($valDpe instanceof ValDpe)) { return false; }

		// Tester les ids
		return $this->idValDpe == $valDpe->idValDpe;
	}

	/**
	 * Compter les valDpes
	 * @param $pdo PDO
	 * @return int nombre de valdpes
	 */
	public static function count(PDO $pdo)
	{
		if (!($pdoStatement = $pdo->query('SELECT COUNT(idValDpe) FROM ValDpe'))) {
			throw new Exception('Erreur lors du comptage des valDpes dans la base de donn�es');
		}
		return $pdoStatement->fetchColumn();
	}

	/**
	 * Supprimer le/la valDpe
	 * @return bool op�ration r�ussie ?
	 */
	public function delete()
	{
		// Supprimer le/la valDpe
		$pdoStatement = $this->pdo->prepare('DELETE FROM ValDpe WHERE idValDpe = ?');
		if (!$pdoStatement->execute(array($this->getIdValDpe()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) valDpe dans la base de donn�es');
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
		$pdoStatement = $this->pdo->prepare('UPDATE ValDpe SET '.implode(', ', $updates).' WHERE idValDpe = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdValDpe())))) {
			throw new Exception('Erreur lors de la mise � jour d\'un champ d\'un(e) valDpe dans la base de donn�es');
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
		return $this->_set(array('consoEner','emissionGaz','mandate_idMandate'),array($this->consoEner,$this->emissionGaz,$this->mandate));
	}

	/**
	 * R�cup�rer le/la idValDpe
	 * @return int
	 */
	public function getIdValDpe()
	{
		return $this->idValDpe;
	}

	/**
	 * R�cup�rer le/la consoEner
	 * @return int
	 */
	public function getConsoEner()
	{
		return $this->consoEner;
	}

	/**
	 * D�finir le/la consoEner
	 * @param $consoEner int
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setConsoEner($consoEner,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->consoEner = $consoEner;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('consoEner'),array($consoEner)) : true;
	}

	/**
	 * R�cup�rer le/la emissionGaz
	 * @return int
	 */
	public function getEmissionGaz()
	{
		return $this->emissionGaz;
	}

	/**
	 * D�finir le/la emissionGaz
	 * @param $emissionGaz int
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setEmissionGaz($emissionGaz,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->emissionGaz = $emissionGaz;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('emissionGaz'),array($emissionGaz)) : true;
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
	 * S�lectionner les valDpes par mandate
	 * @param $pdo PDO
	 * @param $mandate Mandate
	 * @return PDOStatement
	 */
	public static function selectByMandate(PDO $pdo,Mandate $mandate)
	{
		$pdoStatement = $pdo->prepare('SELECT v.idValDpe, v.consoEner, v.emissionGaz, v.mandate_idMandate FROM ValDpe v WHERE v.mandate_idMandate = ?');
		if (!$pdoStatement->execute(array($mandate->getIdMandate()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les valDpes par mandate depuis la base de donn�es');
		}
		return $pdoStatement;
	}
	/**
	 * ToString
	 * @return string repr�sentation de valdpe sous la forme d'un string
	 */
	public function __toString()
	{
		return '[ValDpe idValDpe="'.$this->idValDpe.'" consoEner="'.$this->consoEner.'" emissionGaz="'.$this->emissionGaz.'" mandate="'.$this->mandate.'"]';
	}
	/**
	 * Additionnal method
	 */

	/**
	 * Charger un(e) valDpe
	 * @param $pdo PDO
	 * @param $idValDpe int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return ValDpe
	 */
	public static function loadByMandate(PDO $pdo,Mandate $mandate,$easyload=false)
	{

		$pdoStatement = ValDpe::selectByMandate($pdo,$mandate);
		//		$valDpes = array();
		//		while ($valDpe = ValDpe::fetch($pdo,$pdoStatement,$easyload)) {
		//			$valDpes[] = $valDpe;
		//		}

		// Retourner le tableau
		//		return $valDpes;
		// R�cup�rer le/la valDpe depuis le jeu de r�sultats
		return ValDpe::fetch($pdo,$pdoStatement,$easyload);
	}
}

?>
