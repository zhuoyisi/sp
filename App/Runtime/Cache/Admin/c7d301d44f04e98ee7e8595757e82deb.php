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
  <div class="page_tit">留言反馈</div>

  <div class="Toolbar_inbox">
  	<div class="page right"><?php echo ($pagebar); ?></div>
    <a onclick="del();" class="btn_a" href="javascript:void(0);"><span>删除</span></a>
	<?php if(is_array($f_type)): $i = 0; $__LIST__ = $f_type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vx): $mod = ($i % 2 );++$i;?><!--<a href="__URL__/index?type=<?php echo ($key); ?>" class="btn_a"><span><?php echo ($vx); ?></span></a>--><?php endforeach; endif; else: echo "" ;endif; ?>
  </div>
  
  <div class="list">
  <table id="area_list" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th style="width:30px;">
        <input type="checkbox" id="checkbox_handle" onclick="checkAll(this)" value="0">
        <label for="checkbox"></label>
    </th>
    <th class="line_l">ID</th>
    <th class="line_l">姓名</th>
    <th class="line_l">留言类型</th>
    <th class="line_l">留言时间</th>
    <th class="line_l">查看状态</th>
    <th class="line_l">详细内容</th>
    <th class="line_l">操作</th>
  </tr>
  <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr overstyle='on' id="list_<?php echo ($vo["id"]); ?>">
        <td><input type="checkbox" name="checkbox" id="checkbox2" onclick="checkon(this)" value="<?php echo ($vo["id"]); ?>"></td>
        <td><?php echo ($vo["id"]); ?></td>
        <td><?php echo ($vo["name"]); ?></td>
        <td><?php echo ($vo["type"]); ?></td>
        <td><?php echo (date("Y-m-d H:i:s",$vo["add_time"])); ?></td>
        <td><?php if($vo["status"] == '1'): ?><span style="color:#009900">已查看</span><?php else: ?><span style="color:#FF0000">未查看</span><?php endif; ?></td>
        <td><?php echo (cnsubstr($vo["msg"],12)); ?></td>
        <td>
            <a href="__URL__/edit?id=<?php echo ($vo["id"]); ?>">查看</a>  
            <a href="javascript:void(0);" onclick="del(<?php echo ($vo['id']); ?>);">删除</a>  
        </td>
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
  </table>

  </div>
  
  <div class="Toolbar_inbox">
  	<div class="page right"><?php echo ($pagebar); ?></div>
    <a onclick="del();" class="btn_a" href="javascript:void(0);"><span>删除</span></a>
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