var g_pageCount = 0;
var doCreatePageNav   = function (devobj, currentPage, pageCount) {
    //console.log(currentPage);
    g_pageCount = pageCount;
    $('.pageNum').val(currentPage);
    $('.pageform').show()
    if(!pageCount || pageCount<=1){
        $('.pageform').hide()
    }
    $(devobj).html('');
    if(currentPage<=1 && pageCount<=1){
        return;
    }

    //上页标签
    if (currentPage > 1) {

        var lastPage = currentPage - 1;
        $(devobj).append('<li><a href="javascript:void(0);" onclick="doPage(' + lastPage + ')">上一页</a></li>');
    }
    //第一页标签
    if (currentPage == 1) {
        $(devobj).append('<li class="on"><a href="javascript:void(0);" onclick="doPage(1)">1</a></li>');
    } else {
        $(devobj).append('<li><a href="javascript:void(0);" onclick="doPage(1)">1</a></li>');
    }

    ////前段省略号 （总页数大于8）
    if (pageCount>8 && currentPage>4) {
        $(devobj).append('<li>...</li>');
    }


    var minLimit = 1;
    var maxLimit = 5;
    if(pageCount<9){
        minLimit = 1;
        maxLimit = pageCount-1;
    }

    if(pageCount>=9 && currentPage<=4){
        minLimit = 2;
        maxLimit = 5;
    }
    if(pageCount>=9 && currentPage>4 && pageCount-currentPage>=4){
        minLimit = parseInt(currentPage)-2;
        maxLimit = parseInt(currentPage)+2;
    }
    if(pageCount>=9 && currentPage>4 && pageCount-currentPage<4){
        minLimit = parseInt(pageCount)-4;
        maxLimit = parseInt(pageCount)-1;
    }

    // if(pageCount>=9){
    //      if(currentPage<=4){
    //         minLimit = 2;
    //         maxLimit = 5;
    //      }else if(currentPage>4){
    //         minLimit = currentPage - 2;
    //         maxLimit = 5;
    //      }
    //         minLimit = currentPage-2;
    //      if(pageCount-currentPage>4){
    //         maxLimit = currentPage+2;
    //      }else{
    //         maxLimit = pageCount-1;
    //      }
    //  }




    for (i = minLimit; i <=maxLimit; i++) {
        var  currentNum = i;
        if (currentNum > 1 && currentNum != currentPage && currentNum < pageCount) {
            $(devobj).append('<li><a href="javascript:void(0);" onclick="doPage(' + currentNum + ')">' + currentNum + '</a></li>');
        }

        if (currentNum > 1 && currentNum == currentPage && currentNum != pageCount) {

            $(devobj).append('<li class="on"><a href="javascript:void(0);" onclick="doPage(' + currentNum + ')">' + currentNum + '</a></li>');
        }
    }


    //后端的省略
    if (pageCount>=9 && pageCount-currentPage >= 4) {
        $(devobj).append('<li>...</li>');
    }
    //是否显示下一页
    if (pageCount > 1 && pageCount != currentPage) {
        $(devobj).append('<li ><a href="javascript:void(0);" onclick="doPage(' + pageCount + ')">' + pageCount + '</a></li>');
    }

    if (pageCount > 1 && pageCount == currentPage) {
        $(devobj).append('<li class="on" ><a href="javascript:void(0);" onclick="doPage(' + pageCount + ')">' + pageCount + '</a></li>');
    }

    //下一页
    if (pageCount > 1 && currentPage < pageCount) {
        currentPage++;
        $(devobj).append('<li ><a href="javascript:void(0);" onclick="doPage(' + currentPage + ')">下一页</a></li>');
    }

}

$(function () {

    $('.pageNum').on("keyup",function () {
        var val = $(this).val();
        if(isNaN(val) || val <= 0){
            $(this).val("")
            return;
        }
        if(val>g_pageCount){
            $(this).val("")
            return;
        }




    })

    $(".gobtn").on("click",function () {
        var parent = $(this).parent();
        var pageNum = parent.find('.pageNum').val();
        if(!pageNum){
            return;
        }

        if(pageNum > g_pageCount || pageNum <= 0){
            alert("请输入正确的页数哦~");
            parent.find('.pageNum').val(' ');
            return ;
        }

        if(isNaN(pageNum)){
            alert("请输入大于0数字!");
            return;
        }

        doPage(pageNum);
    })


})


