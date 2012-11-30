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

	// блокируем регистрацию если пользователь авторизирован
	if ($AUTH->GMLevel() != -1 && $AUTH->GMLevel() < 4) { WCF::redirect(BASEDIR.'index.php'); }

	if (isset($_POST['register']) && ($_POST['register'] == '1'))
	{
		//==========================================================
		// ѕроверка на повторность учетной записи
      		if (!$AUTH->CheckRepetition($_POST['new_acc']))
		{
         		$errors = 1;
			WCF::redirect(WCF_SELF."?errors=".$errors);
	 	}
		//==========================================================
		// ѕроверка на совподение учетной записи с паролем
   		if (($_POST['pass1'] == $_POST['new_acc']) || ($_POST['pass1'] != $_POST['pass2']))
		{
      			$errors = 2;
			WCF::redirect(WCF_SELF."?errors=".$errors);
      		}
		//==========================================================
		// ѕроверка на пустые пол€
   		if (($_POST['pass1'] == '') || ($_POST['pass2'] == '') || ($_POST['new_acc'] == '') || ($_POST['email'] == ''))
		{
      			$errors = 3;
			WCF::redirect(WCF_SELF."?errors=".$errors);
      		}
		//==========================================================
		// ѕроверка на правильность ввода мыла
   		if (!mb_eregi("^[a-zA-Z0-9\._-]+@[a-zA-Z0-9\._-]+\.[a-zA-Z]{2,4}$",$_POST['email']))
		{
       			$errors = 4;
			WCF::redirect(WCF_SELF."?errors=".$errors);
       		}

      	 	WCF::$DB->db_query("INSERT INTO ".DB_USERS." (`user_name`,`user_sha_pass_hash`,`email`,`user_last_ip`) VALUES (UPPER('".$_POST['new_acc']."'),SHA1(CONCAT(UPPER('".$_POST['new_acc']."'),':',UPPER('".$_POST['pass1']."'))),'".$_POST['email']."','".$_SERVER['REMOTE_ADDR']."')");
   	}
	elseif (isset($_GET['errors']) && ($_GET['errors'] == "1" || $_GET['errors'] == "2" || $_GET['errors'] == "3" || $_GET['errors'] == "4"))
	{
  		switch($_GET['errors']):
  			case ("1"): $errors_txt = $txt['modul_registe_warning_account'];break;
  			case ("2"): $errors_txt = $txt['modul_registe_warning_pass']; 	break;
  			case ("3"): $errors_txt = $txt['modul_registe_warning_field'];	break;
  			case ("4"): $errors_txt = $txt['modul_registe_warning_mail']; 	break;
  		endswitch;

		opentable();
		echo"<tr><td align='center'><b>".$txt['modul_register_error']."</b></td></tr>";
      		echo"<tr><td align='center'><b>".$errors_txt."</b></td></tr>";
		return_form(20,BASEDIR.'register.php');
		closetable();	
	}
	else
	{
		opentable();
		if (WCF::$settings['registration_ip_limit'] > 0 && WCF::$settings['permit_registration'] == 1)
		{
		  	if ($AUTH->CheckLimiIP($_SERVER['REMOTE_ADDR']) >= WCF::$settings['registration_ip_limit'])
			{
				echo"<tr><td height='30' align='center'>".$txt['modul_register_no_ip']."</td></tr>";
				return_form(30,BASEDIR.'index.php');
		      	}
		}
		elseif (WCF::$settings['permit_registration'] == 1 && !isset($_SESSION['user_id']))
		{
			$view_new_acc = isset($_POST['new_acc']) ? $_POST['new_acc'] : "";
			$view_email =  isset($_POST['email']) ? $_POST['email'] : "";
		
			echo"<form method='post'>";
			echo"<input name='register' value='1' type=hidden>";
		   	echo"<tr><td colspan='2' align='center'><b>".$txt['modul_register']."</b></td></tr>";
		   	echo"<tr><td colspan='2' align='center'><b>".$config['license_agreement']."</b><br/></td></tr>";
			echo"<tr><td width='50%' height='30' align='right'>".$txt['modul_register_account']."&nbsp;</td>";
			echo"<td width='50%' height='30' align='left'><input type='text' class='textbox' name='new_acc' value='".$view_new_acc."'></td></tr>";
			echo"<tr><td width='50%' height='30' align='right'>".$txt['modul_register_pass']."&nbsp;</td>";
			echo"<td width='50%' height='30' align='left'><input type='password' class='textbox' name='pass1'></td></tr>";
			echo"<tr><td width='50%' height='30' align='right'>".$txt['modul_register_confirm_pass']."&nbsp;</td>";
			echo"<td width='50%' height='30' align='left'><input type='password' class='textbox' name='pass2'></td></tr>";
			echo"<tr><td width='50%' height='30' align='right'>".$txt['modul_register_mail']."&nbsp;</td>";
			echo"<td width='50%' height='30' align='left'><input type='text' class='textbox' name='email' value='".$view_email."'/></td></tr>";
			echo"<tr><td colspan='2' align='center'><input type='submit' class='button' value='".$txt['modul_register_add']."'></td></tr>";
			echo"</form>";
		}
		elseif (WCF::$settings['permit_registration'] != 1)
		{
			echo"<tr><td align='center'><b>".$txt['modul_register_no']."</b></td></tr>";
			return_form(20,BASEDIR.'index.php');
		}
		closetable();
	}
	require_once THEMES."templates/footer.php";
?>