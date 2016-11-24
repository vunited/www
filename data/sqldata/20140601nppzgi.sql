-- ecshop v2.x SQL Dump Program
-- http://www.dede168.com
-- 
-- DATE : 2014-06-01 10:59:48
-- MYSQL SERVER VERSION : 5.6.14
-- PHP VERSION : 5.3.27
-- ECShop VERSION : v2.7.3
-- Vol : 1
DROP TABLE IF EXISTS `ecs_weixin_bonus`;
CREATE TABLE `ecs_weixin_bonus` (
  `id` tinyint(1) NOT NULL AUTO_INCREMENT,
  `type_id` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `ecs_weixin_bonus` ( `id`, `type_id` ) VALUES  ('1', '1');
DROP TABLE IF EXISTS `ecs_weixin_cfg`;
CREATE TABLE `ecs_weixin_cfg` (
  `cfg_id` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `cfg_name` varchar(64) NOT NULL DEFAULT '',
  `cfg_value` varchar(100) NOT NULL,
  `autoload` varchar(20) NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`cfg_id`),
  UNIQUE KEY `cfg_name` (`cfg_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `ecs_weixin_cfg` ( `cfg_id`, `cfg_name`, `cfg_value`, `autoload` ) VALUES  ('1', 'murl', 'm/', 'yes');
INSERT INTO `ecs_weixin_cfg` ( `cfg_id`, `cfg_name`, `cfg_value`, `autoload` ) VALUES  ('2', 'baseurl', 'http://www.dede168.com/', 'yes');
DROP TABLE IF EXISTS `ecs_weixin_config`;
CREATE TABLE `ecs_weixin_config` (
  `id` int(1) NOT NULL,
  `token` varchar(100) NOT NULL,
  `appid` char(18) NOT NULL,
  `appsecret` char(32) NOT NULL,
  `access_token` char(150) NOT NULL,
  `dateline` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `ecs_weixin_config` ( `id`, `token`, `appid`, `appsecret`, `access_token`, `dateline` ) VALUES  ('1', 'weixin', 'wx878d7d76b140cf50', '6e066ea8e2c01b62473baabdb9a52f33', '', '1386912383');
DROP TABLE IF EXISTS `ecs_weixin_keywords`;
CREATE TABLE `ecs_weixin_keywords` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `keyword` varchar(100) NOT NULL,
  `type` tinyint(1) unsigned NOT NULL,
  `contents` text NOT NULL,
  `pic` varchar(80) NOT NULL,
  `pic_tit` varchar(80) NOT NULL,
  `desc` text NOT NULL,
  `pic_url` varchar(80) NOT NULL,
  `count` int(10) unsigned NOT NULL,
  `status` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `ecs_weixin_keywords` ( `id`, `name`, `keyword`, `type`, `contents`, `pic`, `pic_tit`, `desc`, `pic_url`, `count`, `status` ) VALUES  ('90', '帮助', 'help', '1', '输入【help】查看帮助\r\n输入【cxbd】绑定会员\r\n输入【quit】退出绑定\r\n输入【member】会员中心\r\n输入【new】查看最新商品\r\n输入【hot】查看热卖商品\r\n输入【best】查看推荐商品\r\n输入【promote】特价促销\r\n输入【qiandao】签到送积分\r\n输入【ddcx】查询订单\r\n输入【kdcx】快递查询\r\n输入【jfcx】查询积分、余额', '', '', '', '', '100', '1');
INSERT INTO `ecs_weixin_keywords` ( `id`, `name`, `keyword`, `type`, `contents`, `pic`, `pic_tit`, `desc`, `pic_url`, `count`, `status` ) VALUES  ('91', '你好', '你好', '1', '输入【帮助】打开快捷菜单', '', '', '', '', '6', '1');
INSERT INTO `ecs_weixin_keywords` ( `id`, `name`, `keyword`, `type`, `contents`, `pic`, `pic_tit`, `desc`, `pic_url`, `count`, `status` ) VALUES  ('92', '您好', '您好', '1', '输入【帮助】打开快捷菜单', '', '', '', '', '0', '1');
INSERT INTO `ecs_weixin_keywords` ( `id`, `name`, `keyword`, `type`, `contents`, `pic`, `pic_tit`, `desc`, `pic_url`, `count`, `status` ) VALUES  ('100', '图文消息测试', '图文消息', '2', '', '4.jpg', '图文消息的测试标题', '资料显示，华数集团是由杭州文广集团、浙江广电集团等投资设立的大型国有文化传媒产业集团。在新媒体产业，华数集团旗下控股的上市公司华数传媒控股股份有限公司拥有上百万小时的数字媒体内容库、数千万台互联网电视终端，新媒体全业务运营牌照。', 'http://tech.sina.com.cn/i/2014-04-08/18199305530.shtml', '66', '1');
INSERT INTO `ecs_weixin_keywords` ( `id`, `name`, `keyword`, `type`, `contents`, `pic`, `pic_tit`, `desc`, `pic_url`, `count`, `status` ) VALUES  ('105', '文本消息测试', '文本消息', '1', '近年来，公开选拔和竞争上岗作为干部人事制度改革的重要举措，在拓宽选人视野，打破论资排辈等不少方面积极作用明显。“但走向极端就会出现问题，比如一些地方规定公开选拔和竞争上岗人员必须达到干部任用的多少比例，甚至进一步绝对化为‘凡提必竞’。”中央党校教授辛鸣说。', '', '', '', '', '55', '1');
DROP TABLE IF EXISTS `ecs_weixin_lang`;
CREATE TABLE `ecs_weixin_lang` (
  `lang_id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `lang_name` varchar(64) NOT NULL,
  `lang_value` text NOT NULL,
  PRIMARY KEY (`lang_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `ecs_weixin_lang` ( `lang_id`, `lang_name`, `lang_value` ) VALUES  ('1', 'regmsg', '欢迎关注ecshop微信公众演示平台！\r\n进入 <a href=\"http://www.dede168.com\">官方商城</a>\r\n输入【help】打开快捷菜单');
DROP TABLE IF EXISTS `ecs_weixin_menu`;
CREATE TABLE `ecs_weixin_menu` (
  `cat_id` smallint(5) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(255) NOT NULL DEFAULT '',
  `cat_type` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `keywords` varchar(255) NOT NULL DEFAULT '',
  `weixin_key` varchar(255) NOT NULL DEFAULT '',
  `links` varchar(255) NOT NULL DEFAULT '',
  `sort_order` tinyint(3) unsigned NOT NULL DEFAULT '50',
  `weixin_type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `parent_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`cat_id`),
  KEY `cat_type` (`cat_type`),
  KEY `sort_order` (`sort_order`),
  KEY `parent_id` (`parent_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `ecs_weixin_menu` ( `cat_id`, `cat_name`, `cat_type`, `keywords`, `weixin_key`, `links`, `sort_order`, `weixin_type`, `parent_id` ) VALUES  ('43', '热卖商品', '1', '', 'hot', '', '50', '0', '38');
INSERT INTO `ecs_weixin_menu` ( `cat_id`, `cat_name`, `cat_type`, `keywords`, `weixin_key`, `links`, `sort_order`, `weixin_type`, `parent_id` ) VALUES  ('44', '促销活动', '1', '', 'promote', '', '50', '0', '38');
INSERT INTO `ecs_weixin_menu` ( `cat_id`, `cat_name`, `cat_type`, `keywords`, `weixin_key`, `links`, `sort_order`, `weixin_type`, `parent_id` ) VALUES  ('38', '商品信息', '1', '', 'shop', '', '1', '0', '0');
INSERT INTO `ecs_weixin_menu` ( `cat_id`, `cat_name`, `cat_type`, `keywords`, `weixin_key`, `links`, `sort_order`, `weixin_type`, `parent_id` ) VALUES  ('39', '会员功能', '1', '', 'member', 'www.dede168.com', '2', '0', '0');
INSERT INTO `ecs_weixin_menu` ( `cat_id`, `cat_name`, `cat_type`, `keywords`, `weixin_key`, `links`, `sort_order`, `weixin_type`, `parent_id` ) VALUES  ('40', '更多..', '1', '', 'more', '', '3', '0', '0');
INSERT INTO `ecs_weixin_menu` ( `cat_id`, `cat_name`, `cat_type`, `keywords`, `weixin_key`, `links`, `sort_order`, `weixin_type`, `parent_id` ) VALUES  ('41', '新品上市', '1', '', 'new', '', '50', '0', '38');
INSERT INTO `ecs_weixin_menu` ( `cat_id`, `cat_name`, `cat_type`, `keywords`, `weixin_key`, `links`, `sort_order`, `weixin_type`, `parent_id` ) VALUES  ('42', '精品推荐', '1', '', 'best', '', '50', '0', '38');
INSERT INTO `ecs_weixin_menu` ( `cat_id`, `cat_name`, `cat_type`, `keywords`, `weixin_key`, `links`, `sort_order`, `weixin_type`, `parent_id` ) VALUES  ('46', '重新绑定', '1', '', 'cxbd', '', '5', '0', '39');
INSERT INTO `ecs_weixin_menu` ( `cat_id`, `cat_name`, `cat_type`, `keywords`, `weixin_key`, `links`, `sort_order`, `weixin_type`, `parent_id` ) VALUES  ('47', '会员中心', '1', '', 'member', '', '4', '0', '39');
INSERT INTO `ecs_weixin_menu` ( `cat_id`, `cat_name`, `cat_type`, `keywords`, `weixin_key`, `links`, `sort_order`, `weixin_type`, `parent_id` ) VALUES  ('48', '帮助', '1', '帮助', 'help', '', '3', '0', '40');
INSERT INTO `ecs_weixin_menu` ( `cat_id`, `cat_name`, `cat_type`, `keywords`, `weixin_key`, `links`, `sort_order`, `weixin_type`, `parent_id` ) VALUES  ('49', '首页', '1', '', '', 'http://www.dede168.com/m/', '2', '1', '40');
INSERT INTO `ecs_weixin_menu` ( `cat_id`, `cat_name`, `cat_type`, `keywords`, `weixin_key`, `links`, `sort_order`, `weixin_type`, `parent_id` ) VALUES  ('50', '图文消息', '1', '', '图文消息', '', '4', '0', '40');
INSERT INTO `ecs_weixin_menu` ( `cat_id`, `cat_name`, `cat_type`, `keywords`, `weixin_key`, `links`, `sort_order`, `weixin_type`, `parent_id` ) VALUES  ('51', '文本消息', '1', '', '文本消息', '', '5', '0', '40');
INSERT INTO `ecs_weixin_menu` ( `cat_id`, `cat_name`, `cat_type`, `keywords`, `weixin_key`, `links`, `sort_order`, `weixin_type`, `parent_id` ) VALUES  ('52', '订单查询', '1', '', 'ddcx', '', '2', '0', '39');
INSERT INTO `ecs_weixin_menu` ( `cat_id`, `cat_name`, `cat_type`, `keywords`, `weixin_key`, `links`, `sort_order`, `weixin_type`, `parent_id` ) VALUES  ('53', '快递查询', '1', '', 'kdcx', '', '3', '0', '39');
INSERT INTO `ecs_weixin_menu` ( `cat_id`, `cat_name`, `cat_type`, `keywords`, `weixin_key`, `links`, `sort_order`, `weixin_type`, `parent_id` ) VALUES  ('54', '帐户资金', '1', '', 'jfcx', '', '1', '0', '39');
INSERT INTO `ecs_weixin_menu` ( `cat_id`, `cat_name`, `cat_type`, `keywords`, `weixin_key`, `links`, `sort_order`, `weixin_type`, `parent_id` ) VALUES  ('55', '签到', '1', '', 'qiandao', '', '1', '0', '40');
DROP TABLE IF EXISTS `ecs_weixin_point`;
CREATE TABLE `ecs_weixin_point` (
  `point_id` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `point_name` varchar(64) NOT NULL DEFAULT '',
  `point_value` int(3) unsigned NOT NULL,
  `point_num` int(3) NOT NULL,
  `autoload` varchar(20) NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`point_id`),
  UNIQUE KEY `option_name` (`point_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `ecs_weixin_point` ( `point_id`, `point_name`, `point_value`, `point_num`, `autoload` ) VALUES  ('1', 'new', '10', '1', 'yes');
INSERT INTO `ecs_weixin_point` ( `point_id`, `point_name`, `point_value`, `point_num`, `autoload` ) VALUES  ('2', 'best', '10', '1', 'yes');
INSERT INTO `ecs_weixin_point` ( `point_id`, `point_name`, `point_value`, `point_num`, `autoload` ) VALUES  ('3', 'hot', '10', '1', 'yes');
INSERT INTO `ecs_weixin_point` ( `point_id`, `point_name`, `point_value`, `point_num`, `autoload` ) VALUES  ('4', 'cxbd', '10', '1', 'yes');
INSERT INTO `ecs_weixin_point` ( `point_id`, `point_name`, `point_value`, `point_num`, `autoload` ) VALUES  ('5', 'ddcx', '10', '1', 'yes');
INSERT INTO `ecs_weixin_point` ( `point_id`, `point_name`, `point_value`, `point_num`, `autoload` ) VALUES  ('6', 'kdcx', '10', '1', 'yes');
INSERT INTO `ecs_weixin_point` ( `point_id`, `point_name`, `point_value`, `point_num`, `autoload` ) VALUES  ('8', 'qiandao', '20', '1', 'yes');
INSERT INTO `ecs_weixin_point` ( `point_id`, `point_name`, `point_value`, `point_num`, `autoload` ) VALUES  ('11', 'promote', '10', '1', 'yes');
DROP TABLE IF EXISTS `ecs_weixin_point_record`;
CREATE TABLE `ecs_weixin_point_record` (
  `pr_id` int(7) NOT NULL AUTO_INCREMENT,
  `wxid` char(28) NOT NULL,
  `point_name` varchar(64) NOT NULL,
  `num` int(5) NOT NULL,
  `lasttime` int(10) NOT NULL,
  `datelinie` int(10) NOT NULL,
  PRIMARY KEY (`pr_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `ecs_weixin_point_record` ( `pr_id`, `wxid`, `point_name`, `num`, `lasttime`, `datelinie` ) VALUES  ('10', 'oKIVft-swX4_pRDyWpN5VmswPZlE', 'qiandao', '5', '1398478404', '1398431460');
INSERT INTO `ecs_weixin_point_record` ( `pr_id`, `wxid`, `point_name`, `num`, `lasttime`, `datelinie` ) VALUES  ('11', 'oKIVft-swX4_pRDyWpN5VmswPZlE', 'best', '6', '1398479714', '1398431608');
INSERT INTO `ecs_weixin_point_record` ( `pr_id`, `wxid`, `point_name`, `num`, `lasttime`, `datelinie` ) VALUES  ('12', 'oKIVft-swX4_pRDyWpN5VmswPZlE', 'hot', '4', '1398479389', '1398431616');
INSERT INTO `ecs_weixin_point_record` ( `pr_id`, `wxid`, `point_name`, `num`, `lasttime`, `datelinie` ) VALUES  ('13', 'oKIVft-swX4_pRDyWpN5VmswPZlE', 'promote', '4', '1398435826', '1398432317');
INSERT INTO `ecs_weixin_point_record` ( `pr_id`, `wxid`, `point_name`, `num`, `lasttime`, `datelinie` ) VALUES  ('14', 'oKIVft-swX4_pRDyWpN5VmswPZlE', 'new', '3', '1398435862', '1398434130');
INSERT INTO `ecs_weixin_point_record` ( `pr_id`, `wxid`, `point_name`, `num`, `lasttime`, `datelinie` ) VALUES  ('15', 'oKIVft-We_6U2Lxak40Ht9jTmMKc', 'promote', '2', '1398486013', '1398436227');
INSERT INTO `ecs_weixin_point_record` ( `pr_id`, `wxid`, `point_name`, `num`, `lasttime`, `datelinie` ) VALUES  ('16', 'oKIVft-swX4_pRDyWpN5VmswPZlE', 'ddcx', '2', '1398478572', '1398440053');
INSERT INTO `ecs_weixin_point_record` ( `pr_id`, `wxid`, `point_name`, `num`, `lasttime`, `datelinie` ) VALUES  ('17', 'oKIVft-swX4_pRDyWpN5VmswPZlE', 'kdcx', '2', '1398478601', '1398442335');
INSERT INTO `ecs_weixin_point_record` ( `pr_id`, `wxid`, `point_name`, `num`, `lasttime`, `datelinie` ) VALUES  ('18', 'oKIVftyTI_air21Gqu1I-FhkW_9Y', 'promote', '1', '1398442694', '1398442694');
INSERT INTO `ecs_weixin_point_record` ( `pr_id`, `wxid`, `point_name`, `num`, `lasttime`, `datelinie` ) VALUES  ('19', 'oKIVftyTI_air21Gqu1I-FhkW_9Y', 'new', '1', '1398442792', '1398442792');
INSERT INTO `ecs_weixin_point_record` ( `pr_id`, `wxid`, `point_name`, `num`, `lasttime`, `datelinie` ) VALUES  ('20', 'oKIVft-We_6U2Lxak40Ht9jTmMKc', 'qiandao', '2', '1398501760', '1398486037');
INSERT INTO `ecs_weixin_point_record` ( `pr_id`, `wxid`, `point_name`, `num`, `lasttime`, `datelinie` ) VALUES  ('21', 'oKIVft-We_6U2Lxak40Ht9jTmMKc', 'ddcx', '1', '1398487820', '1398487820');
INSERT INTO `ecs_weixin_point_record` ( `pr_id`, `wxid`, `point_name`, `num`, `lasttime`, `datelinie` ) VALUES  ('22', 'oKIVft-We_6U2Lxak40Ht9jTmMKc', 'hot', '1', '1398501782', '1398501782');
INSERT INTO `ecs_weixin_point_record` ( `pr_id`, `wxid`, `point_name`, `num`, `lasttime`, `datelinie` ) VALUES  ('23', 'ommoAj12M_ghxvjKCtGFtqdYXWJk', 'hot', '1', '1401442047', '1401442047');
INSERT INTO `ecs_weixin_point_record` ( `pr_id`, `wxid`, `point_name`, `num`, `lasttime`, `datelinie` ) VALUES  ('24', 'ommoAj12M_ghxvjKCtGFtqdYXWJk', 'new', '1', '1401442132', '1401442132');
INSERT INTO `ecs_weixin_point_record` ( `pr_id`, `wxid`, `point_name`, `num`, `lasttime`, `datelinie` ) VALUES  ('25', 'ommoAj5Z_0unAnWNFccgDBAcEsXY', 'new', '1', '1401511597', '1401511597');
INSERT INTO `ecs_weixin_point_record` ( `pr_id`, `wxid`, `point_name`, `num`, `lasttime`, `datelinie` ) VALUES  ('26', 'o4EXIjrOf_sjptK4eKwFGBkY7m38', 'promote', '1', '1401512601', '1401512601');
INSERT INTO `ecs_weixin_point_record` ( `pr_id`, `wxid`, `point_name`, `num`, `lasttime`, `datelinie` ) VALUES  ('27', 'o4EXIjrOf_sjptK4eKwFGBkY7m38', 'hot', '1', '1401512607', '1401512607');
INSERT INTO `ecs_weixin_point_record` ( `pr_id`, `wxid`, `point_name`, `num`, `lasttime`, `datelinie` ) VALUES  ('28', 'o4EXIjrOf_sjptK4eKwFGBkY7m38', 'qiandao', '1', '1401512614', '1401512614');
INSERT INTO `ecs_weixin_point_record` ( `pr_id`, `wxid`, `point_name`, `num`, `lasttime`, `datelinie` ) VALUES  ('29', 'o4EXIjsLxvfmW6e17QznVU0AWNTk', 'promote', '1', '1401513687', '1401513687');
INSERT INTO `ecs_weixin_point_record` ( `pr_id`, `wxid`, `point_name`, `num`, `lasttime`, `datelinie` ) VALUES  ('30', 'o4EXIjsLxvfmW6e17QznVU0AWNTk', 'hot', '1', '1401513703', '1401513703');
INSERT INTO `ecs_weixin_point_record` ( `pr_id`, `wxid`, `point_name`, `num`, `lasttime`, `datelinie` ) VALUES  ('31', 'o4EXIjj0uLyJZg2YfN5qBOWZ0dqg', 'qiandao', '1', '1401517855', '1401517855');
INSERT INTO `ecs_weixin_point_record` ( `pr_id`, `wxid`, `point_name`, `num`, `lasttime`, `datelinie` ) VALUES  ('32', 'o4EXIjj0uLyJZg2YfN5qBOWZ0dqg', 'hot', '1', '1401518122', '1401518122');
INSERT INTO `ecs_weixin_point_record` ( `pr_id`, `wxid`, `point_name`, `num`, `lasttime`, `datelinie` ) VALUES  ('33', 'o4EXIjj0uLyJZg2YfN5qBOWZ0dqg', 'new', '1', '1401518127', '1401518127');
INSERT INTO `ecs_weixin_point_record` ( `pr_id`, `wxid`, `point_name`, `num`, `lasttime`, `datelinie` ) VALUES  ('34', 'o4EXIjj0uLyJZg2YfN5qBOWZ0dqg', 'ddcx', '1', '1401521292', '1401521292');
INSERT INTO `ecs_weixin_point_record` ( `pr_id`, `wxid`, `point_name`, `num`, `lasttime`, `datelinie` ) VALUES  ('35', 'o4EXIjpzr5gtMQc_--84aImHsYWk', 'new', '1', '1401523321', '1401523321');
INSERT INTO `ecs_weixin_point_record` ( `pr_id`, `wxid`, `point_name`, `num`, `lasttime`, `datelinie` ) VALUES  ('36', 'o4EXIjrwezlc-fWC1wayMscxeJPo', 'promote', '1', '1401529782', '1401529782');
INSERT INTO `ecs_weixin_point_record` ( `pr_id`, `wxid`, `point_name`, `num`, `lasttime`, `datelinie` ) VALUES  ('37', 'o4EXIjv150gnUFyOBK_dtWags1ac', 'qiandao', '1', '1401534614', '1401534614');
INSERT INTO `ecs_weixin_point_record` ( `pr_id`, `wxid`, `point_name`, `num`, `lasttime`, `datelinie` ) VALUES  ('38', 'o4EXIjv150gnUFyOBK_dtWags1ac', 'hot', '1', '1401534627', '1401534627');
INSERT INTO `ecs_weixin_point_record` ( `pr_id`, `wxid`, `point_name`, `num`, `lasttime`, `datelinie` ) VALUES  ('39', 'o4EXIjv150gnUFyOBK_dtWags1ac', 'new', '1', '1401534646', '1401534646');
INSERT INTO `ecs_weixin_point_record` ( `pr_id`, `wxid`, `point_name`, `num`, `lasttime`, `datelinie` ) VALUES  ('40', 'o4EXIjuYB_usMQ_BiH5zxIP5FjBc', 'qiandao', '1', '1401535118', '1401535118');
INSERT INTO `ecs_weixin_point_record` ( `pr_id`, `wxid`, `point_name`, `num`, `lasttime`, `datelinie` ) VALUES  ('41', 'o4EXIjpWjXHPGOukCwgiSAf0eTRs', 'promote', '1', '1401542902', '1401542902');
INSERT INTO `ecs_weixin_point_record` ( `pr_id`, `wxid`, `point_name`, `num`, `lasttime`, `datelinie` ) VALUES  ('42', 'o4EXIjpWjXHPGOukCwgiSAf0eTRs', 'new', '1', '1401542923', '1401542923');
INSERT INTO `ecs_weixin_point_record` ( `pr_id`, `wxid`, `point_name`, `num`, `lasttime`, `datelinie` ) VALUES  ('43', 'o4EXIjhV8h8Yfm0P6lpeZA56L0dE', 'hot', '1', '1401544145', '1401544145');
INSERT INTO `ecs_weixin_point_record` ( `pr_id`, `wxid`, `point_name`, `num`, `lasttime`, `datelinie` ) VALUES  ('44', 'o4EXIjhV8h8Yfm0P6lpeZA56L0dE', 'promote', '1', '1401544155', '1401544155');
INSERT INTO `ecs_weixin_point_record` ( `pr_id`, `wxid`, `point_name`, `num`, `lasttime`, `datelinie` ) VALUES  ('45', 'o4EXIjhV8h8Yfm0P6lpeZA56L0dE', 'best', '1', '1401544161', '1401544161');
INSERT INTO `ecs_weixin_point_record` ( `pr_id`, `wxid`, `point_name`, `num`, `lasttime`, `datelinie` ) VALUES  ('46', 'o4EXIjhV8h8Yfm0P6lpeZA56L0dE', 'new', '1', '1401544165', '1401544165');
INSERT INTO `ecs_weixin_point_record` ( `pr_id`, `wxid`, `point_name`, `num`, `lasttime`, `datelinie` ) VALUES  ('47', 'o4EXIjhV8h8Yfm0P6lpeZA56L0dE', 'qiandao', '1', '1401544176', '1401544176');
INSERT INTO `ecs_weixin_point_record` ( `pr_id`, `wxid`, `point_name`, `num`, `lasttime`, `datelinie` ) VALUES  ('48', 'o4EXIjij0zCPjBOez48DO6BS3FDY', 'hot', '1', '1401548672', '1401548672');
INSERT INTO `ecs_weixin_point_record` ( `pr_id`, `wxid`, `point_name`, `num`, `lasttime`, `datelinie` ) VALUES  ('49', 'o4EXIjij0zCPjBOez48DO6BS3FDY', 'new', '1', '1401548691', '1401548691');
INSERT INTO `ecs_weixin_point_record` ( `pr_id`, `wxid`, `point_name`, `num`, `lasttime`, `datelinie` ) VALUES  ('50', 'o4EXIjmlUYoXByVUCToJ85JB7Z6Y', 'hot', '1', '1401553351', '1401553351');
INSERT INTO `ecs_weixin_point_record` ( `pr_id`, `wxid`, `point_name`, `num`, `lasttime`, `datelinie` ) VALUES  ('51', 'o4EXIjmlUYoXByVUCToJ85JB7Z6Y', 'best', '1', '1401553360', '1401553360');
INSERT INTO `ecs_weixin_point_record` ( `pr_id`, `wxid`, `point_name`, `num`, `lasttime`, `datelinie` ) VALUES  ('52', 'o4EXIjmlUYoXByVUCToJ85JB7Z6Y', 'new', '1', '1401553367', '1401553367');
INSERT INTO `ecs_weixin_point_record` ( `pr_id`, `wxid`, `point_name`, `num`, `lasttime`, `datelinie` ) VALUES  ('53', 'o4EXIjmlUYoXByVUCToJ85JB7Z6Y', 'promote', '1', '1401553373', '1401553373');
INSERT INTO `ecs_weixin_point_record` ( `pr_id`, `wxid`, `point_name`, `num`, `lasttime`, `datelinie` ) VALUES  ('54', 'o4EXIjlMx-9eov-Q-Y0ILF8Bhq-o', 'qiandao', '1', '1401578644', '1401578644');
DROP TABLE IF EXISTS `ecs_weixin_user`;
CREATE TABLE `ecs_weixin_user` (
  `uid` int(7) NOT NULL AUTO_INCREMENT,
  `subscribe` tinyint(1) unsigned NOT NULL,
  `wxid` char(28) NOT NULL,
  `nickname` varchar(200) NOT NULL,
  `sex` tinyint(1) unsigned NOT NULL,
  `city` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `province` varchar(100) NOT NULL,
  `language` varchar(50) NOT NULL,
  `headimgurl` varchar(200) NOT NULL,
  `subscribe_time` int(10) unsigned NOT NULL,
  `localimgurl` varchar(200) NOT NULL,
  `setp` smallint(2) unsigned NOT NULL,
  `uname` varchar(50) NOT NULL,
  `coupon` varchar(30) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `ecs_weixin_user` ( `uid`, `subscribe`, `wxid`, `nickname`, `sex`, `city`, `country`, `province`, `language`, `headimgurl`, `subscribe_time`, `localimgurl`, `setp`, `uname`, `coupon` ) VALUES  ('340', '0', 'oKIVft-swX4_pRDyWpN5VmswPZlE', '', '0', '', '', '', '', '', '0', '', '3', 'sclzz', '1000013001');
INSERT INTO `ecs_weixin_user` ( `uid`, `subscribe`, `wxid`, `nickname`, `sex`, `city`, `country`, `province`, `language`, `headimgurl`, `subscribe_time`, `localimgurl`, `setp`, `uname`, `coupon` ) VALUES  ('337', '0', 'oKIVft02ugRp0vX0XTkfJkXO_gs8', '', '0', '', '', '', '', '', '0', '', '0', '', '');
INSERT INTO `ecs_weixin_user` ( `uid`, `subscribe`, `wxid`, `nickname`, `sex`, `city`, `country`, `province`, `language`, `headimgurl`, `subscribe_time`, `localimgurl`, `setp`, `uname`, `coupon` ) VALUES  ('338', '0', 'oKIVft-We_6U2Lxak40Ht9jTmMKc', '', '0', '', '', '', '', '', '0', '', '3', 'weixin322', '1000020700');
INSERT INTO `ecs_weixin_user` ( `uid`, `subscribe`, `wxid`, `nickname`, `sex`, `city`, `country`, `province`, `language`, `headimgurl`, `subscribe_time`, `localimgurl`, `setp`, `uname`, `coupon` ) VALUES  ('339', '0', 'oKIVftyTI_air21Gqu1I-FhkW_9Y', '', '0', '', '', '', '', '', '0', '', '3', 'weixin339', '1000005399');
INSERT INTO `ecs_weixin_user` ( `uid`, `subscribe`, `wxid`, `nickname`, `sex`, `city`, `country`, `province`, `language`, `headimgurl`, `subscribe_time`, `localimgurl`, `setp`, `uname`, `coupon` ) VALUES  ('341', '0', 'oKIVft8XNakdy6x-4C-YlK_hKcrk', '', '0', '', '', '', '', '', '0', '', '0', '', '');
INSERT INTO `ecs_weixin_user` ( `uid`, `subscribe`, `wxid`, `nickname`, `sex`, `city`, `country`, `province`, `language`, `headimgurl`, `subscribe_time`, `localimgurl`, `setp`, `uname`, `coupon` ) VALUES  ('342', '0', 'oKIVft4Hk9gNczpAyszvsIYeGklU', '', '0', '', '', '', '', '', '0', '', '0', '', '');
INSERT INTO `ecs_weixin_user` ( `uid`, `subscribe`, `wxid`, `nickname`, `sex`, `city`, `country`, `province`, `language`, `headimgurl`, `subscribe_time`, `localimgurl`, `setp`, `uname`, `coupon` ) VALUES  ('343', '0', 'ommoAj12M_ghxvjKCtGFtqdYXWJk', '', '0', '', '', '', '', '', '0', '', '3', 'weixin343', '');
INSERT INTO `ecs_weixin_user` ( `uid`, `subscribe`, `wxid`, `nickname`, `sex`, `city`, `country`, `province`, `language`, `headimgurl`, `subscribe_time`, `localimgurl`, `setp`, `uname`, `coupon` ) VALUES  ('344', '0', 'ommoAj5Z_0unAnWNFccgDBAcEsXY', '', '0', '', '', '', '', '', '0', '', '3', '沈五洲', '');
INSERT INTO `ecs_weixin_user` ( `uid`, `subscribe`, `wxid`, `nickname`, `sex`, `city`, `country`, `province`, `language`, `headimgurl`, `subscribe_time`, `localimgurl`, `setp`, `uname`, `coupon` ) VALUES  ('345', '0', 'o4EXIjrOf_sjptK4eKwFGBkY7m38', '', '0', '', '', '', '', '', '0', '', '1', 'weixin345', '');
INSERT INTO `ecs_weixin_user` ( `uid`, `subscribe`, `wxid`, `nickname`, `sex`, `city`, `country`, `province`, `language`, `headimgurl`, `subscribe_time`, `localimgurl`, `setp`, `uname`, `coupon` ) VALUES  ('346', '0', 'o4EXIjsLxvfmW6e17QznVU0AWNTk', '', '0', '', '', '', '', '', '0', '', '3', 'weixin346', '');
INSERT INTO `ecs_weixin_user` ( `uid`, `subscribe`, `wxid`, `nickname`, `sex`, `city`, `country`, `province`, `language`, `headimgurl`, `subscribe_time`, `localimgurl`, `setp`, `uname`, `coupon` ) VALUES  ('347', '0', 'o4EXIjn7M-PYQIe5MBfkrHGqtLq0', '', '0', '', '', '', '', '', '0', '', '3', 'weixin347', '');
INSERT INTO `ecs_weixin_user` ( `uid`, `subscribe`, `wxid`, `nickname`, `sex`, `city`, `country`, `province`, `language`, `headimgurl`, `subscribe_time`, `localimgurl`, `setp`, `uname`, `coupon` ) VALUES  ('348', '0', 'o4EXIjmpnWvS8QDcPJaV7N68IcJw', '', '0', '', '', '', '', '', '0', '', '3', 'weixin348', '');
INSERT INTO `ecs_weixin_user` ( `uid`, `subscribe`, `wxid`, `nickname`, `sex`, `city`, `country`, `province`, `language`, `headimgurl`, `subscribe_time`, `localimgurl`, `setp`, `uname`, `coupon` ) VALUES  ('349', '0', 'o4EXIjj0uLyJZg2YfN5qBOWZ0dqg', '', '0', '', '', '', '', '', '0', '', '1', 'weixin349', '');
INSERT INTO `ecs_weixin_user` ( `uid`, `subscribe`, `wxid`, `nickname`, `sex`, `city`, `country`, `province`, `language`, `headimgurl`, `subscribe_time`, `localimgurl`, `setp`, `uname`, `coupon` ) VALUES  ('350', '0', 'o4EXIjjEiZ5kdHDrTniI9rUF3z_w', '', '0', '', '', '', '', '', '0', '', '3', 'weixin350', '');
INSERT INTO `ecs_weixin_user` ( `uid`, `subscribe`, `wxid`, `nickname`, `sex`, `city`, `country`, `province`, `language`, `headimgurl`, `subscribe_time`, `localimgurl`, `setp`, `uname`, `coupon` ) VALUES  ('351', '0', 'o4EXIjsZO8fisqsGLlgep8rfunek', '', '0', '', '', '', '', '', '0', '', '3', 'weixin351', '');
INSERT INTO `ecs_weixin_user` ( `uid`, `subscribe`, `wxid`, `nickname`, `sex`, `city`, `country`, `province`, `language`, `headimgurl`, `subscribe_time`, `localimgurl`, `setp`, `uname`, `coupon` ) VALUES  ('352', '0', 'o4EXIjpzr5gtMQc_--84aImHsYWk', '', '0', '', '', '', '', '', '0', '', '3', 'weixin352', '');
INSERT INTO `ecs_weixin_user` ( `uid`, `subscribe`, `wxid`, `nickname`, `sex`, `city`, `country`, `province`, `language`, `headimgurl`, `subscribe_time`, `localimgurl`, `setp`, `uname`, `coupon` ) VALUES  ('353', '0', 'o4EXIjlMx-9eov-Q-Y0ILF8Bhq-o', '', '0', '', '', '', '', '', '0', '', '3', 'weixin353', '');
INSERT INTO `ecs_weixin_user` ( `uid`, `subscribe`, `wxid`, `nickname`, `sex`, `city`, `country`, `province`, `language`, `headimgurl`, `subscribe_time`, `localimgurl`, `setp`, `uname`, `coupon` ) VALUES  ('354', '0', 'o4EXIjrwezlc-fWC1wayMscxeJPo', '', '0', '', '', '', '', '', '0', '', '0', '', '');
INSERT INTO `ecs_weixin_user` ( `uid`, `subscribe`, `wxid`, `nickname`, `sex`, `city`, `country`, `province`, `language`, `headimgurl`, `subscribe_time`, `localimgurl`, `setp`, `uname`, `coupon` ) VALUES  ('355', '0', 'o4EXIjmEyBusE_ObYIJ14UuM0Ndg', '', '0', '', '', '', '', '', '0', '', '3', 'weixin355', '');
INSERT INTO `ecs_weixin_user` ( `uid`, `subscribe`, `wxid`, `nickname`, `sex`, `city`, `country`, `province`, `language`, `headimgurl`, `subscribe_time`, `localimgurl`, `setp`, `uname`, `coupon` ) VALUES  ('356', '0', 'o4EXIjhxxKRueTtb512iqqBQ1jSQ', '', '0', '', '', '', '', '', '0', '', '3', 'weixin356', '');
INSERT INTO `ecs_weixin_user` ( `uid`, `subscribe`, `wxid`, `nickname`, `sex`, `city`, `country`, `province`, `language`, `headimgurl`, `subscribe_time`, `localimgurl`, `setp`, `uname`, `coupon` ) VALUES  ('357', '0', 'o4EXIjv150gnUFyOBK_dtWags1ac', '', '0', '', '', '', '', '', '0', '', '0', '', '');
INSERT INTO `ecs_weixin_user` ( `uid`, `subscribe`, `wxid`, `nickname`, `sex`, `city`, `country`, `province`, `language`, `headimgurl`, `subscribe_time`, `localimgurl`, `setp`, `uname`, `coupon` ) VALUES  ('358', '0', 'o4EXIjuYB_usMQ_BiH5zxIP5FjBc', '', '0', '', '', '', '', '', '0', '', '0', '', '');
INSERT INTO `ecs_weixin_user` ( `uid`, `subscribe`, `wxid`, `nickname`, `sex`, `city`, `country`, `province`, `language`, `headimgurl`, `subscribe_time`, `localimgurl`, `setp`, `uname`, `coupon` ) VALUES  ('359', '0', 'o4EXIjpWjXHPGOukCwgiSAf0eTRs', '', '0', '', '', '', '', '', '0', '', '0', '', '');
INSERT INTO `ecs_weixin_user` ( `uid`, `subscribe`, `wxid`, `nickname`, `sex`, `city`, `country`, `province`, `language`, `headimgurl`, `subscribe_time`, `localimgurl`, `setp`, `uname`, `coupon` ) VALUES  ('360', '0', 'o4EXIjhV8h8Yfm0P6lpeZA56L0dE', '', '0', '', '', '', '', '', '0', '', '3', 'weixin360', '');
INSERT INTO `ecs_weixin_user` ( `uid`, `subscribe`, `wxid`, `nickname`, `sex`, `city`, `country`, `province`, `language`, `headimgurl`, `subscribe_time`, `localimgurl`, `setp`, `uname`, `coupon` ) VALUES  ('361', '0', 'o4EXIjij0zCPjBOez48DO6BS3FDY', '', '0', '', '', '', '', '', '0', '', '3', 'weixin361', '');
INSERT INTO `ecs_weixin_user` ( `uid`, `subscribe`, `wxid`, `nickname`, `sex`, `city`, `country`, `province`, `language`, `headimgurl`, `subscribe_time`, `localimgurl`, `setp`, `uname`, `coupon` ) VALUES  ('362', '0', 'o4EXIjmZxb0fUU3_v27yTiJ9aSGQ', '', '0', '', '', '', '', '', '0', '', '3', 'weixin362', '');
INSERT INTO `ecs_weixin_user` ( `uid`, `subscribe`, `wxid`, `nickname`, `sex`, `city`, `country`, `province`, `language`, `headimgurl`, `subscribe_time`, `localimgurl`, `setp`, `uname`, `coupon` ) VALUES  ('363', '0', 'o4EXIjnSI-k4ViZfKvTAzDOFMmPI', '', '0', '', '', '', '', '', '0', '', '3', 'weixin363', '');
INSERT INTO `ecs_weixin_user` ( `uid`, `subscribe`, `wxid`, `nickname`, `sex`, `city`, `country`, `province`, `language`, `headimgurl`, `subscribe_time`, `localimgurl`, `setp`, `uname`, `coupon` ) VALUES  ('364', '0', 'o4EXIjmlUYoXByVUCToJ85JB7Z6Y', '', '0', '', '', '', '', '', '0', '', '3', 'weixin364', '');
INSERT INTO `ecs_weixin_user` ( `uid`, `subscribe`, `wxid`, `nickname`, `sex`, `city`, `country`, `province`, `language`, `headimgurl`, `subscribe_time`, `localimgurl`, `setp`, `uname`, `coupon` ) VALUES  ('365', '0', 'o4EXIjvbvSHxCw5MQWMV0_1PU-tk', '', '0', '', '', '', '', '', '0', '', '3', 'weixin365', '');
INSERT INTO `ecs_weixin_user` ( `uid`, `subscribe`, `wxid`, `nickname`, `sex`, `city`, `country`, `province`, `language`, `headimgurl`, `subscribe_time`, `localimgurl`, `setp`, `uname`, `coupon` ) VALUES  ('366', '0', 'o4EXIjksi1FYid5PwseXgxyyJQog', '', '0', '', '', '', '', '', '0', '', '3', 'weixin366', '');
-- END ecshop v2.x SQL Dump Program 