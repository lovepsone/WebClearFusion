<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2012 lovepsone
+--------------------------------------------------------+
| Filename: setuser.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	require_once "include/show_maincore.php";
	if (!isset($_SESSION['user_id']) || ($_SESSION['ip'] != $_SERVER['REMOTE_ADDR']) || !isset($_SESSION['realmd_id'])) { redirect(BASEDIR); }
	redirect("../setuser.php?action=out_acp");
?>