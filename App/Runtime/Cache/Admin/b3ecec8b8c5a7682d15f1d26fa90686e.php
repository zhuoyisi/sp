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
<style type="text/css">
.list input[type=text]{
	color: #333333;
    padding-bottom: 2px;
    padding-left: 2px;
    padding-right: 2px;
    padding-top: 2px;
}
</style>
<div class="page_tit">会员级别管理</div>
<div class="page_tab"><span data="tab_1" class="active">会员级别管理</span></div>
<div class="form2">
	<form method="post" action="__URL__/save" onsubmit="return subcheck();" enctype="multipart/form-data">
	<div id="tab_1">
	  <div class="Toolbar_inbox">
		<div class="page right"><?php echo ($pagebar); ?></div>
		<a onclick="addone();" class="btn_a" href="javascript:void(0);"><span>添加一个级别</span></a>
	  </div>
	  <div class="list">
	  <table id="area_list" width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<th style="width:30px;">
			<input type="checkbox" id="checkbox_handle" onclick="checkAll(this)" value="0">
			<label for="checkbox"></label>
		</th>
		<th class="line_l">序号</th>
		<th class="line_l">年龄名称</th>
		<th class="line_l">开始年龄</th>
		<th class="line_l">结束年龄</th>
		<th class="line_l">操作</th>
	  </tr>
	  <?php if(is_array($leve)): $i = 0; $__LIST__ = $leve;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr overstyle='on' id="list_<?php echo ($key); ?>">
			<td><input type="checkbox" name="checkbox" id="checkbox2" onclick="checkon(this)" value="<?php echo ($key); ?>"></td>
			<td><?php echo ($key); ?></td>
			<td><input type="text" style="width:100px" name="leve[<?php echo ($key); ?>][name]" value="<?php echo ($vo["name"]); ?>" /></td>
			<td><input type="text" style="width:100px" name="leve[<?php echo ($key); ?>][start]" value="<?php echo ($vo["start"]); ?>" /></td>
			<td><input type="text" style="width:100px" name="leve[<?php echo ($key); ?>][end]" value="<?php echo ($vo["end"]); ?>" /></td>
			<td>
				<a href="javascript:void(0);" onclick="delx(<?php echo ($key); ?>);">删除</a>  
			</td>
		  </tr><?php endforeach; endif; else: echo "" ;endif; ?>
	  </table>
		</div>
	</div><!--tab1-->

	<div class="page_btm"><input type="submit" class="btn_b" value="确定" /><span style="color:#CCCCCC">(判断方式是[ >=开始积分,<结束积分 ]所有方式修改提交一次即可)</span>
	</div>
	</form>
</div>

</div>

<script type="text/javascript">
var xss=parseInt(<?php echo ($key); ?>)||0;
function addone(){
	xss++;
	var htmladd = '<tr overstyle="on" id="list_'+xss+'">';
		htmladd += '<td><input type="checkbox" name="checkbox" id="checkbox2" onclick="checkon(this)" value="'+xss+'"></td>';
		htmladd += '<td>'+xss+'</td>';
		htmladd += '<td><input type="text" style="width:100px" name="leve['+xss+'][name]" value="" /></td>';
		htmladd += '<td><input type="text" style="width:100px" name="leve['+xss+'][start]" value="" /></td>';
		htmladd += '<td><input type="text" style="width:100px" name="leve['+xss+'][end]" value="" /></td>';
		htmladd += '<td><a href="javascript:void(0);" onclick="delx('+xss+');">删除</a></td>';
		htmladd += '</tr>';	
	$(htmladd).appendTo("#area_list");
}
function delx(id){
	if(confirm("删除后不可恢复，并且删除完要确定保存后才会生产，确定要删除吗?")) $("#list_"+id).remove();
}
</script>
<script type="text/javascript" src="__ROOT__/Style/A/js/adminbase.js"></script>
</body>
</html>