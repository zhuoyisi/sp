<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo ($ts['site']['site_name']); ?>后台管理</title>
<script type="text/javascript" src="__ROOT__/Style/A/js/jquery.js"></script>

<link rel="stylesheet" type="text/css" href="/Style/A/js/tbox/box.css"/>
<script type="text/javascript" src="__ROOT__/Style/A/js/common.js"></script>
<script type="text/javascript" src="__ROOT__/Style/A/js/tbox/box.js"></script>
<script type="text/javascript" src="__ROOT__/Style/A/js/frame.js"></script>
<script type="text/javascript" src="__ROOT__/Style/A/js/jquery1.js"></script>
<link rel="stylesheet" href="__ROOT__/Style/A/css/style.css" />
<link rel="stylesheet" href="__ROOT__/Style/A/css/frame.css" />  
    

<script language="javascript" type="text/javascript"> 
<!-- 
var arrCSS=[ 
    ["<img src='__ROOT__/Style/A/images/huanfu/tangerine.gif' width='16' height='9' class='themes' alt='Ocean'>","__ROOT__/Style/A/css/style.css"], 
    ["<img src='__ROOT__/Style/A/images/huanfu/ocean.gif' width='16' height='9' class='themes' alt='Tangerine'>","__ROOT__/Style/A/css/style_1.css"], 
    ["<img src='__ROOT__/Style/A/images/huanfu/violet.gif' width='16' height='9' class='themes' alt='Violet'>","__ROOT__/Style/A/css/style_2.css"], 
    ["<img src='__ROOT__/Style/A/images/huanfu/hui.gif' width='16' height='9' class='themes' alt='Oyster'>","__ROOT__/Style/A/css/style_3.css"], 
    "" 
    ]; 
// *** function to replace href="#" *** 
function v(){ 
    return; 
} 
// *** Cookies *** 
function writeCookie(name, value) {  
    exp = new Date();  
    exp.setTime(exp.getTime() + (86400 * 1000 * 30)); 
    document.cookie = name + "=" + escape(value) + "; expires=" + exp.toGMTString() + "; path=/";  
}  
function readCookie(name) {  
    var search;  
    search = name + "=";  
    offset = document.cookie.indexOf(search);  
    if (offset != -1) {  
        offset += search.length;  
        end = document.cookie.indexOf(";", offset);  
        if (end == -1){ 
            end = document.cookie.length; 
        } 
        return unescape(document.cookie.substring(offset, end));  
    }else{ 
        return ""; 
    } 
} 

//////////////////////////////////// 
// StyleSheet 
//////////////////////////////////// 
function writeCSS(){ 
  for(var i=0;i<arrCSS.length;i++){ 
    document.write('<link title="css'+i+'" href="'+arrCSS[i][1]+'" rel="stylesheet" disabled="true" type="text/css" />'); 
  } 
    setStyleSheet(readCookie("stylesheet")); 
} 

function writeCSSLinks(){ 
  for(var i=0;i<arrCSS.length-1;i++){ 
    if(i>0) document.write('  '); 
    document.write('<a href="javascript:v()" onclick="setStyleSheet(\'css'+i+'\')">'+arrCSS[i][0]+'</a>'); 
  } 
} 

function setStyleSheet(strCSS){ 
  var objs=document.getElementsByTagName("link"); 
  var intFound=0; 
  for(var i=0;i<objs.length;i++){ 
    if(objs[i].type.indexOf("css")>-1&&objs[i].title){ 
      objs[i].disabled = true; 
      if(objs[i].title==strCSS) intFound=i; 
    } 
  } 
  objs[intFound].disabled = false; 
  writeCookie("stylesheet",objs[intFound].title); 
} 

