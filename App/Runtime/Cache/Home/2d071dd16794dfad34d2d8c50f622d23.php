<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta property="qc:admins" content="44007607264651155636" />
<meta http-equiv="X-UA-Compatible" content="IE=8" />
<link href="favicon.ico" type="image/x-icon"/>
<link rel="stylesheet" type="text/css" href="__ROOT__/Style/H/css/index.css" />
<link rel="stylesheet" type="text/css" href="__ROOT__/Style/H/css/css.css" />
<link rel="stylesheet" type="text/css" href="__ROOT__/Style/H/css/kefu.css" />
<link type="text/css" rel="stylesheet" href="__ROOT__/Style/JBox/Skins/Currently/jbox.css"/>
<link rel="stylesheet" type="text/css" href="__ROOT__/Style/H/css/style.css" />
<script type="text/javascript" src="__ROOT__/Style/H/js/jquery.min.js"></script>
<script type="text/javascript" src="__ROOT__/Style/Js/jquery.js"></script>
<script  src="__ROOT__/Style/JBox/jquery.jBox.min.js" type="text/javascript"></script>
<script  src="__ROOT__/Style/JBox/jquery.jBoxConfig.js" type="text/javascript"></script>
<script type="text/javascript" src="__ROOT__/Style/Js/utils.js"></script>
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
<script type="text/javascript" src="__ROOT__/Style/H/js/common.js" language="javascript"></script>
<script type="text/javascript">
var Transfer_invest_url = "__APP__/tinvest";
</script>
<script type="text/javascript" src="__ROOT__/Style/H/js/area.js"></script>

