<?php

/**
 * @class MandatePicture
 * @date 10/02/2011 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class MandatePicture
{
	/// @var PDO
	private $pdo;

	/// @var array tableau pour le chargement rapide
	private static $easyload;

	/// @var int
	private $idMandatePicture;

	/// @var string
	private $name;

	/// @var bool
	private $isDefault;

	/// @var int id de mandate
	private $mandate;

	/**
	 * Construire un(e) mandatePicture
	 * @param $pdo PDO
	 * @param $idMandatePicture int
	 * @param $name string
	 * @param $isDefault bool
	 * @param $mandate int id de mandate
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandatePicture
	 */
	protected function __construct(PDO $pdo,$idMandatePicture,$name,$isDefault=false,$mandate=null,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;

		// Sauvegarder les attributs
		$this->idMandatePicture = $idMandatePicture;
		$this->name = $name;
		$this->isDefault = $isDefault;
		$this->mandate = $mandate;

		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			MandatePicture::$easyload[$idMandatePicture] = $this;
		}
	}

	/**
	 * Cr�er un(e) mandatePicture
	 * @param $pdo PDO
	 * @param $name string
	 * @param $isDefault bool
	 * @param $mandate Mandate
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandatePicture
	 */
	public static function create(PDO $pdo,$name,$isDefault=false,$mandate=null,$easyload=true)
	{
		// Ajouter le/la mandatePicture dans la base de donn�es
		$pdoStatement = $pdo->prepare('INSERT INTO MandatePicture (name,isDefault,fk_idMandate) VALUES (?,?,?)');
		if (!$pdoStatement->execute(array($name,$isDefault,$mandate == null ? null : $mandate->getIdMandate()))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) mandatePicture dans la base de donn�es');
		}

		// Construire le/la mandatePicture
		return new MandatePicture($pdo,$pdo->lastInsertId(),$name,$isDefault,$mandate->getIdMandate(),$easyload);
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
		return $pdo->prepare('SELECT m.idMandatePicture, m.name, m.isDefault, m.fk_idMandate FROM MandatePicture m '.
		($where != null ? ' WHERE '.$where : '').
		($orderby != null ? ' ORDERBY '.$orderby : '').
		($limit != null ? ' LIMIT '.$limit : ''));
	}

	/**
	 * Charger un(e) mandatePicture
	 * @param $pdo PDO
	 * @param $idMandatePicture int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandatePicture
	 */
	public static function load(PDO $pdo,$idMandatePicture,$easyload=true)
	{
		// D�j� charg�(e) ?
		if (isset(MandatePicture::$easyload[$idMandatePicture])) {
			return MandatePicture::$easyload[$idMandatePicture];
		}

		// Charger le/la mandatePicture
		$pdoStatement = MandatePicture::_select($pdo,'m.idMandatePicture = ?');
		if (!$pdoStatement->execute(array($idMandatePicture))) {
			throw new Exception('Erreur lors du chargement d\'un(e) mandatePicture depuis la base de donn�es');
		}

		// R�cup�rer le/la mandatePicture depuis le jeu de r�sultats
		return MandatePicture::fetch($pdo,$pdoStatement,$easyload);
	}

	/**
	 * Charger tous/toutes les mandatePictures
	 * @param $pdo PDO
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandatePicture[] tableau de mandatepictures
	 */
	public static function loadAll(PDO $pdo,$easyload=false)
	{
		// S�lectionner tous/toutes les mandatePictures
		$pdoStatement = MandatePicture::selectAll($pdo);

		// Mettre chaque mandatePicture dans un tableau
		$mandatePictures = array();
		while ($mandatePicture = MandatePicture::fetch($pdo,$pdoStatement,$easyload)) {
			$mandatePictures[] = $mandatePicture;
		}

		// Retourner le tableau
		return $mandatePictures;
	}

	/**
	 * S�lectionner tous/toutes les mandatePictures
	 * @param $pdo PDO
	 * @return PDOStatement
	 */
	public static function selectAll(PDO $pdo)
	{
		$pdoStatement = MandatePicture::_select($pdo);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les mandatePictures depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�re le/la mandatePicture suivant(e) d'un jeu de r�sultats
	 * @param $pdo PDO
	 * @param $pdoStatement PDOStatement
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandatePicture
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idMandatePicture,$name,$isDefault,$mandate) = $values;

		// Construire le/la mandatePicture
		return isset(MandatePicture::$easyload[$idMandatePicture.'-'.$name.'-'.$isDefault.'-'.$mandate]) ? MandatePicture::$easyload[$idMandatePicture.'-'.$name.'-'.$isDefault.'-'.$mandate] :
		new MandatePicture($pdo,$idMandatePicture,$name,$isDefault,$mandate,$easyload);
	}

	/**
	 * Serialiser
	 * @param $serialize bool activer la s�rialisation ?
	 * @return string serialisation du/de la mandatepicture
	 */
	public function serialize($serialize=true)
	{
		// S�rialiser le/la mandatePicture
		$array = array('idMandatePicture' => $this->idMandatePicture,'name' => $this->name,'isDefault' => $this->isDefault,'mandate' => $this->mandate);

		// Retourner la serialisation (ou pas) du/de la mandatePicture
		return $serialize ? serialize($array) : $array;
	}

	/**
	 * D�s�rialiser
	 * @param $pdo PDO
	 * @param $string string serialisation du/de la mandatepicture
	 * @param $easyload bool activer le chargement rapide ?
	 * @return MandatePicture
	 */
	public static function unserialize(PDO $pdo,$string,$easyload=true)
	{
		// D�s�rialiser la chaine de caract�res
		$array = unserialize($string);

		// Construire le/la mandatePicture
		return isset(MandatePicture::$easyload[$array['idMandatePicture']]) ? MandatePicture::$easyload[$array['idMandatePicture']] :
		new MandatePicture($pdo,$array['idMandatePicture'],$array['name'],$array['isDefault'],$array['mandate'],$easyload);
	}

	/**
	 * Test d'�galit�
	 * @param $mandatePicture MandatePicture
	 * @return bool les objets sont ils �gaux ?
	 */
	public function equals($mandatePicture)
	{
		// Test si null
		if ($mandatePicture == null) { return false; }

		// Tester la classe
		if (!($mandatePicture instanceof MandatePicture)) { return false; }

		// Tester les ids
		return $this->idMandatePicture == $mandatePicture->idMandatePicture;
	}

	/**
	 * Compter les mandatePictures
	 * @param $pdo PDO
	 * @return int nombre de mandatepictures
	 */
	public static function count(PDO $pdo)
	{
		if (!($pdoStatement = $pdo->query('SELECT COUNT(idMandatePicture) FROM MandatePicture'))) {
			throw new Exception('Erreur lors du comptage des mandatePictures dans la base de donn�es');
		}
		return $pdoStatement->fetchColumn();
	}

	/**
	 * Supprimer le/la mandatePicture
	 * @return bool op�ration r�ussie ?
	 */
	public function delete()
	{
		// Supprimer le/la mandatePicture
		$pdoStatement = $this->pdo->prepare('DELETE FROM MandatePicture WHERE idMandatePicture = ?');
		if (!$pdoStatement->execute(array($this->getIdMandatePicture()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) mandatePicture dans la base de donn�es');
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
		$pdoStatement = $this->pdo->prepare('UPDATE MandatePicture SET '.implode(', ', $updates).' WHERE idMandatePicture = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdMandatePicture())))) {
			throw new Exception('Erreur lors de la mise � jour d\'un champ d\'un(e) mandatePicture dans la base de donn�es');
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
		return $this->_set(array('name','isDefault','fk_idMandate'),array($this->name,$this->isDefault,$this->mandate));
	}

	/**
	 * R�cup�rer le/la idMandatePicture
	 * @return int
	 */
	public function getIdMandatePicture()
	{
		return $this->idMandatePicture;
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
	 * R�cup�rer le/la isDefault
	 * @return bool
	 */
	public function getIsDefault()
	{
		return $this->isDefault;
	}

	/**
	 * D�finir le/la isDefault
	 * @param $isDefault bool
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setIsDefault($isDefault,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->isDefault = $isDefault;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('isDefault'),array($isDefault)) : true;
	}

	/**
	 * R�cup�rer le/la mandate
	 * @return Mandate
	 */
	public function getMandate()
	{
		// Retourner null si n�c�ssaire
		if ($this->mandate == null) { return null; }

		// Charger et retourner mandate
		return Mandate::load($this->pdo,$this->mandate);
	}

	/**
	 * D�finir le/la mandate
	 * @param $mandate Mandate
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setMandate($mandate=null,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->mandate = $mandate == null ? null : $mandate->getIdMandate();

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('fk_idMandate'),array($mandate == null ? null : $mandate->getIdMandate())) : true;
	}

	/**
	 * S�lectionner les mandatePictures par mandate
	 * @param $pdo PDO
	 * @param $mandate Mandate
	 * @return PDOStatement
	 */
	public static function selectByMandate(PDO $pdo,Mandate $mandate)
	{
		$pdoStatement = $pdo->prepare('SELECT m.idMandatePicture, m.name, m.isDefault, m.fk_idMandate FROM MandatePicture m WHERE m.fk_idMandate = ?');
		if (!$pdoStatement->execute(array($mandate->getIdMandate()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les mandatePictures par mandate depuis la base de donn�es');
		}
		return $pdoStatement;
	}
	/**
	 * ToString
	 * @return string repr�sentation de mandatepicture sous la forme d'un string
	 */
	public function __toString()
	{
		return '[MandatePicture idMandatePicture="'.$this->idMandatePicture.'" name="'.$this->name.'" isDefault="'.($this->isDefault?'true':'false').'" mandate="'.$this->mandate.'"]';
	}

}

?>
