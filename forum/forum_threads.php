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
  			$thr_cres = mysql_query("SELECT count(`post_date`) as kol FROM `wcf_forums_posts` WHERE `forum_id`='$forum_id'") or trigger_error(mysql_error());
			$thr_kolzap = mysql_fetch_array($thr_cres);

			if ($thr_kolzap['kol'] > $config['page_forum_threads'])
				{
    					$page_len_thr = $config['page_forum_threads'];
 
    					if (!isset($_GET['page']) or ($_GET['page'] == '')) $start_rec_thr = 0; else $start_rec_thr = ((int)$_GET['page']-1)*$config['page_forum_threads'];
				}
			else
				{
    					$page_len_thr = $thr_kolzap['kol'];
					$start_rec_thr = 0;
				}

			$result = mysql_query("SELECT * FROM `wcf_forums_threads` 
						LEFT JOIN `wcf_forums_posts` ON `wcf_forums_posts`.`post_id`=`wcf_forums_threads`.`thread_lastpostid`
						LEFT JOIN `wcf_users` ON `wcf_users`.`user_id`=`wcf_forums_threads`.`thread_author`
						WHERE `wcf_forums_threads`.`forum_id`='$forum_id'
						ORDER BY `wcf_forums_posts`.`post_date` DESC LIMIT $start_rec_thr,$page_len_thr");

			if (mysql_num_rows($result) > 0 )
				{
					echo"<table width='100%' border='0' cellspacing='0' cellpadding='5' class='report'>";

   					echo"<tr><th width='4%' class='head'></th>";
					echo"<th width='57%'>$txt[forum_column_top_aut]</th>";
					echo"<th width='21%'>$txt[forum_column_last_post]</th>";
					echo"<th width='5%'>$txt[forum_column_replies]</th>";
					echo"<th width='10%'>$txt[forum_column_views]</th></tr>";
					echo"<tr><th width='100%' colspan='5' align='left' style='text-align: left;' class='head'><a href='index.php?modul=thread&create&forum_id=$forum_id'>$txt[forum_create_theme]</a></th></tr>";

					while($topics = mysql_fetch_array($result))
						{
							selectdb(wcf);
							$last_post =  mysql_query("SELECT * FROM `wcf_forums_posts`,`wcf_users`
											WHERE `wcf_forums_posts`.`post_id`='".$topics['thread_lastpostid']."'
											AND `wcf_users`.`user_id`='".$topics['thread_lastuser']."' LIMIT 1") or trigger_error(mysql_error());
							$last_post = mysql_fetch_assoc($last_post);

							echo"<tr><td width='4%' align='left' style='text-align: left;' class='page'></td>";
          						echo"<td align='left' style='text-align: left;' class='page'>&nbsp;&nbsp;<a href='index.php?modul=post&id=$topics[thread_id]&forum_id=$forum_id'>".$topics['thread_subject']."</a><br>&nbsp;&nbsp;".ucfirst(strtolower($topics['user_name']))."</td>";
							echo"<td width='21%' align='left' style='text-align: left;' class='page'>&nbsp;&nbsp;".$last_post['post_date']."<br>&nbsp;&nbsp;".$txt['forum_from']."&nbsp;&nbsp;".ucfirst(strtolower($last_post['user_name']))."</td>";
							echo"<td width='5%' class='page'>".$topics['thread_postcount']."</td>";
							echo"<td width='11%' class='page'>&nbsp;&nbsp;".$topics['thread_views']."</td></tr>";
						}
  					if ($thr_kolzap['kol'] > $config['page_forum_threads'])
						{
  							$page_counter_thr = ceil($thr_kolzap['kol'] / $config['page_forum_threads']);

   							if (!isset($_GET['page']) OR ($_GET['page'] == '') OR ($_GET['page'] == '_')) $tp3 = 1; else $tp3 = (int)$_GET['page'];
 							echo"<tr><td height='30' colspan='3' align='center' valign='middle' >". ShowPageNavigator('index.php?modul=thread&id='.$forum_id.'&page=',$tp3,$page_counter_thr)."</td></tr>";
  						}

					echo"</table>";
				}
		}
	//=========================
	// форма создания темы
	if (isset($_GET['create']) & isset($_GET['forum_id']))
		{
			$forum_id = addslashes($_GET["forum_id"]);
			require "include/tinymce.php";
   			echo $advanced_script;

			echo"<form method='post'>";
			echo"<table width='100%' cellpadding='0' cellspacing='0' border='0' align='center'>";
	
       			echo"<tr><td width='15%' height='30' align='right' valign='middle'>$txt[forum_create_name_theme]</td>";
			echo"<td width='1%' height='30' >&nbsp;</td>";
        		echo"<td width='84%' height='30' align='left' valign='middle'><input name='modul' value='thread' type=hidden><input type='text' name='thread_subject' size='40'></td></tr></table>";

			echo"<textarea name='thread'></textarea>";
			echo"<br><center><input type='submit' value='$txt[forum_create_theme]'/></center></form>";

    			if ($_POST['thread'])
				{
					selectdb(wcf);
					// Создание темы
					$t_add_thread = mysql_query("INSERT INTO `wcf_forums_threads`
									(`forum_id`,`thread_subject`,`thread_author`,`thread_lastpostid`,`thread_lastuser`,`thread_postcount`)
									VALUES ('$forum_id','".$_POST['thread_subject']."','".$_SESSION['user_id']."','0','".$_SESSION['user_id']."','1')") or trigger_error(mysql_error());
					$thread_id = mysql_insert_id();// Прикрепляем id темы

					// Добавляем сообщение
					$t_add_post = mysql_query("INSERT INTO `wcf_forums_posts` (`forum_id`,`thread_id`,`user_id`,`post_text`) VALUES ('$forum_id','$thread_id','".$_SESSION['user_id']."','".$_POST['thread']."')") or trigger_error(mysql_error());
					$t_lastpost_id = mysql_insert_id();// Прикрепляем id сообщения

					// Обновляем тему с целю добавить Id сообщения
					$t_updt_post = mysql_query("UPDATE `wcf_forums_threads` SET `thread_lastpostid`='$t_lastpost_id' WHERE (`thread_id`='$thread_id')") or trigger_error(mysql_error());

					// Обновляем сам форум с целю обнов кол-во собщений
					$t_updt_forum = mysql_query("UPDATE `wcf_forums` SET `forum_postcount`=forum_postcount+1, `forum_threadcount`=forum_threadcount+1 WHERE (`forum_id`='$forum_id')") or trigger_error(mysql_error());

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