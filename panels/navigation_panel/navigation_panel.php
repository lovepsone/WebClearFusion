<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2014 lovepsone
+--------------------------------------------------------+
| Filename: navigation_panel.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	openside(WCF::getLocale('panel', 0));

	$rows = WCF::$DB->select(' -- CACHE: 180
		SELECT `link_name`, `link_url`, `link_visibility` FROM ?_navigation_links WHERE `link_position`=1 OR `link_position`=2 ORDER BY `link_order`');

	if ($rows != null)
	{
		echo "<div id='navigation'>\n";
		foreach ($rows as $numRow => $data)
		{
			if (WCF::CheckGroup($data['link_visibility']))
			{
				if ($data['link_name'] != "---" && $data['link_url'] == "---")
				{
					echo"<div class='side-label'><strong>".$data['link_name']."</strong></div>";
				}
				else if ($data['link_name'] == "---" && $data['link_url'] == "---")
				{
					echo"<hr class='side-hr' />";
				}
				else
				{
					echo" <a href='".BASEDIR.$data['link_url']."' class='side'>".$data['link_name']."</a>";
				}
			}
		}
		echo "</div>\n";
	}
	else
	{
			echo WCF::getLocale('panel', 1);
	}
       	closeside();
?>
