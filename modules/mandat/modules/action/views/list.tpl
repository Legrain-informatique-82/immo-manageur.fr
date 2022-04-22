{if $listActions}


        <table class="dataTablewithoutSearch dataTable  table table-striped table-bordered table-condensed table-responsive">
            <thead>
            <tr>
                <th>Du</th> {*
				<th>Au</th>
				<th>De</th>*}
                <th>Pour</th>
                <th>Libellé de la tâche</th>
                {*<th>Numéro de mandat lié</th>*}
                <th>Détail</th>
            </tr>
            </thead>
            <tbody>
            {foreach from=$listActions item=i}
                <tr>
                    <td data-order="{$i->getInitDate()}">{date(Constant::DATE_FORMAT2,$i->getInitDate())}</td> {*
				<td>{if
					$i->getDeadDate()}{date(Constant::DATE_FORMAT2,$i->getDeadDate())}{/if}</td>*}
                    {*<td>{$i->getFrom()->getFirstname()} {$i->getFrom()->getName()}</td>*}
                    <td>{$i->getTo()->getFirstname()} {$i->getTo()->getName()}</td>
                    <td>{$i->getLibel()}</td>
                    {*<td>{if
                        $i->getMandate()}{$i->getMandate()->getNumberMandate()}{else}Aucun{/if}</td>*}
                    <td><a class="btn  btn-default btn-xs" title="{Lang::LABEL_SEE}"
                           href="{Tools::create_url($user,'action','see',$i->getIdAction())}" {if $user->getOpenInNewTab()} target="_blank"{/if}><i class="fa fa-chevron-circle-right"></i> {Lang::LABEL_SEE}</a>

                    </td>
                </tr>
            {/foreach}
            </tbody>
        </table>

{else}
    <p>Actuellement, aucune action sur ce mandat.</p>
{/if}
