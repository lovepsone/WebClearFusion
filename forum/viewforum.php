<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2012 lovepsone
+--------------------------------------------------------+
| Filename: viewforum.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	require_once "../maincore.php";
	require_once THEMES."templates/header.php";
	require_once  INCLUDES."tinymce.php";
   			
	echo $advanced_script;

	if (!isset($_GET['action']) AND isset($_GET['forum_id']))
		{
			$forum_id = addslashes($_GET["forum_id"]);
			selectdb("wcf");
  			$result = db_query("SELECT count(`post_date`) as kol FROM `wcf_forums_posts` WHERE `forum_id`='$forum_id'");
			$thr_kolzap = db_array($result);

			if ($thr_kolzap['kol'] > $config['page_forum_threads'])
				{
    					$page_len_thr = $config['page_forum_threads'];
 
    					if (!isset($_GET['page']) or ($_GET['page'] == ''))
						{
							$start_rec_thr = 0;
						}
					else
						{
							$start_rec_thr = ((int)$_GET['page']-1)*$config['page_forum_threads'];
						}
				}
			else
				{
    					$page_len_thr = $thr_kolzap['kol'];
					$start_rec_thr = 0;
				}

			$result = db_query("SELECT * FROM ".DB_FORUMS_THREADS." 
						LEFT JOIN ".DB_FORUMS_POSTS." ON ".DB_FORUMS_POSTS.".`post_id`=".DB_FORUMS_THREADS.".`thread_lastpostid`
						LEFT JOIN `wcf_users` ON `wcf_users`.`user_id`=".DB_FORUMS_THREADS.".`thread_author`
						WHERE ".DB_FORUMS_THREADS.".`forum_id`='$forum_id'
						ORDER BY ".DB_FORUMS_POSTS.".`post_date` DESC LIMIT $start_rec_thr,$page_len_thr");
			opentable();
   			echo"<tr><th width='4%'></th>";
			echo"<th width='57%' class='forum-caption'>".$txt['forum_column_top_aut']."</th>";
			echo"<th width='21%' class='forum-caption'>".$txt['forum_column_last_post']."</th>";
			echo"<th width='5%' class='forum-caption'>".$txt['forum_column_replies']."</th>";
			echo"<th width='10%' class='forum-caption'>".$txt['forum_column_views']."</th></tr>";
			echo"<tr><th width='100%' colspan='5' align='left'><a href='".FORUM."viewforum.php?action=newthread&forum_id=$forum_id'>".$txt['forum_create_theme']."</a></th></tr>";

			if (db_num_rows($result) > 0 )
				{
					while($data = db_array($result))
						{
							selectdb("wcf");
							$last_post =  mysql_query("SELECT * FROM ".DB_FORUMS_POSTS.",`wcf_users`
											WHERE ".DB_FORUMS_POSTS.".`post_id`='".$data['thread_lastpostid']."'
											AND `wcf_users`.`user_id`='".$data['thread_lastuser']."' LIMIT 1");
							$last_post = mysql_fetch_assoc($last_post);

							echo"<tr><td width='4%' align='left' class='tbl1'></td>";
          						echo"<td align='left' class='tbl1'>&nbsp;&nbsp;<a href='".FORUM."viewposts.php?thread_id=".$data['thread_id']."&forum_id=".$forum_id."'>".$data['thread_subject']."</a><br>&nbsp;&nbsp;".ucfirst(strtolower($data['user_name']))."</td>";
							echo"<td width='21%' align='left' class='tbl1'>&nbsp;&nbsp;".$last_post['post_date']."<br>&nbsp;&nbsp;".$txt['forum_from']."&nbsp;&nbsp;".ucfirst(strtolower($last_post['user_name']))."</td>";
							echo"<td width='5%' align='center' class='tbl2'>".$data['thread_postcount']."</td>";
							echo"<td width='11%' align='center' class='tbl2'>".$data['thread_views']."</td></tr>";
						}
  					if ($thr_kolzap['kol'] > $config['page_forum_threads'])
						{
  							$page_counter_thr = ceil($thr_kolzap['kol'] / $config['page_forum_threads']);

   							if (!isset($_GET['page']) OR ($_GET['page'] == '') OR ($_GET['page'] == '_')) { $tp3 = 1; } else { $tp3 = (int)$_GET['page']; }
 							echo"<tr><td colspan='3' align='center' valign='middle' >".show_page(FORUM.'viewforum.php?forum_id='.$forum_id.'&page=',$tp3,$page_counter_thr)."</td></tr>";
  						}
				}
			else
				{
					echo"<td width='100%' align='center' colspan='5' class='tbl1'><h3>".$txt['forum_no_temes']."</h3></td>";
				}
			closetable();
		}
	//=========================
	// форма создания темы
	elseif ((isset($_GET['action']) && $_GET['action'] == "newthread") AND isset($_GET['forum_id']))
		{
			$forum_id = addslashes($_GET["forum_id"]);

			opentable();
			echo"<form method='post'>";
       			echo"<tr><td width='15%' align='left' valign='middle'>".$txt['forum_create_name_theme']."&nbsp;&nbsp;<input type='text' class='textbox' name='thread_subject' size='40'></td></tr>";

			echo"<tr><td><br><textarea name='thread'></textarea></td></tr>";
			echo"<tr><td align='center'><input type='submit' class='button' value='".$txt['forum_create_theme']."'/></td></tr>";
			echo"</form>";

    			if (isset($_POST['thread']))
				{
					selectdb("wcf");
					// Создание темы
					db_query("INSERT INTO ".DB_FORUMS_THREADS."
							(`forum_id`,`thread_subject`,`thread_author`,`thread_lastpostid`,`thread_lastuser`,`thread_postcount`)
							VALUES ('$forum_id','".$_POST['thread_subject']."','".$_SESSION['user_id']."','0','".$_SESSION['user_id']."','1')");
					$thread_id = mysql_insert_id();// Прикрепляем id темы

					// Добавляем сообщение
					db_query("INSERT INTO ".DB_FORUMS_POSTS." (`forum_id`,`thread_id`,`user_id`,`post_text`) VALUES ('$forum_id','$thread_id','".$_SESSION['user_id']."','".addslash($_POST['thread'])."')");
					$t_lastpost_id = mysql_insert_id();// Прикрепляем id сообщения

					// Обновляем тему с целю добавить Id сообщения
					db_query("UPDATE ".DB_FORUMS_THREADS." SET `thread_lastpostid`='$t_lastpost_id' WHERE (`thread_id`='$thread_id')");

					// Обновляем сам форум с целю обнов кол-во собщений
					db_query("UPDATE ".DB_FORUMS." SET `forum_lastpostid`='$t_lastpost_id',`forum_postcount`=forum_postcount+1, `forum_threadcount`=forum_threadcount+1 WHERE (`forum_id`='$forum_id')");

					echo"<tr><td align='center'><img src='".IMAGES."ajax-loader.gif'/></td></tr>";
					return_form(10,'viewposts.php?thread_id='.$thread_id.'&forum_id='.$forum_id);
				}
			closetable();
		}

	require_once THEMES."templates/footer.php";
?>