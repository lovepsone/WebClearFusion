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
			mysql_query("UPDATE ".DB_SETTINGS." SET `settings_value`='".stripinput($_POST['servername'])."' WHERE `settings_name`='servername'") or trigger_error(mysql_error());
			mysql_query("UPDATE ".DB_SETTINGS." SET `settings_value`='".stripinput($_POST['urlserver']).(strrchr($_POST['urlserver'],"/") != "/" ? "/" : "")."' WHERE `settings_name`='urlserver'") or trigger_error(mysql_error());
			mysql_query("UPDATE ".DB_SETTINGS." SET `settings_value`='".addslashes($_POST['intro'])."' WHERE `settings_name`='serverintro'") or trigger_error(mysql_error());
			mysql_query("UPDATE ".DB_SETTINGS." SET `settings_value`='".stripinput($_POST['default_module'])."' WHERE `settings_name`='default_module'") or trigger_error(mysql_error());
			mysql_query("UPDATE ".DB_SETTINGS." SET `settings_value`='".stripinput($_POST['exclude_left'])."' WHERE `settings_name`='exclude_left'") or trigger_error(mysql_error());
			mysql_query("UPDATE ".DB_SETTINGS." SET `settings_value`='".stripinput($_POST['exclude_right'])."' WHERE `settings_name`='exclude_right'") or trigger_error(mysql_error());
		}

	$settings = array();
	selectdb(wcf);
	$result = mysql_query("SELECT * FROM ".DB_SETTINGS."") or trigger_error(mysql_error());
	while ($data = mysql_fetch_array($result))
		{
			$settings[$data['settings_name']] = $data['settings_value'];
		}

	echo"<form name='settingsform' method='post'>";
	opentable();
	echo"<tr><td align='center' class='tbl' colspan='2'>".$txt['admin_settings']."</td></tr>";

	echo"<tr><td align='center' width='40%' class='small'>".$txt['admin_settings_nameserver']."</td>";
	echo"<td width='60%'><input type='text' name='servername' value='".$settings['servername']."' maxlength='255' class='textbox' style='width:230px;'/></td></tr>";

	echo"<tr><td align='center' width='40%' class='small'>".$txt['admin_settings_urlserver']."</td>";
	echo"<td width='60%'><input type='text' name='urlserver' value='".$settings['urlserver']."' maxlength='255' class='textbox' style='width:230px;'/></td></tr>";

	echo"<tr><td align='center' width='40%' class='small'>".$txt['admin_settings_intro']."<br/><span class='small2'>".$txt['admin_settings_intro_title']."</span></td>";
	echo"<td width='60%'><textarea name='intro' cols='50' rows='6' class='textbox' style='width:230px;'>".phpentities(stripslashes($settings['serverintro']))."</textarea></td></tr>";

	echo"<tr><td align='center' width='40%' class='small'>".$txt['admin_settings_start_unit']."</td>";
	echo"<td width='60%'><input type='text' name='default_module' value='".$settings['default_module']."' maxlength='100' class='textbox' style='width:230px;' /></td></tr>";

	echo"<tr><td align='center' width='40%' class='small'>".$txt['admin_settings_off_left_p']."<br/><span class='small2'>".$txt['admin_settings_off_p_title']."</span></td>";
	echo"<td width='60%'><textarea name='exclude_right' cols='50' rows='5' class='textbox' style='width:230px;'>".$settings['exclude_left']."</textarea></td></tr>";

	echo"<tr><td align='center' width='40%' class='small'>".$txt['admin_settings_off_right_p']."<br/><span class='small2'>".$txt['admin_settings_off_p_title']."</span></td>";
	echo"<td width='60%'><textarea name='exclude_right' cols='50' rows='5' class='textbox' style='width:230px;'>".$settings['exclude_right']."</textarea></td></tr>";

	echo"<tr><td align='center' colspan='2'><input type='submit' name='savesettings' value='".$txt['admin_savesettings']."' class='button' /></td></tr>";
	closetable();
	echo"</form>";
?>