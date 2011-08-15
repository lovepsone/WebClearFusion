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

	function selectDb($cnt)
		{
  			global $characters, $mangos, $realmd, $wcf, $encoding;
  
  			switch ($cnt):
  
  			case ("realmd"):
  			$db = $r_db;
  			$ip = $r_ip;
  			$userdb = $r_userdb;
  			$pw = $r_pw;
  			break;
  
  			case ("characters"):
  			$db = $c_db;
  			$ip = $c_ip;
  			$userdb = $c_userdb;
  			$pw = $c_pw;
  			break;
  
 			case ("mangos"):
  			$db = $m_db;
  			$ip = $m_ip;
  			$userdb = $m_userdb;
  			$pw = $m_pw;
  			break;
  
  			case ("wcf"):
  			$db = $w_db;
  			$ip = $w_ip;
  			$userdb = $w_userdb;
  			$pw = $w_pw;
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