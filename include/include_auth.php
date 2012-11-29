<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2012 lovepsone
+--------------------------------------------------------+
| Filename: include_auth.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	//======================================
	// проверка каптчи
	$CapchaInput = check_kcaptcha_enable();

	if (isset($_POST['auth_name']) && $_POST['auth_name'] != "") 
   		{
			$password = SHA1(strtoupper(addslashes($_POST['auth_name']).':'.addslashes($_POST['auth_pass'])));

   			$result = WCF::$DB->db_query("SELECT * FROM ".DB_USERS." WHERE `user_name`='".strtoupper(addslashes($_POST['auth_name']))."' AND `user_sha_pass_hash` ='".$password."'");

		   	if (WCF::$DB->db_num_rows($result) == 1 && $CapchaInput == 1)
		      		{
					$data = WCF::$DB->db_assoc($result);
		       			$_SESSION['user_id'] = (int)$data['user_id'];
		       			$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
		       			$_SESSION['user_name'] = strtoupper($_POST['auth_name']);
		       			$_SESSION['password'] = strtoupper($password);
					$_SESSION['gmlevel'] = (int)$data['user_gmlevel'];
					$_SESSION['bonuses'] = (int)$data['user_bonuses'];
		       			$_SESSION['lang'] = $config['lang'];
					unset($_SESSION['captcha_keystring']);
					WCF::redirect("http://".$_SERVER['HTTP_HOST']."/setuser.php?action=auth");
		       		}
			else
				{
					WCF::redirect("http://".$_SERVER['HTTP_HOST']."/setuser.php?action=error");
				}
			
   		}
?>