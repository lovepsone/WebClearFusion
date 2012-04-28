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

	if (defined("ACP_PANEL"))
		{
			if (check_panel_status("left"))
				{
					$p_acp_sql = "panel_side='1'";
				}
			if (check_panel_status("upper"))
				{
					$p_acp_sql .= ($p_acp_sql ? " OR " : "");
					$p_acp_sql .= ($config['opening_page'] != START_PAGE ? "(panel_side='2' AND panel_display='1')" : "panel_side='2'");
				}
			if (check_panel_status("lower"))
				{
					$p_acp_sql .= ($p_acp_sql ? " OR " : "");
					$p_acp_sql .= ($config['opening_page'] != START_PAGE ? "(panel_side='3' AND panel_display='1')" : "panel_side='3'");
				}
			if (check_panel_status("right"))
				{
					$p_acp_sql .= ($p_acp_sql ? " OR " : "")."panel_side='4'";
				}

			$p_acp_sql = ($p_acp_sql ? " AND (".$p_acp_sql.")" : false);

			if ($p_acp_sql)
				{
					selectdb("wcf");
					$p_acp_res = mysql_query("SELECT `panel_filename`, `panel_side`, `panel_type` FROM ".DB_ACP_PANELS."
								WHERE `panel_status`='1'".$p_acp_sql." ORDER BY `panel_side`, `panel_order`");
					if (db_num_rows($p_acp_res))
						{
							$current_side = 0;
							while ($p_data = db_array($p_acp_res))
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
													if (file_exists($modules['acp_module']."panels/".$p_data['panel_filename']."/".$p_data['panel_filename'].".php"))
														{
															include $modules['acp_module']."panels/".$p_data['panel_filename']."/".$p_data['panel_filename'].".php";
														}
												}
								}
							$p_arr[$current_side] .= ob_get_contents();
							ob_end_clean();
						}
				}
		}
?>