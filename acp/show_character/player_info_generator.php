<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2012 lovepsone
+--------------------------------------------------------+
| Filename: player_info_generator.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	//===========================================================================
	// Вспомогательные функции
	//===========================================================================
	define('PET_BONUS_RAP_TO_AP',0);
	define('PET_BONUS_RAP_TO_SPELLDMG',1);
	define('PET_BONUS_STAM',2);
	define('PET_BONUS_RES',3);
	define('PET_BONUS_ARMOR',4);
	define('PET_BONUS_SPELLDMG_TO_SPELLDMG',5);
	define('PET_BONUS_SPELLDMG_TO_AP',6);
	define('PET_BONUS_INT',7);

	function compute_pet_bonus($stat, $value, $unitClass)
		{
  			$HUNTER_PET_BONUS =array(0.22,0.1287,0.3,0.4,0.35,0.0,0.0,0.0);
  			$WARLOCK_PET_BONUS=array(0.0,0.0,0.3,0.4,0.35,0.15,0.57,0.3);
  			if($unitClass == CLASS_WARLOCK )
  				{
   					if($WARLOCK_PET_BONUS[$stat]) { return $value * $WARLOCK_PET_BONUS[$stat]; } else { return 0; }
  				}
  			elseif($unitClass == CLASS_HUNTER )
  				{
   					if($HUNTER_PET_BONUS[$stat]) { return $value * $HUNTER_PET_BONUS[$stat]; } else { return 0; }
  				}
  			return 0;
		}

	// Вспомогательные функции получения данных
	function get_float_value($value,$num)
		{
 			$txt = unpack("f", pack("L",$value));
 			return round($txt[1],$num);
		}

	// Получаем класс игрока
	function get_class_id($char)
		{
 			return $char['class'];
		}

	// Игрок использует ману
	function isManaUser($char_data)
		{
 			switch ($char_data['class'])
 				{
					case 2:
					case 3:
					case 5:
					case 7:
					case 8:
					case 9:
					case 11:  	$powerType = 0;   break;
					default: 	$powerType = 1;
 				}

 			if ($powerType == 0) { return true; } else { return false; }
		}

	// Крит от ловкости
	function get_crit_chance_from_agility($rating, $char_data)
		{
 			$base = Array(3.1891, 3.2685, -1.532, -0.295, 3.1765, 3.1890, 2.922, 3.454, 2.6222, 20, 7.4755);
 			$ratingkey = array_keys($rating);
 			$class     = get_class_id($char_data);
 			$char_stat = get_character_stats($char_data['guid']);
 			$agi       = $char_stat['agility'];
 			return $base[$class-1] + $agi*$rating[$ratingkey[$class]]*100;
		}

	function get_spell_crit_chance_from_intellect($rating, $char_data)
		{
			$base = Array(0, 3.3355, 3.602, 0, 1.2375, 0, 2.201, 0.9075, 1.7, 20, 1.8515);
			$ratingkey = array_keys($rating);
			$class     = get_class_id($char_data);
			$char_stat = get_character_stats($char_data['guid']);
			$int       = $char_stat['intellect'];
			return $base[$class-1] + $int*$rating[$ratingkey[11+$class]]*100;
		}

	function get_attack_power_for_stat($statIndex, $effectiveStat, $class)
		{
 			$ap=0;
 			if ($statIndex == STAT_STRENGTH)
 				{
  					switch ($class)
  						{
   							case CLASS_WARRIOR:
   							case CLASS_PALADIN:
   							case CLASS_DEATH_KNIGHT:
   							case CLASS_DRUID:
    							  $baseStr=min($effectiveStat,20);
    							  $moreStr=$effectiveStat-$baseStr;
    							  $ap=$baseStr + 2*$moreStr;
   							break;
   							default:
    							  $ap=$effectiveStat - 10;
   							break;
  						}
 				}
 			elseif ($statIndex == STAT_AGILITY)
 				{
  					switch ($class)
  						{
				   			case CLASS_SHAMAN:
				   			case CLASS_ROGUE:
				   			case CLASS_HUNTER:
				    			  $ap=$effectiveStat - 10;
  						}
 				}
 			if ($ap < 0) { $ap=0; }
 			return $ap;
		}

	function get_rating_coefficient($rating, $id)
		{
 			$ratingkey = array_keys($rating);
 			$c = $rating[$ratingkey[44+$id]];if ($c==0) $c=1;
 			return $c;
		}

	function get_hr_coefficient($rating, $class)
		{
 			$ratingkey = array_keys($rating);
 			$c = $rating[$ratingkey[22+$class]];if ($c==0) $c=1;
 			return $c;
		}

	function get_mr_coefficient($rating, $class)
		{
 			$ratingkey = array_keys($rating);
 			$c = $rating[$ratingkey[33+$class]];if ($c==0) $c=1;
 			return $c;
		}

	// Функции генерации таблиц оболочек
	function create_top_table()
		{
 			ob_start();
 			echo"<table class='chartt' cellSpacing='0'>";
		}

	function create_end_table($valueClass, $value)
		{
 			echo "</table>";
 			$data = ob_get_contents();
 			ob_end_clean();
 			echo'<td '.add_tooltip($data, 'WIDTH, 400, OFFSETX, 30, OFFSETY, 20, STICKY, false').' class='.$valueClass.'>'.$value.'</td>';
		}

	function create_header($name,$base,$valueClass)
		{
 			create_top_table();
			echo"<tr><td class='head'>$name <span class=$valueClass>$base</span>";
 			echo"</td></tr>";
		}
	//=========================================
	// Создаём тултип по одному из статов:
	// 0 - Броня, 1-9 ... Resistance
	function render_resist($statIndex, $stat, $char_data)
		{
 			$ResistType = array(
				  0=>"armor",
				  1=>"holy",
				  2=>"fire",
				  3=>"nature",
				  4=>"frost",
				  5=>"shadow",
				  6=>"arcane",
 				);

 			$class = $char_data['class'];
 			$valueClass = "normStat";

 			create_header(get_resistance($statIndex),$stat,$valueClass);
 			echo"<tr><td>";
 			if ($statIndex == SCHOOL_ARMOR)
 				{
					$levelModifier = $char_data['level'];
					if ($levelModifier > 59 ) { $levelModifier = $levelModifier + (4.5 * ($levelModifier-59)); }
					$armorReduction = 0.1*$stat/(8.5*$levelModifier + 40);
					$armorReduction = $armorReduction/(1+$armorReduction)*100;
					if ($armorReduction > 75) { $armorReduction = 75; }
					if ($armorReduction <  0) { $armorReduction = 0; }
    					printf("Reduces Physical Damage taken by %0.2f%%",$armorReduction);
    					$petBonus = compute_pet_bonus(PET_BONUS_ARMOR, $stat, $class);
					if( $petBonus > 0 ) { printf("<br>Increases your pet`s Armor by %d", $petBonus); }
    					echo"</td></tr>";
    					create_end_table($valueClass, $stat);
 				}
 			else
 				{
  					$unitLevel = max($char_data['level'],20);
  					$magicResistanceNumber = $stat/$unitLevel;
					if     ($magicResistanceNumber > 5   ) $resistanceLevel = "Excellent";
					elseif ($magicResistanceNumber > 3.75) $resistanceLevel = "Very Good";
					elseif ($magicResistanceNumber > 2.5 ) $resistanceLevel = "Good";
					elseif ($magicResistanceNumber > 1.25) $resistanceLevel = "Fair";
					elseif ($magicResistanceNumber > 0   ) $resistanceLevel = "Poor";
					else                                   $resistanceLevel = "None";
  					printf("Increases the ability to resist %s-based attacks, spells and abilities.<br />",get_school($statIndex));
  					printf("Resistance against level %d: %s",$unitLevel,$resistanceLevel);
  					$petBonus = compute_pet_bonus(PET_BONUS_RES,$stat,$class);
  					if($petBonus > 0) { printf("<br>Increases your pet`s Resistance by %d",$petBonus); }
    					echo"</td></tr>";
  					create_end_table($ResistType[$statIndex], $stat) ;
 				}
		}

	//=========================================
	// Stats panel
	// Создаём тултип по одному из статов:
	function render_stat_row($statIndex, $char_data, $stat)
		{
 			$rating = get_rating($char_data['level']);
 			$StatText = get_stat_type_name($statIndex);
 			$class = $char_data['class'];
 			$effectiveStat = $stat;
 			create_header($StatText,$effectiveStat,"normStat");
 			echo"<tr><td>";
 			if ($statIndex==STAT_STRENGTH)
 				{
  					$attpower = get_attack_power_for_stat(STAT_STRENGTH, $effectiveStat, $class);
  					printf("Increases Attack Power by %d",$attpower);
  					if ($class == CLASS_WARRIOR OR $class == CLASS_PALADIN OR $class == CLASS_SHAMAN)
  						{
   							$block = max(0, $effectiveStat*BLOCK_PER_STRENGTH - 10);
   							printf("<br>Increases Block by %d",$block);
  						}
 				}
 			elseif ($statIndex == STAT_AGILITY)
 				{
  					$crit = get_crit_chance_from_agility($rating,$char_data);
  					$attackPower = get_attack_power_for_stat(STAT_AGILITY, $effectiveStat, $class);
  					$armor = $effectiveStat * ARMOR_PER_AGILITY;
  					if ($attackPower > 0 ) { printf("Increases Attack Power by %d<br>", $attackPower); }
  					printf("Increases Critical Hit chance by %.2f%%<br>Increases Armor by %d",$crit,$armor);
 				}
 			elseif ($statIndex == STAT_STAMINA)
 				{
 					$baseStam = min(20, $effectiveStat);
					$moreStam = $effectiveStat - $baseStam;
					$health   = $baseStam + ($moreStam*HEALTH_PER_STAMINA);
    					printf("Increases Health by %d",$health);
    					$petStam = compute_pet_bonus(PET_BONUS_STAM, $effectiveStat, $class);
					if($petStam > 0) { printf("<br />Increases your pet`s Stamina by %d",$petStam); }

 				}
 			elseif ($statIndex == STAT_INTELLECT)
 				{
  					$baseInt = min(20, $effectiveStat);
  					$moreInt = $effectiveStat - $baseInt;
  					$mana = $baseInt + $moreInt*MANA_PER_INTELLECT;
  					$spellcrit = get_spell_crit_chance_from_intellect($rating, $char_data);
  					if (isManaUser($char_data)) { printf("Increases Mana by %d<br>Increases Spell Critical Hit by %.2f%%",$mana,$spellcrit); }
  					$petInt = compute_pet_bonus(PET_BONUS_INT, $effectiveStat, $class);
  					if($petInt > 0 ) { printf("<br />Increases your pet`s Intellect by %d", $petInt); }

 				}
 			elseif ($statIndex == STAT_SPIRIT)
 				{
  					$baseRatio = array(0, 0.625, 0.2631, 0.2, 0.3571, 0.1923, 0.625, 0.1724, 0.1212, 0.1282, 1, 0.1389);
  					$regen = $effectiveStat * get_hr_coefficient($rating, $class);
  					$baseSpirit = $effectiveStat;
  					if ($baseSpirit>50) { $baseSpirit = 50; }
  					$moreSpirit = $effectiveStat - $baseSpirit;
  					$regen = $baseSpirit * $baseRatio[$class] + $moreSpirit * get_hr_coefficient($rating, $class);
  					printf("Increases Health Regeneration by %d Per Second while not in combat", $regen);
  					if (isManaUser($char_data))
  						{
   							$int = $char_data[UNIT_FIELD_STAT0 + STAT_INTELLECT];
   							$regen = sqrt($int) * $effectiveStat * get_mr_coefficient($rating, $class);
   							$regen = floor($regen*5);
   							printf("<br />Increases Mana Regeneration by %d Per 5 Seconds while not casting", $regen);
  						}
 				}
 			echo"</td></tr>";
 			$valueClass = "normStat";
 			create_end_table($valueClass, $effectiveStat);
		}
	//=========================================
	// Spell Panel
	// Создаём тултип по спелл урону:
	function get_spell_bonus_damage($School,$char_data)
		{
			$bonus = $char_data[PLAYER_FIELD_MOD_DAMAGE_DONE_POS+$School] +  $char_data[PLAYER_FIELD_MOD_DAMAGE_DONE_NEG+$School];
			$bonus = $bonus*get_float_value($char_data[PLAYER_FIELD_MOD_DAMAGE_DONE_PCT+$School],5);
			return $bonus;
		}

	function render_spell_damage($char_data)
		{
			$holySchool = 1;
			$minModifier = get_spell_bonus_damage($holySchool,$char_data);
			create_top_table();
			$text="";
			for ($i=$holySchool;$i<7;$i++)
				{
					$bonusDamage = get_spell_bonus_damage($i, $char_data);
					$minModifier = min($minModifier, $bonusDamage);
					$text =$text."<tr valign=center><td width='1px'><img src=images/player_info/characterframe/SpellSchoolIcon$i.gif></td><td>&nbsp;".getSchool($i)."</td><td align=right>$bonusDamage</td></tr>";
			 	}
			echo"<tr><td class='head' colSpan='3'>Bonus Damage $minModifier</td></tr>";
			echo $text;
			$class = get_class_id($char_data);
			if ($class==CLASS_WARLOCK OR $class==CLASS_HUNTER)
				{
					$shadow = get_spell_bonus_damage(SCHOOL_SHADOW, $char_data);
					$fire   = get_spell_bonus_damage(SCHOOL_FIRE, $char_data);
					$petBonusAP = Compute_pet_bonus(PET_BONUS_SPELLDMG_TO_AP, max($shadow,$fire),$class);
					$petBonusDmg = Compute_pet_bonus(PET_BONUS_SPELLDMG_TO_SPELLDMG, max($shadow,$fire),$class);
			  		if ($petBonusAP OR $petBonusDmg)
			  			{
			   				if ($shadow>$fire) { printf("<tr><td colSpan=3>Your Shadow Damage increases your pet`s Attack Power by %d and Spell Damage by %d</td></tr>",$petBonusAP,$petBonusDmg); }
			   				else { printf("<tr><td colSpan=3>Your Fire Damage increases your pet`s<br>Attack Power by %d and<br>Spell Damage by %d</td></tr>",$petBonusAP,$petBonusDmg); }
			  			}
				}
			create_end_table("normStat", $minModifier);
		}

