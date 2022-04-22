

<p>
	<label for="seller_add_list_title"> {Lang::LABEL_SELLER_ADD_TITLE} <select
		name="seller_add_list_title" id="seller_add_list_title"> {foreach
			from=$listTitle item=item}
			<option {if ($smarty.post.seller_add_list_title eq $item->getIdSellerTitle()
				|| $seller_add_list_title eq $item->getIdSellerTitle())}
				selected="selected"
				{/if}value="{$item->getIdSellerTitle()}">{$item->getLibel()}</option>
			{/foreach}
	</select> </label>
</p>

<p>
	<label for="seller_add_name">{Lang::LABEL_SELLER_ADD_NAME}<input
		type="text" name="seller_add_name"
		value="{if $smarty.post}{$smarty.post.seller_add_name}{else}{$nameSeller}{/if}"
		id="seller_add_name" /> </label>
</p>
<p>
	<label for="seller_add_firstname">{Lang::LABEL_SELLER_ADD_FIRSTNAME}<input
		type="text" name="seller_add_firstname"
		value="{if $smarty.post}{$smarty.post.seller_add_firstname}{else}{$firstnameSeller}{/if}"
		id="seller_add_firstname" /> </label>
</p>
<p>
	<label for="seller_add_address">{Lang::LABEL_SELLER_ADD_ADDRESS}<input
		type="text" name="seller_add_address"
		value="{if $smarty.post}{$smarty.post.seller_add_address}{else}{$seller_add_address}{/if}"
		id="seller_add_address" /> </label>
</p>

<p>
	<label for="seller_add_list_city"> {Lang::LABEL_SELLER_ADD_CITY} <select
		name="seller_add_list_city" id="seller_add_list_city"> {foreach
			from=$listCity item=item}
			<option {if ($smarty.post.seller_add_list_city eq $item->getIdCity())
				|| ($seller_add_list_city eq $item->getIdCity())}
				selected="selected"
				{/if}value="{$item->getIdCity()}">{$item->getZipCode()} -
				{$item->getName()}</option> {/foreach}
	</select> </label>
</p>
<p>
	<label for="seller_add_phone">{Lang::LABEL_SELLER_ADD_PHONE}<input
		type="text" name="seller_add_phone"
		value="{if $smarty.post}{$smarty.post.seller_add_phone}{else}{$seller_add_phone}{/if}"
		id="seller_add_phone" /> </label>
</p>
<p>
	<label for="seller_add_mobil_phone">{Lang::LABEL_SELLER_ADD_MOBIL_PHONE}<input
		type="text" name="seller_add_mobil_phone"
		value="{if $smarty.post}{$smarty.post.seller_add_mobil_phone}{else}{$seller_add_mobil_phone}{/if}"
		id="seller_add_mobil_phone" /> </label>
</p>
<p>
	<label for="seller_add_work_phone">{Lang::LABEL_SELLER_ADD_WORK_PHONE}<input
		type="text" name="seller_add_work_phone"
		value="{if $smarty.post}{$smarty.post.seller_add_work_phone}{else}{$seller_add_work_phone}{/if}"
		id="seller_add_work_phone" /> </label>
</p>
<p>
	<label for="seller_add_fax">{Lang::LABEL_SELLER_ADD_FAX}<input
		type="text" name="seller_add_fax"
		value="{if $smarty.post}{$smarty.post.seller_add_fax}{else}{$seller_add_fax}{/if}"
		id="seller_add_fax" /> </label>
</p>
<p>
	<label for="seller_add_email">{Lang::LABEL_SELLER_ADD_EMAIL}<input
		type="text" name="seller_add_email"
		value="{if $smarty.post}{$smarty.post.seller_add_email}{else}{$seller_add_email}{/if}"
		id="seller_add_email" /> </label>
</p>
