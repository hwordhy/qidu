// 上划获取更多  模块功能
var scrollOut = (function () {
    var mod= {};
    var callbackfn = [];
    mod.init = function () {
        $(window).on('scroll',function () {
            if ( $(document).scrollTop() >= $('.j_wrapper').innerHeight() - $(window).height()) {
                // 如果 当前页大于 总页数 （已经获取过的情况下） 不再ajax
                console.log('到底部了');
                for(var i = 0;i<callbackfn.length;i++){
                    callbackfn[i]();
                }
            }
        });
    };
    mod.addScrollFn = function (fn) {
        var arg = [].slice.call(arguments,1);
        callbackfn.push(function () {
            fn.apply(null,arg)
        });
    };
    return mod;
})();

var common_header = (function () {
    var mod = {};
    mod.init = function () {
        $('#j_commonHeader .nav').toggle(function () {

            mod.navClick();
        }, function () {
            mod.J_greybgClickfn();
        });
        $('#J_greybg').click(function () {
            mod.J_greybgClickfn();
        })
        mod.setBgHeight();
        // 返回
        mod.back()
    };
    // 点击背景阴影  关闭 菜单 关闭阴影
    mod.J_greybgClickfn = function () {
        $('#J_menu').stop(true, true).slideUp('fast');
        setTimeout(function () {
            $('#J_greybg').hide().css('opacity', 0);
        }, 0)
    };
    mod.navClick=function () {
        $('#J_menu').stop(true, true).slideDown('fast');
        $('#J_greybg').show();
        setTimeout(function () {
            $('#J_greybg').css('opacity', .4);
        }, 0)
    };
    mod.setBgHeight = function () {
        var clientHeight = $(window).height();
        console.log(clientHeight);
        $('#J_greybg').css('height',clientHeight);
    };
    // 点击 左侧箭头 返回
    mod.back = function () {
        $('.commontitle .back').on('click',function () {
            history.go(-1);
        }) ;
    };
    return mod;
})();
console.log(common_header);
var page_category = (function () {
    var mod = {};

    mod.init=function () {
        $('.commontitle .text').html('分类');
    };
    return mod;
})();
var page_collect = (function () {
    var mod = {};
    var flag = false;
    var isManage = true;
    var currentPage  = 1;
    var bookNumber =0;
    mod.init = function () {
        mod.manage();
        mod.delete();
        mod.srcollWindow();
        mod.toTop();
        bookNumber = $('#j_booknumber').text();
    };
    mod.manage = function () {
        $('#j-manage-btn').click(function () {
            if (isManage === true) {
                $('#j-manage-btn').html('完成');
                $('.j_delete').show();
                isManage = false;
            } else {
                $('#j-manage-btn').html('管理');
                $('.j_delete').hide();
                location.reload();
                isManage = true;
            }
        });
    };
    mod.delete = function () {
        $('#page_collection').on('click', '.j_delete', function () {
            var thisDl = $(this).parent('dl');
            var bookId = $(this).data('bookid');
            $('#loading').show();
            $.post('/modules/article/bookcase.php', {"bid" : bookId, "act" : "delete", "jieqi_token" : jieqi_token, "ajax_gets" : 1}, function (data) {
                if (data.success == true) {
                    thisDl.remove();
                    bookNumber--;
                    $('#j_booknumber').text(bookNumber);
                    $('#loading').hide();
                }
            }, 'json');
            return false;
        });
    };
    // 滚动 屏幕  按需加载
    mod.srcollWindow = function () {
        currentPage = parseInt($("#search_more").data('currentpage'))+1;
        var totalPage = parseInt($("#search_more").data('totalpage'));
        var toTopis_isshow =false;
        $(window).scroll(function () {
            // 如果滚动到页面的底部
            if ( $(document).scrollTop() >= $('body').height() - $(window).height()) {
                // 展示loading
                $("#search_more").show();
                $('.fixedbottom').hide();
                // 如果 当前页大于 总页数 （已经获取过的情况下） 不再ajax
                if (currentPage > totalPage) {
                    setTimeout(function () {
                        $('#search_more').hide();
                        $('.fixedbottom').show();
                    },1000);
                } else if (!flag) {
                    // 如果 上次请求已经结束，请求
                    flag = true;
                    if (currentPage > 0) {
                        mod.ajaxList(currentPage);

                    }
                }
            }
            // 添加 回到顶部的按钮展示方法
            if($(document).scrollTop() >50 && !toTopis_isshow){
                $('#j_toTop').animate({opacity:1,bottom:'90px'},300);
                toTopis_isshow = true;
            }else if($(document).scrollTop() <50 && toTopis_isshow){
                $('#j_toTop').animate({opacity:0,bottom:'0'},300);
                toTopis_isshow = false;
            }
        });
    };
    mod.ajaxList = function (curPage) {
        var sitePath = $('#search_more').data('sitepath');
        var pageUrl = "/m" + sitePath + "/ajax/people/reading?page=" + curPage;
        console.log(pageUrl);
        $.ajax({
            type: "get",
            url: pageUrl,
            dataType: 'json',
            success: function (result) {
                flag = false;
                currentPage++;
                mod.addNewDl(result);
                $('#search_more').hide();
            }
        });
    }
    // 根据数据 渲染列表到dom中
    mod.addNewDl = function (data) {
        var chaptersList = '';
        console.log(data);
        for (var i = 0; i < data.length ; i++) {
            console.log(data[i]);
            if(!data[i].blp.chapter){
                continue;
            }
            chaptersList+=
            '<dl>'+
            '    <span class="delete j_delete" data-bookid="'+data[i].blp.book.id+'"></span>'+
            '    <dt>'+
            '        <a href="'+data[i].blp.book.murl+'">'+
            '            <img src="'+data[i].blp.book.imageUrlSmall+'" alt="'+data[i].blp.book.name+'"  title="data[i].blp.book.name">'+
            '        </a>'+
            '    </dt>'+
            '    <dd>'+
            '        <a href="'+data[i].blp.chapter.murl+'">'+
            '            <p class="name">'+data[i].blp.book.name+'</p>'+
            '            <p class="already">已读：&nbsp;'+data[i].blp.chapter.name+'</p>'+
            '            <p class="latest">最新：&nbsp;'+data[i].blp.book.lastChapter.name+'</p>'+
            '        </a>'+
            '    </dd>'+
            '</dl>'
        }
        console.log(chaptersList)
        var _chapterList = $(chaptersList);
        if(!isManage){
            _chapterList.find('.j_delete').show();
        }
        _chapterList.insertBefore("#search_more");

    };
    mod.toTop=function () {
        $('#j_toTop').click(function () {
            $('html,body').animate({scrollTop:0}, 300);
        });
    };
    return mod;
})();

