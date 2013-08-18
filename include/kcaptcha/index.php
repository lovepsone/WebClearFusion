<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: index.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	session_start();
	error_reporting (E_ALL);
	include('kcaptcha.php');
	$captcha = new KCAPTCHA();
	if($_REQUEST[session_name()]){$_SESSION['captcha_keystring'] = $captcha->getKeyString();}
?>