
<div class="row bg-success bannerTitle">
    <div class="col-md-6">
        <h1 class="h2">Modification des descriptions</h1>
    </div>
    <p class="h4 text-right ">

    </p>
</div>

<form action="" method="post" role="form" class="form-horizontal">
	<table id="tableUpdateMandateDescription">
		<thead>
			<tr>
				<th>Niveau</th>
				<th>Pièce</th>
				<th>Surface</th>
				<th>Sol/mur/équipement</th>
				<th>Supprimer</th>
			</tr>
		</thead>
		<tbody>
			{foreach from=$listOfDescription item=i}
			<tr>
				<td><input type="hidden" name="id[]"
					value="{$i->getIdMandateDescription()}" /> <input type="text"
					name="niveau[]" value="{$i->getNiveau()}" /></td>
				<td><input type="text" name="piece[]" value="{$i->getPiece()}" /></td>
				<td><input type="text" name="surface[]" value="{$i->getSurface()}" />
				</td>
				<td><input type="text" name="carac[]" value="{$i->getCarac()}" /></td>
				<td><input type="checkbox" name="del[]"
					value="{$i->getIdMandateDescription()}" /></td>
			</tr>
			{/foreach}
			<tr>
				<td><input type="hidden" name="id[]" value="" /> <input type="text"
					name="niveau[]" value="" /></td>
				<td><input type="text" name="piece[]" value="" /></td>
				<td><input type="text" name="surface[]" value="" /></td>
				<td><input type="text" name="carac[]" value="" /></td>
				<td>NC</td>
			</tr>
		</tbody>

	</table>

	<div class="form-group">
        <div class="col-sm-8">
		<button type="submit" value="modifier" name="addNewLine" class="btn btn-warning">
            <i class="fa fa-save"></i> Mettre à jour
		</button>
        <button type="submit" value="Revenir à la fiche" name="close" class="btn btn-default">
            <i class="fa fa-close"></i> Fermer
        </button>
        </div>
    </div>
</form>
