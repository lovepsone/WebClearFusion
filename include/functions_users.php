<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2012 lovepsone
+--------------------------------------------------------+
| Filename: functions_users.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	function check_kcaptcha_enable()
	{
	  	global $_SESSION, $_POST;

		if (WCF::$settings['kcaptcha_enable_auth'] == 1 && isset($_POST['kapcha_code']))
   		{
			require_once S_KCAPTCHA."securimage.php";
			$securimage = new Securimage();
			if ($securimage->check($_POST['kapcha_code']) == true)
				return true;
   		}
		elseif (WCF::$settings['kcaptcha_enable_auth'] == 0)
		{
			return true;
		}
		return false;
	}

	function check_user($visibility)
		{
	  		global $_SESSION;

			if ($visibility == -1) { return true; }
			else if ($visibility <= $_SESSION['gmlevel']) { return true; }
			else { return false; }
				
			
		}

	function access($data)
		{
			global $access,$txt;

			$list = "";
    			reset($access);

			if ($data == "")
				{
					for ($i=1;$i <= count($access);$i++)
						{
							$list .= "<option value='".$access[$i]['access']."'>".$txt[$access[$i]['txt']]."</option>";
						}

				}
			elseif ($data != "")
				{
					for ($i=1;$i <= count($access);$i++)
						{
							$list .= "<option value='".$access[$i]['access']."'".($data == $access[$i]['access'] ? " selected='selected'" : "").">".$txt[$access[$i]['txt']]."</option>";
						}
				}
			return $list;
		}
?>