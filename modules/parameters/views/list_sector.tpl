{include file="tpl_default/entete.tpl"}
<div class="row bg-success bannerTitle">
    <div class="col-md-6">
        <h1 class="h2">{LANG::LABEL_SECTOR_LIST}</h1>
    </div>
    <div class="col-md-6">
        <p class="h4 text-right ">
            <a class="btn btn-success" href="{Tools::create_url($user,$smarty.get.module,'add_sector' )}" title="Ajouter">
                <i class="fa fa-plus-circle fa-2x"></i>
            </a>

        </p>
    </div>

</div>
{foreach name="list" from=$list item=item}
    {if $smarty.foreach.list.first}
        <table class="standard table table-bordered table-striped">
        <thead>
        <tr>
            <th>{Lang::LABEL_SECTOR_NAME}</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
    {/if}
    <tr>
        <td>{$item.name}</td>
        <td>
            <div class="btn-group">
                <a href="{$item.urlUpdate}" title="{Lang::LABEL_UPDATE}" class="btn btn-default"><i class="fa fa-pencil-square-o"></i> {Lang::LABEL_UPDATE}</a>
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li>
                        <a class="jsDelSector" rel="{$item.id}" href="{$item.urlDelete}" title="{Lang::LABEL_DELETE}">
                            <i class="fa fa-trash"></i> {Lang::LABEL_DELETE}
                        </a>
                    </li>

                </ul>
            </div>
        </td>

    </tr>
    {if $smarty.foreach.list.last}
        </tbody>
        </table>
    {/if}
{/foreach}

</div>
