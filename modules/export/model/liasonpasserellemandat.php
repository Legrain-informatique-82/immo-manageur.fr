<?php

/**
 * @class LiasonPasserelleMandat
 * @date 11/04/2011 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class LiasonPasserelleMandat
{
	/// @var PDO
	private $pdo;

	/// @var array tableau pour le chargement rapide
	private static $easyload;

	/// @var int
	private $idLiasonPasserelleMandat;

	/// @var int id de passerelle
	private $passerelle;

	/// @var int id de mandate
	private $mandate;

	/**
	 * Construire un(e) liasonPasserelleMandat
	 * @param $pdo PDO
	 * @param $idLiasonPasserelleMandat int
	 * @param $passerelle int id de passerelle
	 * @param $mandate int id de mandate
	 * @param $easyload bool activer le chargement rapide ?
	 * @return LiasonPasserelleMandat
	 */
	protected function __construct(PDO $pdo,$idLiasonPasserelleMandat,$passerelle,$mandate,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;

		// Sauvegarder les attributs
		$this->idLiasonPasserelleMandat = $idLiasonPasserelleMandat;
		$this->passerelle = $passerelle;
		$this->mandate = $mandate;

		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			LiasonPasserelleMandat::$easyload[$idLiasonPasserelleMandat] = $this;
		}
	}

	/**
	 * Cr�er un(e) liasonPasserelleMandat
	 * @param $pdo PDO
	 * @param $passerelle Passerelle
	 * @param $mandate Mandate
	 * @param $easyload bool activer le chargement rapide ?
	 * @return LiasonPasserelleMandat
	 */
	public static function create(PDO $pdo,Passerelle $passerelle,Mandate $mandate,$easyload=true)
	{
		// Ajouter le/la liasonPasserelleMandat dans la base de donn�es
		$pdoStatement = $pdo->prepare('INSERT INTO LiasonPasserelleMandat (passerelle_idPasserelle,mandate_idMandate) VALUES (?,?)');
		if (!$pdoStatement->execute(array($passerelle->getIdPasserelle(),$mandate->getIdMandate()))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) liasonPasserelleMandat dans la base de donn�es');
		}

		// Construire le/la liasonPasserelleMandat
		return new LiasonPasserelleMandat($pdo,$pdo->lastInsertId(),$passerelle->getIdPasserelle(),$mandate->getIdMandate(),$easyload);
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
		return $pdo->prepare('SELECT l.idLiasonPasserelleMandat, l.passerelle_idPasserelle, l.mandate_idMandate FROM LiasonPasserelleMandat l '.
		($where != null ? ' WHERE '.$where : '').
		($orderby != null ? ' ORDER BY '.$orderby : '').
		($limit != null ? ' LIMIT '.$limit : ''));
	}

	/**
	 * Charger un(e) liasonPasserelleMandat
	 * @param $pdo PDO
	 * @param $idLiasonPasserelleMandat int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return LiasonPasserelleMandat
	 */
	public static function load(PDO $pdo,$idLiasonPasserelleMandat,$easyload=true)
	{
		// D�j� charg�(e) ?
		if (isset(LiasonPasserelleMandat::$easyload[$idLiasonPasserelleMandat])) {
			return LiasonPasserelleMandat::$easyload[$idLiasonPasserelleMandat];
		}

		// Charger le/la liasonPasserelleMandat
		$pdoStatement = LiasonPasserelleMandat::_select($pdo,'l.idLiasonPasserelleMandat = ?');
		if (!$pdoStatement->execute(array($idLiasonPasserelleMandat))) {
			throw new Exception('Erreur lors du chargement d\'un(e) liasonPasserelleMandat depuis la base de donn�es');
		}

		// R�cup�rer le/la liasonPasserelleMandat depuis le jeu de r�sultats
		return LiasonPasserelleMandat::fetch($pdo,$pdoStatement,$easyload);
	}

	/**
	 * Charger tous/toutes les liasonPasserelleMandats
	 * @param $pdo PDO
	 * @param $easyload bool activer le chargement rapide ?
	 * @return LiasonPasserelleMandat[] tableau de liasonpasserellemandats
	 */
	public static function loadAll(PDO $pdo,$easyload=false)
	{
		// S�lectionner tous/toutes les liasonPasserelleMandats
		$pdoStatement = LiasonPasserelleMandat::selectAll($pdo);

		// Mettre chaque liasonPasserelleMandat dans un tableau
		$liasonPasserelleMandats = array();
		while ($liasonPasserelleMandat = LiasonPasserelleMandat::fetch($pdo,$pdoStatement,$easyload)) {
			$liasonPasserelleMandats[] = $liasonPasserelleMandat;
		}

		// Retourner le tableau
		return $liasonPasserelleMandats;
	}

	/**
	 * S�lectionner tous/toutes les liasonPasserelleMandats
	 * @param $pdo PDO
	 * @return PDOStatement
	 */
	public static function selectAll(PDO $pdo)
	{
		$pdoStatement = LiasonPasserelleMandat::_select($pdo);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les liasonPasserelleMandats depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�re le/la liasonPasserelleMandat suivant(e) d'un jeu de r�sultats
	 * @param $pdo PDO
	 * @param $pdoStatement PDOStatement
	 * @param $easyload bool activer le chargement rapide ?
	 * @return LiasonPasserelleMandat
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idLiasonPasserelleMandat,$passerelle,$mandate) = $values;

		// Construire le/la liasonPasserelleMandat
		return isset(LiasonPasserelleMandat::$easyload[$idLiasonPasserelleMandat.'-'.$passerelle.'-'.$mandate]) ? LiasonPasserelleMandat::$easyload[$idLiasonPasserelleMandat.'-'.$passerelle.'-'.$mandate] :
		new LiasonPasserelleMandat($pdo,$idLiasonPasserelleMandat,$passerelle,$mandate,$easyload);
	}

	/**
	 * Serialiser
	 * @param $serialize bool activer la s�rialisation ?
	 * @return string serialisation du/de la liasonpasserellemandat
	 */
	public function serialize($serialize=true)
	{
		// S�rialiser le/la liasonPasserelleMandat
		$array = array('idLiasonPasserelleMandat' => $this->idLiasonPasserelleMandat,'passerelle' => $this->passerelle,'mandate' => $this->mandate);

		// Retourner la serialisation (ou pas) du/de la liasonPasserelleMandat
		return $serialize ? serialize($array) : $array;
	}

	/**
	 * D�s�rialiser
	 * @param $pdo PDO
	 * @param $string string serialisation du/de la liasonpasserellemandat
	 * @param $easyload bool activer le chargement rapide ?
	 * @return LiasonPasserelleMandat
	 */
	public static function unserialize(PDO $pdo,$string,$easyload=true)
	{
		// D�s�rialiser la chaine de caract�res
		$array = unserialize($string);

		// Construire le/la liasonPasserelleMandat
		return isset(LiasonPasserelleMandat::$easyload[$array['idLiasonPasserelleMandat']]) ? LiasonPasserelleMandat::$easyload[$array['idLiasonPasserelleMandat']] :
		new LiasonPasserelleMandat($pdo,$array['idLiasonPasserelleMandat'],$array['passerelle'],$array['mandate'],$easyload);
	}

	/**
	 * Test d'�galit�
	 * @param $liasonPasserelleMandat LiasonPasserelleMandat
	 * @return bool les objets sont ils �gaux ?
	 */
	public function equals($liasonPasserelleMandat)
	{
		// Test si null
		if ($liasonPasserelleMandat == null) { return false; }

		// Tester la classe
		if (!($liasonPasserelleMandat instanceof LiasonPasserelleMandat)) { return false; }

		// Tester les ids
		return $this->idLiasonPasserelleMandat == $liasonPasserelleMandat->idLiasonPasserelleMandat;
	}

	/**
	 * Compter les liasonPasserelleMandats
	 * @param $pdo PDO
	 * @return int nombre de liasonpasserellemandats
	 */
	public static function count(PDO $pdo)
	{
		if (!($pdoStatement = $pdo->query('SELECT COUNT(idLiasonPasserelleMandat) FROM LiasonPasserelleMandat'))) {
			throw new Exception('Erreur lors du comptage des liasonPasserelleMandats dans la base de donn�es');
		}
		return $pdoStatement->fetchColumn();
	}

	/**
	 * Supprimer le/la liasonPasserelleMandat
	 * @return bool op�ration r�ussie ?
	 */
	public function delete()
	{
		// Supprimer le/la liasonPasserelleMandat
		$pdoStatement = $this->pdo->prepare('DELETE FROM LiasonPasserelleMandat WHERE idLiasonPasserelleMandat = ?');
		if (!$pdoStatement->execute(array($this->getIdLiasonPasserelleMandat()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) liasonPasserelleMandat dans la base de donn�es');
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
		$pdoStatement = $this->pdo->prepare('UPDATE LiasonPasserelleMandat SET '.implode(', ', $updates).' WHERE idLiasonPasserelleMandat = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdLiasonPasserelleMandat())))) {
			throw new Exception('Erreur lors de la mise � jour d\'un champ d\'un(e) liasonPasserelleMandat dans la base de donn�es');
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
		return $this->_set(array('passerelle_idPasserelle','mandate_idMandate'),array($this->passerelle,$this->mandate));
	}

	/**
	 * R�cup�rer le/la idLiasonPasserelleMandat
	 * @return int
	 */
	public function getIdLiasonPasserelleMandat()
	{
		return $this->idLiasonPasserelleMandat;
	}
public function getId()
	{
		return $this->idLiasonPasserelleMandat;
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
	 * S�lectionner les liasonPasserelleMandats par passerelle
	 * @param $pdo PDO
	 * @param $passerelle Passerelle
	 * @return PDOStatement
	 */
	public static function selectByPasserelle(PDO $pdo,Passerelle $passerelle)
	{
		$pdoStatement = $pdo->prepare('SELECT l.idLiasonPasserelleMandat, l.passerelle_idPasserelle, l.mandate_idMandate FROM LiasonPasserelleMandat l WHERE l.passerelle_idPasserelle = ?');
		if (!$pdoStatement->execute(array($passerelle->getIdPasserelle()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les liasonPasserelleMandats par passerelle depuis la base de donn�es');
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
	 * S�lectionner les liasonPasserelleMandats par mandate
	 * @param $pdo PDO
	 * @param $mandate Mandate
	 * @return PDOStatement
	 */
	public static function selectByMandate(PDO $pdo,Mandate $mandate)
	{
		$pdoStatement = $pdo->prepare('SELECT l.idLiasonPasserelleMandat, l.passerelle_idPasserelle, l.mandate_idMandate FROM LiasonPasserelleMandat l WHERE l.mandate_idMandate = ?');
		if (!$pdoStatement->execute(array($mandate->getIdMandate()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les liasonPasserelleMandats par mandate depuis la base de donn�es');
		}
		return $pdoStatement;
	}
	/**
	 * ToString
	 * @return string repr�sentation de liasonpasserellemandat sous la forme d'un string
	 */
	public function __toString()
	{
		return '[LiasonPasserelleMandat idLiasonPasserelleMandat="'.$this->idLiasonPasserelleMandat.'" passerelle="'.$this->passerelle.'" mandate="'.$this->mandate.'"]';
	}

	/**
	 * Additionnal methods
	 */

	public function deleteByMandate(PDO $pdo,Mandate $mandate, $exclude = array()){
		$sql = "DELETE FROM LiasonPasserelleMandat WHERE mandate_idMandate = ? ";
		$values[] = $mandate->getIdMandate();

		if(!empty($exclude)){
			foreach ($exclude as $e ){
				$sql.=" AND passerelle_idPasserelle != ? ";
				$values[] = $e->getIdPasserelle();
			}
		}

		$pdoStatement = $pdo->prepare($sql);
		if (!$pdoStatement->execute( $values )) {
			throw new Exception('e');
		}
		return $pdoStatement->rowCount() == 1;

	}

	public static function loadByPasserelle(PDO $pdo, Passerelle $passerelle){
		$pdoStatement = $pdo->prepare('SELECT l.idLiasonPasserelleMandat, l.passerelle_idPasserelle, l.mandate_idMandate FROM LiasonPasserelleMandat l WHERE l.passerelle_idPasserelle = ?');
		if (!$pdoStatement->execute(array($passerelle->getIdPasserelle()))) {
			throw new Exception('Erreur lors du listage des liaisons');
		}


		// Mettre chaque liasonPasserelleMandat dans un tableau
		$liasonPasserelleMandats = array();
		while ($liasonPasserelleMandat = LiasonPasserelleMandat::fetch($pdo,$pdoStatement,$easyload)) {
			$liasonPasserelleMandats[] = $liasonPasserelleMandat;
		}

		// Retourner le tableau
		return $liasonPasserelleMandats;

	}

	public static function loadByPasserelleAndMandate(PDO $pdo, Passerelle $passerelle,Mandate $mandate){
		$pdoStatement = $pdo->prepare('SELECT l.idLiasonPasserelleMandat, l.passerelle_idPasserelle, l.mandate_idMandate FROM LiasonPasserelleMandat l WHERE l.passerelle_idPasserelle = ? AND l.mandate_idMandate = ?');
		if (!$pdoStatement->execute(array($passerelle->getIdPasserelle(),$mandate->getIdMandate()))) {
			throw new Exception('Erreur lors du listage des liaisons');
		}

		// Retourner le tableau
		return LiasonPasserelleMandat::fetch($pdo,$pdoStatement,$easyload);

	}
}

?>
