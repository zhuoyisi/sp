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

<script type="text/javascript">
  var isSearchHidden = 1;
  var searchName = "搜索/筛选标的数量统计";
</script>
<div class="so_main">
  <div class="page_tit">标的数量统计 ——— 按标的种类统计</div>
    <div id="search_div" style="display:none">
  	<div class="page_tit"><script type="text/javascript">document.write(searchName);</script> [ <a href="javascript:void(0);" onclick="dosearch();">隐藏</a> ]</div>
	
	<div class="form2">
	<form method="get" action="__URL__/biaonum">

    <dl class="lineD">
      <dt>标的状态：</dt>
      <dd>
        <?php foreach($type_list as $k=>$v){ ?>
        <input id="borrow_status_<?php echo ($k); ?>" type="radio" value="<?php echo ($k); ?>" name="borrow_status"><label for="borrow_status_<?php echo ($k); ?>"><?php echo ($v); ?></label>
        <?php } ?>
        <span>不选择则不限制</span>
      </dd>
    </dl>

  <dl class="lineD"><dt>交易时间(开始)：</dt><dd><input onclick="WdatePicker({maxDate:'#F{$dp.$D(\'end_time\')||\'2020-10-01\'}',dateFmt:'yyyy-MM-dd HH:mm:ss',alwaysUseStartDate:true});" name="start_time" id="start_time"  class="input Wdate" type="text" value="<?php echo (mydate('Y-m-d H:i:s',$search["start_time"])); ?>"><span id="tip_start_time" class="tip">只选开始时间则查询从开始时间往后所有</span></dd></dl>
  <dl class="lineD"><dt>交易时间(结束)：</dt><dd><input onclick="WdatePicker({minDate:'#F{$dp.$D(\'start_time\')}',maxDate:'2020-10-01',dateFmt:'yyyy-MM-dd HH:mm:ss',alwaysUseStartDate:true});" name="end_time" id="end_time"  class="input Wdate" type="text" value="<?php echo (mydate('Y-m-d H:i:s',$search["end_time"])); ?>"><span id="tip_end_time" class="tip">只选结束时间则查询从结束时间往前所有</span></dd></dl>

    <div class="page_btm">
      <input type="submit" class="btn_b" value="确定" />
    </div>
	</form>
  </div>
  </div>
  <div class="Toolbar_inbox">
    <div class="pages" style="float:right; padding:0px;"><?php echo ($pagebar); ?></div>
    <a onclick="dosearch();" class="btn_a" href="javascript:void(0);"><span class="search_action">搜索/筛选借款</span></a>
    <a class="btn_a" href="__URL__/index?withdraw_status=<?php echo ($kds); ?>"><span><?php echo ($vds); ?></span></a>
  </div>
  
  <div class="list">
  <table id="area_list" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th style="width:30px;">
        <input type="checkbox" id="checkbox_handle" onclick="checkAll(this)" value="0">
        <label for="checkbox"></label>
    </th>
    <th class="line_l">标类</th>
    <th class="line_l">一天</th>
    <th class="line_l">一周</th>
    <th class="line_l">一月</th>
    <th class="line_l">六月</th>
    <th class="line_l">一年</th>
    <th class="line_l">一年以前</th>
    <th class="line_l">全部</th>
  </tr>
  <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr overstyle='on' id="list_<?php echo ($vo["id"]); ?>">
        <td><input type="checkbox" name="checkbox" id="checkbox2" onclick="checkon(this)" value="<?php echo ($vo["id"]); ?>"></td>
        <td><?php echo (($vo["name"])?($vo["name"]):0); ?></td>
        <td><?php echo (fmoney($vo["money"]["0"])); ?>【<?php echo (($vo["num"]["0"])?($vo["num"]["0"]):0); ?>】</td>
        <td><?php echo (fmoney($vo["money"]["1"])); ?>【<?php echo (($vo["num"]["1"])?($vo["num"]["1"]):0); ?>】</td>
        <td><?php echo (fmoney($vo["money"]["2"])); ?>【<?php echo (($vo["num"]["2"])?($vo["num"]["2"]):0); ?>】</td>
        <td><?php echo (fmoney($vo["money"]["3"])); ?>【<?php echo (($vo["num"]["3"])?($vo["num"]["3"]):0); ?>】</td>
        <td><?php echo (fmoney($vo["money"]["4"])); ?>【<?php echo (($vo["num"]["4"])?($vo["num"]["4"]):0); ?>】</td>
        <td><?php echo (fmoney($vo['money'][5]-$vo['money'][4])); ?>【<?php echo (($vo['num'][5]-$vo['num'][4])?($vo['num'][5]-$vo['num'][4]):0); ?>】</td>
        <td><font style="color:red;font-weight:bold;"><?php echo (fmoney($vo["money"]["5"])); ?>【<?php echo (($vo["num"]["5"])?($vo["num"]["5"]):0); ?>】</font></td>
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
  </table>

  </div>
  
  <div class="Toolbar_inbox">
    <div class="pages" style="float:right; padding:0px;"><?php echo ($pagebar); ?></div>
    <a onclick="dosearch();" class="btn_a" href="javascript:void(0);"><span class="search_action">搜索/筛选借款</span></a>
    <a class="btn_a" href="__URL__/index?withdraw_status=<?php echo ($kds); ?>"><span><?php echo ($vds); ?></span></a>
  </div>
</div>
<script type="text/javascript" src="__ROOT__/Style/A/js/adminbase.js"></script>
</body>
</html>