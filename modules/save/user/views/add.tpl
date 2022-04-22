{include file="tpl_default/entete.tpl"}
<h1>Ajouter un utilisateur</h1>
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
			<p>
				<label for="user_add_identifiant">{Lang::LABEL_USER_ADD_IDENTIFIANT}<input
					type="text" name="user_add_identifiant" id="user_add_identifiant"
					value="{$smarty.post.user_add_identifiant}" /> </label>
			</p>
			<p>{Lang::LABEL_EDITO_PASSWORD}</p>
			<p>
				<label for="user_add_password">{Lang::LABEL_USER_ADD_PASSWORD}<input
					type="password" name="user_add_password" id="user_add_password"
					value="{$smarty.post.user_add_password}" /> </label>
			</p>
			<p>
				<label for="user_add_confirm_password">{Lang::LABEL_USER_ADD_CONFIRM_PASSWORD}<input
					type="password" name="user_add_confirm_password"
					id="user_add_confirm_password"
					value="{$smarty.post.user_add_confirm_password}" /> </label>
			</p>
		</fieldset>
		<fieldset>
			<legend>Général :</legend>
			<p>
				<label for="user_add_name">{Lang::LABEL_USER_ADD_NAME}<input
					type="text" name="user_add_name" id="user_add_name"
					value="{$smarty.post.user_add_name}" /> </label>
			</p>
			<p>
				<label for="user_add_firstname">{Lang::LABEL_USER_ADD_FIRSTNAME}<input
					type="text" name="user_add_firstname" id="user_add_firstname"
					value="{$smarty.post.user_add_firstname}" /> </label>
			</p>
			<p>
				<label for="user_add_email">{Lang::LABEL_USER_ADD_EMAIL}<input
					type="text" name="user_add_email" id="user_add_email"
					value="{$smarty.post.user_add_email}" /> </label>
			</p>

			{* prevoir clone pour les téléphones *}

			<p>
				<label for="user_add_agency"> {Lang::LABEL_USER_ADD_AGENCY_NAME} <select
					name="user_add_agency" id="user_add_agency"> {foreach
						from=$listOfAgency item="ag"}
						<option {if $ag->getIdAgency() eq $smarty.post.user_add_agency}
							selected="selected" {/if}
							value="{$ag->getIdAgency()}">{$ag->getName()}</option> {/foreach}
				</select> </label>
			</p>
			<p>
				<label for="user_add_level"> {Lang::LABEL_USER_ADD_LEVEL} <select
					name="user_add_level" id="user_add_level"> {foreach
						from=$listOfLevel item="lv"}
						<option {if $lv->getIdLevelMember() eq
							$smarty.post.user_add_level} selected="selected" {/if}
							value="{$lv->getIdLevelMember()}">{$lv->getName()}</option>
						{/foreach}
				</select> </label>
			</p>
			<p>
				<input type="submit" value="{Lang::LABEL_USER_ADD_SUBMIT}"
					id="user_add_submit" name="user_add_submit" />
			</p>
		</fieldset>


	</form>
</div>
</div>

