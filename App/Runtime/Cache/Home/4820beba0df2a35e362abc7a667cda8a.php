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

<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<title><?php echo ($vo["borrow_name"]); ?>-我要投资-<?php echo ($glo["web_name"]); ?></title>
<meta name="keywords" content="<?php echo ($glo["web_keywords"]); ?>" />
<meta name="description" content="<?php echo ($glo["web_descript"]); ?>" />
<link rel="stylesheet" href="__ROOT__/Style/H/css/reset.css" />
<link rel="stylesheet" href="__ROOT__/Style/H/css/detail.css" />
<link rel="stylesheet" type="text/css" href="__ROOT__/Style/fancybox/jquery.fancybox-1.3.2.css" media="screen" />

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
		
<div class="state_main">
  <div class="xw_main_state">
    <div class="state_project">
      <div class="project_left">
        <h3> <span class="tailuser"><?php if($minfo["is_transfer"] == '0'): ?>借款用户&nbsp;:&nbsp;<?php else: ?>借款企业&nbsp;:&nbsp;<?php endif; echo ($minfo["user_name"]); ?>&nbsp;<?php echo (getleveico($minfo["credits"],2)); ?></span><span style="display:block; float:left;"><?php if($minfo["is_transfer"] == 1): ?><img src="/Style/H/images/icon/lbt.gif"/>&nbsp;<?php else: endif; echo getIco($vo);?></span> <?php echo (cnsubstr($vo["borrow_name"],16)); ?>&nbsp; </h3>
        <div class="clear"></div>
        <p> <span class="width1">借款金额</span> <span class="width2">年利率</span> <span class="width3">借款期限</span> </p>
        <ul>
          <li><span class="width1"><strong>￥<?php echo ($vo["borrow_money"]); ?></strong>元</span><span class="width2"><strong><?php echo ($vo["borrow_interest_rate"]); ?></strong>&nbsp;%/年&nbsp;</span> <span class="width3">&nbsp;<strong><?php echo ($vo["borrow_duration"]); ?> </strong>
            <?php if($vo["repayment_type"] == 1): ?>天
              <?php else: ?>
              个月<?php endif; ?>
            </span></li>
          <li> <span class="width1">还款方式：<?php echo ($Bconfig['REPAYMENT_TYPE'][$vo['repayment_type']]); ?></span>投标进度： <span class="ui-list-field"> <span class="ui-progressbar-mid ui-progressbar-mid-<?php echo (intval($vo["progress"])); ?>"><em><?php echo (intval($vo["progress"])); ?>%</em></span> </span> </li>
          <li> <span class="width1">借款用途：<?php echo ($gloconf['BORROW_USE'][$vo['borrow_use']]); ?></span><span>投标奖励：<?php echo ($vo["reward_num"]); ?>%&nbsp;&nbsp;<?php if($vo["money_collect"] > 0): ?>待收限制：<?php echo (fmoney($vo["money_collect"])); ?> 元<?php else: endif; ?> </span>
          </li>
          <li> 
        <?php if($vo["danbao"] == 0): ?><span class="width1">发布时间 : <?php echo (date("Y-m-d H:i",$vo["add_time"])); ?></span><?php else: ?>
        <span class="width1">担保公司 :<a class="newdanbao"  href="/news/<?php echo ($vo["danbao"]); ?>.html"> <?php echo ($vo["title"]); ?></a></span><?php endif; ?><span>剩余时间：<span id="endtime"><span class="red"><span  id="loan_time">-- 天 -- 小时 -- 分 -- 秒</span></span></span></span>

 </li>
        </ul>
      </div>
      <div class="project_right">
        <h3><a href="/tools/tool.html">利息计算器</a>我要投标</h3>
        <form method="get" action="">
          <p class="remain"> <span>您的可用余额：</span> <strong>
            <?php if(session('u_id') ==''): ?>￥0.00元
            <?php else: ?> <?php echo ($investInfo['account_money']+$investInfo['back_money']); ?>元<?php endif; ?></strong>
            <a class="fRight icon-gree-link f16 mr20" style="padding:3px 15px;" href="__APP__/member/charge#fragment-1" target="_blank">充值</a>
          </p>
          <p class="jx_end"> 
            <?php if($vo["borrow_status"] > 5 && $invid!='no' ): ?>已满标&#12288;&#12288;<a href="__APP__/member/tendout#fragment-3" class="bot03">借款合同</a>
            <?php else: ?>
				 满标还差:<?php echo ($vo["need"]); ?>元<?php endif; ?>
          </p>
          <p class="jx_notice" id="jx_notice"></p>
          	<p class="jx_input">
			<?php if(session('u_id') ==''): ?><input type="text" class="jx_input_disabled" disabled="disabled" value="请先登录"/>
			<?php elseif($vo["borrow_status"] == 3): ?>
            	<input type="text" class="jx_input_disabled" disabled="disabled" value="已流标"/>
            <?php elseif($vo["borrow_status"] == 4): ?>
            	<input type="text" class="jx_input_disabled" disabled="disabled" value="复审中"/>
            <?php elseif($vo["borrow_status"] == 6): ?>
            	<input type="text" class="jx_input_disabled" disabled="disabled" value="还款中"/>
            <?php elseif($vo["borrow_status"] > 6): ?>
            	<input type="text" class="jx_input_disabled" disabled="disabled" value="已完成"/>
           	<?php else: ?>
           		<input id="enter_value" type="text" /><?php endif; ?>
			</p>
			<p class="jx_desc">
				<?php if($vo["borrow_max"] != 0): ?><span>最多投资金额:<?php echo (($vo["borrow_max"])?($vo["borrow_max"]):"无限制"); ?></span><?php endif; ?>起投金额:<?php echo (fmoney($vo["borrow_min"])); ?>
			</p>
			<?php if($vo["borrow_status"] == 3): ?><div class="jx_payment jx_payment_disabled">已流标</div>
            <?php elseif($vo["borrow_status"] == 4): ?>
            	<div class="jx_payment jx_payment_disabled">复审中</div>
            <?php elseif($vo["borrow_status"] == 6): ?>
            	<div class="jx_payment jx_payment_disabled">还款中</div>
            <?php elseif($vo["borrow_status"] > 6): ?>
            	<div class="jx_payment jx_payment_disabled">已完成</div>
            <?php else: ?>
            	<div id="jx_payment" class="jx_payment" onclick="invest(<?php echo ($vo["id"]); ?>);">立即投标</div><?php endif; ?>
        </form>
      </div>
    </div>
    <div class="clear"></div>
    <div class="state_info">
      <ul class="state_info_nav" id="state_info_nav">
         <?php if($minfo["is_transfer"] == '0'): ?><li class="active"><a class="invest-tab current" href="javascript:void(0)" onclick="showTail('userintro',this);">借款者信息</a></li>
		<?php else: ?>
		<li class="active"><a class="invest-tab current" href="javascript:void(0)" onclick="showTail('userintro',this);">企业信息</a></li><?php endif; ?>
        <li class=""><a class="invest-tab" href="javascript:void(0)" onclick="showTail('picintro',this);">资料审核</a></li>
        <li class=""><a class="invest-tab" href="javascript:void(0)" onclick="showTail('record',this);">投资记录</a></li>
      </ul>
      <div class="clear"></div>
      <div class="state_info_con"  id="userintro" style="display:block;">
	   <?php if($minfo["is_transfer"] == '0'): ?><h3> 个人信息 </h3>
        <ul class="state_person">
          <?php if($UID > '0'): ?><li><span class="width1">性别：<?php echo (($minfo["sex"])?($minfo["sex"]):"未填写"); ?></span><span class="width2">年龄：<?php echo (($minfo["age"])?($minfo["age"]):"0"); ?>岁（<?php echo (getagename($minfo["age"])); ?>）</span><span class="width3">学历：<?php echo (($minfo["education"])?($minfo["education"]):"未填写"); ?></span><span class="width4">婚姻状况：<?php echo (($minfo["marry"])?($minfo["marry"]):"未填写"); ?></span><span class="width5">月收入(元)：<?php echo (getmoneyformt($minfo["fin_monthin"])); ?></span></li>
            <li><span class="width2">所属客服：<?php echo (($minfo["customer_name"])?($minfo["customer_name"]):"未指定"); ?></span><span class="width3">是否购车：<?php echo (($minfo["fin_car"])?($minfo["fin_car"]):"未填写"); ?></span><span class="width4">职位：<?php echo (($minfo["zy"])?($minfo["zy"]):"未填写"); ?></span><span class="width5">户籍所在地：<?php echo (($minfo["location"])?($minfo["location"]):"未填写"); ?></span><span class="width2"></span><span class="width3"></span><span class="width4"></span><span class="width5"></span></li>
            <?php else: ?>
            <p style="font-size:18px; text-align:center; line-height:3em;">个人信息登陆后才可以查看！</p><?php endif; ?>
        </ul>
		<?php else: endif; ?>
        <h3> 账户详情 </h3>
        <ul class="state_person">
          <?php if($UID > '0'): ?><li><span class="width1">资产总额：<?php echo (getmoneyformt($minfo["zcze"])); ?></span><span class="width2">待还总额：<?php echo (getmoneyformt($capitalinfo["tj"]["dhze"])); ?></span><span class="width3">已还总额：<?php echo (getmoneyformt($capitalinfo["tj"]["yhze"])); ?></span><span class="width4">借出本金：<?php echo (getmoneyformt($capitalinfo["tj"]["jcze"])); ?></span><span class="width5">待收总额：<?php echo (getmoneyformt($capitalinfo["tj"]["dsze"])); ?></span></li>
            <li><span class="width1">回款总额：<?php echo (getmoneyformt($capitalinfo["tj"]["ysze"])); ?></span><!--<span class="width2">负债情况：
              <?php if($capitalinfo['tj']['fz'] < 0): ?>(<?php echo (getmoneyformt($capitalinfo["tj"]["fz"])); ?>)
                <?php else: ?>
                (<?php echo (getmoneyformt($capitalinfo["tj"]["fz"])); ?>)<?php endif; ?>
              </span>--><span class="width3">信用额度：<?php echo (getmoneyformt($mainfo["credit_limit"])); ?></span><span class="width4"></span><span class="width5"></span></li>
            <?php else: ?>
            <p style="font-size:18px; text-align:center; line-height:3em;">账户详情登陆后才可以查看！</p><?php endif; ?>
        </ul>
        <!--<h3> 还款信用 </h3>
        <ul class="state_person">
          <?php if($UID > '0'): ?><li><span class="width1">成功借款次数：<?php echo (($capitalinfo["tj"]["jkcgcs"])?($capitalinfo["tj"]["jkcgcs"]):0); ?>次</span><span class="width2">正常还款次数：<?php echo (($capitalinfo["repayment"]["1"]["num"])?($capitalinfo["repayment"]["1"]["num"]):0); ?>次</span><span class="width3">迟还次数：<?php echo (($capitalinfo["repayment"]["3"]["num"])?($capitalinfo["repayment"]["3"]["num"]):0); ?>次</span><span class="width4">待还款笔数：<?php echo (($xin_list["6"]["num"])?($xin_list["6"]["num"]):"0"); ?>次</span><span class="width5">提前还款次数：<?php echo (($capitalinfo["repayment"]["2"]["num"])?($capitalinfo["repayment"]["2"]["num"]):0); ?>次</span></li>
            <li><span class="width1">网站代还次数：<?php echo (($capitalinfo["repayment"]["4"]["num"])?($capitalinfo["repayment"]["4"]["num"]):0); ?>次</span><span class="width2">逾期还款笔数：<?php echo (($capitalinfo["repayment"]["5"]["num"])?($capitalinfo["repayment"]["5"]["num"]):0); ?>次</span><span class="width3"></span><span class="width4"></span><span class="width5"></span></li>
            <?php else: ?>
            <p style="font-size:18px; text-align:center; line-height:3em;">还款信用登陆后才可以查看！</p><?php endif; ?>
        </ul>-->
		<?php if($minfo["is_transfer"] == '0'): ?><h3>借款说明</h3>
                <ul class="state_person">
				<?php if($UID > '0'): ?><p style="font-size:16px; text-align:left;line-height:2em;"><?php echo (($vo["borrow_info"])?($vo["borrow_info"]):"投资人没有添加借款说明"); ?></p>
					<?php else: ?>
            <p style="font-size:18px; text-align:center; line-height:3em;">借款说明登陆后才可以查看！</p><?php endif; ?>
                </ul>
				<?php else: ?>
				<h3>企业介绍及借款说明</h3>
                <ul class="state_person">
				<?php if($UID > '0'): ?><p style="font-size:16px; text-align:left;line-height:2em;"><?php echo (($vo["borrow_info"])?($vo["borrow_info"]):"投资人没有添加借款说明"); ?></p>
					<?php else: ?>
            <p style="font-size:18px; text-align:center; line-height:3em;">借款说明登陆后才可以查看！</p><?php endif; ?>
                </ul><?php endif; ?>
      </div>
      <div class="state_info_con_h"  id="picintro" style="display:none;">
		 <ul class="state_person">
		 
		 <?php if($UID > '0'): ?><table width="100%" class="shjl_table" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto;">
            <tr class="tr_header11" style="height: 30px; line-height: 30px;">
              <td style="width:300px;color:#0099ff;font-size:14px;font-weight:bold">项目名称</td>
              <td style="width:150px;color:#0099ff;font-size:14px;font-weight:bold">状态</td>
			  <td style="width:200px;color:#0099ff;font-size:14px;font-weight:bold">上传时间</td>
              <td style="width:150px;color:#0099ff;font-size:14px;font-weight:bold">通过时间</td>
            </tr>
            <tbody id="tInfo">
            <?php if(is_array($data_list)): $i = 0; $__LIST__ = $data_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?><tr>
                            <td ><?php echo ($vv["data_name"]); ?></td>
                            <td>
							<?php if($vv["status"] == 1): ?><img src="/Style/H/images/zhuce3.gif"/>
							<?php else: ?>审核中<?php endif; ?> </td>
							<td ><?php echo (mydate("Y-m-d H:i",$vv["add_time"])); ?></td>
                            <td><?php if($vv["status"] == 1): echo (mydate("Y-m-d H:i",$vv["deal_time"])); ?>
							<?php else: ?>---<?php endif; ?> 
							</td>
                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
               
            </tbody>
          </table>
		 <?php else: ?>
            <p style="font-size:18px; text-align:center; line-height:3em;">资料审核登陆后才可以查看！</p><?php endif; ?>
        </ul>
        <?php if($UID > '0'): ?><p style="font-size:18px; text-align:center; line-height:3em;">借款人披露信息</p>      
         <?php if($vo['updata'] == 'N;'): else: ?>
          <table style="width:99%">
            <tr>
              <td><div  style="float:left;" id="preview">
                  <div id="spec-n5">
                    <div class="spec-button spec-left" id="spec-left" style="cursor: default;"> <img id="imgLeft" src="__ROOT__/Style/H/images/left_g.gif"></div>
                    <div id="spec-list" class="bot05">
                      <div class="bot06">
                        <ul class="list-h bot07">
                          <?php $i=0;foreach(unserialize($vo['updata']) as $v){ $i++; ?>
                          <li id="display2"> <a href="__ROOT__/<?php echo $v['img']; ?>" title="<?php echo $v['info']; ?>" rel="img_group"> <img  title="<?php echo $v['info']; ?>" src="__ROOT__/<?php echo get_thumb_pic($v['img']); ?>"> </a> <span>
                            <?php echo $v['info']; ?>
                            </span> </li>
                          <?php } ?>
                        </ul>
                      </div>
                    </div>
                    <div class="spec-button" id="spec-right" style="cursor: default;"> <img id="imgRight" src="__ROOT__/Style/H/images/scroll_right.gif"></div>
                  </div>
                </div>
                <script type="text/javascript">
								var lilenth = $(".list-h li").length+1;
								$(".list-h").css("width", lilenth * 160);
								var leftpos = 0;
								var leftcount = 0;
				
								$("#imgLeft").attr("src", "__ROOT__/Style/H/images/left_g.gif");
								$("#spec-left").css("cursor", "default");
				
								if (lilenth > 1) {
									$(function() {
										$("#spec-right").click(function() {
											if (leftcount >= 0) {
												$("#imgLeft").attr("src", "__ROOT__/Style/H/images/scroll_left.gif");
												$("#spec-left").css("cursor", "pointer");
											}
											if (lilenth - leftcount < 3) {
												$("#imgRight").attr("src", "__ROOT__/Style/H/images/right_g.gif");
												$("#spec-right").css("cursor", "default");
											}
											else {
												leftpos = leftpos - 160;
												leftcount = leftcount + 1;
												$(".list-h").animate({ left: leftpos }, "slow");
												if (lilenth - leftcount < 2) {
													$("#imgRight").attr("src", "__ROOT__/Style/H/images/right_g.gif");
													$("#spec-right").css("cursor", "default");
												}
											}
				
										});
									});
				
				
									$(function() {
										$("#spec-left").click(function() {
											if (lilenth - leftcount > 2) {
												$("#imgRight").attr("src", "__ROOT__/Style/H/images/scroll_right.gif");
												$("#spec-right").css("cursor", "pointer");
											}
				
											if (leftcount < 1) {
												$("#imgLeft").attr("src", "__ROOT__/Style/H/images/left_g.gif");
												$("#spec-left").css("cursor", "default");
											}
											else {
												leftpos = leftpos + 160;
												leftcount = leftcount - 1;
												$(".list-h").animate({ left: leftpos }, "slow");
												if (leftcount < 1) {
													$("#imgLeft").attr("src", "__ROOT__/Style/H/images/left_g.gif");
													$("#spec-left").css("cursor", "default");
												}
											}
				
										}
										)
									})
								}
								else {
									$("#imgRight").attr("src", "__ROOT__/Style/H/images/right_g.gif");
									$("#spec-right").css("cursor", "default");
								}
								$(function() {
									var width = $("#preview").width();
									$("#spec-list").css("width", 820).css("margin-right", 8);
				
								});
				
								$(function() {
									$("#spec-list img").bind("mouseover", function() {
										$(this).css({
											"border": "2px solid #FFFFFF",
											"padding": "1px"
										});
									}).bind("mouseout", function() {
										$(this).css({
											"border": "1px solid #ccc",
											"padding": "2px"
										});
									});
								})
								</script>
              </td>
            </tr>
          </table><?php endif; ?>
          <?php else: ?>
          <p style="font-size:18px; text-align:center; line-height:3em;">借款人披露信息登陆后才可以查看！</p><?php endif; ?>
        </ul>
      </div>
      <div class="state_info_con"  id="record" style="display:none;">
        <div class="bidbox">
          <table class="bid" cellspacing="0" width="100%">
            <thead>
              <tr class="">
                <th class="" width="148">投标人</th>
                <th class="" width="148">投标类型</th>
                <th class="" width="158">投标金额</th>
                <th class="" width="198">投标时间</th>
              </tr>
            </thead>
            <tbody id="investrecord" class="tender-list">
            </tbody>
			<table>
            <tr>
            <td colspan="6"> <div class="pages" style="width:650px; margin-left:0;"><?php echo ($page); ?></div></td>
			</tr>
          </table>
          </table>
        </div>
        <div class="totalAmount posa fn-clear" id="totalAmount" style="left: 701px; ">
          <p class="f16">已投标金额</p>
          <p><em class="f24" id="total-money"><?php echo ($vo["has_borrow"]); ?></em>元</p>
          <p class="f16 mt20">加入人次</p>
          <p><em class="f24" id="total-time"><?php echo (($vo["borrow_times"])?($vo["borrow_times"]):"0"); ?></em>人</p>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="__ROOT__/Style/fancybox/jquery.fancybox-1.3.2.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$("a[rel=img_group]").fancybox({
			'transitionIn'		: 'none',
			'transitionOut'		: 'none',
			'titlePosition' 	: 'over',
			'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
				return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
			}
		});
		ajax_show(1);
	});
	function ajax_show(p)
	{
	   $.get("__URL__/investRecord?borrow_id=<?php echo ($borrow_id); ?>&p="+p, function(data){
		  $("#investrecord").html(data);
	   });

	   $(".pages a").removeClass('current');
	   $(".pages a").eq(p).addClass("current");
	}

	$(function() {
		$(".borrowlist5").bind("mouseover", function(){
			$(this).css("background", "#c9edff");
		})

		$(".borrowlist5").bind("mouseout", function(){
			$(this).css("background", "#ecf9ff");
		})


		$(".borrowlist3").bind("mouseover", function(){
			$(this).css("background", "#c9edff");
		})

		$(".borrowlist3").bind("mouseout", function(){
			$(this).css("background", "#fff");
		})
	});

