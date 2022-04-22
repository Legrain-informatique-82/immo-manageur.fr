<?php

/**
 * @name Base_CategoryDocument
 * @version 09/07/2014 (dd/mm/yyyy)
 * @author WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
abstract class Base_CategoryDocument
{
    // Nom de la table
    const TABLENAME = 'categorydocument';
    
    // Nom des champs
    const FIELDNAME_IDCATEGORYDOCUMENT = 'idcategorydocument';
    const FIELDNAME_NAME = 'name';

    const FIELDNAME_CODE = 'code';
    
    /** @var PDO  */
    protected $_pdo;
    
    /** @var array tableau pour le chargement fainéant */
    protected static $_lazyload;
    
    /** @var int  */
    protected $_idCategoryDocument;
    
    /** @var string  */
    protected $_name;

    /**
     * @var string
     */
    protected $_code;
    
    /**
     * Construire un(e) categoryDocument
     * @param $pdo PDO 
     * @param $idCategoryDocument int 
     * @param $name string
     * @param $code string
     * @param $lazyload bool Activer le chargement fainéant ?
     */
    protected function __construct(PDO $pdo,$idCategoryDocument,$name,$code,$lazyload=true)
    {
        // Sauvegarder pdo
        $this->_pdo = $pdo;
        
        // Sauvegarder les attributs
        $this->_idCategoryDocument = $idCategoryDocument;
        $this->_name = $name;
        $this->_code=$code;
        
        // Sauvegarder pour le chargement fainéant
        if ($lazyload) {
            self::$_lazyload[$idCategoryDocument] = $this;
        }
    }
    
    /**
     * Créer un(e) categoryDocument
     * @param $pdo PDO 
     * @param $name string
     * @param $code string
     * @param $lazyload bool Activer le chargement fainéant ?
     * @return CategoryDocument 
     */
    public static function create(PDO $pdo,$name,$code,$lazyload=true)
    {
        // Ajouter le/la categoryDocument dans la base de données
        $pdoStatement = $pdo->prepare('INSERT INTO '.CategoryDocument::TABLENAME.' ('.CategoryDocument::FIELDNAME_NAME.','.CategoryDocument::FIELDNAME_CODE.') VALUES (?,?)');
        if (!$pdoStatement->execute(array($name,$code))) {
            throw new Exception('Erreur durant l\'insertion d\'un(e) categoryDocument dans la base de données');
        }
        
        // Construire le/la categoryDocument
        return new CategoryDocument($pdo,intval($pdo->lastInsertId()),$name,$code,$lazyload);
    }
    
    /**
     * Compter les categoryDocuments
     * @param $pdo PDO 
     * @return int Nombre de categoryDocuments
     */
    public static function count(PDO $pdo)
    {
        if (!($pdoStatement = $pdo->query('SELECT COUNT('.CategoryDocument::FIELDNAME_IDCATEGORYDOCUMENT.') FROM '.CategoryDocument::TABLENAME))) {
            throw new Exception('Erreur lors du comptage des categoryDocuments dans la base de données');
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
        return $pdo->prepare('SELECT DISTINCT '.CategoryDocument::TABLENAME.'.'.CategoryDocument::FIELDNAME_IDCATEGORYDOCUMENT.', '.CategoryDocument::TABLENAME.'.'.CategoryDocument::FIELDNAME_NAME.', '.CategoryDocument::TABLENAME.'.'.CategoryDocument::FIELDNAME_CODE.' '.
                             'FROM '.CategoryDocument::TABLENAME.($from != null ? ', '.(is_array($from) ? implode(', ',$from) : $from) : '').
                             ($where != null ? ' WHERE '.(is_array($where) ? implode(' AND ',$where) : $where) : '').
                             ($orderby != null ? ' ORDER BY '.(is_array($orderby) ? implode(', ',$orderby) : $orderby) : '').
                             ($limit != null ? ' LIMIT '.(is_array($limit) ? implode(', ', $limit) : $limit) : ''));
    }
    
    /**
     * Charger un(e) categoryDocument
     * @param $pdo PDO 
     * @param $idCategoryDocument int 
     * @param $lazyload bool Activer le chargement fainéant ?
     * @return CategoryDocument 
     */
    public static function load(PDO $pdo,$idCategoryDocument,$lazyload=true)
    {
        // Déjà chargé(e) ?
        if ($lazyload && isset(self::$_lazyload[$idCategoryDocument])) {
            return self::$_lazyload[$idCategoryDocument];
        }
        
        // Charger le/la categoryDocument
        $pdoStatement = self::_select($pdo,CategoryDocument::FIELDNAME_IDCATEGORYDOCUMENT.' = ?');
        if (!$pdoStatement->execute(array($idCategoryDocument))) {
            throw new Exception('Erreur lors du chargement d\'un(e) categoryDocument depuis la base de données');
        }
        
        // Récupérer le/la categoryDocument depuis le jeu de résultats
        return self::fetch($pdo,$pdoStatement,$lazyload);
    }
    
    /**
     * Recharger les données depuis la base de données
     */
    public function reload()
    {
        // Recharger les données
        $pdoStatement = self::_select($this->_pdo,CategoryDocument::FIELDNAME_IDCATEGORYDOCUMENT.' = ?');
        if (!$pdoStatement->execute(array($this->_idCategoryDocument))) {
            throw new Exception('Erreur durant le rechargement des données d\'un(e) categoryDocument depuis la base de données');
        }
        
        // Extraire les valeurs
        $values = $pdoStatement->fetch(PDO::FETCH_NUM);
        if (!$values) { return null; }
        list($idCategoryDocument,$name) = $values;
        
        // Sauvegarder les valeurs
        $this->_name = $name;
    }
    
    /**
     * Charger tous/toutes les categoryDocuments
     * @param $pdo PDO 
     * @param $lazyload bool Activer le chargement fainéant ?
     * @return CategoryDocument[] Tableau de categoryDocuments
     */
    public static function loadAll(PDO $pdo,$lazyload=true)
    {
        // Sélectionner tous/toutes les categoryDocuments
        $pdoStatement = self::selectAll($pdo);
        
        // Récupèrer tous/toutes les categoryDocuments
        $categoryDocuments = self::fetchAll($pdo,$pdoStatement,$lazyload);
        
        // Retourner le tableau
        return $categoryDocuments;
    }
    
    /**
     * Sélectionner tous/toutes les categoryDocuments
     * @param $pdo PDO 
     * @return PDOStatement 
     */
    public static function selectAll(PDO $pdo)
    {
        $pdoStatement = self::_select($pdo);
        if (!$pdoStatement->execute()) {
            throw new Exception('Erreur lors du chargement de tous/toutes les categoryDocuments depuis la base de données');
        }
        return $pdoStatement;
    }
    
    /**
     * Récupèrer le/la categoryDocument suivant(e) d'un jeu de résultats
     * @param $pdo PDO 
     * @param $pdoStatement PDOStatement 
     * @param $lazyload bool Activer le chargement fainéant ?
     * @return CategoryDocument 
     */
    public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$lazyload=true)
    {
        // Extraire les valeurs
        $values = $pdoStatement->fetch(PDO::FETCH_NUM);
        if (!$values) { return null; }
        list($idCategoryDocument,$name,$code) = $values;
        
        // Construire le/la categoryDocument
        return $lazyload && isset(self::$_lazyload[intval($idCategoryDocument)]) ? self::$_lazyload[intval($idCategoryDocument)] :
               new CategoryDocument($pdo,intval($idCategoryDocument),$name,$code,$lazyload);
    }
    
    /**
     * Récupèrer tous/toutes les categoryDocuments d'un jeu de résultats
     * @param $pdo PDO 
     * @param $pdoStatement PDOStatement 
     * @param $lazyload bool Activer le chargement fainéant ?
     * @return CategoryDocument[] Tableau de categoryDocuments
     */
    public static function fetchAll(PDO $pdo,PDOStatement $pdoStatement,$lazyload=true)
    {
        $categoryDocuments = array();
        while ($categoryDocument = self::fetch($pdo,$pdoStatement,$lazyload)) {
            $categoryDocuments[] = $categoryDocument;
        }
        return $categoryDocuments;
    }
    
    /**
     * Test d'égalité
     * @param $categoryDocument CategoryDocument 
     * @return bool Les objets sont-ils égaux ?
     */
    public function equals($categoryDocument)
    {
        // Test si null
        if ($categoryDocument == null) { return false; }
        
        // Tester la classe
        if (!($categoryDocument instanceof CategoryDocument)) { return false; }
        
        // Tester les ids
        return $this->_idCategoryDocument == $categoryDocument->_idCategoryDocument;
    }
    
    /**
     * Vérifier que le/la categoryDocument existe en base de données
     * @return bool Le/La categoryDocument existe en base de données ?
     */
    public function exists()
    {
        $pdoStatement = $this->_pdo->prepare('SELECT COUNT('.CategoryDocument::FIELDNAME_IDCATEGORYDOCUMENT.') FROM '.CategoryDocument::TABLENAME.' WHERE '.CategoryDocument::FIELDNAME_IDCATEGORYDOCUMENT.' = ?');
        if (!$pdoStatement->execute(array($this->getIdCategoryDocument()))) {
            throw new Exception('Erreur lors de la vérification qu\'un(e) categoryDocument existe dans la base de données');
        }
        return $pdoStatement->fetchColumn() == 1;
    }
    
    /**
     * Supprimer le/la categoryDocument
     * @return bool Opération réussie ?
     */
    public function delete()
    {
        // Supprimer le/la categoryDocument
        $pdoStatement = $this->_pdo->prepare('DELETE FROM '.CategoryDocument::TABLENAME.' WHERE '.CategoryDocument::FIELDNAME_IDCATEGORYDOCUMENT.' = ?');
        if (!$pdoStatement->execute(array($this->getIdCategoryDocument()))) {
            throw new Exception('Erreur lors de la suppression d\'un(e) categoryDocument dans la base de données');
        }
        
        // Supprimer du tableau pour le chargement fainéant
        if (isset(self::$_lazyload[$this->_idCategoryDocument])) {
            unset(self::$_lazyload[$this->_idCategoryDocument]);
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
        $pdoStatement = $this->_pdo->prepare('UPDATE '.CategoryDocument::TABLENAME.' SET '.implode(', ', $updates).' WHERE '.CategoryDocument::FIELDNAME_IDCATEGORYDOCUMENT.' = ?');
        if (!$pdoStatement->execute(array_merge($values,array($this->getIdCategoryDocument())))) {
            throw new Exception('Erreur lors de la mise à jour d\'un champ d\'un(e) categoryDocument dans la base de données');
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
        return $this->_set(array(CategoryDocument::FIELDNAME_NAME,CategoryDocument::FIELDNAME_CODE),array($this->_name,$this->_code));
    }
    
    /**
     * Récupérer le/la idCategoryDocument
     * @return int 
     */
    public function getIdCategoryDocument()
    {
        return $this->_idCategoryDocument;
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
        return $execute ? CategoryDocument::_set(array(CategoryDocument::FIELDNAME_NAME),array($name)) : true;
    }

    /**
     * Définir le/la code
     * @param $code string
     * @param $execute bool Exécuter la requête update ?
     * @return bool Opération réussie ?
     */
    public function setCode($code,$execute=true)
    {
        // Sauvegarder dans l'objet
        $this->_code = $code;

        // Sauvegarder dans la base de données (ou pas)
        return $execute ? CategoryDocument::_set(array(CategoryDocument::FIELDNAME_CODE),array($code)) : true;
    }
    /**
     * Récupérer le/la code
     * @return string
     */
    public function getCode()
    {
        return $this->_code;
    }

    /**
     * Sélectionner les documents
     * @return PDOStatement 
     */
    public function selectDocuments()
    {
        return Documents::selectByCategoryDocument($this->_pdo,$this);
    }
    
    /**
     * ToString
     * @return string Représentation de categoryDocument sous la forme d'un string
     */
    public function __toString()
    {
        return '[CategoryDocument idCategoryDocument="'.$this->_idCategoryDocument.'" name="'.$this->_name.' code="'.$this->_code.'"]';
    }
    /**
     * Sérialiser
     * @param $serialize bool Activer la sérialisation ?
     * @return string Sérialisation du/de la categoryDocument
     */
    public function serialize($serialize=true)
    {
        // Sérialiser le/la categoryDocument
        $array = array('idcategorydocument' => $this->_idCategoryDocument,'name' => $this->_name,'code'=> $this->_code);
        
        // Retourner la sérialisation (ou pas) du/de la categoryDocument
        return $serialize ? serialize($array) : $array;
    }
    
    /**
     * Désérialiser
     * @param $pdo PDO 
     * @param $string string Sérialisation du/de la categoryDocument
     * @param $lazyload bool Activer le chargement fainéant ?
     * @return CategoryDocument 
     */
    public static function unserialize(PDO $pdo,$string,$lazyload=true)
    {
        // Désérialiser la chaine de caractères
        $array = unserialize($string);
        
        // Construire le/la categoryDocument
        return $lazyload && isset(self::$_lazyload[$array['idcategorydocument']]) ? self::$_lazyload[$array['idcategorydocument']] :
               new CategoryDocument($pdo,$array['idcategorydocument'],$array['name'],$array['code'],$lazyload);
    }
    
}

