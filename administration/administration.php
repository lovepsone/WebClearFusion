<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2012 lovepsone
+--------------------------------------------------------+
| Filename: administration.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	require_once "../maincore.php";
	require_once THEMES."templates/header.php";

	//==================================================================
	// ������� ����
	opentable();
	echo"<th colspan='4'>".$txt['menu_auth_admin']." - v".$config['rev_admin']."</th>";
	echo"<tr><td align='center' colspan='4'><div class='jsmenu'><ul>";

	echo"<li style='border-left: 1px solid #202020;'><a href='".WCF_SELF."?contet'>".$txt['menu_admin_content']."</a></li>";
	echo"<li style='border-left: 1px solid #202020;'><a href='".WCF_SELF."?users'>".$txt['menu_admin_users']."</a></li>";
	echo"<li style='border-left: 1px solid #202020;'><a href='".WCF_SELF."?system'>".$txt['menu_admin_system']."</a></li>";
	echo"<li style='border-left: 1px solid #202020;'><a href='".WCF_SELF."?plants'>".$txt['menu_admin_plants']."</a></li>";

	echo"</ul></div></td></tr>";

	//==================================================================
	// ��������� ����
	$kol_string = 4;
	for ($i = 1; $i < $kol_string; $i++)
		{
			if (isset($_GET['contet'])) admin_page(1,$i);
			else if (isset($_GET['users'])) admin_page(2,$i);
			else if (isset($_GET['system'])) admin_page(3,$i);
			else if (isset($_GET['plants'])) admin_page(4,$i);
		}
	closetable();

	require_once THEMES."templates/footer.php";
?>
