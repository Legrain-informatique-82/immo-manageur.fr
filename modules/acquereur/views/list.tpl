{include file="tpl_default/entete.tpl"}

<div class="row bg-success bannerTitle">
    <div class="col-md-6">
        <h1 class="h2">Liste des acquereurs</h1>
    </div>

    <div class="col-md-6">
        <p class="h4 text-right ">
            <a title="Ajouter un mandat" class="btn btn-success" href="{Tools::create_url($user,"acquereur","add")}">
                <i class="fa fa-plus-circle fa-2x"></i>
            </a>
        </p>
    </div>
</div>

<table class="dataTableDefault table table-striped table-bordered">
    <thead>
    <tr class="tri">
        <th class="jshide"></th>
        <th></th>
        <th></th>
        <th class="jshide"></th>
        <th class="jshide"></th>
        <th></th>
        <th class="jshide"></th>
    </tr>
    <tr>
        <th>Nom &amp; prénom</th>
        <th>Titre</th>
        <th>Opérateur lié</th>
        <th>téléphones</th>
        <th>email</th>
        <th>Etat</th>
        <th>Actions</th>

    </tr>
    </thead>
    <tbody>
    {foreach from=$listAcq item=item}
        <tr>
            <td>{$item->getName()} {$item->getFirstname()}</td>
            <td>{$item->getTitreAcquereur()->getName()}</td>
            <td>{$item->getUser()->getFirstname()} {$item->getUser()->getName()}
            </td>
            <td>{if $item->getPhone()}
                    <p>{Lang::LABEL_SELLER_ADD_PHONE}{$item->getPhone()}</p>{/if} {if
                $item->getMobilPhone()}
                    <p>{Lang::LABEL_SELLER_ADD_MOBIL_PHONE}{$item->getMobilPhone()}
                    <a href="{Constant::DEFAULT_URL}/modules/openmail/formFancybox/sendSms.php?{time()}&amp;dest={str_replace('+','%2B',$item->getMobilPhone())}" class="fancyboxAjax fancybox.ajax btn btn-default" title="Envoyer un Sms"> <i class="fa fa-mobile-phone fa-2x"></i> </a> </p>{/if}
                {if $item->getWorkPhone()}
                    <p>{Lang::LABEL_SELLER_ADD_WORK_PHONE}{$item->getWorkPhone()}</p>{/if}
            </td>
            <td>{if $item->getEmail()}{$item->getEmail()} <a href="{Constant::DEFAULT_URL}/modules/openmail/formFancybox/sendEmail.php?{time()}&amp;dest={$item->getEmail()}" class="fancyboxAjax fancybox.ajax btn btn-default" title="Envoyer un e-mail"><i class="fa fa-paper-plane"></i></a>{/if}</td>

            <td>{if $item->getActif()}Actif{else}Inactif{/if}</td>

            <td>

                <div class="btn-group">
                    <a class="btn btn-default" href="{Tools::create_url($user,'acquereur','see',$item->getIdAcquereur())}" {if $user->getOpenInNewTab()} target="_blank"{/if}><i class="fa fa-chevron-circle-right"></i> Fiche </a>
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">

                        {if $item->getUser()->getIdUser() eq $user->getIdUser() || $user->getLevelMember()->getIdLevelMember() < 3}
                            <li>
                                <a href="{Tools::create_url($user,'acquereur','update',$item->getIdAcquereur())}" title="{Lang::LABEL_UPDATE}">
                                    <i class="fa fa-pencil-square-o"></i> {Lang::LABEL_UPDATE}
                                </a>
                            </li>
                        {else}
                            <li class="disabled">
                                <a href="javasctipt:return false;">
                                    <i class="fa fa-pencil-square-o"></i> {Lang::LABEL_UPDATE}/a>
                                </a>
                            </li>
                        {/if}

                        {if $item->getUser()->getIdUser() eq $user->getIdUser() || $user->getLevelMember()->getIdLevelMember() < 3}
                            <li>
                                <a class="jsDelAcquereur" rel="{$item->getIdAcquereur()}"  href="{Tools::create_url($user,'acquereur','delete',$item->getIdAcquereur())}" title="{Lang::LABEL_DELETE}">
                                    <i class="fa fa-trash"></i> {Lang::LABEL_DELETE}
                                </a>
                            </li>
                        {else}
                            <li class="disabled">
                                <a href="javascript:return false;"></a>
                            </li>

                        {/if}

                        {include file="tpl_default/menu_send_sms_mail.tpl" email=$item->getEmail() phonenumber=$item->getMobilPhone()}
                    </ul>

                </div>



                {*

                {if $item->getUser()->getIdUser() eq $user->getIdUser() ||
				$user->getLevelMember()->getIdLevelMember() < 3} <a
				href="{Tools::create_url($user,'acquereur','update',$item->getIdAcquereur())}" title="{Lang::LABEL_UPDATE}"><img src="{Constant::DEFAULT_URL_PICTURE_DIRECTORY}update.png" alt="{Lang::LABEL_UPDATE}" /></a>
				{else} _ {/if}
				*}
            </td>
            {*
            <td>{if $item->getUser()->getIdUser() eq $user->getIdUser() ||
                $user->getLevelMember()->getIdLevelMember() < 3} <a
                class="jsDelAcquereur" rel="{$item->getIdAcquereur()}"
                href="{Tools::create_url($user,'acquereur','delete',$item->getIdAcquereur())}" title="{Lang::LABEL_DELETE}"><img src="{Constant::DEFAULT_URL_PICTURE_DIRECTORY}delete.png" alt="{Lang::LABEL_DELETE}" /></a>
                {else} _ {/if}</td>
            <td><a
                href="{Tools::create_url($user,'acquereur','see',$item->getIdAcquereur())}" title="{Lang::LABEL_SEE}" {if $user->getOpenInNewTab()} target="_blank"{/if}><img src="{Constant::DEFAULT_URL_PICTURE_DIRECTORY}see.png" alt="{Lang::LABEL_SEE}" /></a>

            </td>
*}
        </tr>
    {/foreach}
    </tbody>
</table>
</div>
