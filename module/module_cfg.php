<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: module_cfg.php
| Author: lovepsone, Кот_ДаWINчи
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

/*-------------------------------------------------------+
| (ru): при редактировании файла, файл нужно сохранять
| в кодировке UTF-8 без BOM
| (en): when editing a file, the file must be saved
| in utf-8 encoding with no BOM
+--------------------------------------------------------*/

//==================================================================
// Здесь подключаются модули и выставляются их настройки
//==================================================================

/*-------------------------------------------------------+
| 
| (ru) Доступ пользователей к модулям :
| -1 - доступ всем (гостям)
| 0 - игрокам
| 1 - модерам
| 2 - ГМ-ам
| 3 - Админам
| 4 - Супер админу (консоль)
| 100 - не доступен
|
| (en) User access to the modules:
| -1 - Access to all (the guests)
| 0 - players
| 1 - Modera
| 2 - GM-am
| 3 - admin
| 4 - Super admin (console)
| 100 - not available
+--------------------------------------------------------*/

$modules  = array (
//       modul\модуль             path\путь                          Name\имя      Access\доступ    	Admin\админ   Menu\меню 
	'logout'   	=> array ('module/logout/logout.php',        	257,           	-1,     	     3,   	  0  ),

// модули для админки\modules for admin
	'admin'		=> array ('administration/admin.php',		257,             1,     	     3,   	  0  ),
	'settings'	=> array ('administration/settings_main.php',	257,             1,     	     3,   	  0  ),

// модули для логов\modules for logs
	'reg'     	=> array ('module/reg/reg.php',			reg,            -1,     	     3,   	  0  ),
	'alllogs'       => array ('module/logs/alllogs.php',		257,             1,     	     3,   	  0  ),

// модули для новостей\modules for news
	'news'     	=> array ('module/news/news.php',		news,           -1,     	     3,   	  1  ),
	'newsext'     	=> array ('module/news/news_ext.php',		257,            -1,     	     3,   	  0  ),
	'newsedit'	=> array ('administration/news.php',		257,             1,     	     3,   	  0  ),

// форум\forum
	'forum'       => array ('forum/forum.php',			forum,          -1,     	     3,   	  1  ),
	'thread'      => array ('forum/forum_threads.php',		257,            -1,     	     3,   	  0  ),
	'post'        => array ('forum/forum_posts.php',		257,            -1,     	     3,   	  0  ),
);
?>