(function(){var h={},mt={},c={id:"12f262996fc81e00f6abfc009a515ac9",dm:["nainaiwang.com"],js:"tongji.baidu.com/hm-web/js/",etrk:[],icon:'',ctrk:false,align:-1,nv:-1,vdur:1800000,age:31536000000,rec:1,rp:[],trust:0,vcard:0,qiao:0,lxb:0,conv:0,comm:0,apps:''};var p=!0,q=null,r=!1;mt.j={};mt.j.Ia=/msie (\d+\.\d+)/i.test(navigator.userAgent);mt.j.cookieEnabled=navigator.cookieEnabled;mt.j.javaEnabled=navigator.javaEnabled();mt.j.language=navigator.language||navigator.browserLanguage||navigator.systemLanguage||navigator.userLanguage||"";mt.j.ra=(window.screen.width||0)+"x"+(window.screen.height||0);mt.j.colorDepth=window.screen.colorDepth||0;mt.cookie={};
mt.cookie.set=function(a,b,e){var d;e.F&&(d=new Date,d.setTime(d.getTime()+e.F));document.cookie=a+"="+b+(e.domain?"; domain="+e.domain:"")+(e.path?"; path="+e.path:"")+(d?"; expires="+d.toGMTString():"")+(e.Ma?"; secure":"")};mt.cookie.get=function(a){return(a=RegExp("(^| )"+a+"=([^;]*)(;|$)").exec(document.cookie))?a[2]:q};mt.p={};mt.p.da=function(a){return document.getElementById(a)};mt.p.Ea=function(a,b){for(b=b.toUpperCase();(a=a.parentNode)&&1==a.nodeType;)if(a.tagName==b)return a;return q};
(mt.p.T=function(){function a(){if(!a.z){a.z=p;for(var b=0,e=d.length;b<e;b++)d[b]()}}function b(){try{document.documentElement.doScroll("left")}catch(d){setTimeout(b,1);return}a()}var e=r,d=[],g;document.addEventListener?g=function(){document.removeEventListener("DOMContentLoaded",g,r);a()}:document.attachEvent&&(g=function(){"complete"===document.readyState&&(document.detachEvent("onreadystatechange",g),a())});(function(){if(!e)if(e=p,"complete"===document.readyState)a.z=p;else if(document.addEventListener)document.addEventListener("DOMContentLoaded",
g,r),window.addEventListener("load",a,r);else if(document.attachEvent){document.attachEvent("onreadystatechange",g);window.attachEvent("onload",a);var d=r;try{d=window.frameElement==q}catch(n){}document.documentElement.doScroll&&d&&b()}})();return function(b){a.z?b():d.push(b)}}()).z=r;mt.event={};mt.event.c=function(a,b,e){a.attachEvent?a.attachEvent("on"+b,function(d){e.call(a,d)}):a.addEventListener&&a.addEventListener(b,e,r)};
mt.event.preventDefault=function(a){a.preventDefault?a.preventDefault():a.returnValue=r};mt.i={};mt.i.parse=function(){return(new Function('return (" + source + ")'))()};
mt.i.stringify=function(){function a(a){/["\\\x00-\x1f]/.test(a)&&(a=a.replace(/["\\\x00-\x1f]/g,function(a){var b=e[a];if(b)return b;b=a.charCodeAt();return"\\u00"+Math.floor(b/16).toString(16)+(b%16).toString(16)}));return'"'+a+'"'}function b(a){return 10>a?"0"+a:a}var e={"\b":"\\b","\t":"\\t","\n":"\\n","\f":"\\f","\r":"\\r",'"':'\\"',"\\":"\\\\"};return function(d){switch(typeof d){case "undefined":return"undefined";case "number":return isFinite(d)?String(d):"null";case "string":return a(d);case "boolean":return String(d);
default:if(d===q)return"null";if(d instanceof Array){var e=["["],l=d.length,n,f,k;for(f=0;f<l;f++)switch(k=d[f],typeof k){case "undefined":case "function":case "unknown":break;default:n&&e.push(","),e.push(mt.i.stringify(k)),n=1}e.push("]");return e.join("")}if(d instanceof Date)return'"'+d.getFullYear()+"-"+b(d.getMonth()+1)+"-"+b(d.getDate())+"T"+b(d.getHours())+":"+b(d.getMinutes())+":"+b(d.getSeconds())+'"';n=["{"];f=mt.i.stringify;for(l in d)if(Object.prototype.hasOwnProperty.call(d,l))switch(k=
d[l],typeof k){case "undefined":case "unknown":case "function":break;default:e&&n.push(","),e=1,n.push(f(l)+":"+f(k))}n.push("}");return n.join("")}}}();mt.lang={};mt.lang.e=function(a,b){return"[object "+b+"]"==={}.toString.call(a)};mt.lang.Ja=function(a){return mt.lang.e(a,"Number")&&isFinite(a)};mt.lang.La=function(a){return mt.lang.e(a,"String")};mt.localStorage={};
mt.localStorage.C=function(){if(!mt.localStorage.f)try{mt.localStorage.f=document.createElement("input"),mt.localStorage.f.type="hidden",mt.localStorage.f.style.display="none",mt.localStorage.f.addBehavior("#default#userData"),document.getElementsByTagName("head")[0].appendChild(mt.localStorage.f)}catch(a){return r}return p};
mt.localStorage.set=function(a,b,e){var d=new Date;d.setTime(d.getTime()+e||31536E6);try{window.localStorage?(b=d.getTime()+"|"+b,window.localStorage.setItem(a,b)):mt.localStorage.C()&&(mt.localStorage.f.expires=d.toUTCString(),mt.localStorage.f.load(document.location.hostname),mt.localStorage.f.setAttribute(a,b),mt.localStorage.f.save(document.location.hostname))}catch(g){}};
mt.localStorage.get=function(a){if(window.localStorage){if(a=window.localStorage.getItem(a)){var b=a.indexOf("|"),e=a.substring(0,b)-0;if(e&&e>(new Date).getTime())return a.substring(b+1)}}else if(mt.localStorage.C())try{return mt.localStorage.f.load(document.location.hostname),mt.localStorage.f.getAttribute(a)}catch(d){}return q};
mt.localStorage.remove=function(a){if(window.localStorage)window.localStorage.removeItem(a);else if(mt.localStorage.C())try{mt.localStorage.f.load(document.location.hostname),mt.localStorage.f.removeAttribute(a),mt.localStorage.f.save(document.location.hostname)}catch(b){}};mt.sessionStorage={};mt.sessionStorage.set=function(a,b){if(window.sessionStorage)try{window.sessionStorage.setItem(a,b)}catch(e){}};
mt.sessionStorage.get=function(a){return window.sessionStorage?window.sessionStorage.getItem(a):q};mt.sessionStorage.remove=function(a){window.sessionStorage&&window.sessionStorage.removeItem(a)};mt.U={};mt.U.log=function(a,b){var e=new Image,d="mini_tangram_log_"+Math.floor(2147483648*Math.random()).toString(36);window[d]=e;e.onload=e.onerror=e.onabort=function(){e.onload=e.onerror=e.onabort=q;e=window[d]=q;b&&b(a)};e.src=a};mt.L={};
mt.L.ia=function(){var a="";if(navigator.plugins&&navigator.mimeTypes.length){var b=navigator.plugins["Shockwave Flash"];b&&b.description&&(a=b.description.replace(/^.*\s+(\S+)\s+\S+$/,"$1"))}else if(window.ActiveXObject)try{if(b=new ActiveXObject("ShockwaveFlash.ShockwaveFlash"))(a=b.GetVariable("$version"))&&(a=a.replace(/^.*\s+(\d+),(\d+).*$/,"$1.$2"))}catch(e){}return a};
mt.L.Ca=function(a,b,e,d,g){return'<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" id="'+a+'" width="'+e+'" height="'+d+'"><param name="movie" value="'+b+'" /><param name="flashvars" value="'+(g||"")+'" /><param name="allowscriptaccess" value="always" /><embed type="application/x-shockwave-flash" name="'+a+'" width="'+e+'" height="'+d+'" src="'+b+'" flashvars="'+(g||"")+'" allowscriptaccess="always" /></object>'};mt.url={};
mt.url.h=function(a,b){var e=a.match(RegExp("(^|&|\\?|#)("+b+")=([^&#]*)(&|$|#)",""));return e?e[3]:q};mt.url.Ga=function(a){return(a=a.match(/^(https?:)\/\//))?a[1]:q};mt.url.fa=function(a){return(a=a.match(/^(https?:\/\/)?([^\/\?#]*)/))?a[2].replace(/.*@/,""):q};mt.url.O=function(a){return(a=mt.url.fa(a))?a.replace(/:\d+$/,""):a};mt.url.Fa=function(a){return(a=a.match(/^(https?:\/\/)?[^\/]*(.*)/))?a[2].replace(/[\?#].*/,"").replace(/^$/,"/"):q};
h.m={Ha:"http://tongji.baidu.com/hm-web/welcome/ico",S:"hm.baidu.com/hm.gif",X:"baidu.com",ma:"hmmd",na:"hmpl",la:"hmkw",ka:"hmci",oa:"hmsr",o:0,k:Math.round(+new Date/1E3),protocol:"https:"==document.location.protocol?"https:":"http:",Ka:0,za:6E5,Aa:10,Ba:1024,ya:1,A:2147483647,V:"cc cf ci ck cl cm cp cw ds ep et fl ja ln lo lt nv rnd si st su v cv lv api tt u".split(" ")};
(function(){var a={l:{},c:function(a,e){this.l[a]=this.l[a]||[];this.l[a].push(e)},s:function(a,e){this.l[a]=this.l[a]||[];for(var d=this.l[a].length,g=0;g<d;g++)this.l[a][g](e)}};return h.q=a})();
(function(){function a(a,d){var g=document.createElement("script");g.charset="utf-8";b.e(d,"Function")&&(g.readyState?g.onreadystatechange=function(){if("loaded"===g.readyState||"complete"===g.readyState)g.onreadystatechange=q,d()}:g.onload=function(){d()});g.src=a;var l=document.getElementsByTagName("script")[0];l.parentNode.insertBefore(g,l)}var b=mt.lang;return h.load=a})();
(function(){function a(){var a="";h.b.a.nv?(a=encodeURIComponent(document.referrer),window.sessionStorage?e.set("Hm_from_"+c.id,a):b.set("Hm_from_"+c.id,a,864E5)):a=(window.sessionStorage?e.get("Hm_from_"+c.id):b.get("Hm_from_"+c.id))||"";return a}var b=mt.localStorage,e=mt.sessionStorage;return h.M=a})();
(function(){var a=mt.p,b=h.m,e=h.load,d=h.M;h.q.c("pv-b",function(){c.rec&&a.T(function(){for(var g=0,l=c.rp.length;g<l;g++){var n=c.rp[g][0],f=c.rp[g][1],k=a.da("hm_t_"+n);if(f&&!(2==f&&!k||k&&""!==k.innerHTML))k="",k=Math.round(Math.random()*b.A),k=4==f?"http://crs.baidu.com/hl.js?"+["siteId="+c.id,"planId="+n,"rnd="+k].join("&"):"http://crs.baidu.com/t.js?"+["siteId="+c.id,"planId="+n,"from="+d(),"referer="+encodeURIComponent(document.referrer),"title="+encodeURIComponent(document.title),"rnd="+
k].join("&"),e(k)}})})})();(function(){var a=h.m,b=h.load,e=h.M;h.q.c("pv-b",function(){if(c.trust&&c.vcard){var d=a.protocol+"//trust.baidu.com/vcard/v.js?"+["siteid="+c.vcard,"url="+encodeURIComponent(document.location.href),"source="+e(),"rnd="+Math.round(Math.random()*a.A)].join("&");b(d)}})})();
(function(){function a(){return function(){h.b.a.nv=0;h.b.a.st=4;h.b.a.et=3;h.b.a.ep=h.D.ga()+","+h.D.ea();h.b.g()}}function b(){clearTimeout(x);var a;w&&(a="visible"==document[w]);y&&(a=!document[y]);f="undefined"==typeof a?p:a;if((!n||!k)&&f&&m)u=p,t=+new Date;else if(n&&k&&(!f||!m))u=r,s+=+new Date-t;n=f;k=m;x=setTimeout(b,100)}function e(a){var k=document,t="";if(a in k)t=a;else for(var s=["webkit","ms","moz","o"],b=0;b<s.length;b++){var d=s[b]+a.charAt(0).toUpperCase()+a.slice(1);if(d in k){t=
d;break}}return t}function d(a){if(!("focus"==a.type||"blur"==a.type)||!(a.target&&a.target!=window))m="focus"==a.type||"focusin"==a.type?p:r,b()}var g=mt.event,l=h.q,n=p,f=p,k=p,m=p,v=+new Date,t=v,s=0,u=p,w=e("visibilityState"),y=e("hidden"),x;b();(function(){var a=w.replace(/[vV]isibilityState/,"visibilitychange");g.c(document,a,b);g.c(window,"pageshow",b);g.c(window,"pagehide",b);"object"==typeof document.onfocusin?(g.c(document,"focusin",d),g.c(document,"focusout",d)):(g.c(window,"focus",d),
g.c(window,"blur",d))})();h.D={ga:function(){return+new Date-v},ea:function(){return u?+new Date-t+s:s}};l.c("pv-b",function(){g.c(window,"unload",a())});return h.D})();
(function(){var a=mt.lang,b=h.m,e=h.load,d={pa:function(d){if((void 0===window._dxt||a.e(window._dxt,"Array"))&&"undefined"!==typeof h.b){var l=h.b.G();e([b.protocol,"//datax.baidu.com/x.js?si=",c.id,"&dm=",encodeURIComponent(l)].join(""),d)}},xa:function(b){if(a.e(b,"String")||a.e(b,"Number"))window._dxt=window._dxt||[],window._dxt.push(["_setUserId",b])}};return h.$=d})();
(function(){function a(k){for(var b in k)if({}.hasOwnProperty.call(k,b)){var d=k[b];e.e(d,"Object")||e.e(d,"Array")?a(d):k[b]=String(d)}}function b(a){return a.replace?a.replace(/'/g,"'0").replace(/\*/g,"'1").replace(/!/g,"'2"):a}var e=mt.lang,d=mt.i,g=h.m,l=h.q,n=h.$,f={P:q,r:[],B:0,Q:r,init:function(){f.d=0;f.P={push:function(){f.J.apply(f,arguments)}};l.c("pv-b",function(){f.aa();f.ba()});l.c("pv-d",f.ca);l.c("stag-b",function(){h.b.a.api=f.d||f.B?f.d+"_"+f.B:""});l.c("stag-d",function(){h.b.a.api=
0;f.d=0;f.B=0})},aa:function(){var a=window._hmt;if(a&&a.length)for(var b=0;b<a.length;b++){var d=a[b];switch(d[0]){case "_setAccount":1<d.length&&/^[0-9a-z]{32}$/.test(d[1])&&(f.d|=1,window._bdhm_account=d[1]);break;case "_setAutoPageview":if(1<d.length&&(d=d[1],r===d||p===d))f.d|=2,window._bdhm_autoPageview=d}}},ba:function(){if("undefined"===typeof window._bdhm_account||window._bdhm_account===c.id){window._bdhm_account=c.id;var a=window._hmt;if(a&&a.length)for(var b=0,d=a.length;b<d;b++)e.e(a[b],
"Array")&&"_trackEvent"!==a[b][0]&&"_trackRTEvent"!==a[b][0]?f.J(a[b]):f.r.push(a[b]);window._hmt=f.P}},ca:function(){if(0<f.r.length)for(var a=0,b=f.r.length;a<b;a++)f.J(f.r[a]);f.r=q},J:function(a){if(e.e(a,"Array")){var b=a[0];if(f.hasOwnProperty(b)&&e.e(f[b],"Function"))f[b](a)}},_trackPageview:function(a){if(1<a.length&&a[1].charAt&&"/"==a[1].charAt(0)){f.d|=4;h.b.a.et=0;h.b.a.ep="";h.b.H?(h.b.a.nv=0,h.b.a.st=4):h.b.H=p;var b=h.b.a.u,d=h.b.a.su;h.b.a.u=g.protocol+"//"+document.location.host+
a[1];f.Q||(h.b.a.su=document.location.href);h.b.g();h.b.a.u=b;h.b.a.su=d}},_trackEvent:function(a){2<a.length&&(f.d|=8,h.b.a.nv=0,h.b.a.st=4,h.b.a.et=4,h.b.a.ep=b(a[1])+"*"+b(a[2])+(a[3]?"*"+b(a[3]):"")+(a[4]?"*"+b(a[4]):""),h.b.g())},_setCustomVar:function(a){if(!(4>a.length)){var d=a[1],e=a[4]||3;if(0<d&&6>d&&0<e&&4>e){f.B++;for(var t=(h.b.a.cv||"*").split("!"),s=t.length;s<d-1;s++)t.push("*");t[d-1]=e+"*"+b(a[2])+"*"+b(a[3]);h.b.a.cv=t.join("!");a=h.b.a.cv.replace(/[^1](\*[^!]*){2}/g,"*").replace(/((^|!)\*)+$/g,
"");""!==a?h.b.setData("Hm_cv_"+c.id,encodeURIComponent(a),c.age):h.b.qa("Hm_cv_"+c.id)}}},_setReferrerOverride:function(a){1<a.length&&(h.b.a.su=a[1].charAt&&"/"==a[1].charAt(0)?g.protocol+"//"+window.location.host+a[1]:a[1],f.Q=p)},_trackOrder:function(b){b=b[1];e.e(b,"Object")&&(a(b),f.d|=16,h.b.a.nv=0,h.b.a.st=4,h.b.a.et=94,h.b.a.ep=d.stringify(b),h.b.g())},_trackMobConv:function(a){if(a={webim:1,tel:2,map:3,sms:4,callback:5,share:6}[a[1]])f.d|=32,h.b.a.et=93,h.b.a.ep=a,h.b.g()},_trackRTPageview:function(b){b=
b[1];e.e(b,"Object")&&(a(b),b=d.stringify(b),512>=encodeURIComponent(b).length&&(f.d|=64,h.b.a.rt=b))},_trackRTEvent:function(b){b=b[1];if(e.e(b,"Object")){a(b);b=encodeURIComponent(d.stringify(b));var m=function(a){var b=h.b.a.rt;f.d|=128;h.b.a.et=90;h.b.a.rt=a;h.b.g();h.b.a.rt=b},l=b.length;if(900>=l)m.call(this,b);else for(var l=Math.ceil(l/900),t="block|"+Math.round(Math.random()*g.A).toString(16)+"|"+l+"|",s=[],u=0;u<l;u++)s.push(u),s.push(b.substring(900*u,900*u+900)),m.call(this,t+s.join("|")),
s=[]}},_setUserId:function(a){a=a[1];n.pa();n.xa(a)}};f.init();h.Y=f;return h.Y})();
(function(){function a(){"undefined"==typeof window["_bdhm_loaded_"+c.id]&&(window["_bdhm_loaded_"+c.id]=p,this.a={},this.H=r,this.init())}var b=mt.url,e=mt.U,d=mt.L,g=mt.lang,l=mt.cookie,n=mt.j,f=mt.localStorage,k=mt.sessionStorage,m=h.m,v=h.q;a.prototype={I:function(a,b){a="."+a.replace(/:\d+/,"");b="."+b.replace(/:\d+/,"");var d=a.indexOf(b);return-1<d&&d+b.length==a.length},R:function(a,b){a=a.replace(/^https?:\/\//,"");return 0===a.indexOf(b)},w:function(a){for(var d=0;d<c.dm.length;d++)if(-1<
c.dm[d].indexOf("/")){if(this.R(a,c.dm[d]))return p}else{var e=b.O(a);if(e&&this.I(e,c.dm[d]))return p}return r},G:function(){for(var a=document.location.hostname,b=0,d=c.dm.length;b<d;b++)if(this.I(a,c.dm[b]))return c.dm[b].replace(/(:\d+)?[\/\?#].*/,"");return a},N:function(){for(var a=0,b=c.dm.length;a<b;a++){var d=c.dm[a];if(-1<d.indexOf("/")&&this.R(document.location.href,d))return d.replace(/^[^\/]+(\/.*)/,"$1")+"/"}return"/"},ha:function(){if(!document.referrer)return m.k-m.o>c.vdur?1:4;var a=
r;this.w(document.referrer)&&this.w(document.location.href)?a=p:(a=b.O(document.referrer),a=this.I(a||"",document.location.hostname));return a?m.k-m.o>c.vdur?1:4:3},getData:function(a){try{return l.get(a)||k.get(a)||f.get(a)}catch(b){}},setData:function(a,b,d){try{l.set(a,b,{domain:this.G(),path:this.N(),F:d}),d?f.set(a,b,d):k.set(a,b)}catch(e){}},qa:function(a){try{l.set(a,"",{domain:this.G(),path:this.N(),F:-1}),k.remove(a),f.remove(a)}catch(b){}},va:function(){var a,b,d,e,f;m.o=this.getData("Hm_lpvt_"+
c.id)||0;13==m.o.length&&(m.o=Math.round(m.o/1E3));b=this.ha();a=4!=b?1:0;if(d=this.getData("Hm_lvt_"+c.id)){e=d.split(",");for(f=e.length-1;0<=f;f--)13==e[f].length&&(e[f]=""+Math.round(e[f]/1E3));for(;2592E3<m.k-e[0];)e.shift();f=4>e.length?2:3;for(1===a&&e.push(m.k);4<e.length;)e.shift();d=e.join(",");e=e[e.length-1]}else d=m.k,e="",f=1;this.setData("Hm_lvt_"+c.id,d,c.age);this.setData("Hm_lpvt_"+c.id,m.k);d=m.k==this.getData("Hm_lpvt_"+c.id)?"1":"0";if(0===c.nv&&this.w(document.location.href)&&
(""===document.referrer||this.w(document.referrer)))a=0,b=4;this.a.nv=a;this.a.st=b;this.a.cc=d;this.a.lt=e;this.a.lv=f},ua:function(){for(var a=[],b=0,d=m.V.length;b<d;b++){var e=m.V[b],f=this.a[e];"undefined"!=typeof f&&""!==f&&a.push(e+"="+encodeURIComponent(f))}b=this.a.et;this.a.rt&&(0===b?a.push("rt="+encodeURIComponent(this.a.rt)):90===b&&a.push("rt="+this.a.rt));return a.join("&")},wa:function(){this.va();this.a.si=c.id;this.a.su=document.referrer;this.a.ds=n.ra;this.a.cl=n.colorDepth+"-bit";
this.a.ln=n.language;this.a.ja=n.javaEnabled?1:0;this.a.ck=n.cookieEnabled?1:0;this.a.lo="number"==typeof _bdhm_top?1:0;this.a.fl=d.ia();this.a.v="1.1.2";this.a.cv=decodeURIComponent(this.getData("Hm_cv_"+c.id)||"");1==this.a.nv&&(this.a.tt=document.title||"");var a=document.location.href;this.a.cm=b.h(a,m.ma)||"";this.a.cp=b.h(a,m.na)||"";this.a.cw=b.h(a,m.la)||"";this.a.ci=b.h(a,m.ka)||"";this.a.cf=b.h(a,m.oa)||""},init:function(){try{this.wa(),0===this.a.nv?this.ta():this.K(".*"),h.b=this,this.Z(),
v.s("pv-b"),this.sa()}catch(a){var b=[];b.push("si="+c.id);b.push("n="+encodeURIComponent(a.name));b.push("m="+encodeURIComponent(a.message));b.push("r="+encodeURIComponent(document.referrer));e.log(m.protocol+"//"+m.S+"?"+b.join("&"))}},sa:function(){function a(){v.s("pv-d")}"undefined"===typeof window._bdhm_autoPageview||window._bdhm_autoPageview===p?(this.H=p,this.a.et=0,this.a.ep="",this.g(a)):a()},g:function(a){var b=this;b.a.rnd=Math.round(Math.random()*m.A);v.s("stag-b");var d=m.protocol+"//"+
m.S+"?"+b.ua();v.s("stag-d");b.W(d);e.log(d,function(d){b.K(d);g.e(a,"Function")&&a.call(b)})},Z:function(){var a=document.location.hash.substring(1),d=RegExp(c.id),e=-1<document.referrer.indexOf(m.X)?p:r,f=b.h(a,"jn"),g=/^heatlink$|^select$/.test(f);a&&(d.test(a)&&e&&g)&&(a=document.createElement("script"),a.setAttribute("type","text/javascript"),a.setAttribute("charset","utf-8"),a.setAttribute("src",m.protocol+"//"+c.js+f+".js?"+this.a.rnd),f=document.getElementsByTagName("script")[0],f.parentNode.insertBefore(a,
f))},W:function(a){var b=k.get("Hm_unsent_"+c.id)||"",d=this.a.u?"":"&u="+encodeURIComponent(document.location.href),b=encodeURIComponent(a.replace(/^https?:\/\//,"")+d)+(b?","+b:"");k.set("Hm_unsent_"+c.id,b)},K:function(a){var b=k.get("Hm_unsent_"+c.id)||"";b&&((b=b.replace(RegExp(encodeURIComponent(a.replace(/^https?:\/\//,"")).replace(/([\*\(\)])/g,"\\$1")+"(%26u%3D[^,]*)?,?","g"),"").replace(/,$/,""))?k.set("Hm_unsent_"+c.id,b):k.remove("Hm_unsent_"+c.id))},ta:function(){var a=this,b=k.get("Hm_unsent_"+
c.id);if(b)for(var b=b.split(","),d=function(b){e.log(m.protocol+"//"+decodeURIComponent(b).replace(/^https?:\/\//,""),function(b){a.K(b)})},f=0,g=b.length;f<g;f++)d(b[f])}};return new a})();
(function(){var a=mt.p,b=mt.event,e=mt.url,d=mt.i;try{if(window.performance&&performance.timing&&"undefined"!==typeof h.b){var g=+new Date,l=function(a){var b=performance.timing,d=b[a+"Start"]?b[a+"Start"]:0;a=b[a+"End"]?b[a+"End"]:0;return{start:d,end:a,value:0<a-d?a-d:0}},n=q;a.T(function(){n=+new Date});var f=function(){var a,b,f;f=l("navigation");b=l("request");f={netAll:b.start-f.start,netDns:l("domainLookup").value,netTcp:l("connect").value,srv:l("response").start-b.start,dom:performance.timing.domInteractive-
performance.timing.fetchStart,loadEvent:l("loadEvent").end-f.start};a=document.referrer;var s=q;b=q;if("www.baidu.com"===(a.match(/^(http[s]?:\/\/)?([^\/]+)(.*)/)||[])[2])s=e.h(a,"qid"),b=e.h(a,"click_t");a=s;f.qid=a!=q?a:"";b!=q?(f.bdDom=n?n-b:0,f.bdRun=g-b,f.bdDef=l("navigation").start-b):(f.bdDom=0,f.bdRun=0,f.bdDef=0);h.b.a.et=87;h.b.a.ep=d.stringify(f);h.b.g()};b.c(window,"load",function(){setTimeout(f,500)})}}catch(k){}})();
(function(){var a=h.m,b={init:function(){try{if("http:"===a.protocol){var b=document.createElement("IFRAME");b.setAttribute("src","http://boscdn.bpc.baidu.com/v1/holmes-moplus/mp-cdn.html");b.style.display="none";b.style.width="1";b.style.height="1";b.Da="0";document.body.appendChild(b)}}catch(e){}}},e=navigator.userAgent.toLowerCase();-1<e.indexOf("android")&&-1===e.indexOf("micromessenger")&&b.init()})();
(function(){var a=mt.lang,b=mt.event,e=mt.i;if(c.comm&&"undefined"!==typeof h.b){var d=function(a){if(a.item){for(var b=a.length,d=Array(b);b--;)d[b]=a[b];return d}return[].slice.call(a)},g=/swt|zixun|call|chat|zoos|business|talk|kefu|openkf|online|\/LR\/Chatpre\.aspx/i,l={click:function(){for(var a=[],b=d(document.getElementsByTagName("a")),b=[].concat.apply(b,d(document.getElementsByTagName("area"))),b=[].concat.apply(b,d(document.getElementsByTagName("img"))),e=0,f=b.length;e<f;e++){var k=b[e],
l=k.getAttribute("onclick"),k=k.getAttribute("href");(g.test(l)||g.test(k))&&a.push(b[e])}return a}},n=function(a,b){for(var d in a)if(a.hasOwnProperty(d)&&b.call(a,d,a[d])===r)return r},f=function(b,d){var f={n:"swt",t:"clk"};f.v=b;if(d){var k=d.getAttribute("href"),l=d.getAttribute("onclick")?""+d.getAttribute("onclick"):q,m=d.getAttribute("id")||"";g.test(k)?(f.sn="mediate",f.snv=k):a.e(l,"String")&&g.test(l)&&(f.sn="wrap",f.snv=l);f.id=m}h.b.a.et=86;h.b.a.ep=e.stringify(f);h.b.g();for(f=+new Date;500>=
+new Date-f;);},k,m="/zoosnet"+(/\/$/.test("/zoosnet")?"":"/"),v=function(b,d){if(k===d)return f(m+b,d),r;if(a.e(d,"Array")||a.e(d,"NodeList"))for(var e=0,g=d.length;e<g;e++)if(k===d[e])return f(m+b+"/"+(e+1),d[e]),r};b.c(document,"click",function(b){b=b||window.event;k=b.target||b.srcElement;var d={};for(n(l,function(b,e){d[b]=a.e(e,"Function")?e():document.getElementById(e)});k&&k!==document&&n(d,v)!==r;)k=k.parentNode})}})();
(function(){var a=mt.event,b=mt.i;if(c.comm&&"undefined"!==typeof h.b){var e=+new Date,d={n:"anti",sb:0,kb:0,clk:0},g=function(){h.b.a.et=86;h.b.a.ep=b.stringify(d);h.b.g()};a.c(document,"click",function(){d.clk++});a.c(document,"keyup",function(){d.kb=1});a.c(window,"scroll",function(){d.sb++});a.c(window,"unload",function(){d.t=+new Date-e;g()});a.c(window,"load",function(){setTimeout(g,5E3)})}})();})();
