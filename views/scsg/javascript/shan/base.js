/*ͷ����½��(����ʵ�幺��ȯ) bengin*/
//��ȡ��ַ������
function getQueryStringRegExp(name){    
	var reg = new RegExp("(^|\\?|&)"+ name +"=([^&]*)(\\s|&|$)", "i");     
	if(reg.test(location.href)){ 
		var result =  unescape(RegExp.$2.replace(/\+/g, " "));
		return result == "" ? "FALSE" : result;
	}else{
		return "FALSE";
	}
};
//���ŵ�ǰ��ַ��ת��½ҳ��
function login(aobj){		
	var strlocation = location.toString();
	var returnLocation;
	var _index = strlocation.indexOf("?");
	var isHasMid = strlocation.indexOf("mid");
	var isHasId = strlocation.indexOf("id");	//�ؼ�����
	var isHasCid = strlocation.indexOf("Cid");	//�ؼ�����
	var isHasRuleId = strlocation.indexOf("ruleid");	//�ؼ�����,xԪy��ʹ��
	var tempLocation = "";
	if(_index != -1){
		returnLocation = strlocation.substring(0,_index);
	}else{
		returnLocation = strlocation;
	}
	if(isHasMid != -1){
		returnLocation += "?mid=" + mid;
	}
	if(isHasId != -1){
		tempLocation = returnLocation.indexOf("?") == -1 ? "?" : "&";
		returnLocation += tempLocation + "id=" + getQueryStringRegExp("id");
	}
	if(isHasCid != -1){
		tempLocation = returnLocation.indexOf("?") == -1 ? "?" : "&";
		returnLocation += tempLocation + "Cid=" + getQueryStringRegExp("Cid");
	}
	if(isHasRuleId != -1){
		tempLocation = returnLocation.indexOf("?") == -1 ? "?" : "&";
		returnLocation += tempLocation + "ruleid=" + getQueryStringRegExp("ruleid");
	}
	/*var uri = crossDomain + frontPath + "/Member/LoginForm.do?mid="+ mid +"&returnUrl=" + encodeURIComponent(returnLocation);
	aobj.href=uri;*/
	
	var getPassportUrl = frontPath + "/loginUrl.do?tt=" + Math.random();
	$.getJSON(getPassportUrl, function(data, status) {
		var passportUrl = data.passportLoginUrl;
		var uri = passportUrl + "?mid="+ mid +"&returnUrl=" + encodeURIComponent(returnLocation);
		window.location.href=uri;
	});
}
//���ָ��Ԫ��ָ������,��һ����������ȡdata-uri
function getAttrValueById(id,attr){
	var attrname;
	if(arguments.length == 1){attrname = "data-uri";}else{attrname = attr;}
	var tempValue = $("#" + id).attr(attrname);
	if(tempValue){return tempValue;}
	return null;
}
function gotoMyAccount(id){
	var uri = getAttrValueById(id);
	var url = crossDomain + frontPath+"/Member/index.jsp?mid=" + mid + "&url=" + encodeURIComponent(uri) + "&t=" +Math.random();
	$("#" + id).attr({href:url,target:"_blank"});
}
//��ȡ��¼��Ϣ
function getTopLoginInfo(){
	var params_L = new Object();
	params_L["random_L"] = Math.random();
	params_L["mid"] = mid;
	var apiUrl = frontPath + "/" + webIndex + "/finclude/includetoplogin.do?" + $.param(params_L) + "&callback=" + "?";
	$("#top_login_span").load(apiUrl);
}

//add by lihongyao 20150414 ��Ϣ����
function setTopIntationMessage(){
	$.post("/Member/getInstationMsgCount.do?t="+Math.random(),function(data){
		var msgcount = data;
		if(msgcount == 0){
			$('#topmsgpng').removeClass("tmsgpng");
			$('#topmsgpng').html('');
		}else{
			$('#topmsgpng').show();
			$('#topmsgpng').addClass("tmsgpng");
			$('#topmsgpng').html(msgcount);
		}
	});
}
	