var page_finish_book = (function () {
    var mod = {};

    mod.init=function () {
        $('.commontitle .text').html('完本专区');
    };
    return mod;
})();
/**
 * Created by admin on 2017/5/8.
 */
var page_free_book = (function () {
    var mod = {};

    mod.init=function (changeTitle) {
        if(changeTitle == 'true'){
            $('.commontitle .text').html('非言情专区');

        }else{
            $('.commontitle .text').html('免费专区');

        }
    };
    return mod;
})();
var page_i = (function () {
    var mod = {};

    mod.init=function () {
        $('.commontitle .text').html('个人中心');
        mod.image_server = $('#image_server').data('imageserver');
        mod.setLevel();
        mod.logout();
    };
    mod.setLevel = function () {
        var jqVip = $('.i_avatar .vip')
        var level = jqVip.data('level');
        console.log(level)
        if(level<0){
            level = 0;
        }
        jqVip.css('background-image','url('+mod.image_server+'/_resources/mobile/image/level_vip/'+level+'.png)');
    };
    mod.logout = function () {
        // 依据是否有wap的头部，判断时候是wap  退出只在wap端显示
        if($('#j_commonHeader').length>0){
            $('#j_logout').show().on('click',function () {
                $('#logoutform').submit();
            });
        }
        // 如果屏幕的高度小于 内容的高度加上  退出按钮的高度
        console.log(document.documentElement.clientHeight)
        console.log($('#pages_i').height())
        console.log($('#j_logout').height())
        if(document.documentElement.clientHeight < $('#pages_i').height() + $('#j_logout').height()){
            $('#j_logout').css({'bottom':'-88px',position:'absolute'})
        }else{
            $('#j_logout').css({'bottom':'0px',position:'fixed'})
        }
    };
    return mod;
})();

