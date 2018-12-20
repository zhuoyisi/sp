<?php if (!defined('THINK_PATH')) exit();?>
<style type="text/css">
.operaframe { width: 600px; text-align: left; overflow: hidden; margin-left: 20px; line-height: 27px; padding-left: 28px; float: left; margin-top: 20px; }
        .operaframe ul { padding: 0px; margin: 0px; text-align: left; overflow: hidden; line-height: 25px; }
        .operaframe ul li { float: left; line-height: 25px; }
	.tdTitle { text-align: right; padding-left: 10px; font-size: 12px; height: 40; line-height: 40px; vertical-align: middle; width: 160px; font-weight: bold; background-color: #F9F9F9; }
	.tdContent1 { text-align: left; padding-left: 10px; font-size: 12px; height: 40; line-height: 40px; vertical-align: middle; width: 535px; }
	.tdContent { line-height: 28px; border: 1px solid #ccc; }
	.tdHeard { border: 1px solid #ccc; }
.txtInput{   background-color: #FFFFFF;
                    background-position: right center;
                    background-repeat: no-repeat;
                    border: 1px solid #CCCCCC;
                    font-size: 12px;
                    height: 15px;
                    margin-right: 4px;
                    padding: 2px;
                    text-align: left;
                    vertical-align: middle;
                    width: 95px;
                }
</style>
<div style="height: 25px; line-height: 25px; padding: 16px 0px; width: 640px; margin-left: 56px;text-align: left; float: left;">
	<?php if(!isset($_GET['start_time'])){ ?>截止<span class="fontred"><?php echo date("Y-m-d H:i:s",time()); ?></span><?php }else{ ?>从<span class="fontred"><?php echo date("Y-m-d",$_GET['start_time']); ?></span>到<span class="fontred"><?php echo date("Y-m-d",$_GET['end_time']); ?></span>期间<?php } ?>
	您的充值成功金额是：<span class="fontred"> ￥<?php echo (($success_money)?($success_money):"0.00"); ?></span>，充值失败金额是：<span class="fontred"> ￥<?php echo (($fail_money)?($fail_money):"0.00"); ?></span>。
</div>
<div style="margin-top: 5px;margin-bottom: 5px;" class="operaframe">
<table>
<tbody>
<tr><td></td>
<td> 时间从：<input type="text" id="start_time" value="<?php if($search['start_time']){echo date('Y-m-d',$search['start_time']);} ?>" readonly="readonly" class="Wdate timeInput_Day" onFocus="WdatePicker({maxDate:'#F{$dp.$D(\'end_time\')||\'2020-10-01\'}'})"/>至<input type="text" value="<?php if($search['end_time']){echo date('Y-m-d',$search['end_time']);} ?>" id="end_time" readonly="readonly" class="Wdate timeInput_Day" onFocus="WdatePicker({minDate:'#F{$dp.$D(\'start_time\')||\'2020-10-01\'}'})"/>
</td>
<td><img style="cursor: pointer; margin-left:20px;" id="btn_search" src="__ROOT__/Style/M/images/chakan.jpg" onclick="getBind();" alt=""></td>
</tr>
<tr style="display:none">
<td></td>
<td>金额从：<input type="text" class="txtInput" onblur="NumberCheck(this)" id="moneyBegin">至<input type="text" onblur="NumberCheck(this)" class="txtInput" id="moneyEnd"></td>
<td>
		 <img style="cursor: pointer; margin-left:20px;" id="btn_search" src="__ROOT__/Style/M/images/chakan.jpg" onclick="getBind();" alt="">
</td>
</tr>
</tbody></table>
</div>
<div style="width: 100%;">
	<table id="content" style="width: 753px; margin-left: 24px; float: left;
		border-collapse: collapse;" cellspacing="0">
		<tbody><tr id="tdHead">
			<th scope="col" class="tdHeard" style="width: 180px;">
				编号
			</th>
			<th scope="col" class="tdHeard" style="width: 180px;">
				充值时间
			</th>
			<th scope="col" class="tdHeard" style="width: 180px;">
				充值金额
			</th>
			<th scope="col" class="tdHeard" style="width: 180px;">
				充值状态
			</th>
		</tr>
	
	<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
	<td class="tdContent" style="width: 180px;"><?php echo ($vo["id"]); ?></td>
	<td class="tdContent" style="width: 180px;"><?php echo (date("Y-m-d H:i",$vo["add_time"])); ?></td>
	<td class="tdContent" style="width: 180px;"><?php echo ($vo["money"]); ?></td>
	<td class="tdContent" style="width: 180px;"><?php echo ($vo["status"]); ?></td>
	</tr><?php endforeach; endif; else: echo "" ;endif; ?>
	
	</tbody></table>
	<div style="clear: both; height: 0px;">
	</div>
	<div style=" float:left; margin:10px 30px 10px 25px;">
	</div>
	<div data="fragment-2" id="pager" style="float: right; text-align: right; width: 500px; padding-right: 0px;" class="yahoo2 ajaxpagebar"><?php echo ($pagebar); ?></div>
	<div style="clear: both; height: 0px;">
	</div>
</div>
<script type="text/javascript">
//返回数字
function NumberCheck(t){
	var num = t.value;
	var re=/^\d+\.?\d*$/;
	if(!re.test(num)){
		isNaN(parseFloat(num))?t.value=0:t.value=parseFloat(num);
	}
}

function getBind(){
	
	x = makevar(['moneyBegin','moneyEnd','start_time','end_time']);
	$.ajax({
		url: "__URL__/chargelog",
		data: x,
		timeout: 5000,
		cache: false,
		type: "get",
		dataType: "json",
		success: function (d, s, r) {
			if(d) $("#fragment-2").html(d.html);//更新客户端竞拍信息 作个判断，避免报错
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
              	if(d) $("#"+id).html(d.html);//更新客户端竞拍信息 作个判断，避免报错
            }
        });
	}catch(e){};
	return false;
})
</script>