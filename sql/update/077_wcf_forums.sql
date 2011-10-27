/*
MySQL Data Transfer
Source Host: localhost
Source Database: wcf
Target Host: localhost
Target Database: wcf
Date: 27.10.2011 12:49:34
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for wcf_forums
-- ----------------------------
DROP TABLE IF EXISTS `wcf_forums`;
CREATE TABLE `wcf_forums` (
  `forum_id` mediumint(8) unsigned NOT NULL auto_increment,
  `forum_sections` mediumint(8) unsigned NOT NULL default '0',
  `forum_name` longtext,
  `forum_description` longtext,
  `forum_postcount` mediumint(8) unsigned NOT NULL default '0',
  `forum_threadcount` mediumint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (`forum_id`),
  KEY `forum_postcount` (`forum_postcount`),
  KEY `forum_threadcount` (`forum_threadcount`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `wcf_forums` VALUES ('1', '0', 'Информация о сервере', null, '0', '0');
INSERT INTO `wcf_forums` VALUES ('2', '1', 'Информация от администрации', 'Обновления, изменения, события, новости.', '2', '2');
INSERT INTO `wcf_forums` VALUES ('3', '0', 'Мир Warcraft', null, '0', '0');
INSERT INTO `wcf_forums` VALUES ('4', '3', 'Аддоны и Макросы\r\n', 'Скачиваем и заказываем', '1', '1');
INSERT INTO `wcf_forums` VALUES ('5', '1', 'Мастерская', 'Делимся своими идеями, решениями. Обсуждаем, создаем что-то свое.', '1', '1');
