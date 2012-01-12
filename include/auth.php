<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2012 lovepsone
+--------------------------------------------------------+
| Filename: auth.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	//======================================
	// проверка каптчи
	if ($config['Kcaptcha_enable_auth'] == 1)
   		{
    			if (isset($_SESSION['captcha_keystring']) AND isset($_POST['kapcha_code']) AND (strtolower($_SESSION['captcha_keystring']) == strtolower($_POST['kapcha_code'])))
       				{
       					$CapchaInput = 1;
       				}
    			else { $CapchaInput = 0; }
   		}
	elseif ($config['Kcaptcha_enable'] == 0) { $CapchaInput = 1; }

	if (isset($_POST['auth_name'])) 
   		{
			$password= SHA1(strtoupper(addslashes($_POST['auth_name']).':'.addslashes($_POST['auth_pass'])));

			selectdb(realmd);
   			$result = db_query('SELECT * FROM `account` WHERE `username`="'.strtoupper(addslashes($_POST['auth_name'])).'" AND sha_pass_hash ="'.$password.'"');

   			if ((mysql_num_rows($result) == 1) AND ($CapchaInput == 1))
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
					selectdb(wcf);
					$result = db_query("SELECT * FROM ".DB_USERS." WHERE `user_id`='".$_SESSION['user_id']."' AND `user_name`='".$_SESSION['user_name']."'");

					if ($result['user_id'] <> $_SESSION['user_id'])
						{
							db_query("INSERT INTO ".DB_USERS." (`user_id`,`user_name`,`user_online`) VALUES ('".$_SESSION['user_id']."','".$_SESSION['user_name']."','1')");
						}

       				}
   			header("Location: http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
   			exit;
   		}
?>