<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2012 lovepsone
+--------------------------------------------------------+
| Filename: functions_page.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	//=============================================================================================
	// функция, показывающая доступ
	function display_access_form($access)
		{
  			switch ($access):

  			case (-1): $result = WCF::$locale['genl']; break;
  			case (0): $result = WCF::$locale['user']; break;
  			case (1): $result = WCF::$locale['moderator']; break;
  			case (2): $result = WCF::$locale['vebmaster']; break;
  			case (3): $result = WCF::$locale['administrator']; break;
  			case (4): $result = WCF::$locale['superadministrator']; break;

  			endswitch;

			return $result;
		}

	//=============================================================================================
	// функция чтения элементов каталога и заносит их в массив
	function admin_files_page($patch)
		{
			$temp = opendir($patch);
			while (false !== ($file = readdir($temp)))
				{ 
					if (!in_array($file, array(".","..")) && !strstr($file, "_")) { $file_list[] = $file; }
				}
			closedir($temp); sort($file_list);
			return $file_list;
		}
?>