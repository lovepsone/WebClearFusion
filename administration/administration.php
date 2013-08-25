<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2013 lovepsone
+--------------------------------------------------------+
| Filename: administration.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	require_once "../maincore.php";
	require_once THEMES."templates/admin_header.php";
	require_once INCLUDES."include_administration_list.php";

	//==================================================================
	// Верхнее меню
	opentable();
	echo"<th colspan='4'>".WCF::$locale['menu_auth_admin']." - v".WCF::$cfgTitle['revision_admin']."</th>";
	echo"<tr><td align='center' colspan='5'><table><tr>";
	echo"<td align='center' width='20%'><span class='small'><strong><a href='".WCF_SELF."?contet'>".WCF::$locale['menu_admin_content']."</a></strong></span></td>";
	echo"<td align='center' width='20%'><span class='small'><strong><a href='".WCF_SELF."?users'>".WCF::$locale['menu_admin_users']."</a></strong></span></td>";
	echo"<td align='center' width='20%'><span class='small'><strong><a href='".WCF_SELF."?system'>".WCF::$locale['menu_admin_system']."</a></strong></span></td>";
	echo"<td align='center' width='20%'><span class='small'><strong><a href='".WCF_SELF."?plants'>".WCF::$locale['menu_admin_plants']."</a></strong></span></td>";
	echo"<td align='center' width='20%'><span class='small'><strong><a href='".WCF_SELF."?module'>".WCF::$locale['menu_admin_module']."</a></strong></span></td>";
	echo"</tr></table><br><hr></td></tr>";

	//==================================================================
	// Подробное меню
	$kol_string = 5;

	for ($i = 1; $i < $kol_string; $i++)
		{
			if (isset($_GET['contet'])) { admin_page(1,$i,$admin_list); }
			elseif (isset($_GET['users'])) { admin_page(2,$i,$admin_list); }
			elseif (isset($_GET['system'])) { admin_page(3,$i,$admin_list); }
			elseif (isset($_GET['plants'])) { admin_page(4,$i,$admin_list); }
			elseif (isset($_GET['module'])) { admin_page(5,$i,$admin_list); }
		}
	closetable();

	require_once THEMES."templates/footer.php";
?>
