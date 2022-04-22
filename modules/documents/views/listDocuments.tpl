{include file="tpl_default/entete.tpl"}
<div class="row bg-success bannerTitle">
    <div class="col-md-6">
        <h1 class="h2">Liste des documents</h1>
    </div>
    <div class="col-md-6">
        <p class="h4 text-right ">
            <a class="btn btn-success" href="{Tools::create_url($user,'documents','addDocument')}" title="Ajouter un document">
                <i class="fa fa-plus-circle fa-2x"></i>
            </a>
        </p>
    </div>
</div>
<table class="dataTableDefault table table-striped table-bordered">
<thead>
<tr class="tri">
    <th></th>
    <th></th>
    <th class="jshide"></th>
</tr>
<tr>

<th>Nom</th>
<th>Catégorie</th>
<th>Actions</th>

</tr>
</thead>
<tbody>
{foreach from=$documents item=document}
<tr>

	{*<td>{substr($document->getCorps(),0,350)} ...</td>*}
    <td>{$document->getName()}</td>
    <td>{$document->getCategoryDocument()->getName()}</td>


    <td>
        <!-- Split button -->
        <div class="btn-group">
            <a href="{Tools::create_url($user,'documents','addDocument',$document->getId())}" class="btn btn-default"><i class="fa fa-pencil-square-o"></i> {lang::LABEL_UPDATE}</a>
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li>
                    <a href="{tools::create_url($user,'documents','delDocument',$document->getId())}" title="{Lang::LABEL_DELETE}"><i class="fa fa-trash"></i> {Lang::LABEL_DELETE}</a>
                </li>
                <li>
                    <a href="{tools::create_url($user,'documents','printDoc',$document->getId())}" target="_blank">
                        <i class="fa fa-print"></i> Imprimer le document
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
