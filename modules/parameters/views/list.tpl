{include file='tpl_default/entete.tpl'}
<div class="row bg-success bannerTitle">
    <div class="col-md-6">
        <h1 class="h2">{$h1}</h1>
    </div>
    <div class="col-md-6">
        <p class="h4 text-right ">
            <a class="btn btn-success" href="{Tools::create_url($user,$smarty.get.module,$addOption )}" title="Ajouter">
                <i class="fa fa-plus-circle fa-2x"></i>
            </a>
        <a class="btn btn-default" href="{Tools::create_url($user,'parameters',listParametersMandate)}" title="Fermer la fiche">
            <i class="fa fa-times fa-2x"></i>
        </a>
        </p>
    </div>

</div>
<table class="standard table table-bordered table-striped">
	<thead>
		<tr>
			<th>Nom</th>
			<th>Code</th>
            <th>Etat</th>
			<th>Actions</th>

		</tr>
	</thead>
	<tbody>
		{foreach from=$list item=i}
		<tr>
			<td>{$i->getName()}</td>
			<td>{$i->getCode()}</td>

			<td>{if $i->getIsDisabled()}Désactivé{else}Activé{/if}</td>
            <td>
                <a  class="btn btn-default" href="{Tools::create_url($user,$smarty.get.module,$page,$i->getId() )}" title="{Lang::LABEL_UPDATE}">
                    <i class="fa fa-pencil-square-o"></i> Modifier
                </a>
            </td>
		</tr>
		{/foreach}
	</tbody>
</table>
</div>