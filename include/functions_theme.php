<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2012 lovepsone
+--------------------------------------------------------+
| Filename: functions_theme.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	//=============================================================================================
	// ������� ��������� ������ �� ��������� ���������, ������������ � ����������
	function check_panel_status($side)
		{
			global $config;

			$exclude_list = "";
	
			if ($side == "left")
				{
					if ($config['exclude_left'] != "") { $exclude_list = explode("\r\n", $config['exclude_left']); }
				}
			elseif ($side == "upper")
				{
					if ($config['exclude_upper'] != "") { $exclude_list = explode("\r\n", $config['exclude_upper']); }
				}
			elseif ($side == "lower")
				{
					if ($config['exclude_lower'] != "") { $exclude_list = explode("\r\n", $config['exclude_lower']); }
				}
			elseif ($side == "right")
				{
					if ($config['exclude_right'] != "") { $exclude_list = explode("\r\n", $config['exclude_right']); }
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
						{
							return true;
						}
					else
						{
							return false;
						}
				}
			else
				{
					return true;
				}
		}
?>