/*
 * Date: 2012-09-17 13:28:08
*/

-- ----------------------------
-- Records of cms_adboard
-- ----------------------------
INSERT INTO `cms_adboard` VALUES ('1', '首页焦点图', 'focus', '580', '280', '', '0');
INSERT INTO `cms_adboard` VALUES ('4', '详细页横幅', 'banner', '950', '100', '', '1');
INSERT INTO `cms_adboard` VALUES ('5', '详细页右侧', 'banner', '226', '226', '', '1');
INSERT INTO `cms_adboard` VALUES ('6', '首页下方横幅', 'banner', '960', '100', '', '1');


-- ----------------------------
-- Records of cms_ad
-- ----------------------------
INSERT INTO `cms_ad` VALUES ('6', '6', 'code', 'phonegap中文网', 'http://www.phonegap100.com', '<script type=\\\"text/javascript\\\">alimama_pid=\\\"mm_30949159_3378420_11349182\\\";alimama_width=950;alimama_height=90;</script><script src=\\\"http://a.alimama.cn/inf.js\\\" type=\\\"text/javascript\\\"></script>', '1333595088', '1365217491', '104', '1333681516', '1', '1');
INSERT INTO `cms_ad` VALUES ('7', '5', 'image', '凡客', '', '512ad36e181c5.png', '1333683143', '1365219146', '11', '1333683151', '2', '0');
INSERT INTO `cms_ad` VALUES ('9', '5', 'text', '测试', 'http://192.168.1.51/wegou_news/uc_client', '测试广告', '1360598400', '1361462400', '0', '1361773236', '0', '1');



-- ----------------------------
-- Records of cms_article_cate
-- ----------------------------
INSERT INTO `cms_article_cate` VALUES ('1', '网站信息', 'sites', '11', '1', '4', '4', '', '', '');
INSERT INTO `cms_article_cate` VALUES ('5', '新手入门', 'rumen', '11', '1', '2', '2', '', '', '');
INSERT INTO `cms_article_cate` VALUES ('9', '热门活动', 'activity', '10', '1', '6', '5', '网站在线帮助说明', '111111111111111111111', '2222222222222222');
INSERT INTO `cms_article_cate` VALUES ('10', '资讯活动', 'news', '0', '1', '2', '1', '网站资讯', '', '');
INSERT INTO `cms_article_cate` VALUES ('11', '网站帮助', 'sites', '0', '1', '0', '0', '', '', '');


-- ----------------------------
-- Records of cms_flink
-- ----------------------------
INSERT INTO `cms_flink` VALUES ('1', '1', '4f8ceab7e6f6c.jpg', 'phonegap100', 'http://www.phonegap100.com', '1', '1');


-- ----------------------------
-- Records of cms_flink_cate
-- ----------------------------
INSERT INTO `cms_flink_cate` VALUES ('1', '友情链接');
INSERT INTO `cms_flink_cate` VALUES ('2', '合作伙伴');



-- ----------------------------
-- Records of cms_group
-- ----------------------------
INSERT INTO `cms_group` VALUES ('4', 'article', '内容管理', '1222841259', '1222841259', '1', '3');
INSERT INTO `cms_group` VALUES ('1', 'system', '系统设置', '1222841259', '1222841259', '1', '6');
INSERT INTO `cms_group` VALUES ('8', 'member', '会员管理', '0', '0', '1', '4');
INSERT INTO `cms_group` VALUES ('9', 'home', '起始页', '0', '1341386748', '1', '0');
INSERT INTO `cms_group` VALUES ('27', 'seller', '商家管理', '1340586215', '0', '0', '1');


