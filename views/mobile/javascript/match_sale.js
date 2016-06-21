$(document).ready(function(){
		$(".chooi_none").click(function(){
        $(this).toggleClass("chooi_have");
        if(!$(this).hasClass('aton'))
        {
            count_price();
        }
　　});
	});
    
/**
 * 检查规格选择是否符合标准
 * @return boolen
 */
function checkSpecSelected(_obj)
{
    if($(_obj).closest('.js_sel_attr').find('[name="specCols"]').length === $(_obj).closest('.js_sel_attr').find('span.tc_backgr').length)
    {
        return true;
    }
    return false;
}

function sele_spec(_self)
{
    var specObj = $.parseJSON($(_self).find('span').attr('value'));
    
    $(_self).addClass("tc_backgr"), $(_self).siblings(".tc_gg").removeClass("tc_backgr");

    //检查规格是否选择符合标准
    if(checkSpecSelected(_self))
    {
        //整理规格值
        var specArray = []
            ,goods_id = $(_self).closest('.js_sel_attr').attr('js_data');
        $(_self).closest('.js_sel_attr').find('[name="specCols"]').each(function(){
            specArray.push($(this).find('span.tc_backgr').attr('value'));
        });
        var specJSON = '['+specArray.join(",")+']';

        //获取货品数据并进行渲染
        $.getJSON(product_url,{"goods_id":goods_id,"specJSON":specJSON,"random":Math.random},function(json){
            
            if(json.flag == 'success')
            {
                var goods_data = json.data;
                var price = (goods_data.combine_price && goods_data.combine_price != '0.00') ? goods_data.combine_price : (goods_data.group_price ? goods_data.group_price : goods_data.sell_price);
                $(_self).closest('.tc-modal-active').find('p.js_price_data').text('￥'+price);
            
                //普通货品数据渲染
                $(_self).closest('.tc-modal-active').find('p.js_nums_data').text('(库存'+goods_data.store_nums+'件)');
                $(_self).closest('.js_sel_attr').attr('js_product_id', goods_data.id);
                $(_self).closest('.js_sel_attr').attr('js_combine_price', price);
                $(_self).closest('.js_sel_attr').attr('js_price', goods_data.sell_price);

                //库存监测
                if(goods_data.store_nums <= 0)
                {
                    $('.master_play').show().html('库存不足');
                    setInterval(function(){
                        $('.master_play').hide()
                    },2000);
                }
            }
            else
            {
                $('.master_play').show().html(json.message);
                setInterval(function(){
                    $('.master_play').hide()
                },2000);
            }
        });
    }
}


			
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
      $(this).parentsUntil(".zhuhe_figure").find("[name=tc_shop]").addClass("tc_shop"); 
      setTimeout(function(){
        $(".sharebg-active").removeClass("sharebg-active"); 
        $(".sharebg").remove(); 
      },300);
    
    }
	


$(function(){

    $("input.submit").click(function() {
  for (var b = $(this).parents(".tc-modal-active").find(" .tc_backgr"), a = "已选  ", c = 0; c < b.length; c++) a += b[c].innerHTML + ",";
  a = a.substr(0, a.length - 1);
  0 < b.length ? ($(this).parents(".js_sel_attr").find(".jrgwc span").html(a), $(this).parents(".js_sel_attr").find(".jrgwc span").css("color", "#aaa")) : ($(this).parents(".js_sel_attr").find(".jrgwc span").html("请选择商品属性"), $(this).parents(".js_sel_attr").find(".jrgwc span").css("color", "#ff5500"));
  var _pri = $(this).closest('.js_sel_attr').attr('js_price')
    ,_p = $(this).closest('.js_sel_attr').attr('js_combine_price');
    $(this).closest('.js_sel_attr').find('span.js_select_data_price').text(_p);
    $(this).closest('.js_sel_attr').find('span.js_select_sell_price').text(_pri);
    count_price();
}); 
count_price();

$('.js_buy_now').click(function(){
    if($('.main_figure').find('.attr_chooi').length && $('.main_figure').attr('js_product_id') == 0)
    {
        $('.master_play').show().html('请选择商品属性');
        setInterval(function(){
            $('.master_play').hide()
        },2000);
        return;
    }
     var _obj = $(this)
        ,_id = $(this).attr('js_data');
     $('#conintro').find('ul').each(function(){
         if($(this).is(":visible"))
         {
            var  _comId = $(this).attr('js_data')
                ,_err = 0
                ,chk_value =[];//定义一个数组      
            $(this).find('i.chooi_have').each(function(){   
                if($(this).closest('.js_sel_attr').find('.attr_chooi').length && $(this).closest('.js_sel_attr').attr('js_product_id') == 0)
                {
                    $('.master_play').show().html('请选择商品属性');
                    setInterval(function(){
                        $('.master_play').hide()
                    },2000);
                    _err = 1;
                }
                else
                {
                    chk_value.push($(this).attr('js_data'));
                }     
            });
            if(_err == 1)
            {
                return false;
            }
            if(chk_value.length == 0)
            {
                $('.master_play').show().html('请至少选择一个搭配商品');
                setInterval(function(){
                    $('.master_play').hide()
                },2000);
            }
            else
            {
                //设置必要参数
                var ids=''
                    ,type='';
                $(this).find('i.chooi_have').each(function(){
                    var _p = $(this).closest('.js_sel_attr').attr('js_product_id');
                    if(_p != 0)
                    {
                        ids += '$'+_p;
                        type += '$product';
                    }
                    else
                    {
                        ids += '$'+$(this).closest('.js_sel_attr').attr('js_data');
                        type += '$goods';
                    }
                })
                if($('.main_figure').attr('js_product_id') == 0)
                {
                    ids += '$'+$('.main_figure').attr('js_data');
                    type += '$goods';
                }
                else
                {
                    ids += '$'+$('.main_figure').attr('js_product_id');
                    type += '$product';
                }
                url = buy_now_combine_url.replace('@id@',ids).replace('@buyNums@',1).replace('@type@',type).replace('@comId@',_comId);
                //页面跳转
                window.location.href = url;
            }
         }
     })
     
 })
});

function count_price(){
    var _zh = 0
    ,_sell = 0;
    $('.js_sel_attr').each(function(){
        if($(this).is(":visible"))
        {
            if($(this).find('i.chooi_have').length > 0)
            {
                _zh += parseFloat($(this).find('span.js_select_data_price').html());
                _sell += parseFloat($(this).find('span.js_select_sell_price').html());
            }
        }
    })
    _zh += parseFloat($('span.js_main_data_price').html());
    _sell += parseFloat($('span.js_main_sell_price').html());
    $('div.hejit_right').find('em').html(_zh.toFixed(2));
    $('div.hejit_right').find('i').html(parseFloat(_sell - _zh).toFixed(2));
}
  
    
$(function(){
    $(".share_btn,.sharebg").click(function(){
        $(".sharebg").hide();
        $(".tc-modal-active").hide();
    })
});