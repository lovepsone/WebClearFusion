/*
MySQL Data Transfer
Source Host: localhost
Source Database: wcf
Target Host: localhost
Target Database: wcf
Date: 11.01.2012 17:24:44
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for wcf_admin
-- ----------------------------
DROP TABLE IF EXISTS `wcf_admin`;
CREATE TABLE `wcf_admin` (
  `admin_id` int(11) unsigned NOT NULL auto_increment,
  `admin_colum` int(11) unsigned NOT NULL default '0',
  `admin_page` int(11) unsigned NOT NULL default '0',
  `admin_string` int(11) unsigned NOT NULL default '0',
  `admin_image` varchar(50) character set utf8 collate utf8_unicode_ci NOT NULL default '',
  `admin_title` longtext character set utf8 collate utf8_unicode_ci NOT NULL,
  `admin_link` varchar(100) character set utf8 collate utf8_unicode_ci NOT NULL default 'reserved',
  PRIMARY KEY  (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for wcf_comments
-- ----------------------------
DROP TABLE IF EXISTS `wcf_comments`;
CREATE TABLE `wcf_comments` (
  `comment_id` int(11) unsigned NOT NULL auto_increment,
  `comment_item_id` int(11) unsigned default '0',
  `comment_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `comment_type` int(2) unsigned default '0',
  `user_id` int(11) unsigned default '1',
  `comment_message` longtext collate utf8_unicode_ci,
  PRIMARY KEY  (`comment_id`),
  UNIQUE KEY `comment_id` (`comment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for wcf_forums
-- ----------------------------
DROP TABLE IF EXISTS `wcf_forums`;
CREATE TABLE `wcf_forums` (
  `forum_id` int(11) unsigned NOT NULL auto_increment,
  `forum_sections` int(11) unsigned NOT NULL default '0',
  `forum_order` int(11) unsigned NOT NULL default '0',
  `forum_name` longtext collate utf8_unicode_ci,
  `forum_description` longtext collate utf8_unicode_ci,
  `forum_lastpostid` int(11) unsigned NOT NULL default '0',
  `forum_postcount` int(11) unsigned NOT NULL default '0',
  `forum_threadcount` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (`forum_id`),
  KEY `forum_postcount` (`forum_postcount`),
  KEY `forum_threadcount` (`forum_threadcount`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for wcf_forums_posts
-- ----------------------------
DROP TABLE IF EXISTS `wcf_forums_posts`;
CREATE TABLE `wcf_forums_posts` (
  `forum_id` int(11) default NULL,
  `thread_id` int(11) default NULL,
  `post_id` int(11) unsigned NOT NULL auto_increment,
  `user_id` int(11) default NULL,
  `post_text` longtext collate utf8_unicode_ci,
  `post_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`post_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for wcf_forums_threads
-- ----------------------------
DROP TABLE IF EXISTS `wcf_forums_threads`;
CREATE TABLE `wcf_forums_threads` (
  `forum_id` int(11) default NULL,
  `thread_id` int(11) unsigned NOT NULL auto_increment,
  `thread_subject` longtext collate utf8_unicode_ci,
  `thread_author` int(11) default NULL,
  `thread_views` int(11) default NULL,
  `thread_lastpostid` int(11) unsigned NOT NULL default '0',
  `thread_lastuser` int(11) unsigned NOT NULL default '0',
  `thread_postcount` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (`thread_id`),
  KEY `thread_postcount` (`thread_postcount`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for wcf_logs
-- ----------------------------
DROP TABLE IF EXISTS `wcf_logs`;
CREATE TABLE `wcf_logs` (
  `date` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `ip` varchar(15) collate utf8_unicode_ci NOT NULL,
  `account` int(11) unsigned NOT NULL,
  `character` int(11) unsigned default NULL,
  `mode` tinyint(3) unsigned NOT NULL,
  `email` varchar(100) collate utf8_unicode_ci default NULL,
  `resultat` longtext collate utf8_unicode_ci,
  `note` longtext collate utf8_unicode_ci,
  `old_data` longtext collate utf8_unicode_ci
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for wcf_navigation_links
-- ----------------------------
DROP TABLE IF EXISTS `wcf_navigation_links`;
CREATE TABLE `wcf_navigation_links` (
  `link_id` int(11) unsigned NOT NULL auto_increment,
  `link_name` varchar(100) collate utf8_unicode_ci NOT NULL default '',
  `link_url` varchar(200) collate utf8_unicode_ci NOT NULL default '',
  `link_visibility` tinyint(3) NOT NULL default '0',
  `link_position` tinyint(1) unsigned NOT NULL default '1',
  `link_order` smallint(2) unsigned NOT NULL default '0',
  PRIMARY KEY  (`link_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for wcf_news
-- ----------------------------
DROP TABLE IF EXISTS `wcf_news`;
CREATE TABLE `wcf_news` (
  `news_id` int(11) unsigned NOT NULL auto_increment,
  `news_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `news_author` int(11) unsigned default '1',
  `news_title` longtext collate utf8_unicode_ci,
  `news_text` longtext collate utf8_unicode_ci,
  `news_text_main` longtext collate utf8_unicode_ci,
  `news_cats` int(11) unsigned default '1',
  PRIMARY KEY  (`news_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
-- Table structure for wcf_panels
-- ----------------------------
DROP TABLE IF EXISTS `wcf_panels`;
CREATE TABLE `wcf_panels` (
  `panel_id` mediumint(8) unsigned NOT NULL auto_increment,
  `panel_filename` varchar(200) collate utf8_unicode_ci NOT NULL default '',
  `panel_type` varchar(20) collate utf8_unicode_ci NOT NULL default '',
  `panel_side` tinyint(1) unsigned NOT NULL default '1',
  `panel_order` tinyint(11) unsigned NOT NULL default '0',
  `panel_status` tinyint(1) unsigned NOT NULL default '1',
  `panel_display` tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (`panel_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
-- Table structure for wcf_users
-- ----------------------------
DROP TABLE IF EXISTS `wcf_users`;
CREATE TABLE `wcf_users` (
  `user_id` int(11) unsigned NOT NULL auto_increment,
  `user_name` varchar(32) collate utf8_unicode_ci NOT NULL default '',
  `user_online` tinyint(3) unsigned NOT NULL default '0',
  `user_avatar` varchar(100) collate utf8_unicode_ci NOT NULL default '',
  PRIMARY KEY  (`user_id`),
  UNIQUE KEY `idx_user_name` (`user_name`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `wcf_admin` VALUES ('1', '1', '1', '1', 'news.gif', 'Новости', 'news.php');
INSERT INTO `wcf_admin` VALUES ('2', '2', '1', '1', 'forums.gif', 'Форум', 'forumedit.php');
INSERT INTO `wcf_admin` VALUES ('3', '3', '1', '1', 'panels.gif', 'Панели', '');
INSERT INTO `wcf_admin` VALUES ('4', '4', '1', '1', '', '', '');
INSERT INTO `wcf_admin` VALUES ('5', '1', '1', '2', 'news_cats', 'Категории новостей', 'news_cats.php');
INSERT INTO `wcf_admin` VALUES ('6', '1', '1', '2', '', '', '');
INSERT INTO `wcf_admin` VALUES ('7', '1', '1', '2', '', '', '');
INSERT INTO `wcf_admin` VALUES ('8', '1', '1', '2', '', '', '');
INSERT INTO `wcf_admin` VALUES ('49', '1', '4', '1', 'settings.gif', 'Главные установки', 'settings_main.php');
INSERT INTO `wcf_comments` VALUES ('2', '1', '2011-12-01 15:57:52', '1', '5', '<p><span style=\\\"text-decoration: line-through;\\\"><span style=\\\"text-decoration: underline;\\\"><em><strong>Проверка работаспособности!</strong></em></span></span></p>');
INSERT INTO `wcf_comments` VALUES ('3', '2', '2011-12-01 16:09:16', '1', '5', '<p>Когда же сервера появятся пирацкие?</p>');
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
INSERT INTO `wcf_navigation_links` VALUES ('1', 'Общее пространство', '---', '-1', '1', '1');
INSERT INTO `wcf_navigation_links` VALUES ('2', 'Главная', 'index.php', '-1', '1', '2');
INSERT INTO `wcf_navigation_links` VALUES ('3', 'Форум', 'forum/index.php', '-1', '1', '3');
INSERT INTO `wcf_news` VALUES ('1', '2011-11-15 19:27:45', '1', 'От разработчика.', '<p>WCF успешно установлен.</p>', '<p>WCF успешно установлен и готов к использыванию. Пройдите в админку и настройте движок на свой вкус! Приятной вам работы!</p>', '1');
INSERT INTO `wcf_news` VALUES ('2', '2011-11-30 20:56:32', '1', 'Время отличных новостей продолжается', '<p>Сотрудники компании Blizzard, в преддверии выпуска Diablo 3, объявили одну, на мой взгляд хорошую акцию. Смысл её заключается в том, что Вы просто оплачиваете в течение года подписку на WoW, и за это в подарок получаете стандартную Diablo 3, как только та появится в продаже. Так же с выходом патча 4.3.0 Вы получите \\\"скакуна тираэля\\\" и возможность принять участие в бета тесте следующего дополнения \\\"Туманы пандарии\\\". <br /> Для участия в акции необходимо иметь оплаченную учётную запись вов(в моём случае был катаклизм, но может достаточно и классик+бк) на которой не прикреплён родительский контроль(если он есть, в этом случае нужно позвонить в техподдержку Blizzard). Далее нам понадобится выбрать способ оплаты(я выбирал оплату картой Visa, т.к. наиболее удобно, никуда бегать не надо, и деньги будут списываться сами). После того как Вы выбрали способ оплаты и Вам пришло подтверждение того что Вы стали участником акции - остаётся только ждать релиза патча 4.3.0, Diablo 3 и \\\"Туманов пандарии\\\".</p>', '<p>Сотрудники компании Blizzard, в преддверии выпуска Diablo 3, объявили одну, на мой взгляд хорошую акцию. Смысл её заключается в том, что Вы просто оплачиваете в течение года подписку на WoW, и за это в подарок получаете стандартную Diablo 3, как только та появится в продаже. Так же с выходом патча 4.3.0 Вы получите \\\"скакуна тираэля\\\" и возможность принять участие в бета тесте следующего дополнения \\\"Туманы пандарии\\\". <br /> Для участия в акции необходимо иметь оплаченную учётную запись вов(в моём случае был катаклизм, но может достаточно и классик+бк) на которой не прикреплён родительский контроль(если он есть, в этом случае нужно позвонить в техподдержку Blizzard). Далее нам понадобится выбрать способ оплаты(я выбирал оплату картой Visa, т.к. наиболее удобно, никуда бегать не надо, и деньги будут списываться сами). После того как Вы выбрали способ оплаты и Вам пришло подтверждение того что Вы стали участником акции - остаётся только ждать релиза патча 4.3.0, Diablo 3 и \\\"Туманов пандарии\\\".</p>', '1');
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
INSERT INTO `wcf_panels` VALUES ('1', 'navigation_panel', 'file', '1', '1', '1', '0');
INSERT INTO `wcf_panels` VALUES ('2', 'user_info_panel', 'file', '4', '1', '1', '0');
INSERT INTO `wcf_panels` VALUES ('3', 'welcome_message_panel', 'file', '2', '1', '1', '0');
INSERT INTO `wcf_settings` VALUES ('servername', 'Name WoW Server');
INSERT INTO `wcf_settings` VALUES ('opening_page', 'news.php');
INSERT INTO `wcf_settings` VALUES ('urlserver', '/');
INSERT INTO `wcf_settings` VALUES ('change_lang', 'on');
INSERT INTO `wcf_settings` VALUES ('page_forum_threads', '10');
INSERT INTO `wcf_settings` VALUES ('page_forum_posts', '10');
INSERT INTO `wcf_settings` VALUES ('pass_remember', 'on');
INSERT INTO `wcf_settings` VALUES ('reg_ip_limit', '0');
INSERT INTO `wcf_settings` VALUES ('page_news', '5');
INSERT INTO `wcf_settings` VALUES ('page_admin_news', '10');
INSERT INTO `wcf_settings` VALUES ('exclude_left', '');
INSERT INTO `wcf_settings` VALUES ('serverintro', '<div style=\\\'text-align:center\\\'>Добро пожаловать на сайт!</div>');
INSERT INTO `wcf_settings` VALUES ('exclude_right', '');
INSERT INTO `wcf_settings` VALUES ('exclude_upper', '');
INSERT INTO `wcf_settings` VALUES ('exclude_lower', '');
INSERT INTO `wcf_users` VALUES ('1', 'ADMINISTRATOR', '0', '');
INSERT INTO `wcf_users` VALUES ('2', 'GAMEMASTER', '0', '');
INSERT INTO `wcf_users` VALUES ('3', 'MODERATOR', '0', '');
INSERT INTO `wcf_users` VALUES ('4', 'PLAYER', '0', '');
INSERT INTO `wcf_users` VALUES ('5', 'LOVEPSONE', '1', '');
