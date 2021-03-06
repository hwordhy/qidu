var indexSlide = function(){
    this.eleBox;
    this.eleList;
    this.elePoints;
    this.playLock=false;
    this.playDuration = 500;
    this.index = 0;
    this.eleLength;
    this.playDwell = 5000; //εηζΆι΄
};
indexSlide.prototype.play = function(){
    var self = this;
        this.autoPlayInterval = setInterval(function(){
            self.next();
        },self.playDwell)
    }
indexSlide.prototype.go = function(index){
        var self = this;
        var curr = self.eleList.children().eq(index);

        self.updateBanner(curr);
        curr.fadeIn(self.playDuration);

        self.eleList.children().not(curr).fadeOut(self.playDuration,function(){
            self.playLock = false;
        });

        self.updatePoint(index);
    }

indexSlide.prototype.next = function(){
        if(this.playLock) return;
        this.playLock = true;

        this.index = (this.index+1)%this.eleLength;

        this.go(this.index);
    }

indexSlide.prototype.prev = function(){
        if(this.playLock) return;
        this.playLock = true;

        this.index = (this.index-1+this.eleLength)%this.eleLength;

        this.go(this.index);
    }

indexSlide.prototype.showBtnAndbind = function(){
    var self = this;
        self.eleBox.find('.slide-next').show().click(function(){
            self.next();
        })

        self.eleBox.find('.slide-prev').show().click(function(){
            self.prev();
        })

        self.eleBox.mouseenter(function(){
            clearInterval(self.autoPlayInterval)
        }).mouseleave(function(){
            self.play();
        })


        self.elePoints.on('click','a',function(e){
            self.go($(this).index());
        })
    }

indexSlide.prototype.showPoint = function(offset){
        var html = [];
        for(var i=0; i < this.eleLength; i++){
            html[i] = '<a href="javascript:;" onclick="return false;"></a>';
        }
        this.elePoints.html(html.join('')).show();
        if(this.elePoints.css('position')=='absolute'){
            offset |=0;
            this.elePoints.css('marginLeft',(offset-this.elePoints.outerWidth())/2);
        }
        this.updatePoint(0);
    }

indexSlide.prototype.updatePoint = function(index){
        this.elePoints.find('a').removeClass('curr-point').eq(index).addClass('curr-point');
    }

indexSlide.prototype.updateBanner = function(ele){
        function getMiniUrl(url){
            url = url.replace("qhimg", "qhmsg");
            if(url.indexOf("qhmsg") == -1) return url;
            return  window.isSupportWebp ? url.replace(".jpg", ".webp") : url;
        }
        ele = ele? $(ele) : this.eleList.find('.slider-film').eq(0);
        /*try{
            ele.filter('.js-lazyload').trigger('porty');
            ele.find('.js-lazyload').trigger('porty');
        }catch(err){*/
            if(ele && ele.find('img')){
                var img = ele.find('img');
                img.each(function(){
                    var item = $(this);
                    if(item.data('original')){
                        item.attr('src',getMiniUrl(item.data('original'))).removeAttr('data-original');
                    }
                });
            }
            //ele && ele.filter('.js-lazyload').length>0 && ele.data('original') && ele.css({backgroundImage:'url('+getMiniUrl(ele.data('original'))+')'}).removeAttr('data-original');
      /*  }*/

    }

indexSlide.prototype.init = function(ele,dwell,offset){
        this.eleBox = $(ele);
        this.playDwell = dwell || this.playDwell;
        this.eleList = this.eleBox.find('.slideBox');
        this.eleLength = this.eleList.find('.slider-film').length;
        this.elePoints = this.eleBox.find(".slide-point");

        this.updateBanner();

        this.eleList.children().first().show();

        if(this.eleLength>1){
            this.showPoint(offset);
            this.showBtnAndbind();
            this.play();  
        }else{
            this.eleBox.find('.slide-next,.slide-prev').hide()
        }
      
        /*this.eleList.find('.js-lazyload').lazyload({
            event:'porty'
        });*/
}
new indexSlide().init('.banner-slide', 5000,10);
