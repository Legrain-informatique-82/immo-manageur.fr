{include file="tpl_default/entete.tpl"}
<form action="" method="post" role="form" xmlns="http://www.w3.org/1999/html">
<div class="row bg-success bannerTitle">
    <div class="col-md-6">
        <h1 class="h2">Suppression de l'acquereur associé {$acq->getName()} {$acq->getFirstname()}</h1>
    </div>

    <div class="col-md-6">
        <p class="h4 text-right ">
            <button type="submit" class="btn btn-danger" name="send" value="{Lang::LABEL_DELETE}">
                <i class="fa fa-trash fa-2x"></i>
            </button>
            <button type="submit" class="btn btn-default" name="cancel" value="{Lang::LABEL_CANCEL}">
                <i class="fa fa-close fa-2x"></i>
            </button>

    </div>
</div>

{if $error}
<p class="error">{$error}</p>
{/if}

<p>Êtes-vous sûr de vouloir supprimer l'acquereur associé : {$acq->getName()} {$acq->getFirstname()} ?</p>

	<input type="hidden" name="id_seller" value="{$acq->getId()}" />
	<button type="submit" name="send" value="{Lang::LABEL_DELETE}" class="btn btn-danger">
        <i class="fa fa-trash"></i> {Lang::LABEL_DELETE}
    </button>
    <button type="submit" name="cancel" value="{Lang::LABEL_CANCEL}" class="btn btn-default">
        <i class="fa fa-close"></i> {Lang::LABEL_CANCEL}
    </button>
</form>
</div>