//=========================================
// Создаём тултип по спелл хилу:
function renderSpellHeal($char_data)
{
 $bonus = $char_data[PLAYER_FIELD_MOD_HEALING_DONE_POS];
 create_top_table();
 printf("<tr><td class='head'>Bonus Healing</td></tr>");
 printf("<tr><td>Increases your healing by up to %d</td></tr>",$bonus);
 create_end_table("normStat", $bonus);
}

function renderSpellHit($char_data)
{
 $rating = get_rating($char_data['level']);
 $valueRating = $char_data[PLAYER_FIELD_SPELL_HIT_RATING];
 $RatingPct   = $valueRating/get_rating_coefficient($rating, CR_HIT_SPELL);
 create_top_table();
 printf ("<tr><td class='head'>Hit Rating %d</td></tr>", $valueRating);
 printf ("<tr><td>Increases your spell chance to hit a target of level %d by %.2f%%</td></tr>", $char_data['level'], $RatingPct);
 $penetration = $char_data[PLAYER_FIELD_MOD_TARGET_RESISTANCE];
 printf ("<tr><td><br>Spell penetration %d (Reduces enemy resistances by %d)</td></tr>", $penetration, -$penetration);
 create_end_table("normStat", $valueRating);
}
//=========================================
// Создаём тултип по спелл криту:
function renderSpellCrit($char_data)
{
 $rating = get_rating($char_data['level']);
 $spellCritRating = $char_data[PLAYER_FIELD_SPELL_CRIT_RATING];
 $minCrit = get_float_value($char_data[PLAYER_SPELL_CRIT_PERCENTAGE+1],2);
 $critRatingPct =  $spellCritRating/get_rating_coefficient($rating, CR_CRIT_SPELL);
 create_top_table();
 printf ("<tr><td class='head' colSpan=3>Crit Rating %d (%.2f%%)</td></tr>",$spellCritRating, $critRatingPct);
 for ($i=1;$i<7;$i++)
 {
  $crit = get_float_value($char_data[PLAYER_SPELL_CRIT_PERCENTAGE+$i],2);
  $minCrit=min($minCrit,$crit);
  echo "<tr valign=center><td width=1px><img src=images/player_info/characterframe/SpellSchoolIcon$i.gif></td>";
  echo                   "<td>&nbsp;".getSchool($i)."</td><td align=right width=80px>$crit%</td></tr>";
 }
 create_end_table("normStat", $minCrit."%");
}

