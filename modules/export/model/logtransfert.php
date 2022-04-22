<?php

/**
 * @class LogTransfert
 * @date 11/04/2011 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class LogTransfert
{
	/// @var PDO
	private $pdo;

	/// @var array tableau pour le chargement rapide
	private static $easyload;

	/// @var int
	private $idLogTransfert;

	/// @var int id de passerelle
	private $passerelle;

	/// @var int id de mandate
	private $mandate;

	/// @var int
	private $dateExport;

	/**
	 * Construire un(e) logTransfert
	 * @param $pdo PDO
	 * @param $idLogTransfert int
	 * @param $passerelle int id de passerelle
	 * @param $mandate int id de mandate
	 * @param $dateExport int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return LogTransfert
	 */
	protected function __construct(PDO $pdo,$idLogTransfert,$passerelle,$mandate,$dateExport,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;

		// Sauvegarder les attributs
		$this->idLogTransfert = $idLogTransfert;
		$this->passerelle = $passerelle;
		$this->mandate = $mandate;
		$this->dateExport = $dateExport;

		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			LogTransfert::$easyload[$idLogTransfert] = $this;
		}
	}

	/**
	 * Cr�er un(e) logTransfert
	 * @param $pdo PDO
	 * @param $passerelle Passerelle
	 * @param $mandate Mandate
	 * @param $dateExport int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return LogTransfert
	 */
	public static function create(PDO $pdo,Passerelle $passerelle,Mandate $mandate,$dateExport,$easyload=true)
	{
		// Ajouter le/la logTransfert dans la base de donn�es
		$pdoStatement = $pdo->prepare('INSERT INTO LogTransfert (passerelle_idPasserelle,mandate_idMandate,dateExport) VALUES (?,?,?)');
		if (!$pdoStatement->execute(array($passerelle->getIdPasserelle(),$mandate->getIdMandate(),date('Y-m-d H:i:s',$dateExport)))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) logTransfert dans la base de donn�es');
		}

		// Construire le/la logTransfert
		return new LogTransfert($pdo,$pdo->lastInsertId(),$passerelle->getIdPasserelle(),$mandate->getIdMandate(),$dateExport,$easyload);
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
		return $pdo->prepare('SELECT l.idLogTransfert, l.passerelle_idPasserelle, l.mandate_idMandate, l.dateExport FROM LogTransfert l '.
		($where != null ? ' WHERE '.$where : '').
		($orderby != null ? ' ORDERBY '.$orderby : '').
		($limit != null ? ' LIMIT '.$limit : ''));
	}

	/**
	 * Charger un(e) logTransfert
	 * @param $pdo PDO
	 * @param $idLogTransfert int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return LogTransfert
	 */
	public static function load(PDO $pdo,$idLogTransfert,$easyload=true)
	{
		// D�j� charg�(e) ?
		if (isset(LogTransfert::$easyload[$idLogTransfert])) {
			return LogTransfert::$easyload[$idLogTransfert];
		}

		// Charger le/la logTransfert
		$pdoStatement = LogTransfert::_select($pdo,'l.idLogTransfert = ?');
		if (!$pdoStatement->execute(array($idLogTransfert))) {
			throw new Exception('Erreur lors du chargement d\'un(e) logTransfert depuis la base de donn�es');
		}

		// R�cup�rer le/la logTransfert depuis le jeu de r�sultats
		return LogTransfert::fetch($pdo,$pdoStatement,$easyload);
	}

	/**
	 * Charger tous/toutes les logTransferts
	 * @param $pdo PDO
	 * @param $easyload bool activer le chargement rapide ?
	 * @return LogTransfert[] tableau de logtransferts
	 */
	public static function loadAll(PDO $pdo,$easyload=false)
	{
		// S�lectionner tous/toutes les logTransferts
		$pdoStatement = LogTransfert::selectAll($pdo);

		// Mettre chaque logTransfert dans un tableau
		$logTransferts = array();
		while ($logTransfert = LogTransfert::fetch($pdo,$pdoStatement,$easyload)) {
			$logTransferts[] = $logTransfert;
		}

		// Retourner le tableau
		return $logTransferts;
	}

	/**
	 * S�lectionner tous/toutes les logTransferts
	 * @param $pdo PDO
	 * @return PDOStatement
	 */
	public static function selectAll(PDO $pdo)
	{
		$pdoStatement = LogTransfert::_select($pdo);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les logTransferts depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�re le/la logTransfert suivant(e) d'un jeu de r�sultats
	 * @param $pdo PDO
	 * @param $pdoStatement PDOStatement
	 * @param $easyload bool activer le chargement rapide ?
	 * @return LogTransfert
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idLogTransfert,$passerelle,$mandate,$dateExport) = $values;

		// Construire le/la logTransfert
		return isset(LogTransfert::$easyload[$idLogTransfert.'-'.$passerelle.'-'.$mandate.'-'.strtotime($dateExport)]) ? LogTransfert::$easyload[$idLogTransfert.'-'.$passerelle.'-'.$mandate.'-'.strtotime($dateExport)] :
		new LogTransfert($pdo,$idLogTransfert,$passerelle,$mandate,strtotime($dateExport),$easyload);
	}

	/**
	 * Serialiser
	 * @param $serialize bool activer la s�rialisation ?
	 * @return string serialisation du/de la logtransfert
	 */
	public function serialize($serialize=true)
	{
		// S�rialiser le/la logTransfert
		$array = array('idLogTransfert' => $this->idLogTransfert,'passerelle' => $this->passerelle,'mandate' => $this->mandate,'dateExport' => $this->dateExport);

		// Retourner la serialisation (ou pas) du/de la logTransfert
		return $serialize ? serialize($array) : $array;
	}

	/**
	 * D�s�rialiser
	 * @param $pdo PDO
	 * @param $string string serialisation du/de la logtransfert
	 * @param $easyload bool activer le chargement rapide ?
	 * @return LogTransfert
	 */
	public static function unserialize(PDO $pdo,$string,$easyload=true)
	{
		// D�s�rialiser la chaine de caract�res
		$array = unserialize($string);

		// Construire le/la logTransfert
		return isset(LogTransfert::$easyload[$array['idLogTransfert']]) ? LogTransfert::$easyload[$array['idLogTransfert']] :
		new LogTransfert($pdo,$array['idLogTransfert'],$array['passerelle'],$array['mandate'],$array['dateExport'],$easyload);
	}

	/**
	 * Test d'�galit�
	 * @param $logTransfert LogTransfert
	 * @return bool les objets sont ils �gaux ?
	 */
	public function equals($logTransfert)
	{
		// Test si null
		if ($logTransfert == null) { return false; }

		// Tester la classe
		if (!($logTransfert instanceof LogTransfert)) { return false; }

		// Tester les ids
		return $this->idLogTransfert == $logTransfert->idLogTransfert;
	}

	/**
	 * Compter les logTransferts
	 * @param $pdo PDO
	 * @return int nombre de logtransferts
	 */
	public static function count(PDO $pdo)
	{
		if (!($pdoStatement = $pdo->query('SELECT COUNT(idLogTransfert) FROM LogTransfert'))) {
			throw new Exception('Erreur lors du comptage des logTransferts dans la base de donn�es');
		}
		return $pdoStatement->fetchColumn();
	}

	/**
	 * Supprimer le/la logTransfert
	 * @return bool op�ration r�ussie ?
	 */
	public function delete()
	{
		// Supprimer le/la logTransfert
		$pdoStatement = $this->pdo->prepare('DELETE FROM LogTransfert WHERE idLogTransfert = ?');
		if (!$pdoStatement->execute(array($this->getIdLogTransfert()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) logTransfert dans la base de donn�es');
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
		$pdoStatement = $this->pdo->prepare('UPDATE LogTransfert SET '.implode(', ', $updates).' WHERE idLogTransfert = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdLogTransfert())))) {
			throw new Exception('Erreur lors de la mise � jour d\'un champ d\'un(e) logTransfert dans la base de donn�es');
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
		return $this->_set(array('passerelle_idPasserelle','mandate_idMandate','dateExport'),array($this->passerelle,$this->mandate,date('Y-m-d H:i:s',$this->dateExport)));
	}

	/**
	 * R�cup�rer le/la idLogTransfert
	 * @return int
	 */
	public function getIdLogTransfert()
	{
		return $this->idLogTransfert;
	}
public function getId()
	{
		return $this->idLogTransfert;
	}
	/**
	 * R�cup�rer le/la passerelle
	 * @return Passerelle
	 */
	public function getPasserelle()
	{
		return Passerelle::load($this->pdo,$this->passerelle);
	}

	/**
	 * D�finir le/la passerelle
	 * @param $passerelle Passerelle
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setPasserelle(Passerelle $passerelle,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->passerelle = $passerelle->getIdPasserelle();

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('passerelle_idPasserelle'),array($passerelle->getIdPasserelle())) : true;
	}

	/**
	 * S�lectionner les logTransferts par passerelle
	 * @param $pdo PDO
	 * @param $passerelle Passerelle
	 * @return PDOStatement
	 */
	public static function selectByPasserelle(PDO $pdo,Passerelle $passerelle)
	{
		$pdoStatement = $pdo->prepare('SELECT l.idLogTransfert, l.passerelle_idPasserelle, l.mandate_idMandate, l.dateExport FROM LogTransfert l WHERE l.passerelle_idPasserelle = ?');
		if (!$pdoStatement->execute(array($passerelle->getIdPasserelle()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les logTransferts par passerelle depuis la base de donn�es');
		}
		return $pdoStatement;
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
	 * S�lectionner les logTransferts par mandate
	 * @param $pdo PDO
	 * @param $mandate Mandate
	 * @return PDOStatement
	 */
	public static function selectByMandate(PDO $pdo,Mandate $mandate)
	{
		$pdoStatement = $pdo->prepare('SELECT l.idLogTransfert, l.passerelle_idPasserelle, l.mandate_idMandate, l.dateExport FROM LogTransfert l WHERE l.mandate_idMandate = ?');
		if (!$pdoStatement->execute(array($mandate->getIdMandate()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les logTransferts par mandate depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�rer le/la dateExport
	 * @return int
	 */
	public function getDateExport()
	{
		return $this->dateExport;
	}

	/**
	 * D�finir le/la dateExport
	 * @param $dateExport int
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setDateExport($dateExport,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->dateExport = $dateExport;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('dateExport'),array(date('Y-m-d H:i:s',$dateExport))) : true;
	}
	/**
	 * ToString
	 * @return string repr�sentation de logtransfert sous la forme d'un string
	 */
	public function __toString()
	{
		return '[LogTransfert idLogTransfert="'.$this->idLogTransfert.'" passerelle="'.$this->passerelle.'" mandate="'.$this->mandate.'" dateExport="'.date('d/m/Y H:i:s',$this->dateExport).'"]';
	}

}

?>
