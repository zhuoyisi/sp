<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
<meta name="keywords" content="<?php echo ($glo["web_keywords"]); ?>" />
<meta name="description" content="<?php echo ($glo["web_descript"]); ?>" />

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
		
<link rel="stylesheet" href="__ROOT__/Style/H/css/borrowreset.css" />
<link rel="stylesheet" href="__ROOT__/Style/H/css/borrowstyle.css" />
<!--中部开始-->
<div class="list_main">
    <div class="list_account">
        <div class="bb_list_banner">
            <div class="main_list">
                <ul>
                    <li><img src="__ROOT__/Style/H/images/icon02.jpg" />&nbsp;&nbsp;&nbsp;<a id='colr' href="#">1、发布票源申请</a></li>
                    <li id='padtop'><img src="__ROOT__/Style/H/images/sanjiao.jpg" /></li>
                    <li><img src="__ROOT__/Style/H/images/icon_03.jpg" />&nbsp;&nbsp;&nbsp;<a href="#">2、网站严谨审核</a></li>
                    <li id='padtop'><img src="__ROOT__/Style/H/images/sanjiao.jpg" /></li>
                    <li><img src="__ROOT__/Style/H/images/icon_04.jpg" />&nbsp;&nbsp;&nbsp;<a href="#">3、网友查看票源</a></li>
                </ul>
            </div>
            <div class="content">
                <div class="c_left">
                    <ul>
                        <!--<li class="current" onmouseover=javascript:qiehuan1(0) id=ynav0>发布信用标</li>-->
                        <li class="current" onmouseover=javascript:qiehuan1(1) id=ynav1>发布票源</li>
                        <!--<li onmouseover=javascript:qiehuan1(2) id=ynav2>发布秒还标</li>
                        <li onmouseover=javascript:qiehuan1(3) id=ynav3>发布净值标</li>
                        <li onmouseover=javascript:qiehuan1(2) id=ynav2>发布抵押标</li>
                        <li onmouseover=javascript:qiehuan1(3) id=ynav3>企业借款</li>-->
                    </ul>
                    <img src="__ROOT__/Style/H/images/line.jpg" />
                </div>
                <!--<div class="c_right" id="qh_conn0" style="display:block;">
                    <p><span><a href="__ROOT__/borrow/post/normal.html">发布借款</a></span>信用标介绍<a href="__ROOT__/tools/tool2.html">【借款计算器】</a></p>
                    <h4>额度</h4>
                    <p class="intro">可使用额度：<?php echo (fmoney($minfo["credit_limit"])); ?>&nbsp;&nbsp;&nbsp;&nbsp;总额度：<?php echo (fmoney($minfo["credit_cuse"])); ?>&nbsp;&nbsp;&nbsp;&nbsp; 已使用额度：<?php echo Fmoney($minfo['credit_cuse']-$minfo['credit_limit']);?>&nbsp;&nbsp;&nbsp;&nbsp;额度状态：<?php if($minfo["credit_cuse"] > 0): ?>正常<?php else: ?>额度不足<?php endif; ?></p>
                    <h4>详情说明</h4>
                    <p class="intro">
                        信用借款标显示"信"字标记，是一种免抵押、免担保、纯信用的小额个人信用贷款标，主要面向固定收入群体开放。<br />
                        <b>信用标借贷流程</b>：<br />
                        借贷者提交申请->通过工作人员审核授予信用额度并初审->投资者开始投标->满标进入复审->通过复审的标打款给借贷者->按约定支付利息、本金->还款完成
                  </p>
                    <h4>申请条件</h4>
                    <ul>
                        <li>18-55岁中国公民</li>
                        <li>月入3000元以上</li>
                    </ul>
                </div>-->
                <div class="c_right" id="qh_conn1" style="display:block;">
                    <p><span><a href="__ROOT__/borrow/post/vouch.html">发布票源</a></span>票据交易介绍<a href="__ROOT__/tools/tool2.html">【借款计算器】</a></p>
                    <h4>额度</h4>
                    <p class="intro">
                        可使用额度：50万&nbsp;&nbsp;&nbsp;&nbsp;总额度：50万&nbsp;&nbsp;&nbsp;&nbsp;已使用额度：0&nbsp;&nbsp;&nbsp;&nbsp;额度状态：正常
                    </p>
                    <h4>详情说明</h4>
                    <p class="intro"> 机构担保借款标显示标记"担"，是有担保机构进行担保的借款，担保人和借款人之间协商并签订抵押担保手续，确保风险控制在合理的范围内。借款者可以提供担保公司或者由我们网站合作担保公司进行担保必须在我们网站工作人员在场签定好担保合同。由于有第三方担保公司进行担保相对来说此类标安全系数高。 </p>
                    <h4>申请条件</h4>
                    <ul>
                        <li>有担保机构为其进行担保</li>
                    </ul>
                </div>
                <!--<div class="c_right" id="qh_conn2" style="display:none;">
                    <p><span><a href="__ROOT__/borrow/post/second.html">发布借款</a></span>秒还标介绍<a href="__ROOT__/tools/tool2.html">【借款计算器】</a></p>
                    <h4>额度</h4>
                    <p class="intro">可使用额度：50万&nbsp;&nbsp;&nbsp;&nbsp;总额度：50万&nbsp;&nbsp;&nbsp;&nbsp;已使用额度：0&nbsp;&nbsp;&nbsp;&nbsp;额度状态：正常</p>
                    <h4>详情说明</h4>
                    <p class="intro"> 秒还标显示标记"秒"，借款者发布秒还标，利息和管理费将被冻结，投标满后，系统自动审核通过，发标人瞬间送出利息和管理费，投资者则收回本金和利息。</p>
                    <h4>申请条件</h4>
                    <ul>
                        <li>在网站有过投资记录并且</li>
                        <li>账户金额能够支付发这次秒标的手续费以及利息</li>
                    </ul>
                </div>
                <div class="c_right" id="qh_conn3" style="display:none;">
                    <p><span><a href="__ROOT__/borrow/post/net.html">发布借款</a></span>净值标介绍<a href="__ROOT__/tools/tool2.html">【借款计算器】</a></p>
                    <h4>额度</h4>
                    <p class="intro">可使用额度：<?php echo (($netMoney)?($netMoney):"0.00"); ?></php>&nbsp;&nbsp;&nbsp;&nbsp;总额度：<?php echo (($allnetMoney)?($allnetMoney):"0.00"); ?>&nbsp;&nbsp;&nbsp;&nbsp;已使用额度：<?php echo Fmoney($allnetMoney-$netMoney);?>&nbsp;&nbsp;&nbsp;&nbsp;额度状态：<?php if($netMoney > 0): ?>正常<?php else: ?>额度不足<?php endif; ?></p>
                    <h4>详情说明</h4>
                    <p class="intro">
                        净值标显示标记"债"，如果客户净资产大于借款金额，网站运营方允许发布净值标用于临时周转。这是一种安全系数相对较高的借款标，因此利率方面可能比较低。投资多少钱便有多少转让额度！ 计算公式：投资待收总额-债权转让标待还的总额=转让额度。                    </p>
                    <h4>申请条件</h4>
                    <ul>
                        <li>本网站的投资者</li>
                        <li>在本网站拥有一定债权，以站内债权为抵押</li>
                    </ul>
                    
                </div>
                <div class="c_right" id="qh_conn2" style="display:none;">
                    <p><span><a href="__ROOT__/borrow/post/mortgage.html">发布借款</a></span>抵押标介绍<a href="__ROOT__/tools/tool2.html">【借款计算器】</a></p>
                    <h4>额度</h4>
                    <p class="intro">可使用额度：50万&nbsp;&nbsp;总额度：50万&nbsp;&nbsp; 已使用额度：0&nbsp;&nbsp;额度状态：正常</p>
                    <h4>详情说明</h4>
                    <p class="intro"> 抵押借款标显示标记"抵"，是网站运营方经过线下严格核查借款人资产负债，抵押手续（不仅限）、有关政府以及商业银行推荐、优质资产和股权质押，确保风险控制在合理的范围内。抵押标借款者对象一般为地区优质中小微企业，是网站运营方重点发展对象。</p>
                    <h4>申请条件</h4>
                    <ul>
                        <li>有关政府以及商业银行推荐、优质资产和股权,</li>
                        <li>一般为地区优质中小微企业、并且办理相关抵押手续</li>
                    </ul>
                </div>
                <div class="c_right" id="qh_conn3" style="display:none;">
                    <p><span><a href="__ROOT__/Feedback/jk.html">企业申请</a></span>企业标介绍<a href="__ROOT__/tools/tool2.html">【借款计算器】</a></p>
                    <h4>详情说明</h4>
                    <p class="intro"> 企业借贷模式是在网络借贷的基础上创新的一种新型模式更加稳定，更加低风险的一种投资方式。借款人则以企业为主，企业信息及企业运营相对固定，有稳定的现金流及还款来源，信息容易核实，同时企业的违约成本远高于个人。</p>
                    <h4>申请条件</h4>
                    <ul>
                        <li>优质的企业和机构</li>
                    </ul>
                    <h4>所需材料</h4>
                    <ul>
                        <li>债权合同手续 相关抵押物</li>
                    </ul>
                </div>-->
            </div>
        </div>
    </div>
</div>
<script language=javascript>
    function qiehuan1(num) {
        for (var id = 1; id <= 1; id++) {
            if (id == num) {
                document.getElementById("qh_conn" + id).style.display = "block";
                document.getElementById("ynav" + id).className = "current";
            }
            else {
                document.getElementById("qh_conn" + id).style.display = "none";
                document.getElementById("ynav" + id).className = "";
            }
        }
    }
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