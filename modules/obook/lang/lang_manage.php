<?php
$jieqiLang['obook']['manage']=1; //表示本语言包已经包含

$jieqiLang['obook']['obook_not_exists']='对不起，该电子书不存在！';
//chapterset.php chaptersort.php chapterstat.php obookmanage.php obookset.php
$jieqiLang['obook']['chapter_not_exists']='对不起，该电子书章节不存在！';
$jieqiLang['obook']['noper_manage_obook']='对不起，您无权管理本电子书！';
$jieqiLang['obook']['noper_delete_obook']='对不起，您无权删除本电子书！';
$jieqiLang['obook']['noper_delete_chapter']='对不起，您无权删除本章节！';
$jieqiLang['obook']['noper_set_sale']='对不起，您无权设置本章节销售状态！';
$jieqiLang['obook']['chapter_set_success']='处理成功，您可以继续其他操作！';
$jieqiLang['obook']['chapter_sort_success']='恭喜您，您选择的电子书已经重新排序！';
$jieqiLang['obook']['sort_par_error']='对不起，参数错误，排序无法进行！';
$jieqiLang['obook']['not_find_chapter']='对不起，该章节不存在，可能已被删除！';
$jieqiLang['obook']['obook_set_success']='处理成功，您可以继续其他操作！';

//obookmanage.php
$jieqiLang['obook']['obook_info']='电子书信息';
$jieqiLang['obook']['new_volume']='新建分卷';
$jieqiLang['obook']['new_chapter']='增加章节';
$jieqiLang['obook']['edit_obook']='编辑电子书';
$jieqiLang['obook']['obook_unsale_confirm']='确实要将该电子书下架么？';
$jieqiLang['obook']['unsale_obook']='电子书下架';
$jieqiLang['obook']['obook_delete_confirm']='确实要删除该电子书么？';
$jieqiLang['obook']['delete_obook']='删除电子书';
$jieqiLang['obook']['manage_edit_tag']='[编]';
$jieqiLang['obook']['manage_edit_tagnote']='编辑本章节';
$jieqiLang['obook']['chapter_unsale_confirm']='确实要取消该章节销售状态么？';
$jieqiLang['obook']['manage_unsale_tag']='[<span class="hottext">隐</a>]';
$jieqiLang['obook']['manage_unsale_tagnote']='取消该章节的销售状态';
$jieqiLang['obook']['chapter_sale_confirm']='确实要将该章节设置成销售状态么？';
$jieqiLang['obook']['manage_sale_tag']='[售]';
$jieqiLang['obook']['manage_sale_tagnote']='将该章节设置成销售状态';
$jieqiLang['obook']['chapter_delete_confirm']='确实要删除该章节么？';
$jieqiLang['obook']['manage_delete_tag']='[删]';
$jieqiLang['obook']['manage_delete_tagnote']='删除本章节';
$jieqiLang['obook']['volume_delete_confirm']='确实要删除该分卷么？';
$jieqiLang['obook']['chapter_publish_confirm']='确实要发布成公众章节么？';
$jieqiLang['obook']['manage_publish_tagnote']='取消该章节销售状态并发布成公众章节';
$jieqiLang['obook']['manage_publish_tag']='[公]';
$jieqiLang['obook']['chapter_sort']='章节排序';
$jieqiLang['obook']['choose_chapter']='选择章节';
$jieqiLang['obook']['chapter_move_to']='移动到';
$jieqiLang['obook']['chapter_top_sort']='--最前面--';
$jieqiLang['obook']['chapter_after_sort']='之后';
$jieqiLang['obook']['sort_confirm']='确 定';
$jieqiLang['obook']['not_link_article']='对不起，本电子书没有关联公众小说！';
$jieqiLang['obook']['obook_isnot_sign']='对不起，本书尚未签约！';
$jieqiLang['obook']['obook_isnot_vipsign']='对不起，本书尚未VIP签约！';
$jieqiLang['obook']['add_obook_failure']='对不起，创建电子书失败，请联系网站管理员！';

//admin/batchrepack.php
$jieqiLang['obook']['repack_start_id']='请输入正确的起始序号！';
$jieqiLang['obook']['batch_repack_success']='恭喜您，全部电子书处理完成！<br /><br /><a href="%s">点击这里返回起始页面</a>';
$jieqiLang['obook']['batch_repack_doing']='正在处理电子书《%s》<br />起始时间：%s<br />结束时间：%s<br />当前时间：%s<br />当前序号：%s<br />请耐心等待......';
$jieqiLang['obook']['repack_success_next']='恭喜您，本电子书已经重新生成，系统将自动处理下一篇！';
$jieqiLang['obook']['repack_use_id']='电子书批量生成（按序号）';
$jieqiLang['obook']['repack_start_id']='起始电子书序号';
$jieqiLang['obook']['repack_end_id']='结束电子书序号';
$jieqiLang['obook']['repack_start_button']='开始生成';
$jieqiLang['obook']['repack_use_time']='电子书批量生成（按更新时间）';
$jieqiLang['obook']['repack_start_time']='起始时间';
$jieqiLang['obook']['repack_end_time']='结束时间';
$jieqiLang['obook']['repack_time_format']='时间格式举例：2005-01-23 23:06:30';
$jieqiLang['obook']['repack_next_html']='<html><head><title>电子书批量生成</title><meta http-equiv="Content-Type" content="text/html; charset=%s"></head><body><br /><br />&nbsp;&nbsp;%s<br /><br /><a href="%s">如浏览器不能自动转换，点击这里生成下一篇。</a>	<script type="text/javascript">document.location="%s";</script></body></html>';
$jieqiLang['obook']['article_batch_repack']='电子书批量生成';
$jieqiLang['obook']['repack_fromto_id']='正在处理电子书《%s》<br />本文序号：%s<br />结束序号：%s<br />请耐心等待......';
$jieqiLang['obook']['repack_noid_next']='该序号的电子书不存在，系统将自动处理下一篇！';
$jieqiLang['obook']['need_time_format']='请输入正确的起始时间！';

?>