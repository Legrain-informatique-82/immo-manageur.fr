{if $listActions}
<div id="contAct">
	<h1>Actions :</h1>
	<table class="triActionsBis">
		<thead>
			<tr>
				<th>Du</th> {*
				<th>Au</th>*}
				<th>De</th>
				<th>Pour</th>
				<th>Libellé</th>
				<th>Numéro de mandat lié</th>
				<th>Voir</th>
			</tr>
		</thead>
		<tbody>
			{foreach from=$listActions item=i}
			<tr>
				<td>{date(Constant::DATE_FORMAT2,$i->getInitDate())}</td> {*
				<td>{if
					$i->getDeadDate()}{date(Constant::DATE_FORMAT2,$i->getDeadDate())}{/if}</td>*}
				<td>{$i->getFrom()->getFirstname()} {$i->getFrom()->getName()}</td>
				<td>{$i->getTo()->getFirstname()} {$i->getTo()->getName()}</td>
				<td>{$i->getLibel()}</td>
				<td>{if
					$i->getMandate()}{$i->getMandate()->getNumberMandate()}{else}Aucun{/if}</td>
				<td><a
					href="{Tools::create_url($user,'action','see',$i->getIdAction())}">Voir</a>
				</td>
			</tr>
			{/foreach}
		</tbody>
	</table>
</div>
{/if}
