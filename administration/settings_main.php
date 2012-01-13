<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2012 lovepsone
+--------------------------------------------------------+
| Filename: settings_main.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	require_once "../maincore.php";
	require_once THEMES."templates/header.php";

	if (isset($_POST['savesettings']))
		{
			selectdb(wcf);
			db_query("UPDATE ".DB_SETTINGS." SET `settings_value`='".stripinput($_POST['servername'])."' WHERE `settings_name`='servername'");
			db_query("UPDATE ".DB_SETTINGS." SET `settings_value`='".stripinput($_POST['serverurl']).(strrchr($_POST['serverurl'],"/") != "/" ? "/" : "")."' WHERE `settings_name`='serverurl'");
			db_query("UPDATE ".DB_SETTINGS." SET `settings_value`='".stripinput($_POST['serverbanner'])."' WHERE `settings_name`='serverbanner'");
			db_query("UPDATE ".DB_SETTINGS." SET `settings_value`='".addslashes($_POST['intro'])."' WHERE `settings_name`='serverintro'");
			db_query("UPDATE ".DB_SETTINGS." SET `settings_value`='".stripinput($_POST['opening_page'])."' WHERE `settings_name`='default_module'");
			db_query("UPDATE ".DB_SETTINGS." SET `settings_value`='".stripinput($_POST['langset'])."' WHERE `settings_name`='lang'");
			db_query("UPDATE ".DB_SETTINGS." SET `settings_value`='".$_POST['themesset']."' WHERE `settings_name`='theme'");
			db_query("UPDATE ".DB_SETTINGS." SET `settings_value`='".stripinput($_POST['exclude_left'])."' WHERE `settings_name`='exclude_left'");
			db_query("UPDATE ".DB_SETTINGS." SET `settings_value`='".stripinput($_POST['exclude_upper'])."' WHERE `settings_name`='exclude_upper'");
			db_query("UPDATE ".DB_SETTINGS." SET `settings_value`='".stripinput($_POST['exclude_lower'])."' WHERE `settings_name`='exclude_lower'");
			db_query("UPDATE ".DB_SETTINGS." SET `settings_value`='".stripinput($_POST['exclude_right'])."' WHERE `settings_name`='exclude_right'");
			return_form(1,'settings_main.php');
		}

	$settings = array();
	selectdb(wcf);
	$result = db_query("SELECT * FROM ".DB_SETTINGS."");

	while ($data = db_array($result))
		{
			$settings[$data['settings_name']] = $data['settings_value'];
		}

	$themes_files = makefilelist(THEMES, ".|..|templates", true, "folders");
	$lang_files = makefilelist(LANG, ".|..", true, "folders");

	opentable();
	echo"<form name='settingsform' method='post'>";
	echo"<tr><td align='center' class='tbl' colspan='2'>".$txt['admin_settings']."</td></tr>";

	echo"<tr><td align='center' width='40%' class='small'>".$txt['admin_settings_nameserver']."</td>";
	echo"<td width='60%'><input type='text' name='servername' value='".$settings['servername']."' maxlength='255' class='textbox' style='width:230px;'/></td></tr>";

	echo"<tr><td align='center' width='40%' class='small'>".$txt['admin_settings_urlserver']."</td>";
	echo"<td width='60%'><input type='text' name='serverurl' value='".$settings['serverurl']."' maxlength='255' class='textbox' style='width:230px;'/></td></tr>";

	echo"<tr><td align='center' width='40%' class='small'>".$txt['admin_settings_serverbanner']."</td>";
	echo"<td width='60%'><input type='text' name='serverbanner' value='".$settings['serverbanner']."' maxlength='255' class='textbox' style='width:230px;'/></td></tr>";

	echo"<tr><td align='center' width='40%' class='small'>".$txt['admin_settings_intro']."<br/><span class='small2'>".$txt['admin_settings_intro_title']."</span></td>";
	echo"<td width='60%'><textarea name='intro' cols='50' rows='6' class='textbox' style='width:230px;'>".phpentities(stripslashes($settings['serverintro']))."</textarea></td></tr>";

	echo"<tr><td align='center' width='40%' class='small'>".$txt['admin_settings_start_unit']."</td>";
	echo"<td width='60%'><input type='text' name='opening_page' value='".$settings['opening_page']."' maxlength='100' class='textbox' style='width:230px;' /></td></tr>";

	echo"<tr><td align='center' width='40%' class='small'>".$txt['admin_settings_lang']."</td>";
	echo"<td width='60%'><select name='langset' class='textbox'>";
	echo makefileopts($lang_files, $settings['lang']);
	echo"</select></td></tr>";

	echo"<tr><td align='center' width='40%' class='small'>".$txt['admin_settings_themes']."</td>";
	echo"<td width='60%'><select name='themesset' class='textbox'>";
	echo makefileopts($themes_files, $settings['theme']);
	echo"</select></td></tr>";

	echo"<tr><td align='center' width='40%' class='small'>".$txt['admin_settings_off_left_p']."<br/><span class='small2'>".$txt['admin_settings_off_p_title']."</span></td>";
	echo"<td width='60%'><textarea name='exclude_left' cols='50' rows='5' class='textbox' style='width:230px;'>".$settings['exclude_left']."</textarea></td></tr>";

	echo"<tr><td align='center' width='40%' class='small'>".$txt['admin_settings_off_upper_p']."<br/><span class='small2'>".$txt['admin_settings_off_p_title']."</span></td>";
	echo"<td width='60%'><textarea name='exclude_upper' cols='50' rows='5' class='textbox' style='width:230px;'>".$settings['exclude_upper']."</textarea></td></tr>";

	echo"<tr><td align='center' width='40%' class='small'>".$txt['admin_settings_off_lower_p']."<br/><span class='small2'>".$txt['admin_settings_off_p_title']."</span></td>";
	echo"<td width='60%'><textarea name='exclude_lower' cols='50' rows='5' class='textbox' style='width:230px;'>".$settings['exclude_lower']."</textarea></td></tr>";

	echo"<tr><td align='center' width='40%' class='small'>".$txt['admin_settings_off_right_p']."<br/><span class='small2'>".$txt['admin_settings_off_p_title']."</span></td>";
	echo"<td width='60%'><textarea name='exclude_right' cols='50' rows='5' class='textbox' style='width:230px;'>".$settings['exclude_right']."</textarea></td></tr>";

	echo"<tr><td align='center' colspan='2'><input type='submit' name='savesettings' value='".$txt['admin_savesettings']."' class='button' /></td></tr>";
	echo"</form>";
	closetable();

	require_once THEMES."templates/footer.php";
?>