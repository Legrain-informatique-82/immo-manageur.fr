{include file="tpl_default/entete.tpl"}
<h1>Modifier un utilisateur</h1>
<div>
	{if $error} {foreach name="ee" from=$error item="e"} {if
	$smarty.foreach.ee.first}
	<ul>
		{/if}
		<li>{$e}</li> {if $smarty.foreach.ee.last}
	</ul>
	{/if} {/foreach} {/if}

	<form action="" method="post">
		<fieldset>
			<legend>Identifiants :</legend>
			{if $user->getLevelMember()->getIdLevelMember() eq 1}
			<p>
				<label for="user_update_identifiant">{Lang::LABEL_USER_ADD_IDENTIFIANT}<input
					type="text" name="user_update_identifiant"
					id="user_update_identifiant" value="{$user_update_identifiant}" />
				</label> <input type="hidden" name="user_update_old_identifiant"
					id="user_update_old_identifiant"
					value="{$user_update_old_identifiant}" />
			</p>
			{else}
			<p>{Lang::LABEL_USER_ADD_IDENTIFIANT}{$user_update_identifiant}</p>
			{/if}
			<p>{Lang::LABEL_EDITO_PASSWORD}</p>
			<p>
				<label for="user_update_password">{Lang::LABEL_USER_ADD_PASSWORD}<input
					type="password" name="user_update_password"
					id="user_update_password" value="{$user_update_password}" /> </label>
			</p>
			<p>
				<label for="user_update_confirm_password">{Lang::LABEL_USER_ADD_CONFIRM_PASSWORD}<input
					type="password" name="user_update_confirm_password"
					id="user_update_confirm_password"
					value="{$user_update_confirm_password}" /> </label>
			</p>
		</fieldset>
		<fieldset>
			<legend>Général :</legend>
			<p>
				<label for="user_update_name">{Lang::LABEL_USER_ADD_NAME}<input
					type="text" name="user_update_name" id="user_update_name"
					value="{$user_update_name}" /> </label>
			</p>
			<p>
				<label for="user_update_firstname">{Lang::LABEL_USER_ADD_FIRSTNAME}<input
					type="text" name="user_update_firstname" id="user_update_firstname"
					value="{$user_update_firstname}" /> </label>
			</p>
			<p>
				<label for="user_update_email">{Lang::LABEL_USER_ADD_EMAIL}<input
					type="text" name="user_update_email" id="user_update_email"
					value="{$user_update_email}" /> </label>
			</p>

			{* prevoir clone pour les téléphones *} {if
			$user->getLevelMember()->getIdLevelMember() eq 1}
			<p>
				<label for="user_update_agency"> {Lang::LABEL_USER_ADD_AGENCY_NAME}
					<select name="user_update_agency" id="user_update_agency"> {foreach
						from=$listOfAgency item="ag"}
						<option {if $ag->getIdAgency() eq $user_update_agency}
							selected="selected" {/if}
							value="{$ag->getIdAgency()}">{$ag->getName()}</option> {/foreach}
				</select> </label>
			</p>
			<p>
				<label for="user_update_level"> {Lang::LABEL_USER_ADD_LEVEL} <select
					name="user_update_level" id="user_update_level"> {foreach
						from=$listOfLevel item="lv"}
						<option {if $lv->getIdLevelMember() eq $user_update_level}
							selected="selected" {/if}
							value="{$lv->getIdLevelMember()}">{$lv->getName()}</option>
						{/foreach}
				</select> </label>
			</p>
			{/if}
			<p>
				<input type="submit" value="{Lang::LABEL_USER_UPDATE_SUBMIT}"
					id="user_update_submit" name="user_update_submit" />
			</p>
		</fieldset>


	</form>
</div>
</div>
