

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `{key}friendlink`
-- ----------------------------
DROP TABLE IF EXISTS `{key}friendlink`;
CREATE TABLE `{key}friendlink` (
  `fid` int(11) NOT NULL auto_increment,
  `title` varchar(200) NOT NULL,
  `pic` varchar(200) default NULL,
  `link` varchar(255) default '#',
  `dateline` varchar(25) NOT NULL,
  `isshow` int(1) NOT NULL default '0',
  `orderby` int(11) NOT NULL default '0',
  PRIMARY KEY  (`fid`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of {key}friendlink
-- ----------------------------
INSERT INTO `{key}friendlink` VALUES ('7', '莆田在线', '4b4added0325b.gif', 'http://www.0594.com', '1263197677', '1', '2');


-- ----------------------------
-- Table structure for `{key}invite`
-- ----------------------------
DROP TABLE IF EXISTS `{key}invite`;
CREATE TABLE `{key}invite` (
  `id` int(11) NOT NULL auto_increment,
  `vipuid` int(11) default '0',
  `uid` int(11) default '0',
  `pid` int(11) default '0',
  `dateline` int(11) default '0',
  `note` mediumtext,
  `replyid` int(11) default '0',
  `reading` int(1) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1460 DEFAULT CHARSET=utf8;


-- ----------------------------
-- Table structure for `{key}job`
-- ----------------------------
DROP TABLE IF EXISTS `{key}job`;
CREATE TABLE `{key}job` (
  `jid` int(11) unsigned NOT NULL auto_increment,
  `uid` int(11) default '0',
  `cid` int(11) default NULL,
  `zsname` varchar(50) default NULL,
  `sex` varchar(10) default NULL,
  `bday` varchar(50) default NULL,
  `school` varchar(255) default NULL,
  `edu` varchar(100) default NULL,
  `subject` varchar(100) default NULL,
  `waiyuclass` varchar(50) default NULL,
  `waiyusp` varchar(50) default NULL,
  `jobclass` varchar(255) default NULL,
  `birthplace` varchar(100) default NULL,
  `tel` varchar(100) default NULL,
  `mobile` varchar(50) default NULL,
  `email` varchar(255) default NULL,
  `qq` varchar(255) default NULL,
  `address` varchar(255) default NULL,
  `money` varchar(10) default NULL,
  `dateline` int(11) default '0',
  `postip` varchar(15) default NULL,
  `ispass` int(1) default '0',
  `introduction` mediumtext,
  `click` int(11) default '0',
  `status` int(1) default NULL,
  `office1` varchar(20) default NULL,
  `joffice1` varchar(20) default NULL,
  `office2` varchar(20) default NULL,
  `joffice2` varchar(20) default NULL,
  `people` varchar(10) default NULL,
  `height` varchar(10) default NULL,
  `visage` varchar(10) default NULL,
  `workexp` varchar(20) default NULL,
  `health` varchar(20) default NULL,
  `marriage` varchar(10) default NULL,
  `jsubject` varchar(20) default NULL,
  `workintro` mediumtext,
  `virtue` varchar(255) default NULL,
  `award` varchar(255) default NULL,
  `photoimg` varchar(255) default NULL,
  `photourl` varchar(255) default NULL,
  `workplace` varchar(50) default NULL,
  `isstatus` int(10) default NULL COMMENT '启用与否',
  `bz_dateline` int(11) default NULL,
  `regdate` varchar(20) default NULL,
  `score` int(3) NOT NULL default '0',
  PRIMARY KEY  (`jid`),
  KEY `jobdateline` (`dateline`)
) ENGINE=MyISAM AUTO_INCREMENT=58960 DEFAULT CHARSET=utf8;


-- ----------------------------
-- Table structure for `{key}join`
-- ----------------------------
DROP TABLE IF EXISTS `{key}join`;
CREATE TABLE `{key}join` (
  `joinid` int(11) NOT NULL auto_increment,
  `uid` int(11) default '0',
  `jid` int(50) default '0',
  `dateline` int(11) default NULL,
  `reading` int(1) NOT NULL default '0',
  `note` varchar(255)  default NULL,
  `replyid` int(11) default '0',
  PRIMARY KEY  (`joinid`)
) ENGINE=MyISAM AUTO_INCREMENT=5533 DEFAULT CHARSET=utf8;



-- ----------------------------
-- Table structure for `{key}news`
-- ----------------------------
DROP TABLE IF EXISTS `{key}news`;
CREATE TABLE `{key}news` (
  `nid` int(11) NOT NULL auto_increment,
  `uid` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `subject` mediumtext NOT NULL,
  `message` longtext NOT NULL,
  `catid` int(11) NOT NULL,
  `type` varchar(50) default NULL,
  `tags` longtext,
  `postip` varchar(20) default NULL,
  `dateline` varchar(20) default NULL,
  `lastpost` varchar(20) default NULL,
  `viewnum` int(11) default '0',
  `replaynum` int(11) default '0',
  `grade` int(2) default '0',
  `state` int(5) default NULL,
  `author` varchar(100) default NULL,
  `storename` varchar(200) default NULL,
  `isnew` int(2) default NULL,
  `ishot` int(2) default NULL,
  `isrec` int(2) default NULL,
  `varaddr` varchar(20) default NULL,
  PRIMARY KEY  (`nid`)
) ENGINE=MyISAM AUTO_INCREMENT=282 DEFAULT CHARSET=utf8;


-- ----------------------------
-- Table structure for `{key}newsclass`
-- ----------------------------
DROP TABLE IF EXISTS `{key}newsclass`;
CREATE TABLE `{key}newsclass` (
  `cid` int(11) NOT NULL auto_increment,
  `classname` varchar(200) character set utf8 default NULL,
  `upid` int(11) default NULL,
  `type` varchar(200) character set utf8 default NULL,
  `orderby` varchar(20) default NULL,
  PRIMARY KEY  (`cid`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of {key}newsclass
-- ----------------------------
INSERT INTO `{key}newsclass` VALUES ('6', '信息采编', '0', '', '0');
INSERT INTO `{key}newsclass` VALUES ('4', '企业发布', null, null, null);
INSERT INTO `{key}newsclass` VALUES ('5', '人才资讯', '0', 'job', '0');

-- ----------------------------
-- Table structure for `{key}people`
-- ----------------------------
DROP TABLE IF EXISTS `{key}people`;
CREATE TABLE `{key}people` (
  `pid` int(10) unsigned NOT NULL auto_increment,
  `uid` int(11) default '0',
  `vipid` int(11) default '0',
  `qyname` varchar(255) default NULL,
  `title` varchar(50) default NULL,
  `office` varchar(255) default NULL,
  `body` int(11) default NULL,
  `edu` varchar(50) default NULL,
  `subject` varchar(255) default NULL,
  `other` mediumtext,
  `money` varchar(255) default NULL,
  `about` mediumtext,
  `address` varchar(255) default NULL,
  `tel` varchar(50) default NULL,
  `email` varchar(100) default NULL,
  `postip` varchar(15) default NULL,
  `dateline` int(11) default '0',
  `ispass` int(1) default '0',
  `click` int(11) default '0',
  `status` int(1) default NULL,
  `efftime` int(11) NOT NULL,
  `orderdateline` int(11) NOT NULL,
  `joffice` varchar(50) default NULL,
  `photoimg` varchar(255) default NULL,
  `workexp` varchar(50) default NULL,
  `sex` varchar(255) default NULL,
  `jobclass` varchar(10) default NULL,
  `photourl` varchar(255) default NULL,
  `workplace` varchar(255) default NULL,
  `urgent` varchar(5) default NULL,
  `paid` varchar(5) default NULL,
  `hotnumber` int(11) NOT NULL default '0',
  `color` varchar(7) default NULL,
  `colordate` varchar(20) default NULL,
  PRIMARY KEY  (`pid`),
  KEY `peopledateline` (`dateline`)
) ENGINE=MyISAM AUTO_INCREMENT=3682 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of {key}people
-- ----------------------------


-- ----------------------------
-- Table structure for `{key}pinjinrecord`
-- ----------------------------
DROP TABLE IF EXISTS `{key}pinjinrecord`;
CREATE TABLE `{key}pinjinrecord` (
  `pjid` int(11) NOT NULL auto_increment,
  `vid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `xmid` int(2) NOT NULL,
  `danwei` char(6) default NULL,
  `number` int(11) default NULL,
  `addpinjin` int(11) default NULL,
  `minuspinjin` int(11) default NULL,
  `lastpinjin` int(11) default NULL,
  `latestpinjin` int(11) default NULL,
  `dateline` varchar(20) NOT NULL,
  PRIMARY KEY  (`pjid`)
) ENGINE=MyISAM AUTO_INCREMENT=4562 DEFAULT CHARSET=utf8;


-- ----------------------------
-- Table structure for `{key}recode`
-- ----------------------------
DROP TABLE IF EXISTS `{key}recode`;
CREATE TABLE `{key}recode` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) default NULL,
  `itemid` int(11) default NULL,
  `type` varchar(255) default NULL,
  `dateline` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20885 DEFAULT CHARSET=utf8;



-- ----------------------------
-- Table structure for `{key}result`
-- ----------------------------
DROP TABLE IF EXISTS `{key}result`;
CREATE TABLE `{key}result` (
  `rid` int(11) NOT NULL auto_increment,
  `vipid` int(11) NOT NULL,
  `money` float NOT NULL default '0',
  `gift` int(11) NOT NULL default '0',
  `pinjin` int(11) NOT NULL,
  `actionuid` int(11) NOT NULL,
  `xmtype` int(11) NOT NULL,
  `dateline` int(11) NOT NULL,
  PRIMARY KEY  (`rid`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;



-- ----------------------------
-- Table structure for `{key}simplejob`
-- ----------------------------
DROP TABLE IF EXISTS `{key}simplejob`;
CREATE TABLE `{key}simplejob` (
  `sid` int(8) NOT NULL auto_increment,
  `uid` int(11) NOT NULL,
  `posts` varchar(50) NOT NULL,
  `nature` varchar(10) default NULL,
  `number` int(4) NOT NULL,
  `request` varchar(255) NOT NULL,
  `tel` varchar(50) NOT NULL,
  `linkname` varchar(20) NOT NULL,
  `company` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `dateline` int(11) NOT NULL,
  `updatedateline` int(11) NOT NULL,
  `ip` char(15) default NULL,
  `status` int(1) NOT NULL default '0',
  PRIMARY KEY  (`sid`)
) ENGINE=MyISAM AUTO_INCREMENT=513 DEFAULT CHARSET=utf8;


-- ----------------------------
-- Table structure for `{key}xmtype`
-- ----------------------------
DROP TABLE IF EXISTS `{key}xmtype`;
CREATE TABLE `{key}xmtype` (
  `xmid` int(2) NOT NULL,
  `xmname` varchar(20) NOT NULL,
  `pinjin` int(11) NOT NULL default '0',
  `orderby` int(1) NOT NULL default '0',
  `biaozi` varchar(20) default NULL,
  PRIMARY KEY  (`xmid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



-- ----------------------------
-- Table structure for `{key}yinping`
-- ----------------------------
DROP TABLE IF EXISTS `{key}yinping`;
CREATE TABLE `{key}yinping` (
  `uid` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(20) character set utf8 default NULL,
  `sex` varchar(10) character set utf8 default NULL,
  `birthday` date default NULL,
  `tel` int(11) default NULL,
  `email` varchar(50) default NULL,
  `zhiwei` varchar(30) character set utf8 default NULL,
  `school` varchar(50) character set utf8 default NULL,
  `specialty` varchar(100) character set utf8 default NULL,
  `xueli` varchar(100) character set utf8 default NULL,
  `zijianshu` varchar(5000) character set utf8 default NULL,
  `jid` int(100) default NULL,
  `dateline` int(11) default NULL,
  PRIMARY KEY  (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=203 DEFAULT CHARSET=utf8;


