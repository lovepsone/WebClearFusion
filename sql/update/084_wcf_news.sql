/*
MySQL Data Transfer
Source Host: localhost
Source Database: wcf
Target Host: localhost
Target Database: wcf
Date: 04.11.2011 15:20:46
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for wcf_news
-- ----------------------------
DROP TABLE IF EXISTS `wcf_news`;
CREATE TABLE `wcf_news` (
  `news_id` int(11) unsigned NOT NULL auto_increment,
  `news_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `news_title` longtext,
  `news_text` longtext,
  `news_cats` int(11) unsigned default '1',
  PRIMARY KEY  (`news_id`),
  UNIQUE KEY `news_id` (`news_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `wcf_news` VALUES ('1', '2011-11-04 15:20:39', 'От разработчика.', 'WCF успешно установлен.', '19');
