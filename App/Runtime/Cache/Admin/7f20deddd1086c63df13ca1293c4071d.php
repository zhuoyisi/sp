<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo ($ts['site']['site_name']); ?>管理后台</title>
<link href="__ROOT__/Style/A/css/style.css" rel="stylesheet" type="text/css">
<link href="__ROOT__/Style/A/js/tbox/box.css" rel="stylesheet" type="text/css" />
<link type="text/css" rel="stylesheet" href="__ROOT__/Style/JBox/Skins/Blue/jbox.css"/><!-- `mxl:teamreward` --><!-- 2014.10.13增补 -->
<script type="text/javascript" src="__ROOT__/Style/A/js/jquery.js"></script>
<script type="text/javascript" src="__ROOT__/Style/A/js/common.js"></script>
<script type="text/javascript" src="__ROOT__/Style/A/js/tbox/box.js"></script>
<script type="text/javascript" src="/Style/My97DatePicker/WdatePicker.js" language="javascript"></script>
<script  src="__ROOT__/Style/JBox/jquery.jBox.min.js" type="text/javascript"></script><!-- `mxl:teamreward` -->
<script  src="__ROOT__/Style/JBox/jquery.jBoxConfig.js" type="text/javascript"></script><!-- `mxl:teamreward` -->
</head>
<body>

<div class="so_main">

<div class="page_tit">自动执行参数</div>
<div class="page_tab"><span data="tab_1" class="active">自动执行参数</span><span data="tab_2">程序运行状态</span></div>
<div class="form2">
	<form method="post" action="__URL__/save" onsubmit="return subcheck();" enctype="multipart/form-data">
	<div id="tab_1">
		<dl class="lineD"><dt>执行时间：</dt><dd><input name="o_time" id="o_time"  class="input" type="text" value="<?php echo ($vo["0"]); ?>" ><span id="tip_o_time" class="tip">填两位整数,24小时制,如02表示凌晨两点</span></dd></dl>
		<dl class="lineD"><dt>执行方式：</dt><dd><input name="o_rate" id="o_rate"  class="input" type="text" value="<?php echo ($vo["1"]); ?>" ><span id="tip_o_rate" class="tip">1:连续执行 2:整点执行</span></dd></dl>
		<dl class="lineD"><dt>密钥：</dt><dd><input name="o_key" id="o_key"  class="input" type="text" value="<?php echo ($vo["2"]); ?>" ><span id="tip_o_key" class="tip">越复杂越好,长度不大于100个字符即可,不要使用 | 符号</span></dd></dl>
	<div class="page_btm">
	  <input type="submit" class="btn_b" value="确定" /><span style="color:#CCCCCC">(所有方式修改提交一次即可)</span>
	</div>
	</div><!--tab1-->
	<div id="tab_2" style="display:none">
		<dl class="lineD"><dt>当前运行状态：</dt><dd><input type="button" onclick="doaction('showstatus')" class="btn_b" value="查看" /></dd></dl>
		<dl class="lineD"><dt>开启程序：</dt><dd><input type="button" onclick="doaction('start')" class="btn_b" value="开启" /></dd></dl>
		<dl class="lineD"><dt>关闭程序：</dt><dd><input type="button" onclick="doaction('close')" class="btn_b" value="关闭" />修改配置参数后需要关闭程序再开启才会生效</dd></dl>
		<dl class="lineD"><dt>开启服务：</dt><dd><input type="button" onclick="doaction('startServer')" class="btn_b" value="开启" />开启服务后重启会自动启动程序</dd></dl>
		<dl class="lineD"><dt>卸载服务：</dt><dd><input type="button" onclick="doaction('stopServer')" class="btn_b" value="卸载" />卸载服务后重启不会自动启动程序</dd></dl>
	</div><!--tab1-->
	</form>
</div>

</div>
<script type="text/javascript">
function doaction(action){
	$.ajax({
		url: "__URL__/"+action,
		data: {},
		timeout: 5000,
		cache: false,
		type: "get",
		dataType: "html",
		success: function (d, s, r) {
			alert(d);
		}
	});
}
</script>
<script type="text/javascript" src="__ROOT__/Style/A/js/adminbase.js"></script>
</body>
</html>