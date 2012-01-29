<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2012 lovepsone
+--------------------------------------------------------+
| Filename: news.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	require_once "../maincore.php";
	require_once THEMES."templates/admin_header.php";
   	require_once INCLUDES."tinymce.php";
   	echo $advanced_script;

	if (isset($_POST['save']) && (!isset($_GET['action']) && $_GET['action'] != "edit"))
		{
			$news_visibility = isnum($_POST['news_visibility']) ? $_POST['news_visibility'] : "-1";
			$news_show_cat = isset($_POST['news_show_cat']) ? "1" : "0";
			$news_comments = isset($_POST['news_comments']) ? "1" : "0";

			if ((isset($_POST['news_subject']) && $_POST['news_subject'] != "") AND (isset($_POST['news_text']) && $_POST['news_text'] != "") AND (isset($_POST['news_text_ext']) && $_POST['news_text_ext'] != ""))
				{
					selectdb(wcf);
					$result = db_query("INSERT INTO ".DB_NEWS." (`news_author`,`news_subject`,`news_show_cat`,`news_cat`,`news_text`,`news_text_extended`,`news_visibility`,`news_allow_comments`)
						values ('".$_SESSION['user_id']."','".stripinput($_POST['news_subject'])."','".$news_show_cat."','".$_POST['news_cat']."','".addslash($_POST['news_text'])."','".addslash($_POST['news_text_ext'])."','".$news_visibility."','".$news_comments."')");
					if ($result) {redirect(WCF_SELF);}
				}
			else
				{
					$errors = 1;
					redirect(WCF_SELF."?errors=".$errors);
				}
		}
	elseif (isset($_POST['save']) && (isset($_GET['action']) && $_GET['action'] == "edit") && (isset($_POST['news_id']) && isnum($_POST['news_id'])))
		{
			$news_visibility = isnum($_POST['news_visibility']) ? $_POST['news_visibility'] : "-1";
			$news_show_cat = isset($_POST['news_show_cat']) ? "1" : "0";
			$news_comments = isset($_POST['news_comments']) ? "1" : "0";

			if ((isset($_POST['news_subject']) && $_POST['news_subject'] != "") AND (isset($_POST['news_text']) && $_POST['news_text'] != "") AND (isset($_POST['news_text_ext']) && $_POST['news_text_ext'] != ""))
				{
					selectdb(wcf);
					$result = db_query("UPDATE ".DB_NEWS." SET `news_author`='".$_SESSION['user_id']."', `news_subject`='".stripinput($_POST['news_subject'])."', `news_show_cat`='".$news_show_cat."', `news_cat`='".$_POST['news_cat']."',
								`news_text`='".addslash($_POST['news_text'])."', `news_text_extended`='".addslash($_POST['news_text_ext'])."', `news_visibility`='".$news_visibility."', `news_allow_comments`='".$news_comments."' WHERE `news_id`='".$_POST['news_id']."'");
		
					if ($result) {redirect(WCF_SELF);}
				}
			else
				{
					$errors = 1;
					redirect(WCF_SELF."?errors=".$errors);
				}
		}
	elseif (isset($_POST['delete']) && (isset($_POST['news_id']) && isnum($_POST['news_id'])))
		{
			selectdb(wcf);
			$result = db_query("DELETE FROM ".DB_NEWS." WHERE `news_id`='".$_POST['news_id']."'");
			$result = db_query("DELETE FROM ".DB_COMMENTS."  WHERE `comment_item_id`='".$_POST['news_id']."' and `comment_type`='1'");
			redirect(WCF_SELF."?status=del");
			redirect(WCF_SELF);
		}
	elseif (!isset($_POST['save']) && (!isset($_GET['action']) && $_GET['action'] != "edit"))
		{
			$news_id = "";
			$news_subject = "";
			$news_cat = "";
			$news_text = "";
			$news_text_ext = "";
			$news_visibility = "";
			$news_comments = " checked='checked'";
			$news_show_cat = " checked='checked'";
			$txt_button = $txt['admin_newsmaker_add'];
		}

	selectdb(wcf);
	$result = db_query("SELECT * FROM ".DB_NEWS);

	if (db_num_rows($result) != 0)
		{
			$editlist = "";
			while ($data = db_array($result))
				{
					$editlist .= "<option value='".$data['news_id']."'>".$data['news_subject']."</option>";
				}
			//=======================================
			// 1-ая форма
			opentable();
			echo"<div style='text-align:center'><form name='selectform' method='post' action='".WCF_SELF."?action=edit'>";
			echo"<h1>".$txt['admin_newsmaker']."</h1>";
			echo"<select name='news_id' class='textbox' style='width:450px'>".$editlist."</select>";
			echo"<input type='submit' name='edit' value='".$txt['admin_newsmaker_edit']."' class='button' />";
			echo"<input type='submit' name='delete' value='".$txt['admin_newsmaker_del']."' onclick='return DeleteNews();' class='button' />";
			echo"<br><hr></form></div>";
			closetable();
		}

	if ((isset($_GET['action']) && $_GET['action'] == "edit") && (isset($_POST['news_id']) && isnum($_POST['news_id'])) || (isset($_GET['news_id']) && isnum($_GET['news_id'])))
		{
			$result1 = db_query("SELECT * FROM ".DB_NEWS." WHERE `news_id`='".(isset($_POST['news_id']) ? $_POST['news_id'] : $_GET['news_id'])."' LIMIT 1");
			if (db_num_rows($result1))
				{
					$data1 = db_assoc($result1);
					$news_id = $data1['news_id'];
					$news_subject = $data1['news_subject'];
					$news_cat = $data1['news_cat'];
					$news_text = $data1['news_text'];
					$news_text_ext = $data1['news_text_extended'];
					$news_visibility = $data1['news_visibility'];
					$news_comments = $data1['news_allow_comments'] == "1" ? " checked='checked'" : "";
					$news_show_cat = $data1['news_show_cat'] == "1" ? " checked='checked'" : "";
					$txt_button = $txt['admin_newsmaker_edit'];
				}
			else
				{
					redirect(WCF_SELF);
				}
		}
	if ($errors == 1 AND isset($_GET['errors']))
		{
			opentable();
		       	echo"<tr><td align='center' class='small'><h3>".$txt['admin_newsmaker_not_fields']."</h3></td></tr>";
			closetable();
			return_form(30,WCF_SELF);
		}
	else
		{
			$result = db_query("SELECT * FROM ".DB_NEWS_CATS."");
			$news_cat_list = "";
			while ($data = db_array($result))
				{
	  				$news_cat_list .= "<option value=".$data['news_cat_id'].">".$data['news_cat_name']."</option>";
				}
			//=======================================
			// 2-ая форма
			opentable();
		       	echo"<form method='post'>";
		       	echo"<tr><td align='right' width='20%' class='small'>".$txt['admin_newsmaker_teme']."</td>";
			echo"<td align='left' width='80%'><input type='text' name='news_subject' class='textbox' value='".$news_subject."' size='60'></td></tr>";
			echo"<tr><td align='right' width='20%' class='small'>".$txt['admin_newsmaker_cat']."<input name='news_id' class='textbox' value='".$news_id."' type=hidden></td>";
		        echo"<td align='left' width='80%'><select name=news_cat class='textbox'>".$news_cat_list."</select></td></tr>";
			echo"<tr><td align='right' width='20%' class='small'>".$txt['admin_newsmaker_show_img_cat']."</td>";
		       	echo"<td align='left' width='80%'><input type='checkbox' name='news_show_cat' value='yes'".$news_show_cat." /></td></tr>";
			echo"<tr><td align='right' width='20%' class='small'>".$txt['admin_newsmaker_comments']."</td>";
		       	echo"<td align='left' width='80%'><input type='checkbox' name='news_comments' value='yes'".$news_comments." /></td></tr>";
			echo"<tr><td align='right' width='20%' class='small'>".$txt['admin_newsmaker_access']."</td>";
		       	echo"<td align='left' width='80%'><select name='news_visibility' class='textbox' style='width:250px'>".access($news_visibility)."</select></td></tr>";
			echo"<tr><td align='right' width='20%' class='small'>".$txt['admin_newsmaker_newsflash']."</td>";
		       	echo"<td align='left' width='80%'><textarea name='news_text'>".$news_text."</textarea></td></tr>";
			echo"<tr><td colspan='2'><hr></td></tr>";
			echo"<tr><td align='right' width='20%' class='small'>".$txt['admin_newsmaker_newsfull']."</td>";
		       	echo"<td align='left' width='80%'><textarea name='news_text_ext'>".$news_text_ext."</textarea></td></tr>";
		       	echo"<tr><td align='center' colspan='2' class='small'><input type='submit' name='save'  class='button' value='".$txt_button."'/></td></tr>";
			echo"</form>";
			closetable();
		}

	echo"<script type='text/javascript'>"."function DeleteNews() { return confirm('".$txt['admin_newsmaker_title']."'); }</script>";

	require_once THEMES."templates/footer.php";
?>