/*
MySQL Data Transfer
Source Host: localhost
Source Database: wcf
Target Host: localhost
Target Database: wcf
Date: 28.01.2012 16:35:23
*/

SET FOREIGN_KEY_CHECKS=0;
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
-- Records 
-- ----------------------------
INSERT INTO `wcf_chr_races` VALUES ('1', '12', '1', '4140', '49', '50', 'Hu', '7', '7', '15007', '1096', 'Human', '81', '0', 'Человек', '', 'Человек', 'NORMAL', 'PIERCINGS', 'NORMAL', '0');
INSERT INTO `wcf_chr_races` VALUES ('2', '12', '2', '4141', '51', '52', 'Or', '1', '7', '15007', '1096', 'Orc', '21', '1', 'Орк', '', 'Орк', 'NORMAL', 'PIERCINGS', 'NORMAL', '0');
INSERT INTO `wcf_chr_races` VALUES ('3', '12', '3', '4147', '53', '54', 'Dw', '7', '7', '15007', '1090', 'Dwarf', '41', '0', 'Дворф', '', 'Дворф', 'NORMAL', 'PIERCINGS', 'NORMAL', '0');
INSERT INTO `wcf_chr_races` VALUES ('4', '4', '4', '4145', '55', '56', 'Ni', '7', '7', '15007', '1096', 'NightElf', '61', '0', 'Ночной эльф', 'Ночная эльфийка', 'Ночной эльф', 'NORMAL', 'MARKINGS', 'NORMAL', '0');
INSERT INTO `wcf_chr_races` VALUES ('5', '12', '5', '4142', '57', '58', 'Sc', '1', '7', '15007', '1096', 'Scourge', '2', '1', 'Нежить', 'Нежить', '', 'FEATURES', 'FEATURES', 'NORMAL', '0');
INSERT INTO `wcf_chr_races` VALUES ('6', '14', '6', '4143', '59', '60', 'Ta', '1', '7', '15007', '1096', 'Tauren', '141', '1', 'Таурен', '', 'Таурен', 'NORMAL', 'HAIR', 'HORNS', '0');
INSERT INTO `wcf_chr_races` VALUES ('7', '12', '115', '4146', '1563', '1564', 'Gn', '7', '7', '15007', '1096', 'Gnome', '101', '0', 'Гном', '', 'Гном', 'NORMAL', 'EARRINGS', 'NORMAL', '0');
INSERT INTO `wcf_chr_races` VALUES ('8', '14', '116', '4144', '1478', '1479', 'Tr', '1', '7', '15007', '1096', 'Troll', '121', '1', 'Тролль', '', 'Тролль', 'TUSKS', 'TUSKS', 'NORMAL', '0');
INSERT INTO `wcf_chr_races` VALUES ('9', '1', '1', '0', '6894', '6895', 'Go', '7', '7', '15007', '1096', 'Goblin', '0', '2', 'Гоблин', '', 'Гоблин', 'NORMAL', 'NONE', 'NORMAL', '0');
INSERT INTO `wcf_chr_races` VALUES ('10', '12', '1610', '4142', '15476', '15475', 'Be', '1', '7', '15007', '1096', 'BloodElf', '162', '1', 'Эльф крови', 'Эльфийка крови', 'Эльф крови', 'NORMAL', 'EARRINGS', 'NORMAL', '1');
INSERT INTO `wcf_chr_races` VALUES ('11', '14', '1629', '4140', '16125', '16126', 'Dr', '7', '7', '15007', '1096', 'Draenei', '163', '0', 'Дреней', '', 'Дреней', 'NORMAL', 'HORNS', 'NORMAL', '1');
INSERT INTO `wcf_chr_races` VALUES ('12', '5', '1', '0', '16981', '16980', 'Fo', '7', '7', '15007', '1096', 'FelOrc', '0', '2', 'Орк Скверны', '', 'Орк Скверны', 'NORMAL', 'NORMAL', 'NORMAL', '0');
INSERT INTO `wcf_chr_races` VALUES ('13', '1', '1', '0', '17402', '17403', 'Na', '7', '7', '15007', '1096', 'Naga_', '0', '2', 'Нага', 'Нага', 'Наг', 'Normal', 'Normal', 'Normal', '0');
INSERT INTO `wcf_chr_races` VALUES ('14', '5', '1', '0', '17576', '17577', 'Br', '7', '7', '15007', '1096', 'Broken', '0', '2', 'Падший', 'Падшая', 'Падший', 'Normal', 'Normal', 'Normal', '0');
INSERT INTO `wcf_chr_races` VALUES ('15', '1', '1', '0', '17578', '17579', 'Sk', '7', '7', '15007', '1096', 'Skeleton', '0', '2', 'Скелет', '', 'Скелет', 'Normal', 'Normal', 'Normal', '0');
INSERT INTO `wcf_chr_races` VALUES ('16', '9', '1', '0', '21685', '21686', 'Vr', '7', '7', '15007', '1096', 'Vrykul', '0', '2', 'Врайкул', '', 'Врайкул', 'Normal', 'Normal', 'Normal', '0');
INSERT INTO `wcf_chr_races` VALUES ('17', '1', '1', '0', '21780', '21781', 'Tu', '7', '7', '15007', '1096', 'Tuskarr', '0', '2', 'Клыкарр', '', 'Клыкарр', 'Normal', 'Normal', 'Normal', '0');
INSERT INTO `wcf_chr_races` VALUES ('18', '15', '1', '0', '21963', '21964', 'Ft', '7', '7', '15007', '1096', 'ForestTroll', '0', '2', 'Лесной тролль', '', 'Лесной тролль', 'TUSKS', 'TUSKS', 'Normal', '0');
INSERT INTO `wcf_chr_races` VALUES ('19', '5', '1', '0', '26316', '26317', 'Wt', '7', '7', '15007', '1096', 'Taunka', '0', '2', 'Таунка', 'Таунка', 'Таунка', 'Normal', 'Normal', 'Normal', '0');
INSERT INTO `wcf_chr_races` VALUES ('20', '5', '1', '0', '26871', '26872', 'NS', '7', '7', '15007', '1096', 'NorthrendSkeleton', '0', '2', 'Нордскольский скелет', '', 'Нордскольский скелет', 'Normal', 'Normal', 'Normal', '0');
INSERT INTO `wcf_chr_races` VALUES ('21', '5', '1', '0', '26873', '26874', 'It', '7', '7', '15007', '1096', 'IceTroll', '0', '2', 'Ледяной тролль', '', 'Ледяной тролль', 'Normal', 'Normal', 'Normal', '0');