function renderSpellHaste($char_data)
{
 $rating = get_rating($char_data['level']);
 $valueRating = $char_data[PLAYER_FIELD_SPELL_HASTE_RATING];
 $RatingPct   = $valueRating/get_rating_coefficient($rating, CR_HASTE_SPELL);
 create_top_table();
 printf ("<tr><td class='head'>Haste rating %d</td></tr>", $valueRating);
 printf ("<tr><td>Increases the speed that you spell cast by %.2f%%</td></tr>", $RatingPct);
 create_end_table("normStat", $valueRating);
}

function renderManaRegen($char_data)
{
 $value  = get_float_value($char_data[UNIT_FIELD_POWER_REGEN_FLAT_MODIFIER],2)*5;
 $valueI = get_float_value($char_data[UNIT_FIELD_POWER_REGEN_INTERRUPTED_FLAT_MODIFIER],2)*5;
 create_top_table();
 printf ("<tr><td class='head'>Mana Regen</td></tr>");
 printf ("<tr><td>%d mana regenerated every 5 seconds while not casting<br>%d mana regenerated every 5 seconds while casting</td></tr>", $value, $valueI);
 create_end_table("normStat", $value);
}

// Render melee panel
function renderMeleeSkill($char_data)
{
 $rating = get_rating($char_data['level']);
 $skillID = getSkillFromItemID($char_data[PLAYER_VISIBLE_ITEM_MAIN_HAND]);
 $skill   = getSkill($skillID,$char_data);
 $defRating = $char_data[PLAYER_FIELD_MELEE_WEAPON_SKILL_RATING];
 $RatingAdd = $defRating/get_rating_coefficient($rating, CR_DEFENSE_SKILL);
 $Buff          = $skill[4]+$skill[5]+intval($RatingAdd);
 $effectiveStat = $skill[2]+$Buff;
 create_top_table();
 printf("<tr><td class='head'>Main hand %d</td></tr>", $effectiveStat);
 printf("<tr><td>Skill Rating %d (+%d Skill)</td></tr>", $defRating, $RatingAdd);
 $valueClass = "normStat";
      if ($Buff<0) $valueClass = "negStat";
 else if ($Buff>0) $valueClass = "posStat";
 create_end_table($valueClass, $effectiveStat);
}

