<?php if (!defined('THINK_PATH')) exit();?> <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="__ROOT__/Style/H/css/css.css" />
<link type="text/css" rel="stylesheet" href="__ROOT__/Style/JBox/Skins/Currently/jbox.css"/>
<link href="__ROOT__/Style/H/css/Mbmber.css" rel="stylesheet" type="text/css">
<script language=javascript type="text/javascript" src="__ROOT__/Style/Js/jquery.js"></script>
<script language=javascript src="__ROOT__/Style/JBox/jquery.jBox.min.js" type=text/javascript></script>
<script language=javascript src="__ROOT__/Style/JBox/jquery.jBoxConfig.js" type=text/javascript></script>
<script  type="text/javascript" src="__ROOT__/Style/Js/ui.core.js"></script>
<script  type="text/javascript" src="__ROOT__/Style/Js/ui.tabs.js"></script>
<script type="text/javascript" src="__ROOT__/Style/My97DatePicker/WdatePicker.js" language="javascript"></script>
<script language="javaScript" type="text/javascript" src="__ROOT__/Style/H/js/backtotop.js"></script>
<script type="text/javascript" src="__ROOT__/Style/Js/utils.js"></script>
<script type="text/javascript">
	function makevar(v){
		var d={};
		for(i in v){
			var id = v[i];
			d[id] = $("#"+id).val();
			if(!d[id]) d[id] = $("input[name='"+id+"']:checked").val();
		}
		return d;
	}

	function ajaxGetData(url,targetid,data){
			if(!url) return;
			data = data||{};
			var thtml = '<div class="loding"><img src="__ROOT__/Style/Js/006.gif"align="absmiddle" />　信息正在加载中...,如长时间未加载完成，请刷新页面</div>';
			$("#"+targetid).html(thtml);
			
			$.ajax({
				url: url,
				data: data,
				timeout: 10000,
				cache: true,
				type: "get",
				dataType: "json",
				success: function (d, s, r) {
					if(d) $("#"+targetid).html(d.html);
				},
				error: '',
				complete: ''
			});
		
	}
	var currentUrl = window.location.href.toLowerCase();
	$(document).ready(function() {
		$('#rotate > ul').tabs();/* 第一个TAB渐隐渐现（{ fx: { opacity: 'toggle' } }），第二个TAB是变换时间（'rotate', 2000） */
		$('.dw_navlist li a').click(function() { // 绑定单击事件
			var nowurl = $(this).attr('href');
			var vid = nowurl.split("#");
			try{
				if(currentUrl.indexOf(vid[0]) != -1 ){
					$('#rotate > ul').tabs('select', "#"+vid[1]); // 切换到第三个选项卡标签
					var geturl= $('#rotate > ul li a [href="#'+vid[1]+'"]').attr("ajax_href");
					ajaxGetData(geturl,vid[1]);
					return false;
				}
			}catch(ex){};
				return true;
		});
		
		$('.ajaxdata a').click(function(){
			var geturl = $(this).attr('ajax_href');
			var hasget = $(this).attr('get')||0;
			var nowurl = $(this).attr('href');
			var vid = nowurl.split("#");
			if(hasget!=1) ajaxGetData(geturl,vid[1]);
			$(this).attr('get','1');
			$('html,body').animate({scorllTop:0},1000);
			return false;
		})
	});
	//ui
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
        $(function() {
            $(".dw_navlist li,.dv_r_5 li").mousemove(function() {
                $(this).addClass("current");
            }).mouseout(function() {
                $(this).removeClass("current");
            });
        });
</script>