</script>
<input id="hid" type="hidden" value="<?php echo ($vo["lefttime"]); ?>" />
<script type="text/javascript">
	function showht(){
		var status = '<?php echo ($invid); ?>';
		if(status=="no"){
			$.jBox.tip("您未投此标");
		}else if(status=="login"){
			$.jBox.tip("请先登陆");
		}else{
			window.location.href="__APP__/member/agreement/downfile?id="+status;
		}
	}

	var seconds;
	var pers = <?php echo (($vo["progress"])?($vo["progress"]):0); ?>/100;
	var timer=null;
	function setLeftTime() {
		seconds = parseInt($("#hid").val(), 10);
		timer = setInterval(showSeconds,1000);
	}
	
	function showSeconds() {
		var day1 = Math.floor(seconds / (60 * 60 * 24));
		var hour = Math.floor((seconds - day1 * 24 * 60 * 60) / 3600);
		var minute = Math.floor((seconds - day1 * 24 * 60 * 60 - hour * 3600) / 60);
		var second = Math.floor(seconds - day1 * 24 * 60 * 60 - hour * 3600 - minute * 60);
		if (day1 < 0) {
			clearInterval(timer);
			$("#loan_time").html("投标已经结束！");
		} else if (pers >= 1) {
			clearInterval(timer);
			$("#loan_time").html("投标已经结束！");
		} else {
			$("#loan_time").html(day1 + " 天 " + hour + " 小时 " + minute + " 分 " + second + " 秒");
		}
		seconds--;
	}                
	if (pers >= 1) {
		$("#loan_time").html("投标已经结束！");
	}else{
		setLeftTime();
	}
	$(document).ready(function(){
		if($("#display2").length>0){ 
			$('#display1').show();
		}
						
	});
