﻿<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: conf.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

//==================================================================
// База мира (mangos)
//==================================================================
$m_ip = 	'127.0.0.1';
$m_userdb = 	'mangos';
$m_pw = 	'mangos';
$m_db = 	'mangos';

//==================================================================
// База сайта (WCF)
//==================================================================
$w_ip = 	'127.0.0.1';
$w_userdb = 	'mangos';
$w_pw = 	'mangos';
$w_db = 	'wcf';

//==================================================================
// База реалм (realmd)
//==================================================================
$r_ip = 	'127.0.0.1';
$r_userdb = 	'mangos';
$r_pw = 	'mangos';
$r_db = 	'realmd';

//==================================================================
// База персанажей (characters)
//==================================================================
$c_ip = 	'127.0.0.1';
$c_userdb = 	'mangos';
$c_pw = 	'mangos';
$c_db = 	'characters';

//==================================================================
// Прочие настройки (название, язык en\ru, кодировка utf8\cp1251)
//==================================================================
$namesite =	'World of warcraft';
$lang = 	'ru';
$encoding = 	'utf8';

//==================================================================
// Выбор темы по умолчанию (default)
//==================================================================
$theme = 	'default';

//error_reporting(E_ERROR | E_PARSE | E_WARNING);
error_reporting(E_ALL);
ini_set('display_errors', 0); //disable on production servers!

//==================================================================
// Подключенные модули
//==================================================================
$modules=array();

//==================================================================
// дальнейшая настройка в module/module_cfg.php
//==================================================================
include("modules/module_cfg.php");
?>
