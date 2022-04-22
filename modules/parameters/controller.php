<?php

class Controller extends CoreController {
    private $_smarty;
    private $_template ;
    private $_error_dependance;
    private $_user;
    private $_title;
    public function __construct( $smarty){
        parent::__construct();
        $this->_smarty = $smarty;
        $this->_error_dependance = false;
        // membre connecté
        if(!$this->include_model_required((String)dirname(__FILE__))){
            $this->_error_dependance = true;
            $this->_template = $this->getTplErrorLoadModule();
        }else{
            $this->_user = User::unserialize($this->_pdo,$_SESSION['user']);
            // autorisation necessaire pour cette action ? // reste le cas de la modification de sa propre fiche ...
            if($this->getLevelRequired($_GET['module'],$_GET['page'],$_GET['action']) < $this->_user->getLevelMember()->getIdLevelMember()){
                $this->_error_dependance = true;
                $this->_template = $this->getTplErrorViolationAccess();
                Log::create($this->_pdo,time(),"parameters",'accès non autorisé',$this->_user );
            } else{
                $this->_template = dirname(__FILE__).'/views/default.tpl';
                $this->_addMainMenu();
                $this->_addMenu('parameters');
                $this->_title = 'Gestion des parametres';
            }
        }
    }
    public function addMeta(){
        $this->_smarty->assign('title',	$this->_title );
    }
    private function _treatment( $post,$get){
        if(empty($get['page']))$get['page']='home';
//        $error =array();
        switch($get['page']){
            case 'listParametersMandate':
                $this->listParametersMandate();
                break;
            case 'list_bornage_terrain':
                $this->list_bornage_terrain();
                break;
            case 'upd_bornage_terrain':
                $this->upd_bornage_terrain();
                break;
            case 'add_bornage_terrain':
                $this->add_bornage_terrain();
                break;
            case 'list_orientation':
                $this->list_orientation();
                break;
            case 'upd_orientation':
                $this->upd_orientation($post,$get);
                break;
            case 'add_orientation':
                $this->add_orientation($post,$get);
                break;
            case 'list_slope':
                $this->list_slope($post,$get);
                break;
            case 'add_slope':
                $this->add_slope($post,$get);
                break;
            case 'upd_slope':
                $this->upd_slope($post,$get);
                break;
            case 'list_plu':
                $this->list_plu($post,$get);
                break;
            case 'add_plu':
                $this->add_plu($post,$get);
                break;
            case 'upd_plu':
                $this->upd_plu($post,$get);
                break;
            case 'list_rnu':
                $this->list_rnu($post,$get);
                break;
            case 'add_rnu':
                $this->add_rnu($post,$get);
                break;
            case 'upd_rnu':
                $this->upd_rnu($post,$get);
                break;
            case 'list_geometer':
                $this->list_geometer($post,$get);
                break;
            case 'add_geometer':
                $this->add_geometer($post,$get);
                break;
            case 'upd_geometer':
                $this->upd_geometer($post,$get);
                break;
            case 'list_water_corresponding':
                $this->list_water_corresponding($post,$get);
                break;
            case 'add_water_corresponding':
                $this->add_water_corresponding($post,$get);
                break;
            case 'upd_water_corresponding':
                $this->upd_water_corresponding($post,$get);
                break;
            case 'list_electric_corresponding':
                $this->list_electric_corresponding($post,$get);
                break;
            case 'add_electric_corresponding':
                $this->add_electric_corresponding($post,$get);
                break;
            case 'upd_electric_corresponding':
                $this->upd_electric_corresponding($post,$get);
                break;
            case 'list_gaz_corresponding':
                $this->list_gaz_corresponding($post,$get);
                break;
            case 'add_gaz_corresponding':
                $this->add_gaz_corresponding($post,$get);
                break;
            case 'upd_gaz_corresponding':
                $this->upd_gaz_corresponding($post,$get);
                break;
            case 'list_sanitation_corresponding':
                $this->list_sanitation_corresponding($post,$get);
                break;
            case 'add_sanitation_corresponding':
                $this->add_sanitation_corresponding($post,$get);
                break;
            case 'upd_sanitation_corresponding':
                $this->upd_sanitation_corresponding($post,$get);
                break;
            case 'list_cos':
                $this->list_cos($post,$get);
                break;
            case 'add_cos':
                $this->add_cos($post,$get);
                break;
            case 'upd_cos':
                $this->upd_cos($post,$get);
                break;
            case 'list_insulation':
                $this->list_insulation($post,$get);
                break;
            case 'add_insulation':
                $this->add_insulation($post,$get);
                break;
            case 'upd_insulation':
                $this->upd_insulation($post,$get);
                break;
            case 'list_roof':
                $this->list_roof($post,$get);
                break;
            case 'add_roof':
                $this->add_roof($post,$get);
                break;
            case 'upd_roof':
                $this->upd_roof($post,$get);
                break;
            case 'list_heating':
                $this->list_heating($post,$get);
                break;
            case 'add_heating':
                $this->add_heating($post,$get);
                break;
            case 'upd_heating':
                $this->upd_heating($post,$get);
                break;
            case 'list_commonOwnership':
                $this->list_commonOwnership($post,$get);
                break;
            case 'add_commonOwnership':
                $this->add_commonOwnership($post,$get);
                break;
            case 'upd_commonOwnership':
                $this->upd_commonOwnership($post,$get);
                break;
            case 'list_constructionType':
                $this->list_constructionType($post,$get);
                break;
            case 'add_constructionType':
                $this->add_constructionType($post,$get);
                break;
            case 'upd_constructionType':
                $this->upd_constructionType($post,$get);
                break;
            case 'list_style':
                $this->list_style($post,$get);
                break;
            case 'add_style':
                $this->add_style($post,$get);
                break;
            case 'upd_style':
                $this->upd_style($post,$get);
                break;
            case 'list_news':
                $this->list_news($post,$get);
                break;
            case 'add_news':
                $this->add_news($post,$get);
                break;
            case 'upd_news':
                $this->upd_news($post,$get);
                break;
            case 'list_condition':
                $this->list_condition($post,$get);
                break;
            case 'add_condition':
                $this->add_condition($post,$get);
                break;
            case 'upd_condition':
                $this->upd_condition($post,$get);
                break;
            case 'list_nature':
                $this->list_nature($post,$get);
                break;
            case 'add_nature':
                $this->add_nature($post,$get);
                break;
            case 'upd_nature':
                $this->upd_nature($post,$get);
                break;
            case 'listParametersGeographic':
                $this->listParametersGeographic();
                break;
            case 'list_sectors':
                $this->list_sectors($post,$get);
                break;
            case 'add_sector':
                $this->add_sector($post,$get);
             break;
            case 'upd_sector':
                $this->upd_sector($post,$get);
             break;
            case 'list_cities':
                $this->list_cities($post,$get);
             break;
            case 'add_city':
                $this->add_city($post,$get);
             break;
            case 'upd_city':
                $this->upd_city($post,$get);
             break;

            case 'home':
            default:
                $this->home();
                break;
        }



    }
    private function home(){
        /*        $data = parse_ini_file(  Constant::DEFAULT_DIRECTORY.'/const/confgenerated.php');
                echo '<pre>';
                var_dump($data);
                echo '</pre>';*/
        $this->_title = 'Paramètres d\'Immo-manageur';
        $this->_template = dirname(__FILE__).'/views/update.tpl';
        $error=array();
        if(!isset($_POST['send'])){
            $identifiant_opm =Constant::ID_OPEN_MAIl;
            $password_opm=Constant::PASSWORD_OPEN_MAIL;
            $id_app_fb=Constant::APP_ID_FACEBOOK;
            $id_secret_fb=Constant::APP_SECRET_FACEBOOK;
            $N_DAYS_BEFORE_WARRANT_EXPIRE_ALERT_1 = Constant::N_DAYS_BEFORE_WARRANT_EXPIRE_ALERT_1;
            $N_DAYS_AFTER_WARRANT_CREATION_ALERT_1 = Constant::N_DAYS_AFTER_WARRANT_CREATION_ALERT_1;
            $N_DAYS_AFTER_WARRANT_CREATION_ALERT_2 = Constant::N_DAYS_AFTER_WARRANT_CREATION_ALERT_2;
        }else{
            $identifiant_opm =$_POST['identifiant_opm'];
            $password_opm=$_POST['password_opm'];
            $filename = Constant::DEFAULT_DIRECTORY.'/const/confgenerated.php';
            $id_app_fb=$_POST['id_app_fb'];
            $id_secret_fb=$_POST['id_secret_fb'];
            $N_DAYS_BEFORE_WARRANT_EXPIRE_ALERT_1 = $_POST['N_DAYS_BEFORE_WARRANT_EXPIRE_ALERT_1'];
            $N_DAYS_AFTER_WARRANT_CREATION_ALERT_1 = $_POST['N_DAYS_AFTER_WARRANT_CREATION_ALERT_1'];
            $N_DAYS_AFTER_WARRANT_CREATION_ALERT_2 = $_POST['N_DAYS_AFTER_WARRANT_CREATION_ALERT_2'];

            if(empty($error)){
                // Generate file : const/confgenerated.php.
                $handle = fopen($filename,'r');
                $newConfGenerated='';
                if ($handle) {
                    while (($buffer = fgets($handle, 4096)) !== false) {

                        switch($buffer){
                            case (substr(trim($buffer),0,20)=='const ID_OPEN_MAIl="'):
                                $newConfGenerated.="\t".'const ID_OPEN_MAIl="'.$identifiant_opm.'";'."\n";
                                break;
                            case (substr(trim($buffer),0,26)=='const PASSWORD_OPEN_MAIL="'):
                                $newConfGenerated.="\t".'const PASSWORD_OPEN_MAIL="'.$password_opm.'";'."\n";
                                break;
                            case (substr(trim($buffer),0,23)=='const APP_ID_FACEBOOK="'):
                                $newConfGenerated.="\t".'const APP_ID_FACEBOOK="'.$id_app_fb.'";'."\n";
                                break;

                            case (substr(trim($buffer),0,27)=='const APP_SECRET_FACEBOOK="'):
                                $newConfGenerated.="\t".'const APP_SECRET_FACEBOOK="'.$id_secret_fb.'";'."\n";
                                break;

                            case (substr(trim($buffer),0,44)=='const N_DAYS_AFTER_WARRANT_CREATION_ALERT_1='):
                                $newConfGenerated.="\t".'const N_DAYS_AFTER_WARRANT_CREATION_ALERT_1='.$N_DAYS_AFTER_WARRANT_CREATION_ALERT_1.';'."\n";
                                break;

                            case (substr(trim($buffer),0,44)=='const N_DAYS_AFTER_WARRANT_CREATION_ALERT_2='):
                                $newConfGenerated.="\t".'const N_DAYS_AFTER_WARRANT_CREATION_ALERT_2='.$N_DAYS_AFTER_WARRANT_CREATION_ALERT_2.';'."\n";
                                break;


                            case (substr(trim($buffer),0,43)=='const N_DAYS_BEFORE_WARRANT_EXPIRE_ALERT_1='):
                                $newConfGenerated.="\t".'const N_DAYS_BEFORE_WARRANT_EXPIRE_ALERT_1='.$N_DAYS_BEFORE_WARRANT_EXPIRE_ALERT_1.';'."\n";
                                break;
                            /*
                                                            const N_DAYS_BEFORE_WARRANT_EXPIRE_ALERT_1=15;
                                                            // Nbre de jours apres la creation du mandat
                                                            const N_DAYS_AFTER_WARRANT_CREATION_ALERT_1=75;
                                                            const N_DAYS_AFTER_WARRANT_CREATION_ALERT_2=90;
                              */

                            default:
                                $newConfGenerated.=$buffer;
                                break;
                        }



                    }
                    if (!feof($handle)) {
                        echo "Erreur: fgets() a échoué\n";
                    }
                    fclose($handle);
                }
                $handle = fopen($filename,"w");
                fputs($handle,$newConfGenerated);
                fclose($handle);
                // echo '<pre>'.$newConfGenerated.'</pre>';



            }
        }
        $this->_smarty->assign('identifiant_opm',$identifiant_opm);
        $this->_smarty->assign('password_opm',$password_opm);
        $this->_smarty->assign('id_app_fb',$id_app_fb);
        $this->_smarty->assign('id_secret_fb',$id_secret_fb);
        $this->_smarty->assign('N_DAYS_BEFORE_WARRANT_EXPIRE_ALERT_1',$N_DAYS_BEFORE_WARRANT_EXPIRE_ALERT_1);
        $this->_smarty->assign('N_DAYS_AFTER_WARRANT_CREATION_ALERT_1',$N_DAYS_AFTER_WARRANT_CREATION_ALERT_1);
        $this->_smarty->assign('N_DAYS_AFTER_WARRANT_CREATION_ALERT_2',$N_DAYS_AFTER_WARRANT_CREATION_ALERT_2);
    }

    private function listParametersMandate(){
        $this->_title = 'Paramètres mandats et terrains';
        $this->_template = dirname(__FILE__).'/views/listParametersMandateAndTerrain.tpl';
        $error=array();

    }
    public function treatment( $post,$get){
        $this->_smarty->assign('user',$this->_user );
        if(!$this->_error_dependance){
            $this->_treatment( $post,$get);
            // inclusion des modules enfants
            $this->include_modules_Children((String)dirname(__FILE__),$this->_smarty);
        }
    }
    /* *******************************
     * Geographique
     **********************************/
    private function listParametersGeographic(){
        $this->_title = 'Paramètres villes et secteurs';
        $this->_template = dirname(__FILE__).'/views/listParametersGeographic.tpl';
    }

