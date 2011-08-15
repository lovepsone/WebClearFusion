<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: index.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	require "conf.php";
	require "include/auth.php";

	if ($config['encoding'] == 'cp1251') $code_page = 'windows-1251';
   		else $code_page = 'utf-8';
?>
	<HTML>
	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
	<HEAD><link rel="SHORTCUT ICON" href="images/favicon.ico">
	<TITLE><?php echo  $config['servername']; ?></TITLE>
	<META http-equiv="content-type" content="text/html; charset=<?php echo  $code_page; ?>" /></HEAD>
	<BODY>
<?php
	if ($config['lang'] == 'en') require "lang/text.".$config['lang'].".php";
              else require "lang/text.".$config['lang'].".".$config['encoding'].".php";

	$cssfile = "themes/".$config['theme']."/style.css";
	$themefile = "themes/".$config['theme']."/theme.php";

	if (file_exists($themefile)) include($themefile);
   		else include("themes/default/theme.php");
?>
	<br><hr width=90%>
	<CENTER><FONT size=-1><?php echo  $config['copyright']; ?></FONT></CENTER>
	</BODY></HTML>

