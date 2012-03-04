<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2012 lovepsone
+--------------------------------------------------------+
| Filename: include_spell_details.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	// Create aura info string
	function show_aura_info($spell, $effect, $aura)
		{
			global $gSpellEffect, $gSpellAuraName;
			if ($aura == 0) { return; }
			echo': '.get_spell_aura_name($aura);
			$misc = $spell['EffectMiscValue_'.$effect];
			$miscB = $spell['EffectMiscValue2_'.$effect];
			switch ($aura)
				{
					// Misc - это школа спеллов
					case  10: // SPELL_AURA_MOD_THREAT
					case  13: // SPELL_AURA_MOD_DAMAGE_DONE
					case  14: // SPELL_AURA_MOD_DAMAGE_TAKEN
					case  39: // SPELL_AURA_SCHOOL_IMMUNITY
					case  40: // SPELL_AURA_DAMAGE_IMMUNITY
					case  69: // SPELL_AURA_SCHOOL_ABSORB
					case  71: // SPELL_AURA_MOD_SPELL_CRIT_CHANCE_SCHOOL
					case  72: // SPELL_AURA_MOD_POWER_COST_SCHOOL_PCT
					case  73: // SPELL_AURA_MOD_POWER_COST_SCHOOL
					case  74: // SPELL_AURA_REFLECT_SPELLS_SCHOOL
					case  79: // SPELL_AURA_MOD_DAMAGE_PERCENT_DONE
					case  81: // SPELL_AURA_SPLIT_DAMAGE_PCT
					case  83: // SPELL_AURA_MOD_BASE_RESISTANCE
					case  87: // SPELL_AURA_MOD_DAMAGE_PERCENT_TAKEN
					case  97: // SPELL_AURA_MANA_SHIELD
					case 115: // SPELL_AURA_MOD_HEALING
					case 118: // SPELL_AURA_MOD_HEALING_PCT
					case 135: // SPELL_AURA_MOD_HEALING_DONE
					case 136: // SPELL_AURA_MOD_HEALING_DONE_PERCENT
					case 149: // SPELL_AURA_RESIST_PUSHBACK
					case 153: // SPELL_AURA_SPLIT_DAMAGE_FLAT
					case 163: // SPELL_AURA_MOD_CRIT_DAMAGE_BONUS_MELEE
					case 174: // SPELL_AURA_MOD_SPELL_DAMAGE_OF_STAT_PERCENT
					case 179: // SPELL_AURA_MOD_ATTACKER_SPELL_CRIT_CHANCE
					case 183: // SPELL_AURA_MOD_CRITICAL_THREAT
					case 186: // SPELL_AURA_MOD_ATTACKER_SPELL_HIT_CHANCE
					case 199: // SPELL_AURA_MOD_INCREASES_SPELL_PCT_TO_HIT
					case 205:
					case 216: // SPELL_AURA_HASTE_SPELLS
					case 229:
					case 237: // SPELL_AURA_MOD_SPELL_DAMAGE_OF_ATTACK_POWER
					case 238: // SPELL_AURA_MOD_SPELL_HEALING_OF_ATTACK_POWER
					case 259:
						{
							if ($misc == 127 || $misc == 0) { echo' (All schools)'; }
							else if ($misc == 126) { echo' (All magic)'; }
							else if ($misc == 1) { echo' (Physical)'; }
							else { echo' (School: '.get_spell_school($misc).')'; }
							break;
						}
					case  22: // SPELL_AURA_MOD_RESISTANCE
					case 101: // SPELL_AURA_MOD_RESISTANCE_PCT
					case 123: // SPELL_AURA_MOD_TARGET_RESISTANCE
					case 142: // SPELL_AURA_MOD_BASE_RESISTANCE_PCT
					case 143: // SPELL_AURA_MOD_RESISTANCE_EXCLUSIVE
					case 182: // SPELL_AURA_MOD_RESISTANCE_OF_INTELLECT_PERCENT
						{
							if ($misc == 126) { echo' (All magic)'; }
							else if ($misc == 1) { echo' (Armor)'; }
							else { echo' (School: '.getSpellSchool($misc).')'; }
							break;
						}
					// Misc - тип энергии
					case  24: // SPELL_AURA_PERIODIC_ENERGIZE
					case  35: // SPELL_AURA_MOD_INCREASE_ENERGY
					case  63: // SPELL_AURA_PERIODIC_POWER_FUNNEL
					case  64: // SPELL_AURA_PERIODIC_POWER_LEECH
					case  85: // SPELL_AURA_MOD_POWER_REGEN
					case 110: // SPELL_AURA_MOD_POWER_REGEN_PERCENT
					case 162: // SPELL_AURA_POWER_BURN_MANA
						{
							echo' ('.get_power_type_name($misc).')';
							break;
						}
					// Misc - тип модификатора
					case 107: // SPELL_AURA_ADD_FLAT_MODIFIER
					case 108: // SPELL_AURA_ADD_PCT_MODIFIER
						{
							echo' ('.get_spell_mod_name($misc).')';
							break;
						}
					// Misc - тип юнита
					case 44: // SPELL_AURA_TRACK_CREATURES
						{
							echo' ('.get_creature_type($misc).')';
							break;
						}
					// Misc - тип lock
					case 45: // SPELL_AURA_TRACK_RESOURCES
						{
					       		echo' ('.getLockType($misc, 2).')';
					       		break;
						}
					// Misc - маска типа юнита
					case  59: // SPELL_AURA_MOD_DAMAGE_DONE_CREATURE
					case 102: // SPELL_AURA_MOD_MELEE_ATTACK_POWER_VERSUS
					case 131: // SPELL_AURA_MOD_RANGED_ATTACK_POWER_VERSUS
					case 168: // SPELL_AURA_MOD_DAMAGE_DONE_VERSUS
					case 169: // SPELL_AURA_MOD_CRIT_PERCENT_VERSUS
					case 180: // SPELL_AURA_MOD_SPELL_DAMAGE_VS_UNDEAD
						{
							echo' ('.getCreatureTypeList($misc).')';
							break;
						}
					// Misc - тип стата
					case  29: // SPELL_AURA_MOD_STAT
					case  80: // SPELL_AURA_MOD_PERCENT_STAT
					case 137: // SPELL_AURA_MOD_TOTAL_STAT_PERCENTAGE
					case 175: // SPELL_AURA_MOD_SPELL_HEALING_OF_STAT_PERCENT
					case 212: // SPELL_AURA_MOD_RANGED_ATTACK_POWER_OF_STAT_PERCENT
					case 219: // SPELL_AURA_MOD_MANA_REGEN_OF_STAT
					case 268: // SPELL_AURA_MOD_ATTACK_POWER_OF_STAT_PERCENT
						{
							echo' ('.getStatTypeName($misc).')';
							break;
						}
					// Misc - тип скила
					case 30: // SPELL_AURA_MOD_SKILL
					case 98: // SPELL_AURA_MOD_SKILL_TALENT
						{
							echo' ('.get_skill_name($misc).')';
							break;
						}
					// Misc - тип формы
					case 36: // SPELL_AURA_MOD_SHAPESHIFT
						{
							echo' ('.get_form($misc).')';
							break;
						}
					// Misc - тип рейтинга
					case 189: // SPELL_AURA_MOD_RATING
					case 220: // SPELL_AURA_MOD_RATING_FROM_STAT
						{
							echo' ('.get_rating_list($misc).')';
							break;
						}
					// Misc - тип эффекта
					case 37: // SPELL_AURA_EFFECT_IMMUNITY
						{
							echo' ('.$gSpellEffect[$misc].')';
							break;
						}
					// Misc - тип ауры
					case 38: // SPELL_AURA_STATE_IMMUNITY
						{
							echo' ('.$gSpellAuraName[$misc].')';
							break;
						}
					// Misc - тип диспелла
					case  41: // SPELL_AURA_DISPEL_IMMUNITY
					case 178: // SPELL_AURA_MOD_DEBUFF_RESISTANCE
						{
							echo' ('.get_dispel_name(abs($misc)).')';
							break;
						}
					// Misc - тип механики
					case  77: // SPELL_AURA_MECHANIC_IMMUNITY
					case 117: // SPELL_AURA_MOD_MECHANIC_RESISTANCE
					case 232: // SPELL_AURA_MECHANIC_DURATION_MOD
					case 234: // SPELL_AURA_MECHANIC_DURATION_MOD_NOT_STACK
					case 255: // SPELL_AURA_MOD_MECHANIC_DAMAGE_TAKEN_PERCENT
						{
							echo' ('.get_mechanic_name($misc).')';
							break;
						}
					case  56: // SPELL_AURA_TRANSFORM
					case  78: // SPELL_AURA_MOUNTED
						{
							echo' ('.get_creature_name($misc).')';
							break;
						}
					case 190: // SPELL_AURA_MOD_FACTION_REPUTATION_GAIN
						{
							echo' ('.get_faction_name($misc).')';
 							break;
						}
					case 249: // SPELL_AURA_CONVERT_RUNE
						{
							echo' ('.get_rune_name($misc).' => '.get_rune_name($miscB).')';
							break;
						}
					default:
						if ($misc || $miscB)
							{
								echo' ('.$misc.($miscB ? ', '.$miscB : '').')';
							}
					break;
				}
		}

	function show_effect_info($spell, $effect, $eff_id)
		{
			global $txt;
			$misc = $spell['EffectMiscValue_'.$effect];
			switch ($eff_id)
				{
					// школа
					case  2: // SCHOOL_DAMAGE
						{
							echo' ('.get_spell_school($spell['SchoolMask']).')';
							break;
						}
					// Misc - тип энергии
					case  8: // SPELL_EFFECT_POWER_DRAIN
					case 30: // SPELL_EFFECT_ENERGIZE
					case 62: // SPELL_EFFECT_POWER_BURN
						{
							echo' ('.get_power_type_name($misc).')';
							break;
						}
					case  16: // SPELL_EFFECT_QUEST_COMPLETE
					case 147: // SPELL_EFFECT_QUEST_FAIL
					case 139: // SPELL_EFFECT_CLEAR_QUEST
						{
							echo' ('.get_quest_name($misc).')';
							break;
						}
					case  28: // SPELL_EFFECT_SUMMON
					case  56: // SPELL_EFFECT_SUMMON_PET
					case  90: // Kill Credit
					case 134: // Kill Credit
						{
							echo' ('.get_creature_name($misc).')';
							break;
						}
					case  50: // SPELL_EFFECT_SUMMON_OBJECT
					case  76: // SPELL_EFFECT_SUMMON_OBJECT_WILD
					case 104:
					case 105:
					case 106:
					case 107:
						{
							echo' ('.get_gameobject_name($misc).')';
							break;
						}
					case 53: // SPELL_EFFECT_ENCHANT_ITEM
					case 54: // SPELL_EFFECT_ENCHANT_ITEM_TEMPORARY
					case 92: // SPELL_EFFECT_ENCHANT_HELD_ITEM
						{
							echo' ('.get_enchantment_desc($misc).')';
							break;
						}
					case 39: // SPELL_EFFECT_LANGUAGE
						{
							echo' ('.get_laungage_name($misc).')';
							break;
						}
					case  44: // SPELL_EFFECT_SKILL_STEP
					case 118: // SPELL_EFFECT_SKILL
						{
							echo' ('.getSkillName($misc).')';
							break;
						}
					// Misc - тип рейтинга
					case 189: // SPELL_AURA_MOD_RATING
						{
							echo' ('.get_rating_list($misc).')';
							break;
						}
					// Misc - тип диспелла
					case  38: // SPELL_EFFECT_DISPEL
					case 126: // SPELL_EFFECT_STEAL_BENEFICIAL_BUFF
						{
							echo' ('.get_dispel_name(abs($misc)).')';
							break;
						}
					// Misc - тип механики
					case 108: // SPELL_EFFECT_DISPEL_MECHANIC
						{
							echo' ('.get_mechanic_name($misc).')';
					       break;
						}
					case  94: // SPELL_EFFECT_SELF_RESURRECT
					case 113: // SPELL_EFFECT_RESURRECT_NEW
						{
							echo' (Restore '.$misc.' power)';
							break;
						}
					case 103: // SPELL_EFFECT_REPUTATION
						{
							echo' ('.getFactionName($misc).')';
							break;
						}
					case 33:  // SPELL_EFFECT_OPEN_LOCK
						{
							echo' ('.get_lock_type($misc, 2).')';
							break;
						}
					case 146: // SPELL_EFFECT_ACTIVATE_RUNE
						{
							echo' ('.get_rune_name($misc).')';
							break;
						}
					case 74: // SPELL_EFFECT_APPLY_GLYPH
						{
							echo' ('.get_glyph_name($misc).')';
							break;
						}
					default: if ($misc) { echo' ('.$misc.')'; } break;
				}
			if ($effect==1)
				{
					// Spell target position on map
					if ($t = get_spell_target_position($spell['id']))
						{
							echo'<a style="float: right;" href="?map&point='.$t['target_map'].':'.$t['target_position_x'].':'.$t['target_position_y'].':'.$t['target_position_z'].'">'.$txt['map'].'</a>';
						}
					// Spell target
					if ($s = getSpellScriptTarget($spell['id']))
						{
							foreach ($s as $s1)
								{
									if ($s1['type']==0) { echo'<br><a style="float: right;" href="?object='.$s1['targetEntry'].'">'.get_gameobject_name($s1['targetEntry'],0).'</a>'; }
									else if ($s1['type']==1) { echo'<br><a style="float: right;" href="?npc='.$s1['targetEntry'].'">'.get_creature_name($s1['targetEntry'],0).'</a>'; }
									else if ($s1['type']==2) { echo'<br><a style="float: right;" href="?npc='.$s1['targetEntry'].'">'.get_creature_name($s1['targetEntry'],0).'</a>'; }
								}
						}
				}
		}

	function show_effect_data($spell, $effect)
		{
			echo'<tr>';
			echo'<th>Effect '.($effect-1).':</th>';
			echo'<td colspan=3>';

			if ($spell['Effect_'.$effect]==0)
				{
					echo'No Effect';
					return;
				}
			else
				{
					$eff_id    = $spell['Effect_'.$effect];
					$aura      = $spell['EffectApplyAuraName_'.$effect];
					$itemId    = $spell['EffectItemType_'.$effect];
					$triggerId = $spell['EffectTriggerSpell_'.$effect];
					$radius    = $spell['EffectRadiusIndex_'.$effect];
					$amount    = get_base_point_desc($spell, $effect);
					if ($aura == 107 OR $aura == 108 OR $aura == 109 OR $aura == 112)
						{
							$spellFamilyMask = $itemId;
							$itemId = 0;
						}

					echo"($eff_id) ".get_spell_effect_name($eff_id);
					if ($aura)
						{
							show_aura_info($spell, $effect, $aura);
						}
					else
						{
							show_effect_info($spell, $effect, $eff_id);
						}

					if ($spell['EffectAmplitude_'.$effect])
						{
							echo'<br>Interval: '.($spell['EffectAmplitude_'.$effect]/1000).' sec';
						}
					// Спелл
					if ($triggerId)
						{
							$trigger = get_spell($triggerId);
          						if ($trigger)
          							{
             								echo'<table class=no_border><tbody><tr>';
             								echo'<td>';
             								show_spell($trigger['id'], $trigger['SpellIconID'], 'spellinfo');
             								echo'</td>';
             								echo'<td><a href="?spell='.$trigger['id'].'">'.$trigger['SpellName'].'</a><br>Value: '.$amount.'</td>';
             								echo'</tr></tbody></table>';
          							}
          						else
								{
              								echo'<br>Err trigger spell id '.$triggerId;
      								}
						}
      					// Вещь
      					elseif ($itemId)
      						{
          						$item = get_item($itemId);
          						if ($item)
          							{
             								global $Quality;
             								$colorname = $item['Quality'];
             								echo"<table class=no_border><tbody><tr>";
             								echo"<td>";show_item($item['entry'], $item['displayid'], 'spellinfo');echo"</td>";
             								echo"<td><a class=$Quality[$colorname] href=\"?item=$item[entry]\">$item[name]</a>";
             								if ($amount > 1) { echo" x".$amount; }
             								echo"</td>";
             								echo"</tr></tbody></table>";
          							}
          						else
								{
             								echo"<br>Err item id ".$itemId;
								}
      						}
      					else
      						{
        						if ($radius) { echo"<br>Radius: ".get_radius_text($radius); }
        						if ($amount != 0) { echo"<br>Value: ".$amount; }
      						}
				}
			echo"</td>";
			echo"</tr>";
		}

	//********************************************************************************
	// Детальная информация
	//********************************************************************************
	function create_spell_details($spell)
		{
			global $txt;
   			echo'<table class=details align=center><tbody>';
   			echo'<tr><td colspan=4 class=head>'.$txt['detail_info'].'</td></tr>';
   			echo'<tr><th>Name</th><td colspan=2>'.$spell['SpellName'].'</td><td align=right>'.$spell['Rank'].'</td></tr>';

   			if ($spell['Description'])
				{
      					echo'<tr><th width=60>Info:</th><td colspan=3>'.get_spell_desc($spell).'</td></tr>';
				}

			if ($spell['ToolTip'])
				{
      					echo'<tr><th>Buff:</th><td colspan=3>'.get_spell_buff($spell).'</td></tr>';
				}
			// Стоимость и длительность
   			$cost = get_spell_cost_text($spell);
   			$duration = get_spell_duration_text($spell);
			if ($cost OR $duration)
				{
					echo'<tr><th>Cost</th><td>'.($cost?$cost:'No Cost').'</td><th>Duration</th><td>'.$duration.'</td></tr>';
				}

   			echo'<tr>';
   			echo'<th width=13%>Level</th>';
   			echo'<td width=37%>Base '.$spell['baseLevel'].', Max '.$spell['maxLevel'].', Spell '.$spell['spellLevel'].'</td>';
   			echo'<th width=20%>Range</th>';
   			echo'<td width=30%>'.get_range_text($spell['rangeIndex']).'</td>';
   			echo'</tr>';

   			// Время квста и школа (выводятся всегда)
   			echo'<tr><th>Cast time</th><td>'.get_cast_time_text($spell).'</td><th>School</th><td>'.get_spell_school($spell['SchoolMask']).'</td></tr>';

			$skillAbility = get_skill_line_ability($spell['id']);
			if ($skillAbility OR $spell['Category'])
				{
					echo'<tr>';
					echo'<th>Skill</th>';
					if ($skillAbility)
						{
      							echo'<td>'.get_skill_name($skillAbility['skillId']).'</td>';
						}
					else
						{
							echo'<td>n/a</td>';
						}

					echo'<th>Category</th>';
					if ($spell['Category'])
						{
      							echo'<td>'.get_category_name($spell['Category']).'</td>';
						}
					else
						{
							echo'<td>n/a</td>';
						}
    					echo'</tr>';
				}
			// Вывод механики и диспелла
			if ($spell['Mechanic'] OR $spell['Dispel'])
				{
					echo'<tr>';
					echo'<th>Mechanic</th><td>'.get_mechanic_name($spell['Mechanic']).'</td>';
					echo'<th>Dispel type</th><td>'.get_dispel_name($spell['Dispel']).'</td>';
					echo'</tr>';
				}
			// Вывод кулдаунов
			$cooldown = get_spell_cooldown($spell);
			if ($cooldown OR $spell['StartRecoveryCategory'] OR $spell['StartRecoveryTime'])
				{
					echo'<tr>';
					echo'<th>Cooldown</th>';
					if ($cooldown)
						{
        						echo'<td>'.get_time_text($cooldown/1000).'</td>';
						}
					else
        					{
							echo'<td>No cooldown</td>';
						}

					echo'<th>Global cooldown</th>';
					if ($spell['StartRecoveryCategory'] OR $spell['StartRecoveryTime'])
						{
							echo'<td>';
							echo'Affected';
							if ($spell['StartRecoveryTime']) { echo', '.get_time_text($spell['StartRecoveryTime']/1000); } else { echo', Not start'; }
							echo'</td>';
						}
					else
						{
							echo'<td>n/a</td>';
						}
					echo'</tr>';
				}
			// Вывод требований форм
			$stances    = $spell['Stances'];
			$stancesNot = $spell['StancesNot'];
			if ($stances OR $stancesNot)
				{
					echo'<tr>';
					echo'<th>Req form</th>';
					if ($stances)
						{
							echo'<td>'.getAllowableForm($stances).'</td>';
						}
					else
						{
							echo'<td>n/a</td>';
						}

					echo'<th>Not in form</th>';
					if ($stancesNot)
 						{
							echo'<td>'.get_allowable_form($stancesNot).'</td>';

						}
					else
        					{
							echo'<td>n/a</td>';
						}
					echo'</tr>';
				}
			// Вывод требований одетого снаряжения
			$itemClass = $spell['EquippedItemClass'];
			$itemSubClass = $spell['EquippedItemSubClassMask'];
			$inventoryTypeMask = $spell['EquippedItemInventoryTypeMask'];
			if ($itemClass >= 0 OR $inventoryTypeMask)
				{
					echo'<tr>';
					echo'<th>Req item</th>';
					if ($itemClass >=0)
						{
							echo'<td>';
							if ($itemSubClass)
								{
									echo get_class_name($itemClass,0).': '.get_subclass_list($itemClass, $itemSubClass);
								}
        						else
								{
									echo get_class_name($itemClass);
								}
        						echo'</td>';
     						}
					else
						{
							echo'<td>n/a</td>';
						}
					echo'<th>Inv type</th>';
					if ($inventoryTypeMask)
						{
        						echo'<td>'.get_inventory_type_list($inventoryTypeMask).'</td>';
						}
					else
						{
							echo'<td>n/a</td>';
						}
					echo'</tr>';
				}
			// Вывод тотм категорий и спеллфокуса
			$totem1=$spell['TotemCategory_1'];
			$totem2=$spell['TotemCategory_2'];
			$focus =$spell['RequiresSpellFocus'];
			if ($totem1 OR $totem2 OR $focus)
				{
					echo'<tr>';
					echo'<th>Tools</th>';
					if ($totem1 OR $totem2)
						{
							echo'<td>';
							if ($totem1) { echo get_totem_category($totem1); }
							if ($totem2) { echo', '.get_totem_category($totem2); }
							echo'</td>';
						}
					else
						{
        						echo'<td>n/a</td>';
     						}
					echo'<th>Spell Focus</th>';
					if ($focus)
        					{
							echo'<td>'.get_spell_focus_name($focus, 2).'</td>';
						}
					else
						{
							echo'<td>n/a</td>';
						}
					echo'</tr>';
				}
			$area=$spell['AreaGroupId'];
			if ($area)
				{
					echo'<tr>';
					echo'<th>Area</th>';
					if ($area) { echo'<td>'.$area.'</td>'; } else { echo'<td>n/a</td>'; }
					echo'</tr>';
				}
			// Вывод требований целей
			$targets    = $spell['Targets'];
			$targetCreature = $spell['TargetCreatureType'];
			if ($targets OR $targetCreature)
				{
					echo'<tr>';
					echo'<th>Targets</th>';
					if ($targets) { echo'<td>'.get_targets_list($targets).'</td>'; } else { echo'<td>n/a</td>'; }
					echo'<th>Creature type</th>';
					if ($targetCreature) { echo'<td>'.get_creature_type_list($targetCreature).'</td>'; } else { echo'<td>n/a</td>'; }
     					echo'</tr>';
   				}
			if ($spell['Reagent_1'] OR $spell['Reagent_2'] OR $spell['Reagent_3'] OR $spell['Reagent_4'] OR $spell['Reagent_5'] OR $spell['Reagent_6'] OR $spell['Reagent_7'] OR $spell['Reagent_8'])
				{
					echo'<tr>';
					echo'<th>Reagents</th>';
					echo'<td colspan=3>'; r_spell_reagents($spell); echo'</td>';
					echo'</tr>';
				}
			// Вывод эффектов
			show_effect_data($spell, 1);
			show_effect_data($spell, 2);
			show_effect_data($spell, 3);
			echo'</tbody></table>';
		}
?>