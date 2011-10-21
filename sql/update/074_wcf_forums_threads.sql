/*
MySQL Data Transfer
Source Host: localhost
Source Database: wcf
Target Host: localhost
Target Database: wcf
Date: 21.10.2011 17:50:41
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for wcf_forums_threads
-- ----------------------------
DROP TABLE IF EXISTS `wcf_forums_threads`;
CREATE TABLE `wcf_forums_threads` (
  `forum_id` int(11) default NULL,
  `thread_id` int(11) unsigned NOT NULL auto_increment,
  `user_id` int(11) default NULL,
  `thread_name` longtext,
  `thread_postcount` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (`thread_id`),
  KEY `thread_postcount` (`thread_postcount`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `wcf_forums_threads` VALUES ('2', '1', '1', 'Сообщение от администрации', '2');
INSERT INTO `wcf_forums_threads` VALUES ('2', '2', '4', 'Тестовый форум', '1');
INSERT INTO `wcf_forums_threads` VALUES ('5', '3', '1', 'Сообщение от администрации', '1');
INSERT INTO `wcf_forums_threads` VALUES ('4', '4', '1', 'Сообщение от администрации', '1');
