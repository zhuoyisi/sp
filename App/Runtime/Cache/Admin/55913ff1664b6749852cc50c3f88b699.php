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
	var addUrl = '__URL__/add';
	var addTitle = '添加分类';
</script>
<div class="so_main">
  <div class="page_tit">论坛帖子管理</div>

  <div class="Toolbar_inbox">
  	<div class="pages" style="float:right; padding:0px;"><?php echo ($pagebar); ?></div>
    <?php foreach($tArr as $k=>$v){ ?>
    <?php if($v['parent_id'] == 0): ?><a class="btn_a" href="__URL__/index?menu=<?php echo ($k); ?>"><span><?php echo ($v['type_name']); ?></span></a><?php endif; } ?>
    <a class="btn_a" href="__URL__/add"><span>添加帖子</span></a>
  </div>
  
  <div class="list">
  <table id="area_list" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th style="width:30px;">
        <input type="checkbox" id="checkbox_handle" onclick="checkAll(this)" value="0">
        <label for="checkbox"></label>
    </th>
    <th class="line_l">ID</th>
    <th class="line_l">帖子标题</th>
    <th class="line_l">所属栏目</th>
    <th class="line_l">所属类别</th>
    <th class="line_l">所属顺序</th>
    <th class="line_l">是否隐藏</th>
    <th class="line_l">发布人</th>
    <th class="line_l">添加时间</th>
    <th class="line_l">最后回复时间</th>
    <th class="line_l">操作</th>
  </tr>
  <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr overstyle='on' id="list_<?php echo ($vo["id"]); ?>">
        <td><input type="checkbox" name="checkbox" id="checkbox2" onclick="checkon(this)" value="<?php echo ($vo["id"]); ?>"></td>
        <td><?php echo ($vo["id"]); ?></td>
        <td><?php echo ($vo["title"]); ?></td>
        <td><?php echo ($tArr[$vo['menu']]['type_name']); ?></td>
        <td><?php echo ($tArr[$vo['cat']]['type_name']); ?></td>
        <td><?php echo ($vo["sort_order"]); ?></td>
        <td><?php if($vo["is_hidden"] == 0): ?>显示<?php else: ?>隐藏<?php endif; ?></td>
        <td><?php echo (($vo["art_writer"])?($vo["art_writer"]):'匿名'); ?></td>
        <td><?php echo (date('Y-m-d H:i',$vo["art_time"])); ?></td>
        <td><?php if($vo["last_repay_time"] != 0): echo (date('Y-m-d H:i',$vo["last_repay_time"])); endif; ?></td>
        <td>
            <a href="__URL__/edit?id=<?php echo ($vo['id']); ?>">编辑</a> 
            <a href="__URL__/del?id=<?php echo ($vo['id']); ?>">删除</a>  
        </td>
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
  </table>
  </div>
  
  <div class="Toolbar_inbox">
  	<div class="pages" style="float:right; padding:0px;"><?php echo ($pagebar); ?></div>
    <?php foreach($tArr as $k=>$v){ ?>
    <?php if($v['parent_id'] == 0): ?><a class="btn_a" href="__URL__/index?menu=<?php echo ($k); ?>"><span><?php echo ($v['type_name']); ?></span></a><?php endif; } ?>
    <a class="btn_a" href="__URL__/add"><span>添加帖子</span></a>
  </div>
</div>
<script type="text/javascript" src="__ROOT__/Style/A/js/adminbase.js"></script>
</body>
</html>