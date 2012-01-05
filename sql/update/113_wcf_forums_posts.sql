/*
MySQL Data Transfer
Source Host: localhost
Source Database: wcf
Target Host: localhost
Target Database: wcf
Date: 05.01.2012 12:29:39
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for wcf_forums_posts
-- ----------------------------
DROP TABLE IF EXISTS `wcf_forums_posts`;
CREATE TABLE `wcf_forums_posts` (
  `forum_id` int(11) default NULL,
  `thread_id` int(11) default NULL,
  `post_id` int(11) unsigned NOT NULL auto_increment,
  `user_id` int(11) default NULL,
  `post_text` longtext,
  `post_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records 
-- ----------------------------
