<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2012 lovepsone
+--------------------------------------------------------+
| Filename: include_multi_site.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	//===============================================
	// Название таблиц mysql
	//===============================================
	define("DB_ADMIN", DB_PREFIX."admin");
	define("DB_COMMENTS", DB_PREFIX."comments");
	define("DB_FORUMS", DB_PREFIX."forums");
	define("DB_FORUMS_POSTS", DB_PREFIX."forums_posts");
	define("DB_FORUMS_THREADS", DB_PREFIX."forums_threads");
	define("DB_LOGS", DB_PREFIX."logs");
	define("DB_NAVIGATION_LINKS", DB_PREFIX."navigation_links");
	define("DB_NEWS", DB_PREFIX."news");
	define("DB_NEWS_CATS", DB_PREFIX."news_cats");
	define("DB_PANELS", DB_PREFIX."panels");
	define("DB_SETTINGS", DB_PREFIX."settings");
	define("DB_USERS", DB_PREFIX."users");

	//===============================================
	// Пути определения папок
	//===============================================
	define("ADMIN", BASEDIR."administration/");
	define("FORUM", BASEDIR."forum/");
	define("IMAGES_ACP", BASEDIR."acp/images/");
	define("IMAGES", BASEDIR."images/");
	define("IMAGES_N", BASEDIR."images/news/");
	define("IMAGES_NC", BASEDIR."images/news_cat/");
	define("IMAGES_A", BASEDIR."images/avatars/");
	define("IMAGES_PI", BASEDIR."images/player_info/");
	define("IMAGES_BAR", BASEDIR."images/bar/");
	define("IMAGES_ICONS", BASEDIR."images/icons/");
	define("INCLUDES", BASEDIR."include/");
	define("INCLUDES_DATA_WOW", BASEDIR."include/include_data_wow/");
	define("LANG", BASEDIR."lang/");
	define("PANELS", BASEDIR."panels/");
	define("THEMES", BASEDIR."themes/");

	// подключаем контент под сервер WOW
	define("CONTENT_WOW", BASEDIR."contentwow/");
	define("ACP", BASEDIR."acp/");
?>