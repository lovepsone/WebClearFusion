<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2014 lovepsone
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
	define("ADMIN", BASEDIR."administration/");
	define("FORUM", BASEDIR."forum/");
	define("IMAGES", BASEDIR."images/");
	define("IMAGES_N", BASEDIR."images/news/");
	define("IMAGES_NC", BASEDIR."images/news_cat/");
	define("IMAGES_A", BASEDIR."images/avatars/");
	define("INCLUDES", BASEDIR."include/");
	define("LANG", BASEDIR."lang/");
	define("MODULE", BASEDIR."module/");
	define("PANELS", BASEDIR."panels/");
	define("THEMES", BASEDIR."themes/");

	//=============================================================================================================
	// Запускаем основные функции и многоузловое определение\Run the basic functions and determination of multisite
	//=============================================================================================================
	if(!@include(BASEDIR.'include/class.wcf.php'))
		die("<b>Error:</b> can not open class.wcf.php!!!");

	WCF::InitWCF();

	function databaseErrorHandler($message, $info)
	{
		if (!error_reporting())
			return;
		echo "SQL Error: $message<br><pre>";
		print_r($info);
		echo "</pre>";
		exit();
	}

	$logsdb = "";
	function DBLogger($db, $sql)
	{
		global $logsdb;
		$logsdb .= $sql.'<br>';
	}

	WCF::$DB->setErrorHandler('databaseErrorHandler');
	WCF::$DB->setLogger('DBLogger');


	//=============================================================================================================
	// Предотвращения возможных атак через XSS $_GET.
	//=============================================================================================================
	if (WCF::stripget($_GET))
		die("Prevented a XSS attack through a GET variable!");

	// временно пока движок не перейдет на новые рельсы
	@include(BASEDIR.'include/functions_users.php');
	@include(BASEDIR.'include/functions_page.php');
	@include(BASEDIR.'include/include_access_list.php');
	@include(BASEDIR.'include/functions_files.php');

	//=============================================================================================================
	// глобальные переменные и константы\Run the setup
	//=============================================================================================================
	$_SERVER['QUERY_STRING'] = isset($_SERVER['QUERY_STRING']) ? WCF::cleanurl($_SERVER['QUERY_STRING']) : "";
	$_SERVER['PHP_SELF'] = WCF::cleanurl($_SERVER['PHP_SELF']);

	define("IN_WCF", TRUE);
	define("WCF_QUERY", isset($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : "");
	define("WCF_SELF", basename($_SERVER['PHP_SELF']));

	// Calculate current true url
	$script_url = explode("/", $_SERVER['PHP_SELF']);
	$url_count = count($script_url);
	$base_url_count = substr_count(BASEDIR, "/") + 1;
	$current_page = "";
	while ($base_url_count != 0)
	{
		$current = $url_count - $base_url_count;
		$current_page .= "/".$script_url[$current];
		$base_url_count--;
	}

	define("TURE_WCF_SELF", $current_page);
	define("START_PAGE", substr(preg_replace("#(&amp;|\?)(s_action=edit&amp;shout_id=)([0-9]+)#s", "", TURE_WCF_SELF.(WCF_QUERY ? "?".WCF_QUERY : "")), 1));

	//=============================================================================================================
	// auth
	//=============================================================================================================
	if(!@include(BASEDIR.'include/class.Auth.php'))
		die("<b>Error:</b> can not open class.Auth.php!!!");
	$USER = array();

	if (isset($_POST['auth_name']) && isset($_POST['auth_pass']))
   	{
		$AuthUser = new Auth($_POST['auth_name'], $_POST['auth_pass']);
		$USER = $AuthUser->getDataUser();
		unset($AuthUser, $_POST['auth_name'], $_POST['auth_pass']);
		WCF::redirect(WCF::$cfgSetting['opening_page']);
	}
	else if(isset($_GET['action']) && $_GET['action'] == "logout")
	{
		$USER = Auth::logOutUser();
		WCF::redirect(WCF::$cfgSetting['opening_page']);
	}
	else
	{
		$USER = Auth::DataAuthUser();
	}

	//=============================================================================================================
	// Установка нужной темы\Setting the right topic
	//=============================================================================================================
	WCF::$cfgSetting['_cssfile'] = THEMES.WCF::$cfgSetting['theme']."/style.css";
	WCF::$cfgSetting['_themefile'] = THEMES.WCF::$cfgSetting['theme']."/theme.php";

	if (file_exists(WCF::$cfgSetting['_themefile']))
	{
		include(WCF::$cfgSetting['_themefile']);
	}
	else
	{
		include(THEMES."default/theme.php");
	}

	if (!file_exists(WCF::$cfgSetting['_cssfile']))
	{
		WCF::$cfgSetting['_cssfile'] = THEMES."default/style.css";
	}

?>