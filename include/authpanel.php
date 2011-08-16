<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: authpanel.php
| Author: lovepsone, Êîò_ÄàWIN÷è
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	echo"<table width='200' border='0' cellspacing='0' cellpadding='3'>";
	echo"<tr><td align='center' class='MenuText'>$txt[1]</td></tr>"; 
	echo"</table><br><br>";

	echo"<form method='POST'>";
  	echo"<table border='0' cellpadding='0' cellspacing='0' width='100%'>";

  	echo"<tr><td width='50%' height='30' align='left' valign='middle' class='LoginText'>$txt[2]:&nbsp;</td>";
	echo"<td width='50%' height='30' align='left' valign='middle' class='LoginInput'><input type='text' name='auth_name' size='10'></td></tr>";

 	echo"<tr><td width='50%' height='30' align='left' valign='middle' class='LoginText'>$txt[3]:&nbsp;</td>";
      	echo"<td width='50%' height='30' align='left' valign='middle' class='LoginInput'><input type='password' name='auth_pass' size='10'></td></tr>";
	echo"<tr><td width='50%' height='30' colspan='2' align='center' valign='middle' class='LoginButton'><input type='submit' value='$txt[4]'></td></tr>";
  	$rip = 'no';

 	$r_connect = mysql_connect($config['rhostname'], $config['rusername'], $config['rpassword']);
	mysql_select_db($config['rdbName'], $r_connect);
	mysql_query("SET NAMES '".$config['encoding']."'");

  	$res = mysql_query("SELECT `ip` FROM `ip_banned` WHERE `ip`='".$_SERVER['REMOTE_ADDR']."' LIMIT 1") or trigger_error(mysql_error());

  	if ($row = mysql_fetch_assoc($res)) $rip  = $row['ip'];
  	if ($rip != $_SERVER['REMOTE_ADDR'])
		{
     			echo"<tr><td height='30' colspan='2' align='left' valign='middle' class='LoginText'><img src='images/admin.png' align='absmiddle'>&nbsp;&nbsp;&nbsp;<a href='index.php?modul=reg'>$txt[5]</a></td></tr>";

     		if (($config['pass_remember'] == 'on') AND ($mail_method != 'test'))
			{
     				echo"<tr><td height='30' colspan='2' align='left' valign='middle' class='LoginText'><img src='images/mail.png' align='absmiddle'>&nbsp;&nbsp;&nbsp;<a href='index.php?modul=remember'>$txt[6]</a></td></tr>";
		   	}
     		}

	echo"</table></form>";
?>