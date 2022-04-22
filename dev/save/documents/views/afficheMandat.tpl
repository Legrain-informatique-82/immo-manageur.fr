<h1>{$title}</h1>
{if $error}
<ul class="error">
	{foreach from=$error item=e}
	<li>{$e}</li> {/foreach}
</ul>
{/if}
<form action="" method="post">

	<fieldset>
		<legend> Localisation : </legend>
		<p>
			<label for="ville"> Ville : {$ville}<input type="radio" {if
				empty($smarty.post.villeSecteur) || $smarty.post.villeSecteur
				eq 'ville'} checked="checked" {/if} name="villeSecteur" id="ville"
				value="ville" /> </label>
		</p>
		<p>
			<label for="secteur"> Secteur : {$secteur}<input type="radio"
				{if $smarty.post.villeSecteur eq 'secteur'} checked="checked"
				{/if}  name="villeSecteur" id="secteur" value="secteur" /> </label>
		</p>
	</fieldset>
	<fieldset>
		<legend> spécificité : </legend>
		<p>
			<label for="default"> Classique <input type="radio" name="type"
				id="default" {if empty($smarty.post.type) || $smarty.post.type
				eq 'default'} checked="checked" {/if}  value="default" /> </label>
		</p>
		<p>
			<label for="exclu"> Exlusivité <input type="radio" name="type"
				id="exclu" {if $smarty.post.type eq 'exclu'} checked="checked"
				{/if}  value="exclu" /> </label>
		</p>
		<p>
			<label for="dejaV"> Déja vendu <input type="radio" name="type"
				id="dejaV" {if $smarty.post.type eq 'dejaV'} checked="checked"
				{/if}  value="dejaV" /> </label>
		</p>
		<p>
			<label for="nouveaute"> Nouveaute <input type="radio" name="type"
				id="nouveaute" {if $smarty.post.type
				eq 'nouveaute'} checked="checked" {/if}  value="nouveaute" /> </label>
		</p>
	</fieldset>
	<fieldset>
		<legend> Vignettes : </legend>
		<p>
			<label for="une"> Non <input type="radio" name="photos" id="une" {if
				empty($smarty.post.photos) || $smarty.post.photos
				eq 'une'} checked="checked" {/if} value="une" /> </label>
		</p>
		<p>
			<label for="quatre"> Oui <input type="radio" name="photos"
				{if $smarty.post.photos eq 'quatre'} checked="checked"
				{/if}   id="quatre" value="quatre" /> </label>
		</p>
		<div id="choosePicturegenerateAfficheMandate">
			<p>Choix de 3 vignettes :</p>

			{foreach from=$listOfPicture item=pict} {if !$pict->getIsDefault()}
			<div class="vingtPourCent">
				<label>
					<p>
						<img
							src="{Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY}mandat/thumb/{$pict->getName()}"
							alt="" />
					</p>
					<p>
						Sélectionner <input type="checkbox" class="arrayPicture"
							name="arrayPicture[]" value="{$pict->getName()}" />
					</p> </label>
			</div>
			{/if} {/foreach}
			<hr class="clear invi" />
		</div>
	</fieldset>
	<p>
		<label for="corps"> Corps : <textarea name="corps" id="corps"
				cols="30" rows="10">{$corps}</textarea> </label>
	</p>
	<p>
		<input type="submit" name="send" value="Generer" />
	</p>
</form>
