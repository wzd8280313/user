var myScroll;
var BicPicScroll;
var showBig = false;
var goods_id = id;
function loaded() {
    myScroll = new iScroll('wrapper', {
        snap: true,
        momentum: false,
        hScrollbar: false,
        onScrollEnd: function () {
            num = this.currPageX+1;
            if(num>4){
                num = num%4;
            }
            $('#indicator').html(num);
        }
    });

}
//count int 图片数量
function loadedBig(count){
    BicPicScroll = new iScroll('wrapper1', {
        snap: true,
        momentum: false,
        hScrollbar: false,
        onScrollEnd: function () {
            num = this.currPageX+1;
            if(num>count){
                num = num%count;
            }
            $('#indicatorBig').html(num);
            if(this.currPageX==0){
                $('#prev_big').hide();
                $('#next_big').show();
            }else if(this.currPageX==3){
                $('#next_big').hide();
                $('#prev_big').show();
            }else{
                $('#next_big').show();
                $('#prev_big').show();
            }
        }
    });
}
document.addEventListener('DOMContentLoaded', loaded, false);

setInterval(function(){  
    if(myScroll.currPageX==3){
        myScroll.scrollToPage(0, 0);
    }else{
        myScroll.scrollToPage('next', 0);}
},5000);
function next_pic(){alert();
    if(myScroll.currPageX==3){
        myScroll.scrollToPage(0, 0);
    }else{
        myScroll.scrollToPage('next', 0);}
}
function prev_pic(){
    if(myScroll.currPageX==0){
        myScroll.scrollToPage(3, 0);
    }else{
        myScroll.scrollToPage('prev', 0);}
}


//share

function toshare(){
	$(".am-share").addClass("am-modal-active");	
	if($(".sharebg").length>0){
		$(".sharebg").addClass("sharebg-active");
	}else{
		$("body").append('<div class="sharebg"></div>');
		$(".sharebg").addClass("sharebg-active");
	}
	$(".sharebg-active,.share_btn").click(function(){
		$(".am-share").removeClass("am-modal-active");	
		setTimeout(function(){
			$(".sharebg-active").removeClass("sharebg-active");	
			$(".sharebg").remove();	
		},300);
	})
}	
	
function viewBigPicOn(){
	$('article').hide();
	$('footer').hide();
	$('header').hide();
	$('.breadcrumb').hide();
	$('.detail_nav').hide();
	$('.viewbig').show();
	$('.viewbig img').each(function (){
		img=$(this).attr('data-src');
		$(this).attr('src',img);
	});
	loadedBig($('.viewbig img').length);
	showBig=true;
}
function viewBigPicOff(){
	$('article').show();
	$('footer').show();
	$('header').show();
	$('.breadcrumb').show();
	$('.detail_nav').show();
	$('.viewbig').hide();
	$('.layout_nav_path').hide();
	loaded();
	showBig=false;
}

//产品详情页首页导航切换
function show_det1(_this){
		$('.lin').removeClass('lin');
		$(_this).parent('li').addClass('lin');
		$('#det1').removeClass('hidden');
		$('#det_tuijian').removeClass('hidden');
		$('#det2').addClass('hidden');
		$('#comments').addClass('hidden');
}
function show_det2(_this){
	$('.lin').removeClass('lin');
	$(_this).parent('li').addClass('lin');
	$('#det2').removeClass('hidden');
	$('#det_tuijian').removeClass('hidden');
	$('#det1').addClass('hidden');
	$('#comments').addClass('hidden');
}
function show_comments_list(_this){
	$('.lin').removeClass('lin');
	$(_this).parent('li').addClass('lin');
	$('#det2').addClass('hidden');
	$('#det1').addClass('hidden');
	$('#det_tuijian').addClass('hidden');
	$('#comments').removeClass('hidden').find('.anniu').remove();
	$('#comments').find('ul').remove();
	$('#comments').find('hr').remove();
	comment_ajax_list('all',1);
}
/**
 * 获取评论数据(详情首页)
 * @type int 评价等级 
 */
function comment_ajax(type)
{
	var url = comments_url;
	$.getJSON(url,{type:type},function(json){
		for(var item in json.comment_list)
		{
			var commentHtml = template.render('commentRowTemplate',json.comment_list[item]);
			$('#commentBox').prepend(commentHtml);
		}
	});
}

