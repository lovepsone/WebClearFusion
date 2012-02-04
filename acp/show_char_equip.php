<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2012 lovepsone
+--------------------------------------------------------+
| Filename: show_char_equip.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	require_once INCLUDES."include_characters_3d.php";
	require_once ACP."player_info_generator.php";

	function show_player_equip($guid, $char, $char_data, $char_stat)
		{

 			global $lang;

 			$char_name = $char['name'];
 			$genderId  = $char['gender'];
 			$class     = $char['class'];
 			$race      = $char['race'];
 			$money     = $char['money'];
 			$level     = $char['level'];
 			$health    = $char['health'];
 			$maxhealth = $char_stat['maxhealth'];

 			switch ($char['class']): 
				case 1:  	$powerType = 1;   break;
				case 2:
				case 3:
				case 5:
				case 7:
				case 8:
				case 9:
				case 11:  	$powerType = 0;   break;
				case 4: 	$powerType = 3;   break;
				case 6:  	$powerType = 6;   break;
			endswitch;

 			switch ($powerType): 
				case 0:  $power = $char['power1'];  $maxpower = $char_stat['maxpower1']; break;
				case 1:  $power = $char['power2'];  $maxpower = $char_stat['maxpower2']; break;
				case 3:  $power = $char['power4'];  $maxpower = $char_stat['maxpower4']; break;  
				case 6:  $power = $char['power7'];  $maxpower = $char_stat['maxpower7']; break;
			endswitch;

 			// Ярость надо делить на 10
 			if ($powerType == POWER_RAGE || $powerType == POWER_RUNIC_POWER)
 				{
  					$power = intval($power/10);
  					$maxpower = intval($maxpower/10);
 				}

 			echo"<table cellSpacing='0' border='0'><tr><td>";
 			echo"<table cellSpacing='0' cellPadding='0' border='0px'>";
 			echo"<tbody><tr><td width='420px' height='560px' align='left' valign='top'>";
 			echo"<div style=\"position: relative; border: 0px; left: 0px; top: 0px;\">";
 			if (get_race($race)) { $frame = $genderId."_".$race.".gif"; } else { $frame="TempPortrait.gif"; }
 			echo"<img src='".IMAGES_PI."characterframe/".$frame."' style=\"position: absolute; border: 0px; left: 9px; top: 6px; width: 73px;\">";
 			echo"<img src='".IMAGES_PI."characterframe/characterframe.png' style=\"position: absolute; border: 0px; left: 0px; top: 0px;\">";

 			echo"<table cellspacing='0' class='playerName' style='position: absolute; left: 100px; top: 20px;'>";
 			echo"<tbody>";
			echo"<tr><td class='name'>".$char_name." - ".get_classes($class)." ".$level." lvl</td></tr>";
 			echo"</tbody>";
 			echo"</table>";

			//=======================================================================================
  			// Вычисление и генерация переменных $health и $maxhealth для создания изменяемой полоски
			if ($health > $maxhealth) { $health = $maxhealth; }
 			$maxhealth !=   0 ? $h_percent = round($health/$maxhealth*100,0) : $h_percent = 0;
 			$h_percent ==   0 ? $h_l_on_off = "left-off" : $h_l_on_off = "left-on";
 			$h_percent == 100 ? $h_r_on_off = "right-on" : $h_r_on_off = "right-off";

 			echo"<table cellpadding='0' cellspacing='0' width='325px' style='position:absolute; top:43px; left:86px;'>";
		 	echo"<tbody><tr>";
		 	echo"<td style='position:absolute; width: 328px; font-size:12px;' align = center><font color='white'><b>".$health." / $maxhealth</b></font></td>";
		 	echo"<td style='width: 3px; background: url(".IMAGES_BAR."$h_l_on_off.gif) left no-repeat;'></td>";
		 	echo"<td style='width: ".($h_percent*3.19)."px; height:17px; background: url(".IMAGES_BAR."bar-on.gif) repeat-x;'></td>";
		 	echo"<td style='width: ".(323-$h_percent*3.19)."px; height:17px; background: url(".IMAGES_BAR."bar-off.gif) repeat-x;'></td>";
		 	echo"<td style='width: 3px; background: url(".IMAGES_BAR."$h_r_on_off.gif) right no-repeat;'></td></tr>";
		 	echo"</tbody>";
		 	echo"</table>";

			//=======================================================================================
 			// Вычисление и генерация переменных $power и $maxpower для создания изменяемой полоски
 			if ($power > $maxpower){ $power = $maxpower; }

 			//Цвет полоски
     			if ($powerType == 3) { $typeSlid="energy"; } 	//Энергия
 			elseif ($powerType == 1) { $typeSlid="rage"; }  //Ярость
 			else { $typeSlid="mana"; }   			//Мана

		 	$m_percent  = $maxpower  !=   0 ? round($power/$maxpower*100,0) : 0;
		 	$m_l_on_off = $m_percent ==   0 ? "left-off" : "$typeSlid-left-on";
		 	$m_r_on_off = $m_percent == 100 ? "$typeSlid-right-on" : "right-off";

		 	echo"<table cellpadding='0' cellspacing='0' width='325px' style='position:absolute; top:65px; left:86px'>";
		 	echo"<tbody>";
		 	echo"<tr><td style='position:absolute; width: 330px; font-size:12px;' align='center'><font color='white'><b>$power / $maxpower</b></font></td>";
		 	echo"<td style='width: 3px; height:13px; background: url(".IMAGES_BAR."$m_l_on_off.gif) left no-repeat;'></td>";
		 	echo"<td style='width: ".($m_percent*3.19)."px; height:17px; background: url(".IMAGES_BAR."$typeSlid-bar-on.gif) repeat-x;'></td>";
		 	echo"<td style='width: ".(323-$m_percent*3.19)."px; height:17px; background: url(".IMAGES_BAR."bar-off.gif) repeat-x;'></td>";
		 	echo"<td style='width: 3px; height:13px; background: url(".IMAGES_BAR."$m_r_on_off.gif) right no-repeat;'></td></tr>";
		 	echo"</tbody>";
		 	echo"</table>";

			// 3D characters
		 	echo"<table cellSpacing='0' style='width: 275px; position: absolute; left: 78px; top: 90px;'>";
		 	echo"<tbody>";
 			echo"<tr><td colspan='2' align='center'>";
			show_Player_3d($char, $char_data);
			echo"</td></tr>";
 			echo"</tbody>";
 			echo"</table>";

 			$imgsize="armory";
		 	show_item_from_char($char_data[PLAYER_SLOT_ITEM_HEAD],$guid,$imgsize,26,87,"head");
		 	show_item_from_char($char_data[PLAYER_SLOT_ITEM_NECK],$guid,$imgsize,26,135,"neck");
		 	show_item_from_char($char_data[PLAYER_SLOT_ITEM_SHOULDER],$guid,$imgsize,28,183,"shoulder");
		 	show_item_from_char($char_data[PLAYER_SLOT_ITEM_BACK],$guid,$imgsize,26,232,"back");
		 	show_item_from_char($char_data[PLAYER_SLOT_ITEM_CHEST],$guid,$imgsize,26,281,"chest");
		 	show_item_from_char($char_data[PLAYER_SLOT_ITEM_SHIRT],$guid,$imgsize,26,330,"shirt");
		 	show_item_from_char($char_data[PLAYER_SLOT_ITEM_TABARD],$guid,$imgsize,26,379,"tabard");
		 	show_item_from_char($char_data[PLAYER_SLOT_ITEM_WRIST],$guid,$imgsize,26,425,"wrist");
		 	show_item_from_char($char_data[PLAYER_SLOT_ITEM_GLOVES],$guid,$imgsize,363,87,"gloves");
		 	show_item_from_char($char_data[PLAYER_SLOT_ITEM_BELT],$guid,$imgsize,363,135,"belt");
		 	show_item_from_char($char_data[PLAYER_SLOT_ITEM_LEGS],$guid,$imgsize,363,183,"legs");
		 	show_item_from_char($char_data[PLAYER_SLOT_ITEM_FEET],$guid,$imgsize,363,232,"feet");
		 	show_item_from_char($char_data[PLAYER_SLOT_ITEM_FINGER1],$guid,$imgsize,363,281,"finger");
		 	show_item_from_char($char_data[PLAYER_SLOT_ITEM_FINGER2],$guid,$imgsize,363,330,"finger");
		 	show_item_from_char($char_data[PLAYER_SLOT_ITEM_TRINKET1],$guid,$imgsize,363,379,"trinket");
		 	show_item_from_char($char_data[PLAYER_SLOT_ITEM_TRINKET2],$guid,$imgsize,363,425,"trinket");
		 	show_item_from_char($char_data[PLAYER_SLOT_ITEM_MAIN_HAND],$guid,$imgsize,144,453,"main");
		 	show_item_from_char($char_data[PLAYER_SLOT_ITEM_OFF_HAND],$guid,$imgsize,193,453,"off");
		 	show_item_from_char($char_data[PLAYER_SLOT_ITEM_RANGED],$guid,$imgsize,242,453,"ranged");

			echo"<td valign='top'>";
			show_player_auras_from_db($guid);
			echo"</td>";
			echo"</tr>";
			echo"</table>";
	}
?>