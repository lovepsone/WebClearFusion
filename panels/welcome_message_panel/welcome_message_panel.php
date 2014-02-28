<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2014 lovepsone
+--------------------------------------------------------+
| Filename: user_info_panel.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	if (WCF::$cfgSetting['serverintro'] != "")
	{
		opentable(WCF::getLocale('panel', 2));
		echo stripslashes(WCF::$cfgSetting['serverintro']);
		closetable();
	}
?>