function renderMeleeDamage($char_data)
{
 $minDamage  = get_float_value($char_data[UNIT_FIELD_MINDAMAGE],0);
 $maxDamage  = get_float_value($char_data[UNIT_FIELD_MAXDAMAGE],0);
 $speed      = get_float_value($char_data[UNIT_FIELD_BASEATTACKTIME],2)/1000;
 $Damage     = ($minDamage + $maxDamage) * 0.5;
 if ($speed < 0.1) $speed = 0.1;
 $damagePerSecond = (max($Damage,1) / $speed);
 create_top_table();
 echo "<tr><td class='head'>Main Hand</td></tr>";
 printf ("<tr><td>Attack Speed (seconds):</td><td align=right>%.2f</td></tr>", $speed);
 printf ("<tr><td>Damage:</td><td align=right>%d - %d</td></tr>", $minDamage, $maxDamage);
 printf ("<tr><td>Damage per Second:</td><td align=right>%.2f</td></tr>", $damagePerSecond);
 $skillID = getSkillFromItemID($char_data[PLAYER_VISIBLE_ITEM_OFF_HAND]);
 if ($skillID!=SKILL_UNARMED)
 {
  $minOffHandDamage = get_float_value($char_data[UNIT_FIELD_MINOFFHANDDAMAGE],0);
  $maxOffHandDamage = get_float_value($char_data[UNIT_FIELD_MAXOFFHANDDAMAGE],0);
  $offhand_speed    = get_float_value($char_data[UNIT_FIELD_OFFHANDATTACKTIME],2)/1000;
  $Damage     = ($minOffHandDamage + $maxOffHandDamage) * 0.5;
  $offdamagePerSecond = (max($Damage,1) / $speed);
  echo "<tr><td class='head'>Off Hand</td></tr>";
  printf ("<tr><td>Attack Speed (seconds):</td><td align=right>%.2f</td></tr>", $offhand_speed);
  printf ("<tr><td>Damage:</td><td align=right>%d - %d</td></tr>", $minOffHandDamage, $maxOffHandDamage);
  printf ("<tr><td>Damage per Second:</td><td align=right>%.2f</td></tr>", $offdamagePerSecond);
 }
 create_end_table("normStat", $minDamage." - ".$maxDamage);
}

