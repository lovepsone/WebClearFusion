<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2012 lovepsone
+--------------------------------------------------------+
| Filename: include_files.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	//=============================================================================================================
	// Запускаем дополнительные функции и данные\Run additional features and data
	//=============================================================================================================
	require_once BASEDIR."include/include_simple_cacher.php";
	require_once CONTENT_WOW."include/functions.php";
	require_once CONTENT_WOW."include/include_item_table.php";
	require_once CONTENT_WOW."include/include_player_data.php";
	require_once CONTENT_WOW."include/include_spell_data.php";
	require_once CONTENT_WOW."include/include_spell_details.php";
	require_once CONTENT_WOW."include/include_spell_table.php";
	require_once CONTENT_WOW."include/include_report_generator.php";
	require_once CONTENT_WOW."include/ajax_tooltip.php";
	require_once CONTENT_WOW."include/include_talent_calc.php";
	require_once CONTENT_WOW."include/include_talent_table.php";

	function include_files_cw($patch)
		{
			global $config, $txt;

			if ($config['type_server'] = '1' || $config['type_server'] = '2')
				{
					require_once CONTENT_WOW.$patch;
				}
			/*else
				{
					
				}*/
			return;
		}

?>