<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2013 lovepsone
+--------------------------------------------------------+
| Filename: class.wcf.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

class WCF
{
	public static $cfgSetting = array();
	public static $cfgMySql = array();
	public static $framework = null;
	public static $DEBUG = null;
	public static $templating = null;
	public static $DB = null;

	public static function InitWCF()
	{
		if(!@include(BASEDIR.'conf.php'))
			die('<b>Error</b>: unable to load configuration file!');
		if(!@include(BASEDIR.'include/DbSimple/Generic.php'))
			die('<b>Error</b>: unable to load DbSimple lib!');

		self::$cfgSetting = $WCFConfig['settings'];
		self::$cfgMySql = $WCFConfig['mysql'];
		self::$DB = DbSimple_Generic::connect("mysql://".self::$cfgMySql['username'].":".self::$cfgMySql['password']."@".self::$cfgMySql['hostname']."/".self::$cfgMySql['dbname']);
	}
}
?>