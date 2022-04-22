{include file="tpl_default/entete.tpl"}

<form action="" method="post" role="form" class="form-horizontal">
    <div class="row bg-success bannerTitle">
        <div class="col-md-6">
            <h1 class="h2">Suppression du plan</h1>
        </div>
        <div class="col-md-6">
            <p class="h4 text-right ">
                <button type="submit" name="confirm" value="Oui" class="btn btn-danger" title="{Lang::LABEL_DELETE}">
                    <i class="fa fa-trash fa-2x"></i>
                </button>
                <button type="submit" name="cancel_delete_picture" value="Non" class="btn btn-default" title="{Lang::LABEL_CANCEL}">
                    <i class="fa fa-close fa-2x"></i>
                </button>
            </p>
        </div>
    </div>
{include file="tpl_default/error.tpl"}
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
            <p class="help-block">Êtes-vous sûr de voulour supprimer le plan ?</p>

	<p>
		<input type="hidden" name="idMandate" value="{$smarty.post.idMandate}" />
		<input type="hidden" name="idPlan" value="{$smarty.post.idPlan}" />
        <input type="hidden" name="confirm" value="1" />

        <button type="submit" value="Confirmer la suppression" id="delete_plan" name="delete_plan" class="btn btn-danger" >
            <i class="fa fa-trash"></i> Confirmer la suppression
        </button>

        <button type="submit" value="Annuler" id="cancel_delete_picture" name="cancel_delete_picture" class="btn btn-default">
            <i class="fa fa-close"></i> Annuler
        </button>


	</p>
</div>
        </div>
</form>
</div>
