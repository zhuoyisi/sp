<?php if (!defined('THINK_PATH')) exit();?>
<table cellspacing="0" cellpadding="0" id="formTb" style="width: 100%; float: left; margin: 0px;padding: 0px; border-collapse: collapse; text-align: left;">
	<tbody><tr class="trBg">
		<td class="tdTitle">
			月均收入：
		</td>
		<td class="tdContent">
				<input name="fin_monthin" id="fin_monthin"  class="input text2" type="text" value="<?php echo ($vo["fin_monthin"]); ?>" onblur="NumberCheck(this);"><span id="tip_fin_monthin" class="tip">请填写数字，如：5000</span>
		</td>
		<td id="dv_monthin" class="tdTip">
		</td>
	</tr>
	<tr>
		<td class="tdTitle">
			收入构成描述：
		</td>
		<td style="height: 100px;" class="tdContent">
			<textarea name="fin_incomedes" id="fin_incomedes" style="height:80px;width:423px;" class="areabox textarea1" ><?php echo ($vo["fin_incomedes"]); ?></textarea>
		</td>
		<td id="dv_incomedes" class="tdTip">
		</td>
	</tr>
	<tr class="trBg">
		<td class="tdTitle">
			月均支出：
		</td>
		<td class="tdContent">
				<input name="fin_monthout" id="fin_monthout"  class="input text2" type="text" value="<?php echo ($vo["fin_monthout"]); ?>" >
		</td>
		<td id="dv_monthout" class="tdTip">
		</td>
	</tr>
	<tr>
		<td class="tdTitle">
			支出构成描述：
		</td>
		<td style="height: 100px;" class="tdContent">
			<textarea name="fin_outdes" id="fin_outdes" style="height:80px;width:423px;" class="areabox textarea1" ><?php echo ($vo["fin_outdes"]); ?></textarea>
		</td>
		<td id="dv_outdes" class="tdTip">
		</td>
	</tr>
	<tr class="trBg">
		<td class="tdTitle">
			住房条件：
		</td>
		<td class="tdContent">
			<?php $i=0;$___KEY=array ( '有商品房' => '有商品房', '有其他（非商品房）' => '有其他（非商品房）', '无房' => '无房', ); foreach($___KEY as $k=>$v){ if(strlen("1key")==1 && $i==0){ ?><input type="radio" name="fin_house" value="<?php echo ($k); ?>" id="fin_house_<?php echo ($i); ?>" checked="checked" /><?php }elseif(("key1"=="key1"&&$vo["fin_house"]==$k)||("key"=="value"&&$vo["fin_house"]==$v)){ ?><input type="radio" name="fin_house" value="<?php echo ($k); ?>" id="fin_house_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="fin_house" value="<?php echo ($k); ?>" id="fin_house_<?php echo ($i); ?>" /><?php } ?><label for="fin_house_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++; } ?>
		</td>
		<td id="dv_house" class="tdTip">
		</td>
	</tr>
	<tr>
		<td class="tdTitle">
			房产价值：
		</td>
		<td class="tdContent">
				<input name="fin_housevalue" id="fin_housevalue"  class="input text2" type="text" value="<?php echo ($vo["fin_housevalue"]); ?>" >
		</td>
		<td id="dv_housevalue" class="tdTip">
		</td>
	</tr>
	<tr class="trBg">
		<td class="tdTitle">
			是否购车：
		</td>
		<td class="tdContent">
			<?php $i=0;$___KEY=array ( '是' => '是', '否' => '否', ); foreach($___KEY as $k=>$v){ if(strlen("1key")==1 && $i==0){ ?><input type="radio" name="fin_car" value="<?php echo ($k); ?>" id="fin_car_<?php echo ($i); ?>" checked="checked" /><?php }elseif(("key1"=="key1"&&$vo["fin_car"]==$k)||("key"=="value"&&$vo["fin_car"]==$v)){ ?><input type="radio" name="fin_car" value="<?php echo ($k); ?>" id="fin_car_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="fin_car" value="<?php echo ($k); ?>" id="fin_car_<?php echo ($i); ?>" /><?php } ?><label for="fin_car_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++; } ?>
		</td>
		<td id="dv_car" class="tdTip">
		</td>
	</tr>
	<tr>
		<td class="tdTitle">
			车辆价值：
		</td>
		<td class="tdContent">
				<input name="fin_carvalue" id="fin_carvalue"  class="input text2" type="text" value="<?php echo ($vo["fin_carvalue"]); ?>" >
		</td>
		<td id="dv_carvalue" class="tdTip">
		</td>
	</tr>
	<tr class="trBg">
		<td class="tdTitle">
			参股企业名称：
		</td>
		<td class="tdContent">
				<input name="fin_stockcompany" id="fin_stockcompany"  class="input text2" type="text" value="<?php echo ($vo["fin_stockcompany"]); ?>" >
		</td>
		<td id="dv_StockCompany" class="tdTip">
		</td>
	</tr>
	<tr>
		<td class="tdTitle">
			参股企业出资额：
		</td>
		<td class="tdContent">
				<input name="fin_stockcompanyvalue" id="fin_stockcompanyvalue"  class="input text2" type="text" value="<?php echo ($vo["fin_stockcompanyvalue"]); ?>" >
		</td>
		<td id="dv_StockCompanyValue" class="tdTip">
		</td>
	</tr>
	<tr class="trBg">
		<td class="tdTitle">
			其他资产描述：
		</td>
		<td style="height: 100px;" class="tdContent">
			<textarea name="fin_otheremark" id="fin_otheremark" style="height:80px;width:423px;" class="areabox textarea1" ><?php echo ($vo["fin_otheremark"]); ?></textarea>
		</td>
		<td id="dv_otheremark" class="tdTip">
		</td>
	</tr>
	<tr>
		<td>&nbsp;
			
		</td>
		<td style="height: 50px;">
				<img style="margin-top: 5px; cursor: pointer;" src="__ROOT__/Style/M/images/saveandcon.jpg" onmouseout="this.style.filter = 'alpha(opacity=100)'" onmousemove="this.style.filter = 'alpha(opacity=60)'; this.style.cursor='hand' " onclick="editfinancial();">
				 <a href="javascript:;" onclick="window.location.href='/member/memberinfo#fragment-5';window.location.reload();"><img src="__ROOT__/Style/M/images/skipandcon.jpg" style="border:none; margin:5px 0 0 20px;"></a>
		</td>
		<td id="xx" class="tdTip">
		</td>
	</tr>
</tbody></table>
<script type="text/javascript">
function editfinancial(){
	p = makevar(['fin_monthin','fin_incomedes','fin_monthout','fin_outdes','fin_house','fin_housevalue','fin_car','fin_carvalue','fin_stockcompany','fin_stockcompanyvalue','fin_otheremark']);
	p['_tps'] = "post";
	var mxs = true;
	$.each(p,function(i){
		if(typeof p[i] == "undefined"){
			mxs=false;
			$.jBox.tip("所有项目都不能为空");	
		}
	});
	if(mxs===false){
	  $.jBox.tip("所有项目都不能为空");	
	  return;
	}
	$.jBox.tip('提交中......','tip');
	$.ajax({
		url: "__URL__/editfinancial/",
		data: p,
		timeout: 5000,
		cache: false,
		type: "post",
		dataType: "json",
		success: function (d, s, r) {
			if(d){
				if(d.status==1){
					$.jBox.tip(d.message,'success');
					setTimeout('window.location.href="/member/memberinfo#fragment-5";window.location.reload();',1000);
				}
				else  $.jBox.tip(d.message,'fail');
			}
		}
	});
}
</script>