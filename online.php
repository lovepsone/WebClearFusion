<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2012 lovepsone
+--------------------------------------------------------+
| Filename: online.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	require_once "maincore.php";
	require_once THEMES."templates/header.php";

	if ($config['type_server'] = '1' || $config['type_server'] = '2')
		{
			require_once CONTENT_WOW."online.php";
		}

	require_once THEMES."templates/footer.php";
?>