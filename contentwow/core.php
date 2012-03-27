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

	//=============================================================================================================
	// функция для импорта файлов content wow
	//=============================================================================================================
	function include_files_cw($patch)
		{
			global $config, $txt;

			if ($config['type_server'] = '1' || $config['type_server'] = '2')
				{
					require_once CONTENT_WOW.$patch;
				}
			return;
		}

	//=============================================================================================================
	// функция для выборки реалма
	//=============================================================================================================
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

	//=============================================================================================================
	// функция редиректе при выборке реалма
	//=============================================================================================================
	function redirect_realm_form()
		{
			global $_POST;

			if ($config['type_server'] = '1' || $config['type_server'] = '2')
				{
					if (isset($_POST['log_in_acp']) && (isset($_POST['realm_id']) && isnum($_POST['realm_id'])))
						{
							redirect(BASEDIR."setuser.php?action=login&realmd_id=".$_POST['realm_id']);
						}
				}
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

	//=============================================================================================================
	// функция основной авторизации на сайте
	//=============================================================================================================
	function auth()
		{
			global $_SESSION, $_SERVER, $_POST, $config, $CapchaInput, $password;

			selectdb("realmd");
   			$result = db_query('SELECT * FROM `account` WHERE `username`="'.strtoupper(addslashes($_POST['auth_name'])).'" AND `sha_pass_hash`="'.$password.'"');

   			if ((mysql_num_rows($result) == 1) && ($CapchaInput == 1))
      				{
					$data = db_assoc($result);
       					$_SESSION['user_id'] = (int)$data['id'];
       					$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
       					$_SESSION['user_name'] = strtoupper($_POST['auth_name']);
       					$_SESSION['password'] = strtoupper($password);
					$_SESSION['gmlevel'] = (int)$data['gmlevel'];
       					$_SESSION['lang'] = $config['lang'];
					unset($_SESSION['captcha_keystring']);
					
					//======================================
					// занесение юзера в таблицу
					selectdb("wcf");
					$data = db_assoc(db_query("SELECT * FROM ".DB_USERS." WHERE `user_id`='".$_SESSION['user_id']."' AND `user_name`='".$_SESSION['user_name']."'"));

					if ($data['user_id'] != $_SESSION['user_id'])
						{
							db_query("INSERT INTO ".DB_USERS." (`user_id`,`user_name`,`user_sha_pass_hash`) VALUES ('".$_SESSION['user_id']."','".$_SESSION['user_name']."','".$_SESSION['password']."')");
						}
					else
						{
							$_SESSION['bonuses'] = (int)$data['user_bonuses'];
						}
       				}
		}

	//=============================================================================================================
	// функция для проверки при регистрации на повторность учеток
	//=============================================================================================================
	function count_only_acc($acc)
		{
			selectdb("realmd");
      			$result = db_query("SELECT count(`username`) as kol FROM `account` WHERE `username` = '".strtoupper($acc)."'");
			return $result;
		}

	//=============================================================================================================
	// функция для создания учетки
	//=============================================================================================================
	function create_acc()
		{
			global $_SERVER, $_POST;
			selectdb("realmd");
      	 		db_query("INSERT INTO `account` (`username`,`sha_pass_hash`,`email`,`last_ip`,`locked`,`expansion`) VALUES (UPPER('".$_POST['new_acc']."'),SHA1(CONCAT(UPPER('".$_POST['new_acc']."'),':',UPPER('".$_POST['pass1']."'))),'".$_POST['email']."','".$_SERVER['REMOTE_ADDR']."','0','2')");
		}
?>