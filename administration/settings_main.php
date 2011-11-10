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

	if (isset($_POST['savesettings']))
		{
			selectdb(wcf);
			mysql_query("UPDATE `wcf_settings` SET `settings_value`='".stripinput($_POST['servername'])."' WHERE `settings_name`='servername'") or trigger_error(mysql_error());
			mysql_query("UPDATE `wcf_settings` SET `settings_value`='".stripinput($_POST['urlserver']).(strrchr($_POST['urlserver'],"/") != "/" ? "/" : "")."' WHERE `settings_name`='urlserver'") or trigger_error(mysql_error());
		}

	$settings = array();
	selectdb(wcf);
	$result = mysql_query("SELECT * FROM `wcf_settings`") or trigger_error(mysql_error());
	while ($data = mysql_fetch_array($result))
		{
			$settings[$data['settings_name']] = $data['settings_value'];
		}

	echo"<form name='settingsform' method='post'>";
     	echo"<table width='100%' border='0' cellspacing='0' cellpadding='5' class='report'>";
	echo"<tr><td align='left' colspan='2' class='head'>".$txt['admin_settings']."</td></tr>";

	echo "<tr><td width='50%' class='page'>".$txt['admin_settings_nameserver']."</td>";
	echo "<td width='50%' class='page'><input type='text' name='servername' value='".$settings['servername']."' maxlength='255' class='textbox' style='width:230px;'/></td></tr>";

	echo "<tr><td width='50%' class='page'>".$txt['admin_settings_urlserver']."</td>";
	echo "<td width='50%' class='page'><input type='text' name='urlserver' value='".$settings['urlserver']."' maxlength='255' class='textbox' style='width:230px;'/></td></tr>";

	echo"<tr><td align='center' colspan='2' class='page'>";
	echo"<input type='submit' name='savesettings' value='".$txt['admin_savesettings']."' class='button' /></td>\n";
	echo"</table></form>";
?>