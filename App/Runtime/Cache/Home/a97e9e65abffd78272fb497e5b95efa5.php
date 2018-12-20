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

<title>发表借款-<?php echo ($glo["index_title"]); ?></title>
<meta name="keywords" content="<?php echo ($glo["web_keywords"]); ?>" />
<meta name="description" content="<?php echo ($glo["web_descript"]); ?>" />
<script language="javascript" src="__ROOT__/Style/H/js/borrow.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="__ROOT__/Style/JQtip/tip-yellowsimple/tip-yellowsimple.css" />
<script language="javascript" src="__ROOT__/Style/JQtip/jquery.poshytip.js" type="text/javascript"></script>

<script type="text/javascript">
$(function(){
	$('.x_input').poshytip({
		className: 'tip-yellowsimple',
		showOn: 'hover',
		alignTo: 'target',
		alignX: 'center',
		alignY: 'top',
		offsetX: 0,
		offsetY: 5
	});
	$('.x_checkbox_c').poshytip({
		className: 'tip-yellowsimple',
		showOn: 'hover',
		alignTo: 'target',
		alignX: 'center',
		alignY: 'top',
		offsetX: 0,
		offsetY: 5
	});
	$('.x_checkbox').poshytip({
		className: 'tip-yellowsimple',
		showOn: 'hover',
		alignTo: 'target',
		alignX: 'right',
		alignY: 'center',
		offsetX: 10,
		offsetY: -25
	});
	$('.x_select').poshytip({
		className: 'tip-yellowsimple',
		showOn: 'hover',
		alignTo: 'target',
		alignX: 'right',
		alignY: 'center',
		offsetX: 10,
		offsetY: -25
	});
});



</script>

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
<!-- <!--<li class=" dw_Cbg eq1"> -->
<!-- <a style="margin-top:5px; display:block; height:23px"> -->
<!-- <img src="/Style/ad_right/gfqq.png" width="19"  height="18" /> -->
<!-- </a> -->
<!-- <div style="color:#E44142"> -->
<!-- <?php $_result=get_qq(1);if(is_array($_result)): $key = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vq): $mod = ($key % 2 );++$key;?>-->
<!-- <p>官方<?php echo ($key); ?>群:&nbsp;<?php echo ($vq["qq_num"]); ?></p> -->
  <!--<?php endforeach; endif; else: echo "" ;endif; ?> -->
<!-- </div> -->
<!-- </li>--> 
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
<!-- <a>&nbsp;</a> <a>&nbsp;</a> -->
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a style="color:#000;font-weight:bold;font-size:18px;">欢迎加入票据钱柜</a> 
<div class="fl" style="float:right">
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
		

