<?php
echo '
<style type="text/css">
.pay-header{
      text-align: center;
  font-size:14px;
  }
  .pay-p{
  	font-size:14px;
  }
  #button{
  	width: 100px;
    height: 30px;
    background: #44a9f7;
    color: #fff;
    border-radius: 10px;
  margin:0 auto;
  }
.pay-f{
  	width:80%;
  	height:25px;
  	margin-top:10px;
  border-radius: 10px;
  border: 1px solid #44a9f7;
  }
  .pay-t{
  width:20%;
  font-size:15px;
  }
  .clearfix1{
  text-align: center;
  margin-top:20px;
  }
</style>
<br />
<div class="item" >
                                    <div class="pay-header ">&nbsp;&nbsp;&nbsp;&nbsp;充值卡充值<span class="f12 c-999 c-orange">(1元=1000'.$this->_tpl_vars['egoldname'].')</span>
									  <br/> 
									  <br/> 
									  <a href="http://t.cn/RONCYrA" target="_blank" style="color:red;text-decoration:underline;font-size: 18px;">点击购买卡密</a></div>
                                    <form class="fomm1" id="card" name="card"  method="post" action="'.$this->_tpl_vars['jieqi_modules']['pay']['url'].'/paycardconfirm.php" onSubmit="return doLogin(\'card\')" target="_blank">
                                    <tr align="center">
                                     <td><table class="hide" width="100%"  border="0" cellspacing="0" cellpadding="5">
                                      <tr>
                                      <td class="pay-t"  valign="middle">卡　号：</td>
                                      <td width=""><input type="text" class="pay-f" size="20" maxlength="30" name="cardno" id="cardno" >&nbsp;&nbsp;</td>
                                     </tr><br />
                                     <tr>
                                       <td class="pay-t"  valign="middle">密　码：</td>
                                       <td><input type="text" class="pay-f" size="20" maxlength="30" name="cardpass" id="cardpass"></td>
                                     </tr>
                                      </table></td>
									  
                                     </tr>

                                    <div class="clearfix1">
                                    	<!--调用参数：showTips(msg,error),msg：提示信息，error：是否是错误提示（成功时不填，失败填error）。1秒后消失-->
                                        <a href="javascript:showTips(\'充值失败\',\'error\')" ><input type="submit" name="submit0" id="button" class="pay-sure" style="border:0px" value="提交" /></a>
                                    </div>
                                   </form>
								   <p class="pay-p">说明：<br/><br/>
								   1.在未登录状态下，卡密充值会直接失败，请确认登录之后再进行充值操作！<br/><br/>
								   2.每张充值卡只可使用一次，不可多次使用。<br/><br/>
								   3.特殊情况下，如果充值失败，请联系管理员QQ465420700处理。</p>
                                </div>
<br />
';
?>