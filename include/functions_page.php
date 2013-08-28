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
			global $txt;

  			switch ($access):

  			case (-1): $result = $txt['genl']; break;
  			case (0): $result = $txt['user']; break;
  			case (1): $result = $txt['moderator']; break;
  			case (2): $result = $txt['vebmaster']; break;
  			case (3): $result = $txt['administrator']; break;
  			case (4): $result = $txt['superadministrator']; break;

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

	//=============================================================================================
	// функция, создающая админку, берет данные из массива
	function admin_page($page,$string,$list)
		{
			global $modules, $module_list;

			echo"<tr>";
			reset($list);
			while (list($id, $data) = each($list))
				{
					if ($data[0] == 1 && $data[1] == $page && $page != 5 && $data[2] == $string)
						{
							echo"<td width='25%' align='center'>";
							echo"<a href='".ADMIN.$data[5]."'>";
							echo"<img src='".ADMIN."images/".$data[3]."' align='absmiddle'>";
							echo"<br>".WCF::$locale[$data[4]]."</td>";
						}
					if ($data[0] == 2 && $data[1] == $page && $page != 5 && $data[2] == $string)
						{
							echo"<td width='25%' align='center'>";
							echo"<a href='".ADMIN.$data[5]."'>";
							echo"<img src='".ADMIN."images/".$data[3]."' align='absmiddle'>";
							echo"<br>".WCF::$locale[$data[4]]."</td>";
						}
					if ($data[0] == 3 && $data[1] == $page && $page != 5 && $data[2] == $string)
						{
							echo"<td width='25%' align='center'>";
							echo"<a href='".ADMIN.$data[5]."'>";
							echo"<img src='".ADMIN."images/".$data[3]."' align='absmiddle'>";
							echo"<br>".WCF::$locale[$data[4]]."</td>";
						}
					if ($data[0] == 4 && $data[1] == $page && $page != 5 && $data[2] == $string)
						{
							echo"<td width='25%' align='center'>";
							echo"<a href='".ADMIN.$data[5]."'>";
							echo"<img src='".ADMIN."images/".$data[3]."' align='absmiddle'>";
							echo"<br>".WCF::$locale[$data[4]]."</td>";
						}
				}
			echo"</tr><tr>";

			$maf = array(); $s = 1; $k=1;
			for ($i=1;$i <= count($modules);$i++)
				{
					$patch_module[$i] = $modules[$module_list[$i]];
					$patch[$i] = $modules[$module_list[$i]]."administration/";
					$maf = admin_files_page($patch[$i]);

					for ($j=0; $j < count($maf); $j++)
						{
							if ($page == 5 && $s == $string && $k == 1)
								{
									$m_exp = explode('.', $maf[$j]);
									$name = $m_exp[0];
									echo"<td width='25%' align='center'>";
									echo"<a href='".$patch[$i].$maf[$j]."'>";
									echo"<img src='".$patch_module[$i]."images/admin/".$name.".gif' align='absmiddle'>";
									echo"<br>".$name."</td>";
								}
							if ($page == 5 && $s == $string && $k == 2)
								{
									$m_exp = explode('.', $maf[$j]);
									$name = $m_exp[0];
									echo"<td width='25%' align='center'>";
									echo"<a href='".$patch[$i].$maf[$j]."'>";
									echo"<img src='".$patch_module[$i]."images/admin/".$name.".gif' align='absmiddle'>";
									echo"<br>".$name."</td>";
								}
							if ($page == 5 && $s == $string && $k == 3)
								{
									$m_exp = explode('.', $maf[$j]);
									$name = $m_exp[0];
									echo"<td width='25%' align='center'>";
									echo"<a href='".$patch[$i].$maf[$j]."'>";
									echo"<img src='".$patch_module[$i]."images/admin/".$name.".gif' align='absmiddle'>";
									echo"<br>".$name."</td>";
								}
							if ($page == 5 && $s == $string && $k == 4)
								{
									$m_exp = explode('.', $maf[$j]);
									$name = $m_exp[0];
									echo"<td width='25%' align='center'>";
									echo"<a href='".$patch[$i].$maf[$j]."'>";
									echo"<img src='".$patch_module[$i]."images/admin/".$name.".gif' align='absmiddle'>";
									echo"<br>".$name."</td>";
								}
							if ($k == 4)
								{
									$k = 1; $s++;
									echo "</tr><tr>";
								}
							$k++;
						}
				}
			echo"</tr>";
		}
?>