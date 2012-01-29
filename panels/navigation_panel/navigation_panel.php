<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2012 lovepsone
+--------------------------------------------------------+
| Filename: navigation_panel.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	openside();
	selectdb(wcf);
	$result = db_query("SELECT `link_name`, `link_url`, `link_visibility` FROM ".DB_NAVIGATION_LINKS." WHERE `link_position`='1' OR `link_position`='2' ORDER BY `link_order`");


	if (db_num_rows($result))
		{
			while($data = db_array($result))
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
			echo $txt['no_links'];
		}
       	closeside();

?>
