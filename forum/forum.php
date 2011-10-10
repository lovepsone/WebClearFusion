<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: forum.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	selectdb(wcf);
	$result = mysql_query("SELECT * FROM `wcf_forums`");

	while($section = mysql_fetch_array($result))
		{
			if ($section['forum_cat'] == '0')
				{
					echo"<table width='100%' border='0' cellspacing='0' cellpadding='5' class='report'>";
          				echo"<tr><td align='left' class='head'>".$section['forum_name']."&nbsp;</td></tr>";

					$tm_result = mysql_query("SELECT * FROM `wcf_forums` WHERE `forum_cat`='".$section['forum_id']."'");
					while ($tm_section = mysql_fetch_array($tm_result))
						{
							echo"<tr><td align='left' style='text-align: left;' class='page'>&nbsp;&nbsp;<a href='index.php?modul=forum&id=$tm_section[forum_id]'><b>".$tm_section['forum_name']."</b></a>";
							echo"<br>&nbsp;&nbsp;".$tm_section['forum_description']."</td></tr>";	
						}	
					echo"</table>";
				}	
		}
?>