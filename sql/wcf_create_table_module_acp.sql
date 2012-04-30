/*
MySQL Data Transfer
Source Host: localhost
Source Database: wcf
Target Host: localhost
Target Database: wcf
Date: 14.03.2012 16:04:30
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for wcf_acp_panels
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for wcf_acp_navigation_links
-- ----------------------------
DROP TABLE IF EXISTS `wcf_acp_navigation_links`;
CREATE TABLE `wcf_acp_navigation_links` (
  `link_id` int(11) unsigned NOT NULL auto_increment,
  `link_name` varchar(100) collate utf8_unicode_ci NOT NULL default '',
  `link_url` varchar(200) collate utf8_unicode_ci NOT NULL default '',
  `link_visibility` tinyint(3) NOT NULL default '0',
  `link_position` tinyint(1) unsigned NOT NULL default '1',
  `link_order` smallint(2) unsigned NOT NULL default '0',
  PRIMARY KEY  (`link_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;