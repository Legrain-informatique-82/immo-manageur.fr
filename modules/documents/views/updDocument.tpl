{include file="tpl_default/entete.tpl"}
<h1>Modifier le document</h1>
{* <p>Liste des variables ....</p> *}
<form action="" method="post">
<p><label for="corps">Corps</label><textarea name="corps" id="corps" cols="30" rows="30">{$corps}</textarea></p>
<p><label for="other">Signature</label><textarea name="other" id="other" cols="30" rows="10">{$signature}</textarea></p>
<p><input type="submit" value="Modifier" name="send"/> <input type="submit" value="Annuler" name="cancel"/></p>
</form>
</div>