<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: rightform.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/



	if (!isset($_SESSION['user_id']) or ($_SESSION['ip'] != $_SERVER['REMOTE_ADDR'])) require $modules['login'][0];
	else 
		{
  			$rip = '';

 			$r_connect = mysql_connect($config['rhostname'], $config['rusername'], $config['rpassword']);
			mysql_select_db($config['rdbName'], $r_connect);
			mysql_query("SET NAMES '".$config['encoding']."'");

  			$query0 = "SELECT `ip` FROM `ip_banned` WHERE `ip`='".$_SERVER['REMOTE_ADDR']."' LIMIT 1";
 			$res0 = mysql_query($query0);

  			if ($row0 = mysql_fetch_assoc($res0)) $rip  = $row0['ip'];
  			$query = "SELECT * FROM `account` WHERE `id`=".$_SESSION['user_id']." LIMIT 1";
  			$res = mysql_query($query) or trigger_error(mysql_error().$query);

  			if ($row = mysql_fetch_assoc($res)) 
      				{
       					$ra_id             = $row['id'];
       					$ra_username  = $row['username'];
       					$ra_gmlevel     = $txt[70+$row['gmlevel']];
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

   			if (strtoupper($_SESSION['slovo']) != strtoupper($row['sha_pass_hash']) ) 
     				{
      					session_destroy();
      					echo"<table width='200' border='0' cellspacing='0' cellpadding='0'>";
      					echo"<tr><td height='25' align='center' valign='middle' class='errtitle'><b>$txt[7]</b></td></tr>";
					echo"<tr><td height='45' align='center' valign='middle'  class='errtab'><b>$txt[8]</b></td></tr>";
					echo"</table><br><br>";
      					ReturnMainForm(40);
      					return;
     				}

			$r_connect = mysql_connect($config['rhostname'], $config['rusername'], $config['rpassword']);
			mysql_select_db($config['rdbName'], $r_connect);
			mysql_query("SET NAMES '".$config['encoding']."'");

  			$query2 = "SELECT `active` FROM `account_banned` WHERE `id`='".$ra_id."' LIMIT 1";
  			$res2 = mysql_query($query2) or trigger_error(mysql_error());

  			if ($row2 = mysql_fetch_assoc($res2)) $r_act  = $row2['active'];
  			else $r_act = '0';

  			echo"<table width='200' border='0' cellspacing='0' cellpadding='3'>";
			echo"<tr><td align='center'>";
			echo"<table valign='top' border='0' align='right' width='100%' class='PanelBG'>";
  			echo"<tr><td align='left' valign='top' class='paneltitle'>$txt[12]</td></tr>";
  			echo"<tr><td align='right' valign='bottom' class='paneldata'>".ucfirst(strtolower($ra_username))."</td></tr>";
  			echo"<tr><td align='left' valign='top' class='paneltitle'>$txt[13]</td></tr>";
  			echo"<tr><td align='right' valign='bottom' class='paneldata'>$ra_email</td></tr>";

  			echo"<tr><td align='left' valign='top' class='paneltitle'>IP</td></tr>";
  			echo"<tr><td align='right' valign='bottom' class='paneldata'>".$_SERVER['REMOTE_ADDR']."</td></tr>";

			echo"<tr><td width='100%' valign='bottom' class='line'></td></tr>";
			if ( $ra_admin >= $config['admin'] ) { echo"<tr><td align='right' valign='bottom' class='paneldata'><a href='index.php?modul=admin'>$txt[16]</a></td></tr>";}
			echo"<tr><td align='right' valign='bottom' class='paneldata'><a href='logout.php'>$txt[11]</a></td></tr></table>";
			echo"</td></tr></table>";
		}
?>