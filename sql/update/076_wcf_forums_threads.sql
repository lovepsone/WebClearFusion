/*
MySQL Data Transfer
Source Host: localhost
Source Database: wcf
Target Host: localhost
Target Database: wcf
Date: 26.10.2011 16:40:34
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for wcf_forums_threads
-- ----------------------------
DROP TABLE IF EXISTS `wcf_forums_threads`;
CREATE TABLE `wcf_forums_threads` (
  `forum_id` int(11) default NULL,
  `thread_id` int(11) unsigned NOT NULL auto_increment,
  `thread_subject` longtext,
  `thread_author` int(11) default NULL,
  `thread_lastpostid` int(8) unsigned NOT NULL default '0',
  `thread_lastuser` int(8) unsigned NOT NULL default '0',
  `thread_postcount` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (`thread_id`),
  KEY `thread_postcount` (`thread_postcount`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `wcf_forums_threads` VALUES ('2', '1', 'Сообщение от администрации', '1', '1', '1', '2');
INSERT INTO `wcf_forums_threads` VALUES ('2', '2', 'Тестовый форум', '4', '3', '4', '1');
INSERT INTO `wcf_forums_threads` VALUES ('5', '3', 'Сообщение от администрации', '1', '4', '1', '1');
INSERT INTO `wcf_forums_threads` VALUES ('4', '4', 'Сообщение от администрации', '1', '5', '1', '1');
