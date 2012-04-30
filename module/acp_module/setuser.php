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

	require_once "include/show_maincore.php";
	ob_start();
	require_once THEMES."templates/header.php";

	$txt_url = "[<a href='".BASEDIR.$config['opening_page']."'>".$txt['modul_setuser_link']."</a>]";

	if ((isset($_GET['action']) && $_GET['action'] == "login") && (isset($_GET['realmd_id']) && isnum($_GET['realmd_id'])))
		{
			selectdb("realmd");
			$check_ban_acc = db_query("SELECT * FROM `account_banned` WHERE `id`='".$_SESSION['user_id']."' AND `active`='1'");
			$check_ban_ip = db_query("SELECT * FROM `ip_banned` WHERE `ip`='".$_SESSION['ip']."'");
		
			if (db_num_rows($check_ban_acc))
				{
					$data_ban_acc = db_assoc($check_ban_acc);
					$txt_page = $txt['modul_setuser_ban_acc'].$data_ban_acc['banreason'];
					$opening_page = BASEDIR.$config['opening_page'];	
				}
			elseif (db_num_rows($check_ban_ip))
				{
					$data_ban_ip = db_assoc($check_ban_ip);
					$txt_page = $txt['modul_setuser_ban_ip'].$data_ban_ip['banreason'];
					$opening_page = BASEDIR.$config['opening_page'];
				}
			else
				{
					$txt_page = $txt['modul_setuser_login'].$txt['modul_setuser_wait'];
					$opening_page = $modules['acp_module']."index.php";
					$_SESSION['realmd_id'] = $_GET['realmd_id'];
				}
		}
	elseif (isset($_GET['action']) && $_GET['action'] == "out_acp")
		{
		    	unset($_SESSION['realmd_id']);
			$txt_page = $txt['modul_setuser_out_acp'].$txt['modul_setuser_wait'].$txt_url;
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