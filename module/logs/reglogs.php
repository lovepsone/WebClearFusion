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

	echo"<table width='100%' cellpadding='0' cellspacing='0' border='0' align='center'>";
	echo"<tr><td align='center'>";

	require $modules['adminmenu'][0];

   	echo"<table class=report width=500><tbody>";
   	echo"<tr><th class='head'>$txt[log_title_date]</th>";
	echo"<th>$txt[log_title_ip]</th>";
	echo"<th>$txt[log_title_mode]</th>";
	echo"<th>$txt[log_title_mail]</th>";
	echo"<th>$txt[log_title_account]</th></tr>";

	selectdb(wcf);
	$query = "SELECT * FROM ".DB_LOGS." WHERE `mode`=1";
	$res = mysql_query($query) or trigger_error(mysql_error().$query);

	if(mysql_num_rows($res)!=0)
		{
 			while ($mres = mysql_fetch_array($res))
				{
					if ($mres['character'] == '0') $mres['character'] = '';

					echo"<tr><td valign='center'  align='left' class='page'>".$mres['date']."</td>";
					echo"<td align='center' class='page'>".$mres['ip']."</td>";
					echo"<td align='center' class='page'>".$txt[1+$mres['mode']]."</td>";// надо придумать функцию. $txt[1+$mres['mode']] - это меня не устраевает
					echo"<td align='center' class='page'>".$mres['email']."</td>";
					echo"<td align='center' class='page'>".ucfirst(strtolower($mres['note']))."</td></tr>";
				}
		}
	else
		{
			echo"<tr><td align='center' colspan='6'>$txt[log_no]</td></tr>";
		}
	echo"</table>";
	echo"</td></tr>";
	echo"</table>";
?>