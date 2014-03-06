<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2013 lovepsone
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
		WCF::$DB->query('UPDATE ?_settings SET `settings_value`= ? WHERE `settings_name`=?', WCF::$TF->stripinput($_POST['kcaptcha_enable_auth']), "kcaptcha_enable_auth");
		WCF::$DB->query('UPDATE ?_settings SET `settings_value`= ? WHERE `settings_name`=?', WCF::$TF->stripinput($_POST['level_administration']), "level_administration");
		WCF::redirect(WCF_SELF);
	}

	$settings = array(); $kcaptcha_opts = "";

	$rows = WCF::$DB->select(' -- CACHE: 180
					SELECT * FROM ?_settings');

	foreach ($rows as $numRow => $data)
	{
		$settings[$data['settings_name']] = $data['settings_value'];
	}

	if ($settings['kcaptcha_enable_auth'] == "0")
	{
		$kcaptcha_opts .= "<option value='0' selected='selected'>".WCF::$locale['no']."</option>";
		$kcaptcha_opts .= "<option value='1'>".WCF::$locale['yes']."</option>";
	}
	elseif ($settings['kcaptcha_enable_auth'] == "1")
	{
		$kcaptcha_opts .= "<option value='1' selected='selected'>".WCF::$locale['yes']."</option>";
		$kcaptcha_opts .= "<option value='0'>".WCF::$locale['no']."</option>";
	}

	opentable();
	echo"<form name='settingsform' method='post'>";
	echo"<tr><td align='center' class='tbl' colspan='2'>".WCF::$locale['admin_setting_other']."</td></tr>";

	echo"<tr><td align='center' width='50%' class='small'>".WCF::$locale['admin_setting_other_k']."</td>";
	echo"<td width='50%'><select name='kcaptcha_enable_auth' class='textbox'>".$kcaptcha_opts."</select></td></tr>";

	echo"<tr><td align='center' width='50%' class='small'>".WCF::$locale['admin_setting_other_lvl_admin']."</td>";
	echo"<td width='50%'><select name='level_administration' class='textbox'>".access($settings['level_administration'])."</select></td></tr>";

	echo"<tr><td align='center' colspan='2'><input type='submit' name='savesettings' value='".WCF::$locale['admin_savesettings']."' class='button' /></td></tr>";
	echo"</form>";
	closetable();

	require_once THEMES."templates/footer.php";
?>