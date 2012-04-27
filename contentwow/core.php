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

	//=============================================================================================================
	// функции в основном связаны с content wow
	//=============================================================================================================
	selectdb("realmd");
	$config['namber_realmd'] = db_num_rows(db_query("SELECT * FROM `realmlist`"));
	$config['defult_realmd_id'] = db_result(db_query("SELECT `id` FROM `realmlist`"),0);

	//=============================================================================================================
	// проверяем существует ли account данного пользователя при авторизации на сайте
	//=============================================================================================================
	if (isset($_SESSION['user_id']) || $_SESSION['ip'] == $_SERVER['REMOTE_ADDR'])
		{
			selectdb("realmd");
			$data = db_assoc(db_query("SELECT count(`username`) as kol FROM `account` WHERE `username` = '".strtoupper($_SESSION['user_name'])."'"));
			if ($data['kol'] = 0)
				{
					db_query("INSERT INTO `account` (`username`,`sha_pass_hash`,`email`,`last_ip`,`locked`,`expansion`) VALUES (UPPER('".$_SESSION['user_name']."'),SHA1(CONCAT(UPPER('".$_SESSION['user_name']."'),':',UPPER('".$_SESSION['password']."'))),'".$_SESSION['emeil']."','".$_SERVER['REMOTE_ADDR']."','0','2')");
			 	}
		}

	//=============================================================================================================
	// Запускаем дополнительные функции и данные\Run additional features and data
	//=============================================================================================================
	require_once CONTENT_WOW."include/include_defult_const.php";
	require_once CONTENT_WOW."include/include_simple_cacher.php";
	require_once CONTENT_WOW."include/functions.php";
	require_once CONTENT_WOW."include/include_item_table.php";
	require_once CONTENT_WOW."include/include_player_data.php";
	require_once CONTENT_WOW."include/include_spell_data.php";
	require_once CONTENT_WOW."include/include_spell_details.php";
	require_once CONTENT_WOW."include/include_spell_table.php";
	require_once CONTENT_WOW."include/include_report_generator.php";
	require_once CONTENT_WOW."include/include_talent_calc.php";
	require_once CONTENT_WOW."include/include_talent_table.php";

	//=============================================================================================================
	// функция для импорта файлов content wow
	//=============================================================================================================
	function include_files_cw($patch)
		{
			global $config, $txt;

			if ($config['type_server'] == '1' || $config['type_server'] == '2')
				{
					require_once CONTENT_WOW.$patch;
				}
			return;
		}


	//=============================================================================================================
	// функция аторизации и логаута в ACP
	//=============================================================================================================
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