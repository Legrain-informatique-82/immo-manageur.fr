{include file='tpl_default/entete.tpl'}

<h1>{$h1}</h1>
<table class="{if $old}triActionsOld{else}triActionsBis{/if}">
	<thead>
		<tr>
			{if $old}
			<th>Fait le</th>{/if}
			<th>Du</th>
			<!--<th>Au</th>-->
			<th>De</th>
			<th>Pour</th>
			<th>Libellé</th>
			<th>Numéro de mandat lié</th>
			<th>Supprimer</th>
			<th>Voir</th>
		</tr>
	</thead>
	<tbody>
		{foreach from=$actions item=i}
		<tr>
			{if $old}
			<td>{date(Constant::DATE_FORMAT2,$i->getDoDate())}</td>{/if}
			<td>{date(Constant::DATE_FORMAT2,$i->getInitDate())}</td>
			<!--<td>{if $i->getDeadDate()}{date(Constant::DATE_FORMAT,$i->getDeadDate())}{/if}</td>-->
			<td>{$i->getFrom()->getFirstname()} {$i->getFrom()->getName()}</td>
			<td>{$i->getTo()->getFirstname()} {$i->getTo()->getName()}</td>
			<td>{$i->getLibel()}</td>
			<td>{if
				$i->getMandate()}{$i->getMandate()->getNumberMandate()}{else}Aucun{/if}</td>

			<td>{* Si créateur, admin ou SA *} {if $i->getFrom()->getIdUser() eq
				$user->getIdUser() OR $user->getLevelMember()->getIdLevelMember() <
				3} {if $smarty.get.page eq 'list'} {assign var="redirect"
				value="del"} {else} {assign var="redirect" value="delO"} {/if} <a
				href="{Tools::create_url($user,$smarty.get.module,$redirect,$i->getIdAction())}">Supprimer</a>
				{else} - {/if}</td>

			<td><a
				href="{Tools::create_url($user,$smarty.get.module,'see',$i->getIdAction())}">Voir</a>
			</td>
		</tr>
		{/foreach}

	</tbody>
</table>
</div>
