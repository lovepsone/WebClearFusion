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
	public static $SMARTY = null;

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
		if(!@require_once(BASEDIR.'include/smarty/Smarty.class.php'))
		{
			die('<b>Error:</b> unable to load Smarty lib!');
		}

		self::$SMARTY = new Smarty();
		// Папки с шаблонами, кэшом шаблонов и настройками
		//$SMARTY->template_dir = THEMES.WCF::$settings['theme'].'/phtml/';
		//$SMARTY->compile_dir = BASEDIR.'cache/themes/'.WCF::$settings['theme'].'/';
		self::$SMARTY->config_dir = BASEDIR.'/lang/';
		self::$SMARTY->cache_dir = BASEDIR.'cache/';
		// Режим отладки
		$SMARTY->debugging = false;
		// Разделители
		$SMARTY->left_delimiter = '{';
		$SMARTY->right_delimiter = '}';
		// Общее Кэширование, для этого сайта не работает
		$SMARTY->caching = true;
		$SMARTY->cache_lifetime = 10;


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

	public static function StartSmarty($dir_template, $dir_compile)
	{
		if (self::$SMARTY != null)
		{
			self::$SMARTY->template_dir = $dir_template;
			self::$SMARTY->compile_dir = $dir_compile;
			return true;
		}
		return false;
	}

	public static function Log()
	{
		return self::$debug;
	}


	//=============================================================================================================
	// Предотвращения возможных атак через XSS $_GET.
	//=============================================================================================================
	function stripget($check_url)
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
	function redirect($location, $script = false)
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
	function cleanurl($url)
	{
		$bad_entities = array("&", "\"", "'", '\"', "\'", "<", ">", "(", ")", "*");
		$safe_entities = array("&amp;", "", "", "", "", "", "", "", "", "");
		$url = str_replace($bad_entities, $safe_entities, $url);
		return $url;
	}

	//=============================================================================================================
	// Функция проверяет ввод чисел
	//=============================================================================================================
	function isnum($value)
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
	function trimlink($text, $length)
	{
		$dec = array("&", "\"", "'", "\\", '\"', "\'", "<", ">");
		$enc = array("&amp;", "&quot;", "&#39;", "&#92;", "&quot;", "&#39;", "&lt;", "&gt;");
		$text = str_replace($enc, $dec, $text);
		if (strlen($text) > $length) $text = substr($text, 0, ($length-3))."...";
		$text = str_replace($dec, $enc, $text);
		return $text;
	}
}

?>