function renderMeleeSpeed($char_data)
{
 $rating = get_rating($char_data['level']);
 $main_speed = get_float_value($char_data[UNIT_FIELD_BASEATTACKTIME],2)/1000;
 $offhand_speed = get_float_value($char_data[UNIT_FIELD_OFFHANDATTACKTIME],2)/1000;
 $speed = round($main_speed,2);
 $skillID = getSkillFromItemID($char_data[PLAYER_VISIBLE_ITEM_OFF_HAND]);
 if ($skillID!=SKILL_UNARMED)
   $speed = $speed." / ". round($offhand_speed,2);
 $valueRating = $char_data[PLAYER_FIELD_MELEE_HASTE_RATING] ;
 $RatingPct   = $valueRating/get_rating_coefficient($rating, CR_HASTE_RANGED);

 create_top_table();
 echo "<tr><td class='head'>Attack Speed $speed</td></tr>";
 printf ("<tr><td>Haste rating %d (%.2f%% haste)</td></tr>", $valueRating, $RatingPct);
 create_end_table("normStat", $speed);
}

function renderMeleeAP($char_data)
{
 $multipler = get_float_value($char_data[UNIT_FIELD_ATTACK_POWER_MULTIPLIER], 8);
 if   ($multipler<0) $multipler = 0;
 else $multipler+=1;
 $effectiveStat = $char_data[UNIT_FIELD_ATTACK_POWER]*$multipler;
 $Buff     = $char_data[UNIT_FIELD_ATTACK_POWER_MODS]*$multipler;
 $posBuff = 0;
 $negBuff = 0;
 $valueClass = "normStat";
      if ($Buff>0) {$posBuff=$Buff;$valueClass = "posStat";}
 else if ($Buff<0) {$negBuff=$Buff;$valueClass = "negStat";}
 $stat = $effectiveStat+$Buff;
 createHeader("Attack Power",$stat,"normStat");
 printf ("<tr><td>Increases damage with melee weapons by %.1f damage per second.</td></tr>",max($stat, 0)/ATTACK_POWER_MAGIC_NUMBER);
 create_end_table($valueClass, $stat);
}

