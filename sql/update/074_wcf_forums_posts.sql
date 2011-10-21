/*
MySQL Data Transfer
Source Host: localhost
Source Database: wcf
Target Host: localhost
Target Database: wcf
Date: 21.10.2011 17:50:32
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `wcf_forums_posts` VALUES ('2', '1', '1', '1', 'Проверка работоспособности форума');
INSERT INTO `wcf_forums_posts` VALUES ('2', '2', '3', '1', 'Проверка работоспособности форума!!!');
INSERT INTO `wcf_forums_posts` VALUES ('5', '3', '4', '1', 'Проверка работоспособности форума!!!');
INSERT INTO `wcf_forums_posts` VALUES ('4', '4', '5', '1', 'Проверка работоспособности форума!!!');
