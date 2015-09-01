
$(document).ready(function(){
	$(".floor .fl-cnt .fl-rcmd .fl-rcmd-bg .admanage a").mouseenter(function(){
		$(this).find(".shine").stop();
		$(this).find(".shine").css("opacity","0.4"); 
		$(this).find(".shine").animate({opacity: '0'},500);
	});
});
$(document).ready(function(){
	$(".floor .fl-cnt .fl-rcmd1 .fl-rcmd-bg1 .admanage a").mouseenter(function(){
		$(this).find(".shine").stop();
		$(this).find(".shine").css("opacity","0.4"); 
		$(this).find(".shine").animate({opacity: '0'},500);
	});
});

$(document).ready(function(){
	$(".goods-list .goods-img").mouseenter(function(){
		$(this).find(".shine").stop();
		$(this).find(".shine").css("opacity","0.4"); 
		$(this).find(".shine").animate({opacity: '0'},500);
	});
});