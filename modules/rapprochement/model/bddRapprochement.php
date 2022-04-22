<?php

/**
 * @class BddRapprochement
 * @date 30/03/2011 (dd/mm/yyyy)
 * @generator WebProjectHelper (http://www.elfangels.fr/webprojecthelper/)
 */
class BddRapprochement
{
	/// @var PDO
	private $pdo;

	/// @var array tableau pour le chargement rapide
	private static $easyload;

	/// @var int
	private $idRapprochement;

	/// @var int
	private $dateRapprochement;

	/// @var int
	private $compteRenduLe;

	/// @var int
	private $dateVisite;

	/// @var string
	private $resultat;

	/// @var string
	private $pointsPositifs;

	/// @var string
	private $pointsNegatifs;

	/// @var bool
	private $resultatVisite;

	/// @var bool
	private $actif;

	/// @var int id de user
	private $user;

	/// @var int id de acquereur
	private $acquereur;

	/// @var int id de mandate
	private $mandate;

	/// @var bool compromis
	private $compromis;

	/**
	 * Construire un(e) rapprochement
	 * @param $pdo PDO
	 * @param $idRapprochement int
	 * @param $dateRapprochement int
	 * @param $resultat string
	 * @param $pointsPositifs string
	 * @param $pointsNegatifs string
	 * @param $user int id de user
	 * @param $acquereur int id de acquereur
	 * @param $mandate int id de mandate
	 * @param $compteRenduLe int
	 * @param $dateVisite int
	 * @param $resultatVisite bool
	 * @param $actif bool
	 * @param $compromis bool
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Rapprochement
	 */
	protected function __construct(PDO $pdo,$idRapprochement,$dateRapprochement,$resultat,$pointsPositifs,$pointsNegatifs,$user,$acquereur,$mandate,$compteRenduLe=null,$dateVisite=null,$resultatVisite=false,$actif=false,$compromis = false,$easyload=false)
	{
		// Sauvegarder pdo
		$this->pdo = $pdo;

		// Sauvegarder les attributs
		$this->idRapprochement = $idRapprochement;
		$this->dateRapprochement = $dateRapprochement;
		$this->resultat = $resultat;
		$this->pointsPositifs = $pointsPositifs;
		$this->pointsNegatifs = $pointsNegatifs;
		$this->user = $user;
		$this->acquereur = $acquereur;
		$this->mandate = $mandate;
		$this->compteRenduLe = $compteRenduLe;
		$this->dateVisite = $dateVisite;
		$this->resultatVisite = $resultatVisite;
		$this->actif = $actif;
		$this->compromis = $compromis;

		// Sauvegarder pour le chargement rapide
		if ($easyload) {
			BddRapprochement::$easyload[$idRapprochement] = $this;
		}
	}

	/**
	 * Créer un(e) rapprochement
	 * @param $pdo PDO
	 * @param $dateRapprochement int
	 * @param $resultat string
	 * @param $pointsPositifs string
	 * @param $pointsNegatifs string
	 * @param $user User
	 * @param $acquereur Acquereur
	 * @param $mandate Mandate
	 * @param $compteRenduLe int
	 * @param $dateVisite int
	 * @param $resultatVisite bool
	 * @param $actif bool
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Rapprochement
	 */
	public static function create(PDO $pdo,$dateRapprochement,$resultat,$pointsPositifs,$pointsNegatifs,$resultatVisite,User $user,Acquereur $acquereur,Mandate $mandate,$compteRenduLe=null,$dateVisite=null,$actif=false,$compromis = false,$easyload=true)
	{
		// Ajouter le/la rapprochement dans la base de données
		$pdoStatement = $pdo->prepare('INSERT INTO Rapprochement (dateRapprochement,resultat,pointsPositifs,pointsNegatifs,user_idUser,acquereur_idAcquereur,mandate_idMandate,compteRenduLe,dateVisite,resultatVisite,actif,compromis) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)');
		if (!$pdoStatement->execute(array(date('Y-m-d H:i:s',$dateRapprochement),$resultat,$pointsPositifs,$pointsNegatifs,$user->getIdUser(),$acquereur->getIdAcquereur(),$mandate->getIdMandate(),$compteRenduLe === null ? null : date('Y-m-d H:i:s',$compteRenduLe),$dateVisite === null ? null : date('Y-m-d H:i:s',$dateVisite),$resultatVisite,$actif,$compromis))) {
			throw new Exception('Erreur durant l\'insertion d\'un(e) rapprochement dans la base de données');
		}

		// Construire le/la rapprochement
		return new BddRapprochement($pdo,$pdo->lastInsertId(),$dateRapprochement,$resultat,$pointsPositifs,$pointsNegatifs,$user->getIdUser(),$acquereur->getIdAcquereur(),$mandate->getIdMandate(),$compteRenduLe,$dateVisite,$resultatVisite,$actif,$compromis,$easyload);
	}

