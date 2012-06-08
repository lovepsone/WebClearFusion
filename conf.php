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
	$config = array();
	//==================================================================
	// База сайта (wcf)
	//==================================================================
	$config_db_connect['whostname'] = '127.0.0.1';
	$config_db_connect['wusername'] = 'mangos';
	$config_db_connect['wpassword'] = 'mangos';
	$config_db_connect['wdbname']= 'wcf';

	//==================================================================
	// encoding
	//==================================================================
	$config['encoding'] = 'utf8';
	$config['errors_reporting'] = '1';

	//==================================================================
	// debugs
	//==================================================================	
	$config['useDebug'] = true;
	$config['logLevel'] = 3;

	//==================================================================
	// Ревизия и копирайт wcf (запрещается менять)
	//==================================================================
	$config['copyright'] = 'WebClearFusion v 0.5.00 from LovePSone 2010-2011';
	$config['revision'] = 'wcf_revision_nr = [354]';
	$config['rev_admin'] = ' 0.02.00';

	define("DB_PREFIX", "wcf_");
?>