-- ----------------------------
-- Records of cms_nav
-- ----------------------------
INSERT INTO `cms_nav` VALUES ('1', '发现', 'search', '', '1', '1', '1', '1', '1', '', '', '', '0');
INSERT INTO `cms_nav` VALUES ('2', '母婴', 'album', '', '2', '1', '1', '1', '1', '', '', '', '0');
INSERT INTO `cms_nav` VALUES ('3', '搞笑', 'promo', '', '3', '1', '1', '1', '1', '', '', '', '0');
INSERT INTO `cms_nav` VALUES ('4', '返现商家', 'seller', '', '4', '1', '1', '1', '1', '', '', '', null);
INSERT INTO `cms_nav` VALUES ('5', '视频', 'exchange_goods', '', '5', '1', '1', '1', '0', '', '', '', null);
INSERT INTO `cms_nav` VALUES ('6', '杂谈', 'xiezi', '', '8', '0', '1', '1', '1', '', '', '', '2');
INSERT INTO `cms_nav` VALUES ('7', '帮助中心', 'bangzhu', 'http://bbs.phonegap100.com', '0', '0', '1', '0', '0', '', '', '', '0');

-- ----------------------------
-- Records of cms_node
-- ----------------------------
INSERT INTO `cms_node` VALUES ('1', 'Node', '菜单管理', '', '', '', '1', '', '0', '0', '1', '0', '0');
INSERT INTO `cms_node` VALUES ('2', 'Node', '菜单管理', 'index', '菜单列表', '', '1', '', '0', '1', '1', '0', '0');
INSERT INTO `cms_node` VALUES ('3', 'Node', '菜单管理', 'add', '添加菜单', '', '1', '', '0', '2', '1', '0', '0');
INSERT INTO `cms_node` VALUES ('4', 'Node', '菜单管理', 'edit', '编辑菜单', '', '1', '', '0', '2', '1', '0', '0');
INSERT INTO `cms_node` VALUES ('5', 'Node', '菜单管理', 'delete', '删除菜单', '', '1', '', '0', '2', '1', '0', '0');
INSERT INTO `cms_node` VALUES ('6', 'Role', '角色管理', '', '', '', '1', '', '370', '0', '1', '0', '0');
INSERT INTO `cms_node` VALUES ('7', 'Role', '角色管理', 'index', '角色管理', '', '1', '', '0', '1', '1', '0', '0');
INSERT INTO `cms_node` VALUES ('8', 'Role', '角色管理', 'add', '添加角色', '', '1', '', '0', '2', '1', '0', '0');
INSERT INTO `cms_node` VALUES ('9', 'Role', '角色管理', 'edit', '编辑角色', '', '1', '', '0', '2', '1', '0', '0');
INSERT INTO `cms_node` VALUES ('10', 'Role', '角色管理', 'delete', '删除角色', '', '1', '', '0', '2', '1', '0', '0');
INSERT INTO `cms_node` VALUES ('11', 'Role', '角色管理', 'auth', '角色授权', '', '1', '', '0', '2', '1', '0', '0');
INSERT INTO `cms_node` VALUES ('12', 'Admin', '管理员管理', '', '', '', '1', '', '380', '0', '1', '0', '0');
INSERT INTO `cms_node` VALUES ('13', 'Admin', '管理员管理', 'index', '管理员列表', '', '1', '', '0', '1', '1', '0', '0');
INSERT INTO `cms_node` VALUES ('14', 'Admin', '管理员管理', 'add', '添加管理员', '', '1', '', '0', '2', '1', '0', '0');
INSERT INTO `cms_node` VALUES ('15', 'Admin', '管理员管理', 'edit', '编辑管理员', '', '1', '', '0', '2', '1', '0', '0');
INSERT INTO `cms_node` VALUES ('16', 'Admin', '管理员管理', 'delete', '删除管理员', '', '1', '', '0', '2', '1', '0', '0');
INSERT INTO `cms_node` VALUES ('50', 'Setting', '网站设置', '', '', '', '1', '', '399', '0', '1', '0', '0');
INSERT INTO `cms_node` VALUES ('51', 'Setting', '网站设置', 'index', '网站设置', '', '1', '', '0', '1', '1', '0', '0');
INSERT INTO `cms_node` VALUES ('99', 'Flink', '友情链接', '', '', '', '1', '', '98', '0', '4', '0', '0');
INSERT INTO `cms_node` VALUES ('100', 'Flink', '友情链接', 'index', '友情链接列表', '', '1', '', '0', '1', '4', '0', '0');
INSERT INTO `cms_node` VALUES ('101', 'Article', '资讯管理', '', '', '', '1', '', '100', '0', '4', '0', '0');
INSERT INTO `cms_node` VALUES ('102', 'Article', '资讯管理', 'index', '资讯列表', '', '1', '', '0', '1', '4', '0', '0');
INSERT INTO `cms_node` VALUES ('103', 'Article', '资讯管理', 'add', '添加资讯', '', '1', '', '0', '1', '4', '0', '0');
INSERT INTO `cms_node` VALUES ('104', 'ArticleCate', '资讯分类', '', '', '', '1', '', '99', '0', '4', '0', '0');
INSERT INTO `cms_node` VALUES ('105', 'Article', '资讯管理', 'edit', '编辑资讯', '', '1', '', '0', '2', '4', '0', '0');
INSERT INTO `cms_node` VALUES ('106', 'Article', '资讯管理', 'delete', '删除资讯', '', '1', '', '0', '2', '4', '0', '0');
INSERT INTO `cms_node` VALUES ('107', 'ArticleCate', '资讯分类', 'index', '分类列表', '', '1', '', '0', '1', '4', '0', '0');
INSERT INTO `cms_node` VALUES ('108', 'ArticleCate', '资讯分类', 'add', '添加分类', '', '1', '', '0', '2', '4', '0', '0');
INSERT INTO `cms_node` VALUES ('109', 'ArticleCate', '资讯分类', 'edit', '编辑分类', '', '1', '', '0', '2', '4', '0', '0');
INSERT INTO `cms_node` VALUES ('110', 'ArticleCate', '资讯分类', 'delete', '删除分类', '', '1', '', '0', '2', '4', '0', '0');
INSERT INTO `cms_node` VALUES ('135', 'SellerCate', '商家分类管理', '', '', '', '1', '', '0', '0', '27', '0', '0');
INSERT INTO `cms_node` VALUES ('136', 'SellerCate', '商家分类管理', 'index', '分类列表', '', '1', '', '0', '1', '27', '0', '0');
INSERT INTO `cms_node` VALUES ('137', 'SellerCate', '商家分类管理', 'add', '增加分类', '', '1', '', '0', '2', '27', '0', '0');
INSERT INTO `cms_node` VALUES ('121', 'Nav', '导航管理', '', '', '', '1', '', '2', '0', '4', '0', '0');
INSERT INTO `cms_node` VALUES ('122', 'Nav', '导航管理', 'index', '导航列表', '', '1', '', '0', '1', '4', '0', '0');
INSERT INTO `cms_node` VALUES ('123', 'Nav', '导航管理', 'add', '添加导航', '', '1', '', '0', '2', '4', '0', '0');
INSERT INTO `cms_node` VALUES ('124', 'Nav', '导航管理', 'edit', '编辑导航', '', '1', '', '0', '2', '4', '0', '0');
INSERT INTO `cms_node` VALUES ('125', 'Nav', '导航管理', 'delete', '删除导航', '', '1', '', '0', '2', '4', '0', '0');
INSERT INTO `cms_node` VALUES ('126', 'Public', '起始页', '', '', '', '1', '', '0', '0', '9', '0', '0');
INSERT INTO `cms_node` VALUES ('127', 'Public', '起始页', 'main', '后台首页', '', '1', '', '0', '1', '9', '0', '0');
INSERT INTO `cms_node` VALUES ('128', 'Group', '菜单分类管理', '', '', '', '1', '菜单分类管理', '10', '0', '1', '0', '0');
INSERT INTO `cms_node` VALUES ('129', 'Group', '菜单分类管理', 'index', '分类列表', '', '1', '', '0', '1', '1', '0', '0');
INSERT INTO `cms_node` VALUES ('130', 'Group', '菜单分类管理', 'add', '增加分类', '', '1', '', '0', '2', '1', '0', '0');
INSERT INTO `cms_node` VALUES ('131', 'Group', '菜单分类管理', 'edit', '编辑分类', '', '1', '', '0', '2', '1', '0', '0');
INSERT INTO `cms_node` VALUES ('132', 'Group', '菜单分类管理', 'delete', '删除分类', '', '1', '', '0', '2', '1', '0', '0');
INSERT INTO `cms_node` VALUES ('138', 'SellerCate', '商家分类管理', 'edit', '编辑分类', '', '1', '', '0', '2', '27', '0', '0');
INSERT INTO `cms_node` VALUES ('139', 'SellerCate', '商家分类管理', 'delete', '删除分类', '', '1', '', '0', '2', '27', '0', '0');
INSERT INTO `cms_node` VALUES ('140', 'SellerList', '商家管理', '', '', '', '1', '', '0', '0', '27', '0', '0');
INSERT INTO `cms_node` VALUES ('141', 'SellerList', '商家管理', 'index', '商家列表', '', '1', '', '0', '1', '27', '0', '0');
INSERT INTO `cms_node` VALUES ('142', 'SellerList', '商家管理', 'add', '增加商家', '', '1', '', '0', '2', '27', '0', '0');
INSERT INTO `cms_node` VALUES ('143', 'SellerList', '商家管理', 'edit', '编辑商家', '', '1', '', '0', '2', '27', '0', '0');
INSERT INTO `cms_node` VALUES ('144', 'SellerList', '商家管理', 'delete', '删除商家', '', '1', '', '0', '2', '27', '0', '0');
INSERT INTO `cms_node` VALUES ('145', 'Adboard', '广告位置', '', '', '', '1', '', '0', '0', '4', '0', '0');
INSERT INTO `cms_node` VALUES ('146', 'Adboard', '广告位置', 'index', '广告位置', '', '1', '', '0', '1', '4', '0', '0');
INSERT INTO `cms_node` VALUES ('147', 'Adboard', '广告位置', 'add', '添加广告位置', '', '1', '', '0', '2', '4', '0', '0');
INSERT INTO `cms_node` VALUES ('148', 'Adboard', '广告位置', 'edit', '编辑广告位置', '', '1', '', '0', '2', '4', '0', '0');
INSERT INTO `cms_node` VALUES ('149', 'Adboard', '广告位置', 'delete', '删除广告位置', '', '1', '', '0', '2', '4', '0', '0');
INSERT INTO `cms_node` VALUES ('150', 'Ad', '广告管理', '', '', '', '1', '', '0', '0', '4', '0', '0');
INSERT INTO `cms_node` VALUES ('151', 'Ad', '广告管理', 'index', '广告列表', '', '1', '', '0', '1', '4', '0', '0');
INSERT INTO `cms_node` VALUES ('152', 'Ad', '广告位置', 'add', '添加广告', '', '1', '', '0', '2', '4', '0', '0');
INSERT INTO `cms_node` VALUES ('153', 'Ad', '广告位置', 'edit', '编辑广告', '', '1', '', '0', '2', '4', '0', '0');
INSERT INTO `cms_node` VALUES ('154', 'Ad', '广告位置', 'delete', '删除广告', '', '1', '', '0', '2', '4', '0', '0');
INSERT INTO `cms_node` VALUES ('155', 'User', '会员管理', '', '', '', '1', '', '0', '0', '8', '0', '0');
INSERT INTO `cms_node` VALUES ('156', 'User', '会员管理', 'index', '会员列表', '', '1', '', '0', '1', '8', '0', '0');



