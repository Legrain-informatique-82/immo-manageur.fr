{include file="tpl_default/entete.tpl"}

<div class="row bg-success bannerTitle">
    <div class="col-md-6">
        <h1 class="h2">Liste des titres</h1>
    </div>

    <div class="col-md-6">

        <p class="h4 text-right ">

            <a href="{Tools::create_url($user,$smarty.get.module,'addT')}" class="btn-success btn" title="Ajouter un titre">
                <i class="fa fa-plus-circle fa-2x"></i>
            </a>

        </p>
    </div>
</div>

<table class="dataTableDefault table table-striped table-bordered">
    <thead>
    <tr>
        <th>Nom</th>
        <th>Actions</th>

    </tr>
    </thead>
    <tbody>
    {foreach from=$listTitre item=titre}
        <tr>
            <td>{$titre->getName()}</td>
            <td>
                <!-- Split button -->
                <div class="btn-group">
                    <a href="{Tools::create_url($user,$smarty.get.module,'updateT',$titre->getIdTitreAcquereur())}" class="btn btn-default"><i class="fa fa-pencil-square-o"></i> {lang::LABEL_UPDATE}</a>
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">

                        <li>
                            <a href="{Tools::create_url($user,$smarty.get.module,'delT',$titre->getIdTitreAcquereur())}" title="{Lang::LABEL_DELETE}"><i class="fa fa-trash"></i> {Lang::LABEL_DELETE}</a>
                        </li>
                    </ul>
                </div>



            </td>

        </tr>

    {/foreach}
    </tbody>
</table>
</div>
