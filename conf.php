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
	'revision' => 'wcf_revision_nr = [273]',
	'rev_admin' => ' 0.02.00',
	'rev_acp' => ' 0.02.00'
	);

	define("DB_PREFIX", "wcf_");

	//==================================================================
	// далее скриптовка на поддержку сервера(мультиреалмость)
	//==================================================================
	if (isset($_SESSION['realmd_id']))
		{
			$r_id = $_SESSION['realmd_id'];
		}
	elseif (isset($_GET['realm_id']) && isnum($_GET['realm_id']))
		{
			$r_id = addslashes($_GET["realm_id"]);
		}
	else
		{
			$r_id = 1;
		}
	if ($config['type_server'] = '1' || $config['type_server'] = '2')
		{
			require_once "contentwow/realmlist.php";

			//==================================================================
			// База мира (mangos)
			//==================================================================
			$config_db_connect['hostname'] = $realms[$r_id]['hostname'];
			$config_db_connect['username'] = $realms[$r_id]['username'];
			$config_db_connect['password'] = $realms[$r_id]['password'];
			$config_db_connect['dbname'] = $realms[$r_id]['dbname'];
		
			//==================================================================
			// База персанажей (characters)
			//==================================================================
			$config_db_connect['chostname'] = $realms[$r_id]['chostname'];
			$config_db_connect['cusername'] = $realms[$r_id]['cusername'];
			$config_db_connect['cpassword'] = $realms[$r_id]['cpassword'];
			$config_db_connect['cdbname'] = $realms[$r_id]['cdbname'];
		}
?>