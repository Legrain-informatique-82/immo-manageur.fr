{include file="tpl_default/entete.tpl"}
<div class="row bg-success bannerTitle">
    <div class="col-md-6">
        <h1 class="h2">{Lang::LABEL_SELLER_LIST_TITLE_H1}</h1>
    </div>

    <div class="col-md-6">
        <p class="h4 text-right ">
            <a title="Ajouter un titre de vendeur" class="btn btn-success" href="{Tools::create_url($user,"seller","add")}">
                <i class="fa fa-plus-circle fa-2x"></i>
            </a>
        </p>
    </div>
</div>
<table class="dataTableDefault table table-bordered table-striped">
	<thead>
		<tr>
			<th>Titre</th>
			<th>Actions</th>

		</tr>
	</thead>
	<tbody>
		{foreach from=$list item=item}
		<tr>
			<td>{$item.libel}</td>
			<td>




                <div class="btn-group">
                    <a class="btn btn-default" href="{$item.urlUpdate}" {if $user->getOpenInNewTab()} target="_blank"{/if}><i class="fa fa-pencil-square-o"></i> Modifier </a>
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a class="jsdelTitleSeller" rel="{$item.idSellerTitle}" href="{$item.urlDelete}" title="{Lang::LABEL_DELETE}">
                                <i class="fa fa-trash"></i> {Lang::LABEL_DELETE}
                            </a>
                        </li>

                    </ul>

                </div>



            </td>


            {*
            <td><a class="jsdelTitleSeller" rel="{$item.idSellerTitle}"
				href="{$item.urlDelete}" title="{Lang::LABEL_DELETE}"><img src="{Constant::DEFAULT_URL_PICTURE_DIRECTORY}delete.png" alt="{Lang::LABEL_DELETE}" /></a></td>

*}
		</tr>
		{/foreach}
	</tbody>
</table>
</div>
