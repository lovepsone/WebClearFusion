/*
MySQL Data Transfer
Source Host: localhost
Source Database: wcf
Target Host: localhost
Target Database: wcf
Date: 06.10.2011 13:52:47
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for wcf_users
-- ----------------------------
DROP TABLE IF EXISTS `wcf_users`;
CREATE TABLE `wcf_users` (
  `user_id` int(11) unsigned NOT NULL auto_increment COMMENT 'Identifier',
  `user_name` varchar(32) NOT NULL default '',
  `user_online` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`user_id`),
  UNIQUE KEY `idx_user_name` (`user_name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records 
-- ----------------------------
