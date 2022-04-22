{include file='tpl_default/entete.tpl'}
<form action="" method="post" role="form" class="form-horizontal">
    <div class="row bg-success bannerTitle">
        <div class="col-md-6">
            <h1 class="h2"> {$title}</h1>
        </div>
        <div class="col-md-6">
            <p class="h4 text-right ">

                <button type="submit" name="send" value="Generer" class="btn btn-default">
                    <i class="fa fa-print fa-2x"></i>
                </button>


            </p>
        </div>
    </div>


    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
		<p class="help-block">Utilisation :</p>

    <label for="ville" class="radio-inline">

            <input type="radio" checked="checked" name="villeSecteur" id="ville"
				value="ville" /> Ville ({$ville}) </label>

             <label for="secteur" class="radio-inline">
				<input type="radio" name="villeSecteur" id="secteur"
				value="secteur" /> Secteur ({$secteur})</label>
		</div>
        </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="corps">Corps : </label>
        <div class="col-sm-8">
        <textarea class="form-control" name="corps" id="corps" cols="30" rows="10">{$corps}</textarea>
            </div>
		</div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
			<button type="submit" name="send" value="Generer" class="btn btn-default">
                <i class="fa fa-print"></i> Générer
			</button>
		</div>
        </div>
	</form>
</div>



