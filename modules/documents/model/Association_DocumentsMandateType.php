<?php

/**
 * Classe d'association entre Documents et MandateType
 * @name Association_DocumentsMandateType
 * @version 09/07/2014 (dd/mm/yyyy)
 * @author WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class Association_DocumentsMandateType
{
    
    // Nom de la table
    const TABLENAME = 'documents_mandatetype';
    
    // Nom des champs
    const FIELDNAME_DOCUMENTS_IDDOCUMENTS = 'fk_iddocuments';
    const FIELDNAME_MANDATETYPE_IDMANDATETYPE = 'fk_idmandatetype';
    
}
