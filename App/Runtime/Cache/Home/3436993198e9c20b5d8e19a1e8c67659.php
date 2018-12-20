<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta property="qc:admins" content="7570776233633" />
<meta name="keywords" content="<?php echo ($glo["web_keywords"]); ?>" />
<meta name="description" content="<?php echo ($glo["web_descript"]); ?>" />
<link href="favicon.ico" type="image/x-icon"/>
<link rel="stylesheet" type="text/css" href="/Style/index2/Content/index.css" />
<link rel="stylesheet" type="text/css" href="/Style/index2/Content/css.css" />
<link rel="stylesheet" type="text/css" href="/Style/index2/Content/kefu.css" />
<link type="text/css" rel="stylesheet" href="/Style/index2/Content/jbox.css"/>
<link rel="stylesheet" type="text/css" href="/Style/index2/Content/style.css" />
<link rel="stylesheet" type="text/css" href="/Style/index2/Content/home.css" />
<link rel="stylesheet" type="text/css" href="/Style/index2/Content/base-min.css">
<script type="text/javascript" src="/Style/index2/Scripts/jquery.min.js"></script>
<script type="text/javascript" src="/Style/index2/Scripts/jquery.js"></script>

<script  src="/Style/index2/Scripts/jquery.jboxconfig.js" type="text/javascript"></script>
<script type="text/javascript" src="/Style/index2/Scripts/utils.js"></script>
<script type="text/javascript">
    var browser=navigator.appName;
    var b_version=navigator.appVersion;
    var version=b_version.split(";"); 
    if(version.length>1) var trim_Version=version[1].replace(/[ ]/g,"");

    if(browser=="Microsoft Internet Explorer" && (trim_Version=="MSIE5.0" || trim_Version=="MSIE6.0")) 
        alert("您正在使用的浏览器版本过低，有些网站效果会显示不出来，建议升级后再使用本网站。"); 

	function makevar(v){
		var d={};
		for(i in v){
			var id = v[i];
			d[id] = $("#"+id).val();
			if(!d[id]) d[id] = $("input[name='"+id+"']:checked").val();
			if(!d[id]) d[id] = $("input[name='"+id+"']").val();
			if(typeof d[id] == "undefined") d[id] = "";
		}
		return d;
	}
    function addBookmark(title, url) {
        if (window.sidebar) {
            window.sidebar.addPanel(title, url, "");
        }
        else if (document.all) {
            window.external.AddFavorite(url, title);
        }
        else if (window.opera && window.print) {
            return true;
        }
    }
    function SetHome(obj, vrl) {
        try {
            obj.style.behavior = 'url(#default#homepage)'; obj.setHomePage(vrl);
            NavClickStat(1);
        }
        catch (e) {
            if (window.netscape) {
                try {
                    netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
                }
                catch (e) {
                    alert("抱歉！您的浏览器不支持直接设为首页。请在浏览器地址栏输入“about:config”并回车然后将[signed.applets.codebase_principal_support]设置为“true”，点击“加入收藏”后忽略安全提示，即可设置成功。");
                }
                var prefs = Components.classes['@mozilla.org/preferences-service;1'].getService(Components.interfaces.nsIPrefBranch);
                prefs.setCharPref('browser.startup.homepage', vrl);
            }
        }
    }
     
// 修复 IE 下 PNG 图片不能透明显示的问题
function fixPNG(myImage) {
var arVersion = navigator.appVersion.split("MSIE");
var version = parseFloat(arVersion[1]);
if ((version >= 5.5) && (version < 7) && (document.body.filters))
{
     var imgID = (myImage.id) ? "id='" + myImage.id + "' " : "";
     var imgClass = (myImage.className) ? "class='" + myImage.className + "' " : "";
     var imgTitle = (myImage.title) ? "title='" + myImage.title   + "' " : "title='" + myImage.alt + "' ";
     var imgStyle = "display:inline-block;" + myImage.style.cssText;
     var strNewHTML = "<span " + imgID + imgClass + imgTitle

   + " style=\"" + "width:" + myImage.width

   + "px; height:" + myImage.height

   + "px;" + imgStyle + ";"

   + "filter:progid:DXImageTransform.Microsoft.AlphaImageLoader"

   + "(src=\'" + myImage.src + "\', sizingMethod='scale');\"></span>";
     myImage.outerHTML = strNewHTML;
} } 


</script>

<title><?php echo ($glo["index_title"]); ?></title>
<meta http-equiv="keywords" content="<?php echo ($glo["web_keywords"]); ?>" />
<meta http-equiv="description" content="<?php echo ($glo["web_descript"]); ?>" />
<meta property="wb:webmaster" content="37afd1196b6d28b7" />
<meta property="qc:admins" content="30505113364651155636" />
<meta property="wb:webmaster" content="d0d120bc5ee656d7" />
<script type="text/javascript">
function LoginSubmit() {
	$.jBox.tip("登陆中......",'loading');
	$.ajax({
		url: "/member/common/actlogin",
		data: {"sUserName": $("#uname").val(),"sPassword": $("#upass").val(),"sVerCode": $("#vcode").val(),"Keep":$("#loginstate").val()},
		timeout: 5000,
		cache: false,
		type: "post",
		dataType: "json",
		success: function (d, s, r) {
			if(d){
				if(d.status==0){
					$.jBox.tip(d.message,"tip");	
				}else{
					window.location.href="/";
				}
			}
		}
	});
}

function jfun_dogetpass(){
	var ux = $("#emailname").val();
	if(ux==""){
		$.jBox.tip('请输入用户名或者邮箱','tip');
		return;
	}
	$.jBox.tip("邮件发送中......","loading");
	$.ajax({
		url: "/member/common/dogetpass/",
		data: {"u":ux},
		cache: false,
		type: "post",
		dataType: "json",
		success: function (d, s, r) {
			if(d){
				if(d.status==1){
					$.jBox.tip("发送成功，请去邮箱查收",'success');
					$.jBox.close(true);
				}else{
					$.jBox.tip("发送失败，请重试",'fail');
				}
			}
		}
	});

}

function getPassWord() {
	$.jBox("get:/member/common/getpassword/", {
		title: "找回密码",
		width: "auto",
		buttons: {'发送邮件':'jfun_dogetpass()','关闭': true }
	});   
}