    /* ******************************************
     *  Mandats et terrains
     **********************************************/
    /*
     *  Listes
     */
    private function list_cities($post,$get){
        $this->_title = 'Liste des villes';
        $this->_template =  dirname(__FILE__).'/views/list_cities.tpl';
        $tmp = City::loadAll($this->_pdo);
        $listCity = array();
        foreach($tmp as $item){
            $t['id'] = $item->getIdCity();
            $t['name'] = $item->getName();
            $t['zipCode'] = $item->getZipCode();
            $t['sector'] = $item->getSector()->getName();
            $t['urlUpdate'] = Tools::create_url($this->_user,$get['module'],'upd_city',$item->getIdCity());
            #$t['urlDelete'] = Tools::create_url($this->_user,$get['module'],'deletev',$item->getIdCity());
            $t['urlDelete'] = '#';
            $listCity[]=$t;
        }
        $this->_smarty->assign('listCity',$listCity);
    }
    private function list_sectors($post,$get){
        $this->_title = 'Liste des secteurs';
        $a = Sector::loadAll($this->_pdo);
        $list = array();
        foreach ($a as $item){
            $tmp['id']=$item->getIdSector();
            $tmp['name']=$item->getName();
            $tmp['urlUpdate'] = Tools::create_url($this->_user,$get['module'],'upd_sector',$item->getIdSector());
            $tmp['urlDelete'] = "#";
            array_push($list,$tmp);
        }
        $this->_smarty->assign('list',$list);
        $this->_template = dirname(__FILE__).'/views/list_sector.tpl';
    }
    private function list_bornage_terrain(){
        $this->_title = 'Liste des options de bornage terrain';
        $this->_smarty->assign('h1',$this->_title);
        $this->_template =dirname(__FILE__).'/views/list.tpl';
        $this->_smarty->assign('list',MandateBornageTerrain::loadAll($this->_pdo,1));
        $this->_smarty->assign('page','upd_bornage_terrain');
        $this->_smarty->assign('addOption','add_bornage_terrain');
    }
    private function list_orientation(){
        $this->_title = 'Liste des orientations';
        $this->_smarty->assign('h1',$this->_title);
        $this->_template =dirname(__FILE__).'/views/list.tpl';
        $this->_smarty->assign('list',MandateOrientation::loadAll($this->_pdo,1));
        $this->_smarty->assign('page','upd_orientation');
        $this->_smarty->assign('addOption','add_orientation');
    }
    private function list_slope($post,$get){
        $this->_title = 'Liste des options de pente';
        $this->_smarty->assign('h1',$this->_title);
        $this->_template =dirname(__FILE__).'/views/list.tpl';
        $this->_smarty->assign('list',MandateSlope::loadAll($this->_pdo,1));
        $this->_smarty->assign('page','upd_slope');
        $this->_smarty->assign('addOption','add_slope');
    }
    private function list_plu($post,$get){
        $this->_title = 'Liste des zonages PLU';
        $this->_smarty->assign('h1',$this->_title);
        $this->_template =dirname(__FILE__).'/views/list.tpl';
        $this->_smarty->assign('list',MandateZonagePLU::loadAll($this->_pdo,1));
        $this->_smarty->assign('page','upd_plu');
        $this->_smarty->assign('addOption','add_plu');
    }
    private function list_rnu($post,$get){
        $this->_title = 'Liste des options de zonage RNU';
        $this->_smarty->assign('h1',$this->_title);
        $this->_template =dirname(__FILE__).'/views/list.tpl';
        $this->_smarty->assign('list',MandateZonageRNU::loadAll($this->_pdo,1));
        $this->_smarty->assign('page','upd_rnu');
        $this->_smarty->assign('addOption','add_rnu');
    }
    private function list_geometer($post,$get){
        $this->_title = 'Liste des géometres';
        $this->_smarty->assign('h1',$this->_title);
        $this->_template =dirname(__FILE__).'/views/list.tpl';
        $this->_smarty->assign('list',MandateGeometer::loadAll($this->_pdo,1));
        $this->_smarty->assign('page','upd_geometer');
        $this->_smarty->assign('addOption','add_geometer');
    }
    private function list_water_corresponding($post,$get){
        $this->_title = 'Liste des correspondants eau';
        $this->_smarty->assign('h1',$this->_title);
        $this->_template =dirname(__FILE__).'/views/list.tpl';
        $this->_smarty->assign('list',MandateWaterCorresponding::loadAll($this->_pdo,1));
        $this->_smarty->assign('page','upd_water_corresponding');
        $this->_smarty->assign('addOption','add_water_corresponding');
    }
    private function list_electric_corresponding($post,$get){
        $this->_title = 'Liste des correspondants électricité';
        $this->_smarty->assign('h1',$this->_title);
        $this->_template =dirname(__FILE__).'/views/list.tpl';
        $this->_smarty->assign('list',MandateElectricCorresponding::loadAll($this->_pdo,1));
        $this->_smarty->assign('page','upd_electric_corresponding');
        $this->_smarty->assign('addOption','add_electric_corresponding');
    }
    private function list_gaz_corresponding($post,$get){
        $error=array();
        $this->_title = 'Liste des correspondants gaz';
        $this->_smarty->assign('h1',$this->_title);
        $this->_template =dirname(__FILE__).'/views/list.tpl';
        $this->_smarty->assign('list',MandateGazCorresponding::loadAll($this->_pdo,1));
        $this->_smarty->assign('page','upd_gaz_corresponding');
        $this->_smarty->assign('error',$error);
        $this->_smarty->assign('addOption','add_gaz_corresponding');
    }
    private function list_sanitation_corresponding($post,$get){
        $this->_title = 'Liste des correspondants assainissement';
        $this->_smarty->assign('h1',$this->_title);
        $this->_template =dirname(__FILE__).'/views/list.tpl';
        $this->_smarty->assign('list',MandateSanitationCorresponding::loadAll($this->_pdo,1));
        $this->_smarty->assign('page','upd_sanitation_corresponding');
        $this->_smarty->assign('addOption','add_sanitation_corresponding');
    }
    private function list_cos($post,$get){
        $this->_title = 'Liste des options COS';
        $this->_smarty->assign('h1',$this->_title);
        $this->_template =dirname(__FILE__).'/views/list.tpl';
        $this->_smarty->assign('list',MandateCos::loadAll($this->_pdo,1));
        $this->_smarty->assign('page','upd_cos');
        $this->_smarty->assign('addOption','add_cos');
    }
    private function list_insulation($post,$get){
        $this->_title = 'Liste des options d\'isolation';
        $this->_smarty->assign('h1',$this->_title);
        $this->_template =dirname(__FILE__).'/views/list.tpl';
        $this->_smarty->assign('list',MandateInsulation::loadAll($this->_pdo,1));
        $this->_smarty->assign('page','upd_insulation');
        $this->_smarty->assign('addOption','add_insulation');
    }
    private function list_roof($post,$get){
        $this->_title = 'Liste des options d\'de toiture';
        $this->_smarty->assign('h1',$this->_title);
        $this->_template =dirname(__FILE__).'/views/list.tpl';
        $this->_smarty->assign('list',MandateRoof::loadAll($this->_pdo,1));
        $this->_smarty->assign('page','upd_roof');
        $this->_smarty->assign('addOption','add_roof');
    }
    private function list_heating($post,$get){
        $this->_title = 'Liste des options de chauffage';
        $this->_smarty->assign('h1',$this->_title);
        $this->_template =dirname(__FILE__).'/views/list.tpl';
        $this->_smarty->assign('list',MandateHeating::loadAll($this->_pdo,1));
        $this->_smarty->assign('page','upd_heating');
        $this->_smarty->assign('addOption','add_heating');
    }
    private function list_commonOwnership($post,$get){
        $this->_title = 'Liste des options des parties communes';
        $this->_smarty->assign('h1',$this->_title);
        $this->_template =dirname(__FILE__).'/views/list.tpl';
        $this->_smarty->assign('list',MandateCommonOwnership::loadAll($this->_pdo,1));
        $this->_smarty->assign('page','upd_commonOwnership');;
        $this->_smarty->assign('addOption','add_commonOwnership');
    }
    private function list_constructionType($post,$get){
        $this->_title = 'Liste des options du type de construction';
        $this->_smarty->assign('h1',$this->_title);
        $this->_template =dirname(__FILE__).'/views/list.tpl';
        $this->_smarty->assign('list',MandateConstructionType::loadAll($this->_pdo,1));
        $this->_smarty->assign('page','upd_constructionType');
        $this->_smarty->assign('addOption','add_constructionType');
    }
    private function list_style($post,$get){
        $this->_title = 'Liste des options du style';
        $this->_smarty->assign('h1',$this->_title);
        $this->_template =dirname(__FILE__).'/views/list.tpl';
        $this->_smarty->assign('list',MandateStyle::loadAll($this->_pdo,1));
        $this->_smarty->assign('page','upd_style');
        $this->_smarty->assign('addOption','add_style');

    }
    private function list_news($post,$get){
        $this->_title = 'Liste des options de nouveauté';
        $this->_smarty->assign('h1',$this->_title);
        $this->_template =dirname(__FILE__).'/views/list.tpl';
        $this->_smarty->assign('list',MandateNews::loadAll($this->_pdo,1));
        $this->_smarty->assign('page','upd_news');
        $this->_smarty->assign('addOption','add_news');
    }
    private function list_condition($post,$get){
        $this->_title = 'Liste des options de condition';
        $this->_smarty->assign('h1',$this->_title);
        $this->_template =dirname(__FILE__).'/views/list.tpl';
        $this->_smarty->assign('list',MandateCondition::loadAll($this->_pdo,1));
        $this->_smarty->assign('page','upd_condition');
        $this->_smarty->assign('addOption','add_condition');
    }
    private function list_nature($post,$get){
        $this->_title = 'Liste des options de nature';
        $this->_smarty->assign('h1',$this->_title);
        $this->_template =dirname(__FILE__).'/views/list.tpl';
        $this->_smarty->assign('list',MandateNature::loadAll($this->_pdo,1));
        $this->_smarty->assign('page','upd_nature');
        $this->_smarty->assign('addOption','add_nature');
    }

    /*
     * Fin des listes
     */

