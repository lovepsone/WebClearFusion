<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: news_cats.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	require_once "../maincore.php";
	require_once THEMES."templates/header.php";

	selectdb(wcf);
/*
	if ((isset($_GET['action']) && $_GET['action'] == "delete") && (isset($_GET['cat_id']) && isnum($_GET['cat_id']))) {
	$result = dbcount("(news_cat_id)", DB_NEWS, "news_cat='".$_GET['cat_id']."'");
	if (!empty($result)) {
		redirect(FUSION_SELF.$aidlink."&status=dn");
	} else {
		$result = dbquery("DELETE FROM ".DB_NEWS_CATS." WHERE news_cat_id='".$_GET['cat_id']."'");
		redirect(FUSION_SELF.$aidlink."&status=dy");
	}
} else*/
	if (isset($_POST['save_news_cat']))
		{
			$news_cat_name = stripinput($_POST['news_cat_name']);
			$cat_image = stripinput($_POST['cat_image']);

			if ($cat_name && $cat_image)
				{
					if ((isset($_GET['action']) && $_GET['action'] == "edit") && (isset($_GET['cat_id']) && isnum($_GET['cat_id'])))
						{
							$result = mysql_query("UPDATE ".DB_NEWS_CATS." SET news_cat_name='$cat_name', news_cat_image='$cat_image' WHERE news_cat_id='".$_GET['cat_id']."'");
						}
					else
						{
							$result = mysql_query("INSERT INTO ".DB_NEWS_CATS." (news_cat_name, news_cat_image) VALUES ('$cat_name', '$cat_image')");
						}
				} 
		}

/*
elseif ((isset($_GET['action']) && $_GET['action'] == "edit") && (isset($_GET['cat_id']) && isnum($_GET['cat_id']))) {
	$result = dbquery("SELECT news_cat_id, news_cat_name, news_cat_image FROM ".DB_NEWS_CATS." WHERE news_cat_id='".$_GET['cat_id']."'");
	if (dbrows($result)) {
		$data = dbarray($result);
		$cat_name = $data['news_cat_name'];
		$cat_image = $data['news_cat_image'];
		$formaction = FUSION_SELF.$aidlink."&amp;action=edit&amp;cat_id=".$data['news_cat_id'];
		opentable($locale['400']);
	} else {
		redirect(FUSION_SELF.$aidlink);
	}
} else {
	$cat_name = "";
	$cat_image = "";
	$formaction = FUSION_SELF.$aidlink;
}
*/

	//============================================================
	// 1-ая форма
	$image_files = makefilelist(IMAGES_NC, ".|..|index.php", true);
	$image_list = makefileopts($image_files,$cat_image);

	opentable();
	echo"<tr><td align='center' colspan='2' class='small'>".$locale['430']."</td></tr>";
	echo"<tr><td width='50%' align='right' class='small2'>".$txt['admin_newscat_name']."</td>";
	echo"<td width='50%' align='left'><input type='text' name='news_cat_name' value='".$news_cat_name."' class='textbox' style='width:200px;' /></td></tr>";

	echo"<tr><td width='130' class='tbl'>".$locale['431']."</td>";
	echo"<td class='tbl'><select name='cat_image' class='textbox' style='width:200px;'>".$image_list."</select></td></tr>";

	echo"<tr><td align='center' colspan='2' class='tbl'><br/><input type='submit' name='save_news_cat' value='".$locale['432']."' class='button' /></td></tr>";
	closetable();

	//============================================================
	// 2-ая форма
	opentable();
	selectdb(wcf);
	$result = mysql_query("SELECT * FROM ".DB_NEWS_CATS." ORDER BY `news_cat_name`");
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
					echo"<span class='small2'><a href='".FUSION_SELF.$aidlink."&amp;action=edit&amp;cat_id=".$data['news_cat_id']."'>".$txt['admin_newscat_edit']."</a> -\n";
					echo"<a href='".FUSION_SELF.$aidlink."&amp;action=delete&amp;cat_id=".$data['news_cat_id']."' onclick=\"return confirm('".$txt['admin_newscat_del_y']."');\">".$txt['admin_newscat_del']."</a></span></td>";
					$counter++;
				}
			echo"</tr>";
		}
	else
		{
	echo "<div style='text-align:center'><br/>".$locale['435']."<br/><br/></div>\n";
		}
			echo "<div style='text-align:center'><br />\n<a href='".ADMIN."images.php".$aidlink."&amp;ifolder=imagesnc'>".$locale['436']."</a><br /><br />\n</div>\n";
	closetable();
	require_once THEMES."templates/footer.php";
?>