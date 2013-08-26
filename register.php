<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2013 lovepsone
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
	if (isset($_SESSION['gmlevel']) && $_SESSION['gmlevel'] < 4) { WCF::redirect(BASEDIR.'index.php'); }

	if (isset($_POST['register']) && ($_POST['register'] == '1'))
	{
		//==========================================================
		// ѕроверка на повторность учетной записи
		$rows = WCF::$DB->select(' -- CACHE: 180
			SELECT count(`user_name`) as number FROM ?_users WHERE `user_name` = ?', strtoupper($_POST['new_acc']));
  
		foreach ($rows as $numRow=>$number) {}

      		if ($number['number'] > 0)
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

		$password = SHA1(strtoupper(addslashes($_POST['new_acc']).':'.addslashes($_POST['pass1'])));
      	 	WCF::$DB->query('INSERT INTO ?_users (`user_name`,`user_sha_pass_hash`,`email`,`user_last_ip`) VALUES ( ?, ?, ?, ?)', strtoupper(addslashes($_POST['new_acc'])), $password, $_POST['email'], $_SERVER['REMOTE_ADDR']);
       		$row = WCF::$DB->selectRow('SELECT * FROM ?_users WHERE `user_name` = ? AND `user_sha_pass_hash` = ?',strtoupper($_POST['new_acc']), $password);

		if ($row != null && $CapchaInput == 1)
		{
		       	$_SESSION['user_id'] = (int)$row['user_id'];
		       	$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
		       	$_SESSION['user_name'] = strtoupper($_POST['new_acc']);
		       	$_SESSION['password'] = strtoupper($password);
			$_SESSION['gmlevel'] = (int)$row['user_gmlevel'];
			$_SESSION['bonuses'] = (int)$row['user_bonuses'];
		       	$_SESSION['lang'] = WCF::$cfgSetting['lang'];
			$_SESSION['user_avatar'] = $row['user_avatar'];
		}
		WCF::redirect("http://".$_SERVER['HTTP_HOST']."/setuser.php?action=auth");
   	}
	elseif (isset($_GET['errors']) && ($_GET['errors'] == "1" || $_GET['errors'] == "2" || $_GET['errors'] == "3" || $_GET['errors'] == "4"))
	{

  			switch($_GET['errors']):
  			case ("1"): $errors_txt = WCF::$locale['modul_registe_warning_account'];break;
  			case ("2"): $errors_txt = WCF::$locale['modul_registe_warning_pass']; 	break;
  			case ("3"): $errors_txt = WCF::$locale['modul_registe_warning_field'];	break;
  			case ("4"): $errors_txt = WCF::$locale['modul_registe_warning_mail']; 	break;
  			endswitch;

		opentable();
		echo"<tr><td align='center'><b>".WCF::$locale['modul_register_error']."</b></td></tr>";
      		echo"<tr><td align='center'><b>".$errors_txt."</b></td></tr>";
		WCF::ReturnForm(20, BASEDIR.'register.php');
		closetable();	
	}
	else
	{
		opentable();
		if (WCF::$cfgSetting['registration_ip_limit'] > 0 && WCF::$cfgSetting['permit_registration'] == 1)
		{
		   	$rows = WCF::$DB->select('SELECT COUNT(`id`) AS number FROM ?_users WHERE `user_last_ip`= ?', $_SERVER['REMOTE_ADDR']); 

			foreach ($rows as $numRow=>$number) {}

		  	if ($number['number'] >= WCF::$cfgSetting['registration_ip_limit'])
			{
		      		echo"<tr><td height='30' align='center'>".WCF::$locale['modul_register_no_ip']."</td></tr>";
		      		WCF::ReturnForm(30,BASEDIR.'index.php');
		      	}
		  }
		elseif (WCF::$cfgSetting['permit_registration'] == 1 && !isset($_SESSION['user_id']))
		{
			$view_new_acc = isset($_POST['new_acc']) ? $_POST['new_acc'] : "";
			$view_email =  isset($_POST['email']) ? $_POST['email'] : "";
		
			echo"<form method='post'>";
			echo"<input name='register' value='1' type=hidden>";
		   	echo"<tr><td colspan='2' align='center'><b>".WCF::$locale['modul_register']."</b></td></tr>";
		   	echo"<tr><td colspan='2' align='center'><b>".WCF::$cfgSetting['license_agreement']."</b><br/></td></tr>";
			echo"<tr><td width='50%' height='30' align='right'>".WCF::$locale['modul_register_account']."&nbsp;</td>";
			echo"<td width='50%' height='30' align='left'><input type='text' class='textbox' name='new_acc' value='".$view_new_acc."'></td></tr>";
			echo"<tr><td width='50%' height='30' align='right'>".WCF::$locale['modul_register_pass']."&nbsp;</td>";
			echo"<td width='50%' height='30' align='left'><input type='password' class='textbox' name='pass1'></td></tr>";
			echo"<tr><td width='50%' height='30' align='right'>".WCF::$locale['modul_register_confirm_pass']."&nbsp;</td>";
			echo"<td width='50%' height='30' align='left'><input type='password' class='textbox' name='pass2'></td></tr>";
			echo"<tr><td width='50%' height='30' align='right'>".WCF::$locale['modul_register_mail']."&nbsp;</td>";
			echo"<td width='50%' height='30' align='left'><input type='text' class='textbox' name='email' value='".$view_email."'/></td></tr>";
			echo"<tr><td colspan='2' align='center'><input type='submit' class='button' value='".WCF::$locale['modul_register_add']."'></td></tr>";
			echo"</form>";
		}
		elseif (WCF::$cfgSetting['permit_registration'] != 1)
		{
			echo"<tr><td align='center'><b>".WCF::$locale['modul_register_no']."</b></td></tr>";
			WCF::ReturnForm(20, BASEDIR.'index.php');
		}
		closetable();
	}
	require_once THEMES."templates/footer.php";
?>