<title>我的账户-- <?php echo ($glo["web_name"]); ?></title>
<script type="text/javascript" src="__ROOT__/Style/Js/ajaxfileupload.js"></script>
<script type="text/javascript">
var mbTest = /^(13|14|15|18|17)[0-9]{9}$/;
var timer = null;
var leftsecond = 60; //倒计时
var msg = "";
function sendMobileValidSMSCode() {
	$("#btnSendMsg").html("");
	var mobile = $("#txt_phone").val();
	if (mobile == "") {
		$("#btnSendMsg").html("获取验证码");
		$('#sendSMSTip').html("请输入手机号码");
		return;
	}
	if (mbTest.test(mobile)) {
		$('#sendSMSTip').html("短信发送中...");
		$.ajax({
			url: "__URL__/sendphone/",
			type: "post",
			dataType: "json",
			data: {"cellphone":mobile},
			success: function(d) {
				leftsecond = 60;
				if (d.status == 1) {
					msg = "发送成功，如未收到";
					clearInterval(timer);
					timer = setInterval(setLeftTime, 1000, "1");
					$("#btnSendMsg").html("");
					$("#txt_phone").attr("readonly", true);
				}
				else if (d.status == 2) {
					$('#sendSMSTip').html("该手机号码已被其他用户使用");
					$("#btnSendMsg").html("获取验证码");
					$("#txt_phone").removeAttr("readonly");
				}
				else {
					msg = "校验码发送失败,请重试";
					$("#sendSMSTip").html(msg);
					$("#btnSendMsg").html("获取验证码");
					$("#txt_phone").attr("readonly", true);
				}
			}
		});
	}
	else {
		$("#btnSendMsg").removeAttr("disabled");
		$("#btnSendMsg").html("获取验证码");
		$("#sendSMSTip").html("手机号码有误");
	}
}
function setLeftTime() {
	var second = Math.floor(leftsecond);
	$(".spTip").eq(0).html(msg + second + "秒后可重发");
	leftsecond--;
	if (leftsecond < 1) {
		$(".spTip").eq(0).html("现在可重新发送！");
		clearInterval(timer);
		try {
			$("#btnSendMsg").html("获取验证码");
			$("#txt_phone").removeAttr("readonly");
		} catch (E) { }
		return;
	}
}

function myrefresh3()
{
	   window.location.href="__APP__/member/verify?id=1#fragment-2";
	   window.location.reload();
}

var apppath = "__APP__";
function setMobile() {
	var code = $('#txt_smsCode').val();
	$.ajax({
		url: "__URL__/validatephone",
		type: "post",
		dataType: "json",
		data: {"code":code},
		success: function(d) {
			if (d.status==1) {
				$.jBox.tip("验证成功");
				setTimeout('myrefresh3()',1000); 
			}
			else {
				if (d.status == 2) {
					leftsecond = 60;
					msg = "验证失败或者校验码失效，";
					clearInterval(timer);
					timer = setInterval(setLeftTime, 1000, "1");
					$("#btnSendMsg").attr("disabled", true);
					$("#txt_phone").attr("readonly", true);
				}
				if (d.status == 0) {
					$(".spTip").html(d.message);
				}
			}
		}
	});
}

function setSafeQuestion() {
	var question1 = $('#question1').val();
	var question2 = $('#question2').val();
	var answer1 = $('#answer1').val();
	var answer2 = $('#answer2').val();
	var isValidForm = true;
	if ($.trim(answer1) == '') {
		isValidForm = false;
		$('#answer1err').html('请输入安全问题答案。');
	}
	if ($.trim(answer2) == '') {
		isValidForm = false;
		$('#answer2err').html('请输入安全问题答案。');
	}
	if (question1 == question2) {
		isValidForm = false;
		$('#qErr').html('请设置两个不相同的安全问题。');
	}
	if (isValidForm) {
		$('#answer1err').html('');
		$('#answer2err').html('');
		$('#qErr').html('');
	}
	else {
		return;
	}
	$.ajax({
		url: "__URL__/questionsave/",
		type: "post",
		dataType: "json",
		data: {"q1":question1,"q2":question2,"a1":answer1,"a2":answer2},
		success: function(result) {
			if (result.status == 0) {
				$('#answer2err').html('安全问题设置失败，请稍后再试。');
			}
			else {
				$.jBox.tip("设置成功");
			}
		}
	});
}


