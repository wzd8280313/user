/**
 * 认证页面js
 * author:weipinglee
 * date:2016/4/29
 */

//切换tab
function nextTab(step){
    if(step===undefined){
        $('.rz_ul').find('.cur').next('li').find('a').trigger('click');
    }
   else{
        $('.rz_ul').find('li.rz_li').eq(step-1).find('a').trigger('click');
    }


}

$(function(){
    var validObj = formacc;
    $('#next_step').on('click',function(){
        validObj.ignore('.yz_img input');
        if(validObj.check()){
            nextTab();
            validObj.unignore();
        }
    })

    //为地址选择框添加验证规则
    var rules = [{
        ele:"input[name=area]",
        datatype:"n6-6",
        nullmsg:"请选择地址！",
        errormsg:"请选择地址！"
    }];
    validObj.addRule(rules);


})


