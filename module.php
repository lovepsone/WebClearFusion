<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2012 lovepsone
+--------------------------------------------------------+
| Filename: module.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	$temp = opendir(MODULE); $module_list = array();
	while ($folder = readdir($temp))
		{
			if (!in_array($folder, array(".","..")) && strstr($folder, "_module"))
				{
					if (is_dir(MODULE.$folder)) { $module_list[] = $folder; }
				}
		}
	closedir($temp);

	if (count($module_list) > 0) 
		{
			sort($module_list); array_unshift($module_list, "none");
		}

	$modules = array();
	for ($i=0;$i < count($module_list);$i++)
		{
			if ($module_list[$i] != "none")
				{
					$modules[$module_list[$i]] = MODULE.$module_list[$i]."/";
					require MODULE.$module_list[$i]."/core.php";
				}
		}
?>
