/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50611
Source Host           : localhost:3306
Source Database       : ux73

Target Server Type    : MYSQL
Target Server Version : 50611
File Encoding         : 65001

Date: 2015-09-13 08:46:38
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `73_main_content`
-- ----------------------------
DROP TABLE IF EXISTS `73_main_content`;
CREATE TABLE `73_main_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '唯一编号',
  `ic_cid` int(11) DEFAULT '0' COMMENT '内容唯一编号',
  `id_uid` int(11) DEFAULT '0',
  `id_lid` int(11) DEFAULT '0',
  `id_tid` int(11) DEFAULT '0',
  `text_depict` text,
  `text_input` varchar(100) DEFAULT NULL,
  `number_zan` int(11) DEFAULT '0',
  `number_sum` int(11) DEFAULT '0',
  `number_see` int(11) DEFAULT '0',
  `number_consume` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of 73_main_content
-- ----------------------------
