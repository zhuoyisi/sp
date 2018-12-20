<?php if (!defined('THINK_PATH')) exit();?>    <style type="text/css">
        /*下面两个样式是重写default.css样式里面的定义*/.dv_account_2 { width: 768px; }
        .rebar { background: #f6f6f6; line-height: 20px; margin-top: 10px; padding-left: 25px; padding-top: 4px; }
        .gapline { border: solid 1px #dfdfdf; overflow: hidden; width: 726px; margin: 0 auto; margin-top: 20px; text-align: center; clear: both; }
        .gapline ul { padding: 0px; overflow: hidden; line-height: 31px; }
        .gapline ul li { float: left; }
        .gapline ul li.l1 { width: 110px; border-right: solid 1px #dfdfdf; text-align: left; padding-left: 20px; }
        .gapline ul li.l2 { width: 148px; border-right: solid 1px #dfdfdf; }
        .gapline ul li.l3 { width: 148px; border-right: solid 1px #dfdfdf; }
        .gapline ul li.l4 { width: 148px; border-right: solid 1px #dfdfdf; }
        .gapline .botline { border-bottom: solid 1px #dedede; overflow: hidden; }
        ul li.bg1 { background: #EEEEEE; }
        ul li.bg2 { background: #FAFAFA; }
        ul li input { vertical-align: top; margin-top: 9px; }
        .gapheight { margin-top: 10px; }
        .gapheight ul { clear: both; width: 727px; margin: 0 auto; line-height: 30px; overflow: hidden; border-left: solid 1px #dfdfdf; }
        .gapheight ul.topline { border-top: solid 1px #dfdfdf; }
        .gapheight ul .li1 { float: left; border-right: solid 1px #dfdfdf; border-bottom: solid 1px #dfdfdf; width: 115px; height: 30px; padding-left: 15px; }
        .gapheight ul .li2 { float: left; border-right: solid 1px #dfdfdf; border-bottom: solid 1px #dfdfdf; width: 148px; height: 30px; text-align: center; }
        .gapheight ul .li3 { float: left; border-right: solid 1px #dfdfdf; border-bottom: solid 1px #dfdfdf; width: 148px; height: 30px; text-align: center; }
        .gapheight ul .li4 { float: left; border-right: solid 1px #dfdfdf; border-bottom: solid 1px #dfdfdf; width: 148px; height: 30px; text-align: center; }
        .gapheight ul .li5 { width: 148px; float: left; border-right: solid 1px #dfdfdf; border-bottom: solid 1px #dfdfdf; text-align: center; }
        .gapheight ul li.t1 { background: #ebebeb; border-right: 0px; border-bottom: 0px; font-weight: bold; }
        .gapheight ul li.t2 { background: #ebebeb; border-right: solid 1px #dfdfdf; width: 596px; float: left; }
        .btnframe { margin: 0 auto; text-align: right; margin-top: 10px; width: 726px; }
        .btnframe #btnclear { cursor:pointer; background: url(__ROOT__/Style/H/images/reseting.jpg); width: 76px; height: 28px; border: 0px; }
        .btnframe #btnSubmit {cursor:pointer; background: url(__ROOT__/Style/H/images/sub_offline.jpg); width: 76px; height: 28px; border: 0px; }
    </style>
<div class="rebar">
	<img src="__ROOT__/Style/M/images/start.jpg" alt="">
	<strong>请勾选您所需要设置的消息提醒.</strong>
</div>
<div class="gapline">
	<ul>
		<li class="l1 bg1">&nbsp;</li>
		<li class="l2 bg1"><strong>系统消息</strong></li>
		<li class="l3 bg1"><strong>邮件提醒</strong></li>
		<!--<li class="l4 bg1"><strong>短信提醒</strong></li>-->
		<li class="bg1" style="width: 148px;">&nbsp;</li>
	</ul>
</div>

<script type="text/javascript">
	var nowset = "<?php echo ($vo["tipset"]); ?>";
	function SetAll(obj, aid) {
		var ids = "#" + obj;
		for (var i = 1; i <= 3; i++) {
			if ($(ids + i).attr("disabled") == "disabled") {
				continue;
			}
			$(ids + i).attr("checked", "checked");
		}
		$(aid).html("取消");
		$(aid).attr("href", "javascript:SetAllOff('" + obj + "','" + aid + "');");
	}
	function SetAllOff(obj, aid) {
		var ids = "#" + obj;
		for (var i = 1; i <= 3; i++) {
			if ($(ids + i).attr("disabled") == "disabled") {
				continue;
			}
			$(ids + i).removeAttr("checked");
		}
		$(aid).html("全选");
		$(aid).attr("href", "javascript:SetAll('" + obj + "','" + aid + "');")
	}
	function SetStates(v) {
		return;
		var ids1 = "#chk" + v + "_1";
		var ids2 = "#chk" + v + "_2";
		var ids3 = "#chk" + v + "_3";
		var ads1 = "#aset" + v;
		if (($(ids1).attr("checked") == "checked") && ($(ids2).attr("checked") == "checked") && ($(ids3).attr("checked") == "checked")) {
			if ($(ids3).attr("disabled") == "disabled") {
				$(ids3).removeAttr("checked");
			}
			$(ads1).attr("href", "javascript:SetAllOff('chk" + v + "_','#aset" + v + "');");
			$(ads1).html("取消");
		} else if (($(ids1).attr("checked") == "checked") && ($(ids2).attr("checked") == "checked") && $(ids3).attr("disabled") == "disabled") {
			$(ads1).attr("href", "javascript:SetAllOff('chk" + v + "_','#aset" + v + "');");
			$(ads1).html("取消");
		} else {
			$(ads1).html("全选");
			$(ads1).attr("href", "javascript:SetAll('chk" + v + "_','#aset" + v + "');");
		}
	}
	function Initstate(id) {
		var ids1 = "#" + id;
		$(ids1).attr("checked","checked");
	}
</script>

<div class="gapheight">
	<ul class="topline">
		<li class="li1 t1">基本设置：</li>
		<li class="t2">&nbsp;</li>
	</ul>
	<ul class="topline">
	<ul class="topline"> <li class="li1">修改密码</li> <li class="li2"><input name="chk1_1" id="chk1_1" type="checkbox"></li> <li class="li3"><input name="chk1_2" id="chk1_2" type="checkbox"></li><li class="li5"><a href="javascript:SetAll('chk1_','#aset1');"  id="aset1">全选</a></li> </ul>
	<ul class="topline"> <li class="li1">修改银行帐号</li> <li class="li2"><input name="chk2_1" id="chk2_1" type="checkbox"></li> <li class="li3"><input name="chk2_2" id="chk2_2" type="checkbox"></li><li class="li5"><a href="javascript:SetAll('chk2_','#aset2');"  id="aset2">全选</a></li> </ul>
	<ul class="topline"> <li class="li1">资金提现</li> <li class="li2"><input name="chk6_1" id="chk6_1" type="checkbox"></li> <li class="li3"><input name="chk6_2" id="chk6_2" type="checkbox"></li><li class="li5"><a href="javascript:SetAll('chk6_','#aset6');"  id="aset6">全选</a></li> </ul>
</div>
<div class="gapheight">
	<ul class="topline">
		<li class="li1 t1">借款相关：</li>
		<li class="t2">&nbsp;</li>
	</ul>
	<ul class="topline"> <li class="li1">借款标发标成功</li> <li class="li2"><input name="chk9_1" id="chk9_1" type="checkbox"></li> <li class="li3"><input name="chk9_2" id="chk9_2" type="checkbox"></li><li class="li5"><a href="javascript:SetAll('chk9_','#aset9');"  id="aset9">全选</a></li> </ul>
	<ul class="topline"> <li class="li1">借款标满标</li> <li class="li2"><input name="chk10_1" id="chk10_1" type="checkbox"></li> <li class="li3"><input name="chk10_2" id="chk10_2" type="checkbox"></li><li class="li5"><a href="javascript:SetAll('chk10_','#aset10');"  id="aset10">全选</a></li> </ul>
	<ul class="topline"> <li class="li1">借款标流标</li> <li class="li2"><input name="chk11_1" id="chk11_1" type="checkbox"></li> <li class="li3"><input name="chk11_2" id="chk11_2" type="checkbox"></li><li class="li5"><a href="javascript:SetAll('chk11_','#aset11');"  id="aset11">全选</a></li> </ul>
</div>
<div class="gapheight">
	<ul class="topline">
		<li class="li1 t1">投资相关：</li>
		<li class="t2">&nbsp;</li>
	</ul>
	<ul class="topline"> <li class="li1">自动投标借出完成</li> <li class="li2"><input name="chk27_1" id="chk27_1" type="checkbox"></li> <li class="li3"><input name="chk27_2" id="chk27_2" type="checkbox"></li><li class="li5"><a href="javascript:SetAll('chk27_','#aset27');"  id="aset27">全选</a></li> </ul>
	<ul class="topline"> <li class="li1">借出成功</li> <li class="li2"><input name="chk14_1" id="chk14_1" type="checkbox"></li> <li class="li3"><input name="chk14_2" id="chk14_2" type="checkbox"></li><li class="li5"><a href="javascript:SetAll('chk14_','#aset14');"  id="aset14">全选</a></li> </ul>
	<ul class="topline"> <li class="li1">借出流标</li> <li class="li2"><input name="chk15_1" id="chk15_1" type="checkbox"></li> <li class="li3"><input name="chk15_2" id="chk15_2" type="checkbox"></li><li class="li5"><a href="javascript:SetAll('chk15_','#aset15');"  id="aset15">全选</a></li> </ul>
	<ul class="topline"> <li class="li1">收到还款</li> <li class="li2"><input name="chk16_1" id="chk16_1" type="checkbox"></li> <li class="li3"><input name="chk16_2" id="chk16_2" type="checkbox"></li><li class="li5"><a href="javascript:SetAll('chk16_','#aset16');"  id="aset16">全选</a></li> </ul>
	<ul class="topline"> <li class="li1"><?php echo ($glo["web_name"]); ?>代为偿还</li> <li class="li2"><input name="chk18_1" id="chk18_1" type="checkbox"></li> <li class="li3"><input name="chk18_2" id="chk18_2" type="checkbox"></li><li class="li5"><a href="javascript:SetAll('chk18_','#aset18');"  id="aset18">全选</a></li> </ul>
</div>
<div class="btnframe" style="width:430px">
	<input id="btnclear" value="" type="reset">
	<input id="btnSubmit" value="" style="" type="button">
</div>

<script type="text/javascript">
	var newTitle = '<?php echo ($glo["web_name"]); ?>提醒您：';
	var diccount = parseInt('30');
	for(var w=0;w<30;w++){
		$("body").find("#chk"+w+"_2").removeAttr("checked").attr('disabled',true);
	}
	$(document).ready(function() {
		$("#btnSubmit").click(function() {
			var arrays = new Array();
			var objs = document.getElementsByTagName("input");
			for (var i = 0; i < objs.length; i++) {
				if (objs.item(i).type == 'checkbox') {
					var id = "#" + objs.item(i).id;
					if ($(id).attr("checked") == 'checked') {
						arrays.push(objs.item(i).id);
					}
				}
			}
			var str = '';
			for (var j = 0; j < arrays.length; j++) {
				str += arrays[j] + ",";
			}
			$.post("__URL__/savetip", {Params: str }, function(data) {
				if (data > 0) {
					$.jBox.tip('您好，您的操作保存成功！','success', newTitle);
				}
				else {
					$.jBox.tip('您好，您的操作失败，请重新尝试！','fail', newTitle);
				}
			});
		});
	});
	
	function Initial() {
		var arr = nowset.split(",");
		var size = arr.length;
		for (var i = 0; i < size; i++) {
			Initstate(arr[i]);
		}
	}
	Initial();
	$("#btnclear").click(function() {
		var arrays = new Array();
		var objs = document.getElementsByTagName("input");
		for (var i = 0; i < objs.length; i++) {
			if (objs.item(i).type == 'checkbox') {
				var id = "#" + objs.item(i).id;
				$(id).removeAttr("checked");
			}
		}
	});
	
</script>