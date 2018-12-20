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

<style type="text/css">
.alertDiv { margin: 0px auto; background-color: #FEFACF; border: 1px solid green; line-height: 25px; background-image: url(__ROOT__/Style/M/images/info/001_30.png); background-position: 20px 4px; background-repeat: no-repeat; }
.alertDiv li { margin: 5px 0; list-style-type: decimal; color: #005B9F; padding: 0px; line-height: 20px; }
.alertDiv ul { text-align: left; list-style-type: decimal; display: block; padding: 0px; margin: 0px 0px 0px 75px; }
</style>
<div class="so_main">
<div class="page_tit">发标管理</div>
<div class="page_tab">
    <span data="tab_1" class="active">借款用途</span>
    <span data="tab_2" >最小金额</span>
    <span data="tab_3" >最大金额</span>
    <span data="tab_4" >募资时间</span>
    <span data="tab_9" style=" display:none">查询金额</span>
    <span data="tab_11">提现银行</span>
    <span data="tab_12">积分参数</span>
</div>
<div class="form2">
<div class="alertDiv">
	<ul>
		<li>参数新增或者删除操作时，请记住点击下方的确认按钮来提交您的新数据！</li>
		<li>所有参数的修改或者删除操作提交一次即可,修改后请清空数据缓存，以便新参数即时生效！</li>
	</ul>
</div>
	<form method="post" action="__URL__/save" enctype="multipart/form-data">
	<div id="tab_1">
		<div class="Toolbar_inbox">
			<div class="page right"><?php echo ($pagebar); ?></div>
			<a onclick="addone($j=1);" class="btn_a" href="javascript:void(0);"><span>添加一个级别</span></a>
	  </div>
	  <div class="list">
	  <table id="area_listbuse" width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<th style="width:30px;">
			<input type="checkbox" class="checkbox_handle" onclick="checkAll(this)" value="0">
			<label for="checkbox"></label>
		</th>
		<th class="line_l">序号</th>
		<th class="line_l">参数名称</th>
		<th class="line_l">参数值</th>
		<th class="line_l">操作</th>
	  </tr>
	  <?php $a=1; $j=1; $y=0;?>
	   <?php if(is_array($buse)): $key = 0; $__LIST__ = $buse;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;?><tr overstyle='on' id="list_buse<?php echo ($key); ?>">
			<td><input type="checkbox" name="checkbox" class="checkbox2" onclick="checkon(this)" value="<?php echo ($key); ?>"></td>
			<td><?php echo ($a); ?></td>
			<td><input name="borrow[BORROW_USE][<?php echo ($y); ?>]" id="borrow[BORROW_USE][<?php echo ($y); ?>]" style="width:100px" class="input" type="text" value="<?php echo ($key-1); ?>" ><?php $y++; ?></td>
			<td><input name="borrow[BORROW_USE][<?php echo ($y); ?>]" id="borrow[BORROW_USE][<?php echo ($y); ?>]" style="width:100px" class="input" type="text" value="<?php echo ($vo); ?>" ><?php $y++; ?></td>
			
			
			<td>
				<a href="javascript:void(0);" onclick="delxa(<?php echo ($key); ?>);">删除</a>  
			</td>
		  </tr>
		<?php $a++; endforeach; endif; else: echo "" ;endif; ?>
	  
	  </table>
</div>

	</div><!--tab1-->
	<div id="tab_2" style="display:none">
		<div class="Toolbar_inbox">
			<div class="page right"><?php echo ($pagebar); ?></div>
			<a onclick="addone($j=2);" class="btn_a" href="javascript:void(0);"><span>添加一个级别</span></a>
	  </div>
	  <div class="list">
	  <table id="area_listbmin" width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<th style="width:30px;">
			<input type="checkbox" class="checkbox_handle" onclick="checkAll(this)" value="0">
			<label for="checkbox"></label>
		</th>
		<th class="line_l">序号</th>
		<th class="line_l">参数名称</th>
		<th class="line_l">参数值</th>
		<th class="line_l">操作</th>
	  </tr>
	  <?php $b=1; $j=2;?>
	   <?php if(is_array($bmin )): $i = 0; $__LIST__ = $bmin ;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr overstyle='on' id="list_bmin<?php echo ($key); ?>">
			<td><input type="checkbox" name="checkbox" class="checkbox2" onclick="checkon(this)" value="<?php echo ($key); ?>"></td>
			<td><?php echo ($b); ?></td>
			<td><input type="text" style="width:100px" name="borrow[BORROW_MIN][]" value="<?php echo ($key); ?>" /></td>
			<td><input type="text" style="width:100px" name="borrow[BORROW_MIN][]" value="<?php echo ($vo); ?>" /></td>
			
			
			<td>
				<a href="javascript:void(0);" onclick="delxb(<?php echo ($key); ?>);">删除</a>  
			</td>
		  </tr>
		<?php $b++; endforeach; endif; else: echo "" ;endif; ?>
	  
	  </table>
</div>

	</div><!--tab2-->
	<div id="tab_3"  style="display:none">
		<div class="Toolbar_inbox">
			<div class="page right"><?php echo ($pagebar); ?></div>
			<a onclick="addone($j=3);" class="btn_a" href="javascript:void(0);"><span>添加一个级别</span></a>
	  </div>
	  <div class="list">
	  <table id="area_listbmax" width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<th style="width:30px;">
			<input type="checkbox" class="checkbox_handle" onclick="checkAll(this)" value="0">
			<label for="checkbox"></label>
		</th>
		<th class="line_l">序号</th>
		<th class="line_l">参数名称</th>
		<th class="line_l">参数值</th>
		<th class="line_l">操作</th>
	  </tr>
	  <?php $c=1; $j=3; ?>
	   <?php if(is_array($bmax )): $i = 0; $__LIST__ = $bmax ;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr overstyle='on' id="list_bmax<?php echo ($key); ?>">
			<td><input type="checkbox" name="checkbox" id="checkbox2" onclick="checkon(this)" value="<?php echo ($key); ?>"></td>
			<td><?php echo ($c); ?></td>
			<td><input type="text" style="width:100px" name="borrow[BORROW_MAX][]" value="<?php echo ($key); ?>" /></td>
			<td><input type="text" style="width:100px" name="borrow[BORROW_MAX][]" value="<?php echo ($vo); ?>" /></td>
			
			
			<td>
				<a href="javascript:void(0);" onclick="delxc(<?php echo ($key); ?>);">删除</a>  
			</td>
		  </tr>
		<?php $c++; endforeach; endif; else: echo "" ;endif; ?>
	  
	  </table>
</div>

	</div><!--tab3-->
	<div id="tab_4"  style="display:none">
		<div class="Toolbar_inbox">
			<div class="page right"><?php echo ($pagebar); ?></div>
			<a onclick="addone($j=4);" class="btn_a" href="javascript:void(0);"><span>添加一个级别</span></a>
	  </div>
	  <div class="list">
	  <table id="area_listbtime" width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<th style="width:30px;">
			<input type="checkbox" class="checkbox_handle" onclick="checkAll(this)" value="0">
			<label for="checkbox"></label>
		</th>
		<th class="line_l">序号</th>
		<th class="line_l">参数名称</th>
		<th class="line_l">参数值</th>
		<th class="line_l">操作</th>
	  </tr>
	  <?php $d=1; $j=4; ?>
	   <?php if(is_array($btime )): $i = 0; $__LIST__ = $btime ;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr overstyle='on' id="list_btime<?php echo ($key); ?>">
			<td><input type="checkbox" name="checkbox" id="checkbox2" onclick="checkon(this)" value="<?php echo ($key); ?>"></td>
			<td><?php echo ($d); ?></td>
			<td><input type="text" style="width:100px" name="borrow[BORROW_TIME][]" value="<?php echo ($key); ?>" /></td>
			<td><input type="text" style="width:100px" name="borrow[BORROW_TIME][]" value="<?php echo ($vo); ?>" /></td>
			
			
			<td>
				<a href="javascript:void(0);" onclick="delxd(<?php echo ($key); ?>);">删除</a>  
			</td>
		  </tr>
		<?php $d++; endforeach; endif; else: echo "" ;endif; ?>
	  
	  </table>
</div>

	</div><!--tab4-->
	
	<div id="tab_9"  style="display:none">
		<div class="Toolbar_inbox">
			<div class="page right"><?php echo ($pagebar); ?></div>
			<a onclick="addone($j=9);" class="btn_a" href="javascript:void(0);"><span>添加一个级别</span></a>
	  </div>
	  <div class="list">
	  <table id="area_listbsearch" width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<th style="width:30px;">
			<input type="checkbox" class="checkbox_handle" onclick="checkAll(this)" value="0">
			<label for="checkbox"></label>
		</th>
		<th class="line_l">序号</th>
		<th class="line_l">参数名称</th>
		<th class="line_l">参数值</th>
		<th class="line_l">操作</th>
	  </tr>
	  <?php $n=1; $j=9;?>
	   <?php if(is_array($bsearch)): $i = 0; $__LIST__ = $bsearch;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr overstyle='on' id="list_bsearch<?php echo ($key); ?>">
			<td><input type="checkbox" name="checkbox" id="checkbox2" onclick="checkon(this)" value="<?php echo ($key); ?>"></td>
			<td><?php echo ($n); ?></td>
			<td><input type="text" style="width:100px" name="borrow[MONEY_SEARCH][]" value="<?php echo ($key); ?>" /></td>
			<td><input type="text" style="width:100px" name="borrow[MONEY_SEARCH][]" value="<?php echo ($vo); ?>" /></td>
			
			
			<td>
				<a href="javascript:void(0);" onclick="delxn(<?php echo ($key); ?>);">删除</a>  
			</td>
		  </tr>
		<?php $n++; endforeach; endif; else: echo "" ;endif; ?>
	  
	  </table>
</div>

	</div><!--tab9-->
	
	<div id="tab_11"  style="display:none">
		<div class="Toolbar_inbox">
			<div class="page right"><?php echo ($pagebar); ?></div>
			<a onclick="addone($j=11);" class="btn_a" href="javascript:void(0);"><span>添加一个级别</span></a>
	  </div>
	  <div class="list">
	  <table id="area_listbbankname" width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<th style="width:30px;">
			<input type="checkbox" class="checkbox_handle" onclick="checkAll(this)" value="0" >
			<label for="checkbox"></label>
		</th>
		<th class="line_l">序号</th>
		<th class="line_l">参数名称</th>
		<th class="line_l">参数值</th>
		<th class="line_l">操作</th>
	  </tr>
	  <?php $p=1; $j=11;?>
	   <?php if(is_array($bbankname)): $i = 0; $__LIST__ = $bbankname;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr overstyle='on' id="list_bbankname<?php echo ($p); ?>">
			<td><input type="checkbox" name="checkbox" id="checkbox2" onclick="checkon(this)" value="<?php echo ($key); ?>"></td>
			<td><?php echo ($p); ?></td>
			<td><input type="text" style="width:100px" name="borrow[BANK_NAME][]" value="<?php echo ($key); ?>" /></td>
			<td><input type="text" style="width:100px" name="borrow[BANK_NAME][]" value="<?php echo ($vo); ?>" /></td>
			
			
			<td>
				<a href="javascript:void(0);" onclick="delxp(<?php echo ($p); ?>);">删除</a>  
			</td>
		  </tr>
		 <?php $p++; endforeach; endif; else: echo "" ;endif; ?>
	 
	  </table>
</div>

	</div><!--tab11-->
    <!--积分参数开始-->
<div id="tab_12"  style="display:none">
        <div class="Toolbar_inbox">
            <div class="page right"><?php echo ($pagebar); ?></div>
            <a onclick="addone($j=12);" class="btn_a" href="javascript:void(0);"><span>添加一个级别</span></a>
      </div>
      <div class="list">
      <table id="area_integration" width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <th style="width:30px;">
            <input type="checkbox" class="checkbox_handle" onclick="checkAll(this)" value="0" >
            <label for="checkbox"></label>
        </th>
        <th class="line_l">序号</th>
        <th class="line_l">参数名称</th>
        <th class="line_l">积分值</th>
        <th class="line_l">描述</th>
        <th class="line_l">操作</th>
      </tr>
      <?php $p=1; $j=12;?>
       <?php if(is_array($integration)): $i = 0; $__LIST__ = $integration;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr overstyle='on' id="list_bbankname<?php echo ($p); ?>">
            <td><input type="checkbox" name="checkbox" id="checkbox2" onclick="checkon(this)" value="<?php echo ($key); ?>"></td>
            <td><?php echo ($p); ?></td>
            <td><input type="text" style="width:100px" name="integration[parameter][]" value="<?php echo ($key); ?>" /></td>
            <td><input type="text" style="width:100px" name="integration[fraction][]" value="<?php echo ($vo["fraction"]); ?>" /></td>
            
            <td><input type="text" style="width:100px" name="integration[description][]" value="<?php echo ($vo["description"]); ?>" /></td>
            <td>
                <a href="javascript:void(0);" onclick="delxp(<?php echo ($p); ?>);">删除</a>  
            </td>
          </tr>
         <?php $p++; endforeach; endif; else: echo "" ;endif; ?>
     
      </table>
</div>

    </div>
    <!--tab12-->
<div class="page_btm"><input type="submit" class="btn_b" value="确定" />
	</div>
	</form>
</div>


</div>
<script type="text/javascript">

	
	var xssa=parseInt(<?php echo ($a); ?>)||0;
	var xssb=parseInt(<?php echo ($b); ?>)||0;
	var xssc=parseInt(<?php echo ($c); ?>)||0;
	var xssd=parseInt(<?php echo ($d); ?>)||0;
	/*var xsse=parseInt(<?php echo ($e); ?>)||0;
	var xssf=parseInt(<?php echo ($f); ?>)||0;
	var xssg=parseInt(<?php echo ($g); ?>)||0;
	var xssm=parseInt(<?php echo ($m); ?>)||0;*/
	var xssn=parseInt(<?php echo ($n); ?>)||0;
	var xsso=parseInt(<?php echo ($o); ?>)||0;
	var xssp=parseInt(<?php echo ($p); ?>)||0;
function addone($j){

	
	switch($j){
		case 1:
		
	var htmladd = '<tr overstyle="on" id="list_buse'+xssa+'">';
		htmladd += '<td><input type="checkbox" name="checkbox" class="checkbox2" onclick="checkon(this)" value="'+xssa+'"></td>';
		htmladd += '<td>'+xssa+'</td>';
		htmladd += '<td><input type="text" style="width:100px" name="borrow[BORROW_USE][] value="" /></td>';
		htmladd += '<td><input type="text" style="width:100px" name="borrow[BORROW_USE][]" value="" /></td>';
		
		htmladd += '<td><a href="javascript:void(0);" onclick="delxa('+xssa+');">删除</a></td>';
		htmladd += '</tr>';	
	$(htmladd).appendTo("#area_listbuse");
	xssa++;
		break;
		case 2:
		
		htmladd = '<tr overstyle="on" id="list_bmin'+xssb+'">';
		htmladd += '<td><input type="checkbox" name="checkbox" class="checkbox2" onclick="checkon(this)" value="'+xssb+'"></td>';
		htmladd += '<td>'+xssb+'</td>';
		htmladd += '<td><input type="text" style="width:100px" name="borrow[BORROW_MIN][]" value="" /></td>';
		htmladd += '<td><input type="text" style="width:100px" name="borrow[BORROW_MIN][]" value="" /></td>';
		
		htmladd += '<td><a href="javascript:void(0);" onclick="delxb('+xssb+');">删除</a></td>';
		htmladd += '</tr>';	
	$(htmladd).appendTo("#area_listbmin");
	xssb++;
		break;
		case 3:
		
		htmladd = '<tr overstyle="on" id="list_bmax'+xssc+'">';
		htmladd += '<td><input type="checkbox" name="checkbox" class="checkbox2" onclick="checkon(this)" value="'+xssc+'"></td>';
		htmladd += '<td>'+xssc+'</td>';
		htmladd += '<td><input type="text" style="width:100px" name="borrow[BORROW_MAX][]" value="" /></td>';
		htmladd += '<td><input type="text" style="width:100px" name="borrow[BORROW_MAX][]" value="" /></td>';
		
		htmladd += '<td><a href="javascript:void(0);" onclick="delxc('+xssc+');">删除</a></td>';
		htmladd += '</tr>';	
	$(htmladd).appendTo("#area_listbmax");
	xssc++;
		break;
		case 4:
		
		htmladd = '<tr overstyle="on" id="list_btime'+xssd+'">';
		htmladd += '<td><input type="checkbox" name="checkbox" class="checkbox2" onclick="checkon(this)" value="'+xssd+'"></td>';
		htmladd += '<td>'+xssd+'</td>';
		htmladd += '<td><input type="text" style="width:100px" name="borrow[BORROW_TIME][]" value="" /></td>';
		htmladd += '<td><input type="text" style="width:100px" name="borrow[BORROW_TIME][]" value="" /></td>';
		
		htmladd += '<td><a href="javascript:void(0);" onclick="delxd('+xssd+');">删除</a></td>';
		htmladd += '</tr>';	
	$(htmladd).appendTo("#area_listbtime");
	xssd++;
		break;
		/*case 5:
		
		htmladd = '<tr overstyle="on" id="list_bmax'+xsse+'">';
		htmladd += '<td><input type="checkbox" name="checkbox" class="checkbox2" onclick="checkon(this)" value="'+xsse+'"></td>';
		htmladd += '<td>'+xsse+'</td>';
		htmladd += '<td><input type="text" style="width:100px" name="borrow[REPAYMENT_TYPE][]" value="" /></td>';
		htmladd += '<td><input type="text" style="width:100px" name="borrow[REPAYMENT_TYPE][]" value="" /></td>';
		
		htmladd += '<td><a href="javascript:void(0);" onclick="delxe('+xsse+');">删除</a></td>';
		htmladd += '</tr>';	
	$(htmladd).appendTo("#area_listbrepa");
	xsse++;
		break;
		case 6:
		
		htmladd = '<tr overstyle="on" id="list_bmax'+xssf+'">';
		htmladd += '<td><input type="checkbox" name="checkbox" class="checkbox2" onclick="checkon(this)" value="'+xssf+'"></td>';
		htmladd += '<td>'+xssf+'</td>';
		htmladd += '<td><input type="text" style="width:100px" name="borrow[BORROW_TYPE][]" value="" /></td>';
		htmladd += '<td><input type="text" style="width:100px" name="borrow[BORROW_TYPE][]" value="" /></td>';
		
		htmladd += '<td><a href="javascript:void(0);" onclick="delxf('+xssf+');">删除</a></td>';
		htmladd += '</tr>';	
	$(htmladd).appendTo("#area_listbtype");
	xssf++;
		break;
		case 7:
		
		htmladd = '<tr overstyle="on" id="list_bmax'+xssg+'">';
		htmladd += '<td><input type="checkbox" name="checkbox" class="checkbox2" onclick="checkon(this)" value="'+xssg+'"></td>';
		htmladd += '<td>'+xssg+'</td>';
		htmladd += '<td><input type="text" style="width:100px" name="borrow[IS_REWARD][]" value="" /></td>';
		htmladd += '<td><input type="text" style="width:100px" name="borrow[IS_REWARD][]" value="" /></td>';
		
		htmladd += '<td><a href="javascript:void(0);" onclick="delxg('+xssg+');">删除</a></td>';
		htmladd += '</tr>';	
	$(htmladd).appendTo("#area_listbreward");
	xssg++;
		break;
		case 8:
		
		htmladd = '<tr overstyle="on" id="list_bmax'+xssm+'">';
		htmladd += '<td><input type="checkbox" name="checkbox" class="checkbox2" onclick="checkon(this)" value="'+xssm+'"></td>';
		htmladd += '<td>'+xssm+'</td>';
		htmladd += '<td><input type="text" style="width:100px" name="borrow[BORROW_STATUS][]" value="" /></td>';
		htmladd += '<td><input type="text" style="width:100px" name="borrow[BORROW_STATUS][]" value="" /></td>';
		
		htmladd += '<td><a href="javascript:void(0);" onclick="delxm('+xssm+');">删除</a></td>';
		htmladd += '</tr>';	
	$(htmladd).appendTo("#area_listbstatus");
	xssm++;
		break;*/
		case 9:
		
		htmladd = '<tr overstyle="on" id="list_bmax'+xssn+'">';
		htmladd += '<td><input type="checkbox" name="checkbox" class="checkbox2" onclick="checkon(this)" value="'+xssn+'"></td>';
		htmladd += '<td>'+xssn+'</td>';
		htmladd += '<td><input type="text" style="width:100px" name="borrow[MONEY_SEARCH][]" value="" /></td>';
		htmladd += '<td><input type="text" style="width:100px" name="borrow[MONEY_SEARCH][]" value="" /></td>';
		
		htmladd += '<td><a href="javascript:void(0);" onclick="delxn('+xssn+');">删除</a></td>';
		htmladd += '</tr>';	
	$(htmladd).appendTo("#area_listbsearch");
	xssn++;
		break;
		
		
		case 10:
		
		htmladd = '<tr overstyle="on" id="list_bmax'+xsso+'">';
		htmladd += '<td><input type="checkbox" name="checkbox" class="checkbox2" onclick="checkon(this)" value="'+xsso+'"></td>';
		htmladd += '<td>'+xsso+'</td>';
		htmladd += '<td><input type="text" style="width:100px" name="borrow[DATA_TYPE][]" value="" /></td>';
		htmladd += '<td><input type="text" style="width:100px" name="borrow[DATA_TYPE][]" value="" /></td>';
		
		htmladd += '<td><a href="javascript:void(0);" onclick="delxo('+xsso+');">删除</a></td>';
		htmladd += '</tr>';	
	$(htmladd).appendTo("#area_listbdatatype");
	xsso++;
		break;

	   case 11:
		
		htmladd = '<tr overstyle="on" id="list_bbankname'+xssp+'">';
		htmladd += '<td><input type="checkbox" name="checkbox" class="checkbox2" onclick="checkon(this)" value="'+xssp+'"></td>';
		htmladd += '<td>'+xssp+'</td>';
		htmladd += '<td><input type="text" style="width:100px" name="borrow[BANK_NAME][]" value="" /></td>';
		htmladd += '<td><input type="text" style="width:100px" name="borrow[BANK_NAME][]" value="" /></td>';
		
		htmladd += '<td><a href="javascript:void(0);" onclick="delxp('+xssp+');">删除</a></td>';
		htmladd += '</tr>';	
	$(htmladd).appendTo("#area_listbbankname");
	xssp++;
		break;
        
        case 12:
        
        htmladd = '<tr overstyle="on" id="list_bbankname'+xssp+'">';
        htmladd += '<td><input type="checkbox" name="checkbox" class="checkbox2" onclick="checkon(this)" value="'+xssp+'"></td>';
        htmladd += '<td>'+xssp+'</td>';
        htmladd += '<td><input type="text" style="width:100px" name="integration[parameter][]" value="" /></td>';
        htmladd += '<td><input type="text" style="width:100px" name="integration[fraction][]" value="" /></td>';
        htmladd += '<td><input type="text" style="width:100px" name="integration[description][]" value="" /></td>';
        htmladd += '<td><a href="javascript:void(0);" onclick="delxp('+xssp+');">删除</a></td>';
        htmladd += '</tr>';    
        $(htmladd).appendTo("#area_integration");
        xssp++;
        break;
	}
		
}
function delxa(id){
	if(confirm("删除后不可恢复，并且删除完要确定保存后才会生产，确定要删除吗?")) $("#list_buse"+id).remove();
}
function delxb(id){
	if(confirm("删除后不可恢复，并且删除完要确定保存后才会生产，确定要删除吗?")) $("#list_bmin"+id).remove();
}
function delxc(id){
	if(confirm("删除后不可恢复，并且删除完要确定保存后才会生产，确定要删除吗?")) $("#list_bmax"+id).remove();
}
function delxd(id){
	if(confirm("删除后不可恢复，并且删除完要确定保存后才会生产，确定要删除吗?")) $("#list_btime"+id).remove();
}
/*function delxe(id){
	if(confirm("删除后不可恢复，并且删除完要确定保存后才会生产，确定要删除吗?")) $("#list_brepa"+id).remove();
}
function delxf(id){
	if(confirm("删除后不可恢复，并且删除完要确定保存后才会生产，确定要删除吗?")) $("#list_btype"+id).remove();
}
function delxg(id){
	if(confirm("删除后不可恢复，并且删除完要确定保存后才会生产，确定要删除吗?")) $("#list_breward"+id).remove();
}
function delxm(id){
	if(confirm("删除后不可恢复，并且删除完要确定保存后才会生产，确定要删除吗?")) $("#list_bstatus"+id).remove();
}*/
function delxn(id){
	if(confirm("删除后不可恢复，并且删除完要确定保存后才会生产，确定要删除吗?")) $("#list_bsearch"+id).remove();
}
function delxo(id){
	if(confirm("删除后不可恢复，并且删除完要确定保存后才会生产，确定要删除吗?")) $("#list_bdatatype"+id).remove();
}
function delxp(id){
	if(confirm("删除后不可恢复，并且删除完要确定保存后才会生产，确定要删除吗?")) $("#list_bbankname"+id).remove();
}
</script>
<script type="text/javascript" src="__ROOT__/Style/A/js/adminbase.js"></script>
</body>
</html>