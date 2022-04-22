<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<title>{$title}</title>
</head>
<body >
<div id="ficheImage">
	<h1>{$title}</h1>
	<ul>
	<li>Pour changer la position d'une photo, modifier le numéro présent sous celle-ci.</li>
	<li>Pour ne pas imprimer une photo, supprimez le numéro présent sous celle-ci</li>
	</ul>
	<form action="" method="post">
		{foreach name="boucle" from=$listPictures item=i}
		{* {var_dump($i)}*}
		<div class="vingtPourCent border">
		<p>
		<img src="{$chemImage}thumb/{$i.name}" alt=""  height="161" />
		</p><p>
		<input type="text" name="position_{$i.idPhoto}" value="{$smarty.foreach.boucle.iteration}" />
		</p>
		</div>
		{/foreach}
		<p class="clear">
			<input type="submit" name="send" value="Generer" />
		</p>
	</form>
	</div>
</body>
</html>