<script type="text/javascript">
function videoverify(){
	$.jBox.confirm("申请视频认证后会直接从帐户扣除认证费用<?php echo (($glo["fee_video"])?($glo["fee_video"]):0); ?>元，然后客服会联系您进行认证。<br/><font style='color:red'>确定要申请认证吗?</font>", "视频认证", dovideo, { buttons: { '确认申请': true, '暂不申请': false} });
}
function dovideo(v, h, f) {
	if (v == true){
        $.ajax({
            url: "__APP__/common/video",
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
            url: "__APP__/common/face",
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
   	   xiaowei_p.parent().parent().css('background','url(__ROOT__/Style/H/images/hover_bg.gif) no-repeat center right');


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

<link rel="stylesheet" type="text/css" href="__ROOT__/Style/H/css/home.css" />

</head>
<body>

<!--头部开始-->
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
					<div class="menu">

 <ul class="navigation-list" id="dw_ul"  style="width:850px;" >
 
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
          <?php if($UID > '0'): ?><!--快捷通道-->
            <div class="grid_3 ui-header-grid">
                    <ul class="ui-nav fn-right  " style="display:none">
                      
                      <li id="ui-nav-item-link"  class="ui-nav-item ui-nav-item-x" >
                        <a  class="ui-nav-item-link rrd-dimgray ui-nav-username fn-text-overflow" href="__APP__/member/" >
                            <?php
 $dws= session('u_user_name'); ?>
                          <span id="jieduan">您好，<?php echo (cnsubstr($dws,10)); ?></span>
                          <span class="arrow-down"></span>
                        </a>
                        <ul class="ui-nav-dropdown" id="ui-nav-dropdown" style="display: none;">
                          <li class="ui-nav-dropdown-angle"><span></span></li>
                          <li class="ui-nav-dropdown-item"><a class="rrd-dimgray" href="__APP__/member/charge#fragment-1">充值</a></li>
                          <li class="ui-nav-dropdown-item"><a class="rrd-dimgray" href="__APP__/member/withdraw#fragment-1">提现</a></li>
                          <li class="ui-nav-dropdown-separator"></li>
                          <li class="ui-nav-dropdown-item"><a class="rrd-dimgray" href="__APP__/member/capital#fragment-2">资金明细</a></li>
                          <li class="ui-nav-dropdown-item"><a class="rrd-dimgray" href="__APP__/member/charge#fragment-1">在线充值</a></li>
                          <li class="ui-nav-dropdown-separator"></li>
                          <li class="ui-nav-dropdown-item"><a class="rrd-dimgray" href="__APP__/member/common/actlogout">退出</a></li>
                        </ul>
                      </li>
					</ul>
                  </div>
              <!--快捷通道end--><?php endif; ?>      
                 
                  
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
//			var str=$("#jieduan").html();
//								  if(len(str)>6){
//									  str=
//									  }
                     </script>
      			</div>
		</div>	
		

<script type="text/javascript">
var url = window.location.href;
if(url)var allargs = url.split("?")[1];
if(allargs)var tab1= allargs.split("=")[1];
if(tab1)var tab= tab1.split("&")[0];

$(function(){ 
    if(tab==9){
        $('#a1').addClass("show_style");
    }
    if(tab==4){
        $('#a2').addClass("show_style");
        $('#a1').removeClass("show_style");
    }
    if(tab==6){
        $('#a3').addClass("show_style");
        $('#a1').removeClass("show_style");
    };
    if(tab==7){
        $('#a4').addClass("show_style");
        $('#a1').removeClass("show_style");
    };
    if(tab==10){
        $('#a5').addClass("show_style");
        $('#a1').removeClass("show_style");
        $('#black').attr('style','display:block');
        $('#con').attr('style','display:none');
    };
});

</script>
<div class="list_banner">
  <div class="list_banner_left">
    <div class="list_banner_left_l">
      <h2>筛选投资项目</h2>
      <ul>
        <li class="saixuanlx">标的状态</li>
        <?php foreach($searchMap['borrow_status'] as $key=>$v){ ?>
        <?php if($key==$searchUrl['borrow_status']['cur']){ ?>
        <li class="buxz"><a><?php echo ($v); ?></a></li>
        <?php }else{ ?>
        <li><a class="a_lb_2" href="__URL__/index.html?type=search&<?php echo ($searchUrl["borrow_status"]["url"]); ?>&borrow_status=<?php echo ($key); ?>"><?php echo ($v); ?></a></li>
        <?php } ?>
        <?php } ?>
      </ul>
      <ul class="dierge">
        <li  class="saixuanlx">信用等级</li>
        <?php foreach($searchMap['leve'] as $key=>$v){ ?>
        <?php if($key==$searchUrl['leve']['cur']){ ?>
        <li class="buxz"><a><?php echo ($v); ?></a></li>
        <?php }else{ ?>
        <li><a class="a_lb_2" href="__URL__/index.html?type=search&<?php echo ($searchUrl["leve"]["url"]); ?>&leve=<?php echo ($key); ?>"><?php echo ($v); ?></a></li>
        <?php } ?>
        <?php } ?>
      </ul>
      <ul>
        <li class="saixuanlx">借款期限</li>
        <?php foreach($searchMap['borrow_duration'] as $key=>$v){ ?>
        <?php if($key==$searchUrl['borrow_duration']['cur']){ ?>
        <li class="buxz"><a href="__ROOT__/invest/index.html"><?php echo ($v); ?></a></li>
        <?php }else{ ?>
        <li><a class="a_lb_2" href="__URL__/index.html?type=search&<?php echo ($searchUrl["borrow_duration"]["url"]); ?>&borrow_duration=<?php echo ($key); ?>"><?php echo ($v); ?></a></li>
        <?php } ?>
        <?php } ?>
      </ul>
      <ul style="border-bottom:none;">
        <form name="searchform" action="__URL__/index" method="get">
          <li  class="saixuanlx">关键词搜索:</li>
          <li style="width:250px;">
            <?php $i=0;$___KEY=array ( 0 => '不限制', 1 => '借款用户', 2 => '借款名称', ); foreach($___KEY as $k=>$v){ if(strlen("1key")==1 && $i==0){ ?><input type="radio" name="is_keyword" value="<?php echo ($k); ?>" id="is_keyword_<?php echo ($i); ?>" checked="checked" /><?php }elseif(("key1"=="key1"&&$vo["is_show"]==$k)||("key"=="value"&&$vo["is_show"]==$v)){ ?><input type="radio" name="is_keyword" value="<?php echo ($k); ?>" id="is_keyword_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="is_keyword" value="<?php echo ($k); ?>" id="is_keyword_<?php echo ($i); ?>" /><?php } ?><label for="is_keyword_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++; } ?>
          </li>
          <li>
            <input class="searchkeywords" name="searchkeywords" type="text"    value="<?php echo ($searchMap["searchkeywords"]); ?>" style="margin-top:6px;"/>
          </li>
          <li>
            <input type="submit" name="btnSubmit" id="btnSubmit" value=" " style="height:29px; margin-left:77px; cursor: pointer; margin-top:3px;" class="btn">
          </li>
        </form>
      </ul>
    </div>
  </div>
</div>
<div class="list_main main" style="border:">
  <div class="list_main_top">
    <div class="wleft">
      <h3 class="title_03">投资列表<a id="wpass" class="more" href="/tools/tool.html">利息计算器</a></h3>
    </div>
  </div>
  
  
  
  
    <?php if(is_array($list["list"])): $i = 0; $__LIST__ = $list["list"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vb): $mod = ($i % 2 );++$i;?><div style="float:left; margin-top:10px; width:290px;border:solid 5px #e4e4e4;margin-left:25px;margin-bottom:15px;border-radius: 10px;border: solid 1px rgba(102, 146, 191, 0.68);-moz-box-shadow:2px 2px 5px #333333;-webkit-box-shadow:2px 2px 5px #333333; box-shadow: 7px 7px 15px #285a63;">
		  <table>
          <tr height="50" class="borrowlistl">
          <td width="300">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php if($vb["is_transfer"] == 1): ?><img src="/Style/H/images/icon/lbt.gif"/>&nbsp;<?php else: endif; echo getIco($vb);?><a href="<?php echo (getinvesturl($vb["id"])); ?>"title="<?php echo ($vb["borrow_name"]); ?>" class="BL_name"><?php echo (cnsubstr($vb["borrow_name"],16)); ?></a>											          </td>

        </tr>
        <tr height="50" style="border-bottom:solid 1px #e4e4e4" class="borrowlistl">
          <td width="250">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-size:14px">借款金额：</label><label style="font-size:18px; color:#e44142">￥<?php echo (getmoneyformt($vb["borrow_money"])); ?>元</label></td>
		</tr>
		<tr height="50" style="border-bottom:solid 1px #e4e4e4" class="borrowlistl">
          <td width="250">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-size:14px">借款期限：</label><span class="BL_time" style="font-size:18px; color:#e44142"><?php echo ($vb["borrow_duration"]); ?>&nbsp;<?php if($vb['repayment_type'] == 1): ?>天<?php else: ?>个月<?php endif; ?></span></td>
		</tr>
		<tr height="50" style="border-bottom:solid 1px #e4e4e4" class="borrowlistl">
          <td width="250">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="BL_time"><label style="font-size:14px">年利率：</label><label style="font-size:18px; color:#e44142"><?php echo ($vb["borrow_interest_rate"]); ?>&nbsp;%</label></span></td>
		</tr>
		 <tr height="50" style="border-bottom:solid 1px #e4e4e4" class="borrowlistl">
          <td class="dengji"width="200"><span class="ui-list-field"> <span class="ui-progressbar-mid ui-progressbar-mid-<?php echo (intval($vb["progress"])); ?>"><em><?php echo (intval($vb["progress"])); ?>%</em></span> </span> 已投标<label style="font-size:16px; color:#e44142"><?php echo ($vb["borrow_times"]); ?></label>人次</td>
		</tr>
		<tr height="50" style="border-bottom:solid 1px #e4e4e4" class="borrowlistl">
          <td width="250">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php if($vb["borrow_status"] == 3): ?><a href="javascript:;"><img class="anNiuYLB" src="__ROOT__/Style/H/images/status/touM.gif" /></a>
              <?php elseif($vb["borrow_status"] == 4): ?>
              <a href="javascript:;"><img class="anNiuDDFS" src="__ROOT__/Style/H/images/status/touM.gif" /></a>
              <?php elseif($vb["borrow_status"] == 6): ?>
              <a href="javascript:;"><img  class="anNiuHKZ" src="__ROOT__/Style/H/images/status/touM.gif"  /></a>
              <?php elseif($vb["borrow_status"] > 6): ?>
              <a href="<?php echo (getinvesturl($vb["id"])); ?>"><img class="anNiuYWC" src="__ROOT__/Style/H/images/status/touM.gif"  /></a>
              <?php else: ?>
              <a href="<?php echo (getinvesturl($vb["id"])); ?>"><img class="anNiuTB" src="__ROOT__/Style/H/images/status/touM.gif" /></a><?php endif; ?>
          </td>
        </tr>
		</table>
	</div><?php endforeach; endif; else: echo "" ;endif; ?>


</div>
<div class="list_bottom">
  <div class="list_bottom_right">
    <ul>
      <?php echo ($list["page"]); ?>
    </ul>
  </div>
</div>
<script language="javascript">
		$(function() {
			$(".borrowlistp").bind("mouseover", function(){
				$(this).css("background", "#fce8e1");
			})

			$(".borrowlistp").bind("mouseout", function(){
				$(this).css("background", "#fff");
			})


			$(".borrowlistl").bind("mouseover", function(){
				$(this).css("background", "#f8f8f8");
			})

			$(".borrowlistl").bind("mouseout", function(){
				$(this).css("background", "#fff");
			})
		});

	</script>
<!--中部结束-->
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