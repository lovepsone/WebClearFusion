<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2012 lovepsone
+--------------------------------------------------------+
| Filename: navigation.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	$pages = array(1 => false, 2 => false, 3 => false, 4 => false, 5 => false); 
	$index_link = false; $admin_nav_opts = ""; $current_page = 0;

	openside();
	selectdb("wcf");
	$result = db_query("SELECT * FROM ".DB_ADMIN."  WHERE `admin_link`!='reserved' ORDER BY `admin_page` DESC, `admin_title` ASC");
	$rows = db_num_rows($result);

	while ($data = db_array($result))
		{		
			$pages[$data['admin_page']] .= "<option value='".ADMIN.$data['admin_link']."'>".preg_replace("/&(?!(#\d+|\w+);)/", "&amp;", $data['admin_title'])."</option>";
		}

	$content = false;
	for ($i = 1; $i < 6; $i++)
		{
			$page = $pages[$i];
			if ($i == 1)
				{
					echo" <a href='".ADMIN."administration.php?contet'>".$txt['menu_admin_panel_admin']."</a>";
					echo"<hr>";
				}	
			if ($page)
				{
					if ($i == 1) {$t = 'content';} elseif ($i == 2) {$t = 'users';}
					elseif ($i == 3) {$t = 'system';} elseif ($i == 4) {$t = 'plants';} elseif ($i == 5) {$t = 'acp';}

					$admin_pages = true;
					echo"<form action='".WCF_SELF."'>";
					echo"<select onchange='window.location.href=this.value' style='width:100%;' class='textbox'>";
					echo"<option value='".WCF_SELF."' style='font-style:italic;' selected='selected'>".$txt['menu_admin_'.$t]."</option>";
					echo $page."</select></form>";
					$content = true;
				}
			if ($i == 5)
				{
					if ($content) { echo"<hr>"; }
					echo" <a href='".BASEDIR."index.php'>".$txt['menu_admin_revert']."</a>";
				}
		}
	closeside();
?>
