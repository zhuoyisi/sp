<?php if (!defined('THINK_PATH')) exit();?>
<table cellspacing="0" cellpadding="0" id="formTb" style="width: 100%; float: left; margin: 0px;padding: 0px; border-collapse: collapse; text-align: left;">
		<tbody><tr class="trBg">
			<td class="tdTitle">
				单位名称：
			</td>
			<td class="tdContent">
				<input name="department_name" id="department_name"  class="input text2" type="text" value="<?php echo ($vo["department_name"]); ?>" >
			</td>
			<td id="dv_company" class="tdTip">
			</td>
		</tr>
		<tr>
			<td class="tdTitle">
				电话：
			</td>
			<td class="tdContent">
				<input name="department_tel" id="department_tel"  class="input text2" type="text" value="<?php echo ($vo["department_tel"]); ?>" >
			</td>
			<td id="dv_companytel" class="tdTip">
			</td>
		</tr>
		<tr class="trBg">
			<td class="tdTitle">
				地址：
			</td>
			<td class="tdContent">
				<input name="department_address" id="department_address"  class="input text2" type="text" value="<?php echo ($vo["department_address"]); ?>" >
			</td>
			<td id="dv_companyaddress" class="tdTip">
			</td>
		</tr>
		<tr>
			<td class="tdTitle">
				工作年限：
			</td>
			<td class="tdContent">
			<?php $i=0;$___KEY=array ( '1年以下' => '1年以下', '1-3年' => '1-3年', '3-5年' => '3-5年', '5-10年' => '5-10年', '10年以上' => '10年以上', ); foreach($___KEY as $k=>$v){ if(strlen("1key")==1 && $i==0){ ?><input type="radio" name="department_year" value="<?php echo ($k); ?>" id="department_year_<?php echo ($i); ?>" checked="checked" /><?php }elseif(("key1"=="key1"&&$vo["department_year"]==$k)||("key"=="value"&&$vo["department_year"]==$v)){ ?><input type="radio" name="department_year" value="<?php echo ($k); ?>" id="department_year_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="department_year" value="<?php echo ($k); ?>" id="department_year_<?php echo ($i); ?>" /><?php } ?><label for="department_year_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++; } ?>
			</td>
			<td id="dv_workyear" class="tdTip">
			</td>
		</tr>
		<tr class="trBg">
			<td class="tdTitle">
				证明人：
			</td>
			<td class="tdContent">
				<input name="voucher_name" id="voucher_name"  class="input text2" type="text" value="<?php echo ($vo["voucher_name"]); ?>" >
			</td>
			<td id="dv_references" class="tdTip">
			</td>
		</tr>
		<tr style=" border-bottom:1px solid #dedede;">
			<td class="tdTitle">
				证明人手机：
			</td>
			<td class="tdContent">
				<input name="voucher_tel" id="voucher_tel"  class="input text2" type="text" value="<?php echo ($vo["voucher_tel"]); ?>" >
			</td>
			<td id="dv_referencestel" class="tdTip">
			</td>
		</tr>
		<tr>
			<td>&nbsp;
				
			</td>
			<td style="height: 50px;padding-left: 10px;" class="tdContent">
				<img style="margin-top: 5px; cursor: pointer;" src="__ROOT__/Style/M/images/saveandcon.jpg" onmouseout="this.style.filter = 'alpha(opacity=100)'" onmousemove="this.style.filter = 'alpha(opacity=60)'; this.style.cursor='hand' " onclick="editdepartment();">
				 <a href="javascript:;" onclick="window.location.href='/member/memberinfo#fragment-4';window.location.reload();"><img src="__ROOT__/Style/M/images/skipandcon.jpg" style="border:none; margin:5px 0 0 20px;"></a>
			</td>
			<td id="Td1" class="tdTip">
			</td>
		</tr>
</tbody></table>
<script type="text/javascript">
function editdepartment(){
	p = makevar(['department_name','department_tel','department_address','voucher_name','voucher_tel','department_year']);
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
		url: "__URL__/editdepartment/",
		data: p,
		timeout: 5000,
		cache: false,
		type: "post",
		dataType: "json",
		success: function (d, s, r) {
			if(d){
				if(d.status==1){
					$.jBox.tip(d.message,'success');
					setTimeout('window.location.href="/member/memberinfo#fragment-4";window.location.reload();',1000);
				}
				else  $.jBox.tip(d.message,'fail');
			}
		}
	});
}
</script>