function setNoPayOrder(){
	$.post("/Member/AjaxMaiRemind.do"+"?t="+Math.random(),function(data){
		var sdata =  eval('(' + data + ')');
		var nopaycount = 0;
		if(sdata.nopayordercount.length > 0){
			nopaycount = sdata.nopayordercount[0];
		}
		if(nopaycount == 0){
			$('#topnopaypng').removeClass("nopaypng");
			$('#topnopaypng').html('');
		}else{
			$('#topnopaypng').show();
			$('#topnopaypng').addClass("nopaypng");
			$('#topnopaypng').html(nopaycount);
		}
	});
}

//��ʼ���ҵ��˻���Ϣ
function initMyAccountInfo(){
	getTopLoginInfo();
	$("#myaccount").hover(function(){
		var isFirstDo = $(this).attr("data-first");
		if(isFirstDo == "yes"){
			var apiUrl = frontPath + "/" + webIndex + "/finclude/includetopmyaccount.do?t=" + Math.random() + "&callback=" + "?";
			$("#myaccount_cont").removeClass("loadding").load(apiUrl);
			$(this).attr("data-first","no");
		}
		$(this).addClass("myaccount_curr");
		$("#myaccount_cont").show();
	},function(){
		$(this).removeClass("myaccount_curr");
		$("#myaccount_cont").hide();
	});
}

//���á��ҵ��˻�����Ϣ����
function setAccountMessage() {
	var count = 0;
	var msgcount = 0;
	var nopayordercount = 0;
	$.ajax({
		type:"POST",
		url:'/Member/getInstationMsgCount.do',
		async:false,
		success:function(data){
			msgcount = data;
			nopayordercount = getNoPayOrder();
		}          
	}); 
	var intmsgcount = 0;
	var intnopayordercount = 0;
	if (!isNaN(parseInt(msgcount))) {
		intmsgcount = parseInt(msgcount);
	}
	if (!isNaN(parseInt(nopayordercount))) {
		intnopayordercount = parseInt(nopayordercount);
	}
	count = intmsgcount + intnopayordercount;
	if(count == 0){
		$('#myaccount').removeClass('has-msg');
		$('#topaccountpng').removeClass("accountpng");
		$('#topaccountpng').html('');
	}else{
		$('#myaccount').addClass('has-msg');
		$('#topaccountpng').show();
		$('#topaccountpng').addClass("accountpng");
		$('#topaccountpng').html(count);
	}
}

//��á������������Ϣ����
function getNoPayOrder(){
  var nopayordercount = 0;
	$.ajax({
		type:"POST",
		url:'/Member/AjaxMaiRemind.do' + '?t=' + Math.random(),
		async:false,
		success:function(data){
	    	var sdata =  eval('(' + data + ')');
			nopayordercount = sdata.nopayordercount;
		}         
	});
	return nopayordercount;
}

//��ô��ڿɼ���winHeight
function findDimensions(){
	var winHeight1=0,winHeight2=0,winHeight3=0,winHeight4=0;
	if(window.innerWidth){winHeight1=window.innerHeight;} 
	if(document.body){if(document.body.clientWidth){winHeight2=document.body.clientHeight;}if(document.body.scrollHeight){winHeight3=document.body.scrollHeight;}}
	if(document.documentElement&&document.documentElement.clientWidth){winHeight4=document.documentElement.clientHeight;}
	winHeight=Math.max(winHeight1,winHeight2,winHeight3,winHeight4);
	return winHeight;
};
//��ȡ��ǰ�����߶�
function getCurrScrollTop(){
	var currScrollTop =  document.body.scrollTop;
	if(currScrollTop == 0)
		currScrollTop = document.documentElement.scrollTop;
	return currScrollTop;
}
//���ñ������ֲ�
function showShade(){
	if($("#layoutBg").length > 0){return;}
	var winHeight = findDimensions();
	var e = document.createElement("div");e.id="layoutBg";e.style.cssText="position:absolute;left:0px;top:0px;width:100%;height:"+winHeight+"px;filter:Alpha(Opacity=50);opacity:0.5; background-color:#000;z-index:1000;";
	document.body.appendChild(e);
};
//�رձ������ֲ�
function closeShade(){
	if($("#layoutBg").length > 0){$("#layoutBg").remove()}
}
//���ñ������ֲ�
function resizeShade(){
	if($("#layoutBg").length > 0){
		$("#layoutBg").css("height", $(document).height());
		$("#layoutBg").css("width", $(document).width());
	}
}
/*ͷ��С���ﳵ begin*/
//�ص���������С������Ʒ����
function callbackSetSmallCartAmount(data){
	if(data && data.totalAmount >= 0){
		//�ؼ���������
		$("#smallcart_items_amount").attr("data-count",0);
		$("#smallcart_items_amount").val(data.cartitemsAmount + "");
		$("#smallcart").attr("data-first","yes");
		if(data.totalAmount > 99){
			$(".smallcart_totalamount").html(99 + "+");
		}else{
			$(".smallcart_totalamount").html(data.totalAmount + "");
		}
		$("#totleCount span").html(data.totalAmount + "");
		$("#totalMustPayPrice").html(data.totalMustPayPrice.toFixed(2) + "");
	}
	loadSmallCartContent();
}
//��ȡ���ﳵ��Ʒ������
function getCartTotalAmount(){
	var uri = crossDomain + frontPath + "/frontendjson/smallcartinfo.do?mid=" + mid + "&callback=?&t=" + Math.random();
	$.getJSON(uri, callbackSetSmallCartAmount);
}

