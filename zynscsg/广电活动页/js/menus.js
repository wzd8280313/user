$(document).ready(function(){
    $(window).scroll(function(){
        var top = $(document).scrollTop();          //定义变量，获取滚动条的高度
        var menu = $("#menu");                      //定义变量，抓取#menu
        var items = $("#content").find(".item");    //定义变量，查找.item

        var curId = "";                             //定义变量，当前所在的楼层item #id 

        items.each(function(i){
            var m = $(this);                        //定义变量，获取当前类
            var itemsTop = m.offset().top;        //定义变量，获取当前类的top偏移量
            if(top > itemsTop-100){

                //给相应的楼层设置cur,取消其他楼层的cur
                var li=menu.find("li a");
                for(var j=0;j<li.length;j++){
                    $(li[j]).removeClass("cur");
                }
                $(li[i]).addClass("cur");

            }else{
                return false;
            }
        });
        //必须公用一个onscroll监测事件！！！负责下面的scroll会抵消上面的事件
        var head_top = '';
            var scroH = $(this).scrollTop()+200;
            if(head_top == ''){
                head_top = $('#item1').offset().top;
            }
            if(scroH>=head_top){

                $("#menu").css({"display":"block"});

            }else if(scroH<head_top){

                $("#menu").css({"display":"none"});

            }
    });
    /*相应增加id*/
    $(".item").each(function(i){
        $(this).prop('id',"item"+(i+1));
    });


});
