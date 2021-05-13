<?php

function jieqi_jt2ft($text)
{
	global $jieqi_jt;
	global $jieqi_ft;
	$slen = strlen($text);
	$tlen = strlen($jieqi_jt);
	$ret = "";

	for ($i = 0; $i < $slen; $i++) {
		if (128 < ord($text[$i])) {
			$j = 0;
			while (($j < ($tlen - 1)) && (($jieqi_jt[$j] != $text[$i]) || ($jieqi_jt[$j + 1] != $text[$i + 1]))) {
				$j += 2;
			}

			if ($j < ($tlen - 1)) {
				$ret .= $jieqi_ft[$j] . $jieqi_ft[$j + 1];
			}
			else {
				$ret .= $text[$i] . $text[$i + 1];
			}

			$i++;
		}
		else {
			$ret .= $text[$i];
		}
	}

	return $ret;
}

function jieqi_ft2jt($text)
{
	global $jieqi_jt;
	global $jieqi_ft;
	$slen = strlen($text);
	$tlen = strlen($jieqi_ft);
	$ret = "";

	for ($i = 0; $i < $slen; $i++) {
		if (128 < ord($text[$i])) {
			$j = 0;
			while (($j < ($tlen - 1)) && (($jieqi_ft[$j] != $text[$i]) || ($jieqi_ft[$j + 1] != $text[$i + 1]))) {
				$j += 2;
			}

			if ($j < ($tlen - 1)) {
				$ret .= $jieqi_jt[$j] . $jieqi_jt[$j + 1];
			}
			else {
				$ret .= $text[$i] . $text[$i + 1];
			}

			$i++;
		}
		else {
			$ret .= $text[$i];
		}
	}

	return $ret;
}

