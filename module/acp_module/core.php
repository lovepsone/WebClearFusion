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

	require_once $modules['acp_module']."include/realmlist.php";

	function SelectDataBase($date_base)
		{
  			global $config_db_connect, $config;

  			switch ($date_base):

  			case ("realmd"):
			$db = $config_db_connect['rdbname'];
			$ip = $config_db_connect['rhostname'];
			$userdb = $config_db_connect['rusername'];
			$pw = $config_db_connect['rpassword'];
		  	break;

  			case ("characters"):
			$db = $config_db_connect['cdbname'];
			$ip = $config_db_connect['chostname'];
			$userdb = $config_db_connect['cusername'];
			$pw = $config_db_connect['cpassword'];
		  	break;

   			case ("mangos"):
			$db = $config_db_connect['dbname'];
			$ip = $config_db_connect['hostname'];
			$userdb = $config_db_connect['username'];
			$pw = $config_db_connect['password'];
		  	break;

  			endswitch;
  
 			$db_connect = @mysql_connect($ip, $userdb, $pw);
 			$db_select = @mysql_select_db($db, $db_connect);
			@mysql_query("SET NAMES '".$config['encoding']."'");

			if (!$db_connect)
				{
					die("<div style='text-align:center;'><strong>Unable to establish connection to MySQL</strong><br />".mysql_errno()." : ".mysql_error()."</div>");
				}
			elseif (!$db_select)
				{
					die("<div style='text-align:center;'><strong>Unable to select MySQL database</strong><br />".mysql_errno()." : ".mysql_error()."</div>");
				}
		}
	//=============================================================================================================
	// функции в основном связаны с realmlist
	//=============================================================================================================
	SelectDataBase("realmd");
	$config['namber_realmd'] = db_num_rows(db_query("SELECT * FROM `realmlist`"));
	$config['defult_realmd_id'] = db_result(db_query("SELECT `id` FROM `realmlist`"),0);

	//=============================================================================================================
	// проверяем существует ли account данного пользователя при авторизации на сайте
	//=============================================================================================================
	$user_ip = isset($_SESSION['ip']) ? @$_SESSION['ip'] : "";
	if (isset($_SESSION['user_id']) || $user_ip == $_SERVER['REMOTE_ADDR'])
		{
			selectDataBase("realmd");
			$data = db_assoc(db_query("SELECT count(`username`) as kol FROM `account` WHERE `username` = '".strtoupper($_SESSION['user_name'])."'"));
			if ($data['kol'] = 0)
				{
					db_query("INSERT INTO `account` (`username`,`sha_pass_hash`,`email`,`last_ip`,`locked`,`expansion`) VALUES (UPPER('".$_SESSION['user_name']."'),SHA1(CONCAT(UPPER('".$_SESSION['user_name']."'),':',UPPER('".$_SESSION['password']."'))),'".$_SESSION['emeil']."','".$_SERVER['REMOTE_ADDR']."','0','2')");
			 	}
		}

	//=============================================================================================================
	// Запускаем дополнительные функции и данные\Run additional features and data
	//=============================================================================================================
	require_once $modules['acp_module']."include/include_defult_const.php";
	require_once $modules['acp_module']."include/include_simple_cacher.php";
	require_once $modules['acp_module']."include/functions.php";
	require_once $modules['acp_module']."include/include_item_table.php";
	require_once $modules['acp_module']."include/include_player_data.php";
	require_once $modules['acp_module']."include/include_spell_data.php";
	require_once $modules['acp_module']."include/include_spell_details.php";
	require_once $modules['acp_module']."include/include_spell_table.php";
	require_once $modules['acp_module']."include/include_report_generator.php";
	require_once $modules['acp_module']."include/include_talent_calc.php";
	require_once $modules['acp_module']."include/include_talent_table.php";

	if ($config['lang']) { require_once $modules['acp_module']."lang/".$config['lang']."/".$config['encoding']."/text.php"; }
?>