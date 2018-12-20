<?php if (!defined('THINK_PATH')) exit();?>
<table cellspacing="0" cellpadding="0" id="formTb" style="width: 100%; float: left; margin: 0px;padding: 0px; border-collapse: collapse; text-align: left;">
		<tbody><tr class="trBg">
			<td class="tdTitle">
				房产地址：
			</td>
			<td class="tdContent">
				<input name="house_dizhi" id="house_dizhi"  class="input text2" type="text" value="<?php echo ($vo["house_dizhi"]); ?>" >
			</td>
			<td id="dv_company" class="tdTip">
			</td>
		</tr>
		<tr>
			<td class="tdTitle">
				建筑面积：
			</td>
			<td class="tdContent">
				<input name="house_mianji" id="house_mianji"  class="input text2" type="text" value="<?php echo ($vo["house_mianji"]); ?>" >平米
			</td>
			<td id="dv_companytel" class="tdTip">
			</td>
		</tr>
		<tr class="trBg">
			<td class="tdTitle">
				建筑年份：
			</td>
			<td class="tdContent">
				<input name="house_nian" id="house_nian"  class="input text2" type="text" value="<?php echo ($vo["house_nian"]); ?>" >
			</td>
			<td id="dv_companyaddress" class="tdTip">
			</td>
		</tr>
		<tr>
			<td class="tdTitle">
				供款状况：
			</td>
			<td class="tdContent">
			<?php $i=0;$___KEY=array ( '按揭中' => '按揭中', '已供完房款' => '已供完房款', ); foreach($___KEY as $k=>$v){ if(strlen("1key")==1 && $i==0){ ?><input type="radio" name="house_gong" value="<?php echo ($k); ?>" id="house_gong_<?php echo ($i); ?>" checked="checked" /><?php }elseif(("key1"=="key1"&&$vo["house_gong"]==$k)||("key"=="value"&&$vo["house_gong"]==$v)){ ?><input type="radio" name="house_gong" value="<?php echo ($k); ?>" id="house_gong_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="house_gong" value="<?php echo ($k); ?>" id="house_gong_<?php echo ($i); ?>" /><?php } ?><label for="house_gong_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++; } ?>
			</td>
			<td id="dv_workyear" class="tdTip">
			</td>
		</tr>
		<tr class="trBg">
			<td class="tdTitle">
				所有权人1：
			</td>
			<td class="tdContent">
				<input name="house_suo1" id="house_suo1"  class="input text2" type="text" value="<?php echo ($vo["house_suo1"]); ?>" >  产权份额<input name="house_feng1" id="house_feng1"  class="input text2" type="text" value="<?php echo ($vo["house_feng1"]); ?>" >%
			</td>
			<td id="dv_references" class="tdTip">
			</td>
		</tr>
		<tr style=" border-bottom:1px solid #dedede;">
			<td class="tdTitle">
				所有权人2：
			</td>
			<td class="tdContent">
				<input name="house_suo2" id="house_suo2"  class="input text2" type="text" value="<?php echo ($vo["house_suo2"]); ?>" >  产权份额<input name="house_feng2" id="house_feng2"  class="input text2" type="text" value="<?php echo ($vo["house_feng2"]); ?>" >%
			</td>
			<td id="dv_referencestel" class="tdTip">
			</td>
		</tr>
		<tr style=" border-bottom:1px solid #dedede; ">
			<td class="tdTitle" colspan="2" style="text-align:left">
				若房产尚在按揭中, 请填写
			</td>
			<td id="dv_referencestel" class="tdTip">
			</td>
		</tr>
		<tr style=" border-bottom:1px solid #dedede;">
			<td class="tdTitle">
				贷款年限：
			</td>
			<td class="tdContent">
				<input name="house_dai" id="house_dai"  class="input text2" type="text" value="<?php echo ($vo["house_dai"]); ?>" >年
			</td>
			<td id="dv_referencestel" class="tdTip">
			</td>
		</tr>
		<tr style=" border-bottom:1px solid #dedede;">
			<td class="tdTitle">
				每月供款：
			</td>
			<td class="tdContent">
				<input name="house_yuegong" id="house_yuegong"  class="input text2" type="text" value="<?php echo ($vo["house_yuegong"]); ?>" >元
			</td>
			<td id="dv_referencestel" class="tdTip">
			</td>
		</tr>
		<tr style=" border-bottom:1px solid #dedede;">
			<td class="tdTitle">
				尚欠贷款余额：
			</td>
			<td class="tdContent">
				<input name="house_shangxian" id="house_shangxian"  class="input text2" type="text" value="<?php echo ($vo["house_shangxian"]); ?>" >元
			</td>
			<td id="dv_referencestel" class="tdTip">
			</td>
		</tr>
		<tr style=" border-bottom:1px solid #dedede;">
			<td class="tdTitle">
				按揭银行：
			</td>
			<td class="tdContent">
				<input name="house_anjiebank" id="house_anjiebank"  class="input text2" type="text" value="<?php echo ($vo["house_anjiebank"]); ?>" >
			</td>
			<td id="dv_referencestel" class="tdTip">
			</td>
		</tr>
		<tr>
			<td>&nbsp;
				
			</td>
			<td style="height: 50px;padding-left: 10px;" class="tdContent">
				<img style="margin-top: 5px; cursor: pointer;" src="__ROOT__/Style/M/images/saveandcon.jpg" onmouseout="this.style.filter = 'alpha(opacity=100)'" onmousemove="this.style.filter = 'alpha(opacity=60)'; this.style.cursor='hand' " onclick="editdepartment();">
				 <a href="javascript:;" onclick="window.location.href='/member/memberinfo#fragment-6';window.location.reload();"><img src="__ROOT__/Style/M/images/skipandcon.jpg" style="border:none; margin:5px 0 0 20px;"></a>
			</td>
			<td id="Td1" class="tdTip">
			</td>
		</tr>
</tbody></table>
<script type="text/javascript">
function editdepartment(){
	p = makevar(['house_dizhi','house_mianji','house_nian','house_gong','house_suo1','house_suo2','house_feng1','house_feng2','house_dai','house_yuegong','house_shangxian','house_anjiebank']);
	p['_tps'] = "post";
	var mxs = true;
	$.each(p,function(i){
		if(typeof p[i] == "undefined" && i=='house_dizhi' && i=='house_mianji' && i=='house_nian' && i=='house_gong'){
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
		url: "__URL__/edithouse/",
		data: p,
		timeout: 5000,
		cache: false,
		type: "post",
		dataType: "json",
		success: function (d, s, r) {
			if(d){
				if(d.status==1){
					$.jBox.tip(d.message,'success');
					setTimeout('window.location.href="/member/memberinfo#fragment-6";window.location.reload();',1000);
				}
				else  $.jBox.tip(d.message,'fail');
			}
		}
	});
}
</script>