</script>
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
<script language="javascript" src="__ROOT__/Style/H/js/index.js"></script>
<script language="javascript" src="__ROOT__/Style/H/js/borrow.js"></script>
<script>
function invest(id){
	var flag = validate_enter(),
		num = $('#enter_value').val();
		if(!_validate_enter_flag || !flag){
			return;
		}
		
		$.jBox("get:__URL__/ajax_invest?id="+id+'&num='+num, {title: "立即投标",buttons: {}});
}
var investmoney = 0;
var borrowidMS = 0;
var borrow_min = 0;
var borrow_max = 0;
function PostData() {
	var pin = $("#pin").val(),					// 支付密码
		money = $("#enter_value").val(),		// 输入投资金额
		borrow_id = $('#borrow_id').val(),		// 投标编号
		borrow_pass = $("#borrow_pass");		// 定向标密码
		if(!pin){
			$.jBox.tip("请输入支付密码");  
			return false;
		}
		
		if(borrow_pass.length && !borrow_pass.val()){
			$.jBox.tip("请输入定向标密码");  
			return false;
		}
		
		var flag = validate_enter();
			if(!flag){
				return;
			}
  $.ajax({
	  url: "__URL__/investcheck",
	  type: "post",
	  dataType: "json",
	  data: {"money":money,'pin':pin,'borrow_id':borrow_id,"borrow_pass":borrow_pass.val()},
	  success: function(d) {
			  if (d.status == 1) {
			  		investmoney = money;
			  var content = '<div class="jbox-custom"><p>'+ d.message +'</p><div class="jbox-custom-button"><span onclick="$.jBox.close()">取消</span><span onclick="isinvest(true)">确定投标</span></div></div>';
			  	$.jBox(content, {title:'会员投标提示',buttons: {}});
			  }
			  else if(d.status == 2)// 无担保贷款多次提醒
			  {
				  var content = '<div class="jbox-custom"><p>'+ d.message +'</p><div class="jbox-custom-button"><span onclick="$.jBox.close()">取消</span><span onclick="ischarge(true)">去充值</span></div></div>';
				  	$.jBox(content, {title:'会员投标提示',buttons: {}});
			  }
			  else if(d.status == 3)// 无担保贷款多次提醒
			  {
				  $.jBox.tip(d.message);
			  }else{
				  $.jBox.tip(d.message);  
			  }
	  }
  });
}


