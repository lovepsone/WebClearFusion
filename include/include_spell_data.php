<?php
include_once("functions.php");

$gSpellEffect = array(
'1'=>'Instakill',
'2'=>'School damage',
'3'=>'Dummy',
'4'=>'Portal teleport',
'5'=>'Teleport units',
'6'=>'Apply aura',
'7'=>'Environmental damage',
'8'=>'Power drain',
'9'=>'Health leech',
'10'=>'Heal',
'11'=>'Bind',
'12'=>'Portal',
'13'=>'Ritual base',
'14'=>'Ritual specialize',
'15'=>'Ritual activate portal',
'16'=>'Quest complete',
'17'=>'Weapon damage noschool',
'18'=>'Resurrect',
'19'=>'Add extra attacks',
'20'=>'Dodge',
'21'=>'Evade',
'22'=>'Parry',
'23'=>'Block',
'24'=>'Create item',
'25'=>'Weapon',
'26'=>'Defense',
'27'=>'Persistent area aura',
'28'=>'Summon',
'29'=>'Leap',
'30'=>'Energize',
'31'=>'Weapon percent damage',
'32'=>'Trigger missile',
'33'=>'Open lock',
'34'=>'Summon change item',
'35'=>'Apply area aura party',
'36'=>'Learn spell',
'37'=>'Spell defense',
'38'=>'Dispel',
'39'=>'Language',
'40'=>'Dual wield',
'41'=>'Jump',
'42'=>'Jump2',
'43'=>'Teleport units face caster',
'44'=>'Skill step',
'45'=>'Add honor',
'46'=>'Spawn',
'47'=>'Trade skill',
'48'=>'Stealth',
'49'=>'Detect',
'50'=>'Trans door',
'51'=>'Force critical hit',
'52'=>'Guarantee hit',
'53'=>'Enchant item',
'54'=>'Enchant item temporary',
'55'=>'Tamecreature',
'56'=>'Summon pet',
'57'=>'Learn pet spell',
'58'=>'Weapon damage',
'59'=>'Open lock item',
'60'=>'Proficiency',
'61'=>'Send event',
'62'=>'Power burn',
'63'=>'Threat',
'64'=>'Trigger spell',
'65'=>'Apply area aura raid',
'66'=>'Create mana gem',
'67'=>'Heal max health',
'68'=>'Interrupt cast',
'69'=>'Distract',
'70'=>'Pull',
'71'=>'Pickpocket',
'72'=>'Add farsight',
'73'=>'Untrain talents',
'74'=>'Apply glyph',
'75'=>'Heal mechanical',
'76'=>'Summon object wild',
'77'=>'Script effect',
'78'=>'Attack',
'79'=>'Sanctuary',
'80'=>'Add combo points',
'81'=>'Create house',
'82'=>'Bind sight',
'83'=>'Duel',
'84'=>'Stuck',
'85'=>'Summon player',
'86'=>'Activate object',
'87'=>'Wmo damage',
'88'=>'Wmo repair',
'89'=>'Wmo change',
'90'=>'Kill credit',
'91'=>'Threat all',
'92'=>'Enchant held item',
'93'=>'Summon phantasm',
'94'=>'Self resurrect',
'95'=>'Skinning',
'96'=>'Charge',
'97'=>'Summon all totems',
'98'=>'Knock back',
'99'=>'Disenchant',
'100'=>'Inebriate',
'101'=>'Feed pet',
'102'=>'Dismiss pet',
'103'=>'Reputation',
'104'=>'Summon object slot1',
'105'=>'Summon object slot2',
'106'=>'Summon object slot3',
'107'=>'Summon object slot4',
'108'=>'Dispel mechanic',
'109'=>'Summon dead pet',
'110'=>'Destroy all totems',
'111'=>'Durability damage',
'112'=>'SPELL_EFFECT_112',
'113'=>'Resurrect new',
'114'=>'Attack me',
'115'=>'Durability damage pct',
'116'=>'Skin player corpse',
'117'=>'Spirit heal',
'118'=>'Skill',
'119'=>'Apply area aura pet',
'120'=>'Teleport graveyard',
'121'=>'Normalized weapon dmg',
'122'=>'SPELL_EFFECT_122',
'123'=>'Send taxi',
'124'=>'Player pull',
'125'=>'Modify threat percent',
'126'=>'Steal beneficial buff',
'127'=>'Prospecting',
'128'=>'Apply area aura friend',
'129'=>'Apply area aura enemy',
'130'=>'Redirect threat',
'131'=>'SPELL_EFFECT_131',
'132'=>'Play music',
'133'=>'Unlearn specialization',
'134'=>'Kill credit',
'135'=>'Call pet',
'136'=>'Heal pct',
'137'=>'Energize pct',
'138'=>'Leap back',
'139'=>'Clear quest',
'140'=>'Force cast',
'141'=>'SPELL_EFFECT_141',
'142'=>'Trigger spell with value',
'143'=>'Apply area aura owner',
'144'=>'SPELL_EFFECT_144',
'145'=>'SPELL_EFFECT_145',
'146'=>'Activate rune',
'147'=>'Quest fail',
'148'=>'SPELL_EFFECT_148',
'149'=>'Charge 2',
'150'=>'SPELL_EFFECT_150',
'151'=>'Trigger spell 2',
'152'=>'SPELL_EFFECT_152',
'153'=>'Create pet',
'154'=>'Unused',
'155'=>'Titan grip',
'156'=>'Enchant item prismatic',
'157'=>'Create item 2',
'158'=>'Milling',
'159'=>'Allow rename pet',
'160'=>'SPELL_EFFECT_160',
'161'=>'Learn a Talent Specialization',
'162'=>'Activate Spec',
'163'=>'SPELL_EFFECT_163',
);

