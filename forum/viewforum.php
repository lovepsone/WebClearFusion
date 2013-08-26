<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2013 lovepsone
+--------------------------------------------------------+
| Filename: viewforum.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	require_once "../maincore.php";
	require_once THEMES."templates/header.php";

	if (!isset($_GET['action']) && isset($_GET['forum_id']))
	{
		$forum_id = addslashes($_GET["forum_id"]);

  		$rows = WCF::$DB->select(' -- CACHE: 180
					SELECT count(`post_date`) as number FROM ?_forums_posts WHERE `forum_id`=?d', $forum_id);
		foreach ($rows as $numRow=>$thr_kolzap) {}

		if ($thr_kolzap['number'] > WCF::$cfgSetting['page_forum_threads'])
		{
    			$page_len_thr = WCF::$cfgSetting['page_forum_threads'];
 
    			if (!isset($_GET['page']) || ($_GET['page'] == ''))
			{
				$start_rec_thr = 0;
			}
			else
			{
				$start_rec_thr = ((int)$_GET['page']-1)*WCF::$cfgSetting['page_forum_threads'];
			}
		}
		else
		{
    			$page_len_thr = $thr_kolzap['kol'];
			$start_rec_thr = 0;
		}


		$rows = WCF::$DB->select(' -- CACHE: 180
					SELECT * FROM ?_forums_threads
					LEFT JOIN ?_forums_posts ON ?_forums_posts.`post_id` = ?_forums_threads.`thread_lastpostid`
					LEFT JOIN ?_users ON `wcf_users`.`user_id`= ?_forums_threads.`thread_author`
					WHERE ?_forums_threads.`forum_id`= ?d
					ORDER BY ?_forums_posts.`post_date` DESC LIMIT '.$start_rec_thr.','.$page_len_thr, $forum_id);
		opentable();
   		echo"<tr><th width='4%'></th>";
		echo"<th width='57%' class='forum-caption'>".WCF::$locale['forum_column_top_aut']."</th>";
		echo"<th width='21%' class='forum-caption'>".WCF::$locale['forum_column_last_post']."</th>";
		echo"<th width='5%' class='forum-caption'>".WCF::$locale['forum_column_replies']."</th>";
		echo"<th width='10%' class='forum-caption'>".WCF::$locale['forum_column_views']."</th></tr>";

		if (isset($_SESSION['user_id']) || (isset($_SESSION['ip']) && $_SESSION['ip'] == $_SERVER['REMOTE_ADDR']))
			echo"<tr><th width='100%' colspan='5' align='left'><a href='".FORUM."viewforum.php?action=newthread&forum_id=$forum_id'>".WCF::$locale['forum_create_theme']."</a></th></tr>";

		if ($rows != null)
		{
			foreach ($rows as $numRow => $data)
			{
				$last_post = WCF::$DB->selectRow(' -- CACHE: 180
						SELECT * FROM ?_forums_posts, ?_users WHERE ?_forums_posts.`post_id` = ?d AND ?_users.`user_id` = ?d LIMIT 1', $data['thread_lastpostid'], $data['thread_lastuser']);

				echo"<tr><td width='4%' align='left' class='tbl1'></td>";
          			echo"<td align='left' class='tbl1'>&nbsp;&nbsp;<a href='".FORUM."viewposts.php?thread_id=".$data['thread_id']."&forum_id=".$forum_id."'>".$data['thread_subject']."</a><br>&nbsp;&nbsp;".ucfirst(strtolower($data['user_name']))."</td>";
				echo"<td width='21%' align='left' class='tbl1'>&nbsp;&nbsp;".$last_post['post_date']."<br>&nbsp;&nbsp;".WCF::$locale['forum_from']."&nbsp;&nbsp;".ucfirst(strtolower($last_post['user_name']))."</td>";
				echo"<td width='5%' align='center' class='tbl2'>".$data['thread_postcount']."</td>";
				echo"<td width='11%' align='center' class='tbl2'>".$data['thread_views']."</td></tr>";
			}
  			if ($thr_kolzap['kol'] > WCF::$cfgSetting['page_forum_threads'])
			{
  				$page_counter_thr = ceil($thr_kolzap['kol'] / WCF::$cfgSetting['page_forum_threads']);

   				if (!isset($_GET['page']) || ($_GET['page'] == '') || ($_GET['page'] == '_')) { $tp3 = 1; } else { $tp3 = (int)$_GET['page']; }
 				echo"<tr><td colspan='3' align='center' valign='middle' >".show_page(FORUM.'viewforum.php?forum_id='.$forum_id.'&page=',$tp3,$page_counter_thr)."</td></tr>";
  			}
		}
		else
		{
			echo"<td width='100%' align='center' colspan='5' class='tbl1'><h3>".WCF::$locale['forum_no_temes']."</h3></td>";
		}
		closetable();
	}
	//=========================
	// форма создания темы
	elseif ((isset($_GET['action']) && $_GET['action'] == "newthread") && isset($_GET['forum_id']))
	{
		$forum_id = addslashes($_GET["forum_id"]);

		opentable();
		echo"<form method='post'>";
       		echo"<tr><td width='15%' align='left' valign='middle'>".WCF::$locale['forum_create_name_theme']."&nbsp;&nbsp;<input type='text' class='textbox' name='thread_subject' size='40'></td></tr>";

		echo"<tr><td><br><textarea id='Tinymce' name='thread'></textarea></td></tr>";
		echo"<tr><td align='center'><input type='submit' class='button' value='".WCF::$locale['forum_create_theme']."'/></td></tr>";
		echo"</form>";

    		if (isset($_POST['thread']))
		{
			// Создание темы
			WCF::$DB->query('INSERT INTO ?_forums_threads (`forum_id`,`thread_subject`,`thread_author`,`thread_lastpostid`,`thread_lastuser`,`thread_postcount`) VALUES (?d, ?, ?d, 0, ?d, 1)', $forum_id, $_POST['thread_subject'], $_SESSION['user_id'], $_SESSION['user_id']);
			$thread_id = mysql_insert_id();// Прикрепляем id темы
			// Добавляем сообщение
			WCF::$DB->query('INSERT INTO ?_forums_posts (`forum_id`,`thread_id`,`user_id`,`post_text`) VALUES (?d, ?d, ?d, ?)', $forum_id, $thread_id, $_SESSION['user_id'], $_POST['thread']);
			$t_lastpost_id = mysql_insert_id();// Прикрепляем id сообщения
			// Обновляем тему с целю добавить Id сообщения
			WCF::$DB->query('UPDATE ?_forums_threads SET `thread_lastpostid`= ?d WHERE (`thread_id`= ?d)', $t_lastpost_id, $thread_id);

			// Обновляем сам форум с целю обнов кол-во собщений
			WCF::$DB->query('UPDATE ?_forums SET `forum_lastpostid`= ?d,`forum_postcount`=forum_postcount+1, `forum_threadcount`=forum_threadcount+1 WHERE (`forum_id`= ?d)', $t_lastpost_id, $forum_id);

			echo"<tr><td align='center'><img src='".IMAGES."ajax-loader.gif'/></td></tr>";
			WCF::ReturnForm(10,'viewposts.php?thread_id='.$thread_id.'&forum_id='.$forum_id);
		}
		closetable();
	}

	require_once THEMES."templates/footer.php";
?>