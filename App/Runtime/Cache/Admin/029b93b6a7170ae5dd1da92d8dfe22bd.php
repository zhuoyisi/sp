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

<div class="page_tit">登陆方式管理</div>
<div class="page_tab"><span data="tab_1" class="active">QQ登陆</span><span data="tab_2">新浪微博</span><span data="tab_4">COOKIE_KEY</span></div>
<div class="form2">
	<form method="post" action="__URL__/save" onsubmit="return subcheck();" enctype="multipart/form-data">
	<div id="tab_1">
		<dl class="lineD"><dt>是否启用：</dt><dd><?php $i=0;$___KEY=array ( 1 => '是', 0 => '否', ); foreach($___KEY as $k=>$v){ if(strlen("1key")==1 && $i==0){ ?><input type="radio" name="login[qq][enable]" value="<?php echo ($k); ?>" id="login[qq][enable]_<?php echo ($i); ?>" checked="checked" /><?php }elseif(("key1"=="key1"&&$qq_config["enable"]==$k)||("key"=="value"&&$qq_config["enable"]==$v)){ ?><input type="radio" name="login[qq][enable]" value="<?php echo ($k); ?>" id="login[qq][enable]_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="login[qq][enable]" value="<?php echo ($k); ?>" id="login[qq][enable]_<?php echo ($i); ?>" /><?php } ?><label for="login[qq][enable]_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++; } ?></dd></dl>
		<dl class="lineD"><dt>APP_ID：</dt><dd><input name="login[qq][id]" id="login[qq][id]"  class="input" type="text" value="<?php echo ($qq_config["id"]); ?>" ></dd></dl>
		<dl class="lineD"><dt>APP_KEY：</dt><dd><input name="login[qq][key]" id="login[qq][key]"  class="input" type="text" value="<?php echo ($qq_config["key"]); ?>" ></dd></dl>
	</div>
	<div id="tab_2" style="display:none">
		<dl class="lineD"><dt>是否启用：</dt><dd><?php $i=0;$___KEY=array ( 1 => '是', 0 => '否', ); foreach($___KEY as $k=>$v){ if(strlen("1key")==1 && $i==0){ ?><input type="radio" name="login[sina][enable]" value="<?php echo ($k); ?>" id="login[sina][enable]_<?php echo ($i); ?>" checked="checked" /><?php }elseif(("key1"=="key1"&&$sina_config["enable"]==$k)||("key"=="value"&&$sina_config["enable"]==$v)){ ?><input type="radio" name="login[sina][enable]" value="<?php echo ($k); ?>" id="login[sina][enable]_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="login[sina][enable]" value="<?php echo ($k); ?>" id="login[sina][enable]_<?php echo ($i); ?>" /><?php } ?><label for="login[sina][enable]_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++; } ?></dd></dl>
		<dl class="lineD"><dt>WB_AKEY：</dt><dd><input name="login[sina][akey]" id="login[sina][akey]"  class="input" type="text" value="<?php echo ($sina_config["akey"]); ?>" ></dd></dl>
		<dl class="lineD"><dt>WB_SKEY：</dt><dd><input name="login[sina][skey]" id="login[sina][skey]"  class="input" type="text" value="<?php echo ($sina_config["skey"]); ?>" ></dd></dl>
	</div><!--tab2-->
	
	<!--tab4-->
	<div id="tab_4" style="display:none">
		<dl class="lineD"><dt>cookie加密密钥：</dt><dd><input name="login[cookie][key]" id="login[cookie][key]"  class="input" type="text" value="<?php echo ($cookie_config["key"]); ?>" ><span id="tip_login[cookie][key]" class="tip">尽量复杂</span></dd></dl>
	</div><!--tab4-->
	<div class="page_btm">
	  <input type="submit" class="btn_b" value="确定" /><span style="color:#CCCCCC">(所有方式修改提交一次即可)</span>
	</div>
	</form>
</div>

</div>
<script type="text/javascript" src="__ROOT__/Style/A/js/adminbase.js"></script>
</body>
</html>