	/**
	 * Requête de séléction
	 * @param $pdo PDO
	 * @param $where string
	 * @param $orderby string
	 * @param $limit string
	 * @return PDOStatement
	 */
	private static function _select(PDO $pdo,$where=null,$orderby=null,$limit=null)
	{
		return $pdo->prepare('SELECT r.idRapprochement, r.dateRapprochement, r.resultat, r.pointsPositifs, r.pointsNegatifs, r.user_idUser, r.acquereur_idAcquereur, r.mandate_idMandate, r.compteRenduLe, r.dateVisite, r.resultatVisite, r.actif,r.compromis FROM Rapprochement r '.
		($where != null ? ' WHERE '.$where : '').
		($orderby != null ? ' ORDER BY '.$orderby : '').
		($limit != null ? ' LIMIT '.$limit : ''));
	}

	/**
	 * Charger un(e) rapprochement
	 * @param $pdo PDO
	 * @param $idRapprochement int
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Rapprochement
	 */
	public static function load(PDO $pdo,$idRapprochement,$easyload=true)
	{
		// Déjà chargé(e) ?
		if (isset(BddRapprochement::$easyload[$idRapprochement])) {
			return BddRapprochement::$easyload[$idRapprochement];
		}

		// Charger le/la rapprochement
		$pdoStatement = BddRapprochement::_select($pdo,'r.idRapprochement = ?');
		if (!$pdoStatement->execute(array($idRapprochement))) {
			throw new Exception('Erreur lors du chargement d\'un(e) rapprochement depuis la base de données');
		}

		// Récupérer le/la rapprochement depuis le jeu de résultats
		return BddRapprochement::fetch($pdo,$pdoStatement,$easyload);
	}

	/**
	 * Charger tous/toutes les rapprochements
	 * @param $pdo PDO
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Rapprochement[] tableau de rapprochements
	 */
	public static function loadAll(PDO $pdo,$easyload=false)
	{
		// Sélectionner tous/toutes les rapprochements
		$pdoStatement = BddRapprochement::selectAll($pdo);

		// Mettre chaque rapprochement dans un tableau
		$rapprochements = array();
		while ($rapprochement = BddRapprochement::fetch($pdo,$pdoStatement,$easyload)) {
			$rapprochements[] = $rapprochement;
		}

		// Retourner le tableau
		return $rapprochements;
	}

	/**
	 * Charger tous/toutes les rapprochements
	 * @param $pdo PDO
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Rapprochement[] tableau de rapprochements
	 */
	public static function loadAllActif(PDO $pdo,$easyload=false)
	{
		// Sélectionner tous/toutes les rapprochements
		$pdoStatement = BddRapprochement::_select($pdo,'r.actif=1');
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les rapprochements depuis la base de données');
		}
		// Mettre chaque rapprochement dans un tableau
		$rapprochements = array();
		while ($rapprochement = BddRapprochement::fetch($pdo,$pdoStatement,$easyload)) {
			$rapprochements[] = $rapprochement;
		}

