<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2012 lovepsone
+--------------------------------------------------------+
| Filename: multi_site.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	//===============================================
	// Название таблиц mysql
	//===============================================
	define("DB_ACP_PANELS", DB_PREFIX."acp_panels");
	define("DB_ADMIN", DB_PREFIX."admin");
	define("DB_CHR_CLASSES", DB_PREFIX."chr_classes");
	define("DB_CHR_RACES", DB_PREFIX."chr_races");
	define("DB_COMMENTS", DB_PREFIX."comments");
	define("DB_CREATURE_FAMILY", DB_PREFIX."creature_family");
	define("DB_FORUMS", DB_PREFIX."forums");
	define("DB_FORUMS_POSTS", DB_PREFIX."forums_posts");
	define("DB_FORUMS_THREADS", DB_PREFIX."forums_threads");
	define("DB_ITEM_ICON", DB_PREFIX."itemicon");
	define("DB_LOGS", DB_PREFIX."logs");
	define("DB_NAVIGATION_LINKS", DB_PREFIX."navigation_links");
	define("DB_NEWS", DB_PREFIX."news");
	define("DB_NEWS_CATS", DB_PREFIX."news_cats");
	define("DB_PANELS", DB_PREFIX."panels");
	define("DB_SETTINGS", DB_PREFIX."settings");
	define("DB_SPELL", DB_PREFIX."spell");
	define("DB_SPELL_DURATION", DB_PREFIX."spell_duration");
	define("DB_TALENT_TAB", DB_PREFIX."talent_tab");
	define("DB_TALENTS", DB_PREFIX."talents");
	define("DB_SPELL_ICON", DB_PREFIX."spellicon");
	define("DB_USERS", DB_PREFIX."users");

	//===============================================
	// Пути определения папок
	//===============================================
	define("ACP", BASEDIR."acp/");
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
	define("LANG", BASEDIR."lang/");
	define("PANELS", BASEDIR."panels/");
	define("THEMES", BASEDIR."themes/");
?>