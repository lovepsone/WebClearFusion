<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2012 lovepsone
+--------------------------------------------------------+
| Filename: auth_acp_panel.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	if (isset($_POST['log_in_acp']) && (isset($_POST['realm_id']) && isnum($_POST['realm_id'])))
		{
			redirect(BASEDIR."setuser.php?action=login&realmd_id=".$_POST['realm_id']);
		}
	if (isset($_SESSION['user_id']) || ($_SESSION['ip'] == $_SERVER['REMOTE_ADDR']))
		{
			openside();
			echo"<tr><td valign='middle'><img src='".PANELS."auth_acp_panel/auth_acp_panel.png' width='170'></td></tr>";

			selectdb("realmd");
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