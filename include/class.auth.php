<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: class.auth.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

class WCFAuth
{
	public $username;
	public $password;
	public $shaHash;
	public $securimage;
	public $post_kcaptcha;

	public function AuthUser()
	{
		if(!$this->username || !$this->password)
		{
			WCF::Log()->writeError('%s : username or password not defined', __METHOD__);
			return false;
		}
		$result = WCF::$DB->db_query("SELECT `user_sha_pass_hash` FROM ".DB_USERS." WHERE `user_name`='$this->username' LIMIT 1");
		$data = WCF::$DB->db_assoc($result);
		if(!$result)
		{
			WCF::Log()->writeError('%s : unable to get data from DB for account %s', __METHOD__, $this->username);
			return false;
		}
		elseif(strtoupper($data['user_sha_pass_hash']) != strtoupper($this->GenerateShaHash()))
		{
			WCF::Log()->writeError('%s : sha_pass_hash and generated SHA1 hash are different (%s and %s), unable to auth user.', __METHOD__, strtoupper($data['user_sha_pass_hash']), $this->GenerateShaHash());
			return false;
		}
		elseif(self::check_kcaptcha())
		{
			$_SESSION['user_id'] = (int)$data['user_id'];
			$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
			$_SESSION['gmlevel'] = (int)$data['user_gmlevel'];
			$_SESSION['user_name']  = $this->username;
			$_SESSION['bonuses'] = (int)$data['user_bonuses'];
			$_SESSION['lang'] = WCF::$settings['lang'];
			return true;
        	}
	}

	public function CloseSession()
	{
    		unset($_SESSION['user_id']);
    		unset($_SESSION['ip']);
		unset($_SESSION['user_name']);
		unset($_SESSION['password']);
		unset($_SESSION['gmlevel']);
		unset($_SESSION['bonuses']);
		return true;
    	}

	public function check_kcaptcha()
	{
		if (WCF::$settings['kcaptcha_enable_auth'] == 1)
   		{
			require_once(dirname(__FILE__).'/securimages/securimage.php');

			$securimage = new Securimage();
			if ($securimage->check($post_kcaptcha) == true)
				return true;
   		}
		elseif (WCF::$settings['kcaptcha_enable_auth'] == 0)
		{
			return true;
		}
		return false;
	}

	public function GenerateShaHash()
	{
		if(!$this->username || !$this->password)
		{
			WCF::Log()->writeError('%s : username or password not defined', __METHOD__);
            		return false;
		}
		$this->shaHash = SHA1(strtoupper(addslashes($this->username)).':'.strtoupper(addslashes($this->password)));
		return strtoupper($this->shaHash);
	}
}
?>