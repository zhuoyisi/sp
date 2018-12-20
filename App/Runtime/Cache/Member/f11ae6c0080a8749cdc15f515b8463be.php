<?php if (!defined('THINK_PATH')) exit();?>
<table cellspacing="0" cellpadding="0" id="formTb" style="width:100%; float: left; margin: 0px;padding: 0px; border-collapse: collapse; text-align: left;">
	<tbody><tr class="trBg">
			<td class="tdTitle">
				第一联保人：
			</td>
			<td class="tdContent">
				<input name="ensuer1_name" id="ensuer1_name"  class="input text2" type="text" value="<?php echo ($vo["ensuer1_name"]); ?>" >
			</td>
			<td id="dv_EnsuerFirst" class="tdTip">
			</td>
		</tr>
		<tr>
			<td class="tdTitle">
				关系：
			</td>
			<td class="tdContent">
			<?php $i=0;$___KEY=array ( '家庭成员' => '家庭成员', '朋友' => '朋友', '商业伙伴' => '商业伙伴', ); foreach($___KEY as $k=>$v){ if(strlen("1key")==1 && $i==0){ ?><input type="radio" name="ensuer1_re" value="<?php echo ($k); ?>" id="ensuer1_re_<?php echo ($i); ?>" checked="checked" /><?php }elseif(("key1"=="key1"&&$vo["ensuer1_re"]==$k)||("key"=="value"&&$vo["ensuer1_re"]==$v)){ ?><input type="radio" name="ensuer1_re" value="<?php echo ($k); ?>" id="ensuer1_re_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="ensuer1_re" value="<?php echo ($k); ?>" id="ensuer1_re_<?php echo ($i); ?>" /><?php } ?><label for="ensuer1_re_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++; } ?>
			</td>
			<td id="dv_firstrelation" class="tdTip">
			</td>
		</tr>
		<tr class="trBg">
			<td class="tdTitle">
				手机号码：
			</td>
			<td class="tdContent">
				<input name="ensuer1_tel" id="ensuer1_tel"  class="input text2" type="text" value="<?php echo ($vo["ensuer1_tel"]); ?>" >
			</td>
			<td id="dv_EnsuerFirstrTel" class="tdTip">
			</td>
		</tr>
		<tr>
			<td class="tdTitle">
				第二联保人：
			</td>
			<td class="tdContent">
				<input name="ensuer2_name" id="ensuer2_name"  class="input text2" type="text" value="<?php echo ($vo["ensuer2_name"]); ?>" >
			</td>
			<td id="dv_EnsuerSecond" class="tdTip">
			</td>
		</tr>
		<tr class="trBg">
			<td class="tdTitle">
				关系：
			</td>
			<td class="tdContent">
			<?php $i=0;$___KEY=array ( '家庭成员' => '家庭成员', '朋友' => '朋友', '商业伙伴' => '商业伙伴', ); foreach($___KEY as $k=>$v){ if(strlen("1key")==1 && $i==0){ ?><input type="radio" name="ensuer2_re" value="<?php echo ($k); ?>" id="ensuer2_re_<?php echo ($i); ?>" checked="checked" /><?php }elseif(("key1"=="key1"&&$vo["ensuer2_re"]==$k)||("key"=="value"&&$vo["ensuer2_re"]==$v)){ ?><input type="radio" name="ensuer2_re" value="<?php echo ($k); ?>" id="ensuer2_re_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="ensuer2_re" value="<?php echo ($k); ?>" id="ensuer2_re_<?php echo ($i); ?>" /><?php } ?><label for="ensuer2_re_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++; } ?>
			</td>
			<td id="dv_secondrelation" class="tdTip">
			</td>
		</tr>
		<tr style=" border-bottom:1px solid #dedede;">
			<td class="tdTitle">
				手机号码：
			</td>
			<td class="tdContent">
				<input name="ensuer2_tel" id="ensuer2_tel"  class="input text2" type="text" value="<?php echo ($vo["ensuer2_tel"]); ?>" >
			</td>
			<td id="dv_EnsuerSecondTel" class="tdTip">
			</td>
		</tr>
		<tr>
			<td>&nbsp;
				
			</td>
			<td style="height: 50px;padding-left: 10px;" class="tdContent">
				 <a href="javascript:;" onclick="editensure();"><img style="margin-top: 5px; cursor: pointer;" src="__ROOT__/Style/M/images/saveandcon.jpg" onmouseout="this.style.filter = 'alpha(opacity=100)'" onmousemove="this.style.filter = 'alpha(opacity=60)'; this.style.cursor='hand' "></a>
			</td>
			<td id="xx" class="tdTip">
			</td>
		</tr>
</tbody></table>
<script type="text/javascript">
function editensure(){
	p = makevar(['ensuer1_name','ensuer1_tel','ensuer1_re','ensuer2_name','ensuer2_tel','ensuer2_re']);
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
		url: "__URL__/editensure/",
		data: p,
		timeout: 5000,
		cache: false,
		type: "post",
		dataType: "json",
		success: function (d, s, r) {
			if(d){
				if(d.status==1){
					$.jBox.tip(d.message,'success');
					
				}
				else  $.jBox.tip(d.message,'fail');
			}
		}
	});
}
</script>