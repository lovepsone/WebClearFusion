<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2013 lovepsone
+--------------------------------------------------------+
| Filename: class.framework.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

class Framework
{

	public function showbanners()
	{
		ob_start();

		if (WCF::$cfgSetting['serverbanner'])
		{
			echo "<a href='".WCF::$cfgSetting['serverurl']."'><img src='".THEMES.WCF::$cfgSetting['theme']."/".WCF::$cfgSetting['serverbanner']."' alt='".WCF::$cfgSetting['servername']."' style='border: 0;' /></a>\n";
		}
		else
		{
			echo "<a href='".WCF::$cfgSetting['serverurl']."'>".WCF::$cfgSetting['servername']."</a>\n";
		}
	
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}

	private function ExcludePanelList($position)
	{
		$epl = "";
		switch ($position)
		{
		case "left":
			if (WCF::$cfgSetting['exclude_left'] != "")
				$epl = explode("\r\n", WCF::$cfgSetting['exclude_left']);
			break;
		case "upper":
			if (WCF::$cfgSetting['exclude_upper'] != "")
				$epl = explode("\r\n", WCF::$cfgSetting['exclude_upper']);
			break;
		case "lower":
			if (WCF::$cfgSetting['exclude_lower'] != "")
				$epl = explode("\r\n", WCF::$cfgSetting['exclude_lower']);
			break;
		case "right":
			if (WCF::$cfgSetting['exclude_right'] != "")
				$epl = explode("\r\n", WCF::$cfgSetting['exclude_right']);
			break;
		}
		return $epl;
	}

	private function CheckPanelStatus($side)
	{
		$exclude_list = $this->ExcludePanelList($side);

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

	private function IncludePanelWC($modules, $mlist, $pname)
	{
		for ($i=1;$i <= count($modules);$i++)
		{
			$patch_p[$i] = $modules[$mlist[$i]]."/panels/";
			if (file_exists($patch_p[$i].$pname."/".$pname.".php"))
			{
				$pfile = $patch_p[$i].$pname."/".$pname.".php";
				break;
			}
		}
		if (file_exists($pfile))
			return $pfile;
		else
			return false;
	}

	private function CheckPanelDisplay()
	{
		if ($this->CheckPanelStatus("left"))
		{
			$p_sql = "panel_side='1'";
		}
		if ($this->CheckPanelStatus("upper"))
		{
			$p_sql .= ($p_sql ? " OR " : "");
			$p_sql .= (WCF::$cfgSetting['opening_page'] != START_PAGE ? "(panel_side='2' AND panel_display='1')" : "panel_side='2'");
		}
		if ($this->CheckPanelStatus("lower"))
		{
			$p_sql .= ($p_sql ? " OR " : "");
			$p_sql .= (WCF::$cfgSetting['opening_page'] != START_PAGE ? "(panel_side='3' AND panel_display='1')" : "panel_side='3'");
		}
		if ($this->CheckPanelStatus("right"))
		{
			$p_sql .= ($p_sql ? " OR " : "")."panel_side='4'";
		}

		return ($p_sql ? " AND (".$p_sql.")" : false);
	}

	private function CheckModulePanelDisplay($modules, $module_list)
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
					$result = WCF::$DB->select('SELECT * FROM ?_panels WHERE `panel_filename`='.$folder_p);
					if (is_dir($patch_p[$i].$folder_p) && $result == null)
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

	public function PanelDisplay($modules, $module_list)
	{
		$p_arr = array(1 => false, 2 => false, 3 => false, 4 => false);
		$p_sql = $this->CheckPanelDisplay();
		if ($p_sql)
		{
			// выводим обычные панели
			$rows = WCF::$DB->select(' -- CACHE: 180
					SELECT `panel_filename`, `panel_side`, `panel_type` FROM ?_panels WHERE `panel_status`=1 '.$p_sql.' ORDER BY `panel_side`, `panel_order`');

			if ($rows != null)
			{
				$current_side = 0;
				foreach ($rows as $numRow => $p_data)
				{
					if ($current_side == 0)
					{
						ob_start();
						$current_side = $p_data['panel_side'];
					}
					if ($current_side > 0 && $current_side != $p_data['panel_side'])
					{
						$p_arr[$current_side] = ob_get_contents();
						ob_end_clean();
						$current_side = $p_data['panel_side'];
						ob_start();
					}
					if ($p_data['panel_type'] == "file")
					{
						if (file_exists(PANELS.$p_data['panel_filename']."/".$p_data['panel_filename'].".php"))
						{
							include PANELS.$p_data['panel_filename']."/".$p_data['panel_filename'].".php";
						}
						elseif (($fpm = $this->IncludePanelWC($modules, $module_list, $p_data['panel_filename'])) != false)
						{
							include $fpm;
						}
					}
				}
				$p_arr[$current_side] .= ob_get_contents();
				ob_end_clean();
			}

			$list_p = array();
			$list_p = $this->CheckModulePanelDisplay($modules, $module_list);

			if (count($list_p) != 0 && isset($_SESSION['user_id']) && $_SESSION['gmlevel'] >= WCF::$cfgSetting['level_administration'] && isnum($_SESSION['gmlevel']))
			{
				$p_arr[2] .= "<div id='close-message'><div class='admin-message'>".WCF::$locale['mainpanel_in_module']."<a href='".ADMIN."panel_editor.php'>link</a></div></div>";
			}
		}
		return $p_arr;
	}
}
?>