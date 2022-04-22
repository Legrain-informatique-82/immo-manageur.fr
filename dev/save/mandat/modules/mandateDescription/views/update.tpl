
<h1>Modification des descriptions</h1>
<form action="" method="post">
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

	<p>
		<input type="submit" value="modifier" name="addNewLine" />&nbsp;<input
			type="submit" value="Revenir à la fiche" name="close" />
	</p>
</form>
