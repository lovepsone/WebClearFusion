<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: functions.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	$date = date('d-m-Y [H:i:s]');

	function selectDb($jmeno)
		{
  			global $characters, $mangos, $realmd, $lk, $encoding;
  
  			switch ($jmeno):
  
  			case ("realmd"):
  			$db = $realmd['db'];
  			$ip = $realmd['host'];
  			$userdb = $realmd['user'];
  			$pw = $realmd['pass'];
  			break;
  
  			case ("characters"):
  			$db = $characters['db'];
  			$ip = $characters['host'];
  			$userdb = $characters['user'];
  			$pw = $characters['pass'];
  			break;
  
 			case ("mangos"):
  			$db = $mangos['db'];
  			$ip = $mangos['host'];
  			$userdb = $mangos['user'];
  			$pw = $mangos['pass'];
  			break;
  
  			case ("lk"):
  			$db = $lk['db'];
  			$ip = $lk['host'];
  			$userdb = $lk['user'];
  			$pw = $lk['pass'];
  			break;
  
  			endswitch;
  
 			$connect = mysql_connect($ip, $userdb, $pw);
 			mysql_select_db($db, $connect);
			mysql_query("SET NAMES '$encoding'");   
		}


	function getLocale($locale)
		{
  			switch ($locale):
      			case 0:
      			$locale = "English";
      			break;
  
    			case 1:
      			$locale = "Korean";
      			break;
    
    			case 2:
      			$locale = "French";
      			break;

    			case 3:
      			$locale = "German";
      			break;
      
    			case 4:
      			$locale = "Chinese";
      			break;
      
    			case 5:
      			$locale = "Taiwanese";
     			break;
      
    			case 6:
      			$locale = "Spanish";
      			break;
      
    			case 7:
      			$locale = "Spanish Mexico";
      			break;
      
    			case 8:
      			$locale = "Русский";
      			break;

  			endswitch;

			return $locale;
  
		}


?>