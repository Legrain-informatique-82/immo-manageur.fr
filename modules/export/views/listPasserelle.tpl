{include file='tpl_default/entete.tpl'}

<div class="row bg-success bannerTitle">
    <div class="col-md-12">
        <h1 class="h2">Liste des passerelles</h1>
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
            <th>Etat</th>
			<th>Actions</th>

		</tr>
	</thead>
	<tbody>

		{foreach from=$listPasserelle item=p}
		<tr>
			<td>{$p->getName()}</td>
            <td>
                {if $p->getAsset()}Active{else}Inactive{/if}
            </td>
            <td>
                <div class="btn-group">
                    <a class="btn btn-default" href="{Tools::create_url($user,$smarty.get.module,'updatePasserelle',$p->getIdPasserelle())}" {if $user->getOpenInNewTab()} target="_blank"{/if}><i class="fa fa-pencil-square-o"></i> Modifier </a>
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">

                        <li>

                            <a href="{Tools::create_url($user,$smarty.get.module,'deletePasserelle',$p->getIdPasserelle())}" title="Supprimer">
                                <i class="fa fa-trash"></i> Supprimer
                            </a>
                        </li>

                    </ul>

                </div>
            </td>
		</tr>
		{/foreach}
	</tbody>
</table>
</div>
