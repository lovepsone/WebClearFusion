<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2012 lovepsone
+--------------------------------------------------------+
| Filename: user_info_panel.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	if (!isset($_SESSION['user_id']) or ($_SESSION['ip'] != $_SERVER['REMOTE_ADDR']))
		{
  			openside();
			echo"<form name='loginform' method='post' action='".WCF_SELF."'>";
			echo"<tr><td colspan='2' align='center'>".$txt['menu_auth_title']."<br><br></td></tr>";
  			echo"<tr><td colspan='2' align='center'>".$txt['menu_auth_account']."<br><input type='text' name='auth_name' class='textbox'></td></tr>";
 			echo"<tr><td colspan='2' align='center'>".$txt['menu_auth_pass']."<br><input type='password' name='auth_pass' class='textbox'></td></tr>";

			//======================================
			// Проверка на каптча
			if ($config['Kcaptcha_enable'] == 1) 
  				{
   					echo"<tr><td colspan='2' align='center'><br><iframe src='./include/kcaptcha.php' marginheight='0' marginwidth='0' width='100' height='40' frameborder='0' scrolling='no' allowtransparency='true'></iframe></td></tr>"; 
   					echo"<tr><td colspan='2' align='center'><br><input type='text' name='kapcha_code' class='textbox'></td></tr>";
  				}
			echo"<tr><td colspan='2' align='center'><br><input type='submit' class='button' value='".$txt['menu_auth_enter']."'></td></tr>";
     			echo"<tr><td height='30' colspan='2' align='left' valign='middle'><img src='".IMAGES."admin.png' align='absmiddle'>&nbsp;&nbsp;&nbsp;<a href='".BASEDIR."register.php'>".$txt['menu_auth_reg']."</a></td></tr>";

     			if (($config['pass_remember'] == 'on') AND ($mail_method != 'test'))
					{
     						echo"<tr><td height='30' colspan='2' align='left' valign='middle'><img src='".IMAGES."mail.png' align='absmiddle'>&nbsp;&nbsp;&nbsp;<a href='".BASEDIR."index.php'>".$txt['menu_auth_remember_pass']."</a></td></tr>";
		   			}
			echo"</form>";
			closeside();
		}
	else if (isset($_SESSION['user_id']) or ($_SESSION['ip'] == $_SERVER['REMOTE_ADDR']))
		{
			//======================================
			// занесение юзера в таблицу
			selectdb(wcf);
			db_query("UPDATE ".DB_USERS." SET `user_online`='1' WHERE  `user_id`='".$_SESSION['user_id']."'");

 			$query_user = db_query("SELECT * FROM ".DB_USERS." WHERE `user_id`=".$_SESSION['user_id']." LIMIT 1");
  			$res_user = db_aassoc($query_user);

			openside();
			echo"<tr><td align='left'>".$txt['menu_auth_greeting']."&nbsp;".ucfirst(strtolower($_SESSION['user_name']))."</td></tr>";
			if ($res_user['user_avatar'] <> '')
				{
			  		echo"<tr><td align='right' valign='top' class='avatar'><img src='".IMAGES_A.$res_user['user_avatar']."'/></td></tr>";
				}
			else
				{
					echo"<tr><td align='right' valign='top'><img src='".IMAGES_A."null-avatar.gif' class='avatar'></td></tr>";
				}

  			echo"<tr><td align='left'>".$txt['menu_auth_ip']."</td></tr>";
  			echo"<tr><td align='left'>".$_SERVER['REMOTE_ADDR']."</td></tr>";

			echo"<tr><td width='100%'><hr></td></tr>";
			if ( $_SESSION['gmlevel'] >= $config['admin'] ) { echo"<tr><td align='right'><a href='".ADMIN."administration.php?contet'>".$txt['menu_auth_admin']."</a></td></tr>";}
			echo"<tr><td align='right'><a href='".BASEDIR."logout.php'>".$txt['menu_auth_exit']."</a>";
			closeside();

			//======================================
			// чистка онлайна
			selectdb(wcf);
			$clear_user = db_query("SELECT * FROM ".DB_USERS."");

			while ($user = db_array($clear_user))
				{
					if ($user['user_id'] <> $_SESSION['user_id']) db_query("UPDATE ".DB_USERS." SET `user_online`='0' WHERE  `user_id`='".$user['user_id']."'");
				}
		}
?>