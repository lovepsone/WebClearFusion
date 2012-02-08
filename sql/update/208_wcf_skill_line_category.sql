/*
MySQL Data Transfer
Source Host: localhost
Source Database: wowd
Target Host: localhost
Target Database: wowd
Date: 08.02.2012 14:44:42
*/

SET FOREIGN_KEY_CHECKS=0;
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
-- Records 
-- ----------------------------
INSERT INTO `wcf_skill_line_category` VALUES ('5', 'Характеристики', '1');
INSERT INTO `wcf_skill_line_category` VALUES ('6', 'Оружейные навыки', '5');
INSERT INTO `wcf_skill_line_category` VALUES ('7', 'Классовые навыки', '2');
INSERT INTO `wcf_skill_line_category` VALUES ('8', 'Доспехи', '6');
INSERT INTO `wcf_skill_line_category` VALUES ('9', 'Вспомогательные навыки', '4');
INSERT INTO `wcf_skill_line_category` VALUES ('10', 'Языки', '7');
INSERT INTO `wcf_skill_line_category` VALUES ('11', 'Профессии', '3');
INSERT INTO `wcf_skill_line_category` VALUES ('12', 'Не отображается', '8');
