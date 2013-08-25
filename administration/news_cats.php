<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2013 lovepsone
+--------------------------------------------------------+
| Filename: news_cats.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	require_once "../maincore.php";
	require_once THEMES."templates/admin_header.php";

	if ((isset($_GET['action']) && $_GET['action'] == "delete") && (isset($_GET['cat_id']) && isnum($_GET['cat_id'])))
		{
			selectdb("wcf");
			$result = db_query("DELETE FROM ".DB_NEWS_CATS." WHERE `news_cat_id`='".$_GET['cat_id']."'");
			redirect(WCF_SELF."?status=dy");
		}
	elseif (isset($_POST['save_news_cat']))
		{
			$news_cat_name = stripinput($_POST['news_cat_name']);
			$news_cat_image = stripinput($_POST['news_cat_image']);

			if ($news_cat_name && $news_cat_image)
				{
					if ((isset($_GET['action']) && $_GET['action'] == "edit") && (isset($_GET['cat_id']) && isnum($_GET['cat_id'])))
						{
							selectdb("wcf");
							$result = db_query("UPDATE ".DB_NEWS_CATS." SET `news_cat_name`='$news_cat_name', `news_cat_image`='$news_cat_image' WHERE `news_cat_id`='".$_GET['cat_id']."'");
							redirect(WCF_SELF."?status=su");
						}
					else
						{
							selectdb("wcf");
							$result = db_query("INSERT INTO ".DB_NEWS_CATS." (`news_cat_name`, `news_cat_image`) VALUES ('".$news_cat_name."', '".$news_cat_image."')");
							redirect(WCF_SELF."?status=sn");
						}
				} 
		}
	elseif ((isset($_GET['action']) && $_GET['action'] == "edit")  && (isset($_GET['cat_id']) && isnum($_GET['cat_id'])))
		{
			selectdb("wcf");
			$result = db_query("SELECT * FROM ".DB_NEWS_CATS." WHERE `news_cat_id`='".$_GET['cat_id']."'");
			if (db_num_rows($result))
				{
					$data = db_assoc($result);
					$news_cat_name = $data['news_cat_name'];
					$news_cat_image = $data['news_cat_image'];
					WCF::$locale_page = WCF::$locale['admin_newscat_edit_n'];
				}
			else
				{
					redirect(WCF_SELF);
				}
		}
	else
		{
			$news_cat_name = "";
			$news_cat_image = "";
			WCF::$locale_page = WCF::$locale['admin_newscat_add_n'];
		}


	//============================================================
	// 1-ая форма
	$image_files = makefilelist(IMAGES_NC, ".|..|index.php", true);
	$image_list = makefileopts($image_files,$news_cat_image);

	opentable();
	echo"<form method='post'>";
	echo"<tr><td align='center' colspan='2' class='small'>".WCF::$locale_page."</td></tr>";
	echo"<tr><td width='50%' align='right' class='small2'>".WCF::$locale['admin_newscat_name']."</td>";
	echo"<td width='50%' align='left'><input type='text' name='news_cat_name' value='".$news_cat_name."' class='textbox' style='width:200px;' /></td></tr>";
	echo"<tr><td width='50%' align='right' class='small2'>".WCF::$locale['admin_newscat_picture']."</td>";
	echo"<td width='50%' align='left'><select name='news_cat_image' class='textbox' style='width:200px;'>".$image_list."</select></td></tr>";
	echo"<tr><td align='center' colspan='2'><br/><input type='submit' name='save_news_cat' value='".WCF::$locale['admin_newscat_save']."' class='button' /></td></tr>";
	echo"</form>";
	closetable();

	//============================================================
	// 2-ая форма
	opentable();
	selectdb("wcf");
	$result = db_query("SELECT * FROM ".DB_NEWS_CATS." ORDER BY `news_cat_name`");
	$rows = db_num_rows($result);

	if ($rows != 0)
		{
			$counter = 0; $columns = 6;
			echo"<tr>";

			while ($data = db_array($result))
				{
					if ($counter != 0 && ($counter % $columns == 0)) echo "</tr>\n<tr>\n";

					echo"<td align='center' width='15%' class='small'><strong>".$data['news_cat_name']."</strong><br/><br/>";
					echo"<img src='".IMAGES_NC.$data['news_cat_image']."' /><br /><br/>";
					echo"<span class='small2'><a href='".WCF_SELF."?action=edit&cat_id=".$data['news_cat_id']."'>".WCF::$locale['admin_newscat_edit']."</a> -\n";
					echo"<a href='".WCF_SELF."?action=delete&cat_id=".$data['news_cat_id']."' onclick=\"return confirm('".WCF::$locale['admin_newscat_del_y']."');\">".WCF::$locale['admin_newscat_del']."</a></span></td>";
					$counter++;
				}
			echo"</tr>";
		}
	else
		{
			echo"<div style='text-align:center'><br/>".WCF::$locale['admin_newscat_no_cat']."<br/><br/></div>";
		}
			// нужен новый скрипт, даработка нужна
			echo"<div style='text-align:center'><br/><a href='".WCF_SELF."'>".WCF::$locale['admin_newscat_link_load_img']."</a><br/><br/></div>";
	closetable();

	require_once THEMES."templates/footer.php";
?>