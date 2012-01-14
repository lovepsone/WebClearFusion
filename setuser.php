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

	if ((isset($_GET['action']) && $_GET['action'] == "auth") AND isset($_SESSION['user_id']) AND $_SESSION['user_id'] != "")
		{
			$txt_page = $txt['modul_setuser_sucess_auth'].ucfirst(strtolower($_SESSION['user_name'])).$txt['modul_setuser_wait'];
		}
	elseif ((isset($_GET['action']) && $_GET['action'] == "auth") AND !isset($_SESSION['user_id']) AND $_SESSION['user_id'] == "")
		{
			$txt_page = $txt['modul_setuser_errors_auth'].$txt['modul_setuser_wait'];
		}
	elseif ((isset($_GET['action']) && $_GET['action'] == "logout") AND isset($_SESSION['user_id']) AND $_SESSION['user_id'] != "")
		{
			$txt_page = $txt['modul_setuser_logout'].$txt['modul_setuser_wait'];
			session_start();
			selectdb(wcf);
       			db_query("UPDATE ".DB_USERS." SET `user_online`='0' WHERE (`user_id`='".$_SESSION['user_id']."')");

    			unset($_SESSION['user_id']);
    			unset($_SESSION['ip']);
    			session_destroy();
		}

	echo"<table width='800' align='center' class='tbl-border center'><tr><td>";
	opentable();
	echo"<tr><td align='center'>".showbanners()."<br><br></td></tr>";
	echo"<tr><td align='center'>".$txt_page."[<a href='".BASEDIR.$config['opening_page']."'>".$txt['modul_setuser_link']."</a>]</td></tr>";
	closetable();
	echo"</table>";


	return_form(40,$config['opening_page']);

	require_once THEMES."templates/footer.php";
?>