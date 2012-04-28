<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2012 lovepsone
+--------------------------------------------------------+
| Filename: show_maincore.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	//=============================================================================================================
	// »щем conf.php и устанавливаем путь\Looking for conf.php and set the path
	//=============================================================================================================
	$folder_lvl = ""; $m = 0;
	while (!file_exists($folder_lvl."maincore.php"))
		{
			$folder_lvl .= "../"; $m++;
			if ($m == 10) { die("maincore.php file not found"); }
		}
	require_once $folder_lvl."maincore.php";
?>