
INSERT INTO `{key}form` (`id`, `title`, `content`, `create_time`, `update_time`, `status`, `email`) VALUES
(1, '这是测试数据', 'dfdf', 1212724876, 0, 1, 'dddd@ddd.com');



INSERT INTO `{key}group` (`id`, `name`, `pid`, `status`, `remark`, `ename`) VALUES
(1, '管理员组', NULL, 1, '具有一般管理员权限', NULL),
(2, '普通用户组', NULL, 1, '一般用户权限', NULL);



INSERT INTO `{key}groupuser` (`groupId`, `userId`) VALUES
(1, 3),
(2, 2);


INSERT INTO `{key}node` (`id`, `name`, `title`, `status`, `remark`, `seqNo`, `pid`, `level`, `type`) VALUES
(1, 'RbacAdmin', '后台项目', 1, '后台管理项目', NULL, 0, 1, 0),
(2, 'Public', '公共模块', 1, '项目公共模块', NULL, 1, 2, 0),
(3, 'Index', '默认模块', 1, '项目默认模块', NULL, 1, 2, 0),
(4, 'Node', '节点管理', 1, '授权节点管理', NULL, 1, 2, 0),
(5, 'Group', '权限管理', 1, '权限管理模块', NULL, 1, 2, 0),
(6, 'User', '用户管理', 1, '用户模块', NULL, 1, 2, 0),
(7, 'Form', '数据管理', 1, '数据管理模块', NULL, 1, 2, 0),
(8, 'index', '列表', 1, '', NULL, 2, 3, 0),
(9, 'add', '增加', 1, '', NULL, 2, 3, 0),
(10, 'edit', '编辑', 1, '', NULL, 2, 3, 0),
(11, 'insert', '写入', 1, '', NULL, 2, 3, 0),
(12, 'update', '更新', 1, '', NULL, 2, 3, 0),
(13, 'delete', '删除', 1, '', NULL, 2, 3, 0),
(14, 'forbid', '禁用', 1, '', NULL, 2, 3, 0),
(15, 'resume', '恢复', 1, '', NULL, 2, 3, 0),
(16, 'resetPwd', '重置密码', 1, '', NULL, 6, 3, 0);



INSERT INTO `{key}user` (`id`, `account`, `nickname`, `password`, `remark`, `create_time`, `update_time`, `status`) VALUES
(1, 'admin', '管理员', '21232f297a57a5a743894a0e4a801fc3', '', 0, 0, 1),
(2, 'test', '测试用户', 'e10adc3949ba59abbe56e057f20f883e', '测试用户', 1212716492, 0, 1),
(3, 'leader', '领导', 'e10adc3949ba59abbe56e057f20f883e', '具有一般管理权限的用户', 1212716969, 0, 1);



INSERT INTO `{key}access` (`groupId`, `nodeId`, `level`, `parentNodeId`, `status`) VALUES
(1, 1, 1, 0, NULL),
(1, 6, 2, 1, NULL),
(1, 3, 2, 1, NULL),
(1, 2, 2, 1, NULL),
(2, 1, 1, 0, NULL),
(2, 7, 2, 1, NULL),
(2, 3, 2, 1, NULL),
(2, 8, 3, 2, NULL),
(2, 9, 3, 2, NULL),
(2, 10, 3, 2, NULL),
(1, 7, 2, 1, NULL),
(1, 12, 3, 2, NULL),
(1, 11, 3, 2, NULL),
(1, 10, 3, 2, NULL),
(1, 9, 3, 2, NULL),
(1, 8, 3, 2, NULL),
(1, 13, 3, 2, NULL),
(1, 14, 3, 2, NULL),
(1, 15, 3, 2, NULL),
(1, 16, 3, 6, NULL),
(2, 2, 2, 1, NULL);