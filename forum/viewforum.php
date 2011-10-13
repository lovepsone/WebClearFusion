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

	$forum_id = addslashes($_GET["id"]);

	if (isset($_GET['id']))
		{	
			selectdb(wcf);
			$result = mysql_query("SELECT * FROM `wcf_forums_threads` WHERE `forum_id`='$forum_id'");

			echo"<table width='100%' border='0' cellspacing='0' cellpadding='5' class='report'>";

			while($topics = mysql_fetch_array($result))
				{
          				echo"<tr><td align='left' style='text-align: left;' class='head'>&nbsp;&nbsp;<a href=''>".$topics['thread_name']."</a></td></tr>";
					echo"<tr><td align='left' style='text-align: left;' class='page'>&nbsp;&nbsp;".$topics['thread_text']."</td></tr>";
				}
			echo"</table>";
		}
?>