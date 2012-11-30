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