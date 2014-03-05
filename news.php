<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2014 lovepsone
+--------------------------------------------------------+
| Filename: news.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	require_once "maincore.php";
	require_once THEMES."templates/header.php";

	if (!isset($_GET['readmore']) || !WCF::isNum($_GET['readmore']))
	{
		$RowCount = WCF::$DB->selectRow('SELECT count(`news_date`) as N FROM ?_news');
		if (!isset($_GET['rowstart']) || !WCF::isNum($_GET['rowstart'])) { $_GET['rowstart'] = 0; }
	
	  	$rows = WCF::$DB->select(' -- CACHE: 180
					SELECT * FROM ?_news
					LEFT JOIN ?_news_cats ON `news_cat_id`=`news_cat`
					LEFT JOIN ?_users ON ?_users.`user_id` = ?_news.`news_author`
					ORDER BY `news_date` DESC limit ?d, ?d', $_GET['rowstart'], WCF::$cfgSetting['newsperpage']);
					
		if ($rows != null)
		{
			foreach ($rows as $numRow=>$data)
			{
				$news_subject = "<a name='news_".$data['news_id']."' id='news_".$data['news_id']."'></a>".stripslashes($data['news_subject']);
				$img_size = @getimagesize(IMAGES_NC.$data['news_cat_image']);
				$news_cat_image = ($data['news_show_cat'] ? "<img src='".IMAGES_NC.$data['news_cat_image']."' width='".$img_size[0]."' height='".$img_size[1]."' class='news-category' />" : "");
	
				echo "<table cellpadding='0' cellspacing='0' width='100%'>\n<tr>\n";
				echo "<td class='capmain-left'></td>\n";
				echo "<td class='capmain'>".$news_subject."</td>\n";
				echo "<td class='capmain-right'></td>\n";
				echo "</tr>\n</table>\n";
				echo "<table width='100%' cellpadding='0' cellspacing='0' class='spacer'>\n<tr>\n";
				echo "<td class='main-body middle-border'>".$news_cat_image.$data['news_text']."</td>\n";
				echo "</tr>\n<tr>\n";
				echo "<td align='center' class='news-footer middle-border'>\n";
				echo THEME_BULLET." <span><a href='".BASEDIR."profile.php?lookup=user_id'>".ucfirst(strtolower($data['user_name']))."</a> ".$data['news_date']."</span> ";
				echo THEME_BULLET." <span>".WCF::getLocale('news', 3)."<a href='".BASEDIR."news_cats.php?lookup=cat_id'>".$data['news_cat_name']."</a></span> ";
				echo THEME_BULLET." <span><a href='".BASEDIR."news.php?readmore=".$data['news_id']."'>".WCF::getLocale('news', 0)."</a></span> ";
				echo THEME_BULLET." <span>".WCF::getLocale('news', 1)." ".$data['news_count_comments']."</span> ";
				echo THEME_BULLET." <span>".WCF::getLocale('news', 2)." ".$data['news_count_reads']."</span> ";
				echo "</td>\n";
				echo "</tr><tr>\n";
				echo "<td style='height:5px;background-color:#f6a504;'></td>\n";
				echo "</tr>\n</table>\n";
			}
			if ($RowCount['N'] > WCF::$cfgSetting['newsperpage']) echo "<div align='center' style=';margin-top:5px;'>\n".WCF::$ST->MakePageNav($_GET['rowstart'], WCF::$cfgSetting['newsperpage'],$RowCount['N'],3)."\n</div>\n";
		}
		else
		{
			WCF::Redirect(WCF::$cfgSetting['opening_page']);
		}
	}
	else
	{
  		$data = WCF::$DB->selectRow(' -- CACHE: 180
				SELECT * FROM ?_news
				LEFT JOIN ?_news_cats ON `news_cat_id`=`news_cat`
				LEFT JOIN ?_users ON ?_users.`user_id`=?_news.`news_author`
				WHERE `news_id` = ?d', $_GET['readmore']);

		if (count($data) > 0)
		{
			WCF::$DB->query('UPDATE ?_news SET `news_count_reads`= news_count_reads+1 WHERE `news_id` = ?d', $_GET['readmore']);
			$news_subject = "<a name='news_".$data['news_id']."' id='news_".$data['news_id']."'></a>".stripslashes($data['news_subject']);
			$img_size = @getimagesize(IMAGES_NC.$data['news_cat_image']);
			$news_cat_image = ($data['news_show_cat'] ? "<img src='".IMAGES_NC.$data['news_cat_image']."' width='".$img_size[0]."' height='".$img_size[1]."' class='news-category' />" : "");
	
			echo "<table cellpadding='0' cellspacing='0' width='100%'>\n<tr>\n";
			echo "<td class='capmain-left'></td>\n";
			echo "<td class='capmain'>".$news_subject."</td>\n";
			echo "<td class='capmain-right'></td>\n";
			echo "</tr>\n</table>\n";
			echo "<table width='100%' cellpadding='0' cellspacing='0' class='spacer'>\n<tr>\n";
			echo "<td class='main-body middle-border'>".$news_cat_image.$data['news_text']."</td>\n";
			echo "</tr>\n<tr>\n";
			echo "<td align='center' class='news-footer middle-border'>\n";
			echo THEME_BULLET." <span><a href='".BASEDIR."profile.php?lookup=user_id'>".ucfirst(strtolower($data['user_name']))."</a> ".$data['news_date']."</span> ";
			echo THEME_BULLET." <span>".WCF::getLocale('news', 1)." ".$data['news_count_comments']."</span> ";
			echo THEME_BULLET." <span>".WCF::getLocale('news', 2)." ".$data['news_count_reads']."</span> ";
			echo "</td>\n";
			echo "</tr><tr>\n";
			echo "<td style='height:5px;background-color:#f6a504;'></td>\n";
			echo "</tr>\n</table>\n";
		}
		else
		{
			WCF::Redirect(WCF::$cfgSetting['opening_page']);
		}
	}

	require_once THEMES."templates/footer.php";
?>