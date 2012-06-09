<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2012 lovepsone
+--------------------------------------------------------+
| Filename: maincore.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	if (preg_match("/maincore.php/i", $_SERVER['PHP_SELF'])) { die(); }

	error_reporting(E_ALL);
	ini_set('display_errors',0);
	set_error_handler('user_log');

	//=============================================================================================================
	// �������������� ��������� ���� ����� XSS $_GET.
	//=============================================================================================================
	if (stripget($_GET)) { die("Prevented a XSS attack through a GET variable!"); }

	//=============================================================================================================
	// ��������� ������\Start the session
	//=============================================================================================================
	session_start();
	ob_start();

	//=============================================================================================================
	// ���� conf.php � ������������� ����\Looking for conf.php and set the path
	//=============================================================================================================
	$folder_level = ""; $i = 0;
	while (!file_exists($folder_level."conf.php"))
		{
			$folder_level .= "../"; $i++;
			if ($i == 7) { die("Config file not found"); }
		}
	require_once $folder_level."conf.php";
	define("BASEDIR", $folder_level);

	//=============================================================================================================
	// ��������� �������� ������� � ������������ �����������\Run the basic functions and determination of multisite
	//=============================================================================================================
	require_once BASEDIR."include/classes/class.debug.php";
	require_once BASEDIR."include/include_multi_site.php";
	require_once BASEDIR."include/functions_files.php";
	require_once BASEDIR."include/functions_img.php";
	require_once BASEDIR."include/functions_mysql.php";
	require_once BASEDIR."include/functions_page.php";
	require_once BASEDIR."include/functions_text_process.php";
	require_once BASEDIR."include/functions_theme.php";
	require_once BASEDIR."include/functions_users.php";
	require_once BASEDIR."include/include_access_list.php";

	//=============================================================================================================
	// ���������� ���������� � ���������\Run the setup
	//=============================================================================================================
	$_SERVER['QUERY_STRING'] = isset($_SERVER['QUERY_STRING']) ? cleanurl($_SERVER['QUERY_STRING']) : "";
	$_SERVER['PHP_SELF'] = cleanurl($_SERVER['PHP_SELF']);

	define("IN_WCF", TRUE);
	define("WCF_QUERY", isset($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : "");
	define("WCF_SELF", basename($_SERVER['PHP_SELF']));

	//=============================================================================================================
	// ��������� ���������\Run the setup
	//=============================================================================================================
	$debugs = new WCFDebug($config);
	selectdb("wcf");
	$result = db_query("SELECT * FROM ".DB_SETTINGS."");
	if ($result)
		{
			while ($data = db_array($result))
				{
					$config[$data['settings_name']] = $data['settings_value'];
				}
			$debugs -> writeLog('Settings: succesful loading');
		}
	else { die("Settings do not exist or no connection to base mysql. May not correctly configured conf.php."); }

	require_once BASEDIR."include/include_auth.php";
	require_once BASEDIR."include/include_protect.php";

	//=============================================================================================================
	// ����� ������ ���������\When choosing a character encoding
	//=============================================================================================================
	if ($config['encoding'] == 'cp1251') { $code_page = 'windows-1251'; } else { $code_page = 'utf-8'; }
	$debugs -> writeLog('Encoding: %s', $code_page);

	//=============================================================================================================
	// ����� ������� �����\Choosing the right language
	//=============================================================================================================
	if (isset($_GET['lang'])) { $config['lang'] = $_GET['lang']; } else { $_SESSION['lang'] = $config['lang']; }
	if ($config['lang']) { require BASEDIR."lang/".$config['lang']."/".$config['encoding']."/text.php"; }
	$debugs -> writeLog('Lang: %s', $_SESSION['lang']);

	//=============================================================================================================
	// ��������� ������ ����\Setting the right topic
	//=============================================================================================================
	$cssfile = THEMES.$config['theme']."/style.css";
	$themefile = THEMES.$config['theme']."/theme.php";

	if (file_exists($themefile))
		{
			$debugs -> writeLog('Theme: sucessful loading %s ', $config['theme']);
			include($themefile);
		}
	else
		{
			$debugs -> writeError('Teme: error loading %s', $config['theme']);
			include(THEMES."default/theme.php");
		}
	if (!file_exists($cssfile)) { $cssfile = THEMES."default/style.css"; }

//=====================================================================================================================
// ���� ������������ ������� ������ � ������ �����\Below are the security features of the site and
//=====================================================================================================================

	//=============================================================================================================
	// �������������� ��������� ���� ����� XSS $_GET.
	//=============================================================================================================
	function stripget($check_url)
		{
			$return = false;
			if (is_array($check_url))
				{
					foreach ($check_url as $value)
						{
							$return = stripget($value);
							if ($return == true) { return true; }
						}
				}
			else
				{
					$check_url = str_replace("\"", "", $check_url);
					$check_url = str_replace("\'", "", $check_url);

					if ((preg_match("/<[^>]*script*\"?[^>]*>/i", $check_url)) || (preg_match("/<[^>]*object*\"?[^>]*>/i", $check_url)) ||
						(preg_match("/<[^>]*iframe*\"?[^>]*>/i", $check_url)) || (preg_match("/<[^>]*applet*\"?[^>]*>/i", $check_url)) ||
						(preg_match("/<[^>]*meta*\"?[^>]*>/i", $check_url)) || (preg_match("/<[^>]*style*\"?[^>]*>/i", $check_url)) ||
						(preg_match("/<[^>]*form*\"?[^>]*>/i", $check_url)) || (preg_match("/\([^>]*\"?[^)]*\)/i", $check_url)))
						{
							$return = true;
						}
				}
			return $return;
		}

	//=============================================================================================
	// ������� ���������������� �� $location �������� 
	function redirect($location, $script = false)
		{
			if (!$script)
				{
					header("Location: ".str_replace("&amp;", "&", $location));
					exit;
				}
			else
				{
					echo "<script type='text/javascript'>document.location.href='".str_replace("&amp;", "&", $location)."'</script>\n";
					exit;
				}
		}

	//=============================================================================================================
	// ������� ������ URL, ������������� ���� � ���������� ����������
	//=============================================================================================================
	function cleanurl($url)
		{
			$bad_entities = array("&", "\"", "'", '\"', "\'", "<", ">", "(", ")", "*");
			$safe_entities = array("&amp;", "", "", "", "", "", "", "", "", "");
			$url = str_replace($bad_entities, $safe_entities, $url);
			return $url;
		}

	//=============================================================================================================
	// ������� ��������� ���� �����
	//=============================================================================================================
	function isnum($value)
		{
			if (!is_array($value))
				{
					return (preg_match("/^[0-9]+$/", $value));
				}
			else
				{
					return false;
				}
		}

	//=============================================================================================================
	// Trim a line of text to a preferred length
	//=============================================================================================================
	function trimlink($text, $length)
		{
			$dec = array("&", "\"", "'", "\\", '\"', "\'", "<", ">");
			$enc = array("&amp;", "&quot;", "&#39;", "&#92;", "&quot;", "&#39;", "&lt;", "&gt;");
			$text = str_replace($enc, $dec, $text);
			if (strlen($text) > $length) $text = substr($text, 0, ($length-3))."...";
			$text = str_replace($dec, $enc, $text);
			return $text;
		}


	//=============================================================================================================
	// ������� ������� ����, ���������� ������
	//=============================================================================================================
	$exclude_errors = array(
		'2'=> 'fsockopen()', 	// ��������� ����� ������ � ��������
		'2048'=> 'date()',	// ��������� ����� ������ � �����
		'2'=> 'filemtime()',	// ��������� ����� ������ � ��������
		'2'=> 'Division',	// ��������� ����� ������ � �������� �� 0
	);

	function user_log($errno, $errmsg, $file, $line)
		{
			global $exclude_errors, $config;

			if ($config['errors_reporting'] == "0") { return; }
			$timestamp = time(); // ���������� ���� ����
			$timestamp = date("H:i:s d.m.Y", $timestamp);
			$file_max_sixe = 1*1042; // ������ ����
			$patch = $file; // ���� � �����

			$file_mas = explode("\\", $file);
			$file_count = count($file_mas);
			$file = $file_mas[$file_count - 1];
			$file_err = $file_mas[$file_count - 1].".js"; // �������� ���� ����

			$open = @fopen(BASEDIR."cache/logs/".$file_err, "r"); // ��������� ���������� �� ����� logs

			$err_msg_mass = explode(" ", $errmsg);
			$err_in_function_exclude = $err_msg_mass[0];

			if (!$open)
				{
					mkdir(BASEDIR."cache/logs/", 0700);
  				}
			else
				{
					fclose($open);
				}

			if (is_file(BASEDIR."cache/logs/".$file_err) && filesize(BASEDIR."cache/logs/".$file_err) >= $file_max_sixe)
				{
					unlink(BASEDIR."cache/logs/".$file_err);
				}

			$err_str = "date: ".$timestamp."\n";
			$err_str .= "error kode: ".$errno."\n"; 
			$err_str .= "file with an error: ".$file."\n";
     			$err_str .= "patch: ".$patch."\n";
			$err_str .= "line in the file: ".$line."\n"; 
			$err_str .= "error message: ".$errmsg."\n";
			$err_str .= "==================================================\n";

			if ($exclude_errors[$errno] != $err_in_function_exclude)
				{
					error_log($err_str, 3, BASEDIR."cache/logs/".$file_err);
				}
		}

	//=============================================================================================================
	// ���������� ������\Include in modules
	//=============================================================================================================
	require_once BASEDIR."module.php";
?>