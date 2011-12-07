<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: logout.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

    	session_start();

	selectdb(wcf);
       	mysql_query("UPDATE ".DB_USERS." SET `user_online`='0' WHERE (`user_id`='".$_SESSION['user_id']."')");
    	unset($_SESSION['user_id']);

    	unset($_SESSION['ip']);
    	session_destroy();

	return_form(7,'');
	opentable();
	echo"<tr><td align='center'>".$txt['logout']."</td></tr>";
	closetable(); 
?>