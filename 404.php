<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2013 lovepsone
+--------------------------------------------------------+
| Filename: 404.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	define("EXCLUDE_PANEL", true);

	require_once "maincore.php";
	ob_start();
	require_once THEMES."templates/header.php";

	$txt_url = "[<a href='".BASEDIR.WCF::$cfgSetting['opening_page']."'>".WCF::$locale['modul_404_link']."</a>]";

	echo"<table width='800' align='center' class='tbl-border center'><tr><td>";
	opentable();
	echo"<tr><td align='center'>".WCF::$FW->showbanners()."<br><br></td></tr>";
	echo"<tr><td align='center'>".WCF::$locale['modul_404'].$txt_url."</td></tr>";
	closetable();
	echo"</table>";


	WCF::ReturnForm(40, BASEDIR.WCF::$cfgSetting['opening_page']);

	require_once THEMES."templates/footer.php";
?>