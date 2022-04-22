<?php
require_once ('Email/SimpleMail.php');
require_once ('Compression/GzCompression.php');

try {
	$oEmail = new SimpleMail ();
	$oEmail->From = 'moi@example.org';
	$oEmail->To = array ('friend1@example.org', 'friend2@example.org','julien@localhost');
	//$oEmail->Bcc = array ('secretFriend@example.org');

	$oEmail->Subject = 'Nice Message';

	$oEmail->addBody ('This message is a plain text message, very simple !');
	$oEmail->addBody ('This message is in <b>html</b> format message, with some <u>special html tags</u>. You can also automatically add some <img src="image.png" alt="images" />. It\'s very simple !', 'text/html');

	//	$oEmail->addAttachment ('/var/www/myDoc.pdf', MimeType::get ('pdf')); // Basic file !
	//$oEmail->addAttachment ('/var/www/myDoc.pdf', MimeType::get ('tgz'), 'myCompressedDoc.tgz', $oGzCompress); // Basic file !

	$oEmail->send ();

	echo 'You\'re message was sent';
}
catch (Exception $oE) {
	var_dump ($oE);
	echo 'An error occured during sending the message.<br />'.$oE->getMessage ();
}
?>