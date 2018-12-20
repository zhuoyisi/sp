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
	var searchName = "搜索操作日志";
</script>
<div class="so_main">
  <div class="page_tit">后台操作日志</div>
<!--搜索/筛选会员-->
    <div id="search_div" style="display:none">
  	<div class="page_tit"><script type="text/javascript">document.write(searchName);</script> [ <a href="javascript:void(0);" onclick="dosearch();">隐藏</a> ]</div>
	
	<div class="form2">
	<form method="get" action="__URL__/adminlog">
    <dl class="lineD">
      <dt>用户ID：</dt>
      <dd>
        <input name="id" style="width:190px" id="title" type="text" value="<?php echo ($search["id"]); ?>">
        <span>不填则不限制</span>
      </dd>
    </dl>
  
    <dl class="lineD">
      <dt>操作者IP：</dt>
      <dd>
      <input name="deal_ip" style="width:190px" id="title" type="text" value="<?php echo ($search["deal_ip"]); ?>">
        <span>不填则不限制</span>
      </dd>
    </dl>
	<dl class="lineD"><dt>操作时间(开始)：</dt><dd><input onclick="WdatePicker({maxDate:'#F{$dp.$D(\'end_time\')||\'2300-10-01\'}',dateFmt:'yyyy-MM-dd HH:mm:ss',alwaysUseStartDate:true});" name="start_time" id="start_time"  class="input Wdate" type="text" value="<?php echo (mydate('Y-m-d H:i:s',$search["start_time"])); ?>"><span id="tip_start_time" class="tip">只选开始时间则查询从开始时间往后所有</span></dd></dl>
	<dl class="lineD"><dt>操作时间(结束)：</dt><dd><input onclick="WdatePicker({minDate:'#F{$dp.$D(\'start_time\')}',maxDate:'2300-10-01',dateFmt:'yyyy-MM-dd HH:mm:ss',alwaysUseStartDate:true});" name="end_time" id="end_time"  class="input Wdate" type="text" value="<?php echo (mydate('Y-m-d H:i:s',$search["end_time"])); ?>"><span id="tip_end_time" class="tip">只选结束时间则查询从结束时间往前所有</span></dd></dl>

    <div class="page_btm">
      <input type="submit" class="btn_b" value="确定" />
    </div>
	</form>
  </div>
  </div>
<!--搜索/筛选会员-->
  <div class="Toolbar_inbox">
  	<div class="page right"><?php echo ($pagebar); ?></div>
    <a onclick="dosearch();" class="btn_a" href="javascript:void(0);"><span class="search_action">搜索操作日志</span></a>
	<a onclick="del_log();" class="btn_a" href="javascript:void(0);"><span>删除操作日志</span></a>
	<a class="btn_a" href="__URL__/dodellogone"><span>删除一月前操作日志</span></a>
  </div>
  
  <div class="list">
  <table id="Log_list" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th style="width:30px;">
        <input type="checkbox" id="checkbox_handle" onclick="checkAll(this)" value="0">
        <label for="checkbox"></label>
    </th>
    <th class="line_l">ID</th>
    <th class="line_l">操作者</th>
    <th class="line_l">操作类型</th>
	<th class="line_l">操作时间</th>
    <th class="line_l">操作者IP</th>
    <th class="line_l">备注信息</th>
	<th class="line_l">操作</th>
  </tr>
  <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr overstyle='on' id="Log_<?php echo ($vo["id"]); ?>">
        <td><input type="checkbox" name="checkbox" id="checkbox2" onclick="checkon(this)" value="<?php echo ($vo["id"]); ?>"></td>
        <td><?php echo ($vo["id"]); ?></td>
        <td><?php echo ($vo["deal_user"]); ?></td>
        <td><?php echo ($vo["type"]); ?></td>
        <td><?php echo (date("Y-m-d H:i:s",$vo["deal_time"])); ?></td>
        <td><?php echo ($vo["deal_ip"]); ?></td>
        <td><?php echo ($vo["deal_info"]); ?></td>
		<td> 
		 	<a href="javascript:void(0);" onclick="del_log(<?php echo ($vo['id']); ?>);">删除</a>  
		</td>
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
  </table>

  </div>
  
  <div class="Toolbar_inbox">
  	<div class="page right"><?php echo ($pagebar); ?></div>
    <a onclick="dosearch();" class="btn_a" href="javascript:void(0);"><span class="search_action">搜索操作日志</span></a>
	<a onclick="del_log();" class="btn_a" href="javascript:void(0);"><span>删除操作日志</span></a>
	<a class="btn_a" href="__URL__/dodellogone"><span>删除一月前操作日志</span></a>
  </div>
</div>
<script type="text/javascript">
	var type = '<?php echo ($type); ?>';
    //删除
    function del_log(aid){ 
        aid = aid ? aid : getChecked();
        aid = aid.toString();
        if(aid == '') return false;
		//alert(aid);
		//提交修改
		var datas = {'idarr':aid,'type':type};
		$.post('__URL__/dodeletelog', datas,delResponseL,'json');
    }
	
	function delResponseL(res){
				if(res.success == '0') {
					ui.error('删除失败');
				}else {
					aid = res.aid.split(',');
					$.each(aid,function(i,n){
						$('#Log_'+n).remove();
					});
					ui.success('删除成功');
				}
	}	
    //鼠标移动表格效果
    $(document).ready(function(){
        $("tr[overstyle='on']").hover(
          function () {
            $(this).addClass("bg_hover");
          },
          function () {
            $(this).removeClass("bg_hover");
          }
        );
    });
    
    function checkon(o){
        if( o.checked == true ){
            $(o).parents('tr').addClass('bg_on') ;
        }else{
            $(o).parents('tr').removeClass('bg_on') ;
        }
    }
    
    function checkAll(o){
        if( o.checked == true ){
            $('input[name="checkbox"]').attr('checked','true');
            $('tr[overstyle="on"]').addClass("bg_on");
        }else{
            $('input[name="checkbox"]').removeAttr('checked');
            $('tr[overstyle="on"]').removeClass("bg_on");
        }
    }

    //获取已选择用户的ID数组
    function getChecked() {
        var gids = new Array();
        $.each($('input:checked'), function(i, n){
            gids.push($(n).val());
        });
        return gids;
    }
</script>
<script type="text/javascript" src="__ROOT__/Style/A/js/adminbase.js"></script>
</body>
</html>