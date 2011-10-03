<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: kcaptcha.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	session_start();
	echo'<a href="kcaptcha.php"  title="Press to reload!"><img src="./kcaptcha/index.php?'.session_name().'='.session_id().'" border="0" align="absmiddle"></a>';
?>