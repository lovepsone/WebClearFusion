<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2013 lovepsone
+--------------------------------------------------------+
| Filename: navigation_panel.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	openside(WCF::$locale['title_menu']);

	$rows = WCF::$DB->select(' -- CACHE: 180
		SELECT `link_name`, `link_url`, `link_visibility` FROM ?_navigation_links WHERE `link_position`=1 OR `link_position`=2 ORDER BY `link_order`');

	if ($rows != null)
	{
		foreach ($rows as $numRow => $data)
		{
			if (check_user($data['link_visibility']))
			{
				echo"<tr><td width='100%' valign='middle'>";
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
				echo"</td></tr>";
			}
		}
	}
	else
	{
			echo WCF::$locale['no_links'];
	}
       	closeside();
?>
