<?php
session_start();
$token=$_GET['token'];
$index=$_GET['index'];

header('Content-Description: File Transfer');
header("Content-type: ".$_SESSION['emails_pj'][$token][$index]['filetype']);
header("Content-disposition: attachment; filename=".$_SESSION['emails_pj'][$token][$index]['filename']);
exit(base64_decode($_SESSION['emails_pj'][$token][$index]['b64']));
