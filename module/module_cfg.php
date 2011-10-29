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
//       modul\модуль             path\путь                        Name\имя    Access\доступ    Admin\админ     Menu\меню
	'online'  	=> array ('module/online/online.php',        257,           -1,     	     3,   	  0  ),  
	'logout'   	=> array ('module/logout/logout.php',        257,           -1,     	     3,   	  0  ),
	'changelang'   	=> array ('module/more/change_lang.php',     257,           -1,     	     3,   	  0  ),

// модули для админки\modules for admin
	'adminmenu'     => array ('administration/admin_menu.php',     257,            1,     	     3,   	  0  ),
	'adminmodule'   => array ('administration/admin_module.php',   257,            1,     	     3,   	  0  ),
	'adminsetpanel' => array ('administration/admin_setpanel.php', 257,            1,     	     3,   	  0  ),
	'adminaddpanel' => array ('administration/admin_addpanel.php', 257,            1,     	     3,   	  0  ),

// модули для логов\modules for logs
	'reg'     	=> array ('module/reg/reg.php',              reg,           -1,     	     3,   	  0  ),
	'alllogs'       => array ('module/logs/alllogs.php',         257,            1,     	     3,   	  0  ),
	'reglogs'       => array ('module/logs/reglogs.php',         257,            1,     	     3,   	  0  ),

// модули для новостей\modules for news
	'news'     	=> array ('module/news/news.php',           news,           -1,     	     3,   	  1  ),
	'newsadd'    	=> array ('administration/news_add.php',     257,            1,     	     3,   	  0  ),
	'newsedit'      => array ('administration/news_edit.php',    257,            1,     	     3,   	  0  ),
	'newsdel'       => array ('administration/news_del.php',     257,            1,     	     3,   	  0  ),

// форум\forum
	'forum'       => array ('forum/forum.php',            	   forum,           -1,     	     3,   	  1  ),
	'thread'      => array ('forum/forum_threads.php',           257,           -1,     	     3,   	  0  ),
	'post'        => array ('forum/forum_posts.php',             257,           -1,     	     3,   	  0  ),
);

//==================================================================
// Модуль по умолчанию
//==================================================================
$config['default_module'] = 'news';

//==================================================================
// Вкл\Выкл (on\off) Модуль востоновления пороля
//==================================================================
$config['pass_remember'] = 'on';

//==================================================================
// Лимит на регу с одного ip-адреса (если "0" - то бесконечно)
//==================================================================
$config['reg_ip_limit'] = '0';

//==================================================================
// Колличество новостей на одной странице
//==================================================================
$config['page_news']    =  5;
$config['page_news_edit']   = 20;
$config['page_news_del']   = 20;

//==================================================================
// Вкл\Выкл (on\off) форму смена зыков 
//==================================================================
$config['change_lang'] = 'on';

//==================================================================
// Колличество тем в разделе форума на одной странице
//==================================================================
$config['page_forum_threads'] = 10;
//==================================================================
// Колличество сообщений в теме форума на одной странице
//==================================================================
$config['page_forum_posts'] = 10;
?>