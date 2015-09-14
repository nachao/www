/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50611
Source Host           : localhost:3306
Source Database       : ux73

Target Server Type    : MYSQL
Target Server Version : 50611
File Encoding         : 65001

Date: 2015-09-14 08:03:04
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `ux73_main_content`
-- ----------------------------
DROP TABLE IF EXISTS `ux73_main_content`;
CREATE TABLE `ux73_main_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cid` int(11) DEFAULT '0' COMMENT '内容唯一编号',
  `id_uid` int(11) DEFAULT '0' COMMENT '用户唯一编号',
  `id_lid` int(11) DEFAULT '0' COMMENT '标签唯一编号',
  `id_tid` int(11) DEFAULT '0' COMMENT '标题唯一编号',
  `main_text` text CHARACTER SET gbk COMMENT '文本内容',
  `main_input` text COMMENT '链接、图片、视频、音乐各种地址链接',
  `number_zan` int(11) DEFAULT '0' COMMENT '点赞总量',
  `number_sum` int(11) DEFAULT '0' COMMENT '收入积分总量',
  `number_see` int(11) DEFAULT '0' COMMENT '查看总次数',
  `number_consume` int(11) DEFAULT '0' COMMENT '发布所消耗的金额（单位：分）',
  `time_base` int(11) DEFAULT '0' COMMENT '发布时间',
  `time_revise` int(11) DEFAULT '0' COMMENT '最近一次修改时间',
  `status_verify` int(1) DEFAULT '0' COMMENT '状态；0=正常、2=关闭、1=被查',
  `status_type` int(1) DEFAULT '0' COMMENT '0=文本；1=图片；2=视频；3=音乐；4=链接',
  `status_effects` int(1) DEFAULT '0' COMMENT '标示：1=顶（作者）、2=推荐（题主）',
  `title_shareglod` int(11) DEFAULT '0' COMMENT '分享金赞助金额',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ux73_main_content
-- ----------------------------
