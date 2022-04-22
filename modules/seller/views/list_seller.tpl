{include file="tpl_default/entete.tpl"}


<div class="row bg-success bannerTitle">
    <div class="col-md-6">
        <h1 class="h2">{Lang::LABEL_SELLER_LIST_H1}</h1>
    </div>

    <div class="col-md-6">
        <p class="h4 text-right ">
            <a title="Ajouter un vendeur" class="btn btn-success" href="{Tools::create_url($user,"seller","adds")}">
                <i class="fa fa-plus-circle fa-2x"></i>
            </a>
        </p>
    </div>
</div>

{*
<form action="" method="post" class="form-inline" role="form">
    <div class="checkbox">
        <label for="seeAsset">Afficher les inactifs : <input
                    {if $smarty.post.seeAsset eq 'on'} checked="checked"
                                                       {/if}type="checkbox" value="on" name="seeAsset" id="seeAsset" />

        </label>

        <input type="submit" name="actSeeAsset" value="actualiser" class="jsNone btn btn-default" />
    </div>
*}

</form>
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
    {foreach from=$list item=item}
        <tr>
            <td>{$item.name}</td>
            <td>{$item.title}</td>
            <td>{$item.user}</td>
            <td>{if $item.phone.phone}
                    <p>{Lang::LABEL_SELLER_ADD_PHONE}{$item.phone.phone}</p>{/if}
                {if $item.phone.mobilPhone}
                    <p>{Lang::LABEL_SELLER_ADD_MOBIL_PHONE}{$item.phone.mobilPhone}
                    <a href="{Constant::DEFAULT_URL}/modules/openmail/formFancybox/sendSms.php?{time()}&amp;dest={str_replace('+','%2B',$item.phone.mobilPhone)}" class="fancyboxAjax fancybox.ajax btn btn-default" title="Envoyer un Sms"> <i class="fa fa-mobile fa-2x"></i>  </a> </p>{/if}
                {if $item.phone.workPhone}
                    <p>{Lang::LABEL_SELLER_ADD_WORK_PHONE}{$item.phone.workPhone}</p>{/if}
            </td>

            <td>{if $item.email}{$item.email}
                    <a href="{Constant::DEFAULT_URL}/modules/openmail/formFancybox/sendEmail.php?{time()}&amp;dest={$item.email}" class="fancyboxAjax fancybox.ajax btn btn-default" title="Envoyer un e-mail"> <i class="fa fa-paper-plane"></i></a>

                {/if}</td>
            <td>{if $item.asset}Actif{else}Inactif{/if}</td>
            <td>



                <div class="btn-group">




                    <a class="btn btn-default" href="{$item.urlSee}" {if $user->getOpenInNewTab()} target="_blank"{/if}><i class="fa fa-chevron-circle-right"></i> {Lang::LABEL_SEE} </a>


                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    {if $user->getLevelMember()->getIdLevelMember() eq 1 or $user->getIdUser() eq $u.idUser}
                        <ul class="dropdown-menu" role="menu">

                            {if $item.idUser eq $user->getIdUser() ||
                            $user->getLevelMember()->getIdLevelMember() < 3}
                                <li>
                                    <a href="{$item.urlUpdate}" title="{Lang::LABEL_UPDATE}"><i class="fa fa-pencil-square-o"></i> {Lang::LABEL_UPDATE}</a>
                                </li>
                            {else}
                                <li class="disabled">
                                    <a href="javascript:false;"><i class="fa fa-pencil-square-o"></i> {Lang::LABEL_UPDATE} </a>
                                </li>
                            {/if}


                            {if $item.idUser eq $user->getIdUser() || $user->getLevelMember()->getIdLevelMember() < 3}
                                <li>
                                    <a class="jsdelSeller" rel="{$item.id}" href="{$item.urlDelete}" title="{Lang::LABEL_DELETE}"><i class="fa fa-trash"></i> {Lang::LABEL_DELETE}</a>
                                </li>

                                {else}
                                <li class="disabled">
                                    <a  href="javascript:return false;" ><i class="fa fa-trash"></i> {Lang::LABEL_DELETE}</a>
                                </li>
                            {/if}

                            {include file="tpl_default/menu_send_sms_mail.tpl" email=$item.email phonenumber=$item.phone.mobilPhone}

                        </ul>
                    {/if}
                </div>



            </td>
            {*
            <td>{if $item.idUser eq $user->getIdUser() ||
                $user->getLevelMember()->getIdLevelMember() < 3} <a
                class="jsdelSeller" rel="{$item.id}" href="{$item.urlDelete}" title="{Lang::LABEL_DELETE}"><img src="{Constant::DEFAULT_URL_PICTURE_DIRECTORY}delete.png" alt="{Lang::LABEL_DELETE}" /></a>
                {else} _ {/if}</td>
            <td>{if $item.idUser eq $user->getIdUser() ||
                $user->getLevelMember()->getIdLevelMember() < 3} <a
                href="{$item.urlSee}" {if $user->getOpenInNewTab()} target="_blank"{/if}><img src="{Constant::DEFAULT_URL_PICTURE_DIRECTORY}see.png" alt="{Lang::LABEL_SEE}" /></a> {else} _ {/if}</td>
*}
        </tr>
    {/foreach}
    </tbody>
</table>
</div>