var page_rank = (function () {
    var mod = {};

    mod.init=function () {
        $('.commontitle .text').html('排行榜');
    };

    return mod;
})();


var page_recentread = (function () {
    var mod = {};
    var currentPage;
    var totalPage ;
    var sitePath  ;
    var flag = false;

    mod.init = function () {
        currentPage = $('#search_more').data('currentpage') +1;
        totalPage = $('#search_more').data('totalpage');
        sitePath = $('#search_more').data('sitepath');
        mod.collect();
        mod.winScroll();
    };
    mod.collect = function () {
        $('#page_recentread').on('click', '.collectbox', function (ev) {
            var collectJq = $(this).find('.collect');
            var bookId = collectJq.data('bookid');
            // 如果是已收藏的状态  ，点击无效
            if (collectJq.html() === '收藏') {
                collectJq.html('已收藏').addClass('collect_already');
                $.get('/m/wechat/ajax/book/follow_book?bookId=' + bookId, {}, function (data) {
                    if (data == true) {
                        collectJq.html('已收藏').addClass('collect_already');
                    }
                });
            }
            ev.preventDefault();
        })
    };
    mod.winScroll = function () {
        $(window).scroll(function () {
            console.log(currentPage)
            console.log(totalPage)
            console.log(flag)
            if ($(document).scrollTop() >= $('body').height() - $(window).height()) {
                // 展示loading
                $("#search_more").show();
                $('.fixedbottom').hide();
                // 如果 当前页大于 总页数 （已经获取过的情况下） 不再ajax
                if (currentPage > totalPage) {
                    setTimeout(function () {
                        $('#search_more').hide();
                        $('.fixedbottom').show();
                    },1000)
                } else if (!flag) {
                    // 如果 上次请求已经结束，请求
                    flag = true;
                    if (currentPage > 0) {
                        mod.ajaxList(currentPage);
                    }
                }
            }
        })
    };
    mod.ajaxList = function (curPage) {
        var pageUrl = '/m/'+ sitePath +'/ajax/people/lately?page=' + curPage;
        $.ajax({
            type: "get",
            url: pageUrl,
            dataType: 'json',
            success: function (result) {
                currentPage++;
                flag = false;
                var recentsList_str = '';
                for (var i = 0; i < result.length ; i++) {
                    recentsList_str +='<dl>';
                    recentsList_str +=  '    <div class="collectbox">';
                    if(result[i].follow == null){
                        recentsList_str +=  '        <span class="collect" data-bookid="'+result[i].book.id+'" >收藏</span>';

                    }else{
                        recentsList_str +=  '        <span class="collect collect_already"  data-bookid="'+result[i].book.id+'" >已收藏</span>';

                    }
                    recentsList_str +=  '    </div>';
                    recentsList_str +=  '    <dt>';
                    recentsList_str +=  '        <a href="'+result[i].book.murl+'">';
                    recentsList_str +=  '            <img src="'+result[i].book.imageUrlSmall+' " alt="'+result[i].book.name+' "   title="'+result[i].book.name+'">';
                    recentsList_str +=  '        </a>';
                    recentsList_str +=  '    </dt>';
                    recentsList_str +=  '    <dd>';
                    recentsList_str +=  '        <a href="'+result[i].chapter.murl+'">';
                    recentsList_str +=  '            <p class="name">'+result[i].book.name+' </p>';
                    recentsList_str +=  '            <p class="already">已读：&nbsp;'+result[i].chapter.name+' </p>';
                    recentsList_str +=  '            <p class="latest"><span>最新章节：</span>'+result[i].book.lastChapter.name+' </p>';
                    recentsList_str +=  '        </a>';
                    recentsList_str +=  '    </dd>';
                    recentsList_str +=  '</dl>';
                }
                var _recentList = $(recentsList_str);
                _recentList.insertBefore("#search_more");
                $('#search_more').hide();
            }
        });
    };
    return mod;
})();
var page_search = (function () {
    var mod = {};
    var currentPage  = 1;
    var flag = false;
    mod.queryString='';
    mod.init=function () {
        // 设置文字溢出省略
        mod.setEllipsis();
        // 添加上划刷新功能
        mod.scrollMethod();
        var oForm = $('#submit_form');
        var search_word = '';
        $('#j_button').click(function () {
            search_word = $('.result_s_input').val();
            $('#searchword_hidden').val(search_word);
            oForm.submit();
        });
        $('#result_s_input').on('input propertychange',function () {
            search_word = $('#result_s_input').val();
            $('#searchword_hidden').val(search_word);
        });
        $('#page_search').on('click','.j_search_word',function () {
            var search_word= $(this).html();
            $('#searchword_hidden').val(search_word);
            oForm.submit();
        });
    };
    mod.setEllipsis = function () {
        $('.j_ellipsis').each(function () {
            var text = $(this).text();
            console.log(text);
            if(text.length>30){
                text = text.substring(0,25)+'...';
            }
            $(this).text(text);
        })
    };
    // 上划获取更多
    mod.scrollMethod = function () {
        scrollOut.init();
        var totalPage = $("#totalpage").val();
        mod.queryString = $('.result_s_input').val();
        currentPage++;
        console.log(totalPage)
        // 增加刷新回调方法
        scrollOut.addScrollFn(function () {
            $("#search_more").show();
            $('.fixedbottom').hide();
            if (currentPage > totalPage) {
                setTimeout(function () {
                    $('#search_more').hide();
                    $('.fixedbottom').show();
                },1000);
            } else if (!flag) {
                // 如果 上次请求已经结束，请求
                flag = true;
                if (currentPage > 0) {
                    mod.ajaxList(currentPage);
                }
            }

        });
    };
    mod.ajaxList = function (curPage) {
        var pageUrl = "/modules/article/search.php";
        console.log(pageUrl);
        $.ajax({
            type: "GET",
            url: pageUrl,
            dataType: "json",
            data:{
                page:curPage,
                searchtype:"all",
                searchkey:mod.queryString,
                jieqi_token:jieqi_token,
                ajax_gets:1
            },
            success: function (result) {
                flag = false;
                currentPage++;
                mod.addNewDl(result);
                $('#search_more').hide();
            }
        });
    };
    mod.addNewDl = function (data) {
        var data = data.books;
        var bookList = '';
        for (var i = 0; i < data.length ; i++) {
            bookList+=
                '<div class="list_item">'+
                '    <div class="left_image">'+
                '        <a href="'+data[i].url_articleinfo+'" data-collect-index="1">'+
                '            <img src="'+data[i].url_image+'">'+
                '        </a>'+
                '    </div>'+
                '    <div class="right_content">'+
                '        <a href="'+data[i].url_articleinfo+'" data-collect-index="1">'+
                '            <p class="title">'+data[i].articlename+'</p>'+
                '            <p class="author">'+
                '                <span>'+data[i].author+'著&nbsp;|&nbsp;</span>'+
                '                <span>'+data[i].keywords+'</span>'+
                '            </p>'+
                '           <p class="reader">'+data[i].allvisit+'人阅读 | '+data[i].fullflag+' </p>'+
                '           <p class="brief j_ellipsis">'+data[i].intro+'</p>'+
                '        </a>'+
                '    </div>'+
                '</div>'
        }
        console.log(bookList);
        $('.result_content').append(bookList);
        mod.setEllipsis();
    };

    return mod;
})();
console.log(page_search);