		// Retourner le tableau
		return $rapprochements;
	}
	/**
	 * Sélectionner tous/toutes les rapprochements
	 * @param $pdo PDO
	 * @return PDOStatement
	 */
	public static function selectAll(PDO $pdo)
	{
		$pdoStatement = BddRapprochement::_select($pdo);
		if (!$pdoStatement->execute()) {
			throw new Exception('Erreur lors du chargement de tous/toutes les rapprochements depuis la base de données');
		}
		return $pdoStatement;
	}

	/**
	 * Récupère le/la rapprochement suivant(e) d'un jeu de résultats
	 * @param $pdo PDO
	 * @param $pdoStatement PDOStatement
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Rapprochement
	 */
	public static function fetch(PDO $pdo,PDOStatement $pdoStatement,$easyload=false)
	{
		// Extraire les valeurs
		$values = $pdoStatement->fetch();
		if (!$values) { return null; }
		list($idRapprochement,$dateRapprochement,$resultat,$pointsPositifs,$pointsNegatifs,$user,$acquereur,$mandate,$compteRenduLe,$dateVisite,$resultatVisite,$actif) = $values;

		// Construire le/la rapprochement
		return isset(BddRapprochement::$easyload[$idRapprochement.'-'.strtotime($dateRapprochement).'-'.$resultat.'-'.$pointsPositifs.'-'.$pointsNegatifs.'-'.$user.'-'.$acquereur.'-'.$mandate.'-'.strtotime($compteRenduLe).'-'.strtotime($dateVisite).'-'.$resultatVisite.'-'.$actif]) ? BddRapprochement::$easyload[$idRapprochement.'-'.strtotime($dateRapprochement).'-'.$resultat.'-'.$pointsPositifs.'-'.$pointsNegatifs.'-'.$user.'-'.$acquereur.'-'.$mandate.'-'.strtotime($compteRenduLe).'-'.strtotime($dateVisite).'-'.$resultatVisite.'-'.$actif] :
		new BddRapprochement($pdo,$idRapprochement,strtotime($dateRapprochement),$resultat,$pointsPositifs,$pointsNegatifs,$user,$acquereur,$mandate,strtotime($compteRenduLe),strtotime($dateVisite),$resultatVisite,$actif,$easyload);
	}

	/**
	 * Serialiser
	 * @param $serialize bool activer la sérialisation ?
	 * @return string serialisation du/de la rapprochement
	 */
	public function serialize($serialize=true)
	{
		// Sérialiser le/la rapprochement
		$array = array('idRapprochement' => $this->idRapprochement,'dateRapprochement' => $this->dateRapprochement,'resultat' => $this->resultat,'pointsPositifs' => $this->pointsPositifs,'pointsNegatifs' => $this->pointsNegatifs,'user' => $this->user,'acquereur' => $this->acquereur,'mandate' => $this->mandate,'compteRenduLe' => $this->compteRenduLe,'dateVisite' => $this->dateVisite,'resultatVisite' => $this->resultatVisite,'actif' => $this->actif);

		// Retourner la serialisation (ou pas) du/de la rapprochement
		return $serialize ? serialize($array) : $array;
	}

	/**
	 * Désérialiser
	 * @param $pdo PDO
	 * @param $string string serialisation du/de la rapprochement
	 * @param $easyload bool activer le chargement rapide ?
	 * @return Rapprochement
	 */
	public static function unserialize(PDO $pdo,$string,$easyload=true)
	{
		// Désérialiser la chaine de caractères
		$array = unserialize($string);

		// Construire le/la rapprochement
		return isset(BddRapprochement::$easyload[$array['idRapprochement']]) ? BddRapprochement::$easyload[$array['idRapprochement']] :
		new BddRapprochement($pdo,$array['idRapprochement'],$array['dateRapprochement'],$array['resultat'],$array['pointsPositifs'],$array['pointsNegatifs'],$array['user'],$array['acquereur'],$array['mandate'],$array['compteRenduLe'],$array['dateVisite'],$array['resultatVisite'],$array['actif'],$array['compromis'],$easyload);
	}

	/**
	 * Test d'égalité
	 * @param $rapprochement Rapprochement
	 * @return bool les objets sont ils égaux ?
	 */
	public function equals($rapprochement)
	{
		// Test si null
		if ($rapprochement == null) { return false; }

		// Tester la classe
		if (!($rapprochement instanceof Rapprochement)) { return false; }

		// Tester les ids
		return $this->idRapprochement == $rapprochement->idRapprochement;
	}

	/**
	 * Compter les rapprochements
	 * @param $pdo PDO
	 * @return int nombre de rapprochements
	 */
	public static function count(PDO $pdo)
	{
		if (!($pdoStatement = $pdo->query('SELECT COUNT(idRapprochement) FROM Rapprochement'))) {
			throw new Exception('Erreur lors du comptage des rapprochements dans la base de données');
		}
		return $pdoStatement->fetchColumn();
	}

	/**
	 * Supprimer le/la rapprochement
	 * @return bool opération réussie ?
	 */
	public function delete()
	{
		// Supprimer le/la rapprochement
		$pdoStatement = $this->pdo->prepare('DELETE FROM Rapprochement WHERE idRapprochement = ?');
		//	var_dump($pdoStatement);
		if (!$pdoStatement->execute(array($this->getIdRapprochement()))) {

			throw new Exception('Erreur lors de la supression d\'un(e) rapprochement dans la base de données');
		}

		// Opération réussie ?
		return $pdoStatement->rowCount() == 1;
	}

	/**
	 * Mettre à jour un champ dans la base de données
	 * @param $fields array
	 * @param $values array
	 * @return bool opération réussie ?
	 */
	private function _set($fields,$values)
	{
		// Préparer la mise à jour
		$updates = array();
		foreach ($fields as $field) {
			$updates[] = $field.' = ?';
		}

		// Mettre à jour le champ
		$pdoStatement = $this->pdo->prepare('UPDATE Rapprochement SET '.implode(', ', $updates).' WHERE idRapprochement = ?');
		if (!$pdoStatement->execute(array_merge($values,array($this->getIdRapprochement())))) {
			throw new Exception('Erreur lors de la mise à jour d\'un champ d\'un(e) rapprochement dans la base de données');
		}

		// Opération réussie ?
		return $pdoStatement->rowCount() == 1;
	}

	/**
	 * Mettre à jour tous les champs dans la base de données
	 * @return bool opération réussie ?
	 */
	public function update()
	{
		return $this->_set(array('dateRapprochement','compteRenduLe','dateVisite','resultat','pointsPositifs','pointsNegatifs','resultatVisite','actif','user_idUser','acquereur_idAcquereur','mandate_idMandate','compromis'),array(date('Y-m-d H:i:s',$this->dateRapprochement),$this->compteRenduLe === null ? null : date('Y-m-d H:i:s',$this->compteRenduLe),$this->dateVisite === null ? null : date('Y-m-d H:i:s',$this->dateVisite),$this->resultat,$this->pointsPositifs,$this->pointsNegatifs,$this->resultatVisite,$this->actif,$this->user,$this->acquereur,$this->mandate,$this->compromis));
	}

	/**
	 * Récupérer le/la idRapprochement
	 * @return int
	 */
	public function getIdRapprochement()
	{
		return $this->idRapprochement;
	}
	public function getId()
	{
		return $this->idRapprochement;
	}
	/**
	 * Récupérer le/la dateRapprochement
	 * @return int
	 */
	public function getDateRapprochement()
	{
		return $this->dateRapprochement;
	}

	/**
	 * Définir le/la dateRapprochement
	 * @param $dateRapprochement int
	 * @param $execute bool exécuter la requête update ?
	 * @return bool opération réussie ?
	 */
	public function setDateRapprochement($dateRapprochement,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->dateRapprochement = $dateRapprochement;

		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array('dateRapprochement'),array(date('Y-m-d H:i:s',$dateRapprochement))) : true;
	}

	/**
	 * Récupérer le/la compteRenduLe
	 * @return int
	 */
	public function getCompteRenduLe()
	{
		return $this->compteRenduLe;
	}

	/**
	 * Définir le/la compteRenduLe
	 * @param $compteRenduLe int
	 * @param $execute bool exécuter la requête update ?
	 * @return bool opération réussie ?
	 */
	public function setCompteRenduLe($compteRenduLe=null,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->compteRenduLe = $compteRenduLe;

		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array('compteRenduLe'),array($compteRenduLe === null ? null : date('Y-m-d H:i:s',$compteRenduLe))) : true;
	}




	/**
	 * Récupérer le/la comprmis
	 * @return int
	 */
	public function getCompromis()
	{
		return $this->compromis;
	}

	/**
	 * Définir le/la comprmis
	 * @param $comprmis int
	 * @param $execute bool exécuter la requête update ?
	 * @return bool opération réussie ?
	 */
	public function setCompromis($compromis,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->compromis = $compromis;

		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array('compromis'),array( $compromis )) : true;
	}






	/**
	 * Récupérer le/la dateVisite
	 * @return int
	 */
	public function getDateVisite()
	{
		return $this->dateVisite;
	}

	/**
	 * Définir le/la dateVisite
	 * @param $dateVisite int
	 * @param $execute bool exécuter la requête update ?
	 * @return bool opération réussie ?
	 */
	public function setDateVisite($dateVisite=null,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->dateVisite = $dateVisite;

		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array('dateVisite'),array($dateVisite === null ? null : date('Y-m-d H:i:s',$dateVisite))) : true;
	}

	/**
	 * Récupérer le/la resultat
	 * @return string
	 */
	public function getResultat()
	{
		return $this->resultat;
	}

	/**
	 * Définir le/la resultat
	 * @param $resultat string
	 * @param $execute bool exécuter la requête update ?
	 * @return bool opération réussie ?
	 */
	public function setResultat($resultat,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->resultat = $resultat;

		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array('resultat'),array($resultat)) : true;
	}

	/**
	 * Récupérer le/la pointsPositifs
	 * @return string
	 */
	public function getPointsPositifs()
	{
		return $this->pointsPositifs;
	}

	/**
	 * Définir le/la pointsPositifs
	 * @param $pointsPositifs string
	 * @param $execute bool exécuter la requête update ?
	 * @return bool opération réussie ?
	 */
	public function setPointsPositifs($pointsPositifs,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->pointsPositifs = $pointsPositifs;

		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array('pointsPositifs'),array($pointsPositifs)) : true;
	}

	/**
	 * Récupérer le/la pointsNegatifs
	 * @return string
	 */
	public function getPointsNegatifs()
	{
		return $this->pointsNegatifs;
	}

	/**
	 * Définir le/la pointsNegatifs
	 * @param $pointsNegatifs string
	 * @param $execute bool exécuter la requête update ?
	 * @return bool opération réussie ?
	 */
	public function setPointsNegatifs($pointsNegatifs,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->pointsNegatifs = $pointsNegatifs;

		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array('pointsNegatifs'),array($pointsNegatifs)) : true;
	}

	/**
	 * Récupérer le/la resultatVisite
	 * @return bool
	 */
	public function getResultatVisite()
	{
		return $this->resultatVisite;
	}

	/**
	 * Définir le/la resultatVisite
	 * @param $resultatVisite bool
	 * @param $execute bool exécuter la requête update ?
	 * @return bool opération réussie ?
	 */
	public function setResultatVisite($resultatVisite=null,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->resultatVisite = $resultatVisite;

		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array('resultatVisite'),array($resultatVisite)) : true;
	}

	/**
	 * Récupérer le/la actif
	 * @return bool
	 */
	public function getActif()
	{
		return $this->actif;
	}

	/**
	 * Définir le/la actif
	 * @param $actif bool
	 * @param $execute bool exécuter la requête update ?
	 * @return bool opération réussie ?
	 */
	public function setActif($actif,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->actif = $actif;

		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array('actif'),array($actif)) : true;
	}

	/**
	 * Récupérer le/la user
	 * @return User
	 */
	public function getUser()
	{
		return User::load($this->pdo,$this->user);
	}

	/**
	 * Définir le/la user
	 * @param $user User
	 * @param $execute bool exécuter la requête update ?
	 * @return bool opération réussie ?
	 */
	public function setUser(User $user,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->user = $user->getIdUser();

		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array('user_idUser'),array($user->getIdUser())) : true;
	}

	/**
	 * Sélectionner les rapprochements par user
	 * @param $pdo PDO
	 * @param $user User
	 * @return PDOStatement
	 */
	public static function selectByUser(PDO $pdo,User $user)
	{
		$pdoStatement = $pdo->prepare('SELECT r.idRapprochement, r.dateRapprochement, r.resultat, r.pointsPositifs, r.pointsNegatifs, r.user_idUser, r.acquereur_idAcquereur, r.mandate_idMandate, r.compteRenduLe, r.dateVisite, r.resultatVisite, r.actif,r.compromis FROM Rapprochement r WHERE r.user_idUser = ?');
		if (!$pdoStatement->execute(array($user->getIdUser()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les rapprochements par user depuis la base de données');
		}
		return $pdoStatement;
	}

	/**
	 * Récupérer le/la acquereur
	 * @return Acquereur
	 */
	public function getAcquereur()
	{
		return Acquereur::load($this->pdo,$this->acquereur);
	}

	/**
	 * Définir le/la acquereur
	 * @param $acquereur Acquereur
	 * @param $execute bool exécuter la requête update ?
	 * @return bool opération réussie ?
	 */
	public function setAcquereur(Acquereur $acquereur,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->acquereur = $acquereur->getIdAcquereur();

		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array('acquereur_idAcquereur'),array($acquereur->getIdAcquereur())) : true;
	}

	/**
	 * Sélectionner les rapprochements par acquereur
	 * @param $pdo PDO
	 * @param $acquereur Acquereur
	 * @return PDOStatement
	 */
	public static function selectByAcquereur(PDO $pdo,Acquereur $acquereur)
	{
		$pdoStatement = $pdo->prepare('SELECT r.idRapprochement, r.dateRapprochement, r.resultat, r.pointsPositifs, r.pointsNegatifs, r.user_idUser, r.acquereur_idAcquereur, r.mandate_idMandate, r.compteRenduLe, r.dateVisite, r.resultatVisite, r.actif,r.compromis FROM Rapprochement r WHERE r.acquereur_idAcquereur = ?');
		if (!$pdoStatement->execute(array($acquereur->getIdAcquereur()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les rapprochements par acquereur depuis la base de données');
		}
		return $pdoStatement;
	}

	/**
	 * Récupérer le/la mandate
	 * @return Mandate
	 */
	public function getMandate()
	{
		return Mandate::load($this->pdo,$this->mandate);
	}

	/**
	 * Définir le/la mandate
	 * @param $mandate Mandate
	 * @param $execute bool exécuter la requête update ?
	 * @return bool opération réussie ?
	 */
	public function setMandate(Mandate $mandate,$execute=true)
	{
		// Sauvegarder dans l'objet
		$this->mandate = $mandate->getIdMandate();

		// Sauvegarder dans la base de données (ou pas)
		return $execute ? $this->_set(array('mandate_idMandate'),array($mandate->getIdMandate())) : true;
	}

	/**
	 * Sélectionner les rapprochements par mandate
	 * @param $pdo PDO
	 * @param $mandate Mandate
	 * @return PDOStatement
	 */
	public static function selectByMandate(PDO $pdo,Mandate $mandate)
	{
		$pdoStatement = $pdo->prepare('SELECT r.idRapprochement, r.dateRapprochement, r.resultat, r.pointsPositifs, r.pointsNegatifs, r.user_idUser, r.acquereur_idAcquereur, r.mandate_idMandate, r.compteRenduLe, r.dateVisite, r.resultatVisite, r.actif,r.compromis FROM Rapprochement r WHERE r.mandate_idMandate = ?');
		if (!$pdoStatement->execute(array($mandate->getIdMandate()))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les rapprochements par mandate depuis la base de données');
		}
		return $pdoStatement;
	}
	/**
	 * ToString
	 * @return string représentation de rapprochement sous la forme d'un string
	 */
	public function __toString()
	{
		return '[Rapprochement idRapprochement="'.$this->idRapprochement.'" dateRapprochement="'.date('d/m/Y H:i:s',$this->dateRapprochement).'" compteRenduLe="'.date('d/m/Y H:i:s',$this->compteRenduLe).'" dateVisite="'.date('d/m/Y H:i:s',$this->dateVisite).'" resultat="'.$this->resultat.'" pointsPositifs="'.$this->pointsPositifs.'" pointsNegatifs="'.$this->pointsNegatifs.'" resultatVisite="'.($this->resultatVisite?'true':'false').'" actif="'.($this->actif?'true':'false').'" user="'.$this->user.'" acquereur="'.$this->acquereur.'" mandate="'.$this->mandate.'"]';
	}
	/**
	 * Additional method
	 */

	/**
	 *
	 * @param PDO $pdo
	 * @param Mandate $mandate
	 * @param Acquereur $acqeureur
	 * @return Bool True si la relation existe
	 */
	public static function relMandateAcquereurExist(PDO $pdo,Mandate $mandate,Acquereur $acqeureur){
		$pdoStatement = $pdo->prepare('SELECT COUNT(r.idRapprochement) FROM Rapprochement r WHERE r.mandate_idMandate = ? AND r.acquereur_idAcquereur = ?');
		if (!$pdoStatement->execute(array($mandate->getIdMandate(),$acqeureur->getIdAcquereur() ))) {
			throw new Exception('Erreur dans la requete');
		}
		return $pdoStatement->fetchColumn()==0?false:true;
	}
	/**
	 *
	 * @param PDO $pdo
	 * @param Mandate $mandate
	 * @param Acquereur $acquereur
	 * @return BddRapprochement
	 */
	public static function loadByMandateAndAcquereur(PDO $pdo,Mandate $mandate,Acquereur $acquereur){
		// Déjà chargé(e) ?
		if (isset(BddRapprochement::$easyload[$idRapprochement])) {
			return BddRapprochement::$easyload[$idRapprochement];
		}

		// Charger le/la rapprochement
		$pdoStatement = BddRapprochement::_select($pdo,'r.mandate_idMandate = ? AND r.acquereur_idAcquereur = ?');
		if (!$pdoStatement->execute(array($mandate->getIdMandate(),$acquereur->getIdAcquereur()))) {
			throw new Exception('Erreur lors du chargement d\'un(e) rapprochement depuis la base de données');
		}

		// Récupérer le/la rapprochement depuis le jeu de résultats
		return BddRapprochement::fetch($pdo,$pdoStatement,$easyload);
	}


	public static function loadByMandateR(PDO $pdo,Mandate $mandate){
		// Déjà chargé(e) ?
		if (isset(BddRapprochement::$easyload[$idRapprochement])) {
			return BddRapprochement::$easyload[$idRapprochement];
		}

		// Charger le/la rapprochement
		$pdoStatement = BddRapprochement::_select($pdo,'r.mandate_idMandate = ? AND r.compromis = 1');
		if (!$pdoStatement->execute(array($mandate->getIdMandate() ))) {
			throw new Exception('Erreur lors du chargement d\'un(e) rapprochement depuis la base de données');
		}

		// Récupérer le/la rapprochement depuis le jeu de résultats
		return BddRapprochement::fetch($pdo,$pdoStatement,$easyload);
	}

	public static function loadByMandate(PDO $pdo,Mandate $mandate){


		// Charger le/la rapprochement
		$pdoStatement = BddRapprochement::_select($pdo,'r.mandate_idMandate = ?');
		if (!$pdoStatement->execute(array($mandate->getIdMandate() ))) {
			throw new Exception('Erreur lors du chargement d\'un(e) rapprochement depuis la base de données');
		}
		$list = array();
		// Récupérer le/la rapprochement depuis le jeu de résultats
		while ($tmp = BddRapprochement::fetch($pdo,$pdoStatement,$easyload)) {
			$list[]=$tmp;
		}
		return $list;
	}
	public static function loadByAcquereur(PDO $pdo,Acquereur $acquereur){
	
	
		// Charger le/la rapprochement
		$pdoStatement = BddRapprochement::_select($pdo,'r.acquereur_idAcquereur = ?');
		if (!$pdoStatement->execute(array($acquereur->getIdAcquereur() ))) {
			throw new Exception('Erreur lors du chargement d\'un(e) rapprochement depuis la base de données');
		}
		$list = array();
		// Récupérer le/la rapprochement depuis le jeu de résultats
		while ($tmp = BddRapprochement::fetch($pdo,$pdoStatement,$easyload)) {
			$list[]=$tmp;
		}
		return $list;
	}
	
	public static function rapprochementVisiteAfairePrevueAvant( PDO $pdo,Acquereur $acquereur,$date = 'date'){
		if($date =='date') $date = date('Y-m-d 00:00:00');
		
		$sql = "SELECT COUNT(r.idRapprochement) FROM Rapprochement r WHERE r.acquereur_idAcquereur = ? AND r.dateVisite >= '$date' AND r.resultatVisite = 0";
		$pdoStatement =  $pdo->prepare($sql);
		if (!$pdoStatement->execute(array($acquereur->getIdAcquereur() ))) {
			throw new Exception('Erreur lors du chargement d\'un(e) rapprochement depuis la base de données');
		}
		$r =  $pdoStatement->fetch();
		return (Int)$r[0]!=0?true:false;
	}
	public static function countVisiteByMandate( PDO $pdo,Mandate $mandate){
		$sql = 'SELECT COUNT(r.idRapprochement) FROM Rapprochement r WHERE r.mandate_idMandate = ? AND r.resultatVisite!=0 ';
		$pdoStatement =  $pdo->prepare($sql);
		if (!$pdoStatement->execute(array($mandate->getIdMandate() ))) {
			throw new Exception('Erreur lors du chargement d\'un(e) rapprochement depuis la base de données');
		}
		$r =  $pdoStatement->fetch();
		return (Int)$r[0];
	}

	public static function resteAVisiteByMandate( PDO $pdo,Mandate $mandate){
		$sql = 'SELECT COUNT(r.idRapprochement) FROM Rapprochement r WHERE r.mandate_idMandate = ? AND r.resultatVisite=0 AND r.dateVisite IS NOT null';
		$pdoStatement =  $pdo->prepare($sql);
		if (!$pdoStatement->execute(array($mandate->getIdMandate() ))) {
			throw new Exception('Erreur lors du chargement d\'un(e) rapprochement depuis la base de données');
		}
		$r =  $pdoStatement->fetch();
		return (Int)$r[0];
	}

	/**
	 * 
	 * Retourne le nombre de rapprochement pour un acquereur
	 * @param PDO $pdo
	 * @param Acquereur $acquereur
	 * @return INT
	 */
	public static function countByAcquereur(PDO $pdo,Acquereur $acquereur){
		$sql = 'SELECT COUNT(r.idRapprochement) FROM Rapprochement r WHERE r.acquereur_idAcquereur = ?';
		$pdoStatement =  $pdo->prepare($sql);
		if (!$pdoStatement->execute(array($acquereur->getIdAcquereur() ))) {
			throw new Exception('Erreur lors du chargement d\'un(e) rapprochement depuis la base de données');
		}
		$r =  $pdoStatement->fetch();
		return (Int)$r[0];
	}
}
