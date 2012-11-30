<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2012 lovepsone
+--------------------------------------------------------+
| Filename: maincore.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	if (preg_match("/maincore.php/i", $_SERVER['PHP_SELF'])) { die(); }
	error_reporting(E_ALL);

	//=============================================================================================================
	// Запускаем сессию\Start the session
	//=============================================================================================================
	session_start();
	ob_start();

	//=============================================================================================================
	// Ищем conf.php и устанавливаем путь\Looking for conf.php and set the path
	//=============================================================================================================
	$folder_level = ""; $i = 0;
	while (!file_exists($folder_level."conf.php"))
	{
		$folder_level .= "../"; $i++;
		if ($i == 7) { die("Config file not found"); }
	}
	define("BASEDIR", $folder_level);

	//=============================================================================================================
	// Запускаем основные функции и классы\Run the basic functions and classes
	//=============================================================================================================
	if(!@include(BASEDIR.'include/class.wcf.php'))
		die('<b>Error:</b> unable to load WCF class!');
	
	WCF::InitializeWCF();

	if (@!include(BASEDIR.'include/defines.php'))
		die('<b>Error:</b> unable to load defines.php!');

	if(!@include(BASEDIR.'include/revision_nr.php'))
		die('<b>Error:</b> unable to load revision file!');

	//=============================================================================================================
	// Проверяем DbVersion,revision,config version\Check DbVersion,revision,config version
	//=============================================================================================================
	$dbVersion = WCF::$DB->db_assoc(WCF::$DB->db_query("SELECT * FROM ".DB_VERSIONS));
	$dbVer = $dbVersion['version'];
	$errorDBVersion = sprintf('Current version is %s but expected %s.<br />
		Apply all neccessary updates from \'sql/updates\' folder and refresh this page.',($dbVer) ? "'" . $dbVer . "'" : 'not defined', "'" . DB_VERSION . "'");
	if($dbVersion['version'] != DB_VERSION)
		die($errorDBVersion);

	if(!defined('WCF_REVISION'))
		die('<b>Revision error:</b> unable to detect WCF revision!');

	if(!defined('CONFIG_VERSION') || !isset(WCF::$settings['configVersion']))
		die('<b>ConfigVersion error:</b> unable to detect Configuration version!');

	//=============================================================================================================
	// Предотвращения возможных атак через XSS $_GET.
	//=============================================================================================================
	if (WCF::stripget($_GET)) { die("Prevented a XSS attack through a GET variable!"); }

// временно подгружаем остальное
require BASEDIR."include/functions_theme.php";
require BASEDIR."include/functions_users.php";
require BASEDIR."include/functions_page.php";
require BASEDIR."include/functions_img.php";

	//=============================================================================================================
	// глобальные переменные и константы\Run the setup
	//=============================================================================================================
	$_SERVER['QUERY_STRING'] = isset($_SERVER['QUERY_STRING']) ? WCF::cleanurl($_SERVER['QUERY_STRING']) : "";
	$_SERVER['PHP_SELF'] = WCF::cleanurl($_SERVER['PHP_SELF']);

	define("IN_WCF", TRUE);
	define("WCF_QUERY", isset($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : "");
	define("WCF_SELF", basename($_SERVER['PHP_SELF']));

	//=============================================================================================================
	// Запускаем настройки\Run the setup
	//=============================================================================================================
	$result = WCF::$DB->db_query("SELECT * FROM ".DB_SETTINGS);
	if ($result)
	{
		while ($data = WCF::$DB->db_array($result))
		{
			WCF::$settings[$data['settings_name']] = $data['settings_value'];
		}
	}

	else { die("Settings do not exist or no connection to base mysql. May not correctly configured conf.php."); }

	//=============================================================================================================
	// Проверка на стандартные панели\Check for standard panels
	//=============================================================================================================
	$result = WCF::$DB->db_query("SELECT `panel_status` FROM ".DB_PANELS." WHERE `panel_filename`='user_info_panel'");
	if(WCF::$DB->db_num_rows($result) == 0)
		die('<b>Panel error:</b> the DB is not the standard panel[user_info_panel]');
	$data = WCF::$DB->db_assoc($result);
	if($data['panel_status'])
		die('<b>Panel error:</b> user_info_panel panel not included');

	//=============================================================================================================
	// Выбор нужной кодировки\When choosing a character encoding
	//=============================================================================================================
	if (WCF::$settings['encoding'] == 'cp1251') { WCF::$settings['code_page'] = 'windows-1251'; } else { WCF::$settings['code_page'] = 'utf-8'; }

	//=============================================================================================================
	// Выбор нужного языка\Choosing the right language
	//=============================================================================================================
	//if (isset($_GET['lang'])) { $config['lang'] = $_GET['lang']; } else { $_SESSION['lang'] = $config['lang']; }
	//if ($config['lang']) { require BASEDIR."lang/".$config['lang']."/".$config['encoding']."/text.php"; }
	require BASEDIR."lang/".WCF::$settings['lang']."/".WCF::$settings['encoding']."/text.php";

	//=============================================================================================================
	// Установка нужной темы\Setting the right topic
	//=============================================================================================================
	WCF::$settings['themefile'] = THEMES.WCF::$settings['theme']."/theme.php";
	WCF::$settings['cssfile'] = THEMES.WCF::$settings['theme']."/style.css";

	if (!file_exists(WCF::$settings['themefile']) && !file_exists(WCF::$settings['cssfile']))
	{
		WCF::Log()->writeError('maincore: unable to load [themefile:%s] and [cssfile:%s]',WCF::$settings['themefile'],WCF::$settings['cssfile']);
		WCF::$settings['themefile'] = THEMES."default/theme.php";
		WCF::$settings['cssfile'] = THEMES."default/style.css";

	}
	@include(WCF::$settings['themefile']);

	//=============================================================================================================
	// подгружаем остальное\To loading
	//=============================================================================================================
	if(!@include(BASEDIR.'include/class.auth.php'))
		die('<b>Error:</b> unable to load Auth class!');
	else
		$AUTH = new WCFAuth();

	if (isset($_POST['auth_name']) && isset($_POST['auth_pass'])) 
   	{
		$AUTH->username = $_POST['auth_name'];
		$AUTH->password = $_POST['auth_pass'];

		if(WCF::$settings['kcaptcha_enable_auth'] == 1)
			$AUTH->post_kcaptcha = $_POST['kapcha_code'];
		if($AUTH->AuthUser())
			WCF::redirect("http://".$_SERVER['HTTP_HOST']."/setuser.php?action=auth");
		else
			WCF::redirect("http://".$_SERVER['HTTP_HOST']."/setuser.php?action=error");
	}

	//=============================================================================================================
	// Подключаем модули\Include in modules
	//=============================================================================================================
	require_once BASEDIR."module.php";
?>