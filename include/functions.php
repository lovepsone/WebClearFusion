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

function ReturnMainForm($Retime)
{echo '
<script type="text/javascript"> <!--
function exec_refresh(){
  window.status = "reloading..." + myvar;
  myvar = myvar + " .";
  var timerID = setTimeout("exec_refresh();", 100);
  if (timeout > 0){
  timeout -= 1;
  }else{
    clearTimeout(timerID);
    window.status = "";
    window.location = "index.php";
    }
}
var myvar = "";
var timeout = '.$Retime.';
exec_refresh();
//--> </script>';
}

	function generate($number)
		{
    			$arr = array('a','b','c','d','e','f',
                 	     	     'g','h','i','j','k','l',
                 	     	     'm','n','o','p','r','s',
                 	     	     't','u','v','x','y','z',
                 	     	     'A','B','C','D','E','F',
                 	     	     'G','H','I','J','K','L',
                 	     	     'M','N','O','P','R','S',
                 	     	     'T','U','V','X','Y','Z',
                 	     	     '1','2','3','4','5','6',
                 	     	     '7','8','9','0',);
   			$symbol = "";

   			for($i = 0; $i < $number; $i++)
				{
     					$index = rand(0, count($arr) - 1);
     					$symbol .= $arr[$index];
     				}
   			return $symbol;
		}

?>