<?php
echo '<div style="width:90%;margin:auto auto;">

<table width="100%" class="grid">
<caption>�������⼰ʹ�ü���</caption>
<tr>
<td>
<ul class="ulnav">
<li>&bull; <a href="#tip1">����ģ���ļ�˵��</a></li>
<li>&bull; <a href="#tip2">���������ļ�˵��</a></li>
<li>&bull; <a href="#tip3">��ϵͳ���űض�</a></li>
<li>&bull; <a href="#tip4">���������˺ŵ�½�ӿ�</a></li>
<li>&bull; <a href="#tip5">����Ucenter�ӿ�</a></li>
</ul>
</td>
<td>
<ul class="ulnav">
<li>&bull; <a href="#tip6">�����Զ���ҳ��</a></li>
<li>&bull; <a href="#tip7">Զ�̵�������</a></li>
<li>&bull; <a href="#tip8">���Ӻ͹������</a></li>
<li>&bull; <a href="#tip9">�������ӻ������÷���</a></li>
<li>&bull; <a href="#tip10">�޸�С˵���</a></li>
</ul>
</td>
</tr>
</table>

<div class="block">
<div class="blocktitle"><a name="tip1">����ģ���ļ�˵��</a></div>
<div class="blockcontent">
&nbsp;&nbsp;&nbsp;&nbsp;1��ϵͳ��һ��������ģ��theme.html��������ͳһ��ҳͷҳβ�����鲼�֡�Ĭ���� /themes/****Ŀ¼�£�**** ��ָ���ں�̨ϵͳ��������ķ�����ƣ����� book���Ǿ�ʹ�� themes/book/theme.html���ģ�塣ģ��Ϊhtml��ʽ�� {&#63; �� &#63;}֮������Ϊģ���еı������߲�����䡣<br />
&nbsp;&nbsp;&nbsp;&nbsp;2������ģ��Ŀ¼�������£�<br />
ϵͳ����ģ���� /templates Ŀ¼�£�ģ�鹦��ģ���� /modules/ģ��Ŀ¼/templates�£���С˵ϵͳ�� /modules/article/templates����̳�� /modules/forum/templates��������ģ�������ģ����blocks����Ŀ¼�£�����С�����ģ���� /modules/article/templates/blocks<br />
&nbsp;&nbsp;&nbsp;&nbsp;3����������ģ��˵����<br />
��ҳ(/index.php) - /themes/�������/theme.html (������ҳ��ʹ������ģ��)<br />
С˵��Ϣҳ(/modules/article/articleinfo.php) - /modules/article/templates/articleinfo.html<br />
С˵�����б�(/modules/article/index.php) - /modules/article/templates/articlelist.html<br />
С˵���а�(/modules/article/toplist.php) - /modules/article/templates/toplist.html<br />
�Ķ�ҳ��Ŀ¼ҳ - /modules/article/templates/index.html
�Ķ�ҳ���½�ҳ - /modules/article/templates/style.html
ȫ���Ķ�ҳ - /modules/article/templates/fulltext.html
</div>
</div>

<div class="block">
<div class="blocktitle"><a name="tip2">���������ļ�˵��</a></div>
<div class="blockcontent">
&nbsp;&nbsp;&nbsp;&nbsp;1��ϵͳ���� - ������ /configs/define.php
������Ĳ�������̨ϵͳ�������Ӧ�������Ϊϵͳ���ô����޷������̨������Ҫ�ֹ��޸ı��ļ������ļ����漸����Ҫ�������£�<br />
JIEQI_URL - ��վ��·�������Բ��Ҳ�������ó���վ·�������治��"/"���� http://www.jieqi.com<br />
JIEQI_DB_TYPE - ���ݿ����ͣ�Ŀǰ������ mysql<br />
JIEQI_DB_CHARSET - ���ݿ���룬����ʵ�����ݿ�������ã��� gbk<br />
JIEQI_DB_PREFIX - ���ݱ�ǰ׺��Ŀǰ������ jieqi<br />
JIEQI_DB_HOST - ���ݿ���������֣�Ĭ�� localhost<br />
JIEQI_DB_USER - ���ݿ��û���<br />
JIEQI_DB_PASS - ���ݿ��û�����<br />
JIEQI_DB_NAME - ���ݿ�����<br />
JIEQI_IS_OPEN - ��վ�Ƿ񿪷ţ�1 ��ʾ���ţ�0 ��ʾ�ر�<br />
&nbsp;&nbsp;&nbsp;&nbsp;2����̨���������� - ϵͳ���ܵ����������ļ�Ϊ /configs/adminmenu.php ��ÿ��ģ��ĺ�̨���������ļ�Ϊ /configs/ģ��Ŀ¼��/adminmenu.php<br />
&nbsp;&nbsp;&nbsp;&nbsp;3��С˵�����޸� - ���ֹ��༭�����ļ�<br />
/configs/article/sort.php<br />
</div>
</div>

<div class="block">
<div class="blocktitle"><a name="tip3">��ϵͳ���űض�</a></div>
<div class="blockcontent">
&nbsp;&nbsp;&nbsp;&nbsp;ϵͳװ�ú��ھ��巢����ǰ���û���Ҫ�����¼������飺<br />
&nbsp;&nbsp;&nbsp;&nbsp;1�������̨ϵͳ�������棬��ÿ��ϵͳ�������������£������档<br />
&nbsp;&nbsp;&nbsp;&nbsp;2����̨ϵͳ��ÿ��ģ��Ĳ������ü�鲢���档<br />
&nbsp;&nbsp;&nbsp;&nbsp;3�������̨�û����������������ʵ����Ҫ���û��ֳɼ����û��顣<br />
&nbsp;&nbsp;&nbsp;&nbsp;4���û���ȷ�Ϻ�����ϵͳ��ÿ��ģ���Ȩ�޹�����<br />
&nbsp;&nbsp;&nbsp;&nbsp;5�������̨��ͷ�ι�������������ʵ����Ҫ����ͷ�Ρ�<br />
&nbsp;&nbsp;&nbsp;&nbsp;6��ͷ�����ú�֮������ϵͳ��ÿ��ģ���Ȩ�����á�<br />
&nbsp;&nbsp;&nbsp;&nbsp;7����С˵����ϵͳ�ģ���Ԥ�����ú�С˵���ࡣ<br />
&nbsp;&nbsp;&nbsp;&nbsp;8������ʵ����Ҫ������վģ�塣<br />
</div>
</div>

<div class="block">
<div class="blocktitle"><a name="tip4">���������˺ŵ�½�ӿ�</a></div>
<div class="blockcontent">
����1.8���ϵİ汾��֧��QQ������΢�����Ա��˺ŵ�һ����¼����Ҫʹ����Щ���ܣ�Ҫ�ֱ����Ӧ��վ�����¼�ӿڵķ���<br />
&nbsp;&nbsp;&nbsp;&nbsp;�����֮����Ի��һ���ӿ�ID��ͨѶ��Կ��Ȼ���޸ı�վ/api/�ӿ���/config.ini.php���ú�������Ϣ����ʹ�á�
</div>
</div>

<div class="block">
<div class="blocktitle"><a name="tip5">����Ucenter�ӿ�</a></div>
<div class="blockcontent">
&nbsp;&nbsp;&nbsp;&nbsp;1����װ��Ucenter����˳���һ����Discuz�Ļ�Ĭ�а�����<br />
&nbsp;&nbsp;&nbsp;&nbsp;2�����������ԭ���� /include/funuser.php ���ñ��ݣ���������� funuser_default.php<br />
Ȼ��Ѹ�Ŀ¼�� funuser_ucenter.php ������ funuser.php<br />
&nbsp;&nbsp;&nbsp;&nbsp;3���༭JIEQI CMS�е� /api/ucenter/config.inc.php<br />
   ���ʹ���������ӣ����ú���ز���<br />
   ͨ����Կ�����Լ������趨����Ucenter��̨����Ҫ��ͬ<br />
   UCenter ���ݿ��ǰ׺���������ݿ��������ݱ�ǰ׺�������ʵ��ʹ�ö�Ӧ<br />
   UCenter �� URL ��ַ����������ȷ<br />
   <span class="hot">ע��:��Ŀ¼�µ� data ��Ŀ¼Ҫ��д���ǽӿڵĻ�������Ŀ¼��</span><br />
&nbsp;&nbsp;&nbsp;&nbsp;4������Ucenter��̨����Ӧ�ù������㡰������Ӧ�á�<br />
   ѡ��װ��ʽ: �Զ��尲װ<br />
   Ӧ�����ƣ�����վ�������� JIEQI CMS<br />
   Ӧ�õ� URL����JIEQI CMS��ַ���� http://www.jieqi.com<br />
   Ӧ�� IP: һ��������գ������ó�JIEQI CMS������ip<br />
   ͨ����Կ: �Լ�����һ������<br />
   Ӧ������: ѡ����<br />
   Ӧ�õ�����·��: ����<br />
   �鿴��������ҳ���ַ: /userinfo.php?id=%s<br />
   Ӧ�ýӿ��ļ�����: uc.php<br />
   ��ǩ������ʾģ��: ����<br />
   ��ǩģ����˵��: ����<br />
   �Ƿ���ͬ����¼: ��<br />
   �Ƿ����֪ͨ: ��<br /><br />
   Ȼ���ύ<br />
   ��ʱ���ٵ�Ӧ�ù����������ʾͨѶ�ɹ��������ú���<br />
</div>
</div>

<div class="block">
<div class="blocktitle"><a name="tip6">�����Զ���ҳ��</a></div>
<div class="blockcontent">
�Զ���ҳ����ָ�½�һ��php����Ȼ����ö�Ӧ��ģ���ģ�壬��ʵ�ֶ���ҳ����ʾ��һ��������վ��ҳ������Ŀ��ҳ��<br />���Բο��ļ�/custom.php��д������Ҫ�������£�<br />
&nbsp;&nbsp;&nbsp;&nbsp;1��������ҳ���������php�����ļ����� /configs/custom.php����������ļ�������������д���ɲο���̨�����������ÿ������ĵ��ò�����<br />
&nbsp;&nbsp;&nbsp;&nbsp;2��׼��һ��htmlҳ����Ϊģ���ļ������� /templates/custom.html ģ�������úø���������ʾλ��<br />
&nbsp;&nbsp;&nbsp;&nbsp;3��ģ��/custom.php�����ú���Ҫ��ģ������������ļ����ɡ�<br /><br />
</div>
</div>

<div class="block">
<div class="blocktitle"><a name="tip7">Զ�̵�������</a></div>
<div class="blockcontent">
&nbsp;&nbsp;&nbsp;&nbsp;�������Ҫ��һ̨��������Զ�̵�����һ̨�������ϵ����飬����ʹ��js�����á�
ÿ�������js����д������ο������������ġ�Զ�̵���js����
</div>
</div>

<div class="block">
<div class="blocktitle"><a name="tip8">���Ӻ͹������</a></div>
<div class="blockcontent">
&nbsp;&nbsp;&nbsp;&nbsp;1��ȫվͨ�����<br />
�ֵײ�ͨ���Ͷ���ͨ�������������ں�̨��ϵͳ�������棬������ݿ�����ʾ��ȫվ���ж�̬ҳ�档<br />
&nbsp;&nbsp;&nbsp;&nbsp;2����ҳ���<br />
��ҳ����ͳһ�Ķ����͵ײ����м䶼����һ�������鹹�ɡ��û������ں�̨����������������ĳ�������Ƿ���ʾ����ʾλ�á�ͬ���ģ��� ��Ҫ���ӹ�棬���߹���֮�����飬Ҳ�������������������һ���Զ������飬�Լ�������룬ѡ���λ�ñ��漴�ɡ�<br />
ע�⣺ÿ�����鶼��һ����ţ���Ŵ�С��ʾ����˳�򣬲�ͬ����֮����Ų�Ҫ�ظ���<br />
&nbsp;&nbsp;&nbsp;&nbsp;3���Ķ�ҳ����<br />
�Ķ�ҳ����Ϊ�Ǿ�̬��html�����Թ�涼ͨ������jsʵ�ֵġ�Ĭ�ϵ��Ķ�ҳ��ģ�����£�<br />
a��Ŀ¼ҳ��ģ��<br />
modules/article/templates/index.html ����Ķ����͵ײ���Ĭ���������������js�ֱ��� configs/article/indextop.js ��configs/article/indexbottom.js��<br />
b���½��Ķ�ҳ��ģ��<br />
modules/article/templates/style.html ����Ķ����͵ײ���Ĭ���������������js�ֱ��� configs/article/pagetop.js ��configs/article/pagebottom.js��<br />
c��ȫ���Ķ�ģ��<br />
modules/article/templates/fulltext.html ����Ķ����͵ײ���Ĭ���������������js�ֱ��� configs/article/fulltop.js ��configs/article/fullbottom.js<br />
ע�⣺����ģ���û��������޸ģ�ģ���޸ĺ������ǰ�Ѿ����ɵ�html�������ں�̨����ʹ��С˵�������ɹ��ܡ�<br />
&nbsp;&nbsp;&nbsp;&nbsp;4���������<br />
����û���Ҫ��һЩ����ҳ����ù�棬����Ҫֱ���ҵ����ҳ���ģ�壬ͨ���޸�ģ��ʵ�֡�<br />
</div>
</div>

<div class="block">
<div class="blocktitle"><a name="tip9">�������ӻ������÷���</a></div>
<div class="blockcontent">
&nbsp;&nbsp;&nbsp;&nbsp;������Ҫ���ú���ز������ں�̨ϵͳ��������Ĳ������ã����úá�ÿ�ε�������֡��͡�ÿ�������Ч������������������档Ȼ����ݲ�ͬ�Ĺ�����ò�ͬ�Ĵ��롣<br /><br />

ϵͳͳ�ƹ�������ֵĳ���Ϊ��Ŀ¼�µ� /adclick.php<br />
��������������<br />
��һ�� id ������Ϊ���֣��ǹ����ţ���ͬ��治Ҫ�ظ���ͬһ������ε�������ظ��Ʒ֣�<br />
�ڶ��� url ���ǹ������Ҫ��ת����ַ��iframe����ģʽ�²������ã�<br /><br />


�����������ֵ��÷�������������<br />

1���Լ�д��������ֻ���ͼƬ���ӹ�棬��������<br />
&lt;a href="http://www.domain.com/adclick.php?id=123&url=http://www.ad.com" target="_blank"&gt;�����ʾ���&lt;/a&gt;<br />

���� http://www.domain.com �Ǳ�վ������ 123 �ǹ�����, http://www.ad.com ����ת����ַ<br /><br />


2����iframe������ʾ�Ĺ�棬��������<br />
&lt;iframe id="jieqiad_123" name="jieqiad_123" width="760" height="60" align="center" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no" src="http://www.domain.com/ad.html" onfocus="javascript:adimg=new Image(); adimg.src=\'http://www.domain.com/adclick.php?id=123\';"&gt;&lt;/iframe&gt;<br />

���� onfocus �Ǵ������ͳ�Ƶģ� http://www.domain.com ��ֻ��վ������ 123 �ǹ�����
</div>
</div>

<div class="block">
<div class="blocktitle"><a name="tip10">�޸�С˵���</a></div>
<div class="blockcontent">
&nbsp;&nbsp;&nbsp;&nbsp;�ѷ����Ķ��ͷ���С˵ʱ��ϵͳĬ��С˵���࣬�޸ĳɱ�ķ��࣬�磺�ѡ��������顱����Ϊ����й��¡���
�ҵ������ļ� configs/article/sort.php,�ü��±������ı��༭���ߴ򿪶�������޸ģ��ĵ�����һ��php���飬�ڳ������������ݴ˴������������ж�С˵���������Ų�Ҫ�ظ���Ҳ��Ҫ�����޸ġ����ĵ��еġ��������顱����Ϊ����й��¡����ɣ������ơ����С�Ҳ���������޸ġ���ʹ�õ���ϵͳ�˵���ҲҪ��������޸ģ��·�����ϸ˵���� ���ˢ�����飨��ˢ��ҳ�棩�ɿ������ĺ��Ч���� 
</div>
</div>



</div>';
?>