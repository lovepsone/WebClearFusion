<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2012 lovepsone
+--------------------------------------------------------+
| Filename: functions_users.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	function check_user($visibility)
		{
	  		global $_SESSION;

			if ($visibility == -1) { return true; }
			else if ($visibility <= $_SESSION['gmlevel']) { return true; }
			else { return false; }
				
			
		}
?>