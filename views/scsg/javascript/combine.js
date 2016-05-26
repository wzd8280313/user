function Spec_combine_show(){
    this.product = {};
    this.new_product =null; 
    this.buy_now_combine_url = buy_now_combine_url; 
    this.join_cart_url = join_cart_url; 
    this.goods_id    = goods_id; 
    this.init = function(_obj,goods_id,product){
        this.product = $.parseJSON(product);
        this.goods_id    = goods_id;
        this.new_product = $.extend({},this.product);
        for(var i in this.product){
            this.product[i].spec_array = this.product[i].spec_array.substring(1,this.product[i].spec_array.length-1);
            this.product[i].spec_array = this.product[i].spec_array.replace(/},/g,'}|');
        }
        this.check_spec_allowed(_obj);
    }
    //规格转义
    this.spec_escape = function(spec){
        var spec_str = '';
        spec_str = spec.replace(/\"/g,'\\"');
        spec_str = spec_str.replace(/:/g,'\\:');
        spec_str = spec_str.replace(/,/g,'\\,');
        spec_str = spec_str.replace(/{/g,'\\{');
        spec_str = spec_str.replace(/}/g,'\\}');
        spec_str = spec_str.replace(/\//g,'\\/');
        spec_str = spec_str.replace(/\./g,'\\.');
        spec_str = spec_str.replace(/\*/g,'\\*');
        spec_str = spec_str.replace(/\+/g,'\\+');
        return spec_str;
    }
        /**
     * 检查规格是否可选
     * @param {Object} _self
     */
    this.check_spec_allowed = function (_obj){
        var _this= this;
        var product = this.product;
        var curr_spec = [];
        $(_obj).parent().children('em.yListrclickem').each(function(i){
            curr_spec.push($(this).attr('value'));
        })
        
        $(_obj).parent().children('em').not('[class~=yListrclickem]').removeClass('allowed').addClass('not-allowed');//先把所有 未选中元素设为不可选
        var spec_show_now = [];//下一步要显示的规格数组
        for(var i in product){
            var pro_arr = product[i].spec_array.split('|');
            var is = 1;
            $.each(curr_spec,function(j,v){
                if(pro_arr.indexOf(v)=='-1')is=0;
            })
            if(product[i].store_nums>0 && is==1){
                $.each(pro_arr,function(index,value){
                    spec_show_now.push(value);
                })
                
            }
        
        }
        $.each(curr_spec,function(j,v){
            var spec_tem = curr_spec.splice(j,1);
            for(var i in product){
                var pro_arr = product[i].spec_array.split('|');
                var is = 1;
                $.each(curr_spec,function(j,v){
                    if(pro_arr.indexOf(v)=='-1')is=0;
                })
                if(product[i].store_nums>0 && is==1){
                    $.each(pro_arr,function(index,value){
                        spec_show_now.push(pro_arr[j]);
                    })
                }
            }
            curr_spec.unshift(spec_tem[0]);
        })
        $.each(spec_show_now,function(i,v){
            $(_obj).parent().children('em').each(function(){
                if($(this).attr('value') == v.substring(1,v.length-1))
                {
                    $(this).removeClass('not-allowed').addClass('allowed');
                }
            })
        })
    
    }
    /**
     * 规格的选择
     * @param _self 规格本身
     */
    this.sele_spec = function(_self, id, product)
    {
        this.product = product;
        this.goods_id = id;
        var new_product = this.new_product;
        var specObj = $.parseJSON($(_self).attr('value'));
        if($(_self).hasClass('not-allowed'))return false;
        $(_self).addClass("yListrclickem").siblings().removeClass("yListrclickem");
        this.check_spec_allowed(_self);
        //检查规格是否选择符合标准
        
        if(this.checkSpecSelected($(_self).closest('ul')))
        {
            //整理规格值
            var specArray = [];
            $(_self).parents('.yListr').find('li').each(function(){
                specArray.push($(this).find('em.yListrclickem').attr('value'));
            });
            var specJSON = specArray.join("|");
            for(var i in new_product){
            
                if(new_product[i]['spec_array']==specJSON){
                    this.checkStoreNums(new_product[i].store_nums);
                }
            }
            specJSON = specArray.join(",");
            var specJSON = '['+specArray.join(",")+']';
            //获取货品数据并进行渲染
            $.getJSON(get_product_url,{"goods_id":this.goods_id,"specJSON":specJSON,"random":Math.random},function(json){
                if(json.flag == 'success')
                {
                    $('.js_data_'+id).attr('js_data', 0);
                    var price = (json.data.combine_price && json.data.combine_price != '0.00') ? json.data.combine_price : json.data.sell_price
                    ,buyNum = $('#J_SComboAmount').val()
                    ,_final = 0;
                    $('.js_data_'+id).attr('js_data', price);
                    $('.js_data_'+id).attr('js_product_id', json.data.id);
                    $('.port_item').each(function(){
                        _final += parseFloat($(this).attr('js_data'));
                    })
                    var num = parseFloat(_final)*buyNum;
                    $('.js_combine_price_data').html(num.toFixed(2));
                }
                
            });
    
        }
    }
    
    /**
    * 计算套餐费用
    * 
    */
    this.count_price = function ()
    {
        var _final = 0
            ,buyNum = $('#J_SComboAmount').val();
        $('.port_item').each(function(){
            _final += parseFloat($(this).attr('js_data'));
        })
        var num = parseFloat(_final)*buyNum;
        $('.js_combine_price_data').html(num.toFixed(2));
    }
    
    /**
     * 监测库存操作
     */
    this.checkStoreNums = function (storeNum)
    {
        if(storeNum > 0)
        {
            this.openBuy();
        }
        else
        {
            this.closeBuy();
        }
    }
    
    /**
     * 检查规格选择是否符合标准
     * @return boolen
     */
    this.checkSpecSelected = function (_obj)
    {
        if($(_obj).children('li').length === $(_obj).find('em.yListrclickem').length)
        {
            return true;
        }
        return false;
    }
    
    //检查购买数量是否合法
    /*this.checkBuyNums = function ()
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
        
    }*/
    /**
     * 购物车数量的加减
     * @param code 增加或者减少购买的商品数量
     */
    /*this.modified = function (code)
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
        this.checkBuyNums();
    }*/
    //禁止购买
        this.closeBuy = function ()
        {
            if($('.js_buyNowButton').length > 0)
            {
                $('.js_buyNowButton').attr('disabled','disabled');
                $('.js_buyNowButton').addClass('disabled');
            }
        
            if($('.js_joinCarButton').length > 0)
            {
                $('.js_joinCarButton').attr('disabled','disabled');
                $('.js_joinCarButton').addClass('disabled');
            }
        }
        
        //开放购买
        this.openBuy = function ()
        {
            if($('.js_buyNowButton').length > 0)
            {
                $('.js_buyNowButton').removeAttr('disabled');
                $('.js_buyNowButton').removeClass('disabled');
            }
        
            if($('.js_joinCarButton').length > 0)
            {
                $('.js_joinCarButton').removeAttr('disabled');
                $('.js_joinCarButton').removeClass('disabled');
            }
        }
        //立即购买按钮
    this.buy_now = function (obj)
    {
        var _this = this
            ,comId = $(obj).attr('js_data')
            ,error=0;
        //对规格的检查
        $('.yListr').find('ul').each(function(){
            if(!_this.checkSpecSelected(this))
            {
                if($(this).find('p').length == 0)
                {
                    $(this).prepend('<p style="color:red">请选择商品的规格</p>');
                }
                error=1;
            }
            else
            {
                $(this).find('p').remove();
            }
        })
        
        if(error == 0)
        {
            //设置必要参数
            var buyNums  = parseInt($('#J_SComboAmount').val())
                ,ids=''
                ,type='';
            $('.port_item').each(function(){
                var _p = $(this).attr('js_product_id');
                if(_p != 0)
                {
                    ids += '$'+_p;
                    type += '$product';
                }
                else
                {
                    ids += '$'+$(this).attr('js_goods_id');
                    type += '$goods';
                }
            })
            var url = this.buy_now_combine_url;
            url = url.replace('@id@',ids).replace('@buyNums@',buyNums).replace('@type@',type).replace('@comId@',comId);
            //页面跳转
            window.location.href = url;
        }
    }
    
    //商品加入购物车
    this.joinCart = function (obj)
    {
        var _this=this
            ,comId = $(obj).attr('js_data')
            ,error=0
            ,msg=''
            ,buyNums=parseInt($('#J_SComboAmount').val());
        $('.yListr').find('ul').each(function(){
            if(!_this.checkSpecSelected(this))
            {
                if($(this).find('p').length == 0)
                {
                    $(this).prepend('<p style="color:red">请选择商品的规格</p>');
                }
                error = 1;
            }
            else
            {
                $(this).find('p').remove();
            }
        })
        if(error == 0)
        {
            $('.port_item').each(function(){
                var _p = $(this).attr('js_product_id')
                    ,goods_id = _p != 0 ? _p : $(this).attr('js_goods_id')
                    ,type = _p != 0 ? 'product' : 'goods';
                $.getJSON(_this.join_cart_url,{"goods_id":goods_id,"type":type,"goods_num":buyNums,"random":Math.random,'comId':comId},function(content){
                    if(content.isError == false)
                    {
                         msg += '';
                    }
                    else
                    {
                        msg += ','+content.message;
                    }
                });
                if(msg.length > 0)
                {
                    $(".mask_layer,.port_overlay").hide();  
                    alert(msg)
                }
                else
                {
                    $(".mask_layer,.port_overlay").hide();
                    tips('成功加入购物车');  
                }
            })
        }
    }
    
}