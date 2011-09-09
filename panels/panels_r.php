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

	$w_connect = mysql_connect($config['whostname'], $config['wusername'], $config['wpassword']);
	mysql_select_db($config['wdbName'], $w_connect);
	mysql_query("SET NAMES '".$config['encoding']."'");

  	$panels_right = mysql_query("SELECT `panel_id`, `panel_url`  FROM `wcf_panels` WHERE `panel_position`= 2") or trigger_error(mysql_error());
	$num_r = mysql_num_rows($panels_right);

	while($panel_right = mysql_fetch_array($panels_right))
		{
			require $panel_right[panel_url];
			if ($num_r > 1) echo"<hr>";
		}

?>