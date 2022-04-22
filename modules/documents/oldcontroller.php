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
			//			if($this->getLevelRequired($_GET['module'],$_GET['page'],$_GET['action']) < $this->_user->getLevelMember()->getIdLevelMember()){
			//				$this->_error_dependance = true;
			//				$this->_template = $this->getTplErrorViolationAccess();
			//				Log::create($this->_pdo,time(),"sector",'accès non autorisé',$this->_user )
			//			} else{
			$this->_template = dirname(__FILE__).'/views/default.tpl';
			$this->_addMainMenu();
			$this->_addMenu('documents');
			//				$this->_title = 'Gestion des secteurs / villes';
			//			}
		}
	}

	public function addMeta(){
		$this->_smarty->assign('title',	$this->_title );
	}
	private function _treatment( $post,$get){
		if(isset($get['page'])&&$get['page']=='bonVisite'){
			// récupération de la liste des bien à visiter pour cet acquereur.
			// load de l'acq
			$acq = Acquereur::load($this->_pdo, $get['action']);
			$listMandate = Rapprochement::listMandateForAcq( $this->_pdo, $acq );

			// suppression des pas interessant
			$mandats = array();
			foreach($listMandate as $l){
				$item = BddRapprochement::loadByMandateAndAcquereur($this->_pdo, $l, $acq);
				
				//var_dump($item);
				if($item){
					// on verifie s'il est rapproché, et si on peut imprimer le bon de visite.
					if($item->getResultatVisite()==0&&$item->getDateVisite()){
						
						if( date('Ymd',$item->getDateVisite())>= date('Ymd')){
							
							$tmp= array(
						'numberMandate' => $l->getNumberMandate(),
						'address'=>$l->getAddress(),
						'zipCode'=>$l->getCity()->getZipCode(),
						'city'=>$l->getCity()->getName(),
						'priceFAI'=>$l->getPriceFai(),
						'dateVisite'=> $item->getDateVisite()
							);
							$mandats[]=$tmp;
						}
						//var_dump($l);
					}
				}
			}
			
			// tri du tableau par date
			$mandats = Tools::sort_by_key($mandats, 'dateVisite'); 
			
			// Affichage du bon de visite (Pdf)
			// Récupération de l'agence de l'acq
			// Si l'agence est montauban, utilisdation du logo d'escalterrain.


			$fpdf = new  PDFBis();
			// style à utiliser : <u>à souligner</u> sougnera l'interieur des balises
			$fpdf->SetStyle("u","times","u",$size,"0,0,0");
			$fpdf->SetStyle("i","times","i",$size,"0,0,0");
			$fpdf->SetStyle("b","times","b",$size,"0,0,0");
			$fpdf->SetStyle("bi","times","bi",$size,"0,0,0");
			$fpdf->SetStyle("bu","times","bu",$size,"0,0,0");
			$fpdf->SetStyle("iu","times","iu",$size,"0,0,0");
			$fpdf->SetStyle("biu","times","biu",$size,"0,0,0");
			$fpdf->SetStyle("h1","times","",20,"0,0,0");
			$fpdf->SetStyle("rouge","times","",$size,"255,0,0");
			$fpdf->SetFont('Times','',12);
			//	$fpdf->SetTopMargin(63.5);
			
			// date par defaut, (déclanche l'ajout d'une nouvelle page
			$dateByDefault = '0000000000';
			$one = true;
			$inBoucle = false;
			if(empty($mandats)){
				$fpdf->AddPage();
			}
			foreach($mandats as $ma){
				$inBoucle = true;
				if($ma['dateVisite']!=$dateByDefault){
					if($one){
						$one = false;
					}else{
						$fpdf->SetFont('Times','',12);
						$fpdf->ln();
						$fpdf->MultiCellTag(0 ,5,utf8_decode('<b>En conséquence, nous nous engageons expressément :</b>' ) ,0);
						$fpdf->ln();
						$fpdf->MultiCellTag(0 ,5,utf8_decode('- à ne communiquer à personne ces renseignements qui nous sont donnés à titre personnel et confidentiel ;' ) ,0);
						$fpdf->MultiCellTag(0 ,5,utf8_decode('- à informer de notre visite de ce jour toute personne qui pourrait à l\'avenir nous présenter le même bien ;' ) ,0);
						$fpdf->MultiCellTag(0 ,5,utf8_decode('- à nous interdire toute entente avec le vendeur ayant pour conséquence de vous évincer lors de l\'achat de cette affaire.' ) ,0);
						$fpdf->ln();
						$fpdf->MultiCellTag(0 ,5,utf8_decode('<b>En cas de violation de nos engagements ci-dessus, nous nous rendrons passibles de dommages et intérêts en réparation du préjudice que nous vous aurons causé.</b>' ) ,0);
						$fpdf->ln();
						$fpdf->MultiCellTag(0 ,5,utf8_decode('Fait pour une durée de 15 mois à compter de ce jour.' ) ,0);
						$fpdf->MultiCellTag(0 ,5,utf8_decode('En deux exemplaires, dont un remis aux visiteurs qui le reconnaissent et en donnent décharge à l\'accompagnateur qui accepte et signe.' ) ,0);
						$fpdf->ln();
						$fpdf->Cell(50,5,'SIGNATURE DES VISITEURS');
						$fpdf->Cell(35,5,'');
						$fpdf->Cell(0,5,'SIGNATURE DE L\'ACCOMPAGNATEUR');
						$fpdf->ln();
						$fpdf->Cell(50,5,utf8_decode('<< Lu et approuvé >>'),0,0,'C');
						
					}
					$dateByDefault = $ma['dateVisite'];
			$fpdf->AddPage();
			
			
			$ag = $acq->getUser()->getAgency();
			$logo =$ag->getLogoCourrier() ? Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY.'user/'.$ag->getLogoCourrier() : Constant::DEFAULT_URL_PICTURE_DIRECTORY.'logo.jpg' ;
			$fpdf->Image( $logo ,null,null,0,0,'jpg' );
			$fpdf->ln(15);
			$fpdf->SetLeftMargin(25);
			$fpdf->Cell(70 ,10,'' ,0);
			$fpdf->Cell(0 ,10,$acq->getUser()->getAgency()->getName().', le '.date('d/m/Y', $ma['dateVisite']),0);
			$fpdf->ln(10);
			$fpdf->Cell(70 ,10,'' ,0);
			$fpdf->MultiCellTag(0 ,5,utf8_decode('<b>Nous sousignés,</b>'),0);

			$fpdf->Cell(70 ,10,'' ,0);
			$fpdf->MultiCellTag(0 ,5,utf8_decode('<b>'.$acq->getTitreAcquereur()->getName().' '. $acq->getName().' '.$acq->getFirstname().'</b>' ) ,0);
			$fpdf->Cell(70 ,10,'' ,0);
			$fpdf->MultiCellTag(0 ,5,utf8_decode($acq->getAddress()."\n".$acq->getVilleAcquereur()->getZipCode().' '.$acq->getVilleAcquereur()->getName() ) ,0);
			
			$fpdf->Cell(70 ,10,'' ,0);
			$fpdf->Cell(70 ,10,utf8_decode('agissant en qualité d\'Acquereur(s) éventuel(s),') ,0);
			$fpdf->ln(16);
			$fpdf->MultiCellTag(0 ,5,utf8_decode('Reconnaissons : avoir demandé et reçu à l\'instant de votre Agence, les noms, adresses et conditions de vente des affaires désignées ci-dessous, et les avoir visitées en votre compagnie.' ) ,0);
			$fpdf->ln(12);
			$fpdf->MultiCellTag(0 ,5,utf8_decode( '<h1>Liste des Affaires Présentées :</h1>' ) ,0);
			$fpdf->ln(8);
			// tableau à poser.
			$fpdf->SetFont('Times','',10);
		}
			
				$fpdf->SetWidths(array(15,60,15,30,30,20));
				$fpdf->SetAligns(array('C','C','C','C','C','C'));
				$fpdf->Row(array(
				$ma['numberMandate'],
				utf8_decode($ma['address']),
				$ma['zipCode'],
				utf8_decode($ma['city']),
				Tools::grosNombre(round($ma['priceFAI'],0)).' '.chr(128),
				date(Constant::DATE_FORMAT2 ,$ma['dateVisite'])
				));


			}
			if($inBoucle){
			$fpdf->SetFont('Times','',12);
			$fpdf->ln();
			$fpdf->MultiCellTag(0 ,5,utf8_decode('<b>En conséquence, nous nous engageons expressément :</b>' ) ,0);
			$fpdf->ln();
			$fpdf->MultiCellTag(0 ,5,utf8_decode('- à ne communiquer à personne ces renseignements qui nous sont donnés à titre personnel et confidentiel ;' ) ,0);
			$fpdf->MultiCellTag(0 ,5,utf8_decode('- à informer de notre visite de ce jour toute personne qui pourrait à l\'avenir nous présenter le même bien ;' ) ,0);
			$fpdf->MultiCellTag(0 ,5,utf8_decode('- à nous interdire toute entente avec le vendeur ayant pour conséquence de vous évincer lors de l\'achat de cette affaire.' ) ,0);
			$fpdf->ln();
			$fpdf->MultiCellTag(0 ,5,utf8_decode('<b>En cas de violation de nos engagements ci-dessus, nous nous rendrons passibles de dommages et intérêts en réparation du préjudice que nous vous aurons causé.</b>' ) ,0);
			$fpdf->ln();
			$fpdf->MultiCellTag(0 ,5,utf8_decode('Fait pour une durée de 15 mois à compter de ce jour.' ) ,0);
			$fpdf->MultiCellTag(0 ,5,utf8_decode('En deux exemplaires, dont un remis aux visiteurs qui le reconnaissent et en donnent décharge à l\'accompagnateur qui accepte et signe.' ) ,0);
			$fpdf->ln();
			$fpdf->Cell(50,5,'SIGNATURE DES VISITEURS');
			$fpdf->Cell(35,5,'');
			$fpdf->Cell(0,5,'SIGNATURE DE L\'ACCOMPAGNATEUR');
			$fpdf->ln();
			$fpdf->Cell(50,5,utf8_decode('<< Lu et approuvé >>'),0,0,'C');
			}
			$fpdf->Output();

		}elseif(isset($get['page'])&&$get['page']=='resVisite'){

			$acq = Acquereur::load($this->_pdo, $get['action']);
			$mandate = Mandate::load($this->_pdo, $get['action2']);
			$seller = $mandate->getDefaultSeller();

			$rapp = BddRapprochement::loadByMandateAndAcquereur($this->_pdo, $mandate, $acq);

			$doc = Documents::load($this->_pdo,12);
			if($doc==null){

				$doc = Documents::createId($this->_pdo, 12);
				$doc->setOther(
'Votre conseiller(e),
[prenomDemarcheur] [nomDemarcheur]'
				,false);
				$doc->setSizetext(12,false);
				$doc->setCorps(
"
[bu]Bien situé au :[/bu]
                 [adresseBien]
                 [cpBien] [villeBien]

[b]N° Mandat : [numeroMandat][/b]
 
[b][titreVendeur] [nomVendeur] [prenomVendeur][/b],
				
Nous avons le plaisir de vous informer que votre [b][typeBien][/b] [i] a été visité le [dateVisite][/i] par
				     
[civiliteAcquereur] [nomAcquereur] [prenomAcquereur]
				     
en présence de [prenomDemarcheur] [nomDemarcheur].
				     
[bu]A l'issue de cette visite leur impression est la suivante : [/bu]
	 
[compteRenduVisite]	 
	 
	 Nous restons à votre entière disposition pour vous donner tous les renseignements complementaires que vous voudrez bien recevoir.
	 
	 Et, nous vous rappelons que nous continuons à nous occuper de votre affaire aux mieux de vos intérêts.
	 
Salutation dévouées."
				
				,false);
				$doc->update();
					
			}


			$signature = $this->_replace($doc->getOther(),$mandate);
			$corps = $this->_replace($doc->getCorps(),$mandate);


			$entete['civilite'] =  $seller->getSellerTitle()->getLibel();
			$entete['prenom']= $seller->getFirstName();
			$entete['nom']= $seller->getName();
			$entete['adresse']= $seller->getAddress();
			$entete['cp']= $seller->getCity()->getZipCode();
			$entete['ville']= $seller->getCity()->getName();
			$entete['villeAgence']=$this->_user->getAgency()->getName();
			$entete['date']= date('d/m/Y');
			$size = $doc->getSizetext();


			if(empty($post)){
				$this->_title = 'Retour visite';
					


				$this->_template = dirname(__FILE__).'/views/pre_gen.tpl';

				$this->_smarty->assign('dateDoc',date(Constant::DATE_FORMAT2) );
				$this->_smarty->assign('sizeTypo',$doc->getSizetext() );
				$this->_smarty->assign('corps',$this->_replace($doc->getCorps() ,$mandate,$acq));

				$this->_smarty->assign('signature',$this->_replace($doc->getOther(),$mandate) );
				$this->_smarty->assign('h1',$this->_title );
			}else{
				$corps = $post['corps'];
				$signature = $post['signature'];
				$size = $post['size'];
				$this->_courrierDefaut($entete,$corps,$signature,$size);
			}


			//var_dump($rapp);

		}elseif(isset($get['page'])&&$get['page']=='genListTerrain'){
			$listOfMandate = myMandate::loadAll($this->_pdo);
			// Utiliser une classe spéciale en ajoutant une entete (Logo au centre, date du jour dessous)
			$fpdf = new PDF();
			//echo Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY.'user/'.$this->_user->getAgency()->getLogoAfficheTerrain();
			$fpdf->setLogo(Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY.'user/'.$this->_user->getAgency()->getLogoAfficheTerrain()  );
			$fpdf->AddFont('MonotypeCorsiva','','mtcorsva.php');
			$fpdf->AliasNbPages();
			$fpdf->AddPage('L');

			$fpdf->SetFont('Arial','',6);
			// test
			foreach($listOfMandate as $m){

				$fpdf->SetWidths(array(12,12,29,15,18,18,15,22,20,17,10,10,14,67));
				$fpdf->SetAligns(array('C','C','C','C','C','C','C','C','C','C','C','C','C'));
				$fpdf->Row(array(
				utf8_decode( $m->getNumberMandate() ),
				utf8_decode($m->getCity()->getZipCode() ),
				utf8_decode($m->getCity()->getName() ),
				utf8_decode( Tools::grosNombre(round($m->getPriceFai(),0))).' '.chr(128) ,
				utf8_decode($m->getSuperficieTotale()==0?'NC':$m->getSuperficieTotale() ),
				utf8_decode($m->getBornageTerrain()==null?'NC':$m->getBornageTerrain()->getName() ),
				utf8_decode($m->getSHONAccordee()==0?'NC':$m->getSHONAccordee() ),
				// Ou fosse sceptique
				utf8_decode(
				// Si tout à l'égout ET assainissement = 0 NC
				$m->getToutALegout()==0&&$m->getAssainissementParFosseSceptique()==0?'NC':($m->getToutALegout()==0?'Assainissement par fosse sceptique':'Tout à l\'égout.')
				// sinon si tout à l'égout = 0, on affiche assainissementsinon on affiche tout à l'égout
				),
				utf8_decode($m->getTerrainVenduViabilise()==0&&$m->getTerrainVenduSemiViabilise()==0&$m->getTerrainVenduNonViabilise()==0?'NC':($m->getTerrainVenduViabilise()==1?'Viabilisé':($m->getTerrainVenduSemiViabilise()==1?'Semi viabilisé':'non viabilisé'   ))),
				utf8_decode($m->getOrientation()==null?'NC':$m->getOrientation()->getName()),
				utf8_decode($m->getSlope()==null?'NC':$m->getSlope()->getName()),
				utf8_decode($m->getTailleFacade()==0?'NC':$m->getTailleFacade()),
				utf8_decode($m->getProfondeurTerrain()==0?'NC':$m->getProfondeurTerrain()),
				utf8_decode( $m->getPubInternet() )
				));

				/*
				 $fpdf->ln(10);
				$fpdf->Cell(20,10,utf8_decode( $m->getNumberMandate() ),1,0,'C');
				$fpdf->Cell(20,10,utf8_decode($m->getCity()->getZipCode() ),1,0,'C');
				$fpdf->Cell(20,10,utf8_decode($m->getCity()->getName() ),1,0,'C');
				$fpdf->Cell(20,10,utf8_decode( Tools::grosNombre(round($m->getPriceFai(),0))).' '.chr(128) ,1,0,'C');
				$fpdf->Cell(20,10,utf8_decode($m->getSuperficieTotale()==0?'NC':$m->getSuperficieTotale() ),1,0,'C');
				$fpdf->Cell(19,10,utf8_decode($m->getBornageTerrain()==null?'NC':$m->getBornageTerrain()->getName() ),1,0,'C');
				$fpdf->Cell(22,10,utf8_decode($m->getSHONAccordee()==0?'Non':'Oui' ),1,0,'C');
				// Ou fosse sceptique
				$fpdf->Cell(19,10,utf8_decode($m->getToutALegout() ),1,0,'C');
				$fpdf->Cell(20,10,utf8_decode('Terrain vendu'),1,0,'C');
				$fpdf->Cell(20,10,utf8_decode($m->getOrientation()==null?'NC':$m->getOrientation()->getName()),1,0,'C');
				$fpdf->Cell(20,10,utf8_decode($m->getSlope()==null?'NC':$m->getSlope()->getName()),1,0,'C');
				$fpdf->Cell(20,10,utf8_decode($m->getTailleFacade()==0?'NC':$m->getTailleFacade()),1,0,'C');
				$fpdf->Cell(20,10,utf8_decode($m->getProfondeurTerrain()==0?'NC':$m->getProfondeurTerrain()),1,0,'C');
				$fpdf->Cell(20,10,utf8_decode( $m->getCommentaireApparent() ),1,0,'C');
				*/
			}
			// fin test
			// final
			//$fpdf->Output('Liste des terrains le '.date('d-m-Y').'.pdf','D');
			$fpdf->Output();

			//			var_dump($listOfMandate);
		}if(isset($get['page'])&&$get['page']=='afficheTerrain'){
			$mandate = Mandate::load($this->_pdo,$get['action']);
			if(empty($post)){
				$this->_template = dirname(__FILE__).'/views/pre_affiche.tpl';
				$this->_title="Affiche classique";
				$this->_smarty->assign('ville',$mandate->getCity()->getName());
				$this->_smarty->assign('secteur',$mandate->getCity()->getSector()->getName());

				$this->_smarty->assign('corps',$mandate->getCommentaireApparent());

				// appel du stript de modification/confirmation...
			}else{

				$fpdf = new FPDF();
				$fpdf->AddFont('MonotypeCorsiva','','mtcorsva.php');
				$fpdf->AddPage();
				if($mandate->getUser()->getAgency()->getLogoAfficheTerrain()!=''){
					$fpdf->Image(Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY.'user/'.$mandate->getUser()->getAgency()->getLogoAfficheTerrain(),0,0,210);
				}
				$fpdf->Ln(50);
				$fpdf->SetFont('MonotypeCorsiva','',40);
				if($post['villeSecteur']=="ville"){
					$fpdf->Cell(0,25,$mandate->getCity()->getName() ,0,1,'C');
				}else{
					$fpdf->Cell(0,25,$mandate->getCity()->getSector()->getName() ,0,1,'C');
				}
				$fpdf->ln(5);
				$fpdf->SetLeftMargin(37);
				$fpdf->SetRightMargin(34);
				if( $mandate->getPictureByDefault() )
				$fpdf->Image( Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY.'terrain/'.$mandate->getPictureByDefault()->getName(),null,null,136,102,'jpg' );
				$fpdf->ln(8);
				$fpdf->SetFont('MonotypeCorsiva','',20);
				$fpdf->write(6,utf8_decode( $post['corps']==''?'':$post['corps']));
				$fpdf->ln(15);
				$fpdf->SetLineWidth(0.5);
				$fpdf->SetFont('MonotypeCorsiva','',25);
				$fpdf->Cell(136,13.5,utf8_decode('Prix : '.str_replace('.00','',$mandate->getPriceFai()==null?'NC':Tools::grosNombre($mandate->getPriceFai()))).chr(128),'LTR',1,'C');
				$fpdf->Cell(136,13.5,utf8_decode("Frais d'agence inclus"),'LRB',1,'C');
				$fpdf->SetLineWidth(1);
				$fpdf->Line(37, 90, 173, 90);
				$fpdf->Line(37, 192, 173, 192);
				$fpdf->Line(173, 90, 173, 192);
				$fpdf->Line(37, 90, 37, 192);
				$fpdf->Output();
			}
		}if(isset($get['page'])&&$get['page']=='ficheCriteresAcquereur'){
			// load de l'acq
			$acq=  Acquereur::load($this->_pdo, $get['action']);
			if($acq){
				// generation du document
				$this->_title="Fiche acquereur";
				$fpdf = new FPDF();
				$fpdf->SetFont('times','BU',25);
				$fpdf->AddPage();
				$fpdf->Cell(0,10,'FICHE ACQUEREUR',0,1,'C');
				$fpdf->Ln(20);
				$fpdf->SetFont('times','B',25);
				$fpdf->Cell(0,10,'ETAT CIVIL',0,1);
				$fpdf->SetFont('times','',12);
				$y = $fpdf->GetY();
				$txt = $acq->getTitreAcquereur()->getName().' '.$acq->getName().' '.$acq->getFirstname()."\n".$acq->getAddress()."\n".$acq->getVilleAcquereur()->getZipCode().' '.$acq->getVilleAcquereur()->getName();
				$fpdf->MultiCell(90, 5,utf8_decode(Tools::replaceSpecialCharByIso($txt)),'TL');
				$$y = $fpdf->GetY();
				$fpdf->SetY( $y );
				$fpdf->SetX(105);
				$txt = "Tél Perso : ".($acq->getPhone()==''?'NC':$acq->getPhone())."\nTél portable : ".($acq->getMobilPhone()==''?'NC':$acq->getMobilPhone())."\nTél travail : "
				.($acq->getWorkPhone()==''?'NC':$acq->getWorkPhone())."\nFax : ".($acq->getFax()==''?'NC':$acq->getFax())."\nEmail : ".($acq->getEmail()==''?'NC':$acq->getEmail());
				$fpdf->MultiCell(95, 5,
				utf8_decode(Tools::replaceSpecialCharByIso($txt))
				,'TL');
				if($$y > $fpdf->GetY() )
				$fpdf->SetY( $$y );
				// NEXT
				$fpdf->Ln(15);
				$fpdf->SetFont('times','B',25);
				$fpdf->Cell(0,10,'CRITERES DE RECHERCHE',0,1);
				$fpdf->SetFont('times','',12);
				$txt ='Type de transaction : '.($acq->getTransactionType()->getId()==Constant::ID_TRANSACTION_TYPE_SELLER?'Achat':$acq->getTransactionType()->getName())."\nType : ".$acq->getMandateType()->getName();
				$txt.="\nStyle : ".( $acq->getMandateStyle()==null?'NC':$acq->getMandateStyle()->getName() );
				$txt.="\nPrix : ";
				if($acq->getPriceMin()==0 && $acq->getPriceMax()==0)
				$txt .='NC';
				elseif($acq->getPriceMin()>0 && $acq->getPriceMax()==0)
				$txt.='supérieur à '.Tools::grosNombre($acq->getPriceMin()).' €';
				elseif($acq->getPriceMin()==0 && $acq->getPriceMax()>0)
				$txt.='inférieur à '.Tools::grosNombre($acq->getPriceMax()).' €';
				else
				$txt.='de '.Tools::grosNombre($acq->getPriceMin()).' € à '.Tools::grosNombre($acq->getPriceMax()).' €';
				$txt.="\nSurface terrain : ";
				if($acq->getSurfaceTerrainMin()==0 && $acq->getSurfaceTerrainMax()==0)
				$txt .='NC';
				elseif($acq->getSurfaceTerrainMin()>0 && $acq->getSurfaceTerrainMax()==0)
				$txt.='supérieur à '.$acq->getSurfaceTerrainMin().' m²';
				elseif($acq->getSurfaceTerrainMin()==0 && $acq->getSurfaceTerrainMax()>0)
				$txt.='inférieur à '.$acq->getSurfaceTerrainMax().' m²';
				else
				$txt.='de '.$acq->getSurfaceTerrainMin().' m² à '.$acq->getSurfaceTerrainMax().' m²';

				$txt.="\nSurface habitable : ";
				if($acq->getSurfaceHabitableMin()==0 && $acq->getSurfaceHabitableMax()==0)
				$txt .='NC';
				elseif($acq->getSurfaceHabitableMin()>0 && $acq->getSurfaceHabitableMax()==0)
				$txt.='supérieur à '.$acq->getSurfaceHabitableMin().' m²';
				elseif($acq->getSurfaceHabitableMin()==0 && $acq->getSurfaceHabitableMax()>0)
				$txt.='inférieur à '.$acq->getSurfaceHabitableMax().' m²';
				else
				$txt.='de '.$acq->getSurfaceHabitableMin().' m² à '.$acq->getSurfaceHabitableMax().' m²';
				$txt.="\nSecteur : ".($acq->getRechercheSector()==null?'Indifferent':$acq->getRechercheSector()->getName());
				$txt.="\nVille : ".($acq->getRechercheCity()==null?'Indifferent':$acq->getRechercheCity()->getName());
				$fpdf->MultiCell(0, 5,  utf8_decode(Tools::replaceSpecialCharByIso($txt)),'TL');
				// Commentaire (s'il existe)
				if($acq->getComment()!=''){
					$fpdf->Ln(15);
					$fpdf->SetFont('times','B',25);
					$fpdf->Cell(0,10,'COMMENTAIRE',0,1);
					$fpdf->SetFont('times','',12);
					$fpdf->MultiCell(0, 5,  utf8_decode(Tools::replaceSpecialCharByIso($acq->getComment())),'TL');
				}
				$fpdf->Ln(15);
				$fpdf->SetFont('times','B',25);
				$fpdf->Cell(0,10,'DIVERS',0,1);
				$fpdf->SetFont('times','',12);
				$txt = "Utilisateur lié : ".$acq->getUser()->getFirstname().' '.$acq->getUser()->getName()."\nDate d'ajout : ".($acq->getDateInsert()==null?'NC':date( Constant::DATE_FORMAT,$acq->getDateInsert()))."\nUrl de la fiche : ".Tools::create_url($this->_user,'acquereur','see',$acq->getIdAcquereur()) ;
				$fpdf->MultiCell(0, 5,  utf8_decode(Tools::replaceSpecialCharByIso($txt)),'TL');
				$fpdf->Output();
			}

		}if(isset($get['page'])&&$get['page']=='afficheTerrainExclu'){
			$mandate = Mandate::load($this->_pdo,$get['action']);
			if(empty($post)){
				$this->_template = dirname(__FILE__).'/views/pre_affiche.tpl';
				$this->_title="Affiche exclusivité";
				$this->_smarty->assign('ville',$mandate->getCity()->getName());
				$this->_smarty->assign('secteur',$mandate->getCity()->getSector()->getName());
				$this->_smarty->assign('corps',$mandate->getCommentaireApparent());
				// appel du stript de modification/confirmation...
			}else{

				$fpdf = new FPDF();
				$fpdf->AddFont('MonotypeCorsiva','','mtcorsva.php');
				$fpdf->AddPage();
				if($mandate->getUser()->getAgency()->getLogoAfficheTerrain()!=''){
					$fpdf->Image(Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY.'user/'.$mandate->getUser()->getAgency()->getLogoAfficheTerrain(),0,0,210);
				}
				$fpdf->Ln(45);
				$fpdf->SetFont('MonotypeCorsiva','',40);
				if($post['villeSecteur']=="ville"){
					$fpdf->Cell(0,25,$mandate->getCity()->getName() ,0,1,'C');
				}else{
					$fpdf->Cell(0,25,$mandate->getCity()->getSector()->getName() ,0,1,'C');
				}
				$fpdf->SetFont('Times','',25);
				$fpdf->SetTextColor(255,255,255);
				$fpdf->SetFillColor(255,0,0);
				$fpdf->Cell(0,10,"EXCLUSIVITE ".strtoupper($mandate->getUser()->getAgency()->getGeneralName()) ,0,1,'C',true);

				$fpdf->SetTextColor(0,0,0);
				$fpdf->ln(8);
				$fpdf->SetLeftMargin(37);
				$fpdf->SetRightMargin(34);
				if( $mandate->getPictureByDefault() )
				$fpdf->Image( Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY.'terrain/'.$mandate->getPictureByDefault()->getName(),null,null,136,102,'jpg' );
				$fpdf->ln(8);
				$fpdf->SetFont('MonotypeCorsiva','',20);
				$fpdf->write(6,utf8_decode( $post['corps']==''?'':$post['corps'] ));
				$fpdf->ln(15);
				$fpdf->SetLineWidth(0.5);
				$fpdf->SetFont('MonotypeCorsiva','',25);
				$fpdf->Cell(136,13.5,utf8_decode('Prix : '.str_replace('.00','',$mandate->getPriceFai()==null?'NC':Tools::grosNombre($mandate->getPriceFai()))).chr(128),'LTR',1,'C');
				$fpdf->Cell(136,13.5,utf8_decode("Frais d'agence inclus"),'LRB',1,'C');
				$fpdf->SetLineWidth(1);

				$fpdf->Line(37, 98, 173, 98);
				$fpdf->Line(37, 200, 173, 200);
				$fpdf->Line(173, 98, 173, 200);
				$fpdf->Line(37, 98, 37, 200);

				$fpdf->Output();
			}

		}
		if(isset($get['page'])&&$get['page']=='afficheTerrainNouv'){
			$mandate = Mandate::load($this->_pdo,$get['action']);
			if(empty($post)){
				$this->_template = dirname(__FILE__).'/views/pre_affiche.tpl';
				$this->_title="Affiche exclusivité";
				$this->_smarty->assign('ville',$mandate->getCity()->getName());
				$this->_smarty->assign('secteur',$mandate->getCity()->getSector()->getName());
				$this->_smarty->assign('corps',$mandate->getCommentaireApparent());
				// appel du stript de modification/confirmation...
			}else{

				$fpdf = new FPDF();
				$fpdf->AddFont('MonotypeCorsiva','','mtcorsva.php');
				$fpdf->AddPage();
				if($mandate->getUser()->getAgency()->getLogoAfficheTerrain()!=''){
					$fpdf->Image(Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY.'user/'.$mandate->getUser()->getAgency()->getLogoAfficheTerrain(),0,0,210);
				}
				$fpdf->Ln(45);
				$fpdf->SetFont('MonotypeCorsiva','',40);
				if($post['villeSecteur']=="ville"){
					$fpdf->Cell(0,25,$mandate->getCity()->getName() ,0,1,'C');
				}else{
					$fpdf->Cell(0,25,$mandate->getCity()->getSector()->getName() ,0,1,'C');
				}
				$fpdf->SetFont('Times','',25);
				$fpdf->SetTextColor(255,255,255);
				$fpdf->SetFillColor(255,0,0);
				$fpdf->Cell(0,10,"NOUVEAUTE ".strtoupper($mandate->getUser()->getAgency()->getGeneralName() ),0,1,'C',true);

				$fpdf->SetTextColor(0,0,0);
				$fpdf->ln(8);
				$fpdf->SetLeftMargin(37);
				$fpdf->SetRightMargin(34);
				if( $mandate->getPictureByDefault() )
				$fpdf->Image( Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY.'terrain/'.$mandate->getPictureByDefault()->getName(),null,null,136,102,'jpg' );
				$fpdf->ln(8);
				$fpdf->SetFont('MonotypeCorsiva','',20);
				$fpdf->write(6,utf8_decode( $post['corps']==''?'':$post['corps'] ));
				$fpdf->ln(15);
				$fpdf->SetLineWidth(0.5);
				$fpdf->SetFont('MonotypeCorsiva','',25);
				$fpdf->Cell(136,13.5,utf8_decode('Prix : '.str_replace('.00','',$mandate->getPriceFai()==null?'NC':Tools::grosNombre($mandate->getPriceFai()))).chr(128),'LTR',1,'C');
				$fpdf->Cell(136,13.5,utf8_decode("Frais d'agence inclus"),'LRB',1,'C');
				$fpdf->SetLineWidth(1);

				$fpdf->Line(37, 98, 173, 98);
				$fpdf->Line(37, 200, 173, 200);
				$fpdf->Line(173, 98, 173, 200);
				$fpdf->Line(37, 98, 37, 200);

				$fpdf->Output();
			}

		}
		if(isset($get['page'])&&$get['page']=='afficheTerrainVendu'){
			$mandate = Mandate::load($this->_pdo,$get['action']);
			if(empty($post)){
				$this->_template = dirname(__FILE__).'/views/pre_affiche.tpl';
				$this->_title="Affiche terrain vendu";
				$this->_smarty->assign('ville',$mandate->getCity()->getName());
				$this->_smarty->assign('secteur',$mandate->getCity()->getSector()->getName());
				$this->_smarty->assign('corps',$mandate->getCommentaireApparent());

				// appel du stript de modification/confirmation...
			}else{
				$fpdf = new FPDF();
				$fpdf->AddFont('MonotypeCorsiva','','mtcorsva.php');
				$fpdf->AddPage();
				if($mandate->getUser()->getAgency()->getLogoAfficheTerrain()!=''){
					$fpdf->Image(Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY.'user/'.$mandate->getUser()->getAgency()->getLogoAfficheTerrain(),0,0,210);
				}
				$fpdf->Ln(50);
				$fpdf->SetFont('MonotypeCorsiva','',40);
				if($post['villeSecteur']=="ville"){
					$fpdf->Cell(0,25,$mandate->getCity()->getName() ,0,1,'C');
				}else{
					$fpdf->Cell(0,25,$mandate->getCity()->getSector()->getName() ,0,1,'C');
				}
				//$fpdf->ln(5);
				//$fpdf->SetLeftMargin(37);
				//$fpdf->SetRightMargin(35);
				$fpdf->SetFont('Times','',25);
				$fpdf->SetTextColor(255,255,255);
				$fpdf->SetFillColor(255,0,0);
				$fpdf->Cell(0,10,"A ETE VENDU PAR ".strtoupper($mandate->getUser()->getAgency()->getGeneralName()) ,0,1,'C',true);

				$fpdf->SetTextColor(0,0,0);
				$fpdf->ln(3);
				$fpdf->SetLeftMargin(37);
				$fpdf->SetRightMargin(34);

				if( $mandate->getPictureByDefault() )
				$fpdf->Image( Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY.'terrain/'.$mandate->getPictureByDefault()->getName(),null,null,136,102,'jpg' );
				//$fpdf->Image(Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY.'documents/a_ete_vendu2.png',null,95,136,0,'png');
				$fpdf->ln(8);
				$fpdf->SetFont('MonotypeCorsiva','',20);
				$fpdf->write(6,utf8_decode($post['corps']==''?'':$post['corps'] ));
				$fpdf->ln(15);
				$fpdf->SetLineWidth(0.5);
				$fpdf->SetFont('MonotypeCorsiva','',25);
				$fpdf->Cell(136,13.5,utf8_decode('Prix : '.str_replace('.00','', $mandate->getPriceFai()==null?'NC':Tools::grosNombre($mandate->getPriceFai()))).chr(128),'LTR',1,'C');
				$fpdf->Cell(136,13.5,utf8_decode("Frais d'agence inclus"),'LRB',1,'C');
				$fpdf->SetLineWidth(1);
				$fpdf->Line(37, 98, 173, 98);
				$fpdf->Line(37, 200, 173, 200);
				$fpdf->Line(173, 98, 173, 200);
				$fpdf->Line(37, 98, 37, 200);
				$fpdf->Output();
			}
		}if(isset($get['page'])&&$get['page']=='afficheMandat'){
			// Affichage du pdf (le reste on verra plus tard).
			$mandate = Mandate::load($this->_pdo,$get['action']);
			// frm d'assignation de variables // choix des images hide() en js quand une seule image est cochée.
			$this->_title = 'Affiche de mandat';
			$this->_template = dirname(__FILE__).'/views/afficheMandat.tpl';
			$this->_smarty->assign('corps',empty($post['corps'])?$mandate->getCommentaireApparent():$post['corps']);
			$this->_smarty->assign('listOfPicture',$mandate->listPictures());
			if(isset($post['send'])){
				//				var_dump($post);
				// Choisir dans le post
				$pictureSingle =$post['photos']=='une'?true:false;
					
				$useCity = $post['villeSecteur']=='ville'?true:false;
				// 	passage des valeurs post
				//				$listNameOfSPicture = array('1-1jpg','1-4.jpg','1-6.jpg');

				$listNameOfSPicture = $post['arrayPicture'];
				if(count($listNameOfSPicture)!=3&&!$pictureSingle){
					$error[]= 'Vous devez selectionner 3 miniatures.';
				}
				$excluEscalimmo = $post['type']=='exclu'?true:false;
				$dejaVendu =  $post['type']=='dejaV'?true:false;
				$nouveaute=  $post['type']=='nouveaute'?true:false;
					
				if(empty($error)){
					$fpdf = new FPDF();
					$fpdf->AddFont('MonotypeCorsiva','','mtcorsva.php');
					$fpdf->SetTopMargin(6);
					$fpdf->SetAutoPageBreak(0);
					$fpdf->AddPage();
					$fpdf->SetFont('MonotypeCorsiva','',40);
					// r,g,b
					$fpdf->SetTextColor( 128,0,0 );
					$fpdf->SetFillColor(128,0,0);
					$fpdf->SetDrawColor(128,0,0);
					$fpdf->SetLeftMargin(0);

					if($mandate->getUser()->getAgency()->getLogoAfficheMandat()!=''){
						$fpdf->Image(Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY.'user/'.$mandate->getUser()->getAgency()->getLogoAfficheMandat(),5,5,50);
					}
					//

					$fpdf->Cell(35,27);
					if($useCity){
						//$fpdf->Cell(118,27,Tools::replaceSpecialCharByIso($mandate->getCity()->getName()) ,1,1,'C');
							
						//$fpdf->ln();
						$fpdf->MultiCell(118,10,Tools::replaceSpecialCharByIso($mandate->getCity()->getName()) ,0,'C');
					}
					else
					//$fpdf->Cell(118,27,Tools::replaceSpecialCharByIso($mandate->getCity()->getSector()->getName()) ,0,1,'C');
					$fpdf->MultiCell(118,10,Tools::replaceSpecialCharByIso($mandate->getCity()->getSector()->getName()) ,0,'C');
					$fpdf->Image(Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY.'documents/fnaim.jpg',168,0,42);
					$fpdf->ln(5);
					$fpdf->setY(32);

					$fpdf->SetLeftMargin(18);
					$fpdf->SetRightMargin(17);
					if($pictureSingle){
						if( $mandate->getPictureByDefault() ){

							$fpdf->Rect(17,31,177,160, "F");



							$fpdf->Image( Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY.'mandat/big/'.$mandate->getPictureByDefault()->getName(),null,null,175,158,'jpg' );
							$fpdf->ln(6);
						}
					}else{
						$fpdf->Rect(17,31,177,110, "F");
						$fpdf->Image( Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY.'mandat/big/'.$mandate->getPictureByDefault()->getName(),null,null,175,108,'jpg' );
						//			$fpdf->ln(6);
						$fpdf->Rect(17,145,55,45, "F");
						$fpdf->Image( Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY.'mandat/thumb/'.$listNameOfSPicture[0],null,$fpdf->getY()+6,53,43,'jpg' );

						$fpdf->Rect(78,145,55,45, "F");

						$fpdf->Image( Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY.'mandat/thumb/'.$listNameOfSPicture[1],$fpdf->GetX()+61,$fpdf->getY()+6,53,43,'jpg' );
						$fpdf->Rect(139,145,55,45, "F");
						$fpdf->Image( Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY.'mandat/thumb/'.$listNameOfSPicture[2],$fpdf->GetX()+122,$fpdf->getY()+6,53,43,'jpg' );
						$fpdf->ln(55);
					}


					$fpdf->SetFont('MonotypeCorsiva','',20);

					$fpdf->SetTextColor( 0,0,0 );
					$fpdf->write(6,utf8_decode($post['corps']==''?'':Tools::replaceSpecialCharByIso($post['corps']) ));
					//				$fpdf->write(10,utf8_decode($mandate->getCommentaireApparent()==''?'':$mandate->getCommentaireApparent() ));
					$fpdf->SetTextColor( 128,0,0 );
					//			$fpdf->SetLeftMargin(10);
					// footer
					$valDpe = ValDpe::loadByMandate($this->_pdo,$mandate);

					// -15 mm du bas de la page (ne fonctionne pas ...)
					$fpdf->SetY(-55);
					$fpdf->SetX(17);
					if($valDpe!=null){
						if($valDpe->getConsoEner()!=0){
							$fpdf->Cell(45,45,'',1);
							$fpdf->Image( Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY.'dpe/ces_'.$mandate->getIdMandate().'.png',$fpdf->GetX()-44, $fpdf->GetY()+2,42,42,'png' );
							// Importer le graphique
							$fpdf->Cell(5,45);
						}
						if($valDpe->getEmissionGaz()!=0){
							$fpdf->Cell(45,45,'',1);
							$fpdf->Image( Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY.'dpe/ges_'.$mandate->getIdMandate().'.png',$fpdf->GetX()-44, $fpdf->GetY()+2,42,42,'png' );
							$fpdf->Cell(5,45);
						}
					}
					$fpdf->SetFont('MonotypeCorsiva','',25);
					$fpdf->SetRightMargin(17);
					$fpdf->MultiCell(0,22.5,utf8_decode('Prix : '.str_replace('.00','', $mandate->getPriceFai()==null?'NC':Tools::grosNombre($mandate->getPriceFai()))).chr(128)."\n Frais d'agence inclus",'LTRB','C');




					if($excluEscalimmo){
						$fpdf->SetFont('Times','',25);
						$fpdf->SetTextColor(255,255,255);
						$fpdf->SetFillColor(255,0,0);
						$fpdf->SetY(32);
						$fpdf->Cell(0,10,"EXCLUSIVITE ".strtoupper( $mandate->getUser()->getAgency()->getGeneralName() ) ,0,1,'C',true);
					}

					if($dejaVendu){
						/*
						 if($pictureSingle){
						$fpdf->Image(Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY.'documents/a_ete_vendu2.png',50,53,113,107,'png');
						}else{
						$fpdf->Image(Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY.'documents/a_ete_vendu2.png',20,33,0,0,'png');
						}
						*/

						$fpdf->SetFont('Times','',25);
						$fpdf->SetTextColor(255,255,255);
						$fpdf->SetFillColor(255,0,0);
						$fpdf->SetY(32);
						$fpdf->Cell(0,10,"A ETE VENDU PAR ".strtoupper( $mandate->getUser()->getAgency()->getGeneralName() ) ,0,1,'C',true);

					}if($nouveaute){
						$fpdf->SetFont('Times','',25);
						$fpdf->SetTextColor(255,255,255);
						$fpdf->SetFillColor(255,0,0);
						$fpdf->SetY(32);
						$fpdf->Cell(0,10, utf8_decode("NOUVEAUTÉ ".strtoupper( $mandate->getUser()->getAgency()->getGeneralName() )) ,0,1,'C',true);
					}
					$fpdf->Output();
					exit();
				}
				$this->_smarty->assign('error',$error);
			}

		}if(isset($get['page'])&&$get['page']=='etudeMaitreAcquereurs'){

			$this->_title = 'Etude de maître ( acquereurs )';

			$this->_etudesMaitre( Mandate::load($this->_pdo,$get['action']),Documents::load($this->_pdo,1),$post);

		}if(isset($get['page'])&&$get['page']=='etudeMaitreVendeur'){
			$doc =Documents::load($this->_pdo,2);
			$this->_title = 'Etude de maître ( vendeurs )';
			$this->_etudesMaitre( Mandate::load($this->_pdo,$get['action']),$doc,$post);
		}
		if(isset($get['page'])&&$get['page']=='etudeMaitreVA'){
			$doc =Documents::load($this->_pdo,3);
			$this->_title = 'Etude de maître ( vendeurs et acquereurs )';
			$this->_etudesMaitre( Mandate::load($this->_pdo,$get['action']),$doc,$post);
		}
		if(isset($get['page'])&&$get['page']=='vendeur1'){

			$doc =Documents::load($this->_pdo,4);
			$this->_title = 'Courrier envoi comp.';
			$mandate = Mandate::load($this->_pdo,$get['action']);


			$this->_template = dirname(__FILE__).'/views/pre_gen.tpl';

			$this->_smarty->assign('dateDoc',date(Constant::DATE_FORMAT2) );
			$this->_smarty->assign('sizeTypo',$doc->getSizetext() );
			//					$this->_smarty->assign('corps',$this->_replace($corps,$sell));
			$this->_smarty->assign('corps',$this->_replace($doc->getCorps() ,$mandate));

			$this->_smarty->assign('signature',$doc->getOther() );
			$this->_smarty->assign('h1',$this->_title );
			if(!empty($post['generate'])){
				$sell = $mandate->getDefaultSeller();
				//		var_dump($sell);
				$size = $post['sizeTypo'];
				$date = $post['dateDoc'];
				$fpdf = new  fpdf_multicelltag();
				// style à utiliser : <u>à souligner</u> sougnera l'interieur des balises
				$fpdf->SetStyle("u","times","u",$size,"0,0,0");
				$fpdf->SetStyle("i","times","i",$size,"0,0,0");
				$fpdf->SetStyle("b","times","b",$size,"0,0,0");
				$fpdf->SetStyle("bi","times","bi",$size,"0,0,0");
				$fpdf->SetStyle("bu","times","bu",$size,"0,0,0");
				$fpdf->SetStyle("iu","times","iu",$size,"0,0,0");
				$fpdf->SetStyle("biu","times","biu",$size,"0,0,0");
				$fpdf->SetStyle("rouge","times","",$size,"255,0,0");

				$fpdf->SetTopMargin(63.5);
				$fpdf->AddPage();
				$fpdf->Cell(100);
				$fpdf->SetFont('times','B',$size);
				$fpdf->Cell(0,5,utf8_decode($sell->getSellerTitle()->getLibel().' '.$sell->getName().' '.$sell->getFirstname()),0,2);
				$fpdf->SetFont('times','',$size);
				$fpdf->Cell(0,5,utf8_decode($sell->getAddress() ),0,2);
				$fpdf->Cell(0,5,utf8_decode($sell->getCity()->getZipCode().' '.strtoupper( $sell->getCity()->getName() )));
				$fpdf->ln(11);
				$fpdf->Cell(100);
				$fpdf->Cell(0,5,utf8_decode(ucfirst(strtolower($mandate->getUser()->getAgency()->getName()))).', le '.$date );
				$fpdf->SetLeftMargin(22);
				$fpdf->ln(22);
				$fpdf->SetFont('times','U',$size);
				$fpdf->cell(33,4,'Affaire suivie par : ');
				$fpdf->SetFont('times','B',$size);
				$fpdf->cell(33,4,$mandate->getUser()->getFirstname().' '.$mandate->getUser()->getName());
				$fpdf->ln(10);
				$fpdf->SetFont('times','U',$size);
				$fpdf->cell(45,4,utf8_decode('Vente d\'un bien situé au  : '),0,2);
				$fpdf->cell(46);
				$fpdf->SetFont('times','B',$size);
				$fpdf->cell(0,5,utf8_decode($mandate->getAddress()),0,2);
				$fpdf->cell(0,5,utf8_decode($mandate->getCity()->getZipCode().' '.$mandate->getCity()->getName()),0,2);
				$fpdf->ln(13);
				$fpdf->setRightMargin(19);
				$fpdf->SetFont('times','',$size);
				$fpdf->MultiCellTag( 152,5,utf8_decode($this->_replace($post['corps'],$mandate )));
				$fpdf->ln(7);
				$fpdf->cell(76);
				$fpdf->cell(0,5,$post['signature']);
				$fpdf->ln(22);
				$fpdf->SetFont('times','B',$size);
				$fpdf->cell(0,5,'P.J. : ENGAGEMENT DES PARTIES');
				$fpdf->Output();
			}
		}if(isset($get['page'])&&$get['page']=='lettre_renouvellement_vendeur'){
			// generation du pdf
			$doc = Documents::load($this->_pdo,5);
			$mandat = Mandate::load($this->_pdo,$get['action']);
			$signature = $this->_replace($doc->getOther(),$mandat);
			$corps = $this->_replace($doc->getCorps(),$mandat);
			$vendeur = $mandat->getDefaultSeller();
			$entete['civilite'] =  $vendeur->getSellerTitle()->getLibel();
			$entete['prenom']= $vendeur->getFirstName();
			$entete['nom']= $vendeur->getName();
			$entete['adresse']= $vendeur->getAddress();
			$entete['cp']= $vendeur->getCity()->getZipCode();
			$entete['ville']= $vendeur->getCity()->getName();
			$entete['villeAgence']=$this->_user->getAgency()->getName();
			$entete['date']= date('d/m/Y');
			$size = $doc->getSizetext();

			if(empty($post)){
				$this->_title = 'Lettre renouvellement - vendeur';
					


				$this->_template = dirname(__FILE__).'/views/pre_gen.tpl';

				$this->_smarty->assign('dateDoc',date(Constant::DATE_FORMAT2) );
				$this->_smarty->assign('sizeTypo',$doc->getSizetext() );
				$this->_smarty->assign('corps',$this->_replace($doc->getCorps() ,$mandat));

				$this->_smarty->assign('signature',$this->_replace($doc->getOther(),$mandat) );
				$this->_smarty->assign('h1',$this->_title );
			}else{
				$corps = $post['corps'];
				$signature = $post['signature'];
				$size = $post['size'];
				$this->_courrierDefaut($entete,$corps,$signature,$size);
			}
		}if(isset($get['page'])&&$get['page']=='lettre_envoi_vendeur'){

			// generation du pdf
			$doc = Documents::load($this->_pdo,6);
			$mandat = Mandate::load($this->_pdo,$get['action']);
			$signature = $this->_replace($doc->getOther(),$mandat);
			$corps = $this->_replace($doc->getCorps(),$mandat);
			$entete['villeAgence']=$this->_user->getAgency()->getName();
			$entete['date']= date('d/m/Y');
			$size = $doc->getSizetext();
			if(empty($post)){
				$this->_title = 'Lettre renouvellement - vendeur';
					


				$this->_template = dirname(__FILE__).'/views/pre_gen.tpl';

				$this->_smarty->assign('dateDoc',date(Constant::DATE_FORMAT2) );
				$this->_smarty->assign('sizeTypo',$doc->getSizetext() );
				$this->_smarty->assign('corps',$this->_replace($doc->getCorps() ,$mandat));

				$this->_smarty->assign('signature',$this->_replace($doc->getOther(),$mandat) );
				$this->_smarty->assign('h1',$this->_title );
			}else{
				$corps = $post['corps'];
				$signature = $post['signature'];
				$size = $post['size'];
				$this->_courrierDefaut($entete,$corps,$signature,$size);
			}
		}
		// estimation du prix
		if(isset($get['page'])&&$get['page']=='estimation_bien'){
			// Avec acq .... (courier commun, ne peut s'imprimer que si le mandat est rapproché)
			$mandate = Mandate::load($this->_pdo,$get['action']);




			$doc = Documents::load($this->_pdo,10);
			// document à loader.
			if($doc==null){
				$doc = Documents::createId($this->_pdo,10);
			}
			if( $doc->getCorps() == ''){
				/*
					<titreVendeur>','<nomVendeur>','<prenomVendeur>','<debutMandat>',
				'<typeBien>','<prenomDemarcheur>','<nomDemarcheur>','<adresseBien>',
				'<cpBien>','<villeBien>','<numeroMandat>
				*/
				$doc->setCorps(
"[u]Objet :[/u] [i]Estimation de votre bien immobilier[/i]
					
					
     [titreVendeur] [b][nomVendeur][/b],


     Veuillez trouver ci-joint l'estimation de votre bien situé : [b][adresseBien] [cpBien] [villeBien][/b]


                 [u]Estimation de votre bien[/u] : entre [b][estimationMini] € et [estimationMaxi] €[/b]


     [i]Cette estimation tient compte de la conjoncture actuelle et de biens similaires vendus récemment. Ont été pris en compte l'ensemble des éléments en notre connaissance (prix au m2 dans le secteur, environnement, commodités...) pour donner la valeur la plus proche du marché immobilier actuel.[/i]

                         [b]Pour faire valoir ce que de droit[/b]

"
				,false);
				$doc->setOther(
'Votre Conseiller(e),
[prenomDemarcheur] [nomDemarcheur]',false);
				$doc->update();
			}


			$signature = $this->_replace($doc->getOther(),$mandate);
			$corps = $this->_replace($doc->getCorps(),$mandate);
			$vendeur = $mandate->getDefaultSeller();
			$entete['civilite'] =  $vendeur->getSellerTitle()->getLibel();
			$entete['prenom']= $vendeur->getFirstName();
			$entete['nom']= $vendeur->getName();
			$entete['adresse']= $vendeur->getAddress();
			$entete['cp']= $vendeur->getCity()->getZipCode();
			$entete['ville']= $vendeur->getCity()->getName();
			$entete['villeAgence']=$this->_user->getAgency()->getName();
			$entete['date']= date('d/m/Y');
			$size = $doc->getSizetext();
			if(empty($post)){
				$this->_title = 'Compte rendu simple';



				$this->_template = dirname(__FILE__).'/views/pre_gen.tpl';

				$this->_smarty->assign('dateDoc',date(Constant::DATE_FORMAT2) );
				$this->_smarty->assign('sizeTypo',$doc->getSizetext() );
				$this->_smarty->assign('corps',$this->_replace($doc->getCorps() ,$mandate));

				$this->_smarty->assign('signature',$this->_replace($doc->getOther(),$mandate) );
				$this->_smarty->assign('h1',$this->_title );
			}else{
				$corps = $post['corps'];
				$signature = $post['signature'];
				$size = $post['size'];
				$this->_courrierDefaut($entete,$corps,$signature,$size);
			}

		}


		if(isset($get['page'])&&$get['page']=='compte_rendu_simple'){
			// Avec acq .... (courier commun, ne peut s'imprimer que si le mandat est rapproché)
			$mandate = Mandate::load($this->_pdo,$get['action']);
			$rapp = BddRapprochement::loadByMandateR($this->_pdo,$mandate);
			if(null!=$rapp){
				// courrier.
					

				$doc = Documents::load($this->_pdo,7);
				$signature = $this->_replace($doc->getOther(),$mandate);
				$corps = $this->_replace($doc->getCorps(),$mandate);
				$vendeur = $mandate->getDefaultSeller();
				$entete['civilite'] =  $vendeur->getSellerTitle()->getLibel();
				$entete['prenom']= $vendeur->getFirstName();
				$entete['nom']= $vendeur->getName();
				$entete['adresse']= $vendeur->getAddress();
				$entete['cp']= $vendeur->getCity()->getZipCode();
				$entete['ville']= $vendeur->getCity()->getName();
				$entete['villeAgence']=$this->_user->getAgency()->getName();
				$entete['date']= date('d/m/Y');
				$size = $doc->getSizetext();
				if(empty($post)){
					$this->_title = 'Compte rendu simple';



					$this->_template = dirname(__FILE__).'/views/pre_gen.tpl';

					$this->_smarty->assign('dateDoc',date(Constant::DATE_FORMAT2) );
					$this->_smarty->assign('sizeTypo',$doc->getSizetext() );
					$this->_smarty->assign('corps',$this->_replace($doc->getCorps() ,$mandate));

					$this->_smarty->assign('signature',$this->_replace($doc->getOther(),$mandate) );
					$this->_smarty->assign('h1',$this->_title );
				}else{
					$corps = $post['corps'];
					$signature = $post['signature'];
					$size = $post['size'];
					$this->_courrierDefaut($entete,$corps,$signature,$size);
				}
			}
		}if(isset($get['page'])&&$get['page']=='envoi_comp_acq'){
			// Avec acq .... (courier commun, ne peut s'imprimer que si le mandat est rapproché)
			$mandate = Mandate::load($this->_pdo,$get['action']);
			$rapp = BddRapprochement::loadByMandateR($this->_pdo,$mandate);
			if(null!=$rapp){
				$doc = Documents::load($this->_pdo,8);
				$signature = $this->_replace($doc->getOther(),$mandate);
				$corps = $this->_replace($doc->getCorps(),$mandate);
				$acq = $rapp->getAcquereur();

				$entete['civilite'] =  $acq->getTitreAcquereur()->getName();
				$entete['prenom']= $acq->getFirstName();
				$entete['nom']= $acq->getName();
				$entete['adresse']= $acq->getAddress();
				$entete['cp']= $acq->getVilleAcquereur()->getZipCode();
				$entete['ville']= $acq->getVilleAcquereur()->getName();
				$entete['villeAgence']=$this->_user->getAgency()->getName();
				$entete['date']= date('d/m/Y');
				$size = $doc->getSizetext();
				if(empty($post)){
					$this->_title = 'Envoi comp. acquereur';
					$this->_template = dirname(__FILE__).'/views/pre_gen.tpl';
					$this->_smarty->assign('dateDoc',date(Constant::DATE_FORMAT2) );
					$this->_smarty->assign('sizeTypo',$doc->getSizetext() );
					$this->_smarty->assign('corps',$this->_replace($doc->getCorps() ,$mandate));
					$this->_smarty->assign('signature',$this->_replace($doc->getOther(),$mandate) );
					$this->_smarty->assign('h1',$this->_title );
				}else{
					$corps = $post['corps'];
					$signature = $post['signature'];
					$size = $post['size'];
					$this->_courrierDefaut($entete,$corps,$signature,$size);
				}
			}


		}if(isset($get['page'])&&$get['page']=='avenant_modif_acq'){
			$mandate = Mandate::load($this->_pdo,$get['action']);
			$rapp = BddRapprochement::loadByMandateR($this->_pdo,$mandate);
			if(null!=$rapp){
				// page avenant modif...
				// titre du corps

				if(empty($post)){
					$this->_title = 'Avenant modif acquereur';
					$this->_template = dirname(__FILE__).'/views/avenant_modifAcq.tpl';
					$doc = Documents::load($this->_pdo,9);


					$size = 12;


					$this->_smarty->assign('dateDoc',date(Constant::DATE_FORMAT2) );
					$this->_smarty->assign('sizeTypo',$doc->getSizetext() );
					$this->_smarty->assign('corps',$this->_replace($doc->getCorps() ,$mandate));
					$this->_smarty->assign('villeAgence',$this->_user->getAgency()->getName() );
					$this->_smarty->assign('h1',$this->_title );

				}else{

					$corps = $post['corps'];
					$date = $post['dateDoc'];
					$size = $post['size'];
					$villeAgence = $post['villeAgence'];
					$signature1 = "Signature Mandant";
					$signature2 = "Signature Acquéreur";

					// début de la page
					$fpdf = new  fpdf_multicelltag();
					// style à utiliser : <u>à souligner</u> sougnera l'interieur des balises
					$fpdf->SetStyle("h1","times","bu",25,"0,0,0");
					$fpdf->SetStyle("u","times","u",$size,"0,0,0");
					$fpdf->SetStyle("i","times","i",$size,"0,0,0");
					$fpdf->SetStyle("b","times","b",$size,"0,0,0");
					$fpdf->SetStyle("bi","times","bi",$size,"0,0,0");
					$fpdf->SetStyle("bu","times","bu",$size,"0,0,0");
					$fpdf->SetStyle("iu","times","iu",$size,"0,0,0");
					$fpdf->SetStyle("biu","times","biu",$size,"0,0,0");
					$fpdf->SetStyle("rouge","times","",$size,"255,0,0");
					$fpdf->SetTopMargin(85);
					$fpdf->SetLeftMargin(25);
					$fpdf->SetRightMargin(25);
					$fpdf->AddPage();
					$fpdf->SetFont('times','',$size);
					$fpdf->Cell(0,5,$villeAgence.', le '.$date,0,0,'R');
					$fpdf->ln(25);
					//$fpdf->SetFont('times','BU',28);
					//$fpdf->Cell( 0,0,utf8_decode( $titre ),0,0,'C');
					$fpdf->SetFont('times','',$size);
					//$fpdf->ln(25);
					$fpdf->MultiCellTag( 160,5,utf8_decode( Tools::replaceSpecialCharByIso($corps) ));
					$fpdf->ln(25);
					$fpdf->Cell(0,5,utf8_decode($signature1));
					$fpdf->Cell(0,5,utf8_decode($signature2),0,0,'R');
					$fpdf->Output();
				}
			}

		}if(isset($get['page'])&&$get['page']=='fiche_acq'){

			$this->_title = 'Fiche acquereur';
			$this->_template = dirname(__FILE__).'/views/fiche_acq.tpl';

			// load du mandat
			$mandate = Mandate::load($this->_pdo,$get['action']);

			$this->_smarty->assign('listOfPicture',$mandate->listPictures());
			$photosSelectionnees = $post['arrayPicture'];

			// Placement du logo
			/*
			if(strtoupper( $mandate->getUser()->getAgency()->getName())=='MONTAUBAN'){
			$logo =  Constant::DEFAULT_URL_PICTURE_DIRECTORY.'logoEscalTerrains.jpg' ;
			$nomAgence = 'ESCAL TERRAINS';
			$site = 'www.escalterrains.com';
			$module='mandat';
			}else{
			$logo =   Constant::DEFAULT_URL_PICTURE_DIRECTORY.'logoEscalImmo.jpg' ;
			$nomAgence = 'ESCAL IMMO';
			$site = 'www.escalimmo.com';
			$module='mandat';
			}
			*/
			$module = $mandate->getMandateType()->getId() == Constant::ID_PLOT_OF_LAND ? 'terrain':'mandat';
			$ag = $mandate->getUser()->getAgency();
			$logo =$ag->getLogoAfficheMandat()? Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY.'user/'.$ag->getLogoAfficheMandat() : Constant::DEFAULT_URL_PICTURE_DIRECTORY.'logo.jpg' ;
			$nomAgence = $ag->getGeneralName();
			$site = $ag->getUrl();

			$this->_smarty->assign('module',$module);

			if(!empty($post) && $post['arrayPicture'][2]){
				//var_dump($post);
				$fpdf = new  Ffpdf_multicelltag();
				$size = 12;
				// style à utiliser : <u>à souligner</u> sougnera l'interieur des balises
				$fpdf->SetStyle("u","times","u",$size,"0,0,0");
				$fpdf->SetStyle("i","times","i",$size,"0,0,0");
				$fpdf->SetStyle("b","times","b",$size,"0,0,0");
				$fpdf->SetStyle("bi","times","bi",$size,"0,0,0");
				$fpdf->SetStyle("bu","times","bu",$size,"0,0,0");
				$fpdf->SetStyle("iu","times","iu",$size,"0,0,0");
				$fpdf->SetStyle("biu","times","biu",$size,"0,0,0");
				$fpdf->SetStyle("rouge","times","",$size,"128,0,0");
				$fpdf->SetStyle("rougeB","times","b",$size,"128,0,0");

				$fpdf->SetStyle("h1","times","b",20,"128,0,0");


				$fpdf->AddPage();
				$fpdf->SetFont('times','B',12);


					
				$fpdf->cell(55,25, $fpdf->Image( $logo,$fpdf->GetX()+5,$fpdf->getY()+1,50,20,'jpg') ,1);
				$fpdf->cell(5,25);
				$fpdf->cell(130,25, '',1);
				$fpdf->setX($fpdf->getX() -130 );
				$fpdf->MultiCellTag(0,7,'<h1>'.$nomAgence.'</h1>',0,'C');
				$fpdf->setX($fpdf->getX() -150 );
				$fpdf->MultiCellTag(0,6, $mandate->getUser()->getAgency()->getAddress().' '.$mandate->getUser()->getAgency()->getZipCode().' '.$mandate->getUser()->getAgency()->getCity(),0,'C');
				$fpdf->setX($fpdf->getX() -150 );
				$fpdf->MultiCellTag(0,6,utf8_decode('Tél : ').$mandate->getUser()->getAgency()->getTel1(),0,'C');
				$fpdf->setX($fpdf->getX() -150 );
				$fpdf->MultiCellTag(0,6,'E-mail : <rouge>'.$mandate->getUser()->getAgency()->getEmail().'    </rouge><rougeB>'.$site.'</rougeB>',0,'C');
				$fpdf->ln(3);
				$fpdf->MultiCellTag(115,10,utf8_decode('<rougeB>N° Mandat : ').$mandate->getNumberMandate().' - '.$mandate->getMandateType()->getName().' secteur '.strtolower($mandate->getSector()->getName()).'</rougeB>',1,'C');
				$fpdf->setY($fpdf->getY() -10 );
				$fpdf->setX($fpdf->getX() +120 );

				$fpdf->SetFont('times','',12);

				// cadre droite
				$fpdf->MultiCellTag(70,140,' ',1);
				$fpdf->setY($fpdf->getY() -140 );


				if( $mandate->getNbPiece() > 0){
					$fpdf->setX($fpdf->getX() +120 );
					$fpdf->MultiCellTag(70,5,utf8_decode('Pièces : '.$mandate->getNbPiece()));
				}
				if( $mandate->getSurfaceHabitable() > 0){
					$fpdf->setX($fpdf->getX() +120 );
					$fpdf->MultiCellTag(70,5,utf8_decode('Surf. hab. (m²) : '.$mandate->getSurfaceHabitable()));
				}
				if( $mandate->getSuperficieTotale() > 0){
					$fpdf->setX($fpdf->getX() +120 );
					$fpdf->MultiCellTag(70,5,utf8_decode('Surf. terr. (m²) : '.$mandate->getSuperficieTotale()));
				}
				if( $mandate->getNbChambre() > 0){
					$fpdf->setX($fpdf->getX() +120 );
					$fpdf->MultiCellTag(70,5,utf8_decode('Nb Chambres : '.$mandate->getNbChambre()));
				}
				if( $mandate->getSurfacePieceVie() > 0){
					$fpdf->setX($fpdf->getX() +120 );
					$fpdf->MultiCellTag(70,5,utf8_decode('Surf. Pièce. Vie (m²) : '.$mandate->getSurfacePieceVie()));
				}
				if( $mandate->getMandateType()->getIdMandateType() != Constant::ID_PLOT_OF_LAND ){
					$fpdf->setX($fpdf->getX() +120 );
					$fpdf->MultiCellTag(70,5,utf8_decode('Niveau : '.$mandate->getNiveau()));
				}
				if( $mandate->getAnneeConstruction() > 0){
					$fpdf->setX($fpdf->getX() +120 );
					$fpdf->MultiCellTag(70,5,utf8_decode('Année Const. : '.$mandate->getAnneeConstruction()));
				}
				if( $mandate->getProximiteTransport() > 0){
					$fpdf->setX($fpdf->getX() +120 );
					$fpdf->MultiCellTag(70,5,utf8_decode('Transport (min) : '.$mandate->getProximiteTransport()));
				}
				if( $mandate->getProximiteEcole() > 0){
					$fpdf->setX($fpdf->getX() +120 );
					$fpdf->MultiCellTag(70,6,utf8_decode('Ecole (min) : '.$mandate->getProximiteEcole()));
				}
				if( $mandate->getProximiteCommerce() > 0){
					$fpdf->setX($fpdf->getX() +120 );
					$fpdf->MultiCellTag(70,5,utf8_decode('Commerce (min) : '.$mandate->getProximiteCommerce()));
				}
					
				if( $mandate->getTaxesFonciere() > 0){

					$fpdf->setX($fpdf->getX() +120 );
					$fpdf->MultiCellTag(70,5,utf8_decode('Taxes foncière : '.$mandate->getTaxesFonciere()));
				}
				// separateur
				$fpdf->setX($fpdf->getX() +120 );
				$fpdf->MultiCellTag(70,1,'----------',0,'C');
				if($mandate->getStyle()){
					$fpdf->setX($fpdf->getX() +120 );
					$fpdf->MultiCellTag(70,5,utf8_decode('Style : '.$mandate->getStyle()->getName() ));
				}
				if($mandate->getRoof()){
					$fpdf->setX($fpdf->getX() +120 );
					$fpdf->MultiCellTag(70,5,utf8_decode('Toiture : '.$mandate->getRoof()->getName() ));
				}
				if($mandate->getCommonOwnership()){
					$fpdf->setX($fpdf->getX() +120 );
					$fpdf->MultiCellTag(70,5,utf8_decode('Mittoyenneté : '.$mandate->getCommonOwnership()->getName() ));
				}
				if($mandate->getHeating()){
					$fpdf->setX($fpdf->getX() +120 );
					$fpdf->MultiCellTag(70,6,utf8_decode('Chauffage : '.$mandate->getHeating()->getName() ));
				}
				if($mandate->getConstruction()){
					$fpdf->setX($fpdf->getX() +120 );
					$fpdf->MultiCellTag(70,5,utf8_decode('Construction : '.$mandate->getConstruction()->getName() ));
				}
				if($mandate->getInsulation()){
					$fpdf->setX($fpdf->getX() +120 );
					$fpdf->MultiCellTag(70,5,utf8_decode('Isolation : '.$mandate->getInsulation()->getName() ));
				}
				// separateur
				$fpdf->setX($fpdf->getX() +120 );
				$fpdf->MultiCellTag(70,1,'----------',0,'C');

				$i=0;
				if($mandate->getCheminee() && $i<10){
					$fpdf->setX($fpdf->getX() +120 );
					$fpdf->MultiCellTag(70,5,utf8_decode('Cheminée'));
					$i++;
				}
				if($mandate->getCuisineEquipee() && $i<10){
					$fpdf->setX($fpdf->getX() +120 );
					$fpdf->MultiCellTag(70,5,utf8_decode('Cuisine équipée'));
					$i++;
				}
				if($mandate->getCuisineAmenagee() && $i<10){
					$fpdf->setX($fpdf->getX() +120 );
					$fpdf->MultiCellTag(70,5,utf8_decode('Cuisine aménagée'));
					$i++;
				}
				if($mandate->getPiscine() && $i<10){
					$fpdf->setX($fpdf->getX() +120 );
					$fpdf->MultiCellTag(70,5,utf8_decode('Piscine'));
					$i++;
				}
				if($mandate->getPoolHouse() && $i<10){
					$fpdf->setX($fpdf->getX() +120 );
					$fpdf->MultiCellTag(70,5,utf8_decode('Piscine intérieure'));
					$i++;
				}
				if($mandate->getTerrasse() && $i<10){
					$fpdf->setX($fpdf->getX() +120 );
					$fpdf->MultiCellTag(70,5,utf8_decode('Terrasse'));
					$i++;
				}
				if($mandate->getMezzanine() && $i<10){
					$fpdf->setX($fpdf->getX() +120 );
					$fpdf->MultiCellTag(70,5,utf8_decode('Mezzanine'));
					$i++;
				}
				if($mandate->getDependance() && $i<10){
					$fpdf->setX($fpdf->getX() +120 );
					$fpdf->MultiCellTag(70,5,utf8_decode('Dépendances'));
					$i++;
				}
				if($mandate->getGaz() && $i<10){
					$fpdf->setX($fpdf->getX() +120 );
					$fpdf->MultiCellTag(70,5,utf8_decode('Gaz'));
					$i++;
				}
				if($mandate->getCave() && $i<10){
					$fpdf->setX($fpdf->getX() +120 );
					$fpdf->MultiCellTag(70,5,utf8_decode('Cave'));
					$i++;
				}
				if($mandate->getSousSol() && $i<10){
					$fpdf->setX($fpdf->getX() +120 );
					$fpdf->MultiCellTag(70,5,utf8_decode('Sous sol'));
					$i++;
				}
				if($mandate->getGarage() && $i<10){
					$fpdf->setX($fpdf->getX() +120 );
					$fpdf->MultiCellTag(70,5,utf8_decode('Garage'));
					$i++;
				}
				if($mandate->getParking() && $i<10){
					$fpdf->setX($fpdf->getX() +120 );
					$fpdf->MultiCellTag(70,5,utf8_decode('Parking'));
					$i++;
				}
				if($mandate->getRezDeJardin() && $i<10){
					$fpdf->setX($fpdf->getX() +120 );
					$fpdf->MultiCellTag(70,5,utf8_decode('Rez de jardin'));
					$i++;
				}
				if($mandate->getPlainPied() && $i<10){
					$fpdf->setX($fpdf->getX() +120 );
					$fpdf->MultiCellTag(70,5,utf8_decode('Plain pied'));
					$i++;
				}
				if($mandate->getCarriere() && $i<10){
					$fpdf->setX($fpdf->getX() +120 );
					$fpdf->MultiCellTag(70,5,utf8_decode('Carriere'));
					$i++;
				}
				if($mandate->getPointEau() && $i<10){
					$fpdf->setX($fpdf->getX() +120 );
					$fpdf->MultiCellTag(70,5,utf8_decode('Point eau'));
					$i++;
				}

				// Bloc description
				// 483
				$fpdf->setY(51);
				if(Tools::strlenWithAccentedCharacters($mandate->getCommentaireApparent() ) > 483 ){
					$fpdf->MultiCellTag(115,5,utf8_decode( substr( Tools::replaceSpecialCharByIso($mandate->getCommentaireApparent()),0,483).'[...] ' ),1);
				}else{
					$fpdf->MultiCellTag(115,5,utf8_decode(  Tools::replaceSpecialCharByIso($mandate->getCommentaireApparent()).' ' ),1);
				}

				// mise en place des photos et DPE
				$fpdf->setY( 95 );
				$fpdf->MultiCellTag(57,130,utf8_decode(' '),1);
				$fpdf->setY( $fpdf->getY() -125 );
				foreach($photosSelectionnees as $photo ){
					$fpdf->Image(Constant::DEFAULT_URL_PICTURE_DIRECTORY.'modules/'.$module.'/thumb/'.$photo,$fpdf->getX()+4,$fpdf->getY(),48,35,'jpg');
					$fpdf->setY( $fpdf->getY() +40 );

				}

				// DPE
				//$fpdf->setY($fpdf->getY() -125 );
				$fpdf->setY( 95 );
				$fpdf->setX($fpdf->getX() +57 );
				$fpdf->MultiCellTag(58,130,utf8_decode(' ' ),1);
				$valDpe = ValDpe::loadByMandate($this->_pdo, $mandate);
				if($valDpe){
					$verifCes = Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.'/dpe/ces_'.$mandate->getIdMandate().'.png';
					$ces = Constant::DEFAULT_URL_PICTURE_DIRECTORY.'modules/dpe/ces_'.$mandate->getIdMandate().'.png';
					$verifGes = Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.'/dpe/ges_'.$mandate->getIdMandate().'.png';
					$ges = Constant::DEFAULT_URL_PICTURE_DIRECTORY.'modules/dpe/ges_'.$mandate->getIdMandate().'.png';

					if( is_file( $verifCes ) ){
						$fpdf->Image($ces,$fpdf->GetX()+58,$fpdf->GetY()-128,55,$h,'png');
					}

					if(is_file( $verifGes )){
						$fpdf->Image($ges,$fpdf->GetX()+58,$fpdf->GetY()-60,55,$h,'png');
					}
				}

				// Prix
				$fpdf->setY(190);
				$fpdf->setX($fpdf->getX() +120 );

				$fpdf->MultiCellTag(70,20,utf8_decode(Tools::replaceSpecialCharByIso( '<h1>Prix : '.Tools::grosNombre( round($mandate->getPriceFai() ,0) ).' €</h1>') ),1,'C');

				// definition des pièces
				$fpdf->setY($fpdf->getY()+15 );
				$fpdf->MultiCellTag(0,48,' ',1);
				$fpdf->setY($fpdf->getY()-48 );
				$fpdf->MultiCellTag(0,5,utf8_decode('<b>Disposition des pièces</b>'),0,'C');

				// Boucle sur les trucs. ( rajouter un maxi )
				// On récupere les infos
				require_once Constant::DEFAULT_MODULE_DIRECTORY.'mandat/modules/mandateDescription/model/mandateDescription.php';
				$lvl = -100;
				$toogle = 'left';
				//$fpdf->MultiCellTag(95,5,utf8_decode( 'lol' ),1,'C');



				// mettre un if y< à un certain nbre
				foreach( MandateDescription::loadByMandate($this->_pdo, $mandate) as $desc){
					if($fpdf->getY()<268){
						if($desc->getNiveau() != $lvl){
							if($desc->getNiveau()==0){
								$fpdf->MultiCellTag(0,5,utf8_decode('<b>********** RDC **********</b>'),0,'C');
							}else{
								$fpdf->MultiCellTag(0,5,utf8_decode('<b>********** Niveau '.$desc->getNiveau().' **********</b>'),0,'C');
									
							}
							if($toogle=='right'){
								$toogle='left';
							}
							$lvl =$desc->getNiveau();
						}
					}
					if($fpdf->getY() < 270 && $lvl == $desc->getNiveau()){
						if($toogle =='left'){
							$surface = substr($desc->getSurface(),-3)=='.00'?round($desc->getSurface(),0):$desc->getSurface();
							$fpdf->MultiCellTag(95,4,utf8_decode( $desc->getPiece().', '.$desc->getCarac().' ('.$surface.' m²)' ),'R','C');
							$toogle='right';
						}else{
							$fpdf->setY($fpdf->getY()-4 );
							$fpdf->setX($fpdf->getX() +95 );

							$surface = substr($desc->getSurface(),-3)=='.00'?round($desc->getSurface(),0):$desc->getSurface();
							$fpdf->MultiCellTag(95,4,utf8_decode( $desc->getPiece().', '.$desc->getCarac().' ('.$surface.' m²)' ),0,'C');

							$toogle='left';
						}
					}
				}

				// Sinon voir pour mettre dans le footer.

				$fpdf->Output();
			}

		}if(isset($get['page'])&&$get['page']=='lettre_mandat'){

			$this->_title = 'lettre mandat';
			//$this->_template = dirname(__FILE__).'/views/fiche_acq.tpl';

			// load du mandat
			$mandate = Mandate::load($this->_pdo,$get['action']);
			$seller =  $mandate->getDefaultSeller();


			// Placement du logo
			/*
			if(strtoupper( $mandate->getUser()->getAgency()->getName())=='MONTAUBAN'){
			$logo =  Constant::DEFAULT_URL_PICTURE_DIRECTORY.'logoEscalTerrains.jpg' ;
			$nomAgence = 'ESCAL TERRAINS';
			$site = 'www.escalterrains.com';
			$module='terrain';
			}else{
			$logo =   Constant::DEFAULT_URL_PICTURE_DIRECTORY.'logoEscalImmo.jpg' ;
			$nomAgence = 'ESCAL IMMO';
			$site = 'www.escalimmo.com';
			$module='mandat';
			}
			*/
			$module = $mandate->getMandateType()->getId() == Constant::ID_PLOT_OF_LAND ? 'terrain':'mandat';
			$ag = $mandate->getUser()->getAgency();
			$logo =$ag->getLogoAfficheMandat()? Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY.'user/'.$ag->getLogoAfficheMandat() : Constant::DEFAULT_URL_PICTURE_DIRECTORY.'logo.jpg' ;
			$nomAgence = $ag->getGeneralName();
			$site = $ag->getUrl();

			//$this->_smarty->assign('module',$module);


			//var_dump($post);
			$fpdf = new  fpdf_multicelltag();
			$size = 12;
			// style à utiliser : <u>à souligner</u> sougnera l'interieur des balises
			$fpdf->SetStyle("u","times","u",$size,"0,0,0");
			$fpdf->SetStyle("i","times","i",$size,"0,0,0");
			$fpdf->SetStyle("b","times","b",$size,"0,0,0");
			$fpdf->SetStyle("bi","times","bi",$size,"0,0,0");
			$fpdf->SetStyle("bu","times","bu",$size,"0,0,0");
			$fpdf->SetStyle("iu","times","iu",$size,"0,0,0");
			$fpdf->SetStyle("biu","times","biu",$size,"0,0,0");
			$fpdf->SetStyle("rouge","times","",$size,"128,0,0");
			$fpdf->SetStyle("rougeB","times","b",$size,"128,0,0");

			$fpdf->SetStyle("h1","times","b",20,"128,0,0");

			$fpdf->SetStyle("h4","times","bu",14,"0,0,0");
			$fpdf->SetStyle("h5","times","b",14,"0,0,0");

			$fpdf->AddPage();
			$fpdf->SetFont('times','',12);
			$fpdf->Image($logo,null,null,50,0,'jpg');
			$fpdf->ln(5);
			$fpdf->SetRightMargin( 10 );
			$fpdf->SetFont('times','',14);
			$fpdf->Cell(0,5,utf8_decode($nomAgence),0,'2');
			$fpdf->SetFont('times','',12);
			// image principale
			if($mandate->getPictureByDefault()){
				$fpdf->Image(Constant::DEFAULT_URL_PICTURE_DIRECTORY.'modules/'.$module.'/thumb/'.  $mandate->getPictureByDefault()->getName(), 130,10,70,0,'jpg' );
			}
			$fpdf->Cell(0,5,utf8_decode($mandate->getUser()->getAgency()->getAddress()),0,'2');
			$fpdf->Cell(0,5,utf8_decode($mandate->getUser()->getAgency()->getZipCode().' '.$mandate->getUser()->getAgency()->getCity()),0,'2');
			$fpdf->Cell(0,5,utf8_decode('Tél : '.$mandate->getUser()->getAgency()->getTel1()),0,'2');
			$fpdf->ln(15);
			$fpdf->Cell(0,5,'===============================================================================',0,'2');
			$fpdf->MultiCellTag(0, 5, utf8_decode(Tools::replaceSpecialCharByIso( '<h4>AFFAIRE</h4> : '.$mandate->getMandateType()->getName().' '.$seller->getName() )));
			$fpdf->MultiCellTag(0, 5, utf8_decode(Tools::replaceSpecialCharByIso('<h4>MANDAT</h4> : N° '.$mandate->getNumberMandate() )));
			$fpdf->MultiCellTag(0, 5, utf8_decode(Tools::replaceSpecialCharByIso('<h4>DATE DEBUT MANDAT</h4> : '.date(Constant::DATE_FORMAT2,$mandate->getInitDate())) ));
			$fpdf->Cell(0,5,'===============================================================================',0,'2');
			$fpdf->Cell(0,5,'===============================================================================',0,'2');
			$fpdf->MultiCellTag(0, 5, utf8_decode(Tools::replaceSpecialCharByIso( '<h4>DESIGNATION</h4> : '.$mandate->getMandateType()->getName() )));
			$fpdf->ln(5);
			$fpdf->MultiCellTag(0, 5, utf8_decode(Tools::replaceSpecialCharByIso( $mandate->getAddress().' '.$mandate->getCity()->getZipCode().' '.$mandate->getCity()->getName() )));
			$fpdf->ln(5);
			$fpdf->MultiCellTag(0, 5, utf8_decode(Tools::replaceSpecialCharByIso( $mandate->getCommentaireApparent() )));

			$fpdf->Cell(0,5,'===============================================================================',0,'2');
			$fpdf->MultiCellTag(0, 5, utf8_decode(Tools::replaceSpecialCharByIso( '<h4>PROPRIETAIRE : </h4>')),0,'C');

			$fpdf->MultiCellTag(0, 5, utf8_decode(Tools::replaceSpecialCharByIso( $seller->getSellerTitle()->getLibel().' '.$seller->getName().' '.$seller->getFirstname()    )));
			$fpdf->MultiCellTag(0, 5, utf8_decode(Tools::replaceSpecialCharByIso( $seller->getAddress()    )));
			$fpdf->MultiCellTag(0, 5, utf8_decode(Tools::replaceSpecialCharByIso( $seller->getCity()->getZipCode().' '.$seller->getCity()->getName()    )));
			$fpdf->ln(5);
			$fpdf->MultiCellTag(0, 5, utf8_decode(Tools::replaceSpecialCharByIso( '<h5>TELEPHONE FIXE : </h5>'.$seller->getPhone() )));
			$fpdf->MultiCellTag(0, 5, utf8_decode(Tools::replaceSpecialCharByIso( '<h5>TELEPHONE PORTABLE : </h5>'.$seller->getMobilPhone())));
			$fpdf->MultiCellTag(0, 5, utf8_decode(Tools::replaceSpecialCharByIso( '<h5>TELEPHONE TRAVAIL : </h5>'.$seller->getWorkPhone())));
			$fpdf->MultiCellTag(0, 5, utf8_decode(Tools::replaceSpecialCharByIso( '<h5>EMAIL : </h5>'.$seller->getEmail())));

			$fpdf->ln(20);
			$fpdf->MultiCellTag(0, 5, utf8_decode(Tools::replaceSpecialCharByIso( '<h5>COMMERCIAL : '.$mandate->getUser()->getFirstname().' '.$mandate->getUser()->getName().'</h5>')),0,'R');
			$fpdf->Output();

		}if(isset($get['page'])&&$get['page']=='fiche_photo'){
			//echo 'test';
			// si post est vide (choix des photos)
			$mandate = Mandate::load($this->_pdo,$get['action']);
			$listPictures = $mandate->listPictures();
			$listPictureWithPosition = array();
			$mod = $mandate->getMandateType()->getIdMandateType()==Constant::ID_PLOT_OF_LAND?'terrain':'mandat';
			$chemImage = Constant::DEFAULT_URL_PICTURE_DIRECTORY.'modules/'.$mod.'/';

			$i=0;
			foreach($listPictures as $pi){
					
				$tmp['idPhoto'] = $pi->getIdMandatePicture();
				$tmp['name'] = $pi->getName();
				$tmp['position'] = !empty($post['position_'.$pi->getIdMandatePicture()])?$post['position_'.$pi->getIdMandatePicture()]:'';
				$i++;
				$listPictureWithPosition[] = $tmp;

			}

			$listPictureWithPosition = Tools::sort_by_key($listPictureWithPosition,'position');

			// Affichage de toute les images, (avec un champs caché dessous )
			$this->_title = 'Fiche image';
			$this->_template = dirname(__FILE__).'/views/ficheImage.tpl';
			$this->_smarty->assign('chemImage',$chemImage);
			$this->_smarty->assign('listPictures',$listPictureWithPosition);
			//$post['noEmpty']='noEmpty';
			//var_dump($listPictureWithPosition);
			if(!empty( $post )){
				// Initialisation du pdf, avec titre et numéro de mandat.
				$fpdf = new PdfFicheImage;
				$fpdf->AliasNbPages();

				$fpdf->SetTopMargin(74);
				$fpdf->SetLeftMargin(34);
				$fpdf->SetRightMargin(38);
				$fpdf->AddPage();

				$fpdf->SetFont('times','',$size);
				$fpdf->Cell(0,5, strtoupper($mandate->getMandateType()->getName()) .' - SECTEUR '.$mandate->getSector()->getName(),0,0,'C',0,0,'C');
				$fpdf->ln();
				$fpdf->Cell(0,5,'Mandat : '.$mandate->getNumberMandate(),0,0,'C');
				$fpdf->ln(22);
				// Boucle sur les photos, photos insérées dans une cellule Cell() avec bordure
				$i=0;
				$fpdf->SetTopMargin(35);
				// récuperation du chemin complet
				foreach($listPictureWithPosition as $p){
					// si l'image possede une position
					if(!empty($p['position'])){
						$i++;
							
						// Corrige le bug qui affichait une image en bas de page avant le changement de ladite page.
						if($fpdf->getY()>215){
							$fpdf->AddPage();
							//$fpdf->setY(35);
						}
						$fpdf->Cell(67,50,    $fpdf->Image( $chemImage.$p['name'] ,$fpdf->getX(),$fpdf->getY(),67,50,'jpg') ,1,0);
						$fpdf->Cell(4,50,'',0,0);
						// un coup sur 2
						if($i%2==0){
							$fpdf->ln();
							$fpdf->Cell(0,5,'',0,2);
						}
					}
				}
				// pieds de page (automatique) contenant le numéro de mandat et page x/n
				$fpdf->output();
			}
		}if(isset($get['page'])&&$get['page']=='lettreSru'){

			$this->_title = 'Lettre SRU';

			$mandate = Mandate::load($this->_pdo, $get['action']);

			$rapp = BddRapprochement::loadByMandateR($this->_pdo, $mandate);
			$acq = $rapp->getAcquereur();

			$doc = Documents::load($this->_pdo,11);
			if($doc==null){

				$doc = Documents::createId($this->_pdo, 11);
				$doc->setOther('Le directeur,',false);
				$doc->setSizetext(12,false);
				$doc->setCorps(
"
[u]Affaire suivie par : [/u][prenomDemarcheur] [nomDemarcheur]
				
[u]Vente d'un bien situé au :[/u] [adresseBien] [cpBien] [villeBien]
				
[civiliteAcquereur] [nomAcquereur],
				
     Nous avons le plaisir de vous informer, que les vendeurs ont contresigné l'avant-contrat d'engagement des parties.
				     
	 Conformément à la loi n° 2000-1208 du 13 décembre 2000 dite SRU concernant votre droit de rétractation, nous vous prions de trouver ci-joint, une copie de l'avant-contrat vous revenant.
				     
	 Nous écrivons à notre notaire chargé de la vente, qui prendra directement contact avec vous.
				     
	 Vous souhaitant une bonne réception de la présente et restant à votre entière disposition pour tous renseignements complémentaires que vous pouriez souhaiter, nous vous prions de croire, [civiliteAcquereur] [nomAcquereur] en l'assurance de nos sentiments distingués."
				
				,false);
				$doc->update();
					
			}


			$signature = $this->_replace($doc->getOther(),$mandate);
			$corps = $this->_replace($doc->getCorps(),$mandate);


			$entete['civilite'] =  $acq->getTitreAcquereur()->getName();
			$entete['prenom']= $acq->getFirstName();
			$entete['nom']= $acq->getName();
			$entete['adresse']= $acq->getAddress();
			$entete['cp']= $acq->getVilleAcquereur()->getZipCode();
			$entete['ville']= $acq->getVilleAcquereur()->getName();
			$entete['villeAgence']=$this->_user->getAgency()->getName();
			$entete['date']= date('d/m/Y');
			$size = $doc->getSizetext();


			if(empty($post)){
				$this->_title = 'Lettre SRU';
					


				$this->_template = dirname(__FILE__).'/views/pre_gen.tpl';

				$this->_smarty->assign('dateDoc',date(Constant::DATE_FORMAT2) );
				$this->_smarty->assign('sizeTypo',$doc->getSizetext() );
				$this->_smarty->assign('corps',$this->_replace($doc->getCorps() ,$mandate));

				$this->_smarty->assign('signature',$this->_replace($doc->getOther(),$mandate) );
				$this->_smarty->assign('h1',$this->_title );
			}else{
				$corps = $post['corps'];
				$signature = $post['signature'];
				$size = $post['size'];
				$this->_courrierDefaut($entete,$corps,$signature,$size);
			}


		}if(isset($get['page'])&&$get['page']=='avenant_modif_type'){
			// Avec acq .... (courier commun, ne peut s'imprimer que si le mandat est rapproché)
			$mandate = Mandate::load($this->_pdo,$get['action']);




			$doc = Documents::load($this->_pdo,13);
			// document à loader.
			if($doc==null){
				$doc = Documents::createId($this->_pdo,13);
			}
			if( $doc->getCorps() == ''){
				/*
					<titreVendeur>','<nomVendeur>','<prenomVendeur>','<debutMandat>',
				'<typeBien>','<prenomDemarcheur>','<nomDemarcheur>','<adresseBien>',
				'<cpBien>','<villeBien>','<numeroMandat>
				*/
				$doc->setCorps(
"
[u]Affaire suivie par[/u] : [prenomDemarcheur] [nomDemarcheur]
					
					
[titreVendeur] [nomVendeur],


Pour faire suite à notre dernier contact, et comme convenu, nous vous prions de bien vouloir trouver ci-après un avenant concernant les conditions de vente de votre bien immobilier :

[u]PAR LE PRESENT AVENANT, il a été convenu ce qui suit[/u] : 
Mandat N° [numeroMandat]

[bu]MODIFICATION DU TYPE DE MANDAT[/bu] : 

Bien situé au : 	[adresseBien]
	[cpBien] [villeBien]

Le mandataire accepte que le mandat « Accord » semi-exclusif signé le [debutMandat] et portant le n° [numeroMandat] soit transformé en mandat « simple » sans exclusivité.


Toutes autres clauses, conditions et stipulations dudit mandat restant inchangées.

Pour faire valoir ce que de droit.


"
				,false);
				$doc->setOther(
'[u]Le MANDANT[/u] : 			                                                 [u]Le MANDATAIRE[/u] : 
',false);
				$doc->update();
			}


			$signature = $this->_replace($doc->getOther(),$mandate);
			$corps = $this->_replace($doc->getCorps(),$mandate);
			$vendeur = $mandate->getDefaultSeller();
			$entete['civilite'] =  $vendeur->getSellerTitle()->getLibel();
			$entete['prenom']= $vendeur->getFirstName();
			$entete['nom']= $vendeur->getName();
			$entete['adresse']= $vendeur->getAddress();
			$entete['cp']= $vendeur->getCity()->getZipCode();
			$entete['ville']= $vendeur->getCity()->getName();
			$entete['villeAgence']=$this->_user->getAgency()->getName();
			$entete['date']= date('d/m/Y');
			$size = $doc->getSizetext();
			if(empty($post)){
				$this->_title = 'Changement de type';



				$this->_template = dirname(__FILE__).'/views/pre_gen.tpl';

				$this->_smarty->assign('dateDoc',date(Constant::DATE_FORMAT2) );
				$this->_smarty->assign('sizeTypo',$doc->getSizetext() );
				$this->_smarty->assign('corps',$this->_replace($doc->getCorps() ,$mandate));

				$this->_smarty->assign('signature',$this->_replace($doc->getOther(),$mandate) );
				$this->_smarty->assign('h1',$this->_title );
			}else{
				$corps = $post['corps'];
				$signature = $post['signature'];
				$size = $post['size'];
				$this->_courrierDefaut($entete,$corps,$signature,$size,'L');
			}
		}if(isset($get['page'])&&$get['page']=='avenant_baisse_prix'){
			// Avec acq .... (courier commun, ne peut s'imprimer que si le mandat est rapproché)
			$mandate = Mandate::load($this->_pdo,$get['action']);




			$doc = Documents::load($this->_pdo,14);
			// document à loader.
			if($doc==null){
				$doc = Documents::createId($this->_pdo,14);
			}
			if( $doc->getCorps() == ''){
				/*
					<titreVendeur>','<nomVendeur>','<prenomVendeur>','<debutMandat>',
				'<typeBien>','<prenomDemarcheur>','<nomDemarcheur>','<adresseBien>',
				'<cpBien>','<villeBien>','<numeroMandat>
				*/
				$doc->setCorps(
"
[u]Affaire suivie par[/u] : [prenomDemarcheur] [nomDemarcheur]
					
					
[titreVendeur] [nomVendeur],


Pour faire suite à notre dernier contact, et comme convenu, nous vous prions de bien vouloir trouver ci-après un avenant concernant le prix de vente de votre bien immobilier :

[u]PAR LE PRESENT AVENANT, il a été convenu ce qui suit[/u] : 
Mandat N° [numeroMandat]

[bu]BAISSE  DE PRIX[/bu] : 

Bien situé au : 	[adresseBien]
	[cpBien] [villeBien]

Les mandants mandatent par la présente le mandataire pour vendre le bien ci-dessus désigné au nouveau prix de vente de [b][prixMandat] euros[/b] commission d'agence incluse, soit  [b][prixNetVendeur] €[/b] net vendeur,  conformément à notre barème.

Ledit prix de vente annulant et remplaçant l'ancien prix stipulé aux termes du mandat 
n° [numeroMandat] du [debutMandat]

Toutes autres clauses, conditions et stipulations dudit mandat  restant inchangées dans les termes d'un mandat simple classique.
"
				,false);
				$doc->setOther(
'[u]Les MANDANTS[/u] : 
			                                                              Signature,
',false);
				$doc->update();
			}


			$signature = $this->_replace($doc->getOther(),$mandate);
			$corps = $this->_replace($doc->getCorps(),$mandate);
			$vendeur = $mandate->getDefaultSeller();
			$entete['civilite'] =  $vendeur->getSellerTitle()->getLibel();
			$entete['prenom']= $vendeur->getFirstName();
			$entete['nom']= $vendeur->getName();
			$entete['adresse']= $vendeur->getAddress();
			$entete['cp']= $vendeur->getCity()->getZipCode();
			$entete['ville']= $vendeur->getCity()->getName();
			$entete['villeAgence']=$this->_user->getAgency()->getName();
			$entete['date']= date('d/m/Y');
			$size = $doc->getSizetext();
			if(empty($post)){
				$this->_title = 'Avennant baisse de prix';



				$this->_template = dirname(__FILE__).'/views/pre_gen.tpl';

				$this->_smarty->assign('dateDoc',date(Constant::DATE_FORMAT2) );
				$this->_smarty->assign('sizeTypo',$doc->getSizetext() );
				$this->_smarty->assign('corps',$this->_replace($doc->getCorps() ,$mandate));

				$this->_smarty->assign('signature',$this->_replace($doc->getOther(),$mandate) );
				$this->_smarty->assign('h1',$this->_title );
			}else{
				$corps = $post['corps'];
				$signature = $post['signature'];
				$size = $post['size'];
				$this->_courrierDefaut($entete,$corps,$signature,$size,'L');
			}
		}
	}


	/**
	 *
	 * @param Array $entete
	 * @param String $corps
	 * @param String $signature
	 */
	private function _courrierDefaut($entete,$corps,$signature,$size,$posSignagture = null){
		$fpdf = new  fpdf_multicelltag();
		// style à utiliser : <u>à souligner</u> sougnera l'interieur des balises
		$fpdf->SetStyle("u","times","u",$size,"0,0,0");
		$fpdf->SetStyle("i","times","i",$size,"0,0,0");
		$fpdf->SetStyle("b","times","b",$size,"0,0,0");
		$fpdf->SetStyle("bi","times","bi",$size,"0,0,0");
		$fpdf->SetStyle("bu","times","bu",$size,"0,0,0");
		$fpdf->SetStyle("iu","times","iu",$size,"0,0,0");
		$fpdf->SetStyle("biu","times","biu",$size,"0,0,0");
		$fpdf->SetStyle("rouge","times","",$size,"255,0,0");
		$fpdf->SetTopMargin(57);
		$fpdf->AddPage();
		$fpdf->Cell(95);
		$fpdf->SetFont('times','',$size);
		$fpdf->Cell(0,5,utf8_decode($entete['civilite'].' '.$entete['nom'] ),0,2);
		$fpdf->Cell(0,5,utf8_decode($entete['adresse'] ),0,2);
		$fpdf->Cell(0,5,utf8_decode($entete['cp'].' '.$entete['ville'] ),0,2);
		$fpdf->ln(12);
		$fpdf->Cell(108);
		$fpdf->Cell(0,5,utf8_decode($entete['villeAgence'].', le '.$entete['date'] ),0,2);
		$fpdf->ln(10);
		$fpdf->SetLeftMargin(25);
		//$fpdf->MultiCellTag( 152,5,utf8_decode(  $corps ));
		//$fpdf->MultiCellTag( 152,5,utf8_decode( str_replace('€', utf8_encode(chr(128)), $corps) ));
		$fpdf->MultiCellTag( 152,5,utf8_decode( Tools::replaceSpecialCharByIso( $corps) ));

		$fpdf->ln(6);
		if($posSignagture==null){
			$fpdf->Cell(90);
			$fpdf->MultiCellTag(70,5,utf8_decode( $signature ),0,'L');
		}else{
			$fpdf->MultiCellTag(0,5,utf8_decode( $signature ),0,$posSignagture);
		}
		$fpdf->Output();
	}

	private function _replace($txt,Mandate $mandate = null,$acquereur =null){

		$ret=  str_replace(
		array('[u]','[/u]','[i]','[/i]','[b]','[/b]','[bi]','[/bi]','[bu]','[/bu]','[iu]','[/iu]','[biu]','[/biu]','[titreVendeur]','[nomVendeur]','[prenomVendeur]','[debutMandat]','[typeBien]','[prenomDemarcheur]','[nomDemarcheur]','[rouge]','[/rouge]','[adresseBien]','[cpBien]','[villeBien]','[numeroMandat]','[dateVisite]','[civiliteAcquereur]','[nomAcquereur]','[prenomAcquereur]','[impressionVisite]','[adresseAcquereur]','[cpAcquereur]','[villeAcquereur]','[estimationMini]','[estimationMaxi]','[h1]','[/h1]','[honorairesTTC]','[nomNotaireVendeur]','[nomNotaireAcq]','[compteRenduVisite]','[prixMandat]','[prixNetVendeur]'),
		array('<u>','</u>','<i>','</i>','<b>','</b>','<bi>','</bi>','<bu>','</bu>','<iu>','</iu>','<biu>','</biu>','<titreVendeur>','<nomVendeur>','<prenomVendeur>','<debutMandat>','<typeBien>','<prenomDemarcheur>','<nomDemarcheur>','<rouge>','</rouge>','<adresseBien>','<cpBien>','<villeBien>','<numeroMandat>','<dateVisite>','<civiliteAcquereur>','<nomAcquereur>','<prenomAcquereur>','<impressionVisite>','<adresseAcquereur>','<cpAcquereur>','<villeAcquereur>','<estimationMini>','<estimationMaxi>','<h1>','</h1>','<honorairesTTC>','<nomNotaireVendeur>','<nomNotaireAcq>','<compteRenduVisite>','<prixMandat>','<prixNetVendeur>'),
		$txt);

		if($mandate){
			$seller = $mandate==null?null: $mandate->getDefaultSeller();



			$rapp =$acquereur==null? BddRapprochement::loadByMandateR($this->_pdo,$mandate):BddRapprochement::loadByMandateAndAcquereur($this->_pdo, $mandate, $acquereur);

			$ret = str_replace(
			array('<titreVendeur>','<nomVendeur>','<prenomVendeur>','<debutMandat>','<typeBien>','<prenomDemarcheur>','<nomDemarcheur>','<adresseBien>','<cpBien>','<villeBien>','<numeroMandat>','<estimationMini>','<estimationMaxi>','<honorairesTTC>','<nomNotaireVendeur>','<nomNotaireAcq>','<prixMandat>','<prixNetVendeur>'),
			array($seller->getSellerTitle()->getLibel(),$seller->getName(),$seller->getFirstname(),date(Constant::DATE_FORMAT2,$mandate->getInitDate()),$mandate->getMandateType()->getName(),$mandate->getUser()->getFirstName(),$mandate->getUser()->getName(),$mandate->getAddress(),$mandate->getCity()->getZipCode(),$mandate->getCity()->getName(),$mandate->getNumberMandate(),Tools::grosNombre(round($mandate->getEstimationFai(),0)),Tools::grosNombre(round($mandate->getEstimationMaxi(),0)),Tools::grosNombre(round($mandate->getCommission() ,0)), $mandate->getNotary()->getName(),$mandate->getNotaryAcq()?$mandate->getNotaryAcq()->getName():'',Tools::grosNombre(round($mandate->getPriceFai() ,0)),Tools::grosNombre(round($mandate->getPriceSeller() ,0)) ),
			$ret);
			if($rapp){
				$compteRenduVisite = '';
				//$rapp->getPointsPositifs() ;
				//$rapp->pointsNegatifs() ;
				if($rapp->getPointsPositifs()!=''){
					$compteRenduVisite .=
'
     <b>Points positifs :</b> 
     '.$rapp->getPointsPositifs();
				}
				if($rapp->getPointsNegatifs()!=''){
					$compteRenduVisite .=
'
     <b>Points négatifs :</b> 
     '.$rapp->getPointsNegatifs();
				}
				$acq = $rapp->getAcquereur();
				$ret = str_replace(
				array('<dateVisite>','<civiliteAcquereur>','<nomAcquereur>','<prenomAcquereur>','<impressionVisite>','<adresseAcquereur>','<cpAcquereur>','<villeAcquereur>','<compteRenduVisite>'),
				array(date(Constant::DATE_FORMAT2,$rapp->getDateVisite()),$acq->getTitreAcquereur()->getName(),$acq->getName(),$acq->getFirstname(),$rapp->getResultat(),$acq->getAddress(),$acq->getVilleAcquereur()->getZipCode(),$acq->getVilleAcquereur()->getName(),$compteRenduVisite ),
				$ret);
			}
		}
		return $ret;
	}

	private function _etudesMaitre(Mandate $mandate,Documents $doc,$post = array()){
			
			
		$this->_template = dirname(__FILE__).'/views/pre_gen.tpl';
			
		$this->_smarty->assign('dateDoc',date(Constant::DATE_FORMAT2) );
		$this->_smarty->assign('sizeTypo',$doc->getSizetext() );

		$this->_smarty->assign('corps',$this->_replace($doc->getCorps() ,$mandate));
		$this->_smarty->assign('signature',$doc->getOther() );
		$this->_smarty->assign('h1',$this->_title );
		if(!empty($post['generate'])){

			$size = $post['sizeTypo'];
			$date = $post['dateDoc'];
			$fpdf = new  fpdf_multicelltag();
			// style à utiliser : <u>à souligner</u> sougnera l'interieur des balises
			$fpdf->SetStyle("u","times","u",$size,"0,0,0");
			$fpdf->SetStyle("i","times","i",$size,"0,0,0");
			$fpdf->SetStyle("b","times","b",$size,"0,0,0");
			$fpdf->SetStyle("bi","times","bi",$size,"0,0,0");
			$fpdf->SetStyle("bu","times","bu",$size,"0,0,0");
			$fpdf->SetStyle("iu","times","iu",$size,"0,0,0");
			$fpdf->SetStyle("biu","times","biu",$size,"0,0,0");
			$fpdf->SetStyle("rouge","times","",$size,"255,0,0");

			$fpdf->SetTopMargin(63.5);
			$fpdf->AddPage();
			$fpdf->Cell(100);
			$fpdf->SetFont('times','B',$size);
			if($_GET['page']=='etudeMaitreAcquereurs'){
				if($mandate->getNotaryAcq()){
					$fpdf->Cell(0,5,utf8_decode('Etude de maître '.$mandate->getNotaryAcq()->getName().' '.$mandate->getNotaryAcq()->getFirstname()),0,2);
					$fpdf->SetFont('times','',$size);
					$fpdf->Cell(0,5,utf8_decode($mandate->getNotaryAcq()->getAddress() ),0,2);
					$fpdf->Cell(0,5,utf8_decode($mandate->getNotaryAcq()->getZipCode().' '.strtoupper( $mandate->getNotaryAcq()->getCity() )));
				}else
				$fpdf->Cell(0,5,utf8_decode('Etude de maître '),0,2);
			}else{
				$fpdf->Cell(0,5,utf8_decode('Etude de maître '.$mandate->getNotary()->getName().' '.$mandate->getNotary()->getFirstname()),0,2);
					
				$fpdf->SetFont('times','',$size);
				$fpdf->Cell(0,5,utf8_decode($mandate->getNotary()->getAddress() ),0,2);
				$fpdf->Cell(0,5,utf8_decode($mandate->getNotary()->getZipCode().' '.strtoupper( $mandate->getNotary()->getCity() )));
			}

			$fpdf->ln(11);
			$fpdf->Cell(100);
			$fpdf->Cell(0,5,utf8_decode(ucfirst(strtolower($mandate->getUser()->getAgency()->getName()))).', le '.$date );
			$fpdf->SetLeftMargin(22);
			$fpdf->ln(22);
			$fpdf->SetFont('times','U',$size);
			$fpdf->cell(33,4,'Affaire suivie par : ');
			$fpdf->SetFont('times','B',$size);
			$fpdf->cell(33,4,$mandate->getUser()->getFirstname().' '.$mandate->getUser()->getName());
			$fpdf->ln(10);
			$fpdf->SetFont('times','U',$size);
			$fpdf->cell(45,4,utf8_decode('Vente d\'un bien situé au  : '),0,2);
			$fpdf->cell(46);
			$fpdf->SetFont('times','B',$size);
			$fpdf->cell(0,5,utf8_decode($mandate->getAddress()),0,2);
			$fpdf->cell(0,5,utf8_decode($mandate->getCity()->getZipCode().' '.$mandate->getCity()->getName()),0,2);
			$fpdf->ln(13);
			$fpdf->setRightMargin(19);
			$fpdf->SetFont('times','',$size);
			$fpdf->MultiCellTag( 152,5,utf8_decode($post['corps'] ));
			$fpdf->ln(7);
			$fpdf->cell(76);
			$fpdf->cell(0,5,$post['signature']);
			$fpdf->ln(22);
			$fpdf->SetFont('times','B',$size);
			$fpdf->cell(0,5,'P.J. : ENGAGEMENT DES PARTIES');
			$fpdf->Output();
		}

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
		//		var_dump($this->_user);
		$this->_smarty->assign('mainMenu',$this->getMainMenu($this->_user ));
	}
	private function _addMenu($module){
		$this->_smarty->assign('menu',$this->getMenu($this->_user ,$module ) );
	}
}
