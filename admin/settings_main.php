<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2013 lovepsone
+--------------------------------------------------------+
| Filename: settings_main.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	require_once "../maincore.php";
	require_once THEMES."templates/admin_header.php";

	if (isset($_POST['savesettings']))
	{
		WCF::$DB->query('UPDATE ?_settings SET `settings_value`= ? WHERE `settings_name`= ?', WCF::$TF->stripinput($_POST['servername']), "servername");
		WCF::$DB->query('UPDATE ?_settings SET `settings_value`= ? WHERE `settings_name`= ?', WCF::$TF->stripinput($_POST['serverurl']).(strrchr($_POST['serverurl'],"/") != "/" ? "/" : ""), "serverurl");
		WCF::$DB->query('UPDATE ?_settings SET `settings_value`= ? WHERE `settings_name`= ?', WCF::$TF->stripinput($_POST['serverbanner']), "serverbanner");
		WCF::$DB->query('UPDATE ?_settings SET `settings_value`= ? WHERE `settings_name`= ?', $_POST['intro'], "serverintro");
		WCF::$DB->query('UPDATE ?_settings SET `settings_value`= ? WHERE `settings_name`= ?', WCF::$TF->stripinput($_POST['opening_page']), "default_module");
		WCF::$DB->query('UPDATE ?_settings SET `settings_value`= ? WHERE `settings_name`= ?', WCF::$TF->stripinput($_POST['langset']), "lang");
		WCF::$DB->query('UPDATE ?_settings SET `settings_value`= ? WHERE `settings_name`= ?', $_POST['themesset'], "theme");
		WCF::$DB->query('UPDATE ?_settings SET `settings_value`= ? WHERE `settings_name`= ?', WCF::$TF->stripinput($_POST['exclude_left']), "exclude_left");
		WCF::$DB->query('UPDATE ?_settings SET `settings_value`= ? WHERE `settings_name`= ?', WCF::$TF->stripinput($_POST['exclude_upper']), "exclude_upper");
		WCF::$DB->query('UPDATE ?_settings SET `settings_value`= ? WHERE `settings_name`= ?', WCF::$TF->stripinput($_POST['exclude_lower']), "exclude_lower");
		WCF::$DB->query('UPDATE ?_settings SET `settings_value`= ? WHERE `settings_name`= ?', WCF::$TF->stripinput($_POST['exclude_right']), "exclude_right");
		WCF::redirect(WCF_SELF);
	}

	$settings = array();
	$rows = WCF::$DB->select(' -- CACHE: 180
					SELECT * FROM ?_settings');
	foreach ($rows as $numRow => $data)
	{
		$settings[$data['settings_name']] = $data['settings_value'];
	}

	$themes_files = makefilelist(THEMES, ".|..|templates", true, "folders");
	$lang_files = makefilelist(LANG, ".|..", true, "folders");

	opentable();
	echo"<form name='settingsform' method='post'>";
	echo"<tr><td align='center' class='tbl' colspan='2'>".WCF::$locale['admin_settings']."</td></tr>";

	echo"<tr><td align='center' width='40%' class='small'>".WCF::$locale['admin_settings_nameserver']."</td>";
	echo"<td width='60%'><input type='text' name='servername' value='".$settings['servername']."' maxlength='255' class='textbox' style='width:230px;'/></td></tr>";

	echo"<tr><td align='center' width='40%' class='small'>".WCF::$locale['admin_settings_urlserver']."</td>";
	echo"<td width='60%'><input type='text' name='serverurl' value='".$settings['serverurl']."' maxlength='255' class='textbox' style='width:230px;'/></td></tr>";

	echo"<tr><td align='center' width='40%' class='small'>".WCF::$locale['admin_settings_serverbanner']."</td>";
	echo"<td width='60%'><input type='text' name='serverbanner' value='".$settings['serverbanner']."' maxlength='255' class='textbox' style='width:230px;'/></td></tr>";

	echo"<tr><td align='center' width='40%' class='small'>".WCF::$locale['admin_settings_intro']."<br/><span class='small2'>".WCF::$locale['admin_settings_intro_title']."</span></td>";
	echo"<td width='60%'><textarea name='intro' cols='50' rows='6' class='textbox' style='width:230px;'>".WCF::$TF->phpentities($settings['serverintro'])."</textarea></td></tr>";

	echo"<tr><td align='center' width='40%' class='small'>".WCF::$locale['admin_settings_start_unit']."</td>";
	echo"<td width='60%'><input type='text' name='opening_page' value='".$settings['opening_page']."' maxlength='100' class='textbox' style='width:230px;' /></td></tr>";

	echo"<tr><td align='center' width='40%' class='small'>".WCF::$locale['admin_settings_lang']."</td>";
	echo"<td width='60%'><select name='langset' class='textbox'>";
	echo makefileopts($lang_files, $settings['lang']);
	echo"</select></td></tr>";

	echo"<tr><td align='center' width='40%' class='small'>".WCF::$locale['admin_settings_themes']."</td>";
	echo"<td width='60%'><select name='themesset' class='textbox'>";
	echo makefileopts($themes_files, $settings['theme']);
	echo"</select></td></tr>";

	echo"<tr><td align='center' width='40%' class='small'>".WCF::$locale['admin_settings_off_left_p']."<br/><span class='small2'>".WCF::$locale['admin_settings_off_p_title']."</span></td>";
	echo"<td width='60%'><textarea name='exclude_left' cols='50' rows='5' class='textbox' style='width:230px;'>".$settings['exclude_left']."</textarea></td></tr>";

	echo"<tr><td align='center' width='40%' class='small'>".WCF::$locale['admin_settings_off_upper_p']."<br/><span class='small2'>".WCF::$locale['admin_settings_off_p_title']."</span></td>";
	echo"<td width='60%'><textarea name='exclude_upper' cols='50' rows='5' class='textbox' style='width:230px;'>".$settings['exclude_upper']."</textarea></td></tr>";

	echo"<tr><td align='center' width='40%' class='small'>".WCF::$locale['admin_settings_off_lower_p']."<br/><span class='small2'>".WCF::$locale['admin_settings_off_p_title']."</span></td>";
	echo"<td width='60%'><textarea name='exclude_lower' cols='50' rows='5' class='textbox' style='width:230px;'>".$settings['exclude_lower']."</textarea></td></tr>";

	echo"<tr><td align='center' width='40%' class='small'>".WCF::$locale['admin_settings_off_right_p']."<br/><span class='small2'>".WCF::$locale['admin_settings_off_p_title']."</span></td>";
	echo"<td width='60%'><textarea name='exclude_right' cols='50' rows='5' class='textbox' style='width:230px;'>".$settings['exclude_right']."</textarea></td></tr>";

	echo"<tr><td align='center' colspan='2'><input type='submit' name='savesettings' value='".WCF::$locale['admin_savesettings']."' class='button' /></td></tr>";
	echo"</form>";
	closetable();

	require_once THEMES."templates/footer.php";
?>