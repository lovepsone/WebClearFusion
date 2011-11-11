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
				ORDER BY `news_date` DESC limit ".$StartRec.",".$PageLen) or trigger_error(mysql_error());
  	if (mysql_num_rows($kres) > 0 )
		{
     			echo"<table width='100%' border='0' cellspacing='0' cellpadding='5' class='report'>";
     			while ($nres = mysql_fetch_array($kres))
				{
          				echo"<tr><th rowspan='2' align='left' width='80' height='80'><img src='images/news_cat/".$nres['news_cat_image']."' align='absmiddle' style=''></th>";
          				echo"<td align='left' class='head'>".$nres['news_title']."&nbsp;</td></tr>";
          				echo"<tr><td colspan='3' class='page'>".stripslashes($nres['news_text'])."</td></tr>";
          				echo"<tr><td align='right' colspan='3' class='page'>".$nres['news_date']."</td></tr>";
      				}

  			if ($kolzap['kol'] > $config['page_news'])
				{
  					$PageCounter = ceil($kolzap['kol'] / $config['page_news']);

   					if (!isset($_GET['page']) OR ($_GET['page'] == '') OR ($_GET['page'] == '_')) $tp3 = 1;
      					else $tp3 = (int)$_GET['page'];
 					echo"<tr><td height='30' colspan='3' align='center' valign='middle' >". ShowPageNavigator('index.php?modul=news&page=',$tp3,$PageCounter)."</td></tr>";
  				}
    			echo"</table>";
   		}
?>