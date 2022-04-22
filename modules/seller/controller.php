<?php
/**
 *
 *		/!\ Voir la méthode de suppression du vendeur une fois l'annonce
 *
 */
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
				Log::create($this->_pdo,time(),"seller",'accès non autorisé',$this->_user );
			} else{
				$this->_template = dirname(__FILE__).'/views/default.tpl';
				$this->_addMainMenu();
				$this->_addMenu('seller');
				$this->_title = 'Gestion des vendeurs';
			}
		}
	}
	public function addMeta(){
		$this->_smarty->assign('title',	$this->_title );
	}
	private function _treatment( $post,$get){
		// page par defaut (envoyé vers une fct)
		if(empty($get['page']))$get['page']='lists';
		$error =array();
		if(isset($get['page'])&&$get['page']=='add'){
			$this->_title = 'Ajouter un titre de vendeur';
			$this->_template = dirname(__FILE__).'/views/add_title.tpl';
			$error = array();
			if(isset($post['seller_add_title_submit'])){
				if($post['seller_add_title_name']=='') $error[]="Le titre de vendeur doit être renseigné !";
				if(empty($error)){
				SellerTitle::create($this->_pdo,$post['seller_add_title_name']);
				Log::create($this->_pdo,time(),'seller','Ajout du titre de vendeur : '.$post['seller_add_title_name'],$this->_user );
				header('location:'.$this->create_url($this->_user,$get['module'],'list'));
				}
				$this->_smarty->assign('error',$error);
			}
		}elseif(isset($get['page'])&&$get['page']=='list'){
			$this->_title = 'Liste des titres';
			$this->_template = dirname(__FILE__).'/views/list_title.tpl';
			$l = SellerTitle::loadAll($this->_pdo);
			$list = array();

			foreach($l as $item){
				$a['idSellerTitle'] = $item->getIdSellerTitle();
				$a['libel']=$item->getLibel();
				$a['urlUpdate'] = $this->create_url($this->_user,$get['module'],'update',$item->getIdSellerTitle());
				$a['urlDelete'] = $this->create_url($this->_user,$get['module'],'delete',$item->getIdSellerTitle());
				$list[] = $a;
			}
			$this->_smarty->assign('list',$list);
		}elseif(isset($get['page'])&&$get['page']=='update'){
			$this->_title = 'Modifier un titre de vendeur';
			$this->_template = dirname(__FILE__).'/views/update_title.tpl';
			$title = SellerTitle::load($this->_pdo,$get['action']);
			$this->_smarty->assign('seller_update_title_old_name',$title->getLibel());
			if(empty($post)){
				$this->_smarty->assign('seller_update_title_name',$title->getLibel());
			}else{
				$this->_smarty->assign('seller_update_title_name',$post['seller_update_title_name']);
			}
			$error = array();
			if(isset($post['seller_update_title_submit'])){
				if($post['seller_update_title_name']=='') $error[]="Le titre de vendeur doit être renseigné !";
				if(empty($error)){
				$title->setLibel($post['seller_update_title_name']);
				Log::create($this->_pdo,time(),'seller','Modification du titre de vendeur : '.$post['seller_update_title_old_name'].' en : '.$post['seller_update_title_name'],$this->_user );
				header('location:'.$this->create_url($this->_user,$get['module'],'list'));
				}
			}
		}elseif(isset($get['page'])&&$get['page']=='delete'){
			$sellerTitle = SellerTitle::load($this->_pdo,$get['action']);
			$seller  = Seller::load($this->_pdo,$get['action']);
			$this->_title = 'Supprimer le titre.';
			$this->_template =  dirname(__FILE__).'/views/delete_title.tpl';
			$this->_smarty->assign('sellerTitle',$sellerTitle);
			if(isset($post['cancel_seller_title'])){header('location:'.$this->create_url($this->_user,$get['module'],'list'));}
			if(isset($post['send_seller_title'])){
				if(Seller::count($this->_pdo,' WHERE sellerTitle_idSellerTitle='.$sellerTitle->getIdSellerTitle())>0){
					$error = Lang::ERROR_SELLER_TITLE_DELETE ;
				}
				if(empty($error)){
					$nameOfTitle = $sellerTitle->getLibel();
					$sellerTitle->delete();
					Log::create($this->_pdo,time(),'seller', 'Suppression du titre du vendeur : '.$nameOfTitle,$this->_user);
					header('location:'.$this->create_url($this->_user,$get['module'],'list'));
				}
			}
		}elseif(isset($get['page'])&&$get['page']=='adds'){
			$this->_title = 'Ajouter un vendeur';
			$this->_template = dirname(__FILE__).'/views/add_seller.tpl';
			$listTitle = SellerTitle::loadAll($this->_pdo);
			$listCity = City::loadAll($this->_pdo);
			if($this->_user->getLevelMember()->getIdLevelMember()<3)
			$this->_smarty->assign('listUser',User::loadAll($this->_pdo));
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
				$idUser = empty($post['seller_add_user'])?$this->_user->getIdUser():$post['seller_add_user'];
                if(($post['vitrine']==1 ) && $post['seller_add_email']==''){
                    $error[]='Pour creer un compte client sur votre site vitrine, le vendeur doit avoir une adresse email';
                }else{
                    // On regarde si l'url de la vitrine est bien renseigné.
                    // Chargement des paramètres du site export
                    $siteExport = SiteExport::load($this->_pdo,1);
                    $errorSiteExport="Pour créér un compte client sur le site vitrine, vous devez renseigner les paramètres du site vitrine.";
                    if($siteExport){
                        if($siteExport->getExportWebsiteUrl()=='')
                            $error[]=$errorSiteExport;
                    }else$error[]=$errorSiteExport;
                }

				if(empty($error)){
					$city = City::load($this->_pdo,$post['seller_add_list_city']);
					$u = User::load($this->_pdo,$idUser);
					$u->setNumberUsed( $u->getNumberUsed()+1);
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
					$post['seller_add_comment'],
					0,
					$city,
					SellerTitle::load($this->_pdo,$post['seller_add_list_title']),
					$u,
					1
					);
                    if($seller){
                        if($post['vitrine'] == 1 ){
                            // appel de la page de creation de compte via curl. on passe en parametre l'id du vendeur, son email son nom, son prenom
                            $url = $siteExport->getExportWebsiteUrl().'/curl/createSellerAccount.php';
                            $ch = curl_init($url);
                            curl_setopt($ch, CURLOPT_POST, 1);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, 'idseller='.$seller->getId().'&email='.$seller->getEmail().'&name='.$seller->getName().'&firstname='.$seller->getFirstname()
                                .'&userName='.$seller->getUser()->getName().'&userFirstname='.$seller->getUser()->getFirstname().'&userNumber='.$seller->getUser()->getCellPhone()
                            );
                            $result = curl_exec($ch);
                            curl_close($ch);
                            if($result=='done'){
                                $seller->setVitrine_account(1);
                            }

                        }

                    }

					header('location:'.$this->create_url($this->_user,$get['module']));

				}
			}
		}elseif(isset($get['page'])&&$get['page']=='lists'){
			$this->_title = 'Liste des vendeurs';
			$this->_template = dirname(__FILE__).'/views/list_seller.tpl';
			$list = array();
			$sel = empty($post['seeAsset'])?Seller::loadAll($this->_pdo):Seller::loadAll($this->_pdo);
			//			foreach (Seller::loadAll($this->_pdo) as $l){
			//			foreach (Seller::loadAllAsset($this->_pdo) as $l){
			//			foreach (Seller::loadAllNotAsset($this->_pdo) as $l){
			foreach ($sel as $l){
				$tmp['id'] = $l->getIdSeller();
				$tmp['name']= $l->getName().' '.$l->getFirstname();
				$tmp['title'] = $l->getSellerTitle()->getLibel();
				$tmp['idUser'] = $l->getUser()->getIdUser();
				$tmp['user']= $l->getUser()->getFirstname().' '.$l->getUser()->getName();
				$tmp['phone']['phone'] = $l->getPhone();
				$tmp['phone']['mobilPhone'] = $l->getMobilPhone();
				$tmp['phone']['workPhone'] = $l->getWorkPhone();
				$tmp['email'] = $l->getEmail();
                $tmp['asset']=$l->getAsset();
				$tmp['urlUpdate'] = Tools::create_url($this->_user,$get['module'],'updates',$l->getIdSeller());
				$tmp['urlDelete'] = Tools::create_url($this->_user,$get['module'],'deletes',$l->getIdSeller());
				$tmp['urlSee'] = Tools::create_url($this->_user,$get['module'],'sees',$l->getIdSeller());
				$list[] = $tmp;
			}
			$this->_smarty->assign('list',$list);
		}elseif(isset($get['page'])&&$get['page']=='updates'){
			$this->_title = 'Modification d\'un vendeur';
			$this->_template = dirname(__FILE__).'/views/update_seller.tpl';
			//Chargement les listes
			$listTitle = SellerTitle::loadAll($this->_pdo);
			$listCity = City::loadAll($this->_pdo);
			if($this->_user->getLevelMember()->getIdLevelMember()<3)
			$this->_smarty->assign('listUser',User::loadAll($this->_pdo));
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
			// var
			$seller = Seller::load($this->_pdo,$get['action']);
			if(empty($post)){
				$seller_update_user = $seller->getUser()->getIdUser();
				$seller_update_list_title = $seller->getSellerTitle()->getIdSellerTitle();
				$seller_update_name = $seller->getName();
				$seller_update_firstname = $seller->getFirstname();
				$seller_update_address= $seller->getAddress();
				$seller_update_phone= $seller->getPhone();
				$seller_update_mobil_phone= $seller->getMobilPhone();
				$seller_update_work_phone= $seller->getWorkPhone();
				$seller_update_fax= $seller->getFax();
				$seller_update_email= $seller->getEmail();
				$seller_update_comment= $seller->getComments();
				$seller_update_list_city = $seller->getCity()->getIdCity();
                $vitrine = $seller->getVitrine_account();
			}else{
				$seller_update_user = $post['seller_update_user'];
				$seller_update_list_title = $post['seller_update_list_title'];
				$seller_update_name = $post['seller_update_name'];
				$seller_update_firstname =$post['seller_update_firstname'];
				$seller_update_address= $post['seller_update_address'];
				$seller_update_phone= $post['seller_update_phone'];
				$seller_update_mobil_phone= $post['seller_update_mobil_phone'];
				$seller_update_work_phone= $post['seller_update_work_phone'];
				$seller_update_fax= $post['seller_update_fax'];
				$seller_update_email= $post['seller_update_email'];
				$seller_update_comment= $post['seller_update_comment'];
				$seller_update_list_city = $post['seller_update_list_city'];
                $vitrine = $post['vitrine'];
				if(isset($post['seller_update_submit_send'])){
					if(empty($post['seller_update_name']))$error[]= Lang::ERROR_SELLER_ADD_EMPTY_NAME;
					if(!empty($post['seller_update_email'])&&!Tools::isEmail($post['seller_update_email']))
					$error[]= Lang::ERROR_SELLER_ADD_BAD_FORMAT_EMAIL;
                    if(($post['vitrine']==1 ) && $post['seller_update_email']==''){
                        $error[]='Pour creer un compte client sur votre site vitrine, le vendeur doit avoir une adresse email';
                    }else{
                        // On regarde si l'url de la vitrine est bien renseigné.
                        // Chargement des paramètres du site export
                        $siteExport = SiteExport::load($this->_pdo,1);
                        $errorSiteExport="Pour créér un compte client sur le site vitrine, vous devez renseigner les paramètres du site vitrine.";
                        if($siteExport){
                            if($siteExport->getExportWebsiteUrl()=='')
                                $error[]=$errorSiteExport;
                        }else $error[]=$errorSiteExport;
                    }
					if(empty($error)){
						if(!empty($post['seller_update_user'])){
							$u =User::load($this->_pdo,$post['seller_update_user']);
							$u->setNumberUsed( $u->getNumberUsed()-1 );
							$seller->setUser($u);
							$u->setNumberUsed( $u->getNumberUsed()+1 );
						}
						$seller->setName($post['seller_update_name'],false);
						$seller->setFirstname($post['seller_update_firstname'],false);
						$seller->setAddress($post['seller_update_address'],false);
						$seller->setPhone($post['seller_update_phone'],false);
						$seller->setMobilPhone($post['seller_update_mobil_phone'],false);
						$seller->setWorkPhone($post['seller_update_work_phone'],false);
						$seller->setFax( $post['seller_update_fax'],false);
						$seller->setEmail($post['seller_update_email'],false);
						$seller->setComments($post['seller_update_comment'],false);
						$seller->setSellerTitle(SellerTitle::load($this->_pdo,$post['seller_update_list_title']),false);
						$c =City::load($this->_pdo,$post['seller_update_list_city']);

						if($c->getIdCity() == $post['seller_update_list_city']){
							$seller->getCity()->setNumberUsed( $seller->getCity()->getNumberUsed() -1);
							$seller->setCity($c);
							$seller->getCity()->setNumberUsed( $seller->getCity()->getNumberUsed() + 1);
						}

                        // Gestion des comptes clients...
                        if(!$seller->getVitrine_account() && $vitrine==1){
                            // appel de la page de creation de compte via curl. on passe en parametre l'id du vendeur, son email son nom, son prenom
                            $url = $siteExport->getExportWebsiteUrl().'/curl/createSellerAccount.php';
                            $ch = curl_init($url);
                            curl_setopt($ch, CURLOPT_POST, 1);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, 'idseller='.$seller->getId().'&email='.$seller->getEmail().'&name='.$seller->getName().'&firstname='.$seller->getFirstname()
                                .'&userName='.$seller->getUser()->getName().'&userFirstname='.$seller->getUser()->getFirstname().'&userNumber='.$seller->getUser()->getCellPhone()
                            );
                            $result = curl_exec($ch);

                            curl_close($ch);
                            if($result=='done'){
                                $seller->setVitrine_account(1);
                            }

                        }
                        elseif($seller->getVitrine_account() && $vitrine!=1){

                            // appel de la page de suppression de compte via curl. on passe en parametre l'id du vendeur
                            $url = $siteExport->getExportWebsiteUrl().'/curl/deleteSellerAccount.php';
                            $ch = curl_init($url);
                            curl_setopt($ch, CURLOPT_POST, 1);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, 'idseller='.$seller->getId());
                            $result = curl_exec($ch);
                            var_dump($result);
                            curl_close($ch);
                            if($result=='done'){
                                $seller->setVitrine_account(0);
                            }
                        }

						$seller->update();
						Log::create($this->_pdo,time(),'seller','Mise à jour du vendeur : '.$seller->getName(),$this->_user);
						header('location:'.$this->create_url($this->_user,$get['module'],'lists'));
					}
				}
			}

			$this->_smarty->assign('seller_update_user',$seller_update_user);
			$this->_smarty->assign('seller_update_list_title',$seller_update_list_title);
			$this->_smarty->assign('seller_update_name',$seller_update_name);
			$this->_smarty->assign('seller_update_firstname',$seller_update_firstname);
			$this->_smarty->assign('seller_update_address',$seller_update_address);
			$this->_smarty->assign('seller_update_phone',$seller_update_phone);
			$this->_smarty->assign('seller_update_mobil_phone',$seller_update_mobil_phone);
			$this->_smarty->assign('seller_update_work_phone',$seller_update_work_phone);
			$this->_smarty->assign('seller_update_fax',$seller_update_fax);
			$this->_smarty->assign('seller_update_email',$seller_update_email);
			$this->_smarty->assign('seller_update_comment',$seller_update_comment);
			$this->_smarty->assign('seller_update_list_city',$seller_update_list_city);
            $this->_smarty->assign('vitrine',$vitrine);

		}
		elseif(isset($get['page'])&&$get['page']=='deletes'){
			// Verif pas utilisé par une annonce //
			$this->_title = 'Suppression d\'un vendeur';
			$this->_template = dirname(__FILE__).'/views/delete_seller.tpl';
			$seller = Seller::load($this->_pdo,$get['action']);
			$error = array();
			$this->_smarty->assign('seller',$seller);
			if(isset($post['cancel_seller']))
			header('location:'.$this->create_url($this->_user,$get['module'],'lists'));
			if(isset($post['send_seller'])){
				if($seller->getNumberUsed()>0)
				$error='Impossible de supprimer ce vendeur car il est utilisé.';
				if(empty($error)){
					$name = $seller->getName();
					// - 1 à l'utilisation de la ville et de l'utilisateur
					$seller->getUser()->setNumberUsed( $seller->getUser()->getNumberUsed()-1 );
					$seller->getCity()->setNumberUsed($seller->getCity()->getNumberUsed( ) -1);
					$seller->delete();
					Log::create($this->_pdo,time(),'seller','Suppression du vendeur : '.$name,$this->_user);
					header('location:'.$this->create_url($this->_user,$get['module'],'lists'));
				}
			}
		}
		elseif(isset($get['page'])&&$get['page']=='sees'){
			$this->_title = 'Fiche du vendeur';
			$this->_template = dirname(__FILE__).'/views/see_seller.tpl';
			$seller = Seller::load($this->_pdo,$get['action']);
			$this->_smarty->assign('urlUpdate',$this->create_url($this->_user,$get['module'],'updates',$seller->getIdSeller()));
			$this->_smarty->assign('urlDelete',$this->create_url($this->_user,$get['module'],'deletes',$seller->getIdSeller()));
			$this->_smarty->assign('seller',$seller);

		}
		elseif(isset($get['page'])&&$get['page']=='log'){
			$this->_title = 'logs du module vendeur';
			$this->_template =dirname(__FILE__).'/views/log.tpl';
			$a = Log::selectByModule($this->_pdo,'seller');
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
		$this->_smarty->assign('mainMenu',$this->getMainMenu($this->_user ));
	}
	private function _addMenu($module){
		$this->_smarty->assign('menu',$this->getMenu($this->_user ,$module ) );
	}
}