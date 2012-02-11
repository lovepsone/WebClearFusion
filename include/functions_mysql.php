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

	$date = date('d-m-Y [H:i:s]');

	//=============================================================================================
	// функция коннекта к базе 
	function selectdb($date_base)
		{
  			global $config;
  
  			switch ($date_base):

  			case ("wcf"):
  			$db = $config['wdbName'];
  			$ip = $config['whostname'];
  			$userdb = $config['wusername'];
  			$pw = $config['wpassword'];
  			break;

  			case ("realmd"):
  			$db = $config['rdbName'];
  			$ip = $config['rhostname'];
  			$userdb = $config['rusername'];
  			$pw = $config['rpassword'];
  			break;

  			case ("characters_r1"):
  			$db = $config['cdbName_r1'];
  			$ip = $config['chostname_r1'];
  			$userdb = $config['cusername_r1'];
  			$pw = $config['cpassword_r1'];
  			break;

   			case ("mangos_r1"):
  			$db = $config['dbName_r1'];
  			$ip = $config['hostname_r1'];
  			$userdb = $config['username_r1'];
  			$pw = $config['password_r1'];
  			break;

  			case ("characters_r2"):
  			$db = $config['cdbName_r2'];
  			$ip = $config['chostname_r2'];
  			$userdb = $config['cusername_r2'];
  			$pw = $config['cpassword_r2'];
  			break;

   			case ("mangos_r2"):
  			$db = $config['dbName'];
  			$ip = $config['hostname'];
  			$userdb = $config['username'];
  			$pw = $config['password'];
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