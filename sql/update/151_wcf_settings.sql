/*
MySQL Data Transfer
Source Host: localhost
Source Database: wcf
Target Host: localhost
Target Database: wcf
Date: 28.01.2012 16:36:47
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for wcf_settings
-- ----------------------------
DROP TABLE IF EXISTS `wcf_settings`;
CREATE TABLE `wcf_settings` (
  `settings_name` varchar(200) collate utf8_unicode_ci NOT NULL default '',
  `settings_value` text collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`settings_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `wcf_settings` VALUES ('servername', 'Name WoW Server');
INSERT INTO `wcf_settings` VALUES ('serverurl', '/');
INSERT INTO `wcf_settings` VALUES ('serverbanner', 'images/banners.png');
INSERT INTO `wcf_settings` VALUES ('serverintro', '<div style=\\\'text-align:center\\\'>Добро пожаловать на сайт!<br>Наш set realmlist WoW Server</div>');
INSERT INTO `wcf_settings` VALUES ('opening_page', 'news.php');
INSERT INTO `wcf_settings` VALUES ('lang', 'russian');
INSERT INTO `wcf_settings` VALUES ('theme', 'default');
INSERT INTO `wcf_settings` VALUES ('exclude_left', '');
INSERT INTO `wcf_settings` VALUES ('exclude_right', '');
INSERT INTO `wcf_settings` VALUES ('exclude_upper', '');
INSERT INTO `wcf_settings` VALUES ('exclude_lower', '');
INSERT INTO `wcf_settings` VALUES ('Kcaptcha_enable_auth', '0');
INSERT INTO `wcf_settings` VALUES ('page_forum_threads', '10');
INSERT INTO `wcf_settings` VALUES ('page_forum_posts', '10');
INSERT INTO `wcf_settings` VALUES ('pass_remember', 'on');
INSERT INTO `wcf_settings` VALUES ('registration_ip_limit', '0');
INSERT INTO `wcf_settings` VALUES ('page_news', '5');
INSERT INTO `wcf_settings` VALUES ('page_online', '30');
INSERT INTO `wcf_settings` VALUES ('license_agreement', 'Регистрация учётной записи для игры в WoW на нашем сервере. Внимательно, правильно заполните все поля этой формы. Особое внимание обращаем на правильность ввода E-mailа, т.к. многие операции с учётными записями и персонажами требуют подтверждения по электронной почте. Имя учётной записи и пароль не должны совпадать.<hr>Большая просьба не регистрировать учётные записи, содержащие русские буквы, а то вы не сможете правильно подключиться к серверу.<hr> Удачной вам игры. Спасибо за внимание.<br>');
INSERT INTO `wcf_settings` VALUES ('permit_registration', '1');
