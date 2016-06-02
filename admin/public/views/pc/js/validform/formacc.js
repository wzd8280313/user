	
var nn_panduo = window.NameSpace || {};
nn_panduo.formacc = function(obj){
	this.event_obj = '';//当前事件对象
	this.ajax_return_data = '';//ajax返回数据
	this.no_redirect = false;
	if(obj){
		this.form = obj.form || '';//要提交的表单对象
		this.redirect_url = obj.redirect_url||'';//操作成功后自动跳转的地址
		this.no_redirect = $(this.form).attr('no_redirect');//是否开启自动跳转
		// this.status = obj.status||'';//列表中要更改的数据状态
		// this.ajax_url = obj.ajax_url||'';//处理接口地址
	}
	
}

nn_panduo.formacc.prototype = {
	form_init:function(){
		var _this = this;
		$("form[auto_submit]").each(function(i){
			_this.redirect_url = $(this).attr("redirect_url");
			_this.form = this;
			_this.no_redirect = $(this).attr('no_redirect') ? 1:0;
			_this.bind_select();
			_this.validform();
		});
	},
	/**
	 * 自动绑定select选中项
	 */
	bind_select:function(){
        $(this.form).find("select").each(function(){
        	var value = $(this).attr('value');
        	if(value != null && value != ''){
        		var option = $(this).find("option[value='"+value+"']");
	        	var txt = $(option).text();
	        	$(option).attr("selected",'selected');
	        	$(this).siblings("span").text(txt);
        	}
        });
        // $("select[name='type']").find("option[value='{$info['type']}']").attr("selected",'selected');     
	},
	/**
	 * 表单提交
	 * @type {Object}
	 */
	validform:function(){
        var _this = this;
        if(this.form){
		  $(this.form).Validform({
		      tiptype : 2,
		      ajaxPost:false,
		      showAllError:false,
		      postonce:true,
		      beforeSubmit:function(curform){
		        var url = $(curform).attr('action');
		        var data = $(curform).serialize();
		        _this.ajax_post(url,data,function(){
		          if(!_this.no_redirect){
		          	  layer.msg("操作成功!稍后自动跳转");
		              setTimeout(function(){
		              	if(_this.redirect_url){
			                window.location.href=_this.redirect_url;
			            }else{
			            	window.location.reload();
			            }
		              },1000);
		          }else{
		          	layer.msg('操作成功！');
		          }
		        });
		        return false;
		      }
	      });
	    }
	},
	/**
	 * 设置数据状态
	 * @return {[type]} [description]
	 */
	//初始化点击事件
	bind_status_handle:function(){
		var _this = this;
		$('a[ajax_status]').each(function(i){
			var url = $(this).attr('ajax_url');
			var status = $(this).attr("ajax_status");
			$(this).unbind('mouseover').unbind('click').click(function(){
				_this.event_obj = this;

				if($(this).prop("confirm") || status == -1){
					//删除提醒
					layer.confirm("确定吗？",function(){
						layer.closeAll();
						_this.setStatus(url,{status:status});	
					});
				}else{
					_this.setStatus(url,{status:status});	
				}				
			});
		});
	},
	setStatus:function(url,data){
		var _this = this;
		this.ajax_post(url,data,function(){
			if($(_this.event_obj).attr("ajax_status") == -1){
				//删除
				$(_this.event_obj).parents("tr").remove();
				return;
			}
			if($(_this.event_obj).attr("to_list")){
				layer.msg("操作成功!");
	            setTimeout(function(){
		          	window.location.reload();
		        },1000);
			}else{
				$(_this.event_obj).attr("title","");//$(_this.event_obj).attr("title") == "启用" ? "停用" : "启用");
				$(_this.event_obj).attr("ajax_status",$(_this.event_obj).attr("ajax_status") == 1 ? 0 : 1);
				$(_this.event_obj).find('i').attr("class",$(_this.event_obj).find('i').attr("class") == "icon-pause" ? "icon-play" : "icon-pause");
				var td_status = $(_this.event_obj).parents("td").siblings(".td-status").find('span.label');
				if(td_status.hasClass('label-success')){
					td_status.removeClass('label-success').addClass('label-error').html("停用");
				}else if(td_status.hasClass('label-error')){
					td_status.removeClass('label-error').addClass('label-success').html("已启用");
				}
				_this.bind_status_handle();	
			}
			//console.log(_this.event_obj);
		});
	},
	//ajax提交
	ajax_post:function(url,ajax_data,suc_callback,err_callback){
		var _this = this;
		$.ajax({
          type:'post',
          url:url,
          data:ajax_data,
          dataType:'json',
          success:function(data){
            if(data.success == 1){
              _this.ajax_return_data = data;
              if(typeof(eval(suc_callback)) == 'function'){
	              suc_callback();
	          }
              _this.ajax_return_data = '';
            }else{
              if(typeof(eval(err_callback)) == 'function'){
	              err_callback();
	          }
              layer.msg(data.info);
            }
          },
          error:function(data){
            layer.msg("服务器错误,请重试");
          }
        });
	}
}


$(function(){
	var formacc = new nn_panduo.formacc();
	formacc.bind_status_handle();
	formacc.form_init();

})








