{include file="tpl_default/entete.tpl"}
<div class="row bg-success bannerTitle">
    <div class="col-md-12">
        <h1 class="h2">Gestion des fourchettes</h1>
    </div>
</div>
<div id="tabs">
    <ul>
        <li><a href="#prix">Fourchettes de prix</a></li>
        <li><a href="#surfaces">Fourchettes de surfaces</a></li>

    </ul>
    <div id="prix">
        <p>
        <a href="{Tools::create_url($user,'export_site','addFp')}" class="btn btn-default"><i class="fa fa-plus-circle"></i> Ajouter une tranche</a>
        </p>
        {*Foreach sur la liste *}
        {assign var="tt" value=''}
        {assign var="tb" value=''}


        {$count =0}
        {foreach name="boucle" from=$fourchettesPrix item="fo"}
        {if $tt neq $fo->getTransactionType()->getId() || $fo->getMandateType()->getId() neq $tb}

            {if !$smarty.foreach.boucle.first}
                </tbody>
                </table>
                </div>
                </div>
                </div>
                {if $count==1}
                     </div> <!-- fin row -->
                     {$count = 0}
                {/if}
            {/if}

                {if $count==0}
                <div class="row">
                {/if}
                    <!-- {$count++}-->
                <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">{$fo->getTransactionType()->getName()} {$fo->getMandateType()->getName()}</h3>
                    </div>
                    <div class="panel-body">


                <table class="dataTablewithoutTri table table-striped table-condensed table-bordered">
                    <thead>
                    <tr>
                        <th>Nom</th>
                        <th>min</th>
                        <th>Max</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
            {/if}
            <tr>
                <td>{$fo->getName()}</td>
                <td>{$fo->getValMin()}</td>
                <td>{$fo->getValMax()}</td>
                <td>

                    <!-- Split button -->
                    <div class="btn-group">
                        <a href="{Tools::create_url($user,'export_site','updFp',$fo->getId())}"  class="btn btn-default btn-xs"><i class="fa fa-pencil-square-o"></i> {Lang::LABEL_UPDATE}</a>
                        <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{Tools::create_url($user,'export_site','delFp',$fo->getId())}"><i class="fa fa-trash"></i> Supprimer</a></li>

                        </ul>
                    </div>
                </td>
            </tr>



            {assign var="tt" value=$fo->getTransactionType()->getId()}
            {assign var="tb" value=$fo->getMandateType()->getId()}


            {/foreach}


            </tbody>
        </table>
            </div>
        </div>

        </div>
        </div><!-- Fin row -->

        <!-- Fin onglet prix -->
    </div>
    <div id="surfaces">
<p>
        <a href="{Tools::create_url($user,'export_site','addFt')}" class="btn btn-default"><i class="fa fa-plus-circle"></i> Ajouter une tranche</a>
</p>

        {*Foreach sur la liste *}
        {assign var="tt" value=''}
        {assign var="tb" value=''}



        {$count =0}
        {foreach name="boucle" from=$fourchettesSurface item="fo"}


        {if $tt neq $fo->getTransactionType()->getId() || $fo->getMandateType()->getId() neq $tb}

        {if !$smarty.foreach.boucle.first}
            </tbody>
            </table>
    </div>
    </div>
    </div>
    {if $count==1}
        </div> <!-- fin row -->
        {$count = 0}
    {/if}
        {/if}
{if $count==0}
<div class="row">
    {/if}
    <!-- {$count++}-->
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">{$fo->getTransactionType()->getName()} {$fo->getMandateType()->getName()}</h3>
            </div>
            <div class="panel-body">
                <table class="dataTablewithoutTri table table-striped table-condensed table-bordered">
            <thead>
            <tr>
                <th>Nom</th>
                <th>min</th>
                <th>Max</th>
                <th>actions</th>

            </tr>
            </thead>
            <tbody>
            {/if}
            <tr>
                <td>{$fo->getName()}</td>
                <td>{$fo->getValMin()}</td>
                <td>{$fo->getValMax()}</td>
                <td>
                    <!-- Split button -->
                    <div class="btn-group">
                        <a href="{Tools::create_url($user,'export_site','updFt',$fo->getId())}"  class="btn btn-default btn-xs"><i class="fa fa-pencil-square-o"></i> {Lang::LABEL_UPDATE}</a>
                        <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{Tools::create_url($user,'export_site','delFt',$fo->getId())}"><i class="fa fa-trash"></i> Supprimer</a></li>

                        </ul>
                    </div>
                </td>

            </tr>



            {assign var="tt" value=$fo->getTransactionType()->getId()}
            {assign var="tb" value=$fo->getMandateType()->getId()}


            {/foreach}

            </tbody>
        </table>
</div>
</div>

</div>
</div><!-- Fin row -->

    </div> <!-- Fin onglet prix -->

</div>

</div>
