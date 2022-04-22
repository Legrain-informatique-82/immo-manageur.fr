{include file='tpl_default/entete.tpl'}

<div class="row bg-success bannerTitle">
    <div class="col-md-6">
        <h1 class="h2">{$h1}</h1>
    </div>
    <div class="col-md-6">
        <p class="h4 text-right">
            <a class="btn btn-success" href="{Tools::create_url($user,'action','add')}" title="Ajouter une tâche">
                <i class="fa fa-plus-circle fa-2x"></i>
            </a>
        </p>
    </div>
</div>

<table class="dataTableDefault table table-striped table-bordered">
	<thead>
    <tr class="tri">
        {if $old}
        <th ></th>
        {/if}
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>

        <th class="jshide"></th>
    </tr>
		<tr>
			{if $old}
			<th>Fait le</th>
            {/if}
			<th>Du</th>
			<!--<th>Au</th>-->
			<th>De</th>
			<th>Pour</th>
			<th>Libellé</th>
			<th>Numéro de mandat lié</th>
			

			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		{foreach from=$actions item=i}
		<tr>
			{if $old}
			<td data-order="{$i->getDoDate()}">{date(Constant::DATE_FORMAT2,$i->getDoDate())}</td>
            {/if}
			<td data-order="{$i->getInitDate()}">{date(Constant::DATE_FORMAT2,$i->getInitDate())}</td>
			<!--<td>{if $i->getDeadDate()}{date(Constant::DATE_FORMAT,$i->getDeadDate())}{/if}</td>-->
			<td>{$i->getFrom()->getFirstname()} {$i->getFrom()->getName()}</td>
			<td>{$i->getTo()->getFirstname()} {$i->getTo()->getName()}</td>
			<td>{$i->getLibel()}</td>
			
			<td>{if $i->getMandate()}{$i->getMandate()->getNumberMandate()}{else}Aucun{/if}</td>

			<td>


                <!-- Split button -->
                <div class="btn-group">
                    <a href="{Tools::create_url($user,$smarty.get.module,'see',$i->getIdAction())}" class="btn btn-default"><i class="fa fa-chevron-circle-right"></i> {lang::LABEL_SEE}</a>
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">

                        {if $i->getFrom()->getIdUser() eq $user->getIdUser() OR $user->getLevelMember()->getIdLevelMember() < 3}
                            {if $smarty.get.page eq 'list'}
                                {assign var="redirect" value="del"}
                            {else}
                                {assign var="redirect" value="delO"}
                            {/if}
                           <li> <a href="{Tools::create_url($user,$smarty.get.module,$redirect,$i->getIdAction())}"">
                               <i class="fa fa-trash"></i> {Lang::LABEL_DELETE}
                            </a>
                           </li>
                        {else}
                            <li class="disabled">
                                <a href="javascript:return false;"><i class="fa fa-trash"></i> {Lang::LABEL_DELETE}</a>
                            </li>
                        {/if}


                    </ul>
                </div>





            </td>
{*
			<td>
                <a href="{Tools::create_url($user,$smarty.get.module,'see',$i->getIdAction())}" title="{Lang::LABEL_SEE}"  {if $user->getOpenInNewTab()} target="_blank"{/if}><img src="{Constant::DEFAULT_URL_PICTURE_DIRECTORY}see.png" alt="{Lang::LABEL_SEE}" /></a>
			</td>
*}
		</tr>
		{/foreach}

	</tbody>
</table>
</div>
