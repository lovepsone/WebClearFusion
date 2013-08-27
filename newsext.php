<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2012 lovepsone
+--------------------------------------------------------+
| Filename: newsext.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	require_once "maincore.php";
	require_once THEMES."templates/header.php";

	if (isset($_GET['id']) && WCF::isnum($_GET['id']))
	{
		$newsid = addslashes($_GET["id"]);


  		$data = WCF::$DB->selectRow(' -- CACHE: 180
				SELECT * FROM ?_news
				LEFT JOIN ?_news_cats ON `news_cat_id`=`news_cat`
				LEFT JOIN ?_users ON ?_users.`user_id`=?_news.`news_author`
				WHERE `news_id` = ?d', $newsid);
		if(count($data) > 0)
		{
			$allow_comments = $data['news_allow_comments'];
	
			$news_cat_image = "";
			if ($data['news_show_cat'] == 1)
			{
				$img_size = @getimagesize(IMAGES_NC.$data['news_cat_image']);
				$news_cat_image = "<img src='".IMAGES_NC.$data['news_cat_image']."' width='".$img_size[0]."' height='".$img_size[1]."' class='news-category' />";
			}
	
			opentable();
	          	echo"<tr><td align='left' class='head-table'>".$data['news_subject']."</td></tr>";
			echo"<tr><td align='left'>".$news_cat_image.stripslashes($data['news_text_extended'])."</td></tr>";
	          	echo"<tr><td align='left'>&nbsp;".WCF::$locale['modul_news_creation_date']."&nbsp;".$data['news_date']."&nbsp;".WCF::$locale['modul_news_author']."&nbsp;".ucfirst(strtolower($data['user_name']))."&nbsp;<br><hr></td></tr>";
			closetable();
	
			$rows = WCF::$DB->select(' -- CACHE: 180
						SELECT * FROM ?_comments
						LEFT JOIN ?_users ON ?_users.`user_id` = ?_comments.`user_id`
						WHERE `comment_item_id` = ?d AND `comment_type`=1', $newsid);
			opentable();
			if (!isset($_SESSION['user_id']) || ($_SESSION['ip'] != $_SERVER['REMOTE_ADDR']))
			{ 
				echo"<tr><td align='center' colspan='2'><h3>".WCF::$locale['modul_newsexp_log_in']."</h3></td></tr>";
			}
	
			foreach ($rows as $numRow => $data)
			{
				echo"<tr><td align='left' width='120' class='tbl2'>".ucfirst(strtolower($data['user_name']))."<br>".avatar_img($data['user_avatar'])."</td>";
				echo"<td align='left' class='tbl1'>".stripslashes($data['comment_message'])."</td></tr>";
				echo"<tr><td colspan='2'>".WCF::$locale['modul_newsexp_date_reply']."&nbsp;".$data['comment_date']."<br><hr></td></tr>";
			}
			
			//=========================
			// форма отправки коментария
			if ((isset($_SESSION['user_id']) || (isset($_SESSION['ip']) && $_SESSION['ip'] == $_SERVER['REMOTE_ADDR'])) && $allow_comments == 1)
			{
				if(isset($_POST['comments']))
				{
					// Создаем коммент
					WCF::$DB->query('INSERT INTO ?_comments (`comment_item_id`,`comment_type`,`user_id`,`comment_message`) VALUES (?d, 1, ?d, ?)', $newsid, $_SESSION['user_id'], $_POST['comments']);
	
					echo"<tr><td align='center' colspan='4'><img src='".IMAGES."ajax-loader.gif'/></td></tr>";
					WCF::ReturnForm(5, 'newsext.php?id='.$newsid);
				}
				else 
				{
					echo"<form method='post'>";
					echo"<tr><td align='center' colspan='4'><textarea id='Tinymce' name='comments'></textarea></td></tr>";
					echo"<tr><td align='center' colspan='4'><input type='submit' class='button' value='".WCF::$locale['forum_quick_reply']."'/></td></tr></form>";
				}
			}
			closetable();
		}
		else
		{
			WCF::redirect(BASEDIR."404.php");
		}
	}

	require_once THEMES."templates/footer.php";
?>