$jieqi_jt = "万与专业丛东丝丢两严丧个临为丽举义乌乐乔习乡书买乱争亏亘亚产亩亲亵亿仅从仑仓仪们价众优会伛伞伟传伤伥伦伧伪伫体佥侠侣侥侦侧侨侩侪侬俣俦俨俩俪俭债倾偬偻偾偿傥傧储傩儿兑兖党兰关兴兹养兽冁内冈册写军农冯冲决况冻净凄凉减凑凛凤凫凭凯击凿刍刘则刚创删别刭刹刽刿剀剂剐剑剥剧劝办务劢动励劲劳势勋匀匦匮区医华协单卖卢卤卧卫却卺厂厅历厉压厌厍厕厢厣厦厨厩县三参双发变叙叠叶号叹叽吓吕吗吨听启吴呐呒呓呕呖呗员呙呛呜咏咙咛响哑哒哓哔哕哗哙哜哝哟唛唠唢唤啧啬啭啮啸喷喽喾嗫嗳嘘嘤嘱噜嚣团园囱围囵国图圆圣圹场坏块坚坛坜坝坞坟坠垄垆垒垦垩垫垭垲埘埙埚堑堕墙壮声壳壶处备复够头夹夺奁奂奋奖奥妆妇妈妩妪妫姗娄娅娆娇娈娱娲娴婴婵婶媪嫒嫔嫱嬷孙学孪宁宝实宠审宪宫宽宾寝对寻导寿将尔尘尝尧尴尽层屉届属屡屦屿岁岂岖岗岘岚岛岭岿峄峡峤峥峦崂崃崭嵘嵛嵝巅巩巯币帅师帏帐帜带帧帮帱帻帼幂广庆庐庑库应庙庞废廪开异弃弑张弥弪弯弹强归当录彦彻径徕忆忏忧忾怀态怂怃怄怅怆怜总怼怿恋恒恳恶恸恹恺恻恼恽悦悫悬悭悯惊惧惨惩惫惬惭惮惯愠愤愦慑懑懒懔戆戋戏戗战戬户执扩扪扫扬扰抚抛抟抠抡抢护报担拟拢拣拥拦拧拨择挚挛挝挞挟挠挡挢挣挤挥捞损捡换捣据掳掴掷掸掺掼揽揿搀搁搂搅携摄摅摆摇摈摊撄撑撵撷撸撺擞攒敌敛数斋斓斩断无旧时旷昙昼显晋晓晔晕晖暂暧术机杀杂权条来杨杩极构枞枢枣枥枨枪枫枭柠柽栀栅标栈栉栊栋栌栎栏树栖样栾桠桡桢档桤桥桦桧桨桩梦检棂椁椟椠椤椭楼榄榇榈榉槛槟槠横樯樱橥橱橹橼檩欢欤欧歼殁殇残殒殓殚殡殴毁毂毕毙毡毵氇气氢氩氲氽汇汉汤汹沟没沣沤沥沦沧沩沪泞泪泶泷泸泺泻泼泽泾洁洒洼浃浅浆浇浈浊测浍济浏浑浒浓浔涛涝涞涟涠涡涣涤润涧涨涩淀渊渌渍渎渐渑渔渖渗温湾湿溃溅溆滗滚滞滟滠满滢滤滥滦滨滩潆潇潋潍潜潴澜濑濒灏灭灯灵灾灿炀炉炖炜炝点炼炽烁烂烃烛烟烦烧烨烩烫烬热焕焖焘爱爷牍牵牺犊状犷犹狈狞独狭狮狯狰狱狲猃猎猕猡猪猫献獭玑玛玮环现玺珏珐珑珲琏琐琼瑶瑷璎瓒瓯电画畅畲畴疖疗疟疠疡疮疯痈痉痒痨痪痫痹瘅瘗瘪瘫瘾瘿癞癣癫皑皱皲盏盐监盖盗盘眯着睁睐睑睾瞒瞩矫矶矾矿砀码砖砗砚砺砻砾础硕硖硗确硷碍碛碜碱礴礼祢祯祷祸禀禄禅离秃秆种秘积称秽税稣稳穑穷窃窍窑窜窝窥窦窭竖竞笃笋笔笕笺笼笾筚筛筝筹签简箦箧箨箩箪箫篑篓篮篱簖籁籴类粜粝粤粪粮糁紧絷纠纡红纣纤纥约级纨纩纪纫纬纭纯纰纱纲纳纵纶纷纸纹纺纽纾线绀绁绂练组绅细织终绉绊绋绌绍绎经绐绑绒结绕绗绘给绚绛络绝绞统绠绡绢绣绥绦继绨绩绪绫续绮绯绰绲绳维绵绶绷绸绺绻综绽绾绿缀缁缂缃缄缅缆缇缈缉缋缌缍缎缏缑缒缓缔缕编缗缘缙缚缛缜缝缟缠缡缢缣缤缥缦缧缨缩缪缫缬缭缮缯缱缲缳缴缵罂网罗罚罢罴羁羟羡翘耧耸耻聂聋职聍联聩聪肃肠肤肮肾肿胀胁胄胆胜胧胪胫胶脉脍脏脐脑脓脔脚脱脶脸腊腻腽腾膑舆舣舰舱舻艰艳艺节芈芗芜芦苁苇苈苋苌苍苎苏苹茎茏茑茔茕茧荆荚荛荜荞荟荠荡荣荤荥荦荧荨荩荪荫荭药莅莱莲莳莴莶获莸莹莺萝萤营萦萧萨葱蒇蒉蒋蒌蓝蓟蓠蓣蓥蓦蔷蔹蔺蔼蕲蕴薮藓虏虑虚虬虽虾虿蚀蚁蚂蚕蚬蛊蛎蛏蛮蛰蛱蛲蛳蛴蜕蜗蜡蝇蝈蝉蝎蝼蝾蠼衅衔补衬衮袄袅袜袭装裆裢裣裤裥褛褴见观规觅视觇览觉觊觋觌觎觏觐觑觞触觯誉誊计订讣认讥讦讧讨让讪讫训议讯记讲讳讴讵讶讷许讹论讼讽设访诀证诂诃评诅识诈诉诊诋诌词诎诏译诒诓诔试诖诗诘诙诚诛诜话诞诟诠诡询诣诤该详诧诨诩诫诬语诮误诰诱诲诳说诵诶请诸诹诺读诼诽课诿谀谁谂调谄谅谆谇谈谊谋谌谍谎谏谐谑谒谓谔谕谖谗谘谙谚谛谜谝谟谠谡谢谣谤谥谦谧谨谩谪谫谬谭谮谯谰谱谲谳谴谵谶贝贞负贡财责贤败账货质贩贪贫贬购贮贯贰贱贲贳贴贵贶贷贸费贺贻贼贽贾贿赀赁赂赃资赅赆赇赈赉赊赋赌赎赏赐赓赔赕赖赘赙赚赛赜赝赞赠赡赢赣赵赶趋趱趸跃跄跞践跷跸跹跻踊踌踪踬踯蹑蹒蹰蹿躏躜躯车轧轨轩轫转轭轮软轰轲轳轴轵轶轸轹轺轻轼载轾轿辁辂较辄辅辆辇辈辉辊辋辍辎辏辐辑输辔辕辖辗辘辙辚辞辩辫边辽达迁过迈运还这进远违连迟迩迳迹适选逊递逦逻遗遥邓邝邬邮邹邺邻郏郐郑郓郦郧郸酝酱酽酾酿释鉴銮錾钆钇针钉钊钋钌钍钏钐钒钓钔钕钗钙钛钜钝钞钟钠钡钢钣钤钥钦钧钨钩钪钫钬钭钮钯钰钱钲钳钴钵钶钸钹钺钻钼钽钾钿铀铁铂铃铄铅铆铈铉铊铋铌铍铎铐铑铒铕铖铗铙铛铜铝铟铠铡铢铣铤铥铧铨铩铪铫铬铭铮铯铰铱铲铳铴铵银铷铸铹铺铼铽链铿销锁锂锄锅锆锇锈锉锊锋锌锐锑锒锓锔锕锖锗错锚锛锞锟锡锢锣锤锥锦锩锬锭键锯锰锱锲锴锵锶锷锸锹锺锻锼锾镀镁镂镄镆镇镉镊镌镍镏镐镑镒镓镔镕镖镗镘镙镛镜镝镞镟镡镣镤镦镧镨镪镫镬镭镯镰镱镳镶长门闩闪闫闭问闯闰闱闲闳间闵闶闷闸闹闺闻闼闽闾阀阁阂阃阄阅阆阈阉阊阋阌阍阎阏阐阑阒阔阕阖阗阙阚队阳阴阵阶际陆陇陈陉陕陧陨险随隐隶隽难雏雠雳雾霁霭靓静靥鞑鞯韦韧韩韪韫韬韵页顶顷顸项顺须顼顽顾顿颀颁颂颃预颅领颇颈颉颊颌颍颏颐频颓颔颖颗题颚颛颜额颞颟颠颡颢颤颦颧风飑飒飓飕飘飙飞飨餍饥饧饨饩饪饫饬饭饮饯饰饱饲饴饵饶饷饺饼饽饿馀馁馄馅馆馈馊馋馍馏馐馑馒馔马驭驮驯驰驱驳驴驵驶驷驸驹驺驻驼驽驾驿骀骁骂骄骅骆骇骈骊骋验骏骐骑骒骓骖骗骘骚骛骜骝骞骟骠骡骢骣骤骥骧髅髋髌鬓魇魉鱼鱿鲁鲂鲅鲈鲋鲍鲎鲐鲑鲒鲔鲕鲚鲛鲜鲞鲟鲠鲡鲢鲣鲤鲥鲦鲧鲨鲩鲫鲭鲮鲰鲱鲲鲳鲵鲶鲷鲸鲻鲽鳃鳄鳅鳆鳇鳌鳍鳎鳏鳐鳓鳔鳕鳖鳗鳜鳝鳞鳟鳢鸟鸠鸡鸢鸣鸥鸦鸨鸩鸪鸫鸬鸭鸯鸱鸲鸳鸵鸶鸷鸸鸹鸺鸽鸾鸿鹁鹂鹃鹄鹅鹆鹇鹈鹉鹊鹌鹎鹏鹑鹕鹗鹘鹜鹞鹣鹤鹦鹧鹨鹩鹪鹫鹬鹭鹰鹳鹾麦麸麽黄黉黩黪黾鼋鼍鼹齐齑齿龀龃龄龅龆龇龈龉龊龋龌龙龚龛龟翱卜痴虫丑迭斗范丰干皋硅柜后划伙几荐秸杰夸里帘凌么霉捻扑朴扦钎晒尸抬涂瓮锨咸彝佣涌游吁御愿岳云灶扎札筑庄致么只凶准里余泄脏参尝尝冲当发复复干馆汇汇获饥迹尽卷罗历历仑弥仆铺签术台台台台叹坛团为纤线线绣于赞证";
$jieqi_ft = "万与专业丛东丝丢两严丧个临为丽举义乌乐乔习乡书买乱争亏亘亚产亩亲亵亿仅从仑仓仪们价众优会伛伞伟传伤伥伦伧伪伫体佥侠侣侥侦侧侨侩侪侬俣俦俨俩俪俭债倾偬偻偾偿傥傧储傩儿兑兖党兰关兴兹养兽冁内冈册写军农冯冲决况冻净凄凉减凑凛凤凫凭凯击凿刍刘则刚创删别刭刹刽刿剀剂剐剑剥剧劝办务劢动励劲劳势勋匀匦匮区医华协单卖卢卤卧卫却卺厂厅历厉压厌厍厕厢厣厦厨厩县叁参双发变叙叠叶号叹叽吓吕吗吨听启吴呐呒呓呕呖呗员呙呛呜咏咙咛响哑哒哓哔哕哗哙哜哝哟唛唠唢唤啧啬啭啮啸喷喽喾嗫嗳嘘嘤嘱噜嚣团园囱围囵国图圆圣圹场坏块坚坛坜坝坞坟坠垄垆垒垦垩垫垭垲埘埙埚堑堕墙壮声壳壶处备复够头夹夺奁奂奋奖奥妆妇妈妩妪妫姗娄娅娆娇娈娱娲娴婴婵婶媪嫒嫔嫱嬷孙学孪宁宝实宠审宪宫宽宾寝对寻导寿将尔尘尝尧尴尽层屉届属屡屦屿岁岂岖岗岘岚岛岭岿峄峡峤峥峦崂崃崭嵘嵛嵝巅巩胇币帅师帏帐帜带帧帮帱帻帼幂广庆庐庑库应庙庞废廪开异弃弑张弥弪弯弹强归当录彦彻径徕忆忏忧忾怀态怂怃怄怅怆怜总怼怿恋恒恳恶恸恹恺恻恼恽悦悫悬悭悯惊惧惨惩惫惬惭惮惯愠愤愦慑懑懒檩戆戋戏戗战戬户执扩扪扫扬扰抚抛抟抠抡抢护报担拟拢拣拥拦拧拨择挚挛挝挞挟挠挡挢挣挤挥捞损捡换捣据掳掴掷掸掺掼揽揿搀搁搂搅携摄摅摆摇摈摊撄撑撵撷撸撺擞攒敌敛数斋斓斩断无旧时旷昙昼显晋晓晔晕晖暂暧术机杀杂权条来杨杩极构枞枢枣枥枨枪枫枭柠柽栀栅标栈栉栊栋栌栎栏树栖样栾桠桡桢档桤桥桦桧桨桩梦检棂椁椟椠椤椭楼榄榇榈榉槛槟槠横樯樱櫫橱橹橼檩欢欤欧歼殁殇残殒殓殚殡殴毁毂毕毙毡毵氇气氢氩氲汆汇汉汤汹沟没沣沤沥沦沧沩沪泞泪泶泷泸泺泻泼泽泾洁洒洼浃浅浆浇浈浊测浍济浏浑浒浓浔涛涝涞涟涠涡涣涤润涧涨涩淀渊渌渍渎渐渑渔渖渗温湾湿溃溅漵滗滚滞灩滠满滢滤滥滦滨滩潆潇潋潍潜瀦澜濑濒灏灭灯灵灾灿炀炉炖炜炝点炼炽烁烂烃烛烟烦烧烨烩烫烬热焕焖焘爱爷牍牵牺犊状犷犹狈狞独狭狮狯狰狱狲猃猎猕猡猪猫献獭玑玛玮环现玺珏珐珑珲琏琐琼瑶瑷璎瓒瓯电画畅畲畴疖疗疟疠疡疮疯痈痉痒痨痪痫痹瘅瘗瘪瘫瘾瘿癞癣癫皑皱皲盏盐监盖盗盘眯着睁睐睑睾瞒瞩矫矶矾矿砀码砖砗砚砺砻砾础硕硖硗确硷碍碛碜硷礡礼檷祯祷祸禀禄禅离秃秆种秘积称秽税稣稳穑穷窃窍窑窜窝窥窦窭竖竞笃笋笔笕笺笼笾筚筛筝筹签简箦箧箨箩箪箫篑篓篮篱簖籁籴类粜粝粤粪粮糁紧絷纠纡红纣纤纥约级纨纩纪纫纬纭纯纰纱纲纳纵纶纷纸纹纺纽纾线绀绁绂练组绅细织终绉绊绋绌绍绎经绐绑绒结绕绗绘给绚绦络绝绞统绠绡绢绣绥绦继绨绩绪绫续绮绯绰绲绳维绵绶绷绸绺绻综绽绾绿缀缁缂缃缄缅缆缇缈缉缋缌缍缎缏缑缒缓缔缕编缗缘缙缚缛缜缝缟缠缡缢缣缤缥缦缧缨缩缪缫缬缭缮缯缱缲缳缴缵罂网罗罚罢罴羁羟羡翘耧耸耻聂聋职聍联聩聪肃肠肤肮肾肿胀胁胄胆胜胧胪胫胶脉脍脏脐脑脓脔脚脱脶脸腊腻腽腾膑舆舣舰舱舻艰艳艺节芈芗芜芦苁苇苈苋苌苍苎苏苹茎茏茑茔茕茧荆荚荛荜荞荟荠荡荣荤荥荦荧荨荩荪荫荭药莅莱莲莳莴莶获莸莹莺萝萤营萦萧萨葱蒇蒉蒋蒌蓝蓟蓠蓣蓥蓦蔷蔹蔺蔼蕲蕴薮藓虏虑虚虯虽虾虿蚀蚁蚂蚕蚬蛊蛎蛏蛮蛰蛱蛲蛳蛴蜕蜗蜡蝇蝈蝉蠍蝼蝾蠷衅衔补衬衮袄袅袜袭装裆裢裣裤襉褛褴见观规觅视觇览觉觊觋觌觎觏觐觑觞触觯誉誊计订讣认讥讦讧讨让讪讫训议讯记讲讳讴讵讶讷许讹论讼讽设访诀证诂诃评诅识诈诉诊诋诌词诎诏译诒诓诔试诖诗诘诙诚诛诜话诞诟诠诡询诣诤该详诧诨诩诫诬语诮误诰诱诲诳说诵诶请诸诹诺读诼诽课诿谀谁谂调谄谅谆谇谈谊谋谌谍谎谏谐谑谒谓谔谕谖谗谘谙谚谛谜谝谟谠谡谢谣谤谥谦谧谨谩谪譾谬谭谮谯谰谱谲谳谴谵谶贝贞负贡财责贤败账货质贩贪贫贬购贮贯贰贱贲贳贴贵贶贷贸费贺贻贼贽贾贿赀赁赂赃资赅赆赇赈赉赊赋赌赎赏赐赓赔赕赖赘赙赚赛赜赝赞赠赡赢赣赵赶趋趱趸跃跄跞践跷跸跹跻踊踌踪踬踯蹑蹒蹰蹿躏躜躯车轧轨轩轫转轭轮软轰轲轳轴轵轶轸轹轺轻轼载轾轿辁辂较辄辅辆辇辈辉辊辋辍辎辏辐辑输辔辕辖辗辘辙辚辞辩辫边辽达迁过迈运还这进远违连迟迩迳迹适选逊递逦逻遗遥邓邝邬邮邹邺邻郏郐郑郓郦郧郸酝酱酽酾酿释监銮錾钆钇针钉钊钋钌钍钏钐钒钓钔钕钗钙钛钜钝钞钟钠钡钢钣钤钥钦钧钨钩钪钫钬钭钮钯钰钱钲钳钴钵钶钸钹钺钻钼钽钾钿铀铁铂铃铄铅铆铈铉铊铋铌铍铎铐铑铒铕铖铗铙铛铜铝铟铠铡铢铣铤铥铧铨铩铪铫铬铭铮铯铰铱铲铳铴铵银铷铸铹铺铼铽链铿销锁锂锄锅锆锇锈锉锊锋锌锐锑锒锓锔锕锖锗错锚锛锞锟锡锢锣锤锥锦锩锬锭键锯锰锱锲锴锵锶锷锸锹锺锻锼锾镀镁镂镄镆镇镉镊镌镍镏镐镑镒镓镔熔镖镗镘镙镛镜镝镞镟镡镣镤镦镧镨镪镫镬镭镯镰镱镳镶长门闩闪闫闭问闯闰闱闲闳间闵闶闷闸闹闺闻闼闽闾阀阁阂阃阄阅阆阈阉阊阋阌阍阎阏阐阑阒阔阕阖阗阙阚队阳阴阵阶际陆陇陈陉陕陧陨险随隐隶隽难雏雠雳雾霁霭靓静靥鞑鞯韦韧韩韪韫韬韵页顶顷顸项顺须顼顽顾顿颀颁颂颃预颅领颇颈颉颊颌颍颏颐频颓颔颖颗题颚颛颜额颞颟颠颡颢颤颦颧风飑飒飓飕飘飙飞飨餍饥饧饨饩饪饫饬饭饮饯饰饱饲饴饵饶饷饺饼饽饿余馁馄馅馆馈馊馋馍馏馐馑馒馔马驭驮驯驰驱驳驴驵驶驷驸驹驺驻驼驽驾驿骀骁骂骄骅骆骇骈骊骋验骏骐骑骒骓骖骗骘骚骛骜骝骞骟骠骡骢骣骤骥骧髅髋髌鬓魇魉鱼鱿鲁鲂鱍鲈鲋鲍鲎鲐鲑鲒鲔鲕鲚鲛鲜鯗鲟鲠鲡鲢鲣鲤鲥鲦鲧鲨鲩鲫鲭鲮鲰鲱鲲鲳鲵鲶鲷鲸鲻鲽鳃鳄鳅鳆鳇鳌鳍鳎鳏鳐鳓鳔鳕鳖鳗鳜鳝鳞鳟鳢鸟鸠鸡鸢鸣鸥鸦鸨鸩鸪鸫鸬鸭鸯鸱鸲鸳鸵鸶鸷鸸鸹鸺鸽鸾鸿鹁鹂鹃鹄鹅鹆鹇鹈鹉鹊鹌鹎鹏鹑鹕鹗鹘鹜鹞鹣鹤鹦鹧鹨鹩鹪鹫鹬鹭鹰鹳鹾麦麸麽黄黉黩黪黾鼋鼍鼹齐齑齿龀龃龄龅龆龇龈龉龊龋龌龙龚龛龟翺卜痴虫丑叠斗范丰干臯矽柜後划夥几荐稭杰夸里帘淩麽霉捻扑朴扡釺晒屍擡涂瓮鍁咸彜佣涌游吁御愿岳云竈紮劄筑庄致麽只凶准里余泄脏蔘甞嚐冲当发复覆干舘汇滙获饥蹟尽卷罗历厤仑弥仆舖签术台台枱台叹坛团爲纤缐綫綉於赞证";

?>