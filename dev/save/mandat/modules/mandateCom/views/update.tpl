
<h1>Modification des commentaires / Infos visite</h1>
<form action="" method="post">

	<p>
		<label for="com">Commentaire : <textarea name="com" id="com" cols="30"
				rows="10">{if $elementMandateCom}{$elementMandateCom->getCom()}{/if}</textarea>
		</label>
	</p>
	<p>
		<label for="infoVisite">Infos visite : <textarea name="infoVisite"
				id="infoVisite" cols="30" rows="10">{if $elementMandateCom}{$elementMandateCom->getInfoVisite()}{/if}</textarea>
		</label>
	</p>
	<p>
		<label for="otherCom">Observations : <textarea name="otherCom"
				id="otherCom" cols="30" rows="10">{if $elementMandateCom}{$elementMandateCom->getOtherCom()}{/if}</textarea>
		</label>
	</p>
	<p>
		<input type="submit" value="Valider" name="send" />&nbsp;<input
			type="submit" value="Annuler" name="cancel" />
	</p>
</form>
