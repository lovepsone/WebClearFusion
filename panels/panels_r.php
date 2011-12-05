<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: panels.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/
/*-------------------------------------------------------+
| panel_position = 0 - center
| panel_position = 1 - left
| panel_position = 2 - right
+--------------------------------------------------------*/

	selectdb(wcf);
  	$pr = mysql_query("SELECT `panel_id`, `panel_filename`  FROM ".DB_PANELS." WHERE `panel_position`= '2' AND `panel_status`='1'") or trigger_error(mysql_error());

	while($pr_open = mysql_fetch_array($pr))
		{
			if (file_exists(PANELS.$pr_open['panel_filename']."/".$pr_open['panel_filename'].".php"))
				{
					include PANELS.$pr_open['panel_filename']."/".$pr_open['panel_filename'].".php";
					echo"<br>";
				}
		}
?>