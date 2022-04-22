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
				Log::create($this->_pdo,time(),"acquereur",'accès non autorisé',$this->_user );
			} else{
				$this->_template = dirname(__FILE__).'/views/default.tpl';
				$this->_addMainMenu();
				$this->_addMenu('acquereur');
				$this->_title = 'Gestion des acquereurs';
			}
		}
	}

	protected function install(){
		if(!$this->getInstallation('acquereur')){
			// install
			AcquereurAssocie::createTableIfNotExist($this->_pdo);
			// défini le module comme installé
			$this->setInstallation('acquereur', 1);
		}
	}
	public function addMeta(){
		$this->_smarty->assign('title',	$this->_title );
	}
	private function _treatment( $post,$get){
		// page par defaut (envoyé vers une fct)
		if(empty($get['page']))$get['page']='list';
		$error = array();




		if( isset($get['page'])&&$get['page']==='addAcqAssocie' ){
			$acq = Acquereur::load($this->_pdo, $get['action']);
			// verification du droit de modif
			if($acq->getUser()->getId() == $this->_user->getId() || $this->_user->getLevelMember()->getIdLevelMember() < 3){
				$this->_title = 'Ajouter un acquereur associé à '.$acq->getName().' '.$acq->getFirstname();
				$this->_template = dirname(__FILE__).'/views/addAcqAssocie.tpl';
					
				$titreAcquereur = $post['titreAcquereur']==null?'':$post['titreAcquereur'];
				$name = $post['name']==null?'':$post['name'];
				$firstname = $post['firstname']==null?'':$post['firstname'];
				$address = $post['address']==null?'':$post['address'];
				$city = $post['city']==null?'':$post['city'];
				$phone	= $post['phone']==null?'':$post['phone'];
				$mobilPhone	= $post['mobilPhone']==null?'':$post['mobilPhone'];
				$workPhone	= $post['workPhone']==null?'':$post['workPhone'];
				$fax = $post['fax']==null?'':$post['fax'];
				$email = $post['email']==null?'':$post['email'];
				$comment = $post['comment']==null?'':$post['comment'];



				$maidenName =$post['maidenName']==null?'':$post['maidenName'];
				$birthdate = $post['birthdate']==null?null:$post['birthdate'];
				$birthLocation = $post['birthLocation']==null?'':$post['birthLocation'];
				$nationality = $post['nationality']==null?'':$post['nationality'];
				$job =$post['job']==null?'':$post['job'];

				$situation = $post['situation'];
				// on récupere la clé correspondante à l'id de la situation

				$key =$situation? array_search($situation,  $post['id']):'';
				$situationDate = $post['eventDate'][$key];
				$situationLocation =$post['eventLocation'][$key];


				// Situations
				$this->_smarty->assign('listSituation',SituationAcquereur::loadAll($this->_pdo));
				$this->_smarty->assign('situation',$situation);
				$this->_smarty->assign('situationDate',$situationDate);
				$this->_smarty->assign('situationLocation',$situationLocation);

				$this->_smarty->assign('add',true);
				$this->_smarty->assign('maidenName',$maidenName);
				$this->_smarty->assign('birthdate',$birthdate);
				$this->_smarty->assign('nationality',$nationality);
				$this->_smarty->assign('birthLocation',$birthLocation);
				$this->_smarty->assign('job',$job);

					
				$this->_smarty->assign('listTitre',TitreAcquereur::loadAll($this->_pdo));
				$this->_smarty->assign('listCity',City::loadAll($this->_pdo));
				$this->_smarty->assign('name',$name);
				$this->_smarty->assign('firstname',$firstname);
				$this->_smarty->assign('address',$address);
				$this->_smarty->assign('city',$city);
				$this->_smarty->assign('phone',$phone);
				$this->_smarty->assign('mobilPhone',$mobilPhone );
				$this->_smarty->assign('workPhone',$workPhone );
				$this->_smarty->assign('fax',$fax );
				$this->_smarty->assign('email',$email );
				$this->_smarty->assign('comment',$comment );
				$this->_smarty->assign('titreAcquereur',$titreAcquereur );
					
				if(isset($post['valid'])){

					if($name=='')$error[]='Le nom doit être renseigné';
					if(empty($error)){
						$oCity = City::load($this->_pdo,$city);
						//$oUserSelected = User::load($this->_pdo,$userSelected);

						$acqAssos = AcquereurAssocie::create($this->_pdo, $name, $firstname, $address, $phone, $mobilPhone, $workPhone, $fax, $email, $comment, $oCity, $acq, TitreAcquereur::load($this->_pdo, $titreAcquereur));
						if($acqAssos){
							// Ajoute +1 à la ville
							$oCity->setNumberUsed( $oCity->getNumberUsed() +1 );

							// ajout de la relation

							$situationDate = $situationDate?Tools::dateFrToTime($situationDate):null;
							$situ = SituationAcquereur::load($this->_pdo, $situation);
							// Sauvegarde de la situation ( relation)
							if($situ)
							RelSituaTionAcq::create($this->_pdo, $situ, null,$acqAssos,$situationDate,$situationLocation );
						}

						// ajout des autres infos
						$acqAssos->setMaidenName($maidenName);
							
						$acqAssos->setBirthdate($birthdate==null?$birthdate:Tools::dateFrToTime($birthdate));
						$acqAssos->setBirthLocation($birthLocation);
						$acqAssos->setNationality($nationality);
						$acqAssos->setJob($job);

						Log::create($this->_pdo,time(),'acquereur','Ajout de l\'acquereur associé: '.htmlspecialchars($acqAssos->getName().' '.$acqAssos->getFirstname()),$this->_user);
						header('location:'.Tools::create_url($this->_user,$get['module'], 'see',$get['action'] ));
					}

				}
				if(isset($post['cancel'])) header('location:'.Tools::create_url($this->_user,$get['module'],'see',$get['action']));
			}


		}
		if( isset($get['page'])&&$get['page']==='updateAcqAssos' ){

			$this->_template =dirname(__FILE__).'/views/addAcqAssocie.tpl';
			$acqAssos = AcquereurAssocie::load($this->_pdo, $get['action']);
			$acq = Acquereur::load($this->_pdo, $acqAssos->getAcquereur()->getIdAcquereur() );
			$this->_title = 'Modification de l\'acquereur associé à '.$acqAssos->getName().' '.$acqAssos->getFirstname();
			// verification du droit de modif
			if($acq->getUser()->getId() == $this->_user->getId() || $this->_user->getLevelMember()->getIdLevelMember() < 3){

				if($acq){
					$titreAcquereur = empty($post)?$acqAssos->getTitreAcquereur()->getIdTitreAcquereur():$post['titreAcquereur'];

					$name = empty($post)?$acqAssos->getName():$post['name'];

					$firstname = empty($post)?$acqAssos->getFirstname():$post['firstname'];
					$address = empty($post)?$acqAssos->getAdress():$post['address'];

					$city = empty($post)?$acqAssos->getCity()->getIdCity():$post['city'];

					$phone	= empty($post)?$acqAssos->getPhone():$post['phone'];
					$mobilPhone	= empty($post)?$acqAssos->getCellPhone():$post['mobilPhone'];
					$workPhone	= empty($post)?$acqAssos->getWorkPhone():$post['workPhone'];
					$fax = empty($post)?$acqAssos->getFax():$post['fax'];
					$email = empty($post)?$acqAssos->getEmail():$post['email'];
					$comment = empty($post)?$acqAssos->getComment():$post['comment'];

					$maidenName = empty($post)?$acqAssos->getMaidenName():$post['maidenName'];
					$birthdate = empty($post)? ($acqAssos->getBirthdate()?date(Constant::DATE_FORMAT2,$acqAssos->getBirthdate()):''):$post['birthdate'];
					$birthLocation = empty($post)?$acqAssos->getBirthLocation():$post['birthLocation'];
					$nationality = empty($post)?$acqAssos->getNationality():$post['nationality'];
					$job = empty($post)?$acqAssos->getJob():$post['job'];

					// situation de famille :
					// Utilisatin possible d'une situation via post. Si l'acq en possede une, il faut utliser la relation...
					if(empty($post)){
						// utilisation de la relatioon si elle existe
						$rel = RelSituaTionAcq::loadByAcquereurAssos($this->_pdo, $acqAssos);
							
						$situation =$rel?$rel->getSituationAcquereur()->getId():'';
						$situationDate =$rel?date(Constant::DATE_FORMAT2,$rel->getEventDate() ):'';
						$situationLocation =$rel?$rel->getEventLocation():'';
					}else{
						$situation = $post['situation'];
						// on récupere la clé correspondante à l'id de la situation
						$key =$situation? array_search($situation,  $post['id']):'';
						$situationDate = $post['eventDate'][$key];
						$situationLocation =$post['eventLocation'][$key];
					}



					$this->_smarty->assign('maidenName',$maidenName);
					$this->_smarty->assign('birthdate',$birthdate);
					$this->_smarty->assign('nationality',$nationality);
					$this->_smarty->assign('birthLocation',$birthLocation);
					$this->_smarty->assign('job',$job);

					// Situations
					$this->_smarty->assign('listSituation',SituationAcquereur::loadAll($this->_pdo));
					$this->_smarty->assign('situation',$situation);
					$this->_smarty->assign('situationDate',$situationDate);
					$this->_smarty->assign('situationLocation',$situationLocation);



					$this->_smarty->assign('listCity',City::loadAll($this->_pdo));

					$this->_smarty->assign('listTitre',TitreAcquereur::loadAll($this->_pdo));


					$this->_smarty->assign('name',$name);
					$this->_smarty->assign('firstname',$firstname);
					$this->_smarty->assign('address',$address);
					$this->_smarty->assign('city',$city);
					$this->_smarty->assign('phone',$phone);
					$this->_smarty->assign('mobilPhone',$mobilPhone );
					$this->_smarty->assign('workPhone',$workPhone );
					$this->_smarty->assign('fax',$fax );
					$this->_smarty->assign('email',$email );

					$this->_smarty->assign('comment',$comment );
					$this->_smarty->assign('titreAcquereur',$titreAcquereur );
					if(isset($post['cancel'])){
						header('location:'.Tools::create_url($this->_user,'acquereur','see',$acq->getIdAcquereur()));
					}
					if(isset($post['valid'])){
						// verif et save
						if($name=='')$error[]='Le nom doit être renseigné';

						// Sauvegarde du reste
						$acqAssos->setTitreAcquereur( TitreAcquereur::load($this->_pdo,$titreAcquereur),false);
						$acqAssos->setName( htmlspecialchars($name),false);
						$acqAssos->setFirstname( htmlspecialchars($firstname),false);
						$acqAssos->setAdress( htmlspecialchars($address),false);
						$acqAssos->setPhone(htmlspecialchars($phone),false );
						$acqAssos->setCellPhone(htmlspecialchars($mobilPhone),false );
						$acqAssos->setWorkPhone(htmlspecialchars($workPhone) ,false);
						$acqAssos->setFax(htmlspecialchars($fax),false);
						$acqAssos->setEmail(htmlspecialchars($email),false);
						$acqAssos->setComment(htmlspecialchars($comment),false);
							
						$acqAssos->setMaidenName($maidenName,false);

						$acqAssos->setBirthdate($birthdate!=''?Tools::dateFrToTime($birthdate):null,false);
						$acqAssos->setBirthLocation($birthLocation,false);
						$acqAssos->setNationality($nationality,false);
						$acqAssos->setJob($job,false);

						$acqAssos->update();
							

						$situationDate = $situationDate?Tools::dateFrToTime($situationDate):null;

						// Si la relation existe, on la loade et on la modifie. Sinon on la crée.
						// Sauvegarde de la situation ( relation)
						//$situationDate (dd/mm/YYYY)


						// Si cet acquereur a déjà une relation ...
						if(RelSituaTionAcq::countByAcquereurAssos($this->_pdo, $acqAssos)==0){
							$situ = SituationAcquereur::load($this->_pdo, $situation);
							if($situ )
							RelSituaTionAcq::create($this->_pdo, $situ, null,$acqAssos,$situationDate,$situationLocation );
						}else{
							// on le loade et on update
							$rel = RelSituaTionAcq::loadByAcquereurAssos($this->_pdo, $acqAssos);
							// On loade les bons trucs
							$rel->setSituationAcquereur(SituationAcquereur::load($this->_pdo,$situation),false);
							$rel->setEventLocation( $situationLocation,false);
							$rel->setEventDate($situationDate,false);
							$rel->update();
						}



						if($acqAssos->getCity()->getIdCity()!==$city){
							$acqAssos->getCity()->setNumberUsed( $acqAssos->getCity()->getNumberUsed( )-1);
							$acqAssos->setCity( City::load($this->_pdo, $city ));
							$acqAssos->getCity()->setNumberUsed( $acqAssos->getCity()->getNumberUsed( )+1);
						}

						Log::create($this->_pdo,time(),'acquereur','Modification de l\'acquereur associé : '.htmlspecialchars($name.' '.$firstname),$this->_user);
						header('location:'.Tools::create_url($this->_user,'acquereur','see',$acq->getIdAcquereur()));
					}


				}else{
					$this->_smarty->assign('error',$error[]="l'acquereur que vous essayez de mettre à jour n'existe pas ou plus.");
					$this->_template= dirname(__FILE__).'/views/error.tpl';
				}
			}
		}
		if( isset($get['page'])&&$get['page']==='addT' ){

			$this->_title = 'Ajouter un titre d\'acquereur.';
			$this->_template = dirname(__FILE__).'/views/addT.tpl';
			$name = $post['name']==null?'':$post['name'];

			if(isset($post['cancel'])){
				header('location:'.Tools::create_url($this->_user,'acquereur','listT'));
			}
			if(isset($post['send'])){
				// si le champ est vide
				if(empty($name))$error[]= 'Le nom doit être renseigné.';
				// s'il est déjà dans la bdd
				elseif(TitreAcquereur::nameExist($this->_pdo,htmlspecialchars($name))) $error[] = 'Le nom est déjà dans la base de donnée';
				if(empty($error)){
					TitreAcquereur::create($this->_pdo, htmlspecialchars($name) );
					Log::create($this->_pdo,time(),'acquereur','Ajout du titre : '.htmlspecialchars($name),$this->_user);
					header('location:'.Tools::create_url($this->_user,'acquereur','listT'));
				}
			}
			$this->_smarty->assign('name',$name);
			$this->_smarty->assign('add',true);
			$this->_smarty->assign('title',"Ajouter un titre d'acquereur");
		}
		if( isset($get['page'])&&$get['page']==='listT' ){
			$this->_title = 'Liste des titres d\'acquereur.';
			$this->_template = dirname(__FILE__).'/views/listT.tpl';
			$this->_smarty->assign('listTitre',TitreAcquereur::loadAll($this->_pdo));
		}
		if( isset($get['page'])&&$get['page']==='updateT' ){
			$this->_title = 'Modifier le titre acquereur';
			$this->_template = dirname(__FILE__).'/views/addT.tpl';
			$o = TitreAcquereur::load($this->_pdo,$get['action']);
			if(isset($post['cancel'])){
				header('location:'.Tools::create_url($this->_user,'acquereur','listT',$get['action']));
			}
			$name = empty($post)?$o->getName():$post['name'];
			// Verif ....
			if(isset($post['send'])){
				if(empty($name))$error[]= 'Le nom doit être renseigné.';
				elseif($name!=$o->getName())
				if(TitreAcquereur::nameExist($this->_pdo,htmlspecialchars($name))) $error[] = 'Le nom est déjà dans la base de donnée';
				if(empty($error)){
					if($name!=$o->getName()){
						$oldName= $o->getName();
						$o->setName(htmlspecialchars($name));
						Log::create($this->_pdo,time(),'acquereur','modification du titre : '.$oldName.' en '.htmlspecialchars($name),$this->_user);
					}
					header('location:'.Tools::create_url($this->_user,'acquereur','listT',$get['action']));
				}
					
			}
			$this->_smarty->assign('name',$name);
			$this->_smarty->assign('add',false);
		}
		if( isset($get['page'])&&$get['page']==='delT' ){
			$this->_title = 'Supprimer le titre';
			$this->_template = dirname(__FILE__).'/views/delT.tpl';
			$t = TitreAcquereur::load($this->_pdo,$get['action']);
			$name='';
			if($t!=null){
				$name = $t->getName();

				if(isset($post['cancel']))header('location:'.Tools::create_url($this->_user,'acquereur','listT',$get['action']));
				if(isset($post['valid'])){
					if( Acquereur::fetch($this->_pdo,$t->selectAcquereurs()) !=null) $error[]='Impossible de supprimer ce titre car il est utilisé';
					if(empty($error)){
						$t->delete();
						Log::create($this->_pdo,time(),'acquereur','Suppression du titre : '.htmlspecialchars($name),$this->_user);
						header('location:'.Tools::create_url($this->_user,'acquereur','listT',$get['action']));
					}
				}
			}
			$this->_smarty->assign('name',$name);
		}
		if( isset($get['page'])&&$get['page']==='add' ){
			$this->_title = 'Ajout d\'un acquereur';
			$this->_template =dirname(__FILE__).'/views/add.tpl';
			$titreAcquereur = $post['titreAcquereur']==null?'':$post['titreAcquereur'];
			$name = $post['name']==null?'':$post['name'];
			$firstname = $post['firstname']==null?'':$post['firstname'];
			$address = $post['address']==null?'':$post['address'];
			$city = $post['city']==null?'':$post['city'];
			$phone	= $post['phone']==null?'':$post['phone'];
			$mobilPhone	= $post['mobilPhone']==null?'':$post['mobilPhone'];
			$workPhone	= $post['workPhone']==null?'':$post['workPhone'];
			$fax = $post['fax']==null?'':$post['fax'];
			$email = $post['email']==null?'':$post['email'];
			$typeTransaction = $post['typeTransaction']=null?'':$post['typeTransaction'];
			$typeBien = $post['typeBien']==null?'':$post['typeBien'];
			$style = $post['style']==null?'undefined':$post['style'];
			$prixMin = $post['prixMin']==null?'':$post['prixMin'];
			$prixMax = $post['prixMax']==null?'':$post['prixMax'];
			$userSelected = $post['userSelected']==null?$this->_user->getIdUser():$post['userSelected'];
			$surfaceTmin = $post['surfaceTmin']==null?'':$post['surfaceTmin'];
			$surfaceTmax = $post['surfaceTmax']==null?'':$post['surfaceTmax'];
			$surfaceHmin = $post['surfaceHmin']==null?'':$post['surfaceHmin'];
			$surfaceHmax = $post['surfaceHmax']==null?'':$post['surfaceHmax'];
			$sector = $post['sector']==null?'undefined':$post['sector'];
			$rCity = $post['rCity']==null?'undefined':$post['rCity'];
			$comment = $post['comment']==null?'':$post['comment'];

			$maidenName =$post['maidenName']==null?'':$post['maidenName'];
			$birthdate = $post['birthdate']==null?null:$post['birthdate'];
			$birthLocation = $post['birthLocation']==null?'':$post['birthLocation'];
			$nationality = $post['nationality']==null?'':$post['nationality'];
			$job =$post['job']==null?'':$post['job'];


			// situation de famille :

			$situation = $post['situation'];
			// on récupere la clé correspondante à l'id de la situation

			$key =$situation? array_search($situation,  $post['id']):'';
			$situationDate = $post['eventDate'][$key];
			$situationLocation =$post['eventLocation'][$key];

            $this->_smarty->assign('add',true);
			// Situations
			$this->_smarty->assign('listSituation',SituationAcquereur::loadAll($this->_pdo));
			$this->_smarty->assign('situation',$situation);
			$this->_smarty->assign('situationDate',$situationDate);
			$this->_smarty->assign('situationLocation',$situationLocation);

			$this->_smarty->assign('maidenName',$maidenName);
			$this->_smarty->assign('birthdate',$birthdate);
			$this->_smarty->assign('nationality',$nationality);
			$this->_smarty->assign('birthLocation',$birthLocation);
			$this->_smarty->assign('job',$job);

			$this->_smarty->assign('h1','Ajout d\'un acquereur');
			$this->_smarty->assign('listCity',City::loadAll($this->_pdo));
			$this->_smarty->assign('listSector',Sector::loadAll($this->_pdo));
			$this->_smarty->assign('listTypeTransaction',TransactionType::loadAll($this->_pdo));
			$this->_smarty->assign('listTypeBien',MandateType::loadAll($this->_pdo));
			$this->_smarty->assign('listStyle',MandateStyle::loadAll($this->_pdo));
			$this->_smarty->assign('listTitre',TitreAcquereur::loadAll($this->_pdo));
			$this->_smarty->assign('listUser',$this->_user->getLevelMember()->getIdLevelMember()<3?User::loadAll($this->_pdo):null);

			$this->_smarty->assign('userSelected',$userSelected);
			$this->_smarty->assign('name',$name);
			$this->_smarty->assign('firstname',$firstname);
			$this->_smarty->assign('address',$address);
			$this->_smarty->assign('city',$city);
			$this->_smarty->assign('phone',$phone);
			$this->_smarty->assign('mobilPhone',$mobilPhone );
			$this->_smarty->assign('workPhone',$workPhone );
			$this->_smarty->assign('fax',$fax );
			$this->_smarty->assign('email',$email );
			$this->_smarty->assign('typeTransaction',$typeTransaction );
			$this->_smarty->assign('typeBien',$typeBien );
			$this->_smarty->assign('style',$style );
			$this->_smarty->assign('prixMin',$prixMin );
			$this->_smarty->assign('prixMax',$prixMax );
			$this->_smarty->assign('surfaceTmin',$surfaceTmin );
			$this->_smarty->assign('surfaceTmax',$surfaceTmax );
			$this->_smarty->assign('surfaceHmin',$surfaceHmin );
			$this->_smarty->assign('surfaceHmax',$surfaceHmax );
			$this->_smarty->assign('sector',$sector );
			$this->_smarty->assign('rCity',$rCity );
			$this->_smarty->assign('comment',$comment );
			$this->_smarty->assign('titreAcquereur',$titreAcquereur );

			if(isset($post['valid'])){

				if($name=='')$error[]='Le nom doit être renseigné';
				if($email!=''&&!Tools::isEmail( $email))$error[]='Le format du mail est incorrect';
				if($prixMin!=''&&!is_numeric( $prixMin))$error[]='Le prix minimum doit être numérique.';
				if($prixMax!=''&&!is_numeric( $prixMax))$error[]='Le prix maximum doit être numérique.';
				if($surfaceTmin!=''&&!is_numeric( $surfaceTmin))$error[]='La surface minimum de terrain doit être numérique.';
				if($surfaceTmax!=''&&!is_numeric( $surfaceTmax))$error[]='La surface maximum de terrain doit être numérique.';
				if($surfaceHmin!=''&&!is_numeric( $surfaceHmin))$error[]='La surface habitable minimum doit être numérique.';
				if($surfaceHmax!=''&&!is_numeric( $surfaceHmax))$error[]='La surface habitable maximum doit être numérique.';
				if(empty($error)){

					if($userSelected==null){
						$userSelected =$acq->getUser()->getIdUser();
					}
					$oCity = City::load($this->_pdo,$city);
					$oRCity = City::load($this->_pdo,$rCity);
					$oUserSelected = User::load($this->_pdo,$userSelected);
					//,$actif=false,$rechercheCity=null,$rechercheSector=null
					$aq = Acquereur::create($this->_pdo,htmlspecialchars($name),htmlspecialchars($firstname),htmlspecialchars($address),htmlspecialchars($phone),
					htmlspecialchars($mobilPhone),htmlspecialchars($workPhone),htmlspecialchars($fax),htmlspecialchars($email),0,htmlspecialchars($prixMin),
					htmlspecialchars($prixMax),htmlspecialchars($surfaceTmin),htmlspecialchars($surfaceTmax),htmlspecialchars($surfaceHmin),htmlspecialchars($surfaceHmax),
					$oCity,TitreAcquereur::load($this->_pdo,$titreAcquereur),TransactionType::load($this->_pdo,$typeTransaction),
					$oUserSelected,htmlspecialchars($comment),
					MandateStyle::load($this->_pdo,$style),1,$oRCity,Sector::load($this->_pdo,$sector),MandateType::load($this->_pdo,$typeBien),strtotime(date('Y-m-d H:i:s'))
					);
					// ajout des autres infos
					$aq->setMaidenName($maidenName);

					$aq->setBirthdate($birthdate==null?$birthdate:Tools::dateFrToTime($birthdate));
					$aq->setBirthLocation($birthLocation);
					$aq->setNationality($nationality);
					$aq->setJob($job);
					// rajouter +1 aux villes, membres associés,
					$oUserSelected->setNumberUsed( $oUserSelected->getNumberUsed()+1 );
					$oCity->setNumberUsed($oCity->getNumberUsed()+1);
					if($oRCity)$oRCity->setNumberUsed( $oRCity->getNumberUsed()+1);

					$situationDate = $situationDate?Tools::dateFrToTime($situationDate):null;
					// Sauvegarde de la situation ( relation)
					$situ = SituationAcquereur::load($this->_pdo, $situation);
					if($situ)
					RelSituaTionAcq::create($this->_pdo, $situ, $aq,null,$situationDate,$situationLocation );

					Log::create($this->_pdo,time(),'acquereur','Ajout de l\'aquereur : '.$aq->getName(),$this->_user);
					header('location:'.Tools::create_url($this->_user,'acquereur'));
				}
			}
		}
		if( isset($get['page'])&&$get['page']==='list' ){
			$this->_title = 'Liste des acquereurs';
			$this->_template =dirname(__FILE__).'/views/list.tpl';
			//
//			$acq = empty($post['seeAssetAc'])?Acquereur::loadAllAsset($this->_pdo):Acquereur::loadAll($this->_pdo);
            $acq = Acquereur::loadAll($this->_pdo);
			$this->_smarty->assign('listAcq',$acq);
		}if( isset($get['page'])&&$get['page']==='update' ){
			$this->_title = 'Modification de l\'acquereur';
			$this->_template =dirname(__FILE__).'/views/add.tpl';
			$acq = Acquereur::load($this->_pdo,$get['action']);
			if($acq){

				$titreAcquereur = empty($post)?$acq->getTitreAcquereur()->getIdTitreAcquereur():$post['titreAcquereur'];
					
				$name = empty($post)?$acq->getName():$post['name'];
					
				$firstname = empty($post)?$acq->getFirstname():$post['firstname'];
				$address = empty($post)?$acq->getAddress():$post['address'];
				$city = empty($post)?$acq->getVilleAcquereur()->getIdCity():$post['city'];
				$phone	= empty($post)?$acq->getPhone():$post['phone'];
				$mobilPhone	= empty($post)?$acq->getMobilPhone():$post['mobilPhone'];
				$workPhone	= empty($post)?$acq->getWorkPhone():$post['workPhone'];
				$fax = empty($post)?$acq->getFax():$post['fax'];
				$email = empty($post)?$acq->getEmail():$post['email'];
				$typeTransaction = empty($post)?$acq->getTransactionType()->getIdTransactionType():$post['typeTransaction'];
				$typeBien = empty($post)?$acq->getMandateType()?$acq->getMandateType()->getIdMandateType():'':$post['typeBien'];
				$style = empty($post)?$acq->getMandateStyle()?$acq->getMandateStyle()->getIdMandateStyle():'undefined':$post['style'];
				$prixMin = empty($post)?$acq->getPriceMin():$post['prixMin'];
				$prixMax = empty($post)?$acq->getPriceMax():$post['prixMax'];
				$userSelected = empty($post)?$acq->getUser()->getIdUser():$post['userSelected'];
				$comment = empty($post)?$acq->getComment():$post['comment'];
				$surfaceTmin = empty($post)?$acq->getSurfaceTerrainMin():$post['surfaceTmin'];
				$surfaceTmax = empty($post)?$acq->getSurfaceTerrainMax():$post['surfaceTmax'];
				$surfaceHmin = empty($post)?$acq->getSurfaceHabitableMin():$post['surfaceHmin'];
				$surfaceHmax = empty($post)?$acq->getSurfaceHabitableMax():$post['surfaceHmax'];
				$sector = empty($post)?$acq->getRechercheSector()?$acq->getRechercheSector()->getIdSector():'undefined':$post['sector'];
				$rCity = empty($post)?$acq->getRechercheCity()?$acq->getRechercheCity()->getIdCity():'undefined':$post['rCity'];



				$maidenName = empty($post)?$acq->getMaidenName():$post['maidenName'];
				$birthdate = empty($post)? ($acq->getBirthdate()?date(Constant::DATE_FORMAT2,$acq->getBirthdate()):''):$post['birthdate'];
				$birthLocation = empty($post)?$acq->getBirthLocation():$post['birthLocation'];
				$nationality = empty($post)?$acq->getNationality():$post['nationality'];
				$job = empty($post)?$acq->getJob():$post['job'];


				// situation de famille :
				// Utilisatin possible d'une situation via post. Si l'acq en possede une, il faut utliser la relation...
				if(empty($post)){
					// utilisation de la relatioon si elle existe
					$rel = RelSituaTionAcq::loadByAcquereur($this->_pdo, $acq);

					$situation =$rel?$rel->getSituationAcquereur()->getId():'';
					$situationDate =$rel?date(Constant::DATE_FORMAT2,$rel->getEventDate() ):'';
					$situationLocation =$rel?$rel->getEventLocation():'';
				}else{
					$situation = $post['situation'];
					// on récupere la clé correspondante à l'id de la situation
					$key =$situation? array_search($situation,  $post['id']):'';
					$situationDate = $post['eventDate'][$key];
					$situationLocation =$post['eventLocation'][$key];
				}
                $this->_smarty->assign('add',false);
				$this->_smarty->assign('maidenName',$maidenName);
				$this->_smarty->assign('birthdate',$birthdate);
				$this->_smarty->assign('nationality',$nationality);
				$this->_smarty->assign('birthLocation',$birthLocation);
				$this->_smarty->assign('job',$job);


				// Situations
				$this->_smarty->assign('listSituation',SituationAcquereur::loadAll($this->_pdo));
				$this->_smarty->assign('situation',$situation);
				$this->_smarty->assign('situationDate',$situationDate);
				$this->_smarty->assign('situationLocation',$situationLocation);

				$this->_smarty->assign('h1','Modification d\'un acquereur');
				$this->_smarty->assign('listCity',City::loadAll($this->_pdo));
				$this->_smarty->assign('listSector',Sector::loadAll($this->_pdo));
				$this->_smarty->assign('listTypeTransaction',TransactionType::loadAll($this->_pdo));
				$this->_smarty->assign('listTypeBien',MandateType::loadAll($this->_pdo));
				$this->_smarty->assign('listStyle',MandateStyle::loadAll($this->_pdo));
				$this->_smarty->assign('listTitre',TitreAcquereur::loadAll($this->_pdo));
				$this->_smarty->assign('listUser',$this->_user->getLevelMember()->getIdLevelMember()<3?User::loadAll($this->_pdo):null);

				$this->_smarty->assign('userSelected',$userSelected);
				$this->_smarty->assign('name',$name);
				$this->_smarty->assign('firstname',$firstname);
				$this->_smarty->assign('address',$address);
				$this->_smarty->assign('city',$city);
				$this->_smarty->assign('phone',$phone);
				$this->_smarty->assign('mobilPhone',$mobilPhone );
				$this->_smarty->assign('workPhone',$workPhone );
				$this->_smarty->assign('fax',$fax );
				$this->_smarty->assign('email',$email );
				$this->_smarty->assign('typeTransaction',$typeTransaction );
				$this->_smarty->assign('typeBien',$typeBien );
				$this->_smarty->assign('style',$style );
				$this->_smarty->assign('comment',$comment );
				$this->_smarty->assign('prixMin',$prixMin );
				$this->_smarty->assign('prixMax',$prixMax );
				$this->_smarty->assign('surfaceTmin',$surfaceTmin );
				$this->_smarty->assign('surfaceTmax',$surfaceTmax );
				$this->_smarty->assign('surfaceHmin',$surfaceHmin );
				$this->_smarty->assign('surfaceHmax',$surfaceHmax );
				$this->_smarty->assign('sector',$sector );
				$this->_smarty->assign('rCity',$rCity );
				$this->_smarty->assign('titreAcquereur',$titreAcquereur );
				if(isset($post['valid'])){
					// verif et save
					if($name=='')$error[]='Le nom doit être renseigné';
					if($email!=''&&!Tools::isEmail( $email))$error[]='Le format du mail est incorrect';
					if($prixMin!=''&&!is_numeric( $prixMin))$error[]='Le prix minimum doit être numérique.';
					if($prixMax!=''&&!is_numeric( $prixMax))$error[]='Le prix maximum doit être numérique.';
					if($surfaceTmin!=''&&!is_numeric( $surfaceTmin))$error[]='La surface minimum de terrain doit être numérique.';
					if($surfaceTmax!=''&&!is_numeric( $surfaceTmax))$error[]='La surface maximum de terrain doit être numérique.';
					if($surfaceHmin!=''&&!is_numeric( $surfaceHmin))$error[]='La surface habitable minimum doit être numérique.';
					if($surfaceHmax!=''&&!is_numeric( $surfaceHmax))$error[]='La surface habitable maximum doit être numérique.';
					if(empty($error)){
						if($userSelected==null){
							$userSelected =$acq->getUser()->getIdUser();
						}
						// Sauvegarde du reste
						$acq->setTitreAcquereur( TitreAcquereur::load($this->_pdo,$titreAcquereur),false);
						$acq->setName( htmlspecialchars($name),false);
						$acq->setFirstname( htmlspecialchars($firstname),false);
						$acq->setAddress( htmlspecialchars($address),false);
						$acq->setPhone(htmlspecialchars($phone),false );
						$acq->setMobilPhone(htmlspecialchars($mobilPhone),false );
						$acq->setWorkPhone(htmlspecialchars($workPhone) ,false);
						$acq->setFax(htmlspecialchars($fax),false);
						$acq->setEmail(htmlspecialchars($email),false);
						$acq->setComment(htmlspecialchars($comment),false);
						$acq->setTransactionType( TransactionType::load($this->_pdo,$typeTransaction),false);
						$acq->setMandateType( MandateType::load($this->_pdo,$typeBien) ,false);
						// si le type de bien est un terrain; suppression du style
						if($typeBien==Constant::ID_PLOT_OF_LAND)
						$style='undefined';
						$acq->setMandateStyle( $style=='undefined'?null:MandateStyle::load($this->_pdo,$style),false);
						$acq->setPriceMin( htmlspecialchars($prixMin ),false);
						$acq->setPriceMax( htmlspecialchars($prixMax ),false);
						$acq->setSurfaceTerrainMin( htmlspecialchars($surfaceTmin ),false);
						$acq->setSurfaceTerrainMax( htmlspecialchars($surfaceTmax ),false);
						$acq->setSurfaceHabitableMin( htmlspecialchars($surfaceHmin ),false);
						$acq->setSurfaceHabitableMax( htmlspecialchars($surfaceHmax ),false);
						$acq->setRechercheSector( Sector::load($this->_pdo,$sector),false);


						$acq->setMaidenName($maidenName,false);

						$acq->setBirthdate($birthdate!=''?Tools::dateFrToTime($birthdate):null,false);
						$acq->setBirthLocation($birthLocation,false);
						$acq->setNationality($nationality,false);
						$acq->setJob($job,false);

						$acq->update();
						// Si les villes ou utilisateur changent, modifier les number Used

						if($acq->getUser()->getIdUser()!==$userSelected){
							$acq->getUser()->setNumberUsed($acq->getUser()->getNumberUsed()-1);
							$acq->setUser( User::load($this->_pdo,$userSelected) );
							$acq->getUser()->setNumberUsed($acq->getUser()->getNumberUsed()+1);
						}if($acq->getVilleAcquereur()->getIdCity()!==$city){
							$acq->getVilleAcquereur()->setNumberUsed( $acq->getVilleAcquereur()->getNumberUsed( )-1);
							$acq->setVilleAcquereur( City::load($this->_pdo, $city ));
							$acq->getVilleAcquereur()->setNumberUsed( $acq->getVilleAcquereur()->getNumberUsed( )+1);
						}if($rCity!='undefined'){
							if($acq->getRechercheCity()){
								if($acq->getRechercheCity()->getIdCity()!==$rCity){
									$acq->getRechercheCity()->setNumberUsed( $acq->getRechercheCity()->getNumberUsed( )-1);
									$acq->setRechercheCity( City::load($this->_pdo, $rCity ));
									$acq->getRechercheCity()->setNumberUsed( $acq->getRechercheCity()->getNumberUsed( )+1);
								}
							}else{
								$acq->setRechercheCity( City::load($this->_pdo, $rCity ));
								$acq->getRechercheCity()->setNumberUsed( $acq->getRechercheCity()->getNumberUsed( )+1);
							}
						}

						$situationDate = $situationDate?Tools::dateFrToTime($situationDate):null;

						// Si la relation existe, on la loade et on la modifie. Sinon on la crée.
						// Sauvegarde de la situation ( relation)
						//$situationDate (dd/mm/YYYY)


						// Si cet acquereur a déjà une relation ...
						if(RelSituaTionAcq::countByAcquereur($this->_pdo, $acq)==0){
							if($situation)
							RelSituaTionAcq::create($this->_pdo, SituationAcquereur::load($this->_pdo, $situation), $acq,null,$situationDate,$situationLocation );
						}else{
							// on le loade et on update
							$rel = RelSituaTionAcq::loadByAcquereur($this->_pdo, $acq);
							// On loade les bons trucs
							$rel->setSituationAcquereur(SituationAcquereur::load($this->_pdo,$situation),false);
							$rel->setEventLocation( $situationLocation,false);
							$rel->setEventDate($situationDate,false);
							$rel->update();
						}
						Log::create($this->_pdo,time(),'acquereur','Modification de l\'acquereur : '.htmlspecialchars($name),$this->_user);
						header('location:'.Tools::create_url($this->_user,'acquereur','list'));
					}
				}
					
			}else{
				$this->_smarty->assign('error',$error[]="l'acquereur que vous essayez de mettre à jour n'existe pas ou plus.");
				$this->_template= dirname(__FILE__).'/views/error.tpl';
			}


		}if( isset($get['page'])&&$get['page']==='see' ){
			$this->_title = "Fiche de l'acquereur";
			$this->_template= dirname(__FILE__).'/views/see.tpl';
			$acq = Acquereur::load($this->_pdo,$get['action']);
			$this->_smarty->assign('acq',$acq);
			$this->_smarty->assign('listAcqAssos',AcquereurAssocie::loadByAcq($this->_pdo,$acq ));

			$this->_smarty->assign('situationFamille',RelSituaTionAcq::loadByAcquereur($this->_pdo, $acq) );
		}
		if( isset($get['page'])&&$get['page']==='seeAcqAssos' ){
			$this->_title = "Fiche de l'acquereur";
			$this->_template= dirname(__FILE__).'/views/seeAcqAssos.tpl';
			$acq = AcquereurAssocie::load($this->_pdo,$get['action']);
			$this->_smarty->assign('acq',$acq);
			$this->_smarty->assign('situationFamille',RelSituaTionAcq::loadByAcquereurAssos($this->_pdo, $acq) );

		}
		if( isset($get['page'])&&$get['page']==='delete' ){
			// load du truc à del
			$this->_title = 'Supprimer l\'acquereur';
			$this->_template =dirname(__FILE__).'/views/delete.tpl';
			$acq = Acquereur::load($this->_pdo,$get['action']);
			$this->_smarty->assign('acq',$acq);
			if($acq!=null){
				if($this->_user->getLevelMember()->getIdLevelMember()<3||$this->_user->getIdUser() == $acq->getUser()->getIdUser()){
					if($post['cancel'])header('location:'.Tools::create_url($this->_user,'acquereur','list'));
					elseif($post['send']){
						if($acq->getNumberUsed()>0)$error= 'Impossible de supprimer l\'acquereur car il est utilisé';
						if(empty($error)){
							// -1 aux utilisations du membre, et des villes
							if($acq->getRechercheCity( ))$acq->getRechercheCity( )->setNumberUsed( $acq->getRechercheCity( )->getNumberUsed() -1);
							$acq->getVilleAcquereur()->setNumberUsed( $acq->getVilleAcquereur()->getNumberUsed( ) -1 );
							$acq->getUser()->setNumberUsed($acq->getUser()->getNumberUsed()-1);
							$name = $acq->getName();
							//Récupération des relations ( situation famille)
							$rel = RelSituaTionAcq::loadByAcquereur($pdo, $acq);
							if($rel)$rel->delete();
							// Suppression des acq associés
							foreach (AcquereurAssocie::loadByAcq($this->_pdo, $acq) as $item){
								// -1 sur l'utilisation de la ville
								$item->getCity()->setNumberUsed($item->getCity()->getNumberUsed() -1);
								// Suppression des relations des acqAssociés
								$rel = RelSituaTionAcq::loadByAcquereurAssos($pdo, $acq);
								if($rel)$rel->delete();

								$item->delete();
							}

							$acq->delete();
							Log::create($this->_pdo,time(),'acquereur','Suppression de l\'acquereur : '.$name,$this->_user);
							header('location:'.Tools::create_url($this->_user,'acquereur','list'));
						}
					};
				}

			}
		}
		if( isset($get['page'])&&$get['page']==='deleteAcqAssos' ){
			// load du truc à del
			$this->_title = 'Supprimer l\'acquereur';
			$this->_template =dirname(__FILE__).'/views/deleteAcqAssos.tpl';
			$acq = AcquereurAssocie::load($this->_pdo,$get['action']);

			$this->_smarty->assign('acq',$acq);
			if($acq!=null){
				if($this->_user->getLevelMember()->getIdLevelMember()<3||$this->_user->getIdUser() == $acq->getAcquereur()->getUser()->getIdUser()){
					if($post['cancel'])header('location:'.Tools::create_url($this->_user,'acquereur','see',$acq->getAcquereur()->getIdAcquereur() ));
					elseif($post['send']){

						if(empty($error)){
							// -1 aux utilisations du membre, et des villes

							$acq->getCity()->setNumberUsed( $acq->getCity()->getNumberUsed( ) -1 );

							$name = $acq->getName()." ".$acq->getFirstname();

							$rel = RelSituaTionAcq::loadByAcquereurAssos($this->_pdo, $acq);
							if($rel)$rel->delete();

							$acq->delete();
							Log::create($this->_pdo,time(),'acquereur','Suppression de l\'acquereur associé: '.$name,$this->_user);
							header('location:'.Tools::create_url($this->_user,'acquereur','see',$acq->getAcquereur()->getIdAcquereur() ));
						}
					};
				}

			}
		}
		// logs
		if( isset($get['page'])&&$get['page']==='logs' ){
			$this->_title = 'Logs du module';
			$this->_template =dirname(__FILE__).'/../tpl_default/log.tpl';
			$a = Log::selectByModule($this->_pdo,'acquereur');
			while($logs = Log::fetch($this->_pdo,$a)){
				$arrayLog[] = $logs;
				$this->_smarty->assign('arrayLog', $arrayLog );
			}
		}if(isset($get['page'])&&$get['page']==='listSit'){
			$this->_listSit();
		}if(isset($get['page'])&&$get['page']==='updateSit'){
			$error = $this->_updateSit($get,$post,$error);
		}if(isset($get['page'])&&$get['page']==='addSit'){
			$error = $this->_addSit($get,$post,$error);
		}
		if(isset($get['page'])&&$get['page']==='delSit'){
			$error = $this->_delSit($get,$post,$error);
		}

		$this->_smarty->assign('error',$error);
	}

	public function treatment( $post,$get){
		$this->_smarty->assign('user',$this->_user );
		if(!$this->_error_dependance){
			$this->_treatment( $post,$get);
		}
		// inclusion des modules enfants
		$this->include_modules_Children((String)dirname(__FILE__),$this->_smarty);
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

	private function _listSit(){
		$this->_title='Liste des situations de vie de l\'acquereur';
		$this->_template =dirname(__FILE__).'/views/listSit.tpl';
		$this->_smarty->assign('listSit', SituationAcquereur::loadAll($this->_pdo));
	}

	private function _updateSit($get,$post,$error){
		$situation = SituationAcquereur::load($this->_pdo, $get['action']);
		if(isset($post['cancel'])){
			header('location:'.Tools::create_url($this->_user,'acquereur','listSit'));
		}
		if(isset($post['go'])){
			// set de la situation
			$situation->setName($post['name'],false);
			$situation->setIfEventLocation($post['eventLocation'],false);
			$situation->setIfEventDate($post['eventDate'],false);
			if($situation->getName()=='') $error[]='La situation doit être renseignée !';

			if(empty($error)){
				$situation->update();
				Log::create($this->_pdo, time(), 'acquereur', 'Modification de la situation acquéreur : '.$situation->getName(), $this->_user) ;
				// si tout est ok; on update, log et redirection.
				header('location:'.Tools::create_url($this->_user,'acquereur','listSit'));
			}
		}
		$obj = array();
		$obj['name']= $situation->getName();
		$obj['eventLocation'] = $situation->getIfEventLocation();
		$obj['eventDate']=$situation->getIfEventDate();

		$this->_title='Modification de la situation : '.$situation->getName();
		$this->_template =dirname(__FILE__).'/views/addUpdSit.tpl';
		$this->_smarty->assign('obj',$obj);
        $this->_smarty->assign('add',false);
		return $error;
	}

	private function _addSit($get,$post,$error){
		if(isset($post['cancel'])){
			header('location:'.Tools::create_url($this->_user,'acquereur','listSit'));
		}
		if(isset($post['go'])){
			// verif
			if($post['name']=='') $error[]='La situation doit être renseignée !';
			if(empty($error)){
				$situation = SituationAcquereur::create($this->_pdo, $post['name'],$post['eventDate'],$post['eventLocation']);
				Log::create($this->_pdo, time(), 'acquereur', 'Ajout de la situation acquéreur : '.$situation->getName(), $this->_user) ;
				// si tout est ok; on update, log et redirection.
				header('location:'.Tools::create_url($this->_user,'acquereur','listSit'));
			}
		}
		$obj = array();
		$obj['name']= $post['name']?'':$post['name'];
		$obj['eventLocation'] = $post['eventLocation']?'':$post['eventLocation'];
		$obj['eventDate']=$post['eventDate']?'':$post['eventDate'];

		$this->_title='Ajout d\'une la situation : ';
		$this->_template =dirname(__FILE__).'/views/addUpdSit.tpl';
		$this->_smarty->assign('obj',$obj);
		$this->_smarty->assign('add',true);
		return $error;
	}
	private function _delSit($get,$post,$error){
		// var
		$situation = SituationAcquereur::load($this->_pdo, $get['action']);
		// treatment
		if(isset($post['cancel'])){
			header('location:'.Tools::create_url($this->_user,'acquereur','listSit'));
		}elseif(isset($post['go'])){
			// On regarde si la situation est présente dans la table rel
			if( RelSituaTionAcq::countBySituation($this->_pdo,$situation) !=0 ) $error[]="Impossible du supprimer la situation car au moins un acquereur l'utilise ";
			if(empty($error)){
				$n = $situation->getName();
				if($situation->delete() )
				Log::create($this->_pdo, time(), 'acquereur', 'Suppression de la situation acquéreur : '.$n, $this->_user) ;
				header('location:'.Tools::create_url($this->_user,'acquereur','listSit'));
			}
		}
		// assign

		$this->_title='Suppression de la situation : '.$situation->getName();
		$this->_template =dirname(__FILE__).'/views/delSit.tpl';
		$this->_smarty->assign('situation',$situation);
		return $error;
	}
}