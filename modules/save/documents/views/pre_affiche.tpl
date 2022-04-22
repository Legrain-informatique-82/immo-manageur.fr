<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<title>{$title}</title>
</head>
<body>
	<h1>{$title}</h1>
	<form action="" method="post">
		<p>
			Utilisation :<br /> <label for="ville">Ville : {$ville}<input
				type="radio" checked="checked" name="villeSecteur" id="ville"
				value="ville" /> </label><br /> <label for="secteur">Secteur :
				{$secteur}<input type="radio" name="villeSecteur" id="secteur"
				value="secteur" /> </label>
		</p>
		<p>
			<label for="corps">Corps : <textarea name="corps" id="corps"
					cols="30" rows="10">{$corps}</textarea> </label>
		</p>
		<p>
			<input type="submit" name="send" value="Generer" />
		</p>
	</form>
</body>
</html>


