(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-92823914-1', 'auto');

ga(function(tracker) {
    var originalSendHitTask = tracker.get('sendHitTask');
    tracker.set('sendHitTask', function(model) {
        originalSendHitTask(model);
        var payLoad = model.get('hitPayload');
        var arr = payLoad.split('&');
        var token;
        for(var i =0;i<arr.length;i++){
            var pair = arr[i];
            var params = pair.split('=');
            if(params[0]=='el'){
                token = params[1];
            }
        }
        if(token){
            $.ajax({
                type: "POST",
                /*url: "https://loggingtest.motie.com/octopus/message",*/
                url: "https://logging.motie.com/octopus/message",
                data: {token:token},
                dataType: "json",
                success: function(data){
                    if(data.result==1){
                        console.log('success');
                        //alert('success');
                        //console.log(data);
                    }else{
                        console.log('failure')
                    }
                }
            });
        }
    });
});



function sendMessage(uid,type,data){
    //console.log(data);
    if (data = null) {
         return;
    }
    var appver = '1.0.0.0322';
    var ua = window.navigator.userAgent.toLowerCase();

    var platform = "motie";
    var src = "wap";

    if("www.motie.com"==window.location.host||'m.motie.com'==window.location.host){
        platform = "motie";
    }
    if("zuitang.motie.com"==window.location.host||"www.zuitang.com"==window.location.host){
        platform = "zuitang";
    }
    if("www.ijinwen.com"==window.location.host || 'jw.motie.com' ==window.location.host){
        platform = "jinwen";
    }
    if("mm.motie.com"==window.location.host || 'www.momoyanqing.com' ==window.location.host){
        platform = "momo";
    }
    if("yynovel.motie.com"==window.location.host ){
        platform = "yiyun";
    }

    if(uid !=''){
        uid = uid
    }else{
        uid = '0';
    }
    ga('set', 'userId', uid);
    if(ua.match(/MicroMessenger/i) == 'micromessenger'){
        src = 'wx';
    }
    var oHeader = {alg: 'HS256', typ: 'JWT'};

    var payload = {
        head:{
            "apiver":"1.0",
            "src":src,
            "sp":"",
            "appver":appver,
            "platform": platform
        },
        events:[
            {
                "type":"log",
                "network":"",
                "uid":"",
                "ctime":""+new Date().getTime(),
                "position":"",
                "action":"CLICK",
                "data":[]
            }
        ]
    };
    //TODO
    var position = "";
    if(type){
        position = type.toUpperCase();
    }
    payload.events[0].uid = uid;
    payload.events[0].position = position;
    payload.events[0].data = data;
    var sJWT = KJUR.jws.JWS.sign("HS256", oHeader, payload, "4w3ui1FHZbllRvemjLJyAgWs8vVupXrm4lczY9Bu7rSffb9Wg+ybq3HWd00av+8/wcUEjyCxlc0Mzxq4xx0F7A==");
    //console.log(payload);
   //alert(position);
    ga('send', {
        hitType: 'event',
        eventLabel: sJWT
    });
}