</script>
<script type="text/javascript">
$(function(){
	
	$("#kinMaxShow").kinMaxShow({
			//设置焦点图高度(单位:像素) 必须设置 否则使用默认值 500
			height:330,
			//设置焦点图 按钮效果
			button:{
			    //设置按钮上面不显示数字索引(默认也是不显示索引)
                            showIndex:false,
			    //按钮常规下 样式设置 ，css写法，类似jQuery的 $('xxx').css({key:value,……})中css写法。            
			    //【友情提示：可以设置透明度哦 不用区分浏览器 统一为 opacity，CSS3属性也支持哦 如：设置按钮圆角、投影等，只不过IE8及以下不支持】            
				normal:{background:'#002e5e',marginRight:'0px',width:'41px',height:'13px',right:'44%',bottom:'20px',border:'1px solid #7e758b'},
				//当前焦点图按钮样式 设置，写法同上
				focus:{background:'url(Images/button.png) no-repeat 0 0',border:'1px solid #7e758b'}
			},
			//焦点图切换回调，每张图片淡入、淡出都会调用。并且传入2个参数(index,action)。index 当前图片索引 0为第一张图片，action 切入 或是 切出 值:fadeIn或fadeOut
			//函数内 this指向 当前图片容器对象 可用来操作里面元素。本例中的焦点图动画主要就是靠callback实现的。
			callback:function(index,action){
				switch(index){
					case 0 :
							if(action=='fadeIn'){
								$(this).find('.sub_1_1').animate({left:'70px'},600)
								$(this).find('.sub_1_2').animate({top:'60px'},600)
								
							}else{
								$(this).find('.sub_1_1').animate({left:'110px'},600)
								$(this).find('.sub_1_2').animate({top:'120px'},600)
								
							};
							break;
							
					case 1 :
							if(action=='fadeIn'){
								$(this).find('.sub_2_1').animate({left:'-100px'},600)
								$(this).find('.sub_2_2').animate({top:'60px'},600)
							}else{
								$(this).find('.sub_2_1').animate({left:'-160px'},600)	
								$(this).find('.sub_2_2').animate({top:'20px'},600)
							};
							break;
							
					case 2 :
							if(action=='fadeIn'){
								$(this).find('.sub_3_1').animate({right:'350px'},600)
								$(this).find('.sub_3_2').animate({left:'180px'},600)
							}else{
								$(this).find('.sub_3_1').animate({right:'180px'},600)	
								$(this).find('.sub_3_2').animate({left:'30px'},600)
							};
							break;	
				}
			}
		});
});

</script>
<div class="doc doc-711-234">
  <div class="body1">
    <div class="doc doc-711-234"> 
    
    
<script type="text/javascript">
function videoverify(){
	$.jBox.confirm("申请视频认证后会直接从帐户扣除认证费用0元，然后客服会联系您进行认证。<br/><font style='color:red'>确定要申请认证吗?</font>", "视频认证", dovideo, { buttons: { '确认申请': true, '暂不申请': false} });
}
function dovideo(v, h, f) {
	if (v == true){
        $.ajax({
            url: "/common/video",
            data: {},
            timeout: 5000,
            cache: false,
            type: "get",
            dataType: "json",
            success: function (d, s, r) {
              	if(d){
					if(d.status==1) $.jBox.tip(d.message, 'success');
					else $.jBox.tip(d.message, 'fail');

				}
            }
        });
	}
	return true;
};
// 自定义按钮
function faceverify(){
	$.jBox.confirm("<font style='color:red'>确定要申请现场认证吗?</font>", "现场认证", doface, { buttons: { '确认申请': true, '暂不申请': false} });
}
function doface(v, h, f) {
	if (v == true){
        $.ajax({
            url: "/common/face",
            data: {},
            timeout: 5000,
            cache: false,
            type: "get",
            dataType: "json",
            success: function (d, s, r) {
              	if(d){
					if(d.status==1) $.jBox.tip(d.message, 'success');
					else $.jBox.tip(d.message, 'fail');
				}
            }
        });
	}
	return true;
};
  $(function  () {
   	 var xiaowei_p= $("#xiaowei li");
   	 if(true)
   	 {
   	   xiaowei_p.parent().parent().css('background','url(Images/hover_bg.gif) no-repeat center right');


   	 }
   })

  
</script>
<script type=text/javascript><!--//--><![CDATA[//><!--
function menuFix() {
	var ele_ = document.getElementById("nav");
	if(!ele_) return;
var sfEls = ele_.getElementsByTagName("li");
for (var i=0; i<sfEls.length; i++) {
sfEls[i].onmouseover=function() {
this.className+=(this.className.length>0? " ": "") + "sfhover";
}
sfEls[i].onMouseDown=function() {
this.className+=(this.className.length>0? " ": "") + "sfhover";
}
sfEls[i].onMouseUp=function() {
this.className+=(this.className.length>0? " ": "") + "sfhover";
}
sfEls[i].onmouseout=function() {
this.className=this.className.replace(new RegExp("( ?|^)sfhover\\b"),
"");
}
}
}
window.onload=menuFix;
//--><!]]></script>
<style type="text/css">
.bar {
  margin:0 auto;
  width:800px; height:48px; overflow:hidden;
  line-height:48px; border:2px solid #EEE;}
.bar a.a_left,
.bar a.a_right{
  float:left;
  width:11px; height:48px;
  background:url(a_left.png) no-repeat left center;}
.bar a.a_right { float:right; background-image:url(a_right.png);}
.bar_wrap { float:left; position:relative; width:776px; height:48px; white-space:nowrap; overflow:hidden;}
.bar_inner { position:relative; height:48px; line-height:48px; left:0; width:2880px; white-space:nowrap;}
.bar_inner ul { height:48px; overflow:hidden; float:left; width:960px;}
.bar_inner ul li{ float:left;}
.bar_inner ul li a{ padding:0 16px; display:block; height:48px; line-height:48px;}





    #container{ 
  width:800px; 
  height: 130px; 

  border:3px solid blue; 
  overflow: hidden; 
  position: relative; 
} 
  
#container ul{ 
  list-style: none; 
  width:10000px; 
  position: absolute; 
} 
  
#container ul li{ 
  float:left; 
  margin-right: 20px; 
} 
</style>

</head>
<body style="border: #E7EAEC solid 1px;">

<!-- 头部开始 -->
     <?php if($UID > '0'): ?><div class="first_top" >
		<div class="dv_header top ">

<!--迷你导航-->

<div class="dw_bgx dw_mini">
<div class="Cmml00">
<?php
 $dws= session('u_user_name'); ?>
<!-- <div class="fl dw_Cbg zuo"> -->
<!-- <div class="fl" ><label style="color:#333333;font-weight:bold">投诉电话:</label><label style="color:#e44142; font-size:12px; font-weight:bold"><?php $dw_kefu=get_qq(2);echo($dw_kefu[0]["qq_num"]); ?></label></div> -->

<!-- </div> -->
<!-- <div class="fr" style="float:left; width:800px"> -->
<!-- <div class="fl " id="dw_qun"> -->
<!-- <ul id="erji" > -->
<!-- <li class=" dw_Cbg eq1"> -->
<!-- <a style="margin-top:5px; display:block; height:23px"> -->
<!-- <img src="/Style/ad_right/qqimg.png" width="19"  height="18" /> -->
<!-- </a> -->
<!-- <div class="eq201"> -->
        <!-- <?php $_result=get_qq(0);if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vq): $mod = ($i % 2 );++$i;?>-->
 <!-- <a class="icoTc" href="tencent://Message/?Uin=<?php echo ($vq["qq_num"]); ?>&amp;websiteName=<?php echo ($vq["qq_title"]); ?>&amp;Menu=ye"><img border="0" src="http://wpa.qq.com/pa?p=2:<?php echo ($vq["qq_num"]); ?>:52" alt="点击这里给我发消息" title="点击这里给我发消息"/>&nbsp;<?php echo (cnsubstr($vq["qq_title"],6,0,"utf-8",false)); ?></a> -->
        <!--<?php endforeach; endif; else: echo "" ;endif; ?> -->
