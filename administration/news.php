<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2013 lovepsone
+--------------------------------------------------------+
| Filename: news.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	require_once "../maincore.php";
	require_once THEMES."templates/admin_header.php";

	if (isset($_POST['save']))
	{
		if (!isset($_GET['action']) && $_GET['action'] != "edit")
		{
			$news_visibility = WCF::isnum($_POST['news_visibility']) ? $_POST['news_visibility'] : "-1";
			$news_show_cat = isset($_POST['news_show_cat']) ? "1" : "0";
			$news_comments = isset($_POST['news_comments']) ? "1" : "0";
		
			if ((isset($_POST['news_subject']) && $_POST['news_subject'] != "") && (isset($_POST['news_text']) && $_POST['news_text'] != "") && (isset($_POST['news_text_ext']) && $_POST['news_text_ext'] != ""))
			{
				WCF::$DB->query('INSERT INTO ?_news (`news_author`,`news_subject`,`news_show_cat`,`news_cat`,`news_text`,`news_text_extended`,`news_visibility`,`news_allow_comments`) VALUES ( ?d, ?, ?d, ?d, ?, ?, ?d, ?d)', $_SESSION['user_id'], WCF::$TF->stripinput($_POST['news_subject']), $news_show_cat, $_POST['news_cat'], $_POST['news_text'], $_POST['news_text_ext'], $news_visibility, $news_comments);
				WCF::redirect(WCF_SELF);
			}
			else
			{
				$errors = 1;
				WCF::redirect(WCF_SELF."?errors=".$errors);
			}
		}
		elseif (isset($_POST['save']) && (isset($_GET['action']) && $_GET['action'] == "edit") && (isset($_POST['news_id']) && WCF::isnum($_POST['news_id'])))
		{
			$news_visibility = WCF::isnum($_POST['news_visibility']) ? $_POST['news_visibility'] : "-1";
			$news_show_cat = isset($_POST['news_show_cat']) ? "1" : "0";
			$news_comments = isset($_POST['news_comments']) ? "1" : "0";
		
			if ((isset($_POST['news_subject']) && $_POST['news_subject'] != "") && (isset($_POST['news_text']) && $_POST['news_text'] != "") && (isset($_POST['news_text_ext']) && $_POST['news_text_ext'] != ""))
			{		
				WCF::$DB->query('UPDATE ?_news SET `news_author`= ?d, `news_subject`= ?, `news_show_cat`= ?d, `news_cat`= ?d, `news_text`= ?, `news_text_extended`= ?, `news_visibility`= ?d, `news_allow_comments`= ?d WHERE `news_id`= ?d', $_SESSION['user_id'], WCF::$TF->stripinput($_POST['news_subject']), $news_show_cat, $_POST['news_cat'], $_POST['news_text'], $_POST['news_text_ext'], $news_visibility, $news_comments, $_POST['news_id']);
				WCF::redirect(WCF_SELF);
			}
			else
			{
				$errors = 1;
				WCF::redirect(WCF_SELF."?errors=".$errors);
			}
		}
	}
	elseif (isset($_POST['delete']) && (isset($_POST['news_id']) && WCF::isnum($_POST['news_id'])))
	{
		WCF::$DB->query('DELETE FROM ?_news WHERE `news_id`= ?d', $_POST['news_id']);
		WCF::$DB->query('DELETE FROM ?_comments  WHERE `comment_item_id`= ?d and `comment_type`=1', $_POST['news_id']);
		WCF::redirect(WCF_SELF."?status=del");
		WCF::redirect(WCF_SELF);
	}
	else
	{
		$news_id = "";
		$news_subject = "";
		$news_cat = "";
		$news_text = "";
		$news_text_ext = "";
		$news_visibility = "";
		$news_comments = " checked='checked'";
		$news_show_cat = " checked='checked'";
		$txt_button = WCF::$locale['admin_newsmaker_add'];
	}

	
	$rows = WCF::$DB->select(' -- CACHE: 180
			SELECT * FROM ?_news');

	if ($rows != null)
	{
		$editlist = "";
		foreach ($rows as $numRow => $data)
		{
			$editlist .= "<option value='".$data['news_id']."'>".$data['news_subject']."</option>";
		}

		opentable();
		echo"<div style='text-align:center'><form name='selectform' method='post' action='".WCF_SELF."?action=edit'>";
		echo"<h1>".WCF::$locale['admin_newsmaker']."</h1>";
		echo"<select name='news_id' class='textbox' style='width:450px'>".$editlist."</select>";
		echo"<input type='submit' name='edit' value='".WCF::$locale['admin_newsmaker_edit']."' class='button' />";
		echo"<input type='submit' name='delete' value='".WCF::$locale['admin_newsmaker_del']."' onclick='return DeleteNews();' class='button' />";
		echo"<br><hr></form></div>";
		closetable();
	}

	if ((isset($_GET['action']) && $_GET['action'] == "edit") && (isset($_POST['news_id']) && WCF::isnum($_POST['news_id'])) || (isset($_GET['news_id']) && WCF::isnum($_GET['news_id'])))
	{
		$data1 = WCF::$DB->selectRow(' -- CACHE: 180
			SELECT * FROM ?_news WHERE `news_id`= ?d LIMIT 1', (isset($_POST['news_id']) ? $_POST['news_id'] : $_GET['news_id']));
		if ($data1 != null)
		{
			$news_id = $data1['news_id'];
			$news_subject = $data1['news_subject'];
			$news_cat = $data1['news_cat'];
			$news_text = $data1['news_text'];
			$news_text_ext = $data1['news_text_extended'];
			$news_visibility = $data1['news_visibility'];
			$news_comments = $data1['news_allow_comments'] == "1" ? " checked='checked'" : "";
			$news_show_cat = $data1['news_show_cat'] == "1" ? " checked='checked'" : "";
			$txt_button = WCF::$locale['admin_newsmaker_edit'];
		}
		else
		{
			WCF::redirect(WCF_SELF);
		}
	}
	if (isset($_GET['errors']) && WCF::isnum($_GET['errors']))
	{
		opentable();
		echo"<tr><td align='center' class='small'><h3>".WCF::$locale['admin_newsmaker_not_fields']."</h3></td></tr>";
		closetable();
		WCF::ReturnForm(30, WCF_SELF);
	}
	else
	{
		$rows = WCF::$DB->select(' -- CACHE: 180
				SELECT * FROM ?_news_cats');
		$news_cat_list = "";
		foreach ($rows as $numRow => $data)
		{
	  		$news_cat_list .= "<option value=".$data['news_cat_id'].">".$data['news_cat_name']."</option>";
		}

		opentable();
		echo"<form method='post'>";
		echo"<tr><td align='right' width='20%' class='small'>".WCF::$locale['admin_newsmaker_teme']."</td>";
		echo"<td align='left' width='80%'><input type='text' name='news_subject' class='textbox' value='".$news_subject."' size='60'></td></tr>";
		echo"<tr><td align='right' width='20%' class='small'>".WCF::$locale['admin_newsmaker_cat']."<input name='news_id' class='textbox' value='".$news_id."' type=hidden></td>";
		echo"<td align='left' width='80%'><select name=news_cat class='textbox'>".$news_cat_list."</select></td></tr>";
		echo"<tr><td align='right' width='20%' class='small'>".WCF::$locale['admin_newsmaker_show_img_cat']."</td>";
		echo"<td align='left' width='80%'><input type='checkbox' name='news_show_cat' value='yes'".$news_show_cat." /></td></tr>";
		echo"<tr><td align='right' width='20%' class='small'>".WCF::$locale['admin_newsmaker_comments']."</td>";
		echo"<td align='left' width='80%'><input type='checkbox' name='news_comments' value='yes'".$news_comments." /></td></tr>";
		echo"<tr><td align='right' width='20%' class='small'>".WCF::$locale['admin_newsmaker_access']."</td>";
		echo"<td align='left' width='80%'><select name='news_visibility' class='textbox' style='width:250px'>".access($news_visibility)."</select></td></tr>";
		echo"<tr><td align='right' width='20%' class='small'>".WCF::$locale['admin_newsmaker_newsflash']."</td>";
		echo"<td align='left' width='80%'><textarea id='Tinymce' name='news_text'>".$news_text."</textarea></td></tr>";
		echo"<tr><td colspan='2'><hr></td></tr>";
		echo"<tr><td align='right' width='20%' class='small'>".WCF::$locale['admin_newsmaker_newsfull']."</td>";
		echo"<td align='left' width='80%'><textarea id='Tinymce' name='news_text_ext'>".$news_text_ext."</textarea></td></tr>";
		echo"<tr><td align='center' colspan='2' class='small'><input type='submit' name='save'  class='button' value='".$txt_button."'/></td></tr>";
		echo"</form>";
		closetable();
	}

	echo"<script type='text/javascript'>"."function DeleteNews() { return confirm('".WCF::$locale['admin_newsmaker_title']."'); }</script>";

	require_once THEMES."templates/footer.php";
?>