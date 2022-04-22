{include file="tpl_default/entete.tpl"}

<div class="row bg-success bannerTitle">
    <div class="col-md-6">
        <h1 class="h2">Fiche de l'acquereur</h1>
    </div>

    <div class="col-md-6">

        <p class="h4 text-right ">
            {if Tools::moduleIsLoad('documents')}

                <a href="{Tools::create_url($user,'documents','ficheCriteresAcquereur',$acq->getIdAcquereur())}" target="_blank"class="btn-default btn" title="Imprimer la fiche">
                    <i class="fa fa-print fa-2x"></i>
                </a>

            {/if}
            <a href="{Tools::create_url($user,$smarty.get.module,'list')}" class="btn-default btn" title="Fermer la fiche">
                <i class="fa fa-close fa-2x"></i>
            </a>

        </p>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Infos utilisateur</h3>
            </div>
            <div class="panel-body">
                <dl >
                    <dt>Utilisateur :</dt><dd>{$acq->getUser()->getFirstname()} {$acq->getUser()->getName()}</dd>
                    <dt>Date d'ajout de l'acquereur :</dt><dd> {if $acq->getDateInsert()}{date(Constant::DATE_FORMAT,$acq->getDateInsert())}{else}NC{/if}</dd>
                </dl>
            </div>
        </div>

    </div>
    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Infos ( acquereur principal)</h3>
            </div>
            <div class="panel-body">
                <dl>
                    <dt>Prénom &amp; nom :</dt><dd>{$acq->getFirstname()} {$acq->getName()} </dd>
                    {if $acq->getMaidenName()}
                        <dt>Nom de jeune fille :</dt><dd> {$acq->getMaidenName()}</dd>
                    {/if}
                    <dt>Adresse :</dt>
                    <dd>
                        <address>
                            {$acq->getAddress()} <br />
                            {$acq->getVilleAcquereur()->getZipCode()}
                            {$acq->getVilleAcquereur()->getName()}
                        </address>
                    </dd>
                    <dt>Date de naissance : </dt><dd>{if $acq->getBirthdate()}{date(Constant::DATE_FORMAT2,$acq->getBirthdate())}{else}NC{/if} </dd>
                    <dt>Lieu de naissance :</dt><dd> {if $acq->getBirthLocation()}{$acq->getBirthLocation()}{else}NC{/if}</dd>
                    <dt>Nationalité :</dt><dd> {if $acq->getNationality()}{$acq->getNationality()}{else}NC{/if}</dd>
                    <dt>Profession : </dt><dd>{if $acq->getJob()}{$acq->getJob()}{else}NC{/if}</dd>
                </dl>
            </div>
        </div>

    </div>
    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Coordonnées ( acquereur principal)</h3>
            </div>
            <div class="panel-body">
                <dl>
                    <dt>Tél. fixe :</dt><dd> {if $acq->getPhone()}{$acq->getPhone()}{else}NC{/if}</dd>
                    <dt>Tél. mobile : </dt><dd>{if $acq->getMobilPhone()}{$acq->getMobilPhone()} <a href="{Constant::DEFAULT_URL}/modules/openmail/formFancybox/sendSms.php?{time()}&amp;dest={str_replace('+','%2B',$acq->getMobilPhone())}" class="fancyboxAjax fancybox.ajax btn btn-default" title="Envoyer un sms"> <i class="fa fa-2x fa-mobile-phone"></i>    </a>{else}NC{/if}</dd>
                    <dt>Tél. du travail :</dt><dd> {if $acq->getWorkPhone()}{$acq->getWorkPhone()}{else}NC{/if}</dd>
                    <dt>Fax :</dt><dd> {if $acq->getFax()}{$acq->getFax()}{else}NC{/if}</dd>
                    <dt>Email :</dt><dd>{if $acq->getEmail()}{$acq->getEmail()} <a href="{Constant::DEFAULT_URL}/modules/openmail/formFancybox/sendEmail.php?{time()}&amp;dest={$acq->getEmail()}" class="fancyboxAjax fancybox.ajax btn btn-default" title="Envoyer un e-mail"> <i class="fa fa-paper-plane"></i></a>{else}NC{/if}</dd>
                </dl>


            </div>
        </div>


    </div>

    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Situation de famille ( acquereur principal)</h3>
            </div>
            <div class="panel-body">
                <dl>
                {if $situationFamille}


                        <dt>Situation : </dt><dd>{$situationFamille->getSituationAcquereur()->getName()}</p></dd>
                        {if $situationFamille->getSituationAcquereur()->getIfEventDate()} <dt>Le :</dt><dd> {date(Constant::DATE_FORMAT2,$situationFamille->getEventDate())}</dd>{/if}
                        {if $situationFamille->getSituationAcquereur()->getIfEventLocation()}<dt>À :</dt><dd> {$situationFamille->getEventLocation()}</dd>{/if}

                    {else}
                    <dt>Situation : </dt><dd>NC</p></dd>
                {/if}
                </dl>



            </div>
        </div>


    </div>