<!-- </div> -->
<!-- </li> -->
<!--<li class=" dw_Cbg eq1">
<a style="margin-top:5px; display:block; height:23px">
<img src="/Style/ad_right/gfqq.png" width="19"  height="18" />
</a>
<div style="color:#E44142">
<?php $_result=get_qq(1);if(is_array($_result)): $key = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vq): $mod = ($key % 2 );++$key;?><p>官方<?php echo ($key); ?>群:&nbsp;<?php echo ($vq["qq_num"]); ?></p><?php endforeach; endif; else: echo "" ;endif; ?>
</div>
</li>-->
<!-- <li class=" dw_Cbg eq1"> -->
<!-- <a href="http://weibo.com/u/3702590540" style="margin-top:5px; display:block; height:23px"> -->
<!-- <img src="/Style/ad_right/qqr.png" width="19"  height="17"/> -->
<!-- </a> -->
<!-- </li> -->

<!-- <li class=" dw_Cbg eq1"> -->
<!-- <a style="margin-top:5px; display:block; height:23px"> -->
<!-- <img src="/Style/ad_right/qqw.png" width="19"  height="17"/> -->
<!-- </a> -->
<!-- <div> -->
<!-- <?php $_result=get_qq(1);if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vq): $mod = ($i % 2 );++$i;?>-->
<!-- <p></p> -->
  <!--<?php endforeach; endif; else: echo "" ;endif; ?> -->
<!-- </div> -->
<!-- </li> -->
<!-- </ul> -->
<!-- </div> -->
<a>&nbsp;</a> <a>&nbsp;</a>
<a style="color:#000;font-weight:bold;font-size:20px;">欢迎进入票据钱柜</a> 
<div class="fl" style="float:right">
<a class="fl"  href="__APP__/member/" style="color:#333333;font-weight:bold"><?php echo session('u_user_name');?></a><a href="__APP__/member/msg#fragment-1" class="fl" style="color:#333333;font-weight:bold">消息(<?php echo (($unread)?($unread):0); ?>)</a> 
<a href="__APP__/member/common/actlogout" class="fl" style="color:#333333;font-weight:bold">退出</a>
<!--<a href="/tools/tool2.html" class="fl" style="color:#333333;font-weight:bold">利息计算器</a>
<a href="http://old.xyjrp2p.com" target="_blank" class="fl" style="color:#333333;font-weight:bold">老系统入口</a>-->    
</div>

<div class="fl" > <div id="dw_kefu">  <div class="QQkefu"></div>   <div class="dw_show"></div></div></div>
</div>
</div>
</div>
<!--迷你导航结束-->	
		</div>
	</div>
	











            <?php else: ?>
                 <div class="first_top" >
		<div class="dv_header top ">

<!--迷你导航-->

<div class="dw_bgx dw_mini">
<div class="Cmml00">
<?php
 $dws= session('u_user_name'); ?>
<!-- <div class="fl dw_Cbg zuo"> -->
<!-- <div class="fl" ><label style="color:#333333;font-weight:bold">投诉电话:</label><label style="color:#e44142; font-size:12px; font-weight:bold"><?php $dw_kefu=get_qq(2);echo($dw_kefu[0]["qq_num"]); ?></label></div> -->

<!-- </div> -->
<!-- <div class="fr" style="float:left; width:800px"> -->
<!-- <div class="fl " id="dw_qun"> -->
<!-- <ul id="erji" > -->
<!-- <li class=" dw_Cbg eq1"> -->
<!-- <a style="margin-top:5px; display:block; height:23px"> -->
<!-- <img src="/Style/ad_right/qqimg.png" width="19"  height="18" /> -->
<!-- </a> -->
<!-- <div class="eq201"> -->
        <!-- <?php $_result=get_qq(0);if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vq): $mod = ($i % 2 );++$i;?>-->
 <!-- <a class="icoTc" href="tencent://Message/?Uin=<?php echo ($vq["qq_num"]); ?>&amp;websiteName=<?php echo ($vq["qq_title"]); ?>&amp;Menu=ye"><img border="0" src="http://wpa.qq.com/pa?p=2:<?php echo ($vq["qq_num"]); ?>:52" alt="点击这里给我发消息" title="点击这里给我发消息"/>&nbsp;<?php echo (cnsubstr($vq["qq_title"],6,0,"utf-8",false)); ?></a> -->
        <!--<?php endforeach; endif; else: echo "" ;endif; ?> -->
<!-- </div> -->
<!-- </li> -->
<!--<li class=" dw_Cbg eq1">
<a style="margin-top:5px; display:block; height:23px">
<img src="/Style/ad_right/gfqq.png" width="19"  height="18" />
</a>
<div style="color:#333333;font-weight:bold">
<?php $_result=get_qq(1);if(is_array($_result)): $key = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vq): $mod = ($key % 2 );++$key;?><p>官方<?php echo ($key); ?>群:&nbsp;<?php echo ($vq["qq_num"]); ?></p><?php endforeach; endif; else: echo "" ;endif; ?>
</div>
</li>-->
<!-- <li class=" dw_Cbg eq1"> -->
<!-- <a href="http://weibo.com/u/3702590540" style="margin-top:5px; display:block; height:23px"> -->
<!-- <img src="/Style/ad_right/qqr.png" width="19"  height="17"/> -->
<!-- </a> -->
<!-- </li> -->

<!-- <li class="dw_Cbg eq1"> -->
<!-- <a style="margin-top:5px; display:block; height:23px"> -->
<!-- <img src="/Style/ad_right/qqw.png" width="19"  height="17"/> -->
<!-- </a> -->
<!-- <div> -->
<!-- <?php $_result=get_qq(1);if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vq): $mod = ($i % 2 );++$i;?>-->
<!-- <p></p> -->
  <!--<?php endforeach; endif; else: echo "" ;endif; ?> -->
<!-- </div> -->
<!-- </li> -->
<!-- </ul> -->
<!-- </div> -->
<!-- <a>&nbsp;</a> <a>&nbsp;</a> -->
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a style="color:#000;font-weight:bold;font-size:18px;">欢迎加入票据钱柜</a> 
<div class="fl" style="float:right">
<a class="fl"  href="/member/common/login/" style="color:#333333;font-weight:bold">立即登录</a><a href="/member/common/register/" class="fl" style="color:#333333;font-weight:bold">免费注册</a> 
<!--<a href="/tools/tool2.html" class="fl" style="color:#333333;font-weight:bold">利息计算器</a>
<a href="http://old.xyjrp2p.com" target="_blank" class="fl" style="color:#333333;font-weight:bold">老系统入口</a>--> 
</div>

