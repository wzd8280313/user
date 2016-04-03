/*TAB菜单切换*/
$(function(){		
	//设计案例切换
	$('.title-list li').click(function(){
		var liindex = $('.title-list li').index(this);
		$(this).addClass('on').siblings().removeClass('on');
		$('.product-wrap div.product').eq(liindex).fadeIn(150).siblings('div.product').hide();
		var liWidth = $('.title-list li').width();
		$('.portfolio .title-list p').stop(false,true).animate({'left' : liindex * liWidth + 'px'},300);
	});
	});




/*上下滚动按钮*/

$(document).ready(function(){
	$('.mr_frBtnR,.mr_frBtnL').hover(function(){
			$(this).fadeTo('fast',1);
		},function(){
			$(this).fadeTo('fast',0.7);
	})

})
/*组合销售遮罩层*/
$(document).ready(function(){
     $(".js_show_chooice").click(function(){
         var _obj = $(this)
            ,_id = $(this).attr('js_data');
         _obj.parent('.sales').siblings('.js_post_data').each(function(){
             if($(this).is(":visible"))
             {
                var  _comId = $(this).attr('js_data')
                    ,chk_value =[];//定义一个数组      
                $(this).find('input[name="chooise"]:checked').each(function(){   
                    chk_value.push($(this).val());     
                });
                if(chk_value.length == 0)
                {
                    return false;
                }
                else
                {                      
                    var url = _url + '/ids/'+chk_value+'/id/'+_id;
                    $.getJSON(url,function(json)
                    {
                        if(json.spec == 1)
                        {
                            $('#combineInfoBox').empty();
                            for(var item in json.data)
                            {                                   
                                var html = template.render('combineInfoTemplate',json.data[item]);      
                                $('#combineInfoBox').append(html);                    
                            }
                            $(".mask_layer,.port_overlay").css("display","block");  
                            if(_obj.hasClass('liji'))
                            {
                                $(".J_ComboBuy").show().attr('js_data', _comId);
                                $(".J_ComboAddCart").hide();
                            }
                            else
                            {
                                 $(".J_ComboBuy").hide();
                                 $(".J_ComboAddCart").show().attr('js_data', _comId);
                            }
                        }
                    });
                    
                }
             }
         })
         
     });
     $(".overlay_close,.mask_layer").click(function(){
        $(".mask_layer,.port_overlay").css("display","none");
     }); 
});
	

	
	/*规格选择*/	


	$(document).ready(function(){
  $(".chooice_clor").click(function(){
   $(this).toggleClass("have_style");
  
  });               
});

        


	
	
	
	
	
	
	
	
	
	
	