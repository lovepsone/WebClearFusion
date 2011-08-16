<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: leftform.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	require "conf.php";
	require "lang/text.".$config['lang'].".utf8.php";

	$cssfile = "themes/".$config['theme']."/style.css";

    	session_start();
    	unset($_SESSION['user_id']);
    	unset($_SESSION['ip']);
    	session_destroy(); 
?>
	<html>
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="Content-Style-Type" content="text/css">
		<link href="<?php echo $cssfile; ?>" rel="stylesheet" type="text/css" />
		<link href="wcf.css" rel="stylesheet" type="text/css" />

		<script type="text/javascript"> <!--
		function exec_refresh()
			{ 
				window.status = "Переадресация..." + myvar;
				myvar = myvar + " .";
				var timerID = setTimeout("exec_refresh();", 100);
				if (timeout > 0)
					{
						timeout -= 1;
					}
				else
					{
						clearTimeout(timerID); window.status = ""; window.location = "index.php";
					}
			}
		var myvar = "";
		var timeout = 10;
		exec_refresh();
		//--> </script>
		</head>
		<body>
		<br>

    				<TABLE class=mainbody cellSpacing=0 cellPadding=0 align=bottom>
    					<TBODY>
    						<TR>
        						<TD class=bodytopleft></TD>
        						<TD class=bodytop></TD>
        						<TD class=bodytopright></TD>
						</TR>
						<TR>
        						<TD class=bodyleft></TD>
        						<TD class=body><center><?php echo $txt[logout]; ?></center></TD>
        						<TD class=bodyright></TD></TR>
						<TR>
        						<TD class=bodybottomleft></TD>
        						<TD class=bodybottom></TD>
        						<TD class=bodybottomright></TD>
						</TR>
					</TBODY>
				</TABLE>