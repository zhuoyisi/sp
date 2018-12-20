<?php if (!defined('THINK_PATH')) exit();?>
<style type="text/css">
.dv_header_8{background-image: url();}
.dv_account_0{margin-top:10px;}
.tdHeard{border:0px;border-bottom:1px solid #dedede;border-top:1px solid #dedede;}
.tdContent{border:0px; border-bottom:1px solid #dedede; height:32px;}
td.xffe{text-align:center; padding:0px}
td.tdContent,th.tdHeard{width:auto}
</style>
<table cellspacing="0" cellpadding="0" id="formTb" style="width: 100%; float: left; margin: 0px;padding: 0px; border-collapse: collapse; text-align: left;">
		<tbody>
        <tr class="trBg">
			<td class="tdTitle">
				申请类型：
			</td>
			<td class="tdContent">
				<?php $i=0;foreach($aType as $k=>$v){ if($i==0){ ?><input type="radio" name="apply_type" value="<?php echo ($k); ?>" id="apply_type_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="apply_type" value="<?php echo ($k); ?>" id="apply_type_<?php echo ($i); ?>" /><?php } ?><label for="apply_type_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++;} ?>
			</td>
			<td id="dv_company" class="tdTip">
			</td>
		</tr>
        <tr>
			<td class="tdTitle">
				申请金额：
			</td>
			<td class="tdContent">
				<input name="apply_money" id="apply_money"  class="input text2" type="text" value="" >元
			</td>
			<td id="dv_company" class="tdTip">
			</td>
		</tr>
        <tr>
			<td class="tdTitle">
				申请说明：
			</td>
			<td class="tdContent">
				<textarea name="apply_info" id="apply_info" style="height:50px; width:100%" class="areabox text2" ></textarea>
			</td>
			<td id="dv_company" class="tdTip">
			</td>
		</tr>
        <tr>
			<td  colspan="3">
            <a href="javascript:;" onclick="apply();"><img src="__ROOT__/Style/M/images/btnappcheck.gif" style="border:none; margin:10px 0 0 20px;"></a>
            </td>
		</tr>
</tbody>
</table>

<table id="content" style="width: 100%; float: left; margin: 0px;padding: 0px; text-align: left;" cellpadding="0" cellspacing="0">
	<tbody><tr class="trBg tdEven"> 
		<th scope="col" class="tdHeard" style="width: 100px;">
			提交时间
		</th>
		<th scope="col" class="tdHeard" style="width: 100px;">
			申请类型
		</th>
		<th scope="col" class="tdHeard" style="width: 100px;">
			申请金额
		</th>
		<th scope="col" class="tdHeard" style="width: 100px;">
			审核状态
		</th>
		<th scope="col" class="tdHeard" style="width: 100px;">
			处理意见
		</th>
		<th scope="col" class="tdHeard" style="width: 100px;">
			授信额度
		</th>
	</tr>
	<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr><td class="tdContent xffe"><?php echo (date("Y-m-d H:i",$vo["add_time"])); ?></td><td class="tdContent xffe"><?php echo ($aType[$vo['apply_type']]); ?></td><td class="tdContent xffe"><?php echo (fmoney($vo["apply_money"])); ?></td><td class="tdContent xffe"><?php echo ($vo["status"]); ?></td><td class="tdContent xffe"><?php echo (($vo["deal_info"])?($vo["deal_info"]):"--"); ?></td><td class="tdContent xffe"><?php echo ((fmoney($vo["credit_money"]))?(fmoney($vo["credit_money"])):"0.00"); ?>元</td></tr><?php endforeach; endif; else: echo "" ;endif; ?>
	<tr><td colspan="6"><div id="pager" data="info6" class="yahoo2 ajaxpagebar" style="text-align: right; padding-left:0px; padding-right:0px; height: 36px;width: 100%;text-indent: 0px;"><?php echo ($pagebar); ?></div></td>
</tbody></table>


<script type="text/javascript">
function apply(){
	p = makevar(['apply_type','apply_money','apply_info']);
	p['_tps'] = "post";
	if(typeof p.apply_money =="undefined"){
		$.jBox.tip("申请金额不能为空");
		return;	
	}
	if(typeof p.apply_info =="undefined"){
		$.jBox.tip("申请说明不能为空");
		return;	
	}
	$.jBox.tip('提交中......','loading');
	$.ajax({
		url: "__URL__/apply/",
		data: p,
		timeout: 5000,
		cache: false,
		type: "post",
		dataType: "json",
		success: function (d, s, r) {
			if(d){
				if(d.status==1){
					$.jBox.tip(d.message,'success');
					updatelog();
				}
				else  $.jBox.tip(d.message,'fail');
			}
		}
	});
}
function updatelog(){
        $.ajax({
            url: "__URL__/applylog/",
            data: {},
            timeout: 5000,
            cache: false,
            type: "get",
            dataType: "json",
            success: function (d, s, r) {
              	if(d) $("#info8").html(d.content);//更新客户端竞拍信息 作个判断，避免报错
            }
        });
}

$('.ajaxpagebar a').click(function(){
	try{	
		var geturl = $(this).attr('href');
		var id = $(this).parent().attr('data');
		var x={};
        $.ajax({
            url: geturl,
            data: x,
            timeout: 5000,
            cache: false,
            type: "get",
            dataType: "json",
            success: function (d, s, r) {
              	if(d) $("#"+id).html(d.content);//更新客户端竞拍信息 作个判断，避免报错
            }
        });
	}catch(e){};
	return false;
})
</script>