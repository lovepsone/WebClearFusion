<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2012 lovepsone
+--------------------------------------------------------+
| Filename: register.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	require_once "maincore.php";
	require_once THEMES."templates/header.php";

	if (isset($_SESSION['gmlevel']) AND $_SESSION['gmlevel'] < 4) return_form(1,BASEDIR.'index.php');

	if (isset($_POST['register']) AND ($_POST['register'] == '1'))
		{
   			$errors = 0;
   			$errors_txt = "";

			//==========================================================
			// Проверка на повторность учетной записи
			selectdb(realmd);
      			$result1 = db_query("SELECT count(`username`) as kol FROM `account` WHERE `username` = '".strtoupper($_POST['new_acc'])."'");
      			$data1 = db_assoc($result1);

      			if ($data1['kol'] > 0)
				{
         				$errors = 1;
  	 				$errors_txt = $txt['modul_registe_warning_account'];
	 			}
			//==========================================================
			// Проверка на совподение учетной записи с паролем
   			if (($_POST['pass1'] == $_POST['new_acc']) OR ($_POST['pass1'] != $_POST['pass2']))
				{
      					$errors = 1;
      					$errors_txt .= "<br>".$txt['modul_registe_warning_pass'];
      				}
			//==========================================================
			// Проверка на пустые поля
   			if (($_POST['pass1'] == '') OR ($_POST['pass2'] == '') OR ($_POST['new_acc'] == '') OR ($_POST['email'] == ''))
				{
      					$errors = 1;
      					$errors_txt .= "<br>".$txt['modul_registe_warning_field'];
      				}
			//==========================================================
			// Проверка на правильность ввода мыла
   			if (!mb_eregi("^[a-zA-Z0-9\._-]+@[a-zA-Z0-9\._-]+\.[a-zA-Z]{2,4}$",$_POST['email']))
				{
       					$errors = 1;
       					$errors_txt .= "<br>".$txt['modul_registe_warning_mail'];
       				}

   			if ($errors == 0)
				{
					selectdb(realmd);
      	 				db_query("INSERT INTO `account` (`username`,`sha_pass_hash`,`email`,`last_ip`,`locked`,`expansion`)
					VALUES (UPPER('".$_POST['new_acc']."'),SHA1(CONCAT(UPPER('".$_POST['new_acc']."'),':',UPPER('".$_POST['pass1']."'))),'".$_POST['email']."','".$_SERVER['REMOTE_ADDR']."','0','".$def_exp_acc."')");

       					$result2 = db_query("SELECT * FROM `account` WHERE `username`='".strtoupper($_POST['new_acc'])."' AND sha_pass_hash ='".SHA1(strtoupper($_POST['new_acc']).':'.strtoupper($_POST['pass1']))."'");

					if ($data2 = db_assoc($result2))
						{
          						$_SESSION['user_id'] = $data2['id'];
          						$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
          						$_SESSION['user_name'] = strtoupper($_POST['new_acc']);
          						$_SESSION['password'] = strtoupper(SHA1(strtoupper($_POST['new_acc']).':'.strtoupper($_POST['pass1'])));
		          				$_SESSION['gmlevel'] = $data2['gmlevel'];
		       					$_SESSION['lang'] = $config['lang'];
		          				$log_account   =  $_SESSION['user_id'];
		          				$log_character =  0;
		          				$log_mode      =  1;
		          				$log_email     =  $_POST['email'];
		          				$log_resultat  =  '';
		          				$log_note      =  $_SESSION['user_name'];
		          				$log_old_data  =  '';

							logs($log_account,$log_character,$log_mode,$log_email,$log_resultat,$log_note,$log_old_data);					  
       						}

					//======================================
					// занесение юзера в таблицу
					selectdb(wcf);
					$result3 = db_query("SELECT * FROM ".DB_USERS." WHERE `user_id`='".$_SESSION['user_id']."' AND `user_name`='".$_SESSION['user_name']."'");

					if ($result3['user_id'] <> $_SESSION['user_id'])
						{
							db_query("INSERT INTO ".DB_USERS." (`user_id`,`user_name`,`user_online`) VALUES ('".$_SESSION['user_id']."','".$_SESSION['user_name']."','1')");
						}

       					return_form(30,BASEDIR.'index.php');
      				}
   		}
	//=================================================
	// Основная форма
   	opentable();

	if ($config['registration_ip_limit'] > 0 AND $config['permit_registration'] == 1)
		{
			selectdb(realmd);
   			$result = db_query("SELECT COUNT(`id`) AS kol FROM `account` WHERE `last_ip`='".$_SERVER['REMOTE_ADDR']."'"); 
   			$data = db_assoc($result);

  			if ($data['kol'] >= $config['registration_ip_limit'])
				{
      					echo"<tr><td height='30' align='center'>".$txt['modul_register_no_ip']."</td></tr>";
      					return_form(30,BASEDIR.'index.php');
      				}
  		}
	elseif ($config['permit_registration'] == 1 AND !isset($_SESSION['user_id']))
		{
			echo"<form method='post'>";
			echo"<input name='register' value='1' type=hidden>";

   			echo"<tr><td colspan='2' align='center'><b>".$txt['modul_register']."</b></td></tr>";
   			echo"<tr><td colspan='2' align='center'><b>".$config['license_agreement']."</b><br/></td></tr>";
 
			echo"<tr><td width='50%' height='30' align='right'>".$txt['modul_register_account']."&nbsp;</td>";
			echo"<td width='50%' height='30' align='left'><input type='text' class='textbox' name='new_acc' value='".$_POST['new_acc']."'></td></tr>";

			echo"<tr><td width='50%' height='30' align='right'>".$txt['modul_register_pass']."&nbsp;</td>";
			echo"<td width='50%' height='30' align='left'><input type='password' class='textbox' name='pass1'></td></tr>";

			echo"<tr><td width='50%' height='30' align='right'>".$txt['modul_register_confirm_pass']."&nbsp;</td>";
			echo"<td width='50%' height='30' align='left'><input type='password' class='textbox' name='pass2'></td></tr>";

			echo"<tr><td width='50%' height='30' align='right'>".$txt['modul_register_mail']."&nbsp;</td>";
			echo"<td width='50%' height='30' align='left'><input type='text' class='textbox' name='email' value='".$_POST['email']."'/></td></tr>";

			echo"<tr><td colspan='2' align='center'><input type='submit' class='button' value='".$txt['modul_register_add']."'></td></tr>";
			echo"</form>";
		}
	elseif ($config['permit_registration'] != 1)
		{
			echo"<tr><td align='center'><b>".$txt['modul_register_no']."</b></td></tr>";
			return_form(20,BASEDIR.'index.php');
		}
	elseif ($errors != 0)
		{
			echo"<tr><td align='center'><b>".$txt['modul_register_error']."</b></td></tr>";
      			echo"<tr><td align='center'><b>".$errors_txt."</b></td></tr>";
			return_form(20,BASEDIR.'register.php');
		}
	elseif (isset($_SESSION['user_id']))
		{
			echo"<tr><td align='center'><b>".$txt['modul_register_sucess']."</b></td></tr>";
		}
	closetable();

	require_once THEMES."templates/footer.php";
?>