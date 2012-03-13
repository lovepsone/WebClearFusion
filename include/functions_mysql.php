<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: functions_mysql.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	//=============================================================================================
	// функция коннекта к базе 
	function selectdb($date_base)
		{
  			global $config_db_connect, $config;

  			switch ($date_base):

  			case ("wcf"):
		  	$db = $config_db_connect['wdbname'];
		  	$ip = $config_db_connect['whostname'];
		  	$userdb = $config_db_connect['wusername'];
		  	$pw = $config_db_connect['wpassword'];
  			break;

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

	//=============================================================================================
	// MySQL database functions
	function db_query($query)
		{
			$result = @mysql_query($query);
			if (!$result)
				{
					echo mysql_error();
					return false;
				}
			else 
				{
					return $result;
				}
		}

	//=============================================================================================
	// функция определяет количество строк в таблице 
	function db_num_rows($query)
		{
			$result = @mysql_num_rows($query);
			return $result;
		}

	//=============================================================================================
	// функция возвращает ассоциативный массив с названиями индексов 
	function db_assoc($query)
		{
			$result = @mysql_fetch_assoc($query);
			if (!$result) 
				{
					echo mysql_error();
					return false;
				}
			else
				{
					return $result;
				}
		}

	//=============================================================================================
	// функция возвращает массив с обработанным рядом результата запроса 
	function db_array($query)
		{
			$result = @mysql_fetch_array($query);
			if (!$result) 
				{
					echo mysql_error();
					return false;
				}
			else
				{
					return $result;
				}
		}

	function db_result($query, $row)
		{
			$result = @mysql_result($query, $row);
			if (!$result)
				{
					echo mysql_error();
					return false;
				}
			else
				{
					return $result;
				}
		}

	function db_count($field, $table, $conditions = "")
		{
			$cond = ($conditions ? " WHERE ".$conditions : "");
			$result = @mysql_query("SELECT Count".$field." FROM ".$table.$cond);

			if (!$result)
				{
					echo mysql_error();
					return false;
				}
			else
				{
					$rows = mysql_result($result, 0);
					return $rows;
				}
		}

	/*function select_page($query)
		{
			$result = db_query($query);
			if (!db_num_rows($result)) { return; }

			$result = mysql_fetch_object($result);
			if (!$result)
				{
					echo mysql_error();
					return false;
				}
			else
				{
					return $result;
				}
		}*/

	//=============================================================================================
	// функция работает с логами, добавляет их в бд.
	// Значения поля mode в запросе:
	// 0 - другое (указано в поле "note")
	// 1 - регистрация
	// 2 - восстановление пароля (запрос)
	// 3 - восстановление пароля (выслан новый)
	// 4 - смена емайла (запрос)
	// 5 - смена емайла (Замена)
	// 6 - перенос на другой аккаунт персонажа
	// 7 - переименование персонажа
	// 8 - unlock ip
	// 9 - antierror

	function logs($log_account, $log_character, $log_mode, $log_email, $log_resultat, $log_note, $log_old_data)
		{
			global $_SERVER;
			if (($log_account == '') OR ($log_account == 0))
				{
					$log_account = $_SESSION['user_id'];
				}
			if ($log_character == '')
				{
					$log_character = 0;
				}

			selectdb("wcf");
			db_query("INSERT ".DB_LOGS." (`ip`, `account`, `character`, `mode`, `email`, `resultat`, `note`, `old_data`)
				VALUES ('".$_SERVER['REMOTE_ADDR']."', ".$log_account.", ".$log_character.", ".$log_mode.", '".$log_email."', '".$log_resultat."', '".$log_note."', '".$log_old_data."')");

		}

?>