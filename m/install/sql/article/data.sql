INSERT INTO `jieqi_system_blocks` (`bid`, `blockname`, `modname`, `filename`, `classname`, `side`, `title`, `description`, `content`, `vars`, `template`, `cachetime`, `contenttype`, `weight`, `showstatus`, `custom`, `canedit`, `publish`, `hasvars`) VALUES(20, '分类阅读', 'article', 'block_sort', 'BlockArticleSort', 0, '分类阅读', '', '', '', '', 0, 0, 20100, 0, 0, 0, 0, 0);
INSERT INTO `jieqi_system_blocks` (`bid`, `blockname`, `modname`, `filename`, `classname`, `side`, `title`, `description`, `content`, `vars`, `template`, `cachetime`, `contenttype`, `weight`, `showstatus`, `custom`, `canedit`, `publish`, `hasvars`) VALUES(21, '小说搜索', 'article', 'block_search', 'BlockArticleSearch', 1, '小说搜索', '', '', '', '', 0, 0, 20200, 0, 0, 0, 3, 0);
INSERT INTO `jieqi_system_blocks` (`bid`, `blockname`, `modname`, `filename`, `classname`, `side`, `title`, `description`, `content`, `vars`, `template`, `cachetime`, `contenttype`, `weight`, `showstatus`, `custom`, `canedit`, `publish`, `hasvars`) VALUES(22, '排 行 榜', 'article', 'block_toplist', 'BlockArticleToplist', 0, '排 行 榜', '', '', '', '', 0, 0, 20300, 0, 0, 0, 0, 0);
INSERT INTO `jieqi_system_blocks` (`bid`, `blockname`, `modname`, `filename`, `classname`, `side`, `title`, `description`, `content`, `vars`, `template`, `cachetime`, `contenttype`, `weight`, `showstatus`, `custom`, `canedit`, `publish`, `hasvars`) VALUES(40, '书评列表', 'article', 'block_reviewslist', 'BlockArticleReviewslist', 0, '最新书评', '&nbsp;&nbsp;&nbsp;&nbsp;本区块用于显示全站的最新书评或者某篇小说的最新书评。<br>&nbsp;&nbsp;&nbsp;&nbsp;区块允许设置四个参数，不同参数之间用英文逗号分隔“,”。<br>&nbsp;&nbsp;&nbsp;&nbsp;参数一是显示行数，使用整数（默认 10）<br>&nbsp;&nbsp;&nbsp;&nbsp;参数二是指是否置顶书评（默认 0 表示不判断），1 表示只显示置顶书评，2 表示非置顶书评<br>&nbsp;&nbsp;&nbsp;&nbsp;参数三是指是否精华书评（默认 0 表示不判断），1 表示只显示精华书评，2 表示非精华书评<br>&nbsp;&nbsp;&nbsp;&nbsp;参数四是指小说ID，允许设置成：0-表示所有小说，大于0的整数-指定小说ID，字符串-如“id”-url参数里面id值对应的值，$开头的字符串-如“$articleid”-表示模板里面{?$articleid?}这个变量<br>&nbsp;&nbsp;&nbsp;&nbsp;参数设置中一项或者多项留空均表示使用默认值。例子： “15,0,1,0” 表示显示15条最新精华书评。', '', '10,0,0,64', 'block_reviewslist.html', 0, 4, 22100, 0, 0, 0, 0, 1);
INSERT INTO `jieqi_system_blocks` (`bid`, `blockname`, `modname`, `filename`, `classname`, `side`, `title`, `description`, `content`, `vars`, `template`, `cachetime`, `contenttype`, `weight`, `showstatus`, `custom`, `canedit`, `publish`, `hasvars`) VALUES(93, '编辑推荐', 'article', 'block_commend', 'BlockArticleCommend', 0, '编辑推荐', '&nbsp;&nbsp;&nbsp;&nbsp;本区块允许用户自定义模板和参数，并且不同的设置可以保存成不同的区块。<br>&nbsp;&nbsp;&nbsp;&nbsp;区块默认模板文件为“block_commend.html”，在/modules/article/templates/blocks目录下，如果您定义了另外模板文件，也必须在此目录。模板文件设置留空表示使用默认模板。<br>&nbsp;&nbsp;&nbsp;&nbsp;区块允许设置推荐的小说序号作为参数，不同参数之间用英文“|”分隔。比如： “123|234|456|678” 表示本区块调用这四个序号小说信息显示', '', '111|222|333', 'block_commend.html', 0, 1, 23100, 0, 0, 0, 0, 2);
INSERT INTO `jieqi_system_blocks` (`bid`, `blockname`, `modname`, `filename`, `classname`, `side`, `title`, `description`, `content`, `vars`, `template`, `cachetime`, `contenttype`, `weight`, `showstatus`, `custom`, `canedit`, `publish`, `hasvars`) VALUES(43, '我的原创小说', 'article', 'block_myarticles', 'BlockArticleMyarticles', 0, '我的原创小说', '', '', '', '', 0, 4, 22400, 1, 0, 0, 0, 0);
INSERT INTO `jieqi_system_blocks` (`bid`, `blockname`, `modname`, `filename`, `classname`, `side`, `title`, `description`, `content`, `vars`, `template`, `cachetime`, `contenttype`, `weight`, `showstatus`, `custom`, `canedit`, `publish`, `hasvars`) VALUES(44, '我的转载小说', 'article', 'block_transarticles', 'BlockArticleTransarticles', 0, '我的转载小说', '', '', '', '', 0, 4, 22500, 1, 0, 0, 0, 0);
INSERT INTO `jieqi_system_blocks` (`bid`, `blockname`, `modname`, `filename`, `classname`, `side`, `title`, `description`, `content`, `vars`, `template`, `cachetime`, `contenttype`, `weight`, `showstatus`, `custom`, `canedit`, `publish`, `hasvars`) VALUES(45, '作家工具箱', 'article', 'block_writerbox', 'BlockArticleWriterbox', 0, '作家工具箱', '', '', '', '', 0, 0, 22600, 1, 0, 0, 0, 0);
INSERT INTO `jieqi_system_blocks` (`bid`, `blockname`, `modname`, `filename`, `classname`, `side`, `title`, `description`, `content`, `vars`, `template`, `cachetime`, `contenttype`, `weight`, `showstatus`, `custom`, `canedit`, `publish`, `hasvars`) VALUES(46, '小说列表区块', 'article', 'block_articlelist', 'BlockArticleArticlelist', 0, '小说总排行', '&nbsp;&nbsp;&nbsp;&nbsp;本区块允许用户自定义模板和参数，并且不同的设置可以保存成不同的区块。<br>&nbsp;&nbsp;&nbsp;&nbsp;区块默认模板文件为“block_articlelist.html”，在/modules/article/templates/blocks目录下，如果您定义了另外模板文件，也必须在此目录。模板文件设置留空表示使用默认模板。<br>&nbsp;&nbsp;&nbsp;&nbsp;区块允许设置六个参数，不同参数之间用英文逗号分隔“,”。<br>&nbsp;&nbsp;&nbsp;&nbsp;参数一是排行方式（默认按总访问量），允许以下几种设置：1、“allvisit” - 按总访问量；2、“monthvisit” - 按月访问量；3、“weekvisit” - 按周访问量；4、“dayvisit” - 按日访问量；5、“allvote” - 按总推荐次数；6、“monthvote” - 按月推荐次数；7、“weekvote” - 按周推荐次数；8、“dayvote” - 按日推荐次数；9、“postdate” - 按最新入库；10、“toptime” - 按本站推荐；11、“goodnum” - 按收藏数量；12、“size” - 按小说字数；13、“lastupdate” - 按最近更新；<br>&nbsp;&nbsp;&nbsp;&nbsp;参数二是显示行数，使用整数（默认 15）<br>&nbsp;&nbsp;&nbsp;&nbsp;参数三是小说类别（默认 0 表示所有类别），此处使用得是类别序号而不是名称，比如“玄幻小说”类别序号是 3 ，这里就设置成 3，如果要同时选择多个类别，可以用“|”分隔，比如 3|4|7<br>&nbsp;&nbsp;&nbsp;&nbsp;参数四是指是否原创（默认 0 表示不判断），1 表示只显示原创作品，2 表示转载作品<br>&nbsp;&nbsp;&nbsp;&nbsp;参数五是指是否全本（默认 0 表示不判断），1 表示只显示全本作品，2 表示连载作品<br>&nbsp;&nbsp;&nbsp;&nbsp;参数六是指显示顺序（默认 0 表示按从大到小排序），1 表示从小到大排序。<br>&nbsp;&nbsp;&nbsp;&nbsp;参数设置中一项或者多项留空均表示使用默认值。例子： “lastupdate,,0,1,0,0” 表示显示15条最近更新的原创作品，其中第二个参数留空，所以使用默认的15条。', '', 'allvisit,15,0,0,0,0', 'block_articlelist.html', 0, 4, 23000, 0, 0, 0, 0, 1);
INSERT INTO `jieqi_system_blocks` (`bid`, `blockname`, `modname`, `filename`, `classname`, `side`, `title`, `description`, `content`, `vars`, `template`, `cachetime`, `contenttype`, `weight`, `showstatus`, `custom`, `canedit`, `publish`, `hasvars`) VALUES(47, '小说封面推荐', 'article', 'block_commend', 'BlockArticleCommend', 0, '封面推荐', '&nbsp;&nbsp;&nbsp;&nbsp;本区块允许用户自定义模板和参数，并且不同的设置可以保存成不同的区块。<br>&nbsp;&nbsp;&nbsp;&nbsp;区块默认模板文件为“block_commend.html”，在/modules/article/templates/blocks目录下，如果您定义了另外模板文件，也必须在此目录。模板文件设置留空表示使用默认模板。<br>&nbsp;&nbsp;&nbsp;&nbsp;区块允许设置推荐的小说序号作为参数，不同参数之间用英文“|”分隔。比如： “123|234|456|678” 表示本区块调用这四个序号小说信息显示', '', '', 'block_commend.html', 0, 1, 23100, 0, 0, 0, 0, 2);
INSERT INTO `jieqi_system_blocks` (`bid`, `blockname`, `modname`, `filename`, `classname`, `side`, `title`, `description`, `content`, `vars`, `template`, `cachetime`, `contenttype`, `weight`, `showstatus`, `custom`, `canedit`, `publish`, `hasvars`) VALUES(48, '用户小说', 'article', 'block_uarticles', 'BlockArticleUarticles', 6, '我的小说', '&nbsp;&nbsp;&nbsp;&nbsp;本区块显示某一用户的原创小说<br>&nbsp;&nbsp;&nbsp;&nbsp;允许设置五个参数，不同参数之间用英文逗号分隔“,”。<br>&nbsp;&nbsp;&nbsp;&nbsp;参数一是排序字段，允许设置成“lastupdate”-更新时间，“postdate”-发表时间，“articleid”-小说ID，“allvisit”-总点击，“monthvisit”-月点击，“weekvisit”-周点击，“allvote”-总推荐，“monthvote”-月推荐，“weekvote”-周推荐，“size”-字数，“goodnum”-收藏数<br>&nbsp;&nbsp;&nbsp;&nbsp;参数二是显示几条记录，默认10<br>&nbsp;&nbsp;&nbsp;&nbsp;参数三是排序方式：0-从大到小，1-从小到大<br>&nbsp;&nbsp;&nbsp;&nbsp;参数四是显示哪个用户的友情链接，允许设置成“self”-当前用户，“uid”-url参数里面uid值对应的用户，“0”-所有用户，设置成大于0的一个整数，表示指定这个uid的用户<br>&nbsp;&nbsp;&nbsp;&nbsp;参数五全本标志，0-都显示，1-显示全本，2-显示非全本', '', 'lastupdate,10,0,uid,0', 'block_uarticles.html', 0, 4, 25100, 0, 0, 0, 0, 1);
INSERT INTO `jieqi_system_blocks` (`bid`, `blockname`, `modname`, `filename`, `classname`, `side`, `title`, `description`, `content`, `vars`, `template`, `cachetime`, `contenttype`, `weight`, `showstatus`, `custom`, `canedit`, `publish`, `hasvars`) VALUES(49, '用户书架', 'article', 'block_ubookcase', 'BlockArticleUbookcase', 6, '我的书架', '&nbsp;&nbsp;&nbsp;&nbsp;本区块显示某一用户的书架小说<br>&nbsp;&nbsp;&nbsp;&nbsp;允许设置四个参数，不同参数之间用英文逗号分隔“,”。<br>&nbsp;&nbsp;&nbsp;&nbsp;参数一是排序字段，允许设置成“lastupdate”-更新时间，“joindate”-加入时间，“articleid”-小说ID，“caseid”-书架ID，“lastvisit”-最后访问时间<br>&nbsp;&nbsp;&nbsp;&nbsp;参数二是显示几条记录，默认10<br>&nbsp;&nbsp;&nbsp;&nbsp;参数三是排序方式：0-从大到小，1-从小到大<br>&nbsp;&nbsp;&nbsp;&nbsp;参数四是显示哪个用户的友情链接，允许设置成“self”-当前用户，“uid”-url参数里面uid值对应的用户，“0”-所有用户，设置成大于0的一个整数，表示指定这个uid的用户', '', 'lastupdate,10,0,uid', 'block_ubookcase.html', 0, 4, 25200, 0, 0, 0, 0, 1);
INSERT INTO `jieqi_system_blocks` (`bid`, `blockname`, `modname`, `filename`, `classname`, `side`, `title`, `description`, `content`, `vars`, `template`, `cachetime`, `contenttype`, `weight`, `showstatus`, `custom`, `canedit`, `publish`, `hasvars`) VALUES(92, '章节目录区块', 'article', 'block_achapters', 'BlockArticleAchapters', 0, '章节目录', '&nbsp;&nbsp;&nbsp;&nbsp;本区块显示某一篇小说的几个最新章节或者整个章节目录<br>&nbsp;&nbsp;&nbsp;&nbsp;允许设置五个参数，不同参数之间用英文逗号分隔“,”。<br>&nbsp;&nbsp;&nbsp;&nbsp;参数一是排序字段，允许设置成“chapterorder”-章节顺序，“postdate”-章节发表时间，“lastupdate”-章节更新时间，“chapterid”-章节ID。<br>&nbsp;&nbsp;&nbsp;&nbsp;参数二是显示几条记录，设置成 0 表示显示全部章节。<br>&nbsp;&nbsp;&nbsp;&nbsp;参数三是排序方式：0-从大到小，1-从小到大<br>&nbsp;&nbsp;&nbsp;&nbsp;参数四是指定小说ID，允许设置成：整数-指定小说ID，字符串-如“id”-url参数里面id值对应的值，$开头的字符串-如“$articleid”-表示模板里面{?$articleid?}这个变量<br>&nbsp;&nbsp;&nbsp;&nbsp;参数五是显示章节还是分卷：0-显示分卷及章节，1-只显示章节，2-只显示分卷', '', 'chapterorder,10,1,id,0', 'block_achapters.html', 0, 4, 25300, 0, 0, 0, 0, 1);

