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
	public static $cfgTitle = array();
	public static $FW = null; 		// framework
	public static $TF = null; 		// TextFormatting
	private static $DEBUG = null; 		// WCFDebug
	public static $templating = null;
	public static $DB = null; 		// DbSimple
	public static $locale = array(); 	// txt

	public static function InitWCF()
	{
		if(!@include(BASEDIR.'conf.php'))
			die('<b>Error</b>: unable to load configuration file!');
		if(!@include(BASEDIR.'include/DbSimple/Generic.php'))
			die('<b>Error</b>: unable to load DbSimple lib!');
		if(!@include(BASEDIR.'include/class.TextFormatting.php'))
			die('<b>Error</b>: unable to load TextFormatting file!');
		if(!@require_once(BASEDIR.'include/class.debug.php'))
			die('<b>Error</b>: unable to load debug file!');
	
		self::$cfgSetting = $WCFConfig['settings'];
		self::$cfgMySql = $WCFConfig['mysql'];
		self::$cfgTitle = $WCFConfig['title'];

		self::$DB = DbSimple_Generic::connect("mysql://".self::$cfgMySql['username'].":".self::$cfgMySql['password']."@".self::$cfgMySql['hostname']."/".self::$cfgMySql['dbname']);
		self::$DB->setIdentPrefix(DB_PREFIX);
		self::$DB->query('SET NAMES ?', self::$cfgMySql['charset']);

		//load settings
		$rows = self::$DB->select(' -- CACHE: 180
				SELECT * FROM ?_settings');

		if($rows != null)
		{
			foreach ($rows as $numRow => $row)
				self::$cfgSetting[$row['settings_name']] = $row['settings_value'];
		}
		else
		{
			die('<b>Error</b>:Site settings have been uploaded! Check the data in the database!');
		}

		self::$TF = new TextFormatting();
		self::$DEBUG = new Debug(array('useDebug' => self::$cfgSetting['useDebug'], 'logLevel' => self::$cfgSetting['logLevel']));

		// load langs
		if (isset(self::$cfgSetting['lang']))
		{
			require_once (BASEDIR.'lang/'.self::$cfgSetting['lang'].'/text.'.self::$cfgSetting['encoding'].'.php');
			self::$locale = $txt;
		}
		else
		{
			require_once (BASEDIR.'lang/'.self::$cfgSetting['defaultLocale'].'/text.UTF8.php');
			self::Log()->writeError('Can not loading locale %s', self::$cfgSetting['lang']);
			self::$locale = $txt;	
		}
	}

	public static function Log()
	{
        	return self::$DEBUG;
	}

	public static function InitFW()
	{
		if(!@include(BASEDIR.'include/class.framework.php'))
			die('<b>Error</b>: unable to load framework file!');
		self::$FW = new Framework();
	}

	public static function getEncodingPage()
	{
		if (self::$cfgSetting['encoding'] == 'cp1251')
			return 'windows-1251';
		else 
			return 'utf-8';
	}

	public static function CheckExistPageForum($Fid = false, $Tid = false, $Pid = false)
	{
		if($Fid && !$Tid && !$Pid)
			$row = self::$DB->selectRow('SELECT * FROM ?_forums WHERE forum_id = ?d', $Fid);
		else if($Fid && $Tid && !$Pid)
			$row = self::$DB->selectRow('SELECT * FROM ?_forums_threads WHERE forum_id = ?d AND thread_id = ?d', $Fid, $Tid);
		else if($Fid && $Tid && $Pid)
			$row = self::$DB->selectRow('SELECT * FROM ?_forums_posts WHERE forum_id = ?d AND thread_id = ?d AND post_id', $Fid, $Tid, $Pid);

		if($row != null)
			return 1;
		return 0;
	}

	public static function stripget($check_url)
	{
		$return = false;
		if (is_array($check_url))
		{
			foreach ($check_url as $value)
			{
				$return = self::stripget($value);
				if ($return == true) { return true; }
			}
		}
		else
		{
			$check_url = str_replace("\"", "", $check_url);
			$check_url = str_replace("\'", "", $check_url);

			if ((preg_match("/<[^>]*script*\"?[^>]*>/i", $check_url)) || (preg_match("/<[^>]*object*\"?[^>]*>/i", $check_url)) ||
			(preg_match("/<[^>]*iframe*\"?[^>]*>/i", $check_url)) || (preg_match("/<[^>]*applet*\"?[^>]*>/i", $check_url)) ||
			(preg_match("/<[^>]*meta*\"?[^>]*>/i", $check_url)) || (preg_match("/<[^>]*style*\"?[^>]*>/i", $check_url)) ||
			(preg_match("/<[^>]*form*\"?[^>]*>/i", $check_url)) || (preg_match("/\([^>]*\"?[^)]*\)/i", $check_url)))
			{
				$return = true;
			}
		}
		return $return;
	}

	//=============================================================================================
	// Функция перенаправляющая на $location страницу 
	public static function redirect($location, $script = false)
	{
		if (!$script)
		{
			header("Location: ".str_replace("&amp;", "&", $location));
			exit;
		}
		else
		{
			echo "<script type='text/javascript'>document.location.href='".str_replace("&amp;", "&", $location)."'</script>\n";
			exit;
		}
	}

	//=============================================================================================================
	// Функция чистит URL, предотвращает сбой в глобальных переменных
	//=============================================================================================================
	public static function cleanurl($url)
	{
		$bad_entities = array("&", "\"", "'", '\"', "\'", "<", ">", "(", ")", "*");
		$safe_entities = array("&amp;", "", "", "", "", "", "", "", "", "");
		$url = str_replace($bad_entities, $safe_entities, $url);
		return $url;
	}

	//=============================================================================================================
	// Функция проверяет ввод чисел
	//=============================================================================================================
	public static function isnum($value)
	{
		if (!is_array($value))
		{
			return (preg_match("/^[0-9]+$/", $value));
		}
		else
		{
			return false;
		}
	}

	//=============================================================================================================
	// Trim a line of text to a preferred length
	//=============================================================================================================
	public static function trimlink($text, $length)
	{
		$dec = array("&", "\"", "'", "\\", '\"', "\'", "<", ">");
		$enc = array("&amp;", "&quot;", "&#39;", "&#92;", "&quot;", "&#39;", "&lt;", "&gt;");
		$text = str_replace($enc, $dec, $text);
		if (strlen($text) > $length) $text = substr($text, 0, ($length-3))."...";
		$text = str_replace($dec, $enc, $text);
		return $text;
	}

	//=============================================================================================
	// функция возвращает форму (страницу)
	public static function ReturnForm($Retime,$url)
	{
		echo"<script type='text/javascript'> <!--
		function exec_refresh()
		{
  			window.status = 'reloading...' + myvar;
  			myvar = myvar + ' .';
  			var timerID = setTimeout('exec_refresh();', 100);
  			if (timeout > 0)
			{
				timeout -= 1;
			}
			else
			{
    				clearTimeout(timerID);
    				window.status = '';
    				window.location = '$url';
    			}
		}
		var myvar = '';
		var timeout = '".$Retime."';
		exec_refresh();
		//--> </script>";
	}
}
?>