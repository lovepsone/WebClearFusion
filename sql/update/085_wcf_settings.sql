/*
MySQL Data Transfer
Source Host: localhost
Source Database: wcf
Target Host: localhost
Target Database: wcf
Date: 04.11.2011 19:45:14
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for wcf_settings
-- ----------------------------
DROP TABLE IF EXISTS `wcf_settings`;
CREATE TABLE `wcf_settings` (
  `settings_name` varchar(200) collate utf8_unicode_ci NOT NULL default '',
  `settings_value` text collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`settings_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `wcf_settings` VALUES ('servername', 'Name WoW Server');
INSERT INTO `wcf_settings` VALUES ('default_module', 'news');
INSERT INTO `wcf_settings` VALUES ('urlserver', '/');
INSERT INTO `wcf_settings` VALUES ('change_lang', 'on');
INSERT INTO `wcf_settings` VALUES ('page_forum_threads', '10');
INSERT INTO `wcf_settings` VALUES ('page_forum_posts', '10');
INSERT INTO `wcf_settings` VALUES ('pass_remember', 'on');
INSERT INTO `wcf_settings` VALUES ('reg_ip_limit', '0');
INSERT INTO `wcf_settings` VALUES ('page_news', '5');
INSERT INTO `wcf_settings` VALUES ('page_news_edit', '20');
