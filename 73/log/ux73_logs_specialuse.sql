/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50611
Source Host           : localhost:3306
Source Database       : ux73

Target Server Type    : MYSQL
Target Server Version : 50611
File Encoding         : 65001

Date: 2015-05-13 13:43:45
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `ux73_logs_specialuse`
-- ----------------------------
DROP TABLE IF EXISTS `ux73_logs_specialuse`;
CREATE TABLE `ux73_logs_specialuse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` bigint(20) DEFAULT NULL COMMENT '用户的 UID',
  `sid` bigint(20) DEFAULT NULL COMMENT '图标的 ID',
  `time` bigint(20) DEFAULT NULL COMMENT '领取时间',
  `receive` bigint(20) DEFAULT NULL COMMENT '福利领取时间，每天 0 点为一次可领取',
  `status` int(11) DEFAULT '1' COMMENT '状态：1=有效；n=关闭时间戳',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=utf8 COMMENT='用户徽章使用记录表';

-- ----------------------------
-- Records of ux73_logs_specialuse
-- ----------------------------
INSERT INTO `ux73_logs_specialuse` VALUES ('101', '201427430248', '101', '1431408631', '0', '1431495088');
INSERT INTO `ux73_logs_specialuse` VALUES ('102', '111427723099', '102', '1431408631', '0', '1431495088');
INSERT INTO `ux73_logs_specialuse` VALUES ('103', '131427770385', '103', '1431408631', '0', '1431495088');
INSERT INTO `ux73_logs_specialuse` VALUES ('104', '201427430248', '101', '1431495088', '0', '1');
INSERT INTO `ux73_logs_specialuse` VALUES ('105', '131427770385', '102', '1431495088', '0', '1');
INSERT INTO `ux73_logs_specialuse` VALUES ('106', '101427698727', '103', '1431495088', '0', '1');
