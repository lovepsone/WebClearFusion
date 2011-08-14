<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: toolbar.php
| Author: lovepsone, Êîò_ÄàWIN÷è
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	if ( !isset($r_ip) or ($r_ip == '')) { return; }

	echo"<table width='99%' border='0' cellpadding='10' cellspacing='0'>";
	echo"<tr><td align='left' valign='middle' class='LogoutText'><img src='images/tree.gif' border=0  align='absmiddle' alt='IP'>".$_SERVER['REMOTE_ADDR']."</td>";
	echo"<td align='right' valign='middle' class='LogoutText'>";


	if (isset($_SESSION['modul']))
		{
     			echo"<a href='logout.php'>$txt[10]</a>";
	 	}

	echo"</td></tr>";

	echo"<tr><td align='center' width='100%' valign='middle' class='LogoutText'>$copyright</td></tr></table>";
	//echo"<tr><td align='center' valign='middle' class='LogoutText'>$revision</td></tr></table>";
?>
