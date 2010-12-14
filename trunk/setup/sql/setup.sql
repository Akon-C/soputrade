SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `accesslog`
-- ----------------------------
DROP TABLE IF EXISTS `accesslog`;
CREATE TABLE `accesslog` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `logid` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `referrer` varchar(255) DEFAULT NULL,
  `goods` text,
  `ip` varchar(15) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `dateline` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of accesslog
-- ----------------------------

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
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COMMENT='广告';
-- ----------------------------
-- Table structure for `{key}article`
-- ----------------------------
DROP TABLE IF EXISTS `{key}article`;
CREATE TABLE `{key}article` (
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
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
-- ----------------------------
-- Table structure for `{key}article_cate`
-- ----------------------------
DROP TABLE IF EXISTS `{key}article_cate`;
CREATE TABLE `{key}article_cate` (
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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COMMENT='品牌';
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
) ENGINE=MyISAM AUTO_INCREMENT=76 DEFAULT CHARSET=utf8;
-- ----------------------------
-- Table structure for `{key}cate`
-- ----------------------------
DROP TABLE IF EXISTS `{key}cate`;
CREATE TABLE `{key}cate` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `imgurl` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pid` int(11) NOT NULL DEFAULT '0',
  `type_id` int(11) DEFAULT '0',
  `sort` int(11) DEFAULT '0',
  `txt2` text COLLATE utf8_unicode_ci,
  `total` text COLLATE utf8_unicode_ci,
  `ishot` varchar(11) COLLATE utf8_unicode_ci DEFAULT '0',
  `pagetitle` text CHARACTER SET utf8,
  `pagekey` text CHARACTER SET utf8,
  `pagedec` text CHARACTER SET utf8,
  `attr` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`id`),
  KEY `classname` (`name`),
  KEY `upid` (`pid`),
  KEY `orderby` (`sort`),
  KEY `ishot` (`ishot`)
) ENGINE=MyISAM AUTO_INCREMENT=1366 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='类别';
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
) ENGINE=InnoDB AUTO_INCREMENT=241 DEFAULT CHARSET=utf8;
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
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
  PRIMARY KEY (`id`),
  KEY `idx_status_orders_cust_zen` (`orders_status`,`id`,`member_id`),
  KEY `idx_date_purchased_zen` (`dateline`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `{key}products`
-- ----------------------------
DROP TABLE IF EXISTS `{key}products`;
CREATE TABLE `{key}products` (
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
) ENGINE=MyISAM AUTO_INCREMENT=241 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- ----------------------------
-- Table structure for `{key}products_attr`
-- ----------------------------
DROP TABLE IF EXISTS `{key}products_attr`;
CREATE TABLE `{key}products_attr` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `products_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `attr_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `attr_value` text NOT NULL,
  `attr_price` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `goods_id` (`products_id`),
  KEY `attr_id` (`attr_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1012 DEFAULT CHARSET=utf8;
-- ----------------------------
-- Table structure for `{key}products_related`
-- ----------------------------
DROP TABLE IF EXISTS `{key}products_related`;
CREATE TABLE `{key}products_related` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `products_id` int(11) NOT NULL,
  `related_products_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;
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
) ENGINE=MyISAM AUTO_INCREMENT=97 DEFAULT CHARSET=utf8;
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
) ENGINE=MyISAM AUTO_INCREMENT=217 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;


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
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;
-- ----------------------------
-- Records of {key}access
-- ----------------------------
INSERT INTO `{key}access` VALUES ('2', '13', '0', null);
INSERT INTO `{key}access` VALUES ('2', '14', '0', null);
INSERT INTO `{key}access` VALUES ('1', '17', '0', null);
INSERT INTO `{key}access` VALUES ('1', '8', '0', null);
INSERT INTO `{key}access` VALUES ('2', '15', '0', null);
INSERT INTO `{key}access` VALUES ('2', '18', '0', null);
INSERT INTO `{key}access` VALUES ('2', '16', '0', null);
INSERT INTO `{key}access` VALUES ('11', '15', '0', null);
INSERT INTO `{key}access` VALUES ('11', '14', '0', null);
INSERT INTO `{key}access` VALUES ('11', '13', '0', null);
INSERT INTO `{key}access` VALUES ('11', '10', '0', null);
INSERT INTO `{key}access` VALUES ('2', '17', '0', null);
INSERT INTO `{key}access` VALUES ('2', '8', '0', null);
INSERT INTO `{key}access` VALUES ('2', '10', '0', null);
INSERT INTO `{key}access` VALUES ('1', '16', '0', null);
INSERT INTO `{key}access` VALUES ('1', '19', '0', null);
INSERT INTO `{key}access` VALUES ('1', '18', '0', null);
INSERT INTO `{key}access` VALUES ('1', '15', '0', null);
INSERT INTO `{key}access` VALUES ('1', '14', '0', null);
INSERT INTO `{key}access` VALUES ('1', '13', '0', null);
INSERT INTO `{key}access` VALUES ('1', '10', '0', null);


-- ----------------------------
-- Records of {key}countries
-- ----------------------------
INSERT INTO `{key}countries` VALUES ('1', 'Afghanistan', 'AF', 'AFG', '1');
INSERT INTO `{key}countries` VALUES ('2', 'Albania', 'AL', 'ALB', '1');
INSERT INTO `{key}countries` VALUES ('3', 'Algeria', 'DZ', 'DZA', '1');
INSERT INTO `{key}countries` VALUES ('4', 'American Samoa', 'AS', 'ASM', '1');
INSERT INTO `{key}countries` VALUES ('5', 'Andorra', 'AD', 'AND', '1');
INSERT INTO `{key}countries` VALUES ('6', 'Angola', 'AO', 'AGO', '1');
INSERT INTO `{key}countries` VALUES ('7', 'Anguilla', 'AI', 'AIA', '1');
INSERT INTO `{key}countries` VALUES ('8', 'Antarctica', 'AQ', 'ATA', '1');
INSERT INTO `{key}countries` VALUES ('9', 'Antigua and Barbuda', 'AG', 'ATG', '1');
INSERT INTO `{key}countries` VALUES ('10', 'Argentina', 'AR', 'ARG', '1');
INSERT INTO `{key}countries` VALUES ('11', 'Armenia', 'AM', 'ARM', '1');
INSERT INTO `{key}countries` VALUES ('12', 'Aruba', 'AW', 'ABW', '1');
INSERT INTO `{key}countries` VALUES ('13', 'Australia', 'AU', 'AUS', '1');
INSERT INTO `{key}countries` VALUES ('14', 'Austria', 'AT', 'AUT', '5');
INSERT INTO `{key}countries` VALUES ('15', 'Azerbaijan', 'AZ', 'AZE', '1');
INSERT INTO `{key}countries` VALUES ('16', 'Bahamas', 'BS', 'BHS', '1');
INSERT INTO `{key}countries` VALUES ('17', 'Bahrain', 'BH', 'BHR', '1');
INSERT INTO `{key}countries` VALUES ('18', 'Bangladesh', 'BD', 'BGD', '1');
INSERT INTO `{key}countries` VALUES ('19', 'Barbados', 'BB', 'BRB', '1');
INSERT INTO `{key}countries` VALUES ('20', 'Belarus', 'BY', 'BLR', '1');
INSERT INTO `{key}countries` VALUES ('21', 'Belgium', 'BE', 'BEL', '1');
INSERT INTO `{key}countries` VALUES ('22', 'Belize', 'BZ', 'BLZ', '1');
INSERT INTO `{key}countries` VALUES ('23', 'Benin', 'BJ', 'BEN', '1');
INSERT INTO `{key}countries` VALUES ('24', 'Bermuda', 'BM', 'BMU', '1');
INSERT INTO `{key}countries` VALUES ('25', 'Bhutan', 'BT', 'BTN', '1');
INSERT INTO `{key}countries` VALUES ('26', 'Bolivia', 'BO', 'BOL', '1');
INSERT INTO `{key}countries` VALUES ('27', 'Bosnia and Herzegowina', 'BA', 'BIH', '1');
INSERT INTO `{key}countries` VALUES ('28', 'Botswana', 'BW', 'BWA', '1');
INSERT INTO `{key}countries` VALUES ('29', 'Bouvet Island', 'BV', 'BVT', '1');
INSERT INTO `{key}countries` VALUES ('30', 'Brazil', 'BR', 'BRA', '1');
INSERT INTO `{key}countries` VALUES ('31', 'British Indian Ocean Territory', 'IO', 'IOT', '1');
INSERT INTO `{key}countries` VALUES ('32', 'Brunei Darussalam', 'BN', 'BRN', '1');
INSERT INTO `{key}countries` VALUES ('33', 'Bulgaria', 'BG', 'BGR', '1');
INSERT INTO `{key}countries` VALUES ('34', 'Burkina Faso', 'BF', 'BFA', '1');
INSERT INTO `{key}countries` VALUES ('35', 'Burundi', 'BI', 'BDI', '1');
INSERT INTO `{key}countries` VALUES ('36', 'Cambodia', 'KH', 'KHM', '1');
INSERT INTO `{key}countries` VALUES ('37', 'Cameroon', 'CM', 'CMR', '1');
INSERT INTO `{key}countries` VALUES ('38', 'Canada', 'CA', 'CAN', '2');
INSERT INTO `{key}countries` VALUES ('39', 'Cape Verde', 'CV', 'CPV', '1');
INSERT INTO `{key}countries` VALUES ('40', 'Cayman Islands', 'KY', 'CYM', '1');
INSERT INTO `{key}countries` VALUES ('41', 'Central African Republic', 'CF', 'CAF', '1');
INSERT INTO `{key}countries` VALUES ('42', 'Chad', 'TD', 'TCD', '1');
INSERT INTO `{key}countries` VALUES ('43', 'Chile', 'CL', 'CHL', '1');
INSERT INTO `{key}countries` VALUES ('44', 'China', 'CN', 'CHN', '7');
INSERT INTO `{key}countries` VALUES ('45', 'Christmas Island', 'CX', 'CXR', '1');
INSERT INTO `{key}countries` VALUES ('46', 'Cocos (Keeling) Islands', 'CC', 'CCK', '1');
INSERT INTO `{key}countries` VALUES ('47', 'Colombia', 'CO', 'COL', '1');
INSERT INTO `{key}countries` VALUES ('48', 'Comoros', 'KM', 'COM', '1');
INSERT INTO `{key}countries` VALUES ('49', 'Congo', 'CG', 'COG', '1');
INSERT INTO `{key}countries` VALUES ('50', 'Cook Islands', 'CK', 'COK', '1');
INSERT INTO `{key}countries` VALUES ('51', 'Costa Rica', 'CR', 'CRI', '1');
INSERT INTO `{key}countries` VALUES ('52', 'Cote DIvoire', 'CI', 'CIV', '1');
INSERT INTO `{key}countries` VALUES ('53', 'Croatia', 'HR', 'HRV', '1');
INSERT INTO `{key}countries` VALUES ('54', 'Cuba', 'CU', 'CUB', '1');
INSERT INTO `{key}countries` VALUES ('55', 'Cyprus', 'CY', 'CYP', '1');
INSERT INTO `{key}countries` VALUES ('56', 'Czech Republic', 'CZ', 'CZE', '1');
INSERT INTO `{key}countries` VALUES ('57', 'Denmark', 'DK', 'DNK', '1');
INSERT INTO `{key}countries` VALUES ('58', 'Djibouti', 'DJ', 'DJI', '1');
INSERT INTO `{key}countries` VALUES ('59', 'Dominica', 'DM', 'DMA', '1');
INSERT INTO `{key}countries` VALUES ('60', 'Dominican Republic', 'DO', 'DOM', '1');
INSERT INTO `{key}countries` VALUES ('61', 'East Timor', 'TP', 'TMP', '1');
INSERT INTO `{key}countries` VALUES ('62', 'Ecuador', 'EC', 'ECU', '1');
INSERT INTO `{key}countries` VALUES ('63', 'Egypt', 'EG', 'EGY', '1');
INSERT INTO `{key}countries` VALUES ('64', 'El Salvador', 'SV', 'SLV', '1');
INSERT INTO `{key}countries` VALUES ('65', 'Equatorial Guinea', 'GQ', 'GNQ', '1');
INSERT INTO `{key}countries` VALUES ('66', 'Eritrea', 'ER', 'ERI', '1');
INSERT INTO `{key}countries` VALUES ('67', 'Estonia', 'EE', 'EST', '1');
INSERT INTO `{key}countries` VALUES ('68', 'Ethiopia', 'ET', 'ETH', '1');
INSERT INTO `{key}countries` VALUES ('69', 'Falkland Islands (Malvinas)', 'FK', 'FLK', '1');
INSERT INTO `{key}countries` VALUES ('70', 'Faroe Islands', 'FO', 'FRO', '1');
INSERT INTO `{key}countries` VALUES ('71', 'Fiji', 'FJ', 'FJI', '1');
INSERT INTO `{key}countries` VALUES ('72', 'Finland', 'FI', 'FIN', '1');
INSERT INTO `{key}countries` VALUES ('73', 'France', 'FR', 'FRA', '1');
INSERT INTO `{key}countries` VALUES ('74', 'France, Metropolitan', 'FX', 'FXX', '1');
INSERT INTO `{key}countries` VALUES ('75', 'French Guiana', 'GF', 'GUF', '1');
INSERT INTO `{key}countries` VALUES ('76', 'French Polynesia', 'PF', 'PYF', '1');
INSERT INTO `{key}countries` VALUES ('77', 'French Southern Territories', 'TF', 'ATF', '1');
INSERT INTO `{key}countries` VALUES ('78', 'Gabon', 'GA', 'GAB', '1');
INSERT INTO `{key}countries` VALUES ('79', 'Gambia', 'GM', 'GMB', '1');
INSERT INTO `{key}countries` VALUES ('80', 'Georgia', 'GE', 'GEO', '1');
INSERT INTO `{key}countries` VALUES ('81', 'Germany', 'DE', 'DEU', '5');
INSERT INTO `{key}countries` VALUES ('82', 'Ghana', 'GH', 'GHA', '1');
INSERT INTO `{key}countries` VALUES ('83', 'Gibraltar', 'GI', 'GIB', '1');
INSERT INTO `{key}countries` VALUES ('84', 'Greece', 'GR', 'GRC', '1');
INSERT INTO `{key}countries` VALUES ('85', 'Greenland', 'GL', 'GRL', '1');
INSERT INTO `{key}countries` VALUES ('86', 'Grenada', 'GD', 'GRD', '1');
INSERT INTO `{key}countries` VALUES ('87', 'Guadeloupe', 'GP', 'GLP', '1');
INSERT INTO `{key}countries` VALUES ('88', 'Guam', 'GU', 'GUM', '1');
INSERT INTO `{key}countries` VALUES ('89', 'Guatemala', 'GT', 'GTM', '1');
INSERT INTO `{key}countries` VALUES ('90', 'Guinea', 'GN', 'GIN', '1');
INSERT INTO `{key}countries` VALUES ('91', 'Guinea-bissau', 'GW', 'GNB', '1');
INSERT INTO `{key}countries` VALUES ('92', 'Guyana', 'GY', 'GUY', '1');
INSERT INTO `{key}countries` VALUES ('93', 'Haiti', 'HT', 'HTI', '1');
INSERT INTO `{key}countries` VALUES ('94', 'Heard and Mc Donald Islands', 'HM', 'HMD', '1');
INSERT INTO `{key}countries` VALUES ('95', 'Honduras', 'HN', 'HND', '1');
INSERT INTO `{key}countries` VALUES ('96', 'Hong Kong', 'HK', 'HKG', '7');
INSERT INTO `{key}countries` VALUES ('97', 'Hungary', 'HU', 'HUN', '1');
INSERT INTO `{key}countries` VALUES ('98', 'Iceland', 'IS', 'ISL', '1');
INSERT INTO `{key}countries` VALUES ('99', 'India', 'IN', 'IND', '1');
INSERT INTO `{key}countries` VALUES ('100', 'Indonesia', 'ID', 'IDN', '1');
INSERT INTO `{key}countries` VALUES ('101', 'Iran (Islamic Republic of)', 'IR', 'IRN', '1');
INSERT INTO `{key}countries` VALUES ('102', 'Iraq', 'IQ', 'IRQ', '1');
INSERT INTO `{key}countries` VALUES ('103', 'Ireland', 'IE', 'IRL', '1');
INSERT INTO `{key}countries` VALUES ('104', 'Israel', 'IL', 'ISR', '1');
INSERT INTO `{key}countries` VALUES ('105', 'Italy', 'IT', 'ITA', '1');
INSERT INTO `{key}countries` VALUES ('106', 'Jamaica', 'JM', 'JAM', '1');
INSERT INTO `{key}countries` VALUES ('107', 'Japan', 'JP', 'JPN', '1');
INSERT INTO `{key}countries` VALUES ('108', 'Jordan', 'JO', 'JOR', '1');
INSERT INTO `{key}countries` VALUES ('109', 'Kazakhstan', 'KZ', 'KAZ', '1');
INSERT INTO `{key}countries` VALUES ('110', 'Kenya', 'KE', 'KEN', '1');
INSERT INTO `{key}countries` VALUES ('111', 'Kiribati', 'KI', 'KIR', '1');
INSERT INTO `{key}countries` VALUES ('112', 'Korea, Democratic People\'s Republic', 'KP', 'PRK', '1');
INSERT INTO `{key}countries` VALUES ('113', 'Korea, Republic of', 'KR', 'KOR', '1');
INSERT INTO `{key}countries` VALUES ('114', 'Kuwait', 'KW', 'KWT', '1');
INSERT INTO `{key}countries` VALUES ('115', 'Kyrgyzstan', 'KG', 'KGZ', '1');
INSERT INTO `{key}countries` VALUES ('116', 'Lao People\'s Democratic Republic', 'LA', 'LAO', '1');
INSERT INTO `{key}countries` VALUES ('117', 'Latvia', 'LV', 'LVA', '1');
INSERT INTO `{key}countries` VALUES ('118', 'Lebanon', 'LB', 'LBN', '1');
INSERT INTO `{key}countries` VALUES ('119', 'Lesotho', 'LS', 'LSO', '1');
INSERT INTO `{key}countries` VALUES ('120', 'Liberia', 'LR', 'LBR', '1');
INSERT INTO `{key}countries` VALUES ('121', 'Libyan Arab Jamahiriya', 'LY', 'LBY', '1');
INSERT INTO `{key}countries` VALUES ('122', 'Liechtenstein', 'LI', 'LIE', '1');
INSERT INTO `{key}countries` VALUES ('123', 'Lithuania', 'LT', 'LTU', '1');
INSERT INTO `{key}countries` VALUES ('124', 'Luxembourg', 'LU', 'LUX', '1');
INSERT INTO `{key}countries` VALUES ('125', 'Macau', 'MO', 'MAC', '1');
INSERT INTO `{key}countries` VALUES ('126', 'Macedonia, The Former Yugoslav', 'MK', 'MKD', '1');
INSERT INTO `{key}countries` VALUES ('127', 'Madagascar', 'MG', 'MDG', '1');
INSERT INTO `{key}countries` VALUES ('128', 'Malawi', 'MW', 'MWI', '1');
INSERT INTO `{key}countries` VALUES ('129', 'Malaysia', 'MY', 'MYS', '1');
INSERT INTO `{key}countries` VALUES ('130', 'Maldives', 'MV', 'MDV', '1');
INSERT INTO `{key}countries` VALUES ('131', 'Mali', 'ML', 'MLI', '1');
INSERT INTO `{key}countries` VALUES ('132', 'Malta', 'MT', 'MLT', '1');
INSERT INTO `{key}countries` VALUES ('133', 'Marshall Islands', 'MH', 'MHL', '1');
INSERT INTO `{key}countries` VALUES ('134', 'Martinique', 'MQ', 'MTQ', '1');
INSERT INTO `{key}countries` VALUES ('135', 'Mauritania', 'MR', 'MRT', '1');
INSERT INTO `{key}countries` VALUES ('136', 'Mauritius', 'MU', 'MUS', '1');
INSERT INTO `{key}countries` VALUES ('137', 'Mayotte', 'YT', 'MYT', '1');
INSERT INTO `{key}countries` VALUES ('138', 'Mexico', 'MX', 'MEX', '1');
INSERT INTO `{key}countries` VALUES ('139', 'Micronesia, Federated States of', 'FM', 'FSM', '1');
INSERT INTO `{key}countries` VALUES ('140', 'Moldova, Republic of', 'MD', 'MDA', '1');
INSERT INTO `{key}countries` VALUES ('141', 'Monaco', 'MC', 'MCO', '1');
INSERT INTO `{key}countries` VALUES ('142', 'Mongolia', 'MN', 'MNG', '1');
INSERT INTO `{key}countries` VALUES ('143', 'Montserrat', 'MS', 'MSR', '1');
INSERT INTO `{key}countries` VALUES ('144', 'Morocco', 'MA', 'MAR', '1');
INSERT INTO `{key}countries` VALUES ('145', 'Mozambique', 'MZ', 'MOZ', '1');
INSERT INTO `{key}countries` VALUES ('146', 'Myanmar', 'MM', 'MMR', '1');
INSERT INTO `{key}countries` VALUES ('147', 'Namibia', 'NA', 'NAM', '1');
INSERT INTO `{key}countries` VALUES ('148', 'Nauru', 'NR', 'NRU', '1');
INSERT INTO `{key}countries` VALUES ('149', 'Nepal', 'NP', 'NPL', '1');
INSERT INTO `{key}countries` VALUES ('150', 'Netherlands', 'NL', 'NLD', '1');
INSERT INTO `{key}countries` VALUES ('151', 'Netherlands Antilles', 'AN', 'ANT', '1');
INSERT INTO `{key}countries` VALUES ('152', 'New Caledonia', 'NC', 'NCL', '1');
INSERT INTO `{key}countries` VALUES ('153', 'New Zealand', 'NZ', 'NZL', '1');
INSERT INTO `{key}countries` VALUES ('154', 'Nicaragua', 'NI', 'NIC', '1');
INSERT INTO `{key}countries` VALUES ('155', 'Niger', 'NE', 'NER', '1');
INSERT INTO `{key}countries` VALUES ('156', 'Nigeria', 'NG', 'NGA', '1');
INSERT INTO `{key}countries` VALUES ('157', 'Niue', 'NU', 'NIU', '1');
INSERT INTO `{key}countries` VALUES ('158', 'Norfolk Island', 'NF', 'NFK', '1');
INSERT INTO `{key}countries` VALUES ('159', 'Northern Mariana Islands', 'MP', 'MNP', '1');
INSERT INTO `{key}countries` VALUES ('160', 'Norway', 'NO', 'NOR', '1');
INSERT INTO `{key}countries` VALUES ('161', 'Oman', 'OM', 'OMN', '1');
INSERT INTO `{key}countries` VALUES ('162', 'Pakistan', 'PK', 'PAK', '1');
INSERT INTO `{key}countries` VALUES ('163', 'Palau', 'PW', 'PLW', '1');
INSERT INTO `{key}countries` VALUES ('164', 'Panama', 'PA', 'PAN', '1');
INSERT INTO `{key}countries` VALUES ('165', 'Papua New Guinea', 'PG', 'PNG', '1');
INSERT INTO `{key}countries` VALUES ('166', 'Paraguay', 'PY', 'PRY', '1');
INSERT INTO `{key}countries` VALUES ('167', 'Peru', 'PE', 'PER', '1');
INSERT INTO `{key}countries` VALUES ('168', 'Philippines', 'PH', 'PHL', '1');
INSERT INTO `{key}countries` VALUES ('169', 'Pitcairn', 'PN', 'PCN', '1');
INSERT INTO `{key}countries` VALUES ('170', 'Poland', 'PL', 'POL', '1');
INSERT INTO `{key}countries` VALUES ('171', 'Portugal', 'PT', 'PRT', '1');
INSERT INTO `{key}countries` VALUES ('172', 'Puerto Rico', 'PR', 'PRI', '1');
INSERT INTO `{key}countries` VALUES ('173', 'Qatar', 'QA', 'QAT', '1');
INSERT INTO `{key}countries` VALUES ('174', 'Reunion', 'RE', 'REU', '1');
INSERT INTO `{key}countries` VALUES ('175', 'Romania', 'RO', 'ROM', '1');
INSERT INTO `{key}countries` VALUES ('176', 'Russian Federation', 'RU', 'RUS', '1');
INSERT INTO `{key}countries` VALUES ('177', 'Rwanda', 'RW', 'RWA', '1');
INSERT INTO `{key}countries` VALUES ('178', 'Saint Kitts and Nevis', 'KN', 'KNA', '1');
INSERT INTO `{key}countries` VALUES ('179', 'Saint Lucia', 'LC', 'LCA', '1');
INSERT INTO `{key}countries` VALUES ('180', 'Saint Vincent and the Grenadines', 'VC', 'VCT', '1');
INSERT INTO `{key}countries` VALUES ('181', 'Samoa', 'WS', 'WSM', '1');
INSERT INTO `{key}countries` VALUES ('182', 'San Marino', 'SM', 'SMR', '1');
INSERT INTO `{key}countries` VALUES ('183', 'Sao Tome and Principe', 'ST', 'STP', '1');
INSERT INTO `{key}countries` VALUES ('184', 'Saudi Arabia', 'SA', 'SAU', '1');
INSERT INTO `{key}countries` VALUES ('185', 'Senegal', 'SN', 'SEN', '1');
INSERT INTO `{key}countries` VALUES ('186', 'Seychelles', 'SC', 'SYC', '1');
INSERT INTO `{key}countries` VALUES ('187', 'Sierra Leone', 'SL', 'SLE', '1');
INSERT INTO `{key}countries` VALUES ('188', 'Singapore', 'SG', 'SGP', '4');
INSERT INTO `{key}countries` VALUES ('189', 'Slovakia (Slovak Republic)', 'SK', 'SVK', '1');
INSERT INTO `{key}countries` VALUES ('190', 'Slovenia', 'SI', 'SVN', '1');
INSERT INTO `{key}countries` VALUES ('191', 'Solomon Islands', 'SB', 'SLB', '1');
INSERT INTO `{key}countries` VALUES ('192', 'Somalia', 'SO', 'SOM', '1');
INSERT INTO `{key}countries` VALUES ('193', 'South Africa', 'ZA', 'ZAF', '1');
INSERT INTO `{key}countries` VALUES ('194', 'South Georgia and the South Sandwich', 'GS', 'SGS', '1');
INSERT INTO `{key}countries` VALUES ('195', 'Spain', 'ES', 'ESP', '3');
INSERT INTO `{key}countries` VALUES ('196', 'Sri Lanka', 'LK', 'LKA', '1');
INSERT INTO `{key}countries` VALUES ('197', 'St. Helena', 'SH', 'SHN', '1');
INSERT INTO `{key}countries` VALUES ('198', 'St. Pierre and Miquelon', 'PM', 'SPM', '1');
INSERT INTO `{key}countries` VALUES ('199', 'Sudan', 'SD', 'SDN', '1');
INSERT INTO `{key}countries` VALUES ('200', 'Suriname', 'SR', 'SUR', '1');
INSERT INTO `{key}countries` VALUES ('201', 'Svalbard and Jan Mayen Islands', 'SJ', 'SJM', '1');
INSERT INTO `{key}countries` VALUES ('202', 'Swaziland', 'SZ', 'SWZ', '1');
INSERT INTO `{key}countries` VALUES ('203', 'Sweden', 'SE', 'SWE', '1');
INSERT INTO `{key}countries` VALUES ('204', 'Switzerland', 'CH', 'CHE', '1');
INSERT INTO `{key}countries` VALUES ('205', 'Syrian Arab Republic', 'SY', 'SYR', '1');
INSERT INTO `{key}countries` VALUES ('206', 'Taiwan', 'TW', 'TWN', '7');
INSERT INTO `{key}countries` VALUES ('207', 'Tajikistan', 'TJ', 'TJK', '1');
INSERT INTO `{key}countries` VALUES ('208', 'Tanzania, United Republic of', 'TZ', 'TZA', '1');
INSERT INTO `{key}countries` VALUES ('209', 'Thailand', 'TH', 'THA', '1');
INSERT INTO `{key}countries` VALUES ('210', 'Togo', 'TG', 'TGO', '1');
INSERT INTO `{key}countries` VALUES ('211', 'Tokelau', 'TK', 'TKL', '1');
INSERT INTO `{key}countries` VALUES ('212', 'Tonga', 'TO', 'TON', '1');
INSERT INTO `{key}countries` VALUES ('213', 'Trinidad and Tobago', 'TT', 'TTO', '1');
INSERT INTO `{key}countries` VALUES ('214', 'Tunisia', 'TN', 'TUN', '1');
INSERT INTO `{key}countries` VALUES ('215', 'Turkey', 'TR', 'TUR', '1');
INSERT INTO `{key}countries` VALUES ('216', 'Turkmenistan', 'TM', 'TKM', '1');
INSERT INTO `{key}countries` VALUES ('217', 'Turks and Caicos Islands', 'TC', 'TCA', '1');
INSERT INTO `{key}countries` VALUES ('218', 'Tuvalu', 'TV', 'TUV', '1');
INSERT INTO `{key}countries` VALUES ('219', 'Uganda', 'UG', 'UGA', '1');
INSERT INTO `{key}countries` VALUES ('220', 'Ukraine', 'UA', 'UKR', '1');
INSERT INTO `{key}countries` VALUES ('221', 'United Arab Emirates', 'AE', 'ARE', '1');
INSERT INTO `{key}countries` VALUES ('222', 'United Kingdom', 'GB', 'GBR', '6');
INSERT INTO `{key}countries` VALUES ('223', 'United States', 'US', 'USA', '2');
INSERT INTO `{key}countries` VALUES ('224', 'United States Minor Outlying Islands', 'UM', 'UMI', '1');
INSERT INTO `{key}countries` VALUES ('225', 'Uruguay', 'UY', 'URY', '1');
INSERT INTO `{key}countries` VALUES ('226', 'Uzbekistan', 'UZ', 'UZB', '1');
INSERT INTO `{key}countries` VALUES ('227', 'Vanuatu', 'VU', 'VUT', '1');
INSERT INTO `{key}countries` VALUES ('228', 'Vatican City State (Holy See)', 'VA', 'VAT', '1');
INSERT INTO `{key}countries` VALUES ('229', 'Venezuela', 'VE', 'VEN', '1');
INSERT INTO `{key}countries` VALUES ('230', 'Viet Nam', 'VN', 'VNM', '1');
INSERT INTO `{key}countries` VALUES ('231', 'Virgin Islands (British)', 'VG', 'VGB', '1');
INSERT INTO `{key}countries` VALUES ('232', 'Virgin Islands (U.S.)', 'VI', 'VIR', '1');
INSERT INTO `{key}countries` VALUES ('233', 'Wallis and Futuna Islands', 'WF', 'WLF', '1');
INSERT INTO `{key}countries` VALUES ('234', 'Western Sahara', 'EH', 'ESH', '1');
INSERT INTO `{key}countries` VALUES ('235', 'Yemen', 'YE', 'YEM', '1');
INSERT INTO `{key}countries` VALUES ('236', 'Yugoslavia', 'YU', 'YUG', '1');
INSERT INTO `{key}countries` VALUES ('237', 'Zaire', 'ZR', 'ZAR', '1');
INSERT INTO `{key}countries` VALUES ('238', 'Zambia', 'ZM', 'ZMB', '1');
INSERT INTO `{key}countries` VALUES ('239', 'Zimbabwe', 'ZW', 'ZWE', '1');
INSERT INTO `{key}countries` VALUES ('240', 'Aaland Islands', 'AX', 'ALA', '1');


-- ----------------------------
-- Records of {key}setting
-- ----------------------------
INSERT INTO `{key}setting` VALUES ('1', 'sitename', '莆田外贸系统111');
INSERT INTO `{key}setting` VALUES ('2', 'siteurl', '127.0.0.1');
INSERT INTO `{key}setting` VALUES ('3', 'keywords', 'fffffffffffffff');
INSERT INTO `{key}setting` VALUES ('37', 'rmbtousd', '6.8');
INSERT INTO `{key}setting` VALUES ('38', 'isPaypalvisa', '0');
INSERT INTO `{key}setting` VALUES ('39', 'Paypalvisa', '402660_1224487424_biz_api1.qq.com');
INSERT INTO `{key}setting` VALUES ('40', 'Paypalvisapwd', '1224487470');
INSERT INTO `{key}setting` VALUES ('41', 'Paypalvisamd5', 'AE5yv9AJLySsZBdXGOEWgKijTICUASsRNCO241tw1YWXgZGeC-KvO.Z9');
INSERT INTO `{key}setting` VALUES ('4', 'description', 'dddddddddddddddd');
INSERT INTO `{key}setting` VALUES ('9', 'ImgThumbW', '180');
INSERT INTO `{key}setting` VALUES ('10', 'ImgThumbH', '180');
INSERT INTO `{key}setting` VALUES ('55', 'ismoneygram', '1');
INSERT INTO `{key}setting` VALUES ('12', 'pagesize', '25');
INSERT INTO `{key}setting` VALUES ('56', 'moneygram', '<p>Account Name: Account Number: Receiver Telephone: Bank Name: Bank Address: Swift Code:444444444444</p>');
INSERT INTO `{key}setting` VALUES ('32', 'isgspay', '1');
INSERT INTO `{key}setting` VALUES ('33', 'gspay', '1234564');
INSERT INTO `{key}setting` VALUES ('36', 'ipspaykey', 'Czat10g3rA098r2iyGVIH2gYjRcLrc1HwWqVx4zVSozf7eBmtk6zhXUktbk9yumoiInCb7KUqaP2ca1fpP1g6c9ycgBvuP68blXOQZlMzBigh1hs9fu8SgIgjO9UVzA1');
INSERT INTO `{key}setting` VALUES ('35', 'isipspay', '1');
INSERT INTO `{key}setting` VALUES ('34', 'ips', '012159');
INSERT INTO `{key}setting` VALUES ('17', 'email', '811046@qq.com');
INSERT INTO `{key}setting` VALUES ('18', 'hotmail', '811046@qq.com');
INSERT INTO `{key}setting` VALUES ('19', 'yahoo', '811046@qq.com');
INSERT INTO `{key}setting` VALUES ('20', 'passippassword', '123456');
INSERT INTO `{key}setting` VALUES ('21', 'lockip', 'a:95:{i:0;s:6:\"北京\";i:1;s:6:\"浙江\";i:2;s:6:\"天津\";i:3;s:6:\"安徽\";i:4;s:6:\"上海\";i:5;s:6:\"福建\";i:6;s:6:\"莆田\";i:7;s:6:\"重庆\";i:8;s:6:\"江西\";i:9;s:6:\"山东\";i:10;s:6:\"河南\";i:11;s:9:\"内蒙古\";i:12;s:6:\"湖北\";i:13;s:6:\"新疆\";i:14;s:6:\"湖南\";i:15;s:6:\"宁夏\";i:16;s:6:\"广东\";i:17;s:6:\"西藏\";i:18;s:6:\"海南\";i:19;s:6:\"广西\";i:20;s:6:\"四川\";i:21;s:6:\"河北\";i:22;s:6:\"贵州\";i:23;s:6:\"山西\";i:24;s:6:\"云南\";i:25;s:6:\"辽宁\";i:26;s:6:\"陕西\";i:27;s:7:\" 吉林\";i:28;s:6:\"甘肃\";i:29;s:9:\"黑龙江\";i:30;s:6:\"青海\";i:31;s:6:\"江苏\";i:32;s:6:\"北京\";i:33;s:6:\"浙江\";i:34;s:6:\"天津\";i:35;s:6:\"安徽\";i:36;s:6:\"上海\";i:37;s:6:\"重庆\";i:38;s:6:\"江西\";i:39;s:6:\"山东\";i:40;s:6:\"河南\";i:41;s:9:\"内蒙古\";i:42;s:6:\"湖北\";i:43;s:6:\"新疆\";i:44;s:6:\"湖南\";i:45;s:6:\"宁夏\";i:46;s:6:\"广东\";i:47;s:6:\"西藏\";i:48;s:6:\"海南\";i:49;s:6:\"广西\";i:50;s:6:\"四川\";i:51;s:6:\"河北\";i:52;s:6:\"贵州\";i:53;s:6:\"山西\";i:54;s:6:\"云南\";i:55;s:6:\"辽宁\";i:56;s:6:\"陕西\";i:57;s:6:\"吉林\";i:58;s:6:\"甘肃\";i:59;s:9:\"黑龙江\";i:60;s:6:\"青海\";i:61;s:6:\"江苏\";i:62;s:6:\"北京\";i:63;s:6:\"浙江\";i:64;s:6:\"天津\";i:65;s:6:\"安徽\";i:66;s:6:\"上海\";i:67;s:6:\"重庆\";i:68;s:6:\"江西\";i:69;s:6:\"山东\";i:70;s:6:\"河南\";i:71;s:9:\"内蒙古\";i:72;s:6:\"湖北\";i:73;s:6:\"新疆\";i:74;s:6:\"湖南\";i:75;s:6:\"宁夏\";i:76;s:6:\"广东\";i:77;s:6:\"西藏\";i:78;s:6:\"海南\";i:79;s:6:\"广西\";i:80;s:6:\"四川\";i:81;s:6:\"河北\";i:82;s:6:\"贵州\";i:83;s:6:\"山西\";i:84;s:6:\"云南\";i:85;s:6:\"辽宁\";i:86;s:6:\"陕西\";i:87;s:6:\"吉林\";i:88;s:6:\"甘肃\";i:89;s:9:\"黑龙江\";i:90;s:6:\"青海\";i:91;s:6:\"江苏\";i:92;s:6:\"河南\";i:93;s:6:\"贵州\";i:94;s:6:\"陕西\";}');
INSERT INTO `{key}setting` VALUES ('22', 'Paypal', '409985_1258027859_biz@qq.com');
INSERT INTO `{key}setting` VALUES ('23', 'isPaypal', '1');
INSERT INTO `{key}setting` VALUES ('52', 'bill99', 'error');
INSERT INTO `{key}setting` VALUES ('53', 'isWesternUnion', '1');
INSERT INTO `{key}setting` VALUES ('54', 'WesternUnion', '<p>First Name : Last Name : Address : Zip Code : City : Country : Phone : 55555555555</p>');
INSERT INTO `{key}setting` VALUES ('25', 'tel', '0594-2265012');
INSERT INTO `{key}setting` VALUES ('26', 'npskey', '1234567812345678');
INSERT INTO `{key}setting` VALUES ('27', 'isnps', '0');
INSERT INTO `{key}setting` VALUES ('28', 'nps', '1234561');
INSERT INTO `{key}setting` VALUES ('29', 'ctopay', '1234562');
INSERT INTO `{key}setting` VALUES ('30', 'isctopay', '1');
INSERT INTO `{key}setting` VALUES ('31', 'ctopaykey', '1234563');
INSERT INTO `{key}setting` VALUES ('42', 'isBigimg', '0');
INSERT INTO `{key}setting` VALUES ('43', 'pagepronum', '20');
INSERT INTO `{key}setting` VALUES ('57', 'ecpssMd5Key', '323');
INSERT INTO `{key}setting` VALUES ('58', 'ecpssMer', '1284');
INSERT INTO `{key}setting` VALUES ('59', 'isecpss', '0');
INSERT INTO `{key}setting` VALUES ('60', 'hottitle', '<p>Welcome for you!</p>');
INSERT INTO `{key}setting` VALUES ('61', 'DisMethod', 'PCT');
INSERT INTO `{key}setting` VALUES ('62', 'DisBase', 'price');
INSERT INTO `{key}setting` VALUES ('63', 'DiscountTest', '111');
INSERT INTO `{key}setting` VALUES ('64', 'content', '<p>555555555555555555555555555</p>');
INSERT INTO `{key}setting` VALUES ('65', 'paypalinfo', '<p>paypal</p>');
INSERT INTO `{key}setting` VALUES ('66', 'moneygraminfo', '');
INSERT INTO `{key}setting` VALUES ('67', 'WesternUnioninfo', '<p>wu</p>');
INSERT INTO `{key}setting` VALUES ('69', 'alipay_account', '811046@qq.com');
INSERT INTO `{key}setting` VALUES ('68', 'isalipay', '1');
INSERT INTO `{key}setting` VALUES ('70', 'alipay_id', '2088002148043415');
INSERT INTO `{key}setting` VALUES ('71', 'alipay_code', 'cvqvqt8e2anyrm8hglin55za6t7l8jmr');
INSERT INTO `{key}setting` VALUES ('72', 'alipay_kefu', '<a target=_blank href=\\\"http://amos.im.alisoft.com/msg.aw?v=2&uid=ptpc120&site=cntaobao&s=1&charset=utf-8\\\" ><img border=0 src=\\\"http://amos.im.alisoft.com/online.aw?v=2&uid=ptpc120&site=cntaobao&s=1&charset=utf-8\\\" alt=\\\"点击这里给我发消息\\\" /></a>');
INSERT INTO `{key}setting` VALUES ('76', 'Text_set1', '<p>111111111111111111111</p>');
INSERT INTO `{key}setting` VALUES ('77', 'Images_img1', '0001.jpg');
INSERT INTO `{key}setting` VALUES ('78', 'Down_file1', '0001.jpg');
INSERT INTO `{key}setting` VALUES ('79', 'status', '0');
INSERT INTO `{key}setting` VALUES ('80', 'alipay_remark', '支付宝,alipay.com');
INSERT INTO `{key}setting` VALUES ('81', 'Alipay_status', '0');
INSERT INTO `{key}setting` VALUES ('82', 'footcode', 'fffdfadfsdafsda');
INSERT INTO `{key}setting` VALUES ('83', 'shipping', '<p>fdsafdafdfdsfdsaf</p>');
INSERT INTO `{key}setting` VALUES ('84', 'shippingremark', '<p style=\\\"margin: 0cm 0cm 0pt\\\" class=\\\"MsoNormal\\\"><strong style=\\\"mso-bidi-font-weight: normal\\\"><span style=\\\"font-family: Verdana; font-size: 12pt\\\" lang=\\\"EN-US\\\"><font size=\\\"2\\\">D</font></span></strong><span style=\\\"font-family: Verdana; font-size: 12pt\\\" lang=\\\"EN-US\\\"><font size=\\\"2\\\">efault : <st1:place w:st=\\\"on\\\">EMS</st1:place> . If you have special requestment . Plz contact us . Thanks !<br />\r\nDelivery time : 3-7 days according where you are located and the kind of the express company .<o:p></o:p></font></span></p>\r\n<p style=\\\"margin: 0cm 0cm 0pt\\\" class=\\\"MsoNormal\\\"><span style=\\\"font-family: Verdana; font-size: 12pt\\\" lang=\\\"EN-US\\\"><font size=\\\"2\\\">jerseysmaker.com support these expresses .</font> </span></p>\r\n<p style=\\\"margin: 0cm 0cm 0pt\\\" class=\\\"MsoNormal\\\"><span style=\\\"font-family: Verdana; font-size: 12pt\\\" lang=\\\"EN-US\\\"><img border=\\\"0\\\" src=\\\"http://www.b2b1999.com/upfile/10/201061623413631331.gif\\\" alt=\\\"\\\" /></span><span style=\\\"font-family: Verdana; font-size: 12pt; font-weight: normal; mso-bidi-font-weight: bold\\\" lang=\\\"EN-US\\\"><img border=\\\"0\\\" src=\\\"http://www.b2b1999.com/upfile/10/201061623412199053.gif\\\" alt=\\\"\\\" /><img border=\\\"0\\\" src=\\\"http://www.b2b1999.com/upfile/10/201061623414181508.gif\\\" alt=\\\"\\\" /><img border=\\\"0\\\" src=\\\"http://www.b2b1999.com/upfile/10/20106162342138856.gif\\\" alt=\\\"\\\" /><img border=\\\"0\\\" src=\\\"http://www.b2b1999.com/upfile/10/201061623421833618.gif\\\" alt=\\\"\\\" /><img border=\\\"0\\\" src=\\\"http://www.b2b1999.com/upfile/10/20106162342681016.gif\\\" alt=\\\"\\\" /></span><font size=\\\"2\\\"><span style=\\\"font-family: Verdana; font-size: 12pt\\\" lang=\\\"EN-US\\\">P</span><span style=\\\"font-family: Verdana; font-size: 12pt; font-weight: normal; mso-bidi-font-weight: bold\\\" lang=\\\"EN-US\\\">ayment methods available on jerseysmaker.com :<o:p></o:p></span></font></p>\r\n<p style=\\\"text-align: left; margin: 0cm 0cm 0pt; mso-pagination: widow-orphan\\\" class=\\\"MsoNormal\\\" align=\\\"left\\\"><span style=\\\"font-family: Verdana; font-size: 12pt; mso-bidi-font-family: ����; mso-font-kerning: 0pt\\\" lang=\\\"EN-US\\\"><font size=\\\"2\\\">1) Credit Card<o:p></o:p></font></span></p>\r\n<p style=\\\"text-align: left; margin: 0cm 0cm 0pt; mso-pagination: widow-orphan\\\" class=\\\"MsoNormal\\\" align=\\\"left\\\"><span style=\\\"font-family: Verdana; font-size: 12pt; mso-bidi-font-family: ����; mso-font-kerning: 0pt\\\" lang=\\\"EN-US\\\"><font size=\\\"2\\\">2) Western <st1:place w:st=\\\"on\\\">Union</st1:place><o:p></o:p></font></span></p>\r\n<p style=\\\"text-align: left; margin: 0cm 0cm 0pt; mso-pagination: widow-orphan\\\" class=\\\"MsoNormal\\\" align=\\\"left\\\"><span style=\\\"font-family: Verdana; font-size: 12pt; mso-bidi-font-family: ����; mso-font-kerning: 0pt\\\" lang=\\\"EN-US\\\"><font size=\\\"2\\\">3) Money Gram<o:p></o:p></font></span></p>\r\n<p style=\\\"text-align: left; margin: 0cm 0cm 0pt; mso-pagination: widow-orphan\\\" class=\\\"MsoNormal\\\" align=\\\"left\\\"><span style=\\\"font-family: Verdana; font-size: 12pt; mso-bidi-font-family: ����; mso-font-kerning: 0pt\\\" lang=\\\"EN-US\\\"><font size=\\\"2\\\">4) Bank Transfer<o:p></o:p></font></span></p>\r\n<p style=\\\"text-align: left; margin: 0cm 0cm 0pt; mso-pagination: widow-orphan\\\" class=\\\"MsoNormal\\\" align=\\\"left\\\"><span style=\\\"font-family: Verdana; font-size: 12pt; mso-bidi-font-family: ����; mso-font-kerning: 0pt\\\" lang=\\\"EN-US\\\"><font size=\\\"2\\\">5) Others</font></span></p>');
INSERT INTO `{key}setting` VALUES ('85', 'shippingremarks', '<p style=\\\"&quot;margin: \\\" class=\\\"\\\\&quot;MsoNormal\\\\&quot;\\\"><strong style=\\\"&quot;mso-bidi-font-weight: \\\"><span style=\\\"&quot;font-family: \\\" lang=\\\"\\\\&quot;EN-US\\\\&quot;\\\"><font size=\\\"\\\\&quot;2\\\\&quot;\\\">D</font></span></strong><span style=\\\"&quot;font-family: \\\" lang=\\\"\\\\&quot;EN-US\\\\&quot;\\\"><font size=\\\"\\\\&quot;2\\\\&quot;\\\">efault : <st1:place w:st=\\\"\\\\&quot;on\\\\&quot;\\\">EMS</st1:place> . If you have special requestment . Plz contact us . Thanks !<br />\r\nDelivery time : 3-7 days according where you are located and the kind of the express company .<o:p></o:p></font></span></p>\r\n<p style=\\\"&quot;margin: \\\" class=\\\"\\\\&quot;MsoNormal\\\\&quot;\\\"><span style=\\\"&quot;font-family: \\\" lang=\\\"\\\\&quot;EN-US\\\\&quot;\\\"><font size=\\\"\\\\&quot;2\\\\&quot;\\\">jerseysmaker.com support these expresses .</font> </span></p>\r\n<p style=\\\"&quot;margin: \\\" class=\\\"\\\\&quot;MsoNormal\\\\&quot;\\\"><span style=\\\"&quot;font-family: \\\" lang=\\\"\\\\&quot;EN-US\\\\&quot;\\\"><img border=\\\"\\\\&quot;0\\\\&quot;\\\" alt=\\\"\\\\&quot;\\\\&quot;\\\" src=\\\"\\\\&quot;http://www.b2b1999.com/upfile/10/201061623413631331.gif\\\\&quot;\\\" /></span><span style=\\\"&quot;font-family: \\\" lang=\\\"\\\\&quot;EN-US\\\\&quot;\\\"><img border=\\\"\\\\&quot;0\\\\&quot;\\\" alt=\\\"\\\\&quot;\\\\&quot;\\\" src=\\\"\\\\&quot;http://www.b2b1999.com/upfile/10/201061623412199053.gif\\\\&quot;\\\" /><img border=\\\"\\\\&quot;0\\\\&quot;\\\" alt=\\\"\\\\&quot;\\\\&quot;\\\" src=\\\"\\\\&quot;http://www.b2b1999.com/upfile/10/201061623414181508.gif\\\\&quot;\\\" /><img border=\\\"\\\\&quot;0\\\\&quot;\\\" alt=\\\"\\\\&quot;\\\\&quot;\\\" src=\\\"\\\\&quot;http://www.b2b1999.com/upfile/10/20106162342138856.gif\\\\&quot;\\\" /><img border=\\\"\\\\&quot;0\\\\&quot;\\\" alt=\\\"\\\\&quot;\\\\&quot;\\\" src=\\\"\\\\&quot;http://www.b2b1999.com/upfile/10/201061623421833618.gif\\\\&quot;\\\" /><img border=\\\"\\\\&quot;0\\\\&quot;\\\" alt=\\\"\\\\&quot;\\\\&quot;\\\" src=\\\"\\\\&quot;http://www.b2b1999.com/upfile/10/20106162342681016.gif\\\\&quot;\\\" /></span><font size=\\\"\\\\&quot;2\\\\&quot;\\\"><span style=\\\"&quot;font-family: \\\" lang=\\\"\\\\&quot;EN-US\\\\&quot;\\\">P</span><span style=\\\"&quot;font-family: \\\" lang=\\\"\\\\&quot;EN-US\\\\&quot;\\\">ayment methods available on jerseysmaker.com :<o:p></o:p></span></font></p>\r\n<p style=\\\"&quot;text-align: \\\" class=\\\"\\\\&quot;MsoNormal\\\\&quot;\\\"><span style=\\\"&quot;font-family: \\\" lang=\\\"\\\\&quot;EN-US\\\\&quot;\\\"><font size=\\\"\\\\&quot;2\\\\&quot;\\\">1) Credit Card<o:p></o:p></font></span></p>\r\n<p style=\\\"&quot;text-align: \\\" class=\\\"\\\\&quot;MsoNormal\\\\&quot;\\\"><span style=\\\"&quot;font-family: \\\" lang=\\\"\\\\&quot;EN-US\\\\&quot;\\\"><font size=\\\"\\\\&quot;2\\\\&quot;\\\">2) Western <st1:place w:st=\\\"\\\\&quot;on\\\\&quot;\\\">Union</st1:place><o:p></o:p></font></span></p>\r\n<p style=\\\"&quot;text-align: \\\" class=\\\"\\\\&quot;MsoNormal\\\\&quot;\\\"><span style=\\\"&quot;font-family: \\\" lang=\\\"\\\\&quot;EN-US\\\\&quot;\\\"><font size=\\\"\\\\&quot;2\\\\&quot;\\\">3) Money Gram<o:p></o:p></font></span></p>\r\n<p style=\\\"&quot;text-align: \\\" class=\\\"\\\\&quot;MsoNormal\\\\&quot;\\\"><span style=\\\"&quot;font-family: \\\" lang=\\\"\\\\&quot;EN-US\\\\&quot;\\\"><font size=\\\"\\\\&quot;2\\\\&quot;\\\">4) Bank Transfer<o:p></o:p></font></span></p>\r\n<p style=\\\"&quot;text-align: \\\" class=\\\"\\\\&quot;MsoNormal\\\\&quot;\\\"><span style=\\\"&quot;font-family: \\\" lang=\\\"\\\\&quot;EN-US\\\\&quot;\\\"><font size=\\\"\\\\&quot;2\\\\&quot;\\\">5) Others</font></span></p>');
INSERT INTO `{key}setting` VALUES ('86', 'paypal_status', '1');
INSERT INTO `{key}setting` VALUES ('87', 'paypal_account', '402660_1224487424_biz@qq.com');
INSERT INTO `{key}setting` VALUES ('88', 'paypal_remark', 'PayPal has optimized their checkout experience by launching an exciting new improvement to their payment flow. ');
INSERT INTO `{key}setting` VALUES ('89', 'sendemailtype', 'smtp');
INSERT INTO `{key}setting` VALUES ('90', 'smtphost', 'smtp.qq.com');
INSERT INTO `{key}setting` VALUES ('91', 'smtpusername', '811046@qq.com');
INSERT INTO `{key}setting` VALUES ('92', 'smtppassword', '6363@6636');
INSERT INTO `{key}setting` VALUES ('93', 'smtpport', '25');
INSERT INTO `{key}setting` VALUES ('94', 'smtpisssl', '0');
INSERT INTO `{key}setting` VALUES ('95', 'mailfrom', '811046@qq.com');
INSERT INTO `{key}setting` VALUES ('96', 'mailcopyTo', '811046@qq.com');

-- ----------------------------
-- Records of {key}currencies
-- ----------------------------
INSERT INTO `{key}currencies` VALUES ('1', 'US Dollar', '$', '1', 'USD', '0');
INSERT INTO `{key}currencies` VALUES ('2', '人民币', '￥', '6.8', 'CNY', '0');
INSERT INTO `{key}currencies` VALUES ('3', 'Euro', '€', '0.79', 'EUR', '0');
INSERT INTO `{key}currencies` VALUES ('4', 'GB Pound', '£', '0.65', 'GBP', '0');


-- ----------------------------
-- Records of {key}node
-- ----------------------------
INSERT INTO `{key}node` VALUES ('14', 'Node', '节点管理', '1', '节点管理', '0', '8', '2');
INSERT INTO `{key}node` VALUES ('8', 'trade', '应用中心', '1', '', '0', '0', '1');
INSERT INTO `{key}node` VALUES ('10', 'role', '角色管理', '1', '角色管理', '0', '8', '2');
INSERT INTO `{key}node` VALUES ('15', 'User', '后台用户', '1', '后台用户', '0', '8', '2');
INSERT INTO `{key}node` VALUES ('13', 'index', '管理首页', '1', '管理首页', '0', '8', '2');
INSERT INTO `{key}node` VALUES ('16', 'Cate', '分类管理', '1', '', '1', '8', '2');
INSERT INTO `{key}node` VALUES ('17', 'Brand', '品牌管理', '1', '品牌管理', '2', '8', '2');
INSERT INTO `{key}node` VALUES ('18', 'Products', '产品管理', '1', '产品管理', '0', '8', '2');
INSERT INTO `{key}node` VALUES ('19', 'Article', '文章管理', '1', '', '0', '8', '1');




-- ----------------------------
-- Records of {key}payment
-- ----------------------------
INSERT INTO `{key}payment` VALUES ('1', 'Alipay', '支付宝', '支付宝', 'alipay_account,alipay_remark', '0');
INSERT INTO `{key}payment` VALUES ('2', 'Paypal', 'Paypal', 'Paypal', 'Paypal_account,Paypal_remark', '0');



-- ----------------------------
-- Records of {key}role
-- ----------------------------
INSERT INTO `{key}role` VALUES ('1', '系统管理员', '0', '1', null, '0');
INSERT INTO `{key}role` VALUES ('2', '产品操作员', '1', '1', null, '0');
INSERT INTO `{key}role` VALUES ('7', '市场推广员', '1', '1', null, '0');
INSERT INTO `{key}role` VALUES ('8', '系统维护员', '1', '1', null, '0');




-- ----------------------------
-- Records of {key}role_user
-- ----------------------------
INSERT INTO `{key}role_user` VALUES ('7', '35');
INSERT INTO `{key}role_user` VALUES ('8', '35');
INSERT INTO `{key}role_user` VALUES ('1', '35');
INSERT INTO `{key}role_user` VALUES ('2', '37');
INSERT INTO `{key}role_user` VALUES ('2', '35');


-- ----------------------------
-- Records of {key}user
-- ----------------------------
INSERT INTO `{key}user` VALUES ('35', 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', '', '0', null, '0', null, '', '', '0', '0', '1', '0', '1', '');
INSERT INTO `{key}user` VALUES ('37', 'nanze', '产品管理员', '202cb962ac59075b964b07152d234b70', '', '0', null, '0', null, '', '', '0', '0', '1', '0', '0', '');
