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

	function selectdb($connect)
		{
  			global $characters, $mangos, $realmd, $wcf, $encoding;
  
  			switch ($connect):
  
  			case ("realmd"):
  			$db = $config['rdbName'];
  			$ip = $config['rhostname'];
  			$userdb = $config['rusername'];
  			$pw = $config['rpassword'];
  			break;
  
  			case ("characters"):
  			$db = $config['cdbName'];
  			$ip = $config['chostname'];
  			$userdb = $config['cusername'];
  			$pw = $config['cpassword'];
  			break;
  
 			case ("mangos"):
  			$db = $config['dbName'];
  			$ip = $config['hostname'];
  			$userdb = $config['username'];
  			$pw = $config['password'];
  			break;
  
  			case ("wcf"):
  			$db = $config['wdbName'];
  			$ip = $config['whostname'];
  			$userdb = $config['wusername'];
  			$pw = $config['wpassword'];
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