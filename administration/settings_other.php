<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2012 lovepsone
+--------------------------------------------------------+
| Filename: settings_other.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	require_once "../maincore.php";
	require_once THEMES."templates/admin_header.php";

	if (isset($_POST['savesettings']))
		{
			selectdb("wcf");
			db_query("UPDATE ".DB_SETTINGS." SET `settings_value`='".stripinput($_POST['kcaptcha_enable_auth'])."' WHERE `settings_name`='kcaptcha_enable_auth'");
			db_query("UPDATE ".DB_SETTINGS." SET `settings_value`='".stripinput($_POST['level_administration'])."' WHERE `settings_name`='level_administration'");
			redirect(WCF_SELF);
		}

	$settings = array();
	selectdb("wcf");
	$result = db_query("SELECT * FROM ".DB_SETTINGS."");

	while ($data = db_array($result))
		{
			$settings[$data['settings_name']] = $data['settings_value'];
		}
	if ($settings['kcaptcha_enable_auth'] == "0")
		{
			$kcaptcha_opts .= "<option value='0' selected='selected'>".$txt['no']."</option>";
			$kcaptcha_opts .= "<option value='1'>".$txt['yes']."</option>";
		}
	elseif ($settings['kcaptcha_enable_auth'] == "1")
		{
			$kcaptcha_opts .= "<option value='1' selected='selected'>".$txt['yes']."</option>";
			$kcaptcha_opts .= "<option value='0'>".$txt['no']."</option>";
		}

	opentable();
	echo"<form name='settingsform' method='post'>";
	echo"<tr><td align='center' class='tbl' colspan='2'>".$txt['admin_setting_other']."</td></tr>";

	echo"<tr><td align='center' width='50%' class='small'>".$txt['admin_setting_other_k']."</td>";
	echo"<td width='50%'><select name='kcaptcha_enable_auth' class='textbox'>".$kcaptcha_opts."</select></td></tr>";

	echo"<tr><td align='center' width='50%' class='small'>".$txt['admin_setting_other_lvl_admin']."</td>";
	echo"<td width='50%'><select name='level_administration' class='textbox'>".access($settings['level_administration'])."</select></td></tr>";

	echo"<tr><td align='center' colspan='2'><input type='submit' name='savesettings' value='".$txt['admin_savesettings']."' class='button' /></td></tr>";
	echo"</form>";
	closetable();

	require_once THEMES."templates/footer.php";
?>