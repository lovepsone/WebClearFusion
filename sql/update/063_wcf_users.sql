/*
MySQL Data Transfer
Source Host: localhost
Source Database: wcf
Target Host: localhost
Target Database: wcf
Date: 18.10.2011 16:08:05
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for wcf_users
-- ----------------------------
DROP TABLE IF EXISTS `wcf_users`;
CREATE TABLE `wcf_users` (
  `user_id` int(11) unsigned NOT NULL auto_increment,
  `user_name` varchar(32) NOT NULL default '',
  `user_online` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`user_id`),
  UNIQUE KEY `idx_user_name` (`user_name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `wcf_users` VALUES ('1', 'ADMINISTRATOR', '0');
INSERT INTO `wcf_users` VALUES ('2', 'GAMEMASTER', '0');
INSERT INTO `wcf_users` VALUES ('3', 'MODERATOR', '0');
INSERT INTO `wcf_users` VALUES ('4', 'PLAYER', '0');
INSERT INTO `wcf_users` VALUES ('5', 'LOVEPSONE', '0');
