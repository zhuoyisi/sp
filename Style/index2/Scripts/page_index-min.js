var jsPath=jsPathTxt+"/static/newJs/plugins/",loadState=[jsPath+"jquery.itz.AmountInput.js",jsPath+"jquery.popupLevel.js",jsPath+"slides.min.jquery.js",jsPath+"jquery.positionfixed.js",jsPath+"tipsWindow.js",jsPath+"floatService.js",jsPath+"jquery.itz.AmountInput-1.js"];delayGetScript(loadState,function(data){$(function(){function activeItem(n){$slide.find(".directs ul li").removeClass("active"),$slide.find(".directs ul li[data-seq="+n+"]").addClass("active"),$slide.find(".contents ul").animate({left:974*-n},"500","easeInOutQuad")}function startSlide(){return slideHandle?!1:(slideHandle=setInterval(function(){var curActived,nextActived,$activedItem=$slide.find(".directs ul li[class=active]");$activedItem.length?curActived=parseInt($activedItem.attr("data-seq"),10):(curActived=0,$slide.find(".directs ul li").first().addClass("active")),nextActived=curActived+1,nextActived>$slide.find(".directs ul li").length-1&&(nextActived=0),activeItem(nextActived)},4e3),!0)}function stopSlide(){if(slideHandle){try{clearInterval(slideHandle)}catch(ex){}slideHandle=null}}$.fn.reciprocal=function(arg){var options=$.extend({},{style:"defaultStyle",speed:1,scale:"scale"},arg),thatEle=this,reciprocal={init:function(){var that=this;$(thatEle).html(this.scale[options.scale]()),this.style[options.style](),$(thatEle).find("span").each(function(index,element){$(element).parent().show(),that.daoshu($(element))})},strCharAt:function(value){var value=String(value),arr=[],txt="";if(value.indexOf(",")){arr=value.split(",");for(var i=0,l=arr.length;l>i;i++)txt+=arr[i];return txt}return value},scale:{scale:function(){var txt=reciprocal.strCharAt(options.value),arr=[],txtXiaoShu="";if(-1!=txt.indexOf(".")&&(txtXiaoShu=txt.substr(txt.indexOf(".")),txt=txt.substr(0,txt.indexOf("."))),txt.length>0)for(var i=txt.length;i>0;i--)0==(txt.length-i)%3?txt.length==i?arr.unshift("<span>"+txt.charAt(i-1)+"</span>"):arr.unshift("<span>"+txt.charAt(i-1)+"</span><b>,</b>"):arr.unshift("<span>"+txt.charAt(i-1)+"</span>");if(txtXiaoShu)for(var i=0;i<txtXiaoShu.length;i++)"."==txtXiaoShu.charAt(i)?arr.push("<b>"+txtXiaoShu.charAt(i)+"</b>"):arr.push("<span>"+txtXiaoShu.charAt(i)+"</span>");return arr},defaultScale:function(){var txt=reciprocal.strCharAt(options.value),arr=[],txtXiaoShu="";if(-1!=txt.indexOf(".")&&(txtXiaoShu=txt.substr(txt.indexOf(".")),txt=txt.substr(0,txt.indexOf("."))),txt.length>0)for(var i=txt.length;i>0;i--)arr.unshift("<span>"+txt.charAt(i-1)+"</span>");if(txtXiaoShu)for(var i=0;i<txtXiaoShu.length;i++)"."==txtXiaoShu.charAt(i)?arr.push("<b>"+txtXiaoShu.charAt(i)+"</b>"):arr.push("<span>"+txtXiaoShu.charAt(i)+"</span>");return arr}},style:{span:function(){$(thatEle).addClass("reciprocal-span")},defaultStyle:function(){$(thatEle).addClass("reciprocal-default")}},speed:function(){var speed=options.speed;return[10*speed,100*speed,10*speed]},daoshu:function(ele){var state=!1,num=parseInt(ele.text()),that=this,arr=function(){for(var arr1=[],value=function(){return Math.floor(10*Math.random())},i=0;10!=arr1.length;i++){var valueNum=value();if(-1==$.inArray(valueNum,arr1)&&arr1.push(valueNum),200==i)return arr1}return arr1}(),speed=that.speed();$.autoDown(function(jishu){if(jishu==speed[0])return $.autoDown(function(){var numArr=arr[0];return numArr==num||state?(state=!0,ele.text(num),!1):(ele.text(numArr),arr.shift(),!0)},speed[1]),!1;var numArr=arr[Math.floor(10*Math.random())];return ele.text(numArr),jishu++,!0},speed[2])}};reciprocal.init()},$(".bi-item-4 .bi-item-value").reciprocal({value:repay_yes_capital}),$(".bi-item-1 .bi-item-value").reciprocal({value:real_account_total}),$(".bi-item-2 .bi-item-value").reciprocal({value:repay_will_interest}),$(".bi-item-3 .bi-item-value").reciprocal({value:repay_yes_interest}),function(){var bannerImgList=$(".b-sImage").find("span"),bannerImgBlist=$(".b-bImage").find("li"),iNum=0,stopStr=!0,timeOut=0,userAgent=navigator.userAgent,fun=function(){return ie6&&/SE/.test(userAgent)&&/MetaSr/.test(userAgent)?function(){bannerImgList.removeClass("hover"),$(bannerImgList[iNum]).addClass("hover"),bannerImgBlist.filter(function(index){return bannerImgBlist[index]!=bannerImgBlist[iNum]?bannerImgBlist[index]:void 0}).hide(),$(bannerImgBlist[iNum]).show(),iNum++}:function(){bannerImgList.removeClass("hover"),$(bannerImgList[iNum]).addClass("hover"),bannerImgBlist.filter(function(index){return bannerImgBlist[index]!=bannerImgBlist[iNum]?bannerImgBlist[index]:void 0}).fadeOut(800),$(bannerImgBlist[iNum]).fadeIn(800),iNum++}}();bannerImgList.on("mouseover",function(){var that=$(this);timeOut=setTimeout(function(){bannerImgList.removeClass("hover"),that.addClass("hover"),bannerImgList.filter(function(index){$(this).hasClass("hover")&&(iNum=index)}),ie6&&/SE/.test(userAgent)&&/MetaSr/.test(userAgent)?(bannerImgBlist.filter(function(index){return bannerImgBlist[index]!=bannerImgBlist[iNum]?bannerImgBlist[index]:void 0}).hide(),$(bannerImgBlist[iNum]).show()):bannerImgBlist.filter(function(index){return bannerImgBlist[index]!=bannerImgBlist[iNum]?bannerImgBlist[index]:void 0}).fadeOut(800,function(){$(bannerImgBlist[iNum]).fadeIn(800).show()}),stopStr=!1},150)}).on("mouseout",function(){clearTimeout(timeOut),stopStr=!0}),$("#slider").on("mouseover",function(){stopStr=!1}).on("mouseout",function(){stopStr=!0}),setTimeout(function(){0==stopStr?setTimeout(arguments.callee,5e3):iNum!=$(".b-bImage li").length?(setTimeout(arguments.callee,5e3),fun()):(iNum=0,setTimeout(arguments.callee,5e3),fun())},100)}();var $slide=$("#promo .promo-slide"),slideHandle;startSlide(),$slide.delegate(".directs li","click",function(e){stopSlide(),e.preventDefault();var $this=$(this),seq=parseInt($this.attr("data-seq"),0);activeItem(seq)}).on("mouseenter",function(){stopSlide()}).on("mouseleave",function(){startSlide()}),$("#slides").slides({preload:!0,preloadImage:jsPathTxt+"/static/css/img/loading.gif",play:4e3,pause:2500,hoverPause:!0});var ajustSlideBtns=function(){var ajustHandle,minWidth=60,$btnPagePrev=$(".head-slide .slide-wrap .prev"),$btnPageNext=$(".head-slide .slide-wrap .next");return function(){try{clearTimeout(ajustHandle)}catch(ex){}ajustHandle=setTimeout(function(){var margin=($(window).width()-960)/2;minWidth>margin?($btnPagePrev.animate({width:60,left:0},"fast"),$btnPageNext.animate({width:60,right:0},"fast")):($btnPagePrev.animate({width:margin,left:-margin},"fast"),$btnPageNext.animate({width:margin,right:-margin},"fast"))},200)}}();ajustSlideBtns(),$(window).resize(function(){ajustSlideBtns()}),$(".invest-item").filter(".simple-item").on("mouseenter",function(){$(this).addClass("simple-item-hover")}).on("mouseleave",function(){$(this).removeClass("simple-item-hover")}),autoLoginStatus(),$(".btn-invest-imm, .btn-modify-investment").click(function(e){var options=eval("("+$(this).attr("data-invest-amount-configs")+")");return new $.itz.AmountInput($("#invest-amount"),options),$("#panel-input-invest-money").find("form").attr("action",$(this).attr("href")),ie6?setTimeout(function(){$("#panel-input-invest-money").dialog({title:"填写投资金额",width:510,modal:!0,show:{effect:"fade",duration:200}})},700):$("#panel-input-invest-money").dialog({title:"填写投资金额",width:510,modal:!0,show:{effect:"fade",duration:200}}),!1}),onlineServiceFun.init(".pic-customer-service"),onlineServiceFun.popupInit("#onlineService"),$(".apostrophe").apostrophe(),$(".project-tab-list").find("a").click(function(){var that=$(this),$index_tab_shouming_a=$("#index_tab_shouming").find("a");return $(".project-tab-list").find("li").removeClass("current"),that.parent().addClass("current"),$(".tab-item-list-1").hide(),$("."+that.attr("data-item")).show(),$index_tab_shouming_a.hide(),"invest-item-list"==that.attr("data-item")?$("#qiYeShuoMing").show():"abs-item-list"==that.attr("data-item")?$("#ziChanShuoMing").show():"debt-item-list"==that.attr("data-item")?$("#zhaiQuanShuoMing").show():$("#leaseShuoMing").show(),!1});var popWindowbinded=0,debtFun=function(options,dialog){""==$("#debt_pop  .itzui-amount-form").attr("action")&&$("#debt_pop  .itzui-amount-form").attr("action","/debt/a"+options.argument.debtId+".html?detail=true"),0==$("#debt_pop  [name='account']").length&&$("#debt_pop  .itzui-amount-form").append('<input type="hidden" name="account" id="debt_account" value=""/><input type="hidden" name="debt_id" id="debt_debt_id" value=""/><input type="hidden" name="is_ajax" value="1"/>'),$.investPop.init($.extend(options,{ele:{spinner:$("#debt_pop .spinner"),slider:$("#debt_pop .slider"),dialogEle:$("#debt_pop")},title:"购买债权",callback:function(settings){$("[name='tender_id']").val(settings.argument.tender_id),dialog&&dialog.dialog("close")}})),popWindowbinded||(window.User.user_id||itz.loginPop.init({selector:"#debt_pop .btn-invest-submit",preOpen:function(){$("#debt_pop").dialog("close")},success:function(){autoLoginStatus(),$("#debt_pop .btn-invest-submit").unbind("click"),$("#loginPop").dialog("close")}}),popWindowbinded=1)};$(".creditor-bill-1").click(function(){var that=$(this),options=eval("("+that.attr("data-invest-amount-configs")+")");return"false"==that.attr("data-state-apr")?$("#tiShi").dialog({hide:!0,modal:!0,title:"提示",resizable:!1,buttons:{"继续认购":function(){var dialog=$(this);debtFun(options,dialog)},"去了解企业直投":function(){window.location.href="/dinvest/invest/index"}}}):debtFun(options),!1}),$("#debt_pop form").submit(function(){return $.investPop.checkIdentity()?void 0:($("#debt_pop").dialog("close"),!1)})})});