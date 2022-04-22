<?php

/**
 * @name Base_MandateEtap
 * @version 09/07/2014 (dd/mm/yyyy)
 * @author WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
abstract class Base_MandateEtap implements Iterator
{
    // Nom de la table
    const TABLENAME = 'mandateetap';
    
    // Nom des champs
    const FIELDNAME_IDMANDATEETAP = 'idmandateetap';
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
    protected $_idMandateEtap;
    
    /** @var string  */
    protected $_name;
    
    /**
     * Construire un(e) mandateEtap
     * @param $pdo PDO 
     * @param $idMandateEtap int 
     * @param $name string 
     * @param $lazyload bool Activer le chargement fainéant ?
     */
    protected function __construct(PDO $pdo,$idMandateEtap,$name,$lazyload=true)
    {
        // Sauvegarder pdo
        $this->_pdo = $pdo;
        
        // Sauvegarder les attributs
        $this->_idMandateEtap = $idMandateEtap;
        $this->_name = $name;
        
        // Sauvegarder pour le chargement fainéant
        if ($lazyload) {
            self::$_lazyload[$idMandateEtap] = $this;
        }
    }
    
    /**
     * Créer un(e) mandateEtap
     * @param $pdo PDO 
     * @param $name string 
     * @param $lazyload bool Activer le chargement fainéant ?
     * @return MandateEtap 
     */
    public static function create(PDO $pdo,$name,$lazyload=true)
    {
        // Ajouter le/la mandateEtap dans la base de données
        $pdoStatement = $pdo->prepare('INSERT INTO '.MandateEtap::TABLENAME.' ('.MandateEtap::FIELDNAME_NAME.') VALUES (?)');
        if (!$pdoStatement->execute(array($name))) {
            throw new Exception('Erreur durant l\'insertion d\'un(e) mandateEtap dans la base de données');
        }
        
        // Construire le/la mandateEtap
        return new MandateEtap($pdo,intval($pdo->lastInsertId()),$name,$lazyload);
    }
    
    /**
     * Compter les mandateEtaps
     * @param $pdo PDO 
     * @return int Nombre de mandateEtaps
     */
    public static function count(PDO $pdo)
    {
        if (!($pdoStatement = $pdo->query('SELECT COUNT('.MandateEtap::FIELDNAME_IDMANDATEETAP.') FROM '.MandateEtap::TABLENAME))) {
            throw new Exception('Erreur lors du comptage des mandateEtaps dans la base de données');
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
        return $pdo->prepare('SELECT DISTINCT '.MandateEtap::TABLENAME.'.'.MandateEtap::FIELDNAME_IDMANDATEETAP.', '.MandateEtap::TABLENAME.'.'.MandateEtap::FIELDNAME_NAME.' '.
                             'FROM '.MandateEtap::TABLENAME.($from != null ? ', '.(is_array($from) ? implode(', ',$from) : $from) : '').
                             ($where != null ? ' WHERE '.(is_array($where) ? implode(' AND ',$where) : $where) : '').
                             ($orderby != null ? ' ORDER BY '.(is_array($orderby) ? implode(', ',$orderby) : $orderby) : '').
                             ($limit != null ? ' LIMIT '.(is_array($limit) ? implode(', ', $limit) : $limit) : ''));
    }
    
    /**
     * Charger un(e) mandateEtap
     * @param $pdo PDO 
     * @param $idMandateEtap int 
     * @param $lazyload bool Activer le chargement fainéant ?
     * @return MandateEtap 
     */
    public static function load(PDO $pdo,$idMandateEtap,$lazyload=true)
    {
        // Déjà chargé(e) ?
        if ($lazyload && isset(self::$_lazyload[$idMandateEtap])) {
            return self::$_lazyload[$idMandateEtap];
        }
        
        // Charger le/la mandateEtap
        $pdoStatement = self::_select($pdo,MandateEtap::FIELDNAME_IDMANDATEETAP.' = ?');
        if (!$pdoStatement->execute(array($idMandateEtap))) {
            throw new Exception('Erreur lors du chargement d\'un(e) mandateEtap depuis la base de données');
        }
        
        // Récupérer le/la mandateEtap depuis le jeu de résultats
        return self::fetch($pdo,$pdoStatement,$lazyload);
    }
    
    /**
     * Recharger les données depuis la base de données
     */
    public function reload()
    {
        // Recharger les données
        $pdoStatement = self::_select($this->_pdo,MandateEtap::FIELDNAME_IDMANDATEETAP.' = ?');
        if (!$pdoStatement->execute(array($this->_idMandateEtap))) {
            throw new Exception('Erreur durant le rechargement des données d\'un(e) mandateEtap depuis la base de données');
        }
        
        // Extraire les valeurs
        $values = $pdoStatement->fetch(PDO::FETCH_NUM);
        if (!$values) { return null; }
        list($idMandateEtap,$name) = $values;
        
        // Sauvegarder les valeurs
        $this->_name = $name;
    }
    
    /**
     * Charger tous/toutes les mandateEtaps
     * @param $pdo PDO 
     * @param $lazyload bool Activer le chargement fainéant ?
     * @return MandateEtap[] Tableau de mandateEtaps
     */
    public static function loadAll(PDO $pdo,$lazyload=true)
    {
        // Sélectionner tous/toutes les mandateEtaps
        $pdoStatement = self::selectAll($pdo);
        
        // Récupèrer tous/toutes les mandateEtaps
        $mandateEtaps = self::fetchAll($pdo,$pdoStatement,$lazyload);
        
        // Retourner le tableau
        return $mandateEtaps;
    }
    
    /**
     * Sélectionner tous/toutes les mandateEtaps
     * @param $pdo PDO 
     * @return PDOStatement 
     */
    public static function selectAll(PDO $pdo)
    {
        $pdoStatement = self::_select($pdo);
        if (!$pdoStatement->execute()) {
            throw new Exception('Erreur lors du chargement de tous/toutes les mandateEtaps depuis la base de données');
        }
        return $pdoStatement;
    }
    
    /**
     * Récupèrer le/la mandateEtap suivant(e) d'un jeu de résultats
     * @param $pdo PDO 
     * @param $pdoStatement PDOStatement 
     * @param $lazyload bool Activer le chargement fainéant ?
     * @return MandateEtap 
     */
    public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$lazyload=true)
    {
        // Extraire les valeurs
        $values = $pdoStatement->fetch(PDO::FETCH_NUM);
        if (!$values) { return null; }
        list($idMandateEtap,$name) = $values;
        
        // Construire le/la mandateEtap
        return $lazyload && isset(self::$_lazyload[intval($idMandateEtap)]) ? self::$_lazyload[intval($idMandateEtap)] :
               new MandateEtap($pdo,intval($idMandateEtap),$name,$lazyload);
    }
    
    /**
     * Récupèrer tous/toutes les mandateEtaps d'un jeu de résultats
     * @param $pdo PDO 
     * @param $pdoStatement PDOStatement 
     * @param $lazyload bool Activer le chargement fainéant ?
     * @return MandateEtap[] Tableau de mandateEtaps
     */
    public static function fetchAll(PDO $pdo,PDOStatement $pdoStatement,$lazyload=true)
    {
        $mandateEtaps = array();
        while ($mandateEtap = self::fetch($pdo,$pdoStatement,$lazyload)) {
            $mandateEtaps[] = $mandateEtap;
        }
        return $mandateEtaps;
    }
    
    /**
     * Test d'égalité
     * @param $mandateEtap MandateEtap 
     * @return bool Les objets sont-ils égaux ?
     */
    public function equals($mandateEtap)
    {
        // Test si null
        if ($mandateEtap == null) { return false; }
        
        // Tester la classe
        if (!($mandateEtap instanceof MandateEtap)) { return false; }
        
        // Tester les ids
        return $this->_idMandateEtap == $mandateEtap->_idMandateEtap;
    }
    
    /**
     * Vérifier que le/la mandateEtap existe en base de données
     * @return bool Le/La mandateEtap existe en base de données ?
     */
    public function exists()
    {
        $pdoStatement = $this->_pdo->prepare('SELECT COUNT('.MandateEtap::FIELDNAME_IDMANDATEETAP.') FROM '.MandateEtap::TABLENAME.' WHERE '.MandateEtap::FIELDNAME_IDMANDATEETAP.' = ?');
        if (!$pdoStatement->execute(array($this->getIdMandateEtap()))) {
            throw new Exception('Erreur lors de la vérification qu\'un(e) mandateEtap existe dans la base de données');
        }
        return $pdoStatement->fetchColumn() == 1;
    }
    
    /**
     * Supprimer le/la mandateEtap
     * @return bool Opération réussie ?
     */
    public function delete()
    {
        // Supprimer les Documents associé(e)s
        $this->removeAllDocuments();
        
        // Supprimer le/la mandateEtap
        $pdoStatement = $this->_pdo->prepare('DELETE FROM '.MandateEtap::TABLENAME.' WHERE '.MandateEtap::FIELDNAME_IDMANDATEETAP.' = ?');
        if (!$pdoStatement->execute(array($this->getIdMandateEtap()))) {
            throw new Exception('Erreur lors de la suppression d\'un(e) mandateEtap dans la base de données');
        }
        
        // Supprimer du tableau pour le chargement fainéant
        if (isset(self::$_lazyload[$this->_idMandateEtap])) {
            unset(self::$_lazyload[$this->_idMandateEtap]);
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
        $pdoStatement = $this->_pdo->prepare('UPDATE '.MandateEtap::TABLENAME.' SET '.implode(', ', $updates).' WHERE '.MandateEtap::FIELDNAME_IDMANDATEETAP.' = ?');
        if (!$pdoStatement->execute(array_merge($values,array($this->getIdMandateEtap())))) {
            throw new Exception('Erreur lors de la mise à jour d\'un champ d\'un(e) mandateEtap dans la base de données');
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
        return $this->_set(array(MandateEtap::FIELDNAME_NAME),array($this->_name));
    }
    
    /**
     * Récupérer le/la idMandateEtap
     * @return int 
     */
    public function getIdMandateEtap()
    {
        return $this->_idMandateEtap;
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
        return $execute ? MandateEtap::_set(array(MandateEtap::FIELDNAME_NAME),array($name)) : true;
    }
    
    /**
     * Ajouter un(e) documents
     * @param $documents Documents 
     * @return bool Opération réussie ?
     */
    public function addDocuments(Documents $documents)
    {
        $pdoStatement = $this->_pdo->prepare('INSERT INTO '.Association_DocumentsMandateEtap::TABLENAME.' ('.Association_DocumentsMandateEtap::FIELDNAME_MANDATEETAP_IDMANDATEETAP.','.Association_DocumentsMandateEtap::FIELDNAME_DOCUMENTS_IDDOCUMENTS.') VALUES (?,?)');
        if (!$pdoStatement->execute(array($this->getIdMandateEtap(),$documents->getIdDocuments()))) {
            throw new Exception('Erreur lors de l\'ajout d\'un(e) documents à un(e) mandateEtap dans la base de données');
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
        $pdoStatement = $this->_pdo->prepare('INSERT INTO '.Association_DocumentsMandateEtap::TABLENAME.' ('.Association_DocumentsMandateEtap::FIELDNAME_MANDATEETAP_IDMANDATEETAP.','.Association_DocumentsMandateEtap::FIELDNAME_DOCUMENTS_IDDOCUMENTS.') VALUES '.implode(',',array_fill(0,count($array),'(?,?)')));
        $values = array();
        foreach($array as $documents) {
            $values[] = $this->getIdMandateEtap();
            $values[] = $documents->getIdDocuments();
        }
        if (!$pdoStatement->execute($values)) {
            throw new Exception('Erreur lors de l\'ajout d\'une liste de documents à un(e) mandateEtap dans la base de données');
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
        $pdoStatement = $this->_pdo->prepare('INSERT INTO '.Association_DocumentsMandateEtap::TABLENAME.' ('.Association_DocumentsMandateEtap::FIELDNAME_MANDATEETAP_IDMANDATEETAP.','.Association_DocumentsMandateEtap::FIELDNAME_DOCUMENTS_IDDOCUMENTS.') VALUES (?,?)');
        if (!$pdoStatement->execute(array($this->getIdMandateEtap(),$idDocuments))) {
            throw new Exception('Erreur lors de l\'ajout d\'un(e) documents à un(e) mandateEtap dans la base de données');
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
        $pdoStatement = $this->_pdo->prepare('DELETE FROM '.Association_DocumentsMandateEtap::TABLENAME.' WHERE '.Association_DocumentsMandateEtap::FIELDNAME_MANDATEETAP_IDMANDATEETAP.' = ? AND '.Association_DocumentsMandateEtap::FIELDNAME_DOCUMENTS_IDDOCUMENTS.' = ?');
        if (!$pdoStatement->execute(array($this->getIdMandateEtap(),$documents->getIdDocuments()))) {
            throw new Exception('Erreur lors de la suppression d\'un(e) documents d\'un(e) mandateEtap dans la base de données');
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
        $pdoStatement = $this->_pdo->prepare('DELETE FROM '.Association_DocumentsMandateEtap::TABLENAME.' WHERE '.implode(' OR ',array_fill(0,count($array),'('.Association_DocumentsMandateEtap::FIELDNAME_MANDATEETAP_IDMANDATEETAP.' = ? AND '.Association_DocumentsMandateEtap::FIELDNAME_DOCUMENTS_IDDOCUMENTS.' = ?)')));
        $values = array();
        foreach($array as $documents) {
            $values[] = $this->getIdMandateEtap();
            $values[] = $documents->getIdDocuments();
        }
        if (!$pdoStatement->execute($values)) {
            throw new Exception('Erreur lors de la suppression d\'une liste de documents d\'un(e) mandateEtap dans la base de données');
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
        $pdoStatement = $this->_pdo->prepare('DELETE FROM '.Association_DocumentsMandateEtap::TABLENAME.' WHERE '.Association_DocumentsMandateEtap::FIELDNAME_MANDATEETAP_IDMANDATEETAP.' = ? AND '.Association_DocumentsMandateEtap::FIELDNAME_DOCUMENTS_IDDOCUMENTS.' = ?');
        if (!$pdoStatement->execute(array($this->getIdMandateEtap(),$idDocuments))) {
            throw new Exception('Erreur lors de la suppression d\'un(e) documents d\'un(e) mandateEtap dans la base de données');
        }
        return $pdoStatement->rowCount() == 1;
    }
    
    /**
     * Retirer tous/toutes les documents
     * @return int Nombre de lignes affectées
     */
    public function removeAllDocuments()
    {
        $pdoStatement = $this->_pdo->prepare('DELETE FROM '.Association_DocumentsMandateEtap::TABLENAME.' WHERE '.Association_DocumentsMandateEtap::FIELDNAME_MANDATEETAP_IDMANDATEETAP.' = ?');
        if (!$pdoStatement->execute(array($this->getIdMandateEtap()))) {
            throw new Exception('Erreur lors de la suppression de tous/toutes les documents d\'un(e) mandateEtap dans la base de données');
        }
        return $pdoStatement->rowCount();
    }
    
    /**
     * Sélectionner les documents
     * @return PDOStatement 
     */
    public function selectDocuments()
    {
        return Documents::selectByMandateEtap($this->_pdo,$this);
    }
    
    /**
     * Sélectionner les mandateEtaps par documents
     * @param $pdo PDO 
     * @param $documents Documents 
     * @return PDOStatement 
     */
    public static function selectByDocuments(PDO $pdo,Documents $documents)
    {
        $pdoStatement = self::_select($pdo,Association_DocumentsMandateEtap::TABLENAME.'.'.Association_DocumentsMandateEtap::FIELDNAME_DOCUMENTS_IDDOCUMENTS.' = ? AND '.Association_DocumentsMandateEtap::TABLENAME.'.'.Association_DocumentsMandateEtap::FIELDNAME_MANDATEETAP_IDMANDATEETAP.' = '.MandateEtap::TABLENAME.'.'.MandateEtap::FIELDNAME_IDMANDATEETAP,null,null,array(Association_DocumentsMandateEtap::TABLENAME));
        if (!$pdoStatement->execute(array($documents->getIdDocuments()))) {
            throw new Exception('Erreur lors du chargement de tous/toutes les mandateEtaps d\'un(e) documents depuis la base de données');
        }
        return $pdoStatement;
    }
    
    /**
     * ToString
     * @return string Représentation de mandateEtap sous la forme d'un string
     */
    public function __toString()
    {
        return '[MandateEtap idMandateEtap="'.$this->_idMandateEtap.'" name="'.$this->_name.'"]';
    }
    /**
     * Sérialiser
     * @param $serialize bool Activer la sérialisation ?
     * @return string Sérialisation du/de la mandateEtap
     */
    public function serialize($serialize=true)
    {
        // Sérialiser le/la mandateEtap
        $array = array('idmandateetap' => $this->_idMandateEtap,'name' => $this->_name);
        
        // Retourner la sérialisation (ou pas) du/de la mandateEtap
        return $serialize ? serialize($array) : $array;
    }
    
    /**
     * Désérialiser
     * @param $pdo PDO 
     * @param $string string Sérialisation du/de la mandateEtap
     * @param $lazyload bool Activer le chargement fainéant ?
     * @return MandateEtap 
     */
    public static function unserialize(PDO $pdo,$string,$lazyload=true)
    {
        // Désérialiser la chaine de caractères
        $array = unserialize($string);
        
        // Construire le/la mandateEtap
        return $lazyload && isset(self::$_lazyload[$array['idmandateetap']]) ? self::$_lazyload[$array['idmandateetap']] :
               new MandateEtap($pdo,$array['idmandateetap'],$array['name'],$lazyload);
    }
    
    
    // Implémentation de Iterator
    public function rewind() { $this->_iteratorSelect = $this->selectDocuments();  $this->next(); }
    public function key() { return $this->_iteratorCurrent == null ? null : $this->_iteratorCurrent->getIdDocuments(); }
    public function next() { $this->_iteratorCurrent = Documents::fetch($this->_pdo,$this->_iteratorSelect); }
    public function current() { return $this->_iteratorCurrent; }
    public function valid() { return $this->_iteratorCurrent != null; }
}

