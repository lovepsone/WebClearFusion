/*
MySQL Data Transfer
Source Host: localhost
Source Database: wcf
Target Host: localhost
Target Database: wcf
Date: 01.09.2011 14:37:48
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for wcf_panels
-- ----------------------------
DROP TABLE IF EXISTS `wcf_panels`;
CREATE TABLE `wcf_panels` (
  `panel_id` mediumint(8) unsigned NOT NULL auto_increment,
  `panel_name` varchar(200) NOT NULL default '',
  `panel_url` varchar(200) character set utf8 collate utf8_unicode_ci NOT NULL default '',
  `panel_position` tinyint(1) unsigned NOT NULL default '1',
  PRIMARY KEY  (`panel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `wcf_panels` VALUES ('1', 'main', 'panels/main_panel/main_panel.php', '1');
INSERT INTO `wcf_panels` VALUES ('2', 'user info', 'panels/user_info_panel/user_info_panel.php', '2');
