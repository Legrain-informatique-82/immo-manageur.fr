{include file="tpl_default/entete.tpl"}
<form action="" method="post" {* enctype="multipart/form-data"*}  role="form" class="form-horizontal">
<div class="row bg-success bannerTitle">
    <div class="col-md-6">
        <h1 class="h2">Ajouter un mandat</h1>
    </div>
    <div class="col-md-6">
        <p class="h4 text-right ">
            <button class="btn btn-success" type="submit" name="terrain_add_submit" title="{Lang::LABEL_ADD_TERRAIN_AND_REDIRECT_SAVE}">
                <i class="fa fa-save fa-2x"></i>
            </button>
            <a title="fermer" class="btn btn-default" href="{Tools::create_url($user,"mandat","list")}">
                <i class="fa fa-close fa-2x"></i>
            </a>
        </p>
    </div>
</div>

{include file="tpl_default/error.tpl"}


	
	{if !empty($listUser)}
	<fieldset>
		<legend>Utilisateur</legend>

        <div class="form-group">
			<label class="col-sm-2 control-label" for="idUser">Utilisateur affecté au mandat : </label>
            <div class="col-sm-8">
            <select class="form-control" name="idUser" id="idUser">
				{foreach from=$listUser item=item}
				<option {if $item->getIdUser() eq $idUser}selected="selected"
					{/if}value="{$item->getIdUser()}">{$item->getFirstname()}
					{$item->getName()}</option> {/foreach}
			</select>
                </div>
		</div>
	</fieldset>
	{/if} {* Apparait à tout le monde*}
	<fieldset>
		<legend>Général</legend>
        <div class="form-group">
            <label class="col-sm-2 control-label"  for="typeTransaction">Type de transaction :</label>
            <div class="col-sm-8">
                <select class="form-control"
				name="typeTransaction" id="typeTransaction"> {foreach
					from=$listTypeTransaction item=tt}
					<option {if $tt->getIdTransactionType() eq $typeTransaction}
						selected="selected" {/if}
						value="{$tt->getIdTransactionType()}">{$tt->getName()}</option>
					{/foreach}
			</select>
                </div>
		</div>

            <div class="form-group">
			<label class="col-sm-2 control-label"  for="typeBien">Type de bien : </label>
                <div class="col-sm-8">
                <select name="typeBien" class="form-control"
				id="typeBien"> {foreach from=$listTypeBien item=tb} {if
					$tb->getIdMandateType() neq Constant::ID_PLOT_OF_LAND}
					<option {if $tb->getIdMandateType() eq $typeBien}
						selected="selected" {/if}
						value="{$tb->getIdMandateType()}">{$tb->getName()}</option> {/if}
					{/foreach}
			</select>
                    </div>
		</div>

                <div class="form-group">
                    <label class="col-sm-2 control-label"  for="nature">Nature du bien : </label>
                    <div class="col-sm-8">
                    <select name="nature" class="form-control"
				id="nature"> {foreach from=$listNature item=tb}

					<option {if $tb->getIdMandateNature() eq $nature}
						selected="selected" {/if}
						value="{$tb->getIdMandateNature()}">{$tb->getName()}</option>

					{/foreach}
			</select>
                        </div>
		</div>

	</fieldset>
	{if $smarty.post.idSeller && $smarty.post.used} <input type="hidden"
		name="idSeller" value="{$smarty.post.idSeller}" /> <input
		type="hidden" name="used" value="{$smarty.post.used}" /> {else}
	<fieldset>
		<legend>Vendeur principal</legend>
		{include file='seller/views/frm_add_seller.tpl'}
	</fieldset>
	{/if}


	<fieldset>
		<legend>Infos mandat</legend>
		{if !empty($listNotary)}
        <div class="form-group">
			<label class="col-sm-2 control-label"  for="idNotary">Notaire vendeur :</label>
            <div class="col-sm-8">
                <select name="idNotary" id="idNotary" class="form-control">
                {foreach from=$listNotary item=item}
				    <option {if $item->getIdNotary() eq $idNotary}selected="selected" {/if}value="{$item->getIdNotary()}"> {$item->getName()}</option>
				{/foreach}
			    </select>
            </div>
		</div>
		{/if}
		{if !empty($listNotary)}
         <div class="form-group">
			<label class="col-sm-2 control-label"  for="idNotaryAcq">Notaire acquereur :</label>
                <div class="col-sm-8">
                    <select name="idNotaryAcq" id="idNotaryAcq" class="form-control">
			            <option value="">NC</option>
			            {foreach from=$listNotary item=item}
				        <option {if $item->getIdNotary() eq $idNotaryAcq}selected="selected" {/if}value="{$item->getIdNotary()}"> {$item->getName()}</option>
				        {/foreach}
			        </select>
                </div>
		</div>
		{/if}
                <div class="form-group">
			<label class="col-sm-2 control-label"  for="numMandat">N° Mandat : </label>
                    <div class="col-sm-8">
                        <input type="text" name="numMandat" id="numMandat" class="form-control" value="{$numMandat}" />
		            </div>
                </div>

           <div class="form-group">
			<label class="col-sm-2 control-label"  for="debutMandat">Début :</label>
                        <div class="col-sm-8">
                            <input class="datepicker form-control" type="text" name="debutMandat" id="debutMandat" value="{$debutMandat}" />
                        </div>

		</div>
                        <div class="form-group">
			<label class="col-sm-2 control-label"  for="finMandat">Fin : </label>
                            <div class="col-sm-8">
                            <input class="datepicker form-control" type="text" name="finMandat"
				id="finMandat" value="{$finMandat}" />
		</div></div>
                            <div class="form-group">
			<label class="col-sm-2 control-label"  for="libreMandat">libre le : </label><div class="col-sm-8"><input class="datepicker form-control" type="text" name="libreMandat"
				id="libreMandat" value="{$libreMandat}" /></div>
		</div>
         <div class="form-group">
               <label class="col-sm-2 control-label"  for="numberlot">Numéro de lot : </label><div class="col-sm-8"><input type="text" name="numberlot" id="numberlot"  value="{$numberlot}" class="form-control"/></div>
             </div>

	</fieldset>

	<fieldset>
		<legend>Biens</legend>
		<fieldset>
			<legend>Localisation</legend>
            <div class="form-group">
				<label class="col-sm-2 control-label"  for="adresseMandat">Adresse : </label>
                <div class="col-sm-8">
                <input type="text" name="adresseMandat" id="adresseMandat" class="form-control input-lg" value="{$adresseMandat}" />
                    </div>
			</div>
			{if !empty($listCity)}
                <div class="form-group">
			<label class="col-sm-2 control-label"  for="idCity">Ville : </label>
                    <div class="col-sm-8">
				<select name="idCity" id="idCity" class="form-control"> {foreach from=$listCity
					item=item}
					<option {if $item->getIdCity() eq $idCity}selected="selected"
						{/if}value="{$item->getIdCity()}"> {$item->getZipCode()} -
						{$item->getName()}</option> {/foreach}
				</select>
			</div>
                    </div>
			{/if}
		</fieldset>
		<fieldset class="cinquante">
			<legend>Prix</legend>

            <div class="form-group">
				<label class="col-sm-2 control-label"  for="prixFai"><span id="jsPrixFai">Prix FAI</span> : </label>
                <div class="col-sm-8">
                <input type="text"
					name="prixFai" id="prixFai" value="{$prixFai}" class="form-control" />
                    </div>
			</div>
                <div class="form-group">
				<label class="col-sm-2 control-label"  for="prixNetVendeur"><span id="jsPrixNetVendeur">Prix net vendeur</span> :</label>
                    <div class="col-sm-8">
                    <input class="form-control"
					type="text" name="prixNetVendeur" id="prixNetVendeur"
					value="{$prixNetVendeur}" />
			</div>
                    </div>
                    <div class="form-group" id="jsCommission">
				<label class="col-sm-2 control-label"  for="commissionMandat">Commission : </label>
                        <div class="col-sm-8">
                        <input type="text" name="commissionMandat" class="form-control"
					id="commissionMandat" value="{$commissionMandat}" />
			</div>
                        </div>
            <div class="form-group"  id="jsEstim">
				<label class="col-sm-2 control-label"  for="estimationFai">Estimation FAI Mini : </label>
            <div class="col-sm-8">
                <input type="text" name="estimationFai" class="form-control"
					id="estimationFai" value="{$estimationFai}" />
			</div></div>
            <div class="form-group" id="jsEstimMaxi">
			<label class="col-sm-2 control-label"  for="estimationMaxi">	Estimation FAI Maxi :</label>
                <div class="col-sm-8">
                <input type="text" name="estimationMaxi" class="form-control"
					id="estimationMaxi" value="{$estimationMaxi}" />
			</div>
                </div>
                <div class="form-group" id="jsMargeNegoce">
				<label class="col-sm-2 control-label"  for="margeNegoce">Marge negoce :</label>
                    <div class="col-sm-8">
                    <input type="text" name="margeNegoce" class="form-control"
					id="margeNegoce" value="{$margeNegoce}" />
			</div></div>

                    <div class="form-group" id="jsRental">
		
		<label class="col-sm-2 control-label"  for="rental">
		Loyer actuel (si locataires ) :</label>
                        <div class="col-sm-8">
                        <input type="text" name="rental" id="rental" value="{$rental}" class="form-control"/>
                            </div>
		</div>
                        <div class="form-group"><label class="col-sm-2 control-label"  for="pricegarage">Prix garage : </label>
                            <div class="col-sm-8">
                            <input type="text" name="pricegarage" id="pricegarage" value="{$pricegarage}" class="form-control"/></div></div>
                            <div class="form-group"><label class="col-sm-2 control-label"  for="pricecellar">Prix Cave : </label><div class="col-sm-8"><input type="text" name="pricecellar" id="pricecellar" value="{$pricecellar}" class="form-control"/></div></div>
                                <div class="form-group"><label class="col-sm-2 control-label"  for="profitability">Rentabilité en % :</label><div class="col-sm-8"><input type="text" name="profitability" id="profitability" value="{$profitability}" class="form-control"/> </div></div>
		</fieldset>

		<fieldset class="cinquante">
			<legend>Cadastre</legend>
            <div class="form-group">
			<label class="col-sm-2 control-label"  for="refCadastre1">	Ref cadastre parcelle 1 :</label>
                <div class="col-sm-8">
                <input type="text" name="refCadastre1"
					id="refCadastre1" value="{$refCadastre1}" class="form-control"/>
			</div>
</div>
			
		</fieldset>
    </fieldset>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-8">
                <button type="submit" value="{Lang::LABEL_ADD_TERRAIN_CONTINUE_SAVE}" name="terrain_add_submit_and_continue" class="btn btn-success">
                    <i class="fa fa-save"></i> {Lang::LABEL_ADD_TERRAIN_CONTINUE_SAVE}
                </button>

                <button type="submit" value="{Lang::LABEL_ADD_TERRAIN_AND_REDIRECT_SAVE}" name="terrain_add_submit" class="btn btn-success">
                    <i class="fa fa-save"></i> {Lang::LABEL_ADD_TERRAIN_AND_REDIRECT_SAVE}
                </button>

                <a title="fermer" class="btn btn-default" href="{Tools::create_url($user,"mandat","list")}">
                    <i class="fa fa-close"></i> Annuler et fermer
                </a>
            </div>
        </div>


</form>
</div>
