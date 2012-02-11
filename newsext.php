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
	require_once  INCLUDES."tinymce.php";

   	echo $simple_script;

	if (isset($_GET['id']) && isnum($_GET['id']))
		{
			$newsid = addslashes($_GET["id"]);

			selectdb("wcf");
  			$result = db_query("SELECT * FROM ".DB_NEWS." 
						LEFT JOIN ".DB_NEWS_CATS." ON `news_cat_id`=`news_cat`
						LEFT JOIN ".DB_USERS." ON ".DB_USERS.".`user_id`=".DB_NEWS.".`news_author`
						WHERE `news_id`='".$newsid."' limit 1");

			$data = db_assoc($result);
			$allow_comments = $data['news_allow_comments'];

			if ($data['news_show_cat'] == 1)
				{
					$img_size = @getimagesize(IMAGES_NC.$data['news_cat_image']);
					$news_cat_image = "<img src='".IMAGES_NC.$data['news_cat_image']."' width='".$img_size[0]."' height='".$img_size[1]."' class='news-category' />";
				}

			opentable();
          		echo"<tr><td align='left' class='head-table'>".$data['news_subject']."</td></tr>";
			echo"<tr><td align='left'>".$news_cat_image.stripslashes($data['news_text_extended'])."</td></tr>";
          		echo"<tr><td align='left'>&nbsp;".$txt['modul_news_creation_date']."&nbsp;".$data['news_date']."&nbsp;".$txt['modul_news_author']."&nbsp;".ucfirst(strtolower($data['user_name']))."&nbsp;<br><hr></td></tr>";
			closetable();

			$result = db_query("SELECT * FROM ".DB_COMMENTS."
						LEFT JOIN ".DB_USERS." ON ".DB_USERS.".`user_id`=".DB_COMMENTS.".`user_id`
						WHERE `comment_item_id`='".$newsid."' AND `comment_type`='1'");
			opentable();
			if (!isset($_SESSION['user_id']) || ($_SESSION['ip'] != $_SERVER['REMOTE_ADDR']))
				{ 
					echo"<tr><td align='center' colspan='2'><h3>".$txt['modul_newsexp_log_in']."</h3></td></tr>";
				}

			while ($data = db_array($result))
				{
					echo"<tr><td align='left' width='120' class='tbl2'>".ucfirst(strtolower($data['user_name']))."<br>".avatar_img($data['user_avatar'])."</td>";
					echo"<td align='left' class='tbl1'>".stripslashes($data['comment_message'])."</td></tr>";
					echo"<tr><td colspan='2'>".$txt['modul_newsexp_date_reply']."&nbsp;".$data['comment_date']."<br><hr></td></tr>";
				}
			//=========================
			// форма отправки коментария
			if ((isset($_SESSION['user_id']) || ($_SESSION['ip'] == $_SERVER['REMOTE_ADDR'])) && $allow_comments == 1)
				{
					if($_POST['comments'])
						{
							// Создаем коммент
							db_query("INSERT INTO `wcf_comments`
									(`comment_item_id`,`comment_type`,`user_id`,`comment_message`)
									VALUES ('".$newsid."','1','".$_SESSION['user_id']."','".addslash($_POST['comments'])."')");

							echo"<tr><td align='center' colspan='4'><img src='".IMAGES."ajax-loader.gif'/></td></tr>";
							return_form(5,'newsext.php?id='.$newsid);
						}
					else 
						{
							echo"<form method='post'>";
							echo"<tr><td align='center' colspan='4'><textarea name='comments'></textarea></td></tr>";
							echo"<tr><td align='center' colspan='4'><input type='submit' class='button' value='".$txt['forum_quick_reply']."'/></td></tr></form>";
						}
				}
			closetable();
		}

	require_once THEMES."templates/footer.php";
?>