{include file="tpl_default/entete.tpl"}

<form action="" method="post">

	{if $error}
	<ul>
		{foreach from=$error item=item}
		<li class="error">{$item}</li> {/foreach}
	</ul>

	{/if} {if $user->getLevelMember()->getIdLevelMember() <3}
	<p>
		<label for="seller_update_user"> <select name="seller_update_user"
			id="seller_update_user"> {foreach from=$listUser item=item}
				<option {if ($item->getIdUser() eq $seller_update_user &&
					!empty($seller_update_user)) ||( $user->getIdUser() eq
					$item->getIdUser()&& empty($seller_update_user))}
					selected="selected"
					{/if}value="{$item->getIdUser()}">{$item->getFirstname()}
					{$item->getName()}</option> {/foreach}

		</select> </label>
	</p>
	{/if}
	<p>
		<label for="seller_update_list_title"> {Lang::LABEL_SELLER_ADD_TITLE}
			<select name="seller_update_list_title" id="seller_update_list_title">
				{foreach from=$listTitle item=item}
				<option {if $seller_update_list_title eq $item->getIdSellerTitle()}
					selected="selected"
					{/if}value="{$item->getIdSellerTitle()}">{$item->getLibel()}</option>
				{/foreach}
		</select> </label>
	</p>

	<p>
		<label for="seller_update_name">{Lang::LABEL_SELLER_ADD_NAME}<input
			type="text" name="seller_update_name" value="{$seller_update_name}"
			id="seller_update_name" /> </label>
	</p>
	<p>
		<label for="seller_update_firstname">{Lang::LABEL_SELLER_ADD_FIRSTNAME}<input
			type="text" name="seller_update_firstname"
			value="{$seller_update_firstname}" id="seller_update_firstname" /> </label>
	</p>
	<p>
		<label for="seller_update_address">{Lang::LABEL_SELLER_ADD_ADDRESS}<input
			type="text" name="seller_update_address"
			value="{$seller_update_address}" id="seller_update_address" /> </label>
	</p>

	<p>
		<label for="seller_update_list_city"> {Lang::LABEL_SELLER_ADD_CITY} <select
			name="seller_update_list_city" id="seller_update_list_city"> {foreach
				from=$listCity item=item}
				<option {if $seller_update_list_city eq $item->getIdCity()}
					selected="selected"
					{/if}value="{$item->getIdCity()}">{$item->getZipCode()} -
					{$item->getName()}</option> {/foreach}
		</select> </label>
	</p>
	<p>
		<label for="seller_update_phone">{Lang::LABEL_SELLER_ADD_PHONE}<input
			type="text" name="seller_update_phone" value="{$seller_update_phone}"
			id="seller_update_phone" /> </label>
	</p>
	<p>
		<label for="seller_update_mobil_phone">{Lang::LABEL_SELLER_ADD_MOBIL_PHONE}<input
			type="text" name="seller_update_mobil_phone"
			value="{$seller_update_mobil_phone}" id="seller_update_mobil_phone" />
		</label>
	</p>
	<p>
		<label for="seller_update_work_phone">{Lang::LABEL_SELLER_ADD_WORK_PHONE}<input
			type="text" name="seller_update_work_phone"
			value="{$seller_update_work_phone}" id="seller_update_work_phone" />
		</label>
	</p>
	<p>
		<label for="seller_update_fax">{Lang::LABEL_SELLER_ADD_FAX}<input
			type="text" name="seller_update_fax" value="{$seller_update_fax}"
			id="seller_update_fax" /> </label>
	</p>
	<p>
		<label for="seller_update_email">{Lang::LABEL_SELLER_ADD_EMAIL}<input
			type="text" name="seller_update_email" value="{$seller_update_email}"
			id="seller_update_email" /> </label>
	</p>
	<p>
		<label for="seller_update_comment">{Lang::LABEL_SELLER_ADD_COMMENT}<textarea
				name="seller_update_comment" id="seller_update_comment" cols="30"
				rows="10">{$seller_update_comment}</textarea> </label>
	</p>
	<p>
		<input type="submit" value="{Lang::LABEL_SAVE}"
			id="seller_update_submit_send" name="seller_update_submit_send" />
	</p>

</form>
</div>