function sendMobileValidSMSCodeByAdmin() {
	$("#btnSendMsg").html("");
	var mobile = $("#txt_phone").val();
	if (mobile == "") {
		$('#sendSMSTip').html("请输入手机号码");
		return;
	}
	if (mbTest.test(mobile)) {
		$('#sendSMSTip').html("手机验证审核提交中...");
		$.ajax({
			url: "__URL__/sendphone/",
			type: "post",
			dataType: "json",
			data: {"cellphone":mobile},
			success: function(d) {
				if (d.status == 1) {
					msg = "发送成功,等待管理员审核";
					$("#sendSMSTip").html(msg);
					setTimeout('myrefresh3()',1000); 
				}
				else if (d.status == 2) {
					$('#sendSMSTip').html("该手机号码已被其他用户使用");
				}
				else {
					$("#txt_phone").attr("readonly", true);
				}
			}
		});
	}
	else {
		$("#sendSMSTip").html("手机号码有误");
	}
}
//验证身份证号方法
var testIdcard = function(idcard) {
var Errors = new Array("验证通过!", "身份证号码位数不对!", "身份证号码出生日期超出范围!", "身份证号码校验错误!", "身份证地区非法!");
var area = { 11: "北京", 12: "天津", 13: "河北", 14: "山西", 15: "内蒙古", 21: "辽宁", 22: "吉林", 23: "黑龙江", 31: "上海", 32: "江苏", 33: "浙江", 34: "安徽", 35: "福建", 36: "江西", 37: "山东", 41: "河南", 42: "湖北", 43: "湖南", 44: "广东", 45: "广西", 46: "海南", 50: "重庆", 51: "四川", 52: "贵州", 53: "云南", 54: "西藏", 61: "陕西", 62: "甘肃", 63: "青海", 64: "宁夏", 65: "xinjiang", 71: "台湾", 81: "香港", 82: "澳门", 91: "国外" }
var idcard, Y, JYM;
var S, M;
var vv = "<?php echo ($vv["is_transfer"]); ?>";
var idcard_array = new Array();
idcard_array = idcard.split("");
if(vv == 1)
return Errors[0];
if (area[parseInt(idcard.substr(0, 2))] == null) return Errors[4];
switch (idcard.length) {
	case 15:
		if ((parseInt(idcard.substr(6, 2)) + 1900) % 4 == 0 || ((parseInt(idcard.substr(6, 2)) + 1900) % 100 == 0 && (parseInt(idcard.substr(6, 2)) + 1900) % 4 == 0)) {
			ereg = /^[1-9][0-9]{5}[0-9]{2}((01|03|05|07|08|10|12)(0[1-9]|[1-2][0-9]|3[0-1])|(04|06|09|11)(0[1-9]|[1-2][0-9]|30)|02(0[1-9]|[1-2][0-9]))[0-9]{3}$/; //测试出生日期的合法性 
		}
		else {
			ereg = /^[1-9][0-9]{5}[0-9]{2}((01|03|05|07|08|10|12)(0[1-9]|[1-2][0-9]|3[0-1])|(04|06|09|11)(0[1-9]|[1-2][0-9]|30)|02(0[1-9]|1[0-9]|2[0-8]))[0-9]{3}$/; //测试出生日期的合法性 
		}
		if (ereg.test(idcard))
			return Errors[0];
		else
			return Errors[2];
		break;
	case 18:
		if (parseInt(idcard.substr(6, 4)) % 4 == 0 || (parseInt(idcard.substr(6, 4)) % 100 == 0 && parseInt(idcard.substr(6, 4)) % 4 == 0)) {
			ereg = /^[1-9][0-9]{5}[0-9]{4}((01|03|05|07|08|10|12)(0[1-9]|[1-2][0-9]|3[0-1])|(04|06|09|11)(0[1-9]|[1-2][0-9]|30)|02(0[1-9]|[1-2][0-9]))[0-9]{3}[0-9Xx]$/; //闰年出生日期的合法性正则表达式 
		}
		else {
			ereg = /^[1-9][0-9]{5}[0-9]{4}((01|03|05|07|08|10|12)(0[1-9]|[1-2][0-9]|3[0-1])|(04|06|09|11)(0[1-9]|[1-2][0-9]|30)|02(0[1-9]|1[0-9]|2[0-8]))[0-9]{3}[0-9Xx]$/; //平年出生日期的合法性正则表达式 
		}
		if (ereg.test(idcard)) {
			S = (parseInt(idcard_array[0]) + parseInt(idcard_array[10])) * 7 + (parseInt(idcard_array[1]) + parseInt(idcard_array[11])) * 9 + (parseInt(idcard_array[2]) + parseInt(idcard_array[12])) * 10 + (parseInt(idcard_array[3]) + parseInt(idcard_array[13])) * 5 + (parseInt(idcard_array[4]) + parseInt(idcard_array[14])) * 8 + (parseInt(idcard_array[5]) + parseInt(idcard_array[15])) * 4 + (parseInt(idcard_array[6]) + parseInt(idcard_array[16])) * 2 + parseInt(idcard_array[7]) * 1 + parseInt(idcard_array[8]) * 6 + parseInt(idcard_array[9]) * 3;
			Y = S % 11;
			M = "F";
			JYM = "10X98765432";
			M = JYM.substr(Y, 1);
			if (M == idcard_array[17])
				return Errors[0];
			else
				return Errors[3];
		}
		else
			return Errors[2];
		break;
	default:
		return Errors[1];
		break;
}
}