    /*
     * UPD
     */
    private function upd_city($post,$get){
        $error=array();
        $this->_title = 'Mise à jour de la ville';

        //			$cityToBeUpdated = City::load($this->_pdo,$get['action']);
        $this->_smarty->assign('listOfSector', Sector::loadAll($this->_pdo));
        //			$this->_smarty->assign('city',$cityToBeUpdated);
        $city = City::load($this->_pdo,$get['action']);
        if($city!=null){
            $this->_template =  dirname(__FILE__).'/views/update_city.tpl';
            if(empty($post)){
                $this->_smarty->assign('oldCity',$city->getName());
                $this->_smarty->assign('city_name',$city->getName());
                $this->_smarty->assign('id_city',$city->getIdCity());
                $this->_smarty->assign('zipCode',$city->getZipCode());
                $this->_smarty->assign('idSector',$city->getSector()->getIdSector());
            }else{
                $this->_smarty->assign('oldCity',$post['oldCity']);
                $this->_smarty->assign('city_name',$post['city_name']);
                $this->_smarty->assign('id_city',$post['id_city']);
                $this->_smarty->assign('zipCode',$post['zipCode']);
                $this->_smarty->assign('idSector',$post['idSector']);
            }

            if(isset($post['send_city'])){
                $error = array();
                if(empty($post['zipCode'])||$post['zipCode']=='')
                    $error[]=Lang::ERROR_CITY_ADD_EMPTY_ZIPCODE;
                if(empty($post['city_name'])||$post['city_name']=='')
                    $error[]=Lang::ERROR_CITY_ADD_EMPTY_CITY;
                elseif($post['oldCity']!=$post['city_name']){

                    if(City::count($this->_pdo,' name = '."'".htmlspecialchars(addslashes(strtoupper($post['city_name'])))."'" )!=0&&strtoupper($post['oldCity'])!=strtoupper($post['city_name'])){
                        $error[]=Lang::ERROR_CITY_ADD_CITY_IS_IN_DB;
                    }
                }
                if(!$error){
                    //						var_dump($city);
                    $oldSector = $city->getSector();
                    // UPD + SORTIR UNE UTIISATION DE SECTEUR, ET AJOUTER LA NOUVELLE !
                    $newSector = Sector::load($this->_pdo,$post['idSector']);

                    $city->setName($post['city_name'],false);
                    $city->setZipCode($post['zipCode'],false);
                    $city->setSector($newSector,false);
                    $city->update();

                    $oldSector->setNumberUsed( $oldSector->getNumberUsed()-1,true );
                    $newSector->setNumberUsed($newSector->getNumberUsed()+1,true);

                    Log::create($this->_pdo,time(),"parameters",' modification de la ville : '.$city->getName(),$this->_user);
                    header('location:'.Tools::create_url($this->_user,$get['module'],'list_cities'));
                }
            }

            if(isset($post['city_cancel'])){		header('location:'.$this->create_url($this->_user,$get['module'],'list_cities'));}
        }else{
            $this->_template = $this->getTplErrorViolationAccess();
            Log::create($this->_pdo,time(),"parameters",' tentative de modification d\'un secteur ,\'éxistant pas ou plus.',$this->_user);
        }


        $this->_smarty->assign('error',$error);
    }
    private function upd_sector($post,$get){
        $error='';
        $this->_title = 'Mise à jour du secteur';
        $sectorToBeUpdated  = Sector::load($this->_pdo,$get['action']);
        if($sectorToBeUpdated!=null){
            $this->_template = dirname(__FILE__).'/views/update_sector.tpl';
            if(empty($post)){
                $sector = Sector::load($this->_pdo,$get['action']);
                $this->_smarty->assign('oldSector',$sector->getName());
                $this->_smarty->assign('sector_name',$sector->getName());
                $this->_smarty->assign('id_sector',$sector->getIdSector());
            }else{
                $this->_smarty->assign('oldSector',$post['oldSector']);
                $this->_smarty->assign('sector_name',$post['sector_name']);
                $this->_smarty->assign('id_sector',$post['id_sector']);
            }
            if(isset($post['send_sector'])){
                if (empty($post['sector_name'])||trim($post['sector_name'])=='')
                    $error = Lang::ERROR_EMPTY_SECTOR_NAME;
                if(!$error){
                    $sector = Sector::load($this->_pdo,$post['id_sector']);
                    // maj
                    $sector->setName($post['sector_name'],true);
                    Log::create($this->_pdo,time(),"parameters",' modification du secteur : '.$sector->getName(),$this->_user);
                    header('location:'.Tools::create_url($this->_user,$get['module'],'list_sectors'));
                }
            }

            if(isset($post['sector_cancel'])){		header('location:'.Tools::create_url($this->_user,$get['module'],'list_sectors'));}
        }else{
            $this->_template = $this->getTplErrorViolationAccess();
            Log::create($this->_pdo,time(),"parameters",' tentative de modification d\'un secteur n\'éxistant pas ou plus.',$this->_user);
        }
        $this->_smarty->assign('error',$error);
    }
    private function upd_bornage_terrain(){
        $error=array();
        $this->_title = 'Mise à jour de l\'option de bornage terrain';
        $this->_smarty->assign('h1',$this->_title);
        $this->_template =dirname(__FILE__).'/views/add_update.tpl';
        $this->_smarty->assign('h1',$this->_title);
        $this->_smarty->assign('labelName','Nom ');
        $this->_smarty->assign('labelCode','Code ');
        $opt = MandateBornageTerrain::load($this->_pdo,$_GET['action']);
        if(empty($_POST)){
            $oldName = $name = $opt->getName();
            $oldCode = $code = $opt->getCode();
            $idOpt = $opt->getId();
            $isDisabled = $opt->getIsDisabled()?0:1;
        }else{
            $oldName = htmlspecialchars($_POST['oldName']);
            $name = htmlspecialchars($_POST['name']);
            $oldCode =htmlspecialchars($_POST['oldCode']);
            $code = htmlspecialchars($_POST['code']);
            $idOpt = htmlspecialchars($_POST['idOpt']);
            $isDisabled=htmlspecialchars($_POST['isDisabled']);
        }
        if(isset($_POST['valider'])){
            if($_POST['name']=='')$error[]="Le champ nom doit être renseigné.";
            if($_POST['code']=='')$error[]="Le champ code doit être renseigné.";
            // Code et nom existe deja ...
            if( strtoupper($oldName) != strtoupper($name) )
                if(MandateBornageTerrain::countByName($this->_pdo,$_POST['name'])>0)$error[]="Ce nom est déjà présent dans la base de données.";
            //if( strtoupper($oldCode) != strtoupper($code) )
            //if(MandateBornageTerrain::countByCode($this->_pdo,$post['code'])>0)$error[]="Ce code est déjà présent dans la base de données.";
            if(empty($error)){
                $opt->setName($name,false);
                $opt->setCode($code,false);
                $opt->setIsDisabled($isDisabled?0:1,false);
                $opt->update();
                Log::create($this->_pdo,time(),'parameters','Mise à jour du bornage terrain : '.$opt->getName(),$this->_user);
                header('location:'.Tools::create_url($this->_user,$_GET['module'],'list_bornage_terrain'));
            }
        }
        $this->_smarty->assign('name',$name);
        $this->_smarty->assign('isDisabled',$isDisabled);
        $this->_smarty->assign('code',$code);
        $this->_smarty->assign('oldName',$oldName);
        $this->_smarty->assign('oldCode',$oldCode);
        $this->_smarty->assign('idOpt',$idOpt);
        $this->_smarty->assign('error',$error);

    }
    private function upd_orientation($post,$get){
        $error=array();
        $this->_title = 'Mise à jour de l\'option d\'orientation terrain';
        $this->_smarty->assign('h1',$this->_title);
        $this->_template =dirname(__FILE__).'/views/add_update.tpl';
        $this->_smarty->assign('h1',$this->_title);
        $this->_smarty->assign('labelName','Nom ');
        $this->_smarty->assign('labelCode','Code ');
        $opt = MandateOrientation::load($this->_pdo,$get['action']);
        if(empty($post)){
            $oldName = $name = $opt->getName();
            $oldCode = $code = $opt->getCode();
            $idOpt = $opt->getId();
            $isDisabled = $opt->getIsDisabled()?0:1;
        }else{
            $oldName = htmlspecialchars($post['oldName']);
            $name = htmlspecialchars($post['name']);
            $oldCode =htmlspecialchars($post['oldCode']);
            $code = htmlspecialchars($post['code']);
            $idOpt = htmlspecialchars($post['idOpt']);
            $isDisabled=htmlspecialchars($post['isDisabled']);
        }
        if(isset($post['valider'])){
            if($post['name']=='')$error[]="Le champ nom doit être renseigné.";
            if($post['code']=='')$error[]="Le champ code doit être renseigné.";
            // Code et nom existe deja ...
            if( strtoupper($oldName) != strtoupper($name) )
                if(MandateOrientation::countByName($this->_pdo,$post['name'])>0)$error[]="Ce nom est déjà présent dans la base de données.";
            //	if( strtoupper($oldCode) != strtoupper($code) )
            //if(MandateOrientation::countByCode($this->_pdo,$post['code'])>0)$error[]="Ce code est déjà présent dans la base de données.";
            if(empty($error)){
                $opt->setName($name,false);
                $opt->setCode($code,false);
                $opt->setIsDisabled($isDisabled?0:1,false);
                $opt->update();
                Log::create($this->_pdo,time(),'parameters','Mise à jour de l\'orientation terrain : '.$opt->getName(),$this->_user);
                header('location:'.Tools::create_url($this->_user,$get['module'],'list_orientation'));
            }
        }
        $this->_smarty->assign('name',$name);
        $this->_smarty->assign('isDisabled',$isDisabled);
        $this->_smarty->assign('code',$code);
        $this->_smarty->assign('oldName',$oldName);
        $this->_smarty->assign('oldCode',$oldCode);
        $this->_smarty->assign('idOpt',$idOpt);
        $this->_smarty->assign('error',$error);
    }
    private function upd_slope($post,$get){
        $error=array();
        $this->_title = 'Mise à jour de l\'option de pente';
        $this->_smarty->assign('h1',$this->_title);
        $this->_template =dirname(__FILE__).'/views/add_update.tpl';
        $this->_smarty->assign('h1',$this->_title);
        $this->_smarty->assign('labelName','Nom ');
        $this->_smarty->assign('labelCode','Code ');
        $opt = MandateSlope::load($this->_pdo,$get['action']);
        if(empty($post)){
            $oldName = $name = $opt->getName();
            $oldCode = $code = $opt->getCode();
            $idOpt = $opt->getId();
            $isDisabled = $opt->getIsDisabled()?0:1;
        }else{
            $oldName = $post['oldName'];
            $name = $post['name'];
            $oldCode =$post['oldCode'];
            $code = $post['code'];
            $idOpt = $post['idOpt'];
            $isDisabled = $post['isDisabled'];
        }
        if(isset($post['valider'])){
            if($post['name']=='')$error[]="Le champ nom doit être renseigné.";
            if($post['code']=='')$error[]="Le champ code doit être renseigné.";
            // Code et nom existe deja ...
            if( strtoupper($oldName) != strtoupper($name) )
                if(MandateSlope::countByName($this->_pdo,$post['name'])>0)$error[]="Ce nom est déjà présent dans la base de données.";
            //	if( strtoupper($oldCode) != strtoupper($code) )
            //if(MandateSlope::countByCode($this->_pdo,$post['code'])>0)$error[]="Ce code est déjà présent dans la base de données.";
            if(empty($error)){
                $isDisabled = $post['isDisabled']?0:1;
                $opt->setName($name,false);
                $opt->setCode($code,false);
                $opt->setIsDisabled($isDisabled,false);
                $opt->update();
                Log::create($this->_pdo,time(),'parameters','Mise à jour de la pente : '.$opt->getName(),$this->_user);
                header('location:'.Tools::create_url($this->_user,$get['module'],'list_slope'));
            }
        }
        $this->_smarty->assign('name',$name);
        $this->_smarty->assign('code',$code);
        $this->_smarty->assign('oldName',$oldName);
        $this->_smarty->assign('oldCode',$oldCode);
        $this->_smarty->assign('idOpt',$idOpt);
        $this->_smarty->assign('isDisabled',$isDisabled);
        $this->_smarty->assign('error',$error);
    }
    private function upd_plu($post,$get){
        $error=array();
        $this->_title = 'Mise à jour de l\'option de zonage PLU';
        $this->_smarty->assign('h1',$this->_title);
        $this->_template =dirname(__FILE__).'/views/add_update.tpl';
        $this->_smarty->assign('h1',$this->_title);
        $this->_smarty->assign('labelName','Nom ');
        $this->_smarty->assign('labelCode','Code ');
        $opt = MandateZonagePLU::load($this->_pdo,$get['action']);
        if(empty($post)){
            $oldName = $name = $opt->getName();
            $oldCode = $code = $opt->getCode();
            $idOpt = $opt->getId();
            $isDisabled = $opt->getIsDisabled()?0:1;
        }else{
            $oldName = htmlspecialchars($post['oldName']);
            $name = htmlspecialchars($post['name']);
            $oldCode =htmlspecialchars($post['oldCode']);
            $code = htmlspecialchars($post['code']);
            $idOpt = htmlspecialchars($post['idOpt']);
            $isDisabled = htmlspecialchars($post['isDisabled']);
        }
        if(isset($post['valider'])){
            if($post['name']=='')$error[]="Le champ nom doit être renseigné.";
            if($post['code']=='')$error[]="Le champ code doit être renseigné.";
            // Code et nom existe deja ...
            if( strtoupper($oldName) != strtoupper($name) )
                if(MandateZonagePLU::countByName($this->_pdo,$post['name'])>0)$error[]="Ce nom est déjà présent dans la base de données.";
            //	if( strtoupper($oldCode) != strtoupper($code) )
            //if(MandateZonagePLU::countByCode($this->_pdo,$post['code'])>0)$error[]="Ce code est déjà présent dans la base de données.";
            if(empty($error)){
                $isDisabled=$post['isDisabled']?0:1;
                $opt->setName($name,false);
                $opt->setCode($code,false);
                $opt->setIsDisabled($isDisabled,false);
                $opt->update();
                Log::create($this->_pdo,time(),'parameters','Mise à jour du zonage PLU  : '.$opt->getName(),$this->_user);
                header('location:'.Tools::create_url($this->_user,$get['module'],'list_plu'));
            }
        }
        $this->_smarty->assign('name',$name);
        $this->_smarty->assign('code',$code);
        $this->_smarty->assign('oldName',$oldName);
        $this->_smarty->assign('oldCode',$oldCode);
        $this->_smarty->assign('idOpt',$idOpt);
        $this->_smarty->assign('isDisabled',$isDisabled);
        $this->_smarty->assign('error',$error);
    }
    private function upd_rnu($post,$get){
        $error='';
        $this->_title = 'Mise à jour de l\'option de zonage RNU';
        $this->_smarty->assign('h1',$this->_title);
        $this->_template =dirname(__FILE__).'/views/add_update.tpl';
        $this->_smarty->assign('h1',$this->_title);
        $this->_smarty->assign('labelName','Nom ');
        $this->_smarty->assign('labelCode','Code ');
        $opt = MandateZonageRNU::load($this->_pdo,$get['action']);
        if(empty($post)){
            $oldName = $name = $opt->getName();
            $oldCode = $code = $opt->getCode();
            $idOpt = $opt->getId();
            $isDisabled=$opt->getIsDisabled()?0:1;
        }else{
            $oldName = htmlspecialchars($post['oldName']);
            $name = htmlspecialchars($post['name']);
            $oldCode =htmlspecialchars($post['oldCode']);
            $code = htmlspecialchars($post['code']);
            $idOpt = htmlspecialchars($post['idOpt']);
            $isDisabled = htmlspecialchars($post['isDisabled']);
        }
        if(isset($post['valider'])){
            if($post['name']=='')$error[]="Le champ nom doit être renseigné.";
            if($post['code']=='')$error[]="Le champ code doit être renseigné.";
            // Code et nom existe deja ...
            if( strtoupper($oldName) != strtoupper($name) )
                if(MandateZonageRNU::countByName($this->_pdo,$post['name'])>0)$error[]="Ce nom est déjà présent dans la base de données.";
            //if( strtoupper($oldCode) != strtoupper($code) )
            //if(MandateZonageRNU::countByCode($this->_pdo,$post['code'])>0)$error[]="Ce code est déjà présent dans la base de données.";
            if(empty($error)){
                $isDisabled=$post['isDisabled']?0:1;
                $opt->setName($name,false);
                $opt->setCode($code,false);
                $opt->setIsDisabled($isDisabled,false);
                $opt->update();
                Log::create($this->_pdo,time(),'parameters','Mise à jour du zonage RNU  : '.$opt->getName(),$this->_user);
                header('location:'.Tools::create_url($this->_user,$get['module'],'list_rnu'));
            }
        }
        $this->_smarty->assign('name',$name);
        $this->_smarty->assign('code',$code);
        $this->_smarty->assign('oldName',$oldName);
        $this->_smarty->assign('oldCode',$oldCode);
        $this->_smarty->assign('idOpt',$idOpt);
        $this->_smarty->assign('isDisabled',$isDisabled);
        $this->_smarty->assign('error',$error);
    }
    private function upd_geometer($post,$get){
        $error=array();
        $this->_title = 'Mise à jour du géometre';
        $this->_smarty->assign('h1',$this->_title);
        $this->_template =dirname(__FILE__).'/views/add_update.tpl';
        $this->_smarty->assign('h1',$this->_title);
        $this->_smarty->assign('labelName','Nom ');
        $this->_smarty->assign('labelCode','Code ');
        $opt = MandateGeometer::load($this->_pdo,$get['action']);
        if(empty($post)){
            $oldName = $name = $opt->getName();
            $oldCode = $code = $opt->getCode();
            $idOpt = $opt->getId();
            $isDisabled=$opt->getIsDisabled()?0:1;
        }else{
            $oldName = htmlspecialchars($post['oldName']);
            $name = htmlspecialchars($post['name']);
            $oldCode =htmlspecialchars($post['oldCode']);
            $code = htmlspecialchars($post['code']);
            $idOpt = htmlspecialchars($post['idOpt']);
            $isDisabled = htmlspecialchars($post['isDisabled']);
        }
        if(isset($post['valider'])){
            if($post['name']=='')$error[]="Le champ nom doit être renseigné.";
            if($post['code']=='')$error[]="Le champ code doit être renseigné.";
            // Code et nom existe deja ...
            if( strtoupper($oldName) != strtoupper($name) )
                if(MandateGeometer::countByName($this->_pdo,$post['name'])>0)$error[]="Ce nom est déjà présent dans la base de données.";
            //if( strtoupper($oldCode) != strtoupper($code) )
            //if(MandateGeometer::countByCode($this->_pdo,$post['code'])>0)$error[]="Ce code est déjà présent dans la base de données.";
            if(empty($error)){
                $isDisabled=$post['isDisabled']?0:1;
                $opt->setName($name,false);
                $opt->setCode($code,false);
                $opt->setIsDisabled($isDisabled,false);
                $opt->update();
                Log::create($this->_pdo,time(),'parameters','Mise à jour du géometre  : '.$opt->getName(),$this->_user);
                header('location:'.Tools::create_url($this->_user,$get['module'],'list_geometer'));
            }
        }
        $this->_smarty->assign('name',$name);
        $this->_smarty->assign('code',$code);
        $this->_smarty->assign('oldName',$oldName);
        $this->_smarty->assign('oldCode',$oldCode);
        $this->_smarty->assign('idOpt',$idOpt);
        $this->_smarty->assign('isDisabled',$isDisabled);
        $this->_smarty->assign('error',$error);
    }
    private function upd_water_corresponding($post,$get){
        $error=array();
        $this->_title = 'Mise à jour du correspondant eau';
        $this->_smarty->assign('h1',$this->_title);
        $this->_template =dirname(__FILE__).'/views/add_update.tpl';
        $this->_smarty->assign('h1',$this->_title);
        $this->_smarty->assign('labelName','Nom ');
        $this->_smarty->assign('labelCode','Code ');
        $opt = MandateWaterCorresponding::load($this->_pdo,$get['action']);
        if(empty($post)){
            $oldName = $name = $opt->getName();
            $oldCode = $code = $opt->getCode();
            $idOpt = $opt->getId();
            ;$isDisabled=$opt->getIsDisabled()?0:1;
        }else{
            $oldName = htmlspecialchars($post['oldName']);
            $name = htmlspecialchars($post['name']);
            $oldCode =htmlspecialchars($post['oldCode']);
            $code = htmlspecialchars($post['code']);
            $idOpt = htmlspecialchars($post['idOpt']);
            $isDisabled = htmlspecialchars($post['isDisabled']);
        }
        if(isset($post['valider'])){
            if($post['name']=='')$error[]="Le champ nom doit être renseigné.";
            if($post['code']=='')$error[]="Le champ code doit être renseigné.";
            // Code et nom existe deja ...
            if( strtoupper($oldName) != strtoupper($name) )
                if(MandateWaterCorresponding::countByName($this->_pdo,$post['name'])>0)$error[]="Ce nom est déjà présent dans la base de données.";
            //if( strtoupper($oldCode) != strtoupper($code) )
            //if(MandateWaterCorresponding::countByCode($this->_pdo,$post['code'])>0)$error[]="Ce code est déjà présent dans la base de données.";
            if(empty($error)){
                $isDisabled=$post['isDisabled']?0:1;
                $opt->setName($name,false);
                $opt->setCode($code,false);
                $opt->setIsDisabled($isDisabled,false);
                $opt->update();
                Log::create($this->_pdo,time(),'parameters','Mise à jour du correspondant eau  : '.$opt->getName(),$this->_user);
                header('location:'.Tools::create_url($this->_user,$get['module'],'list_water_corresponding'));
            }
        }
        $this->_smarty->assign('name',$name);
        $this->_smarty->assign('code',$code);
        $this->_smarty->assign('oldName',$oldName);
        $this->_smarty->assign('oldCode',$oldCode);
        $this->_smarty->assign('idOpt',$idOpt);
        $this->_smarty->assign('isDisabled',$isDisabled);
        $this->_smarty->assign('error',$error);
    }
    private function upd_electric_corresponding($post,$get){
        $error=array();
        $this->_title = 'Mise à jour du correspondant électricité';
        $this->_smarty->assign('h1',$this->_title);
        $this->_template =dirname(__FILE__).'/views/add_update.tpl';
        $this->_smarty->assign('h1',$this->_title);
        $this->_smarty->assign('labelName','Nom ');
        $this->_smarty->assign('labelCode','Code ');
        $opt = MandateElectricCorresponding::load($this->_pdo,$get['action']);
        if(empty($post)){
            $oldName = $name = $opt->getName();
            $oldCode = $code = $opt->getCode();
            $idOpt = $opt->getId();
            $isDisabled=$opt->getIsDisabled()?0:1;
        }else{
            $oldName = htmlspecialchars($post['oldName']);
            $name = htmlspecialchars($post['name']);
            $oldCode =htmlspecialchars($post['oldCode']);
            $code = htmlspecialchars($post['code']);
            $idOpt = htmlspecialchars($post['idOpt']);
            $isDisabled = htmlspecialchars($post['isDisabled']);
        }
        if(isset($post['valider'])){
            if($post['name']=='')$error[]="Le champ nom doit être renseigné.";
            if($post['code']=='')$error[]="Le champ code doit être renseigné.";
            // Code et nom existe deja ...
            if( strtoupper($oldName) != strtoupper($name) )
                if(MandateElectricCorresponding::countByName($this->_pdo,$post['name'])>0)$error[]="Ce nom est déjà présent dans la base de données.";
            //if( strtoupper($oldCode) != strtoupper($code) )
            //if(MandateElectricCorresponding::countByCode($this->_pdo,$post['code'])>0)$error[]="Ce code est déjà présent dans la base de données.";
            if(empty($error)){
                $isDisabled=$post['isDisabled']?0:1;
                $opt->setName($name,false);
                $opt->setCode($code,false);
                $opt->setIsDisabled($isDisabled,false);
                $opt->update();
                Log::create($this->_pdo,time(),'parameters','Mise à jour du correspondant électricité  : '.$opt->getName(),$this->_user);
                header('location:'.Tools::create_url($this->_user,$get['module'],'list_electric_corresponding'));
            }
        }
        $this->_smarty->assign('name',$name);
        $this->_smarty->assign('code',$code);
        $this->_smarty->assign('oldName',$oldName);
        $this->_smarty->assign('oldCode',$oldCode);
        $this->_smarty->assign('idOpt',$idOpt);
        $this->_smarty->assign('isDisabled',$isDisabled);
        $this->_smarty->assign('error',$error);
    }
    private function upd_gaz_corresponding($post,$get){
        $error=array();
        $this->_title = 'Mise à jour du correspondant gaz';
        $this->_smarty->assign('h1',$this->_title);
        $this->_template =dirname(__FILE__).'/views/add_update.tpl';
        $this->_smarty->assign('h1',$this->_title);
        $this->_smarty->assign('labelName','Nom ');
        $this->_smarty->assign('labelCode','Code ');
        $opt = MandateGazCorresponding::load($this->_pdo,$get['action']);
        if(empty($post)){
            $oldName = $name = $opt->getName();
            $oldCode = $code = $opt->getCode();
            $idOpt = $opt->getId();
            $isDisabled=$opt->getIsDisabled()?0:1;
        }else{
            $oldName = htmlspecialchars($post['oldName']);
            $name = htmlspecialchars($post['name']);
            $oldCode =htmlspecialchars($post['oldCode']);
            $code = htmlspecialchars($post['code']);
            $idOpt = htmlspecialchars($post['idOpt']);
            $isDisabled = htmlspecialchars($post['$isDisabled']);
        }
        if(isset($post['valider'])){
            if($post['name']=='')$error[]="Le champ nom doit être renseigné.";
            if($post['code']=='')$error[]="Le champ code doit être renseigné.";
            // Code et nom existe deja ...
            if( strtoupper($oldName) != strtoupper($name) )
                if(MandateGazCorresponding::countByName($this->_pdo,$post['name'])>0)$error[]="Ce nom est déjà présent dans la base de données.";
            //if( strtoupper($oldCode) != strtoupper($code) )
            //	if(MandateGazCorresponding::countByCode($this->_pdo,$post['code'])>0)$error[]="Ce code est déjà présent dans la base de données.";
            if(empty($error)){
                $isDisabled=$post['sDisabled']?0:1;
                $opt->setName($name,false);
                $opt->setCode($code,false);
                $opt->setIsDisabled($isDisabled,false);
                $opt->update();
                Log::create($this->_pdo,time(),'parameters','Mise à jour du correspondant gaz  : '.$opt->getName(),$this->_user);
                header('location:'.Tools::create_url($this->_user,$get['module'],'list_gaz_corresponding'));
            }
        }
        $this->_smarty->assign('name',$name);
        $this->_smarty->assign('code',$code);
        $this->_smarty->assign('oldName',$oldName);
        $this->_smarty->assign('oldCode',$oldCode);
        $this->_smarty->assign('idOpt',$idOpt);
        $this->_smarty->assign('isDisabled',$isDisabled);
        $this->_smarty->assign('error',$error);
    }
    private function upd_sanitation_corresponding($post,$get){
        $error=array();
        $this->_title = 'Mise à jour du correspondant assainissement';
        $this->_smarty->assign('h1',$this->_title);
        $this->_template =dirname(__FILE__).'/views/add_update.tpl';
        $this->_smarty->assign('h1',$this->_title);
        $this->_smarty->assign('labelName','Nom ');
        $this->_smarty->assign('labelCode','Code ');
        $opt = MandateSanitationCorresponding::load($this->_pdo,$get['action']);
        if(empty($post)){
            $oldName = $name = $opt->getName();
            $oldCode = $code = $opt->getCode();
            $idOpt = $opt->getId();
            $isDisabled=$opt->getIsDisabled()?0:1;
        }else{
            $oldName = htmlspecialchars($post['oldName']);
            $name = htmlspecialchars($post['name']);
            $oldCode =htmlspecialchars($post['oldCode']);
            $code = htmlspecialchars($post['code']);
            $idOpt = htmlspecialchars($post['idOpt']);
            $isDisabled = htmlspecialchars($post['isDisabled']);
        }
        if(isset($post['valider'])){
            if($post['name']=='')$error[]="Le champ nom doit être renseigné.";
            if($post['code']=='')$error[]="Le champ code doit être renseigné.";
            // Code et nom existe deja ...
            if( strtoupper($oldName) != strtoupper($name) )
                if(MandateSanitationCorresponding::countByName($this->_pdo,$post['name'])>0)$error[]="Ce nom est déjà présent dans la base de données.";
            //if( strtoupper($oldCode) != strtoupper($code) )
            //if(MandateSanitationCorresponding::countByCode($this->_pdo,$post['code'])>0)$error[]="Ce code est déjà présent dans la base de données.";
            if(empty($error)){
                $isDisabled=$post['isDisabled']?0:1;
                $opt->setName($name,false);
                $opt->setCode($code,false);
                $opt->setIsDisabled($isDisabled,false);
                $opt->update();
                Log::create($this->_pdo,time(),'parameters','Mise à jour du correspondant assainissement  : '.$opt->getName(),$this->_user);
                header('location:'.Tools::create_url($this->_user,$get['module'],'list_sanitation_corresponding'));
            }
        }
        $this->_smarty->assign('name',$name);
        $this->_smarty->assign('code',$code);
        $this->_smarty->assign('oldName',$oldName);
        $this->_smarty->assign('oldCode',$oldCode);
        $this->_smarty->assign('idOpt',$idOpt);
        $this->_smarty->assign('isDisabled',$isDisabled);
        $this->_smarty->assign('error',$error);
    }
    private function upd_cos($post,$get){
        $error=array();
        $this->_title = 'Mise à jour de l\'option COS';
        $this->_smarty->assign('h1',$this->_title);
        $this->_template =dirname(__FILE__).'/views/add_update.tpl';
        $this->_smarty->assign('h1',$this->_title);
        $this->_smarty->assign('labelName','Nom ');
        $this->_smarty->assign('labelCode','Code ');
        $opt = MandateCos::load($this->_pdo,$get['action']);
        if(empty($post)){
            $oldName = $name = $opt->getName();
            $oldCode = $code = $opt->getCode();
            $idOpt = $opt->getId();
            $isDisabled=$opt->getIsDisabled()?0:1;
        }else{
            $oldName = htmlspecialchars($post['oldName']);
            $name = htmlspecialchars($post['name']);
            $oldCode =htmlspecialchars($post['oldCode']);
            $code = htmlspecialchars($post['code']);
            $idOpt = htmlspecialchars($post['idOpt']);
            $isDisabled = htmlspecialchars($post['isDisabled']);
        }
        if(isset($post['valider'])){
            if($post['name']=='')$error[]="Le champ nom doit être renseigné.";
            if($post['code']=='')$error[]="Le champ code doit être renseigné.";
            // Code et nom existe deja ...
            if( strtoupper($oldName) != strtoupper($name) )
                if(MandateCos::countByName($this->_pdo,$post['name'])>0)$error[]="Ce nom est déjà présent dans la base de données.";
            //	if( strtoupper($oldCode) != strtoupper($code) )
            //	if(MandateCos::countByCode($this->_pdo,$post['code'])>0)$error[]="Ce code est déjà présent dans la base de données.";
            if(empty($error)){
                $isDisabled=$post['isDisabled']?0:1;
                $opt->setName($name,false);
                $opt->setCode($code,false);
                $opt->setIsDisabled($isDisabled,false);
                $opt->update();
                Log::create($this->_pdo,time(),'parameters','Mise à jour de l\'option COS  : '.$opt->getName(),$this->_user);
                header('location:'.Tools::create_url($this->_user,$get['module'],'list_cos'));
            }
        }
        $this->_smarty->assign('name',$name);
        $this->_smarty->assign('code',$code);
        $this->_smarty->assign('oldName',$oldName);
        $this->_smarty->assign('oldCode',$oldCode);
        $this->_smarty->assign('idOpt',$idOpt);
        $this->_smarty->assign('isDisabled',$isDisabled);
        $this->_smarty->assign('error',$error);
    }
    private function upd_insulation($post,$get){
        $error=array();
        $this->_title = 'Mise à jour de l\'option d\'isolation';
        $this->_smarty->assign('h1',$this->_title);
        $this->_template =dirname(__FILE__).'/views/add_update.tpl';
        $this->_smarty->assign('h1',$this->_title);
        $this->_smarty->assign('labelName','Nom ');
        $this->_smarty->assign('labelCode','Code ');
        $opt = MandateInsulation::load($this->_pdo,$get['action']);
        if(empty($post)){
            $oldName = $name = $opt->getName();
            $oldCode = $code = $opt->getCode();
            $idOpt = $opt->getId();
            $isDisabled=$opt->getIsDisabled()?0:1;
        }else{
            $oldName = htmlspecialchars($post['oldName']);
            $name = htmlspecialchars($post['name']);
            $oldCode =htmlspecialchars($post['oldCode']);
            $code = htmlspecialchars($post['code']);
            $idOpt = htmlspecialchars($post['idOpt']);
            $isDisabled = htmlspecialchars($post['isDisabled']);
        }
        if(isset($post['valider'])){
            if($post['name']=='')$error[]="Le champ nom doit être renseigné.";
            if($post['code']=='')$error[]="Le champ code doit être renseigné.";
            // Code et nom existe deja ...
            if( strtoupper($oldName) != strtoupper($name) )
                if(MandateInsulation::countByName($this->_pdo,$post['name'])>0)$error[]="Ce nom est déjà présent dans la base de données.";
            //	if( strtoupper($oldCode) != strtoupper($code) )
            //if(MandateInsulation::countByCode($this->_pdo,$post['code'])>0)$error[]="Ce code est déjà présent dans la base de données.";
            if(empty($error)){
                $isDisabled=$post['isDisabled']?0:1;
                $opt->setName($name,false);
                $opt->setCode($code,false);
                $opt->setIsDisabled($isDisabled,false);
                $opt->update();
                Log::create($this->_pdo,time(),'parameters','Mise à jour de l\'isolation  : '.$opt->getName(),$this->_user);
                header('location:'.Tools::create_url($this->_user,$get['module'],'list_insulation'));
            }
        }
        $this->_smarty->assign('name',$name);
        $this->_smarty->assign('code',$code);
        $this->_smarty->assign('oldName',$oldName);
        $this->_smarty->assign('oldCode',$oldCode);
        $this->_smarty->assign('idOpt',$idOpt);
        $this->_smarty->assign('isDisabled',$isDisabled);
        $this->_smarty->assign('error',$error);
    }
    private function upd_roof($post,$get){
        $error=array();
        $this->_title = 'Mise à jour de l\'optionde toiture';
        $this->_smarty->assign('h1',$this->_title);
        $this->_template =dirname(__FILE__).'/views/add_update.tpl';
        $this->_smarty->assign('h1',$this->_title);
        $this->_smarty->assign('labelName','Nom ');
        $this->_smarty->assign('labelCode','Code ');
        $opt = MandateRoof::load($this->_pdo,$get['action']);
        if(empty($post)){
            $oldName = $name = $opt->getName();
            $oldCode = $code = $opt->getCode();
            $idOpt = $opt->getId();
            $isDisabled=$opt->getIsDisabled()?0:1;
        }else{
            $oldName = htmlspecialchars($post['oldName']);
            $name = htmlspecialchars($post['name']);
            $oldCode =htmlspecialchars($post['oldCode']);
            $code = htmlspecialchars($post['code']);
            $idOpt = htmlspecialchars($post['idOpt']);
            $isDisabled = htmlspecialchars($post['isDisabled']);
        }
        if(isset($post['valider'])){
            if($post['name']=='')$error[]="Le champ nom doit être renseigné.";
            if($post['code']=='')$error[]="Le champ code doit être renseigné.";
            // Code et nom existe deja ...
            if( strtoupper($oldName) != strtoupper($name) )
                if(MandateRoof::countByName($this->_pdo,$post['name'])>0)$error[]="Ce nom est déjà présent dans la base de données.";
            //if( strtoupper($oldCode) != strtoupper($code) )
            //if(MandateRoof::countByCode($this->_pdo,$post['code'])>0)$error[]="Ce code est déjà présent dans la base de données.";
            if(empty($error)){
                $isDisabled=$post['isDisabled']?0:1;
                $opt->setName($name,false);
                $opt->setCode($code,false);
                $opt->setIsDisabled($isDisabled,false);
                $opt->update();
                Log::create($this->_pdo,time(),'parameters','Mise à jour de l\'option de toiture  : '.$opt->getName(),$this->_user);
                header('location:'.Tools::create_url($this->_user,$get['module'],'list_roof'));
                $this->_smarty->assign('error',$error);
            }
        }
        $this->_smarty->assign('name',$name);
        $this->_smarty->assign('code',$code);
        $this->_smarty->assign('oldName',$oldName);
        $this->_smarty->assign('oldCode',$oldCode);
        $this->_smarty->assign('idOpt',$idOpt);
        $this->_smarty->assign('isDisabled',$isDisabled);
    }
    private function upd_heating($post,$get){
        $error=array();
        $this->_title = 'Mise à jour de l\'optionde chauffage';
        $this->_smarty->assign('h1',$this->_title);
        $this->_template =dirname(__FILE__).'/views/add_update.tpl';
        $this->_smarty->assign('h1',$this->_title);
        $this->_smarty->assign('labelName','Nom ');
        $this->_smarty->assign('labelCode','Code ');
        $opt = MandateHeating::load($this->_pdo,$get['action']);
        if(empty($post)){
            $oldName = $name = $opt->getName();
            $oldCode = $code = $opt->getCode();
            $idOpt = $opt->getId();
            $isDisabled=$opt->getIsDisabled()?0:1;
        }else{
            $oldName = htmlspecialchars($post['oldName']);
            $name = htmlspecialchars($post['name']);
            $oldCode =htmlspecialchars($post['oldCode']);
            $code = htmlspecialchars($post['code']);
            $idOpt = htmlspecialchars($post['idOpt']);
            $isDisabled = htmlspecialchars($post['isDisabled']);
        }
        if(isset($post['valider'])){
            if($post['name']=='')$error[]="Le champ nom doit être renseigné.";
            if($post['code']=='')$error[]="Le champ code doit être renseigné.";
            // Code et nom existe deja ...
            if( strtoupper($oldName) != strtoupper($name) )
                if(MandateHeating::countByName($this->_pdo,$post['name'])>0)$error[]="Ce nom est déjà présent dans la base de données.";
            //if( strtoupper($oldCode) != strtoupper($code) )
            //if(MandateHeating::countByCode($this->_pdo,$post['code'])>0)$error[]="Ce code est déjà présent dans la base de données.";
            if(empty($error)){
                $isDisabled=$post['isDisabled']?0:1;
                $opt->setName($name,false);
                $opt->setCode($code,false);
                $opt->setIsDisabled($isDisabled,false);
                $opt->update();
                Log::create($this->_pdo,time(),'parameters','Mise à jour de l\'option de chauffage  : '.$opt->getName(),$this->_user);
                header('location:'.Tools::create_url($this->_user,$get['module'],'list_heating'));
            }
        }
        $this->_smarty->assign('name',$name);
        $this->_smarty->assign('code',$code);
        $this->_smarty->assign('oldName',$oldName);
        $this->_smarty->assign('oldCode',$oldCode);
        $this->_smarty->assign('idOpt',$idOpt);
        $this->_smarty->assign('isDisabled',$isDisabled);
        $this->_smarty->assign('error',$error);
    }
    private function upd_commonOwnership($post,$get){
        $error=array();
        $this->_title = 'Mise à jour de l\'optiondes parties communes';
        $this->_smarty->assign('h1',$this->_title);
        $this->_template =dirname(__FILE__).'/views/add_update.tpl';
        $this->_smarty->assign('h1',$this->_title);
        $this->_smarty->assign('labelName','Nom ');
        $this->_smarty->assign('labelCode','Code ');
        $opt = MandateCommonOwnership::load($this->_pdo,$get['action']);
        if(empty($post)){
            $oldName = $name = $opt->getName();
            $oldCode = $code = $opt->getCode();
            $idOpt = $opt->getId();
            $isDisabled=$opt->getIsDisabled()?0:1;
        }else{
            $oldName = htmlspecialchars($post['oldName']);
            $name = htmlspecialchars($post['name']);
            $oldCode =htmlspecialchars($post['oldCode']);
            $code = htmlspecialchars($post['code']);
            $idOpt = htmlspecialchars($post['idOpt']);
            $isDisabled = htmlspecialchars($post['isDisabled']);
        }
        if(isset($post['valider'])){
            if($post['name']=='')$error[]="Le champ nom doit être renseigné.";
            if($post['code']=='')$error[]="Le champ code doit être renseigné.";
            // Code et nom existe deja ...
            if( strtoupper($oldName) != strtoupper($name) )
                if(MandateCommonOwnership::countByName($this->_pdo,$post['name'])>0)$error[]="Ce nom est déjà présent dans la base de données.";
            //if( strtoupper($oldCode) != strtoupper($code) )
            //if(MandateCommonOwnership::countByCode($this->_pdo,$post['code'])>0)$error[]="Ce code est déjà présent dans la base de données.";
            if(empty($error)){
                $isDisabled=$post['isDisabled']?0:1;
                $opt->setName($name,false);
                $opt->setCode($code,false);
                $opt->setIsDisabled($isDisabled,false);
                $opt->update();
                Log::create($this->_pdo,time(),'parameters','Mise à jour de l\'option des parties communes  : '.$opt->getName(),$this->_user);
                header('location:'.Tools::create_url($this->_user,$get['module'],'list_commonOwnership'));
            }
        }
        $this->_smarty->assign('name',$name);
        $this->_smarty->assign('code',$code);
        $this->_smarty->assign('oldName',$oldName);
        $this->_smarty->assign('oldCode',$oldCode);
        $this->_smarty->assign('idOpt',$idOpt);
        $this->_smarty->assign('isDisabled',$isDisabled);
        $this->_smarty->assign('error',$error);
    }
    private function upd_constructionType($post,$get){
        $error=array();
        $this->_title = 'Mise à jour de l\'option du type de construction';
        $this->_smarty->assign('h1',$this->_title);
        $this->_template =dirname(__FILE__).'/views/add_update.tpl';
        $this->_smarty->assign('h1',$this->_title);
        $this->_smarty->assign('labelName','Nom ');
        $this->_smarty->assign('labelCode','Code ');
        $opt = MandateConstructionType::load($this->_pdo,$get['action']);
        if(empty($post)){
            $oldName = $name = $opt->getName();
            $oldCode = $code = $opt->getCode();
            $idOpt = $opt->getId();
            $isDisabled=$opt->getIsDisabled()?0:1;
        }else{
            $oldName = htmlspecialchars($post['oldName']);
            $name = htmlspecialchars($post['name']);
            $oldCode =htmlspecialchars($post['oldCode']);
            $code = htmlspecialchars($post['code']);
            $idOpt = htmlspecialchars($post['idOpt']);
            $isDisabled = htmlspecialchars($post['isDisabled']);
        }
        if(isset($post['valider'])){
            if($post['name']=='')$error[]="Le champ nom doit être renseigné.";
            if($post['code']=='')$error[]="Le champ code doit être renseigné.";
            // Code et nom existe deja ...
            if( strtoupper($oldName) != strtoupper($name) )
                if(MandateConstructionType::countByName($this->_pdo,$post['name'])>0)$error[]="Ce nom est déjà présent dans la base de données.";
            //if( strtoupper($oldCode) != strtoupper($code) )
            //if(MandateConstructionType::countByCode($this->_pdo,$post['code'])>0)$error[]="Ce code est déjà présent dans la base de données.";
            if(empty($error)){
                $isDisabled=$post['isDisabled']?0:1;
                $opt->setName($name,false);
                $opt->setCode($code,false);
                $opt->setIsDisabled($isDisabled,false);
                $opt->update();
                Log::create($this->_pdo,time(),'parameters','Mise à jour de l\'option du type de construction  : '.$opt->getName(),$this->_user);
                header('location:'.Tools::create_url($this->_user,$get['module'],'list_constructionType'));
            }
        }
        $this->_smarty->assign('name',$name);
        $this->_smarty->assign('code',$code);
        $this->_smarty->assign('oldName',$oldName);
        $this->_smarty->assign('oldCode',$oldCode);
        $this->_smarty->assign('idOpt',$idOpt);
        $this->_smarty->assign('isDisabled',$isDisabled);
        $this->_smarty->assign('error',$error);
    }
    private function upd_style($post,$get){
        $error=array();
        $this->_title = 'Mise à jour de l\'option du style';
        $this->_smarty->assign('h1',$this->_title);
        $this->_template =dirname(__FILE__).'/views/add_update.tpl';
        $this->_smarty->assign('h1',$this->_title);
        $this->_smarty->assign('labelName','Nom ');
        $this->_smarty->assign('labelCode','Code ');
        $opt = MandateStyle::load($this->_pdo,$get['action']);
        if(empty($post)){
            $oldName = $name = $opt->getName();
            $oldCode = $code = $opt->getCode();
            $idOpt = $opt->getId();
            $isDisabled=$opt->getIsDisabled()?0:1;
        }else{
            $oldName = htmlspecialchars($post['oldName']);
            $name = htmlspecialchars($post['name']);
            $oldCode =htmlspecialchars($post['oldCode']);
            $code = htmlspecialchars($post['code']);
            $idOpt = htmlspecialchars($post['idOpt']);
            $isDisabled = htmlspecialchars($post['isDisabled']);
        }
        if(isset($post['valider'])){
            if($post['name']=='')$error[]="Le champ nom doit être renseigné.";
            if($post['code']=='')$error[]="Le champ code doit être renseigné.";
            // Code et nom existe deja ...
            if( strtoupper($oldName) != strtoupper($name) )
                if(MandateStyle::countByName($this->_pdo,$post['name'])>0)$error[]="Ce nom est déjà présent dans la base de données.";
            //	if( strtoupper($oldCode) != strtoupper($code) )
            //if(MandateStyle::countByCode($this->_pdo,$post['code'])>0)$error[]="Ce code est déjà présent dans la base de données.";
            if(empty($error)){
                $isDisabled=$post['isDisabled']?0:1;
                $opt->setName($name,false);
                $opt->setCode($code,false);
                $opt->setIsDisabled($isDisabled,false);
                $opt->update();
                Log::create($this->_pdo,time(),'parameters','Mise à jour de l\'option du style  : '.$opt->getName(),$this->_user);
                header('location:'.Tools::create_url($this->_user,$get['module'],'list_style'));
            }
        }
        $this->_smarty->assign('name',$name);
        $this->_smarty->assign('code',$code);
        $this->_smarty->assign('oldName',$oldName);
        $this->_smarty->assign('oldCode',$oldCode);
        $this->_smarty->assign('idOpt',$idOpt);
        $this->_smarty->assign('isDisabled',$isDisabled);
        $this->_smarty->assign('error',$error);
    }
    private function upd_news($post,$get){
        $error=array();
        $this->_title = 'Mise à jour de l\'option de nouveauté';
        $this->_smarty->assign('h1',$this->_title);
        $this->_template =dirname(__FILE__).'/views/add_update.tpl';
        $this->_smarty->assign('h1',$this->_title);
        $this->_smarty->assign('labelName','Nom ');
        $this->_smarty->assign('labelCode','Code ');
        $opt = MandateNews::load($this->_pdo,$get['action']);
        if(empty($post)){
            $oldName = $name = $opt->getName();
            $oldCode = $code = $opt->getCode();
            $idOpt = $opt->getId();
            $isDisabled=$opt->getIsDisabled()?0:1;
        }else{
            $oldName = htmlspecialchars($post['oldName']);
            $name = htmlspecialchars($post['name']);
            $oldCode =htmlspecialchars($post['oldCode']);
            $code = htmlspecialchars($post['code']);
            $idOpt = htmlspecialchars($post['idOpt']);
            $isDisabled = htmlspecialchars($post['isDisabled']);
        }
        if(isset($post['valider'])){
            if($post['name']=='')$error[]="Le champ nom doit être renseigné.";
            if($post['code']=='')$error[]="Le champ code doit être renseigné.";
            // Code et nom existe deja ...
            if( strtoupper($oldName) != strtoupper($name) )
                if(MandateNews::countByName($this->_pdo,$post['name'])>0)$error[]="Ce nom est déjà présent dans la base de données.";
            //	if( strtoupper($oldCode) != strtoupper($code) )
            //if(MandateNews::countByCode($this->_pdo,$post['code'])>0)$error[]="Ce code est déjà présent dans la base de données.";
            if(empty($error)){
                $isDisabled=$post['isDisabled']?0:1;
                $opt->setName($name,false);
                $opt->setCode($code,false);
                $opt->setIsDisabled($isDisabled,false);
                $opt->update();
                Log::create($this->_pdo,time(),'parameters','Mise à jour de l\'option de nouveauté  : '.$opt->getName(),$this->_user);
                header('location:'.Tools::create_url($this->_user,$get['module'],'list_news'));
            }
        }
        $this->_smarty->assign('name',$name);
        $this->_smarty->assign('code',$code);
        $this->_smarty->assign('oldName',$oldName);
        $this->_smarty->assign('oldCode',$oldCode);
        $this->_smarty->assign('idOpt',$idOpt);
        $this->_smarty->assign('isDisabled',$isDisabled);
        $this->_smarty->assign('error',$error);
    }
    private function upd_condition($post,$get){
        $error=array();
        $this->_title = 'Mise à jour de l\'option de condition';
        $this->_smarty->assign('h1',$this->_title);
        $this->_template =dirname(__FILE__).'/views/add_update.tpl';
        $this->_smarty->assign('h1',$this->_title);
        $this->_smarty->assign('labelName','Nom ');
        $this->_smarty->assign('labelCode','Code ');
        $opt = MandateCondition::load($this->_pdo,$get['action']);
        if(empty($post)){
            $oldName = $name = $opt->getName();
            $oldCode = $code = $opt->getCode();
            $idOpt = $opt->getId();
            $isDisabled=$opt->getIsDisabled()?0:1;
        }else{
            $oldName = htmlspecialchars($post['oldName']);
            $name = htmlspecialchars($post['name']);
            $oldCode =htmlspecialchars($post['oldCode']);
            $code = htmlspecialchars($post['code']);
            $idOpt = htmlspecialchars($post['idOpt']);
            $isDisabled = htmlspecialchars($post['isDisabled']);
        }
        if(isset($post['valider'])){
            if($post['name']=='')$error[]="Le champ nom doit être renseigné.";
            if($post['code']=='')$error[]="Le champ code doit être renseigné.";
            // Code et nom existe deja ...
            if( strtoupper($oldName) != strtoupper($name) )
                if(MandateCondition::countByName($this->_pdo,$post['name'])>0)$error[]="Ce nom est déjà présent dans la base de données.";
            //if( strtoupper($oldCode) != strtoupper($code) )
            //if(MandateCondition::countByCode($this->_pdo,$post['code'])>0)$error[]="Ce code est déjà présent dans la base de données.";
            if(empty($error)){
                $isDisabled=$post['isDisabled']?0:1;
                $opt->setName($name,false);
                $opt->setCode($code,false);
                $opt->setIsDisabled($isDisabled,false);
                $opt->update();
                Log::create($this->_pdo,time(),'parameters','Mise à jour de l\'option de condition  : '.$opt->getName(),$this->_user);
                header('location:'.Tools::create_url($this->_user,$get['module'],'list_condition'));
            }
        }
        $this->_smarty->assign('name',$name);
        $this->_smarty->assign('code',$code);
        $this->_smarty->assign('oldName',$oldName);
        $this->_smarty->assign('oldCode',$oldCode);
        $this->_smarty->assign('idOpt',$idOpt);
        $this->_smarty->assign('isDisabled',$isDisabled);
        $this->_smarty->assign('error',$error);
    }
    private function upd_nature($post,$get){
        $error=array();
        $this->_title = 'Mise à jour de l\'option de nature';
        $this->_smarty->assign('h1',$this->_title);
        $this->_template =dirname(__FILE__).'/views/add_update.tpl';
        $this->_smarty->assign('h1',$this->_title);
        $this->_smarty->assign('labelName','Nom ');
        $this->_smarty->assign('labelCode','Code ');
        $opt = MandateNature::load($this->_pdo,$get['action']);
        if(empty($post)){
            $oldName = $name = $opt->getName();
            $oldCode = $code = $opt->getCode();
            $idOpt = $opt->getId();
            $isDisabled=$opt->getIsDisabled()?0:1;
        }else{
            $oldName = htmlspecialchars($post['oldName']);
            $name = htmlspecialchars($post['name']);
            $oldCode =htmlspecialchars($post['oldCode']);
            $code = htmlspecialchars($post['code']);
            $idOpt = htmlspecialchars($post['idOpt']);
            $isDisabled = htmlspecialchars($post['isDisabled']);
        }
        if(isset($post['valider'])){
            if($post['name']=='')$error[]="Le champ nom doit être renseigné.";
            if($post['code']=='')$error[]="Le champ code doit être renseigné.";
            // Code et nom existe deja ...
            if( strtoupper($oldName) != strtoupper($name) )
                if(MandateNature::countByName($this->_pdo,$post['name'])>0)$error[]="Ce nom est déjà présent dans la base de données.";
            //if( strtoupper($oldCode) != strtoupper($code) )
            //if(MandateNature::countByCode($this->_pdo,$post['code'])>0)$error[]="Ce code est déjà présent dans la base de données.";
            if(empty($error)){
                $opt->setName($name,false);
                $opt->setCode($code,false);
                //					echo $isDisabled;
                $opt->setIsDisabled($isDisabled?0:1,false);
                $opt->update();
                Log::create($this->_pdo,time(),'parameters','Mise à jour de la nature : '.$opt->getName(),$this->_user);
                header('location:'.Tools::create_url($this->_user,$get['module'],'list_nature'));
            }
        }
        $this->_smarty->assign('name',$name);
        $this->_smarty->assign('code',$code);
        $this->_smarty->assign('oldName',$oldName);
        $this->_smarty->assign('oldCode',$oldCode);
        $this->_smarty->assign('idOpt',$idOpt);
        $this->_smarty->assign('isDisabled',$isDisabled);
        $this->_smarty->assign('error',$error);
    }

