<?php
echo '

<link rel="stylesheet" href="/themes/jieqi220/css/mypays.css">
<style>
    .price{
            position: relative;
            top: 30px;
            left: 10px;
            width: 15px;
            height: 15px;
    }
    .button{
      position: relative;
    display: block;
    margin-left: auto;
    margin-right: auto;
    padding-left: 14px;
    padding-right: 14px;
    box-sizing: border-box;
    font-size: 18px;
    text-align: center;
    text-decoration: none;
    color: #fff;
    line-height: 2.33333333;
    border-radius: 5px;
    -webkit-tap-highlight-color: rgba(0,0,0,0);
    overflow: hidden;
    background-color: #333333;
    border: 1px solid #333333;
    }
</style>
<form name="frmalipay" method="post" action="'.$this->_tpl_vars['jieqi_modules']['pay']['url'].'/alipay.php">
<div class="mypays wbg">
        <div class="otway">
                <div class="clearfix otways">
                 <a href="/modules/pay/buyegold.php?t=zhifu" class="wepay " title="΢��" rel="2">΢��</a>
                 <a href="/modules/pay/buyegold.php?t=alipaypay"  class="alipay opa" title="֧����" rel="3">֧����</a>
                </div>
               </div>
         <div class="payways">
          <div class="container">
           <h1 class="waysh1"><em class="wepay ems"></em><b>΢��</b>��ֵ</h1>
           <div class="checkme clearfix">
            <a class="checkpay" data-rel="500">  <input type="radio" name="egold" value="2000" class="price radio"> <b>20Ԫ</b><em>2000 ��</em></a>
            <a class="checkpay" data-rel="500">  <input type="radio" name="egold" value="5000" class="price radio"> <b>50Ԫ</b><em>5000 ��</em><strong></strong></a>
            <a class="checkpay" data-rel="500">  <input type="radio" name="egold" value="10000" class="price radio"><b>100Ԫ</b><em>10000 ��</em> </a>
            <a class="checkpay" data-rel="500">  <input type="radio" name="egold" value="20000" class="price radio"> <b>200Ԫ</b><em>20000 ��</em></a>
            <a class="checkpay" data-rel="500">  <input type="radio" name="egold" value="30000" class="price radio"> <b>300Ԫ</b><em>30000 ��</em></a>
            <a class="checkpay" data-rel="500">  <input type="radio" name="egold" value="50000" class="price radio"> <b>500Ԫ</b><em>50000 ��</em></a>

        
           </div>
           <div id="tj" class="weui_btn weui_btn_primary" style="background-color:#333333;">	<input type="submit" name="Submit" value="������һ��" class="button" >
            <input type="hidden" name="act" value="pay">'.$this->_tpl_vars['jieqi_token_input'].'</div>
           <div class="paytips">
            <h2>֧��С��ʾ</h2>
            <p>֧������ֵ�ӿڣ�����֧��֧�����ʻ����֧��������������һ��ѡ����������֧������������ÿ����֧��</p>
            <p>��ֵ�������ӳ٣����24Сʱ��δ��������ͷ���ϵ����ϵ�绰��020-83840202</p>
            <p>����ʱ�䣺��һ������ 08:30 - 24:00</p>
           </div>
          </div>
         </div>

</div>
</form>


';
?>