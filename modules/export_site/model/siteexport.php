<?php

/**
 * @class SiteExport
 * @date 13/12/2011 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class SiteExport
{
	/// @var PDO 
	private $pdo;
	
	/// @var array tableau pour le chargement rapide
	private static $easyload;
	
	/// @var int 
	private $idSiteExport;
	
	/// @var bool 
	private $robots;
	
	/// @var int 
	private $nbAnnoncesParPage;
	
	/// @var string 
	private $txtIndex;
	
	/// @var string 
	private $emailContact;
	
	/// @var int 
	private $nbNouveauteParAgence;
	
	/// @var string 
	private $nomSite;
	
	/// @var string 
	private $titreAccueil;
	
	/// @var string 
	private $metaDescriptionAccueil;
	
	/// @var string 
	private $header;
	
	/// @var string 
	private $logo;
	
	/// @var int id de theme
	private $theme;
	
	private $nameAgency;
	private $addressAgency;
	private $zipcodeAgency;
	private $cityAgency;
	private $phoneAgency;
	private $faxAgency;

    private $exportWebsiteUrl;
    private $emailWelcomeClientAccount;
    private $emailResetPasswordClientAccount;


    private $subjectEmailWelcomeClientAccount;
    private $subjectEmailResetPasswordClientAccount;
    private $subjectEmailContactCommercial;

	/**
	 * Construire un(e) siteExport
	 * @param $pdo PDO 
	 * @param $idSiteExport int 
	 * @param $nbAnnoncesParPage int 
	 * @param $txtIndex string 
	 * @param $emailContact string 
	 * @param $nbNouveauteParAgence int 
	 * @param $nomSite string 
	 * @param $titreAccueil string 
	 * @param $metaDescriptionAccueil string 
	 * @param $header string 
	 * @param $logo string 
	 * @param $theme int id de theme
	 * @param $robots bool 
	 * @param $easyload bool activer le chargement rapide ?
	 * @return SiteExport 
	 */
	protected function __construct(PDO $pdo,$idSiteExport,$nbAnnoncesParPage,$txtIndex,$emailContact,$nbNouveauteParAgence,$nomSite,$titreAccueil,$metaDescriptionAccueil,$header,$logo,$theme,
	$robots=false,
	$nameAgency,$addressAgency,$zipcodeAgency,$cityAgency,$phoneAgency,$faxAgency,
    $exportWebsiteUrl,$emailWelcomeClientAccount,$emailResetPasswordClientAccount,
    $subjectEmailWelcomeClientAccount,$subjectEmailResetPasswordClientAccount,
    $subjectEmailContactCommercial,
	$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;
		
		// Sauvegarder les attributs
		$this->idSiteExport = $idSiteExport;
		$this->nbAnnoncesParPage = $nbAnnoncesParPage;
		$this->txtIndex = $txtIndex;
		$this->emailContact = $emailContact;
		$this->nbNouveauteParAgence = $nbNouveauteParAgence;
		$this->nomSite = $nomSite;
		$this->titreAccueil = $titreAccueil;
		$this->metaDescriptionAccueil = $metaDescriptionAccueil;
		$this->header = $header;
		$this->logo = $logo;
		$this->theme = $theme;
		$this->robots = $robots;
		
		$this->nameAgency =$nameAgency;
		$this->addressAgency =$addressAgency;
		$this->zipcodeAgency =$zipcodeAgency;
		$this->cityAgency =$cityAgency;
		$this->phoneAgency =$phoneAgency;
		$this->faxAgency =$faxAgency;

        $this->exportWebsiteUrl=$exportWebsiteUrl;
        $this->emailWelcomeClientAccount=$emailWelcomeClientAccount;
        $this->emailResetPasswordClientAccount = $emailResetPasswordClientAccount;

        $this->subjectEmailWelcomeClientAccount=$subjectEmailWelcomeClientAccount;
        $this->subjectEmailResetPasswordClientAccount = $subjectEmailResetPasswordClientAccount;
        $this->subjectEmailContactCommercial = $subjectEmailContactCommercial;
		
		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			SiteExport::$easyload[$idSiteExport] = $this;
		}
	}
	
	/**
	 * Cr�er un(e) siteExport
	 * @param $pdo PDO 
	 * @param $nbAnnoncesParPage int 
	 * @param $txtIndex string 
	 * @param $emailContact string 
	 * @param $nbNouveauteParAgence int 
	 * @param $nomSite string 
	 * @param $titreAccueil string 
	 * @param $metaDescriptionAccueil string 
	 * @param $header string 
	 * @param $logo string 
	 * @param $theme SiteExportTheme 
	 * @param $robots bool 
	 * @param $easyload bool activer le chargement rapide ?
	 * @return SiteExport 
	 */
	public static function create(PDO $pdo,$nbAnnoncesParPage,$txtIndex,$emailContact,$nbNouveauteParAgence,$nomSite,$titreAccueil,$metaDescriptionAccueil,$header,$logo,SiteExportTheme $theme,$robots=false,$nameAgency,$addressAgency,$zipcodeAgency,$cityAgency,$phoneAgency,$faxAgency,$exportWebsiteUrl,$emailWelcomeClientAccount,$emailResetPasswordClientAccount,$subjectEmailWelcomeClientAccount,$subjectEmailResetPasswordClientAccount,$subjectEmailContactCommercial,$easyload=true)
	{
		// Ajouter le/la siteExport dans la base de donn�es
		$pdoStatement = $pdo->prepare('INSERT INTO SiteExport (nbAnnoncesParPage,txtIndex,emailContact,nbNouveauteParAgence,nomSite,titreAccueil,metaDescriptionAccueil,header,logo,theme_idSiteExportTheme,robots,nameagency,addressagency,zipcodeagency,cityagency,phoneagency,faxagency,exportWebsiteUrl,emailWelcomeClientAccount,emailResetPasswordClientAccount,$subjectEmailWelcomeClientAccount,$subjectEmailResetPasswordClientAccount,$subjectEmailContactCommercial
		) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
		if (!$pdoStatement->execute(array($nbAnnoncesParPage,$txtIndex,$emailContact,$nbNouveauteParAgence,$nomSite,$titreAccueil,$metaDescriptionAccueil,$header,$logo,$theme->getIdSiteExportTheme(),$robots,$nameAgency,$addressAgency,$zipcodeAgency,$cityAgency,$phoneAgency,$faxAgency,$exportWebsiteUrl,$emailWelcomeClientAccount,$emailResetPasswordClientAccount,$subjectEmailWelcomeClientAccount,$subjectEmailResetPasswordClientAccount,$subjectEmailContactCommercial))) {			throw new Exception('Erreur durant l\'insertion d\'un(e) siteExport dans la base de donn�es');
		}
		
		// Construire le/la siteExport
		return new SiteExport($pdo,$pdo->lastInsertId(),$nbAnnoncesParPage,$txtIndex,$emailContact,$nbNouveauteParAgence,$nomSite,$titreAccueil,$metaDescriptionAccueil,$header,$logo,$theme->getIdSiteExportTheme(),$robots,$nameAgency,$addressAgency,$zipcodeAgency,$cityAgency,$phoneAgency,$faxAgency,$exportWebsiteUrl,$emailWelcomeClientAccount,$emailResetPasswordClientAccount,$subjectEmailWelcomeClientAccount,$subjectEmailResetPasswordClientAccount,$subjectEmailContactCommercial,$easyload);
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
		return $pdo->prepare('SELECT s.idSiteExport, s.nbAnnoncesParPage, s.txtIndex, s.emailContact, s.nbNouveauteParAgence, s.nomSite, s.titreAccueil, s.metaDescriptionAccueil, s.header, s.logo, s.theme_idSiteExportTheme, s.robots,s.nameagency,s.addressagency,s.zipcodeagency,s.cityagency,s.phoneagency,s.faxagency,s.exportWebsiteUrl,s.emailWelcomeClientAccount,s.emailResetPasswordClientAccount,s.subjectEmailWelcomeClientAccount,s.subjectEmailResetPasswordClientAccount,s.subjectEmailContactCommercial FROM SiteExport s '.
		                     ($where != null ? ' WHERE '.$where : '').
		                     ($orderby != null ? ' ORDERBY '.$orderby : '').
		                     ($limit != null ? ' LIMIT '.$limit : ''));
	}
	
	/**
	 * Charger un(e) siteExport
	 * @param $pdo PDO 
	 * @param $idSiteExport int 
	 * @param $easyload bool activer le chargement rapide ?
	 * @return SiteExport 
	 */
	public static function load(PDO $pdo,$idSiteExport,$easyload=true)
	{
		// D�j� charg�(e) ?
		if (isset(SiteExport::$easyload[$idSiteExport])) {
			return SiteExport::$easyload[$idSiteExport];
		}
		
		// Charger le/la siteExport
		$pdoStatement = SiteExport::_select($pdo,'s.idSiteExport = ?');
		if (!$pdoStatement->execute(array($idSiteExport))) {
			throw new Exception('Erreur lors du chargement d\'un(e) siteExport depuis la base de donn�es');
		}
		
		// R�cup�rer le/la siteExport depuis le jeu de r�sultats
		return SiteExport::fetch($pdo,$pdoStatement,$easyload);
	}
	
	/**
	 * Charger tous/toutes les siteExports
	 * @param $pdo PDO 
	 * @param $easyload bool activer le chargement rapide ?
	 * @return SiteExport[] tableau de siteexports
	 */
	public static function loadAll(PDO $pdo,$easyload=false)
	{
		// S�lectionner tous/toutes les siteExports
		$pdoStatement = SiteExport::selectAll($pdo);
		
		// Mettre chaque siteExport dans un tableau
		$siteExports = array();
		while ($siteExport = SiteExport::fetch($pdo,$pdoStatement,$easyload)) {
			$siteExports[] = $siteExport;
		}
		
		// Retourner le tableau
		return $siteExports;
	}
	
	/**
	 * S�lectionner tous/toutes les siteExports
	 * @param $pdo PDO 
	 * @return PDOStatement 
	 */
	public static function selectAll(PDO $pdo)
	{
		$pdoStatement = SiteExport::_select($pdo);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les siteExports depuis la base de donn�es');
		}
		return $pdoStatement;
	}
	
	/**
	 * R�cup�re le/la siteExport suivant(e) d'un jeu de r�sultats
	 * @param $pdo PDO 
	 * @param $pdoStatement PDOStatement 
	 * @param $easyload bool activer le chargement rapide ?
	 * @return SiteExport 
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idSiteExport,$nbAnnoncesParPage,$txtIndex,$emailContact,$nbNouveauteParAgence,$nomSite,$titreAccueil,$metaDescriptionAccueil,$header,$logo,$theme,$robots,$nameAgency,$addressAgency,$zipcodeAgency,$cityAgency,$phoneAgency,$faxAgency,$exportWebsiteUrl,$emailWelcomeClientAccount,$emailResetPasswordClientAccount,$subjectEmailWelcomeClientAccount,$subjectEmailResetPasswordClientAccount,$subjectEmailContactCommercial) = $values;
		
		// Construire le/la siteExport
		return isset(SiteExport::$easyload[$idSiteExport.'-'.$nbAnnoncesParPage.'-'.$txtIndex.'-'.$emailContact.'-'.$nbNouveauteParAgence.'-'.$nomSite.'-'.$titreAccueil.'-'.$metaDescriptionAccueil.'-'.$header.'-'.$logo.'-'.$theme.'-'.$robots.'-'.$nameAgency.'-'.$addressAgency.'-'.$zipcodeAgency.'-'.$cityAgency.'-'.$phoneAgency.'-'.$faxAgency.'-'.$exportWebsiteUrl.'-'.$emailWelcomeClientAccount.'-'.$emailResetPasswordClientAccount.'-'.$subjectEmailWelcomeClientAccount.'-'.$subjectEmailResetPasswordClientAccount.'-'.$subjectEmailContactCommercial]) ? SiteExport::$easyload[$idSiteExport.'-'.$nbAnnoncesParPage.'-'.$txtIndex.'-'.$emailContact.'-'.$nbNouveauteParAgence.'-'.$nomSite.'-'.$titreAccueil.'-'.$metaDescriptionAccueil.'-'.$header.'-'.$logo.'-'.$theme.'-'.$robots.'-'.$nameAgency.'-'.$addressAgency.'-'.$zipcodeAgency.'-'.$cityAgency.'-'.$phoneAgency.'-'.$faxAgency.'-'.$exportWebsiteUrl.'-'.$emailWelcomeClientAccount.'-'.$emailResetPasswordClientAccount.'-'.$subjectEmailWelcomeClientAccount.'-'.$subjectEmailResetPasswordClientAccount.'-'.$subjectEmailContactCommercial] :
		                                                                                                                                                                                                                                              new SiteExport($pdo,$idSiteExport,$nbAnnoncesParPage,$txtIndex,$emailContact,$nbNouveauteParAgence,$nomSite,$titreAccueil,$metaDescriptionAccueil,$header,$logo,$theme,$robots,$nameAgency,$addressAgency,$zipcodeAgency,$cityAgency,$phoneAgency,$faxAgency,$exportWebsiteUrl,$emailWelcomeClientAccount,$emailResetPasswordClientAccount,$subjectEmailWelcomeClientAccount,$subjectEmailResetPasswordClientAccount,$subjectEmailContactCommercial,$easyload);
	}
	
	/**
	 * Serialiser
	 * @param $serialize bool activer la s�rialisation ?
	 * @return string serialisation du/de la siteexport
	 */
	public function serialize($serialize=true)
	{
		// S�rialiser le/la siteExport
		$array = array('idSiteExport' => $this->idSiteExport,'nbAnnoncesParPage' => $this->nbAnnoncesParPage,'txtIndex' => $this->txtIndex,'emailContact' => $this->emailContact,'nbNouveauteParAgence' => $this->nbNouveauteParAgence,'nomSite' => $this->nomSite,'titreAccueil' => $this->titreAccueil,'metaDescriptionAccueil' => $this->metaDescriptionAccueil,'header' => $this->header,'logo' => $this->logo,'theme' => $this->theme,'robots' => $this->robots,'namegency'=>$this->nameAgency,'addressagency'=>$this->addressAgency,'zipcodeagency'=>$this->zipcodeAgency,'cityagency'=>$this->cityAgency,'phoneagency'=>$this->phoneAgency,'faxagency'=>$this->faxAgency,
            'exportWebsiteUrl'=>$this->exportWebsiteUrl,'emailWelcomeClientAccount'=>$this->emailWelcomeClientAccount,'emailResetPasswordClientAccount'=>$this->emailResetPasswordClientAccount,
        'subjectEmailWelcomeClientAccount'=>$this->subjectEmailWelcomeClientAccount,'subjectEmailResetPasswordClientAccount'=>$this->subjectEmailResetPasswordClientAccount,'subjectEmailContactCommercial'=>$this->subjectEmailContactCommercial
        );
		
		// Retourner la serialisation (ou pas) du/de la siteExport
		return $serialize ? serialize($array) : $array;
	}
	
	/**
	 * D�s�rialiser
	 * @param $pdo PDO 
	 * @param $string string serialisation du/de la siteexport
	 * @param $easyload bool activer le chargement rapide ?
	 * @return SiteExport 
	 */
	public static function unserialize(PDO $pdo,$string,$easyload=true)
	{
		// D�s�rialiser la chaine de caract�res
		$array = unserialize($string);
		
		// Construire le/la siteExport
		return isset(SiteExport::$easyload[$array['idSiteExport']]) ? SiteExport::$easyload[$array['idSiteExport']] :
		                                                              new SiteExport($pdo,$array['idSiteExport'],$array['nbAnnoncesParPage'],$array['txtIndex'],$array['emailContact'],$array['nbNouveauteParAgence'],$array['nomSite'],$array['titreAccueil'],$array['metaDescriptionAccueil'],$array['header'],$array['logo'],$array['theme'],$array['robots'],$array['namegency'],$array['addressagency'],$array['zipcodeagency'],$array['cityagency'],$array['phoneagency'],$array['faxagency'],$array['exportWebsiteUrl'],$array['emailWelcomeClientAccount'],$array['emailResetPasswordClientAccount'],$array['subjectEmailWelcomeClientAccount'],$array['subjectEmailResetPasswordClientAccount'],$array['subjectEmailContactCommercial'],$easyload);	}
	
	/**
	 * Test d'�galit�
	 * @param $siteExport SiteExport 
	 * @return bool les objets sont ils �gaux ?
	 */
	public function equals($siteExport)
	{
		// Test si null
		if ($siteExport == null) { return false; }
		
		// Tester la classe
		if (!($siteExport instanceof SiteExport)) { return false; }
		
		// Tester les ids
		return $this->idSiteExport == $siteExport->idSiteExport;
	}
	
	/**
	 * Compter les siteExports
	 * @param $pdo PDO 
	 * @return int nombre de siteexports
	 */
	public static function count(PDO $pdo)
	{
		if (!($pdoStatement = $pdo->query('SELECT COUNT(idSiteExport) FROM SiteExport'))) {
			throw new Exception('Erreur lors du comptage des siteExports dans la base de donn�es');
		}
		return $pdoStatement->fetchColumn();
	}
	
	/**
	 * Supprimer le/la siteExport
	 * @return bool op�ration r�ussie ?
	 */
	public function delete()
	{
		// Supprimer le/la siteExport
		$pdoStatement = $this->pdo->prepare('DELETE FROM SiteExport WHERE idSiteExport = ?');
		if (!$pdoStatement->execute(array($this->getIdSiteExport()))) {
			throw new Exception('Erreur lors de la supression d\'un(e) siteExport dans la base de donn�es');
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
		$pdoStatement = $this->pdo->prepare('UPDATE SiteExport SET '.implode(', ', $updates).' WHERE idSiteExport = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdSiteExport())))) {
			throw new Exception('Erreur lors de la mise � jour d\'un champ d\'un(e) siteExport dans la base de donn�es');
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

		return $this->_set(array('robots','nbAnnoncesParPage','txtIndex','emailContact','nbNouveauteParAgence','nomSite','titreAccueil','metaDescriptionAccueil','header','logo','theme_idSiteExportTheme','nameagency','addressagency','zipcodeagency','cityagency','phoneagency','faxagency','exportWebsiteUrl','emailWelcomeClientAccount','emailResetPasswordClientAccount','subjectEmailWelcomeClientAccount','subjectEmailResetPasswordClientAccount','subjectEmailContactCommercial'),array($this->robots,$this->nbAnnoncesParPage,$this->txtIndex,$this->emailContact,$this->nbNouveauteParAgence,$this->nomSite,$this->titreAccueil,$this->metaDescriptionAccueil,$this->header,$this->logo,$this->theme,$this->nameAgency,$this->addressAgency,$this->zipcodeAgency,$this->cityAgency,$this->phoneAgency,$this->faxAgency,$this->exportWebsiteUrl,$this->emailWelcomeClientAccount,$this->emailResetPasswordClientAccount,$this->subjectEmailWelcomeClientAccount,$this->subjectEmailResetPasswordClientAccount,$this->subjectEmailContactCommercial));
	}
	
	/**
	 * R�cup�rer le/la idSiteExport
	 * @return int 
	 */
	public function getIdSiteExport()
	{
		return $this->idSiteExport;
	}
	
	/**
	 * R�cup�rer le/la robots
	 * @return bool 
	 */
	public function getRobots()
	{
		return $this->robots;
	}
	
	/**
	 * D�finir le/la robots
	 * @param $robots bool 
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setRobots($robots,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->robots = $robots;
		
		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('robots'),array($robots)) : true;
	}
	
	/**
	 * R�cup�rer le/la nbAnnoncesParPage
	 * @return int 
	 */
	public function getNbAnnoncesParPage()
	{
		return $this->nbAnnoncesParPage;
	}
	
	/**
	 * D�finir le/la nbAnnoncesParPage
	 * @param $nbAnnoncesParPage int 
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setNbAnnoncesParPage($nbAnnoncesParPage,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->nbAnnoncesParPage = $nbAnnoncesParPage;
		
		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('nbAnnoncesParPage'),array($nbAnnoncesParPage)) : true;
	}
	
	/**
	 * R�cup�rer le/la txtIndex
	 * @return string 
	 */
	public function getTxtIndex()
	{
		return $this->txtIndex;
	}
	
	/**
	 * D�finir le/la txtIndex
	 * @param $txtIndex string 
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setTxtIndex($txtIndex,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->txtIndex = $txtIndex;
		
		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('txtIndex'),array($txtIndex)) : true;
	}
	
	/**
	 * R�cup�rer le/la emailContact
	 * @return string 
	 */
	public function getEmailContact()
	{
		return $this->emailContact;
	}
	
	/**
	 * D�finir le/la emailContact
	 * @param $emailContact string 
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setEmailContact($emailContact,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->emailContact = $emailContact;
		
		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('emailContact'),array($emailContact)) : true;
	}
	
	/**
	 * R�cup�rer le/la nbNouveauteParAgence
	 * @return int 
	 */
	public function getNbNouveauteParAgence()
	{
		return $this->nbNouveauteParAgence;
	}
	
	/**
	 * D�finir le/la nbNouveauteParAgence
	 * @param $nbNouveauteParAgence int 
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setNbNouveauteParAgence($nbNouveauteParAgence,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->nbNouveauteParAgence = $nbNouveauteParAgence;
		
		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('nbNouveauteParAgence'),array($nbNouveauteParAgence)) : true;
	}
	
	/**
	 * R�cup�rer le/la nomSite
	 * @return string 
	 */
	public function getNomSite()
	{
		return $this->nomSite;
	}
	
	/**
	 * D�finir le/la nomSite
	 * @param $nomSite string 
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setNomSite($nomSite,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->nomSite = $nomSite;
		
		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('nomSite'),array($nomSite)) : true;
	}
	
	/**
	 * R�cup�rer le/la titreAccueil
	 * @return string 
	 */
	public function getTitreAccueil()
	{
		return $this->titreAccueil;
	}
	
	/**
	 * D�finir le/la titreAccueil
	 * @param $titreAccueil string 
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setTitreAccueil($titreAccueil,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->titreAccueil = $titreAccueil;
		
		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('titreAccueil'),array($titreAccueil)) : true;
	}
	
	/**
	 * R�cup�rer le/la metaDescriptionAccueil
	 * @return string 
	 */
	public function getMetaDescriptionAccueil()
	{
		return $this->metaDescriptionAccueil;
	}
	
	/**
	 * D�finir le/la metaDescriptionAccueil
	 * @param $metaDescriptionAccueil string 
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setMetaDescriptionAccueil($metaDescriptionAccueil,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->metaDescriptionAccueil = $metaDescriptionAccueil;
		
		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('metaDescriptionAccueil'),array($metaDescriptionAccueil)) : true;
	}
	
	/**
	 * R�cup�rer le/la header
	 * @return string 
	 */
	public function getHeader()
	{
		return $this->header;
	}
	
	/**
	 * D�finir le/la header
	 * @param $header string 
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setHeader($header,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->header = $header;
		
		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('header'),array($header)) : true;
	}
	
	/**
	 * R�cup�rer le/la logo
	 * @return string 
	 */
	public function getLogo()
	{
		return $this->logo;
	}
	
	/**
	 * D�finir le/la logo
	 * @param $logo string 
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setLogo($logo,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->logo = $logo;
		
		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('logo'),array($logo)) : true;
	}
	
	/**
	 * R�cup�rer le/la theme
	 * @return SiteExportTheme 
	 */
	public function getTheme()
	{
		return SiteExportTheme::load($this->pdo,$this->theme);
	}
	
	/**
	 * D�finir le/la theme
	 * @param $theme SiteExportTheme 
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setTheme(SiteExportTheme $theme,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->theme = $theme->getIdSiteExportTheme();
		
		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('theme_idSiteExportTheme'),array($theme->getIdSiteExportTheme())) : true;
	}
	//NEW
	/**
	* R�cup�rer le/la nameagency
	* @return bool
	*/
	public function getNameAgency()
	{
		return $this->nameAgency;
	}
	
	/**
	 * D�finir le/la nameagency
	 * @param $nameagency string
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setNameAgency($nameAgency,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->nameAgency = $nameAgency;
	
		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('nameagency'),array($nameAgency)) : true;
	}
	
	/**
	* R�cup�rer le/la addressAgency
	* @return bool
	*/
	public function getAddressAgency()
	{
		return $this->addressAgency;
	}
	
	/**
	 * D�finir le/la addressAgency
	 * @param addressAgency String
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setAddressAgency($addressAgency,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->addressAgency = $addressAgency;
	
		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('addressagency'),array($addressAgency)) : true;
	}
	
	/**
	* R�cup�rer le/la zipCodeAgency
	* @return bool
	*/
	public function getZipCodeAgency()
	{
		return $this->zipcodeAgency;
	}
	
	/**
	 * D�finir le/la zipCodeAgency
	 * @param zipCodeAgency string
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setZipCodeAgency($zipCodeAgency,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->zipcodeAgency = $zipCodeAgency;
	
		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('zipcodeagency'),array($zipCodeAgency)) : true;
	}
	
	/**
	* R�cup�rer le/la cityAgency
	* @return bool
	*/
	public function getCityAgency()
	{
		return $this->cityAgency;
	}
	
	/**
	 * D�finir le/la cityAgency
	 * @param $cityAgency string
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setCityAgency($cityAgency,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->cityAgency = $cityAgency;
	
		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('cityagency'),array($cityAgency)) : true;
	}
	
	/**
	* R�cup�rer le/la phoneAgency
	* @return bool
	*/
	public function getPhoneAgency()
	{
		return $this->phoneAgency;
	}
	
	/**
	 * D�finir le/la phoneAgency
	 * @param $rphoneAgency string
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setPhoneAgency($phoneAgency,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->phoneAgency = $phoneAgency;
	
		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('phoneagency'),array($phoneAgency)) : true;
	}
	
	/**
	* R�cup�rer le/la faxAgency
	* @return bool
	*/
	public function getFaxAgency()
	{
		return $this->faxAgency;
	}
	
	/**
	 * D�finir le/la faxAgency
	 * @param $faxAgency string
	 * @param $execute bool ex�cuter la requ�te update ?
	 * @return bool op�ration r�ussie ?
	 */
	public function setFaxAgency($faxAgency,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->faxAgency = $faxAgency;
	
		// Sauvegarder dans la base de donn�es (ou pas)
		return $execute ? $this->_set(array('faxagency'),array($faxAgency)) : true;
	}








	// FIN NEW

    /**
     * R�cup�rer le/la exportWebsiteUrl
     * @return bool
     */
    public function getExportWebsiteUrl()
    {
        return $this->exportWebsiteUrl;
    }

    /**
     * D�finir le/la exportWebsiteUrl
     * @param $exportWebsiteUrl string
     * @param $execute bool ex�cuter la requ�te update ?
     * @return bool op�ration r�ussie ?
     */
    public function setExportWebsiteUrl($exportWebsiteUrl,$execute=true)
    {
        // Sauvegarder dans l'objet
        $this->exportWebsiteUrl = $exportWebsiteUrl;

        // Sauvegarder dans la base de donn�es (ou pas)
        return $execute ? $this->_set(array('exportWebsiteUrl'),array($exportWebsiteUrl)) : true;
    }

    /**
     * R�cup�rer le/la emailWelcomeClientAccount
     * @return bool
     */
    public function getEmailWelcomeClientAccount()
    {
        return $this->emailWelcomeClientAccount;
    }

    /**
     * D�finir le/la emailWelcomeClientAccount
     * @param $emailWelcomeClientAccount string
     * @param $execute bool ex�cuter la requ�te update ?
     * @return bool op�ration r�ussie ?
     */
    public function setEmailWelcomeClientAccount($emailWelcomeClientAccount,$execute=true)
    {
        // Sauvegarder dans l'objet
        $this->emailWelcomeClientAccount = $emailWelcomeClientAccount;

        // Sauvegarder dans la base de donn�es (ou pas)
        return $execute ? $this->_set(array('emailWelcomeClientAccount'),array($emailWelcomeClientAccount)) : true;
    }

    /**
     * R�cup�rer le/la emailResetPasswordClientAccount
     * @return bool
     */
    public function getEmailResetPasswordClientAccount()
    {
        return $this->emailResetPasswordClientAccount;
    }

    /**
     * D�finir le/la emailResetPasswordClientAccount
     * @param $emailResetPasswordClientAccount string
     * @param $execute bool ex�cuter la requ�te update ?
     * @return bool op�ration r�ussie ?
     */
    public function setEmailResetPasswordClientAccount($emailResetPasswordClientAccount,$execute=true)
    {
        // Sauvegarder dans l'objet
        $this->emailResetPasswordClientAccount = $emailResetPasswordClientAccount;

        // Sauvegarder dans la base de donn�es (ou pas)
        return $execute ? $this->_set(array('emailResetPasswordClientAccount'),array($emailResetPasswordClientAccount)) : true;
    }


    /**
     * R�cup�rer le/la subjectEmailWelcomeClientAccount
     * @return bool
     */
    public function getSubjectEmailWelcomeClientAccount()
    {
        return $this->subjectEmailWelcomeClientAccount;
    }

    /**
     * D�finir le/la subjectEmailWelcomeClientAccount
     * @param $subjectEmailWelcomeClientAccount string
     * @param $execute bool ex�cuter la requ�te update ?
     * @return bool op�ration r�ussie ?
     */
    public function setSubjectEmailWelcomeClientAccount($subjectEmailWelcomeClientAccount,$execute=true)
    {
        // Sauvegarder dans l'objet
        $this->subjectEmailWelcomeClientAccount = $subjectEmailWelcomeClientAccount;

        // Sauvegarder dans la base de donn�es (ou pas)
        return $execute ? $this->_set(array('subjectEmailWelcomeClientAccount'),array($subjectEmailWelcomeClientAccount)) : true;
    }

    /**
     * R�cup�rer le/la subjectEmailResetPasswordClientAccount
     * @return bool
     */
    public function getSubjectEmailResetPasswordClientAccount()
    {
        return $this->subjectEmailResetPasswordClientAccount;
    }

    /**
     * D�finir le/la subjectEmailResetPasswordClientAccount
     * @param $subjectEmailResetPasswordClientAccount string
     * @param $execute bool ex�cuter la requ�te update ?
     * @return bool op�ration r�ussie ?
     */
    public function setSubjectEmailResetPasswordClientAccount($subjectEmailResetPasswordClientAccount,$execute=true)
    {
        // Sauvegarder dans l'objet
        $this->subjectEmailResetPasswordClientAccount = $subjectEmailResetPasswordClientAccount;

        // Sauvegarder dans la base de donn�es (ou pas)
        return $execute ? $this->_set(array('subjectEmailResetPasswordClientAccount'),array($subjectEmailResetPasswordClientAccount)) : true;
    }



    /**
     * R�cup�rer le/la subjectEmailContactCommercial
     * @return bool
     */
    public function getSubjectEmailContactCommercial()
    {
        return $this->subjectEmailContactCommercial;
    }

    /**
     * D�finir le/la subjectEmailContactCommercial
     * @param $subjectEmailContactCommercial string
     * @param $execute bool ex�cuter la requ�te update ?
     * @return bool op�ration r�ussie ?
     */
    public function setSubjectEmailContactCommercial($subjectEmailContactCommercial,$execute=true)
    {
        // Sauvegarder dans l'objet
        $this->subjectEmailContactCommercial = $subjectEmailContactCommercial;

        // Sauvegarder dans la base de donn�es (ou pas)
        return $execute ? $this->_set(array('subjectEmailContactCommercial'),array($subjectEmailContactCommercial)) : true;
    }

	/**
	 * S�lectionner les siteExports par theme
	 * @param $pdo PDO 
	 * @param $theme SiteExportTheme 
	 * @return PDOStatement 
	 */
	public static function selectByTheme(PDO $pdo,SiteExportTheme $theme)
	{
		$pdoStatement = $pdo->prepare('SELECT s.idSiteExport, s.nbAnnoncesParPage, s.txtIndex, s.emailContact, s.nbNouveauteParAgence, s.nomSite, s.titreAccueil, s.metaDescriptionAccueil, s.header, s.logo, s.theme_idSiteExportTheme, s.robots,s.nameagency,s.addressagency,s.zipcodeagency,s.cityagency,s.phoneagency,s.faxagency,s.exportWebsiteUrl,s.emailWelcomeClientAccount,s.emailResetPasswordClientAccount,s.subjectEmailWelcomeClientAccount,s.subjectEmailResetPasswordClientAccount,s.subjectEmailContactCommercial FROM SiteExport s WHERE s.theme_idSiteExportTheme = ?');
		if (!$pdoStatement->execute(array($theme->getIdSiteExportTheme()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les siteExports par theme depuis la base de donn�es');
		}
		return $pdoStatement;
	}
	/**
	 * ToString
	 * @return string repr�sentation de siteexport sous la forme d'un string
	 */
	public function __toString()
	{
		return '[SiteExport idSiteExport="'.$this->idSiteExport.'" robots="'.($this->robots?'true':'false').'" nbAnnoncesParPage="'.$this->nbAnnoncesParPage.'" txtIndex="'.$this->txtIndex.'" emailContact="'.$this->emailContact.'" nbNouveauteParAgence="'.$this->nbNouveauteParAgence.'" nomSite="'.$this->nomSite.'" titreAccueil="'.$this->titreAccueil.'" metaDescriptionAccueil="'.$this->metaDescriptionAccueil.'" header="'.$this->header.'" logo="'.$this->logo.'" theme="'.$this->theme.'"]';
	}
	
}

?>
