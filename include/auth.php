<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: auth.php
| Author: lovepsone, Кот_ДаWINчи
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	session_start();

	if (isset($_POST['auth_name'])) 
   		{
   			$par= SHA1(strtoupper($_POST['auth_name']).':'.strtoupper($_POST['auth_pass']));

			//selectDB('realmd');
   			$cont = mysql_connect($r_ip, $r_userdb, $r_pw);
   			mysql_select_db($r_db, $cont);
   			mysql_query("SET NAMES '$encoding'"); 
   			$res = mysql_query('SELECT * FROM `account` WHERE `username`="'.strtoupper(addslashes($_POST['auth_name'])).'" AND sha_pass_hash ="'.$par.'"');

   			if ($row = mysql_fetch_assoc($res))
      				{
       					$_SESSION['user_id'] = (int)$row['id'];
       					$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
       					$_SESSION['kito'] = strtoupper($_POST['auth_name']);
       					$_SESSION['slovo'] = strtoupper($par);
       					$_SESSION['gnom'] = (int)$row['gmlevel'];
       					$_SESSION['modul'] = 'news';
       				}

   			header("Location: http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
   			exit;
   		}

	if (isset($_GET['action']) AND $_GET['action']=="logout") 
   		{
    			session_destroy();
    			header("Location: http://".$_SERVER['HTTP_HOST']."/");
    			exit;
   		}

	if (isset($_SESSION['ip']) AND ($_SESSION['ip'] <> $_SERVER['REMOTE_ADDR'])) 
   		{
    			session_destroy();
    			header("Location: http://".$_SERVER['HTTP_HOST']."/");
    			exit;
   		}
?>