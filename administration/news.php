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
	echo"<div align='center'><h1>".$txt['admin_newsmaker']."</h1></div><hr>";

	selectdb(wcf);
	$n_cres = mysql_query("SELECT count(`news_date`) as kol FROM `wcf_news` ") or trigger_error(mysql_error());
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

	$kres = mysql_query("SELECT * FROM `wcf_news` ORDER BY `news_date` DESC limit $start_rec_n,$page_len_n") or trigger_error(mysql_error());

	echo"<form method='post'>";
	echo"<table width='90%' border='0' cellspacing='0' cellpadding='5' class='report'>";

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
      					echo"<tr><td height='30' colspan='3' align='center' valign='middle' class='head'><b>$pages_selector</b></td></tr>";
     				}
    		}
	echo"</table>";

	if ($kol > 1)
		{
			echo"<font color='red'>".$txt['admin_newsmaker_title']."</font><br>";
			echo"<br><table width='100%' height='30' border='0' cellpadding='0' cellspacing='0'><tr><td align='center'><b>".$txt['admin_newsmaker_team']."</b>&nbsp;&nbsp;";
				echo"<select name=cmd><option value=1 selected>".$txt['admin_newsmaker_edit']."</option><option value=2>".$txt['admin_newsmaker_add']."</option>";
		}
	else echo "<option value=2 selected>".$txt['admin_newsmaker_add']."</option>";

	echo"<option value=3>".$txt['admin_newsmaker_del']."</option></select></td>";
	echo"<td align='center'><input action='index.php' name='modul' value='newsedit' type=hidden><input type='submit' value='".$txt['Run']."'></td></tr></table><hr></form>";

	if (isset($_POST['cmd']))
		{
   			require "include/tinymce.php";
   			echo $advanced_script;
			//===============================================
			// Редактирование
     			if (isset($_POST['id']) AND ($_POST['cmd'] == 1) AND ($_POST['id'] > 0))
				{
       					$nres = mysql_query("SELECT * FROM `wcf_news` WHERE `news_id` = ".$_POST['id'].' limit 1') or trigger_error(mysql_error());
	   				$nr = mysql_fetch_assoc($nres);

       					echo"<br><form method='post'>";
					echo"<table width='100%' cellpadding='0' cellspacing='0' border='0' align='center'>";

             				echo"<tr><td width='10%' height='30' align='right' valign='middle'>".$txt['admin_teme_news']."</td>";
					echo"<td width='1%' height='30' >&nbsp;</td>";
             				echo"<td width='89%' height='30' align='left' valign='middle'><input name='modul' value='newsedit' type=hidden><input type='text' name='tema_edit' size='60' value='".$nr['news_title']."'></td></tr>";

        				echo"<tr><td width='100' height='30' align='right' valign='middle'>".$txt['admin_typ_news']."</td>";
					echo"<td width='10' height='30' >&nbsp;</td>";
					echo"<td width='510' height='30' align='left' valign='middle'><input name='cmd' value='edit' type=hidden><input name='guid' value='".$nr['news_id']."' type=hidden>";

        				echo"<select name=catedit>
             					<option value=0 selected>$txt[typ_news_0]</option>
             					<option value=1>$txt[typ_news_1]</option>
             					<option value=2>$txt[typ_news_2]</option>
             					<option value=3>$txt[typ_news_3]</option>
             					<option value=4>$txt[typ_news_4]</option>
             					<option value=5>$txt[typ_news_5]</option>
             					<option value=6>$txt[typ_news_6]</option></select>";
					echo"</td></tr></table>";

       					echo"<textarea name='news_edit'>".$nr['news_text']."</textarea>"; 
       					echo"<br><center><input type='submit' value='$txt[menu_admin_news_edit]'/></center></form>";
      				}
   			if ($_POST['cmd'] == edit AND $_POST['tema_edit'] <> '' AND $_POST['news_edit'] <> '')
				{
					echo"<img src='images/ajax-loader.gif'/>";
					$nt = addslashes($_POST['tema_edit']);
					$query = mysql_query("UPDATE `wcf_news` SET `news_title`='".$nt."',`news_text`='".text_optimazer($_POST['news_edit'])."',`news_cat`='".(int)$_POST['catedit']."' WHERE `news_id`='".(int)$_POST['guid']."'") or trigger_error(mysql_error()); 

					if ($query)
						{
							echo"<script type='text/javascript'> <!-- window.status = ''; window.location = 'index.php?modul=newsedit';//--> </script>";
							ReturnAdminNewsedit(10);
						}
					else echo $txt['errors'];
       				}
			else if($_POST['cmd'] == edit AND $_POST['tema_edit'] == '' OR $_POST['cmd'] == edit AND $_POST['news_edit'] == '') echo $txt['admin_news_not_all_fields'];
			//===============================================
			// Добавление
    			if ($_POST['cmd'] == 2)
				{
					echo"<form method='post'>";
					echo"<table width='100%' cellpadding='0' cellspacing='0' border='0' align='center'>";
	
        				echo"<tr><td width='10%' height='30' align='right' valign='middle'>".$txt['admin_teme_news']."</td>";
					echo"<td width='1%' height='30' >&nbsp;</td>";
        				echo"<td width='89%' height='30' align='left' valign='middle'><input name='modul' value='newsedit' type=hidden><input type='text' name='tema_add' size='40'></td></tr>";

        				echo"<tr><td width='100' height='30' align='right' valign='middle'>".$txt['admin_typ_news']."</td>";
					echo"<td width='10' height='30' >&nbsp;</td>";
        				echo"<td width='510' height='30' align='left' valign='middle'><input name='cmd' value='newsadd' type=hidden>";

        				echo"<select name=catadd>
             					<option value=0 selected>$txt[typ_news_0]</option>
             					<option value=1>$txt[typ_news_1]</option>
             					<option value=2>$txt[typ_news_2]</option>
             					<option value=3>$txt[typ_news_3]</option>
             					<option value=4>$txt[typ_news_4]</option>
             					<option value=5>$txt[typ_news_5]</option>
             					<option value=6>$txt[typ_news_6]</option></select>";
					echo"</td></tr></table>";

					echo"<textarea name='news_add'></textarea>";
					echo"<br><center><input type='submit' value='".$txt['menu_admin_news_add']."'/></center></form>";

				}
			if ($_POST['cmd'] == newsadd AND $_POST['tema_add'] <> '' AND $_POST['news_add'] <> '')
				{
					echo"<img src='images/ajax-loader.gif'/>";
					$nt = addslashes($_POST['tema_add']);
					$query = mysql_query("INSERT INTO `wcf_news` (`news_title`,`news_text`,`news_cat`) values ('".$nt."','".text_optimazer($_POST['news_add'])."','".(int)$_POST['catadd']."')") or trigger_error(mysql_error());

					if ($query)
						{
							echo"<script type='text/javascript'> <!-- window.status = ''; window.location = 'index.php?modul=newsedit';//--> </script>";
							ReturnAdminNewsedit(10);
						}
					else echo $txt['errors'];

				}
			else if($_POST['cmd'] == newsadd AND $_POST['tema_add'] == '' OR $_POST['cmd'] == newsad AND $_POST['news_add'] == '') echo $txt['admin_news_not_all_fields'];
			//===============================================
			// Удаление
    			if (isset($_POST['id']) AND ($_POST['cmd'] == 3) AND ($_POST['id'] > 0))
				{
					echo"<img src='images/ajax-loader.gif'/>";
					$query = mysql_query("DELETE FROM `wcf_news` WHERE `news_id` = '".(int)$_POST['id']."'") or trigger_error(mysql_error());

					if ($query)
						{
							echo"<script type='text/javascript'> <!-- window.status = ''; window.location = 'index.php?modul=newsedit';//--> </script>";
							ReturnAdminNewsedit(10);
						}
					else echo $txt['errors'];
				}
		}
?>