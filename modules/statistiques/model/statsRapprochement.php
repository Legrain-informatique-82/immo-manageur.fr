<?php
require_once Constant::DEFAULT_MODULE_DIRECTORY.'rapprochement/model/requires.php';

class StatsRapprochement extends BddRapprochement{

	static public function countByUser(PDO $pdo,User $user,$compromis = 0 ){
		$sql = 'SELECT count(r.idRapprochement)
						FROM Rapprochement r 
						WHERE r.user_idUser = ? AND r.compromis = ? AND r.actif=1';


		$pdoStatement = $pdo->prepare($sql);
		if (!$pdoStatement->execute( array( $user->getId(), $compromis   ))) {
			throw new Exception('Erreur lors du chargement de tous/toutes les rapprochements');
		}
		$count =$pdoStatement->fetch();
		return (int)$count['count(r.idRapprochement)'];
	}
}