function renderMeleeHit($char_data)
{
 $rating = get_rating($char_data['level']);
 $valueRating = $char_data[PLAYER_FIELD_MELEE_HIT_RATING];
 $RatingPct   = $valueRating/get_rating_coefficient($rating, CR_HIT_MELEE);
 create_top_table();
 printf ("<tr><td class='head'>Hit Rating %d</td></tr>", $valueRating);
 printf ("<tr><td>Increases your melee chance to hit a target of level %d by %.2f%%</td></tr>", $char_data['level'], $RatingPct);
 $penetration = $char_data[PLAYER_FIELD_MOD_TARGET_PHYSICAL_RESISTANCE];
 printf ("<tr><td><br>Enemy Armor reduced by %d</td></tr>", $penetration);
 create_end_table("normStat", $valueRating);
}

function renderMeleeCrit($char_data)
{
 $rating = get_rating($char_data['level']);
 $meleeCrit       = get_float_value($char_data[PLAYER_CRIT_PERCENTAGE],2);
 $meleeCritRating = $char_data[PLAYER_FIELD_MELEE_CRIT_RATING];
 $critRatingPct   = $meleeCritRating/get_rating_coefficient($rating, CR_CRIT_MELEE);
 create_top_table();
 printf ("<tr><td class='head'>Crit Chance %.2f%%</td></tr>",$meleeCrit);
 printf ("<tr><td>Crit Rating %d (%.2f%% crit chance)</td></tr>", $meleeCritRating, $critRatingPct);
 create_end_table("normStat", $meleeCrit."%");
}
// =================================
// Render ranged panel
function renderRangedSkill($char_data)
{
 $rating = get_rating($char_data['level']);
 $skillID = getSkillFromItemID($char_data[PLAYER_VISIBLE_ITEM_RANGED]);
 if ($skillID==SKILL_UNARMED)
 {
  create_top_table();
  printf("<tr><td class='head'>Ranged N/A</td></tr>");
  create_end_table("normStat", "N/A");
  return;
 }
 $skill   = getSkill($skillID,$char_data);
 $defRating = $char_data[PLAYER_FIELD_MELEE_WEAPON_SKILL_RATING];
 $RatingAdd = $defRating/get_rating_coefficient($rating, CR_DEFENSE_SKILL);
 $Buff          = $skill[4]+$skill[5]+intval($RatingAdd);
 $effectiveStat = $skill[2]+$Buff;
 create_top_table();
 printf("<tr><td class='head'>Main hand %d</td></tr>", $effectiveStat);
 printf("<tr><td>Skill Rating %d (+%d Skill)</td></tr>", $defRating, $RatingAdd);
 $valueClass = "normStat";
      if ($Buff<0) $valueClass = "negStat";
 else if ($Buff>0) $valueClass = "posStat";
 create_end_table($valueClass, $effectiveStat);
}
function renderRangedDamage($char_data)
{
 create_top_table();
 $skillID = getSkillFromItemID($char_data[PLAYER_VISIBLE_ITEM_RANGED]);
 if ($skillID==SKILL_UNARMED)
 {
  echo "<tr><td class='head'>Ranged N/A</td></tr>";
  create_end_table("normStat", "N/A");
 }
 else
 {
  $minDamage  = get_float_value($char_data[UNIT_FIELD_MINRANGEDDAMAGE],0);
  $maxDamage  = get_float_value($char_data[UNIT_FIELD_MAXRANGEDDAMAGE],0);
  $speed      = get_float_value($char_data[UNIT_FIELD_RANGEDATTACKTIME],2)/1000;
  $Damage     = ($minDamage + $maxDamage) * 0.5;
  if ($speed < 0.1) $speed = 0.1;
  $damagePerSecond = (max($Damage,1) / $speed);
  echo "<tr><td class='head'>Ranged</td></tr>";
  printf ("<tr><td>Attack Speed (seconds):</td><td align=right>%.2f</td></tr>", $speed);
  printf ("<tr><td>Damage:</td><td align=right>%d - %d</td></tr>", $minDamage, $maxDamage);
  printf ("<tr><td>Damage per Second:</td><td align=right>%.2f</td></tr>", $damagePerSecond);
  create_end_table("normStat", $minDamage." - ".$maxDamage);
 }
}
function renderRangedSpeed($char_data)
{
 $rating = get_rating($char_data['level']);
 $skillID = getSkillFromItemID($char_data[PLAYER_VISIBLE_ITEM_RANGED]);
 if ($skillID==SKILL_UNARMED)
 {
  create_top_table();
  printf("<tr><td class='head'>Attack Speed N/A</td></tr>");
  create_end_table("normStat", "N/A");
  return;
 }
 $range_speed = get_float_value($char_data[UNIT_FIELD_RANGEDATTACKTIME],2)/1000;
 $valueRating = $char_data[PLAYER_FIELD_RANGED_HASTE_RATING] ;
 $RatingPct   = $valueRating/get_rating_coefficient($rating, CR_HASTE_RANGED);
 create_top_table();
 printf ("<tr><td class='head'>Attack Speed %.2f</td></tr>", $range_speed);
 printf ("<tr><td>Haste rating %d (%.2f%% haste)</td></tr>", $valueRating, $RatingPct);
 create_end_table("normStat", $range_speed);
}

	function render_ranged_ap($char_data)
		{
			$class = get_class_id($char_data);
			$multipler = get_float_value($char_data[UNIT_FIELD_RANGED_ATTACK_POWER_MULTIPLIER], 8);
			if   ($multipler<0) $multipler = 0;
			else $multipler+=1;
			$effectiveStat = $char_data[UNIT_FIELD_RANGED_ATTACK_POWER]*$multipler;
			$Buff      = $char_data[UNIT_FIELD_RANGED_ATTACK_POWER_MODS]*$multipler;
			
			$multiple = get_float_value($char_data[UNIT_FIELD_RANGED_ATTACK_POWER_MULTIPLIER],2);
			$posBuff = 0;
			$negBuff = 0;
			$valueClass = "normStat";
			if ($Buff>0) { $posBuff=$Buff;$valueClass = "posStat"; }
			else if ($Buff<0) { $negBuff=$Buff;$valueClass = "negStat"; }
			$stat = $effectiveStat+$Buff;
			create_header("Attack Power",$stat,"normStat");
			printf ("<tr><td>Increases damage with ranged weapons by %.1f damage per second.</td></tr>",max($stat, 0)/ATTACK_POWER_MAGIC_NUMBER);
			
			if ($petAp = compute_pet_bonus(PET_BONUS_RAP_TO_AP, $stat, $class)) { printf ("<tr><td>Increases your pet`s Attack Power by %d</td></tr>", $petAp); }
			if ($penSpellDamage = compute_pet_bonus(PET_BONUS_RAP_TO_SPELLDMG, $stat, $class)) { printf ("<tr><td>Increases your pet`s Spell Damage by %d</td></tr>", $penSpellDamage); }
			
			create_end_table($valueClass, $stat);
	}

	function render_ranged_hit($char_data)
		{
			$rating = get_rating($char_data['level']);
			$valueRating = $char_data[PLAYER_FIELD_RANGED_HIT_RATING];
			$RatingPct   = $valueRating/get_rating_coefficient($rating, CR_HIT_RANGED);
			create_top_table();
			printf ("<tr><td class='head'>Hit Rating %d</td></tr>", $valueRating);
			printf ("<tr><td>Increases your ranged chance to hit a target of level %d by %.2f%%</td></tr>", $char_data['level'], $RatingPct);
			$penetration = $char_data[PLAYER_FIELD_MOD_TARGET_PHYSICAL_RESISTANCE];
			printf ("<tr><td><br>Enemy Armor reduced by %d</td></tr>", $penetration);
			create_end_table("normStat", $valueRating);
		}

	function render_ranged_crit($char_data)
		{
			$rating = get_rating($char_data['level']);
			$rangedCrit       = get_float_value($char_data[PLAYER_RANGED_CRIT_PERCENTAGE],2);
			$rangedCritRating = $char_data[PLAYER_FIELD_RANGED_CRIT_RATING];
			$critRatingPct    = $rangedCritRating/get_rating_coefficient($rating, CR_CRIT_RANGED);
			create_top_table();
			printf ("<tr><td class='head'>Crit Chance %.2f%%</td></tr>",$rangedCrit);
			printf ("<tr><td>Crit Rating %d (%.2f%% crit chance)</td></tr>", $rangedCritRating, $critRatingPct);
			create_end_table("normStat", $rangedCrit."%");
		}
	// ================================================
	// Defense panel
	//
	function render_defence($char_data)
		{
 			$rating = get_rating($char_data['level']);
 			$skill = get_skill(SKILL_DEFENCE,$char_data);

			$defRating = $char_data[PLAYER_FIELD_DEFENCE_RATING];
			$RatingAdd = $defRating/get_rating_coefficient($rating, CR_DEFENSE_SKILL);
			$Buff          = $skill[4]+$skill[5]+intval($RatingAdd);
			$effectiveStat = $skill[2]+$Buff;
			
			$defensePercent = DODGE_PARRY_BLOCK_PERCENT_PER_DEFENSE * ($effectiveStat - $char_data['level']*5);
			$defensePercent = max($defensePercent, 0);
			create_top_table();
			printf("<tr><td class='head'>Defense %d</td></tr>", $effectiveStat);
			printf("<tr><td>Defense Rating %d (+%d Defense)<br>", $defRating, $RatingAdd);
			printf("Increases chance to Dodge, Block and Parry by %.2f%%<br>",$defensePercent);
			printf("Decreases chance to be hit and critically hit by %.2f%%</td></tr>",$defensePercent);
			$valueClass = "normStat";
      			if ($Buff<0) $valueClass = "negStat";
 			else if ($Buff>0) $valueClass = "posStat";
 			create_end_table($valueClass, $effectiveStat);
		}

	function render_dodge($char_data)
		{
 			$rating = get_rating($char_data['level']);
 			$value       = get_float_value($char_data[PLAYER_DODGE_PERCENTAGE],2);
 			$valueRating = $char_data[PLAYER_FIELD_DODGE_RATING];
 			$RatingPct   = $valueRating/get_rating_coefficient($rating, CR_DODGE);
 			create_top_table();
 			printf ("<tr><td class='head'>Dodge Chance %.2f%%</td></tr>", $value);
 			printf ("<tr><td>Dodge rating of %d adds %.2f%% Dodge</td></tr>",$valueRating, $RatingPct);
 			create_end_table("normStat", $value."%");
		}

	function render_parry($char_data)
		{
 			$rating = get_rating($char_data['level']);
 			$value       = get_float_value($char_data[PLAYER_PARRY_PERCENTAGE],2);
 			$valueRating = $char_data[PLAYER_FIELD_PARRY_RATING];
 			$RatingPct   = $valueRating/get_rating_coefficient($rating, CR_PARRY);
 			create_top_table();
 			printf ("<tr><td class='head'>Parry Chance %.2f%%</td></tr>", $value);
 			printf ("<tr><td>Parry rating of %d adds %.2f%% Parry</td></tr>", $valueRating, $RatingPct);
 			create_end_table("normStat", $value."%");
		}

	function render_block($char_data)
		{
			$rating = get_rating($char_data['level']);
			$value       = get_float_value($char_data[PLAYER_BLOCK_PERCENTAGE],2);
			$valueRating = $char_data[PLAYER_FIELD_BLOCK_RATING];
			$RatingPct   = $valueRating/get_rating_coefficient($rating, CR_BLOCK);
			$block_damage = $char_data[PLAYER_SHIELD_BLOCK];
			create_top_table();
			printf ("<tr><td class='head'>Block Chance %.2f%%</td></tr>", $value);
			printf ("<tr><td>Block rating of %d adds  Block</td></tr>", $valueRating, $RatingPct);
			printf ("<tr><td>You block stops %d damage</td></tr>", $block_damage);
			create_end_table("normStat", $value."%");
		}

	function render_recilence($char_data)
		{
			$rating = get_rating($char_data['level']);
			$melee  = $char_data[PLAYER_FIELD_CRIT_TAKEN_MELEE_RATING];
			$ranged = $char_data[PLAYER_FIELD_CRIT_TAKEN_RANGED_RATING];
			$spell  = $char_data[PLAYER_FIELD_CRIT_TAKEN_SPELL_RATING];
			$minResilience = min($melee, $ranged, $spell);
			create_top_table();
			printf("<tr><td class='head'>Resilience %d</td></tr>", $minResilience);
			printf("<tr><td>Melee Resilience %d (%.2f%%)</td></tr>", $melee, $melee/get_rating_coefficient($rating,CR_CRIT_TAKEN_MELEE));
			printf("<tr><td>Ranged Resilience %d (%.2f%%)</td></tr>", $ranged, $ranged/get_rating_coefficient($rating,CR_CRIT_TAKEN_RANGED));
			printf("<tr><td>Spell Resilience %d (%.2f%%)</td></tr>", $spell, $spell/get_rating_coefficient($rating,CR_CRIT_TAKEN_SPELL));
			create_end_table("normStat", $minResilience);
		}
	// Данная функция показывает ауры из базы
	function show_player_auras_from_db($guid)
		{
			global $_SESSION;
			selectdb("characters_r".$_SESSION['realmd_id']);

 			$buffs  = db_query("SELECT `spell` FROM `character_aura` WHERE `guid`='".$guid."' GROUP BY `spell`");

			while ($aura = db_array($buffs))
				{
					echo"<br>";
     					show_spell($aura['spell'], 0, 'aura');
				}
		}
?>
