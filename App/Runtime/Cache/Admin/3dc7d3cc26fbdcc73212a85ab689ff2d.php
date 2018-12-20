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
  <div class="page_tit">帖子回复管理</div>
  
  <div class="Toolbar_inbox">
  	<div class="pages" style="float:right; padding:0px;"><?php echo ($pagebar); ?></div>
    <a onclick="dosearch();" class="btn_a" href="javascript:void(0);"><span class="search_action">搜索/筛选</span></a>
  </div>
  
  <div class="list">
  <table id="area_list" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th style="width:30px;">
        <input type="checkbox" id="checkbox_handle" onclick="checkAll(this)" value="0">
        <label for="checkbox"></label>
    </th>
    <th class="line_l">ID</th>
    <th class="line_l">帖子ID</th>
    <th class="line_l" width="20%">帖子标题</th>
    <th class="line_l">回帖内容</th>
    <th class="line_l">是否显示</th>
    <th class="line_l">回帖人</th>
    <th class="line_l">回帖时间</th>
    <th class="line_l">操作</th>
  </tr>
  <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr overstyle='on' id="list_<?php echo ($vo["id"]); ?>" class="leve_1" typeid="<?php echo ($vo["id"]); ?>" parentid="<?php echo ($vo["parent_id"]); ?>">
        <td><input type="checkbox" name="checkbox" id="checkbox2" onclick="checkon(this)" value="<?php echo ($vo["id"]); ?>"></td>
        <td><?php echo ($vo["id"]); ?></td>
        <td><?php echo ($vo["tid"]); ?></td>
        <td><?php echo ($vo["title"]); ?></td>
        <td><?php echo ($vo["content"]); ?></td>
        <td><?php if($vo["is_hidden"] == 0): ?>显示<?php else: ?>隐藏<?php endif; ?></td>
        <td><?php echo ($vo["user_name"]); ?></td>
        <td><?php echo (date('Y-m-d H:i',$vo["art_time"])); ?></td>

        <td>
            <a href="__URL__/editRepay?id=<?php echo ($vo['id']); ?>">编辑</a> 
            <a href="__URL__/delRepay?id=<?php echo ($vo['id']); ?>">删除</a>  
        </td>
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
  </table>

  </div>
  
  <div class="Toolbar_inbox">
  	<div class="pages" style="float:right; padding:0px;"><?php echo ($pagebar); ?></div>
    <a onclick="dosearch();" class="btn_a" href="javascript:void(0);"><span class="search_action">搜索/筛选</span></a>
  </div>
</div>
<script type="text/javascript" src="__ROOT__/Style/A/js/adminbase.js"></script>
</body>
</html>