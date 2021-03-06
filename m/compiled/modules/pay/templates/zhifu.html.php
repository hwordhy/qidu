<?php
echo '

<link rel="stylesheet" href="/weixin/Css/public.css" media="screen">
<link rel="stylesheet" href="/weixin/Css/weui.min.css" media="screen">
<link rel="stylesheet" href="/themes/jieqi220/css/mypays.css">
<style>
        .price{
                position: relative;
                top: 30px;
                left: 10px;
                width: 15px;
                height: 15px;
        }
    </style>
            <form id="form">
    <div class="mypays wbg">
            <div class="otway">
                    <div class="clearfix otways">
                     <a href="/modules/pay/buyegold.php?t=zhifu" class="wepay opa" title="微信" rel="2">微信</a>
                     <a href="/modules/pay/buyegold.php?t=alipaypay"  class="alipay" title="支付宝" rel="3">支付宝</a>
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
               <div id="tj" class="weui_btn weui_btn_primary" style="background-color:#333333;">立即充值</div>
               <div class="paytips">
                <h2>tip小提示</h2>
                <p>发现充值未到账时，请先确认你登录的账号与充值的账号是否一致。</p>
                <p>充值到账有延迟，如果24小时内未到账请与客服联系。联系电话：020-83840202</p>
                <p>工作时间：周一到周五 08:30 - 24:00</p>
               </div>
              </div>
             </div>
    
    </div>
    </form>
<div id="dialog_alert1" class="weui_dialog_alert" style="display:none;">
    <div class="weui_mask"></div>
        <div class="weui_dialog">
            <div class="weui_dialog_hd"><strong class="weui_dialog_title">信息提示</strong></div>
            <div class="weui_dialog_bd"></div>
            <div class="weui_dialog_ft">
                <a href="#" class="weui_btn_dialog primary">确定</a>
            </div>
        </div>
    </div>
    <div id="dialog_alert2" class="weui_dialog_confirm" style="display:none;">
        <div class="weui_mask"></div>
        <div class="weui_dialog">
            <div class="weui_dialog_hd"><strong class="weui_dialog_title">信息提示</strong></div>
            <div class="weui_dialog_bd"></div>
            <div class="weui_dialog_ft">
                <a href="#" class="weui_btn_dialog default">取消</a>
                <a href="#" class="weui_btn_dialog primary">确定</a>
            </div>
        </div>
    </div>
    <div id="loadingToast" class="weui_loading_toast" style="display:none;">
        <div class="weui_mask_transparent"></div>
        <div class="weui_toast">
            <div class="weui_loading">
                <!-- :) -->
                <div class="weui_loading_leaf weui_loading_leaf_0"></div>
                <div class="weui_loading_leaf weui_loading_leaf_1"></div>
                <div class="weui_loading_leaf weui_loading_leaf_2"></div>
                <div class="weui_loading_leaf weui_loading_leaf_3"></div>
                <div class="weui_loading_leaf weui_loading_leaf_4"></div>
                <div class="weui_loading_leaf weui_loading_leaf_5"></div>
                <div class="weui_loading_leaf weui_loading_leaf_6"></div>
                <div class="weui_loading_leaf weui_loading_leaf_7"></div>
                <div class="weui_loading_leaf weui_loading_leaf_8"></div>
                <div class="weui_loading_leaf weui_loading_leaf_9"></div>
                <div class="weui_loading_leaf weui_loading_leaf_10"></div>
                <div class="weui_loading_leaf weui_loading_leaf_11"></div>
            </div>
            <p class="weui_toast_content">数据加载中</p>
        </div>
    </div>

    <div id="toast" style="display: none;">
        <div class="weui_mask_transparent"></div>
        <div class="weui_toast">
            <i class="weui_icon_toast"></i>
            <p class="weui_toast_content">跳转中...</p>
        </div>
    </div>

<script src="/weixin/Js/jquery.min.js"></script>
<script src="/weixin/Js/public.js"></script>
<script>
	$(function(){
		$("#tj").click(function(){
			if(!$(this).hasClass("weui_btn_disabled")){
				$(\'#tj\').addClass("weui_btn_disabled");
				$(\'#loadingToast\').show();
				username=$(\'#username\').val();
				price=$(\'.price:checked\').val();
				$.post("/weixin/ajax.php?act=add",{username:username,price:price},function(data){
					str=data.split(":");
					$(\'#loadingToast\').hide();
					if(str[0]==\'success\'){
						$(\'#toast\').show(function(){});
						to_url(str[1]);
					}else{
						$(\'.weui_dialog_bd\').html(str[1]);
						$(\'.weui_dialog_alert\').show();
						$("#tj").removeClass("weui_btn_disabled");
					}
				});
			}
		});
	});
   </script>
';
?>