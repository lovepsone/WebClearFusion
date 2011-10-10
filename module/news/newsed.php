<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: newsed.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	require $modules['adminmenu'][0];
	$kol = 1;

	if (isset($_GET['add']))
		{
			selectdb(wcf);
   			require "include/tinymce.php";
   			echo $edit_script;

    			if ($_POST['cmd'] == newsadd)
				{	// на до бы придумать что - то другое. кусок кода мне не нравится
        				if ($_POST['tema'] <> '') $nt = addslashes($_POST['tema']);

					$nt = addslashes($_POST['tema']);
					$addnews = mysql_query("insert into `wcf_news` (`title`,`text`,`cat`) values ('".$nt."','".text_optimazer($_POST['news'])."','".(int)$_POST['cat']."')") or trigger_error(mysql_error());

					if($addnews == true) { echo"$txt[admin_news_add_successfully]"; } else { echo"$txt[menu_auth_error]"; }

        				echo"<script type='text/javascript'> <!-- window.status = ''; window.location = 'index.php?modul=newsed&add';//--> </script>";
					ReturnAdminNewsadd(10);
				}

			echo"<form method='post'>";
			echo"<table width='100%' cellpadding='0' cellspacing='0' border='0' align='center'>";
	
       			echo"<tr><td width='10%' height='30' align='right' valign='middle'>$txt[admin_teme_news]</td>";
			echo"<td width='1%' height='30' >&nbsp;</td>";
        		echo"<td width='89%' height='30' align='left' valign='middle'><input name='modul' value='newsadd' type=hidden><input type='text' name='tema' size='40'></td></tr>";

        		echo"<tr><td width='100' height='30' align='right' valign='middle'>$txt[admin_typ_news]</td>";
			echo"<td width='10' height='30' >&nbsp;</td>";
        		echo"<td width='510' height='30' align='left' valign='middle'><input name='cmd' value='newsadd' type=hidden>";

        		echo"<select name=cat>
             		<option value=0 selected>$txt[typ_news_0]</option>
             		<option value=1>$txt[typ_news_1]</option>
             		<option value=2>$txt[typ_news_2]</option>
             		<option value=3>$txt[typ_news_3]</option>
             		<option value=4>$txt[typ_news_4]</option>
             		<option value=5>$txt[typ_news_5]</option>
             		<option value=6>$txt[typ_news_6]</option></select>";
			echo"</td></tr></table>";

			echo"<textarea name='news'></textarea>";
			echo"<br><center><input type='submit' value='$txt[menu_admin_news_add]'/></center></form>";
		}

	if (isset($_GET['edit']))
		{
			selectdb(wcf);
   			require "include/tinymce.php";
   			echo $edit_script;

			$cres = mysql_query("SELECT count(`date`) as kol FROM `wcf_news` ") or trigger_error(mysql_error());
			$kolzap = mysql_fetch_array($cres);

			if ($kolzap['kol'] > $config['page_news_edit'])
				{
    					$PageLen = $config['page_news_edit']; 
    					if (!isset($_GET['page']) or ($_GET['page'] == '')) {$StartRec = 0; }
					else 	$StartRec = ((int)$_GET['page']-1)*$config['page_news_edit'];
				}
			else
				{
    					$PageLen = $config['page_news_edit'];
					$StartRec = 0;
				}

			$kres = mysql_query("SELECT `id`,`date`,`title`,`text`,`cat` FROM `wcf_news` ORDER BY `date` DESC limit ".$StartRec.",".$PageLen) or trigger_error(mysql_error());

			echo"<form method='post'>";
			echo"<table width='90%' border='0' cellspacing='0' cellpadding='5' class='report'>";

			if (mysql_num_rows($kres) > 0 )
				{
   					while ($nres = mysql_fetch_array($kres))
						{
          						echo"<tr><td align='left' class='page'><input name=id type=radio value='".$nres['id']."'></td>";
          						echo"<td align='left' class='page'>".$nres['title']."</td>";
          						echo"<td align='right' class='page'>".$nres['date']."</td></tr>";
          						$kol++;
          					}

    					if ($kolzap['kol'] > $config['page_news_edit'])
						{
       							$PagesSelector = '-';
       							$PageCounter = ceil($kolzap['kol'] / $config['page_news_edit']);

       							if (!isset($_GET['page']) OR ($_GET['page'] == '') OR ($_GET['page'] == '_')) $tp3 = 1;
       							else $tp3 = (int)$_GET['page'];

       							for ($i = 1; $i <= $PageCounter; $i++)
								{
           								if ($tp3 == $i) $PagesSelector .= ' '.$i.' -';
		   							else $PagesSelector .= ' <A href="index.php?modul=newsedit&page='.$i.'">'.$i.'</a> -';
           							}
      							echo"<tr><td height='30' colspan='3' align='center' valign='middle' class='head'><b>$PagesSelector</b></td></tr>";
     						}
    				}

			echo"<tr><td colspan='3' align='center' class='page'><input action='index.php' name='edit' value='newsedit' type=hidden><input type='submit' value='$txt[menu_admin_news_edit]'></td></tr></table></form>";


			if (isset($_POST['edit']) )
				{
   					if (isset($_POST['id']) AND ($_POST['id'] > 0))
						{
       							$nres = mysql_query("select * from `wcf_news` where `id` = ".$_POST['id'].' limit 1') or trigger_error(mysql_error());
	   						$nr = mysql_fetch_assoc($nres);

       							echo"<form method='post'>";
							echo"<table width='100%' cellpadding='0' cellspacing='0' border='0' align='center'>";

             						echo"<tr><td width='10%' height='30' align='right' valign='middle'>$txt[admin_teme_news]</td>";
							echo"<td width='1%' height='30' >&nbsp;</td>";
       							echo"<td width='89%' height='30' align='left' valign='middle'><input name='modul' value='newsedit' type=hidden><input type='text' name='tema' size='60' value='".$nr['title']."'></td></tr>";

       							echo"<tr><td width='100' height='30' align='right' valign='middle'>$txt[admin_typ_news]</td>";
							echo"<td width='10' height='30' >&nbsp;</td>";
							echo"<td width='510' height='30' align='left' valign='middle'><input name='cmd' value='edit' type=hidden><input name='guid' value='".$nr['id']."' type=hidden>";

        						echo"<select name=cat>
             							<option value=0 selected>$txt[typ_news_0]</option>
             							<option value=1>$txt[typ_news_1]</option>
             							<option value=2>$txt[typ_news_2]</option>
             							<option value=3>$txt[typ_news_3]</option>
             							<option value=4>$txt[typ_news_4]</option>
             							<option value=5>$txt[typ_news_5]</option>
             							<option value=6>$txt[typ_news_6]</option></select>";
							echo"</td></tr></table>";

       							echo"<textarea name='news'>".$nr['text']."</textarea>"; 
       							echo"<br><center><input type='submit' value='$txt[menu_admin_news_edit]'/></center></form>";
      						}
				}

   			if ($_POST['cmd'] == edit)
				{	// на до бы придумать что - то другое. кусок кода мне не нравится
        				if ($_POST['tema'] <> '') $nt = addslashes($_POST['tema']);
	    				//else $nt = $txt[37+(int)$_POST['сat']];

					$editQuery = "UPDATE `wcf_news` SET `title`='".$nt."',`text`='".text_optimazer($_POST['news'])."',`cat`='".(int)$_POST['cat']."' WHERE `id`='".(int)$_POST['guid']."'"; 
	   				mysql_query($editQuery) or trigger_error(mysql_error());

					if(mysql_query($editQuery) == true) { echo"$txt[admin_news_edit_successfully]"; } else { echo"$txt[menu_auth_error]"; }

        				echo"<script type='text/javascript'> <!-- window.status = ''; window.location = 'index.php?modul=newsed&edit';//--> </script>";
					ReturnAdminNewsedit(10);
       				}
	}

	if (isset($_GET['del']))
		{
			selectdb(wcf);
			$cres = mysql_query("SELECT count(`date`) as kol FROM `wcf_news` ") or trigger_error(mysql_error());
			$kolzap = mysql_fetch_array($cres);

			if ($kolzap['kol'] > $config['page_news_del'])
				{
    					$PageLen = $config['page_news_del']; 
    					if (!isset($_GET['page']) or ($_GET['page'] == '')) {$StartRec = 0; }
					else 	$StartRec = ((int)$_GET['page']-1)*$config['page_news_del'];
				}
			else
				{
    					$PageLen = $config['page_news_del'];
					$StartRec = 0;
				}

			$kres = mysql_query("SELECT `id`,`date`,`title`,`text`,`cat` FROM `wcf_news` ORDER BY `date` DESC limit ".$StartRec.",".$PageLen) or trigger_error(mysql_error());

			echo"<form method='post'>";
			echo"<table width='90%' border='0' cellspacing='0' cellpadding='5' class='report'>";

			if (mysql_num_rows($kres) > 0 )
				{
   					while ($nres = mysql_fetch_array($kres))
						{
          						echo"<tr><td align='left' class='page'><input name=id type=radio value='".$nres['id']."'></td>";
          						echo"<td align='left' class='page'>".$nres['title']."</td>";
          						echo"<td align='right' class='page'>".$nres['date']."</td></tr>";
          						$kol++;
          					}

    					if ($kolzap['kol'] > $config['page_news_edit'])
						{
       							$PagesSelector = '-';
       							$PageCounter = ceil($kolzap['kol'] / $config['page_news_del']);

       							if (!isset($_GET['page']) OR ($_GET['page'] == '') OR ($_GET['page'] == '_')) $tp3 = 1;
       							else $tp3 = (int)$_GET['page'];

       							for ($i = 1; $i <= $PageCounter; $i++)
								{
           								if ($tp3 == $i) $PagesSelector .= ' '.$i.' -';
		   							else $PagesSelector .= ' <A href="index.php?modul=newsdel&page='.$i.'">'.$i.'</a> -';
           							}
      							echo"<tr><td height='30' colspan='3' align='center' valign='middle' class='head'><b>$PagesSelector</b></td></tr>";
     						}
    				}

			echo"<tr><td colspan='3' align='center' class='page'><input action='index.php' name='del' value='newsdel' type=hidden><input type='submit' value='$txt[menu_admin_news_del]'></td></tr></table></form>";

			if ( isset($_POST['del']) )
				{
   				if (isset($_POST['id']) AND ($_POST['id'] > 0))
					{

						$delQuery = "DELETE FROM `wcf_news` WHERE `id` = '".(int)$_POST['id']."'";
						mysql_query($delQuery) or trigger_error(mysql_error());

						if(mysql_query($delQuery) == true) { echo"$txt[admin_news_del_successfully]"; } else { echo"$txt[menu_auth_error]"; }

        					echo"<script type='text/javascript'> <!-- window.status = ''; window.location = 'index.php?modul=newsed&del';//--> </script>";
						ReturnAdminNewsdel(10);
      					}
				}
		}
?>