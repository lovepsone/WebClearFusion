/*
MySQL Data Transfer
Source Host: localhost
Source Database: wcf
Target Host: localhost
Target Database: wcf
Date: 31.01.2012 20:15:48
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for wcf_spell_duration
-- ----------------------------
DROP TABLE IF EXISTS `wcf_spell_duration`;
CREATE TABLE `wcf_spell_duration` (
  `id` int(10) unsigned NOT NULL default '0',
  `duration_1` int(11) default NULL,
  `duration_2` int(11) default NULL,
  `duration_3` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `wcf_spell_duration` VALUES ('1', '10000', '0', '10000');
INSERT INTO `wcf_spell_duration` VALUES ('2', '300000010', '0', '30000');
INSERT INTO `wcf_spell_duration` VALUES ('3', '60000', '0', '60000');
INSERT INTO `wcf_spell_duration` VALUES ('4', '120000', '0', '120000');
INSERT INTO `wcf_spell_duration` VALUES ('5', '300000', '0', '300000');
INSERT INTO `wcf_spell_duration` VALUES ('6', '600000', '0', '600000');
INSERT INTO `wcf_spell_duration` VALUES ('7', '5000000', '0', '5000');
INSERT INTO `wcf_spell_duration` VALUES ('8', '15000', '0', '15000');
INSERT INTO `wcf_spell_duration` VALUES ('9', '30000', '0', '30000');
INSERT INTO `wcf_spell_duration` VALUES ('10', '60000000', '0', '60000');
INSERT INTO `wcf_spell_duration` VALUES ('11', '100000000', '200', '15000');
INSERT INTO `wcf_spell_duration` VALUES ('12', '30000000', '200', '40000');
INSERT INTO `wcf_spell_duration` VALUES ('13', '6000000', '200', '80000');
INSERT INTO `wcf_spell_duration` VALUES ('14', '12000000', '10000', '180000');
INSERT INTO `wcf_spell_duration` VALUES ('15', '30000000', '10000', '420000');
INSERT INTO `wcf_spell_duration` VALUES ('16', '230000', '0', '230000');
INSERT INTO `wcf_spell_duration` VALUES ('17', '5000000', '100', '7000');
INSERT INTO `wcf_spell_duration` VALUES ('18', '20000', '0', '20000');
INSERT INTO `wcf_spell_duration` VALUES ('19', '3000000', '500', '40000');
INSERT INTO `wcf_spell_duration` VALUES ('20', '60000000', '1000', '80000');
INSERT INTO `wcf_spell_duration` VALUES ('21', '2147483647', '0', '2147483647');
INSERT INTO `wcf_spell_duration` VALUES ('22', '45000', '0', '45000');
INSERT INTO `wcf_spell_duration` VALUES ('23', '90000', '0', '90000');
INSERT INTO `wcf_spell_duration` VALUES ('24', '160000', '0', '160000');
INSERT INTO `wcf_spell_duration` VALUES ('25', '180000', '0', '180000');
INSERT INTO `wcf_spell_duration` VALUES ('26', '240000', '0', '240000');
INSERT INTO `wcf_spell_duration` VALUES ('27', '3000', '0', '3000');
INSERT INTO `wcf_spell_duration` VALUES ('28', '5000', '0', '5000');
INSERT INTO `wcf_spell_duration` VALUES ('29', '12000', '0', '12000');
INSERT INTO `wcf_spell_duration` VALUES ('30', '1800000', '0', '1800000');
INSERT INTO `wcf_spell_duration` VALUES ('31', '8000', '0', '8000');
INSERT INTO `wcf_spell_duration` VALUES ('32', '6000', '0', '6000');
INSERT INTO `wcf_spell_duration` VALUES ('35', '4000', '0', '4000');
INSERT INTO `wcf_spell_duration` VALUES ('36', '1000', '0', '1000');
INSERT INTO `wcf_spell_duration` VALUES ('37', '1', '0', '1');
INSERT INTO `wcf_spell_duration` VALUES ('38', '11000', '0', '11000');
INSERT INTO `wcf_spell_duration` VALUES ('39', '2000', '0', '2000');
INSERT INTO `wcf_spell_duration` VALUES ('40', '1200000', '0', '1200000');
INSERT INTO `wcf_spell_duration` VALUES ('41', '360000', '0', '360000');
INSERT INTO `wcf_spell_duration` VALUES ('42', '3600000', '0', '3600000');
INSERT INTO `wcf_spell_duration` VALUES ('62', '75000', '0', '75000');
INSERT INTO `wcf_spell_duration` VALUES ('63', '25000', '0', '25000');
INSERT INTO `wcf_spell_duration` VALUES ('64', '40000', '0', '40000');
INSERT INTO `wcf_spell_duration` VALUES ('65', '1500', '0', '1500');
INSERT INTO `wcf_spell_duration` VALUES ('66', '2500', '0', '2500');
INSERT INTO `wcf_spell_duration` VALUES ('85', '18000', '0', '18000');
INSERT INTO `wcf_spell_duration` VALUES ('86', '21000', '0', '21000');
INSERT INTO `wcf_spell_duration` VALUES ('105', '9000', '0', '9000');
INSERT INTO `wcf_spell_duration` VALUES ('106', '24000', '0', '24000');
INSERT INTO `wcf_spell_duration` VALUES ('125', '35000', '0', '35000');
INSERT INTO `wcf_spell_duration` VALUES ('145', '2700000', '0', '2700000');
INSERT INTO `wcf_spell_duration` VALUES ('165', '7000', '0', '7000');
INSERT INTO `wcf_spell_duration` VALUES ('185', '6000', '0', '21000');
INSERT INTO `wcf_spell_duration` VALUES ('186', '2000', '0', '22000');
INSERT INTO `wcf_spell_duration` VALUES ('187', '0', '0', '5000');
INSERT INTO `wcf_spell_duration` VALUES ('205', '27000', '0', '27000');
INSERT INTO `wcf_spell_duration` VALUES ('225', '604800000', '0', '604800000');
INSERT INTO `wcf_spell_duration` VALUES ('245', '50000', '0', '50000');
INSERT INTO `wcf_spell_duration` VALUES ('265', '55000', '0', '55000');
INSERT INTO `wcf_spell_duration` VALUES ('285', '1000', '0', '6000');
INSERT INTO `wcf_spell_duration` VALUES ('305', '14000', '0', '14000');
INSERT INTO `wcf_spell_duration` VALUES ('325', '36000', '0', '36000');
INSERT INTO `wcf_spell_duration` VALUES ('326', '44000', '0', '44000');
INSERT INTO `wcf_spell_duration` VALUES ('327', '500', '0', '500');
INSERT INTO `wcf_spell_duration` VALUES ('328', '250', '0', '250');
INSERT INTO `wcf_spell_duration` VALUES ('347', '900000', '0', '900000');
INSERT INTO `wcf_spell_duration` VALUES ('367', '7200000', '0', '7200000');
INSERT INTO `wcf_spell_duration` VALUES ('387', '16000', '0', '16000');
INSERT INTO `wcf_spell_duration` VALUES ('407', '100', '0', '100');
INSERT INTO `wcf_spell_duration` VALUES ('427', '2147483647', '60000', '600000');
INSERT INTO `wcf_spell_duration` VALUES ('447', '2000', '0', '6000');
INSERT INTO `wcf_spell_duration` VALUES ('467', '22000', '0', '22000');
INSERT INTO `wcf_spell_duration` VALUES ('468', '26000', '0', '26000');
INSERT INTO `wcf_spell_duration` VALUES ('487', '1700', '0', '1700');
INSERT INTO `wcf_spell_duration` VALUES ('507', '1100', '0', '1100');
INSERT INTO `wcf_spell_duration` VALUES ('508', '1100', '0', '1100');
INSERT INTO `wcf_spell_duration` VALUES ('527', '14400000', '0', '14400000');
INSERT INTO `wcf_spell_duration` VALUES ('547', '5400000', '0', '5400000');
INSERT INTO `wcf_spell_duration` VALUES ('548', '10800000', '0', '10800000');
INSERT INTO `wcf_spell_duration` VALUES ('549', '3800', '0', '3800');
INSERT INTO `wcf_spell_duration` VALUES ('550', '2147483647', '0', '2147483647');
INSERT INTO `wcf_spell_duration` VALUES ('551', '3500', '0', '3500');
INSERT INTO `wcf_spell_duration` VALUES ('552', '210000', '0', '210000');
INSERT INTO `wcf_spell_duration` VALUES ('553', '6000', '0', '16000');
INSERT INTO `wcf_spell_duration` VALUES ('554', '155000', '0', '155000');
INSERT INTO `wcf_spell_duration` VALUES ('555', '4500', '0', '4500');
INSERT INTO `wcf_spell_duration` VALUES ('556', '28000', '0', '28000');
INSERT INTO `wcf_spell_duration` VALUES ('557', '165000', '0', '165000');
INSERT INTO `wcf_spell_duration` VALUES ('558', '114000', '0', '114000');
INSERT INTO `wcf_spell_duration` VALUES ('559', '53000', '0', '53000');
INSERT INTO `wcf_spell_duration` VALUES ('560', '299000', '0', '299000');
INSERT INTO `wcf_spell_duration` VALUES ('561', '3300000', '0', '3300000');
INSERT INTO `wcf_spell_duration` VALUES ('562', '150000', '0', '150000');
INSERT INTO `wcf_spell_duration` VALUES ('563', '20500', '0', '20500');
INSERT INTO `wcf_spell_duration` VALUES ('564', '13000', '0', '13000');
INSERT INTO `wcf_spell_duration` VALUES ('565', '70000', '0', '70000');
INSERT INTO `wcf_spell_duration` VALUES ('566', '0', '0', '0');
INSERT INTO `wcf_spell_duration` VALUES ('567', '135000', '0', '135000');
INSERT INTO `wcf_spell_duration` VALUES ('568', '1250', '0', '1250');
INSERT INTO `wcf_spell_duration` VALUES ('569', '280000', '0', '280000');
INSERT INTO `wcf_spell_duration` VALUES ('570', '32000', '0', '32000');
INSERT INTO `wcf_spell_duration` VALUES ('571', '5500', '0', '5500');
INSERT INTO `wcf_spell_duration` VALUES ('572', '100000', '0', '100000');
INSERT INTO `wcf_spell_duration` VALUES ('573', '11999900', '0', '11999900');
INSERT INTO `wcf_spell_duration` VALUES ('574', '200', '0', '200');
INSERT INTO `wcf_spell_duration` VALUES ('575', '17000', '0', '17000');
INSERT INTO `wcf_spell_duration` VALUES ('576', '43200000', '0', '43200000');
INSERT INTO `wcf_spell_duration` VALUES ('577', '160000', '0', '160000');
INSERT INTO `wcf_spell_duration` VALUES ('578', '14250', '0', '14250');
INSERT INTO `wcf_spell_duration` VALUES ('579', '170000', '0', '170000');
INSERT INTO `wcf_spell_duration` VALUES ('580', '64800000', '0', '64800000');
INSERT INTO `wcf_spell_duration` VALUES ('581', '9000', '0', '34000');
INSERT INTO `wcf_spell_duration` VALUES ('582', '3200', '0', '3200');
INSERT INTO `wcf_spell_duration` VALUES ('583', '600', '0', '600');
INSERT INTO `wcf_spell_duration` VALUES ('584', '800', '0', '800');
INSERT INTO `wcf_spell_duration` VALUES ('585', '0', '0', '0');
INSERT INTO `wcf_spell_duration` VALUES ('586', '0', '0', '25000');
INSERT INTO `wcf_spell_duration` VALUES ('587', '31000', '0', '31000');
INSERT INTO `wcf_spell_duration` VALUES ('588', '0', '0', '30000');
INSERT INTO `wcf_spell_duration` VALUES ('589', '6500', '0', '6500');
INSERT INTO `wcf_spell_duration` VALUES ('590', '330000', '0', '330000');
INSERT INTO `wcf_spell_duration` VALUES ('591', '80000', '0', '80000');
INSERT INTO `wcf_spell_duration` VALUES ('592', '400', '0', '400');
INSERT INTO `wcf_spell_duration` VALUES ('593', '300', '0', '300');
INSERT INTO `wcf_spell_duration` VALUES ('594', '660000', '0', '660000');
INSERT INTO `wcf_spell_duration` VALUES ('596', '900', '0', '900');
INSERT INTO `wcf_spell_duration` VALUES ('597', '4700', '0', '4700');
