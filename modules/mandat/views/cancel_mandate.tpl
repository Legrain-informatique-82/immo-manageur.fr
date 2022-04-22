{include file="tpl_default/entete.tpl"}

<form action="" method="post">

	<p>
		Nouvel Etat : <label for="newEtat"> <select name="newEtat"
			id="newEtat"> {foreach from=$listEtap item=i}
				<option {if $newEtat eq $i->getIdMandateEtap()} selected="selected"
					{/if} value="{$i->getIdMandateEtap()}">{$i->getName()}</option>
				{/foreach}
		</select> </label>
	</p>
	<p>
		<label for="reason">Raison : <textarea name="reason" id="reason"
				cols="30" rows="10">{$reason}</textarea> </label>
	</p>
	<p>
		<label for="disabledSellers">Rendre inactif les vendeurs n'ayant pas
			d'autres mandat associés : <input type="checkbox"
			name="disabledSellers" value="1" id="disabledSellers"
			{if $disabledSellers eq 1} checked="checked" {/if}/> </label>
	</p>
	<p>
		<input type="submit" value="Valider" name="valid" id="valid" /> <input
			type="submit" value="Annuler" name="cancel" id="cancel" />
	</p>

</form>
</div>
