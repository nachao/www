/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50611
Source Host           : localhost:3306
Source Database       : ux73

Target Server Type    : MYSQL
Target Server Version : 50611
File Encoding         : 65001

Date: 2015-05-07 15:15:38
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `ux73_classify`
-- ----------------------------
DROP TABLE IF EXISTS `ux73_classify`;
CREATE TABLE `ux73_classify` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tid` varchar(30) DEFAULT NULL,
  `userid` varchar(30) DEFAULT NULL,
  `title` varchar(500) CHARACTER SET gbk DEFAULT NULL,
  `content` text CHARACTER SET gbk,
  `price` int(11) DEFAULT NULL COMMENT '金池',
  `click` int(11) DEFAULT '0' COMMENT '购买数量',
  `number` int(11) DEFAULT '0' COMMENT '内容数量',
  `duration` int(15) DEFAULT NULL COMMENT '活动结束时间',
  `reward` int(11) DEFAULT NULL COMMENT '第一名奖金',
  `first` int(11) DEFAULT NULL COMMENT '现在标记的第一名',
  `admin` int(11) DEFAULT NULL COMMENT '管理员ID',
  `applytime` int(15) DEFAULT NULL COMMENT '申请时间',
  `useTime` int(20) DEFAULT NULL COMMENT '最近使用时间',
  `start` int(11) DEFAULT '0' COMMENT '状态：0=未审核；1=正常；2=未通过；3=关',
  `shareglod` int(1) DEFAULT '4' COMMENT '标题分享金',
  `type` int(11) DEFAULT '1' COMMENT '标题的类型：1=活动；2=专题；',
  `withholding` int(1) DEFAULT '2' COMMENT '金池不足时，是否从余额里代扣，1=否（默）、2=是',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=60 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ux73_classify
-- ----------------------------
INSERT INTO `ux73_classify` VALUES ('45', '271427702349', '201427430248', '七十三号展馆 - 最美个人随拍', '很多爱美的女孩都喜欢拍昆明个人写真，那么如何才能拍出完美的写真呢？怎样拍才是最美的呢？不妨听听专业人士的建议吧：\n<br />你如果想让自己的写真完美，最重要的是选择一家专业的昆明写真店，因为专业的摄影机构，摄影师的技术都不会差的。要知道拍照摄影师是很重要的哦!\n<br />其次就是找一个资深的礼服师帮助自己服装，好的礼服师会根据你自身的气质给你作出适合你的推荐。为你选到适合的服装，这样离完美的昆明个人写真照又近了一步。\n<br />接着就是妆面造型了，想让自己的照片拍得更自然一些，最好就选择清新自然的妆容，搭配上精致的发型，完美时尚妆容就出炉了。', '48', '19', '18', '1428307149', '30000', '2147483647', null, '1427702349', '1427881009', '3', '6', '1', '2');
INSERT INTO `ux73_classify` VALUES ('44', '271427432282', '201427430248', '川西游记.docx', '不得不承认我是一个比较随性又比较懒得一个人，时隔小半年才开始整理游记，我总是抱着故事总要沉淀过后才更能散发出它该有的味道的心态。经过时间的沉淀，除去新鲜感之类的感情外，剩下的应该更多的是一种怀念与感悟，在许久之后更加显得风韵犹存。\n很多人问过我，一个人行走难道不孤独吗？是的，我曾经反思过这个问题，也质疑过这个问题。在路上漂泊的日子如果说没有孤独是不可能的，完全与外界失联的4天，在徒步雨崩因为体力不支被队友甩下很远，在空无一人的房间辗转反侧或者一系列，都可以称之为“孤独”。但是我学会了享受孤独，所以我愿意更加倾向于一个人行走在路上。或许正是这种孤独教会我成长与沉淀，我很庆幸我的人生中能有那么几个值得骄傲、可歌可泣的故事，很多匆匆一别的甲乙丙也正是这些故事的主角。我同时也很庆幸，我会成为甲乙丙故事中的主角。“孤独”一词对我而言，更像是“沉淀”。', '0', '16', '15', '1427956354', '0', null, null, '1427432282', '1427701934', '3', '4', '2', '2');
INSERT INTO `ux73_classify` VALUES ('49', '291429156364', '101427698727', '最“美”的照片', '通过所有用户的投票点评方式，投票最多者获胜。\r<br />照片类型不限、来源不限、尺寸不限。', '113', '3', '2', '1429761164', '1000', '2147483647', null, '1429156364', '1429159426', '3', '4', '1', '2');
INSERT INTO `ux73_classify` VALUES ('50', '291429156432', '101427698727', '婉瑜的游记', '这是一个人记录旅行的日志，分享给大家。', '4', '1', '0', '1429236418', '0', null, null, '1429156432', '1429156432', '3', '0', '2', '1');
INSERT INTO `ux73_classify` VALUES ('51', '271429533688', '201427430248', '英雄联盟最“拽”英雄', '请尽量上传官方的原画图片，请不要重复发布。', '100', '0', '0', '1430138488', '1000', null, null, '1429533688', null, '3', '4', '1', '2');
INSERT INTO `ux73_classify` VALUES ('52', '271429533885', '201427430248', '分享自己喜欢的“女神”的照片', '每个人总会有很喜欢的女士，或者女孩。分享看看谁的女神人气最高！', '100', '0', '0', '1430138685', '500', null, null, '1429533885', null, '3', '4', '1', '2');
INSERT INTO `ux73_classify` VALUES ('53', '271429534005', '201427430248', '说说你最喜欢的一首歌。', '可以是轻音乐、摇滚、流行...表示个人最喜欢《葫芦娃》~', '100', '0', '0', '1430138805', '1000', null, null, '1429534005', null, '3', '4', '1', '2');
INSERT INTO `ux73_classify` VALUES ('54', '271429534388', '201427430248', '最喜欢的一本书', '说说最近最喜欢的一本书，或者曾经读过的最喜欢的一本书。\r<br />—— 想想，我最喜欢的应该是《天才在左，疯子在右》吧，内容有趣且知道了不少神一样存在的人。', '100', '0', '0', '1430139188', '1000', null, null, '1429534388', null, '3', '4', '1', '2');
INSERT INTO `ux73_classify` VALUES ('55', '271429535057', '201427430248', '说走就走，这一刻最想去哪？', '每个人都有这样的冲动，有的人去了，有的人计划去，有的人想去且没去。\r<br />说说这一刻想去哪呢？\r<br />有图最好哈！\r<br />', '100', '0', '0', '1430139857', '1000', null, null, '1429535057', null, '3', '4', '1', '2');
INSERT INTO `ux73_classify` VALUES ('56', '271429535291', '201427430248', '说出自己喜欢最喜欢的“电影”', '可以简单的文字描述，也可以加上海报，当然如果你加上视频连接也是可以的。', '96', '0', '1', '1430140091', '500', '2147483647', null, '1429535291', '1429605628', '3', '4', '1', '2');
INSERT INTO `ux73_classify` VALUES ('58', '271430234778', '201427430248', '大鱼杯 · 最美照片 · 第 1 期', '类型不限，来源不限，尺寸不限。 \r<br />但，反黄反暴力', '99', '20', '19', '1430839578', '5000', '2147483647', null, '1430234778', '1430575364', '3', '4', '1', '2');
INSERT INTO `ux73_classify` VALUES ('59', '271430890209', '201427430248', '大鱼杯 · 最美照片 · 第 2 期', '类型不限，来源不限，尺寸不限。 \n<br />但，反黄反暴力', '72', '0', '7', '1431495009', '5000', '2147483647', null, '1430890209', '1430980756', '1', '4', '1', '2');