<?php

/**
 * @name Documents
 * @version 09/07/2014 (dd/mm/yyyy)
 */
class Documents extends Base_Documents
{
    
    // Placez votre code ici...

    public function getId(){
        return $this->getIdDocuments();
    }

    /**
     * Charger tous/toutes les documents
     * @param $pdo PDO
     * @param $lazyload bool Activer le chargement fainéant ?
     * @return Documents[] Tableau de documents
     */
    public static function loadAllByMandate(PDO $pdo,Mandate $mandate,$lazyload=true)
    {

        $where=array(
            '('.Association_DocumentsMandateType::TABLENAME.'.'.Association_DocumentsMandateType::FIELDNAME_DOCUMENTS_IDDOCUMENTS .'= '.Documents::TABLENAME.'.'.Documents::FIELDNAME_IDDOCUMENTS.')',
            '('.Association_DocumentsMandateEtap::TABLENAME.'.'.Association_DocumentsMandateEtap::FIELDNAME_DOCUMENTS_IDDOCUMENTS .'= '.Documents::TABLENAME.'.'.Documents::FIELDNAME_IDDOCUMENTS.')',
            '('.Association_DocumentsMandateEtap::TABLENAME.'.'.Association_DocumentsMandateEtap::FIELDNAME_MANDATEETAP_IDMANDATEETAP.' = '.$mandate->getEtap()->getId().')',
            '('.Association_DocumentsMandateType::TABLENAME.'.'.Association_DocumentsMandateType::FIELDNAME_MANDATETYPE_IDMANDATETYPE.' = '.$mandate->getMandateType()->getId().')'
        );
        $orderBy = Documents::TABLENAME.'.'.Documents::FIELDNAME_CATEGORYDOCUMENT_IDCATEGORYDOCUMENT;
        $from=array(Association_DocumentsMandateEtap::TABLENAME,Association_DocumentsMandateType::TABLENAME);
        // Sélectionner tous/toutes les documents
        $pdoStatement = self::_select($pdo,$where,$orderBy,null,$from);
        if (!$pdoStatement->execute()) {
            throw new Exception('Erreur lors du chargement de tous/toutes les documents depuis la base de données');
        }


        // Récupèrer tous/toutes les documents
        $array = self::fetchAll($pdo,$pdoStatement,$lazyload);

        // Retourner le tableau
        return $array;
    }
    
}

