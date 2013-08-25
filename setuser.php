<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2013 lovepsone
+--------------------------------------------------------+
| Filename: setuser.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	define("EXCLUDE_PANEL_USERS", true);

	require_once "maincore.php";
	ob_start();
	require_once THEMES."templates/header.php";

	$txt_url = "[<a href='".BASEDIR.WCF::$cfgSetting['opening_page']."'>".WCF::$locale['modul_setuser_link']."</a>]";

	if ((isset($_GET['action']) && $_GET['action'] == "auth") && (isset($_SESSION['user_id']) && WCF::isnum($_SESSION['user_id'])))
	{
		$txt_page = WCF::$locale['modul_setuser_sucess_auth'].ucfirst(strtolower($_SESSION['user_name'])).WCF::$locale['modul_setuser_wait'].$txt_url;
		$opening_page = BASEDIR.WCF::$cfgSetting['opening_page'];
	}
	elseif (isset($_GET['action']) && $_GET['action'] == "error")
	{
		$txt_page = WCF::$locale['modul_setuser_errors_auth'].WCF::$locale['modul_setuser_wait'].$txt_url;
		$opening_page = BASEDIR.WCF::$cfgSetting['opening_page'];
	}
	elseif ((isset($_GET['action']) && $_GET['action'] == "logout") && (isset($_SESSION['user_id']) && WCF::isnum($_SESSION['user_id'])))
	{
		$txt_page = WCF::$locale['modul_setuser_logout'].WCF::$locale['modul_setuser_wait'].$txt_url;

    		unset($_SESSION['user_id']);
    		unset($_SESSION['ip']);
    		unset($_SESSION['realmd_id']);
		unset($_SESSION['user_name']);
		unset($_SESSION['password']);
		unset($_SESSION['gmlevel']);
		unset($_SESSION['bonuses']);
    		session_destroy();
		$opening_page = BASEDIR.WCF::$cfgSetting['opening_page'];
	}

	echo"<table width='800' align='center' class='tbl-border center'><tr><td>";
	opentable();
	echo"<tr><td align='center'>".WCF::$FW->showbanners()."<br><br></td></tr>";
	echo"<tr><td align='center'>".$txt_page."</td></tr>";
	closetable();
	echo"</table>";


	WCF::ReturnForm(40, $opening_page);

	require_once THEMES."templates/footer.php";
?>