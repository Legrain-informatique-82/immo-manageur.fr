{include file='tpl_default/entete.tpl'}

<h1>Voir l'action</h1>
{if ($user->getLevelMember()->getIdLevelMember()<3||
$action->getFrom()->getIdUser() eq $user->getIdUser())
&&!$action->getDoDate()}
<p>
	<a
		href="{Tools::create_url($user,$smarty.get.module,'update',$smarty.get.action)}">Modifier
		l'action.</a>
</p>
{/if}
<p>De la part de : {$action->getFrom()->getFirstname()}
	{$action->getFrom()->getName()}</p>
<p>Pour : {$action->getTo()->getFirstname()}
	{$action->getTo()->getName()}</p>
<p>Date de début de l'action :
	{date(Constant::DATE_FORMAT,$action->getInitDate())}</p>
<p>Date de fin de l'action : {if
	$action->getDeadDate()}{date(Constant::DATE_FORMAT,$action->getDeadDate())}{else}NC{/if}</p>
<p>Libellé : {$action->getLibel()}</p>
{if $action->getMandate()}
<p>
	Attribué au mandat : <a
		href="{Tools::create_url($user,'terrain','see',$action->getMandate()->getIdMandate())}">Numéro
		mandat : {$action->getMandate()->getNumberMandate()}</a>
</p>
{/if} {if $action->getComment()}
<p>Detail : {$action->getComment()}</p>
{/if} {if ($user->getLevelMember()->getIdLevelMember()<3||
$action->getTo()->getIdUser() eq $user->getIdUser()||
$action->getFrom()->getIdUser() eq $user->getIdUser())
&&!$action->getDoDate()}
<form action="" method="post">
	<p>
		<label for=comment">Commentaire : <textarea name="comment"
				id="comment" cols="30" rows="10">{$smarty.post.comment}</textarea> </label>
	</p>
	<p>
		<input type="submit" name="cancel" value="Annuler" /> <input
			type="submit" name="valid" value="Action traitée" />
	</p>

</form>
{else}
<form action="" method="post">
	<p>
		<input type="submit" name="cancel" value="Fermer" />
	</p>
</form>
{/if}

</div>
