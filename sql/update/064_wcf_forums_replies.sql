/*
MySQL Data Transfer
Source Host: localhost
Source Database: wcf
Target Host: localhost
Target Database: wcf
Date: 18.10.2011 16:30:25
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for wcf_forums_replies
-- ----------------------------
DROP TABLE IF EXISTS `wcf_forums_replies`;
CREATE TABLE `wcf_forums_replies` (
  `forum_id` int(11) default NULL,
  `thread_id` int(11) default NULL,
  `replies_id` int(11) unsigned NOT NULL auto_increment,
  `user_id` int(11) default NULL,
  `replies_text` longtext,
  PRIMARY KEY  (`replies_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `wcf_forums_replies` VALUES ('2', '1', '1', '0', 'Тестовое сообщение');
INSERT INTO `wcf_forums_replies` VALUES ('2', '1', '2', '0', 'Ответ на Тестовое сообщение');
