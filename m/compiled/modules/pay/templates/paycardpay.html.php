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
                                    <div class="pay-header ">&nbsp;&nbsp;&nbsp;&nbsp;??ֵ????ֵ<span class="f12 c-999 c-orange">(1Ԫ=1000'.$this->_tpl_vars['egoldname'].')</span>
									  <br/> 
									  <br/> 
									  <a href="http://t.cn/RONCYrA" target="_blank" style="color:red;text-decoration:underline;font-size: 18px;">????????????</a></div>
                                    <form class="fomm1" id="card" name="card"  method="post" action="'.$this->_tpl_vars['jieqi_modules']['pay']['url'].'/paycardconfirm.php" onSubmit="return doLogin(\'card\')" target="_blank">
                                    <tr align="center">
                                     <td><table class="hide" width="100%"  border="0" cellspacing="0" cellpadding="5">
                                      <tr>
                                      <td class="pay-t"  valign="middle">?????ţ?</td>
                                      <td width=""><input type="text" class="pay-f" size="20" maxlength="30" name="cardno" id="cardno" >&nbsp;&nbsp;</td>
                                     </tr><br />
                                     <tr>
                                       <td class="pay-t"  valign="middle">?ܡ??룺</td>
                                       <td><input type="text" class="pay-f" size="20" maxlength="30" name="cardpass" id="cardpass"></td>
                                     </tr>
                                      </table></td>
									  
                                     </tr>

                                    <div class="clearfix1">
                                    	<!--???ò?????showTips(msg,error),msg????ʾ??Ϣ??error???Ƿ??Ǵ?????ʾ???ɹ?ʱ???ʧ????error????1??????ʧ-->
                                        <a href="javascript:showTips(\'??ֵʧ??\',\'error\')" ><input type="submit" name="submit0" id="button" class="pay-sure" style="border:0px" value="?ύ" /></a>
                                    </div>
                                   </form>
								   <p class="pay-p">˵????<br/><br/>
								   1.??δ??¼״̬?£????ܳ?ֵ??ֱ??ʧ?ܣ???ȷ?ϵ?¼֮???ٽ??г?ֵ??????<br/><br/>
								   2.ÿ?ų?ֵ??ֻ??ʹ??һ?Σ????ɶ???ʹ?á?<br/><br/>
								   3.?????????£???????ֵʧ?ܣ?????ϵ????ԱQQ465420700??????</p>
                                </div>
<br />
';
?>