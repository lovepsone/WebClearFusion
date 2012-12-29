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
	// функция для вывода банера
	function showbanners()
	{
		ob_start();

		if (WCF::$settings['serverbanner'])
		{
			echo "<a href='".WCF::$settings['serverurl']."'><img src='".BASEDIR.WCF::$settings['serverbanner']."' alt='".WCF::$settings['servername']."' style='border: 0;' /></a>\n";
		}
		else
		{
			echo "<a href='".WCF::$settings['serverurl']."'>".WCF::$settings['servername']."</a>\n";
		}	
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}
?>