<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: admin.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/


	echo"<script type='text/javascript' src='js/adminmenu.js'></script>";
	echo"<table width='100%' cellpadding='0' cellspacing='0' border='0' align='center'>";
	echo"<tr><td>";
	require $modules['adminmenu'][0];
	echo"</td></tr></table>";
?>