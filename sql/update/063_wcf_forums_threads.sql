/*
MySQL Data Transfer
Source Host: localhost
Source Database: wcf
Target Host: localhost
Target Database: wcf
Date: 18.10.2011 16:13:58
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for wcf_forums_threads
-- ----------------------------
DROP TABLE IF EXISTS `wcf_forums_threads`;
CREATE TABLE `wcf_forums_threads` (
  `forum_id` int(11) default NULL,
  `thread_id` int(11) unsigned NOT NULL auto_increment,
  `thread_name` longtext,
  `thread_user_id` int(11) default NULL,
  PRIMARY KEY  (`thread_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `wcf_forums_threads` VALUES ('2', '1', 'Сообщение от администрации', '1');
INSERT INTO `wcf_forums_threads` VALUES ('2', '2', 'Тестовый форум', '4');
