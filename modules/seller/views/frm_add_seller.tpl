

<div class="form-group">
	<label class="col-sm-2 control-label"  for="seller_add_list_title"> {Lang::LABEL_SELLER_ADD_TITLE}</label>
    <div class="col-sm-8">
    <select
		name="seller_add_list_title" id="seller_add_list_title" class="form-control"> {foreach
			from=$listTitle item=item}
			<option {if ($smarty.post.seller_add_list_title eq $item->getIdSellerTitle()
				|| $seller_add_list_title eq $item->getIdSellerTitle())}
				selected="selected"
				{/if}value="{$item->getIdSellerTitle()}">{$item->getLibel()}</option>
			{/foreach}
	</select>
        </div>
</div>

    <div class="form-group">
	<label class="col-sm-2 control-label"  for="seller_add_name">{Lang::LABEL_SELLER_ADD_NAME}</label>
        <div class="col-sm-8">
        <input
		type="text" name="seller_add_name"
		value="{if $smarty.post}{$smarty.post.seller_add_name}{else}{$nameSeller}{/if}"
		id="seller_add_name" class="form-control"/>
            </div>
</div>
        <div class="form-group">
	<label class="col-sm-2 control-label"  for="seller_add_firstname">{Lang::LABEL_SELLER_ADD_FIRSTNAME}</label>
            <div class="col-sm-8">
            <input
		type="text" name="seller_add_firstname"
		value="{if $smarty.post}{$smarty.post.seller_add_firstname}{else}{$firstnameSeller}{/if}"
		id="seller_add_firstname" class="form-control"/>
                </div>
</div>
            <div class="form-group">
	<label class="col-sm-2 control-label"  for="seller_add_address">{Lang::LABEL_SELLER_ADD_ADDRESS}</label>
                <div class="col-sm-8">
                <input
		type="text" name="seller_add_address"
		value="{if $smarty.post}{$smarty.post.seller_add_address}{else}{$seller_add_address}{/if}"
		id="seller_add_address" class="form-control" /></div>
</div>

                <div class="form-group">
	<label class="col-sm-2 control-label"  for="seller_add_list_city"> {Lang::LABEL_SELLER_ADD_CITY}</label>
                    <div class="col-sm-8">
                    <select class="form-control"
		name="seller_add_list_city" id="seller_add_list_city"> {foreach
			from=$listCity item=item}
			<option {if ($smarty.post.seller_add_list_city eq $item->getIdCity())
				|| ($seller_add_list_city eq $item->getIdCity())}
				selected="selected"
				{/if}value="{$item->getIdCity()}">{$item->getZipCode()} -
				{$item->getName()}</option> {/foreach}
	</select>
                        </div>
</div>

                    <div class="form-group">
	<label class="col-sm-2 control-label"  for="seller_add_phone">{Lang::LABEL_SELLER_ADD_PHONE}</label>
                        <div class="col-sm-8">
                        <input class="form-control"
		type="text" name="seller_add_phone"
		value="{if $smarty.post}{$smarty.post.seller_add_phone}{else}{$seller_add_phone}{/if}"
		id="seller_add_phone" /> </div>
</div>
                        <div class="form-group">
	<label class="col-sm-2 control-label"  for="seller_add_mobil_phone">{Lang::LABEL_SELLER_ADD_MOBIL_PHONE}</label>
                            <div class="col-sm-8">
                            <input class="form-control"
		type="text" name="seller_add_mobil_phone"
		value="{if $smarty.post}{$smarty.post.seller_add_mobil_phone}{else}{$seller_add_mobil_phone}{/if}"
		id="seller_add_mobil_phone" /> </div>
</div>
                            <div class="form-group">
	<label class="col-sm-2 control-label"  for="seller_add_work_phone">{Lang::LABEL_SELLER_ADD_WORK_PHONE}</label>
                                <div class="col-sm-8">
                                <input class="form-control"
		type="text" name="seller_add_work_phone"
		value="{if $smarty.post}{$smarty.post.seller_add_work_phone}{else}{$seller_add_work_phone}{/if}"
		id="seller_add_work_phone" /> </div>
</div>
                                <div class="form-group">
	<label class="col-sm-2 control-label"  for="seller_add_fax">{Lang::LABEL_SELLER_ADD_FAX}</label>
                                    <div class="col-sm-8">
                                    <input class="form-control"
		type="text" name="seller_add_fax"
		value="{if $smarty.post}{$smarty.post.seller_add_fax}{else}{$seller_add_fax}{/if}"
		id="seller_add_fax" /> </div>
</div>
                                    <div class="form-group">
	<label class="col-sm-2 control-label"  for="seller_add_email">{Lang::LABEL_SELLER_ADD_EMAIL}</label>
                                        <div class="col-sm-8">
                                        <input class="form-control"
		type="text" name="seller_add_email"
		value="{if $smarty.post}{$smarty.post.seller_add_email}{else}{$seller_add_email}{/if}"
		id="seller_add_email" /> </div>
</div>



  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-8">
         <div class="checkbox">
            <label>
               <input type="checkbox" name="vitrine" id="vitrine" value="1" {if $smarty.post.vitrine eq 1 or $vitrine eq 1} checked="checked" {/if} /> Creer un compte client sur votre site vitrine.
            </label>
          </div>
    </div>
  </div>


