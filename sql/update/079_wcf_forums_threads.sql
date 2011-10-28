/*
MySQL Data Transfer
Source Host: localhost
Source Database: wcf
Target Host: localhost
Target Database: wcf
Date: 27.10.2011 12:49:54
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
  `thread_views` int(11) default NULL,
  `thread_lastpostid` int(11) unsigned NOT NULL default '0',
  `thread_lastuser` int(11) unsigned NOT NULL default '0',
  `thread_postcount` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (`thread_id`),
  KEY `thread_postcount` (`thread_postcount`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `wcf_forums_threads` VALUES ('2', '1', 'Сообщение от администрации', '1', '0', '1', '1', '1');
INSERT INTO `wcf_forums_threads` VALUES ('2', '2', 'Тестовый форум', '4', '0', '2', '4', '1');
INSERT INTO `wcf_forums_threads` VALUES ('5', '3', 'Сообщение от администрации', '1', '0', '3', '1', '1');
INSERT INTO `wcf_forums_threads` VALUES ('4', '4', 'Сообщение от администрации', '1', '0', '4', '1', '1');
