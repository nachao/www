/*
Navicat MySQL Data Transfer

<<<<<<< HEAD
Source Server         : localhost
Source Server Version : 50611
Source Host           : localhost:3306
Source Database       : ux73

Target Server Type    : MYSQL
Target Server Version : 50611
File Encoding         : 65001

Date: 2015-05-21 15:04:30
=======
Source Server         : ux73
Source Server Version : 50169
Source Host           : ux73.gotoftp2.com:3306
Source Database       : ux73

Target Server Type    : MYSQL
Target Server Version : 50169
File Encoding         : 65001

Date: 2015-05-22 21:21:30
>>>>>>> 22d1fbeec651a1ccd690a68550ffc1e56515afeb
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `ux73_label`
-- ----------------------------
DROP TABLE IF EXISTS `ux73_label`;
CREATE TABLE `ux73_label` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lid` bigint(20) DEFAULT NULL COMMENT '标签唯一ID',
  `uid` bigint(20) DEFAULT NULL,
  `tid` bigint(20) DEFAULT NULL,
  `time` int(11) DEFAULT NULL COMMENT '创建时间',
  `status` int(1) DEFAULT '1' COMMENT '状态：0=关闭；1=开启',
  `name` varchar(100) DEFAULT NULL COMMENT '标签名',
  PRIMARY KEY (`id`)
<<<<<<< HEAD
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8;
=======
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8;
>>>>>>> 22d1fbeec651a1ccd690a68550ffc1e56515afeb

-- ----------------------------
-- Records of ux73_label
-- ----------------------------
INSERT INTO `ux73_label` VALUES ('56', '14315388050', '101427698727', '291431350032', '1431538805', '1', '最后的香格里拉（上）');
INSERT INTO `ux73_label` VALUES ('57', '14315388061', '101427698727', '291431350032', '1431538806', '1', '城市、远方和故乡');
INSERT INTO `ux73_label` VALUES ('58', '14315388072', '101427698727', '291431350032', '1431538807', '1', '旅行，让生命从容');
INSERT INTO `ux73_label` VALUES ('59', '14315388123', '101427698727', '291431350032', '1431538812', '1', '徒搭去圣地（上）');
INSERT INTO `ux73_label` VALUES ('60', '14315388144', '101427698727', '291431350032', '1431538814', '1431538824', '1');
INSERT INTO `ux73_label` VALUES ('61', '14315388165', '101427698727', '291431350032', '1431538816', '1431538840', '1');
INSERT INTO `ux73_label` VALUES ('62', '14315388196', '101427698727', '291431350032', '1431538819', '1431538847', '1');
INSERT INTO `ux73_label` VALUES ('63', '14315388316', '101427698727', '291431350032', '1431538831', '1431538836', '1');
INSERT INTO `ux73_label` VALUES ('64', '14315388386', '101427698727', '291431350032', '1431538838', '1431538857', '1');
INSERT INTO `ux73_label` VALUES ('65', '14315388446', '101427698727', '291431350032', '1431538844', '1', '徒搭去圣地 - （下）');
INSERT INTO `ux73_label` VALUES ('66', '14315388496', '101427698727', '291431350032', '1431538849', '1', '转山转水只为你');
<<<<<<< HEAD
INSERT INTO `ux73_label` VALUES ('67', '14315388596', '101427698727', '291431350032', '1431538859', '1', '朝圣，梅里');
=======
INSERT INTO `ux73_label` VALUES ('67', '14315388596', '101427698727', '291431350032', '1431538859', '1432192038', '朝圣，梅里');
INSERT INTO `ux73_label` VALUES ('68', '14321920446', '101427698727', '291431350032', '1432192044', '1', '最后的香格里拉 （下）');
>>>>>>> 22d1fbeec651a1ccd690a68550ffc1e56515afeb