//ѭ�����3�λ�ȡ���ﳵ��Ʒ������������
function getCartTotalAmountForMax(){
	setTimeout(function(){
		var $items_amount_inp = $("#smallcart_items_amount");
		var count = $items_amount_inp.attr("data-count");	//ѭ��������,���ѭ�����λ�ȡ���ﳵ����������
		if($items_amount_inp.val() == "init" && count < 3){
			getCartTotalAmount();
			getCartTotalAmountForMax();
			count++;
			$items_amount_inp.attr("data-count",count);
		}else{
			loadSmallCartContent();
		}
	},"300");
}

//ɾ��ͷ��С���ﳵ����Ʒ
function deleteSmallCart(cartId, productid, isPresent, index){
	//emarboxɾ�����ﳵ����� 20130903_zhaogangqiang
	try{deleteOneItem(productid);}catch(e){}
//	$("#delsmallcart" + index + "_" + cartId + "_" + productid).hide();
	var params = new Object();
	params["mid"] = mid;
	params["cartid"] = cartId;
	var url='';
	if(isPresent==1){
		params["productid"] = 0;
		params["presentid"] = productid;
		uri = crossDomain + frontPath + "/frontendjson/delpresent.do?" + $.param(params) + "&callback=?";
	}else{
		params["productid"] = productid;
		uri = crossDomain + frontPath + "/frontendjson/delcartitem.do?" + $.param(params) + "&callback=?";
	}
	$.getJSON(uri,callbackSetSmallCartAmount);
}
//ɾ��ͷ��С���ﳵ��XԪY����Ʒ
function deleteSmallCartXY(cartId,ruleId){
//	$("#delsmallcartxy_" + cartId + "_" + ruleId).hide();
	var params = {};
	params["mid"] = mid;
	params["cartid"] = cartId;
	params["ruleid"] = ruleId;
	uri = crossDomain + frontPath + "/delcartitemxy.do?" + $.param(params) + "&callback=?";
	$.getJSON(uri,getCartTotalAmount);
}
function isShowSmallcartScrollBar(amount){
	if(amount == 0){
		$("#smallcart_cont").html("<div class='empty-cart'>���ﳵ�л�û����Ʒ���Ͻ�ѡ���ɣ�</div>");
		$("#smallcart").attr("data-first","no");
		getWinHeight();
	}else if(amount >10){
		$("#smallcart_scroll").css("overflow-y","scroll");
	};
}
function loadSmallCartContent(){
	var smallcart_items_amount = $("#smallcart_items_amount").val();
	if(smallcart_items_amount == "init"){
		//�˴�������ֿ����Լ��ͣ����ʼ��ʱ�����������ȡ���ﳵ��������6��
		$("#smallcart_cont").html("<div class='smallcart_amount0'>���緱æ�����Ժ�����~</div>");
		setTimeout(getCartTotalAmount,"500");
		return;
	}
	isShowSmallcartScrollBar(smallcart_items_amount);
	var isFirstDo = $("#smallcart").attr("data-first");
	if(isFirstDo == "yes"){
		var paramsTT = new Object();
		paramsTT["randomT"] = Math.random();
		paramsTT["mid"] = mid;
		
		var url = frontPath + "/" + webIndex + "/finclude/includetopsmallcartcontent.do";
		$.get(url, paramsTT, function(data){
			$("#smallcart_cont").html(data);
			if($("#smallcart_cont").length > 0){
				isShowSmallcartScrollBar(smallcart_items_amount);
				if($(".xy_miniprice").length > 0){
					$(".xy_miniprice").each(function(){
						var xy_miniprice = parseFloat($(this).html());
						$(this).html(xy_miniprice);
					});
				}
			}
			getWinHeight();
		});
		$("#smallcart").attr("data-first","no");
	};
}