$gSpellAuraName = array(
'0'=>"NONE",
'1'=>"Bind Sight",
'2'=>"Mod Possess",
'3'=>"Periodic Damage",
'4'=>"Dummy",
'5'=>"Confuse",
'6'=>"Charm",
'7'=>"Fear",
'8'=>"Periodic Heal",
'9'=>"Mod Attack Speed",
'10'=>"Mod Threat",
'11'=>"Taunt",
'12'=>"Stun",
'13'=>"Mod Damage Done",
'14'=>"Mod Damage Taken",
'15'=>"DAMAGE_SHIELD",
'16'=>"Stealth",
'17'=>"Stealth Detection",
'18'=>"Invisibilily",
'19'=>"Invisibilily Detection",
'20'=>"Periodic Regenerate % of Total Health",
'21'=>"Periodic Regenerate % of Total Mana",
'22'=>"Mod Resistance",
'23'=>"Periodic Trigger Spell",
'24'=>"Perioic Energize",
'25'=>"Pacify",
'26'=>"Root",
'27'=>"Silence",
'28'=>"Chance to Reflect harmful Spells",
'29'=>"Mod Stat",
'30'=>"Mod Skill",
'31'=>"Increase Speed",
'32'=>"Increase Mounted Speed",
'33'=>"Decrease Speed",
'34'=>"Mod Maximum Health",
'35'=>"Mod Maximum Power",
'36'=>"Snapeshift",
'37'=>"Immune Effect ",
'38'=>"Immune State",
'39'=>"Immune School",
'40'=>"Immune Damage",
'41'=>"Immune Dispel",
'42'=>"Proc Trigger Spell",
'43'=>"Proc Trigger Damage",
'44'=>"Track Creatures",
'45'=>"Track Resources",
'46'=>"Mod Parry Skill",
'47'=>"Mod Parry %",
'48'=>"Mod Dodge Skill",
'49'=>"Mod Dodge %",
'50'=>"Mod Block Skill",
'51'=>"Mod Block %",
'52'=>"Mod Crit %",
'53'=>"Periodic Leech",
'54'=>"Mod Melee/Ranged Hit Chance",
'55'=>"Mod Spell Hit Chance",
'56'=>"Transform",
'57'=>"Mod Spell Crit Chance",
'58'=>"Increase Swim Speed",
'59'=>"Mod Melee/Spell Damage Versus",
'60'=>"Pacify and Silence",
'61'=>"Scale",
'62'=>"Periodic Health Funnel",
'63'=>"Periodic Power Funnel",
'64'=>"Periodic Power Leech",
'65'=>"Haste - Spells",
'66'=>"Feign Death",
'67'=>"Disarm",
'68'=>"Stalked",
'69'=>"Absorbs Damage for School",
'70'=>"EXTRA_ATTACKS",
'71'=>"Mod Spell Crit",
'72'=>"Mod Power Cost %",
'73'=>"Mod Power Cost",
'74'=>"Reflect Spells",
'75'=>"Laungage",
'76'=>"Far Sight",
'77'=>"Mechanic Immunity",
'78'=>"MOUNTED",
'79'=>"Mod Damage Done %",
'80'=>"MOD_PERCENT_STAT",
'81'=>"SPLIT_DAMAGE_PCT",
'82'=>"WATER_BREATHING",
'83'=>"MOD_BASE_RESISTANCE",
'84'=>"MOD_REGEN",
'85'=>"MOD_POWER_REGEN",
'86'=>"Create Item on Victim Death",
'87'=>"Mod Damage Taken %",
'88'=>"MOD_HEALTH_REGEN_PERCENT",
'89'=>"Periodic Damage % Total Health",
'90'=>"Mod Resist Chance",
'91'=>"Mod Detect Range",
'92'=>"PREVENTS_FLEEING",
'93'=>"MOD_UNATTACKABLE",
'94'=>"INTERRUPT_REGEN",
'95'=>"Ghost",
'96'=>"SPELL_MAGNET",
'97'=>"Mana Shield",
'98'=>"MOD_SKILL_TALENT",
'99'=>"Mod Melee Attack Power",
'100'=>"AURAS_VISIBLE",
'101'=>"MOD_RESISTANCE_PCT",
'102'=>"Mod Melee Attack Power Versus",
'103'=>"MOD_TOTAL_THREAT",
'104'=>"Water Walk",
'105'=>"FEATHER_FALL",
'106'=>"Hower",
'107'=>"Add Flat Modifier",
'108'=>"Add % Modifier",
'109'=>"Add Cast on Target Trigger",
'110'=>"Mod Power Regeneration %",
'111'=>"Redirect % Damage to Caster",
'112'=>"Override Class Scripts",
'113'=>"Mod Ranged Damage Taken",
'114'=>"Mod Ranged Damage Taken %",
'115'=>"Mod Healing Taken",                       //  ???
'116'=>"MOD_REGEN_DURING_COMBAT",
'117'=>"MOD_MECHANIC_RESISTANCE",
'118'=>"Mod Healing Taken %",
'119'=>"SHARE_PET_TRACKING",
'120'=>"UNTRACKABLE",
'121'=>"EMPATHY",
'122'=>"Mod Offhand Damage %",
'123'=>"Mod Target Resistance",
'124'=>"Mod Ranged Attack Power",
'125'=>"Mod Melee Damage Taken",
'126'=>"Mod Melee Damage Taken %",
'127'=>"RANGED_ATTACK_POWER_ATTACKER_BONUS",
'128'=>"MOD_POSSESS_PET",
'129'=>"MOD_SPEED_ALWAYS",
'130'=>"MOD_MOUNTED_SPEED_ALWAYS",
'131'=>"Mod Ranged Attack Power Versus",
'132'=>"Mod Maximum Energy %",
'133'=>"Mod Maximum Health %",
'134'=>"MOD_MANA_REGEN_INTERRUPT",
'135'=>"Mod Healing Done",
'136'=>"Mod Healing Done %",
'137'=>"Mod Total Stat %",
'138'=>"Haste Melee/Ranged",
'139'=>"Force Reaction",
'140'=>"Haste Ranged",
'141'=>"Haste Ranged (Ammo)",
'142'=>"MOD_BASE_RESISTANCE_PCT",
'143'=>"MOD_RESISTANCE_EXCLUSIVE",
'144'=>"Safe Fall",
'145'=>"Charisma",
'146'=>"Persuaded",
'147'=>"ADD_CREATURE_IMMUNITY",
'148'=>"Retain Combo Points",
'149'=>"RESIST_PUSHBACK",
'150'=>"MOD_SHIELD_BLOCKVALUE_PCT",
'151'=>"TRACK_STEALTHED",
'152'=>"MOD_DETECTED_RANGE",
'153'=>"SPLIT_DAMAGE_FLAT",
'154'=>"MOD_STEALTH_LEVEL",
'155'=>"MOD_WATER_BREATHING",
'156'=>"Mod Reputation Gained %",
'157'=>"PET_DAMAGE_MULTI",
'158'=>"MOD_SHIELD_BLOCKVALUE",
'159'=>"NO_PVP_CREDIT",
'160'=>"MOD_AOE_AVOIDANCE",
'161'=>"MOD_HEALTH_REGEN_IN_COMBAT",
'162'=>"POWER_BURN_MANA",
'163'=>"MOD_CRIT_DAMAGE_BONUS_MELEE",
'164'=>"164",
'165'=>"MELEE_ATTACK_POWER_ATTACKER_BONUS",
'166'=>"MOD_ATTACK_POWER_PCT",
'167'=>"MOD_RANGED_ATTACK_POWER_PCT",
'168'=>"Mod Damage Done Versus %",
'169'=>"Mod Crit Damage Versus %",
'170'=>"DETECT_AMORE",
'171'=>"MOD_SPEED_NOT_STACK",
'172'=>"MOD_MOUNTED_SPEED_NOT_STACK",
'173'=>"ALLOW_CHAMPION_SPELLS",
'174'=>"MOD_SPELL_DAMAGE_OF_STAT_PERCENT",
'175'=>"MOD_SPELL_HEALING_OF_STAT_PERCENT",
'176'=>"SPIRIT_OF_REDEMPTION",
'177'=>"AOE_CHARM",
'178'=>"Mod Debuff Resistance %",
'179'=>"MOD_ATTACKER_SPELL_CRIT_CHANCE",
'180'=>"Mod Spell Damage Versus",
'181'=>"Mod Spell Crit Damage Versus",
'182'=>"MOD_RESISTANCE_OF_INTELLECT_PERCENT",
'183'=>"MOD_CRITICAL_THREAT",
'184'=>"MOD_ATTACKER_MELEE_HIT_CHANCE",
'185'=>"MOD_ATTACKER_RANGED_HIT_CHANCE",
'186'=>"MOD_ATTACKER_SPELL_HIT_CHANCE",
'187'=>"MOD_ATTACKER_MELEE_CRIT_CHANCE",
'188'=>"MOD_ATTACKER_RANGED_CRIT_CHANCE",
'189'=>"Mod Rating",
'190'=>"Mod Faction Reputation Gain",
'191'=>"Limit Movement Speed",
'192'=>"Melee Haste",
'193'=>"Melee Slow",
'194'=>"MOD_DEPRICATED_1",
'195'=>"MOD_DEPRICATED_2",
'196'=>"Mod Cooldown",
'197'=>"MOD_ATTACKER_SPELL_AND_WEAPON_CRIT_CHANCE",
'198'=>"MOD_ALL_WEAPON_SKILLS",
'199'=>"MOD_INCREASES_SPELL_PCT_TO_HIT",
'200'=>"Mod Experience Earned %",
'201'=>"Fly",
'202'=>"IGNORE_COMBAT_RESULT",
'203'=>"Mod Melee Critical Damage Taken",
'204'=>"Mod Ranged Critical Damage Teken",
'205'=>"205",
'206'=>"MOD_SPEED_MOUNTED",
'207'=>"MOD_INCREASE_FLIGHT_SPEED",
'208'=>"MOD_SPEED_FLIGHT",
'209'=>"MOD_FLIGHT_SPEED_ALWAYS",
'210'=>"210",
'211'=>"MOD_FLIGHT_SPEED_NOT_STACK",
'212'=>"MOD_RANGED_ATTACK_POWER_OF_STAT_PERCENT",
'213'=>"Mod Rage from Damage Dealt %",
'214'=>"214",
'215'=>"ARENA_PREPARATION",
'216'=>"Haste Spells",
'217'=>"Slow Spells ???",
'218'=>"Haste Ranged",
'219'=>"MOD_MANA_REGEN_FROM_STAT",
'220'=>"MOD_RATING_FROM_STAT",
'221'=>"221",
'222'=>"222",
'223'=>"223",
'224'=>"224",
'225'=>"DUMMY_3",
'226'=>"Peridic Dummy",
'227'=>"227",
'228'=>"DETECT_STEALTH",
'229'=>"Mod AOE Damage Taken",
'230'=>"230",
'231'=>"231",
'232'=>"Mod Mechanic Duration",
'233'=>"233",
'234'=>"Mod Mechanic Duration not stack",
'235'=>"Mod Mechanic Dispel Resist",
'236'=>"236",
'237'=>"MOD_SPELL_DAMAGE_OF_ATTACK_POWER",
'238'=>"MOD_SPELL_HEALING_OF_ATTACK_POWER",
'239'=>"MOD_SCALE_2",
'240'=>"Mod Expertise",
'241'=>"FORCE_MOVE_FORWARD",
'242'=>"MOD_SPELL_DAMAGE_FROM_HEALING",
'243'=>"243",
'244'=>"COMPREHEND_LANGUAGE = 244",
'245'=>"MOD_DURATION_OF_MAGIC_EFFECTS",
'246'=>"MOD_DURATION_OF_EFFECTS_BY_DISPEL",
'247'=>"247",
'248'=>"MOD_COMBAT_RESULT_CHANCE",
'249'=>"Convert Rune",
'250'=>"MOD_INCREASE_HEALTH_2",
'251'=>"MOD_ENEMY_DODGE",
'252'=>"252",
'253'=>"MOD_BLOCK_CRIT_CHANCE",
'254'=>"MOD_DISARM_SHIELD",
'255'=>"MOD_MECHANIC_DAMAGE_TAKEN_PERCENT",
'256'=>"NO_REAGENT_USE",
'257'=>"MOD_TARGET_RESIST_BY_SPELL_CLASS",
'258'=>"258",
'259'=>"259",
'260'=>"260",
'261'=>"261",
'262'=>"262",
'263'=>"ALLOW_ONLY_ABILITY",
'264'=>"264",
'265'=>"265",
'266'=>"266",
'267'=>"267",
'268'=>"MOD_ATTACK_POWER_OF_STAT_PERCENT",
'269'=>"269",
'270'=>"270",
'271'=>"271",
'272'=>"272",
'273'=>"273",
'274'=>"274",
'275'=>"275",
'276'=>"276",
'277'=>"277",
'278'=>"MOD_DISARM_RANGED",
'279'=>"279",
'280'=>"MOD_TARGET_ARMOR_PCT",
'281'=>"MOD_HONOR_GAIN",
'282'=>"MOD_BASE_HEALTH_PCT",
'283'=>"MOD_HEALING_RECEIVED"
);

