/*
MySQL Data Transfer
Source Host: localhost
Source Database: wcf
Target Host: localhost
Target Database: wcf
Date: 05.01.2012 12:00:17
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records 
-- ----------------------------
