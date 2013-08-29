<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2012 lovepsone
+--------------------------------------------------------+
| Filename: functions_page.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	//=============================================================================================
	// функция, показывающая доступ
	function display_access_form($access)
		{
  			switch ($access):

  			case (-1): $result = WCF::$locale['genl']; break;
  			case (0): $result = WCF::$locale['user']; break;
  			case (1): $result = WCF::$locale['moderator']; break;
  			case (2): $result = WCF::$locale['vebmaster']; break;
  			case (3): $result = WCF::$locale['administrator']; break;
  			case (4): $result = WCF::$locale['superadministrator']; break;

  			endswitch;

			return $result;
		}

	//=============================================================================================
	// функция, создающая навигацию
	function show_page($LinkText,$Page,$AllPages)
		{
			$Page = intval($Page);
			$AllPages = intval($AllPages);
			if ($Page > $AllPages) $Page = 1;
			$text ="<table border='0' cellpadding='5' cellspacing='3'><tr>";
			if ($AllPages < 16)
				{
   					for ($i = 1; $i <= $AllPages; $i++)
						{
       							if ($i == $Page)  $text .= "<td>$i</td>";
       							else $text .= "<td><a href='$LinkText$i' target='_self'>$i</a></td>";
      						}
  				} 
			else
				{
    					if ($Page < 6)
						{
        						for ($i = 1; $i <= 6; $i++)
								{
            								if ($i == $Page)  $text .= "<td>$i</td>";
            								else $text .= "<td><a href='$LinkText$i' target='_self'>$i</a></td>";
            							}
        						$text .= "<td>...</td>";
        						$text .= "<td><a href='$LinkText($AllPages-2)' target='_self'>($AllPages-2)</a></td>";
        						$text .= "<td><a href='$LinkText($AllPages-1)' target='_self'>($AllPages-1)</a></td>";
        						$text .= "<td><a href='$LinkText$AllPages' target='_self'>$AllPages</a></td>";
        					}

    					else if ($Page > ($AllPages-5))
						{
        						$text .= "<td><a href='$LinkText1' target='_self'>1</a></td>";
        						$text .= "<td><a href='$LinkText2' target='_self'>2</a></td>";
        						$text .= "<td><a href='$LinkText3' target='_self'>3</a></td>";
        						$text .= "<td>...</td>";

        						for ($i = ($AllPages-5); $i <= $AllPages; $i++)
								{
            								if ($i == $Page)  $text .= "<td>$i</td>";
            								else $text .= "<td><a href='$LinkText$i' target='_self'>$i</a></td>";
            							}
        					}
    					else
						{
        						$text .= "<td><a href='$LinkText1' target='_self'>1</a></td>";
        						$text .= "<td><a href='$LinkText2' target='_self'>2</a></td>";
        						$text .= "<td><a href='$LinkText3' target='_self'>3</a></td>";
        						$text .= "<td>...</td>";
        						$text .= "<td><a href='$LinkText($Page-1)' target='_self'>($Page-1)</a></td>";
        						$text .= "<td>$Page</td>";
        						$text .= "<td><a href='$LinkText($Page+1)' target='_self'>($Page+1)</a></td>";
        						$text .= "<td>...</td>";
        						$text .= "<td><a href='$LinkText($AllPages-2)' target='_self'>($AllPages-2)</a></td>";
        						$text .= "<td><a href='$LinkText($AllPages-1)' target='_self'>($AllPages-1)</a></td>";
        						$text .= "<td><a href='$LinkText$AllPages' target='_self'>$AllPages</a></td>";
        					}
  				}
			$text .= "</tr></table>";
			return $text;
		}
	//=============================================================================================
	// функция чтения элементов каталога и заносит их в массив
	function admin_files_page($patch)
		{
			$temp = opendir($patch);
			while (false !== ($file = readdir($temp)))
				{ 
					if (!in_array($file, array(".","..")) && !strstr($file, "_")) { $file_list[] = $file; }
				}
			closedir($temp); sort($file_list);
			return $file_list;
		}
?>