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
				Log::create($this->_pdo,time(),"action",'accès non autorisé',$this->_user );
			} else{
				$this->_template = dirname(__FILE__).'/views/default.tpl';
				$this->_addMainMenu();
				$this->_addMenu('action');
				$this->_title = 'Gestion des actions';
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
		if(isset($get['page'])&&$get['page']=='add_libel'){
			// Nouveau tpl etc ...
			$this->_title='Ajouter un libellé d\'action';
			$this->_template =dirname(__FILE__).'/views/add_libel.tpl';
			$error = array();
			if($post['send']){
				if($post['libel']=='') $error[]="Le libellé d'action doit être renseigné.";
				if(empty($error)){
				LibelAction::create($this->_pdo,$post['libel']);
				Log::create($this->_pdo,time(),'action','Ajout du libellé d\'action : '.$post['libel'],$this->_user);
				header('location:'.Tools::create_url($this->_user,$get['module'],'list_libel',$get['action']));
				}
			$this->_smarty->assign('error',$error);

			}
            $this->_smarty->assign('add',true);
		}
		if(isset($get['page'])&&$get['page']=='list_libel'){
			$this->_title='Liste des libellés d\'action';
			$this->_template =dirname(__FILE__).'/views/list_libel.tpl';
			$this->_smarty->assign('listLibelAct',LibelAction::loadAll($this->_pdo));
			
		}if(isset($get['page'])&&$get['page']=='upd_libel'){
			$libel = LibelAction::load($this->_pdo,$get['action']);
			$this->_title='Modifier le libellé d\'action : '.$libel->getLibel();
			$this->_template =dirname(__FILE__).'/views/add_libel.tpl';
			$this->_smarty->assign('libel',$libel->getLibel());
			$error = array();
			if($post['send']){
				if($post['libel']=='') $error[]="Le libellé d'action doit être renseigné.";
				if(empty($error)){
				$libel->setLibel($post['libel']);
				Log::create($this->_pdo,time(),'action','Modification du libellé d\'action : '.$post['libel'],$this->_user);
				header('location:'.Tools::create_url($this->_user,$get['module'],'list_libel'));
				}
				$this->_smarty->assign('error',$error);

			}
            $this->_smarty->assign('add',false);
		}if(isset($get['page'])&&$get['page']=='del_libel'){
			$this->_title = 'Suppression du libellé d\'action.';
			$this->_template =dirname(__FILE__).'/views/del_libel.tpl';
			$libel =LibelAction::load($this->_pdo,$get['action']);
			$this->_smarty->assign('libel',$libel);
			if(isset($_POST['cancel'])){
				header('location:'.Tools::create_url($this->_user,$get['module'],'list_libel',$get['action']));
			}if(isset($_POST['delete'])){
				$libelN = $libel->getLibel();
				$libel->delete();
				Log::create($this->_pdo,time(),'action','Suppression du libellé d\'action : '.$libelN,$this->_user);
				header('location:'.Tools::create_url($this->_user,$get['module'],'list_libel',$get['action']));
			}
		}
		if(isset($get['page'])&&$get['page']=='add'){
			$this->_title = 'Ajouter une action';
			$this->_template =dirname(__FILE__).'/views/add.tpl';
			$this->_smarty->assign('listUser',User::loadAll($this->_pdo));
			// methode à creer : charcher les éléments à vendre/ à louer
			$this->_smarty->assign('listMandate',Mandate::loadAll($this->_pdo));
			// Liste des mandats en etat à vendre uniquement, ( definition ? Num mandat, type de bien  ).
			// variables par defaut :

			$from = $this->_user->getIdUser();
			$to = $this->_user->getIdUser();
			$initDate=null;
			$deadDate=null;
			$libel = '';

			$comment = '';
			$mandate=$get['action']==null?null:Mandate::load($this->_pdo,$get['action'])->getIdMandate();
			if(isset($post['send'])){
				$from = $post['from']==null?null:$post['from'];
				$to = $post['to'];
				$initDate=trim(htmlspecialchars($post['initDate']));
				$deadDate=$post['deadDate']==''?null:trim(htmlspecialchars($post['deadDate']));
				$mandate=$post['mandate']==''?null:trim(htmlspecialchars($post['mandate']));

				$libel = trim(htmlspecialchars($post['libel']));
				$libelS = trim(htmlspecialchars($post['libelS']));
				$comment =trim(htmlspecialchars($post['comment']));

				if(empty($libel) && $libelS=='0' )$error[]='Le libellé de l\'action doit être renseigné.';
				if(empty($initDate))$error[]='La date de début de l\'action doit être renseignée.';
				elseif(!Tools::is_date_time_fr($initDate))$error[]='La date de début doit être au format suivant : jj/mm/YYYY HH:mm:ss.';
				if(!empty($deadDate)&&!Tools::is_date_time_fr($deadDate))$error[]='La date de fin doit être au format suivant : jj/mm/YYYY.';
				if(!empty($deadDate)&&Tools::date1_is_superior_to_date2_date_time_fr($initDate,$deadDate))$error[]='La date de fin doit être supérieure à la date de début.';
				if(empty($error)){
					$libelS = $libelS=='0'?'':$libelS;
					// dans le cas ou from est null (opérateur par exemple) on prend le membre connecté
					$oFrom = $from===null?$this->_user:User::load($this->_pdo,$from);
					$oTo = User::load($this->_pdo,$to);
					$oMandate = $mandate==null?null:Mandate::load($this->_pdo,$mandate);
					// save
					Action::create($this->_pdo,$libelS.' '.$libel,Tools::dateTimeFrToTime($initDate),$deadDate==null?null:Tools::dateTimeFrToTime($deadDate),$comment,$oFrom,$oTo,null,$oMandate);
					// Ajout de + 1 utilisation au from et au to
					$oFrom->setNumberUsed( $oFrom->getNumberUsed() +1 );
					$oTo->setNumberUsed( $oTo->getNumberUsed() +1 );
					Log::create($this->_pdo,time(),'action','Ajout d\'une action de '.$oFrom->getName().' pour '.$oTo->getName(),$this->_user );
					// Mail ????
					if(empty($get['action']))
					header('location:'.Tools::create_url($this->_user,$get['module']));
					else
					header('location:'.$_SESSION['page-1']);
					//					if(empty($_SESSION['page-1']))
					//						header('location:'.Constant::DEFAULT_URL);
					//					else
					//
				}
					
			}
			$this->_smarty->assign('from',$from);
			$this->_smarty->assign('to',$to);
			$this->_smarty->assign('initDate',$initDate);
			$this->_smarty->assign('deadDate',$deadDate);
			$this->_smarty->assign('libel',$libel);
			$this->_smarty->assign('mandate',$mandate);
			$this->_smarty->assign('comment',$comment);
			$this->_smarty->assign('listLibel', LibelAction::loadAll($this->_pdo));

		}elseif(isset($get['page'])&&$get['page']=='see'){


			$partR = explode('/', $_SESSION['page-1']);
			if(empty($partR[7])) $partR[7]='dl';
			$partR = array_reverse($partR);
			if(($partR[1]=='list'||$partR[1]=='list_old')&&$partR[2]=='mod-action'){
				$_SESSION['redirect'] = $_SESSION['page-1'];
			}elseif($partR[2]!=='mod-action'){
				$_SESSION['redirect'] = $_SESSION['page-1'];
			}

			$this->_title = 'Voir l\'action';
			$this->_template =dirname(__FILE__).'/views/see.tpl';
			$action = Action::load($this->_pdo,$get['action']);

			$this->_smarty->assign('action',$action);

			if($post['cancel']){
				if(empty($_SESSION['page-1']))
				header('location:'.Constant::DEFAULT_URL);
				else
				header('location:'.$_SESSION['redirect']);

			}if($post['valid']){
				if(($this->_user->getLevelMember()->getIdLevelMember()<3||$this->_user->getIdUser()==$action->getTo()->getIdUser()||$this->_user->getIdUser()==$action->getFrom()->getIdUser())&&!$action->getDoDate()){
					// Si un commentaire est affiché, on l'ajoute au champs detail (md5 à définir ) en séparation.

					//	echo $post['comment'];
					if( trim(htmlspecialchars($post['comment']))!='')
					$action->setComment( $action->getComment().'<br/> Commentaires post action : '.trim(htmlspecialchars($post['comment'])) );

					$action->setDoDate(time());
					//					$action->update();
					Log::create($this->_pdo,time(),'action','Action : "'.$action->getLibel().'" effectuée.',$this->_user);
					if(empty($_SESSION['page-1']))
					header('location:'.Constant::DEFAULT_URL);
					else
					header('location:'.$_SESSION['redirect']);
					// On ajoute la hFait,
					// Redirection.
				}
			}
		}elseif( isset($get['page'])&&( $get['page']=='del') || isset($get['page'])&&( $get['page']=='delO') ){
			// verif du droit d'acces (parent ou admin minumum)
			$action = Action::load($this->_pdo,$get['action']);

			if ($this->_user->getLevelMember()->getIdLevelMember()<3||$action->getFrom()->getIdUser() == $this->_user->getIdUser()&&(!$action->getDoDate())){
				$this->_title = 'Suppression de l\'action';
				$redirect = $get['page']==delO?'list_old':'list';
				//				var_dump($action);
				// Appel du tpl
				$this->_template = dirname(__FILE__).'/views/del.tpl';
				// Si post n'est pas vide et que post = supprimer on éclate.
				// Si post = annnuler, on redirige vers la liste.
				if(isset($post['cancel'])){

					header('location:'.Tools::create_url($this->_user,'action',$redirect));
				}if(isset($post['delete'] )){
					$actN = $action->getLibel();
					$to = $action->getTo();
					$from = $action->getFrom();
					$action->delete();
					$to->setNumberUsed($to->getNumberUsed()-1);
					$from->setNumberUsed($from->getNumberUsed()-1);
					Log::create($this->_pdo,time(),'action','Suppression de l\'action : '.$actN,$this->_user);
					header('location:'.Tools::create_url($this->_user,'action',$redirect));
				}
					
			}
		}elseif( isset($get['page'])&&( $get['page']=='list' || $get['page']=='list_old') ){
			$actions = Action::selectAll($this->_pdo);
			$listAction = array();
			if($get['page']=='list'){
				$old = false;
				$h1 = $this->_title = "Liste des actions non traitées";
				$this->_template = dirname(__FILE__).'/views/list.tpl';
				while($i = Action::fetch($this->_pdo,$actions))
				if (!$i->getDoDate() ) $listAction[]=$i;
				// non effectué
			}else{
				$old = true;
				$h1 = $this->_title = "Historique des actions traitées";
				$this->_template = dirname(__FILE__).'/views/list.tpl';
				while($i = Action::fetch($this->_pdo,$actions))
				if ($i->getDoDate() ) $listAction[]=$i;

			}
			$this->_smarty->assign('old',$old);
			$this->_smarty->assign('h1',$h1);
			$this->_smarty->assign('actions',$listAction);

		}elseif(isset($get['page'])&&$get['page']=='update'){
			$action = Action::load($this->_pdo,$get['action']);

			if ($this->_user->getLevelMember()->getIdLevelMember()<3||$action->getFrom()->getIdUser() == $this->_user->getIdUser()&&(!$action->getDoDate())){
				$this->_title = 'Modifier l\'action';
				$this->_template =dirname(__FILE__).'/views/update.tpl';
				// a modifier
				$this->_smarty->assign('listUser',User::loadAll($this->_pdo));
				// methode à creer : charcher les éléments à vendre/ à louer
				$this->_smarty->assign('listMandate',Mandate::loadAll($this->_pdo));
				// Liste des mandats en etat à vendre uniquement, ( definition ? Num mandat, type de bien  ).
				// variables par defaut :
					
					
					

					
				$from = $action->getFrom()->getIdUser();
				$to = $action->getTo()->getIdUser();
					
				$initDate= $action->getInitDate()==null?null:date(Constant::DATE_FORMAT,$action->getInitDate());
				$deadDate=$action->getDeadDate()==null?null:date(Constant::DATE_FORMAT,$action->getDeadDate());
				$libel = $action->getLibel();
				$comment = $action->getComment();

				$mandate=$action->getMandate()==null?null:$action->getMandate()->getIdMandate();
				if(isset($post['send'])){
					$from = $post['from']==null?null:$post['from'];
					$to = $post['to'];
					$initDate=trim(htmlspecialchars($post['initDate']));
					$deadDate=$post['deadDate']==''?null:trim(htmlspecialchars($post['deadDate']));

					$mandate=$post['mandate']==''?null:trim(htmlspecialchars($post['mandate']));

					$libel = trim(htmlspecialchars($post['libel']));
					$comment =trim(htmlspecialchars($post['comment']));

					if(empty($libel))$error[]='Le libellé de l\'action doit être renseigné.';
					if(empty($initDate))$error[]='La date de début de l\'action doit être renseignée.';
					elseif(!Tools::is_date_time_fr($initDate))$error[]='La date de début doit être au format suivant : jj/mm/YYYY.';
					if(!empty($deadDate)&&!Tools::is_date_time_fr($deadDate))$error[]='La date de fin doit être au format suivant : jj/mm/YYYY.';
					if(!empty($deadDate)&&Tools::date1_is_superior_to_date2_date_time_fr($initDate,$deadDate))$error[]='La date de fin doit être supérieure à la date de début.';
					if(empty($error)){

						// dans le cas ou from est null (opérateur par exemple) on prend le membre connecté
						$oFrom = $from==null?$this->_user:User::load($this->_pdo,$from);
						$oTo = User::load($this->_pdo,$to);
						$oMandate = $mandate==null?null:Mandate::load($this->_pdo,$mandate);
						// update
						$action->setLibel( $libel ,false);
						$action->setInitDate(Tools::dateTimeFrToTime($initDate),false);
							
						$action->setDeadDate($deadDate==null?null:Tools::dateTimeFrToTime($deadDate),false);
						$action->setComment($comment,false);

						if( ! $action->getFrom()->equals($oFrom) ){
							$action->getFrom()->setNumberUsed( $action->getFrom()->getNumberUsed() -1 );
							$action->setFrom($oFrom);
							$action->getFrom()->setNumberUsed( $action->getFrom()->getNumberUsed() +1 );
						}
						if( ! $action->getTo()->equals($oTo) ){
							$action->getTo()->setNumberUsed( $action->getTo()->getNumberUsed() -1 );
							$action->setTo($oTo);
							$action->getTo()->setNumberUsed( $action->getTo()->getNumberUsed() +1 );
						}
						$action->setMandate($oMandate,false);
						$action->update();
						Log::create($this->_pdo,time(),'action','Modification d\'une action de '.$oFrom->getName().' pour '.$oTo->getName(),$this->_user );
						// Mail ????
						//				header('location:'.Tools::create_url($this->_user,$get['module']));

						if(empty($_SESSION['page-1']))
						header('location:'.Constant::DEFAULT_URL);
						else
						header('location:'.$_SESSION['page-1']);
					}

				}
				$this->_smarty->assign('from',$from);
				$this->_smarty->assign('to',$to);
				$this->_smarty->assign('initDate',$initDate);
				$this->_smarty->assign('deadDate',$deadDate);
				$this->_smarty->assign('libel',$libel);
				$this->_smarty->assign('mandate',$mandate);
				$this->_smarty->assign('comment',$comment);
				// fin modif
			}
		}elseif(isset($get['page'])&&$get['page']=='log'){
			$this->_title = 'logs du module action';
			$this->_template =dirname(__FILE__).'/../tpl_default/log.tpl';
			$a = Log::selectByModule($this->_pdo,'action');
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