function myrefresh1()
{
       window.location.reload();
	   window.location.href="/member/verify?id=1#fragment-3";
}
function setIdCard() {
	var realname = $('#realname').val();
	var idcard = $('#idcard').val();
	var isValidForm = true;
	if ($.trim(realname) == '') {
		isValidForm = false;
		$('#realnameErr').html('请输入您的真实姓名。');
	}else{
		$('#realnameErr').html('');
	}
	
	if ($.trim(idcard) == '') {
		isValidForm = false;
		$('#idcardErr').html('请输入您的身份证号码。');
	}
	else {
		var idcartValidResult = testIdcard($.trim(idcard));
		if (idcartValidResult.indexOf('通过') == -1) {
			isValidForm = false;
			$('#idcardErr').html(idcartValidResult);
		}
	}
	if (isValidForm) {
		$('#realnameErr').html('');
		$('#idcardErr').html('');
	}
	else {
		return;
	} 
	$.ajax({
		url: "__URL__/saveid/",
		type: "post",
		dataType: "json",
		data: {"realname":realname,"idcard":idcard},
		success: function(result) {
			if (result.status == "0") {
				$('#idcardErr').html(result.message);
                return false;
			}
			else {
				$.jBox.tip("数据提交成功");
                setTimeout('myrefresh1()',1000); ;//指定1秒刷新 
			}
		}
	});
}
function ajaxFileUploads()
{
	$("#loading_makeclub").ajaxStart(function(){	$(this).show();	}).ajaxComplete(function(){	$(this).hide();	});
	$.ajaxFileUpload({
			url:'__URL__/ajaxupimg/',
			secureuri:false,
			fileElementId:'imgfile',
			dataType: 'json',
			success: function (data, status)
			{
				if(data.status==1){
					$("#idimg").css('color','green').html('上传成功');
				}
				else  $("#idimg").css('color','red').html('上传失败，请重试');
			}
		})
}

function ajaxFileUploads2()
{
	$("#loading_makeclub2").ajaxStart(function(){	$(this).show();	}).ajaxComplete(function(){	$(this).hide();	});
	$.ajaxFileUpload({
			url:'__URL__/ajaxupimg2/',
			secureuri:false,
			fileElementId:'imgfile2',
			dataType: 'json',
			success: function (data, status)
			{
				if(data.status==1){
					$("#idimg2").css('color','green').html('上传成功');
				}
				else  $("#idimg2").css('color','red').html('上传失败，请重试');
			}
		})
}

	function checkEmailValided(){
        $.ajax({
            url: "__URL__/emailvalided/",
            data: {},
            timeout: 5000,
            cache: false,
            type: "get",
            dataType: "json",
            success: function (d, s, r) {
              	if(d){
					if(d.status==1){
							$.jBox.tip("验证成功");
					}else{
						$("#emailtip").show();
					}
				}
            }
        });
	}

	function sendValidEmail1(){
		$.jBox.tip("邮件发送中......",'loading');
        $.ajax({
            url: "__URL__/emailvsend1/",
            timeout: 8000,
            cache: false,
            type: "post",
            dataType: "json",
			data: {},
            success: function (d, s, r) {
              	if(d){
					if(d.status==1){
						$.jBox.tip('新邮件已经发送成功，请注意查收！');
						
					}else{
						$.jBox.tip('发送失败,请重试！');
						
					}
				}
            },
			complete:function(XMLHttpRequest, textStatus){
					setTimeout('myrefresh()',3000); //指定3秒刷新
			}
        });
	}

	function sendValidEmail(){
		var email = $("#email").val();
		if(email==""){
			$.jBox.tip('邮箱地址不能为空！','tip');
			return;
		}else{
			var emailreg = new RegExp("^[\\w-]+(\\.[\\w-]+)*@[\\w-]+(\\.[\\w-]+)+$", "i");
			if(!emailreg.test(email)){
				$.jBox.tip('请输入正确的邮箱地址','tip');
				return;
			}else{
				AsyncEmail(email);
			}
		}
		
		/*$.jBox.tip("邮件发送中......",'loading');
        $.ajax({
            url: "__URL__/emailvsend/",
            timeout: 5000,
            cache: false,
            type: "post",
            dataType: "json",
			data: {"email":email},
            success: function (d, s, r) {
              	if(d){
					if(d.status==1){
						$.jBox.tip('新邮件已经发送成功，请注意查收！');
						window.location.reload();
					}else{
						$.jBox.tip('发送失败,请重试！');
						window.location.reload();
					}
				}
            }
        });*/
	}
	function AsyncEmail(email) {
	$.jBox.tip("正在检测电子邮件地址……",'loading');
	$.ajax({
            type: "post",
            async: false,
			dataType: "json",
            url: "__URL__/ckemail/",
            data: {"Email":email},
            //timeout: 3000,
            success: function (d, s, r) {
              	if(d){
					if(d.status==1){
						send_email(email);
					}else{
						$.jBox.tip('邮箱已经在本站注册！','tip');
						return;
					}
				}
			}
        });
	}
	
