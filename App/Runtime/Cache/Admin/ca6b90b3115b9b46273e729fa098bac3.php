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
<script type="text/javascript" src="__ROOT__/Style/My97DatePicker/WdatePicker.js" language="javascript"></script>

<div class="so_main">

<div class="page_tit">手机验证审核</div>
<div class="page_tab"><span data="tab_1" class="active">基本信息</span></div>
<div class="form2">
	<form method="post" action="__URL__/doEdit" onsubmit="return subcheck();">
	<input type="hidden" name="uid" value="<?php echo ($vo["uid"]); ?>"/>
	<div id="tab_1">
	
	<dl class="lineD"><dt>是否通过审核：</dt><dd><?php $i=0;$___KEY=array ( 1 => '是', 2 => '否', ); foreach($___KEY as $k=>$v){ if(strlen("1")==1 && $i==0){ ?><input type="radio" name="status" value="<?php echo ($k); ?>" id="status_<?php echo ($i); ?>" checked="checked" /><?php }elseif(("1"=="key1"&&$_X["_Y"]==$k)||(""=="value"&&$_X["_Y"]==$v)){ ?><input type="radio" name="status" value="<?php echo ($k); ?>" id="status_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="status" value="<?php echo ($k); ?>" id="status_<?php echo ($i); ?>" /><?php } ?><label for="status_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++; } ?><span id="tip_status" class="tip">*</span></dd></dl>
	<dl class="lineD"><dt>申请人：</dt><dd><?php echo ($vo["uname"]); ?></dd></dl>
	</div><!--tab1-->
	
	<div class="page_btm">
	  <input type="submit" class="btn_b" value="确定" />
	</div>
	</form>
</div>
<script type="text/javascript">
function subcheck(){
	if($("input[name='status']:checked").val()!=1 && $("input[name='status']:checked").val()!=2){
		ui.error("请选择审核结果");
		return false;
	}
	return true;
}
</script>
</div>
<script type="text/javascript" src="__ROOT__/Style/A/js/adminbase.js"></script>
</body>
</html>