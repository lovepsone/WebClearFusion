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

	if (!defined("EXCLUDE_PANEL_USERS"))
		{
			if (check_panel_status("left"))
				{
					$p_sql = "panel_side='1'";
				}
			if (check_panel_status("upper"))
				{
					$p_sql .= ($p_sql ? " OR " : "");
					$p_sql .= ($config['opening_page'] != START_PAGE ? "(panel_side='2' AND panel_display='1')" : "panel_side='2'");
				}
			if (check_panel_status("lower"))
				{
					$p_sql .= ($p_sql ? " OR " : "");
					$p_sql .= ($config['opening_page'] != START_PAGE ? "(panel_side='3' AND panel_display='1')" : "panel_side='3'");
				}
			if (check_panel_status("right"))
				{
					$p_sql .= ($p_sql ? " OR " : "")."panel_side='4'";
				}

			$p_sql = ($p_sql ? " AND (".$p_sql.")" : false);

			if ($p_sql)
				{
					selectdb(wcf);
					$p_res = mysql_query("SELECT `panel_filename`, `panel_side`, `panel_type` FROM ".DB_PANELS."
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
												}
											/*else
												{
													eval(stripslashes($p_data['panel_content']));
												}*/
								}
							$p_arr[$current_side] .= ob_get_contents();
							ob_end_clean();
						}
				}
		}
	/*else
		{
			ob_start();
			require_once ADMIN."navigation.php";
			$p_arr[1] = ob_get_contents();
			ob_end_clean();
		}*/

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