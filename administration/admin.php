<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: admin_menu.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/


function page_generator($admin_page,$lang)
	{
		selectdb(wcf);
		$administration = mysql_query("SELECT * FROM `wcf_admin` WHERE `admin_page`='$admin_page'") or trigger_error(mysql_error());

		while ($page_contet = mysql_fetch_array($administration))
			{
				if ($lang = "ru") $admin_title = $page_contet['admin_title_loc8'];
				else if ($lang = "en") $admin_title = $page_contet['admin_title_loc1'];

				echo"<tr>";
				if ($page_contet['admin_colum'] = 1)
					{
						echo"<td class='page'><a href='index.php?modul=".$page_contet['admin_link']."'><img src='administration/images/".$page_contet['admin_image']."' align='absmiddle'><br>$admin_title</td>";
					}
				echo"</tr>";
			}
	}
	//==================================================================
	// Верхнее меню
	echo"<script type='text/javascript' src='js/adminmenu.js'></script>";
	echo"<table align='center' class='report'>";
	echo"<th>".$txt['menu_auth_admin']." - v".$config['rev_admin']."</th>";
	echo"<tr><td align='center'><div class='adminmenu'>";
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

			echo"<li style='border-left: 1px solid #202020;'><a href='index.php?modul=admin&system'>".$txt['menu_admin_plants']."</a> 
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

//$lang = isset($_SESSION['lang']);

	if (isset($_GET['contet']))
		{
			page_generator(1,$config['lang']);
		}


echo"</table>";
?>
