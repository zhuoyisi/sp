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

<script type="text/javascript" src="__ROOT__/Style/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript" src="__ROOT__/Style/A/js/jquery.artZoom.js"></script>
<style type="text/css" media="screen">
  A.artZoom {CURSOR: url(/Style/A/images/zoomin.cur), auto; POSITION: relative;}
  A.artZoom .loading {Z-INDEX: 9; BACKGROUND: url(/Style/A/images/load.gif) no-repeat center center; LEFT: 5px; WIDTH: 25px; POSITION: absolute; TOP: 5px; HEIGHT: 25px;}
  .artZoomBox {POSITION: relative;z-index: 999;}
  .artZoomBox A.maxImgLink {DISPLAY: inline; CURSOR: url(/Style/A/images/zoomout.cur), auto; ZOOM: 1}
  .artZoomBox A.maxImgLink .maxImg {BORDER: #ccc 1px solid; PADDING: 5px;  BACKGROUND: #fff; moz-border-radius: 4px; webkit-border-radius: 4px; border-radius: 4px;moz-box-shadow: 0 0 3px rgba(58, 110, 165, 0.5); webkit-box-shadow: 0 0 3px rgba(58, 110, 165, 0.5); box-shadow: 0 0 3px rgba(58, 110, 165, 0.5);}
  .artZoomBox .tool SPAN {display: inline-block; width: 12px; height: 12px; margin: auto 3px auto auto; position: relative; top: 0; *top: 0px; background-image: url('/Style/A/images/icons.png'); background-repeat: no-repeat; *font-size:0; vertical-align:middle;moz-border-radius: 4px; webkit-border-radius: 4px; border-radius: 4px}
  .artZoomBox .tool a { display: inline-block; padding: 5px 8px; font: 12px/1.11 "Microsoft Yahei", Tahoma, Arial, Helvetica, STHeiti; _font-family:Tahoma,Arial,Helvetica,STHeiti; -o-font-family: Tahoma, Arial; _font-size: 12px; color: #3C3C3D; text-shadow: 1px 1px 0 #FFFFFF; background: #ECECEC url('/Style/A/images/css3buttons_backgrounds.png') 0 0 no-repeat; white-space: nowrap; overflow: visible; cursor: pointer; text-decoration: none; border: 1px solid #CACACA; -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; outline: none; position: relative; zoom: 1; *display: inline; *vertical-align: middle; -moz-user-select: none; -webkit-tap-highlight-color: rgba(0,0,0,0); -webkit-user-select: none; -webkit-touch-callout: none;}
  .artZoomBox .tool a:hover { color: #FFFFFF; border-color: #388AD4; text-decoration: none; text-shadow: -1px -1px 0 rgba(0,0,0,0.3); background-position: 0 -40px; background-color: #2D7DC5; }
  .artZoomBox .tool a:active { top: 1px; background-position: 0 -81px; border-color: #347BBA; background-color: #0F5EA2; color: #FFFFFF; text-shadow: none; }

  .artZoomBox .tool .imgRight span { background-position:0 -0; }
  .artZoomBox .tool .imgRight:hover span,  .artZoomBox .tool .imgRight:active span { background-position:0 -12px; }

  .artZoomBox .tool .imgLeft span { background-position:-12px 0; }
  .artZoomBox .tool .imgLeft:hover span,  .artZoomBox .tool .imgLeft:active span { background-position:-12px -12px; }

  .artZoomBox .tool .viewImg span { background-position:-24px 0; }
  .artZoomBox .tool .viewImg:hover span,  .artZoomBox .tool .viewImg:active span { background-position:-24px -12px; }
</style>
<script type="text/javascript">
	var delUrl = '__URL__/doDel';
	var addUrl = '__URL__/add';
	var editUrl = '__URL__/edit';
	var editTitle = '审核资料';
	var isSearchHidden = 1;
	var searchName = "搜索会员上传资料";
</script>
<div class="so_main">
  <div class="page_tit">会员上传资料管理</div>
    <!-------- 搜索游戏 -------->
  <div id="search_div" style="display:none">
  	<div class="page_tit"><script type="text/javascript">document.write(searchName);</script> [ <a href="javascript:void(0);" onclick="dosearch();">隐藏</a> ]</div>
	
	<div class="form2">
	<form method="get" action="__URL__/index">
    <?php if($search["uid"] > 0): ?><input type="hidden" name="uid" value="<?php echo ($search["uid"]); ?>" /><?php endif; ?>
    <?php if($search["customer_id"] > 0): ?><input type="hidden" name="customer_id" value="<?php echo ($search["customer_id"]); ?>" /><?php endif; ?>
    <dl class="lineD">
      <dt>会员名：</dt>
      <dd>
        <input name="uname" style="width:190px" id="title" type="text" value="<?php echo ($search["uname"]); ?>">
        <span>不填则不限制</span>
      </dd>
    </dl>
	
    <dl class="lineD">
      <dt>所属客服：</dt>
      <dd>
        <input name="customer_name" style="width:190px" id="title" type="text" value="<?php echo ($search["customer_name"]); ?>">
        <span>不填则不限制</span>
      </dd>
    </dl>
	
	<dl class="lineD"><dt>资料分类：</dt><dd><select name="se_type" id="se_type"   class="c_select"><option value="">--请选择--</option><?php foreach($data_type as $key=>$v){ if($search["type"]==$key && $search["type"]!=""){ ?><option value="<?php echo ($key); ?>" selected="selected"><?php echo ($v); ?></option><?php }else{ ?><option value="<?php echo ($key); ?>"><?php echo ($v); ?></option><?php }} ?></select><span id="tip_se_type" class="tip">不选则不限制</span></dd></dl>
    
    <dl class="lineD">
      <dt>审核状态：</dt>
      <dd>
      <select name="status" id="status" style="width:150px"  class="c_select"><option value="">--请选择--</option><?php foreach($data_status as $key=>$v){ if($search["status"]==$key && $search["status"]!=""){ ?><option value="<?php echo ($key); ?>" selected="selected"><?php echo ($v); ?></option><?php }else{ ?><option value="<?php echo ($key); ?>"><?php echo ($v); ?></option><?php }} ?></select>
        <span>不填则不限制</span>
      </dd>
    </dl>

    <div class="page_btm">
      <input type="submit" class="btn_b" value="确定" />
    </div>
	</form>
  </div>
  </div>
  <div class="Toolbar_inbox">
  	<div class="pages" style="float:right; padding:0px;"><?php echo ($pagebar); ?></div>
    <a onclick="dosearch();" class="btn_a" href="javascript:void(0);"><span class="search_action">搜索会员上传资料</span></a>
    <?php foreach($data_status as $kds=>$vds){ ?>
    <a class="btn_a" href="__URL__/index?status=<?php echo ($kds); ?>"><span><?php echo ($vds); ?></span></a>
    <?php } ?>
  </div>
  
  <div class="list">
  <table id="area_list" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th style="width:30px;">
        <input type="checkbox" id="checkbox_handle" onclick="checkAll(this)" value="0">
        <label for="checkbox"></label>
    </th>
    <th class="line_l">ID</th>
    <th class="line_l">会员名</th>
    <th class="line_l">资料操作</th>
    <th class="line_l">所属客服</th>
    <th class="line_l">资料分类</th>
    <th class="line_l">资料名称</th>
    <th class="line_l">上传时间</th>
    <th class="line_l">审核状态</th>
    <th class="line_l">奖励积分</th>
    <th class="line_l">审核人</th>
    <th class="line_l">审核时间</th>
    <th class="line_l">审核说明</th>
    <th class="line_l">操作</th>
  </tr>
  <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr overstyle='on' id="list_<?php echo ($vo["id"]); ?>">
        <td><input type="checkbox" name="checkbox" id="checkbox2" onclick="checkon(this)" value="<?php echo ($vo["id"]); ?>"></td>
        <td><?php echo ($vo["id"]); ?></td>
        <td><a onclick="loadUser(<?php echo ($vo["uid"]); ?>,'<?php echo ($vo["uname"]); ?>')" href="javascript:void(0);"><?php echo ($vo["uname"]); ?></a></td>
        <td>
          <a href="/admin/memberdata/upload?uid=<?php echo ($vo["uid"]); ?>">上传信用资料</a>&nbsp;&nbsp;&nbsp;
          <a href="/admin/memberdata/uploadshow?uid=<?php echo ($vo["uid"]); ?>">上传前台展示资料</a>
        </td>
        <td><?php echo (($vo["customer_name"])?($vo["customer_name"]):"&nbsp;"); ?></td>
        <td><?php echo (cnsubstr($vo["type_name"],15)); ?></td>
        <td><?php echo (cnsubstr($vo["data_name"],15)); ?>(<?php if($vo["data_url"] == 2 ): ?><span style="color:red;">没有权限</span><?php elseif($vo["data_url"] != '' ): ?>
       <?php if($vo["data_url"] != ndefined): ?><a class="artZoom" href="/<?php echo ($vo["data_url"]); ?>">资料1</a><?php endif; ?> 
       <?php if($vo["data_url1"] != ndefined): ?><a class="artZoom" href="/<?php echo ($vo["data_url1"]); ?>">资料2</a><?php endif; ?> 
        <?php if($vo["data_url2"] != ndefined): ?><a class="artZoom" href="/<?php echo ($vo["data_url2"]); ?>">资料3</a><?php endif; ?> 
         <?php if($vo["data_url3"] != ndefined): ?><a class="artZoom" href="/<?php echo ($vo["data_url3"]); ?>">资料4</a><?php endif; ?> 
          <?php if($vo["data_url4"] != ndefined): ?><a class="artZoom" href="/<?php echo ($vo["data_url4"]); ?>">资料5</a><?php endif; ?> 
        
        <?php else: ?><span style="color:red;">图片上传失败</span><?php endif; ?>)</td>
        <td><?php echo (date("Y-m-d",$vo["add_time"])); ?></td>
        <td>
        	<?php if($vo["status"] == 0): echo ($vo["status_name"]); ?>
            <?php elseif($vo["status"] == 1): ?>
            	<font color="#00CC00"><?php echo ($vo["status_name"]); ?></font>
            <?php else: ?>
            	<font color="red"><?php echo ($vo["status_name"]); ?></font><?php endif; ?>
         </td>
        <td><?php echo (($vo["deal_credits"])?($vo["deal_credits"]):"&nbsp;"); ?></td>
        <td><?php echo (($vo["real_name"])?($vo["real_name"]):"&nbsp;"); ?></td>
        <td><?php if($vo["deal_time"] != 0): echo (date("Y-m-d H:i",$vo["deal_time"])); endif; ?></td>
        <td><?php echo (($vo["deal_info"])?($vo["deal_info"]):"&nbsp;"); ?></td>
        <td><?php if($vo["status"] == 2): ?>审核未过<?php elseif($vo["status"] == 1): ?>已审核<?php else: ?><a href="javascript:void(0);" onclick="edit('?id=<?php echo ($vo['id']); ?>');">审核</a><?php endif; ?></td>
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
  </table>
  </div>
  
  <div class="Toolbar_inbox">
  	<div class="pages" style="float:right; padding:0px;"><?php echo ($pagebar); ?></div>
    <a onclick="dosearch();" class="btn_a" href="javascript:void(0);"><span class="search_action">搜索会员上传资料</span></a>
    <?php foreach($data_status as $kds=>$vds){ ?>
    <a class="btn_a" href="__URL__/index?status=<?php echo ($kds); ?>"><span><?php echo ($vds); ?></span></a>
    <?php } ?>
  </div>
</div>


<script type="text/javascript" src="__ROOT__/Style/A/js/adminbase.js"></script>
</body>
</html>