//��ʼ��ͷ��С���ﳵ
function initSmallCartInfo(){
	//��ȡ���ﳵ��ǰ��Ʒ��
	getCartTotalAmount();
	/*$("#smallcart").click(function(){
			//lazyloadSmallCart
			getCartTotalAmountForMax();
			$("#cartlink").addClass("cartlink_curr");
			$("#cartarrow").addClass("cartarrow_curr");
			$("#smallcart_cont").show();
		},function(){
			$("#cartlink").removeClass("cartlink_curr");
			$("#cartarrow").removeClass("cartarrow_curr");
			$("#smallcart_cont").hide();
	});*/
}
/*ͷ��С���ﳵ end*/

/*ͷ���ֲ�*/
$(function(){
	var num=0;
	var list=$(".f_shopping_slide li").length-1;
	function Time(){
		if(num <= list){
			$(".f_shopping_slide li").hide();
			$(".f_shopping_slide li").eq(num).show();
			$(".icon_item span").removeClass("li_hover");
			$(".icon_item span").eq(num).addClass("li_hover");
		}else{
			num = 0;
			$(".f_shopping_slide li").hide();
			$(".f_shopping_slide li").eq(num).show();
			$(".icon_item span").removeClass("li_hover");
			$(".icon_item span").eq(num).addClass("li_hover");
			}
		num++;
		}
		var $div_list=$(".f_shopping_slide li");
		var $li_list=$(".icon_item span");
		$li_list.hover(function(){
			var index=$li_list.index(this);
			$(this).addClass("li_hover").siblings().removeClass("li_hover");
			$(".f_shopping_slide li").eq(index).show().siblings().hide();
			clearInterval(Times);
			num = index;
		},function(){
			Times= setInterval(Time,2000);	
		});
		var Times= setInterval(Time,2000);
})