-- ----------------------------
-- Records of cms_role
-- ----------------------------
INSERT INTO `cms_role` VALUES ('1', '管理员', '1', '管理员1', '1208784792', '1254325558');
INSERT INTO `cms_role` VALUES ('2', '编辑', '1', '编辑', '1208784792', '1254325558');


-- ----------------------------
-- Records of cms_seller_cate
-- ----------------------------
INSERT INTO `cms_seller_cate` VALUES ('122', '22', '食品饮料', '31', '1', '1', '10');
INSERT INTO `cms_seller_cate` VALUES ('121', '21', '箱包皮具', '29', '1', '1', '10');
INSERT INTO `cms_seller_cate` VALUES ('120', '20', '宠物用品', '1', '0', '1', '10');
INSERT INTO `cms_seller_cate` VALUES ('119', '19', '成人保健', '6', '0', '1', '10');
INSERT INTO `cms_seller_cate` VALUES ('118', '18', '饰品配饰', '31', '1', '1', '10');
INSERT INTO `cms_seller_cate` VALUES ('117', '17', '汽车用品', '7', '0', '1', '10');
INSERT INTO `cms_seller_cate` VALUES ('116', '16', '旅游订票', '1', '0', '1', '10');
INSERT INTO `cms_seller_cate` VALUES ('115', '15', '钟表眼镜', '17', '1', '1', '10');
INSERT INTO `cms_seller_cate` VALUES ('103', '3', '电脑笔记本', '15', '1', '1', '10');
INSERT INTO `cms_seller_cate` VALUES ('102', '2', '手机数码', '19', '1', '1', '10');
INSERT INTO `cms_seller_cate` VALUES ('114', '14', '药品保健', '8', '1', '1', '10');
INSERT INTO `cms_seller_cate` VALUES ('113', '13', '数字卡软件', '2', '0', '1', '10');
INSERT INTO `cms_seller_cate` VALUES ('112', '12', '玩具礼品', '6', '0', '1', '10');
INSERT INTO `cms_seller_cate` VALUES ('111', '11', '办公用品', '6', '0', '1', '10');
INSERT INTO `cms_seller_cate` VALUES ('110', '10', '母婴用品', '14', '1', '1', '10');
INSERT INTO `cms_seller_cate` VALUES ('109', '9', '居家生活', '24', '1', '1', '10');
INSERT INTO `cms_seller_cate` VALUES ('108', '8', '家用电器', '19', '1', '1', '10');
INSERT INTO `cms_seller_cate` VALUES ('107', '7', '户外休闲', '3', '0', '1', '10');
INSERT INTO `cms_seller_cate` VALUES ('106', '6', '综合百货', '22', '1', '1', '10');
INSERT INTO `cms_seller_cate` VALUES ('105', '5', '化妆美容', '41', '1', '1', '10');
INSERT INTO `cms_seller_cate` VALUES ('104', '4', '服装服饰', '85', '1', '1', '10');
INSERT INTO `cms_seller_cate` VALUES ('101', '1', '图书音像', '15', '1', '1', '10');