    /*
     * Fin upd
     */
    /*
     * Add
     */
    private function add_bornage_terrain(){
        $error=array();
        $this->_title = 'Ajouter une option de bornage terrain';
        $this->_smarty->assign('h1',$this->_title);
        $this->_smarty->assign('labelName','Nom ');
        $this->_smarty->assign('labelCode','Code ');
        $this->_template =dirname(__FILE__).'/views/add_update.tpl';
        if(isset($_POST['valider'])){
            if($_POST['name']=='')$error[]="Le champ nom doit être renseigné.";
            if($_POST['code']=='')$error[]="Le champ code doit être renseigné.";
            // Code et nom existe deja ...
            if(MandateBornageTerrain::countByName($this->_pdo,$_POST['name'])>0)$error[]="Ce nom est déjà présent dans la base de données.";
            //if(MandateBornageTerrain::countByCode($this->_pdo,$post['code'])>0)$error[]="Ce code est déjà présent dans la base de données.";
            // Si pas d'erreurs on sauvegarde
            if(empty($error)){
                $isDisabled = $_POST['isDisabled']==1?0:1;
                $obj = MandateBornageTerrain::create($this->_pdo,htmlspecialchars($_POST['name']),htmlspecialchars($_POST['code']),$isDisabled);
                Log::create($this->_pdo,time(),'parameters','Ajout de l\'action bornage de terrain : '.$obj->getName(),$this->_user);
                header('location:'.Tools::create_url($this->_user,$_GET['module'],'list_bornage_terrain'));
            }
        }
        $this->_smarty->assign('name',empty($_POST['name'])?'':$_POST['name']);
        $this->_smarty->assign('code',empty($_POST['code'])?'':$_POST['code']);
        $this->_smarty->assign('oldName',empty($_POST['oldName'])?'':$_POST['oldName']);
        $this->_smarty->assign('oldCode',empty($_POST['oldCode'])?'':$_POST['oldCode']);
        $this->_smarty->assign('idOpt',empty($_POST['idOpt'])?'':$_POST['idOpt']);
        $this->_smarty->assign('isDisabled',empty($_POST['isDisabled'])?'1':$_POST['isDisabled']);
        $this->_smarty->assign('error',$error);
    }
    private function add_orientation($post,$get){
        $error=array();
        $this->_title = 'Ajouter une option d\'orientation';
        $this->_smarty->assign('h1',$this->_title);
        $this->_smarty->assign('labelName','Nom ');
        $this->_smarty->assign('labelCode','Code ');
        $this->_template =dirname(__FILE__).'/views/add_update.tpl';
        if(isset($post['valider'])){
            if($post['name']=='')$error[]="Le champ nom doit être renseigné.";
            if($post['code']=='')$error[]="Le champ code doit être renseigné.";
            // Code et nom existe deja ...
            if(MandateOrientation::countByName($this->_pdo,$post['name'])>0)$error[]="Ce nom est déjà présent dans la base de données.";
            //if(MandateOrientation::countByCode($this->_pdo,$post['code'])>0)$error[]="Ce code est déjà présent dans la base de données.";
            // Si pas d'erreurs on sauvegarde
            if(empty($error)){
                $isDisabled = $post['isDisabled']==1?0:1;
                $obj = MandateOrientation::create($this->_pdo,htmlspecialchars($post['name']),htmlspecialchars($post['code']),$isDisabled);
                Log::create($this->_pdo,time(),'parameters','Ajout de l\'orientation de terrain : '.$obj->getName(),$this->_user);
                header('location:'.Tools::create_url($this->_user,$get['module'],'list_orientation'));
            }
        }
        $this->_smarty->assign('name',empty($post['name'])?'':$post['name']);
        $this->_smarty->assign('code',empty($post['code'])?'':$post['code']);
        $this->_smarty->assign('oldName',empty($post['oldName'])?'':$post['oldName']);
        $this->_smarty->assign('oldCode',empty($post['oldCode'])?'':$post['oldCode']);
        $this->_smarty->assign('idOpt',empty($post['idOpt'])?'':$post['idOpt']);
        $this->_smarty->assign('isDisabled',empty($post['isDisabled'])?'1':$post['isDisabled']);
        $this->_smarty->assign('error',$error);
    }
    private function add_slope($post,$get){
        $error=array();
        $this->_title = 'Ajouter une option de pente';
        $this->_smarty->assign('h1',$this->_title);
        $this->_smarty->assign('labelName','Nom ');
        $this->_smarty->assign('labelCode','Code ');
        $this->_template =dirname(__FILE__).'/views/add_update.tpl';
        if(isset($post['valider'])){
            if($post['name']=='')$error[]="Le champ nom doit être renseigné.";
            if($post['code']=='')$error[]="Le champ code doit être renseigné.";
            // Code et nom existe deja ...
            if(MandateSlope::countByName($this->_pdo,$post['name'])>0)$error[]="Ce nom est déjà présent dans la base de données.";
            //if(MandateSlope::countByCode($this->_pdo,$post['code'])>0)$error[]="Ce code est déjà présent dans la base de données.";
            // Si pas d'erreurs on sauvegarde
            if(empty($error)){
                $isDisabled=$post['isDisabled']?0:1;
                $obj = MandateSlope::create($this->_pdo,$post['name'],$post['code'],$isDisabled);
                Log::create($this->_pdo,time(),'parameters','Ajout de l\'option de pente : '.$obj->getName(),$this->_user);
                header('location:'.Tools::create_url($this->_user,$get['module'],'list_slope'));
            }
        }
        $this->_smarty->assign('name',empty($post['name'])?'':$post['name']);
        $this->_smarty->assign('code',empty($post['code'])?'':$post['code']);
        $this->_smarty->assign('oldName',empty($post['oldName'])?'':$post['oldName']);
        $this->_smarty->assign('oldCode',empty($post['oldCode'])?'':$post['oldCode']);
        $this->_smarty->assign('idOpt',empty($post['idOpt'])?'':$post['idOpt']);
        $this->_smarty->assign('isDisabled',empty($post['isDisabled'])?'1':$post['isDisabled']);



        $this->_smarty->assign('error',$error);
    }
    private function add_plu($post,$get){
        $error=array();
        $this->_title = 'Ajouter une option de zonage PLU';
        $this->_smarty->assign('h1',$this->_title);
        $this->_smarty->assign('labelName','Nom ');
        $this->_smarty->assign('labelCode','Code ');
        $this->_template =dirname(__FILE__).'/views/add_update.tpl';
        if(isset($post['valider'])){
            if($post['name']=='')$error[]="Le champ nom doit être renseigné.";
            if($post['code']=='')$error[]="Le champ code doit être renseigné.";
            // Code et nom existe deja ...
            if(MandateZonagePLU::countByName($this->_pdo,$post['name'])>0)$error[]="Ce nom est déjà présent dans la base de données.";
            //if(MandateZonagePLU::countByCode($this->_pdo,$post['code'])>0)$error[]="Ce code est déjà présent dans la base de données.";
            // Si pas d'erreurs on sauvegarde
            if(empty($error)){
                $isDisabled = $post['isDisabled']?0:1;
                $obj = MandateZonagePLU::create($this->_pdo,htmlspecialchars($post['name']),htmlspecialchars($post['code']),$isDisabled);
                Log::create($this->_pdo,time(),'parameters','Ajout du zonage PLU : '.$obj->getName(),$this->_user);
                header('location:'.Tools::create_url($this->_user,$get['module'],'list_plu'));
            }
        }
        $this->_smarty->assign('name',empty($post['name'])?'':$post['name']);
        $this->_smarty->assign('code',empty($post['code'])?'':$post['code']);
        $this->_smarty->assign('oldName',empty($post['oldName'])?'':$post['oldName']);
        $this->_smarty->assign('oldCode',empty($post['oldCode'])?'':$post['oldCode']);
        $this->_smarty->assign('idOpt',empty($post['idOpt'])?'':$post['idOpt']);
        $this->_smarty->assign('isDisabled',empty($post['isDisabled'])?'1':$post['isDisabled']);
        $this->_smarty->assign('error',$error);
    }
    private function add_rnu($post,$get){
        $error=array();
        $this->_title = 'Ajouter une option de zonage RNU';
        $this->_smarty->assign('h1',$this->_title);
        $this->_smarty->assign('labelName','Nom ');
        $this->_smarty->assign('labelCode','Code ');
        $this->_template =dirname(__FILE__).'/views/add_update.tpl';
        if(isset($post['valider'])){
            if($post['name']=='')$error[]="Le champ nom doit être renseigné.";
            if($post['code']=='')$error[]="Le champ code doit être renseigné.";
            // Code et nom existe deja ...
            if(MandateZonageRNU::countByName($this->_pdo,$post['name'])>0)$error[]="Ce nom est déjà présent dans la base de données.";
            //if(MandateZonageRNU::countByCode($this->_pdo,$post['code'])>0)$error[]="Ce code est déjà présent dans la base de données.";
            // Si pas d'erreurs on sauvegarde
            if(empty($error)){
                $isDisabled = $post['isDisabled']?0:1;
                $obj = MandateZonageRNU::create($this->_pdo,htmlspecialchars($post['name']),htmlspecialchars($post['code']),$isDisabled);
                Log::create($this->_pdo,time(),'parameters','Ajout du zonage RNU : '.$obj->getName(),$this->_user);
                header('location:'.Tools::create_url($this->_user,$get['module'],'list_rnu'));
            }
        }
        $this->_smarty->assign('name',empty($post['name'])?'':$post['name']);
        $this->_smarty->assign('code',empty($post['code'])?'':$post['code']);
        $this->_smarty->assign('oldName',empty($post['oldName'])?'':$post['oldName']);
        $this->_smarty->assign('oldCode',empty($post['oldCode'])?'':$post['oldCode']);
        $this->_smarty->assign('idOpt',empty($post['idOpt'])?'':$post['idOpt']);
        $this->_smarty->assign('isDisabled',empty($post['isDisabled'])?'1':$post['isDisabled']);

        $this->_smarty->assign('error',$error);
    }
    private function add_geometer($post,$get){
        $error=array();
        $this->_title = 'Ajouter un géometre';
        $this->_smarty->assign('h1',$this->_title);
        $this->_smarty->assign('labelName','Nom ');
        $this->_smarty->assign('labelCode','Code ');
        $this->_template =dirname(__FILE__).'/views/add_update.tpl';
        if(isset($post['valider'])){
            if($post['name']=='')$error[]="Le champ nom doit être renseigné.";
            if($post['code']=='')$error[]="Le champ code doit être renseigné.";
            // Code et nom existe deja ...
            if(MandateGeometer::countByName($this->_pdo,$post['name'])>0)$error[]="Ce nom est déjà présent dans la base de données.";
            //if(MandateGeometer::countByCode($this->_pdo,$post['code'])>0)$error[]="Ce code est déjà présent dans la base de données.";
            // Si pas d'erreurs on sauvegarde
            if(empty($error)){
                $isDisabled = $post['isDisabled']==1?0:1;
                $obj = MandateGeometer::create($this->_pdo,htmlspecialchars($post['name']),htmlspecialchars($post['code']),$isDisabled);
                Log::create($this->_pdo,time(),'parameters','Ajout d\'un géometre : '.$obj->getName(),$this->_user);
                header('location:'.Tools::create_url($this->_user,$get['module'],'list_geometer'));
            }
        }
        $this->_smarty->assign('name',empty($post['name'])?'':$post['name']);
        $this->_smarty->assign('code',empty($post['code'])?'':$post['code']);
        $this->_smarty->assign('oldName',empty($post['oldName'])?'':$post['oldName']);
        $this->_smarty->assign('oldCode',empty($post['oldCode'])?'':$post['oldCode']);
        $this->_smarty->assign('idOpt',empty($post['idOpt'])?'':$post['idOpt']);
        $this->_smarty->assign('isDisabled',empty($post['isDisabled'])?'1':$post['isDisabled']);
        $this->_smarty->assign('error',$error);
    }
    private function add_water_corresponding($post,$get){
        $error=array();
        $this->_title = 'Ajouter un correspondant eau';
        $this->_smarty->assign('h1',$this->_title);
        $this->_smarty->assign('labelName','Nom ');
        $this->_smarty->assign('labelCode','Code ');
        $this->_template =dirname(__FILE__).'/views/add_update.tpl';
        if(isset($post['valider'])){
            if($post['name']=='')$error[]="Le champ nom doit être renseigné.";
            if($post['code']=='')$error[]="Le champ code doit être renseigné.";
            // Code et nom existe deja ...
            if(MandateWaterCorresponding::countByName($this->_pdo,$post['name'])>0)$error[]="Ce nom est déjà présent dans la base de données.";
            //		if(MandateWaterCorresponding::countByCode($this->_pdo,$post['code'])>0)$error[]="Ce code est déjà présent dans la base de données.";
            // Si pas d'erreurs on sauvegarde
            if(empty($error)){
                $isDisabled = $post['isDisabled']==1?0:1;
                $obj = MandateWaterCorresponding::create($this->_pdo,htmlspecialchars($post['name']),htmlspecialchars($post['code']),$isDisabled);
                Log::create($this->_pdo,time(),'parameters','Ajout d\'un correspondant eau : '.$obj->getName(),$this->_user);
                header('location:'.Tools::create_url($this->_user,$get['module'],'list_water_corresponding'));
            }
        }
        $this->_smarty->assign('name',empty($post['name'])?'':$post['name']);
        $this->_smarty->assign('code',empty($post['code'])?'':$post['code']);
        $this->_smarty->assign('oldName',empty($post['oldName'])?'':$post['oldName']);
        $this->_smarty->assign('oldCode',empty($post['oldCode'])?'':$post['oldCode']);
        $this->_smarty->assign('idOpt',empty($post['idOpt'])?'':$post['idOpt']);
        $this->_smarty->assign('isDisabled',empty($post['isDisabled'])?'1':$post['isDisabled']);
        $this->_smarty->assign('error',$error);
    }
    private function add_electric_corresponding($post,$get){
        $error=array();
        $this->_title = 'Ajouter un correspondant électricité';
        $this->_smarty->assign('h1',$this->_title);
        $this->_smarty->assign('labelName','Nom ');
        $this->_smarty->assign('labelCode','Code ');
        $this->_template =dirname(__FILE__).'/views/add_update.tpl';
        if(isset($post['valider'])){
            if($post['name']=='')$error[]="Le champ nom doit être renseigné.";
            if($post['code']=='')$error[]="Le champ code doit être renseigné.";
            // Code et nom existe deja ...
            if(MandateElectricCorresponding::countByName($this->_pdo,$post['name'])>0)$error[]="Ce nom est déjà présent dans la base de données.";
            //if(MandateElectricCorresponding::countByCode($this->_pdo,$post['code'])>0)$error[]="Ce code est déjà présent dans la base de données.";
            // Si pas d'erreurs on sauvegarde
            if(empty($error)){
                $isDisabled = $post['isDisabled']==1?0:1;
                $obj = MandateElectricCorresponding::create($this->_pdo,htmlspecialchars($post['name']),htmlspecialchars($post['code']),$isDisabled);
                Log::create($this->_pdo,time(),'parameters','Ajout d\'un correspondant électricité : '.$obj->getName(),$this->_user);
                header('location:'.Tools::create_url($this->_user,$get['module'],'list_electric_corresponding'));
            }
        }
        $this->_smarty->assign('name',empty($post['name'])?'':$post['name']);
        $this->_smarty->assign('code',empty($post['code'])?'':$post['code']);
        $this->_smarty->assign('oldName',empty($post['oldName'])?'':$post['oldName']);
        $this->_smarty->assign('oldCode',empty($post['oldCode'])?'':$post['oldCode']);
        $this->_smarty->assign('idOpt',empty($post['idOpt'])?'':$post['idOpt']);
        $this->_smarty->assign('isDisabled',empty($post['isDisabled'])?'1':$post['isDisabled']);
        $this->_smarty->assign('error',$error);
    }
    private function add_gaz_corresponding($post,$get){
        $error=array();
        $this->_title = 'Ajouter un correspondant gaz';
        $this->_smarty->assign('h1',$this->_title);
        $this->_smarty->assign('labelName','Nom ');
        $this->_smarty->assign('labelCode','Code ');
        $this->_template =dirname(__FILE__).'/views/add_update.tpl';
        if(isset($post['valider'])){
            if($post['name']=='')$error[]="Le champ nom doit être renseigné.";
            if($post['code']=='')$error[]="Le champ code doit être renseigné.";
            // Code et nom existe deja ...
            if(MandateGazCorresponding::countByName($this->_pdo,$post['name'])>0)$error[]="Ce nom est déjà présent dans la base de données.";
            //if(MandateGazCorresponding::countByCode($this->_pdo,$post['code'])>0)$error[]="Ce code est déjà présent dans la base de données.";
            // Si pas d'erreurs on sauvegarde
            if(empty($error)){
                $isDisabled = $post['isDisabled']==1?0:1;
                $obj = MandateGazCorresponding::create($this->_pdo,htmlspecialchars($post['name']),htmlspecialchars($post['code']),$isDisabled);
                Log::create($this->_pdo,time(),'parameters','Ajout d\'un correspondant gaz : '.$obj->getName(),$this->_user);
                header('location:'.Tools::create_url($this->_user,$get['module'],'list_gaz_corresponding'));
            }
        }
        $this->_smarty->assign('name',empty($post['name'])?'':$post['name']);
        $this->_smarty->assign('code',empty($post['code'])?'':$post['code']);
        $this->_smarty->assign('oldName',empty($post['oldName'])?'':$post['oldName']);
        $this->_smarty->assign('oldCode',empty($post['oldCode'])?'':$post['oldCode']);
        $this->_smarty->assign('idOpt',empty($post['idOpt'])?'':$post['idOpt']);
        $this->_smarty->assign('isDisabled',empty($post['isDisabled'])?'1':$post['isDisabled']);
        $this->_smarty->assign('error',$error);
    }
    private function add_sanitation_corresponding($post,$get){
        $error=array();
        $this->_title = 'Ajouter un correspondant assainissement';
        $this->_smarty->assign('h1',$this->_title);
        $this->_smarty->assign('labelName','Nom ');
        $this->_smarty->assign('labelCode','Code ');
        $this->_template =dirname(__FILE__).'/views/add_update.tpl';
        if(isset($post['valider'])){
            if($post['name']=='')$error[]="Le champ nom doit être renseigné.";
            if($post['code']=='')$error[]="Le champ code doit être renseigné.";
            // Code et nom existe deja ...
            if(MandateSanitationCorresponding::countByName($this->_pdo,$post['name'])>0)$error[]="Ce nom est déjà présent dans la base de données.";
            //if(MandateSanitationCorresponding::countByCode($this->_pdo,$post['code'])>0)$error[]="Ce code est déjà présent dans la base de données.";
            // Si pas d'erreurs on sauvegarde
            if(empty($error)){
                $isDisabled = $post['isDisabled']==1?0:1;
                $obj = MandateSanitationCorresponding::create($this->_pdo,htmlspecialchars($post['name']),htmlspecialchars($post['code']),$isDisabled);
                Log::create($this->_pdo,time(),'parameters','Ajout d\'un correspondant assainissement : '.$obj->getName(),$this->_user);
                header('location:'.Tools::create_url($this->_user,$get['module'],'list_sanitation_corresponding'));
            }
        }
        $this->_smarty->assign('name',empty($post['name'])?'':$post['name']);
        $this->_smarty->assign('code',empty($post['code'])?'':$post['code']);
        $this->_smarty->assign('oldName',empty($post['oldName'])?'':$post['oldName']);
        $this->_smarty->assign('oldCode',empty($post['oldCode'])?'':$post['oldCode']);
        $this->_smarty->assign('idOpt',empty($post['idOpt'])?'':$post['idOpt']);
        $this->_smarty->assign('isDisabled',empty($post['isDisabled'])?'1':$post['isDisabled']);
        $this->_smarty->assign('error',$error);
    }
    private function add_cos($post,$get){
        $error=array();
        $this->_title = 'Ajouter une option COS';
        $this->_smarty->assign('h1',$this->_title);
        $this->_smarty->assign('labelName','Nom ');
        $this->_smarty->assign('labelCode','Code ');
        $this->_template =dirname(__FILE__).'/views/add_update.tpl';
        if(isset($post['valider'])){
            if($post['name']=='')$error[]="Le champ nom doit être renseigné.";
            if($post['code']=='')$error[]="Le champ code doit être renseigné.";
            // Code et nom existe deja ...
            if(MandateCos::countByName($this->_pdo,$post['name'])>0)$error[]="Ce nom est déjà présent dans la base de données.";
            //	if(MandateCos::countByCode($this->_pdo,$post['code'])>0)$error[]="Ce code est déjà présent dans la base de données.";
            // Si pas d'erreurs on sauvegarde
            if(empty($error)){
                $isDisabled = $post['isDisabled']==1?0:1;
                $obj = MandateCos::create($this->_pdo,htmlspecialchars($post['name']),htmlspecialchars($post['code']),$isDisabled);
                Log::create($this->_pdo,time(),'parameters','Ajout d\'une option COS : '.$obj->getName(),$this->_user);
                header('location:'.Tools::create_url($this->_user,$get['module'],'list_cos'));
            }
        }
        $this->_smarty->assign('name',empty($post['name'])?'':$post['name']);
        $this->_smarty->assign('code',empty($post['code'])?'':$post['code']);
        $this->_smarty->assign('oldName',empty($post['oldName'])?'':$post['oldName']);
        $this->_smarty->assign('oldCode',empty($post['oldCode'])?'':$post['oldCode']);
        $this->_smarty->assign('idOpt',empty($post['idOpt'])?'':$post['idOpt']);
        $this->_smarty->assign('isDisabled',empty($post['isDisabled'])?'1':$post['isDisabled']);
        $this->_smarty->assign('error',$error);
    }
    private function add_insulation($post,$get){
        $error=array();
        $this->_title = 'Ajouter une option de isolation';
        $this->_smarty->assign('h1',$this->_title);
        $this->_smarty->assign('labelName','Nom ');
        $this->_smarty->assign('labelCode','Code ');
        $this->_template =dirname(__FILE__).'/views/add_update.tpl';
        if(isset($post['valider'])){
            if($post['name']=='')$error[]="Le champ nom doit être renseigné.";
            if($post['code']=='')$error[]="Le champ code doit être renseigné.";
            // Code et nom existe deja ...
            if(MandateInsulation::countByName($this->_pdo,$post['name'])>0)$error[]="Ce nom est déjà présent dans la base de données.";
            //if(MandateInsulation::countByCode($this->_pdo,$post['code'])>0)$error[]="Ce code est déjà présent dans la base de données.";
            // Si pas d'erreurs on sauvegarde
            if(empty($error)){
                $isDisabled = $post['isDisabled']==1?0:1;
                $obj = MandateInsulation::create($this->_pdo,htmlspecialchars($post['name']),htmlspecialchars($post['code']),$isDisabled);
                Log::create($this->_pdo,time(),'parameters','Ajout d\'une option isolation : '.$obj->getName(),$this->_user);
                header('location:'.Tools::create_url($this->_user,$get['module'],'list_insulation'));
            }
        }
        $this->_smarty->assign('name',empty($post['name'])?'':$post['name']);
        $this->_smarty->assign('code',empty($post['code'])?'':$post['code']);
        $this->_smarty->assign('oldName',empty($post['oldName'])?'':$post['oldName']);
        $this->_smarty->assign('oldCode',empty($post['oldCode'])?'':$post['oldCode']);
        $this->_smarty->assign('idOpt',empty($post['idOpt'])?'':$post['idOpt']);
        $this->_smarty->assign('isDisabled',empty($post['isDisabled'])?'1':$post['isDisabled']);
        $this->_smarty->assign('error',$error);
    }
    private function add_roof($post,$get){
        $error=array();
        $this->_title = 'Ajouter une option de toiture';
        $this->_smarty->assign('h1',$this->_title);
        $this->_smarty->assign('labelName','Nom ');
        $this->_smarty->assign('labelCode','Code ');
        $this->_template =dirname(__FILE__).'/views/add_update.tpl';
        if(isset($post['valider'])){
            if($post['name']=='')$error[]="Le champ nom doit être renseigné.";
            if($post['code']=='')$error[]="Le champ code doit être renseigné.";
            // Code et nom existe deja ...
            if(MandateRoof::countByName($this->_pdo,$post['name'])>0)$error[]="Ce nom est déjà présent dans la base de données.";
            //if(MandateRoof::countByCode($this->_pdo,$post['code'])>0)$error[]="Ce code est déjà présent dans la base de données.";
            // Si pas d'erreurs on sauvegarde
            if(empty($error)){
                $isDisabled = $post['isDisabled']==1?0:1;
                $obj = MandateRoof::create($this->_pdo,htmlspecialchars($post['name']),htmlspecialchars($post['code']),$isDisabled);
                Log::create($this->_pdo,time(),'parameters','Ajout d\'une option de toiture : '.$obj->getName(),$this->_user);
                header('location:'.Tools::create_url($this->_user,$get['module'],'list_roof'));
            }
        }
        $this->_smarty->assign('name',empty($post['name'])?'':$post['name']);
        $this->_smarty->assign('code',empty($post['code'])?'':$post['code']);
        $this->_smarty->assign('oldName',empty($post['oldName'])?'':$post['oldName']);
        $this->_smarty->assign('oldCode',empty($post['oldCode'])?'':$post['oldCode']);
        $this->_smarty->assign('idOpt',empty($post['idOpt'])?'':$post['idOpt']);
        $this->_smarty->assign('isDisabled',empty($post['isDisabled'])?'1':$post['isDisabled']);
        $this->_smarty->assign('error',$error);
    }
    private function add_heating($post,$get){
        $error=array();
        $this->_title = 'Ajouter une option de chauffage';
        $this->_smarty->assign('h1',$this->_title);
        $this->_smarty->assign('labelName','Nom ');
        $this->_smarty->assign('labelCode','Code ');
        $this->_template =dirname(__FILE__).'/views/add_update.tpl';
        if(isset($post['valider'])){
            if($post['name']=='')$error[]="Le champ nom doit être renseigné.";
            if($post['code']=='')$error[]="Le champ code doit être renseigné.";
            // Code et nom existe deja ...
            if(MandateHeating::countByName($this->_pdo,$post['name'])>0)$error[]="Ce nom est déjà présent dans la base de données.";
            //if(MandateHeating::countByCode($this->_pdo,$post['code'])>0)$error[]="Ce code est déjà présent dans la base de données.";
            // Si pas d'erreurs on sauvegarde
            if(empty($error)){
                $isDisabled = $post['isDisabled']==1?0:1;
                $obj = MandateHeating::create($this->_pdo,htmlspecialchars($post['name']),htmlspecialchars($post['code']),$isDisabled);
                Log::create($this->_pdo,time(),'parameters','Ajout d\'une option de chauffage : '.$obj->getName(),$this->_user);
                header('location:'.Tools::create_url($this->_user,$get['module'],'list_heating'));
            }
        }
        $this->_smarty->assign('name',empty($post['name'])?'':$post['name']);
        $this->_smarty->assign('code',empty($post['code'])?'':$post['code']);
        $this->_smarty->assign('oldName',empty($post['oldName'])?'':$post['oldName']);
        $this->_smarty->assign('oldCode',empty($post['oldCode'])?'':$post['oldCode']);
        $this->_smarty->assign('idOpt',empty($post['idOpt'])?'':$post['idOpt']);
        $this->_smarty->assign('isDisabled',empty($post['isDisabled'])?'1':$post['isDisabled']);
        $this->_smarty->assign('error',$error);
    }
    private function add_commonOwnership($post,$get){
        $error=array();
        $this->_title = 'Ajouter une option des parties communes';
        $this->_smarty->assign('h1',$this->_title);
        $this->_smarty->assign('labelName','Nom ');
        $this->_smarty->assign('labelCode','Code ');
        $this->_template =dirname(__FILE__).'/views/add_update.tpl';
        if(isset($post['valider'])){
            if($post['name']=='')$error[]="Le champ nom doit être renseigné.";
            if($post['code']=='')$error[]="Le champ code doit être renseigné.";
            // Code et nom existe deja ...
            if(MandateCommonOwnership::countByName($this->_pdo,$post['name'])>0)$error[]="Ce nom est déjà présent dans la base de données.";
            //if(MandateCommonOwnership::countByCode($this->_pdo,$post['code'])>0)$error[]="Ce code est déjà présent dans la base de données.";
            // Si pas d'erreurs on sauvegarde
            if(empty($error)){
                $isDisabled = $post['isDisabled']==1?0:1;
                $obj = MandateCommonOwnership::create($this->_pdo,htmlspecialchars($post['name']),htmlspecialchars($post['code']),$isDisabled);
                Log::create($this->_pdo,time(),'parameters','Ajout d\'une option des parties communes : '.$obj->getName(),$this->_user);
                header('location:'.Tools::create_url($this->_user,$get['module'],'list_commonOwnership'));
            }
        }
        $this->_smarty->assign('name',empty($post['name'])?'':$post['name']);
        $this->_smarty->assign('code',empty($post['code'])?'':$post['code']);
        $this->_smarty->assign('oldName',empty($post['oldName'])?'':$post['oldName']);
        $this->_smarty->assign('oldCode',empty($post['oldCode'])?'':$post['oldCode']);
        $this->_smarty->assign('idOpt',empty($post['idOpt'])?'':$post['idOpt']);
        $this->_smarty->assign('isDisabled',empty($post['isDisabled'])?'1':$post['isDisabled']);
        $this->_smarty->assign('error',$error);
    }
    private function add_constructionType($post,$get){
        $error=array();
        $this->_title = 'Ajouter une option du type de construction';
        $this->_smarty->assign('h1',$this->_title);
        $this->_smarty->assign('labelName','Nom ');
        $this->_smarty->assign('labelCode','Code ');
        $this->_template =dirname(__FILE__).'/views/add_update.tpl';
        if(isset($post['valider'])){
            if($post['name']=='')$error[]="Le champ nom doit être renseigné.";
            if($post['code']=='')$error[]="Le champ code doit être renseigné.";
            // Code et nom existe deja ...
            if(MandateConstructionType::countByName($this->_pdo,$post['name'])>0)$error[]="Ce nom est déjà présent dans la base de données.";
            //if(MandateConstructionType::countByCode($this->_pdo,$post['code'])>0)$error[]="Ce code est déjà présent dans la base de données.";
            // Si pas d'erreurs on sauvegarde
            if(empty($error)){
                $isDisabled = $post['isDisabled']==1?0:1;
                $obj = MandateConstructionType::create($this->_pdo,htmlspecialchars($post['name']),htmlspecialchars($post['code']),$isDisabled);
                Log::create($this->_pdo,time(),'parameters','Ajout d\'une option du type de construction : '.$obj->getName(),$this->_user);
                header('location:'.Tools::create_url($this->_user,$get['module'],'list_constructionType'));
            }
        }
        $this->_smarty->assign('name',empty($post['name'])?'':$post['name']);
        $this->_smarty->assign('code',empty($post['code'])?'':$post['code']);
        $this->_smarty->assign('oldName',empty($post['oldName'])?'':$post['oldName']);
        $this->_smarty->assign('oldCode',empty($post['oldCode'])?'':$post['oldCode']);
        $this->_smarty->assign('idOpt',empty($post['idOpt'])?'':$post['idOpt']);
        $this->_smarty->assign('isDisabled',empty($post['isDisabled'])?'1':$post['isDisabled']);
        $this->_smarty->assign('error',$error);
    }
    private function add_style($post,$get){
        $error=array();
        $this->_title = 'Ajouter une option du style';
        $this->_smarty->assign('h1',$this->_title);
        $this->_smarty->assign('labelName','Nom ');
        $this->_smarty->assign('labelCode','Code ');
        $this->_template =dirname(__FILE__).'/views/add_update.tpl';
        if(isset($post['valider'])){
            if($post['name']=='')$error[]="Le champ nom doit être renseigné.";
            if($post['code']=='')$error[]="Le champ code doit être renseigné.";
            // Code et nom existe deja ...
            if(MandateStyle::countByName($this->_pdo,$post['name'])>0)$error[]="Ce nom est déjà présent dans la base de données.";
            //if(MandateStyle::countByCode($this->_pdo,$post['code'])>0)$error[]="Ce code est déjà présent dans la base de données.";
            // Si pas d'erreurs on sauvegarde
            if(empty($error)){
                $isDisabled = $post['isDisabled']==1?0:1;
                $obj = MandateStyle::create($this->_pdo,htmlspecialchars($post['name']),htmlspecialchars($post['code']),$isDisabled);
                Log::create($this->_pdo,time(),'parameters','Ajout d\'une option du style : '.$obj->getName(),$this->_user);
                header('location:'.Tools::create_url($this->_user,$get['module'],'list_style'));
            }
        }
        $this->_smarty->assign('name',empty($post['name'])?'':$post['name']);
        $this->_smarty->assign('code',empty($post['code'])?'':$post['code']);
        $this->_smarty->assign('oldName',empty($post['oldName'])?'':$post['oldName']);
        $this->_smarty->assign('oldCode',empty($post['oldCode'])?'':$post['oldCode']);
        $this->_smarty->assign('idOpt',empty($post['idOpt'])?'':$post['idOpt']);
        $this->_smarty->assign('isDisabled',empty($post['isDisabled'])?'1':$post['isDisabled']);
        $this->_smarty->assign('error',$error);
    }
    private function add_news($post,$get){
        $error=array();
        $this->_title = 'Ajouter une option de nouveauté';
        $this->_smarty->assign('h1',$this->_title);
        $this->_smarty->assign('labelName','Nom ');
        $this->_smarty->assign('labelCode','Code ');
        $this->_template =dirname(__FILE__).'/views/add_update.tpl';
        if(isset($post['valider'])){
            if($post['name']=='')$error[]="Le champ nom doit être renseigné.";
            if($post['code']=='')$error[]="Le champ code doit être renseigné.";
            // Code et nom existe deja ...
            if(MandateNews::countByName($this->_pdo,$post['name'])>0)$error[]="Ce nom est déjà présent dans la base de données.";
            //if(MandateNews::countByCode($this->_pdo,$post['code'])>0)$error[]="Ce code est déjà présent dans la base de données.";
            // Si pas d'erreurs on sauvegarde
            if(empty($error)){
                $isDisabled = $post['isDisabled']==1?0:1;
                $obj = MandateNews::create($this->_pdo,htmlspecialchars($post['name']),htmlspecialchars($post['code']),$isDisabled);
                Log::create($this->_pdo,time(),'parameters','Ajout d\'une option de nouveauté : '.$obj->getName(),$this->_user);
                header('location:'.Tools::create_url($this->_user,$get['module'],'list_news'));
            }
        }
        $this->_smarty->assign('name',empty($post['name'])?'':$post['name']);
        $this->_smarty->assign('code',empty($post['code'])?'':$post['code']);
        $this->_smarty->assign('oldName',empty($post['oldName'])?'':$post['oldName']);
        $this->_smarty->assign('oldCode',empty($post['oldCode'])?'':$post['oldCode']);
        $this->_smarty->assign('idOpt',empty($post['idOpt'])?'':$post['idOpt']);
        $this->_smarty->assign('isDisabled',empty($post['isDisabled'])?'1':$post['isDisabled']);
        $this->_smarty->assign('error',$error);
    }
    private function add_condition($post,$get){
        $error=array();
        $this->_title = 'Ajouter une option de condition';
        $this->_smarty->assign('h1',$this->_title);
        $this->_smarty->assign('labelName','Nom ');
        $this->_smarty->assign('labelCode','Code ');
        $this->_template =dirname(__FILE__).'/views/add_update.tpl';
        if(isset($post['valider'])){
            if($post['name']=='')$error[]="Le champ nom doit être renseigné.";
            if($post['code']=='')$error[]="Le champ code doit être renseigné.";
            // Code et nom existe deja ...
            if(MandateCondition::countByName($this->_pdo,$post['name'])>0)$error[]="Ce nom est déjà présent dans la base de données.";
            //if(MandateCondition::countByCode($this->_pdo,$post['code'])>0)$error[]="Ce code est déjà présent dans la base de données.";
            // Si pas d'erreurs on sauvegarde
            if(empty($error)){
                $isDisabled = $post['isDisabled']==1?0:1;
                $obj = MandateCondition::create($this->_pdo,htmlspecialchars($post['name']),htmlspecialchars($post['code']),$isDisabled);
                Log::create($this->_pdo,time(),'parameters','Ajout d\'une option de condition : '.$obj->getName(),$this->_user);
                header('location:'.Tools::create_url($this->_user,$get['module'],'list_condition'));
            }
        }
        $this->_smarty->assign('name',empty($post['name'])?'':$post['name']);
        $this->_smarty->assign('code',empty($post['code'])?'':$post['code']);
        $this->_smarty->assign('oldName',empty($post['oldName'])?'':$post['oldName']);
        $this->_smarty->assign('oldCode',empty($post['oldCode'])?'':$post['oldCode']);
        $this->_smarty->assign('idOpt',empty($post['idOpt'])?'':$post['idOpt']);
        $this->_smarty->assign('isDisabled',empty($post['isDisabled'])?'1':$post['isDisabled']);
        $this->_smarty->assign('error',$error);
    }
    private function add_nature($post,$get){
        $error=array();
        $this->_title = 'Ajouter une option de nature';
        $this->_smarty->assign('h1',$this->_title);
        $this->_smarty->assign('labelName','Nom ');
        $this->_smarty->assign('labelCode','Code ');
        $this->_template =dirname(__FILE__).'/views/add_update.tpl';
        if(isset($post['valider'])){
            if($post['name']=='')$error[]="Le champ nom doit être renseigné.";
            if($post['code']=='')$error[]="Le champ code doit être renseigné.";
            // Code et nom existe deja ...
            if(MandateNature::countByName($this->_pdo,$post['name'])>0)$error[]="Ce nom est déjà présent dans la base de données.";
            //if(MandateNature::countByCode($this->_pdo,$post['code'])>0)$error[]="Ce code est déjà présent dans la base de données.";
            // Si pas d'erreurs on sauvegarde
            if(empty($error)){
                $isDisabled = $post['isDisabled']==1?0:1;
                $obj = MandateNature::create($this->_pdo,htmlspecialchars($post['code']),htmlspecialchars($post['name']),$isDisabled);
                Log::create($this->_pdo,time(),'parameters','Ajout de l\'option de nature : '.$obj->getName(),$this->_user);
                header('location:'.Tools::create_url($this->_user,$get['module'],'list_nature'));
            }
        }
        $this->_smarty->assign('name',empty($post['name'])?'':$post['name']);
        $this->_smarty->assign('code',empty($post['code'])?'':$post['code']);
        $this->_smarty->assign('oldName',empty($post['oldName'])?'':$post['oldName']);
        $this->_smarty->assign('oldCode',empty($post['oldCode'])?'':$post['oldCode']);
        $this->_smarty->assign('idOpt',empty($post['idOpt'])?'':$post['idOpt']);
        $this->_smarty->assign('isDisabled',empty($post['isDisabled'])?'1':$post['isDisabled']);
        $this->_smarty->assign('error',$error);
    }
    private function add_city($post,$get){
        $error=array();
        $this->_title = 'Ajouter une ville';
        // Concerne toute les actions de ville
        if(Sector::count($this->_pdo) ==0){
            $this->_template = dirname(__FILE__).'/views/add_sector_first.tpl';
            // Pas de secteur, on doit en sauver 1 avant
            // tpl erreur
        }else{
            $this->_template = dirname(__FILE__).'/views/add_city.tpl';
            $this->_smarty->assign('listOfSector',Sector::loadAll( $this->_pdo ) );
            if(isset($post['sector_add_city_cancel'])){
                header('location:'.Tools::create_url($this->_user,$get['module']));
            }
            if(isset($post['sector_add_city_send'])){
                // verif
                $error = array();
                // 	Ville et cp non vide
                if(empty($post['zipCode'])||$post['zipCode']=='')
                    $error[]=Lang::ERROR_CITY_ADD_EMPTY_ZIPCODE;
                if(empty($post['city_add_name'])||$post['city_add_name']=='')
                    $error[]=Lang::ERROR_CITY_ADD_EMPTY_CITY;
                elseif(City::count($this->_pdo,' name = '."'".htmlspecialchars(addslashes(strtoupper($post['city_add_name'])))."'" )!=0){
                    $error[]=Lang::ERROR_CITY_ADD_CITY_IS_IN_DB;
                }
                if(empty($error)){
                    $sector = Sector::load($this->_pdo,$post['idSector']);
                    $city = City::create($this->_pdo,$post['city_add_name'],$post['zipCode'],0,$sector);
                    $sector->setNumberUsed( $sector->getNumberUsed()+1 );
                    Log::create($this->_pdo,time(),'parameters','Ajout de la ville : '.$city->getName(),$this->_user);
                    header('location:'.Tools::create_url($this->_user,$get['module'],'list_cities'));
                }
            }
        }

        $this->_smarty->assign('error',$error);
    }
    private function add_sector($post,$get){
        $error='';
        $this->_title = 'Ajouter un secteur';
        $this->_template = dirname(__FILE__).'/views/add_sector.tpl';
        if(isset($post['send_sector'])){
            if (empty($post['sector_name'])||trim($post['sector_name'])=='')
                $error = Lang::ERROR_EMPTY_SECTOR_NAME;
            if(!$error){
                $sector = Sector::create($this->_pdo,$post['sector_name'],0);
                Log::create($this->_pdo,time(),"parameters",' Ajout du secteur : '.$sector->getName(),$this->_user);
                header('location:'.Tools::create_url($this->_user,$get['module'],'list_sectors'));
            }
        }
        $this->_smarty->assign('error',$error);
    }
    /*
     * Fin Add
     */

    public function displayTpl( ){
        $this->_smarty->display('tpl_default/header.tpl');
        $this->_smarty->display( $this->_template );
        $this->_smarty->display('tpl_default/footer.tpl');
    }

    private function _addMainMenu(){
        $this->_smarty->assign('mainMenu',$this->getMainMenu($this->_user ));
    }
    private function _addMenu($module){
        $this->_smarty->assign('menu',$this->getMenu($this->_user ,$module ) );
    }
}