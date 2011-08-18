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
	'login'   	=> array ('include/authpanel.php',           257,           -1,     	     3,   	  0  ),
	'news'     	=> array ('module/news/news.php',              5,           -1,     	     3,   	  1  ),
	'reg'     	=> array ('module/reg/reg.php',                5,           -1,     	     3,   	  1  ),

// модули для админки\modules for admin
	'admin'   	=> array ('module/admin/admin.php',           16,            1,     	     3,   	  0  ),
	'adminmenu'     => array ('module/admin/adminmenu.php',      257,            1,     	     3,   	  0  ),

// модули для логов\modules for admin
	'alllogs'       => array ('module/logs/alllogs.php',         257,            1,     	     3,   	  0  ),
	'reglogs'       => array ('module/logs/reglogs.php',         257,            1,     	     3,   	  0  ),
);

//==================================================================
// Модуль по умолчанию
//==================================================================
$config['default_module'] = 'online';

//==================================================================
// Вкл\Выкл (on\off) Модуль востоновления пороля
//==================================================================
$config['pass_remember'] = 'on';

//==================================================================
// Лимит на регу с одного ip-адреса (если "0" - то бесконечно)
//==================================================================
$config['reg_ip_limit'] = '0';
?>