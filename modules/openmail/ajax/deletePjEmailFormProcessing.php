<?php

session_start();
require_once dirname(__FILE__).'/../../../const/config.php';
require_once dirname(__FILE__).'/../../../class/Tools.php';
require_once 'function.php';
$token = $_POST['token'];


$arrayDelpj = $_POST['delpj'];



foreach($arrayDelpj as $index){
    unset($_SESSION['emails_pj'][$token][$index]);
}



echo loadPjs($token);

