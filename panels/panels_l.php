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
  	$pl = mysql_query("SELECT `panel_id`, `panel_filename`  FROM ".DB_PANELS." WHERE `panel_position`= '1' AND `panel_status`='1'") or trigger_error(mysql_error());

	while($pl_open = mysql_fetch_array($pl))
		{
			if (file_exists(PANELS.$pl_open['panel_filename']."/".$pl_open['panel_filename'].".php"))
				{
							include PANELS.$pl_open['panel_filename']."/".$pl_open['panel_filename'].".php";
							echo"<br>";
				}
		}

?>