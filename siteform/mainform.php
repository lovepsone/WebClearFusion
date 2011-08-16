<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: main.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	include_once("conf.php");

	//*****************************************************************************
	// Открывание мдулей
	//*****************************************************************************
	$module = isset($modules[$mode]) ? $modules[$mode] : (isset($modules["default"]) ? $modules["default"] : NULL);
	// Подключаем модуль если найден
	if ($module!=NULL)
    		include($module);

	echo"<br><div id=debug></div><TABLE class=back>";

	echo"<TBODY><TR><TD align=left width=\"33%\"><A href=\"\"></A></TD>";
	echo"<TD align=center width=\"34%\"></TD>";
	echo"<TD align=right width=\"33%\"></TD></TR></TBODY>";
	echo"</TABLE>";
?>
<script type="text/javascript">parseHref(document);</script>

