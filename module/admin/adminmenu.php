<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: adminmenu.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	echo"<script type='text/javascript' src='js/adminmenu.js'></script>";
	echo"<table align='center'>";
	echo"<td align='center'><div class='adminmenu'>";
		echo"<ul id='cssmenu1'>";
			echo"<li style='border-left: 1px solid #202020;'><a>$txt[menu_admin_news]</a> 
						<ul>
    						<li><a href='index.php?modul=newscreate'>$txt[menu_admin_news_create]</a></li>
    						<li><a href='index.php?modul=newsedit'>$txt[menu_admin_news_edit]</a></li>
    						<li><a href='index.php?modul=newsdel'>$txt[menu_admin_news_del]</a></li>
    						</ul></li>";
			echo"<li style='border-left: 1px solid #202020;'><a>$txt[menu_admin_settings]</a> 
						<ul>
    						<li><a href='index.php?modul=adminsetpanel'>$txt[menu_admin_set_panel]</a></li>
    						</ul></li>";

			echo"<li style='border-left: 1px solid #202020;'><a>$txt[log]</a> 
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
	echo"</div></td></table><br><br>";
?>
