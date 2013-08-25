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
		WCF::$DB->query('DELETE FROM ?_news_cats WHERE `news_cat_id`= ?d', $_GET['cat_id']);
		WCF::redirect(WCF_SELF."?status=dy");
	}
	elseif (isset($_POST['save_news_cat']))
	{
		$news_cat_name = WCF::$TF->stripinput($_POST['news_cat_name']);
		$news_cat_image = WCF::$TF->stripinput($_POST['news_cat_image']);

		if ($news_cat_name && $news_cat_image)
		{
			if ((isset($_GET['action']) && $_GET['action'] == "edit") && (isset($_GET['cat_id']) && WCF::isnum($_GET['cat_id'])))
			{
				WCF::$DB->query('UPDATE ?_news_cats SET `news_cat_name`= ?d, `news_cat_image`= ? WHERE `news_cat_id`= ?d', $news_cat_name, $news_cat_image, $_GET['cat_id']);
				WCF::redirect(WCF_SELF."?status=su");
			}
			else
			{
				WCF::$DB->query('INSERT INTO ?_news_cats (`news_cat_name`, `news_cat_image`) VALUES (?, ?)', $news_cat_name, $news_cat_image);
				WCF::redirect(WCF_SELF."?status=sn");
			}
		} 
	}
	elseif ((isset($_GET['action']) && $_GET['action'] == "edit")  && (isset($_GET['cat_id']) && WCF::isnum($_GET['cat_id'])))
	{
		$data = WCF::$DB->selectRow('SELECT * FROM ?_news_cats WHERE `news_cat_id`= ?d', $_GET['cat_id']);
		if ($data != null)
		{
			$news_cat_name = $data['news_cat_name'];
			$news_cat_image = $data['news_cat_image'];
			$txt_page = WCF::$locale['admin_newscat_edit_n'];
		}
		else
		{
			WCF::redirect(WCF_SELF);
		}
	}
	else
	{
		$news_cat_name = "";
		$news_cat_image = "";
		$txt_page = WCF::$locale['admin_newscat_add_n'];
	}

	$image_files = makefilelist(IMAGES_NC, ".|..|index.php", true);
	$image_list = makefileopts($image_files,$news_cat_image);

	opentable();
	echo"<form method='post'>";
	echo"<tr><td align='center' colspan='2' class='small'>".$txt_page."</td></tr>";
	echo"<tr><td width='50%' align='right' class='small2'>".WCF::$locale['admin_newscat_name']."</td>";
	echo"<td width='50%' align='left'><input type='text' name='news_cat_name' value='".$news_cat_name."' class='textbox' style='width:200px;' /></td></tr>";
	echo"<tr><td width='50%' align='right' class='small2'>".WCF::$locale['admin_newscat_picture']."</td>";
	echo"<td width='50%' align='left'><select name='news_cat_image' class='textbox' style='width:200px;'>".$image_list."</select></td></tr>";
	echo"<tr><td align='center' colspan='2'><br/><input type='submit' name='save_news_cat' value='".WCF::$locale['admin_newscat_save']."' class='button' /></td></tr>";
	echo"</form>";
	closetable();

	opentable();
	$rows = WCF::$DB->select(' -- CACHE: 180
			SELECT * FROM ?_news_cats ORDER BY `news_cat_name`');

	if ($rows != null)
	{
		$counter = 0; $columns = 6;
		echo"<tr>";

		foreach ($rows as $numRow => $data)
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