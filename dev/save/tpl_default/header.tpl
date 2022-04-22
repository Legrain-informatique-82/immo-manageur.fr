<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<meta name="robots" content="noindex,nofollow" />



<link rel="stylesheet"
	href="{Constant::DEFAULT_URL}/css/{Constant::THEME}/demo_page.css" />
<link rel="stylesheet"
	href="{Constant::DEFAULT_URL}/css/{Constant::THEME}/demo_table.css" />
<link rel="stylesheet"
	href="{Constant::DEFAULT_URL}/css/{Constant::THEME}/css.css" />
<link href="{Constant::DEFAULT_URL}/css/{Constant::THEME}/uploadify.css"
	type="text/css" rel="stylesheet" />
<link rel="stylesheet"
	href="{Constant::DEFAULT_URL}/css/{Constant::THEME}/jquery-ui-1.8.13.custom.css" />

<!--[if lte IE 8]>
   <link rel="stylesheet" href="{Constant::DEFAULT_URL}/css/lessIe9.css" />
<![endif]-->

<!--[if lte IE 7]>
   <link rel="stylesheet" href="{Constant::DEFAULT_URL}/css/lessIe8.css" />
<![endif]-->
<title>{$title}</title>
</head>
<body>

	<div id="entete">
		{if !$login}
		<p id="headerLogo">
			<a href="{Constant::DEFAULT_URL}"><img
				src="{Constant::DEFAULT_URL}/images/logo.png" alt="" /> </a>
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
	<div id="wrapper">{/if}