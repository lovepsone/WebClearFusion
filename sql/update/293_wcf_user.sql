-- ----------------------------
-- Table structure for wcf_user
-- ----------------------------
ALTER TABLE `wcf_users` ADD COLUMN `email` text AFTER `user_gmlevel`;
ALTER TABLE `wcf_users` ADD COLUMN `user_last_ip` varchar(30) NOT NULL default '0.0.0.0' AFTER `user_avatar`;