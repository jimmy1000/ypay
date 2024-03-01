DROP TABLE IF EXISTS `admin_admin`;
CREATE TABLE IF NOT EXISTS `admin_admin` (
  `id` int(11) unsigned NOT NULL COMMENT 'ID',
  `username` varchar(30) NOT NULL COMMENT '用户名，登陆使用',
  `password` varchar(30) NOT NULL COMMENT '用户密码',
  `nickname` varchar(30) NOT NULL COMMENT '用户昵称',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '用户状态：1正常,2禁用 默认1',
  `token` varchar(60) DEFAULT NULL COMMENT 'token',
  `create_time` timestamp NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` timestamp NULL DEFAULT NULL COMMENT '更新时间',
  `delete_time` timestamp NULL DEFAULT NULL COMMENT '删除时间',
  `ypay_ver` int(11) DEFAULT NULL COMMENT '版本号'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='管理表';

-- --------------------------------------------------------

--
-- 表的结构 `admin_admin_log`
--

DROP TABLE IF EXISTS `admin_admin_log`;
CREATE TABLE IF NOT EXISTS `admin_admin_log` (
  `id` int(11) unsigned NOT NULL COMMENT 'ID',
  `uid` int(11) DEFAULT NULL COMMENT '管理员ID',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '操作页面',
  `desc` text COMMENT '日志内容',
  `ip` varchar(20) NOT NULL DEFAULT '' COMMENT '操作IP',
  `user_agent` text NOT NULL COMMENT 'User-Agent',
  `create_time` timestamp NULL DEFAULT NULL COMMENT '创建时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='管理员日志';

-- --------------------------------------------------------

--
-- 表的结构 `admin_admin_permission`
--

DROP TABLE IF EXISTS `admin_admin_permission`;
CREATE TABLE IF NOT EXISTS `admin_admin_permission` (
  `id` int(11) unsigned NOT NULL COMMENT 'ID',
  `admin_id` int(11) DEFAULT NULL COMMENT '用户ID',
  `permission_id` int(11) DEFAULT NULL COMMENT '权限ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='管理-权限中间表';

-- --------------------------------------------------------

--
-- 表的结构 `admin_admin_role`
--

DROP TABLE IF EXISTS `admin_admin_role`;
CREATE TABLE IF NOT EXISTS `admin_admin_role` (
  `id` int(11) unsigned NOT NULL COMMENT 'ID',
  `admin_id` int(11) DEFAULT NULL COMMENT '用户ID',
  `role_id` int(11) DEFAULT NULL COMMENT '角色ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='管理-角色中间表';

-- --------------------------------------------------------

--
-- 表的结构 `admin_channel`
--

DROP TABLE IF EXISTS `admin_channel`;
CREATE TABLE IF NOT EXISTS `admin_channel` (
  `id` int(11) unsigned NOT NULL COMMENT 'id',
  `name` varchar(50) DEFAULT NULL COMMENT '通道名称',
  `type` varchar(50) DEFAULT NULL COMMENT '支付类型',
  `code` varchar(50) DEFAULT NULL COMMENT '通道标识',
  `info` varchar(225) DEFAULT NULL COMMENT '通道介绍',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '通道状态',
  `create_time` timestamp NULL DEFAULT NULL COMMENT '创建时间',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `maxcount` int(11) NOT NULL DEFAULT '10'
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='通道列表';

--
-- 转存表中的数据 `admin_channel`
--

INSERT INTO `admin_channel` (`id`, `name`, `type`, `code`, `info`, `status`, `create_time`, `sort`, `maxcount`) VALUES
(1, '支付宝商家版', 'alipay', 'alipay_mg', '需开通商家服务', 1, '2022-05-19 12:27:46', 0, 10),
(2, '支付宝个人版', 'alipay', 'alipay_grmg', '支付宝个人版免挂', 1, '2022-05-19 12:28:59', 1, 10),
(3, '支付宝软件版', 'alipay', 'alipay_pc', '用户自行使用软件挂机', 1, '2022-05-19 12:30:03', 2, 10),
(4, '支付宝通用版', 'alipay', 'alipay_allmg', '通用免挂通道，独家接口', 1, '2022-05-19 12:31:07', 3, 10),
(5, '微信店员版', 'wxpay', 'wxpay_dy', '微信店员免挂模式', 1, '2022-05-23 01:51:43', 4, 10),
(6, 'IMAC免输入', 'wxpay', 'wxpay_cloud', '微信云端免输入金额', 1, '2022-05-23 01:52:25', 5, 10),
(7, '微信赞赏码', 'wxpay', 'wxpay_cloudzs', '赞赏码通道', 1, '2022-05-26 06:38:48', 6, 10),
(8, '微信收款单', 'wxpay', 'wxpay_skd', '微信收款单通道', 1, '2022-05-26 06:39:14', 7, 10),
(9, 'QQ免挂-本地版', 'qqpay', 'qqpay_mg', 'QQ本地免挂通道', 1, '2022-05-31 06:52:39', 8, 10),
(10, 'QQ免挂-软件版', 'qqpay', 'qqpay_cloud', 'MYQQ软件挂机', 1, '2022-05-31 06:53:23', 9, 10),
(11, '微信个人自挂', 'wxpay', 'wxpay_zg', '鲲鹏框架用户自挂', 1, '2022-06-03 02:52:46', 10, 10),
(12, '微信APP挂机', 'wxpay', 'wxpay_app', '微信APP软件挂机', 1, '2022-06-15 12:31:24', 11, 10),
(13, '支付宝APP挂机', 'alipay', 'alipay_app', '支付宝APP挂机', 1, '2022-06-15 12:31:54', 12, 10),
(14, '支付宝当面付', 'alipay', 'alipay_dmf', '支付宝当面付接口', 1, '2022-07-02 09:57:03', 13, 10);

-- --------------------------------------------------------

--
-- 表的结构 `admin_config`
--

DROP TABLE IF EXISTS `admin_config`;
CREATE TABLE IF NOT EXISTS `admin_config` (
  `id` int(11) NOT NULL,
  `config_name` varchar(191) NOT NULL,
  `config_value` longtext
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `admin_config`
--

INSERT INTO `admin_config` (`id`, `config_name`, `config_value`) VALUES
(1, 'sitename', 'YPAY'),
(2, 'title', '一个专业的系统平台开发商,值得一试'),
(3, 'key', 'YPay,源支付,源分享'),
(4, 'desc', '一个专业的系统平台开发商,值得一试'),
(5, 'icp', '粤ICP备88888888号'),
(6, 'is_weboff', '1'),
(8, 'logo', '/upload/images/20220825/cdacdbbf182b79cf9303bf4767273094.png'),
(9, 'diy_js', ''),
(10, 'smtp-host', ''),
(11, 'SmtpSecure', '1'),
(12, 'smtp-port', ''),
(13, 'smtp-user', ''),
(14, 'smtp-pass', ''),
(15, 'smstype', '1'),
(16, 'alisms-accessKeyId', ''),
(17, 'alisms-Secret', ''),
(18, 'alisms-SignName', ''),
(19, 'alisms-LoginCodeId', ''),
(20, 'alisms-RegCodeId', ''),
(21, 'tensms-accessKeyId', ''),
(22, 'tensms-Secret', ''),
(23, 'tensms-SignName', ''),
(24, 'tensms-AppId', ''),
(25, 'tensms-LoginCodeId', ''),
(26, 'tensms-RegCodeId', ''),
(27, 'smsbao-user', ''),
(28, 'smsbao-pass', ''),
(29, 'smsbao-SignName', ''),
(30, 'file-type', '1'),
(31, 'file-endpoint', ''),
(32, 'file-OssName', ''),
(33, 'file-accessKeyId', ''),
(34, 'file-accessKeySecret', ''),
(35, 'qiniu-Domain', ''),
(36, 'qiniu-Bucket', ''),
(37, 'qiniu-AK', ''),
(38, 'qiniu-SK', ''),
(39, 'min_orderprice', '0'),
(40, 'max_orderprice', '1000'),
(41, 'shield_key', '百度云|摆渡|云盘|点券|芸盘|萝莉|罗莉|网盘|黑号|q币|Q币|扣币|qq货币|QQ货币|花呗|baidu云|bd云|吃鸡|透视|自瞄|后座|穿墙|脚本|外挂|辅助|检测|武器|套装'),
(42, 'shield_tips', '温馨提醒该商品禁止出售，如有疑问请联系网站客服！'),
(43, 'wechat_epay_url', ''),
(44, 'wechat_epay_id', ''),
(45, 'wechat_epay_key', ''),
(46, 'diy_clerkqr', ''),
(47, 'cloudkey', ''),
(48, 'myqqurl', ''),
(49, 'myqqtoken', ''),
(50, 'clerk_key', ''),
(51, 'clerk_id', ''),
(52, 'diy_task_key', ''),
(53, 'bgtype', '0'),
(54, 'bg', ''),
(55, 'api_bg', ''),
(56, 'reg_give_price', '10'),
(57, 'logincode-type', '0'),
(58, 'regcode-type', '0'),
(59, 'user_agreement', '#'),
(60, 'privacy', '#'),
(61, 'openlogin_type', '0'),
(62, 'juhe_url', ''),
(63, 'juhe_id', ''),
(64, 'juhe_key', ''),
(65, 'qq_appid', ''),
(66, 'qq_appkey', ''),
(67, 'is_reg_give_price', '0'),
(68, 'epayurl_demo', ''),
(69, 'epayid_demo', ''),
(70, 'epaykey_demo', ''),
(71, 'demopay_money', '1'),
(72, 'demopay_name', '一个奥利奥'),
(73, 'ali_epay_url', ''),
(74, 'ali_epay_id', ''),
(75, 'ali_epay_key', ''),
(76, 'dmf_appid', ''),
(77, 'dmf_openid', ''),
(78, 'dmf_key', ''),
(79, 'captcha-type', '0'),
(80, 'tencent_CaptchaAppId', ''),
(81, 'tencent_CaptchaKey', ''),
(82, 'geetest_CaptchaAppId', ''),
(83, 'geetest_CaptchaKey', ''),
(84, 'is_aff', '0'),
(85, 'aff_percentage', '0.1'),
(86, 'pay_api', ''),
(87, 'aff_type', '0'),
(88, 'smsbao-api', ''),
(89, 'email_switch', '0'),
(90, 'code_switch', '0'),
(91, 'is_reg', '1'),
(92, 'is_notice', '1'),
(93, 'sh_notice', ''),
(94, 'td_notice', ''),
(95, 'index_popup', ''),
(96, 'reg_popup', ''),
(97, 'front_wechat_pay', 'close'),
(98, 'front_ali_pay', 'close'),
(99, 'vcloudurl', ''),
(100, 'region_type', '0'),
(101, 'vcloudname', '默认登录模式'),
(102, 'paid_reg', '0'),
(103, 'paid_reg_price', '0.1'),
(104, 'is_reg_give_vip', '0'),
(105, 'reg_give_vip', '1'),
(106, 'min_recharge', '0'),
(107, 'max_recharge', '1000'),
(108, 'is_admin_captcha', '1'),
(109, 'retrieve-type', '0');

-- --------------------------------------------------------

--
-- 表的结构 `admin_front_log`
--

DROP TABLE IF EXISTS `admin_front_log`;
CREATE TABLE IF NOT EXISTS `admin_front_log` (
  `id` int(11) unsigned NOT NULL COMMENT 'ID',
  `uid` int(11) DEFAULT NULL COMMENT '商户ID',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '操作页面',
  `desc` text COMMENT '日志内容',
  `ip` varchar(20) NOT NULL DEFAULT '' COMMENT '操作IP',
  `user_agent` text NOT NULL COMMENT 'User-Agent',
  `create_time` timestamp NULL DEFAULT NULL COMMENT '创建时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='管理员日志';

-- --------------------------------------------------------

--
-- 表的结构 `admin_permission`
--

DROP TABLE IF EXISTS `admin_permission`;
CREATE TABLE IF NOT EXISTS `admin_permission` (
  `id` int(11) unsigned NOT NULL COMMENT 'ID',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '父级ID',
  `title` varchar(50) DEFAULT NULL COMMENT '名称',
  `href` varchar(50) NOT NULL COMMENT '地址',
  `icon` varchar(50) DEFAULT NULL COMMENT '图标',
  `sort` tinyint(4) NOT NULL DEFAULT '99' COMMENT '排序',
  `type` tinyint(1) DEFAULT '1' COMMENT '菜单',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态'
) ENGINE=InnoDB AUTO_INCREMENT=125 DEFAULT CHARSET=utf8 COMMENT='权限表';

--
-- 转存表中的数据 `admin_permission`
--

INSERT INTO `admin_permission` (`id`, `pid`, `title`, `href`, `icon`, `sort`, `type`, `status`) VALUES
(1, 0, '后台权限', '', 'layui-icon layui-icon layui-icon-username', 4, 0, 1),
(2, 1, '管理员', '/admin.admin/index', '', 1, 1, 1),
(3, 2, '新增管理员', '/admin.admin/add', '', 1, 1, 1),
(4, 2, '编辑管理员', '/admin.admin/edit', '', 1, 1, 1),
(5, 2, '修改管理员状态', '/admin.admin/status', '', 1, 1, 1),
(6, 2, '删除管理员', '/admin.admin/remove', '', 1, 1, 1),
(7, 2, '批量删除管理员', '/admin.admin/batchRemove', '', 1, 1, 1),
(8, 2, '管理员分配角色', '/admin.admin/role', '', 1, 1, 1),
(9, 2, '管理员分配直接权限', '/admin.admin/permission', '', 1, 1, 1),
(10, 2, '管理员回收站', '/admin.admin/recycle', '', 1, 1, 1),
(11, 1, '角色管理', '/admin.role/index', '', 99, 1, 1),
(12, 11, '新增角色', '/admin.role/add', '', 99, 1, 1),
(13, 11, '编辑角色', '/admin.role/edit', '', 99, 1, 1),
(14, 11, '删除角色', '/admin.role/remove', '', 99, 1, 1),
(15, 11, '角色分配权限', '/admin.role/permission', '', 99, 1, 1),
(16, 11, '角色回收站', '/admin.role/recycle', '', 99, 1, 1),
(17, 1, '菜单权限', '/admin.permission/index', '', 99, 1, 1),
(18, 17, '新增菜单', '/admin.permission/add', '', 99, 1, 1),
(19, 17, '编辑菜单', '/admin.permission/edit', '', 99, 1, 1),
(20, 17, '修改菜单状态', '/admin.permission/status', '', 99, 1, 1),
(21, 17, '删除菜单', '/admin.permission/remove', '', 99, 1, 1),
(22, 0, '系统管理', '', 'layui-icon layui-icon-set', 3, 0, 1),
(23, 22, '后台日志', '/admin.admin/log', '', 2, 1, 1),
(24, 23, '清空管理员日志', '/admin.admin/removeLog', '', 1, 1, 1),
(25, 22, '系统设置', '/config/index', '', 1, 1, 1),
(26, 22, '图片管理', '/admin.photo/index', '', 2, 1, 1),
(27, 26, '新增图片文件夹', '/admin.photo/add', '', 2, 1, 1),
(28, 26, '删除图片文件夹', '/admin.photo/del', '', 2, 1, 1),
(29, 26, '图片列表', '/admin.photo/list', '', 2, 1, 1),
(30, 26, '添加单图', '/admin.photo/addPhoto', '', 2, 1, 1),
(31, 26, '添加多图', '/admin.photo/addPhotos', '', 2, 1, 1),
(32, 26, '删除图片', '/admin.photo/remove', '', 2, 1, 1),
(33, 26, '批量删除图片', '/admin.photo/batchRemove', '', 2, 1, 1),
(34, 0, '通道管理', '', 'layui-icon layui-icon layui-icon-app', 10, 0, 1),
(36, 35, '新增通道列表', '/admin.channel/add', NULL, 99, 1, 1),
(37, 35, '修改通道列表', '/admin.channel/edit', NULL, 99, 1, 1),
(38, 35, '删除通道列表', '/admin.channel/remove', NULL, 99, 1, 1),
(39, 35, '批量删除通道列表', '/admin.channel/batchRemove', NULL, 99, 1, 1),
(40, 35, '回收站通道列表', '/admin.channel/recycle', NULL, 99, 1, 1),
(41, 34, '通道列表', '/admin.channel/index', 'layui-icon layui-icon layui-icon-fire', 97, 1, 1),
(42, 41, '新增通道列表', '/admin.channel/add', NULL, 99, 1, 1),
(43, 41, '修改通道列表', '/admin.channel/edit', NULL, 99, 1, 1),
(44, 41, '删除通道列表', '/admin.channel/remove', NULL, 99, 1, 1),
(45, 41, '批量删除通道列表', '/admin.channel/batchRemove', NULL, 99, 1, 1),
(46, 41, '回收站通道列表', '/admin.channel/recycle', NULL, 99, 1, 1),
(47, 34, '地域代理', '/ypay.proxy/index', 'layui-icon layui-icon-fire', 99, 1, 1),
(48, 47, '新增地域代理', '/ypay.proxy/add', NULL, 99, 1, 1),
(49, 47, '修改地域代理', '/ypay.proxy/edit', NULL, 99, 1, 1),
(50, 47, '删除地域代理', '/ypay.proxy/remove', NULL, 99, 1, 1),
(51, 47, '批量删除地域代理', '/ypay.proxy/batchRemove', NULL, 99, 1, 1),
(52, 47, '回收站地域代理', '/ypay.proxy/recycle', NULL, 99, 1, 1),
(53, 0, '会员管理', '', 'layui-icon layui-icon-username', 10, 0, 1),
(54, 53, '余额日志', '/money.log/index', 'layui-icon layui-icon-fire', 99, 1, 1),
(55, 54, '新增余额日志', '/money.log/add', NULL, 99, 1, 1),
(56, 54, '修改余额日志', '/money.log/edit', NULL, 99, 1, 1),
(57, 54, '删除余额日志', '/money.log/remove', NULL, 99, 1, 1),
(58, 54, '批量删除余额日志', '/money.log/batchRemove', NULL, 99, 1, 1),
(59, 54, '回收站余额日志', '/money.log/recycle', NULL, 99, 1, 1),
(60, 53, '会员列表', '/ypay.user/index', 'layui-icon layui-icon layui-icon-fire', 98, 1, 1),
(61, 60, '新增会员列表', '/ypay.user/add', NULL, 99, 1, 1),
(62, 60, '修改会员列表', '/ypay.user/edit', NULL, 99, 1, 1),
(63, 60, '删除会员列表', '/ypay.user/remove', NULL, 99, 1, 1),
(64, 60, '批量删除会员列表', '/ypay.user/batchRemove', NULL, 99, 1, 1),
(65, 60, '回收站会员列表', '/ypay.user/recycle', NULL, 99, 1, 1),
(66, 53, '会员套餐', '/ypay.vip/index', 'layui-icon layui-icon-fire', 99, 1, 1),
(67, 66, '新增会员套餐', '/ypay.vip/add', NULL, 99, 1, 1),
(68, 66, '修改会员套餐', '/ypay.vip/edit', NULL, 99, 1, 1),
(69, 66, '删除会员套餐', '/ypay.vip/remove', NULL, 99, 1, 1),
(70, 66, '批量删除会员套餐', '/ypay.vip/batchRemove', NULL, 99, 1, 1),
(71, 66, '回收站会员套餐', '/ypay.vip/recycle', NULL, 99, 1, 1),
(72, 34, '账号管理', '/ypay.account/index', 'layui-icon layui-icon layui-icon-fire', 98, 1, 1),
(73, 72, '新增账号管理', '/ypay.account/add', NULL, 99, 1, 2),
(74, 72, '修改账号管理', '/ypay.account/edit', NULL, 99, 1, 1),
(75, 72, '删除账号管理', '/ypay.account/remove', NULL, 99, 1, 1),
(76, 72, '批量删除账号管理', '/ypay.account/batchRemove', NULL, 99, 1, 1),
(77, 72, '回收站账号管理', '/ypay.account/recycle', NULL, 99, 1, 2),
(78, 0, '商城管理', '', 'layui-icon layui-icon-rmb', 10, 0, 1),
(79, 78, '订单记录', '/ypay.order/index', 'layui-icon layui-icon-fire', 99, 1, 1),
(80, 79, '新增订单记录', '/ypay.order/add', NULL, 99, 1, 1),
(81, 79, '修改订单记录', '/ypay.order/edit', NULL, 99, 1, 1),
(82, 79, '删除订单记录', '/ypay.order/remove', NULL, 99, 1, 1),
(83, 79, '批量删除订单记录', '/ypay.order/batchRemove', NULL, 99, 1, 1),
(84, 79, '回收站订单记录', '/ypay.order/recycle', NULL, 99, 1, 2),
(85, 78, '充值记录', '/ypay.recharge/index', 'layui-icon layui-icon-fire', 99, 1, 1),
(86, 85, '新增充值记录', '/ypay.recharge/add', NULL, 99, 1, 1),
(87, 85, '修改充值记录', '/ypay.recharge/edit', NULL, 99, 1, 1),
(88, 85, '删除充值记录', '/ypay.recharge/remove', NULL, 99, 1, 1),
(89, 85, '批量删除充值记录', '/ypay.recharge/batchRemove', NULL, 99, 1, 1),
(90, 85, '回收站充值记录', '/ypay.recharge/recycle', NULL, 99, 1, 1),
(91, 0, '安全管理', '', 'layui-icon layui-icon-diamond', 10, 0, 1),
(92, 91, '风控记录', '/ypay.risk/index', 'layui-icon layui-icon-fire', 99, 1, 1),
(93, 92, '新增风控记录', '/ypay.risk/add', NULL, 99, 1, 1),
(94, 92, '修改风控记录', '/ypay.risk/edit', NULL, 99, 1, 1),
(95, 92, '删除风控记录', '/ypay.risk/remove', NULL, 99, 1, 1),
(96, 92, '批量删除风控记录', '/ypay.risk/batchRemove', NULL, 99, 1, 1),
(97, 92, '回收站风控记录', '/ypay.risk/recycle', NULL, 99, 1, 1),
(98, 0, '下载管理', '', 'layui-icon layui-icon-download-circle', 10, 0, 1),
(99, 98, '插件下载', '/ypay.plug/index', 'layui-icon layui-icon-fire', 99, 1, 1),
(100, 99, '新增插件下载', '/ypay.plug/add', NULL, 99, 1, 1),
(101, 99, '修改插件下载', '/ypay.plug/edit', NULL, 99, 1, 1),
(102, 99, '删除插件下载', '/ypay.plug/remove', NULL, 99, 1, 1),
(103, 99, '批量删除插件下载', '/ypay.plug/batchRemove', NULL, 99, 1, 1),
(104, 99, '回收站插件下载', '/ypay.plug/recycle', NULL, 99, 1, 1),
(105, 22, '导航管理', '/ypay.navs/index', 'layui-icon layui-icon-fire', 99, 1, 1),
(106, 105, '新增导航管理', '/ypay.navs/add', NULL, 99, 1, 1),
(107, 105, '修改导航管理', '/ypay.navs/edit', NULL, 99, 1, 1),
(108, 105, '删除导航管理', '/ypay.navs/remove', NULL, 99, 1, 1),
(109, 105, '批量删除导航管理', '/ypay.navs/batchRemove', NULL, 99, 1, 1),
(110, 105, '回收站导航管理', '/ypay.navs/recycle', NULL, 99, 1, 1),
(111, 22, '公告管理', '/ypay.news/index', 'layui-icon layui-icon-fire', 99, 1, 1),
(112, 111, '新增公告管理', '/ypay.news/add', NULL, 99, 1, 1),
(113, 111, '修改公告管理', '/ypay.news/edit', NULL, 99, 1, 1),
(114, 111, '删除公告管理', '/ypay.news/remove', NULL, 99, 1, 1),
(115, 111, '批量删除公告管理', '/ypay.news/batchRemove', NULL, 99, 1, 1),
(116, 111, '回收站公告管理', '/ypay.news/recycle', NULL, 99, 1, 1),
(117, 0, '控制端', '/index', 'layui-icon layui-icon layui-icon layui-icon-home', 1, 1, 1),
(118, 0, '在线更新', '/update', 'layui-icon layui-icon-auz', 10, 1, 1),
(119, 53, '登录日志', '/admin.front_log/index', 'layui-icon layui-icon-fire', 99, 1, 1),
(120, 119, '新增登录日志', '/admin.front_log/add', NULL, 99, 1, 1),
(121, 119, '修改登录日志', '/admin.front_log/edit', NULL, 99, 1, 1),
(122, 119, '删除登录日志', '/admin.front_log/remove', NULL, 99, 1, 1),
(123, 119, '批量删除登录日志', '/admin.front_log/batchRemove', NULL, 99, 1, 1),
(124, 119, '回收站登录日志', '/admin.front_log/recycle', NULL, 99, 1, 1),
(126, 34, '云端地域', '/ypay.cloud/index', 'layui-icon layui-icon-fire', 99, 1, 1),
(127, 126, '新增云端地域', '/ypay.cloud/add', NULL, 99, 1, 1),
(128, 126, '修改云端地域', '/ypay.cloud/edit', NULL, 99, 1, 1),
(129, 126, '删除云端地域', '/ypay.cloud/remove', NULL, 99, 1, 1),
(130, 126, '批量删除云端地域', '/ypay.cloud/batchRemove', NULL, 99, 1, 1),
(132, 53, '付费注册', '/ypay.regorder/index', 'layui-icon layui-icon layui-icon-fire', 99, 1, 1),
(133, 132, '新增付费注册', '/ypay.regorder/add', NULL, 99, 1, 1),
(134, 132, '修改付费注册', '/ypay.regorder/edit', NULL, 99, 1, 1),
(135, 132, '删除付费注册', '/ypay.regorder/remove', NULL, 99, 1, 1),
(136, 132, '批量删除付费注册', '/ypay.regorder/batchRemove', NULL, 99, 1, 1),
(137, 132, '回收站付费注册', '/ypay.regorder/recycle', NULL, 99, 1, 1),
(138, 78, '商城总览', '/ypay.shop/index', 'layui-inline layui-iconpicker-title', 98, 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `admin_photo`
--

DROP TABLE IF EXISTS `admin_photo`;
CREATE TABLE IF NOT EXISTS `admin_photo` (
  `id` int(11) unsigned NOT NULL COMMENT 'ID',
  `name` varchar(50) NOT NULL COMMENT '文件名称',
  `href` varchar(255) DEFAULT NULL COMMENT '文件路径',
  `path` varchar(30) DEFAULT NULL COMMENT '路径',
  `mime` varchar(50) NOT NULL COMMENT 'mime类型',
  `size` varchar(30) NOT NULL COMMENT '大小',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1本地2阿里云3七牛云',
  `ext` varchar(10) DEFAULT NULL COMMENT '文件后缀',
  `create_time` timestamp NULL DEFAULT NULL COMMENT '创建时间'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='图片表';

--
-- 转存表中的数据 `admin_photo`
--

INSERT INTO `admin_photo` (`id`, `name`, `href`, `path`, `mime`, `size`, `type`, `ext`, `create_time`) VALUES
(1, '1613564243-bf130567ccd7e68.png', '/upload/images/20220825/cdacdbbf182b79cf9303bf4767273094.png', 'images', 'image/png', '54518', 1, 'png', '2022-08-25 01:55:22');

-- --------------------------------------------------------

--
-- 表的结构 `admin_role`
--

DROP TABLE IF EXISTS `admin_role`;
CREATE TABLE IF NOT EXISTS `admin_role` (
  `id` int(11) unsigned NOT NULL COMMENT 'ID',
  `name` varchar(30) DEFAULT NULL COMMENT '名称',
  `desc` varchar(100) DEFAULT NULL COMMENT '描述',
  `create_time` timestamp NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` timestamp NULL DEFAULT NULL COMMENT '更新时间',
  `delete_time` timestamp NULL DEFAULT NULL COMMENT '删除时间'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='角色表';

--
-- 转存表中的数据 `admin_role`
--

INSERT INTO `admin_role` (`id`, `name`, `desc`, `create_time`, `update_time`, `delete_time`) VALUES
(1, '超级管理员', '拥有所有管理权限', '2020-08-31 19:01:34', '2020-08-31 19:01:34', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `admin_role_permission`
--

DROP TABLE IF EXISTS `admin_role_permission`;
CREATE TABLE IF NOT EXISTS `admin_role_permission` (
  `id` int(11) unsigned NOT NULL COMMENT 'ID',
  `role_id` int(11) DEFAULT NULL COMMENT '角色ID',
  `permission_id` int(11) DEFAULT NULL COMMENT '权限ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='角色-权限中间表';

-- --------------------------------------------------------

--
-- 表的结构 `money_log`
--

DROP TABLE IF EXISTS `money_log`;
CREATE TABLE IF NOT EXISTS `money_log` (
  `id` int(11) unsigned NOT NULL COMMENT 'id',
  `user_id` int(11) DEFAULT NULL COMMENT '会员ID',
  `money` decimal(10,3) DEFAULT NULL COMMENT '变更金额',
  `beforemoney` decimal(10,3) DEFAULT NULL COMMENT '变更前金额',
  `after` decimal(10,3) DEFAULT NULL COMMENT '变更后金额',
  `create_time` timestamp NULL DEFAULT NULL COMMENT '创建时间',
  `memo` varchar(50) DEFAULT NULL COMMENT '备注'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='余额日志';

-- --------------------------------------------------------

--
-- 表的结构 `ypay_account`
--

DROP TABLE IF EXISTS `ypay_account`;
CREATE TABLE IF NOT EXISTS `ypay_account` (
  `id` int(11) unsigned NOT NULL COMMENT 'ID',
  `code` varchar(50) DEFAULT NULL COMMENT '通道标识',
  `type` varchar(50) DEFAULT NULL COMMENT '通道类型',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '会员ID',
  `qr_url` varchar(2500) DEFAULT NULL COMMENT '二维码地址',
  `wxname` varchar(50) DEFAULT NULL COMMENT '微信昵称',
  `zfb_pid` varchar(50) DEFAULT NULL COMMENT '支付宝PID',
  `wx_guid` varchar(50) DEFAULT NULL COMMENT '微信GUID',
  `vcloudurl` varchar(50) DEFAULT NULL COMMENT '云端地址',
  `qq` varchar(50) DEFAULT NULL COMMENT 'QQ',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '状态',
  `is_status` int(11) NOT NULL DEFAULT '1' COMMENT '是否启用',
  `create_time` timestamp NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` timestamp NULL DEFAULT NULL COMMENT '更新时间',
  `succcount` int(11) NOT NULL DEFAULT '0' COMMENT '收款笔数',
  `succprice` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '收款金额',
  `memo` varchar(50) DEFAULT NULL COMMENT '备注',
  `endtime` int(11) DEFAULT NULL COMMENT '结束时间戳',
  `cookie` text COMMENT 'CK信息',
  `tong_time` int(11) DEFAULT NULL COMMENT '通用通道时间戳',
  `allmaxcount` int(11) NOT NULL DEFAULT '0' COMMENT '上限笔数',
  `allmaxmoney` varchar(50) DEFAULT NULL COMMENT '上限金额',
  `daymaxcount` int(11) NOT NULL DEFAULT '0' COMMENT '日上限笔数',
  `daymaxmoney` varchar(50) DEFAULT NULL COMMENT '日上限金额',
  `remark` varchar(225) DEFAULT NULL COMMENT '备用字段',
  `money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '支付宝余额'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='账号管理';

-- --------------------------------------------------------

--
-- 表的结构 `ypay_cloud`
--
DROP TABLE IF EXISTS `ypay_cloud`;
CREATE TABLE IF NOT EXISTS `ypay_cloud` (
  `id` int(11) NOT NULL COMMENT 'id',
  `name` varchar(255) DEFAULT NULL COMMENT '云端名称',
  `address` varchar(255) DEFAULT NULL COMMENT '云端地址',
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '云端状态',
  `sort` int(25) NOT NULL DEFAULT '0' COMMENT '云端排序'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 表的结构 `ypay_navs`
--

DROP TABLE IF EXISTS `ypay_navs`;
CREATE TABLE IF NOT EXISTS `ypay_navs` (
  `id` int(11) unsigned NOT NULL COMMENT 'id',
  `name` varchar(50) DEFAULT NULL COMMENT '导航名称',
  `url` text COMMENT '导航地址',
  `is_target` int(11) NOT NULL DEFAULT '0' COMMENT '是否跳转',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '状态',
  `create_time` timestamp NULL DEFAULT NULL COMMENT '创建时间',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='导航管理';

--
-- 转存表中的数据 `ypay_navs`
--

INSERT INTO `ypay_navs` (`id`, `name`, `url`, `is_target`, `status`, `create_time`, `sort`) VALUES
(1, '首页', '/', 0, 1, '2022-06-10 06:52:12', 1),
(2, '开发文档', '/doc', 0, 1, '2022-06-10 06:52:58', 2),
(3, '支付测试', '/demo', 0, 1, '2022-06-10 06:53:29', 3),
(4, '公告中心', '/News/Index', 0, 1, '2022-06-10 06:53:53', 4);

-- --------------------------------------------------------

--
-- 表的结构 `ypay_news`
--

DROP TABLE IF EXISTS `ypay_news`;
CREATE TABLE IF NOT EXISTS `ypay_news` (
  `id` int(11) unsigned NOT NULL COMMENT 'id',
  `type` int(11) NOT NULL DEFAULT '1' COMMENT '公告类型',
  `title` varchar(2500) DEFAULT NULL COMMENT '公告标题',
  `color` varchar(50) DEFAULT NULL COMMENT '标题颜色',
  `content` text COMMENT '公告内容',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '状态',
  `create_time` timestamp NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` timestamp NULL DEFAULT NULL COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='公告管理';

-- --------------------------------------------------------

--
-- 表的结构 `ypay_order`
--

DROP TABLE IF EXISTS `ypay_order`;
CREATE TABLE IF NOT EXISTS `ypay_order` (
  `id` int(11) unsigned NOT NULL COMMENT 'ID',
  `name` varchar(225) DEFAULT NULL COMMENT '商品名称',
  `sitename` varchar(50) DEFAULT NULL COMMENT '网站名称',
  `type` varchar(50) DEFAULT NULL COMMENT '支付类型',
  `account_id` int(11) DEFAULT NULL COMMENT '账号ID',
  `trade_no` varchar(50) DEFAULT NULL COMMENT '商户单号',
  `out_trade_no` varchar(50) DEFAULT NULL COMMENT '本地单号',
  `notify_url` text COMMENT '异步通知地址',
  `return_url` text COMMENT '同步地址',
  `user_id` int(11) DEFAULT NULL COMMENT '会员ID',
  `money` decimal(10,2) DEFAULT NULL COMMENT '金额',
  `truemoney` decimal(10,2) DEFAULT NULL COMMENT '实付金额',
  `feilvmoney` decimal(10,3) DEFAULT NULL COMMENT '费率金额',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '状态',
  `ip` varchar(50) DEFAULT NULL COMMENT 'IP地址',
  `end_time` timestamp NULL DEFAULT NULL COMMENT '支付时间',
  `out_time` int(11) DEFAULT NULL COMMENT '有效时间',
  `qrcode` text COMMENT '二维码信息',
  `h5_qrurl` text COMMENT 'H5链接',
  `create_time` timestamp NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` timestamp NULL DEFAULT NULL COMMENT '更新时间',
  `api_memo` text,
  `pla_type` int(11) NOT NULL DEFAULT '1',
  `is_order_tips` int(1) DEFAULT '0' COMMENT '是否邮箱通知过'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单记录';

-- --------------------------------------------------------

--
-- 表的结构 `ypay_plug`
--

DROP TABLE IF EXISTS `ypay_plug`;
CREATE TABLE IF NOT EXISTS `ypay_plug` (
  `id` int(11) unsigned NOT NULL COMMENT 'id',
  `name` varchar(50) DEFAULT NULL COMMENT '插件名称',
  `downurl` text COMMENT '下载地址',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '显示状态',
  `create_time` timestamp NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` timestamp NULL DEFAULT NULL COMMENT '更新时间',
  `delete_time` timestamp NULL DEFAULT NULL COMMENT '删除时间'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='插件下载';


-- --------------------------------------------------------

--
-- 表的结构 `ypay_proxy`
--

DROP TABLE IF EXISTS `ypay_proxy`;
CREATE TABLE IF NOT EXISTS `ypay_proxy` (
  `id` int(11) unsigned NOT NULL COMMENT 'id',
  `name` varchar(50) DEFAULT NULL COMMENT '地域名称',
  `sort` int(25) DEFAULT '0' COMMENT '排序',
  `address` varchar(225) DEFAULT NULL COMMENT 'IP地址',
  `prot` varchar(50) DEFAULT NULL COMMENT '端口',
  `user` varchar(50) DEFAULT NULL COMMENT '账号',
  `pass` varchar(50) DEFAULT NULL COMMENT '密码',
  `status` int(11) DEFAULT '1' COMMENT '状态',
  `create_time` timestamp NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` timestamp NULL DEFAULT NULL COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='地域代理';

-- --------------------------------------------------------

--
-- 表的结构 `ypay_recharge`
--

DROP TABLE IF EXISTS `ypay_recharge`;
CREATE TABLE IF NOT EXISTS `ypay_recharge` (
  `id` int(11) unsigned NOT NULL COMMENT 'ID',
  `type` varchar(50) DEFAULT NULL COMMENT '支付类型',
  `trade_no` varchar(225) DEFAULT NULL COMMENT '商户订单',
  `out_trade_no` varchar(225) DEFAULT NULL COMMENT '本地订单',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '会员ID',
  `money` decimal(10,2) DEFAULT '0.00' COMMENT '订单金额',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '订单状态',
  `create_time` timestamp NULL DEFAULT NULL COMMENT '创建时间',
  `end_time` timestamp NULL DEFAULT NULL COMMENT '支付时间',
  `update_time` timestamp NULL DEFAULT NULL COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='充值记录';

-- --------------------------------------------------------

--
-- 表的结构 `ypay_regorder`
--
DROP TABLE IF EXISTS `ypay_regorder`;
CREATE TABLE IF NOT EXISTS `ypay_regorder` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `out_trade_no` varchar(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `create_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `regdata` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- 表的结构 `ypay_risk`
--

DROP TABLE IF EXISTS `ypay_risk`;
CREATE TABLE IF NOT EXISTS `ypay_risk` (
  `id` int(11) unsigned NOT NULL COMMENT 'id',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '会员ID',
  `name` varchar(225) DEFAULT NULL COMMENT '商品名称',
  `url` varchar(2500) DEFAULT NULL COMMENT '来源地址',
  `create_time` timestamp NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` timestamp NULL DEFAULT NULL COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='风控记录';

-- --------------------------------------------------------

--
-- 表的结构 `ypay_user`
--

DROP TABLE IF EXISTS `ypay_user`;
CREATE TABLE IF NOT EXISTS `ypay_user` (
  `id` int(11) unsigned NOT NULL COMMENT '会员ID',
  `nickname` varchar(50) DEFAULT NULL COMMENT '会员昵称',
  `username` varchar(50) DEFAULT NULL COMMENT '会员账号',
  `password` varchar(50) DEFAULT NULL COMMENT '会员密码',
  `superior_id` int(11) DEFAULT NULL COMMENT '上级id',
  `salt` varchar(50) DEFAULT NULL COMMENT '密码盐',
  `email` varchar(50) DEFAULT NULL COMMENT '邮箱',
  `mobile` varchar(50) DEFAULT NULL COMMENT '手机号',
  `money` decimal(10,3) DEFAULT '0.000' COMMENT '余额',
  `user_key` varchar(50) DEFAULT NULL COMMENT '密钥信息',
  `vip_id` int(15) DEFAULT NULL COMMENT 'VIP套餐ID',
  `vip_time` datetime DEFAULT NULL COMMENT '套餐时间',
  `feilv` varchar(50) DEFAULT NULL COMMENT '费率',
  `timeout_url` varchar(225) DEFAULT '/' COMMENT '超时跳转地址',
  `timeout_time` varchar(50) NOT NULL DEFAULT '180' COMMENT '超时时间',
  `is_bindqq` int(11) NOT NULL DEFAULT '0' COMMENT '是否绑定QQ',
  `qq_sid` varchar(225) DEFAULT NULL COMMENT 'OpenID',
  `is_bindwx` int(11) NOT NULL DEFAULT '0' COMMENT '是否绑定微信',
  `wx_sid` varchar(225) DEFAULT NULL COMMENT 'VXOpenID',
  `loginfailure` int(11) NOT NULL DEFAULT '0' COMMENT '登录失败次数',
  `console_notity` varchar(225) DEFAULT NULL COMMENT '收银提示',
  `console_temp` varchar(50) DEFAULT 'console' COMMENT '收银模板',
  `create_time` timestamp NULL DEFAULT NULL COMMENT '创建时间',
  `token` varchar(225) DEFAULT NULL COMMENT 'Token',
  `yuyin_tips` int(11) NOT NULL DEFAULT '0' COMMENT '语音提醒',
  `login_email_tips` int(11) NOT NULL DEFAULT '0' COMMENT '登录提醒',
  `money_tips` int(11) NOT NULL DEFAULT '0' COMMENT '余额提醒',
  `appkey` varchar(50) DEFAULT NULL COMMENT 'APP通讯密钥',
  `is_frozen` int(1) NOT NULL DEFAULT '0' COMMENT '是否冻结账号',
  `remarks` varchar(255) DEFAULT NULL COMMENT '备注',
  `googlekey` varchar(50) DEFAULT NULL,
  `order_tips` int(1) NOT NULL DEFAULT '0' COMMENT '邮件订单消息提醒',
  `lose_tips` int(1) NOT NULL DEFAULT '0' COMMENT '掉线提示',
  `is_payPopUp` int(1) NOT NULL DEFAULT '0' COMMENT '付款弹窗开关',
  `switch_type` varchar(255) DEFAULT 'close' COMMENT '转接类型',
  `switch_url` varchar(255) DEFAULT NULL COMMENT '转接地址',
  `switch_id` varchar(255) DEFAULT NULL COMMENT '转接ID',
  `switch_key` varchar(255) DEFAULT NULL COMMENT '转接Key'
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='会员列表';

-- --------------------------------------------------------

--
-- 表的结构 `ypay_vip`
--

DROP TABLE IF EXISTS `ypay_vip`;
CREATE TABLE IF NOT EXISTS `ypay_vip` (
  `id` int(11) unsigned NOT NULL COMMENT 'id',
  `name` varchar(50) DEFAULT NULL COMMENT '套餐名称',
  `feilv` varchar(50) DEFAULT NULL COMMENT '套餐费率',
  `money` decimal(10,2) DEFAULT NULL COMMENT '套餐金额',
  `viptime` int(11) NOT NULL DEFAULT '0' COMMENT '套餐时间',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '状态',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `is_quota` int(1) DEFAULT '0' COMMENT '是否开启收款限额',
  `today_quota` varchar(255) NOT NULL DEFAULT '0' COMMENT '日收款限额',
  `is_passage` int(1) DEFAULT '0' COMMENT '是否开启绑定通道',
  `passage` varchar(255) DEFAULT NULL COMMENT '绑定通道标识',
  `is_premium` int(1) DEFAULT '0' COMMENT '是否开启补价升级',
  `premium_discount` int(10) DEFAULT NULL COMMENT '补价升级百分比',
  `create_time` timestamp NULL DEFAULT NULL COMMENT '创建时间'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='会员套餐';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_admin`
--
ALTER TABLE `admin_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_admin_log`
--
ALTER TABLE `admin_admin_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_admin_permission`
--
ALTER TABLE `admin_admin_permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_admin_role`
--
ALTER TABLE `admin_admin_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_channel`
--
ALTER TABLE `admin_channel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_config`
--
ALTER TABLE `admin_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_front_log`
--
ALTER TABLE `admin_front_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_permission`
--
ALTER TABLE `admin_permission`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pid` (`pid`);

--
-- Indexes for table `admin_photo`
--
ALTER TABLE `admin_photo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_role`
--
ALTER TABLE `admin_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_role_permission`
--
ALTER TABLE `admin_role_permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `money_log`
--
ALTER TABLE `money_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ypay_account`
--
ALTER TABLE `ypay_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ypay_cloud`
--
ALTER TABLE `ypay_cloud`
  ADD PRIMARY KEY (`id`);
  
--
-- Indexes for table `ypay_navs`
--
ALTER TABLE `ypay_navs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ypay_news`
--
ALTER TABLE `ypay_news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ypay_order`
--
ALTER TABLE `ypay_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ypay_plug`
--
ALTER TABLE `ypay_plug`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ypay_proxy`
--
ALTER TABLE `ypay_proxy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ypay_recharge`
--
ALTER TABLE `ypay_recharge`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ypay_regorder`
--
ALTER TABLE `ypay_regorder`
  ADD PRIMARY KEY (`id`);
--
-- Indexes for table `ypay_risk`
--
ALTER TABLE `ypay_risk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ypay_user`
--
ALTER TABLE `ypay_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ypay_vip`
--
ALTER TABLE `ypay_vip`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_admin`
--
ALTER TABLE `admin_admin`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID';
--
-- AUTO_INCREMENT for table `admin_admin_log`
--
ALTER TABLE `admin_admin_log`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID';
--
-- AUTO_INCREMENT for table `admin_admin_permission`
--
ALTER TABLE `admin_admin_permission`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID';
--
-- AUTO_INCREMENT for table `admin_admin_role`
--
ALTER TABLE `admin_admin_role`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID';
--
-- AUTO_INCREMENT for table `admin_channel`
--
ALTER TABLE `admin_channel`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `admin_config`
--
ALTER TABLE `admin_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=107;
--
-- AUTO_INCREMENT for table `admin_front_log`
--
ALTER TABLE `admin_front_log`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID';
--
-- AUTO_INCREMENT for table `admin_permission`
--
ALTER TABLE `admin_permission`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',AUTO_INCREMENT=125;
--
-- AUTO_INCREMENT for table `admin_photo`
--
ALTER TABLE `admin_photo`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `admin_role`
--
ALTER TABLE `admin_role`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `admin_role_permission`
--
ALTER TABLE `admin_role_permission`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID';
--
-- AUTO_INCREMENT for table `money_log`
--
ALTER TABLE `money_log`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id';
--
-- AUTO_INCREMENT for table `ypay_account`
--
ALTER TABLE `ypay_account`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID';
--
-- AUTO_INCREMENT for table `ypay_cloud`
--
ALTER TABLE `ypay_cloud`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id';
--
-- AUTO_INCREMENT for table `ypay_navs`
--
ALTER TABLE `ypay_navs`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',AUTO_INCREMENT=5;
  
--
-- AUTO_INCREMENT for table `ypay_news`
--
ALTER TABLE `ypay_news`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id';
--
-- AUTO_INCREMENT for table `ypay_order`
--
ALTER TABLE `ypay_order`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID';
--
-- AUTO_INCREMENT for table `ypay_plug`
--
ALTER TABLE `ypay_plug`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ypay_proxy`
--
ALTER TABLE `ypay_proxy`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id';
--
-- AUTO_INCREMENT for table `ypay_recharge`
--
ALTER TABLE `ypay_recharge`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID';
--
-- AUTO_INCREMENT for table `ypay_regorder`
--
ALTER TABLE `ypay_regorder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ypay_risk`
--
ALTER TABLE `ypay_risk`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id';
--
-- AUTO_INCREMENT for table `ypay_user`
--
ALTER TABLE `ypay_user`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '会员ID',AUTO_INCREMENT=1000;
--
-- AUTO_INCREMENT for table `ypay_vip`
--
ALTER TABLE `ypay_vip`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',AUTO_INCREMENT=4;