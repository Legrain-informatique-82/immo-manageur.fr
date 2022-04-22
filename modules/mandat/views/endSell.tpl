{include file="tpl_default/entete.tpl"} {* Recuperer le flux de sortie.
*}
<h1>{$h1}</h1>
<form action="" method="post">
	<p>Acquereur : {$acq->getFirstname()} {$acq->getName()}</p>
	<p>Numéro du mandat : {$mandate->getNumberMandate()}</p>
	<p>
		<label for="unSeller">Rendre le(s) vendeur(s) inactif(s) : <input
			type="checkbox" checked="checked" name="unSeller" value="on"
			id="unSeller" /> </label>
	</p>
	<p>
		<label for="unAcq">Rendre l'acquereur inactif : <input type="checkbox"
			checked="checked" name="unAcq" id="unAcq" value="on" /> </label>
	</p>
	<p>
		<input type="submit" name="send" value="Finaliser la vente" /><input
			type="submit" name="cancel" value="Annuler" />
	</p>
</form>
</div>
