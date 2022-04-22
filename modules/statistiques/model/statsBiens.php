<?php
require_once Constant::DEFAULT_MODULE_DIRECTORY.'biens/model/requires.php';
require_once Constant::DEFAULT_MODULE_DIRECTORY.'mandate_features/model/requires.php';
class StatsMandate extends Mandate{

	public static function countByUserAndType(PDO $pdo,User $user, MandateType $type,$terrain = 0){
		$sql = 'SELECT count(m.idMandate)
				FROM Mandate m 
				WHERE m.user_idUser = ? AND m.etap_idMandateEtap = ? ';
		if($terrain ){
			$sql.=' AND m.mandateType_idMandateType = ?';
		}else{
			$sql.=' AND m.mandateType_idMandateType != ?';
		}
		$pdoStatement = $pdo->prepare($sql);
		if (!$pdoStatement->execute( array( $user->getId(), $type->getId()  , Constant::ID_PLOT_OF_LAND) )) {
			throw new Exception('Erreur lors du chargement de tous/toutes les mandats');
		}
		$count =$pdoStatement->fetch();
		return (int)$count['count(m.idMandate)'];
	}
}