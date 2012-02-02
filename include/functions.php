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

	function get_locale($locale)
		{
  			switch ($locale):
      			case 0:
      			$locale = "English";
      			break;
  
    			case 1:
      			$locale = "Korean";
      			break;
    
    			case 2:
      			$locale = "French";
      			break;

    			case 3:
      			$locale = "German";
      			break;
      
    			case 4:
      			$locale = "Chinese";
      			break;
      
    			case 5:
      			$locale = "Taiwanese";
     			break;
      
    			case 6:
      			$locale = "Spanish";
      			break;
      
    			case 7:
      			$locale = "Spanish Mexico";
      			break;
      
    			case 8:
      			$locale = "Russian";
      			break;

  			endswitch;

			return $locale;
		}

	function localise_item(&$item)
		{
  			global $_SESSION, $config;

			// нужно написать доп. функцию для определения языка, пока что будет русский
   			//$locale = $config['lang'];
			$locale = 8;
   			if ($locale == 0 OR $item['entry'] == 0) { return; }

			selectdb(mangos_r.$_SESSION['realmd_id']);
   			$lang = db_assoc(db_query("SELECT `name_loc".$locale."` AS `name`, `description_loc".$locale."` AS `desc` FROM `locales_item` WHERE `entry`='".$item['entry']."'"));

   			if ($lang)
   				{
       					if ($lang['name']) { $item['name'] = $lang['name']; }
       					if ($lang['desc']) { $item['description'] = $lang['desc']; }
   				}
			return $lang['desc'];
		}

	function get_expansion($typ)
    		{
    			switch ($typ):

        		case 0:
            		$typ = "World of Warcraft";
            		break;

        		case 1:
            		$typ = "The Burning Crusade";
            		break;

        		case 2:
           	 	$typ = "Wrath of the Lich King";
            		break;

    			endswitch;
    			return $typ;
    		}

	function get_gold($gold)
    		{
		    	$g = floor($gold / (100 * 100));
		    	$gold = $gold - $g * 100 * 100;
		    	$s = floor($gold / 100);
		    	$gold = $gold - $s * 100;
		    	$c = floor($gold);
    			return sprintf("<b>%d<img src='".IMAGES."gold.png'>&nbsp;%02d<img src='".IMAGES."silver.png'>&nbsp;%02d<img src='".IMAGES."copper.png'></b>", $g, $s, $c);
    		}

	function get_character($character_id, $fields = "*")
		{
			global $_SESSION;
			selectdb(characters_r.$_SESSION['realmd_id']);
 			$data = db_assoc(db_query("SELECT $fields FROM `characters` WHERE `guid`='".$character_id."'"));
			if ($data) { return $data; } else { return false; }
		}

	function get_character_stats($character_id, $fields = "*")
		{
			global $_SESSION;
			selectdb(characters_r.$_SESSION['realmd_id']);
 			$data = db_assoc(db_query("SELECT $fields FROM `character_stats` WHERE `guid`='".$character_id."'"));
			if ($data) { return $data; } else { return false; }		
		}

	function get_character_name($character_id)
		{
  			$c = get_character($character_id, $fields = '`name`');
  			return $c ? $c['name'] : 'Unknown';
		}

	function get_player_faction($race)
		{
			selectdb(wcf);
 			$result = db_query("SELECT `id` AS ARRAY_KEY, `team` FROM ".DB_CHR_RACES."");
			$data = array();
			while ($mas_data = db_array($result))
				{
					$data[$mas_data['ARRAY_KEY']] = $mas_data['team'];
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

	function get_race_names()
		{
			selectdb(wcf);
			$result = db_query("SELECT `id` AS ARRAY_KEY, `name` FROM ".DB_CHR_RACES."");
			$data = array();
			while ($mas_data = db_array($result))
				{
					$data[$mas_data['ARRAY_KEY']] = $mas_data['name'];
				}
 			return $data;
		}

	function get_race($race)
		{
  			$data = get_race_names();
  			return isset($data[$race]) ? $data[$race] : 'race_'.$race;
		}

	function get_race_image($race, $genderid)
		{
 			return IMAGES_PI."race_img/".$race."_".$genderid.".gif";
		}

	function get_class_image($class)
		{
 			return IMAGES_PI."class_img/".$class.".gif";
		}

	function get_class_names()
		{
			selectdb(wcf);
 			$result = db_query("SELECT `id` AS ARRAY_KEY, `name` FROM ".DB_CHR_CLASSES."");
			$data = array();
			while ($mas_data = db_array($result))
				{
					$data[$mas_data['ARRAY_KEY']] = $mas_data['name'];
				}
 			return $data;
		}

	function get_classes($class)
		{
  			$data = get_class_names();
  			return isset($data[$class]) ? $data[$class] : 'class_'.$class;
		}

	//======================================================================================================
	$bwicon_mode = false;
	function setBwIconMode()   {global $bwicon_mode; $bwicon_mode = true;}
	function unsetBwIconMode() {global $bwicon_mode; $bwicon_mode = false;}

	function get_item($item_id, $fields = "*")
		{
  			global $_SESSION, $config;
			selectdb(mangos_r.$_SESSION['realmd_id']);
  			$item = db_assoc(db_query("SELECT $fields FROM `item_template` WHERE `entry`='".$item_id."'"));
  			if ($item) { localise_item($item); }
  			return $item;
		}

	function get_item_data($guid)
		{
			global $_SESSION;
			selectdb(characters_r.$_SESSION['realmd_id']);
			$data = db_assoc(db_query("SELECT `data` FROM `item_instance` WHERE `guid`='".$guid."'"));
 			return explode(" ", $data['data']);
		}

	function get_item_icon_name($icon_id)
		{
			selectdb(wcf);
  			$name = db_assoc(db_query("SELECT `name` FROM ".DB_ITEM_ICON." WHERE `id` ='".$icon_id."'"));
  			if ($name) { return strtolower($name['name'].".jpg"); } else { return "wowunknownitem01.jpg"; }
		}

	function get_item_icon($icon_id)
		{
  			global $bwicon_mode;
  			if ($bwicon_mode) { $dir = "bwicons"; $g_bwicon_mode = 0; } else { $dir = "icons"; }
  			return IMAGES.$dir."/".get_item_icon_name($icon_id);
		}

	function get_item_icon_from_item_data($item_data)
		{
 			if ($item = get_item($item_data[ITEM_FIELD_ENTRY]))
				{
   					return  get_item_icon($item['displayid']);
				}
			else
				{
 					return IMAGES_ICONS."wowunknownitem01.jpg";
				}

		}

	function show_item_by_data($item_data, $style='item', $posx=0, $posy=0)
		{
			$guid = $item_data[ITEM_FIELD_GUID];
			if (@$item_data[ITEM_FIELD_TYPE] == TYPE_ITEM) { $count = $item_data[ITEM_FIELD_STACK_COUNT]; }
			elseif (@$item_data[ITEM_FIELD_TYPE] == TYPE_CONTAINER) { $count = $item_data[CONTAINER_FIELD_NUM_SLOTS]; }
			else { return; }

			$position="";
			if ($posx OR $posy) { $position.= 'style="position: absolute; left: '.$posx.'px; top: '.$posy.'px; border: 0px;"'; }
			$icon = get_item_icon_from_item_data($item_data);
			if ($count == 1)
				{
					echo'<a style="float: left;" href="?item=g'.$guid.'">';
					echo"<img class=$style src='$icon' $position></a>";
				}
			else
				{
					if (empty($position)) { $position = "style=\"position: relative; left: 0px;top: 0px; border: 0px;float: left;\""; }

					echo"\n<div class=$style $position>";
					echo'<a href="?item=g'.$guid.'"><img class="'.$style.'" src="'.$icon.'"></a>';
					echo get_border_text($count, 'right', 3, 'bottom', 1);
					echo"</div>";
				}
		}

	function show_item_by_guid($guid, $style='item', $posx=0, $posy=0)
		{
			if ($guid==0) { return; }
			if ($item_data = get_item_data($guid)) { show_item_by_data($item_data, $style, $posx, $posy); }
		}

	function show_item_from_char($id, $guid, $style='item', $posx=0, $posy=0)
		{
			global $_SESSION;
			if ($id == 0) {  return; }
			selectdb(characters_r.$_SESSION['realmd_id']);
			$item_data = db_assoc(db_query("SELECT `guid` FROM `item_instance`
							WHERE `owner_guid`='".$guid."' AND (SUBSTRING_INDEX( SUBSTRING_INDEX(`data` , ' ' , 9) , ' ' , -1 )+0)='".$guid."' AND (SUBSTRING_INDEX( SUBSTRING_INDEX(`data` , ' ' , 4) , ' ' , -1 )+0)='".$id."'"));

			reset($item_data);
			$item_data =  current($item_data);
			if ($item_data = get_item_data($item_data)) { show_item_by_data($item_data, $style, $posx, $posy); }
		}

	//======================================================================================================
	function validate_text($text)
		{
			$letter = array("'",'"'     ,"<"   ,">"   ,">"   ,"\r","\n"  );
			$values = array("`",'&quot;',"&lt;","&gt;","&gt;",""  ,"<br>");
			return str_replace($letter, $values, $text);
		}

	function add_tooltip($text, $extra='')
		{
			if ($text == "") { return ""; } else { return 'onmouseover="Tip(\''.validate_text($text).'\''.($extra?','.$extra:'').');"'; }
		}

	function get_border_text($text, $posx = 'left', $dx=0, $posy = 'top', $dy=0)
		{
			return
			    "<div style=\"position: absolute; $posx: ".($dx-1)."px; $posy: ".($dy-1)."px; color: black;\">$text</div>
			     <div style=\"position: absolute; $posx: ".($dx-1)."px; $posy: ".($dy+1)."px; color: black;\">$text</div>
			     <div style=\"position: absolute; $posx: ".($dx+1)."px; $posy: ".($dy-1)."px; color: black;\">$text</div>
			     <div style=\"position: absolute; $posx: ".($dx+1)."px; $posy: ".($dy+1)."px; color: black;\">$text</div>
			     <div style=\"position: absolute; $posx: ".($dx  )."px; $posy: ".($dy-1)."px; color: black;\">$text</div>
			     <div style=\"position: absolute; $posx: ".($dx  )."px; $posy: ".($dy+1)."px; color: black;\">$text</div>
			     <div style=\"position: absolute; $posx: ".($dx-1)."px; $posy: ".($dy  )."px; color: black;\">$text</div>
			     <div style=\"position: absolute; $posx: ".($dx+1)."px; $posy: ".($dy  )."px; color: black;\">$text</div>
			     <div style=\"position: absolute; $posx: ".($dx  )."px; $posy: ".($dy  )."px; color: white;\">$text</div>";
		}

	function get_spell_icon_name($icon_id)
		{
			selectdb(wcf);
  			$name = db_assoc(db_query("SELECT `name` FROM ".DB_SPELL_ICON." WHERE `id`='$icon_id'"));
  			if ($name) { return strtolower($name['name'].".jpg"); } else { return "wowunknownitem01.jpg"; }
		}

	function get_spell_icon($icon_id)
		{
  			global $bwicon_mode;
  			if ($bwicon_mode) { $dir = "bwicons"; $g_bwicon_mode = 0; } else { $dir = "icons"; }
  			return IMAGES.$dir."/".get_spell_icon_name($icon_id);
		}

	function show_spell($entry, $iconId=0, $style=0)
		{
			selectdb(wcf);
  			if (!$iconId) { $iconId = db_assoc(db_query("SELECT `SpellIconID` FROM ".DB_SPELL." WHERE `id`='".$entry."'")); }

  			$icon = get_spell_icon($iconId['SpellIconID']);
  			echo'<a href="?spell='.$entry.'"><img'.($style?' class='.$style:'').' src="'.$icon.'"></a>';
  			return;
		}
?>