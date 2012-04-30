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

	/**
	 * Convert a PHP scalar, array or hash to JS scalar/array/hash. This function is
	 * an analog of json_encode(), but it can work with a non-UTF8 input and does not
	 * analyze the passed data. Output format must be fully JSON compatible.
	 *
	 * @param mixed $a   Any structure to convert to JS.
	 * @return string    JavaScript equivalent structure.
	*/
	function php2js($a=false)
		{
			if (is_null($a)) { return 'null'; }
			if ($a === false) { return 'false'; }
			if ($a === true) { return 'true'; }
			if (is_scalar($a))
				{
					if (is_float($a))
						{
							// Always use "." for floats.
							$a = str_replace(",", ".", strval($a));
						}
        // All scalars are converted to strings to avoid indeterminism.
        // PHP's "1" and 1 are equal for all PHP operators, but
        // JS's "1" and 1 are not. So if we pass "1" or 1 from the PHP backend,
        // we should get the same result in the JS frontend (string).
        // Character replacements for JSON.
			static $jsonReplaces = array(
            			array("\\", "/", "\n", "\t", "\r", "\b", "\f", '"'),
            			array('\\\\', '\\/', '\\n', '\\t', '\\r', '\\b', '\\f', '\"')
        		);
			return '"' . str_replace($jsonReplaces[0], $jsonReplaces[1], $a) . '"';
				}
			$isList = true;

			for ($i = 0, reset($a); $i < count($a); $i++, next($a))
				{
					if (key($a) !== $i)
						{
							$isList = false;
							break;
						}
				}
			$result = array();
			if ($isList)
				{
					foreach ($a as $v)
						{
							$result[] = php2js($v);
						}
					return '[ ' . join(', ', $result) . ' ]'."\n";
				}
			else
				{
					foreach ($a as $k => $v)
						{
							$result[] = php2js($k) . ': ' . php2js($v);
						}
					return '{ ' . join(', ', $result) . ' }';
				}
		}


	//=============================================================================================================
	// Все что связано с locale
	//=============================================================================================================
	function get_locale($locale)
		{
  			switch ($locale):
      			case 0: $locale = "English"; 		break;
    			case 1: $locale = "Korean";		break;
    			case 2:	$locale = "French";		break;
			case 3:	$locale = "German";		break;
    			case 4:	$locale = "Chinese";		break;
    			case 5:	$locale = "Taiwanese";		break;
    			case 6:	$locale = "Spanish";		break;
    			case 7:	$locale = "Spanish Mexico";	break;
    			case 8:	$locale = "Russian";		break;
  			endswitch;
			return $locale;
		}

	function localise_item(&$item)
		{
  			global $config;

			// нужно написать доп. функцию для определения языка, пока что будет русский
   			//$locale = $config['lang'];
			$locale = 8;
   			if ($locale == 0 OR $item['entry'] == 0) { return; }

			selectdb("mangos");
   			$lang = db_assoc(db_query("SELECT `name_loc".$locale."` AS `name`, `description_loc".$locale."` AS `desc` FROM `locales_item` WHERE `entry`='".$item['entry']."'"));

   			if ($lang)
   				{
       					if ($lang['name']) { $item['name'] = $lang['name']; }
       					if ($lang['desc']) { $item['description'] = $lang['desc']; }
   				}
			return $lang['desc'];
		}

	//=============================================================================================================
	// Все что связано с characters
	//=============================================================================================================
	function get_character($character_id, $fields = "*")
		{
			selectdb("characters");
 			$data = db_assoc(db_query("SELECT $fields FROM `characters` WHERE `guid`='".$character_id."'"));
			if ($data) { return $data; } else { return false; }
		}

	function get_character_stats($character_id, $fields = "*")
		{
			selectdb("characters");
 			$data = db_assoc(db_query("SELECT * FROM `character_stats` WHERE `guid`='".$character_id."'"));
			if ($data) { return $data; } else { return false; }		
		}

	function get_character_name($character_id)
		{
  			$c = get_character($character_id, $fields = '`name`');
  			return $c ? $c['name'] : 'Unknown';
		}

	//=============================================================================================================
	// Все что связано с players, faction, race, class
	//=============================================================================================================
	function get_player_faction($race)
		{
			selectdb("wcf");
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
			selectdb("wcf");
			$result = db_query("SELECT `id` AS ARRAY_KEY, `name` FROM ".DB_CHR_RACES);
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
			selectdb("wcf");
 			$result = db_query("SELECT `id` AS ARRAY_KEY, `name` FROM ".DB_CHR_CLASSES."");
			$data = array();
			while ($mas_data = db_array($result))
				{
					$data[$mas_data['ARRAY_KEY']] = $mas_data['name'];
				}
 			return $data;
		}

	function get_class_name($class, $as_ref=1)
		{
   			global $itemClassSubclass;
   			if ($as_ref) { return "<a href=\"?s=i&class=$class\">".$itemClassSubclass["$class"]."</a>"; }
			else { return $itemClassSubclass["$class"]; }
		}

	function get_classes($class)
		{
  			$data = get_class_names();
  			return isset($data[$class]) ? $data[$class] : 'class_'.$class;
		}

	function get_subclass_name($class,$subclass, $as_ref=1)
		{
  			global $itemClassSubclass;
  			if ($subclass >= 0)
  				{
      					$names = explode(":",$itemClassSubclass["$class"."."."$subclass"]);
      					if (@$names[1]) { $name = $names[1]; } else { $name = $names[0]; }
      					if ($as_ref) { return "<a href=\"?s=i&class=$class.$subclass\">".$name."</a>"; } else { return $name; }
  				}
  			return get_class_name($class, $as_ref);
		}

	function get_Short_subclass_Name($class,$subclass, $as_ref=1)
		{
			global $itemClassSubclass;
  			if ($subclass >= 0)
  				{
      					$names = explode(":",$itemClassSubclass["$class"."."."$subclass"]);
      					$name = $names[0];
      					if ($as_ref) { return "<a href=\"?s=i&class=$class.$subclass\">".$name."</a>"; } else { return $name; }
  				}
  			return get_class_name($class, $as_ref);
		}

	function get_allowable_race($mask)
		{
  			$mask&=0x7FF;
			// Return zero if for all class (or for none
			if ($mask == 0x7FF OR $mask == 0)
				{
					return 0;
				}
			else
				{
					return get_list_from_array_1(get_race_names(), $mask);
				}
		}

	function get_allowable_class($mask)
		{
			$mask&=0x5FF;
			// Return zero if for all class (or for none
			if ($mask == 0x5FF OR $mask == 0)
				{
					return 0;
				}
			else
				{
					return get_list_from_array_1(get_class_names(), $mask);
				}
		}

	//=============================================================================================================
	// Все что связано с item
	//=============================================================================================================
	$bwicon_mode = false;
	function setBwIconMode()   {global $bwicon_mode; $bwicon_mode = true;}
	function unsetBwIconMode() {global $bwicon_mode; $bwicon_mode = false;}

	$Quality = array(
		'0'=>'quality0',
		'1'=>'quality1',
		'2'=>'quality2',
		'3'=>'quality3',
		'4'=>'quality4',
		'5'=>'quality5',
		'6'=>'quality6',
		'7'=>'quality7');

	function get_item($item_id, $fields = "*")
		{
  			global $config;
			selectdb("mangos");
  			$item = db_assoc(db_query("SELECT $fields FROM `item_template` WHERE `entry`='".$item_id."'"));
  			if ($item) { localise_item($item); }
  			return $item;
		}

	function get_item_name($item_id)
		{
			$item = get_item($item_id, "`entry`, `name`");
			if ($item) { return $item['name']; } else { return "Unknown item - $item_id"; }
		}

	function get_item_flags2($item_id)
		{
  			global $config;
			selectdb("mangos");
  			$item = db_assoc(db_query("SELECT `Flags2` FROM `item_template` WHERE `entry`='".$item_id."'"));
			reset($item);
			$item = current($item);
  			return $item;
		}

	function get_item_set($item_set_id)
		{
			selectdb("wcf");
			$data = db_assoc(db_query("SELECT * FROM ".DB_ITEM_SET." WHERE `id`='".$item_set_id."'"));
			return $data;
		}


	function get_item_data($guid)
		{
			selectdb("characters");
			$data = db_assoc(db_query("SELECT `data` FROM `item_instance` WHERE `guid`='".$guid."'"));
 			return explode(" ", $data['data']);
		}

	function get_item_icon_name($icon_id)
		{
			selectdb("wcf");
  			$name = db_assoc(db_query("SELECT `name` FROM ".DB_ITEM_ICON." WHERE `id` ='".$icon_id."'"));
  			if ($name) { return strtolower($name['name'].".jpg"); } else { return "wowunknownitem01.jpg"; }
		}

	function get_item_icon($icon_id)
		{
  			global $bwicon_mode;
  			if ($bwicon_mode) { $dir = "bwicons"; $g_bwicon_mode = 0; } else { $dir = "icons"; }
  			return IMAGES.$dir."/".get_item_icon_name($icon_id);
		}

	function get_item_icon_from_item_id($item_id)
		{
			global $bwicon_mode;
			selectdb("mangos");
  			if ($icon = db_assoc(db_query("SELECT `displayid` FROM `item_template` WHERE `entry`='".$item_id."'")))
				{
					reset($icon);
					$icon = current($icon);
					return get_item_icon($icon, $bwicon_mode);
				}
			else
				{
  					return IMAGES_ICONS."wowunknownitem01.jpg";
				}
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
					echo"<a style='float: left;' href='".$modules['acp_module']."show_item.php?item=g".$guid."'>";
					echo"<img class=$style src='$icon' $position></a>";
				}
			else
				{
					if (empty($position)) { $position = "style=\"position: relative; left: 0px;top: 0px; border: 0px;float: left;\""; }

					echo"\n<div class=$style $position>";
					echo"<a href='".$modules['acp_module']."show_item.php?item=g".$guid."'><img class='".$style."' src='".$icon."'></a>";
					echo get_border_text($count, 'right', 3, 'bottom', 1);
					echo"</div>";
				}
		}

	function show_item_by_guid($guid, $style='item', $posx=0, $posy=0)
		{
			if ($guid == 0) { return; }
			if ($item_data = get_item_data($guid)) { show_item_by_data($item_data, $style, $posx, $posy); }
		}

	function empty_show_item_from_char($style='item', $posx=0, $posy=0, $empty_item="")
		{
 			switch ($empty_item): 
				case ("head"):  	$icon = IMAGES_PI."empty_icon/head.png";   	break;
				case ("neck"):  	$icon = IMAGES_PI."empty_icon/neck.png";   	break;
				case ("shoulder"):  	$icon = IMAGES_PI."empty_icon/shoulder.png";   	break;
				case ("back"):  	$icon = IMAGES_PI."empty_icon/back.png";   	break;
				case ("chest"):  	$icon = IMAGES_PI."empty_icon/chest.png";   	break;
				case ("shirt"):  	$icon = IMAGES_PI."empty_icon/shirt.png";   	break;
				case ("tabard"):  	$icon = IMAGES_PI."empty_icon/tabard.png";   	break;
				case ("wrist"):  	$icon = IMAGES_PI."empty_icon/wrist.png";   	break;
				case ("gloves"):  	$icon = IMAGES_PI."empty_icon/gloves.png";   	break;
				case ("belt"):  	$icon = IMAGES_PI."empty_icon/belt.png";   	break;
				case ("legs"):  	$icon = IMAGES_PI."empty_icon/legs.png";   	break;
				case ("feet"):  	$icon = IMAGES_PI."empty_icon/feet.png";   	break;
				case ("finger"):  	$icon = IMAGES_PI."empty_icon/finger.png";   	break;
				case ("trinket"):  	$icon = IMAGES_PI."empty_icon/trinket.png";   	break;
				case ("main"):  	$icon = IMAGES_PI."empty_icon/main.png";   	break;
				case ("off"):  		$icon = IMAGES_PI."empty_icon/off.png";   	break;
				case ("ranged"):  	$icon = IMAGES_PI."empty_icon/ranged.png";   	break;
			endswitch;

			$position = '';

			if ($posx OR $posy)
				{
					$position .= 'style="position: absolute; left: '.$posx.'px; top: '.$posy.'px; border: 0px;"';
				}
			if (empty($position))
				{
					$position = "style=\"position: relative; left: 0px;top: 0px; border: 0px;float: left;\"";
				}

			echo"\n<div class=$style $position><img class='".$style."' src='".$icon."'></div>";
		}

	function show_item_from_char($id, $guid, $style='item', $posx=0, $posy=0, $empty_item)
		{
			if ($id != 0)
				{
					selectdb("characters");
					$item_data = db_assoc(db_query("SELECT `guid` FROM `item_instance`
									WHERE `owner_guid`='".$guid."' AND (SUBSTRING_INDEX( SUBSTRING_INDEX(`data` , ' ' , 9) , ' ' , -1 )+0)='".$guid."' AND (SUBSTRING_INDEX( SUBSTRING_INDEX(`data` , ' ' , 4) , ' ' , -1 )+0)='".$id."'"));
		
					reset($item_data);
					$item_data =  current($item_data);
					if ($item_data = get_item_data($item_data)) { show_item_by_data($item_data, $style, $posx, $posy); }
				}
			else { empty_show_item_from_char($style, $posx, $posy, $empty_item); }
		}
	function get_random_suffix($id)
		{
			selectdb("wcf");
			$data = db_assoc(db_query("SELECT * FROM ".DB_ITEM_RANDOM_SUFFIX." WHERE `id`='".$id."'"));
			return $data;
		}

	function get_random_property($id)
		{
			selectdb("wcf");
			$data = db_assoc(db_query("SELECT * FROM ".DB_ITEM_RANDOM_PROPETY." WHERE `id`='".$id."'"));
			return $data;
		}

	function get_scaling_stat_distribution($id)
		{
			selectdb("wcf");
			$data = db_assoc(db_query("SELECT * FROM ".DB_SCALING_STAT_DISTRIBUTION." WHERE `id`='".$id."'"));
			return $data;
		}

	function get_scaling_stat_values($level)
		{
			selectdb("wcf");
			$data = db_assoc(db_query("SELECT * FROM ".DB_SCALING_STAT_VALUES." WHERE `level`='".$level."'"));
			return $data;
		}

	function get_item_mail($item_id)
		{
  			global $config;
			$item = db_assoc(db_query("SELECT `item` FROM `mail_loot_template` WHERE `entry`='".$item_id."'"));
			reset($item);
			$item = current($item);
  			return $item;
		}

	function get_item_bonus_text($i, $amount)
		{
    			global $iBonus;
    			$text = @$iBonus[$i];
    			if ($text == "") { $text = "Err stat $i - %d"; }
    			if ($i >=0 && $i < 8 && $amount > 0) { return sprintf("+".$text, $amount); }
    			return sprintf($text, $amount);
		}

	function get_inventory_type($i, $as_ref=1)
		{
  			global $gInventoryType;
  			$name = @$gInventoryType[$i];
  			if ($name == "") { $name = "InvType_$i"; }
  			if ($as_ref) { return "<a href=\"?s=i&type=$i\">".$name."</a>"; } else { return $name; }
		}

	function text_show_item($entry, $iconId = 0, $style = 0)
		{
			global $config;
			if (!$iconId)
				{
					selectdb("mangos");
					$iconId = db_assoc(db_query("SELECT `displayid` FROM `item_template` WHERE `entry`='".$entry."'"));
					reset($iconId);
					$iconId = current($iconId);
				}
			$icon = get_item_icon($iconId);
			$text = "<a href='?item=".$entry."'><img".($style?' class='.$style:'')." src='".$icon."'></a>";
			return $text;
		}

	//=============================================================================================================
	// Все что связано с spell
	//=============================================================================================================
	function get_spell_icon_name($icon_id)
		{
			selectdb("wcf");
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
			selectdb("wcf");
  			if (!$iconId) { $iconId = db_assoc(db_query("SELECT `SpellIconID` FROM ".DB_SPELL." WHERE `id`='".$entry."'")); }

  			$icon = get_spell_icon($iconId['SpellIconID']);
  			echo"<a href='".$modules['acp_module']."show_spell.php?spell=".$entry."'><img".($style?' class='.$style:'')." src='".$icon."'></a>";
  			return;
		}

	//=============================================================================================================
	// Все что связано с skill
	//=============================================================================================================
	function get_skill_line_ability($spellId)
		{
			selectdb("wcf");
			$data = db_assoc(db_query("SELECT * FROM ".DB_SKILL_ABILITY." WHERE `spellId`='$spellId'"));
			return $data;
		}

	function get_skill_line($id)
		{
			selectdb("wcf");
			$skills = db_assoc(db_query("SELECT * FROM ".DB_SKILL." WHERE `id`='".$id."'"));
			return $skills;
		}

	function get_Skill_Name($skillId, $as_ref=1)
		{
			$skillLine = get_skill_line($skillId);
			if ($skillLine)
				{
					if ($as_ref)
						{
							return "<a href=\"?skill=$skillId\">".$skillLine['Name']."</a>";
						}
					else
						{
							return $skillLine['Name'];
						}
				}
			else
				{
					return "";
				}
		}

	//=============================================================================================================
	// Все что связано с zone, map, area
	//=============================================================================================================
	function get_area($Zone_id, $fields="*")
		{
			selectdb("wcf");
			$data = db_assoc(db_query("SELECT ".$fields." FROM ".DB_ZONES." WHERE `id`='".$Zone_id."'"));
			return $data;
		}

	function get_area_name($Zone_id, $as_ref=1)
		{
  			$zone = get_area($Zone_id, '`name`');
  			if ($zone)
  				{
    					$name = $zone['name'];
    					if ($as_ref) { $name = "<a href='?zone=".$Zone_id."'>".$name."</a>"; }
    
  				}
  			else
				{
					$name = "Unknown area - $Zone_id";
				}
  			return $name;
		}

	function get_full_area_name($Zone_id, $as_ref=1)
		{
  			$zone = get_area($Zone_id, '`name`, `zone_id`');
  			if ($zone)
  				{
    					$name = $zone['name'];
    					if ($as_ref) { $name = "<a href='?zone=".$Zone_id."'>".$name."</a>"; }
    					if ($zone['zone_id']) { $name = get_area_name($zone['zone_id'], $as_ref)." - ".$name; }
  				}
  			else
				{
					$name = "Unknown area - $Zone_id";
				}
			return $name;
		}

	function get_map_name($id)
		{
			selectdb("wcf");
			$result = db_query("SELECT `id` AS ARRAY_KEY, `name` FROM ".DB_MAP);
			$data = array();
			while ($mas_data = db_array($result))
				{
					$data[$mas_data['ARRAY_KEY']] = $mas_data['name'];
				}
 			return isset($data[$id]) ? $data[$id] : 'map_'.$id;
		}

	//=============================================================================================================
	// Все что связано с faction, reputation
	//=============================================================================================================
	function get_faction($faction_id, $fields="*")
		{
			selectdb("wcf");
			$data = db_assoc(db_query("SELECT $fields FROM ".DB_FACTION." WHERE `id`='".$faction_id."'"));
			return $data;
		}

	function get_faction_name($faction_id, $as_ref=1)
		{
			if ($faction = get_faction($faction_id, "`name`"))
				{
					$name = $faction['name'];
				}
			else
				{
					$name = "Faction ($faction_id)";
				}
			if ($as_ref)
				{
					$name = "<a href='?faction=".$faction_id."'>".$name."</a>";
				}
			return $name;
		}

	function get_faction_template($faction_id)
		{
			selectdb("wcf");
			$data = db_assoc(db_query("SELECT * FROM ".DB_FACTION_FACTION_TEMPLATE." WHERE `id`='".$faction_id."'"));
			return $data;
		}

	function get_faction_template_name($faction_id)
		{
			if ($faction_id == 0) { return 0; }
			if ($faction_template = get_faction_template($faction_id))
				{
					return get_faction_name($faction_template['faction']);
				}
			else
				{
					return "Faction template - $faction_id";
				}
		}
	
	function get_base_reputation_for_faction($faction, $race, $class)
		{
			if (empty($faction)) { return 0; }
			$racemask = 1<<($race -1);
			$classmask = 1<<($class-1);
			for ($i=0;$i<4;$i++)
				{
					if ($faction['BaseRepRaceMask_'.$i] & $racemask AND ($faction['BaseRepClassMask_'.$i] == 0 OR $faction['BaseRepClassMask_'.$i] & $classmask))
						{
							return $faction['BaseRepValue_'.$i];
						}
				}
    			return 0;
		}

	function get_base_reputation_flag_for_faction($faction, $race, $class)
		{
			if (empty($faction)) { return 0; }
			$racemask  = 1<<($race -1);
			$classmask = 1<<($class-1);
			for ($i=0;$i<4;$i++)
				{
					if ($faction['BaseRepRaceMask_'.$i] & $racemask AND ($faction['BaseRepClassMask_'.$i] == 0 OR $faction['BaseRepClassMask_'.$i] & $classmask))
						{
							return $faction['ReputationFlags_'.$i];
						}
				}
    			return 0;
		}

	function get_reputation_rank_name($rep)
		{
			global $gReputationRank;
			$text = @$gReputationRank[$rep];
			if ($text == "") { $text = "Err Rep Rank $rep"; } else { return $text; }
		}

	function get_reputation_data_from_reputation($rep)
		{
			global $gReputationRank;
			$gBaseRep = -42000;
			$gRepStep = array(36000, 3000, 3000, 3000, 6000, 12000, 21000, 1000);
			$current = $gBaseRep;
			for ($i=0;$i<8;$current+=$gRepStep[$i],$i++)
				{
     					if ($current + $gRepStep[$i] > $rep)
						{
							return array('rank'=>$i, 'rank_name'=>$gReputationRank[$i], 'rep'=>$rep - $current, 'max'=>$gRepStep[$i]);
						}
				}
			return array('rank'=>7, 'rank_name'=>$gReputationRank[7], 'rep'=>$gRepStep[7], 'max'=>$gRepStep[7]);
		}

	function get_faction_type($id)
		{
			global $gFactionType;
			return $gFactionType[$id];
		}

	//=============================================================================================================
	// Другие полезные функции
	//=============================================================================================================
	function get_gem_info($GemId)
		{
			selectdb("wcf");
			$data = db_assoc(db_query("SELECT * FROM ".DB_GEMPROPERTIES." WHERE `id`='".$GemId."'"));
			return $data;
		}

	function get_gem_properties($GemProperties)
		{
 			if ($gem = get_gem_info($GemProperties)) { return get_enchantment_desc($gem['spellitemenchantement']); } else { return "Gem Properties id - $GemProperties"; }
		}

	function get_enchantment($enchantmentId)
		{
			selectdb("wcf");
			$data = db_assoc(db_query("SELECT * FROM ".DB_ITEM_ENCHANT." WHERE `id`='".$enchantmentId."'"));
			return $data;
		}

	function get_enchantment_desc($enchantment)
		{
			if ($enc = get_enchantment($enchantment))
				{
					return "<a href=?enchant=$enchantment>".validate_text($enc['description'])."</a>";
				}
			else
				{
					return "Enchant $enchantment";
				}
		}

	function get_expansion($typ)
    		{
    			switch ($typ):
        		case 0:	$typ = "World of Warcraft";		break;
        		case 1:	$typ = "The Burning Crusade";		break;
        		case 2:	$typ = "Wrath of the Lich King";	break;
    			endswitch;

    			return $typ;
    		}

	function get_stat_type_name($i)
		{
 			global $gStatType;
 			return isset($gStatType[$i]) ? $gStatType[$i] : "Stat ($i)";
		}

	function get_resistance($i)
		{
 			global $gResistance;
 			return isset($gResistance[$i]) ? $gResistance[$i] : "Resistance ($i)";
		}

	function get_resistance_text($i, $amount)
		{
    			global $gResistanceType;
    			$text = @$gResistanceType[$i];
    			if ($text == "") { $text = "Err resist $i - %d"; }
    			if ($i >=0 && $i < 7 && $amount > 0) { return sprintf("+".$text, $amount); } else { return sprintf($text, $amount); }
		}

	function get_rating($level)
		{
			selectdb("wcf");
			$data = db_assoc(db_query("SELECT * FROM ".DB_RATING." WHERE `level`='$level'"));
			return $data;
		}

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

	function money($many, $height=10)
		{
 			if ($many > 0)
 				{
  					$many = str_pad($many, 12, 0, STR_PAD_LEFT);
  					$str  = "";
 				}
 			elseif ($many == 0)
				{
  					return "n/a";
				}
 			else
				{
  					$many = str_pad(-$many, 12, 0, STR_PAD_LEFT);
  					$str  = "-";
 				}
			$copper = intval(substr($many, -2));
			$silver = intval(substr($many, -4, -2));
			$gold   = intval(substr($many, -11, -4));
			$hstr = "";
			if ($height != 14)  { $hstr = "height={$height}px"; }
			if ($gold  ) { $str.= $gold."<img $hstr src='".IMAGES."gold.gif'> "; }
			if ($silver) { $str.= $silver."<img $hstr src='".IMAGES."silver.gif'> "; }
			if ($copper) { $str.= $copper."<img $hstr src='".IMAGES."copper.gif'>"; }
			return $str;
		}

	function get_time_text($seconds)
		{
			global $txt;
			$text = "";
			if ($seconds < 0) { $text.= "$txt[minustime]"; }
			if ($seconds >= 24*3600) { $text.= intval($seconds/(24*3600))." $txt[days]"; if ($seconds%=24*3600) $text.=" "; }
			if ($seconds >= 3600) { $text.= intval($seconds/3600)." $txt[hours]"; if ($seconds%=3600) $text.=" "; }
			if ($seconds >= 60) { $text.= intval($seconds/60)." $txt[min]"; if ($seconds%=60) $text.=" "; }
			if ($seconds > 0) { $text.= $seconds." $txt[sec]"; }
			return $text;
		}

	// составляет список
	function get_list_from_array($array, $i, $mask, $href)
		{
			$text = "";
			while ($mask)
				{
					if ($mask & 1)
						{
							$data = @$array[$i]; if ($data == "") $data = "$i";
							if ($href) { $text.="<a href=\"".sprintf($href, $i)."\">".$data."</a>"; } else { $text.=$data; }
							if ($mask != 1) { $text.=", "; }
						}
					$mask>>=1;
					$i++;
				}
			return $text;
		}

	// составляет список c 0
	function get_list_from_array_0($array, $mask, $href="")
		{
			return get_list_from_array($array, 0, $mask, $href);
		}

	// составляет список c 1
	function get_list_from_array_1($array, $mask, $href="")
		{
			return get_list_from_array($array, 1, $mask, $href);
		}

	function get_talent_name($id)
		{
			$data = array();
			selectdb("wcf");
			$result = db_query("SELECT `id` AS ARRAY_KEY, `name` FROM ".DB_TALENT_TAB);
			while ($data = db_array($result))
				{
					$l[$data['ARRAY_KEY']] = $data['name'];
				}
			return isset($l[$id]) ? $l[$id] : 'talent_'.$id;
		}

	function get_family_image($family)
		{
			selectdb("wcf");
			$result = db_query("SELECT `id` AS ARRAY_KEY, `icon` FROM ".DB_CREATURE_FAMILY);
			while ($data = db_array($result)) { $l[$data['ARRAY_KEY']] = $data['icon']; }
			if (isset($l[$family]))
				{
					return IMAGES_ICONS.strtolower($l[$family]).".jpg";
				}
			else
				{
					return IMAGES_ICONS."wowunknownitem01.jpg";
				}
		}

	function get_creature_family_names()
		{
			selectdb("wcf");
			$result = db_query("SELECT `id` AS ARRAY_KEY, `name` FROM ".DB_CREATURE_FAMILY);
			while ($data = db_array($result)) { $l[$data['ARRAY_KEY']] = $data['name']; }
			return $l;
		}

	function get_creature_family($family, $as_ref=1)
		{
			$l = get_creature_family_names();
			$name = isset($l[$family]) ? $l[$family] : 'family_'.$family;
			if ($as_ref)
				{
					return '<a href="?s=n&family='.$family.'">'.$name.'</a>';
				}
			return $name;
		}
?>