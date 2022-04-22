{include file='tpl_default/entete.tpl'}
<div class="row bg-success bannerTitle">
    <div class="col-md-12">
        <h1 class="h2">Choix de la passerelle</h1>
    </div>

</div>
<table class="dataTableDefault table table-striped table-bordered">
	<thead>
    <tr class="tri">
        <th class="jshide"></th>
        <th></th>
        <th class="jshide"></th>
    </tr>
		<tr>
			<th>Nom de la passerelle</th>
			 <th>Etat de la passerelle</th> 
			<th>Afficher les annonces pour cette passerelle</th>
			
		</tr>
	</thead>
	<tbody>

		{foreach from=$listPasserelle item=p}
		<tr>
			<td>{$p->getName()}</td>
			 <td>{if $p->getAsset()}Active{else}Inactive{/if}</td> 
			<td>
                <a href="{Tools::create_url($user,$smarty.get.module,'list',$p->getIdPasserelle())}" title="Choisir" class="btn btn-default"><i class="fa fa-check-square-o"></i> Choisir</a>
			</td>
		</tr>

		{/foreach}
	</tbody>
</table>
</div>
