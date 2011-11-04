<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: settings_main.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	$settings = array();
	selectdb(wcf);
	$result = mysql_query("SELECT * FROM `wcf_settings`") or trigger_error(mysql_error());
	while ($data = mysql_fetch_array($result))
		{
			$settings[$data['settings_name']] = $data['settings_value'];
		}
	echo $settings['servername'];
?>