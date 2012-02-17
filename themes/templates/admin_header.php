<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2012 lovepsone
+--------------------------------------------------------+
| Filename: admin_header.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	if (!defined("IN_WCF")) { die("Access Denied"); }

	define("ADMIN_PANEL", true);

	echo"<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Frameset//EN' 'http://www.w3.org/TR/html4/frameset.dtd'>";
	echo"<head><link rel='SHORTCUT ICON' href='".IMAGES."favicon.ico' />";
	echo"<title>".$config['servername']."</title>";
	echo"<link href='".$cssfile."' type=text/css rel=stylesheet />";
	echo"<link href='".THEMES."templates/wcf.css' type=text/css rel=stylesheet />";
	echo"<link href='".THEMES."templates/cs_powered.css' type=text/css rel=stylesheet />";
	echo"<meta http-equiv='content-type' content='text/html; charset=$code_page' />";
	echo"<script type='text/javascript' src='".INCLUDES."js/jscript.js'></script>";
	echo"<script type='text/javascript' src='".INCLUDES."js/utils.js'></script>";
	echo"<script type='text/javascript' src='".INCLUDES."js/ajax.js'></script>";
	echo"</head><body>";

	require_once THEMES."templates/panels.php";
	ob_start();
?>