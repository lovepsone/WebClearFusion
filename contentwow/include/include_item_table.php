<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2012 lovepsone
+--------------------------------------------------------+
| Filename: include_item_table.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	define('TYPE_ITEM',      3);
	define('TYPE_CONTAINER', 7);

	define('ITEM_FIELD_GUID',                 0x0000);
	define('ITEM_FIELD_TYPE',                 0x0002);
	define('ITEM_FIELD_ENTRY',                0x0003);
	define('ITEM_FIELD_SCALE_X',              0x0004);
	define('ITEM_FIELD_PADDING',              0x0005);
	define('ITEM_FIELD_OWNER',                0x0006);     // 2 4 1
	define('ITEM_FIELD_CONTAINED',            0x0008);     // 2 4 1
	define('ITEM_FIELD_CREATOR',              0x000A);     // 2 4 1
	define('ITEM_FIELD_GIFTCREATOR',          0x000C);     // 2 4 1
	define('ITEM_FIELD_STACK_COUNT',          0x000E);     // 1 1 20
	define('ITEM_FIELD_DURATION',             0x000F);     // 1 1 20
	define('ITEM_FIELD_SPELL_CHARGES',        0x0010);     // 5 1 20
	define('ITEM_FIELD_FLAGS',                0x0015);     // 1 1 1
	define('ITEM_FIELD_ENCHANTMENT',          0x0016);     // 33 1 1
	define('PERM_ENCHANTMENT_SLOT',   ITEM_FIELD_ENCHANTMENT);
	define('TEMP_ENCHANTMENT_SLOT',   ITEM_FIELD_ENCHANTMENT+3);
	define('SOCK_ENCHANTMENT_SLOT',   ITEM_FIELD_ENCHANTMENT+6);
	define('SOCK_ENCHANTMENT_SLOT_2', ITEM_FIELD_ENCHANTMENT+9);
	define('SOCK_ENCHANTMENT_SLOT_3', ITEM_FIELD_ENCHANTMENT+12);
	define('BONUS_ENCHANTMENT_SLOT',  ITEM_FIELD_ENCHANTMENT+15);
	define('WOTLK_ENCHANTMENT_SLOT',  ITEM_FIELD_ENCHANTMENT+18);
	define('PROP_ENCHANTMENT_SLOT_0', ITEM_FIELD_ENCHANTMENT+21); // used with RandomSuffix
	define('PROP_ENCHANTMENT_SLOT_1', ITEM_FIELD_ENCHANTMENT+24); // used with RandomSuffix
	define('PROP_ENCHANTMENT_SLOT_2', ITEM_FIELD_ENCHANTMENT+27); // used with RandomSuffix and RandomProperty
	define('PROP_ENCHANTMENT_SLOT_3', ITEM_FIELD_ENCHANTMENT+30); // used with RandomProperty
	define('PROP_ENCHANTMENT_SLOT_4', ITEM_FIELD_ENCHANTMENT+33); // used with RandomProperty
	define('ITEM_FIELD_PROPERTY_SEED',        0x003A);     // 1 1 1
	define('ITEM_FIELD_SUFFIX_FACTOR', ITEM_FIELD_PROPERTY_SEED);
	define('ITEM_FIELD_RANDOM_PROPERTIES_ID', 0x003B);     // 1 1 1
	define('ITEM_FIELD_ITEM_TEXT_ID',         0x003C);     // 1 1 4
	define('ITEM_FIELD_DURABILITY',           0x003D);     // 1 1 20
	define('ITEM_FIELD_MAXDURABILITY',        0x003E);     // 1 1 20
	define('ITEM_FIELD_PAD',                  0x003F);
	define('ITEM_END',                        0x0040);

	define('CONTAINER_FIELD_NUM_SLOTS',       ITEM_END + 0x0000); // Size: 1, Type: INT, Flags: PUBLIC
	define('CONTAINER_ALIGN_PAD',             ITEM_END + 0x0001); // Size: 1, Type: BYTES, Flags: NONE
	define('CONTAINER_FIELD_SLOT_1',          ITEM_END + 0x0002); // Size: 72, Type: LONG, Flags: PUBLIC
	define('CONTAINER_END',                   ITEM_END + 0x004A);

	// Флаги поля ITEM_FIELD_FLAGS
	define('ITEM_FLAGS_BINDED',          0x00000001);
	define('ITEM_FLAGS_CONJURED',        0x00000002);
	define('ITEM_FLAGS_OPENABLE',        0x00000004);
	define('ITEM_FLAGS_HEROIC',          0x00000008);
	define('ITEM_FLAGS_WRAPPER',         0x00000200); // used or not used wrapper
	define('ITEM_FLAGS_PARTY_LOOT',      0x00000800); // determines if item is party loot or not
	define('ITEM_FLAGS_CHARTER',         0x00002000); // arena/guild charter
	define('ITEM_FLAGS_PROSPECTABLE',    0x00040000);
	define('ITEM_FLAGS_UNIQUE_EQUIPPED', 0x00080000);
	define('ITEM_FLAGS_USEABLE_IN_ARENA',0x00200000);
	define('ITEM_FLAGS_THROWABLE',       0x00400000); // not used in game for check trow possibility, only for item in game tooltip
	define('ITEM_FLAGS_SPECIALUSE',      0x00800000); //
	define('ITEM_FLAGS_BOA',             0x08000000); // bind on account
	define('ITEM_FLAGS_ENCHANTER_SCROLL',0x10000000);
	define('ITEM_FLAGS_MILLABLE',        0x20000000);
	define('ITEM_FLAGS_BOP_TRADEABLE',   0x80000000);

	// Флаги поля ITEM_FIELD_FLAGS2
	define('ITEM_FLAGS2_HORDE_ONLY',             0x00000001);
	define('ITEM_FLAGS2_ALLIANCE_ONLY',          0x00000002);
	define('ITEM_FLAGS2_EXT_COST_REQUIRES_GOLD', 0x00000004);
	define('ITEM_FLAGS2_NEED_ROLL_DISABLED',     0x00000100);

	// Флаги BAG_FAMILY_MASK
	define('BAG_FAMILY_MASK_ARROWS',     0x00000001);
	define('BAG_FAMILY_MASK_BULLETS',    0x00000002);
	define('BAG_FAMILY_MASK_SHARDS',     0x00000004);
	define('BAG_FAMILY_MASK_LEATHERWORKING_SUPP', 0x00000008);
	define('BAG_FAMILY_MASK_INSCRIPTION_SUPP',     0x00000010);
	define('BAG_FAMILY_MASK_HERBS',      0x00000020);
	define('BAG_FAMILY_MASK_ENCHANTING_SUPP', 0x00000040);
	define('BAG_FAMILY_MASK_ENGINEERING_SUPP', 0x00000080);
	define('BAG_FAMILY_MASK_KEYS',       0x00000100);
	define('BAG_FAMILY_MASK_GEMS',       0x00000200);
	define('BAG_FAMILY_MASK_MINING_SUPP',0x00000400);
	define('BAG_FAMILY_MASK_SOULBOUND_EQUIPMENT', 0x00000800);
	define('BAG_FAMILY_MASK_VANITY_PETS',0x00001000);
	define('BAG_FAMILY_MASK_CURRENCY_TOKENS', 0x00002000);
	define('BAG_FAMILY_MASK_QUEST_ITEMS', 0x00004000);

	function get_character_level($character_id)
		{
			selectdb("characters");

  			if ($lvl = db_query("SELECT `level` FROM `characters` WHERE `guid`='".$character_id."'"))
				{
					reset($lvl);
					$item = current($lvl);
					return $lvl;
				}
			else
				{
					return 80;
				}
		}

	function render_spell($spell_id,$spell_trigger,$spell_charges,$spellcolldown,$spellcategorycooldown)
		{
  			global $UseorEquip, $game_text;
  			if ($spell_id == 0) { return; }
  			$desc = get_spell_details($spell_id);
			if ($desc)
				{
    					echo"<tr><td><a href='?spell=".$spell_id."'>".$UseorEquip[$spell_trigger]." ".$desc;
    					if ($spellcolldown > 0)
						{
							echo" (".get_time_text($spellcolldown/1000).' cooldown)';
						}
					echo"</a>";
    					if ($spell_charges > 0 && $spell_charges == (int)$spell_charges)
						{
							echo"<br>".sprintf($game_text['charges'], $spell_charges);
						}
					echo"</td></tr>";
				}
		}

	function render_primal_stat($stat_type,$stat_value)
		{
  			if ($stat_value AND $stat_type >= 0 AND $stat_type < 8) { echo"<tr><td>".get_item_bonus_text($stat_type,$stat_value)."</td></tr>"; }
		}

	function render_spell_stat($stat_type,$stat_value)
		{
  			if ($stat_value AND $stat_type > 8 AND $stat_type < 49)
				{
     					echo"<tr><td class='SpellStat'>".get_item_bonus_text($stat_type, $stat_value)."</td></tr>";
				}
		}

	// Вывод типа сокета
	function render_socket($socket)
		{
   			global $game_text;
   			if ($socket == 1) { echo"<tr><td class='metaSock'><a href='?s=i&gem=1'>".$game_text['meta_socket']."</a></td></tr>"; }
			if ($socket == 2) { echo"<tr><td class='redSock'><a href='?s=i&gem=2'>".$game_text['red_socket']."</a></td></tr>"; }
			if ($socket == 4) { echo"<tr><td class='yellowSock'><a href='?s=i&gem=4'>".$game_text['yellow_socket']."</a></td></tr>"; }
			if ($socket == 8) { echo"<tr><td class='blueSock'><a href='?s=i&gem=8'>".$game_text['blue_socket']."</a></td></tr>"; }
		}

	// Вывод сокета с возможно вставленным камнем
	function render_socketed($socket, $sock_gem_enchant)
		{
  			if ($sock_gem_enchant)
  				{
					$sock_enchant = get_enchantment($sock_gem_enchant);
   					$desc ="<a href='?enchant=".$sock_gem_enchant."'>".$sock_enchant['description']."</a>";
   					if ($sock_enchant['GemID'])
						{
    							echo"<tr><td class='EnchantSock'><img src='".get_item_icon_from_item_id($sock_enchant['GemID'])."'> ".$desc."</td></tr>";
						}
   					else
						{
							echo"<tr><td class='EnchantSock'>".$desc."</td></tr>";
						}
  				}
  			else // Камня нет выводим как обычный сокет
				{
					render_socket($socket);
				}
		}

	// Вывод энчанта
	function render_enchant($item_data, $id, $random_suffix)
		{
   			global $game_text;
   			if ($item_data[$id] == 0) { return; }
   			$desc = get_enchantment_desc($item_data[$id]);
   			// Имеется рандом суффикс (заменяем $i на рассчётное значение)
   			if ($random_suffix)
   				{
					$i = 0;
					if ($item_data[$id] == $random_suffix['EnchantID_1']) $i = $random_suffix['Prefix_1'] * $item_data[ITEM_FIELD_SUFFIX_FACTOR]/10000;
					if ($item_data[$id] == $random_suffix['EnchantID_2']) $i = $random_suffix['Prefix_2'] * $item_data[ITEM_FIELD_SUFFIX_FACTOR]/10000;
					if ($item_data[$id] == $random_suffix['EnchantID_3']) $i = $random_suffix['Prefix_3'] * $item_data[ITEM_FIELD_SUFFIX_FACTOR]/10000;
					$desc = str_replace('$i',intval($i),$desc);
   				}
   			$time = floor($item_data[$id+1]/1000/60);
   			$charge = $item_data[$id+2];
   			echo"<tr><td class='SpellStat'>".$desc;
			if ($item_data[$id+1]) { echo" - ".$time." ".$game_text['min']; }
			if ($item_data[$id+2]) { echo" (".sprintf($game_text['charges'], $charge).")"; }
			echo"</td></tr>";
		}

	// Одета ли вещь на игроке (если нет данных о игроке выводим как одетую вещь)
	function is_item_on_player($id, $char_eqip)
		{
  			if ($char_eqip)
    				for ($i=0;$i<19;$i++)
      					if ($char_eqip[PLAYER_VISIBLE_ITEM_1_ENTRYID+$i*2]==$id) return 1;
  			return 0;
		}

	function no_border_item_table($item, $item_data=0)
		{
 			global $txt;
 			$flags2 = get_item_flags2($item['entry']);
 			echo"<table class='item' cellspacing='0'><tbody>";
 			render_item_data($item, $item_data);

 			if ($flags2 & ITEM_FLAGS2_HORDE_ONLY)
				{
					echo"<tr><td>".$txt['modul_acp_show_reqirement'].":&nbsp;".$txt['modul_acp_show_horde']."</td></tr>";
				}
			if ($flags2 & ITEM_FLAGS2_ALLIANCE_ONLY)
				{
					echo"<tr><td>".$txt['modul_acp_show_reqirement'].":&nbsp;".$txt['modul_acp_show_alliance']."</td></tr>";
				}

 			if ($item['SellPrice'])
				{
  					echo"<tr><td class='sellprice'>&nbsp;".$txt['modul_acp_show_sell_price'].":&nbsp;".money($item['SellPrice'])."</td></tr>";
				}
 			else
				{
  					echo"<tr><td class='sellprice'>&nbsp;".$txt['modul_acp_show_no_sell_price']."</td></tr>";
				}

 			echo"</tbody></table>";
		}

	function generate_item_table($item, $item_data=0)
		{
 			echo"<table class='border' cellspacing='0' cellpadding='0'><tbody>";
 			echo"<tr><td class='btopl'></td><td class='btop'></td><td class='btopr'></td></tr>";
 			echo"<tr><td class='bl'></td><td class='bbody'>";
 			no_border_item_table($item, $item_data);
 			echo"</td><td class='br'></td></tr>";
 			echo"<tr><td class='bbottoml'></td><td class='bbottom'></td><td class='bbottomr'></td></tr>";
 			echo"</tbody></table>";
		}


	function render_item_data($item, $item_data = 0)
		{
			global $gBonding, $Quality, $UseorEquip, $game_text;

 			$colorname = $item['Quality'];
 			$bonding = $item['bonding'];
 			$invtype = $item['InventoryType'];
 			$class = $item['class'];
 			$subclass = $item['subclass'];
 			$speed = $item['delay']/1000.00;
 			$ssd = 0;
 			$level = 80;
 			$creator = 0;
 			$giftCreator = 0;
 			$random_suffix = 0;
 			$random_prop = 0;
 			$char_data = 0;
 			$stack_count = 1;

 			if ($item_data)
 				{
   					if ($item['ScalingStatValue'] || $item['ScalingStatDistribution'])
						{
							$level = get_character_level($item_data[ITEM_FIELD_OWNER]);
						}
   					if (intval(-$item_data[ITEM_FIELD_RANDOM_PROPERTIES_ID]) > 0)
						{
							$random_suffix = get_random_suffix(intval(-$item_data[ITEM_FIELD_RANDOM_PROPERTIES_ID]));
						}
   					if (intval($item_data[ITEM_FIELD_RANDOM_PROPERTIES_ID]) > 0)
						{
							$random_prop  = get_random_property(intval($item_data[ITEM_FIELD_RANDOM_PROPERTIES_ID]));
						}
   					if ($item_data[ITEM_FIELD_CREATOR])
       						{
							$creator = get_character_name($item_data[ITEM_FIELD_CREATOR]);
						}
   					if ($item_data[ITEM_FIELD_GIFTCREATOR])
						{
							$giftCreator = get_character_name($item_data[ITEM_FIELD_GIFTCREATOR]);
						}
   					if ($item_data[ITEM_FIELD_STACK_COUNT])
						{
							$stack_count = $item_data[ITEM_FIELD_STACK_COUNT];
						}
   					if ($random_suffix)
						{
							$item['name'] = $item['name']." ".$random_suffix['name'];
						}
   					elseif ($random_prop)
						{
							$item['name'] = $item['name']." ".$random_prop['name'];
						}
					if ($item_data[ITEM_FIELD_FLAGS] & ITEM_FLAGS_BINDED)
						{
							$bonding = -1;
						}
				}
			if ($item['ScalingStatDistribution'] && ($ssd = get_scaling_stat_distribution($item['ScalingStatDistribution'])))
 				{
    					if ($ssd['maxlevel'] && $level > $ssd['maxlevel']) { $level = $ssd['maxlevel']; }
					$mask = $item['ScalingStatValue'];
					$ssv = get_scaling_stat_values($level);
    					$stat_multi = 0;
    					// Stat multiplier
					if ($mask&0x001F)
						{
							if ($mask&(1<<0)) { $stat_multi = $ssv['multiplier_1']; }
							if ($mask&(1<<1)) { $stat_multi = $ssv['multiplier_2']; }
							if ($mask&(1<<2)) { $stat_multi = $ssv['multiplier_3']; }
							if ($mask&(1<<3)) { $stat_multi = $ssv['multiplier_4']; }
							if ($mask&(1<<4)) { $stat_multi = $ssv['multiplier_5']; }
						}
    					// Armor mod
					if ($mask&0x01E0)
						{
							if ($mask&(1<<5)) { $item['armor']=$ssv['multiplier_6']; }
							if ($mask&(1<<6)) { $item['armor']=$ssv['multiplier_7']; }
							if ($mask&(1<<7)) { $item['armor']=$ssv['multiplier_8']; }
							if ($mask&(1<<8)) { $item['armor']=$ssv['multiplier_9']; }
						}
    					// DPS mod (min = 70% from averange max = 130%)
					if ($mask&0x7E00)
						{
							if ($mask&(1<< 9)) { $dps=$ssv['multiplier_10']; }
							if ($mask&(1<<10)) { $dps=$ssv['multiplier_11']; }
							if ($mask&(1<<11)) { $dps=$ssv['multiplier_12']; }
							if ($mask&(1<<12)) { $dps=$ssv['multiplier_13']; }
							if ($mask&(1<<13)) { $dps=$ssv['multiplier_14']; }
							if ($mask&(1<<14)) { $dps=$ssv['multiplier_15']; }
							$averange = $speed * $dps;
							$item['dmg_min1'] = floor(0.7*$averange);
							$item['dmg_max1'] = floor(1.3*$averange);
						}
					//if ($mask & 0x08000) { ???=$ssv['multiplier_16']; }                  // spell power
					//if ($mask & 0x10000) { ???=$ssv['multiplier_17']; }                  // feral AP
				}

			// Вывод имени
			echo"<tr><td class='name'><span class='".$Quality[$colorname]."'>".$item['name']."</SPAN></td></tr>";

 			// героические вещи (green)
 			if ($item['Flags'] & ITEM_FLAGS_HEROIC) { echo"<tr><td class='SpellStat'>".$game_text['item_heroic']."</td></tr>"; }
 			if ($item['area']) { echo"<tr><td>".get_area_name($item['area'])."</td></tr>"; }
 			if ($item['Map']) { echo"<tr><td>".get_map_name($item['Map'])."</td></tr>"; }
			if ($item['Flags'] & ITEM_FLAGS_CONJURED) { echo"<tr><td>".$game_text['conjured_item']."</td></tr>"; }
 			// Вывод привязки вещи
			if ($bonding) { echo"<tr><td>".$gBonding[$bonding]."</td></tr>"; }

 			// Вывод того что вещь содержит чтото
 			if ($item['Flags' ]& ITEM_FLAGS_OPENABLE) { echo"<tr><td class='SpellStat'>".$game_text['right_click']."</td></tr>"; }
 			// <Right Click to Read>

 			// Вывод уникальности вещи
 			if ($item['maxcount'] == 1) { echo"<tr><td class='Unique'>".$game_text['unique']."</td></tr>"; }
 			if ($item['maxcount'] > 1) { echo"<tr><td class='Unique'>".$game_text['unique']."(".$item['maxcount'].")</td></tr>"; }

			$className = get_class_name($class, 0);
			$subClassName = get_short_subclass_name($class, $subclass,0);

 			// Зависимые от класса вещи параметры
 			switch ($class)
 				{
					//case 0: break;// Consumable
 					case 1: echo"<tr><td>".sprintf($game_text['slot'],$item['ContainerSlots'], $subClassName)."</td></tr>"; break; // Container
 					case 2: echo"<tr><td>"."<div class='right'>".$subClassName."</div>".get_inventory_type($invtype,0)."</td></tr>"; break;// Weapon
 					//case 3: break;// Gem
					case 4:
   						if ($invtype==14) {$invtype=22;}
   						$sub = "";
   						if ($invtype!=16 && $subclass > 0) { $sub = "<div class='right'>".$subClassName."</div>"; }
   						echo"<tr><td>".$sub.get_inventory_type($invtype,0)."</td></tr>";
 					break;// Armor
					//case 5: break;// Reagent
					case 6:
   						echo"<tr><td><div class='right'>".$subClassName."</div>".$className."</td></tr>";
   						$dps = ($item['dmg_min1']+$item['dmg_max1'])/2;
  						echo"<tr><td>".sprintf($game_text['ammo_dps'],$dps)."</td></tr>";
					break;// Projectile
					//case 7: break;// Trade Goods
					//case 8: break;// Generic
					//case 9: break;// Recipe
					//case 10: break;// Money
					case 11: echo"<tr><td>".sprintf($game_text['slot'], $item['ContainerSlots'], $subClassName)."</td></tr>"; break; //Quiver
					//case 12: break;//Quest
					//case 13: break;//Key
					//case 14: break;//Permanent
					//case 15: break;//Misc
 					default: break;
				}

			// Вывод урона наносимого оружием но не боеприпасами
			if ($item['dmg_min1'] > 0 AND $class!=6)
				{
					if ($speed==0) { $speed=1; }
					$dps = ($item['dmg_min1']+$item['dmg_max1'])/(2*$speed);
					$sub = "<div class='right'>".sprintf($game_text['weapon_speed'],$speed)."</div>";
  					echo"<tr><td>".$sub.sprintf($game_text['weapon_damage'],$item['dmg_min1'], $item['dmg_max1'])."</td></tr>";
  					if ($class == 2)
						{
    							echo"<tr><td>".sprintf($game_text['weapon_dps'],$dps)."</td></tr>";
						}
				}
			// вывод брони
			if ($item['armor']) { echo"<tr><td>".sprintf($game_text['iarmor'],$item['armor'])."</td></tr>"; }
 			// вывод блока
			if ($item['block']) { echo"<tr><td>".sprintf($game_text['iblock'],$item['block'])."</td></tr>"; }
 			// Вывод статов на силу, ловкость, стамину, интелект, стамину
 			if ($ssd)
				{
   					for ($i=1;$i<=10;$i++)
						{
     							render_primal_stat($ssd['statmod_'.$i], $stat_multi * $ssd['modifier_'.$i] / 10000);
						}
				}
 			else
				{
   					for ($i=1;$i<=$item['StatsCount'];$i++)
						{
       							render_primal_stat($item['stat_type'.$i],$item['stat_value'.$i]);
						}
				}

			// Вывод резистов
			if ($item['holy_res'  ]) { echo"<tr><td>".get_resistance_text(1, $item['holy_res'  ])."</td></tr>"; }
			if ($item['fire_res'  ]) { echo"<tr><td>".get_resistance_text(2, $item['fire_res'  ])."</td></tr>"; }
			if ($item['nature_res']) { echo"<tr><td>".get_resistance_text(3, $item['nature_res'])."</td></tr>"; }
			if ($item['frost_res' ]) { echo"<tr><td>".get_resistance_text(4, $item['frost_res' ])."</td></tr>"; }
			if ($item['shadow_res']) { echo"<tr><td>".get_resistance_text(5, $item['shadow_res'])."</td></tr>"; }
			if ($item['arcane_res']) { echo"<tr><td>".get_resistance_text(6, $item['arcane_res'])."</td></tr>"; }
			// Описание камней
			if ($item['GemProperties'])
				{
					$GemProperties = get_gem_properties($item['GemProperties']);
					echo"<tr><td class='SpellStat'>$GemProperties</td></tr>";
				}
			// Вывод сокетов
			if ($item_data)
				{
					render_socketed($item['socketColor_1'],$item_data[SOCK_ENCHANTMENT_SLOT]);
					render_socketed($item['socketColor_2'],$item_data[SOCK_ENCHANTMENT_SLOT_2]);
					render_socketed($item['socketColor_3'],$item_data[SOCK_ENCHANTMENT_SLOT_3]);
				}
			else
				{
					render_socket($item['socketColor_1']);
					render_socket($item['socketColor_2']);
					render_socket($item['socketColor_3']);
				}
			// Вывод бонуса сокетов (если есть доп инфо выводим данные из нее)
			if ($item_data)
				{
					// Вывод активного бонуса
    					if ($item_data[BONUS_ENCHANTMENT_SLOT])
						{
     							echo"<tr><td class='SpellStat'>".sprintf($game_text['socket_bonus'], get_enchantment_desc($item_data[BONUS_ENCHANTMENT_SLOT]))."</td></tr>";
						}
    					// Вывод не активного бонуса (не выполнены условия)
					elseif ($item['socketBonus'])
						{
     							echo"<tr><td class='disBonus'>".sprintf($game_text['socket_bonus'], get_enchantment_desc($item['socketBonus']))."</td></tr>";
						}
 				}
 			elseif ($item['socketBonus'])
				{
					echo"<tr><td class='SpellStat'>".sprintf($game_text['socket_bonus'], get_enchantment_desc($item['socketBonus']))."</td></tr>";
				}

			 // Вывод энчантов вещи
			if ($item_data)
				{
					render_enchant($item_data,PERM_ENCHANTMENT_SLOT,$random_suffix);
					render_enchant($item_data,TEMP_ENCHANTMENT_SLOT,$random_suffix);
					render_enchant($item_data,WOTLK_ENCHANTMENT_SLOT,$random_suffix);
					render_enchant($item_data,PROP_ENCHANTMENT_SLOT_0,$random_suffix);
					render_enchant($item_data,PROP_ENCHANTMENT_SLOT_1,$random_suffix);
					render_enchant($item_data,PROP_ENCHANTMENT_SLOT_2,$random_suffix);
					render_enchant($item_data,PROP_ENCHANTMENT_SLOT_3,$random_suffix);
					render_enchant($item_data,PROP_ENCHANTMENT_SLOT_4,$random_suffix);
				}
 			elseif ($item['RandomProperty'] OR $item['RandomSuffix'])
				{
					echo"<tr><td class='SpellStat'>".$game_text['random_enchant']."</td></tr>";
				}

	 		// Вывод крепкости
	 		if ($item_data && $item_data[ITEM_FIELD_MAXDURABILITY] > 0)
				{
					echo"<tr><td>".sprintf($game_text['durability'],$item_data[ITEM_FIELD_DURABILITY], $item_data[ITEM_FIELD_MAXDURABILITY])."</td></tr>";
				}
			elseif ($item['MaxDurability'] > 0)
				{
	   				echo"<tr><td>".sprintf($game_text['durability'], $item['MaxDurability'], $item['MaxDurability'])."</td></tr>";
				}
	 		// Вывод требования расы
			if ($text = get_allowable_race($item['AllowableRace']))
				{
					echo"<tr><td>".$game_text['allowable_race']." ".$text."</td></tr>";
				}
	
	 		// Вывод требований классов
			if ($text = get_allowable_class($item['AllowableClass']))
				{
					echo"<tr><td>".$game_text['allowable_class']." ".$text."</td></tr>";
				}
	
			// Вывод времени продолжительности
			if ($item['Duration'])
				{
					if ($item['ExtraFlags']&2)
						{
							echo"<tr><td>".sprintf($game_text['idurationr'], get_time_text($item['Duration']))."</td></tr>";
						}
					else
						{
							echo"<tr><td>".sprintf($game_text['iduration'], get_time_text($item['Duration']))."</td></tr>";
						}
				}
	
			// Вывод требования уровня
			if ($item['RequiredLevel'] > 1)
				{
					echo"<tr><td class='req'>".sprintf($game_text['req_level'], $item['RequiredLevel'])."</td></tr>";
				}
	
			// Уровень предмета
			if ($item['ItemLevel'])
				{
					echo"<tr><td>".sprintf($game_text['ilevel'], $item['ItemLevel'])."</td></tr>";
				}
	
			// Вывод prospectable если надо 0x40000
			if ($item['Flags'] & ITEM_FLAGS_PROSPECTABLE)
				{
					echo"<tr><td>".$game_text['prospectable']."</td></tr>";
				}

			// Вывод Millable если надо 0x20000000
			if ($item['Flags'] & ITEM_FLAGS_MILLABLE)
				{
					echo"<tr><td>".$game_text['millable']."</td></tr>";
				}

			// Вывод требования скила
			if ($item['RequiredSkill'])
				{
					echo"<tr><td class='req'>".sprintf($game_text['req_skill'], get_skill_name($item['RequiredSkill']), $item['RequiredSkillRank'])."</td></tr>";
				}

			// Требование знать спелл
			if ($item['requiredspell'])
				{
					echo"<tr><td class='req'>".$game_text['req_spell']." ".get_dpell_name(get_spell($item['requiredspell']))."</td></tr>";
				}

			// Требования арена рейтинга "Requires personal arena rating of %d"; -- %d is the rating number required
			// $item['RequiredCityRank'] ??
			// PVP_MEDAL1 = "Protector of Stormwind";
			// PVP_MEDAL2 = "Overlord of Orgrimmar";
			// PVP_MEDAL3 = "Thane of Ironforge";
			// PVP_MEDAL4 = "High Sentinel of Darnassus";
			// PVP_MEDAL5 = "Deathlord of the Undercity";
			// PVP_MEDAL6 = "Chieftain of Thunderbluff";
			// PVP_MEDAL7 = "Avenger of Gnomeregan";
			// PVP_MEDAL8 = "Voodoo Boss of Sen'jin";

			// Требования репутации -- Required faction reputation to use the item
			if ($item['RequiredReputationFaction'])
				{
					$faction = get_daction_name($item['RequiredReputationFaction']);
					$rank = get_reputation_rank_name($item['RequiredReputationRank']);
					echo"<tr><td class='faction'>".sprintf($game_text['req_reputation'], $faction, $rank)."</td></tr>";
				}

			if ($ssd)
				{
					echo"<tr><td>".sprintf($game_text['ssd_req_level'], $ssd['maxlevel'], $level)."</td></tr>";
				}
 			// Вывод статов на силу, ловкость, стамину, интелект, стамину
			if ($ssd)
				{
					for ($i=1;$i<=10;$i++)
						{
							render_spell_stat($ssd['statmod_'.$i], $stat_multi * $ssd['modifier_'.$i] / 10000);
						}
				}
			else
				{
					for ($i=1;$i<=$item['StatsCount'];$i++)
						{
							render_spell_stat($item['stat_type'.$i],$item['stat_value'.$i]);
						}
				}

			if ($item['spellid_1'] != 483)
				{
					render_spell($item['spellid_1'],$item['spelltrigger_1'],$item_data?$item_data[ITEM_FIELD_SPELL_CHARGES+0]:$item['spellcharges_1'],$item['spellcooldown_1'],$item['spellcategory_1'],$item['spellcategorycooldown_1']);
					render_spell($item['spellid_2'],$item['spelltrigger_2'],$item_data?$item_data[ITEM_FIELD_SPELL_CHARGES+1]:$item['spellcharges_2'],$item['spellcooldown_2'],$item['spellcategory_2'],$item['spellcategorycooldown_2']);
					render_spell($item['spellid_3'],$item['spelltrigger_3'],$item_data?$item_data[ITEM_FIELD_SPELL_CHARGES+2]:$item['spellcharges_3'],$item['spellcooldown_3'],$item['spellcategory_3'],$item['spellcategorycooldown_3']);
					render_spell($item['spellid_4'],$item['spelltrigger_4'],$item_data?$item_data[ITEM_FIELD_SPELL_CHARGES+3]:$item['spellcharges_4'],$item['spellcooldown_4'],$item['spellcategory_4'],$item['spellcategorycooldown_4']);
					render_spell($item['spellid_5'],$item['spelltrigger_5'],$item_data?$item_data[ITEM_FIELD_SPELL_CHARGES+4]:$item['spellcharges_5'],$item['spellcooldown_5'],$item['spellcategory_5'],$item['spellcategorycooldown_5']);
				}

			if ($item['itemset'])
				{
					$set = get_item_set($item['itemset']);
					if ($set == 0)
						{
							echo"<tr><td class='itemsetname'>&nbsp;&nbsp;Unknown set - ".$item['itemset']."</td></tr>";
						}
   					else
   						{
							// Получаем игрока чтобы вывести инфу о сете
							if ($item_data && $char = get_character($item_data[ITEM_FIELD_OWNER]))
								{
									$char_data = explode(' ',$char['equipmentCache']);
								}


							$text = "";
							$count = 0;
							$itemnum = 0;
     							// Подсчитываем всего вещей в сете (а также если на игроке то сколько из вещей сета на нём)
     							// Одновременно составяем список
							for($i=1;$i<18;$i++)
								{
     									if ($setitem = $set['item_'.$i])
										{
											$count++;
											$name = get_item_name($setitem);
											if (is_item_on_player($setitem, $char_data))
												{
													$itemnum++;
													$text = $text."<tr><td class='enSetName'><a href='?item=".$setitem."'>".$name."</a></td></tr>";
												}
											else
												{
													$text = $text."<tr><td class='disSetName'><a href='?item=".$setitem."'>".$name."</a></td></tr>";
												}
										}
								}
    							echo"<tr><td class='itemsetname'><a href='?itemset=".$set['id']."'>".$set['name']."</a> ($itemnum/$count)</td></tr>";
							if ($set['req_skill'])
								{
									echo"<tr><td class='req'>".sprintf($game_text['req_skill'], get_skill_name($set['req_skill']), $set['req_skill_value'])."</td></tr>";
								}
     							echo $text;
							// Выводим бонусы сета (если на игроке - то активны ион или нет)
							for($i=1;$i<9;$i++)
								{
									if ($setSpell = $set['spell_'.$i])
										{
											$name = get_spell_details($setSpell);
											$num = $set['count_'.$i];
											if ($char_data)
												{
													$iclass = ($num<=$itemnum) ? "enSpell" : "disSpell";
													echo"<tr><td class=".$iclass."><a href='?spell=".$setSpell."'>(".$num.") ".$name."</a></td></tr>";
												}
											else
												{										
													echo"<tr><td><a href='?spell=".$setSpell."'>(".$num.") ".$name."</a></td></tr>";
												}
     										}
								}
   						}
				}

			if ($item['description'] != "")
 				{
					if ($item['spellid_1'] == 483)
						{
							echo"<tr><td><a href='?spell=".$item['spellid_2']."'>".$UseorEquip[$item['spelltrigger_2']]." ".$item['description']."</a></td></tr>";
         						if ($spell = get_spell($item['spellid_2']))
								{
									if ($ritem = get_item($spell['EffectItemType_1']))
										{
											echo"<tr><td>&nbsp;</td></tr>";
											render_item_data($ritem);
										}
									if ($req = get_recipe_req_string($spell))
										{
											echo"<tr><td>&nbsp;</td></tr>";
											echo"<tr><td>".$game_text['req_ingridients']." ".$req."</td></tr>";
             									}
         							}
     						}
     					else
						{
							echo"<tr><td class='itemdesc'>&quot;".$item['description']."&quot;</td></tr>";
						}
				}

			// Written by %s
			if ($creator) { echo"<tr><td class='enSpell'>&lt;".sprintf($game_text['made_by'], $creator)."&gt;</td></tr>"; }
			if ($item['startquest']) { echo"<tr><td>".$game_text['start_quest']."</td></tr>"; }
		}
?>
