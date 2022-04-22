{include file="tpl_default/entete.tpl"}
<form action="" method="post" class="form-horizontal" role="form">
    <div class="row bg-success bannerTitle">
        <div class="col-md-6">
            <h1 class="h2">Supprimer l'utilisateur</h1>
        </div>

        <div class="col-md-6">
            <p class="h4 text-right ">
                <button type="submit" name="user_delete_submit_valid" value="Valider" id="user_delete_submit_valid2" class="btn btn-danger" title="Valider">
                    <i class="fa fa-trash fa-2x"></i>
                </button>
                <button type="submit" name="user_delete_submit_cancel" id="user_delete_submit_cancel2" value="Annuler" class="btn btn-default" title="Annuler">
                    <i class="fa fa-close fa-2x"></i>
                </button>

            </p>
        </div>
    </div>

{if $error}
<p class="error">{$error}</p>
{/if}

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
	Êtes vous sûr de vouloir supprimer l'utilisateur

		<p>
			<input type="hidden" name="user_delete_id_user" id="user_delete_id_user" value="{$smarty.get.action}" />




            <button type="submit" name="user_delete_submit_valid" value="Valider" id="user_delete_submit_valid" class="btn btn-danger">
                <i class="fa fa-trash"></i> Valider
            </button>
            <button type="submit" name="user_delete_submit_cancel" id="user_delete_submit_cancel" value="Annuler" class="btn btn-default">
                <i class="fa fa-close"></i> Annuler
            </button>
        </p>
</div>
</div>
</form>
</div>
