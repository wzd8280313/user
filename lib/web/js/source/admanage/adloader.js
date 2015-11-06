/**
 * adLoader
 * @author nswe
 */
function adLoader()
{
	var _self        = this;
	var _id          = null;
	var adKey        = null;
	var positionData = null;
	var adData       = [];
	var length       = 0;//广告数
	var scrollId     = 0;
	/**
	 * @brief 加载广告数据
	 * @param positionJson 广告位数据
	 * @param adArray      广告列表数据
	 * @param boxId        广告容器ID<li class="nonce" ></li>
	 */
	this.load = function(positionJson,adArray,boxId,nav)
	{
		_self.positionData = positionJson;
		_self.adData       = adArray;
		_self._id          = boxId;
		_self.length       = adArray.length;
		
		$('#'+_self._id).append('<div class="ad_box"></div>');
		if(nav){
			$('#'+_self._id).addClass('ad_cycle').css('overflow','hidden').append('<div  class="number"><ul></ul></div>');
			$('#'+_self._id).find('ul').append('<li class="nonce"></li>');
			$('#'+_self._id).find('.number').css('position','absolute').css('z-index','9999').css('right','10px').css('bottom','10px');
			for(var i=0;i<_self.length-1;i++){
				$('#'+_self._id).find('ul').append('<li class="initial"></li>');
			}
			_self.startScroll();
		}
		
		
		_self.show();
	}
	
	this.startScroll = function(){
	    _self.scrollId = setInterval(function(){
	        var nextImg = $('#'+_self._id).find('.nonce').next('.initial');
	        if(nextImg.length==0){
	            nextImg =  $('#'+_self._id).find('li').eq(0);
	        }
	       _self.slideHere(nextImg);
	    }, 5000);
	}
	this.stopScroll = function(){
	    clearInterval( _self.scrollId);
	}
	this.slideHere = function(imgObj){
	   $('#'+_self._id).find('.nonce').removeClass('nonce').addClass('initial');
	   imgObj.removeClass('initial').addClass('nonce')
	}
	this.stopHere = function(imgObj){
	    _self.slideHere(imgObj);
	    _self.stopScroll();
	}
	/**
	 * @brief 展示广告位
	 */
	this.show = function()
	{
		//顺序显示
		if(_self.positionData.fashion == 1)
		{
			_self.adKey = (_self.adKey == null) ? 0 : _self.adKey+1;

			if(_self.adKey >= _self.adData.length)
			{
				_self.adKey = 0;
			}
		}
		//随机显示
		else
		{
			var rand = parseInt(Math.random()*1000);
			_self.adKey = rand % _self.adData.length;
		}

		var adRow = _self.adData[_self.adKey];

		if(adRow.type == 4)
		{
			$('#'+_self._id).find('.ad_box').html(eval(adRow.data));
		}
		else
		{
			$('#'+_self._id).find('.ad_box').html(adRow.data);
		}

		//多个广告数据要依次展示
		if(_self.adData.length > 1)
		{
			window.setTimeout(function(){_self.show();},5000);
		}
	}
}