function myrefresh()
{
       window.location.href="/member/verify?id=1#fragment-1";
	   window.location.reload();
}


	function send_email(email){
		$.jBox.tip("邮件发送中......",'loading');
        $.ajax({
            url: "__URL__/emailvsend/",
			data: {"email":email},
            timeout: 8000,
			cache: false,
			type: "post",
			dataType: "json",
            success: function (d, s, r) {
					if(d.status==1){
						$.jBox.tip(d.message,"success");
					}else if(d.status==2){
						$.jBox.tip(d.message,"fail");
					}else{
						$.jBox.tip(d.message,"fail");
					}
            },
			complete:function(XMLHttpRequest, textStatus){
					setTimeout('myrefresh()',3000); //指定3秒刷新
			}
        });
	}
	function email(){
		$.jBox.tip("验证成功");
	}
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
		
<!--中部开始-->
<div class="wrap2">
  <div id="hy_left"> <div class="user_list" > <a class="dw_top" href="/member" style="border-top:1px solid #D2D2D2;">帐户总览</a>
  <div id="dw_m_left">
    <div class="dv_r_5" > <a class="bt6"><span></span>基本设置</a> </div>
    <div class="dw_navlist">
      <ul>
        <li><a href="__APP__/member/memberinfo#fragment-1">基本资料</a></li>
        <li><a href="__APP__/member/user#fragment-1">头像与密码</a></li>
        <li><a href="__APP__/member/verify?id=1#fragment-1">认证中心</a></li>
        <?php if($loginconfig['qq']['enable'] == '0' and $loginconfig['sina']['enable'] == '0'): ?><li class="last"><a href="__APP__/member/msg#fragment-1">系统消息</a></li>
          <?php else: ?>
          <li><a href="__APP__/member/msg#fragment-1">系统消息</a></li>
          <li class="last"><a  href="__APP__/member/oauthlogin">快捷登录</a></li><?php endif; ?>
      </ul>
    </div>
    <div class="dv_r_5" > <a class="bt3"><span></span>资金管理</a> </div>
    <div class="dw_navlist">
      <ul>
        <li><a href="__APP__/member/capital#fragment-1">资金统计</a></li>     
        <li><a href="__APP__/member/charge#fragment-1">我要充值</a></li>
        <li><a href="__APP__/member/withdraw#fragment-1">我要提现</a></li>
        <li><a href="__APP__/member/bank#fragment-1">银行帐户</a></li>
        <li class="last"><a href="__APP__/member/credit#fragment-1">积分记录</a></li>
      </ul>
    </div>
    <div class="dv_r_5"> <a class="bt4"><span></span>投资管理</a> </div>
    <div class="dw_navlist">
      <ul>
        <li><a href="__APP__/member/tendout#fragment-3">投资明细</a></li>
        <!--<li><a href="__APP__/member/tborrow#fragment-2">企业直投投资</a></li>
		 <li><a href="__APP__/member/fund#fragment-2">定投宝投资</a></li>-->
        <li><a href="__APP__/member/debt#fragment-1">债权转让</a></li>
        <li  class="last"><a href="__APP__/member/auto/index.html">自动投标</a></li>
      </ul>
    </div>
    <div class="dv_r_5" > <a class="bt2"><span></span>借款管理</a> </div>
    <div class="dw_navlist">
      <ul>
        <li><a href="__APP__/member/borrowin#fragment-3">借款总表</a></li>
        <li ><a href="__APP__/member/moneylimit#fragment-1">额度申请</a></li>
        <li class="last"><a href="__APP__/member/verify#fragment-7">资料上传</a></li>
      </ul>
    </div>
    <div class="dv_r_5" style="display:none;" > <a class="bt5"><span></span>好友管理</a> </div>
    <div class="dw_navlist">
      <ul>
        <li><a href="/member/friend#fragment-1">好友列表</a></li>
        <li><a href="/member/friend#fragment-2">好友申请</a></li>
        <li><a href="/member/friend#fragment-3">会员留言</a></li>
      </ul>
    </div>
       <div class="dv_r_5" > <a class="bt7"><span></span>邀请有奖</a> </div>
    <div class="dw_navlist">
      <ul>

        <li><a href="/member/promotion#fragment-1">邀请好友</a></li>
        <li class="last"><a href="/member/promotion#fragment-2">奖金记录</a></li>
      </ul>
    </div>
  </div>
  <a href="__APP__/member/auto/index.html" class="dw_autotou"></a> </div>
