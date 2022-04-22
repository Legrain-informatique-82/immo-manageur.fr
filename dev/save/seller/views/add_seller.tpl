{include file="tpl_default/entete.tpl"}

<form action="" method="post">
	{if $error}
	<ul>
		{foreach from=$error item=item}
		<li class="error">{$item}</li> {/foreach}
	</ul>

	{/if} {if $user->getLevelMember()->getIdLevelMember() <3}
	<p>
		<label for="seller_add_user"> <select name="seller_add_user"
			id="seller_add_user"> {foreach from=$listUser item=item}
				<option {if ($item->getIdUser() eq $smarty.post.seller_add_user &&
					!empty($smarty.post.seller_add_user)) ||( $user->getIdUser() eq
					$item->getIdUser()&& empty($smarty.post.seller_add_user))}
					selected="selected"
					{/if}value="{$item->getIdUser()}">{$item->getFirstname()}
					{$item->getName()}</option> {/foreach}

		</select> </label>
	</p>
	{/if} {include file='seller/views/frm_add_seller.tpl'}
	<p>
		<label for="seller_add_comment">{Lang::LABEL_SELLER_ADD_COMMENT}<textarea
				name="seller_add_comment" id="seller_add_comment" cols="30"
				rows="10">{$smarty.post.seller_add_comment}</textarea> </label>
	</p>
	<p>
		<input type="submit" value="{Lang::LABEL_SAVE}"
			id="seller_add_submit_send" name="seller_add_submit_send" />
	</p>
</form>
</div>
