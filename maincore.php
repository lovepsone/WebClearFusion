<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2013 lovepsone
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

	function DBLogger($db, $sql)
	{
		WCF::Log()->writeRows('%s\n', $sql);	
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
	@include(BASEDIR.'include/functions_img.php');
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
		WCF::Log()->writeError('Can not loading %s',WCF::$cfgSetting['_themefile']);
		include(THEMES."default/theme.php");
	}

	if (!file_exists(WCF::$cfgSetting['_cssfile']))
	{
		WCF::Log()->writeError('Can not loading %s', WCF::$cfgSetting['_cssfile']);
		WCF::$cfgSetting['_cssfile'] = THEMES."default/style.css";
	}

	//=============================================================================================================
	// Подключаем модули\Include in modules
	//=============================================================================================================
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
			//require MODULE.$module_list[$i]."/core.php";
		}
	}

	//=============================================================================================================
	// Инициализируем framework\Initialize the framework
	//=============================================================================================================
	WCF::InitFW();

	//=============================================================================================================
	// auth
	//=============================================================================================================

	$CapchaInput = check_kcaptcha_enable();

	if (isset($_POST['auth_name']) && $_POST['auth_name'] != "") 
   	{
		$password = SHA1(strtoupper(addslashes($_POST['auth_name']).':'.addslashes($_POST['auth_pass'])));

   		$row = WCF::$DB->selectRow('SELECT * FROM ?_users WHERE `user_name` = ? AND `user_sha_pass_hash` = ?',strtoupper(addslashes($_POST['auth_name'])), $password);

		if ($row != null && $CapchaInput == 1)
		{
		       	$_SESSION['user_id'] = (int)$row['user_id'];
		       	$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
		       	$_SESSION['user_name'] = strtoupper($_POST['auth_name']);
		       	$_SESSION['password'] = strtoupper($password);
			$_SESSION['gmlevel'] = (int)$row['user_gmlevel'];
			$_SESSION['bonuses'] = (int)$row['user_bonuses'];
		       	$_SESSION['lang'] = WCF::$cfgSetting['lang'];
			$_SESSION['user_avatar'] = $row['user_avatar'];
			unset($_SESSION['captcha_keystring']);
			WCF::redirect("http://".$_SERVER['HTTP_HOST']."/setuser.php?action=auth");
		}
		else
		{
			WCF::redirect("http://".$_SERVER['HTTP_HOST']."/setuser.php?action=error");
		}
			
   	}
?>