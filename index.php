<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: index.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	//=============================================================================================================
	// Запускаем сессию\Start the session
	//=============================================================================================================
	session_start();

	//=============================================================================================================
	// Ищем conf.php и устанавливаем путь\Looking for conf.php and set the path
	//=============================================================================================================
	$folder_level = ""; $i = 0;
	while (!file_exists($folder_level."conf.php"))
		{
			$folder_level .= "../"; $i++;
			if ($i == 7) { die("Config file not found"); }
		}
	require_once $folder_level."conf.php";
	define("BASEDIR", $folder_level);
	//=============================================================================================================
	// Запускаем основные функции и многоузловое определение\Run the basic functions and determination of multisite
	//=============================================================================================================
	require_once BASEDIR."include/functions.php";
	require_once BASEDIR."include/multisite.php";

	//=============================================================================================================
	// Запускаем настройки\Run the setup
	//=============================================================================================================
	selectdb(wcf);
	$result = mysql_query("SELECT * FROM ".DB_SETTINGS."") or trigger_error(mysql_error());
	if ($result)
		{
			while ($data = mysql_fetch_array($result))
				{
					$config[$data['settings_name']] = $data['settings_value'];
				}
		}
	else { die("Settings do not exist or no connection to base mysql. May not correctly configured conf.php."); }

	require_once BASEDIR."include/auth.php";
	require_once BASEDIR."include/protect.php";

	//=============================================================================================================
	// Выбор нужной кодировки\When choosing a character encoding
	//=============================================================================================================
	if ($config['encoding'] == 'cp1251') $code_page = 'windows-1251';
   		else $code_page = 'utf-8';

	//=============================================================================================================
	// Выбор нужного языка\Choosing the right language
	//=============================================================================================================
	if (isset($_GET['lang'])) $config['lang'] = $_GET['lang'];
       					$_SESSION['lang'] = $config['lang'];

	if ($config['lang'] == 'en') require "lang/text.".$config['lang'].".".$config['encoding'].".php";
              else require "lang/text.".$config['lang'].".".$config['encoding'].".php";

	//=============================================================================================================
	//Установка нужной темы\Setting the right topic
	//=============================================================================================================
	$cssfile = THEMES.$config['theme']."/style.css";
	$csswcffile = THEMES.$config['theme']."/wcf.css";
	$themefile = THEMES.$config['theme']."/theme.php";

	if (file_exists($themefile)) include($themefile);
   		else include(THEMES."default/theme.php");

?>