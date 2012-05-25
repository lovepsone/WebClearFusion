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

	require_once INCLUDES."include_administration_list.php";

	$pages = array(1 => false, 2 => false, 3 => false, 4 => false, 5 => false); 
	$index_link = false; $admin_nav_opts = ""; $current_page = 0;

	openside();

	reset($admin_list);
	while (list($id, $data) = each($admin_list))
		{		
			$pages[$data[1]] .= "<option value='".ADMIN.$data[5]."'>".preg_replace("/&(?!(#\d+|\w+);)/", "&amp;", $txt[$data[4]])."</option>";
		}
	// дабавляем к навигации если имеются файлы в модулях
	$maf = array();
	for ($i=1;$i <= count($modules);$i++)
		{
			$patch[$i] = $modules[$module_list[$i]]."administration/";
			$maf = admin_files_page($patch[$i]);

			for ($j=0; $j < count($maf); $j++)
				{
					$m_exp = explode('.', $maf[$j]);
					$name = $m_exp[0];
					$pages[5] .= "<option value='".$patch[$i].$maf[$j]."'>".preg_replace("/&(?!(#\d+|\w+);)/", "&amp;", $name)."</option>";
				}
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
					elseif ($i == 3) {$t = 'system';} elseif ($i == 4) {$t = 'plants';} elseif ($i == 5) {$t = 'module';}

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
