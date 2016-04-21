/**
 * 订单对象
 * address:收货地址; delivery:配送方式; payment:支付方式;
 */
function orderFormClass()
{
	//是否为货到付款 0:否; 1:是;
	this.paytype = 0;
	this.freeFreight = 0;
	
	//是否是预售0:不是，1：是
	this.presell = 0;

	//视图状态模式 默认：edit
	this.addressMod  = 'edit';
	//this.deliveryMod = 'edit';
	this.paymentMod  = 'edit';
	this.messageMod  = 'exit';

	//当前正在使用的ID
	this.addressActiveId   = '';
	//this.deliveryActiveId  = '';
	this.paymentActiveId   = '';
	this.messageActiveData = '';

	//视图切换按钮ID
	this.addressToggleButton  = 'addressToggleButton';
	//this.deliveryToggleButton = 'deliveryToggleButton';
	this.paymentToggleButton  = 'paymentToggleButton';
	this.messageToggleButton  = 'messageToggleButton';

	this.orderAmount  = 0;//订单金额
	this.goodsSum     = 0;//商品金额
	this.deliveryPrice= 0;//运费金额
	this.paymentPrice = 0;//支付金额
	this.taxPrice     = 0;//税金
	this.protectPrice = 0;//保价
	this.ticketPrice  = 0;//代金券
	
	//this.deliveryConf = {};//记录配送信息的json对象
	
	//this.delivery_fee_url = '';
	
	this.tax = function (_this){
		$(_this).toggleClass("show_check");
		if($(_this).hasClass("show_check")){
			$(_this).next('div').show();
			$('input[name=taxes]').prop('checked',true);
		}else{
			$(_this).next('div').hide();
			$('input[name=taxes]').removeAttr('checked');
		}
		this.doAccount();
	}
	
	this.ticket = function(_this){
		$(_this).toggleClass("show_check");
		if($(_this).hasClass("show_check")){
			$(_this).next('div').show();	
		}else{
			$(_this).next('div').hide();
			$('[name="ticket_id"]').attr('checked',false);	
		}
			
		this.doAccount();
	}
	/**
	 * 算账
	 */
	this.doAccount = function()
	{
		this.paymentPrice = !this.paymentPrice ? 0 : this.paymentPrice ;
		//税金
		this.taxPrice = $('span[name="taxes"]').hasClass("show_check")? $('input[name="taxes"]').val() : 0 ;
		//代金券
		this.ticketPrice = $('#ticket_a').hasClass("show_check") && $('input:radio[name="ticket_id"]:checked').length>0 ? $('input:radio[name="ticket_id"]:checked').attr('alt') : 0;
		//最终金额
		this.orderAmount = parseFloat(this.goodsSum) - parseFloat(this.ticketPrice) + parseFloat(this.deliveryPrice) + parseFloat(this.paymentPrice) + parseFloat(this.taxPrice) + parseFloat(this.protectPrice);

		this.orderAmount = this.orderAmount <=0 ? 0 : this.orderAmount.toFixed(2);

		//刷新DOM数据
		$('#final_sum').text(this.orderAmount);
		$('[name="ticket_value"]').text(this.ticketPrice);
		$('#delivery_fee_show').text(this.deliveryPrice);
		$('#protect_price_value').text(this.protectPrice);
		$('#payment_value').text(this.paymentPrice);
		$('#tax_fee').text(this.taxPrice);
		if(this.presell){//计算预售金额
			var wei_sum = this.orderAmount - parseFloat($('#pre_sum').text());
			$('#wei_sum').text(wei_sum.toFixed(2));
		}
		$('#final_sums').text(this.orderAmount);
		
	}
	//获取运费
	this.get_delivery  = function ()
	{
		this.deliveryPrice = 0;
		var orderFormObj = this;
		var url = this.delivery_fee_url;
		var area     = $('[name=area]').val();                                          
		if(!area)
		{
			return;
		}                           
		$('.js_goods_delivery').each(function(){
			var _this = $(this)
            ,obj = _this.attr('js_data')
            ,dataArray = obj.split("_")
            ,_u = _url
            ,final_sum = $('#final_sums').text();  
            $.ajax({
                type:'post',
                async:false,
                data:{"area":area,"deliveryId":dataArray[0],"goodsId":dataArray[1],"productId":dataArray[2],"num":dataArray[3],final_sum:final_sum},
                dataType:'json',
                url: _u,
                success:function(content)
                {
                    //地区无法送达
                    if(content.if_delivery == 1)
                    {
                        alert('您选择地区部分商品无法送达');
                        $('#'+obj).html("<span style='color:red'>无法送达</span>");
                    }
                    else
                    {
                        var html = parseFloat(content.price).toFixed(2);
                        //允许保价
                        if(content.protect_price > 0)
                        {
                            html += "<br /><label title='￥"+content.protect_price+"'><input type='checkbox' value='"+content.protect_price+"' name='insured["+dataArray[1]+"]' onchange='selectProtect(this);' class='checks'/>保价</label>";
                        }
                        _this.html(html);
                    }
                },
                timeout:1000,
            })                                             
			orderFormInstance.deliveryPrice += parseFloat(_this.text());     	
		})                               
		this.doAccount();
	}            
	
	/**
	 * payment检查
	 * @return boolean
	 */
	this.paymentCheck = function()
	{
		if($('select[name=payment]').val == -1)
		{
			return false;
		}
		return true;
	}


	/**
	 * payment保存
	 */
	this.paymentSave = function()
	{

		this.paymentActiveId = $('select[name=payment]').val();
		if(this.paymentActiveId==7)
			$('[name=payment]').after('<p style="color:red;" name="alipay_info">由于您使用的是支付宝第三方担保交易，“确认收货、退款”等相关操作结束后需前往支付宝界面再次操作</p>');
		else
			$('[name=alipay_info]').remove();
		//支付金额
		this.paymentPrice = $('select[name=payment] option:selected').attr('price');

		//计算金额
		this.doAccount();
	}

	/**
	 * message模式切换
	 */
	this.messageModToggle = function()
	{
		//要切换的模式
		var toggleMod = this.messageMod == 'exit' ? 'edit' : 'exit';

		switch(toggleMod)
		{
			case "edit":
			{
				$('#'+this.messageToggleButton).text('[退出]');
			}
			break;

			case "exit":
			{
				//恢复数据
				$('[name="message"]').val(this.messageActiveData);
				$('#'+this.messageToggleButton).text('[修改]');
			}
			break;
		}

		//更新模式
		this.messageMod = toggleMod;

		//展示模式
		$('#message_show_box').toggle();

		//修改模式
		$('#message_form').toggle();
		$('#message_save_button').toggle();
	}

	/**
	 * 留言保存
	 */
	this.messageSave = function()
	{
		var messageData = $('[name="message"]').val();

		//更新table
		$('#messageShowBox').text(messageData);

		//保存到缓存
		this.messageActiveData = messageData;
		this.messageModToggle();
	}

	/**
	 * 检查表单是否可以提交
	 */
	this.isSubmit = function()
	{
		var saveButtonList = $('label[id$="_save_button"]:visible');
		if(saveButtonList.length > 0)
		{
			saveButtonList.first().trigger('focus');
			return false;
		}
		return true;
	}
}