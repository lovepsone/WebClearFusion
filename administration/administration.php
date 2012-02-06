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
	require_once THEMES."templates/admin_header.php";

	//==================================================================
	// Верхнее меню
	opentable();
	echo"<th colspan='4'>".$txt['menu_auth_admin']." - v".$config['rev_admin']."</th>";
	echo"<tr><td align='center' colspan='5'><table><tr>";
	echo"<td align='center' width='20%'><span class='small'><strong><a href='".WCF_SELF."?contet'>".$txt['menu_admin_content']."</a></strong></span></td>";
	echo"<td align='center' width='20%'><span class='small'><strong><a href='".WCF_SELF."?users'>".$txt['menu_admin_users']."</a></strong></span></td>";
	echo"<td align='center' width='20%'><span class='small'><strong><a href='".WCF_SELF."?system'>".$txt['menu_admin_system']."</a></strong></span></td>";
	echo"<td align='center' width='20%'><span class='small'><strong><a href='".WCF_SELF."?plants'>".$txt['menu_admin_plants']."</a></strong></span></td>";
	echo"<td align='center' width='20%'><span class='small'><strong><a href='".WCF_SELF."?acp'>".$txt['menu_admin_acp']."</a></strong></span></td>";
	echo"</tr></table><br><hr></td></tr>";

	//==================================================================
	// Подробное меню
	$kol_string = 4;
	for ($i = 1; $i < $kol_string; $i++)
		{
			if (isset($_GET['contet'])) { admin_page(1,$i); }
			elseif (isset($_GET['users'])) { admin_page(2,$i); }
			elseif (isset($_GET['system'])) { admin_page(3,$i); }
			elseif (isset($_GET['plants'])) { admin_page(4,$i); }
			elseif (isset($_GET['acp'])) { admin_page(5,$i); }
		}
	closetable();

	require_once THEMES."templates/footer.php";
?>
