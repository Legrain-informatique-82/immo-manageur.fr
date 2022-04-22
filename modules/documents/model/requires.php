<?php

//define the Paragraph String ~~ Required by Multicell Class
define('PARAGRAPH_STRING', '~~~');
require_once Constant::DEFAULT_MODULE_DIRECTORY.'/documents/model/fpdf/fpdf.php';
require_once Constant::DEFAULT_MODULE_DIRECTORY.'/documents/model/fpdf/pdfE.php';
require_once Constant::DEFAULT_MODULE_DIRECTORY.'/documents/model/fpdf/class.string_tags.php';
require_once Constant::DEFAULT_MODULE_DIRECTORY.'/documents/model/fpdf/class.multicelltag.php';
require_once Constant::DEFAULT_MODULE_DIRECTORY.'/documents/model/fpdf/fpdfEBis.php';
require_once Constant::DEFAULT_MODULE_DIRECTORY.'/documents/model/html2pdf/html2pdf.class.php';
//require_once 'documents.php';


require_once 'Association_DocumentsMandateEtap.php';
require_once 'Association_DocumentsMandateType.php';
require_once 'Base_CategoryDocument.php';
require_once 'Base_Documents.php';
require_once 'CategoryDocument.php';
require_once 'Documents.php';





