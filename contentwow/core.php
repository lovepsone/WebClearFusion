<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2012 lovepsone
+--------------------------------------------------------+
| Filename: core.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	selectdb("realmd");
	$config['namber_realmd'] = db_num_rows(db_query("SELECT * FROM `realmlist`"));
	$config['defult_realmd_id'] = db_result(db_query("SELECT `id` FROM `realmlist`"),0);

	//=============================================================================================================
	// Запускаем дополнительные функции и данные\Run additional features and data
	//=============================================================================================================
	require_once CONTENT_WOW."include/include_simple_cacher.php";
	require_once CONTENT_WOW."include/functions.php";
	require_once CONTENT_WOW."include/include_item_table.php";
	require_once CONTENT_WOW."include/include_player_data.php";
	require_once CONTENT_WOW."include/include_spell_data.php";
	require_once CONTENT_WOW."include/include_spell_details.php";
	require_once CONTENT_WOW."include/include_spell_table.php";
	require_once CONTENT_WOW."include/include_report_generator.php";
	require_once CONTENT_WOW."include/ajax_tooltip.php";
	require_once CONTENT_WOW."include/include_talent_calc.php";
	require_once CONTENT_WOW."include/include_talent_table.php";

	function include_files_cw($patch)
		{
			global $config, $txt;

			if ($config['type_server'] = '1' || $config['type_server'] = '2')
				{
					require_once CONTENT_WOW.$patch;
				}
			/*else
				{
					
				}*/
			return;
		}

	function show_realms_table()
		{
			global $config, $txt;

			if ($config['type_server'] = '1' || $config['type_server'] = '2')
				{
					selectdb("realmd");
					$result = db_query("SELECT * FROM `realmlist`");
					$realms_list = "";
					while ($data = db_array($result))
						{
							$realms_list .= "<option value='".$data['id']."'>".$data['name']."</option>";
						}
					echo"<form method='post'>";
					echo"<tr><td width='100%'><hr></td></tr>";
					echo"<tr><td align='center'>".$txt['menu_auth_log_in_acp']."<br><select name='realm_id' class='textbox' style='width:150px'>".$realms_list."</select></td></tr>";
					echo"<tr><td align='center'><input type='submit' name='log_in_acp' value='".$txt['menu_auth_enter']."' class='button' /></td></tr>";
					echo"</form>";
				}
		}

	function login_or_out_acp_table()
		{
			global $_GET, $_SESSION, $txt_page, $txt, $opening_page, $config, $txt_url;

			if ((isset($_GET['action']) && $_GET['action'] == "login") && (isset($_GET['realmd_id']) && isnum($_GET['realmd_id'])))
				{
					selectdb("realmd");
					$check_ban_acc = db_query("SELECT * FROM `account_banned` WHERE `id`='".$_SESSION['user_id']."' AND `active`='1'");
					$check_ban_ip = db_query("SELECT * FROM `ip_banned` WHERE `ip`='".$_SESSION['ip']."'");
		
					if (db_num_rows($check_ban_acc))
						{
							$data_ban_acc = db_assoc($check_ban_acc);
							$txt_page = $txt['modul_setuser_ban_acc'].$data_ban_acc['banreason'];
							$opening_page = BASEDIR.$config['opening_page'];	
						}
					elseif (db_num_rows($check_ban_ip))
						{
							$data_ban_ip = db_assoc($check_ban_ip);
							$txt_page = $txt['modul_setuser_ban_ip'].$data_ban_ip['banreason'];
							$opening_page = BASEDIR.$config['opening_page'];
						}
					else
						{
							$txt_page = $txt['modul_setuser_login'].$txt['modul_setuser_wait'];
							$opening_page = ACP."index.php";
							$_SESSION['realmd_id'] = $_GET['realmd_id'];
						}
				}
			elseif (isset($_GET['action']) && $_GET['action'] == "out_acp")
				{
		    			unset($_SESSION['realmd_id']);
					$txt_page = $txt['modul_setuser_out_acp'].$txt['modul_setuser_wait'].$txt_url;
					$opening_page = BASEDIR.$config['opening_page'];
				}
		}
?>