<?php if (!defined('THINK_PATH')) exit();?>
<table cellspacing="0" cellpadding="0" id="formTb" style="width: 100%; float: left; margin: 0px;padding: 0px; border-collapse: collapse; text-align: left;">
		<tbody><tr class="trBg">
			<td class="tdTitle">
				现居住地址：
			</td>
			<td class="tdContent">
				<input name="address" id="address"  class="input text2" type="text" value="<?php echo ($vo["address"]); ?>" >
			</td>
			<td id="dv_homeAdress" class="tdTip">
			</td>
		</tr>
		<tr>
			<td class="tdTitle">
				住宅电话：
			</td>
			<td class="tdContent">
				<input name="tel" id="tel"  class="input text2" type="text" value="<?php echo ($vo["tel"]); ?>" >
			</td>
			<td id="dv_homeTel" class="tdTip">
			</td>
		</tr>
		<tr class="trBg">
			<td class="tdTitle">
				第一联系人：
			</td>
			<td class="tdContent">
				<input name="contact1" id="contact1"  class="input text2" type="text" value="<?php echo ($vo["contact1"]); ?>" >
			</td>
			<td id="dv_firstname" class="tdTip">
			</td>
		</tr>
		<tr>
			<td class="tdTitle">
				关系：
			</td>
			<td class="tdContent">
			<?php $i=0;$___KEY=array ( '家庭成员' => '家庭成员', '朋友' => '朋友', '商业伙伴' => '商业伙伴', ); foreach($___KEY as $k=>$v){ if(strlen("1key")==1 && $i==0){ ?><input type="radio" name="contact1_re" value="<?php echo ($k); ?>" id="contact1_re_<?php echo ($i); ?>" checked="checked" /><?php }elseif(("key1"=="key1"&&$vo["contact1_re"]==$k)||("key"=="value"&&$vo["contact1_re"]==$v)){ ?><input type="radio" name="contact1_re" value="<?php echo ($k); ?>" id="contact1_re_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="contact1_re" value="<?php echo ($k); ?>" id="contact1_re_<?php echo ($i); ?>" /><?php } ?><label for="contact1_re_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++; } ?>
			</td>
			<td id="dv_firstrelation" class="tdTip">
			</td>
		</tr>
		<tr class="trBg">
			<td class="tdTitle">
				手机号码：
			</td>
			<td class="tdContent">
				<input name="contact1_tel" id="contact1_tel"  class="input text2" type="text" value="<?php echo ($vo["contact1_tel"]); ?>" >
			</td>
			<td id="dv_firstmobile" class="tdTip">
			</td>
		</tr>
		<tr>
			<td class="tdTitle">
				其他：
			</td>
			<td class="tdContent">
				<input name="contact1_other" id="contact1_other"  class="input text2" type="text" value="<?php echo ($vo["contact1_other"]); ?>" >
			</td>
			<td id="dv_qq" class="tdTip">
			</td>
		</tr>
		<tr class="trBg">
			<td class="tdTitle">
				第二联系人：
			</td>
			<td class="tdContent">
				<input name="contact2" id="contact2"  class="input text2" type="text" value="<?php echo ($vo["contact2"]); ?>" >
			</td>
			<td id="dv_secondname" class="tdTip">
			</td>
		</tr>
		<tr>
			<td class="tdTitle">
				关系：
			</td>
			<td class="tdContent">
			<?php $i=0;$___KEY=array ( '家庭成员' => '家庭成员', '朋友' => '朋友', '商业伙伴' => '商业伙伴', ); foreach($___KEY as $k=>$v){ if(strlen("1key")==1 && $i==0){ ?><input type="radio" name="contact2_re" value="<?php echo ($k); ?>" id="contact2_re_<?php echo ($i); ?>" checked="checked" /><?php }elseif(("key1"=="key1"&&$vo["contact2_re"]==$k)||("key"=="value"&&$vo["contact2_re"]==$v)){ ?><input type="radio" name="contact2_re" value="<?php echo ($k); ?>" id="contact2_re_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="contact2_re" value="<?php echo ($k); ?>" id="contact2_re_<?php echo ($i); ?>" /><?php } ?><label for="contact2_re_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++; } ?>
			</td>
			<td id="dv_secondrelation" class="tdTip">
			</td>
		</tr>
		<tr class="trBg">
			<td class="tdTitle">
				手机号码：
			</td>
			<td class="tdContent">
				<input name="contact2_tel" id="contact2_tel"  class="input text2" type="text" value="<?php echo ($vo["contact2_tel"]); ?>" >
			</td>
			<td id="dv_secondmobile" class="tdTip">
			</td>
		</tr>
		<tr style=" border-bottom:1px solid #dedede;">
			<td class="tdTitle">
				其他：
			</td>
			<td class="tdContent">
				<input name="contact2_other" id="contact2_other"  class="input text2" type="text" value="<?php echo ($vo["contact2_other"]); ?>" >
			</td>
			<td id="dv_msn" class="tdTip">
			</td>
		</tr>

		<tr class="trBg">
			<td class="tdTitle">
				第三联系人：
			</td>
			<td class="tdContent">
				<input name="contact3" id="contact3"  class="input text2" type="text" value="<?php echo ($vo["contact3"]); ?>" >
			</td>
			<td id="dv_secondname" class="tdTip">
			</td>
		</tr>
		<tr>
			<td class="tdTitle">
				关系：
			</td>
			<td class="tdContent">
			<?php $i=0;$___KEY=array ( '家庭成员' => '家庭成员', '朋友' => '朋友', '商业伙伴' => '商业伙伴', ); foreach($___KEY as $k=>$v){ if(strlen("1key")==1 && $i==0){ ?><input type="radio" name="contact3_re" value="<?php echo ($k); ?>" id="contact3_re_<?php echo ($i); ?>" checked="checked" /><?php }elseif(("key1"=="key1"&&$vo["contact3_re"]==$k)||("key"=="value"&&$vo["contact3_re"]==$v)){ ?><input type="radio" name="contact3_re" value="<?php echo ($k); ?>" id="contact3_re_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="contact3_re" value="<?php echo ($k); ?>" id="contact3_re_<?php echo ($i); ?>" /><?php } ?><label for="contact3_re_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++; } ?>
			</td>
			<td id="dv_secondrelation" class="tdTip">
			</td>
		</tr>
		<tr class="trBg">
			<td class="tdTitle">
				手机号码：
			</td>
			<td class="tdContent">
				<input name="contact3_tel" id="contact3_tel"  class="input text2" type="text" value="<?php echo ($vo["contact3_tel"]); ?>" >
			</td>
			<td id="dv_secondmobile" class="tdTip">
			</td>
		</tr>
		<tr style=" border-bottom:1px solid #dedede;">
			<td class="tdTitle">
				其他：
			</td>
			<td class="tdContent">
				<input name="contact3_other" id="contact3_other"  class="input text2" type="text" value="<?php echo ($vo["contact3_other"]); ?>" >
			</td>
			<td id="dv_msn" class="tdTip">
			</td>
		</tr>
		<tr>
			<td>&nbsp;
				
			</td>
			<td style="height: 50px;padding-left: 10px;" class="tdContent">
				<img style="margin-top: 5px; cursor: pointer;" src="__ROOT__/Style/M/images/saveandcon.jpg" onmouseout="this.style.filter = 'alpha(opacity=100)'" onmousemove="this.style.filter = 'alpha(opacity=60)'; this.style.cursor='hand' " onclick="editContact();">
				 <a href="javascript:;" onclick="window.location.href='/member/memberinfo#fragment-3';window.location.reload();"><img src="__ROOT__/Style/M/images/skipandcon.jpg" style="border:none; margin:5px 0 0 20px;"></a>
			</td>
			<td id="Td1" class="tdTip">
			</td>
		</tr>
	</tbody> 
</table>
<script type="text/javascript">
function editContact(){
	p = makevar(['contact2_other','contact2_tel','contact1_tel','contact1_other','contact2_re','contact1_re','contact1','contact2','tel','address','contact3_tel','contact3','contact3_other','contact3_re',]);
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
		url: "__URL__/editcontact/",
		data: p,
		timeout: 5000,
		cache: false,
		type: "post",
		dataType: "json",
		success: function (d, s, r) {
			if(d){
				if(d.status==1){
					$.jBox.tip(d.message,'success');
					setTimeout('window.location.href="/member/memberinfo#fragment-3";window.location.reload();',1000);
				}
				else  $.jBox.tip(d.message,'fail');
			}
		}
	});
}
</script>