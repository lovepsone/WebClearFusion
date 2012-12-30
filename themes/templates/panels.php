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
		$p_arr = $TEMPLATES->PanelDisplayArray($modules,$module_list);
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