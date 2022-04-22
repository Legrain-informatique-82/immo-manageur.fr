<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<title>{$title}</title>
</head>
<body>
<div id="choosePicturegenerateAfficheMandate">
			<p>Choix de 3 vignettes :</p>
<form action="" method="post">
			{foreach from=$listOfPicture item=pict} 
			<div class="vingtPourCent">
				<label>
					<p>
						<img
							src="{Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY}{$module}/thumb/{$pict->getName()}"
							alt="" height="180" />
					</p>
					<p>
						Sélectionner <input type="checkbox" class="arrayPicture"
							name="arrayPicture[]" value="{$pict->getName()}" />
					</p> </label>
			</div>
			{/foreach}
			<hr class="clear invi" />
		</div>
		<p>
		<input type="submit" name="send" value="Generer" />
	</p>
	</form>
</body>
</html>