</div>


        {if $acq->getComment() && $acq->getComment() neq ''}
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Commentaire</h3>
                </div>
                <div class="panel-body">
                    {$acq->getComment()}
                </div>
            </div>

        {/if}



    <div class="row bg-success bannerTitle">
        <div class="col-md-6">
            <h1 class="h2">Acquéreurs associés :</h1>
        </div>
        <div class="col-md-6">

            <p class="h4 text-right ">
                {if $acq->getUser()->getIdUser() eq $user->getIdUser() || $user->getLevelMember()->getIdLevelMember() < 3}
                    <a href="{Tools::create_url($user,'acquereur','addAcqAssocie',$acq->getIdAcquereur() )}" class="btn-success btn" title="Associer un acquereur">
                        <i class="fa fa-plus-circle fa-2x"></i>
                    </a>
                {/if}
            </p>
        </div>
    </div>

    <table class="dataTableDefault table table-striped table-bordered">
        <thead>
        <tr class="tri">
            <th class="jshide"></th>
            <th></th>
            <th class="jshide"></th>
            <th class="jshide"></th>
            <th class="jshide"></th>
        </tr>
        <tr>
            <th>Nom &amp; prénom</th>
            <th>Titre</th>
            <th>téléphones</th>
            <th>E-mail</th>
            <th>Actions</th>

        </tr>
        </thead>
        <tbody>
        {foreach from=$listAcqAssos item=item}
            <tr>
                <td>{$item->getName()} {$item->getFirstname()}</td>
                <td>{$item->getTitreAcquereur()->getName()}</td>

                <td>{if $item->getPhone()}
                        <p>{Lang::LABEL_SELLER_ADD_PHONE}{$item->getPhone()}</p>{/if}
                    {if $item->getCellPhone()}
                        <p>{Lang::LABEL_SELLER_ADD_MOBIL_PHONE}{$item->getCellPhone()}
                            <a href="{Constant::DEFAULT_URL}/modules/openmail/formFancybox/sendSms.php?{time()}&amp;dest={str_replace('+','%2B',$item->getCellPhone())}" class="fancyboxAjax fancybox.ajax btn btn-default" title="Envoyer un SMS"> <i class="fa fa-2x fa-mobile-phone"></i>  </a>
                        </p>
                    {/if}
                    {if $item->getWorkPhone()}
                        <p>{Lang::LABEL_SELLER_ADD_WORK_PHONE}{$item->getWorkPhone()}</p>{/if}
                </td>
                <td>{if $item->getEmail()}{$item->getEmail()} <a href="{Constant::DEFAULT_URL}/modules/openmail/formFancybox/sendEmail.php?{time()}&amp;dest={$item->getEmail()}" class="fancyboxAjax fancybox.ajax btn btn-default" title="Envoyer un e-mail"><i class="fa fa-paper-plane"></i></a>{/if}</td>
                <td>


                    <!-- Split button -->
                    <div class="btn-group">
                        <a href="{Tools::create_url($user,'acquereur','seeAcqAssos',$item->getId())}" class="btn btn-default"><i class="fa fa-chevron-circle-right"></i> {lang::LABEL_SEE}</a>
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" role="menu">

                            {if $item->getAcquereur()->getUser()->getIdUser() eq $user->getIdUser() || $user->getLevelMember()->getIdLevelMember() < 3}
                               <li> <a href="{Tools::create_url($user,'acquereur','updateAcqAssos',$item->getId())}" title="{lang::LABEL_UPDATE}"><i class="fa fa-pencil-square-o"></i> {lang::LABEL_UPDATE}</a></li>
                            {else}
                                <li class="disabled"><a href="javascript:return false;"> <i class="fa fa-pencil-square-o"></i> {lang::LABEL_UPDATE}</a></li>
                            {/if}
                            {if $item->getAcquereur()->getUser()->getIdUser() eq $user->getIdUser() || $user->getLevelMember()->getIdLevelMember() < 3}
                                <li><a rel="{$item->getId()}" href="{Tools::create_url($user,'acquereur','deleteAcqAssos',$item->getId())}"  title="{lang::LABEL_DELETE}"><i class="fa fa-trash"></i> {lang::LABEL_DELETE}</a></li>
                            {else}
                                <li class="disabled"><a href="javasctipt:return false;"><i class="fa fa-trash"></i> {lang::LABEL_DELETE}</a></li>
                            {/if}
                            {include file="tpl_default/menu_send_sms_mail.tpl" email=$item->getEmail() phonenumber=$item->getCellPhone()}
                        </ul>
                    </div>





                   </td>
                {*
                <td>{if $item->getAcquereur()->getUser()->getIdUser() eq $user->getIdUser() ||
                    $user->getLevelMember()->getIdLevelMember() < 3} <a
                            class="" rel="{$item->getId()}"
                            href="{Tools::create_url($user,'acquereur','deleteAcqAssos',$item->getId())}"  title="{lang::LABEL_DELETE}"><img src="{Constant::DEFAULT_URL_PICTURE_DIRECTORY}delete.png" alt="{lang::LABEL_DELETE}" /></a>
                    {else} _ {/if}</td>
                <td><a
                            href="{Tools::create_url($user,'acquereur','seeAcqAssos',$item->getId())}"  title="{lang::LABEL_SEE}"><img src="{Constant::DEFAULT_URL_PICTURE_DIRECTORY}see.png" alt="{lang::LABEL_SEE}" /></a>

                </td>
                *}
            </tr>
        {/foreach}
        </tbody>
    </table>





