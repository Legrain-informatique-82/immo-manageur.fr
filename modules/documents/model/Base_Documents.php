<?php

/**
 * @name Base_Documents
 * @version 09/07/2014 (dd/mm/yyyy)
 * @author WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
abstract class Base_Documents
{
    // Nom de la table
    const TABLENAME = 'Documents';
    
    // Nom des champs
    const FIELDNAME_IDDOCUMENTS = 'idDocument';
    const FIELDNAME_NAME = 'name';
    const FIELDNAME_CORPS = 'corps';
    const FIELDNAME_CATEGORYDOCUMENT_IDCATEGORYDOCUMENT = 'categorydocument_idcategorydocument';
    
    /** @var PDO  */
    protected $_pdo;
    
    /** @var array tableau pour le chargement fainéant */
    protected static $_lazyload;
    
    /** @var int  */
    protected $_idDocuments;
    
    /** @var string  */
    protected $_name;
    
    /** @var string  */
    protected $_corps;
    
    /** @var int id de categorydocument */
    protected $_categoryDocument;
    
    /**
     * Construire un(e) documents
     * @param $pdo PDO 
     * @param $idDocuments int 
     * @param $name string 
     * @param $corps string 
     * @param $categoryDocument int Id de categoryDocument
     * @param $lazyload bool Activer le chargement fainéant ?
     */
    protected function __construct(PDO $pdo,$idDocuments,$name,$corps,$categoryDocument,$lazyload=true)
    {
        // Sauvegarder pdo
        $this->_pdo = $pdo;
        
        // Sauvegarder les attributs
        $this->_idDocuments = $idDocuments;
        $this->_name = $name;
        $this->_corps = $corps;
        $this->_categoryDocument = $categoryDocument;
        
        // Sauvegarder pour le chargement fainéant
        if ($lazyload) {
            self::$_lazyload[$idDocuments] = $this;
        }
    }
    
    /**
     * Créer un(e) documents
     * @param $pdo PDO 
     * @param $name string 
     * @param $corps string 
     * @param $categoryDocument CategoryDocument 
     * @param $lazyload bool Activer le chargement fainéant ?
     * @return Documents 
     */
    public static function create(PDO $pdo,$name,$corps,CategoryDocument $categoryDocument,$lazyload=true)
    {
        // Ajouter le/la documents dans la base de données
        $pdoStatement = $pdo->prepare('INSERT INTO '.Documents::TABLENAME.' ('.Documents::FIELDNAME_NAME.','.Documents::FIELDNAME_CORPS.','.Documents::FIELDNAME_CATEGORYDOCUMENT_IDCATEGORYDOCUMENT.') VALUES (?,?,?)');
        if (!$pdoStatement->execute(array($name,$corps,$categoryDocument->getIdCategoryDocument()))) {
            throw new Exception('Erreur durant l\'insertion d\'un(e) documents dans la base de données');
        }
        
        // Construire le/la documents
        return new Documents($pdo,intval($pdo->lastInsertId()),$name,$corps,$categoryDocument->getIdCategoryDocument(),$lazyload);
    }
    
    /**
     * Compter les documents
     * @param $pdo PDO 
     * @return int Nombre de documents
     */
    public static function count(PDO $pdo)
    {
        if (!($pdoStatement = $pdo->query('SELECT COUNT('.Documents::FIELDNAME_IDDOCUMENTS.') FROM '.Documents::TABLENAME))) {
            throw new Exception('Erreur lors du comptage des documents dans la base de données');
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
         $sql='SELECT DISTINCT '.Documents::TABLENAME.'.'.Documents::FIELDNAME_IDDOCUMENTS.', '.Documents::TABLENAME.'.'.Documents::FIELDNAME_NAME.', '.Documents::TABLENAME.'.'.Documents::FIELDNAME_CORPS.', '.Documents::TABLENAME.'.'.Documents::FIELDNAME_CATEGORYDOCUMENT_IDCATEGORYDOCUMENT.' '.
            'FROM '.Documents::TABLENAME.($from != null ? ', '.(is_array($from) ? implode(', ',$from) : $from) : '').
            ($where != null ? ' WHERE '.(is_array($where) ? implode(' AND ',$where) : $where) : '').
            ($orderby != null ? ' ORDER BY '.(is_array($orderby) ? implode(', ',$orderby) : $orderby) : '').
            ($limit != null ? ' LIMIT '.(is_array($limit) ? implode(', ', $limit) : $limit) : '');
//        echo '<hr>'.$sql.'<hr>';
        return $pdo->prepare($sql);
    }
    
    /**
     * Charger un(e) documents
     * @param $pdo PDO 
     * @param $idDocuments int 
     * @param $lazyload bool Activer le chargement fainéant ?
     * @return Documents 
     */
    public static function load(PDO $pdo,$idDocuments,$lazyload=true)
    {

        // Déjà chargé(e) ?
        if ($lazyload && isset(self::$_lazyload[$idDocuments])) {
            return self::$_lazyload[$idDocuments];
        }
        
        // Charger le/la documents
        $pdoStatement = self::_select($pdo,Documents::FIELDNAME_IDDOCUMENTS.' = ?');
        if (!$pdoStatement->execute(array($idDocuments))) {
            throw new Exception('Erreur lors du chargement d\'un(e) documents depuis la base de données');
        }
        
        // Récupérer le/la documents depuis le jeu de résultats
        return self::fetch($pdo,$pdoStatement,$lazyload);
    }
    
    /**
     * Recharger les données depuis la base de données
     */
    public function reload()
    {
        // Recharger les données
        $pdoStatement = self::_select($this->_pdo,Documents::FIELDNAME_IDDOCUMENTS.' = ?');
        if (!$pdoStatement->execute(array($this->_idDocuments))) {
            throw new Exception('Erreur durant le rechargement des données d\'un(e) documents depuis la base de données');
        }
        
        // Extraire les valeurs
        $values = $pdoStatement->fetch(PDO::FETCH_NUM);
        if (!$values) { return null; }
        list($idDocuments,$name,$corps,$categoryDocument) = $values;
        
        // Sauvegarder les valeurs
        $this->_name = $name;
        $this->_corps = $corps;
        $this->_categoryDocument = $categoryDocument;
    }
    
    /**
     * Charger tous/toutes les documents
     * @param $pdo PDO 
     * @param $lazyload bool Activer le chargement fainéant ?
     * @return Documents[] Tableau de documents
     */
    public static function loadAll(PDO $pdo,$lazyload=true)
    {
        // Sélectionner tous/toutes les documents
        $pdoStatement = self::selectAll($pdo);
        
        // Récupèrer tous/toutes les documents
        $array = self::fetchAll($pdo,$pdoStatement,$lazyload);
        
        // Retourner le tableau
        return $array;
    }
    
    /**
     * Sélectionner tous/toutes les documents
     * @param $pdo PDO 
     * @return PDOStatement 
     */
    public static function selectAll(PDO $pdo)
    {
        $pdoStatement = self::_select($pdo);
        if (!$pdoStatement->execute()) {
            throw new Exception('Erreur lors du chargement de tous/toutes les documents depuis la base de données');
        }
        return $pdoStatement;
    }
    
    /**
     * Récupèrer le/la documents suivant(e) d'un jeu de résultats
     * @param $pdo PDO 
     * @param $pdoStatement PDOStatement 
     * @param $lazyload bool Activer le chargement fainéant ?
     * @return Documents 
     */
    public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$lazyload=true)
    {
        // Extraire les valeurs
        $values = $pdoStatement->fetch(PDO::FETCH_NUM);
        if (!$values) { return null; }
        list($idDocuments,$name,$corps,$categoryDocument) = $values;
        
        // Construire le/la documents
        return $lazyload && isset(self::$_lazyload[intval($idDocuments)]) ? self::$_lazyload[intval($idDocuments)] :
               new Documents($pdo,intval($idDocuments),$name,$corps,$categoryDocument,$lazyload);
    }
    
    /**
     * Récupèrer tous/toutes les documents d'un jeu de résultats
     * @param $pdo PDO 
     * @param $pdoStatement PDOStatement 
     * @param $lazyload bool Activer le chargement fainéant ?
     * @return Documents[] Tableau de documents
     */
    public static function fetchAll(PDO $pdo,PDOStatement $pdoStatement,$lazyload=true)
    {
        $array = array();
        while ($documents = self::fetch($pdo,$pdoStatement,$lazyload)) {
            $array[] = $documents;
        }
        return $array;
    }
    
    /**
     * Test d'égalité
     * @param $documents Documents 
     * @return bool Les objets sont-ils égaux ?
     */
    public function equals($documents)
    {
        // Test si null
        if ($documents == null) { return false; }
        
        // Tester la classe
        if (!($documents instanceof Documents)) { return false; }
        
        // Tester les ids
        return $this->_idDocuments == $documents->_idDocuments;
    }
    
    /**
     * Vérifier que le/la documents existe en base de données
     * @return bool Le/La documents existe en base de données ?
     */
    public function exists()
    {
        $pdoStatement = $this->_pdo->prepare('SELECT COUNT('.Documents::FIELDNAME_IDDOCUMENTS.') FROM '.Documents::TABLENAME.' WHERE '.Documents::FIELDNAME_IDDOCUMENTS.' = ?');
        if (!$pdoStatement->execute(array($this->getIdDocuments()))) {
            throw new Exception('Erreur lors de la vérification qu\'un(e) documents existe dans la base de données');
        }
        return $pdoStatement->fetchColumn() == 1;
    }
    
    /**
     * Supprimer le/la documents
     * @return bool Opération réussie ?
     */
    public function delete()
    {
        // Supprimer les MandateEtaps associé(e)s
        $this->removeAllMandateEtaps();
        
        // Supprimer les MandateTypes associé(e)s
        $this->removeAllMandateTypes();
        
        // Supprimer le/la documents
        $pdoStatement = $this->_pdo->prepare('DELETE FROM '.Documents::TABLENAME.' WHERE '.Documents::FIELDNAME_IDDOCUMENTS.' = ?');
        if (!$pdoStatement->execute(array($this->getIdDocuments()))) {
            throw new Exception('Erreur lors de la suppression d\'un(e) documents dans la base de données');
        }
        
        // Supprimer du tableau pour le chargement fainéant
        if (isset(self::$_lazyload[$this->_idDocuments])) {
            unset(self::$_lazyload[$this->_idDocuments]);
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
        $pdoStatement = $this->_pdo->prepare('UPDATE '.Documents::TABLENAME.' SET '.implode(', ', $updates).' WHERE '.Documents::FIELDNAME_IDDOCUMENTS.' = ?');
        if (!$pdoStatement->execute(array_merge($values,array($this->getIdDocuments())))) {
            throw new Exception('Erreur lors de la mise à jour d\'un champ d\'un(e) documents dans la base de données');
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
        return $this->_set(array(Documents::FIELDNAME_NAME,Documents::FIELDNAME_CORPS,Documents::FIELDNAME_CATEGORYDOCUMENT_IDCATEGORYDOCUMENT),array($this->_name,$this->_corps,$this->_categoryDocument));
    }
    
    /**
     * Récupérer le/la idDocuments
     * @return int 
     */
    public function getIdDocuments()
    {
        return $this->_idDocuments;
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
        return $execute ? Documents::_set(array(Documents::FIELDNAME_NAME),array($name)) : true;
    }
    
    /**
     * Récupérer le/la corps
     * @return string 
     */
    public function getCorps()
    {
        return $this->_corps;
    }
    
    /**
     * Définir le/la corps
     * @param $corps string 
     * @param $execute bool Exécuter la requête update ?
     * @return bool Opération réussie ?
     */
    public function setCorps($corps,$execute=true)
    {
        // Sauvegarder dans l'objet
        $this->_corps = $corps;
        
        // Sauvegarder dans la base de données (ou pas)
        return $execute ? Documents::_set(array(Documents::FIELDNAME_CORPS),array($corps)) : true;
    }
    
    /**
     * Récupérer le/la categoryDocument
     * @param $lazyload bool Activer le chargement fainéant ?
     * @return CategoryDocument 
     */
    public function getCategoryDocument($lazyload=true)
    {
        return CategoryDocument::load($this->_pdo,$this->_categoryDocument,$lazyload);
    }
    
    /**
     * Récupérer le/les id(s) du/de la categoryDocument
     * @return int Id de categoryDocument
     */
    public function getCategoryDocumentId()
    {
        return $this->_categoryDocument;
    }
    
    /**
     * Définir le/la categoryDocument
     * @param $categoryDocument CategoryDocument 
     * @param $execute bool Exécuter la requête update ?
     * @return bool Opération réussie ?
     */
    public function setCategoryDocument(CategoryDocument $categoryDocument,$execute=true)
    {
        // Sauvegarder dans l'objet
        $this->_categoryDocument = $categoryDocument->getIdCategoryDocument();
        
        // Sauvegarder dans la base de données (ou pas)
        return $execute ? Documents::_set(array(Documents::FIELDNAME_CATEGORYDOCUMENT_IDCATEGORYDOCUMENT),array($categoryDocument->getIdCategoryDocument())) : true;
    }
    
    /**
     * Définir le/la categoryDocument d'après son/ses id(s)
     * @param $idCategoryDocument int 
     * @param $execute bool Exécuter la requête update ?
     * @return bool Opération réussie ?
     */
    public function setCategoryDocumentById($idCategoryDocument,$execute=true)
    {
        // Sauvegarder dans l'objet
        $this->_categoryDocument = $idCategoryDocument;
        
        // Sauvegarder dans la base de données (ou pas)
        return $execute ? Documents::_set(array(Documents::FIELDNAME_CATEGORYDOCUMENT_IDCATEGORYDOCUMENT),array($idCategoryDocument)) : true;
    }
    
    /**
     * Sélectionner les documents par categoryDocument
     * @param $pdo PDO 
     * @param $categoryDocument CategoryDocument 
     * @return PDOStatement 
     */
    public static function selectByCategoryDocument(PDO $pdo,CategoryDocument $categoryDocument)
    {
        $pdoStatement = self::_select($pdo,Documents::FIELDNAME_CATEGORYDOCUMENT_IDCATEGORYDOCUMENT.' = ?');
        if (!$pdoStatement->execute(array($categoryDocument->getIdCategoryDocument()))) {
            throw new Exception('Erreur lors du chargement de tous/toutes les documents d\'un(e) categoryDocument depuis la base de données');
        }
        return $pdoStatement;
    }
    
    /**
     * Ajouter un(e) mandateEtap
     * @param $mandateEtap MandateEtap 
     * @return bool Opération réussie ?
     */
    public function addMandateEtap(MandateEtap $mandateEtap)
    {
        $pdoStatement = $this->_pdo->prepare('INSERT INTO '.Association_DocumentsMandateEtap::TABLENAME.' ('.Association_DocumentsMandateEtap::FIELDNAME_DOCUMENTS_IDDOCUMENTS.','.Association_DocumentsMandateEtap::FIELDNAME_MANDATEETAP_IDMANDATEETAP.') VALUES (?,?)');
        if (!$pdoStatement->execute(array($this->getIdDocuments(),$mandateEtap->getIdMandateEtap()))) {
            throw new Exception('Erreur lors de l\'ajout d\'un(e) mandateEtap à un(e) documents dans la base de données');
        }
        return $pdoStatement->rowCount() == 1;
    }
    
    /**
     * Ajouter une liste de mandateEtaps
     * @param $mandateEtaps MandateEtap[] Tableau de mandateEtaps
     * @return bool Opération réussie ?
     */
    public function addListOfMandateEtaps($mandateEtaps)
    {
        $pdoStatement = $this->_pdo->prepare('INSERT INTO '.Association_DocumentsMandateEtap::TABLENAME.' ('.Association_DocumentsMandateEtap::FIELDNAME_DOCUMENTS_IDDOCUMENTS.','.Association_DocumentsMandateEtap::FIELDNAME_MANDATEETAP_IDMANDATEETAP.') VALUES '.implode(',',array_fill(0,count($mandateEtaps),'(?,?)')));
        $values = array();
        foreach($mandateEtaps as $mandateEtap) {
            $values[] = $this->getIdDocuments();
            $values[] = $mandateEtap->getIdMandateEtap();
        }
        if (!$pdoStatement->execute($values)) {
            throw new Exception('Erreur lors de l\'ajout d\'une liste de mandateEtaps à un(e) documents dans la base de données');
        }
        return $pdoStatement->rowCount() == count($mandateEtaps);
    }
    
    /**
     * Ajouter un(e) mandateEtap d'après son/ses id(s)
     * @param $idMandateEtap int 
     * @return bool Opération réussie ?
     */
    public function addMandateEtapById($idMandateEtap)
    {
        $pdoStatement = $this->_pdo->prepare('INSERT INTO '.Association_DocumentsMandateEtap::TABLENAME.' ('.Association_DocumentsMandateEtap::FIELDNAME_DOCUMENTS_IDDOCUMENTS.','.Association_DocumentsMandateEtap::FIELDNAME_MANDATEETAP_IDMANDATEETAP.') VALUES (?,?)');
        if (!$pdoStatement->execute(array($this->getIdDocuments(),$idMandateEtap))) {
            throw new Exception('Erreur lors de l\'ajout d\'un(e) mandateEtap à un(e) documents dans la base de données');
        }
        return $pdoStatement->rowCount() == 1;
    }
    
    /**
     * Retirer un(e) mandateEtap
     * @param $mandateEtap MandateEtap 
     * @return bool Opération réussie ?
     */
    public function removeMandateEtap(MandateEtap $mandateEtap)
    {
        $pdoStatement = $this->_pdo->prepare('DELETE FROM '.Association_DocumentsMandateEtap::TABLENAME.' WHERE '.Association_DocumentsMandateEtap::FIELDNAME_DOCUMENTS_IDDOCUMENTS.' = ? AND '.Association_DocumentsMandateEtap::FIELDNAME_MANDATEETAP_IDMANDATEETAP.' = ?');
        if (!$pdoStatement->execute(array($this->getIdDocuments(),$mandateEtap->getIdMandateEtap()))) {
            throw new Exception('Erreur lors de la suppression d\'un(e) mandateEtap d\'un(e) documents dans la base de données');
        }
        return $pdoStatement->rowCount() == 1;
    }
    
    /**
     * Retirer une liste de mandateEtaps
     * @param $mandateEtaps MandateEtap[] Tableau de mandateEtaps
     * @return bool Opération réussie ?
     */
    public function removeListOfMandateEtaps($mandateEtaps)
    {
        $pdoStatement = $this->_pdo->prepare('DELETE FROM '.Association_DocumentsMandateEtap::TABLENAME.' WHERE '.implode(' OR ',array_fill(0,count($mandateEtaps),'('.Association_DocumentsMandateEtap::FIELDNAME_DOCUMENTS_IDDOCUMENTS.' = ? AND '.Association_DocumentsMandateEtap::FIELDNAME_MANDATEETAP_IDMANDATEETAP.' = ?)')));
        $values = array();
        foreach($mandateEtaps as $mandateEtap) {
            $values[] = $this->getIdDocuments();
            $values[] = $mandateEtap->getIdMandateEtap();
        }
        if (!$pdoStatement->execute($values)) {
            throw new Exception('Erreur lors de la suppression d\'une liste de mandateEtaps d\'un(e) documents dans la base de données');
        }
        return $pdoStatement->rowCount() == count($mandateEtaps);
    }
    
    /**
     * Retirer un(e) mandateEtap d'après son/ses id(s)
     * @param $idMandateEtap int 
     * @return bool Opération réussie ?
     */
    public function removeMandateEtapById($idMandateEtap)
    {
        $pdoStatement = $this->_pdo->prepare('DELETE FROM '.Association_DocumentsMandateEtap::TABLENAME.' WHERE '.Association_DocumentsMandateEtap::FIELDNAME_DOCUMENTS_IDDOCUMENTS.' = ? AND '.Association_DocumentsMandateEtap::FIELDNAME_MANDATEETAP_IDMANDATEETAP.' = ?');
        if (!$pdoStatement->execute(array($this->getIdDocuments(),$idMandateEtap))) {
            throw new Exception('Erreur lors de la suppression d\'un(e) mandateEtap d\'un(e) documents dans la base de données');
        }
        return $pdoStatement->rowCount() == 1;
    }
    
    /**
     * Retirer tous/toutes les mandateEtaps
     * @return int Nombre de lignes affectées
     */
    public function removeAllMandateEtaps()
    {
        $pdoStatement = $this->_pdo->prepare('DELETE FROM '.Association_DocumentsMandateEtap::TABLENAME.' WHERE '.Association_DocumentsMandateEtap::FIELDNAME_DOCUMENTS_IDDOCUMENTS.' = ?');
        if (!$pdoStatement->execute(array($this->getIdDocuments()))) {
            throw new Exception('Erreur lors de la suppression de tous/toutes les mandateEtaps d\'un(e) documents dans la base de données');
        }
        return $pdoStatement->rowCount();
    }
    
    /**
     * Sélectionner les mandateEtaps
     * @return PDOStatement 
     */
    public function selectMandateEtaps()
    {
      //  return MandateEtap::selectByDocuments($this->_pdo,$this);

        $sql ="SELECT m.idMandateEtap, m.name
        FROM MandateEtap m, ".Association_DocumentsMandateEtap::TABLENAME." a
        WHERE (m.idMandateEtap =a.".Association_DocumentsMandateEtap::FIELDNAME_MANDATEETAP_IDMANDATEETAP.") AND a.".Association_DocumentsMandateEtap::FIELDNAME_DOCUMENTS_IDDOCUMENTS." = ? ";
        $pdoStatement= $this->_pdo->prepare($sql);


        if (!$pdoStatement->execute(array($this->getIdDocuments()))) {
            throw new Exception('Erreur lors du chargement de tous/toutes les mandateTypes d\'un(e) documents depuis la base de données');
        }
        return $pdoStatement;


    }
    
    /**
     * Sélectionner les documents par mandateEtap
     * @param $pdo PDO 
     * @param $mandateEtap MandateEtap 
     * @return PDOStatement 
     */
    public static function selectByMandateEtap(PDO $pdo,MandateEtap $mandateEtap)
    {
        $pdoStatement = self::_select($pdo,Association_DocumentsMandateEtap::TABLENAME.'.'.Association_DocumentsMandateEtap::FIELDNAME_MANDATEETAP_IDMANDATEETAP.' = ? AND '.Association_DocumentsMandateEtap::TABLENAME.'.'.Association_DocumentsMandateEtap::FIELDNAME_DOCUMENTS_IDDOCUMENTS.' = '.Documents::TABLENAME.'.'.Documents::FIELDNAME_IDDOCUMENTS,null,null,array(Association_DocumentsMandateEtap::TABLENAME));
        if (!$pdoStatement->execute(array($mandateEtap->getIdMandateEtap()))) {
            throw new Exception('Erreur lors du chargement de tous/toutes les documents d\'un(e) mandateEtap depuis la base de données');
        }
        return $pdoStatement;
    }
    
    /**
     * Ajouter un(e) mandateType
     * @param $mandateType MandateType 
     * @return bool Opération réussie ?
     */
    public function addMandateType(MandateType $mandateType)
    {
        $pdoStatement = $this->_pdo->prepare('INSERT INTO '.Association_DocumentsMandateType::TABLENAME.' ('.Association_DocumentsMandateType::FIELDNAME_DOCUMENTS_IDDOCUMENTS.','.Association_DocumentsMandateType::FIELDNAME_MANDATETYPE_IDMANDATETYPE.') VALUES (?,?)');
        if (!$pdoStatement->execute(array($this->getIdDocuments(),$mandateType->getIdMandateType()))) {
            throw new Exception('Erreur lors de l\'ajout d\'un(e) mandateType à un(e) documents dans la base de données');
        }
        return $pdoStatement->rowCount() == 1;
    }
    
    /**
     * Ajouter une liste de mandateTypes
     * @param $mandateTypes MandateType[] Tableau de mandateTypes
     * @return bool Opération réussie ?
     */
    public function addListOfMandateTypes($mandateTypes)
    {
        $pdoStatement = $this->_pdo->prepare('INSERT INTO '.Association_DocumentsMandateType::TABLENAME.' ('.Association_DocumentsMandateType::FIELDNAME_DOCUMENTS_IDDOCUMENTS.','.Association_DocumentsMandateType::FIELDNAME_MANDATETYPE_IDMANDATETYPE.') VALUES '.implode(',',array_fill(0,count($mandateTypes),'(?,?)')));
        $values = array();
        foreach($mandateTypes as $mandateType) {
            $values[] = $this->getIdDocuments();
            $values[] = $mandateType->getIdMandateType();
        }
        if (!$pdoStatement->execute($values)) {
            throw new Exception('Erreur lors de l\'ajout d\'une liste de mandateTypes à un(e) documents dans la base de données');
        }
        return $pdoStatement->rowCount() == count($mandateTypes);
    }
    
    /**
     * Ajouter un(e) mandateType d'après son/ses id(s)
     * @param $idMandateType int 
     * @return bool Opération réussie ?
     */
    public function addMandateTypeById($idMandateType)
    {
        $pdoStatement = $this->_pdo->prepare('INSERT INTO '.Association_DocumentsMandateType::TABLENAME.' ('.Association_DocumentsMandateType::FIELDNAME_DOCUMENTS_IDDOCUMENTS.','.Association_DocumentsMandateType::FIELDNAME_MANDATETYPE_IDMANDATETYPE.') VALUES (?,?)');
        if (!$pdoStatement->execute(array($this->getIdDocuments(),$idMandateType))) {
            throw new Exception('Erreur lors de l\'ajout d\'un(e) mandateType à un(e) documents dans la base de données');
        }
        return $pdoStatement->rowCount() == 1;
    }
    
    /**
     * Retirer un(e) mandateType
     * @param $mandateType MandateType 
     * @return bool Opération réussie ?
     */
    public function removeMandateType(MandateType $mandateType)
    {
        $pdoStatement = $this->_pdo->prepare('DELETE FROM '.Association_DocumentsMandateType::TABLENAME.' WHERE '.Association_DocumentsMandateType::FIELDNAME_DOCUMENTS_IDDOCUMENTS.' = ? AND '.Association_DocumentsMandateType::FIELDNAME_MANDATETYPE_IDMANDATETYPE.' = ?');
        if (!$pdoStatement->execute(array($this->getIdDocuments(),$mandateType->getIdMandateType()))) {
            throw new Exception('Erreur lors de la suppression d\'un(e) mandateType d\'un(e) documents dans la base de données');
        }
        return $pdoStatement->rowCount() == 1;
    }
    
    /**
     * Retirer une liste de mandateTypes
     * @param $mandateTypes MandateType[] Tableau de mandateTypes
     * @return bool Opération réussie ?
     */
    public function removeListOfMandateTypes($mandateTypes)
    {
        $pdoStatement = $this->_pdo->prepare('DELETE FROM '.Association_DocumentsMandateType::TABLENAME.' WHERE '.implode(' OR ',array_fill(0,count($mandateTypes),'('.Association_DocumentsMandateType::FIELDNAME_DOCUMENTS_IDDOCUMENTS.' = ? AND '.Association_DocumentsMandateType::FIELDNAME_MANDATETYPE_IDMANDATETYPE.' = ?)')));
        $values = array();
        foreach($mandateTypes as $mandateType) {
            $values[] = $this->getIdDocuments();
            $values[] = $mandateType->getIdMandateType();
        }
        if (!$pdoStatement->execute($values)) {
            throw new Exception('Erreur lors de la suppression d\'une liste de mandateTypes d\'un(e) documents dans la base de données');
        }
        return $pdoStatement->rowCount() == count($mandateTypes);
    }
    
    /**
     * Retirer un(e) mandateType d'après son/ses id(s)
     * @param $idMandateType int 
     * @return bool Opération réussie ?
     */
    public function removeMandateTypeById($idMandateType)
    {
        $pdoStatement = $this->_pdo->prepare('DELETE FROM '.Association_DocumentsMandateType::TABLENAME.' WHERE '.Association_DocumentsMandateType::FIELDNAME_DOCUMENTS_IDDOCUMENTS.' = ? AND '.Association_DocumentsMandateType::FIELDNAME_MANDATETYPE_IDMANDATETYPE.' = ?');
        if (!$pdoStatement->execute(array($this->getIdDocuments(),$idMandateType))) {
            throw new Exception('Erreur lors de la suppression d\'un(e) mandateType d\'un(e) documents dans la base de données');
        }
        return $pdoStatement->rowCount() == 1;
    }
    
    /**
     * Retirer tous/toutes les mandateTypes
     * @return int Nombre de lignes affectées
     */
    public function removeAllMandateTypes()
    {
        $pdoStatement = $this->_pdo->prepare('DELETE FROM '.Association_DocumentsMandateType::TABLENAME.' WHERE '.Association_DocumentsMandateType::FIELDNAME_DOCUMENTS_IDDOCUMENTS.' = ?');
        if (!$pdoStatement->execute(array($this->getIdDocuments()))) {
            throw new Exception('Erreur lors de la suppression de tous/toutes les mandateTypes d\'un(e) documents dans la base de données');
        }
        return $pdoStatement->rowCount();
    }
    
    /**
     * Sélectionner les mandateTypes
     * @return PDOStatement 
     */
    public function selectMandateTypes()
    {
        $sql ="SELECT m.idMandateType, m.name
        FROM MandateType m, ".Association_DocumentsMandateType::TABLENAME." a
        WHERE (m.idMandateType =a.".Association_DocumentsMandateType::FIELDNAME_MANDATETYPE_IDMANDATETYPE.") AND a.".Association_DocumentsMandateType::FIELDNAME_DOCUMENTS_IDDOCUMENTS." = ? ";
            $pdoStatement= $this->_pdo->prepare($sql);


        if (!$pdoStatement->execute(array($this->getIdDocuments()))) {
            throw new Exception('Erreur lors du chargement de tous/toutes les mandateTypes d\'un(e) documents depuis la base de données');
        }
        return $pdoStatement;

    }
    
    /**
     * Sélectionner les documents par mandateType
     * @param $pdo PDO 
     * @param $mandateType MandateType 
     * @return PDOStatement 
     */
    public static function selectByMandateType(PDO $pdo,MandateType $mandateType)
    {
        $pdoStatement = self::_select($pdo,Association_DocumentsMandateType::TABLENAME.'.'.Association_DocumentsMandateType::FIELDNAME_MANDATETYPE_IDMANDATETYPE.' = ? AND '.Association_DocumentsMandateType::TABLENAME.'.'.Association_DocumentsMandateType::FIELDNAME_DOCUMENTS_IDDOCUMENTS.' = '.Documents::TABLENAME.'.'.Documents::FIELDNAME_IDDOCUMENTS,null,null,array(Association_DocumentsMandateType::TABLENAME));
        if (!$pdoStatement->execute(array($mandateType->getIdMandateType()))) {
            throw new Exception('Erreur lors du chargement de tous/toutes les documents d\'un(e) mandateType depuis la base de données');
        }
        return $pdoStatement;
    }
    
    /**
     * ToString
     * @return string Représentation de documents sous la forme d'un string
     */
    public function __toString()
    {
        return '[Documents idDocuments="'.$this->_idDocuments.'" name="'.$this->_name.'" corps="'.$this->_corps.'" categoryDocument="'.$this->_categoryDocument.'"]';
    }
    /**
     * Sérialiser
     * @param $serialize bool Activer la sérialisation ?
     * @return string Sérialisation du/de la documents
     */
    public function serialize($serialize=true)
    {
        // Sérialiser le/la documents
        $array = array('iddocuments' => $this->_idDocuments,'name' => $this->_name,'corps' => $this->_corps,'categorydocument' => $this->_categoryDocument);
        
        // Retourner la sérialisation (ou pas) du/de la documents
        return $serialize ? serialize($array) : $array;
    }
    
    /**
     * Désérialiser
     * @param $pdo PDO 
     * @param $string string Sérialisation du/de la documents
     * @param $lazyload bool Activer le chargement fainéant ?
     * @return Documents 
     */
    public static function unserialize(PDO $pdo,$string,$lazyload=true)
    {
        // Désérialiser la chaine de caractères
        $array = unserialize($string);
        
        // Construire le/la documents
        return $lazyload && isset(self::$_lazyload[$array['iddocuments']]) ? self::$_lazyload[$array['iddocuments']] :
               new Documents($pdo,$array['iddocuments'],$array['name'],$array['corps'],$array['categorydocument'],$lazyload);
    }
    
}

