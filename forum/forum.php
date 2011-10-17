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

	echo"<table width='100%' border='0' cellspacing='0' cellpadding='5' class='report'>";
   	echo"<tr><th class='head' width='4%'></th>";
	echo"<th width='60%'>$txt[forum_column_section]</th>";
	echo"<th width='21%'>$txt[forum_column_last_post]</th>";
	echo"<th width='5%'>$txt[forum_column_so]</th>";
	echo"<th width='10%'>$txt[forum_column_posts]</th></tr>";
	echo"</table>";

	while($section = mysql_fetch_array($result))
		{
			if ($section['forum_sections'] == '0')
				{
					echo"<table width='100%' border='0' cellspacing='0' cellpadding='5' class='report'>";
          				echo"<tr><td width='100%' colspan='5' align='left' style='text-align: left;' class='head'>&nbsp;&nbsp;".$section['forum_name']."&nbsp;</td></tr>";

					$tm_result = mysql_query("SELECT * FROM `wcf_forums` WHERE `forum_sections`='".$section['forum_id']."'");
					while ($tm_section = mysql_fetch_array($tm_result))
						{
							echo"<tr><td width='4%' align='left' style='text-align: left;' class='page'></td>";
							echo"<td width='59%' align='left' style='text-align: left;' class='page'>&nbsp;&nbsp;<a href='index.php?modul=thread&id=$tm_section[forum_id]'><b>".$tm_section['forum_name']."</b></a><br>&nbsp;&nbsp;".$tm_section['forum_description']."</td>";
							echo"<td width='21%' align='left' style='text-align: left;' class='page'>&nbsp;&nbsp;</td>";
							echo"<td width='5%' align='left' style='text-align: left;' class='page'>&nbsp;&nbsp;</td>";
							echo"<td width='11%' align='left' style='text-align: left;' class='page'>&nbsp;&nbsp;</td></tr>";	
						}	
					echo"</table>";
				}	
		}
?>