<?php
echo '
<link type="text/css" rel="stylesheet" href="/themes/jieqi220/css/mybook.css" />
<style>
    
/*5Ԫ*/
.reading{
    position: relative;
} 
.fivermb{
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,.6);
    z-index: 10000;
    width: 100%;  
    display: none;
    -webkit-transform: translate3d(0,0,0);
    transform: translate3d(0,0,0);
}
.fivermb .rmbcont{
    background: #fff;
    width: 90%;
    margin: 5% auto;  
    -webkit-border-radius: 5px;
    border-radius: 5px;
    overflow: hidden;
    max-width: 750px; 
}
.fivermb p{ 
    color: #663c3c;
    font-size: 1.6rem;
    line-height: 2.8rem;
    margin: 30px;
    text-align: -webkit-justify;
    text-align: justify;
}
.fivermb h2{ 
    color: #fff; 
    background: -webkit-linear-gradient(30deg,#fd4145,#ff7234);
    background: linear-gradient(30deg,#fd4145,#ff7234);
    padding: 15px 0;
    text-align: center;
    font-size: 2rem;
    margin: 0 30px 30px;
    -webkit-border-radius: 50px;
    border-radius: 50px;
}
.fivermb h1{
    background: url(http://m.cmqxwx.com/wap_9kus/new_wap/images/new_rmb.png) no-repeat center top;
    background-size:100%;
    height: 200px; 
    overflow: hidden;
    position: relative;
   -webkit-border-radius: 5px 5px 0 0;
    border-radius: 5px 5px 0 0;
}
@media(max-width:750px){
    .fivermb .rmbcont{ 
    margin: 30% auto;   
}
    .fivermb h1{ 
    height: 8.8rem;  
}
}
.fivermb .fivecose{
    background: url(http://m.cmqxwx.com/wap_9kus/new_wap/images/new_cose.png) no-repeat center;
    background-size:100%;
    width: 1.5rem;
    height: 1.5rem;
    position: absolute;
    top: 1rem;
    right: 1rem;
}
    .new_newman{
        background:url(http://m.cmqxwx.com/wap_9kus/new_wap/images/new_newman.png) no-repeat right center;
        background-size:contain;
        position:fixed;
        bottom:2rem;
        left:0;
        right:10px;
        width:100%;
        max-width:750px;
        height:5.06rem;
        z-index:1000;
        margin:0 auto;
    }
    </style>
  <script type="text/javascript">
      xst=localStorage.getItem("xst");
      xti=localStorage.getItem("xti");
      xurl=localStorage.getItem("xurl");
      xst1=localStorage.getItem("xst1");
      xti1=localStorage.getItem("xti1");
      xurl1=localStorage.getItem("xurl1");
      xst2=localStorage.getItem("xst2");
      xti2=localStorage.getItem("xti2");
      xurl2=localStorage.getItem("xurl2");
  </script>

            <section class="mybook">
            <div class="container">
            <div class="bookcats">
                <a  href="/modules/article/bookcase.php">?ҵ??ղ?</a>
                <a  class="active" >?????Ķ???ʷ</a>
            </div>
           
                 <ul class="my_list">
                     <li style="width:100%;text-align:center;"><p>ֻ????3??Ӵ?????????????Ͳ?????ඣ?</p></li>
                    <script type="text/javascript">
                        if (xst!==null) {
                            document.writeln("<li style=\\\'width:100%;text-align:left;\\\'>");
document.writeln("<h3><a  href=\\\'"+xurl+"\\\'>"+xst+"</a></h3>");
document.writeln("<p class=\\\'wordhide\\\'>");
document.writeln("<a  href=\\\'"+xurl+"\\\'>");
document.writeln(xti+"</a>");
document.writeln("</p>");
document.writeln(" <p><a style=\\\'color:#21a7ee\\\' href=\\\'\\\' class=\\\'btn-gray\\\' id=\\\'del\\\'>?Ƴ?</a></p>");
document.writeln("                        </li>");
                            del.onclick=function(){
                                localStorage.removeItem("xurl");
                                localStorage.removeItem("xst");
                                localStorage.removeItem("xti");
                            }
                        }
                        if (xst1!==null) {
                            document.writeln("<li style=\\\'width:100%;text-align:left;\\\'>");
document.writeln("<h3><a  href=\\\'"+xurl1+"\\\'>"+xst1+"</a></h3>");
document.writeln("<p class=\\\'wordhide\\\'>");
document.writeln("<a  href=\\\'"+xurl1+"\\\'>");
document.writeln(xti1+"</a>");
document.writeln("</p>");
document.writeln(" <p><a style=\\\'color:#21a7ee\\\'  href=\\\'\\\' class=\\\'btn-gray\\\' id=\\\'del1\\\'>?Ƴ?</a></p>");
document.writeln("                        </li>");
                            del1.onclick=function(){
                                localStorage.removeItem("xurl1");
                                localStorage.removeItem("xst1");
                                localStorage.removeItem("xti1");
                            }
                        }if (xst2!==null) {
                            document.writeln("<li style=\\\'width:100%;text-align:left;\\\'>");
document.writeln("<h3><a  href=\\\'"+xurl2+"\\\'>"+xst2+"</a></h3>");
document.writeln("<p class=\\\'wordhide\\\'>");
document.writeln("<a  href=\\\'"+xurl2+"\\\'>");
document.writeln(xti2+"</a>");
document.writeln("</p>");
document.writeln(" <p><a style=\\\'color:#21a7ee\\\'class=\\\'btn-gray\\\' href=\\\'\\\' id=\\\'del2\\\'>?Ƴ?</a></p>");
document.writeln("                        </li>");
                            del2.onclick=function(){
                                localStorage.removeItem("xurl2");
                                localStorage.removeItem("xst2");
                                localStorage.removeItem("xti2");
                            }
                        }
                        if((xst2==null)&&(xst1==null)&&(xst==null)){
                            document.writeln("????û???Ķ???һƪ????");
                        }

                      </script>
                 </ul>
            </div>
            </section>
        <!--?ҵ????? end-->    
    ';
?>