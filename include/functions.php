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

	//=============================================================================================
	// функция коннекта к базе 
	function selectdb($date_base)
		{
  			global $config;
  
  			switch ($date_base):

 			case ("mangos"):
  			$db = $config['dbName'];
  			$ip = $config['hostname'];
  			$userdb = $config['username'];
  			$pw = $config['password'];
  			break;
  
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
  
  			case ("wcf"):
  			$db = $config['wdbName'];
  			$ip = $config['whostname'];
  			$userdb = $config['wusername'];
  			$pw = $config['wpassword'];
  			break;
  
  			endswitch;
  
 			$connect = mysql_connect($ip, $userdb, $pw);
 			mysql_select_db($db, $connect);
			mysql_query("SET NAMES '".$config['encoding']."'");   
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

	//=============================================================================================
	// функция, создающая switch языков,то есть поддержака нескольких языков, при это не 
	// переключаясь в config настройках
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

	//=============================================================================================
	// функция, создающая навигацию, берет данные из module_cfg.php
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

	//=============================================================================================
	// функция добавления \ перед кавычками. Для безопасности дабы Mysql не выдавала ошибку.
	function addslash($text)
		{
			$text = addslashes($text);
			return $text;
		}

	//=============================================================================================
	// пользовательская функция, предназначена для подовления HTML кода в нежелательных местах
	function stripinput($text)
		{
			if (!is_array($text))
				{
					$text = trim($text);
					$search = array("&", "\"", "'", "\\", '\"', "\'", "<", ">", "&nbsp;");
					$replace = array("&amp;", "&quot;", "&#39;", "&#92;", "&quot;", "&#39;", "&lt;", "&gt;", " ");
					$text = preg_replace("/(&amp;)+(?=\#([0-9]{2,3});)/i", "&", str_replace($search, $replace, $text));
				}
			else
				{
					foreach ($exts as $key => $value)
						{
							$text[$key] = stripinput($value);
						}
				}
			return $text;
		}

	//=============================================================================================
	// функция, создающая админку, берет данные из базы mysql
	function admin_page($admin_page,$admin_string)
		{
			selectdb(wcf);
			$administration = mysql_query("SELECT * FROM ".DB_ADMIN." WHERE `admin_page`='$admin_page' AND `admin_string`='$admin_string'") or trigger_error(mysql_error());
					echo"<tr>";
			while ($page_contet = mysql_fetch_array($administration))
				{
					if ($page_contet['admin_colum'] == 1)
						{
							if ($page_contet['admin_image'] <> '') echo"<td width='25%' align='center'><a href='index.php?modul=".$page_contet['admin_link']."'><img src='administration/images/".$page_contet['admin_image']."' align='absmiddle'><br>".$page_contet['admin_title']."</td>";
							else echo"<td width='25%' align='center'><a href='index.php?modul=".$page_contet['admin_link']."'><br>".$page_contet['admin_title']."</td>";
						}
					if ($page_contet['admin_colum'] == 2)
						{
							if ($page_contet['admin_image'] <> '') echo"<td width='25%' align='center'><a href='index.php?modul=".$page_contet['admin_link']."'><img src='administration/images/".$page_contet['admin_image']."' align='absmiddle'><br>".$page_contet['admin_title']."</td>";
							else echo"<td width='25%' align='center'><a href='index.php?modul=".$page_contet['admin_link']."'><br>".$page_contet['admin_title']."</td>";
						}
					if ($page_contet['admin_colum'] == 3)
						{
							if ($page_contet['admin_image'] <> '') echo"<td width='25%' align='center'><a href='index.php?modul=".$page_contet['admin_link']."'><img src='administration/images/".$page_contet['admin_image']."' align='absmiddle'><br>".$page_contet['admin_title']."</td>";
							else echo"<td width='25%' align='center'><a href='index.php?modul=".$page_contet['admin_link']."'><br>".$page_contet['admin_title']."</td>";
						}
					if ($page_contet['admin_colum'] == 4)
						{
							if ($page_contet['admin_image'] <> '') echo"<td width='25%' align='center'><a href='index.php?modul=".$page_contet['admin_link']."'><img src='administration/images/".$page_contet['admin_image']."' align='absmiddle'><br>".$page_contet['admin_title']."</td>";
							else echo"<td width='25%' align='center'><a href='index.php?modul=".$page_contet['admin_link']."'><br>".$page_contet['admin_title']."</td>";
						}
				}
					echo"</tr>";
		}

	//=============================================================================================
	//заменяет &, \, ', \\, <, > эти тэги на спец символы. В этом случаи браузер их не обрабатывает
	function phpentities($text)
		{
			$search = array("&", "\"", "'", "\\", "<", ">");
			$replace = array("&amp;", "&quot;", "&#39;", "&#92;", "&lt;", "&gt;");
			$text = str_replace($search, $replace, $text);
			return $text;
		}

	//=============================================================================================
	// функция возвращает форму
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
    							window.location = 'index.php$url';
    						}
				}
			var myvar = '';
			var timeout = '".$Retime."';
			exec_refresh();
			//--> </script>";
		}

	//=============================================================================================
	// функция исключает понели на отдельных страницах, установленых в настройках
	function check_panel_status($side)
		{
			global $config;
	
			$exclude_list = "";

			if ($side == "center")
				{
					if ($_SERVER['QUERY_STRING'] == "" OR $_SERVER['QUERY_STRING'] == "modul=".$config['default_module'])
						{
							return true;
						}
					else
						{
							return false;
						}
				}
			//================================================
			// остальная часть кода работает некорректно
			elseif ($side == "left")
				{
					if ($config['exclude_left'] != "") {$exclude_list = explode("\r\n", $config['exclude_left']);}
				}
			elseif ($side == "right")
				{
					if ($config['exclude_right'] != "") {$exclude_list = explode("\r\n", $config['exclude_right']);}
				}
	
			if (is_array($exclude_list))
				{
					$exclude_url = explode("&", $_SERVER['QUERY_STRING']);
					if (!in_array($_SERVER['QUERY_STRING'], $exclude_list) && !in_array($exclude_url[0].($_SERVER['QUERY_STRING'] ? "?".$exclude_url[1] : ""), $exclude_list))
						{
							return true;
						}
					else
						{
							return false;
						}
				}
			else
				{
					return true;
				}
		}
?>