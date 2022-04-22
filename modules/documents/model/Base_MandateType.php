<?php

/**
 * @name Base_MandateType
 * @version 09/07/2014 (dd/mm/yyyy)
 * @author WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
abstract class Base_MandateType implements Iterator
{
    // Nom de la table
    const TABLENAME = 'mandatetype';
    
    // Nom des champs
    const FIELDNAME_IDMANDATETYPE = 'idmandatetype';
    const FIELDNAME_NAME = 'name';
    
    /** @var PDO  */
    protected $_pdo;
    
    /** @var array tableau pour le chargement fainéant */
    protected static $_lazyload;
    
    /** @var PDOStatement jeu de résultat pour l'implémentation de iterator */
    protected $_iteratorSelect;
    
    /** @var Documents Élément courant pour l'implémentation de iterator */
    protected $_iteratorCurrent;
    
    /** @var int  */
    protected $_idMandateType;
    
    /** @var string  */
    protected $_name;
    
    /**
     * Construire un(e) mandateType
     * @param $pdo PDO 
     * @param $idMandateType int 
     * @param $name string 
     * @param $lazyload bool Activer le chargement fainéant ?
     */
    protected function __construct(PDO $pdo,$idMandateType,$name,$lazyload=true)
    {
        // Sauvegarder pdo
        $this->_pdo = $pdo;
        
        // Sauvegarder les attributs
        $this->_idMandateType = $idMandateType;
        $this->_name = $name;
        
        // Sauvegarder pour le chargement fainéant
        if ($lazyload) {
            self::$_lazyload[$idMandateType] = $this;
        }
    }
    
    /**
     * Créer un(e) mandateType
     * @param $pdo PDO 
     * @param $name string 
     * @param $lazyload bool Activer le chargement fainéant ?
     * @return MandateType 
     */
    public static function create(PDO $pdo,$name,$lazyload=true)
    {
        // Ajouter le/la mandateType dans la base de données
        $pdoStatement = $pdo->prepare('INSERT INTO '.MandateType::TABLENAME.' ('.MandateType::FIELDNAME_NAME.') VALUES (?)');
        if (!$pdoStatement->execute(array($name))) {
            throw new Exception('Erreur durant l\'insertion d\'un(e) mandateType dans la base de données');
        }
        
        // Construire le/la mandateType
        return new MandateType($pdo,intval($pdo->lastInsertId()),$name,$lazyload);
    }
    
    /**
     * Compter les mandateTypes
     * @param $pdo PDO 
     * @return int Nombre de mandateTypes
     */
    public static function count(PDO $pdo)
    {
        if (!($pdoStatement = $pdo->query('SELECT COUNT('.MandateType::FIELDNAME_IDMANDATETYPE.') FROM '.MandateType::TABLENAME))) {
            throw new Exception('Erreur lors du comptage des mandateTypes dans la base de données');
        }
        return $pdoStatement->fetchColumn();
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
        return $pdo->prepare('SELECT DISTINCT '.MandateType::TABLENAME.'.'.MandateType::FIELDNAME_IDMANDATETYPE.', '.MandateType::TABLENAME.'.'.MandateType::FIELDNAME_NAME.' '.
                             'FROM '.MandateType::TABLENAME.($from != null ? ', '.(is_array($from) ? implode(', ',$from) : $from) : '').
                             ($where != null ? ' WHERE '.(is_array($where) ? implode(' AND ',$where) : $where) : '').
                             ($orderby != null ? ' ORDER BY '.(is_array($orderby) ? implode(', ',$orderby) : $orderby) : '').
                             ($limit != null ? ' LIMIT '.(is_array($limit) ? implode(', ', $limit) : $limit) : ''));
    }
    
    /**
     * Charger un(e) mandateType
     * @param $pdo PDO 
     * @param $idMandateType int 
     * @param $lazyload bool Activer le chargement fainéant ?
     * @return MandateType 
     */
    public static function load(PDO $pdo,$idMandateType,$lazyload=true)
    {
        // Déjà chargé(e) ?
        if ($lazyload && isset(self::$_lazyload[$idMandateType])) {
            return self::$_lazyload[$idMandateType];
        }
        
        // Charger le/la mandateType
        $pdoStatement = self::_select($pdo,MandateType::FIELDNAME_IDMANDATETYPE.' = ?');
        if (!$pdoStatement->execute(array($idMandateType))) {
            throw new Exception('Erreur lors du chargement d\'un(e) mandateType depuis la base de données');
        }
        
        // Récupérer le/la mandateType depuis le jeu de résultats
        return self::fetch($pdo,$pdoStatement,$lazyload);
    }
    
    /**
     * Recharger les données depuis la base de données
     */
    public function reload()
    {
        // Recharger les données
        $pdoStatement = self::_select($this->_pdo,MandateType::FIELDNAME_IDMANDATETYPE.' = ?');
        if (!$pdoStatement->execute(array($this->_idMandateType))) {
            throw new Exception('Erreur durant le rechargement des données d\'un(e) mandateType depuis la base de données');
        }
        
        // Extraire les valeurs
        $values = $pdoStatement->fetch(PDO::FETCH_NUM);
        if (!$values) { return null; }
        list($idMandateType,$name) = $values;
        
        // Sauvegarder les valeurs
        $this->_name = $name;
    }
    
    /**
     * Charger tous/toutes les mandateTypes
     * @param $pdo PDO 
     * @param $lazyload bool Activer le chargement fainéant ?
     * @return MandateType[] Tableau de mandateTypes
     */
    public static function loadAll(PDO $pdo,$lazyload=true)
    {
        // Sélectionner tous/toutes les mandateTypes
        $pdoStatement = self::selectAll($pdo);
        
        // Récupèrer tous/toutes les mandateTypes
        $mandateTypes = self::fetchAll($pdo,$pdoStatement,$lazyload);
        
        // Retourner le tableau
        return $mandateTypes;
    }
    
    /**
     * Sélectionner tous/toutes les mandateTypes
     * @param $pdo PDO 
     * @return PDOStatement 
     */
    public static function selectAll(PDO $pdo)
    {
        $pdoStatement = self::_select($pdo);
        if (!$pdoStatement->execute()) {
            throw new Exception('Erreur lors du chargement de tous/toutes les mandateTypes depuis la base de données');
        }
        return $pdoStatement;
    }
    
    /**
     * Récupèrer le/la mandateType suivant(e) d'un jeu de résultats
     * @param $pdo PDO 
     * @param $pdoStatement PDOStatement 
     * @param $lazyload bool Activer le chargement fainéant ?
     * @return MandateType 
     */
    public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$lazyload=true)
    {
        // Extraire les valeurs
        $values = $pdoStatement->fetch(PDO::FETCH_NUM);
        if (!$values) { return null; }
        list($idMandateType,$name) = $values;
        
        // Construire le/la mandateType
        return $lazyload && isset(self::$_lazyload[intval($idMandateType)]) ? self::$_lazyload[intval($idMandateType)] :
               new MandateType($pdo,intval($idMandateType),$name,$lazyload);
    }
    
    /**
     * Récupèrer tous/toutes les mandateTypes d'un jeu de résultats
     * @param $pdo PDO 
     * @param $pdoStatement PDOStatement 
     * @param $lazyload bool Activer le chargement fainéant ?
     * @return MandateType[] Tableau de mandateTypes
     */
    public static function fetchAll(PDO $pdo,PDOStatement $pdoStatement,$lazyload=true)
    {
        $mandateTypes = array();
        while ($mandateType = self::fetch($pdo,$pdoStatement,$lazyload)) {
            $mandateTypes[] = $mandateType;
        }
        return $mandateTypes;
    }
    
    /**
     * Test d'égalité
     * @param $mandateType MandateType 
     * @return bool Les objets sont-ils égaux ?
     */
    public function equals($mandateType)
    {
        // Test si null
        if ($mandateType == null) { return false; }
        
        // Tester la classe
        if (!($mandateType instanceof MandateType)) { return false; }
        
        // Tester les ids
        return $this->_idMandateType == $mandateType->_idMandateType;
    }
    
    /**
     * Vérifier que le/la mandateType existe en base de données
     * @return bool Le/La mandateType existe en base de données ?
     */
    public function exists()
    {
        $pdoStatement = $this->_pdo->prepare('SELECT COUNT('.MandateType::FIELDNAME_IDMANDATETYPE.') FROM '.MandateType::TABLENAME.' WHERE '.MandateType::FIELDNAME_IDMANDATETYPE.' = ?');
        if (!$pdoStatement->execute(array($this->getIdMandateType()))) {
            throw new Exception('Erreur lors de la vérification qu\'un(e) mandateType existe dans la base de données');
        }
        return $pdoStatement->fetchColumn() == 1;
    }
    
    /**
     * Supprimer le/la mandateType
     * @return bool Opération réussie ?
     */
    public function delete()
    {
        // Supprimer les Documents associé(e)s
        $this->removeAllDocuments();
        
        // Supprimer le/la mandateType
        $pdoStatement = $this->_pdo->prepare('DELETE FROM '.MandateType::TABLENAME.' WHERE '.MandateType::FIELDNAME_IDMANDATETYPE.' = ?');
        if (!$pdoStatement->execute(array($this->getIdMandateType()))) {
            throw new Exception('Erreur lors de la suppression d\'un(e) mandateType dans la base de données');
        }
        
        // Supprimer du tableau pour le chargement fainéant
        if (isset(self::$_lazyload[$this->_idMandateType])) {
            unset(self::$_lazyload[$this->_idMandateType]);
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
        $pdoStatement = $this->_pdo->prepare('UPDATE '.MandateType::TABLENAME.' SET '.implode(', ', $updates).' WHERE '.MandateType::FIELDNAME_IDMANDATETYPE.' = ?');
        if (!$pdoStatement->execute(array_merge($values,array($this->getIdMandateType())))) {
            throw new Exception('Erreur lors de la mise à jour d\'un champ d\'un(e) mandateType dans la base de données');
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
        return $this->_set(array(MandateType::FIELDNAME_NAME),array($this->_name));
    }
    
    /**
     * Récupérer le/la idMandateType
     * @return int 
     */
    public function getIdMandateType()
    {
        return $this->_idMandateType;
    }
    
    /**
     * Récupérer le/la name
     * @return string 
     */
    public function getName()
    {
        return $this->_name;
    }
    
    /**
     * Définir le/la name
     * @param $name string 
     * @param $execute bool Exécuter la requête update ?
     * @return bool Opération réussie ?
     */
    public function setName($name,$execute=true)
    {
        // Sauvegarder dans l'objet
        $this->_name = $name;
        
        // Sauvegarder dans la base de données (ou pas)
        return $execute ? MandateType::_set(array(MandateType::FIELDNAME_NAME),array($name)) : true;
    }
    
    /**
     * Ajouter un(e) documents
     * @param $documents Documents 
     * @return bool Opération réussie ?
     */
    public function addDocuments(Documents $documents)
    {
        $pdoStatement = $this->_pdo->prepare('INSERT INTO '.Association_DocumentsMandateType::TABLENAME.' ('.Association_DocumentsMandateType::FIELDNAME_MANDATETYPE_IDMANDATETYPE.','.Association_DocumentsMandateType::FIELDNAME_DOCUMENTS_IDDOCUMENTS.') VALUES (?,?)');
        if (!$pdoStatement->execute(array($this->getIdMandateType(),$documents->getIdDocuments()))) {
            throw new Exception('Erreur lors de l\'ajout d\'un(e) documents à un(e) mandateType dans la base de données');
        }
        return $pdoStatement->rowCount() == 1;
    }
    
    /**
     * Ajouter une liste de documents
     * @param $array Documents[] Tableau de documents
     * @return bool Opération réussie ?
     */
    public function addListOfDocuments($array)
    {
        $pdoStatement = $this->_pdo->prepare('INSERT INTO '.Association_DocumentsMandateType::TABLENAME.' ('.Association_DocumentsMandateType::FIELDNAME_MANDATETYPE_IDMANDATETYPE.','.Association_DocumentsMandateType::FIELDNAME_DOCUMENTS_IDDOCUMENTS.') VALUES '.implode(',',array_fill(0,count($array),'(?,?)')));
        $values = array();
        foreach($array as $documents) {
            $values[] = $this->getIdMandateType();
            $values[] = $documents->getIdDocuments();
        }
        if (!$pdoStatement->execute($values)) {
            throw new Exception('Erreur lors de l\'ajout d\'une liste de documents à un(e) mandateType dans la base de données');
        }
        return $pdoStatement->rowCount() == count($array);
    }
    
    /**
     * Ajouter un(e) documents d'après son/ses id(s)
     * @param $idDocuments int 
     * @return bool Opération réussie ?
     */
    public function addDocumentsById($idDocuments)
    {
        $pdoStatement = $this->_pdo->prepare('INSERT INTO '.Association_DocumentsMandateType::TABLENAME.' ('.Association_DocumentsMandateType::FIELDNAME_MANDATETYPE_IDMANDATETYPE.','.Association_DocumentsMandateType::FIELDNAME_DOCUMENTS_IDDOCUMENTS.') VALUES (?,?)');
        if (!$pdoStatement->execute(array($this->getIdMandateType(),$idDocuments))) {
            throw new Exception('Erreur lors de l\'ajout d\'un(e) documents à un(e) mandateType dans la base de données');
        }
        return $pdoStatement->rowCount() == 1;
    }
    
    /**
     * Retirer un(e) documents
     * @param $documents Documents 
     * @return bool Opération réussie ?
     */
    public function removeDocuments(Documents $documents)
    {
        $pdoStatement = $this->_pdo->prepare('DELETE FROM '.Association_DocumentsMandateType::TABLENAME.' WHERE '.Association_DocumentsMandateType::FIELDNAME_MANDATETYPE_IDMANDATETYPE.' = ? AND '.Association_DocumentsMandateType::FIELDNAME_DOCUMENTS_IDDOCUMENTS.' = ?');
        if (!$pdoStatement->execute(array($this->getIdMandateType(),$documents->getIdDocuments()))) {
            throw new Exception('Erreur lors de la suppression d\'un(e) documents d\'un(e) mandateType dans la base de données');
        }
        return $pdoStatement->rowCount() == 1;
    }
    
    /**
     * Retirer une liste de documents
     * @param $array Documents[] Tableau de documents
     * @return bool Opération réussie ?
     */
    public function removeListOfDocuments($array)
    {
        $pdoStatement = $this->_pdo->prepare('DELETE FROM '.Association_DocumentsMandateType::TABLENAME.' WHERE '.implode(' OR ',array_fill(0,count($array),'('.Association_DocumentsMandateType::FIELDNAME_MANDATETYPE_IDMANDATETYPE.' = ? AND '.Association_DocumentsMandateType::FIELDNAME_DOCUMENTS_IDDOCUMENTS.' = ?)')));
        $values = array();
        foreach($array as $documents) {
            $values[] = $this->getIdMandateType();
            $values[] = $documents->getIdDocuments();
        }
        if (!$pdoStatement->execute($values)) {
            throw new Exception('Erreur lors de la suppression d\'une liste de documents d\'un(e) mandateType dans la base de données');
        }
        return $pdoStatement->rowCount() == count($array);
    }
    
    /**
     * Retirer un(e) documents d'après son/ses id(s)
     * @param $idDocuments int 
     * @return bool Opération réussie ?
     */
    public function removeDocumentsById($idDocuments)
    {
        $pdoStatement = $this->_pdo->prepare('DELETE FROM '.Association_DocumentsMandateType::TABLENAME.' WHERE '.Association_DocumentsMandateType::FIELDNAME_MANDATETYPE_IDMANDATETYPE.' = ? AND '.Association_DocumentsMandateType::FIELDNAME_DOCUMENTS_IDDOCUMENTS.' = ?');
        if (!$pdoStatement->execute(array($this->getIdMandateType(),$idDocuments))) {
            throw new Exception('Erreur lors de la suppression d\'un(e) documents d\'un(e) mandateType dans la base de données');
        }
        return $pdoStatement->rowCount() == 1;
    }
    
    /**
     * Retirer tous/toutes les documents
     * @return int Nombre de lignes affectées
     */
    public function removeAllDocuments()
    {
        $pdoStatement = $this->_pdo->prepare('DELETE FROM '.Association_DocumentsMandateType::TABLENAME.' WHERE '.Association_DocumentsMandateType::FIELDNAME_MANDATETYPE_IDMANDATETYPE.' = ?');
        if (!$pdoStatement->execute(array($this->getIdMandateType()))) {
            throw new Exception('Erreur lors de la suppression de tous/toutes les documents d\'un(e) mandateType dans la base de données');
        }
        return $pdoStatement->rowCount();
    }
    
    /**
     * Sélectionner les documents
     * @return PDOStatement 
     */
    public function selectDocuments()
    {
        return Documents::selectByMandateType($this->_pdo,$this);
    }
    
    /**
     * Sélectionner les mandateTypes par documents
     * @param $pdo PDO 
     * @param $documents Documents 
     * @return PDOStatement 
     */
    public static function selectByDocuments(PDO $pdo,Documents $documents)
    {
        $pdoStatement = self::_select($pdo,Association_DocumentsMandateType::TABLENAME.'.'.Association_DocumentsMandateType::FIELDNAME_DOCUMENTS_IDDOCUMENTS.' = ? AND '.Association_DocumentsMandateType::TABLENAME.'.'.Association_DocumentsMandateType::FIELDNAME_MANDATETYPE_IDMANDATETYPE.' = '.MandateType::TABLENAME.'.'.MandateType::FIELDNAME_IDMANDATETYPE,null,null,array(Association_DocumentsMandateType::TABLENAME));
        if (!$pdoStatement->execute(array($documents->getIdDocuments()))) {
            throw new Exception('Erreur lors du chargement de tous/toutes les mandateTypes d\'un(e) documents depuis la base de données');
        }
        return $pdoStatement;
    }
    
    /**
     * ToString
     * @return string Représentation de mandateType sous la forme d'un string
     */
    public function __toString()
    {
        return '[MandateType idMandateType="'.$this->_idMandateType.'" name="'.$this->_name.'"]';
    }
    /**
     * Sérialiser
     * @param $serialize bool Activer la sérialisation ?
     * @return string Sérialisation du/de la mandateType
     */
    public function serialize($serialize=true)
    {
        // Sérialiser le/la mandateType
        $array = array('idmandatetype' => $this->_idMandateType,'name' => $this->_name);
        
        // Retourner la sérialisation (ou pas) du/de la mandateType
        return $serialize ? serialize($array) : $array;
    }
    
    /**
     * Désérialiser
     * @param $pdo PDO 
     * @param $string string Sérialisation du/de la mandateType
     * @param $lazyload bool Activer le chargement fainéant ?
     * @return MandateType 
     */
    public static function unserialize(PDO $pdo,$string,$lazyload=true)
    {
        // Désérialiser la chaine de caractères
        $array = unserialize($string);
        
        // Construire le/la mandateType
        return $lazyload && isset(self::$_lazyload[$array['idmandatetype']]) ? self::$_lazyload[$array['idmandatetype']] :
               new MandateType($pdo,$array['idmandatetype'],$array['name'],$lazyload);
    }
    
    
    // Implémentation de Iterator
    public function rewind() { $this->_iteratorSelect = $this->selectDocuments();  $this->next(); }
    public function key() { return $this->_iteratorCurrent == null ? null : $this->_iteratorCurrent->getIdDocuments(); }
    public function next() { $this->_iteratorCurrent = Documents::fetch($this->_pdo,$this->_iteratorSelect); }
    public function current() { return $this->_iteratorCurrent; }
    public function valid() { return $this->_iteratorCurrent != null; }
}

