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
  <div class="page_tit">评论管理</div>

  <div class="Toolbar_inbox">
  	<div class="page right"><?php echo ($pagebar); ?></div>
    <a onclick="del();" class="btn_a" href="javascript:void(0);"><span>删除评论</span></a>
  </div>
  
  <div class="list">
  <table id="area_list" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th style="width:30px;">
        <input type="checkbox" id="checkbox_handle" onclick="checkAll(this)" value="0">
        <label for="checkbox"></label>
    </th>
    <th class="line_l">ID</th>
    <th class="line_l">用户名</th>
    <th class="line_l">商品名称</th>
    <th class="line_l">评论时间</th>
    <th class="line_l">评论内容</th>
    <th class="line_l">是否已回复</th>
    <th class="line_l">操作</th>
  </tr>
  <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr overstyle='on' id="list_<?php echo ($vo["id"]); ?>">
        <td><input type="checkbox" name="checkbox" id="checkbox2" onclick="checkon(this)" value="<?php echo ($vo["id"]); ?>"></td>
        <td><?php echo ($vo["id"]); ?></td>
        <td><?php echo ($vo["uname"]); ?></td>
        <td><?php echo (cnsubstr($vo["name"],12)); ?></td>
        <td><?php echo (date("Y-m-d H:i:s",$vo["add_time"])); ?></td>
        <td><?php echo (cnsubstr($vo["comment"],12)); ?></td>
        <td><?php if($vo["deal_time"] > '0'): ?><span style="color:#009900">是</span><?php else: ?><span style="color:#FF0000">否</span><?php endif; ?></td>
        <td>
            <a href="__URL__/edit?id=<?php echo ($vo["id"]); ?>">修改/回复</a>  
            <a href="javascript:void(0);" onclick="del_c(<?php echo ($vo['id']); ?>);">删除</a>  
        </td>
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
  </table>

  </div>
  
  <div class="Toolbar_inbox">
  	<div class="page right"><?php echo ($pagebar); ?></div>
    <a onclick="del();" class="btn_a" href="javascript:void(0);"><span>删除评论</span></a>
  </div>
</div>
<script type="text/javascript">
function showurl(url,Title){
	ui.box.load(url, {title:Title});
}

function del_c(aid) {

	if(!confirm("删除后不可恢复，确定要删除吗?")) return;
	aid = aid ? aid : getChecked();
	aid = aid.toString();
	if(aid == '') return false;

	//提交修改
	var datas = {'idarr':aid};
	$.post(delUrl, datas, delResponseF,'json');
    }
	
	
	function delResponseF(res){
				if(res.success == '0') {
					ui.error('删除失败');
				}else {
					aid = res.data.split(',');
		            $.each(aid, function(i,n){
		              	$('#list_'+n).remove();
		            });
					
					ui.success('删除成功!');
					
				}
	}
</script>

<script type="text/javascript" src="__ROOT__/Style/A/js/adminbase.js"></script>
</body>
</html>