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

	session_start(); 
	require "conf/conf.php";
	require "include/functions.php";
	require "include/auth.php";
	require "include/protect.php";

	if ($config['encoding'] == 'cp1251') $code_page = 'windows-1251';
   		else $code_page = 'utf-8';

	if ($config['lang'] == 'en') require "lang/text.".$config['lang'].".".$config['encoding'].".php";
              else require "lang/text.".$config['lang'].".".$config['encoding'].".php";

	$cssfile = "themes/".$config['theme']."/style.css";
	$themefile = "themes/".$config['theme']."/theme.php";

	if (file_exists($themefile)) include($themefile);
   		else include("themes/default/theme.php");
?>