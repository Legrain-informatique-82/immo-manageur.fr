<?php

/**
 * @name TypeChampsContact
 * @version 16/10/2012 (dd/mm/yyyy)
 * @author WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
abstract class TypeChampsContactBase
{
	/** @var PDO  */
	protected $pdo;
	
	/** @var array tableau pour le chargement fainéant */
	protected static $lazyload;
	
	/** @var int  */
	protected $idTypeChampsContact;
	
	/** @var string  */
	protected $libel;
	
	/** @var int  */
	protected $numberUsed;
	
	/** @var int  */
	protected $position;
	
	/**
	 * Construire un(e) typeChampsContact
	 * @param $pdo PDO 
	 * @param $idTypeChampsContact int 
	 * @param $libel string 
	 * @param $numberUsed int 
	 * @param $position int 
	 * @param $lazyload bool Activer le chargement fainéant ?
	 */
	protected function __construct(PDO $pdo,$idTypeChampsContact,$libel,$numberUsed,$position,$lazyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;
		
		// Sauvegarder les attributs
		$this->idTypeChampsContact = $idTypeChampsContact;
		$this->libel = $libel;
		$this->numberUsed = $numberUsed;
		$this->position = $position;
		
		// Sauvegarder pour le chargement fainéant
		if ($lazyload) {
			self::$lazyload[$idTypeChampsContact] = $this;
		}
	}
	
	/**
	 * Créer un(e) typeChampsContact
	 * @param $pdo PDO 
	 * @param $libel string 
	 * @param $numberUsed int 
	 * @param $position int 
	 * @param $lazyload bool Activer le chargement fainéant ?
	 * @return TypeChampsContact 
	 */
	public static function create(PDO $pdo,$libel,$numberUsed,$position,$lazyload=true)
	{
		// Ajouter le/la typeChampsContact dans la base de données
		$pdoStatement = $pdo->prepare('INSERT INTO '.TypeChampsContact::TABLENAME.' ('.TypeChampsContact::FIELDNAME_LIBEL.','.TypeChampsContact::FIELDNAME_NUMBERUSED.','.TypeChampsContact::FIELDNAME_POSITION.') VALUES (?,?,?)');
		if (!$pdoStatement->execute(array($libel,$numberUsed,$position))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) typeChampsContact dans la base de données');
		}
		
		// Construire le/la typeChampsContact
		return new TypeChampsContact($pdo,$pdo->lastInsertId(),$libel,$numberUsed,$position,$lazyload);
	}
	
	/**
	 * Requête de sélection
	 * @param $pdo PDO 
	 * @param $where string|array 
	 * @param $orderby string|array 
	 * @param $limit string|array 
	 * @param $from string|array 
	 * @return PDOStatement 
	 */
	protected static function _select(PDO $pdo,$where=null,$orderby=null,$limit=null,$from=null)
	{
		return $pdo->prepare('SELECT DISTINCT '.TypeChampsContact::TABLENAME.'.'.TypeChampsContact::FIELDNAME_IDTYPECHAMPSCONTACT.', '.TypeChampsContact::TABLENAME.'.'.TypeChampsContact::FIELDNAME_LIBEL.', '.TypeChampsContact::TABLENAME.'.'.TypeChampsContact::FIELDNAME_NUMBERUSED.', '.TypeChampsContact::TABLENAME.'.'.TypeChampsContact::FIELDNAME_POSITION.' '.
		                     'FROM '.TypeChampsContact::TABLENAME.($from != null ? ', '.(is_array($from) ? implode(', ',$from) : $from) : '').
		                     ($where != null ? ' WHERE '.(is_array($where) ? implode(' AND ',$where) : $where) : '').
		                     ($orderby != null ? ' ORDER BY '.(is_array($orderby) ? implode(', ',$orderby) : $orderby) : '').
		                     ($limit != null ? ' LIMIT '.(is_array($limit) ? implode(', ', $limit) : $limit) : ''));
	}
	
	/**
	 * Charger un(e) typeChampsContact
	 * @param $pdo PDO 
	 * @param $idTypeChampsContact int 
	 * @param $lazyload bool Activer le chargement fainéant ?
	 * @return TypeChampsContact 
	 */
	public static function load(PDO $pdo,$idTypeChampsContact,$lazyload=true)
	{
		// Déjà chargé(e) ?
		if (isset(self::$lazyload[$idTypeChampsContact])) {
			return self::$lazyload[$idTypeChampsContact];
		}
		
		// Charger le/la typeChampsContact
		$pdoStatement = self::_select($pdo,TypeChampsContact::FIELDNAME_IDTYPECHAMPSCONTACT.' = ?');
		if (!$pdoStatement->execute(array($idTypeChampsContact))) {
			throw new Exception('Erreur lors du chargement d\'un(e) typeChampsContact depuis la base de données');
		}
		
		// Récupérer le/la typeChampsContact depuis le jeu de résultats
		return self::fetch($pdo,$pdoStatement,$lazyload);
	}
	
	/**
	 * Charger tous/toutes les typeChampsContacts
	 * @param $pdo PDO 
	 * @param $lazyload bool Activer le chargement fainéant ?
	 * @return TypeChampsContact[] Tableau de typeChampsContacts
	 */
	public static function loadAll(PDO $pdo,$lazyload=false)
	{
		// Sélectionner tous/toutes les typeChampsContacts
		$pdoStatement = self::selectAll($pdo);
		
		// Mettre chaque typeChampsContact dans un tableau
		$typeChampsContacts = array();
		while ($typeChampsContact = self::fetch($pdo,$pdoStatement,$lazyload)) {
			$typeChampsContacts[] = $typeChampsContact;
		}
		
		// Retourner le tableau
		return $typeChampsContacts;
	}
	
	/**
	 * Sélectionner tous/toutes les typeChampsContacts
	 * @param $pdo PDO 
	 * @return PDOStatement 
	 */
	public static function selectAll(PDO $pdo)
	{
		$pdoStatement = self::_select($pdo);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les typeChampsContacts depuis la base de données');
		}
		return $pdoStatement;
	}
	
	/**
	 * Récupère le/la typeChampsContact suivant(e) d'un jeu de résultats
	 * @param $pdo PDO 
	 * @param $pdoStatement PDOStatement 
	 * @param $lazyload bool Activer le chargement fainéant ?
	 * @return TypeChampsContact 
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$lazyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idTypeChampsContact,$libel,$numberUsed,$position) = $values;
		
		// Construire le/la typeChampsContact
		return isset(self::$lazyload[$idTypeChampsContact]) ? self::$lazyload[$idTypeChampsContact] :
		       new TypeChampsContact($pdo,$idTypeChampsContact,$libel,$numberUsed,$position,$lazyload);
	}
	
	/**
	 * Sérialiser
	 * @param $serialize bool Activer la sérialisation ?
	 * @return string Sérialisation du/de la typeChampsContact
	 */
	public function serialize($serialize=true)
	{
		// Sérialiser le/la typeChampsContact
		$array = array('idTypeChampsContact' => $this->idTypeChampsContact,'libel' => $this->libel,'numberUsed' => $this->numberUsed,'position' => $this->position);
		
		// Retourner la sérialisation (ou pas) du/de la typeChampsContact
		return $serialize ? serialize($array) : $array;
	}
	
	/**
	 * Désérialiser
	 * @param $pdo PDO 
	 * @param $string string Sérialisation du/de la typeChampsContact
	 * @param $lazyload bool Activer le chargement fainéant ?
	 * @return TypeChampsContact 
	 */
	public static function unserialize(PDO $pdo,$string,$lazyload=true)
	{
		// Désérialiser la chaine de caractères
		$array = unserialize($string);
		
		// Construire le/la typeChampsContact
		return isset(self::$lazyload[$array['idTypeChampsContact']]) ? self::$lazyload[$array['idTypeChampsContact']] :
		       new TypeChampsContact($pdo,$array['idTypeChampsContact'],$array['libel'],$array['numberUsed'],$array['position'],$lazyload);
	}
	
	/**
	 * Test d'égalité
	 * @param $typeChampsContact TypeChampsContact 
	 * @return bool Les objets sont-ils égaux ?
	 */
	public function equals($typeChampsContact)
	{
		// Test si null
		if ($typeChampsContact == null) { return false; }
		
		// Tester la classe
		if (!($typeChampsContact instanceof TypeChampsContact)) { return false; }
		
		// Tester les ids
		return $this->idTypeChampsContact == $typeChampsContact->idTypeChampsContact;
	}
	
	/**
	 * Compter les typeChampsContacts
	 * @param $pdo PDO 
	 * @return int Nombre de typeChampsContacts
	 */
	public static function count(PDO $pdo)
	{
		if (!($pdoStatement = $pdo->query('SELECT COUNT('.TypeChampsContact::FIELDNAME_IDTYPECHAMPSCONTACT.') FROM '.TypeChampsContact::TABLENAME))) {
			throw new Exception('Erreur lors du comptage des typeChampsContacts dans la base de données');
		}
		return $pdoStatement->fetchColumn();
	}
	
	/**
	 * Supprimer le/la typeChampsContact
	 * @return bool Opération réussie ?
	 */
	public function delete()
	{
		// Supprimer les champsContacts associé(e)s
		$select = $this->selectChampsContacts();
		while ($champsContact = ChampsContact::fetch($this->pdo,$select)) {
			if (!$champsContact->delete()) { return false; }
		}
		
		// Supprimer le/la typeChampsContact
		$pdoStatement = $this->pdo->prepare('DELETE FROM '.TypeChampsContact::TABLENAME.' WHERE '.TypeChampsContact::FIELDNAME_IDTYPECHAMPSCONTACT.' = ?');
		if (!$pdoStatement->execute(array($this->getIdTypeChampsContact()))) {
			throw new Exception('Erreur lors de la suppression d\'un(e) typeChampsContact dans la base de données');
		}
		
		// Opération réussie ?
		return $pdoStatement->rowCount() == 1;
	}
	
	/**
	 * Mettre à jour un champ dans la base de données
	 * @param $fields array 
	 * @param $values array 
	 * @return bool Opération réussie ?
	 */
	protected function _set($fields,$values)
	{
		// Préparer la mise à jour
		$updates = array();
		foreach ($fields as $field) {
			$updates[] = $field.' = ?';
		}
		
		// Mettre à jour le champ
		$pdoStatement = $this->pdo->prepare('UPDATE '.TypeChampsContact::TABLENAME.' SET '.implode(', ', $updates).' WHERE '.TypeChampsContact::FIELDNAME_IDTYPECHAMPSCONTACT.' = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdTypeChampsContact())))) {
			throw new Exception('Erreur lors de la mise à jour d\'un champ d\'un(e) typeChampsContact dans la base de données');
		}
		
		// Opération réussie ?
		return $pdoStatement->rowCount() == 1;
	}
	
	/**
	 * Mettre à jour tous les champs dans la base de données
	 * @return bool Opération réussie ?
	 */
	public function update()
	{
		return $this->_set(array(TypeChampsContact::FIELDNAME_LIBEL,TypeChampsContact::FIELDNAME_NUMBERUSED,TypeChampsContact::FIELDNAME_POSITION),array($this->libel,$this->numberUsed,$this->position));
	}
	
	/**
	 * Récupérer le/la idTypeChampsContact
	 * @return int 
	 */
	public function getIdTypeChampsContact()
	{
		return $this->idTypeChampsContact;
	}
	
	/**
	 * Récupérer le/la libel
	 * @return string 
	 */
	public function getLibel()
	{
		return $this->libel;
	}
	
	/**
	 * Définir le/la libel
	 * @param $libel string 
	 * @param $execute bool Exécuter la requête update ?
	 * @return bool Opération réussie ?
	 */
	public function setLibel($libel,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->libel = $libel;
		
		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array(TypeChampsContact::FIELDNAME_LIBEL),array($libel)) : true;
	}
	
	/**
	 * Récupérer le/la numberUsed
	 * @return int 
	 */
	public function getNumberUsed()
	{
		return $this->numberUsed;
	}
	
	/**
	 * Définir le/la numberUsed
	 * @param $numberUsed int 
	 * @param $execute bool Exécuter la requête update ?
	 * @return bool Opération réussie ?
	 */
	public function setNumberUsed($numberUsed,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->numberUsed = $numberUsed;
		
		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array(TypeChampsContact::FIELDNAME_NUMBERUSED),array($numberUsed)) : true;
	}
	
	/**
	 * Récupérer le/la position
	 * @return int 
	 */
	public function getPosition()
	{
		return $this->position;
	}
	
	/**
	 * Définir le/la position
	 * @param $position int 
	 * @param $execute bool Exécuter la requête update ?
	 * @return bool Opération réussie ?
	 */
	public function setPosition($position,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->position = $position;
		
		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array(TypeChampsContact::FIELDNAME_POSITION),array($position)) : true;
	}
	
	/**
	 * Sélectionner les champsContacts
	 * @return PDOStatement 
	 */
	public function selectChampsContacts()
	{
		return ChampsContact::selectByTypeChampsContact($this->pdo,$this);
	}
	
	/**
	 * ToString
	 * @return string Représentation de typeChampsContact sous la forme d'un string
	 */
	public function __toString()
	{
		return '[TypeChampsContact idTypeChampsContact="'.$this->idTypeChampsContact.'" libel="'.$this->libel.'" numberUsed="'.$this->numberUsed.'" position="'.$this->position.'"]';
	}
}

