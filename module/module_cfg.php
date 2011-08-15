<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: module_cfg.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

$modules  = array (
//       modul                path                        Name    Access  Admin Menu
	'login'    => array ('include/authpanel.php',      257,     -1,     3,   0  ),
);

/*
Доступ пользователей к модулям:
-1 - доступ всем (гостям)
0 - игрокам
1 - модерам
2 - ГМ-ам
3 - Админам
4 - Супер админу (консоль)
100 - не доступен
*/
?>