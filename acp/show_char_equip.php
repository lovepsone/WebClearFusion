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

 			// ������ ���� ������ �� 10
 			if ($powerType == POWER_RAGE || $powerType == POWER_RUNIC_POWER)
 				{
  					$power = intval($power/10);
  					$maxpower = intval($maxpower/10);
 				}

 			echo"<table cellSpacing='0' border='0'><tr><td>";
 			echo"<table cellSpacing='0' cellPadding='0' border='0px'>";
 			echo"<tbody><tr><td width='356px' height='468px' align='left' valign='top'>";
 			echo"<div style=\"position: relative; border: 0px; left: 0px; top: 0px;\">";
 			if (get_race($race)) { $frame = $genderId."_".$race.".gif"; } else { $frame="TempPortrait.gif"; }
 			echo"<img src='".IMAGES_PI."characterframe/".$frame."' style=\"position: absolute; border: 0px; left: 9px; top: 6px;\">";
 			echo"<img src='".IMAGES_PI."characterframe/characterframe.png' style=\"position: absolute; border: 0px; left: 0px; top: 0px;\">";
 			echo"<table cellspacing='0' class='playerName' style='position: absolute; left: 73px; top: 15px;'>";
 			echo"<tbody>";
			echo"<tr><td class='name'>".$char_name." - ".get_classes($class)." ".$level." lvl</td></tr>";
 			echo"</tbody>";
 			echo"</table>";

  			// ���������� � ��������� ���������� $health � $maxhealth ��� �������� ���������� �������
 			if ($health > $maxhealth) { $health = $maxhealth; }
 			$maxhealth !=   0 ? $h_percent = round($health/$maxhealth*100,0) : $h_percent = 0;
 			$h_percent ==   0 ? $h_l_on_off = "left-off" : $h_l_on_off = "left-on";
 			$h_percent == 100 ? $h_r_on_off = "right-on" : $h_r_on_off = "right-off";

 			echo"<table cellpadding='0' cellspacing='0' width='275px' style='position:absolute; top:37px; left:73px;'>";
		 	echo"<tbody><tr>";
		 	echo"<td style='position:absolute; width: 275px; font-size:10px;' align = center><font color='white'><b>$health / $maxhealth</b></font></td>";
		 	echo"<td style='width: 6px; background: url(".IMAGES_BAR."$h_l_on_off.gif) left no-repeat;'></td>";
		 	echo"<td style='width: ".($h_percent*2.75)."px; height:13px; background: url(".IMAGES_BAR."bar-on.gif) repeat-x;'></td>";
		 	echo"<td style='width: ".(275-$h_percent*2.75)."px; height:13px; background: url(".IMAGES_BAR."bar-off.gif) repeat-x;'></td>";
		 	echo"<td style='width: 6px;background: url(".IMAGES_BAR."$h_r_on_off.gif) right no-repeat;'></td></tr>";
		 	echo"</tbody>";
		 	echo"</table>";

 			// ���������� � ��������� ���������� $power � $maxpower ��� �������� ���������� �������
 			if ($power > $maxpower){ $power = $maxpower; }

 			//���� �������
     			if ($powerType == 3) { $typeSlid="energy"; } 	//�������
 			elseif ($powerType == 1) { $typeSlid="rage"; }  //������
 			else { $typeSlid="mana"; }   			//����

		 	$m_percent  = $maxpower  !=   0 ? round($power/$maxpower*100,0) : 0;
		 	$m_l_on_off = $m_percent ==   0 ? "left-off" : "$typeSlid-left-on";
		 	$m_r_on_off = $m_percent == 100 ? "$typeSlid-right-on" : "right-off";

		 	echo"<table cellpadding='0' cellspacing='0' width='275px' style='position:absolute; top:55px; left:73px'>";
		 	echo"<tbody>";
		 	echo"<tr><td style='position:absolute; width: 275px; font-size:10px;' align='center'><font color='white'><b>$power / $maxpower</b></font></td>";
		 	echo"<td style='width: 6px; height:13px; background: url(".IMAGES_BAR."$m_l_on_off.gif) left no-repeat;'></td>";
		 	echo"<td style='width: ".($m_percent*2.75)."px; height:13px; background: url(".IMAGES_BAR."$typeSlid-bar-on.gif) repeat-x;'></td>";
		 	echo"<td style='width: ".(275-$m_percent*2.75)."px; height:13px; background: url(".IMAGES_BAR."bar-off.gif) repeat-x;'></td>";
		 	echo"<td style='width: 6px; height:13px; background: url(".IMAGES_BAR."$m_r_on_off.gif) right no-repeat;'></td></tr>";
		 	echo"</tbody>";
		 	echo"</table>";

			// 3D characters
		 	echo"<table cellSpacing='0' style='width: 230px; position: absolute; left: 68px; top: 78px;'>";
		 	echo"<tbody>";
 			echo"<tr><td colspan='2' align='center'>";
			show_Player_3d($char, $char_data);
			echo"</td></tr>";
 			echo"</tbody>";
 			echo"</table>";

 			$imgsize="armory";
		 	show_item_from_char($char_data[PLAYER_SLOT_ITEM_HEAD],$guid,$imgsize,22,73);
		 	show_item_from_char($char_data[PLAYER_SLOT_ITEM_NECK],$guid,$imgsize,22,114);
		 	show_item_from_char($char_data[PLAYER_SLOT_ITEM_SHOULDER],$guid,$imgsize,22,155);
		 	show_item_from_char($char_data[PLAYER_SLOT_ITEM_BACK],$guid,$imgsize,22,196);
		 	show_item_from_char($char_data[PLAYER_SLOT_ITEM_CHEST],$guid,$imgsize,22,237);
		 	show_item_from_char($char_data[PLAYER_SLOT_ITEM_SHIRT],$guid,$imgsize,22,278);
		 	show_item_from_char($char_data[PLAYER_SLOT_ITEM_TABARD],$guid,$imgsize,22,319);
		 	show_item_from_char($char_data[PLAYER_SLOT_ITEM_WRIST],$guid,$imgsize,22,360);
		 	show_item_from_char($char_data[PLAYER_SLOT_ITEM_GLOVES],$guid,$imgsize,306,73);
		 	show_item_from_char($char_data[PLAYER_SLOT_ITEM_BELT],$guid,$imgsize,306,114);
		 	show_item_from_char($char_data[PLAYER_SLOT_ITEM_LEGS],$guid,$imgsize,306,155);
		 	show_item_from_char($char_data[PLAYER_SLOT_ITEM_FEET],$guid,$imgsize,306,196);
		 	show_item_from_char($char_data[PLAYER_SLOT_ITEM_FINGER1],$guid,$imgsize,306,237);
		 	show_item_from_char($char_data[PLAYER_SLOT_ITEM_FINGER2],$guid,$imgsize,306,278);
		 	show_item_from_char($char_data[PLAYER_SLOT_ITEM_TRINKET1],$guid,$imgsize,306,319);
		 	show_item_from_char($char_data[PLAYER_SLOT_ITEM_TRINKET2],$guid,$imgsize,306,360);
		 	show_item_from_char($char_data[PLAYER_SLOT_ITEM_MAIN_HAND],$guid,$imgsize,122,384);
		 	show_item_from_char($char_data[PLAYER_SLOT_ITEM_OFF_HAND],$guid,$imgsize,164,384);
		 	show_item_from_char($char_data[PLAYER_SLOT_ITEM_RANGED],$guid,$imgsize,206,384);

			echo"<td valign='top'>";
			show_player_auras_from_db($guid);
			echo"</td>";
			echo"</tr>";
			echo"</table>";
	}
?>