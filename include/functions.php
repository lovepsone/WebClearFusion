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

	function get_player_faction($race)
		{
			selectdb(wcf);
 			$result = db_query("SELECT `id` AS ARRAY_KEY, `team` FROM ".DB_CHR_RACES."");
			$i = 1; $data = array();
			while ($mas_data = db_array($result))
				{
					if ($mas_data['ARRAY_KEY'] == $race) { $data[$i] = $mas_data['team']; }	
					$i++;	
				}
 			return isset($data[$race]) ? $data[$race] : 2;
		}

	function get_faction_image($race)
		{
			$faction = get_player_faction($race);
 			if ($faction == 0) return "<img width='20' src='".IMAGES_PI."factions_img/alliance.gif'>";
 			if ($faction == 1) return "<img width='20' src='".IMAGES_PI."factions_img/horde.gif'>";
 			return 0;
		}

	function get_race_image($race, $genderid)
		{
 			return "<img width='20' src='".IMAGES_PI."race_img/".$race."_".$genderid.".gif'>";
		}

	function get_class_image($class)
		{
 			return "<img width='20' src='".IMAGES_PI."class_img/".$class.".gif'>";
		}
?>