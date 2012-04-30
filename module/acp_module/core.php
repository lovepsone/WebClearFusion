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

	//=============================================================================================================
	// функции в основном связаны с realmlist
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
?>