<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: admin.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	//==================================================================
	// Верхнее меню
	echo"<script type='text/javascript' src='js/adminmenu.js'></script>";
	echo"<table align='center' class='report'>";
	echo"<th colspan='4'>".$txt['menu_auth_admin']." - v".$config['rev_admin']."</th>";
	echo"<tr><td align='center' colspan='4'><div class='adminmenu'><ul id='cssmenu1'>";
	echo"<li style='border-left: 1px solid #202020;'><a href='index.php?modul=admin&contet'>".$txt['menu_admin_content']."</a></li>";
	echo"<li style='border-left: 1px solid #202020;'><a href='index.php?modul=admin&users'>".$txt['menu_admin_users']."</a></li>";
	echo"<li style='border-left: 1px solid #202020;'><a href='index.php?modul=admin&system'>".$txt['menu_admin_system']."</a></li>";
	echo"<li style='border-left: 1px solid #202020;'><a href='index.php?modul=admin&plants'>".$txt['menu_admin_plants']."</a></li>";
	echo"</ul></div></td></tr>";
	//==================================================================
	// Подробное меню
	$kol_string = 4;
	for ($i = 1; $i < $kol_string; $i++)
		{
			if (isset($_GET['contet'])) admin_page(1,$i);
			else if (isset($_GET['users'])) admin_page(2,$i);
			else if (isset($_GET['system'])) admin_page(3,$i);
			else if (isset($_GET['plants'])) admin_page(4,$i);
		}
	echo"</table>";
?>
