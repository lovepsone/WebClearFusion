<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: navigation_panel_acp.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	openside();
	selectdb("wcf");
	$result = db_query("SELECT `link_name`, `link_url`, `link_visibility` FROM ".DB_ACP_NAVIGATION_LINKS." WHERE `link_position`='1' OR `link_position`='2' ORDER BY `link_order`");

	if (db_num_rows($result))
		{
			if (isset($_SESSION['user_id']) || ($_SESSION['ip'] == $_SERVER['REMOTE_ADDR']) || isset($_SESSION['realmd_id']))
				{
					echo"<tr><td width='100%' valign='middle'>";
					echo" <a href='".$modules['acp_module']."setuser.php?action=out_acp' class='side'>".$txt['modul_acp_outh']."</a>";
					echo"</td></tr>";
				}
			while($data = db_array($result))
				{
					if (check_user($data['link_visibility']))
						{
							echo"<tr><td width='100%' valign='middle'>";
							if ($data['link_name'] != "---" && $data['link_url'] == "---")
								{
									echo"<div class='side-label'><strong>".$data['link_name']."</strong></div>";
								}
							else if ($data['link_name'] == "---" && $data['link_url'] == "---")
								{
									echo"<hr class='side-hr' />";
								}
							else
								{
									echo" <a href='".$modules['acp_module'].$data['link_url']."' class='side'>".$data['link_name']."</a>";
								}
							echo"</td></tr>";
						}
				}
		}
	else
		{
			echo $txt['no_links'];
		}
       	closeside();
?>