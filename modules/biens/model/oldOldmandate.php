<?php

/**
 * @class Mandate
 * @date 15/02/2011 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class Mandate
{
	/// @var PDO
	private $pdo;

	/// @var array tableau pour le chargement rapide
	private static $easyload;

	/// @var int
	private $idMandate;

	/// @var int
	private $numberMandate;

	/// @var int
	private $initDate;

	/// @var int
	private $deadDate;

	/// @var int
	private $freeDate;

	/// @var string
	private $address;

	/// @var float
	private $priceFai;

	/// @var float
	private $priceSeller;

	/// @var float
	private $commission;

	/// @var float
	private $estimationFai;

	/// @var float
	private $margeNegociation;

	/// @var string
	private $referenceCadastreParcelle1;

	/// @var string
	private $referenceCadastreParcelle2;

	/// @var string
	private $referenceCadastreParcelle3;

	/// @var string
	private $autreReferenceParcelle;

	/// @var int
	private $superficieParcelle1;

	/// @var int
	private $superficieParcelle2;

	/// @var int
	private $superficieParcelle3;

	/// @var int
	private $superficieAutreParcelle;

	/// @var int
	private $superficieConstructible;

	/// @var int
	private $superficieTotale;

	/// @var string
	private $numberLot;

	/// @var int
	private $sHONAccordee;

	/// @var bool
	private $zoneBDF;

	/// @var bool
	private $ligneDeCrete;

	/// @var bool
	private $zoneInondable;

	/// @var string
	private $reglementDeLotissement;

	/// @var string
	private $eRNT;

	/// @var bool
	private $dPValide;

	/// @var int
	private $dateDeclarationPrealable;

	/// @var int
	private $prorogationDPJusquau;

	/// @var bool
	private $cuValide;

	/// @var bool
	private $dateCU;

	/// @var bool
	private $prorogationCUJusquau;

	/// @var bool
	private $cuOPSValide;

	/// @var int
	private $dateCuOPS;

	/// @var bool
	private $prorogationCuOPSJusquau;

	/// @var bool
	private $permisDamenagerValide;

	/// @var int
	private $datePermisDamenager;

	/// @var bool
	private $terrainVenduViabilise;

	/// @var bool
	private $terrainVenduSemiViabilise;

	/// @var bool
	private $terrainVenduNonViabilise;

	/// @var string
	private $passageEau;

	/// @var string
	private $passageElectricite;

	/// @var string
	private $passageGaz;

	/// @var bool
	private $toutALegout;

	/// @var bool
	private $assainissementParFosseSceptique;

	/// @var string
	private $voirie;

	/// @var int
	private $tailleFacade;

	/// @var int
	private $profondeurTerrain;

	/// @var string
	private $commentaire;

	/// @var string
	private $geolocalisation;

	/// @var int
	private $proximiteEcole;

	/// @var int
	private $proximiteCommerce;

	/// @var int
	private $proximiteTransport;

	/// @var string
	private $commentaireApparent;

	/// @var int
	private $nbPiece;

	/// @var int
	private $surfaceHabitable;

	/// @var int
	private $nbChambre;

	/// @var int
	private $surfacePieceVie;

	/// @var int
	private $niveau;

	/// @var int
	private $anneeConstruction;

	/// @var bool
	private $coupCoeur;

	/// @var int
	private $chargesMensuelle;

	/// @var int
	private $taxesFonciere;

	/// @var int
	private $taxeHabitation;

	/// @var int
	private $nouveaute;

	/// @var bool
	private $cheminee;

	/// @var bool
	private $cuisineEquipee;

	/// @var bool
	private $cuisineAmenagee;

	/// @var bool
	private $piscine;

	/// @var bool
	private $poolHouse;

	/// @var bool
	private $terrasse;

	/// @var bool
	private $mezzanine;

	/// @var bool
	private $dependance;

	/// @var bool
	private $gaz;

	/// @var bool
	private $cave;

	/// @var bool
	private $sousSol;

	/// @var bool
	private $garage;

	/// @var bool
	private $parking;

	/// @var bool
	private $rezDeJardin;

	/// @var bool
	private $plainPied;

	/// @var bool
	private $carriere;

	/// @var bool
	private $pointEau;

	/// @var int id de user
	private $user;

	/// @var int id de sector
	private $sector;

	/// @var int id de city
	private $city;

	/// @var int id de notary
	private $notary;

	/// @var int id de mandatetype
	private $mandateType;

	/// @var int id de transactiontype
	private $transactionType;

	/// @var int id de slope
	private $slope;

	/// @var int id de orientation
	private $orientation;

	/// @var int id de insulation
	private $insulation;

	/// @var int id de news
	private $news;

	/// @var int id de heating
	private $heating;

	/// @var int id de commonownership
	private $commonOwnership;

	/// @var int id de roof
	private $roof;

	/// @var int id de condition
	private $condition;

	/// @var int id de style
	private $style;

	/// @var int id de construction
	private $construction;

	/// @var int id de sanitationcorresponding
	private $sanitationCorresponding;

	/// @var int id de electriccorresponding
	private $electricCorresponding;

	/// @var int id de gazcorresponding
	private $gazCorresponding;

	/// @var int id de watercorresponding
	private $waterCorresponding;

	/// @var int id de cos
	private $cos;

	/// @var int id de zonageplu
	private $zonagePLU;

	/// @var int id de zonagernu
	private $zonageRNU;

	/// @var int id de bornageterrain
	private $bornageTerrain;

	/// @var int id de geometer
	private $geometer;

	/// @var int id de etap
	private $etap;

	/**
	 * Construire un(e) mandate
	 * @param $pdo PDO
	 * @param $idMandate int
	 * @param $numberMandate int
	 * @param $initDate int
	 * @param $deadDate int
	 * @param $address string
	 * @param $priceFai float
	 * @param $priceSeller float
	 * @param $commission float
	 * @param $estimationFai float
	 * @param $margeNegociation float
	 * @param $referenceCadastreParcelle1 string
	 * @param $referenceCadastreParcelle2 string
	 * @param $referenceCadastreParcelle3 string
	 * @param $autreReferenceParcelle string
	 * @param $superficieParcelle1 int
	 * @param $superficieParcelle2 int
	 * @param $superficieParcelle3 int
	 * @param $superficieAutreParcelle int
	 * @param $superficieConstructible int
	 * @param $superficieTotale int
	 * @param $numberLot string
	 * @param $sHONAccordee int
	 * @param $reglementDeLotissement string
	 * @param $eRNT string
	 * @param $passageEau string
	 * @param $passageElectricite string
	 * @param $passageGaz string
	 * @param $voirie string
	 * @param $tailleFacade int
	 * @param $profondeurTerrain int
	 * @param $commentaire string
	 * @param $geolocalisation string
	 * @param $proximiteEcole int
	 * @param $proximiteCommerce int
	 * @param $proximiteTransport int
	 * @param $commentaireApparent string
	 * @param $nbPiece int
	 * @param $surfaceHabitable int
	 * @param $nbChambre int
	 * @param $surfacePieceVie int
	 * @param $niveau int
	 * @param $anneeConstruction int
	 * @param $chargesMensuelle int
	 * @param $taxesFonciere int
	 * @param $taxeHabitation int
	 * @param $user int id de user
	 * @param $sector int id de sector
	 * @param $city int id de city
	 * @param $notary int id de notary
	 * @param $mandateType int id de mandatetype
	 * @param $transactionType int id de transactiontype
	 * @param $etap int id de etap
	 * @param $freeDate int
	 * @param $zoneBDF bool
	 * @param $ligneDeCrete bool
	 * @param $zoneInondable bool
	 * @param $dPValide bool
	 * @param $dateDeclarationPrealable int
	 * @param $prorogationDPJusquau int
	 * @param $cuValide bool
	 * @param $dateCU bool
	 * @param $prorogationCUJusquau bool
	 * @param $cuOPSValide bool
	 * @param $dateCuOPS int
	 * @param $prorogationCuOPSJusquau bool
	 * @param $permisDamenagerValide bool
	 * @param $datePermisDamenager int
	 * @param $terrainVenduViabilise bool
	 * @param $terrainVenduSemiViabilise bool
	 * @param $terrainVenduNonViabilise bool
	 * @param $toutALegout bool
	 * @param $assainissementParFosseSceptique bool
	 * @param $coupCoeur bool
	 * @param $nouveaute int
	 * @param $cheminee bool
	 * @param $cuisineEquipee bool
	 * @param $cuisineAmenagee bool
	 * @param $piscine bool
	 * @param $poolHouse bool
	 * @param $terrasse bool
	 * @param $mezzanine bool
	 * @param $dependance bool
	 * @param $gaz bool
	 * @param $cave bool
	 * @param $sousSol bool
	 * @param $garage bool
	 * @param $parking bool
	 * @param $rezDeJardin bool
	 * @param $plainPied bool
	 * @param $carriere bool
	 * @param $pointEau bool
	 * @param $slope int id de slope
	 * @param $orientation int id de orientation
	 * @param $insulation int id de insulation
	 * @param $news int id de news
	 * @param $heating int id de heating
	 * @param $commonOwnership int id de commonownership
	 * @param $roof int id de roof
	 * @param $condition int id de condition
	 * @param $style int id de style
	 * @param $construction int id de construction
	 * @param $sanitationCorresponding int id de sanitationcorresponding
	 * @param $electricCorresponding int id de electriccorresponding
	 * @param $gazCorresponding int id de gazcorresponding
	 * @param $waterCorresponding int id de watercorresponding
	 * @param $cos int id de cos
	 * @param $zonagePLU int id de zonageplu
	 * @param $zonageRNU int id de zonagernu
	 * @param $bornageTerrain int id de bornageterrain
	 * @param $geometer int id de geometer
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Mandate
	 */
	protected function __construct(PDO $pdo,$idMandate,$numberMandate,$initDate,$deadDate,$address,$priceFai,$priceSeller,$commission,$estimationFai,$margeNegociation,$referenceCadastreParcelle1,$referenceCadastreParcelle2,$referenceCadastreParcelle3,$autreReferenceParcelle,$superficieParcelle1,$superficieParcelle2,$superficieParcelle3,$superficieAutreParcelle,$superficieConstructible,$superficieTotale,$numberLot,$sHONAccordee,$reglementDeLotissement,$eRNT,$passageEau,$passageElectricite,$passageGaz,$voirie,$tailleFacade,$profondeurTerrain,$commentaire,$geolocalisation,$proximiteEcole,$proximiteCommerce,$proximiteTransport,$commentaireApparent,$nbPiece,$surfaceHabitable,$nbChambre,$surfacePieceVie,$niveau,$anneeConstruction,$chargesMensuelle,$taxesFonciere,$taxeHabitation,$user,$sector,$city,$notary,$mandateType,$transactionType,$etap,$freeDate=null,$zoneBDF=false,$ligneDeCrete=false,$zoneInondable=false,$dPValide=false,$dateDeclarationPrealable=null,$prorogationDPJusquau=null,$cuValide=false,$dateCU=false,$prorogationCUJusquau=false,$cuOPSValide=false,$dateCuOPS=null,$prorogationCuOPSJusquau=false,$permisDamenagerValide=false,$datePermisDamenager=null,$terrainVenduViabilise=false,$terrainVenduSemiViabilise=false,$terrainVenduNonViabilise=false,$toutALegout=false,$assainissementParFosseSceptique=false,$coupCoeur=false,$nouveaute=null,$cheminee=false,$cuisineEquipee=false,$cuisineAmenagee=false,$piscine=false,$poolHouse=false,$terrasse=false,$mezzanine=false,$dependance=false,$gaz=false,$cave=false,$sousSol=false,$garage=false,$parking=false,$rezDeJardin=false,$plainPied=false,$carriere=false,$pointEau=false,$slope=null,$orientation=null,$insulation=null,$news=null,$heating=null,$commonOwnership=null,$roof=null,$condition=null,$style=null,$construction=null,$sanitationCorresponding=null,$electricCorresponding=null,$gazCorresponding=null,$waterCorresponding=null,$cos=null,$zonagePLU=null,$zonageRNU=null,$bornageTerrain=null,$geometer=null,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;

		// Sauvegarder les attributs
		$this->idMandate = $idMandate;
		$this->numberMandate = $numberMandate;
		$this->initDate = $initDate;
		$this->deadDate = $deadDate;
		$this->address = $address;
		$this->priceFai = $priceFai;
		$this->priceSeller = $priceSeller;
		$this->commission = $commission;
		$this->estimationFai = $estimationFai;
		$this->margeNegociation = $margeNegociation;
		$this->referenceCadastreParcelle1 = $referenceCadastreParcelle1;
		$this->referenceCadastreParcelle2 = $referenceCadastreParcelle2;
		$this->referenceCadastreParcelle3 = $referenceCadastreParcelle3;
		$this->autreReferenceParcelle = $autreReferenceParcelle;
		$this->superficieParcelle1 = $superficieParcelle1;
		$this->superficieParcelle2 = $superficieParcelle2;
		$this->superficieParcelle3 = $superficieParcelle3;
		$this->superficieAutreParcelle = $superficieAutreParcelle;
		$this->superficieConstructible = $superficieConstructible;
		$this->superficieTotale = $superficieTotale;
		$this->numberLot = $numberLot;
		$this->sHONAccordee = $sHONAccordee;
		$this->reglementDeLotissement = $reglementDeLotissement;
		$this->eRNT = $eRNT;
		$this->passageEau = $passageEau;
		$this->passageElectricite = $passageElectricite;
		$this->passageGaz = $passageGaz;
		$this->voirie = $voirie;
		$this->tailleFacade = $tailleFacade;
		$this->profondeurTerrain = $profondeurTerrain;
		$this->commentaire = $commentaire;
		$this->geolocalisation = $geolocalisation;
		$this->proximiteEcole = $proximiteEcole;
		$this->proximiteCommerce = $proximiteCommerce;
		$this->proximiteTransport = $proximiteTransport;
		$this->commentaireApparent = $commentaireApparent;
		$this->nbPiece = $nbPiece;
		$this->surfaceHabitable = $surfaceHabitable;
		$this->nbChambre = $nbChambre;
		$this->surfacePieceVie = $surfacePieceVie;
		$this->niveau = $niveau;
		$this->anneeConstruction = $anneeConstruction;
		$this->chargesMensuelle = $chargesMensuelle;
		$this->taxesFonciere = $taxesFonciere;
		$this->taxeHabitation = $taxeHabitation;
		$this->user = $user;
		$this->sector = $sector;
		$this->city = $city;
		$this->notary = $notary;
		$this->mandateType = $mandateType;
		$this->transactionType = $transactionType;
		$this->etap = $etap;
		$this->freeDate = $freeDate;
		$this->zoneBDF = $zoneBDF;
		$this->ligneDeCrete = $ligneDeCrete;
		$this->zoneInondable = $zoneInondable;
		$this->dPValide = $dPValide;
		$this->dateDeclarationPrealable = $dateDeclarationPrealable;
		$this->prorogationDPJusquau = $prorogationDPJusquau;
		$this->cuValide = $cuValide;
		$this->dateCU = $dateCU;
		$this->prorogationCUJusquau = $prorogationCUJusquau;
		$this->cuOPSValide = $cuOPSValide;
		$this->dateCuOPS = $dateCuOPS;
		$this->prorogationCuOPSJusquau = $prorogationCuOPSJusquau;
		$this->permisDamenagerValide = $permisDamenagerValide;
		$this->datePermisDamenager = $datePermisDamenager;
		$this->terrainVenduViabilise = $terrainVenduViabilise;
		$this->terrainVenduSemiViabilise = $terrainVenduSemiViabilise;
		$this->terrainVenduNonViabilise = $terrainVenduNonViabilise;
		$this->toutALegout = $toutALegout;
		$this->assainissementParFosseSceptique = $assainissementParFosseSceptique;
		$this->coupCoeur = $coupCoeur;
		$this->nouveaute = $nouveaute;
		$this->cheminee = $cheminee;
		$this->cuisineEquipee = $cuisineEquipee;
		$this->cuisineAmenagee = $cuisineAmenagee;
		$this->piscine = $piscine;
		$this->poolHouse = $poolHouse;
		$this->terrasse = $terrasse;
		$this->mezzanine = $mezzanine;
		$this->dependance = $dependance;
		$this->gaz = $gaz;
		$this->cave = $cave;
		$this->sousSol = $sousSol;
		$this->garage = $garage;
		$this->parking = $parking;
		$this->rezDeJardin = $rezDeJardin;
		$this->plainPied = $plainPied;
		$this->carriere = $carriere;
		$this->pointEau = $pointEau;
		$this->slope = $slope;
		$this->orientation = $orientation;
		$this->insulation = $insulation;
		$this->news = $news;
		$this->heating = $heating;
		$this->commonOwnership = $commonOwnership;
		$this->roof = $roof;
		$this->condition = $condition;
		$this->style = $style;
		$this->construction = $construction;
		$this->sanitationCorresponding = $sanitationCorresponding;
		$this->electricCorresponding = $electricCorresponding;
		$this->gazCorresponding = $gazCorresponding;
		$this->waterCorresponding = $waterCorresponding;
		$this->cos = $cos;
		$this->zonagePLU = $zonagePLU;
		$this->zonageRNU = $zonageRNU;
		$this->bornageTerrain = $bornageTerrain;
		$this->geometer = $geometer;

		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			Mandate::$easyload[$idMandate] = $this;
		}
	}

	/**
	 * Cr�er un(e) mandate
	 * @param $pdo PDO
	 * @param $numberMandate int
	 * @param $initDate int
	 * @param $deadDate int
	 * @param $address string
	 * @param $priceFai float
	 * @param $priceSeller float
	 * @param $commission float
	 * @param $estimationFai float
	 * @param $margeNegociation float
	 * @param $referenceCadastreParcelle1 string
	 * @param $referenceCadastreParcelle2 string
	 * @param $referenceCadastreParcelle3 string
	 * @param $autreReferenceParcelle string
	 * @param $superficieParcelle1 int
	 * @param $superficieParcelle2 int
	 * @param $superficieParcelle3 int
	 * @param $superficieAutreParcelle int
	 * @param $superficieConstructible int
	 * @param $superficieTotale int
	 * @param $numberLot string
	 * @param $sHONAccordee int
	 * @param $reglementDeLotissement string
	 * @param $eRNT string
	 * @param $passageEau string
	 * @param $passageElectricite string
	 * @param $passageGaz string
	 * @param $voirie string
	 * @param $tailleFacade int
	 * @param $profondeurTerrain int
	 * @param $commentaire string
	 * @param $geolocalisation string
	 * @param $proximiteEcole int
	 * @param $proximiteCommerce int
	 * @param $proximiteTransport int
	 * @param $commentaireApparent string
	 * @param $nbPiece int
	 * @param $surfaceHabitable int
	 * @param $nbChambre int
	 * @param $surfacePieceVie int
	 * @param $niveau int
	 * @param $anneeConstruction int
	 * @param $chargesMensuelle int
	 * @param $taxesFonciere int
	 * @param $taxeHabitation int
	 * @param $user User
	 * @param $sector Sector
	 * @param $city City
	 * @param $notary Notary
	 * @param $mandateType MandateType
	 * @param $transactionType TransactionType
	 * @param $etap MandateEtap
	 * @param $freeDate int
	 * @param $zoneBDF bool
	 * @param $ligneDeCrete bool
	 * @param $zoneInondable bool
	 * @param $dPValide bool
	 * @param $dateDeclarationPrealable int
	 * @param $prorogationDPJusquau int
	 * @param $cuValide bool
	 * @param $dateCU bool
	 * @param $prorogationCUJusquau bool
	 * @param $cuOPSValide bool
	 * @param $dateCuOPS int
	 * @param $prorogationCuOPSJusquau bool
	 * @param $permisDamenagerValide bool
	 * @param $datePermisDamenager int
	 * @param $terrainVenduViabilise bool
	 * @param $terrainVenduSemiViabilise bool
	 * @param $terrainVenduNonViabilise bool
	 * @param $toutALegout bool
	 * @param $assainissementParFosseSceptique bool
	 * @param $coupCoeur bool
	 * @param $nouveaute int
	 * @param $cheminee bool
	 * @param $cuisineEquipee bool
	 * @param $cuisineAmenagee bool
	 * @param $piscine bool
	 * @param $poolHouse bool
	 * @param $terrasse bool
	 * @param $mezzanine bool
	 * @param $dependance bool
	 * @param $gaz bool
	 * @param $cave bool
	 * @param $sousSol bool
	 * @param $garage bool
	 * @param $parking bool
	 * @param $rezDeJardin bool
	 * @param $plainPied bool
	 * @param $carriere bool
	 * @param $pointEau bool
	 * @param $slope MandateSlope
	 * @param $orientation MandateOrientation
	 * @param $insulation MandateInsulation
	 * @param $news MandateNews
	 * @param $heating MandateHeating
	 * @param $commonOwnership MandateCommonOwnership
	 * @param $roof MandateRoof
	 * @param $condition MandateCondition
	 * @param $style MandateStyle
	 * @param $construction MandateConstructionType
	 * @param $sanitationCorresponding MandateSanitationCorresponding
	 * @param $electricCorresponding MandateElectricCorresponding
	 * @param $gazCorresponding MandateGazCorresponding
	 * @param $waterCorresponding MandateWaterCorresponding
	 * @param $cos MandateCOS
	 * @param $zonagePLU MandateZonagePLU
	 * @param $zonageRNU MandateZonageRNU
	 * @param $bornageTerrain MandateBornageTerrain
	 * @param $geometer MandateGeometer
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Mandate
	 */
	public static function create(PDO $pdo,$numberMandate,$initDate,$deadDate,$address,$priceFai,$priceSeller,$commission,$estimationFai,$margeNegociation,$referenceCadastreParcelle1,$referenceCadastreParcelle2,$referenceCadastreParcelle3,$autreReferenceParcelle,$superficieParcelle1,$superficieParcelle2,$superficieParcelle3,$superficieAutreParcelle,$superficieConstructible,$superficieTotale,$numberLot,$sHONAccordee,$reglementDeLotissement,$eRNT,$passageEau,$passageElectricite,$passageGaz,$voirie,$tailleFacade,$profondeurTerrain,$commentaire,$geolocalisation,$proximiteEcole,$proximiteCommerce,$proximiteTransport,$commentaireApparent,$nbPiece,$surfaceHabitable,$nbChambre,$surfacePieceVie,$niveau,$anneeConstruction,$chargesMensuelle,$taxesFonciere,$taxeHabitation,User $user,Sector $sector,City $city,Notary $notary,MandateType $mandateType,TransactionType $transactionType,MandateEtap $etap,$freeDate=null,$zoneBDF=false,$ligneDeCrete=false,$zoneInondable=false,$dPValide=false,$dateDeclarationPrealable=null,$prorogationDPJusquau=null,$cuValide=false,$dateCU=false,$prorogationCUJusquau=false,$cuOPSValide=false,$dateCuOPS=null,$prorogationCuOPSJusquau=false,$permisDamenagerValide=false,$datePermisDamenager=null,$terrainVenduViabilise=false,$terrainVenduSemiViabilise=false,$terrainVenduNonViabilise=false,$toutALegout=false,$assainissementParFosseSceptique=false,$coupCoeur=false,$nouveaute=null,$cheminee=false,$cuisineEquipee=false,$cuisineAmenagee=false,$piscine=false,$poolHouse=false,$terrasse=false,$mezzanine=false,$dependance=false,$gaz=false,$cave=false,$sousSol=false,$garage=false,$parking=false,$rezDeJardin=false,$plainPied=false,$carriere=false,$pointEau=false,$slope=null,$orientation=null,$insulation=null,$news=null,$heating=null,$commonOwnership=null,$roof=null,$condition=null,$style=null,$construction=null,$sanitationCorresponding=null,$electricCorresponding=null,$gazCorresponding=null,$waterCorresponding=null,$cos=null,$zonagePLU=null,$zonageRNU=null,$bornageTerrain=null,$geometer=null,$easyload=true)
	{
		// Ajouter le/la mandate dans la base de donn�es
		$pdoStatement = $pdo->prepare('INSERT INTO Mandate (numberMandate,initDate,deadDate,address,priceFai,priceSeller,commission,estimationFai,margeNegociation,referenceCadastreParcelle1,referenceCadastreParcelle2,referenceCadastreParcelle3,autreReferenceParcelle,superficieParcelle1,superficieParcelle2,superficieParcelle3,superficieAutreParcelle,superficieConstructible,superficieTotale,numberLot,sHONAccordee,reglementDeLotissement,eRNT,passageEau,passageElectricite,passageGaz,voirie,tailleFacade,profondeurTerrain,commentaire,geolocalisation,proximiteEcole,proximiteCommerce,proximiteTransport,commentaireApparent,nbPiece,surfaceHabitable,nbChambre,surfacePieceVie,niveau,anneeConstruction,chargesMensuelle,taxesFonciere,taxeHabitation,user_idUser,sector_idSector,city_idCity,notary_idNotary,mandateType_idMandateType,transactionType_idTransactionType,etap_idMandateEtap,freeDate,zoneBDF,ligneDeCrete,zoneInondable,dPValide,dateDeclarationPrealable,prorogationDPJusquau,cuValide,dateCU,prorogationCUJusquau,cuOPSValide,dateCuOPS,prorogationCuOPSJusquau,permisDamenagerValide,datePermisDamenager,terrainVenduViabilise,terrainVenduSemiViabilise,terrainVenduNonViabilise,toutALegout,assainissementParFosseSceptique,coupCoeur,nouveaute,cheminee,cuisineEquipee,cuisineAmenagee,piscine,poolHouse,terrasse,mezzanine,dependance,gaz,cave,sousSol,garage,parking,rezDeJardin,plainPied,carriere,pointEau,slope_idMandateSlope,orientation_idMandateOrientation,insulation_idMandateInsulation,news_idMandateNews,heating_idMandateHeating,commonOwnership_idMandateCommonOwnership,roof_idMandateRoof,condition_idMandateCondition,style_idMandateStyle,construction_idMandateConstructionType,sanitationCorresponding_idMandateSanitationCorresponding,electricCorresponding_idMandateElectricCorresponding,gazCorresponding_idMandateGazCorresponding,waterCorresponding_idMandateWaterCorresponding,cos_idMandateCOS,zonagePLU_idMandateZonagePLU,zonageRNU_idMandateZonageRNU,bornageTerrain_idMandateBornageTerrain,geometer_idMandateGeometer) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');

		if (!$pdoStatement->execute(array($numberMandate,date('Y-m-d',$initDate),date('Y-m-d',$deadDate),$address,$priceFai,$priceSeller,$commission,$estimationFai,$margeNegociation,$referenceCadastreParcelle1,$referenceCadastreParcelle2,$referenceCadastreParcelle3,$autreReferenceParcelle,$superficieParcelle1,$superficieParcelle2,$superficieParcelle3,$superficieAutreParcelle,$superficieConstructible,$superficieTotale,$numberLot,$sHONAccordee,$reglementDeLotissement,$eRNT,$passageEau,$passageElectricite,$passageGaz,$voirie,$tailleFacade,$profondeurTerrain,$commentaire,$geolocalisation,$proximiteEcole,$proximiteCommerce,$proximiteTransport,$commentaireApparent,$nbPiece,$surfaceHabitable,$nbChambre,$surfacePieceVie,$niveau,$anneeConstruction,$chargesMensuelle,$taxesFonciere,$taxeHabitation,$user->getIdUser(),$sector->getIdSector(),$city->getIdCity(),$notary->getIdNotary(),$mandateType->getIdMandateType(),$transactionType->getIdTransactionType(),$etap->getIdMandateEtap(),$freeDate === null ? null : date('Y-m-d',$freeDate),$zoneBDF,$ligneDeCrete,$zoneInondable,$dPValide,$dateDeclarationPrealable === null ? null : date('Y-m-d',$dateDeclarationPrealable),$prorogationDPJusquau === null ? null : date('Y-m-d',$prorogationDPJusquau),$cuValide,$dateCU,$prorogationCUJusquau,$cuOPSValide,$dateCuOPS === null ? null : date('Y-m-d',$dateCuOPS),$prorogationCuOPSJusquau,$permisDamenagerValide,$datePermisDamenager === null ? null : date('Y-m-d',$datePermisDamenager),$terrainVenduViabilise,$terrainVenduSemiViabilise,$terrainVenduNonViabilise,$toutALegout,$assainissementParFosseSceptique,$coupCoeur,$nouveaute === null ? null : date('Y-m-d',$nouveaute),$cheminee,$cuisineEquipee,$cuisineAmenagee,$piscine,$poolHouse,$terrasse,$mezzanine,$dependance,$gaz,$cave,$sousSol,$garage,$parking,$rezDeJardin,$plainPied,$carriere,$pointEau,$slope == null ? null : $slope->getIdMandateSlope(),$orientation == null ? null : $orientation->getIdMandateOrientation(),$insulation == null ? null : $insulation->getIdMandateInsulation(),$news == null ? null : $news->getIdMandateNews(),$heating == null ? null : $heating->getIdMandateHeating(),$commonOwnership == null ? null : $commonOwnership->getIdMandateCommonOwnership(),$roof == null ? null : $roof->getIdMandateRoof(),$condition == null ? null : $condition->getIdMandateCondition(),$style == null ? null : $style->getIdMandateStyle(),$construction == null ? null : $construction->getIdMandateConstructionType(),$sanitationCorresponding == null ? null : $sanitationCorresponding->getIdMandateSanitationCorresponding(),$electricCorresponding == null ? null : $electricCorresponding->getIdMandateElectricCorresponding(),$gazCorresponding == null ? null : $gazCorresponding->getIdMandateGazCorresponding(),$waterCorresponding == null ? null : $waterCorresponding->getIdMandateWaterCorresponding(),$cos == null ? null : $cos->getIdMandateCOS(),$zonagePLU == null ? null : $zonagePLU->getIdMandateZonagePLU(),$zonageRNU == null ? null : $zonageRNU->getIdMandateZonageRNU(),$bornageTerrain == null ? null : $bornageTerrain->getIdMandateBornageTerrain(),$geometer == null ? null : $geometer->getIdMandateGeometer()))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) mandate dans la base de donn�es : '.$pdoStatement->errorInfo());
		}

		// Construire le/la mandate
		return new Mandate($pdo,$pdo->lastInsertId(),$numberMandate,$initDate,$deadDate,$address,$priceFai,$priceSeller,$commission,$estimationFai,$margeNegociation,$referenceCadastreParcelle1,$referenceCadastreParcelle2,$referenceCadastreParcelle3,$autreReferenceParcelle,$superficieParcelle1,$superficieParcelle2,$superficieParcelle3,$superficieAutreParcelle,$superficieConstructible,$superficieTotale,$numberLot,$sHONAccordee,$reglementDeLotissement,$eRNT,$passageEau,$passageElectricite,$passageGaz,$voirie,$tailleFacade,$profondeurTerrain,$commentaire,$geolocalisation,$proximiteEcole,$proximiteCommerce,$proximiteTransport,$commentaireApparent,$nbPiece,$surfaceHabitable,$nbChambre,$surfacePieceVie,$niveau,$anneeConstruction,$chargesMensuelle,$taxesFonciere,$taxeHabitation,$user,$sector,$city,$notary,$mandateType,$transactionType,$etap,$freeDate,$zoneBDF,$ligneDeCrete,$zoneInondable,$dPValide,$dateDeclarationPrealable,$prorogationDPJusquau,$cuValide,$dateCU,$prorogationCUJusquau,$cuOPSValide,$dateCuOPS,$prorogationCuOPSJusquau,$permisDamenagerValide,$datePermisDamenager,$terrainVenduViabilise,$terrainVenduSemiViabilise,$terrainVenduNonViabilise,$toutALegout,$assainissementParFosseSceptique,$coupCoeur,$nouveaute,$cheminee,$cuisineEquipee,$cuisineAmenagee,$piscine,$poolHouse,$terrasse,$mezzanine,$dependance,$gaz,$cave,$sousSol,$garage,$parking,$rezDeJardin,$plainPied,$carriere,$pointEau,$slope,$orientation-$insulation-$news,$heating,$commonOwnership,$roof,$condition,$style,$construction,$sanitationCorresponding,$electricCorresponding,$gazCorresponding,$waterCorresponding,$cos,$zonagePLU,$zonageRNU,$bornageTerrain,$geometer,$easyload);
	}

	/**
	 * Requ�te de s�l�ction
	 * @param $pdo PDO
	 * @param $where string
	 * @param $orderby string
	 * @param $limit string
	 * @return PDOStatement
	 */
	private static function _select(PDO $pdo,$where=null,$orderby=null,$limit=null)
	{
		return $pdo->prepare('SELECT m.idMandate, m.numberMandate, m.initDate, m.deadDate, m.address, m.priceFai, m.priceSeller, m.commission, m.estimationFai, m.margeNegociation, m.referenceCadastreParcelle1, m.referenceCadastreParcelle2, m.referenceCadastreParcelle3, m.autreReferenceParcelle, m.superficieParcelle1, m.superficieParcelle2, m.superficieParcelle3, m.superficieAutreParcelle, m.superficieConstructible, m.superficieTotale, m.numberLot, m.sHONAccordee, m.reglementDeLotissement, m.eRNT, m.passageEau, m.passageElectricite, m.passageGaz, m.voirie, m.tailleFacade, m.profondeurTerrain, m.commentaire, m.geolocalisation, m.proximiteEcole, m.proximiteCommerce, m.proximiteTransport, m.commentaireApparent, m.nbPiece, m.surfaceHabitable, m.nbChambre, m.surfacePieceVie, m.niveau, m.anneeConstruction, m.chargesMensuelle, m.taxesFonciere, m.taxeHabitation, m.user_idUser, m.sector_idSector, m.city_idCity, m.notary_idNotary, m.mandateType_idMandateType, m.transactionType_idTransactionType, m.etap_idMandateEtap, m.freeDate, m.zoneBDF, m.ligneDeCrete, m.zoneInondable, m.dPValide, m.dateDeclarationPrealable, m.prorogationDPJusquau, m.cuValide, m.dateCU, m.prorogationCUJusquau, m.cuOPSValide, m.dateCuOPS, m.prorogationCuOPSJusquau, m.permisDamenagerValide, m.datePermisDamenager, m.terrainVenduViabilise, m.terrainVenduSemiViabilise, m.terrainVenduNonViabilise, m.toutALegout, m.assainissementParFosseSceptique, m.coupCoeur, m.nouveaute, m.cheminee, m.cuisineEquipee, m.cuisineAmenagee, m.piscine, m.poolHouse, m.terrasse, m.mezzanine, m.dependance, m.gaz, m.cave, m.sousSol, m.garage, m.parking, m.rezDeJardin, m.plainPied, m.carriere, m.pointEau, m.slope_idMandateSlope, m.orientation_idMandateOrientation, m.insulation_idMandateInsulation, m.news_idMandateNews, m.heating_idMandateHeating, m.commonOwnership_idMandateCommonOwnership, m.roof_idMandateRoof, m.condition_idMandateCondition, m.style_idMandateStyle, m.construction_idMandateConstructionType, m.sanitationCorresponding_idMandateSanitationCorresponding, m.electricCorresponding_idMandateElectricCorresponding, m.gazCorresponding_idMandateGazCorresponding, m.waterCorresponding_idMandateWaterCorresponding, m.cos_idMandateCOS, m.zonagePLU_idMandateZonagePLU, m.zonageRNU_idMandateZonageRNU, m.bornageTerrain_idMandateBornageTerrain, m.geometer_idMandateGeometer FROM Mandate m '.
		($where != null ? ' WHERE '.$where : '').
		($orderby != null ? ' ORDERBY '.$orderby : '').
		($limit != null ? ' LIMIT '.$limit : ''));
	}

	/**
	 * Charger un(e) mandate
	 * @param $pdo PDO
	 * @param $idMandate int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Mandate
	 */
	public static function load(PDO $pdo,$idMandate,$easyload=true)
	{
		// D�j� charg�(e) ?
		if (isset(Mandate::$easyload[$idMandate])) {
			return Mandate::$easyload[$idMandate];
		}

		// Charger le/la mandate
		$pdoStatement = Mandate::_select($pdo,'m.idMandate = ?');
		if (!$pdoStatement->execute(array($idMandate))) {
			throw new Exception('Erreur lors du chargement d\'un(e) mandate depuis la base de donn�es');
		}

		// R�cup�rer le/la mandate depuis le jeu de r�sultats
		return Mandate::fetch($pdo,$pdoStatement,$easyload);
	}

	/**
	 * Charger tous/toutes les mandates
	 * @param $pdo PDO
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Mandate[] tableau de mandates
	 */
	public static function loadAll(PDO $pdo,$easyload=false)
	{
		// S�lectionner tous/toutes les mandates
		$pdoStatement = Mandate::selectAll($pdo);

		// Mettre chaque mandate dans un tableau
		$mandates = array();
		while ($mandate = Mandate::fetch($pdo,$pdoStatement,$easyload)) {
			$mandates[] = $mandate;
		}

		// Retourner le tableau
		return $mandates;
	}

	/**
	 * S�lectionner tous/toutes les mandates
	 * @param $pdo PDO
	 * @return PDOStatement
	 */
	public static function selectAll(PDO $pdo)
	{
		$pdoStatement = Mandate::_select($pdo);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les mandates depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�re le/la mandate suivant(e) d'un jeu de r�sultats
	 * @param $pdo PDO
	 * @param $pdoStatement PDOStatement
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Mandate
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idMandate,$numberMandate,$initDate,$deadDate,$address,$priceFai,$priceSeller,$commission,$estimationFai,$margeNegociation,$referenceCadastreParcelle1,$referenceCadastreParcelle2,$referenceCadastreParcelle3,$autreReferenceParcelle,$superficieParcelle1,$superficieParcelle2,$superficieParcelle3,$superficieAutreParcelle,$superficieConstructible,$superficieTotale,$numberLot,$sHONAccordee,$reglementDeLotissement,$eRNT,$passageEau,$passageElectricite,$passageGaz,$voirie,$tailleFacade,$profondeurTerrain,$commentaire,$geolocalisation,$proximiteEcole,$proximiteCommerce,$proximiteTransport,$commentaireApparent,$nbPiece,$surfaceHabitable,$nbChambre,$surfacePieceVie,$niveau,$anneeConstruction,$chargesMensuelle,$taxesFonciere,$taxeHabitation,$user,$sector,$city,$notary,$mandateType,$transactionType,$etap,$freeDate,$zoneBDF,$ligneDeCrete,$zoneInondable,$dPValide,$dateDeclarationPrealable,$prorogationDPJusquau,$cuValide,$dateCU,$prorogationCUJusquau,$cuOPSValide,$dateCuOPS,$prorogationCuOPSJusquau,$permisDamenagerValide,$datePermisDamenager,$terrainVenduViabilise,$terrainVenduSemiViabilise,$terrainVenduNonViabilise,$toutALegout,$assainissementParFosseSceptique,$coupCoeur,$nouveaute,$cheminee,$cuisineEquipee,$cuisineAmenagee,$piscine,$poolHouse,$terrasse,$mezzanine,$dependance,$gaz,$cave,$sousSol,$garage,$parking,$rezDeJardin,$plainPied,$carriere,$pointEau,$slope,$orientation,$insulation,$news,$heating,$commonOwnership,$roof,$condition,$style,$construction,$sanitationCorresponding,$electricCorresponding,$gazCorresponding,$waterCorresponding,$cos,$zonagePLU,$zonageRNU,$bornageTerrain,$geometer) = $values;

		// Construire le/la mandate
		return isset(Mandate::$easyload[$idMandate.'-'.$numberMandate.'-'.strtotime($initDate).'-'.strtotime($deadDate).'-'.$address.'-'.$priceFai.'-'.$priceSeller.'-'.$commission.'-'.$estimationFai.'-'.$margeNegociation.'-'.$referenceCadastreParcelle1.'-'.$referenceCadastreParcelle2.'-'.$referenceCadastreParcelle3.'-'.$autreReferenceParcelle.'-'.$superficieParcelle1.'-'.$superficieParcelle2.'-'.$superficieParcelle3.'-'.$superficieAutreParcelle.'-'.$superficieConstructible.'-'.$superficieTotale.'-'.$numberLot.'-'.$sHONAccordee.'-'.$reglementDeLotissement.'-'.$eRNT.'-'.$passageEau.'-'.$passageElectricite.'-'.$passageGaz.'-'.$voirie.'-'.$tailleFacade.'-'.$profondeurTerrain.'-'.$commentaire.'-'.$geolocalisation.'-'.$proximiteEcole.'-'.$proximiteCommerce.'-'.$proximiteTransport.'-'.$commentaireApparent.'-'.$nbPiece.'-'.$surfaceHabitable.'-'.$nbChambre.'-'.$surfacePieceVie.'-'.$niveau.'-'.$anneeConstruction.'-'.$chargesMensuelle.'-'.$taxesFonciere.'-'.$taxeHabitation.'-'.$user.'-'.$sector.'-'.$city.'-'.$notary.'-'.$mandateType.'-'.$transactionType.'-'.$etap.'-'.strtotime($freeDate).'-'.$zoneBDF.'-'.$ligneDeCrete.'-'.$zoneInondable.'-'.$dPValide.'-'.strtotime($dateDeclarationPrealable).'-'.strtotime($prorogationDPJusquau).'-'.$cuValide.'-'.$dateCU.'-'.$prorogationCUJusquau.'-'.$cuOPSValide.'-'.strtotime($dateCuOPS).'-'.$prorogationCuOPSJusquau.'-'.$permisDamenagerValide.'-'.strtotime($datePermisDamenager).'-'.$terrainVenduViabilise.'-'.$terrainVenduSemiViabilise.'-'.$terrainVenduNonViabilise.'-'.$toutALegout.'-'.$assainissementParFosseSceptique.'-'.$coupCoeur.'-'.strtotime($nouveaute).'-'.$cheminee.'-'.$cuisineEquipee.'-'.$cuisineAmenagee.'-'.$piscine.'-'.$poolHouse.'-'.$terrasse.'-'.$mezzanine.'-'.$dependance.'-'.$gaz.'-'.$cave.'-'.$sousSol.'-'.$garage.'-'.$parking.'-'.$rezDeJardin.'-'.$plainPied.'-'.$carriere.'-'.$pointEau.'-'.$slope.'-'.$orientation.'-'.$insulation.'-'.$news.'-'.$heating.'-'.$commonOwnership.'-'.$roof.'-'.$condition.'-'.$style.'-'.$construction.'-'.$sanitationCorresponding.'-'.$electricCorresponding.'-'.$gazCorresponding.'-'.$waterCorresponding.'-'.$cos.'-'.$zonagePLU.'-'.$zonageRNU.'-'.$bornageTerrain.'-'.$geometer]) ? Mandate::$easyload[$idMandate.'-'.$numberMandate.'-'.strtotime($initDate).'-'.strtotime($deadDate).'-'.$address.'-'.$priceFai.'-'.$priceSeller.'-'.$commission.'-'.$estimationFai.'-'.$margeNegociation.'-'.$referenceCadastreParcelle1.'-'.$referenceCadastreParcelle2.'-'.$referenceCadastreParcelle3.'-'.$autreReferenceParcelle.'-'.$superficieParcelle1.'-'.$superficieParcelle2.'-'.$superficieParcelle3.'-'.$superficieAutreParcelle.'-'.$superficieConstructible.'-'.$superficieTotale.'-'.$numberLot.'-'.$sHONAccordee.'-'.$reglementDeLotissement.'-'.$eRNT.'-'.$passageEau.'-'.$passageElectricite.'-'.$passageGaz.'-'.$voirie.'-'.$tailleFacade.'-'.$profondeurTerrain.'-'.$commentaire.'-'.$geolocalisation.'-'.$proximiteEcole.'-'.$proximiteCommerce.'-'.$proximiteTransport.'-'.$commentaireApparent.'-'.$nbPiece.'-'.$surfaceHabitable.'-'.$nbChambre.'-'.$surfacePieceVie.'-'.$niveau.'-'.$anneeConstruction.'-'.$chargesMensuelle.'-'.$taxesFonciere.'-'.$taxeHabitation.'-'.$user.'-'.$sector.'-'.$city.'-'.$notary.'-'.$mandateType.'-'.$transactionType.'-'.$etap.'-'.strtotime($freeDate).'-'.$zoneBDF.'-'.$ligneDeCrete.'-'.$zoneInondable.'-'.$dPValide.'-'.strtotime($dateDeclarationPrealable).'-'.strtotime($prorogationDPJusquau).'-'.$cuValide.'-'.$dateCU.'-'.$prorogationCUJusquau.'-'.$cuOPSValide.'-'.strtotime($dateCuOPS).'-'.$prorogationCuOPSJusquau.'-'.$permisDamenagerValide.'-'.strtotime($datePermisDamenager).'-'.$terrainVenduViabilise.'-'.$terrainVenduSemiViabilise.'-'.$terrainVenduNonViabilise.'-'.$toutALegout.'-'.$assainissementParFosseSceptique.'-'.$coupCoeur.'-'.strtotime($nouveaute).'-'.$cheminee.'-'.$cuisineEquipee.'-'.$cuisineAmenagee.'-'.$piscine.'-'.$poolHouse.'-'.$terrasse.'-'.$mezzanine.'-'.$dependance.'-'.$gaz.'-'.$cave.'-'.$sousSol.'-'.$garage.'-'.$parking.'-'.$rezDeJardin.'-'.$plainPied.'-'.$carriere.'-'.$pointEau.'-'.$slope.'-'.$orientation.'-'.$insulation.'-'.$news.'-'.$heating.'-'.$commonOwnership.'-'.$roof.'-'.$condition.'-'.$style.'-'.$construction.'-'.$sanitationCorresponding.'-'.$electricCorresponding.'-'.$gazCorresponding.'-'.$waterCorresponding.'-'.$cos.'-'.$zonagePLU.'-'.$zonageRNU.'-'.$bornageTerrain.'-'.$geometer] :
		new Mandate($pdo,$idMandate,$numberMandate,strtotime($initDate),strtotime($deadDate),$address,$priceFai,$priceSeller,$commission,$estimationFai,$margeNegociation,$referenceCadastreParcelle1,$referenceCadastreParcelle2,$referenceCadastreParcelle3,$autreReferenceParcelle,$superficieParcelle1,$superficieParcelle2,$superficieParcelle3,$superficieAutreParcelle,$superficieConstructible,$superficieTotale,$numberLot,$sHONAccordee,$reglementDeLotissement,$eRNT,$passageEau,$passageElectricite,$passageGaz,$voirie,$tailleFacade,$profondeurTerrain,$commentaire,$geolocalisation,$proximiteEcole,$proximiteCommerce,$proximiteTransport,$commentaireApparent,$nbPiece,$surfaceHabitable,$nbChambre,$surfacePieceVie,$niveau,$anneeConstruction,$chargesMensuelle,$taxesFonciere,$taxeHabitation,$user,$sector,$city,$notary,$mandateType,$transactionType,$etap,strtotime($freeDate),$zoneBDF,$ligneDeCrete,$zoneInondable,$dPValide,strtotime($dateDeclarationPrealable),strtotime($prorogationDPJusquau),$cuValide,$dateCU,$prorogationCUJusquau,$cuOPSValide,strtotime($dateCuOPS),$prorogationCuOPSJusquau,$permisDamenagerValide,strtotime($datePermisDamenager),$terrainVenduViabilise,$terrainVenduSemiViabilise,$terrainVenduNonViabilise,$toutALegout,$assainissementParFosseSceptique,$coupCoeur,strtotime($nouveaute),$cheminee,$cuisineEquipee,$cuisineAmenagee,$piscine,$poolHouse,$terrasse,$mezzanine,$dependance,$gaz,$cave,$sousSol,$garage,$parking,$rezDeJardin,$plainPied,$carriere,$pointEau,$slope,$orientation,$insulation,$news,$heating,$commonOwnership,$roof,$condition,$style,$construction,$sanitationCorresponding,$electricCorresponding,$gazCorresponding,$waterCorresponding,$cos,$zonagePLU,$zonageRNU,$bornageTerrain,$geometer,$easyload);
	}

	/**
	 * Serialiser
	 * @param $serialize bool activer la s�rialisation ?
	 * @return string serialisation du/de la mandate
	 */
	public function serialize($serialize=true)
	{
		// S�rialiser le/la mandate
		$array = array('idMandate' => $this->idMandate,'numberMandate' => $this->numberMandate,'initDate' => $this->initDate,'deadDate' => $this->deadDate,'address' => $this->address,'priceFai' => $this->priceFai,'priceSeller' => $this->priceSeller,'commission' => $this->commission,'estimationFai' => $this->estimationFai,'margeNegociation' => $this->margeNegociation,'referenceCadastreParcelle1' => $this->referenceCadastreParcelle1,'referenceCadastreParcelle2' => $this->referenceCadastreParcelle2,'referenceCadastreParcelle3' => $this->referenceCadastreParcelle3,'autreReferenceParcelle' => $this->autreReferenceParcelle,'superficieParcelle1' => $this->superficieParcelle1,'superficieParcelle2' => $this->superficieParcelle2,'superficieParcelle3' => $this->superficieParcelle3,'superficieAutreParcelle' => $this->superficieAutreParcelle,'superficieConstructible' => $this->superficieConstructible,'superficieTotale' => $this->superficieTotale,'numberLot' => $this->numberLot,'sHONAccordee' => $this->sHONAccordee,'reglementDeLotissement' => $this->reglementDeLotissement,'eRNT' => $this->eRNT,'passageEau' => $this->passageEau,'passageElectricite' => $this->passageElectricite,'passageGaz' => $this->passageGaz,'voirie' => $this->voirie,'tailleFacade' => $this->tailleFacade,'profondeurTerrain' => $this->profondeurTerrain,'commentaire' => $this->commentaire,'geolocalisation' => $this->geolocalisation,'proximiteEcole' => $this->proximiteEcole,'proximiteCommerce' => $this->proximiteCommerce,'proximiteTransport' => $this->proximiteTransport,'commentaireApparent' => $this->commentaireApparent,'nbPiece' => $this->nbPiece,'surfaceHabitable' => $this->surfaceHabitable,'nbChambre' => $this->nbChambre,'surfacePieceVie' => $this->surfacePieceVie,'niveau' => $this->niveau,'anneeConstruction' => $this->anneeConstruction,'chargesMensuelle' => $this->chargesMensuelle,'taxesFonciere' => $this->taxesFonciere,'taxeHabitation' => $this->taxeHabitation,'user' => $this->user,'sector' => $this->sector,'city' => $this->city,'notary' => $this->notary,'mandateType' => $this->mandateType,'transactionType' => $this->transactionType,'etap' => $this->etap,'freeDate' => $this->freeDate,'zoneBDF' => $this->zoneBDF,'ligneDeCrete' => $this->ligneDeCrete,'zoneInondable' => $this->zoneInondable,'dPValide' => $this->dPValide,'dateDeclarationPrealable' => $this->dateDeclarationPrealable,'prorogationDPJusquau' => $this->prorogationDPJusquau,'cuValide' => $this->cuValide,'dateCU' => $this->dateCU,'prorogationCUJusquau' => $this->prorogationCUJusquau,'cuOPSValide' => $this->cuOPSValide,'dateCuOPS' => $this->dateCuOPS,'prorogationCuOPSJusquau' => $this->prorogationCuOPSJusquau,'permisDamenagerValide' => $this->permisDamenagerValide,'datePermisDamenager' => $this->datePermisDamenager,'terrainVenduViabilise' => $this->terrainVenduViabilise,'terrainVenduSemiViabilise' => $this->terrainVenduSemiViabilise,'terrainVenduNonViabilise' => $this->terrainVenduNonViabilise,'toutALegout' => $this->toutALegout,'assainissementParFosseSceptique' => $this->assainissementParFosseSceptique,'coupCoeur' => $this->coupCoeur,'nouveaute' => $this->nouveaute,'cheminee' => $this->cheminee,'cuisineEquipee' => $this->cuisineEquipee,'cuisineAmenagee' => $this->cuisineAmenagee,'piscine' => $this->piscine,'poolHouse' => $this->poolHouse,'terrasse' => $this->terrasse,'mezzanine' => $this->mezzanine,'dependance' => $this->dependance,'gaz' => $this->gaz,'cave' => $this->cave,'sousSol' => $this->sousSol,'garage' => $this->garage,'parking' => $this->parking,'rezDeJardin' => $this->rezDeJardin,'plainPied' => $this->plainPied,'carriere' => $this->carriere,'pointEau' => $this->pointEau,'slope' => $this->slope,'orientation' => $this->orientation,'insulation' => $this->insulation,'news' => $this->news,'heating' => $this->heating,'commonOwnership' => $this->commonOwnership,'roof' => $this->roof,'condition' => $this->condition,'style' => $this->style,'construction' => $this->construction,'sanitationCorresponding' => $this->sanitationCorresponding,'electricCorresponding' => $this->electricCorresponding,'gazCorresponding' => $this->gazCorresponding,'waterCorresponding' => $this->waterCorresponding,'cos' => $this->cos,'zonagePLU' => $this->zonagePLU,'zonageRNU' => $this->zonageRNU,'bornageTerrain' => $this->bornageTerrain,'geometer' => $this->geometer);

		// Retourner la serialisation (ou pas) du/de la mandate
		return $serialize ? serialize($array) : $array;
	}

	/**
	 * D�s�rialiser
	 * @param $pdo PDO
	 * @param $string string serialisation du/de la mandate
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Mandate
	 */
	public static function unserialize(PDO $pdo,$string,$easyload=true)
	{
		// D�s�rialiser la chaine de caract�res
		$array = unserialize($string);

		// Construire le/la mandate
		return isset(Mandate::$easyload[$array['idMandate']]) ? Mandate::$easyload[$array['idMandate']] :
		new Mandate($pdo,$array['idMandate'],$array['numberMandate'],$array['initDate'],$array['deadDate'],$array['address'],$array['priceFai'],$array['priceSeller'],$array['commission'],$array['estimationFai'],$array['margeNegociation'],$array['referenceCadastreParcelle1'],$array['referenceCadastreParcelle2'],$array['referenceCadastreParcelle3'],$array['autreReferenceParcelle'],$array['superficieParcelle1'],$array['superficieParcelle2'],$array['superficieParcelle3'],$array['superficieAutreParcelle'],$array['superficieConstructible'],$array['superficieTotale'],$array['numberLot'],$array['sHONAccordee'],$array['reglementDeLotissement'],$array['eRNT'],$array['passageEau'],$array['passageElectricite'],$array['passageGaz'],$array['voirie'],$array['tailleFacade'],$array['profondeurTerrain'],$array['commentaire'],$array['geolocalisation'],$array['proximiteEcole'],$array['proximiteCommerce'],$array['proximiteTransport'],$array['commentaireApparent'],$array['nbPiece'],$array['surfaceHabitable'],$array['nbChambre'],$array['surfacePieceVie'],$array['niveau'],$array['anneeConstruction'],$array['chargesMensuelle'],$array['taxesFonciere'],$array['taxeHabitation'],$array['user'],$array['sector'],$array['city'],$array['notary'],$array['mandateType'],$array['transactionType'],$array['etap'],$array['freeDate'],$array['zoneBDF'],$array['ligneDeCrete'],$array['zoneInondable'],$array['dPValide'],$array['dateDeclarationPrealable'],$array['prorogationDPJusquau'],$array['cuValide'],$array['dateCU'],$array['prorogationCUJusquau'],$array['cuOPSValide'],$array['dateCuOPS'],$array['prorogationCuOPSJusquau'],$array['permisDamenagerValide'],$array['datePermisDamenager'],$array['terrainVenduViabilise'],$array['terrainVenduSemiViabilise'],$array['terrainVenduNonViabilise'],$array['toutALegout'],$array['assainissementParFosseSceptique'],$array['coupCoeur'],$array['nouveaute'],$array['cheminee'],$array['cuisineEquipee'],$array['cuisineAmenagee'],$array['piscine'],$array['poolHouse'],$array['terrasse'],$array['mezzanine'],$array['dependance'],$array['gaz'],$array['cave'],$array['sousSol'],$array['garage'],$array['parking'],$array['rezDeJardin'],$array['plainPied'],$array['carriere'],$array['pointEau'],$array['slope'],$array['orientation'],$array['insulation'],$array['news'],$array['heating'],$array['commonOwnership'],$array['roof'],$array['condition'],$array['style'],$array['construction'],$array['sanitationCorresponding'],$array['electricCorresponding'],$array['gazCorresponding'],$array['waterCorresponding'],$array['cos'],$array['zonagePLU'],$array['zonageRNU'],$array['bornageTerrain'],$array['geometer'],$easyload);
	}

	/**
	 * Test d'�galit�
	 * @param $mandate Mandate
	 * @return bool les objets sont ils �gaux ?
	 */
	public function equals($mandate)
	{
		// Test si null
		if ($mandate == null) { return false; }

		// Tester la classe
		if (!($mandate instanceof Mandate)) { return false; }

		// Tester les ids
		return $this->idMandate == $mandate->idMandate;
	}

	/**
	 * Compter les mandates
	 * @param $pdo PDO
	 * @return int nombre de mandates
	 */
	public static function count(PDO $pdo)
	{
		if (!($pdoStatement = $pdo->query('SELECT COUNT(idMandate) FROM Mandate'))) {
			throw new Exception('Erreur lors du comptage des mandates dans la base de donn�es');
		}
		return $pdoStatement->fetchColumn();
	}

	/**
	 * Supprimer le/la mandate
	 * @return bool op�ration r�ussie ?
	 */
	public function delete()
	{
		// Supprimer les sellers associ�(e)s
		$select = $this->selectSellers();
		while ($seller = Seller::fetch($this->pdo,$select)) {
			if (!$seller->setMandate(null)) { return false; }
		}

		// Supprimer les pictures associ�(e)s
		$select = $this->selectPictures();
		while ($picture = MandatePicture::fetch($this->pdo,$select)) {
			if (!$picture->setMandate(null)) { return false; }
		}

		// Supprimer les scans associ�(e)s
		$select = $this->selectScans();
		while ($scan = MandateScan::fetch($this->pdo,$select)) {
			if (!$scan->setMandate(null)) { return false; }
		}

		// Supprimer le/la mandate
		$pdoStatement = $this->pdo->prepare('DELETE FROM Mandate WHERE idMandate = ?');
		if (!$pdoStatement->execute(array($this->getIdMandate()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) mandate dans la base de donn�es');
		}

		// Op�ration r�ussie ?
		return $pdoStatement->rowCount() == 1;
	}

	/**
	 * Mettre � jour un champ dans la base de donn�es
	 * @param $fields array
	 * @param $values array
	 * @return bool op�ration r�ussie ?
	 */
	private function _set($fields,$values)
	{
		// Pr�parer la mise � jour
		$updates = array();
		foreach ($fields as $field) {
			$updates[] = $field.' = ?';
		}

		// Mettre � jour le champ
		$pdoStatement = $this->pdo->prepare('UPDATE Mandate SET '.implode(', ', $updates).' WHERE idMandate = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdMandate())))) {
			throw new Exception('Erreur lors de la mise � jour d\'un champ d\'un(e) mandate dans la base de donn�es');
		}

		// Op�ration r�ussie ?
		return $pdoStatement->rowCount() == 1;
	}

	/**
	 * Mettre � jour tous les champs dans la base de donn�es
	 * @return bool op�ration r�ussie ?
	 */
	public function update()
	{
		return $this->_set(array('numberMandate','initDate','deadDate','freeDate','address','priceFai','priceSeller','commission','estimationFai','margeNegociation','referenceCadastreParcelle1','referenceCadastreParcelle2','referenceCadastreParcelle3','autreReferenceParcelle','superficieParcelle1','superficieParcelle2','superficieParcelle3','superficieAutreParcelle','superficieConstructible','superficieTotale','numberLot','sHONAccordee','zoneBDF','ligneDeCrete','zoneInondable','reglementDeLotissement','eRNT','dPValide','dateDeclarationPrealable','prorogationDPJusquau','cuValide','dateCU','prorogationCUJusquau','cuOPSValide','dateCuOPS','prorogationCuOPSJusquau','permisDamenagerValide','datePermisDamenager','terrainVenduViabilise','terrainVenduSemiViabilise','terrainVenduNonViabilise','passageEau','passageElectricite','passageGaz','toutALegout','assainissementParFosseSceptique','voirie','tailleFacade','profondeurTerrain','commentaire','geolocalisation','proximiteEcole','proximiteCommerce','proximiteTransport','commentaireApparent','nbPiece','surfaceHabitable','nbChambre','surfacePieceVie','niveau','anneeConstruction','coupCoeur','chargesMensuelle','taxesFonciere','taxeHabitation','nouveaute','cheminee','cuisineEquipee','cuisineAmenagee','piscine','poolHouse','terrasse','mezzanine','dependance','gaz','cave','sousSol','garage','parking','rezDeJardin','plainPied','carriere','pointEau','user_idUser','sector_idSector','city_idCity','notary_idNotary','mandateType_idMandateType','transactionType_idTransactionType','slope_idMandateSlope','orientation_idMandateOrientation','insulation_idMandateInsulation','news_idMandateNews','heating_idMandateHeating','commonOwnership_idMandateCommonOwnership','roof_idMandateRoof','condition_idMandateCondition','style_idMandateStyle','construction_idMandateConstructionType','sanitationCorresponding_idMandateSanitationCorresponding','electricCorresponding_idMandateElectricCorresponding','gazCorresponding_idMandateGazCorresponding','waterCorresponding_idMandateWaterCorresponding','cos_idMandateCOS','zonagePLU_idMandateZonagePLU','zonageRNU_idMandateZonageRNU','bornageTerrain_idMandateBornageTerrain','geometer_idMandateGeometer','etap_idMandateEtap'),array($this->numberMandate,date('Y-m-d',$this->initDate),date('Y-m-d',$this->deadDate),$this->freeDate === null ? null : date('Y-m-d',$this->freeDate),$this->address,$this->priceFai,$this->priceSeller,$this->commission,$this->estimationFai,$this->margeNegociation,$this->referenceCadastreParcelle1,$this->referenceCadastreParcelle2,$this->referenceCadastreParcelle3,$this->autreReferenceParcelle,$this->superficieParcelle1,$this->superficieParcelle2,$this->superficieParcelle3,$this->superficieAutreParcelle,$this->superficieConstructible,$this->superficieTotale,$this->numberLot,$this->sHONAccordee,$this->zoneBDF,$this->ligneDeCrete,$this->zoneInondable,$this->reglementDeLotissement,$this->eRNT,$this->dPValide,$this->dateDeclarationPrealable === null ? null : date('Y-m-d',$this->dateDeclarationPrealable),$this->prorogationDPJusquau === null ? null : date('Y-m-d',$this->prorogationDPJusquau),$this->cuValide,$this->dateCU,$this->prorogationCUJusquau,$this->cuOPSValide,$this->dateCuOPS === null ? null : date('Y-m-d',$this->dateCuOPS),$this->prorogationCuOPSJusquau,$this->permisDamenagerValide,$this->datePermisDamenager === null ? null : date('Y-m-d',$this->datePermisDamenager),$this->terrainVenduViabilise,$this->terrainVenduSemiViabilise,$this->terrainVenduNonViabilise,$this->passageEau,$this->passageElectricite,$this->passageGaz,$this->toutALegout,$this->assainissementParFosseSceptique,$this->voirie,$this->tailleFacade,$this->profondeurTerrain,$this->commentaire,$this->geolocalisation,$this->proximiteEcole,$this->proximiteCommerce,$this->proximiteTransport,$this->commentaireApparent,$this->nbPiece,$this->surfaceHabitable,$this->nbChambre,$this->surfacePieceVie,$this->niveau,$this->anneeConstruction,$this->coupCoeur,$this->chargesMensuelle,$this->taxesFonciere,$this->taxeHabitation,$this->nouveaute === null ? null : date('Y-m-d',$this->nouveaute),$this->cheminee,$this->cuisineEquipee,$this->cuisineAmenagee,$this->piscine,$this->poolHouse,$this->terrasse,$this->mezzanine,$this->dependance,$this->gaz,$this->cave,$this->sousSol,$this->garage,$this->parking,$this->rezDeJardin,$this->plainPied,$this->carriere,$this->pointEau,$this->user,$this->sector,$this->city,$this->notary,$this->mandateType,$this->transactionType,$this->mandateSlope,$this->mandateOrientation,$this->mandateInsulation,$this->mandateNews,$this->mandateHeating,$this->mandateCommonOwnership,$this->mandateRoof,$this->mandateCondition,$this->mandateStyle,$this->mandateConstructionType,$this->mandateSanitationCorresponding,$this->mandateElectricCorresponding,$this->mandateGazCorresponding,$this->mandateWaterCorresponding,$this->mandateCOS,$this->mandateZonagePLU,$this->mandateZonageRNU,$this->mandateBornageTerrain,$this->mandateGeometer,$this->mandateEtap));
	}

	/**
	 * R�cup�rer le/la idMandate
	 * @return int
	 */
	public function getIdMandate()
	{
		return $this->idMandate;
	}

	/**
	 * R�cup�rer le/la numberMandate
	 * @return int
	 */
	public function getNumberMandate()
	{
		return $this->numberMandate;
	}

	/**
	 * D�finir le/la numberMandate
	 * @param $numberMandate int
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setNumberMandate($numberMandate,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->numberMandate = $numberMandate;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('numberMandate'),array($numberMandate)) : true;
	}

	/**
	 * R�cup�rer le/la initDate
	 * @return int
	 */
	public function getInitDate()
	{
		return $this->initDate;
	}

	/**
	 * D�finir le/la initDate
	 * @param $initDate int
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setInitDate($initDate,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->initDate = $initDate;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('initDate'),array(date('Y-m-d',$initDate))) : true;
	}

	/**
	 * R�cup�rer le/la deadDate
	 * @return int
	 */
	public function getDeadDate()
	{
		return $this->deadDate;
	}

	/**
	 * D�finir le/la deadDate
	 * @param $deadDate int
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setDeadDate($deadDate,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->deadDate = $deadDate;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('deadDate'),array(date('Y-m-d',$deadDate))) : true;
	}

	/**
	 * R�cup�rer le/la freeDate
	 * @return int
	 */
	public function getFreeDate()
	{
		return $this->freeDate;
	}

	/**
	 * D�finir le/la freeDate
	 * @param $freeDate int
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setFreeDate($freeDate=null,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->freeDate = $freeDate;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('freeDate'),array($freeDate === null ? null : date('Y-m-d',$freeDate))) : true;
	}

	/**
	 * R�cup�rer le/la address
	 * @return string
	 */
	public function getAddress()
	{
		return $this->address;
	}

	/**
	 * D�finir le/la address
	 * @param $address string
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setAddress($address,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->address = $address;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('address'),array($address)) : true;
	}

	/**
	 * R�cup�rer le/la priceFai
	 * @return float
	 */
	public function getPriceFai()
	{
		return $this->priceFai;
	}

	/**
	 * D�finir le/la priceFai
	 * @param $priceFai float
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setPriceFai($priceFai,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->priceFai = $priceFai;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('priceFai'),array($priceFai)) : true;
	}

	/**
	 * R�cup�rer le/la priceSeller
	 * @return float
	 */
	public function getPriceSeller()
	{
		return $this->priceSeller;
	}

	/**
	 * D�finir le/la priceSeller
	 * @param $priceSeller float
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setPriceSeller($priceSeller,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->priceSeller = $priceSeller;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('priceSeller'),array($priceSeller)) : true;
	}

	/**
	 * R�cup�rer le/la commission
	 * @return float
	 */
	public function getCommission()
	{
		return $this->commission;
	}

	/**
	 * D�finir le/la commission
	 * @param $commission float
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setCommission($commission,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->commission = $commission;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('commission'),array($commission)) : true;
	}

	/**
	 * R�cup�rer le/la estimationFai
	 * @return float
	 */
	public function getEstimationFai()
	{
		return $this->estimationFai;
	}

	/**
	 * D�finir le/la estimationFai
	 * @param $estimationFai float
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setEstimationFai($estimationFai,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->estimationFai = $estimationFai;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('estimationFai'),array($estimationFai)) : true;
	}

	/**
	 * R�cup�rer le/la margeNegociation
	 * @return float
	 */
	public function getMargeNegociation()
	{
		return $this->margeNegociation;
	}

	/**
	 * D�finir le/la margeNegociation
	 * @param $margeNegociation float
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setMargeNegociation($margeNegociation,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->margeNegociation = $margeNegociation;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('margeNegociation'),array($margeNegociation)) : true;
	}

	/**
	 * R�cup�rer le/la referenceCadastreParcelle1
	 * @return string
	 */
	public function getReferenceCadastreParcelle1()
	{
		return $this->referenceCadastreParcelle1;
	}

	/**
	 * D�finir le/la referenceCadastreParcelle1
	 * @param $referenceCadastreParcelle1 string
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setReferenceCadastreParcelle1($referenceCadastreParcelle1,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->referenceCadastreParcelle1 = $referenceCadastreParcelle1;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('referenceCadastreParcelle1'),array($referenceCadastreParcelle1)) : true;
	}

	/**
	 * R�cup�rer le/la referenceCadastreParcelle2
	 * @return string
	 */
	public function getReferenceCadastreParcelle2()
	{
		return $this->referenceCadastreParcelle2;
	}

	/**
	 * D�finir le/la referenceCadastreParcelle2
	 * @param $referenceCadastreParcelle2 string
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setReferenceCadastreParcelle2($referenceCadastreParcelle2,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->referenceCadastreParcelle2 = $referenceCadastreParcelle2;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('referenceCadastreParcelle2'),array($referenceCadastreParcelle2)) : true;
	}

	/**
	 * R�cup�rer le/la referenceCadastreParcelle3
	 * @return string
	 */
	public function getReferenceCadastreParcelle3()
	{
		return $this->referenceCadastreParcelle3;
	}

	/**
	 * D�finir le/la referenceCadastreParcelle3
	 * @param $referenceCadastreParcelle3 string
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setReferenceCadastreParcelle3($referenceCadastreParcelle3,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->referenceCadastreParcelle3 = $referenceCadastreParcelle3;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('referenceCadastreParcelle3'),array($referenceCadastreParcelle3)) : true;
	}

	/**
	 * R�cup�rer le/la autreReferenceParcelle
	 * @return string
	 */
	public function getAutreReferenceParcelle()
	{
		return $this->autreReferenceParcelle;
	}

	/**
	 * D�finir le/la autreReferenceParcelle
	 * @param $autreReferenceParcelle string
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setAutreReferenceParcelle($autreReferenceParcelle,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->autreReferenceParcelle = $autreReferenceParcelle;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('autreReferenceParcelle'),array($autreReferenceParcelle)) : true;
	}

	/**
	 * R�cup�rer le/la superficieParcelle1
	 * @return int
	 */
	public function getSuperficieParcelle1()
	{
		return $this->superficieParcelle1;
	}

	/**
	 * D�finir le/la superficieParcelle1
	 * @param $superficieParcelle1 int
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setSuperficieParcelle1($superficieParcelle1,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->superficieParcelle1 = $superficieParcelle1;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('superficieParcelle1'),array($superficieParcelle1)) : true;
	}

	/**
	 * R�cup�rer le/la superficieParcelle2
	 * @return int
	 */
	public function getSuperficieParcelle2()
	{
		return $this->superficieParcelle2;
	}

	/**
	 * D�finir le/la superficieParcelle2
	 * @param $superficieParcelle2 int
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setSuperficieParcelle2($superficieParcelle2,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->superficieParcelle2 = $superficieParcelle2;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('superficieParcelle2'),array($superficieParcelle2)) : true;
	}

	/**
	 * R�cup�rer le/la superficieParcelle3
	 * @return int
	 */
	public function getSuperficieParcelle3()
	{
		return $this->superficieParcelle3;
	}

	/**
	 * D�finir le/la superficieParcelle3
	 * @param $superficieParcelle3 int
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setSuperficieParcelle3($superficieParcelle3,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->superficieParcelle3 = $superficieParcelle3;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('superficieParcelle3'),array($superficieParcelle3)) : true;
	}

	/**
	 * R�cup�rer le/la superficieAutreParcelle
	 * @return int
	 */
	public function getSuperficieAutreParcelle()
	{
		return $this->superficieAutreParcelle;
	}

	/**
	 * D�finir le/la superficieAutreParcelle
	 * @param $superficieAutreParcelle int
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setSuperficieAutreParcelle($superficieAutreParcelle,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->superficieAutreParcelle = $superficieAutreParcelle;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('superficieAutreParcelle'),array($superficieAutreParcelle)) : true;
	}

	/**
	 * R�cup�rer le/la superficieConstructible
	 * @return int
	 */
	public function getSuperficieConstructible()
	{
		return $this->superficieConstructible;
	}

	/**
	 * D�finir le/la superficieConstructible
	 * @param $superficieConstructible int
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setSuperficieConstructible($superficieConstructible,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->superficieConstructible = $superficieConstructible;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('superficieConstructible'),array($superficieConstructible)) : true;
	}

	/**
	 * R�cup�rer le/la superficieTotale
	 * @return int
	 */
	public function getSuperficieTotale()
	{
		return $this->superficieTotale;
	}

	/**
	 * D�finir le/la superficieTotale
	 * @param $superficieTotale int
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setSuperficieTotale($superficieTotale,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->superficieTotale = $superficieTotale;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('superficieTotale'),array($superficieTotale)) : true;
	}

	/**
	 * R�cup�rer le/la numberLot
	 * @return string
	 */
	public function getNumberLot()
	{
		return $this->numberLot;
	}

	/**
	 * D�finir le/la numberLot
	 * @param $numberLot string
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setNumberLot($numberLot,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->numberLot = $numberLot;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('numberLot'),array($numberLot)) : true;
	}

	/**
	 * R�cup�rer le/la sHONAccordee
	 * @return int
	 */
	public function getSHONAccordee()
	{
		return $this->sHONAccordee;
	}

	/**
	 * D�finir le/la sHONAccordee
	 * @param $sHONAccordee int
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setSHONAccordee($sHONAccordee,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->sHONAccordee = $sHONAccordee;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('sHONAccordee'),array($sHONAccordee)) : true;
	}

	/**
	 * R�cup�rer le/la zoneBDF
	 * @return bool
	 */
	public function getZoneBDF()
	{
		return $this->zoneBDF;
	}

	/**
	 * D�finir le/la zoneBDF
	 * @param $zoneBDF bool
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setZoneBDF($zoneBDF,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->zoneBDF = $zoneBDF;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('zoneBDF'),array($zoneBDF)) : true;
	}

	/**
	 * R�cup�rer le/la ligneDeCrete
	 * @return bool
	 */
	public function getLigneDeCrete()
	{
		return $this->ligneDeCrete;
	}

	/**
	 * D�finir le/la ligneDeCrete
	 * @param $ligneDeCrete bool
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setLigneDeCrete($ligneDeCrete,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->ligneDeCrete = $ligneDeCrete;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('ligneDeCrete'),array($ligneDeCrete)) : true;
	}

	/**
	 * R�cup�rer le/la zoneInondable
	 * @return bool
	 */
	public function getZoneInondable()
	{
		return $this->zoneInondable;
	}

	/**
	 * D�finir le/la zoneInondable
	 * @param $zoneInondable bool
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setZoneInondable($zoneInondable,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->zoneInondable = $zoneInondable;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('zoneInondable'),array($zoneInondable)) : true;
	}

	/**
	 * R�cup�rer le/la reglementDeLotissement
	 * @return string
	 */
	public function getReglementDeLotissement()
	{
		return $this->reglementDeLotissement;
	}

	/**
	 * D�finir le/la reglementDeLotissement
	 * @param $reglementDeLotissement string
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setReglementDeLotissement($reglementDeLotissement,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->reglementDeLotissement = $reglementDeLotissement;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('reglementDeLotissement'),array($reglementDeLotissement)) : true;
	}

	/**
	 * R�cup�rer le/la eRNT
	 * @return string
	 */
	public function getERNT()
	{
		return $this->eRNT;
	}

	/**
	 * D�finir le/la eRNT
	 * @param $eRNT string
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setERNT($eRNT,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->eRNT = $eRNT;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('eRNT'),array($eRNT)) : true;
	}

	/**
	 * R�cup�rer le/la dPValide
	 * @return bool
	 */
	public function getDPValide()
	{
		return $this->dPValide;
	}

	/**
	 * D�finir le/la dPValide
	 * @param $dPValide bool
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setDPValide($dPValide,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->dPValide = $dPValide;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('dPValide'),array($dPValide)) : true;
	}

	/**
	 * R�cup�rer le/la dateDeclarationPrealable
	 * @return int
	 */
	public function getDateDeclarationPrealable()
	{
		return $this->dateDeclarationPrealable;
	}

	/**
	 * D�finir le/la dateDeclarationPrealable
	 * @param $dateDeclarationPrealable int
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setDateDeclarationPrealable($dateDeclarationPrealable=null,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->dateDeclarationPrealable = $dateDeclarationPrealable;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('dateDeclarationPrealable'),array($dateDeclarationPrealable === null ? null : date('Y-m-d',$dateDeclarationPrealable))) : true;
	}

	/**
	 * R�cup�rer le/la prorogationDPJusquau
	 * @return int
	 */
	public function getProrogationDPJusquau()
	{
		return $this->prorogationDPJusquau;
	}

	/**
	 * D�finir le/la prorogationDPJusquau
	 * @param $prorogationDPJusquau int
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setProrogationDPJusquau($prorogationDPJusquau=null,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->prorogationDPJusquau = $prorogationDPJusquau;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('prorogationDPJusquau'),array($prorogationDPJusquau === null ? null : date('Y-m-d',$prorogationDPJusquau))) : true;
	}

	/**
	 * R�cup�rer le/la cuValide
	 * @return bool
	 */
	public function getCuValide()
	{
		return $this->cuValide;
	}

	/**
	 * D�finir le/la cuValide
	 * @param $cuValide bool
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setCuValide($cuValide,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->cuValide = $cuValide;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('cuValide'),array($cuValide)) : true;
	}

	/**
	 * R�cup�rer le/la dateCU
	 * @return bool
	 */
	public function getDateCU()
	{
		return $this->dateCU;
	}

	/**
	 * D�finir le/la dateCU
	 * @param $dateCU bool
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setDateCU($dateCU,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->dateCU = $dateCU;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('dateCU'),array($dateCU)) : true;
	}

	/**
	 * R�cup�rer le/la prorogationCUJusquau
	 * @return bool
	 */
	public function getProrogationCUJusquau()
	{
		return $this->prorogationCUJusquau;
	}

	/**
	 * D�finir le/la prorogationCUJusquau
	 * @param $prorogationCUJusquau bool
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setProrogationCUJusquau($prorogationCUJusquau,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->prorogationCUJusquau = $prorogationCUJusquau;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('prorogationCUJusquau'),array($prorogationCUJusquau)) : true;
	}

	/**
	 * R�cup�rer le/la cuOPSValide
	 * @return bool
	 */
	public function getCuOPSValide()
	{
		return $this->cuOPSValide;
	}

	/**
	 * D�finir le/la cuOPSValide
	 * @param $cuOPSValide bool
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setCuOPSValide($cuOPSValide,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->cuOPSValide = $cuOPSValide;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('cuOPSValide'),array($cuOPSValide)) : true;
	}

	/**
	 * R�cup�rer le/la dateCuOPS
	 * @return int
	 */
	public function getDateCuOPS()
	{
		return $this->dateCuOPS;
	}

	/**
	 * D�finir le/la dateCuOPS
	 * @param $dateCuOPS int
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setDateCuOPS($dateCuOPS=null,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->dateCuOPS = $dateCuOPS;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('dateCuOPS'),array($dateCuOPS === null ? null : date('Y-m-d',$dateCuOPS))) : true;
	}

	/**
	 * R�cup�rer le/la prorogationCuOPSJusquau
	 * @return bool
	 */
	public function getProrogationCuOPSJusquau()
	{
		return $this->prorogationCuOPSJusquau;
	}

	/**
	 * D�finir le/la prorogationCuOPSJusquau
	 * @param $prorogationCuOPSJusquau bool
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setProrogationCuOPSJusquau($prorogationCuOPSJusquau,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->prorogationCuOPSJusquau = $prorogationCuOPSJusquau;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('prorogationCuOPSJusquau'),array($prorogationCuOPSJusquau)) : true;
	}

	/**
	 * R�cup�rer le/la permisDamenagerValide
	 * @return bool
	 */
	public function getPermisDamenagerValide()
	{
		return $this->permisDamenagerValide;
	}

	/**
	 * D�finir le/la permisDamenagerValide
	 * @param $permisDamenagerValide bool
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setPermisDamenagerValide($permisDamenagerValide,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->permisDamenagerValide = $permisDamenagerValide;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('permisDamenagerValide'),array($permisDamenagerValide)) : true;
	}

	/**
	 * R�cup�rer le/la datePermisDamenager
	 * @return int
	 */
	public function getDatePermisDamenager()
	{
		return $this->datePermisDamenager;
	}

	/**
	 * D�finir le/la datePermisDamenager
	 * @param $datePermisDamenager int
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setDatePermisDamenager($datePermisDamenager=null,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->datePermisDamenager = $datePermisDamenager;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('datePermisDamenager'),array($datePermisDamenager === null ? null : date('Y-m-d',$datePermisDamenager))) : true;
	}

	/**
	 * R�cup�rer le/la terrainVenduViabilise
	 * @return bool
	 */
	public function getTerrainVenduViabilise()
	{
		return $this->terrainVenduViabilise;
	}

	/**
	 * D�finir le/la terrainVenduViabilise
	 * @param $terrainVenduViabilise bool
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setTerrainVenduViabilise($terrainVenduViabilise,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->terrainVenduViabilise = $terrainVenduViabilise;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('terrainVenduViabilise'),array($terrainVenduViabilise)) : true;
	}

	/**
	 * R�cup�rer le/la terrainVenduSemiViabilise
	 * @return bool
	 */
	public function getTerrainVenduSemiViabilise()
	{
		return $this->terrainVenduSemiViabilise;
	}

	/**
	 * D�finir le/la terrainVenduSemiViabilise
	 * @param $terrainVenduSemiViabilise bool
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setTerrainVenduSemiViabilise($terrainVenduSemiViabilise,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->terrainVenduSemiViabilise = $terrainVenduSemiViabilise;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('terrainVenduSemiViabilise'),array($terrainVenduSemiViabilise)) : true;
	}

	/**
	 * R�cup�rer le/la terrainVenduNonViabilise
	 * @return bool
	 */
	public function getTerrainVenduNonViabilise()
	{
		return $this->terrainVenduNonViabilise;
	}

	/**
	 * D�finir le/la terrainVenduNonViabilise
	 * @param $terrainVenduNonViabilise bool
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setTerrainVenduNonViabilise($terrainVenduNonViabilise,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->terrainVenduNonViabilise = $terrainVenduNonViabilise;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('terrainVenduNonViabilise'),array($terrainVenduNonViabilise)) : true;
	}

	/**
	 * R�cup�rer le/la passageEau
	 * @return string
	 */
	public function getPassageEau()
	{
		return $this->passageEau;
	}

	/**
	 * D�finir le/la passageEau
	 * @param $passageEau string
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setPassageEau($passageEau,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->passageEau = $passageEau;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('passageEau'),array($passageEau)) : true;
	}

	/**
	 * R�cup�rer le/la passageElectricite
	 * @return string
	 */
	public function getPassageElectricite()
	{
		return $this->passageElectricite;
	}

	/**
	 * D�finir le/la passageElectricite
	 * @param $passageElectricite string
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setPassageElectricite($passageElectricite,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->passageElectricite = $passageElectricite;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('passageElectricite'),array($passageElectricite)) : true;
	}

	/**
	 * R�cup�rer le/la passageGaz
	 * @return string
	 */
	public function getPassageGaz()
	{
		return $this->passageGaz;
	}

	/**
	 * D�finir le/la passageGaz
	 * @param $passageGaz string
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setPassageGaz($passageGaz,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->passageGaz = $passageGaz;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('passageGaz'),array($passageGaz)) : true;
	}

	/**
	 * R�cup�rer le/la toutALegout
	 * @return bool
	 */
	public function getToutALegout()
	{
		return $this->toutALegout;
	}

	/**
	 * D�finir le/la toutALegout
	 * @param $toutALegout bool
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setToutALegout($toutALegout,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->toutALegout = $toutALegout;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('toutALegout'),array($toutALegout)) : true;
	}

	/**
	 * R�cup�rer le/la assainissementParFosseSceptique
	 * @return bool
	 */
	public function getAssainissementParFosseSceptique()
	{
		return $this->assainissementParFosseSceptique;
	}

	/**
	 * D�finir le/la assainissementParFosseSceptique
	 * @param $assainissementParFosseSceptique bool
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setAssainissementParFosseSceptique($assainissementParFosseSceptique,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->assainissementParFosseSceptique = $assainissementParFosseSceptique;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('assainissementParFosseSceptique'),array($assainissementParFosseSceptique)) : true;
	}

	/**
	 * R�cup�rer le/la voirie
	 * @return string
	 */
	public function getVoirie()
	{
		return $this->voirie;
	}

	/**
	 * D�finir le/la voirie
	 * @param $voirie string
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setVoirie($voirie,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->voirie = $voirie;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('voirie'),array($voirie)) : true;
	}

	/**
	 * R�cup�rer le/la tailleFacade
	 * @return int
	 */
	public function getTailleFacade()
	{
		return $this->tailleFacade;
	}

	/**
	 * D�finir le/la tailleFacade
	 * @param $tailleFacade int
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setTailleFacade($tailleFacade,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->tailleFacade = $tailleFacade;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('tailleFacade'),array($tailleFacade)) : true;
	}

	/**
	 * R�cup�rer le/la profondeurTerrain
	 * @return int
	 */
	public function getProfondeurTerrain()
	{
		return $this->profondeurTerrain;
	}

	/**
	 * D�finir le/la profondeurTerrain
	 * @param $profondeurTerrain int
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setProfondeurTerrain($profondeurTerrain,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->profondeurTerrain = $profondeurTerrain;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('profondeurTerrain'),array($profondeurTerrain)) : true;
	}

	/**
	 * R�cup�rer le/la commentaire
	 * @return string
	 */
	public function getCommentaire()
	{
		return $this->commentaire;
	}

	/**
	 * D�finir le/la commentaire
	 * @param $commentaire string
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setCommentaire($commentaire,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->commentaire = $commentaire;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('commentaire'),array($commentaire)) : true;
	}

	/**
	 * R�cup�rer le/la geolocalisation
	 * @return string
	 */
	public function getGeolocalisation()
	{
		return $this->geolocalisation;
	}

	/**
	 * D�finir le/la geolocalisation
	 * @param $geolocalisation string
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setGeolocalisation($geolocalisation,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->geolocalisation = $geolocalisation;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('geolocalisation'),array($geolocalisation)) : true;
	}

	/**
	 * R�cup�rer le/la proximiteEcole
	 * @return int
	 */
	public function getProximiteEcole()
	{
		return $this->proximiteEcole;
	}

	/**
	 * D�finir le/la proximiteEcole
	 * @param $proximiteEcole int
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setProximiteEcole($proximiteEcole,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->proximiteEcole = $proximiteEcole;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('proximiteEcole'),array($proximiteEcole)) : true;
	}

	/**
	 * R�cup�rer le/la proximiteCommerce
	 * @return int
	 */
	public function getProximiteCommerce()
	{
		return $this->proximiteCommerce;
	}

	/**
	 * D�finir le/la proximiteCommerce
	 * @param $proximiteCommerce int
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setProximiteCommerce($proximiteCommerce,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->proximiteCommerce = $proximiteCommerce;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('proximiteCommerce'),array($proximiteCommerce)) : true;
	}

	/**
	 * R�cup�rer le/la proximiteTransport
	 * @return int
	 */
	public function getProximiteTransport()
	{
		return $this->proximiteTransport;
	}

	/**
	 * D�finir le/la proximiteTransport
	 * @param $proximiteTransport int
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setProximiteTransport($proximiteTransport,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->proximiteTransport = $proximiteTransport;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('proximiteTransport'),array($proximiteTransport)) : true;
	}

	/**
	 * R�cup�rer le/la commentaireApparent
	 * @return string
	 */
	public function getCommentaireApparent()
	{
		return $this->commentaireApparent;
	}

	/**
	 * D�finir le/la commentaireApparent
	 * @param $commentaireApparent string
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setCommentaireApparent($commentaireApparent,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->commentaireApparent = $commentaireApparent;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('commentaireApparent'),array($commentaireApparent)) : true;
	}

	/**
	 * R�cup�rer le/la nbPiece
	 * @return int
	 */
	public function getNbPiece()
	{
		return $this->nbPiece;
	}

	/**
	 * D�finir le/la nbPiece
	 * @param $nbPiece int
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setNbPiece($nbPiece,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->nbPiece = $nbPiece;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('nbPiece'),array($nbPiece)) : true;
	}

	/**
	 * R�cup�rer le/la surfaceHabitable
	 * @return int
	 */
	public function getSurfaceHabitable()
	{
		return $this->surfaceHabitable;
	}

	/**
	 * D�finir le/la surfaceHabitable
	 * @param $surfaceHabitable int
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setSurfaceHabitable($surfaceHabitable,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->surfaceHabitable = $surfaceHabitable;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('surfaceHabitable'),array($surfaceHabitable)) : true;
	}

	/**
	 * R�cup�rer le/la nbChambre
	 * @return int
	 */
	public function getNbChambre()
	{
		return $this->nbChambre;
	}

	/**
	 * D�finir le/la nbChambre
	 * @param $nbChambre int
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setNbChambre($nbChambre,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->nbChambre = $nbChambre;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('nbChambre'),array($nbChambre)) : true;
	}

	/**
	 * R�cup�rer le/la surfacePieceVie
	 * @return int
	 */
	public function getSurfacePieceVie()
	{
		return $this->surfacePieceVie;
	}

	/**
	 * D�finir le/la surfacePieceVie
	 * @param $surfacePieceVie int
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setSurfacePieceVie($surfacePieceVie,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->surfacePieceVie = $surfacePieceVie;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('surfacePieceVie'),array($surfacePieceVie)) : true;
	}

	/**
	 * R�cup�rer le/la niveau
	 * @return int
	 */
	public function getNiveau()
	{
		return $this->niveau;
	}

	/**
	 * D�finir le/la niveau
	 * @param $niveau int
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setNiveau($niveau,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->niveau = $niveau;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('niveau'),array($niveau)) : true;
	}

	/**
	 * R�cup�rer le/la anneeConstruction
	 * @return int
	 */
	public function getAnneeConstruction()
	{
		return $this->anneeConstruction;
	}

	/**
	 * D�finir le/la anneeConstruction
	 * @param $anneeConstruction int
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setAnneeConstruction($anneeConstruction,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->anneeConstruction = $anneeConstruction;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('anneeConstruction'),array($anneeConstruction)) : true;
	}

	/**
	 * R�cup�rer le/la coupCoeur
	 * @return bool
	 */
	public function getCoupCoeur()
	{
		return $this->coupCoeur;
	}

	/**
	 * D�finir le/la coupCoeur
	 * @param $coupCoeur bool
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setCoupCoeur($coupCoeur,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->coupCoeur = $coupCoeur;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('coupCoeur'),array($coupCoeur)) : true;
	}

	/**
	 * R�cup�rer le/la chargesMensuelle
	 * @return int
	 */
	public function getChargesMensuelle()
	{
		return $this->chargesMensuelle;
	}

	/**
	 * D�finir le/la chargesMensuelle
	 * @param $chargesMensuelle int
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setChargesMensuelle($chargesMensuelle,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->chargesMensuelle = $chargesMensuelle;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('chargesMensuelle'),array($chargesMensuelle)) : true;
	}

	/**
	 * R�cup�rer le/la taxesFonciere
	 * @return int
	 */
	public function getTaxesFonciere()
	{
		return $this->taxesFonciere;
	}

	/**
	 * D�finir le/la taxesFonciere
	 * @param $taxesFonciere int
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setTaxesFonciere($taxesFonciere,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->taxesFonciere = $taxesFonciere;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('taxesFonciere'),array($taxesFonciere)) : true;
	}

	/**
	 * R�cup�rer le/la taxeHabitation
	 * @return int
	 */
	public function getTaxeHabitation()
	{
		return $this->taxeHabitation;
	}

	/**
	 * D�finir le/la taxeHabitation
	 * @param $taxeHabitation int
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setTaxeHabitation($taxeHabitation,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->taxeHabitation = $taxeHabitation;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('taxeHabitation'),array($taxeHabitation)) : true;
	}

	/**
	 * R�cup�rer le/la nouveaute
	 * @return int
	 */
	public function getNouveaute()
	{
		return $this->nouveaute;
	}

	/**
	 * D�finir le/la nouveaute
	 * @param $nouveaute int
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setNouveaute($nouveaute=null,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->nouveaute = $nouveaute;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('nouveaute'),array($nouveaute === null ? null : date('Y-m-d',$nouveaute))) : true;
	}

	/**
	 * R�cup�rer le/la cheminee
	 * @return bool
	 */
	public function getCheminee()
	{
		return $this->cheminee;
	}

	/**
	 * D�finir le/la cheminee
	 * @param $cheminee bool
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setCheminee($cheminee,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->cheminee = $cheminee;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('cheminee'),array($cheminee)) : true;
	}

	/**
	 * R�cup�rer le/la cuisineEquipee
	 * @return bool
	 */
	public function getCuisineEquipee()
	{
		return $this->cuisineEquipee;
	}

	/**
	 * D�finir le/la cuisineEquipee
	 * @param $cuisineEquipee bool
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setCuisineEquipee($cuisineEquipee,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->cuisineEquipee = $cuisineEquipee;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('cuisineEquipee'),array($cuisineEquipee)) : true;
	}

	/**
	 * R�cup�rer le/la cuisineAmenagee
	 * @return bool
	 */
	public function getCuisineAmenagee()
	{
		return $this->cuisineAmenagee;
	}

	/**
	 * D�finir le/la cuisineAmenagee
	 * @param $cuisineAmenagee bool
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setCuisineAmenagee($cuisineAmenagee,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->cuisineAmenagee = $cuisineAmenagee;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('cuisineAmenagee'),array($cuisineAmenagee)) : true;
	}

	/**
	 * R�cup�rer le/la piscine
	 * @return bool
	 */
	public function getPiscine()
	{
		return $this->piscine;
	}

	/**
	 * D�finir le/la piscine
	 * @param $piscine bool
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setPiscine($piscine,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->piscine = $piscine;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('piscine'),array($piscine)) : true;
	}

	/**
	 * R�cup�rer le/la poolHouse
	 * @return bool
	 */
	public function getPoolHouse()
	{
		return $this->poolHouse;
	}

	/**
	 * D�finir le/la poolHouse
	 * @param $poolHouse bool
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setPoolHouse($poolHouse,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->poolHouse = $poolHouse;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('poolHouse'),array($poolHouse)) : true;
	}

	/**
	 * R�cup�rer le/la terrasse
	 * @return bool
	 */
	public function getTerrasse()
	{
		return $this->terrasse;
	}

	/**
	 * D�finir le/la terrasse
	 * @param $terrasse bool
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setTerrasse($terrasse,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->terrasse = $terrasse;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('terrasse'),array($terrasse)) : true;
	}

	/**
	 * R�cup�rer le/la mezzanine
	 * @return bool
	 */
	public function getMezzanine()
	{
		return $this->mezzanine;
	}

	/**
	 * D�finir le/la mezzanine
	 * @param $mezzanine bool
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setMezzanine($mezzanine,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->mezzanine = $mezzanine;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('mezzanine'),array($mezzanine)) : true;
	}

	/**
	 * R�cup�rer le/la dependance
	 * @return bool
	 */
	public function getDependance()
	{
		return $this->dependance;
	}

	/**
	 * D�finir le/la dependance
	 * @param $dependance bool
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setDependance($dependance,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->dependance = $dependance;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('dependance'),array($dependance)) : true;
	}

	/**
	 * R�cup�rer le/la gaz
	 * @return bool
	 */
	public function getGaz()
	{
		return $this->gaz;
	}

	/**
	 * D�finir le/la gaz
	 * @param $gaz bool
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setGaz($gaz,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->gaz = $gaz;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('gaz'),array($gaz)) : true;
	}

	/**
	 * R�cup�rer le/la cave
	 * @return bool
	 */
	public function getCave()
	{
		return $this->cave;
	}

	/**
	 * D�finir le/la cave
	 * @param $cave bool
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setCave($cave,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->cave = $cave;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('cave'),array($cave)) : true;
	}

	/**
	 * R�cup�rer le/la sousSol
	 * @return bool
	 */
	public function getSousSol()
	{
		return $this->sousSol;
	}

	/**
	 * D�finir le/la sousSol
	 * @param $sousSol bool
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setSousSol($sousSol,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->sousSol = $sousSol;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('sousSol'),array($sousSol)) : true;
	}

	/**
	 * R�cup�rer le/la garage
	 * @return bool
	 */
	public function getGarage()
	{
		return $this->garage;
	}

	/**
	 * D�finir le/la garage
	 * @param $garage bool
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setGarage($garage,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->garage = $garage;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('garage'),array($garage)) : true;
	}

	/**
	 * R�cup�rer le/la parking
	 * @return bool
	 */
	public function getParking()
	{
		return $this->parking;
	}

	/**
	 * D�finir le/la parking
	 * @param $parking bool
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setParking($parking,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->parking = $parking;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('parking'),array($parking)) : true;
	}

	/**
	 * R�cup�rer le/la rezDeJardin
	 * @return bool
	 */
	public function getRezDeJardin()
	{
		return $this->rezDeJardin;
	}

	/**
	 * D�finir le/la rezDeJardin
	 * @param $rezDeJardin bool
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setRezDeJardin($rezDeJardin,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->rezDeJardin = $rezDeJardin;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('rezDeJardin'),array($rezDeJardin)) : true;
	}

	/**
	 * R�cup�rer le/la plainPied
	 * @return bool
	 */
	public function getPlainPied()
	{
		return $this->plainPied;
	}

	/**
	 * D�finir le/la plainPied
	 * @param $plainPied bool
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setPlainPied($plainPied,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->plainPied = $plainPied;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('plainPied'),array($plainPied)) : true;
	}

	/**
	 * R�cup�rer le/la carriere
	 * @return bool
	 */
	public function getCarriere()
	{
		return $this->carriere;
	}

	/**
	 * D�finir le/la carriere
	 * @param $carriere bool
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setCarriere($carriere,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->carriere = $carriere;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('carriere'),array($carriere)) : true;
	}

	/**
	 * R�cup�rer le/la pointEau
	 * @return bool
	 */
	public function getPointEau()
	{
		return $this->pointEau;
	}

	/**
	 * D�finir le/la pointEau
	 * @param $pointEau bool
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setPointEau($pointEau,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->pointEau = $pointEau;

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('pointEau'),array($pointEau)) : true;
	}

	/**
	 * R�cup�rer le/la user
	 * @return User
	 */
	public function getUser()
	{
		return User::load($this->pdo,$this->user);
	}

	/**
	 * D�finir le/la user
	 * @param $user User
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setUser(User $user,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->user = $user->getIdUser();

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('user_idUser'),array($user->getIdUser())) : true;
	}

	/**
	 * S�lectionner les mandates par user
	 * @param $pdo PDO
	 * @param $user User
	 * @return PDOStatement
	 */
	public static function selectByUser(PDO $pdo,User $user)
	{
		$pdoStatement = $pdo->prepare('SELECT m.idMandate, m.numberMandate, m.initDate, m.deadDate, m.address, m.priceFai, m.priceSeller, m.commission, m.estimationFai, m.margeNegociation, m.referenceCadastreParcelle1, m.referenceCadastreParcelle2, m.referenceCadastreParcelle3, m.autreReferenceParcelle, m.superficieParcelle1, m.superficieParcelle2, m.superficieParcelle3, m.superficieAutreParcelle, m.superficieConstructible, m.superficieTotale, m.numberLot, m.sHONAccordee, m.reglementDeLotissement, m.eRNT, m.passageEau, m.passageElectricite, m.passageGaz, m.voirie, m.tailleFacade, m.profondeurTerrain, m.commentaire, m.geolocalisation, m.proximiteEcole, m.proximiteCommerce, m.proximiteTransport, m.commentaireApparent, m.nbPiece, m.surfaceHabitable, m.nbChambre, m.surfacePieceVie, m.niveau, m.anneeConstruction, m.chargesMensuelle, m.taxesFonciere, m.taxeHabitation, m.user_idUser, m.sector_idSector, m.city_idCity, m.notary_idNotary, m.mandateType_idMandateType, m.transactionType_idTransactionType, m.etap_idMandateEtap, m.freeDate, m.zoneBDF, m.ligneDeCrete, m.zoneInondable, m.dPValide, m.dateDeclarationPrealable, m.prorogationDPJusquau, m.cuValide, m.dateCU, m.prorogationCUJusquau, m.cuOPSValide, m.dateCuOPS, m.prorogationCuOPSJusquau, m.permisDamenagerValide, m.datePermisDamenager, m.terrainVenduViabilise, m.terrainVenduSemiViabilise, m.terrainVenduNonViabilise, m.toutALegout, m.assainissementParFosseSceptique, m.coupCoeur, m.nouveaute, m.cheminee, m.cuisineEquipee, m.cuisineAmenagee, m.piscine, m.poolHouse, m.terrasse, m.mezzanine, m.dependance, m.gaz, m.cave, m.sousSol, m.garage, m.parking, m.rezDeJardin, m.plainPied, m.carriere, m.pointEau, m.slope_idMandateSlope, m.orientation_idMandateOrientation, m.insulation_idMandateInsulation, m.news_idMandateNews, m.heating_idMandateHeating, m.commonOwnership_idMandateCommonOwnership, m.roof_idMandateRoof, m.condition_idMandateCondition, m.style_idMandateStyle, m.construction_idMandateConstructionType, m.sanitationCorresponding_idMandateSanitationCorresponding, m.electricCorresponding_idMandateElectricCorresponding, m.gazCorresponding_idMandateGazCorresponding, m.waterCorresponding_idMandateWaterCorresponding, m.cos_idMandateCOS, m.zonagePLU_idMandateZonagePLU, m.zonageRNU_idMandateZonageRNU, m.bornageTerrain_idMandateBornageTerrain, m.geometer_idMandateGeometer FROM Mandate m WHERE m.user_idUser = ?');
		if (!$pdoStatement->execute(array($user->getIdUser()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les mandates par user depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�rer le/la sector
	 * @return Sector
	 */
	public function getSector()
	{
		return Sector::load($this->pdo,$this->sector);
	}

	/**
	 * D�finir le/la sector
	 * @param $sector Sector
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setSector(Sector $sector,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->sector = $sector->getIdSector();

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('sector_idSector'),array($sector->getIdSector())) : true;
	}

	/**
	 * S�lectionner les mandates par sector
	 * @param $pdo PDO
	 * @param $sector Sector
	 * @return PDOStatement
	 */
	public static function selectBySector(PDO $pdo,Sector $sector)
	{
		$pdoStatement = $pdo->prepare('SELECT m.idMandate, m.numberMandate, m.initDate, m.deadDate, m.address, m.priceFai, m.priceSeller, m.commission, m.estimationFai, m.margeNegociation, m.referenceCadastreParcelle1, m.referenceCadastreParcelle2, m.referenceCadastreParcelle3, m.autreReferenceParcelle, m.superficieParcelle1, m.superficieParcelle2, m.superficieParcelle3, m.superficieAutreParcelle, m.superficieConstructible, m.superficieTotale, m.numberLot, m.sHONAccordee, m.reglementDeLotissement, m.eRNT, m.passageEau, m.passageElectricite, m.passageGaz, m.voirie, m.tailleFacade, m.profondeurTerrain, m.commentaire, m.geolocalisation, m.proximiteEcole, m.proximiteCommerce, m.proximiteTransport, m.commentaireApparent, m.nbPiece, m.surfaceHabitable, m.nbChambre, m.surfacePieceVie, m.niveau, m.anneeConstruction, m.chargesMensuelle, m.taxesFonciere, m.taxeHabitation, m.user_idUser, m.sector_idSector, m.city_idCity, m.notary_idNotary, m.mandateType_idMandateType, m.transactionType_idTransactionType, m.etap_idMandateEtap, m.freeDate, m.zoneBDF, m.ligneDeCrete, m.zoneInondable, m.dPValide, m.dateDeclarationPrealable, m.prorogationDPJusquau, m.cuValide, m.dateCU, m.prorogationCUJusquau, m.cuOPSValide, m.dateCuOPS, m.prorogationCuOPSJusquau, m.permisDamenagerValide, m.datePermisDamenager, m.terrainVenduViabilise, m.terrainVenduSemiViabilise, m.terrainVenduNonViabilise, m.toutALegout, m.assainissementParFosseSceptique, m.coupCoeur, m.nouveaute, m.cheminee, m.cuisineEquipee, m.cuisineAmenagee, m.piscine, m.poolHouse, m.terrasse, m.mezzanine, m.dependance, m.gaz, m.cave, m.sousSol, m.garage, m.parking, m.rezDeJardin, m.plainPied, m.carriere, m.pointEau, m.slope_idMandateSlope, m.orientation_idMandateOrientation, m.insulation_idMandateInsulation, m.news_idMandateNews, m.heating_idMandateHeating, m.commonOwnership_idMandateCommonOwnership, m.roof_idMandateRoof, m.condition_idMandateCondition, m.style_idMandateStyle, m.construction_idMandateConstructionType, m.sanitationCorresponding_idMandateSanitationCorresponding, m.electricCorresponding_idMandateElectricCorresponding, m.gazCorresponding_idMandateGazCorresponding, m.waterCorresponding_idMandateWaterCorresponding, m.cos_idMandateCOS, m.zonagePLU_idMandateZonagePLU, m.zonageRNU_idMandateZonageRNU, m.bornageTerrain_idMandateBornageTerrain, m.geometer_idMandateGeometer FROM Mandate m WHERE m.sector_idSector = ?');
		if (!$pdoStatement->execute(array($sector->getIdSector()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les mandates par sector depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�rer le/la city
	 * @return City
	 */
	public function getCity()
	{
		return City::load($this->pdo,$this->city);
	}

	/**
	 * D�finir le/la city
	 * @param $city City
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setCity(City $city,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->city = $city->getIdCity();

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('city_idCity'),array($city->getIdCity())) : true;
	}

	/**
	 * S�lectionner les mandates par city
	 * @param $pdo PDO
	 * @param $city City
	 * @return PDOStatement
	 */
	public static function selectByCity(PDO $pdo,City $city)
	{
		$pdoStatement = $pdo->prepare('SELECT m.idMandate, m.numberMandate, m.initDate, m.deadDate, m.address, m.priceFai, m.priceSeller, m.commission, m.estimationFai, m.margeNegociation, m.referenceCadastreParcelle1, m.referenceCadastreParcelle2, m.referenceCadastreParcelle3, m.autreReferenceParcelle, m.superficieParcelle1, m.superficieParcelle2, m.superficieParcelle3, m.superficieAutreParcelle, m.superficieConstructible, m.superficieTotale, m.numberLot, m.sHONAccordee, m.reglementDeLotissement, m.eRNT, m.passageEau, m.passageElectricite, m.passageGaz, m.voirie, m.tailleFacade, m.profondeurTerrain, m.commentaire, m.geolocalisation, m.proximiteEcole, m.proximiteCommerce, m.proximiteTransport, m.commentaireApparent, m.nbPiece, m.surfaceHabitable, m.nbChambre, m.surfacePieceVie, m.niveau, m.anneeConstruction, m.chargesMensuelle, m.taxesFonciere, m.taxeHabitation, m.user_idUser, m.sector_idSector, m.city_idCity, m.notary_idNotary, m.mandateType_idMandateType, m.transactionType_idTransactionType, m.etap_idMandateEtap, m.freeDate, m.zoneBDF, m.ligneDeCrete, m.zoneInondable, m.dPValide, m.dateDeclarationPrealable, m.prorogationDPJusquau, m.cuValide, m.dateCU, m.prorogationCUJusquau, m.cuOPSValide, m.dateCuOPS, m.prorogationCuOPSJusquau, m.permisDamenagerValide, m.datePermisDamenager, m.terrainVenduViabilise, m.terrainVenduSemiViabilise, m.terrainVenduNonViabilise, m.toutALegout, m.assainissementParFosseSceptique, m.coupCoeur, m.nouveaute, m.cheminee, m.cuisineEquipee, m.cuisineAmenagee, m.piscine, m.poolHouse, m.terrasse, m.mezzanine, m.dependance, m.gaz, m.cave, m.sousSol, m.garage, m.parking, m.rezDeJardin, m.plainPied, m.carriere, m.pointEau, m.slope_idMandateSlope, m.orientation_idMandateOrientation, m.insulation_idMandateInsulation, m.news_idMandateNews, m.heating_idMandateHeating, m.commonOwnership_idMandateCommonOwnership, m.roof_idMandateRoof, m.condition_idMandateCondition, m.style_idMandateStyle, m.construction_idMandateConstructionType, m.sanitationCorresponding_idMandateSanitationCorresponding, m.electricCorresponding_idMandateElectricCorresponding, m.gazCorresponding_idMandateGazCorresponding, m.waterCorresponding_idMandateWaterCorresponding, m.cos_idMandateCOS, m.zonagePLU_idMandateZonagePLU, m.zonageRNU_idMandateZonageRNU, m.bornageTerrain_idMandateBornageTerrain, m.geometer_idMandateGeometer FROM Mandate m WHERE m.city_idCity = ?');
		if (!$pdoStatement->execute(array($city->getIdCity()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les mandates par city depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�rer le/la notary
	 * @return Notary
	 */
	public function getNotary()
	{
		return Notary::load($this->pdo,$this->notary);
	}

	/**
	 * D�finir le/la notary
	 * @param $notary Notary
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setNotary(Notary $notary,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->notary = $notary->getIdNotary();

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('notary_idNotary'),array($notary->getIdNotary())) : true;
	}

	/**
	 * S�lectionner les mandates par notary
	 * @param $pdo PDO
	 * @param $notary Notary
	 * @return PDOStatement
	 */
	public static function selectByNotary(PDO $pdo,Notary $notary)
	{
		$pdoStatement = $pdo->prepare('SELECT m.idMandate, m.numberMandate, m.initDate, m.deadDate, m.address, m.priceFai, m.priceSeller, m.commission, m.estimationFai, m.margeNegociation, m.referenceCadastreParcelle1, m.referenceCadastreParcelle2, m.referenceCadastreParcelle3, m.autreReferenceParcelle, m.superficieParcelle1, m.superficieParcelle2, m.superficieParcelle3, m.superficieAutreParcelle, m.superficieConstructible, m.superficieTotale, m.numberLot, m.sHONAccordee, m.reglementDeLotissement, m.eRNT, m.passageEau, m.passageElectricite, m.passageGaz, m.voirie, m.tailleFacade, m.profondeurTerrain, m.commentaire, m.geolocalisation, m.proximiteEcole, m.proximiteCommerce, m.proximiteTransport, m.commentaireApparent, m.nbPiece, m.surfaceHabitable, m.nbChambre, m.surfacePieceVie, m.niveau, m.anneeConstruction, m.chargesMensuelle, m.taxesFonciere, m.taxeHabitation, m.user_idUser, m.sector_idSector, m.city_idCity, m.notary_idNotary, m.mandateType_idMandateType, m.transactionType_idTransactionType, m.etap_idMandateEtap, m.freeDate, m.zoneBDF, m.ligneDeCrete, m.zoneInondable, m.dPValide, m.dateDeclarationPrealable, m.prorogationDPJusquau, m.cuValide, m.dateCU, m.prorogationCUJusquau, m.cuOPSValide, m.dateCuOPS, m.prorogationCuOPSJusquau, m.permisDamenagerValide, m.datePermisDamenager, m.terrainVenduViabilise, m.terrainVenduSemiViabilise, m.terrainVenduNonViabilise, m.toutALegout, m.assainissementParFosseSceptique, m.coupCoeur, m.nouveaute, m.cheminee, m.cuisineEquipee, m.cuisineAmenagee, m.piscine, m.poolHouse, m.terrasse, m.mezzanine, m.dependance, m.gaz, m.cave, m.sousSol, m.garage, m.parking, m.rezDeJardin, m.plainPied, m.carriere, m.pointEau, m.slope_idMandateSlope, m.orientation_idMandateOrientation, m.insulation_idMandateInsulation, m.news_idMandateNews, m.heating_idMandateHeating, m.commonOwnership_idMandateCommonOwnership, m.roof_idMandateRoof, m.condition_idMandateCondition, m.style_idMandateStyle, m.construction_idMandateConstructionType, m.sanitationCorresponding_idMandateSanitationCorresponding, m.electricCorresponding_idMandateElectricCorresponding, m.gazCorresponding_idMandateGazCorresponding, m.waterCorresponding_idMandateWaterCorresponding, m.cos_idMandateCOS, m.zonagePLU_idMandateZonagePLU, m.zonageRNU_idMandateZonageRNU, m.bornageTerrain_idMandateBornageTerrain, m.geometer_idMandateGeometer FROM Mandate m WHERE m.notary_idNotary = ?');
		if (!$pdoStatement->execute(array($notary->getIdNotary()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les mandates par notary depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�rer le/la mandateType
	 * @return MandateType
	 */
	public function getMandateType()
	{
		return MandateType::load($this->pdo,$this->mandateType);
	}

	/**
	 * D�finir le/la mandateType
	 * @param $mandateType MandateType
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setMandateType(MandateType $mandateType,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->mandateType = $mandateType->getIdMandateType();

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('mandateType_idMandateType'),array($mandateType->getIdMandateType())) : true;
	}

	/**
	 * S�lectionner les mandates par mandateType
	 * @param $pdo PDO
	 * @param $mandateType MandateType
	 * @return PDOStatement
	 */
	public static function selectByMandateType(PDO $pdo,MandateType $mandateType)
	{
		$pdoStatement = $pdo->prepare('SELECT m.idMandate, m.numberMandate, m.initDate, m.deadDate, m.address, m.priceFai, m.priceSeller, m.commission, m.estimationFai, m.margeNegociation, m.referenceCadastreParcelle1, m.referenceCadastreParcelle2, m.referenceCadastreParcelle3, m.autreReferenceParcelle, m.superficieParcelle1, m.superficieParcelle2, m.superficieParcelle3, m.superficieAutreParcelle, m.superficieConstructible, m.superficieTotale, m.numberLot, m.sHONAccordee, m.reglementDeLotissement, m.eRNT, m.passageEau, m.passageElectricite, m.passageGaz, m.voirie, m.tailleFacade, m.profondeurTerrain, m.commentaire, m.geolocalisation, m.proximiteEcole, m.proximiteCommerce, m.proximiteTransport, m.commentaireApparent, m.nbPiece, m.surfaceHabitable, m.nbChambre, m.surfacePieceVie, m.niveau, m.anneeConstruction, m.chargesMensuelle, m.taxesFonciere, m.taxeHabitation, m.user_idUser, m.sector_idSector, m.city_idCity, m.notary_idNotary, m.mandateType_idMandateType, m.transactionType_idTransactionType, m.etap_idMandateEtap, m.freeDate, m.zoneBDF, m.ligneDeCrete, m.zoneInondable, m.dPValide, m.dateDeclarationPrealable, m.prorogationDPJusquau, m.cuValide, m.dateCU, m.prorogationCUJusquau, m.cuOPSValide, m.dateCuOPS, m.prorogationCuOPSJusquau, m.permisDamenagerValide, m.datePermisDamenager, m.terrainVenduViabilise, m.terrainVenduSemiViabilise, m.terrainVenduNonViabilise, m.toutALegout, m.assainissementParFosseSceptique, m.coupCoeur, m.nouveaute, m.cheminee, m.cuisineEquipee, m.cuisineAmenagee, m.piscine, m.poolHouse, m.terrasse, m.mezzanine, m.dependance, m.gaz, m.cave, m.sousSol, m.garage, m.parking, m.rezDeJardin, m.plainPied, m.carriere, m.pointEau, m.slope_idMandateSlope, m.orientation_idMandateOrientation, m.insulation_idMandateInsulation, m.news_idMandateNews, m.heating_idMandateHeating, m.commonOwnership_idMandateCommonOwnership, m.roof_idMandateRoof, m.condition_idMandateCondition, m.style_idMandateStyle, m.construction_idMandateConstructionType, m.sanitationCorresponding_idMandateSanitationCorresponding, m.electricCorresponding_idMandateElectricCorresponding, m.gazCorresponding_idMandateGazCorresponding, m.waterCorresponding_idMandateWaterCorresponding, m.cos_idMandateCOS, m.zonagePLU_idMandateZonagePLU, m.zonageRNU_idMandateZonageRNU, m.bornageTerrain_idMandateBornageTerrain, m.geometer_idMandateGeometer FROM Mandate m WHERE m.mandateType_idMandateType = ?');
		if (!$pdoStatement->execute(array($mandateType->getIdMandateType()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les mandates par mandateType depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�rer le/la transactionType
	 * @return TransactionType
	 */
	public function getTransactionType()
	{
		return TransactionType::load($this->pdo,$this->transactionType);
	}

	/**
	 * D�finir le/la transactionType
	 * @param $transactionType TransactionType
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setTransactionType(TransactionType $transactionType,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->transactionType = $transactionType->getIdTransactionType();

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('transactionType_idTransactionType'),array($transactionType->getIdTransactionType())) : true;
	}

	/**
	 * S�lectionner les mandates par transactionType
	 * @param $pdo PDO
	 * @param $transactionType TransactionType
	 * @return PDOStatement
	 */
	public static function selectByTransactionType(PDO $pdo,TransactionType $transactionType)
	{
		$pdoStatement = $pdo->prepare('SELECT m.idMandate, m.numberMandate, m.initDate, m.deadDate, m.address, m.priceFai, m.priceSeller, m.commission, m.estimationFai, m.margeNegociation, m.referenceCadastreParcelle1, m.referenceCadastreParcelle2, m.referenceCadastreParcelle3, m.autreReferenceParcelle, m.superficieParcelle1, m.superficieParcelle2, m.superficieParcelle3, m.superficieAutreParcelle, m.superficieConstructible, m.superficieTotale, m.numberLot, m.sHONAccordee, m.reglementDeLotissement, m.eRNT, m.passageEau, m.passageElectricite, m.passageGaz, m.voirie, m.tailleFacade, m.profondeurTerrain, m.commentaire, m.geolocalisation, m.proximiteEcole, m.proximiteCommerce, m.proximiteTransport, m.commentaireApparent, m.nbPiece, m.surfaceHabitable, m.nbChambre, m.surfacePieceVie, m.niveau, m.anneeConstruction, m.chargesMensuelle, m.taxesFonciere, m.taxeHabitation, m.user_idUser, m.sector_idSector, m.city_idCity, m.notary_idNotary, m.mandateType_idMandateType, m.transactionType_idTransactionType, m.etap_idMandateEtap, m.freeDate, m.zoneBDF, m.ligneDeCrete, m.zoneInondable, m.dPValide, m.dateDeclarationPrealable, m.prorogationDPJusquau, m.cuValide, m.dateCU, m.prorogationCUJusquau, m.cuOPSValide, m.dateCuOPS, m.prorogationCuOPSJusquau, m.permisDamenagerValide, m.datePermisDamenager, m.terrainVenduViabilise, m.terrainVenduSemiViabilise, m.terrainVenduNonViabilise, m.toutALegout, m.assainissementParFosseSceptique, m.coupCoeur, m.nouveaute, m.cheminee, m.cuisineEquipee, m.cuisineAmenagee, m.piscine, m.poolHouse, m.terrasse, m.mezzanine, m.dependance, m.gaz, m.cave, m.sousSol, m.garage, m.parking, m.rezDeJardin, m.plainPied, m.carriere, m.pointEau, m.slope_idMandateSlope, m.orientation_idMandateOrientation, m.insulation_idMandateInsulation, m.news_idMandateNews, m.heating_idMandateHeating, m.commonOwnership_idMandateCommonOwnership, m.roof_idMandateRoof, m.condition_idMandateCondition, m.style_idMandateStyle, m.construction_idMandateConstructionType, m.sanitationCorresponding_idMandateSanitationCorresponding, m.electricCorresponding_idMandateElectricCorresponding, m.gazCorresponding_idMandateGazCorresponding, m.waterCorresponding_idMandateWaterCorresponding, m.cos_idMandateCOS, m.zonagePLU_idMandateZonagePLU, m.zonageRNU_idMandateZonageRNU, m.bornageTerrain_idMandateBornageTerrain, m.geometer_idMandateGeometer FROM Mandate m WHERE m.transactionType_idTransactionType = ?');
		if (!$pdoStatement->execute(array($transactionType->getIdTransactionType()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les mandates par transactionType depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * S�lectionner les sellers
	 * @return PDOStatement
	 */
	public function selectSellers()
	{
		return Seller::selectByMandate($this->pdo,$this);
	}

	/**
	 * S�lectionner les pictures
	 * @return PDOStatement
	 */
	public function selectPictures()
	{
		return MandatePicture::selectByMandate($this->pdo,$this);
	}

	/**
	 * R�cup�rer le/la slope
	 * @return MandateSlope
	 */
	public function getSlope()
	{
		// Retourner null si n�c�ssaire
		if ($this->slope == null) { return null; }

		// Charger et retourner mandateSlope
		return MandateSlope::load($this->pdo,$this->slope);
	}

	/**
	 * D�finir le/la slope
	 * @param $slope MandateSlope
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setSlope($slope=null,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->slope = $slope == null ? null : $slope->getIdMandateSlope();

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('slope_idMandateSlope'),array($slope == null ? null : $slope->getIdMandateSlope())) : true;
	}

	/**
	 * S�lectionner les mandates par slope
	 * @param $pdo PDO
	 * @param $slope MandateSlope
	 * @return PDOStatement
	 */
	public static function selectBySlope(PDO $pdo,MandateSlope $slope)
	{
		$pdoStatement = $pdo->prepare('SELECT m.idMandate, m.numberMandate, m.initDate, m.deadDate, m.address, m.priceFai, m.priceSeller, m.commission, m.estimationFai, m.margeNegociation, m.referenceCadastreParcelle1, m.referenceCadastreParcelle2, m.referenceCadastreParcelle3, m.autreReferenceParcelle, m.superficieParcelle1, m.superficieParcelle2, m.superficieParcelle3, m.superficieAutreParcelle, m.superficieConstructible, m.superficieTotale, m.numberLot, m.sHONAccordee, m.reglementDeLotissement, m.eRNT, m.passageEau, m.passageElectricite, m.passageGaz, m.voirie, m.tailleFacade, m.profondeurTerrain, m.commentaire, m.geolocalisation, m.proximiteEcole, m.proximiteCommerce, m.proximiteTransport, m.commentaireApparent, m.nbPiece, m.surfaceHabitable, m.nbChambre, m.surfacePieceVie, m.niveau, m.anneeConstruction, m.chargesMensuelle, m.taxesFonciere, m.taxeHabitation, m.user_idUser, m.sector_idSector, m.city_idCity, m.notary_idNotary, m.mandateType_idMandateType, m.transactionType_idTransactionType, m.etap_idMandateEtap, m.freeDate, m.zoneBDF, m.ligneDeCrete, m.zoneInondable, m.dPValide, m.dateDeclarationPrealable, m.prorogationDPJusquau, m.cuValide, m.dateCU, m.prorogationCUJusquau, m.cuOPSValide, m.dateCuOPS, m.prorogationCuOPSJusquau, m.permisDamenagerValide, m.datePermisDamenager, m.terrainVenduViabilise, m.terrainVenduSemiViabilise, m.terrainVenduNonViabilise, m.toutALegout, m.assainissementParFosseSceptique, m.coupCoeur, m.nouveaute, m.cheminee, m.cuisineEquipee, m.cuisineAmenagee, m.piscine, m.poolHouse, m.terrasse, m.mezzanine, m.dependance, m.gaz, m.cave, m.sousSol, m.garage, m.parking, m.rezDeJardin, m.plainPied, m.carriere, m.pointEau, m.slope_idMandateSlope, m.orientation_idMandateOrientation, m.insulation_idMandateInsulation, m.news_idMandateNews, m.heating_idMandateHeating, m.commonOwnership_idMandateCommonOwnership, m.roof_idMandateRoof, m.condition_idMandateCondition, m.style_idMandateStyle, m.construction_idMandateConstructionType, m.sanitationCorresponding_idMandateSanitationCorresponding, m.electricCorresponding_idMandateElectricCorresponding, m.gazCorresponding_idMandateGazCorresponding, m.waterCorresponding_idMandateWaterCorresponding, m.cos_idMandateCOS, m.zonagePLU_idMandateZonagePLU, m.zonageRNU_idMandateZonageRNU, m.bornageTerrain_idMandateBornageTerrain, m.geometer_idMandateGeometer FROM Mandate m WHERE m.slope_idMandateSlope = ?');
		if (!$pdoStatement->execute(array($slope->getIdMandateSlope()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les mandates par slope depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * S�lectionner les scans
	 * @return PDOStatement
	 */
	public function selectScans()
	{
		return MandateScan::selectByMandate($this->pdo,$this);
	}

	/**
	 * R�cup�rer le/la orientation
	 * @return MandateOrientation
	 */
	public function getOrientation()
	{
		// Retourner null si n�c�ssaire
		if ($this->orientation == null) { return null; }

		// Charger et retourner mandateOrientation
		return MandateOrientation::load($this->pdo,$this->orientation);
	}

	/**
	 * D�finir le/la orientation
	 * @param $orientation MandateOrientation
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setOrientation($orientation=null,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->orientation = $orientation == null ? null : $orientation->getIdMandateOrientation();

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('orientation_idMandateOrientation'),array($orientation == null ? null : $orientation->getIdMandateOrientation())) : true;
	}

	/**
	 * S�lectionner les mandates par orientation
	 * @param $pdo PDO
	 * @param $orientation MandateOrientation
	 * @return PDOStatement
	 */
	public static function selectByOrientation(PDO $pdo,MandateOrientation $orientation)
	{
		$pdoStatement = $pdo->prepare('SELECT m.idMandate, m.numberMandate, m.initDate, m.deadDate, m.address, m.priceFai, m.priceSeller, m.commission, m.estimationFai, m.margeNegociation, m.referenceCadastreParcelle1, m.referenceCadastreParcelle2, m.referenceCadastreParcelle3, m.autreReferenceParcelle, m.superficieParcelle1, m.superficieParcelle2, m.superficieParcelle3, m.superficieAutreParcelle, m.superficieConstructible, m.superficieTotale, m.numberLot, m.sHONAccordee, m.reglementDeLotissement, m.eRNT, m.passageEau, m.passageElectricite, m.passageGaz, m.voirie, m.tailleFacade, m.profondeurTerrain, m.commentaire, m.geolocalisation, m.proximiteEcole, m.proximiteCommerce, m.proximiteTransport, m.commentaireApparent, m.nbPiece, m.surfaceHabitable, m.nbChambre, m.surfacePieceVie, m.niveau, m.anneeConstruction, m.chargesMensuelle, m.taxesFonciere, m.taxeHabitation, m.user_idUser, m.sector_idSector, m.city_idCity, m.notary_idNotary, m.mandateType_idMandateType, m.transactionType_idTransactionType, m.etap_idMandateEtap, m.freeDate, m.zoneBDF, m.ligneDeCrete, m.zoneInondable, m.dPValide, m.dateDeclarationPrealable, m.prorogationDPJusquau, m.cuValide, m.dateCU, m.prorogationCUJusquau, m.cuOPSValide, m.dateCuOPS, m.prorogationCuOPSJusquau, m.permisDamenagerValide, m.datePermisDamenager, m.terrainVenduViabilise, m.terrainVenduSemiViabilise, m.terrainVenduNonViabilise, m.toutALegout, m.assainissementParFosseSceptique, m.coupCoeur, m.nouveaute, m.cheminee, m.cuisineEquipee, m.cuisineAmenagee, m.piscine, m.poolHouse, m.terrasse, m.mezzanine, m.dependance, m.gaz, m.cave, m.sousSol, m.garage, m.parking, m.rezDeJardin, m.plainPied, m.carriere, m.pointEau, m.slope_idMandateSlope, m.orientation_idMandateOrientation, m.insulation_idMandateInsulation, m.news_idMandateNews, m.heating_idMandateHeating, m.commonOwnership_idMandateCommonOwnership, m.roof_idMandateRoof, m.condition_idMandateCondition, m.style_idMandateStyle, m.construction_idMandateConstructionType, m.sanitationCorresponding_idMandateSanitationCorresponding, m.electricCorresponding_idMandateElectricCorresponding, m.gazCorresponding_idMandateGazCorresponding, m.waterCorresponding_idMandateWaterCorresponding, m.cos_idMandateCOS, m.zonagePLU_idMandateZonagePLU, m.zonageRNU_idMandateZonageRNU, m.bornageTerrain_idMandateBornageTerrain, m.geometer_idMandateGeometer FROM Mandate m WHERE m.orientation_idMandateOrientation = ?');
		if (!$pdoStatement->execute(array($orientation->getIdMandateOrientation()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les mandates par orientation depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�rer le/la insulation
	 * @return MandateInsulation
	 */
	public function getInsulation()
	{
		// Retourner null si n�c�ssaire
		if ($this->insulation == null) { return null; }

		// Charger et retourner mandateInsulation
		return MandateInsulation::load($this->pdo,$this->insulation);
	}

	/**
	 * D�finir le/la insulation
	 * @param $insulation MandateInsulation
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setInsulation($insulation=null,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->insulation = $insulation == null ? null : $insulation->getIdMandateInsulation();

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('insulation_idMandateInsulation'),array($insulation == null ? null : $insulation->getIdMandateInsulation())) : true;
	}

	/**
	 * S�lectionner les mandates par insulation
	 * @param $pdo PDO
	 * @param $insulation MandateInsulation
	 * @return PDOStatement
	 */
	public static function selectByInsulation(PDO $pdo,MandateInsulation $insulation)
	{
		$pdoStatement = $pdo->prepare('SELECT m.idMandate, m.numberMandate, m.initDate, m.deadDate, m.address, m.priceFai, m.priceSeller, m.commission, m.estimationFai, m.margeNegociation, m.referenceCadastreParcelle1, m.referenceCadastreParcelle2, m.referenceCadastreParcelle3, m.autreReferenceParcelle, m.superficieParcelle1, m.superficieParcelle2, m.superficieParcelle3, m.superficieAutreParcelle, m.superficieConstructible, m.superficieTotale, m.numberLot, m.sHONAccordee, m.reglementDeLotissement, m.eRNT, m.passageEau, m.passageElectricite, m.passageGaz, m.voirie, m.tailleFacade, m.profondeurTerrain, m.commentaire, m.geolocalisation, m.proximiteEcole, m.proximiteCommerce, m.proximiteTransport, m.commentaireApparent, m.nbPiece, m.surfaceHabitable, m.nbChambre, m.surfacePieceVie, m.niveau, m.anneeConstruction, m.chargesMensuelle, m.taxesFonciere, m.taxeHabitation, m.user_idUser, m.sector_idSector, m.city_idCity, m.notary_idNotary, m.mandateType_idMandateType, m.transactionType_idTransactionType, m.etap_idMandateEtap, m.freeDate, m.zoneBDF, m.ligneDeCrete, m.zoneInondable, m.dPValide, m.dateDeclarationPrealable, m.prorogationDPJusquau, m.cuValide, m.dateCU, m.prorogationCUJusquau, m.cuOPSValide, m.dateCuOPS, m.prorogationCuOPSJusquau, m.permisDamenagerValide, m.datePermisDamenager, m.terrainVenduViabilise, m.terrainVenduSemiViabilise, m.terrainVenduNonViabilise, m.toutALegout, m.assainissementParFosseSceptique, m.coupCoeur, m.nouveaute, m.cheminee, m.cuisineEquipee, m.cuisineAmenagee, m.piscine, m.poolHouse, m.terrasse, m.mezzanine, m.dependance, m.gaz, m.cave, m.sousSol, m.garage, m.parking, m.rezDeJardin, m.plainPied, m.carriere, m.pointEau, m.slope_idMandateSlope, m.orientation_idMandateOrientation, m.insulation_idMandateInsulation, m.news_idMandateNews, m.heating_idMandateHeating, m.commonOwnership_idMandateCommonOwnership, m.roof_idMandateRoof, m.condition_idMandateCondition, m.style_idMandateStyle, m.construction_idMandateConstructionType, m.sanitationCorresponding_idMandateSanitationCorresponding, m.electricCorresponding_idMandateElectricCorresponding, m.gazCorresponding_idMandateGazCorresponding, m.waterCorresponding_idMandateWaterCorresponding, m.cos_idMandateCOS, m.zonagePLU_idMandateZonagePLU, m.zonageRNU_idMandateZonageRNU, m.bornageTerrain_idMandateBornageTerrain, m.geometer_idMandateGeometer FROM Mandate m WHERE m.insulation_idMandateInsulation = ?');
		if (!$pdoStatement->execute(array($insulation->getIdMandateInsulation()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les mandates par insulation depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�rer le/la news
	 * @return MandateNews
	 */
	public function getNews()
	{
		// Retourner null si n�c�ssaire
		if ($this->news == null) { return null; }

		// Charger et retourner mandateNews
		return MandateNews::load($this->pdo,$this->news);
	}

	/**
	 * D�finir le/la news
	 * @param $news MandateNews
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setNews($news=null,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->news = $news == null ? null : $news->getIdMandateNews();

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('news_idMandateNews'),array($news == null ? null : $news->getIdMandateNews())) : true;
	}

	/**
	 * S�lectionner les mandates par news
	 * @param $pdo PDO
	 * @param $news MandateNews
	 * @return PDOStatement
	 */
	public static function selectByNews(PDO $pdo,MandateNews $news)
	{
		$pdoStatement = $pdo->prepare('SELECT m.idMandate, m.numberMandate, m.initDate, m.deadDate, m.address, m.priceFai, m.priceSeller, m.commission, m.estimationFai, m.margeNegociation, m.referenceCadastreParcelle1, m.referenceCadastreParcelle2, m.referenceCadastreParcelle3, m.autreReferenceParcelle, m.superficieParcelle1, m.superficieParcelle2, m.superficieParcelle3, m.superficieAutreParcelle, m.superficieConstructible, m.superficieTotale, m.numberLot, m.sHONAccordee, m.reglementDeLotissement, m.eRNT, m.passageEau, m.passageElectricite, m.passageGaz, m.voirie, m.tailleFacade, m.profondeurTerrain, m.commentaire, m.geolocalisation, m.proximiteEcole, m.proximiteCommerce, m.proximiteTransport, m.commentaireApparent, m.nbPiece, m.surfaceHabitable, m.nbChambre, m.surfacePieceVie, m.niveau, m.anneeConstruction, m.chargesMensuelle, m.taxesFonciere, m.taxeHabitation, m.user_idUser, m.sector_idSector, m.city_idCity, m.notary_idNotary, m.mandateType_idMandateType, m.transactionType_idTransactionType, m.etap_idMandateEtap, m.freeDate, m.zoneBDF, m.ligneDeCrete, m.zoneInondable, m.dPValide, m.dateDeclarationPrealable, m.prorogationDPJusquau, m.cuValide, m.dateCU, m.prorogationCUJusquau, m.cuOPSValide, m.dateCuOPS, m.prorogationCuOPSJusquau, m.permisDamenagerValide, m.datePermisDamenager, m.terrainVenduViabilise, m.terrainVenduSemiViabilise, m.terrainVenduNonViabilise, m.toutALegout, m.assainissementParFosseSceptique, m.coupCoeur, m.nouveaute, m.cheminee, m.cuisineEquipee, m.cuisineAmenagee, m.piscine, m.poolHouse, m.terrasse, m.mezzanine, m.dependance, m.gaz, m.cave, m.sousSol, m.garage, m.parking, m.rezDeJardin, m.plainPied, m.carriere, m.pointEau, m.slope_idMandateSlope, m.orientation_idMandateOrientation, m.insulation_idMandateInsulation, m.news_idMandateNews, m.heating_idMandateHeating, m.commonOwnership_idMandateCommonOwnership, m.roof_idMandateRoof, m.condition_idMandateCondition, m.style_idMandateStyle, m.construction_idMandateConstructionType, m.sanitationCorresponding_idMandateSanitationCorresponding, m.electricCorresponding_idMandateElectricCorresponding, m.gazCorresponding_idMandateGazCorresponding, m.waterCorresponding_idMandateWaterCorresponding, m.cos_idMandateCOS, m.zonagePLU_idMandateZonagePLU, m.zonageRNU_idMandateZonageRNU, m.bornageTerrain_idMandateBornageTerrain, m.geometer_idMandateGeometer FROM Mandate m WHERE m.news_idMandateNews = ?');
		if (!$pdoStatement->execute(array($news->getIdMandateNews()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les mandates par news depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�rer le/la heating
	 * @return MandateHeating
	 */
	public function getHeating()
	{
		// Retourner null si n�c�ssaire
		if ($this->heating == null) { return null; }

		// Charger et retourner mandateHeating
		return MandateHeating::load($this->pdo,$this->heating);
	}

	/**
	 * D�finir le/la heating
	 * @param $heating MandateHeating
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setHeating($heating=null,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->heating = $heating == null ? null : $heating->getIdMandateHeating();

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('heating_idMandateHeating'),array($heating == null ? null : $heating->getIdMandateHeating())) : true;
	}

	/**
	 * S�lectionner les mandates par heating
	 * @param $pdo PDO
	 * @param $heating MandateHeating
	 * @return PDOStatement
	 */
	public static function selectByHeating(PDO $pdo,MandateHeating $heating)
	{
		$pdoStatement = $pdo->prepare('SELECT m.idMandate, m.numberMandate, m.initDate, m.deadDate, m.address, m.priceFai, m.priceSeller, m.commission, m.estimationFai, m.margeNegociation, m.referenceCadastreParcelle1, m.referenceCadastreParcelle2, m.referenceCadastreParcelle3, m.autreReferenceParcelle, m.superficieParcelle1, m.superficieParcelle2, m.superficieParcelle3, m.superficieAutreParcelle, m.superficieConstructible, m.superficieTotale, m.numberLot, m.sHONAccordee, m.reglementDeLotissement, m.eRNT, m.passageEau, m.passageElectricite, m.passageGaz, m.voirie, m.tailleFacade, m.profondeurTerrain, m.commentaire, m.geolocalisation, m.proximiteEcole, m.proximiteCommerce, m.proximiteTransport, m.commentaireApparent, m.nbPiece, m.surfaceHabitable, m.nbChambre, m.surfacePieceVie, m.niveau, m.anneeConstruction, m.chargesMensuelle, m.taxesFonciere, m.taxeHabitation, m.user_idUser, m.sector_idSector, m.city_idCity, m.notary_idNotary, m.mandateType_idMandateType, m.transactionType_idTransactionType, m.etap_idMandateEtap, m.freeDate, m.zoneBDF, m.ligneDeCrete, m.zoneInondable, m.dPValide, m.dateDeclarationPrealable, m.prorogationDPJusquau, m.cuValide, m.dateCU, m.prorogationCUJusquau, m.cuOPSValide, m.dateCuOPS, m.prorogationCuOPSJusquau, m.permisDamenagerValide, m.datePermisDamenager, m.terrainVenduViabilise, m.terrainVenduSemiViabilise, m.terrainVenduNonViabilise, m.toutALegout, m.assainissementParFosseSceptique, m.coupCoeur, m.nouveaute, m.cheminee, m.cuisineEquipee, m.cuisineAmenagee, m.piscine, m.poolHouse, m.terrasse, m.mezzanine, m.dependance, m.gaz, m.cave, m.sousSol, m.garage, m.parking, m.rezDeJardin, m.plainPied, m.carriere, m.pointEau, m.slope_idMandateSlope, m.orientation_idMandateOrientation, m.insulation_idMandateInsulation, m.news_idMandateNews, m.heating_idMandateHeating, m.commonOwnership_idMandateCommonOwnership, m.roof_idMandateRoof, m.condition_idMandateCondition, m.style_idMandateStyle, m.construction_idMandateConstructionType, m.sanitationCorresponding_idMandateSanitationCorresponding, m.electricCorresponding_idMandateElectricCorresponding, m.gazCorresponding_idMandateGazCorresponding, m.waterCorresponding_idMandateWaterCorresponding, m.cos_idMandateCOS, m.zonagePLU_idMandateZonagePLU, m.zonageRNU_idMandateZonageRNU, m.bornageTerrain_idMandateBornageTerrain, m.geometer_idMandateGeometer FROM Mandate m WHERE m.heating_idMandateHeating = ?');
		if (!$pdoStatement->execute(array($heating->getIdMandateHeating()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les mandates par heating depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�rer le/la commonOwnership
	 * @return MandateCommonOwnership
	 */
	public function getCommonOwnership()
	{
		// Retourner null si n�c�ssaire
		if ($this->commonOwnership == null) { return null; }

		// Charger et retourner mandateCommonOwnership
		return MandateCommonOwnership::load($this->pdo,$this->commonOwnership);
	}

	/**
	 * D�finir le/la commonOwnership
	 * @param $commonOwnership MandateCommonOwnership
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setCommonOwnership($commonOwnership=null,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->commonOwnership = $commonOwnership == null ? null : $commonOwnership->getIdMandateCommonOwnership();

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('commonOwnership_idMandateCommonOwnership'),array($commonOwnership == null ? null : $commonOwnership->getIdMandateCommonOwnership())) : true;
	}

	/**
	 * S�lectionner les mandates par commonOwnership
	 * @param $pdo PDO
	 * @param $commonOwnership MandateCommonOwnership
	 * @return PDOStatement
	 */
	public static function selectByCommonOwnership(PDO $pdo,MandateCommonOwnership $commonOwnership)
	{
		$pdoStatement = $pdo->prepare('SELECT m.idMandate, m.numberMandate, m.initDate, m.deadDate, m.address, m.priceFai, m.priceSeller, m.commission, m.estimationFai, m.margeNegociation, m.referenceCadastreParcelle1, m.referenceCadastreParcelle2, m.referenceCadastreParcelle3, m.autreReferenceParcelle, m.superficieParcelle1, m.superficieParcelle2, m.superficieParcelle3, m.superficieAutreParcelle, m.superficieConstructible, m.superficieTotale, m.numberLot, m.sHONAccordee, m.reglementDeLotissement, m.eRNT, m.passageEau, m.passageElectricite, m.passageGaz, m.voirie, m.tailleFacade, m.profondeurTerrain, m.commentaire, m.geolocalisation, m.proximiteEcole, m.proximiteCommerce, m.proximiteTransport, m.commentaireApparent, m.nbPiece, m.surfaceHabitable, m.nbChambre, m.surfacePieceVie, m.niveau, m.anneeConstruction, m.chargesMensuelle, m.taxesFonciere, m.taxeHabitation, m.user_idUser, m.sector_idSector, m.city_idCity, m.notary_idNotary, m.mandateType_idMandateType, m.transactionType_idTransactionType, m.etap_idMandateEtap, m.freeDate, m.zoneBDF, m.ligneDeCrete, m.zoneInondable, m.dPValide, m.dateDeclarationPrealable, m.prorogationDPJusquau, m.cuValide, m.dateCU, m.prorogationCUJusquau, m.cuOPSValide, m.dateCuOPS, m.prorogationCuOPSJusquau, m.permisDamenagerValide, m.datePermisDamenager, m.terrainVenduViabilise, m.terrainVenduSemiViabilise, m.terrainVenduNonViabilise, m.toutALegout, m.assainissementParFosseSceptique, m.coupCoeur, m.nouveaute, m.cheminee, m.cuisineEquipee, m.cuisineAmenagee, m.piscine, m.poolHouse, m.terrasse, m.mezzanine, m.dependance, m.gaz, m.cave, m.sousSol, m.garage, m.parking, m.rezDeJardin, m.plainPied, m.carriere, m.pointEau, m.slope_idMandateSlope, m.orientation_idMandateOrientation, m.insulation_idMandateInsulation, m.news_idMandateNews, m.heating_idMandateHeating, m.commonOwnership_idMandateCommonOwnership, m.roof_idMandateRoof, m.condition_idMandateCondition, m.style_idMandateStyle, m.construction_idMandateConstructionType, m.sanitationCorresponding_idMandateSanitationCorresponding, m.electricCorresponding_idMandateElectricCorresponding, m.gazCorresponding_idMandateGazCorresponding, m.waterCorresponding_idMandateWaterCorresponding, m.cos_idMandateCOS, m.zonagePLU_idMandateZonagePLU, m.zonageRNU_idMandateZonageRNU, m.bornageTerrain_idMandateBornageTerrain, m.geometer_idMandateGeometer FROM Mandate m WHERE m.commonOwnership_idMandateCommonOwnership = ?');
		if (!$pdoStatement->execute(array($commonOwnership->getIdMandateCommonOwnership()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les mandates par commonOwnership depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�rer le/la roof
	 * @return MandateRoof
	 */
	public function getRoof()
	{
		// Retourner null si n�c�ssaire
		if ($this->roof == null) { return null; }

		// Charger et retourner mandateRoof
		return MandateRoof::load($this->pdo,$this->roof);
	}

	/**
	 * D�finir le/la roof
	 * @param $roof MandateRoof
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setRoof($roof=null,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->roof = $roof == null ? null : $roof->getIdMandateRoof();

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('roof_idMandateRoof'),array($roof == null ? null : $roof->getIdMandateRoof())) : true;
	}

	/**
	 * S�lectionner les mandates par roof
	 * @param $pdo PDO
	 * @param $roof MandateRoof
	 * @return PDOStatement
	 */
	public static function selectByRoof(PDO $pdo,MandateRoof $roof)
	{
		$pdoStatement = $pdo->prepare('SELECT m.idMandate, m.numberMandate, m.initDate, m.deadDate, m.address, m.priceFai, m.priceSeller, m.commission, m.estimationFai, m.margeNegociation, m.referenceCadastreParcelle1, m.referenceCadastreParcelle2, m.referenceCadastreParcelle3, m.autreReferenceParcelle, m.superficieParcelle1, m.superficieParcelle2, m.superficieParcelle3, m.superficieAutreParcelle, m.superficieConstructible, m.superficieTotale, m.numberLot, m.sHONAccordee, m.reglementDeLotissement, m.eRNT, m.passageEau, m.passageElectricite, m.passageGaz, m.voirie, m.tailleFacade, m.profondeurTerrain, m.commentaire, m.geolocalisation, m.proximiteEcole, m.proximiteCommerce, m.proximiteTransport, m.commentaireApparent, m.nbPiece, m.surfaceHabitable, m.nbChambre, m.surfacePieceVie, m.niveau, m.anneeConstruction, m.chargesMensuelle, m.taxesFonciere, m.taxeHabitation, m.user_idUser, m.sector_idSector, m.city_idCity, m.notary_idNotary, m.mandateType_idMandateType, m.transactionType_idTransactionType, m.etap_idMandateEtap, m.freeDate, m.zoneBDF, m.ligneDeCrete, m.zoneInondable, m.dPValide, m.dateDeclarationPrealable, m.prorogationDPJusquau, m.cuValide, m.dateCU, m.prorogationCUJusquau, m.cuOPSValide, m.dateCuOPS, m.prorogationCuOPSJusquau, m.permisDamenagerValide, m.datePermisDamenager, m.terrainVenduViabilise, m.terrainVenduSemiViabilise, m.terrainVenduNonViabilise, m.toutALegout, m.assainissementParFosseSceptique, m.coupCoeur, m.nouveaute, m.cheminee, m.cuisineEquipee, m.cuisineAmenagee, m.piscine, m.poolHouse, m.terrasse, m.mezzanine, m.dependance, m.gaz, m.cave, m.sousSol, m.garage, m.parking, m.rezDeJardin, m.plainPied, m.carriere, m.pointEau, m.slope_idMandateSlope, m.orientation_idMandateOrientation, m.insulation_idMandateInsulation, m.news_idMandateNews, m.heating_idMandateHeating, m.commonOwnership_idMandateCommonOwnership, m.roof_idMandateRoof, m.condition_idMandateCondition, m.style_idMandateStyle, m.construction_idMandateConstructionType, m.sanitationCorresponding_idMandateSanitationCorresponding, m.electricCorresponding_idMandateElectricCorresponding, m.gazCorresponding_idMandateGazCorresponding, m.waterCorresponding_idMandateWaterCorresponding, m.cos_idMandateCOS, m.zonagePLU_idMandateZonagePLU, m.zonageRNU_idMandateZonageRNU, m.bornageTerrain_idMandateBornageTerrain, m.geometer_idMandateGeometer FROM Mandate m WHERE m.roof_idMandateRoof = ?');
		if (!$pdoStatement->execute(array($roof->getIdMandateRoof()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les mandates par roof depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�rer le/la condition
	 * @return MandateCondition
	 */
	public function getCondition()
	{
		// Retourner null si n�c�ssaire
		if ($this->condition == null) { return null; }

		// Charger et retourner mandateCondition
		return MandateCondition::load($this->pdo,$this->condition);
	}

	/**
	 * D�finir le/la condition
	 * @param $condition MandateCondition
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setCondition($condition=null,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->condition = $condition == null ? null : $condition->getIdMandateCondition();

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('condition_idMandateCondition'),array($condition == null ? null : $condition->getIdMandateCondition())) : true;
	}

	/**
	 * S�lectionner les mandates par condition
	 * @param $pdo PDO
	 * @param $condition MandateCondition
	 * @return PDOStatement
	 */
	public static function selectByCondition(PDO $pdo,MandateCondition $condition)
	{
		$pdoStatement = $pdo->prepare('SELECT m.idMandate, m.numberMandate, m.initDate, m.deadDate, m.address, m.priceFai, m.priceSeller, m.commission, m.estimationFai, m.margeNegociation, m.referenceCadastreParcelle1, m.referenceCadastreParcelle2, m.referenceCadastreParcelle3, m.autreReferenceParcelle, m.superficieParcelle1, m.superficieParcelle2, m.superficieParcelle3, m.superficieAutreParcelle, m.superficieConstructible, m.superficieTotale, m.numberLot, m.sHONAccordee, m.reglementDeLotissement, m.eRNT, m.passageEau, m.passageElectricite, m.passageGaz, m.voirie, m.tailleFacade, m.profondeurTerrain, m.commentaire, m.geolocalisation, m.proximiteEcole, m.proximiteCommerce, m.proximiteTransport, m.commentaireApparent, m.nbPiece, m.surfaceHabitable, m.nbChambre, m.surfacePieceVie, m.niveau, m.anneeConstruction, m.chargesMensuelle, m.taxesFonciere, m.taxeHabitation, m.user_idUser, m.sector_idSector, m.city_idCity, m.notary_idNotary, m.mandateType_idMandateType, m.transactionType_idTransactionType, m.etap_idMandateEtap, m.freeDate, m.zoneBDF, m.ligneDeCrete, m.zoneInondable, m.dPValide, m.dateDeclarationPrealable, m.prorogationDPJusquau, m.cuValide, m.dateCU, m.prorogationCUJusquau, m.cuOPSValide, m.dateCuOPS, m.prorogationCuOPSJusquau, m.permisDamenagerValide, m.datePermisDamenager, m.terrainVenduViabilise, m.terrainVenduSemiViabilise, m.terrainVenduNonViabilise, m.toutALegout, m.assainissementParFosseSceptique, m.coupCoeur, m.nouveaute, m.cheminee, m.cuisineEquipee, m.cuisineAmenagee, m.piscine, m.poolHouse, m.terrasse, m.mezzanine, m.dependance, m.gaz, m.cave, m.sousSol, m.garage, m.parking, m.rezDeJardin, m.plainPied, m.carriere, m.pointEau, m.slope_idMandateSlope, m.orientation_idMandateOrientation, m.insulation_idMandateInsulation, m.news_idMandateNews, m.heating_idMandateHeating, m.commonOwnership_idMandateCommonOwnership, m.roof_idMandateRoof, m.condition_idMandateCondition, m.style_idMandateStyle, m.construction_idMandateConstructionType, m.sanitationCorresponding_idMandateSanitationCorresponding, m.electricCorresponding_idMandateElectricCorresponding, m.gazCorresponding_idMandateGazCorresponding, m.waterCorresponding_idMandateWaterCorresponding, m.cos_idMandateCOS, m.zonagePLU_idMandateZonagePLU, m.zonageRNU_idMandateZonageRNU, m.bornageTerrain_idMandateBornageTerrain, m.geometer_idMandateGeometer FROM Mandate m WHERE m.condition_idMandateCondition = ?');
		if (!$pdoStatement->execute(array($condition->getIdMandateCondition()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les mandates par condition depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�rer le/la style
	 * @return MandateStyle
	 */
	public function getStyle()
	{
		// Retourner null si n�c�ssaire
		if ($this->style == null) { return null; }

		// Charger et retourner mandateStyle
		return MandateStyle::load($this->pdo,$this->style);
	}

	/**
	 * D�finir le/la style
	 * @param $style MandateStyle
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setStyle($style=null,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->style = $style == null ? null : $style->getIdMandateStyle();

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('style_idMandateStyle'),array($style == null ? null : $style->getIdMandateStyle())) : true;
	}

	/**
	 * S�lectionner les mandates par style
	 * @param $pdo PDO
	 * @param $style MandateStyle
	 * @return PDOStatement
	 */
	public static function selectByStyle(PDO $pdo,MandateStyle $style)
	{
		$pdoStatement = $pdo->prepare('SELECT m.idMandate, m.numberMandate, m.initDate, m.deadDate, m.address, m.priceFai, m.priceSeller, m.commission, m.estimationFai, m.margeNegociation, m.referenceCadastreParcelle1, m.referenceCadastreParcelle2, m.referenceCadastreParcelle3, m.autreReferenceParcelle, m.superficieParcelle1, m.superficieParcelle2, m.superficieParcelle3, m.superficieAutreParcelle, m.superficieConstructible, m.superficieTotale, m.numberLot, m.sHONAccordee, m.reglementDeLotissement, m.eRNT, m.passageEau, m.passageElectricite, m.passageGaz, m.voirie, m.tailleFacade, m.profondeurTerrain, m.commentaire, m.geolocalisation, m.proximiteEcole, m.proximiteCommerce, m.proximiteTransport, m.commentaireApparent, m.nbPiece, m.surfaceHabitable, m.nbChambre, m.surfacePieceVie, m.niveau, m.anneeConstruction, m.chargesMensuelle, m.taxesFonciere, m.taxeHabitation, m.user_idUser, m.sector_idSector, m.city_idCity, m.notary_idNotary, m.mandateType_idMandateType, m.transactionType_idTransactionType, m.etap_idMandateEtap, m.freeDate, m.zoneBDF, m.ligneDeCrete, m.zoneInondable, m.dPValide, m.dateDeclarationPrealable, m.prorogationDPJusquau, m.cuValide, m.dateCU, m.prorogationCUJusquau, m.cuOPSValide, m.dateCuOPS, m.prorogationCuOPSJusquau, m.permisDamenagerValide, m.datePermisDamenager, m.terrainVenduViabilise, m.terrainVenduSemiViabilise, m.terrainVenduNonViabilise, m.toutALegout, m.assainissementParFosseSceptique, m.coupCoeur, m.nouveaute, m.cheminee, m.cuisineEquipee, m.cuisineAmenagee, m.piscine, m.poolHouse, m.terrasse, m.mezzanine, m.dependance, m.gaz, m.cave, m.sousSol, m.garage, m.parking, m.rezDeJardin, m.plainPied, m.carriere, m.pointEau, m.slope_idMandateSlope, m.orientation_idMandateOrientation, m.insulation_idMandateInsulation, m.news_idMandateNews, m.heating_idMandateHeating, m.commonOwnership_idMandateCommonOwnership, m.roof_idMandateRoof, m.condition_idMandateCondition, m.style_idMandateStyle, m.construction_idMandateConstructionType, m.sanitationCorresponding_idMandateSanitationCorresponding, m.electricCorresponding_idMandateElectricCorresponding, m.gazCorresponding_idMandateGazCorresponding, m.waterCorresponding_idMandateWaterCorresponding, m.cos_idMandateCOS, m.zonagePLU_idMandateZonagePLU, m.zonageRNU_idMandateZonageRNU, m.bornageTerrain_idMandateBornageTerrain, m.geometer_idMandateGeometer FROM Mandate m WHERE m.style_idMandateStyle = ?');
		if (!$pdoStatement->execute(array($style->getIdMandateStyle()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les mandates par style depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�rer le/la construction
	 * @return MandateConstructionType
	 */
	public function getConstruction()
	{
		// Retourner null si n�c�ssaire
		if ($this->construction == null) { return null; }

		// Charger et retourner mandateConstructionType
		return MandateConstructionType::load($this->pdo,$this->construction);
	}

	/**
	 * D�finir le/la construction
	 * @param $construction MandateConstructionType
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setConstruction($construction=null,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->construction = $construction == null ? null : $construction->getIdMandateConstructionType();

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('construction_idMandateConstructionType'),array($construction == null ? null : $construction->getIdMandateConstructionType())) : true;
	}

	/**
	 * S�lectionner les mandates par construction
	 * @param $pdo PDO
	 * @param $construction MandateConstructionType
	 * @return PDOStatement
	 */
	public static function selectByConstruction(PDO $pdo,MandateConstructionType $construction)
	{
		$pdoStatement = $pdo->prepare('SELECT m.idMandate, m.numberMandate, m.initDate, m.deadDate, m.address, m.priceFai, m.priceSeller, m.commission, m.estimationFai, m.margeNegociation, m.referenceCadastreParcelle1, m.referenceCadastreParcelle2, m.referenceCadastreParcelle3, m.autreReferenceParcelle, m.superficieParcelle1, m.superficieParcelle2, m.superficieParcelle3, m.superficieAutreParcelle, m.superficieConstructible, m.superficieTotale, m.numberLot, m.sHONAccordee, m.reglementDeLotissement, m.eRNT, m.passageEau, m.passageElectricite, m.passageGaz, m.voirie, m.tailleFacade, m.profondeurTerrain, m.commentaire, m.geolocalisation, m.proximiteEcole, m.proximiteCommerce, m.proximiteTransport, m.commentaireApparent, m.nbPiece, m.surfaceHabitable, m.nbChambre, m.surfacePieceVie, m.niveau, m.anneeConstruction, m.chargesMensuelle, m.taxesFonciere, m.taxeHabitation, m.user_idUser, m.sector_idSector, m.city_idCity, m.notary_idNotary, m.mandateType_idMandateType, m.transactionType_idTransactionType, m.etap_idMandateEtap, m.freeDate, m.zoneBDF, m.ligneDeCrete, m.zoneInondable, m.dPValide, m.dateDeclarationPrealable, m.prorogationDPJusquau, m.cuValide, m.dateCU, m.prorogationCUJusquau, m.cuOPSValide, m.dateCuOPS, m.prorogationCuOPSJusquau, m.permisDamenagerValide, m.datePermisDamenager, m.terrainVenduViabilise, m.terrainVenduSemiViabilise, m.terrainVenduNonViabilise, m.toutALegout, m.assainissementParFosseSceptique, m.coupCoeur, m.nouveaute, m.cheminee, m.cuisineEquipee, m.cuisineAmenagee, m.piscine, m.poolHouse, m.terrasse, m.mezzanine, m.dependance, m.gaz, m.cave, m.sousSol, m.garage, m.parking, m.rezDeJardin, m.plainPied, m.carriere, m.pointEau, m.slope_idMandateSlope, m.orientation_idMandateOrientation, m.insulation_idMandateInsulation, m.news_idMandateNews, m.heating_idMandateHeating, m.commonOwnership_idMandateCommonOwnership, m.roof_idMandateRoof, m.condition_idMandateCondition, m.style_idMandateStyle, m.construction_idMandateConstructionType, m.sanitationCorresponding_idMandateSanitationCorresponding, m.electricCorresponding_idMandateElectricCorresponding, m.gazCorresponding_idMandateGazCorresponding, m.waterCorresponding_idMandateWaterCorresponding, m.cos_idMandateCOS, m.zonagePLU_idMandateZonagePLU, m.zonageRNU_idMandateZonageRNU, m.bornageTerrain_idMandateBornageTerrain, m.geometer_idMandateGeometer FROM Mandate m WHERE m.construction_idMandateConstructionType = ?');
		if (!$pdoStatement->execute(array($construction->getIdMandateConstructionType()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les mandates par construction depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�rer le/la sanitationCorresponding
	 * @return MandateSanitationCorresponding
	 */
	public function getSanitationCorresponding()
	{
		// Retourner null si n�c�ssaire
		if ($this->sanitationCorresponding == null) { return null; }

		// Charger et retourner mandateSanitationCorresponding
		return MandateSanitationCorresponding::load($this->pdo,$this->sanitationCorresponding);
	}

	/**
	 * D�finir le/la sanitationCorresponding
	 * @param $sanitationCorresponding MandateSanitationCorresponding
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setSanitationCorresponding($sanitationCorresponding=null,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->sanitationCorresponding = $sanitationCorresponding == null ? null : $sanitationCorresponding->getIdMandateSanitationCorresponding();

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('sanitationCorresponding_idMandateSanitationCorresponding'),array($sanitationCorresponding == null ? null : $sanitationCorresponding->getIdMandateSanitationCorresponding())) : true;
	}

	/**
	 * S�lectionner les mandates par sanitationCorresponding
	 * @param $pdo PDO
	 * @param $sanitationCorresponding MandateSanitationCorresponding
	 * @return PDOStatement
	 */
	public static function selectBySanitationCorresponding(PDO $pdo,MandateSanitationCorresponding $sanitationCorresponding)
	{
		$pdoStatement = $pdo->prepare('SELECT m.idMandate, m.numberMandate, m.initDate, m.deadDate, m.address, m.priceFai, m.priceSeller, m.commission, m.estimationFai, m.margeNegociation, m.referenceCadastreParcelle1, m.referenceCadastreParcelle2, m.referenceCadastreParcelle3, m.autreReferenceParcelle, m.superficieParcelle1, m.superficieParcelle2, m.superficieParcelle3, m.superficieAutreParcelle, m.superficieConstructible, m.superficieTotale, m.numberLot, m.sHONAccordee, m.reglementDeLotissement, m.eRNT, m.passageEau, m.passageElectricite, m.passageGaz, m.voirie, m.tailleFacade, m.profondeurTerrain, m.commentaire, m.geolocalisation, m.proximiteEcole, m.proximiteCommerce, m.proximiteTransport, m.commentaireApparent, m.nbPiece, m.surfaceHabitable, m.nbChambre, m.surfacePieceVie, m.niveau, m.anneeConstruction, m.chargesMensuelle, m.taxesFonciere, m.taxeHabitation, m.user_idUser, m.sector_idSector, m.city_idCity, m.notary_idNotary, m.mandateType_idMandateType, m.transactionType_idTransactionType, m.etap_idMandateEtap, m.freeDate, m.zoneBDF, m.ligneDeCrete, m.zoneInondable, m.dPValide, m.dateDeclarationPrealable, m.prorogationDPJusquau, m.cuValide, m.dateCU, m.prorogationCUJusquau, m.cuOPSValide, m.dateCuOPS, m.prorogationCuOPSJusquau, m.permisDamenagerValide, m.datePermisDamenager, m.terrainVenduViabilise, m.terrainVenduSemiViabilise, m.terrainVenduNonViabilise, m.toutALegout, m.assainissementParFosseSceptique, m.coupCoeur, m.nouveaute, m.cheminee, m.cuisineEquipee, m.cuisineAmenagee, m.piscine, m.poolHouse, m.terrasse, m.mezzanine, m.dependance, m.gaz, m.cave, m.sousSol, m.garage, m.parking, m.rezDeJardin, m.plainPied, m.carriere, m.pointEau, m.slope_idMandateSlope, m.orientation_idMandateOrientation, m.insulation_idMandateInsulation, m.news_idMandateNews, m.heating_idMandateHeating, m.commonOwnership_idMandateCommonOwnership, m.roof_idMandateRoof, m.condition_idMandateCondition, m.style_idMandateStyle, m.construction_idMandateConstructionType, m.sanitationCorresponding_idMandateSanitationCorresponding, m.electricCorresponding_idMandateElectricCorresponding, m.gazCorresponding_idMandateGazCorresponding, m.waterCorresponding_idMandateWaterCorresponding, m.cos_idMandateCOS, m.zonagePLU_idMandateZonagePLU, m.zonageRNU_idMandateZonageRNU, m.bornageTerrain_idMandateBornageTerrain, m.geometer_idMandateGeometer FROM Mandate m WHERE m.sanitationCorresponding_idMandateSanitationCorresponding = ?');
		if (!$pdoStatement->execute(array($sanitationCorresponding->getIdMandateSanitationCorresponding()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les mandates par sanitationCorresponding depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�rer le/la electricCorresponding
	 * @return MandateElectricCorresponding
	 */
	public function getElectricCorresponding()
	{
		// Retourner null si n�c�ssaire
		if ($this->electricCorresponding == null) { return null; }

		// Charger et retourner mandateElectricCorresponding
		return MandateElectricCorresponding::load($this->pdo,$this->electricCorresponding);
	}

	/**
	 * D�finir le/la electricCorresponding
	 * @param $electricCorresponding MandateElectricCorresponding
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setElectricCorresponding($electricCorresponding=null,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->electricCorresponding = $electricCorresponding == null ? null : $electricCorresponding->getIdMandateElectricCorresponding();

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('electricCorresponding_idMandateElectricCorresponding'),array($electricCorresponding == null ? null : $electricCorresponding->getIdMandateElectricCorresponding())) : true;
	}

	/**
	 * S�lectionner les mandates par electricCorresponding
	 * @param $pdo PDO
	 * @param $electricCorresponding MandateElectricCorresponding
	 * @return PDOStatement
	 */
	public static function selectByElectricCorresponding(PDO $pdo,MandateElectricCorresponding $electricCorresponding)
	{
		$pdoStatement = $pdo->prepare('SELECT m.idMandate, m.numberMandate, m.initDate, m.deadDate, m.address, m.priceFai, m.priceSeller, m.commission, m.estimationFai, m.margeNegociation, m.referenceCadastreParcelle1, m.referenceCadastreParcelle2, m.referenceCadastreParcelle3, m.autreReferenceParcelle, m.superficieParcelle1, m.superficieParcelle2, m.superficieParcelle3, m.superficieAutreParcelle, m.superficieConstructible, m.superficieTotale, m.numberLot, m.sHONAccordee, m.reglementDeLotissement, m.eRNT, m.passageEau, m.passageElectricite, m.passageGaz, m.voirie, m.tailleFacade, m.profondeurTerrain, m.commentaire, m.geolocalisation, m.proximiteEcole, m.proximiteCommerce, m.proximiteTransport, m.commentaireApparent, m.nbPiece, m.surfaceHabitable, m.nbChambre, m.surfacePieceVie, m.niveau, m.anneeConstruction, m.chargesMensuelle, m.taxesFonciere, m.taxeHabitation, m.user_idUser, m.sector_idSector, m.city_idCity, m.notary_idNotary, m.mandateType_idMandateType, m.transactionType_idTransactionType, m.etap_idMandateEtap, m.freeDate, m.zoneBDF, m.ligneDeCrete, m.zoneInondable, m.dPValide, m.dateDeclarationPrealable, m.prorogationDPJusquau, m.cuValide, m.dateCU, m.prorogationCUJusquau, m.cuOPSValide, m.dateCuOPS, m.prorogationCuOPSJusquau, m.permisDamenagerValide, m.datePermisDamenager, m.terrainVenduViabilise, m.terrainVenduSemiViabilise, m.terrainVenduNonViabilise, m.toutALegout, m.assainissementParFosseSceptique, m.coupCoeur, m.nouveaute, m.cheminee, m.cuisineEquipee, m.cuisineAmenagee, m.piscine, m.poolHouse, m.terrasse, m.mezzanine, m.dependance, m.gaz, m.cave, m.sousSol, m.garage, m.parking, m.rezDeJardin, m.plainPied, m.carriere, m.pointEau, m.slope_idMandateSlope, m.orientation_idMandateOrientation, m.insulation_idMandateInsulation, m.news_idMandateNews, m.heating_idMandateHeating, m.commonOwnership_idMandateCommonOwnership, m.roof_idMandateRoof, m.condition_idMandateCondition, m.style_idMandateStyle, m.construction_idMandateConstructionType, m.sanitationCorresponding_idMandateSanitationCorresponding, m.electricCorresponding_idMandateElectricCorresponding, m.gazCorresponding_idMandateGazCorresponding, m.waterCorresponding_idMandateWaterCorresponding, m.cos_idMandateCOS, m.zonagePLU_idMandateZonagePLU, m.zonageRNU_idMandateZonageRNU, m.bornageTerrain_idMandateBornageTerrain, m.geometer_idMandateGeometer FROM Mandate m WHERE m.electricCorresponding_idMandateElectricCorresponding = ?');
		if (!$pdoStatement->execute(array($electricCorresponding->getIdMandateElectricCorresponding()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les mandates par electricCorresponding depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�rer le/la gazCorresponding
	 * @return MandateGazCorresponding
	 */
	public function getGazCorresponding()
	{
		// Retourner null si n�c�ssaire
		if ($this->gazCorresponding == null) { return null; }

		// Charger et retourner mandateGazCorresponding
		return MandateGazCorresponding::load($this->pdo,$this->gazCorresponding);
	}

	/**
	 * D�finir le/la gazCorresponding
	 * @param $gazCorresponding MandateGazCorresponding
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setGazCorresponding($gazCorresponding=null,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->gazCorresponding = $gazCorresponding == null ? null : $gazCorresponding->getIdMandateGazCorresponding();

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('gazCorresponding_idMandateGazCorresponding'),array($gazCorresponding == null ? null : $gazCorresponding->getIdMandateGazCorresponding())) : true;
	}

	/**
	 * S�lectionner les mandates par gazCorresponding
	 * @param $pdo PDO
	 * @param $gazCorresponding MandateGazCorresponding
	 * @return PDOStatement
	 */
	public static function selectByGazCorresponding(PDO $pdo,MandateGazCorresponding $gazCorresponding)
	{
		$pdoStatement = $pdo->prepare('SELECT m.idMandate, m.numberMandate, m.initDate, m.deadDate, m.address, m.priceFai, m.priceSeller, m.commission, m.estimationFai, m.margeNegociation, m.referenceCadastreParcelle1, m.referenceCadastreParcelle2, m.referenceCadastreParcelle3, m.autreReferenceParcelle, m.superficieParcelle1, m.superficieParcelle2, m.superficieParcelle3, m.superficieAutreParcelle, m.superficieConstructible, m.superficieTotale, m.numberLot, m.sHONAccordee, m.reglementDeLotissement, m.eRNT, m.passageEau, m.passageElectricite, m.passageGaz, m.voirie, m.tailleFacade, m.profondeurTerrain, m.commentaire, m.geolocalisation, m.proximiteEcole, m.proximiteCommerce, m.proximiteTransport, m.commentaireApparent, m.nbPiece, m.surfaceHabitable, m.nbChambre, m.surfacePieceVie, m.niveau, m.anneeConstruction, m.chargesMensuelle, m.taxesFonciere, m.taxeHabitation, m.user_idUser, m.sector_idSector, m.city_idCity, m.notary_idNotary, m.mandateType_idMandateType, m.transactionType_idTransactionType, m.etap_idMandateEtap, m.freeDate, m.zoneBDF, m.ligneDeCrete, m.zoneInondable, m.dPValide, m.dateDeclarationPrealable, m.prorogationDPJusquau, m.cuValide, m.dateCU, m.prorogationCUJusquau, m.cuOPSValide, m.dateCuOPS, m.prorogationCuOPSJusquau, m.permisDamenagerValide, m.datePermisDamenager, m.terrainVenduViabilise, m.terrainVenduSemiViabilise, m.terrainVenduNonViabilise, m.toutALegout, m.assainissementParFosseSceptique, m.coupCoeur, m.nouveaute, m.cheminee, m.cuisineEquipee, m.cuisineAmenagee, m.piscine, m.poolHouse, m.terrasse, m.mezzanine, m.dependance, m.gaz, m.cave, m.sousSol, m.garage, m.parking, m.rezDeJardin, m.plainPied, m.carriere, m.pointEau, m.slope_idMandateSlope, m.orientation_idMandateOrientation, m.insulation_idMandateInsulation, m.news_idMandateNews, m.heating_idMandateHeating, m.commonOwnership_idMandateCommonOwnership, m.roof_idMandateRoof, m.condition_idMandateCondition, m.style_idMandateStyle, m.construction_idMandateConstructionType, m.sanitationCorresponding_idMandateSanitationCorresponding, m.electricCorresponding_idMandateElectricCorresponding, m.gazCorresponding_idMandateGazCorresponding, m.waterCorresponding_idMandateWaterCorresponding, m.cos_idMandateCOS, m.zonagePLU_idMandateZonagePLU, m.zonageRNU_idMandateZonageRNU, m.bornageTerrain_idMandateBornageTerrain, m.geometer_idMandateGeometer FROM Mandate m WHERE m.gazCorresponding_idMandateGazCorresponding = ?');
		if (!$pdoStatement->execute(array($gazCorresponding->getIdMandateGazCorresponding()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les mandates par gazCorresponding depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�rer le/la waterCorresponding
	 * @return MandateWaterCorresponding
	 */
	public function getWaterCorresponding()
	{
		// Retourner null si n�c�ssaire
		if ($this->waterCorresponding == null) { return null; }

		// Charger et retourner mandateWaterCorresponding
		return MandateWaterCorresponding::load($this->pdo,$this->waterCorresponding);
	}

	/**
	 * D�finir le/la waterCorresponding
	 * @param $waterCorresponding MandateWaterCorresponding
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setWaterCorresponding($waterCorresponding=null,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->waterCorresponding = $waterCorresponding == null ? null : $waterCorresponding->getIdMandateWaterCorresponding();

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('waterCorresponding_idMandateWaterCorresponding'),array($waterCorresponding == null ? null : $waterCorresponding->getIdMandateWaterCorresponding())) : true;
	}

	/**
	 * S�lectionner les mandates par waterCorresponding
	 * @param $pdo PDO
	 * @param $waterCorresponding MandateWaterCorresponding
	 * @return PDOStatement
	 */
	public static function selectByWaterCorresponding(PDO $pdo,MandateWaterCorresponding $waterCorresponding)
	{
		$pdoStatement = $pdo->prepare('SELECT m.idMandate, m.numberMandate, m.initDate, m.deadDate, m.address, m.priceFai, m.priceSeller, m.commission, m.estimationFai, m.margeNegociation, m.referenceCadastreParcelle1, m.referenceCadastreParcelle2, m.referenceCadastreParcelle3, m.autreReferenceParcelle, m.superficieParcelle1, m.superficieParcelle2, m.superficieParcelle3, m.superficieAutreParcelle, m.superficieConstructible, m.superficieTotale, m.numberLot, m.sHONAccordee, m.reglementDeLotissement, m.eRNT, m.passageEau, m.passageElectricite, m.passageGaz, m.voirie, m.tailleFacade, m.profondeurTerrain, m.commentaire, m.geolocalisation, m.proximiteEcole, m.proximiteCommerce, m.proximiteTransport, m.commentaireApparent, m.nbPiece, m.surfaceHabitable, m.nbChambre, m.surfacePieceVie, m.niveau, m.anneeConstruction, m.chargesMensuelle, m.taxesFonciere, m.taxeHabitation, m.user_idUser, m.sector_idSector, m.city_idCity, m.notary_idNotary, m.mandateType_idMandateType, m.transactionType_idTransactionType, m.etap_idMandateEtap, m.freeDate, m.zoneBDF, m.ligneDeCrete, m.zoneInondable, m.dPValide, m.dateDeclarationPrealable, m.prorogationDPJusquau, m.cuValide, m.dateCU, m.prorogationCUJusquau, m.cuOPSValide, m.dateCuOPS, m.prorogationCuOPSJusquau, m.permisDamenagerValide, m.datePermisDamenager, m.terrainVenduViabilise, m.terrainVenduSemiViabilise, m.terrainVenduNonViabilise, m.toutALegout, m.assainissementParFosseSceptique, m.coupCoeur, m.nouveaute, m.cheminee, m.cuisineEquipee, m.cuisineAmenagee, m.piscine, m.poolHouse, m.terrasse, m.mezzanine, m.dependance, m.gaz, m.cave, m.sousSol, m.garage, m.parking, m.rezDeJardin, m.plainPied, m.carriere, m.pointEau, m.slope_idMandateSlope, m.orientation_idMandateOrientation, m.insulation_idMandateInsulation, m.news_idMandateNews, m.heating_idMandateHeating, m.commonOwnership_idMandateCommonOwnership, m.roof_idMandateRoof, m.condition_idMandateCondition, m.style_idMandateStyle, m.construction_idMandateConstructionType, m.sanitationCorresponding_idMandateSanitationCorresponding, m.electricCorresponding_idMandateElectricCorresponding, m.gazCorresponding_idMandateGazCorresponding, m.waterCorresponding_idMandateWaterCorresponding, m.cos_idMandateCOS, m.zonagePLU_idMandateZonagePLU, m.zonageRNU_idMandateZonageRNU, m.bornageTerrain_idMandateBornageTerrain, m.geometer_idMandateGeometer FROM Mandate m WHERE m.waterCorresponding_idMandateWaterCorresponding = ?');
		if (!$pdoStatement->execute(array($waterCorresponding->getIdMandateWaterCorresponding()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les mandates par waterCorresponding depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�rer le/la cos
	 * @return MandateCOS
	 */
	public function getCos()
	{
		// Retourner null si n�c�ssaire
		if ($this->cos == null) { return null; }

		// Charger et retourner mandateCOS
		return MandateCOS::load($this->pdo,$this->cos);
	}

	/**
	 * D�finir le/la cos
	 * @param $cos MandateCOS
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setCos($cos=null,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->cos = $cos == null ? null : $cos->getIdMandateCOS();

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('cos_idMandateCOS'),array($cos == null ? null : $cos->getIdMandateCOS())) : true;
	}

	/**
	 * S�lectionner les mandates par cos
	 * @param $pdo PDO
	 * @param $cos MandateCOS
	 * @return PDOStatement
	 */
	public static function selectByCos(PDO $pdo,MandateCOS $cos)
	{
		$pdoStatement = $pdo->prepare('SELECT m.idMandate, m.numberMandate, m.initDate, m.deadDate, m.address, m.priceFai, m.priceSeller, m.commission, m.estimationFai, m.margeNegociation, m.referenceCadastreParcelle1, m.referenceCadastreParcelle2, m.referenceCadastreParcelle3, m.autreReferenceParcelle, m.superficieParcelle1, m.superficieParcelle2, m.superficieParcelle3, m.superficieAutreParcelle, m.superficieConstructible, m.superficieTotale, m.numberLot, m.sHONAccordee, m.reglementDeLotissement, m.eRNT, m.passageEau, m.passageElectricite, m.passageGaz, m.voirie, m.tailleFacade, m.profondeurTerrain, m.commentaire, m.geolocalisation, m.proximiteEcole, m.proximiteCommerce, m.proximiteTransport, m.commentaireApparent, m.nbPiece, m.surfaceHabitable, m.nbChambre, m.surfacePieceVie, m.niveau, m.anneeConstruction, m.chargesMensuelle, m.taxesFonciere, m.taxeHabitation, m.user_idUser, m.sector_idSector, m.city_idCity, m.notary_idNotary, m.mandateType_idMandateType, m.transactionType_idTransactionType, m.etap_idMandateEtap, m.freeDate, m.zoneBDF, m.ligneDeCrete, m.zoneInondable, m.dPValide, m.dateDeclarationPrealable, m.prorogationDPJusquau, m.cuValide, m.dateCU, m.prorogationCUJusquau, m.cuOPSValide, m.dateCuOPS, m.prorogationCuOPSJusquau, m.permisDamenagerValide, m.datePermisDamenager, m.terrainVenduViabilise, m.terrainVenduSemiViabilise, m.terrainVenduNonViabilise, m.toutALegout, m.assainissementParFosseSceptique, m.coupCoeur, m.nouveaute, m.cheminee, m.cuisineEquipee, m.cuisineAmenagee, m.piscine, m.poolHouse, m.terrasse, m.mezzanine, m.dependance, m.gaz, m.cave, m.sousSol, m.garage, m.parking, m.rezDeJardin, m.plainPied, m.carriere, m.pointEau, m.slope_idMandateSlope, m.orientation_idMandateOrientation, m.insulation_idMandateInsulation, m.news_idMandateNews, m.heating_idMandateHeating, m.commonOwnership_idMandateCommonOwnership, m.roof_idMandateRoof, m.condition_idMandateCondition, m.style_idMandateStyle, m.construction_idMandateConstructionType, m.sanitationCorresponding_idMandateSanitationCorresponding, m.electricCorresponding_idMandateElectricCorresponding, m.gazCorresponding_idMandateGazCorresponding, m.waterCorresponding_idMandateWaterCorresponding, m.cos_idMandateCOS, m.zonagePLU_idMandateZonagePLU, m.zonageRNU_idMandateZonageRNU, m.bornageTerrain_idMandateBornageTerrain, m.geometer_idMandateGeometer FROM Mandate m WHERE m.cos_idMandateCOS = ?');
		if (!$pdoStatement->execute(array($cos->getIdMandateCOS()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les mandates par cos depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�rer le/la zonagePLU
	 * @return MandateZonagePLU
	 */
	public function getZonagePLU()
	{
		// Retourner null si n�c�ssaire
		if ($this->zonagePLU == null) { return null; }

		// Charger et retourner mandateZonagePLU
		return MandateZonagePLU::load($this->pdo,$this->zonagePLU);
	}

	/**
	 * D�finir le/la zonagePLU
	 * @param $zonagePLU MandateZonagePLU
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setZonagePLU($zonagePLU=null,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->zonagePLU = $zonagePLU == null ? null : $zonagePLU->getIdMandateZonagePLU();

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('zonagePLU_idMandateZonagePLU'),array($zonagePLU == null ? null : $zonagePLU->getIdMandateZonagePLU())) : true;
	}

	/**
	 * S�lectionner les mandates par zonagePLU
	 * @param $pdo PDO
	 * @param $zonagePLU MandateZonagePLU
	 * @return PDOStatement
	 */
	public static function selectByZonagePLU(PDO $pdo,MandateZonagePLU $zonagePLU)
	{
		$pdoStatement = $pdo->prepare('SELECT m.idMandate, m.numberMandate, m.initDate, m.deadDate, m.address, m.priceFai, m.priceSeller, m.commission, m.estimationFai, m.margeNegociation, m.referenceCadastreParcelle1, m.referenceCadastreParcelle2, m.referenceCadastreParcelle3, m.autreReferenceParcelle, m.superficieParcelle1, m.superficieParcelle2, m.superficieParcelle3, m.superficieAutreParcelle, m.superficieConstructible, m.superficieTotale, m.numberLot, m.sHONAccordee, m.reglementDeLotissement, m.eRNT, m.passageEau, m.passageElectricite, m.passageGaz, m.voirie, m.tailleFacade, m.profondeurTerrain, m.commentaire, m.geolocalisation, m.proximiteEcole, m.proximiteCommerce, m.proximiteTransport, m.commentaireApparent, m.nbPiece, m.surfaceHabitable, m.nbChambre, m.surfacePieceVie, m.niveau, m.anneeConstruction, m.chargesMensuelle, m.taxesFonciere, m.taxeHabitation, m.user_idUser, m.sector_idSector, m.city_idCity, m.notary_idNotary, m.mandateType_idMandateType, m.transactionType_idTransactionType, m.etap_idMandateEtap, m.freeDate, m.zoneBDF, m.ligneDeCrete, m.zoneInondable, m.dPValide, m.dateDeclarationPrealable, m.prorogationDPJusquau, m.cuValide, m.dateCU, m.prorogationCUJusquau, m.cuOPSValide, m.dateCuOPS, m.prorogationCuOPSJusquau, m.permisDamenagerValide, m.datePermisDamenager, m.terrainVenduViabilise, m.terrainVenduSemiViabilise, m.terrainVenduNonViabilise, m.toutALegout, m.assainissementParFosseSceptique, m.coupCoeur, m.nouveaute, m.cheminee, m.cuisineEquipee, m.cuisineAmenagee, m.piscine, m.poolHouse, m.terrasse, m.mezzanine, m.dependance, m.gaz, m.cave, m.sousSol, m.garage, m.parking, m.rezDeJardin, m.plainPied, m.carriere, m.pointEau, m.slope_idMandateSlope, m.orientation_idMandateOrientation, m.insulation_idMandateInsulation, m.news_idMandateNews, m.heating_idMandateHeating, m.commonOwnership_idMandateCommonOwnership, m.roof_idMandateRoof, m.condition_idMandateCondition, m.style_idMandateStyle, m.construction_idMandateConstructionType, m.sanitationCorresponding_idMandateSanitationCorresponding, m.electricCorresponding_idMandateElectricCorresponding, m.gazCorresponding_idMandateGazCorresponding, m.waterCorresponding_idMandateWaterCorresponding, m.cos_idMandateCOS, m.zonagePLU_idMandateZonagePLU, m.zonageRNU_idMandateZonageRNU, m.bornageTerrain_idMandateBornageTerrain, m.geometer_idMandateGeometer FROM Mandate m WHERE m.zonagePLU_idMandateZonagePLU = ?');
		if (!$pdoStatement->execute(array($zonagePLU->getIdMandateZonagePLU()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les mandates par zonagePLU depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�rer le/la zonageRNU
	 * @return MandateZonageRNU
	 */
	public function getZonageRNU()
	{
		// Retourner null si n�c�ssaire
		if ($this->zonageRNU == null) { return null; }

		// Charger et retourner mandateZonageRNU
		return MandateZonageRNU::load($this->pdo,$this->zonageRNU);
	}

	/**
	 * D�finir le/la zonageRNU
	 * @param $zonageRNU MandateZonageRNU
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setZonageRNU($zonageRNU=null,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->zonageRNU = $zonageRNU == null ? null : $zonageRNU->getIdMandateZonageRNU();

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('zonageRNU_idMandateZonageRNU'),array($zonageRNU == null ? null : $zonageRNU->getIdMandateZonageRNU())) : true;
	}

	/**
	 * S�lectionner les mandates par zonageRNU
	 * @param $pdo PDO
	 * @param $zonageRNU MandateZonageRNU
	 * @return PDOStatement
	 */
	public static function selectByZonageRNU(PDO $pdo,MandateZonageRNU $zonageRNU)
	{
		$pdoStatement = $pdo->prepare('SELECT m.idMandate, m.numberMandate, m.initDate, m.deadDate, m.address, m.priceFai, m.priceSeller, m.commission, m.estimationFai, m.margeNegociation, m.referenceCadastreParcelle1, m.referenceCadastreParcelle2, m.referenceCadastreParcelle3, m.autreReferenceParcelle, m.superficieParcelle1, m.superficieParcelle2, m.superficieParcelle3, m.superficieAutreParcelle, m.superficieConstructible, m.superficieTotale, m.numberLot, m.sHONAccordee, m.reglementDeLotissement, m.eRNT, m.passageEau, m.passageElectricite, m.passageGaz, m.voirie, m.tailleFacade, m.profondeurTerrain, m.commentaire, m.geolocalisation, m.proximiteEcole, m.proximiteCommerce, m.proximiteTransport, m.commentaireApparent, m.nbPiece, m.surfaceHabitable, m.nbChambre, m.surfacePieceVie, m.niveau, m.anneeConstruction, m.chargesMensuelle, m.taxesFonciere, m.taxeHabitation, m.user_idUser, m.sector_idSector, m.city_idCity, m.notary_idNotary, m.mandateType_idMandateType, m.transactionType_idTransactionType, m.etap_idMandateEtap, m.freeDate, m.zoneBDF, m.ligneDeCrete, m.zoneInondable, m.dPValide, m.dateDeclarationPrealable, m.prorogationDPJusquau, m.cuValide, m.dateCU, m.prorogationCUJusquau, m.cuOPSValide, m.dateCuOPS, m.prorogationCuOPSJusquau, m.permisDamenagerValide, m.datePermisDamenager, m.terrainVenduViabilise, m.terrainVenduSemiViabilise, m.terrainVenduNonViabilise, m.toutALegout, m.assainissementParFosseSceptique, m.coupCoeur, m.nouveaute, m.cheminee, m.cuisineEquipee, m.cuisineAmenagee, m.piscine, m.poolHouse, m.terrasse, m.mezzanine, m.dependance, m.gaz, m.cave, m.sousSol, m.garage, m.parking, m.rezDeJardin, m.plainPied, m.carriere, m.pointEau, m.slope_idMandateSlope, m.orientation_idMandateOrientation, m.insulation_idMandateInsulation, m.news_idMandateNews, m.heating_idMandateHeating, m.commonOwnership_idMandateCommonOwnership, m.roof_idMandateRoof, m.condition_idMandateCondition, m.style_idMandateStyle, m.construction_idMandateConstructionType, m.sanitationCorresponding_idMandateSanitationCorresponding, m.electricCorresponding_idMandateElectricCorresponding, m.gazCorresponding_idMandateGazCorresponding, m.waterCorresponding_idMandateWaterCorresponding, m.cos_idMandateCOS, m.zonagePLU_idMandateZonagePLU, m.zonageRNU_idMandateZonageRNU, m.bornageTerrain_idMandateBornageTerrain, m.geometer_idMandateGeometer FROM Mandate m WHERE m.zonageRNU_idMandateZonageRNU = ?');
		if (!$pdoStatement->execute(array($zonageRNU->getIdMandateZonageRNU()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les mandates par zonageRNU depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�rer le/la bornageTerrain
	 * @return MandateBornageTerrain
	 */
	public function getBornageTerrain()
	{
		// Retourner null si n�c�ssaire
		if ($this->bornageTerrain == null) { return null; }

		// Charger et retourner mandateBornageTerrain
		return MandateBornageTerrain::load($this->pdo,$this->bornageTerrain);
	}

	/**
	 * D�finir le/la bornageTerrain
	 * @param $bornageTerrain MandateBornageTerrain
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setBornageTerrain($bornageTerrain=null,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->bornageTerrain = $bornageTerrain == null ? null : $bornageTerrain->getIdMandateBornageTerrain();

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('bornageTerrain_idMandateBornageTerrain'),array($bornageTerrain == null ? null : $bornageTerrain->getIdMandateBornageTerrain())) : true;
	}

	/**
	 * S�lectionner les mandates par bornageTerrain
	 * @param $pdo PDO
	 * @param $bornageTerrain MandateBornageTerrain
	 * @return PDOStatement
	 */
	public static function selectByBornageTerrain(PDO $pdo,MandateBornageTerrain $bornageTerrain)
	{
		$pdoStatement = $pdo->prepare('SELECT m.idMandate, m.numberMandate, m.initDate, m.deadDate, m.address, m.priceFai, m.priceSeller, m.commission, m.estimationFai, m.margeNegociation, m.referenceCadastreParcelle1, m.referenceCadastreParcelle2, m.referenceCadastreParcelle3, m.autreReferenceParcelle, m.superficieParcelle1, m.superficieParcelle2, m.superficieParcelle3, m.superficieAutreParcelle, m.superficieConstructible, m.superficieTotale, m.numberLot, m.sHONAccordee, m.reglementDeLotissement, m.eRNT, m.passageEau, m.passageElectricite, m.passageGaz, m.voirie, m.tailleFacade, m.profondeurTerrain, m.commentaire, m.geolocalisation, m.proximiteEcole, m.proximiteCommerce, m.proximiteTransport, m.commentaireApparent, m.nbPiece, m.surfaceHabitable, m.nbChambre, m.surfacePieceVie, m.niveau, m.anneeConstruction, m.chargesMensuelle, m.taxesFonciere, m.taxeHabitation, m.user_idUser, m.sector_idSector, m.city_idCity, m.notary_idNotary, m.mandateType_idMandateType, m.transactionType_idTransactionType, m.etap_idMandateEtap, m.freeDate, m.zoneBDF, m.ligneDeCrete, m.zoneInondable, m.dPValide, m.dateDeclarationPrealable, m.prorogationDPJusquau, m.cuValide, m.dateCU, m.prorogationCUJusquau, m.cuOPSValide, m.dateCuOPS, m.prorogationCuOPSJusquau, m.permisDamenagerValide, m.datePermisDamenager, m.terrainVenduViabilise, m.terrainVenduSemiViabilise, m.terrainVenduNonViabilise, m.toutALegout, m.assainissementParFosseSceptique, m.coupCoeur, m.nouveaute, m.cheminee, m.cuisineEquipee, m.cuisineAmenagee, m.piscine, m.poolHouse, m.terrasse, m.mezzanine, m.dependance, m.gaz, m.cave, m.sousSol, m.garage, m.parking, m.rezDeJardin, m.plainPied, m.carriere, m.pointEau, m.slope_idMandateSlope, m.orientation_idMandateOrientation, m.insulation_idMandateInsulation, m.news_idMandateNews, m.heating_idMandateHeating, m.commonOwnership_idMandateCommonOwnership, m.roof_idMandateRoof, m.condition_idMandateCondition, m.style_idMandateStyle, m.construction_idMandateConstructionType, m.sanitationCorresponding_idMandateSanitationCorresponding, m.electricCorresponding_idMandateElectricCorresponding, m.gazCorresponding_idMandateGazCorresponding, m.waterCorresponding_idMandateWaterCorresponding, m.cos_idMandateCOS, m.zonagePLU_idMandateZonagePLU, m.zonageRNU_idMandateZonageRNU, m.bornageTerrain_idMandateBornageTerrain, m.geometer_idMandateGeometer FROM Mandate m WHERE m.bornageTerrain_idMandateBornageTerrain = ?');
		if (!$pdoStatement->execute(array($bornageTerrain->getIdMandateBornageTerrain()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les mandates par bornageTerrain depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�rer le/la geometer
	 * @return MandateGeometer
	 */
	public function getGeometer()
	{
		// Retourner null si n�c�ssaire
		if ($this->geometer == null) { return null; }

		// Charger et retourner mandateGeometer
		return MandateGeometer::load($this->pdo,$this->geometer);
	}

	/**
	 * D�finir le/la geometer
	 * @param $geometer MandateGeometer
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setGeometer($geometer=null,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->geometer = $geometer == null ? null : $geometer->getIdMandateGeometer();

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('geometer_idMandateGeometer'),array($geometer == null ? null : $geometer->getIdMandateGeometer())) : true;
	}

	/**
	 * S�lectionner les mandates par geometer
	 * @param $pdo PDO
	 * @param $geometer MandateGeometer
	 * @return PDOStatement
	 */
	public static function selectByGeometer(PDO $pdo,MandateGeometer $geometer)
	{
		$pdoStatement = $pdo->prepare('SELECT m.idMandate, m.numberMandate, m.initDate, m.deadDate, m.address, m.priceFai, m.priceSeller, m.commission, m.estimationFai, m.margeNegociation, m.referenceCadastreParcelle1, m.referenceCadastreParcelle2, m.referenceCadastreParcelle3, m.autreReferenceParcelle, m.superficieParcelle1, m.superficieParcelle2, m.superficieParcelle3, m.superficieAutreParcelle, m.superficieConstructible, m.superficieTotale, m.numberLot, m.sHONAccordee, m.reglementDeLotissement, m.eRNT, m.passageEau, m.passageElectricite, m.passageGaz, m.voirie, m.tailleFacade, m.profondeurTerrain, m.commentaire, m.geolocalisation, m.proximiteEcole, m.proximiteCommerce, m.proximiteTransport, m.commentaireApparent, m.nbPiece, m.surfaceHabitable, m.nbChambre, m.surfacePieceVie, m.niveau, m.anneeConstruction, m.chargesMensuelle, m.taxesFonciere, m.taxeHabitation, m.user_idUser, m.sector_idSector, m.city_idCity, m.notary_idNotary, m.mandateType_idMandateType, m.transactionType_idTransactionType, m.etap_idMandateEtap, m.freeDate, m.zoneBDF, m.ligneDeCrete, m.zoneInondable, m.dPValide, m.dateDeclarationPrealable, m.prorogationDPJusquau, m.cuValide, m.dateCU, m.prorogationCUJusquau, m.cuOPSValide, m.dateCuOPS, m.prorogationCuOPSJusquau, m.permisDamenagerValide, m.datePermisDamenager, m.terrainVenduViabilise, m.terrainVenduSemiViabilise, m.terrainVenduNonViabilise, m.toutALegout, m.assainissementParFosseSceptique, m.coupCoeur, m.nouveaute, m.cheminee, m.cuisineEquipee, m.cuisineAmenagee, m.piscine, m.poolHouse, m.terrasse, m.mezzanine, m.dependance, m.gaz, m.cave, m.sousSol, m.garage, m.parking, m.rezDeJardin, m.plainPied, m.carriere, m.pointEau, m.slope_idMandateSlope, m.orientation_idMandateOrientation, m.insulation_idMandateInsulation, m.news_idMandateNews, m.heating_idMandateHeating, m.commonOwnership_idMandateCommonOwnership, m.roof_idMandateRoof, m.condition_idMandateCondition, m.style_idMandateStyle, m.construction_idMandateConstructionType, m.sanitationCorresponding_idMandateSanitationCorresponding, m.electricCorresponding_idMandateElectricCorresponding, m.gazCorresponding_idMandateGazCorresponding, m.waterCorresponding_idMandateWaterCorresponding, m.cos_idMandateCOS, m.zonagePLU_idMandateZonagePLU, m.zonageRNU_idMandateZonageRNU, m.bornageTerrain_idMandateBornageTerrain, m.geometer_idMandateGeometer FROM Mandate m WHERE m.geometer_idMandateGeometer = ?');
		if (!$pdoStatement->execute(array($geometer->getIdMandateGeometer()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les mandates par geometer depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	/**
	 * R�cup�rer le/la etap
	 * @return MandateEtap
	 */
	public function getEtap()
	{
		return MandateEtap::load($this->pdo,$this->etap);
	}

	/**
	 * D�finir le/la etap
	 * @param $etap MandateEtap
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setEtap(MandateEtap $etap,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->etap = $etap->getIdMandateEtap();

		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('etap_idMandateEtap'),array($etap->getIdMandateEtap())) : true;
	}

	/**
	 * S�lectionner les mandates par etap
	 * @param $pdo PDO
	 * @param $etap MandateEtap
	 * @return PDOStatement
	 */
	public static function selectByEtap(PDO $pdo,MandateEtap $etap)
	{
		$pdoStatement = $pdo->prepare('SELECT m.idMandate, m.numberMandate, m.initDate, m.deadDate, m.address, m.priceFai, m.priceSeller, m.commission, m.estimationFai, m.margeNegociation, m.referenceCadastreParcelle1, m.referenceCadastreParcelle2, m.referenceCadastreParcelle3, m.autreReferenceParcelle, m.superficieParcelle1, m.superficieParcelle2, m.superficieParcelle3, m.superficieAutreParcelle, m.superficieConstructible, m.superficieTotale, m.numberLot, m.sHONAccordee, m.reglementDeLotissement, m.eRNT, m.passageEau, m.passageElectricite, m.passageGaz, m.voirie, m.tailleFacade, m.profondeurTerrain, m.commentaire, m.geolocalisation, m.proximiteEcole, m.proximiteCommerce, m.proximiteTransport, m.commentaireApparent, m.nbPiece, m.surfaceHabitable, m.nbChambre, m.surfacePieceVie, m.niveau, m.anneeConstruction, m.chargesMensuelle, m.taxesFonciere, m.taxeHabitation, m.user_idUser, m.sector_idSector, m.city_idCity, m.notary_idNotary, m.mandateType_idMandateType, m.transactionType_idTransactionType, m.etap_idMandateEtap, m.freeDate, m.zoneBDF, m.ligneDeCrete, m.zoneInondable, m.dPValide, m.dateDeclarationPrealable, m.prorogationDPJusquau, m.cuValide, m.dateCU, m.prorogationCUJusquau, m.cuOPSValide, m.dateCuOPS, m.prorogationCuOPSJusquau, m.permisDamenagerValide, m.datePermisDamenager, m.terrainVenduViabilise, m.terrainVenduSemiViabilise, m.terrainVenduNonViabilise, m.toutALegout, m.assainissementParFosseSceptique, m.coupCoeur, m.nouveaute, m.cheminee, m.cuisineEquipee, m.cuisineAmenagee, m.piscine, m.poolHouse, m.terrasse, m.mezzanine, m.dependance, m.gaz, m.cave, m.sousSol, m.garage, m.parking, m.rezDeJardin, m.plainPied, m.carriere, m.pointEau, m.slope_idMandateSlope, m.orientation_idMandateOrientation, m.insulation_idMandateInsulation, m.news_idMandateNews, m.heating_idMandateHeating, m.commonOwnership_idMandateCommonOwnership, m.roof_idMandateRoof, m.condition_idMandateCondition, m.style_idMandateStyle, m.construction_idMandateConstructionType, m.sanitationCorresponding_idMandateSanitationCorresponding, m.electricCorresponding_idMandateElectricCorresponding, m.gazCorresponding_idMandateGazCorresponding, m.waterCorresponding_idMandateWaterCorresponding, m.cos_idMandateCOS, m.zonagePLU_idMandateZonagePLU, m.zonageRNU_idMandateZonageRNU, m.bornageTerrain_idMandateBornageTerrain, m.geometer_idMandateGeometer FROM Mandate m WHERE m.etap_idMandateEtap = ?');
		if (!$pdoStatement->execute(array($etap->getIdMandateEtap()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les mandates par etap depuis la base de donn�es');
		}
		return $pdoStatement;
	}
	/**
	 * ToString
	 * @return string repr�sentation de mandate sous la forme d'un string
	 */
	public function __toString()
	{
		return '[Mandate idMandate="'.$this->idMandate.'" numberMandate="'.$this->numberMandate.'" initDate="'.date('d/m/Y',$this->initDate).'" deadDate="'.date('d/m/Y',$this->deadDate).'" freeDate="'.date('d/m/Y',$this->freeDate).'" address="'.$this->address.'" priceFai="'.$this->priceFai.'" priceSeller="'.$this->priceSeller.'" commission="'.$this->commission.'" estimationFai="'.$this->estimationFai.'" margeNegociation="'.$this->margeNegociation.'" referenceCadastreParcelle1="'.$this->referenceCadastreParcelle1.'" referenceCadastreParcelle2="'.$this->referenceCadastreParcelle2.'" referenceCadastreParcelle3="'.$this->referenceCadastreParcelle3.'" autreReferenceParcelle="'.$this->autreReferenceParcelle.'" superficieParcelle1="'.$this->superficieParcelle1.'" superficieParcelle2="'.$this->superficieParcelle2.'" superficieParcelle3="'.$this->superficieParcelle3.'" superficieAutreParcelle="'.$this->superficieAutreParcelle.'" superficieConstructible="'.$this->superficieConstructible.'" superficieTotale="'.$this->superficieTotale.'" numberLot="'.$this->numberLot.'" sHONAccordee="'.$this->sHONAccordee.'" zoneBDF="'.($this->zoneBDF?'true':'false').'" ligneDeCrete="'.($this->ligneDeCrete?'true':'false').'" zoneInondable="'.($this->zoneInondable?'true':'false').'" reglementDeLotissement="'.$this->reglementDeLotissement.'" eRNT="'.$this->eRNT.'" dPValide="'.($this->dPValide?'true':'false').'" dateDeclarationPrealable="'.date('d/m/Y',$this->dateDeclarationPrealable).'" prorogationDPJusquau="'.date('d/m/Y',$this->prorogationDPJusquau).'" cuValide="'.($this->cuValide?'true':'false').'" dateCU="'.($this->dateCU?'true':'false').'" prorogationCUJusquau="'.($this->prorogationCUJusquau?'true':'false').'" cuOPSValide="'.($this->cuOPSValide?'true':'false').'" dateCuOPS="'.date('d/m/Y',$this->dateCuOPS).'" prorogationCuOPSJusquau="'.($this->prorogationCuOPSJusquau?'true':'false').'" permisDamenagerValide="'.($this->permisDamenagerValide?'true':'false').'" datePermisDamenager="'.date('d/m/Y',$this->datePermisDamenager).'" terrainVenduViabilise="'.($this->terrainVenduViabilise?'true':'false').'" terrainVenduSemiViabilise="'.($this->terrainVenduSemiViabilise?'true':'false').'" terrainVenduNonViabilise="'.($this->terrainVenduNonViabilise?'true':'false').'" passageEau="'.$this->passageEau.'" passageElectricite="'.$this->passageElectricite.'" passageGaz="'.$this->passageGaz.'" toutALegout="'.($this->toutALegout?'true':'false').'" assainissementParFosseSceptique="'.($this->assainissementParFosseSceptique?'true':'false').'" voirie="'.$this->voirie.'" tailleFacade="'.$this->tailleFacade.'" profondeurTerrain="'.$this->profondeurTerrain.'" commentaire="'.$this->commentaire.'" geolocalisation="'.$this->geolocalisation.'" proximiteEcole="'.$this->proximiteEcole.'" proximiteCommerce="'.$this->proximiteCommerce.'" proximiteTransport="'.$this->proximiteTransport.'" commentaireApparent="'.$this->commentaireApparent.'" nbPiece="'.$this->nbPiece.'" surfaceHabitable="'.$this->surfaceHabitable.'" nbChambre="'.$this->nbChambre.'" surfacePieceVie="'.$this->surfacePieceVie.'" niveau="'.$this->niveau.'" anneeConstruction="'.$this->anneeConstruction.'" coupCoeur="'.($this->coupCoeur?'true':'false').'" chargesMensuelle="'.$this->chargesMensuelle.'" taxesFonciere="'.$this->taxesFonciere.'" taxeHabitation="'.$this->taxeHabitation.'" nouveaute="'.date('d/m/Y',$this->nouveaute).'" cheminee="'.($this->cheminee?'true':'false').'" cuisineEquipee="'.($this->cuisineEquipee?'true':'false').'" cuisineAmenagee="'.($this->cuisineAmenagee?'true':'false').'" piscine="'.($this->piscine?'true':'false').'" poolHouse="'.($this->poolHouse?'true':'false').'" terrasse="'.($this->terrasse?'true':'false').'" mezzanine="'.($this->mezzanine?'true':'false').'" dependance="'.($this->dependance?'true':'false').'" gaz="'.($this->gaz?'true':'false').'" cave="'.($this->cave?'true':'false').'" sousSol="'.($this->sousSol?'true':'false').'" garage="'.($this->garage?'true':'false').'" parking="'.($this->parking?'true':'false').'" rezDeJardin="'.($this->rezDeJardin?'true':'false').'" plainPied="'.($this->plainPied?'true':'false').'" carriere="'.($this->carriere?'true':'false').'" pointEau="'.($this->pointEau?'true':'false').'" user="'.$this->user.'" sector="'.$this->sector.'" city="'.$this->city.'" notary="'.$this->notary.'" mandateType="'.$this->mandateType.'" transactionType="'.$this->transactionType.'" slope="'.$this->slope.'" orientation="'.$this->orientation.'" insulation="'.$this->insulation.'" news="'.$this->news.'" heating="'.$this->heating.'" commonOwnership="'.$this->commonOwnership.'" roof="'.$this->roof.'" condition="'.$this->condition.'" style="'.$this->style.'" construction="'.$this->construction.'" sanitationCorresponding="'.$this->sanitationCorresponding.'" electricCorresponding="'.$this->electricCorresponding.'" gazCorresponding="'.$this->gazCorresponding.'" waterCorresponding="'.$this->waterCorresponding.'" cos="'.$this->cos.'" zonagePLU="'.$this->zonagePLU.'" zonageRNU="'.$this->zonageRNU.'" bornageTerrain="'.$this->bornageTerrain.'" geometer="'.$this->geometer.'" etap="'.$this->etap.'"]';
	}


	// additionnals functions

	/**
	 *
	 * @param Seller $seller
	 * @param Bool $isDefault
	 * @return Bool
	 */
	public function addSeller(Seller $seller,$isDefault = false )
	{
		$isDefault = $isDefault?1:0;
		$pdoStatement = $this->pdo->prepare('INSERT INTO Mandate_Seller (fk_idMandate,fk_idSeller,isDefault) VALUES (?,?,?)');
		if (!$pdoStatement->execute(array($this->getIdMandate(),$seller->getIdSeller(),$isDefault))) {
			throw new Exception($pdoStatement->errorInfo());
		}

		return $pdoStatement->rowCount() == 1;
	}
	public function deleteRelSeller(Seller $seller){
		$pdoStatement = $this->pdo->prepare('DELETE FROM Mandate_Seller WHERE fk_idMandate = ? AND fk_idSeller = ?');
		if (!$pdoStatement->execute( array($this->getIdMandate(),$seller->getIdSeller()) )) {
			throw new Exception($pdoStatement->errorInfo());
		}

		return $pdoStatement->rowCount() == 1;
	}

	public static function sellerIsForOneMandate(Pdo $pdo,Seller $seller){

	}

	public function getDefaultSeller(){
		$pdoStatement = $this->pdo->prepare("Select s.idSeller, s.name, s.firstname, s.address, s.phone, s.mobilPhone, s.workPhone, s.fax, s.email, s.comments, s.city_idCity, s.sellerTitle_idSellerTitle, s.user_idUser, s.asset  from Mandate_Seller ms, Seller s WHERE (ms.fk_idSeller = s.idSeller) AND ms.fk_idMandate = ? AND ms.isDefault = 1");
		if (!$pdoStatement->execute(array($this->getIdMandate() ) )) {
			throw new Exception('Erreur lors du chargement de tous/toutes les mandates par etap depuis la base de donn�es');
		}
		return Seller::fetch($this->pdo, $pdoStatement);
	}
	public function listSellers(){
		$pdoStatement = $this->pdo->prepare("Select s.idSeller, s.name, s.firstname, s.address, s.phone, s.mobilPhone, s.workPhone, s.fax, s.email, s.comments, s.city_idCity, s.sellerTitle_idSellerTitle, s.user_idUser, s.asset,ms.isDefault  from Mandate_Seller ms, Seller s WHERE (ms.fk_idSeller = s.idSeller) AND ms.fk_idMandate = ?");
		if (!$pdoStatement->execute(array($this->getIdMandate() ) )) {
			throw new Exception('Erreur lors du chargement de tous/toutes les mandates par etap depuis la base de donn�es');
		}
		//		return $pdoStatement;
		$sellers = array();
		while($r = Fk_seller::fetch($this->pdo, $pdoStatement))
		$sellers[]=$r;
		return $sellers;
	}
	public function isSeller(Seller $seller){
		$pdoStatement = $this->pdo->prepare("Select count(s.idSeller) from Mandate_Seller ms, Seller s WHERE (ms.fk_idSeller = s.idSeller) AND ms.fk_idMandate = ? AND ms.fk_idSeller = ?");
		if (!$pdoStatement->execute(array($this->getIdMandate(),$seller->getIdSeller() ) )) {
			throw new Exception('Erreur lors du chargement de tous/toutes les mandates par etap depuis la base de donn�es');
		}
		$count =$pdoStatement->fetch();
		return $count['count(s.idSeller)']==0?false:true;
	}
	public function toogleDefaultSeller(Seller $oldSeller,Seller $newSellel){
		$pdoStatement = $this->pdo->prepare("UPDATE Mandate_Seller SET isDefault = 0 WHERE fk_idMandate = ? AND fk_idSeller = ?");
		if (!$pdoStatement->execute(array($this->getIdMandate() ,$oldSeller->getIdSeller()) )) {
			throw new Exception('e1 Erreur lors du chargement de tous/toutes les mandates par etap depuis la base de donn�es');
		}
		$pdoStatement = $this->pdo->prepare("UPDATE Mandate_Seller SET isDefault = 1 WHERE fk_idMandate = ? AND fk_idSeller = ?");
		if (!$pdoStatement->execute(array($this->getIdMandate() ,$newSellel->getIdSeller()) )) {
			throw new Exception('e2 Erreur lors du chargement de tous/toutes les mandates par etap depuis la base de donn�es');
		}
		return  $pdoStatement->rowCount() == 1;
	}
	/**
	 * S�lectionner les mandates par etap
	 * @param $pdo PDO
	 * @param $etap MandateEtap
	 * @return PDOStatement
	 */
	public static function selectByEtapAndType(PDO $pdo,MandateEtap $etap,MandateType $type)
	{
		$pdoStatement = $pdo->prepare('SELECT m.idMandate, m.numberMandate, m.initDate, m.deadDate, m.address, m.priceFai, m.priceSeller, m.commission, m.estimationFai, m.margeNegociation, m.referenceCadastreParcelle1, m.referenceCadastreParcelle2, m.referenceCadastreParcelle3, m.autreReferenceParcelle, m.superficieParcelle1, m.superficieParcelle2, m.superficieParcelle3, m.superficieAutreParcelle, m.superficieConstructible, m.superficieTotale, m.numberLot, m.sHONAccordee, m.reglementDeLotissement, m.eRNT, m.passageEau, m.passageElectricite, m.passageGaz, m.voirie, m.tailleFacade, m.profondeurTerrain, m.commentaire, m.geolocalisation, m.proximiteEcole, m.proximiteCommerce, m.proximiteTransport, m.commentaireApparent, m.nbPiece, m.surfaceHabitable, m.nbChambre, m.surfacePieceVie, m.niveau, m.anneeConstruction, m.chargesMensuelle, m.taxesFonciere, m.taxeHabitation, m.user_idUser, m.sector_idSector, m.city_idCity, m.notary_idNotary, m.mandateType_idMandateType, m.transactionType_idTransactionType, m.etap_idMandateEtap, m.freeDate, m.zoneBDF, m.ligneDeCrete, m.zoneInondable, m.dPValide, m.dateDeclarationPrealable, m.prorogationDPJusquau, m.cuValide, m.dateCU, m.prorogationCUJusquau, m.cuOPSValide, m.dateCuOPS, m.prorogationCuOPSJusquau, m.permisDamenagerValide, m.datePermisDamenager, m.terrainVenduViabilise, m.terrainVenduSemiViabilise, m.terrainVenduNonViabilise, m.toutALegout, m.assainissementParFosseSceptique, m.coupCoeur, m.nouveaute, m.cheminee, m.cuisineEquipee, m.cuisineAmenagee, m.piscine, m.poolHouse, m.terrasse, m.mezzanine, m.dependance, m.gaz, m.cave, m.sousSol, m.garage, m.parking, m.rezDeJardin, m.plainPied, m.carriere, m.pointEau, m.slope_idMandateSlope, m.orientation_idMandateOrientation, m.insulation_idMandateInsulation, m.news_idMandateNews, m.heating_idMandateHeating, m.commonOwnership_idMandateCommonOwnership, m.roof_idMandateRoof, m.condition_idMandateCondition, m.style_idMandateStyle, m.construction_idMandateConstructionType, m.sanitationCorresponding_idMandateSanitationCorresponding, m.electricCorresponding_idMandateElectricCorresponding, m.gazCorresponding_idMandateGazCorresponding, m.waterCorresponding_idMandateWaterCorresponding, m.cos_idMandateCOS, m.zonagePLU_idMandateZonagePLU, m.zonageRNU_idMandateZonageRNU, m.bornageTerrain_idMandateBornageTerrain, m.geometer_idMandateGeometer FROM Mandate m WHERE m.etap_idMandateEtap = ? AND m.mandateType_idMandateType = ?');
		if (!$pdoStatement->execute(array($etap->getIdMandateEtap(),$type->getIdMandateType() ) )) {
			throw new Exception('Erreur lors du chargement de tous/toutes les mandates par etap depuis la base de donn�es');
		}
		return $pdoStatement;
	}

	public function listPictures(){

		$rows = MandatePicture::selectByMandate($this->pdo,$this);
			
		$obj = array();
		while($item = MandatePicture::fetch($this->pdo,$rows))
		$obj[]=$item;
		return $obj;
	}
	public function getPictureByDefault(){
		$rows = MandatePicture::selectByMandateAndDefault($this->pdo,$this);
		return MandatePicture::fetch($this->pdo,$rows);
	}

}

?>
