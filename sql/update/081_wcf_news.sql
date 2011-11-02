DROP TABLE IF EXISTS `wcf_news`;
CREATE TABLE `wcf_news` (
  `news_id` int(11) unsigned NOT NULL auto_increment,
  `news_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `news_title` longtext,
  `news_text` longtext,
  `news_cat` tinyint(3) unsigned default '0',
  PRIMARY KEY  (`news_id`),
  UNIQUE KEY `news_id` (`news_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `wcf_news` VALUES ('1', '2010-05-28 21:04:49', 'От разработчика.', 'WCF успешно установлен.', '0');
