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
				Log::create($this->_pdo,time(),"mandate_features",'accès non autorisé',$this->_user );
			} else{
				$this->_template = dirname(__FILE__).'/views/default.tpl';
				$this->_addMainMenu();
				$this->_addMenu('mandate_features');
				$this->_title = 'Gestion des attributs de mandats';
			}
		}
	}

	public function addMeta(){
		$this->_smarty->assign('title',	$this->_title );
	}
	private function _treatment( $post,$get){
		$error = array();

		if(isset($get['page'])&&$get['page']=='log'){
			$this->_title = 'Logs du module';
			$this->_template =dirname(__FILE__).'/views/log.tpl';
			$a = Log::selectByModule($this->_pdo,'mandate_features');
			while($logs = Log::fetch($this->_pdo,$a)){
				$arrayLog[] = $logs;
				$this->_smarty->assign('arrayLog', $arrayLog );}
		}
		/*/***************************
		 * BORNAGE TERRAIN LAU
		 ***************************/
		// ajout
		elseif(isset($get['page'])&&$get['page']=='add_bornage_terrain'){
			$this->_title = 'Ajouter une option de bornage terrain';
			$this->_smarty->assign('h1',$this->_title);
			$this->_smarty->assign('labelName','Nom ');
			$this->_smarty->assign('labelCode','Code ');
			$this->_template =dirname(__FILE__).'/views/add_update.tpl';
			if(isset($post['valider'])){
				if($post['name']=='')$error[]="Le champ nom doit être renseigné.";
				if($post['code']=='')$error[]="Le champ code doit être renseigné.";
				// Code et nom existe deja ...
				if(MandateBornageTerrain::countByName($this->_pdo,$post['name'])>0)$error[]="Ce nom est déjà présent dans la base de données.";
				//if(MandateBornageTerrain::countByCode($this->_pdo,$post['code'])>0)$error[]="Ce code est déjà présent dans la base de données.";
				// Si pas d'erreurs on sauvegarde
				if(empty($error)){
					$isDisabled = $post['isDisabled']==1?0:1;
					$obj = MandateBornageTerrain::create($this->_pdo,htmlspecialchars($post['name']),htmlspecialchars($post['code']),$isDisabled);
					Log::create($this->_pdo,time(),'mandate_features','Ajout de l\'action bornage de terrain : '.$obj->getName(),$this->_user);
					header('location:'.Tools::create_url($this->_user,$get['module']));
				}
			}
			$this->_smarty->assign('name',empty($post['name'])?'':$post['name']);
			$this->_smarty->assign('code',empty($post['code'])?'':$post['code']);
			$this->_smarty->assign('oldName',empty($post['oldName'])?'':$post['oldName']);
			$this->_smarty->assign('oldCode',empty($post['oldCode'])?'':$post['oldCode']);
			$this->_smarty->assign('idOpt',empty($post['idOpt'])?'':$post['idOpt']);
			$this->_smarty->assign('isDisabled',empty($post['isDisabled'])?'1':$post['isDisabled']);
		}
		// liste
		elseif(isset($get['page'])&&$get['page']=='list_bornage_terrain'){
			$this->_title = 'Liste des options de bornage terrain';
			$this->_smarty->assign('h1',$this->_title);
			$this->_template =dirname(__FILE__).'/views/list.tpl';
			$this->_smarty->assign('list',MandateBornageTerrain::loadAll($this->_pdo,1));
			$this->_smarty->assign('page','upd_bornage_terrain');
		}
		// update
		elseif(isset($get['page'])&&$get['page']=='upd_bornage_terrain'){
			$this->_title = 'Mise à jour de l\'option de bornage terrain';
			$this->_smarty->assign('h1',$this->_title);
			$this->_template =dirname(__FILE__).'/views/add_update.tpl';
			$this->_smarty->assign('h1',$this->_title);
			$this->_smarty->assign('labelName','Nom ');
			$this->_smarty->assign('labelCode','Code ');
			$opt = MandateBornageTerrain::load($this->_pdo,$get['action']);
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
				if(MandateBornageTerrain::countByName($this->_pdo,$post['name'])>0)$error[]="Ce nom est déjà présent dans la base de données.";
				//if( strtoupper($oldCode) != strtoupper($code) )
				//if(MandateBornageTerrain::countByCode($this->_pdo,$post['code'])>0)$error[]="Ce code est déjà présent dans la base de données.";
				if(empty($error)){
					$opt->setName($name,false);
					$opt->setCode($code,false);
					$opt->setIsDisabled($isDisabled?0:1,false);
					$opt->update();
					Log::create($this->_pdo,time(),'mandate_features','Mise à jour du bornage terrain : '.$opt->getName(),$this->_user);
					header('location:'.Tools::create_url($this->_user,$get['module'],'list_bornage_terrain'));
				}
			}
			$this->_smarty->assign('name',$name);
			$this->_smarty->assign('isDisabled',$isDisabled);
			$this->_smarty->assign('code',$code);
			$this->_smarty->assign('oldName',$oldName);
			$this->_smarty->assign('oldCode',$oldCode);
			$this->_smarty->assign('idOpt',$idOpt);
		}

		/***************************
		 * Orientation LAU
		 ***************************/
		// ajout
		elseif(isset($get['page'])&&$get['page']=='add_orientation'){
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
					Log::create($this->_pdo,time(),'mandate_features','Ajout de l\'orientation de terrain : '.$obj->getName(),$this->_user);
					header('location:'.Tools::create_url($this->_user,$get['module']));
				}
			}
			$this->_smarty->assign('name',empty($post['name'])?'':$post['name']);
			$this->_smarty->assign('code',empty($post['code'])?'':$post['code']);
			$this->_smarty->assign('oldName',empty($post['oldName'])?'':$post['oldName']);
			$this->_smarty->assign('oldCode',empty($post['oldCode'])?'':$post['oldCode']);
			$this->_smarty->assign('idOpt',empty($post['idOpt'])?'':$post['idOpt']);
			$this->_smarty->assign('isDisabled',empty($post['isDisabled'])?'1':$post['isDisabled']);
		}
		// liste
		elseif(isset($get['page'])&&$get['page']=='list_orientation'){
			$this->_title = 'Liste des options d\'orientation terrain';
			$this->_smarty->assign('h1',$this->_title);
			$this->_template =dirname(__FILE__).'/views/list.tpl';
			$this->_smarty->assign('list',MandateOrientation::loadAll($this->_pdo,1));
			$this->_smarty->assign('page','upd_orientation');
		}
		// update
		elseif(isset($get['page'])&&$get['page']=='upd_orientation'){
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
					Log::create($this->_pdo,time(),'mandate_features','Mise à jour de l\'orientation terrain : '.$opt->getName(),$this->_user);
					header('location:'.Tools::create_url($this->_user,$get['module'],'list_orientation'));
				}
			}
			$this->_smarty->assign('name',$name);
			$this->_smarty->assign('isDisabled',$isDisabled);
			$this->_smarty->assign('code',$code);
			$this->_smarty->assign('oldName',$oldName);
			$this->_smarty->assign('oldCode',$oldCode);
			$this->_smarty->assign('idOpt',$idOpt);
		}
		/***************************
		 * Nature LAU
		 ***************************/
		// ajout
		elseif(isset($get['page'])&&$get['page']=='add_nature'){
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
					Log::create($this->_pdo,time(),'mandate_features','Ajout de l\'option de nature : '.$obj->getName(),$this->_user);
					header('location:'.Tools::create_url($this->_user,$get['module']));
				}
			}
			$this->_smarty->assign('name',empty($post['name'])?'':$post['name']);
			$this->_smarty->assign('code',empty($post['code'])?'':$post['code']);
			$this->_smarty->assign('oldName',empty($post['oldName'])?'':$post['oldName']);
			$this->_smarty->assign('oldCode',empty($post['oldCode'])?'':$post['oldCode']);
			$this->_smarty->assign('idOpt',empty($post['idOpt'])?'':$post['idOpt']);
			$this->_smarty->assign('isDisabled',empty($post['isDisabled'])?'1':$post['isDisabled']);
		}
		// liste
		elseif(isset($get['page'])&&$get['page']=='list_nature'){
			$this->_title = 'Liste des options de nature';
			$this->_smarty->assign('h1',$this->_title);
			$this->_template =dirname(__FILE__).'/views/list.tpl';
			$this->_smarty->assign('list',MandateNature::loadAll($this->_pdo,1));
			$this->_smarty->assign('page','upd_nature');
		}
		// update
		elseif(isset($get['page'])&&$get['page']=='upd_nature'){
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
					Log::create($this->_pdo,time(),'mandate_features','Mise à jour de la nature : '.$opt->getName(),$this->_user);
					header('location:'.Tools::create_url($this->_user,$get['module'],'list_nature'));
				}
			}
			$this->_smarty->assign('name',$name);
			$this->_smarty->assign('code',$code);
			$this->_smarty->assign('oldName',$oldName);
			$this->_smarty->assign('oldCode',$oldCode);
			$this->_smarty->assign('idOpt',$idOpt);
			$this->_smarty->assign('isDisabled',$isDisabled);
		}







		/***************************
		 * Slope LAU
		 ***************************/
		// ajout
		elseif(isset($get['page'])&&$get['page']=='add_slope'){
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
					Log::create($this->_pdo,time(),'mandate_features','Ajout de l\'option de pente : '.$obj->getName(),$this->_user);
					header('location:'.Tools::create_url($this->_user,$get['module']));
				}
			}
			$this->_smarty->assign('name',empty($post['name'])?'':$post['name']);
			$this->_smarty->assign('code',empty($post['code'])?'':$post['code']);
			$this->_smarty->assign('oldName',empty($post['oldName'])?'':$post['oldName']);
			$this->_smarty->assign('oldCode',empty($post['oldCode'])?'':$post['oldCode']);
			$this->_smarty->assign('idOpt',empty($post['idOpt'])?'':$post['idOpt']);
			$this->_smarty->assign('isDisabled',empty($post['isDisabled'])?'1':$post['isDisabled']);
		}
		// liste
		elseif(isset($get['page'])&&$get['page']=='list_slope'){
			$this->_title = 'Liste des options de pente';
			$this->_smarty->assign('h1',$this->_title);
			$this->_template =dirname(__FILE__).'/views/list.tpl';
			$this->_smarty->assign('list',MandateSlope::loadAll($this->_pdo,1));
			$this->_smarty->assign('page','upd_slope');
		}
		// update
		elseif(isset($get['page'])&&$get['page']=='upd_slope'){
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
					Log::create($this->_pdo,time(),'mandate_features','Mise à jour de la pente : '.$opt->getName(),$this->_user);
					header('location:'.Tools::create_url($this->_user,$get['module'],'list_slope'));
				}
			}
			$this->_smarty->assign('name',$name);
			$this->_smarty->assign('code',$code);
			$this->_smarty->assign('oldName',$oldName);
			$this->_smarty->assign('oldCode',$oldCode);
			$this->_smarty->assign('idOpt',$idOpt);
			$this->_smarty->assign('isDisabled',$isDisabled);
		}

		/***************************
		 * Plu LAU
		 ***************************/
		// ajout
		elseif(isset($get['page'])&&$get['page']=='add_plu'){
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
					Log::create($this->_pdo,time(),'mandate_features','Ajout du zonage PLU : '.$obj->getName(),$this->_user);
					header('location:'.Tools::create_url($this->_user,$get['module']));
				}
			}
			$this->_smarty->assign('name',empty($post['name'])?'':$post['name']);
			$this->_smarty->assign('code',empty($post['code'])?'':$post['code']);
			$this->_smarty->assign('oldName',empty($post['oldName'])?'':$post['oldName']);
			$this->_smarty->assign('oldCode',empty($post['oldCode'])?'':$post['oldCode']);
			$this->_smarty->assign('idOpt',empty($post['idOpt'])?'':$post['idOpt']);
			$this->_smarty->assign('isDisabled',empty($post['isDisabled'])?'1':$post['isDisabled']);
		}
		// liste
		elseif(isset($get['page'])&&$get['page']=='list_plu'){
			$this->_title = 'Liste des options de zonage PLU';
			$this->_smarty->assign('h1',$this->_title);
			$this->_template =dirname(__FILE__).'/views/list.tpl';
			$this->_smarty->assign('list',MandateZonagePLU::loadAll($this->_pdo,1));
			$this->_smarty->assign('page','upd_plu');
		}
		// update
		elseif(isset($get['page'])&&$get['page']=='upd_plu'){
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
					Log::create($this->_pdo,time(),'mandate_features','Mise à jour du zonage PLU  : '.$opt->getName(),$this->_user);
					header('location:'.Tools::create_url($this->_user,$get['module'],'list_plu'));
				}
			}
			$this->_smarty->assign('name',$name);
			$this->_smarty->assign('code',$code);
			$this->_smarty->assign('oldName',$oldName);
			$this->_smarty->assign('oldCode',$oldCode);
			$this->_smarty->assign('idOpt',$idOpt);
			$this->_smarty->assign('isDisabled',$isDisabled);
		}
		/***************************
		 * 			Rnu LAU
		 ***************************/
		// ajout
		elseif(isset($get['page'])&&$get['page']=='add_rnu'){
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
					Log::create($this->_pdo,time(),'mandate_features','Ajout du zonage RNU : '.$obj->getName(),$this->_user);
					header('location:'.Tools::create_url($this->_user,$get['module']));
				}
			}
			$this->_smarty->assign('name',empty($post['name'])?'':$post['name']);
			$this->_smarty->assign('code',empty($post['code'])?'':$post['code']);
			$this->_smarty->assign('oldName',empty($post['oldName'])?'':$post['oldName']);
			$this->_smarty->assign('oldCode',empty($post['oldCode'])?'':$post['oldCode']);
			$this->_smarty->assign('idOpt',empty($post['idOpt'])?'':$post['idOpt']);
			$this->_smarty->assign('isDisabled',empty($post['isDisabled'])?'1':$post['isDisabled']);
		}
		// liste
		elseif(isset($get['page'])&&$get['page']=='list_rnu'){
			$this->_title = 'Liste des options de zonage RNU';
			$this->_smarty->assign('h1',$this->_title);
			$this->_template =dirname(__FILE__).'/views/list.tpl';
			$this->_smarty->assign('list',MandateZonageRNU::loadAll($this->_pdo,1));
			$this->_smarty->assign('page','upd_rnu');
		}
		// update
		elseif(isset($get['page'])&&$get['page']=='upd_rnu'){
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
					Log::create($this->_pdo,time(),'mandate_features','Mise à jour du zonage RNU  : '.$opt->getName(),$this->_user);
					header('location:'.Tools::create_url($this->_user,$get['module'],'list_rnu'));
				}
			}
			$this->_smarty->assign('name',$name);
			$this->_smarty->assign('code',$code);
			$this->_smarty->assign('oldName',$oldName);
			$this->_smarty->assign('oldCode',$oldCode);
			$this->_smarty->assign('idOpt',$idOpt);
			$this->_smarty->assign('isDisabled',$isDisabled);
		}
		/***************************
		 * Geometer LAU
		 ***************************/
		// ajout
		elseif(isset($get['page'])&&$get['page']=='add_geometer'){
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
					Log::create($this->_pdo,time(),'mandate_features','Ajout d\'un géometre : '.$obj->getName(),$this->_user);
					header('location:'.Tools::create_url($this->_user,$get['module']));
				}
			}
			$this->_smarty->assign('name',empty($post['name'])?'':$post['name']);
			$this->_smarty->assign('code',empty($post['code'])?'':$post['code']);
			$this->_smarty->assign('oldName',empty($post['oldName'])?'':$post['oldName']);
			$this->_smarty->assign('oldCode',empty($post['oldCode'])?'':$post['oldCode']);
			$this->_smarty->assign('idOpt',empty($post['idOpt'])?'':$post['idOpt']);
			$this->_smarty->assign('isDisabled',empty($post['isDisabled'])?'1':$post['isDisabled']);
		}
		// liste
		elseif(isset($get['page'])&&$get['page']=='list_geometer'){
			$this->_title = 'Liste des géometres';
			$this->_smarty->assign('h1',$this->_title);
			$this->_template =dirname(__FILE__).'/views/list.tpl';
			$this->_smarty->assign('list',MandateGeometer::loadAll($this->_pdo,1));
			$this->_smarty->assign('page','upd_geometer');
		}
		// update
		elseif(isset($get['page'])&&$get['page']=='upd_geometer'){
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
					Log::create($this->_pdo,time(),'mandate_features','Mise à jour du géometre  : '.$opt->getName(),$this->_user);
					header('location:'.Tools::create_url($this->_user,$get['module'],'list_geometer'));
				}
			}
			$this->_smarty->assign('name',$name);
			$this->_smarty->assign('code',$code);
			$this->_smarty->assign('oldName',$oldName);
			$this->_smarty->assign('oldCode',$oldCode);
			$this->_smarty->assign('idOpt',$idOpt);
			$this->_smarty->assign('isDisabled',$isDisabled);
		}
		/***************************
		 * Water corresponding LAU
		 ***************************/
		// ajout
		elseif(isset($get['page'])&&$get['page']=='add_water_corresponding'){
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
					Log::create($this->_pdo,time(),'mandate_features','Ajout d\'un correspondant eau : '.$obj->getName(),$this->_user);
					header('location:'.Tools::create_url($this->_user,$get['module']));
				}
			}
			$this->_smarty->assign('name',empty($post['name'])?'':$post['name']);
			$this->_smarty->assign('code',empty($post['code'])?'':$post['code']);
			$this->_smarty->assign('oldName',empty($post['oldName'])?'':$post['oldName']);
			$this->_smarty->assign('oldCode',empty($post['oldCode'])?'':$post['oldCode']);
			$this->_smarty->assign('idOpt',empty($post['idOpt'])?'':$post['idOpt']);
			$this->_smarty->assign('isDisabled',empty($post['isDisabled'])?'1':$post['isDisabled']);
		}
		// liste
		elseif(isset($get['page'])&&$get['page']=='list_water_corresponding'){
			$this->_title = 'Liste des correspondants eau';
			$this->_smarty->assign('h1',$this->_title);
			$this->_template =dirname(__FILE__).'/views/list.tpl';
			$this->_smarty->assign('list',MandateWaterCorresponding::loadAll($this->_pdo,1));
			$this->_smarty->assign('page','upd_water_corresponding');
		}
		// update
		elseif(isset($get['page'])&&$get['page']=='upd_water_corresponding'){
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
					Log::create($this->_pdo,time(),'mandate_features','Mise à jour du correspondant eau  : '.$opt->getName(),$this->_user);
					header('location:'.Tools::create_url($this->_user,$get['module'],'list_water_corresponding'));
				}
			}
			$this->_smarty->assign('name',$name);
			$this->_smarty->assign('code',$code);
			$this->_smarty->assign('oldName',$oldName);
			$this->_smarty->assign('oldCode',$oldCode);
			$this->_smarty->assign('idOpt',$idOpt);
			$this->_smarty->assign('isDisabled',$isDisabled);
		}
		/***************************
		 * Electic corresponding LAU
		 ***************************/
		// ajout
		elseif(isset($get['page'])&&$get['page']=='add_electric_corresponding'){
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
					Log::create($this->_pdo,time(),'mandate_features','Ajout d\'un correspondant électricité : '.$obj->getName(),$this->_user);
					header('location:'.Tools::create_url($this->_user,$get['module']));
				}
			}
			$this->_smarty->assign('name',empty($post['name'])?'':$post['name']);
			$this->_smarty->assign('code',empty($post['code'])?'':$post['code']);
			$this->_smarty->assign('oldName',empty($post['oldName'])?'':$post['oldName']);
			$this->_smarty->assign('oldCode',empty($post['oldCode'])?'':$post['oldCode']);
			$this->_smarty->assign('idOpt',empty($post['idOpt'])?'':$post['idOpt']);
			$this->_smarty->assign('isDisabled',empty($post['isDisabled'])?'1':$post['isDisabled']);
		}
		// liste
		elseif(isset($get['page'])&&$get['page']=='list_electric_corresponding'){
			$this->_title = 'Liste des correspondants électricité';
			$this->_smarty->assign('h1',$this->_title);
			$this->_template =dirname(__FILE__).'/views/list.tpl';
			$this->_smarty->assign('list',MandateElectricCorresponding::loadAll($this->_pdo,1));
			$this->_smarty->assign('page','upd_electric_corresponding');
		}
		// update
		elseif(isset($get['page'])&&$get['page']=='upd_electric_corresponding'){
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
					Log::create($this->_pdo,time(),'mandate_features','Mise à jour du correspondant électricité  : '.$opt->getName(),$this->_user);
					header('location:'.Tools::create_url($this->_user,$get['module'],'list_electric_corresponding'));
				}
			}
			$this->_smarty->assign('name',$name);
			$this->_smarty->assign('code',$code);
			$this->_smarty->assign('oldName',$oldName);
			$this->_smarty->assign('oldCode',$oldCode);
			$this->_smarty->assign('idOpt',$idOpt);
			$this->_smarty->assign('isDisabled',$isDisabled);
		}
		/***************************
		 * Gaz corresponding LAU
		 ***************************/
		// ajout
		elseif(isset($get['page'])&&$get['page']=='add_gaz_corresponding'){
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
					Log::create($this->_pdo,time(),'mandate_features','Ajout d\'un correspondant gaz : '.$obj->getName(),$this->_user);
					header('location:'.Tools::create_url($this->_user,$get['module']));
				}
			}
			$this->_smarty->assign('name',empty($post['name'])?'':$post['name']);
			$this->_smarty->assign('code',empty($post['code'])?'':$post['code']);
			$this->_smarty->assign('oldName',empty($post['oldName'])?'':$post['oldName']);
			$this->_smarty->assign('oldCode',empty($post['oldCode'])?'':$post['oldCode']);
			$this->_smarty->assign('idOpt',empty($post['idOpt'])?'':$post['idOpt']);
			$this->_smarty->assign('isDisabled',empty($post['isDisabled'])?'1':$post['isDisabled']);
		}
		// liste
		elseif(isset($get['page'])&&$get['page']=='list_gaz_corresponding'){
			$this->_title = 'Liste des correspondants gaz';
			$this->_smarty->assign('h1',$this->_title);
			$this->_template =dirname(__FILE__).'/views/list.tpl';
			$this->_smarty->assign('list',MandateGazCorresponding::loadAll($this->_pdo,1));
			$this->_smarty->assign('page','upd_gaz_corresponding');
		}
		// update
		elseif(isset($get['page'])&&$get['page']=='upd_gaz_corresponding'){
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
					Log::create($this->_pdo,time(),'mandate_features','Mise à jour du correspondant gaz  : '.$opt->getName(),$this->_user);
					header('location:'.Tools::create_url($this->_user,$get['module'],'list_gaz_corresponding'));
				}
			}
			$this->_smarty->assign('name',$name);
			$this->_smarty->assign('code',$code);
			$this->_smarty->assign('oldName',$oldName);
			$this->_smarty->assign('oldCode',$oldCode);
			$this->_smarty->assign('idOpt',$idOpt);
			$this->_smarty->assign('isDisabled',$isDisabled);
		}
		/***************************
		 * Sanitation corresponding LAU
		 ***************************/
		// ajout
		elseif(isset($get['page'])&&$get['page']=='add_sanitation_corresponding'){
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
					Log::create($this->_pdo,time(),'mandate_features','Ajout d\'un correspondant assainissement : '.$obj->getName(),$this->_user);
					header('location:'.Tools::create_url($this->_user,$get['module']));
				}
			}
			$this->_smarty->assign('name',empty($post['name'])?'':$post['name']);
			$this->_smarty->assign('code',empty($post['code'])?'':$post['code']);
			$this->_smarty->assign('oldName',empty($post['oldName'])?'':$post['oldName']);
			$this->_smarty->assign('oldCode',empty($post['oldCode'])?'':$post['oldCode']);
			$this->_smarty->assign('idOpt',empty($post['idOpt'])?'':$post['idOpt']);
			$this->_smarty->assign('isDisabled',empty($post['isDisabled'])?'1':$post['isDisabled']);
		}
		// liste
		elseif(isset($get['page'])&&$get['page']=='list_sanitation_corresponding'){
			$this->_title = 'Liste des correspondants assainissement';
			$this->_smarty->assign('h1',$this->_title);
			$this->_template =dirname(__FILE__).'/views/list.tpl';
			$this->_smarty->assign('list',MandateSanitationCorresponding::loadAll($this->_pdo,1));
			$this->_smarty->assign('page','upd_sanitation_corresponding');
		}
		// update
		elseif(isset($get['page'])&&$get['page']=='upd_sanitation_corresponding'){
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
					Log::create($this->_pdo,time(),'mandate_features','Mise à jour du correspondant assainissement  : '.$opt->getName(),$this->_user);
					header('location:'.Tools::create_url($this->_user,$get['module'],'list_sanitation_corresponding'));
				}
			}
			$this->_smarty->assign('name',$name);
			$this->_smarty->assign('code',$code);
			$this->_smarty->assign('oldName',$oldName);
			$this->_smarty->assign('oldCode',$oldCode);
			$this->_smarty->assign('idOpt',$idOpt);
			$this->_smarty->assign('isDisabled',$isDisabled);
		}
		/***************************
		 * COS LAU
		 ***************************/
		// ajout
		elseif(isset($get['page'])&&$get['page']=='add_cos'){
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
					Log::create($this->_pdo,time(),'mandate_features','Ajout d\'une option COS : '.$obj->getName(),$this->_user);
					header('location:'.Tools::create_url($this->_user,$get['module']));
				}
			}
			$this->_smarty->assign('name',empty($post['name'])?'':$post['name']);
			$this->_smarty->assign('code',empty($post['code'])?'':$post['code']);
			$this->_smarty->assign('oldName',empty($post['oldName'])?'':$post['oldName']);
			$this->_smarty->assign('oldCode',empty($post['oldCode'])?'':$post['oldCode']);
			$this->_smarty->assign('idOpt',empty($post['idOpt'])?'':$post['idOpt']);
			$this->_smarty->assign('isDisabled',empty($post['isDisabled'])?'1':$post['isDisabled']);
		}
		// liste
		elseif(isset($get['page'])&&$get['page']=='list_cos'){
			$this->_title = 'Liste des options COS';
			$this->_smarty->assign('h1',$this->_title);
			$this->_template =dirname(__FILE__).'/views/list.tpl';
			$this->_smarty->assign('list',MandateCos::loadAll($this->_pdo,1));
			$this->_smarty->assign('page','upd_cos');
		}
		// update
		elseif(isset($get['page'])&&$get['page']=='upd_cos'){
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
					Log::create($this->_pdo,time(),'mandate_features','Mise à jour de l\'option COS  : '.$opt->getName(),$this->_user);
					header('location:'.Tools::create_url($this->_user,$get['module'],'list_cos'));
				}
			}
			$this->_smarty->assign('name',$name);
			$this->_smarty->assign('code',$code);
			$this->_smarty->assign('oldName',$oldName);
			$this->_smarty->assign('oldCode',$oldCode);
			$this->_smarty->assign('idOpt',$idOpt);
			$this->_smarty->assign('isDisabled',$isDisabled);
		}

		/***************************
		 * Insulation LAU
		 ***************************/
		// ajout
		elseif(isset($get['page'])&&$get['page']=='add_insulation'){
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
					Log::create($this->_pdo,time(),'mandate_features','Ajout d\'une option isolation : '.$obj->getName(),$this->_user);
					header('location:'.Tools::create_url($this->_user,$get['module']));
				}
			}
			$this->_smarty->assign('name',empty($post['name'])?'':$post['name']);
			$this->_smarty->assign('code',empty($post['code'])?'':$post['code']);
			$this->_smarty->assign('oldName',empty($post['oldName'])?'':$post['oldName']);
			$this->_smarty->assign('oldCode',empty($post['oldCode'])?'':$post['oldCode']);
			$this->_smarty->assign('idOpt',empty($post['idOpt'])?'':$post['idOpt']);
			$this->_smarty->assign('isDisabled',empty($post['isDisabled'])?'1':$post['isDisabled']);
		}
		// liste
		elseif(isset($get['page'])&&$get['page']=='list_insulation'){
			$this->_title = 'Liste des options d\'isolation';
			$this->_smarty->assign('h1',$this->_title);
			$this->_template =dirname(__FILE__).'/views/list.tpl';
			$this->_smarty->assign('list',MandateInsulation::loadAll($this->_pdo,1));
			$this->_smarty->assign('page','upd_insulation');
		}
		// update
		elseif(isset($get['page'])&&$get['page']=='upd_insulation'){
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
					Log::create($this->_pdo,time(),'mandate_features','Mise à jour de l\'isolation  : '.$opt->getName(),$this->_user);
					header('location:'.Tools::create_url($this->_user,$get['module'],'list_insulation'));
				}
			}
			$this->_smarty->assign('name',$name);
			$this->_smarty->assign('code',$code);
			$this->_smarty->assign('oldName',$oldName);
			$this->_smarty->assign('oldCode',$oldCode);
			$this->_smarty->assign('idOpt',$idOpt);
			$this->_smarty->assign('isDisabled',$isDisabled);
		}


		/***************************
		 * roof LAU
		 ***************************/
		// ajout
		elseif(isset($get['page'])&&$get['page']=='add_roof'){
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
					Log::create($this->_pdo,time(),'mandate_features','Ajout d\'une option de toiture : '.$obj->getName(),$this->_user);
					header('location:'.Tools::create_url($this->_user,$get['module']));
				}
			}
			$this->_smarty->assign('name',empty($post['name'])?'':$post['name']);
			$this->_smarty->assign('code',empty($post['code'])?'':$post['code']);
			$this->_smarty->assign('oldName',empty($post['oldName'])?'':$post['oldName']);
			$this->_smarty->assign('oldCode',empty($post['oldCode'])?'':$post['oldCode']);
			$this->_smarty->assign('idOpt',empty($post['idOpt'])?'':$post['idOpt']);
			$this->_smarty->assign('isDisabled',empty($post['isDisabled'])?'1':$post['isDisabled']);
		}
		// liste
		elseif(isset($get['page'])&&$get['page']=='list_roof'){
			$this->_title = 'Liste des options d\'de toiture';
			$this->_smarty->assign('h1',$this->_title);
			$this->_template =dirname(__FILE__).'/views/list.tpl';
			$this->_smarty->assign('list',MandateRoof::loadAll($this->_pdo,1));
			$this->_smarty->assign('page','upd_roof');
		}
		// update
		elseif(isset($get['page'])&&$get['page']=='upd_roof'){
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
					Log::create($this->_pdo,time(),'mandate_features','Mise à jour de l\'option de toiture  : '.$opt->getName(),$this->_user);
					header('location:'.Tools::create_url($this->_user,$get['module'],'list_roof'));
				}
			}
			$this->_smarty->assign('name',$name);
			$this->_smarty->assign('code',$code);
			$this->_smarty->assign('oldName',$oldName);
			$this->_smarty->assign('oldCode',$oldCode);
			$this->_smarty->assign('idOpt',$idOpt);
			$this->_smarty->assign('isDisabled',$isDisabled);
		}

		/***************************
		 * heating LAU
		 ***************************/
		// ajout
		elseif(isset($get['page'])&&$get['page']=='add_heating'){
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
					Log::create($this->_pdo,time(),'mandate_features','Ajout d\'une option de chauffage : '.$obj->getName(),$this->_user);
					header('location:'.Tools::create_url($this->_user,$get['module']));
				}
			}
			$this->_smarty->assign('name',empty($post['name'])?'':$post['name']);
			$this->_smarty->assign('code',empty($post['code'])?'':$post['code']);
			$this->_smarty->assign('oldName',empty($post['oldName'])?'':$post['oldName']);
			$this->_smarty->assign('oldCode',empty($post['oldCode'])?'':$post['oldCode']);
			$this->_smarty->assign('idOpt',empty($post['idOpt'])?'':$post['idOpt']);
			$this->_smarty->assign('isDisabled',empty($post['isDisabled'])?'1':$post['isDisabled']);
		}
		// liste
		elseif(isset($get['page'])&&$get['page']=='list_heating'){
			$this->_title = 'Liste des options de chauffage';
			$this->_smarty->assign('h1',$this->_title);
			$this->_template =dirname(__FILE__).'/views/list.tpl';
			$this->_smarty->assign('list',MandateHeating::loadAll($this->_pdo,1));
			$this->_smarty->assign('page','upd_heating');
		}
		// update
		elseif(isset($get['page'])&&$get['page']=='upd_heating'){
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
					Log::create($this->_pdo,time(),'mandate_features','Mise à jour de l\'option de chauffage  : '.$opt->getName(),$this->_user);
					header('location:'.Tools::create_url($this->_user,$get['module'],'list_heating'));
				}
			}
			$this->_smarty->assign('name',$name);
			$this->_smarty->assign('code',$code);
			$this->_smarty->assign('oldName',$oldName);
			$this->_smarty->assign('oldCode',$oldCode);
			$this->_smarty->assign('idOpt',$idOpt);
			$this->_smarty->assign('isDisabled',$isDisabled);
		}

		/***************************
		 * commonOwnership LAU
		 ***************************/
		// ajout
		elseif(isset($get['page'])&&$get['page']=='add_commonOwnership'){
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
					Log::create($this->_pdo,time(),'mandate_features','Ajout d\'une option des parties communes : '.$obj->getName(),$this->_user);
					header('location:'.Tools::create_url($this->_user,$get['module']));
				}
			}
			$this->_smarty->assign('name',empty($post['name'])?'':$post['name']);
			$this->_smarty->assign('code',empty($post['code'])?'':$post['code']);
			$this->_smarty->assign('oldName',empty($post['oldName'])?'':$post['oldName']);
			$this->_smarty->assign('oldCode',empty($post['oldCode'])?'':$post['oldCode']);
			$this->_smarty->assign('idOpt',empty($post['idOpt'])?'':$post['idOpt']);
			$this->_smarty->assign('isDisabled',empty($post['isDisabled'])?'1':$post['isDisabled']);
		}
		// liste
		elseif(isset($get['page'])&&$get['page']=='list_commonOwnership'){
			$this->_title = 'Liste des options des parties communes';
			$this->_smarty->assign('h1',$this->_title);
			$this->_template =dirname(__FILE__).'/views/list.tpl';
			$this->_smarty->assign('list',MandateCommonOwnership::loadAll($this->_pdo,1));
			$this->_smarty->assign('page','upd_commonOwnership');
		}
		// update
		elseif(isset($get['page'])&&$get['page']=='upd_commonOwnership'){
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
					Log::create($this->_pdo,time(),'mandate_features','Mise à jour de l\'option des parties communes  : '.$opt->getName(),$this->_user);
					header('location:'.Tools::create_url($this->_user,$get['module'],'list_commonOwnership'));
				}
			}
			$this->_smarty->assign('name',$name);
			$this->_smarty->assign('code',$code);
			$this->_smarty->assign('oldName',$oldName);
			$this->_smarty->assign('oldCode',$oldCode);
			$this->_smarty->assign('idOpt',$idOpt);
			$this->_smarty->assign('isDisabled',$isDisabled);
		}

		/***************************
		 * constructionType LAU
		 ***************************/
		// ajout
		elseif(isset($get['page'])&&$get['page']=='add_constructionType'){
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
					Log::create($this->_pdo,time(),'mandate_features','Ajout d\'une option du type de construction : '.$obj->getName(),$this->_user);
					header('location:'.Tools::create_url($this->_user,$get['module']));
				}
			}
			$this->_smarty->assign('name',empty($post['name'])?'':$post['name']);
			$this->_smarty->assign('code',empty($post['code'])?'':$post['code']);
			$this->_smarty->assign('oldName',empty($post['oldName'])?'':$post['oldName']);
			$this->_smarty->assign('oldCode',empty($post['oldCode'])?'':$post['oldCode']);
			$this->_smarty->assign('idOpt',empty($post['idOpt'])?'':$post['idOpt']);
			$this->_smarty->assign('isDisabled',empty($post['isDisabled'])?'1':$post['isDisabled']);
		}
		// liste
		elseif(isset($get['page'])&&$get['page']=='list_constructionType'){
			$this->_title = 'Liste des options du type de construction';
			$this->_smarty->assign('h1',$this->_title);
			$this->_template =dirname(__FILE__).'/views/list.tpl';
			$this->_smarty->assign('list',MandateConstructionType::loadAll($this->_pdo,1));
			$this->_smarty->assign('page','upd_constructionType');
		}
		// update
		elseif(isset($get['page'])&&$get['page']=='upd_constructionType'){
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
					Log::create($this->_pdo,time(),'mandate_features','Mise à jour de l\'option du type de construction  : '.$opt->getName(),$this->_user);
					header('location:'.Tools::create_url($this->_user,$get['module'],'list_constructionType'));
				}
			}
			$this->_smarty->assign('name',$name);
			$this->_smarty->assign('code',$code);
			$this->_smarty->assign('oldName',$oldName);
			$this->_smarty->assign('oldCode',$oldCode);
			$this->_smarty->assign('idOpt',$idOpt);
			$this->_smarty->assign('isDisabled',$isDisabled);
		}


		/***************************
		 * style LAU
		 ***************************/
		// ajout
		elseif(isset($get['page'])&&$get['page']=='add_style'){
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
					Log::create($this->_pdo,time(),'mandate_features','Ajout d\'une option du style : '.$obj->getName(),$this->_user);
					header('location:'.Tools::create_url($this->_user,$get['module']));
				}
			}
			$this->_smarty->assign('name',empty($post['name'])?'':$post['name']);
			$this->_smarty->assign('code',empty($post['code'])?'':$post['code']);
			$this->_smarty->assign('oldName',empty($post['oldName'])?'':$post['oldName']);
			$this->_smarty->assign('oldCode',empty($post['oldCode'])?'':$post['oldCode']);
			$this->_smarty->assign('idOpt',empty($post['idOpt'])?'':$post['idOpt']);
			$this->_smarty->assign('isDisabled',empty($post['isDisabled'])?'1':$post['isDisabled']);
		}
		// liste
		elseif(isset($get['page'])&&$get['page']=='list_style'){
			$this->_title = 'Liste des options du style';
			$this->_smarty->assign('h1',$this->_title);
			$this->_template =dirname(__FILE__).'/views/list.tpl';
			$this->_smarty->assign('list',MandateStyle::loadAll($this->_pdo,1));
			$this->_smarty->assign('page','upd_style');
		}
		// update
		elseif(isset($get['page'])&&$get['page']=='upd_style'){
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
					Log::create($this->_pdo,time(),'mandate_features','Mise à jour de l\'option du style  : '.$opt->getName(),$this->_user);
					header('location:'.Tools::create_url($this->_user,$get['module'],'list_style'));
				}
			}
			$this->_smarty->assign('name',$name);
			$this->_smarty->assign('code',$code);
			$this->_smarty->assign('oldName',$oldName);
			$this->_smarty->assign('oldCode',$oldCode);
			$this->_smarty->assign('idOpt',$idOpt);
			$this->_smarty->assign('isDisabled',$isDisabled);
		}

		/***************************
		 * news LAU
		 ***************************/
		// ajout
		elseif(isset($get['page'])&&$get['page']=='add_news'){
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
					Log::create($this->_pdo,time(),'mandate_features','Ajout d\'une option de nouveauté : '.$obj->getName(),$this->_user);
					header('location:'.Tools::create_url($this->_user,$get['module']));
				}
			}
			$this->_smarty->assign('name',empty($post['name'])?'':$post['name']);
			$this->_smarty->assign('code',empty($post['code'])?'':$post['code']);
			$this->_smarty->assign('oldName',empty($post['oldName'])?'':$post['oldName']);
			$this->_smarty->assign('oldCode',empty($post['oldCode'])?'':$post['oldCode']);
			$this->_smarty->assign('idOpt',empty($post['idOpt'])?'':$post['idOpt']);
			$this->_smarty->assign('isDisabled',empty($post['isDisabled'])?'1':$post['isDisabled']);
		}
		// liste
		elseif(isset($get['page'])&&$get['page']=='list_news'){
			$this->_title = 'Liste des options de nouveauté';
			$this->_smarty->assign('h1',$this->_title);
			$this->_template =dirname(__FILE__).'/views/list.tpl';
			$this->_smarty->assign('list',MandateNews::loadAll($this->_pdo,1));
			$this->_smarty->assign('page','upd_news');
		}
		// update
		elseif(isset($get['page'])&&$get['page']=='upd_news'){
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
					Log::create($this->_pdo,time(),'mandate_features','Mise à jour de l\'option de nouveauté  : '.$opt->getName(),$this->_user);
					header('location:'.Tools::create_url($this->_user,$get['module'],'list_news'));
				}
			}
			$this->_smarty->assign('name',$name);
			$this->_smarty->assign('code',$code);
			$this->_smarty->assign('oldName',$oldName);
			$this->_smarty->assign('oldCode',$oldCode);
			$this->_smarty->assign('idOpt',$idOpt);
			$this->_smarty->assign('isDisabled',$isDisabled);
		}

		/***************************
		 * condition LAU
		 ***************************/
		// ajout
		elseif(isset($get['page'])&&$get['page']=='add_condition'){
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
					Log::create($this->_pdo,time(),'mandate_features','Ajout d\'une option de condition : '.$obj->getName(),$this->_user);
					header('location:'.Tools::create_url($this->_user,$get['module']));
				}
			}
			$this->_smarty->assign('name',empty($post['name'])?'':$post['name']);
			$this->_smarty->assign('code',empty($post['code'])?'':$post['code']);
			$this->_smarty->assign('oldName',empty($post['oldName'])?'':$post['oldName']);
			$this->_smarty->assign('oldCode',empty($post['oldCode'])?'':$post['oldCode']);
			$this->_smarty->assign('idOpt',empty($post['idOpt'])?'':$post['idOpt']);
			$this->_smarty->assign('isDisabled',empty($post['isDisabled'])?'1':$post['isDisabled']);
		}
		// liste
		elseif(isset($get['page'])&&$get['page']=='list_condition'){
			$this->_title = 'Liste des options de condition';
			$this->_smarty->assign('h1',$this->_title);
			$this->_template =dirname(__FILE__).'/views/list.tpl';
			$this->_smarty->assign('list',MandateCondition::loadAll($this->_pdo,1));
			$this->_smarty->assign('page','upd_condition');
		}
		// update
		elseif(isset($get['page'])&&$get['page']=='upd_condition'){
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
					Log::create($this->_pdo,time(),'mandate_features','Mise à jour de l\'option de condition  : '.$opt->getName(),$this->_user);
					header('location:'.Tools::create_url($this->_user,$get['module'],'list_condition'));
				}
			}
			$this->_smarty->assign('name',$name);
			$this->_smarty->assign('code',$code);
			$this->_smarty->assign('oldName',$oldName);
			$this->_smarty->assign('oldCode',$oldCode);
			$this->_smarty->assign('idOpt',$idOpt);
			$this->_smarty->assign('isDisabled',$isDisabled);
		}

		// type de mandats ? etape ? ( update et liste uniquement )
		$this->_smarty->assign('error',$error);
	}
	public function treatment( $post,$get){
		$this->_smarty->assign('user',$this->_user );
		if(!$this->_error_dependance){
			//$this->_treatment( $post,$get);
			// inclusion des modules enfants
			$this->include_modules_Children((String)dirname(__FILE__),$this->_smarty);
		}
	}

	public function displayTpl( ){
		$this->_smarty->display('tpl_default/header.tpl');
		$this->_smarty->display( $this->_template );
		$this->_smarty->display('tpl_default/footer.tpl');
	}

	private function _addMainMenu(){
		//		var_dump($this->_user);
		$this->_smarty->assign('mainMenu',$this->getMainMenu($this->_user ));
	}
	private function _addMenu($module){
		$this->_smarty->assign('menu',$this->getMenu($this->_user ,$module ) );
	}
}