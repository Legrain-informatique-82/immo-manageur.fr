{include file='tpl_default/entete.tpl'}
<form action="" method="post" class="form-horizontal" role="form">
    <div class="row bg-success bannerTitle">
        <div class="col-md-6">
            <h1 class="h2">Voir la tâche</h1>
        </div>
        <div class="col-md-6">
            <p class="h4 text-right">
                {*
                            <a class="btn btn-success" href="{Tools::create_url($user,'action','add')}" title="Ajouter une tâche">
                                <i class="fa fa-plus-circle fa-2x"></i>
                            </a>
                *}
                {if ($user->getLevelMember()->getIdLevelMember()<3||
                $action->getFrom()->getIdUser() eq $user->getIdUser())
                &&!$action->getDoDate()}

                    <a href="{Tools::create_url($user,$smarty.get.module,'update',$smarty.get.action)}" class="btn btn-warning" title="Modifier l'action">
                        <i class="fa fa-2x fa-pencil-square-o"></i>
                    </a>

                {/if}

                {if ($user->getLevelMember()->getIdLevelMember()<3|| $action->getTo()->getIdUser() eq $user->getIdUser()|| $action->getFrom()->getIdUser() eq $user->getIdUser()) &&!$action->getDoDate()}


                    <button type="submit" name="valid" value="Action traitée" class="btn btn-success" title="Traiter l'action">
                        <i class="fa fa-cog fa-2x"></i>
                    </button>
                    <a class="btn btn-default" href="{Tools::create_url($user,'action','list')}" title="Fermer">
                        <i class="fa fa-close fa-2x"></i>
                    </a>



                {else}


                    <a class="btn btn-default" href="{Tools::create_url($user,'action','list_old')}" title="Fermer">
                        <i class="fa fa-close fa-2x"></i>
                    </a>


                {/if}
            </p>
        </div>
    </div>




    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">

            <div class="panel panel-default">
                <div class="panel-heading">Détail</div>
                <div class="panel-body">
                    <dl class="dl-horizontal">
                        <dt>De la part de :</dt><dd>{$action->getFrom()->getFirstname()} {$action->getFrom()->getName()}</dd>
                        <dt>Pour :</dt><dd>{$action->getTo()->getFirstname()} {$action->getTo()->getName()}</dd>
                        <dt>Date de début :</dt><dd>{date(Constant::DATE_FORMAT,$action->getInitDate())}</dd>
                        <dt>Date de fin :</dt><dd>{if $action->getDeadDate()}{date(Constant::DATE_FORMAT,$action->getDeadDate())}{else}NC{/if}</dd>
                        <dt>Libellé :</dt><dd>{$action->getLibel()}</dd>

                        {if $action->getMandate()}

                            {if $action->getMandate()->getMandateType()->getIdMandateType()==Constant::ID_PLOT_OF_LAND}
                                {assign var="module" value='terrain'}
                            {else}
                                {assign var="module" value='mandat'}
                            {/if}
                            <dt>
                                Attribué au mandat :
                            </dt>
                            <dd>
                                <a href="{Tools::create_url($user,$module,'see',$action->getMandate()->getIdMandate())}">
                                    Numéro mandat : {$action->getMandate()->getNumberMandate()}
                                </a>
                            </dd>
                        {/if}
                        {if $action->getComment()}
                            <dt>Commentaire : </dt><dd>{$action->getComment()}</p></dd>
                        {/if}
                    </dl>





                </div>
            </div>
        </div>
    </div>
    {if ($user->getLevelMember()->getIdLevelMember()<3|| $action->getTo()->getIdUser() eq $user->getIdUser()|| $action->getFrom()->getIdUser() eq $user->getIdUser()) &&!$action->getDoDate()}

        <div class="form-group">
            <label class="col-sm-2 control-label" for=comment">Commentaire : </label>
            <div class="col-sm-8">
                <textarea name="comment" class="form-control" id="comment" cols="30" rows="10">{$smarty.post.comment}</textarea>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-8">
                <button type="submit" name="valid" value="Action traitée" class="btn btn-success">
                    <i class="fa fa-cog"></i> Traiter l'action
                </button>
                <a class="btn btn-default" href="{Tools::create_url($user,'action','list')}">
                    <i class="fa fa-close"></i> Fermer
                </a>

            </div>
        </div>


    {else}

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-8">
                <a class="btn btn-default" href="{Tools::create_url($user,'action','list_old')}">
                    <i class="fa fa-close"></i> Fermer
                </a>
            </div>
        </div>

    {/if}

    </div>
</form>
</div>