/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50611
Source Host           : localhost:3306
Source Database       : ux73

Target Server Type    : MYSQL
Target Server Version : 50611
File Encoding         : 65001

Date: 2015-04-23 17:16:57
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `ux73_ad`
-- ----------------------------
DROP TABLE IF EXISTS `ux73_ad`;
CREATE TABLE `ux73_ad` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `icon` varchar(200) DEFAULT NULL,
  `link` varchar(100) CHARACTER SET gbk DEFAULT NULL,
  `tit` varchar(500) CHARACTER SET gbk DEFAULT NULL,
  `cue` text CHARACTER SET gbk NOT NULL,
  `num` int(10) NOT NULL,
  `user` varchar(10) CHARACTER SET gbk DEFAULT NULL,
  `userid` bigint(30) NOT NULL,
  `describe` varchar(500) CHARACTER SET utf8 DEFAULT NULL COMMENT '描述 最多500字数',
  `imgs` varchar(100) CHARACTER SET utf8 DEFAULT '' COMMENT '380px*270px 的图片地址',
  `longimgs` varchar(100) CHARACTER SET utf8 DEFAULT '' COMMENT '720px*90px 的图片地址',
  `lastdate` varchar(10) NOT NULL,
  `subsidize` varchar(10) DEFAULT NULL COMMENT '资助金额',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ux73_ad
-- ----------------------------
INSERT INTO `ux73_ad` VALUES ('45', null, '', null, '', '0', null, '0', '', '', './imgs/not-ad.png', '1427721122', '');
INSERT INTO `ux73_ad` VALUES ('50', null, 'www.fashiondes.com/', null, 'FASHIONDES.com', '1', null, '141429156444', 'FASHIONDES.com是国内首个基于读者视野的时尚频道，也是发现一切生活之美的独立平台，实时更新全球热门时尚生活资讯。欢迎投稿与分享。', 'http://webimg1.meitudata.com/201504/16/552f6050de7b0.jpg', 'http://webimg1.meitudata.com/201504/16/552f605d35793.jpg', '1429168256', null);
INSERT INTO `ux73_ad` VALUES ('48', null, 'www.baidu.com', null, '百度图片', '114', null, '101427698727', '全球最大的中文搜索引擎、致力于让网民更便捷地获取信息，找到所求。百度超过千亿的中文网页数据库，可以瞬间找到相关的搜索结果。', 'http://webimg1.meitudata.com/201503/30/55194f16271a9.jpg', 'http://webimg1.meitudata.com/201503/30/55194f28dedc6.jpg', '1427722769', '113');
INSERT INTO `ux73_ad` VALUES ('1', null, null, null, 'FASHIONDES.com', '1', null, '141429156444', 'FASHIONDES.com是国内首个基于读者视野的时尚频道，也是发现一切生活之美的独立平台，实时更新全球热门时尚生活资讯。欢迎投稿与分享。', 'http://webimg1.meitudata.com/201504/16/552f6050de7b0.jpg', 'http://webimg1.meitudata.com/201504/16/552f605d35793.jpg', '1429168601', '');
INSERT INTO `ux73_ad` VALUES ('49', null, 'www.iqiyi.com', null, '爱奇艺-中国领先的视频门户', '114', null, '111427723099', '爱奇艺(iQIYI.COM),网络视频播放平台;是国内首家专注于提供免费、高清网络视频服务的大型视频网站。爱奇艺影视内容丰富多元,涵盖电影、电视剧、综艺、纪录片、动画片...', 'http://webimg1.meitudata.com/201503/30/55195586c3e71.jpg', 'http://webimg1.meitudata.com/201503/30/5519558fd9b7a.jpg', '1427724034', null);

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
INSERT INTO `ux73_banner` VALUES ('1', '731429112068', null, '1429112068', '1', 'http://f.picphotos.baidu.com/album/s%3D1600%3Bq%3D90/sign=84bd4389cc177f3e1434f80b40ff00b6/472309f790529822277be8fcd2ca7bcb0a46d441.jpg', '321427775977', '0', '3', '广告公司');
INSERT INTO `ux73_banner` VALUES ('2', '1429112338', null, '1429112265', '1', 'http://c.picphotos.baidu.com/album/s%3D1600%3Bq%3D90/sign=df3a39cb54da81cb4ae687cb6256eb67/14ce36d3d539b60048a7de88ec50352ac65cb7a0.jpg', '0', '291429156432', '2', '游记专题');
INSERT INTO `ux73_banner` VALUES ('3', '1429112516', null, '1429112443', '1', 'http://b.picphotos.baidu.com/album/s%3D1600%3Bq%3D90/sign=1053a8076b061d957946333e4bc431a0/ca1349540923dd54ef1c7657d409b3de9c8248a6.jpg', '0', '291429156364', '1', '第一期活动');

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
INSERT INTO `ux73_cdk` VALUES ('163', '170397195d', '1429287781', '161429287781', '0');
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
  `recommend` int(1) DEFAULT '1' COMMENT '推荐发布时候的方式 0=文字，1=图片、2=视频、3=音乐',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ux73_classify
-- ----------------------------
INSERT INTO `ux73_classify` VALUES ('45', '271427702349', '201427430248', '七十三号展馆 - 最美个人随拍', '很多爱美的女孩都喜欢拍昆明个人写真，那么如何才能拍出完美的写真呢？怎样拍才是最美的呢？不妨听听专业人士的建议吧：\n<br />你如果想让自己的写真完美，最重要的是选择一家专业的昆明写真店，因为专业的摄影机构，摄影师的技术都不会差的。要知道拍照摄影师是很重要的哦!\n<br />其次就是找一个资深的礼服师帮助自己服装，好的礼服师会根据你自身的气质给你作出适合你的推荐。为你选到适合的服装，这样离完美的昆明个人写真照又近了一步。\n<br />接着就是妆面造型了，想让自己的照片拍得更自然一些，最好就选择清新自然的妆容，搭配上精致的发型，完美时尚妆容就出炉了。', '48', '19', '18', '1428307149', '30000', '2147483647', null, '1427702349', '1427881009', '3', '6', '1', '2', '1');
INSERT INTO `ux73_classify` VALUES ('44', '271427432282', '201427430248', '川西游记.docx', '不得不承认我是一个比较随性又比较懒得一个人，时隔小半年才开始整理游记，我总是抱着故事总要沉淀过后才更能散发出它该有的味道的心态。经过时间的沉淀，除去新鲜感之类的感情外，剩下的应该更多的是一种怀念与感悟，在许久之后更加显得风韵犹存。\n很多人问过我，一个人行走难道不孤独吗？是的，我曾经反思过这个问题，也质疑过这个问题。在路上漂泊的日子如果说没有孤独是不可能的，完全与外界失联的4天，在徒步雨崩因为体力不支被队友甩下很远，在空无一人的房间辗转反侧或者一系列，都可以称之为“孤独”。但是我学会了享受孤独，所以我愿意更加倾向于一个人行走在路上。或许正是这种孤独教会我成长与沉淀，我很庆幸我的人生中能有那么几个值得骄傲、可歌可泣的故事，很多匆匆一别的甲乙丙也正是这些故事的主角。我同时也很庆幸，我会成为甲乙丙故事中的主角。“孤独”一词对我而言，更像是“沉淀”。', '0', '16', '15', '1427956354', '0', null, null, '1427432282', '1427701934', '3', '4', '2', '2', '1');
INSERT INTO `ux73_classify` VALUES ('49', '291429156364', '101427698727', '最“美”的照片', '通过所有用户的投票点评方式，投票最多者获胜。\r<br />照片类型不限、来源不限、尺寸不限。', '123', '3', '1', '1429761164', '100000', '2147483647', null, '1429156364', '1429159426', '1', '4', '1', '2', '1');
INSERT INTO `ux73_classify` VALUES ('50', '291429156432', '101427698727', '婉瑜的游记', '这是一个人记录旅行的日志，分享给大家。', '4', '1', '0', '1429236418', '0', null, null, '1429156432', '1429156432', '3', '0', '2', '1', '1');
INSERT INTO `ux73_classify` VALUES ('51', '271429533688', '201427430248', '英雄联盟最“拽”英雄', '请尽量上传官方的原画图片，请不要重复发布。', '100', '0', '0', '1430138488', '1000', null, null, '1429533688', null, '1', '4', '1', '2', '1');
INSERT INTO `ux73_classify` VALUES ('52', '271429533885', '201427430248', '分享自己喜欢的“女神”的照片', '每个人总会有很喜欢的女士，或者女孩。分享看看谁的女神人气最高！', '100', '0', '0', '1430138685', '500', null, null, '1429533885', null, '1', '4', '1', '2', '1');
INSERT INTO `ux73_classify` VALUES ('53', '271429534005', '201427430248', '说说你最喜欢的一首歌。', '可以是轻音乐、摇滚、流行...表示个人最喜欢《葫芦娃》~', '100', '0', '0', '1430138805', '1000', null, null, '1429534005', null, '1', '4', '1', '2', '1');
INSERT INTO `ux73_classify` VALUES ('54', '271429534388', '201427430248', '最喜欢的一本书', '说说最近最喜欢的一本书，或者曾经读过的最喜欢的一本书。\r<br />—— 想想，我最喜欢的应该是《天才在左，疯子在右》吧，内容有趣且知道了不少神一样存在的人。', '100', '0', '0', '1430139188', '1000', null, null, '1429534388', null, '1', '4', '1', '2', '1');
INSERT INTO `ux73_classify` VALUES ('55', '271429535057', '201427430248', '说走就走，这一刻最想去哪？', '每个人都有这样的冲动，有的人去了，有的人计划去，有的人想去且没去。\r<br />说说这一刻想去哪呢？\r<br />有图最好哈！\r<br />', '100', '0', '0', '1430139857', '1000', null, null, '1429535057', null, '1', '4', '1', '2', '1');
INSERT INTO `ux73_classify` VALUES ('56', '271429535291', '201427430248', '说出自己喜欢最喜欢的“电影”', '可以简单的文字描述，也可以加上海报，当然如果你加上视频连接也是可以的。', '92', '0', '2', '1430140091', '500', null, null, '1429535291', '1429676691', '1', '4', '1', '2', '2');

