<?php

/**
 * @class Action
 * @date 02/03/2011 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class Action
{
	/// @var PDO
	private $pdo;

	/// @var array tableau pour le chargement rapide
	private static $easyload;

	/// @var int
	private $idAction;

	/// @var string
	private $libel;

	/// @var int
	private $initDate;

	/// @var int
	private $deadDate;

	/// @var string
	private $comment;

	/// @var int id de from
	private $from;

	/// @var int id de to
	private $to;
	/// @var int
	private $doDate;

	/// @var int id de mandate
	private $mandate;

	/**
	 * Construire un(e) action
	 * @param $pdo PDO
	 * @param $idAction int
	 * @param $libel string
	 * @param $initDate int
	 * @param $deadDate int
	 * @param $comment string
	 * @param $from int id de from
	 * @param $to int id de to
	 * @param $doDate int
	 * @param $mandate int id de mandate
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Action
	 */
	protected function __construct(PDO $pdo,$idAction,$libel,$initDate,$deadDate,$comment,$from,$to,$doDate=null,$mandate=null,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;

		// Sauvegarder les attributs
		$this->idAction = $idAction;
		$this->libel = $libel;
		$this->initDate = $initDate;
		$this->deadDate = $deadDate;
		$this->comment = $comment;
		$this->from = $from;
		$this->to = $to;
		$this->doDate = $doDate;
		$this->mandate = $mandate;

		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			Action::$easyload[$idAction] = $this;
		}
	}

	/**
	 * Cr�er un(e) action
	 * @param $pdo PDO
	 * @param $libel string
	 * @param $initDate int
	 * @param $deadDate int
	 * @param $comment string
	 * @param $from User
	 * @param $to User
	 * @param $doDate int
	 * @param $mandate Mandate
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Action
	 */
	public static function create(PDO $pdo,$libel,$initDate,$deadDate,$comment,User $from,User $to,$doDate=null,$mandate=null,$easyload=true)
	{
		// Ajouter le/la action dans la base de donn�es
		$pdoStatement = $pdo->prepare('INSERT INTO Action (libel,initDate,deadDate,comment,from_idUser,to_idUser,doDate,mandate_idMandate) VALUES (?,?,?,?,?,?,?,?)');
		if (!$pdoStatement->execute(array($libel,date('Y-m-d',$initDate),date('Y-m-d',$deadDate),$comment,$from->getIdUser(),$to->getIdUser(),$doDate === null ? null : date('Y-m-d',$doDate),$mandate == null ? null : $mandate->getIdMandate()))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) action dans la base de donn�es');
		}

		// Construire le/la action
		return new Action($pdo,$pdo->lastInsertId(),$libel,$initDate,$deadDate,$comment,$from->getIdUser(),$to->getIdUser(),$doDate,$mandate->getIdMandate(),$easyload);
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
		return $pdo->prepare('SELECT a.idAction, a.libel, a.initDate, a.deadDate, a.comment, a.from_idUser,a.to_idUser, a.doDate, a.mandate_idMandate FROM Action a '.
		($where != null ? ' WHERE '.$where : '').
		($orderby != null ? ' ORDER BY '.$orderby : '').
		($limit != null ? ' LIMIT '.$limit : ''));
	}

	/**
	 * Charger un(e) action
	 * @param $pdo PDO
	 * @param $idAction int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Action
	 */
	public static function load(PDO $pdo,$idAction,$easyload=true)
	{
		// D�j� charg�(e) ?
		if (isset(Action::$easyload[$idAction])) {
			return Action::$easyload[$idAction];
		}

		// Charger le/la action
		$pdoStatement = Action::_select($pdo,'a.idAction = ?');
		if (!$pdoStatement->execute(array($idAction))) {
			throw new Exception('Erreur lors du chargement d\'un(e) action depuis la base de donn�es');
		}

		// R�cup�rer le/la action depuis le jeu de r�sultats
		return Action::fetch($pdo,$pdoStatement,$easyload);
	}

	/**
	 * Charger tous/toutes les actions
	 * @param $pdo PDO
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Action[] tableau de actions
	 */
	public static function loadAll(PDO $pdo,$easyload=false)
	{
		// S�lectionner tous/toutes les actions
		$pdoStatement = Action::selectAll($pdo);

		// Mettre chaque action dans un tableau
		$actions = array();
		while ($action = Action::fetch($pdo,$pdoStatement,$easyload)) {
			$actions[] = $action;
		}

		// Retourner le tableau
		return $actions;
	}

	/**
	 * S�lectionner tous/toutes les actions
	 * @param $pdo PDO
	 * @return PDOStatement
	 */
	public static function selectAll(PDO $pdo)
	{
		$pdoStatement = Action::_select($pdo);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les actions depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�re le/la action suivant(e) d'un jeu de r�sultats
	 * @param $pdo PDO
	 * @param $pdoStatement PDOStatement
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Action
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idAction,$libel,$initDate,$deadDate,$comment,$from,$to,$doDate,$mandate) = $values;

		// Construire le/la action
		return isset(Action::$easyload[$idAction.'-'.$libel.'-'.strtotime($initDate).'-'.strtotime($deadDate).'-'.$comment.'-'.$from.'-'.$to.'-'.strtotime($doDate).'-'.$mandate]) ? Action::$easyload[$idAction.'-'.$libel.'-'.strtotime($initDate).'-'.strtotime($deadDate).'-'.$comment.'-'.$from.'-'.$to.'-'.strtotime($doDate).'-'.$mandate] :
		new Action($pdo,$idAction,$libel,strtotime($initDate),strtotime($deadDate),$comment,$from,$to,strtotime($doDate),$mandate,$easyload);
	}

	/**
	 * Serialiser
	 * @param $serialize bool activer la s�rialisation ?
	 * @return string serialisation du/de la action
	 */
	public function serialize($serialize=true)
	{
		// S�rialiser le/la action
		$array = array('idAction' => $this->idAction,'libel' => $this->libel,'initDate' => $this->initDate,'deadDate' => $this->deadDate,'comment' => $this->comment,'from' => $this->from,'to' => $this->to,'doDate' => $this->doDate,'mandate' => $this->mandate);

		// Retourner la serialisation (ou pas) du/de la action
		return $serialize ? serialize($array) : $array;
	}

	/**
	 * D�s�rialiser
	 * @param $pdo PDO
	 * @param $string string serialisation du/de la action
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Action
	 */
	public static function unserialize(PDO $pdo,$string,$easyload=true)
	{
		// D�s�rialiser la chaine de caract�res
		$array = unserialize($string);

		// Construire le/la action
		return isset(Action::$easyload[$array['idAction']]) ? Action::$easyload[$array['idAction']] :
		new Action($pdo,$array['idAction'],$array['libel'],$array['initDate'],$array['deadDate'],$array['comment'],$array['from'],$array['to'],$array['doDate'],$array['mandate'],$easyload);
	}

	/**
	 * Test d'�galit�
	 * @param $action Action
	 * @return bool les objets sont ils �gaux ?
	 */
	public function equals($action)
	{
		// Test si null
		if ($action == null) { return false; }

		// Tester la classe
		if (!($action instanceof Action)) { return false; }

		// Tester les ids
		return $this->idAction == $action->idAction;
	}

	/**
	 * Compter les actions
	 * @param $pdo PDO
	 * @return int nombre de actions
	 */
	public static function count(PDO $pdo)
	{
		if (!($pdoStatement = $pdo->query('SELECT COUNT(idAction) FROM Action'))) {
			throw new Exception('Erreur lors du comptage des actions dans la base de donn�es');
		}
		return $pdoStatement->fetchColumn();
	}

	/**
	 * Supprimer le/la action
	 * @return bool op�ration r�ussie ?
	 */
	public function delete()
	{
		// Supprimer le/la action
		$pdoStatement = $this->pdo->prepare('DELETE FROM Action WHERE idAction = ?');
		if (!$pdoStatement->execute(array($this->getIdAction()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) action dans la base de donn�es');
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
		$pdoStatement = $this->pdo->prepare('UPDATE Action SET '.implode(', ', $updates).' WHERE idAction = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdAction())))) {
			throw new Exception('Erreur lors de la mise � jour d\'un champ d\'un(e) action dans la base de donn�es');
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
		return $this->_set(array('libel','initDate','deadDate','comment','from_idUser','to_idUser','doDate','mandate_idMandate'),array($this->libel,date('Y-m-d',$this->initDate),date('Y-m-d',$this->deadDate),$this->comment,$this->from,$this->to,$this->doDate === null ? null : date('Y-m-d',$this->doDate),$this->mandate));
	}

	/**
	 * R�cup�rer le/la idAction
	 * @return int
	 */
	public function getIdAction()
	{
		return $this->idAction;
	}

	/**
	 * R�cup�rer le/la libel
	 * @return string
	 */
	public function getLibel()
	{
		return $this->libel;
	}

	/**
	 * D�finir le/la libel
	 * @param $libel string
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setLibel($libel,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->libel = $libel;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('libel'),array($libel)) : true;
	}

	/**
	 * R�cup�rer le/la initDate
	 * @return int
	 */
	public function getInitDate()
	{
		return $this->initDate;
	}

	/**
	 * D�finir le/la initDate
	 * @param $initDate int
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setInitDate($initDate,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->initDate = $initDate;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('initDate'),array(date('Y-m-d',$initDate))) : true;
	}

	/**
	 * R�cup�rer le/la deadDate
	 * @return int
	 */
	public function getDeadDate()
	{
		return $this->deadDate;
	}

	/**
	 * D�finir le/la deadDate
	 * @param $deadDate int
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setDeadDate($deadDate,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->deadDate = $deadDate;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('deadDate'),array(date('Y-m-d',$deadDate))) : true;
	}

	/**
	 * R�cup�rer le/la comment
	 * @return string
	 */
	public function getComment()
	{
		return $this->comment;
	}

	/**
	 * D�finir le/la comment
	 * @param $comment string
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setComment($comment,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->comment = $comment;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('comment'),array($comment)) : true;
	}

	/**
	 * R�cup�rer le/la from
	 * @return User
	 */
	public function getFrom()
	{
		return User::load($this->pdo,$this->from);
	}

	/**
	 * D�finir le/la from
	 * @param $from User
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setFrom(User $from,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->from = $from->getIdUser();

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('from_idUser'),array($from->getIdUser())) : true;
	}




	/**
	 * R�cup�rer le/la to
	 * @return User
	 */
	public function getTo()
	{
		return User::load($this->pdo,$this->to);
	}

	/**
	 * D�finir le/la from
	 * @param $to User
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setFrom(User $to,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->to = $to->getIdUser();

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('to_idUser'),array($to->getIdUser())) : true;
	}





	/**
	 * S�lectionner les actions par from
	 * @param $pdo PDO
	 * @param $from User
	 * @return PDOStatement
	 */
	public static function selectByFrom(PDO $pdo,User $from)
	{
		$pdoStatement = $pdo->prepare('SELECT a.idAction, a.libel, a.initDate, a.deadDate, a.comment, a.from_idUser,a.to_idUser, a.doDate, a.mandate_idMandate FROM Action a WHERE a.from_idUser = ?');
		if (!$pdoStatement->execute(array($from->getIdUser()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les actions par from depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * S�lectionner les actions par to
	 * @param $pdo PDO
	 * @param $to User
	 * @return PDOStatement
	 */
	public static function selectByTo(PDO $pdo,User $from)
	{
		$pdoStatement = $pdo->prepare('SELECT a.idAction, a.libel, a.initDate, a.deadDate, a.comment, a.from_idUser,a.to_idUser, a.doDate, a.mandate_idMandate FROM Action a WHERE a.to_idUser = ?');
		if (!$pdoStatement->execute(array($from->getIdUser()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les actions par from depuis la base de donn�es');
		}
		return $pdoStatement;
	}


	/**
	 * R�cup�rer le/la doDate
	 * @return int
	 */
	public function getDoDate()
	{
		return $this->doDate;
	}

	/**
	 * D�finir le/la doDate
	 * @param $doDate int
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setDoDate($doDate=null,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->doDate = $doDate;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('doDate'),array($doDate === null ? null : date('Y-m-d',$doDate))) : true;
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
		return $execute ? $this->_set(array('mandate_idMandate'),array($mandate == null ? null : $mandate->getIdMandate())) : true;
	}

	/**
	 * S�lectionner les actions par mandate
	 * @param $pdo PDO
	 * @param $mandate Mandate
	 * @return PDOStatement
	 */
	public static function selectByMandate(PDO $pdo,Mandate $mandate)
	{
		$pdoStatement = $pdo->prepare('SELECT a.idAction, a.libel, a.initDate, a.deadDate, a.comment, a.from_idUser,a.to_idUser, a.doDate, a.mandate_idMandate FROM Action a WHERE a.mandate_idMandate = ?');
		if (!$pdoStatement->execute(array($mandate->getIdMandate()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les actions par mandate depuis la base de donn�es');
		}
		return $pdoStatement;
	}
	/**
	 * ToString
	 * @return string repr�sentation de action sous la forme d'un string
	 */
	public function __toString()
	{
		return '[Action idAction="'.$this->idAction.'" libel="'.$this->libel.'" initDate="'.date('d/m/Y',$this->initDate).'" deadDate="'.date('d/m/Y',$this->deadDate).'" comment="'.$this->comment.'" from="'.$this->from.'" doDate="'.date('d/m/Y',$this->doDate).'" mandate="'.$this->mandate.'"]';
	}

}

?>
