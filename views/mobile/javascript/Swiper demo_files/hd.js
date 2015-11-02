//头部滑动
$(document).ready(function(){
	    var swiperHead = new Swiper('.swiper-container.head', {
	        slidesPerView: 4,
	        paginationClickable: true,
	        spaceBetween:2,
	        slideToClickedSlide: true,
	    });
	    swiperHead.on('click', function(evt){
	    	swiperPanel.slideTo(swiperHead.clickedIndex);
	    	$(".swiper-container.head").find(".swiper-slide").eq(swiperHead.clickedIndex).addClass("active").siblings().removeClass("active");
	    });
		
//内容滑动
		var swiperPanel = new Swiper('.swiper-container.panel', {
	        slidesPerView: 1
	    });
	    swiperPanel.on('slideChangeEnd', function(evt){
	    	swiperHead.slideTo(swiperPanel.activeIndex);
	    	$(".swiper-container.head").find(".swiper-slide").eq(swiperPanel.activeIndex).addClass("active").siblings().removeClass("active");
	    });
});
//头部滑动

alert(document.body.clientWidth);
alert(document.body.clientHeight);
alert(document.body.offsetWidth);
alert(document.body.offsetHeight);

alert(document.body.scrollWidth);
alert(document.body.scrollHeight);

alert(document.body.scrollTop);
alert(document.body.scrollLeft);
alert(window.screenTop);
alert(window.screenLeft);
alert(window.screen.height);
alert(window.screen.width);
alert(window.screen.availHeight);
alert(window.screen.availWidth);
	

