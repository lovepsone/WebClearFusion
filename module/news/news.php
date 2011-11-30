<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: news.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	selectdb(wcf);
  	$cres = mysql_query("SELECT count(`news_date`) as kol FROM ".DB_NEWS."") or trigger_error(mysql_error());
	$kolzap = mysql_fetch_array($cres);

	if ($kolzap['kol'] > $config['page_news'])
		{
    			$PageLen = $config['page_news'];
 
    			if (!isset($_GET['page']) or ($_GET['page'] == '')) $StartRec = 0;
			else 	$StartRec = ((int)$_GET['page']-1)*$config['page_news'];
		}
	else
		{
    			$PageLen = $kolzap['kol'];
			$StartRec = 0;
		}

  	$kres = mysql_query("SELECT * FROM ".DB_NEWS." 
				LEFT JOIN ".DB_NEWS_CATS." ON `news_cat_id`=`news_cats`
				LEFT JOIN ".DB_USERS." ON ".DB_USERS.".`user_id`=".DB_NEWS.".`news_author`
				ORDER BY `news_date` DESC limit ".$StartRec.",".$PageLen) or trigger_error(mysql_error());
  	if (mysql_num_rows($kres) > 0 )
		{
			opentable();
     			while ($nres = mysql_fetch_array($kres))
				{
          				echo"<tr><td align='left' colspan='3' class='head-table'>&nbsp;".$nres['news_title']."</td></tr>";
          				echo"<tr><td align='left' width='80'><img src='".IMAGES_NC.$nres['news_cat_image']."' align='absmiddle'>&nbsp;</td><td>&nbsp&nbsp;</td>";
					echo"<td align='top'>".stripslashes($nres['news_text'])."</td><td>&nbsp;&nbsp;</td></tr>";
          				echo"<tr><td colspan='4' align='left'>&nbsp;".$txt['modul_news_creation_date']."&nbsp;".$nres['news_date']."&nbsp;".$txt['modul_news_author']."
						&nbsp;".ucfirst(strtolower($nres['user_name']))."&nbsp;|&nbsp;<a href='index.php?modul=newsext&id=".$nres['news_id']."'>".$txt['modul_news_read_more']."</a><br><hr></td></tr>";
      				}

  			if ($kolzap['kol'] > $config['page_news'])
				{
  					$PageCounter = ceil($kolzap['kol'] / $config['page_news']);

   					if (!isset($_GET['page']) OR ($_GET['page'] == '') OR ($_GET['page'] == '_')) $tp3 = 1;
      					else $tp3 = (int)$_GET['page'];
 					echo"<tr><td height='30' colspan='3' align='center' valign='middle' >". ShowPageNavigator('index.php?modul=news&page=',$tp3,$PageCounter)."</td></tr>";
  				}
			closetable();
   		}
?>