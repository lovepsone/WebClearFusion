<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: forum_threads.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	$forum_id = addslashes($_GET["id"]);

	if (isset($_GET['id']))
		{
			selectdb(wcf);
			$result = mysql_query("SELECT `wcf_forums_threads`.*, `wcf_users`.* FROM `wcf_forums_threads`, `wcf_users` WHERE `forum_id`='$forum_id' AND `wcf_forums_threads`.`user_id`=`wcf_users`.`user_id`");

			echo"<table width='100%' border='0' cellspacing='0' cellpadding='5' class='report'>";

   			echo"<tr><th width='4%' class='head'></th>";
			echo"<th width='57%'>$txt[forum_column_top_aut]</th>";
			echo"<th width='21%'>$txt[forum_column_last_post]</th>";
			echo"<th width='5%'>$txt[forum_column_replies]</th>";
			echo"<th width='10%'>$txt[forum_column_views]</th></tr>";
			echo"<tr><th width='100%' colspan='5' align='left' style='text-align: left;' class='head'><a href='index.php?modul=thread&create&forum_id=$forum_id'>$txt[forum_create_theme]</a></th></tr>";

			while($topics = mysql_fetch_array($result))
				{
					echo"<tr><td width='4%' align='left' style='text-align: left;' class='page'></td>";
          				echo"<td align='left' style='text-align: left;' class='page'>&nbsp;&nbsp;<a href='index.php?modul=post&id=$topics[thread_id]&forum_id=$forum_id'>".$topics['thread_name']."</a><br>&nbsp;&nbsp;".ucfirst(strtolower($topics['user_name']))."</td>";
					echo"<td width='21%' align='left' style='text-align: left;' class='page'>&nbsp;&nbsp;</td>";
					echo"<td width='5%' class='page'>".$topics['thread_postcount']."</td>";
					echo"<td width='11%' class='page'>&nbsp;&nbsp;</td></tr>";
				}
			echo"</table>";
		}
	if (isset($_GET['create']) & isset($_GET['forum_id']))
		{
			$forum_id = addslashes($_GET["forum_id"]);
			require "include/tinymce.php";
   			echo $advanced_script;

			echo"<form method='post'>";
			echo"<table width='100%' cellpadding='0' cellspacing='0' border='0' align='center'>";
	
       			echo"<tr><td width='15%' height='30' align='right' valign='middle'>$txt[forum_create_name_theme]</td>";
			echo"<td width='1%' height='30' >&nbsp;</td>";
        		echo"<td width='84%' height='30' align='left' valign='middle'><input name='modul' value='thread' type=hidden><input type='text' name='name_thread' size='40'></td></tr></table>";

			echo"<textarea name='thread'></textarea>";
			echo"<br><center><input type='submit' value='$txt[forum_create_theme]'/></center></form>";

    			if ($_POST['thread'])
				{
					selectdb(wcf);
					$add_thread = mysql_query("INSERT INTO `wcf_forums_threads` (`forum_id`,`user_id`,`thread_name`,`thread_postcount`) VALUES ('$forum_id','".$_SESSION['user_id']."','".$_POST['name_thread']."','1')") or trigger_error(mysql_error());
					$thread_id = mysql_insert_id();
					$add_post = mysql_query("INSERT INTO `wcf_forums_posts` (`forum_id`,`thread_id`,`user_id`,`posts_text`) VALUES ('$forum_id','$thread_id','".$_SESSION['user_id']."','".$_POST['thread']."')") or trigger_error(mysql_error());
					$updt_forum = mysql_query("UPDATE `wcf_forums` SET `forum_postcount`=forum_postcount+1, `forum_threadcount`=forum_threadcount+1 WHERE (`forum_id`='$forum_id')") or trigger_error(mysql_error());

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
						var timeout = 10;
						exec_refresh();
						//--> </script>";
				}
		}
?>