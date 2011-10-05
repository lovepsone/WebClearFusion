/*
MySQL Data Transfer
Source Host: localhost
Source Database: wcf
Target Host: localhost
Target Database: wcf
Date: 05.10.2011 18:57:23
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
  `thread_text` longtext,
  `thread_postedby` longtext,
  `thread_whenposted` int(11) default NULL,
  PRIMARY KEY  (`thread_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records 
-- ----------------------------