function getSpellFamilyNames()
{
  global $wDB;
  return $wDB->selectCol('-- CACHE: 1h
  SELECT `spell_family` AS ARRAY_KEY, `name` FROM `wowd_chr_classes`');
}

function getSpellFamilyName($i)
{
  $l = getSpellFamilyNames();
  return isset($l[$i]) ? $l[$i] : 'Family_'.$i;
}

function getRatingList($mask)
{
  global $gRatingNames;
  return getListFromArray_1($gRatingNames, $mask);
}

function getSpellRange($id)
{
  global $wDB;
  return $wDB->selectRow("-- CACHE: 1h
  SELECT * FROM `wowd_spell_range` WHERE `id` = ?d", $id);
}

function getRange($index)
{
  $range = getSpellRange($index);
  if ($range == 0)
    return "Err index $index";

  if ($range['minRange']==0 OR $range['minRange']==$range['maxRange'])
    return $range['maxRange'];
  return $range['minRange'].' - '.$range['maxRange'];
}

function getRangeText($index)
{
  $range =  getSpellRange($index);
  if ($range == 0)
    return "Err index $index";

  if ($range['minRange']==0 OR $range['minRange']==$range['maxRange'])
    return $range['maxRange'].' yds ('.$range['name'].')';
  return $range['minRange'].' - '.$range['maxRange'].' yds ('.$range['name'].')';
}

//*****************************************
// Totem Category
//*****************************************
function getTotemCategory($i, $as_ref=1)
{
  global $wDB;
  $gTotemCategory = $wDB->selectCol('-- CACHE: 1h
  SELECT `id` AS ARRAY_KEY, `name` FROM `wowd_totem_category`');

  $name = @$gTotemCategory[$i];
  if ($name == "")
      $name = "Category_$i";
  if ($as_ref)
      return "<a href=\"?s=i&totem=$i\">".$name."</a>";
  return $name;
}

function getRuneName($i)
{
  global $gRuneName;
  if (empty($gRuneName[$i]))
    return "Rune_".$i;
  return $gRuneName[$i];
}

function getTargetsList($mask)
{
  global $gTargetsList;
  return getListFromArray_1($gTargetsList, $mask);
}

//***************************************
// Form functions
//***************************************
function getFormNames()
{
    global $wDB;
	return $wDB->selectCol('-- CACHE: 1h
	SELECT `id` AS ARRAY_KEY, `name` FROM `wowd_spell_shapeshift`');
}

function getForm($i, $as_ref=1)
{
  $gSpellSnapeshiftForm = getFormNames();
  $name = @$gSpellSnapeshiftForm[$i];
  if ($name == "") $name = "Form_$i";
  if ($as_ref)
      return "<a href=\"?s=s&form=$i\">".$name."</a>";
  return $name;
}

function getAllowableForm($mask, $as_ref=1)
{
  $gSpellSnapeshiftForm = getFormNames();
  if ($as_ref)
      return getListFromArray_1($gSpellSnapeshiftForm, $mask, "?s=s&form=%d");
  return getListFromArray_1($gSpellSnapeshiftForm, $mask);
}

function getCategoryName($i, $as_ref=1)
{
  if ($as_ref)
    return "<a href=\"?s=s&cat=$i\">".$i."</a>";
  return "$i";
}

function getPowerTypeName($index)
{
  global $gSpellPowerType;
  if ($index >= 0 && $index < 5)
    return $gSpellPowerType[$index];
  return $gSpellPowerType[-1];
}

function getSpellEffectName($i)
{
  global $gSpellEffect;
  return $gSpellEffect[$i];
}

function getSpellAuraName($i)
{
  global $gSpellAuraName;
  return $gSpellAuraName[$i];
}

function getSpellModName($i)
{
  global $gSpellModsType;
  return $gSpellModsType[$i];
}

function getDispelName($i, $as_ref=1)
{
  global $wDB;
  $d = $wDB->selectCol('-- CACHE: 1h
  SELECT `id` AS ARRAY_KEY, `name` FROM `wowd_spell_dispel_type`');
  $name = isset($d[$i]) ? $d[$i] : 'Dispell_'.$i;
  if ($as_ref && $i)
      return "<a href=\"?s=s&dispel=$i\">$name</a>";
  return $name;
}

function getMechanicName($i, $as_ref=1)
{
  global $gSpellMechanic;
  $name = @$gSpellMechanic[$i];
  if (!$name) $name = "Mechanic_$i";
  if ($as_ref && $i)
      return "<a href=\"?s=s&mech=$i\">$name</a>";
  return $name;
}

function getLaungageName($i)
{
  global $wDB;
  $l = $wDB->selectCol('-- CACHE: 1h
  SELECT `id` AS ARRAY_KEY, `name` FROM `wowd_languages`');
  return isset($l[$i]) ? $l[$i] : 'Laungage_'.$i;
}

	function get_School($i)
		{
  			global $gSpellSchool;
  			$name = @$gSpellSchool[$i];
  			if ($name == "") { $name = "School_$i"; }
  			return $name;
		}

function getSpellSchool($mask)
{
  global $gSpellSchool;
  return getListFromArray_0($gSpellSchool, $mask);
}

function getSpellDamageClass($i)
{
  global $gDmgClass;
  return $gDmgClass[$i];
}

function getSpell($spell_id, $fields="*")
{
  global $wDB;
  return $wDB->selectRow("SELECT ".$fields." FROM `wowd_spell` WHERE `id` = ?d", $spell_id);
}

function getSpellName($spell, $as_ref=1)
{
  if ($spell)
  {
    $name = $spell['SpellName'];
    if ($as_ref)
        $name = "<a href=\"?spell=$spell[id]\">".$name."</a>";
    if ($spell['Rank']!="")
        $name.="<br><div class=srank>".$spell['Rank']."</div>";
    return $name;
  }
  return "No spell";
}

function getSpellNameFromId($spellId, $as_ref=1)
{
  if ($spell = getSpell($spellId))
    return getSpellName($spell, $as_ref);
  return "Err spell $spellId";
}

function getSpellDurationData($durationIndex)
{
  global $wDB;
  return $wDB->selectRow("-- CACHE: 1h
  SELECT * FROM `wowd_spell_duration` WHERE `id` = ?d", $durationIndex);
}

function getSpellDuration($spell)
{
  if ($spell['DurationIndex'])
   if ($spell_duration = getSpellDurationData($spell['DurationIndex']))
     return  $spell_duration['duration_1']/1000;
  return '';
}

function getSpellDurationText($spell)
{
  if ($spell['DurationIndex'])
  {
   if ($spell_duration = getSpellDurationData($spell['DurationIndex']))
   {
     if ($spell_duration['duration_1'] == -1)
         return "Unlimited";
//     if ($spell_duration['duration_1'] == ($spell_duration['duration_3'])
//         return getTimeText($spell_duration['duration_1']/1000);
     // TODO fix it
     return  getTimeText($spell_duration['duration_1']/1000);
   }
   else
     return "Err index ".$spell['DurationIndex'];
  }
  return "";
}

function getSpellRadius($id)
{
  global $wDB;
  return $wDB->selectRow("-- CACHE: 1h
  SELECT * FROM `wowd_spell_radius` WHERE `id` = ?d", $id);
}

function getRadius($index)
{
  if ($index==0) return '0';

  $radius = getSpellRadius($index);
  if (!$radius)
	return "Err index $index";

  if ($radius['radius_1']==0 OR $radius['radius_1']==$radius['radius_3'])
    return $radius['radius_3'];
  return $radius['radius_1']." - ".$radius['radius_3'];
}

function getRadiusText($index)
{
  return getRadius($index).' yds';
}

function getSpellCooldown($spell)
{
  if ($spell['RecoveryTime'] > $spell['CategoryRecoveryTime'])
    return $spell['RecoveryTime'];
  else
    return $spell['CategoryRecoveryTime'];
}

function getSpellCastTime($id)
{
  global $wDB;
  return $wDB->selectRow("-- CACHE: 1h
  SELECT * FROM `wowd_spell_cast_time` WHERE `id` = ?d", $id);
}

function getCastTimeText($spell)
{
  $cast_time = getSpellCastTime($spell['CastingTimeIndex']);
  $time = @$cast_time['time_1']/1000;
  if ($time)
    return $time." sec cast";
  else
    return "Instant Cast";
}

function getBasePointDesc($spell, $index)
{
  if (empty($spell))
      return;
  $s = $spell['EffectBasePoints_'.$index]+1;
  if ($spell['EffectDieSides_'.$index] > 1)
    $s.=" - ".abs($spell['EffectBasePoints_'.$index]+$spell['EffectDieSides_'.$index]);

  if ($spell['EffectRealPointsPerLevel_'.$index])
    $s.=" + lvl*".$spell['EffectRealPointsPerLevel_'.$index];
// ”величивает только макс рандомное значение
// if ($spell['EffectDicePerLevel_'.$index])
//   $s.=" + lvl*".$spell['EffectDicePerLevel_'.$index];
  if ($spell['EffectPointsPerComboPoint_'.$index])
    $s." + combo*".$spell['EffectPointsPerComboPoint_'.$index];
  return $s;
}

function getSpellData($spell)
{
  // Basepoints
  $s1 = abs($spell['EffectBasePoints_1']+1);
  $s2 = abs($spell['EffectBasePoints_2']+1);
  $s3 = abs($spell['EffectBasePoints_3']+1);
  if ($spell['EffectDieSides_1']>1) $s1.=" - ".abs($spell['EffectBasePoints_1']+$spell['EffectDieSides_1']);
  if ($spell['EffectDieSides_2']>1) $s2.=" - ".abs($spell['EffectBasePoints_2']+$spell['EffectDieSides_2']);
  if ($spell['EffectDieSides_3']>1) $s3.=" - ".abs($spell['EffectBasePoints_3']+$spell['EffectDieSides_3']);

  $d  = 0;
  if ($spell['DurationIndex'])
   if ($spell_duration = getSpellDurationData($spell['DurationIndex']))
     $d = $spell_duration['duration_1']/1000;

  // Tick duration
  $t1 = $spell['EffectAmplitude_1'] ? $spell['EffectAmplitude_1']/1000 : 5;
  $t2 = $spell['EffectAmplitude_1'] ? $spell['EffectAmplitude_2']/1000 : 5;
  $t3 = $spell['EffectAmplitude_1'] ? $spell['EffectAmplitude_3']/1000 : 5;

  // Points per tick
  $o1 = @intval($s1*$d/$t1);
  $o2 = @intval($s2*$d/$t2);
  $o3 = @intval($s3*$d/$t3);

  $spellData['t1']=$t1;
  $spellData['t2']=$t2;
  $spellData['t3']=$t3;
  $spellData['o1']=$o1;
  $spellData['o2']=$o2;
  $spellData['o3']=$o3;
  $spellData['s1']=$s1;
  $spellData['s2']=$s2;
  $spellData['s3']=$s3;
  $spellData['m1']=$s1;
  $spellData['m2']=$s2;
  $spellData['m3']=$s3;
  $spellData['x1']= $spell['EffectChainTarget_1'];
  $spellData['x2']= $spell['EffectChainTarget_2'];
  $spellData['x3']= $spell['EffectChainTarget_3'];
//  $spellData['i'] = $spell['MaxAffectedTargets'];
  $spellData['d'] = getTimeText($d);
  $spellData['d1']= getTimeText($d);
  $spellData['d2']= getTimeText($d);
  $spellData['d3']= getTimeText($d);
  $spellData['v'] = $spell['AffectedTargetLevel'];
  $spellData['u'] = $spell['StackAmount'];
  $spellData['a1']= getRadius($spell['EffectRadiusIndex_1']);
  $spellData['a2']= getRadius($spell['EffectRadiusIndex_2']);
  $spellData['a3']= getRadius($spell['EffectRadiusIndex_3']);
  $spellData['b1']= $spell['EffectPointsPerComboPoint_1'];
  $spellData['b2']= $spell['EffectPointsPerComboPoint_2'];
  $spellData['b3']= $spell['EffectPointsPerComboPoint_3'];
  $spellData['e'] = $spell['EffectMultipleValue_1'];
  $spellData['e1']= $spell['EffectMultipleValue_1'];
  $spellData['e2']= $spell['EffectMultipleValue_2'];
  $spellData['e3']= $spell['EffectMultipleValue_3'];
  $spellData['f1']= $spell['DmgMultiplier_1'];
  $spellData['f2']= $spell['DmgMultiplier_2'];
  $spellData['f3']= $spell['DmgMultiplier_3'];
  $spellData['q1']= $spell['EffectMiscValue_1'];
  $spellData['q2']= $spell['EffectMiscValue_2'];
  $spellData['q3']= $spell['EffectMiscValue_3'];
  $spellData['h'] = $spell['procChance'];
  $spellData['n'] = $spell['procCharges'];
  $spellData['z'] = "<home>";
  return $spellData;
}

function spellReplace($spell, $text)
{
    $letter = array('${','}');
    $values = array( '[',']');
    $text = str_replace($letter, $values, $text);

	$signs = array('+', '-', '/', '*', '%', '^');
    $data = $text;
	$pos = 0;
    $npos = 0;
	$str = '';
    $cacheSpellData=array(); // Spell data for spell
    $lastCount = 1;
	while (false!==($npos=strpos($data, '$', $pos)))
	{
		if ($npos!=$pos)
			$str .= substr($data, $pos, $npos-$pos);
		$pos = $npos+1;
		if ('$' == substr($data, $pos, 1))
		{
			$str .= '$';
			$pos++;
			continue;
		}

		if (!preg_match('/^((([+\-\/*])(\d+);)?(\d*)(?:([lg].*?:.*?);|(\w\d*)))/', substr($data, $pos), $result))
			continue;
		$pos += strlen($result[0]);
		$op = $result[3];
		$oparg = $result[4];
		$lookup = $result[5]? $result[5]:$spell['id'];
		$var = $result[6] ? $result[6]:$result[7];
		if (!$var)
			continue;
        // l - размер последней величины == 1 ? 0 : 1
        if ($var[0]=='l')
        {
            $select = explode(':', substr($var, 1));
            $str.=@$select[$lastCount==1 ? 0:1];
        }
        // g - пол персонжа
        else if ($var[0]=='g')
        {
            $select = explode(':', substr($var, 1));
            $str.=$select[0];
        }
        else
        {
            $spellData = @$cacheSpellData[$lookup];
            if ($spellData == 0)
            {
                if ($lookup == $spell['id']) $cacheSpellData[$lookup] = getSpellData($spell);
                else                         $cacheSpellData[$lookup] = getSpellData(getSpell($lookup));
                $spellData = @$cacheSpellData[$lookup];
            }
            if ($spellData && $base = @$spellData[strtolower($var)])
            {
                if ($op && is_numeric($oparg) && is_numeric($base))
                {
                     $equation = $base.$op.$oparg;
                     eval("\$base = $equation;");
		        }
                if (is_numeric($base)) $lastCount = $base;
            }
            else
                $base = $var;
            $str.=$base;
        }
	}
	$str.= substr($data, $pos);
	$str = @preg_replace_callback("/\[.+[+\-\/*\d]\]/", 'my_relpace', $str);
//    $letter = array('*','/','+','-');
//    $values = array(' * ', ' / ',' + ',' - ');
//    $str = str_replace($letter, $values, $str);

	return($str);//."<br /><br />".$text;
}

function my_relpace($matches)
{
    $text = str_replace( array('[',']'), array('', ''), $matches[0]);
    eval("\$text = abs(".$text.");");
    return intval($text);
}

function getSpellDesc($spell)
{
  if ($spell['Description']=="") return $spell['SpellName'];
  return spellReplace($spell, $spell['Description']);
}

function getSpellBuff($spell)
{
  if ($spell['ToolTip']=="") return "";
  return spellReplace($spell, $spell['ToolTip']);
}

function get_spell_details($spell_id)
{
  $spell=getSpell($spell_id);
  if ($spell)
    return getSpellDesc($spell);
  return "Spell id - $spell_id";
}

function getSpellCostText($spell)
{
  // «аполн€ем стоимость заклинани€
  $powerType = getPowerTypeName($spell['powerType']);
  $powerCost = "";
  if ($spell['AttributesEx'] & 2)
    $powerCost = "Uses 100% ".$powerType;
  else
  {
    if ($spell['ManaCostPercentage'])
      $powerCost = $spell['ManaCostPercentage']."% of base";
    else if ($spell['manaCost'])
      $powerCost = $spell['manaCost'];
    if ($powerCost)
    {
      $powerCost.= " ".$powerType;
      if ($spell['manaPerSecond'])
        $powerCost.= " plus ".$spell['manaPerSecond']." per sec";
    }
  }
  return $powerCost;
}
?>
