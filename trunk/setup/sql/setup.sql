SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `{key}access`
-- ----------------------------
DROP TABLE IF EXISTS `{key}access`;
CREATE TABLE `{key}access` (
  `role_id` smallint(6) unsigned NOT NULL,
  `node_id` smallint(6) unsigned NOT NULL,
  `level` tinyint(1) NOT NULL,
  `module` varchar(50) DEFAULT NULL,
  KEY `groupId` (`role_id`),
  KEY `nodeId` (`node_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `{key}ad`
-- ----------------------------
DROP TABLE IF EXISTS `{key}ad`;
CREATE TABLE `{key}ad` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `img_url` varchar(50) DEFAULT NULL,
  `content` text NOT NULL,
  `code` varchar(50) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `remark` varchar(50) DEFAULT NULL,
  `sort` int(3) NOT NULL DEFAULT '0',
  `link` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8 COMMENT='广告';

-- ----------------------------
-- Table structure for `{key}article`
-- ----------------------------
DROP TABLE IF EXISTS `{key}article`;
CREATE TABLE `{key}article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text,
  `pid` int(11) DEFAULT '0',
  `keywords` text,
  `description` text,
  `status` int(4) DEFAULT '1',
  `img_url` varchar(255) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  `dateline` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `{key}article_cate`
-- ----------------------------
DROP TABLE IF EXISTS `{key}article_cate`;
CREATE TABLE `{key}article_cate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `remark` text,
  `pid` int(11) DEFAULT '0',
  `keywords` text,
  `description` text,
  `status` int(4) DEFAULT '1',
  `img_url` varchar(255) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  `dateline` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `{key}billsprintsetting`
-- ----------------------------
DROP TABLE IF EXISTS `{key}billsprintsetting`;
CREATE TABLE `{key}billsprintsetting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Express` varchar(50) DEFAULT NULL,
  `filed` varchar(50) DEFAULT NULL,
  `top` int(11) DEFAULT NULL,
  `left` int(11) DEFAULT NULL,
  `width` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `{key}brand`
-- ----------------------------
DROP TABLE IF EXISTS `{key}brand`;
CREATE TABLE `{key}brand` (
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
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COMMENT='品牌';

-- ----------------------------
-- Table structure for `{key}cart`
-- ----------------------------
DROP TABLE IF EXISTS `{key}cart`;
CREATE TABLE `{key}cart` (
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
) ENGINE=MyISAM AUTO_INCREMENT=297 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `{key}cate`
-- ----------------------------
DROP TABLE IF EXISTS `{key}cate`;
CREATE TABLE `{key}cate` (
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
  `brandid` int(11) DEFAULT NULL,
  `remark` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `cid` (`id`),
  KEY `classname` (`name`),
  KEY `upid` (`pid`),
  KEY `orderby` (`sort`),
  KEY `ishot` (`ishot`)
) ENGINE=MyISAM AUTO_INCREMENT=314 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='类别';

-- ----------------------------
-- Table structure for `{key}countries`
-- ----------------------------
DROP TABLE IF EXISTS `{key}countries`;
CREATE TABLE `{key}countries` (
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
) ENGINE=MyISAM AUTO_INCREMENT=241 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `{key}currencies`
-- ----------------------------
DROP TABLE IF EXISTS `{key}currencies`;
CREATE TABLE `{key}currencies` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `rate` varchar(255) DEFAULT NULL,
  `symbol` varchar(255) DEFAULT NULL,
  `sort` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `{key}discount`
-- ----------------------------
DROP TABLE IF EXISTS `{key}discount`;
CREATE TABLE `{key}discount` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `minmoney` int(11) DEFAULT NULL,
  `maxmoney` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `discount` float DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `{key}down`
-- ----------------------------
DROP TABLE IF EXISTS `{key}down`;
CREATE TABLE `{key}down` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text,
  `pid` int(11) DEFAULT '0',
  `keywords` text,
  `description` text,
  `status` int(4) DEFAULT '1',
  `file_url` varchar(255) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  `dateline` int(11) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `{key}down_cate`
-- ----------------------------
DROP TABLE IF EXISTS `{key}down_cate`;
CREATE TABLE `{key}down_cate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `remark` text,
  `pid` int(11) DEFAULT '0',
  `keywords` text,
  `description` text,
  `status` int(4) DEFAULT '1',
  `img_url` varchar(255) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  `dateline` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `{key}fee`
-- ----------------------------
DROP TABLE IF EXISTS `{key}fee`;
CREATE TABLE `{key}fee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_id` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `fee` varchar(255) DEFAULT NULL,
  `minimum_money` decimal(11,2) DEFAULT NULL,
  `min_freepaymoney` decimal(11,2) DEFAULT NULL,
  `paymoney` decimal(11,2) DEFAULT NULL,
  `insurance` decimal(11,2) DEFAULT NULL,
  `min_insurance` decimal(11,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `{key}members`
-- ----------------------------
DROP TABLE IF EXISTS `{key}members`;
CREATE TABLE `{key}members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `createdate` int(11) DEFAULT '0',
  `lastlogindate` int(11) DEFAULT '0',
  `lastloginip` varchar(100) DEFAULT NULL,
  `profav` text,
  `points` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=143 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `{key}members_group`
-- ----------------------------
DROP TABLE IF EXISTS `{key}members_group`;
CREATE TABLE `{key}members_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `minpoints` int(11) DEFAULT NULL,
  `maxpoints` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `discount` float DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `{key}node`
-- ----------------------------
DROP TABLE IF EXISTS `{key}node`;
CREATE TABLE `{key}node` (
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
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `{key}orders`
-- ----------------------------
DROP TABLE IF EXISTS `{key}orders`;
CREATE TABLE `{key}orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sn` varchar(32) DEFAULT NULL,
  `member_id` int(11) NOT NULL DEFAULT '0',
  `delivery_email` varchar(96) NOT NULL DEFAULT '',
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
  `currency_value` decimal(14,2) DEFAULT NULL,
  `orders_total` decimal(14,2) DEFAULT NULL,
  `order_tax` decimal(14,2) DEFAULT NULL,
  `paypal_ipn_id` int(11) DEFAULT '0',
  `BuyNote` text,
  `ip_address` varchar(96) NOT NULL DEFAULT '',
  `shippingmoney` decimal(14,2) DEFAULT '0.00',
  `paymoney` decimal(14,2) DEFAULT '0.00',
  `insurance` decimal(14,2) DEFAULT '0.00',
  `currencies_code` varchar(20) DEFAULT '$',
  `shipping_id` int(11) DEFAULT NULL,
  `total_weight` decimal(14,2) DEFAULT NULL,
  `discount` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_status_orders_cust_zen` (`orders_status`,`id`,`member_id`),
  KEY `idx_date_purchased_zen` (`dateline`)
) ENGINE=MyISAM AUTO_INCREMENT=126 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `{key}orders_products`
-- ----------------------------
DROP TABLE IF EXISTS `{key}orders_products`;
CREATE TABLE `{key}orders_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orders_id` int(11) NOT NULL DEFAULT '0',
  `products_id` int(11) NOT NULL DEFAULT '0',
  `products_model` varchar(255) DEFAULT NULL,
  `products_name` varchar(64) NOT NULL DEFAULT '',
  `products_price` decimal(15,2) NOT NULL DEFAULT '0.00',
  `products_pricespe` decimal(15,2) NOT NULL DEFAULT '0.00',
  `products_tax` decimal(7,2) NOT NULL DEFAULT '0.00',
  `products_quantity` float NOT NULL DEFAULT '0',
  `onetime_charges` decimal(15,2) NOT NULL DEFAULT '0.00',
  `products_priced_by_attribute` tinyint(1) NOT NULL DEFAULT '0',
  `product_is_free` tinyint(1) NOT NULL DEFAULT '0',
  `products_discount_type` tinyint(1) NOT NULL DEFAULT '0',
  `products_discount_type_from` tinyint(1) NOT NULL DEFAULT '0',
  `products_total` float NOT NULL DEFAULT '0',
  `products_prid` tinytext,
  PRIMARY KEY (`id`),
  KEY `idx_orders_id_prod_id_zen` (`orders_id`,`products_id`)
) ENGINE=MyISAM AUTO_INCREMENT=124 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `{key}orders_shippingbills`
-- ----------------------------
DROP TABLE IF EXISTS `{key}orders_shippingbills`;
CREATE TABLE `{key}orders_shippingbills` (
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
) ENGINE=MyISAM AUTO_INCREMENT=68 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `{key}orders_status`
-- ----------------------------
DROP TABLE IF EXISTS `{key}orders_status`;
CREATE TABLE `{key}orders_status` (
  `orders_status_id` int(11) NOT NULL DEFAULT '0',
  `language_id` int(11) NOT NULL DEFAULT '1',
  `orders_status_name` varchar(32) NOT NULL DEFAULT '',
  PRIMARY KEY (`orders_status_id`,`language_id`),
  KEY `idx_orders_status_name_zen` (`orders_status_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `{key}orders_status_history`
-- ----------------------------
DROP TABLE IF EXISTS `{key}orders_status_history`;
CREATE TABLE `{key}orders_status_history` (
  `orders_status_history_id` int(11) NOT NULL AUTO_INCREMENT,
  `orders_id` int(11) NOT NULL DEFAULT '0',
  `orders_status_id` int(5) NOT NULL DEFAULT '0',
  `date_added` datetime NOT NULL DEFAULT '0001-01-01 00:00:00',
  `customer_notified` int(1) DEFAULT '0',
  `comments` text,
  PRIMARY KEY (`orders_status_history_id`),
  KEY `idx_orders_id_status_id_zen` (`orders_id`,`orders_status_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `{key}orders_total`
-- ----------------------------
DROP TABLE IF EXISTS `{key}orders_total`;
CREATE TABLE `{key}orders_total` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `{key}payment`
-- ----------------------------
DROP TABLE IF EXISTS `{key}payment`;
CREATE TABLE `{key}payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `remark` text,
  `var` varchar(255) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  `img_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `{key}products`
-- ----------------------------
DROP TABLE IF EXISTS `{key}products`;
CREATE TABLE `{key}products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cateid` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `serial` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` decimal(11,2) DEFAULT '0.00',
  `pricespe` decimal(11,2) DEFAULT NULL,
  `weight` decimal(11,2) DEFAULT '0.00',
  `bigimage` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `smallimage` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remark` text CHARACTER SET utf8,
  `isnew` int(5) DEFAULT '0',
  `ishot` int(5) DEFAULT '0',
  `isrec` int(5) DEFAULT '0',
  `isprice` int(5) DEFAULT '0',
  `isdown` int(5) DEFAULT '0',
  `dateline` int(11) DEFAULT '0',
  `sort` int(11) DEFAULT '0',
  `brandid` int(11) DEFAULT NULL,
  `viewcount` int(10) DEFAULT '0',
  `points` int(11) DEFAULT '0',
  `costprice` decimal(11,2) DEFAULT NULL,
  `provider` decimal(11,2) DEFAULT NULL,
  `stock` int(11) DEFAULT '0',
  `pagetitle` text COLLATE utf8_unicode_ci,
  `pagekey` text COLLATE utf8_unicode_ci,
  `pagedec` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `pid` (`id`),
  KEY `classid` (`cateid`),
  KEY `product_name` (`name`),
  KEY `isnew` (`isnew`),
  KEY `ishot` (`ishot`),
  KEY `isrec` (`isrec`),
  KEY `isprice` (`isprice`),
  KEY `dateline` (`dateline`)
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for `{key}products_ask`
-- ----------------------------
DROP TABLE IF EXISTS `{key}products_ask`;
CREATE TABLE `{key}products_ask` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `tel` varchar(100) DEFAULT NULL,
  `qq` varchar(100) DEFAULT NULL,
  `msn` varchar(100) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` mediumtext,
  `replay` mediumtext,
  `ip` varchar(20) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  `dateline` int(255) DEFAULT NULL,
  `products_id` int(11) DEFAULT NULL,
  `status` enum('1','0') DEFAULT '0',
  `star` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5617 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `{key}products_attr`
-- ----------------------------
DROP TABLE IF EXISTS `{key}products_attr`;
CREATE TABLE `{key}products_attr` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `products_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `attr_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `attr_value` text NOT NULL,
  `attr_price` varchar(255) DEFAULT '',
  `sort` int(10) DEFAULT NULL,
  `dateline` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `goods_id` (`products_id`),
  KEY `attr_id` (`attr_id`)
) ENGINE=MyISAM AUTO_INCREMENT=56059 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `{key}products_gallery`
-- ----------------------------
DROP TABLE IF EXISTS `{key}products_gallery`;
CREATE TABLE `{key}products_gallery` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `pid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `img_url` varchar(255) NOT NULL DEFAULT '',
  `img_desc` varchar(255) NOT NULL DEFAULT '',
  `thumb_url` varchar(255) NOT NULL DEFAULT '',
  `img_original` varchar(255) DEFAULT '',
  `sort` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `goods_id` (`pid`)
) ENGINE=MyISAM AUTO_INCREMENT=5045 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `{key}products_related`
-- ----------------------------
DROP TABLE IF EXISTS `{key}products_related`;
CREATE TABLE `{key}products_related` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `products_id` int(11) NOT NULL,
  `related_products_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=111 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `{key}region`
-- ----------------------------
DROP TABLE IF EXISTS `{key}region`;
CREATE TABLE `{key}region` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `pid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `name` varchar(120) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '2',
  `agency_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `parent_id` (`pid`),
  KEY `region_type` (`type`),
  KEY `agency_id` (`agency_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3723 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `{key}role`
-- ----------------------------
DROP TABLE IF EXISTS `{key}role`;
CREATE TABLE `{key}role` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `pid` smallint(6) DEFAULT NULL,
  `status` tinyint(1) unsigned DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `sort` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`),
  KEY `status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `{key}role_user`
-- ----------------------------
DROP TABLE IF EXISTS `{key}role_user`;
CREATE TABLE `{key}role_user` (
  `role_id` mediumint(9) unsigned DEFAULT NULL,
  `user_id` char(32) DEFAULT NULL,
  KEY `group_id` (`role_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `{key}setting`
-- ----------------------------
DROP TABLE IF EXISTS `{key}setting`;
CREATE TABLE `{key}setting` (
  `vid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `valuename` varchar(50) DEFAULT NULL,
  `valuetxt` longtext,
  PRIMARY KEY (`vid`),
  KEY `valuename` (`valuename`)
) ENGINE=MyISAM AUTO_INCREMENT=209 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `{key}shipping`
-- ----------------------------
DROP TABLE IF EXISTS `{key}shipping`;
CREATE TABLE `{key}shipping` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL DEFAULT '',
  `name` varchar(120) NOT NULL DEFAULT '',
  `remark` varchar(255) NOT NULL DEFAULT '',
  `insure` varchar(10) NOT NULL DEFAULT '0',
  `support_cod` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `print` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `shipping_code` (`code`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `{key}shipping_area`
-- ----------------------------
DROP TABLE IF EXISTS `{key}shipping_area`;
CREATE TABLE `{key}shipping_area` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL DEFAULT '',
  `shipping_id` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `config` text NOT NULL,
  `base_fee` varchar(150) NOT NULL,
  `step_fee` varchar(150) DEFAULT NULL,
  `free_money` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shipping_id` (`shipping_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `{key}shippingaddress`
-- ----------------------------
DROP TABLE IF EXISTS `{key}shippingaddress`;
CREATE TABLE `{key}shippingaddress` (
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

-- ----------------------------
-- Table structure for `{key}type_attr`
-- ----------------------------
DROP TABLE IF EXISTS `{key}type_attr`;
CREATE TABLE `{key}type_attr` (
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
) ENGINE=MyISAM AUTO_INCREMENT=223 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `{key}type_cate`
-- ----------------------------
DROP TABLE IF EXISTS `{key}type_cate`;
CREATE TABLE `{key}type_cate` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL DEFAULT '',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `attr_group` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `{key}user`
-- ----------------------------
DROP TABLE IF EXISTS `{key}user`;
CREATE TABLE `{key}user` (
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
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;
