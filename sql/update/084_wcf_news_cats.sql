/*
MySQL Data Transfer
Source Host: localhost
Source Database: wcf
Target Host: localhost
Target Database: wcf
Date: 04.11.2011 15:32:15
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for wcf_news_cats
-- ----------------------------
DROP TABLE IF EXISTS `wcf_news_cats`;
CREATE TABLE `wcf_news_cats` (
  `news_cat_id` int(11) unsigned NOT NULL auto_increment,
  `news_cat_name` varchar(100) collate utf8_unicode_ci NOT NULL,
  `news_cat_image` varchar(100) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`news_cat_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `wcf_news_cats` VALUES ('1', 'Новости', 'news.gif');
INSERT INTO `wcf_news_cats` VALUES ('2', 'Ошибки', 'bugs.gif');
INSERT INTO `wcf_news_cats` VALUES ('3', 'Игры', 'games.gif');
INSERT INTO `wcf_news_cats` VALUES ('4', 'Интернет', 'network.gif');
INSERT INTO `wcf_news_cats` VALUES ('5', 'Загрузки', 'downloads.gif');
INSERT INTO `wcf_news_cats` VALUES ('6', 'БСД', 'bsd.gif');
INSERT INTO `wcf_news_cats` VALUES ('7', 'Графика', 'graphics.gif');
INSERT INTO `wcf_news_cats` VALUES ('8', 'Аппаратные средства', 'hardware.gif');
INSERT INTO `wcf_news_cats` VALUES ('9', 'Журнал', 'journal.gif');
INSERT INTO `wcf_news_cats` VALUES ('10', 'Linux', 'linux.gif');
INSERT INTO `wcf_news_cats` VALUES ('11', 'Мас', 'mac.gif');
INSERT INTO `wcf_news_cats` VALUES ('12', 'Пользователи', 'members.gif');
INSERT INTO `wcf_news_cats` VALUES ('13', 'Моды', 'mods.gif');
INSERT INTO `wcf_news_cats` VALUES ('14', 'Видео', 'movies.gif');
INSERT INTO `wcf_news_cats` VALUES ('15', 'Музыка', 'music.gif');
INSERT INTO `wcf_news_cats` VALUES ('16', 'Безопасность', 'security.gif');
INSERT INTO `wcf_news_cats` VALUES ('17', 'Программы', 'software.gif');
INSERT INTO `wcf_news_cats` VALUES ('18', 'Схемы Скины', 'themes.gif');
INSERT INTO `wcf_news_cats` VALUES ('19', 'Web Clear Fusion', 'web-clear-fusion.gif');
INSERT INTO `wcf_news_cats` VALUES ('20', 'Виндовс', 'windows.gif');
