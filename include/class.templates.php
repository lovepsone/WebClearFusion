<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2012 lovepsone
+--------------------------------------------------------+
| Filename: clas.templates.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

class WCFTemplates
{
	public function HeaderWCF()
	{
		if (!defined("IN_WCF")) { die("Access Denied"); }

		define("MAIN_PANEL", true);

		ob_start();
	}

	//=============================================================================================
	// функция исключает понели на отдельных страницах, установленых в настройках
	private function CheckPanelStatus($side)
	{
		$exclude_list = "";
		if ($side == "left")
		{
			if (WCF::$settings['exclude_left'] != "") { $exclude_list = explode("\r\n", WCF::$settings['exclude_left']); }
		}
		elseif ($side == "upper")
		{
			if (WCF::$settings['exclude_upper'] != "") { $exclude_list = explode("\r\n", WCF::$settings['exclude_upper']); }
		}
		elseif ($side == "lower")
		{
			if (WCF::$settings['exclude_lower'] != "") { $exclude_list = explode("\r\n", WCF::$settings['exclude_lower']); }
		}
		elseif ($side == "right")
		{
			if (WCF::$settings['exclude_right'] != "") { $exclude_list = explode("\r\n", WCF::$settings['exclude_right']); }
		}

		if (is_array($exclude_list))
		{
			$script_url = explode("/", $_SERVER['PHP_SELF']);
			$url_count = count($script_url);
			$base_url_count = substr_count(BASEDIR, "/")+1;
			$match_url = "";

			while ($base_url_count != 0)
			{
				$current = $url_count - $base_url_count;
				$match_url .= "/".$script_url[$current];
				$base_url_count--;
			}

			if (!in_array($match_url, $exclude_list) && !in_array($match_url.(WCF_QUERY ? "?".WCF_QUERY : ""), $exclude_list))
				return true;
			else
				return false;

		}
		else
			return true;
	}

	public function CheckPanelDisplay()
	{
		if (self::CheckPanelStatus("left"))
		{
			$panel_sql = "panel_side='1'";
		}
		if (self::CheckPanelStatus("upper"))
		{
			$panel_sql .= ($panel_sql ? " OR " : "");
			$panel_sql .= (WCF::$settings['opening_page'] != START_PAGE ? "(panel_side='2' AND panel_display='1')" : "panel_side='2'");
		}
		if (self::CheckPanelStatus("lower"))
		{
			$panel_sql .= ($panel_sql ? " OR " : "");
			$panel_sql .= (WCF::$settings['opening_page'] != START_PAGE ? "(panel_side='3' AND panel_display='1')" : "panel_side='3'");
		}
		if (self::CheckPanelStatus("right"))
		{
					$panel_sql .= ($panel_sql ? " OR " : "")."panel_side='4'";
		}
		$panel_sql = ($panel_sql ? " AND (".$panel_sql.")" : false);
		return $panel_sql;
	}

	public function CheckPanelModule($modules,$module_list)
	{
		// определяем пути к файлам модулей, и заносим в массив для проверки панелей типа wc
		$list_p = array(); $list_m = array();
		for ($i=1;$i <= count($modules);$i++)
		{
			$patch_p[$i] = $modules[$module_list[$i]]."/panels/";
			$temp_p = opendir($patch_p[$i]);
			while ($folder_p = readdir($temp_p))
			{
				if ((!in_array($folder_p, array(".","..")) && strstr($folder_p, "_panel_wc")))
				{
					$result = WCF::$DB->db_query("SELECT * FROM ".DB_PANELS." WHERE `panel_filename`='".$folder_p."'");
					if (is_dir($patch_p[$i].$folder_p) && WCF::$DB->db_num_rows($result) != 1)
					{
						$list_m[] = $folder_p;
					}
										}
				}
				closedir($temp_p);
				if (count($list_m) != 0)
				{
					sort($list_m);
					$list_p[$i] = $list_m;
				}
			}
		return $list_p;
	}
}

?>