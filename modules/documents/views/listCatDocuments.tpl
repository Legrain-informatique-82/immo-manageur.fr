{include file="tpl_default/entete.tpl"}

<div class="row bg-success bannerTitle">
    <div class="col-md-6">
        <h1 class="h2">{$h1}</h1>
    </div>
    <div class="col-md-6">
        <p class="h4 text-right ">
            <a class="btn btn-success" href="{Tools::create_url($user,'documents','addCatDocuments')}" title="Ajouter une categorie">
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
    {foreach $categories as $cat}
        <tr>
            <td>{$cat->getName()}</td>
            <td>
                <!-- Split button -->
                <div class="btn-group">
                    <a href="{Tools::create_url($user,'documents','updCatDocument',$cat->getIdCategoryDocument())}" class="btn btn-default"><i class="fa fa-pencil-square-o"></i> {lang::LABEL_UPDATE}</a>
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">

                        <li>
                            <a href="{tools::create_url($user,'documents','delCatDocument',$cat->getIdCategoryDocument())}" title="{Lang::LABEL_DELETE}"><i class="fa fa-trash"></i> {Lang::LABEL_DELETE}</a>
                        </li>
                    </ul>
                </div>
            </td>
        </tr>
    {/foreach}
    </tbody>
</table>


</div>
