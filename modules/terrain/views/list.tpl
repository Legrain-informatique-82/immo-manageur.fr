{include file="tpl_default/entete.tpl"}
<div class="row bg-success bannerTitle">
    <div class="col-md-6">
        <h1 class="h2">Liste des terrains : {$nameOfEtap}</h1>
    </div>

    <div class="col-md-6">
        <p class="h4 text-right ">
            <a title="Ajouter un terrain" class="btn btn-success" href="{Tools::create_url($user,"terrain","preadd")}">
                <i class="fa fa-plus-circle fa-2x"></i>
            </a>
        </p>
    </div>
</div>


{foreach name="listMenuTrois" from=$listElem item=item} {if
$smarty.foreach.listMenuTrois.first}
    <ul class="nav nav-tabs nav-justified" role="tablist">
{/if}
    <li {if $item.name eq $nameOfEtap}class="active"{/if}>
        <a href="{$item.url}">{$item.name}</a>
    </li>
    {if $smarty.foreach.listMenuTrois.last}
        </ul>
    {/if}
{/foreach}


<form action="" method="post" role="form" class="form-inline">
    <p></p>
    {*
    <p class="mSep">
        <label for="confidentialMode"> Mode confidentiel<input type="checkbox"
                    {if $smarty.post.confidentialMode eq 'ok' or
                    empty($smarty.post)} checked="checked" {/if} value="ok"
                                                               name="confidentialMode" id="confidentialMode" /> </label> <input
                type="submit" name="toogleConfidentialMode" value="Ok" />
    </p>
*}
    <div class="text-right" >

        <div class="form-group">
            <label for="agency">Voir les mandats de :
            </label>
            <select name="agency"
                    id="agency" class="form-control">
                <option value="ALL" {if $agency eq 'ALL'} selected="selected"{/if}>Toute
                    les agences</option> {foreach from=$listAgency item=a}
                    <option value="{$a->getIdAgency()}" {if $agency eq $a->getIdAgency()}
                        selected="selected" {/if}>l'agence de {$a->getName()}</option>
                {/foreach}
            </select>

            <input type="submit" name="toogleConfidentialMode" value="Ok" class="btn btn-default" />
        </div>
    </div>



</form>

<p>
    <span class="text-warning">En orange, les mandats dont la date de création est comprise entre {Constant::N_DAYS_AFTER_WARRANT_CREATION_ALERT_1} et {Constant::N_DAYS_AFTER_WARRANT_CREATION_ALERT_2} jours.</span>
    <br/>
    <span class="text-danger">En rouge, les mandats arrivant à échéance dans {Constant::N_DAYS_BEFORE_WARRANT_EXPIRE_ALERT_1} jours ou moins.</span>
</p>
<div id="miniature" class="bg-info">

</div>

