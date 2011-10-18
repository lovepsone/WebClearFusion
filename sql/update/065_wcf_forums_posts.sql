/*
MySQL Data Transfer
Source Host: localhost
Source Database: wcf
Target Host: localhost
Target Database: wcf
Date: 18.10.2011 19:36:41
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for wcf_forums_posts
-- ----------------------------
DROP TABLE IF EXISTS `wcf_forums_posts`;
CREATE TABLE `wcf_forums_posts` (
  `forum_id` int(11) default NULL,
  `thread_id` int(11) default NULL,
  `posts_id` int(11) unsigned NOT NULL auto_increment,
  `user_id` int(11) default NULL,
  `posts_text` longtext,
  PRIMARY KEY  (`posts_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `wcf_forums_posts` VALUES ('2', '1', '1', '1', 'Тестовое сообщение');
INSERT INTO `wcf_forums_posts` VALUES ('2', '1', '2', '2', 'Ответ на Тестовое сообщение');
