{include file='tpl_default/entete.tpl'}
<h1>{$title}</h1>
<p>Êtes-vous sûr de vouloir supprimer le libellé : {$libel->getLibel()}</p>
<form action="" method="post">
	<p>
		<input type="submit" value="Supprimer" name="delete" /><input
			type="submit" value="Annuler" name="cancel" />
	</p>
</form>
</div>
