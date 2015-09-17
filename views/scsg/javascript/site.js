//关闭product购物车弹出的div
function closeCartDiv()
{
	$('#product_myCart').hide('slow');
	$('.submit_join').removeAttr('disabled','');
}

//商品移除购物车
function removeCart(urlVal,goods_id,type)
{
	var goods_id = parseInt(goods_id);

	$.getJSON(urlVal,{goods_id:goods_id,type:type},function(content){
		if(content.isError == false)
		{
			$('[name="mycart_count"]').html(content.data['count']);
			$('[name="mycart_sum"]').html(content.data['sum']);
		}
		else
		{
			alert(content.message);
		}
	});
}

//添加收藏夹
function favorite_add_ajax(urlVal,goods_id,obj)
{
	$.getJSON(urlVal,{goods_id:goods_id,nocache:((new Date()).valueOf())},function(content){
		if(content.isError == false)
		{
			obj.value = content.message;
		}
		else
		{
			alert(content.message);
		}
	});
}



//购物车展示
function showCart(urlVal)
{
	$.getJSON(urlVal,{sign:Math.random()},function(content)
	{
		var cartTemplate = template.render('cartTemplete',{'goodsData':content.data,'goodsCount':content.count,'goodsSum':content.sum});
		$('#div_mycart').html(cartTemplate);
		$('#div_mycart').show();
	});
}

//自动完成
function autoComplete(ajaxUrl,linkUrl,minLimit)
{
	var minLimit = minLimit ? parseInt(minLimit) : 2;
	var maxLimit = 10;
	var keywords = $.trim($('input:text[name="word"]').val());

	//输入的字数通过规定字数
	if(keywords.length >= minLimit && keywords.length <= maxLimit)
	{
		$.getJSON(ajaxUrl,{word:keywords},function(content){

			//清空自动完成数据
			$('.auto_list').empty();

			if(content.isError == false)
			{
				for(var i=0; i < content.data.length; i++)
				{
					var searchUrl = linkUrl.replace('@word@',content.data[i].word);
					$('.auto_list').append('<li onclick="event_link(\''+searchUrl+'\')" style="cursor:pointer"><a href="javascript:void(0)">'+content.data[i].word+'</a>约'+content.data[i].goods_nums+'个结果</li>');
					//鼠标经过效果
					$('.auto_list li').bind("mouseover",
						function()
						{
							$(this).addClass('hover');
						}
					);
					$('.auto_list li').bind("mouseout",
						function()
						{
							$(this).removeClass('hover');
						}
					);
				}
				$('.auto_list').show();
			}
			else
			{
				$('.auto_list').hide();
			}
		});
	}
	else
	{
		$('.auto_list').hide();
	}
}

//输入框
function checkInput(para,textVal)
{
	var inputObj = (typeof(para) == 'object') ? para : $('input:text[name="'+para+'"]');

	if(inputObj.val() == '')
	{
		inputObj.val(textVal);
	}
	else if(inputObj.val() == textVal)
	{
		inputObj.val('');
	}
}
//倒计时函数
//min_id 小于min_id的不做处理
var countDown = function(min_id){
		$('.countdown').each(function(){
			var id = $(this).attr('id').split('-')[1];
			if(min_id && id<min_id)return true;
			var temp;
			var endTime = $(this).find('input[name=endTime]').val();
			var now = Date.parse(new Date())/1000;
			var count = endTime - now;
			var day = parseInt(count/(24*3600));
			count=count%(24*3600);
			var hour = (temp = parseInt(count/3600))<10 ? '0'+temp : temp;
			count = count%3600;
			var min = (temp=parseInt(count/60))<10 ? '0'+temp :temp ;
			var sec = (temp=count%60)<10 ? '0' + temp : temp;
			if(day==0){
				$('.day').remove();
			}else{
				$('#cd_day_'+id).text(day);
			}
			
			$('#cd_hour_'+id).text(hour);
			$('#cd_minute_'+id).text(min);
			$('#cd_second_'+id).text(sec);
			
			var count = new countdown();
			count.add(id);
		})
	};

//dom载入成功后开始操作
jQuery(function()
{
	countDown();
	var allsortLateCall = new lateCall(200,function(){$('#div_allsort').show();});
	//商品分类
	$('.allsort').hover(
		function(){
			allsortLateCall.start();
		},
		function(){
			allsortLateCall.stop();
			$('#div_allsort').hide();
		}
	);
	$('.sortlist li').each(
		function(i)
		{
			$(this).hover(
				function(){
					$(this).addClass('hover');
					$('.sublist:eq('+i+')').show();
				},
				function(){
					$(this).removeClass('hover');
					$('.sublist:eq('+i+')').hide();
				}
			);
		}
	);

	//排行,浏览记录的图片
	$('#ranklist li').hover(
		function(){
			$(this).addClass('current');
		},
		function(){
			$(this).removeClass('current');
		}
	);

	//自动完成input框 事件绑定
	var tmpObj = $('input:text[name="word"]');
	var defaultText = tmpObj.val();
	tmpObj.bind({
		focus:function(){checkInput($(this),defaultText);},
		blur :function(){checkInput($(this),defaultText);}
	});
	//自动倒计时
	
	
	//非首页分类面板展开收起
	if($('.cat-list').css('display')=='none'){
		$('#jCat').mouseover(function(){
			$(this).children('.cat-list').css('display','block');
		}).mouseout(function(){
			$(this).children('.cat-list').css('display','none');
		});
	}

});
