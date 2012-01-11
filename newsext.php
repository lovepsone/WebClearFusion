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

	if (isset($_GET['id']))
		{
			$newsid = addslashes($_GET["id"]);

			selectdb(wcf);
  			$result = db_query("SELECT * FROM ".DB_NEWS." 
						LEFT JOIN ".DB_NEWS_CATS." ON `news_cat_id`=`news_cats`
						LEFT JOIN ".DB_USERS." ON ".DB_USERS.".`user_id`=".DB_NEWS.".`news_author`
						WHERE `news_id`='".$newsid."' limit 1");

  			if (db_num_rows($result) != 0 )
				{
					$data = db_aassoc($result);
					opentable();
          				echo"<tr><td align='left' colspan='3' class='head-table'>&nbsp;".$data['news_title']."</td></tr>";
          				echo"<tr><td align='left' width='80'><img src='".IMAGES_NC.$data['news_cat_image']."' align='absmiddle'>&nbsp;</td><td>&nbsp&nbsp;</td>";
					echo"<td align='top'>".stripslashes($data['news_text_main'])."</td><td>&nbsp;&nbsp;</td></tr>";
          				echo"<tr><td colspan='4' align='left'>&nbsp;".$txt['modul_news_creation_date']."&nbsp;".$data['news_date']."&nbsp;".$txt['modul_news_author']."
						&nbsp;".ucfirst(strtolower($data['user_name']))."&nbsp;<br><hr></td></tr>";

					$result = mysql_query("SELECT * FROM `wcf_comments` WHERE `comment_item_id`='".$newsid."' AND `comment_type`='1'") or trigger_error(mysql_error());

					while ($data = db_array($result))
						{
					  		$result_user = mysql_query("SELECT * FROM ".DB_USERS." WHERE `user_id`='".$data['user_id']."' LIMIT 1");
  							$data_user = db_aassoc($result_user);

							echo"<tr><td colspan='2' align='left' class='tbl2'>".ucfirst(strtolower($data_user['user_name']))."<br>";

							if ($usr['user_avatar'] <> '')
								{
			  						echo"<img src='".IMAGES_A.$data_user['user_avatar']."'/></td>";
								}
							else
								{
									echo"<img src='".IMAGES_A."null-avatar.gif' class='avatar'></td>";
								}
							echo"<td colspan='2' align='left' class='tbl1'>".stripslashes($data['comment_message'])."</td></tr><tr>";
							echo"<td colspan='4'>&nbsp;".$txt['modul_newsexp_date_reply']."&nbsp;".$data['comment_date']."<br><hr></td></tr>";
						}

					//=========================
					// форма отправки коментария
					if (isset($_SESSION['user_id']) or ($_SESSION['ip'] == $_SERVER['REMOTE_ADDR']))
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
					else if (!isset($_SESSION['user_id']) or ($_SESSION['ip'] != $_SERVER['REMOTE_ADDR']))
						{ 
							echo"<tr><td align='center' colspan='3'><h2>".$txt['forum_log']."</h2></td></tr>";
						}
					closetable();
   				}
		}

	require_once THEMES."templates/footer.php";
?>