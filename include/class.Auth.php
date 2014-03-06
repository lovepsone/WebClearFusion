<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2014 lovepsone
+--------------------------------------------------------+
| Filename: class.Auth.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

class Auth
{
	//private $UserId   = null;
	private $UserName = null;
	private $UserPass = null;
	private $UserData = array(
	'Id' 		=> 0 ,
	'Name' 		=> 'guest',
	'Email' 	=> '',
	'HideEmail' 	=> 0 ,
	'Avatar' 	=> '',
	'level' 	=> 0);

	public function Auth($inputUserName, $inputPassword)
	{
		$this->_Auth($inputUserName, $inputPassword);
	}

	private function _Auth($inputUserName, $inputPassword)
	{
		$this->UserName = strtoupper(addslashes($inputUserName));
		$this->UserPass = SHA1(strtoupper(addslashes($inputUserName).':'.addslashes($inputPassword)));

		if (($row = WCF::$DB->selectRow('SELECT user_id FROM ?_users WHERE `user_name` = ? AND `user_sha_pass_hash` = ?', $this->UserName, $this->UserPass)) != null)
		{
			Auth::setUserCookie((int)$row['user_id']);
		}
		else
		{
			WCF::Redirect("http://".$_SERVER['HTTP_HOST']."/news.php?action=error", true);
		}
	}

	private function GenerateHash($length = 6)
	{
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
		$code = "";

		$clen = strlen($chars) - 1;  
		while (strlen($code) < $length)
		{
			$code .= $chars[mt_rand(0,$clen)];  
		}

		return $code;
	}

	public function getDataUser()
	{
		return $this->UserData;
	}

	public static function setUserCookie($UserId)
	{
		global $_COOKIE;
		$cookie_hash = md5(self::GenerateHash(10));
		
		WCF::$DB->query('UPDATE ?_users SET `user_cookie_hash`= ?, `user_status`= ?d WHERE `user_id` = ?d', $cookie_hash, 1, $UserId);

		setcookie(COOKIES_PREFIX."id", $UserId, time()+60*60*24*30);
		setcookie(COOKIES_PREFIX."hash", $cookie_hash, time()+60*60*24*30);
		$cID = 0; $cHACH = "";
		if (isset($_COOKIE[COOKIES_PREFIX.'id']) && isset($_COOKIE[COOKIES_PREFIX.'hash']))
		{
			$cID = $_COOKIE[COOKIES_PREFIX.'id'];
			$cHACH = $_COOKIE[COOKIES_PREFIX.'hash'];
		}

		$row = WCF::$DB->selectRow('SELECT * FROM ?_users WHERE `user_id` = ?d AND `user_cookie_hash` = ?', $cID, $cHACH);
		if ($row != null)
		{
			$this->UserData = array('Id' => $row['user_id'] , 'Name' => $row['user_name'], 'Email' => $row['user_email'], 'HideEmail' => $row['user_hide_email'], 'Avatar' => $row['user_avatar'], 'level' => $row['user_level']);
		}
	}

	public static function DataAuthUser()
	{
		if (isset($_COOKIE[COOKIES_PREFIX.'id']) && isset($_COOKIE[COOKIES_PREFIX.'hash']))
		{
			$row = WCF::$DB->selectRow('SELECT * FROM ?_users WHERE `user_id` = ?d AND `user_cookie_hash` = ?', $_COOKIE[COOKIES_PREFIX.'id'], $_COOKIE[COOKIES_PREFIX.'hash']);
			if ($row != null)
			{
				
				return array('Id' => $row['user_id'] , 'Name' => $row['user_name'], 'Email' => $row['user_email'], 'HideEmail' => $row['user_hide_email'], 'Avatar' => $row['user_avatar'], 'level' => $row['user_level']);
			}
			else
			{
				WCF::Redirect("http://".$_SERVER['HTTP_HOST']."/news.php?action=error1", true);
			}
		}
		else
		{
			return self::getEmptyUserData();
		}
	}

	public static function logOutUser()
	{
		
		setcookie(COOKIES_PREFIX.'id', '', time() - 3600*24*30*12, '/');
		setcookie(COOKIES_PREFIX.'hash', '', time() - 3600*24*30*12, '/');
		return self::getEmptyUserData();
	}

	// Get Empty User Data
	public static function getEmptyUserData()
	{
		return array('Id' => 0 , 'Name' => 'guest', 'Email' => '', 'HideEmail' => 0, 'Avatar' => '', 'level' => 0);
	}
}
?>