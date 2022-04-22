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
				Log::create($this->_pdo,time(),"sector",'accès non autorisé',$this->_user );
			} else{
				$this->_template = dirname(__FILE__).'/views/default.tpl';
				$this->_addMainMenu();
				$this->_addMenu('rapprochement');
				$this->_title = 'Gestion des Rapprochements';
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
		//		$mandate = Mandate::load($this->_pdo,1);
		//		var_dump(Rapprochement::listAcqForMandate($this->_pdo,$mandate));
		//		echo '<hr/>';
		//		$acq = Acquereur::load($this->_pdo,1);


		/* Voir pour faire une methode (privée ou protégée ) en return void pour la suite */
		if(isset($get['page'])&&($get['page']=='add_rapprochement_acq'||$get['page']=='add_rapprochement_chooseM'||$get['page']=='add_rapprochement_man' )){

			$acq = Acquereur::load($this->_pdo,$get['action']);
			$mandate = Mandate::load($this->_pdo,$get['action2']);
			$this->_title = 'Rapprocher un acquereur du bien';
			$this->_template = dirname(__FILE__).'/views/add_rapprochement_acq.tpl';
			$listUser = array();




			if($this->_user->getLevelMember()->getIdLevelMember()<3) $listUser = User::loadAll($this->_pdo);

			if($get['page']=='add_rapprochement_acq'){
				$labelRedirectC = 'Retour à la fiche acquereur';
				$redirectC = Tools::create_url($this->_user,'acquereur','see',$acq->getIdAcquereur());
			}elseif($get['page']=='add_rapprochement_chooseM'){
				$labelRedirectC = 'Retour à la fiche de choix des mandats.';
				$redirectC = Tools::create_url($this->_user,'rapprochement','chooseMandate',$acq->getIdAcquereur());
			}elseif($get['page']=='add_rapprochement_man'){
				$labelRedirectC = 'Retour à la fiche du bien.';
				// Récupération du type
				$mod = $mandate->getMandateType()->getIdMandateType()!=Constant::ID_PLOT_OF_LAND?'mandat':'terrain';
				$redirectC = Tools::create_url($this->_user,$mod,'see',$mandate->getIdMandate());
			}

			$utilisateurAssocie = !$post['utilisateurAssocie']?$this->_user->getIdUser():$post['utilisateurAssocie'];
			$resultat = !$post['resultat']?'':$post['resultat'];
			$ptPositifs = !$post['ptPositifs']?'':$post['ptPositifs'];
			$ptNegatifs = !$post['ptNegatifs']?'':$post['ptNegatifs'];
			$dateVisite = !$post['dateVisite']?'':$post['dateVisite'];
			$dateCompteRendu = !$post['dateCompteRendu']?'':$post['dateCompteRendu'];
			$resultatVisite=!$post['resultatVisite']?0:$post['resultatVisite'];
			if(isset($post['send'])){
				// erreurs à verifier
					
				if(empty($error)){
					// Save
					$userSelected = User::load($this->_pdo,$utilisateurAssocie);
					BddRapprochement::create(
					$this->_pdo,time(),

					htmlspecialchars($resultat),
					htmlspecialchars($ptPositifs),
					htmlspecialchars($ptNegatifs),
					$resultatVisite, //'resultatVisite' 0 = pas défini 1= echoué 2=ok
					$userSelected,
					$acq,
					$mandate,
					$dateCompteRendu==''?null:Tools::dateTimeFrToTime($dateCompteRendu),
					$dateVisite==''?null:Tools::dateTimeFrToTime($dateVisite),

					1
					);
					$userSelected->setNumberUsed($userSelected->getNumberUsed()+1);
					$acq->setNumberUsed($acq->getNumberUsed()+1);
					Log::create($this->_pdo,time(),'rapprochement',$acq->getFirstname().' '.$acq->getName().' et le mandat numéro '.$mandate->getNumberMandate().' rapprochés.',$this->_user);
					header('location:'.$redirectC);

				}
			}

			$this->_smarty->assign('labelRedirectC',$labelRedirectC);
			$this->_smarty->assign('redirectC',$redirectC);
			$this->_smarty->assign('dateCompteRendu',$dateCompteRendu);
			$this->_smarty->assign('dateVisite',$dateVisite);
			$this->_smarty->assign('ptNegatifs',$ptNegatifs);
			$this->_smarty->assign('ptPositifs',$ptPositifs);
			$this->_smarty->assign('resultat',$resultat);
			$this->_smarty->assign('utilisateurAssocie',$utilisateurAssocie);
			$this->_smarty->assign('listUser',$listUser);
			$this->_smarty->assign('acq',$acq);
			$this->_smarty->assign('mandate',$mandate);

		}elseif(isset($get['page'])&&$get['page']=='list'){
			$this->_smarty->assign('listRapp', BddRapprochement::loadAllActif($this->_pdo) );
			$this->_template=dirname(__FILE__).'/views/list.tpl';

		}elseif(isset($get['page'])&&($get['page']=='delete'||$get['page']=='deleteL'||$get['page']=='deleteAcq'||$get['page']=='deleteChooseM'||$get['page']=='deleteMan')){
			$rapprochement = BddRapprochement::load($this->_pdo,$get['action']);
			if($get['page']=='delete'){
				//
				$redirectT = $redirectC = Tools::create_url($this->_user,'rapprochement','list');
			}elseif($get['page']=='deleteL'){
				$redirectC = Tools::create_url($this->_user,'rapprochement','see',$get['action']);
				$redirectT = Tools::create_url($this->_user,'rapprochement','list');
			}elseif($get['page']=='deleteAcq'){
				$redirectC = Tools::create_url($this->_user,'rapprochement','seeByAcq',$get['action'],array($get['action2']));
				$redirectT = Tools::create_url($this->_user,'acquereur','see',$get['action2']);
			}elseif($get['page']=='deleteChooseM'){
				//seeByChooseM/6/17
				$redirectC = Tools::create_url($this->_user,'rapprochement','seeByChooseM',$get['action'],array($get['action2']));
				$redirectT = Tools::create_url($this->_user,'rapprochement','chooseMandate',$get['action2']);
			}elseif($get['page']=='deleteMan'){

				$redirectC = Tools::create_url($this->_user,'rapprochement','seeByMan',$get['action'],array($get['action2']));
				$mandate = Mandate::load($this->_pdo,$_GET['action2']);
				$mod = $mandate->getMandateType()->getIdMandateType()!=Constant::ID_PLOT_OF_LAND?'mandat':'terrain';
				$redirectT = Tools::create_url($this->_user,$mod,'see',$get['action2']);
			}

			// verification du niveau
			if($this->_user->getLevelMember()->getIdLevelMember() < 3 || $this->_user->getIdUser() == $rapprochement->getUser()->getIdUser()){
				$this->_smarty->assign('rapprochement',$rapprochement);
				$this->_title = 'Suppression du rapprochement';
				$this->_template=dirname(__FILE__).'/views/delete.tpl';
				if(isset($post['cancel'])) header('location:'.$redirectC);
				if(isset($post['send'])){

					if(empty($error)){
						// On enleve 1 au membre et à l'acquereur, on supprime
						$rapprochement->getUser()->setNumberUsed( $rapprochement->getUser()->getNumberUsed( ) -1 );
						$rapprochement->getAcquereur()->setNumberUsed( $rapprochement->getAcquereur()->getNumberUsed( ) -1 );
						$acqN =$rapprochement->getAcquereur()->getFirstname() .' '.$rapprochement->getAcquereur()->getName();
						$numMandat = $rapprochement->getMandate()->getNumberMandate();
						$rapprochement->delete();
						Log::create($this->_pdo,time(),'rapprochement','Suppression du repprochement entre '.$acqN.' et le mandat numéro : '.$numMandat,$this->_user);
						header('location:'.$redirectT);
					}
				}
			}else{
				$this->_title = 'Niveau d\'acces incorrect' ;
				$this->_template=dirname(__FILE__).'/views/pasAcces.tpl';
			}
		}elseif(isset($get['page'])&&($get['page']=='see'||$get['page']=='seeByAcq'||$get['page']=='seeByChooseM'||$get['page']=='seeByMan')){



			// Redirige à la bonne page
			if($get['page']=='see'){
				$redirect=Tools::create_url($this->_user,'rapprochement','list');
				$labelRedirect = 'Retour à la liste';
				$linkToDelete = Tools::create_url($this->_user,'rapprochement','deleteL',$get['action']);
				$linkToUpdate = Tools::create_url($this->_user,'rapprochement','updateL',$get['action']);
			}elseif($get['page']=='seeByAcq'){
				$linkToUpdate = Tools::create_url($this->_user,'rapprochement','updateAcq',$get['action'],array($get['action2']));
				$redirect=Tools::create_url($this->_user,'acquereur','see',$get['action2']);
				$labelRedirect = 'Retour à la fiche de l\'acquereur.';
				$linkToDelete = Tools::create_url($this->_user,'rapprochement','deleteAcq',$get['action'],array($get['action2']));
			}elseif($get['page']=='seeByChooseM'){

				$linkToUpdate = Tools::create_url($this->_user,'rapprochement','updateChooseM',$get['action'],array($get['action2']));
				$redirect=Tools::create_url($this->_user,'rapprochement','chooseMandate',$get['action2']);
				$labelRedirect = 'Retour à la fiche de choix des mandats.';
				$linkToDelete = Tools::create_url($this->_user,'rapprochement','deleteChooseM',$get['action'],array($get['action2']));
			}elseif($get['page']=='seeByMan'){

				$linkToUpdate = Tools::create_url($this->_user,'rapprochement','updateMan',$get['action'],array($get['action2']));
				// get mandat
				$mandate = Mandate::load($this->_pdo,$_GET['action2']);
				$mod = $mandate->getMandateType()->getIdMandateType()!=Constant::ID_PLOT_OF_LAND?'mandat':'terrain';
				$redirect = Tools::create_url($this->_user,$mod,'see',$mandate->getIdMandate());
				$labelRedirect = 'Retour à la fiche du bien.';
				$linkToDelete = Tools::create_url($this->_user,'rapprochement','deleteMan',$get['action'],array($get['action2']));
			}
				

			$this->_title = 'Fiche du rapprochement';
			$this->_template=dirname(__FILE__).'/views/see.tpl';



			// on charge le rapprochement
			$rapprochement = BddRapprochement::load($this->_pdo,$get['action']);
			$this->_smarty->assign('linkToUpdate',$linkToUpdate);
			$this->_smarty->assign('linkToDelete',$linkToDelete);
			$this->_smarty->assign('rapprochement',$rapprochement);
			$this->_smarty->assign('redirect',$redirect);
			$this->_smarty->assign('labelRedirect',$labelRedirect);

			// 	passage en compromis
			if(isset($post['goCompromis'])){

				// On passe le mandat en compromis, et on redirige vers celui ci
				$rapprochement->setCompromis( 1 );
				$rapprochement->getMandate()->setEtap( MandateEtap::load($this->_pdo, Constant::ID_ETAP_COMPROMIS));
				// On désactive les autres rapprochements pour ce mandat.
				$pdoStatement = BddRapprochement::selectByMandate($this->_pdo,$rapprochement->getMandate());
				while($ra = BddRapprochement::fetch($this->_pdo,$pdoStatement)){
					if(!$rapprochement->equals($ra)){
						//						var_dump($ra);
						$ra->setActif(0);
							

					}
				}

				$mod = $rapprochement->getMandate()->getMandateType()->getIdMandateType() == Constant::ID_PLOT_OF_LAND?'terrain':'mandat';

				Log::create($this->_pdo,time(),'rapprochement','Passage du mandat '.$rapprochement->getMandate()->getNumberMandate().' en etat compromis',$this->_user);
				header('location:'.Tools::create_url( $this->_user, $mod,'see',$rapprochement->getMandate()->getIdMandate() ));
					
			}

		}elseif(isset($get['page'])&&($get['page']=='update'||$get['page']=='updateL'||$get['page']=='updateAcq'||$get['page']=='updateChooseM'||$get['page']=='updateMan')){
			if($get['page']=='update') $redirect = Tools::create_url($this->_user,'rapprochement','list');
			elseif($get['page']=='updateL') $redirect = Tools::create_url($this->_user,'rapprochement','see',$get['action']);
			elseif($get['page']=='updateAcq') $redirect = Tools::create_url($this->_user,'rapprochement','seeByAcq',$get['action'],array($get['action2']));
			elseif($get['page']=='updateChooseM') $redirect = Tools::create_url($this->_user,'rapprochement','seeByChooseM',$get['action'],array($get['action2']));
			elseif($get['page']=='updateMan') $redirect = Tools::create_url($this->_user,'rapprochement','seeByMan',$get['action'],array($get['action2']));
			$this->_title = 'Mise à jour du rapprochement';
			$rapprochement = BddRapprochement::load($this->_pdo,$get['action']);
			// verification du niveau
			if($this->_user->getLevelMember()->getIdLevelMember() < 3 || $this->_user->getIdUser() == $rapprochement->getUser()->getIdUser()){
				$this->_template=dirname(__FILE__).'/views/update.tpl';
				// var par defaut
				if(empty($post)){
						
					$mandate = $rapprochement->getMandate()->getIdMandate();
					
					$utilisateurLie = $rapprochement->getUser()->getIdUser();
					$acq = $rapprochement->getAcquereur()->getIdAcquereur();
					$dateVisite = $rapprochement->getDateVisite()?date(Constant::DATE_FORMAT,$rapprochement->getDateVisite()):'';
					$dateCompteRendu = $rapprochement->getCompteRenduLe()?date(Constant::DATE_FORMAT,$rapprochement->getCompteRenduLe()):'';
					$resultat = $rapprochement->getResultat();
					$ptPositifs = $rapprochement->getPointsPositifs();
					$ptNegatifs = $rapprochement->getPointsNegatifs();
					$resultatVisite = $rapprochement->getResultatVisite();
				}else{
					$ptPositifs = $post['ptPositifs'];
					$resultatVisite = $post['resultatVisite'];
					$ptNegatifs = $post['ptNegatifs'];
					$mandate = $post['mandate'];
					$utilisateurLie = empty($post['utilisateurLie'])?$rapprochement->getUser()->getIdUser():$post['utilisateurLie'];
					$acq = $post['acq'];
					$dateVisite = $post['dateVisite'];
					$dateCompteRendu = $post['dateCompteRendu'];
					$resultat = $post['resultat'];
				}
					
				if(isset($post['cancel']))header('location:'.$redirect);
				if(isset($post['send'])){
					// Si ce rapprochement existe deja
					if($acq != $rapprochement->getAcquereur()->getIdAcquereur()
					||
					$mandate != $rapprochement->getMandate()->getIdMandate()
					){
						if(BddRapprochement::relMandateAcquereurExist($this->_pdo,Mandate::load($this->_pdo,$mandate),Acquereur::load($this->_pdo,$acq)))$error[]= 'Ce rapprochement existe déjà';
					}

					if(empty($error)){
						// Maj des utilisateurs
						if($utilisateurLie != $rapprochement->getUser()->getIdUser()){
							$rapprochement->getUser()->setNumberUsed($rapprochement->getUser()->getNumberUsed()-1);
							$rapprochement->setUser( User::load($this->_pdo,$utilisateurLie));
							$rapprochement->getUser()->setNumberUsed($rapprochement->getUser()->getNumberUsed()+1);
						}
						if($acq != $rapprochement->getAcquereur()->getIdAcquereur()){
							$rapprochement->getAcquereur()->setNumberUsed($rapprochement->getAcquereur()->getNumberUsed()-1);
							$rapprochement->getAcquereur( Acquereur::load($this->_pdo,$acq));
							$rapprochement->getAcquereur()->setNumberUsed($rapprochement->getAcquereur()->getNumberUsed()+1);
						}
						$rapprochement->setMandate( Mandate::load($this->_pdo,$mandate),false);
						$rapprochement->setDateVisite( $dateVisite==''?null:Tools::dateTimeFrToTime( $dateVisite ) ,false);
						$rapprochement->setCompteRenduLe($dateCompteRendu==''?null:Tools::dateTimeFrToTime( $dateCompteRendu ),false );
						$rapprochement->setResultat( htmlspecialchars($resultat)  ,false);
						$rapprochement->setPointsPositifs(htmlspecialchars($ptPositifs),false);
						$rapprochement->setPointsNegatifs(htmlspecialchars($ptNegatifs),false);
						$rapprochement->setResultatVisite( $resultatVisite,false);
						$rapprochement->update();
						Log::create($this->_pdo,time(),'rapprochement','Mise à jour du rapprochement entre : '.$rapprochement->getAcquereur()->getFirstname().' '.
						$rapprochement->getAcquereur()->getName().' et le mandat'.$rapprochement->getMandate()->getNumberMandate(),$this->_user);
						header('location:'.$redirect);
					}
				}
				$this->_smarty->assign('mandate',$mandate);
				$this->_smarty->assign('resultatVisite',$resultatVisite);
				$this->_smarty->assign('ptNegatifs',$ptNegatifs);
				$this->_smarty->assign('ptPositifs',$ptPositifs);
				$this->_smarty->assign('resultat',$resultat);
				$this->_smarty->assign('dateCompteRendu',$dateCompteRendu);
				$this->_smarty->assign('dateVisite',$dateVisite);
				$this->_smarty->assign('rapprochement',$rapprochement);
				$this->_smarty->assign('utilisateurLie',$utilisateurLie);
				$this->_smarty->assign('acq',$acq);
				//$this->_smarty->assign('listMandate',Mandate::loadByEtap($this->_pdo,MandateEtap::load($this->_pdo,Constant::ID_ETAP_TO_SELL)));
				
				$this->_smarty->assign('listMandate',
				Mandate::loadByEtap($this->_pdo,
					MandateEtap::load($this->_pdo,Mandate::load($this->_pdo,$mandate)->getEtap()->getIdMandateEtap()  )));
				
				
				$this->_smarty->assign('listAcq',Acquereur::loadAllAsset($this->_pdo));
				if($this->_user->getLevelMember()->getIdLevelMember()<3) $this->_smarty->assign('listUser',User::loadAll($this->_pdo));
					
			}else{
				$this->_title = 'Niveau d\'acces incorrect' ;
				$this->_template=dirname(__FILE__).'/views/pasAcces.tpl';
			}
		}elseif(isset($get['page'])&&($get['page']=='add')){
			// choix de l'acquereur (2 tableaux).
			$this->_title = 'Ajouter un rapprochement';
			$this->_smarty->assign('listAcq',Acquereur::loadAllAsset($this->_pdo));
			$this->_template = dirname(__FILE__).'/views/add.tpl';
		}elseif(isset($get['page'])&&($get['page']=='chooseMandate')){
			$this->_title = 'Choix des mandats à rapprocher';
			$this->_template = dirname(__FILE__).'/views/chooseMandate.tpl';
			$acq = Acquereur::load($this->_pdo, $get['action']);

			$listMandats = empty($post['allMandat'])?Rapprochement::listMandateForAcq($this->_pdo,$acq):Mandate::loadByEtap($this->_pdo,MandateEtap::load($this->_pdo,Constant::ID_ETAP_TO_SELL));
			$h2 = empty($post['allMandat'])?'Liste des mandats correspondants aux critères':'Tous les mandats';



			// assign ...
			$this->_smarty->assign('allMandat',$post['allMandat']);
			$this->_smarty->assign('h2',$h2);
			$this->_smarty->assign('acq',$acq);
			$this->_smarty->assign('pdo',$this->_pdo);
			$this->_smarty->assign('listMandats',$listMandats);


		}elseif(isset($get['page'])&&$get['page']=='log'){
			$this->_title = 'Logs du module';
			$this->_template =dirname(__FILE__).'/../tpl_default/log.tpl';
			$a = Log::selectByModule($this->_pdo,'rapprochement');
			while($logs = Log::fetch($this->_pdo,$a)){
				$arrayLog[] = $logs;
					
				$this->_smarty->assign('arrayLog', $arrayLog );}

		}

		$this->_smarty->assign('error',$error);
	}
	public function treatment( $post,$get){
		$this->_smarty->assign('user',$this->_user );
		if(!$this->_error_dependance){
			$this->_treatment( $post,$get);
		}
	}

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