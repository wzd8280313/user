$(document).ready(function(){
    $(window).scroll(function(){
        var top = $(document).scrollTop();          //定义变量，获取滚动条的高度
        var active = $("#active");                      //定义变量，抓取#active
        var items = $("#content").find(".item");    //定义变量，查找.item

        var curId = "";                             //定义变量，当前所在的楼层item #id 

        items.each(function(){
            var m = $(this);                        //定义变量，获取当前类
            var itemsTop = m.offset().top;        //定义变量，获取当前类的top偏移量
            if(top > itemsTop-100){
                curId = "#" + m.attr("id");
            }else{
                return false;
            }
        });

        //给相应的楼层设置cur,取消其他楼层的cur
        var curLink = active.find(".cur");
        if( curId && curLink.attr("href") != curId ){
            curLink.removeClass("cur");
            active.find( "[href=" + curId + "]" ).addClass("cur");
        }
        // console.log(top);
    });
     $(".item").each(function(i){
        $(this).prop('id',"item"+(i+1));
    });
/*距离顶部的距离*/
$(function(){
    var head_top = ''; 
    $(window).scroll(function(){  
        var scroH = $(this).scrollTop()+150;
        if(head_top == ''){
            head_top = $('#item1').offset().top;
        }
        if(scroH>=head_top){  
 
            $("#active").css({"display":"block"});
           
        }else if(scroH<head_top){  
     
            $("#active").css({"display":"none"});  
     
        }  
    
    })
})
});
