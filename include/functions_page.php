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
			if ($access == -1) { return $txt['genl']; }
			else if ($access == 0) { return $txt['user']; }
			else if ($access == 1) { return $txt['moderator']; }
			else if ($access == 2) { return $txt['vebmaster']; }
			else if ($access == 3) { return $txt['administrator']; }
			else if ($access == 4) { return $txt['superadministrator']; }
			else { return false; }
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
	// функция, создающая админку, берет данные из базы mysql
	function admin_page($admin_page,$admin_string)
		{
			selectdb(wcf);
			$administration = db_query("SELECT * FROM ".DB_ADMIN." WHERE `admin_page`='$admin_page' AND `admin_string`='$admin_string'") or trigger_error(mysql_error());
			echo"<tr>";
			while ($page_contet = db_array($administration))
				{
					if ($page_contet['admin_colum'] == 1)
						{
							if ($page_contet['admin_image'] != "") { echo"<td width='25%' align='center'><a href='".ADMIN.$page_contet['admin_link']."'><img src='".ADMIN."images/".$page_contet['admin_image']."' align='absmiddle'><br>".$page_contet['admin_title']."</td>"; }
							else { echo"<td width='25%' align='center'><a href='".ADMIN.$page_contet['admin_link']."'><br>".$page_contet['admin_title']."</td>"; }
						}
					if ($page_contet['admin_colum'] == 2)
						{
							if ($page_contet['admin_image'] != "") { echo"<td width='25%' align='center'><a href='".ADMIN.$page_contet['admin_link']."'><img src='".ADMIN."images/".$page_contet['admin_image']."' align='absmiddle'><br>".$page_contet['admin_title']."</td>"; }
							else { echo"<td width='25%' align='center'><a href='".ADMIN.$page_contet['admin_link']."'><br>".$page_contet['admin_title']."</td>"; }
						}
					if ($page_contet['admin_colum'] == 3)
						{
							if ($page_contet['admin_image'] != "") { echo"<td width='25%' align='center'><a href='".ADMIN.$page_contet['admin_link']."'><img src='".ADMIN."images/".$page_contet['admin_image']."' align='absmiddle'><br>".$page_contet['admin_title']."</td>"; }
							else { echo"<td width='25%' align='center'><a href='".ADMIN.$page_contet['admin_link']."'><br>".$page_contet['admin_title']."</td>"; }
						}
					if ($page_contet['admin_colum'] == 4)
						{
							if ($page_contet['admin_image'] != "") { echo"<td width='25%' align='center'><a href='".ADMIN.$page_contet['admin_link']."'><img src='".ADMIN."images/".$page_contet['admin_image']."' align='absmiddle'><br>".$page_contet['admin_title']."</td>"; }
							else { echo"<td width='25%' align='center'><a href='".ADMIN.$page_contet['admin_link']."'><br>".$page_contet['admin_title']."</td>"; }
						}
					if ($page_contet['admin_colum'] == 5)
						{
							if ($page_contet['admin_image'] != "") { echo"<td width='25%' align='center'><a href='".ADMIN.$page_contet['admin_link']."'><img src='".ADMIN."images/".$page_contet['admin_image']."' align='absmiddle'><br>".$page_contet['admin_title']."</td>"; }
							else { echo"<td width='25%' align='center'><a href='".ADMIN.$page_contet['admin_link']."'><br>".$page_contet['admin_title']."</td>"; }
						}
				}
					echo"</tr>";
		}

	//=============================================================================================
	// функция возвращает форму (страницу)
	function return_form($Retime,$url)
		{
			echo"<script type='text/javascript'> <!--
			function exec_refresh()
				{
  					window.status = 'reloading...' + myvar;
  					myvar = myvar + ' .';
  					var timerID = setTimeout('exec_refresh();', 100);
  					if (timeout > 0)
						{
							timeout -= 1;
						}
					else
						{
    							clearTimeout(timerID);
    							window.status = '';
    							window.location = '$url';
    						}
				}
			var myvar = '';
			var timeout = '".$Retime."';
			exec_refresh();
			//--> </script>";
		}
?>