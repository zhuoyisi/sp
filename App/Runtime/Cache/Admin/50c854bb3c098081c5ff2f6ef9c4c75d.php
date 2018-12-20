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

<script type="text/javascript">
	var delUrl = '__URL__/doDel';
	var addUrl = '__URL__/add';
</script>
<div class="so_main">
  <div class="page_tit">举报信息</div>

  <div class="Toolbar_inbox">
  	<div class="page right"><?php echo ($pagebar); ?></div>
    <a onclick="void(0);" class="btn_a" href="javascript:void(0);"><span>举报信息</span></a>
  </div>
  
  <div class="list">
  <table id="area_list" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th style="width:30px;">
        <input type="checkbox" id="checkbox_handle" onclick="checkAll(this)" value="0">
        <label for="checkbox"></label>
    </th>
    <th class="line_l">ID</th>
    <th class="line_l">举报人邮箱</th>
    <th class="line_l">被举报人</th>
    <th class="line_l">举报原因</th>
    <th class="line_l">举报说明</th>
    <th class="line_l">举报时间</th>
  </tr>
  <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr overstyle='on' id="list_<?php echo ($vo["id"]); ?>">
        <td><input type="checkbox" name="checkbox" id="checkbox2" onclick="checkon(this)" value="<?php echo ($vo["id"]); ?>"></td>
        <td><?php echo ($vo["id"]); ?></td>
        <td><?php echo ($vo["uemail"]); ?></td>
        <td><?php echo ($vo["b_uname"]); ?></td>
        <td><?php echo ($vo["reason"]); ?></td>
        <td><a title="<?php echo ($vo["text"]); ?>"><?php echo (cnsubstr($vo["text"],12)); ?></a></td>
        <td><?php echo (date("Y-m-d H:i:s",$vo["add_time"])); ?></td>
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
  </table>

  </div>
  
  <div class="Toolbar_inbox">
  	<div class="page right"><?php echo ($pagebar); ?></div>
    <a onclick="void(0);" class="btn_a" href="javascript:void(0);"><span>举报信息</span></a>
  </div>
</div>
<script type="text/javascript">
function showurl(url,Title){
	ui.box.load(url, {title:Title});
}
</script>

<script type="text/javascript" src="__ROOT__/Style/A/js/adminbase.js"></script>
</body>
</html>