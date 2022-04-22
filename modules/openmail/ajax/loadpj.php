<?php
session_start();
require_once dirname(__FILE__).'/../../../const/config.php';
require_once dirname(__FILE__).'/../../../class/Tools.php';
require_once 'function.php';
$token = $_POST['token'];
echo loadPjs($token);

