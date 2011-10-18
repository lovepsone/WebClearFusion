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
			require "include/tinymce.php";
   			echo $edit_script;
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

			while ($replies = mysql_fetch_array($result))
				{
					selectdb(realmd);
 					$query_acc = "SELECT * FROM `account` WHERE `id`=".$replies['user_id']." LIMIT 1";
  					$result_acc = mysql_query($query_acc) or trigger_error(mysql_error().$query_acc);

  					if ($acc = mysql_fetch_assoc($result_acc)) 
      						{
       							$usr_name = $acc['username'];
							$usr_gmlvl = $acc['gmlevel'];
       							$usr_ip = $acc['last_ip'];
						}

					echo"<tr><td width='20%'align='left' class='page'>".ucfirst(strtolower($usr_name))."<br>$usr_ip</td>";
					echo"<td width='80%'align='left' style='text-align: left;' class='page'>&nbsp;&nbsp;".$replies['replies_text']."</td></tr>";
				}

			echo"</table>";

			echo"<form method='post'>";
			echo"<table width='100%' cellpadding='0' cellspacing='0' border='0' align='center'>";
			echo"</table>";
			echo"<textarea name='replies' style='width:300'></textarea>";
			echo"<br><center><input type='submit' value='replies'/></center></form>";
		}

?>