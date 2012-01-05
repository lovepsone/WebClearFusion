/*
MySQL Data Transfer
Source Host: localhost
Source Database: wcf
Target Host: localhost
Target Database: wcf
Date: 05.01.2012 12:00:09
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for wcf_forums
-- ----------------------------
DROP TABLE IF EXISTS `wcf_forums`;
CREATE TABLE `wcf_forums` (
  `forum_id` int(11) unsigned NOT NULL auto_increment,
  `forum_sections` int(11) unsigned NOT NULL default '0',
  `forum_order` int(11) unsigned NOT NULL default '0',
  `forum_name` longtext,
  `forum_description` longtext,
  `forum_lastpostid` int(11) unsigned NOT NULL default '0',
  `forum_postcount` int(11) unsigned NOT NULL default '0',
  `forum_threadcount` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (`forum_id`),
  KEY `forum_postcount` (`forum_postcount`),
  KEY `forum_threadcount` (`forum_threadcount`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `wcf_forums` VALUES ('1', '0', '1', 'Информация о сервере', null, '0', '0', '0');
INSERT INTO `wcf_forums` VALUES ('2', '0', '2', 'Мир Warcraft', null, '0', '0', '0');
INSERT INTO `wcf_forums` VALUES ('3', '0', '3', 'Жалобы', null, '0', '0', '0');
INSERT INTO `wcf_forums` VALUES ('4', '0', '4', 'Разное', null, '0', '0', '0');
INSERT INTO `wcf_forums` VALUES ('5', '1', '1', 'Информация от администрации', 'Обновления, изменения, события, новости.', '0', '0', '0');
INSERT INTO `wcf_forums` VALUES ('6', '1', '2', 'Мастерская', 'Делимся своими идеями, решениями. Обсуждаем, создаем что-то свое. В общем \"Игродельня\".', '0', '0', '0');
INSERT INTO `wcf_forums` VALUES ('7', '1', '3', 'Конкурсы форума', 'Проведение массовых мероприятий на территории форума. ', '0', '0', '0');
INSERT INTO `wcf_forums` VALUES ('8', '1', '4', 'Техническая поддержка', 'Раздел технической поддержки игроков.', '0', '0', '0');
INSERT INTO `wcf_forums` VALUES ('9', '2', '1', 'Классы', 'Обсуждение, описание, предпочтения, возможности, харрактеристики.', '0', '0', '0');
INSERT INTO `wcf_forums` VALUES ('10', '2', '2', 'Профессии', 'Обсуждение, описание, предпочтения, возможности, плюсы и минусы.', '0', '0', '0');
INSERT INTO `wcf_forums` VALUES ('11', '2', '3', 'Квесты', 'Помощь по квестам в World of Warcraft', '0', '0', '0');
INSERT INTO `wcf_forums` VALUES ('12', '2', '4', 'Достижения', 'Обсуждение, описание, помощь.', '0', '0', '0');
INSERT INTO `wcf_forums` VALUES ('13', '2', '5', 'PVE: подземелья', 'Раздел для победителей драконов. Здесь делятся советами по прохождению инстансов, приводятся тактики сражения с боссами и публикуются новости об успехах гильдий.', '0', '0', '0');
INSERT INTO `wcf_forums` VALUES ('14', '2', '6', 'PVP: арены и поля боя, слава', 'Раздел для гладиаторов и маршалов. Здесь обсуждается PvP во всех его проявлениях и все связанные с ним нюансы: очки чести, аренный рейтинг, PvP сеты и титулы и т.д.', '0', '0', '0');
INSERT INTO `wcf_forums` VALUES ('15', '2', '7', 'Аддоны и Макросы', 'Скачиваем и заказываем', '0', '0', '0');
INSERT INTO `wcf_forums` VALUES ('16', '3', '1', 'Жалобы', 'Нарушения правил GM/игроками. Обсуждение и критика.', '0', '0', '0');
INSERT INTO `wcf_forums` VALUES ('17', '3', '2', 'Жалобы на действия модераторов.', 'Обжалование действий модераторов. ', '0', '0', '0');
INSERT INTO `wcf_forums` VALUES ('18', '4', '1', 'ОффТопик', 'Разговоры на любую тему', '0', '0', '0');
INSERT INTO `wcf_forums` VALUES ('19', '4', '2', 'Форум Гильдий', 'Здесь можно обсудить гильдии, и получить персональные разделы.', '0', '0', '0');
