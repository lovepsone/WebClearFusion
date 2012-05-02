<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: user_or_server_panel_acp.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	SelectDataBase("realmd");
	$result = db_query("SELECT * FROM `realmlist` WHERE `id`='".$_SESSION['realmd_id']."'");
	if($data = db_assoc($result)) { $realm_game_name = $data['name']; }

	$result = db_query("SELECT * FROM `account` WHERE `id`='".$_SESSION['user_id']."'");
	if($data = db_assoc($result))
		{
			openside();
			echo"<tr><td align='left' class='tbl'>".$txt['menu_acp_info_acc']."</td></tr>";
			echo"<tr><td align='right' class='tbl1'>".$data['username']."</td></tr>";

			echo"<tr><td align='left' class='tbl'>".$txt['menu_acp_info_type_acc']."</td></tr>";
			echo"<tr><td align='right' class='tbl1'>".get_expansion($data['expansion'])."</td></tr>";

			echo"<tr><td align='left' class='tbl'>".$txt['menu_acp_info_access']."</td></tr>";
			echo"<tr><td align='right' class='tbl1'>".display_access_form($data['gmlevel'])."</td></tr>";

			echo"<tr><td align='left' class='tbl'>".$txt['menu_acp_info_reg_mail']."</td></tr>";
			echo"<tr><td align='right' class='tbl1'>".$data['email']."</td></tr>";

			echo"<tr><td align='left' class='tbl'>".$txt['menu_acp_info_lang']."</td></tr>";
			echo"<tr><td align='right' class='tbl1'>".get_locale($data['locale'])."</td></tr>";

			echo"<tr><td align='left' class='tbl'>".$txt['menu_acp_info_online']."</td></tr>";
			echo"<tr><td align='right' class='tbl1'>";
			if ($data['active_realm_id'] != 0) { echo $txt['menu_acp_info_game_on'];} else { echo $txt['menu_acp_info_game_off']; }
			echo"</td></tr>";

			echo"<tr><td align='left' class='tbl'>".$txt['menu_acp_info_date_reg']."</td></tr>";
			echo"<tr><td align='right' class='tbl1'>".$data['joindate']."</td></tr>";

			echo"<tr><td align='left' class='tbl'>".$txt['menu_acp_info_date_game']."</td></tr>";
			echo"<tr><td align='right' class='tbl1'>".$data['last_login']."</td></tr>";

			echo"<tr><td align='left' class='tbl'>".$txt['menu_acp_info_last_ip']."</td></tr>";
			echo"<tr><td align='right' class='tbl1'>".$data['last_ip']."</td></tr>";

			echo"<tr><td align='left' class='tbl'>".$txt['menu_acp_info_linking_ip']."</td></tr>";
			echo"<tr><td align='right' class='tbl1'>";
			if ($data['locked'] == 1) { echo $txt['menu_acp_info_linking_ip_on'];} else { echo $txt['menu_acp_info_linking_ip_off']; }
			echo"</td></tr>";

			echo"<tr><td align='left' class='tbl'>".$txt['menu_acp_info_game_realm']."</td></tr>";
			echo"<tr><td align='right' class='tbl1'>".$realm_game_name."</td></tr>";
       			closeside();
		}
?>