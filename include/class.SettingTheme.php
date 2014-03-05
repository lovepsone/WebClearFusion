<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2014 lovepsone
+--------------------------------------------------------+
| Filename: class.SettingTheme.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

class SettingTheme
{
	public function ShowBanners()
	{
		ob_start();

		if (WCF::$cfgSetting['serverbanner'])
			echo "<a href='".WCF::$cfgSetting['serverurl']."'><img src='".THEMES.WCF::$cfgSetting['theme']."/".WCF::$cfgSetting['serverbanner']."' alt='".WCF::$cfgSetting['servername']."' style='border: 0;' /></a>\n";
		else
			echo "<a href='".WCF::$cfgSetting['serverurl']."'>".WCF::$cfgSetting['servername']."</a>\n";
	
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}


	public function ShowsubLinks($sep = "&middot;", $class = "")
	{
		$rows = WCF::$DB->select(' -- CACHE: 180
			SELECT * FROM ?_navigation_links WHERE link_position = 1 ORDER BY link_order ASC');

		if ($rows != null)
		{
			$i = 0;
			$res = "<ul>\n";
			foreach ($rows as $numRow => $data)
			{
				$li_class = $class; $i++;
				if ($data['link_url'] != "---" && WCF::CheckGroup($data['link_visibility']))
				{
					if ($i == 1) { $li_class .= ($li_class ? " " : "")."first-link"; }

					if (START_PAGE == $data['link_url']) { $li_class .= ($li_class ? " " : "")."current-link"; }
					if (preg_match("!^(ht|f)tp(s)?://!i", $data['link_url']))
					{
						$res .= "<li".($li_class ? " class='".$li_class."'" : "").">".$sep."<a href='".$data['link_url']."'>\n";
						$res .= "<span>".$data['link_name']."</span></a></li>\n";
					}
					else
					{
						$res .= "<li".($li_class ? " class='".$li_class."'" : "").">".$sep."<a href='".BASEDIR.$data['link_url']."'>\n";
						$res .= "<span>".$data['link_name']."</span></a></li>\n";
					}
				}
			}
			$res .= "</ul>\n";
			return $res;
		}
		return "error loading links";
	}

	public function ShowsubDate()
	{
		return strftime("%A %d %B %Y %H:%M<br>");
	}

	public function ShowCopyright($class = "", $nobreak = false)
	{
		$link_class = $class ? " class='$class' " : "";
		$res = "Powered by <a href='http://'".$link_class.">WebClearFusion</a> copyright &copy; 2010 - ".date("Y")." by lovepsone.";
		$res .= ($nobreak ? "&nbsp;" : "<br />\n");
		$res .= "Released as free software without warranties under <a href='http://www.fsf.org/licensing/licenses/agpl-3.0.html'".$link_class.">GNU Affero GPL</a> v3.\n";
		return $res;
	}

	public function MakePageNav($start, $count, $total, $range = 0, $link = "", $getname = "rowstart")
	{
		if ($link == "") { $link = WCF_SELF."?"; }
		$pg_cnt = ceil($total / $count);
		if ($pg_cnt <= 1) { return ""; }
		$idx_back = $start - $count;
		$idx_next = $start + $count;
		$cur_page = ceil(($start + 1) / $count);

		$res = WCF::getLocale('common', 2)." ".$cur_page.WCF::getLocale('common', 3).$pg_cnt.": ";
		if ($idx_back >= 0)
		{
			if ($cur_page > ($range + 1))
			{
				$res .= "<a href='".$link.$getname."=0'>1</a>";
				if ($cur_page != ($range + 2)) { $res .= "..."; }
			}
		}

		$idx_fst = max($cur_page - $range, 1);
		$idx_lst = min($cur_page + $range, $pg_cnt);
		if ($range == 0)
		{
			$idx_fst = 1;
			$idx_lst = $pg_cnt;
		}

		for ($i = $idx_fst; $i <= $idx_lst; $i++)
		{
			$offset_page = ($i - 1) * $count;
			if ($i == $cur_page)
			{
				$res .= "<span><strong>".$i."</strong></span>";
			}
			else
			{
				$res .= "<a href='".$link.$getname."=".$offset_page."'>".$i."</a>";
			}
		}
		if ($idx_next < $total)
		{
			if ($cur_page < ($pg_cnt - $range))
			{
				if ($cur_page != ($pg_cnt - $range - 1)) { $res .= "..."; }
				$res .= "<a href='".$link.$getname."=".($pg_cnt - 1) * $count."'>".$pg_cnt."</a>\n";
			}
		}

		return "<div class='pagenav'>\n".$res."</div>\n";
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

	public function PanelDisplay()
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

		}
		return $p_arr;
	}
}
?>