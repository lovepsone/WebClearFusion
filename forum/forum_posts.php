<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: forum_posts.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	$forum_id = addslashes($_GET["forum_id"]);
	$thread_id = addslashes($_GET["id"]);

	if (isset($_GET['id']) and isset($_GET['forum_id']))
		{
			require "include/tinymce.php";
   			echo $simple_script;
			selectdb(wcf);
			$result = "SELECT `wcf_forums_threads`.*, `wcf_forums_posts`.*
						FROM `wcf_forums_threads`,`wcf_forums_posts` 
						WHERE `wcf_forums_posts`.`forum_id`='$forum_id'
						AND `wcf_forums_posts`.`thread_id`='$thread_id'
						AND `wcf_forums_threads`.`thread_id`='$thread_id'";
			$result_name = mysql_query($result) or trigger_error(mysql_error());
			$result = mysql_query($result) or trigger_error(mysql_error());

			if ($res = mysql_fetch_assoc($result_name))  $repl_name = $res['thread_name'];

			echo"<table width='100%' border='0' cellspacing='0' cellpadding='5' class='report'>";
			echo"<tr><th width='100%' class='head' colspan='2'>".$repl_name."</th></tr>";

			while ($posts = mysql_fetch_array($result))
				{
					selectdb(realmd);
 					$query_acc = "SELECT * FROM `account` WHERE `id`='".$posts['user_id']."' LIMIT 1";
  					$result_acc = mysql_query($query_acc) or trigger_error(mysql_error().$query_acc);

  					if ($acc = mysql_fetch_assoc($result_acc)) 
      						{
       							$usr_name = $acc['username'];
							$usr_gmlvl = $acc['gmlevel'];
       							$usr_ip = $acc['last_ip'];
						}

					echo"<tr><td width='20%' align='left' class='page'>".ucfirst(strtolower($usr_name))."<br>$usr_ip</td>";
					echo"<td width='80%' align='left' style='text-align: left;' class='page'>&nbsp;&nbsp;".$posts['posts_text']."</td></tr>";
				}

			echo"</table>";

			if (isset($_SESSION['user_id']) or ($_SESSION['ip'] == $_SERVER['REMOTE_ADDR']))
				{
					if($_POST['posts'])
						{
							selectdb(wcf);
							$add_post = mysql_query("INSERT INTO `wcf_forums_posts`
										(`forum_id`,`thread_id`,`user_id`,`posts_text`) VALUES
										('$forum_id','$thread_id','".$_SESSION['user_id']."','".text_optimazer($_POST['posts'])."')") or trigger_error(mysql_error());
							$updt_forum = mysql_query("UPDATE `wcf_forums` SET `forum_postcount`=forum_postcount+1 WHERE (`forum_id`='$forum_id')") or trigger_error(mysql_error());
							$updt_thread = mysql_query("UPDATE `wcf_forums_threads` SET `thread_postcount`=thread_postcount+1 WHERE (`forum_id`='$forum_id' AND `thread_id`='$thread_id')") or trigger_error(mysql_error());

							echo"<img src='images/ajax-loader.gif'/>";
							echo"<script type='text/javascript'> <!--
										function exec_refresh()
											{
  												window.status = 'reloading...' + myvar;
  												myvar = myvar + ' .';
  												var timerID = setTimeout('exec_refresh();', 100);
  												if (timeout > 0)
													{
														timeout -= 1;
													}
												else
													{
    														clearTimeout(timerID);
    														window.status = '';
    														window.location = 'index.php?modul=post&id=$thread_id&forum_id=$forum_id';
    													}
											}
										var myvar = '';
										var timeout = 5;
										exec_refresh();
										//--> </script>";
						}
					else 
						{
							echo"<form method='post'>";
							echo"<table width='300' cellpadding='0' cellspacing='0' border='0' align='center'>";
							echo"<textarea name='posts'></textarea>";
							echo"<br><center><input type='submit' value='".$txt['forum_quick_reply']."'/></center></form></table>";
						}
				}
			else if (!isset($_SESSION['user_id']) or ($_SESSION['ip'] != $_SERVER['REMOTE_ADDR']))
				{ 
					echo $txt['forum_log'];
				}
		}

?>