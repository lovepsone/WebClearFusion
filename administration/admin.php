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
	echo"<th  colspan='4'>".$txt['menu_auth_admin']." - v".$config['rev_admin']."</th>";
	echo"<tr><td align='center' colspan='4'><div class='adminmenu'>";
		echo"<ul id='cssmenu1'>";
			echo"<li style='border-left: 1px solid #202020;'><a href='index.php?modul=admin&contet'>".$txt['menu_admin_content']."</a> 
						<ul>
    						<li><a href='index.php?modul=newsadd'>$txt[menu_admin_news_add]</a></li>
    						<li><a href='index.php?modul=newsedit'>$txt[menu_admin_news_edit]</a></li>
    						<li><a href='index.php?modul=newsdel'>$txt[menu_admin_news_del]</a></li>
    						</ul></li>";

			echo"<li style='border-left: 1px solid #202020;'><a href='index.php?modul=admin&users'>".$txt['menu_admin_users']."</a> 
						<ul>
    						<li><a href='index.php?modul=newsadd'>$txt[menu_admin_news_add]</a></li>
    						<li><a href='index.php?modul=newsedit'>$txt[menu_admin_news_edit]</a></li>
    						<li><a href='index.php?modul=newsdel'>$txt[menu_admin_news_del]</a></li>
    						</ul></li>";
			echo"<li style='border-left: 1px solid #202020;'><a href='index.php?modul=admin&system'>".$txt['menu_admin_system']."</a> 
						<ul>
    						<li><a href='index.php?modul=adminsetpanel'>$txt[menu_admin_set_panel]</a></li>
    						<li><a href='index.php?modul=adminaddpanel'>$txt[menu_admin_add_panel]</a></li>
    						</ul></li>";

			echo"<li style='border-left: 1px solid #202020;'><a href='index.php?modul=admin&plants'>".$txt['menu_admin_plants']."</a> 
						<ul>
    						<li><a href='index.php?modul=alllogs'>$txt[1]</a></li>
    						<li><a href='index.php?modul=reglogs'>$txt[2]</a></li>
    						<li><a href=''>$txt[3]</a></li>
    						<li><a href=''>$txt[4]</a></li>
    						<li><a href=''>$txt[5]</a></li>
    						<li><a href=''>$txt[6]</a></li>
    						<li><a href=''>$txt[7]</a></li>
    						<li><a href=''>$txt[8]</a></li>
    						<li><a href=''>$txt[9]</a></li>
    						<li><a href=''>$txt[10]</a></li>
    						</ul></li>";
		echo"</ul>";
	echo"</div></td></tr><br><br>";
	//==================================================================
	// Подробное меню
	if (isset($_GET['contet'])) admin_page(1);
	else if (isset($_GET['users'])) admin_page(2);
	else if (isset($_GET['system'])) admin_page(3);
	else if (isset($_GET['plants'])) admin_page(4);

	echo"</table>";
?>
