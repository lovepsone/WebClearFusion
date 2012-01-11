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

	require_once "maincore.php";
	require_once THEMES."templates/header.php";

	selectdb(wcf);
  	$result = mysql_query("SELECT count(`news_date`) as number FROM ".DB_NEWS."") or trigger_error(mysql_error());
	$kolzap = db_array($result);

	if ($kolzap['number'] > $config['page_news'])
		{
    			$PageLen = $config['page_news'];
 
    			if (!isset($_GET['page']) or ($_GET['page'] == '')) $StartRec = 0;
			else 	$StartRec = ((int)$_GET['page']-1)*$config['page_news'];
		}
	else
		{
    			$PageLen = $kolzap['number'];
			$StartRec = 0;
		}

  	$result = mysql_query("SELECT * FROM ".DB_NEWS." 
				LEFT JOIN ".DB_NEWS_CATS." ON `news_cat_id`=`news_cats`
				LEFT JOIN ".DB_USERS." ON ".DB_USERS.".`user_id`=".DB_NEWS.".`news_author`
				ORDER BY `news_date` DESC limit ".$StartRec.",".$PageLen) or trigger_error(mysql_error());

	opentable();
  	if (db_num_rows($result) != 0 )
		{
     			while ($data = db_array($result))
				{
          				echo"<tr><td align='left' colspan='3' class='head-table'>&nbsp;".$data['news_title']."</td></tr>";
          				echo"<tr><td align='left' width='80'><img src='".IMAGES_NC.$data['news_cat_image']."' align='absmiddle'>&nbsp;</td><td>&nbsp&nbsp;</td>";
					echo"<td align='top'>".stripslashes($data['news_text'])."</td><td>&nbsp;&nbsp;</td></tr>";
          				echo"<tr><td colspan='4' align='left'>&nbsp;".$txt['modul_news_creation_date']."&nbsp;".$data['news_date']."&nbsp;".$txt['modul_news_author']."
						&nbsp;".ucfirst(strtolower($data['user_name']))."&nbsp;|&nbsp;<a href='newsext.php?id=".$data['news_id']."'>".$txt['modul_news_read_more']."</a><br><hr></td></tr>";
      				}

  			if ($kolzap['number'] > $config['page_news'])
				{
  					$PageCounter = ceil($kolzap['number'] / $config['page_news']);

   					if (!isset($_GET['page']) OR ($_GET['page'] == '') OR ($_GET['page'] == '_'))
						{
							$tp3 = 1;
						}
					else
						{
							$tp3 = (int)$_GET['page'];
						}
 					echo"<tr><td height='30' colspan='3' align='center' valign='middle' >".ShowPageNavigator('index.php?modul=news&page=',$tp3,$PageCounter)."</td></tr>";
  				}
   		}
	else
		{
			echo"<tr><td align='center' valign='middle' >".$txt['modul_news_no_news']."</td></tr>";
		}
	closetable();

	require_once THEMES."templates/footer.php";
?>