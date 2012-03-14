<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2012 lovepsone
+--------------------------------------------------------+
| Filename: conf.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	$config_db_connect = array();
	//==================================================================
	// База сайта (wcf)
	//==================================================================
	$config_db_connect['whostname'] = '127.0.0.1';
	$config_db_connect['wusername'] = 'mangos';
	$config_db_connect['wpassword'] = 'mangos';
	$config_db_connect['wdbname']= 'wcf';

	$config = array(
	//==================================================================
	// encoding
	//==================================================================
	'encoding' => 'utf8',
	'use_tab_mode' => '1',          // Tabbed report mode (cswowd)
	'talent_calc_max_level' => '80',
	'errors_reporting' => '1',
	
	//==================================================================
	// Тип wcf: 0 - обычный,
	// 1 - поддержка World of Warcraft LK(mangos)
	// 2 - поддержка World of Warcraft LK(trynity)(пока не поддерживается) 
	//==================================================================
	'type_server' => '1',
	
	//==================================================================
	// Ревизия и копирайт wcf (запрещается менять)
	//==================================================================
	'copyright' => 'WebClearFusion v 0.4.63 from LovePSone 2010-2011',
	'revision' => 'wcf_revision_nr = [280]',
	'rev_admin' => ' 0.02.00',
	'rev_acp' => ' 0.02.00'
	);

	define("DB_PREFIX", "wcf_");

	//==================================================================
	// дополнительно подключаем модули
	//==================================================================
	if ($config['type_server'] = '1' || $config['type_server'] = '2')
		{
			require_once "contentwow/realmlist.php";
		}
?>