<div class="fl" > <div id="dw_kefu">  <div class="QQkefu"></div>   <div class="dw_show"></div></div></div>
</div>
</div>
</div>
<!--迷你导航结束-->	
		</div>
	</div><?php endif; ?>
    <script type="text/javascript">
  function  erji(a, b, c, d) {
        $(a).children(b).each(function() {
            var a1 = $(this).children(c),
             b2 = $(this).children(d),
             index=$(this).index();
            if (a1.html()) $(this).hover(function() {
                a1.show();
                
            index==0 && $(this).css({'background-position':'0px -62px'});
            index==1 && $(this).css({'background-position':'0px -124px'});
                b2.css({

                    'color':'#cfcfcf'
                });
            }, function() {
                a1.hide();
                 index==0 && $(this).css({'background-position':'0px -31px'});
            index==1 && $(this).css({'background-position':'0px -93px'});
                b2.css({

                    'color':'#b1b1b1'
                });
            });
        });
    }



erji('#erji','li','div','h1');
</script>

	
<div class="Nav">
			<div class="contain">
				<div class="N_logo"><a href="/"><?php echo get_ad(1);?></a></div>
				<div class="Nav_nav">
					<div class="menu" style="float:right;">
                         <ul class="navigation-list" id="dw_ul"  style="width:770px;" >
                               <?php $typelist = getTypeList(array('type_id'=>0,'limit'=>9)); foreach($typelist as $vtype=> $va){ ?>
                            <li class="navigation-item "> 
                            <a href="<?php echo ($va["turl"]); ?>" class="navigation-item-name"><?php echo ($va["type_name"]); ?>
                            <?php $sontypelist = getTypeList(array('type_id'=>$va['id'],'limit'=>8,'notself'=>true)); if($sontypelist != null){ ?>
                            <span class="ym"></span>
                            <?php } ?>
                            </a>
                              <div class="navigation-list-two-con" id="dw_ul2">
                                <div class="navigation-list-two">
                                    <?php $sontypelist = getTypeList(array('type_id'=>$va['id'],'limit'=>8,'notself'=>true)); if($sontypelist != null){ ?>
                                     <span class="loanImg nav-sanjiao"></span>
                                    <?php } ?>
                                  <ul class="navigation-two-list" id="erji_nav">
                                  <?php $sontypelist = getTypeList(array('type_id'=>$va['id'],'limit'=>8,'notself'=>true)); foreach($sontypelist as $sonvtype){ ?>
                                    <li><a href="<?php echo ($sonvtype["turl"]); ?>"  ><?php echo ($sonvtype["type_name"]); ?></a></li>
                                   <?php } ?> 
                                  </ul>
                                </div>
                              </div>
                            </li>
                            <?php } ?>    
                        </ul>
				 </div>
			</div>      
		  <script language="javascript">
                   $(document).ready(function(){				
					$("#ui-nav-item-link").mouseover(function(){
						$("#ui-nav-dropdown").show()
						}).mouseout(function(){
							$("#ui-nav-dropdown").hide()
							});
						$(".ui-nav-dropdown-item").mouseover(function(){
							$(this).css({"background":"#027BC0"}).mouseout(function(){
								$(this).css({"background":"#fff"})
															});

							})
						
					  })
                     </script>
  </div>
</div>	
		<!--byking-->
      <div class="ibannerbox" >
        <div id="kinMaxShow">
       <?php $_result=get_ad(4);if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$va): $mod = ($i % 2 );++$i;?><div> <a href="<?php echo ($va["url"]); ?>"><img src="__ROOT__/<?php echo ($va["img"]); ?>" /></a> </div><?php endforeach; endif; else: echo "" ;endif; ?>    
     </div>
</div>
	    <link rel="stylesheet" type="text/css" href="Style/ad_right/css/index.css" />
	  <div class="bannerRight">
            <div class="inner">
                <div class="title">
                    <h3>
                        &nbsp;
                    </h3>
                    <p>
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong xid="0" style="color:#e44142">票据钱柜欢迎您</strong>
                    </p>
                </div>
                <div class="content" style="height:40px">
                   
                    <p style="font-size:16px">
                      <label style="color:#fc8026;font-size:18px"></label><label style="color:#fc8026;font-size:18px"></label>
                    </p>
                </div>
				<?php if($UID > '0'): ?><li><span><a href="/Member" target="_blank" class="primary" style="font-weight:bold; font-size:18px;color:#0099ff;float:left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;欢迎<?php echo session('u_user_name');?></a></span>--<span><a href="/Member/common/actlogout" class="primary" title="退出" style="font-weight:bold; font-size:18px;color:#0099ff" >退出</a></span></li>
       <?php else: ?>
	   <li class=li3><a href="member/common/login/" class="bannerA pos1">立即登录</a></li>
            <li class=li3><a href="member/common/register/" class="bannerA pos1" style="background:#28a1f0">免费注册</a></li><?php endif; ?>
	   </div>
	  </div>
    </div>
	<div style="width:1002px; margin:5px auto 10px;padding-bottom:10px;">
  <div style="color:#c11616; height:40px; line-height:40px; border-bottom:1px;width:990px;">
	 <div class="Cxiao_title" style="height:35px; line-height:35px; background:#f7f7f7; margin-left:0px;font-size: 16px;color: #e44142; font-weight:bold;width:990px;">
			<label style="display:block; float:left; text-align:center"><img src="/Style/ad_right/gg.png" width="20" height="20" /></label><span style="color:#000;font-weight:bold">最新公告</span>
			<?php $xlist = getArticleList(array("type_id"=>9,"pagesize"=>1)); foreach($xlist['list'] as $kx => $va){ ?>
            <a href="<?php echo ($va["arturl"]); ?>" title="<?php echo (cnsubstr($va["title"],10)); ?>" >&nbsp;<?php echo (cnsubstr($va["title"],10)); ?>[<?php echo (date("Y-m-d",$va["art_time"])); ?>]</a>
            <?php };$xlist=NULL; ?>
            <a href="/gonggao/index.html" class="genduo" style=" float:right;color:#000; font-size:14px; margin-right:10px;">查看更多>></a>
		</div>
  
  
  </div>

	
	
  
	<script type="text/javascript" src="/Style/index2/Scripts/jquery-1.8.2-min.js"></script>
    <script type="text/javascript" src="/Style/index2/Scripts/jquery-ui-1.9.0.custom.min.js"></script>
    
    <script type="text/javascript">
        
        window.User = function(){
            return {
                "user_id": "",
                "user_name": "",
                "qn_score" :"",
                "real_name": "",
                "real_status": "",
                "email_status": "",
                "phone_status": "0",
                "con_id5_switch": "1"
                
                }
        }();
        
        var jsPathTxt = "https://itzstatic.b0.upaiyun.com/old";
    </script>
    <script type="text/javascript" src="/Style/index2/Scripts/utils-min.js" charset="utf-8"></script>
  <script type="text/javascript" src="/Style/index2/Scripts/page_index-min.js" charset="utf-8"></script>