/*bottomRightBar begin*/
function topFixed(){
	if($("#rightbar").length == 0)return;
	getCurrScrollTop() > 300 ? document.getElementById("rightbar").style.display="block" : document.getElementById("rightbar").style.display="none";
	if(navigator.userAgent.indexOf("MSIE 6.0")>0){
		document.getElementById("rightbar").style.top=document.documentElement.clientHeight+document.documentElement.scrollTop-document.getElementById("rightbar").clientHeight-44+"px";
		document.getElementById("rightbar").style.position="absolute";
	}
}
/*// ���½�������
function initRightBar(){
	if($("#rightbar").length == 0)return;
	$("#rightbar a.def").hover(
		function(){
			var tip = $(this).attr("data-tip");
			$(this).addClass("curr").html(tip);
		},function(){
			$(this).removeClass("curr").html("");
		}
	);
	window.onscroll=topFixed,window.resize=topFixed,topFixed();
	initHotDeal();
}*/
//ҳ����жϵ���������ʾ��ʽ(��ʾor����)
var sameBanner = false;
var isShowHotDeal = true;
var t_hotDeal = -1;
function initHotDeal(){
	$("#hot_deal_def").click(showAdv).hover(function(){
		var imgsrc = $("#hot_deal_layer img").length;
		if(imgsrc > 0){
			t_hotDeal = setTimeout(function(){
				if(isShowHotDeal){
					showAdv();
					isShowHotDeal=false;
				}
			},400);
		}
		},function(){clearTimeout(t_hotDeal);isShowHotDeal = true;closeHotDeal() ;});
	
	$("#scancode").click(showAdvcode).hover(function(){
		var imgsrc = $("#code_deal_layer img").length;
		if(imgsrc > 0){
			t_hotDeal = setTimeout(function(){
				if(isShowHotDeal){
					showAdvcode();
					isShowHotDeal=false;
				}
			},400);
		}
	},function(){clearTimeout(t_hotDeal);isShowHotDeal = true;closeCodeDeal();});
	
	$("#hot_deal_close").click(closeHotDeal);
	$("#scancode_close").click(closeCodeDeal);
	/*$("#hot_deal_cur").click(function(){closeHotDeal();isShowHotDeal = false;});
	historyCookie = checkCookie();
	if(!historyCookie || !sameBanner){showAdv();}else{hideAdv();}*/
}
//��鵯�������Ƿ��չرջ����
function checkCookie(){
	var currentDate = new Date().toLocaleDateString();
	var currentPath = $("#hot_deal_layer .lazyload").attr("original") ? $("#hot_deal_layer .lazyload").attr("original") : "defPath";
	historyCookie = $.cookie("hotDeal_Adv");
	if(historyCookie){var parts = historyCookie.split("^");if(parts.length>1){if(parts[0] == currentDate && parts[1] == currentPath){sameBanner = true;}}}
	if(!sameBanner){$.cookie("hotDeal_Adv",currentDate+"^"+currentPath,{expires:24,path:'/'});}
	return historyCookie;
}
//�ر�
function closeHotDeal(){
	$("#hot_deal_layer").fadeOut(400,hideAdv);
	checkCookie();
}
function closeCodeDeal(){
	$("#code_deal_layer").fadeOut(400,hideCodeAdv);
	checkCookie();
}
//����
function hideAdv(){
	$("#hot_deal_layer").hide();
}
function hideCodeAdv(){
	$("#code_deal_layer").hide();
}
//��ʾ
function showAdv(){
	var imgsrc = $("#hot_deal_layer img").length;
	if(imgsrc > 0){
		$("#hot_deal_layer").fadeIn(400);
		var hdiObj = $("#hot_deal_img"), isFirst = hdiObj.attr("data-first");
		if(isFirst == "y"){hdiObj.find(".lazyload").attr("src",hdiObj.find(".lazyload").attr("original"));hdiObj.attr("data-first","n");}
	}
}
function showAdvcode(){
	var imgsrc = $("#code_deal_layer img").length;
	if(imgsrc > 0){
		$("#code_deal_layer").fadeIn(400);
		var hdiObj = $("#hot_deal_img"), isFirst = hdiObj.attr("data-first");
		if(isFirst == "y"){hdiObj.find(".lazyload").attr("src",hdiObj.find(".lazyload").attr("original"));hdiObj.attr("data-first","n");}
	}
}

//����
$(function(){
	$('.share_icon').click(function(){
		showShade();
		$("#share").show();
		$("#share").attr('data-rule-id', $(this).attr("data-rule-id"))
	})
	$('#share h4 s').click(function(){
		closeShade();
		$(this).parent().parent('#share').hide();  
	})
	$('.share_icon').hover(function(){
		$(this).addClass('i_hover');
	},function(){
		$(this).removeClass('i_hover');
	})
});
//��ʼ��ͼƬlazyload��������
function initLazyloadParams(){
	if($("img.lazyload").length == 0) { return; }
	$("img.lazyload").lazyload({
		threshold     : 0,    /*Ԥ���ؿɼ��߶�100px*/
		skip_invisible: false,/*���ز�ͼƬ������*/
		failure_limit : 4	  /*ҳ�����дӵڼ���img��ǩ��ʼ����*/
	});
}

$(function(){
	initSmallCartInfo();
	initLazyloadParams();
	initHotDeal();
});

//���վ���л�

