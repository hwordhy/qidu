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
                 <a href="/modules/pay/buyegold.php?t=zhifu" class="wepay " title="微信" rel="2">微信</a>
                 <a href="/modules/pay/buyegold.php?t=alipaypay"  class="alipay opa" title="支付宝" rel="3">支付宝</a>
                </div>
               </div>
         <div class="payways">
          <div class="container">
           <h1 class="waysh1"><em class="wepay ems"></em><b>微信</b>充值</h1>
           <div class="checkme clearfix">
            <a class="checkpay" data-rel="500">  <input type="radio" name="egold" value="2000" class="price radio"> <b>20元</b><em>2000 币</em></a>
            <a class="checkpay" data-rel="500">  <input type="radio" name="egold" value="5000" class="price radio"> <b>50元</b><em>5000 币</em><strong></strong></a>
            <a class="checkpay" data-rel="500">  <input type="radio" name="egold" value="10000" class="price radio"><b>100元</b><em>10000 币</em> </a>
            <a class="checkpay" data-rel="500">  <input type="radio" name="egold" value="20000" class="price radio"> <b>200元</b><em>20000 币</em></a>
            <a class="checkpay" data-rel="500">  <input type="radio" name="egold" value="30000" class="price radio"> <b>300元</b><em>30000 币</em></a>
            <a class="checkpay" data-rel="500">  <input type="radio" name="egold" value="50000" class="price radio"> <b>500元</b><em>50000 币</em></a>

        
           </div>
           <div id="tj" class="weui_btn weui_btn_primary" style="background-color:#333333;">	<input type="submit" name="Submit" value="进入下一步" class="button" >
            <input type="hidden" name="act" value="pay">'.$this->_tpl_vars['jieqi_token_input'].'</div>
           <div class="paytips">
            <h2>支付小提示</h2>
            <p>支付宝充值接口，除了支持支付宝帐户余额支付，还可以在下一步选择网上银行支付及储蓄卡和信用卡快捷支付</p>
            <p>充值到账有延迟，如果24小时内未到账请与客服联系。联系电话：020-83840202</p>
            <p>工作时间：周一到周五 08:30 - 24:00</p>
           </div>
          </div>
         </div>

</div>
</form>


';
?>