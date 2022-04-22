<?php
require_once '../../const/config.php';

require_once '../../modules/user/model/requires.php';

require_once '../../modules/sector/model/requires.php';


require_once '../../modules/transaction_type/model/requires.php';

require_once '../../modules/mandate_type/model/requires.php';

require_once '../../modules/mandate_features/model/requires.php';


require_once 'php/acquereur.php';
require_once 'php/titreacquereur.php';


$pdo =  new PDO('mysql:dbname='.Constant::DATABASE_NAME.';host='.Constant::DATABASE_SERVER.';',Constant::DATABASE_USER,Constant::DATABASE_PASSWORD);

//TitreAcquereur::create($pdo,'Monsieur');

$titreAcquereur = TitreAcquereur::load($pdo,1);

$villeAcquereur = City::load($pdo,1);
$villeRecherche = City::load($pdo,3);

$typeTransaction = TransactionType::load($pdo,2);

$user = User::load($pdo,1);

$style = MandateStyle::load($pdo,1);
//$style = null;




//Acquereur::create($pdo,'acheteurN','prenom','12 rue de la vente','0102030405','0102030405','0102030405','0102030405','acheteur@mail.fr',0,10,100000000,1000,10000,65,120,$villeAcquereur,$titreAcquereur,$typeTransaction,$user,$style,1,$villeRecherche,null);

//var_dump( $typeTransaction );


$aq = Acquereur::load($pdo,3);

var_dump( $aq );