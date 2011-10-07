/*
MySQL Data Transfer
Source Host: localhost
Source Database: wcf
Target Host: localhost
Target Database: wcf
Date: 07.10.2011 20:59:20
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for wcf_forums
-- ----------------------------
DROP TABLE IF EXISTS `wcf_forums`;
CREATE TABLE `wcf_forums` (
  `forum_id` mediumint(8) unsigned NOT NULL auto_increment,
  `forum_cat` mediumint(8) unsigned NOT NULL default '0',
  `forum_name` longtext,
  `forum_description` longtext,
  PRIMARY KEY  (`forum_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `wcf_forums` VALUES ('1', '0', 'Информация о сервере', null);
INSERT INTO `wcf_forums` VALUES ('2', '1', 'Информация от администрации', 'Обновления, изменения, события, новости.');
INSERT INTO `wcf_forums` VALUES ('3', '0', 'Мир Warcraft', null);
INSERT INTO `wcf_forums` VALUES ('4', '3', 'Аддоны и Макросы\r\n', 'Скачиваем и заказываем');
INSERT INTO `wcf_forums` VALUES ('5', '1', 'Мастерская', 'Делимся своими идеями, решениями. Обсуждаем, создаем что-то свое.');