<div class="row bg-success bannerTitle">
    <div class="col-md-6">
        <h1 class="h2">Critères de recherches, et annonces correspondantes</h1>
    </div>
    <div class="col-md-6">
        <p class="h4 text-right ">
            {if Tools::moduleIsLoad('documents')}
                {if BddRapprochement::rapprochementVisiteAfairePrevueAvant($pdo,$acq)}
                    <a href="{Tools::create_url($user,'documents','bonVisite',$acq->getIdAcquereur() )}" target="_blank" title="Editer le bon de visite" class="btn-default btn">
                        <i class="fa fa-print fa-2x"></i>
                    </a>
                {/if}
            {/if}
        </p>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Critères de recherche</h3>
    </div>
    <div class="panel-body">

        <div class="row">
            <div class="col-md-3">
                <p>Type de transaction : {str_replace('Vente','Achat',$acq->getTransactionType()->getName())}</p>
                <p>Type de critère : {if
                    $acq->getMandateType()}{$acq->getMandateType()->getName()}{else}Indifferent{/if}</p>
            </div>
            <div class="col-md-3">
                <p>Style : {if
                    $acq->getMandateStyle()}{$acq->getMandateStyle()->getName()}{else}Indifferent{/if}</p>
                <p>Prix compris entre {$acq->getPriceMin()} et {$acq->getPriceMax()} €.</p>
            </div><div class="col-md-3">
                <p>Surface de terrain entre {$acq->getSurfaceTerrainMin()} et
                    {$acq->getSurfaceTerrainMax()} m²</p>
                <p>Surface habitable entre {$acq->getSurfaceHabitableMin()} et
                    {$acq->getSurfaceHabitableMax()} m²</p>
            </div><div class="col-md-3">
                <p>Secteur souhaité : {if
                    $acq->getRechercheSector()}{$acq->getRechercheSector()->getName()}{else}Indifferent{/if}</p>
                <p>Ville souhaitée : {if
                    $acq->getRechercheCity()}{$acq->getRechercheCity()->getName()}{else}Indifferent{/if}</p>
            </div>
        </div>



    </div>
</div>





{* ajout du sous module avec les mandats correspondants aux critères *}
{include file="tpl_default/hook.tpl" position="hook_content_bottom"}


</div>
