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
	define("DB_ACHIEVEMENT", DB_PREFIX."achievement");
	define("DB_ACHIEVEMENT_CAT", DB_PREFIX."achievement_category");
	define("DB_ACHIEVEMENT_CRIT", DB_PREFIX."achievement_criteria");
	define("DB_ACP_PANELS", DB_PREFIX."acp_panels");
	define("DB_ADMIN", DB_PREFIX."admin");
	define("DB_CHR_CLASSES", DB_PREFIX."chr_classes");
	define("DB_CHR_RACES", DB_PREFIX."chr_races");
	define("DB_COMMENTS", DB_PREFIX."comments");
	define("DB_CREATURE_FAMILY", DB_PREFIX."creature_family");
	define("DB_CREATURE_SPELLS", DB_PREFIX."creature_spells");
	define("DB_CREATURE_TYPE", DB_PREFIX."creature_type");
	define("DB_FACTION", DB_PREFIX."faction");
	define("DB_FACTION_FACTION_TEMPLATE", DB_PREFIX."faction_template");
	define("DB_FORUMS", DB_PREFIX."forums");
	define("DB_FORUMS_POSTS", DB_PREFIX."forums_posts");
	define("DB_FORUMS_THREADS", DB_PREFIX."forums_threads");
	define("DB_GEMPROPERTIES", DB_PREFIX."gemproperties");
	define("DB_GLYPHPROPERTIES", DB_PREFIX."glyphproperties");
	define("DB_ITEM_ENCHANT", DB_PREFIX."item_enchantment");
	define("DB_ITEM_EX_COST", DB_PREFIX."item_ex_cost");
	define("DB_ITEM_RANDOM_PROPETY", DB_PREFIX."item_random_propety");
	define("DB_ITEM_RANDOM_SUFFIX", DB_PREFIX."item_random_suffix");
	define("DB_ITEM_ICON", DB_PREFIX."itemicon");
	define("DB_ITEM_SET", DB_PREFIX."itemset");
	define("DB_LANGUAGES", DB_PREFIX."languages");
	define("DB_LOCK", DB_PREFIX."lock");
	define("DB_LOCK_TYPE", DB_PREFIX."lock_type");
	define("DB_LOGS", DB_PREFIX."logs");
	define("DB_LOCK_MAP", DB_PREFIX."map");
	define("DB_NAVIGATION_LINKS", DB_PREFIX."navigation_links");
	define("DB_NEWS", DB_PREFIX."news");
	define("DB_NEWS_CATS", DB_PREFIX."news_cats");
	define("DB_PANELS", DB_PREFIX."panels");
	define("DB_QUEST_INFO", DB_PREFIX."quest_info");
	define("DB_QUESTSORT", DB_PREFIX."quest_sort");
	define("DB_QUESTXP", DB_PREFIX."questxp");
	define("DB_PANELS", DB_PREFIX."random_property_points");
	define("DB_RATING", DB_PREFIX."rating");
	define("DB_SCALING_STAT_DISTRIBUTION", DB_PREFIX."scaling_stat_distribution");
	define("DB_SCALING_STAT_VALUES", DB_PREFIX."scaling_stat_values");
	define("DB_SETTINGS", DB_PREFIX."settings");
	define("DB_SKILL", DB_PREFIX."skill_line");
	define("DB_SKILL_ABILITY", DB_PREFIX."skill_line_ability");
	define("DB_SKILL_CAT", DB_PREFIX."skill_line_category");
	define("DB_SKILL_CLASS_INFO", DB_PREFIX."skill_race_class_info");
	define("DB_SPELL", DB_PREFIX."spell");
	define("DB_SPELL_CAST_TIME", DB_PREFIX."spell_cast_time");
	define("DB_SPELL_DISPEL_TYPE", DB_PREFIX."spell_dispel_type");
	define("DB_SPELL_DURATION", DB_PREFIX."spell_duration");
	define("DB_SPELL_RADIUS", DB_PREFIX."spell_radius");
	define("DB_SPELL_RANGE", DB_PREFIX."spell_range");
	define("DB_SPELL_SHAPESSHIFT", DB_PREFIX."spell_shapeshift");
	define("DB_SPELL_FOCUS", DB_PREFIX."spellfocus");
	define("DB_SPELL_ICON", DB_PREFIX."spellicon");
	define("DB_TALENT_TAB", DB_PREFIX."talent_tab");
	define("DB_TALENTS", DB_PREFIX."talents");
	define("DB_TEAM_CONTRIBUTION_POINTS", DB_PREFIX."teamcontributionpoints");
	define("DB_TOTEM_CAT", DB_PREFIX."totem_category");
	define("DB_USERS", DB_PREFIX."users");
	define("DB_ZONES", DB_PREFIX."zones");

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