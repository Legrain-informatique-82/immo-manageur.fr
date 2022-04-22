{include file='tpl_default/entete.tpl'}
<h1>Ajouter une action</h1>
{if $error}
<ul>
	{foreach from=$error item=e}
	<li class="error">{$e}</li> {/foreach}
</ul>

{/if}
<form action="" method="post">
	{* Affichage de la liste des membres pour "from" si le niveau du membre
	est <=2 *} {if $user->getLevelMember()->getIdLevelMember() < 3}
	<p>
		<label for="from">De :</label><select name="from" id="from"> {foreach
			from=$listUser item=i}
			<option {if $from eq $i->getIdUser()} selected="selected" {/if}
				value="{$i->getIdUser()}"> {$i->getFirstname()} {$i->getName()}</option>
			{/foreach}
		</select>
	</p>
	{/if} {* *}
	<p>
		<label for="to">Pour : </label><select name="to" id="to"> {foreach
			from=$listUser item=i}
			<option {if $to eq $i->getIdUser()} selected="selected" {/if}
				value="{$i->getIdUser()}"> {$i->getFirstname()} {$i->getName()}</option>
			{/foreach}
		</select>
	</p>

	<p>
		<label for="mandate">Attribué à : </label><select name="mandate"
			id="mandate">
			<option value="">Aucun mandat</option> {foreach from=$listMandate
			item=i}
			<option {if $mandate eq $i->getIdMandate()} selected="selected" {/if}
				value="{$i->getIdMandate()}"> {$i->getNumberMandate()}
				{$i->getMandateType()->getName()}</option> {/foreach}
		</select>
	</p>


	<p>
		Libelé : {if $listLibel} <select name="libelS" id="libelS">
			<option value="0">...........................</option> {foreach
			from=$listLibel item=i}
			<option value="{$i->getLibel()}">{$i->getLibel()}</option> {/foreach}
		</select> {/if} <input type="text" name="libel" id="libel"
			value="{$libel}" />

	</p>
	<p>
		<label for="initDate">Date de début de l'action : </label><input
			type="text" name="initDate" value="{$initDate}" id="initDate"
			class="datepicker" />
	</p>
	{*
	<p>
		<label for="deadDate">Date de fin de l'action : <input type="text"
			name="deadDate" value="{$deadDate}" id="deadDate"
			class="dateTimepicker" /> </label>
	</p>
	*}
	<p>
		<label for="comment">Détail : </label>
		<textarea name="comment" id="comment" cols="30" rows="10">{$comment}</textarea>
	</p>
	<p>
		<input type="submit" name="send" value="Valider" />
	</p>
</form>
</div>
