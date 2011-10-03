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
  			echo"<table border='0' cellpadding='0' cellspacing='0' width='100%' class='panel'>";

			if (isset($Block_login) and ($Block_login == 1))
				{
					echo"<tr><td  colspan='2' align='center'>$txt[menu_auth_title]<br><br></td></tr>";
  					echo"<tr><td width='50%' height='30' align='left' valign='middle' class='logintext'>$txt[menu_auth_account]:&nbsp;</td>";
					echo"<td width='50%' height='30' align='left' valign='middle' class='logininput'><input type='text' name='auth_name' size='10'></td></tr>";

 					echo"<tr><td width='50%' height='30' align='left' valign='middle' class='logintext'>$txt[menu_auth_pass]:&nbsp;</td>";
      					echo"<td width='50%' height='30' align='left' valign='middle' class='logininput'><input type='password' name='auth_pass' size='10'></td></tr>";

					if ($config['Kcaptcha_enable'] == 1) 
  						{
   							echo"<tr><td colspan='2' height='30' align='center' valign='middle' class='logintext'><iframe src='./kcaptcha.php' marginheight='0' marginwidth='0' width='100' height='40' frameborder='0' scrolling='no' allowtransparency='true'></iframe></td></tr>"; 
   							echo"<tr><td colspan='2' height='30' align='center' valign='middle' class='LoginInput'><input type='text' name='kapcha_code' size=10></td></tr>";
  						}
					elseif (($config['Kcaptcha_enable'] == 2) AND ($login_count > 0)) 
  						{
   							echo"<tr><td colspan='2' height='30' align='center' valign='middle' class='logintext'><iframe src='./kcaptcha.php' marginheight='0' marginwidth='0' width='100' height='40' frameborder='0' scrolling='no' allowtransparency='true'></iframe></td></tr>"; 
   							echo"<tr><td colspan='2' height='30' align='center' valign='middle' class='LoginInput'><input type='text' name='kapcha_code' size=10></td></tr>";
  						}

					echo"<tr><td width='50%' height='30' colspan='2' align='center' valign='middle' class='loginbutton'><input type='submit' value='$txt[menu_auth_enter]'></td></tr>";

					selectdb(realmd);
					$rip = 'no';
  					$res = mysql_query("SELECT `ip` FROM `ip_banned` WHERE `ip`='".$_SERVER['REMOTE_ADDR']."' LIMIT 1") or trigger_error(mysql_error());

  					if ($row = mysql_fetch_assoc($res)) $rip = $row['ip'];
  					if ($rip != $_SERVER['REMOTE_ADDR'])
						{
     							echo"<tr><td height='30' colspan='2' align='left' valign='middle' class='logintext'><img src='images/admin.png' align='absmiddle'>&nbsp;&nbsp;&nbsp;<a href='index.php?modul=reg'>$txt[menu_auth_reg]</a></td></tr>";

     							if (($config['pass_remember'] == 'on') AND ($mail_method != 'test'))
								{
     									echo"<tr><td height='30' colspan='2' align='left' valign='middle' class='logintext'><img src='images/mail.png' align='absmiddle'>&nbsp;&nbsp;&nbsp;<a href='index.php?modul=remember'>$txt[menu_auth_remember_pass]</a></td></tr>";
		   						}
     						}

				}
			else 
				{
					echo"<tr><td  colspan='2' align='center'><br><br><br><br></td></tr>";
					echo"<tr><td  colspan='2' align='center'>$txt[main_ban_ip]<br><br></td></tr>";
					echo"<tr><td  colspan='2' align='center'><br><br><br><br></td></tr>";
				}
			echo"</table></form>";
		}
	else 
		{
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
       					$ra_joindate    = $row['joindate'];
       					$ra_last_ip      = $row['last_ip'];
       					$ra_locked      = $row['locked'];
       					$ra_last_login  = $row['last_login'];
       					$ra_online       = $row['active_realm_id'];
       					//$ra_expansion  = getExpansion($row['expansion']);
       					$ra_locale        = getlocale($row['locale']);
      				}

   			if (strtoupper($_SESSION['slovo']) != strtoupper($row['sha_pass_hash'])) 
     				{
      					session_destroy();
      					echo"<table width='200' border='0' cellspacing='0' cellpadding='0'>";
      					echo"<tr><td height='25' align='center' valign='middle' class='errtitle'><b>$txt[menu_auth_error]</b></td></tr>";
					echo"<tr><td height='45' align='center' valign='middle'  class='errtab'><b>$txt[menu_auth_re_enter]</b></td></tr>";
					echo"</table><br><br>";
      					ReturnMainForm(40);
      					return;
     				}

  			$query2 = "SELECT `active` FROM `account_banned` WHERE `id`='".$ra_id."' LIMIT 1";
  			$res2 = mysql_query($query2) or trigger_error(mysql_error());

  			if ($row2 = mysql_fetch_assoc($res2)) $r_act = $row2['active']; else $r_act = '0';

  			echo"<table width='200' border='0' cellspacing='0' cellpadding='3' class='panel'>";

  			echo"<tr><td align='left' valign='top' class='paneltitle'>$txt[menu_auth_account]</td></tr>";
  			echo"<tr><td align='left' valign='bottom' class='paneldata'>".ucfirst(strtolower($ra_username))."</td></tr>";
  			echo"<tr><td align='left' valign='top' class='paneltitle'>$txt[menu_auth_e_mail]</td></tr>";
  			echo"<tr><td align='left' valign='bottom' class='paneldata'>$ra_email</td></tr>";

  			echo"<tr><td align='left' valign='top' class='paneltitle'>$txt[menu_auth_ip]</td></tr>";
  			echo"<tr><td align='left' valign='bottom' class='paneldata'>".$_SERVER['REMOTE_ADDR']."</td></tr>";

			echo"<tr><td width='100%' valign='bottom'><hr></td></tr>";
			if ( $ra_admin >= $config['admin'] ) { echo"<tr><td align='right' valign='bottom' class='paneldata'><a href='index.php?modul=newsadd'>$txt[menu_auth_admin]</a></td></tr>";}
			echo"<tr><td align='right' valign='bottom' class='paneldata'><a href='index.php?modul=logout'>$txt[menu_auth_exit]</a></td></tr></table>";
		}
?>