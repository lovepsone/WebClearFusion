/*
MySQL Data Transfer
Source Host: localhost
Source Database: wcf
Target Host: localhost
Target Database: wcf
Date: 28.01.2012 16:35:29
*/

SET FOREIGN_KEY_CHECKS=0;
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
-- Records 
-- ----------------------------
INSERT INTO `wcf_chr_classes` VALUES ('1', '0', '1', '1', 'Воин', '', 'Воин', 'WARRIOR', '4', '50', '0', '0');
INSERT INTO `wcf_chr_classes` VALUES ('2', '0', '0', '1', 'Паладин', '', 'Паладин', 'PALADIN', '10', '58', '0', '0');
INSERT INTO `wcf_chr_classes` VALUES ('3', '1', '0', '1', 'Охотник', 'Охотница', 'Охотник', 'HUNTER', '9', '22', '0', '0');
INSERT INTO `wcf_chr_classes` VALUES ('4', '1', '3', '1', 'Разбойник', 'Разбойница', 'Разбойник', 'ROGUE', '8', '2', '0', '0');
INSERT INTO `wcf_chr_classes` VALUES ('5', '0', '0', '1', 'Жрец', 'Жрица', 'Жрец', 'PRIEST', '6', '2', '0', '0');
INSERT INTO `wcf_chr_classes` VALUES ('6', '9', '6', '1', 'Рыцарь смерти', '', 'Рыцарь смерти', 'DEATHKNIGHT', '15', '122', '165', '2');
INSERT INTO `wcf_chr_classes` VALUES ('7', '1', '0', '1', 'Шаман', 'Шаманка', 'Шаман', 'SHAMAN', '11', '26', '0', '0');
INSERT INTO `wcf_chr_classes` VALUES ('8', '0', '0', '1', 'Маг', '', 'Маг', 'MAGE', '3', '2', '0', '0');
INSERT INTO `wcf_chr_classes` VALUES ('9', '0', '0', '240', 'Чернокнижник', 'Чернокнижница', 'Чернокнижник', 'WARLOCK', '5', '6', '0', '0');
INSERT INTO `wcf_chr_classes` VALUES ('11', '0', '0', '1', 'Друид', '', 'Друид', 'DRUID', '7', '10', '0', '0');