INSERT INTO `jieqi_system_configs` VALUES ('95', 'article', 'pagenum', '小说列表一页显示几行', '30', '', '0', '3', '', '12200', '显示控制');
INSERT INTO `jieqi_system_configs` VALUES ('96', 'article', 'cachenum', '小说列表缓存几个页面', '10', '', '0', '3', '', '12300', '显示控制');
INSERT INTO `jieqi_system_configs` VALUES ('98', 'article', 'topcachenum', '排行榜缓存几个页面', '10', '', '0', '3', '', '12350', '显示控制');
INSERT INTO `jieqi_system_configs` VALUES ('105', 'article', 'reviewwidth', '评论显示宽度', '90', '单位是“字节”，1个汉字等于2个字节', '0', '3', '', '12900', '显示控制');
INSERT INTO `jieqi_system_configs` VALUES ('106', 'article', 'maxreviewsize', '最大评论长度', '0', '单位是“字节”，设为0表示无限制', '0', '3', '', '13000', '显示控制');
INSERT INTO `jieqi_system_configs` VALUES ('107', 'article', 'minreviewsize', '最小评论长度', '0', '单位是“字节”，设为0表示无限制', '0', '3', '', '13100', '显示控制');
INSERT INTO `jieqi_system_configs` VALUES ('108', 'article', 'goodreviewpercent', '精华书评百分比', '10', '百分之', '0', '3', '', '13150', '显示控制');
INSERT INTO `jieqi_system_configs` VALUES ('109', 'article', 'reviewenter', '书评允许显示换行', '1', '', '0', '9', 'a:2:{i:1;s:2:\"是\";i:0;s:2:\"否\";}', '13600', '显示控制');
INSERT INTO `jieqi_system_configs` VALUES ('110', 'article', 'maxbookmarks', '默认书架藏书量', '20', '', '0', '3', '', '13650', '显示控制');
INSERT INTO `jieqi_system_configs` VALUES ('111', 'article', 'maxmarkclass', '书架最多类别数', '5', '用户书架最多允许分几个类别，设置成0表示不允许分类。', '0', '3', '', '13660', '显示控制');
INSERT INTO `jieqi_system_configs` VALUES ('113', 'article', 'textwatermark', '文字水印', '', '指的是隐藏在阅读页面的一些文字，其中<{$randtext}>将被替换成一组随机字符。例如：“<span style=\"display:none\">版权所有：<{$randtext}>杰奇网络</span>”（style=\"display:none\" 是指默认不可见，但是页面上全选复制时候会包含本部分内容）', '0', '2', '', '13850', '显示控制');
INSERT INTO `jieqi_system_configs` VALUES ('114', 'article', 'pageimagecode', '阅读页面图片显示代码', '<div class=\"divimage\"><img src=\"<{$imageurl}>\" border=\"0\" class=\"imagecontent\"></div>', '小说生成阅读页面时候，显示图片附件的html代码。其中<{$imageurl}>将被替换成实际图片地址', '0', '2', '', '13860', '显示控制');
INSERT INTO `jieqi_system_configs` VALUES ('115', 'article', 'txtarticlehead', 'TXT全文头部附加内容', '', '生成TXT全文下载，内容头部和尾部可以附加一些预想设置的内容，比如本站名字地址。', '0', '2', '', '13870', '显示控制');
INSERT INTO `jieqi_system_configs` VALUES ('116', 'article', 'txtarticlefoot', 'TXT全文尾部附加内容', '', '生成TXT全文下载，内容头部和尾部可以附加一些预想设置的内容，比如本站名字地址。', '0', '2', '', '13880', '显示控制');
INSERT INTO `jieqi_system_configs` VALUES ('117', 'article', 'authtypeset', '是否允许自动排版', '1', '', '0', '9', 'a:2:{i:1;s:2:\"是\";i:0;s:2:\"否\";}', '14030', '显示控制');
INSERT INTO `jieqi_system_configs` VALUES ('118', 'article', 'autotypeset', '默认自动排版', '1', '', '0', '9', 'a:2:{i:1;s:2:\"是\";i:0;s:2:\"否\";}', '14100', '显示控制');
INSERT INTO `jieqi_system_configs` VALUES ('119', 'article', 'searchtype', '搜索匹配方式', '0', '', '0', '7', 'a:3:{i:0;s:8:\"模糊匹配\";i:1;s:10:\"半模糊匹配\";i:2;s:8:\"完整匹配\";}', '14150', '显示控制');
INSERT INTO `jieqi_system_configs` VALUES ('120', 'article', 'minsearchlen', '搜索关键字最少长度', '4', '', '0', '3', '', '14200', '显示控制');
INSERT INTO `jieqi_system_configs` VALUES ('121', 'article', 'maxsearchres', '最大搜索结果数', '300', '', '0', '3', '', '14300', '显示控制');
INSERT INTO `jieqi_system_configs` VALUES ('122', 'article', 'minsearchtime', '两次搜索间隔时间', '30', '', '0', '3', '', '14400', '显示控制');
INSERT INTO `jieqi_system_configs` VALUES ('123', 'article', 'checkappwriter', '申请作者是否需要审核', '1', '需要审核时会员提交申请，管理员审核。不需要审核则用户点申请，直接成为作者', '0', '9', 'a:2:{i:1;s:2:\"是\";i:0;s:2:\"否\";}', '14900', '显示控制');
INSERT INTO `jieqi_system_configs` VALUES ('124', 'article', 'articlevote', '小说是否允许发起投票', '0', '本项设置是否允许投票和最大允许一个投票选项', '0', '7', 'a:10:{i:0;s:10:\"不允许投票\";i:2;s:11:\"最大2个选项\";i:3;s:11:\"最大3个选项\";i:4;s:11:\"最大4个选项\";i:5;s:11:\"最大5个选项\";i:6;s:11:\"最大6个选项\";i:7;s:11:\"最大7个选项\";i:8;s:11:\"最大8个选项\";i:9;s:11:\"最大9个选项\";i:10;s:12:\"最大10个选项\";}', '14950', '显示控制');
INSERT INTO `jieqi_system_configs` VALUES ('125', 'article', 'writergroup', '默认作者类型', '专栏作家', '用户申请作者后默认的类型（如：临时作者）', '0', '1', '', '15000', '显示控制');
INSERT INTO `jieqi_system_configs` VALUES ('126', 'article', 'samearticlename', '小说标题是否允许重复', '0', '', '0', '9', 'a:2:{i:1;s:2:\"是\";i:0;s:2:\"否\";}', '15100', '显示控制');
INSERT INTO `jieqi_system_configs` VALUES ('127', 'article', 'visitstatnum', '小说点击统计基数', '1', '即用户访问一篇小说算几个点击，设置成 0 的话不进行点击统计', '0', '3', '', '15200', '显示控制');
INSERT INTO `jieqi_system_configs` VALUES ('128', 'article', 'eachlinknum', '每篇小说允许互换链接数', '0', '即一篇小说可以在信息页面设置几本站内的书作为推荐，设为0表示开启本功能', '0', '3', '', '15300', '显示控制');
INSERT INTO `jieqi_system_configs` VALUES ('129', 'article', 'maketxt', '是否生成文本文件', '1', '目前必须生成', '0', '9', 'a:2:{i:1;s:2:\"是\";i:0;s:2:\"否\";}', '20080', '文件参数');
INSERT INTO `jieqi_system_configs` VALUES ('130', 'article', 'txtdir', '文本保存目录', 'txt', '', '0', '1', '', '20100', '文件参数');
INSERT INTO `jieqi_system_configs` VALUES ('131', 'article', 'txturl', '访问文本的URL', '', '文本用相对路径的话此处留空，否则用完整url，最后不带斜杠', '0', '1', '', '20120', '文件参数');
INSERT INTO `jieqi_system_configs` VALUES ('132', 'article', 'makeopf', '是否生成opf文件', '1', '目前自动生成', '0', '9', 'a:2:{i:1;s:2:\"是\";i:0;s:2:\"否\";}', '20280', '文件参数');
INSERT INTO `jieqi_system_configs` VALUES ('133', 'article', 'opfdir', 'OPF文件目录', 'txt', '一般和文本放在同一目录', '0', '1', '', '20300', '文件参数');
INSERT INTO `jieqi_system_configs` VALUES ('134', 'article', 'opfurl', '访问OPF的URL', '', 'OPF文件用相对路径的话此处留空，否则用完整url，最后不带斜杠', '0', '1', '', '20320', '文件参数');
INSERT INTO `jieqi_system_configs` VALUES ('135', 'article', 'makehtml', '是否生成html', '0', '', '0', '9', 'a:2:{i:1;s:2:\"是\";i:0;s:2:\"否\";}', '20680', '文件参数');
INSERT INTO `jieqi_system_configs` VALUES ('136', 'article', 'htmldir', 'HTML目录', 'html', '', '0', '1', '', '20700', '文件参数');
INSERT INTO `jieqi_system_configs` VALUES ('137', 'article', 'htmlurl', '访问HTML的URL', '', 'HTML文件用相对路径的话此处留空，否则用完整url，最后不带斜杠', '0', '1', '', '20720', '文件参数');
INSERT INTO `jieqi_system_configs` VALUES ('138', 'article', 'htmlfile', 'HTML文件后缀', '.html', '', '0', '7', 'a:3:{s:5:\".html\";s:5:\".html\";s:4:\".htm\";s:4:\".htm\";s:6:\".shtml\";s:6:\".shtml\";} ', '20800', '文件参数');
INSERT INTO `jieqi_system_configs` VALUES ('139', 'article', 'makefull', '是否生成全文阅读', '0', '', '0', '9', 'a:2:{i:1;s:2:\"是\";i:0;s:2:\"否\";}', '20820', '文件参数');
INSERT INTO `jieqi_system_configs` VALUES ('140', 'article', 'fulldir', '全文阅读目录', 'fulltext', '', '0', '1', '', '20840', '文件参数');
INSERT INTO `jieqi_system_configs` VALUES ('141', 'article', 'fullurl', '访问全文阅读的URL', '', '全文阅读用相对路径的话此处留空，否则用完整url，最后不带斜杠', '0', '1', '', '20860', '文件参数');
INSERT INTO `jieqi_system_configs` VALUES ('142', 'article', 'makezip', '是否生成zip', '0', '', '0', '9', 'a:2:{i:1;s:2:\"是\";i:0;s:2:\"否\";}', '20880', '文件参数');
INSERT INTO `jieqi_system_configs` VALUES ('143', 'article', 'zipdir', 'ZIP目录', 'zip', '', '0', '1', '', '20900', '文件参数');
INSERT INTO `jieqi_system_configs` VALUES ('144', 'article', 'zipurl', '访问ZIP文件的URL', '', 'ZIP文件用相对路径的话此处留空，否则用完整url，最后不带斜杠', '0', '1', '', '20920', '文件参数');
INSERT INTO `jieqi_system_configs` VALUES ('145', 'article', 'maketxtfull', '是否生成TXT全文', '0', '', '0', '9', 'a:2:{i:1;s:2:\"是\";i:0;s:2:\"否\";}', '21100', '文件参数');
INSERT INTO `jieqi_system_configs` VALUES ('146', 'article', 'txtfulldir', 'TXT全文目录', 'txtfull', '', '0', '1', '', '21120', '文件参数');
INSERT INTO `jieqi_system_configs` VALUES ('147', 'article', 'txtfullurl', '访问TXT全文的URL', '', '用相对路径的话此处留空，否则用完整url，最后不带斜杠', '0', '1', '', '21140', '文件参数');
INSERT INTO `jieqi_system_configs` VALUES ('148', 'article', 'makeumd', '是否生成UMD电子书', '0', '全部不选表示不生成umd', '0', '10', 'a:4:{i:1;s:7:\"全本umd\";i:2;s:7:\"64K分卷\";i:4;s:8:\"128K分卷\";i:16;s:8:\"512K分卷\";}', '21200', '文件参数');
INSERT INTO `jieqi_system_configs` VALUES ('149', 'article', 'umddir', 'UMD文件目录', 'umd', '', '0', '1', '', '21220', '文件参数');
INSERT INTO `jieqi_system_configs` VALUES ('150', 'article', 'umdurl', '访问UMD文件的URL', '', '用相对路径的话此处留空，否则用完整url，最后不带斜杠', '0', '1', '', '21240', '文件参数');
INSERT INTO `jieqi_system_configs` VALUES ('151', 'article', 'makejar', '是否生成JAR电子书', '0', '全部不选表示不生成jar', '0', '10', 'a:4:{i:1;s:7:\"全本jar\";i:2;s:7:\"64K分卷\";i:4;s:8:\"128K分卷\";i:16;s:8:\"512K分卷\";}', '21300', '文件参数');
INSERT INTO `jieqi_system_configs` VALUES ('152', 'article', 'jardir', 'JAR文件目录', 'jar', '', '0', '1', '', '21320', '文件参数');
INSERT INTO `jieqi_system_configs` VALUES ('153', 'article', 'jarurl', '访问JAR文件的URL', '', '用相对路径的话此处留空，否则用完整url，最后不带斜杠', '0', '1', '', '21340', '文件参数');
INSERT INTO `jieqi_system_configs` VALUES ('154', 'article', 'imagedir', '封面图片保存目录', 'image', '', '0', '1', '', '21780', '文件参数');
INSERT INTO `jieqi_system_configs` VALUES ('155', 'article', 'imagetype', '封面图片文件后缀', '.jpg', '', '0', '7', 'a:4:{s:4:\".jpg\";s:4:\".jpg\";s:5:\".jpeg\";s:5:\".jpeg\";s:4:\".gif\";s:4:\".gif\";s:4:\".png\";s:4:\".png\";}', '21800', '文件参数');
INSERT INTO `jieqi_system_configs` VALUES ('156', 'article', 'imageurl', '访问封面图片的URL', '', '图片用相对路径的话此处留空，否则用完整url，最后不带斜杠', '0', '1', '', '21820', '文件参数');
INSERT INTO `jieqi_system_configs` VALUES ('157', 'article', 'fakeinfo', '小说信息页面伪静态规则', '', '\r\n变量：<{$id}>（小说ID），<{$acode}>（小说拼音代码），<{$id|subdirectory}>（小说ID子目录）。\r\n例如：/info/<{$id}>.html\r\n指向：/modules/article/articleinfo.php?id=$id\r\n例如：/info/<{$acode}>.html\r\n指向：/modules/article/articleinfo.php?acode=$acode', '0', '1', '', '21910', '文件参数');
INSERT INTO `jieqi_system_configs` VALUES ('158', 'article', 'fakesort', '小说分类页面伪静态规则', '', '\r\n变量：<{$sortid}>（分类ID），<{$sortcode}>（分类英文代码），<{$page}>（页码），<{$page|subdirectory}>（页码子目录）。\r\n例如：/sort/<{$sortid}>/<{$page}>.html\r\n指向：/modules/article/articlelist.php?sortid=$sortid&page=$page', '0', '1', '', '21920', '文件参数');
INSERT INTO `jieqi_system_configs` VALUES ('159', 'article', 'fakeinitial', '首字母分类页面伪静态规则', '', '\r\n变量：<{$initial}>（小说名首字母），<{$page}>（页码），<{$page|subdirectory}>（页码子目录）。\r\n例如：/initial/<{$initial}>/<{$page}>.html\r\n指向：/modules/article/articlelist.php?initial=$initial&page=$page', '0', '1', '', '21930', '文件参数');
INSERT INTO `jieqi_system_configs` VALUES ('160', 'article', 'faketoplist', '排行榜页面伪静态规则', '', '\r\n变量：<{$order}>（排序方式），<{$sortid}>（分类ID），<{$sortcode}>（分类英文代码），<{$page}>（页码），<{$page|subdirectory}>（页码子目录）。\r\n例如：/top/<{$order}>/<{$page}>.html\r\n指向：/modules/article/toplist.php?order=$order&page=$page', '0', '1', '', '21940', '文件参数');
INSERT INTO `jieqi_system_configs` VALUES ('161', 'article', 'staticurl', '小说内静态链接根地址', '', '用于小说和程序保存在不同服务器场合，留空表示用系统默认路径', '0', '1', '', '22000', '文件参数');
INSERT INTO `jieqi_system_configs` VALUES ('162', 'article', 'dynamicurl', '小说内动态链接根地址', '', '用于小说和程序保存在不同服务器场合，留空表示用系统默认路径', '0', '1', '', '22100', '文件参数');
INSERT INTO `jieqi_system_configs` VALUES ('167', 'article', 'dayvotes', '每天允许推荐次数', '1', '', '0', '3', '', '30600', '积分设置');
INSERT INTO `jieqi_system_configs` VALUES ('170', 'article', 'voteminsize', '多少字数以上的文章才允许推荐', '0', '如果设置成 0 则表示不限制字数', '0', '3', '', '30630', '积分设置');
INSERT INTO `jieqi_system_configs` VALUES ('428', 'article', 'vipvote', '打赏送月票', '1000', '控制打赏送月票比例，设置成0表示关闭。', '0', '3', '', '31340', '积分设置');
INSERT INTO `jieqi_system_configs` VALUES ('429', 'article', 'flower', '鲜花单价', '10', '控制虚拟币打赏鲜花单价，设置成0表示关闭。', '0', '3', '鲜花', '31350', '积分设置');
INSERT INTO `jieqi_system_configs` VALUES ('430', 'article', 'egg', '鸡蛋单价', '10', '控制虚拟币打赏鸡蛋单价，设置成0表示关闭。', '0', '3', '鸡蛋', '31400', '积分设置');
INSERT INTO `jieqi_system_configs` VALUES ('431', 'article', 'experience', '小说打赏总经验值', '100000', '控制打赏总经验值，设置成0表示关闭。', '0', '3', '经验', '31450', '积分设置');
INSERT INTO `jieqi_system_configs` VALUES ('432', 'article', 'vipvotenums', 'vip用户默认月票数', '1', '', '0', '3', '', '31500', '积分设置');
INSERT INTO `jieqi_system_configs` VALUES ('433', 'article', 'vipvoteegold', '当月虚拟币消费超过多少增加一个月票', '1000', '', '0', '3', '', '31550', '积分设置');
INSERT INTO `jieqi_system_configs` VALUES ('489', 'article', 'coverwidth', '封面小图宽度', '120', '', '0', '3', '', '21830', '文件参数');
INSERT INTO `jieqi_system_configs` VALUES ('490', 'article', 'coverheight', '封面小图高度', '150', '', '0', '3', '', '21840', '文件参数');
INSERT INTO `jieqi_system_configs` VALUES ('491', 'article', 'coverlwidth', '封面大图宽度', '240', '', '0', '3', '', '21850', '文件参数');
INSERT INTO `jieqi_system_configs` VALUES ('179', 'article', 'attachdir', '附件保存目录', 'attachment', '', '0', '1', '', '32767', '附件设置');
INSERT INTO `jieqi_system_configs` VALUES ('180', 'article', 'attachtype', '允许上传的附件类型', 'gif jpg jpeg png bmp swf', '多个附件用空格格开', '0', '1', '', '32767', '附件设置');
INSERT INTO `jieqi_system_configs` VALUES ('181', 'article', 'maxattachnum', '一次发文最多附件数', '5', '设成 0 就表示禁止附件上传', '0', '3', '', '32767', '附件设置');
INSERT INTO `jieqi_system_configs` VALUES ('182', 'article', 'maximagesize', '图片附件最大允许几K', '1000', '', '0', '3', '', '32767', '附件设置');
INSERT INTO `jieqi_system_configs` VALUES ('183', 'article', 'maxfilesize', '文件附件最大允许几K', '1000', '', '0', '3', '', '32767', '附件设置');
INSERT INTO `jieqi_system_configs` VALUES ('184', 'article', 'attachurl', '访问附件的URL', '', '附件用相对路径的话此处留空，否则用完整url，最后不带斜杠', '0', '1', '', '32767', '附件设置');
INSERT INTO `jieqi_system_configs` VALUES ('185', 'article', 'attachwater', '图片附件添加水印及位置', '0', '本功能需要 GD 库支持才能使用，对 JPG/PNG/GIF 格式的上传图片有效', '0', '7', 'a:11:{i:0;s:8:\"不加水印\";i:1;s:8:\"顶部居左\";i:2;s:8:\"顶部居中\";i:3;s:8:\"顶部居右\";i:4;s:8:\"中部居左\";i:5;s:8:\"中部居中\";i:6;s:8:\"中部居右\";i:7;s:8:\"底部居左\";i:8;s:8:\"底部居中\";i:9;s:8:\"底部居右\";i:10;s:8:\"随机位置\";}', '32810', '附件设置');
INSERT INTO `jieqi_system_configs` VALUES ('186', 'article', 'attachwimage', '附件水印图片文件', 'watermark.gif', '允许 JPG/PNG/GIF 格式，默认只需填文件名，放在 modules/article/images 目录下', '0', '1', '', '32820', '附件设置');
INSERT INTO `jieqi_system_configs` VALUES ('187', 'article', 'attachwtrans', '水印图片与原图片的融合度', '30', '范围为 1～100 的整数，数值越大水印图片透明度越低。', '0', '3', '', '32830', '附件设置');
INSERT INTO `jieqi_system_configs` VALUES ('188', 'article', 'attachwquality', 'jpeg图片质量', '90', '范围为 0～100 的整数，数值越大结果图片效果越好，但尺寸也越大。', '0', '3', '', '32840', '附件设置');
INSERT INTO `jieqi_system_configs` VALUES ('492', 'article', 'coverlheight', '封面大图高度', '300', '', '0', '3', '', '21860', '文件参数');
INSERT INTO `jieqi_system_configs` VALUES ('422', 'article', 'maketxtjs', '是否生成章节内容JS', '1', '用于章节阅读页JS调用内容的模式', '0', '9', 'a:2:{i:1;s:2:\"是\";i:0;s:2:\"否\";}', '20600', '文件参数');
INSERT INTO `jieqi_system_configs` VALUES ('423', 'article', 'usetxtjs', '是否启用章节内容JS', '1', '启用后生成阅读页时内容部分赋值JS调用，而不是图文内容。', '0', '9', 'a:2:{i:1;s:2:\"是\";i:0;s:2:\"否\";}', '20610', '文件参数');
INSERT INTO `jieqi_system_configs` VALUES ('424', 'article', 'txtjsdir', '章节内容JS目录', 'js', '', '0', '1', '', '20620', '文件参数');
INSERT INTO `jieqi_system_configs` VALUES ('425', 'article', 'txtjsurl', '访问章节内容JS的URL', '', '章节内容JS用相对路径的话此处留空，否则用完整url，最后不带斜杠', '0', '1', '', '20630', '文件参数');
INSERT INTO `jieqi_system_configs` VALUES ('426', 'article', 'maxrates', '小说评分最大值', '10', '', '0', '3', '', '30550', '积分设置');
INSERT INTO `jieqi_system_configs` VALUES ('427', 'article', 'dayrates', '每天可以评分次数', '1', '', '0', '3', '', '30560', '积分设置');
INSERT INTO `jieqi_system_configs` VALUES ('497', 'article', 'fakefulltop', '全本排行伪静态规则', '', '\r\n变量：<{$order}>（排序方式），<{$sortid}>（分类ID），<{$sortcode}>（分类英文代码），<{$page}>（页码），<{$page|subdirectory}>（页码子目录）。\r\n例如：/fulltop/<{$order}>/<{$page}>.html\r\n指向：/modules/article/toplist.php?fullflag=1&order=$order&page=$page', '0', '1', '', '21942', '文件参数');
INSERT INTO `jieqi_system_configs` VALUES ('494', 'article', 'fakeauthor', '作者专栏伪静态规则', '', '\r\n变量：<{$id}>（作者ID），<{$id|subdirectory}>（作者ID子目录）。。\r\n例如：/author/<{$id}>.html\r\n指向：/modules/article/authorpage.php?id=$id', '0', '1', '', '21980', '文件参数');
INSERT INTO `jieqi_system_configs` VALUES ('484', 'article', 'fakearticle', '小说目录页伪静态规则', '', '\r\n变量：<{$aid}>（小说ID），<{$acode}>（小说拼音代码），<{$aid|subdirectory}>（小说ID子目录）。\r\n例如：/html<{$aid|subdirectory}>/<{$aid}>/index.html\r\n指向：/modules/article/reader.php?aid=$aid\r\n例如：/html<{$aid|subdirectory}>/<{$acode}>/index.html\r\n指向：/modules/article/reader.php?acode=$acode', '0', '1', '', '21950', '文件参数');
INSERT INTO `jieqi_system_configs` VALUES ('485', 'article', 'fakechapter', '小说章节页伪静态规则', '', '\r\n变量：<{$aid}>（小说ID），<{$acode}>（小说拼音代码），<{$aid|subdirectory}>（小说ID子目录），<{$cid}>（章节ID）。\r\n例如：/html<{$aid|subdirectory}>/<{$aid}>/<{$cid}>.html\r\n指向：/modules/article/reader.php?aid=$aid&cid=$cid\r\n例如：/html<{$aid|subdirectory}>/<{$acode}>/<{$cid}>.html\r\n指向：/modules/article/reader.php?acode=$acode&cid=$cid', '0', '1', '', '21960', '文件参数');
INSERT INTO `jieqi_system_configs` VALUES ('495', 'article', 'fakefullsort', '全本分类伪静态规则', '', '\r\n变量：<{$sortid}>（分类ID），<{$sortcode}>（分类英文代码），<{$page}>（页码），<{$page|subdirectory}>（页码子目录）。\r\n例如：/fullsort/<{$sortid}>/<{$page}>.html\r\n指向：/modules/article/articlelist.php?fullflag=1&sortid=$sortid&page=$page', '0', '1', '', '21922', '文件参数');
INSERT INTO `jieqi_system_configs` VALUES ('493', 'article', 'fakefilter', '书库伪静态规则', '', '\r\n变量：<{$order}>（排序方式），<{$rgroup}>（所属频道），<{$sortid}>（分类ID），<{$size}>（作品字数），<{$update}>（更新时间），<{$initial}>（书名首字母），<{$progress}>（写作进度），<{$isvip}>（VIP状态），<{$page}>（页码）。\r\n例如：/<{$order}>_<{$sortid}>_<{$size}>_<{$update}>_<{$initial}>_<{$progress}>_<{$isvip}>_<{$page}>.html\r\n指向：/modules/article/articlefilter.php?order=$order&rgroup=$rgroup&sortid=$sortid&size=$size&update=$update&initial=$initial&progress=$progress&isvip=$isvip&page=$page', '0', '2', '', '21945', '文件参数');




