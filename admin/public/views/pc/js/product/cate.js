/**
 * Created by weipinglee on 2016/4/18.
 */
//给分类添加属性
function addAttr(){
    var attr_id = $('#all_attr').val();
    var attr_text = $('#all_attr').find('option:selected').text();
    var end = false;
    $('#attr_box').find('input[name^=attr_id]').each(function(){
        if($(this).val()==attr_id)
            end = true;
    })
    if(end)
        return false;
    var attr_input = $('.attr').clone();
    attr_input.find('input').eq(0).val(attr_text);
    attr_input.find('input').eq(1).val(attr_id).attr('name','attr_id[]');
    attr_input.css('display','block').removeClass('attr');
    attr_input.find('a').bind('click',delAttr);
    $('#attr_box').append(attr_input);
}
//属性删除
function delAttr(){
    $(this).parent('div').remove();
}

$(function(){
    $('#attr_box').find('a').bind('click',delAttr);
})