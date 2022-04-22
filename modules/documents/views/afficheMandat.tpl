
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
    {include file='tpl_default/error.tpl'}

	<fieldset>
		<legend> Localisation : </legend>
		<div class="form-group">
            <div class="col-sm-offset-2 col-sm-8">
			<label for="ville" class="radio-inline">
            <input type="radio" {if
				empty($smarty.post.villeSecteur) || $smarty.post.villeSecteur
				eq 'ville'} checked="checked" {/if} name="villeSecteur" id="ville"
				value="ville" />Ville </label>

			<label for="secteur" class="radio-inline">
                {$secteur}<input type="radio"
				{if $smarty.post.villeSecteur eq 'secteur'} checked="checked"
				{/if}  name="villeSecteur" id="secteur" value="secteur" />
                Secteur </label>
                </div>
		</div>
	</fieldset>
	<fieldset>
		<legend> spécificité : </legend>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-8">
			<label for="default" class="radio-inline">
                <input type="radio" name="type"
				id="default" {if empty($smarty.post.type) || $smarty.post.type
				eq 'default'} checked="checked" {/if}  value="default" />
                Classique </label>
			<label for="exclu" class="radio-inline">
                <input type="radio" name="type"
				id="exclu" {if $smarty.post.type eq 'exclu'} checked="checked"
				{/if}  value="exclu" />
                Exlusivité</label>
			<label for="dejaV" class="radio-inline">
                <input type="radio" name="type"
				id="dejaV" {if $smarty.post.type eq 'dejaV'} checked="checked"
				{/if}  value="dejaV" />
                Déja vendu</label>
			<label for="nouveaute" class="radio-inline">
                <input type="radio" name="type"
				id="nouveaute" {if $smarty.post.type
				eq 'nouveaute'} checked="checked" {/if}  value="nouveaute" />
                Nouveaute  </label>
		</div>
        </div>
	</fieldset>
	<fieldset>
		<legend> Vignettes : </legend>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-8">
			<label for="une" class="radio-inline">
                <input type="radio" name="photos" id="une" {if
				empty($smarty.post.photos) || $smarty.post.photos
				eq 'une'} checked="checked" {/if} value="une" />
                Non </label>
			<label for="quatre" class="radio-inline">
                <input type="radio" name="photos"
				{if $smarty.post.photos eq 'quatre'} checked="checked"
				{/if}   id="quatre" value="quatre" />
                Oui </label>
		</div>
        </div>
		<div id="choosePicturegenerateAfficheMandate">
            <div class="col-sm-offset-2 col-sm-8">
                <p class="help-block">Choix de 3 vignettes :</p>
           {$count=0}
			{foreach from=$listOfPicture item=pict name=boucle}
                {if !$pict->getIsDefault()}

                {if $count %3 ==0}
                {if $count!==0}</div>{/if}
            <div class="row">
                {/if}
                <div class="col-md-4 text-center">

				<label>
					<p>
						<img
							src="{Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY}mandat/thumb/{$pict->getName()}"
							alt="" class="img-thumbnail" />
					</p>
					<p>
						Sélectionner <input type="checkbox" class="arrayPicture"
							name="arrayPicture[]" value="{$pict->getName()}" />
					</p> </label>
			</div>
                <!--{$count++}-->
			{/if}
                {/foreach}
			</div>
		</div>
	</fieldset>
    <fieldset>
        <legend>Corps</legend>
        <div class="form-group">
		<label for="corps" class="col-sm-2 control-label"> Corps : </label>
            <div class="col-sm-8">
            <textarea name="corps" id="corps" class="form-control"
				cols="30" rows="10">{$corps}</textarea>
                </div>
	</div>
        </fieldset>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
		<button type="submit" name="send" value="Generer" class="btn btn-default">
            <i class="fa fa-print"></i> Générer
		</button>

	</div>

</form>
</div>

