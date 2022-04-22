{*
<div id="listPasserelleForExport">
	<form action="" method="post">
		{foreach from=$listPasserelle item=p}
		<p class="inlineBlock bulle">
			<label for="{$p->getName()}">{$p->getName()}</label> <input type="checkbox"
				{if $p->isLinked($mandate)} checked="checked" {/if}
				name="nomPasserelle[]" value="{$p->getIdPasserelle()}"
				id="{$p->getName()}" /> 
		</p>
		{/foreach}
		<p>
			<input type="submit" name="goListExport" value="Valider" />
		</p>
	</form>
</div>
*}

<form action="" method="post" class="form-inline" role="form">
    <div class="row">
        {foreach from=$listPasserelle item=p}

            <div class="checkbox col-xs-2">
                <label>
                    <input type="checkbox"
                            {if $p->isLinked($mandate)} checked="checked" {/if}
                           name="nomPasserelle[]" value="{$p->getIdPasserelle()}"
                           id="{$p->getName()}" /> {$p->getName()}
                </label>
            </div>


        {/foreach}
    </div>
    <div class="row">
        <div class="form-group col-md-12">

            <button type="submit" name="goListExport" value="Mettre à jour les passerelles" class="btn btn-warning">
                <i class="fa fa-save"></i> Mettre à jour les passerelles
            </button>
        </div>
    </div>
</form>

