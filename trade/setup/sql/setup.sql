-- --------------------------------------------------------

-- 
-- 表的结构 `{key}blob`
-- 

CREATE TABLE `{key}blob` (
  `id` smallint(4) unsigned NOT NULL auto_increment,
  `title` varchar(255) NOT NULL,
  `content` varchar(255) default NULL,
  `create_time` int(11) unsigned NOT NULL,
  `status` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

-- 
-- 导出表中的数据 `{key}blob`
-- 

-- --------------------------------------------------------

-- 
-- 表的结构 `{key}form`
-- 

CREATE TABLE `{key}form` (
  `id` smallint(4) unsigned NOT NULL auto_increment,
  `title` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `create_time` int(11) unsigned NOT NULL,
  `update_time` int(11) unsigned NOT NULL,
  `status` tinyint(1) unsigned NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;


-- 
-- 表的结构 `{key}attach`
-- 

CREATE TABLE `{key}attach` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) default NULL,
  `size` varchar(20) NOT NULL,
  `extension` varchar(20) NOT NULL,
  `savepath` varchar(255) NOT NULL,
  `savename` varchar(255) NOT NULL,
  `module` varchar(100) NOT NULL,
  `recordId` int(11) NOT NULL,
  `userId` int(11) unsigned default NULL,
  `uploadTime` int(11) unsigned default NULL,
  `downCount` mediumint(9) unsigned default '0',
  `hash` varchar(32) NOT NULL,
  `verify` varchar(8) NOT NULL,
  `remark` varchar(255) default NULL,
  `version` mediumint(6) unsigned NOT NULL default '0',
  `updateTime` int(12) unsigned default NULL,
  `downloadTime` int(11) unsigned NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `module` (`module`),
  KEY `recordId` (`recordId`),
  KEY `userId` (`userId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `{key}attach`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `{key}blog`
-- 

CREATE TABLE `{key}blog` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(15) NOT NULL default '',
  `userId` mediumint(5) unsigned NOT NULL default '0',
  `categoryId` smallint(5) unsigned NOT NULL,
  `title` varchar(255) NOT NULL default '',
  `content` longtext,
  `cTime` int(11) unsigned NOT NULL default '0',
  `mTime` int(11) unsigned NOT NULL default '0',
  `status` tinyint(1) unsigned NOT NULL default '0',
  `readCount` mediumint(5) unsigned NOT NULL default '0',
  `commentCount` mediumint(5) unsigned NOT NULL default '0',
  `tags` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `{key}blog`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `{key}category`
-- 

CREATE TABLE `{key}category` (
  `id` mediumint(5) unsigned NOT NULL auto_increment,
  `name` varchar(30) NOT NULL default '',
  `title` varchar(50) NOT NULL default '',
  `remark` varchar(255) NOT NULL default '',
  `status` tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `{key}category`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `{key}comment`
-- 

CREATE TABLE `{key}comment` (
  `id` mediumint(5) unsigned NOT NULL auto_increment,
  `recordId` int(11) unsigned NOT NULL default '0',
  `author` varchar(50) NOT NULL default '',
  `email` varchar(255) NOT NULL default '',
  `url` varchar(255) NOT NULL default '',
  `ip` varchar(25) NOT NULL default '',
  `content` text NOT NULL,
  `cTime` int(11) unsigned NOT NULL default '0',
  `agent` varchar(255) default NULL,
  `status` tinyint(1) unsigned NOT NULL default '0',
  `module` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `{key}comment`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `{key}tag`
-- 

CREATE TABLE `{key}tag` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `count` mediumint(6) unsigned NOT NULL,
  `module` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `name` (`name`),
  KEY `module` (`module`),
  KEY `count` (`count`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `{key}tag`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `{key}tagged`
-- 

CREATE TABLE `{key}tagged` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `userId` int(11) unsigned NOT NULL,
  `recordId` int(11) unsigned NOT NULL,
  `tagId` int(11) NOT NULL,
  `tagTime` int(11) NOT NULL,
  `module` varchar(25) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `module` (`module`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `{key}tagged`
-- 

CREATE TABLE `{key}group` (
  `id` smallint(6) unsigned NOT NULL auto_increment,
  `name` varchar(20) NOT NULL,
  `pid` smallint(6) default NULL,
  `status` tinyint(1) unsigned default NULL,
  `remark` varchar(255) default NULL,
  `ename` varchar(5) default NULL,
  PRIMARY KEY  (`id`),
  KEY `parentId` (`pid`),
  KEY `ename` (`ename`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;



--
-- 表的结构 `{key}groupuser`
--

CREATE TABLE `{key}groupuser` (
  `groupId` mediumint(9) unsigned default NULL,
  `userId` mediumint(9) unsigned default NULL,
  KEY `groupId` (`groupId`),
  KEY `userId` (`userId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 导出表中的数据 `{key}groupuser`
--


-- --------------------------------------------------------

--
-- 表的结构 `{key}node`
--

CREATE TABLE `{key}node` (
  `id` smallint(6) unsigned NOT NULL auto_increment,
  `name` varchar(20) NOT NULL,
  `title` varchar(50) default NULL,
  `status` tinyint(1) unsigned default NULL,
  `remark` varchar(255) default NULL,
  `seqNo` smallint(6) unsigned default NULL,
  `pid` smallint(6) unsigned NOT NULL default '0',
  `level` tinyint(1) unsigned NOT NULL default '0',
  `type` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `name` (`name`),
  KEY `parentId` (`pid`),
  KEY `level` (`level`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;



--
-- 表的结构 `{key}user`
--

CREATE TABLE `{key}user` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `account` varchar(64) NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `password` char(32) NOT NULL,
  `remark` varchar(255) NOT NULL,
  `create_time` int(11) unsigned NOT NULL,
  `update_time` int(11) unsigned NOT NULL,
  `status` tinyint(1) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;



CREATE TABLE `{key}access` (
  `groupId` smallint(6) unsigned NOT NULL,
  `nodeId` smallint(6) unsigned NOT NULL,
  `level` tinyint(1) NOT NULL,
  `parentNodeId` smallint(6) NOT NULL default '0',
  `status` tinyint(1) default NULL,
  KEY `groupId` (`groupId`),
  KEY `nodeId` (`nodeId`),
  KEY `level` (`level`),
  KEY `parentNodeId` (`parentNodeId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

