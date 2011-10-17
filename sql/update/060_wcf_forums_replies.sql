/*
MySQL Data Transfer
Source Host: localhost
Source Database: wcf
Target Host: localhost
Target Database: wcf
Date: 17.10.2011 14:28:11
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
  `replies_name` longtext,
  `replies_text` longtext,
  `thread_postedby` longtext,
  `thread_whenposted` int(11) default NULL,
  PRIMARY KEY  (`replies_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `wcf_forums_replies` VALUES ('2', '1', '1', null, 'Тестовое сообщение', null, null);
INSERT INTO `wcf_forums_replies` VALUES ('2', '1', '2', null, 'Ответ на Тестовое сообщение', null, null);
