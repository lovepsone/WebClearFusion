<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2013 lovepsone
+--------------------------------------------------------+
| Filename: viewposts.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	require_once "../maincore.php";
	require_once THEMES."templates/header.php";

	if (isset($_GET['thread_id']) && isset($_GET['forum_id']))
	{
		$forum_id = addslashes($_GET["forum_id"]);
		$thread_id = addslashes($_GET["thread_id"]);

  		$rows = WCF::$DB->select(' -- CACHE: 180
				SELECT count(`post_date`) as number FROM ?_forums_posts
				WHERE `forum_id`= ?d AND `thread_id`= ?d', $forum_id, $thread_id);

		foreach ($rows as $numRow=>$p_kolzap) {}

		if ($p_kolzap['number'] > WCF::$cfgSetting['page_forum_posts'])
		{
    			$page_len_p = WCF::$cfgSetting['page_forum_posts'];
 
    			if (!isset($_GET['page']) || ($_GET['page'] == ''))
			{
				$start_rec_p = 0;
			}
			else
			{
				$start_rec_p = ((int)$_GET['page']-1)*WCF::$cfgSetting['page_forum_posts'];
			}
		}
		else
		{
    			$page_len_p = $p_kolzap['number'];
			$start_rec_p = 0;
		}

		$rows = WCF::$DB->select(' -- CACHE: 180
					SELECT *
					FROM ?_forums_threads,?_forums_posts
					WHERE ?_forums_posts.`forum_id`= ?d
					AND ?_forums_posts.`thread_id`= ?d
					AND ?_forums_threads.`thread_id`= ?d
					ORDER BY ?_forums_posts.`post_date` ASC LIMIT '.$start_rec_p.','.$page_len_p, $forum_id, $thread_id, $thread_id);

		//$name_thread = db_query($result);
		//$result = db_query($result);*/
		opentable();

		if ($rows != null)
		{
			WCF::$DB->query('UPDATE ?_forums_threads SET `thread_views`=thread_views+1 WHERE `thread_id`= ?d', $thread_id);
			$i = 0;
			foreach ($rows as $numRow=>$data)
			{
				if($i == 0)
					echo"<tr><th width='100%' colspan='2' class='tbl'>".$data['thread_subject']."</th></tr>";

				$row = WCF::$DB->selectRow('SELECT * FROM ?_users WHERE `user_id`=?d',$data['user_id']);
				echo"<tr><td width='20%' align='left' class='tbl2'>".ucfirst(strtolower($row['user_name']))."<br>".avatar_img($row['user_avatar'])."</td>";
				echo"<td width='80%' align='left' class='tbl1'>".stripslashes($data['post_text'])."</td></tr><tr><td colspan='2'><hr></td></tr>";
				$i++;
			}
  			if ($p_kolzap['number'] > WCF::$cfgSetting['page_forum_posts'])
			{
  				$page_counter_p = ceil($p_kolzap['number'] / WCF::$cfgSetting['page_forum_posts']);

   				if (!isset($_GET['page']) || ($_GET['page'] == '') || ($_GET['page'] == '_')) {$tp3 = 1;} else {$tp3 = (int)$_GET['page'];}

 				echo"<tr><td height='30' colspan='3' align='center' valign='middle' >".show_page(FORUM.'viewposts.php?thread_id='.$thread_id.'&forum_id='.$forum_id.'&page=',$tp3,$page_counter_p)."</td></tr>";
  			}
		}
		//=========================
		// форма отправки сообщения
		if (isset($_SESSION['user_id']) || (isset($_SESSION['ip']) && $_SESSION['ip'] == $_SERVER['REMOTE_ADDR']))
		{
			if(isset($_POST['posts']))
			{
				// Создаем сообщение
				WCF::$DB->query('INSERT INTO ?_forums_posts (`forum_id`,`thread_id`,`user_id`,`post_text`) VALUES (?d, ?d, ?d, ?)', $forum_id, $thread_id, $_SESSION['user_id'], $_POST['posts']);
				$p_post_id = mysql_insert_id(); // Прикрепляем id
				// Обновляем сам форум с целю обнов кол-во собщений
				WCF::$DB->query('UPDATE ?_forums SET `forum_lastpostid`= ?d,`forum_postcount`=forum_postcount+1 WHERE (`forum_id`= ?d)', $p_post_id, $forum_id);
				// Обновляем тему
				WCF::$DB->query('UPDATE ?_forums_threads SET `thread_lastpostid`= ?d, `thread_lastuser`= ?d, `thread_postcount`=thread_postcount+1 WHERE (`forum_id`= ?d AND `thread_id`= ?d)', $p_post_id, $_SESSION['user_id'], $forum_id, $thread_id);

				echo"<tr><td align='center' colspan='2'><img src='".IMAGES."ajax-loader.gif'/></td></tr>";
				WCF::ReturnForm(5,FORUM.'viewposts.php?thread_id='.$thread_id.'&forum_id='.$forum_id);
			}
			else 
			{
				echo"<form method='post'>";
				echo"<tr><td align='center' colspan='2'><textarea id='Tinymce' name='posts'></textarea></td></tr>";
				echo"<tr><td align='center' colspan='2'><input type='submit' class='button' value='".WCF::$locale['forum_quick_reply']."'/></td></tr></form>";
			}
		}
		else if (!isset($_SESSION['user_id']) || ($_SESSION['ip'] != $_SERVER['REMOTE_ADDR']))
		{ 
			echo"<tr><td align='center' colspan='2'>".WCF::$locale['forum_log']."</td></tr>";
		}
		closetable();
	}

	require_once THEMES."templates/footer.php";
?>