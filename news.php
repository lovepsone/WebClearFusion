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

	selectdb("wcf");
  	$result = db_query("SELECT count(`news_date`) as number FROM ".DB_NEWS);
	$kolzap = db_array($result);

	if ($kolzap['number'] > $config['page_news'])
		{
    			$page_len = $config['page_news'];
 
    			if (!isset($_GET['page']) or ($_GET['page'] == ''))
				{
					$start_rec = 0;
				}
			else
				{
					$start_rec = ((int)$_GET['page']-1)*$config['page_news'];
				}
		}
	else
		{
    			$page_len = $kolzap['number'];
			$start_rec = 0;
		}

  	$result = db_query("SELECT * FROM ".DB_NEWS." 
				LEFT JOIN ".DB_NEWS_CATS." ON `news_cat_id`=`news_cat`
				LEFT JOIN ".DB_USERS." ON ".DB_USERS.".`user_id`=".DB_NEWS.".`news_author`
				ORDER BY `news_date` DESC limit ".$start_rec.",".$page_len);

	opentable();
  	if (db_num_rows($result))
		{
     			while ($data = db_array($result))
				{
					if (check_user($data['news_visibility']))
						{
							if ($data['news_show_cat'] == 1)
								{
									$img_size = @getimagesize(IMAGES_NC.$data['news_cat_image']);
									$news_cat_image = "<img src='".IMAGES_NC.$data['news_cat_image']."' width='".$img_size[0]."' height='".$img_size[1]."' class='news-category' />";
								}

          						echo"<tr><td align='left' class='head-table'>".$data['news_subject']."</td></tr>";
							echo"<tr><td align='left'>".$news_cat_image.stripslashes($data['news_text'])."</td></tr>";
          						echo"<tr><td align='center'><br>".$txt['modul_news_creation_date']."&nbsp;".$data['news_date']."&nbsp;".$txt['modul_news_author']."&nbsp;
								".ucfirst(strtolower($data['user_name']))."&nbsp;|&nbsp;<a href='newsext.php?id=".$data['news_id']."'>".$txt['modul_news_read_more']."</a><br><hr></td></tr>";
						}
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
 					echo"<tr><td height='30' align='center'>".show_page(WCF_SELF.'?page=',$tp3,$PageCounter)."</td></tr>";
  				}
   		}
	else
		{
			echo"<tr><td align='center' valign='middle' >".$txt['modul_news_no_news']."</td></tr>";
		}
	closetable();

	require_once THEMES."templates/footer.php";
?>