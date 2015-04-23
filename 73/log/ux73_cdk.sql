/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50611
Source Host           : localhost:3306
Source Database       : ux73

Target Server Type    : MYSQL
Target Server Version : 50611
File Encoding         : 65001

Date: 2015-04-18 00:17:31
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `ux73_cdk`
-- ----------------------------
DROP TABLE IF EXISTS `ux73_cdk`;
CREATE TABLE `ux73_cdk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cdk` varchar(30) DEFAULT '0' COMMENT '激活码',
  `time` int(11) DEFAULT '0' COMMENT '被使用的时间',
  `uid` bigint(20) DEFAULT '0' COMMENT '被使用的用户ID',
  `status` int(1) DEFAULT '1' COMMENT '1=正常、0=被使用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=192 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ux73_cdk
-- ----------------------------
INSERT INTO `ux73_cdk` VALUES ('162', 'b00beaa6d5', '1429287185', '151429287185', '0');
INSERT INTO `ux73_cdk` VALUES ('163', '170397195d', '0', null, '1');
INSERT INTO `ux73_cdk` VALUES ('164', '362e6aff07', '0', null, '1');
INSERT INTO `ux73_cdk` VALUES ('165', '14a34f70ad', '0', null, '1');
INSERT INTO `ux73_cdk` VALUES ('166', 'c193a9169a', '0', null, '1');
INSERT INTO `ux73_cdk` VALUES ('167', 'c6490d6377', '0', null, '1');
INSERT INTO `ux73_cdk` VALUES ('168', '014138b522', '0', null, '1');
INSERT INTO `ux73_cdk` VALUES ('169', 'e96fe8bf48', '0', null, '1');
INSERT INTO `ux73_cdk` VALUES ('170', 'a6497e47a1', '0', null, '1');
INSERT INTO `ux73_cdk` VALUES ('171', 'e544f74612', '0', null, '1');
INSERT INTO `ux73_cdk` VALUES ('172', '368a549bac', '0', null, '1');
INSERT INTO `ux73_cdk` VALUES ('173', 'f0baf8a65d', '0', null, '1');
INSERT INTO `ux73_cdk` VALUES ('174', 'fac4a79675', '0', null, '1');
INSERT INTO `ux73_cdk` VALUES ('181', 'fac4a79675', '0', null, '1');
INSERT INTO `ux73_cdk` VALUES ('182', '0c591a2eec', '0', null, '1');
INSERT INTO `ux73_cdk` VALUES ('183', '8bf95d8fb9', '0', null, '1');
INSERT INTO `ux73_cdk` VALUES ('184', '8ace3f13ad', '0', null, '1');
INSERT INTO `ux73_cdk` VALUES ('191', '87330398bb', '0', null, '1');
