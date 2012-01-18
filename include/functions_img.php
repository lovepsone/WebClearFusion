<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2012 lovepsone
+--------------------------------------------------------+
| Filename: functions_img.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	function avatar_img($avatar_img)
		{
  			if ($avatar_img != "")
				{
			  		return "<img src='".IMAGES_A.$avatar_img."'/>";
				}
			else
				{
					return "<img src='".IMAGES_A."null-avatar.gif'/>";
				}
		}
?>