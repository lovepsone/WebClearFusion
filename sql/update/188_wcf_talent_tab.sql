/*
MySQL Data Transfer
Source Host: localhost
Source Database: wcf
Target Host: localhost
Target Database: wcf
Date: 31.01.2012 16:25:52
*/

SET FOREIGN_KEY_CHECKS=0;
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
-- Records 
-- ----------------------------
INSERT INTO `wcf_talent_tab` VALUES ('81', 'Тайная магия', '125', '2047', '128', '0', '0', 'MageArcane');
INSERT INTO `wcf_talent_tab` VALUES ('161', 'Оружие', '514', '2047', '1', '0', '0', 'WarriorArms');
INSERT INTO `wcf_talent_tab` VALUES ('182', 'Ликвидация', '514', '2047', '8', '0', '0', 'RogueAssassination');
INSERT INTO `wcf_talent_tab` VALUES ('201', 'Послушание', '685', '2047', '16', '0', '0', 'PriestDiscipline');
INSERT INTO `wcf_talent_tab` VALUES ('261', 'Стихии', '62', '2047', '64', '0', '0', 'ShamanElementalCombat');
INSERT INTO `wcf_talent_tab` VALUES ('283', 'Баланс', '225', '2047', '1024', '0', '0', 'DruidBalance');
INSERT INTO `wcf_talent_tab` VALUES ('302', 'Колдовство', '88', '2047', '256', '0', '0', 'WarlockCurses');
INSERT INTO `wcf_talent_tab` VALUES ('361', 'Повелитель зверей', '255', '2047', '4', '0', '0', 'HunterBeastMastery');
INSERT INTO `wcf_talent_tab` VALUES ('382', 'Свет', '70', '2047', '2', '0', '0', 'PaladinHoly');
INSERT INTO `wcf_talent_tab` VALUES ('398', 'Кровь', '2636', '4294707199', '32', '0', '0', 'DeathKnightBlood');
INSERT INTO `wcf_talent_tab` VALUES ('409', 'Упорство', '1559', '0', '0', '2', '0', 'HunterPetTenacity');
INSERT INTO `wcf_talent_tab` VALUES ('410', 'Свирепость', '496', '0', '0', '1', '0', 'HunterPetFerocity');
INSERT INTO `wcf_talent_tab` VALUES ('411', 'Хитрость', '2223', '0', '0', '4', '0', 'HunterPetCunning');
INSERT INTO `wcf_talent_tab` VALUES ('41', 'Огонь', '183', '2047', '128', '0', '1', 'MageFire');
INSERT INTO `wcf_talent_tab` VALUES ('164', 'Неистовство', '561', '2047', '1', '0', '1', 'WarriorFury');
INSERT INTO `wcf_talent_tab` VALUES ('181', 'Бой', '243', '2047', '8', '0', '1', 'RogueCombat');
INSERT INTO `wcf_talent_tab` VALUES ('202', 'Свет', '2873', '2047', '16', '0', '1', 'PriestHoly');
INSERT INTO `wcf_talent_tab` VALUES ('263', 'Совершенствование', '19', '2047', '64', '0', '1', 'ShamanEnhancement');
INSERT INTO `wcf_talent_tab` VALUES ('281', 'Сила зверя', '107', '2047', '1024', '0', '1', 'DruidFeralCombat');
INSERT INTO `wcf_talent_tab` VALUES ('303', 'Демонология', '90', '2047', '256', '0', '1', 'WarlockSummoning');
INSERT INTO `wcf_talent_tab` VALUES ('363', 'Стрельба', '126', '2047', '4', '0', '1', 'HunterMarksmanship');
INSERT INTO `wcf_talent_tab` VALUES ('383', 'Защита', '291', '2047', '2', '0', '1', 'PaladinProtection');
INSERT INTO `wcf_talent_tab` VALUES ('399', 'Лед', '2632', '2047', '32', '0', '1', 'DeathKnightFrost');
INSERT INTO `wcf_talent_tab` VALUES ('61', 'Лед', '188', '2047', '128', '0', '2', 'MageFrost');
INSERT INTO `wcf_talent_tab` VALUES ('163', 'Защита', '1463', '2047', '1', '0', '2', 'WarriorProtection');
INSERT INTO `wcf_talent_tab` VALUES ('183', 'Скрытность', '250', '2047', '8', '0', '2', 'RogueSubtlety');
INSERT INTO `wcf_talent_tab` VALUES ('203', 'Тьма', '234', '2047', '16', '0', '2', 'PriestShadow');
INSERT INTO `wcf_talent_tab` VALUES ('262', 'Исцеление', '13', '2047', '64', '0', '2', 'ShamanRestoration');
INSERT INTO `wcf_talent_tab` VALUES ('282', 'Исцеление', '962', '2047', '1024', '0', '2', 'DruidRestoration');
INSERT INTO `wcf_talent_tab` VALUES ('301', 'Разрушение', '547', '2047', '256', '0', '2', 'WarlockDestruction');
INSERT INTO `wcf_talent_tab` VALUES ('362', 'Выживание', '257', '2047', '4', '0', '2', 'HunterSurvival');
INSERT INTO `wcf_talent_tab` VALUES ('381', 'Воздаяние', '555', '2047', '2', '0', '2', 'PaladinCombat');
INSERT INTO `wcf_talent_tab` VALUES ('400', 'Нечестивость', '2633', '2047', '32', '0', '2', 'DeathKnightUnholy');