/**
 * 获取评论数据（详情页评价）
 * @param type 评论类型
 * @param statics bool 是否加载统计数据
 */
function comment_ajax_list(type,statics){
	var url = comments_url;
	$.getJSON(url,{type:type},function(json)
	{
		json.point_grade.comment_total=json.comment_total;
		if(statics){
			var commentHtml = template.render('comment_statics',json.point_grade);
			$('#comments').prepend(commentHtml);
			$('.anniu div').on('click',function(){
				$('#comments .content ul').remove();
				$('#comments .content hr').remove();
				comment_ajax_list($(this).attr('type'));
			})
		}
		for(var i in json.comment_list)
		{
			var commentHtml = template.render('comment_list',json.comment_list[i]);
			$('#comments .content').append(commentHtml);
		}
		
	});
}



$(function(){
	comment_ajax();//加载评论数据
	
	window.onscroll = function(){
		if ($('#comments').css('display')!='none' && $(document).scrollTop() >= $(document).height() - $(window).height()){
		 	comment_ajax_list(type);
		 }
	}

})


/**
 * 规格的选择
 * @param _self 规格本身
 */
function sele_spec(_self)
{
	var specObj = $.parseJSON($(_self).find('a').attr('value'));

	//已经为选中状态时
	if($(_self).attr('class') == 'current')
	{
		$(_self).removeClass('current');
	}
	else
	{
		//清除同行中其余规格选中状态
		$('#specList'+specObj.id).find('span.current').removeClass('current');
		$(_self).addClass('current');
	}

	//检查规格是否选择符合标准
	if(checkSpecSelected())
	{
		//整理规格值
		var specArray = [];
		$('[name="specCols"]').each(function(){
			specArray.push($(this).find('span.current a').attr('value'));
		});
		var specJSON = '['+specArray.join(",")+']';

		//获取货品数据并进行渲染
		$.getJSON(product_url,{"goods_id":goods_id,"specJSON":specJSON,"random":Math.random},function(json){
			
			if(json.flag == 'success')
			{
				var goods_data = json.data;
				var price = goods_data.group_price ? goods_data.group_price : goods_data.sell_price;
				$('.tc_cont .price').text('￥'+price);
			
				//普通货品数据渲染
				$('#data_storeNums').text(goods_data.store_nums);
				$('#product_id').val(goods_data.id);

				//库存监测
				checkStoreNums();
			}
			else
			{
				alert(json.message);
				closeBuy();
			}
		});
	}
}

/**
 * 购物车数量的加减
 * @param code 增加或者减少购买的商品数量
 */
function modified(code)
{
	var buyNums = parseInt($.trim($('#buyNums').val()));
	switch(code)
	{
		case 1:
		{
			buyNums++;
		}
		break;

		case -1:
		{
			buyNums--;
		}
		break;
	}

	$('#buyNums').val(buyNums);
	checkBuyNums();
}
/**
 * 监测库存操作
 */
function checkStoreNums()
{
	var storeNums = parseInt($.trim($('#data_storeNums').text()));
	if(storeNums > 0)
	{
		openBuy();
	}
	else
	{
		closeBuy();
	}
}
//禁止购买
function closeBuy()
{
	if($('#buyNowButton').length > 0)
	{
		$('#buyNowButton').attr('disabled','disabled');
		$('#buyNowButton').addClass('disabled');
	}
}

//开放购买
function openBuy()
{
	if($('#buyNowButton').length > 0)
	{
		$('#buyNowButton').removeAttr('disabled');
		$('#buyNowButton').removeClass('disabled');
	}

}
/**
 * 检查规格选择是否符合标准
 * @return boolen
 */
function checkSpecSelected()
{
	if($('[name="specCols"]').length === $('[name="specCols"] .current').length)
	{
		return true;
	}
	return false;
}

//检查购买数量是否合法
function checkBuyNums()
{
	//购买数量小于0
	var buyNums = parseInt($.trim($('#buyNums').val()));
	if(buyNums <= 0)
	{
		$('#buyNums').val(1);
		return;
	}

	//购买数量大于库存
	var storeNums = parseInt($.trim($('#data_storeNums').text()));
	if(buyNums >= storeNums)
	{
		$('#buyNums').val(storeNums);
		return;
	}
}
