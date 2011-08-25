<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: newsdel.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	$w_connect = mysql_connect($config['whostname'], $config['wusername'], $config['wpassword']);
	mysql_select_db($config['wdbName'], $w_connect);
	mysql_query("SET NAMES '".$config['encoding']."'");

	$kol = 1;
	require $modules['adminmenu'][0];

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

	// форма выбора
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

				echo"$txt[admin_news_del_successfully]";

        			echo"<script type='text/javascript'> <!-- window.status = ''; window.location = 'index.php?modul=newsdel';//--> </script>";
      			}
		}
?>