INSERT INTO `jieqi_system_modules` (`mid`, `name`, `caption`, `description`, `version`, `vtype`, `lastupdate`, `weight`, `publish`, `modtype`) VALUES(1, 'article', '小说连载', '发布连载类型小说', 220, '', 0, 990, 1, 0);

INSERT INTO `jieqi_system_power` (`pid`, `modname`, `pname`, `ptitle`, `pdescription`, `pgroups`) VALUES(20, 'article', 'adminconfig', '管理参数设置', '', '');
INSERT INTO `jieqi_system_power` (`pid`, `modname`, `pname`, `ptitle`, `pdescription`, `pgroups`) VALUES(21, 'article', 'adminpower', '管理权限设置', '', '');
INSERT INTO `jieqi_system_power` (`pid`, `modname`, `pname`, `ptitle`, `pdescription`, `pgroups`) VALUES(22, 'article', 'authorpanel', '进入作家专栏', '', 'a:5:{i:0;s:1:"6";i:1;s:1:"7";i:2;s:1:"8";i:3;s:1:"9";i:4;s:2:"10";}');
INSERT INTO `jieqi_system_power` (`pid`, `modname`, `pname`, `ptitle`, `pdescription`, `pgroups`) VALUES(23, 'article', 'newarticle', '发表小说', '包括发表新小说、并且可以对自己的小说有增加章节、编辑章节和删除章节权限', 'a:5:{i:0;s:1:"6";i:1;s:1:"7";i:2;s:1:"8";i:3;s:1:"9";i:4;s:2:"10";}');
INSERT INTO `jieqi_system_power` (`pid`, `modname`, `pname`, `ptitle`, `pdescription`, `pgroups`) VALUES(24, 'article', 'transarticle', '转载小说', '', 'a:3:{i:0;s:1:"8";i:1;s:1:"9";i:2;s:2:"10";}');
INSERT INTO `jieqi_system_power` (`pid`, `modname`, `pname`, `ptitle`, `pdescription`, `pgroups`) VALUES(25, 'article', 'needcheck', '发表小说不需要审查', '', 'a:4:{i:0;s:1:"7";i:1;s:1:"8";i:2;s:1:"9";i:3;s:2:"10";}');
INSERT INTO `jieqi_system_power` (`pid`, `modname`, `pname`, `ptitle`, `pdescription`, `pgroups`) VALUES(26, 'article', 'manageallarticle', '管理他人小说', '', 'a:2:{i:0;s:1:"9";i:1;s:2:"10";}');
INSERT INTO `jieqi_system_power` (`pid`, `modname`, `pname`, `ptitle`, `pdescription`, `pgroups`) VALUES(27, 'article', 'delmyarticle', '删除自己小说', '', 'a:4:{i:0;s:1:"7";i:1;s:1:"8";i:2;s:1:"9";i:3;s:2:"10";}');
INSERT INTO `jieqi_system_power` (`pid`, `modname`, `pname`, `ptitle`, `pdescription`, `pgroups`) VALUES(28, 'article', 'delallarticle', '删除他人小说', '', 'a:1:{i:0;s:2:"10";}');
INSERT INTO `jieqi_system_power` (`pid`, `modname`, `pname`, `ptitle`, `pdescription`, `pgroups`) VALUES(29, 'article', 'manageallreview', '管理他人书评', '', 'a:2:{i:0;s:1:"9";i:1;s:2:"10";}');
INSERT INTO `jieqi_system_power` (`pid`, `modname`, `pname`, `ptitle`, `pdescription`, `pgroups`) VALUES(30, 'article', 'newdraft', '使用草稿箱', '允许作者将章节保存到草稿箱的权限', 'a:1:{i:0;s:2:"10";}');
INSERT INTO `jieqi_system_power` (`pid`, `modname`, `pname`, `ptitle`, `pdescription`, `pgroups`) VALUES(31, 'article', 'managesort', '管理小说分类', '管理小说类别', '');
INSERT INTO `jieqi_system_power` (`pid`, `modname`, `pname`, `ptitle`, `pdescription`, `pgroups`) VALUES(32, 'article', 'articleupattach', '发文允许上传附件', '', '');
INSERT INTO `jieqi_system_power` (`pid`, `modname`, `pname`, `ptitle`, `pdescription`, `pgroups`) VALUES(33, 'article', 'reviewupattach', '书评允许上传附件', '', '');
INSERT INTO `jieqi_system_power` (`pid`, `modname`, `pname`, `ptitle`, `pdescription`, `pgroups`) VALUES(34, 'article', 'viewuplog', '查看更新记录', '', 'a:3:{i:0;s:1:"8";i:1;s:1:"9";i:2;s:2:"10";}');
INSERT INTO `jieqi_system_power` (`pid`, `modname`, `pname`, `ptitle`, `pdescription`, `pgroups`) VALUES(35, 'article', 'newreview', '发表书评', '', 'a:8:{i:0;s:1:"3";i:1;s:1:"4";i:2;s:1:"5";i:3;s:1:"6";i:4;s:1:"7";i:5;s:1:"8";i:6;s:1:"9";i:7;s:2:"10";}');
INSERT INTO `jieqi_system_power` (`pid`, `modname`, `pname`, `ptitle`, `pdescription`, `pgroups`) VALUES(36, 'article', 'articlemodify', '修改小说统计', '', 'a:1:{i:0;s:2:"10";}');
INSERT INTO `jieqi_system_power` (`pid`, `modname`, `pname`, `ptitle`, `pdescription`, `pgroups`) VALUES(37, 'article', 'setwriter', '审核会员申请成为作者', '', 'a:2:{i:0;s:1:"9";i:1;s:2:"10";}');

INSERT INTO `jieqi_system_power` (`pid`, `modname`, `pname`, `ptitle`, `pdescription`, `pgroups`) VALUES(38, 'article', 'uptiming', '定时发表章节', '', '');
INSERT INTO `jieqi_system_power` (`pid`, `modname`, `pname`, `ptitle`, `pdescription`, `pgroups`) VALUES(54, 'forum', 'adminconfig', '管理参数设置', '', '');



INSERT INTO `jieqi_system_right` (`rid`, `modname`, `rname`, `rtitle`, `rdescription`, `rhonors`) VALUES(4, 'article', 'maxbookmarks', '书架最大收藏量', '', '');
INSERT INTO `jieqi_system_right` (`rid`, `modname`, `rname`, `rtitle`, `rdescription`, `rhonors`) VALUES(5, 'article', 'dayvotes', '每天允许推荐次数', '', '');
INSERT INTO `jieqi_system_right` (`rid`, `modname`, `rname`, `rtitle`, `rdescription`, `rhonors`) VALUES(6, 'article', 'dayrates', '每天允许评分次数', '', '');
