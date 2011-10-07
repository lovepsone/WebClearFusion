<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: auth.php
| Author: lovepsone, Кот_ДаWINчи
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	//=====================
	// проверка на автобан
	selectdb(wcf);
  	$query = 'DELETE FROM `wcf_login_failed` WHERE UNIX_TIMESTAMP(`login_time`) < UNIX_TIMESTAMP()-60*"'.$config['auto_ban_time'].'"';
	mysql_query($query);
  	$query = 'SELECT * FROM `wcf_login_failed` WHERE `ip` = "'.$_SERVER['REMOTE_ADDR'].'"';
  	$login_access = mysql_query($query);
  	$login_count = mysql_num_rows($login_access);
  	if ($login_count < $config['auto_ban_count']) $Block_login = 1; else $Block_login = 0;

	//=====================
	// проверка каптчи
	$CapchaInput = 1;
	if ($config['Kcaptcha_enable'] == 1)
   		{
    			if( isset($_SESSION['captcha_keystring']) AND isset($_POST['kapcha_code']) AND (strtolower($_SESSION['captcha_keystring']) == strtolower($_POST['kapcha_code'])) )
       				{
       					$CapchaInput = 1;
       				}
    			else $CapchaInput = 0;
   		}
	if ($config['Kcaptcha_enable'] == 2)
   		{
   			if ($login_count == 0) { $CapchaInput = 1; }
  			else 
      				{
      					if ( isset($_SESSION['captcha_keystring']) AND isset($_POST['kapcha_code']) AND (strtolower($_SESSION['captcha_keystring']) == strtolower($_POST['kapcha_code'])) )
         					{
          						$CapchaInput = 1;
         					}
      					else $CapchaInput = 0;
      				}
   		}
	//=====================

	if (isset($_POST['auth_name'])) 
   		{
			$par= SHA1(strtoupper(addslashes($_POST['auth_name']).':'.addslashes($_POST['auth_pass'])));

			selectdb(realmd);
   			$res = mysql_query('SELECT * FROM `account` WHERE `username`="'.strtoupper(addslashes($_POST['auth_name'])).'" AND sha_pass_hash ="'.$par.'"');

   			if ((mysql_num_rows($res) == 1) AND ($Block_login == 1) AND ($CapchaInput == 1))
      				{
					$row = mysql_fetch_assoc($res);
       					$_SESSION['user_id'] = (int)$row['id'];
       					$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
       					$_SESSION['kito'] = strtoupper($_POST['auth_name']);
       					$_SESSION['slovo'] = strtoupper($par);
       					$_SESSION['gnom'] = (int)$row['gmlevel'];
       					$_SESSION['modul'] = $config['default_module'];
       					$_SESSION['lang'] = $config['lang'];
					unset($_SESSION['captcha_keystring']);

					//======================================
       					// Чистка в wcf_login_failed IP - адреса
					selectdb(wcf);
       					$query = mysql_query('DELETE FROM `wcf_login_failed` WHERE `ip` = "'.$_SERVER['REMOTE_ADDR'].'"');
					
					//======================================
					// занесение юзера в таблицу
					$user = mysql_query("SELECT * FROM `wcf_users` WHERE `user_id`='".$_SESSION['user_id']."' AND `user_name`='".$_SESSION['kito']."'");

					if ($user['user_id'] <> $_SESSION['user_id'])
						{
							$user_crt = mysql_query("INSERT INTO `wcf_users` (`user_id`,`user_name`,`user_online`) VALUES ('".$_SESSION['user_id']."','".$_SESSION['kito']."','1')");
						}

       				}
			//======================================
			// добавляем бан по ип-адресу на 
			// некоторое время
   			else if ($Block_login == 1)
       				{
					selectdb(wcf);
       					$query = mysql_query('insert `wcf_login_failed` (`ip`) VALUES ("'.$_SERVER['REMOTE_ADDR'].'")');
       				}

   			header("Location: http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
   			exit;
   		}

	if (isset($_GET['action']) AND $_GET['action']=="logout") 
   		{
    			session_destroy();
    			header("Location: http://".$_SERVER['HTTP_HOST']."/");
    			exit;
   		}
?>