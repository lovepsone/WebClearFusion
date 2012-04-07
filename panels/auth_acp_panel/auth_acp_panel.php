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

	// wow content
	if (isset($_SESSION['user_id']) || ($_SESSION['ip'] == $_SERVER['REMOTE_ADDR']))
		{
			openside();
			echo"<tr><td valign='middle'><img src='".PANELS."auth_acp_panel/auth_acp_panel.png' width='170'></td></tr>";
			show_realms_table();
			closeside();
		}
?>