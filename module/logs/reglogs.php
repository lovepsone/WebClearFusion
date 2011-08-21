<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: reglogs.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	echo"<script type='text/javascript' src='js/adminmenu.js'></script>";

	require $modules['adminmenu'][0];

	echo"<table width='100%' class='report'>";
	echo"<tr class='head'><td width='20%' align='left' class='head'>$txt[28]<td>";
	echo"<td width='15%' align='left' class='head'>$txt[29]<td>";
	echo"<td width='20%' align='left' class='head'>$txt[31]<td>";
	echo"<td width='20%' align='left' class='head'>$txt[32]<td>";
	echo"<td width='20%' align='left' class='head'>$txt[33]<td></tr>";

	$w_connect = mysql_connect($config['whostname'], $config['wusername'], $config['wpassword']);
	mysql_select_db($config['wdbName'], $w_connect);
	mysql_query("SET NAMES '".$config['encoding']."'");

	$query = "SELECT * FROM `wcf_logs`";
	$res = mysql_query($query) or trigger_error(mysql_error().$query);

 	while ($mres = mysql_fetch_array($res))
		{
			if( $mres['mode'] == '1')
				{
					echo"<tr><td width='20%'>".$mres['date']."</td>";
					echo"<td width='15%' colspan='2' align='left'>".$mres['ip']."</td>";
					echo"<td width='20%' colspan='2' align='left'>".$txt[18+$mres['mode']]."</td>";
					echo"<td width='20%' colspan='2' align='left'>".$mres['email']."</td>";
					echo"<td width='20%' colspan='2' align='left'>".ucfirst(strtolower($mres['note']))."</td></tr>";
				}
		}
	echo"</table>";
?>