{include file='tpl_default/entete.tpl'}

<form action="" method="post" class="form-horizontal" role="form">
<div class="row bg-success bannerTitle">
    <div class="col-md-6">
        <h1 class="h2">Supprimer la passerelle</h1>
    </div>

    <div class="col-md-6">
        <p class="h4 text-right ">

            <button type="submit" name="sent" value="Supprimer" class="btn btn-danger" title="Supprimer">
                <i class="fa fa-trash fa-2x"></i>
            </button>
            <button type="submit" value="Annuler" name="cancel"  class="btn btn-default" title="Annuler">
                <i class="fa fa-close fa-2x"></i>
            </button>
        </p>
    </div>
</div>
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-8">
<p>Êtes-vous sûr de vouloir supprimer cette passerelle ?</p>

	<p>
		<button type="submit" name="sent" value="Supprimer" class="btn btn-danger">
            <i class="fa fa-trash"></i> Supprimer
		</button>
        <button type="submit" value="Annuler" name="cancel"  class="btn btn-default">
            <i class="fa fa-close"></i> Annuler
        </button>
	</p>

</form>
    </div>
</div>
</div>