<script type="text/javascript">

dw_solid =function (a,b,c){
var a1=$(a).children(),
b1=$(a).children(b),
c1=$(a).children(c),
lh=location.href;
lh=lh.split(location.host)[1];
c1.hide();
lh=="/member/verify?id=1#fragment-3" && a1.eq(1).show();

b1.each(function(){
var next=$(this).next(),
index=next.index(),
sp=$('span',this),
sibp=$('span',$(this).siblings(b)),
aa=$('a',next);
aa.each(function(){
var ah=$(this).attr('href');
if(lh==ah){
a1.eq(index).show();
sp.addClass('on');
}
});
$(this).click(function(){
sp.toggleClass('on');
sibp.removeClass('on');
next.slideToggle().siblings(c).slideUp();
})
});

}
dw_solid("#dw_m_left",".dv_r_5",".dw_navlist");
$(window).load(function(){
$('body,html').animate({scrollTop:0},1);
});
</script>
 </div>
  <div id="hy_right">
    <div class="box">
     <div class="Menubox1" id="rotate">
					<ul class="menu ajaxdata">
                        <li><a href="#fragment-1" ajax_href="__URL__/email/" style="color: blue;font-weight: bold;">邮箱认证</a></li>
                        <li><a  id="mx2" href="#fragment-2" ajax_href="__URL__/cellphone/" style="color: blue;font-weight: bold;">手机认证</a></li>
                        <?php if($vv["is_transfer"] == 1): ?><li><a id="mx3" href="#fragment-3" ajax_href="__URL__/idcard/" style="color: blue;font-weight: bold;">企业认证</a></li>
						<?php else: ?><li><a id="mx3" href="#fragment-3" ajax_href="__URL__/idcard/" style="color: blue;font-weight: bold;">实名认证</a></li><?php endif; ?>
                        <!--<li><a id="mx4" href="#fragment-4" ajax_href="__URL__/face/">现场认证</a></li>
                        <li><a id="mx5" href="#fragment-5" ajax_href="__URL__/video/">视频认证</a></li>-->
						<li><a id="mx6" href="#fragment-6" ajax_href="__URL__/safequestion/" style="color: blue;font-weight: bold;">安全问题设置</a></li>
                        <li><a id="mx7" href="#fragment-7" ajax_href="__APP__/Member/memberinfo/editdata/" style="color: blue;font-weight: bold;">资料认证</a></li>
					</ul>
				</div> 
      <div class="contentright">
        <div id="fragment-1" style="display:none">
          <!--升级会员-->
        </div>
        <div id="fragment-2" style="display:none">
          <!--升级会员-->
        </div>
        <div id="fragment-3" style="display:none">
          <!--升级会员-->
        </div>
        <div id="fragment-4" style="display:none">
          <!--升级会员-->
        </div>
        <div id="fragment-5" style="display:none">
          <!--升级会员-->
        </div>
        <div id="fragment-6" style="display:none">
          <!--升级会员-->
        </div>
        <div id="fragment-7" style="display:none">
          <!--升级会员-->
        </div>
      </div>
    </div>
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