$(function(){
	$(".yhj_check").click(function(){
		$(this).toggleClass("show_check");
	});
	$("#fpx").click(function(){
		if($("#fpx").hasClass("show_check")){
			$(".fapiao").show();
		}else if(!$("#fpx").hasClass("show_check")){
			$(".fapiao").hide();
		}
	})
	
})