<!--统计end-->


  <!-- <div style="width:648px; margin:5px 10px;border:#E7EAEC solid 1px; padding-bottom:10px; background:url(Images/kstdbg.gif) 297px 10px no-repeat; float:left"> -->
    <!-- <table width="648" border="0" cellspacing="0" cellpadding="0" > -->
      <!-- <tr> -->
        <!-- <td width="162" height="150" align="center" valign="middle"><a class="iico_1" href="__ROOT__/invest/index.html"></a></td> -->
        <!-- <td width="162" align="center" valign="middle"><a class="iico_2" href="__APP__/borrow/index.html"></a></td> -->
        <!-- <td width="162" align="center" valign="middle"><a class="iico_3" href="__APP__/bangzhu/safe.html"></a></td> -->
		<!-- <td width="162" align="center" valign="middle"><a class="iico_4" href="__APP__/bangzhu/contact.html"></a></td> -->
      <!-- </tr> -->
      <!-- <tr style="font-size:24px; color:#3C4145;"> -->
        <!-- <td height="50" align="center" valign="middle">我要投资</td> -->
        <!-- <td align="center" valign="middle">我要借款</td> -->
        <!-- <td align="center" valign="middle">安全保障</td> -->
		<!-- <td align="center" valign="middle">联系我们</td> -->
      <!-- </tr> -->
      <!-- <tr style="font-size:14px; color:#8D8B8B"> -->
        <!-- <td height="55" align="left" valign="middle"><p style=" text-align:center"> 真正低门槛投资50元即可起投<br/> -->
		 <!-- <br/> -->
          <!-- </p></td> -->
        <!-- <td align="left" valign="middle"><p style="text-align:center"> 风控严格把关24小时资金到账<br/> -->
           <!-- <br/> -->
            <!-- </p></td> -->
        <!-- <td align="left" valign="middle"><p style="text-align:center">四大安全优势<br/> -->
         <!-- <br/> -->
            <!-- </p></td> -->
            
           <!-- <td align="left" valign="middle"><p style="text-align:center"> 轻松注册成就财富梦想<br/> -->
          <!-- <br/> -->
            <!-- </p></td> -->
      <!-- </tr> -->
    <!-- </table> -->
  <!-- </div> -->
<div style="font-size:14px;font-weight:bold; padding-bottom:10px;height:172px;width:1018px;background-image:url(./Style/ad_right/74.PNG) ">
	<div style="float:left;width:250px;">
		<p style="font-size:15px; margin-top:13px; color:#000; height:150px; line-height:45px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;已有<br/>
		<span style="color:#FFD700;font-size:23px;font-weight:bold">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($members); ?></span><br/>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;名会员加入&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><br/>
	</div>
	<div style="float:left;width:250px;">	 
		<p style="font-size:15px; margin-top:10px; color:#000; height:150px; line-height:45px">&nbsp;累计成交总额达<br/>
		<span style="color:#FFD700;font-size:23px;font-weight:bold"><?php echo Fmoney($receive_capital);?></span><br/>
		&nbsp;元&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><br/>
	</div >
	<div style="float:left;width:250px;">	 
		<p style="font-size:15px; margin-top:10px; color:#000; height:150px; line-height:45px">&nbsp;累计为会员赚取<br/>
		<span style="color:#FFD700;font-size:23px;font-weight:bold"><?php echo Fmoney($receive_interest);?></span><br/>
		&nbsp;&nbsp;元&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><br/>
	</div>
	<div style="float:left;width:250px;font-size:35px;;line-height:170px;color:#000;">
		<a href="__ROOT__/invest/index.html">进入交易中心</a>
	</div>
	
