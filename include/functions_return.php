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

	function ReturnAdminPanel($Retime)
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
    							window.location = 'index.php?modul=adminsetpanel';
    						}
				}
			var myvar = '';
			var timeout = '".$Retime."';
			exec_refresh();
			//--> </script>";
		}

	function ReturnAdminNewsadd($Retime)
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
    							window.location = 'index.php?modul=newsadd';
    						}
				}
			var myvar = '';
			var timeout = '".$Retime."';
			exec_refresh();
			//--> </script>";
		}
	function ReturnAdminNewsdel($Retime)
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
    							window.location = 'index.php?modul=newsdel';
    						}
				}
			var myvar = '';
			var timeout = '".$Retime."';
			exec_refresh();
			//--> </script>";
		}

	function ReturnAdminNewsedit($Retime)
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
    							window.location = 'index.php?modul=newsedit';
    						}
				}
			var myvar = '';
			var timeout = '".$Retime."';
			exec_refresh();
			//--> </script>";
		}

	function ReturnAdminAddpanel($Retime)
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
    							window.location = 'index.php?modul=adminaddpanel';
    						}
				}
			var myvar = '';
			var timeout = '".$Retime."';
			exec_refresh();
			//--> </script>";
		}
?>