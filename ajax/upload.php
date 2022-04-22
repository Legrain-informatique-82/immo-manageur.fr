<?php
session_start();
// augmentation de la mémoire, le refaire si des images non réduites devaient réaparaitre.
ini_set("memory_limit", "512M");

require_once dirname(__FILE__).'/../libs/php_functions_missing.php';
require_once dirname(__FILE__).'/../const/config.php';
require_once dirname(__FILE__).'/../class/interfaceController.php';
require_once dirname(__FILE__).'/../class/CoreController.class.php';
require_once dirname(__FILE__).'/../class/Tools.php';
require_once dirname(__FILE__).'/../modules/user/model/requires.php';
require_once dirname(__FILE__).'/../modules/acquereur/model/requires.php';
require_once dirname(__FILE__).'/../modules/sector/model/requires.php';
require_once dirname(__FILE__).'/../modules/biens/model/requires.php';
require_once dirname(__FILE__).'/../modules/mandate_features/model/requires.php';
require_once dirname(__FILE__).'/../modules/mandate_type/model/requires.php';
$pdo = new PDO('mysql:dbname='.Constant::DATABASE_NAME.';host='.Constant::DATABASE_SERVER.';',Constant::DATABASE_USER,Constant::DATABASE_PASSWORD);
$userToTakeAction = User::unserialize($pdo,$_SESSION['user']);
$mandate = Mandate::load($pdo,$_GET['idMandat']);
if($userToTakeAction->getLevelMember()->getIdLevelMember() < 3 || $userToTakeAction->getIdUser() == $mandate->getUser()->getIdUser()){


// Make sure file is not cached (as it happens for example on iOS devices)
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");


    $tempFile = $_FILES['file']['tmp_name'];
    $module = $mandate->getMandateType()->getName()=='Terrain'?'terrain':'mandat';
    $targetPath =Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.$module.'/';
    $targetFile =  str_replace('//','/',$targetPath) . $_FILES['file']['name'];
    // Regarder si le mandat possede déjà une image principale, définir celle uploadé en fct
    $pictureByDefault= $mandate->getPictureByDefault();
    $isDefault=$pictureByDefault==null?1:0;
    // ajouter l'image au mandat, sans zapper le log.
    $pict = MandatePicture::create($pdo,'tmpName',$isDefault,$mandate);
    // le déplacer dans big
    move_uploaded_file($tempFile,$targetPath.'big/'.$_FILES['file']['name']);
    // renomer le fichier.
    $newName= $mandate->getIdMandate().'-'.$pict->getIdMandatePicture().'.jpg';
    rename($targetPath.'big/'.$_FILES['file']['name'],$targetPath.'big/'.$newName);
    // modifier le nom dans la bdd
    $pict->setName($newName);
    // le copier dans .. et dans ../thumb
    copy($targetPath.'big/'.$newName,$targetPath.$newName);
    copy($targetPath.'big/'.$newName,$targetPath.'thumb/'.$newName);
    //  retailler le fichier ..
    if(!Tools::redimentionne($targetPath.$newName,Constant::SIZE_X_PICTURE,Constant::SIZE_Y_PICTURE)){
        //mail('julien@legrain.fr','test','JE PASSE PAR LA et je ne redimentionne pas ....');
    };
    // retailler le fichier ../thumb
    Tools::redimentionne($targetPath.'thumb/'.$newName,Constant::SIZE_THUMB_X_PICTURE,Constant::SIZE_THUMB_Y_PICTURE);
    // log
    Log::create($pdo,time(),$module,'Ajout de d\'une image pour le mandat : '.$mandate->getNumberMandate(),$userToTakeAction);
   // echo str_replace($_SERVER['DOCUMENT_ROOT'],'',$targetFile);
    // Return Success JSON-RPC response
    die('{"jsonrpc" : "2.0", "result" : null, "id" : "id"}');




/*
// Support CORS
header("Access-Control-Allow-Origin: *");
// other CORS headers if any...
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
	exit; // finish preflight CORS requests here
}
*/
/*
// 5 minutes execution time
//@set_time_limit(5 * 60);

// Uncomment this one to fake upload time
// usleep(5000);

// Settings
//$targetDir = ini_get("upload_tmp_dir") . DIRECTORY_SEPARATOR . "plupload";
//$targetDir=Constant::DEFAULT_TMP_DIRECTORY . DIRECTORY_SEPARATOR . "plupload";
$targetDir="/var/www/aptana/immo-manageur.fr/tmp/plupload";

//$targetDir = 'uploads';
$cleanupTargetDir = false; // Remove old files
$maxFileAge = 5 * 3600; // Temp file age in seconds


// Create target dir
if (!file_exists($targetDir)) {
    @mkdir($targetDir);
}

// Get a file name
if (isset($_REQUEST["name"])) {
    $fileName = $_REQUEST["name"];
} elseif (!empty($_FILES)) {
    $fileName = $_FILES["file"]["name"];
} else {
    $fileName = uniqid("file_");
}

$filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;

// Chunking might be enabled
$chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
$chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;


// Remove old temp files
if ($cleanupTargetDir) {
    if (!is_dir($targetDir) || !$dir = opendir($targetDir)) {
        die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
    }

    while (($file = readdir($dir)) !== false) {
        $tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;

        // If temp file is current file proceed to the next
        if ($tmpfilePath == "{$filePath}.part") {
            continue;
        }

        // Remove temp file if it is older than the max age and is not the current file
        if (preg_match('/\.part$/', $file) && (filemtime($tmpfilePath) < time() - $maxFileAge)) {
            @unlink($tmpfilePath);
        }
    }
    closedir($dir);
}


// Open temp file
if (!$out = @fopen("{$filePath}.part", $chunks ? "ab" : "wb")) {
    die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
}

if (!empty($_FILES)) {
    if ($_FILES["file"]["error"] || !is_uploaded_file($_FILES["file"]["tmp_name"])) {
        die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
    }

    // Read binary input stream and append it to temp file
    if (!$in = @fopen($_FILES["file"]["tmp_name"], "rb")) {
        die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
    }
} else {
    if (!$in = @fopen("php://input", "rb")) {
        die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
    }
}

while ($buff = fread($in, 4096)) {
    fwrite($out, $buff);
}

@fclose($out);
@fclose($in);

// Check if file has been uploaded
if (!$chunks || $chunk == $chunks - 1) {
    // Strip the temp .part suffix off
    rename("{$filePath}.part", $filePath);
}

// Return Success JSON-RPC response
die('{"jsonrpc" : "2.0", "result" : null, "id" : "id"}');
*/
}
