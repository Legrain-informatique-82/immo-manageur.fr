{include file="tpl_default/entete.tpl"}
<h1>{lang::LABEL_SELLER_UPDATE_TITLE_h1} {$seller_update_title_old_name}</h1>
<form action="" method="post">
	<p>
		<label for="seller_update_title_name">{lang::LABEL_SELLER_ADD_TITLE_NAME}<input
			type="text" value="{$seller_update_title_name}"
			name="seller_update_title_name" id="seller_update_title_name" /> </label>
	</p>
	<p>
		<input type="hidden" name="seller_update_title_old_name"
			value="{$seller_update_title_old_name}" /> <input type="submit"
			name="seller_update_title_submit" value="{lang::LABEL_SAVE}" />
	</p>
</form>
</div>
