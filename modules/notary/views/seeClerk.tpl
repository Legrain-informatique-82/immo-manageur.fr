{include file="tpl_default/entete.tpl"}




<div  class="row bg-success bannerTitle">
    <div class="col-md-6">
        <h1 class="h2">Fiche du clerc du notaire {$clerk->getNotary()->getName()}</h1>
    </div>
    <div class="col-md-6">
        <p class="h4 text-right ">


            <a title="Fermer la fiche" class="btn btn-default" href="{Tools::create_url($user,'notary','see',$clerk->getNotary()->getIdNotary())}"><i class="fa fa-times fa-2x"></i></a>

            {if $user->getLevelMember()->getIdLevelMember() <= 2}
                <a title="Modifier" class="btn btn-warning" href="{$urlUpdate}"><i class="fa fa-pencil-square-o fa-2x"></i></a> <a title="Supprimer" class="btn btn-danger" href="{$urlDelete}"><i class="fa fa-trash fa-2x"></i></a>
            {/if}
        </p>
    </div>
</div>




<dl class="dl-horizontal">
    <dt>Nom :</dt>
    <dd>{$clerk->getName()}</dd>
    <dt>Prénom :</dt>
    <dd>{$clerk->getFirstname()}</dd>
    <dt>Adresse :</dt>
    <dd>
        {$clerk->getAddress()}<br>
        {$clerk->getZipCode()} {$clerk->getCity()}
    </dd>
    <dt>Tél. : </dt>
    <dd>{$clerk->getPhone()}</dd>
    <dt>Tél. port. : </dt>
    <dd>{if $clerk->getMobilPhone()}{$clerk->getMobilPhone()} <a title="Envoyer un SMS" href="{Constant::DEFAULT_URL}/modules/openmail/formFancybox/sendSms.php?{time()}&amp;dest={str_replace('+','%2B',$clerk->getMobilPhone())}" class="fancyboxAjax fancybox.ajax btn btn-default"> <i class="fa fa-mobile fa-2x"></i>  </a>{else}NC{/if}</dd>
    <dt>Tél pro. : </dt>
    <dd>{$clerk->getJobPhone()}</dd>
    <dt>Fax :</dt>
    <dd>{$clerk->getFax()}</dd>
    <dt>Email : </dt>
    <dd>{if $clerk->getEmail()}{$clerk->getEmail()}  <a href="{Constant::DEFAULT_URL}/modules/openmail/formFancybox/sendEmail.php?{time()}&amp;dest={$clerk->getEmail()}" class="fancyboxAjax fancybox.ajax btn btn-default" title="Envoyer un e-mail"><i class="fa fa-paper-plane"></i></a>{/if}</dd>
    <dt>Commentaire :</dt>
    <dd>{$clerk->getComments()}</dd>
</dl>

</div>