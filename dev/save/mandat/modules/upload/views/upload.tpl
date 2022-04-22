{if $errorUpload}
<ul>
	{foreach from=$errorUpload item=e}
	<li class="error">{$e}</li> {/foreach}
</ul>
{/if}
<form action="" method="post" enctype="multipart/form-data">
	<p>
		<label for="newDoc">Ajouter un fichier : <input type="file"
			name="newDoc" id="newDoc" /> </label> <input type="submit"
			value="Envoyer" id="sendDocForMandate" name="sendDocForMandate" />
	</p>
</form>
<table class="standard">
	<thead>
		<tr>
			<th>Fichier</th>
			<th>Supprimer</th>
		</tr>
	</thead>
	<tbody>
		{foreach from=$listUpload item=upl}
		<tr>
			<td><a
				href="{Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY}upload/{$upl->getMandate()->getIdMandate()}/{$upl->getName()}"
				target="_blank">{$upl->getName()} ({$upl->getSize()})</a></td>
			<td>
				<form action="" method="post">
					<input type="hidden" name="idDoc" value="{$upl->getIdUpload()}" /><input
						type="submit" name="delDocument" value="Supprimer" />
				</form>
			</td>

		</tr>
		{/foreach}
	</tbody>
</table>