<!--中部开始-->
<div class="wrap2"> <img src="__ROOT__/Style/H/images/sscw_bg1.jpg" complete="complete" style="width:980px" />
  <div class="title_cw">
    <div class="zi_bg1"> <span class="post01">发布借款标</span> </div>
  </div>
  <div class="title_vip_bg">
    <div class="borrowtip"> 您正在发布：<?php echo ($BORROW_TYPE[$borrow_type]); ?> </div>
    <form method="post" action="__URL__/save" onsubmit="return cksubmit();" name="postBorrow" id="postBorrow">
      <input type="hidden" name="vkey" value="<?php echo ($vkey); ?>" />
      <div class="borrow_block">
        <ul class="ax">
          <li class="mn_dk"> <span>借款信息</span> </li>
        </ul>
        <ul>
          <div class="axbody">
            <select name="_day_option" id="_day_option" style="display:none"  class="c_select"><option value="">--请选择--</option><?php foreach($borrow_day_time as $key=>$v){ if($_X[""]==$key && $_X[""]!=""){ ?><option value="<?php echo ($key); ?>" selected="selected"><?php echo ($v); ?></option><?php }else{ ?><option value="<?php echo ($key); ?>"><?php echo ($v); ?></option><?php }} ?></select>
            <select name="_month_option" id="_month_option" style="display:none"  class="c_select"><option value="">--请选择--</option><?php foreach($borrow_month_time as $key=>$v){ if($_X[""]==$key && $_X[""]!=""){ ?><option value="<?php echo ($key); ?>" selected="selected"><?php echo ($v); ?></option><?php }else{ ?><option value="<?php echo ($key); ?>"><?php echo ($v); ?></option><?php }} ?></select>
            <table class="borrowtable">
              <tr>
                <th class="col_1">借贷总金额：</th>
                <td class="col_2"><input onkeyup="NumberCheck(this)" type="text" class="x_input" name="borrow_money" title="借款金额不能小于50元，且必须是最小投资金额的整数倍。交易币种均为人民币。借款成功后,请按时还款 手续费请查看收费规则" /></td>
                <th class="col_3" id="_day_rate">年利率：</th>
                <td class="col_4"><input onkeyup="NumberFloatCheck(this)" type="text" class="x_input" name="borrow_interest_rate" title="填写您提供给投资者的年利率,所填写的利率是您还款的年利率。且只保留小数后最后两位。"/>
                  % (<span style="color:red">利率范围：<?php echo ($rate_lixt[0]); ?>%-<?php echo ($rate_lixt[1]); ?>%</span>) </td>
              </tr>
              <tr>
                <th class="col_1">借款用途：</th>
                <td class="col_2"><select name="borrow_use" id="borrow_use"  title="说明借款成功后的具体用途" class="c_select x_select"><option value="">--请选择--</option><?php foreach($borrow_use as $key=>$v){ if($_X[""]==$key && $_X[""]!=""){ ?><option value="<?php echo ($key); ?>" selected="selected"><?php echo ($v); ?></option><?php }else{ ?><option value="<?php echo ($key); ?>"><?php echo ($v); ?></option><?php }} ?></select></td>
                <th class="col_3">借款期限：</th>
                <td class="col_4"><?php if($miao == 'yes'): ?><span style="color:#F00">标满自动还款</span>
                    <?php else: ?>
                    <select name="borrow_duration" id="borrow_duration"  title="借款成功后,打算以几(天)个月的时间来还清贷款。"  onchange="test_duration()" class="c_select x_select"><option value="">--请选择--</option><?php foreach($borrow_month_time as $key=>$v){ if($_X[""]==$key && $_X[""]!=""){ ?><option value="<?php echo ($key); ?>" selected="selected"><?php echo ($v); ?></option><?php }else{ ?><option value="<?php echo ($key); ?>"><?php echo ($v); ?></option><?php }} ?></select>
                    <input type="checkbox" class="x_checkbox" name="is_day" id="is_day" style="margin-left:10px" value="yes" onclick="checkday()" title="" />
                    <label for="is_day">按天</label><?php endif; ?></td>
              </tr>
              <tr>
                <th class="col_1">最低投标金额：</th>
                <td class="col_2"><select name="borrow_min" id="borrow_min"  title="允许投资者对一个借款标的投标总额的限制" class="c_select x_select"><option value="">--请选择--</option><?php foreach($borrow_min as $key=>$v){ if($_X[""]==$key && $_X[""]!=""){ ?><option value="<?php echo ($key); ?>" selected="selected"><?php echo ($v); ?></option><?php }else{ ?><option value="<?php echo ($key); ?>"><?php echo ($v); ?></option><?php }} ?></select></td>
                <th class="col_3">最多投标总额：</th>
                <td class="col_4"><select name="borrow_max" id="borrow_max"  title="允许投资者对一个借款标的投标总额的限制" class="c_select x_select"><?php foreach($borrow_max as $key=>$v){ if($_X[""]==$key && $_X[""]!=""){ ?><option value="<?php echo ($key); ?>" selected="selected"><?php echo ($v); ?></option><?php }else{ ?><option value="<?php echo ($key); ?>"><?php echo ($v); ?></option><?php }} ?></select></td>
              </tr>
              <tr>
                <th class="col_1">有效时间：</th>
                <td class="col_2"><select name="borrow_time" id="borrow_time"  title="设置此次借款融资的天数。融资进度达到100%后直接进行网站的复审" class="c_select x_select"><option value="">--请选择--</option><?php foreach($borrow_time as $key=>$v){ if($_X[""]==$key && $_X[""]!=""){ ?><option value="<?php echo ($key); ?>" selected="selected"><?php echo ($v); ?></option><?php }else{ ?><option value="<?php echo ($key); ?>"><?php echo ($v); ?></option><?php }} ?></select></td>
                <th class="col_3">还款方式：</th>
                <td class="col_4"><?php if($miao == 'yes'): ?><span style="color:#F00">标满自动还款</span>
                    <?php else: ?>
                    <select name="repayment_type" id="repayment_type"  title="1.按天到期还款 是按天算利息，到期的那一天同时还本息。2.按月分期还款是指贷款者借款成功后，每月还本息。3.按季分期还款是指贷款者借款成功后,每月还息，季度还本。4.到期还本按月付息是指贷款者借款成功后,每月还息,最后一月还同时还本金。" onchange="test_duration()" class="c_select x_select"><option value="">--请选择--</option><?php foreach($repayment_type as $key=>$v){ if($_X[""]==$key && $_X[""]!=""){ ?><option value="<?php echo ($key); ?>" selected="selected"><?php echo ($v); ?></option><?php }else{ ?><option value="<?php echo ($key); ?>"><?php echo ($v); ?></option><?php }} ?></select><?php endif; ?></td>
              </tr>
              <tr>
                <th class="col_1">是否有投标奖励：</th>
                <td class="col_2"><input type="checkbox" class="x_checkbox" name="is_reward" id="is_reward" onclick="is_reward_do();" title="如果您设置了奖励金额，将会冻结您帐户中相应的账户余额。如果要设置奖励，请确保您的帐户有足够 的账户余额。"/></td>
                <th class="col_3">&nbsp; </th>
                <td class="col_4">&nbsp;
                  </if></td>
              </tr>
              <tr>
                <th class="col_1">是否有投标待收限制：</th>
                <td class="col_2"><input type="checkbox" class="x_checkbox" name="is_moneycollect" id="is_moneycollect" onclick="is_moneycollect_do();" title="如果您设置了投标待收金额限制，将会只允许满足待收金额限制要求的投资人投资。如果没有设置投标待收金额限制，则会员可进行自由投资。"/></td>
                <th class="col_3"></th>
                <td class="col_4">&nbsp;</td>
              </tr>
            </table>
          </div>
        </ul>
      </div>
      <div class="borrow_block" id="_is_reward" style="display:none">
        <ul class="ax">
          <li class="mn_dk"> <span>投标奖励</span> </li>
        </ul>
        <ul>
          <div class="axbody">
            <table class="borrowtable">
              <tr>
                <th class="col_1"><input type="radio" id="reward_type_1" class="x_radio" name="reward_type" value="1" />
                  <label for="reward_type_1">按投标金额比例奖励</label>
                  ：</th>
                <td class="col_2"><input type="text" class="x_input" name="reward_type_1_value" onclick="reward_type_do(1)" onkeyup="NumberFloatCheck(this)" title="范围：0.1%~6% ，这里设置本次标的要奖励给所有投标用户的奖励比例。" />
                  %</td>
                <th class="col_3">　　　　　 </th>
                <td class="col_4">　</td>
              </tr>
            </table>
          </div>
        </ul>
      </div>
      <div class="borrow_block" id="_is_moneycollect" style="display:none">
        <ul class="ax">
          <li class="mn_dk"> <span>投标待收金额限制</span> </li>
        </ul>
        <ul>
          <div class="axbody">
            <table class="borrowtable">
              <tr>
                <th class="col_1">待收金额设置：</th>
                <td class="col_2"><input id="moneycollect" onkeyup="NumberFloatCheck(this)" type="text" class="x_input" name="moneycollect" title="当您在该处设置了待收金额后，会员进行投标会需要满足自己账户的待收金额不小于该待收金额才能成功投标。" />
                  &nbsp;元 </td>
                <th class="col_3">&nbsp;</th>
                <td class="col_4">&nbsp;</td>
              </tr>
            </table>
          </div>
        </ul>
      </div>
      <!--标的详细说明-->
      <div class="borrow_block">
        <ul class="ax">
          <li class="mn_dk"> <span>借款的详细说明</span> </li>
        </ul>
        <ul>
          <div class="axbody">
            <table class="borrowtable">
              <tr>
                <th class="" style="border:none;">标题：</th>
                <td colspan="3"  style="border:none;"><input type="text" class="x_input" style="width:300px" name="borrow_name" title="填写借款的标题，写好一点能借的几率也大一点" />
                  是否定向标
                  <input type="checkbox" class="x_checkbox_c" name="is_pass" value="1" id="is_pass" title="定向标需要借款者设置密码，投标者知道密码才能投标"/>
                  <input type="text" style="width:300px; display:none" class="x_input_c" name="password" id="password" /></td>
              </tr>
              <tr>
                <th class="col_1" style="border:none;">借款说明：</th>
                <td colspan="3" style="border:none;"><textarea style="width:500px; height:200px; padding:10px" name="borrow_info" id="borrow_info"></textarea></td>
              </tr>
              <tr>
                <th class="col_1" style="border:none;">借款说明：</th>
                <td colspan="3" style="border:none;"><input class="tijiaojk" type="submit" name="sub" value="" /></td>
              </tr>
            </table>
          </div>
        </ul>
      </div>
      <!--标的详细说明-->
    </form>
  </div>
  <img src="__ROOT__/Style/H/images/sscw_bg3.jpg" complete="complete" style="width:980px" /> </div>
