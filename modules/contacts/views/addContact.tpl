{include file="tpl_default/entete.tpl"}
<h1>{$title}</h1>
	{if $error}
	<ul class="contError">
		{foreach from=$error item=e}
		<li class="error">{$e}</li> {/foreach}
	</ul>
	{/if} 
<div class="bulle" id="blocContact">
<form action="" method="post">

	
	
	{*
	{if $listUser}

	<p>
		<label for="userSelected">Utilisateur affecté : </label> <select
			name="userSelected" id="userSelected"> {foreach from=$listUser
			item=u}
			<option {if $userSelected eq $u->getIdUser()} selected="selected"
				{/if} value="{$u->getIdUser()}">{$u->getName()} {$u->getFirstname()}</option>
			{/foreach}
		</select>
	</p>
	{/if}
	*}
	<input type="hidden" name="userSelected" value="{$user->getIdUser()}" />
	<p>
		<label for="name">Nom du contact : </label><input type="text"
			name="name" id="name" />
	</p>
	<p>
		<input type="submit" value="Ajouter" name="add" /><input type="submit"
			value="Annuler" name="cancel" />
	</p>

</form>
</div>
</div>