<?php
class VerifMandateForUser extends Mandate{

	public static function countMandate (PDO $pdo, User $user ){
		$sql = '
			SELECT COUNT(m.user_idUser) 
			FROM  Mandate m
			WHERE m.user_idUser = ?';
		$pdoStatement =  $pdo->prepare($sql);
		if (!$pdoStatement->execute(array($user->getId() ))) {
			//throw new Exception('');
			var_dump($pdoStatement->errorInfo() );
		}
		$r =  $pdoStatement->fetch();
		return (Int)$r[0];
	}
}

class VerifAcqForUser extends Acquereur{

	public static function countAcq (PDO $pdo, User $user ){
		$sql = '
			SELECT COUNT(a.user_idUser) 
			FROM  Acquereur a
			WHERE a.user_idUser = ?';
		$pdoStatement =  $pdo->prepare($sql);
		if (!$pdoStatement->execute(array($user->getId() ))) {
			//throw new Exception('');
			var_dump($pdoStatement->errorInfo() );
		}
		$r =  $pdoStatement->fetch();
		return (Int)$r[0];
	}
}
class VerifSellerForUser extends Seller{

	public static function countSeller (PDO $pdo, User $user ){
		$sql = '
			SELECT COUNT(s.user_idUser) 
			FROM  Seller s
			WHERE s.user_idUser = ?';
		$pdoStatement =  $pdo->prepare($sql);
		if (!$pdoStatement->execute(array($user->getId() ))) {
			//throw new Exception('');
			var_dump($pdoStatement->errorInfo() );
		}
		$r =  $pdoStatement->fetch();
		return (Int)$r[0];
	}
}

class VerifRappForUser extends BddRapprochement{
	public static function countRapp (PDO $pdo, User $user ){
		$sql = '
			SELECT COUNT(r.user_idUser) 
			FROM  Rapprochement r
			WHERE r.user_idUser = ?';
		$pdoStatement =  $pdo->prepare($sql);
		if (!$pdoStatement->execute(array($user->getId() ))) {
			//throw new Exception('');
			var_dump($pdoStatement->errorInfo() );
		}
		$r =  $pdoStatement->fetch();
		return (Int)$r[0];
	}
}
class VerifActForUser extends Action{
	public static function countAct (PDO $pdo, User $user ){
		$sql = '
					SELECT COUNT(a.from_idUser)+ COUNT(a.to_idUser)
					FROM  Action a
					WHERE a.from_idUser = ? OR a.to_idUser = ?';
		$pdoStatement =  $pdo->prepare($sql);
		if (!$pdoStatement->execute(array($user->getId(),$user->getId() ))) {
			//throw new Exception('');
			var_dump($pdoStatement->errorInfo() );
		}
		$r =  $pdoStatement->fetch();
		return (Int)$r[0];
		
	}
	
}

class VerifLogForUser extends Log{

	public static function countLog (PDO $pdo, User $user ){
		$sql = '
			SELECT COUNT(l.user_idUser) 
			FROM  Log l
			WHERE l.user_idUser = ?';
		$pdoStatement =  $pdo->prepare($sql);
		if (!$pdoStatement->execute(array($user->getId() ))) {
			//throw new Exception('');
			var_dump($pdoStatement->errorInfo() );
		}
		$r =  $pdoStatement->fetch();
		return (Int)$r[0];
	}
}


echo 'User ....................... ';
foreach( User::loadAll($pdo) as $user){
	// On compte pour les mandats...
	$nbReel = VerifMandateForUser::countMandate($pdo, $user)
	+VerifAcqForUser::countAcq($pdo, $user)
	+VerifSellerForUser::countSeller($pdo, $user)
	+VerifRappForUser::countRapp($pdo, $user)
	+VerifActForUser::countAct($pdo, $user)
	+VerifLogForUser::countLog($pdo, $user);
	
	if( $nbReel != $user->getNumberUsed() ){
		$user->setNumberUsed($nbReel);
	}
	
}
echo 'Done<br/>';