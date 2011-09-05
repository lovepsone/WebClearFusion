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
| (ru): при редактировании файла, файл нужно сохранять
| в кодировке UTF-8 без BOM
| (en): when editing a file, the file must be saved
| in utf-8 encoding with no BOM
+--------------------------------------------------------*/

/*-------------------------------------------------------+
| panel_position = 0 - center
| panel_position = 1 - left
| panel_position = 2 - right
+--------------------------------------------------------*/

	$w_connect = mysql_connect($config['whostname'], $config['wusername'], $config['wpassword']);
	mysql_select_db($config['wdbName'], $w_connect);
	mysql_query("SET NAMES '".$config['encoding']."'");

  	$panels_center = mysql_query("SELECT `panel_id`, `panel_url`  FROM `wcf_panels` WHERE `panel_position`= 0") or trigger_error(mysql_error());
	$panel_center = mysql_fetch_array($panels_center);

  	$panels_left = mysql_query("SELECT `panel_id`, `panel_url`  FROM `wcf_panels` WHERE `panel_position`= 1") or trigger_error(mysql_error());
	$panel_left = mysql_fetch_array($panels_left);

  	$panels_right = mysql_query("SELECT `panel_id`, `panel_url`  FROM `wcf_panels` WHERE `panel_position`= 2") or trigger_error(mysql_error());
	$panel_right = mysql_fetch_array($panels_right);

?>