writeCSS(); 
setStyleSheet(readCookie("stylesheet")); 
// 隐藏显示换肤框 
//-->
/* 按下F5时仅刷新iframe页面 */
function inactiveF5(e) {
	return ;
	e=window.event||e;
	var key = e.keyCode;
	if (key == 116){
		parent.MainIframe.location.reload();
		if(document.all) {
			e.keyCode = 0;
			e.returnValue = false;
		}else {
			e.cancelBubble = true;
			e.preventDefault();
		}
	}
}
function nof5() {
    return ;
	if(window.frames&&window.frames[0]) {
		window.frames[0].focus();
		for (var i_tem = 0; i_tem < window.frames.length; i_tem++) {
			if (document.all) {
				window.frames[i_tem].document.onkeydown = new Function("var e=window.frames[" + i_tem + "].event; if(e.keyCode==116){parent.MainIframe.location.reload();e.keyCode = 0;e.returnValue = false;};");
			}else {
				window.frames[i_tem].onkeypress = new Function("e", "if(e.keyCode==116){parent.MainIframe.location.reload();e.cancelBubble = true;e.preventDefault();}");
			}
		} //END for()
	} //END if()
}
function refresh() {
	parent.MainIframe.location.reload();
}
document.onkeydown=inactiveF5;
function txxt(){
	ui.box.load("/admin/common/sms", {title:"通讯系统"});
}
</script> 
</head>
<body class="showmenu">
<div class="head">
    <div class="top">
        <div class="top_logo" style="font-family:"微软雅黑";"> <a href="#" title="" onClick="JumpFrame('index_menu.php','index_body.php');"><img src="/Style/A/images/logo_hui2.png" alt="DedeCms Logo" title=" " id="topdedelogo"  border="0"/> </a></div>
        <!--<div class="top_link">
          <ul>
            <li class="welcome">您好！&nbsp;<span style="color:#ffffff;"><?php echo session('admin_user_name');?></span>  </li>
            <li><a href="__APP__/" target="_blank">查看前台</a></li>
            <li><a href="javascript:void(0);" onClick="txxt();">通讯系统</a></li>
            
            <li style="width:30px; height:15x;"></li>
            <li><a href="javascript:void(0);" onClick="refresh();">刷新</a></li>
            <li><a href="javascript:void(0);" onClick="switch_sub_menu('16', '/admin/global/cleanall.html');">清空缓存</a></li>
            <li><a href="__URL__/logout" target="_top">[退出]</a></li>
          </ul>   
        </div>-->
        <div class="quick"> 
			<span class="welcome">您好！&nbsp; <?php echo session('admin_user_name');?>  </span>
			<a href="__APP__/"  class="ac_qucikmenu" target="_blank">查看前台</a>
			<a href="javascript:void(0);"  class="ac_qucikmenu" onClick="switch_sub_menu('1', '/admin/article/add.html');">添加文章</a>
			<a href="javascript:void(0);"  class="ac_qucikmenu" onClick="txxt();">通讯系统</a>
			<a href="javascript:void(0)"  class="ac_qucikmenu" onClick="switch_sub_menu('16', '/admin/global/cleanall.html');">清空缓存</a>
			<a href="javascript:void(0);"  class="ac_qucikmenu"  onClick="refresh();" style="width:40px;">刷新</a>
			<a href="__URL__/logout"  class="ac_qucikmenu" id="ac_qucikmenu">[退出]</a> 
			<a href="#" class="ac_qucikadd" id="ac_qucikadd"> </a> 
		</div>
		
    </div>
    <!--<div class="topnav">
       <div class="menuact">
           <a href="#" id="togglemenu">隐藏菜单</a>
       </div>

       <div class="nav" id="nav"> </div>
     </div>-->
</div>

<div class="left"  >
  <div class="menu" id="menu"> 
   <iframe src="__URL__/Index_menu2/index" id="menufra" name="MainIframe1"  frameborder="0"></iframe>
  </div>
</div> 
<div class="right">
    <div class="main" >
      <div style="  background-color: #E0ECFF;z-index: 100">
          <div style="background:#eee; margin:0; padding:0;  height:3px; background:#fff url(__ROOT__/Style/A/images/abbbbb.jpg) no-repeat  left top; overflow:hidden;"></div>
          <a href="#" id="togglemenu" style=" position:absolute; top:200px;  overflow:hidden; font-size:12px; text-decoration:none; color:#3B6EA5; height:80px; left:0px; line-height:80px; display:block; width:13px; background:url(__ROOT__/Style/A/images/b1.png) no-repeat;z-index: 300"></a>
          <iframe onload="nof5()" id="MainIframe" name="MainIframe" scrolling="yes" src="" width="100%" height="100%" frameborder="0" noresize> </iframe>
      </div>
    </div>
</div>  
</body>
<script type="text/javascript">
	var current_channel   = null;
	var current_menu_root = null;
	var current_menu_sub  = null;
	var viewed_channel	  = new Array();
	
	$(document).ready(function(){
		switchChannel('0');
	});
	
	//切换频道（即头部的tab）
	function switchChannel(channel) {
		if(current_channel == channel) return false;
		
		$('#channel_'+current_channel).removeClass('on');
		$('#channel_'+channel).addClass('on');
		
		$('#root_'+current_channel).css('display', 'none');
		$('#root_'+channel).css('display', 'block');
		
		var tmp_menulist = $('#root_'+channel).find('a');
		tmp_menulist.each(function(i, n) {
			// 防止重复点击ROOT菜单
			if( i == 0 && $.inArray($(n).attr('id'), viewed_channel) == -1 ) {
				$(n).click();
				viewed_channel.push($(n).attr('id'));
			}
			if ( i == 1 ) {
				$(n).click();
			}
		});

		current_channel = channel;
	}
	
	function switch_root_menu(root) {
		root = $('#tree_'+root);
		if (root.css('display') == 'block') {
			root.css('display', 'none');
			root.parent().css('backgroundImage', 'url(__ROOT__/Style/A/images/ArrOn.png)');
		}else {
			root.css('display', 'block');
			root.parent().css('backgroundImage', 'url(__ROOT__/Style/A/images/ArrOff.png)');
		}
	}
            
	function switch_sub_menu(sub, url) {
		if(current_menu_sub) {
			$('#menu_'+current_menu_sub).attr('class', 'submenuA');
		}
		$('#menu_'+sub).attr('class', 'submenuB');
		current_menu_sub = sub;

		parent.MainIframe.location = url;
	}

</script>
</html>