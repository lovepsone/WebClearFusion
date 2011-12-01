<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: news_ext.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	$newsid = addslashes($_GET["id"]);

	if (isset($_GET['id']))
		{
			require "include/tinymce.php";
   			echo $simple_script;

			selectdb(wcf);
  			$query_news = mysql_query("SELECT * FROM ".DB_NEWS." 
						LEFT JOIN ".DB_NEWS_CATS." ON `news_cat_id`=`news_cats`
						LEFT JOIN ".DB_USERS." ON ".DB_USERS.".`user_id`=".DB_NEWS.".`news_author`
						WHERE `news_id`='".$newsid."' limit 1") or trigger_error(mysql_error());

  			if (mysql_num_rows($query_news) > 0 )
				{
					$newsexp = mysql_fetch_assoc($query_news);
					opentable();
          				echo"<tr><td align='left' colspan='3' class='head-table'>&nbsp;".$newsexp['news_title']."</td></tr>";
          				echo"<tr><td align='left' width='80'><img src='".IMAGES_NC.$newsexp['news_cat_image']."' align='absmiddle'>&nbsp;</td><td>&nbsp&nbsp;</td>";
					echo"<td align='top'>".stripslashes($newsexp['news_text_main'])."</td><td>&nbsp;&nbsp;</td></tr>";
          				echo"<tr><td colspan='4' align='left'>&nbsp;".$txt['modul_news_creation_date']."&nbsp;".$newsexp['news_date']."&nbsp;".$txt['modul_news_author']."
						&nbsp;".ucfirst(strtolower($newsexp['user_name']))."&nbsp;<br><hr></td></tr>";

					$query_com = mysql_query("SELECT * FROM `wcf_comments` WHERE `comment_item_id`='".$newsid."' AND `comment_type`='1'") or trigger_error(mysql_error());

					while ($comments =  mysql_fetch_array($query_com))
						{
					  		$query_user = mysql_query("SELECT * FROM ".DB_USERS." WHERE `user_id`='".$comments['user_id']."' LIMIT 1");
  							$com_usr = mysql_fetch_assoc($query_user);

							echo"<tr><td colspan='2' align='left' class='tbl2'>".ucfirst(strtolower($com_usr['user_name']))."<br>";

							if ($usr['user_avatar'] <> '')
								{
			  						echo"<img src='".IMAGES_A.$com_usr['user_avatar']."'/></td>";
								}
							else
								{
									echo"<img src='".IMAGES_A."null-avatar.gif' class='avatar'></td>";
								}
							echo"<td colspan='2' align='left' class='tbl1'>".stripslashes($comments['comment_message'])."</td></tr><tr>";
							echo"<td colspan='4'>&nbsp;".$txt['modul_newsexp_date_reply']."&nbsp;".$comments['comment_date']."<br><hr></td></tr>";
						}

					//=========================
					// форма отправки коментария
					if (isset($_SESSION['user_id']) or ($_SESSION['ip'] == $_SERVER['REMOTE_ADDR']))
						{
							if($_POST['comments'])
								{
									// Создаем коммент
									$p_add_post = mysql_query("INSERT INTO `wcf_comments`
												(`comment_item_id`,`comment_type`,`user_id`,`comment_message`)
												VALUES ('".$newsid."','1','".$_SESSION['user_id']."','".addslash($_POST['comments'])."')") or trigger_error(mysql_error());

									echo"<img src='".IMAGES."ajax-loader.gif'/>";
									return_form(5,'?modul=newsext&id='.$newsid);
								}
							else 
								{
									echo"<form method='post'>";
									echo"<tr><td align='center' colspan='4'><textarea name='comments'></textarea></td></tr>";
									echo"<tr><td align='center' colspan='4'><input type='submit' class='button' value='".$txt['forum_quick_reply']."'/></td></tr></form>";
								}
						}
					else if (!isset($_SESSION['user_id']) or ($_SESSION['ip'] != $_SERVER['REMOTE_ADDR']))
						{ 
							echo"<tr><td align='center' colspan='2'>".$txt['forum_log']."</td></tr>";
						}
					closetable();
   				}
		}
?>