</div>


  <div class="main">
    <div class="Cleft">
	<div style="float:left;border: #E7EAEC solid 1px;">
		<div style="width:988px; border: #E7EAEC solid 1px;height:40px; line-height:40px; padding-left:10px">
			<label style="margin-top:10px; display:block; float:left"><img src="/Style/ad_right/icon_ago.png" width="21" height="19"></label>
			<label style="color:#000; font-size:14px;font-weight:bold">&nbsp;&nbsp;&nbsp;企业借款列表</label>
			<a href="/invest/index.html" style=" float:right;color:#000; font-size:14px; margin-right:10px;">查看更多&nbsp;&gt;&gt; </a>
		</div>
        
         <?php if(is_array($listJBorrow["list"])): $i = 0; $__LIST__ = $listJBorrow["list"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vb): $mod = ($i % 2 );++$i;?><div class="Cbiao changecolor" style="float:left;margin-top:30px;margin-left:80px;margin-bottom:30px; height:200px; width:350px; border-radius: 10px;border: solid 1px rgba(102, 146, 191, 0.68);-moz-box-shadow:2px 2px 5px #333333;-webkit-box-shadow:2px 2px 5px #333333; box-shadow: 7px 7px 15px #285a63;">
        
      <div class="Cbiaobg" <?php if($vb["borrow_status"] == 6): else: ?> style="background:none"<?php endif; ?> > </div>
                                  
        <div class="fl left" >
          <?php if($vb["borrow_type"] == 7): ?><div style="float:left">
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="/Style/H/images/icon/lbt.gif"/>&nbsp;<?php echo getIco($vb);?><a href="<?php echo (getinvesturl($vb["id"])); ?>"title="<?php echo ($vb["borrow_name"]); ?>" class="BL_name" ><?php echo (cnsubstr($vb["borrow_name"],16)); ?></a>	
                </div>
                <div class="md Cjindu_bg">
                    <div class="Cjindu" style="width:<?php echo (intval($vb["dan_erdu"])); ?>%;"></div>
				</div>
               <?php echo (intval($vb["dan_erdu"])); ?>% (担保额度的进度)
               <div style="clear:both"></div>
                <?php else: ?>
                    <div >
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				  <img src="/Style/H/images/icon/lbt.gif"/>
				  &nbsp;<?php echo getIco($vb);?><a href="<?php echo (getinvesturl($vb["id"])); ?>"title="<?php echo ($vb["borrow_name"]); ?>" class="BL_name" ><?php echo (cnsubstr($vb["borrow_name"],16)); ?></a>	
                    </div><?php endif; ?>  
               
            <div class="vmid">

              <?php if($vb["borrow_status"] == 3): ?><a href="javascript:;" class="button anNiuYLB"></a>
              <?php elseif($vb["borrow_status"] == 4): ?>
              <a href="javascript:;" class="button anNiuDDFS"></a>
              <?php elseif($vb["borrow_status"] == 6): ?>
               <a href="javascript:;" class="button anNiuHKZ">
                </a>
              <?php elseif($vb["borrow_status"] > 6): ?>
              <a href="<?php echo (getinvesturl($vb["id"])); ?>" class="button anNiuYWC"></a>
              <?php else: ?>
               <?php if($vb["borrow_type"] == 7): if($vb["dan_erdu"] == 100): ?><a href="<?php echo (getinvesturl($vb["id"])); ?>" class="button anNiuTB"></a>
                   <?php else: ?>
                        <a href="<?php echo (getinvesturl($vb["id"])); ?>" class="button anNiuTB" style="background:url(/Style/index2/Images/toubiao_db.gif) no-repeat; margin-left:10PX"></a><?php endif; ?> 
                    
               <?php else: ?>
                      <a href="<?php echo (getinvesturl($vb["id"])); ?>" class="button anNiuTB"></a><?php endif; endif; ?> 
                <div class="md Cjindu_bg">
                        <div class="Cjindu" style="width:<?php echo (intval($vb["progress"])); ?>%;"></div>
                </div>
               <?php echo (intval($vb["progress"])); ?>%
               
             
            </div>
            <div class="vbottom">
                已投资金额 <span><?php echo ($vb["has_borrow"]); ?></span>元,<span><?php echo ($vb["need"]); ?></span>元可投,投标奖；<span><?php echo ($vb["reward_num"]); ?></span>%
            </div>
        </div>
        <div class="fl dwright1">借款金额:<?php echo (getmoneyformt($vb["borrow_money"])); ?>元<br/>
          年化收益:<span><?php echo ($vb["borrow_interest_rate"]); ?>%</span><br/>
		  借款期限:<?php echo ($vb["borrow_duration"]); ?>&nbsp;<?php if($vb['repayment_type'] == 1): ?>天<?php else: ?>个月<?php endif; ?></div>
        </div><?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
			
	<div style="float:left;border: #E7EAEC solid 1px;">
        <div style="width:988px; border: #E7EAEC solid 1px;height:40px; line-height:40px; padding-left:10px; margin-top:30px;">
			<label style="margin-top:10px; display:block; float:left"><img src="/Style/ad_right/ql.png" width="21" height="19"></label>
			<label style="color:#000; font-size:14px;font-weight:bold">&nbsp;&nbsp;&nbsp;普通借款列表</label>
			<a href="/invest/index.html" style=" float:right;color:#000; font-size:14px; margin-right:10px;">查看更多&nbsp;&gt;&gt; </a>
		</div>
        
         <?php if(is_array($listBorrow["list"])): $i = 0; $__LIST__ = $listBorrow["list"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vb): $mod = ($i % 2 );++$i;?><div class="Cbiao changecolor" style="float:left;margin-top:30px;margin-left:80px;margin-bottom:30px; height:200px; width:350px; border-radius: 10px;border: solid 1px rgba(102, 146, 191, 0.68);-moz-box-shadow:2px 2px 5px #333333;-webkit-box-shadow:2px 2px 5px #333333; box-shadow: 7px 7px 15px #285a63;">
        
			<div class="Cbiaobg"<?php if($vb["borrow_status"] == 6): else: ?> style="background:none"<?php endif; ?> > </div>
                                  
			<div class="fl left">
				<?php if($vb["borrow_type"] == 7): ?><div style="float:left">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo getIco($vb);?><a href="<?php echo (getinvesturl($vb["id"])); ?>"title="<?php echo ($vb["borrow_name"]); ?>" class="BL_name" ><?php echo (cnsubstr($vb["borrow_name"],12)); ?></a>	
                </div>
                  <div class="md Cjindu_bg">
                            <div class="Cjindu" style="width:<?php echo (intval($vb["dan_erdu"])); ?>%;"></div>
				</div>
				<?php echo (intval($vb["dan_erdu"])); ?>% (担保额度的进度)
				<div style="clear:both"></div><br/>
					<?php else: ?>
                <div >
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo getIco($vb);?><a href="<?php echo (getinvesturl($vb["id"])); ?>"title="<?php echo ($vb["borrow_name"]); ?>" class="BL_name" ><?php echo (cnsubstr($vb["borrow_name"],12)); ?></a>	
                </div><?php endif; ?>  
               
				<div class="vmid">

					<?php if($vb["borrow_status"] == 3): ?><a href="javascript:;" class="button anNiuYLB"></a>
					<?php elseif($vb["borrow_status"] == 4): ?>
					<a href="javascript:;" class="button anNiuDDFS"></a>
					<?php elseif($vb["borrow_status"] == 6): ?>
					<a href="javascript:;" class="button anNiuHKZ">
					</a>
					<?php elseif($vb["borrow_status"] > 6): ?>
					<a href="<?php echo (getinvesturl($vb["id"])); ?>" class="button anNiuYWC"></a>
					<?php else: ?>
					<?php if($vb["borrow_type"] == 7): if($vb["dan_erdu"] == 100): ?><a href="<?php echo (getinvesturl($vb["id"])); ?>" class="button anNiuTB"></a>
					<?php else: ?>
                        <a href="<?php echo (getinvesturl($vb["id"])); ?>" class="button anNiuTB" style="background:url(/Style/index2/Images/toubiao_db.gif) no-repeat; margin-left:10PX"></a><?php endif; ?> 
                    
					<?php else: ?>
                      <a href="<?php echo (getinvesturl($vb["id"])); ?>" class="button anNiuTB"></a><?php endif; endif; ?> 
                <div class="md Cjindu_bg">
                        <div class="Cjindu" style="width:<?php echo (intval($vb["progress"])); ?>%;"></div>
                </div>
               <?php echo (intval($vb["progress"])); ?>%
               
             
            </div>
            <div class="vbottom">
                已投资金额 <span><?php echo ($vb["has_borrow"]); ?></span>元,<span><?php echo ($vb["need"]); ?></span>元可投,投标奖：<span><?php echo ($vb["reward_num"]); ?></span>%
            </div>
        </div>
        <div class="fl dwright1">借款金额:<?php echo (getmoneyformt($vb["borrow_money"])); ?>元<br/>
          年化收益:<span><?php echo ($vb["borrow_interest_rate"]); ?>%</span><br/>借款期限:<?php echo ($vb["borrow_duration"]); ?>&nbsp;<?php if($vb['repayment_type'] == 1): ?>天<?php else: ?>个月<?php endif; ?></div>
        </div><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
	</div>
        
        
        
        <div class="Cright">
			<div class="Crongqi" style="width:300px; float:left;width:450px;margin-left:15px;">
			<div class="Cxiao_title" style="height:35px; line-height:35px; background:#f7f7f7; margin-left:0px;font-size: 16px;color: #e44142; font-weight:bold;width:450px;">
				<label style="display:block; float:left"><img src="/Style/ad_right/xw.png" width="20" height="30" /></label><span style="color:#000;font-weight:bold">行业新闻</span>
			</div>
					<div class="Cxiao_list">
				<?php $xlist = getArticleList(array("type_id"=>2,"pagesize"=>6)); foreach($xlist['list'] as $kx => $va){ ?>
				<a href="<?php echo ($va["arturl"]); ?>" title="<?php echo (cnsubstr($va["title"],10)); ?>" ><?php echo (cnsubstr($va["title"],10)); ?>[<?php echo (date("Y-m-d",$va["art_time"])); ?>]</a>
				<?php };$xlist=NULL; ?>
				<a href="/news/index.html" class="genduo" style=" float:right;color:#000; font-size:14px; margin-right:10px;">查看更多>></a></div>					 
			<div style="clear:both; height:0px; width:30px; _display:inline;">
			</div>		
        </div>
		</div>	
			
			&nbsp;
		
		<div class="Crongqi" style="width:300px; float:left;width:450px;margin-left:49px;margin-top:8px;">
		<div class="Cxiao_title" style="height:35px; line-height:35px; background:#f7f7f7; margin-top:5px;font-size: 16px;color: #e44142; font-weight:bold;width:440px;margin-top:5px;margin-left:5px;margin-right:5px;">
			<label style="display:block; float:left"><img src="/Style/ad_right/gg.png" width="20" height="20" /></label><span style="color:#e44142;font-weight:bold">最新公告</span>
		</div>
			<div class="Cxiao_list">
                <?php $xlist = getArticleList(array("type_id"=>9,"pagesize"=>7)); foreach($xlist['list'] as $kx => $va){ ?>
                <a href="<?php echo ($va["arturl"]); ?>" title="<?php echo (cnsubstr($va["title"],10)); ?>" >&nbsp;<?php echo (cnsubstr($va["title"],10)); ?>[<?php echo (date("Y-m-d",$va["art_time"])); ?>]</a>
                <?php };$xlist=NULL; ?>
                <a href="/gonggao/index.html" class="genduo" style=" float:right;color:#000 font-size:14px; margin-right:10px;">查看更多>></a>     </div>
				<div style="clear:both; height:0px; width:30px; _display:inline;">
			</div>
			
        </div>
  
  
  

	


  </div>
  
  <script type="text/javascript">
	$(function() {
		$(".changecolor").bind("mouseover", function(){
			$(this).css("background", "#f8f8f8");
			$(this).css("color", "#007EB9");
		})

		$(".changecolor").bind("mouseout", function(){
			$(this).css("background", "#fff");
			$(this).css("color", "#737272");
		})
	});

