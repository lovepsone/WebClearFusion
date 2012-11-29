<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2012 lovepsone
+--------------------------------------------------------+
| Filename: defines.php
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
	define("DB_FAQS", DB_PREFIX."faqs");
	define("DB_FAQ_CATS", DB_PREFIX."faq_cats");
	define("DB_FORUMS", DB_PREFIX."forums");
	define("DB_FORUMS_POSTS", DB_PREFIX."forums_posts");
	define("DB_FORUMS_THREADS", DB_PREFIX."forums_threads");
	define("DB_VERSIONS", DB_PREFIX."db_version");
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
	define("IMAGES", BASEDIR."images/");
	define("IMAGES_N", BASEDIR."images/news/");
	define("IMAGES_NC", BASEDIR."images/news_cat/");
	define("IMAGES_A", BASEDIR."images/avatars/");
	define("INCLUDES", BASEDIR."include/");
	define("LANG", BASEDIR."lang/");
	define("MODULE", BASEDIR."module/");
	define("PANELS", BASEDIR."panels/");
	define("THEMES", BASEDIR."themes/");
	define("S_KCAPTCHA", BASEDIR."include/securimages/");
?>