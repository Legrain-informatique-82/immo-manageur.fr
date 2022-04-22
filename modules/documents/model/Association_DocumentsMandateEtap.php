<?php

/**
 * Classe d'association entre Documents et MandateEtap
 * @name Association_DocumentsMandateEtap
 * @version 09/07/2014 (dd/mm/yyyy)
 * @author WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class Association_DocumentsMandateEtap
{
    
    // Nom de la table
    const TABLENAME = 'documents_mandateetap';
    
    // Nom des champs
    const FIELDNAME_DOCUMENTS_IDDOCUMENTS = 'fk_iddocuments';
    const FIELDNAME_MANDATEETAP_IDMANDATEETAP = 'fk_idmandateetap';
    
}
