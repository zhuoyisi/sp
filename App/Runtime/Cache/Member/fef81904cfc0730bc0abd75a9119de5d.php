<?php if (!defined('THINK_PATH')) exit();?>

<script type="text/javascript" src="__ROOT__/Style/H/js/area.js" language="javascript"></script>
<table cellspacing="0" cellpadding="0" id="formTb" class="jiben01" style="width:100%">
	<tbody><tr class="trBg">
		<td class="tdTitle">
			真实姓名：
		</td>
		<td class="tdContent">
		<?php if($vo["real_name"] == null): ?><input name="real_name" id="real_name"  class="input text2" type="text" value="尚未实名认证" disabled="disabled">您是初次驾临，请先去进行<a href="/member/verify?id=1#fragment-3">【实名认证】</a>
		<?php else: ?>
			<input name="real_name" id="real_name"  class="input text2" type="text" value="<?php echo ($vo["real_name"]); ?>" disabled="disabled">
			<?php if($vo["id_status"] == 2): ?>待审核<?php elseif($vo["id_status"] == 3): ?>审核未通过<?php endif; endif; ?>
		</td>
		<td id="dv_realname" class="tdTip">
		</td>
	</tr>
	<tr>
		<td class="tdTitle">
			身份证号：
		</td>
		<td class="tdContent">
		<?php if($vo["idcard"] == null): ?><input name="idcard" id="idcard"  class="input text2" type="text" value="尚未身份认证" disabled="disabled">您是初次驾临，请先去进行<a href="/member/verify?id=1#fragment-3">【身份认证】</a>
			<?php else: ?>
			<input name="idcard" id="idcard"  class="input text2" type="text" value="<?php echo ($vo["idcard"]); ?>" disabled="disabled">
			<?php if($vo["id_status"] == 2): ?>待审核<?php elseif($vo["id_status"] == 3): ?>审核未通过<?php endif; endif; ?>
		</td>
		<td id="dv_idcard" class="tdTip">
		</td>
	</tr>
	<tr class="trBg">
		<td class="tdTitle">
			手机号码：
		</td>
		<td class="tdContent">
		<?php if($vo["cell_phone"] == null): ?><input name="cell_phone" id="cell_phone"  class="input text2" type="text" value="尚未手机认证" disabled="disabled">您是初次驾临，请先去进行<a href="/member/verify?id=1#fragment-2">【手机认证】</a>
		<?php else: ?>
			<input name="cell_phone" id="cell_phone"  class="input text2" type="text" value="<?php echo ($vo["cell_phone"]); ?>" disabled="disabled">需要修改请点击<a href="/member/verify?id=1#fragment-2">【修改手机认证】</a><?php endif; ?>
		</td>
		<td id="dv_mobile" class="tdTip">
		</td>
	</tr>
	<tr >
		<td class="tdTitle">
			年龄：
		</td>
		<td class="tdContent">
			<input name="age" id="age"  class="input text2" type="text" value="<?php echo ($vo["age"]); ?>" >
		</td>
		<td id="Td3" class="tdTip">
		</td>
	</tr>
    
	<tr class="trBg">
		<td class="tdTitle">
			籍贯：
		</td>
		<td class="tdContent">
			<select name="province" id="province" class="sel_fs"><option>请选择</option></select>&#12288;（省/直辖市）&#12288;<select name="city" id="city" class="sel_fs"><option>请选择</option></select>&#12288;市&#12288;<select name="area" id="area" class="sel_fs"><option>请选择</option></select>&#12288;区
		</td>
		<td id="dv_mobile" class="tdTip">
		</td>
	</tr>
	<tr class="trBg">
		<td class="tdTitle">
			当前居住城市：
		</td>
		<td class="tdContent radioPos">
			<select name="province_now" id="province_now" class="sel_fs"><option>请选择</option></select>&#12288;（省/直辖市）&#12288;<select name="city_now" id="city_now" class="sel_fs"><option>请选择</option></select>&#12288;市&#12288;<select name="area_now" id="area_now" class="sel_fs"><option>请选择</option></select>&#12288;区
		</td>
		<td id="dv_gender" class="tdTip">
		</td>
	</tr>
	<tr class="trBg">
		<td class="tdTitle">
			性别：
		</td>
		<td class="tdContent radioPos">
			<?php $i=0;$___KEY=array ( '男' => '男', '女' => '女', ); foreach($___KEY as $k=>$v){ if(strlen("1key")==1 && $i==0){ ?><input type="radio" name="sex" value="<?php echo ($k); ?>" id="sex_<?php echo ($i); ?>" checked="checked" /><?php }elseif(("key1"=="key1"&&$vo["sex"]==$k)||("key"=="value"&&$vo["sex"]==$v)){ ?><input type="radio" name="sex" value="<?php echo ($k); ?>" id="sex_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="sex" value="<?php echo ($k); ?>" id="sex_<?php echo ($i); ?>" /><?php } ?><label for="sex_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++; } ?>
		</td>
		<td id="dv_gender" class="tdTip">
		</td>
	</tr>
	<tr>
		<td class="tdTitle">
			婚姻状况：
		</td>
		<td class="tdContent radioPos">
			<?php $i=0;$___KEY=array ( '未婚' => '未婚', '已婚' => '已婚', ); foreach($___KEY as $k=>$v){ if(strlen("1key")==1 && $i==0){ ?><input type="radio" name="marry" value="<?php echo ($k); ?>" id="marry_<?php echo ($i); ?>" checked="checked" /><?php }elseif(("key1"=="key1"&&$vo["marry"]==$k)||("key"=="value"&&$vo["marry"]==$v)){ ?><input type="radio" name="marry" value="<?php echo ($k); ?>" id="marry_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="marry" value="<?php echo ($k); ?>" id="marry_<?php echo ($i); ?>" /><?php } ?><label for="marry_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++; } ?>
		</td>
		<td id="dv_marrage" class="tdTip">
		</td>
	</tr>
	<tr class="trBg">
		<td class="tdTitle">
			最高学历：
		</td>
		<td class="tdContent radioPos">
			<?php $i=0;$___KEY=array ( '高中以下' => '高中以下', '大专或本科' => '大专或本科', '硕士或硕士以上' => '硕士或硕士以上', ); foreach($___KEY as $k=>$v){ if(strlen("1key")==1 && $i==0){ ?><input type="radio" name="education" value="<?php echo ($k); ?>" id="education_<?php echo ($i); ?>" checked="checked" /><?php }elseif(("key1"=="key1"&&$vo["education"]==$k)||("key"=="value"&&$vo["education"]==$v)){ ?><input type="radio" name="education" value="<?php echo ($k); ?>" id="education_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="education" value="<?php echo ($k); ?>" id="education_<?php echo ($i); ?>" /><?php } ?><label for="education_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++; } ?>
		</td>
		<td id="dv_degree" class="tdTip">
		</td>
	</tr>
	<tr>
		<td class="tdTitle">
			月收入：
		</td>
		<td class="tdContent radioPos">
			<?php $i=0;$___KEY=array ( '5000以下' => '5000以下', '5000-10000' => '5000-10000', '10000-50000' => '10000-50000', '50000以上' => '50000以上', ); foreach($___KEY as $k=>$v){ if(strlen("1key")==1 && $i==0){ ?><input type="radio" name="income" value="<?php echo ($k); ?>" id="income_<?php echo ($i); ?>" checked="checked" /><?php }elseif(("key1"=="key1"&&$vo["income"]==$k)||("key"=="value"&&$vo["income"]==$v)){ ?><input type="radio" name="income" value="<?php echo ($k); ?>" id="income_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="income" value="<?php echo ($k); ?>" id="income_<?php echo ($i); ?>" /><?php } ?><label for="income_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++; } ?>
		</td>
		<td id="dv_income" class="tdTip">
		</td>
	</tr>
	<tr class="trBg">
		<td class="tdTitle">
			职业：
		</td>
		<td class="tdContent radioPos">
			<input name="zy" id="zy"  class="input" type="text" value="<?php echo ($vo["zy"]); ?>" >
		</td>
		<td id="dv_income" class="tdTip">
		</td>
	</tr>
	<tr>
		<td class="tdTitle">
			个人描述：
		</td>
		<td style="height: 100px;" class="tdContent">
			<textarea name="info" id="info" style="height:80px;width:423px;" class="areabox textarea1" ><?php echo ($vo["info"]); ?></textarea>
		</td>
		<td id="dv_id" class="tdTip">
		</td>
	</tr>
	<tr>
		<td class="tdTitle">&nbsp;
			
		</td>
		<td style="height: 50px; padding-left: 10px;" class="tdContent">
				<img style="margin-top: 5px; cursor: pointer;" src="__ROOT__/Style/M/images/saveandcon.jpg" onmouseout="this.style.filter = 'alpha(opacity=100)'" onmousemove="this.style.filter = 'alpha(opacity=60)'; this.style.cursor='hand' " onclick="editmemberinfo();">
		</td>
		<td id="xx" class="tdTip">
		</td>
	</tr>
</tbody></table>
<script type="text/javascript">
var areaurl="__URL__/getarea/";
var s = new GetAreaSelect('#province','#city','#area'<?php if(empty($vo['province'])): else: ?>,<?php echo ($vo["province"]); endif; if(empty($vo['city'])): else: ?>,<?php echo ($vo["city"]); endif; if(empty($vo['area'])): else: ?>,<?php echo ($vo["area"]); endif; ?>);
var s1 = new GetAreaSelect('#province_now','#city_now','#area_now'<?php if(empty($vo['province_now'])): else: ?>,<?php echo ($vo["province_now"]); endif; if(empty($vo['city_now'])): else: ?>,<?php echo ($vo["city_now"]); endif; if(empty($vo['area_now'])): else: ?>,<?php echo ($vo["area_now"]); endif; ?>);
</script>
<script type="text/javascript">
function editmemberinfo(){
	p = makevar(['sex','info','marry','education','income','age','province','city','area','province_now','city_now','area_now','zy']);
	p['_tps'] = "post";
	var mxs = true;
	$.each(p,function(i){
		if(typeof p[i] == "undefined" && i!='area_now' && i!='area'){
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
		url: "__URL__/editmemberinfo/",
		data: p,
		timeout: 5000,
		cache: false,
		type: "post",
		dataType: "json",
		success: function (d, s, r) {
			if(d){
				if(d.status==1){
					$.jBox.tip(d.message,'success');
					setTimeout('window.location.href="/member/memberinfo#fragment-2";window.location.reload();',1000);
				}
				else  $.jBox.tip(d.message,'fail');
			}
		}
	});
}
</script>