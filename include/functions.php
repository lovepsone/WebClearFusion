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

	if (isset($_SESSION['lang']))
		{
    			switch($_SESSION['lang'])
    			{
        			case "ru":
        			$config['lang'] = "ru";
        			break;
        			case "en":
        			$config['lang'] = "en";
        			break;
        			default:
        			unset($_SESSION['lang']);
       	 			break;
    			}
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

	function ShowPageNavigator($LinkText,$Page,$AllPages)
		{
			$Page = intval($Page);
			$AllPages = intval($AllPages);
			if ($Page > $AllPages) $Page = 1;
			$text ="<table border='0' cellpadding='5' cellspacing='3'><tr>";
			if ($AllPages < 16)
				{
   					for ($i = 1; $i <= $AllPages; $i++)
						{
       							if ($i == $Page)  $text .= "<td class=navicurrent>$i</td>";
       							else $text .= "<td class=navibutton><a href='$LinkText$i' target='_self'>$i</a></td>";
      						}
  				} 
			else
				{
    					if ($Page < 6)
						{
        						for ($i = 1; $i <= 6; $i++)
								{
            								if ($i == $Page)  $text .= "<td class=navicurrent>$i</td>";
            								else $text .= "<td class=navibutton><a href='$LinkText$i' target='_self'>$i</a></td>";
            							}
        						$text .= "<td>...</td>";
        						$text .= "<td class=navibutton><a href='$LinkText($AllPages-2)' target='_self'>($AllPages-2)</a></td>";
        						$text .= "<td class=navibutton><a href='$LinkText($AllPages-1)' target='_self'>($AllPages-1)</a></td>";
        						$text .= "<td class=navibutton><a href='$LinkText$AllPages' target='_self'>$AllPages</a></td>";
        					}

    					else if ($Page > ($AllPages-5))
						{
        						$text .= "<td class=navibutton><a href='$LinkText1' target='_self'>1</a></td>";
        						$text .= "<td class=navibutton><a href='$LinkText2' target='_self'>2</a></td>";
        						$text .= "<td class=navibutton><a href='$LinkText3' target='_self'>3</a></td>";
        						$text .= "<td>...</td>";

        						for ($i = ($AllPages-5); $i <= $AllPages; $i++)
								{
            								if ($i == $Page)  $text .= "<td class=navicurrent>$i</td>";
            								else $text .= "<td class=navibutton><a href='$LinkText$i' target='_self'>$i</a></td>";
            							}
        					}
    					else
						{
        						$text .= "<td class=navibutton><a href='$LinkText1' target='_self'>1</a></td>";
        						$text .= "<td class=navibutton><a href='$LinkText2' target='_self'>2</a></td>";
        						$text .= "<td class=navibutton><a href='$LinkText3' target='_self'>3</a></td>";
        						$text .= "<td>...</td>";
        						$text .= "<td class=navibutton><a href='$LinkText($Page-1)' target='_self'>($Page-1)</a></td>";
        						$text .= "<td class=navicurrent>$Page</td>";
        						$text .= "<td class=navibutton><a href='$LinkText($Page+1)' target='_self'>($Page+1)</a></td>";
        						$text .= "<td>...</td>";
        						$text .= "<td class=navibutton><a href='$LinkText($AllPages-2)' target='_self'>($AllPages-2)</a></td>";
        						$text .= "<td class=navibutton><a href='$LinkText($AllPages-1)' target='_self'>($AllPages-1)</a></td>";
        						$text .= "<td class=navibutton><a href='$LinkText$AllPages' target='_self'>$AllPages</a></td>";
        					}
  				}
			$text .= "</tr></table>";
			return $text;
		}

	function text_optimazer($Mstring)
		{
			$e = 0;
			$rString = trim($Mstring);
			$rString = AddSlashes($rString);
			$rString = trim($rString);

			while ($e < 50)
   				{
   					if ((substr($rString, -13) == '<p>&nbsp;</p>') && (strlen($rString) > 13))
      						{
       							$rString = substr($rString, 0, strlen($rString)-13);
       							$e++;
      						}
					else $e = 51;
   					$rString = rtrim($rString);
   				}

			$e = 0;

			while ($e < 50)
   				{
   					if ((substr($rString, 0, 13) == '<p>&nbsp;</p>') && (strlen($rString) > 13))
      						{
       							$rString = substr($rString, 13, strlen($rString)-13);
       							$e++;
      						}
					else $e = 51;
   					$rString = ltrim($rString);
   				}
			return trim($rString);
		}
?>