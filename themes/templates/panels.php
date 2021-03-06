<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2014 lovepsone
+--------------------------------------------------------+
| Filename: panels.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	$p_sql = false; $p_arr = array(1 => false, 2 => false, 3 => false, 4 => false);

	if (!defined("EXCLUDE_PANEL") && !defined("ADMIN_PANEL") && defined("MAIN_PANEL"))
	{
		$p_arr = WCF::$ST->PanelDisplay();

	}
	elseif (!defined("EXCLUDE_PANEL") && defined("ADMIN_PANEL") && !defined("MAIN_PANEL"))
	{
		ob_start();
		require_once ADMIN."navigation.php";
		$p_arr[1] = ob_get_contents();
		ob_end_clean();
	}

	if(isset($p_arr[1])) { define("LEFT", $p_arr[1]); } else { define("LEFT", ""); }
	
	if(isset($p_arr[2])) { define("U_CENTER", $p_arr[2]); } else { define("U_CENTER", ""); }

	if(isset($p_arr[3])) { define("L_CENTER", $p_arr[3]); } else { define("L_CENTER", ""); }

	if(isset($p_arr[4])) { define("RIGHT", $p_arr[4]); } else { define("RIGHT", ""); }

	unset($p_arr);

	if (defined("ADMIN_PANEL") || LEFT && !RIGHT)
	{
		$main_style = "side-left";
	}
	elseif (LEFT && RIGHT)
	{
		$main_style = "side-both";
	}
	elseif (!LEFT && RIGHT)
	{
		$main_style = "side-right";
	}
	elseif (!LEFT && !RIGHT)
	{
		$main_style = "";
	}
?>