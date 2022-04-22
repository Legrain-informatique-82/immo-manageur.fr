<?php

/**
 * @class Passerelle
 * @date 11/04/2011 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class Passerelle
{
	/// @var PDO
	private $pdo;

	/// @var array tableau pour le chargement rapide
	private static $easyload;

	/// @var int
	private $idPasserelle;

	/// @var string
	private $name;

	/// @var string
	private $typeExport;

	/// @var string
	private $param;
	private $asset;

	/**
	 * Construire un(e) passerelle
	 * @param $pdo PDO
	 * @param $idPasserelle int
	 * @param $name string
	 * @param $typeExport string
	 * @param $param string
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Passerelle
	 */
	protected function __construct(PDO $pdo,$idPasserelle,$name,$typeExport,$param,$asset ,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;

		// Sauvegarder les attributs
		$this->idPasserelle = $idPasserelle;
		$this->name = $name;
		$this->typeExport = $typeExport;
		$this->param = $param;
		$this->asset = $asset;

		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			Passerelle::$easyload[$idPasserelle] = $this;
		}
	}

	/**
	 * Cr�er un(e) passerelle
	 * @param $pdo PDO
	 * @param $name string
	 * @param $typeExport string
	 * @param $param string
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Passerelle
	 */
	public static function create(PDO $pdo,$name,$typeExport,$param,$asset = 1,$easyload=true)
	{
		// Ajouter le/la passerelle dans la base de donn�es
		$pdoStatement = $pdo->prepare('INSERT INTO Passerelle (name,typeExport,param) VALUES (?,?,?,?)');
		if (!$pdoStatement->execute(array($name,$typeExport,$param,$asset))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) passerelle dans la base de donn�es');
		}

		// Construire le/la passerelle
		return new Passerelle($pdo,$pdo->lastInsertId(),$name,$typeExport,$param,$asset,$easyload);
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
		return $pdo->prepare('SELECT p.idPasserelle, p.name, p.typeExport, p.param, p.asset FROM Passerelle p '.
		($where != null ? ' WHERE '.$where : '').
		($orderby != null ? ' ORDER BY '.$orderby : '').
		($limit != null ? ' LIMIT '.$limit : ''));
	}

	/**
	 * Charger un(e) passerelle
	 * @param $pdo PDO
	 * @param $idPasserelle int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Passerelle
	 */
	public static function load(PDO $pdo,$idPasserelle,$easyload=true)
	{
		// D�j� charg�(e) ?
		if (isset(Passerelle::$easyload[$idPasserelle])) {
			return Passerelle::$easyload[$idPasserelle];
		}

		// Charger le/la passerelle
		$pdoStatement = Passerelle::_select($pdo,'p.idPasserelle = ?');
		if (!$pdoStatement->execute(array($idPasserelle))) {
			throw new Exception('Erreur lors du chargement d\'un(e) passerelle depuis la base de donn�es');
		}

		// R�cup�rer le/la passerelle depuis le jeu de r�sultats
		return Passerelle::fetch($pdo,$pdoStatement,$easyload);
	}

	/**
	 * Charger tous/toutes les passerelles
	 * @param $pdo PDO
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Passerelle[] tableau de passerelles
	 */
	public static function loadAll(PDO $pdo,$easyload=false)
	{
		// S�lectionner tous/toutes les passerelles
		$pdoStatement = Passerelle::selectAll($pdo);

		// Mettre chaque passerelle dans un tableau
		$passerelles = array();
		while ($passerelle = Passerelle::fetch($pdo,$pdoStatement,$easyload)) {
			$passerelles[] = $passerelle;
		}

		// Retourner le tableau
		return $passerelles;
	}

	/**
	 * S�lectionner tous/toutes les passerelles
	 * @param $pdo PDO
	 * @return PDOStatement
	 */
	public static function selectAll(PDO $pdo)
	{
		$pdoStatement = Passerelle::_select($pdo);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les passerelles depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�re le/la passerelle suivant(e) d'un jeu de r�sultats
	 * @param $pdo PDO
	 * @param $pdoStatement PDOStatement
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Passerelle
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idPasserelle,$name,$typeExport,$param,$asset) = $values;

		// Construire le/la passerelle
		return isset(Passerelle::$easyload[$idPasserelle.'-'.$name.'-'.$typeExport.'-'.$param.'-'.$asset]) ? Passerelle::$easyload[$idPasserelle.'-'.$name.'-'.$typeExport.'-'.$param.'-'.$asset] :
		new Passerelle($pdo,$idPasserelle,$name,$typeExport,$param,$asset,$easyload);
	}

	/**
	 * Serialiser
	 * @param $serialize bool activer la s�rialisation ?
	 * @return string serialisation du/de la passerelle
	 */
	public function serialize($serialize=true)
	{
		// S�rialiser le/la passerelle
		$array = array('idPasserelle' => $this->idPasserelle,'name' => $this->name,'typeExport' => $this->typeExport,'param' => $this->param,'asset'=>$this->asset);

		// Retourner la serialisation (ou pas) du/de la passerelle
		return $serialize ? serialize($array) : $array;
	}

	/**
	 * D�s�rialiser
	 * @param $pdo PDO
	 * @param $string string serialisation du/de la passerelle
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Passerelle
	 */
	public static function unserialize(PDO $pdo,$string,$easyload=true)
	{
		// D�s�rialiser la chaine de caract�res
		$array = unserialize($string);

		// Construire le/la passerelle
		return isset(Passerelle::$easyload[$array['idPasserelle']]) ? Passerelle::$easyload[$array['idPasserelle']] :
		new Passerelle($pdo,$array['idPasserelle'],$array['name'],$array['typeExport'],$array['param'],$array['asset'],$easyload);
	}

	/**
	 * Test d'�galit�
	 * @param $passerelle Passerelle
	 * @return bool les objets sont ils �gaux ?
	 */
	public function equals($passerelle)
	{
		// Test si null
		if ($passerelle == null) { return false; }

		// Tester la classe
		if (!($passerelle instanceof Passerelle)) { return false; }

		// Tester les ids
		return $this->idPasserelle == $passerelle->idPasserelle;
	}

	/**
	 * Compter les passerelles
	 * @param $pdo PDO
	 * @return int nombre de passerelles
	 */
	public static function count(PDO $pdo)
	{
		if (!($pdoStatement = $pdo->query('SELECT COUNT(idPasserelle) FROM Passerelle'))) {
			throw new Exception('Erreur lors du comptage des passerelles dans la base de donn�es');
		}
		return $pdoStatement->fetchColumn();
	}

	/**
	 * Supprimer le/la passerelle
	 * @return bool op�ration r�ussie ?
	 */
	public function delete()
	{
		// Supprimer les LiasonPasserelleMandats associ�(e)s
		$select = $this->selectLiasonPasserelleMandats();
		while ($liasonPasserelleMandat = LiasonPasserelleMandat::fetch($this->pdo,$select)) {
			if (!$liasonPasserelleMandat->delete()) { return false; }
		}

		// Supprimer les LogTransferts associ�(e)s
		$select = $this->selectLogTransferts();
		while ($logTransfert = LogTransfert::fetch($this->pdo,$select)) {
			if (!$logTransfert->delete()) { return false; }
		}

		// Supprimer le/la passerelle
		$pdoStatement = $this->pdo->prepare('DELETE FROM Passerelle WHERE idPasserelle = ?');
		if (!$pdoStatement->execute(array($this->getIdPasserelle()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) passerelle dans la base de donn�es');
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
		$pdoStatement = $this->pdo->prepare('UPDATE Passerelle SET '.implode(', ', $updates).' WHERE idPasserelle = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdPasserelle())))) {
			throw new Exception('Erreur lors de la mise � jour d\'un champ d\'un(e) passerelle dans la base de donn�es');
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
		return $this->_set(array('name','typeExport','param','asset'),array($this->name,$this->typeExport,$this->param,$this->asset));
	}

	/**
	 * R�cup�rer le/la idPasserelle
	 * @return int
	 */
	public function getIdPasserelle()
	{
		return $this->idPasserelle;
	}
	public function getId()
	{
		return $this->idPasserelle;
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
	 * R�cup�rer le/la typeExport
	 * @return string
	 */
	public function getTypeExport()
	{
		return $this->typeExport;
	}

	/**
	 * D�finir le/la typeExport
	 * @param $typeExport string
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setTypeExport($typeExport,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->typeExport = $typeExport;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('typeExport'),array($typeExport)) : true;
	}

	/**
	 * R�cup�rer le/la param
	 * @return string
	 */
	public function getParam()
	{
		return $this->param;
	}

	public function setAsset($asset,$execute=true){

		$this->asset = $asset;

		return $execute? $this->_set(array('asset'),array($asset)) : true;
	}
	public function getAsset(){
		return $this->asset;
	}
	/**
	 * D�finir le/la param
	 * @param $param string
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setParam($param,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->param = $param;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('param'),array($param)) : true;
	}

	/**
	 * S�lectionner les liasonPasserelleMandats
	 * @return PDOStatement
	 */
	public function selectLiasonPasserelleMandats()
	{
		return LiasonPasserelleMandat::selectByPasserelle($this->pdo,$this);
	}

	/**
	 * S�lectionner les logTransferts
	 * @return PDOStatement
	 */
	public function selectLogTransferts()
	{
		return LogTransfert::selectByPasserelle($this->pdo,$this);
	}
	/**
	 * ToString
	 * @return string repr�sentation de passerelle sous la forme d'un string
	 */
	public function __toString()
	{
		return '[Passerelle idPasserelle="'.$this->idPasserelle.'" name="'.$this->name.'" typeExport="'.$this->typeExport.'" param="'.$this->param.'"]';
	}
	/**
	 * Additionnal method
	 */

	/**
	 *
	 * @param Mandate $mandate
	 * @return Bool
	 */
	public function isLinked(Mandate $mandate){
		$pdoStatement = $this->pdo->prepare('SELECT count(idLiasonPasserelleMandat) FROM LiasonPasserelleMandat WHERE passerelle_idPasserelle = ? AND mandate_idMandate = ?');
		if (!$pdoStatement->execute(array($this->getIdPasserelle(),$mandate->getIdMandate() ))) {
			throw new Exception('Erreur');
		}
		$res = $pdoStatement->fetch();

		return $res[0]==0?false:true;



	}

	/**
	 * Charger tous/toutes les passerelles
	 * @param $pdo PDO
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Passerelle[] tableau de passerelles
	 */
	public static function loadAllAsset(PDO $pdo,$easyload=false)
	{
		// S�lectionner tous/toutes les passerelles
		$pdoStatement = Passerelle::_select($pdo,'asset=1');
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les passerelles depuis la base de donn�es');
		}

		// Mettre chaque passerelle dans un tableau
		$passerelles = array();
		while ($passerelle = Passerelle::fetch($pdo,$pdoStatement,$easyload)) {
			$passerelles[] = $passerelle;
		}

		// Retourner le tableau
		return $passerelles;
	}

}

?>
