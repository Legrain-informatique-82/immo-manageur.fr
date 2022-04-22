{include file="tpl_default/entete.tpl"}
<form action="" method="post"  role="form" class="form-horizontal">
<div class="row bg-success bannerTitle">
    <div class="col-md-6">
        <h1 class="h2">Ajouter un vendeur</h1>
    </div>

    <div class="col-md-6">
        <p class="h4 text-right ">


            <button type="submit" name="seller_add_submit_send" class="btn btn-success">
                <i class="fa fa-save fa-2x"></i>
            </button>
            <a title="annuler et fermer" class="btn btn-default" href="{Tools::create_url($user,"seller","lists")}">
                <i class="fa fa-close fa-2x"></i>
            </a>
        </p>
    </div>
</div>

{if $error} {foreach from=$error item=item name=e} {if
$smarty.foreach.e.first}
    <div class="alert alert-danger" role="alert">
    <ul>
{/if}
    <li class="error">{$item}</li> {if $smarty.foreach.e.last}
        </ul>
    {/if} {/foreach}
    </div>
{/if}




    {if $user->getLevelMember()->getIdLevelMember() <3}
        <div class="form-group">
            <label class="col-sm-2 control-label" for="seller_add_user">Utilisateur : </label>
            <div class="col-sm-8">
            <select class="form-control" name="seller_add_user" id="seller_add_user">
                {foreach from=$listUser item=item}
                    <option {if ($item->getIdUser() eq $smarty.post.seller_add_user && !empty($smarty.post.seller_add_user)) ||( $user->getIdUser() eq $item->getIdUser()&& empty($smarty.post.seller_add_user))} selected="selected" {/if}value="{$item->getIdUser()}">{$item->getFirstname()} {$item->getName()}</option>
                {/foreach}
            </select>
            </div>
        </div>
    {/if} {include file='seller/views/frm_add_seller.tpl'}
    <div class="form-group">
        <label class="col-sm-2 control-label" for="seller_add_comment">{Lang::LABEL_SELLER_ADD_COMMENT}</label>
        <div class="col-sm-8">
        <textarea class="form-control" name="seller_add_comment" id="seller_add_comment" cols="30" rows="10">{$smarty.post.seller_add_comment}</textarea>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
            <button class="btn btn-success" type="submit" value="{Lang::LABEL_SAVE}" id="seller_add_submit_send" name="seller_add_submit_send" >
                <i class="fa fa-save"></i> {Lang::LABEL_SAVE}
            </button>

            <a class="btn btn-default" href="{Tools::create_url($user,"seller","lists")}">
                <i class="fa fa-close"></i> Annuler et fermer
            </a>
        </div>

    </div>
</form>
</div>

