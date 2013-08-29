<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2013 lovepsone
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
		echo"<tr><td colspan='2' align='center'>".WCF::$locale['menu_auth_title']."<br><br></td></tr>";
  		echo"<tr><td colspan='2' align='center'>".WCF::$locale['menu_auth_account']."<br><input type='text' name='auth_name' class='textbox'></td></tr>";
 		echo"<tr><td colspan='2' align='center'>".WCF::$locale['menu_auth_pass']."<br><input type='password' name='auth_pass' class='textbox'></td></tr>";

		//======================================
		// Проверка на каптча
		if (WCF::$cfgSetting['kcaptcha_enable_auth'] == 1) 
  		{
   			echo"<tr><td colspan='2' align='center'><br><iframe src='./include/kcaptcha.php' marginheight='0' marginwidth='0' width='100' height='40' frameborder='0' scrolling='no' allowtransparency='true'></iframe></td></tr>"; 
   			echo"<tr><td colspan='2' align='center'><br><input type='text' name='kapcha_code' class='textbox'></td></tr>";
  		}
		echo"<tr><td colspan='2' align='center'><br><input type='submit' class='button' value='".WCF::$locale['menu_auth_enter']."'></td></tr>";
     		echo"<tr><td height='30' colspan='2' align='left' valign='middle'><img src='".IMAGES."register.png' align='absmiddle'>&nbsp;&nbsp;&nbsp;<a href='".BASEDIR."register.php' title='Test tool tip'>".WCF::$locale['menu_auth_reg']."</a></td></tr>";

     		if (WCF::$cfgSetting['pass_remember'] == "on")
		{
     			echo"<tr><td height='30' colspan='2' align='left' valign='middle'><img src='".IMAGES."mail.png' align='absmiddle'>&nbsp;&nbsp;&nbsp;<a href='".BASEDIR."index.php'>".WCF::$locale['menu_auth_remember_pass']."</a></td></tr>";
		}
		echo"</form>";
		closeside();
	}
	else if (isset($_SESSION['user_id']) || ($_SESSION['ip'] == $_SERVER['REMOTE_ADDR']))
	{
		openside();
		echo"<tr><td align='left'>".WCF::$locale['menu_auth_greeting']."&nbsp;".ucfirst(strtolower($_SESSION['user_name']))."</td></tr>";
		echo"<tr><td align='right' valign='top' class='avatar'>".avatar_img($_SESSION['user_avatar'])."</td></tr>";
  		echo"<tr><td align='left'>".WCF::$locale['menu_auth_ip']."</td></tr>";
  		echo"<tr><td align='left'>".$_SERVER['REMOTE_ADDR']."</td></tr>";
		echo"<tr><td width='100%'><hr></td></tr>";
		if ( $_SESSION['gmlevel'] >= WCF::$cfgSetting['level_administration'] ) { echo"<tr><td align='right'><a href='".ADMIN."administration.php?contet'>".WCF::$locale['menu_auth_admin']."</a></td></tr>";}
		echo"<tr><td align='right'><a href='".BASEDIR."setuser.php?action=logout'>".WCF::$locale['menu_auth_exit']."</a>";
		closeside();
	}
?>