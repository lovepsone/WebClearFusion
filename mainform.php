<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: mainform.php
| Author: lovepsone, Кот_ДаWINчи
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	require "conf.php";

	$banSearch = 0;

	if (isset($_SESSION['ip']))
		{
     			$bres = mysql_query('SELECT count(`ip`) as kol FROM `ip_banned` WHERE `ip`="'.$_SESSION['ip'].'"');
     			$brow = mysql_fetch_assoc($bres);
     			$banSearch = $banSearch + (int)$brow['kol'];
		}

	if (isset($_SESSION['user_id']))
		{ 
			$bres = mysql_query('SELECT count(`id`) as kol FROM `account_banned` WHERE `id`="'.$_SESSION['user_id'].'" and `active` = 1');
     			$brow = mysql_fetch_assoc($bres);
     			$banSearch = $banSearch + (int)$brow['kol'];
     		}

	echo"<div align='center'>";

	if ($banSearch > 0)
   		{
    			unset($_SESSION['user_id']);
    			unset($_SESSION['ip']);
    			session_destroy();

    			echo"<b><h1><font color='red'>";
    			if ((int)$brow['kol'] > 0) echo $txt[15];
    			else echo $txt[14];
    			echo"</font></h1></b>";
   		}

	else if (isset($_SESSION['user_id']) AND ($_SESSION['ip'] == $_SERVER['REMOTE_ADDR'])) 
     		{  
      			if (!isset($_GET['modul']) OR ($_GET['modul'] == '')) $_SESSION['modul'] = $config['default_module'];
      			if (isset($_GET['modul']) and ($_GET['modul'] <> NULL)) $_SESSION['modul'] = $_GET['modul'];
      			if (isset($_POST['modul']) and ($_POST['modul'] <> NULL))  $_SESSION['modul'] = $_POST['modul'];
      			if (isset($modules[$_SESSION['modul']]) AND ((int)($modules[$_SESSION['modul']][2]) <= (int)$_SESSION['gnom']))
				{
            				$ModuleTxt     = $modules[$_SESSION['modul']][1];  
            				$ModuleAccess  = $modules[$_SESSION['modul']][2];  
            				$ModuleAdmin   = $modules[$_SESSION['modul']][3];  
            				$ModuleCurrent = $_SESSION['modul'];  
            				$ModulePath    = $modules[$_SESSION['modul']][0];  
            				require $ModulePath;
            			}
      			else
				{
            				$ModuleTxt     = $modules[$config['default_module']][1];  
            				$ModuleAccess  = $modules[$config['default_module']][2];  
            				$ModuleAdmin   = $modules[$config['default_module']][3];  
            				$ModuleCurrent = $config['default_module'];  
            				$ModulePath    = $modules[$config['default_module']][0];  
            				require $ModulePath;
            			}
      		}
	else 
      		{  
         		/*if (isset($_GET['modul']) AND isset($modules[$_GET['modul']]) AND ($modules[$_GET['modul']][2] == -1))
				{
            				$ModuleTxt     = $modules[$_GET['modul']][1];  
            				$ModuleAccess  = $modules[$_GET['modul']][2];  
            				$ModuleAdmin   = $modules[$_GET['modul']][3];  
            				$ModuleCurrent = $_GET['modul'];  
            				$ModulePath    = $modules[$_GET['modul']][0];  
            				require $ModulePath;
                		}
         		else
				{
            				$ModuleTxt     = $modules[$config['default_module']][1];  
            				$ModuleAccess  = $modules[$config['default_module']][2];  
            				$ModuleAdmin   = $modules[$config['default_module']][3];  
            				$ModuleCurrent = $config['default_module'];  
            				$ModulePath    = $modules[$config['default_module']][0];  
            				require $ModulePath;
                		}
        	}*/
	echo"</div>";
?>

