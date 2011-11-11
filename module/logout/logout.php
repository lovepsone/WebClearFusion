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
       	$query = mysql_query("UPDATE ".DB_USERS." SET `user_online`='0' WHERE (`user_id`='".$_SESSION['user_id']."')");
    	unset($_SESSION['user_id']);

    	unset($_SESSION['ip']);
    	session_destroy(); 

	echo"<script type='text/javascript'> <!--
		function exec_refresh()
			{ 
				window.status = 'Переадресация...' + myvar;
				myvar = myvar + ' .';
				var timerID = setTimeout('exec_refresh();', 200);
				if (timeout > 0)
					{
						timeout -= 1;
					}
				else
					{
						clearTimeout(timerID); window.status = ''; 
						window.location = 'index.php';
					}
			}
		var myvar = '';
		var timeout = 10;
		exec_refresh();
		//--> </script>";

	echo $txt[logout]; 
?>