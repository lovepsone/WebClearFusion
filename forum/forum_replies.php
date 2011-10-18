<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: forum_replies.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	$forum_id = addslashes($_GET["fid"]);
	$thread_id = addslashes($_GET["id"]);

	if (isset($_GET['id']) and isset($_GET['fid']))
		{
			selectdb(wcf);
			$result = "SELECT `wcf_forums_threads`.*, `wcf_forums_replies`.*
						FROM `wcf_forums_threads`,`wcf_forums_replies` 
						WHERE `wcf_forums_replies`.`forum_id`='$forum_id'
						AND `wcf_forums_replies`.`thread_id`='$thread_id'
						AND `wcf_forums_threads`.`thread_id`='$thread_id'";
			$result_name = mysql_query($result);
			$result = mysql_query($result);

			if ($res = mysql_fetch_assoc($result_name))  $repl_name = $res['thread_name'];

			echo"<table width='100%' border='0' cellspacing='0' cellpadding='5' class='report'>";
			echo"<tr><th width='100%' class='head' colspan='2'>".$repl_name."</th></tr>";

			while ($replies =  mysql_fetch_array($result))
				{
					echo"<tr><td width='20%'align='left' style='text-align: left;' class='page'></td>";
					echo"<td width='80%'align='left' style='text-align: left;' class='page'>&nbsp;&nbsp;".$replies['replies_text']."</td></tr>";
				}

			echo"</table>";
		}

?>