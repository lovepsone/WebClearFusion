/*
MySQL Data Transfer
Source Host: localhost
Source Database: wcf
Target Host: localhost
Target Database: wcf
Date: 14.03.2012 16:02:37
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for wcf_achievement
-- ----------------------------
DROP TABLE IF EXISTS `wcf_achievement`;
CREATE TABLE `wcf_achievement` (
  `id` int(10) unsigned NOT NULL,
  `factionFlag` int(11) NOT NULL,
  `mapID` int(11) NOT NULL,
  `parentAchievement` int(10) unsigned NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `categoryId` int(10) unsigned NOT NULL,
  `points` int(10) unsigned NOT NULL,
  `OrderInCategory` int(10) unsigned NOT NULL,
  `flags` int(10) unsigned NOT NULL,
  `iconId` int(10) unsigned NOT NULL,
  `titleReward` text NOT NULL,
  `count` int(10) unsigned NOT NULL,
  `refAchievement` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for wcf_achievement_category
-- ----------------------------
DROP TABLE IF EXISTS `wcf_achievement_category`;
CREATE TABLE `wcf_achievement_category` (
  `id` int(10) unsigned NOT NULL,
  `parent` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sortOrder` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for wcf_achievement_criteria
-- ----------------------------
DROP TABLE IF EXISTS `wcf_achievement_criteria`;
CREATE TABLE `wcf_achievement_criteria` (
  `id` int(10) unsigned NOT NULL,
  `referredAchievement` int(11) NOT NULL,
  `requiredType` int(10) unsigned NOT NULL,
  `data` int(10) unsigned NOT NULL,
  `value` int(10) unsigned NOT NULL,
  `additional_type_1` int(10) unsigned NOT NULL,
  `additional_value_1` int(10) unsigned NOT NULL,
  `additional_type_2` int(10) unsigned NOT NULL,
  `additional_value_2` int(10) unsigned NOT NULL,
  `name` text NOT NULL,
  `completionFlag` int(10) unsigned NOT NULL,
  `groupFlag` int(10) unsigned NOT NULL,
  `unk1` int(10) unsigned NOT NULL,
  `timeLimit` int(10) unsigned NOT NULL,
  `order` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`,`referredAchievement`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for wcf_chr_classes
-- ----------------------------
DROP TABLE IF EXISTS `wcf_chr_classes`;
CREATE TABLE `wcf_chr_classes` (
  `id` int(10) unsigned NOT NULL,
  `unk_1` int(10) unsigned NOT NULL,
  `power_type` int(10) unsigned NOT NULL,
  `unk_3` int(10) unsigned NOT NULL,
  `name` text NOT NULL,
  `female_name` text NOT NULL,
  `neutral_name` text NOT NULL,
  `internal_name` text NOT NULL,
  `spell_family` int(10) unsigned NOT NULL,
  `unk_9` int(10) unsigned NOT NULL,
  `cinematic_id` int(10) unsigned NOT NULL,
  `expansion` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for wcf_chr_races
-- ----------------------------
DROP TABLE IF EXISTS `wcf_chr_races`;
CREATE TABLE `wcf_chr_races` (
  `id` int(10) unsigned NOT NULL,
  `unk_1` int(10) unsigned NOT NULL,
  `facton_id` int(10) unsigned NOT NULL,
  `unk_4` int(10) unsigned NOT NULL,
  `model_m` int(10) unsigned NOT NULL,
  `model_f` int(10) unsigned NOT NULL,
  `short_name` text NOT NULL,
  `unk_8` int(10) unsigned NOT NULL,
  `unk_9` int(10) unsigned NOT NULL,
  `unk_10` int(10) unsigned NOT NULL,
  `unk_11` int(10) unsigned NOT NULL,
  `internal_name` text NOT NULL,
  `cinematic_id` int(10) unsigned NOT NULL,
  `team` int(10) unsigned NOT NULL,
  `name` text NOT NULL,
  `female_name` text NOT NULL,
  `neutral_name` text NOT NULL,
  `unk_18` text NOT NULL,
  `unk_19` text NOT NULL,
  `unk_20` text NOT NULL,
  `expansion` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for wcf_creature_family
-- ----------------------------
DROP TABLE IF EXISTS `wcf_creature_family`;
CREATE TABLE `wcf_creature_family` (
  `id` int(10) unsigned NOT NULL,
  `minScale` float NOT NULL,
  `minScaleLevel` int(10) unsigned NOT NULL,
  `maxScale` float NOT NULL,
  `maxScaleLevel` int(10) unsigned NOT NULL,
  `skill_line_1` int(10) unsigned NOT NULL,
  `skill_line_2` int(10) unsigned NOT NULL,
  `pet_food_mask` int(10) unsigned NOT NULL,
  `pet_talent_type` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `name` text NOT NULL,
  `icon` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for wcf_creature_spells
-- ----------------------------
DROP TABLE IF EXISTS `wcf_creature_spells`;
CREATE TABLE `wcf_creature_spells` (
  `entry` int(11) unsigned NOT NULL default '0',
  `spell` int(11) unsigned NOT NULL default '0',
  `castFlags` int(11) unsigned NOT NULL default '0',
  `target_flags` int(11) unsigned NOT NULL default '0',
  `target_id` int(11) unsigned NOT NULL default '0',
  `Spell_AI` int(11) unsigned NOT NULL default '0',
  `special` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (`entry`,`spell`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

-- ----------------------------
-- Table structure for wcf_creature_type
-- ----------------------------
DROP TABLE IF EXISTS `wcf_creature_type`;
CREATE TABLE `wcf_creature_type` (
  `id` int(10) unsigned NOT NULL,
  `name` text NOT NULL,
  `no_expirience` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for wcf_faction
-- ----------------------------
DROP TABLE IF EXISTS `wcf_faction`;
CREATE TABLE `wcf_faction` (
  `id` int(1) NOT NULL default '0',
  `reputationListID` int(11) NOT NULL,
  `BaseRepRaceMask_0` int(10) unsigned NOT NULL,
  `BaseRepRaceMask_1` int(10) unsigned NOT NULL,
  `BaseRepRaceMask_2` int(10) unsigned NOT NULL,
  `BaseRepRaceMask_3` int(10) unsigned NOT NULL,
  `BaseRepClassMask_0` int(10) unsigned NOT NULL,
  `BaseRepClassMask_1` int(10) unsigned NOT NULL,
  `BaseRepClassMask_2` int(10) unsigned NOT NULL,
  `BaseRepClassMask_3` int(10) unsigned NOT NULL,
  `BaseRepValue_0` int(11) NOT NULL,
  `BaseRepValue_1` int(11) NOT NULL,
  `BaseRepValue_2` int(11) NOT NULL,
  `BaseRepValue_3` int(11) NOT NULL,
  `ReputationFlags_0` int(10) unsigned NOT NULL,
  `ReputationFlags_1` int(10) unsigned NOT NULL,
  `ReputationFlags_2` int(10) unsigned NOT NULL,
  `ReputationFlags_3` int(10) unsigned NOT NULL,
  `team` int(11) NOT NULL,
  `name` varchar(48) NOT NULL,
  `details` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for wcf_faction_template
-- ----------------------------
DROP TABLE IF EXISTS `wcf_faction_template`;
CREATE TABLE `wcf_faction_template` (
  `id` int(10) unsigned NOT NULL default '0',
  `faction` int(10) unsigned NOT NULL default '0',
  `fightSupport` int(10) unsigned default NULL,
  `ourMask` int(10) unsigned default NULL,
  `friendlyMask` int(10) unsigned default NULL,
  `hostileMask` int(10) unsigned default NULL,
  `enemyFaction1` int(10) unsigned default NULL,
  `enemyFaction2` int(10) unsigned default NULL,
  `enemyFaction3` int(10) unsigned default NULL,
  `enemyFaction4` int(10) unsigned default NULL,
  `friendFaction1` int(10) unsigned default NULL,
  `friendFaction2` int(10) unsigned default NULL,
  `friendFaction3` int(10) unsigned default NULL,
  `friendFaction4` int(10) unsigned default NULL,
  PRIMARY KEY  (`id`,`faction`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for wcf_gemproperties
-- ----------------------------
DROP TABLE IF EXISTS `wcf_gemproperties`;
CREATE TABLE `wcf_gemproperties` (
  `id` int(10) unsigned NOT NULL default '0',
  `spellitemenchantement` int(10) unsigned default NULL,
  `unk_1` int(11) default NULL,
  `unk_2` int(11) default NULL,
  `color` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for wcf_glyphproperties
-- ----------------------------
DROP TABLE IF EXISTS `wcf_glyphproperties`;
CREATE TABLE `wcf_glyphproperties` (
  `id` int(10) unsigned NOT NULL,
  `SpellId` int(10) unsigned NOT NULL,
  `TypeFlags` int(10) unsigned NOT NULL,
  `Unk1` int(10) unsigned default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- ----------------------------
-- Table structure for wcf_item_enchantment
-- ----------------------------
DROP TABLE IF EXISTS `wcf_item_enchantment`;
CREATE TABLE `wcf_item_enchantment` (
  `id` int(10) unsigned NOT NULL,
  `charges` int(10) unsigned NOT NULL,
  `display_type_1` int(11) NOT NULL,
  `display_type_2` int(11) NOT NULL,
  `display_type_3` int(11) NOT NULL,
  `amount_1` int(11) NOT NULL,
  `amount_2` int(11) NOT NULL,
  `amount_3` int(11) NOT NULL,
  `amount1_1` int(11) NOT NULL,
  `amount1_2` int(11) NOT NULL,
  `amount1_3` int(11) NOT NULL,
  `spellid_1` int(10) unsigned NOT NULL,
  `spellid_2` int(10) unsigned NOT NULL,
  `spellid_3` int(10) unsigned NOT NULL,
  `description` text NOT NULL,
  `aura_id` int(10) unsigned NOT NULL,
  `slot` int(10) unsigned NOT NULL,
  `GemID` int(10) unsigned NOT NULL,
  `EnchantmentCondition` int(10) unsigned NOT NULL,
  `requiredSkill` int(10) unsigned NOT NULL,
  `requiredSkillRank` int(10) unsigned NOT NULL,
  `requiredLevel` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for wcf_item_ex_cost
-- ----------------------------
DROP TABLE IF EXISTS `wcf_item_ex_cost`;
CREATE TABLE `wcf_item_ex_cost` (
  `id` int(11) NOT NULL,
  `reqhonorpoints` int(11) NOT NULL,
  `reqarenapoints` int(11) NOT NULL,
  `reqitem_1` int(11) NOT NULL,
  `reqitem_2` int(11) NOT NULL,
  `reqitem_3` int(11) NOT NULL,
  `reqitem_4` int(11) NOT NULL,
  `reqitem_5` int(11) NOT NULL,
  `reqitemcount_1` int(11) NOT NULL,
  `reqitemcount_2` int(11) NOT NULL,
  `reqitemcount_3` int(11) NOT NULL,
  `reqitemcount_4` int(11) NOT NULL,
  `reqitemcount_5` int(11) NOT NULL,
  `reqpersonalarenarating` int(11) NOT NULL,
  `unk_14` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `idx_id` (`id`),
  KEY `idx_item1` (`reqitem_1`),
  KEY `idx_item2` (`reqitem_2`),
  KEY `idx_item3` (`reqitem_3`),
  KEY `idx_item4` (`reqitem_4`),
  KEY `idx_item5` (`reqitem_5`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for wcf_item_random_propety
-- ----------------------------
DROP TABLE IF EXISTS `wcf_item_random_propety`;
CREATE TABLE `wcf_item_random_propety` (
  `id` int(11) NOT NULL,
  `EnchantID_1` int(11) NOT NULL,
  `EnchantID_2` int(11) NOT NULL,
  `EnchantID_3` int(11) NOT NULL,
  `EnchantID_4` int(11) NOT NULL,
  `EnchantID_5` int(11) NOT NULL,
  `EnchantID_6` int(11) NOT NULL,
  `name` char(32) character set cp1251 NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for wcf_item_random_suffix
-- ----------------------------
DROP TABLE IF EXISTS `wcf_item_random_suffix`;
CREATE TABLE `wcf_item_random_suffix` (
  `id` int(10) unsigned NOT NULL,
  `name` text NOT NULL,
  `comment` text NOT NULL,
  `EnchantID_1` int(10) unsigned NOT NULL,
  `EnchantID_2` int(10) unsigned NOT NULL,
  `EnchantID_3` int(10) unsigned NOT NULL,
  `EnchantID_4` int(10) unsigned NOT NULL,
  `EnchantID_5` int(10) unsigned NOT NULL,
  `Prefix_1` int(10) unsigned NOT NULL,
  `Prefix_2` int(10) unsigned NOT NULL,
  `Prefix_3` int(10) unsigned NOT NULL,
  `Prefix_4` int(10) unsigned NOT NULL,
  `Prefix_5` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for wcf_itemicon
-- ----------------------------
DROP TABLE IF EXISTS `wcf_itemicon`;
CREATE TABLE `wcf_itemicon` (
  `id` int(10) unsigned NOT NULL,
  `name` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for wcf_itemset
-- ----------------------------
DROP TABLE IF EXISTS `wcf_itemset`;
CREATE TABLE `wcf_itemset` (
  `id` int(10) unsigned NOT NULL default '0',
  `name` char(255) default NULL,
  `item_1` int(10) unsigned default NULL,
  `item_2` int(10) unsigned default NULL,
  `item_3` int(10) unsigned default NULL,
  `item_4` int(10) unsigned default NULL,
  `item_5` int(10) unsigned default NULL,
  `item_6` int(10) unsigned default NULL,
  `item_7` int(10) unsigned default NULL,
  `item_8` int(10) unsigned default NULL,
  `item_9` int(10) unsigned default NULL,
  `item_10` int(10) unsigned default NULL,
  `item_11` int(10) unsigned default NULL,
  `item_12` int(10) unsigned default NULL,
  `item_13` int(10) unsigned default NULL,
  `item_14` int(10) unsigned default NULL,
  `item_15` int(10) unsigned default NULL,
  `item_16` int(10) unsigned default NULL,
  `item_17` int(10) unsigned default NULL,
  `spell_1` int(10) unsigned default NULL,
  `spell_2` int(10) unsigned default NULL,
  `spell_3` int(10) unsigned default NULL,
  `spell_4` int(10) unsigned default NULL,
  `spell_5` int(10) unsigned default NULL,
  `spell_6` int(10) unsigned default NULL,
  `spell_7` int(10) unsigned default NULL,
  `spell_8` int(10) unsigned default NULL,
  `count_1` int(10) unsigned default NULL,
  `count_2` int(10) unsigned default NULL,
  `count_3` int(10) unsigned default NULL,
  `count_4` int(10) unsigned default NULL,
  `count_5` int(10) unsigned default NULL,
  `count_6` int(10) unsigned default NULL,
  `count_7` int(10) unsigned default NULL,
  `count_8` int(10) unsigned default NULL,
  `req_skill` int(10) unsigned default NULL,
  `req_skill_value` int(10) unsigned default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for wcf_languages
-- ----------------------------
DROP TABLE IF EXISTS `wcf_languages`;
CREATE TABLE `wcf_languages` (
  `id` int(10) unsigned NOT NULL,
  `name` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for wcf_lock
-- ----------------------------
DROP TABLE IF EXISTS `wcf_lock`;
CREATE TABLE `wcf_lock` (
  `id` int(10) unsigned NOT NULL,
  `keytype_0` int(10) unsigned NOT NULL,
  `keytype_1` int(10) unsigned NOT NULL,
  `keytype_2` int(10) unsigned NOT NULL,
  `keytype_3` int(10) unsigned NOT NULL,
  `keytype_4` int(10) unsigned NOT NULL,
  `keytype_5` int(10) unsigned NOT NULL,
  `keytype_6` int(10) unsigned NOT NULL,
  `keytype_7` int(10) unsigned NOT NULL,
  `key_0` int(10) unsigned NOT NULL,
  `key_1` int(10) unsigned NOT NULL,
  `key_2` int(10) unsigned NOT NULL,
  `key_3` int(10) unsigned NOT NULL,
  `key_4` int(10) unsigned NOT NULL,
  `key_5` int(10) unsigned NOT NULL,
  `key_6` int(10) unsigned NOT NULL,
  `key_7` int(10) unsigned NOT NULL,
  `reqskill_0` int(10) unsigned NOT NULL,
  `reqskill_1` int(10) unsigned NOT NULL,
  `reqskill_2` int(10) unsigned NOT NULL,
  `reqskill_3` int(10) unsigned NOT NULL,
  `reqskill_4` int(10) unsigned NOT NULL,
  `reqskill_5` int(10) unsigned NOT NULL,
  `reqskill_6` int(10) unsigned NOT NULL,
  `reqskill_7` int(10) unsigned NOT NULL,
  `action_0` int(10) unsigned NOT NULL,
  `action_1` int(10) unsigned NOT NULL,
  `action_2` int(10) unsigned NOT NULL,
  `action_3` int(10) unsigned NOT NULL,
  `action_4` int(10) unsigned NOT NULL,
  `action_5` int(10) unsigned NOT NULL,
  `action_6` int(10) unsigned NOT NULL,
  `action_7` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for wcf_lock_type
-- ----------------------------
DROP TABLE IF EXISTS `wcf_lock_type`;
CREATE TABLE `wcf_lock_type` (
  `id` int(10) unsigned NOT NULL,
  `name` text NOT NULL,
  `help` text NOT NULL,
  `tip` text NOT NULL,
  `cursor` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for wcf_map
-- ----------------------------
DROP TABLE IF EXISTS `wcf_map`;
CREATE TABLE `wcf_map` (
  `id` int(10) unsigned NOT NULL,
  `local_name` text NOT NULL,
  `map_type` int(10) unsigned NOT NULL,
  `map_flags` int(10) unsigned NOT NULL,
  `is_pvp` int(10) unsigned NOT NULL,
  `name` text NOT NULL,
  `linked_zone` int(10) unsigned NOT NULL,
  `hordeIntro` text NOT NULL,
  `allianceIntro` text NOT NULL,
  `multimap_id` int(10) unsigned NOT NULL,
  `BattlefieldMapIconScale` float NOT NULL,
  `entrance_map` int(11) NOT NULL,
  `entrance_x` float NOT NULL,
  `entrance_y` float NOT NULL,
  `timeOfDayOverride` int(11) NOT NULL,
  `addon` int(10) unsigned NOT NULL,
  `unk` int(10) unsigned NOT NULL,
  `maxPlayers` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for wcf_quest_info
-- ----------------------------
DROP TABLE IF EXISTS `wcf_quest_info`;
CREATE TABLE `wcf_quest_info` (
  `id` int(10) unsigned NOT NULL,
  `name` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for wcf_quest_sort
-- ----------------------------
DROP TABLE IF EXISTS `wcf_quest_sort`;
CREATE TABLE `wcf_quest_sort` (
  `id` int(10) unsigned NOT NULL,
  `name` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for wcf_questxp
-- ----------------------------
DROP TABLE IF EXISTS `wcf_questxp`;
CREATE TABLE `wcf_questxp` (
  `id` int(10) NOT NULL default '0',
  `Field1` int(10) NOT NULL default '0',
  `Field2` int(10) NOT NULL default '0',
  `Field3` int(10) NOT NULL default '0',
  `Field4` int(10) NOT NULL default '0',
  `Field5` int(10) NOT NULL default '0',
  `Field6` int(10) NOT NULL default '0',
  `Field7` int(10) NOT NULL default '0',
  `Field8` int(10) NOT NULL default '0',
  `Field9` int(10) NOT NULL default '0',
  `Field10` int(10) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Export of questxp.dbc';

-- ----------------------------
-- Table structure for wcf_random_property_points
-- ----------------------------
DROP TABLE IF EXISTS `wcf_random_property_points`;
CREATE TABLE `wcf_random_property_points` (
  `itemlevel` int(10) unsigned NOT NULL,
  `epic_0` int(10) unsigned NOT NULL,
  `epic_1` int(10) unsigned NOT NULL,
  `epic_2` int(10) unsigned NOT NULL,
  `epic_3` int(10) unsigned NOT NULL,
  `epic_4` int(10) unsigned NOT NULL,
  `rare_0` int(10) unsigned NOT NULL,
  `rare_1` int(10) unsigned NOT NULL,
  `rare_2` int(10) unsigned NOT NULL,
  `rare_3` int(10) unsigned NOT NULL,
  `rare_4` int(10) unsigned NOT NULL,
  `uncommon_0` int(10) unsigned NOT NULL,
  `uncommon_1` int(10) unsigned NOT NULL,
  `uncommon_2` int(10) unsigned NOT NULL,
  `uncommon_3` int(10) unsigned NOT NULL,
  `uncommon_4` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`itemlevel`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for wcf_rating
-- ----------------------------
DROP TABLE IF EXISTS `wcf_rating`;
CREATE TABLE `wcf_rating` (
  `level` int(10) unsigned NOT NULL,
  `MC_Warrior` float NOT NULL,
  `MC_Paladin` float NOT NULL,
  `MC_Hunter` float NOT NULL,
  `MC_Rogue` float NOT NULL,
  `MC_Priest` float NOT NULL,
  `MC_DeathKnight` float NOT NULL,
  `MC_Shaman` float NOT NULL,
  `MC_Mage` float NOT NULL,
  `MC_Warlock` float NOT NULL,
  `MC_10` float NOT NULL,
  `MC_Druid` float NOT NULL,
  `SC_Warrior` float NOT NULL,
  `SC_Paladin` float NOT NULL,
  `SC_Hunter` float NOT NULL,
  `SC_Rogue` float NOT NULL,
  `SC_Priest` float NOT NULL,
  `SC_DeathKnight` float NOT NULL,
  `SC_Shaman` float NOT NULL,
  `SC_Mage` float NOT NULL,
  `SC_Warlock` float NOT NULL,
  `SC_10` float NOT NULL,
  `SC_Druid` float NOT NULL,
  `CR_WEAPON_SKILL` float NOT NULL,
  `CR_DEFENSE_SKILL` float NOT NULL,
  `CR_DODGE` float NOT NULL,
  `CR_PARRY` float NOT NULL,
  `CR_BLOCK` float NOT NULL,
  `CR_HIT_MELEE` float NOT NULL,
  `CR_HIT_RANGED` float NOT NULL,
  `CR_HIT_SPELL` float NOT NULL,
  `CR_CRIT_MELEE` float NOT NULL,
  `CR_CRIT_RANGED` float NOT NULL,
  `CR_CRIT_SPELL` float NOT NULL,
  `CR_HIT_TAKEN_MELEE` float NOT NULL,
  `CR_HIT_TAKEN_RANGED` float NOT NULL,
  `CR_HIT_TAKEN_SPELL` float NOT NULL,
  `CR_CRIT_TAKEN_MELEE` float NOT NULL,
  `CR_CRIT_TAKEN_RANGED` float NOT NULL,
  `CR_CRIT_TAKEN_SPELL` float NOT NULL,
  `CR_HASTE_MELEE` float NOT NULL,
  `CR_HASTE_RANGED` float NOT NULL,
  `CR_HASTE_SPELL` float NOT NULL,
  `CR_WEAPON_SKILL_MAINHAND` float NOT NULL,
  `CR_WEAPON_SKILL_OFFHAND` float NOT NULL,
  `CR_WEAPON_SKILL_RANGED` float NOT NULL,
  `CR_EXPERTISE` float NOT NULL,
  PRIMARY KEY  (`level`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for wcf_scaling_stat_distribution
-- ----------------------------
DROP TABLE IF EXISTS `wcf_scaling_stat_distribution`;
CREATE TABLE `wcf_scaling_stat_distribution` (
  `id` int(10) unsigned NOT NULL,
  `statmod_1` int(11) NOT NULL,
  `statmod_2` int(11) NOT NULL,
  `statmod_3` int(11) NOT NULL,
  `statmod_4` int(11) NOT NULL,
  `statmod_5` int(11) NOT NULL,
  `statmod_6` int(11) NOT NULL,
  `statmod_7` int(11) NOT NULL,
  `statmod_8` int(11) NOT NULL,
  `statmod_9` int(11) NOT NULL,
  `statmod_10` int(11) NOT NULL,
  `modifier_1` int(10) unsigned NOT NULL,
  `modifier_2` int(10) unsigned NOT NULL,
  `modifier_3` int(10) unsigned NOT NULL,
  `modifier_4` int(10) unsigned NOT NULL,
  `modifier_5` int(10) unsigned NOT NULL,
  `modifier_6` int(10) unsigned NOT NULL,
  `modifier_7` int(10) unsigned NOT NULL,
  `modifier_8` int(10) unsigned NOT NULL,
  `modifier_9` int(10) unsigned NOT NULL,
  `modifier_10` int(10) unsigned NOT NULL,
  `maxlevel` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for wcf_scaling_stat_values
-- ----------------------------
DROP TABLE IF EXISTS `wcf_scaling_stat_values`;
CREATE TABLE `wcf_scaling_stat_values` (
  `id` int(10) unsigned NOT NULL,
  `level` int(10) unsigned NOT NULL,
  `multiplier_1` int(11) NOT NULL,
  `multiplier_2` int(11) NOT NULL,
  `multiplier_3` int(11) NOT NULL,
  `multiplier_4` int(11) NOT NULL,
  `multiplier_5` int(11) NOT NULL,
  `multiplier_6` int(11) NOT NULL,
  `multiplier_7` int(11) NOT NULL,
  `multiplier_8` int(11) NOT NULL,
  `multiplier_9` int(11) NOT NULL,
  `multiplier_10` int(11) NOT NULL,
  `multiplier_11` int(11) NOT NULL,
  `multiplier_12` int(11) NOT NULL,
  `multiplier_13` int(11) NOT NULL,
  `multiplier_14` int(11) NOT NULL,
  `multiplier_15` int(11) NOT NULL,
  `multiplier_16` int(11) NOT NULL,
  `multiplier_17` int(11) NOT NULL,
  `multiplier_18` int(11) NOT NULL,
  `multiplier_19` int(11) NOT NULL,
  `multiplier_20` int(11) NOT NULL,
  `multiplier_21` int(11) NOT NULL,
  `multiplier_22` int(11) NOT NULL,
  PRIMARY KEY  (`level`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for wcf_skill_line
-- ----------------------------
DROP TABLE IF EXISTS `wcf_skill_line`;
CREATE TABLE `wcf_skill_line` (
  `id` int(10) unsigned NOT NULL default '0',
  `Category` int(10) unsigned default NULL,
  `Unk1` int(10) unsigned default NULL,
  `Name` text,
  `Description` text,
  `iconId` int(10) unsigned default NULL,
  `alternateVerb` text,
  `canLink` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for wcf_skill_line_ability
-- ----------------------------
DROP TABLE IF EXISTS `wcf_skill_line_ability`;
CREATE TABLE `wcf_skill_line_ability` (
  `id` int(11) unsigned NOT NULL default '0',
  `skillId` int(10) unsigned default NULL,
  `spellId` int(10) unsigned default NULL,
  `RaceMask` int(10) unsigned default NULL,
  `ClassMask` int(10) unsigned default NULL,
  `RaceMaskNot` int(10) unsigned default NULL,
  `ClassMaskNot` int(10) unsigned default NULL,
  `req_skill_value` int(10) unsigned default NULL,
  `forward_spellid` int(10) unsigned default NULL,
  `LearnOnGetSkill` int(10) unsigned default NULL,
  `max_value` int(10) unsigned default NULL,
  `min_value` int(10) unsigned default NULL,
  `characterPoints_1` int(10) unsigned default NULL,
  `characterPoints_2` int(10) unsigned default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for wcf_skill_line_category
-- ----------------------------
DROP TABLE IF EXISTS `wcf_skill_line_category`;
CREATE TABLE `wcf_skill_line_category` (
  `id` int(10) unsigned NOT NULL,
  `name` text NOT NULL,
  `order` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for wcf_skill_race_class_info
-- ----------------------------
DROP TABLE IF EXISTS `wcf_skill_race_class_info`;
CREATE TABLE `wcf_skill_race_class_info` (
  `Id` int(11) NOT NULL,
  `skillId` int(11) default NULL,
  `raceMask` int(11) default NULL,
  `classMask` int(11) default NULL,
  `flags` int(11) default NULL,
  `reqLevel` int(11) default NULL,
  `skillTiers` int(11) default NULL,
  `skillCost` int(11) default NULL,
  PRIMARY KEY  (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for wcf_spell
-- ----------------------------
DROP TABLE IF EXISTS `wcf_spell`;
CREATE TABLE `wcf_spell` (
  `id` int(10) unsigned NOT NULL default '0',
  `Category` int(10) unsigned default NULL,
  `Dispel` int(10) unsigned default NULL,
  `Mechanic` int(10) unsigned default NULL,
  `Attributes` int(10) unsigned default NULL,
  `AttributesEx` int(10) unsigned default NULL,
  `AttributesEx2` int(10) unsigned default NULL,
  `AttributesEx3` int(10) unsigned default NULL,
  `AttributesEx4` int(10) unsigned default NULL,
  `AttributesEx5` int(10) unsigned default NULL,
  `AttributesEx6` int(10) unsigned default NULL,
  `unk_320_1` int(10) unsigned default NULL,
  `Stances` bigint(20) unsigned default NULL,
  `StancesNot` bigint(20) unsigned default NULL,
  `Targets` int(10) unsigned default NULL,
  `TargetCreatureType` int(10) unsigned default NULL,
  `RequiresSpellFocus` int(10) unsigned default NULL,
  `FacingCasterFlags` int(10) unsigned default NULL,
  `CasterAuraState` int(10) unsigned default NULL,
  `TargetAuraState` int(10) unsigned default NULL,
  `CasterAuraStateNot` int(10) unsigned default NULL,
  `TargetAuraStateNot` int(10) unsigned default NULL,
  `casterAuraSpell` int(10) unsigned default NULL,
  `targetAuraSpell` int(10) unsigned default NULL,
  `excludeCasterAuraSpell` int(10) unsigned default NULL,
  `excludeTargetAuraSpell` int(10) unsigned default NULL,
  `CastingTimeIndex` int(10) unsigned default NULL,
  `RecoveryTime` int(10) unsigned default NULL,
  `CategoryRecoveryTime` int(10) unsigned default NULL,
  `InterruptFlags` int(10) unsigned default NULL,
  `AuraInterruptFlags` int(10) unsigned default NULL,
  `ChannelInterruptFlags` int(10) unsigned default NULL,
  `procFlags` int(10) unsigned default NULL,
  `procChance` int(10) unsigned default NULL,
  `procCharges` int(10) unsigned default NULL,
  `maxLevel` int(10) unsigned default NULL,
  `baseLevel` int(10) unsigned default NULL,
  `spellLevel` int(10) unsigned default NULL,
  `DurationIndex` int(10) unsigned default NULL,
  `powerType` int(10) unsigned default NULL,
  `manaCost` int(10) unsigned default NULL,
  `manaCostPerlevel` int(10) unsigned default NULL,
  `manaPerSecond` int(10) unsigned default NULL,
  `manaPerSecondPerLevel` int(10) unsigned default NULL,
  `rangeIndex` int(10) unsigned default NULL,
  `StackAmount` int(10) unsigned default NULL,
  `Totem_1` int(10) unsigned default NULL,
  `Totem_2` int(10) unsigned default NULL,
  `Reagent_1` int(10) default NULL,
  `Reagent_2` int(10) default NULL,
  `Reagent_3` int(10) default NULL,
  `Reagent_4` int(10) default NULL,
  `Reagent_5` int(10) default NULL,
  `Reagent_6` int(10) default NULL,
  `Reagent_7` int(10) default NULL,
  `Reagent_8` int(10) default NULL,
  `ReagentCount_1` int(10) unsigned default NULL,
  `ReagentCount_2` int(10) unsigned default NULL,
  `ReagentCount_3` int(10) unsigned default NULL,
  `ReagentCount_4` int(10) unsigned default NULL,
  `ReagentCount_5` int(10) unsigned default NULL,
  `ReagentCount_6` int(10) unsigned default NULL,
  `ReagentCount_7` int(10) unsigned default NULL,
  `ReagentCount_8` int(10) unsigned default NULL,
  `EquippedItemClass` int(10) default NULL,
  `EquippedItemSubClassMask` int(10) default NULL,
  `EquippedItemInventoryTypeMask` int(10) default NULL,
  `Effect_1` int(10) unsigned default NULL,
  `Effect_2` int(10) unsigned default NULL,
  `Effect_3` int(10) unsigned default NULL,
  `EffectDieSides_1` int(10) default NULL,
  `EffectDieSides_2` int(10) default NULL,
  `EffectDieSides_3` int(10) default NULL,
  `EffectRealPointsPerLevel_1` float default NULL,
  `EffectRealPointsPerLevel_2` float default NULL,
  `EffectRealPointsPerLevel_3` float default NULL,
  `EffectBasePoints_1` int(10) default NULL,
  `EffectBasePoints_2` int(10) default NULL,
  `EffectBasePoints_3` int(10) default NULL,
  `EffectMechanic_1` int(10) unsigned default NULL,
  `EffectMechanic_2` int(10) unsigned default NULL,
  `EffectMechanic_3` int(10) unsigned default NULL,
  `EffectImplicitTargetA_1` int(10) unsigned default NULL,
  `EffectImplicitTargetA_2` int(10) unsigned default NULL,
  `EffectImplicitTargetA_3` int(10) unsigned default NULL,
  `EffectImplicitTargetB_1` int(10) unsigned default NULL,
  `EffectImplicitTargetB_2` int(10) unsigned default NULL,
  `EffectImplicitTargetB_3` int(10) unsigned default NULL,
  `EffectRadiusIndex_1` int(10) unsigned default NULL,
  `EffectRadiusIndex_2` int(10) unsigned default NULL,
  `EffectRadiusIndex_3` int(10) unsigned default NULL,
  `EffectApplyAuraName_1` int(10) unsigned default NULL,
  `EffectApplyAuraName_2` int(10) unsigned default NULL,
  `EffectApplyAuraName_3` int(10) unsigned default NULL,
  `EffectAmplitude_1` int(10) unsigned default NULL,
  `EffectAmplitude_2` int(10) unsigned default NULL,
  `EffectAmplitude_3` int(10) unsigned default NULL,
  `EffectMultipleValue_1` float default NULL,
  `EffectMultipleValue_2` float default NULL,
  `EffectMultipleValue_3` float default NULL,
  `EffectChainTarget_1` int(10) unsigned default NULL,
  `EffectChainTarget_2` int(10) unsigned default NULL,
  `EffectChainTarget_3` int(10) unsigned default NULL,
  `EffectItemType_1` int(10) unsigned default NULL,
  `EffectItemType_2` int(10) unsigned default NULL,
  `EffectItemType_3` int(10) unsigned default NULL,
  `EffectMiscValue_1` int(10) default NULL,
  `EffectMiscValue_2` int(10) default NULL,
  `EffectMiscValue_3` int(10) default NULL,
  `EffectMiscValue2_1` int(10) default NULL,
  `EffectMiscValue2_2` int(10) default NULL,
  `EffectMiscValue2_3` int(10) default NULL,
  `EffectTriggerSpell_1` int(10) unsigned default NULL,
  `EffectTriggerSpell_2` int(10) unsigned default NULL,
  `EffectTriggerSpell_3` int(10) unsigned default NULL,
  `EffectPointsPerComboPoint_1` float default NULL,
  `EffectPointsPerComboPoint_2` float default NULL,
  `EffectPointsPerComboPoint_3` float default NULL,
  `EffectSpellClassMaskA_1` int(10) unsigned default NULL,
  `EffectSpellClassMaskA_2` int(10) unsigned default NULL,
  `EffectSpellClassMaskA_3` int(10) unsigned default NULL,
  `EffectSpellClassMaskB_1` int(10) unsigned default NULL,
  `EffectSpellClassMaskB_2` int(10) unsigned default NULL,
  `EffectSpellClassMaskB_3` int(10) unsigned default NULL,
  `EffectSpellClassMaskC_1` int(10) unsigned default NULL,
  `EffectSpellClassMaskC_2` int(10) unsigned default NULL,
  `EffectSpellClassMaskC_3` int(10) unsigned default NULL,
  `SpellVisual_1` int(10) unsigned default NULL,
  `SpellVisual_2` int(10) unsigned default NULL,
  `SpellIconID` int(10) unsigned default NULL,
  `activeIconID` int(10) unsigned default NULL,
  `spellPriority` int(10) unsigned default NULL,
  `SpellName` text,
  `Rank` text,
  `Description` text,
  `ToolTip` text,
  `ManaCostPercentage` int(10) unsigned default NULL,
  `StartRecoveryCategory` int(10) unsigned default NULL,
  `StartRecoveryTime` int(10) unsigned default NULL,
  `MaxTargetLevel` int(10) unsigned default NULL,
  `SpellFamilyName` int(10) unsigned default NULL,
  `SpellFamilyFlags_1` int(10) unsigned default NULL,
  `SpellFamilyFlags_2` int(10) unsigned default NULL,
  `SpellFamilyFlags_3` int(10) unsigned default NULL,
  `AffectedTargetLevel` int(10) unsigned default NULL,
  `DmgClass` int(10) unsigned default NULL,
  `PreventionType` int(10) unsigned default NULL,
  `DmgMultiplier_1` float default NULL,
  `DmgMultiplier_2` float default NULL,
  `DmgMultiplier_3` float default NULL,
  `MinFactionId` int(10) unsigned default NULL,
  `MinReputation` int(10) unsigned default NULL,
  `RequiredAuraVision` int(10) unsigned default NULL,
  `TotemCategory_1` int(10) unsigned default NULL,
  `TotemCategory_2` int(10) unsigned default NULL,
  `AreaGroupId` int(10) default NULL,
  `SchoolMask` int(10) unsigned default NULL,
  `runeCostID` int(10) unsigned default NULL,
  `SpellDifficultyId` int(10) unsigned default NULL,
  PRIMARY KEY  (`id`),
  KEY `idx_reagent1` (`Reagent_1`),
  KEY `idx_reagent2` (`Reagent_2`),
  KEY `idx_reagent3` (`Reagent_3`),
  KEY `idx_reagent4` (`Reagent_4`),
  KEY `idx_reagent5` (`Reagent_5`),
  KEY `idx_reagent6` (`Reagent_6`),
  KEY `idx_reagent7` (`Reagent_7`),
  KEY `idx_reagent8` (`Reagent_8`),
  KEY `idx_effect1` (`Effect_1`),
  KEY `idx_effect2` (`Effect_2`),
  KEY `idx_effect3` (`Effect_3`),
  KEY `idx_aura1` (`EffectApplyAuraName_1`),
  KEY `idx_aura2` (`EffectApplyAuraName_2`),
  KEY `idx_aura3` (`EffectApplyAuraName_3`),
  KEY `idx_item1` (`EffectItemType_1`),
  KEY `idx_item2` (`EffectItemType_2`),
  KEY `idx_item3` (`EffectItemType_3`),
  KEY `idx_misc1` (`EffectMiscValue_1`),
  KEY `idx_misc2` (`EffectMiscValue_2`),
  KEY `idx_misc3` (`EffectMiscValue_3`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for wcf_spell_cast_time
-- ----------------------------
DROP TABLE IF EXISTS `wcf_spell_cast_time`;
CREATE TABLE `wcf_spell_cast_time` (
  `id` int(10) unsigned NOT NULL,
  `time_1` int(11) NOT NULL,
  `time_2` int(11) NOT NULL,
  `time_3` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for wcf_spell_dispel_type
-- ----------------------------
DROP TABLE IF EXISTS `wcf_spell_dispel_type`;
CREATE TABLE `wcf_spell_dispel_type` (
  `id` int(10) unsigned NOT NULL,
  `name` text NOT NULL,
  `dispellMask` int(10) unsigned NOT NULL,
  `unk1` int(10) unsigned NOT NULL,
  `unk2` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for wcf_spell_duration
-- ----------------------------
DROP TABLE IF EXISTS `wcf_spell_duration`;
CREATE TABLE `wcf_spell_duration` (
  `id` int(10) unsigned NOT NULL default '0',
  `duration_1` int(11) default NULL,
  `duration_2` int(11) default NULL,
  `duration_3` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for wcf_spell_radius
-- ----------------------------
DROP TABLE IF EXISTS `wcf_spell_radius`;
CREATE TABLE `wcf_spell_radius` (
  `id` int(10) unsigned NOT NULL,
  `radius_1` float NOT NULL,
  `radius_2` float NOT NULL,
  `radius_3` float NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for wcf_spell_range
-- ----------------------------
DROP TABLE IF EXISTS `wcf_spell_range`;
CREATE TABLE `wcf_spell_range` (
  `id` int(10) unsigned NOT NULL,
  `minRange` float NOT NULL,
  `minRangeFriendly` float NOT NULL,
  `maxRange` float NOT NULL,
  `maxRangeFriendly` float NOT NULL,
  `unk` int(10) unsigned NOT NULL,
  `name` text NOT NULL,
  `short_name` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for wcf_spell_shapeshift
-- ----------------------------
DROP TABLE IF EXISTS `wcf_spell_shapeshift`;
CREATE TABLE `wcf_spell_shapeshift` (
  `id` int(10) unsigned NOT NULL,
  `buttonPosition` int(11) NOT NULL,
  `name` text NOT NULL,
  `flags` int(10) unsigned NOT NULL,
  `creatureType` int(11) NOT NULL,
  `unk1` int(10) unsigned NOT NULL,
  `attackSpeed` int(10) unsigned NOT NULL,
  `modelID` int(10) unsigned NOT NULL,
  `unk2` int(10) unsigned NOT NULL,
  `unk3` int(10) unsigned NOT NULL,
  `unk4` int(10) unsigned NOT NULL,
  `unk5` int(10) unsigned NOT NULL,
  `unk6` int(10) unsigned NOT NULL,
  `unk7` int(10) unsigned NOT NULL,
  `unk8` int(10) unsigned NOT NULL,
  `unk9` int(10) unsigned NOT NULL,
  `unk10` int(10) unsigned NOT NULL,
  `unk11` int(10) unsigned NOT NULL,
  `unk12` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for wcf_spellfocus
-- ----------------------------
DROP TABLE IF EXISTS `wcf_spellfocus`;
CREATE TABLE `wcf_spellfocus` (
  `id` int(10) unsigned NOT NULL,
  `name` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for wcf_spellicon
-- ----------------------------
DROP TABLE IF EXISTS `wcf_spellicon`;
CREATE TABLE `wcf_spellicon` (
  `id` int(10) NOT NULL default '0',
  `name` char(48) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for wcf_talent_tab
-- ----------------------------
DROP TABLE IF EXISTS `wcf_talent_tab`;
CREATE TABLE `wcf_talent_tab` (
  `id` int(10) unsigned NOT NULL,
  `name` text NOT NULL,
  `icon_id` int(10) unsigned NOT NULL,
  `unk` int(10) unsigned NOT NULL,
  `class_mask` int(10) unsigned NOT NULL,
  `pet_mask` int(10) unsigned NOT NULL,
  `tab` int(10) unsigned NOT NULL,
  `bg_image` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for wcf_talents
-- ----------------------------
DROP TABLE IF EXISTS `wcf_talents`;
CREATE TABLE `wcf_talents` (
  `TalentID` int(11) NOT NULL,
  `TalentTab` int(11) NOT NULL,
  `Row` int(11) default NULL,
  `Col` int(11) default NULL,
  `Rank_1` int(11) default NULL,
  `Rank_2` int(11) default NULL,
  `Rank_3` int(11) default NULL,
  `Rank_4` int(11) default NULL,
  `Rank_5` int(11) default NULL,
  `Unk_1` int(11) default NULL,
  `Unk_2` int(11) default NULL,
  `Unk_3` int(11) default NULL,
  `Unk_4` int(11) default NULL,
  `DependsOn` int(11) default NULL,
  `Unk_5` int(11) default NULL,
  `Unk_6` int(11) default NULL,
  `DependsOnRank` int(11) default NULL,
  `Unk_7` int(11) default NULL,
  `Unk_8` int(11) default NULL,
  `Unk_9` int(11) default NULL,
  `Unk_10` int(11) default NULL,
  `petflag1` int(11) unsigned default NULL,
  `petflag2` int(11) unsigned default NULL,
  PRIMARY KEY  (`TalentID`,`TalentTab`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for wcf_teamcontributionpoints
-- ----------------------------
DROP TABLE IF EXISTS `wcf_teamcontributionpoints`;
CREATE TABLE `wcf_teamcontributionpoints` (
  `id` bigint(20) NOT NULL,
  `Field1` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for wcf_totem_category
-- ----------------------------
DROP TABLE IF EXISTS `wcf_totem_category`;
CREATE TABLE `wcf_totem_category` (
  `id` int(10) unsigned NOT NULL,
  `name` text NOT NULL,
  `categoryType` int(10) unsigned NOT NULL,
  `categoryMask` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for wcf_zones
-- ----------------------------
DROP TABLE IF EXISTS `wcf_zones`;
CREATE TABLE `wcf_zones` (
  `id` int(11) NOT NULL default '0',
  `map_id` int(11) NOT NULL default '0',
  `zone_id` int(11) NOT NULL,
  `flag_id` int(11) default NULL,
  `name` varchar(255) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
