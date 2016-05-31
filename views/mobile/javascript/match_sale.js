$(document).ready(function(){
		$(".chooi_none").click(function(){
        $(this).toggleClass("chooi_have");
　　});
	});



			
$(function(){
        var aClick=$('.attr_chooi .jrgwc');
        var aDiv=$('.tc-modal-active');
        var i=0;
    $(aClick).each(function(){

      var index = aClick.index(this);
        $(this).click(function(){
          $(aDiv).eq(index).show();
          $(aDiv).eq(index).removeClass("tc_shop");
          $("body").append('<div class="sharebg"></div>');
          $(".sharebg").addClass("sharebg-active");
        })
    });
   
     $(this).delegate(".sharebg-active,.share_btn,.submit","click",closeMengban)

  });
   function closeMengban(){
    console.log(this)
      $(this).parentsUntil(".zhuhe_figure").find("#tc_shop").addClass("tc_shop"); 
      //$(this).parentsUntil(".zhuhe_figure").find("#tc_shop");   
      //$("#tc_shop").removeClass("tc-modal-active").addClass("tc_shop"); 
      setTimeout(function(){
        $(".sharebg-active").removeClass("sharebg-active"); 
        $(".sharebg").remove(); 
      },300);
    
    }
	


$(function(){
    $(".tc_gg").click(function() {
  $(this).hasClass("tc_backgr") ? $(this).removeClass("tc_backgr") : ($(this).addClass("tc_backgr"), $(this).siblings(".tc_gg").removeClass("tc_backgr"))
});
$("input.submit").click(function() {
  for (var b = $(this).parents(".tc-modal-active").find(" .tc_backgr"), a = "已选", c = 0; c < b.length; c++) a += b[c].innerHTML + ",";
  a = a.substr(0, a.length - 1);
  0 < b.length ? ($(this).parents(".js_sel_attr").find(".jrgwc span").html(a), $(this).parents(".js_sel_attr").find(".jrgwc span").css("color", "#aaa")) : ($(this).parents(".js_sel_attr").find(".jrgwc span").html("请选择商品属性"), $(this).parents(".js_sel_attr").find(".jrgwc span").css("color", "#ff5500"))
}); });
  
    
  