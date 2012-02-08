/*
MySQL Data Transfer
Source Host: localhost
Source Database: wcf
Target Host: localhost
Target Database: wcf
Date: 07.02.2012 19:36:11
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for wcf_achievement_category
-- ----------------------------
DROP TABLE IF EXISTS `wcf_achievement_category`;
CREATE TABLE `wcf_achievement_category` (
  `id` int(10) unsigned NOT NULL,
  `parent` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sortOrder` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `wcf_achievement_category` VALUES ('92', '-1', 'Общее', '1');
INSERT INTO `wcf_achievement_category` VALUES ('123', '122', 'Арена', '1');
INSERT INTO `wcf_achievement_category` VALUES ('130', '1', 'Персонаж', '1');
INSERT INTO `wcf_achievement_category` VALUES ('135', '128', 'Существа', '1');
INSERT INTO `wcf_achievement_category` VALUES ('140', '130', 'Доходы', '1');
INSERT INTO `wcf_achievement_category` VALUES ('152', '21', 'Арены с ведением счета', '1');
INSERT INTO `wcf_achievement_category` VALUES ('160', '155', 'Лунный фестиваль', '1');
INSERT INTO `wcf_achievement_category` VALUES ('165', '95', 'Арена', '1');
INSERT INTO `wcf_achievement_category` VALUES ('170', '169', 'Кулинария', '1');
INSERT INTO `wcf_achievement_category` VALUES ('178', '132', 'Вспомогательные навыки', '1');
INSERT INTO `wcf_achievement_category` VALUES ('14777', '97', 'Восточные королевства', '1');
INSERT INTO `wcf_achievement_category` VALUES ('14808', '168', 'World of Warcraft', '1');
INSERT INTO `wcf_achievement_category` VALUES ('14821', '14807', 'World of Warcraft', '1');
INSERT INTO `wcf_achievement_category` VALUES ('14861', '96', 'World of Warcraft', '1');
INSERT INTO `wcf_achievement_category` VALUES ('14864', '201', 'World of Warcraft', '1');
INSERT INTO `wcf_achievement_category` VALUES ('96', '-1', 'Задания', '2');
INSERT INTO `wcf_achievement_category` VALUES ('124', '122', 'Поле боя', '2');
INSERT INTO `wcf_achievement_category` VALUES ('136', '128', 'Почетные победы', '2');
INSERT INTO `wcf_achievement_category` VALUES ('141', '1', 'Бой', '2');
INSERT INTO `wcf_achievement_category` VALUES ('145', '130', 'Расход. предметы', '2');
INSERT INTO `wcf_achievement_category` VALUES ('153', '21', 'Поле боя', '2');
INSERT INTO `wcf_achievement_category` VALUES ('171', '169', 'Рыбная ловля', '2');
INSERT INTO `wcf_achievement_category` VALUES ('173', '132', 'Профессии', '2');
INSERT INTO `wcf_achievement_category` VALUES ('187', '155', 'Любовная лихорадка', '2');
INSERT INTO `wcf_achievement_category` VALUES ('14778', '97', 'Калимдор', '2');
INSERT INTO `wcf_achievement_category` VALUES ('14801', '95', 'Альтеракская долина', '2');
INSERT INTO `wcf_achievement_category` VALUES ('14805', '168', 'The Burning Crusade', '2');
INSERT INTO `wcf_achievement_category` VALUES ('14822', '14807', 'The Burning Crusade', '2');
INSERT INTO `wcf_achievement_category` VALUES ('14862', '96', 'The Burning Crusade', '2');
INSERT INTO `wcf_achievement_category` VALUES ('14865', '201', 'The Burning Crusade', '2');
INSERT INTO `wcf_achievement_category` VALUES ('97', '-1', 'Исследование', '3');
INSERT INTO `wcf_achievement_category` VALUES ('125', '122', 'Подземелья', '3');
INSERT INTO `wcf_achievement_category` VALUES ('128', '1', 'Победы', '3');
INSERT INTO `wcf_achievement_category` VALUES ('137', '128', 'Смертельные удары', '3');
INSERT INTO `wcf_achievement_category` VALUES ('147', '130', 'Репутация', '3');
INSERT INTO `wcf_achievement_category` VALUES ('154', '21', 'Мир', '3');
INSERT INTO `wcf_achievement_category` VALUES ('159', '155', 'Сад чудес', '3');
INSERT INTO `wcf_achievement_category` VALUES ('172', '169', 'Первая помощь', '3');
INSERT INTO `wcf_achievement_category` VALUES ('14779', '97', 'Запределье', '3');
INSERT INTO `wcf_achievement_category` VALUES ('14802', '95', 'Низина Арати', '3');
INSERT INTO `wcf_achievement_category` VALUES ('14806', '168', 'Lich King (5)', '3');
INSERT INTO `wcf_achievement_category` VALUES ('14823', '14807', 'Wrath of the Lich King', '3');
INSERT INTO `wcf_achievement_category` VALUES ('14863', '96', 'Wrath of the Lich King', '3');
INSERT INTO `wcf_achievement_category` VALUES ('14866', '201', 'Wrath of the Lich King', '3');
INSERT INTO `wcf_achievement_category` VALUES ('95', '-1', 'PvP', '4');
INSERT INTO `wcf_achievement_category` VALUES ('122', '1', 'Смерти', '4');
INSERT INTO `wcf_achievement_category` VALUES ('126', '122', 'Мир', '4');
INSERT INTO `wcf_achievement_category` VALUES ('163', '155', 'Детская неделя', '4');
INSERT INTO `wcf_achievement_category` VALUES ('191', '130', 'Снаряжение', '4');
INSERT INTO `wcf_achievement_category` VALUES ('14780', '97', 'Нордскол', '4');
INSERT INTO `wcf_achievement_category` VALUES ('14803', '95', 'Око Бури', '4');
INSERT INTO `wcf_achievement_category` VALUES ('14921', '168', 'Lich King (5, героич.)', '4');
INSERT INTO `wcf_achievement_category` VALUES ('14963', '14807', 'Тайны Ульдуара', '4');
INSERT INTO `wcf_achievement_category` VALUES ('127', '122', 'Воскрешение', '5');
INSERT INTO `wcf_achievement_category` VALUES ('133', '1', 'Задания', '5');
INSERT INTO `wcf_achievement_category` VALUES ('161', '155', 'Огненный солнцеворот', '5');
INSERT INTO `wcf_achievement_category` VALUES ('168', '-1', 'Подземелья и рейды', '5');
INSERT INTO `wcf_achievement_category` VALUES ('14804', '95', 'Ущелье Песни Войны', '5');
INSERT INTO `wcf_achievement_category` VALUES ('14922', '168', 'Lich King (10)', '5');
INSERT INTO `wcf_achievement_category` VALUES ('162', '155', 'Хмельной фестиваль', '6');
INSERT INTO `wcf_achievement_category` VALUES ('169', '-1', 'Профессии', '6');
INSERT INTO `wcf_achievement_category` VALUES ('14807', '1', 'Подземелья и рейды', '6');
INSERT INTO `wcf_achievement_category` VALUES ('14881', '95', 'Берег Древних', '6');
INSERT INTO `wcf_achievement_category` VALUES ('14923', '168', 'Lich King (25)', '6');
INSERT INTO `wcf_achievement_category` VALUES ('132', '1', 'Навыки', '7');
INSERT INTO `wcf_achievement_category` VALUES ('158', '155', 'Тыквовин', '7');
INSERT INTO `wcf_achievement_category` VALUES ('201', '-1', 'Репутация', '7');
INSERT INTO `wcf_achievement_category` VALUES ('14901', '95', 'Ледяные Оковы', '7');
INSERT INTO `wcf_achievement_category` VALUES ('14961', '168', 'Тайны Ульдуара (10)', '7');
INSERT INTO `wcf_achievement_category` VALUES ('134', '1', 'Путешествия', '8');
INSERT INTO `wcf_achievement_category` VALUES ('155', '-1', 'Игровые события', '8');
INSERT INTO `wcf_achievement_category` VALUES ('156', '155', 'Зимний Покров', '8');
INSERT INTO `wcf_achievement_category` VALUES ('14962', '168', 'Тайны Ульдуара (25)', '8');
INSERT INTO `wcf_achievement_category` VALUES ('81', '-1', 'Великие подвиги', '9');
INSERT INTO `wcf_achievement_category` VALUES ('131', '1', 'Общение', '9');
INSERT INTO `wcf_achievement_category` VALUES ('1', '-1', 'Статистика', '10');
INSERT INTO `wcf_achievement_category` VALUES ('21', '1', 'PvP', '10');
INSERT INTO `wcf_achievement_category` VALUES ('14941', '155', 'Серебряный турнир', '10');
INSERT INTO `wcf_achievement_category` VALUES ('15002', '168', 'Призыв Авангарда (25)', '10');
INSERT INTO `wcf_achievement_category` VALUES ('15041', '168', 'Падение Короля-лича (10)', '11');
INSERT INTO `wcf_achievement_category` VALUES ('15042', '168', 'Падение Короля-лича (25)', '12');
INSERT INTO `wcf_achievement_category` VALUES ('15021', '14807', 'Призыв Авангарда', '5');
INSERT INTO `wcf_achievement_category` VALUES ('15062', '14807', 'Падение Короля-лича', '6');
INSERT INTO `wcf_achievement_category` VALUES ('14981', '155', 'Пиршество странников', '8');
INSERT INTO `wcf_achievement_category` VALUES ('15003', '95', 'Остров Завоеваний', '8');
INSERT INTO `wcf_achievement_category` VALUES ('15001', '168', 'Призыв Авангарда (10)', '9');
