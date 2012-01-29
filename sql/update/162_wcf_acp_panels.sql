/*
MySQL Data Transfer
Source Host: localhost
Source Database: wcf
Target Host: localhost
Target Database: wcf
Date: 26.01.2012 13:55:52
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for wcf_panels
-- ----------------------------
DROP TABLE IF EXISTS `wcf_acp_panels`;
CREATE TABLE `wcf_acp_panels` (
  `panel_id` mediumint(8) unsigned NOT NULL auto_increment,
  `panel_filename` varchar(200) NOT NULL default '',
  `panel_type` varchar(20) NOT NULL default '',
  `panel_access` tinyint(3) NOT NULL default '-1',
  `panel_side` tinyint(1) unsigned NOT NULL default '1',
  `panel_order` tinyint(11) unsigned NOT NULL default '0',
  `panel_status` tinyint(1) unsigned NOT NULL default '1',
  `panel_display` tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (`panel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records 
-- ----------------------------

