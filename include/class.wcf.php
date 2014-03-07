<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2014 lovepsone
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

	public static $TF = null; 		// TextFormatting
	public static $templating = null;
	public static $DB = null; 		// DbSimple

	public static $ST = null;		// SettingTheme
	
	private static $lang = array();		// locale
	private static $xmlLang = null;

	public static function InitWCF()
	{
		if(!@include(BASEDIR.'conf.php'))
			die('<b>Error</b>: unable to load configuration file!');
		if(!@include(BASEDIR.'include/DbSimple/Generic.php'))
			die('<b>Error</b>: unable to load DbSimple lib!');
		if(!@include(BASEDIR.'include/class.TextFormatting.php'))
			die('<b>Error</b>: unable to load TextFormatting file!');
	
		self::$cfgSetting = $WCFConfig['settings'];
		self::$cfgMySql   = $WCFConfig['mysql'];
		self::$cfgTitle   = $WCFConfig['title'];

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

		// load langs
		if (!isset(self::$cfgSetting['lang']) || !file_exists(BASEDIR.'lang/'.self::$cfgSetting['lang'].'.xml'))
		{
			self::$xmlLang = simplexml_load_file(BASEDIR.'lang/'.self::$cfgSetting['defaultLocale'].'.xml');
			die('<b>Error</b>:Can not loading locale '.self::$cfgSetting['lang']);
		}
		else
		{
			self::$xmlLang = simplexml_load_file(BASEDIR.'lang/'.self::$cfgSetting['lang'].'.xml');
		}

		//
		if(!@include(INCLUDES.'class.SettingTheme.php'))
			die('<b>Error</b>: unable to load SettingTheme file!');
		self::$ST = new SettingTheme();
	}

	public static function CheckGroup($group)
	{
		return true;
	}

	public static function getEncodingPage()
	{
		if (self::$cfgSetting['encoding'] == 'cp1251')
			return 'windows-1251';
		return 'utf-8';
	}

	public static function getLocale($section, $id)
	{
		
		return self::$xmlLang->$section->lang[$id]['name'];
	}

	private static function getBBCodes()
	{
		$Cache = array();
		$BB = simplexml_load_file(BASEDIR.'include/Data/BBCodes.xml');
		for ($i = 0; $i < count($BB->item); $i++)
		{
			$Cache[] = $BB->item[$i]['name'];
		}
		return $Cache;
	}

	public static function getAdminPage()
	{
		$Cache = array();
		$admin = simplexml_load_file(BASEDIR.'include/Data/AdminSystems.xml');
		for ($ii = 1; $ii < 5; $ii++)
		{
			switch($ii)
			{
			case 1: $section = 'contet'; break;
			case 2: $section = 'users';   break;
			case 3: $section = 'system';  break;
			case 4: $section = 'setting'; break;
			}

			for ($i = 0; $i < count($admin->$section->item); $i++)
			{
				$Cache[$ii][] = array('id' => $i,
							'img' => $admin->$section->item[$i]['img'],
							'text' => $admin->$section->item[$i]['text'],
							'file' => $admin->$section->item[$i]['file']);
			}
		}
		return $Cache;
	}

	public static function DisplayBBCodes($Width, $TextAreaName = "message", $InputFormName = "inputform")
	{
		$_BBCODE_ = array(); $bbcodes = ""; $BBCache = array(); $BBCache = self::getBBCodes();

		if (is_array($BBCache) && count($BBCache))
		{
			foreach ($BBCache as $BBCode)
			{
				include (INCLUDES."bbcodes/".$BBCode."_var.php");
			}	
		}

		if (sizeof($__BBCODE__) != 0)
		{
			foreach ($__BBCODE__ as $key => $bbdata)
			{
				if (file_exists(INCLUDES."bbcodes/images/".$bbdata['value'].".png"))
				{
					$type = "type='image' src='".INCLUDES."bbcodes/images/".$bbdata['value'].".png'";
				}
				else
				{
					$type = "type='button' value='".$bbdata['value']."'";
				}
         	
				if (array_key_exists('onclick', $bbdata) && $bbdata['onclick'] != "")
				{
					$onclick = $bbdata['onclick'];
				}
				else
				{
					if (array_key_exists('bbcode_end', $bbdata) && $bbdata['bbcode_end'] != "")
					{
						$onclick = "addText('".$TextAreaName."','".$bbdata['bbcode_start']."','".$bbdata['bbcode_end']."','".$InputFormName."');return false;";
					}
					else
					{
						$onclick = "insertText('".$TextAreaName."','".$bbdata['bbcode_start']."','".$InputFormName."');return false;";
					}
				}
           
				if (array_key_exists('onmouseover', $bbdata) && $bbdata['onmouseover'] != "")
				{
					$onmouseover = "onMouseOver=\"".$bbdata['onmouseover']."\"";
				}
				else
				{
					$onmouseover = "";
				}

				if (array_key_exists('onmouseout', $bbdata) && $bbdata['onmouseout'] != "")
				{
					$onmouseout = "onMouseOut=\"".$bbdata['onmouseout']."\"";
				}
				else
				{
					$onmouseout = "";
				}

				if (array_key_exists('wcf', $bbdata) && $bbdata['wcf'] != "")
				{
					$php = $bbdata['wcf'].(substr($bbdata['wcf'], -1, 1) != ";" ? ";" : "");
					ob_start(); 
					eval($php);
					$wcf = ob_get_contents();
					ob_end_clean();
				}
				else
				{
					$wcf = "";
				}

				$bbcodes .= substr($bbdata['value'], 0, 1) != "!" ? "<input ".$type." class='bbcode' onclick=\"".$onclick."\" ".$onmouseover." ".$onmouseout." title='".$bbdata['description']."' />\n":"";
				if (array_key_exists('html_start', $bbdata) && $bbdata['html_start'] != "") { $bbcodes .= $bbdata['html_start']."\n"; }
				if (array_key_exists('includejscript', $bbdata) && $bbdata['includejscript'] != "") { $bbcodes .= "<script type='text/javascript' src='".INCLUDES."bbcodes/".$bbdata['includejscript']."'></script>\n"; }
				if (array_key_exists('calljscript', $bbdata) && $bbdata['calljscript'] != "") { $bbcodes .= "<script type='text/javascript'>\n<!--\n".$bbdata['calljscript']."\n-->\n</script>\n"; }
				if (array_key_exists('wcf', $bbdata) && $bbdata['wcf'] != "") { $bbcodes .= $wcf; }
				if (array_key_exists('html_middle', $bbdata) && $bbdata['html_middle'] != "") { $bbcodes .= $bbdata['html_middle']."\n"; }
				if (array_key_exists('html_end', $bbdata) && $bbdata['html_end'] != "") { $bbcodes .= $bbdata['html_end']."\n"; }
			}
		}
		unset ($__BBCODE__);

		return "<div style='width:".$Width."'>\n".$bbcodes."</div>\n";
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

	public static function StripGet($check_url)
	{
		$return = false;
		if (is_array($check_url))
		{
			foreach ($check_url as $value)
			{
				$return = self::StripGet($value);
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
	public static function Redirect($location, $script = false)
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
	public static function isNum($value)
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
	public static function TrimLink($text, $length)
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