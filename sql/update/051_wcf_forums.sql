/*
MySQL Data Transfer
Source Host: localhost
Source Database: wcf
Target Host: localhost
Target Database: wcf
Date: 05.10.2011 18:56:59
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for wcf_forums
-- ----------------------------
DROP TABLE IF EXISTS `wcf_forums`;
CREATE TABLE `wcf_forums` (
  `forum_id` int(11) unsigned NOT NULL auto_increment,
  `forum_name` longtext,
  `forum_description` longtext,
  PRIMARY KEY  (`forum_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records 
-- ----------------------------
