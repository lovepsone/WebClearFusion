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
	require "include/functions.php";
	require "include/auth.php";

	if ($lang == 'en') require "lang/text.".$lang.".php";
              else require "lang/text.".$lang.".".$encoding.".php";

	$cssfile = "skins/$skin/style.css";
	$skinfile = "skins/$skin/skin.php";

	if ($encoding == 'cp1251') $code_page = 'windows-1251';
   		else $code_page = 'utf-8';

	if (file_exists($skinfile)) include($skinfile);
   		else include("skins/default/skin.php");
?>