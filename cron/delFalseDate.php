<?php
require_once dirname(__FILE__) . '/../libs/php_functions_missing.php';
require_once dirname(__FILE__) . '/../const/config.php';
$pdo = new PDO('mysql:dbname=' . Constant::DATABASE_NAME . ';host=' . Constant::DATABASE_SERVER . ';', Constant::DATABASE_USER, Constant::DATABASE_PASSWORD);
$pdo->exec("UPDATE Mandate SET dateDeclarationPrealable = null WHERE dateDeclarationPrealable = '1970-01-01'");
$pdo->exec("UPDATE Mandate SET freeDate = null WHERE freeDAte = '1970-01-01'");
$pdo->exec("UPDATE Mandate SET prorogationDPJusquau = null WHERE prorogationDPJusquau = '1970-01-01'");
$pdo->exec("UPDATE Mandate SET dateCU = null WHERE dateCU = '1970-01-01'");
$pdo->exec("UPDATE Mandate SET prorogationCUJusquau = null WHERE prorogationCUJusquau = '1970-01-01'");
$pdo->exec("UPDATE Mandate SET dateCuOPS = null WHERE dateCuOPS = '1970-01-01'");
$pdo->exec("UPDATE Mandate SET prorogationCuOPSJusquau = null WHERE prorogationCuOPSJusquau = '1970-01-01'");
$pdo->exec("UPDATE Mandate SET datePermisDamenager = null WHERE datePermisDamenager = '1970-01-01'");

