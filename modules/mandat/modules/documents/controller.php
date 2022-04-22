<?php
class Module_Controller_documents implements interfaceModuleController{
	private $_smarty;
	private $_pdo;
	private $_user;
	private $_errorLoadModule;
	private $_isCompromis;
	public function __construct( $_pdo,$_smarty ){
		$this->_errorLoadModule = array();
		is_file(Constant::DEFAULT_MODULE_DIRECTORY. 'documents/model/requires.php')?require_once Constant::DEFAULT_MODULE_DIRECTORY. 'documents/model/requires.php':$this->_errorLoadModule[] = 'Le module "documents" est manquant.';
		$this->_pdo = $_pdo;
		$this->_isCompromis=false;
		$this->_smarty = $_smarty;
		$this->_user = User::unserialize($this->_pdo,$_SESSION['user']);
		$this->treatment();
	}
	private function treatment(){
		if(empty($this->_errorLoadModule)){

			// Fiche
			// hook du menu
			$this->addHook('hook_blockLeftMandate',dirname(__FILE__).'/views/linkFicheVierge.tpl');

			if((isset($_GET['page'] ) && $_GET['page']=='imprFicheVierge')){

				// on inclut la sous classe concernée
				// 				$fpdf = new PdfClassic();
				// 				$fpdf->ContentHeader= 'FICHE MANDAT';
				// 				$fpdf->ContentFooter= 'imprimé le : '.date(Constant::DATE_FORMAT2);
				// 				$fpdf->AliasNbPages();

				// 				$fpdf->SetTopMargin(10);
				// 				$fpdf->SetLeftMargin(10);
				// 				$fpdf->SetRightMargin(10);
				// 				$fpdf->AddPage();
				// 				$fpdf->SetFont('times','B',20);
				// 				$fpdf->Cell(0,0,'Utilisateur : ');
				// 				$fpdf->SetFont('times','',12);

				// 				$fpdf->Output();
				/*
				*  <p><input type="checkbox"> test</p>
				<p><input type="radio"> test</p>
				<p><input type="text"> test</p>
				*/
				$flux = '
				
				<style type="text/css">
<!--
    h1 {}
    h2 {}
    h3 {}
	.dte{text-align:right;}
    .clear{clear:both;}
    .center{text-align:center;}
    #user,#tt,.classic{word-wrap: break-word;width:100%;}
	#user span,#tt span,.classic span{margin-left:30px;}
	#tblDescription td,#tblDescription th {height:20px;text-align:center}
	#imgHeader{position:absolute;top:0;left:0;}
    
-->
</style>

		<page backtop="30mm" backbottom="30mm" backleft="0mm" backright="0mm"> 
        <page_header>';
		$flux.='<h1 class="center">Fiche Bien</h1> ';
        if($this->_user->getAgency()->getLogoAfficheMandat())
        	$flux.='<img id="imgHeader" src="'.Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.'user/'.$this->_user->getAgency()->getLogoAfficheMandat().'" width="90">';
        
             
        $flux.='</page_header> 
        <page_footer>
             <table style="width: 100%"    cellspacing="0"><tr><td style="width: 50%">Édité le  '.date(Constant::DATE_FORMAT2).' par Immo-manageur </td><td  class="dte" style="width: 50%">page [[page_cu]]/[[page_nb]]</td></tr></table>
        </page_footer> ';
				
				$flux.='<table table style="width: 100%" ;   cellspacing="0"><tr><td style="width: 100%">';
				$flux.='<h2>Utilisateur : </h2>
						<table style="width: 100%" ;   cellspacing="0"><tr>
						';
				$i=0;
				foreach(User::loadAll($this->_pdo) as $elem ){
					if(($i%5==0)&&($i!=0))$flux.='</tr><tr>';
					$i++;
// 					$flux.='<td style="width: 20%"><input id="user_'.$i.'" type="radio"><label for="user_'.$i.'"> '.$elem->getFirstname().' '.$elem->getName().'</label></td>';
					$flux.='<td style="width: 20%"> <img src="'.Constant::DEFAULT_URL_PICTURE_DIRECTORY.'radio.png" alt="" > '.$elem->getFirstname().' '.$elem->getName().'</td>';
				}
				$flux.='</tr></table>';
				$flux.='</td></tr></table>';
				
				
				
				$flux.='<table table style="width: 100%" ;   cellspacing="0"><tr><td style="width: 100%">';
				$flux.='<h2>Général :</h2>';
				$flux.='<h3>Type de transaction : </h3>
			<table style="width: 100%" ;   cellspacing="0"><tr>
			';
				$i=0;
				foreach(TransactionType::loadAll($this->_pdo) as $elem ){
					if(($i%5==0)&&($i!=0))$flux.='</tr><tr>';
					$i++;
					$flux.='<td style="width: 20%"><img src="'.Constant::DEFAULT_URL_PICTURE_DIRECTORY.'radio.png" alt="" > '.$elem->getName().'</td>';
				}
				$flux.='</tr></table>';
				$flux.='</td></tr></table>';
				
				
				
				$flux.='<table table style="width: 100%" ;   cellspacing="0"><tr><td style="width: 100%">';
				$flux.='<h3>Type Bien : </h3>
			<table style="width: 100%" ;   cellspacing="0"><tr>
			';
				$i=0;
				foreach(MandateType::loadAll($this->_pdo) as $elem ){
					if(($i%5==0)&&($i!=0))$flux.='</tr><tr>';
					$i++;
					$flux.='<td style="width: 20%"><img src="'.Constant::DEFAULT_URL_PICTURE_DIRECTORY.'radio.png" alt="" > '.$elem->getName().'</td>';
				}
				$flux.='</tr></table>';
				$flux.='</td></tr></table>';
				
				
				
				$flux.='<table table style="width: 100%" ;   cellspacing="0"><tr><td style="width: 100%">';
				$flux.='<h3>Nature : </h3>
							<table style="width: 100%" ;   cellspacing="0"><tr>
							';
				$i=0;
				foreach(MandateNature::loadAll($this->_pdo) as $elem ){
					if(($i%5==0)&&($i!=0))$flux.='</tr><tr>';
					$i++;
					$flux.='<td style="width: 20%"><img src="'.Constant::DEFAULT_URL_PICTURE_DIRECTORY.'radio.png" alt="" > '.$elem->getName().'</td>';
				}
				$flux.='</tr></table>';
					
				$flux.='<h3>Tarif : </h3><p>Loyer ou prix ( souhaité) : ...................................</p>';
				$flux.='</td></tr></table>';
				
				
				
				$flux.='<table table style="width: 100%" ;   cellspacing="0"><tr><td style="width: 100%">';
				$flux.='<h2>Vendeur : </h2>';

				$flux.='<table style="width: 100%" ;   cellspacing="0"><tr>';
				$i=0;
				foreach(SellerTitle::loadAll($this->_pdo) as $elem ){
					if(($i%5==0)&&($i!=0))$flux.='</tr><tr>';
					$i++;
					$flux.='<td style="width: 20%"><img src="'.Constant::DEFAULT_URL_PICTURE_DIRECTORY.'radio.png" alt="" > '.$elem->getLibel().'</td>';
				}
				$flux.='</tr></table>';
				$flux.='<p>Nom : ............................................................................................ Prénom : ................................................................................</p>';
				$flux.='<p>Adresse : .......................................................................................................................................................................................</p>';
				$flux.='<p>.......................................................................................................................................................................................................</p>';
				$flux.='<p>Code postal : ................................................. Ville : .....................................................................................................................</p>';
				$flux.='<p>Tél : .................................................... Portable : .................................................... Tél travail : ..................................................</p>';
				$flux.='<p>Fax : .................................................... Email : .............................................................................................................................</p>';
				$flux.='</td></tr></table>';
				
				
				
				
				$flux.='<table table style="width: 100%" ;   cellspacing="0"><tr><td style="width: 100%">';
				$flux.='<h2>Informations sur le bien</h2>';
				$flux.='<h3>Notaire : </h3><table style="width: 100%" ;   cellspacing="0"><tr>';
				$i=0;
				foreach(Notary::loadAll($this->_pdo) as $elem ){
					if(($i%5==0)&&($i!=0))$flux.='</tr><tr>';
					$i++;
					$flux.='<td style="width: 20%"><img src="'.Constant::DEFAULT_URL_PICTURE_DIRECTORY.'radio.png" alt="" > '.$elem->getFirstname().' '.$elem->getName().'</td>';
				}
				$flux.='</tr></table>';
				$flux.='<p>Numéro du mandat : ...................................</p>';
				$flux.='<p>Début du mandat : ...... /...... / ............ Fin du mandat : ...... /...... / ...........</p>';
				$flux.='</td></tr></table>';
				
				
				
				$flux.='<table table style="width: 100%" ;   cellspacing="0"><tr><td style="width: 100%">';
				$flux.='<h3>Bien : </h3>';
				$flux.='<p>Adresse du bien : ..........................................................................................................................................................................</p>';
				$flux.='<p>.......................................................................................................................................................................................................</p>';
				$flux.='<p>Code postal : ................................................. Ville : .....................................................................................................................</p>';
				$flux.='<p>Superficie totale : ....................................... Surf. habitable  : ................................... Surf. pièce vie : ..........................................</p>';
				$flux.='<p>CES : ........................................................................................ GES : ........................................................................................</p>';
				$flux.='<p>Nb. pièces : ............................................................................ Nb.Chambres : ............................................................................</p>';
				$flux.='<p>Niveau : ........................................................................... Année construction : ..........................................................................</p>';
				$flux.='<p>Charges mensuelles : .................................. Taxes foncières  : .................................. Taxes habitation : ...................................</p>';
				$flux.='</td></tr></table>';
				
				$flux.='<table table style="width: 100%" ;   cellspacing="0"><tr><td style="width: 100%">';
				$flux.='<h3>Équipements</h3>';
				$flux.='<table style="width: 100%" ;   cellspacing="0"><tr>';
				$flux.='<td style="width: 20%"><img src="'.Constant::DEFAULT_URL_PICTURE_DIRECTORY.'checkbox.png" alt="" > Carrière </td>';
				$flux.='<td style="width: 20%"><img src="'.Constant::DEFAULT_URL_PICTURE_DIRECTORY.'checkbox.png" alt="" > Cave </td>';
				$flux.='<td style="width: 20%"><img src="'.Constant::DEFAULT_URL_PICTURE_DIRECTORY.'checkbox.png" alt="" > Cheminée </td>';
				$flux.='<td style="width: 20%"><img src="'.Constant::DEFAULT_URL_PICTURE_DIRECTORY.'checkbox.png" alt="" > Cuisine amenagée </td>';
				$flux.='<td style="width: 20%"><img src="'.Constant::DEFAULT_URL_PICTURE_DIRECTORY.'checkbox.png" alt="" > Cuisine équipée </td>';
				$flux.='</tr><tr>';
				$flux.='<td style="width: 20%"><img src="'.Constant::DEFAULT_URL_PICTURE_DIRECTORY.'checkbox.png" alt="" > Dépendance </td>';
				$flux.='<td style="width: 20%"><img src="'.Constant::DEFAULT_URL_PICTURE_DIRECTORY.'checkbox.png" alt="" > Garage</td>';
				$flux.='<td style="width: 20%"><img src="'.Constant::DEFAULT_URL_PICTURE_DIRECTORY.'checkbox.png" alt="" > Gaz </td>';
				$flux.='<td style="width: 20%"><img src="'.Constant::DEFAULT_URL_PICTURE_DIRECTORY.'checkbox.png" alt="" > Mezzanine </td>';
				$flux.='<td style="width: 20%"><img src="'.Constant::DEFAULT_URL_PICTURE_DIRECTORY.'checkbox.png" alt="" > Parking </td>';
				$flux.='</tr><tr>';
				$flux.='<td style="width: 20%"><img src="'.Constant::DEFAULT_URL_PICTURE_DIRECTORY.'checkbox.png" alt="" > Piscine </td>';
				$flux.='<td style="width: 20%"><img src="'.Constant::DEFAULT_URL_PICTURE_DIRECTORY.'checkbox.png" alt="" > Piscine intérieure </td>';
				$flux.='<td style="width: 20%"><img src="'.Constant::DEFAULT_URL_PICTURE_DIRECTORY.'checkbox.png" alt="" > Plain pied </td>';
				$flux.='<td style="width: 20%"><img src="'.Constant::DEFAULT_URL_PICTURE_DIRECTORY.'checkbox.png" alt="" > Rez de jardin </td>';
				$flux.='<td style="width: 20%"><img src="'.Constant::DEFAULT_URL_PICTURE_DIRECTORY.'checkbox.png" alt="" > Point eau </td>';
				$flux.='</tr><tr>';
				$flux.='<td style="width: 20%"><img src="'.Constant::DEFAULT_URL_PICTURE_DIRECTORY.'checkbox.png" alt="" > Sous sol </td>';
				$flux.='<td style="width: 20%"><img src="'.Constant::DEFAULT_URL_PICTURE_DIRECTORY.'checkbox.png" alt="" > Terrasse </td>';
				$flux.='<td style="width: 20%"><img src="'.Constant::DEFAULT_URL_PICTURE_DIRECTORY.'checkbox.png" alt="" > Tout à l\'égout </td>';
				$flux.='</tr></table>';
				$flux.='</td></tr></table>';

				// Bien
				$flux.='<table table style="width: 100%" ;   cellspacing="0"><tr><td style="width: 100%">';
				$flux.='<h3>Isolation : </h3>
							<table style="width: 100%" ;   cellspacing="0"><tr>
							';
				$i=0;
				foreach(MandateInsulation::loadAll($this->_pdo) as $elem ){
					if(($i%5==0)&&($i!=0))$flux.='</tr><tr>';
					$i++;
					$flux.='<td style="width: 20%"><img src="'.Constant::DEFAULT_URL_PICTURE_DIRECTORY.'radio.png" alt="" > '.$elem->getName().'</td>';
				}
				$flux.='</tr></table>';
				$flux.='</td></tr></table>';
				
				
				
				$flux.='<table table style="width: 100%" ;   cellspacing="0"><tr><td style="width: 100%">';
				$flux.='<h3>Toiture : </h3>
											<table style="width: 100%" ;   cellspacing="0"><tr>
											';
				$i=0;
				foreach(MandateRoof::loadAll($this->_pdo) as $elem ){
					if(($i%5==0)&&($i!=0))$flux.='</tr><tr>';
					$i++;
					$flux.='<td style="width: 20%"><img src="'.Constant::DEFAULT_URL_PICTURE_DIRECTORY.'radio.png" alt="" > '.$elem->getName().'</td>';
				}
				$flux.='</tr></table>';
				$flux.='</td></tr></table>';
				
				
				$flux.='<table table style="width: 100%" ;   cellspacing="0"><tr><td style="width: 100%">';
				$flux.='<h3>Chauffage : </h3>
											<table style="width: 100%" ;   cellspacing="0"><tr>
											';
				$i=0;
				foreach(MandateHeating::loadAll($this->_pdo) as $elem ){
					if(($i%5==0)&&($i!=0))$flux.='</tr><tr>';
					$i++;
					$flux.='<td style="width: 20%"><img src="'.Constant::DEFAULT_URL_PICTURE_DIRECTORY.'radio.png" alt="" > '.$elem->getName().'</td>';
				}
				$flux.='</tr></table>';
				$flux.='</td></tr></table>';
				
				
				$flux.='<table table style="width: 100%" ;   cellspacing="0"><tr><td style="width: 100%">';
				$flux.='<h3>Parties communes : </h3>
											<table style="width: 100%" ;   cellspacing="0"><tr>
											';
				$i=0;
				foreach(MandateCommonOwnership::loadAll($this->_pdo) as $elem ){
					if(($i%5==0)&&($i!=0))$flux.='</tr><tr>';
					$i++;
					$flux.='<td style="width: 20%"><img src="'.Constant::DEFAULT_URL_PICTURE_DIRECTORY.'radio.png" alt="" > '.$elem->getName().'</td>';
				}
				$flux.='</tr></table>';
				$flux.='</td></tr></table>';
				
				
				
				
				$flux.='<table table style="width: 100%" ;   cellspacing="0"><tr><td style="width: 100%">';
				$flux.='<h3>Mitoyenneté : </h3>
															<table style="width: 100%" ;   cellspacing="0"><tr>
															';
				$i=0;
				foreach(MandateAdjoining::loadAll($this->_pdo) as $elem ){
					if(($i%5==0)&&($i!=0))$flux.='</tr><tr>';
					$i++;
					$flux.='<td style="width: 20%"><img src="'.Constant::DEFAULT_URL_PICTURE_DIRECTORY.'radio.png" alt="" > '.$elem->getName().'</td>';
				}
				$flux.='</tr></table>';
				$flux.='</td></tr></table>';
				
			
				$flux.='<table table style="width: 100%" ;   cellspacing="0"><tr><td style="width: 100%">';
				$flux.='<h3>Type de construction :  </h3>
															<table style="width: 100%" ;   cellspacing="0"><tr>
															';
				$i=0;
				foreach(MandateConstructionType::loadAll($this->_pdo) as $elem ){
					if(($i%5==0)&&($i!=0))$flux.='</tr><tr>';
					$i++;
					$flux.='<td style="width: 20%"><img src="'.Constant::DEFAULT_URL_PICTURE_DIRECTORY.'radio.png" alt="" > '.$elem->getName().'</td>';
				}
				$flux.='</tr></table>';
				$flux.='</td></tr></table>';
				
				
				$flux.='<table table style="width: 100%" ;   cellspacing="0"><tr><td style="width: 100%">';
				$flux.='<h3>Style : </h3>
											<table style="width: 100%" ;   cellspacing="0"><tr>
											';
				$i=0;
				foreach(MandateStyle::loadAll($this->_pdo) as $elem ){
					if(($i%5==0)&&($i!=0))$flux.='</tr><tr>';
					$i++;
					$flux.='<td style="width: 20%"><img src="'.Constant::DEFAULT_URL_PICTURE_DIRECTORY.'radio.png" alt="" > '.$elem->getName().'</td>';
				}
				$flux.='</tr></table>';
				$flux.='</td></tr></table>';
				
				
				$flux.='<table table style="width: 100%" ;   cellspacing="0"><tr><td style="width: 100%">';
				$flux.='<h3>Nouveautés : </h3>
											<table style="width: 100%" ;   cellspacing="0"><tr>
											';
				$i=0;
				foreach(MandateNews::loadAll($this->_pdo) as $elem ){
					if(($i%5==0)&&($i!=0))$flux.='</tr><tr>';
					$i++;
					$flux.='<td style="width: 20%"><img src="'.Constant::DEFAULT_URL_PICTURE_DIRECTORY.'radio.png" alt="" > '.$elem->getName().'</td>';
				}
				$flux.='</tr></table>';
				$flux.='</td></tr></table>';
				
				
				
				$flux.='<table table style="width: 100%" ;   cellspacing="0"><tr><td style="width: 100%">';
				$flux.='<h3>Conditions : </h3>
											<table style="width: 100%" ;   cellspacing="0"><tr>
											';
				$i=0;
				foreach(MandateCondition::loadAll($this->_pdo) as $elem ){
					if(($i%5==0)&&($i!=0))$flux.='</tr><tr>';
					$i++;
					$flux.='<td style="width: 20%"><img src="'.Constant::DEFAULT_URL_PICTURE_DIRECTORY.'radio.png" alt="" > '.$elem->getName().'</td>';
				}
				$flux.='</tr></table>';
				$flux.='</td></tr></table>';
				
				
// mytoneetté ( 1 et 0)... + rel

				$flux.='<table table style="width: 100%" ;   cellspacing="0"><tr><td style="width: 100%">';
				$flux.='<h3>Orientation : </h3>
											<table style="width: 100%" ;   cellspacing="0"><tr>
											';
				$i=0;
				foreach(MandateOrientation::loadAll($this->_pdo) as $elem ){
					if(($i%5==0)&&($i!=0))$flux.='</tr><tr>';
					$i++;
					$flux.='<td style="width: 20%"><img src="'.Constant::DEFAULT_URL_PICTURE_DIRECTORY.'radio.png" alt="" > '.$elem->getName().'</td>';
				}
				$flux.='</tr></table>';
				$flux.='</td></tr></table>';
				
				
				
				
				$flux.='<table table style="width: 100%" ;   cellspacing="0"><tr><td style="width: 100%">';
				$flux.='<h3>Pente : </h3>
											<table style="width: 100%" ;   cellspacing="0"><tr>
											';
				$i=0;
				foreach(MandateSlope::loadAll($this->_pdo) as $elem ){
					if(($i%5==0)&&($i!=0))$flux.='</tr><tr>';
					$i++;
					$flux.='<td style="width: 20%"><img src="'.Constant::DEFAULT_URL_PICTURE_DIRECTORY.'radio.png" alt="" > '.$elem->getName().'</td>';
				}
				$flux.='</tr></table>';
				$flux.='</td></tr></table>';
				
				$flux.='<table table style="width: 100%" ;   cellspacing="0"><tr><td style="width: 100%">';
				$flux.='<p>.......................................................................................................................................................................................................</p>';
				$flux.='<p>Taille façade : ....................................................................... Profondeur terrain : ........................................................................</p>';
				$flux.='<p>Latitude : .................................................................................. Longitude : .................................................................................</p>';
				$flux.='<p>Proximité école : ................................................................... Proximité commerce : ....................................................................</p>';
				$flux.='<p>Proximité transport : ...................................................................</p>';
				
				$flux.='</td></tr></table>';
				
		
				

				$flux.=' </page>
   <page  pageset="old"> 
   
        <h2>Description : </h2>';
        $flux.='<table id="tblDescription" border="1" style="width: 100%" ;   cellspacing="0">';
        $flux.='
        <thead>
        	<tr>
        		<th style="width: 10%">Niveau</th>
        		<th style="width: 30%">Pièce</th>
        		<th style="width: 25%">Surface</th>
        		<th style="width: 35%">Sol/mur/équipement</th>
        	</tr>
        </thead>';
        for ($i=0;$i<25;$i++)
        	$flux.='<tr><td style="width: 10%"></td><td  style="width: 30%"></td><td  style="width: 25%"></td><td  style="width: 35%"></td></tr>';
        
        $flux.='</table>';
        $flux.='</page>';

				// echo $flux;

				$html2pdf = new HTML2PDF('P','A4','fr');
				$html2pdf->WriteHTML($flux);
				$html2pdf->Output('fiche_vierge.pdf');

			}

			if( (isset($_GET['page'] ) && $_GET['page']=='see' ) ){
				// Ajout du lien vers l'ajout d'une action
				// ça, ou utilisation d'un autre script permettant l'ajout de l'action.
				// Si le mandat est rapproché.
				$mandate = Mandate::load($this->_pdo,$_GET['action']);
				$rapp = BddRapprochement::loadByMandateR($this->_pdo,$mandate);

				//					var_dump($rapp);
				if($rapp!=null){
					$this->_isCompromis=  true;
				}


                /**
                 * NOUVEAUX DOCUMENTS
                 */
                  // récupèration des documents en fct du type de mandat, et tu type de bien
                    $newDocs = Documents::loadAllByMandate($this->_pdo,$mandate);
//                $d = Documents::load($this->_pdo,1);

                /**
                 * FIN NOUVEAUX DOCUMENTS
                 */

                // passage des differents documents
                $this->_smarty->assign('newDocs',$newDocs);
                $this->_smarty->assign('arrayParametersLinks',array('idMandate'=>$mandate->getId()));
                $this->_smarty->assign('isCompromis',$this->_isCompromis);

				$this->addHook('hook_imp',dirname(__FILE__).'/views/links.tpl');
			}
		}
	}
	private function addHook($position,$tpl){
		$this->_hooks[$position][] = $tpl  ;
	}
	public function getHooks(){
		return $this->_hooks;
	}
}
// Appel du module
$objF = new Module_Controller_documents(  $this->_pdo,$smarty );
