{include file="tpl_default/entete.tpl"} {if $error}
<p class="error">{$error}</p>
{/if}
<div>
	Êtes vous sûr de vouloir supprimer l'utilisateur
	<form action="" method="post">
		<p>
			<input type="hidden" name="user_delete_id_user"
				id="user_delete_id_user" value="{$smarty.get.action}" /> <input
				type="submit" value="Annuler" name="user_delete_submit_cancel"
				id="user_delete_submit_cancel" /><input type="submit"
				value="Valider" name="user_delete_submit_valid"
				id="user_delete_submit_valid" />
		</p>
	</form>
</div>
</div>
