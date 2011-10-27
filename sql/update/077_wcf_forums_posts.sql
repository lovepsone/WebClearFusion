/*
MySQL Data Transfer
Source Host: localhost
Source Database: wcf
Target Host: localhost
Target Database: wcf
Date: 27.10.2011 12:49:48
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `wcf_forums_posts` VALUES ('2', '1', '1', '1', 'Проверка работоспособности форума!!!', '2010-05-28 21:04:49');
INSERT INTO `wcf_forums_posts` VALUES ('2', '2', '2', '4', 'Проверка работоспособности форума!!!', '2011-10-27 12:40:08');
INSERT INTO `wcf_forums_posts` VALUES ('5', '3', '3', '1', 'Проверка работоспособности форума!!!', '2011-10-27 12:39:40');
INSERT INTO `wcf_forums_posts` VALUES ('4', '4', '4', '1', 'Проверка работоспособности форума!!!', '2011-10-27 12:39:44');