</script>
</div>
<script  type="text/javascript" src="/Style/index2/Scripts/backtotop.js"></script>
<script  type="text/javascript" src="/Style/index2/Scripts/index.js"></script>
<script type="text/javascript" src="/Style/index2/Scripts/common.js" language="javascript"></script>
<script type="text/javascript" src="/Style/index2/Scripts/jquery.kinmaxshow-1.0.min.js"></script>

  <script type="text/javascript">
	$(function() {
		$(".borrowlistl").bind("mouseover", function(){
			$(this).css("background", "#f8f8f8");
		})

		$(".borrowlistl").bind("mouseout", function(){
			$(this).css("background", "#fff");
		})

		$(".changecolor").bind("mouseover", function(){
			$(this).css("background", "#f8f8f8");
			$(this).css("color", "#007EB9");
		})

		$(".changecolor").bind("mouseout", function(){
			$(this).css("background", "#fff");
			$(this).css("color", "#737272");
		})
	});

</script>
</div>


<script>
function scroll(){
var scrollBar = function(){
  this.step = 14;
  this.speed = 100;
  this.inner = $(".bar_inner");
  this.wrap = $(".bar_wrap");
  this.ini = 0;
  this.pos = "l";
  this.s ;
  }
scrollBar.prototype = {
  check : function(){
    return this.inner.width() < this.wrap.width() ? false : true;
    } ,
  init : function(){
    if( this.check() ){
      this.inner
        .html( this.inner.html() + this.inner.html() + this.inner.html() )
        .css("left",- this.inner.width()/3 + "px");
      }
    },
  run : function(pos){
    if (! this.check()){ return;}
    if( this.ini == 0) {this.init();}
    this.ini = 1;
    this.pos = pos;
    var that = this;
    var f = function(){
      if(that.pos == "l"){
        var l = parseInt( that.inner.css("left") ) - that.step;
        that.inner.css("left",l + "px");
        //console.log(l);
        if ( parseInt(that.inner.css("left")) <= -( that.inner.width()/ 3 * 2) ){
          that.inner.css("left",- that.inner.width() /3 + "px");
          }
        }
      else {
        var l = parseInt( that.inner.css("left") ) + that.step;
        that.inner.css("left",l + "px");
        //console.log( l );
        if( parseInt(that.inner.css("left")) >= 0 ){
          that.inner.css("left", - that.inner.width()/3 + "px");
          }
        }
      }
    if(this.s) {clearInterval(that.s);};
    this.s = setInterval( f ,that.speed);
    that.inner.hover(
      function(){ clearInterval(that.s);},
      function(){clearInterval(that.s); that.s = setInterval( f ,that.speed); }
      )
    }
  }
var s = new scrollBar();
s.run("r");
$(".a_left").mouseover(function(){
  clearInterval( s.s);
  s.run("l");
  })
$(".a_right").mouseover(function(){
     clearInterval( s.s);
  s.run("r");
})
</script>


<div style="margin:0 auto; width:1002px; background:#fff; border:1px solid #cdcdcd; height:40px; line-height:40px">
  <img src="/Style/ad_right/hb.png" width="104" height="24" style="margin-top:7px" />
</div>
<!-- <div style="margin:0 auto; width:1002px; background:#fafafa; border:1px solid #cdcdcd; height:90px; border-top:none; line-height:90px"> -->
  <!-- <img src="/Style/ad_right/zhongguo.jpg" width="143" height="58" style="margin-top:15px; margin-left:25px;" /> -->
  <!-- <img src="/Style/ad_right/linshang.png" width="143" height="58" style="margin-top:15px; margin-left:25px;" /> -->
  <!-- <img src="/Style/ad_right/nongye.jpg" width="143" height="58" style="margin-top:15px; margin-left:25px;" /> -->
  <!-- <img src="/Style/ad_right/gongshang.jpg" width="143" height="58" style="margin-top:15px; margin-left:25px;" /> -->
  <!-- <img src="/Style/ad_right/hzwz001.gif" width="143" height="58" style="margin-top:15px; margin-left:25px;" /> -->
  <!-- <img src="/Style/ad_right/partners_3.png" width="115" height="58" style="margin-top:15px; margin-left:25px;" /> -->
  
<!-- </div> -->


<div id="container" class="content" style="margin:0 auto; width:1002px; background:#fafafa; border:1px solid #cdcdcd; height:90px; border-top:none; line-height:90px;list-style:none;padding:0;">
    <ul id="content" style="margin-top:10px;"> 
      <li><a href="#"><img src="/Style/ad_right/zhongguo.jpg" width="143" height="58"  /></a></li> 
      <li><a href="#"><img src="/Style/ad_right/linshang.png" width="143" height="58" /></a></li> 
      <li><a href="#"><img src="/Style/ad_right/nongye.jpg" width="143" height="58"/></a></li> 
      <li><a href="#"><img src="/Style/ad_right/gongshang.jpg" width="143" height="58"/></a></li> 
      <li><a href="#"><img src="/Style/ad_right/hzwz001.gif" width="143" height="58"/></a></li> 
      <li><a href="#"><img src="/Style/ad_right/partners_3.png" width="115" height="58"/></a></li> 
    </ul> 
  </div> 
  

 
 
 

  
 

<script>

 window.onload = function(){ 
  
    /*计算一个segment的宽度*/
  
    var segmentWidth = 0; 
    $("#container #content li").each(function(){ 
      segmentWidth+= $(this).outerWidth(true); 
    }); 
  
    $("#container #content li").clone().appendTo($("#container #content")); 
  
    run(20000); 
  
    function run(interval){ 
      $("#container #content").animate({"left":-segmentWidth}, interval,"linear",function(){ 
        $("#container #content").css("left",0); 
        run(20000); 
      }); 
    } 
  
    $("#container").mouseenter(function(){ 
      $("#container #content").stop(); 
    }).mouseleave(function(){ 
      var passedCourse = -parseInt($("#container #content").css("left")); 
      var time = 20000 * (1- passedCourse/segmentWidth); 
      run(time); 
    }); 
  }; 

</script>




	
	
	
		
	
  </div>
</div>
<style>


#footer{margin-top: 30px;}
.footleft{float:left;}
.footright{float:right;width:290px;position: relative;}
.footright #wechat{width:120px;height: 130px;position: absolute;top:-134px;left:26px;z-index:999;display: none;}
.footbg{background: #333;color: #fff;padding: 10px 0px;height: 102px;}
.ftlink{padding-bottom: 10px;}
.ftlink a{line-height: 38px;font-size: 14px;padding: 0px 15px;color: #fff;}
.ftlink a:hover{color: #E44142;}
.ftimg a{display:block;float:left;margin: 10px 15px;}
#footer .cp{ text-align: center;line-height:30px;padding: 5px 0;color: #666;}
.ftcare{font-size: 14px;color: #fff;line-height: 40px;overflow: hidden;width: 210px;}
.ftcare span{float: left;padding-right: 10px;}
.ftcare a{float:left;display:block;width:30px;height: 30px;margin-top: 5px;transition:0.4s ease;-webkit-transition:0.4s ease;-o-transition:0.4s ease;-moz-transition:0.4s ease;}
.ftcare a.wx{background: url(/Style/ad_right/icon_wx1.png) no-repeat;}
.ftcare a.wx:hover{background: url(/Style/ad_right/icon_wx3.png) no-repeat;}
.ftcare a.wb{background: url(/Style/ad_right/icon_wb1.png) no-repeat;}
.ftcare a.wb:hover{background: url(/Style/ad_right/icon_wb3.png) no-repeat;}
.ftcare a.tx{background: url(/Style/ad_right/icon_tx1.png) no-repeat;}
.ftcare a.tx:hover{background: url(/Style/ad_right/icon_tx3.png) no-repeat;}
.ftcare a{display:block;float:left;margin: 0px 8px;padding-top: 5px;}
.footright h2{font-size: 24px;font-weight:normal;line-height: 30px;display:inline;}
.footright p{line-height: 20px;font-size: 14px;}


</style>

<div style="clear:both; height:0px; width:300px; _display:inline;"></div>
<div class="footer" style="display:none">
  <div class="footer_con">
    <div class="footer_p"><?php echo get_ad(8);?></div>
        <div class="footer_ul footer_gy">
            <h2>关于我们</h2>
            <ul>
                <li><a href="__ROOT__/aboutus/jianjie.html">公司简介</a></li>
                <li><a href="__ROOT__/aboutus/zizhi.html">公司证件</a></li>
                <li><a href="__ROOT__/aboutus/zfsm.html">资费说明</a></li>
                <li><a href="__ROOT__/aboutus/zcfgd.html">政策法规</a></li>	
            </ul>
        </div>
        <div class="footer_ul footer_gy">
            <h2>网贷工具</h2>
            <ul>
                <li><a href="__ROOT__/tools/tool2.html">计算工具</a></li>
                <li><a href="__ROOT__/tuiguang/index.html">推广系统</a></li>
                <li><a href="__ROOT__/member/auto/index.html">自动投标</a></li>
                <li><a href="__ROOT__/member/capital#fragment-2">资金明细</a></li>	
            </ul>
        </div>
    <div class="footer_ul footer_help">
      <h2>帮助信息</h2>
      <ul>
        <li><a href="__ROOT__/bangzhu/index.html">帮助中心</a></li>
        <li><a href="__ROOT__/bangzhu/touzi.html">赎回投资</a></li>
        <li><a href="__ROOT__/bangzhu/new.html">新手指引</a></li>
        <li><a href="__ROOT__/bangzhu/safe.html">安全保障</a></li>
      </ul>
    </div>
    <div class="footer_p footer_last"><?php echo get_ad(9);?></div>
  </div>
  <div class="last_last">
    <?php echo ($glo["bottom"]); ?> 技术支持：<a href="http://www.lvmaque.com/" target="_blank">绿麻雀网贷系统</a>
  </div>
</div>



    <link href="Style/ad_right/gftv3-index.css" rel="stylesheet">
<div id="footer" style="background:#333" >
    <div style="width:980px; margin:0 auto">  	
        <div class="footbg">
          <div class="w1000">
            <div class="footleft">
              <div class="ftlink">
                <a href="/bangzhu/about.html">关于我们</a>
                <a href="/invest/index.html">交易大厅</a>
                <a href="/borrow/index.html">发布票源</a>
                <a href="/bangzhu/safe.html">安全保障</a>
                <!--<a href="/bangzhu/index.html">帮助中心</a>-->
              </div>
              <div class="ftimg">
                <!--<a href="https://ss.knet.cn/verifyseal.dll?sn=e140617371300500303in3000000&comefrom=trust&trustKey=dn&trustValue=www.xyjrp2p.com"><img src="/Style/ad_right/picon_kxwz.png"></a>
                <a href=""><img src="/Style/ad_right/ficon_pjzs.png"></a>
                <a href="" target="_blank"><img src="/Style/ad_right/picon_hyyz.png"></a>
                <a rel="nofollow" href="" target="_blank"><img src="/Style/ad_right/picon_360wz.png"></a>-->
              </div>
            </div>
            <div class="footright">
              <div class="ftcare">
                <!--<span>关注我们</span>
                <a href="" class="wx"></a>
                <a rel="nofollow" href="" target="_blank" class="wb"></a>
                <a rel="nofollow" href="" target="_blank" class="tx"></a>-->
              </div>
              <h2>电话号码</h2>
              <p>周一至周五8：00-17：00（法定节假日除外）</p>
              <div id="wechat"><img src="/Style/ad_right/wechat.png"></div>
            </div>
          </div>
        </div>
  </div>
</div>
                <!-- 友情链接开始 -->
      	<div class="mlinks w1000" style="width:980px; margin:0 auto; padding-top:10px;">
  
          <div style="background:#fafafa; border:1px solid #cdcdcd;height:40px; color:#666666; font-size:14px; line-height:40px; border-left:none; border-right:none ">
          	&nbsp;友情链接：&nbsp;&nbsp;
            <?php $_result=get_home_friend(1,1);if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vf): $mod = ($i % 2 );++$i;?><a target="_blank" href="<?php echo ($vf["link_href"]); ?>"><?php echo ($vf["link_txt"]); ?>&nbsp;&nbsp;&nbsp;</a><?php endforeach; endif; else: echo "" ;endif; ?>
                 
          </div>
      	</div>
      	<!-- 友情链接结束 -->
      	        <div class="cp" style="text-align:center; height:40px; margin-top:10px"><span class="last_last"><?php echo ($glo["bottom"]); ?></span></div>
      </div>
      
       </div>















</body></html>
<script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1000293920'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s23.cnzz.com/z_stat.php%3Fid%3D1000293920%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));</script>