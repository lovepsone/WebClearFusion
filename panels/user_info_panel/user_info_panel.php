<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2012 lovepsone
+--------------------------------------------------------+
| Filename: user_info_panel.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	WCF::$SMARTY->configLoad(WCF::$settings['lang'].'.conf', 'user_info_panel');

	if (!isset($_SESSION['user_id']) || ($_SESSION['ip'] != $_SERVER['REMOTE_ADDR']))
	{
		WCF::$SMARTY->assign('pass_remember', WCF::$settings['pass_remember']);
		WCF::$SMARTY->assign('kcaptcha_enable_auth', WCF::$settings['kcaptcha_enable_auth']);

	}
	else if (isset($_SESSION['user_id']) || ($_SESSION['ip'] == $_SERVER['REMOTE_ADDR']))
	{
		$check_gm_lvl = false;
 		$query_user = WCF::$DB->db_query("SELECT * FROM ".DB_USERS." WHERE `user_id`=".intval($_SESSION['user_id'])." LIMIT 1");
  		$res_user = WCF::$DB->db_assoc($query_user);

		if(WCF::$AUTH->GMLevel() >= WCF::$settings['level_administration'] )
			$check_gm_lvl = true;

		WCF::$SMARTY->assign('data', $res_user);
		WCF::$SMARTY->assign('gm_lvl', $check_gm_lvl);
	}

	openside();
	WCF::$SMARTY->display('user_info_panel.tpl');
	closeside();
?>