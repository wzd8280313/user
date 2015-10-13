function showMorePro(){
	$('.loading-imgS img').show();
	$('.loading-imgS p').hide();
	var page = parseInt($('input[name=page]').val());
	var childCat = $('input[name=childCat]').val();
	var order = $('input[name=order]').val();
	$.ajax({
		type:'post',
		async:true,
		data:{page:page,childCat:childCat,order:order},
		dataType:'json',
		url:getMoreUrl,
		beforeSend:function(){
			
		},
		success:function(data){
			if(data==0){
				
			}else{
				for(var i in data){
					var newPro = template.render('probox',data[i]);
					$('#dataList').append(newPro);
				}
				$('input[name=page]').val(page+1);
			}
		},
		complete:function(){
			$('.loading-imgS img').hide();
			$('.loading-imgS p').show();
		},
		timeout:1000,
	})
}
