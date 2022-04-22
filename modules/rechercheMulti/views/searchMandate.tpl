{include file='tpl_default/entete.tpl'}
<form action="" method="post" class="form-inline">
    <div class="row bg-success bannerTitle">
        <div class="col-md-12">
            <h1 class="h2">Rechercher de biens</h1>
        </div>
    </div>




    {*
    Si post est présent; il faut recopier les lignes (avant la vide)
    *}




    {if $smarty.post}

        {foreach from=$smarty.post.critere item=it name="boucle"}
            {if $it neq ''}
                {* On boucle sur post *}
                <p class="lineCritere">
                    <select name="critere[]" class="chooseCritereMandate form-control">
                        <option value="" class="empty">_____</option>
                        {foreach from=$listCritere item=i}
                            <option value="{$i->getChampsCorrespondant()}" {if $i->getChampsCorrespondant() eq $it}selected="selected"{/if} class="{if $i->getType()!='list'}{$i->getType()}{else}{$i->getNameTable()}{/if}">{$i->getNom()} </option>
                        {/foreach}
                    </select>

                    {* champs secondaire dans le span*}
                    <span class="complementWithJs">
		 {if $smarty.post.type[$smarty.foreach.boucle.index] eq 'simple'}
             <span class="complementWithJs"><input type="text"  name="val1[]" value="{$smarty.post.val1[$smarty.foreach.boucle.index]}"/> <input type="hidden" name="val2[]" value=""/><input type="hidden" name="type[]" value="{$smarty.post.type[$smarty.foreach.boucle.index]}"/><input type="hidden" name="table[]" value=""/></span>
		{elseif $smarty.post.type[$smarty.foreach.boucle.index] eq 'double'}
			<span class="complementWithJs"><input type="text"  name="val1[]" value="{$smarty.post.val1[$smarty.foreach.boucle.index]}"/> et <input type="text" name="val2[]" value="{$smarty.post.val2[$smarty.foreach.boucle.index]}"/><input type="hidden" name="type[]" value="{$smarty.post.type[$smarty.foreach.boucle.index]}"/><input type="hidden" name="table[]" value=""/></span>
		{elseif $smarty.post.type[$smarty.foreach.boucle.index] eq 'list'}
		<select name="val1[]" class="form-control">
             {foreach from=$listElement[{$smarty.post.table[$smarty.foreach.boucle.index]}] item=elemList}

                 <option  {if $elemList->getId() eq $smarty.post.val1[$smarty.foreach.boucle.index]}selected="selected"{/if} value="{$elemList->getId()}">
                     {if $smarty.post.table[$smarty.foreach.boucle.index] eq 'User'} {$elemList->getFirstname()}{/if}
                     {if $smarty.post.table[$smarty.foreach.boucle.index] eq 'City'} {$elemList->getZipCode()}{/if}
                     {$elemList->getName()}</option>
             {/foreach}
         </select>
             <input type="hidden" name="val2[]" value=""/><input type="hidden" name="type[]" value="list"/><input type="hidden" name="table[]" value="{$smarty.post.table[$smarty.foreach.boucle.index]}"/>
             {* soucis, faire passer les listes correspondantes ... *}
             {* Validation si val2 est de type double il faut vérifier (js uniquement)*}
         {/if}
		</span>
                    {* Fin de champs secondaire *}
                    <a href="#" class="delLineRecherche btn btn-danger" title="Supprimer"><i class="fa fa-trash"></i></a>
                </p>

            {/if}
        {/foreach}


    {/if}
    <hr class="lineCritere"/>

        <div class="form-group ">
            <p class="lineCritere">
                <select class="chooseCritereMandate form-control" name="critere[]">
                    <option value="" class="empty">_____</option>
                    {foreach from=$listCritere item=i}
                        <option value="{$i->getChampsCorrespondant()}" class="{if $i->getType()!='list'}{$i->getType()}{else}{$i->getNameTable()}{/if}">{$i->getNom()}</option>
                    {/foreach}
                </select>
                <span class="complementWithJs"></span>
                <a href="#" class="delLineRecherche btn btn-danger" title="Supprimer"><i class="fa fa-trash"></i></a>
            </p>
        </div>

    <p><a href="#" id="addNewRecherchLine" class="Critere_mandate">Ajouter une nouvelle ligne</a></p>
    <p><input type="submit" value="Rechercher" name="rechercher" /></p>