/*����Ⱦ����begin*/
function writeResult(siteinfoArray){
	if(siteinfoArray.length >= 1){
		var defCity = siteinfoArray[1];
		$("#defCity").html(defCity);
	}
}
//��ʾ�л���վ������
var changeMid=0;
function showChangeSub(){
	if($("#layoutBg").length > 0){
		closeChangeSub();
		return;
	}
	$('.site-p').addClass('site-hover');
	showShade();
	
	//�ѵײ����غõĵ�������ͷ��ѡ��
	var sitecont = $("#topchangesub").html();
	if(sitecont != undefined && sitecont != ""){
		$("#sitecont").html(sitecont);
		$("#topchangesub").html("");
	}
	$("#sitename").addClass("sitename_curr");
	$("#sitecont").show();
	$("#siteconfirm").hide();
	$(".siteinfo").css("z-index","1001");
	
	$("#siteinfo").css({"border-left-color": "#eeeeee", "background-color": "#fff"});	
}
//�ر�
function closeChangeSub(){
	setSiteInfoShort();
	if($("#layoutBg").length > 0){
		document.body.removeChild($("#layoutBg")[0]);
	}
	$('.site-p').removeClass('site-hover');
	$("#sitename").removeClass("sitename_curr");
	$("#sitecont").hide();
	$("#siteconfirm").hide();
	$(".siteinfo").css("z-index","999");
	
	$("#siteinfo").css({"border-left-color": "#F5F5F5", "background-color": "transparent"});
}

function setSiteInfoShort(){
	var siteinfo = $.cookie("siteinfo");
	if(!siteinfo){setTimeout(function(){initSiteInfoDelay()},1000);return;}
	var siteinfoArray = $.cookie("siteinfo").split("|");
	var domainValue = ".womai.com";
	if(siteinfoArray.length > 2){domainValue = siteinfoArray[2];}
	$.cookie("siteinfotemp", mid, {path:'/',domain:domainValue,expires:2});

}
function initSiteInfoDelay(){
	var siteinfo = $.cookie("siteinfo");
	if(!siteinfo){setTimeout(function(){initSiteInfoDelay()},1000);return;}//��ȡ����siteinfo��Ϣ����ʱ1s����ִ�У��첽��������ʱ��ᷢ�������
	var isShowChangeSub = false, siteinfoArray = siteinfo.split("|"), siteinfoshort = $.cookie("siteinfotemp");
	if(siteinfoArray && siteinfoArray.length > 0){
		writeResult(siteinfoArray);
		if(siteinfoArray[0] != mid){isShowChangeSub = true;}
	}
	if(siteinfoshort && siteinfoshort == mid)return;
	if(!judgeSupportSite(mid))return;
	if(isShowChangeSub){showChangeSub();}
}

///ȷ���л�
function changeSubConfirm(currchangemid){
	$("#sitecont").hide();
	changeSubConfirmCommon(currchangemid,"siteconfirm");
}

function changeSubConfirmCommon(currchangemid,confirmLayerId){
	if(currchangemid == mid) {
		closeChangeSub();
		return;
	}
	if(!judgeSupportSite(currchangemid)){
		closeChangeSub();
		comAlert("�Բ��𣬱�ҳ��" + getSiteNameFromMid(currchangemid) + "��δ���ߡ�");
		return;
	}
	changeMid = currchangemid;
	var uri = crossDomain + frontPath + "/frontendjson/smallcartinfo.do?mid=" + mid + "&callback=?";
	$.getJSON(uri,function(data){
		if(data && data.totalAmount > 0){
			$("#" + confirmLayerId).show();
		}else if(data){
			doChangeSub();
		}
	});
}

function doChangeSub(){
	closeChangeSub();
	var returnUrl = "";
	try{
		frontDomain;
		returnUrl = formatchangesub(changeMid);
	}catch(e){
		returnUrl = window.location.href;
	}
	//ƴ�Ӳ�����������
	var params = {};
	params.changeMid = changeMid;
	params.fromMid = mid;
	params.returnUrl = returnUrl;
	var uri = frontPath + "/Site/changeSite.do?" + $.param(params);
	window.location.href = uri;
}