<!--中部结束-->
<script type="text/javascript">
<?php if($miao == 'yes'): ?>var miao = 'yes';<?php endif; ?>
$("#is_pass").click(function(e) {
    if($(this).attr('checked')){
		$("#password").show();
	}else{
		$("#password").hide();
	}
});
function setError(tip){
	$.jBox.tip(tip);
	return false;
}
function cksubmit(){
	var p=makevar(['borrow_money','borrow_interest_rate','borrow_use','borrow_duration','borrow_min','borrow_max','borrow_time','repayment_type','reward_type_1','reward_type_1_value','borrow_name','borrow_info','moneycollect']);

	if(p.borrow_money == "") 			return setError("借款金额不能为空！");
	if(p.borrow_money<50) 			return setError("借款金额不能小于50元！");
	if((p.borrow_min*2>p.borrow_max)&&(p.borrow_max>0)) 			return setError("最大投资金额不能小于最小投资金额的2倍！");
	if(p.borrow_money%p.borrow_min!=0) 	return setError("借款金额必须是最小投资金额的整数倍！");
	if(p.borrow_money>99999999) 		return setError("借款金额不能大于99999999元！");
	if(p.borrow_interest_rate == "") 	return setError("借款利率不能为空！");	
	if(p.borrow_use == "") 				return setError("借款用途不能为空！");
	if(p.borrow_duration == "" && typeof miao=="undefined") 		return setError("借款期限不能为空！");
	if(p.borrow_min == "") 				return setError("最小投资金额不能为空！");
	if(p.borrow_time == "") 			return setError("借款有效时间不能为空！");
	if(p.repayment_type == "" && typeof miao=="undefined") 			return setError("还款方式不能为空！");
	if(p.borrow_name == "") 			return setError("借款标题不能为空！");
	if(p.borrow_info == "") 			return setError("借款内容不能为空！");

	return true;
}
</script>
<div style="clear:both; height:0px; width:300px; _display:inline;"></div>
<div class="footer">
  <div class="footer_con">
    <div class="footer_p"><?php echo get_ad(8);?></div>
        <div class="footer_ul footer_gy">
            <h2><a href="#">关于我们</a></h2>
            <ul>
                <li><a href="__ROOT__/aboutus/jianjie.html">公司简介</a></li>
                <li><a href="__ROOT__/aboutus/zizhi.html">公司证件</a></li>
                <li><a href="__ROOT__/aboutus/zfsm.html">资费说明</a></li>
                <li><a href="__ROOT__/aboutus/zcfgd.html">政策法规</a></li>	
            </ul>
        </div>
        <div class="footer_ul footer_gy">
            <h2><a href="#">网贷工具</a></h2>
            <ul>
                <li><a href="__ROOT__/tools/tool2.html">计算工具</a></li>
                <li><a href="__ROOT__/tuiguang/index.html">推广系统</a></li>
                <li><a href="__ROOT__/member/auto/index.html">自动投标</a></li>
                <li><a href="__ROOT__/member/capital#fragment-2">资金明细</a></li>	
            </ul>
        </div>
    <div class="footer_ul footer_help">
      <h2><a href="#">帮助信息</a></h2>
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
    <li><a href="#"><?php echo ($glo["bottom"]); ?></a></li>
  </div>
</div>
</body></html>