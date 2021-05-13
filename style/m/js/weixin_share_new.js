/****自定义配置
shareWx({
  title : '分享标题'，
  desc  : '分享内容'
  imgUrl: '分享图片'
});
*****/

function shareWx(res) {
  //console.log(data);
  res = res || {}
  var url     = res.url      ||  encodeURIComponent(location.href.split('#')[0]);
  var title   = res.title    ||  $('#sharetitle').text();
  var desc    = res.desc     ||  $('#sharecontent').text();
  var imgUrl  = res.imgUrl   ||  $('#shareImg').attr('src');

//console.log(imgUrl);
  /*var url = encodeURIComponent(location.href.split('#')[0]);
  var title = $('#sharetitle').text();
  var desc = $('#sharecontent').text();
  var imgUrl = $('#shareImg').attr('src');*/
    $.ajax({
      type: 'post',
      url: '/ajax/get/weixinSign?url='+url+'&title='+title+'&content='+desc+'&pic='+imgUrl,
      dataType: 'json',
      data: '',
      success: function (data) {
        //console.log(data);
          var wxConfig  = data 
          wx.config({
                // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
                //debug: true,
                // 必填，公众号的唯一标识
                appId: wxConfig.appid,
                // 必填，生成签名的时间戳
                timestamp:wxConfig.timestamp,
                // 必填，生成签名的随机串
                nonceStr: wxConfig.noncestr,
                // 必填，签名，见附录1
                signature: wxConfig.signature,
                // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
                jsApiList: ['checkJsApi',
                    'onMenuShareTimeline',
                    'onMenuShareAppMessage'
                    //'onMenuShareQQ',
                    //'onMenuShareQZone'
                ]
           });
           wx.ready(function () {
              wx.onMenuShareTimeline({
                    title: wxConfig.title, // 分享标题
                    link: wxConfig.url, // 分享链接
                    imgUrl: wxConfig.pic, // 分享图标
                    success: function () {
                        console.log('分享成功');
                        // 用户确认分享后执行的回调函数
                    },
                    cancel: function() {
                        console.log('分享失败');
                        // 用户取消分享后执行的回调函数
                    },
                });
              wx.onMenuShareAppMessage({
                  title: wxConfig.title, // 分享标题
                  desc: wxConfig.content, // 分享描述
                  link: wxConfig.url, // 分享链接
                  imgUrl: wxConfig.pic, // 分享图标
                  success: function () {
                      console.log('分享成功');
                      // 用户确认分享后执行的回调函数
                  },
                  cancel: function () {
                      console.log('分享失败');
                      // 用户取消分享后执行的回调函数
                  }
              });
              
          });
         wx.error(function (res) {
              //alert('信息验证失败');
                // config信息验证失败会执行error函数，如签名过期导致验证失败，具体错误信息可以打开config的debug模式查看，也可以在返回的res参数中查看，对于SPA可以在这里更新签名。
         });
      },
    });
    
} 


//浏览器中
function toshare(){
    $(".am-share").addClass("am-modal-active"); 
    if($(".sharebg").length>0){
      $(".sharebg").addClass("sharebg-active");
    }else{
      $("body").append('<div class="sharebg"></div>');
      $(".sharebg").addClass("sharebg-active");
    }
    $(".sharebg-active,.share_btn").click(function(){
      $(".am-share").removeClass("am-modal-active");  
      setTimeout(function(){
        $(".sharebg-active").removeClass("sharebg-active"); 
        $(".sharebg").remove(); 
      },300);
    })
  } 


function share(title,imgurl){
    var title = title;
    var imgurl = imgurl;
    var ua = navigator.userAgent.toLowerCase();
　　var isWeixin = ua.indexOf('micromessenger') != -1;
　　if (isWeixin) {
      //console('微信');
 　　 //alert("请点击屏幕右上角的链接位置进行分享");
      $('#shadow,#showDiv').show();
      $('#shadow,#showDiv').on('touchstart click',function(event){
          $('#shadow,#showDiv').hide();
          event.stopPropagation();
      })

      /*if(null == title || "" == title){
          title="年终盘点";
      }
      if(null == imgurl || "" == imgurl){
          imgurl="http://127.0.0.1:9091/_resources/mobile/image/huodong/nzpd/pdimg1.jpg";
      }*/
     
　　}else{
     // return false;
      //alert('浏览器');
 　　 toshare();     
　　}
}





