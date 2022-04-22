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
$user = User::unserialize($pdo,$_SESSION['user']);
$mandate = Mandate::load($pdo,$_POST['idmandat']);

$mod = $mandate->getMandateType()->getId()==Constant::ID_PLOT_OF_LAND?'terrain':'mandat';


if($user->getLevelMember()->getIdLevelMember() < 3 || $user->getIdUser() == $mandate->getUser()->getIdUser()){
// Suppression de l'image ( physique et bdd)
$pictDel = MandatePicture::load($pdo,$_POST['idpicture']);
$namePict = $pictDel->getName();
$pictDel->delete();
    if(is_file(Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.'/'.$mod.'/thumb/'.$namePict)){
        unlink(Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.'/'.$mod.'/thumb/'.$namePict) ;
    }
    if(is_file(Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.'/'.$mod.'/'.$namePict)){
        unlink(Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.'/'.$mod.'/'.$namePict) ;
    }
    if(is_file(Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.'/'.$mod.'/big/'.$namePict)){
        unlink(Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.'/'.$mod.'/big/'.$namePict) ;
    }
}

$pictures = $mandate->listPictures();
$return='';

$count=0;
foreach($pictures as $pict){
//$return.=$pict->getName().' <br>';


    if($count==0){
        $return.='<div class="row">';
    }
    else{

      if ($count %4 == 0){
        $return.='</div><div class="row">';
        }
    }
    $return.=' <div class="col-md-3 text-center" >
               <p>
               <a href="'.Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY.'/'.$mod.'/big/'.$pict->getName().'" class="fancybox" rel="galery">';

    $return.='<img class="img-thumbnail img-responsive';
    if( $pict->getIsDefault())$return.=' bg-primary ';
    $return.='" src="'.Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY.'/'.$mod.'/thumb/'.$pict->getName().'" rel="'.$pict->getIdMandatePicture().'" alt="" /></a></p>';


    if( ($user->getLevelMember()->getIdLevelMember() < 3) OR ($user->getIdUser() == $mandate->getUser()->getIdUser())){
           $return.='<form class="" action="" method="post">
                                            <p>
                                                <input type="hidden" name="idMandate" value="'.$mandate->getIdMandate().'" />
                                                <input type="hidden" name="idPicture" value="'.$pict->getIdMandatePicture().'" />';
                if( !$pict->getIsDefault()){


                 $return.='<button data-idpicture="'.$pict->getIdMandatePicture().'" type="submit" class="btn btn-default" name="sendPictureByDefault">
                                <i class="fa fa-random"></i> Définir comme principale
                            </button>
                      <button type="submit" data-idpicture="'.$pict->getIdMandatePicture().'" class="btn btn-danger jsDelPictureMandate" name="delete_picture" title="Supprimer la photo">
                                <i class="fa fa-trash"></i>
                      </button>';

                }

                                                    else{


                                                        $return.=' <button type="submit" class="btn btn-default disabled">
                                                        <i class="fa fa-random"></i> Principale
                                                    </button>
                                                    <button type="submit" class="btn btn-danger disabled" title="Supprimer la photo">
                                                        <i class="fa fa-trash"></i>
                                                    </button>';
                                                }
        $return.='</p>
                                        </form>';
                                   }


    $return.='</div>';


$count++;
}
        $return.='</div>';
//print_r();
echo $return;

