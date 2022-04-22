{include file="tpl_default/entete.tpl"}

<div class="row bg-success bannerTitle">
    <div class="col-md-12">
        <h1 class="h2">Ajouter un mandat (Choix du vendeur) :</h1>
    </div>

</div>

<div class="row">

    <div class="col-md-6">
        <form action="{$urlAct}" method="post">

	<p>
		<input type="submit" name="new" value="Créer un nouveau vendeur" class="btn btn-default btn-lg btn-block" />
	</p>
        </form>
</div>
    <div class="col-md-6">
<table class="dataTableDefault table table-striped table-bordered" data-display_length="10">
	<thead>
    <tr class="tri">
        <th class="jshide"></th>
        <th></th>
        <th></th>
        <th class="jshide"></th>
        <th class="jshide"></th>
        <th></th>
        <th class="jshide"></th>
    </tr>
		<tr>

			<th>Nom &amp; prénom</th>
			<th>Titre</th>
			<th>Opérateur lié</th>
			<th>téléphones</th>
			<th>Email</th>
			<th>Etat</th>
			<th>De ce vendeur</th>
		</tr>
	</thead>
	<tbody>
		{foreach from=$listSeller item=item}
		<tr>

			<td>{$item->getName()} - {$item->getFirstname()}</td>
			<td>{$item->getSellerTitle()->getLibel()}</td>
			<td>{$item->getUser()->getFirstname()} {$item->getUser()->getName()}</td>
			<td>{if $item->getPhone()}
				<p>{Lang::LABEL_SELLER_ADD_PHONE}{$item->getPhone()}</p>{/if} {if
				$item->getMobilPhone()}
				<p>{Lang::LABEL_SELLER_ADD_MOBIL_PHONE}{$item->getMobilPhone()}</p>{/if}
				{if $item->getWorkPhone()}
				<p>{Lang::LABEL_SELLER_ADD_WORK_PHONE}{$item->getWorkPhone()}</p>{/if}
			</td>
			<td>{$item->getEmail()}</td>
			<td>{if $item->getAsset() eq 1}Actif{else}Inactif{/if}</td>
			<td>
				<form action="{$urlAct}" method="post">
					<p>
						<input type="hidden" name="idSeller"
							value="{$item->getIdSeller()}" /> <input type="submit"
							name="used" value="Utiliser" class="btn btn-default"/>
					</p>
				</form>
			</td>
		</tr>
		{/foreach}
	</tbody>
</table>
</div>
</div>
</div>
