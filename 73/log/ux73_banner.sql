/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50611
Source Host           : localhost:3306
Source Database       : ux73

Target Server Type    : MYSQL
Target Server Version : 50611
File Encoding         : 65001

Date: 2015-05-07 15:01:56
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `ux73_banner`
-- ----------------------------
DROP TABLE IF EXISTS `ux73_banner`;
CREATE TABLE `ux73_banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bid` bigint(20) DEFAULT NULL COMMENT '使用的Id',
  `aid` bigint(20) DEFAULT NULL COMMENT '发布者UID',
  `time` int(11) DEFAULT NULL COMMENT '发布时间',
  `status` int(1) DEFAULT '0' COMMENT '状态 0=关闭、1=开启',
  `src` varchar(500) DEFAULT NULL COMMENT '图片地址',
  `cid` bigint(20) DEFAULT '0' COMMENT '关联的内容',
  `tid` bigint(20) DEFAULT '0' COMMENT '关联的标题',
  `order` int(11) DEFAULT '0' COMMENT '显示顺序，从小往大的顺序显示',
  `note` text COMMENT '注释',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ux73_banner
-- ----------------------------
INSERT INTO `ux73_banner` VALUES ('1', '731429112068', null, '1429112068', '1', './images/1.jpg', '321427775977', '0', '3', '广告公司');
INSERT INTO `ux73_banner` VALUES ('2', '1429112338', null, '1429112265', '1', './images/004.jpg', '0', '291429156432', '2', '游记专题');
INSERT INTO `ux73_banner` VALUES ('3', '1429112516', null, '1429112443', '1', './images/005.jpg', '0', '271430890209', '1', '第2期活动');
