{include file='tpl_default/entete.tpl'}
<form action="" method="post" role="form" class="form-horizontal">

    <div class="row bg-success bannerTitle">
        <div class="col-md-6">
            <h1 class="h2">Ajouter une tâche</h1>
        </div>

        <div class="col-md-6">
            <p class="h4 text-right ">

                <button type="submit" name="send" value="Valider" class="btn btn-success" title="Enregistrer">
                    <i class="fa fa-save fa-2x"></i>
                </button>
                <a class="btn btn-default" href="{Tools::create_url($user,'action','list')}" title="Annuler &amp; fermer">
                    <i class="fa fa-close fa-2x"></i>
                </a>
            </p>
        </div>
    </div>


    {include file="tpl_default/error.tpl"}

    {* Affichage de la liste des membres pour "from" si le niveau du membre
    est <=2 *} {if $user->getLevelMember()->getIdLevelMember() < 3}
        <div class="form-group">
            <label class="col-sm-2 control-label" for="from">De :</label>
            <div class="col-sm-8">
                <select class="form-control" name="from" id="from">
                    {foreach from=$listUser item=i}
                        <option {if $from eq $i->getIdUser()} selected="selected" {/if} value="{$i->getIdUser()}"> {$i->getFirstname()} {$i->getName()}</option>
                    {/foreach}
                </select>
            </div>
        </div>
    {/if}
    <div class="form-group">
        <label class="col-sm-2 control-label" for="to">Pour : </label>
        <div class="col-sm-8">
            <select name="to" id="to" class="form-control">
                {foreach from=$listUser item=i}
                    <option {if $to eq $i->getIdUser()} selected="selected" {/if}
                            value="{$i->getIdUser()}"> {$i->getFirstname()} {$i->getName()}</option>
                {/foreach}
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label" for="mandate">Attribué à : </label>
        <div class="col-sm-8">
            <select name="mandate" id="mandate" class="form-control">
                <option value="">Aucun mandat</option>
                {foreach from=$listMandate item=i}
                    <option {if $mandate eq $i->getIdMandate()} selected="selected" {/if} value="{$i->getIdMandate()}"> {$i->getNumberMandate()} {$i->getMandateType()->getName()}</option> {/foreach}
            </select>
        </div>
    </div>



    <div class="form-group">
        <label class="col-sm-2 control-label" for="libel">Libellé : </label>
        <div class="col-sm-8">


            {if $listLibel}
                <div class="row">
                    <div class="col-sm-6">
                        <select class="form-control" name="libelS" id="libelS">
                            <option value="0">...........................</option>
                            {foreach from=$listLibel item=i}
                                <option value="{$i->getLibel()}">{$i->getLibel()}</option>
                            {/foreach}
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <input  class="form-control" type="text" name="libel" id="libel" value="{$libel}" />
                    </div>
                </div>
            {else}
                <input  class="form-control" type="text" name="libel" id="libel" value="{$libel}" />
            {/if}
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label" for="initDate">Date de début de l'action : </label>
        <div class="col-sm-8">
            <input type="text" name="initDate" value="{$initDate}" id="initDate" class="dateTimepicker form-control" />
        </div>
    </div>
    {*
    <p>
        <label for="deadDate">Date de fin de l'action : <input type="text"
            name="deadDate" value="{$deadDate}" id="deadDate"
            class="dateTimepicker" /> </label>
    </p>
    *}
    <div class="form-group">
        <label class="col-sm-2 control-label" for="comment">Détail : </label>
        <div class="col-sm-8">
            <textarea name="comment" id="comment" cols="30" rows="10" class="form-control">{$comment}</textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
            <button type="submit" name="send" value="Valider" class="btn btn-success">
                <i class="fa fa-save"></i> Enregistrer
            </button>
            <a class="btn btn-default" href="{Tools::create_url($user,'action','list')}">
                <i class="fa fa-close"></i> Annuler &amp; fermer
            </a>
        </div>
    </div>
</form>
</div>

