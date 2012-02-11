<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2012 lovepsone
+--------------------------------------------------------+
| Filename: include_characters_3d.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	// 3D модель
	// получаем displayid вещи
	function wowhead_did($item)
		{
			global $_SESSION;
			selectdb(mangos_r.$_SESSION['realmd_id']);
    			$displayid = db_assoc(db_query("SELECT `displayid` FROM `item_template` WHERE `entry`='".$item."'"));
    			echo $displayid['displayid'];
		}

	// получаем расу и класс в виде, пригодном для WH 3D просмотрщика
	function char_race_gender($race, $gender)
		{
    			$char_race = array(
			        1 => 'human',
			        2 => 'orc',
			        3 => 'dwarf',
			        4 => 'nightelf',
			        5 => 'scourge',
			        6 => 'tauren',
			        7 => 'gnome',
			        8 => 'troll',
			        10 => 'bloodelf',
			        11 => 'draenei');

    			$char_gender = array(
			        0 => 'male',
			        1 => 'female');

    			echo $char_race[$race].$char_gender[$gender];
		}

function show_player_3d($char, $char_data){
?>
 <div id="model_scene" align="center">
 <object id="wowhead" type="application/x-shockwave-flash" data="http://static.wowhead.com/modelviewer/ModelView.swf" height="353px" width="273px"> 
 <param name="quality" value="high">
 <param name="allowscriptaccess" value="always">
 <param name="menu" value="false">
 <param value="transparent" name="wmode">
 <param name="flashvars" value="model=<?php char_race_gender($char['race'], $char['gender']); ?>&amp;modelType=16&amp;ha=0&amp;hc=0&amp;fa=0&amp;sk=0&amp;fh=0&amp;fc=0&amp;contentPath=http://static.wowhead.com/modelviewer/&amp;blur=1&amp;equipList=1,<?php wowhead_did($char_data[PLAYER_SLOT_ITEM_HEAD]); ?>,3,<?php wowhead_did($char_data[PLAYER_SLOT_ITEM_SHOULDER]); ?>,16,<?php wowhead_did($char_data[PLAYER_SLOT_ITEM_BACK]); ?>,5,<?php wowhead_did($char_data[PLAYER_SLOT_ITEM_CHEST]); ?>,9,<?php wowhead_did($char_data[PLAYER_SLOT_ITEM_WRIST]); ?>,10,<?php wowhead_did($char_data[PLAYER_SLOT_ITEM_GLOVES]); ?>,6,<?php wowhead_did($char_data[PLAYER_SLOT_ITEM_BELT]); ?>,7,<?php wowhead_did($char_data[PLAYER_SLOT_ITEM_LEGS]); ?>,8,<?php wowhead_did($char_data[PLAYER_SLOT_ITEM_FEET]); ?>,14,<?php wowhead_did($char_data[PLAYER_SLOT_ITEM_OFF_HAND]); ?>,21,<?php wowhead_did($char_data[PLAYER_SLOT_ITEM_MAIN_HAND]); ?>">
 <param name="movie" value="http://static.wowhead.com/modelviewer/ModelView.swf">
 </object>
 </div>
<?php
}
?>