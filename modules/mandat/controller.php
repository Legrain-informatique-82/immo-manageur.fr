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
			// autorisation necessaire pour cette action ? // sauf cas spéciaux
			if($this->getLevelRequired($_GET['module'],$_GET['page'],$_GET['action']) < $this->_user->getLevelMember()->getIdLevelMember()){
				$this->_error_dependance = true;
				$this->_template = $this->getTplErrorViolationAccess();
				Log::create($this->_pdo,time(),"mandat",'accès non autorisé',$this->_user );
			} else{
				$this->_template = dirname(__FILE__).'/views/default.tpl';
				$this->_addMainMenu();
				$this->_addMenu('mandat');
				$this->_title = 'Gestion des Terrains';
			}
		}
	}
	public function addMeta(){
		$this->_smarty->assign('title',	$this->_title );
	}
	private function _treatment( $post,$get){
		// page par defaut (envoyé vers une fct)
		if(empty($get['page']))$get['page']='list';
		$error = array();
		if(isset($get['page'])&&$get['page']=='preadd'){
			$this->_title = 'Type d\'ajout';
			$this->_template = dirname(__FILE__).'/views/preadd.tpl';
			$this->_smarty->assign('listSeller', Seller::loadAll($this->_pdo));
			$this->_smarty->assign('urlAct',$this->create_url($this->_user,$get['module'],'add'));
		}elseif(isset($get['page'])&&$get['page']=='add'){
			$this->_title = 'Ajouter un mandat';
			$this->_template = dirname(__FILE__).'/views/add.tpl';
			$listCity = City::loadAll($this->_pdo);
			$listSector = Sector::loadAll($this->_pdo);
			$listNotary = Notary::loadAll($this->_pdo);
			$listSeller = Seller::loadAll($this->_pdo);
			$listTitleSeller = SellerTitle::loadAll($this->_pdo);
			$listNature= MandateNature::loadAll($this->_pdo);
			$listTypeTransaction = TransactionType::loadAll($this->_pdo);
			$listTypeBien = MandateType::loadAll($this->_pdo);
			$this->_smarty->assign('listCity',$listCity);
			$this->_smarty->assign('listSector',$listSector);
			$this->_smarty->assign('listNotary',$listNotary);
			$this->_smarty->assign('listSeller',$listSeller);
			$this->_smarty->assign('listTitle',$listTitleSeller);
			$this->_smarty->assign('listTypeTransaction',$listTypeTransaction);
			$this->_smarty->assign('listTypeBien',$listTypeBien);
			$this->_smarty->assign('listNature',$listNature);
			if(
			empty($listCity)||
			empty($listNotary)
			){
				// au moins un des plugins est vide, alerter admin.
				$this->_template =dirname(__FILE__).'/views/empty_feature.tpl';
			}else{
				// loadAll() des utilisateurs si niveau du membre != operateur.
				$listUser= array();
				if($this->_user->getLevelMember()->getIdLevelMember()<3){
					$listUser = User::loadAll($this->_pdo);
				}
				$this->_smarty->assign('listUser',$listUser);
				if(isset($post['terrain_add_submit'])||isset($post['terrain_add_submit_and_continue'])){
					$newSeller = false;
					// Affectation des autres valeurs au tpl (id user du membre etc ...)
					$this->_smarty->assign('idUser',empty($post['idUser'])?'':$post['idUser']);
					$this->_smarty->assign('idNotary',empty($post['idNotary'])?'':$post['idNotary']);
					$this->_smarty->assign('idNotaryAcq',empty($post['idNotaryAcq'])?'':$post['idNotaryAcq']);
					$this->_smarty->assign('idCity',empty($post['idCity'])?'':$post['idCity']);
					$this->_smarty->assign('numMandat',empty($post['numMandat'])?'':$post['numMandat']);
					$this->_smarty->assign('debutMandat',empty($post['debutMandat'])?'':$post['debutMandat']);
					$this->_smarty->assign('finMandat',empty($post['finMandat'])?'':$post['finMandat']);
					$this->_smarty->assign('libreMandat',empty($post['libreMandat'])?'':$post['libreMandat']);
					$this->_smarty->assign('adresseMandat',empty($post['adresseMandat'])?'':$post['adresseMandat']);
					$this->_smarty->assign('prixFai',empty($post['prixFai'])?'':$post['prixFai']);
					$this->_smarty->assign('prixNetVendeur',empty($post['prixNetVendeur'])?'':$post['prixNetVendeur']);
					$this->_smarty->assign('commissionMandat',empty($post['commissionMandat'])?'':$post['commissionMandat']);
					$this->_smarty->assign('estimationFai',empty($post['estimationFai'])?'':$post['estimationFai']);
					$this->_smarty->assign('estimationMaxi',empty($post['estimationMaxi'])?'':$post['estimationMaxi']);
					$this->_smarty->assign('margeNegoce',empty($post['margeNegoce'])?'':$post['margeNegoce']);
					$this->_smarty->assign('refCadastre1',empty($post['refCadastre1'])?'':$post['refCadastre1']);
					$this->_smarty->assign('refCadastre2',empty($post['refCadastre2'])?'':$post['refCadastre2']);
					$this->_smarty->assign('refCadastre3',empty($post['refCadastre3'])?'':$post['refCadastre3']);
					$this->_smarty->assign('autreRefCadastre',empty($post['autreRefCadastre'])?'':$post['autreRefCadastre']);
					$this->_smarty->assign('numLot',empty($post['numLot'])?'':$post['numLot']);
					$this->_smarty->assign('typeTransaction',empty($post['typeTransaction'])?'':$post['typeTransaction']);
					$this->_smarty->assign('typeBien',empty($post['typeBien'])?'':$post['typeBien']);
					$this->_smarty->assign('nature',empty($post['nature'])?'':$post['nature']);


					$this->_smarty->assign('numberlot',empty($post['numberlot'])?'':$post['numberlot']);
					$this->_smarty->assign('rental',empty($post['rental'])?'':$post['rental']);
					$this->_smarty->assign('pricegarage',empty($post['pricegarage'])?'':$post['pricegarage']);
					$this->_smarty->assign('pricecellar',empty($post['pricecellar'])?'':$post['pricecellar']);
					$this->_smarty->assign('profitability',empty($post['profitability'])?'':$post['profitability']);


					$user = empty($post['idUser'])?$this->_user : User::load($this->_pdo,$post['idUser']);

					if($post['idSeller']!=0&&$post['seller_add_name'])
					$error[]= Lang::ERROR_SELLER_ADD_BAD_FORMAT_EMAIL;
					if($post['idSeller']==0){
						if(empty($post['seller_add_name']))
						$error[]= Lang::ERROR_SELLER_ADD_EMPTY_NAME;
							
						if(!empty($post['seller_add_email'])&&!Tools::isEmail($post['seller_add_email']))
						$error[]= Lang::ERROR_SELLER_ADD_BAD_FORMAT_EMAIL;
						$idUser = empty($post['seller_add_user'])?$this->_user->getIdUser():$post['seller_add_user'];
						if(empty($error)){
							$newSeller = true;
							$city = City::load($this->_pdo,$post['seller_add_list_city']);
							$city->setNumberUsed( $city->getNumberUsed()+1 );
							// new seller
							$seller = Seller::create($this->_pdo,
							$post['seller_add_name'],
							$post['seller_add_firstname'],
							$post['seller_add_address'],
							$post['seller_add_phone'],
							$post['seller_add_mobil_phone'],
							$post['seller_add_work_phone'],
							$post['seller_add_fax'],
							$post['seller_add_email'],
							$post['seller_add_comment'],
							0,// Nombre d'utilisation
							$city,
							SellerTitle::load($this->_pdo,$post['seller_add_list_title']),
							$user,
							1
							);
							// Ajout d'une utilisation au membre pour la creation du vendeur
							$user->setNumberUsed($user->getNumberUsed()+1);
							$city->setNumberUsed($city->getNumberUsed()+1);
						}
					}else{
						$seller = Seller::load($this->_pdo,$post['idSeller']);
					}
					// Verif des erreurs.
					if(empty($post['numMandat'])) $error[] = Lang::ERROR_EMPTY_NUM_MANDAT;
					elseif(!Tools::is_int($post['numMandat'])) $error[] = Lang::ERROR_TYPE_FORMAT_NUM_MANDAT;
					// 					elseif(strlen($post['numMandat'])>4) $error[] = Lang::ERROR_LENGHT_NUM_MANDAT;
					if(empty($post['debutMandat']))$error[] = Lang::ERROR_EMPTY_DATE_DEBUT_MANDAT;
					elseif(!Tools::is_date_fr($post['debutMandat'])) $error[] = Lang::ERROR_BAD_FORMAT_DATE_DEBUT_MANDAT;
					if(empty($post['finMandat']))$error[] = Lang::ERROR_EMPTY_DATE_FIN_MANDAT;
					elseif(!Tools::is_date_fr($post['finMandat'])) $error[] = Lang::ERROR_BAD_FORMAT_DATE_FIN_MANDAT;
					if(Tools::date1_is_superior_to_date2_date_time_fr($post['debutMandat'],$post['finMandat'])) $error[]= 'La date de début de mandat doit être inférieure à celle de fin';
					if(!empty($post['libreMandat'])&&!Tools::is_date_fr($post['libreMandat'])) $error[] = Lang::ERROR_BAD_FORMAT_DATE_LIBRE_MANDAT;
					if(empty($post['adresseMandat']))$error[] = Lang::ERROR_EMPTY_ADDRESS_MANDAT;
					if(empty($post['prixFai'])) $error[] =Lang::ERROR_EMPTY_PRIX_FAI;
					elseif(!is_numeric($post['prixFai']))$error[]=Lang::ERROR_FORMAT_TYPE_PRIX_FAI;
					if(empty($post['prixNetVendeur'])) $error[] =Lang::ERROR_EMPTY_PRIX_NET_VENDEUR;
					elseif(!is_numeric($post['prixNetVendeur']))$error[]=Lang::ERROR_FORMAT_TYPE_PRIX_NET_VENDEUR;
					if(!empty($post['refCadastre1'])&&Tools::strlenWithAccentedCharacters($post['refCadastre1'])>10) $error[]=Lang::ERROR_LENGHT_REF_CADASTRE1;
					if(!empty($post['refCadastre2'])&&Tools::strlenWithAccentedCharacters($post['refCadastre2'])>10) $error[]=Lang::ERROR_LENGHT_REF_CADASTRE2;
					if(!empty($post['refCadastre3'])&&Tools::strlenWithAccentedCharacters($post['refCadastre3'])>10) $error[]=Lang::ERROR_LENGHT_REF_CADASTRE3;
					if(!empty($post['autreRefCadastre'])&&Tools::strlenWithAccentedCharacters($post['autreRefCadastre'])>10) $error[]=Lang::ERROR_LENGHT_AUTRE_REF_CADASTRE;
					if(!empty($post['numLot'])&&Tools::strlenWithAccentedCharacters($post['numLot'])>10) $error[]=Lang::ERROR_LENGHT_NUM_LOT;
					if(empty($error)){
						$cityMandate = City::load($this->_pdo,$post['idCity']);
						$notary = Notary::load($this->_pdo,$post['idNotary']);
						$notaryAcq = Notary::load($this->_pdo,$post['idNotaryAcq']);
						/* save*/
						$mandat= Mandate::create($this->_pdo,$post['numMandat'],Tools::dateFrToTime($post['debutMandat']),Tools::dateFrToTime($post['finMandat']),
						$post['adresseMandat'],$post['prixFai'],$post['prixNetVendeur'],$post['commissionMandat'],
						$post['estimationFai'],$post['margeNegoce'],$post['refCadastre1'],'',
						'','','','','','','','','','','',
							'','','','','','','','','','','','','','','','','','','','','','','',$user,$cityMandate->getSector(),
						$cityMandate,
						$notary,
						MandateType::load($this->_pdo,$post['typeBien']),
						TransactionType::load($this->_pdo,$post['typeTransaction']),
						MandateEtap::load($this->_pdo,Constant::ID_ETAP_TO_SELL),
						$post['libreMandat']==''?null:Tools::dateFrToTime($post['libreMandat'])
						);
						$mandat->setNature( $post['nature']==''?null:MandateNature::load($this->_pdo,$post['nature']));

						$mandat->setEstimationMaxi($post['estimationMaxi'],false);

						$mandat->setNumberLot($post['numberlot'],false);
						$mandat->setRental($post['rental'],false);
						$mandat->setPriceGarage($post['pricegarage'],false);
						$mandat->setPriceCellar($post['pricecellar'],false);
						$mandat->setProfitability($post['profitability'],false);


						$mandat->update();
						if($notaryAcq){
							$mandat->setNotaryAcq($notaryAcq);
							$notaryAcq->setNumberUsed( $notaryAcq->getNumberUsed() +1);
						}
						if($newSeller){
							Log::create($this->_pdo,time(),'seller','Creation du vendeur : '.$seller->getName(),$this->_user);
						}
						Log::create($this->_pdo,time(),'mandat','Ajout du mandat : '.$mandat->getNumberMandate(),$this->_user);
						// Ajout une utilisation à l'utilisateur
						$user->setNumberUsed( $user->getNumberUsed() +1);
						// Ajout une utilisation à la ville selectionnée
						$cityMandate->setNumberUsed( $cityMandate->getNumberUsed()+1 );
						// Ajput d'une utilisation au notaire
						$notary->setNumberUsed($notary->getNumberUsed()+1);
						// Liaison du vendeur principal
						if(!empty($mandat)){
							$mandat->setNouveaute( Tools::dateFrToTime(date('d/m/Y') ),true);
							$mandat->addSeller($seller,true);
							// Ajout d'une utilisation au vendeur.
							$seller->setNumberUsed($seller->getNumberUsed()+1 );
							Log::create($this->_pdo,time(),'mandat','nouvelle liaison mandat/vendeur principal : '.$mandat->getNumberMandate().'/'.$seller->getName(),$this->_user);
						}
						/* Fin save */
						// Redirection
						if(isset($post['terrain_add_submit']))
						$redirect =$this->create_url($this->_user,$get['module'],'list');
						elseif(isset($post['terrain_add_submit_and_continue']))
						$redirect =$this->create_url($this->_user,$get['module'],'updateComplementaryInformation',$mandat->getIdMandate());
						header('location:'.$redirect);
					}elseif($newSeller){
						// -1 utlisation au membre
						// Ajout d'une utilisation au membre pour la creation du vendeur
						$seller->getUser()->setNumberUsed( $seller->getUser()->getNumberUsed(  ) -1 );
						$seller->getCity()->setNumberUsed( $seller->getCity()->getNumberUsed(  ) -1 );
						// Supprime le nouveau vendeur si il a été saisi et qu'il y a des erreurs à l'insertion.
						$seller->delete();
					}
				}
			}
		}elseif(isset($get['page'])&&($get['page']=='list'||substr($get['page'],0,5)=='list_')){
			$this->_title = 'Liste des mandats';
			$this->_template =dirname(__FILE__).'/views/list.tpl';
			$listOfEtap = MandateEtap::loadAll($this->_pdo);
			// liens vers les autres etats
			foreach($listOfEtap as $value){
				$tmp['url'] = $this->create_url($this->_user,$get['module'],$value->getCode());
				$tmp['name'] = $value->getName();
				$listElem[] = $tmp;
				if($get['page']==$value->getCode()){
					$etap = MandateEtap::load($this->_pdo,$value->getIdMandateEtap());
					$this->_smarty->assign('nameOfEtap',$value->getName());
				}
			}
			$this->_smarty->assign('listElem',$listElem);
			$agency = empty($post['agency'])?$this->_user->getAgency()->getIdAgency():$post['agency'];
			$this->_smarty->assign('agency',$agency);
			$this->_smarty->assign('listAgency',Agency::loadAll($this->_pdo));
			$selectListMandat = Mandate::selectByEtapAndOtherType($this->_pdo,$etap,MandateType::load($this->_pdo,Constant::ID_PLOT_OF_LAND));

			while($item = Mandate::fetch($this->_pdo,$selectListMandat) ){
				if($agency=='ALL' || $item->getUser()->getAgency()->getIdAgency()==$agency){
					$tmp['obj'] = $item;
					$tmp['urls']['see'] = $this->create_url($this->_user,'mandat','see',$item->getIdMandate());
					$tmp['urls']['duplicate'] = Tools::create_url($this->_user,'mandat','duplicate',$item->getIdMandate());

					$listMandat[] = $tmp;
				}
			}
			$this->_smarty->assign('listMandat',$listMandat);
		}elseif(isset($get['page'])&&$get['page']=='updateDescription'){
			$this->_title = 'Modifier les descriptions';
			$this->_smarty->assign('hookName','hook_updateMandateDescription');
			$this->_template =Constant::DEFAULT_MODULE_DIRECTORY.'tpl_default/addHook.tpl';
		}elseif(isset($get['page'])&&$get['page']=='updateCom'){
			$this->_title = 'Modifier les commentaires';
			$this->_smarty->assign('hookName','hook_updateMandateCom');
			$this->_template = Constant::DEFAULT_MODULE_DIRECTORY.'tpl_default/addHook.tpl';
		}elseif(isset($get['page'])&&$get['page']=='see'){

			// var dump du mandat suivant...
            $this->js[]="../../../libs/plupload/js/i18n/fr.js";
			$errorPicture = array();
			$this->_title = 'Fiche du mandat';

			$this->_template =dirname(__FILE__).'/views/see.tpl';
			// load du terrain
			$mandate = Mandate::load($this->_pdo,$get['action']);

			//var_dump($mandate->getMandateType());


			$this->_smarty->assign('premierMandat',Mandate::loadFirstOrLast( $this->_pdo,$mandate,0 ));
			$this->_smarty->assign('dernierMandat',Mandate::loadFirstOrLast( $this->_pdo,$mandate,1 ));
			$this->_smarty->assign('mandatPrecedent',Mandate::loadPreviewOrNext( $this->_pdo,$mandate,0 ));
			$this->_smarty->assign('mandatSuivant',Mandate::loadPreviewOrNext( $this->_pdo,$mandate,1 ));
			$this->_smarty->assign('afficheEnVitrine', OtherComplementMandate::loadByMandate($this->_pdo,$mandate));

			// Assign
			$this->_smarty->assign('mandate',$mandate );
			/**
			 *  post
			 */

			if(isset($post['delete_affectation_seller'])){
				// load du mandat correspondant.
				$mandate = Mandate::load($this->_pdo,$post['idMandate']);
				// On regarde que le membre ait le droit de réaliser l'action (pere ou lvl > 3)
				if((($mandate->getUser()->getIdUser()!==$this->_user->getIdUser())&&$this->_user->getLevelMember()->getIdLevelMember()==3)&&($this->_user->getLevelMember()->getIdLevelMember()>2)){
					$this->_error_dependance = true;
					$this->_template = $this->getTplErrorViolationAccess();
					Log::create($this->_pdo,time(),"mandat",'accès non autorisé',$this->_user );
				}else{
					if(isset($post['confirm'])&&$post['confirm']==1){
						// on vérifie que le vendeur n'est pas le principal.
						if( $mandate->getDefaultSeller()->getIdSeller()== $post['idSeller'])
						$error[]='Impossible de supprimer le vendeur principal';
						if(empty($error)){
							$seller= Seller::load($this->_pdo,$post['idSeller']);
							$nameOfSeller = $seller->getName();
							$mandate->deleteRelSeller( $seller );
							$seller->setNumberUsed($seller->getNumberUsed()-1);
							Log::create($this->_pdo,time(),'mandat','Suppression de la liaison terrain/vendeur : '.$mandate->getNumberMandate().'/'.$nameOfSeller,$this->_user);
							header('location:'.Tools::create_url($this->_user,$get['module'],'see',$post['idMandate']));
						}
					}
					// On doit verifier que le pere est le demandeur de l'action, ou que le demandeur > opérateur
					$this->_title = 'Suppression de l\'affectation';
					$this->_template = dirname(__FILE__).'/views/del_affectation_vendeur_mandat.tpl';
				}
			}
			if(isset($post['cancel_delete_affectation_seller'])){
				header('location:'.Tools::create_url($this->_user,$get['module'],'see',$post['idMandate']));
			}
			if(isset($post['sendSellerByDefault'])){
				if($this->_user->getLevelMember()->getIdLevelMember() < 3 || $this->_user->getIdUser() == $mandate->getUser()->getIdUser()){
					$sellerByDefault = $mandate->getDefaultSeller();
					$mandate->toogleDefaultSeller($sellerByDefault,Seller::load($this->_pdo,$post['idSeller']));
					Log::create($this->_pdo,time(),'mandat','Changement de vendeur principal pour le terrain '.$mandate->getNumberMandate(),$this->_user);
				}
				header('location:'.Tools::create_url($this->_user,$get['module'],'see',$post['idMandate']));
			}
			if(isset($post['sendPictureForMandate'])){
				if($this->_user->getLevelMember()->getIdLevelMember() < 3 || $this->_user->getIdUser() == $mandate->getUser()->getIdUser()){
					$file = new upload();
					$file->setTaille(9200000000);
					$file->setFichier( $_FILES['newPicture'] );
					$file->setCheminUpload( Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.$get['module'].'/' );
					$file->setExtension('jpg','jpeg');
					if($file->goUpload()){
						$isDef = 0;
						if($post['isDefaultPicture']=='on'){
							$isDef = 1;
							$p = $mandate->getPictureByDefault();
							if($p)
							$p->setIsDefault(0,true);
						}
						$picture = MandatePicture::create($this->_pdo,$file->getNomFichier(),$isDef,$mandate);
						Log::create($this->_pdo,time(),'mandat','Ajout d\'une image pour le mandat : '.$mandate->getNumberMandate(),$this->_user);
						$file->rename($mandate->getIdMandate().'-'.$picture->getIdMandatePicture().'.jpg',$file->getFichier());
						$picture->setName($file->getNomFichier());
						$file->copy(Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.$get['module'].'/big/');
						$file->goRedimension($file->getFichier(),Constant::SIZE_X_PICTURE,Constant::SIZE_Y_PICTURE);
						$file->create_miniature(Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.$get['module'].'/thumb/',Constant::SIZE_THUMB_X_PICTURE,Constant::SIZE_THUMB_Y_PICTURE);
						header('location:'.Tools::create_url($this->_user,$get['module'],$get['page'],$get['action']));
					}else{
						$this->_smarty->assign('errorPicture', $file->afficheError());
					}
				}
			}
			if(isset($post['sendPlanForMandate'])){
				if($this->_user->getLevelMember()->getIdLevelMember() < 3 || $this->_user->getIdUser() == $mandate->getUser()->getIdUser()){
					if(!empty($_FILES['newPlan']['name'])){
						$file = new upload();
						$file->setTaille(9200000000);
						$file->setFichier( $_FILES['newPlan'] );
						$file->setCheminUpload( Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.$get['module'].'/' );
						$file->setExtension('jpg','jpeg','pdf','PDF');
						if($file->goUpload()){
							$plan = MandateScan::create($this->_pdo,$file->getNomFichier(),'',$mandate);
							Log::create($this->_pdo,time(),'mandat','Ajout d\'un plan pour le mandat : '.$mandate->getNumberMandate(),$this->_user);
							$typeFichier =  pathinfo($file->getFichier(),PATHINFO_EXTENSION);
							$file->rename( 'plan-'.$mandate->getIdMandate().'-'.$plan->getIdMandateScan().'.'.$typeFichier,$file->getFichier() );
							$plan->setName($file->getNomFichier());
							$plan->setCode( Tools::format_bytes(fileSize( $file->getFichier())) );
							if($typeFichier!='pdf')
							$file->create_miniature(Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.$get['module'].'/thumb/',Constant::SIZE_THUMB_X_PICTURE,Constant::SIZE_THUMB_Y_PICTURE);
							header('location:'.Tools::create_url($this->_user,$get['module'],$get['page'],$get['action']));
						}else{
							// Affiche les erreurs...
							$this->_smarty->assign('errorPlan',$file->afficheError());
						}
							
							
					}
				}
			}
			if(isset($post['delete_plan'])){
				if(isset($post['delete_plan'])&&$post['confirm']==1){
					if($this->_user->getLevelMember()->getIdLevelMember() < 3 || $this->_user->getIdUser() == $mandate->getUser()->getIdUser()){
						$pict = MandateScan::load($this->_pdo,$post['idPlan']);
						$nameOfPict =  $pict->getName();
						if($pict->delete()){
							// suppression de la miniature et de l'image
							Log::create($this->_pdo,time(),'mandat','Suppression du plan pour le terrain : '.$mandate->getNumberMandate(),$this->_user);
							unlink(Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.'/'.$get['module'].'/'.$nameOfPict);
							unlink(Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.'/'.$get['module'].'/thumb/'.$nameOfPict);
						}
						header('location:'.Tools::create_url($this->_user,$get['module'],'see',$post['idMandate']));
					}
				}
				$this->_template = dirname(__FILE__).'/views/del_plan.tpl';
				$this->_title="Suppression du plan";
			}
			if(isset($post['sendPictureByDefault'])){
				if($this->_user->getLevelMember()->getIdLevelMember() < 3 || $this->_user->getIdUser() == $mandate->getUser()->getIdUser()){
					$pict = $mandate->getPictureByDefault();
					if($pict)
					$pict->setIsDefault(0,true);
					$pict2 = MandatePicture::load($this->_pdo,$post['idPicture']);
					$pict2->setIsDefault(1,true);
					header('location:'.Tools::create_url($this->_user,$get['module'],'see',$post['idMandate']));
				}
			}
			if(isset($post['delete_picture'])){
				if(isset($post['delete_picture'])&&$post['confirm']==1){
					if($this->_user->getLevelMember()->getIdLevelMember() < 3 || $this->_user->getIdUser() == $mandate->getUser()->getIdUser()){
						$pict = MandatePicture::load($this->_pdo,$post['idPicture']);
						$nameOfPict =  $pict->getName();
						if($pict->delete()){
							// suppression de la miniature et de l'image
							Log::create($this->_pdo,time(),'mandat','Suppression d\'une image pour le terrain : '.$mandate->getNumberMandate(),$this->_user);
							unlink(Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.'/'.$get['module'].'/'.$nameOfPict);
							unlink(Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.'/'.$get['module'].'/thumb/'.$nameOfPict);
						}
						header('location:'.Tools::create_url($this->_user,$get['module'],'see',$post['idMandate']));
					}
				}
				$this->_template = dirname(__FILE__).'/views/del_picture.tpl';
				$this->_title="Suppression de la photo";
			}
			if(isset($post['cancel_delete_picture'])){
				header('location:'.Tools::create_url($this->_user,$get['module'],'see',$post['idMandate']));
			}
		}elseif(isset($get['page'])&&$get['page']=='add_new_seller_for_mandate'){
			// Affecation d'un nouveau vendeur (si on a le droit
			$mandate = Mandate::load($this->_pdo,$get['action']);
			// On regarde que le membre ait le droit de réaliser l'action (pere ou lvl > 3)
			if((($mandate->getUser()->getIdUser()!==$this->_user->getIdUser())&&$this->_user->getLevelMember()->getIdLevelMember()==3)&&($this->_user->getLevelMember()->getIdLevelMember()>2)){
				$this->_error_dependance = true;
				$this->_template = $this->getTplErrorViolationAccess();
				Log::create($this->_pdo,time(),"mandat",'accès non autorisé',$this->_user );
			}else{
				$this->_smarty->assign('mandate',$mandate);
				$allSeller = Seller::loadAll($this->_pdo);
				$listSeller = array();
				foreach ($allSeller as $sel){
					if( !$mandate->isSeller($sel))
					$listSeller[]=$sel;
				}
				$this->_smarty->assign('listSeller',$listSeller);
				$this->_title = 'Affectation d\'un nouveau vendeur';
				$this->_template = dirname(__FILE__).'/views/add_new_seller_for_mandate.tpl';
				$listTitle = SellerTitle::loadAll($this->_pdo);
				$listCity = City::loadAll($this->_pdo);
				$this->_smarty->assign('listTitle',$listTitle);
				$this->_smarty->assign('listCity',$listCity);
				if(empty($listTitle)||empty($listCity)){
					if(empty($listCity))
					$this->_smarty->assign('message',Lang::ERROR_ADD_SELLER_EMPTY_CITY);
					else
					$this->_smarty->assign('message',Lang::ERROR_ADD_SELLER_EMPTY_TITLE);
					$this->_template = dirname(__FILE__).'/views/error.tpl';
				}else{
					$this->_smarty->assign('listTitle',$listTitle);
					$this->_smarty->assign('listCity',$listCity);
				}
				if(isset($post['seller_add_submit_send'])){
					if(empty($post['seller_add_name']))$error[]= Lang::ERROR_SELLER_ADD_EMPTY_NAME;
					if(!empty($post['seller_add_email'])&&!Tools::isEmail($post['seller_add_email']))
					$error[]= Lang::ERROR_SELLER_ADD_BAD_FORMAT_EMAIL;
					$idUser = $this->_user->getIdUser();
					if(empty($error)){
						$city = City::load($this->_pdo,$post['seller_add_list_city']);
						$city->setNumberUsed( $city->getNumberUsed()+1 );
						$seller = Seller::create($this->_pdo,
						$post['seller_add_name'],
						$post['seller_add_firstname'],
						$post['seller_add_address'],
						$post['seller_add_phone'],
						$post['seller_add_mobil_phone'],
						$post['seller_add_work_phone'],
						$post['seller_add_fax'],
						$post['seller_add_email'],
						'',
						0, // number used
						$city,
						SellerTitle::load($this->_pdo,$post['seller_add_list_title']),
						User::load($this->_pdo,$idUser),
						1
						);
						Log::create($this->_pdo,time(),'seller','Ajout du vendeur : '.$seller->getName(),$this->_user);
						// + 1 utilisation du vendeur
						$seller->setNumberUsed($seller->getNumberUsed()+1 );

						$isDefault = empty($post['sellerByDefault'])?0:1;
						//						echo $isDefault;

						if($isDefault==1){
							$df = $mandate->getDefaultSeller();
							$mandate->toogleDefaultSeller($df,$seller);
						}
						$mandate->addSeller( $seller,$isDefault);
						Log::create($this->_pdo,time(),'mandat','Affectation d\'un nouveau vendeur ('.$seller->getName().' ) au mandat : '.$mandate->getNumberMandate(),$this->_user);
						header('location:'.Tools::create_url($this->_user,$get['module'],'see',$get['action']));
					}
				}
				if(isset($post['used'])){
					$newSeller = Seller::load($this->_pdo,$post['idSeller']);
					// verifier le bon fct
					$isDefault = empty($post['sellerByDefault'])?0:1;

					//					echo $isDefault;
					if($isDefault==1){
						$df = $mandate->getDefaultSeller();
						$mandate->toogleDefaultSeller($df,$newSeller);
					}
					$newSeller->setNumberUsed($newSeller->getNumberUsed()+1 );
					if($newSeller->getAsset()==0)$newSeller->setAsset(1);
					$mandate->addSeller( $newSeller,$isDefault);
					Log::create($this->_pdo,time(),'mandat','Affectation d\'un nouveau vendeur ('.$newSeller->getName().' ) au mandat : '.$mandate->getNumberMandate(),$this->_user);
					header('location:'.Tools::create_url($this->_user,$get['module'],'see',$get['action']));
				}
			}
		}elseif(isset($get['page'])&&$get['page']=='updateComplementaryInformation'){
			$mandate = Mandate::load($this->_pdo,$get['action']);
			// On regarde que le membre ait le droit de réaliser l'action (pere ou lvl > 3)
			if((($mandate->getUser()->getIdUser()!==$this->_user->getIdUser())&&$this->_user->getLevelMember()->getIdLevelMember()==3)&&($this->_user->getLevelMember()->getIdLevelMember()>2)){
				$this->_error_dependance = true;
				$this->_template = $this->getTplErrorViolationAccess();
				Log::create($this->_pdo,time(),"mandat",'accès non autorisé',$this->_user );
			}else{
				$this->_title = 'Mise à jour les informations complémentaires';
				$this->_template = dirname(__FILE__).'/views/updateComplementaryInformation.tpl';
				// Permet de savoir si un dpe existe pour ce mandat
				$valDpe = ValDpe::loadByMandate($this->_pdo,$mandate);
				if(empty($post)){
					$superficieParcelle1 = $mandate->getSuperficieParcelle1();
					$superficieParcelle2 = $mandate->getSuperficieParcelle2();
					$superficieParcelle3 = $mandate->getSuperficieParcelle3();
					$superficieAutreParcelle = $mandate->getSuperficieAutreParcelle();
					$superficieConstructible = $mandate->getSuperficieConstructible();
					$superficieNonConstructible = $mandate->getSuperficieNonConstructible();
					$superficieTotale = $mandate->getSuperficieTotale();
					$ShonAccorde = $mandate->getSHONAccordee();
					$zoneBdf = $mandate->getZoneBdf();
					$ligneCrete= $mandate->getLigneDeCrete();
					$zoneInondable= $mandate->getZoneInondable();
					$reglementDeLotissement= $mandate->getReglementDeLotissement();
					$ernt = $mandate->getERNT();
					$dPValide = $mandate->getDPValide();
					$cuValide = $mandate->getCuValide();
					$cuOpsValide = $mandate->getCuOPSValide();
					$permisAmenagerValide = $mandate->getPermisDamenagerValide();
					$terrainViabilise = $mandate->getTerrainVenduViabilise();
					$terrainSemiViabilise = $mandate->getTerrainVenduSemiViabilise();
					$terrainNonViabilise = $mandate->getTerrainVenduNonViabilise();
					$passageEau = $mandate->getPassageEau();
					$passageElectricite = $mandate->getPassageElectricite();
					$passageGaz = $mandate->getPassageGaz();
					$toutALEgout = $mandate->getToutALegout();
					$assainissementParFosseSceptique = $mandate->getAssainissementParFosseSceptique();
					$voirie = $mandate->getVoirie();
					$tailleFacade = $mandate->getTailleFacade();
					$profondeurTerrain = $mandate->getProfondeurTerrain();
					$nouveauteSite = $mandate->getNouveaute()==null?date(Constant::DATE_FORMAT2):date(Constant::DATE_FORMAT2,$mandate->getNouveaute());
					$dateDeclPrealableDP =$mandate->getDateDeclarationPrealable()==null||$mandate->getDateDeclarationPrealable()==""?'': date(Constant::DATE_FORMAT2,$mandate->getDateDeclarationPrealable());
					$dateProrogationDP = $mandate->getProrogationDPJusquau()==null?'':date(Constant::DATE_FORMAT2,$mandate->getProrogationDPJusquau());
					$dateCu  =  $mandate->getDateCU()==null?'':date(Constant::DATE_FORMAT2,$mandate->getDateCU());
					$dateProrogationCu = $mandate->getProrogationCUJusquau()==null?'':date(Constant::DATE_FORMAT2,$mandate->getProrogationCUJusquau());
					$dateDeclPrealableCUOPS = $mandate->getDateCuOPS()==null?'':date(Constant::DATE_FORMAT2,$mandate->getDateCuOPS());
					$dateProrogationCUOPS = $mandate->getProrogationCuOPSJusquau()==null?'':date(Constant::DATE_FORMAT2,$mandate->getProrogationCuOPSJusquau());
					$datePermisAmenager =$mandate->getDatePermisDamenager()==null?'': date(Constant::DATE_FORMAT2,$mandate->getDatePermisDamenager());

					$commentaire = $mandate->getCommentaire();
					$geo = $mandate->getGeolocalisation();
					$aGeo = explode(',',$geo);
					$latitude = $aGeo[0];
					$longitude = $aGeo[1];
					$proximiteEcole = $mandate->getProximiteEcole();
					$proximiteCommerce = $mandate->getProximiteCommerce();
					$proximiteTransport = $mandate->getProximiteTransport();
					$commentaireApparent = $mandate->getCommentaireApparent();
					$idGeometer =$mandate->getGeometer()==null?0: $mandate->getGeometer()->getIdMandateGeometer();
					$idBornageTerrain =$mandate->getBornageTerrain()==null?0:$mandate->getBornageTerrain()->getIdMandateBornageTerrain() ;
					$idZonagePlu = $mandate->getZonagePLU()==null?0:$mandate->getZonagePLU()->getIdMandateZonagePLU() ;
					$idZonageRnu = $mandate->getZonageRNU()==null?0:$mandate->getZonageRNU()->getIdMandateZonageRNU() ;
					$idCos= $mandate->getCos()==null?0:$mandate->getCos()->getIdMandateCOS() ;
					$idWaterCorresponding = $mandate->getWaterCorresponding()==null?0:$mandate->getWaterCorresponding()->getIdMandateWaterCorresponding() ;
					$idElectricCorresponding=$mandate->getElectricCorresponding()==null?0: $mandate->getElectricCorresponding()->getIdMandateElectricCorresponding() ;
					$idGazCorresponding=$mandate->getGazCorresponding()==null?0: $mandate->getGazCorresponding()->getIdMandateGazCorresponding() ;
					$idSanitationCorresponding=$mandate->getSanitationCorresponding()==null?0: $mandate->getSanitationCorresponding()->getIdMandateSanitationCorresponding() ;
					$idOrientation=$mandate->getOrientation()==null?0: $mandate->getOrientation()->getIdMandateOrientation() ;
					$idSlope=$mandate->getSlope()==null?0:$mandate->getSlope()->getIdMandateSlope() ;

					// champs spécifiques mandats
					$nbPiece = $mandate->getNbPiece();
					$nbChambre = $mandate->getNbChambre();
					$surfaceHab = $mandate->getSurfaceHabitable();
					$surfacePieceVie = $mandate->getSurfacePieceVie();
					$niveau = $mandate->getNiveau();
					$anneeConstruction = $mandate->getAnneeConstruction();
					$chargesMensuelle = $mandate->getChargesMensuelle();
					$taxesFoncieres = $mandate->getTaxesFonciere();
					$taxeHabitation = $mandate->getTaxeHabitation();


					$pubinternet = $mandate->getPubInternet();

					$coupCoeur = $mandate->getCoupCoeur()?'on':false;
					$cheminee = $mandate->getCheminee()?'on':false;
					$cuisineEquipee =$mandate->getCuisineEquipee()?'on':false;
					$cuisineAmenagee=$mandate->getCuisineAmenagee()?'on':false;
					$piscine=$mandate->getPiscine()?'on':false;
					$poolHouse=$mandate->getPoolHouse()?'on':false;
					$terrasse=$mandate->getTerrasse()?'on':false;
					$mezzanine=$mandate->getMezzanine()?'on':false;
					$dependance=$mandate->getDependance()?'on':false;
					$gaz=$mandate->getGaz()?'on':false;
					$cave=$mandate->getCave()?'on':false;
					$ssol=$mandate->getSousSol()?'on':false;
					$garage=$mandate->getGarage()?'on':false;
					$parking=$mandate->getParking()?'on':false;
					$rezDeJardin=$mandate->getRezDeJardin()?'on':false;
					$plainPied=$mandate->getPlainPied()?'on':false;
					$carriere=$mandate->getCarriere()?'on':false;
					$ptEau=$mandate->getPointEau()?'on':false;
					$ttEgout=$mandate->getToutALegout()?'on':false;


					// listes :
					$insulation = $mandate->getInsulation()?$mandate->getInsulation()->getIdMandateInsulation():0;
					$roof= $mandate->getRoof()?$mandate->getRoof()->getIdMandateRoof():0;
					$heating= $mandate->getHeating()?$mandate->getHeating()->getIdMandateHeating():0;
					$commonOwnership= $mandate->getCommonOwnership()?$mandate->getCommonOwnership()->getIdMandateCommonOwnership():0;
					$constructionType= $mandate->getConstruction()?$mandate->getConstruction()->getIdMandateConstructionType():0;
					$style= $mandate->getStyle()?$mandate->getStyle()->getIdMandateStyle():0;
					$ne= $mandate->getNews()?$mandate->getNews()->getIdMandateNews():0;
					$conditions= $mandate->getCondition()?$mandate->getCondition()->getIdMandateCondition():0;

					$adjoining= $mandate->getMandateAdjoining()?$mandate->getMandateAdjoining()->getId():0;

					// dpe
					$dpeConsoEner = $valDpe==null?'':$valDpe->getConsoEner();
					$dpeEmissionGaz = $valDpe==null?'':$valDpe->getEmissionGaz();



					$numbergarage= $mandate->getNumberGarage();
					$numbercellar= $mandate->getNumberCellar();
					$numberparking=$mandate->getNumberParking();
					$numberattic =$mandate->getNumberAttic();

				}else{
					$adjoining = $post['adjoining'];
					$nouveauteSite = $post['nouveauteSite'];
					// Renseignement des valeurs avec post.
					$superficieParcelle1 =$post['superficieParcelle1'];
					$superficieParcelle2 = $post['superficieParcelle2'];
					$superficieParcelle3 = $post['superficieParcelle3'];
					$superficieAutreParcelle = $post['superficieAutreParcelle'];
					$superficieConstructible =$post['superficieConstructible'];
					$superficieNonConstructible = $post['superficieNonConstructible'];
					$superficieTotale = $post['superficieTotale'];
					$ShonAccorde = $post['shonAccordee'];
					$zoneBdf = $post['zonebdf'];
					$ligneCrete=$post['ligneCrete'];
					$zoneInondable=$post['zoneInondable'];
					$reglementDeLotissement= htmlspecialchars($post['reglementLotissement']);
					$ernt =$post['ernt'];
					$dPValide = $post['dPValide'];
					$cuValide = $post['cuValide'];
					$cuOpsValide = $post['cuOpsValide'];
					$permisAmenagerValide = $post['permisAmenagerValide'];
					$terrainViabilise = $post['terrainViabilise'];
					$terrainSemiViabilise = $post['terrainSemiViabilise'];
					$terrainNonViabilise = $post['terrainNonViabilise'];
					$passageEau = htmlspecialchars($post['passageEau']);
					$passageElectricite = htmlspecialchars($post['passageElectricite']);
					$passageGaz = htmlspecialchars($post['passageGaz']);
					$toutALEgout = $post['toutEgout'];
					$assainissementParFosseSceptique = $post['assainissementFosseSceptique'];
					$voirie = htmlspecialchars($post['voirie']);
					$tailleFacade = $post['tailleFacade'];
					$profondeurTerrain = $post['profondeurTerrain'];
					$commentaire = htmlspecialchars($post['commentaire']);
					$latitude = $post['geolocLatitude'];
					$longitude = $post['geolocLongitude'];
					$proximiteEcole = $post['proximiteEcole'];
					$proximiteCommerce = $post['proximiteCommerce'];
					$proximiteTransport = $post['proximiteTransport'];
					$commentaireApparent = htmlspecialchars($post['commentaireApparent']);
					$idGeometer =$post['idGeometer'];
					$idBornageTerrain =$post['idBornageTerrain'];
					$idZonagePlu = $post['idZonagePlu'];
					$idZonageRnu = $post['idZonageRnu'];
					$idCos= $post['idCos'];
					$idWaterCorresponding = $post['idWaterCorresponding'];
					$idElectricCorresponding=$post['idElectricCorresponding'];
					$idGazCorresponding=$post['idGazCorresponding'];
					$idSanitationCorresponding=$post['idSanitationCorresponding'];
					$idOrientation=$post['idOrientation'];
					$idSlope=$post['idSlope'];
					// date
					$dateDeclPrealableDP = $post['dateDeclPrealableDP'];
					$dateProrogationDP = $post['dateProrogationDP'];
					$dateCu  = $post['dateDeclPrealableCU'];
					$dateProrogationCu =$post['dateProrogationCU'];
					$dateDeclPrealableCUOPS = $post['dateDeclPrealableCUOPS'];
					$dateProrogationCUOPS =$post['dateProrogationCUOPS'];
					$datePermisAmenager =$post['datePermisAmenager'];






					// champs spécifiques mandats
					$nbPiece =$post['nbPiece'];
					$nbChambre = $post['nbChambre'];
					$surfaceHab = $post['surfaceHab'];
					$surfacePieceVie = $post['surfacePieceVie'];
					$niveau = $post['niveau'];
					$anneeConstruction = $post['anneeConstruction'];
					$chargesMensuelle = $post['chargesMensuelle'];
					$taxesFoncieres = $post['taxesFoncieres'];
					$taxeHabitation = $post['taxeHabitation'];




					$coupCoeur = $post['coupCoeur']=='on'?'on':false;
					$cheminee = $post['cheminee']=='on'?'on':false;
					$cuisineEquipee =$post['cuisineEquipee']=='on'?'on':false;
					$cuisineAmenagee=$post['cuisineAmenagee']=='on'?'on':false;
					$piscine=$post['piscine']=='on'?'on':false;
					$poolHouse=$post['poolHouse']=='on'?'on':false;
					$terrasse=$post['terrasse']=='on'?'on':false;
					$mezzanine=$post['mezzanine']=='on'?'on':false;
					$dependance=$post['dependance']=='on'?'on':false;
					$gaz=$post['gaz']=='on'?'on':false;
					$cave=$post['cave']=='on'?'on':false;
					$ssol=$post['ssol']=='on'?'on':false;
					$garage=$post['garage']=='on'?'on':false;
					$parking=$post['parking']=='on'?'on':false;
					$rezDeJardin=$post['rezDeJardin']=='on'?'on':false;
					$plainPied=$post['plainPied']=='on'?'on':false;
					$carriere=$post['carriere']=='on'?'on':false;
					$ptEau=$post['ptEau']=='on'?'on':false;
					$ttEgout=$post['ttEgout']=='on'?'on':false;

					$insulation = $post['insulation'];
					$roof = $post['roof'];
					$heating = $post['heating'];
					$commonOwnership = $post['commonOwnership'];
					$constructionType = $post['constructionType'];
					$style = $post['style'];
					$ne = $post['ne'];
					$conditions = $post['conditions'];


					$dpeConsoEner = $post['dpeConsoEner'];
					$dpeEmissionGaz =  $post['dpeEmissionGaz'];
					$pubinternet =$post['pubinternet'];

					$numbergarage=$post['numbergarage'];
					$numbercellar=$post['numbercellar'];
					$numberparking=$post['numberparking'];
					$numberattic =$post['numberattic'];

				}
				if(isset($post['annuler'])){
					header('location:'.Tools::create_url($this->_user,$get['module'],'see',$get['action']));
				}
				if(isset($post['valider'])){
					// verif des erreurs
					if(!Tools::is_int($superficieParcelle1)) $error[]=Lang::ERROR_SUPERCICIE_PARCELLE_1_ISN_T_INT;
					if(!Tools::is_int($superficieParcelle2)) $error[]=Lang::ERROR_SUPERCICIE_PARCELLE_2_ISN_T_INT;
					if(!Tools::is_int($superficieParcelle3)) $error[]=Lang::ERROR_SUPERCICIE_PARCELLE_3_ISN_T_INT;
					if(!Tools::is_int($superficieAutreParcelle)) $error[]=Lang::ERROR_SUPERCICIE_AUTRE_PARCELLE_ISN_T_INT;
					if(!Tools::is_int($superficieConstructible)) $error[]=Lang::ERROR_SUPERCICIE_CONSTRUCTIBLE_ISN_T_INT;
					if(!Tools::is_int($superficieNonConstructible)) $error[]=Lang::ERROR_SUPERCICIE_NON_CONSTRUCTIBLE_ISN_T_INT;
					if(!Tools::is_int($superficieTotale)) $error[]=Lang::ERROR_SUPERCICIE_TOTALE_ISN_T_INT;
					if(!Tools::is_int($ShonAccorde)) $error[]=Lang::ERROR_SHON_ACCORDEE_ISN_T_INT;
					if(
					(!Tools::is_date_fr($dateDeclPrealableDP)&&$dateDeclPrealableDP!='')||
					(!Tools::is_date_fr($dateProrogationDP)&&$dateProrogationDP!='')||
					(!Tools::is_date_fr($dateCu)&&$dateCu!='')||
					(!Tools::is_date_fr($dateProrogationCu)&&$dateProrogationCu!='')||
					(!Tools::is_date_fr($dateProrogationCUOPS)&&$dateProrogationCUOPS!='')||
					(!Tools::is_date_fr($dateDeclPrealableCUOPS)&&$dateDeclPrealableCUOPS!='')||
					(!Tools::is_date_fr($datePermisAmenager)&&$datePermisAmenager!='')
					)$error[]=Lang::ERROR_DATE_FORMAT_FR;
					// latitude et longitude
					if(!is_numeric($latitude)&&(!empty($latitude)))$error[]=Lang::ERROR_FORMAT_LATITUDE;
					if(!is_numeric($longitude)&&!empty($longitude))$error[]=Lang::ERROR_FORMAT_LONGITUDE;
					if(($longitude==''&&$latitude!='')||($longitude!=''&&$latitude=='')) $error[]= Lang::ERROR_EMPTY_LATITUDE_OR_LONGITUDE;
					// Si pas d'erreurs, validation
					if(empty($error)){
						$mandate->setSuperficieParcelle1($superficieParcelle1,false);
						$mandate->setSuperficieParcelle2($superficieParcelle2,false);
						$mandate->setSuperficieParcelle3($superficieParcelle3,false);
						$mandate->setSuperficieAutreParcelle($superficieAutreParcelle,false);
						$mandate->setSuperficieConstructible($superficieConstructible,false);
						$mandate->setSuperficieNonConstructible($superficieNonConstructible,false);
						$mandate->setSuperficieTotale($superficieTotale,false);
						$mandate->setGeometer(MandateGeometer::load($this->_pdo,$idGeometer),false);
						$mandate->setBornageTerrain(MandateBornageTerrain::load($this->_pdo,$idBornageTerrain),false);
						$mandate->setZonagePLU(MandateZonagePLU::load($this->_pdo,$idZonagePlu),false);
						$mandate->setZonageRNU(MandateZonageRNU::load($this->_pdo,$idZonageRnu),false);
						$mandate->setCos(MandateCos::load($this->_pdo,$idCos),false);
						$mandate->setSHONAccordee($ShonAccorde,false);
						$mandate->setZoneBDF($zoneBdf,false);
						$mandate->setLigneDeCrete($ligneCrete,false);
						$mandate->setZoneInondable($zoneInondable,false);
						$mandate->setReglementDeLotissement($reglementDeLotissement,false);
						$mandate->setERNT($ernt,false);
						$mandate->setDPValide($dPValide,false);
						$mandate->setDateDeclarationPrealable( $dateDeclPrealableDP==''?null: Tools::dateFrToTime($dateDeclPrealableDP),false);
						$mandate->setProrogationDPJusquau( $dateProrogationDP==''?null:Tools::dateFrToTime($dateProrogationDP),false);
						$mandate->setCuValide($cuValide,false);
						$mandate->setDateCU($dateCu==''?null:Tools::dateFrToTime($dateCu),false);
						$mandate->setProrogationCUJusquau($dateProrogationCu==''?null:Tools::dateFrToTime($dateProrogationCu),false);
						$mandate->setCuOPSValide($cuOpsValide,false);
						$mandate->setDateCuOPS($dateDeclPrealableCUOPS==''?null:Tools::dateFrToTime($dateDeclPrealableCUOPS));
						$mandate->setProrogationCuOPSJusquau($dateProrogationCUOPS==''?null:Tools::dateFrToTime($dateProrogationCUOPS),false);
						$mandate->setPermisDamenagerValide($permisAmenagerValide,false);
						$mandate->setDatePermisDamenager($datePermisAmenager==''?null:Tools::dateFrToTime($datePermisAmenager),false);
						$mandate->setTerrainVenduViabilise($terrainViabilise,false);
						$mandate->setTerrainVenduSemiViabilise($terrainSemiViabilise,false);
						$mandate->setTerrainVenduNonViabilise($terrainNonViabilise,false);
						$mandate->setPassageEau($passageEau,false);
						$mandate->setPassageElectricite($passageElectricite,false);
						$mandate->setPassageGaz($passageGaz,false);
						$mandate->setWaterCorresponding(MandateWaterCorresponding::load($this->_pdo,$idWaterCorresponding),false);
						$mandate->setElectricCorresponding(MandateElectricCorresponding::load($this->_pdo,$idElectricCorresponding),false);
						$mandate->setGazCorresponding(MandateGazCorresponding::load($this->_pdo,$idGazCorresponding),false);
						$mandate->setToutALegout($toutALEgout,false);
						$mandate->setAssainissementParFosseSceptique($assainissementParFosseSceptique,false);
						$mandate->setSanitationCorresponding(MandateSanitationCorresponding::load($this->_pdo,$idSanitationCorresponding),false);
						$mandate->setVoirie($voirie,false);
						$mandate->setOrientation(MandateOrientation::load($this->_pdo,$idOrientation),false);
						$mandate->setSlope(MandateSlope::load($this->_pdo,$idSlope),false);
						$mandate->setTailleFacade($tailleFacade,false);
						$mandate->setProfondeurTerrain($profondeurTerrain,false);
						$mandate->setCommentaire($commentaire,false);
						$mandate->setGeolocalisation($latitude!=''&&$longitude!=''?str_replace(',','.',$latitude).','.str_replace(',','.',$longitude):'',false);
						$mandate->setProximiteEcole($proximiteEcole,false);
						$mandate->setProximiteCommerce($proximiteCommerce,false);
						$mandate->setProximiteTransport($proximiteTransport,false);
						$mandate->setCommentaireApparent($commentaireApparent,false);

						$mandate->setNouveaute($nouveauteSite==''?null:Tools::dateFrToTime( $nouveauteSite),false);
						$mandate->setNbPiece($nbPiece,false);

						$mandate->setNbChambre($nbChambre,false);
						$mandate->setSurfaceHabitable($surfaceHab,false);
						$mandate->setSurfacePieceVie($surfacePieceVie,false);
						$mandate->setNiveau($niveau,false);
						$mandate->setAnneeConstruction($anneeConstruction,false);
						$mandate->setChargesMensuelle($chargesMensuelle,false);
						$mandate->setTaxesFonciere($taxesFoncieres,false);
						$mandate->setTaxeHabitation($taxeHabitation,false);
							
						$mandate->setCoupCoeur($coupCoeur=='on'?1:0,false);
						$mandate->setCheminee($cheminee=='on'?1:0,false);
						$mandate->setCuisineEquipee($cuisineEquipee=='on'?1:0,false);
						$mandate->setCuisineAmenagee($cuisineAmenagee=='on'?1:0,false);
						$mandate->setPiscine($piscine=='on'?1:0,false);
						$mandate->setPoolHouse($poolHouse=='on'?1:0,false);
						$mandate->setTerrasse($terrasse=='on'?1:0,false);
						$mandate->setMezzanine($mezzanine=='on'?1:0,false);
						$mandate->setDependance($dependance=='on'?1:0,false);
						$mandate->setGaz($gaz=='on'?1:0,false);
						$mandate->setCave($cave=='on'?1:0,false);
						$mandate->setSousSol($ssol=='on'?1:0,false);
						$mandate->setGarage($garage=='on'?1:0,false);
						$mandate->setParking($parking=='on'?1:0,false);
						$mandate->setRezDeJardin($rezDeJardin=='on'?1:0,false);
						$mandate->setPlainPied($plainPied=='on'?1:0,false);
						$mandate->setCarriere($carriere=='on'?1:0,false);
						$mandate->setPointEau($ptEau=='on'?1:0,false);
						$mandate->setToutALegout($ttEgout=='on'?1:0,false);
							
						$mandate->setInsulation($insulation!=0?MandateInsulation::load($this->_pdo,$insulation):null,false);
						$mandate->setRoof($roof!=0?MandateRoof::load($this->_pdo,$roof):null,false);
						$mandate->setHeating($heating!=0?MandateHeating::load($this->_pdo,$heating):null,false);
						$mandate->setCommonOwnership($commonOwnership!=0?MandateCommonOwnership::load($this->_pdo,$commonOwnership):null,false);
						$mandate->setConstruction($constructionType!=0?MandateConstructionType::load($this->_pdo,$constructionType):null,false);

						$mandate->setMandateAdjoining($adjoining!=0?MandateAdjoining::load($this->_pdo,$adjoining):null,false);

						$mandate->setStyle($style!=0?MandateStyle::load($this->_pdo,$style):null,false);

						$mandate->setNews($ne!=0?MandateNews::load($this->_pdo,$ne):null,false);
						$mandate->setCondition($conditions!=0?MandateCondition::load($this->_pdo,$conditions):null,false);
						$mandate->setPubInternet($pubinternet,false);


						$mandate->setNumberGarage($numbergarage,false);
						$mandate->setNumberCellar($numbercellar,false);
						$mandate->setNumberParking($numberparking,false);
						$mandate->setNumberAttic($numberattic,false);
						// manque les plans
						$mandate->update();

						// dpe
						if($valDpe==null)
						// savegarde d'un nouveau dpe
						ValDpe::create($this->_pdo,$dpeConsoEner,$dpeEmissionGaz,$mandate);
						else{
							$valDpe->setConsoEner($dpeConsoEner);
							$valDpe->setEmissionGaz($dpeEmissionGaz);
						}

						Log::create($this->_pdo,time(),'mandat','Ajout/Modification des informations complementaires du terrain '.$mandate->getNumberMandate(),$this->_user);
						header('location:'.Tools::create_url($this->_user,$get['module'],'see',$get['action']));
					}
				}
					
			}
			$this->_smarty->assign('nouveauteSite',$nouveauteSite);
			$this->_smarty->assign('adjoining',$adjoining);
			$this->_smarty->assign('superficieParcelle1',$superficieParcelle1==0?'':$superficieParcelle1);
			$this->_smarty->assign('superficieParcelle2',$superficieParcelle2==0?'':$superficieParcelle2);
			$this->_smarty->assign('superficieParcelle3',$superficieParcelle3==0?'':$superficieParcelle3);
			$this->_smarty->assign('superficieAutreParcelle',$superficieAutreParcelle==0?'':$superficieAutreParcelle);
			$this->_smarty->assign('superficieConstructible',$superficieConstructible==0?'':$superficieConstructible);
			$this->_smarty->assign('superficieNonConstructible',$superficieNonConstructible==0?'':$superficieNonConstructible);
			$this->_smarty->assign('superficieTotale',$superficieTotale==0?'':$superficieTotale);
			$this->_smarty->assign('shonAccordee',$ShonAccorde==0?'':$ShonAccorde);
			$this->_smarty->assign('tailleFacade',$tailleFacade==0?'':$tailleFacade);
			$this->_smarty->assign('profondeurTerrain',$profondeurTerrain==0?'':$profondeurTerrain);
			$this->_smarty->assign('geolocLatitude',$latitude==0?'':$latitude);
			$this->_smarty->assign('geolocLongitude',$longitude==0?'':$longitude);
			$this->_smarty->assign('proximiteEcole',$proximiteEcole==0?'':$proximiteEcole);
			$this->_smarty->assign('proximiteCommerce',$proximiteCommerce==0?'':$proximiteCommerce);
			$this->_smarty->assign('proximiteTransport',$proximiteTransport==0?'':$proximiteTransport);
			$this->_smarty->assign('idGeometer',$idGeometer==0?'':$idGeometer);
			$this->_smarty->assign('idBornageTerrain',$idBornageTerrain==0?'':$idBornageTerrain);
			$this->_smarty->assign('idZonagePlu',$idZonagePlu==0?'':$idZonagePlu);
			$this->_smarty->assign('idZonageRnu',$idZonageRnu==0?'':$idZonageRnu);
			$this->_smarty->assign('idCos',$idCos==0?'':$idCos);
			$this->_smarty->assign('idWaterCorresponding',$idWaterCorresponding==0?'':$idWaterCorresponding);
			$this->_smarty->assign('idElectricCorresponding',$idElectricCorresponding==0?'':$idElectricCorresponding);
			$this->_smarty->assign('idGazCorresponding',$idGazCorresponding==0?'':$idGazCorresponding);
			$this->_smarty->assign('idSanitationCorresponding',$idSanitationCorresponding==0?'':$idSanitationCorresponding);
			$this->_smarty->assign('idOrientation',$idOrientation==0?'':$idOrientation);
			$this->_smarty->assign('idSlope',$idSlope==0?'':$idSlope);
			$this->_smarty->assign('listAdjoining',MandateAdjoining::loadAll($this->_pdo));
			// bool
			$this->_smarty->assign('zonebdf',$zoneBdf);
			$this->_smarty->assign('ligneCrete',$ligneCrete);
			$this->_smarty->assign('dPValide',$dPValide);
			$this->_smarty->assign('zoneInondable',$zoneInondable);
			$this->_smarty->assign('cuValide',$cuValide);
			$this->_smarty->assign('cuOpsValide',$cuOpsValide);
			$this->_smarty->assign('permisAmenagerValide',$permisAmenagerValide);
			$this->_smarty->assign('terrainViabilise',$terrainViabilise);
			$this->_smarty->assign('terrainSemiViabilise',$terrainSemiViabilise);
			$this->_smarty->assign('terrainNonViabilise',$terrainNonViabilise);
			$this->_smarty->assign('toutEgout',$toutALEgout);
			$this->_smarty->assign('assainissementFosseSceptique',$assainissementParFosseSceptique);
			// String or date
			$this->_smarty->assign('reglementLotissement',$reglementDeLotissement);
			$this->_smarty->assign('ernt',$ernt);
			$this->_smarty->assign('dateDeclPrealableDP',$dateDeclPrealableDP);

			$this->_smarty->assign('dateProrogationDP',$dateProrogationDP);
			$this->_smarty->assign('dateDeclPrealableCU',$dateCu);
			$this->_smarty->assign('dateProrogationCU',$dateProrogationCu);
			$this->_smarty->assign('dateDeclPrealableCUOPS',$dateDeclPrealableCUOPS);
			$this->_smarty->assign('dateProrogationCUOPS',$dateProrogationCUOPS);
			$this->_smarty->assign('datePermisAmenager',$datePermisAmenager);
			$this->_smarty->assign('passageEau',$passageEau);
			$this->_smarty->assign('passageElectricite',$passageElectricite);
			$this->_smarty->assign('passageGaz',$passageGaz);
			$this->_smarty->assign('voirie',$voirie);
			$this->_smarty->assign('commentaire',$commentaire);
			$this->_smarty->assign('commentaireApparent',$commentaireApparent);
			// listes
			$this->_smarty->assign('listGeometer',MandateGeometer::loadAll($this->_pdo));
			$this->_smarty->assign('listBornageTerrain',MandateBornageTerrain::loadAll($this->_pdo));
			$this->_smarty->assign('listZonagePlu',MandateZonagePLU::loadAll($this->_pdo));
			$this->_smarty->assign('listZonageRnu',MandateZonageRNU::loadAll($this->_pdo));
			$this->_smarty->assign('listCos',MandateCOS::loadAll($this->_pdo));
			$this->_smarty->assign('listWaterCorresponding',MandateWaterCorresponding::loadAll($this->_pdo));
			$this->_smarty->assign('listElectricCorresponding',MandateElectricCorresponding::loadAll($this->_pdo));
			$this->_smarty->assign('listGazCorresponding',MandateGazCorresponding::loadAll($this->_pdo));
			$this->_smarty->assign('listSanitationCorresponding',MandateSanitationCorresponding::loadAll($this->_pdo));
			$this->_smarty->assign('listOrientation',MandateOrientation::loadAll($this->_pdo));
			$this->_smarty->assign('listSlope',MandateSlope::loadAll($this->_pdo));

			$this->_smarty->assign('listInsulation',MandateInsulation::loadAll($this->_pdo));
			$this->_smarty->assign('listRoof',MandateRoof::loadAll($this->_pdo));
			$this->_smarty->assign('listHeating',MandateHeating::loadAll($this->_pdo));
			$this->_smarty->assign('listCommonOwnership',MandateCommonOwnership::loadAll($this->_pdo));
			$this->_smarty->assign('listConstructionType',MandateConstructionType::loadAll($this->_pdo));
			$this->_smarty->assign('listStyle',MandateStyle::loadAll($this->_pdo));
			$this->_smarty->assign('listNews',MandateNews::loadAll($this->_pdo));
			$this->_smarty->assign('listConditions',MandateCondition::loadAll($this->_pdo));

			$this->_smarty->assign('nbPiece',$nbPiece);
			$this->_smarty->assign('nbChambre',$nbChambre);
			$this->_smarty->assign('surfaceHab',$surfaceHab );
			$this->_smarty->assign('surfacePieceVie',$surfacePieceVie);
			$this->_smarty->assign('niveau',$niveau );
			$this->_smarty->assign('anneeConstruction',$anneeConstruction);
			$this->_smarty->assign('chargesMensuelle',$chargesMensuelle);
			$this->_smarty->assign('taxesFoncieres',$taxesFoncieres);
			$this->_smarty->assign('taxeHabitation',$taxeHabitation);

			$this->_smarty->assign('coupCoeur',$coupCoeur);
			$this->_smarty->assign('cheminee',$cheminee);
			$this->_smarty->assign('cuisineEquipee',$cuisineEquipee);
			$this->_smarty->assign('cuisineAmenagee',$cuisineAmenagee);
			$this->_smarty->assign('piscine',$piscine);
			$this->_smarty->assign('poolHouse',$poolHouse);
			$this->_smarty->assign('terrasse',$terrasse);
			$this->_smarty->assign('mezzanine',$mezzanine);
			$this->_smarty->assign('dependance',$dependance);
			$this->_smarty->assign('gaz',$gaz);
			$this->_smarty->assign('cave',$cave);
			$this->_smarty->assign('ssol',$ssol);
			$this->_smarty->assign('garage',$garage);
			$this->_smarty->assign('parking',$parking);
			$this->_smarty->assign('rezDeJardin',$rezDeJardin);
			$this->_smarty->assign('plainPied',$plainPied);
			$this->_smarty->assign('carriere',$carriere);
			$this->_smarty->assign('ptEau',$ptEau);
			$this->_smarty->assign('ttEgout',$ttEgout);

			$this->_smarty->assign('insulation',$insulation);
			$this->_smarty->assign('roof',$roof);
			$this->_smarty->assign('heating',$heating);
			$this->_smarty->assign('commonOwnership',$commonOwnership);
			$this->_smarty->assign('constructionType',$constructionType);
			$this->_smarty->assign('style',$style);
			$this->_smarty->assign('ne',$ne);
			$this->_smarty->assign('conditions',$conditions);

			$this->_smarty->assign('dpeConsoEner',$dpeConsoEner);
			$this->_smarty->assign('dpeEmissionGaz',$dpeEmissionGaz);

		}elseif(isset($get['page'])&&$get['page']=='updateDpe'){
			$mandate = Mandate::load($this->_pdo,$get['action']);
			// On regarde que le membre ait le droit de réaliser l'action (pere ou lvl > 3)
			if((($mandate->getUser()->getIdUser()!==$this->_user->getIdUser())&&$this->_user->getLevelMember()->getIdLevelMember()==3)&&($this->_user->getLevelMember()->getIdLevelMember()>2)){
				$this->_error_dependance = true;
				$this->_template = $this->getTplErrorViolationAccess();
				Log::create($this->_pdo,time(),"mandat",'accès non autorisé',$this->_user );
			}else{
				$this->_title = 'Modication du dpe';
				$this->_template = dirname(__FILE__).'/views/updateDpe.tpl';
				// val dpe
				$valDpe = ValDpe::loadByMandate($this->_pdo,Mandate::load($this->_pdo,$get['action']));

				if(empty($post)){
					if($valDpe==null){
						$dpeConsoEner='';
						$dpeEmissionGaz='';
					}else{
						$dpeConsoEner = $valDpe->getConsoEner()==0?'':$valDpe->getConsoEner();
						$dpeEmissionGaz = $valDpe->getEmissionGaz()==0?'':$valDpe->getEmissionGaz();
					}
				}else{
					$dpeConsoEner = $post['dpeConsoEner'];
					$dpeEmissionGaz =  $post['dpeEmissionGaz'];
				}
				if(isset($post['cancel'])){
					//header('location:'.Tools::create_url($this->_user,$get['module'],'see',$get['action']."#dpe"));
					header('location:'.Tools::create_url($this->_user,$get['module'],'see',$get['action']));
				}
				if(isset($post['valid'])){

					//if($post['dpeConsoEner']!=''&&!!Tools::is_int($post['dpeConsoEner']))$error[]='La consommation energétique doit être un entier.';
					//if($post['dpeEmissionGaz']!=''&&!!Tools::is_int($post['dpeEmissionGaz']))$error[]='La valeur d\'emission de gaz doit être un entier.';
					if(empty($error)){
						if($valDpe==null){
							ValDpe::create($this->_pdo,$post['dpeConsoEner'],$post['dpeEmissionGaz'],Mandate::load($this->_pdo,$get['action']) );
						}else{
							$valDpe->setConsoEner($post['dpeConsoEner'],false);
							$valDpe->setEmissionGaz($post['dpeEmissionGaz'],false);
							$valDpe->update();
						}
						Log::create($this->_pdo,time(),"mandat",'Dpe modifié/ajouté',$this->_user );
						header('location:'.Tools::create_url($this->_user,$get['module'],'see',$get['action']));
					}
				}
				$this->_smarty->assign('dpeConsoEner',$dpeConsoEner);
				$this->_smarty->assign('dpeEmissionGaz',$dpeEmissionGaz);
			}
		}elseif(isset($get['page'])&&$get['page']=='updateDesc'){
			$mandate = Mandate::load($this->_pdo,$get['action']);
			// On regarde que le membre ait le droit de réaliser l'action (pere ou lvl > 3)
			if((($mandate->getUser()->getIdUser()!==$this->_user->getIdUser())&&$this->_user->getLevelMember()->getIdLevelMember()==3)&&($this->_user->getLevelMember()->getIdLevelMember()>2)){
				$this->_error_dependance = true;
				$this->_template = $this->getTplErrorViolationAccess();
				Log::create($this->_pdo,time(),"mandat",'accès non autorisé',$this->_user );
			}else{
				$this->_title = 'Mise à jour des informations/descriptions';
				$this->_template = dirname(__FILE__).'/views/updateDesc.tpl';
				$mandate = Mandate::load($this->_pdo,$get['action']);
				if(empty($post)){
					$nbPiece = $mandate->getNbPiece()==0?'':$mandate->getNbPiece();
					$nbChambre = $mandate->getNbChambre()==0?'':$mandate->getNbChambre();
					$surfaceHab = $mandate->getSurfaceHabitable()==0?'':$mandate->getSurfaceHabitable();
					$surfacePieceVie = $mandate->getSurfacePieceVie()==0?'':$mandate->getSurfacePieceVie();
					// superficie totale
					$superficieTotale = $mandate->getSuperficieTotale()==0?'':$mandate->getSuperficieTotale();
					$niveau = $mandate->getNiveau();
					$anneeConstruction = $mandate->getAnneeConstruction()==0?'':$mandate->getAnneeConstruction();
					$chargesMensuelle = $mandate->getChargesMensuelle()==0?'':$mandate->getChargesMensuelle();
					$taxesFoncieres = $mandate->getTaxesFonciere()==0?'':$mandate->getTaxesFonciere();
					$taxeHabitation = $mandate->getTaxeHabitation()==0?'':$mandate->getTaxeHabitation();
					$cheminee = $mandate->getCheminee()?'on':false;
					$cuisineEquipee =$mandate->getCuisineEquipee()?'on':false;
					$cuisineAmenagee=$mandate->getCuisineAmenagee()?'on':false;
					$piscine=$mandate->getPiscine()?'on':false;
					$poolHouse=$mandate->getPoolHouse()?'on':false;
					$terrasse=$mandate->getTerrasse()?'on':false;
					$mezzanine=$mandate->getMezzanine()?'on':false;
					$dependance=$mandate->getDependance()?'on':false;
					$gaz=$mandate->getGaz()?'on':false;
					$cave=$mandate->getCave()?'on':false;
					$ssol=$mandate->getSousSol()?'on':false;
					$garage=$mandate->getGarage()?'on':false;
					$parking=$mandate->getParking()?'on':false;
					$rezDeJardin=$mandate->getRezDeJardin()?'on':false;
					$plainPied=$mandate->getPlainPied()?'on':false;
					$carriere=$mandate->getCarriere()?'on':false;
					$ptEau=$mandate->getPointEau()?'on':false;
					$ttEgout = $mandate->getToutALegout()?'on':false;
					// listes :
					$insulation = $mandate->getInsulation()?$mandate->getInsulation()->getIdMandateInsulation():0;
					$roof= $mandate->getRoof()?$mandate->getRoof()->getIdMandateRoof():0;
					$heating= $mandate->getHeating()?$mandate->getHeating()->getIdMandateHeating():0;
					$commonOwnership= $mandate->getCommonOwnership()?$mandate->getCommonOwnership()->getIdMandateCommonOwnership():0;
					$constructionType= $mandate->getConstruction()?$mandate->getConstruction()->getIdMandateConstructionType():0;
					$style= $mandate->getStyle()?$mandate->getStyle()->getIdMandateStyle():0;
					$ne= $mandate->getNews()?$mandate->getNews()->getIdMandateNews():0;
					$conditions= $mandate->getCondition()?$mandate->getCondition()->getIdMandateCondition():0;
					$adjoining = $mandate->getMandateAdjoining()?$mandate->getMandateAdjoining()->getId():0;
					$nouveauteSite = $mandate->getNouveaute()==''?date('d/m/Y'):date(Constant::DATE_FORMAT2, $mandate->getNouveaute());



					$numbergarage = $mandate->getNumberGarage();
					$numbercellar = $mandate->getNumberCellar();
					$numberparking = $mandate->getNumberParking();
					$numberattic = $mandate->getNumberAttic();
				}else{
					$nouveauteSite = $post['nouveauteSite'];
					$nbPiece =$post['nbPiece'];
					$nbChambre = $post['nbChambre'];
					$surfaceHab = $post['surfaceHab'];
					$surfacePieceVie = $post['surfacePieceVie'];
					$superficieTotale = $post['superficieTotale'];
					$niveau = $post['niveau'];
					$anneeConstruction = $post['anneeConstruction'];
					$chargesMensuelle = $post['chargesMensuelle'];
					$taxesFoncieres = $post['taxesFoncieres'];
					$taxeHabitation = $post['taxeHabitation'];
					$cheminee = $post['cheminee']=='on'?'on':false;
					$cuisineEquipee =$post['cuisineEquipee']=='on'?'on':false;
					$cuisineAmenagee=$post['cuisineAmenagee']=='on'?'on':false;
					$piscine=$post['piscine']=='on'?'on':false;
					$poolHouse=$post['poolHouse']=='on'?'on':false;
					$terrasse=$post['terrasse']=='on'?'on':false;
					$mezzanine=$post['mezzanine']=='on'?'on':false;
					$dependance=$post['dependance']=='on'?'on':false;
					$gaz=$post['gaz']=='on'?'on':false;
					$cave=$post['cave']=='on'?'on':false;
					$ssol=$post['ssol']=='on'?'on':false;
					$garage=$post['garage']=='on'?'on':false;
					$parking=$post['parking']=='on'?'on':false;
					$rezDeJardin=$post['rezDeJardin']=='on'?'on':false;
					$plainPied=$post['plainPied']=='on'?'on':false;
					$carriere=$post['carriere']=='on'?'on':false;
					$ptEau=$post['ptEau']=='on'?'on':false;

					$ttEgout=$post['ttEgout']=='on'?'on':false;

					$insulation = $post['insulation'];
					$roof = $post['roof'];
					$heating = $post['heating'];
					$commonOwnership = $post['commonOwnership'];
					$constructionType = $post['constructionType'];
					$style = $post['style'];
					$ne = $post['ne'];
					$conditions = $post['conditions'];
					$adjoining = $post['adjoining'];


					$numbergarage = $post['numbergarage'];
					$numbercellar = $post['numbercellar'];
					$numberparking = $post['numberparking'];
					$numberattic = $post['numberattic'];

				}
				if(isset($post['cancel'])){
					header('location:'.Tools::create_url($this->_user,$get['module'],'see',$get['action']));
				}if(isset($post['valid'])){
					if($nbPiece!=''&&!Tools::is_int($nbPiece))$error[]='Le nombre de pièce doit être un entier';
					if($nbChambre!=''&&!Tools::is_int($nbChambre))$error[]='Le nombre de chambre doit être un entier';
					if($surfaceHab!=''&&!Tools::is_int($surfaceHab))$error[]='La surface habitable doit être un entier';
					if($surfacePieceVie!=''&&!Tools::is_int($surfacePieceVie))$error[]='La surface pièce vie doit être un entier';
					if($anneeConstruction!=''&&!Tools::is_int($anneeConstruction))$error[]='L\'année de construction doit être un entier';
					if($chargesMensuelle!=''&&!Tools::is_int($chargesMensuelle))$error[]='La valeur des charges mensuelles doit être un entier';
					if($taxesFoncieres!=''&&!Tools::is_int($taxesFoncieres))$error[]='La valeur des taxes foncieres doit être un entier';
					if($taxeHabitation!=''&&!Tools::is_int($taxeHabitation))$error[]='La valeur de la taxe habitation doit être un entier';
					if($nouveauteSite!=''&&!Tools::is_date_fr($nouveauteSite))$error[]='La nouveauté doit être de la forme jj/mm/aaaa';
					if(empty($error)){
						$mandate->setNouveaute( Tools::dateFrToTime($nouveauteSite),false); $mandate->setNbPiece($nbPiece,false); $mandate->setNbChambre($nbChambre,false);
						$mandate->setSurfaceHabitable($surfaceHab,false); $mandate->setSurfacePieceVie($surfacePieceVie,false);$mandate->setNiveau($niveau,false);
						$mandate->setAnneeConstruction($anneeConstruction,false); $mandate->setChargesMensuelle($chargesMensuelle,false); $mandate->setTaxesFonciere($taxesFoncieres,false);
						$mandate->setTaxeHabitation($taxeHabitation,false); $mandate->setCheminee($cheminee=='on'?1:0,false); $mandate->setCuisineEquipee($cuisineEquipee=='on'?1:0,false);
						$mandate->setCuisineAmenagee($cuisineAmenagee=='on'?1:0,false);$mandate->setPiscine($piscine=='on'?1:0,false);$mandate->setPoolHouse($poolHouse=='on'?1:0,false);
						$mandate->setTerrasse($terrasse=='on'?1:0,false);$mandate->setMezzanine($mezzanine=='on'?1:0,false);$mandate->setDependance($dependance=='on'?1:0,false);
						$mandate->setGaz($gaz=='on'?1:0,false);$mandate->setCave($cave=='on'?1:0,false);$mandate->setSousSol($ssol=='on'?1:0,false);$mandate->setGarage($garage=='on'?1:0,false);
						$mandate->setParking($parking=='on'?1:0,false);$mandate->setRezDeJardin($rezDeJardin=='on'?1:0,false);$mandate->setPlainPied($plainPied=='on'?1:0,false);$mandate->setCarriere($carriere=='on'?1:0,false);
						$mandate->setPointEau($ptEau=='on'?1:0,false);$mandate->setInsulation(MandateInsulation::load($this->_pdo,$insulation),false);$mandate->setRoof(MandateRoof::load($this->_pdo,$roof),false);
						$mandate->setHeating(MandateHeating::load($this->_pdo,$heating),false);$mandate->setCommonOwnership(MandateCommonOwnership::load($this->_pdo,$commonOwnership),false);
						$mandate->setConstruction(MandateConstructionType::load($this->_pdo,$constructionType),false);$mandate->setStyle(MandateStyle::load($this->_pdo,$style),false);
						$mandate->setNews(MandateNews::load($this->_pdo,$ne),false);// news$mandate->setCondition(MandateCondition::load($this->_pdo, $conditions),false);
						$mandate->setSuperficieTotale($superficieTotale,false); $mandate->setToutALegout($ttEgout=='on'?1:0,false);

						$mandate->setMandateAdjoining( MandateAdjoining::load($this->_pdo,$adjoining) ,false);


						$mandate->setNumberGarage($numbergarage,false);
						$mandate->setNumberCellar($numbercellar,false);
						$mandate->setNumberParking($numberparking,false);
						$mandate->setNumberAttic($numberattic,false);
							



						$mandate->update();
						Log::create($this->_pdo,time(),"mandat",'informations/descriptions modifiées/ajoutées',$this->_user );
						header('location:'.Tools::create_url($this->_user,$get['module'],'see',$get['action']));
					}
				}
				$this->_smarty->assign('nouveauteSite',$nouveauteSite);
				$this->_smarty->assign('listInsulation',MandateInsulation::loadAll($this->_pdo));
				$this->_smarty->assign('listRoof',MandateRoof::loadAll($this->_pdo));
				$this->_smarty->assign('listHeating',MandateHeating::loadAll($this->_pdo));
				$this->_smarty->assign('listCommonOwnership',MandateCommonOwnership::loadAll($this->_pdo));
				$this->_smarty->assign('listConstructionType',MandateConstructionType::loadAll($this->_pdo));
				$this->_smarty->assign('listStyle',MandateStyle::loadAll($this->_pdo));
				$this->_smarty->assign('listNews',MandateNews::loadAll($this->_pdo));
				$this->_smarty->assign('listConditions',MandateCondition::loadAll($this->_pdo));
				$this->_smarty->assign('listAdjoining',MandateAdjoining::loadAll($this->_pdo));
				$this->_smarty->assign('nbPiece',$nbPiece);
				$this->_smarty->assign('nbChambre',$nbChambre);
				$this->_smarty->assign('surfaceHab',$surfaceHab );
				$this->_smarty->assign('surfacePieceVie',$surfacePieceVie);
				$this->_smarty->assign('superficieTotale',$superficieTotale);
				$this->_smarty->assign('niveau',$niveau );
				$this->_smarty->assign('anneeConstruction',$anneeConstruction);
				$this->_smarty->assign('chargesMensuelle',$chargesMensuelle);
				$this->_smarty->assign('taxesFoncieres',$taxesFoncieres);
				$this->_smarty->assign('taxeHabitation',$taxeHabitation);
				$this->_smarty->assign('cheminee',$cheminee);
				$this->_smarty->assign('cuisineEquipee',$cuisineEquipee);
				$this->_smarty->assign('cuisineAmenagee',$cuisineAmenagee);
				$this->_smarty->assign('piscine',$piscine);
				$this->_smarty->assign('ttEgout',$ttEgout);
				$this->_smarty->assign('poolHouse',$poolHouse);
				$this->_smarty->assign('terrasse',$terrasse);
				$this->_smarty->assign('mezzanine',$mezzanine);
				$this->_smarty->assign('dependance',$dependance);
				$this->_smarty->assign('gaz',$gaz);
				$this->_smarty->assign('cave',$cave);
				$this->_smarty->assign('ssol',$ssol);
				$this->_smarty->assign('garage',$garage);
				$this->_smarty->assign('parking',$parking);
				$this->_smarty->assign('rezDeJardin',$rezDeJardin);
				$this->_smarty->assign('plainPied',$plainPied);
				$this->_smarty->assign('carriere',$carriere);
				$this->_smarty->assign('ptEau',$ptEau);
				$this->_smarty->assign('insulation',$insulation);
				$this->_smarty->assign('roof',$roof);
				$this->_smarty->assign('heating',$heating);
				$this->_smarty->assign('commonOwnership',$commonOwnership);
				$this->_smarty->assign('constructionType',$constructionType);
				$this->_smarty->assign('style',$style);
				$this->_smarty->assign('ne',$ne);
				$this->_smarty->assign('conditions',$conditions);
				$this->_smarty->assign('adjoining',$adjoining);


				$this->_smarty->assign('numbergarage',$numbergarage );
				$this->_smarty->assign('numbercellar',$numbercellar );
				$this->_smarty->assign('numberparking',$numberparking );
				$this->_smarty->assign('numberattic',$numberattic);
					
			}

		}elseif(isset($get['page'])&&$get['page']=='updateGen'){
			$mandate = Mandate::load($this->_pdo,$get['action']);
			// si on a le droit (verif à faire)
			if((($mandate->getUser()->getIdUser()!==$this->_user->getIdUser())&&$this->_user->getLevelMember()->getIdLevelMember()==3)&&($this->_user->getLevelMember()->getIdLevelMember()>2)){
				$this->_error_dependance = true;
				$this->_template = $this->getTplErrorViolationAccess();
				Log::create($this->_pdo,time(),"mandat",'accès non autorisé',$this->_user );
			}else{
				$this->_title = 'Mise à jour des éléments par defaut';
				$this->_template = dirname(__FILE__).'/views/updateGen.tpl';
				if(empty($post)){
					$address = $mandate->getAddress();
					$city = $mandate->getCity()->getIdCity();
					$nature = $mandate->getNature()->getIdMandateNature();
					$userSe = $mandate->getUser()->getIdUser();
					$notary = $mandate->getNotary()->getIdNotary();

					$notaryAcq = $mandate->getNotaryAcq()?$mandate->getNotaryAcq()->getIdNotary():null;
					$transactionType = $mandate->getTransactionType()->getIdTransactionType();
					$typeBien = $mandate->getMandateType()->getIdMandateType();
					$numMandat = $mandate->getNumberMandate();
					$debutMandat =date(Constant::DATE_FORMAT2,$mandate->getInitDate());
					$FinMandat=$mandate->getDeadDate()==null?'':date(Constant::DATE_FORMAT2,$mandate->getDeadDate());
					$libreMandat= $mandate->getFreeDate()==null?'':date(Constant::DATE_FORMAT2,$mandate->getFreeDate());
					$prixFAI = round($mandate->getPriceFai(),0);
					$prixNetVendeur = round($mandate->getPriceSeller(),0);
					$commission = round($mandate->getCommission(),0);
					$estimationMini = round($mandate->getEstimationFai(),0);
					$estimationMaxi = round($mandate->getEstimationMaxi(),0);
					$margeNegoce = round($mandate->getMargeNegociation(),0);
					$rental= $mandate->getRental();
					$pricegarage= $mandate->getPriceGarage();
					$pricecellar= $mandate->getPriceCellar();
					$profitability = $mandate->getProfitability();
					$numberlot = $mandate->getNumberLot();
					if($mandate->getGeolocalisation()){
						$geo = explode(',',$mandate->getGeolocalisation());
						$latitude = $geo[0];
						$longitude = $geo[1];
					}else{
						$latitude = '';
						$longitude = '';
					}
				}else{
					$address = $post['address'];
					$city = $post['city'];
					$nature = $post['nature'];
					$userSe = $post['userSe'];
					$notary = $post['notary'];
					$notaryAcq = $post['notaryAcq'];
					$transactionType = $post['transactionType'];
					$typeBien = $post['typeBien'];
					$numMandat = $post['numMandat'];
					$debutMandat =$post['debutMandat'];
					$FinMandat=$post['finMandat'];
					$libreMandat= $post['libreMandat'];
					$prixNetVendeur= $post['prixNetVendeur'];
					$commission= $post['commission'];
					$estimationMini= $post['estimationMini'];
					$estimationMaxi= $post['estimationMaxi'];
					$margeNegoce= $post['margeNegoce'];
					$prixFAI= $post['prixFAI'];
					$latitude = $post['latitude'];
					$longitude = $post['longitude'];

					$rental= $post['rental'];
					$pricegarage=$post['pricegarage'];
					$pricecellar=$post['pricecellar'];
					$profitability = $post['profitability'];
					$numberlot =$post['numberlot'];
				}
				if(isset($post['cancel'])){
					header('location:'.Tools::create_url($this->_user,$get['module'],'see',$get['action']));
				}if(isset($post['valid'])){
					if(empty($error)){
						// Champs se modifiant seul... (+1 ou -1)
						$mandate->getCity()->setNumberUsed( $mandate->getCity()->getNumberUsed() -1);
						$mandate->setCity( City::load($this->_pdo,$city));
						$mandate->getCity()->setNumberUsed( $mandate->getCity()->getNumberUsed() +1);
						// now for user
						if($post['userSe']){
							$mandate->getUser()->setNumberUsed( $mandate->getUser()->getNumberUsed() -1);
							$mandate->setUser( User::load($this->_pdo,$userSe));
							$mandate->getUser()->setNumberUsed( $mandate->getUser()->getNumberUsed() +1);
						}

						if($post['notary']){
							$mandate->getNotary()->setNumberUsed( $mandate->getNotary()->getNumberUsed() -1 );
							$mandate->setNotary(Notary::load($this->_pdo,$notary));
							$mandate->getNotary()->setNumberUsed( $mandate->getNotary()->getNumberUsed() +1 );

						}


							
						if($mandate->getNotaryAcq() ){
							$mandate->getNotaryAcq()->setNumberUsed( $mandate->getNotaryAcq()->getNumberUsed() -1 );
						}
						$mandate->setNotaryAcq( Notary::load($this->_pdo,$notaryAcq) );
						if($mandate->getNotaryAcq() ){
							$mandate->getNotaryAcq()->setNumberUsed( $mandate->getNotaryAcq()->getNumberUsed() +1 );
						}
							
							
							

						$mandate->setAddress($address,false);
						$mandate->setNumberMandate($numMandat,false);
						$mandate->setInitDate(  Tools::dateTimeFrToTime( $debutMandat) ,false);
						if($FinMandat!='')
						$mandate->setDeadDate(  Tools::dateTimeFrToTime( $FinMandat) ,false);
						if($libreMandat!='')
						$mandate->setFreeDate(  Tools::dateTimeFrToTime( $libreMandat) ,false);
						$mandate->setPriceFAI($prixFAI ,false);
						$mandate->setPriceSeller( $prixNetVendeur,false );
						$mandate->setCommission( $commission,false );
						$mandate->setEstimationFai( $estimationMini,false);
						$mandate->setEstimationMaxi($estimationMaxi ,false);
						$mandate->setMargeNegociation($margeNegoce,false);



						$mandate->setRental($rental,false);
						$mandate->setPriceGarage($pricegarage,false);
						$mandate->setPriceCellar($pricecellar,false);
						$mandate->setProfitability($profitability,false);
						$mandate->setNumberLot($numberlot,false);


						if($latitude!=''&&$longitude!=''){
							$mandate->setGeolocalisation(  str_replace(',','.',$latitude).','.str_replace(',','.',$longitude) ,false);
						}else{
							$mandate->setGeolocalisation('',false);
						}
						//
						// load
						$mandate->setNature( MandateNature::load($this->_pdo,$nature),false);

						$mandate->setTransactionType(TransactionType::load($this->_pdo,$transactionType),false);
						$mandate->setMandateType(MandateType::load($this->_pdo,$typeBien),false);
						$mandate->update();
						Log::create($this->_pdo,time(),'mandat','Modification des infos générales du mandat '.$numMandat,$this->_user);
						header('location:'.Tools::create_url($this->_user,$get['module'],'see',$get['action']));
							
					}

				}
				$this->_smarty->assign('listcity',City::loadAll($this->_pdo));
				$this->_smarty->assign('listNature',MandateNature::loadAll($this->_pdo));
				$this->_smarty->assign('listUser',User::loadAll($this->_pdo));
				$this->_smarty->assign('listNotary',Notary::loadAll($this->_pdo));
				$this->_smarty->assign('listTransactionType',TransactionType::loadAll($this->_pdo));
				$this->_smarty->assign('listMandateType',MandateType::loadAll($this->_pdo));
				$this->_smarty->assign('address',$address);
				$this->_smarty->assign('city',$city);
				$this->_smarty->assign('nature',$nature);
				$this->_smarty->assign('userSe',$userSe);
				$this->_smarty->assign('notary',$notary);

				$this->_smarty->assign('notaryAcq',$notaryAcq);

				$this->_smarty->assign('transactionType',$transactionType);
				$this->_smarty->assign('typeBien',$typeBien);
				$this->_smarty->assign('numMandat',$numMandat);
				$this->_smarty->assign('debutMandat',$debutMandat);
				$this->_smarty->assign('finMandat',$FinMandat);
				$this->_smarty->assign('libreMandat',$libreMandat);
				$this->_smarty->assign('prixFAI',$prixFAI);
				$this->_smarty->assign('prixNetVendeur',$prixNetVendeur);
				$this->_smarty->assign('estimationMini',$estimationMini);
				$this->_smarty->assign('estimationMaxi',$estimationMaxi);
				$this->_smarty->assign('commission',$commission);
				$this->_smarty->assign('margeNegoce',$margeNegoce);
				$this->_smarty->assign('latitude',$latitude);
				$this->_smarty->assign('longitude',$longitude);


				$this->_smarty->assign('rental',$rental);
				$this->_smarty->assign('pricegarage',$pricegarage);
				$this->_smarty->assign('pricecellar',$pricecellar);
				$this->_smarty->assign('profitability',$profitability);
				$this->_smarty->assign('numberlot',$numberlot);

			}
		}elseif(isset($get['page'])&&$get['page']=='updatePub'){
			$mandate = Mandate::load($this->_pdo,$get['action']);
			// si on a le droit (verif à faire)
			if((($mandate->getUser()->getIdUser()!==$this->_user->getIdUser())&&$this->_user->getLevelMember()->getIdLevelMember()==3)&&($this->_user->getLevelMember()->getIdLevelMember()>2)){
				$this->_error_dependance = true;
				$this->_template = $this->getTplErrorViolationAccess();
				Log::create($this->_pdo,time(),"mandat",'accès non autorisé',$this->_user );
			}else{
				$this->_title = 'Mise à jour de la pub';
				$this->_template = dirname(__FILE__).'/views/updatePub.tpl';
				$objAfficheEnVitrine = OtherComplementMandate::loadByMandate($this->_pdo,$mandate);
				if(empty($post)){
					$vitrine = $mandate->getCommentaireApparent();
					$pub = $mandate->getPubInternet();
					$coupCoeur = $mandate->getCoupCoeur()==1?'on':'';
					$afficheEnVitrine = $objAfficheEnVitrine?'on':'' ;
				}else{
					$vitrine = $post['vitrine'];
					$pub = $post['pub'];
					$coupCoeur = $post['coupCoeur'];
					$afficheEnVitrine =  $post['afficheEnVitrine'];
				}
					
				// traitement
				if(isset($post['cancel']))
				header('location:'.Tools::create_url($this->_user,$get['module'],'see',$get['action']));
				if(isset($post['valid'])){

					$mandate->setCommentaireApparent($vitrine,false);
					$mandate->setPubInternet($pub,false);
					$mandate->setCoupCoeur( $coupCoeur=='on'?1:0 ,false);
					$mandate->update();
					Log::create($this->_pdo,time(),'mandat','Modification des pub  du mandat '.$mandate->getNumberMandate() ,$this->_user);
					// maj de $afficheEnVitrine
					if($afficheEnVitrine==on){
						if(!$objAfficheEnVitrine){
							OtherComplementMandate::create($this->_pdo,$mandate,true);
						}
					}else{
						// del si il existe
						if($objAfficheEnVitrine){
							$objAfficheEnVitrine->delete();
						}
					}
					header('location:'.Tools::create_url($this->_user,$get['module'],'see',$get['action']));
				}
				// smarty
				$this->_smarty->assign('vitrine',$vitrine);
				$this->_smarty->assign('pub',$pub);
				$this->_smarty->assign('coupCoeur',$coupCoeur);
				$this->_smarty->assign('afficheEnVitrine',$afficheEnVitrine);
			}
		}elseif(isset($get['page'])&&$get['page']=='update'){
			$this->_title = 'Mise à jour des éléments par defaut';
			$this->_template = dirname(__FILE__).'/views/update.tpl';
			$mandate = Mandate::load($this->_pdo,$get['action']);
			// affectations
			if(empty($post)){
				$idUser = $mandate->getUser()->getIdUser();
				$idNotary = $mandate->getNotary()->getIdNotary();
				$numMandat = $mandate->getNumberMandate();
				$debutMandat = $mandate->getInitDate()==''?'':date(Constant::DATE_FORMAT2,$mandate->getInitDate());
				$finMandat = $mandate->getDeadDate()==''&&$mandate->getDeadDate()==null?'':date(Constant::DATE_FORMAT2,$mandate->getDeadDate());
				$libreMandat = $mandate->getFreeDate()==''||!$mandate->getFreeDate()?'':date(Constant::DATE_FORMAT2,$mandate->getFreeDate());
				$adresseMandat = $mandate->getAddress();
				$prixFai = $mandate->getPriceFai();
				$prixNetVendeur = $mandate->getPriceSeller();
				$estimationFai = $mandate->getEstimationFai();
				$commission = $mandate->getCommission();
				$margeNegoce = $mandate->getMargeNegociation();
				$refCadastre1 = $mandate->getReferenceCadastreParcelle1();
				$refCadastre2 = $mandate->getReferenceCadastreParcelle2();
				$refCadastre3 = $mandate->getReferenceCadastreParcelle3();
				$autreRefCadastre = $mandate->getAutreReferenceParcelle();
				$numLot = $mandate->getNumberLot();
				$idCity = $mandate->getCity()->getIdCity();
				$typeTransaction = $mandate->getTransactionType()->getIdTransactionType();
				$typeBien = $mandate->getMandateType()->getIdMandateType();
				$nature = $mandate->getNature()==null?null:$mandate->getNature()->getIdMandateNature();
			}else{
				$idNotary=	$post['idNotary'];
				$numMandat=$post['numMandat'];
				$debutMandat=$post['debutMandat'];
				$finMandat=$post['finMandat'];
				$libreMandat=$post['libreMandat'];
				$adresseMandat=$post['adresseMandat'];
				$prixFai=$post['prixFai'];
				$prixNetVendeur=$post['prixNetVendeur'];
				$estimationFai=$post['estimationFai'];
				$commission=$post['commissionMandat'];
				$margeNegoce=$post['margeNegoce'];
				$refCadastre1=$post['refCadastre1'];
				$refCadastre2=$post['refCadastre2'];
				$refCadastre3=$post['refCadastre3'];
				$autreRefCadastre=$post['autreRefCadastre'];
				$numLot=$post['numLot'];
				$idCity=$post['idCity'];
				$typeTransaction=$post['typeTransaction'];
				$typeBien=$post['typeBien'];
				$nature=$post['nature'];
			}

			$this->_smarty->assign('listTypeTransaction',TransactionType::loadAll($this->_pdo));
			$this->_smarty->assign('listTypeBien',MandateType::loadAll($this->_pdo));
			$this->_smarty->assign('listNature',MandateNature::loadAll($this->_pdo));

			// assignation
			if($this->_user->getLevelMember()->getIdLevelMember()<3||$this->_user->getIdUser()==$mandate->getUser()->getIdUser()){
				$this->_smarty->assign('listUser',User::loadAll($this->_pdo));
				$this->_smarty->assign('idUser',$idUser);
			}
			$this->_smarty->assign('listCity',City::loadAll($this->_pdo));
			// post
			if(isset($post['annuler'])){
				header('location:'.Tools::create_url($this->_user,$get['module'],'see',$get['action']));
			}
			if(isset($post['valider'])){
				// verif de date
				if($post['debutMandat']=='')$error[]=Lang::ERROR_EMPTY_DATE_DEBUT_MANDAT;
				if($post['finMandat']=='')$error[]=Lang::ERROR_EMPTY_DATE_FIN_MANDAT;
				if(
				(!Tools::is_date_fr($post['debutMandat'])&&$post['debutMandat']!='')||
				(!Tools::is_date_fr($post['finMandat'])&&$post['finMandat']!='')||
				(!Tools::is_date_fr($post['libreMandat'])&&$post['libreMandat']!='')
				)$error[] = Lang::ERROR_DATE_FORMAT_FR;
				if(empty($error)){
					$update = false;
					// Prevoir historique de prix si demandé
					if($mandate->getUser()->getIdUser()!= $post['idUser']){
						$update = true;
						$mandate->getUser()->setNumberUsed($mandate->getUser()->getNumberUsed()-1);
						$mandate->setUser(User::load($this->_pdo,$post['idUser']));
						$mandate->getUser()->setNumberUsed($mandate->getUser()->getNumberUsed()+1);
					}
					if($mandate->getNotary()->getIdNotary()!= $post['idNotary']){
						// On supprime une utilisation du notaire (sauvegarde directe)
						$mandate->getNotary()->setNumberUsed($mandate->getNotary()->getNumberUsed()-1);
						// On ajoute le nouveau notaire
						$mandate->setNotary(Notary::load($this->_pdo,$post['idNotary']));
						// On ajoute 1 au nouveau notaire
						$mandate->getNotary()->setNumberUsed($mandate->getNotary()->getNumberUsed()+1);
					}
					if($mandate->getNumberMandate()!=$post['numMandat']){
						$update=true;
						$mandate->setNumberMandate($post['numMandat'],false);
					}
					if($mandate->getInitDate()!= $post['debutMandat']){
						$update = true;
						$mandate->setInitDate( Tools::dateFrToTime($post['debutMandat']),false);
					}
					if($mandate->getDeadDate()!= $post['finMandat']){
						$update = true;
						$mandate->setDeadDate( Tools::dateFrToTime($post['finMandat']),false);
					}
					if($mandate->getfreeDate()!= $post['libreMandat']){
						$update = true;
						$mandate->setfreeDate($post['libreMandat']==''?null: Tools::dateFrToTime($post['libreMandat']),false);
					}
					if($mandate->getAddress()!= $post['adresseMandat']){
						$update = true;
						$mandate->setAddress( htmlspecialchars($post['adresseMandat']),false);
					}
					if($mandate->getCity()->getIdCity()!= $post['idCity']){
						// On supprime une utilisation de l'ancienne ville (sauvegarde directe)
						$mandate->getCity()->setNumberUsed($mandate->getCity()->getNumberUsed()-1);
						// On ajoute la nouvelle ville
						$mandate->setCity(City::load($this->_pdo,$post['idCity']));
						// On ajoute 1 à la nouvelle ville
						$mandate->getCity()->setNumberUsed($mandate->getCity()->getNumberUsed()+1);
					}
					if($mandate->getPriceFai()!= $post['prixFai']){
						$update = true;
						$mandate->setPriceFai( htmlspecialchars($post['prixFai']),false);
					}
					if($mandate->getPriceSeller()!= $post['prixNetVendeur']){
						$update = true;
						$mandate->setPriceSeller( htmlspecialchars($post['prixNetVendeur']),false);
					}
					if($mandate->getCommission()!= $post['commissionMandat']){
						$update = true;
						$mandate->setCommission( htmlspecialchars($post['commissionMandat']),false);
					}
					if($mandate->getEstimationFai()!= $post['estimationFai']){
						$update = true;
						$mandate->setEstimationFai( htmlspecialchars($post['estimationFai']),false);
					}
					if($mandate->getMargeNegociation()!= $post['margeNegoce']){
						$update = true;
						$mandate->setMargeNegociation( htmlspecialchars($post['margeNegoce']),false);
					}
					if($mandate->getReferenceCadastreParcelle1()!= $post['refCadastre1']){
						$update = true;
						$mandate->setReferenceCadastreParcelle1( htmlspecialchars($post['refCadastre1']),false);
					}
					if($mandate->getReferenceCadastreParcelle2()!= $post['refCadastre2']){
						$update = true;
						$mandate->setReferenceCadastreParcelle2( htmlspecialchars($post['refCadastre2']),false);
					}
					if($mandate->getReferenceCadastreParcelle3()!= $post['refCadastre3']){
						$update = true;
						$mandate->setReferenceCadastreParcelle3( htmlspecialchars($post['refCadastre3']),false);
					}
					if($mandate->getAutreReferenceParcelle()!= $post['autreRefCadastre']){
						$update = true;
						$mandate->setAutreReferenceParcelle( htmlspecialchars($post['autreRefCadastre']),false);
					}
					if($mandate->getNumberLot()!= $post['numLot']){
						$update = true;
						$mandate->setNumberLot( htmlspecialchars($post['numLot']),false);
					}


					$mandate->setNature( $post['nature']==''?null:MandateNature::load($this->_pdo,$post['nature']) );

					if($update){
						$mandate->update();
						Log::create($this->_pdo,time(),'mandat','Modification des infos générale du mandat : '.$mandate->getNumberMandate(),$this->_user);
						header('location:'.Tools::create_url($this->_user,$get['module'],'see',$get['action']));
					}
				}
			}
			$this->_smarty->assign('listNotary',Notary::loadAll($this->_pdo));
			$this->_smarty->assign('idNotary',$idNotary);
			$this->_smarty->assign('idCity',$idCity);
			$this->_smarty->assign('numMandat',$numMandat);
			$this->_smarty->assign('debutMandat',$debutMandat);
			$this->_smarty->assign('finMandat',$finMandat);
			$this->_smarty->assign('libreMandat',$libreMandat);
			$this->_smarty->assign('adresseMandat',$adresseMandat);
			$this->_smarty->assign('prixFai',$prixFai);
			$this->_smarty->assign('prixNetVendeur',$prixNetVendeur);
			$this->_smarty->assign('estimationFai',$estimationFai);
			$this->_smarty->assign('commissionMandat',$commission);
			$this->_smarty->assign('margeNegoce',$margeNegoce);
			$this->_smarty->assign('refCadastre1',$refCadastre1);
			$this->_smarty->assign('refCadastre2',$refCadastre2);
			$this->_smarty->assign('refCadastre3',$refCadastre3);
			$this->_smarty->assign('autreRefCadastre',$autreRefCadastre);
			$this->_smarty->assign('numLot',$numLot);
			$this->_smarty->assign('nature',$nature);

			$this->_smarty->assign('typeBien',$typeBien);
			$this->_smarty->assign('typeTransaction',$typeTransaction);
		}elseif(isset($get['page'])&&$get['page']=='cancel'){
			/**
			 * Changement d'etat
			 */
			$this->_title = 'Annulation du mandat';
			$this->_template =dirname(__FILE__).'/views/cancel_mandate.tpl';
			$listEtap = array();
			// Chargement des 2 états
			$listEtap[] = MandateEtap::load($this->_pdo,Constant::ID_ETAP_TO_CANCEL);
			$listEtap[] = MandateEtap::load($this->_pdo,Constant::ID_ETAP_TO_SELL_BY_OTHER);
			if(empty($post)){
				$disabledSellers = 1;
				$reason = '';
				$newEtat = '';
			}else{
				$disabledSellers = $post['disabledSellers'];
				$reason = $post['reason'];
				$newEtat = $post['newEtat'];

				if(isset($post['valid'])){
					$mandate = Mandate::load($this->_pdo,$get['action']);
					$mandate->setEtap(MandateEtap::load($this->_pdo,$post['newEtat']));
					$mandate->setCommentaire( htmlspecialchars( $post['reason'] ) );
					if($post['disabledSellers']==1){
						$sellers = $mandate->listSellers();
						foreach ($sellers as $seller){
							if(Mandate::countMandateBySeller($this->_pdo,$seller,array($mandate->getIdMandate())==0)){
								Seller::load($this->_pdo,$seller->getIdSeller())->setAsset(0);
							}
						}
					}
					Log::create( $this->_pdo,time(),'mandat','Annulation du mandat',$this->_user );
					header('location:'.Tools::create_url($this->_user,$get['module'],'see',$get['action']));
				}
				if(isset($post['cancel'])){
					header('location:'.Tools::create_url($this->_user,$get['module'],'see',$get['action']));
				}
			}
			$this->_smarty->assign('disabledSellers',$disabledSellers);
			$this->_smarty->assign('listEtap',$listEtap);
			$this->_smarty->assign('reason',$reason);
			$this->_smarty->assign('newEtat',$newEtat);
			/**
			 * Fin Changement d'etat
			 */
		}elseif(isset($get['page'])&&$get['page']=='renew'){
			$this->_title = "Reaffecter le mandat";
			$this->_template =dirname(__FILE__).'/views/renew.tpl';

			$mandate = Mandate::load($this->_pdo,$get['action']);

			if(empty($post)){
				$initDate = $mandate->getInitDate()==null?'':date(Constant::DATE_FORMAT2, $mandate->getInitDate() );
				$deadDate = $mandate->getDeadDate()==null?'':date(Constant::DATE_FORMAT2, $mandate->getDeadDate() );
				$freeDate = $mandate->getFreeDate()==null?'':date(Constant::DATE_FORMAT2, $mandate->getFreeDate() );
			}else{
				$initDate = $post['initDate'];
				$deadDate = $post['deadDate'];
				$freeDate = $post['freeDate'];
			}
			if(isset($post['cancel'])){
				header('location:'.Tools::create_url($this->_user,'mandat','see',$get['action']));
			}
			if(isset($post['valid'])){
				$error = array();
				if(empty($post['initDate']))$error[] = Lang::ERROR_EMPTY_DATE_DEBUT_MANDAT;
				elseif(!Tools::is_date_fr($post['initDate'])) $error[] = Lang::ERROR_BAD_FORMAT_DATE_DEBUT_MANDAT;
				if(empty($post['deadDate']))$error[] = Lang::ERROR_EMPTY_DATE_FIN_MANDAT;
				elseif(!Tools::is_date_fr($post['deadDate'])) $error[] = Lang::ERROR_BAD_FORMAT_DATE_FIN_MANDAT;
				if(!empty($post['freeDate'])&&!Tools::is_date_fr($post['freeDate'])) $error[] = Lang::ERROR_BAD_FORMAT_DATE_LIBRE_MANDAT;
				if(Tools::date1_is_superior_to_date2_date_time_fr($post['initDate'],$post['deadDate'])) $error[]= 'La date de début de mandat doit être inférieure à celle de fin.';
				if(empty($error)){
					$mandate->setEtap( MandateEtap::load($this->_pdo,Constant::ID_ETAP_TO_SELL) );
					$mandate->setInitDate(Tools::dateFrToTime($post['initDate']));
					$mandate->setDeadDate(Tools::dateFrToTime($post['deadDate']));
					$mandate->setFreeDate($post['freeDate']==''?null:Tools::dateFrToTime($post['freeDate']));
					// Si des rapprochements existent, il faut les reaffecter ou les supprimer (question à poser).
					// Defaut : suppression

					// BUG 04/04/2011 ERROR PDO

					$pdoStatement = BddRapprochement::selectByMandate($this->_pdo,$mandate);
					while($ra = BddRapprochement::fetch($this->_pdo,$pdoStatement)){
						$ra->delete();
					}



					// reactivation des vendeurs
					foreach($mandate->listSellers() as $seller)
					Seller::load($this->_pdo,$seller->getIdSeller())->setAsset(1);
					Log::create($this->_pdo,time(),'mandat','Reaffection du mandat',$this->_user);
					header('location:'.Tools::create_url($this->_user,'mandat','see',$get['action']));
				}
			}
			$this->_smarty->assign('mandate',$mandate);
			$this->_smarty->assign('initDate',$initDate);
			$this->_smarty->assign('deadDate',$deadDate);
			$this->_smarty->assign('freeDate',$freeDate);



		}elseif(isset($get['page'])&&$get['page']=='endSell'){
			// mandat
			$mandate = Mandate::load($this->_pdo,$get['action']);
			$this->_title = 'Finaliser la vente du mandat '.$mandate->getNumberMandate();
			$this->_template =dirname(__FILE__).'/views/endSell.tpl';

			// On récupere l'acquereur rapproché
			$rapp = BddRapprochement::loadByMandateR($this->_pdo,$mandate) ;
			$acq = $rapp->getAcquereur();
			//			echo $acq->getName();

			$this->_smarty->assign('h1',$this->_title);
			$this->_smarty->assign('mandate',$mandate);
			$this->_smarty->assign('acq',$acq);
			if(isset($post['cancel']))header('location:'.Tools::create_url($this->_user,'mandat','see',$mandate->getIdMandate()));
			if(isset($post['send'])){
				if(isset($post['unAcq'])){
					$acq->setActif(0);
				}
				if(isset($post['unSeller'])){

					//				 	$mandate->getDefaultSeller()->setAsset(0);
					$sellers = $mandate->listSellers();
					foreach ($sellers as $seller){
						if(Mandate::countMandateBySeller($this->_pdo,$seller,array($mandate->getIdMandate())==0)){
							Seller::load($this->_pdo,$seller->getIdSeller())->setAsset(0);
						}
					}
				}
				// passer le mandat en vendu par l'agence
				$mandate->setEtap( MandateEtap::load($this->_pdo,Constant::ID_ETAP_SELL_BY_ESCALIMMO));
				Log::create( $this->_pdo,time(),'mandat','finalisation de la vente du mandat',$this->_user );
				header('location:'.Tools::create_url($this->_user,'mandat','see',$mandate->getIdMandate()));


			}

		}elseif(isset($get['page'])&&$get['page']=='log'){
			$this->_title = 'Logs du module';
			$this->_template =dirname(__FILE__).'/../tpl_default/log.tpl';
			$a = Log::selectByModule($this->_pdo,'mandat');
			while($logs = Log::fetch($this->_pdo,$a)){
				$arrayLog[] = $logs;
				$this->_smarty->assign('arrayLog', $arrayLog );
			}
		}elseif(isset($get['page'])&&$get['page']=='duplicate'){
			$this->_title = 'Duppliquer le mandat';
			$this->_template =dirname(__FILE__).'/views/duplicate.tpl';
			// liste
			$listCity = City::loadAll($this->_pdo);
			$listSector = Sector::loadAll($this->_pdo);
			$listNotary = Notary::loadAll($this->_pdo);
			//			$listSeller = Seller::loadAll($this->_pdo);
			$listNature = MandateNature::loadAll($this->_pdo);
			//			$listTitleSeller = SellerTitle::loadAll($this->_pdo);
			$listTypeTransaction = TransactionType::loadAll($this->_pdo);
			$listTypeBien = MandateType::loadAll($this->_pdo);
			$listUser=($this->_user->getLevelMember()->getIdLevelMember()<3)?$listUser = User::loadAll($this->_pdo): array();
			$listGeometer = MandateGeometer::loadAll($this->_pdo);
			$listBornageTerrain = MandateBornageTerrain::loadAll($this->_pdo);
			$m = Mandate::load($this->_pdo,$get['action']);
			// use variables
			if(empty($post)){
				$nature = $m->getNature()==null?null:$m->getNature()->getIdMandateNature();
				$idUser = $this->_user->getIdUser();
				$typeTransaction = $m->getTransactionType()->getIdTransactionType();
				$typeBien = $m->getMandateType()->getIdMandateType();
				$seller_add_list_title = $m->getDefaultSeller()->getSellerTitle()->getIdSellerTitle();
				$nameSeller=$m->getDefaultSeller()->getName();
				$firstnameSeller=$m->getDefaultSeller()->getFirstname();
				$seller_add_address=$m->getDefaultSeller()->getAddress();
				$seller_add_list_city=$m->getDefaultSeller()->getCity()->getIdCity();
				$seller_add_phone =$m->getDefaultSeller()->getPhone();
				$seller_add_mobil_phone=$m->getDefaultSeller()->getMobilPhone();
				$seller_add_work_phone=$m->getDefaultSeller()->getWorkPhone();
				$seller_add_fax=$m->getDefaultSeller()->getFax();
				$seller_add_email=$m->getDefaultSeller()->getEmail();
				$idNotary=$m->getNotary()->getIdNotary();
				$idNotaryAcq=$m->getNotaryAcq()?$m->getNotaryAcq()->getIdNotary():null;
				$numMandat=$m->getNumberMandate();
				$debutMandat =$m->getInitDate()? date(Constant::DATE_FORMAT2,$m->getInitDate()):'';
				$finMandat = $m->getDeadDate()?date(Constant::DATE_FORMAT2,$m->getDeadDate()):'';
				$libreMandat = $m->getFreeDate()?date(Constant::DATE_FORMAT2,$m->getFreeDate()):'';
				$adresseMandat=$m->getAddress();
				$idCity=$m->getCity()->getIdCity();
				$prixFai=$m->getPriceFai();
				$prixNetVendeur = $m->getPriceSeller();
				$commissionMandat = $m->getCommission();
				$estimationFai = $m->getEstimationFai();
				$margeNegoce = $m->getMargeNegociation();
				$refCadastre1=$m->getReferenceCadastreParcelle1();
				$refCadastre2=$m->getReferenceCadastreParcelle2();
				$refCadastre3=$m->getReferenceCadastreParcelle3();
				$autreRefCadastre = $m->getAutreReferenceParcelle();
				$numLot = $m->getNumberLot();
				$superficieParcelle1 = $m->getSuperficieParcelle1()==0?'':$m->getSuperficieParcelle1();
				$superficieParcelle2 = $m->getSuperficieParcelle2()==0?'':$m->getSuperficieParcelle2();
				$superficieParcelle3 = $m->getSuperficieParcelle3()==0?'':$m->getSuperficieParcelle3();
				$superficieAutreParcelle = $m->getSuperficieAutreParcelle()==0?'':$m->getSuperficieAutreParcelle();
				$superficieConstructible = $m->getSuperficieConstructible()==0?'':$m->getSuperficieConstructible();
				$superficieNonConstructible = $m->getSuperficieNonConstructible()==0?'':$m->getSuperficieNonConstructible();
				$superficieTotale = $m->getSuperficieTotale()==0?'':$m->getSuperficieTotale();
				//					$idGeometer = $m->getGeometer()?$m->getGeometer()->getIdMandateGeometer():null;
				$idBornageTerrain = $m->getBornageTerrain()?$m->getBornageTerrain()->getIdMandateBornageTerrain():null;
				$dpe = ValDpe::loadByMandate($this->_pdo,$m);
				$dpeConsoEner = $dpe?$dpe->getConsoEner():'';
				$dpeEmissionGaz= $dpe?$dpe->getEmissionGaz():'';
				$nbPiece = $m->getNbPiece()==0?'':$m->getNbPiece();
				$nbChambre = $m->getNbChambre()==0?'':$m->getNbChambre();
				$surfaceHab= $m->getSurfaceHabitable()==0?'':$m->getSurfaceHabitable();
				$surfacePieceVie= $m->getSurfacePieceVie()==0?'':$m->getSurfacePieceVie();
				$niveau= $m->getNiveau()==0?'':$m->getNiveau();
				$anneeConstruction= $m->getAnneeConstruction()==0?'':$m->getAnneeConstruction();
				$coupCoeur = $m->getCoupCoeur()?'on':false;
				$chargesMensuelle= $m->getChargesMensuelle()==0?'':$m->getChargesMensuelle();
				$taxesFoncieres= $m->getTaxesFonciere()==0?'':$m->getTaxesFonciere();
				$taxeHabitation= $m->getTaxeHabitation()==0?'':$m->getTaxeHabitation();
					
					
				$cheminee = $m->getCheminee()?'on':false;
				$cuisineEquipee =$m->getCuisineEquipee()?'on':false;
				$cuisineAmenagee=$m->getCuisineAmenagee()?'on':false;
				$piscine=$m->getPiscine()?'on':false;
				$poolHouse=$m->getPoolHouse()?'on':false;
				$terrasse=$m->getTerrasse()?'on':false;
				$mezzanine=$m->getMezzanine()?'on':false;
				$dependance=$m->getDependance()?'on':false;
				$gaz=$m->getGaz()?'on':false;
				$cave=$m->getCave()?'on':false;
				$ssol=$m->getSousSol()?'on':false;
				$garage=$m->getGarage()?'on':false;
				$parking=$m->getParking()?'on':false;
				$rezDeJardin=$m->getRezDeJardin()?'on':false;
				$plainPied=$m->getPlainPied()?'on':false;
				$carriere=$m->getCarriere()?'on':false;
				$ptEau=$m->getPointEau()?'on':false;
				$ttEgout=$m->getToutALegout()?'on':false;

				$ShonAccorde = $m->getSHONAccordee();
				$zoneBdf = $m->getZoneBdf();
				$ligneCrete= $m->getLigneDeCrete();
				$zoneInondable= $m->getZoneInondable();
				$reglementDeLotissement= $m->getReglementDeLotissement();
				$ernt = $m->getERNT();
				$dPValide = $m->getDPValide();
				$cuValide = $m->getCuValide();
				$cuOpsValide = $m->getCuOPSValide();
				$permisAmenagerValide = $m->getPermisDamenagerValide();
				$terrainViabilise = $m->getTerrainVenduViabilise();
				$terrainSemiViabilise = $m->getTerrainVenduSemiViabilise();
				$terrainNonViabilise = $m->getTerrainVenduNonViabilise();
				$passageEau = $m->getPassageEau();
				$passageElectricite = $m->getPassageElectricite();
				$passageGaz = $m->getPassageGaz();
				$toutALEgout = $m->getToutALegout();
				$assainissementParFosseSceptique = $m->getAssainissementParFosseSceptique();
				$voirie = $m->getVoirie();
				$tailleFacade = $m->getTailleFacade();
				$profondeurTerrain = $m->getProfondeurTerrain();

				$dateDeclPrealableDP =$m->getDateDeclarationPrealable()==null||$m->getDateDeclarationPrealable()==""?'': date(Constant::DATE_FORMAT2,$m->getDateDeclarationPrealable());
				$dateProrogationDP = $m->getProrogationDPJusquau()==null?'':date(Constant::DATE_FORMAT2,$m->getProrogationDPJusquau());
				$dateCu  =  $m->getDateCU()==null?'':date(Constant::DATE_FORMAT2,$m->getDateCU());
				$dateProrogationCu = $m->getProrogationCUJusquau()==null?'':date(Constant::DATE_FORMAT2,$m->getProrogationCUJusquau());
				$dateDeclPrealableCUOPS = $m->getDateCuOPS()==null?'':date(Constant::DATE_FORMAT2,$m->getDateCuOPS());
				$dateProrogationCUOPS = $m->getProrogationCuOPSJusquau()==null?'':date(Constant::DATE_FORMAT2,$m->getProrogationCuOPSJusquau());
				$datePermisAmenager =$m->getDatePermisDamenager()==null?'': date(Constant::DATE_FORMAT2,$m->getDatePermisDamenager());

				$commentaire = $m->getCommentaire();
				$geo = $m->getGeolocalisation();
				$aGeo = explode(',',$geo);
				$latitude = $aGeo[0];
				$longitude = $aGeo[1];
				$proximiteEcole = $m->getProximiteEcole();
				$proximiteCommerce = $m->getProximiteCommerce();
				$proximiteTransport = $m->getProximiteTransport();
				$commentaireApparent = $m->getCommentaireApparent();
				$idGeometer =$m->getGeometer()==null?0: $m->getGeometer()->getIdMandateGeometer();
				$idBornageTerrain =$m->getBornageTerrain()==null?0:$m->getBornageTerrain()->getIdMandateBornageTerrain() ;
				$idZonagePlu = $m->getZonagePLU()==null?0:$m->getZonagePLU()->getIdMandateZonagePLU() ;
				$idZonageRnu = $m->getZonageRNU()==null?0:$m->getZonageRNU()->getIdMandateZonageRNU() ;

				$adjoining = $m->getMandateAdjoining()==null?0:$m->getMandateAdjoining()->getId();

				$idCos= $m->getCos()==null?0:$m->getCos()->getIdMandateCOS() ;
				$idWaterCorresponding = $m->getWaterCorresponding()==null?0:$m->getWaterCorresponding()->getIdMandateWaterCorresponding() ;
				$idElectricCorresponding=$m->getElectricCorresponding()==null?0: $m->getElectricCorresponding()->getIdMandateElectricCorresponding() ;
				$idGazCorresponding=$m->getGazCorresponding()==null?0: $m->getGazCorresponding()->getIdMandateGazCorresponding() ;
				$idSanitationCorresponding=$m->getSanitationCorresponding()==null?0: $m->getSanitationCorresponding()->getIdMandateSanitationCorresponding() ;
				$idOrientation=$m->getOrientation()==null?0: $m->getOrientation()->getIdMandateOrientation() ;
				$idSlope=$m->getSlope()==null?0:$m->getSlope()->getIdMandateSlope() ;

				// listes :
				$insulation = $m->getInsulation()?$m->getInsulation()->getIdMandateInsulation():0;
				$roof= $m->getRoof()?$m->getRoof()->getIdMandateRoof():0;
				$heating= $m->getHeating()?$m->getHeating()->getIdMandateHeating():0;
				$commonOwnership= $m->getCommonOwnership()?$m->getCommonOwnership()->getIdMandateCommonOwnership():0;
				$constructionType= $m->getConstruction()?$m->getConstruction()->getIdMandateConstructionType():0;
				$style= $m->getStyle()?$m->getStyle()->getIdMandateStyle():0;
				$ne= $m->getNews()?$m->getNews()->getIdMandateNews():0;
				$conditions= $m->getCondition()?$m->getCondition()->getIdMandateCondition():0;
				$nouveauteSite = $m->getNouveaute()==null?'':date(Constant::DATE_FORMAT2,$m->getNouveaute());

				$pubInternet = $m->getPubInternet();
				$estimationMaxi = $m->getEstimationMaxi();


				$rental = $m->getRental();
				$numbergarage = $m->getNumberGarage();
				$numbercellar = $m->getNumberCellar();
				$numberlot = $m->getNumberLot();
				$numberparking = $m->getNumberParking();
				$numberattic = $m->getNumberAttic();
				$pricegarage = $m->getPriceGarage();
				$pricecellar = $m->getPriceCellar();
				$profitability = $m->getProfitability();

			}else{
				$pubInternet = $post['pubInternet'];
				$estimationMaxi = $post['estimationMaxi'];
				$nature= $post['nature'];
				$idUser = $post['idUser']?$post['idUser']:$m->getUser()->getIdUser();
				$typeTransaction =$post['typeTransaction'];
				$typeBien = $post['typeBien'];
				$seller_add_list_title = $post['seller_add_list_title'];
				$nameSeller=$post['nameSeller'];
				$firstnameSeller=$post['firstnameSeller'];
				$seller_add_address=$post['seller_add_address'];
				$seller_add_list_city=$post['seller_add_list_city'];
				$seller_add_phone =$post['seller_add_phone'];
				$seller_add_mobil_phone=$post['seller_add_mobil_phone'];
				$seller_add_work_phone=$post['$seller_add_work_phone'];
				$seller_add_fax=$post['$seller_add_fax'];
				$seller_add_email=$post['$seller_add_email'];
				$idNotary=$post['idNotary'];
				$idNotaryAcq=$post['idNotaryAcq'];
				$numMandat=$post['numMandat'];
				$debutMandat =$post['debutMandat'];
				$finMandat = $post['finMandat'];
				$libreMandat = $post['libreMandat'];
				$adresseMandat=$post['adresseMandat'];
				$idCity=$post['idCity'];
				$prixFai=$post['prixFai'];
				$prixNetVendeur = $post['prixNetVendeur'];
				$commissionMandat = $post['commissionMandat'];
				$estimationFai =$post['estimationFai'];
				$margeNegoce = $post['margeNegoce'];
				$refCadastre1=$post['refCadastre1'];
				$refCadastre2=$post['refCadastre2'];
				$refCadastre3=$post['refCadastre3'];
				$autreRefCadastre = $post['autreRefCadastre'];
				$numLot = $post['numLot'];
				$adjoining = $post['adjoining'];
				// Renseignement des valeurs avec post.
				$superficieParcelle1 =$post['superficieParcelle1'];
				$superficieParcelle2 = $post['superficieParcelle2'];
				$superficieParcelle3 = $post['superficieParcelle3'];
				$superficieAutreParcelle = $post['superficieParcelle3'];
				$superficieConstructible =$post['superficieConstructible'];
				$superficieNonConstructible = $post['superficieNonConstructible'];
				$superficieTotale = $post['superficieTotale'];
				$ShonAccorde = $post['shonAccordee'];
				$zoneBdf = $post['zonebdf'];
				$ligneCrete=$post['ligneCrete'];
				$zoneInondable=$post['zoneInondable'];
				$reglementDeLotissement= htmlspecialchars($post['reglementLotissement']);
				$ernt =$post['ernt'];
				$dPValide = $post['dPValide'];
				$cuValide = $post['cuValide'];
				$cuOpsValide = $post['cuOpsValide'];
				$permisAmenagerValide = $post['permisAmenagerValide'];
				$terrainViabilise = $post['terrainViabilise'];
				$terrainSemiViabilise = $post['terrainSemiViabilise'];
				$terrainNonViabilise = $post['terrainNonViabilise'];
				$passageEau = htmlspecialchars($post['passageEau']);
				$passageElectricite = htmlspecialchars($post['passageElectricite']);
				$passageGaz = htmlspecialchars($post['passageGaz']);
				$toutALEgout = $post['toutEgout'];
				$assainissementParFosseSceptique = $post['assainissementFosseSceptiqueFalse'];
				$voirie = htmlspecialchars($post['voirie']);
				$tailleFacade = $post['tailleFacade'];
				$profondeurTerrain = $post['profondeurTerrain'];
				$commentaire = htmlspecialchars($post['commentaire']);
				$latitude = $post['geolocLatitude'];
				$longitude = $post['geolocLongitude'];
				$proximiteEcole = $post['proximiteEcole'];
				$proximiteCommerce = $post['proximiteCommerce'];
				$proximiteTransport = $post['proximiteTransport'];
				$commentaireApparent = htmlspecialchars($post['commentaireApparent']);
				$idGeometer =$post['idGeometer'];
				$idBornageTerrain =$post['idBornageTerrain'];
				$idZonagePlu = $post['idZonagePlu'];
				$idZonageRnu = $post['idZonageRnu'];
				$idCos= $post['idCos'];
				$idWaterCorresponding = $post['idWaterCorresponding'];
				$idElectricCorresponding=$post['idElectricCorresponding'];
				$idGazCorresponding=$post['idGazCorresponding'];
				$idSanitationCorresponding=$post['idSanitationCorresponding'];
				$idOrientation=$post['idOrientation'];
				$idSlope=$post['idSlope'];
				// date
				$dateDeclPrealableDP = $post['dateDeclPrealableDP'];
				$dateProrogationDP = $post['dateProrogationDP'];
				$dateCu  = $post['dateDeclPrealableCU'];
				$dateProrogationCu =$post['dateProrogationCU'];
				$dateDeclPrealableCUOPS = $post['dateDeclPrealableCUOPS'];
				$dateProrogationCUOPS =$post['dateProrogationCUOPS'];
				$datePermisAmenager =$post['datePermisAmenager'];
				$nouveauteSite = $post['nouveauteSite'];





				// champs spécifiques mandats
				$nbPiece =$post['nbPiece'];
				$nbChambre = $post['nbChambre'];
				$surfaceHab = $post['surfaceHab'];
				$surfacePieceVie = $post['surfacePieceVie'];
				$niveau = $post['niveau'];
				$anneeConstruction = $post['anneeConstruction'];
				$chargesMensuelle = $post['chargesMensuelle'];
				$taxesFoncieres = $post['taxesFoncieres'];
				$taxeHabitation = $post['taxeHabitation'];




				$coupCoeur = $post['coupCoeur']=='on'?'on':false;
				$cheminee = $post['cheminee']=='on'?'on':false;
				$cuisineEquipee =$post['cuisineEquipee']=='on'?'on':false;
				$cuisineAmenagee=$post['cuisineAmenagee']=='on'?'on':false;
				$piscine=$post['piscine']=='on'?'on':false;
				$poolHouse=$post['poolHouse']=='on'?'on':false;
				$terrasse=$post['terrasse']=='on'?'on':false;
				$mezzanine=$post['mezzanine']=='on'?'on':false;
				$dependance=$post['dependance']=='on'?'on':false;
				$gaz=$post['gaz']=='on'?'on':false;
				$cave=$post['cave']=='on'?'on':false;
				$ssol=$post['ssol']=='on'?'on':false;
				$garage=$post['garage']=='on'?'on':false;
				$parking=$post['parking']=='on'?'on':false;
				$rezDeJardin=$post['rezDeJardin']=='on'?'on':false;
				$plainPied=$post['plainPied']=='on'?'on':false;
				$carriere=$post['carriere']=='on'?'on':false;
				$ptEau=$post['ptEau']=='on'?'on':false;
				$ttEgout=$post['ttEgout']=='on'?'on':false;
				$insulation = $post['insulation'];
				$roof = $post['roof'];
				$heating = $post['heating'];
				$commonOwnership = $post['commonOwnership'];
				$constructionType = $post['constructionType'];
				$style = $post['style'];
				$ne = $post['ne'];
				$conditions = $post['conditions'];
				$dpeConsoEner = $post['dpeConsoEner'];
				$dpeEmissionGaz =  $post['dpeEmissionGaz'];
					

				$rental = $post['rental'];
				$numbergarage = $post['numbergarage'];
				$numbercellar = $post['numbercellar'];
				$numberlot = $post['numberlot'];
				$numberparking = $post['numberparking'];
				$numberattic = $post['numberattic'];
				$pricegarage = $post['pricegarage'];
				$pricecellar = $post['pricecellar'];
				$profitability = $post['profitability'];


			}
			// treatment
			if(isset($post['send'])){
				//					var_dump($post);
				$error = array();

				if(empty($error)){
					// enregistrement du mandat et redirection vers celui ci.

					$newMandate = Mandate::create(
					$this->_pdo,
					$numMandat,
					Tools::dateFrToTime($debutMandat),
					Tools::dateFrToTime($finMandat),
					$adresseMandat,
					$prixFai,
					$prixNetVendeur,
					$commissionMandat,
					$estimationFai,
					$margeNegoce,
					$refCadastre1,
					'',//$refCadastre2,
					'',//$refCadastre3,
					'',//$autreRefCadastre,
					'',//$superficieParcelle1,
					'',//$superficieParcelle2,
					'',//$superficieParcelle3,
					'',//$superficieAutreParcelle,
					'',//$superficieConstructible,
					'',//$superficieNonConstructible,
					$superficieTotale,
					'',//$numLot,
					'',//$ShonAccorde,
					$reglementDeLotissement,
					'',//$ernt,
					$passageEau,
					$passageElectricite,
					$passageGaz,
					$voirie,
					$tailleFacade,
					$profondeurTerrain,
					$commentaire,
					$latitude.','.$longitude,
					$proximiteEcole,
					$proximiteCommerce,
					$proximiteTransport,
					$commentaireApparent,
					$nbPiece,
					$surfaceHab,
					$nbChambre,
					$surfacePieceVie,
					$niveau,
					$anneeConstruction,
					$chargesMensuelle,
					$taxesFoncieres,
					$taxeHabitation,
					User::load($this->_pdo,$idUser),
					City::load($this->_pdo,$idCity)->getSector(),
					City::load($this->_pdo, $idCity),
					Notary::load($this->_pdo, $idNotary),
					MandateType::load($this->_pdo,$typeBien),
					TransactionType::load($this->_pdo, $typeTransaction),
					MandateEtap::load($this->_pdo, Constant::ID_ETAP_TO_SELL),
					$libreMandat==''?null:Tools::dateFrToTime($libreMandat),
					$zoneBdf==''?false:1,
					$ligneCrete==''?false:1,
					$zoneInondable==''?false:1,
					$dPValide==''?false:1,
					$dateDeclPrealableDP==''?null:Tools::dateFrToTime($dateDeclPrealableDP),
					$dateProrogationDP==''?null:Tools::dateFrToTime($dateProrogationDP),
					$cuValide==''?false:1,


					$dateCu==''?null:Tools::dateFrToTime($dateCu),
					$dateProrogationCu==''?null:Tools::dateFrToTime($dateProrogationCu),
					$cuOpsValide=false,
					$dateDeclPrealableCUOPS==''?null:Tools::dateFrToTime($dateDeclPrealableCUOPS),
					$dateProrogationCUOPS==''?null:Tools::dateFrToTime($dateProrogationCUOPS),
					$permisAmenagerValide==''?false:1,
					$datePermisAmenager==''?null:Tools::dateFrToTime($datePermisAmenager),
					$terrainViabilise==''?false:1,
					$terrainSemiViabilise==''?false:1,
					$terrainNonViabilise===''?false:1,
					$toutALEgout==''?false:1,
					$assainissementParFosseSceptique==''?false:1,
					$coupCoeur==''?false:1,
					// verif
					//					$news=null,
					$nouveauteSite==''?null:Tools::dateFrToTime($nouveauteSite),
					$cheminee==''?false:1,
					$cuisineEquipee==''?false:1,
					$cuisineAmenagee==''?false:1,
					$piscine==''?false:1,
					$poolHouse==''?false:1,
					$terrasse===''?false:1,
					$mezzanine==''?false:1,
					$dependance==''?false:1,
					$gaz==''?false:1,
					$cave==''?false:1,
					$ssol==''?false:1,
					$garage==''?false:1,
					$parking==''?false:1,
					$rezDeJardin==''?false:1,
					$plainPied==''?false:1,
					$carriere==''?false:1,
					$ptEau==''?false:1,
					$idSlope==''?null:MandateSlope::load($this->_pdo,$idSlope),
					$idOrientation==''?null:MandateOrientation::load($this->_pdo,$idOrientation),
					$insulation==''?null:MandateInsulation::load($this->_pdo,$insulation),
					$ne=null==''?null:MandateNews::load($this->_pdo,$ne),
					$heating==''?null:MandateHeating::load($this->_pdo,$heating),
					$commonOwnership==''?null:MandateCommonOwnership::load($this->_pdo,$commonOwnership),
					$roof==''?null:MandateRoof::load($this->_pdo,$roof),
					$conditions==''?null:MandateCondition::load($this->_pdo,$conditions),
					$style==''?null:MandateStyle::load($this->_pdo,$style),
					$constructionType==''?null:MandateConstructionType::load($this->_pdo,$constructionType),
					$idSanitationCorresponding==''?null:MandateSanitationCorresponding::load($this->_pdo,$idSanitationCorresponding),
					$idElectricCorresponding==''?null:MandateElectricCorresponding::load($this->_pdo,$idElectricCorresponding),
					$idGazCorresponding==''?null:MandateGazCorresponding::load($this->_pdo,$idGazCorresponding),
					$idWaterCorresponding==''?null:MandateWaterCorresponding::load($this->_pdo,$idWaterCorresponding),
					$idCos==''?null:MandateCOS::load($this->_pdo,$idCos),
					$idZonagePlu==''?null:MandateZonagePLU::load($this->_pdo,$idZonagePlu),
					$idZonageRnu==''?null:MandateZonageRNU::load($this->_pdo,$idZonageRnu),
					$idBornageTerrain==''?null:MandateBornageTerrain::load($this->_pdo,$idBornageTerrain),
					$idGeometer==''?null:MandateGeometer::load($this->_pdo,$idGeometer),
					$nature==''?null:MandateNature::load($this->_pdo,$nature)
					);
					/*
					 $pubInternet = $m->getPubInternet();
					$estimationMaxi = $m->getEstimationMaxi();

					*/
					$newMandate->setPubInternet($pubInternet);
					$newMandate->setEstimationMaxi($estimationMaxi);
					$newMandate->setToutALegout( $ttEgout=='on'?1:0 );
					$newMandate->setMandateAdjoining(MandateAdjoining::load($this->_pdo, $adjoining));
					$nAcq = Notary::load($this->_pdo, $idNotaryAcq);
					$newMandate->setNotaryAcq( $nAcq  );
					if($nAcq){

						$nAcq->setNumberUsed($nAcq->getNumberUsed( ) +1 );
					}
					// ajout de +1 à la ville
					$newMandate->getCity()->setNumberUsed( $newMandate->getCity()->getNumberUsed() +1);

					$newMandate->getNotary()->setNumberUsed( $newMandate->getNotary()->getNumberUsed( )+1);

					// +1 à l'utilisateur
					$newMandate->getUser()->setNumberUsed($newMandate->getUser()->getNumberUsed( )+1 );
					// copie du vendeur
					$newMandate->addSeller($m->getDefaultSeller(),1);
						
						
					$newMandate->getRental($rental,false);
					$newMandate->setNumberGarage($numbergarage,false);
					$newMandate->setNumberCellar($numbercellar,false);
					$newMandate->setNumberLot($numberlot,false);
					$newMandate->setNumberParking($numberparking,false);
					$newMandate->setNumberAttic($numberattic,false);
					$newMandate->setPriceGarage($pricegarage,false);
					$newMandate->setPriceCellar($pricecellar,false);
					$newMandate->setProfitability($profitability,false);
					$newMandate->update();
						
					// dpe
					ValDpe::create($this->_pdo,$dpeConsoEner,$dpeEmissionGaz,$newMandate);
					Log::create($this->_pdo,time(),$get['module'],'Duplication du mandat : '.$m->getNumberMandate(),$this->_user);
					header('location:'.Tools::create_url($this->_user,$get['module'],'see',$newMandate->getIdMandate()));
				}
			}
			// assign
			$this->_smarty->assign('pubInternet',$pubInternet);
			$this->_smarty->assign('adjoining',$adjoining);
			$this->_smarty->assign('estimationMaxi',$estimationMaxi);
			$this->_smarty->assign('nouveauteSite',$nouveauteSite);
			$this->_smarty->assign('idUser',$idUser);
			$this->_smarty->assign('typeTransaction',$typeTransaction);
			$this->_smarty->assign('typeBien',$typeBien);
			$this->_smarty->assign('seller_add_list_title',$seller_add_list_title);
			$this->_smarty->assign('nameSeller',$nameSeller);
			$this->_smarty->assign('firstnameSeller',$firstnameSeller);
			$this->_smarty->assign('seller_add_address',$seller_add_address);
			$this->_smarty->assign('seller_add_list_city',$seller_add_list_city);
			$this->_smarty->assign('seller_add_phone',$seller_add_phone );
			$this->_smarty->assign('seller_add_mobil_phone', $seller_add_mobil_phone);
			$this->_smarty->assign('seller_add_work_phone',$seller_add_work_phone );
			$this->_smarty->assign('seller_add_fax',$seller_add_fax );
			$this->_smarty->assign('seller_add_email', $seller_add_email);
			$this->_smarty->assign('idNotary', $idNotary);
			$this->_smarty->assign('idNotaryAcq', $idNotaryAcq);
			$this->_smarty->assign('numMandat', $numMandat);
			$this->_smarty->assign('debutMandat', $debutMandat);
			$this->_smarty->assign('finMandat', $finMandat);
			$this->_smarty->assign('libreMandat', $libreMandat);
			$this->_smarty->assign('adresseMandat', $adresseMandat);
			$this->_smarty->assign('idCity',$idCity);
			$this->_smarty->assign('prixFai', $prixFai);
			$this->_smarty->assign('prixNetVendeur', $prixNetVendeur);
			$this->_smarty->assign('commissionMandat', $commissionMandat);
			$this->_smarty->assign('estimationFai', $estimationFai);
			$this->_smarty->assign('margeNegoce', $margeNegoce);
			$this->_smarty->assign('refCadastre1', $refCadastre1);
			$this->_smarty->assign('refCadastre2', $refCadastre2);
			$this->_smarty->assign('refCadastre3', $refCadastre3);
			$this->_smarty->assign('autreRefCadastre',$autreRefCadastre );
			$this->_smarty->assign('numLot',$numLot);
			$this->_smarty->assign('nature',$nature);
			$this->_smarty->assign('ttEgout',$ttEgout);


			$this->_smarty->assign('superficieParcelle1',$superficieParcelle1==0?'':$superficieParcelle1);
			$this->_smarty->assign('superficieParcelle2',$superficieParcelle2==0?'':$superficieParcelle2);
			$this->_smarty->assign('superficieParcelle3',$superficieParcelle3==0?'':$superficieParcelle3);
			$this->_smarty->assign('superficieAutreParcelle',$superficieAutreParcelle==0?'':$superficieAutreParcelle);
			$this->_smarty->assign('superficieConstructible',$superficieConstructible==0?'':$superficieConstructible);
			$this->_smarty->assign('superficieNonConstructible',$superficieNonConstructible==0?'':$superficieNonConstructible);
			$this->_smarty->assign('superficieTotale',$superficieTotale==0?'':$superficieTotale);
			$this->_smarty->assign('shonAccordee',$ShonAccorde==0?'':$ShonAccorde);
			$this->_smarty->assign('tailleFacade',$tailleFacade==0?'':$tailleFacade);
			$this->_smarty->assign('profondeurTerrain',$profondeurTerrain==0?'':$profondeurTerrain);
			$this->_smarty->assign('geolocLatitude',$latitude==0?'':$latitude);
			$this->_smarty->assign('geolocLongitude',$longitude==0?'':$longitude);
			$this->_smarty->assign('proximiteEcole',$proximiteEcole==0?'':$proximiteEcole);
			$this->_smarty->assign('proximiteCommerce',$proximiteCommerce==0?'':$proximiteCommerce);
			$this->_smarty->assign('proximiteTransport',$proximiteTransport==0?'':$proximiteTransport);
			$this->_smarty->assign('idGeometer',$idGeometer==0?'':$idGeometer);
			$this->_smarty->assign('idBornageTerrain',$idBornageTerrain==0?'':$idBornageTerrain);
			$this->_smarty->assign('idZonagePlu',$idZonagePlu==0?'':$idZonagePlu);
			$this->_smarty->assign('idZonageRnu',$idZonageRnu==0?'':$idZonageRnu);
			$this->_smarty->assign('idCos',$idCos==0?'':$idCos);
			$this->_smarty->assign('idWaterCorresponding',$idWaterCorresponding==0?'':$idWaterCorresponding);
			$this->_smarty->assign('idElectricCorresponding',$idElectricCorresponding==0?'':$idElectricCorresponding);
			$this->_smarty->assign('idGazCorresponding',$idGazCorresponding==0?'':$idGazCorresponding);
			$this->_smarty->assign('idSanitationCorresponding',$idSanitationCorresponding==0?'':$idSanitationCorresponding);
			$this->_smarty->assign('idOrientation',$idOrientation==0?'':$idOrientation);
			$this->_smarty->assign('idSlope',$idSlope==0?'':$idSlope);
			// bool
			$this->_smarty->assign('zonebdf',$zoneBdf);
			$this->_smarty->assign('ligneCrete',$ligneCrete);
			$this->_smarty->assign('dPValide',$dPValide);
			$this->_smarty->assign('zoneInondable',$zoneInondable);
			$this->_smarty->assign('cuValide',$cuValide);
			$this->_smarty->assign('cuOpsValide',$cuOpsValide);
			$this->_smarty->assign('permisAmenagerValide',$permisAmenagerValide);
			$this->_smarty->assign('terrainViabilise',$terrainViabilise);
			$this->_smarty->assign('terrainSemiViabilise',$terrainSemiViabilise);
			$this->_smarty->assign('terrainNonViabilise',$terrainNonViabilise);
			$this->_smarty->assign('toutEgout',$toutALEgout);
			$this->_smarty->assign('assainissementFosseSceptique',$assainissementParFosseSceptique);
			// String or date
			$this->_smarty->assign('reglementLotissement',$reglementDeLotissement);
			$this->_smarty->assign('ernt',$ernt);
			$this->_smarty->assign('dateDeclPrealableDP',$dateDeclPrealableDP);

			$this->_smarty->assign('dateProrogationDP',$dateProrogationDP);
			$this->_smarty->assign('dateDeclPrealableCU',$dateCu);
			$this->_smarty->assign('dateProrogationCU',$dateProrogationCu);
			$this->_smarty->assign('dateDeclPrealableCUOPS',$dateDeclPrealableCUOPS);
			$this->_smarty->assign('dateProrogationCUOPS',$dateProrogationCUOPS);
			$this->_smarty->assign('datePermisAmenager',$datePermisAmenager);
			$this->_smarty->assign('passageEau',$passageEau);
			$this->_smarty->assign('passageElectricite',$passageElectricite);
			$this->_smarty->assign('passageGaz',$passageGaz);
			$this->_smarty->assign('voirie',$voirie);
			$this->_smarty->assign('commentaire',$commentaire);
			$this->_smarty->assign('commentaireApparent',$commentaireApparent);
			// listes
			$this->_smarty->assign('listGeometer',MandateGeometer::loadAll($this->_pdo));
			$this->_smarty->assign('listBornageTerrain',MandateBornageTerrain::loadAll($this->_pdo));
			$this->_smarty->assign('listZonagePlu',MandateZonagePLU::loadAll($this->_pdo));
			$this->_smarty->assign('listZonageRnu',MandateZonageRNU::loadAll($this->_pdo));
			$this->_smarty->assign('listCos',MandateCOS::loadAll($this->_pdo));
			$this->_smarty->assign('listWaterCorresponding',MandateWaterCorresponding::loadAll($this->_pdo));
			$this->_smarty->assign('listElectricCorresponding',MandateElectricCorresponding::loadAll($this->_pdo));
			$this->_smarty->assign('listGazCorresponding',MandateGazCorresponding::loadAll($this->_pdo));
			$this->_smarty->assign('listSanitationCorresponding',MandateSanitationCorresponding::loadAll($this->_pdo));
			$this->_smarty->assign('listOrientation',MandateOrientation::loadAll($this->_pdo));
			$this->_smarty->assign('listSlope',MandateSlope::loadAll($this->_pdo));

			$this->_smarty->assign('listInsulation',MandateInsulation::loadAll($this->_pdo));
			$this->_smarty->assign('listRoof',MandateRoof::loadAll($this->_pdo));
			$this->_smarty->assign('listHeating',MandateHeating::loadAll($this->_pdo));
			$this->_smarty->assign('listCommonOwnership',MandateCommonOwnership::loadAll($this->_pdo));
			$this->_smarty->assign('listConstructionType',MandateConstructionType::loadAll($this->_pdo));
			$this->_smarty->assign('listStyle',MandateStyle::loadAll($this->_pdo));
			$this->_smarty->assign('listNews',MandateNews::loadAll($this->_pdo));
			$this->_smarty->assign('listConditions',MandateCondition::loadAll($this->_pdo));
			$this->_smarty->assign('listAdjoining',MandateAdjoining::loadAll($this->_pdo));
			$this->_smarty->assign('listNature',$listNature);

			$this->_smarty->assign('nbPiece',$nbPiece);
			$this->_smarty->assign('nbChambre',$nbChambre);
			$this->_smarty->assign('surfaceHab',$surfaceHab );
			$this->_smarty->assign('surfacePieceVie',$surfacePieceVie);
			$this->_smarty->assign('niveau',$niveau );
			$this->_smarty->assign('anneeConstruction',$anneeConstruction);
			$this->_smarty->assign('chargesMensuelle',$chargesMensuelle);
			$this->_smarty->assign('taxesFoncieres',$taxesFoncieres);
			$this->_smarty->assign('taxeHabitation',$taxeHabitation);

			$this->_smarty->assign('coupCoeur',$coupCoeur);
			$this->_smarty->assign('cheminee',$cheminee);
			$this->_smarty->assign('cuisineEquipee',$cuisineEquipee);
			$this->_smarty->assign('cuisineAmenagee',$cuisineAmenagee);
			$this->_smarty->assign('piscine',$piscine);
			$this->_smarty->assign('poolHouse',$poolHouse);
			$this->_smarty->assign('terrasse',$terrasse);
			$this->_smarty->assign('mezzanine',$mezzanine);
			$this->_smarty->assign('dependance',$dependance);
			$this->_smarty->assign('gaz',$gaz);
			$this->_smarty->assign('cave',$cave);
			$this->_smarty->assign('ssol',$ssol);
			$this->_smarty->assign('garage',$garage);
			$this->_smarty->assign('parking',$parking);
			$this->_smarty->assign('rezDeJardin',$rezDeJardin);
			$this->_smarty->assign('plainPied',$plainPied);
			$this->_smarty->assign('carriere',$carriere);
			$this->_smarty->assign('ptEau',$ptEau);

			$this->_smarty->assign('insulation',$insulation);
			$this->_smarty->assign('roof',$roof);
			$this->_smarty->assign('heating',$heating);
			$this->_smarty->assign('commonOwnership',$commonOwnership);
			$this->_smarty->assign('constructionType',$constructionType);
			$this->_smarty->assign('style',$style);
			$this->_smarty->assign('ne',$ne);
			$this->_smarty->assign('conditions',$conditions);

			$this->_smarty->assign('dpeConsoEner',$dpeConsoEner);
			$this->_smarty->assign('dpeEmissionGaz',$dpeEmissionGaz);


			$this->_smarty->assign('listCity',$listCity);
			$this->_smarty->assign('listSector',$listSector);
			$this->_smarty->assign('listNotary',$listNotary);
			$this->_smarty->assign('listSeller',$listSeller);
			$this->_smarty->assign('listTitle',$listTitleSeller);
			$this->_smarty->assign('listTypeTransaction',$listTypeTransaction);
			$this->_smarty->assign('listTypeBien',$listTypeBien);
			$this->_smarty->assign('listUser',$listUser);
			$this->_smarty->assign('listGeometer',$listGeometer);
			$this->_smarty->assign('listBornageTerrain',$listBornageTerrain);
				
			$this->_smarty->assign('rental',$rental );
			$this->_smarty->assign('numbergarage',$numbergarage );
			$this->_smarty->assign('numbercellar',$numbercellar );
			$this->_smarty->assign('numberlot',$numberlot );
			$this->_smarty->assign('numberparking',$numberparking);
			$this->_smarty->assign('numberattic',$numberattic );
			$this->_smarty->assign('pricegarage',$pricegarage );
			$this->_smarty->assign('pricecellar',$pricecellar );
			$this->_smarty->assign('profitability',$profitability );


		}
		$this->_smarty->assign('error',$error);
	}
	public function treatment( $post,$get){
		$this->_smarty->assign('user',$this->_user );
		if(!$this->_error_dependance){
			// inclusion des modules enfants
			$this->include_modules_Children((String)dirname(__FILE__),$this->_smarty);
			$this->_treatment( $post,$get);

		}
	}
	public function displayTpl( ){
        $this->_smarty->assign('js', $this->js);
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