var supportSite = supportSite || [0,100,200];

function judgeSupportSite(currmid){
	for(var i=0; i<supportSite.length; i++){
		if(currmid == supportSite[i]){
			return true;
		}
	}
	return false;
}
function deleteUnselItem(cartId,productid,isPresent,index){
	$("#delsmallcart" + index + "_" + cartId + "_" + productid).hide();
	var params = new Object();
	params["mid"] = mid;
	params["cartid"] = cartId;
	params["productid"] = productid;
	var url=crossDomain + frontPath + "/frontendjson/delunselcartitem.do?" + $.param(params) + "&callback=?";
	$.getJSON(url,params,callbackSetSmallCartAmount);
	
}
function getSiteNameFromMid(mid){
	var siteName = "";
	switch(Number(mid)){
		case 0:siteName="����վ";break;
		case 100:siteName="����վ";break;
		case 200:siteName="����վ";break;
		default:siteName="����վ";break;
	}
	return siteName;
}
$.fn.extend({
	//����վ����¼�
	siteShowSubcontClick:function(cont,layer){
		$(this).click(function(){
			if($(this).hasClass("cur")){
				document.onclick = function(e) {
	   	 		   e = window.event || e; // ����IE7
		 		   obj = $(e.srcElement || e.target);
		  		   // �������λ�ڵ�ǰ�ڵ�
		 		   if ($(obj).is(".site_cont")) {
					  $(this).removeClass("cur");
					  $(cont).hide();
				      $(layer).hide();
			       }
				   if ($(obj).is(".closebtn")){
					  $(this).addClass("cur");
			    	  $(cont).show();
				      $(layer).show();
				   }
                 }
			}else{
				$(this).addClass("cur");
				$(cont).show();
				$(layer).show();
			};
		});
	},
	//�˵�hover
	showSubcontHover:function(submenu){
		$(this).hover(function(){
			$(this).addClass("cur");
			$(this).find(submenu).show();	
		},function(){
			$(this).removeClass("cur");
			$(this).find(submenu).hide();	
		});
	}
})
/*----------------------------------------------------------------------*/
$(function(){
//����
	$(".shan-nav").find("li").hover(function(){
		$(this).addClass("current").siblings().removeClass("current");	
	},function(){
		$(this).removeClass("current").parent().find('li').eq(0).addClass("current");
	})
})
$(window).scroll(function(){
	//�������ﳵ20141217
	/*var winHeight = $(window).height();
	var shanOffsetTop = $('#j-shan-all-infor').offset().top;
	shanOffsetTop -= 35;
	$('.float-cart-con').height(winHeight);
	if($(window).scrollTop()>shanOffsetTop){
		$('.float-cart-con').show();
	}else {
		$('.float-cart-con').hide();
	}*/
	 //��껬��ָ���߶� ����ʾ
  	 if(($(window).scrollTop())>200){
  		 $('#to-top').css('visibility','visible');
      }else{
  		$('#to-top').css('visibility','hidden'); 
  	 }
})

