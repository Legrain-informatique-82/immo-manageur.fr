{include file='tpl_default/entete.tpl'}
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Mes tâches</h3>
    </div>
    <div class="panel-body">

        {if $listActions}
            <div class="row">
                <div class="col-md-6">
                    <table id="actAccueil" class="table table-bordered table-condensed">
                        <thead>
                        <tr>
                            <th>Du</th> {*
				<th>Au</th>*}
                            <th>De</th>
                            <th>Pour</th>
                            <th>Libellé</th>
                            <th>Numéro de mandat lié</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        {foreach from=$listActions item=i}

                            <tr rel="{$i->getId()}">
                                <td>{date(Constant::DATE_FORMAT2,$i->getInitDate())}</td> {*
				<td>{if
					$i->getDeadDate()}{date(Constant::DATE_FORMAT,$i->getDeadDate())}{/if}</td>*}
                                <td>{$i->getFrom()->getFirstname()} {$i->getFrom()->getName()}</td>
                                <td>{$i->getTo()->getFirstname()} {$i->getTo()->getName()}</td>
                                <td>{$i->getLibel()}</td>
                                <td>{if
                                    $i->getMandate()}{$i->getMandate()->getNumberMandate()}{else}Aucun{/if}</td>
                                <td><a href="{Tools::create_url($user,'action','see',$i->getIdAction())}"  title="{Lang::LABEL_SEE}" class="btn btn-default btn-xs"> <i class="fa fa-chevron-circle-right"></i> {Lang::LABEL_SEE}</a>
                                </td>
                            </tr>
                        {/foreach}

                        </tbody>
                    </table>
                </div>
                <div class="col-md-6">
                    <div class="well">
                        <h2>Détail de la tâche sélectionnée</h2>
                        <p id="textTacheSelected" >Afficher le détail d'une tâche en sélectionnant la ligne.</p>
                    </div>
                </div>
            </div>
        {else}

            <p id="textTacheSelected">Aucune tâche.</p>

        {/if}
    </div>
</div>
