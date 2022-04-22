
{if $errorUpload} {foreach from=$errorUpload item=item name=e} {if
$smarty.foreach.e.first}
    <div class="alert alert-danger" role="alert">
    <ul>
{/if}
    <li class="error">{$item}</li> {if $smarty.foreach.e.last}
        </ul>
    {/if} {/foreach}
    </div>
{/if}

<form action="" method="post" enctype="multipart/form-data" class="form-inline" role="form">
    <div class="form-group">
		<label for="newDoc">Ajouter un fichier :</label>
        <input type="file" name="newDoc" id="newDoc" />
     </div>
    <div class="form-group">
            <input type="submit" value="Envoyer" id="sendDocForMandate" name="sendDocForMandate" class="btn btn-default" />
	</div>
</form>
<p></p>
<p></p>
<table class="dataTableDefault3 table table-striped table-bordered">
	<thead>
		<tr>
			<th>Fichier</th>
			<th>Supprimer</th>
		</tr>
	</thead>
	<tbody>
		{foreach from=$listUpload item=upl}
		<tr>
			<td><a class="btn btn-default"
				href="{Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY}upload/{$upl->getMandate()->getIdMandate()}/{$upl->getName()}"
				target="_blank"><i class="fa fa-download"></i> {$upl->getName()} ({$upl->getSize()})</a></td>
			<td>
				<form action="" method="post">
					<input type="hidden" name="idDoc" value="{$upl->getIdUpload()}" />


                    <button type="submit" class="btn btn-danger" name="delDocument">
                        <i class="fa fa-trash"></i> Supprimer le document
                    </button>
				</form>
			</td>

		</tr>
		{/foreach}
	</tbody>
</table>




