<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head> 
 <meta http-equiv="X-UA-Compatible" content="chrome=1">
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<meta name="robots" content="noindex,nofollow" />

{assign var="theme" value=Constant::THEME}
{if $user}
	{if $user->getTheme() neq ''}
		{assign var="theme" value=$user->getTheme()}
	{/if}
{/if}
{*
<link rel="stylesheet" href="{Constant::DEFAULT_URL}/css/{$theme}/demo_page.css" />
<link rel="stylesheet" href="{Constant::DEFAULT_URL}/css/{$theme}/demo_table.css" />
*}
{* <link href="{Constant::DEFAULT_URL}/css/{$theme}/uploadify.css" type="text/css" rel="stylesheet" /> *}

<link rel="stylesheet" href="{Constant::DEFAULT_URL}/css/{$theme}/custom-theme/jquery-ui-1.10.0.custom.css" />
<link rel="stylesheet" href="{Constant::DEFAULT_URL}/css/{$theme}/font-awesome/css/font-awesome.min.css" />


    <!-- Add fancyBox main JS and CSS files -->
    <link rel="stylesheet" type="text/css" href="{Constant::DEFAULT_URL}/js/fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen" />

    <!-- Add Button helper (this is optional) -->
    <link rel="stylesheet" type="text/css" href="{Constant::DEFAULT_URL}/js/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" />

    <!-- Add Thumbnail helper (this is optional) -->
    <link rel="stylesheet" type="text/css" href="{Constant::DEFAULT_URL}/js/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />

    <link rel="stylesheet" type="text/css" href="{Constant::DEFAULT_URL}/libs/TableTools/css/dataTables.tableTools.min.css" />




    <link rel="stylesheet" href="{Constant::DEFAULT_URL}/css/{$theme}/datatables/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="{Constant::DEFAULT_URL}/css/{$theme}/datatables/jquery.dataTables_themeroller.css" />






    {*
<link rel="stylesheet" href="{Constant::DEFAULT_URL}/css/{$theme}/css.css" />
<!--[if lte IE 8]>
   <link rel="stylesheet" href="{Constant::DEFAULT_URL}/css/{$theme}/lessIe9.css" />
   
<![endif]-->

<!--[if lte IE 7]>
   <link rel="stylesheet" href="{Constant::DEFAULT_URL}/css/{$theme}/lessIe8.css" />
<![endif]-->
*}
    <link rel="stylesheet" href="{Constant::DEFAULT_URL}/libs/plupload/js/jquery.plupload.queue/css/jquery.plupload.queue.css" type="text/css" media="screen" />

    {*<link rel="stylesheet" href="{Constant::DEFAULT_URL}/libs/plupload/js/jquery.ui.plupload/css/jquery.ui.plupload.css" type="text/css" />*}
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="{Constant::DEFAULT_URL}/libs/bootstrap/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="{Constant::DEFAULT_URL}/libs/bootstrap/css/bootstrap-theme.min.css">

    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/plug-ins/725b2a2115b/integration/bootstrap/3/dataTables.bootstrap.css">

    {if $css}
        {foreach $css as $file}
            <link rel="stylesheet" href="{Constant::DEFAULT_URL}/modules/{$module}/css/{$file}"/>
        {/foreach}
    {/if}



    <link rel="stylesheet" href="{Constant::DEFAULT_URL}/css/{$theme}/css.css" />
<title>{$title}</title>
</head>
<body {if !$smarty.session.login} id="notLog"{/if}>
{*
	<div id="entete">
		{if !$login}
		<p id="headerLogo">
			<a href="{Constant::DEFAULT_URL}">

			<img src="{Constant::DEFAULT_URL}/images/logo.png" alt="Immo manageur" /> </a>
		</p>
		{/if} {if $user}
		<p id="headerName">
			{$user->getName()} {$user->getFirstname()} - <a
				href="{Constant::DEFAULT_URL}/mod-login/disconnect">Se déconnecter</a>
		</p>
		{/if}
		<hr class="invi clear" />
	</div>

	{if $login neq '1'}
	{include file='tpl_default/menuVertical.tpl' h1="" menu=$mainMenu idMenu="menuPrincipal"}


	<div id="wrapper" class="{if $smarty.session.etatMenuVertical neq 'repli'}depli{else}repli{/if}">{/if}
	*}
<!-- Fixed navbar -->

{if $smarty.session.login}

<div class="navbar navbar-default navbar-fixed-top" role="navigation">

        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>


        </div>

        <div class="navbar-collapse collapse">


            <ul class="nav navbar-nav">


                {foreach name="monMenu" from=$mainMenu item=item}
                    {if $item.submenu}
                        <li class="dropdown {if $smarty.get.module eq $item.module}active{/if}" >
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                {if $item.logo}<img src="{$item.logo}" alt="{$item.libelle}" />
                                {else}<img src="{Constant::DEFAULT_URL_LOGO_MODULES}" alt="{$item.libelle}" />{/if}
                                {*<span class="visible-xs-block">{$item.libelle}</span>*}
                                <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                {foreach $item.submenu as $sm}
                                    <li {if ($smarty.get.module eq $sm.module) && ($smarty.get.page eq $sm.page)} class="active"{/if}><a href="{$sm.url}">{*<img src="{$sm.logo}" />*} {$sm.libelle}</a></li>
                                {/foreach}
                            </ul>
                        </li>
                        {else}
                    <li><a class="{if $item.url eq Tools::create_url($user,$smarty.get.module,$smarty.get.page,$smarty.get.action)}actif{/if}{if $item.moduleName eq $smarty.get.module} actifM{/if} {if $smarty.foreach.monMenu.first} first{/if}{if $smarty.foreach.monMenu.last} last{/if}"
                           href="{$item.url}" title="{$item.libelle}">

                            {if $item.logo}<img src="{$item.logo}" alt="{$item.libelle}" />{else}<img src="{Constant::DEFAULT_URL_LOGO_MODULES}" alt="{$item.libelle}" />{/if}
                            {*{$item.libelle}*}

                            {*<span class="libel">{$item.libelle}</span>*}

                        </a>

                    </li>
                    {/if}



                {/foreach}


            </ul>




        </div><!--/.nav-collapse -->
    <div id="topPurple" >
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2">
                <a id="logoApp" href="{Constant::DEFAULT_URL}"><img src="{Constant::DEFAULT_URL}/images/logo.png" alt="Immo manageur" /></a>
                </div>
                <div class="col-md-7">{if $smarty.session.login}{/if}</div>
                <div id="blocDisconnect" class="col-md-3 text-right">
                    {if $smarty.session.login}<a href="{Tools::create_url($user,'user','see',$user->getIdUser())}"><i class="fa fa-user"></i> mon compte</a> - <i class="fa fa-close"></i> <a href="{Tools::create_url($user,'login','disconnect')}">Se déconnecter</a>{/if}</div>
            </div>
        </div>
    </div>
    {/if}
</div>
