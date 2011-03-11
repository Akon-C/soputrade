CREATE TABLE IF NOT EXISTS `{key}access` (
  `role_id` smallint(6) unsigned NOT NULL,
  `node_id` smallint(6) unsigned NOT NULL,
  `level` tinyint(1) NOT NULL,
  `module` varchar(50) DEFAULT NULL,
  KEY `groupId` (`role_id`),
  KEY `nodeId` (`node_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `{key}access` (`role_id`, `node_id`, `level`, `module`) VALUES(2, 13, 0, NULL);
INSERT INTO `{key}access` (`role_id`, `node_id`, `level`, `module`) VALUES(2, 14, 0, NULL);
INSERT INTO `{key}access` (`role_id`, `node_id`, `level`, `module`) VALUES(1, 17, 0, NULL);
INSERT INTO `{key}access` (`role_id`, `node_id`, `level`, `module`) VALUES(1, 8, 0, NULL);
INSERT INTO `{key}access` (`role_id`, `node_id`, `level`, `module`) VALUES(2, 15, 0, NULL);
INSERT INTO `{key}access` (`role_id`, `node_id`, `level`, `module`) VALUES(2, 18, 0, NULL);
INSERT INTO `{key}access` (`role_id`, `node_id`, `level`, `module`) VALUES(2, 16, 0, NULL);
INSERT INTO `{key}access` (`role_id`, `node_id`, `level`, `module`) VALUES(11, 15, 0, NULL);
INSERT INTO `{key}access` (`role_id`, `node_id`, `level`, `module`) VALUES(11, 14, 0, NULL);
INSERT INTO `{key}access` (`role_id`, `node_id`, `level`, `module`) VALUES(11, 13, 0, NULL);
INSERT INTO `{key}access` (`role_id`, `node_id`, `level`, `module`) VALUES(11, 10, 0, NULL);
INSERT INTO `{key}access` (`role_id`, `node_id`, `level`, `module`) VALUES(2, 17, 0, NULL);
INSERT INTO `{key}access` (`role_id`, `node_id`, `level`, `module`) VALUES(2, 8, 0, NULL);
INSERT INTO `{key}access` (`role_id`, `node_id`, `level`, `module`) VALUES(2, 10, 0, NULL);
INSERT INTO `{key}access` (`role_id`, `node_id`, `level`, `module`) VALUES(1, 16, 0, NULL);
INSERT INTO `{key}access` (`role_id`, `node_id`, `level`, `module`) VALUES(1, 19, 0, NULL);
INSERT INTO `{key}access` (`role_id`, `node_id`, `level`, `module`) VALUES(1, 18, 0, NULL);
INSERT INTO `{key}access` (`role_id`, `node_id`, `level`, `module`) VALUES(1, 15, 0, NULL);
INSERT INTO `{key}access` (`role_id`, `node_id`, `level`, `module`) VALUES(1, 14, 0, NULL);
INSERT INTO `{key}access` (`role_id`, `node_id`, `level`, `module`) VALUES(1, 13, 0, NULL);
INSERT INTO `{key}access` (`role_id`, `node_id`, `level`, `module`) VALUES(1, 10, 0, NULL);



CREATE TABLE IF NOT EXISTS `{key}ad` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `img_url` varchar(50) DEFAULT NULL,
  `content` text NOT NULL,
  `code` varchar(50) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `remark` varchar(50) DEFAULT NULL,
  `sort` int(3) NOT NULL DEFAULT '0',
  `link` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='广告' AUTO_INCREMENT=37 ;





CREATE TABLE IF NOT EXISTS `{key}article` (
  `article_id` int(11) NOT NULL AUTO_INCREMENT,
  `article_title` varchar(255) NOT NULL,
  `article_content` text,
  `article_cateid` int(11) DEFAULT '0',
  `keywords` text,
  `description` text,
  `status` int(4) DEFAULT '1',
  `imgurl` varchar(255) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  PRIMARY KEY (`article_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;





CREATE TABLE IF NOT EXISTS `{key}article_cate` (
  `article_cateid` int(11) NOT NULL AUTO_INCREMENT,
  `article_catename` varchar(255) NOT NULL,
  `article_cate_desc` text,
  `article_parent_cateid` int(11) DEFAULT '0',
  `keywords` text,
  `description` text,
  `status` int(4) DEFAULT '1',
  `imgurl` varchar(255) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  PRIMARY KEY (`article_cateid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;





CREATE TABLE IF NOT EXISTS `{key}billsprintsetting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Express` varchar(50) DEFAULT NULL,
  `filed` varchar(50) DEFAULT NULL,
  `top` int(11) DEFAULT NULL,
  `left` int(11) DEFAULT NULL,
  `width` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=58 ;


INSERT INTO `{key}billsprintsetting` (`id`, `Express`, `filed`, `top`, `left`, `width`, `height`) VALUES(1, 'ems', 'sender_sname', 104, 152, 77, 25);
INSERT INTO `{key}billsprintsetting` (`id`, `Express`, `filed`, `top`, `left`, `width`, `height`) VALUES(2, 'ems', 'sender_tel', 114, 242, 189, 20);
INSERT INTO `{key}billsprintsetting` (`id`, `Express`, `filed`, `top`, `left`, `width`, `height`) VALUES(3, 'ems', 'sender_address', 197, 146, 290, 66);
INSERT INTO `{key}billsprintsetting` (`id`, `Express`, `filed`, `top`, `left`, `width`, `height`) VALUES(4, 'ems', 'sender_country', 146, 240, 75, 20);
INSERT INTO `{key}billsprintsetting` (`id`, `Express`, `filed`, `top`, `left`, `width`, `height`) VALUES(5, 'ems', 'sender_region', 146, 355, 75, 20);
INSERT INTO `{key}billsprintsetting` (`id`, `Express`, `filed`, `top`, `left`, `width`, `height`) VALUES(6, 'ems', 'sender_city', 135, 125, 104, 25);
INSERT INTO `{key}billsprintsetting` (`id`, `Express`, `filed`, `top`, `left`, `width`, `height`) VALUES(7, 'ems', 'sender_zip', 264, 176, 61, 20);
INSERT INTO `{key}billsprintsetting` (`id`, `Express`, `filed`, `top`, `left`, `width`, `height`) VALUES(8, 'ems', 'delivery_name', 69, 518, 276, 25);
INSERT INTO `{key}billsprintsetting` (`id`, `Express`, `filed`, `top`, `left`, `width`, `height`) VALUES(9, 'ems', 'delivery_city', 104, 496, 100, 25);
INSERT INTO `{key}billsprintsetting` (`id`, `Express`, `filed`, `top`, `left`, `width`, `height`) VALUES(10, 'ems', 'delivery_country', 104, 679, 55, 25);
INSERT INTO `{key}billsprintsetting` (`id`, `Express`, `filed`, `top`, `left`, `width`, `height`) VALUES(11, 'ems', 'delivery_state', 104, 745, 57, 25);
INSERT INTO `{key}billsprintsetting` (`id`, `Express`, `filed`, `top`, `left`, `width`, `height`) VALUES(12, 'ems', 'delivery_address', 165, 506, 296, 59);
INSERT INTO `{key}billsprintsetting` (`id`, `Express`, `filed`, `top`, `left`, `width`, `height`) VALUES(13, 'ems', 'delivery_zip', 240, 447, 141, 21);
INSERT INTO `{key}billsprintsetting` (`id`, `Express`, `filed`, `top`, `left`, `width`, `height`) VALUES(14, 'ems', 'delivery_telephone', 240, 607, 197, 21);
INSERT INTO `{key}billsprintsetting` (`id`, `Express`, `filed`, `top`, `left`, `width`, `height`) VALUES(16, 'dhl', 'sender_sname', 134, 218, 115, 25);
INSERT INTO `{key}billsprintsetting` (`id`, `Express`, `filed`, `top`, `left`, `width`, `height`) VALUES(17, 'dhl', 'sender_tel', 267, 205, 134, 22);
INSERT INTO `{key}billsprintsetting` (`id`, `Express`, `filed`, `top`, `left`, `width`, `height`) VALUES(18, 'dhl', 'sender_address', 224, 103, 242, 25);
INSERT INTO `{key}billsprintsetting` (`id`, `Express`, `filed`, `top`, `left`, `width`, `height`) VALUES(19, 'dhl', 'sender_country', 178, 145, 75, 20);
INSERT INTO `{key}billsprintsetting` (`id`, `Express`, `filed`, `top`, `left`, `width`, `height`) VALUES(20, 'dhl', 'sender_region', 203, 101, 85, 20);
INSERT INTO `{key}billsprintsetting` (`id`, `Express`, `filed`, `top`, `left`, `width`, `height`) VALUES(21, 'dhl', 'sender_city', 201, 185, 87, 25);
INSERT INTO `{key}billsprintsetting` (`id`, `Express`, `filed`, `top`, `left`, `width`, `height`) VALUES(22, 'dhl', 'sender_zip', 269, 108, 88, 20);
INSERT INTO `{key}billsprintsetting` (`id`, `Express`, `filed`, `top`, `left`, `width`, `height`) VALUES(23, 'dhl', 'delivery_name', 455, 62, 142, 25);
INSERT INTO `{key}billsprintsetting` (`id`, `Express`, `filed`, `top`, `left`, `width`, `height`) VALUES(24, 'dhl', 'delivery_city', 338, 131, 100, 25);
INSERT INTO `{key}billsprintsetting` (`id`, `Express`, `filed`, `top`, `left`, `width`, `height`) VALUES(25, 'dhl', 'delivery_country', 425, 259, 89, 25);
INSERT INTO `{key}billsprintsetting` (`id`, `Express`, `filed`, `top`, `left`, `width`, `height`) VALUES(26, 'dhl', 'delivery_state', 339, 68, 57, 25);
INSERT INTO `{key}billsprintsetting` (`id`, `Express`, `filed`, `top`, `left`, `width`, `height`) VALUES(27, 'dhl', 'delivery_address', 369, 57, 296, 38);
INSERT INTO `{key}billsprintsetting` (`id`, `Express`, `filed`, `top`, `left`, `width`, `height`) VALUES(28, 'dhl', 'delivery_zip', 426, 78, 123, 21);
INSERT INTO `{key}billsprintsetting` (`id`, `Express`, `filed`, `top`, `left`, `width`, `height`) VALUES(29, 'dhl', 'delivery_telephone', 461, 215, 130, 21);
INSERT INTO `{key}billsprintsetting` (`id`, `Express`, `filed`, `top`, `left`, `width`, `height`) VALUES(30, 'fedex', 'sender_sname', 69, 121, 152, 23);
INSERT INTO `{key}billsprintsetting` (`id`, `Express`, `filed`, `top`, `left`, `width`, `height`) VALUES(31, 'fedex', 'sender_tel', 68, 327, 110, 20);
INSERT INTO `{key}billsprintsetting` (`id`, `Express`, `filed`, `top`, `left`, `width`, `height`) VALUES(32, 'fedex', 'sender_address', 106, 129, 306, 27);
INSERT INTO `{key}billsprintsetting` (`id`, `Express`, `filed`, `top`, `left`, `width`, `height`) VALUES(33, 'fedex', 'sender_country', 180, 123, 75, 20);
INSERT INTO `{key}billsprintsetting` (`id`, `Express`, `filed`, `top`, `left`, `width`, `height`) VALUES(34, 'fedex', 'sender_region', 156, 331, 75, 20);
INSERT INTO `{key}billsprintsetting` (`id`, `Express`, `filed`, `top`, `left`, `width`, `height`) VALUES(35, 'fedex', 'sender_city', 152, 114, 104, 25);
INSERT INTO `{key}billsprintsetting` (`id`, `Express`, `filed`, `top`, `left`, `width`, `height`) VALUES(36, 'fedex', 'sender_zip', 178, 347, 67, 20);
INSERT INTO `{key}billsprintsetting` (`id`, `Express`, `filed`, `top`, `left`, `width`, `height`) VALUES(37, 'fedex', 'delivery_name', 198, 137, 158, 25);
INSERT INTO `{key}billsprintsetting` (`id`, `Express`, `filed`, `top`, `left`, `width`, `height`) VALUES(38, 'fedex', 'delivery_city', 285, 121, 100, 25);
INSERT INTO `{key}billsprintsetting` (`id`, `Express`, `filed`, `top`, `left`, `width`, `height`) VALUES(39, 'fedex', 'delivery_country', 308, 127, 55, 25);
INSERT INTO `{key}billsprintsetting` (`id`, `Express`, `filed`, `top`, `left`, `width`, `height`) VALUES(40, 'fedex', 'delivery_state', 285, 341, 90, 25);
INSERT INTO `{key}billsprintsetting` (`id`, `Express`, `filed`, `top`, `left`, `width`, `height`) VALUES(41, 'fedex', 'delivery_address', 241, 134, 306, 24);
INSERT INTO `{key}billsprintsetting` (`id`, `Express`, `filed`, `top`, `left`, `width`, `height`) VALUES(42, 'fedex', 'delivery_zip', 311, 345, 98, 21);
INSERT INTO `{key}billsprintsetting` (`id`, `Express`, `filed`, `top`, `left`, `width`, `height`) VALUES(43, 'fedex', 'delivery_telephone', 202, 329, 113, 21);
INSERT INTO `{key}billsprintsetting` (`id`, `Express`, `filed`, `top`, `left`, `width`, `height`) VALUES(44, 'UPS', 'sender_sname', 49, 103, 77, 25);
INSERT INTO `{key}billsprintsetting` (`id`, `Express`, `filed`, `top`, `left`, `width`, `height`) VALUES(45, 'UPS', 'sender_tel', 58, 217, 143, 20);
INSERT INTO `{key}billsprintsetting` (`id`, `Express`, `filed`, `top`, `left`, `width`, `height`) VALUES(46, 'UPS', 'sender_address', 104, 90, 279, 42);
INSERT INTO `{key}billsprintsetting` (`id`, `Express`, `filed`, `top`, `left`, `width`, `height`) VALUES(47, 'UPS', 'sender_country', 153, 258, 75, 20);
INSERT INTO `{key}billsprintsetting` (`id`, `Express`, `filed`, `top`, `left`, `width`, `height`) VALUES(48, 'UPS', 'sender_region', 86, 97, 75, 20);
INSERT INTO `{key}billsprintsetting` (`id`, `Express`, `filed`, `top`, `left`, `width`, `height`) VALUES(49, 'UPS', 'sender_city', 84, 173, 104, 22);
INSERT INTO `{key}billsprintsetting` (`id`, `Express`, `filed`, `top`, `left`, `width`, `height`) VALUES(50, 'UPS', 'sender_zip', 155, 130, 61, 20);
INSERT INTO `{key}billsprintsetting` (`id`, `Express`, `filed`, `top`, `left`, `width`, `height`) VALUES(51, 'UPS', 'delivery_name', 210, 79, 123, 25);
INSERT INTO `{key}billsprintsetting` (`id`, `Express`, `filed`, `top`, `left`, `width`, `height`) VALUES(52, 'UPS', 'delivery_city', 245, 161, 100, 25);
INSERT INTO `{key}billsprintsetting` (`id`, `Express`, `filed`, `top`, `left`, `width`, `height`) VALUES(53, 'UPS', 'delivery_country', 310, 258, 55, 22);
INSERT INTO `{key}billsprintsetting` (`id`, `Express`, `filed`, `top`, `left`, `width`, `height`) VALUES(54, 'UPS', 'delivery_state', 246, 106, 57, 25);
INSERT INTO `{key}billsprintsetting` (`id`, `Express`, `filed`, `top`, `left`, `width`, `height`) VALUES(55, 'UPS', 'delivery_address', 270, 75, 296, 42);
INSERT INTO `{key}billsprintsetting` (`id`, `Express`, `filed`, `top`, `left`, `width`, `height`) VALUES(56, 'UPS', 'delivery_zip', 309, 131, 82, 21);
INSERT INTO `{key}billsprintsetting` (`id`, `Express`, `filed`, `top`, `left`, `width`, `height`) VALUES(57, 'UPS', 'delivery_telephone', 212, 216, 149, 21);



CREATE TABLE IF NOT EXISTS `{key}brand` (
  `id` smallint(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `sort` smallint(5) DEFAULT NULL,
  `imgurl` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text,
  `keywords` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `parent` smallint(5) DEFAULT NULL,
  `dateline` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` smallint(5) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='品牌' AUTO_INCREMENT=16 ;





CREATE TABLE IF NOT EXISTS `{key}cart` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `dateline` int(11) NOT NULL DEFAULT '0',
  `pid` int(3) NOT NULL DEFAULT '0',
  `price` varchar(255) NOT NULL DEFAULT '',
  `session_id` varchar(255) NOT NULL DEFAULT '',
  `name` text NOT NULL,
  `count` int(11) NOT NULL DEFAULT '0',
  `uid` varchar(255) NOT NULL DEFAULT '0',
  `model` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=153 ;





CREATE TABLE IF NOT EXISTS `{key}cate` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `imgurl` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pid` int(11) DEFAULT '0',
  `type_id` int(11) NOT NULL DEFAULT '0',
  `sort` int(11) DEFAULT '0',
  `txt2` text COLLATE utf8_unicode_ci,
  `total` text COLLATE utf8_unicode_ci,
  `ishot` varchar(11) COLLATE utf8_unicode_ci DEFAULT '0',
  `pagetitle` text CHARACTER SET utf8,
  `pagekey` text CHARACTER SET utf8,
  `pagedec` text CHARACTER SET utf8,
  PRIMARY KEY (`id`),
  KEY `cid` (`id`),
  KEY `classname` (`name`),
  KEY `upid` (`pid`),
  KEY `orderby` (`sort`),
  KEY `ishot` (`ishot`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='类别' AUTO_INCREMENT=292 ;





CREATE TABLE IF NOT EXISTS `{key}countries` (
  `countries_id` int(11) NOT NULL AUTO_INCREMENT,
  `countries_name` varchar(64) NOT NULL DEFAULT '',
  `countries_iso_code_2` char(2) NOT NULL DEFAULT '',
  `countries_iso_code_3` char(3) NOT NULL DEFAULT '',
  `address_format_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`countries_id`),
  KEY `idx_countries_name_zen` (`countries_name`),
  KEY `idx_address_format_id_zen` (`address_format_id`),
  KEY `idx_iso_2_zen` (`countries_iso_code_2`),
  KEY `idx_iso_3_zen` (`countries_iso_code_3`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=241 ;





CREATE TABLE IF NOT EXISTS `{key}currencies` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `rate` varchar(255) DEFAULT NULL,
  `symbol` varchar(255) DEFAULT NULL,
  `sort` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;


INSERT INTO `{key}currencies` (`id`, `name`, `code`, `rate`, `symbol`, `sort`) VALUES(1, 'US Dollar', '$', '1', 'USD', 0);
INSERT INTO `{key}currencies` (`id`, `name`, `code`, `rate`, `symbol`, `sort`) VALUES(2, '人民币', '￥', '6.8', 'CNY', 0);
INSERT INTO `{key}currencies` (`id`, `name`, `code`, `rate`, `symbol`, `sort`) VALUES(3, 'Euro', '€', '0.79', 'EUR', 0);
INSERT INTO `{key}currencies` (`id`, `name`, `code`, `rate`, `symbol`, `sort`) VALUES(4, 'GB Pound', '£', '0.65', 'GBP', 0);



CREATE TABLE IF NOT EXISTS `{key}down` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text,
  `cateid` int(11) DEFAULT '0',
  `keywords` text,
  `description` text,
  `status` int(4) DEFAULT '1',
  `fileurl` varchar(255) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;





CREATE TABLE IF NOT EXISTS `{key}down_cate` (
  `cateid` int(11) NOT NULL AUTO_INCREMENT,
  `catename` varchar(255) NOT NULL,
  `desc` text,
  `parent_cateid` int(11) DEFAULT '0',
  `keywords` text,
  `description` text,
  `status` int(4) DEFAULT '1',
  `imgurl` varchar(255) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  PRIMARY KEY (`cateid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;





CREATE TABLE IF NOT EXISTS `{key}members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `createdate` int(11) DEFAULT '0',
  `lastlogindate` int(11) DEFAULT '0',
  `lastloginip` varchar(100) DEFAULT NULL,
  `profav` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=132 ;





CREATE TABLE IF NOT EXISTS `{key}node` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `remark` varchar(255) DEFAULT NULL,
  `sort` smallint(6) unsigned DEFAULT NULL,
  `pid` smallint(6) unsigned NOT NULL,
  `level` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `level` (`level`),
  KEY `pid` (`pid`),
  KEY `status` (`status`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;


INSERT INTO `{key}node` (`id`, `name`, `title`, `status`, `remark`, `sort`, `pid`, `level`) VALUES(14, 'Node', '节点管理', 1, '节点管理', 0, 8, 2);
INSERT INTO `{key}node` (`id`, `name`, `title`, `status`, `remark`, `sort`, `pid`, `level`) VALUES(8, 'trade', '应用中心', 1, '', 0, 0, 1);
INSERT INTO `{key}node` (`id`, `name`, `title`, `status`, `remark`, `sort`, `pid`, `level`) VALUES(10, 'role', '角色管理', 1, '角色管理', 0, 8, 2);
INSERT INTO `{key}node` (`id`, `name`, `title`, `status`, `remark`, `sort`, `pid`, `level`) VALUES(15, 'User', '后台用户', 1, '后台用户', 0, 8, 2);
INSERT INTO `{key}node` (`id`, `name`, `title`, `status`, `remark`, `sort`, `pid`, `level`) VALUES(13, 'index', '管理首页', 1, '管理首页', 0, 8, 2);
INSERT INTO `{key}node` (`id`, `name`, `title`, `status`, `remark`, `sort`, `pid`, `level`) VALUES(16, 'Cate', '分类管理', 1, '', 1, 8, 2);
INSERT INTO `{key}node` (`id`, `name`, `title`, `status`, `remark`, `sort`, `pid`, `level`) VALUES(17, 'Brand', '品牌管理', 1, '品牌管理', 2, 8, 2);
INSERT INTO `{key}node` (`id`, `name`, `title`, `status`, `remark`, `sort`, `pid`, `level`) VALUES(18, 'Products', '产品管理', 1, '产品管理', 0, 8, 2);
INSERT INTO `{key}node` (`id`, `name`, `title`, `status`, `remark`, `sort`, `pid`, `level`) VALUES(19, 'Article', '文章管理', 1, '', 0, 8, 1);



CREATE TABLE IF NOT EXISTS `{key}orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sn` varchar(32) DEFAULT NULL,
  `member_id` int(11) NOT NULL DEFAULT '0',
  `member_firstname` varchar(64) NOT NULL DEFAULT '',
  `member_lastname` varchar(64) DEFAULT NULL,
  `member_company` varchar(64) DEFAULT NULL,
  `member_address` varchar(64) NOT NULL DEFAULT '',
  `member_suburb` varchar(32) DEFAULT NULL,
  `member_city` varchar(32) NOT NULL DEFAULT '',
  `member_zip` varchar(10) NOT NULL DEFAULT '',
  `member_state` varchar(32) DEFAULT NULL,
  `member_country` varchar(32) NOT NULL DEFAULT '',
  `member_telephone` varchar(32) NOT NULL DEFAULT '',
  `member_email` varchar(96) NOT NULL DEFAULT '',
  `delivery_firstname` varchar(64) NOT NULL DEFAULT '',
  `delivery_lastname` varchar(64) DEFAULT NULL,
  `delivery_company` varchar(64) DEFAULT NULL,
  `delivery_address` varchar(64) NOT NULL DEFAULT '',
  `delivery_city` varchar(32) NOT NULL DEFAULT '',
  `delivery_zip` varchar(10) NOT NULL DEFAULT '',
  `delivery_state` varchar(32) DEFAULT NULL,
  `delivery_country` varchar(32) DEFAULT '',
  `delivery_telephone` varchar(32) DEFAULT NULL,
  `payment_method` varchar(128) DEFAULT '',
  `payment_module_code` varchar(32) DEFAULT '',
  `shipping_method` varchar(128) DEFAULT '',
  `shipping_module_code` varchar(32) DEFAULT '',
  `coupon_code` varchar(32) DEFAULT '',
  `cc_type` varchar(20) DEFAULT NULL,
  `cc_owner` varchar(64) DEFAULT NULL,
  `cc_number` varchar(32) DEFAULT NULL,
  `cc_expires` varchar(4) DEFAULT NULL,
  `cc_cvv` blob,
  `last_modified` datetime DEFAULT NULL,
  `dateline` int(11) DEFAULT '0',
  `orders_status` int(5) NOT NULL DEFAULT '1',
  `orders_date_finished` datetime DEFAULT '0000-00-00 00:00:00',
  `currency` char(3) DEFAULT NULL,
  `currency_value` decimal(14,6) DEFAULT NULL,
  `orders_total` decimal(14,2) DEFAULT NULL,
  `order_tax` decimal(14,2) DEFAULT NULL,
  `paypal_ipn_id` int(11) DEFAULT '0',
  `BuyNote` text,
  `ip_address` varchar(96) NOT NULL DEFAULT '',
  `shippingmoney` int(11) DEFAULT '0',
  `paymoney` int(11) DEFAULT '0',
  `insurance` int(11) DEFAULT '0',
  `currencies_code` varchar(20) DEFAULT '$',
  `express_method` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_status_orders_cust_zen` (`orders_status`,`id`,`member_id`),
  KEY `idx_date_purchased_zen` (`dateline`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=66 ;





CREATE TABLE IF NOT EXISTS `{key}orders_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orders_id` int(11) NOT NULL DEFAULT '0',
  `products_id` int(11) NOT NULL DEFAULT '0',
  `products_model` varchar(255) DEFAULT NULL,
  `products_name` varchar(64) NOT NULL DEFAULT '',
  `products_price` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `products_pricespe` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `products_tax` decimal(7,4) NOT NULL DEFAULT '0.0000',
  `products_quantity` float NOT NULL DEFAULT '0',
  `onetime_charges` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `products_priced_by_attribute` tinyint(1) NOT NULL DEFAULT '0',
  `product_is_free` tinyint(1) NOT NULL DEFAULT '0',
  `products_discount_type` tinyint(1) NOT NULL DEFAULT '0',
  `products_discount_type_from` tinyint(1) NOT NULL DEFAULT '0',
  `products_total` float NOT NULL DEFAULT '0',
  `products_prid` tinytext,
  PRIMARY KEY (`id`),
  KEY `idx_orders_id_prod_id_zen` (`orders_id`,`products_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=68 ;





CREATE TABLE IF NOT EXISTS `{key}orders_shippingbills` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `order_sn` varchar(50) NOT NULL,
  `sender_sname` varchar(50) DEFAULT NULL,
  `sender_city` varchar(50) DEFAULT NULL,
  `sender_region` varchar(50) DEFAULT NULL,
  `sender_country` varchar(50) DEFAULT NULL,
  `sender_address` varchar(250) DEFAULT NULL,
  `sender_zip` varchar(50) DEFAULT NULL,
  `sender_tel` varchar(50) DEFAULT NULL,
  `delivery_name` varchar(50) DEFAULT NULL,
  `delivery_city` varchar(50) DEFAULT NULL,
  `delivery_state` varchar(50) DEFAULT NULL,
  `delivery_country` varchar(50) DEFAULT NULL,
  `delivery_zip` varchar(50) DEFAULT NULL,
  `delivery_telephone` varchar(50) DEFAULT NULL,
  `delivery_address` varchar(250) DEFAULT NULL,
  `Express` varchar(50) DEFAULT NULL,
  `ExpressSN` varchar(50) DEFAULT NULL,
  `dateline` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=66 ;


INSERT INTO `{key}orders_shippingbills` (`id`, `order_id`, `order_sn`, `sender_sname`, `sender_city`, `sender_region`, `sender_country`, `sender_address`, `sender_zip`, `sender_tel`, `delivery_name`, `delivery_city`, `delivery_state`, `delivery_country`, `delivery_zip`, `delivery_telephone`, `delivery_address`, `Express`, `ExpressSN`, `dateline`) VALUES(62, 56, '20110117191203', 'xu zhengnan', 'putian', 'fujian', 'china', 'chengxianqu nanmen road', '351100', '2561168', 'xu  zhengnan', 'putian', 'fujian ', 'china', '351100', '2561168', 'putian chengxiangqu nanmen road', 'EMS', '111', 1295272747);
INSERT INTO `{key}orders_shippingbills` (`id`, `order_id`, `order_sn`, `sender_sname`, `sender_city`, `sender_region`, `sender_country`, `sender_address`, `sender_zip`, `sender_tel`, `delivery_name`, `delivery_city`, `delivery_state`, `delivery_country`, `delivery_zip`, `delivery_telephone`, `delivery_address`, `Express`, `ExpressSN`, `dateline`) VALUES(65, 173, '20110119093528', '发件人', '城市', '省份', '国家', '地址', '邮编', '电话', 'test  test', 'putian', 'fujian', 'China', '351100', '123456', 'putian', 'Fedex', '1111111', 1295688167);



CREATE TABLE IF NOT EXISTS `{key}orders_status` (
  `orders_status_id` int(11) NOT NULL DEFAULT '0',
  `language_id` int(11) NOT NULL DEFAULT '1',
  `orders_status_name` varchar(32) NOT NULL DEFAULT '',
  PRIMARY KEY (`orders_status_id`,`language_id`),
  KEY `idx_orders_status_name_zen` (`orders_status_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


INSERT INTO `{key}orders_status` (`orders_status_id`, `language_id`, `orders_status_name`) VALUES(1, 1, 'Pending');
INSERT INTO `{key}orders_status` (`orders_status_id`, `language_id`, `orders_status_name`) VALUES(2, 1, 'Processing');
INSERT INTO `{key}orders_status` (`orders_status_id`, `language_id`, `orders_status_name`) VALUES(3, 1, 'Delivered');
INSERT INTO `{key}orders_status` (`orders_status_id`, `language_id`, `orders_status_name`) VALUES(4, 1, 'Update');



CREATE TABLE IF NOT EXISTS `{key}orders_status_history` (
  `orders_status_history_id` int(11) NOT NULL AUTO_INCREMENT,
  `orders_id` int(11) NOT NULL DEFAULT '0',
  `orders_status_id` int(5) NOT NULL DEFAULT '0',
  `date_added` datetime NOT NULL DEFAULT '0001-01-01 00:00:00',
  `customer_notified` int(1) DEFAULT '0',
  `comments` text,
  PRIMARY KEY (`orders_status_history_id`),
  KEY `idx_orders_id_status_id_zen` (`orders_id`,`orders_status_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;





CREATE TABLE IF NOT EXISTS `{key}orders_total` (
  `orders_total_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `orders_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `text` varchar(255) NOT NULL DEFAULT '',
  `value` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `class` varchar(32) NOT NULL DEFAULT '',
  `sort_order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`orders_total_id`),
  KEY `idx_ot_orders_id_zen` (`orders_id`),
  KEY `idx_ot_class_zen` (`class`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;





CREATE TABLE IF NOT EXISTS `{key}payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `remark` text,
  `var` varchar(255) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;


INSERT INTO `{key}payment` (`id`, `name`, `title`, `remark`, `var`, `sort`) VALUES(1, 'Alipay', '支付宝', '支付宝,阿里巴巴旗下提供的网上支付服务。', 'alipay_account,alipay_remark', 0);
INSERT INTO `{key}payment` (`id`, `name`, `title`, `remark`, `var`, `sort`) VALUES(2, 'Paypal', 'Paypal', 'Paypal全球最大在线支付平台', 'Paypal_account,Paypal_remark', 0);
INSERT INTO `{key}payment` (`id`, `name`, `title`, `remark`, `var`, `sort`) VALUES(3, 'Gspay', '环迅支付', '环迅支付主要为国际贸易商的提供 在线国际信用卡支付收款和离岸帐户开设和第三方托收服务提供解决方案.', 'gspay_Site_Id', 1);
INSERT INTO `{key}payment` (`id`, `name`, `title`, `remark`, `var`, `sort`) VALUES(4, 'Payeasy3D', '首信易3D通道', '首信易支付自1999 年3月开始运行，是中国首家实现跨银行跨地域提供多种银行卡在线交易的网上支付服务平台，现支持全国范围23家银行及全球范围4种国际信用卡在线支付，拥有千余家大中型企事业单位、政府机关、社会团体组成的庞大客户群。', 'Payeasy3D_id,Payeasy3D_key', 1);
INSERT INTO `{key}payment` (`id`, `name`, `title`, `remark`, `var`, `sort`) VALUES(5, 'PayeasyN3D', '首信易非3D通道', '首信易支付自1999 年3月开始运行，是中国首家实现跨银行跨地域提供多种银行卡在线交易的网上支付服务平台，现支持全国范围23家银行及全球范围4种国际信用卡在线支付，拥有千余家大中型企事业单位、政府机关、社会团体组成的庞大客户群。', 'PayeasyN3D_id,PayeasyN3D_key', 1);
INSERT INTO `{key}payment` (`id`, `name`, `title`, `remark`, `var`, `sort`) VALUES(6, 'BANKOFCHINA', '中国银行', '中国银行股份有限公司，国有控股金融机构，业务范围涵盖商业银行、投资银行和保险领域，旗下有中银香港、中银国际、中银保险控股机构。', '', 0);
INSERT INTO `{key}payment` (`id`, `name`, `title`, `remark`, `var`, `sort`) VALUES(7, 'WesternUnion', '西联汇款', '西联国际汇款公司（Western Union）是世界上领先的特快汇款公司，迄今已有150年的历史，它拥有全球最大最先进的电子汇兑金融网络，代理网点遍布全球近200个国家和地区。西联公司是美国财富五百强之一的第一数据公司（FDC）的子公司。中国邮政、光大银行、农业银行这三家银行是西联汇款业务中国代理行.', '', 0);
INSERT INTO `{key}payment` (`id`, `name`, `title`, `remark`, `var`, `sort`) VALUES(8, 'LetterofCredit', '信用证', '信用证(Letter of Credit，L／C) ，是指开证银行应申请人的要求并按其指示向第三方开立的载有一定金额的，在一定的期限内凭符合规定的单据付款的书面保证文件。信用证是国际贸易中最主要、最常用的支付方式。', '', 0);
INSERT INTO `{key}payment` (`id`, `name`, `title`, `remark`, `var`, `sort`) VALUES(9, 'MoneyGram', '速汇金', '速汇金汇款是Money Gram公司推出的一种快捷，简单。可靠及方便的国际汇款方式，目前该公司在全球150个国家和地区拥有总数超过50,000个的代理网点。', '', 0);
INSERT INTO `{key}payment` (`id`, `name`, `title`, `remark`, `var`, `sort`) VALUES(10, 'CtoPay', '收汇宝', '收汇宝-收汇宝收汇宝是电信支付的重点产品，是由广东省电信实业集团深圳市有限公司全力打造的外汇收款工具', '', 0);
INSERT INTO `{key}payment` (`id`, `name`, `title`, `remark`, `var`, `sort`) VALUES(11, 'ECPSS', 'E汇通', '上海汇阜信息技术有限公司, Shanghai  Ecpss Co. Limited(E-commerce Payment Service Solution) (简称：ECPSS) , 是专注于国际卡收单服务的第三方支付平台， 全力为国内外接受国际卡支付的商家提供世界一流的收单服务。', 'ECPSS_Md5Key,ECPSS_Mer', 0);
INSERT INTO `{key}payment` (`id`, `name`, `title`, `remark`, `var`, `sort`) VALUES(12, 'IPS', 'IPS', '', 'IPS_mer,IPS_key,IPS_rate', 0);



CREATE TABLE IF NOT EXISTS `{key}products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cateid` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `serial` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` varchar(255) COLLATE utf8_unicode_ci DEFAULT '0',
  `pricespe` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `size` text COLLATE utf8_unicode_ci,
  `bigimage` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `smallimage` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remark` text CHARACTER SET utf8,
  `pagedec` text COLLATE utf8_unicode_ci,
  `isnew` varchar(20) COLLATE utf8_unicode_ci DEFAULT '0',
  `ishot` varchar(20) COLLATE utf8_unicode_ci DEFAULT '0',
  `isrec` varchar(20) COLLATE utf8_unicode_ci DEFAULT '0',
  `isuser` varchar(20) COLLATE utf8_unicode_ci DEFAULT '0',
  `isprice` varchar(20) COLLATE utf8_unicode_ci DEFAULT '0',
  `dateline` varchar(11) COLLATE utf8_unicode_ci DEFAULT '0',
  `sort` varchar(11) COLLATE utf8_unicode_ci DEFAULT '0',
  `brandid` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pagetitle` text COLLATE utf8_unicode_ci,
  `pagekey` text COLLATE utf8_unicode_ci,
  `product_image1` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `product_image2` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `product_image3` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `product_image4` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `viewcount` int(10) DEFAULT '0',
  `brand` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pid` (`id`),
  KEY `classid` (`cateid`),
  KEY `product_name` (`name`),
  KEY `isnew` (`isnew`),
  KEY `ishot` (`ishot`),
  KEY `isrec` (`isrec`),
  KEY `isuser` (`isuser`),
  KEY `isprice` (`isprice`),
  KEY `dateline` (`dateline`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5573 ;





CREATE TABLE IF NOT EXISTS `{key}products_ask` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `tel` varchar(100) DEFAULT NULL,
  `qq` varchar(100) DEFAULT NULL,
  `msn` varchar(100) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` mediumtext,
  `status` varchar(20) DEFAULT '0',
  `replay` mediumtext,
  `ip` varchar(20) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  `dateline` int(255) DEFAULT NULL,
  `products_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;





CREATE TABLE IF NOT EXISTS `{key}products_attr` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `products_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `attr_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `attr_value` text NOT NULL,
  `attr_price` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `goods_id` (`products_id`),
  KEY `attr_id` (`attr_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41736 ;





CREATE TABLE IF NOT EXISTS `{key}products_gallery` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `pid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `img_url` varchar(255) NOT NULL DEFAULT '',
  `img_desc` varchar(255) NOT NULL DEFAULT '',
  `thumb_url` varchar(255) NOT NULL DEFAULT '',
  `img_original` varchar(255) DEFAULT '',
  `sort` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `goods_id` (`pid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4829 ;





CREATE TABLE IF NOT EXISTS `{key}products_related` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `products_id` int(11) NOT NULL,
  `related_products_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=80 ;





CREATE TABLE IF NOT EXISTS `{key}role` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `pid` smallint(6) DEFAULT NULL,
  `status` tinyint(1) unsigned DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `sort` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`),
  KEY `status` (`status`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;


INSERT INTO `{key}role` (`id`, `name`, `pid`, `status`, `remark`, `sort`) VALUES(1, '系统管理员', 0, 1, NULL, 0);
INSERT INTO `{key}role` (`id`, `name`, `pid`, `status`, `remark`, `sort`) VALUES(2, '产品操作员', 1, 1, NULL, 0);
INSERT INTO `{key}role` (`id`, `name`, `pid`, `status`, `remark`, `sort`) VALUES(7, '市场推广员', 1, 1, NULL, 0);
INSERT INTO `{key}role` (`id`, `name`, `pid`, `status`, `remark`, `sort`) VALUES(8, '系统维护员', 1, 1, NULL, 0);



CREATE TABLE IF NOT EXISTS `{key}role_user` (
  `role_id` mediumint(9) unsigned DEFAULT NULL,
  `user_id` char(32) DEFAULT NULL,
  KEY `group_id` (`role_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


INSERT INTO `{key}role_user` (`role_id`, `user_id`) VALUES(7, '35');
INSERT INTO `{key}role_user` (`role_id`, `user_id`) VALUES(8, '35');
INSERT INTO `{key}role_user` (`role_id`, `user_id`) VALUES(1, '35');
INSERT INTO `{key}role_user` (`role_id`, `user_id`) VALUES(2, '37');
INSERT INTO `{key}role_user` (`role_id`, `user_id`) VALUES(2, '35');



CREATE TABLE IF NOT EXISTS `{key}setting` (
  `vid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `valuename` varchar(50) DEFAULT NULL,
  `valuetxt` longtext,
  PRIMARY KEY (`vid`),
  KEY `valuename` (`valuename`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=168 ;


INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(1, 'sitename', '外贸易');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(2, 'siteurl', '127.0.0.1');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(3, 'keywords', '11111111111111');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(37, 'rmbtousd', '6.8');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(38, 'isPaypalvisa', '0');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(39, 'Paypalvisa', '402660_1224487424_biz_api1.qq.com');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(40, 'Paypalvisapwd', '1224487470');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(41, 'Paypalvisamd5', 'AE5yv9AJLySsZBdXGOEWgKijTICUASsRNCO241tw1YWXgZGeC-KvO.Z9');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(4, 'description', '222222222');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(9, 'ImgThumbW', '180');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(10, 'ImgThumbH', '180');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(55, 'ismoneygram', '1');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(12, 'pagesize', '25');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(56, 'moneygram', '<p>Account Name: Account Number: Receiver Telephone: Bank Name: Bank Address: Swift Code:444444444444</p>');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(32, 'isgspay', '1');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(33, 'gspay', '1234564');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(36, 'ipspaykey', 'Czat10g3rA098r2iyGVIH2gYjRcLrc1HwWqVx4zVSozf7eBmtk6zhXUktbk9yumoiInCb7KUqaP2ca1fpP1g6c9ycgBvuP68blXOQZlMzBigh1hs9fu8SgIgjO9UVzA1');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(35, 'isipspay', '1');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(34, 'ips', '012159');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(17, 'email', 'soupw@hotmail.com');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(18, 'hotmail', '811046@qq.com');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(19, 'yahoo', '811046@qq.com');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(20, 'passippassword', '123456');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(21, 'lockip', 'a:95:{i:0;s:6:"北京";i:1;s:6:"浙江";i:2;s:6:"天津";i:3;s:6:"安徽";i:4;s:6:"上海";i:5;s:6:"福建";i:6;s:6:"莆田";i:7;s:6:"重庆";i:8;s:6:"江西";i:9;s:6:"山东";i:10;s:6:"河南";i:11;s:9:"内蒙古";i:12;s:6:"湖北";i:13;s:6:"新疆";i:14;s:6:"湖南";i:15;s:6:"宁夏";i:16;s:6:"广东";i:17;s:6:"西藏";i:18;s:6:"海南";i:19;s:6:"广西";i:20;s:6:"四川";i:21;s:6:"河北";i:22;s:6:"贵州";i:23;s:6:"山西";i:24;s:6:"云南";i:25;s:6:"辽宁";i:26;s:6:"陕西";i:27;s:7:" 吉林";i:28;s:6:"甘肃";i:29;s:9:"黑龙江";i:30;s:6:"青海";i:31;s:6:"江苏";i:32;s:6:"北京";i:33;s:6:"浙江";i:34;s:6:"天津";i:35;s:6:"安徽";i:36;s:6:"上海";i:37;s:6:"重庆";i:38;s:6:"江西";i:39;s:6:"山东";i:40;s:6:"河南";i:41;s:9:"内蒙古";i:42;s:6:"湖北";i:43;s:6:"新疆";i:44;s:6:"湖南";i:45;s:6:"宁夏";i:46;s:6:"广东";i:47;s:6:"西藏";i:48;s:6:"海南";i:49;s:6:"广西";i:50;s:6:"四川";i:51;s:6:"河北";i:52;s:6:"贵州";i:53;s:6:"山西";i:54;s:6:"云南";i:55;s:6:"辽宁";i:56;s:6:"陕西";i:57;s:6:"吉林";i:58;s:6:"甘肃";i:59;s:9:"黑龙江";i:60;s:6:"青海";i:61;s:6:"江苏";i:62;s:6:"北京";i:63;s:6:"浙江";i:64;s:6:"天津";i:65;s:6:"安徽";i:66;s:6:"上海";i:67;s:6:"重庆";i:68;s:6:"江西";i:69;s:6:"山东";i:70;s:6:"河南";i:71;s:9:"内蒙古";i:72;s:6:"湖北";i:73;s:6:"新疆";i:74;s:6:"湖南";i:75;s:6:"宁夏";i:76;s:6:"广东";i:77;s:6:"西藏";i:78;s:6:"海南";i:79;s:6:"广西";i:80;s:6:"四川";i:81;s:6:"河北";i:82;s:6:"贵州";i:83;s:6:"山西";i:84;s:6:"云南";i:85;s:6:"辽宁";i:86;s:6:"陕西";i:87;s:6:"吉林";i:88;s:6:"甘肃";i:89;s:9:"黑龙江";i:90;s:6:"青海";i:91;s:6:"江苏";i:92;s:6:"河南";i:93;s:6:"贵州";i:94;s:6:"陕西";}');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(22, 'Paypal', '409985_1258027859_biz@qq.com');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(23, 'isPaypal', '1');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(52, 'bill99', 'error');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(53, 'isWesternUnion', '1');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(54, 'WesternUnion', '<p>First Name : Last Name : Address : Zip Code : City : Country : Phone : 55555555555</p>');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(25, 'tel', '0594-2265012');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(26, 'npskey', '1234567812345678');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(27, 'isnps', '0');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(28, 'nps', '1234561');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(29, 'ctopay', '1234562');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(30, 'isctopay', '1');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(31, 'ctopaykey', '1234563');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(42, 'isBigimg', '1');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(43, 'pagepronum', '20');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(57, 'ecpssMd5Key', '323');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(58, 'ecpssMer', '1284');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(59, 'isecpss', '0');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(60, 'hottitle', '<p><strong>The Best</strong> Online Sports Jerseys Outlet Supplying Authentic High Quality NFL jerseys, MLB jerseys, NBA jerseys, NBA Swingman, NHL jerseys and NCAA jerseys at the Cheapest Prices Available Online.Wholesale Pricing Are Also Available on Orders of Thirty or More.</p>');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(61, 'DisMethod', 'PCT');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(62, 'DisBase', 'price');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(63, 'DiscountTest', '111');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(64, 'content', '<p>555555555555555555555555555</p>');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(65, 'paypalinfo', '<p>paypal</p>');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(66, 'moneygraminfo', '');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(67, 'WesternUnioninfo', '<p>wu</p>');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(69, 'alipay_account', '811046@qq.com');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(68, 'isalipay', '1');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(70, 'alipay_id', '2088002148043415');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(71, 'alipay_code', 'cvqvqt8e2anyrm8hglin55za6t7l8jmr');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(72, 'alipay_kefu', '<a target=_blank href=\\"http://amos.im.alisoft.com/msg.aw?v=2&uid=ptpc120&site=cntaobao&s=1&charset=utf-8\\" ><img border=0 src=\\"http://amos.im.alisoft.com/online.aw?v=2&uid=ptpc120&site=cntaobao&s=1&charset=utf-8\\" alt=\\"点击这里给我发消息\\" /></a>');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(76, 'Text_set1', '<p>111111111111111111111</p>');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(77, 'Images_img1', '0001.jpg');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(78, 'Down_file1', '0001.jpg');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(79, 'status', '0');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(80, 'alipay_remark', '支付宝,alipay.com');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(81, 'Alipay_status', '0');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(82, 'footcode', '');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(83, 'shipping', '<p>fdsafdafdfdsfdsaf</p>');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(84, 'shippingremark', '<p style=\\"margin: 0cm 0cm 0pt\\" class=\\"MsoNormal\\"><strong style=\\"mso-bidi-font-weight: normal\\"><span style=\\"font-family: Verdana; font-size: 12pt\\" lang=\\"EN-US\\"><font size=\\"2\\">D</font></span></strong><span style=\\"font-family: Verdana; font-size: 12pt\\" lang=\\"EN-US\\"><font size=\\"2\\">efault : <st1:place w:st=\\"on\\">EMS</st1:place> . If you have special requestment . Plz contact us . Thanks !<br />\r\nDelivery time : 3-7 days according where you are located and the kind of the express company .<o:p></o:p></font></span></p>\r\n<p style=\\"margin: 0cm 0cm 0pt\\" class=\\"MsoNormal\\"><span style=\\"font-family: Verdana; font-size: 12pt\\" lang=\\"EN-US\\"><font size=\\"2\\">jerseysmaker.com support these expresses .</font> </span></p>\r\n<p style=\\"margin: 0cm 0cm 0pt\\" class=\\"MsoNormal\\"><span style=\\"font-family: Verdana; font-size: 12pt\\" lang=\\"EN-US\\"><img border=\\"0\\" src=\\"http://www.b2b1999.com/upfile/10/201061623413631331.gif\\" alt=\\"\\" /></span><span style=\\"font-family: Verdana; font-size: 12pt; font-weight: normal; mso-bidi-font-weight: bold\\" lang=\\"EN-US\\"><img border=\\"0\\" src=\\"http://www.b2b1999.com/upfile/10/201061623412199053.gif\\" alt=\\"\\" /><img border=\\"0\\" src=\\"http://www.b2b1999.com/upfile/10/201061623414181508.gif\\" alt=\\"\\" /><img border=\\"0\\" src=\\"http://www.b2b1999.com/upfile/10/20106162342138856.gif\\" alt=\\"\\" /><img border=\\"0\\" src=\\"http://www.b2b1999.com/upfile/10/201061623421833618.gif\\" alt=\\"\\" /><img border=\\"0\\" src=\\"http://www.b2b1999.com/upfile/10/20106162342681016.gif\\" alt=\\"\\" /></span><font size=\\"2\\"><span style=\\"font-family: Verdana; font-size: 12pt\\" lang=\\"EN-US\\">P</span><span style=\\"font-family: Verdana; font-size: 12pt; font-weight: normal; mso-bidi-font-weight: bold\\" lang=\\"EN-US\\">ayment methods available on jerseysmaker.com :<o:p></o:p></span></font></p>\r\n<p style=\\"text-align: left; margin: 0cm 0cm 0pt; mso-pagination: widow-orphan\\" class=\\"MsoNormal\\" align=\\"left\\"><span style=\\"font-family: Verdana; font-size: 12pt; mso-bidi-font-family: ����; mso-font-kerning: 0pt\\" lang=\\"EN-US\\"><font size=\\"2\\">1) Credit Card<o:p></o:p></font></span></p>\r\n<p style=\\"text-align: left; margin: 0cm 0cm 0pt; mso-pagination: widow-orphan\\" class=\\"MsoNormal\\" align=\\"left\\"><span style=\\"font-family: Verdana; font-size: 12pt; mso-bidi-font-family: ����; mso-font-kerning: 0pt\\" lang=\\"EN-US\\"><font size=\\"2\\">2) Western <st1:place w:st=\\"on\\">Union</st1:place><o:p></o:p></font></span></p>\r\n<p style=\\"text-align: left; margin: 0cm 0cm 0pt; mso-pagination: widow-orphan\\" class=\\"MsoNormal\\" align=\\"left\\"><span style=\\"font-family: Verdana; font-size: 12pt; mso-bidi-font-family: ����; mso-font-kerning: 0pt\\" lang=\\"EN-US\\"><font size=\\"2\\">3) Money Gram<o:p></o:p></font></span></p>\r\n<p style=\\"text-align: left; margin: 0cm 0cm 0pt; mso-pagination: widow-orphan\\" class=\\"MsoNormal\\" align=\\"left\\"><span style=\\"font-family: Verdana; font-size: 12pt; mso-bidi-font-family: ����; mso-font-kerning: 0pt\\" lang=\\"EN-US\\"><font size=\\"2\\">4) Bank Transfer<o:p></o:p></font></span></p>\r\n<p style=\\"text-align: left; margin: 0cm 0cm 0pt; mso-pagination: widow-orphan\\" class=\\"MsoNormal\\" align=\\"left\\"><span style=\\"font-family: Verdana; font-size: 12pt; mso-bidi-font-family: ����; mso-font-kerning: 0pt\\" lang=\\"EN-US\\"><font size=\\"2\\">5) Others</font></span></p>');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(85, 'shippingremarks', '<p>&nbsp;</p>');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(157, 'fee_readme', '');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(158, 'close_site_content', '');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(86, 'paypal_status', '1');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(87, 'paypal_account', '402660_1224487424_biz@qq.com');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(88, 'paypal_remark', 'PayPal has optimized their checkout experience by launching an exciting new improvement to their payment flow. ');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(89, 'sendemailtype', 'phpmail');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(90, 'smtphost', 'smtp.qq.com');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(91, 'smtpusername', '811046@qq.com');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(92, 'smtppassword', '6363@6636');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(93, 'smtpport', '25');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(94, 'smtpisssl', '1');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(95, 'mailfrom', '811046@qq.com');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(96, 'mailcopyTo', '811046@qq.com');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(97, 'password', '0594trade');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(98, '365webcall_email', 'xxx@hotmail.com');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(99, '365webcall_password', '0594trade');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(100, '365webcall_name', '365');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(101, '365webcall_url', 'test.com');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(102, '365webcall_accountid', '0594trade');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(103, '365webcall_status', '0');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(104, 'Gspay_status', '0');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(105, 'gspay_Site_Id', '73176');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(106, 'fileToUpload', '');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(107, 'sitelogo', './Public/Uploads/Setting/4d180f44337dc.gif');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(108, 'ipblock', '0');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(109, 'ipblock_city', 'a:33:{i:0;s:6:"北京";i:1;s:6:"浙江";i:2;s:6:"天津";i:3;s:6:"安徽";i:4;s:6:"上海";i:5;s:6:"福建";i:6;s:6:"莆田";i:7;s:6:"重庆";i:8;s:6:"江西";i:9;s:6:"山东";i:10;s:6:"河南";i:11;s:9:"内蒙古";i:12;s:6:"湖北";i:13;s:6:"新疆";i:14;s:6:"湖南";i:15;s:6:"宁夏";i:16;s:6:"广东";i:17;s:6:"西藏";i:18;s:6:"海南";i:19;s:6:"广西";i:20;s:6:"四川";i:21;s:6:"河北";i:22;s:6:"贵州";i:23;s:6:"山西";i:24;s:6:"云南";i:25;s:6:"辽宁";i:26;s:6:"陕西";i:27;s:6:"吉林";i:28;s:6:"甘肃";i:29;s:9:"黑龙江";i:30;s:6:"青海";i:31;s:6:"江苏";i:32;s:0:"";}');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(110, 'ipblock_pwd', '123456');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(118, 'Alipay_desc', '<p>11111111111111111111</p>');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(111, 'Payeasy3D_status', '1');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(112, 'Payeasy3D_id', '4916');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(113, 'Payeasy3D_key', 'hjfz753159md55md');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(114, 'PayeasyN3D_status', '1');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(115, 'PayeasyN3D_id', '4917');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(116, 'PayeasyN3D_key', 'hjfz258369md55md');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(117, 'ipblock_lang', '1');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(119, 'listRows', '10');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(120, 'fileToUpload2', '');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(121, 'ImgWaterPath', './Public/Uploads/Setting/4d1d703e1d9d8.gif');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(122, 'ImgWater', '1');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(123, 'ImgWaterPos', '9');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(124, 'ImgWaterType', 'txt');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(125, 'ImgWaterTxt', 'sop');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(126, 'theme', 'default');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(127, 'ImageWaterAlpha', '100');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(128, 'BANKOFCHINA_status', '1');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(129, 'BANKOFCHINA_desc', '<p>ake Payable To:<br />\r\n<br />\r\nFirst Name : sop<br />\r\nLast Name : sop<br />\r\nAddress : sop<br />\r\nZip Code : sop<br />\r\nCity : sop<br />\r\nCountry : sop<br />\r\nPhone : sop<br />\r\nAfter the payment, plese tell us your Firstname, Lastname, amount, currency and country.</p>');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(130, 'WesternUnion_status', '1');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(131, 'WesternUnion_desc', '<p>ake Payable To:<br />\r\n<br />\r\nFirst Name : sop<br />\r\nLast Name : sop<br />\r\nAddress : sop<br />\r\nZip Code : sop<br />\r\nCity : sop<br />\r\nCountry : sop<br />\r\nPhone : sop<br />\r\nAfter the payment, plese tell us your Firstname, Lastname, amount, currency and country.</p>');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(132, 'LetterofCredit_status', '0');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(133, 'LetterofCredit_desc', '<p>ake Payable To:<br />\r\n<br />\r\nFirst Name : sop<br />\r\nLast Name : sop<br />\r\nAddress : sop<br />\r\nZip Code : sop<br />\r\nCity : sop<br />\r\nCountry : sop<br />\r\nPhone : sop<br />\r\nAfter the payment, plese tell us your Firstname, Lastname, amount, currency and country.</p>');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(134, 'MoneyGram_status', '1');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(135, 'MoneyGram_desc', '<p>ake Payable To:<br />\r\n<br />\r\nFirst Name : sop<br />\r\nLast Name : sop<br />\r\nAddress : sop<br />\r\nZip Code : sop<br />\r\nCity : sop<br />\r\nCountry : sop<br />\r\nPhone : sop<br />\r\nAfter the payment, plese tell us your Firstname, Lastname, amount, currency and country.</p>');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(136, 'quickbuy', '0');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(137, 'welcome_email', '1');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(138, 'welcome_email_content', '<p>&nbsp;</p>');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(139, 'is_only_proimg_water', '1');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(140, 'shippingmoney', '20');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(141, 'no_shipping', 'qty');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(142, 'min_freeshippingmoney', '');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(143, 'min_freeshippingqty', '10');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(144, 'min_freepaymoney', '1000000');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(145, 'paymoney', '0.04');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(146, 'insurance', '4');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(147, 'min_insurance', '1000000');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(148, 'newpro_num', '9');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(149, 'recpro_num', '9');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(150, 'hotpro_num', '9');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(151, 'spepro_num', '9');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(152, 'pro_num', '9');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(153, 'cate_num', '9');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(154, 'search_num', '9');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(155, 'realted_num', '6');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(156, 'broswer_history_num', '6');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(159, 'ECPSS_status', '0');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(160, 'ECPSS_Md5Key', '1284');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(161, 'ECPSS_Mer', '222378');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(162, 'ECPSS_desc', '');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(163, 'IPS_status', '0');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(164, 'IPS_mer', '014286');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(165, 'IPS_key', '81521110019936436323654784642857793312565708801778521522784646716224301386795597387432516063891998168747614573619636927460823859');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(166, 'IPS_rate', '0.65');
INSERT INTO `{key}setting` (`vid`, `valuename`, `valuetxt`) VALUES(167, 'IPS_desc', '');



CREATE TABLE IF NOT EXISTS `{key}shippingaddress` (
  `id` int(11) NOT NULL DEFAULT '0',
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `zip` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `telphone` varchar(50) DEFAULT NULL,
  `fax` varchar(50) DEFAULT NULL,
  `isNewseletter` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;





CREATE TABLE IF NOT EXISTS `{key}type_attr` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `type_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `name` varchar(60) NOT NULL DEFAULT '',
  `input_type` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `values` text NOT NULL,
  `attr_index` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `status` int(1) DEFAULT '1',
  `sort` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `cat_id` (`type_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=218 ;





CREATE TABLE IF NOT EXISTS `{key}type_cate` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL DEFAULT '',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `attr_group` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;





CREATE TABLE IF NOT EXISTS `{key}user` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `account` varchar(64) NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `password` char(32) NOT NULL,
  `bind_account` varchar(50) NOT NULL,
  `last_login_time` int(11) unsigned DEFAULT '0',
  `last_login_ip` varchar(40) DEFAULT NULL,
  `login_count` mediumint(8) unsigned DEFAULT '0',
  `verify` varchar(32) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `remark` varchar(255) NOT NULL,
  `create_time` int(11) unsigned NOT NULL,
  `update_time` int(11) unsigned NOT NULL,
  `status` tinyint(1) DEFAULT '0',
  `type_id` tinyint(2) unsigned DEFAULT '0',
  `isadministrator` tinyint(1) DEFAULT '0',
  `info` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `account` (`account`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=39 ;


INSERT INTO `{key}user` (`id`, `account`, `nickname`, `password`, `bind_account`, `last_login_time`, `last_login_ip`, `login_count`, `verify`, `email`, `remark`, `create_time`, `update_time`, `status`, `type_id`, `isadministrator`, `info`) VALUES(35, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', '', 0, NULL, 0, NULL, '', '', 0, 0, 1, 0, 1, '');
INSERT INTO `{key}user` (`id`, `account`, `nickname`, `password`, `bind_account`, `last_login_time`, `last_login_ip`, `login_count`, `verify`, `email`, `remark`, `create_time`, `update_time`, `status`, `type_id`, `isadministrator`, `info`) VALUES(37, 'nanze', '产品管理员', '202cb962ac59075b964b07152d234b70', '', 0, NULL, 0, NULL, '', '', 0, 0, 1, 0, 0, '');

DROP TABLE IF EXISTS `{key}members_group`;
CREATE TABLE `{key}members_group` (
    `id` int(11) NOT NULL auto_increment,
  `minpoints` int(11) default NULL,
  `maxpoints` int(11) default NULL,
  `name` varchar(50) default NULL,
  `discount` float default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;


ALTER TABLE `{key}products`
ADD COLUMN `points`  int(11) NULL DEFAULT 0 AFTER `brand`;

ALTER TABLE `{key}members`
ADD COLUMN `points`  int(11) NULL  DEFAULT 0 AFTER `profav`;
update `{key}members` set points=0;
