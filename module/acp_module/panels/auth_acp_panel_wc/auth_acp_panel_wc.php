<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2012 lovepsone
+--------------------------------------------------------+
| Filename: auth_acp_panel_wc.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	$user_ip = isset($_SESSION['ip']) ? @$_SESSION['ip'] : "";

	if (isset($_POST['log_in_acp']) && (isset($_POST['realm_id']) && isnum($_POST['realm_id'])))
		{
			redirect($modules['acp_module']."setuser.php?action=login&realmd_id=".$_POST['realm_id']);
		}
	elseif (isset($_SESSION['user_id']) || ($user_ip == $_SERVER['REMOTE_ADDR']))
		{
			openside();
			echo"<tr><td valign='middle'><img src='".$modules['acp_module']."panels/auth_acp_panel_wc/auth_acp_panel.png' width='170'></td></tr>";

			SelectDataBase("realmd");
			$result_list = db_query("SELECT * FROM `realmlist`");
			$realms_list = "";

			while ($data_list = db_array($result_list))
				{
					$realms_list .= "<option value='".$data_list['id']."'>".$data_list['name']."</option>";
				}

			echo"<form method='post'>";
			echo"<tr><td width='100%'><hr></td></tr>";
			echo"<tr><td align='center'>".$txt['menu_auth_log_in_acp']."<br><br><select name='realm_id' class='textbox' style='width:150px'>".$realms_list."</select></td></tr>";
			echo"<tr><td align='center'><br><input type='submit' name='log_in_acp' value='".$txt['menu_auth_enter']."' class='button' /></td></tr>";
			echo"</form>";
			closeside();
		}
?>