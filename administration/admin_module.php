<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: admin_module.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	require $modules['adminmenu'][0];

    $lines = file('module/module_cfg.php');
    foreach($lines as $single_line)
        echo $single_line . "<br />\n";
?>