// 提交支付当前要投标表单
function isinvest(d){
	if(d===true) document.forms.investForm.submit();
}
// 充值
function ischarge(d){
	if(d===true) location.href='/member/charge#fragment-1';
}

// 是否验证成功 默认不允许投钱
$('#enter_value').on('focus', function (){
	var notice = document.getElementById('jx_notice');
	notice.innerHTML = '';
	notice.className = 'jx_notice';
});

var _validate_enter_flag = false;

function validate_enter()
{
	var getId = function (ele){ return document.getElementById(ele);},
		need_max = <?php echo ($vo["need"]); ?>,
		allow_max = (<?php echo ($vo["borrow_max"]); ?> == 0 ? need_max : <?php echo ($vo["borrow_max"]); ?>),
		allow_min = <?php echo ($vo["borrow_min"]); ?>,
		notice = getId('jx_notice'),
		owner = getId('enter_value'),
		payment = getId('jx_payment');
	
		if(!owner)
		{
			return null; // 在金额输入框为禁用状态
		}
		else
		{
			value = owner.value;
		}
		
		if(isNaN(value))
		{ // 不是数字
			notice.innerHTML = '投资金额不正确，默认最小投资金额！'
			notice.className = 'jx_notice jx_error';
			payment.className = 'jx_payment';
			owner.value = allow_min;
			_validate_enter_flag = false;
		}
		else
		{
			var max = Math.min(need_max, allow_max),
				int = parseInt(value);
				if(int!=value)
				{
					notice.innerHTML = '投资金额必须为整数！'
					notice.className = 'jx_notice jx_error';
					owner.value = allow_min;
					_validate_enter_flag = false;
				}
				else
				{
					if(int > max){
						notice.innerHTML = '投资金额不正确，大于最多投标金额！'
						notice.className = 'jx_notice jx_error';
						owner.value = max;
						_validate_enter_flag = false;
					}else if(int < allow_min){
						notice.innerHTML = '投资金额不正确，默认最小投资金额！'
						notice.className = 'jx_notice jx_error';
						owner.value = allow_min;
						_validate_enter_flag = false;
					}else{
						_validate_enter_flag = true;
						notice.className = 'jx_notice jx_success';
						notice.innerHTML = '输入正确！';
						payment.className = 'jx_payment';
					}
				}
		}
		
		return _validate_enter_flag;
}
</script>