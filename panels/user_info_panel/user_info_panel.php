<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: user_info_panel.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	if (!isset($_SESSION['user_id']) or ($_SESSION['ip'] != $_SERVER['REMOTE_ADDR']))
		{
			echo"<form method='POST'>";
  			openside();

			//======================================
			// Проверка на бан,блок,кптча
			if (isset($Block_login) and ($Block_login == 1))
				{
					echo"<tr><td  colspan='2' align='center'>".$txt['menu_auth_title']."<br><br></td></tr>";
  					echo"<tr><td width='50%' height='30' align='left' valign='middle'>".$txt['menu_auth_account'].":&nbsp;</td>";
					echo"<td width='50%' height='30' align='left' valign='middle'><input type='text' name='auth_name' class='textbox'></td></tr>";

 					echo"<tr><td width='50%' height='30' align='left' valign='middle'>".$txt['menu_auth_pass'].":&nbsp;</td>";
      					echo"<td width='50%' height='30' align='left' valign='middle'><input type='password' name='auth_pass' class='textbox'></td></tr>";

					if ($config['Kcaptcha_enable'] == 1) 
  						{
   							echo"<tr><td colspan='2' height='30' align='center' valign='middle'><iframe src='./include/kcaptcha.php' marginheight='0' marginwidth='0' width='100' height='40' frameborder='0' scrolling='no' allowtransparency='true'></iframe></td></tr>"; 
   							echo"<tr><td colspan='2' height='30' align='center' valign='middle'><input type='text' name='kapcha_code' size=10></td></tr>";
  						}
					elseif (($config['Kcaptcha_enable'] == 2) AND ($login_count > 0)) 
  						{
   							echo"<tr><td colspan='2' height='30' align='center' valign='middle'><iframe src='./include/kcaptcha.php' marginheight='0' marginwidth='0' width='100' height='40' frameborder='0' scrolling='no' allowtransparency='true'></iframe></td></tr>"; 
   							echo"<tr><td colspan='2' height='30' align='center' valign='middle'><input type='text' name='kapcha_code' size=10></td></tr>";
  						}

					echo"<tr><td colspan='2' align='center' valign='middle'><input type='submit' class='button' value='".$txt['menu_auth_enter']."'></td></tr>";

					selectdb(realmd);
					$rip = 'no';
  					$res = mysql_query("SELECT `ip` FROM `ip_banned` WHERE `ip`='".$_SERVER['REMOTE_ADDR']."' LIMIT 1") or trigger_error(mysql_error());

  					if ($row = mysql_fetch_assoc($res)) $rip = $row['ip'];
  					if ($rip != $_SERVER['REMOTE_ADDR'])
						{
     							echo"<tr><td height='30' colspan='2' align='left' valign='middle'><img src='".IMAGES."admin.png' align='absmiddle'>&nbsp;&nbsp;&nbsp;<a href='index.php?modul=reg'>".$txt['menu_auth_reg']."</a></td></tr>";

     							if (($config['pass_remember'] == 'on') AND ($mail_method != 'test'))
								{
     									echo"<tr><td height='30' colspan='2' align='left' valign='middle'><img src='".IMAGES."mail.png' align='absmiddle'>&nbsp;&nbsp;&nbsp;<a href='index.php?modul=remember'>".$txt['menu_auth_remember_pass']."</a></td></tr>";
		   						}
     						}

				}
			else 
				{
					echo"<tr><td  colspan='2' align='center'><br><br><br><br></td></tr>";
					echo"<tr><td  colspan='2' align='center'>".$txt['main_ban_ip']."<br><br></td></tr>";
					echo"<tr><td  colspan='2' align='center'><br><br><br><br></td></tr>";
				}
			closeside();
			echo"</form>";
		}
	else 
		{
			//======================================
			// занесение юзера в таблицу
			selectdb(wcf);
			mysql_query("UPDATE ".DB_USERS." SET `user_online`='1' WHERE  `user_id`='".$_SESSION['user_id']."'");

  			$rip = '';
			selectdb(realmd);
  			$query0 = mysql_query("SELECT `ip` FROM `ip_banned` WHERE `ip`='".$_SERVER['REMOTE_ADDR']."' LIMIT 1");

  			if ($row0 = mysql_fetch_assoc($res0)) $rip  = $row0['ip'];

 			$query = "SELECT * FROM `account` WHERE `id`=".$_SESSION['user_id']." LIMIT 1";
  			$res = mysql_query($query) or trigger_error(mysql_error().$query);

  			if ($row = mysql_fetch_assoc($res))
      				{
       					$ra_id             = $row['id'];
       					$ra_username  = $row['username'];
					$ra_admin     = $row['gmlevel'];
       					$ra_email        = $row['email'];
      				}

   			if (strtoupper($_SESSION['slovo']) != strtoupper($row['sha_pass_hash'])) 
     				{
      					session_destroy();
					openside();
      					echo"<table width='200' border='0' cellspacing='0' cellpadding='0'>";
      					echo"<tr><td height='25' align='center' valign='middle'><b>".$txt['menu_auth_error']."</b></td></tr>";
					echo"<tr><td height='45' align='center' valign='middle'><b>".$txt['menu_auth_re_enter']."</b></td></tr>";
					echo"</table><br><br>";
					closeside();
      					return_form(40,'');
      					return;
     				}

  			$query2 = "SELECT `active` FROM `account_banned` WHERE `id`='".$ra_id."' LIMIT 1";
  			$res2 = mysql_query($query2) or trigger_error(mysql_error());

  			if ($row2 = mysql_fetch_assoc($res2)) $r_act = $row2['active']; else $r_act = '0';

			selectdb(wcf);
 			$query_user = mysql_query("SELECT * FROM ".DB_USERS." WHERE `user_id`=".$_SESSION['user_id']." LIMIT 1");
  			$res_user = mysql_fetch_assoc($query_user);

			openside();
			echo"<tr><td align='left' valign='top'>".$txt['menu_auth_greeting']."&nbsp;".ucfirst(strtolower($ra_username))."</td></tr>";
			if ($res_user['user_avatar'] <> '')
				{
			  		echo"<tr><td align='right' valign='top' class='avatar'><img src='".IMAGES_A.$res_user['user_avatar']."'/></td></tr>";
				}
			else
				{
					echo"<tr><td align='right' valign='top'><img src='".IMAGES_A."null-avatar.gif' class='avatar'></td></tr>";
				}

  			echo"<tr><td align='left' valign='top'>".$txt['menu_auth_ip']."</td></tr>";
  			echo"<tr><td align='left' valign='bottom'>".$_SERVER['REMOTE_ADDR']."</td></tr>";

			echo"<tr><td width='100%' valign='bottom'><hr></td></tr>";
			if ( $ra_admin >= $config['admin'] ) { echo"<tr><td align='right' valign='bottom'><a href='index.php?modul=admin&contet'>".$txt['menu_auth_admin']."</a></td></tr>";}
			echo"<tr><td align='right' valign='bottom'><a href='index.php?modul=logout'>".$txt['menu_auth_exit']."</a>";
			closeside();

			//======================================
			// чистка онлайна
			selectdb(wcf);
			$clear_user = mysql_query("SELECT * FROM ".DB_USERS."");

			while ($user = mysql_fetch_array($clear_user))
				{
					if ($user['user_id'] <> $_SESSION['user_id']) mysql_query("UPDATE ".DB_USERS." SET `user_online`='0' WHERE  `user_id`='".$user['user_id']."'");
				}
		}
?>