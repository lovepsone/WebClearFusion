<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2012 lovepsone
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

	$txt_url = "[<a href='".BASEDIR.$config['opening_page']."'>".$txt['modul_setuser_link']."</a>]";

	if ((isset($_GET['action']) && $_GET['action'] == "auth") && (isset($_SESSION['user_id']) && isnum($_SESSION['user_id'])))
		{
			$txt_page = $txt['modul_setuser_sucess_auth'].ucfirst(strtolower($_SESSION['user_name'])).$txt['modul_setuser_wait'].$txt_url;
			$opening_page = BASEDIR.$config['opening_page'];
		}
	elseif ((isset($_GET['action']) && $_GET['action'] == "auth") && (!isset($_SESSION['user_id']) && isnum($_SESSION['user_id'])))
		{
			$txt_page = $txt['modul_setuser_errors_auth'].$txt['modul_setuser_wait'].$txt_url;
			$opening_page = BASEDIR.$config['opening_page'];
		}
	elseif ((isset($_GET['action']) && $_GET['action'] == "logout") && (isset($_SESSION['user_id']) && isnum($_SESSION['user_id'])))
		{
			$txt_page = $txt['modul_setuser_logout'].$txt['modul_setuser_wait'].$txt_url;

    			unset($_SESSION['user_id']);
    			unset($_SESSION['ip']);
    			unset($_SESSION['realmd_id']);
    			session_destroy();
			$opening_page = BASEDIR.$config['opening_page'];
		}


	echo"<table width='800' align='center' class='tbl-border center'><tr><td>";
	opentable();
	echo"<tr><td align='center'>".showbanners()."<br><br></td></tr>";
	echo"<tr><td align='center'>".$txt_page."</td></tr>";
	closetable();
	echo"</table>";


	return_form(40,$opening_page);

	require_once THEMES."templates/footer.php";
?>