<table class="KeyTable listMandat table table-bordered table-responsive" id="tableMandat">
    <thead>
    <tr class="tri">
        <th class="jshide"></th>
        <th class="jshide"></th>
        <th ></th>
        <th></th>
        <th></th>
        <th ></th>
        <th></th>
        <th></th>
        <th></th>
        <th class="jshide"></th>
    </tr>
    <tr>
        <th></th>
        <th>infos diverses cachées</th>
        <th>Prix (FAI en euros)</th>

        <th>Ref mandat</th>
        <th>Surface terrain</th>
        <th>Code postal</th>
        <th>Ville</th>
        <th>Secteur</th>
        <th>Opérateur lié</th>
        {*{if $smarty.post.confidentialMode neq 'ok'
        and !empty($smarty.post)}
            <th>Nature</th>
            <th>Nom &amp; prénom du vendeur</th>
            <th>Coordonnées vendeur par defaut</th> {/if}
            *}
        <th>Actions</th>


    </tr>
    </thead>
    <tbody>
    {foreach from=$listMandat item=item}
        <tr rel="{$item.obj->getIdMandate()}"  {if date('Ymd', strtotime(date('Y-m-d',$item.obj->getDeadDate())|cat:" - "|cat:Constant::N_DAYS_BEFORE_WARRANT_EXPIRE_ALERT_1|cat:"days")) <= date('Ymd')}
            class="text-danger"
        {/if}
                {if (date('Ymd', strtotime(date('Y-m-d',$item.obj->getInitDate())|cat:" + "|cat:Constant::N_DAYS_AFTER_WARRANT_CREATION_ALERT_1|cat:"days")) <= date('Ymd'))
        &&
        (date('Ymd') <= date('Ymd', strtotime(date('Y-m-d',$item.obj->getInitDate())|cat:" + "|cat:Constant::N_DAYS_AFTER_WARRANT_CREATION_ALERT_2|cat:"days")))}
            class="text-warning"
                {/if}>

            <td></td>

            <td>
                {*TD masqué, ne s'affiche pas *}
                {if $item.obj->getNature()!=null}{$item.obj->getNature()->getName()}{/if}
                {$item.obj->getDefaultSeller()->getFirstname()}
                {$item.obj->getDefaultSeller()->getName()}
                {$item.obj->getDefaultSeller()->getPhone()}
                {$item.obj->getDefaultSeller()->getMobilPhone()}
                {$item.obj->getDefaultSeller()->getWorkPhone()}
                {$item.obj->getDefaultSeller()->getFax()}
                {$item.obj->getDefaultSeller()->getEmail()}

            </td>

            <td data-order="{$item.obj->getPriceFai()}"><b>{Tools::grosNombre(round($item.obj->getPriceFai(),0))} &euro;</b></td>
{*
            <td>
                {if $item.obj->getPictureByDefault()}
                    <img src="{Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY}/{$smarty.get.module}/thumb/{$item.obj->getPictureByDefault()->getName()}" width="100" alt=""/>
                {else}
                    NC
                {/if}
            </td>
*}
            <td class="gras">{$item.obj->getNumberMandate()}</td>
            <td>{if
                $item.obj->getSuperficieTotale()==0}NC{else}{$item.obj->getSuperficieTotale()}{/if}</td>
            <td>
                {$item.obj->getCity()->getZipCode()}</td>
            <td>{$item.obj->getCity()->getName()}</td>
            <td>
                {$item.obj->getSector()->getName()}</td>
            <td>{$item.obj->getUser()->getFirstname()} {$item.obj->getUser()->getName()}</td>

            {*
            {if
            $smarty.post.confidentialMode neq 'ok' and !empty($smarty.post)}
                <td>{if
                    $item.obj->getNature()==null}NC{else}{$item.obj->getNature()->getName()}{/if}</td>

                <td>{if $item.obj->getDefaultSeller()}
                        {$item.obj->getDefaultSeller()->getFirstname()}
                        {$item.obj->getDefaultSeller()->getName()}{/if}</td>
                <td>{if $item.obj->getDefaultSeller()} {if
                    $item.obj->getDefaultSeller()->getPhone()}
                        <p>Téléphone : {$item.obj->getDefaultSeller()->getPhone()}</p>{/if}
                        {if $item.obj->getDefaultSeller()->getMobilPhone()}
                            <p>Téléphone portable:
                            {$item.obj->getDefaultSeller()->getMobilPhone()}
                            <a href="{Constant::DEFAULT_URL}/modules/openmail/formFancybox/sendSms.php?{time()}&amp;dest={str_replace('+','%2B',$item.obj->getDefaultSeller()->getMobilPhone())}" class="fancyboxAjax fancybox.ajax"> <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAABKElEQVRYR+1XOwoCQQzdtRbxJOIh7LVQsbfxEIKgx9ATaGVtby8WXsDe1kp9kR2JIbMOMh/BHQiYsOa9vCTsbJ4lPnli/OynCKyhxiCSIhvgDAmLK3CPBG5gntgVgUoBFwW0ZyimDS2Pf8rtNIQSyPgmOSfBY7b/8UX7igBfIQLnhDS/bLOdCNhWVUptlPDeAlmBrNgQ1AhIueXMOClQNgNlQ+htBlxaYKvUyxaEfD04taAi8F8KJL8RcblXcMaK/lvEej77YruUHgDSEkBL+BPYLTSBBgAusBoDmuH33Cfw28VQJO7A3xUxqpaqpuqDHK0FCyBNYVfYCEZ9D3Y0AlR9G9aF7YMhF4klAer7EdaHnUKDU35JoIlYHXaOAa4RiIX7wkn+cfoA3JFLISd2YxsAAAAASUVORK5CYII=" alt="Envoyer un sms"/></a>
                            </p>{/if} {if
                        $item.obj->getDefaultSeller()->getWorkPhone()}
                            <p>Téléphone travail:
                            {$item.obj->getDefaultSeller()->getWorkPhone()}</p>{/if} {if
                        $item.obj->getDefaultSeller()->getFax()}
                            <p>Fax : {$item.obj->getDefaultSeller()->getFax()}</p>{/if} {if
                        $item.obj->getDefaultSeller()->getEmail()}
                            <p>Email : {$item.obj->getDefaultSeller()->getEmail()} <a href="{Constant::DEFAULT_URL}/modules/openmail/formFancybox/sendEmail.php?{time()}&amp;dest={$item.obj->getDefaultSeller()->getEmail()}" class="fancyboxAjax fancybox.ajax"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAACEklEQVRIS92VS0iUURTHz2PGYkAziDBcJBUhhTQpBpMNDRG4mJE2BRXYg0BX0SaQCFoELQRp1SISehO2NUWMWk3vGMYisGAkiB6iEDigxXzeezpXGnFgchzlW9jdXc45/9/9n3u4F8HnhT7rg/+AcDQeZ6CgH06MlRw27T8kfojnNecBInYCBO8Iil0JEAVJT3yaCDc4nQIHYu3TXzO59tHU8I/lQLZHDtSGOHSfmWMFDqyVcUH7hZH3qJNJMXAy/fzRUDkQd5cIfNudXIy8ApItiLRxzoFexieeqWmQ0PgVnavzTtiAXA1Mb7qQSt3wFgcdqWiM/u4GxHMAogu708n+S7v3tX0kpq3zgJFkf70T2hWNtzLSXUe3Im+9We/YhxdDY8UgOyKt29YGgn1I3OS6AGLa088Gn7hcBWSKAlxwZ3OspmJN1T1iPKiQrBZ2ppODfQsh4ZbEcWC6zoiVYs3w1FTuxNj7xxP5nEUBf5MoHE10IdBl7WtAQTdp+tvZr56Htes2X0OiU1aMJwIXR5IDPVpTMO5LAcxxGvYmIkHGBypYJ2JGxZJ2BOsV+Nl69ui7lwNvirVvyQBXXBeOVa+vrOpVJ4fdXkEPs98nOzKZ19l/DUBZgLxIY0tbpyWx2pLeUiO8LEAp0YXx/w0g5qcA3iqnBaVyWeCMTl61/8+1expA/PlwwH04payuNL76AX8A/oQnJB2c4dAAAAAASUVORK5CYII=" alt="E-mail"/></a> </p>{/if}
                    {else} NC {/if}</td> {/if}
*}
            <td>



                <div class="btn-group">
                    <a class="btn btn-default" href="{$item.urls.see}" {if $user->getOpenInNewTab()} target="_blank"{/if}><i class="fa fa-chevron-circle-right"></i> Fiche </a>
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{$item.urls.duplicate}" title="Dupliquer" {if $user->getOpenInNewTab()} target="_blank"{/if}><i class="fa fa-files-o"></i> Dupliquer</a></li>
                        {include file="tpl_default/menu_send_sms_mail.tpl" email=$item.obj->getDefaultSeller()->getEmail() phonenumber=$item.obj->getDefaultSeller()->getMobilPhone()}
                    </ul>

                </div>

            </td>


        </tr>
    {/foreach}
    </tbody>
</table>
</div>
