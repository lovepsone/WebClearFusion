<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: alllogs.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	echo"<script type='text/javascript' src='js/adminmenu.js'></script>";
	echo"<table width='100%' cellpadding='0' cellspacing='0' border='0' align='center'>";
	echo"<tr><td>";

	require $modules['adminmenu'][0];

	echo"<table border='0' width='100%' align='center' class='report'>";
	echo"<tr><td width='20%' align='left'>$txt[28]<td>";
	echo"<td width='15%' align='center'>$txt[29]<td>";
	echo"<td width='17%' align='center'>$txt[30]<td>";
	echo"<td width='15%' align='center'>$txt[31]<td>";
	echo"<td width='18%' align='center'>$txt[32]<td>";
	echo"<td width='15%' align='center'>$txt[33]<td></tr>";

	$w_connect = mysql_connect($config['whostname'], $config['wusername'], $config['wpassword']);
	mysql_select_db($config['wdbName'], $w_connect);
	mysql_query("SET NAMES '".$config['encoding']."'");

	$query = "SELECT * FROM `wcf_logs`";
	$res = mysql_query($query) or trigger_error(mysql_error().$query);

 	while ($mres = mysql_fetch_array($res))
		{
			if ($mres['character'] == '0') $mres['character'] = '';
			echo"<tr><td width='20%'>".$mres['date']."</td>";
			echo"<td width='15%' colspan='2' align='center'>".$mres['ip']."</td>";
			echo"<td width='17%' colspan='2' align='center'>".$mres['character']."</td>";
			echo"<td width='15%' colspan='2' align='center'>".$txt[18+$mres['mode']]."</td>";
			echo"<td width='18%' colspan='2' align='center'>".$mres['email']."</td>";
			echo"<td width='15%' colspan='2' align='center'>".ucfirst(strtolower($mres['note']))."</td></tr>";
		}
	echo"</table>";
	echo"</td></tr>";
	echo"</table>";

?>