/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50611
Source Host           : localhost:3306
Source Database       : ux73

Target Server Type    : MYSQL
Target Server Version : 50611
File Encoding         : 65001

Date: 2015-05-07 15:02:51
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `ux73_notice`
-- ----------------------------
DROP TABLE IF EXISTS `ux73_notice`;
CREATE TABLE `ux73_notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(500) DEFAULT NULL COMMENT '描述',
  `status` int(1) DEFAULT '0' COMMENT '状态 1=开启，0=关闭',
  `time` int(11) DEFAULT '0' COMMENT '发布日期',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ux73_notice
-- ----------------------------
INSERT INTO `ux73_notice` VALUES ('2', '七十三号展馆内测正常开始，每天会放出少量的邀请码。', '1', '1430834444');
INSERT INTO `ux73_notice` VALUES ('3', '测试期间收入为正常的&275&27倍，此收入仅限作者，标题不变。', '1', '1430836348');
INSERT INTO `ux73_notice` VALUES ('5', '新加入了 《标题金池共享》 功能，每个用户都可以成为标题的赞助者，和题主一起大赚特赚。', '1', '1430836482');
INSERT INTO `ux73_notice` VALUES ('6', '【新加入功能】发布内容时，可以选择“推送”，用户支付 1 元，内容随机分配0.60元至1.10元之间。', '1', '1430981973');
