


<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">Affiches</div>
            <div class="panel-body">
                <ul>


                    <li><a target="_blank" href="{Tools::create_url($user,'documents','afficheTerrain',$smarty.get.action)}">Affiche
                            classique</a></li>
                    <li><a target="_blank" href="{Tools::create_url($user,'documents','afficheTerrainExclu',$smarty.get.action)}">Affiche
                            exclu</a>
                    </li>
                    <li><a target="_blank" href="{Tools::create_url($user,'documents','afficheTerrainNouv',$smarty.get.action)}">Affiche
                            nouveauté</a>
                    </li>
                    <li><a target="_blank" href="{Tools::create_url($user,'documents','afficheTerrainVendu',$smarty.get.action)}">Affiche
                            vendu</a>
                    </li>

                </ul>
            </div>
        </div>
    </div>




    <div class="col-md-6">



        <div class="panel panel-default">

            <div class="panel-heading">Documents mandat</div>
            <div class="panel-body">

                <ul>
                    <li><a target="_blank"
                           href="{Tools::create_url($user,'documents','fiche_photo',$smarty.get.action)}">Fiche photo</a></li>
                    <li><a target="_blank" href="{Tools::create_url($user,'documents','fiche_acq',$smarty.get.action)}">Fiche acquereur</a></li>


                </ul>
            </div>
        </div>

    </div>

</div>
<div class="row">

    {$cat=CeciNestPasUneCategorie}
    {counter start=0 print=false assign=count}

    {foreach from=$newDocs item=d name="listCat"}
    {if $cat neq $d->getCategoryDocument()->getName()}
    {$cat=$d->getCategoryDocument()->getName()}
    {counter}
    {if !$smarty.foreach.listCat.first}
    </ul>
</div>
</div></div>
{if $count %2 !== 0}
</div>
<div class="row">
    {/if}
    {/if}
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">{$cat}</div>
            <div class="panel-body">
                <ul>
                    {/if}
                    <li><a target="_blank" href="{Tools::create_url_whith_other_parameters($user,'documents','printDoc',$d->getIdDocuments(),$arrayParametersLinks)}"> {$d->getName()}</a></li>
                    {/foreach}
                </ul>
            </div></div></div>

</div>