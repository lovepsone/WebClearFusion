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

	if (!isset($_SESSION['user_id']) || ($_SESSION['ip'] != $_SERVER['REMOTE_ADDR']))
		{
  			openside();
			echo"<form name='loginform' method='post' action='".WCF_SELF."'>";
			echo"<tr><td colspan='2' align='center'>".$txt['menu_auth_title']."<br><br></td></tr>";
  			echo"<tr><td colspan='2' align='center'>".$txt['menu_auth_account']."<br><input type='text' name='auth_name' class='textbox'></td></tr>";
 			echo"<tr><td colspan='2' align='center'>".$txt['menu_auth_pass']."<br><input type='password' name='auth_pass' class='textbox'></td></tr>";

			//======================================
			// Проверка на каптча
			if (WCF::$settings['kcaptcha_enable_auth'] == 1) 
  				{
					echo"<tr><td colspan='2' align='center'><br><img id='siimage' style='border: 1px solid #000' src='".S_KCAPTCHA."securimage_show.php?sid=".md5(uniqid())."'/><br>";
					echo"<object type='application/x-shockwave-flash' data='".S_KCAPTCHA."securimage_play.swf?bgcol=#ffffff&amp;icon_file=".S_KCAPTCHA."images/audio_icon.png&amp;audio_file=".S_KCAPTCHA."securimage_play.php' height='16' width='16'>";
					echo"<param name='movie' value='".S_KCAPTCHA."securimage/securimage_play.swf?bgcol=#ffffff&amp;icon_file=".S_KCAPTCHA."securimage/images/audio_icon.png&amp;audio_file=".S_KCAPTCHA."securimage/securimage_play.php' /></object>";
					echo"<a href='#' onclick='document.getElementById('siimage').src = '".S_KCAPTCHA."securimage_show.php?sid=' + Math.random(); this.blur(); return false'>";
					echo"<img src='".S_KCAPTCHA."images/refresh.png' height='16' width='16' onclick='this.blur()'/></a></td></tr>";
   					echo"<tr><td colspan='2' align='center'><br><input type='text' name='kapcha_code' class='textbox'></td></tr>";
  				}
			echo"<tr><td colspan='2' align='center'><br><input type='submit' class='button' value='".$txt['menu_auth_enter']."'></td></tr>";
     			echo"<tr><td height='30' colspan='2' align='left' valign='middle'><img src='".IMAGES."admin.png' align='absmiddle'>&nbsp;&nbsp;&nbsp;<a href='".BASEDIR."register.php'>".$txt['menu_auth_reg']."</a></td></tr>";

     			if (WCF::$settings['pass_remember'] == "on")
					{
     						echo"<tr><td height='30' colspan='2' align='left' valign='middle'><img src='".IMAGES."mail.png' align='absmiddle'>&nbsp;&nbsp;&nbsp;<a href='".BASEDIR."index.php'>".$txt['menu_auth_remember_pass']."</a></td></tr>";
		   			}
			echo"</form>";
			closeside();
		}
	else if (isset($_SESSION['user_id']) || ($_SESSION['ip'] == $_SERVER['REMOTE_ADDR']))
		{
 			$query_user = WCF::$DB->db_query("SELECT * FROM ".DB_USERS." WHERE `user_id`=".$_SESSION['user_id']." LIMIT 1");
  			$res_user = WCF::$DB->db_assoc($query_user);

			openside();
			echo"<tr><td align='left'>".$txt['menu_auth_greeting']."&nbsp;".ucfirst(strtolower($_SESSION['user_name']))."</td></tr>";
			echo"<tr><td align='right' valign='top' class='avatar'>".avatar_img($res_user['user_avatar'])."</td></tr>";
  			echo"<tr><td align='left'>".$txt['menu_auth_ip']."</td></tr>";
  			echo"<tr><td align='left'>".$_SERVER['REMOTE_ADDR']."</td></tr>";
			echo"<tr><td width='100%'><hr></td></tr>";
			if($AUTH->GMLevel() >= WCF::$settings['level_administration'] ) { echo"<tr><td align='right'><a href='".ADMIN."administration.php?contet'>".$txt['menu_auth_admin']."</a></td></tr>";}
			echo"<tr><td align='right'><a href='".BASEDIR."setuser.php?action=logout'>".$txt['menu_auth_exit']."</a>";
			closeside();
		}
?>