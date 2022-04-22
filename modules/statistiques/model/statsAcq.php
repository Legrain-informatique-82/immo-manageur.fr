<?php
require_once Constant::DEFAULT_MODULE_DIRECTORY.'acquereur/model/requires.php';

class StatsAcq extends Acquereur{
	
	
	
	
	public static function countByAcq(PDO $pdo,User $user, $etat = 1){
		$sql = 'SELECT count(a.idAcquereur)
					FROM Acquereur a 
					WHERE a.user_idUser = ? AND a.actif = ? ';
	
		$pdoStatement = $pdo->prepare($sql);
		if (!$pdoStatement->execute( array( $user->getId(), $etat   ))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les Acq');
		}
		$count =$pdoStatement->fetch();
		return (int)$count['count(a.idAcquereur)'];
	}
}