//�������ﳵ20150304
$(function(){
	//ҳ�����ʱ��ȡ�������ﳵ�ĸ߶�
	getWinHeight();
	var screenwidth = screen.width;
	$(window).resize(function(){
		getWinHeight();
	})
	var cartCon = $('.float-cart-r');
	
	//�󶨹��ﳵ��� ����״̬
	$(".cart-infor .cont").bind({
		click: function(e){ 
			getCartTotalAmountForMax();
			if (cartCon.attr('data-visible')==0){
				$('.float-cart-con').stop().animate({right:'0'},500);
				$(this).addClass('hover2');	
				if(screenwidth < 1210){
					$(this).parents('.cart-infor-parent').addClass('cart-infor-click');
					$(this).parents('.cart-infor-parent').find('.link_info').addClass('info-bottom-click');
					$(this).parents('.cart-infor-parent').find('.cu').addClass('cu-bottom-click');
				}
				cartCon.attr('data-visible','1')
			}else{
				$('.float-cart-con').stop().animate({right:'-285px'},500);
				$(this).removeClass('hover2');	
				if(screenwidth < 1210){
					$(this).parents('.cart-infor-parent').removeClass('cart-infor-click');
					$(this).parents('.cart-infor-parent').find('.link_info').removeClass('info-bottom-click');
					$(this).parents('.cart-infor-parent').find('.cu').removeClass('cu-bottom-click');
				}
				cartCon.attr('data-visible','0')
			}
			e.stopPropagation();
	    },
		mouseover: function(){
			if(screenwidth < 1210){
				$(this).parents('.cart-infor-parent').addClass('cart-infor-hover');
				$(this).parents('.cart-infor-parent').find('.link_info').addClass('info-bottom-hover');
				$(this).parents('.cart-infor-parent').find('.cu').addClass('cu-bottom-hover');
			}
			$(this).addClass('hover');	
		},  
		mouseout: function(){
			if(screenwidth < 1210){
				$(this).parents('.cart-infor-parent').removeClass('cart-infor-hover');
				$(this).parents('.cart-infor-parent').find('.link_info').removeClass('info-bottom-hover');
				$(this).parents('.cart-infor-parent').find('.cu').removeClass('cu-bottom-hover');
			}
			$(this).removeClass('hover');
		}  
 	 });
	
	$(".cart-infor-parent").bind({
		mouseover: function(){
			if(screenwidth < 1210){
				$(this).addClass('cart-infor-hover');
				$(this).find('.link_info').addClass('info-bottom-hover');
				$(this).find('.cu').addClass('cu-bottom-hover');
			}
			$(this).addClass('hover');	
				
		},  
		mouseout: function(){
			if(screenwidth < 1210){
				$(this).removeClass('cart-infor-hover');
				$(this).find('.link_info').removeClass('info-bottom-hover');
				$(this).find('.cu').removeClass('cu-bottom-hover');
			}
			$(this).removeClass('hover');
		} 
	}); 
	 $('.float-cart-con').click(function(e){
		 e.stopPropagation();
	 })
	 $('#to-top').click(function(){
		 $('html,body').animate({scrollTop:0},300);
	 })
	 $(document).click(function() {
		$('.float-cart-con').stop().animate({right:'-285px'},500);
		cartCon.attr('data-visible','0')
		if(screenwidth < 1210){
			$('.cart-infor-parent').removeClass('cart-infor-hover');
			$('.cart-infor-parent').removeClass('cart-infor-click');
			$('.cart-infor-parent').removeClass('cart-infor-click');
			$('.cart-infor-parent').find('.cu').removeClass('cu-bottom-click');
			$('.info-bottom').find('.link_info').not('.top').removeClass('info-bottom-click');
		}
		$(".cart-infor .cont").removeClass('hover2'); 
	}); 
	 
	 $('.float-cart-r li').live('hover',function(event){ 
		 if(event.type=='mouseover'){ 
			 $(this).find('.pro-price a').css('display','block');
		 }else{ 
			 $(this).find('.pro-price a').css('display','none');
		 } 
	 });
})
//��ȡ�������ﳵ��ʾ�ĸ߶�
function getWinHeight(){
	var winHeight = $(window).height();
	$('.cart-infor-parent,.float-cart-r,.empty-cart').height(winHeight);
	var marginTop = Math.floor(winHeight*0.15);
	$('.cart-infor').css('margin-top',marginTop);
	var specialHeight = winHeight - ($('.float-cart-r .total').height()+40) - 45;
	var ulHeight = $('.float-cart-r ul').height();
	if( ulHeight >= specialHeight){
		$('.float-cart-r ul').height(specialHeight);
		$('.float-cart-r ul').addClass('special');
	}else{
		$('.float-cart-r ul').height(ulHeight);
		$('.float-cart-r ul').removeClass('special');
	}
}
//����ת��Ϊ������ʽ
function convertToChinese(num){
	var N = [
			    "��", "һ", "��", "��", "��", "��", "��", "��", "��", "��"
			];
    var str = num.toString();
    var len = num.toString().length;
    var C_Num = [];
    for(var i = 0; i < len; i++){
        C_Num.push(N[str.charAt(i)]);
    }
    return C_Num.join('');
}