<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: functions_return.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	function ReturnMainForm($Retime)
		{
			echo"<script type='text/javascript'> <!--
			function exec_refresh()
				{
  					window.status = 'reloading...' + myvar;
  					myvar = myvar + ' .';
  					var timerID = setTimeout('exec_refresh();', 100);
  					if (timeout > 0)
						{
							timeout -= 1;
						}
					else
						{
    							clearTimeout(timerID);
    							window.status = '';
    							window.location = 'index.php';
    						}
				}
			var myvar = '';
			var timeout = '".$Retime."';
			exec_refresh();
			//--> </script>";
		}
?>