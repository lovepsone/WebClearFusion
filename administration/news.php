<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: news_add.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	//===============================================
	// Основная форма
	$kol = 1;


	selectdb(wcf);
	$n_cres = mysql_query("SELECT count(`news_date`) as kol FROM ".DB_NEWS." ") or trigger_error(mysql_error());
	$n_kolzap = mysql_fetch_array($n_cres);

	if ($n_kolzap['kol'] > $config['page_news_edit'])
		{
    			$page_len_n = $config['page_news_edit']; 
    			if (!isset($_GET['page']) or ($_GET['page'] == '')) $start_rec_n = 0;
			else $start_rec_n = ((int)$_GET['page']-1)*$config['page_news_edit'];
		}
	else
		{
    			$page_len_n = $config['page_news_edit'];
			$start_rec_n = 0;
		}

	$kres = mysql_query("SELECT * FROM ".DB_NEWS." ORDER BY `news_date` DESC limit $start_rec_n,$page_len_n") or trigger_error(mysql_error());

	echo"<form method='post'>";
	opentable();
	echo"<div align='center'><h1>".$txt['admin_newsmaker']."</h1></div><hr>";

	if (mysql_num_rows($kres) > 0 )
		{
   			while ($nres = mysql_fetch_array($kres))
				{
          				echo"<tr><td align='left' class='page'><input name=id type=radio value='".$nres['news_id']."'></td>";
          				echo"<td align='left' class='page'>".$nres['news_title']."</td>";
          				echo"<td align='right' class='page'>".$nres['news_date']."</td></tr>";
          				$kol++;
          			}

    			if ($n_kolzap['kol'] > $config['page_news_edit'])
				{
       					$pages_selector = '-';
       					$page_counter_n = ceil($n_kolzap['kol'] / $config['page_news_edit']);

       					if (!isset($_GET['page']) OR ($_GET['page'] == '') OR ($_GET['page'] == '_')) $tp3 = 1;
					else $tp3 = (int)$_GET['page'];

       					for ($i = 1; $i <= $page_counter_n; $i++)
						{
           						if ($tp3 == $i) $pages_selector .= ' '.$i.' -';
		   					else $pages_selector .= ' <A href="index.php?modul=newsedit&page='.$i.'">'.$i.'</a> -';
           					}
      					echo"<tr><td colspan='3' align='center' valign='middle'><b>$pages_selector</b></td></tr>";
     				}
    		}

	if ($kol > 1)
		{
			echo"<font color='red'>".$txt['admin_newsmaker_title']."</font><br>";
			echo"<br><table width='100%' height='30' border='0' cellpadding='0' cellspacing='0'><tr><td align='center'><b>".$txt['admin_newsmaker_team']."</b>&nbsp;&nbsp;";
				echo"<select name=cmd class='textbox'><option value=1 selected>".$txt['admin_newsmaker_edit']."</option><option value=2>".$txt['admin_newsmaker_add']."</option>";
		}
	else echo "<option value=2 selected>".$txt['admin_newsmaker_add']."</option>";

	echo"<option value=3>".$txt['admin_newsmaker_del']."</option></select></td>";
	echo"<td align='center'><input action='index.php' name='modul' value='newsedit' type=hidden><input type='submit' class='button' value='".$txt['Run']."'></td></tr><hr>";
	closetable();
	echo"</form>";
	//===============================================
	// Доп. форма
	$query = mysql_query("SELECT * FROM ".DB_NEWS_CATS."") or trigger_error(mysql_error());
	$editlist = "";
	while ($news_cats = mysql_fetch_array($query))
		{
	  		$news_cats_list .= "<option value=".$news_cats['news_cat_id'].">".$news_cats['news_cat_name']."</option>";
		}
	//===============================================
	if (isset($_POST['cmd']))
		{
   			require "include/tinymce.php";
   			echo $advanced_script;
			//===============================================
			// Редактирование
     			if (isset($_POST['id']) AND ($_POST['cmd'] == 1) AND ($_POST['id'] > 0))
				{
       					$nres = mysql_query("SELECT * FROM ".DB_NEWS." WHERE `news_id` = ".$_POST['id'].' limit 1') or trigger_error(mysql_error());
	   				$nr = mysql_fetch_assoc($nres);

       					echo"<br><form method='post'>";
					opentable();

             				echo"<tr><td align='left' valign='middle'>".$txt['admin_teme_news']."&nbsp;&nbsp;";
					echo"<input name='modul' value='newsedit' type=hidden><input type='text' name='tema_edit' class='textbox' value='".$nr['news_title']."' size='40'></td>";

        				echo"<tr><td align='left' valign='middle'>".$txt['admin_category_news']."&nbsp;&nbsp;";
					echo"<input name='cmd' value='edit' type=hidden><input name='guid' class='textbox' value='".$nr['news_id']."' type=hidden>";

        				echo"<select name=catedit class='textbox'>$news_cats_list</select>";
					echo"</td></tr>";

					echo"<tr><td><hr>".$txt['admin_newsmaker_newsflash']."</td></tr>";
       					echo"<tr><td><textarea name='news_edit'>".$nr['news_text']."</textarea></td></tr>";
					echo"<tr><td><hr>".$txt['admin_newsmaker_newsfull']."</td></tr>";
       					echo"<tr><td><textarea name='news_edit_main'>".$nr['news_text_main']."</textarea></td></tr>";
       					echo"<tr><td align='center'><br><input type='submit' class='button' value='$txt[menu_admin_news_edit]'/></td></tr>";
					closetable();
					echo"</form>";
      				}
   			if ($_POST['cmd'] == edit AND $_POST['tema_edit'] <> '' AND $_POST['news_edit'] <> '' AND $_POST['news_edit_main'] <> '')
				{
					opentable();
					echo"<tr><td align='center'><img src='".IMAGES."ajax-loader.gif'/></td></tr>";
					$nt = addslashes($_POST['tema_edit']);
					$query = mysql_query("UPDATE ".DB_NEWS." SET `news_title`='".$nt."',`news_text`='".addslash($_POST['news_edit'])."',`news_text_main`='".addslash($_POST['news_edit_main'])."',`news_cats`='".(int)$_POST['catedit']."' WHERE `news_id`='".(int)$_POST['guid']."'") or trigger_error(mysql_error()); 

					if ($query)
						{
							echo"<script type='text/javascript'><!-- window.status = ''; window.location = 'index.php?modul=newsedit';//--> </script>";
							return_form(10,'?modul=newsedit');
						}
					else echo"<tr><td align='center'>".$txt['errors']."</td></tr>";
					closetable();
       				}
			else if($_POST['cmd'] == edit AND $_POST['tema_edit'] == '' OR $_POST['cmd'] == edit AND $_POST['news_edit'] == ''OR $_POST['cmd'] == edit AND $_POST['news_edit_main'] == '') echo $txt['admin_news_not_all_fields'];
			//===============================================
			// Добавление
    			if ($_POST['cmd'] == 2)
				{
					echo"<form method='post'>";
					opentable();

        				echo"<tr><td align='left' valign='middle'>".$txt['admin_teme_news']."&nbsp;";
        				echo"<input name='modul' value='newsedit' type=hidden><input type='text' class='textbox' name='tema_add' size='40'></td></tr>";

        				echo"<tr><td align='left' valign='middle'>".$txt['admin_category_news']."&nbsp;";
        				echo"<input name='cmd' value='newsadd' type=hidden>";

        				echo"<select name=catadd class='textbox'>$news_cats_list</select>";
					echo"</td></tr>";

					echo"<tr><td><hr>".$txt['admin_newsmaker_newsflash']."</td></tr>";
					echo"<tr><td><textarea name='news_add'></textarea></td></tr>";
					echo"<tr><td><hr>".$txt['admin_newsmaker_newsfull']."</td></tr>";
					echo"<tr><td><textarea name='news_add_main'></textarea></td></tr>";
					echo"<tr><td align='center'><br><input type='submit' class='button' value='".$txt['menu_admin_news_add']."'/></td></tr>";
					closetable();
					echo"</form>";
				}
			if ($_POST['cmd'] == newsadd AND $_POST['tema_add'] <> '' AND $_POST['news_add'] <> '' AND $_POST['news_add_main'] <> '')
				{
					opentable();
					echo"<tr><td align='center'><img src='".IMAGES."ajax-loader.gif'/></td></tr>";
					$nt = addslashes($_POST['tema_add']);
					$query = mysql_query("INSERT INTO ".DB_NEWS." (`news_title`,`news_text`,`news_text_main`,`news_cats`) values ('".$nt."','".addslash($_POST['news_add'])."','".addslash($_POST['news_add_main'])."','".(int)$_POST['catadd']."')") or trigger_error(mysql_error());

					if ($query)
						{
							echo"<script type='text/javascript'> <!-- window.status = ''; window.location = 'index.php?modul=newsedit';//--> </script>";
							return_form(10,'?modul=newsedit');
						}
					else echo"<tr><td align='center'>".$txt['errors']."</td></tr>";
					closetable();
				}
			else if($_POST['cmd'] == newsadd AND $_POST['tema_add'] == '' OR $_POST['cmd'] == newsad AND $_POST['news_add'] == ''OR $_POST['cmd'] == newsad AND $_POST['news_add_main'] == '') echo $txt['admin_news_not_all_fields'];
			//===============================================
			// Удаление
    			if (isset($_POST['id']) AND ($_POST['cmd'] == 3) AND ($_POST['id'] > 0))
				{
					opentable();
					echo"<tr><td align='center'><img src='".IMAGES."ajax-loader.gif'/></td></tr>";
					$query = mysql_query("DELETE FROM ".DB_NEWS." WHERE `news_id` = '".(int)$_POST['id']."'") or trigger_error(mysql_error());

					if ($query)
						{
							echo"<script type='text/javascript'> <!-- window.status = ''; window.location = 'index.php?modul=newsedit';//--> </script>";
							return_form(10,'?modul=newsedit');
						}
					else echo"<tr><td align='center'>".$txt['errors']."</td></tr>";
					closetable();
				}
		}
?>