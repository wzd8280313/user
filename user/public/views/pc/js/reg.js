 $(function(){
    $(".register_top .reg_zc").click(function(){
        $(".reg_zc").removeClass("border_bom");
        $(this).addClass("border_bom");
    });
    $(".register_top .register_l").click(function(){
        $(".gr_reg").css({'display':'block'});
        $(".qy_reg").css({'display':'none'}); 
    });
    $(".register_top .register_r").click(function(){
        $(".gr_reg").css({'display':'none'});
        $(".qy_reg").css({'display':'block'}); 
    });


                    
})

 //检验用户名是否已注册
 //此处obj是htmlElement对象，不是选择器对象，所以不能obj.attr('name')
 function checkUser(obj){
     var username = obj.value;
     var field = obj.getAttribute('name');
     var res = false;
     $.ajax({
         url:$('input[name=checkUrl]').val(),
         async:false,
         type:'post',
         data : {field:field,value:username},
         success:function(data){
             if(data==1){
                 res = field=='username'?'用户名已存在' : '手机号已存在';
             }
         }
     })
     return res;

 }