-- ----------------------------
-- Records of cms_setting
-- ----------------------------
INSERT INTO `cms_setting` VALUES ('site_name', 'MobileCms移动后台管理系统');
INSERT INTO `cms_setting` VALUES ('site_title', 'MobileCms移动后台管理系统');
INSERT INTO `cms_setting` VALUES ('site_keyword', 'MobileCms移动后台管理系统，phonegap100.com');
INSERT INTO `cms_setting` VALUES ('site_description', 'MobileCms是一款移动互联网软件后台管理系统，由phonegap100.com 提供');
INSERT INTO `cms_setting` VALUES ('site_status', '1');
INSERT INTO `cms_setting` VALUES ('site_icp', '京ICP备88888888号');
INSERT INTO `cms_setting` VALUES ('statistics_code', '');
INSERT INTO `cms_setting` VALUES ('closed_reason', '升级');
INSERT INTO `cms_setting` VALUES ('site_domain', 'http://localhost/wego25');
INSERT INTO `cms_setting` VALUES ('weibo_url', 'http://www.weibo.com');
INSERT INTO `cms_setting` VALUES ('qqzone_url', '');
INSERT INTO `cms_setting` VALUES ('douban_url', '');
INSERT INTO `cms_setting` VALUES ('attachment_size', '3145728');
INSERT INTO `cms_setting` VALUES ('template', 'default');
INSERT INTO `cms_setting` VALUES ('taobao_app_key', '12504724');
INSERT INTO `cms_setting` VALUES ('qq_app_key', '');
INSERT INTO `cms_setting` VALUES ('qq_app_Secret', '');
INSERT INTO `cms_setting` VALUES ('sina_app_key', '100308089');
INSERT INTO `cms_setting` VALUES ('sina_app_Secret', '25ee4d31ca98edea230885985e1cf2e1');
INSERT INTO `cms_setting` VALUES ('taobao_app_secret', '9d6877190386092d4288dcae32811081');
INSERT INTO `cms_setting` VALUES ('url_model', '0');
INSERT INTO `cms_setting` VALUES ('attachment_path', 'data/uploads');
INSERT INTO `cms_setting` VALUES ('client_hash', '');
INSERT INTO `cms_setting` VALUES ('attachment_type', 'jpg,gif,png,jpeg');
INSERT INTO `cms_setting` VALUES ('miao_appkey', '1003336');
INSERT INTO `cms_setting` VALUES ('miao_appsecret', '0847c5008f99150de65fad8e8ec342fa');
INSERT INTO `cms_setting` VALUES ('mail_smtp', 'smtp.163.com');
INSERT INTO `cms_setting` VALUES ('mail_username', '');
INSERT INTO `cms_setting` VALUES ('mail_password', 'PassWord01!');
INSERT INTO `cms_setting` VALUES ('mail_port', '25');
INSERT INTO `cms_setting` VALUES ('mail_fromname', 'MobileCms');
NSERT INTO `cms_setting` VALUES ('register_send_mail', '1');
INSERT INTO `cms_setting` VALUES ('check_code', '1');
INSERT INTO `cms_setting` VALUES ('comment_time', '10');
INSERT INTO `cms_setting` VALUES ('site_share', '<meta property=\\\"qc:admins\\\" content=\\\"271503564761116217636\\\" />');
INSERT INTO `cms_setting` VALUES ('ban_sipder', 'youdaobot|bingbot');
INSERT INTO `cms_setting` VALUES ('ban_ip', '192.168.1.50');
INSERT INTO `cms_setting` VALUES ('site_logo', './data/setting/524a5cbde8499.jpg');
INSERT INTO `cms_setting` VALUES ('article_count', '10');
INSERT INTO `cms_setting` VALUES ('html_suffix', '.html');
INSERT INTO `cms_setting` VALUES ('mail_username', 'ho1000003@163.com\r\nho1000004@163.com\r\nho1000005@163.com\r\nhml100000@163.com');
INSERT INTO `cms_setting` VALUES ('mail_receive_username', '');
INSERT INTO `cms_setting` VALUES ('mail_content', '<body style=\\\"margin: 10px;\\\">\r\n<div align=\\\"center\\\"><img src=\\\"http://www.phonegap100.com/static/image/common/logo.png\\\"></div><br>\r\n<br>\r\n <h3>欢迎使用 树根cms 此系统由phonegap中文网 <a href=\\\"http://www.phonegap100.com\\\" target=\\\"_blank\\\">phonegap100.com</a>提供 </h3>\r\n<br>\r\n\r\n在使用中遇到任何问题，请到phonegap中文网提出，感谢大家对此程序的支持，我们的qq群：295402925\r\n\r\n</body>');
INSERT INTO `cms_setting` VALUES ('mail_title', '欢迎使用树根cms，这是一封感谢信');