-- ----------------------------
-- Table structure for `ux73_content`
-- ----------------------------
DROP TABLE IF EXISTS `ux73_content`;
CREATE TABLE `ux73_content` (
  `id` tinyint(1) NOT NULL AUTO_INCREMENT,
  `cid` varchar(30) DEFAULT NULL COMMENT '自定义唯一 ID',
  `userid` varchar(30) DEFAULT NULL,
  `user` varchar(25) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `titleid` bigint(20) DEFAULT '0' COMMENT '标题id',
  `title` varchar(50) DEFAULT NULL,
  `content` text,
  `image` varchar(200) DEFAULT NULL,
  `link` text,
  `music` varchar(200) DEFAULT NULL,
  `video` varchar(200) DEFAULT NULL,
  `select` int(1) DEFAULT '0',
  `lastdate` varchar(20) DEFAULT NULL,
  `click` int(11) DEFAULT '0' COMMENT '内容被购买量',
  `plus` int(10) DEFAULT '0',
  `base` int(11) DEFAULT NULL COMMENT '发布时间',
  `revise` int(11) DEFAULT '0' COMMENT '修改时间',
  `weight` int(10) DEFAULT NULL,
  `verify` tinyint(4) DEFAULT '0' COMMENT '状态；0=正常、2=关闭、',
  `types` varchar(5) DEFAULT NULL COMMENT '0=文本；1=图片；2=视频；3=音乐；4=链接',
  `classify` int(11) DEFAULT NULL,
  `consume` varchar(50) DEFAULT NULL COMMENT '发布所消耗的金额（单位：分）',
  `shareglod` int(10) DEFAULT NULL COMMENT '分享金赞助金额',
  `effects` int(1) DEFAULT '0' COMMENT '标示：1=顶（作者）、2=推荐（题主）',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=122 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of ux73_content
-- ----------------------------
INSERT INTO `ux73_content` VALUES ('67', '271427433644', '201427430248', '', '', '291429156432', '', '前言：\r\n不得不承认我是一个比较随性又比较懒得一个人，时隔小半年才开始整理游记，我总是抱着故事总要沉淀过后才更能散发出它该有的味道的心态。经过时间的沉淀，除去新鲜感之类的感情外，剩下的应该更多的是一种怀念与感悟，在许久之后更加显得风韵犹存。\r\n很多人问过我，一个人行走难道不孤独吗？是的，我曾经反思过这个问题，也质疑过这个问题。在路上漂泊的日子如果说没有孤独是不可能的，完全与外界失联的4天，在徒步雨崩因为体力不支被队友甩下很远，在空无一人的房间辗转反侧或者一系列，都可以称之为“孤独”。但是我学会了享受孤独，所以我愿意更加倾向于一个人行走在路上。或许正是这种孤独教会我成长与沉淀，我很庆幸我的人生中能有那么几个值得骄傲、可歌可泣的故事，很多匆匆一别的甲乙丙也正是这些故事的主角。我同时也很庆幸，我会成为甲乙丙故事中的主角。“孤独”一词对我而言，更像是“沉淀”。', '', '', '', '', '0', null, null, '0', '1427433644', '0', '1427433644', '2', '0', '2147483647', '0', '4', '0');
INSERT INTO `ux73_content` VALUES ('68', '271427434049', '201427430248', '', '', '291429156432', '', '川西大环线路线：成都-康定-稻城-亚丁-香格里拉-雨崩村-丽江-双廊-洱海-大理-昆明-成都\r\n \r\n10.10：成都-康定\r\n宿：登巴2号店\r\n刻意错开了十一的高峰期，早上8点从成都北站去往康定的大巴车。我当时的心情是平静的，并不像个游客，感觉像是奔赴数千公里只为见许久未谋面的老友一般。从这时候开始，一个月的行程也开始了，我也踏上了一个人的长征之路。\r\n \r\n一路上的路况非常的差，加上堵车，将近12个小时，我才抵达了康定县。（由于换了最近换了手机，很多照片都没有了，只有相机里的照片还在）\r\n出了车站，傍晚已至，抓着最后的时间买了康定去稻城的车票，遇见了我在路上的第一对朋友，一对情侣，决定一起明天拼车康定环线。蕾蕾跟胖哥是大学同学，谈到现在已经是第七年了，准备今年结婚，新婚将至，我在这里真挚的祝福他们，愿他们白头偕老。\r\n走了不算远的路程，找到了在YHA上预定的登巴客栈2号店，正好赶上了老板娘的生日，还切了一块生日蛋糕分给我。同屋的小庄姑娘已经准备第二天一早就离开康定，离别前夜，送了几片暖宝宝给她。', '', '', '', '', '0', null, null, '0', '1427434049', '0', '1427434049', '2', '0', '2147483647', '5', '4', '0');
INSERT INTO `ux73_content` VALUES ('69', '271427434549', '201427430248', '', '', '0', '', '啊实打实大\r\n\r\n\r\n啊实打实asd\r\n阿斯达asd\r\n\r\n发生大声大声道', '', '', '', '', '0', null, null, '0', '1427434549', '0', '1427434549', '2', '0', '0', '27', '0', '0');
INSERT INTO `ux73_content` VALUES ('70', '271427434681', '201427430248', '', '', '0', '', '发生大\r<br />阿斯达按时\r<br />\r<br />\r<br />\r<br />啊实打实大', '', '', '', '', '0', null, null, '0', '1427434681', '0', '1427434681', '2', '0', '0', '81', '0', '0');
INSERT INTO `ux73_content` VALUES ('71', '271427435050', '201427430248', '', '', '291429156432', '', '前言：\r<br />\r<br />不得不承认我是一个比较随性又比较懒得一个人，时隔小半年才开始整理游记，我总是抱着故事总要沉淀过后才更能散发出它该有的味道的心态。经过时间的沉淀，除去新鲜感之类的感情外，剩下的应该更多的是一种怀念与感悟，在许久之后更加显得风韵犹存。\r<br />\r<br />很多人问过我，一个人行走难道不孤独吗？是的，我曾经反思过这个问题，也质疑过这个问题。在路上漂泊的日子如果说没有孤独是不可能的，完全与外界失联的4天，在徒步雨崩因为体力不支被队友甩下很远，在空无一人的房间辗转反侧或者一系列，都可以称之为“孤独”。\r<br />\r<br />但是我学会了享受孤独，所以我愿意更加倾向于一个人行走在路上。或许正是这种孤独教会我成长与沉淀，我很庆幸我的人生中能有那么几个值得骄傲、可歌可泣的故事，很多匆匆一别的甲乙丙也正是这些故事的主角。我同时也很庆幸，我会成为甲乙丙故事中的主角。“孤独”一词对我而言，更像是“沉淀”。', '', '', '', '', '0', null, '2', '8', '1427435050', '0', '1427435050', '0', '0', '2147483647', '239', '4', '0');
INSERT INTO `ux73_content` VALUES ('72', '271427440087', '201427430248', '', '', '291429156432', '', '川西大环线路线：成都-康定-稻城-亚丁-香格里拉-雨崩村-丽江-双廊-洱海-大理-昆明-成都\r<br />\r<br />10.10：成都-康定\r<br />\r<br />宿：登巴2号店\r<br />刻意错开了十一的高峰期，早上8点从成都北站去往康定的大巴车。我当时的心情是平静的，并不像个游客，感觉像是奔赴数千公里只为见许久未谋面的老友一般。从这时候开始，一个月的行程也开始了，我也踏上了一个人的长征之路。\r<br />\r<br />一路上的路况非常的差，加上堵车，将近12个小时，我才抵达了康定县。（由于换了最近换了手机，很多照片都没有了，只有相机里的照片还在）\r<br />出了车站，傍晚已至，抓着最后的时间买了康定去稻城的车票，遇见了我在路上的第一对朋友，一对情侣，决定一起明天拼车康定环线。蕾蕾跟胖哥是大学同学，谈到现在已经是第七年了，准备今年结婚，新婚将至，我在这里真挚的祝福他们，愿他们白头偕老。\r<br />走了不算远的路程，找到了在YHA上预定的登巴客栈2号店，正好赶上了老板娘的生日，还切了一块生日蛋糕分给我。同屋的小庄姑娘已经准备第二天一早就离开康定，离别前夜，送了几片暖宝宝给她。\r<br />', '', '', '', '', '0', null, '2', '6', '1427440087', '0', '1427440087', '0', '0', '2147483647', '725', '4', '0');
INSERT INTO `ux73_content` VALUES ('73', '271427441321', '201427430248', '', '', '291429156432', '', '10.11 康定环线\r<br />\r<br />天还未亮，约好了的司机师傅来客栈接我们去环康定，说到这个师傅，我要提醒众多驴友们，不要在车站门口随便就答应拼车，还是去青旅，都有正规的司机，我们这个司机师傅确实非常的不厚道，在这里我就不说什么名字跟电话了。\r<br />\r<br />一上车，还有一起拼车的三个人，就这样，我们6人凑成了小分队。祈祷哥，祈祷姐，小胖，蕾蕾，胖哥，以及我。\r<br />', '', '', '', '', '0', null, '2', '8', '1427441321', '0', '1427441321', '0', '0', '2147483647', '2183', '4', '0');
INSERT INTO `ux73_content` VALUES ('74', '271427441525', '201427430248', '', '', '291429156432', '', '来一张我们5个人混乱的完全不知情的合影，祈祷哥在照相', 'http://webimg1.meitudata.com/201503/27/55150763767f4.jpg', '', '', '', '0', null, '2', '10', '1427441525', '0', '1427441525', '0', '1', '2147483647', '6557', '4', '0');
INSERT INTO `ux73_content` VALUES ('75', '271427441769', '201427430248', '', '', '291429156432', '', '第一个停靠点，真的好冷好冷，我当时竟然还穿着七分裤', 'http://webimg1.meitudata.com/201503/27/55150857b0e8f.jpg', '', '', '', '0', null, '2', '8', '1427441769', '0', '1427441769', '0', '1', '2147483647', '19679', '4', '0');
INSERT INTO `ux73_content` VALUES ('76', '271427441806', '201427430248', '', '', '291429156432', '', '你看，远处的是云海吗？', 'http://webimg1.meitudata.com/201503/27/5515087b5bd0f.jpg', '', '', '', '0', null, '3', '11', '1427441806', '0', '1427441806', '0', '1', '2147483647', '59045', '4', '0');
INSERT INTO `ux73_content` VALUES ('77', '271427441865', '201427430248', '', '', '291429156432', '', '翻越折多山\r<br />一直想在公路上拍这么一组照片，也算是了我一个心愿\r<br />', 'http://webimg1.meitudata.com/201503/27/551508b6e9d0b.jpg', '', '', '', '0', null, '5', '11', '1427441865', '0', '1427441865', '0', '1', '2147483647', '177143', '4', '0');
INSERT INTO `ux73_content` VALUES ('78', '291427700387', '101427698727', '', '', '0', '', '', 'http://webimg1.meitudata.com/201503/30/5518fa8b4538c.jpg', '', '', '', '0', null, '1', '2', '1427700387', '0', '1427700387', '2', '1', '0', '3', '0', '0');
INSERT INTO `ux73_content` VALUES ('79', '271427701934', '201427430248', '', '', '291429156432', '', '4个回答 - 提问时间: 2013年07月16日\r<br />板的问题Function name must be a string in D:wampwwwadd.php on line...2012-09-18 Fatal error: Call to undefined... 8 更多相关问题>> 网友...\r<br />zhidao.baidu.com/link?...  - 百度快照 - 80%好评', 'http://webimg1.meitudata.com/201503/30/551900909f4ba.jpg', '', '', '', '0', null, '2', '7', '1427701934', '0', '1427701934', '0', '1', '2147483647', '0', '4', '0');
INSERT INTO `ux73_content` VALUES ('80', '271427702122', '201427430248', '', '', '0', '', 'asdas\r<br />d\r<br />asd\r<br />asd\r<br />as\r<br />da\r<br />sdaaaaaaaaaaaaaaasdasd\r<br />\r<br />asd\r<br />a\r<br />sd\r<br />a\r<br />s\r<br />d\r<br />asd', '', '', '', '', '0', null, '1', '2', '1427702122', '0', '1427702122', '2', '0', '0', '3', '0', '0');
INSERT INTO `ux73_content` VALUES ('81', '271427707464', '201427430248', '', '', '291429156364', '', '', 'http://webimg1.meitudata.com/201503/30/5519162f62fff.jpg', '', '', '', '0', null, '5', '6', '1427707464', '0', '1427707464', '0', '1', '2147483647', '0', '6', '0');
INSERT INTO `ux73_content` VALUES ('82', '291427707867', '101427698727', '', '', '291429156364', '', '', 'http://webimg1.meitudata.com/201503/30/551917c3bb55d.jpg', '', '', '', '0', null, '3', '4', '1427707867', '0', '1427707867', '2', '1', '2147483647', '0', '6', '0');
INSERT INTO `ux73_content` VALUES ('83', '291427707914', '101427698727', '', '', '291429156364', '', '', 'http://webimg1.meitudata.com/201503/30/551917f2687f2.jpg', '', '', '', '0', null, '3', '4', '1427707914', '0', '1427707914', '0', '1', '2147483647', '0', '6', '0');
INSERT INTO `ux73_content` VALUES ('84', '301427723198', '111427723099', '', '', '291429156364', '', '', 'http://webimg1.meitudata.com/201503/30/55195280bedfa.jpg', '', '', '', '0', null, '6', '6', '1427723198', '0', '1427723198', '0', '1', '2147483647', '0', '6', '0');
INSERT INTO `ux73_content` VALUES ('85', '291427772416', '101427698727', '', '', '291429156364', '', '', 'http://webimg1.meitudata.com/201503/31/551a06c4ed284.jpg', '', '', '', '0', null, '4', '6', '1427772416', '0', '1427772416', '0', '1', '2147483647', '0', '6', '0');
INSERT INTO `ux73_content` VALUES ('86', '291427772914', '101427698727', '', '', '291429156364', '', '', 'http://webimg1.meitudata.com/201503/31/551a140107b45.jpg', '', '', '', '0', null, '3', '4', '1427772914', '0', '1427772914', '0', '1', '2147483647', '3', '6', '0');
INSERT INTO `ux73_content` VALUES ('87', '291427775324', '101427698727', '', '', '291429156364', '', '', 'http://webimg1.meitudata.com/201503/31/551a15e434baa.jpg', '', '', '', '0', null, '4', '6', '1427775324', '0', '1427775324', '0', '1', '2147483647', '21', '6', '0');
INSERT INTO `ux73_content` VALUES ('88', '291427775359', '101427698727', '', '', '0', '', '美的信仰', 'http://webimg1.meitudata.com/201503/31/551a1f5188d8c.jpg', '', '', '', '0', null, '2', '4', '1427775359', '0', '1427775359', '0', '1', '0', '81', '0', '0');
INSERT INTO `ux73_content` VALUES ('89', '321427775635', '131427770385', '', '', '291429156364', '', '', 'http://webimg1.meitudata.com/201503/31/551a2076efa19.jpg', '', '', '', '0', null, '6', '8', '1427775635', '0', '1427775635', '0', '1', '2147483647', '1', '6', '0');
INSERT INTO `ux73_content` VALUES ('90', '321427775646', '131427770385', '', '', '0', '', '', 'http://webimg1.meitudata.com/201503/31/551a2083921b1.jpg', '', '', '', '0', null, '3', '10', '1427775646', '0', '1427775646', '0', '1', '0', '49', '0', '0');
INSERT INTO `ux73_content` VALUES ('91', '321427775658', '131427770385', '', '', '291429156364', '', '', 'http://webimg1.meitudata.com/201503/31/551a209053669.jpg', '', '', '', '0', null, '7', '13', '1427775658', '0', '1427775658', '0', '1', '2147483647', '337', '6', '0');
INSERT INTO `ux73_content` VALUES ('92', '321427775937', '131427770385', '', '', '0', '', '', 'http://webimg1.meitudata.com/201503/31/551a20a194aa8.jpg', '', '', '', '0', null, '0', '0', '1427775937', '0', '1427775937', '0', '1', '0', '28', '0', '0');
INSERT INTO `ux73_content` VALUES ('93', '321427775958', '131427770385', '', '', '0', '', '', 'http://webimg1.meitudata.com/201503/31/551a21bb2590a.jpg', '', '', '', '0', null, '3', '10', '1427775958', '0', '1427775958', '0', '1', '0', '35', '0', '0');
INSERT INTO `ux73_content` VALUES ('94', '321427775966', '131427770385', '', '', '0', '', '', 'http://webimg1.meitudata.com/201503/31/551a21c42de9f.jpg', '', '', '', '0', null, '3', '10', '1427775966', '0', '1427775966', '0', '1', '0', '42', '0', '0');
INSERT INTO `ux73_content` VALUES ('95', '321427775977', '131427770385', '', '', '0', '', '', 'http://webimg1.meitudata.com/201503/31/551a21ce85348.jpg', '', '', '', '0', null, '4', '12', '1427775977', '0', '1427775977', '0', '1', '0', '49', '0', '0');
INSERT INTO `ux73_content` VALUES ('96', '341427784869', '71427784723', '', '', '291429156364', '', '', 'http://webimg1.meitudata.com/201503/31/551a4487ee048.jpg', '', '', '', '0', null, '4', '11', '1427784869', '0', '1427784869', '0', '1', '2147483647', '1', '6', '0');
INSERT INTO `ux73_content` VALUES ('97', '341427785258', '71427784723', '', '', '291429156364', '', '', 'http://webimg1.meitudata.com/201503/31/551a460fa1739.jpg', '', '', '', '0', null, '4', '11', '1427785258', '0', '1427785258', '0', '1', '2147483647', '8', '6', '0');
INSERT INTO `ux73_content` VALUES ('98', '341427788270', '71427784723', '', '', '291429156364', '', '', 'http://webimg1.meitudata.com/201503/31/551a49fa819a5.jpg', '', '', '', '0', null, '0', '0', '1427788270', '0', '1427788270', '2', '1', '2147483647', '2', '6', '0');
INSERT INTO `ux73_content` VALUES ('99', '341427788318', '71427784723', '', '', '291429156364', '', '', 'http://webimg1.meitudata.com/201503/31/551a49fa819a5.jpg', '', '', '', '0', null, '0', '0', '1427788318', '0', '1427788318', '2', '1', '2147483647', '3', '6', '0');
INSERT INTO `ux73_content` VALUES ('100', '341427788352', '71427784723', '', '', '291429156364', '', '', 'http://webimg1.meitudata.com/201503/31/551a522387405.jpg', '', '', '', '0', null, '0', '0', '1427788352', '0', '1427788352', '2', '1', '2147483647', '4', '6', '0');
INSERT INTO `ux73_content` VALUES ('101', '341427788460', '71427784723', '', '', '0', '', '', 'http://webimg1.meitudata.com/201503/31/551a52745484f.jpg', '', '', '', '0', null, '0', '0', '1427788460', '0', '1427788460', '2', '1', '0', '0', '0', '0');
INSERT INTO `ux73_content` VALUES ('102', '341427788464', '71427784723', '', '', '0', '', '', 'http://webimg1.meitudata.com/201503/31/551a52745484f.jpg', '', '', '', '0', null, '0', '0', '1427788464', '0', '1427788464', '2', '1', '0', '0', '0', '0');
INSERT INTO `ux73_content` VALUES ('103', '341427788505', '71427784723', '', '', '0', '', '', 'http://webimg1.meitudata.com/201503/31/551a52745484f.jpg', '', '', '', '0', null, '0', '0', '1427788505', '0', '1427788505', '2', '1', '0', '0', '0', '0');
INSERT INTO `ux73_content` VALUES ('104', '341427788505', '71427784723', '', '', '0', '', '', 'http://webimg1.meitudata.com/201503/31/551a52745484f.jpg', '', '', '', '0', null, '0', '0', '1427788505', '0', '1427788505', '2', '1', '0', '0', '0', '0');
INSERT INTO `ux73_content` VALUES ('105', '341427788591', '71427784723', '', '', '0', '', '', 'http://webimg1.meitudata.com/201503/31/551a52745484f.jpg', '', '', '', '0', null, '0', '0', '1427788591', '0', '1427788591', '2', '1', '0', '0', '0', '0');
INSERT INTO `ux73_content` VALUES ('106', '341427791096', '71427784723', '', '', '291429156364', '', '六间房 - 美女视频 - 美女直播 - 视频聊天 - 视频交友\r<br />\r<br />六间房是中国最大的真人互动视频直播社区。秀场视频直播间,支持数万人同时在线视频聊天、在线K歌跳舞、视频交友。赶快加入,免费与数万个美女主播在线聊天。\r<br />www.6.cn/  - 百度快照 - 68%好评', 'http://webimg1.meitudata.com/201503/31/551a52745484f.jpg', '', '', '', '0', null, '5', '13', '1427791096', '0', '1427791096', '0', '1', '2147483647', '11', '6', '0');
INSERT INTO `ux73_content` VALUES ('107', '341427791723', '71427784723', '', '', '291429156364', '', '六间房 - 美女视频 - 美女直播 - 视频聊天 - 视频交友', 'http://webimg1.meitudata.com/201503/31/551a5f4f8325b.jpg', '', '', '', '0', null, '5', '13', '1427791723', '0', '1427791723', '0', '1', '2147483647', '12', '6', '0');
INSERT INTO `ux73_content` VALUES ('108', '291427792047', '101427698727', '', '', '291429156364', '', '', 'http://webimg1.meitudata.com/201503/31/551a609426d6d.jpg', '', '', '', '0', null, '6', '11', '1427792047', '0', '1427792047', '0', '1', '2147483647', '5', '6', '0');
INSERT INTO `ux73_content` VALUES ('109', '351427858625', '81427794933', '', '', '291429156364', '', '', 'http://webimg1.meitudata.com/201504/01/551b64a3ea071.jpg', '', '', '', '0', null, '3', '9', '1427858625', '0', '1427858625', '0', '1', '2147483647', '1', '6', '0');
INSERT INTO `ux73_content` VALUES ('110', '291427880933', '101427698727', '', '', '291429156364', '', '', 'http://webimg1.meitudata.com/201504/01/551bbbc8d8003.jpg', '', '', '', '0', null, '3', '12', '1427880933', '0', '1427880933', '0', '1', '2147483647', '1', '6', '0');
INSERT INTO `ux73_content` VALUES ('111', '291427880991', '101427698727', '', '', '291429156364', '', 'yoooo', 'http://webimg1.meitudata.com/201504/01/551bbc01a828b.jpg', '', '', '', '0', null, '3', '12', '1427880991', '1429681661', '1427880991', '0', '1', '2147483647', '2', '6', '0');
INSERT INTO `ux73_content` VALUES ('112', '291427881009', '101427698727', '', '', '291429156364', '', '123&lt;div>123&lt;/div>&lt;div>123&lt;/div>&lt;div>&lt;br>&lt;/div>&lt;div>&lt;br>&lt;/div>&lt;div>&lt;br>&lt;/div>&lt;div>&lt;br>&lt;/div>&lt;div>&lt;br>&lt;/div>&lt;div>&lt;br>&lt;/div>&lt;div>&lt;div&gt;&lt;/div&gt;&lt;/div>&lt;div>124&lt;/div>&lt;div>15&lt;/div>&lt;div>123&lt;/div>', 'http://webimg1.meitudata.com/201504/01/551bbc14d2365.jpg', '', '', '', '0', null, '3', '9', '1427881009', '1429682300', '1427881009', '0', '1', '2147483647', '3', '6', '0');
INSERT INTO `ux73_content` VALUES ('113', '411429156473', '141429156444', '', '', '291429156364', '', '', 'http://webimg1.meitudata.com/201504/16/552f327b7b4ea.jpg', '', '', '', '0', null, '3', '6', '1429156473', '0', '1429156473', '2', '1', '2147483647', '3', '4', '0');
INSERT INTO `ux73_content` VALUES ('114', '411429157688', '141429156444', '', '', '291429156364', '', '&lt;br />\n<br />&lt;b>Notice&lt;/b>:  Undefined variable: Rinfo in &lt;b>F:www73userAdd.php&lt;/b> on line &lt;b>136&lt;/b>&lt;br />\n<br />', 'http://webimg1.meitudata.com/201504/16/552f373a00da7.jpg', '', '', '', '0', null, '1', '2', '1429157688', '0', '1429157688', '2', '1', '2147483647', '6', '4', '0');
INSERT INTO `ux73_content` VALUES ('115', '421429159426', '151429157737', '', '', '291429156364', '', '', 'http://webimg1.meitudata.com/201504/16/552f3dff7c73c.jpg', '', '', '', '0', null, '2', '4', '1429159426', '0', '1429159426', '2', '1', '2147483647', '3', '4', '0');
INSERT INTO `ux73_content` VALUES ('116', '421429159576', '151429157737', '', '', '0', '', '哈哈哈哈哈哈哈哈哈哈哈哈', 'http://webimg1.meitudata.com/201504/16/552f3e89b0bfd.jpg', '', '', '', '0', null, '0', '0', '1429159576', '0', '1429159576', '2', '1', '0', '14', '0', '0');
INSERT INTO `ux73_content` VALUES ('117', '421429160045', '151429157737', '', '', '0', '', '很美的羽毛', 'http://webimg1.meitudata.com/201504/16/552f3e89b0bfd.jpg', '', '', '', '0', null, '0', '0', '1429160045', '0', '1429160045', '2', '1', '0', '21', '0', '0');
INSERT INTO `ux73_content` VALUES ('118', '531429287885', '161429287781', '', '', '0', '', '啊实打实大时代', '', '', '', '', '0', null, '0', '0', '1429287885', '0', '1429287885', '0', '0', '0', '7', '0', '0');
INSERT INTO `ux73_content` VALUES ('119', '531429287929', '161429287781', '', '', '0', '', '啊实打实大时代', '', '', '', '', '0', null, '0', '0', '1429287929', '0', '1429287929', '0', '0', '0', '14', '0', '0');
INSERT INTO `ux73_content` VALUES ('120', '321429669952', '131427770385', '', '', '271429535291', '', '《名侦探狄仁杰》是2015年由万合天宜、优酷联合出品的首部古装推理单元喜剧，由至尊玉执导，白客、小爱、张本煜、柯达等担当主演。&lt;div>&lt;br>&lt;/div>&lt;div>该剧以唐朝武则天时代为背景，对狄仁杰经典故事进行了重新演绎和改编。运用意想不到的喜剧推理方式推动剧情发展，重新解构“狄仁杰”这个经久不衰的具有中国智慧的侦探形象，颠覆过去的经典侦探故事套路的同时，赋予其新时代的互联网精神。&lt;/div>&lt;div>&lt;br>&lt;/div>&lt;div>该剧于2015年2月25日在优酷视频、腾讯视频同步播出，每周三9:30更新。&lt;/div>', '', '', '', 'player.youku.com/player.php/Type/Folder/Fid/23465260/Ob/1/sid/XOTM5MTM5NTIw/v.swf', '0', null, '0', '0', '1429669952', '0', '1429669952', '0', '2', '2147483647', '3', '4', '0');
INSERT INTO `ux73_content` VALUES ('121', '361429676691', '91427795025', '', '', '271429535291', '', '', '', '', '', 'player.youku.com/player.php/sid/XOTM5MTgxMDU2/v.swf', '0', null, '0', '0', '1429676691', '0', '1429676691', '0', '2', '2147483647', '3', '4', '0');

-- ----------------------------
-- Table structure for `ux73_exchange`
-- ----------------------------
DROP TABLE IF EXISTS `ux73_exchange`;
CREATE TABLE `ux73_exchange` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `userid` bigint(30) DEFAULT NULL COMMENT '提交用户',
  `describe` varchar(200) CHARACTER SET utf8 DEFAULT NULL COMMENT '描述内容',
  `num` varchar(30) CHARACTER SET gbk DEFAULT NULL,
  `key` tinyint(4) DEFAULT '0',
  `time` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ux73_exchange
-- ----------------------------
INSERT INTO `ux73_exchange` VALUES ('1', null, null, '6600', '0', null);
INSERT INTO `ux73_exchange` VALUES ('2', '6', '123123-123123', '3000', '0', '2015-02-09 17:10:52');
INSERT INTO `ux73_exchange` VALUES ('3', '131427770385', '123-12313', '200', '0', '1427778635');
INSERT INTO `ux73_exchange` VALUES ('4', '131427770385', '1231-1423', '200', '0', '1427778685');

-- ----------------------------
-- Table structure for `ux73_logs_followtitle`
-- ----------------------------
DROP TABLE IF EXISTS `ux73_logs_followtitle`;
CREATE TABLE `ux73_logs_followtitle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time` int(11) DEFAULT NULL COMMENT '关注时间',
  `uid` bigint(30) DEFAULT NULL COMMENT '关注者UID',
  `tid` bigint(30) DEFAULT NULL COMMENT '标题编码TID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COMMENT='用户关注标题的记录表';

-- ----------------------------
-- Records of ux73_logs_followtitle
-- ----------------------------
INSERT INTO `ux73_logs_followtitle` VALUES ('13', '1427708880', '101427698727', '271427702349');
INSERT INTO `ux73_logs_followtitle` VALUES ('14', '1427708884', '101427698727', '271427432282');
INSERT INTO `ux73_logs_followtitle` VALUES ('15', '1427723169', '111427723099', '271427702349');
INSERT INTO `ux73_logs_followtitle` VALUES ('16', '1427770430', '131427770385', '271427702349');
INSERT INTO `ux73_logs_followtitle` VALUES ('17', '1427770432', '131427770385', '271427432282');
INSERT INTO `ux73_logs_followtitle` VALUES ('18', '1427784826', '71427784723', '271427702349');
INSERT INTO `ux73_logs_followtitle` VALUES ('19', '1427858607', '81427794933', '271427702349');
INSERT INTO `ux73_logs_followtitle` VALUES ('20', '1427869624', '81427794933', '271427432282');
INSERT INTO `ux73_logs_followtitle` VALUES ('21', '1427945255', '141427781015', '271427702349');
INSERT INTO `ux73_logs_followtitle` VALUES ('22', '1429156453', '141429156444', '291429156432');
INSERT INTO `ux73_logs_followtitle` VALUES ('23', '1429156462', '141429156444', '291429156364');
INSERT INTO `ux73_logs_followtitle` VALUES ('26', '1429161947', '151429157737', '291429156432');
INSERT INTO `ux73_logs_followtitle` VALUES ('27', '1429161948', '151429157737', '291429156364');
INSERT INTO `ux73_logs_followtitle` VALUES ('28', '1429429956', '121427768841', '291429156364');
INSERT INTO `ux73_logs_followtitle` VALUES ('29', '1429623348', '131427770385', '271429535291');
INSERT INTO `ux73_logs_followtitle` VALUES ('30', '1429676455', '131427770385', '271429535057');
INSERT INTO `ux73_logs_followtitle` VALUES ('31', '1429676579', '91427795025', '271429535291');
INSERT INTO `ux73_logs_followtitle` VALUES ('32', '1429678617', '101427698727', '271429535291');

-- ----------------------------
-- Table structure for `ux73_logs_followuser`
-- ----------------------------
DROP TABLE IF EXISTS `ux73_logs_followuser`;
CREATE TABLE `ux73_logs_followuser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time` int(11) DEFAULT NULL COMMENT '关注的时间',
  `uid` bigint(30) DEFAULT NULL COMMENT '指定的用户',
  `fuid` bigint(30) DEFAULT NULL COMMENT '关注的用户UID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ux73_logs_followuser
-- ----------------------------
INSERT INTO `ux73_logs_followuser` VALUES ('1', '1427705224', '101427698727', '0');
INSERT INTO `ux73_logs_followuser` VALUES ('4', '1427705359', '101427698727', '201427430248');
INSERT INTO `ux73_logs_followuser` VALUES ('8', '1427714093', '0', '201427430248');
INSERT INTO `ux73_logs_followuser` VALUES ('9', '1427724347', '111427723099', '101427698727');
INSERT INTO `ux73_logs_followuser` VALUES ('10', '1427857002', '81427794933', '71427784723');
INSERT INTO `ux73_logs_followuser` VALUES ('11', '1427857168', '81427794933', '201427430248');
INSERT INTO `ux73_logs_followuser` VALUES ('12', '1427857496', '81427794933', '131427770385');
INSERT INTO `ux73_logs_followuser` VALUES ('13', '1427857575', '81427794933', '141427781015');
INSERT INTO `ux73_logs_followuser` VALUES ('14', '1427858353', '81427794933', '101427698727');
INSERT INTO `ux73_logs_followuser` VALUES ('15', '1427878293', '141427781015', '201427430248');
INSERT INTO `ux73_logs_followuser` VALUES ('16', '1427878298', '141427781015', '101427698727');
INSERT INTO `ux73_logs_followuser` VALUES ('17', '1427878309', '141427781015', '81427794933');
INSERT INTO `ux73_logs_followuser` VALUES ('18', '1427878315', '141427781015', '121427768841');
INSERT INTO `ux73_logs_followuser` VALUES ('19', '1427965524', '141427781015', '71427784723');
INSERT INTO `ux73_logs_followuser` VALUES ('20', '1429161844', '151429157737', '141429156444');

-- ----------------------------
-- Table structure for `ux73_logs_purchase`
-- ----------------------------
DROP TABLE IF EXISTS `ux73_logs_purchase`;
CREATE TABLE `ux73_logs_purchase` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time` int(11) DEFAULT NULL COMMENT '购买时间',
  `uid` bigint(30) DEFAULT NULL COMMENT '指定用户',
  `cid` bigint(30) DEFAULT NULL COMMENT '购买的内容CID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8 COMMENT='用户购买内容的记录表';

-- ----------------------------
-- Records of ux73_logs_purchase
-- ----------------------------
INSERT INTO `ux73_logs_purchase` VALUES ('1', '1427855867', '141427781015', '291427792047');
INSERT INTO `ux73_logs_purchase` VALUES ('2', '1427855872', '141427781015', '291427775324');
INSERT INTO `ux73_logs_purchase` VALUES ('3', '1427855902', '141427781015', '291427772416');
INSERT INTO `ux73_logs_purchase` VALUES ('4', '1427855910', '141427781015', '271427707464');
INSERT INTO `ux73_logs_purchase` VALUES ('5', '1427856727', '141427781015', '321427775635');
INSERT INTO `ux73_logs_purchase` VALUES ('6', '1427856791', '81427794933', '321427775635');
INSERT INTO `ux73_logs_purchase` VALUES ('7', '1427856847', '81427794933', '321427775646');
INSERT INTO `ux73_logs_purchase` VALUES ('8', '1427856850', '81427794933', '321427775958');
INSERT INTO `ux73_logs_purchase` VALUES ('9', '1427856856', '81427794933', '321427775977');
INSERT INTO `ux73_logs_purchase` VALUES ('10', '1427856856', '81427794933', '321427775966');
INSERT INTO `ux73_logs_purchase` VALUES ('11', '1427856858', '81427794933', '321427775658');
INSERT INTO `ux73_logs_purchase` VALUES ('12', '1427856998', '81427794933', '341427791096');
INSERT INTO `ux73_logs_purchase` VALUES ('13', '1427858637', '81427794933', '108');
INSERT INTO `ux73_logs_purchase` VALUES ('14', '1427858656', '81427794933', '291427792047');
INSERT INTO `ux73_logs_purchase` VALUES ('15', '1427858694', '81427794933', '341427791723');
INSERT INTO `ux73_logs_purchase` VALUES ('16', '1427869462', '81427794933', '291427775324');
INSERT INTO `ux73_logs_purchase` VALUES ('17', '1427869469', '81427794933', '291427772914');
INSERT INTO `ux73_logs_purchase` VALUES ('18', '1427869472', '81427794933', '291427772416');
INSERT INTO `ux73_logs_purchase` VALUES ('19', '1427869482', '81427794933', '291427775359');
INSERT INTO `ux73_logs_purchase` VALUES ('20', '1427869487', '81427794933', '291427707867');
INSERT INTO `ux73_logs_purchase` VALUES ('21', '1427869490', '81427794933', '291427700387');
INSERT INTO `ux73_logs_purchase` VALUES ('22', '1427869493', '81427794933', '291427707914');
INSERT INTO `ux73_logs_purchase` VALUES ('23', '1427869509', '81427794933', '341427785258');
INSERT INTO `ux73_logs_purchase` VALUES ('24', '1427869515', '81427794933', '341427784869');
INSERT INTO `ux73_logs_purchase` VALUES ('25', '1427869525', '81427794933', '301427723198');
INSERT INTO `ux73_logs_purchase` VALUES ('26', '1427869633', '81427794933', '271427441865');
INSERT INTO `ux73_logs_purchase` VALUES ('27', '1427869633', '81427794933', '271427441806');
INSERT INTO `ux73_logs_purchase` VALUES ('28', '1427869634', '81427794933', '271427701934');
INSERT INTO `ux73_logs_purchase` VALUES ('29', '1427869636', '81427794933', '271427441321');
INSERT INTO `ux73_logs_purchase` VALUES ('30', '1427869637', '81427794933', '271427441525');
INSERT INTO `ux73_logs_purchase` VALUES ('31', '1427869638', '81427794933', '271427441769');
INSERT INTO `ux73_logs_purchase` VALUES ('32', '1427869639', '81427794933', '271427435050');
INSERT INTO `ux73_logs_purchase` VALUES ('33', '1427869639', '81427794933', '271427440087');
INSERT INTO `ux73_logs_purchase` VALUES ('34', '1427869704', '81427794933', '271427702122');
INSERT INTO `ux73_logs_purchase` VALUES ('35', '1427869901', '141427781015', '341427791723');
INSERT INTO `ux73_logs_purchase` VALUES ('36', '1427869902', '141427781015', '341427791096');
INSERT INTO `ux73_logs_purchase` VALUES ('37', '1427869906', '141427781015', '341427784869');
INSERT INTO `ux73_logs_purchase` VALUES ('38', '1427869907', '141427781015', '321427775977');
INSERT INTO `ux73_logs_purchase` VALUES ('39', '1427869908', '141427781015', '341427785258');
INSERT INTO `ux73_logs_purchase` VALUES ('40', '1427869909', '141427781015', '321427775966');
INSERT INTO `ux73_logs_purchase` VALUES ('41', '1427869910', '141427781015', '321427775658');
INSERT INTO `ux73_logs_purchase` VALUES ('42', '1427869910', '141427781015', '321427775958');
INSERT INTO `ux73_logs_purchase` VALUES ('43', '1427880811', '101427698727', '341427791723');
INSERT INTO `ux73_logs_purchase` VALUES ('44', '1427880861', '101427698727', '351427858625');
INSERT INTO `ux73_logs_purchase` VALUES ('45', '1427880869', '101427698727', '341427785258');
INSERT INTO `ux73_logs_purchase` VALUES ('46', '1427880873', '101427698727', '341427791096');
INSERT INTO `ux73_logs_purchase` VALUES ('47', '1427880875', '101427698727', '341427784869');
INSERT INTO `ux73_logs_purchase` VALUES ('48', '1427880877', '101427698727', '321427775635');
INSERT INTO `ux73_logs_purchase` VALUES ('49', '1427880879', '101427698727', '321427775658');
INSERT INTO `ux73_logs_purchase` VALUES ('50', '1427880911', '101427698727', '301427723198');
INSERT INTO `ux73_logs_purchase` VALUES ('51', '1427880913', '101427698727', '271427707464');
INSERT INTO `ux73_logs_purchase` VALUES ('52', '1427944681', '141427781015', '351427858625');
INSERT INTO `ux73_logs_purchase` VALUES ('53', '1427944691', '141427781015', '291427881009');
INSERT INTO `ux73_logs_purchase` VALUES ('54', '1427956374', '141427781015', '291427880991');
INSERT INTO `ux73_logs_purchase` VALUES ('55', '1427956376', '141427781015', '291427880933');
INSERT INTO `ux73_logs_purchase` VALUES ('56', '1429157712', '101427698727', '411429156473');
INSERT INTO `ux73_logs_purchase` VALUES ('57', '1429159359', '151429157737', '411429156473');
INSERT INTO `ux73_logs_purchase` VALUES ('58', '1429159369', '151429157737', '411429157688');
INSERT INTO `ux73_logs_purchase` VALUES ('59', '1429166445', '151429157737', '321427775977');
INSERT INTO `ux73_logs_purchase` VALUES ('60', '1429246608', '101427698727', '271427441865');
INSERT INTO `ux73_logs_purchase` VALUES ('61', '1429249928', '101427698727', '421429159426');
INSERT INTO `ux73_logs_purchase` VALUES ('62', '1429429146', '111427723099', '421429159426');
INSERT INTO `ux73_logs_purchase` VALUES ('63', '1429429220', '111427723099', '411429156473');
INSERT INTO `ux73_logs_purchase` VALUES ('64', '1429429250', '111427723099', '291427881009');
INSERT INTO `ux73_logs_purchase` VALUES ('65', '1429429305', '111427723099', '291427880991');
INSERT INTO `ux73_logs_purchase` VALUES ('66', '1429429317', '111427723099', '351427858625');
INSERT INTO `ux73_logs_purchase` VALUES ('67', '1429429323', '111427723099', '291427880933');
INSERT INTO `ux73_logs_purchase` VALUES ('68', '1429429582', '111427723099', '341427784869');
INSERT INTO `ux73_logs_purchase` VALUES ('69', '1429429583', '111427723099', '341427785258');
INSERT INTO `ux73_logs_purchase` VALUES ('70', '1429429584', '111427723099', '341427791096');
INSERT INTO `ux73_logs_purchase` VALUES ('71', '1429429586', '111427723099', '321427775958');
INSERT INTO `ux73_logs_purchase` VALUES ('72', '1429429587', '111427723099', '321427775977');
INSERT INTO `ux73_logs_purchase` VALUES ('73', '1429429588', '111427723099', '321427775966');
INSERT INTO `ux73_logs_purchase` VALUES ('74', '1429429590', '111427723099', '321427775646');
INSERT INTO `ux73_logs_purchase` VALUES ('75', '1429429593', '111427723099', '341427791723');
INSERT INTO `ux73_logs_purchase` VALUES ('76', '1429429617', '111427723099', '291427792047');
INSERT INTO `ux73_logs_purchase` VALUES ('77', '1429429650', '111427723099', '321427775658');
INSERT INTO `ux73_logs_purchase` VALUES ('78', '1429429914', '111427723099', '271427701934');
INSERT INTO `ux73_logs_purchase` VALUES ('79', '1429429920', '111427723099', '271427441865');
INSERT INTO `ux73_logs_purchase` VALUES ('80', '1429429922', '111427723099', '271427441806');
INSERT INTO `ux73_logs_purchase` VALUES ('81', '1429429947', '121427768841', '291427881009');
INSERT INTO `ux73_logs_purchase` VALUES ('82', '1429429950', '121427768841', '291427880991');
INSERT INTO `ux73_logs_purchase` VALUES ('83', '1429429952', '121427768841', '291427880933');

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8 COMMENT='用户徽章使用记录表';

-- ----------------------------
-- Records of ux73_logs_specialuse
-- ----------------------------
INSERT INTO `ux73_logs_specialuse` VALUES ('42', '201427430248', '4', '1427783790', '1427784380');
INSERT INTO `ux73_logs_specialuse` VALUES ('43', '131427770385', '5', '1427783790', '1427784617');
INSERT INTO `ux73_logs_specialuse` VALUES ('46', '131427770385', '3', '1427784651', '0');
INSERT INTO `ux73_logs_specialuse` VALUES ('47', '101427698727', '7', '1427784696', '1427852711');
INSERT INTO `ux73_logs_specialuse` VALUES ('48', '121427768841', '9', '1427784696', '0');
INSERT INTO `ux73_logs_specialuse` VALUES ('49', '71427784723', '3', '1427784727', '1427784730');
INSERT INTO `ux73_logs_specialuse` VALUES ('50', '101427795057', '3', '1427795077', '1427795082');
INSERT INTO `ux73_logs_specialuse` VALUES ('51', '101427698727', '9', '1427852713', '1427852716');
INSERT INTO `ux73_logs_specialuse` VALUES ('52', '81427794933', '3', '1427852912', '1427852915');
INSERT INTO `ux73_logs_specialuse` VALUES ('53', '81427794933', '9', '1427852920', '1427852924');
INSERT INTO `ux73_logs_specialuse` VALUES ('54', '141427781015', '3', '1427853181', '0');
INSERT INTO `ux73_logs_specialuse` VALUES ('55', '141427781015', '9', '1427853184', '1427853186');
INSERT INTO `ux73_logs_specialuse` VALUES ('56', '141429156444', '9', '1429156448', '1429156450');
INSERT INTO `ux73_logs_specialuse` VALUES ('57', '141429156444', '3', '1429157638', '0');
INSERT INTO `ux73_logs_specialuse` VALUES ('58', '151429157737', '3', '1429157746', '1429157749');
INSERT INTO `ux73_logs_specialuse` VALUES ('59', '151429157737', '9', '1429159566', '1429159568');
INSERT INTO `ux73_logs_specialuse` VALUES ('60', '161429287781', '9', '1429287785', '1429287787');
INSERT INTO `ux73_logs_specialuse` VALUES ('61', '91427795025', '9', '1429676539', '1429676541');

-- ----------------------------
-- Table structure for `ux73_logs_visitor`
-- ----------------------------
DROP TABLE IF EXISTS `ux73_logs_visitor`;
CREATE TABLE `ux73_logs_visitor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` bigint(30) DEFAULT NULL COMMENT '个人中心',
  `fuid` bigint(30) DEFAULT NULL COMMENT '访问者',
  `time` int(11) DEFAULT NULL COMMENT '访问时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户访问记录表';

-- ----------------------------
-- Records of ux73_logs_visitor
-- ----------------------------

-- ----------------------------
-- Table structure for `ux73_message`
-- ----------------------------
DROP TABLE IF EXISTS `ux73_message`;
CREATE TABLE `ux73_message` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `content` text,
  `time` int(11) DEFAULT NULL COMMENT '发布时间',
  `speaker` bigint(20) DEFAULT NULL COMMENT '发言者',
  `position` bigint(20) DEFAULT NULL COMMENT '呈现位置，MID=内容ID（写在内容的留言）、=用户ID（写在用户留言板的留言）',
  `reply` int(10) DEFAULT '0' COMMENT 'MID ，回复指定的MID的留言',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ux73_message
-- ----------------------------
INSERT INTO `ux73_message` VALUES ('1', '发生大声地', '1427445532', '201427430248', '271427441865', '0');
INSERT INTO `ux73_message` VALUES ('2', '发生大声地', '1427445617', '201427430248', '271427441865', '0');
INSERT INTO `ux73_message` VALUES ('3', '奥不错哦', '1427859247', '81427794933', '351427858625', '0');
INSERT INTO `ux73_message` VALUES ('4', 'yooo', '1427859261', '81427794933', '351427858625', '0');
INSERT INTO `ux73_message` VALUES ('5', '噶四大四大', '1427859491', '81427794933', '351427858625', '0');
INSERT INTO `ux73_message` VALUES ('6', '反反复复', '1427859528', '81427794933', '351427858625', '0');
INSERT INTO `ux73_message` VALUES ('7', '啊实打实大', '1427859715', '81427794933', '351427858625', '0');
INSERT INTO `ux73_message` VALUES ('8', '啊实打实', '1427859859', '81427794933', '351427858625', '0');
INSERT INTO `ux73_message` VALUES ('9', '啊实打实大', '1427859965', '81427794933', '351427858625', '0');
INSERT INTO `ux73_message` VALUES ('10', '啊实打实大', '1427859992', '81427794933', '351427858625', '0');
INSERT INTO `ux73_message` VALUES ('11', '33', '1427878931', '0', '1', '0');
INSERT INTO `ux73_message` VALUES ('12', '33', '1427878939', '0', '1', '0');
INSERT INTO `ux73_message` VALUES ('13', '33', '1427878988', '0', '1', '0');
INSERT INTO `ux73_message` VALUES ('14', '33', '1427878989', '0', '1', '0');
INSERT INTO `ux73_message` VALUES ('15', '１１１１', '1427879187', '141427781015', '291427792047', '0');
INSERT INTO `ux73_message` VALUES ('16', '啊实打实大', '1427879333', '141427781015', '291427792047', '0');
INSERT INTO `ux73_message` VALUES ('17', '１１２３１２３１２３', '1427879337', '141427781015', '291427792047', '0');
INSERT INTO `ux73_message` VALUES ('18', '日请问请问', '1427879339', '141427781015', '291427792047', '0');
INSERT INTO `ux73_message` VALUES ('19', '发生大声地', '1427879344', '141427781015', '291427792047', '0');
INSERT INTO `ux73_message` VALUES ('20', '爱上大声大声道', '1427879361', '141427781015', '291427792047', '0');
INSERT INTO `ux73_message` VALUES ('21', '29', '1427880792', '0', '1', '0');

-- ----------------------------
-- Table structure for `ux73_special`
-- ----------------------------
DROP TABLE IF EXISTS `ux73_special`;
CREATE TABLE `ux73_special` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `icon` varchar(11) NOT NULL,
  `name` varchar(100) CHARACTER SET gbk NOT NULL,
  `depict` text CHARACTER SET gbk NOT NULL COMMENT '描述',
  `number` int(11) NOT NULL COMMENT '持有数量',
  `welfare` int(11) NOT NULL COMMENT '福利',
  `gain` varchar(500) CHARACTER SET gbk NOT NULL COMMENT '获取条件',
  `purchase` int(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ux73_special
-- ----------------------------
INSERT INTO `ux73_special` VALUES ('2', 'vip', '特殊用户', '①、享受：发布底价为 0.03元；<br />\r\n②、发布冷却减短为：10 秒 ；<br />\r\n③、特殊显示用户；<br />\r\n④、有效时间七天；<br />', '0', '1', '购买', '300');
INSERT INTO `ux73_special` VALUES ('3', 'new', '新手', '余额低于 0.10 元的用户都可以领取 此徽章，并领取 0.10 元的日福利。<br />\r\n当用户余额大于 0.10 元的时候，则不可再领取此福利。', '0', '10', '免费', null);
INSERT INTO `ux73_special` VALUES ('4', 'one', '财富榜第一名', '排行榜每天的 0 点刷新记录。<br />\n①、每天 0 点后您可以领取相应的丰富福利；<br />\n②、特殊奖励；', '0', '999', '自动发放', null);
INSERT INTO `ux73_special` VALUES ('5', 'niu', '分享者', '邀请 3为好友可以获得此奖励。<br />在《个人设置》里可以找到邀请地址。', '0', '99', '自动发放', null);
INSERT INTO `ux73_special` VALUES ('6', 'ceshi', '内测会员', 'Welfare is looking for grass root most loved resource sharing platform, looking for some fun, welfare will be nice, fresh information collected to share to everyone. <br /><br />\r\nAt the same time, we also hope that the grass root people can put you cherish the welfare to share out, everybody happy is really...', '0', '73', '自动发放', null);
INSERT INTO `ux73_special` VALUES ('7', 'two', '财富榜第二名', '排行榜每天的 0 点刷新记录。<br />\n①、每天 0 点后您可以领取相应的丰富福利；<br />\n②、特殊奖励；', '0', '888', '自动发放', null);
INSERT INTO `ux73_special` VALUES ('10', 'three', '财富榜第三名', '排行榜每天的 0 点刷新记录。<br />\r\n①、每天 0 点后您可以领取相应的丰富福利；<br />\r\n②、特殊奖励；', '0', '777', '自动发放', null);
INSERT INTO `ux73_special` VALUES ('9', 'friend', '芳芳的朋友', '资助。', '0', '73', '免费', null);

-- ----------------------------
-- Table structure for `ux73_user`
-- ----------------------------
DROP TABLE IF EXISTS `ux73_user`;
CREATE TABLE `ux73_user` (
  `id` tinyint(1) NOT NULL AUTO_INCREMENT,
  `uid` bigint(30) DEFAULT '0' COMMENT '用户UID',
  `invited` bigint(30) DEFAULT NULL COMMENT '邀请者UID',
  `name` varchar(20) CHARACTER SET gbk NOT NULL,
  `nick` varchar(10) CHARACTER SET gbk DEFAULT NULL,
  `pwd` varchar(50) NOT NULL,
  `icon` varchar(100) CHARACTER SET gbk DEFAULT NULL,
  `lastdate` varchar(20) NOT NULL COMMENT '最近登陆时间',
  `lastact` varchar(20) DEFAULT NULL COMMENT '最新发布时间',
  `plus` int(10) DEFAULT '0' COMMENT '余额',
  `issue` int(10) DEFAULT '0' COMMENT '发布量',
  `comments` int(10) DEFAULT '0' COMMENT '点赞量',
  `newMessage` varchar(20) DEFAULT '0' COMMENT '最近一次进入 自己的留言界面时间',
  `statusDate` varchar(20) DEFAULT NULL,
  `statusSeat` varchar(20) CHARACTER SET gbk DEFAULT NULL,
  `email` varchar(50) CHARACTER SET gbk DEFAULT NULL,
  `register_ip` varchar(20) DEFAULT NULL,
  `register_time` int(20) DEFAULT NULL,
  `vip` int(11) DEFAULT NULL,
  `describe` varchar(100) CHARACTER SET gbk DEFAULT NULL,
  `entrys` int(10) DEFAULT '0' COMMENT '登录次数',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ux73_user
-- ----------------------------
INSERT INTO `ux73_user` VALUES ('29', '101427698727', '0', '站长', null, '0cc175b9c0f1b6a831c399e269772661', 'http://webimg1.meitudata.com/201503/30/551909ca17728.jpg', '1429677339', '1427881009', '2158', '62', '0', '1429678542', null, null, null, '127.0.0.1', '1427698727', '1428389373', null, '0');
INSERT INTO `ux73_user` VALUES ('39', '121427795139', '0', '九月', null, '0cc175b9c0f1b6a831c399e269772661', 'http://webimg1.meitudata.com/201503/31/551a6cbc9709f.jpg', '1427795139', '0', '0', '0', '0', '0', null, null, null, '127.0.0.1', '1427795139', null, null, '0');
INSERT INTO `ux73_user` VALUES ('38', '111427795114', '0', '南台月', null, '0cc175b9c0f1b6a831c399e269772661', 'http://webimg1.meitudata.com/201503/31/551a6ca051411.jpg', '1427795114', '0', '0', '0', '0', '0', null, null, null, '127.0.0.1', '1427795114', null, null, '0');
INSERT INTO `ux73_user` VALUES ('37', '101427795057', '0', '大姐大', null, '0cc175b9c0f1b6a831c399e269772661', 'http://webimg1.meitudata.com/201503/31/551a6c66eb3a2.jpg', '1427795058', '0', '10', '0', '0', '0', null, null, null, '127.0.0.1', '1427795057', null, null, '0');
INSERT INTO `ux73_user` VALUES ('36', '91427795025', '0', '时光', null, '0cc175b9c0f1b6a831c399e269772661', 'http://webimg1.meitudata.com/201503/31/551a6c45dfbeb.jpg', '1429676532', '1429676691', '70', '1', '0', '0', null, null, null, '127.0.0.1', '1427795025', null, null, '0');
INSERT INTO `ux73_user` VALUES ('35', '81427794933', '0', '攻城狮', null, '0cc175b9c0f1b6a831c399e269772661', 'http://webimg1.meitudata.com/201503/31/551a6bea66911.jpg', '1427856781', '1427858625', '97', '53', '0', '1427869735', null, null, null, '127.0.0.1', '1427794933', null, null, '0');
INSERT INTO `ux73_user` VALUES ('34', '71427784723', '0', '灯塔', null, '0cc175b9c0f1b6a831c399e269772661', 'http://webimg1.meitudata.com/201503/31/551a441b77323.jpg', '1427784724', '1427791723', '35', '30', '0', '0', null, null, null, '127.0.0.1', '1427784723', null, null, '0');
INSERT INTO `ux73_user` VALUES ('27', '201427430248', '0', '芳芳', null, '0cc175b9c0f1b6a831c399e269772661', 'http://webimg1.meitudata.com/201503/27/55151b347ee3b.jpg', '1429677336', '1427707464', '1075009', '28', '0', '0', null, null, null, '127.0.0.1', '1427430248', '1428388724', '4个回答 - 提问时间: 2013年07月16日\n板的问题Function name must be a string in D:wampwwwadd.php on line...2012-09', '0');
INSERT INTO `ux73_user` VALUES ('28', '211427435691', '0', '哈哈哈笑', null, '0cc175b9c0f1b6a831c399e269772661', 'http://webimg1.meitudata.com/201503/31/551a6bb1c2d9a.jpg', '1427794880', '0', '997', '1', '0', '0', null, null, null, '127.0.0.1', '1427435691', null, null, '0');
INSERT INTO `ux73_user` VALUES ('30', '111427723099', '0', '苹果', null, '0cc175b9c0f1b6a831c399e269772661', './effigy/ce1ad7f1908b26902da0205a7a240ee3.jpg', '1429429142', '1427723199', '667', '29', '0', '0', null, null, null, '::1', '1427723099', null, null, '0');
INSERT INTO `ux73_user` VALUES ('31', '121427768841', '0', '屌爆天', null, '0cc175b9c0f1b6a831c399e269772661', 'http://webimg1.meitudata.com/201503/31/551a0623ccad6.jpg', '1429429940', '0', '1005', '3', '0', '0', null, null, null, '127.0.0.1', '1427768841', null, null, '0');
INSERT INTO `ux73_user` VALUES ('32', '131427770385', '0', '点点', null, '0cc175b9c0f1b6a831c399e269772661', 'http://webimg1.meitudata.com/201503/31/551a0c151343b.jpg', '1429668955', '1429669952', '259', '16', '0', '0', null, null, null, '127.0.0.1', '1427770385', null, null, '0');
INSERT INTO `ux73_user` VALUES ('33', '141427781015', '131427770385', '鹳狸猿', null, '0cc175b9c0f1b6a831c399e269772661', 'http://webimg1.meitudata.com/201503/31/551a35a892033.jpg', '1427944677', '0', '63', '26', '0', '1427966320', null, null, null, '127.0.0.1', '1427781015', null, null, '0');
INSERT INTO `ux73_user` VALUES ('40', '131427797021', null, '我是章鱼', null, 'ecaab6049e91395de7d530941cbf6eef', './effigy/91dba4f272461a7593ff91cfd4032060.jpg', '1427797071', null, '0', '0', '0', '0', null, null, null, '125.71.2.246', '1427797021', null, null, '0');
INSERT INTO `ux73_user` VALUES ('51', '141429286690', '0', '阿萨达是', null, '0cc175b9c0f1b6a831c399e269772661', './effigy/458d70f64aae9515f8bd849032241de1.jpg', '1429276690', '0', '0', '0', '0', '0', null, null, null, '::1', '1429286690', null, null, '0');
INSERT INTO `ux73_user` VALUES ('52', '151429287185', '0', '人情味', null, '0cc175b9c0f1b6a831c399e269772661', './effigy/5120a5b5d0b51f89554bb1deaefc2804.jpg', '1429287198', '0', '0', '0', '0', '0', null, null, null, '::1', '1429287185', null, null, '0');
INSERT INTO `ux73_user` VALUES ('53', '161429287781', '0', '啊', null, '0cc175b9c0f1b6a831c399e269772661', './effigy/041d30787c8398b1d49bdb5f0ef64650.jpg', '1429287782', '1429287929', '52', '2', '0', '0', null, null, null, '::1', '1429287781', null, null, '0');
