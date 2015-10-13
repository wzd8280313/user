  $(document).ready(function(){
	  $(".ycnr").click(function(){
	  $(".top-navs ul li ul").toggle();
	  });
	  
	  //点击加入购物车后，弹出页面中的规格选项
	  $(".tc_gg").click(function(){
			 $(".tc_gg").removeClass("tc_backgr")
			$(this).toggleClass('tc_backgr');
		 });
	  
	});
  
  
//加入购物车弹出框
	function toshop(){
		$("#tc_shop").removeClass("tc_shop").addClass("tc-modal-active");     
	/* 	$(".tc_shop").addClass("tc-modal-active");	 */
		if($(".sharebg").length>0){
			$(".sharebg").addClass("sharebg-active");
		}else{
			//给整个body内增加div层
			$("body").append('<div class="sharebg"></div>');
			$(".sharebg").addClass("sharebg-active");
		}
		$(".sharebg-active,.share_btn").click(function(){
			$("#tc_shop").removeClass("tc-modal-active").addClass("tc_shop");	
			setTimeout(function(){
				$(".sharebg-active").removeClass("sharebg-active");	
				$(".sharebg").remove();	
			},300);
		})
	}	