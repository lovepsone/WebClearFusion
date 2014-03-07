<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2014 lovepsone
+--------------------------------------------------------+
| Filename: navigation.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	include PANELS."user_info_panel/user_info_panel.php";

	$list = array(1 => false, 2 => false, 3 => false, 4 => false, 5 => false); $ListData = array(); $text = "";
	$ListData = WCF::getAdminPage();
	$index_link = false; $admin_nav_opts = ""; $current_page = 0;

	for ($ii = 1; $ii <= count($ListData); $ii++)
	{
		switch ($ii)
		{
		  case 1: $text = "adminc"; break;
		  case 2: $text = "adminu"; break;
		  case 3: $text = "admins"; break;
		  case 4: $text = "admint"; break;
		}
		for ($i = 1; $i <= count($ListData[$ii]); $i++)
		{
			$list[$ii] .= "<option value=''>".preg_replace("/&(?!(#\d+|\w+);)/", "&amp;", WCF::getLocale($text, $i))."</option>\n";
		}
	}

	openside(WCF::getLocale('admin', 1));

	$content = false;
	for ($i = 1; $i < 5; $i++)
	{
		$ListP = $list[$i];

		if ($i == 1)
		{
			echo THEME_BULLET." <a href='".ADMIN."index.php' class='side'>".WCF::getLocale('auth', 9)."</a>\n";
			echo "<hr class='side-hr' />\n";
		}
		if ($ListP)
		{
			$admin_pages = true;
			echo "<form action='".WCF_SELF."'>\n";
			echo "<select onchange='window.location.href=this.value' style='width:100%;' class='textbox'>\n";
			echo "<option value='".WCF_SELF."' style='font-style:italic;' selected='selected'>".WCF::getLocale('adminHead', $i-1)."</option>\n";
			echo $ListP."</select>\n</form>\n";
			$content = true;
		}
		if ($i == 4)
		{
			if ($content) { echo "<hr class='side-hr' />\n"; }
			echo THEME_BULLET." <a href='".BASEDIR."index.php' class='side'>".WCF::getLocale('common', 4)."</a>\n";
		}
	}
	closeside();
?>
