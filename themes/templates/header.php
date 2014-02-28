<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2014 lovepsone
+--------------------------------------------------------+
| Filename: header.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	if (!defined("IN_WCF"))
		die("Access Denied");

	define("MAIN_PANEL", true);

	echo"<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Frameset//EN' 'http://www.w3.org/TR/html4/frameset.dtd'>";
	echo"<head><link rel='SHORTCUT ICON' href='".THEMES.WCF::$cfgSetting['theme']."/favicon.ico' />";
	echo"<title>".WCF::$cfgSetting['servername']."</title>";
	echo"<link href='".WCF::$cfgSetting['_cssfile']."' type=text/css rel=stylesheet />";
	echo"<meta http-equiv='content-type' content='text/html; charset=WCF::getEncodingPage()' />";
	echo"<script type='text/javascript' src='".INCLUDES."js/jquery-1.7.1.min.js'></script>";
	echo"<script type='text/javascript' src='".INCLUDES."js/jquery-ui-1.8.17.custom.min.js'></script>";
	echo"<script type='text/javascript' src='".INCLUDES."js/auth.js'></script>";
	echo"</head><body>";

	require_once THEMES."templates/panels.php";
	ob_start();
?>