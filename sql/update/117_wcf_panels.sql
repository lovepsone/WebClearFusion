/*
MySQL Data Transfer
Source Host: localhost
Source Database: wcf
Target Host: localhost
Target Database: wcf
Date: 09.01.2012 18:03:06
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for wcf_panels
-- ----------------------------
DROP TABLE IF EXISTS `wcf_panels`;
CREATE TABLE `wcf_panels` (
  `panel_id` mediumint(8) unsigned NOT NULL auto_increment,
  `panel_filename` varchar(200) NOT NULL default '',
  `panel_type` varchar(20) NOT NULL default '',
  `panel_side` tinyint(1) unsigned NOT NULL default '1',
  `panel_order` tinyint(11) unsigned NOT NULL default '0',
  `panel_status` tinyint(1) unsigned NOT NULL default '1',
  `panel_display` tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (`panel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `wcf_panels` VALUES ('1', 'navigation_panel', 'file', '1', '1', '1', '0');
INSERT INTO `wcf_panels` VALUES ('2', 'user_info_panel', 'file', '4', '1', '1', '0');
INSERT INTO `wcf_panels` VALUES ('3', 'welcome_message_panel', 'file', '2', '1', '1', '0');
