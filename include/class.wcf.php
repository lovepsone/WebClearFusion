<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2012 lovepsone
+--------------------------------------------------------+
| Filename: clas.wcf.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

class WCF
{
	public static $debug = null;
	public static $settings = array();
	public static $mysql = array();
	public static $DB = null;
	public static $title = null;

	public static function InitializeWCF()
	{
		if(!@include(BASEDIR.'conf.php'))
		{
			die('<b>Error</b>: unable to load configuration file!');
		}
		if(!@require_once(BASEDIR.'include/class.mysql.php'))
		{
			die('<b>Error</b>: unable to load database class!');
		}
		if(!@require_once(BASEDIR.'include/class.debug.php'))
		{
			die('<b>Error</b>: unable to load debug class!');
        	}

		self::$mysql = $WCFConfig['mysql'];
		define("DB_PREFIX", self::$mysql['prefix']);
		self::$settings = $WCFConfig['settings'];
		self::$debug = new WCFDebug(array('useDebug' => self::$settings['useDebug'], 'logLevel' => self::$settings['logLevel']));
		self::$title = $WCFConfig['title'];

		if (self::$DB == null)
		{
			self::$DB = new WCFMYsql(self::$mysql['dbname'], self::$mysql['hostname'], self::$mysql['username'], self::$mysql['password'], self::$mysql['charset']);
		}

		
	}

	public static function Log()
	{
		return self::$debug;
	}
}

?>