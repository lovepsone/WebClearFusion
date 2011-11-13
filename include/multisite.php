<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: multisite.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	//===============================================
	// Название таблиц mysql
	//===============================================
	define("DB_ADMIN", DB_PREFIX."admin");
	define("DB_FORUMS", DB_PREFIX."forums");
	define("DB_FORUMS_POSTS", DB_PREFIX."forums_posts");
	define("DB_FORUMS_THREADS", DB_PREFIX."forums_threads");
	define("DB_LOGIN_FAILED", DB_PREFIX."login_failed");
	define("DB_LOGS", DB_PREFIX."logs");
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
	define("INCLUDE", BASEDIR."include/");
	define("MODULE", BASEDIR."module/");
	define("PANELS", BASEDIR."panels/");
	define("THEMES", BASEDIR."themes/");
?>