</form>

{* 
si post est présent, on affiche le tableau de résultat
 *}
{if $smarty.post}
    <form action="" method="post">


        <table class="dataTableDefault table table-striped table-bordered">
            <thead>

            <tr>
                <th>Sélectionner</th>
                <th>Prix (FAI en euros)</th>
                <th>Ref mandat</th>
                <th>Type transaction</th>
                <th>Type bien</th>
                <th>Surface habitable</th>
                <th>Surface terrain</th>
                <th>Nb piece</th>
                <th>Adresse du mandat</th> {if $smarty.post.confidentialMode neq 'ok'
                and !empty($smarty.post)}
                    <th>Nature</th>

                    <th>Nom &amp; prénom du vendeur</th>
                    <th>Coordonnées vendeur par defaut</th> {/if}


                <th>Voir la fiche</th>
            </tr>
            </thead>
            <tbody>
            {foreach from=$resultatsRecherche item=item}
                {* {round($item->getPriceFai(),2)} *}

                <tr rel="{$item->getIdMandate()}">

                    <td><input type="checkbox" name="idSellers[]" value="{$item->getDefaultSeller()->getIdSeller()}"/></td>
                    <td data-order="{$item->getPriceFai()}"><b>{Tools::grosNombre(round($item->getPriceFai(),2))} €</b></td>
                    <td class="gras">{$item->getNumberMandate()}</td>
                    <td>{$item->getTransactionType()->getName()}</td>
                    <td class="gras maj">{$item->getMandateType()->getName()}</td>
                    <td>{if
                        $item->getSurfaceHabitable()==0}NC{else}{$item->getSurfaceHabitable()}{/if}</td>
                    <td>{if
                        $item->getSuperficieTotale()==0}NC{else}{$item->getSuperficieTotale()}{/if}</td>
                    <td>{if
                        $item->getNbPiece()==0}NC{else}{$item->getNbPiece()}{/if}</td>
                    <td>{if $smarty.post.confidentialMode neq 'ok' and
                        !empty($smarty.post)} {$item->getAddress()}<br /> {/if}
                        {$item->getCity()->getZipCode()}
                        {$item->getCity()->getName()}</td> {if
                    $smarty.post.confidentialMode neq 'ok' and !empty($smarty.post)}
                        <td>{if
                            $item->getNature()==null}NC{else}{$item->getNature()->getName()}{/if}</td>

                        <td>{$item->getDefaultSeller()->getFirstname()}
                            {$item->getDefaultSeller()->getName()}</td>

                        <td>{if $item->getDefaultSeller()} {if
                            $item->getDefaultSeller()->getPhone()}
                                <p>Téléphone : {$item->getDefaultSeller()->getPhone()}</p>{/if}
                                {if $item->getDefaultSeller()->getMobilPhone()}
                                    <p>Téléphone portable:
                                    {$item->getDefaultSeller()->getMobilPhone()} <a href="{Constant::DEFAULT_URL}/modules/openmail/formFancybox/sendSms.php?{time()}&amp;dest={str_replace('+','%2B',$item->getDefaultSeller()->getMobilPhone())}" class="fancyboxAjax fancybox.ajax"> <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAABKElEQVRYR+1XOwoCQQzdtRbxJOIh7LVQsbfxEIKgx9ATaGVtby8WXsDe1kp9kR2JIbMOMh/BHQiYsOa9vCTsbJ4lPnli/OynCKyhxiCSIhvgDAmLK3CPBG5gntgVgUoBFwW0ZyimDS2Pf8rtNIQSyPgmOSfBY7b/8UX7igBfIQLnhDS/bLOdCNhWVUptlPDeAlmBrNgQ1AhIueXMOClQNgNlQ+htBlxaYKvUyxaEfD04taAi8F8KJL8RcblXcMaK/lvEej77YruUHgDSEkBL+BPYLTSBBgAusBoDmuH33Cfw28VQJO7A3xUxqpaqpuqDHK0FCyBNYVfYCEZ9D3Y0AlR9G9aF7YMhF4klAer7EdaHnUKDU35JoIlYHXaOAa4RiIX7wkn+cfoA3JFLISd2YxsAAAAASUVORK5CYII=" alt="Envoyer un sms"/></a></p>{/if} {if
                                $item->getDefaultSeller()->getWorkPhone()}
                                    <p>Téléphone travail:
                                    {$item->getDefaultSeller()->getWorkPhone()}</p>{/if} {if
                                $item->getDefaultSeller()->getFax()}
                                    <p>Fax : {$item->getDefaultSeller()->getFax()}</p>{/if} {if
                                $item->getDefaultSeller()->getEmail()}
                                    <p>Email : {$item->getDefaultSeller()->getEmail()} <a href="{Constant::DEFAULT_URL}/modules/openmail/formFancybox/sendEmail.php?{time()}&amp;dest={$item->getDefaultSeller()->getEmail()}" class="fancyboxAjax fancybox.ajax"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAACEklEQVRIS92VS0iUURTHz2PGYkAziDBcJBUhhTQpBpMNDRG4mJE2BRXYg0BX0SaQCFoELQRp1SISehO2NUWMWk3vGMYisGAkiB6iEDigxXzeezpXGnFgchzlW9jdXc45/9/9n3u4F8HnhT7rg/+AcDQeZ6CgH06MlRw27T8kfojnNecBInYCBO8Iil0JEAVJT3yaCDc4nQIHYu3TXzO59tHU8I/lQLZHDtSGOHSfmWMFDqyVcUH7hZH3qJNJMXAy/fzRUDkQd5cIfNudXIy8ApItiLRxzoFexieeqWmQ0PgVnavzTtiAXA1Mb7qQSt3wFgcdqWiM/u4GxHMAogu708n+S7v3tX0kpq3zgJFkf70T2hWNtzLSXUe3Im+9We/YhxdDY8UgOyKt29YGgn1I3OS6AGLa088Gn7hcBWSKAlxwZ3OspmJN1T1iPKiQrBZ2ppODfQsh4ZbEcWC6zoiVYs3w1FTuxNj7xxP5nEUBf5MoHE10IdBl7WtAQTdp+tvZr56Htes2X0OiU1aMJwIXR5IDPVpTMO5LAcxxGvYmIkHGBypYJ2JGxZJ2BOsV+Nl69ui7lwNvirVvyQBXXBeOVa+vrOpVJ4fdXkEPs98nOzKZ19l/DUBZgLxIY0tbpyWx2pLeUiO8LEAp0YXx/w0g5qcA3iqnBaVyWeCMTl61/8+1expA/PlwwH04payuNL76AX8A/oQnJB2c4dAAAAAASUVORK5CYII=" alt="E-mail"/></a></p>{/if}
                            {else} NC {/if}</td> {/if}



                    <td>
                        {if $item->getMandateType()->getIdMandateType() eq Constant::ID_PLOT_OF_LAND}
                            {assign var=typeBien value="terrain"}
                        {else}
                            {assign var=typeBien value="mandat"}
                        {/if}
                        <a href="{Tools::create_url($user,$typeBien,'see',$item->getIdMandate())}" {if $user->getOpenInNewTab()} target="_blank"{/if}><img src="{Constant::DEFAULT_URL_PICTURE_DIRECTORY}see.png" alt="{Lang::LABEL_SEE}" /></a>
                    </td>

                </tr>

            {/foreach}
            </tbody>
        </table>
        <p><input type="submit" value="Envoyer un SMS à la sélection" name="searchMandateSendSms"/>
            <input type="submit" value="Envoyer un E-mail à la sélection" name="searchMandateSendEmail"/></p>
    </form>
{/if}

</div>

