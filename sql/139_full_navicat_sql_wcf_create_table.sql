/*
MySQL Data Transfer
Source Host: localhost
Source Database: wcf
Target Host: localhost
Target Database: wcf
Date: 26.01.2012 16:32:04
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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for wcf_news
-- ----------------------------
DROP TABLE IF EXISTS `wcf_news`;
CREATE TABLE `wcf_news` (
  `news_id` int(11) unsigned NOT NULL auto_increment,
  `news_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `news_author` int(11) unsigned default '1',
  `news_subject` longtext collate utf8_unicode_ci,
  `news_show_cat` int(11) unsigned default '0',
  `news_cat` int(11) unsigned default '1',
  `news_text` longtext collate utf8_unicode_ci,
  `news_text_extended` longtext collate utf8_unicode_ci,
  `news_visibility` int(3) NOT NULL default '0',
  `news_allow_comments` int(3) unsigned NOT NULL default '1',
  PRIMARY KEY  (`news_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `panel_filename` varchar(200) NOT NULL default '',
  `panel_type` varchar(20) NOT NULL default '',
  `panel_access` tinyint(3) NOT NULL default '-1',
  `panel_side` tinyint(1) unsigned NOT NULL default '1',
  `panel_order` tinyint(11) unsigned NOT NULL default '0',
  `panel_status` tinyint(1) unsigned NOT NULL default '1',
  `panel_display` tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (`panel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `wcf_admin` VALUES ('1', '1', '1', '1', 'news.gif', 'Новости', 'news.php');
INSERT INTO `wcf_admin` VALUES ('2', '2', '1', '1', 'forums.gif', 'Форум', 'forumedit.php');
INSERT INTO `wcf_admin` VALUES ('3', '3', '1', '1', 'panels.gif', 'Панели', 'panels.php');
INSERT INTO `wcf_admin` VALUES ('4', '4', '1', '1', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('5', '1', '1', '2', 'news_cats', 'Категории новостей', 'news_cats.php');
INSERT INTO `wcf_admin` VALUES ('6', '2', '1', '2', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('7', '3', '1', '2', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('8', '4', '1', '2', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('9', '1', '1', '3', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('10', '2', '1', '3', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('11', '3', '1', '3', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('12', '4', '1', '3', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('13', '1', '1', '4', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('14', '2', '1', '4', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('15', '3', '1', '4', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('16', '4', '1', '4', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('17', '1', '2', '1', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('18', '2', '2', '1', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('19', '3', '2', '1', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('20', '4', '2', '1', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('21', '1', '2', '2', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('22', '2', '2', '2', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('23', '3', '2', '2', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('24', '4', '2', '2', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('25', '1', '2', '3', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('26', '2', '2', '3', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('27', '3', '2', '3', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('28', '4', '2', '3', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('29', '1', '2', '4', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('30', '2', '2', '4', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('31', '3', '2', '4', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('32', '4', '2', '4', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('33', '1', '3', '1', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('34', '2', '3', '1', 'site_links.gif', 'Навигация сайта', 'site_links.php');
INSERT INTO `wcf_admin` VALUES ('35', '3', '3', '1', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('36', '4', '3', '1', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('37', '1', '3', '2', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('38', '2', '3', '2', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('39', '3', '3', '2', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('40', '4', '3', '2', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('41', '1', '3', '3', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('42', '2', '3', '3', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('43', '3', '3', '3', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('44', '4', '3', '3', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('45', '1', '3', '4', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('46', '2', '3', '4', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('47', '3', '3', '4', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('48', '4', '3', '4', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('49', '1', '4', '1', 'settings.gif', 'Главные установки', 'settings_main.php');
INSERT INTO `wcf_comments` VALUES ('1', '1', '2012-01-17 18:08:28', '1', '5', '<p><span style=\\\"text-decoration: line-through;\\\"><span style=\\\"text-decoration: underline;\\\"><em><strong>Проверка работаспособности!</strong></em></span></span></p>');
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
INSERT INTO `wcf_logs` VALUES ('2012-01-22 21:20:39', '192.168.12.100', '5', '0', '1', 'lovepsone@mail.ru', '', 'LOVEPSONE', '');
INSERT INTO `wcf_navigation_links` VALUES ('1', 'Общее пространство', '---', '-1', '1', '1');
INSERT INTO `wcf_navigation_links` VALUES ('2', 'Главная', 'index.php', '-1', '1', '2');
INSERT INTO `wcf_navigation_links` VALUES ('3', 'Форум', 'forum/index.php', '-1', '1', '3');
INSERT INTO `wcf_news` VALUES ('1', '2012-01-26 15:51:10', '5', 'От разработчика', '1', '1', '<p>wcf успешно установлен и готов к использованию!</p>', '<p>wcf успешно установлен и готов к использованию!</p>', '-1', '1');
INSERT INTO `wcf_news` VALUES ('4', '2012-01-26 15:39:43', '5', 'Десятка умерших аддонов', '1', '1', '<p>Не секрет что Близзард любят заимствовать иде у различного вида проектов. Получается это у них отменно, именно поэтому треть их бюджета уходит на судебные разбирательства. Но вот о внутреннем заимствовании мало кто задумывается. А именно заимствование аддонов, которые пользователи создают за бесплатно и продвигают в массы. Ну а Blizzard берут идею и подгребают под себя с выходом очередного патча.</p>\r\n<p><br /> <strong>Десяток аддонов, пострадавших от инициативы Blizzard:<br /> </strong><br /> <strong><span><strong><strong>QuestHelper</strong></strong></span> </strong>- Самый популярный аддон для The Burning Crusade, и Начальных версий Wrath of the Lich King, но после патча 3.3, про него многие забыли, ибо Blizzard придумали свой \\\\\\\"Квест хелпер\\\\\\\", который понравился многим намного больше аддона. По большей части потому, что он не требовал так много ресурсов от вашей машины...</p>', '<p>Не секрет что Близзард любят заимствовать иде у различного вида проектов. Получается это у них отменно, именно поэтому треть их бюджета уходит на судебные разбирательства. Но вот о внутреннем заимствовании мало кто задумывается. А именно заимствование аддонов, которые пользователи создают за бесплатно и продвигают в массы. Ну а Blizzard берут идею и подгребают под себя с выходом очередного патча. <br /> <strong>Десяток аддонов, пострадавших от инициативы Blizzard:<br /> </strong><br /> <strong>QuestHelper </strong>- Самый популярный аддон для The Burning Crusade, и Начальных версий Wrath of the Lich King, но после патча 3.3, про него многие забыли, ибо Blizzard придумали свой \\\\\\\"Квест хелпер\\\\\\\", который понравился многим намного больше аддона. По большей части потому, что он не требовал так много ресурсов от вашей машины.<br /> <br /> <br /> <strong>Cartographer</strong> - В былое время был популярен не менее чем QuestHelper, ибо с ним вместе они работали на славу и помогали проходить квесты не одному поколению Воверов, но после патча 3.0 Блззард кардинально изменили систему определения локаций, поэтому разработчик прекратил дальнейшую модификацию этого аддона.<br /> <br /> <strong><span>Outfitter </span></strong>- Не каждый мог себе позволить носить при себе сразу два сета, для PVE и PVP, но те кто мог использовали Outfitter для быстрой смены экипировки. И вот начиная с патча 3.1.2, Близзард решили сделать свой Outfitter и назвали его \\\\\\\"Управление экипировкой\\\\\\\".<br /> <br /> <strong><span>FloTotemBar</span></strong> - Излюбленный аддон для шаманов ровно до патча 3.x, точно не помню в каком именно патче разработчики игры решили позаимствовать идею отдельных панелей для тотемов. Теперь использовать Тотем бар будут наверно только те, кому не нравиться стандартный интерфейс.<br /> <br /> <strong><span>VuhDo</span></strong> - Изменял интерфейс рейд-иконок. и позволял лечащим классам чувствовать себя увереннее.<br /> <br /> <strong><strong><span>Grid </span></strong></strong>- Так же как и VuhDo аддон был полностью перенесен в интерфейс игры разработчиками, начиная с патча 4.0.1. Поэтому в Катаклизме у этих двух аддонов перспективы на существование нету.<br /> <br /> Group Calendar - Аддон прижился далеко не во всех гильдиях, ибо заставить всех установить его было не легкой задачей. Теперь в этом нет необходимости, так как календарь появился по умолчанию.<br /> <br /> AVR - Помогал организовать рейды, в плане управления толпой. Некоторые рейды без этого аддона были бы просто большим бестолковым пати. Но до катаклизма аддон не дожил ибо Близы официально его запретили, а в катаклизме сделали свою, более простую и красивую версию данного аддона.<br /> <br /> EquipCompare - Как сравнить шмотку надетую на вас, с той что в инвентаре или магазине? Ну естественно надо нажать кнопку Shift, но ранее такой опции в игре не было, и для этого был придуман EquipCompare. После выхода WotLK про аддон забыли, но его по прежнему разрабатывают.<br /> <br /> Buff Timers - Отличная модификация иконок Бафов, времен Пылающего Легиона. Аддон добавлял таймеры возле картинок бафов или дебафов, что позволяло узнать когда он спадет. Удивительно как Близард сразу не додумались такое интегрировать в интерфейс? Теперь в этом аддоне нет нужды, по понятным всем причинам.<br /> <br /> Не смотря на то, что в свое время Близард даже пытались запретить донат за аддоны, которые созданы сторонними разработчиками для улучшения игры, и делают ее интереснее. В сети все ровно появляются все новые и новые модификации, и как бы Близард не бесилась по этому поводу, прогресс не остановить, как и тот факт что весь прогресс будет в итоге присвоен \\\\\\\"Конторой\\\\\\\".</p>', '-1', '0');
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
INSERT INTO `wcf_panels` VALUES ('1', 'navigation_panel', 'file', '-1', '1', '1', '1', '0');
INSERT INTO `wcf_panels` VALUES ('2', 'user_info_panel', 'file', '-1', '4', '1', '1', '0');
INSERT INTO `wcf_panels` VALUES ('3', 'welcome_message_panel', 'file', '-1', '2', '1', '1', '0');
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
INSERT INTO `wcf_settings` VALUES ('page_admin_news', '10');
INSERT INTO `wcf_settings` VALUES ('license_agreement', 'Регистрация учётной записи для игры в WoW на нашем сервере. Внимательно, правильно заполните все поля этой формы. Особое внимание обращаем на правильность ввода E-mailа, т.к. многие операции с учётными записями и персонажами требуют подтверждения по электронной почте. Имя учётной записи и пароль не должны совпадать.<hr>Большая просьба не регистрировать учётные записи, содержащие русские буквы, а то вы не сможете правильно подключиться к серверу.<hr> Удачной вам игры. Спасибо за внимание.<br>');
INSERT INTO `wcf_settings` VALUES ('permit_registration', '1');
INSERT INTO `wcf_users` VALUES ('1', 'ADMINISTRATOR', '0', '');
INSERT INTO `wcf_users` VALUES ('2', 'GAMEMASTER', '0', '');
INSERT INTO `wcf_users` VALUES ('3', 'MODERATOR', '0', '');
INSERT INTO `wcf_users` VALUES ('4', 'PLAYER', '1', '');
INSERT INTO `wcf_users` VALUES ('5', 'LOVEPSONE', '0', '');
