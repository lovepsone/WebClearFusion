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
	require_once THEMES."templates/header.php";
   	require_once INCLUDES."tinymce.php";

   	echo $advanced_script;
	//===============================================
	// Основная форма
	selectdb(wcf);
	$result = db_query("SELECT count(`news_date`) as kol FROM ".DB_NEWS." ");
	$n_kolzap = db_array($result);

	if ($n_kolzap['kol'] > $config['page_admin_news'])
		{
    			$page_len_n = $config['page_admin_news'];

    			if (!isset($_GET['page']) or ($_GET['page'] == '')) { $start_rec_n = 0; }
			else  { $start_rec_n = ((int)$_GET['page']-1)*$config['page_admin_news']; }
		}
	else
		{
    			$page_len_n = $config['page_admin_news'];
			$start_rec_n = 0;
		}

	$result = db_query("SELECT * FROM ".DB_NEWS." ORDER BY `news_date` DESC limit $start_rec_n,$page_len_n");

	opentable();
	echo"<form method='post'>";
	echo"<div align='center'><h1>".$txt['admin_newsmaker']."</h1></div>";

	if (db_num_rows($result) > 0 )
		{
			echo"<tr><td align='center' colspan='3'>".$txt['admin_newsmaker_title']."<br><hr></td></tr>";
   			while ($data = db_array($result))
				{
          				echo"<tr><td width='1%' align='right'><input name=id type=radio value='".$data['news_id']."'></td>";
          				echo"<td width='81%' align='left'>".$data['news_title']."</td>";
          				echo"<td width='18%'align='right'>".$data['news_date']."</td></tr>";
          				$kol++;
          			}

    			if ($n_kolzap['kol'] > $config['page_admin_news'])
				{
       					$pages_selector = '-';
       					$page_counter_n = ceil($n_kolzap['kol'] / $config['page_admin_news']);

       					if (!isset($_GET['page']) OR ($_GET['page'] == '') OR ($_GET['page'] == '_')) {$tp3 = 1;} else {$tp3 = (int)$_GET['page'];}

       					for ($i = 1; $i <= $page_counter_n; $i++)
						{
           						if ($tp3 == $i) {$pages_selector .= ' '.$i.' -';}
		   					else {$pages_selector .= "<A href='".ADMIN."news.php?page=".$i."'>".$i."</a> -";}
           					}
      					echo"<tr><td colspan='3' align='center'><b>".$pages_selector."</b></td></tr>";
     				}

			echo"<tr><td align='center' colspan='3'><hr><br><b>".$txt['admin_newsmaker_team']."</b>&nbsp;
				<select name=cmd class='textbox'>
					<option value=1 selected>".$txt['admin_newsmaker_edit']."</option>
					<option value=2>".$txt['admin_newsmaker_add']."</option>
					<option value=3>".$txt['admin_newsmaker_del']."</option></select></td></tr>";

    		}
	elseif (db_num_rows($result) == 0)
		{
			echo"<tr><td align='center' colspan='3'><hr><br><b>".$txt['admin_newsmaker_team']."</b>&nbsp;
				<select name='cmd' class='textbox'>
					<option value=2 selected>".$txt['admin_newsmaker_add']."</option></select></td></tr>";
		}
	echo"<tr><td align='center' colspan='3'><input type='submit' name='run_cmd' value='".$txt['Run']."' class='button'></td></tr>";
	echo"<tr><td align='center' colspan='3'>";

	$return_url = ADMIN."news.php";
	//===============================================
	// Редактирование
   	if ($_POST['cmd'] == edit AND $_POST['tema_edit'] <> '' AND $_POST['news_edit'] <> '' AND $_POST['news_edit_main'] <> '')
		{
			echo"<img src='".IMAGES."ajax-loader.gif'/><br>";
			$query = db_query("UPDATE ".DB_NEWS." SET `news_title`='".addslashes($_POST['tema_edit'])."',`news_text`='".addslash($_POST['news_edit'])."',`news_text_main`='".addslash($_POST['news_edit_main'])."',`news_cats`='".(int)$_POST['catedit']."' WHERE `news_id`='".(int)$_POST['guid']."'"); 

			if ($query)
				{
					echo $txt['admin_newsmaker_edit_succes'];
					return_form(20,$return_url);
				}
			else
				{
					echo $txt['errors'];
					return_form(20,$return_url);
				}
       		}
	//===============================================
	// Добавление
	elseif ($_POST['cmd'] == newsadd AND $_POST['tema_add'] <> '' AND $_POST['news_add'] <> '' AND $_POST['news_add_main'] <> '')
		{
			echo"<img src='".IMAGES."ajax-loader.gif'/><br>";
			$nt = addslashes($_POST['tema_add']);
			$query = db_query("INSERT INTO ".DB_NEWS." (`news_title`,`news_text`,`news_text_main`,`news_cats`) values ('".addslashes($_POST['tema_add'])."','".addslash($_POST['news_add'])."','".addslash($_POST['news_add_main'])."','".(int)$_POST['catadd']."')");

			if ($query)
				{
					echo $txt['admin_newsmake_add_succes'];
					return_form(20,$return_url);
				}
			else
				{
					echo $txt['errors'];
					return_form(20,$return_url);
				}
		}
	//===============================================
	// Удаление
    	elseif (isset($_POST['run_cmd']) AND isset($_POST['cmd']) AND isset($_POST['id']) AND ($_POST['cmd'] == 3) AND ($_POST['id'] > 0))
		{
			echo"<img src='".IMAGES."ajax-loader.gif'/><br>";
			$query = db_query("DELETE FROM ".DB_NEWS." WHERE `news_id` = '".(int)$_POST['id']."'");

			if ($query)
				{
					echo $txt['admin_newsmake_del_succes'];
					return_form(20,$return_url);
				}
			else
				{
							echo $txt['errors'];
							return_form(20,$return_url);
				}
		}
	elseif (($_POST['cmd'] == edit AND ($_POST['tema_edit'] == '' OR $_POST['news_edit'] == '' OR $_POST['news_edit_main'] == '')) OR ($_POST['cmd'] == newsadd AND ($_POST['tema_add'] == '' OR $_POST['news_add'] == '' OR $_POST['news_add_main'] == '')))
				{
					echo"<img src='".IMAGES."ajax-loader.gif'/><br>";
					echo $txt['admin_newsmaker_not_fields'];
					return_form(10,$return_url);
				}
	echo"</td></tr>";
	echo"</form>";
	closetable();

	//===============================================
	// Доп. форма
	$result = db_query("SELECT * FROM ".DB_NEWS_CATS."");
	$editlist = "";
	while ($news_cats = db_array($result))
		{
	  		$news_cats_list .= "<option value=".$news_cats['news_cat_id'].">".$news_cats['news_cat_name']."</option>";
		}
	//===============================================
	// форма редактирования
     	if (isset($_POST['run_cmd']) AND isset($_POST['cmd']) AND isset($_POST['id']) AND ($_POST['cmd'] == 1) AND ($_POST['id'] > 0))
		{
       			$result = db_query("SELECT * FROM ".DB_NEWS." WHERE `news_id` = ".$_POST['id'].' limit 1');
	   		$data = db_assoc($result);

			opentable();
       			echo"<form method='post'>";
       			echo"<tr><td align='left' valign='middle'>".$txt['admin_newsmaker_teme']."&nbsp;&nbsp;";
			echo"<input type='text' name='tema_edit' class='textbox' value='".$data['news_title']."' size='40'></td>";

       			echo"<tr><td align='left' valign='middle'>".$txt['admin_newsmaker_cat']."&nbsp;&nbsp;";
			echo"<input name='cmd' value='edit' type=hidden><input name='guid' class='textbox' value='".$data['news_id']."' type=hidden>";

        		echo"<select name=catedit class='textbox'>".$news_cats_list."</select>";
			echo"</td></tr>";

			echo"<tr><td><hr>".$txt['admin_newsmaker_newsflash']."</td></tr>";
       			echo"<tr><td><textarea name='news_edit'>".$data['news_text']."</textarea></td></tr>";
			echo"<tr><td><hr>".$txt['admin_newsmaker_newsfull']."</td></tr>";
       			echo"<tr><td><textarea name='news_edit_main'>".$data['news_text_main']."</textarea></td></tr>";
       			echo"<tr><td align='center'><br><input type='submit' class='button' value='".$txt['admin_newsmaker_edit']."'/></td></tr>";
			echo"</form>";
			closetable();
      		}
	//===============================================
	// форма добавления
    	elseif (isset($_POST['run_cmd']) AND isset($_POST['cmd']) AND $_POST['cmd'] == 2)
		{
			opentable();
			echo"<form method='post'>";
        		echo"<tr><td align='left' valign='middle'>".$txt['admin_newsmaker_teme']."&nbsp;";
        		echo"<input type='text' class='textbox' name='tema_add' size='40'></td></tr>";

        		echo"<tr><td align='left' valign='middle'>".$txt['admin_newsmaker_cat']."&nbsp;";
       			echo"<input name='cmd' value='newsadd' type=hidden>";

     			echo"<select name=catadd class='textbox'>$news_cats_list</select>";
			echo"</td></tr>";

			echo"<tr><td><hr>".$txt['admin_newsmaker_newsflash']."</td></tr>";
			echo"<tr><td><textarea name='news_add'></textarea></td></tr>";
			echo"<tr><td><hr>".$txt['admin_newsmaker_newsfull']."</td></tr>";
			echo"<tr><td><textarea name='news_add_main'></textarea></td></tr>";
			echo"<tr><td align='center'><br><input type='submit' class='button' value='".$txt['admin_newsmaker_add']."'/></td></tr>";
			echo"</form>";
			closetable();

		}
	require_once THEMES."templates/footer.php";
?>