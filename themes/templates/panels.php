<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2012 lovepsone
+--------------------------------------------------------+
| Filename: panels.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	// Calculate current true url
	$script_url = explode("/", $_SERVER['PHP_SELF'].(WCF_QUERY ? "?".WCF_QUERY : ""));
	$url_count = count($script_url);
	$base_url_count = substr_count(BASEDIR, "/") + 1;
	$start_page = "";

	while ($base_url_count != 0)
	{
		$current = $url_count - $base_url_count;
		$start_page .= "/".$script_url[$current];
		$base_url_count--;
	}

	define("START_PAGE", substr(preg_replace("#(&amp;|\?)(s_action=edit&amp;shout_id=)([0-9]+)#s", "", $start_page), 1));

	$p_sql = false; $p_arr = array(1 => false, 2 => false, 3 => false, 4 => false);

	if (!defined("EXCLUDE_PANEL_USERS") && !defined("ADMIN_PANEL") && !defined("ACP_PANEL") && defined("MAIN_PANEL"))
	{
		if (CheckPanelStatus("left"))
		{
			$p_sql = "panel_side='1'";
		}
		if (CheckPanelStatus("upper"))
		{
			$p_sql .= ($p_sql ? " OR " : "");
			$p_sql .= ($config['opening_page'] != START_PAGE ? "(panel_side='2' AND panel_display='1')" : "panel_side='2'");
		}
		if (CheckPanelStatus("lower"))
		{
					$p_sql .= ($p_sql ? " OR " : "");
					$p_sql .= ($config['opening_page'] != START_PAGE ? "(panel_side='3' AND panel_display='1')" : "panel_side='3'");
		}
		if (CheckPanelStatus("right"))
		{
			$p_sql .= ($p_sql ? " OR " : "")."panel_side='4'";
		}

		$p_sql = ($p_sql ? " AND (".$p_sql.")" : false);

		if ($p_sql)
		{
			// выводим обычные панели
			selectdb("wcf");
			$p_res = db_query("SELECT `panel_filename`, `panel_side`, `panel_type` FROM ".DB_PANELS."
								WHERE `panel_status`='1'".$p_sql." ORDER BY `panel_side`, `panel_order`");
			if (db_num_rows($p_res))
			{
				$current_side = 0;
				while ($p_data = db_array($p_res))
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
						elseif (($fpm = IncludePanelWC($modules,$module_list,$p_data['panel_filename'])) != false)
						{
							include $fpm;
						}
												}
					}
					$p_arr[$current_side] .= ob_get_contents();
					ob_end_clean();
				}

				// определяем пути к файлам модулей, и заносим в массив для проверки панелей типа wc
				selectdb("wcf");
				$list_p = array(); $list_m = array();
				for ($i=1;$i <= count($modules);$i++)
				{
					$patch_p[$i] = $modules[$module_list[$i]]."/panels/";
					$temp_p = opendir($patch_p[$i]);
					while ($folder_p = readdir($temp_p))
					{
						if ((!in_array($folder_p, array(".","..")) && strstr($folder_p, "_panel_wc")))
						{
							$result = db_query("SELECT * FROM ".DB_PANELS." WHERE `panel_filename`='".$folder_p."'");
							if (is_dir($patch_p[$i].$folder_p) && db_num_rows($result) != 1)
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
				if (count($list_p) != 0 && isset($_SESSION['user_id']) && $_SESSION['gmlevel'] >= $config['level_administration'] && isnum($_SESSION['gmlevel']))
				{
					$p_arr[2] .= "<div id='close-message'><div class='admin-message'>".$txt['mainpanel_in_module']."<a href='".ADMIN."panel_editor.php'>link</a></div></div>";
				}
			}
		}
	elseif (!defined("EXCLUDE_PANEL_USERS") && defined("ADMIN_PANEL") && !defined("ACP_PANEL") && !defined("MAIN_PANEL"))
	{
		ob_start();
		require_once ADMIN."navigation.php";
		$p_arr[1] = ob_get_contents();
		ob_end_clean();
	}
	elseif (!defined("EXCLUDE_PANEL_USERS") && !defined("ADMIN_PANEL") && !defined("MAIN_PANEL"))
	{
		for ($i=0;$i < count($module_list);$i++)
		{
			if ($module_list[$i] != "none")
			{
				require MODULE.$module_list[$i]."/templates/panels.php";
			}
		}
	}

	/*if (!defined("ADMIN_PANEL"))
		{
			$p_arr[2] = "<a id='content' name='content'></a>\n".$p_arr[2];
			if (iADMIN && $settings['maintenance'])
				{
					$p_arr[2] = "<div id='close-message'><div class='admin-message'>".$locale['global_190']."</div></div>\n".$p_arr[2];
				}
			if (iSUPERADMIN && file_exists(BASEDIR."setup.php"))
				{
					$p_arr[2] = "<div id='close-message'><div class='admin-message'>".$locale['global_198']."</div></div>\n".$p_arr[2];
				}
			if (iADMIN && !$userdata['user_admin_password'])
				{
					$p_arr[2] = "<div id='close-message'><div class='admin-message'>".$locale['global_199']."</div></div>\n".$p_arr[2];
				}
			$p_arr[2] = "<noscript><div class='noscript-message admin-message'>".$locale['global_303']."</div>\n</noscript>\n".$p_arr[2];
		}*/

	define("LEFT", $p_arr[1]);
	define("U_CENTER", $p_arr[2]);
	define("L_CENTER", $p_arr[3]);
	define("RIGHT", $p_arr[4]);
	unset($p_arr);
?>