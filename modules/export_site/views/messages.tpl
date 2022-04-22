{include file="tpl_default/entete.tpl"}


<form action="" method="post" class="form-horizontal" role="form">

    <div class="row bg-success bannerTitle">
        <div class="col-md-6">
            <h1 class="h2">Gestion des messages</h1>
        </div>

        <div class="col-md-6">

            <p class="h4 text-right ">

                <button type="submit" name="send" value="Valider" class="btn btn-success" title="Sauvegarder">
                    <i class="fa-save fa fa-2x"></i>
                </button>


            </p>
        </div>
    </div>




    {foreach from=$variables item=var}
        {if $var->getType() eq 'text'}
            <div class="form-group">
                <label class="col-sm-2 control-label" for="v_{$var->getId()}">{$var->getLabel()}</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="v_{$var->getId()}" id="v_{$var->getId()}" value="{$var->getValue()}"/>
                </div>
            </div>
        {elseif $var->getType() eq 'textarea'}
            <div class="form-group">
                <label class="col-sm-2 control-label" for="v_{$var->getId()}">{$var->getLabel()}</label>
                <div class="col-sm-8">
                    <textarea class="form-control" name="v_{$var->getId()}" id="v_{$var->getId()}" cols="30" rows="10">{$var->getValue()}</textarea>
                </div>
            </div>
        {elseif $var->getType() eq 'serialize'}
            {if $var->getExportName() eq 'TYPES_VENTE_LOCATION'}

                {assign var=typesSelected value=unserialize($var->getValue())}





                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <p class="help-block">{$var->getLabel()} : </p>
                    {foreach name="boucle" from=$types item=i}
                        {if $smarty.foreach.boucle.first}
                            <label for="che_0" class="checkbox-inline">
                                <input {if $typesSelected}{if array_key_exists(0,$typesSelected)} checked="checked"{/if}{/if} type="checkbox" name="che_{$var->getId()}[]" id="che_0" value="0" /> {ucfirst(strtolower(Lang::TYPE_EXPORT_SITE_DEFAULT))}
                            </label>

                        {/if}
                        <label for="che_{$i->getIdMandateType()}" class="checkbox-inline">
                            <input {if $typesSelected}{if array_key_exists($i->getIdMandateType(),$typesSelected)} checked="checked"{/if}{/if}  type="checkbox" name="che_{$var->getId()}[]" id="che_{$i->getIdMandateType()}" value="{$i->getIdMandateType()}"/>
                            {ucfirst(strtolower($i->getName()))}
                        </label>
                    {/foreach}
                        </div>
                </div>
            {/if}
        {/if}
    {/foreach}
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" name="send" value="Valider" class="btn btn-success">
                <i class="fa fa-save"></i> Sauvegarder
            </button>

        </div>
    </div>
</form>
</div>
