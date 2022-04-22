<?php
Abstract Class Statistiques{
	
	Static Public function getNbMandatsByUser(PDO $pdo,User $user,MandateType $type){
			return StatsMandate::countByUserAndType($pdo, $user, $type);
	}
	Static Public function getNbTerrainsByUser(PDO $pdo,User $user,MandateType $type){
		return StatsMandate::countByUserAndType($pdo, $user, $type, 1 );
	}
	Static Public function getNbAcqByUser(PDO $pdo,User $user){
		return StatsAcq::countByAcq($pdo,$user);
	}
	
	Static public function getNbRapprochementByUser(PDO $pdo,User $user){
		return StatsRapprochement::countByUser($pdo,$user );
	}
	Static public function getNbCompromisByUser(PDO $pdo,User $user){
		return StatsRapprochement::countByUser($pdo,$user,1 );
        //$etap = MandateEtap::load($pdo,2);
        //return StatsMandate::countByUserAndEtap($pdo, $user, $etap );
	}
}