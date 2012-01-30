/*
MySQL Data Transfer
Source Host: localhost
Source Database: wcf
Target Host: localhost
Target Database: wcf
Date: 30.01.2012 16:25:48
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for wcf_navigation_links
-- ----------------------------
DROP TABLE IF EXISTS `wcf_navigation_links`;
CREATE TABLE `wcf_navigation_links` (
  `link_id` int(11) unsigned NOT NULL auto_increment,
  `link_name` varchar(100) collate utf8_unicode_ci NOT NULL default '',
  `link_url` varchar(200) collate utf8_unicode_ci NOT NULL default '',
  `link_visibility` tinyint(3) NOT NULL default '0',
  `link_position` tinyint(1) unsigned NOT NULL default '1',
  `link_order` smallint(2) unsigned NOT NULL default '0',
  PRIMARY KEY  (`link_id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `wcf_navigation_links` VALUES ('1', 'Общее пространство', '---', '-1', '1', '1');
INSERT INTO `wcf_navigation_links` VALUES ('2', 'Главная', 'index.php', '-1', '1', '2');
INSERT INTO `wcf_navigation_links` VALUES ('3', 'Форум', 'forum/index.php', '-1', '1', '3');
INSERT INTO `wcf_navigation_links` VALUES ('4', 'Онлайн', 'online.php', '-1', '1', '4');
INSERT INTO `wcf_navigation_links` VALUES ('31', 'Выйти из АСР', 'setuser.php', '0', '3', '1');
INSERT INTO `wcf_navigation_links` VALUES ('32', 'Услуги', '---', '0', '3', '2');
INSERT INTO `wcf_navigation_links` VALUES ('33', 'Платные', 'index.php', '0', '3', '3');
INSERT INTO `wcf_navigation_links` VALUES ('34', 'Бесплатные', 'index.php', '0', '3', '4');
