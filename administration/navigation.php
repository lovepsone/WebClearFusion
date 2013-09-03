<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2013 lovepsone
+--------------------------------------------------------+
| Filename: navigation.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	require_once THEMES.'templates/AdminSettingList.php';

	$pages = array(1 => false, 2 => false, 3 => false, 4 => false, 5 => false); 
	$index_link = false; $admin_nav_opts = ""; $current_page = 0;

	for ($i = 1; $i < count($AdminSettingList['contet']) + 1; $i++)
		$pages[1] .= "<option value='".ADMIN.$AdminSettingList['contet'][$i]['file']."'>".preg_replace("/&(?!(#\d+|\w+);)/", "&amp;", WCF::$locale[$AdminSettingList['contet'][$i]['txt']])."</option>";

	for ($i = 1; $i < count($AdminSettingList['users']) + 1; $i++)
		$pages[2] .= "<option value='".ADMIN.$AdminSettingList['users'][$i]['file']."'>".preg_replace("/&(?!(#\d+|\w+);)/", "&amp;", WCF::$locale[$AdminSettingList['users'][$i]['txt']])."</option>";


	for ($i = 1; $i < count($AdminSettingList['system']) + 1; $i++)
		$pages[3] .= "<option value='".ADMIN.$AdminSettingList['system'][$i]['file']."'>".preg_replace("/&(?!(#\d+|\w+);)/", "&amp;", WCF::$locale[$AdminSettingList['system'][$i]['txt']])."</option>";

	for ($i = 1; $i < count($AdminSettingList['plants']) + 1; $i++)
		$pages[4] .= "<option value='".ADMIN.$AdminSettingList['plants'][$i]['file']."'>".preg_replace("/&(?!(#\d+|\w+);)/", "&amp;", WCF::$locale[$AdminSettingList['plants'][$i]['txt']])."</option>";

	openside(WCF::$locale['title_admin']);

	$content = false;
	for ($i = 1; $i < 5; $i++)
	{
		$page = $pages[$i];
		if ($i == 1)
		{
			echo" <a href='".ADMIN."administration.php?contet'>".WCF::$locale['menu_admin_panel_admin']."</a>";
			echo"<hr>";
		}	
		if ($page)
		{
			switch ($i)
			{
			  case 1:
			    $t = 'content';
			    break;
			  case 2:
			    $t = 'users';
			    break;
			  case 3:
			    $t = 'system';
			    break;
			  case 4:
			    $t = 'plants';
			    break;
			  case 5:
			    $t = 'module';
			    break;
			}
			$admin_pages = true;
			echo"<form action='".WCF_SELF."'>";
			echo"<select onchange='window.location.href=this.value' style='width:100%;' class='textbox'>";
			echo"<option value='".WCF_SELF."' style='font-style:italic;' selected='selected'>".WCF::$locale['menu_admin_'.$t]."</option>";
			echo $page."</select></form>";
			$content = true;
		}
		if ($i == 4)
		{
			if ($content) { echo"<hr>"; }
			echo" <a href='".BASEDIR."index.php'>".WCF::$locale['menu_admin_revert']."</a>";
		}
	}
	closeside();
?>
