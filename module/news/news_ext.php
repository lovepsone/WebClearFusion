<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: news_ext.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	$newsid = addslashes($_GET["id"]);

	if (isset($_GET['id']))
		{
			selectdb(wcf);
  			$query_news = mysql_query("SELECT * FROM ".DB_NEWS." 
						LEFT JOIN ".DB_NEWS_CATS." ON `news_cat_id`=`news_cats`
						LEFT JOIN ".DB_USERS." ON ".DB_USERS.".`user_id`=".DB_NEWS.".`news_author`
						WHERE `news_id`='".$newsid."' limit 1") or trigger_error(mysql_error());

  			if (mysql_num_rows($query_news) > 0 )
				{
					$newsexp = mysql_fetch_assoc($query_news);
					opentable();
          				echo"<tr><td align='left' colspan='3' class='head-table'>&nbsp;".$newsexp['news_title']."</td></tr>";
          				echo"<tr><td align='left' width='80'><img src='".IMAGES_NC.$newsexp['news_cat_image']."' align='absmiddle'>&nbsp;</td><td>&nbsp&nbsp;</td>";
					echo"<td align='top'>".stripslashes($newsexp['news_text_main'])."</td><td>&nbsp;&nbsp;</td></tr>";
          				echo"<tr><td colspan='4' align='left'>&nbsp;".$txt['modul_news_creation_date']."&nbsp;".$newsexp['news_date']."&nbsp;".$txt['modul_news_author']."
						&nbsp;".ucfirst(strtolower($newsexp['user_name']))."&nbsp;<br><hr></td></tr>";
					closetable();
   				}
		}
?>